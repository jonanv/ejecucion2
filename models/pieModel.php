<?php
class pieModel extends modelBase
{
	
	/*************************************** Se obtiene un vector de juzgados *******************************************
******************************************* con numero de procesos realizados  ************************************/
	
	public function obtenerJuzgadosProcesosCajas()
	{	
		
		
		$juzgados = $this->db->prepare("select juzgado.nombre,sum(procesos) as procesos,count(segui.idjuzgado) as cajas from seguimiento segui 
INNER JOIN pa_juzgado juzgado ON (segui.idjuzgado=juzgado.id)
group by juzgado.nombre");
 
		$juzgados->execute();
		
		$i=0;
		$j=0;
		while($idE = $juzgados->fetch())
		{
			$vector[$i][nombre_juz]=$idE[nombre];
			$vector[$i][proces]=$idE[procesos];
			$vector[$i][caja]=$idE[cajas];
			
			$i= $i+1;
		}	
			
		//print_r $vector;			
		return $vector;
		
	}

  
	
	function comparafechas($fecha1, $fecha2)
{	
	
	$fecha_ar=explode('-',$fecha1); // $fecha se supone en 'Y-m-d'
    $fecha_timestamp=mktime(0,0,0,$fecha_ar[1],$fecha_ar[2],$fecha_ar[0]);
	$fecha_ar1=explode('-',$fecha2);
    $fecha1_timestamp=mktime(0,0,0,$fecha_ar1[1],$fecha_ar1[2],$fecha_ar1[0]);
    if ($fecha_timestamp<$fecha1_timestamp) 
	{
       //echo 'menor';
	   return 0;
	} 
 else
  {
    if ($fecha_timestamp==$date_timestamp) 
	 {
      //echo 'igual';
	  return 1;
	 }
	 else
	 {
	   //echo 'mayor';
	   return 2;
	 } 
  }	
}
	public function convertirTildess($cadena)
		{
		$cadena=str_replace("&aacute;","á",$cadena);
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

	
		
}	
		require 'views/jpgraph-3.0.7/src/jpgraph.php';
		require 'views/jpgraph-3.0.7/src/jpgraph_pie.php';
		
		
		
		$pie= new pieModel();
		$opcion_reporte=$_GET['nombre'];

		if ($opcion_reporte==1)
		{
 		$vector_datos= $pie->obtenerJuzgadosProcesosCajas();
		$cantidad= count($vector_datos);
	    $i=0;
	    while ($i<$cantidad)
	   {
	   $datos_pie[$i]=$vector_datos[$i][caja];
	   $leyenda[$i]=$vector_datos[$i][nombre_juz].": ".$vector_datos[$i][caja];
	   
	   $i = $i+1; 
	   }
		
		
		$data= $datos_pie;
	 		
		$graph = new PieGraph(500,300);
		$graph->SetShadow();
 
		$graph->title->Set("# CAJAS");
		$graph->title->SetFont(FF_FONT1,FS_BOLD);
 
		$p1 = new PiePlot($data);
		$p1->SetLegends($leyenda);
		$p1->SetCenter(0.3);
 
		$graph->Add($p1);
		@unlink("views/pie/pie.png");
		$graph->Stroke("views/pie/pie.png");
				
		}
		
 	
	
?>	