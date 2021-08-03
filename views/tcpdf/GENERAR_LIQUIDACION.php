<?php
session_start(); 
set_time_limit (240000000);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


$idusuario = $_SESSION['idUsuario'];

//------------DATOS PARA LA CONEXION BD------------
$dbhost           ='localhost';
$dbusername       ='root';
$dbuserpassword   ='Ejecuc10n2014';
$dbdefault_dbname ='ejecucion';

$link = mysql_connect($dbhost, $dbusername, $dbuserpassword);

if(!$link){
	echo "Fallo en la Conexi�n al host $dbhost";
	//return 0;
}
else if(empty($dbname) && !mysql_select_db($dbdefault_dbname)){
	echo "Fallo en la Conexi�n al host $dbhost";
	//return 0;
}

//-------------------------------------------------

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$nun_liquidacion = trim($_GET['nun_liquidacion']);

$agencias        = trim($_GET['agencias']);
$acuerdo         = trim($_GET['acuerdo']);

$fechafijacion   = trim($_GET['fechafijacion']);
$date_f          = date_create($fechafijacion);
$fechafijacion   = date_format($date_f,'d-m-Y');

$fechainicial    = trim($_GET['fechainicial']);
$date_i          = date_create($fechainicial);
$fechainicial    = date_format($date_i,'d-m-Y');

$fechafinal      = trim($_GET['fechafinal']);
$date_fi         = date_create($fechafinal);
$fechafinal      = date_format($date_fi,'d-m-Y');

$cesionario      = utf8_encode(trim($_GET['cesionario']));
$subrogatario    = utf8_encode(trim($_GET['subrogatario']));

$forma_dte_ddo    = utf8_encode(trim($_GET['forma_dte_ddo']));

$nunestado       = trim($_GET['nunestado']);
$fecha_estado    = trim($_GET['fecha_estado']);

//Datos_Liquidacion_Costas

$query = "SELECT * FROM liquidacion_costas WHERE nunentrada = ".$nun_liquidacion;
		
$sql = mysql_query($query);
$row = mysql_fetch_array($sql);

$dato1e = $row['fechae'];
$dato2e = $row['horae'];
$dato3e = $row['idradicado'];
$dato4e = $row['idusuario'];
$dato5e = $row['idjuzgadoejecucion'];
$dato6e = $row['nuevo'];
$dato7e = $row['liquidacioncredito'];
$dato8e = utf8_encode($row['observacioncostas']);		
		
$Juzgado = $dato5e;	

//Datos Juzgado Ejecucion
			
$query = "SELECT * FROM juzgado_destino WHERE id = ".$Juzgado;

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1 = utf8_encode($row['nombre']);
$dato2 = utf8_encode($row['nombre_juez']);
$dato3 = utf8_encode($row['leyenda']);
                
$Leyenda = $dato3;


//Datos Oficina
			
$query = "SELECT * FROM pa_datos_oficina";

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1ofi   = $row['secretario'];
$secretario = utf8_encode($dato1ofi);

//Datos Proceso

$query = "SELECT t1.radicado,t1.demandante,t1.demandado,t2.nombre
          FROM (ubicacion_expediente t1 INNER JOIN pa_clase_proceso t2 ON t1.idclase_proceso = t2.id) 
		  WHERE t1.id = ".$dato3e;

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1pro = utf8_encode($row['radicado']);
$dato2pro = utf8_encode($row['demandante']);
$dato3pro = utf8_encode($row['demandado']);
$dato4pro = utf8_encode($row['nombre']);

					
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('P','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Liquidacion Costas Numero: '.$nun_liquidacion);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);


//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\laborales\views\tcpdf\examples\images
//$pdf->SetHeaderData('tcpdf_logo4.jpg', 68, '', '');
//$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins (LAS PARAMETRIZADAS POR LA LIBRERIA)
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//ASIGNADAS POR EL USUARIO
$pdf->SetMargins(20,5,20);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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


//PARA EL RESTO TEXTO EN EL PDF 
$pdf->SetFont('helvetica', 'B', 12);

// add a page
$pdf->AddPage();

$pdf->Ln(4);

//$pdf->Write(0, 'LIQUIDACION DE COSTAS NUMERO:'.$nun_liqui, '', 0, 'C', true, 0, false, false, 0);


$tbl_firma = '<table>
								 
				<tr>
									  
					<td style="border-bottom-color:#FFFFFF"><img src="examples/images/firmasecre_2.png" width="200" height="40"/></td>
								
				</tr>
					 
			</table>';
			

