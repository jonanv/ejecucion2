<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	$cadena_2 = "";
	$cadena_3 = "";
	$cadena_4 = "";
	$cadena_5 = "";
	$cadena_6 = "";
	$cadena_7 = "";
	$cadena_8 = "";
	$cadena_9 = "";
	
	$id		    = trim($_GET['idvalor']);
	$id_usuario = trim($_GET['id_usuario']);
	
	$conexion = db_connect();
	
	
	//DATOS USUARIO
	$sql = "SELECT * FROM pa_usuario 
		    WHERE nombre_usuario = '$id'";
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	

		$datos_U0  = $fila["id"];
		$datos_U1  = $fila["nombre_usuario"];
		$datos_U2  = $fila["empleado"];
		

		$cadena_9 .= $datos_U0."//////".$datos_U1."//////".$datos_U2;
		
   	}
	
	//DATOS GENERALES
	$sql = "SELECT * FROM hv_datosgenerales 
	        WHERE cedula = '$id'";
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	

		$datos0  = $fila["id"];
		$datos1  = $fila["cedula"];
		$datos2  = $fila["nombre"];
		$datos3  = $fila["direccion"];
		$datos4  = $fila["correo"];
		$datos5  = $fila["perfil"];
		$datos6  = $fila["estado_civil"];
		$datos7  = $fila["telefono"];
		$datos8  = $fila["foto"];
		$datos9  = $fila["perfilocupacional"];
		$datos10 = $fila["fechanacimiento"];

		$cadena .= $datos0."//////".$datos1."//////".$datos2."//////".$datos3."//////".$datos4."//////".$datos5."//////".$datos6."//////".$datos7."//////".$datos8."//////".$datos9."//////".$datos10;
		
   	}
	
	//ESTUDIOS
	$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,t1.institucion
		    FROM ((hv_central t1
            LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
            LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		    WHERE t1.idservidor = '$datos0' AND tipo_soporte = 'E'
		    ORDER BY t1.id";
			
	
	/*$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,t1.institucion,
			t4.ruta
			FROM (((hv_central t1
			LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
			LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id)
			LEFT JOIN hv_rutas_archivos t4 ON t1.id = t4.id_archivo_central)
			WHERE t1.idservidor = 1 AND tipo_soporte = 'E'
			ORDER BY t1.id";*/		
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d1  = $fila["id"];
		
		$d5  = $fila["idmodalidad"];
		$d2  = $fila["modalidad"];
		
		$d6  = $fila["idtipomodalidad"];
		$d3  = $fila["tipomodalidad"];
		
		$d4  = $fila["institucion"];
		
		//$d5  = $fila["ruta"];
		
	
		//$cadena_2 .= $d1."------".$d5."------".$d2."------".$d6."------".$d3."------".$d4."------".$d5."*/-*/-";	
		
		$cadena_2 .= $d1."------".$d5."------".$d2."------".$d6."------".$d3."------".$d4."*/-*/-";	
			
   	}
	
	
	//EXPERIENCIA LABORAL
	$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	        t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo
		    FROM ((hv_central t1
            LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
            LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		    WHERE t1.idservidor = '$datos0' AND tipo_soporte = 'L'
		    ORDER BY t1.id";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d1  = $fila["id"];
		
		$d5  = $fila["idmodalidad"];
		$d2  = $fila["modalidad"];
		
		$d6  = $fila["idtipomodalidad"];
		$d3  = $fila["tipomodalidad"];
		
		$d4  = $fila["institucion"];
		
		$d7  = $fila["direccion"];
		$d8  = $fila["telefono"];
		$d9  = $fila["periodo"];
		$d10 = $fila["cargo"];
		
	
		$cadena_3 .= $d1."------".$d5."------".$d2."------".$d6."------".$d3."------".$d4."------".$d7."------".$d8."------".$d9."------".$d10."*/-*/-";	
			
   	}
	
	
	//REFERENCIA
	$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	        t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t1.tipo_soporte
		    FROM ((hv_central t1
            LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
            LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		    WHERE t1.idservidor = '$datos0' 
			AND (tipo_soporte = 'LABORAL' OR tipo_soporte = 'PERSONAL')
		    ORDER BY t1.tipo_soporte,t1.id";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d1  = $fila["id"];
		
		$d5  = $fila["idmodalidad"];
		$d2  = $fila["modalidad"];
		
		$d6  = $fila["idtipomodalidad"];
		$d3  = $fila["tipomodalidad"];
		
		$d4  = $fila["institucion"];
		
		$d7  = $fila["direccion"];
		$d8  = $fila["telefono"];
		$d9  = $fila["periodo"];
		$d10 = $fila["cargo"];
		
		$d11 = $fila["tipo_soporte"];
		
	
		$cadena_4 .= $d1."------".$d5."------".$d2."------".$d6."------".$d3."------".$d4."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";	
			
   	}
	
	//CONOCIMENTO
	$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	        t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo
		    FROM ((hv_central t1
            LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
            LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		    WHERE t1.idservidor = '$datos0' AND tipo_soporte = 'C'
		    ORDER BY t1.id";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d1  = $fila["id"];
		
		$d5  = $fila["idmodalidad"];
		$d2  = $fila["modalidad"];
		
		$d6  = $fila["idtipomodalidad"];
		$d3  = $fila["tipomodalidad"];
		
		$d4  = $fila["institucion"];
		
		
		$cadena_5 .= $d1."------".$d5."------".$d2."------".$d6."------".$d3."------".$d4."*/-*/-";	
			
   	}
	
	
	//ACTOS ADMINISTRATIVOS
	$sql = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
	        t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,
			t1.nunresolucion,t1.idmotivo,t4.des AS motivo,t1.fechaad
		    FROM (((hv_central t1
            LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
            LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
			LEFT JOIN hv_motivo t4 ON t1.idmotivo = t4.id) 
		    WHERE t1.idservidor = '$datos0' AND tipo_soporte = 'AD'
		    ORDER BY t1.id";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d1  = $fila["id"];
		
		$d12  = $fila["nunresolucion"];
		$d13  = $fila["idmotivo"];
		$d14  = $fila["motivo"];
		$d15  = $fila["fechaad"];
		
		
		
		$cadena_6 .= $d1."------".$d12."------".$d13."------".$d14."------".$d15."*/-*/-";	
			
   	}
	
	
	//RUTAS ARCHIVOS
	$sql = "SELECT t2.id,t2.id_archivo_central,t2.ruta
			FROM (hv_central t1
            INNER JOIN hv_rutas_archivos t2 ON t1.id = t2.id_archivo_central)
            WHERE t1.idservidor = '$datos0'
            ORDER BY t1.id";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d16 = $fila["id"];
		$d17 = $fila["id_archivo_central"];
		$d18 = $fila["ruta"];
		
		
		//SE ADICIONA ESTA PARTE, YA QUE ESTE TIPO DE REGISTRO
		//NO SE ENLAZAN CON UN REGISTRO EN LA TABLA hv_central
		//Y EN LA COLUMNA id_archivo_central SE INSERTA EL ID
		//DEL USUARIO EN SESION Y EN LA COLUMNA ruta
		//QUEDA DE LA SIGUIENTE MANERA
		
		//HOJASDEVIDA/38/ANTECEDENTES_CERTIFICADOS/38_PROCURADURIA.pdf
		
		//ENTONCES SE APLICA EL EXPLODE A LA VARIABLE $d18 QUE ES LA RUTA DEL REGISTRO
		//Y SE CAPTURA EN LA POSICION 1 EL ID DEL USUARUO QUE ESTA EN SESION
		
		//POR EJEMPLO EN ESTE CASO NO APLICARIA PARA LA CONCATENACION EN $cadena_7
		//YA QUE EL ID DE USUARIO EN SESION ES 38 Y EL VALOR EN LA POS 1 ES 8 
		//HOJASDEVIDA/8/SOPORTES_EXPERIENCIA_LABORAL/38_EXPLAB.pdf
		
		$d18B = explode("/",$d18);
		
		
		if($d18B[1] == $id_usuario){
			
			$cadena_7 .= $d16."------".$d17."------".$d18."*/-*/-";	
		}
		
		
			
   	}
	
	
	//RUTAS DE ARCHIVOS QUE SON ANTECEDENTES / CERTIFICADOS
	//Y NO SE ENLAZAN CON UN REGISTRO EN LA TABLA hv_central
	$sql = "SELECT * FROM hv_rutas_archivos WHERE id_archivo_central = '$id_usuario'";
	
	$resultado = mysql_query($sql);
	

	while($fila = mysql_fetch_array($resultado)){
	
		$d19 = $fila["id"];
		$d20 = $fila["id_archivo_central"];
		$d21 = $fila["ruta"];
		
		//SE ADICIONA ESTA PARTE, YA QUE ESTE TIPO DE REGISTRO
		//NO SE ENLAZAN CON UN REGISTRO EN LA TABLA hv_central
		//Y EN LA COLUMNA id_archivo_central SE INSERTA EL ID
		//DEL USUARIO EN SESION Y EN LA COLUMNA ruta
		//QUEDA DE LA SIGUIENTE MANERA
		
		//HOJASDEVIDA/38/ANTECEDENTES_CERTIFICADOS/38_PROCURADURIA.pdf
		
		//ENTONCES SE APLICA EL EXPLODE A LA VARIABLE $d21 QUE ES LA RUTA DEL REGISTRO
		//Y SE CAPTURA EN LA POSICION 1 EL ID DEL USUARUO QUE ESTA EN SESION
		
		//POR EJEMPLO EN ESTE CASO NO APLICARIA PARA LA CONCATENACION EN $cadena_8
		//YA QUE EL ID DE USUARIO EN SESION ES 38 Y EL VALOR EN LA POS 1 ES 8 
		//HOJASDEVIDA/8/SOPORTES_EXPERIENCIA_LABORAL/38_EXPLAB.pdf
		
		$d21B = explode("/",$d21);
		
		
		if($d21B[1] == $id_usuario){
			
			$cadena_8 .= $d19."------".$d20."------".$d21."*/-*/-";	
		}
			
   	}
	
	//$cadena_8 = "";
	
	echo trim(utf8_encode($cadena."******".$cadena_2."******".$cadena_3."******".$cadena_4."******".$cadena_5."******".$cadena_6."******".$cadena_7."******".$cadena_8."******".$cadena_9));

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	