<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	
	$cedula_user = trim($_GET['cedula_user']);
	
	$conexion = db_connect();
	
	
	//DATOS USUARIO
	$sql          = "SELECT * FROM dda_demanda_detalle 
		             WHERE docddte = '$cedula_user'";
	
	$resultado    = mysql_query($sql);
	
	$numero_filas = mysql_num_rows($resultado);
	
	//SE ENCONTRO INFORMACION EN LA TABLA dda_demanda_detalle
	if($numero_filas >=1){
	
		while($fila = mysql_fetch_array($resultado)){
		
	
			$datos0  = $fila["id"];
			$datos1  = $fila["docddte"];
			$datos2  = $fila["nomddte"];
			$datos3  = $fila["iddepartamento"];
			$datos4  = $fila["idmunicipio"];
			$datos5  = $fila["dir"];
			$datos6  = $fila["telefono"];
			$datos7  = $fila["tp"];
			$datos8  = $fila["correo"];
			
			
	
			$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8;
			
		}
		
	}
	//BUSCO INFORMAVION EN LA TABLA pa_abogados
	else{
	
		$sql         = "SELECT * FROM pa_abogados 
		    	        WHERE doc = '$cedula_user'";
	
		$resultado   = mysql_query($sql);
		
		$numero_filas = mysql_num_rows($resultado);
		
		if($numero_filas >=1){
		
			while($fila = mysql_fetch_array($resultado)){
		
				$datos0  = $fila["id"];
				$datos1  = $fila["doc"];
				$datos2  = $fila["nombre"];
				$datos3  = $fila["iddepartamento"];
				$datos4  = $fila["idmunicipio"];
				$datos5  = '0';
				$datos6  = '0';
				$datos7  = $fila["tp"];
				$datos8  = $fila["ce"];
			
			}
			
	
			$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8;
		
		}
		else{
		
			$cadena = 0;
		}
	
	}
	
	
	echo trim(utf8_encode($cadena));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	