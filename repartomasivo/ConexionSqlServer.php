<?php

/*$db_usr    = 'sa';
$db_pass   = 'crow';
$db_server = 'usuario-PC\SQLExpress';
$db_name   = 'prueba';*/

$db_usr    = 'sa';
$db_pass   = 'M4nt3n1m13nt0';
$db_server = '192.168.89.20';
$db_name   = 'ConsejoPN';

function conectar_bd(){

	global $db_usr, $db_pass, $db_server, $db_name;
	
	$db_info = array('Database'=>$db_name, 'UID'=>$db_usr, 'PWD'=>$db_pass);
 
	$db_link = sqlsrv_connect($db_server, $db_info);
 
	if(!$db_link){
		echo "NO SE ESTABLECIO LA CONEXION CON LA BASE DE DATOS..."."<br/>"."<br/>";
		die( print_r( sqlsrv_errors(), true));
		return 0;
	}
	else{
		return $db_link;
	}	
}
?>

