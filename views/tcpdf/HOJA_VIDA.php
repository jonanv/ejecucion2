<?php
session_start(); 
set_time_limit (240000000);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


$idusuario = $_SESSION['idUsuario'];

//$servidor  = "http://172.16.176.254/ejecucion/";

$servidor  = "http://190.217.24.24/ejecucion/";

//------------DATOS PARA LA CONEXION BD------------
$dbhost           ='localhost';
$dbusername       ='javo2';
$dbuserpassword   ='Ejecuc10n2014';
$dbdefault_dbname ='ejecucion';

$link = mysql_connect($dbhost, $dbusername, $dbuserpassword);

if(!$link){
	echo "Fallo en la Conexión al host $dbhost";
	//return 0;
}
else if(empty($dbname) && !mysql_select_db($dbdefault_dbname)){
	echo "Fallo en la Conexión al host $dbhost";
	//return 0;
}

//-------------------------------------------------

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$id_hv = trim($_GET['id_hv']);

//Datos Generales

$query = "SELECT t1.id,t1.foto,t1.cedula,t1.nombre,t1.direccion,t1.correo,t2.des AS perfil,t3.des AS estadocivil,
          t1.telefono,t1.perfilocupacional,t1.fechanacimiento
		  FROM ((hv_datosgenerales t1
          LEFT JOIN hv_perfil t2 ON t1.perfil = t2.id)
          LEFT JOIN hv_estadocivil t3 ON t1.estado_civil = t3.id)
          WHERE t1.id = '$id_hv'";
		
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);

$completar_ruta_foto = "C:/wamp/www/ejecucion/"; 

$dato1g = $completar_ruta_foto.$row['foto'];
//$dato1g = $row['foto'];

$dato2g  = $row['cedula'];
$dato3g  = utf8_encode($row['nombre']);
$dato4g  = utf8_encode($row['direccion']);
$dato5g  = utf8_encode($row['correo']);
$dato6g  = utf8_encode($row['perfil']);
$dato7g  = utf8_encode($row['estadocivil']);
$dato8g  = utf8_encode($row['telefono']);
$dato9g  = utf8_encode($row['perfilocupacional']);

$dato10g = $row['fechanacimiento'];
date_default_timezone_set('America/Bogota'); 
setlocale(LC_TIME, "Spanish");
$fechavisual   = strftime('%d %B de %Y', strtotime($dato10g));


//ID USUARIO, AL CUAL SE LE ESTA PROCESANDO HOJA DE VIDA
//ESTO CON EL OBJETO DE QUE USUARIOS ADMINISTRADORES PUEDEN
//EDITAR OTRAS HOJAS DE VIDA Y PARA GENERAR LA TABLA DE ANTECEDENTES / CERTIFICADOS
//YA QUE LA COLUMNA id_archivo_central DE LA TABLA hv_rutas_archivos TIENE ESTE DATO

$query_u    = "SELECT id FROM pa_usuario WHERE nombre_usuario = '$dato2g'";
$sql_u      = mysql_query($query_u);
$row_u      = mysql_fetch_array($sql_u);
$id_usuario = $row_u['id'];


//Datos Estudios 
			
