<?php

session_start(); 

include_once('Conexionpopupbox.php');


if($_SESSION['id']!=""){

//$iddepartamento  =  $_SESSION['iddepartamento'];
//$idmunicipio     =  $_SESSION['idmunicipio'];

/*$dbhost ="localhost";
$dbname ="laborales";
$dbuser ="root";
$dbpass ="admin";
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
	
	
			
			
			$datos_radi = explode("-",trim($_GET["recipient"]));
			
			$id_radi   = $datos_radi[0];
			
			
			
			/*$query           = "SELECT idradiacumulado 
			                    FROM ubicacion_expediente WHERE radicado = ".$n_radi;
							  
			$resultado       = mysql_query($query);		
			$acum_1          = mysql_fetch_array($resultado) ;
			$idradiacumulado = $acum_1["idradiacumulado"];*/
			
			
			/*$query_2         = "SELECT * FROM ubicacion_expediente 
			                    WHERE idradiacumulado IN( " .$id_radi. ")
								ORDER BY radicado";*/
								
			$query_2         = "SELECT * FROM ubicacion_expediente 
			                    WHERE idradiacumulado LIKE '%".trim($id_radi)."%'
								ORDER BY radicado";
								
			//PARA SABER SI LA CONSULTA ESTA BUENA						
			/*$datos[]=array(	
				
								"id"                =>$query_2,
								"radicado"          =>$query_2,
								"digitalizado"      =>$query_2
								
				);*/
									
								
			$resultado_2     = mysql_query($query_2);		
			
			$datos     = array();
			
			while($acum_2 = mysql_fetch_array($resultado_2)){
					
				
					
				$datos[]=array(	
				
								"id"                =>$acum_2["id"],
								"radicado"          =>$acum_2["radicado"],
								"digitalizado"      =>$acum_2["digitalizado"]
								
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

}
?>