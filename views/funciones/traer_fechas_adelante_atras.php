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

$fechax    = trim($_GET['fechax']);

$fechax_2  = explode("------",$fechax);

//PARA CALCULAR FECHA FINAL A LA FECHA DE FIJACION
$fechat    = $fechax_2[0];

//PARA CALCULAR FECHA - 1 A LA FECJA DEL AUTO
$fechat_2  = explode("-",$fechax_2[1]);

$fechat_2Y = $fechat_2[0];
$fechat_2M = $fechat_2[1];
$fechat_2D = $fechat_2[2];


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

//REALIZO ESTE WHILE PARA QUE CALCULE DE UNA VEZ LA FECHA INCIAL Y FINAL DEL TRASLADO
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
		
		$diasti = 1;
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
		
		$diasti = 3;
	}
	
	//extract($_POST);
	if(!isset($day) or !isset($month) or !isset($year) or !isset($diasti)){ exit; }
	
	$inhabiles = array('5/2/2013');
	$habiles   = array();
	
	for($y=2014; $y<=date('Y') + 1; $y++){
	
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
	
	$date = $day.'/'.$month.'/'.$year;
	$contador = array_search($date,$habiles);
	
	$cadenafechas .= $habiles[$diasti+$contador]." ";
	
	$if = $if + 1;

}//FIN WHILE

//*******************************************************************************************************
//FECHA PARA ATRAS, //FECHA - 1 A LA FECJA DEL AUTO

date_default_timezone_set('America/Bogota');
	
	$contdias      = 0;
	$contdias2     = 0;
	$cadenafechasX = "";
	
	while($contdias <= 1){
	
		//$dt_Ayer = date('Y-m-d', strtotime('-1 day')) ; // resta 1 día
		
		
		//-> nos da la fecha segun $contdias2, a partir de la actual
		//$dt_Ayer   = date( "Y-m-d",mktime(0, 0, 0, date("m"),date("d") - $contdias2, date("Y"))); 
		$dt_Ayer   = date( "Y-m-d",mktime(0, 0, 0, $fechat_2M,$fechat_2D - $contdias2, date("Y"))); 
		
		//ejemplos 2015-05-04 2015-05-13 2015-04-28 2015-07-10
		//$dt_Ayer   = date( "Y-m-d",mktime(0, 0, 0, 08,03 - $contdias2, 2016)); 
		
		$dt_Ayer_2 = explode("-",$dt_Ayer);
		
		$y = $dt_Ayer_2[0];
		$m = $dt_Ayer_2[1];
		$d = $dt_Ayer_2[2];
		
		$date = date('D', mktime(0,0,0,$m,$d,$y));
		
		//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
		$dias_festivos = new festivos($y);
		$esfestivo     = $dias_festivos->esFestivo($d,$m);
			
		if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
			
			$bandera = 1;
			
		}
		else{
	
			$cadenafechasX .= $dt_Ayer."//////";
			
			//CONTADOR DEL WHILE QUE SE INCREMENTE SI UNA FECHA ES HABIL, 
			//ES DECIR NO ES SABADO, DOMINGO O FISTIVO
			$contdias = $contdias + 1;
			
		}
		
		//CONTADOR PARA CONTROLAR LAS FECHAS PARA ATRAS APARTIR DEL DIA ACTUAL
		$contdias2 = $contdias2 + 1;

	}
	
	
	
	
	$cadenafechas_2 = explode("//////",$cadenafechasX);
	$longitud       = count($cadenafechas_2) - 2;
	
	//$filtrofechas = "dc.observacion LIKE '%Traslado Art. 108 Fec Fijacion: ".$cadenafechas_2[0]."%' OR dc.observacion LIKE '%Traslado Art. 108 Fec Fijacion: ".$cadenafechas_2[1]."%' OR dc.observacion LIKE '%Traslado Art. 108 Fec Fijacion: ".$cadenafechas_2[2]."%' OR dc.observacion LIKE '%Traslado Art. 108 Fec Fijacion: ".$cadenafechas_2[3]."%'";
	
	/*$filtrofechas = "di.partes LIKE '%//////".$cadenafechas_2[0]."//////FRENTE%' OR di.partes LIKE '%//////".$cadenafechas_2[1]."//////FRENTE%' OR di.partes LIKE '%//////".$cadenafechas_2[2]."//////FRENTE%'
	                  OR di.partes LIKE '%//////".$cadenafechas_2[0]."//////EN CONTRA%' OR di.partes LIKE '%//////".$cadenafechas_2[1]."//////EN CONTRA%' OR di.partes LIKE '%//////".$cadenafechas_2[2]."//////EN CONTRA%'";*/
	
	//echo $filtrofechas;
	
	//echo $cadenafechas."  LONGITUD:  ".$longitud;


//echo $habiles[$diasti+$contador];
echo $cadenafechas."******".$cadenafechasX;

?>

   

	

	
	