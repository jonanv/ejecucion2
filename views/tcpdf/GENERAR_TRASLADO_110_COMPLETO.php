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

//Datos Oficina
			
$query = "SELECT * FROM pa_datos_oficina";

$sql = mysql_query($query);
$row = mysql_fetch_array($sql);
			
$dato1ofi   = $row['secretario'];
$secretario = utf8_encode($dato1ofi);

					
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('P','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TRASLADO EN LISTA 110');
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


setlocale(LC_TIME, "Spanish");

$datospartes_m110 = explode("******",trim($_GET['datospartes_m110']));
$longtras110      = count($datospartes_m110);
$x                = 1;



while($x < $longtras110){

	$datospartes_m110_B = explode("//////",$datospartes_m110[$x]);
	
	$id                 = trim($datospartes_m110_B[1]);
	$fechafijacion      = trim($datospartes_m110_B[2]);
	$fechainicial       = trim($datospartes_m110_B[3]);			
	$fechafinal         = trim($datospartes_m110_B[4]);
	
	//DAR FORMATO A LAS FECHAS
	$fechaf = strftime('%d de %B del %Y', strtotime($fechafijacion)); 
	$fecha  = strftime('%d de %B del %Y', strtotime($fechainicial));
	$fechab = strftime('%d de %B del %Y', strtotime($fechafinal));
	

	//PARA EL RESTO TEXTO EN EL PDF 
	$pdf->SetFont('helvetica', 'B', 12);
	
	// add a page
	$pdf->AddPage();
	
	//$pdf->Ln(4);
	
	
	
	
	/*$tbl_escudo = '
			<table>
					 
				<tr>
						  
					<td style="border-bottom-color:#FFFFFF"><img src="examples/images/escudo.jpg" width="66" height="56"/></td>
					
				</tr>
		 
			</table>';*/
			
	
	
	//NUEVA HOJA TRASLADO 110 COMPLETO
	
	
	
	$pdf->SetMargins(20,5,20);
	$pdf->SetFont('helvetica','B',12);
	
	$pdf->Ln(4);
	$pdf->Cell(0,6,utf8_encode('REP�BLICA DE COLOMBIA'),0,1,'C');
	$pdf->Ln(10);
	$pdf->Image('examples/images/escudo.jpg' , 98 ,15, 20 , 15,'JPG', '');
	
	
	$pdf->Ln(10);
	$pdf->MultiCell(0,6,'OFICINA DE EJECUCION CIVIL MUNICIPAL',0,'C',false);
	$pdf->MultiCell(0,6,'MANIZALES - CALDAS',0,'C',false);
	
	$pdf->Ln(8);
	$pdf->MultiCell(0,6,'TRASLADO EN LISTA 110',0,'C',false);
	
	
	//Datos Proceso
	$query = "SELECT t2.nombre,t1.demandante,t1.demandado,t1.radicado
			  FROM (ubicacion_expediente t1 
			  LEFT JOIN pa_clase_proceso t2 ON t1.idclase_proceso = t2.id)
			  WHERE t1.id = '$id'";			
	
	
	$sql      = mysql_query($query);
	$numfilas = mysql_num_rows($sql);
	
	for ($i=0; $i<$numfilas; $i++){
	
		$row      = mysql_fetch_array($sql);
					
		$dato1pro = utf8_encode($row['radicado']);
		$dato2pro = utf8_encode($row['demandante']);
		$dato3pro = utf8_encode($row['demandado']);
		$dato4pro = utf8_encode($row['nombre']);
		
		
		
		
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
						<td style="width:250px; text-align:left">'.$fechaf.'</td>
					
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
						<td style="width:250px; text-align:left">'.utf8_encode('T�rmino que empieza a correr el '.$fecha.' a las 8:00 a.m. y vence el '.$fechab.' a las 6:00 p.m.').'</td>
					
					</tr>
						 
				</table>';
				
						 
		$pdf->writeHTML($tbl_5, false, false, false, false, 'C');
		
		
		
		
		$pdf->Ln(12);
		
		$tbl_firma = '<table>
								 
							<tr>
									  
								<td style="border-bottom-color:#FFFFFF"><img src="examples/images/firmasecre_2.png" width="200" height="80"/></td>
								
							</tr>
					 
						</table>';
		
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
							 
						<td style="width:250px; text-align:left">'.utf8_encode('C�digo: F-TLC-01').'</td>
						<td style="width:250px; text-align:left">'.utf8_encode('Versi�n: 01').'</td>
					</tr>
				
					
				</table>';
						 
		$pdf->writeHTML($tbl_6, false, false, false, false, 'C');

		
		
	}//FIN FOR
	
	
	$x = $x + 1;
	
	
	
}//FIN while($x < $longtras110)





//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('T110.pdf', 'I');



?>