$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,t1.institucion
		  FROM ((hv_central t1
          LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
          LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		  WHERE t1.idservidor = '$id_hv' AND tipo_soporte = 'E'
		  ORDER BY t1.id";
		  
		  
$sql_estudios = mysql_query($query);

	
//Datos Experiencia 
			
$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	      t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo
		  FROM ((hv_central t1
          LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
          LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		  WHERE t1.idservidor = '$id_hv' AND tipo_soporte = 'L'
		  ORDER BY t1.id";

$sql_ex = mysql_query($query);


//Datos Actos Administrativos 
			
$query = "SELECT t1.id,t2.id AS idmotivo,t2.des AS motivo
		  FROM (hv_central t1
		  LEFT JOIN hv_motivo t2 ON t1.idmotivo = t2.id)
		  WHERE t1.idservidor = '$id_hv' AND t1.tipo_soporte = 'AD'
		  ORDER BY t1.id";
		  
		  
$sql_ad = mysql_query($query);



//Datos conocimientos
			
$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	      t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo
		  FROM ((hv_central t1
          LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
          LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		  WHERE t1.idservidor = '$id_hv' AND tipo_soporte = 'C'
		  ORDER BY t1.id";

$sql_co = mysql_query($query);



//Datos Referencias
			
$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	      t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t1.tipo_soporte
		  FROM ((hv_central t1
          LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
          LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		  WHERE t1.idservidor = '$id_hv' 
	      AND (tipo_soporte = 'LABORAL' OR tipo_soporte = 'PERSONAL')
		  ORDER BY t1.tipo_soporte,t1.id";

$sql_re = mysql_query($query);

//Datos Oficina
			
$query = "SELECT * FROM pa_datos_oficina";

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1ofi   = $row['secretario'];
$secretario = $dato1ofi;

$dato2ofi   = $row['nombre'];

				
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('P','mm', 'A4', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Hoja de Vida: '.$dato2g);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);


//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\ejecucion\views\tcpdf\examples\images
//$pdf->SetHeaderData('tcpdf_logo4.jpg', 58, '', 'OFICINA DE EJCUCION CILVIL MUNICIPAL DE MANIZALES');
$pdf->SetHeaderData('', 0, 'HOJA DE VIDA', $dato3g);
//$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins (LAS PARAMETRIZADAS POR LA LIBRERIA)
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//ASIGNADAS POR EL USUARIO
//$pdf->SetMargins(20,25,20);
$pdf->SetMargins(20,20,20);

$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}



// add a page
$pdf->AddPage();

$pdf->Ln(4);

/*$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(4);
$pdf->Write(0, 'DATOS GENERALES', '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(4);*/

$pdf->SetFont('helvetica', '', 12);



//DATOS FIRMA
$tbl_firma = '

		<table border="0" nobr="true">
				 
			
			
			<tr>
				
				<td>'.'__________________________________________'.'</td>
					  

			</tr>			
			
			<tr>
				
				<td><B>'.strtoupper($dato3g).'</B></td>
					  
		
			</tr>
 

			<tr>
				
				
					  
				<td><B>'.'C.C. '.$dato2g.'</B></td>
				
			</tr>
			
			
			 
		</table>';
		
		


//DATOS GENERALES
$tbl_general = '

		<table border="0" nobr="true">
				 
			
			<tr>
					  
				 
				 <td><img src= "'.$dato1g.'" width="76" height="76"/></td>
				
			</tr>
			
			<tr>
				
				<td>'.''.'</td>
					  

			</tr>
			
			<tr>
				
				<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'DATOS GENERALES'.'</B></td>
					  
			</tr>
 
 			<tr>
				
				<td>'.''.'</td>
					  

			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Cedula: '.'</td>
					  
				<td style="width:250px">'.$dato2g.'</td>
				
			</tr>
			
			
			<tr>
				
				<td style="width:150px">'.'Nombre: '.'</td>
					  
				<td style="width:250px">'.$dato3g.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Fecha Nacimiento: '.'</td>
					  
				<td style="width:250px">'.$fechavisual.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Direccion: '.'</td>
					  
				<td style="width:250px">'.$dato4g.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Telefono: '.'</td>
					  
				<td style="width:250px">'.$dato8g.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Cargo: '.'</td>
					  
				<td style="width:250px">'.$dato6g.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Estado Civil: '.'</td>
					  
				<td style="width:250px">'.$dato7g.'</td>
				
			</tr>
			
			<tr>
				
				<td style="width:150px">'.'Correo: '.'</td>
					  
				<td style="width:250px">'.$dato5g.'</td>
				
			</tr>
				 
		</table>';
		



$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);

//ADICIONO TABLA DATOS GENERALES			 
$pdf->writeHTML($tbl_general, false, false, false, false, 'L');


//ESTUDIOS
//$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(4);
/*$pdf->Write(0, 'ESTUDIOS', '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(4);*/

$pdf->SetFont('helvetica', '', 12);

//nobr="true"

$tbl_estudios_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'ESTUDIOS'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_estudios_encabezado, false, false, false, false, 'L');										


while( $row = mysql_fetch_array($sql_estudios) ){

	$dato1e  = $row["id"];
	$dato2e  = utf8_encode($row["modalidad"]);
	$dato3e  = utf8_encode($row["tipomodalidad"]);
	$dato4e  = utf8_encode($row["institucion"]);
	
	
	//---------------------------------------LINK SOPORTES----------------------------------------------
	
	$query_soportes = "SELECT * FROM hv_rutas_archivos WHERE id_archivo_central = '$dato1e'
	                   AND ruta LIKE '%SOPORTES_ESTUDIOS%'";
				   
	$sql_soportes   = mysql_query($query_soportes);
					   
	while( $row = mysql_fetch_array($sql_soportes) ){
	
		
		$dato2cer  = utf8_encode($row["ruta"]);
		
		//SOLO EL NOMBRE DEL ARCHIVO
		$dato2cer_2 = explode("/",$row["ruta"]);
		$dato2cer_3 = $dato2cer_2[3];
		
	
		$RUTA_ARCHIVO = $servidor.$dato2cer;
		
		
		$tbl_soportes .= '
													
							<table border="0" cellpadding="2" cellspacing="1">
													
								
								
								<tr>
									
									<td><a href="'.$RUTA_ARCHIVO.'" target="_blank"><img src="archivo_3.png" width="25" height="25"/></a></td>
									
									<td style="width:100px">'.$dato2cer_3.'</td>
									
								</tr>
								
							
							</table>';
											
											
					
	}//FIN WHILE while
	
	//LIMPIAR VARIABLES
	unset($dato2cer_2);
	unset($dato2cer);
	unset($dato2cer_2);
	unset($dato2cer_3);


	//---------------------------------------FIN LINK SOPORTES----------------------------------------------
	
	
	
	$tbl_estudios = '
												
						<table border="0" cellpadding="2" cellspacing="1">
												
							
							
							
							<tr>
				
								<td style="width:100px">'.'Modalidad: '.'</td>
									  
								<td style="width:200px">'.$dato2e.'</td>
								
								<td style="width:115px; font-size:8px;">'.$tbl_soportes.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Tipo Modalidad: '.'</td>
									  
								<td style="width:200px">'.$dato3e.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Institucion: '.'</td>
									  
								<td style="width:200px">'.$dato4e.'</td>
								
							</tr>
					
							<tr>
					
								<td>'.''.'</td>
						  
	
							</tr>
							
							
													
						</table>';
										
										
										
	//ADICIONO TABLA ESTUDIOS
	$pdf->writeHTML($tbl_estudios, false, false, false, false, 'L');		
	
	unset($tbl_soportes);								
		
}//FIN WHILE while


//EXPERIENCIA
/*$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(4);
$pdf->Write(0, 'EXPERIENCIA LABORAL', '', 0, 'L', true, 0, false, false, 0);*/
$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);


$tbl_ex_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'EXPERIENCIA LABORAL'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_ex_encabezado, false, false, false, false, 'L');									


while( $row = mysql_fetch_array($sql_ex) ){

	$dato1_idex  = $row["id"];
	
	$dato1ex = utf8_encode($row["institucion"]);
	$dato2ex = utf8_encode($row["direccion"]);
	$dato3ex = utf8_encode($row["telefono"]);
	$dato4ex = utf8_encode($row["periodo"]);
	$dato5ex = utf8_encode($row["cargo"]);
	
	
	
	
	//---------------------------------------LINK SOPORTES----------------------------------------------
	
	$query_soportes = "SELECT * FROM hv_rutas_archivos WHERE id_archivo_central = '$dato1_idex'
	                   AND ruta LIKE '%SOPORTES_EXPERIENCIA_LABORAL%'";
				   
	$sql_soportes   = mysql_query($query_soportes);
					   
	while( $row = mysql_fetch_array($sql_soportes) ){
	
		
		$dato2cer  = utf8_encode($row["ruta"]);
		
		//SOLO EL NOMBRE DEL ARCHIVO
		$dato2cer_2 = explode("/",$row["ruta"]);
		$dato2cer_3 = $dato2cer_2[3];
		
	
		$RUTA_ARCHIVO = $servidor.$dato2cer;
		
		
		$tbl_soportes .= '
													
							<table border="0" cellpadding="2" cellspacing="1">
													
								
								
								<tr>
									
									<td><a href="'.$RUTA_ARCHIVO.'" target="_blank"><img src="archivo_3.png" width="25" height="25"/></a></td>
									
									<td style="width:100px">'.$dato2cer_3.'</td>
									
								</tr>
								
							
							</table>';
											
											
					
	}//FIN WHILE while
	
	//LIMPIAR VARIABLES
	unset($dato2cer_2);
	unset($dato2cer);
	unset($dato2cer_2);
	unset($dato2cer_3);


	//---------------------------------------FIN LINK SOPORTES----------------------------------------------
	
	$tbl_ex = '
												
						<table border="0" cellpadding="2" cellspacing="1">
												
							
							
							<tr>
				
								<td style="width:100px">'.'Entidad: '.'</td>
									  
								<td style="width:200px">'.$dato1ex.'</td>
								
								<td style="width:115px; font-size:8px;">'.$tbl_soportes.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Direccion: '.'</td>
									  
								<td style="width:200px">'.$dato2ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Telefono: '.'</td>
									  
								<td style="width:200px">'.$dato3ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Periodo: '.'</td>
									  
								<td style="width:200px">'.$dato4ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Cargo: '.'</td>
									  
								<td style="width:200px">'.$dato5ex.'</td>
								
							</tr>
					
							<tr>
					
								<td>'.''.'</td>
						  
	
							</tr>
													
						</table>';
										
										
										
	//ADICIONO TABLA EXPERIENCIA LABORAL
	$pdf->writeHTML($tbl_ex, false, false, false, false, 'L');				
	
	unset($tbl_soportes);						
		
}//FIN WHILE while


$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);


$tbl_ad_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'ACTOS ADMINISTRATIVOS'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_ad_encabezado, false, false, false, false, 'L');
	


while( $row = mysql_fetch_array($sql_ad) ){

	$dato1ad = $row["id"];
	$dato2ad = utf8_encode($row["motivo"]);
	
	//---------------------------------------LINK SOPORTES----------------------------------------------
	
	$query_soportes = "SELECT * FROM hv_rutas_archivos WHERE id_archivo_central = '$dato1ad'
	                   AND ruta LIKE '%ACTOS_ADMINISTRATIVOS%'";
				   
	$sql_soportes   = mysql_query($query_soportes);
					   
	while( $row = mysql_fetch_array($sql_soportes) ){
	
		
		$dato2cer  = utf8_encode($row["ruta"]);
		
		//SOLO EL NOMBRE DEL ARCHIVO
		$dato2cer_2 = explode("/",$row["ruta"]);
		$dato2cer_3 = $dato2cer_2[3];
		
	
		$RUTA_ARCHIVO = $servidor.$dato2cer;
		
		
		$tbl_soportes .= '
													
							<table border="0" cellpadding="2" cellspacing="1">
													
								
								
								<tr>
									
									<td><a href="'.$RUTA_ARCHIVO.'" target="_blank"><img src="archivo_3.png" width="25" height="25"/></a></td>
									
									<td style="width:100px">'.$dato2cer_3.'</td>
									
								</tr>
								
							
							</table>';
											
											
					
	}//FIN WHILE while
	
	//LIMPIAR VARIABLES
	unset($dato2cer_2);
	unset($dato2cer);
	unset($dato2cer_2);
	unset($dato2cer_3);


	//---------------------------------------FIN LINK SOPORTES----------------------------------------------
	
	$tbl_ad = '
												
						<table border="0" cellpadding="2" cellspacing="1">
												
							
							
							<tr>
				
								<td style="width:100px">'.'Acto: '.'</td>
									  
								<td style="width:200px">'.$dato2ad.'</td>
								
								<td style="width:115px; font-size:8px;">'.$tbl_soportes.'</td>
								
							</tr>
							
							
							<tr>
					
								<td>'.''.'</td>
						  
	
							</tr>
													
						</table>';
										
										
										
	//ADICIONO TABLA EXPERIENCIA LABORAL
	$pdf->writeHTML($tbl_ad, false, false, false, false, 'L');				
	
	unset($tbl_soportes);						
		
}//FIN WHILE while	


	
	

$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);


$tbl_ac_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'ANTECEDENTES / CERTIFICADOS'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_ac_encabezado, false, false, false, false, 'L');

	//---------------------------------------LINK SOPORTES----------------------------------------------
	
	$query_AC = "SELECT * FROM hv_rutas_archivos WHERE id_archivo_central = '$id_usuario'
	             AND ruta LIKE '%ANTECEDENTES_CERTIFICADOS%'";
	$sql_AC   = mysql_query($query_AC);

	while( $row = mysql_fetch_array($sql_AC) ){
	
		
		$dato2cer  = utf8_encode($row["ruta"]);
		
		//SOLO EL NOMBRE DEL ARCHIVO
		$dato2cer_2 = explode("/",$row["ruta"]);
		$dato2cer_3 = $dato2cer_2[3];
		
	
		$RUTA_ARCHIVO = $servidor.$dato2cer;
		
		
		$tbl_soportes .= '
													
							<table border="0" cellpadding="2" cellspacing="1">
													
								
								
								<tr>
									
									<td><a href="'.$RUTA_ARCHIVO.'" target="_blank"><img src="archivo_3.png" width="25" height="25"/></a></td>
									
									<td style="width:115px; font-size:8px;">'.$dato2cer_3.'</td>
									
								</tr>
								
							
							</table>';
											
		
		$pdf->writeHTML($tbl_soportes, false, false, false, false, 'L');			
		
		unset($tbl_soportes);						
					
	}//FIN WHILE while
	
	//LIMPIAR VARIABLES
	unset($dato2cer_2);
	unset($dato2cer);
	unset($dato2cer_2);
	unset($dato2cer_3);
	


	//---------------------------------------FIN LINK SOPORTES----------------------------------------------


