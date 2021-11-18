<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	$id		= "418030000".trim($_GET['idvalor']);
	
	$conexion = db_connect();
	
	$sql = "SELECT * FROM siepro_titulos_encustodia
			WHERE numero = '$id'";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["id"];
		$datos1  = $fila["numero"];

		$cadena .= $datos0."//////".$datos1;
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	