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
	
	
			/*ELIMINO VARIABLES*/
			
			/*unset($filtrox);
			
			unset($filtrof);
			unset($filtrofe);
			unset($filtrode);
			
			unset($filtro1);
			unset($filtro2);
			unset($filtro3);
			unset($filtro4);
			unset($filtro5);
			unset($filtro6);
			
		
			unset($fechad);   
			unset($fechah);   
			
			unset($fechaded);  
			unset($fechadeh);  
			
			unset($fechaddd);   
			unset($fechaddh);  
			
			
			unset($datox1);   
			unset($datox2);  
			unset($datox3);    
			unset($datox4); 
			unset($datox5);    
			unset($datox6);   
			
			unset($datos);	
			
			unset($query);
			unset($resultado);
			unset($memo);*/
			/*----------------*/
			
			$fechaactual = $_GET["fechaactual"];
			
			$filtrox;
			
			$filtrof;
			$filtrofe;
			$filtrode;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechaded   = trim($_GET['dato_3']);
			$fechadeh   = trim($_GET['dato_4']);
			
			$fechaddd   = trim($_GET['dato_5']);
			$fechaddh   = trim($_GET['dato_6']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
		
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$fechad' AND DATE(t1.fecha_registro) <= '$fechah') ";
				
			
			}
			if ( !empty($fechaded) && !empty($fechadeh) ) {
			
				
				//$filtrofe = " AND t1.fecha_entrega = '$fechade' ";
				
				$filtrofe = " AND ( t1.fecha_entrega >= '$fechaded' AND  t1.fecha_entrega <= '$fechadeh') ";
				
			
			}
			if ( !empty($fechaddd) && !empty($fechaddh) ) {
			
				
				//$filtrofe = " AND t1.fecha_entrega = '$fechade' ";
				
				$filtrode = " AND ( t1.fecha_devolucion >= '$fechaddd' AND  t1.fecha_devolucion <= '$fechaddh') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t1.tipo_documento = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				//$filtro2 = " AND t4.nombre LIKE '%$datox2%' ";
				
				$filtro2 = " AND t1.idjuzgadodestino = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t1.idsolicitud = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
			
				$filtro4 = " AND t1.peticionario LIKE '%$datox4%' ";
			
			}
			
			
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND t1.folios = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.observacionesm LIKE '%$datox6%' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof." ".$filtrofe." ".$filtrode;
		
		
			if ( !empty($fechaactual) ) {
			
				$query     = "SELECT t1.id,t1.fecha_registro,t1.peticionario,t1.tipo_documento,t1.folios,t1.fecha_entrega,t1.fecha_devolucion,
							  t1.observacionesm,
							  t2.nombre AS jusgadodestino,t2.id AS idjuzgadodestino,
							  t3.nombre AS solicitud,t3.id AS idsolicitud,
							  t4.empleado,t1.ruta_local
							  FROM (((correspondencia t1 LEFT JOIN juzgado_destino t2 ON t1.idjuzgadodestino = t2.id)
							  LEFT JOIN pa_solicitud t3 ON t1.idsolicitud = t3.id)
							  LEFT JOIN pa_usuario t4 ON t1.idusuario = t4.id)
							  WHERE t1.radicado = 0
							  AND ( DATE(fecha_registro) >= '$fechaactual' AND DATE(fecha_registro) <= '$fechaactual' ) 
							  ORDER BY t1.id DESC";
		
			
			}
			else{
				  
				$query     = "SELECT t1.id,t1.fecha_registro,t1.peticionario,t1.tipo_documento,t1.folios,t1.fecha_entrega,t1.fecha_devolucion,
							  t1.observacionesm,
							  t2.nombre AS jusgadodestino,t2.id AS idjuzgadodestino,
							  t3.nombre AS solicitud,t3.id AS idsolicitud,
							  t4.empleado,t1.ruta_local
							  FROM (((correspondencia t1 LEFT JOIN juzgado_destino t2 ON t1.idjuzgadodestino = t2.id)
							  LEFT JOIN pa_solicitud t3 ON t1.idsolicitud = t3.id)
							  LEFT JOIN pa_usuario t4 ON t1.idusuario = t4.id)
							  WHERE t1.id >= '1'" .$filtrox. " AND t1.radicado = 0 
							  ORDER BY t1.id DESC";			
						  
			}			    
	
			
			$resultado = mysql_query($query);		  
			
			$datos     = array();
			
			while($memo = mysql_fetch_array($resultado)){
					
				/*if( strlen($usuarios["observacioncostas"]) == 0 ){
					
					$usuarios["observacioncostas"] = "x";
				}*/
					
				$datos[]=array(	
				
								"id"               =>$memo["id"],
								"fecha_registro"   =>$memo["fecha_registro"],
								"peticionario"     =>utf8_encode($memo["peticionario"]),
								"tipo_documento"   =>$memo["tipo_documento"],
								"folios"           =>$memo["folios"],
								"fecha_entrega"    =>$memo["fecha_entrega"],
								"fecha_devolucion" =>$memo["fecha_devolucion"],
								"observacionesm"   =>utf8_encode($memo["observacionesm"]),
								"idjuzgadodestino" =>$memo["idjuzgadodestino"],
								"jusgadodestino"   =>$memo["jusgadodestino"],
								"idsolicitud"      =>$memo["idsolicitud"],
								"solicitud"        =>$memo["solicitud"],
								"empleado"         =>$memo["empleado"],
								"ruta_local"       =>$memo["ruta_local"]
								
								
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