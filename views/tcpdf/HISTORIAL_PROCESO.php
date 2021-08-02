<?php
session_start(); 
set_time_limit (240000000);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

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


date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fechavisual = strftime('%d %B de %Y', strtotime($fecharegistro));

$horaregistro = date('g:i:s A');

/*$datos_pos = explode("******",$_GET['datos_pos']);
$posicion  = $datos_pos[0];
$estante   = $datos_pos[1];*/
// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('L','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('OBSERVACIONES PROCESO');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->SetFont('helvetica', 'B', 11);

// add a page
$pdf->AddPage();

$pdf->Ln(4);

$pdf->Write(0, 'OBSERVACIONES DEL PROCESO', '', 0, 'C', true, 0, false, false, 0);

$pdf->Ln(10);

$header_ef = array('Fecha: '.$fechavisual." / Hora: ".$horaregistro, '');
foreach($header_ef as $col_ef)
	$pdf->Cell(40,7,$col_ef,0);
$pdf->Ln();

/*$header_ef = array('PRESTAMOS / DEVOLUCIONES', '');
foreach($header_ef as $col_ef)
	$pdf->Cell(40,7,$col_ef,0);
$pdf->Ln();*/

$id = trim($_GET['id']);



$strConsulta = "SELECT t1.id,t2.radicado,t1.fecha,t1.observacion,t3.empleado
				FROM ((detalle_correspondencia t1
				INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
				INNER JOIN pa_usuario t3 ON t1.idusuario = t3.id)
				WHERE t1.idcorrespondencia = '$id'
				ORDER BY t1.id DESC";		
		

$canalsql = mysql_query($strConsulta);
$numfilas = mysql_num_rows($canalsql);

$header_ef = array('TOTAL: '.trim($numfilas), '');
foreach($header_ef as $col_ef)
	$pdf->Cell(40,7,$col_ef,0);
$pdf->Ln();




//PARA EL TEXTO DE LA TABLA
$pdf->SetFont('helvetica', '', 7);


//------------------------------------------------------------------------------------------------------------------------------------------------------

				/*<th style="width:60px; font-size:10px;">FEC PRES</th>
						<th style="width:30px; font-size:10px;">H</th>
						<th style="width:30px; font-size:10px;">DIAS</th>
						<th style="width:80px; font-size:10px;">FEC VENCI</th>*/
			
				$tbl = '
				<table border="1" cellpadding="2" cellspacing="1" nobr="true">
				 
				
				 
				 <tr style="background-color:#CDE3F6">
				 	  	
					  	<th style="width:30px; font-size:10px;">ID</th>
						<th style="width:100px; font-size:10px;">RADICADO</th>
						
						<th style="width:100px; font-size:10px;">FECHA</th>
						<th style="width:100px; font-size:10px;">OBSERVACION</th>
						
						<th style="width:100px; font-size:10px;">REGISTRA</th>
						
					  
					  
				 </tr> 
				 
				</table>';
				 
				 $pdf->writeHTML($tbl, false, false, false, false, 'C');
				  
	
				
				 $query = " SELECT t1.id,t2.radicado,t1.fecha,t1.observacion,t3.empleado
							FROM ((detalle_correspondencia t1
							INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
							INNER JOIN pa_usuario t3 ON t1.idusuario = t3.id)
							WHERE t1.idcorrespondencia = '$id'
							ORDER BY t1.id DESC";
							
						  
				 $sql   = mysql_query($query);
				
				 $i= 1;
				 while($fila = mysql_fetch_array($sql)){
				 
				 
				 				 
						$d1M  = $fila["id"];
						$d2M  = $fila["radicado"];
						$d3M  = $fila["fecha"];
						$d4M  = $fila["observacion"];
						$d5M  = $fila["empleado"];
						
						
					
						$tbl_2 = '
															
							<table border="1" cellpadding="2" cellspacing="1" nobr="true">
															
															
								<tr>
								
								
									<td style="width:30px">'.$d1M.'</td>
									<td style="width:100px">'.$d2M.'</td>
									
									<td style="width:100px">'.$d3M.'</td>
									<td style="width:100px">'.$d4M.'</td>
									
									<td style="width:100px">'.$d5M.'</td>
									
									
									
									
								</tr>
																
							</table>';
												
						
						
												
						$pdf->writeHTML($tbl_2, false, false, false, false, 'C');
						
						$i= $i + 1;
				
				}
							
							
							
								
								
							
							

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('historial.pdf', 'I');



?>