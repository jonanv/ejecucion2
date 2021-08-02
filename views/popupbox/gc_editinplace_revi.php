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
		
		$query     = "UPDATE gc_revision_detalle SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
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
		
	
		$query     = "	SELECT t1.id,
		                t2.des AS clase,t2.id AS id_clase,
						t3.des AS numeral,t3.id AS id_numeral_norma,
						t1.descripcion,t1.analisis_causas,
						t4.des AS procesoresponsable,t4.id AS id_pr,
						t1.id_ai,
						t6.des AS metodologia,t6.id AS id_metodologia,
						t7.des AS generada,t7.id AS id_generada,
						t1.fecha_registro,t1.hora_registro,t1.estado
						FROM (((((gc_acciones t1
						LEFT JOIN gc_lista t2 ON t1.id_clase = t2.id)
						LEFT JOIN gc_lista t3 ON t1.id_numeral_norma = t3.id)
						LEFT JOIN gc_lista t4 ON t1.id_pr = t4.id)
						LEFT JOIN gc_lista t6 ON t1.id_metodologia = t6.id)
						LEFT JOIN gc_lista t7 ON t1.id_generada = t7.id) 
						WHERE t1.id = ".$_GET['valor_id']." 
						ORDER BY id DESC	";
						
		//$query     = "SELECT * FROM gc_acciones WHERE id = ".$_GET['valor_id']."";
										
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($accion = mysql_fetch_array($resultado)){
				
			/*if( strlen($usuarios["observacioncostas"]) == 0 ){
				
				$usuarios["observacioncostas"] = "x";
			}*/
				
			$datos[]=array(	
							"id"                 =>$accion["id"],
							"id_clase"           =>$accion["id_clase"],
							"clase"              =>utf8_encode($accion["clase"]),
							"id_numeral_norma"   =>$accion["id_numeral_norma"],
							"numeral"            =>utf8_encode($accion["numeral"]),
							"descripcion"        =>utf8_encode($accion["descripcion"]),
							"id_pr"              =>$accion["id_pr"],
							"procesoresponsable" =>utf8_encode($accion["procesoresponsable"]),
							"id_ai"              =>utf8_encode($accion["id_ai"]),
							"analisis_causas"    =>utf8_encode($accion["analisis_causas"]),
							"id_metodologia"     =>$accion["id_metodologia"],
							"metodologia"        =>utf8_encode($accion["metodologia"]),
							"id_generada"        =>$accion["id_generada"],
							"generada"           =>utf8_encode($accion["generada"])
							
							
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