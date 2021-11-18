<?php

	include_once('Conexion.php');

	$cadena=0;
	$filtro = trim($_POST['filtro']);
	
	$conexion = db_connect();
	
	//$sql = "SELECT id,radicado,idjuzgado_reparto FROM ubicacion_expediente WHERE radicado LIKE '%$filtro%'";
	
	/*$sql = "SELECT id,radicado,cedula_demandante,demandante,cedula_demandado,demandado,piso,idestado,idclase_proceso,idjuzgado_reparto,fecha_reparto,observaciones 
	        FROM ubicacion_expediente WHERE radicado = '$filtro'";*/
			
	
	$sql = "SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
	        de.idestado as codestado,ubi.idestado as detalleestado,ubi.idclase_proceso,ubi.idjuzgado_reparto,ubi.fecha_reparto,ubi.observaciones,
			ubi.iddespacho
	        FROM (ubicacion_expediente ubi LEFT JOIN detalle_estado de ON ubi.idestado = de.id) 
			WHERE ubi.radicado = '$filtro'";
	
	$resultado = mysql_query($sql);
	
	//SI EXISTEN DATOS
	if(mysql_num_rows($resultado)){
	
		$fila = mysql_fetch_array($resultado);
		
		$idradicado        = trim($fila["id"]);
		$radicado          = trim($fila["radicado"]);
		$ceddemandante     = trim($fila["cedula_demandante"]);
		$nomdemandante     = utf8_encode(trim($fila["demandante"]));
		$ceddemandado      = trim($fila["cedula_demandado"]);
		$nomdemandado      = utf8_encode(trim($fila["demandado"]));
		$piso              = trim($fila["piso"]);
		
		$codestado         = trim($fila["codestado"]);
		$idestado          = trim($fila["detalleestado"]);
		
		$idclase_proceso   = trim($fila["idclase_proceso"]);
		
		$idjuzgado_reparto = trim($fila["idjuzgado_reparto"]);
		$fecha_reparto     = trim($fila["fecha_reparto"]);
		$observaciones     = utf8_encode(trim($fila["observaciones"]));
		
		$iddespacho        = trim($fila["iddespacho"]);
		
		
		
		
		//OBSERVACIONES DEL PROCESO
		$sql = "SELECT dc.fecha,dc.observacion,pu.empleado
                FROM (detalle_correspondencia dc LEFT JOIN pa_usuario pu ON dc.idusuario = pu.id)
                WHERE idcorrespondencia = '$idradicado'";
		
		$resultado = mysql_query($sql);
		
		while($fila = mysql_fetch_array($resultado)){
			
			$observacionesdetalle = $observacionesdetalle."----".trim($fila["fecha"])." ".utf8_encode(trim($fila["observacion"]))." ".utf8_encode(trim($fila["empleado"]));
		}
		
		$observaciones = $observaciones."----".$observacionesdetalle;
		
		
		//------------------------------DATOS RADICADO---------------------------------------------------------------------------------
		//$cadena = $idradicado."#####".$radicado."*****".$idjuzgado_reparto;
		
		$cadena = $idradicado."*****".$radicado."*****".$ceddemandante."*****".$nomdemandante."*****".$ceddemandado."*****".$nomdemandado."*****".$piso."*****".
		          $codestado."*****".$idestado."*****".$idclase_proceso."*****".$idjuzgado_reparto."*****".$fecha_reparto."*****".$observaciones."*****".
				  $iddespacho;
				  
		echo trim($cadena);	
	}
	else{
		echo $cadena;
	}
	
	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	