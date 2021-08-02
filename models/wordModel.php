<?php
class wordModel extends modelBase
{


/************************ Se obtiene un vector de juzgados *************************************/

	
	public function obtenerJuzgados()
	{	
	
		$fechai   = $_POST['fechai'];
		$fechaf   = $_POST['fechaf'];
		 //$fecha ='2013-11-07';

		$juzgados = $this->db->prepare("select DISTINCT co.idjuzgado, pa_juzgado.nombre from correspondencia_otros co  inner join pa_juzgado on (pa_juzgado.id=co.idjuzgado) where co.fecha  BETWEEN '$fechai' and '$fechaf'
union select DISTINCT ct.idjuzgado,pa_juzgado.nombre from correspondencia_tutelas ct inner join accionante_accionado_vinculado av on (ct.id=av.idcorrespondencia_tutelas)
inner join actuacion_tutela act on (act.idaccionado_vinculado_accionante_tut=av.id) inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado) 
where act.fecha_envio BETWEEN '$fechai' and '$fechaf' order by idjuzgado");
     
		$juzgados->execute();	
		
		$i=0;
		
		while($idE = $juzgados->fetch())
		{
			
			$vector[$i][idjuzgado]=$idE[idjuzgado];
			$vector[$i][nombre]=$idE[nombre];
			$i= $i+1;
		}
		
		
		
		
	
		//print_r($vector);	
		return $vector;
		
		
		
		
  }

/************************ Se obtiene un vector de oficios *************************************
************************************ en una fecha ************************************/
	
