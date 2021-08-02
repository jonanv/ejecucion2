<?php

session_start(); 

include_once('Conexion.php');


if($_SESSION['id']!=""){

//$iddepartamento  =  $_SESSION['iddepartamento'];
//$idmunicipio     =  $_SESSION['idmunicipio'];

/*$dbhost ="localhost";
$dbname ="ejecucion";
$dbuser ="root";
$dbpass ="Ejecuc10n2014";
$db     = new mysqli($dbhost,$dbuser,$dbpass,$dbname);*/

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
	
	
			
			
			//$idregistra = $_GET["recipient_1"];
			
			
			$query_2 = "SELECT t1.id,t2.id AS idradicado,t2.radicado,t3.empleado,t1.fecha,t1.hora,t3.esabogado,t3.correo
						FROM ((expe_solicitud t1
						INNER JOIN ubicacion_expediente t2 ON t1.idradicado    = t2.id)
						INNER JOIN pa_usuario_expe      t3 ON t1.idsolicitante = t3.id)
						WHERE t2.digitalizado IS NULL 
						OR (SELECT COUNT(id) FROM expe_digital WHERE idradicado = t1.idradicado) = 0";
			
								
			$resultado_2   = mysql_query($query_2);		
			
			$datos     = array();
			
			while($soli_2 = mysql_fetch_array($resultado_2)){
					
				
					
				$datos[]=array(	
				
								"id"            =>$soli_2["id"],
								"idradicado"    =>$soli_2["idradicado"],
								"radicado"      =>$soli_2["radicado"],
								"empleado"      =>$soli_2["empleado"],
								"fecha"         =>$soli_2["fecha"],
								"hora"          =>$soli_2["hora"],
								"esabogado"     =>$soli_2["esabogado"],
								"correo"        =>$soli_2["correo"]
								
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