$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);


$tbl_co_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'CONOCIMIENTOS'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_co_encabezado, false, false, false, false, 'L');


while( $row = mysql_fetch_array($sql_co) ){

	$dato1co = utf8_encode($row["institucion"]);
	
					
	$tbl_co = '
												
						<table border="0" cellpadding="2" cellspacing="1">
												
							
							
							<tr>
				
							  
								<td style="width:300px">'.'-'.$dato1co.'</td>
								
							</tr>
							
							
													
						</table>';
										
										
										
	//ADICIONO TABLA CONOCIMIENTOS
	$pdf->writeHTML($tbl_co, false, false, false, false, 'L');										
		
}//FIN WHILE while

$pdf->Ln(4);

//PERFIL OCUPACIONAL
$tbl_po = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'PERFIL OCUPACIONAL'.'</B></td>
									  
						
						</tr>
				 
				 		
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
						
						<tr>
								
							<td>'.$dato9g.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_po, false, false, false, false, 'J');


//REFERENCIAS
/*$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(4);
$pdf->Write(0, 'REFERENCIAS', '', 0, 'L', true, 0, false, false, 0);*/
$pdf->Ln(4);

$pdf->SetFont('helvetica', '', 12);


$tbl_ref_encabezado = '
												
					<table border="0" cellpadding="2" cellspacing="1" nobr="true">
												
							
						<tr>
				
							<td colspam = 2 style="border-width: 1px;border: solid; border-color: #000000;"><B>'.'REFERENCIAS'.'</B></td>
									  
						
						</tr>
				 
						<tr>
								
							<td>'.''.'</td>
									  
				
						</tr>
							
							
			
					</table>';
										
										
								
	$pdf->writeHTML($tbl_ref_encabezado, false, false, false, false, 'L');