	public function obtenerOficiosTelegramas($id)
	{	
		
		 $fechai   = $_POST['fechai'];
		 $fechaf   = $_POST['fechaf'];
	     //$id;

		
		$fechas = $this->db->prepare("select fecha, count(esOficio_Telegrama) as cantidad from (
    select co.fecha, juz.nombre,co.esOficio_Telegrama,co.idmunicipio,juz.id,co.oficio_telegrama from correspondencia_otros co
inner join pa_juzgado juz on (juz.id=co.idjuzgado) 
where juz.id='$id' and  co.fecha BETWEEN '$fechai' and '$fechaf'

 union all
 
    select act.fecha_envio as fecha,juz.nombre,act.esoficio_telegrama,act.idmunicipio,juz.id,act.oficio_telegrama from correspondencia_tutelas ct
inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela act on (act.idaccionado_vinculado_accionante_tut=acc.id)
where  act.fecha_envio BETWEEN '$fechai' and '$fechaf'
and ct.idjuzgado='$id'
) x  group by fecha order by fecha;");
    
 
		$fechas->execute();
		
			
		
		
		$i=0;
		$j=0;
		
		unset($v_fecha,$v_datos, $vdatos_def);
		
		while($idE = $fechas->fetch())
		{
			$v_fecha[$i][fecha] = $idE[fecha];
			$v_fecha[$i][cantidad] = $idE[cantidad];
			$i= $i+1;
		}
		
		//print_r($v_fecha);	
		//return $vector;
		
		
		$datos = $this->db->prepare("select co.fecha, juz.nombre,co.esOficio_Telegrama,co.idmunicipio,co.oficio_telegrama from correspondencia_otros co
inner join pa_juzgado juz on (juz.id=co.idjuzgado) 
where juz.id='$id' and  co.fecha BETWEEN '$fechai' and '$fechaf' 
union
select act.fecha_envio as fecha,juz.nombre,act.esoficio_telegrama,act.idmunicipio,act.oficio_telegrama from correspondencia_tutelas ct
inner join pa_juzgado juz on (juz.id=ct.idjuzgado) inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id) inner join actuacion_tutela act on (act.idaccionado_vinculado_accionante_tut=acc.id)
where  act.fecha_envio BETWEEN '$fechai' and '$fechaf' 
and ct.idjuzgado='$id'
order by fecha");
    
 
		$datos->execute();
		
		
		while($idE1 = $datos->fetch())
		{
			
			$v_datos[$j][fecha] = $idE1[fecha];
			$v_datos[$j][esOficio_Telegrama] = $idE1[esOficio_Telegrama];
			$v_datos[$j][idmunicipio] = $idE1[idmunicipio];		
			$v_datos[$j][oficio_telegrama] = $idE1[oficio_telegrama];		
			$j= $j+1;
			
				
	 }
	
	//print_r($v_datos);	
	
	$contf = count($v_fecha);
	$f = 0;
	$ii = 0;
	
	while ($f < $contf)
	{
	 $vdatos_def[$f][fecha] = $v_fecha[$f][fecha];
	 $cont = $v_fecha[$f][cantidad];
	 $k = 0; 
	   
	 while ($k < $cont)
	  {
	    
		if(($v_datos[$ii][esOficio_Telegrama])== 'Oficio')
		 {
		   $vdatos_def[$f][cantidad_oficios] = $vdatos_def[$f][cantidad_oficios]+1;
		  
		   if((($v_datos[$ii][idmunicipio])==546) || (($v_datos[$ii][esOficio_Telegrama])==1087) || (($v_datos[$ii][esOficio_Telegrama])==653) || (($v_datos[$ii][esOficio_Telegrama])==204) || (($v_datos[$ii][esOficio_Telegrama])==611))
		   {
		    $vdatos_def[$f][cantidad_oficios_urbanos] = $vdatos_def[$f][cantidad_oficios_urbanos]+1;
		   }
		  else
		   {
		    $vdatos_def[$f][cantidad_oficios_nacionales] = $vdatos_def[$f][cantidad_oficios_nacionales]+1;		   
		   } 
		 }
		 else
		 {
		  $vdatos_def[$f][cantidad_telegramas] = $vdatos_def[$f][cantidad_telegramas]+1;
		  
		  if((($v_datos[$ii][idmunicipio])==546) || (($v_datos[$ii][esOficio_Telegrama])==1087) || (($v_datos[$ii][esOficio_Telegrama])==653) || (($v_datos[$ii][esOficio_Telegrama])==204) || (($v_datos[$ii][esOficio_Telegrama])==611))
		   {
		    $vdatos_def[$f][cantidad_telegramas_urbanos] = $vdatos_def[$f][cantidad_telegramas_urbanos]+1;
		   }
		  else
		   {
		    $vdatos_def[$f][cantidad_telegramas_nacionales] = $vdatos_def[$f][cantidad_telegramas_nacionales]+1;		   
		   }
		 
		 
		 
		 
		 }
		 
		 
		 $ii = $ii+1;
		 $k = $k+1;
		 	
	  }
	  $f = $f+1;
	
	
	}
	
//print_r($vdatos_def);	
	
	return 	$vdatos_def;
		
	}/*Cierra Función*/
	
/************************ vector de actas de recibido *************************************/

	
	public function obtenerActa()
	{	
	
		$id   = $_GET['nombre1'];
		$i=$j=$k=0;
		$meses="";
		
		
		
		
		$acta = $this->db->prepare("select inv.consecutivo_acta, juz.nombre as juzgado, inv.nombre_recibe,inv.enero,inv.febrero,inv.marzo,inv.abril,inv.mayo,inv.junio,inv.julio,inv.agosto,inv.septiembre,inv.octubre,
inv.noviembre,inv.diciembre, inv.desde_caja,inv.hasta_caja,inv.cantidad_cajas,inv.desde_expediente,inv.hasta_expediente,inv.cantidad_expedientes,inv.ano_archivar 
from inventario inv
inner join pa_juzgado juz on (inv.idjuzgado=juz.id)
where inv.id=$id");
     
		$acta->execute();	
		
				
		while($idE1 = $acta->fetch())
		{
			$vector[$i][consecutivo_acta]=$idE1[consecutivo_acta];
			$vector[$i][juzgado]		 =$idE1[juzgado];
			$vector[$i][nombre_recibe]	 =$idE1[nombre_recibe];
			
			if($idE1[enero]==1){
			$meses[$k] = "Enero"; $k=$k+1;}
			if($idE1[febrero]==1){
			$meses[$k] = "Febrero";$k=$k+1;}
			if($idE1[marzo]==1){
			$meses[$k] = "Marzo";$k=$k+1;}
			if($idE1[abril]==1){
			$meses[$k] = "Abril";$k=$k+1;}
			if($idE1[mayo]==1){
			$meses[$k] = "Mayo";$k=$k+1;}
			if($idE1[junio]==1){
			$meses[$k] = "Junio";$k=$k+1;}
			if($idE1[julio]==1){
			$meses[$k] = "Julio";$k=$k+1;}
			if($idE1[agosto]==1){
			$meses[$k] = "Agosto";$k=$k+1;}
			if($idE1[septiembre]==1){
			$meses[$k] = "Septiembre";$k=$k+1;}
			if($idE1[octubre]==1){
			$meses[$k] = "Octubre";$k=$k+1;}
			if($idE1[noviembre]==1){
			$meses[$k] = "Noviembre";$k=$k+1;}
			if($idE1[diciembre]==1){
			$meses[$k] = "Diciembre";$k=$k+1;}
		
		 	$cont_mes= count($meses);
	  		$mes= "";
		  
		  		while($j<$cont_mes)
	  		{
	   			if($j!=0)
	   		   {
	    		$mes = $mes.", ";
	   			}
	   			$mes = $mes.$meses[$j];
	   			$j= $j+1;
	  
	  		}
			$vector[$i][meses]	 			   =$mes;
			unset($meses);
			 			
			
			$vector[$i][desde_caja]		  	  =$idE1[desde_caja];
			$vector[$i][hasta_caja]		  	  =$idE1[hasta_caja];
			$vector[$i][cantidad_cajas]	  	  =$idE1[cantidad_cajas];
			$vector[$i][desde_expediente] 	  =$idE1[desde_expediente];
			$vector[$i][hasta_expediente] 	  =$idE1[hasta_expediente];
			$vector[$i][cantidad_expedientes] =$idE1[cantidad_expedientes];
			$vector[$i][ano_archivar] 		  =$idE1[ano_archivar];						
			$i= $i+1;
		 		
		}
		return $vector;
		
		
		
		
  }	

/************************ vector de actas de entrega *************************************/

	
	public function obtenerDatosReparto()
	{	
	
		$id   = $_GET['nombre1'];
		$i=$j=$k=0;
		
		
		$acta = $this->db->prepare("select ubi.radicado,ubi.fecha_reparto,jr.nombre as juzgado,ubi.demandado,ubi.demandante,cp.nombre as clase from ubicacion_expediente as ubi 
inner join juzgado_destino jr on (jr.id=ubi.idjuzgado_reparto)
inner join pa_clase_proceso cp on (cp.id=ubi.idclase_proceso)
where ubi.id=$id");
     
		$acta->execute();	
		
				
		while($idE1 = $acta->fetch())
		{
			$vector[radicado]		=$idE1[radicado];
			$vector[fecha_reparto]	=$idE1[fecha_reparto];
			$vector[juzgado]	    =$idE1[juzgado];
			$vector[demandado]		=$idE1[demandado];
			$vector[demandante]		=$idE1[demandante];
			$vector[clase]	  	    =$idE1[clase];
			
					 		
		}
		return $vector;
		
		
		
		
  }		

 }/*Cierra Model*/

?>
<?php

$opcion = $_GET['nombre'];

if($opcion==1)
{
require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');

// New Word Document
$PHPWord = new PHPWord();

$data= new wordModel();
$data_tabla= new wordModel();
$vector_datos= $data->obtenerJuzgados();
$contador_juzgados = count($vector_datos);
$validacion = $contador_juzgados-1;
$p = 0;



$vector_fechas= $data_tabla->obtenerOficiosTelegramas(16);





$fecha_mes = $_POST['fechai'];
$consecutivo = $_POST['consecutivo'];

$vector = explode('-',$fecha_mes);
$mes = $vector[1];

setlocale(LC_TIME, "Spanish");
$fecha1 = strftime('%B del %Y', strtotime($fecha_mes));  
$mes_r  = strftime('%B', strtotime($fecha_mes));
$mes_r = strtoupper($mes_r);  


$section = $PHPWord->createSection();

$fontStyle45 = array ('bold' => true,'size'=>11);
$fontStyle46 = array ('size'=>11);
$paraStyle45 = array ('align' => 'center');


$fontStylejuz = array ('bold' => true,'size'=>11,'color'=>'darkGray');
$paraStylejuz = array ('align' => 'center','color'=>'darkGray');


$fontStyle1 = array('name'=>'Times New Roman','size'=>11,'color'=>'lightGray','bold'=>true,'italic'=>true,'align'=>'center');
$fontStyle2 = array('name'=>'Arial','size'=>11,'align'=>'left','bold'=>true);
$fontStyle3 = array('name'=>'Arial','size'=>11,'align'=>'left');
$fontStyle4 = array('name'=>'Arial','size'=>11,'align'=>'center');
$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
$table->addCell(2000)->addImage('views/images/logo_consejo.png', array('width'=>68, 'height'=>88, 'align'=>'left'));
$table->addCell(4500)->addText('Rama Judicial del Poder Público Oficina de apoyo para los juzgados civiles municipales de ejecución de sentencias de Manizales.
',$fontStyle1, $fontStyle1);
$table->addCell(200)->addImage('views/images/logo_eje.png', array('width'=>94, 'height'=>62, 'align'=>'left'));



$PHPWord->addTitleStyle(1, array('name'=>'Arial','size'=>11,'align'=>'center','bold'=>true));
$PHPWord->addTitleStyle(2, array('align'=>'center'));
$styleParagraph = array('name'=>'Arial','size'=>25,'align'=>'left', 'spaceAfter'=>100);



//$section->addPageBreak();
 $fecha = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha1 = strftime('%d de %B del %Y', strtotime($fecha));  






// Define table style arrays
$styleTable = array('borderSize'=>5, 'borderColor'=>'999999', 'cellMargin'=>5, 'align'=>'center');
$styleFirstRow = array('borderBottomSize'=>5, 'borderBottomColor'=>'CCCCCC', 'bgColor'=>'CCCCCC');

// Define cell style arrays
$styleCell = array('valign'=>'center');
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size'=>'8');
$paraStyle = array ('align' => 'center','size'=>'8');

$fontStyle_cell = array('align'=>'center','name'=>'Arial','size'=>'8');
$paraStyle_cell = array ('name'=>'Arial','size'=>'8','align' => 'center');

// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);

$cont =0;

while($p<$contador_juzgados)
{

$id = $vector_datos[$p][idjuzgado];
$vector_datos_inf= $data_tabla->obtenerOficiosTelegramas($id);
$cont = count($vector_datos_inf);
//($vector_datos_inf);


$section->addText("".$consecutivo, $fontStyle45, $paraStyle45);
$section->addText('                ',$fontStyle3);
$section->addText('FECHA:        '.$fecha1,$fontStyle2);
$section->addText('PARA:          '."Juzgados Civiles Municipales de Ejecución.",$fontStyle2);
$section->addText('ASUNTO:     '."Informe - Correspondencia Enviada por Cada Despacho (Acuerdo 657-99, Art. 3)",$fontStyle2);
$section->addText('Cordial saludo. ',$fontStyle3);
$section->addText('Adjunto al presente muy comedidamente me permito hacerle llegar, copia del Reporte Mensual de Correspondencia concerniente al mes de '.$mes_r.'. Asimismo le informo que el documento original será enviado a la Dirección Ejecutiva Seccional de la Administración Judicial tal como lo establece el Acuerdo 657 – 99 en su Artículo 3.',$fontStyle3);
//$section->addTextBreak(2);


$section->addText($vector_datos[$p][nombre], $fontStylejuz, $paraStylejuz);

// Add table
$table = $section->addTable('myOwnTableStyle');

// Add row
$table->addRow(500);

// Add cells
$table->addCell(1500, $styleCell)->addText('Fecha', $fontStyle, $paraStyle);
$table->addCell(1000, $styleCell)->addText('Oficios Nacionales', $fontStyle, $paraStyle);
$table->addCell(1000, $styleCell)->addText('Oficios Urbanos', $fontStyle, $paraStyle);
$table->addCell(1000, $styleCell)->addText('Telegramas Nacionales', $fontStyle, $paraStyle);
$table->addCell(1000, $styleCell)->addText('Telegramas Urbanos', $fontStyle, $paraStyle);
$table->addCell(1100, $styleCell)->addText('Total Oficios', $fontStyle, $paraStyle);
$table->addCell(1000, $styleCell)->addText('Total Telegramas', $fontStyle, $paraStyle);


// Add more rows / cells
for($i = 0; $i < $cont; $i++) {
	$table->addRow();
	$table->addCell(1500, $styleCell)->addText($vector_datos_inf[$i][fecha], $fontStyle_cell, $paraStyle_cell);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_oficios_nacionales], $fontStyle_cell, $paraStyle_cell);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_oficios_urbanos], $fontStyle_cell, $paraStyle_cell);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_telegramas_nacionales], $fontStyle_cell, $paraStyle_cell);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_telegramas_urbanos], $fontStyle_cell, $paraStyle_cell);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_oficios], $fontStyle, $paraStyle);
	$table->addCell(1000, $styleCell)->addText($vector_datos_inf[$i][cantidad_telegramas], $fontStyle_cell, $paraStyle_cell);	
	
	
 }


