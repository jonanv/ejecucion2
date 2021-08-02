<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	
	$idactu     = trim($_GET['idactu']);
	$idusuarioX = trim($_GET['idusuarioX']);
	
	$conexion = db_connect();
	
	
	//DATOS USUARIO
	$sql = "SELECT * FROM detalle_correspondencia
		    WHERE id = $idactu AND id_user_asignada = '$idusuarioX'" ;
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	

		$id  = $fila["id"];
		
		//$cadena .= $datos0."//////".$datos1."//////".$datos2;
		
   	}
	
	
	echo trim(utf8_encode($id));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	