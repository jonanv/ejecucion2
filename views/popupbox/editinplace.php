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
		
		
		$query     = "UPDATE liquidacion_costas SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
		             "' WHERE id ='".intval($_POST["id"])."' limit 1";
					 
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
		
	
		$query     = "SELECT * FROM liquidacion_costas 
					  WHERE idradicado = ".$_GET['valor_id']." AND estadoe != 'ANULADA'
					  ORDER BY id DESC";
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($usuarios = mysql_fetch_array($resultado)){
				
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
							"observacioncostas"  =>utf8_encode($usuarios["observacioncostas"])
			);
		}
		
		echo json_encode($datos);
		
	}

}
else{

	//echo $conexion; 
	echo "Fallo en la Conexión";
}

mysql_free_result($resultado);
mysql_close($conexion);

?>