//Firma
$section->addText('                ',$fontStyle3);
$section->addText('Atentamente,',$fontStyle4);
$section->addText('                ',$fontStyle3);
$section->addImage('views/images/firma.png', array('width'=>74, 'height'=>50, 'align'=>'center'));
$section->addText('ANDREA ARBELAEZ MENDOZA', $fontStyle45, $paraStyle45);
$section->addText('DIRECTORA DE LA OFICINA DE EJECUCIÓN CIVIL MUNICIPAL.',$fontStyle46, $paraStyle45);


if($validacion!=$p){
$section->addPageBreak();
}
$p = $p+1;


}

unset($vector_fechas);

//pie de página
$footer = $section->createFooter();
$footer->addPreserveText('Palacio de Justicia “Fanny González Franco” Carrera 23 No. 21 – 48 Oficina 411 Tel: (6) 8879620  - Ext: 11376 -11377 Manizales - Caldas

',$fontStyle1, $fontStyle1);



// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('views/word/Informe.doc');
$file = 'views/word/Informe.docx';
$id= 'Informe.docx';

$enlace = $file; 

$enlace = 'views/word/Informe.doc'; 
header ("Content-Disposition: attachment; filename=".$id); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

}
if($opcion==2)
{
require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');

// New Word Document
$PHPWord = new PHPWord();

$data= new wordModel();
$data_tabla= new wordModel();
$vector_datos= $data->obtenerActa();
$p = 0;


$section = $PHPWord->createSection();

$fontStyle45 = array ('bold' => true,'size'=>9);
$fontStyle46 = array ('size'=>11);
$paraStyle45 = array ('align' => 'center');

$fontStylejuz = array ('bold' => true,'size'=>9);
$paraStylejuz = array ('align' => 'center');


$fontStyle1 = array('name'=>'Times New Roman','size'=>11,'color'=>'lightGray','bold'=>true,'italic'=>true,'align'=>'center');
$fontStyle2 = array('name'=>'Arial','size'=>11,'align'=>'left','bold'=>false);
$fontStyle3 = array('name'=>'Arial','size'=>11,'align'=>'left');
$fontStyle4 = array('name'=>'Arial','size'=>11,'align'=>'center');
$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
$table->addCell(2000)->addImage('views/images/logo_consejo.png', array('width'=>68, 'height'=>88, 'align'=>'left'));
$table->addCell(4500)->addText('Rama Judicial del Poder Público Consejo Superior de la Judicatura Dirección Ejecutiva Administración Judicial Centro de Servicios Judiciales  para los Juzgados Civiles y Familia Manizales, Caldas',$fontStyle1, $fontStyle1);



$PHPWord->addTitleStyle(1, array('name'=>'Arial','size'=>11,'align'=>'center','bold'=>true));
$PHPWord->addTitleStyle(2, array('align'=>'center'));
$styleParagraph = array('name'=>'Arial','size'=>25,'align'=>'left', 'spaceAfter'=>100);



//$section->addPageBreak();
 $fecha = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha1 = strftime('%d de %B del %Y', strtotime($fecha));  






// Define table style arrays
$styleTable = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'cellMargin'=>5, 'align'=>'center');
$styleFirstRow = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable1 = array('borderSize'=>5, 'borderTopColor'=>'ffffff', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow1 = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'FFFFFF');

