<?php

	include_once('Conexion.php');

	$cadena=0;
	$filtro = trim($_POST['filtro']);
	
	$conexion = db_connect();
	
	$sql = "SELECT id,radicado,idjuzgado_reparto FROM ubicacion_expediente WHERE radicado LIKE '%$filtro%'";
	
	$resultado = mysql_query($sql);
	
	//SI EXISTEN DATOS
	if(mysql_num_rows($resultado)){
	
		$fila = mysql_fetch_array($resultado);
		
		$idradicado        = trim($fila["id"]);
		$radicado          = trim($fila["radicado"]);
		$idjuzgado_reparto = trim($fila["idjuzgado_reparto"]);
		
		//------------------------------DATOS EMPLEADO---------------------------------------------------------------------------------
		//$cadena = $radicado;
		
		//$cadena = $idradicado."#####".$radicado."#####".$vacio;
		$cadena = $idradicado."#####".$radicado."*****".$idjuzgado_reparto;
				  
		echo trim($cadena);	
	}
	else{
		echo $cadena;
	}
	
	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	