$tbl_escudo = '
		<table>
				 
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF"><img src="examples/images/escudo.jpg" width="66" height="56"/></td>
				
			</tr>
	 
		</table>';
		


//J1
if($dato5e == 1){

	$FIRMA_JUEZ ='<tr>
									  
					<td style="border-bottom-color:#FFFFFF"><img src="examples/images/fj1.png" width="200" height="40"/></td>
								
				</tr>';
			
}
//J2		
if($dato5e == 2){

	$FIRMA_JUEZ ='<tr>
									  
					<td style="border-bottom-color:#FFFFFF"><img src="examples/images/fj2.png" width="200" height="200"/></td>
								
				</tr>';
			
}		

$tbl_noti = '
		<table border="0" nobr="true">
				 
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.utf8_encode('NOTIF�QUESE').'</td>
				
			</tr>
			
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			'.
			
			$FIRMA_JUEZ
			
			.'
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$dato2.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.'JUEZ'.'</td>
				
			</tr>
			
			
				 
		</table>';
		

$tbl_cumplase = '
		<table border="0" nobr="true">
				 
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.utf8_encode('CUMPLASE').'</td>
				
			</tr>
			
		
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			'.
			
			$FIRMA_JUEZ
			
			.'
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$dato2.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.'JUEZ'.'</td>
				
			</tr>
			
			
				 
		</table>';		
		