$styleTable2 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');
$styleFirstRow2 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable3 =    array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow3 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');

$styleTable5 = array('borderSize'=>5, 'borderColor'=>'000000', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow5 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');

$styleTable6 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow6 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

// Define cell style arrays
$styleCell = array('valign'=>'center');
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size'=>'9');
$paraStyle = array ('align' => 'center','size'=>'9');

$fontStyle_cell = array('align'=>'center','name'=>'Arial','size'=>'9');
$paraStyle_cell = array ('name'=>'Arial','size'=>'9','align' => 'center');

$fontStyle_cell2 = array('align'=>'left','name'=>'Arial','size'=>'9');
$paraStyle_cell2 = array ('name'=>'Arial','size'=>'9','align' => 'left');




// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
$PHPWord->addTableStyle('myOwnTableStyle1', $styleTable1, $styleFirstRow1);
$PHPWord->addTableStyle('myOwnTableStyle2', $styleTable2, $styleFirstRow2);
$PHPWord->addTableStyle('myOwnTableStyle3', $styleTable3, $styleFirstRow3);
$PHPWord->addTableStyle('myOwnTableStyle5', $styleTable5, $styleFirstRow5);
$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable6, $styleFirstRow6);

$cont =0;


//($vector_datos_inf);


$section->addText('ACTA DE RECIBIDO', $fontStyle45, $paraStyle45);



