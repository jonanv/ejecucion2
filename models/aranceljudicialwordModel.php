<?php
class aranceljudicialwordModel extends modelBase
{


	/************************ Se obtiene los datos del documento *************************************/
   public function Obtener_Datos_Oficina(){
	
			  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar; 
	
   }  	
    
   /*public function Obtener_Consecutivo_Oficio(){
   
   
   
   		$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,d.sigla
									  FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
									  INNER JOIN pa_documento d ON td.iddocumento = d.id)
									  WHERE di.id IN(
												     SELECT MAX(di.id) AS idmaximo
													 FROM ((documentos_internos di INNER JOIN pa_tipodocumento td ON di.idtipodocumento = td.id)
													 INNER JOIN pa_documento d ON td.iddocumento = d.id) WHERE d.id = '1'
												  )
										AND d.id = '1'");
	
		$listar->execute();
					
		$resultado = $listar->rowCount();

		if(!$resultado){//existe registros
	
			$field = $listar->fetch();
					
			$numeroconsecutivo = explode("-",$field[numero]);
			$consecutivo       = $numeroconsecutivo[1] + 1; 
						
			if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
			if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
			$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
		}
		else{//no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL AÑO YA QUE LOS DATOS EN LA TABLA
			 //documentos_internos SON NULL Y EL NUMERO QUEDARIA DE ESTA FORMA -001,-002 
					
			$field  = $listar->fetch();
			
			$modelo = new aranceljudicialwordModel();
						
			$year   = $modelo->get_ano();
						
			$numeroconsecutivo = explode("-",$field[numero]);
			$consecutivo       = $numeroconsecutivo[1] + 1; 
						
			if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
			if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
			$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
			
		}
		
		return $ndocumento; 
   
   }*/
   
   public function Obtener_Datos_Liquidaciones_Copias($fi,$ff){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT ald.numlde AS num,al.fechal AS fecha,ali.nombrearancel AS arancel,
										  TRUNCATE(ald.cantidadde / ald.paginasde,0) AS valorunitario,ald.paginasde AS numerocopias,ald.cantidadde AS valor,ald.idarancelde
										  FROM ((arancel_detalle_liquidacion ald INNER JOIN arancel_pa_item ali ON ald.idarancelde = ali.id)
										  INNER JOIN arancel_liquidacion al ON ald.numlde = al.numl)
										  WHERE (fechal >= '$fi' AND fechal <= '$ff')");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Total_Copias($fi,$ff){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT SUM(ald.paginasde) AS totalcopias
										  FROM ((arancel_detalle_liquidacion ald INNER JOIN arancel_pa_item ali ON ald.idarancelde = ali.id)
										  INNER JOIN arancel_liquidacion al ON ald.numlde = al.numl)
										  WHERE (fechal >= '$fi' AND fechal <= '$ff')");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Total_Valor_Copias($fi,$ff){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT SUM(ald.cantidadde) AS valortotalcopias
										  FROM ((arancel_detalle_liquidacion ald INNER JOIN arancel_pa_item ali ON ald.idarancelde = ali.id)
										  INNER JOIN arancel_liquidacion al ON ald.numlde = al.numl)
										  WHERE (fechal >= '$fi' AND fechal <= '$ff')");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }
   
   public function get_fecha_actual_amd(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
  }
   
   public function get_ano(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('y'); 
		
		return $fecharegistro; 

   }
   

}/*Cierra Model*/

?>

<?php

$opcion = $_GET['opcion'];
$fechai = $_GET['dato_1'];
$fechaf = $_GET['dato_2'];

if($opcion == 1){

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new aranceljudicialwordModel();
	
	$datosoficina = $data->Obtener_Datos_Oficina();
	
	//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
	//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
	while( $filao = $datosoficina->fetch() ){
	
			$datoofi1  = $filao[nombre];
			$datoofi2  = $filao[sigla];
			$datoofi3  = $filao[direccion];
			$datoofi4  = $filao[telefono];
			$datoofi5  = $filao[secretario];
			$datoofi6  = $filao[coordinadora];
			$datoofi7  = $filao[director];
	}
	
	
	//OBTENER DATOS
	//$datos1 = $data->Obtener_Consecutivo_Oficio();
	$datos8 = $data->get_fecha_actual_amd();
	
	$datoscopias = $data->Obtener_Datos_Liquidaciones_Copias($fechai,$fechaf);
	
	
	$tcopias  = $data->Total_Copias($fechai,$fechaf);
	
	while( $tfila = $tcopias->fetch() ){
	
			$tc = $tfila[totalcopias];
	}
	
	$tvcopias = $data->Total_Valor_Copias($fechai,$fechaf);
	
	while( $tvfila = $tvcopias->fetch() ){
	
			$tvc = $tvfila[valortotalcopias];
	}
	
	
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMAÑO OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',
						'pageSizeH'   => '20160',
					);

