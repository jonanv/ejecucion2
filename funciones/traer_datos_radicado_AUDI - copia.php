<?php

	//NOTA: 
	//ESTE SCRIPT TRAE TANTO INFORMACION DEL PROCESO, COMO LA FECHA DE FIJA ESTADO
	//SEGUNE LA FECHA ACTUAL, EN ESTE CASO SI POR EJEMPLO ES 2019-08-14 LA FECHA DE FIJAR ESTADO ES
	//2019-08-15, IMPORTANTE, SI SE CREAN AUDIENCIAS EL SABADO, DOMINGO O FESTIVOS
	//EL SISTEMA GENERA UNA INCOSISTENCIA EN LA FECHA DE FIJA ESTADO, YA QUE EL SCRIPT
	//DETERMINA QUE DIA ES SABADO, DOMINGO Y FESTIVOS Y LOS TOMA COMO DIAS INHABILES
	//
	/*if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
				
		$inhabiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
		
	}*/
	
	
	require_once('../libs/Conexion_Funciones.php');
	
	//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
	require('Festivos.php');
	
	//SE AGREGA LINEA, PERO SIN ELLA EL ALGORITMO TIENE EL MISMO EFECTO
	//SOLO SE PONE POR PRECAUCION
	date_default_timezone_set('America/Bogota');
	
	
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

	
	
	

	$cadena        = "";
	$cadenafechas  = "";
	$cadena_juntas = "";
	
	$idradicado		= trim($_GET['idradicado']);
	$audi_fecha_X	= trim($_GET['audi_fecha_X']);
	
	$conexion = db_connect();
	
	$sql = "SELECT ubi.id AS idradicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
			pj.nombre AS jo,pj.id AS idjo,pr.nombre AS jd,pr.id AS idjd
	        FROM (((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
			LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
			LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
			WHERE radicado = '$idradicado'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["idradicado"];
		$datos1  = $fila["cedula_demandante"];
		$datos2  = utf8_encode($fila["demandante"]);
		$datos3  = $fila["cedula_demandado"];
		$datos4  = utf8_encode($fila["demandado"]);
		$datos5  = utf8_encode($fila["claseproceso"]);
		$datos6  = utf8_encode($fila["jo"]);
		$datos7  = utf8_encode($fila["jd"]);
		$datos8  = $fila["idjo"];
		$datos9  = $fila["idjd"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9;
		
   	}
	
	//echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
	
	
	
//REALIZO ESTE WHILE PARA QUE CALCULE DE UNA VEZ LA FECHA INCIAL Y FINAL DEL TRASLADO
$if = 0;
while($if < 2){
	
	//FECHA INICAL
	if($if == 0){
	
		$fechat = trim($_GET['audi_fecha_X']);
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
	
		$fechat = trim($_GET['audi_fecha_X']);
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
	
	for($y=2014; $y<=2019; $y++){
	
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

//echo $habiles[$diasti+$contador];
//echo $cadenafechas;
	
	
$cadena_juntas	= $cadena."******".$cadenafechas;

echo trim($cadena_juntas);
	
	
	
?>
   

	

	
	