<?php
class empleadoswordModel extends modelBase
{


	/************************ Se obtiene los datos del documento *************************************/

	public function Obtener_Datos_Documento($iddoc){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT * FROM empleado_permiso
										  WHERE id = '$iddoc'");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Oficina(){
	
			  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar; 
	
   }
   
   public function Obtener_Datos_Solicitante(){
	
		$idusuario  = $_SESSION['idUsuario'];  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario pu WHERE pu.id = '$idusuario'");
		
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
}/*Cierra Model*/

?>

<?php

$opcion = $_GET['opcion'];
$iddoc  = $_GET['id'];

if($opcion == 1){

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new empleadoswordModel();
	
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
	
	
	$vector_datos = $data->Obtener_Datos_Documento($iddoc);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $vector_datos->fetch() ){
			
			$datos0  = $field[fecha_solicitud];
			$datos1  = $field[fecha_permiso];
			$datos2  = $field[hora_inicio];
			$datos3  = $field[hora_final];
			$datos4  = $field[detalle];
			$datos5  = $field[fecha_aprobacion];
			

	}
	
	$dato_solicitante = $data->Obtener_Datos_Solicitante();
	while( $field = $dato_solicitante ->fetch() ){
			
			$datol1 = $field[nombre_usuario];
			$datol2 = $field[empleado];
			//$datol3 = $field[cargo];

	}
	
	
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMAÑO OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '11906',
						'pageSizeH'   => '16838',
						/*'pageSizeW'   => '12241',
						'pageSizeH'   => '20160',*/
					);

	$section = $PHPWord->createSection($sectionStyle);
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	$fontStyleB  = array ('size'=>11);
	$paraStyleB2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleC  = array ('bold' => true,'size'=>11);
	$paraStyleC2 = array ('align' => 'left');
	
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
	$styleCell   = array('valign'=>'center');
	$styleCellCombinadas  = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas2 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas3 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezadoX.png', array('width'=>599, 'height'=>79, 'align'=>'center'));
	//$table->addCell(4500)->addText('Centro de Servicios Judiciales Manizales Civil - Familia',$fontStyle1, $fontStyle1);
	//----------------------------------------------------------------------------------------------------------------------
	

	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************INICIO OFICIOS*********************************************************************
	
	
			//NOMBRE ARCHIVO
			$datos1na = "PermisoAprobado";
			
			//$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//fecha, FUNCION -->ucwords — Convierte a mayúsculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fechaamd = $data->get_fecha_actual_amd();
			$fecha = strftime('%B %d de %Y', strtotime($fechaamd));  
			$section->addText("Manizales, ".ucwords($fecha),$fontStyleB, $paraStyleB2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "Fecha Solicitud: ";           $campofila2 = $datos0;}
				if($conttabla == 1){$campofila = "Fecha Permiso: ";             $campofila2 = $datos1;}
				if($conttabla == 2){$campofila = "Fecha Aprobación: ";          $campofila2 = $datos5;}
				if($conttabla == 3){$campofila = "Hora Inicial - Hora Final: "; $campofila2 = $datos2." - ".$datos3;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow(500);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
				
				$conttabla = $conttabla + 1;
			}
			
			
			//----------------------------------------------------------------------------------------------------------------------
			
		
			$section->addTextBreak(1);
			
			$section->addText("Doctor(a)",$fontStyleB, $paraStyleB2);
			$section->addText($datoofi6,$fontStyleB, $paraStyleB2);
			$section->addText("Coordinador(a)",$fontStyleB, $paraStyleB2);
			$section->addText($datoofi1,$fontStyleB, $paraStyleB2);
			
	
			$section->addTextBreak(1);
			
			$section->addText("Asunto: SOLICITUD DE PERMISO", $fontStyleB, $paraStyleB2);
			
			/*$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);*/
			
			$section->addTextBreak(1);
			
			$section->addText($datos4, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Agradezco su amable atención.", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
					
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			
			$section->addText($datol2,$fontStyleB, $paraStyleB2);
			$section->addText("C.C. No ".$datol1,$fontStyleB, $paraStyleB2);
			//$section->addText($datol3,$fontStyleB, $paraStyleB2); //CARGO, SE CIERRA POR QUE EN LA TABLA PA_USUARIO NO ESTA ESTA COLUMNA
			
			$section->addTextBreak(1);
			
			$section->addText("FIRMA: "."____________________________",$fontStyleB, $paraStyleB2);
			$section->addText($datoofi6,$fontStyleB, $paraStyleB2);
			$section->addText("Coordinador(a)",$fontStyleB, $paraStyleB2);
			$section->addText($datoofi1,$fontStyleB, $paraStyleB2);
			
	
		//************************************************FIN OFICIOS*********************************************************************
	//------------------------------------------------------------------------------------------------------------------------------
	
	//pie de página
	$footer = $section->createFooter();
	$table  = $footer->addTable();
	$table->addRow();
	//$table->addCell(2000)->addImage('views/images/piepagina2.jpg', array('width'=>488, 'height'=>79, 'align'=>'right'));
	$table->addCell(2000)->addImage('views/images/piedepagina.jpg', array('width'=>599, 'height'=>49, 'align'=>'right'));
	//$footer->addPreserveText('Carrera 23 N° 21-48- Palacio de Justicia "Fanny González Franco" Oficina 108 - Teléfono 8879665 Manizales, Caldas',$fontStyle1, $fontStyle1);
	

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$datos1na.'.doc');
	$file      = 'views/word/'.$datos1na.'.docx';
	$id        = $datos1na.'.docx';
	
	//$datos1 = "xxxxx";
	//$objWriter->save('views/word/'.$datos1.'.doc');
	//$file      = 'views/word/'.$datos1.'.docx';
	//$id        = $datos1.'.docx';
	
	$enlace = $file; 
	
	$enlace = 'views/word/'.$datos1na.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}

?>