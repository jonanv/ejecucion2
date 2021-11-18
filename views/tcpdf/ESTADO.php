<?php
session_start(); 

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');


$fechae_2A     = $_POST['fechae_2A'];

$fechacarga    = $_POST['fechae_2B'];
setlocale(LC_TIME, "Spanish");
$fechavisual   = strftime('%d %B de %Y', strtotime($fechacarga));

$nun_estado    = $_POST['nun_estado'];

//$juzgadoauto   = $_POST['juzgadoauto'];
$juzgadoauto_cadena = explode("******",$_POST['juzgadoauto']);
$juzgadoauto   = $juzgadoauto_cadena[0];


//CAMBIO REALIZADO EL 14 DE ENERO 2021
						
//SE REALIZA AJUSTE EN LA $RUTA_AUTO YA QUE AL SUBIR LOS ARCHIVOS PDF AL PORTAL DE LA RAMA JUDICIAL
//NO ESTAN QUEDANDO CON LA EXTENSION .PDF VISIBLE, ES DECIR DE ESTA FORMA
//https://www.ramajudicial.gov.co/documents/2858635/57714973/1-2018-00545.pdf SI NO DE ESTA
//https://www.ramajudicial.gov.co/documents/2858635/57714973/1-2018-00545
//Y NO ES POSIBLE VISUALIZAR EL ARCHIVO, ENTONCES SE DEBE CONCATENAR EN EL CAMPO RUTA AUTOS:
//DEL LA VISTA siepro_estado_masivo_autos.php DE ESTA FORMA
//documents/2858635/59212286/5-2020-00153/04420934-5302-416d-a1f4-afc9505f3cb8

$ruta_dinamica = $_POST['ruta_auto'];

/*$ruta_dinamica_completa = explode(";",$_POST['ruta_auto']);
$ruta_dinamica          = $ruta_dinamica_completa[0];
$ruta_dinamica_2        = $ruta_dinamica_completa[1];*/


//$ruta_dinamica = "/documents/2858635/12619711";
//$directorio    = opendir("AUTOS/2017/JUZGADO 2/MARZO/24 de marzo");
//$carpeta       = "CARGAMASIVA";

$directorio    = opendir("C:/AUTOS_ESTADOS");
$carpeta       = "C:/CARGAMASIVA";
$nom           = trim($_SESSION['idUsuario']);


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
//C:\wamp\www\ejecucion\views\tcpdf\examples\images
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
$pdf->Write(0, $juzgadoauto, '', 0, 'C', true, 0, false, false, 0);

$header_ef = array('Estado Numero: '.$nun_estado,'', '','','',' Fecha: '.$fechavisual, '');
foreach($header_ef as $col_ef)
	$pdf->Cell(40,7,$col_ef,0);
$pdf->Ln();
				
//PARA EL TEXTO DE LA TABLA
$pdf->SetFont('helvetica', '', 11);