	$section = $PHPWord->createSection($sectionStyle);
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	$fontStyleB  = array ('size'=>11);
	$paraStyleB2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleC  = array ('bold' => true,'size'=>11);
	$paraStyleC2 = array ('align' => 'left');
	
	$fontStyleCB  = array ('bold' => true,'size'=>11);
	$paraStyleC2B = array ('align' => 'center');
	
	$fontStyleD  = array ('bold' => true,'size'=>11);
	$paraStyleD2 = array ('align' => 'left');
	
	$fontStyleE  = array ('bold' => true,'size'=>6);
	$paraStyleE2 = array ('align' => 'center');
	
	$fontStyleF  = array ('size'=>6);
	$paraStyleF2 = array ('align' => 'both');
	
	//PARA PONER COLOR A UNA SECCION
    $fontStyleP = array('size' => 11, 'color' => 'EC1A12', 'bold' => true);
	
	//PARA LAS TABLAS
	$fontStyleT  = array ('bold' => true,'size'=>9);
	$paraStyleT2 = array ('align' => 'center');
	
	$fontStyleTB   = array ('bold' => false,'size'=>6);
	$paraStyleTB2  = array ('align' => 'left');
	$paraStyleTB2B = array ('align' => 'both');
	
	$fontStyleTC  = array ('bold' => true,'size'=>8);
	$paraStyleTC2 = array ('align' => 'center');
	
	// Define cell style arrays
	$styleCell    = array('valign'=>'center');
	$styleCell2   = array('valign'=>'center','bgColor'=>'FFFFFF');
	$styleCellCombinadas  = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas2 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas3 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezadoX2.png',  array('width'=>200, 'height'=>80, 'align'=>'center'));
	//$table->addCell(6800)->addText('Rama Judicial del Poder Público Oficina de apoyo para los Juzgados Civiles Municipales de Ejecución de Sentencias de Manizales',$fontStyleLOGO, $paraStyleLOGO2);
	$table->addCell(3800)->addImage('views/images/encabezadoX4.png',  array('width'=>280, 'height'=>60, 'align'=>'center'));
	$table->addCell(2000)->addImage('views/images/encabezadoX3.png',  array('width'=>70, 'height'=>70, 'align'=>'center'));
	
