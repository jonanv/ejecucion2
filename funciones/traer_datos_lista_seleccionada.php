<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	/*$id		 = trim($_GET['id']);
	$idsql	 = trim($_GET['idsql']);
	$idlista = trim($_GET['idlista']);*/
	
	/*$datos_lista = explode("//////",trim($_GET['datos_lista']));
	$idlista = $datos_lista[0];
	$idsql   = $datos_lista[1];*/
	
	$idlista = trim($_GET['datos_lista']);
	
	
	$conexion = db_connect();
	
	//if($idsql == 1){
					
			
		$sql = "SELECT * FROM juzgado_destino";
				
		echo '<option value="">Seleccionar Juzgado</option>';
	
	//}
	
	
	
	$resultado = mysql_query($sql);
	
   	while($fila = mysql_fetch_array($resultado)){
	
		//if($idsql == 1){
			
			
			$idj = $fila['id'];
			
			if($idj >= 1 && $idj <= 2){
			
				if($idj == $idlista){
						
	
					echo '<option value="'.trim($fila['id']).'" selected=selected>'.$fila['nombre'].'</option>';
							
				}
				else{
							
					echo '<option value="'.trim($fila['id']).'">'.$fila['nombre'].'</option>';
				}
			
			}
			
		//}
		
		
		
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	