// Add table
$table = $section->addTable('myOwnTableStyle');

// Add row
$table->addRow(500);

// Add cells
$table->addCell(3000, $styleCell)->addText($vector_datos[0][consecutivo_acta], $fontStyle, $paraStyle);
$table->addCell(6000, $styleCell)->addText('FECHA: '.$fecha1, $fontStyle, $paraStyle);
$table->addCell(8000, $styleCell)->addText('ORIGEN: '.$vector_datos[0][juzgado], $fontStyle, $paraStyle);
$table->addCell(8000, $styleCell)->addText('DESTINO: Centro de Servicios Judiciales Civil-Familia', $fontStyle, $paraStyle);



// Add more rows / cells
$table1 = $section->addTable('myOwnTableStyle1');
$table1->addRow(500);
$table1->addCell(10000, $styleCell)->addText("OBJETIVO: Dejar constancia en el Centro de Servicios sobre los expedientes recibidos para realizar la gestión de archivo ", $fontStyle_cell, $paraStyle_cell);
$table1->addRow(500);
$table1->addCell(10000, $styleCell)->addText("RESPONSABLE: ".$vector_datos[0][nombre_recibe], $fontStyle2);
$section->addText('                ',$fontStyle3);
$table2 = $section->addTable('myOwnTableStyle2');
$table2->addRow(500);
$table2->addCell(10000, $styleCell)->addText("IMPORTANTE: Se solicita al juzgado que va a remitir los expedientes al Centro de servicios la relación detallada (Listado) especificando la cantidad de procesos, número de cuadernos y demás información que el despacho considere pertinente, en los casos en que el despacho no entregue los expedientes mediante lista, el Centro los recibirá mediante conteo físico en compañía del empleado asignado por parte del juzgado. Una vez realizada la gestión del archivo, los expedientes serán devueltos al Juzgado con la misma metodología en que se recibieron (mediante listado o conteo físico de cantidad de procesos)  ", $fontStyle_cell2, $paraStyle_cell2);
$table3 = $section->addTable('myOwnTableStyle2');
$table3->addRow(500);
$table3->addCell(10000, $styleCell)->addText("DESCRIPCIÓN ", $fontStylejuz, $paraStyle_cell2);
$table4 = $section->addTable('myOwnTableStyle3');
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    1. Expedientes entregados por el ".$vector_datos[0][juzgado]." al Centro de Servicios con el fin de ser archivados.  \n\n"." al Centro de Servicios con el fin de ser archivados  ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    2. La recepción la realiza el Servidor Judicial perteneciente al grupo de Archivo de expedientes de este Centro de Servicios  ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    3. Mes(es) a Archivar:  ".$vector_datos[0][meses]." correspondiente al año ".$vector_datos[0][ano_archivar], $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    4. Consecutivo de las Cajas recibidas del  ".$vector_datos[0][desde_caja]." al ".$vector_datos[0][hasta_caja]." y consecutivo de expedientes recibidos del ".$vector_datos[0][desde_expediente]." al ".$vector_datos[0][hasta_expediente]." (en caso de que el juzgado lo asigne). ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    5. Cantidad de Expedientes recibidos:  ".$vector_datos[0][cantidad_expedientes], $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    6. Cantidad de Cajas recibidas:  ".$vector_datos[0][cantidad_cajas], $fontStyle_cell2, $paraStyle_cell2);
$table5 = $section->addTable('myOwnTableStyle5');
$table5->addRow(500);
$table5->addCell(10000, $styleCell)->addText("", $fontStyle_cell, $paraStyle_cell);
$table6 = $section->addTable('myOwnTableStyle6');
$table6->addRow(500);
$table6->addCell(10000, $styleCell)->addText("OBSERVACIONES ", $fontStylejuz, $paraStyle_cell2);
$table6->addRow(500);
$table6->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);





