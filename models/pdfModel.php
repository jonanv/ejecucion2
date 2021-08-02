<?php
require('views/pdf/fpdf.php');

class PDF  extends FPDF
{

//Cargar los datos
  function convertirTildess($cadena)
		{
		$cadena=str_replace("&aacute;","á",$cadena);
		$cadena=str_replace("Ã©","é",$cadena);
		$cadena=str_replace("Ã³","ó",$cadena);
		$cadena=str_replace("&eacute;","é",$cadena);
		$cadena=str_replace("&iacute;","í",$cadena);
		$cadena=str_replace("&oacute;","ó",$cadena);
		$cadena=str_replace("&uacute;","ú",$cadena);
		$cadena=str_replace("&ntilde;","ñ",$cadena);
		$cadena=str_replace("<br>","?",$cadena);
		

		$cadena=str_replace("&atilde;","?",$cadena);
		$cadena=str_replace("&etilde;","?",$cadena);
		$cadena=str_replace("&itilde;","?",$cadena);
		$cadena=str_replace("&otilde;","?",$cadena);
		$cadena=str_replace("&utilde;","?",$cadena);
		$cadena=str_replace("&ntilde;","?",$cadena);
		return $cadena;
     }
function LoadData($file)
{
	//Leer las líneas del fichero
			$ls = new PDF();
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		{
        $t=$ls-> convertirTildess($line);		
		$data[]=explode(';',chop($t));
		 
		}
	return $data;
}

//Tabla simple
function BasicTable($header,$data)
{
	//Cabecera
	foreach($header as $col)
		$this->Cell(40,7,$col,1);
	$this->Ln();
	//Datos
	foreach($data as $row)
	{
		foreach($row as $col)
			$this->Cell(40,6,$col,1);
		$this->Ln();
	}
}

//Una tabla más completa
function ImprovedTable($header,$data)
{
	//Anchuras de las columnas
	$w=array(40,35,40,45);
	//Cabeceras
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C');
	$this->Ln();
	//Datos
	foreach($data as $row)
	{
		$this->Cell($w[0],6,$row[0],'LR');
		$this->Cell($w[1],6,$row[1],'LR');
		$this->Cell($w[2],6,$row[2],'LR');
		$this->Cell($w[3],6,$row[3],'LR');
		$this->Cell($w[4],6,$row[4],'LR');
		$this->Cell($w[5],6,$row[5],'LR');
		/*$this->Cell($w[6],6,number_format($row[6]),'LR',0,'R');
		$this->Cell($w[7],6,number_format($row[7]),'LR',0,'R');*/
		$this->Ln();
	}
	//Línea de cierre
	$this->Cell(array_sum($w),0,'','T');
}

//Tabla coloreada
function FancyTable($header, $header1,$data,$columnas)
{
	//Colores, ancho de línea y fuente en negrita
	//$title='Reporte Clientes Registrados';
	//$this->Cell(30,10,'Title',1,0,'C');
	$this->SetFillColor(128,0,0);
	$this->SetTextColor(255);
	$this->SetDrawColor(55,0,0);
	$this->SetLineWidth(.2);
	$this->SetFont('','B');
	//Cabecera
	if($columnas==1){
	$w=array(58,-0.1,0,0,0,0);}
	if($columnas==2){
	$w=array(58,27,0,0,0,0);}
	if($columnas==3){
	$w=array(58,27,27,0,0,0);}
	if($columnas==4){
	$w=array(58,27,27,27,0,0);}
	if($columnas==5){
	$w=array(58,27,27,27,27,0);}
	if($columnas==6){
	$w=array(36,27,27,40,27,37);}
		
	for($i=0;$i<count($header1);$i++)
		$this->Cell($w[$i],7,$header1[$i],1,0,'C',1);
	$this->Ln();
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
	$this->Ln();
	
	//Restauración de colores y fuentes
	$this->SetFillColor(206,206,206);
	$this->SetTextColor(0);
	$this->SetFont('');
	//Datos
	$fill=0;
	foreach($data as $row)
	{
		$this->Cell($w[0],7,$row[0],'LR',0,'L',$fill);
		$this->Cell($w[1],7,$row[1],'LR',0,'L',$fill);
		if($columnas==3){
		$this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
		}
		if($columnas==4){
		$this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
		$this->Cell($w[3],7,$row[3],'LR',0,'L',$fill);
		}
		if($columnas==5){
		$this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
		$this->Cell($w[3],7,$row[3],'LR',0,'L',$fill);
		$this->Cell($w[4],7,$row[4],'LR',0,'L',$fill);
		}
		if($columnas==6){
		$this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
		$this->Cell($w[3],7,$row[3],'LR',0,'L',$fill);
		$this->Cell($w[4],7,$row[4],'LR',0,'L',$fill);		
		$this->Cell($w[5],7,$row[5],'LR',0,'L',$fill);
		}
		
		$this->Ln();
		$fill=!$fill;
	}
	$this->Cell(array_sum($w),0,'','T');
}
function Header()

{   
    //Select Arial bold 15
    $this->SetFont('Arial','B',7);
    //Move to the right
    $this->Cell(80);
    //Framed title 2 noi muestra línea
	 
    $this->Cell(50,30,'Reporte Generado Fecha: '.date("m/d/y"),2,0,'C');
    //Line break
    $this->Ln(30);
}
}



