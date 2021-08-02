<?php

//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
require('Festivos.php');

//SE AGREGA LINEA, PERO SIN ELLA EL ALGORITMO TIENE EL MISMO EFECTO
//SOLO SE PONE POR PRECAUCION
date_default_timezone_set('America/Bogota');

$anio = date('Y');

//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
$dias_festivos = new festivos($anio);

function get_festivo($startX){

	$dias_festivos_2 = new festivos($anio);
	
	$fechat = trim($startX);
	$date   = date_create($fechat);
	$fechat = date_format($date,'Y-n-j');
			
	$fecha = explode("-",$fechat);
			
	$year  = $fecha[0];
	$month = $fecha[1];
	$day   = $fecha[2];

	$esfestivoX = $dias_festivos_2->esFestivo($day,$month);
	
	return 	$esfestivoX;
}


$fechat = trim($_GET['fechat']);
$date   = date_create($fechat);
$fechat = date_format($date,'Y-n-j');
		
$fecha = explode("-",$fechat);
		
$year  = $fecha[0];
$month = $fecha[1];
$day   = $fecha[2];
		
		
$date = date('D', mktime(0,0,0,$month,$day,$year));
				
//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
$esfestivo = $dias_festivos->esFestivo($day,$month);
				
if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){		
	
	//echo "ES FESTIVO";
	
	if($date == 'Sat'){
	
		$fecha_actual = date($fechat);
		$startX       = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));
		//$start        = strtotime($startX) * 1000;
		
		$fes = get_festivo($startX);
		
		if($fes == 1){
		
			$fecha_actual = date($startX);
			$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
		
		}
	
	}
	
	if($date == 'Sun' or $esfestivo == 1){
	
		$fecha_actual = date($fechat);
		$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
		//$start        = strtotime($startX) * 1000;
		
		$fes = get_festivo($startX);
		
		if($fes == 1){
		
			$fecha_actual = date($startX);
			$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
		
		}
	}
	
	
}
else{
	
	//echo "NO ES FESTIVO";
	
	$startX = $fechat;
}
	
	
echo $startX;


?>

   

	

	
	