//Firma
$section->addText('                ',$fontStyle3);
$section->addText('En constancia firman:',$fontStyle4);
$table8 = $section->addTable('myOwnTableStyle6');
$table8->addRow(500);
$table8->addCell(10000, $styleCell)->addText("NOMBRE DE QUIEN ENTREGA: (Juzgado) ", $fontStylejuz, $paraStyle2);
$table8->addCell(10000, $styleCell)->addText("NOMBRE DE QUIEN RECIBE: (Servidor Judicial CSSJJCF) ", $fontStylejuz, $paraStyle_cell2);
$table8->addRow(500);
$table8->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);
$table8->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);



$section->addText('                ',$fontStyle3);


//pie de página
$footer = $section->createFooter();
$footer->addPreserveText('Palacio de Justicia "Fanny González Franco" Carrera 23 N° 21-48, Ofc. 108 e-mail csjcfma@cendoj.ramajudicial.gov.co Manizales, Caldas',$fontStyle1, $fontStyle1);



// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('views/word/Acta_Recibido.doc');
$file = 'views/word/Acta_Recibido.docx';
$id= 'Acta_Recibido.docx';

$enlace = $file; 

$enlace = 'views/word/Acta_Recibido.doc'; 
header ("Content-Disposition: attachment; filename=".$id); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

}

if($opcion==3)
{
require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');

// New Word Document
$PHPWord = new PHPWord();

$data= new wordModel();
$data_tabla= new wordModel();
$vector_datos= $data->obtenerActaEntrega();
$p = 0;


$section = $PHPWord->createSection();

$fontStyle45 = array ('bold' => true,'size'=>9);
$fontStyle46 = array ('size'=>11);
$paraStyle45 = array ('align' => 'center');

$fontStylem = array ('size'=>7);
$paraStylem = array ('align' => 'left');

$fontStylejuz = array ('bold' => true,'size'=>9);
$paraStylejuz = array ('align' => 'center');


$fontStyle1 = array('name'=>'Times New Roman','size'=>11,'color'=>'lightGray','bold'=>true,'italic'=>true,'align'=>'center');
$fontStyle2 = array('name'=>'Arial','size'=>11,'align'=>'left','bold'=>false);
$fontStyle3 = array('name'=>'Arial','size'=>11,'align'=>'left');
$fontStyle4 = array('name'=>'Arial','size'=>11,'align'=>'center');
$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
$table->addCell(2000)->addImage('views/images/logo_consejo.png', array('width'=>68, 'height'=>88, 'align'=>'left'));
$table->addCell(4500)->addText('Rama Judicial del Poder Público Consejo Superior de la Judicatura Dirección Ejecutiva Administración Judicial Centro de Servicios Judiciales  para los Juzgados Civiles y Familia Manizales, Caldas',$fontStyle1, $fontStyle1);



$PHPWord->addTitleStyle(1, array('name'=>'Arial','size'=>11,'align'=>'center','bold'=>true));
$PHPWord->addTitleStyle(2, array('align'=>'center'));
$styleParagraph = array('name'=>'Arial','size'=>25,'align'=>'left', 'spaceAfter'=>100);



//$section->addPageBreak();
 $fecha = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha1 = strftime('%d de %B del %Y', strtotime($fecha));  






// Define table style arrays
$styleTable = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'cellMargin'=>5, 'align'=>'center');
$styleFirstRow = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable1 = array('borderSize'=>5, 'borderTopColor'=>'ffffff', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow1 = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'FFFFFF', 'align'=>'left');

$styleTable2 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');
$styleFirstRow2 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable3 =    array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow3 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');

$styleTable5 = array('borderSize'=>5, 'borderColor'=>'000000', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow5 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');

$styleTable6 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow6 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

// Define cell style arrays
$styleCell = array('valign'=>'center');
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size'=>'9');
$paraStyle = array ('align' => 'center','size'=>'9');

$fontStyle_cell = array('align'=>'center','name'=>'Arial','size'=>'9');
$paraStyle_cell = array ('name'=>'Arial','size'=>'9','align' => 'center');

$fontStyle_cell2 = array('align'=>'left','name'=>'Arial','size'=>'9');
$paraStyle_cell2 = array ('name'=>'Arial','size'=>'9','align' => 'left');




// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
$PHPWord->addTableStyle('myOwnTableStyle1', $styleTable1, $styleFirstRow1);
$PHPWord->addTableStyle('myOwnTableStyle2', $styleTable2, $styleFirstRow2);
$PHPWord->addTableStyle('myOwnTableStyle3', $styleTable3, $styleFirstRow3);
$PHPWord->addTableStyle('myOwnTableStyle5', $styleTable5, $styleFirstRow5);
$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable6, $styleFirstRow6);

$cont =0;


//($vector_datos_inf);


$section->addText('ACTA DE ENTREGA', $fontStyle45, $paraStyle45);



// Add table
$table = $section->addTable('myOwnTableStyle');

// Add row
$table->addRow(500);

