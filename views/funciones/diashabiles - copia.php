<?php

//SE AGREGA LINEA, PERO SIN ELLA EL ALGORITMO TIENE EL MISMO EFECTO
//SOLO SE PONE POR PRECAUCION
date_default_timezone_set('America/Bogota');

$datos = explode("//////////",trim($_POST['datos']));

$fecha  = explode("-",$datos[0]);

$year  = $fecha[0];
$month = $fecha[1];
$day   = $fecha[2];

$diasti = $datos[1];

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



if(!isset($day) or !isset($month) or !isset($year) or !isset($diasti)){ exit; }

$inhabiles = array('5/2/2013');
$habiles = array();

for($y=2014; $y<=2014; $y++){
	for($m=1; $m<=12; $m++){
		for($d=1; $d<=get_days_for_month($m,$y); $d++){
			$date = date('D', mktime(0,0,0,$m,$d,$y));
			if($date == 'Sat' or $date == 'Sun'){
				$inhabiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
			}else{
				if(!in_array(date("j/n/Y", mktime(0,0,0,$m,$d,$y)),$inhabiles)){
					$habiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
				}
			}
		}
	}
}

$date = $day.'/'.$month.'/'.$year;
$contador = array_search($date,$habiles);;

echo $habiles[$diasti+$contador];

?>








