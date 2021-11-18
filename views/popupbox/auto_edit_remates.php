<?php
/*$dbhost ="localhost";
$dbname ="ejecucion";
$dbuser ="root";
$dbpass ="Ejecuc10n2014";
$db     = new mysqli($dbhost,$dbuser,$dbpass,$dbname);*/

include_once('Conexionpopupbox.php');

$conexion = db_connect($dbdefault_dbname);

$error_transaccion = 0; //variable para detectar error

//$link = db_connect($dbdefault_dbname);

if($conexion > 0){

	//PARA EDITAR
	if (isset($_POST) && count($_POST)>0)
	{
		
		//CODIGO ORIGINAL	
		/*if ($db->connect_errno) 
		{
			die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
		}
		else
		{
			$query=$db->query("UPDATE liquidacion_costas SET ".$_POST["campo"]."='".$_POST["valor"]."' WHERE id ='".intval($_POST["id"])."' limit 1");
			if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
			else echo "<span class='ko'>".$db->error."</span>";
		}*/
		
		mysql_query("START TRANSACTION",$conexion);
		
   
		/*$query     = "UPDATE auto_cliente SET ".$_POST["campo"]."='".trim($_POST["valor"]).
				   "' WHERE id ='".intval($_POST["id"])."' limit 1";*/		
		
		if(trim($_POST["tabla"]) == "documentos_internos"){
		
			$query     = "UPDATE ".$_POST["tabla"]." SET ".$_POST["campo"]."='".trim($_POST["valor"])."' 
			              WHERE id ='".intval($_POST["id"])."' limit 1";		      
					 
			$resultado = mysql_query($query);
			
			if (!$resultado) {
							
				$error_transaccion = 1;
															
			}
		
		}
		
		
		if($error_transaccion) {
							
			
			echo "<span class='ko'>"."ERROR EN LA OPERACION ".mysql_errno($conexion). ": " . mysql_error($conexion)."</span>";
			
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			mysql_query("ROLLBACK",$conexion);
			
			
	
		} //FIN if($error_transaccion) 
		else {
						
			
			echo "<span class='ok'>Valores modificados correctamente.</span>";
						
			//SE TERMINA LA TRANSACCION 
			mysql_query("COMMIT",$conexion);
			
			
							
							
		}
		
		
		
	}
	
	//PARA GENERAR LA TABLA
	/*if (isset($_GET) && count($_GET)>0)
	{
	
		
		
		$query     = "	SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.id_user_asignada,t3.empleado,
						t1.observacion,t1.fecha_obs_i,t1.fecha_obs_f,t1.estadoobs
						FROM ((detalle_correspondencia t1
						INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
						INNER JOIN pa_usuario t3 ON t1.id_user_asignada = t3.id)
						WHERE t1.id = ".$_GET['valor_id']." 
						ORDER BY t1.id DESC	";
	
		
						
										
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($accion = mysql_fetch_array($resultado)){
				
			

			$datos[]=array(	
			
							"id"                =>$accion["id"],
							"idcorrespondencia"	=>$accion["idcorrespondencia"],
							"radicado"   		=>$accion["radicado"],
							"fecha"            	=>$accion["fecha"],
							"observacion"       =>utf8_encode($accion["observacion"]),
							"id_user_asignada"  =>$accion["id_user_asignada"],
							"empleado" 			=>utf8_encode($accion["empleado"]),
							"fecha_obs_i"     	=>$accion["fecha_obs_i"],
							"fecha_obs_f"       =>$accion["fecha_obs_f"],
							"juz_respuesta"     =>utf8_encode($accion["juz_respuesta"])
							
							
			);
		}
		
		echo json_encode($datos);
		
	}*/

}
else{

	//echo $conexion; 
	echo "Fallo en la Conexión";
}

mysql_free_result($resultado);
mysql_close($conexion);

?>