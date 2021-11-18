<?php

	require_once('../libs/Conexion_Funciones.php');
	
	date_default_timezone_set('America/Bogota'); 

	$cadena = "";
	//$filtro = trim($_POST['filtro']);
	
	$idf = trim($_GET['id']);
	
	$ano = date('y'); 
	
	$conexion = db_connect();
	
	//$sql = "SELECT * FROM pa_tipodocumento WHERE id = '$idf'";
	
	$sql = "SELECT d.id,d.sigla,d.contador,td.partesdocumento 
	        FROM (pa_tipodocumento td INNER JOIN pa_documento d ON td.iddocumento = d.id) WHERE td.id = '$idf'";
	
	$resultado = mysql_query($sql);
	
	$fila = mysql_fetch_array($resultado);
	
	if($fila){
	
		//$idtipodocumento = $fila[idtipodocumento];
		$iddocumento     = $fila[id];
		$sigla           = $fila[sigla];
		$contador        = $fila[contador];
		$partes          = $fila[partesdocumento];
		
		$contador        = $contador + 1;
		
		//$cadena = $sigla."//////".$contador."//////".$idtipodocumento."//////".$ano;
		
		if($contador >= 0 && $contador <= 9){$contador = "00".$contador;}
		if($contador >  9 && $contador <= 99){$contador = "0".$contador;}
		
		$cadena = $sigla."".$ano."-".$contador."******".$partes."******".$iddocumento;

		echo trim($cadena);
	}

	//cierro conexion a la db
	mysql_close($conexion);
	
?>
   

	

	
	