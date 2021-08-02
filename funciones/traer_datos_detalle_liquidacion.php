<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$idvalor  = trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	$sql = "SELECT t1.id,t1.nunentradade,t1.idarticulode,t2.nomarticulo,t1.cantidadde
			FROM (detalle_liquidacion_costas t1 INNER JOIN item t2 ON t1.idarticulode = t2.referencia)
			WHERE t1.nunentradade = '$idvalor'";
			
	/*$sql = "SELECT t1.id,t1.nunentradade,t1.idarticulode,t2.nomarticulo,t1.cantidadde,t3.notae
			FROM ((detalle_liquidacion_costas t1
			INNER JOIN item t2 ON t1.idarticulode = t2.referencia)
			INNER JOIN liquidacion_costas t3 ON t1.nunentradade = t3.nunentrada)
			WHERE t1.nunentradade = '$idvalor'";*/	

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["idarticulode"];
		$datos1  = utf8_encode($fila["nomarticulo"]);
		$datos2  = $fila["cantidadde"];
		//$datos3  = $fila["notae"];
		
		
		//$datos2  = utf8_encode($fila["cantidadde"]);
		
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2."******";
		
   	}
	
	
	echo trim( utf8_encode($cadena) );

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	