// Add cells
$table->addCell(3000, $styleCell)->addText($vector_datos[0][consecutivo_acta], $fontStyle, $paraStyle);
$table->addCell(6000, $styleCell)->addText('FECHA: '.$fecha1, $fontStyle, $paraStyle);
$table->addCell(8000, $styleCell)->addText('ORIGEN: '.$vector_datos[0][juzgado], $fontStyle, $paraStyle);
$table->addCell(8000, $styleCell)->addText('DESTINO: Centro de Servicios Judiciales Civil-Familia', $fontStyle, $paraStyle);



// Add more rows / cells
$table1 = $section->addTable('myOwnTableStyle1');
$table1->addRow(500);
$table1->addCell(10000, $styleCell)->addText("OBJETIVO: Dejar constancia de entrega al juzgado correspondiente los expedientes archivados en el Centro de Servicios y los respectivos listados arrojados por el Sistema de Gestión de archivo SAIDOJ ", $fontStyle2);
$table1->addRow(500);
$table1->addCell(10000, $styleCell)->addText("RESPONSABLE: ".$vector_datos[0][nombre_recibe], $fontStyle2);
$section->addText('                ',$fontStyle3);

$table3 = $section->addTable('myOwnTableStyle2');
$table3->addRow(500);
$table3->addCell(10000, $styleCell)->addText("DESCRIPCIÓN ", $fontStylejuz, $paraStyle_cell2);
$table4 = $section->addTable('myOwnTableStyle3');
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    1. A continuación se entrega el listado arrojado por el Sistema de Gestión de Archivo SAIDOJ correspondiente a los expedientes a los cuales se les realizó el proceso de archivo definitivo, pertenecientes al ".$vector_datos[0][juzgado].".  ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    2. La entrega la realiza el Servidor Judicial perteneciente al grupo de Archivo de expedientes de este Centro de Servicios  ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    3. Mes Archivado:  ".$vector_datos[0][meses]." correspondiente al año ".$vector_datos[0][ano_archivar], $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    4. Consecutivo de las Cajas entregadas del  ".$vector_datos[0][desde_caja]." al ".$vector_datos[0][hasta_caja]." y consecutivo de expedientes entregados del ".$vector_datos[0][desde_expediente]." al ".$vector_datos[0][hasta_expediente].". ", $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    5. Cantidad de Expedientes Entregados:  ".$vector_datos[0][cantidad_expedientes], $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    6. Cantidad de Cajas Entregadas:  ".$vector_datos[0][cantidad_cajas], $fontStyle_cell2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("    7. Es importante resaltar que la entrega que se realiza cumple con los requisitos y exigencias establecidas internamente por el archivo central.", $fontStyle_cell2, $paraStyle_cell2);
$table5 = $section->addTable('myOwnTableStyle5');
$table5->addRow(500);
$table5->addCell(10000, $styleCell)->addText("", $fontStyle_cell, $paraStyle_cell);
$table6 = $section->addTable('myOwnTableStyle6');
$table6->addRow(500);
$table6->addCell(10000, $styleCell)->addText("OBSERVACIONES ", $fontStylejuz, $paraStyle_cell2);
$table6->addRow(500);
$table6->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);





//Firma
$section->addText('                ',$fontStyle3);
$section->addText('En constancia firman:',$fontStyle4);
$table8 = $section->addTable('myOwnTableStyle6');
$table8->addRow(500);
$table8->addCell(10000, $styleCell)->addText("NOMBRE DE QUIEN ENTREGA: ", $fontStylejuz, $paraStyle2);
$table8->addCell(10000, $styleCell)->addText("NOMBRE DE QUIEN RECIBE:  ", $fontStylejuz, $paraStyle_cell2);
$table8->addRow(500);
$table8->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);
$table8->addCell(10000, $styleCell)->addText(" ", $fontStyle_cell, $paraStyle_cell);
$section->addText('  ',$fontStyle4);
$section->addText('ANEXOS: ( ) SI ( ) NO. RELACIÓN DE PROCESOS ARCHIVADOS EN LOS AÑOS MENCIONADOS',$fontStylem);


$section->addText('                ',$fontStyle3);


//pie de página
$footer = $section->createFooter();
$footer->addPreserveText('Palacio de Justicia "Fanny González Franco" Carrera 23 N° 21-48, Ofc. 108 e-mail csjcfma@cendoj.ramajudicial.gov.co Manizales, Caldas',$fontStyle1, $fontStyle1);



// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('views/word/Acta_Entrega.doc');
$file = 'views/word/Acta_Entrega.docx';
$id= 'Acta_Entrega.docx';

$enlace = $file; 

$enlace = 'views/word/Acta_Entrega.doc'; 
header ("Content-Disposition: attachment; filename=".$id); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

}

