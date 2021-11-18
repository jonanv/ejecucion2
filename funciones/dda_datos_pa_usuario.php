<?php

		require_once('../libs/Conexion_Funciones.php');
	
		$cadena   = "";
		
		
		$cedula_user = trim($_GET['cedula_user']);
		
		$conexion = db_connect();
	
	
		
		$sql         = "SELECT * FROM pa_usuario_expe
		    	        WHERE nombre_usuario = '$cedula_user '";
	
		$resultado   = mysql_query($sql);
		
		$numero_filas = mysql_num_rows($resultado);
		
		if($numero_filas >=1){
		
			/*while($fila = mysql_fetch_array($resultado)){
		
				$datos0  = $fila["id"];
				$datos1  = $fila["doc"];
				$datos2  = $fila["nombre"];
				$datos3  = $fila["iddepartamento"];
				$datos4  = $fila["idmunicipio"];
				$datos5  = '0';
				$datos6  = '0';
				$datos7  = $fila["tp"];
				$datos8  = $fila["ce"];
			
			}*/
			
	
			//$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8;
			
			$cadena =1;
		}
		else{
		
			$cadena = 0;
		}
	
	
	
	
	//echo trim(utf8_encode($cadena));
	
	echo trim($cadena);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	