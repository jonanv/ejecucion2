<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	
	$cedula_user = trim($_GET['cedula_user']);
	
	$conexion = db_connect();
	
	
	//DATOS USUARIO
	$sql = "SELECT * FROM pa_usuario 
		    WHERE nombre_usuario = '$cedula_user'";
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	

		$datos0  = $fila["id"];
		$datos1  = $fila["nombre_usuario"];
		$datos2  = $fila["empleado"];
		

		$cadena .= $datos0."//////".$datos1."//////".$datos2;
		
   	}
	
	
	echo trim(utf8_encode($cadena));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	