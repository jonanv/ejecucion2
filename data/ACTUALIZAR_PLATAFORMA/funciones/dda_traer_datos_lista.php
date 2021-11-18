<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	$id		= trim($_GET['id']);
	$idsql	= trim($_GET['idsql']);
	$idtm	= trim($_GET['idtm']);
	
	$lidmunicipio = trim($_GET['lidmunicipio']);
	
	$idusuario  = $_SESSION['idUsuario'];
	
	$liddpto = trim($_GET['iddpto']);
	$lidmuni = trim($_GET['idmuni']);
	
	
	$conexion = db_connect();
	
	//PARA REGISTRAR LA DIRECCION DE LA PARTE
	if($idsql == 1){
		
		$sql = "SELECT * FROM dda_municipio 
		        WHERE iddpto = '$id'  AND visible = 1 
				ORDER BY des";
				
		echo '<option value="">Seleccionar Municipio</option>';
	}
	
	if($idsql == 2){
		
		$sql = "SELECT * FROM dda_especialidad 
		        WHERE identida = '$id' 
				ORDER BY des";
				
		echo '<option value="">Seleccionar Especialidad</option>';
	}
	
	//CUANDO SOLO SE DESEE ESPECIFICAR UN DEPARTAMENTO Y UN MUNICIPIO
	if($idsql == 3){
		
		$sql = "SELECT * FROM dda_municipio 
		        WHERE iddpto = '$id'  AND visible = 1 AND id = '$lidmunicipio'
				ORDER BY des";
				
		echo '<option value="">Seleccionar Municipio</option>';
	}
	
	if($idsql == 4){
		
		$sql = "SELECT * FROM dda_entidad 
		        WHERE idjurisdiccion = '$id' 
				ORDER BY des";
				
		echo '<option value="">Seleccionar Entidad</option>';
	}
	
	if($idsql == 5){
	
		
		
		$sql = "SELECT * FROM dda_claseproceso 
		        WHERE idespecialidad = '$id' 
				AND iddepartamento   = '$liddpto'
				AND idmunicipio      = '$lidmuni'
				ORDER BY des";
				
		echo '<option value="">Seleccionar Grupo/Clase de Proceso</option>';
	}
	
	
	$resultado = mysql_query($sql);
	

   	while($fila = mysql_fetch_array($resultado)){
	
		if($idsql == 1){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		if($idsql == 2){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		if($idsql == 3){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		if($idsql == 4){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		//SE UNE trim($fila['id']).'******'.trim($fila['idofireparto'])
		//PARA IDENTIFICAR QUE OFICINA DEBE REPARTIR DEMANDA
		//SI OFICINA JUDICIAL O CENTRO DE SERVICIOS CIVIL FAMILIA
		if($idsql == 5){
			
			echo '<option value="'.trim($fila['id']).'******'.trim($fila['idofireparto']).'">'.$fila['des'].'</option>';
		}
		
	
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	