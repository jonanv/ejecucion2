<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idvalor  = trim($_GET['dato_radicado']);
	
	$conexion = db_connect();
	
	$sql = "SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.observacion,t3.empleado
			FROM (detalle_correspondencia t1
			INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id
			INNER JOIN pa_usuario t3 ON t1.idusuario = t3.id)
			WHERE t2.radicado = '$idvalor'
			ORDER BY t1.id DESC";
			
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		
		$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["fecha"];
		$datos3  = $fila["observacion"];
		$datos4  = $fila["empleado"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."******";
		
   	}
	
	
	echo trim( utf8_encode($cadena) );
	
	
	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	