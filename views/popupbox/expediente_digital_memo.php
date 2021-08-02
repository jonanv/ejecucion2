<?php

session_start(); 

include_once('Conexionpopupbox.php');


if($_SESSION['id']!=""){


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
	
	
			$datosradi = explode("******",$_GET["recipient"]);
			
			//$idda = $_GET["recipient"];
			
			$idradi = $datosradi[0];
			$nradi  = $datosradi[1];
			
			
			$query     = "	SELECT
							dc.id AS idactu,ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,
							t2.nombre AS solicitud,t1.ruta_local,dc.id_memorial,
							dc.idestadorevisojuz,dc.idrevisojuz2,dc.fecharevisado,dc.horarevisado,t3.empleado,
							dc.id_user_asignada,dc.fecha_obs_i,dc.fecha_obs_f,dc.juzobsextra,dc.estadoobs,
							dc.fecha_obs_i,dc.fecha_obs_f,dc.tareacerrada,dc.fechacerrar,dc.horacerrar,ubi.digitalizado,
							dc.desde_reparto,t1.fecha_registro,t1.id_memo_externo
							
							FROM ((((
							
							detalle_correspondencia dc
							
							INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
							LEFT  JOIN correspondencia       t1 ON dc.id_memorial       = t1.id)
							LEFT  JOIN pa_solicitud          t2 ON t1.idsolicitud       = t2.id)
							LEFT  JOIN pa_usuario            t3 ON dc.idrevisojuz2      = t3.id)
							
							WHERE dc.id >= 1
							AND ubi.idjuzgado_reparto = ubi.idjuzgado_reparto
							AND (dc.estadoobs != 3 AND dc.estadoobs != 4)
							AND ((dc.a_despacho = 1) OR (dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
							AND dc.idcorrespondencia = '$idradi'
							
							AND dc.revisasecretaria = 1
							
							ORDER BY dc.fecha DESC,ubi.radicado";
							  
			$resultado = mysql_query($query);		  
			
			$datos     = array();
			
			while($deman = mysql_fetch_array($resultado)){
					
				/*if( strlen($usuarios["observacioncostas"]) == 0 ){
					
					$usuarios["observacioncostas"] = "x";
				}*/
					
				$datos[]=array(	
				
								"idactu"      =>$deman["idactu"],
								"fecha"       =>$deman["fecha"],
								"id"          =>$deman["id"],
								"radicado"    =>$deman["radicado"],
								"observacion" =>utf8_encode($deman["observacion"]),
								"id_memorial" =>$deman["id_memorial"],
								"solicitud"   =>utf8_encode($deman["solicitud"]),
								"ruta_local"  =>utf8_encode($deman["ruta_local"]),
								"fecha_registro"	=>$deman["fecha_registro"],
								"id_memo_externo"	=>$deman["id_memo_externo"]
								
								
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