if($opcion==4)
{
require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');

// New Word Document
$PHPWord = new PHPWord();

$data= new wordModel();
$data_tabla= new wordModel();
$vector_datos= $data->obtenerDatosReparto();
$p = 0;


$section = $PHPWord->createSection();

$fontStyle45 = array ('bold' => true,'size'=>11);
$fontStyle46 = array ('size'=>11);
$paraStyle45 = array ('align' => 'center');

$fontStylem = array ('size'=>11);
$paraStylem = array ('align' => 'left');

$fontStylejuz = array ('bold' => true,'size'=>11);
$paraStylejuz = array ('align' => 'center');


$fontStyle1 = array('name'=>'Times New Roman','size'=>11,'color'=>'lightGray','bold'=>true,'italic'=>true,'align'=>'center');
$fontStyle2 = array('name'=>'Arial','size'=>11,'align'=>'left','bold'=>false);
$fontStyle3 = array('name'=>'Arial','size'=>11,'align'=>'left');
$fontStyle4 = array('name'=>'Arial','size'=>11,'align'=>'center');
$header = $section->createHeader();
$table = $header->addTable();
$table->addRow();
$table->addCell(2000)->addImage('views/images/logo_ejecucion.png', array('width'=>92, 'height'=>63, 'align'=>'left'));
$table->addCell(4500)->addText('Rama Judicial del Poder Público	    Consejo Superior de la Judicatura	     Dirección Ejecutiva Administración Judicial Oficina de Ejecución Civil Municipal	    
Manizales, Caldas',$fontStyle1, $fontStyle1);
$table->addCell(2000)->addImage('views/images/logo_consejo.png', array('width'=>68, 'height'=>88, 'align'=>'right'));




$PHPWord->addTitleStyle(1, array('name'=>'Arial','size'=>11,'align'=>'center','bold'=>true));
$PHPWord->addTitleStyle(2, array('align'=>'center'));
$styleParagraph = array('name'=>'Arial','size'=>25,'align'=>'left', 'spaceAfter'=>100);



//$section->addPageBreak();
 $fecha = date('Y-m-d');
setlocale(LC_TIME, "Spanish");
$fecha1 = strftime('%d de %B del %Y', strtotime($fecha));  






// Define table style arrays
$styleTable = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'cellMargin'=>5, 'align'=>'center');
$styleFirstRow = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable1 = array('borderSize'=>5, 'borderTopColor'=>'ffffff', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow1 = array('borderBottomSize'=>5, 'borderBottomColor'=>'000000', 'bgColor'=>'FFFFFF', 'align'=>'left');

$styleTable2 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');
$styleFirstRow2 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

$styleTable3 =    array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow3 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');

$styleTable5 = array('borderSize'=>5, 'borderColor'=>'000000', 'cellMargin'=>5, 'align'=>'left');
$styleFirstRow5 = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');

$styleTable6 =    array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
$styleFirstRow6 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'CCCCCC');

// Define cell style arrays
$styleCell = array('valign'=>'center');
$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

// Define font style for first row
$fontStyle = array('bold'=>true, 'align'=>'center','size'=>'11');
$paraStyle = array ('align' => 'center','size'=>'11');

$fontStyle_cell = array('align'=>'center','name'=>'Arial','size'=>'11');
$paraStyle_cell = array ('name'=>'Arial','size'=>'11','align' => 'center');

$fontStyle_cell2 = array('align'=>'left','name'=>'Arial','size'=>'11');
$paraStyle_cell2 = array ('name'=>'Arial','size'=>'11','align' => 'left');




// Add table style
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
$PHPWord->addTableStyle('myOwnTableStyle1', $styleTable1, $styleFirstRow1);
$PHPWord->addTableStyle('myOwnTableStyle2', $styleTable2, $styleFirstRow2);
$PHPWord->addTableStyle('myOwnTableStyle3', $styleTable3, $styleFirstRow3);
$PHPWord->addTableStyle('myOwnTableStyle5', $styleTable5, $styleFirstRow5);
$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable6, $styleFirstRow6);

$cont =0;


//($vector_datos_inf);


$section->addText('ACTA INDIVIDUAL DE REPARTO', $fontStyle45, $paraStyle45);



$table3 = $section->addTable('myOwnTableStyle2');
$table3->addRow(500);
$table3->addCell(10000, $styleCell)->addText("Fecha Reparto:   ".$vector_datos[fecha_reparto], $fontStyle, $paraStyle);
$table3->addCell(10000, $styleCell)->addText("Radicado:   ".$vector_datos[radicado],$fontStyle, $paraStyle);
$table4 = $section->addTable('myOwnTableStyle3');
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("Clase Proceso:  ".$vector_datos[clase], $fontStyle2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("Repartido al Despacho:  ".$vector_datos[juzgado], $fontStyle2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("Demandante:  ".$vector_datos[demandante], $fontStyle2, $paraStyle_cell2);
$table4->addRow(500);
$table4->addCell(10000, $styleCell)->addText("Demandado:  ".$vector_datos[demandado], $fontStyle2, $paraStyle_cell2);

$table6 = $section->addTable('myOwnTableStyle6');
$table6->addRow(500);

$table6->addCell(10000, $styleCell)->addText("Quien reparte: ".$_SESSION['nombre'], $fontStyle2, $paraStyle_cell2);




// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('views/word/Acta_Reparto.doc');
$file = 'views/word/Acta_Reparto.docx';
$id= 'Acta_Reparto.docx';

$enlace = $file; 

$enlace = 'views/word/Acta_Reparto.doc'; 
header ("Content-Disposition: attachment; filename=".$id); 
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);

}

?>