if($agencias != 1){

	$pdf->Write(0, 'INFORME SECRETARIAL', '', 0, 'L', true, 0, false, false, 0);
	$pdf->Ln(4);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->Write(0, utf8_encode('A Despacho del se�or Juez  el presente proceso el cual se encuentra pendiente de liquidar costas y liquidaci�n de cr�dito presentada por la parte actora'), '', 0, 'J', true, 0, false, false, 0);
	//$pdf->Ln(4);
	//$pdf->Write(0, utf8_encode('En cumplimiento al contenido del art�culo 366 del c�digo General del Proceso, se procede a realizar la liquidaci�n de costas al presente proceso, a cargo de los demandados, de la siguiente manera:'), '', 0, 'L', true, 0, false, false, 0);
	$pdf->Ln(4);
}
else{

	$pdf->SetFont('helvetica', '', 12);
	$pdf->Write(0, utf8_encode('CONSTANCIA: A Despacho del se�or(a) Juez(a) el presente proceso el cual fue asignado a dicho Juzgado en virtud a lo dispuesto por el Acuerdo No. PSAA13-9984 de septiembre 5 de 2013 expedido por la Sala Administrativa del Consejo Superior de la judicatura.'), '', 0, 'J', true, 0, false, false, 0);
	$pdf->Ln(4);
	$pdf->Write(0, utf8_encode('Se encuentra pendiente de se�alar las agencias en derecho, pues el Juzgado de Oralidad en el respectivo auto que orden� seguir adelante con la ejecuci�n las omiti�.'), '', 0, 'J', true, 0, false, false, 0);
	$pdf->Ln(4);
	$pdf->Write(0, utf8_encode('S�rvase proveer.'), '', 0, 'L', true, 0, false, false, 0);
	$pdf->Ln(4);
	
	setlocale(LC_TIME, "Spanish");
	$fecha_liqui   = strftime('%d %B de %Y', strtotime($dato1e));
	
	$pdf->Ln(4);
	$pdf->Write(0, "Manizales, ".$fecha_liqui, '', 0, 'L', true, 0, false, false, 0);
	
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->Ln(16);
	$pdf->writeHTML($tbl_firma, false, false, false, false, 'C');
	$pdf->Write(0, $secretario, '', 0, 'C', true, 0, false, false, 0);
	$pdf->Write(0, 'Secretario', '', 0, 'C', true, 0, false, false, 0);
						 
	$pdf->Ln(16);
	$pdf->Write(0, utf8_encode('REP�BLICA DE COLOMBIA'), '', 0, 'C', true, 0, false, false, 0);
	
	//$pdf->Image('examples/images/escudo.jpg', 98, 105, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
	
	//LLAMADO A TABLA ESCUDO			 
	$pdf->writeHTML($tbl_escudo, false, false, false, false, 'C');
	
	$pdf->Ln(1);
	// DEVUELVE JUZGADO PRIMERO O SEGUNDO DE EJECUCION CIVIL MUNICIPAL
	//EN VEZ DE JUZGADO PRIMERO O SEGUNDO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
	$dato1 = substr($dato1, 0, -13);  
	$pdf->Write(0, utf8_encode($dato1), '', 0, 'C', true, 0, false, false, 0);
	
	$pdf->Ln(0);
	//fecha
	setlocale(LC_TIME, "Spanish");
	$fechafijacion_b = explode("-",$dato1e);
	
	//DIA
	$fechafijacion_c = $fechafijacion_b[2];
	$dia_letra       = $funcion-> numtoletras_para_fecha($fechafijacion_c,1);
	
	//A�O
	$fechafijacion_d = $fechafijacion_b[0];
	$dia_letra_2     = $funcion-> numtoletras_para_fecha($fechafijacion_d,1);
	
	$fecha           = $dia_letra." (".$fechafijacion_c .") de ".strftime('%B', strtotime($dato1e))." de "." ".$dia_letra_2." (".$fechafijacion_d .")";
	$pdf->SetFont('helvetica', '', 12);
	$pdf->Write(0,"Manizales,"." ".strtolower($fecha),'', 0, 'C', true, 0, false, false, 0);
						 
	
	//DATOS PROCESO
	$pdf->SetMargins(60,5,20);
	$pdf->Ln(4);
	
	$pdf->SetFont('helvetica', 'B', 10);
	
	$tbl_7 = '
			<table border="0" nobr="true">
					 
				<tr>
						  
					<td style="width:100px; text-align:left">Proceso:</td>
					<td style="width:200px; text-align:left">'.$dato4pro.'</td>
				
				</tr> 
				
				<tr>
						  
					<td style="width:100px; text-align:left">Demandante:</td>
					<td style="width:200px; text-align:left">'.$dato2pro .'</td>
				
				</tr>
				
				<tr>
						  
					<td style="width:100px; text-align:left">Demandado:</td>
					<td style="width:200px; text-align:left">'.$dato3pro .'</td>
				
				</tr>
				
				<tr>
						  
					<td style="width:100px; text-align:left">Radicado:</td>
					<td style="width:200px; text-align:left">'.$dato1pro .'</td>
				
				</tr>
					 
			</table>';
					 
	$pdf->writeHTML($tbl_7, false, false, false, false, 'C');
	
	
	$query = "SELECT t1.id,t1.nunentradade,t1.idarticulode,t2.nomarticulo,t1.cantidadde
		      FROM (detalle_liquidacion_costas t1 INNER JOIN item t2 ON t1.idarticulode = t2.referencia)
		      WHERE t1.nunentradade = '$nun_liquidacion'";
						  
	$sql   = mysql_query($query);
	
	
	while($row = mysql_fetch_array($sql)){
	
		$idarticulode = $row["idarticulode"];
		
		if($idarticulode == "costa001"){
		
			$cantidadde = $row["cantidadde"];
			break;
		
		}
	
	}		
	
	$LA_SUMA = $funcion-> numtoletras($cantidadde,1);

	$pdf->SetMargins(20,5,20);
	$pdf->Ln(8);
	$pdf->SetFont('helvetica', '', 12);
	$pdf->Write(0, utf8_encode('De conformidad con el '.$acuerdo.' emanados por el Consejo Superior de la Judicatura, FIJASE la suma de '.$LA_SUMA." ($".number_format($cantidadde, 2, ',', '.')."), el valor de las agencias en derecho, ".$forma_dte_ddo." Por la secretar�a del Juzgado, proc�dase a la liquidaci�n de las dem�s costas e incl�yase la anterior cantidad."), '', 0, 'J', true, 0, false, false, 0);
	
	
	$pdf->Ln(8);
	$pdf->SetFont('helvetica','B',12);
	/*$pdf->Write(0, utf8_encode('CUMPLASE'), '', 0, 'C', true, 0, false, false, 0);
	$pdf->Ln(16);
	$pdf->MultiCell(0,6,$dato2,0,'C',false);
	$pdf->Cell(0,6,'JUEZ',0,1,'C');*/
	$pdf->writeHTML($tbl_cumplase, false, false, false, false, 'C');
	
	$pdf->AddPage();

}

$pdf->SetMargins(20,5,20);
$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, utf8_encode('En cumplimiento al contenido del art�culo 366 del c�digo General del Proceso, se procede a realizar la liquidaci�n de costas al presente proceso, a cargo de los demandados, de la siguiente manera:'), '', 0, 'J', true, 0, false, false, 0);
$pdf->Ln(4);

$pdf->SetFont('helvetica', 'B', 12);

//cellpadding="2" cellspacing="1"

