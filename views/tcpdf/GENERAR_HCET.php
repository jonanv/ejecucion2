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

$todo           = trim($_GET['todo']);
$id_encabezado  = trim($_GET['id_encabezado']);

$idradi_reporte = trim($_GET['idradi_reporte']);
$radi_reporte   = trim($_GET['radi_reporte']);


// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('L','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('CONTROL DE ENTREGA DE TITULOS');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\laborales\views\tcpdf\examples\images
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


if($todo == 0){



	$query = "SELECT * FROM hcet_encabezado 
	          WHERE idradicado = $idradi_reporte ";	
					
					
	$sql   = mysql_query($query);
					
	 //$i= 1;
	while($row = mysql_fetch_array($sql)){
	
	
		// add a page
		$pdf->AddPage();
		
		$pdf->Ln(4);
		
		$pdf->Write(0, 'CONTROL DE ENTREGA DE TITULOS', '', 0, 'C', true, 0, false, false, 0);
		
		$pdf->Ln(2);
		
		$pdf->Write(0, 'RAD. '.$radi_reporte, '', 0, 'C', true, 0, false, false, 0);
		
		$pdf->Ln(2);
		
		$d7M  = $row["obs"];
		$pdf->Write(0, 'OBSERVACION', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Ln(2);
		$pdf->Write(0, utf8_encode($d7M), '', 0, 'C', true, 0, false, false, 0);
		
		
		$pdf->Ln(10);
					
		$d1M  = $row["id"];
		$d2M  = $row["capital"];
		$d3M  = $row["ic"];
		$d4M  = $row["im"];
		$d5M  = $row["costas"];
		$d6M  = $row["atp"];
		
		$TOTAL  = $d2M + $d3M + $d4M + $d5M;
		
		$TOTAL_2 = $TOTAL - $d6M;
		
		$d6M  = $row["atp"];
		
		
		
							
		$tbl_1 = '
															
					<table border="1" cellpadding="2" cellspacing="1" nobr="true">

						
						
						
						<tr>
						
							<td style="width:100px">'.'CAPITAL'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d2M, 2, ',', '.').'</td>
							
						</tr>
						
						<tr>
						
							
							<td style="width:100px">'.'I.CORRIENTES'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d3M, 2, ',', '.').'</td>
							
								
						</tr>
						
						<tr>
						
							
							<td style="width:100px">'.'INTERESES MORATORIOS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d4M, 2, ',', '.').'</td>
							
								
						</tr>
						
						<tr>
						
							<td style="width:100px">'.'COSTAS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d5M, 2, ',', '.').'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:100px; background-color:#CDE3F6">'.'SUBTOTAL'.'</td>
							<td style="width:100px; text-align:right; background-color:#CDE3F6">'.number_format($TOTAL, 2, ',', '.').'</td>
								
						</tr>
						
						
						<tr>
						
							<td style="width:100px;">'.'ABONO O TITULOS YA PAGADOS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d6M, 2, ',', '.').'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:100px; background-color:#CDE3F6">'.'TOTAL'.'</td>
							<td style="width:100px; text-align:right; background-color:#CDE3F6">'.number_format($TOTAL_2, 2, ',', '.').'</td>
								
						</tr>
						
																
					</table>';
													
													
		$pdf->writeHTML($tbl_1, false, false, false, false, 'L');
							
		//$i= $i + 1;
		
	
		$pdf->Ln(5);
		
		
		
		//------------------------------------------------------------------------------------------------------------------------------------------------------
	
				
					$tbl_2 = '
							<table border="1" cellpadding="2" cellspacing="1" nobr="true">
								 
								
								 
								 <tr style="background-color:#CDE3F6">
										
										<th style="width:100px">FECHA EMISION</th>
										<th style="width:100px">ORDEN DE PAGO NUMERO</th>
										<th style="width:100px">VALOR TOTAL</th>
										<th style="width:100px">FECHA ENTREGA</th>
										<th style="width:100px">BENEFICIARIO</th>
										<th style="width:100px">SALDO</th>
										
										
								 </tr> 
								 
								 
							</table>';
					 
					 $pdf->writeHTML($tbl_2, false, false, false, false, 'L');
					  
		
					
					$query_2 = "SELECT * FROM titulos 
					            WHERE idhoja = '$d1M'";	
					
					
							  
					 $sql_2   = mysql_query($query_2);
					
					 $i= 0;
					 while($row_2 = mysql_fetch_array($sql_2)){
					
					
							$d1MD  = $row_2["id"];
							$d2MD  = $row_2["fecha"];
							$d3MD  = utf8_encode($row_2["orderpago"]);
							$d4MD  = $row_2["valor"];
							$d5MD  = $row_2["fechapago"];
							$d6MD  = utf8_encode($row_2["beneficiario"]);
							
							
							if($i == 0){
										
								$resultado_saldo =  $TOTAL_2 - $d4MD;
							}
							else{
											
								$resultado_saldo =  $resultado_saldo - $d4MD;
											
							}
							
							
							$tbl_3 = '
															
							<table border="1" cellpadding="2" cellspacing="1" nobr="true">
															
															
								<tr>
									
									<td style="width:100px">'.$d2MD.'</td>
									<td style="width:100px">'.$d3MD.'</td>
									<td style="width:100px">'.number_format($d4MD, 2, ',', '.').'</td>
									<td style="width:100px">'.$d5MD.'</td>
									<td style="width:100px">'.$d6MD.'</td>
									<td style="width:100px">'.number_format($resultado_saldo, 2, ',', '.').'</td>
									
								</tr>
																
							</table>';
													
													
							$pdf->writeHTML($tbl_3, false, false, false, false, 'C');
							
							
							$i= $i + 1;
					
					}
					
					
		}
								
							
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 

}
else{



	$query = "SELECT * FROM hcet_encabezado 
	          WHERE id = '$id_encabezado' AND idradicado = $idradi_reporte ";	
					
					
	$sql   = mysql_query($query);
					
	 //$i= 1;
	while($row = mysql_fetch_array($sql)){
	
	
		// add a page
		$pdf->AddPage();
		
		$pdf->Ln(4);
		
		$pdf->Write(0, 'CONTROL DE ENTREGA DE TITULOS', '', 0, 'C', true, 0, false, false, 0);
		
		$pdf->Ln(2);
		
		$pdf->Write(0, 'RAD. '.$radi_reporte, '', 0, 'C', true, 0, false, false, 0);
		
		$pdf->Ln(5);
		
		$d7M  = $row["obs"];
		$pdf->Write(0, 'OBSERVACION', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Ln(2);
		$pdf->Write(0, utf8_encode($d7M), '', 0, 'C', true, 0, false, false, 0);
		
		
		$pdf->Ln(10);
					
		$d1M  = $row["id"];
		$d2M  = $row["capital"];
		$d3M  = $row["ic"];
		$d4M  = $row["im"];
		$d5M  = $row["costas"];
		$d6M  = $row["atp"];
		
		$TOTAL  = $d2M + $d3M + $d4M + $d5M;
		
		$TOTAL_2 = $TOTAL - $d6M;
		
		$d6M  = $row["atp"];
		
		
		
							
		$tbl_1 = '
															
					<table border="1" cellpadding="2" cellspacing="1" nobr="true">

						
						
						
						<tr>
						
							<td style="width:100px">'.'CAPITAL'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d2M, 2, ',', '.').'</td>
							
						</tr>
						
						<tr>
						
							
							<td style="width:100px">'.'I.CORRIENTES'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d3M, 2, ',', '.').'</td>
							
								
						</tr>
						
						<tr>
						
							
							<td style="width:100px">'.'INTERESES MORATORIOS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d4M, 2, ',', '.').'</td>
							
								
						</tr>
						
						<tr>
						
							<td style="width:100px">'.'COSTAS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d5M, 2, ',', '.').'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:100px; background-color:#CDE3F6">'.'SUBTOTAL'.'</td>
							<td style="width:100px; text-align:right; background-color:#CDE3F6">'.number_format($TOTAL, 2, ',', '.').'</td>
								
						</tr>
						
						
						<tr>
						
							<td style="width:100px;">'.'ABONO O TITULOS YA PAGADOS'.'</td>
							<td style="width:100px; text-align:right">'.number_format($d6M, 2, ',', '.').'</td>
								
						</tr>
						
						<tr>
						
							<td style="width:100px; background-color:#CDE3F6">'.'TOTAL'.'</td>
							<td style="width:100px; text-align:right; background-color:#CDE3F6">'.number_format($TOTAL_2, 2, ',', '.').'</td>
								
						</tr>
						
																
					</table>';
													
													
		$pdf->writeHTML($tbl_1, false, false, false, false, 'L');
							
		//$i= $i + 1;
		
	
		$pdf->Ln(5);
		
		
		
		//------------------------------------------------------------------------------------------------------------------------------------------------------
	
				
					$tbl_2 = '
							<table border="1" cellpadding="2" cellspacing="1" nobr="true">
								 
								
								 
								 <tr style="background-color:#CDE3F6">
										
										<th style="width:100px">FECHA EMISION</th>
										<th style="width:100px">ORDEN DE PAGO NUMERO</th>
										<th style="width:100px">VALOR TOTAL</th>
										<th style="width:100px">FECHA ENTREGA</th>
										<th style="width:100px">BENEFICIARIO</th>
										<th style="width:100px">SALDO</th>
										
										
								 </tr> 
								 
								 
							</table>';
					 
					 $pdf->writeHTML($tbl_2, false, false, false, false, 'L');
					  
		
					
					$query_2 = "SELECT * FROM titulos 
					            WHERE idhoja = '$d1M'";	
					
					
							  
					 $sql_2   = mysql_query($query_2);
					
					 $i= 0;
					 while($row_2 = mysql_fetch_array($sql_2)){
					
					
							$d1MD  = $row_2["id"];
							$d2MD  = $row_2["fecha"];
							$d3MD  = utf8_encode($row_2["orderpago"]);
							$d4MD  = $row_2["valor"];
							$d5MD  = $row_2["fechapago"];
							$d6MD  = utf8_encode($row_2["beneficiario"]);
							
							
							if($i == 0){
										
								$resultado_saldo =  $TOTAL_2 - $d4MD;
							}
							else{
											
								$resultado_saldo =  $resultado_saldo - $d4MD;
											
							}
							
							
							$tbl_3 = '
															
							<table border="1" cellpadding="2" cellspacing="1" nobr="true">
															
															
								<tr>
									
									<td style="width:100px">'.$d2MD.'</td>
									<td style="width:100px">'.$d3MD.'</td>
									<td style="width:100px">'.number_format($d4MD, 2, ',', '.').'</td>
									<td style="width:100px">'.$d5MD.'</td>
									<td style="width:100px">'.$d6MD.'</td>
									<td style="width:100px">'.number_format($resultado_saldo, 2, ',', '.').'</td>
									
								</tr>
																
							</table>';
													
													
							$pdf->writeHTML($tbl_3, false, false, false, false, 'C');
							
							
							$i= $i + 1;
					
					}
					
					
		}
								
							
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 



}
//Close and output PDF document
$pdf->Output('hcet.pdf', 'I');



?>