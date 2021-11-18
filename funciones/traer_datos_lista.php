<?php

session_start(); 

if($_SESSION['id']!=""){

	require_once('../libs/Conexion_Funciones.php');

	$id		= trim($_GET['id']);
	$idsql	= trim($_GET['idsql']);
	$idtm	= trim($_GET['idtm']);
	
	$idusuario  = $_SESSION['idUsuario'];
	
	
	$conexion = db_connect();
	
	if($idsql == 1){
		
		$sql = "SELECT * FROM pa_tipodocumento WHERE iddocumento = '$id' ORDER BY nombre_tipo_documento";
		echo '<option value="">Seleccionar Tipo Documento</option>';
	}
	
	if($idsql == 2){
		
		$sql = "SELECT * FROM hv_tipomodalidad
				WHERE idmodalidad = '$id'
				ORDER BY des";
				
		echo '<option value="">Seleccionar Tipo Modalidad</option>';
	}
	
	if($idsql == 3){
		
		$sql = "SELECT * FROM hv_tipomodalidad
				WHERE idmodalidad = '$id'
				ORDER BY des";
				
		echo '<option value="">Seleccionar Tipo Modalidad</option>';
	}
	
	if($idsql == 4){
		
		$sql = "SELECT * FROM siepro_estado_audi_2
				WHERE idestadoaudi = '$id'
				ORDER BY id";
				
		echo '<option value="">Seleccionar Causal</option>';
	}
	
	
	if($idsql == 5){
		
		$sql = "SELECT * FROM pa_clase_solicitud
				WHERE idsolicitud = '$id'
				ORDER BY id";
				
		echo '<option value="">Seleccione Clase Solicitud</option>';
	}
	
	
	if($idsql == 6){
		
		$sql = "SELECT * FROM pa_subclase_solicitud
				WHERE idclasesolicitud = '$id'
				ORDER BY id";
				
		echo '<option value="">Seleccione SubClase Solicitud</option>';
	}
	
	if($idsql == 7){
		
		$sql = "SELECT * FROM pa_eps_salud
			    ORDER BY des";
				
		echo '<option value="">Seleccione Eps</option>';
	}
	
	if($idsql == 8){
		
		$sql = "SELECT t1.cuaderno,t2.des
			    FROM (expe_digital t1 
			    INNER JOIN expe_cuaderno t2 ON t1.cuaderno = t2.id)
				WHERE idradicado = '$id'
				AND t1.estado = 1
				GROUP BY cuaderno
				ORDER BY t1.cuaderno";
				
		echo '<option value="">Seleccione Cuaderno</option>';
	}
	
	

	$resultado = mysql_query($sql);
	

   	while($fila = mysql_fetch_array($resultado)){
	
		if($idsql == 1){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['nombre_tipo_documento'].'</option>';
		}
		
		if($idsql == 2){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		if($idsql == 3){
			
			//echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
			$idtm_L = $fila['id'];
			
			if($idtm == $idtm_L){
						
	
				echo '<option value="'.trim($fila['id']).'" selected=selected>'.$fila['des'].'</option>';
							
			}
			else{
							
				echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
			}
				
		}
		
		
		if($idsql == 4){
			
			echo '<option value="'.trim($fila['id']).'">'.$fila['des'].'</option>';
		}
		
		if($idsql == 5){
			
			echo '<option value="'.trim($fila['id']).'">'.utf8_encode($fila['des']).'</option>';
		}
		
		if($idsql == 6){
			
			echo '<option value="'.trim($fila['id']).'">'.utf8_encode($fila['des']).'</option>';
		}
		
		if($idsql == 7){
			
			echo '<option value="'.trim($fila['id']).'">'.utf8_encode($fila['des']).'</option>';
		}
		
		if($idsql == 8){
			
			echo '<option value="'.trim($fila['cuaderno']).'">'.$fila['des'].'</option>';
		}
		
   	}
	
	mysql_close($conexion);

}
	
?>
   

	

	
	