$tbl = '
		<table border="1" nobr="true">
				 
			<tr>
					  
				<td style="width:250px; text-align:left">COSTA</td>
				<td style="width:80px; text-align:right">VALOR</td>
		
			</tr> 
				 
		</table>';
				 
$pdf->writeHTML($tbl, false, false, false, false, 'C');

$pdf->SetFont('helvetica', '', 12);

$query = "SELECT t1.id,t1.nunentradade,t1.idarticulode,t2.nomarticulo,t1.cantidadde
		  FROM (detalle_liquidacion_costas t1 INNER JOIN item t2 ON t1.idarticulode = t2.referencia)
		  WHERE t1.nunentradade = '$nun_liquidacion'";
						  
$sql   = mysql_query($query);

$TOTAL_COSTAS = 0;
				
while($row = mysql_fetch_array($sql)){

	$idarticulode = $row["idarticulode"];
	$nomarticulo  = utf8_encode($row["nomarticulo"]);
	$cantidadde   = $row["cantidadde"];
	
	$TOTAL_COSTAS = $TOTAL_COSTAS + $cantidadde;
	
	
	$tbl_2 = '
				<table border="1" nobr="true">
												
					<tr>
										
										
						<td style="width:250px; font-size:12px; text-align:left">'.utf8_encode($nomarticulo).'</td>
						<td style="width:80px; font-size:12px; text-align:right">'.number_format($cantidadde, 2, ',', '.').'</td>
										
					</tr>
													
				</table>';
										
					
					
										
	$pdf->writeHTML($tbl_2, false, false, false, false, 'C');
	
}

$pdf->SetFont('helvetica', 'B', 12);

$tbl_3 = '
		<table border="1" nobr="true">
				 
			<tr>
					  
				<td style="width:250px; text-align:left">TOTAL COSTAS</td>
				<td style="width:80px; font-size:12px; text-align:right">'.number_format($TOTAL_COSTAS, 2, ',', '.').'</td>
		
			</tr> 
				 
		</table>';
				 
$pdf->writeHTML($tbl_3, false, false, false, false, 'C');


$pdf->SetFont('helvetica', '', 12);

//include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
//$funcion = new Funciones();

$TOTAL_COSTAS_LETRAS = $funcion-> numtoletras($TOTAL_COSTAS,1);

$pdf->Ln(4);
$pdf->Write(0, "Son: ".$TOTAL_COSTAS_LETRAS." ($".number_format($TOTAL_COSTAS, 2, ',', '.').")", '', 0, 'L', true, 0, false, false, 0);

setlocale(LC_TIME, "Spanish");
$fecha_liqui   = strftime('%d %B de %Y', strtotime($dato1e));

$pdf->Ln(4);
$pdf->Write(0, "Manizales, ".$fecha_liqui, '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(4);
$pdf->writeHTML($tbl_firma, false, false, false, false, 'C');
$pdf->Write(0, $secretario, '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, 'Secretario', '', 0, 'C', true, 0, false, false, 0);
					 
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('REP�BLICA DE COLOMBIA'), '', 0, 'C', true, 0, false, false, 0);

/*if($agencias != 1){
	$pdf->Image('examples/images/escudo.jpg', 98, 130, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
}
else{
	$pdf->Image('examples/images/escudo.jpg', 98, 100, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
}*/

//LLAMADO A TABLA ESCUDO			 
$pdf->writeHTML($tbl_escudo, false, false, false, false, 'C');
	
$pdf->Ln(1);

// DEVUELVE JUZGADO PRIMERO O SEGUNDO DE EJECUCION CIVIL MUNICIPAL
//EN VEZ DE JUZGADO PRIMERO O SEGUNDO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
//$dato1 = substr($dato1, 0, -13);  
$pdf->Write(0, utf8_encode($dato1), '', 0, 'C', true, 0, false, false, 0);

$pdf->Ln(0);
//fecha
setlocale(LC_TIME, "Spanish");
$fechafijacion_b = explode("-",$dato1e);

//DIA
$fechafijacion_c = $fechafijacion_b[2];
$dia_letra       = $funcion-> numtoletras_para_fecha($fechafijacion_c,1);

//A�O
$fechafijacion_d = $fechafijacion_b[0];
$dia_letra_2     = $funcion-> numtoletras_para_fecha($fechafijacion_d,1);

$fecha           = $dia_letra." (".$fechafijacion_c .") de ".strftime('%B', strtotime($dato1e))." de "." ".$dia_letra_2." (".$fechafijacion_d .")";
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0,"Manizales,"." ".strtolower($fecha),'', 0, 'C', true, 0, false, false, 0);
					 

