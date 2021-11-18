<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	
	$id  	 = trim($_GET['id']);
	$idsql	 = trim($_GET['idsql']);
	

	$conexion = db_connect();
	
	if($idsql == 1){
		
		$sql = "SELECT * FROM pa_nombrecarpeta ORDER BY descarpeta";
				
		echo '<option value="">Seleccionar Nombre Carpeta</option>';
	}
	
	if($idsql == 2){
		
		$sql = "SELECT * FROM item ORDER BY nomarticulo";
				
		echo '<option value="">Seleccionar Item</option>';
	}
	
	if($idsql == 3){
		
		$sql = "SELECT * FROM hv_modalidad ORDER BY des";
				
		echo '<option value="">Seleccionar Modalidad</option>';
	}
	
	if($idsql == 4){
		
		$sql = "SELECT * FROM hv_tipomodalidad WHERE idmodalidad = '$id' ORDER BY des";
				
		echo '<option value="">Seleccionar Tipo Modalidad</option>';
	}
	
	$resultado = mysql_query($sql);
	
	

   	while($fila = mysql_fetch_array($resultado)){
	
		
		
		if($idsql == 1){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['descarpeta'].'</option>';
				
			
		}
		
		if($idsql == 2){
			
			echo '<option value="'.trim($fila['referencia']).'">'.$fila['nomarticulo'].'</option>';
				
			
		}
		
		if($idsql == 3){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
				
			
		}
		
		
		if($idsql == 4){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
				
			
		}
		
		
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	