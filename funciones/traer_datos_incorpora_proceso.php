<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idradicado = trim($_GET['idradicado']);
	
	$dato_2     = trim($_GET['fechaie']);
    $dato_3     = trim($_GET['fechafe']);
	
	$conexion = db_connect();
	
						
	/*$sql = "SELECT ubi.id AS idradicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
			pj.nombre AS jo,pj.id AS idjo,pr.nombre AS jd,
			corr.id,corr.fecha_registro,corr.radicado,corr.peticionario,
			corr.tipo_documento,juz2.nombre AS juzorigen,juzdest2.nombre AS juzdestino,corr.fecha_entrega,
			sol.nombre AS solicitud,usu.empleado,corr.folios,corr.tiene_expediente,corr.observacionesm
			FROM ((((((((ubicacion_expediente ubi 
			LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
			LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
			LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
			LEFT JOIN correspondencia corr ON ubi.radicado = corr.radicado)
			LEFT JOIN pa_juzgado juz2 ON corr.idjuzgado = juz2.id)
			LEFT JOIN juzgado_destino juzdest2 ON corr.idjuzgadodestino = juzdest2.id)
			LEFT JOIN pa_solicitud sol ON corr.idsolicitud = sol.id)
			LEFT JOIN pa_usuario usu ON corr.idusuario = usu.id)
			WHERE ubi.radicado LIKE '%$idradicado%' 
			AND (corr.fecha_entrega >= '$dato_2' AND corr.fecha_entrega <= '$dato_3')
			AND corr.incorporaexpediente IS NULL AND corr.fecha_incorpora IS NULL";*/
			
	
	
	$sql = "SELECT ubi.id AS idradicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
			pj.nombre AS jo,pj.id AS idjo,pr.nombre AS jd,
			corr.id,corr.fecha_registro,corr.radicado,corr.peticionario,
			corr.tipo_documento,juz2.nombre AS juzorigen,juzdest2.nombre AS juzdestino,corr.fecha_entrega,
			sol.nombre AS solicitud,usu.empleado,corr.folios,corr.tiene_expediente,corr.observacionesm,corr.incorporaexpediente,corr.fecha_incorpora
			FROM ((((((((ubicacion_expediente ubi 
			LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
			LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
			LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
			LEFT JOIN correspondencia corr ON ubi.radicado = corr.radicado)
			LEFT JOIN pa_juzgado juz2 ON corr.idjuzgado = juz2.id)
			LEFT JOIN juzgado_destino juzdest2 ON corr.idjuzgadodestino = juzdest2.id)
			LEFT JOIN pa_solicitud sol ON corr.idsolicitud = sol.id)
			LEFT JOIN pa_usuario usu ON corr.idusuario = usu.id)
			WHERE ubi.radicado LIKE '%$idradicado%' 
			AND (corr.fecha_entrega >= '$dato_2' AND corr.fecha_entrega <= '$dato_3')";		
	

	
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
		$datos1  = $fila["cedula_demandante"];
		$datos2  = $fila["demandante"];
		$datos3  = $fila["cedula_demandado"];
		$datos4  = $fila["demandado"];
		$datos5  = $fila["claseproceso"];
		$datos6  = $fila["jo"];
		$datos7  = $fila["jd"];
		$datos8  = $fila["idjo"];
		
		//DATOS DE LOS MEMORIALES
		$datos9   = $fila["id"];
		$datos10  = $fila["fecha_registro"];
		$datos11  = $fila["radicado"];
		$datos12  = $fila["peticionario"];
		$datos13  = $fila["tipo_documento"];
		$datos14  = $fila["juzorigen"];
		$datos15  = $fila["juzdestino"];
		$datos16  = $fila["fecha_entrega"];
		$datos17  = $fila["solicitud"];
		$datos18  = $fila["empleado"];
		$datos19  = $fila["folios"];
		$datos20  = $fila["tiene_expediente"];
		$datos21  = $fila["observacionesm"];
		$datos22  = $fila["incorporaexpediente"];
		$datos23  = $fila["fecha_incorpora"];
		
		
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".
		           $datos7."//////".$datos8
				   ."//////".$datos9."//////".$datos10."//////".$datos11."//////".utf8_encode($datos12)."//////".$datos13."//////"
				   .utf8_encode($datos14)."//////".utf8_encode($datos15)."//////".$datos16."//////".utf8_encode($datos17)."//////"
				   .utf8_encode($datos18)."//////".$datos19."//////".$datos20."//////".utf8_encode($datos21)."//////".$datos22."//////".$datos23."******";
		
   	}
	
	if(count( explode("******",$cadena) ) == 1 ){
	
	
				$sql = "SELECT ubi.id AS idradicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
				pj.nombre AS jo,pj.id AS idjo,pr.nombre AS jd
				FROM (((ubicacion_expediente ubi
				LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
				LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
				LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
				WHERE ubi.radicado LIKE '%$idradicado%'";
				
				$resultado = mysql_query($sql);
				
				
				while($fila = mysql_fetch_array($resultado)){
	
		
		
					$datos0  = $fila["idradicado"];
					$datos1  = $fila["cedula_demandante"];
					$datos2  = $fila["demandante"];
					$datos3  = $fila["cedula_demandado"];
					$datos4  = $fila["demandado"];
					$datos5  = $fila["claseproceso"];
					$datos6  = $fila["jo"];
					$datos7  = $fila["jd"];
					$datos8  = $fila["idjo"];
					
				}
				
				$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."******";
				
				
				echo trim($cadena);	
	}
	else{
	
		echo trim($cadena);
	}

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	