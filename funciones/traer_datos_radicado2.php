<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idradicado		= trim($_GET['idradicado']);
	
	$conexion = db_connect();
	
	$sql = "SELECT ubi.id,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
			pj.nombre AS jo,pr.nombre AS jd
	        FROM (((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
			LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
			LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
			WHERE radicado = '$idradicado'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id"];
		$datos1  = $fila["cedula_demandante"];
		$datos2  = utf8_encode($fila["demandante"]);
		$datos3  = $fila["cedula_demandado"];
		$datos4  = utf8_encode($fila["demandado"]);
		$datos5  = utf8_encode($fila["claseproceso"]);
		$datos6  = utf8_encode($fila["jo"]);
		$datos7  = utf8_encode($fila["jd"]);
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7;
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	