//------------------------------------------------------------------------------------------------------------------------------------------------------


		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($carpeta."/".$nom)){$bandera=0;}
		else{mkdir($carpeta."/".$nom, 0, true);}
		
		//datos del arhivo 
		$nombre_archivo = $_FILES['archivo']['name']; 
		$tipo_archivo   = $_FILES['archivo']['type'];
		$tamano_archivo = $_FILES['archivo']['size'];
		
		
		
		if (! (strpos($tipo_archivo, "vnd.ms-excel")) && ($tamano_archivo < 100000000) )  { 
			
			
			//echo "**********ERROR**********LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA"." NOMBRE: ".$nombre_archivo." TIPO: ".$tipo_archivo." TAMANO: ".$tamano_archivo;
			
			echo '<script languaje="JavaScript"> 
			
	
				alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA");
				
				location.href="index.php?controller=archivo&action=Registrar_Estado_Masivo_Autos";
						
			</script>';
			
			
		}
		else{//1 
		
			
			
			if ( file_exists($carpeta."/".$nom.'/'.$nombre_archivo) ) {
				
			
				$idunico = time();
					
				$nombre_archivo = $idunico."_".$nombre_archivo;
				
				
			}
			
			
			if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta."/".$nom.'/'.$nombre_archivo) ){
			
				$lineas = file( $carpeta."/".$nom.'/'.$nombre_archivo,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				$long   = count($lineas);
				

				//OBTNER SEPARAR DE LOS REGISTROS YA QUE EN UNOS EQUIPOS DE COMPUTO ES ---> COMA(,)
				//Y EN OTROS ---> PUNTO Y COMA (;)
				//$separador = $modelo->Obtener_Separador( trim($lineas[1]) );
		
				 /*<tr>
				  	  <th colspan="7" align="center">ESTADOS</th>
				 </tr>*/
				
				//writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
				
				$tbl = '
				<table border="1" cellpadding="2" cellspacing="1" nobr="true">
				 
				
				 
				 <tr  style="background-color:#E9E9E9">
					  <td style="width:132px">RADICADO</td>
					  <td>CLASE PROCESO</td>
					  <td>DEMANDANTE</td>
					  <td>DEMANDADO</td>
					  <td>ACTUACION</td>
					  <td>FECHA AUTO</td>
					  <td>AUTO</td>
				 </tr> 
				 
				</table>';
				 
				 $pdf->writeHTML($tbl, false, false, false, false, 'C');
				  
	
				//ASI CUANDO EL ARCHIVO NO TIENE ENCABEZADOS
				$i=0;
				
				//while($i < $long){
				while ($archivo = readdir($directorio)){
									
					//echo $lineas[$i]."\n";
									
					//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR COMAS
					//$fila = explode(",",$lineas[$i]);
									
					//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR PUNTO Y COMA
					$fila = explode(";",$lineas[$i]);
									
					//$fila = explode($separador,$lineas[$i]);
									
					//strtoupper //PARA PASAR A MAYUSCULAS
					//strtolower //PARA PASAR A MINUSCULAS
					
					
					$RADICADO              = trim($fila[0]);
					$CLASE_PROCESO         = trim($fila[1]);
					$DEMANDANTE            = trim($fila[2]);
					$DEMANDADO             = trim($fila[3]);
					$DESCRIPCION_ACTUACION = trim($fila[4]);
					$FECHA_AUTO            = trim($fila[5]);
					
					
					if (is_dir($archivo)){//verificamos si es o no un directorio
						//echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
					}
					else{
						
					
						
						
						//-------------ENCONTRAR LA LETRA X EN EL NOMBRE DEL ARCHIVO Y BORRARLA EJ: x12-2016-00373-1 --------------------------------
				
						/*$findme   = 'x';
						$pos      = strpos($archivo, $findme);
						
						if ($pos === false) {
						
							$nuevo_archivo = strtoupper($archivo);
						} 
						else {//ELIMINA CARACTER
						
							$nuevo_archivo = substr(strtoupper($archivo), 1);
						}*/
						
						//-------------FIN ENCONTRAR LA LETRA X EN EL NOMBRE DEL ARCHIVO Y BORRARLA --------------------------------
						
						//CAMBIO REALIZADO EL 14 DE ENERO 2021
						
						//SE REALIZA AJUSTE EN LA $RUTA_AUTO YA QUE AL SUBIR LOS ARCHIVOS PDF AL PORTAL DE LA RAMA JUDICIAL
						//NO ESTAN QUEDANDO CON LA EXTENSION .PDF VISIBLE, ES DECIR DE ESTA FORMA
						//https://www.ramajudicial.gov.co/documents/2858635/57714973/1-2018-00545.pdf SI NO DE ESTA
						//https://www.ramajudicial.gov.co/documents/2858635/57714973/1-2018-00545
						//Y NO ES POSIBLE VISUALIZAR EL ARCHIVO, ENTONCES SE DEBE CONCATENAR EN EL CAMPO RUTA AUTOS:
						//DEL LA VISTA siepro_estado_masivo_autos.php DE ESTA FORMA
						///documents/2858635/59212286/5-2020-00153/04420934-5302-416d-a1f4-afc9505f3cb8
						
						
						$RUTA_AUTO = "https://www.ramajudicial.gov.co".$ruta_dinamica."/".$archivo;
						
						//$RUTA_AUTO = "https://www.ramajudicial.gov.co".$ruta_dinamica."/".$archivo."/".$ruta_dinamica_2;
						
						//AQUI LA TABLA HTML
						//writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
						

						//NOTA: SE PONE utf8_encode POR QUE SI EL CAMPO TIENE TILDE NO NO SE MUESTRA EN EL REPORTE
						//TODO EL REGISTRO
						//El elemento HTML <nobr> previene que una línea de texto se divida en una nueva línea, 
						//así, se presentará en una línea larga por lo que puede ser necesario hacer un
						//desplazamiento de pantalla. Esta etiqueta no es un estándar HTML y no debería ser usada, 
						//en su lugar use la propiedad CSS white-space como en este ejemplo:
						//<span style="white-space: nowrap">Línea larga sin saltos</span>
						
						//MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false) {
						
												
						//--------------DE ESTA FORMA SE CREA UNA TABALA CON LA FUNCION CELDA------------------------
						//FUNCIONA PERO EL TEXTOLARGO NO SE SOBREESCRIBE EN LA SIGUIENTE CELDA
					
						//FUNCION CELDA
						//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
						
						$tbl_2 = '
								
								<table border="1" cellpadding="2" cellspacing="1" nobr="true">
								
									<tr>
										<td style="width:132px; font-size:10px;">'.$RADICADO.'</td>
										<td>'.utf8_encode($CLASE_PROCESO).'</td>
										<td>'.utf8_encode($DEMANDANTE).'</td>
										<td>'.utf8_encode($DEMANDADO).'</td>
										<td>'.utf8_encode($DESCRIPCION_ACTUACION).'</td>
										<td>'.$FECHA_AUTO.'</td>
										
										<td><a href="'.$RUTA_AUTO.'"><img src="estados.jpg" width="163" height="55"/></a></td>
										
									</tr>
									
								</table>';
						
						//writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
						
						$pdf->writeHTML($tbl_2, false, false, false, false, 'C');
						
					
						$i= $i + 1;
						
						
																	 
					}//FIN WHILE while($i < $long){		
					
										
								
				}//FIN ELSE	 DEL IF if (is_dir($archivo)){			
				
				
				
					
			}//FIN DEL if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta."/".$nom.'/'.$nombre_archivo) ){
			
			
			
			//$pdf->Image('firmasecre.png',150 ,$pdf->GetY() + 10, 60 , 50,'PNG','')
			
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
				
			

		}//FIN ELSE 1
			

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
//Close and output PDF document
$pdf->Output('estado.pdf', 'I');



?>