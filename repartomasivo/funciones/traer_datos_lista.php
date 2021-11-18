<?php

	include_once('Conexion.php');

	$cadena="";
	$filtro = trim($_POST['filtro']);
	
	
	$conexion = db_connect();
	
	if($filtro != 0){
	
		$sql = "SELECT * FROM detalle_estado WHERE idestado = '$filtro' ORDER BY nombre";
	}
	else{
	
		$sql = "SELECT * FROM detalle_estado ORDER BY nombre";
	}
	
	
	$resultado = mysql_query($sql);
	
	
	$i=0;
   	while($fila = mysql_fetch_array($resultado)){
	
		$datos[$i]   = $fila["id"];
		$datos[$i+1] = utf8_encode($fila["nombre"]);
		
		//concateno el resultado
		$cadena = $cadena.$datos[$i]."///".$datos[$i+1]."///";
		$i=$i+2;
   	}
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	