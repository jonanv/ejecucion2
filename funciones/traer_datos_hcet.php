<?php

	require_once('../libs/Conexion_Funciones.php');

	$cadena   = "";
	
	
	$id_encabezado = trim($_GET['id_encabezado']);
	
	$conexion = db_connect();
	
	
	//DATOS ID ENCABEZADOS
	$sql = "SELECT * FROM hcet_encabezado 
		    WHERE id = '$id_encabezado'";
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	

		/*$datos0  = $fila["id"];
		$datos1  = $fila["nombre_usuario"];
		$datos2  = $fila["empleado"];
		
		$cadena .= $datos0."//////".$datos1."//////".$datos2;*/
		
		$cadena .= $fila[id]."******".$fila[idradicado]."******".$fila[capital]."******".$fila[ic]."******".$fila[im]."******".$fila[costas]."******".
				   $fila[fecha]."******".$fila[hora]."******".$fila[idusuario]."******".$fila[obs]."******".$fila[atp];
		

		
		
   	}
	
	
	//DATOS SUMA ID ENCABEZADOS
	$sql_2 = "SELECT 
	          SUM(capital+ic+im+costas) AS suma,
			  SUM((capital+ic+im+costas) - atp) AS total
	          FROM hcet_encabezado
              WHERE id = '$id_encabezado'";
			  
	
	$resultado_2 = mysql_query($sql_2);
	$fila_2      = mysql_fetch_array($resultado_2);
	$suma        = $fila_2[suma];
	$total       = $fila_2[total];
	
	
	
	//DETALLE TITULOS
	$sql_3 = "SELECT * FROM titulos
			  WHERE idhoja = '$id_encabezado'";
			
	$resultado_3 = mysql_query($sql_3);
			
	while($row = mysql_fetch_array($resultado_3)){
			
		$DATOS_HCET .= $row[id]."******".$row[fecha]."******".$row[orderpago]."******".$row[valor]."******".
				       $row[fechapago]."******".$row[beneficiario]."*/-*/-";
	}
	
  
  
	echo trim(utf8_encode($cadena)."//////".$suma."//////".$DATOS_HCET."//////".$total);

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	