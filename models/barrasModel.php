<?php
class barrasModel extends modelBase
{


/****************************************** Se obtiene un vector de empleados *******************************************
************************************ con numero de procesos realizados en una fecha ************************************/
	
	public function obtenerEmpleados()
	{	
		
		$fecha =$_GET['nombre1'];
		$empleados = $this->db->prepare("select usuario.iniciales_reporte,sum(procesos) as procesos, count(segui.idusuario) as cajas from seguimiento segui
inner join pa_usuario usuario on (usuario.id=segui.idusuario)
 where segui.fecha='$fecha'
 group by segui.idusuario");
 
		$empleados->execute();
		
		$i=0;
		$j=0;
		while($idE = $empleados->fetch())
		{
			$vector[$i][emple]=$idE[iniciales_reporte];
			$vector[$i][proces]=$idE[procesos];
			$vector[$i][caja]=$idE[cajas];
			
			$i= $i+1;
		}	
			
		//print_r $vector;			
		return $vector;
		
	}

/****************************************** Se obtiene un vector de empleados *******************************************
******************************* con numero de procesos realizados en un rango def  ************************************/
	
	public function obtenerEmpleadosR()
	{	
		
		
		$fechai =$_GET['nombre1'];
		$fechaf =$_GET['nombre2'];
		
		$empleados = $this->db->prepare("select usuario.iniciales_reporte,sum(procesos) as procesos, count(segui.idusuario) as cajas from seguimiento segui
inner join pa_usuario usuario on (usuario.id=segui.idusuario)
 where segui.fecha BETWEEN '$fechai' and '$fechaf'
 group by segui.idusuario");
 
		$empleados->execute();
		
		$i=0;
		$j=0;
		while($idE = $empleados->fetch())
		{
			$vector[$i][emple]=$idE[iniciales_reporte];
			$vector[$i][proces]=$idE[procesos];
			$vector[$i][caja]=$idE[cajas];
			
			$i= $i+1;
		}	
			
		//print_r $vector;			
		return $vector;
		
	}
			

 }

require ('views/jpgraph-3.0.7/src/jpgraph.php');
require ('views/jpgraph-3.0.7/src/jpgraph_line.php');
require ('views/jpgraph-3.0.7/src/jpgraph_bar.php');
 
$barra= new barrasModel();

$opcion_reporte=$_GET['nombre'];

if ($opcion_reporte==1)
{
 $vector_datos= $barra->obtenerEmpleados();
 //print_r($vector_datos);
  $cantidad= count($vector_datos);
 $i=0;
 while ($i<$cantidad)
 {
  $datos_x[$i]=$vector_datos[$i][emple];
  $datos_y[$i]=$vector_datos[$i][proces];
  $datos_l[$i]=$vector_datos[$i][caja];
  $i = $i+1; 
 }
 
//$l1datay = array(11,9,2,4,3,13,17);
$l1datay = $datos_l;
$l2datay = $datos_y;
@$max = max($l2datay);

if(isset($max))
{

//$datax=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug');
$datax=$datos_x;

//print_r($datax);
 
// Create the graph. 
$graph = new Graph(600,200);    
$graph->SetScale('textlin');
 
//$graph->img->SetMargin(40,130,20,40);
$graph->img->SetMargin(40,130,20,40);
$graph->SetShadow();
$graph->SetScale("textlin",1,$max);
$graph->SetTickDensity(TICKD_DENSE);
$graph->yscale->SetAutoTicks();
 
// Create the linear error plot
$l1plot=new LinePlot($l1datay);
$l1plot->SetColor('firebrick1');
$l1plot->SetWeight(2);
$l1plot->SetLegend('# Cajas');
 

 
// Create the bar plot
$bplot = new BarPlot($l2datay);
$bplot->SetFillColor('deepskyblue4@0.5');
$bplot->SetLegend('# Procesos');
 
// Add the plots to t'he graph
$graph->Add($bplot);
$graph->Add($l1plot);

// Show the actual value for each bar on top/bottom
$bplot->value->Show(true);
$bplot->value->SetFormat("%d");
$bplot->value->SetColor('deepskyblue4');


$l1plot->value->Show(true);
$l1plot->value->SetFormat("%d");
$l1plot->value->SetColor('firebrick1');
 
$graph->title->Set('Producción Diaria: '.$_GET['nombre1']."\n");
$graph->xaxis->title->Set('');
$graph->yaxis->title->Set('');
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
$graph->xaxis->SetTickLabels($datax);

 
// Display the graph
@unlink("views/barra/barra.png");
$graph->Stroke("views/barra/barra.png");

} 
else
{
 
  $_SESSION['elemento'] = "No existen registros para la fecha: ".$_GET['nombre1'];
  $_SESSION['elem_conscontrato'] = true;  
  echo '<script languaje="Javascript">location.href="index.php?controller=archivo&action=ReporteProduccionDiaria"</script>';
 
 
 
 } 
 
}
else if ($opcion_reporte==2)
{
   $vector_datos= $barra->obtenerEmpleadosR();
 //print_r($vector_datos);
  $cantidad= count($vector_datos);
 $i=0;
 while ($i<$cantidad)
 {
  $datos_x[$i]=$vector_datos[$i][emple];
  $datos_y[$i]=$vector_datos[$i][proces];
  $datos_l[$i]=$vector_datos[$i][caja];
  $i = $i+1; 
 }
 
//$l1datay = array(11,9,2,4,3,13,17);
$l1datay = $datos_l;
$l2datay = $datos_y;
@$max = max($l2datay);

if(isset($max))
{

//$datax=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug');
$datax=$datos_x;

//print_r($datax);
 
// Create the graph. 
$graph = new Graph(600,200);    
$graph->SetScale('textlin');
 
//$graph->img->SetMargin(40,130,20,40);
$graph->img->SetMargin(40,130,20,40);
$graph->SetShadow();
$graph->SetScale("textlin",1,$max);
$graph->SetTickDensity(TICKD_DENSE);
$graph->yscale->SetAutoTicks();
 
// Create the linear error plot
$l1plot=new LinePlot($l1datay);
$l1plot->SetColor('firebrick1');
$l1plot->SetWeight(2);
$l1plot->SetLegend('# Cajas');
 

 
// Create the bar plot
$bplot = new BarPlot($l2datay);
$bplot->SetFillColor('deepskyblue4@0.5');
$bplot->SetLegend('# Procesos');
 
// Add the plots to t'he graph
$graph->Add($bplot);
$graph->Add($l1plot);

// Show the actual value for each bar on top/bottom
$bplot->value->Show(true);
$bplot->value->SetFormat("%d");
$bplot->value->SetColor('deepskyblue4');


$l1plot->value->Show(true);
$l1plot->value->SetFormat("%d");
$l1plot->value->SetColor('firebrick1');
 
$graph->title->Set('Producción Fechas: '.$_GET['nombre1']." al ".$_GET['nombre2']."\n");
$graph->xaxis->title->Set('');
$graph->yaxis->title->Set('');
 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
$graph->xaxis->SetTickLabels($datax);

 
// Display the graph
@unlink("views/barra/barra.png");
$graph->Stroke("views/barra/barra.png");

} 
 else
 {
 
    $_SESSION['elemento'] = "No existen registros para las fecha: ".$_GET['nombre1']." al ".$_GET['nombre2'];
    $_SESSION['elem_conscontrato'] = true;  
    echo '<script languaje="Javascript">location.href="index.php?controller=archivo&action=ReporteProduccionRango" </script>';
  
 
 }
}	   
				

?>