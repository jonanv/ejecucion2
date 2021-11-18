<?php
/*$dbhost ="localhost";
$dbname ="laborales";
$dbuser ="root";
$dbpass ="admin";
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
		
		//SE REALIZA ESTA COMPARACION, YA QUE SI ES EL CAMPO RESPUESTA ES DILIGENCIADO
		//ES EL SERVIDOR JUDICIAL QUE SE LE ASIGNO LA OBSERVACION EL CUAL ESTA REALIZADNDO DICHA OPERACION
		// Y EL CAMPO estadoobs PASA A 1 (TERMINADA), ESTO CON EL OBJETO QUE NO SE SELECCIONE DESDE EL FORMULARIO 
		//LISTA ESTADO
		if($_POST["campo"] == "juz_respuesta"){
		
			$query     = "UPDATE detalle_correspondencia SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
						 "', estadoobs = 1  WHERE id ='".intval($_POST["id"])."' limit 1";

		}
		else{
		
			$query     = "UPDATE detalle_correspondencia SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
						 "' WHERE id ='".intval($_POST["id"])."' limit 1";
		}			 
					 
		$resultado = mysql_query($query);
		
		if (!$resultado) {
						
			$error_transaccion = 1;
														
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
	if (isset($_GET) && count($_GET)>0)
	{
	
		//CODIGO ORIGINAL	
		/*if ($db->connect_errno) 
		{
			die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
		}
		else
		{
			
			$query =$db->query( "SELECT * FROM liquidacion_costas 
								 WHERE idradicado = ".$_GET['valor_id']." AND estadoe != 'ANULADA'
								 ORDER BY id DESC" );
			
			$datos=array();
			while ($usuarios=$query->fetch_array())
			{
				
				if( strlen($usuarios["observacioncostas"]) == 0 ){
				
					$usuarios["observacioncostas"] = "x";
				}
				
				$datos[]=array(	
								"id"                 =>$usuarios["id"],
								"nunentrada"         =>$usuarios["nunentrada"],
								"fechae"             =>$usuarios["fechae"],
								"horae"              =>$usuarios["horae"],
								"nuevo"              =>$usuarios["nuevo"],
								"liquidacioncredito" =>$usuarios["liquidacioncredito"],
								"observacioncostas"  =>$usuarios["observacioncostas"]
				);
			}
			echo json_encode($datos);
		}*/
		
		
		$query     = "	SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.id_user_asignada,t3.empleado,
						t1.observacion,t1.fecha_obs_i,t1.fecha_obs_f,t1.estadoobs
						FROM ((detalle_correspondencia t1
						INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
						INNER JOIN pa_usuario t3 ON t1.id_user_asignada = t3.id)
						WHERE t1.id = ".$_GET['valor_id']." 
						ORDER BY t1.id DESC	";
	
		
						
		//$query     = "SELECT * FROM gc_acciones WHERE id = ".$_GET['valor_id']."";
										
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($accion = mysql_fetch_array($resultado)){
				
			/*if( strlen($usuarios["observacioncostas"]) == 0 ){
				
				$usuarios["observacioncostas"] = "x";
			}*/
				
				
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
		
	}

}
else{

	//echo $conexion; 
	echo "Fallo en la Conexi�n";
}

mysql_free_result($resultado);
mysql_close($conexion);

?>