<?php

//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
require('Festivos.php');

//SE AGREGA LINEA, PERO SIN ELLA EL ALGORITMO TIENE EL MISMO EFECTO
//SOLO SE PONE POR PRECAUCION
date_default_timezone_set('America/Bogota');

/*$fechafijacion = trim($_GET['fechafijacion']);
$date          = date_create($fechafijacion);
$fechafijacion = date_format($date,'Y-n-j');

$fecha = explode("-",$fechafijacion);

$year  = $fecha[0];
$month = $fecha[1];
$day   = $fecha[2];

$diasti = trim($_GET['dias']);*/

function get_days_for_month($m,$y){

	if($m == 02){ 
		if(($y % 4 == 0) && (($y % 100 != 0) || ($y % 400 == 0))){
			return 29;
		}else{
			return 28;
		}
	}
    if ($m == 4 || $m == 6 || $m == 9 || $m == 11){
        return 30;
	}else{
	    return 31;
	}
}


function recursivo_sabado_domingo($nuevafecha){


	//------------DETERMINA SI LA NUEVA FECHA ES FESTIVO----------------
			
	$date   = date_create($nuevafecha);
	$fechat = date_format($date,'Y-n-j');
					
	$fecha = explode("-",$fechat);
					
	$year  = $fecha[0];
	$month = $fecha[1];
	$day   = $fecha[2];
	
	$date_2 = date('D', mktime(0,0,0,$month,$day,$year));
			
	//SABADO, SE SUMAN 2 DIAS
	if($date_2 == 'Sat'){
		
		//$fecha      = date('Y-m-j');
		$nuevafecha = strtotime ( '+2 day' , strtotime ( $fechat ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			
		$nuevafecha = recursivo_festivo($nuevafecha);
			
	}
		
	//DOMINGO, SE SUMAN 1 DIA
	if($date_2 == 'Sun'){
		
		//$fecha      = date('Y-m-j');
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fechat ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			
		$nuevafecha = recursivo_festivo($nuevafecha);
			
	}
	
	return $nuevafecha;		
	
}

function recursivo_festivo($nuevafecha){


	//------------DETERMINA SI LA NUEVA FECHA ES FESTIVO----------------
			
	$date   = date_create($nuevafecha);
	$fechat = date_format($date,'Y-n-j');
					
	$fecha = explode("-",$fechat);
					
	$year  = $fecha[0];
	$month = $fecha[1];
	$day   = $fecha[2];
	
	//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
	$dias_festivos_2 = new festivos($year);
	$esfestivo_2     = $dias_festivos_2->esFestivo($day,$month);
			
	if($esfestivo_2 == 1){
			
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $fechat ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
		
		$nuevafecha = recursivo_festivo($nuevafecha);
		
		
			
	}
	
	$nuevafecha = recursivo_sabado_domingo($nuevafecha);
	
	return $nuevafecha;		
	
}

//----------------------------------------------------------------------------------------------

	//21 DE AGOSTO 2020
	//CALCULO SI LA FECHA ACTUAL ES SABADO,DOMINGO O FESTIVO Y SUMO A LA FECHA HABIL SIGUIENTE
	//ESTO CON EL OBJETO DE QUE CUANDO SE ASIGNE UNA TAREA POR PARTE DE JUEZ 
	//LA FECHA INICIAL Y FINAL NO SALGAN CON INCONSISTENCIAS

	//$fechat = trim('2020-08-22');
	
	//$fechat = trim('2020-04-09');
	
	$fechat = trim($_GET['fechat']);
	$date   = date_create($fechat);
	$fechat = date_format($date,'Y-n-j');
			
	$fecha = explode("-",$fechat);
			
	$year  = $fecha[0];
	$month = $fecha[1];
	$day   = $fecha[2];
			
			
	//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
	$dias_festivos = new festivos($year);

	//extract($_POST);
	//if(!isset($day) or !isset($month) or !isset($year) or !isset($diasti)){ exit; }
	
	if(!isset($day) or !isset($month) or !isset($year)){ exit; }
	
	
	$date = date('D', mktime(0,0,0,$month,$day,$year));
				
	//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
	$esfestivo = $dias_festivos->esFestivo($day,$month);
				
	if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
				
		
		
		//$nueva_fecha = "NO ES HABIL";
		
		//SABADO, SE SUMAN 2 DIAS
		if($date == 'Sat'){
		
			//$fecha      = date('Y-m-j');
			$nuevafecha = strtotime ( '+2 day' , strtotime ( $fechat ) ) ;
			$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			
			$nuevafecha = recursivo_festivo($nuevafecha);
			
		}
		
		//DOMINGO, SE SUMAN 1 DIA
		if($date == 'Sun'){
		
			//$fecha      = date('Y-m-j');
			$nuevafecha = strtotime ( '+1 day' , strtotime ( $fechat ) ) ;
			$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			
			$nuevafecha = recursivo_festivo($nuevafecha);
			
		}
		
		//FESTIVO, SE SUMAN 1 DIA
		if($esfestivo == 1){
		
			//$fecha      = date('Y-m-j');
			$nuevafecha = strtotime ( '+1 day' , strtotime ( $fechat ) ) ;
			$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			
			$nuevafecha = recursivo_festivo($nuevafecha);
			
		}
		
		
		
		//echo $nuevafecha;

	}
	else{
				
		
		$nuevafecha = $fechat;
		
		//echo $nuevafecha;
		
	}
	
	
//----------------------------------------------------------------------------------------------



$fechat = $nuevafecha;


//REALIZO ESTE WHILE PARA QUE CALCULE DE UNA VEZ LA FECHA INCIAL Y FINAL DE LA TAREA ASIGNADA
$if = 0;
while($if < 2){
	
	//FECHA INICAL
	if($if == 0){
	
		//$fechat = trim($_GET['fechat']);
		$date   = date_create($fechat);
		$fechat = date_format($date,'Y-n-j');
		
		$fecha = explode("-",$fechat);
		
		$year  = $fecha[0];
		$month = $fecha[1];
		$day   = $fecha[2];
		
		$diasti = 0;
	}
	//FECHA FINAL
	if($if == 1){
	
		//$fechat = trim($_GET['fechat']);
		$date   = date_create($fechat);
		$fechat = date_format($date,'Y-n-j');
		
		$fecha = explode("-",$fechat);
		
		$year  = $fecha[0];
		$month = $fecha[1];
		$day   = $fecha[2];
		
		//$diasti = 20;
		
		$diasti = trim($_GET['dias']);
		
		
	}
	
	//extract($_POST);
	if(!isset($day) or !isset($month) or !isset($year) or !isset($diasti)){ exit; }
	
	$inhabiles = array('5/2/2013');
	$habiles   = array();
	
	//for($y=2014; $y<=2020; $y++){
	for($y=2020; $y<=date('Y') + 1; $y++){
	
		//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
		$dias_festivos = new festivos($y);
	
		for($m=1; $m<=12; $m++){
		
			for($d=1; $d<=get_days_for_month($m,$y); $d++){
			
				$date = date('D', mktime(0,0,0,$m,$d,$y));
				
				//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
				$esfestivo = $dias_festivos->esFestivo($d,$m);
				
				if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
				
					$inhabiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
				}
				else{
				
					if(!in_array(date("j/n/Y", mktime(0,0,0,$m,$d,$y)),$inhabiles)){
						$habiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
					}
				}
				
				
			}
		}
	}
	
	$date     = $day.'/'.$month.'/'.$year;
	$contador = array_search($date,$habiles);
	
	$cadenafechas .= $habiles[$diasti+$contador]." ";
	
	$if = $if + 1;

}//FIN WHILE

//echo $habiles[$diasti+$contador];
echo $cadenafechas;

?>

   

	

	
	