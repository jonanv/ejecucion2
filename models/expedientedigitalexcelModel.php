<?php
class expedientedigitalexcelModel extends modelBase{


	public function listar_proceso_digital($id_radi,$id_cuaderno){
	
	
			set_time_limit (240000000);
			
			
			
			$sql = "
						SELECT
						t1.id,t1.idradicado,t1.fecha,t1.hora,t1.folios,
						t1.folio_i,t1.folio_f,t1.cuaderno,
						t1.foto,t1.tipo,t1.ruta,t1.des,t1.idusuario,
						t2.empleado AS registra,
						CONCAT(t3.empleado,'/',t1.fechaedita,'/',t1.horaedita) AS edita,
						t4.id AS idcuaderno,t4.des AS descuaderno,t4.orden,t1.idcorrespondencia,t5.id_memo_externo,t6.nombre AS dependencia,
						t1.fecha_creacion,t1.fecha_de,t1.fecha_a,t1.origen,t1.obs,t7.origen AS norigen,t1.orden_documento
						FROM ((((((expe_digital t1
						INNER JOIN pa_usuario     t2 ON t1.idusuario         = t2.id)
						LEFT JOIN pa_usuario      t3 ON t1.idusuarioedita    = t3.id)
						LEFT JOIN expe_cuaderno   t4 ON t1.cuaderno          = t4.id)
						LEFT JOIN correspondencia t5 ON t1.idcorrespondencia = t5.id)
						LEFT JOIN pa_juzgado      t6 ON t1.id_dependencia    = t6.id)
						LEFT JOIN expe_origen     t7 ON t1.origen            = t7.id)
						WHERE t1.idradicado = '$id_radi'
						AND t1.estado != 3
						AND t1.cuaderno = '$id_cuaderno'
						ORDER BY t4.orden,t1.orden_documento
						
					";
											
											
		$listar    = $this->db->prepare($sql);
											
	
  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_datos_oficina(){
	
		$sql = "SELECT * FROM pa_datos_oficina";
											
											
		$listar    = $this->db->prepare($sql);
											
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_proceso($id_radi){
	
		$sql = "SELECT t1.id,t1.radicado,t1.demandante,t1.demandado,
				t2.nombre AS claseproceso,t3.nombre AS juzgado,t4.nombre AS juzgadoreparto
				FROM (((ubicacion_expediente t1
				LEFT JOIN pa_clase_proceso t2 ON t1.idclase_proceso = t2.id)
				LEFT JOIN pa_juzgado t3 ON t1.idjuzgado = t3.id)
				LEFT JOIN pa_juzgado t4 ON t1.iddespacho = t4.idjxxi)
				WHERE t1.id = '$id_radi'";
											
											
		$listar    = $this->db->prepare($sql);
											
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_nuevo_nombreVISUAL($nombre_archivoX,$orden_documento_siguente){
	
	
		$caracterY  = 0;
		$caracterM  = 0;
		$caracterD  = 0;
		$caracterH  = 0;
		$caracterMI = 0;
		$caracterS  = 0;
		
	
		$bandera_fecha    = 0;
		
		$nombre_archivo   = explode(".",$nombre_archivoX);
		//NOMBRE ARCHIVO SI EXTENSION
		//EJ: 200911121732-01-201900151OrdenaAOECMNotificarADemandado-Decreto720210036900
		$nombre_archivo_2 = $nombre_archivo[0];
		//SE DIVIDE EL ARCHIVO POR CARACTER "-"
		//EJ: 200911121732	01	201900151OrdenaAOECMNotificarADemandado	Decreto720210036900
		$nombre_archivo_3 = explode("-",$nombre_archivo_2);
		
		$nuevo_nombre_archivo = "";
		
		for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
			//echo $nombre_archivo_3[$x]."<br>"."<br>";
			
			$idcaracter = $nombre_archivo_3[$x];
			
			if( strlen($idcaracter) == 12 ){
		
				for($y = 0; $y < strlen($idcaracter); $y = $y + 2) {
					
					$caracterX = $idcaracter[$y].$idcaracter[$y + 1];
					
					//YEAR
					if($y == 0){
					
					
						if($caracterX >= 20){
							
							$caracterY  = 1;
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MES
					if($y == 2){
					
						if($caracterX >= 0 && $caracterX <= 12){
							
							$caracterM  = 1;	
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//DIA
					if($y == 4){
					
						if($caracterX >= 0 && $caracterX <= 31){
							
							$caracterD  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//HORA
					if($y == 6){
					
						if($caracterX >= 0 && $caracterX <= 12){
							
							$caracterH  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MINUTOS
					if($y == 8){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterMI  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//SEGUNDOS
					if($y == 10){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterS  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					
					
				}
				
				//ES IDENTIFICAR DEL FORMATO date('ymdhis')
				if($caracterY == 1 && $caracterM == 1 && $caracterD == 1 && $caracterH == 1 && $caracterMI == 1 && $caracterS == 1) {
					 
					 $bandera_fecha = 1;
				} 
				else{
				
					 $nuevo_nombre_archivo .= $idcaracter;
				}
	
			
			}//FIN if( strlen($nombre_archivo_3[$x]) == 12 ){
			else{
			
				$nuevo_nombre_archivo .= $idcaracter;
			}
			
			$caracterY  = 0;
			$caracterM  = 0;
			$caracterD  = 0;
			$caracterH  = 0;
			$caracterMI = 0;
			$caracterS  = 0;
			
			
		}//FOR PRINCIPAL for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
		
							
		return trim($nuevo_nombre_archivo);
									
		
	}
	
	public function get_cuadernos($id_radi){
	
		$sql = "SELECT t1.cuaderno,t2.des
				FROM expe_digital t1
				INNER JOIN expe_cuaderno t2 ON t1.cuaderno = t2.id
				WHERE t1.idradicado = '$id_radi'
				GROUP BY t1.cuaderno";
												
												
		$listar = $this->db->prepare($sql);
											
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function Obtener_Parte_Radicado($radi){
	
	
		$valorradicado   = trim($radi);

		/*$valorradicado_2 = substr($valorradicado, 0, 21);
		$valorradicado_3 = substr($valorradicado, 12, 4);
		$valorradicado_4 = substr($valorradicado, 16, 5);
		$valorradicado_5 = substr($valorradicado, 5, 2);
		$valorradicado_6 = substr($valorradicado, 7, 2);
		$valorradicado_7 = substr($valorradicado, 9, 3);//NUMERO JUZGADO 001....012
		$valorradicado_8 = substr($valorradicado, 10, 2);//NUMERO JUZGADO 001....012
		
		echo $valorradicado_2."<br>".$valorradicado_3."<br>".$valorradicado_4."<br>".$valorradicado_5."<br>".$valorradicado_6."<br>".$valorradicado_7."<br>".$valorradicado_8."<br>";*/ 
		
		$numero_juzgado = 0;
		$cadena_juzgado = 0;
		$valorradicado_8 = substr($valorradicado, 10, 2);
		// Recorremos cada carácter de la cadena
		for($i=0; $i<strlen($valorradicado_8); $i++){
			// Mostramos cada uno de los caracteres...
			// con $cadena[0] se muestra el primera caracter, [1], el segundo, etc...
			//echo "<br>".$valorradicado_8[$i];
			
			
			if($valorradicado_8[0] == 0){
				
				//$cadena_juzgado = "SON EL JUZGADO: ".$valorradicado_8[1];
				
				$cadena_juzgado = substr($valorradicado, 11, 13);
				
				$numero_juzgado = 0;
				
				$i = strlen($valorradicado_8);
			}
			
			if($valorradicado_8[0] == 1){
				
				//$cadena_juzgado = "SON EL JUZGADO: ".$valorradicado_8[0]."".$valorradicado_8[1];
				
				$cadena_juzgado = substr($valorradicado, 10, 13);
				
				$numero_juzgado = 1;
				
				$i = strlen($valorradicado_8);
			}
			
			
		}
		
		if($numero_juzgado == 0){
		
			//echo $cadena_juzgado;
			
			return substr($cadena_juzgado,0,-2);
		
		}
		
		if($numero_juzgado == 1){
		
			//echo $cadena_juzgado;
			
			return substr($cadena_juzgado,0,-2);
		
		}
	
	
	}


}

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//---------------------LINEA AGREGADA POR JORGE ANDRES VALENCIA OROZCO----------------------------------

//OPCION REPORTE
$opcion       = trim($_GET['opcion']);
$tfiltro      = trim($_GET['tfiltro']);
$id_radi      = trim($_GET['datox1']);
$id_cuaderno  = trim($_GET['datox2']);
$des_cuaderno = trim($_GET['datox3']);

$d6M          = $id_cuaderno;

//------------------------------------------------------------------------------------------------------

//PRUEBA EXCEL CON IMAGEN
if($opcion == 1){

	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	// Set properties
	$objPHPExcel->getProperties()->setCreator("Jobin Jose");
	$objPHPExcel->getProperties()->setLastModifiedBy("Jobin Jose");
	$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
	$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHPExcel classes.");
	
	// Add some data
	// echo date('H:i:s') . " Add some data\n";
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
	$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');
	//$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Hello');
	$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'world!');
	$objPHPExcel->getActiveSheet()->setTitle('Simple');
	
	$gdImage = imagecreatefromjpeg('views/images/cavernicola.jpg');
	// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Sample image');
	$objDrawing->setDescription('Sample image');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(150);
	$objDrawing->setCoordinates('C1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="imagen.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
	/*$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	// Echo done
	echo date('H:i:s') . " Done writing file.\r\n";*/


}

if($opcion == 2){

	$data = new expedientedigitalexcelModel();
	
	$vector_datos  = $data->listar_proceso_digital($id_radi,$id_cuaderno);
	
	$datos_oficina_1 = $data->get_datos_oficina();
	$datos_oficina_2 = $datos_oficina_1->fetch();
	$ciudad          = $datos_oficina_2[municipio];	
	
	$datos_proceso_1 = $data->get_datos_proceso($id_radi);
	$datos_proceso_2 = $datos_proceso_1->fetch();
	$radicado        = ucfirst(strtolower($datos_proceso_2[radicado]));
	$demandante      = ucfirst(strtolower($datos_proceso_2[demandante]));
	$demandado       = ucfirst(strtolower($datos_proceso_2[demandado]));
	$claseproceso    = ucfirst(strtolower($datos_proceso_2[claseproceso]));
	//SE CIERRA POR QUE EL JUZGADO QUE SE NECESITA VISUALIZAR ES EL JUZGADO DE REPARTO Y NO ORIGEN
	//$juzgado         = ucfirst(strtolower($datos_proceso_2[juzgado]));
	$juzgado         = ucfirst(strtolower($datos_proceso_2[juzgadoreparto]));
	
	
	
	$objPHPExcel = new PHPExcel();
	
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
	)
	);
	
	$styleArray_2 = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  '000000' ), 
	'size'   =>  12 
	)
	);
	
	$borders = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);
		
	$borders_nobold = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);	
		
	$borders_nobold_2 = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  10 
	));	
		
	// Agregar Informacion Encabezados Excel
	
	$sheet1=$objPHPExcel->setActiveSheetIndex(0);
	
	//---------------IMAGEN--------------------------------------------------------------------
	
	$gdImage = imagecreatefromjpeg('views/images/encabezado.jpg');
	// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(72);
	//$objDrawing->setWidth(200);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
	
	//----------------------------------------------------------------------------------------
	
	$sheet1->setCellValue('B'.'3', utf8_encode('ÍNDICE ELECTRÓNICO DEL EXPEDIENTE JUDICIAL'));
	//$sheet1->getStyle('B'.'3')->applyFromArray($borders_nobold);
	//$sheet1->getStyle('B'.'3')->applyFromArray($borders_nobold);
	$sheet1->mergeCells('B'.'3'.':'.'B'.'3');
	
	$sheet1->getStyle('B'.'3'.':'.'B'.'3')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => 'FFFFFF'),
				'endcolor'   => array('rgb' => 'FFFFFF')
	
				)
	);
	
	$sheet1->getStyle('B'.'3'.':'.'B'.'3')->applyFromArray($styleArray_2);
	$sheet1->getStyle('B'.'3'.':'.'B'.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	

	$i = 6;
	
	$sheet1->setCellValue('A'.'6', 'Ciudad');
	$sheet1->getStyle('A'.'6')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'6', utf8_encode(ucwords(strtolower($ciudad))));
	$sheet1->getStyle('B'.'6')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'7', 'Despacho Juicial');
	$sheet1->getStyle('A'.'7')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'7', utf8_encode(ucwords(strtolower($juzgado))));
	$sheet1->getStyle('B'.'7')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'8', 'Serie o Subserie Documental');
	$sheet1->getStyle('A'.'8')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'8', utf8_encode(ucwords(strtolower($claseproceso))));
	$sheet1->getStyle('B'.'8')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'9', utf8_encode('No. Radicación del Proceso'));
	$sheet1->getStyle('A'.'9')->applyFromArray($borders_nobold);
	
	$sheet1->getCell('B'. '9')->setValueExplicit($radicado,PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('B'.'9')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'10', 'Partes Procesales (Parte A)');
	$sheet1->getStyle('A'.'10')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'10', utf8_encode(ucwords(strtolower($demandado))));
	$sheet1->getStyle('B'.'10')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'11', 'Partes Procesales (Parte B)');
	$sheet1->getStyle('A'.'11')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'11', utf8_encode(ucwords(strtolower($demandante))));
	$sheet1->getStyle('B'.'11')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'12', 'Terceros Intervinientes');
	$sheet1->getStyle('A'.'12')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'12', utf8_encode(''));
	$sheet1->getStyle('B'.'12')->applyFromArray($borders_nobold);
		
	$sheet1->setCellValue('A'.'13', 'Cuaderno');
	$sheet1->getStyle('A'.'13')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.'13', utf8_encode(ucwords(strtolower($des_cuaderno))));
	$sheet1->getStyle('B'.'13')->applyFromArray($borders_nobold);
		
		
	
	$sheet1->setCellValue('D'.$i, utf8_encode('EXPEDIENTE FÍSICO'));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	$sheet1->mergeCells('D'.$i.':'.'E'.$i);
	
	$sheet1->getStyle('D'.$i.':'.'E'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => 'FFFFFF'),
				'endcolor'   => array('rgb' => 'FFFFFF')
	
				)
	);
	
	$sheet1->getStyle('D'.$i.':'.'E'.$i)->applyFromArray($styleArray_2);
	$sheet1->getStyle('D'.$i.':'.'E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$sheet1->setCellValue('D'.'7', utf8_encode('El expediente judicial posee expedientes físicos'));
	$sheet1->getStyle('D'.'7')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.'7', utf8_encode('NO'));
	$sheet1->getStyle('E'.'7')->applyFromArray($borders_nobold);
	$sheet1->getStyle('E'.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	
	$sheet1->setCellValue('D'.'8', utf8_encode('No. De carpetas (cuadernos) o tomos.'));
	$sheet1->getStyle('D'.'8')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.'8', utf8_encode('0'));
	$sheet1->getStyle('E'.'8')->applyFromArray($borders_nobold);
	$sheet1->getStyle('E'.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	
	$sheet1->setCellValue('D'.'9', utf8_encode('No. De carpetas (cuadernos) o tomos digitalizados.'));
	$sheet1->getStyle('D'.'9')->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.'9', utf8_encode('0'));
	$sheet1->getStyle('E'.'9')->applyFromArray($borders_nobold);
	$sheet1->getStyle('E'.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	
	$sheet1->setCellValue('A'.'15', 'Nombre documento');
	$sheet1->setCellValue('B'.'15', utf8_encode('Fecha Creación'));
	$sheet1->setCellValue('C'.'15', utf8_encode('Fecha Incorporación'));
	$sheet1->setCellValue('D'.'15', 'Orden');
	$sheet1->setCellValue('E'.'15', utf8_encode('Número Páginas'));
	$sheet1->setCellValue('F'.'15', utf8_encode('Página Inicio'));
	$sheet1->setCellValue('G'.'15', utf8_encode('Página Fin'));
	$sheet1->setCellValue('H'.'15', 'Formato');
	$sheet1->setCellValue('I'.'15', utf8_encode('Tamaño'));
	$sheet1->setCellValue('J'.'15', 'Origen');
	$sheet1->setCellValue('K'.'15', 'Observaciones');
	
	
	$sheet1->getStyle('A'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('B'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('C'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('D'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('E'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('F'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('G'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('H'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('I'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('J'.'15')->applyFromArray($styleArray_2);
	$sheet1->getStyle('K'.'15')->applyFromArray($styleArray_2);
	
	//'startcolor' => array('rgb' => '2F709F')
	$sheet1->getStyle('A15:K15')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '999999'),
				'endcolor' => array('rgb' => '999999')
	
				)
	);
	
	$sheet1->getStyle('A15:K15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$i=16;
	
	
	$Ct110=1;
			
	$inicio   = 1;
	$inicio2  = 1;
	$inicio3  = 1;
	$inicio4  = 1;
	$inicio5  = 1;
	$inicio6  = 1;
	$inicio7  = 1;
	$inicio8  = 1;
	$inicio9  = 1;
	$inicio10 = 1;
	$inicio11 = 1;
	$inicio12 = 1;
	$inicio13 = 1;
	$inicio14 = 1;
	$inicio15 = 1;
	$inicio16 = 1;
	$inicio17 = 1;
	$inicio18 = 1;
	$inicio19 = 1;
	$inicio20 = 1;
	$inicio21 = 1;
	$inicio22 = 1;
	$inicio23 = 1;
	$inicio24 = 1;
	$inicio25 = 1;
	$inicio26 = 1;
	$inicio27 = 1;
	$inicio28 = 1;
	$inicio29 = 1;
	$inicio30 = 1;
	$inicio31 = 1;
	$inicio32 = 1;
	$inicio33 = 1;
	$inicio34 = 1;
	$inicio35 = 1;
	$inicio36 = 1;
	$inicio37 = 1;
	$inicio38 = 1;
	$inicio39 = 1;
	$inicio40 = 1;
	
	
	
	while($field = $vector_datos->fetch() )
	{
	
		//VARIABLE USADA PARA ARMAR EL NOMBRE DEL ARCHIVO QUE SE DESCARGA
		//00IndiceElectronicoC01, 00IndiceElectronicoC02 etc
		$idcuaderno = $field[idcuaderno];
		
		//NOMBRE DOCUMENTO
		$nombre_documento  = explode("/",$field[ruta]);	
	    $nombre_documentoB = utf8_encode($nombre_documento[3]);
		$nombre_documentoC = $data->get_nuevo_nombreVISUAL($nombre_documentoB,$field[orden_documento]);
		
		//FORMATO
		$formato_1 = explode(".",$nombre_documentoB);
		$formato_2 = strtoupper(utf8_encode($formato_1[1]));
		
		//TAMAÑO
		$tamano = filesize($field[ruta]);
				
		//$sheet1->setCellValue('A'.$i, $nombre_documentoC);
		$sheet1->getCell('A'.$i)->setValueExplicit($nombre_documentoC,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//FECHA CREACION
		//Digitalizado
		if($field[origen] == 1){
						
			$fecha_creacion = "De: ".$field[fecha_de]." a: ".$field[fecha_a]; 
			
			$origen_proc    = "Digitalizado";
						
		}
		//Electronico
		if($field[origen] == 2){
						
			$fecha_creacion = $field[fecha_creacion];
			
			$origen_proc    = "Electrónico";
						
		}
		
		
		//----------------------PAGINA INICIAL - FINAL-------------------
		
			
		
			$d4M  = $field[folios];
			
			unset($d4M_2);
			
			
			if( $Ct110 ==1 ){
			
				
					//SE ADICIONA ESTA PARTE CONE EL OBJETO
					//QUE SEGUN EL ID DE CUADERNO, SE UBIQUE
					//EN EL INICIO DE SUMA CORRESPONDIENTE
					
					//CUADERNO PRINCIPAL
					if ( $d6M == 1 ){
					
						$sumaP = $sumaP + $d4M;
						
						$d4M_2 = "$inicio - $sumaP";
						
						
						$inicio = $sumaP  + 1;
						
					}
					
					
					//CUADERNO DE MEDIDAS
					if ( $d6M == 2 ){
					
						$suma2P  = $suma2P + $d4M;
						
						$d4M_2   = "$inicio2 - $suma2P";
						
						
						$inicio2 = $suma2P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
					
					//ACUMULADA 1 CUADERNO PRINCIPAL
					if ( $d6M == 3 ){
					
						$suma3P  = $suma3P + $d4M;
						
						$d4M_2   = "$inicio3 - $suma3P";
						
						
						$inicio3 = $suma3P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO PRINCIPAL
					if ( $d6M == 4 ){
					
						$suma4P  = $suma4P + $d4M;
						
						$d4M_2   = "$inicio4 - $suma4P";
						
						
						$inicio4 = $suma4P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO PRINCIPAL
					if ( $d6M == 5 ){
					
						$suma5P  = $suma5P + $d4M;
						
						$d4M_2   = "$inicio5 - $suma5P";
						
						
						$inicio5 = $suma5P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO PRINCIPAL
					if ( $d6M == 6 ){
					
						$suma6P  = $suma6P + $d4M;
						
						$d4M_2   = "$inicio6 - $suma6P";
						
						
						$inicio6 = $suma6P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO PRINCIPAL
					if ( $d6M == 7 ){
					
						$suma7P  = $suma7P + $d4M;
						
						$d4M_2   = "$inicio7 - $suma7P";
						
						
						$inicio7 = $suma7P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
					
					//ACUMULADA 1 CUADERNO DE MEDIDAS
					if ( $d6M == 8 ){
					
						$suma8P  = $suma8P + $d4M;
						
						$d4M_2   = "$inicio8 - $suma8P";
						
						
						$inicio8 = $suma8P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO DE MEDIDAS
					if ( $d6M == 9 ){
					
						$suma9P  = $suma9P + $d4M;
						
						$d4M_2   = "$inicio9 - $suma9P";
						
						
						$inicio9 = $suma9P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO DE MEDIDAS
					if ( $d6M == 10 ){
					
						$suma10P  = $suma10P + $d4M;
						
						$d4M_2   = "$inicio10 - $suma10P";
						
						
						$inicio10 = $suma10P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO DE MEDIDAS
					if ( $d6M == 11 ){
					
						$suma11P  = $suma11P + $d4M;
						
						$d4M_2   = "$inicio11 - $suma11P";
						
						
						$inicio11 = $suma11P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO DE MEDIDAS
					if ( $d6M == 12 ){
					
						$suma12P  = $suma12P + $d4M;
						
						$d4M_2   = "$inicio12 - $suma12P";
						
						
						$inicio12 = $suma12P  + 1;
						
					}
					
					//OTROS
					
					//CUADRNO PRINCIPAL INCIDENTE 1
					if ( $d6M == 13 ){
					
						$suma13P  = $suma13P + $d4M;
						
						$d4M_2   = "$inicio13 - $suma13P";
						
						
						$inicio13 = $suma13P  + 1;
						
					}
					
					//CUADRNO DE MEDIDAS INCIDENTE 1
					if ( $d6M == 14 ){
					
						$suma14P  = $suma14P + $d4M;
						
						$d4M_2   = "$inicio14 - $suma14P";
						
						
						$inicio14 = $suma14P  + 1;
						
					}
					
					//RECURSOS
					if ( $d6M == 15 ){
					
						$suma15P  = $suma15P + $d4M;
						
						$d4M_2   = "$inicio15 - $suma15P";
						
						
						$inicio15 = $suma15P  + 1;
						
					}
					
					//CUADERNO DE RESTITUCION
					if ( $d6M == 16 ){
					
						$suma16P  = $suma16P + $d4M;
						
						$d4M_2   = "$inicio16 - $suma16P";
						
						
						$inicio16 = $suma16P  + 1;
						
					}
					
					//CUADERNO SECUESTRE
					if ( $d6M == 17 ){
					
						$suma17P  = $suma17P + $d4M;
						
						$d4M_2   = "$inicio17 - $suma17P";
						
						
						$inicio17 = $suma17P  + 1;
						
					}
					
					//CUADERNO CONFLICTO DE COMPETENCIAS
					if ( $d6M == 18 ){
					
						$suma18P  = $suma18P + $d4M;
						
						$d4M_2   = "$inicio18 - $suma18P";
						
						
						$inicio18 = $suma18P  + 1;
						
					}
					
					//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
					if ( $d6M == 19 ){
					
						$suma19P  = $suma19P + $d4M;
						
						$d4M_2    = "$inicio19 - $suma19P";
						
						
						$inicio19 = $suma19P  + 1;
						
					}
					
					//CUADERNO DE TITULOS
					if ( $d6M == 20 ){
					
						$suma20P  = $suma20P + $d4M;
						
						$d4M_2    = "$inicio20 - $suma20P";
						
						
						$inicio20 = $suma20P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 2
					if ( $d6M == 21 ){
					
						$suma21P  = $suma21P + $d4M;
						
						$d4M_2    = "$inicio21 - $suma21P";
						
						
						$inicio21 = $suma21P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 3
					if ( $d6M == 22 ){
					
						$suma22P  = $suma22P + $d4M;
						
						$d4M_2    = "$inicio22 - $suma22P";
						
						
						$inicio22 = $suma22P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 4
					if ( $d6M == 23 ){
					
						$suma23P  = $suma23P + $d4M;
						
						$d4M_2    = "$inicio23 - $suma23P";
						
						
						$inicio23 = $suma23P  + 1;
						
					}
					
					//DESPACHO COMISORIO
					if ( $d6M == 24 ){
					
						$suma24P  = $suma24P + $d4M;
						
						$d4M_2    = "$inicio24 - $suma24P";
						
						
						$inicio24 = $suma24P  + 1;
						
					}
					
					//CUADERNO PRUEBAS
					if ( $d6M == 25 ){
					
						$suma25P  = $suma25P + $d4M;
						
						$d4M_2    = "$inicio25 - $suma25P";
						
						
						$inicio25 = $suma25P  + 1;
						
					}
					
					//CUADERNO DE SUPROGACION
					if ( $d6M == 26 ){
					
						$suma26P  = $suma26P + $d4M;
						
						$d4M_2    = "$inicio26 - $suma26P";
						
						
						$inicio26 = $suma26P  + 1;
						
					}
					
					//CUADERNO EXCEPCIONES PREVIAS
					if ( $d6M == 27 ){
					
						$suma27P  = $suma27P + $d4M;
						
						$d4M_2    = "$inicio27 - $suma27P";
						
						
						$inicio27 = $suma27P  + 1;
						
					}
					
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 28 ){
					
						$suma28P  = $suma28P + $d4M;
						
						$d4M_2    = "$inicio28 - $suma28P";
						
						
						$inicio28 = $suma28P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 2
					if ( $d6M == 29 ){
					
						$suma29P  = $suma29P + $d4M;
						
						$d4M_2    = "$inicio29 - $suma29P";
						
						
						$inicio29 = $suma29P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 3
					if ( $d6M == 30 ){
					
						$suma30P  = $suma30P + $d4M;
						
						$d4M_2    = "$inicio30 - $suma30P";
						
						
						$inicio30 = $suma30P  + 1;
						
					}
					
					//CUADERNO IMPEDIMENTO
					if ( $d6M == 31 ){
					
						$suma31P  = $suma31P + $d4M;
						
						$d4M_2    = "$inicio31 - $suma31P";
						
						
						$inicio31 = $suma31P  + 1;
						
					}
					
					//CUADERNO MONITORIO
					if ( $d6M == 32 ){
					
						$suma32P  = $suma32P + $d4M;
						
						$d4M_2    = "$inicio32 - $suma32P";
						
						
						$inicio32 = $suma32P  + 1;
						
					}
					
					//CUADERNO TUTELA
					if ( $d6M == 33 ){
					
						$suma33P  = $suma33P + $d4M;
						
						$d4M_2    = "$inicio33 - $suma33P";
						
						
						$inicio33 = $suma33P  + 1;
						
					}
					
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 34 ){
					
						$suma34P  = $suma34P + $d4M;
						
						$d4M_2    = "$inicio34 - $suma34P";
						
						
						$inicio34 = $suma34P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL DE RESTITUCION
					if ( $d6M == 35 ){
					
						$suma35P  = $suma35P + $d4M;
						
						$d4M_2    = "$inicio35 - $suma35P";
						
						
						$inicio35 = $suma35P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS DE RESTITUCION
					if ( $d6M == 36 ){
					
						$suma36P  = $suma36P + $d4M;
						
						$d4M_2    = "$inicio36 - $suma36P";
						
						
						$inicio36 = $suma36P  + 1;
						
					}
					
					//ACUMULADA 6 CUADERNO PRINCIPAL
					if ( $d6M == 37 ){
					
						$suma37P  = $suma37P + $d4M;
						
						$d4M_2    = "$inicio37 - $suma37P";
						
						
						$inicio37 = $suma37P  + 1;
						
					}
					
					//ACUMULADA 6 CUADERNO DE MEDIDAS
					if ( $d6M == 38 ){
					
						$suma38P  = $suma38P + $d4M;
						
						$d4M_2    = "$inicio38 - $suma38P";
						
						
						$inicio38 = $suma38P  + 1;
						
					}
					
					//CUADERNO EJECUTIVO A CONTINUACION PRINCIPAL
					if ( $d6M == 39 ){
					
						$suma39P  = $suma39P + $d4M;
						
						$d4M_2    = "$inicio39 - $suma39P";
						
						
						$inicio39 = $suma39P  + 1;
						
					}
					
					//CUADERNO EJECUTIVO A CONTINUACION MEDIDAS
					if ( $d6M == 40 ){
					
						$suma40P  = $suma40P + $d4M;
						
						$d4M_2    = "$inicio40 - $suma40P";
						
						
						$inicio40 = $suma40P  + 1;
						
					}
				
			
			}
			else{
				
					//CUADERNO PRINCIPAL
					if ( $d6M == 1 ){
					
						$sumaP = $sumaP + $d4M;
						
						$d4M_2 = "$inicio - $sumaP";
						
						
						$inicio = $sumaP  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS
					if ( $d6M == 2 ){
					
						$suma2P  = $suma2P + $d4M;
						
						$d4M_2   = "$inicio2 - $suma2P";
						
						
						$inicio2 = $suma2P  + 1;
						
					}
					
					//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
					
					//ACUMULADA 1 CUADERNO PRINCIPAL
					if ( $d6M == 3 ){
					
						$suma3P  = $suma3P + $d4M;
						
						$d4M_2   = "$inicio3 - $suma3P";
						
						
						$inicio3 = $suma3P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO PRINCIPAL
					if ( $d6M == 4 ){
					
						$suma4P  = $suma4P + $d4M;
						
						$d4M_2   = "$inicio4 - $suma4P";
						
						
						$inicio4 = $suma4P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO PRINCIPAL
					if ( $d6M == 5 ){
					
						$suma5P  = $suma5P + $d4M;
						
						$d4M_2   = "$inicio5 - $suma5P";
						
						
						$inicio5 = $suma5P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO PRINCIPAL
					if ( $d6M == 6 ){
					
						$suma6P  = $suma6P + $d4M;
						
						$d4M_2   = "$inicio6 - $suma6P";
						
						
						$inicio6 = $suma6P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO PRINCIPAL
					if ( $d6M == 7 ){
					
						$suma7P  = $suma7P + $d4M;
						
						$d4M_2   = "$inicio7 - $suma7P";
						
						
						$inicio7 = $suma7P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
					
					//ACUMULADA 1 CUADERNO DE MEDIDAS
					if ( $d6M == 8 ){
					
						$suma8P  = $suma8P + $d4M;
						
						$d4M_2   = "$inicio8 - $suma8P";
						
						
						$inicio8 = $suma8P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO DE MEDIDAS
					if ( $d6M == 9 ){
					
						$suma9P  = $suma9P + $d4M;
						
						$d4M_2   = "$inicio9 - $suma9P";
						
						
						$inicio9 = $suma9P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO DE MEDIDAS
					if ( $d6M == 10 ){
					
						$suma10P  = $suma10P + $d4M;
						
						$d4M_2   = "$inicio10 - $suma10P";
						
						
						$inicio10 = $suma10P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO DE MEDIDAS
					if ( $d6M == 11 ){
					
						$suma11P  = $suma11P + $d4M;
						
						$d4M_2   = "$inicio11 - $suma11P";
						
						
						$inicio11 = $suma11P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO DE MEDIDAS
					if ( $d6M == 12 ){
					
						$suma12P  = $suma12P + $d4M;
						
						$d4M_2   = "$inicio12 - $suma12P";
						
						
						$inicio12 = $suma12P  + 1;
						
					}
					
					//OTROS
					
					//CUADRNO PRINCIPAL INCIDENTE 1
					if ( $d6M == 13 ){
					
						$suma13P  = $suma13P + $d4M;
						
						$d4M_2   = "$inicio13 - $suma13P";
						
						
						$inicio13 = $suma13P  + 1;
						
					}
					
					//CUADRNO DE MEDIDAS INCIDENTE 1
					if ( $d6M == 14 ){
					
						$suma14P  = $suma14P + $d4M;
						
						$d4M_2   = "$inicio14 - $suma14P";
						
						
						$inicio14 = $suma14P  + 1;
						
					}
					
					//RECURSOS
					if ( $d6M == 15 ){
					
						$suma15P  = $suma15P + $d4M;
						
						$d4M_2   = "$inicio15 - $suma15P";
						
						
						$inicio15 = $suma15P  + 1;
						
					}
					
					//CUADERNO DE RESTITUCION
					if ( $d6M == 16 ){
					
						$suma16P  = $suma16P + $d4M;
						
						$d4M_2   = "$inicio16 - $suma16P";
						
						
						$inicio16 = $suma16P  + 1;
						
					}
					
					//CUADERNO SECUESTRE
					if ( $d6M == 17 ){
					
						$suma17P  = $suma17P + $d4M;
						
						$d4M_2   = "$inicio17 - $suma17P";
						
						
						$inicio17 = $suma17P  + 1;
						
					}
					
					//CUADERNO CONFLICTO DE COMPETENCIAS
					if ( $d6M == 18 ){
					
						$suma18P  = $suma18P + $d4M;
						
						$d4M_2   = "$inicio18 - $suma18P";
						
						
						$inicio18 = $suma18P  + 1;
						
					}
					
					//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
					if ( $d6M == 19 ){
					
						$suma19P  = $suma19P + $d4M;
						
						$d4M_2    = "$inicio19 - $suma19P";
						
						
						$inicio19 = $suma19P  + 1;
						
					}
					
					//CUADERNO DE TITULOS
					if ( $d6M == 20 ){
					
						$suma20P  = $suma20P + $d4M;
						
						$d4M_2    = "$inicio20 - $suma20P";
						
						
						$inicio20 = $suma20P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 2
					if ( $d6M == 21 ){
					
						$suma21P  = $suma21P + $d4M;
						
						$d4M_2    = "$inicio21 - $suma21P";
						
						
						$inicio21 = $suma21P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 3
					if ( $d6M == 22 ){
					
						$suma22P  = $suma22P + $d4M;
						
						$d4M_2    = "$inicio22 - $suma22P";
						
						
						$inicio22 = $suma22P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 4
					if ( $d6M == 23 ){
					
						$suma23P  = $suma23P + $d4M;
						
						$d4M_2    = "$inicio23 - $suma23P";
						
						
						$inicio23 = $suma23P  + 1;
						
					}
					
					//DESPACHO COMISORIO
					if ( $d6M == 24 ){
					
						$suma24P  = $suma24P + $d4M;
						
						$d4M_2    = "$inicio24 - $suma24P";
						
						
						$inicio24 = $suma24P  + 1;
						
					}
					
					//CUADERNO PRUEBAS
					if ( $d6M == 25 ){
					
						$suma25P  = $suma25P + $d4M;
						
						$d4M_2    = "$inicio25 - $suma25P";
						
						
						$inicio25 = $suma25P  + 1;
						
					}
					
					//CUADERNO DE SUPROGACION
					if ( $d6M == 26 ){
					
						$suma26P  = $suma26P + $d4M;
						
						$d4M_2    = "$inicio26 - $suma26P";
						
						
						$inicio26 = $suma26P  + 1;
						
					}
					
					//CUADERNO EXCEPCIONES PREVIAS
					if ( $d6M == 27 ){
					
						$suma27P  = $suma27P + $d4M;
						
						$d4M_2    = "$inicio27 - $suma27P";
						
						
						$inicio27 = $suma27P  + 1;
						
					}
				
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 28 ){
					
						$suma28P  = $suma28P + $d4M;
						
						$d4M_2    = "$inicio28 - $suma28P";
						
						
						$inicio28 = $suma28P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 2
					if ( $d6M == 29 ){
					
						$suma29P  = $suma29P + $d4M;
						
						$d4M_2    = "$inicio29 - $suma29P";
						
						
						$inicio29 = $suma29P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 3
					if ( $d6M == 30 ){
					
						$suma30P  = $suma30P + $d4M;
						
						$d4M_2    = "$inicio30 - $suma30P";
						
						
						$inicio30 = $suma30P  + 1;
						
					}
					
					//CUADERNO IMPEDIMENTO
					if ( $d6M == 31 ){
					
						$suma31P  = $suma31P + $d4M;
						
						$d4M_2    = "$inicio31 - $suma31P";
						
						
						$inicio31 = $suma31P  + 1;
						
					}
					
					//CUADERNO MONITORIO
					if ( $d6M == 32 ){
					
						$suma32P  = $suma32P + $d4M;
						
						$d4M_2    = "$inicio32 - $suma32P";
						
						
						$inicio32 = $suma32P  + 1;
						
					}
					
					//CUADERNO TUTELA
					if ( $d6M == 33 ){
					
						$suma33P  = $suma33P + $d4M;
						
						$d4M_2    = "$inicio33 - $suma33P";
						
						
						$inicio33 = $suma33P  + 1;
						
					}
					
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 34 ){
					
						$suma34P  = $suma34P + $d4M;
						
						$d4M_2    = "$inicio34 - $suma34P";
						
						
						$inicio34 = $suma34P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL DE RESTITUCION
					if ( $d6M == 35 ){
					
						$suma35P  = $suma35P + $d4M;
						
						$d4M_2    = "$inicio35 - $suma35P";
						
						
						$inicio35 = $suma35P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS DE RESTITUCION
					if ( $d6M == 36 ){
					
						$suma36P  = $suma36P + $d4M;
						
						$d4M_2    = "$inicio36 - $suma36P";
						
						
						$inicio36 = $suma36P  + 1;
						
					}
					
					//ACUMULADA 6 CUADERNO PRINCIPAL
					if ( $d6M == 37 ){
					
						$suma37P  = $suma37P + $d4M;
						
						$d4M_2    = "$inicio37 - $suma37P";
						
						
						$inicio37 = $suma37P  + 1;
						
					}
					
					//ACUMULADA 6 CUADERNO DE MEDIDAS
					if ( $d6M == 38 ){
					
						$suma38P  = $suma38P + $d4M;
						
						$d4M_2    = "$inicio38 - $suma38P";
						
						
						$inicio38 = $suma38P  + 1;
						
					}
					
					//CUADERNO EJECUTIVO A CONTINUACION PRINCIPAL
					if ( $d6M == 39 ){
					
						$suma39P  = $suma39P + $d4M;
						
						$d4M_2    = "$inicio39 - $suma39P";
						
						
						$inicio39 = $suma39P  + 1;
						
					}
					
					//CUADERNO EJECUTIVO A CONTINUACION MEDIDAS
					if ( $d6M == 40 ){
					
						$suma40P  = $suma40P + $d4M;
						
						$d4M_2    = "$inicio40 - $suma40P";
						
						
						$inicio40 = $suma40P  + 1;
						
					}
				
			
			
			}
			
			$d4M_2B = explode("-",$d4M_2);
						
			$d4M_2I = $d4M_2B[0];
			$d4M_2F = $d4M_2B[1];
		
		
		//----------------------------------------------------------------
		
		
		
	
		$sheet1->setCellValue('B'.$i, $fecha_creacion);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('C'.$i, $field[fecha]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
		$sheet1->setCellValue('D'.$i, $field[orden_documento]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('E'.$i, $field[folios]);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('F'.$i, $d4M_2I);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('G'.$i, $d4M_2F);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		//$sheet1->getCell('H' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		//$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('H'.$i, $formato_2);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->getCell('I' . $i)->setValueExplicit($tamano,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		
		$sheet1->setCellValue('J'.$i,utf8_encode($origen_proc));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('K'.$i,utf8_encode($field[obs]));
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('K'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$i++;
		
		$Ct110=$Ct110+1; 
		
		
	}
	
	$objPHPExcel->getActiveSheet()->getStyle('A15:k15')->applyFromArray($borders);
	

	$sheet1->setCellValue('A'.$i, utf8_encode('FECHA DE CIERRE DEL EXPEDIENTE:'));
	$sheet1->getStyle('A'.$i.':'.'K'.$i)->applyFromArray($borders_nobold_2);
	
	$sheet1->getStyle('A'.$i.':'.'K'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor'   => array('rgb' => '2F709F')
				
	
				)
	);
	
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, utf8_encode('Número de Cuadernos del Expediente:'));
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	//$sheet1->mergeCells('A'.$i.':'.'A'.$i);
	
	$sheet1->getStyle('A'.$i.':'.'A'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => 'FFFFFF'),
				'endcolor'   => array('rgb' => 'FFFFFF')
	
				)
	);
	
	$i = $i + 1;
	
	$sheet1->setCellValue('A'.$i, utf8_encode('Diligencie al momento del archivo definitivo'));
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	
	$sheet1->getStyle('A'.$i.':'.'A'.$i)->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => 'FFFFFF'),
				'endcolor'   => array('rgb' => 'FFFFFF')
	
				)
	);
	
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
	
	// Renombrar Hojas
	if( strlen($des_cuaderno) < 31 ){
	
		$objPHPExcel->getActiveSheet()->setTitle($des_cuaderno);
		//$objPHPExcel->getActiveSheet()->setTitle('indice');
	}
	else{
		
		$objPHPExcel->getActiveSheet()->setTitle('CUADERNO');
	}
	
	//NOTA: EL NOMBRE VARIA, SE CIERRAN ESTA OPCION 24 DE MAYO 2021
	//DEBE SER DE ESTA FORMA 00IndiceElectronicoC01, 00IndiceElectronicoC02 etc
	//$nombre_archivo   = $data->Obtener_Parte_Radicado($radicado);
	//$nombre_archivo_2 = "indiceelectronico".$nombre_archivo.".xlsx";
	
	if($idcuaderno >= 1 && $idcuaderno <= 9){
		$idcuaderno = "0".$idcuaderno;
	}
	$nombre_archivo_2 = "00IndiceElectronicoC".$idcuaderno.".xlsx";
		
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	//header('Content-Disposition: attachment;filename="indice_electronico.xlsx"');
	header('Content-Disposition: attachment;filename='.$nombre_archivo_2);
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


//EJMEPLOS VARIAS PESTAÑAS
if($opcion == 3){

	$objPHPExcel = new PHPExcel();
	
	//First sheet 
    //$sheet = $objPHPExcel->getActiveSheet(); 

    //Start adding next sheets 
    $i=0; 
    while ($i < 10) { 

     // Add new sheet 
     $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating 

     //Write cells 
     $objWorkSheet->setCellValue('A1', 'Hello'.$i) 
        ->setCellValue('B2', 'world!') 
        ->setCellValue('C1', 'Hello') 
        ->setCellValue('D2', 'world!'); 

     // Rename sheet 
     $objWorkSheet->setTitle("$i"); 

     $i++; 
    } 
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="indice_electronico.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


if($opcion == 4){


	$data = new expedientedigitalexcelModel();
	
	
	$objPHPExcel = new PHPExcel();
	
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
	)
	);
	
	$styleArray_2 = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  '000000' ), 
	'size'   =>  12 
	)
	);
	
	$borders = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THICK,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);
		
	$borders_nobold = array(
		  'borders' => array(
			'allborders' => array(
			  'style' => PHPExcel_Style_Border::BORDER_THIN,
			  'color' => array('argb' => 'FF000000'),
			)
		  ),
		);	
		
	$borders_nobold_2 = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => 'FF000000'),)),'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  10 
	));	
	
	
	 //Start adding next sheets 
	
	//SE CAPTURAS TODOS LOS CUADERNOS DEL EXPEDIENTE 
	$datos_cuadernos  = $data->get_cuadernos($id_radi);
	
	$x = 0;
	//WHILE QUE RECORRE LOS CUADERNOS QUE FORMAN EL EXPEDIENTE
    while($filaCUADERNOS = $datos_cuadernos->fetch()){
	
		$id_cuaderno  = $filaCUADERNOS[cuaderno];
		$nom_cuaderno = $filaCUADERNOS[des];
	
		$d6M          = $id_cuaderno;
	
		$vector_datos  = $data->listar_proceso_digital($id_radi,$id_cuaderno);
		
		$datos_oficina_1 = $data->get_datos_oficina();
		$datos_oficina_2 = $datos_oficina_1->fetch();
		$ciudad          = $datos_oficina_2[municipio];	
		
		$datos_proceso_1 = $data->get_datos_proceso($id_radi);
		$datos_proceso_2 = $datos_proceso_1->fetch();
		$radicado        = ucfirst(strtolower($datos_proceso_2[radicado]));
		$demandante      = ucfirst(strtolower($datos_proceso_2[demandante]));
		$demandado       = ucfirst(strtolower($datos_proceso_2[demandado]));
		$claseproceso    = ucfirst(strtolower($datos_proceso_2[claseproceso]));
		//SE CIERRA POR QUE EL JUZGADO QUE SE NECESITA VISUALIZAR ES EL JUZGADO DE REPARTO Y NO ORIGEN
		//$juzgado         = ucfirst(strtolower($datos_proceso_2[juzgado]));
		$juzgado         = ucfirst(strtolower($datos_proceso_2[juzgadoreparto]));
		
		// Agregar Informacion Encabezados Excel
		//$sheet1=$objPHPExcel->setActiveSheetIndex(0);
		
		// Add new sheet 
     	$sheet1 = $objPHPExcel->createSheet($x); //Setting index when creating 
		
		//---------------IMAGEN--------------------------------------------------------------------
		
		$gdImage = imagecreatefromjpeg('views/images/encabezado.jpg');
		// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
		$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(72);
		//$objDrawing->setWidth(200);
		$objDrawing->setCoordinates('A1');
		//$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		$objDrawing->setWorksheet($sheet1);
		
		//----------------------------------------------------------------------------------------
		
		$sheet1->setCellValue('B'.'3', utf8_encode('ÍNDICE ELECTRÓNICO DEL EXPEDIENTE JUDICIAL'));
		//$sheet1->getStyle('B'.'3')->applyFromArray($borders_nobold);
		//$sheet1->getStyle('B'.'3')->applyFromArray($borders_nobold);
		$sheet1->mergeCells('B'.'3'.':'.'B'.'3');
		
		$sheet1->getStyle('B'.'3'.':'.'B'.'3')->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => 'FFFFFF'),
					'endcolor'   => array('rgb' => 'FFFFFF')
		
					)
		);
		
		$sheet1->getStyle('B'.'3'.':'.'B'.'3')->applyFromArray($styleArray_2);
		$sheet1->getStyle('B'.'3'.':'.'B'.'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
	
		$i = 6;
		
		$sheet1->setCellValue('A'.'6', 'Ciudad');
		$sheet1->getStyle('A'.'6')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'6', utf8_encode(ucwords(strtolower($ciudad))));
		$sheet1->getStyle('B'.'6')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'7', 'Despacho Juicial');
		$sheet1->getStyle('A'.'7')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'7', utf8_encode(ucwords(strtolower($juzgado))));
		$sheet1->getStyle('B'.'7')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'8', 'Serie o Subserie Documental');
		$sheet1->getStyle('A'.'8')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'8', utf8_encode(ucwords(strtolower($claseproceso))));
		$sheet1->getStyle('B'.'8')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'9', utf8_encode('No. Radicación del Proceso'));
		$sheet1->getStyle('A'.'9')->applyFromArray($borders_nobold);
		
		$sheet1->getCell('B'. '9')->setValueExplicit($radicado,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.'9')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'10', 'Partes Procesales (Parte A)');
		$sheet1->getStyle('A'.'10')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'10', utf8_encode(ucwords(strtolower($demandado))));
		$sheet1->getStyle('B'.'10')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'11', 'Partes Procesales (Parte B)');
		$sheet1->getStyle('A'.'11')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'11', utf8_encode(ucwords(strtolower($demandante))));
		$sheet1->getStyle('B'.'11')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'12', 'Terceros Intervinientes');
		$sheet1->getStyle('A'.'12')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'12', utf8_encode(''));
		$sheet1->getStyle('B'.'12')->applyFromArray($borders_nobold);
			
		$sheet1->setCellValue('A'.'13', 'Cuaderno');
		$sheet1->getStyle('A'.'13')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.'13', utf8_encode(ucwords(strtolower($nom_cuaderno))));
		$sheet1->getStyle('B'.'13')->applyFromArray($borders_nobold);
			
			
		
		$sheet1->setCellValue('D'.$i, utf8_encode('EXPEDIENTE FÍSICO'));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		$sheet1->mergeCells('D'.$i.':'.'E'.$i);
		
		$sheet1->getStyle('D'.$i.':'.'E'.$i)->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => 'FFFFFF'),
					'endcolor'   => array('rgb' => 'FFFFFF')
		
					)
		);
		
		$sheet1->getStyle('D'.$i.':'.'E'.$i)->applyFromArray($styleArray_2);
		$sheet1->getStyle('D'.$i.':'.'E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$sheet1->setCellValue('D'.'7', utf8_encode('El expediente judicial posee expedientes físicos'));
		$sheet1->getStyle('D'.'7')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.'7', utf8_encode('NO'));
		$sheet1->getStyle('E'.'7')->applyFromArray($borders_nobold);
		$sheet1->getStyle('E'.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		
		$sheet1->setCellValue('D'.'8', utf8_encode('No. De carpetas (cuadernos) o tomos.'));
		$sheet1->getStyle('D'.'8')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.'8', utf8_encode('0'));
		$sheet1->getStyle('E'.'8')->applyFromArray($borders_nobold);
		$sheet1->getStyle('E'.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		
		$sheet1->setCellValue('D'.'9', utf8_encode('No. De carpetas (cuadernos) o tomos digitalizados.'));
		$sheet1->getStyle('D'.'9')->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.'9', utf8_encode('0'));
		$sheet1->getStyle('E'.'9')->applyFromArray($borders_nobold);
		$sheet1->getStyle('E'.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		
		$sheet1->setCellValue('A'.'15', 'Nombre documento');
		$sheet1->setCellValue('B'.'15', utf8_encode('Fecha Creación'));
		$sheet1->setCellValue('C'.'15', utf8_encode('Fecha Incorporación'));
		$sheet1->setCellValue('D'.'15', 'Orden');
		$sheet1->setCellValue('E'.'15', utf8_encode('Número Páginas'));
		$sheet1->setCellValue('F'.'15', utf8_encode('Página Inicio'));
		$sheet1->setCellValue('G'.'15', utf8_encode('Página Fin'));
		$sheet1->setCellValue('H'.'15', 'Formato');
		$sheet1->setCellValue('I'.'15', utf8_encode('Tamaño'));
		$sheet1->setCellValue('J'.'15', 'Origen');
		$sheet1->setCellValue('K'.'15', 'Observaciones');
		
		
		$sheet1->getStyle('A'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('B'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('C'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('D'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('E'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('F'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('G'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('H'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('I'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('J'.'15')->applyFromArray($styleArray_2);
		$sheet1->getStyle('K'.'15')->applyFromArray($styleArray_2);
		
		//'startcolor' => array('rgb' => '2F709F')
		$sheet1->getStyle('A15:K15')->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => '999999'),
					'endcolor' => array('rgb' => '999999')
		
					)
		);
		
		$sheet1->getStyle('A15:K15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$i=16;
		
		
		$Ct110=1;
				
		$inicio   = 1;
		$inicio2  = 1;
		$inicio3  = 1;
		$inicio4  = 1;
		$inicio5  = 1;
		$inicio6  = 1;
		$inicio7  = 1;
		$inicio8  = 1;
		$inicio9  = 1;
		$inicio10 = 1;
		$inicio11 = 1;
		$inicio12 = 1;
		$inicio13 = 1;
		$inicio14 = 1;
		$inicio15 = 1;
		$inicio16 = 1;
		$inicio17 = 1;
		$inicio18 = 1;
		$inicio19 = 1;
		$inicio20 = 1;
		$inicio21 = 1;
		$inicio22 = 1;
		$inicio23 = 1;
		$inicio24 = 1;
		$inicio25 = 1;
		$inicio26 = 1;
		$inicio27 = 1;
		$inicio28 = 1;
		$inicio29 = 1;
		$inicio30 = 1;
		$inicio31 = 1;
		$inicio32 = 1;
		$inicio33 = 1;
		$inicio34 = 1;
		$inicio35 = 1;
		$inicio36 = 1;
		$inicio37 = 1;
		$inicio38 = 1;
		$inicio39 = 1;
		$inicio40 = 1;
		
		
		while($field = $vector_datos->fetch() )
		{
		
			//NOMBRE DOCUMENTO
			$nombre_documento  = explode("/",$field[ruta]);	
			$nombre_documentoB = utf8_encode($nombre_documento[3]);
			$nombre_documentoC = $data->get_nuevo_nombreVISUAL($nombre_documentoB,$field[orden_documento]);
			
			//FORMATO
			$formato_1 = explode(".",$nombre_documentoB);
			$formato_2 = strtoupper(utf8_encode($formato_1[1]));
			
			//TAMAÑO
			$tamano = filesize($field[ruta]);
					
			//$sheet1->setCellValue('A'.$i, $nombre_documentoC);
			$sheet1->getCell('A'.$i)->setValueExplicit($nombre_documentoC,PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			//FECHA CREACION
			//Digitalizado
			if($field[origen] == 1){
							
				$fecha_creacion = "De: ".$field[fecha_de]." a: ".$field[fecha_a]; 
				
				$origen_proc    = "Digitalizado";
							
			}
			//Electronico
			if($field[origen] == 2){
							
				$fecha_creacion = $field[fecha_creacion];
				
				$origen_proc    = "Electrónico";
							
			}
			
			
			//----------------------PAGINA INICIAL - FINAL-------------------
			
				
			
				$d4M  = $field[folios];
				
				unset($d4M_2);
				
				
				if( $Ct110 ==1 ){
				
					
						//SE ADICIONA ESTA PARTE CONE EL OBJETO
						//QUE SEGUN EL ID DE CUADERNO, SE UBIQUE
						//EN EL INICIO DE SUMA CORRESPONDIENTE
						
						//CUADERNO PRINCIPAL
						if ( $d6M == 1 ){
						
							$sumaP = $sumaP + $d4M;
							
							$d4M_2 = "$inicio - $sumaP";
							
							
							$inicio = $sumaP  + 1;
							
						}
						
						
						//CUADERNO DE MEDIDAS
						if ( $d6M == 2 ){
						
							$suma2P  = $suma2P + $d4M;
							
							$d4M_2   = "$inicio2 - $suma2P";
							
							
							$inicio2 = $suma2P  + 1;
							
						}
						
						
						//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
						
						//ACUMULADA 1 CUADERNO PRINCIPAL
						if ( $d6M == 3 ){
						
							$suma3P  = $suma3P + $d4M;
							
							$d4M_2   = "$inicio3 - $suma3P";
							
							
							$inicio3 = $suma3P  + 1;
							
						}
						
						//ACUMULADA 2 CUADERNO PRINCIPAL
						if ( $d6M == 4 ){
						
							$suma4P  = $suma4P + $d4M;
							
							$d4M_2   = "$inicio4 - $suma4P";
							
							
							$inicio4 = $suma4P  + 1;
							
						}
						
						//ACUMULADA 3 CUADERNO PRINCIPAL
						if ( $d6M == 5 ){
						
							$suma5P  = $suma5P + $d4M;
							
							$d4M_2   = "$inicio5 - $suma5P";
							
							
							$inicio5 = $suma5P  + 1;
							
						}
						
						//ACUMULADA 4 CUADERNO PRINCIPAL
						if ( $d6M == 6 ){
	
						
							$suma6P  = $suma6P + $d4M;
							
							$d4M_2   = "$inicio6 - $suma6P";
							
							
							$inicio6 = $suma6P  + 1;
							
						}
						
						//ACUMULADA 5 CUADERNO PRINCIPAL
						if ( $d6M == 7 ){
						
							$suma7P  = $suma7P + $d4M;
							
							$d4M_2   = "$inicio7 - $suma7P";
							
							
							$inicio7 = $suma7P  + 1;
							
						}
						
						
						//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
						
						//ACUMULADA 1 CUADERNO DE MEDIDAS
						if ( $d6M == 8 ){
						
							$suma8P  = $suma8P + $d4M;
							
							$d4M_2   = "$inicio8 - $suma8P";
							
							
							$inicio8 = $suma8P  + 1;
							
						}
						
						//ACUMULADA 2 CUADERNO DE MEDIDAS
						if ( $d6M == 9 ){
						
							$suma9P  = $suma9P + $d4M;
							
							$d4M_2   = "$inicio9 - $suma9P";
							
							
							$inicio9 = $suma9P  + 1;
							
						}
						
						//ACUMULADA 3 CUADERNO DE MEDIDAS
						if ( $d6M == 10 ){
						
							$suma10P  = $suma10P + $d4M;
							
							$d4M_2   = "$inicio10 - $suma10P";
							
							
							$inicio10 = $suma10P  + 1;
							
						}
						
						//ACUMULADA 4 CUADERNO DE MEDIDAS
						if ( $d6M == 11 ){
						
							$suma11P  = $suma11P + $d4M;
							
							$d4M_2   = "$inicio11 - $suma11P";
							
							
							$inicio11 = $suma11P  + 1;
							
						}
						
						//ACUMULADA 5 CUADERNO DE MEDIDAS
						if ( $d6M == 12 ){
						
							$suma12P  = $suma12P + $d4M;
							
							$d4M_2   = "$inicio12 - $suma12P";
							
							
							$inicio12 = $suma12P  + 1;
							
						}
						
						//OTROS
						
						//CUADRNO PRINCIPAL INCIDENTE 1
						if ( $d6M == 13 ){
						
							$suma13P  = $suma13P + $d4M;
							
							$d4M_2   = "$inicio13 - $suma13P";
							
							
							$inicio13 = $suma13P  + 1;
							
						}
						
						//CUADRNO DE MEDIDAS INCIDENTE 1
						if ( $d6M == 14 ){
						
							$suma14P  = $suma14P + $d4M;
							
							$d4M_2   = "$inicio14 - $suma14P";
							
							
							$inicio14 = $suma14P  + 1;
							
						}
						
						//RECURSOS
						if ( $d6M == 15 ){
						
							$suma15P  = $suma15P + $d4M;
							
							$d4M_2   = "$inicio15 - $suma15P";
							
							
							$inicio15 = $suma15P  + 1;
							
						}
						
						//CUADERNO DE RESTITUCION
						if ( $d6M == 16 ){
						
							$suma16P  = $suma16P + $d4M;
							
							$d4M_2   = "$inicio16 - $suma16P";
							
							
							$inicio16 = $suma16P  + 1;
							
						}
						
						//CUADERNO SECUESTRE
						if ( $d6M == 17 ){
						
							$suma17P  = $suma17P + $d4M;
							
							$d4M_2   = "$inicio17 - $suma17P";
							
							
							$inicio17 = $suma17P  + 1;
							
						}
						
						//CUADERNO CONFLICTO DE COMPETENCIAS
						if ( $d6M == 18 ){
						
							$suma18P  = $suma18P + $d4M;
							
							$d4M_2   = "$inicio18 - $suma18P";
							
							
							$inicio18 = $suma18P  + 1;
							
						}
						
						//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
						if ( $d6M == 19 ){
						
							$suma19P  = $suma19P + $d4M;
							
							$d4M_2    = "$inicio19 - $suma19P";
							
							
							$inicio19 = $suma19P  + 1;
							
						}
						
						//CUADERNO DE TITULOS
						if ( $d6M == 20 ){
						
							$suma20P  = $suma20P + $d4M;
							
							$d4M_2    = "$inicio20 - $suma20P";
							
							
							$inicio20 = $suma20P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 2
						if ( $d6M == 21 ){
						
							$suma21P  = $suma21P + $d4M;
							
							$d4M_2    = "$inicio21 - $suma21P";
							
							
							$inicio21 = $suma21P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 3
						if ( $d6M == 22 ){
						
							$suma22P  = $suma22P + $d4M;
							
							$d4M_2    = "$inicio22 - $suma22P";
							
							
							$inicio22 = $suma22P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 4
						if ( $d6M == 23 ){
						
							$suma23P  = $suma23P + $d4M;
							
							$d4M_2    = "$inicio23 - $suma23P";
							
							
							$inicio23 = $suma23P  + 1;
							
						}
						
						//DESPACHO COMISORIO
						if ( $d6M == 24 ){
						
							$suma24P  = $suma24P + $d4M;
							
							$d4M_2    = "$inicio24 - $suma24P";
							
							
							$inicio24 = $suma24P  + 1;
							
						}
						
						//CUADERNO PRUEBAS
						if ( $d6M == 25 ){
						
							$suma25P  = $suma25P + $d4M;
							
							$d4M_2    = "$inicio25 - $suma25P";
							
							
							$inicio25 = $suma25P  + 1;
							
						}
						
						//CUADERNO DE SUPROGACION
						if ( $d6M == 26 ){
						
							$suma26P  = $suma26P + $d4M;
							
							$d4M_2    = "$inicio26 - $suma26P";
							
							
							$inicio26 = $suma26P  + 1;
							
						}
						
						//CUADERNO EXCEPCIONES PREVIAS
						if ( $d6M == 27 ){
						
							$suma27P  = $suma27P + $d4M;
							
							$d4M_2    = "$inicio27 - $suma27P";
							
							
							$inicio27 = $suma27P  + 1;
							
						}
						
						//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
						if ( $d6M == 28 ){
						
							$suma28P  = $suma28P + $d4M;
							
							$d4M_2    = "$inicio28 - $suma28P";
							
							
							$inicio28 = $suma28P  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS INCIDENTE 2
						if ( $d6M == 29 ){
						
							$suma29P  = $suma29P + $d4M;
							
							$d4M_2    = "$inicio29 - $suma29P";
							
							
							$inicio29 = $suma29P  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS INCIDENTE 3
						if ( $d6M == 30 ){
						
							$suma30P  = $suma30P + $d4M;
							
							$d4M_2    = "$inicio30 - $suma30P";
							
							
							$inicio30 = $suma30P  + 1;
							
						}
						
						//CUADERNO IMPEDIMENTO
						if ( $d6M == 31 ){
						
							$suma31P  = $suma31P + $d4M;
							
							$d4M_2    = "$inicio31 - $suma31P";
							
							
							$inicio31 = $suma31P  + 1;
							
						}
						
						//CUADERNO MONITORIO
						if ( $d6M == 32 ){
						
							$suma32P  = $suma32P + $d4M;
							
							$d4M_2    = "$inicio32 - $suma32P";
							
							
							$inicio32 = $suma32P  + 1;
							
						}
						
						//CUADERNO TUTELA
						if ( $d6M == 33 ){
						
							$suma33P  = $suma33P + $d4M;
							
							$d4M_2    = "$inicio33 - $suma33P";
							
							
							$inicio33 = $suma33P  + 1;
							
						}
						
						//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
						if ( $d6M == 34 ){
					
							$suma34P  = $suma34P + $d4M;
						
							$d4M_2    = "$inicio34 - $suma34P";
						
						
							$inicio34 = $suma34P  + 1;
						
						}
						
						//CUADERNO PRINCIPAL DE RESTITUCION
						if ( $d6M == 35 ){
					
							$suma35P  = $suma35P + $d4M;
							
							$d4M_2    = "$inicio35 - $suma35P";
							
							
							$inicio35 = $suma35P  + 1;
							
						}
					
						//CUADERNO DE MEDIDAS DE RESTITUCION
						if ( $d6M == 36 ){
						
							$suma36P  = $suma36P + $d4M;
							
							$d4M_2    = "$inicio36 - $suma36P";
							
							
							$inicio36 = $suma36P  + 1;
							
						}
						
						//ACUMULADA 6 CUADERNO PRINCIPAL
						if ( $d6M == 37 ){
					
							$suma37P  = $suma37P + $d4M;
						
							$d4M_2    = "$inicio37 - $suma37P";
						
						
							$inicio37 = $suma37P  + 1;
						
						}
					
						//ACUMULADA 6 CUADERNO DE MEDIDAS
						if ( $d6M == 38 ){
						
							$suma38P  = $suma38P + $d4M;
							
							$d4M_2    = "$inicio38 - $suma38P";
							
							
							$inicio38 = $suma38P  + 1;
							
						}
						
						//CUADERNO EJECUTIVO A CONTINUACION PRINCIPAL
						if ( $d6M == 39 ){
						
							$suma39P  = $suma39P + $d4M;
							
							$d4M_2    = "$inicio39 - $suma39P";
							
							
							$inicio39 = $suma39P  + 1;
							
						}
						
						//CUADERNO EJECUTIVO A CONTINUACION MEDIDAS
						if ( $d6M == 40 ){
						
							$suma40P  = $suma40P + $d4M;
							
							$d4M_2    = "$inicio40 - $suma40P";
							
							
							$inicio40 = $suma40P  + 1;
							
						}
					
				
				}
				else{
					
						//CUADERNO PRINCIPAL
						if ( $d6M == 1 ){
						
							$sumaP = $sumaP + $d4M;
							
							$d4M_2 = "$inicio - $sumaP";
							
							
							$inicio = $sumaP  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS
						if ( $d6M == 2 ){
						
							$suma2P  = $suma2P + $d4M;
							
							$d4M_2   = "$inicio2 - $suma2P";
							
							
							$inicio2 = $suma2P  + 1;
							
						}
						
						//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
						
						//ACUMULADA 1 CUADERNO PRINCIPAL
						if ( $d6M == 3 ){
						
							$suma3P  = $suma3P + $d4M;
							
							$d4M_2   = "$inicio3 - $suma3P";
							
							
							$inicio3 = $suma3P  + 1;
							
						}
						
						//ACUMULADA 2 CUADERNO PRINCIPAL
						if ( $d6M == 4 ){
						
							$suma4P  = $suma4P + $d4M;
							
							$d4M_2   = "$inicio4 - $suma4P";
							
							
							$inicio4 = $suma4P  + 1;
							
						}
						
						//ACUMULADA 3 CUADERNO PRINCIPAL
						if ( $d6M == 5 ){
						
							$suma5P  = $suma5P + $d4M;
							
							$d4M_2   = "$inicio5 - $suma5P";
							
							
							$inicio5 = $suma5P  + 1;
							
						}
						
						//ACUMULADA 4 CUADERNO PRINCIPAL
						if ( $d6M == 6 ){
						
							$suma6P  = $suma6P + $d4M;
							
							$d4M_2   = "$inicio6 - $suma6P";
							
							
							$inicio6 = $suma6P  + 1;
							
						}
						
						//ACUMULADA 5 CUADERNO PRINCIPAL
						if ( $d6M == 7 ){
						
							$suma7P  = $suma7P + $d4M;
							
							$d4M_2   = "$inicio7 - $suma7P";
							
							
							$inicio7 = $suma7P  + 1;
							
						}
						
						
						//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
						
						//ACUMULADA 1 CUADERNO DE MEDIDAS
						if ( $d6M == 8 ){
						
							$suma8P  = $suma8P + $d4M;
							
							$d4M_2   = "$inicio8 - $suma8P";
							
							
							$inicio8 = $suma8P  + 1;
							
						}
						
						//ACUMULADA 2 CUADERNO DE MEDIDAS
						if ( $d6M == 9 ){
						
							$suma9P  = $suma9P + $d4M;
							
							$d4M_2   = "$inicio9 - $suma9P";
							
							
							$inicio9 = $suma9P  + 1;
							
						}
						
						//ACUMULADA 3 CUADERNO DE MEDIDAS
						if ( $d6M == 10 ){
						
							$suma10P  = $suma10P + $d4M;
							
							$d4M_2   = "$inicio10 - $suma10P";
							
							
							$inicio10 = $suma10P  + 1;
							
						}
						
						//ACUMULADA 4 CUADERNO DE MEDIDAS
						if ( $d6M == 11 ){
						
							$suma11P  = $suma11P + $d4M;
							
							$d4M_2   = "$inicio11 - $suma11P";
							
							
							$inicio11 = $suma11P  + 1;
							
						}
						
						//ACUMULADA 5 CUADERNO DE MEDIDAS
						if ( $d6M == 12 ){
						
							$suma12P  = $suma12P + $d4M;
							
							$d4M_2   = "$inicio12 - $suma12P";
							
							
							$inicio12 = $suma12P  + 1;
							
						}
						
						//OTROS
						
						//CUADRNO PRINCIPAL INCIDENTE 1
						if ( $d6M == 13 ){
						
							$suma13P  = $suma13P + $d4M;
							
							$d4M_2   = "$inicio13 - $suma13P";
							
							
							$inicio13 = $suma13P  + 1;
							
						}
						
						//CUADRNO DE MEDIDAS INCIDENTE 1
						if ( $d6M == 14 ){
						
							$suma14P  = $suma14P + $d4M;
							
							$d4M_2   = "$inicio14 - $suma14P";
							
							
							$inicio14 = $suma14P  + 1;
							
						}
						
						//RECURSOS
						if ( $d6M == 15 ){
						
							$suma15P  = $suma15P + $d4M;
							
							$d4M_2   = "$inicio15 - $suma15P";
							
							
							$inicio15 = $suma15P  + 1;
							
						}
						
						//CUADERNO DE RESTITUCION
						if ( $d6M == 16 ){
						
							$suma16P  = $suma16P + $d4M;
							
							$d4M_2   = "$inicio16 - $suma16P";
							
							
							$inicio16 = $suma16P  + 1;
							
						}
						
						//CUADERNO SECUESTRE
						if ( $d6M == 17 ){
						
							$suma17P  = $suma17P + $d4M;
							
							$d4M_2   = "$inicio17 - $suma17P";
							
							
							$inicio17 = $suma17P  + 1;
							
						}
						
						//CUADERNO CONFLICTO DE COMPETENCIAS
						if ( $d6M == 18 ){
						
							$suma18P  = $suma18P + $d4M;
							
							$d4M_2   = "$inicio18 - $suma18P";
							
							
							$inicio18 = $suma18P  + 1;
							
						}
						
						//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
						if ( $d6M == 19 ){
						
							$suma19P  = $suma19P + $d4M;
							
							$d4M_2    = "$inicio19 - $suma19P";
							
							
							$inicio19 = $suma19P  + 1;
							
						}
						
						//CUADERNO DE TITULOS
						if ( $d6M == 20 ){
						
							$suma20P  = $suma20P + $d4M;
							
							$d4M_2    = "$inicio20 - $suma20P";
							
							
							$inicio20 = $suma20P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 2
						if ( $d6M == 21 ){
						
							$suma21P  = $suma21P + $d4M;
							
							$d4M_2    = "$inicio21 - $suma21P";
							
							
							$inicio21 = $suma21P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 3
						if ( $d6M == 22 ){
						
							$suma22P  = $suma22P + $d4M;
							
							$d4M_2    = "$inicio22 - $suma22P";
							
							
							$inicio22 = $suma22P  + 1;
							
						}
						
						//CUADERNO PRINCIPAL INCIDENTE 4
						if ( $d6M == 23 ){
						
							$suma23P  = $suma23P + $d4M;
							
							$d4M_2    = "$inicio23 - $suma23P";
							
							
							$inicio23 = $suma23P  + 1;
							
						}
						
						//DESPACHO COMISORIO
						if ( $d6M == 24 ){
						
							$suma24P  = $suma24P + $d4M;
							
							$d4M_2    = "$inicio24 - $suma24P";
							
							
							$inicio24 = $suma24P  + 1;
							
						}
						
						//CUADERNO PRUEBAS
						if ( $d6M == 25 ){
						
							$suma25P  = $suma25P + $d4M;
							
							$d4M_2    = "$inicio25 - $suma25P";
							
							
							$inicio25 = $suma25P  + 1;
							
						}
						
						//CUADERNO DE SUPROGACION
						if ( $d6M == 26 ){
						
							$suma26P  = $suma26P + $d4M;
							
							$d4M_2    = "$inicio26 - $suma26P";
							
							
							$inicio26 = $suma26P  + 1;
							
						}
						
						//CUADERNO EXCEPCIONES PREVIAS
						if ( $d6M == 27 ){
						
							$suma27P  = $suma27P + $d4M;
							
							$d4M_2    = "$inicio27 - $suma27P";
							
							
							$inicio27 = $suma27P  + 1;
							
						}
					
						//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
						if ( $d6M == 28 ){
						
							$suma28P  = $suma28P + $d4M;
							
							$d4M_2    = "$inicio28 - $suma28P";
							
							
							$inicio28 = $suma28P  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS INCIDENTE 2
						if ( $d6M == 29 ){
						
							$suma29P  = $suma29P + $d4M;
							
							$d4M_2    = "$inicio29 - $suma29P";
							
							
							$inicio29 = $suma29P  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS INCIDENTE 3
						if ( $d6M == 30 ){
						
							$suma30P  = $suma30P + $d4M;
							
							$d4M_2    = "$inicio30 - $suma30P";
							
							
							$inicio30 = $suma30P  + 1;
							
						}
						
						//CUADERNO IMPEDIMENTO
						if ( $d6M == 31 ){
						
							$suma31P  = $suma31P + $d4M;
							
							$d4M_2    = "$inicio31 - $suma31P";
							
							
							$inicio31 = $suma31P  + 1;
							
						}
						
						//CUADERNO MONITORIO
						if ( $d6M == 32 ){
						
							$suma32P  = $suma32P + $d4M;
							
							$d4M_2    = "$inicio32 - $suma32P";
							
							
							$inicio32 = $suma32P  + 1;
							
						}
						
						//CUADERNO TUTELA
						if ( $d6M == 33 ){
						
							$suma33P  = $suma33P + $d4M;
							
							$d4M_2    = "$inicio33 - $suma33P";
							
							
							$inicio33 = $suma33P  + 1;
							
						}
						
						//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
						if ( $d6M == 34 ){
					
							$suma34P  = $suma34P + $d4M;
						
							$d4M_2    = "$inicio34 - $suma34P";
						
						
							$inicio34 = $suma34P  + 1;
						
						}
						
						//CUADERNO PRINCIPAL DE RESTITUCION
						if ( $d6M == 35 ){
						
							$suma35P  = $suma35P + $d4M;
							
							$d4M_2    = "$inicio35 - $suma35P";
							
							
							$inicio35 = $suma35P  + 1;
							
						}
						
						//CUADERNO DE MEDIDAS DE RESTITUCION
						if ( $d6M == 36 ){
						
							$suma36P  = $suma36P + $d4M;
							
							$d4M_2    = "$inicio36 - $suma36P";
							
							
							$inicio36 = $suma36P  + 1;
							
						}
						
						
						//ACUMULADA 6 CUADERNO PRINCIPAL
						if ( $d6M == 37 ){
						
							$suma37P  = $suma37P + $d4M;
							
							$d4M_2    = "$inicio37 - $suma37P";
							
							
							$inicio37 = $suma37P  + 1;
							
						}
						
						//ACUMULADA 6 CUADERNO DE MEDIDAS
						if ( $d6M == 38 ){
						
							$suma38P  = $suma38P + $d4M;
							
							$d4M_2    = "$inicio38 - $suma38P";
							
							
							$inicio38 = $suma38P  + 1;
							
						}
						
						//CUADERNO EJECUTIVO A CONTINUACION PRINCIPAL
						if ( $d6M == 39 ){
						
							$suma39P  = $suma39P + $d4M;
							
							$d4M_2    = "$inicio39 - $suma39P";
							
							
							$inicio39 = $suma39P  + 1;
							
						}
						
						//CUADERNO EJECUTIVO A CONTINUACION MEDIDAS
						if ( $d6M == 40 ){
						
							$suma40P  = $suma40P + $d4M;
							
							$d4M_2    = "$inicio40 - $suma40P";
							
							
							$inicio40 = $suma40P  + 1;
							
						}
					
				
				
				}
				
				$d4M_2B = explode("-",$d4M_2);
							
				$d4M_2I = $d4M_2B[0];
				$d4M_2F = $d4M_2B[1];
			
			
			//----------------------------------------------------------------
			
			
			
		
			$sheet1->setCellValue('B'.$i, $fecha_creacion);
			$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->setCellValue('C'.$i, $field[fecha]);
			$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
			$sheet1->setCellValue('D'.$i, $field[orden_documento]);
			$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->setCellValue('E'.$i, $field[folios]);
			$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('E'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->setCellValue('F'.$i, $d4M_2I);
			$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('F'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->setCellValue('G'.$i, $d4M_2F);
			$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('G'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			//$sheet1->getCell('H' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
			//$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
			$sheet1->setCellValue('H'.$i, $formato_2);
			$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->getCell('I' . $i)->setValueExplicit($tamano,PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			
			$sheet1->setCellValue('J'.$i,utf8_encode($origen_proc));
			$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$sheet1->setCellValue('K'.$i,utf8_encode($field[obs]));
			$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
			$sheet1->getStyle('K'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$i++;
			
			$Ct110=$Ct110+1; 
			
			
		}
		
		$objPHPExcel->getActiveSheet()->getStyle('A15:k15')->applyFromArray($borders);
		
	
		$sheet1->setCellValue('A'.$i, utf8_encode('FECHA DE CIERRE DEL EXPEDIENTE:'));
		$sheet1->getStyle('A'.$i.':'.'K'.$i)->applyFromArray($borders_nobold_2);
		
		$sheet1->getStyle('A'.$i.':'.'K'.$i)->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => '2F709F'),
					'endcolor'   => array('rgb' => '2F709F')
					
		
					)
		);
		
		$i = $i + 1;
		
		$sheet1->setCellValue('A'.$i, utf8_encode('Número de Cuadernos del Expediente:'));
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		//$sheet1->mergeCells('A'.$i.':'.'A'.$i);
		
		$sheet1->getStyle('A'.$i.':'.'A'.$i)->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => 'FFFFFF'),
					'endcolor'   => array('rgb' => 'FFFFFF')
		
					)
		);
		
		$i = $i + 1;
		
		$sheet1->setCellValue('A'.$i, utf8_encode('Diligencie al momento del archivo definitivo'));
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->getStyle('A'.$i.':'.'A'.$i)->getFill()->applyFromArray(
					array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array('rgb' => 'FFFFFF'),
					'endcolor'   => array('rgb' => 'FFFFFF')
		
					)
		);
		
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
		
		// Renombrar Hoja
		//$objPHPExcel->getActiveSheet()->setTitle($x);
		
		if( strlen($nom_cuaderno) < 31 ){
		
			$sheet1->setTitle("$nom_cuaderno"); 
		}
		else{
		
			$sheet1->setTitle('CUADERNO'); 
		}
	
		$x = $x + 1;
		
	}	
	
	$nombre_archivo   = $data->Obtener_Parte_Radicado($radicado);
	$nombre_archivo_2 = "00IndiceElectronico".$nombre_archivo.".xlsx";

	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	//header('Content-Disposition: attachment;filename="indice_electronico.xlsx"');
	header('Content-Disposition: attachment;filename='.$nombre_archivo_2);
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}



?>