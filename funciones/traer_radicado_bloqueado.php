<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena     = "";
	
	$idradicado = trim($_GET['idradicado']);
	
	$conexion = db_connect();
	
	$sql = "SELECT COUNT(id) AS expebloqueado FROM ubicacion_expediente
			WHERE radiblodes = '$idradicado' AND bloqueado = 0";

	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//echo $fila['numero'];
		
		$datos0  = $fila["expebloqueado"];
		
		$cadena .= $datos0."//////".$datos0;
		
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	