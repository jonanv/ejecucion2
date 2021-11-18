<?php
session_start(); 
set_time_limit (240000000);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

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


date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fechavisual = strftime('%d %B de %Y', strtotime($fecharegistro));

$horaregistro = date('g:i:s A');

/*$datos_pos = explode("******",$_GET['datos_pos']);
$posicion  = $datos_pos[0];
$estante   = $datos_pos[1];*/

$iddda_acta  = trim($_GET['iddda_acta']);

//$iddepartamento = $_SESSION['iddepartamento'];
//$idmunicipio    = $_SESSION['idmunicipio'];

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('L','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('RECIBIDO, ID MEMORIAL: '.$iddda_acta);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData('tcpdf_logo3.jpg', 68, '', '');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\ejecucion\views\tcpdf\examples\images
//$pdf->SetHeaderData('encabezadoacceso.png', 68, '', '');
//$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins (LAS PARAMETRIZADAS POR LA LIBRERIA)
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//ASIGNADAS POR EL USUARIO
$pdf->SetMargins(20,30,20);

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

// ---------------------------------------------------------

// //PARA EL RESTO TEXTO EN EL PDF 
$pdf->SetFont('helvetica', 'B', 9);

// add a page
$pdf->AddPage();

$pdf->Ln(4);


$pdf->Write(0, 'OFICINA DE EJECUCION CIVIL MUNICIPAL MANIZALES', '', 0, 'C', true, 0, false, false, 0);
//$pdf->Write(0, 'DIRECCION EJECUTIVA DE ADMINSITRACION JUDICIAL', '', 0, 'C', true, 0, false, false, 0);
//$pdf->Write(0, 'SECCIONAL CALDAS', '', 0, 'C', true, 0, false, false, 0);





	$query = "	
	
				SELECT t1.id,t2.radicado,t3.empleado,t1.fecha,t1.hora,t1.des,t1.ruta,t1.folios,
				t3.correo,t3.celular
				FROM ((expe_solicitud_memo t1
				INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
				INNER JOIN pa_usuario_expe      t3 ON t1.idsolicitante   = t3.id)
				WHERE t1.id = '$iddda_acta'
     		
			";	
					
					
	$sql   = mysql_query($query);
	
				
	 //$i= 1;
	//while($row = mysql_fetch_array($sql)){
	
	
		$row = mysql_fetch_array($sql);
		
		//$pdf->Write(0, 'ACTA DE RECIBIDO', '', 0, 'C', true, 0, false, false, 0);
		
		$pdf->Write(0, 'RECIBIDO', '', 0, 'L', true, 0, false, false, 0);
		
		$pdf->Ln(2);
		

		$d1M  = $row["id"];
		$d2M  = $row["radicado"];
		$d3M  = utf8_encode($row["empleado"]);
		$d4M  = $row["fecha"];
		$d5M  = $row["hora"];
		$d6M  = utf8_encode($row["des"]);
		
		$d7M    = explode("/",utf8_encode($row["ruta"]));
		$d7M_2  = explode("-",$d7M[3]);
		$d7M_3  = end($d7M_2);
		
		$d8M  = $row["folios"];
		
		$d9M  = utf8_encode($row["correo"])." / ".utf8_encode($row["celular"]);
		
		
		$tbl_1 = '
															
					<table border="1" cellpadding="2" cellspacing="1" nobr="true">

						
						
						
						<tr>
						
							<td style="width:300px">'.'ID MEMORIAL'.'</td>
							<td style="width:300px; text-align:left">'.$d1M.'</td>
							
						</tr>
						
						
						<tr>
						
							
							<td style="width:300px">'.'FECHA'.'</td>
							<td style="width:300px; text-align:left">'.$d4M.'</td>
							
								
						</tr>
						
						<tr>
						
							
							<td style="width:300px">'.'HORA'.'</td>
							<td style="width:300px; text-align:left">'.$d5M.'</td>
							
								
						</tr>
						
						<tr>
						
							<td style="width:300px">'.'RADICADO'.'</td>
							<td style="width:300px; text-align:left">'.$d2M.'</td>
							
						</tr>
						
						<tr>
						
							<td style="width:300px">'.'RESGISTRA'.'</td>
							<td style="width:300px; text-align:left">'.$d3M.'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:300px">'.'CORREO / CELULAR'.'</td>
							<td style="width:300px; text-align:left">'.$d9M.'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:300px">'.'TIPO SOLICITUD'.'</td>
							<td style="width:300px; text-align:left">'.$d6M.'</td>
								
						</tr>
						
						
						<tr>
						
							<td style="width:300px">'.'ARCHIVO'.'</td>
							<td style="width:300px; text-align:left">'.$d7M_3.'</td>
								
						</tr>
						
						
						
						<tr>
						
							<td style="width:300px">'.'FOLIOS'.'</td>
							<td style="width:300px; text-align:left">'.$d8M.'</td>
								
						</tr>
						
						
						
						
																
					</table>';
													
													
		$pdf->writeHTML($tbl_1, false, false, false, false, 'C');
							
					
		//}
		
		
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 

//Close and output PDF document
$pdf->Output('recibido.pdf', 'I');



?>