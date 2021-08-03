<?php
session_start(); 

set_time_limit (0);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


$fechae_2A     = $_GET['fechae_2A'];

$fechacarga    = $_GET['fechae_2B'];
setlocale(LC_TIME, "Spanish");
$fechavisual   = strftime('%d %B de %Y', strtotime($fechacarga));

$nun_estado    = $_GET['nun_estado'];

//$juzgadoauto   = $_GET['juzgadoauto'];

$juzgadoauto_cadena = explode("******",$_GET['juzgadoauto']);
$juzgadoautoN  = $juzgadoauto_cadena[0];
$juzgadoauto   = $juzgadoauto_cadena[1];



// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf = new TCPDF('L','mm', 'legal', true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Estado '.$nun_estado);
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

//PARA QUE CARGUE LA IMAGEN DEBE IR UBICADA EN 
//C:\wamp\www\laborales\views\tcpdf\examples\images
$pdf->SetHeaderData('tcpdf_logo4.jpg', 68, '', '');
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

$pdf->Write(0, 'REPUBLICA DE COLOMBIA', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, 'RAMA JUDICIAL DEL PODER PUBLICO', '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, $juzgadoautoN, '', 0, 'C', true, 0, false, false, 0);

$header_ef = array('Estado Numero: '.$nun_estado,'', '','','',' Fecha: '.$fechavisual, '');
foreach($header_ef as $col_ef)
	$pdf->Cell(40,7,$col_ef,0);
$pdf->Ln();
				
//PARA EL TEXTO DE LA TABLA
$pdf->SetFont('helvetica', '', 11);


//------------------------------------------------------------------------------------------------------------------------------------------------------

				$serverName = "192.168.89.20"; //serverName\instanceName
				$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
				$conn = sqlsrv_connect( $serverName, $connectionInfo);
					 
				if( $conn ) { 
					// echo "Conectado a la Base de Datoss.<br />"; 
				}
				else{ 
					echo "NO se puede conectar a la Base de Datoss.<br />"; 
					die( print_r( sqlsrv_errors(), true)); 
				}

	
				$tbl = '
				<table border="1" cellpadding="2" cellspacing="1" nobr="true">
				 
				
				 
				 <tr  style="background-color:#E9E9E9">
					  <td style="width:132px">RADICADO</td>
					  <td>CLASE PROCESO</td>
					  <td>DEMANDANTE</td>
					  <td>DEMANDADO</td>
					  <td>ACTUACION</td>
					  <td>FECHA AUTO</td>
					 
				 </tr> 
				 
				</table>';
				 
				 $pdf->writeHTML($tbl, false, false, false, false, 'C');
				  
	
				$sql = (" 	SELECT t103.A103LLAVPROC AS RADICADO,
							t053.A053DESCCLAS AS CLASE_PROCESO,
							t103.A103NOMBPONE AS PONENTE,
							
							(SELECT TOP 1 [A112NOMBSUJE]
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') AS DEMANDANTE,
							
							(SELECT TOP 1 [A112NOMBSUJE]
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') AS DEMANDADO,
							
						
							t110.A110DESCACTU AS ACTUACION,
							
							CONVERT(VARCHAR(10), t110.A110FECHREGI, 103) AS FECHA_AUTO
							
							
							FROM (((T103DAINFOPROC t103 
							LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
							LEFT JOIN T101DAINFOPONE t101 ON (t101.A101CODIPONE = t103.A103CODIPONE 
							AND A101CODIENTI = '43' AND A101CODIESPE = '03')) 
							
							LEFT JOIN T110DRACTUPROC t110 ON t103.A103LLAVPROC = t110.A110LLAVPROC)
							
							WHERE t053.A053DESCCLAS NOT LIKE '%tutela%' AND t110.A110DESCACTU != 'Fijacion estado'
							
							/*AND t110.A110FECHREGI >= '$fechae_2A' AND t110.A110FECHREGI <= '$fechae_2A'*/
							AND CONVERT(VARCHAR(10), t110.A110FECHREGI, 121) >= '$fechae_2A' AND CONVERT(VARCHAR(10), t110.A110FECHREGI, 121) <= '$fechae_2A' 
							AND $juzgadoauto
							AND t110.A110CODIPROV IN (002,0020,0021,0022)
							ORDER BY t103.A103LLAVPROC");		  
		
							//AND t101.A101CODIPONE = '$juzgadoauto'
							
							$params  = array();
							$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
							$stmt    = sqlsrv_query( $conn, $sql , $params, $options );
							
							$row_count = sqlsrv_num_rows( $stmt );
									
							if ($row_count === false){
								echo "Error in retrieveing row count. En Consulta";
							}
							else{
					
								while( $row = sqlsrv_fetch_array( $stmt)){
									
					
					
					
									$RADICADO              = trim($row['RADICADO']);
									$CLASE_PROCESO         = trim($row['CLASE_PROCESO']);
									$DEMANDANTE            = trim($row['DEMANDANTE']);
									$DEMANDADO             = trim($row['DEMANDADO']);
									$DESCRIPCION_ACTUACION = trim($row['ACTUACION']);
									$FECHA_AUTO            = trim($row['FECHA_AUTO']);
									
									
										
									$tbl_2 = '
												
												<table border="1" cellpadding="2" cellspacing="1" nobr="true">
												
													<tr>
														<td style="width:132px; font-size:10px;">'.$RADICADO.'</td>
														<td>'.utf8_encode($CLASE_PROCESO).'</td>
														<td>'.utf8_encode($DEMANDANTE).'</td>
														<td>'.utf8_encode($DEMANDADO).'</td>
														<td>'.utf8_encode($DESCRIPCION_ACTUACION).'</td>
														<td>'.$FECHA_AUTO.'</td>
														
														
														
													</tr>
													
												</table>';
										
										
										
									$pdf->writeHTML($tbl_2, false, false, false, false, 'C');
										
		
																	 
								}//FIN WHILE while	
							
							}
					
										
								
				
			
							$tbl_3 = '
												
									<table border="0">
				
										<tr>
											
											<td colspan="7"></td>
											
										</tr>								
										<tr>
											
											<td colspan="7" valign="bottom" style="text-align:center"><img src="firmasecre.png" width="291" height="174"/></td>
											
										</tr>
													
									</table>';
										
												
										
									
							$pdf->writeHTML($tbl_3, false, false, false, false, '');
				
			

		
			

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('estado.pdf', 'I');



?>