//DATOS PROCESO
$pdf->SetMargins(60,5,20);
$pdf->Ln(4);

$pdf->SetFont('helvetica', 'B', 10);

$tbl_4 = '
		<table border="0" nobr="true">
				 
			<tr>
					  
				<td style="width:100px; text-align:left">Proceso:</td>
				<td style="width:200px; text-align:left">'.$dato4pro.'</td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:100px; text-align:left">Demandante:</td>
				<td style="width:200px; text-align:left">'.$dato2pro .'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:100px; text-align:left">Demandado:</td>
				<td style="width:200px; text-align:left">'.$dato3pro .'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:100px; text-align:left">Radicado:</td>
				<td style="width:200px; text-align:left">'.$dato1pro .'</td>
			
			</tr>
				 
		</table>';
				 
$pdf->writeHTML($tbl_4, false, false, false, false, 'C');


$pdf->SetMargins(20,5,20);
/*$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('Atendiendo la constancia secretarial que antecede, se AVOCA CONOCIMIENTO del presente proceso al cual se ordena imprimirle el tr�mite de rigor.'), '', 0, 'J', true, 0, false, false, 0);		
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('Lo anterior, con ocasi�n a la creaci�n de este Juzgado mediante Acuerdo No. PSAA13-9962 de julio 31 de 2013 expedido por la Sala Administrativa del Consejo Superior de la Judicatura.'), '', 0, 'L', true, 0, false, false, 0);		*/
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('De conformidad con lo establecido en el art�culo 366 del c�digo General del Proceso, Se aprueba la anterior liquidaci�n de Costas elaborada por la Secretaria dentro del presente proceso.'), '', 0, 'J', true, 0, false, false, 0);		

$pdf->Ln(4);
$pdf->Write(0, utf8_encode('De igual forma, c�rrase traslado a la liquidaci�n de cr�dito presentada de conformidad con el art�culo 110 del c�digo General del Proceso.'), '', 0, 'J', true, 0, false, false, 0);		

//if($agencias == 1){
	//$pdf->AddPage();
//}

$pdf->Ln(4);
$pdf->Write(0, $dato8e, '', 0, 'L', true, 0, false, false, 0);		


$pdf->Ln(8);
$pdf->SetFont('helvetica','B',12);
/*$pdf->Write(0, utf8_encode('NOTIF�QUESE'), '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(16);
$pdf->MultiCell(0,6,$dato2,0,'C',false);
$pdf->Cell(0,6,'JUEZ',0,1,'C');*/
$pdf->writeHTML($tbl_noti, false, false, false, false, 'C');

$pdf->SetMargins(30,5,20);
$pdf->SetFont('helvetica','',9);
//$pdf->SetFillColor(255,255,255);
//$pdf->SetTextColor(0);
$pdf->Ln(8);

$linea_2 = utf8_encode("MANIZALES � CALDAS");
$linea_3 = utf8_encode("NOTIFICACI�N POR ESTADO");
$linea_4 = utf8_encode("La providencia anterior se notifica en el Estado");
//$linea_5 = utf8_encode("No. ____ del ___________ de ".date('Y'));
setlocale(LC_TIME, "Spanish");
$fecha_estado_2 = strftime('%d %B de %Y', strtotime($fecha_estado));
$linea_5 = utf8_encode("No. ".$nunestado." del ".$fecha_estado_2);
$linea_6 = utf8_encode($secretario);
$linea_7 = utf8_encode("SECRETARIO");

//$recuadro = $dato1."\n"."MANIZALES � CALDAS"."\n"."NOTIFICACI�N POR ESTADO"."\n"."\n"."La providencia anterior se notifica en el Estado"."\n"."No. ____ del ___________"."\n".$secretario."\n"."SECRETARIA"; 

//$recuadro = utf8_encode($dato1."\n"."MANIZALES � CALDAS"."\n"."NOTIFICACI�N POR ESTADO"."\n"."\n"."La providencia anterior se notifica en el Estado"."\n"."No. ____ del ___________"."\n".$secretario."\n"."SECRETARIA"); 

