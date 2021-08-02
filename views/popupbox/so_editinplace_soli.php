<?php

session_start(); 

if($_SESSION['id']!=""){

/*$dbhost ="localhost";
$dbname ="ejecucion";
$dbuser ="root";
$dbpass ="Ejecuc10n2014";
$db     = new mysqli($dbhost,$dbuser,$dbpass,$dbname);*/

$idusuarioX  = $_SESSION['idUsuario'];

include_once('Conexionpopupbox.php');

$conexion = db_connect($dbdefault_dbname);

$error_transaccion = 0; //variable para detectar error

//$link = db_connect($dbdefault_dbname);

date_default_timezone_set('America/Bogota'); 
$fecha_respuesta = date('Y-m-d');
$hora_respuesta  = date('H:i');

if($conexion > 0){

	//PARA EDITAR
	if (isset($_POST) && count($_POST)>0)
	{
		
		
		$idX         = trim($_POST["idX"]);
		$fechaX      = trim($_POST["fechaX"]);
		$horaX       = trim($_POST["horaX"]);
		$desX        = utf8_decode(trim($_POST["desX"]));
		$userX       = utf8_decode(trim($_POST["userX"]));
		$fechaRX     = trim($_POST["fechaRX"]);
		$horaRX      = trim($_POST["horaRX"]);
		$respuestaX  = utf8_decode(trim($_POST["respuestaX"]));
		$estadoX     = trim($_POST["estadoX"]);
		
		
		mysql_query("START TRANSACTION",$conexion);
		
		//SE REALIZA ESTA COMPARACION, YA QUE SI UNA SOLICITUD SE VUELVE A PONER EN ESTADO (EN PROCESO)
		//ACTUALIZAR LOS CAMPOS fecha_respuesta = NULL, hora_respuesta = NULL, respuesta = '-', estado = 0
		//PARA QUE QUEDE COMO SI NO SE HUBIERA PROCESADO
		if($_POST["campo"] == 'estado' && $_POST["valor"] == 0){
		
			$query     = "UPDATE so_ticket SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
		             	 "', fecha_respuesta = NULL, hora_respuesta = NULL, respuesta = '-', estado = 0 WHERE id ='".intval($_POST["id"])."' limit 1";
			
			
			$query_2   = "INSERT INTO so_ticket_historial(fecha,hora,des,iduser,fecha_respuesta,hora_respuesta,respuesta,estado,iduserregistro,id_so_ticket)
			              VALUES('$fechaX','$horaX','$desX','$userX',NULL,NULL,'-','EN PROCESO','$idusuarioX','$idX')";			 
						 
		
		}
		else{
		
		
			//SE IDENTIFICA QUE SOLO SE VA A EDITAR LA FECHA
			if($_POST["campo"] == 'fecha_respuesta'){
			
				
				$fechaRX = $_POST["valor"];
				
					
				$query     = "UPDATE so_ticket SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
							 "' WHERE id ='".intval($_POST["id"])."' limit 1";
							 
				
				
				$query_2   = "INSERT INTO so_ticket_historial(fecha,hora,des,iduser,fecha_respuesta,hora_respuesta,respuesta,estado,iduserregistro,id_so_ticket)
			                  VALUES('$fechaX','$horaX','$desX','$userX','$fechaRX','$horaRX','$respuestaX','$estadoX','$idusuarioX','$idX')";
						  			 
				
			}
			else{
			
				//SE IDENTIFICA QUE SOLO SE VA A EDITAR LA RESPUESTA
				//SI ES CERO ES POR QUE EL USUARIO NO CHEKEO EL checkbox
				//DE LA COLUMNA RESPUESTA, Y ACTUALIZA fecha_respuesta y hora_respuesta
				//ACUALES DEL DIA
				if($_POST["solorespuesta"] == 0 && $_POST["anular"] == 0){
				
				
					$respuestaX = utf8_decode($_POST["valor"]);
					
					$query     = "UPDATE so_ticket SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
								 "',fecha_respuesta = '$fecha_respuesta',hora_respuesta = '$hora_respuesta', estado = 1 WHERE id ='".intval($_POST["id"])."' limit 1";
								 
								 
					
					$query_2   = "INSERT INTO so_ticket_historial(fecha,hora,des,iduser,fecha_respuesta,hora_respuesta,respuesta,estado,iduserregistro,id_so_ticket)
			                      VALUES('$fechaX','$horaX','$desX','$userX','$fecha_respuesta','$hora_respuesta','$respuestaX','TERMINADA','$idusuarioX','$idX')";
					
								 
				}
				else{
					
					if($_POST["anular"] == 1){
					
					
						$respuestaX = utf8_decode($_POST["valor"]);
					
					
						 
						$query     = "UPDATE so_ticket SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
								     "',fecha_respuesta = '$fecha_respuesta',hora_respuesta = '$hora_respuesta', estado = 2 WHERE id ='".intval($_POST["id"])."' limit 1";			 
									 
						
						$query_2   = "INSERT INTO so_ticket_historial(fecha,hora,des,iduser,fecha_respuesta,hora_respuesta,respuesta,estado,iduserregistro,id_so_ticket)
			                          VALUES('$fechaX','$horaX','$desX','$userX','$fecha_respuesta','$hora_respuesta','$respuestaX','ANULADA','$idusuarioX','$idX')";			 
					
					}
					else{
					
						$respuestaX = utf8_decode($_POST["valor"]);
						
						
						$query     = "UPDATE so_ticket SET ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
								     "' WHERE id ='".intval($_POST["id"])."' limit 1";
									 
						
						$query_2   = "INSERT INTO so_ticket_historial(fecha,hora,des,iduser,fecha_respuesta,hora_respuesta,respuesta,estado,iduserregistro,id_so_ticket)
			                          VALUES('$fechaX','$horaX','$desX','$userX','$fechaRX','$horaRX','$respuestaX','$estadoX','$idusuarioX','$idX')";			 
									 
									 
					}
					
				}
				
					
			}
				
	
							 
		}
					 
		$resultado = mysql_query($query);
		
		if (!$resultado) {
						
			$error_transaccion = 1;
														
		}
		
		$resultado_2 = mysql_query($query_2);
		
		if (!$resultado_2) {
						
			$error_transaccion = 1;
														
		}
		
		
		if($error_transaccion) {
							
			
			echo "<span class='ko'>"."ERROR EN LA OPERACION ".mysql_errno($conexion). ": " . mysql_error($conexion)."</span>";
			
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			mysql_query("ROLLBACK",$conexion);
			
			
	
		} //FIN if($error_transaccion) 
		else {
			
			/*$v1 = trim($_POST["campo"]);
			$v2 = trim($_POST["valor"]);			
			$v3 = trim($_POST["id"]);
			$v4 = trim($_POST["solorespuesta"]);
			
			$VTOTAL = "<span class='ok'>VALORES MODIFICADOS CORRECTAMENTE.</span>"."******".$v1."******".$v2."******".$v3."******".$v4;*/
			
			echo "<span class='ok'>VALORES MODIFICADOS CORRECTAMENTE.</span>";
			
			echo $VTOTAL;
						
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
		
	
		/*$query     = "	SELECT t1.id,
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
				
			/*$datos[]=array(	
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
		
		echo json_encode($datos);*/
		
	}

}
else{

	//echo $conexion; 
	echo "Fallo en la Conexión";
}

}//CIERRE IF SESSION 

mysql_free_result($resultado);
mysql_close($conexion);

?>