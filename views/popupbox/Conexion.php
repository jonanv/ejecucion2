<?php

$dbhost           ='localhost';
$dbusername       ='javo2';
$dbuserpassword   ='Ejecuc10n2014';
$dbdefault_dbname ='ejecucion';

function db_connect(){

	global $dbhost, $dbusername, $dbuserpassword, $dbdefault_dbname;
	
	$link = mysql_connect($dbhost, $dbusername, $dbuserpassword);

	if(!$link){
		echo "Fallo en la Conexión al host $dbhost";
		return 0;
	}
	else if(empty($dbname) && !mysql_select_db($dbdefault_dbname)){
		echo "Fallo en la Conexión al host $dbhost";
		return 0;
	}
	else return $link;
}
?>