	//----------------------------------------------------------------------------------------------------------------------
	

	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************FIN OFICIOS*********************************************************************
	
	
			$section->addText("OFICIO No.", $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords — Convierte a mayúsculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText("Manizales, ".ucwords($fecha),$fontStyleB, $paraStyleB2);
			
			$fechai = strftime('%B %d de %Y', strtotime($fechai)); 
			$fechaf = strftime('%B %d de %Y', strtotime($fechaf)); 
			
			
			$section->addTextBreak(1);
			
			$section->addText("Doctor",$fontStyleB, $paraStyleB2);
			$section->addText($datoofi7,$fontStyleD, $paraStyleD2);
			$section->addText("Director Seccional de Administración Judicial",$fontStyleB, $paraStyleB2);
			$section->addText("Manizales", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Asunto: Reporte de Arancel Judicial",$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Por medio de la presente me permito reportarle los recaudos de dinero por concepto de ARANCEL JUDICIAL, los cuales fueron recibidos en esta oficina por el servicio de fotocopia desde ".$fechai." hasta ".$fechaf." del presente año, tal como se ilustra en la siguiente tabla.", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
	
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			
			$encabezados = 5;
			
			while($encabezados < 6){
			
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'000000', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
					
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow(500);
			
		
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText("NUM",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("FECHA",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("ARANCEL",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("V.UNITARIO",$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell)->addText("N. COPIAS",$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell)->addText("VALOR",$fontStyleCB, $paraStyleC2B);
				
				$encabezados = $encabezados + 1;
			}
			
			while( $filac = $datoscopias->fetch() ){
	
				$dator1  = $filac[num];
				$dator2  = $filac[fecha];
				$dator3  = $filac[arancel];
				$dator4  = $filac[valorunitario];
				$dator5  = $filac[numerocopias];
				$dator6  = $filac[valor];
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'000000', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
					
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow(500);
				
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell2)->addText($dator1,$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell2)->addText($dator2,$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell2)->addText($dator3,$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell2)->addText($dator4,$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell2)->addText($dator5,$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell2)->addText(number_format($dator6, 0, ',', '.'),$fontStyleCB, $paraStyleC2B);
				
			}
			
			$encabezados = 5;
			
			while($encabezados < 6){
			
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'000000', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'DEDEDE');
					
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow(500);
			
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText("",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("",$fontStyleC, $paraStyleC2);
				$table1->addCell(2000, $styleCell)->addText("TOTAL",$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell)->addText(number_format($tc, 0, ',', '.'),$fontStyleCB, $paraStyleC2B);
				$table1->addCell(2000, $styleCell)->addText(number_format($tvc, 0, ',', '.'),$fontStyleCB, $paraStyleC2B);
				
				$encabezados = $encabezados + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("Agradezco de antemano su amable colaboración.",$fontStyleB, $paraStyleB2);
					
			$section->addTextBreak(2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
					
			$section->addText($datoofi6,$fontStyleA, $paraStyleA2);
			$section->addText("DIRECTORA DE LA OFICINA DE EJECUCIÓN CIVIL MUNICIAL",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(2);
			
			//CUENTA ANTERIOR
			//$section->addText("Anexo: Recibo original de la consignación a la cuenta 0013-0442-92-0200792958 del Banco BBVA, Reporte detallado por día y radicado de proceso de las copias realizadas.",$fontStyleB, $paraStyleB2);
			
			//CUENTA NUEVA CAMBIO REALIZADO EN EL CODIGO POT JORGE ANDRES VALENCIA EL 6 DE ABRIL 2016
			$section->addText("Anexo: Recibo original de la consignación a la cuenta 3-082-00-00636-6 del Banco Agrario de Colombia S.A, Reporte detallado por día y radicado de proceso de las copias realizadas.",$fontStyleB, $paraStyleB2);
			
			
			
		
		
	//------------------------------------------------------------------------------------------------------------------------------
	
	//pie de página
	$footer = $section->createFooter();
	$table  = $footer->addTable();
	$table->addRow();
	//$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>488, 'height'=>79, 'align'=>'right'));
	$table->addCell(2000)->addImage('views/images/piedepagina.jpg', array('width'=>599, 'height'=>49, 'align'=>'right'));
	//$footer->addPreserveText('Carrera 23 N° 21-48- Palacio de Justicia "Fanny González Franco" Oficina 108 - Teléfono 8879665 Manizales, Caldas',$fontStyle1, $fontStyle1);
	$footer->addPreserveText("Código: O-GJ-28"."                                        "."Versión: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
	

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.'ArancelJudicial'.'.doc');
	$file      = 'views/word/'.'ArancelJudicial'.'.docx';
	$id        = 'ArancelJudicial'.'.docx';
	
	//$datos1 = "xxxxx";
	//$objWriter->save('views/word/'.$datos1.'.doc');
	//$file      = 'views/word/'.$datos1.'.docx';
	//$id        = $datos1.'.docx';
	
	$enlace = $file; 
	
	$enlace = 'views/word/'.'ArancelJudicial'.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}

?>