$tbl_5 = '
		<table border="1" nobr="true">
				 
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$dato1.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_2.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_3.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_4.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_5.'</td>
				
			</tr>
			
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.''.'</td>
				
			</tr>
			
			<tr>
									  
				<td style="border-bottom-color:#FFFFFF"><img src="examples/images/firmasecre_2.png" width="200" height="40"/></td>
								
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_6.'</td>
				
			</tr>
			
			<tr>
					  
				<td style="border-bottom-color:#FFFFFF">'.$linea_7.'</td>
				
			</tr>
			
			
				 
		</table>';
				 
$pdf->writeHTML($tbl_5, false, false, false, false, 'C');

//RECTANGULO PARA CUBRIR LA INFORMACION ANTERIOR
//$pdf->Rect(50, 70, 120, 50) ;

$pdf->SetMargins(20,5,20);
$pdf->Ln(16);
$pdf->Cell(0,6,utf8_encode('Proyecto: oecm'),0,1,'L');




//$pdf->Write(0, utf8_encode('REP�BLICA DE COLOMBIA'), '', 0, 'C', true, 0, false, false, 0);

//$pdf->Image('examples/images/escudo.jpg', 100, 150, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

$pdf->AddPage();
$pdf->SetMargins(20,5,20);
$pdf->SetFont('helvetica','B',12);

$pdf->Ln(4);
$pdf->Cell(0,6,utf8_encode('REP�BLICA DE COLOMBIA'),0,1,'C');
$pdf->Image('examples/images/escudo.jpg' , 98 ,15, 20 , 15,'JPG', '');


$pdf->Ln(15);
$pdf->MultiCell(0,6,'OFICINA DE EJECUCION CIVIL MUNICIPAL',0,'C',false);
$pdf->MultiCell(0,6,'MANIZALES - CALDAS',0,'C',false);

$pdf->Ln(8);
$pdf->MultiCell(0,6,'TRASLADO EN LISTA 110',0,'C',false);



//DATOS PROCESO
$pdf->SetMargins(20,5,20);
$pdf->Ln(8);

$pdf->SetFont('helvetica', 'B', 12);

$tbl_5 = '
		<table border="0" nobr="true">
				 
			<tr>
					  
				<td style="width:150px; text-align:left">PROCESO:</td>
				<td style="width:250px; text-align:left">'.$dato4pro.'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">DEMANDANTE:</td>
				<td style="width:250px; text-align:left">'.$dato2pro.'</td>
			
			</tr>
			
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">CESIONARIO:</td>
				<td style="width:250px; text-align:left">'.$cesionario.'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">SUBROGATARIO:</td>
				<td style="width:250px; text-align:left">'.$subrogatario.'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">DEMANDADO:</td>
				<td style="width:250px; text-align:left">'.$dato3pro.'</td>
			
			</tr>
			
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">RADICADO:</td>
				<td style="width:250px; text-align:left">'.$dato1pro.'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">ASUNTO:</td>
				<td style="width:250px; text-align:left">'.utf8_encode('LIQUIDACI�N DEL CR�DITO').'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">'.utf8_encode('FIJACI�N:').'</td>
				<td style="width:250px; text-align:left">'.$fechafijacion.'</td>
			
			</tr>
			
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left">'.utf8_encode('TRASLADO:').'</td>
				<td style="width:250px; text-align:left">'.utf8_encode('TRES (3) D�AS').'</td>
			
			</tr>
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left"></td>
			
			</tr> 
			
			<tr>
					  
				<td style="width:150px; text-align:left"></td>
				<td style="width:250px; text-align:left">'.utf8_encode('T�rmino que empieza a correr el '.$fechainicial.' a las 8:00 a.m. y vence el '.$fechafinal.' a las 6:00 p.m.').'</td>
			
			</tr>
				 
		</table>';
				 
$pdf->writeHTML($tbl_5, false, false, false, false, 'C');


$pdf->Ln(32);
$pdf->writeHTML($tbl_firma, false, false, false, false, 'C');
$pdf->MultiCell(0,6,$secretario,0,'C',false);
$pdf->MultiCell(0,6,'SECRETARIO',0,'C',false);


//DATOS VERSION
$pdf->SetMargins(20,5,20);
$pdf->Ln(8);

$pdf->SetFont('helvetica', '', 10);

$tbl_6 = '
		<table border="0" nobr="true">
				 
			<tr>
					 
				<td style="width:250px; text-align:left">'.utf8_encode('C�digo: F-LC-01').'</td>
				<td style="width:250px; text-align:left">'.utf8_encode('Versi�n: 01').'</td>
			</tr>
		
			
		</table>';
				 
$pdf->writeHTML($tbl_6, false, false, false, false, 'C');



//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('Liquidacion.pdf', 'I');



?>