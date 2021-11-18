<?php

session_start(); 

include_once('Conexionpopupbox.php');


if($_SESSION['id']!=""){


/*$dbhost ="localhost";
$dbname   ="ejecucion";
$dbuser   ="javo2";
$dbpass   ="Ejecuc10n2014";
$db       = new mysqli($dbhost,$dbuser,$dbpass,$dbname);*/

$conexion = db_connect($dbdefault_dbname);

$error_transaccion = 0; //variable para detectar error

//$link = db_connect($dbdefault_dbname);

/*$idusuario         = $_SESSION['idUsuario'];

$valor_id_obs      = $_POST["id"];
		
date_default_timezone_set('America/Bogota'); 
$fechahora     = date('Y-m-d g:ia'); 
$datosfecha    = explode(" ",$fechahora);
$fechalog      = $datosfecha[0];
$horalog       = $datosfecha[1];

$tiporegistro = "EDITA OBSERVACION ADICIONAL";
$accion       = $tiporegistro." ID OBSERVACION: ".$valor_id_obs;
$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
$tipolog      = 1;*/




if($conexion > 0){

	//PARA EDITAR
	if (isset($_POST) && count($_POST)>0)
	{
		
		
		
		mysql_query("START TRANSACTION",$conexion);				
		
		
		$query     = "UPDATE correspondencia SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
		             "' WHERE id ='".intval($_POST["id"])."' limit 1";
					 
		$resultado = mysql_query($query);
		
		if (!$resultado) {
						
			$error_transaccion = 1;
														
		}
		
		
		/*$query_2     = "INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
					    VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')";
						
		
		$resultado_2 = mysql_query($query_2);
		
		if (!$resultado_2) {
						
			$error_transaccion = 1;
														
		}*/
						
		
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
	
	
			
			
			$idda = $_GET["recipient"];
			
			$query     = "	SELECT * FROM expe_entidad_memo_detalle
						  	WHERE id_entidad_memo = ".$idda."
					      	ORDER BY id";
							  
			$resultado = mysql_query($query);		  
			
			$datos     = array();
			
			while($deman = mysql_fetch_array($resultado)){
					
				/*if( strlen($usuarios["observacioncostas"]) == 0 ){
					
					$usuarios["observacioncostas"] = "x";
				}*/
					
				$datos[]=array(	
				
								"id"              =>$deman["id"],
								"id_entidad_memo" =>$deman["id_entidad_memo"],
								"ruta"            =>utf8_encode($deman["ruta"])
								
								
								//echo '<a href="' . htmlspecialchars("/siguientepagina.php?etapa=23&datos=" .urlencode($datos)) . '">'."\n";
								
								
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

}
?>