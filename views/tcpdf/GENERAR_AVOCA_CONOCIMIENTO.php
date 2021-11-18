<?php
session_start(); 
set_time_limit (240000000);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


$idusuario = $_SESSION['idUsuario'];

//------------DATOS PARA LA CONEXION BD------------
$dbhost           ='localhost';
$dbusername       ='javo2';
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

$nunestado       = trim($_GET['nunestado']);
$fecha_estado    = trim($_GET['fecha_estado']);

//-------------------------------------------------

//Datos Oficina
			
$query = "SELECT * FROM pa_datos_oficina";

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1ofi   = $row['secretario'];
$secretario = $dato1ofi;
$dato2ofi   = $row['nombre'];


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$id_liqui_apc        = trim($_GET['id_liqui_apc']);
$radicado            = trim($_GET['radicado']);

date_default_timezone_set('America/Bogota'); 
setlocale(LC_TIME, "Spanish");
$fecha_liqui_a_apc   = trim($_GET['fecha_liqui_a_apc']);

if(empty($fecha_liqui_a_apc)){
	
	$fecha_liqui_a_apc=date('Y-m-d');
	$fecha_liqui       = strftime('%d %B de %Y', strtotime($fecha_liqui_a_apc));
}
else{

	$fecha_liqui   = strftime('%d %B de %Y', strtotime($fecha_liqui_a_apc));

}	

$juzgado_apc       = trim($_GET['juzgado_apc']);

if($juzgado_apc == "Seleccionar Juzgado"){

	$juzgado_apc = $dato2ofi;
}

$dato8e = trim($_GET['observacionsr_a_apc']);



//Datos Proceso

$query = "SELECT t1.radicado,t1.demandante,t1.demandado,t2.nombre,t3.id AS idjd,t3.nombre AS jd,t3.nombre_juez
          FROM ((ubicacion_expediente t1 
		  LEFT JOIN pa_clase_proceso t2 ON t1.idclase_proceso = t2.id)
		  LEFT JOIN juzgado_destino t3 ON t1.idjuzgadodestino = t3.id)
		  WHERE t1.id = ".$id_liqui_apc;		  

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1pro = $row['radicado'];
$dato2pro = $row['demandante'];
$dato3pro = $row['demandado'];
$dato4pro = $row['nombre'];
$dato0    = $row['idjd'];
$dato1    = $row['jd'];
$dato2    = $row['nombre_juez'];


//Datos Juzgado Ejecucion
			
$query = "SELECT * FROM juzgado_destino WHERE id = ".$dato0;

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1j = $row['nombre'];
$dato2j = $row['nombre_juez'];
$dato3j = $row['leyenda'];
                
$Leyenda = $dato3j;

					
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('P','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Aprobar Costas');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);


//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\ejecucion\views\tcpdf\examples\images
//$pdf->SetHeaderData('tcpdf_logo4.jpg', 68, '', '');
//$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins (LAS PARAMETRIZADAS POR LA LIBRERIA)
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//ASIGNADAS POR EL USUARIO
$pdf->SetMargins(20,5,20);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
//$pdf->SetFont('helvetica', 'B', 12);

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
if($dato0 == 1){

	$FIRMA_JUEZ ='<tr>
									  
					<td style="border-bottom-color:#FFFFFF"><img src="examples/images/fj1.png" width="200" height="40"/></td>
								
				</tr>';
			
}
//J2		
if($dato0 == 2){

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

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write(0, utf8_encode('INFORME SECRETARIAL'), '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, utf8_encode('A Despacho del se�or Juez el presente proceso el cual fue asignado a dicho Juzgado en virtud a lo dispuesto por el '.$Leyenda.' expedido por la Sala Administrativa del Consejo Superior de la Judicatura'), '', 0, 'J', true, 0, false, false, 0);
//$pdf->Ln(4);
//$pdf->Write(0, utf8_encode('Se encuentra pendiente de liquidaci�n de cr�dito presentada por la parte actora'), '', 0, 'J', true, 0, false, false, 0);
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('Manizales, '.$fecha_liqui), '', 0, 'L', true, 0, false, false, 0);
$pdf->Ln(4);

$pdf->SetFont('helvetica', 'B', 12);


$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(16);
$pdf->writeHTML($tbl_firma, false, false, false, false, 'C');
$pdf->Write(0, $secretario, '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, 'Secretario', '', 0, 'C', true, 0, false, false, 0);
					 
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('REP�BLICA DE COLOMBIA'), '', 0, 'C', true, 0, false, false, 0);

//$pdf->Image('examples/images/escudo.jpg', 98, 74, 15, 15, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

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
$fechafijacion_b = explode("-",$fecha_liqui_a_apc);

//DIA
$fechafijacion_c = $fechafijacion_b[2];
$dia_letra       = $funcion-> numtoletras_para_fecha($fechafijacion_c,1);

//A�O
$fechafijacion_d = $fechafijacion_b[0];
$dia_letra_2     = $funcion-> numtoletras_para_fecha($fechafijacion_d,1);

$fecha           = $dia_letra." (".$fechafijacion_c .") de ".strftime('%B', strtotime($fecha_liqui_a_apc))." de "." ".$dia_letra_2." (".$fechafijacion_d .")";
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
$pdf->Ln(4);
$pdf->SetFont('helvetica', '', 12);
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('Atendiendo la constancia secretarial que antecede, se AVOCA CONOCIMIENTO del presente proceso al cual se ordena imprimirle el tr�mite de rigor.'), '', 0, 'J', true, 0, false, false, 0);		
$pdf->Ln(4);
$pdf->Write(0, utf8_encode('Lo anterior, con ocasi�n a la creaci�n de este Juzgado mediante Acuerdo No. PSAA13-9962 de julio 31 de 2013 expedido por la Sala Administrativa del Consejo Superior de la Judicatura.'), '', 0, 'J', true, 0, false, false, 0);
$pdf->Ln(4);
//$pdf->Write(0, utf8_encode($dato8e), '', 0, 'J', true, 0, false, false, 0);	
$pdf->Write(0, utf8_encode(str_replace('<br />', PHP_EOL, $dato8e)), '', 0, 'J', true, 0, false, false, 0);	


$pdf->Ln(8);
$pdf->SetFont('helvetica','B',12);
/*$pdf->Write(0, utf8_encode('NOTIF�QUESE'), '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(16);
$pdf->MultiCell(0,6,$dato2,0,'C',false);
$pdf->Cell(0,6,'JUEZ',0,1,'C');*/
$pdf->writeHTML($tbl_noti, false, false, false, false, 'C');

//$pdf->AddPage();

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


$pdf->SetMargins(20,5,20);
$pdf->Ln(16);
$pdf->Cell(0,6,utf8_encode('Proyecto: oecm'),0,1,'L');


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
$pdf->Output('Avoca_Conocimiento.pdf', 'I');



?>