$pdf=new PDF();
//Títulos de las columnas
$rut=$_GET["nombre"];
$head=explode(';',$rut);
$rut1= $head[0];
$columnas= $head[1];
//$columnas= 3; 
$ruta1="reporte".$rut1.".txt";
$tipo=$rut1;
//$tipo=2;
//si es de tipo cero es reporte de clientes registrados
if($tipo==1)
{
 $header=array('Nombre');
 $header1=array('Reporte de Hombres');
}
//si es de tipo uno es reporte de ventas por rango de fecha
if($tipo==2)
{
 $header=array('Nombre');
 $header1=array('Reporte de Mujeres');
}
//si es de tipo dos es reporte de area de produccion
if($tipo==3)
{
 $header=array('Nombre');
 $header1=array('Reporte de edad');
}
//si es de tipo tres es reporte de area de oportunidades
if($tipo==4)
{
 $header=array('Nombre');
 $header1=array('Reporte de Nivel Educativo');
}//si es de tipo cuatro es reporte de actividades
if($tipo==5)
{
 $header=array('Nombre');
 $header1=array('Reporte de Lugar de Nacimiento');
}//si es de tipo cuatro es reporte de actividades
if($tipo==6)
{
 $header=array('Nombre');
 $header1=array('Reporte de cabezas de familia');
}
if($tipo==7)
{
 $header=array('Nombre');
 $header1=array('Reporte tiene familia');
}
if($tipo==8)
{
 
 $header=array('Nombre','Prestacion');
 $header1=array('Reporte Prestaciones');
}
if($tipo==9)
{
 
 $header=array('Nombre','Apellidos','Cedula','Email','Empresa','Fecha Inscripción');
 $header1=array('Reporte Clientes Antiguos');

}
if($tipo==10)
{
 
 $header=array('Nombre','Apellidos','Cedula','Email','Empresa','Fecha Inscripción');
 $header1=array('Reporte Clientes Nuevos');

}
if($tipo==11)
{
 $header=array('Nombre');
 $header1=array('Reporte de vivienda');
}
if($tipo==12)
{
 $header=array('Nombre');
 $header1=array('Reporte estado civil');
}
if($tipo==13)
{
 $header=array('Nombre');
 $header1=array('Reporte hijos');
}
if($tipo==14)
{
 
 $header=array('Nombre Hijo','Hobbies');
 $header1=array('Reporte hobbies');

}
if($tipo==15)
{
 
 $header=array('Tipo de Vehiculo','Placa','Descripción','Fecha');
 $header1=array('Reporte Parqueadero');

}
if($tipo==16)
{
 
 $header=array('Habitación','Fecha','Hora','Observaciones','Lenceria');
 $header1=array('Reporte Cuarto de Lino');

}
if($tipo==17)
{
 
 $header=array('Habitación','Fecha','Hora','Observaciones','Tipo de Servicio');
 $header1=array('Reporte Area Humeda');

}
if($tipo==18)
{
 
 $header=array('Evento','Salón','Responsable','Fecha Inicio ','Hora Inicio','Costo');
 $header1=array('Reporte Eventos');

}
if($tipo==19)
{
 
 $header=array('Fecha','Servicio','Descripción','Cliente ','Ciudad','Estado');
 $header1=array('Reporte Cotizacion Ciudad');

}
if($tipo==20)
{
 
 $header=array('Fecha','Servicio','Visita','Cliente ','Ciudad','Estado');
 $header1=array('Reporte Visita Cotización');

}
if($tipo==21)
{
 
 $header=array('Fecha','Servicio','Cliente','Valor','Ciudad');
 $header1=array('Reporte Cotizaciones');

}
if($tipo==22)
{
 
 $header=array('Fecha-hora','Tipo','Area','Descripción ','Responsable','Cliente');
 $header1=array('Reporte qrs');

}
if($tipo==23)
{
 
 $header=array('Fecha','Valor','Estado','Nombre ','Numero Comunicado');
 $header1=array('Reporte anticipo');

}
if($tipo==24)
{
 
 $header=array('Evento','Salón','Responsable','Fecha Inicio ','Fecha Fin');
 $header1=array('Reporte Eventos');

}
if($tipo==25)
{
 $header=array('Fecha','Nº Servicios','Tipo','Nº Personas','Nº Cubiertos');
 $header1=array('Servicio Restaurante');

}
if($tipo==26)
{
 
 $header=array('Nombre Cliente','Apellidos','NIT','Telefono ','Empresa');
 $header1=array('Reporte Clientes');

}
if($tipo==27)
{
 
 $header=array('Nombre','Fecha','Hora','Recorrido','Cobro');
 $header1=array('Reporte URVAN');

}
//Carga de datos
 date_default_timezone_set('America/Bogota');
$ruta="views/reporte/".$ruta1;
$data=$pdf->LoadData($ruta);
$pdf->SetFont('Arial','',7);
//$pdf->AddPage();
$pdf->Header();
$pdf->AddPage();
$pdf->FancyTable($header,$header1,$data,$columnas);

$pdf->Output();
?>