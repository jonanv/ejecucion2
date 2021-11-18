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

	
	//PARA GENERAR LA TABLA
	if (isset($_GET) && count($_GET)>0)
	{
	
		$dato_radicado = trim($_GET['valor_id']);
		
		//SE CIERRA LA LINEA POR QUE ALGUNOS PROCESOS EN LA TABLA ubicacion_expediente
		//TIENEN DEFINIDA TANTO FECHA DE SALIDA COM DE DEVOLUCION
		$query = "SELECT id,radicado,fecha,
				  cedula_demandante,demandante,cedula_demandado,demandado,
				  fechasalida
				  FROM ubicacion_expediente
				  WHERE (idjuzgado_reparto = 2 OR idjuzgadodestino = 2)
				  AND (fechasalida IS NOT NULL OR fechasalida != '0000-00-00')
				  AND (posicion IS NOT NULL OR posicion IS NULL OR posicion = '')
				  /*AND (fechadevolucion IS NULL OR fechadevolucion = '0000-00-00')*/
				  AND radicado = '$dato_radicado' 
				  ORDER BY fechasalida DESC";
	
				
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($expe = mysql_fetch_array($resultado)){
				
			
			$datos[]=array(	
							"id"                =>$expe["id"],
							"radicado"          =>$expe["radicado"],
							"fecha"             =>utf8_encode($expe["fecha"]),
							"cedula_demandante" =>utf8_encode($expe["cedula_demandante"]),
							"demandante"        =>utf8_encode($expe["demandante"]),
							"cedula_demandado"  =>utf8_encode($expe["cedula_demandado"]),
							"demandado"         =>utf8_encode($expe["demandado"]),
							"fechasalida"       =>$expe["fechasalida"]
							
							
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