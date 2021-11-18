<?php

		require_once('../libs/Conexion_Funciones.php');

		$cadena   = "";
		
		
		$conexion = db_connect();
		
		
		//DATOS USUARIO
		$sql = "SELECT COUNT(id) AS cantidad
				FROM pa_usuario_solicitud WHERE estado = 1";
		
		$resultado = mysql_query($sql);
		
		while($fila = mysql_fetch_array($resultado)){
		
	
			$datos0  = $fila["cantidad"];
			
	
			//$cadena .= $datos0."//////".$datos1."//////".$datos2;
			
			$cadena = $datos0;
			
		}
		
		
		echo trim(utf8_encode($cadena));
	
		//cierro conexion a la db
		mysql_close($conexion);
		 
		 
		 
		 
		
	
?>
   

	

	
	