while( $row = mysql_fetch_array($sql_re) ){

	$dato1ex = utf8_encode($row["institucion"]);
	$dato2ex = utf8_encode($row["direccion"]);
	$dato3ex = utf8_encode($row["telefono"]);
	$dato4ex = utf8_encode($row["cargo"]);
	$dato5ex = utf8_encode($row["tipo_soporte"]);
		
					
	$tbl_re = '
												
						<table border="0" cellpadding="2" cellspacing="1">
												
							
							
							<tr>
				
								<td style="width:100px">'.'Nombre: '.'</td>
									  
								<td style="width:200px">'.$dato1ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Direccion: '.'</td>
									  
								<td style="width:200px">'.$dato2ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Telefono: '.'</td>
									  
								<td style="width:200px">'.$dato3ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Profesion: '.'</td>
									  
								<td style="width:200px">'.$dato4ex.'</td>
								
							</tr>
							
							<tr>
				
								<td style="width:100px">'.'Referencia: '.'</td>
									  
								<td style="width:200px">'.$dato5ex.'</td>
								
							</tr>
					
							<tr>
					
								<td>'.''.'</td>
						  
	
							</tr>
													
						</table>';
										
										
										
	//ADICIONO TABLA REFERENCIAS
	$pdf->writeHTML($tbl_re, false, false, false, false, 'L');										
		
}//FIN WHILE while

$pdf->Ln(16);

$pdf->SetFont('helvetica', '', 12);

//ADICIONO TABLA FIRMA			 
$pdf->writeHTML($tbl_firma, false, false, false, false, 'L');


$pdf->SetFont('helvetica', '', 10);
$pdf->Ln(8);
$pdf->Write(0, 'NOTA: PARA EFECTOS LEGALES HAGO CONSTAR QUE LA INFORMACION SUMINISTRADA ES TOTALMENTE CIERTA (Art. 62 NUMERAL 1 CST) Y PUEDE SER VERIFICADA A CABALIDAD.', '', 0, 'J', true, 0, false, false, 0);

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('Hoja_Vida.pdf', 'I');



?>