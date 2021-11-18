<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idradicado = trim($_GET['idradicado']);
	
	//$dato_2     = trim($_GET['fechaie']);
    //$dato_3     = trim($_GET['fechafe']);
	
	$conexion = db_connect();
			
	$sql = "SELECT ubi.id AS idradicado,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,
			pc.nombre AS claseproceso,pj.nombre AS jo,pj.id AS idjo,pr.nombre AS jd,ubi.posicion,ubi.observacion_archivo,
			dc.fecha,dc.observacion,u.empleado
			FROM (((((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
			LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
			LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
			LEFT JOIN detalle_correspondencia dc ON ubi.id = dc.idcorrespondencia)
			LEFT JOIN pa_usuario u ON dc.idusuario = u.id)
			WHERE ubi.radicado LIKE '%$idradicado%'";
	

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		//DATOS DEL PROCESO
		/*$datos0  = $fila["idradicado"];
		$datos1  = $fila["cedula_demandante"];
		$datos2  = utf8_encode($fila["demandante"]);
		$datos3  = $fila["cedula_demandado"];
		$datos4  = utf8_encode($fila["demandado"]);
		$datos5  = utf8_encode($fila["claseproceso"]);
		$datos6  = utf8_encode($fila["jo"]);
		$datos7  = utf8_encode($fila["jd"]);
		$datos8  = $fila["idjo"];*/
		
		$datos0  = $fila["idradicado"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["cedula_demandante"];
		$datos3  = $fila["demandante"];
		$datos4  = $fila["cedula_demandado"];
		$datos5  = $fila["demandado"];
		$datos6  = $fila["claseproceso"];
		$datos7  = $fila["jo"];
		$datos8  = $fila["jd"];
		$datos9  = $fila["posicion"];
		$datos9b  = $fila["observacion_archivo"];
		
		//DATOS DE LOS MEMORIALES
		$datos10  = $fila["fecha"];
		$datos11  = $fila["observacion"];
		$datos12  = $fila["empleado"];
		

		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8
				   ."//////".$datos9."//////".$datos9b."//////".$datos10."//////".$datos11."//////".$datos12."******";
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	