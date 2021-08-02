<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idvalor  = trim($_GET['dato_radicado']);
	
	$conexion = db_connect();
	
	
	$sql = "SELECT t1.id,t1.idcorrespondencia,t1.fecha,t1.observacion,t2.radicado,
	        t3.id AS idusuario,t3.empleado
			FROM (detalle_correspondencia t1
			LEFT JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id
			LEFT JOIN pa_usuario t3 ON t1.idusuario = t3.id)
			WHERE t1.idcorrespondencia = '$idvalor'
			ORDER BY t1.id DESC";
			
	
			
			
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		
		/*$datos0  = $fila["id"];
		$datos1  = $fila["radicado"];
		$datos2  = $fila["fecha"];
		$datos3  = $fila["observacion"];
		$datos4  = utf8_encode($fila["empleado"]);*/
		
		//$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."******";
		
		$arreglo["data"][]=$fila; 
		 
		
		
   	}
	
	
	//echo trim( utf8_encode($cadena) );
	
	//SE ADICIONA ESTA PARTE PARA MOSTRAR LOS ACENTOS
	//RECIBE UN ARRAY
	array_walk_recursive($arreglo, function(&$item, $key){
		if(!mb_detect_encoding($item, 'utf-8', true)){
			$item = utf8_encode($item);
		}
	});
	
	//pasamos los datos json
    echo json_encode($arreglo);

	//libero resultado
	mysql_free_result($resultado);
	//cierro conexion a la db
	mysql_close($conexion);
	
	
	/*function utf8_converter($array)
	{
		array_walk_recursive($array, function(&$item, $key){
		if(!mb_detect_encoding($item, ‘utf-8’, true)){
		$item = utf8_encode($item);
		}
		});
		
		return $array;
	}*/
	
?>
   

	

	
	