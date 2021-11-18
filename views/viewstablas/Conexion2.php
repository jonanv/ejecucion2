<?php

$dbhost           ='localhost';
$dbusername       ='root';
$dbuserpassword   ='admin';
$dbdefault_dbname ='laborales';

function db_connect(){

	global $dbhost, $dbusername, $dbuserpassword, $dbdefault_dbname;
	
	$link = mysql_connect($dbhost, $dbusername, $dbuserpassword);

	if(!$link){
		echo "Fallo en la Conexi�n al host $dbhost";
		return 0;
	}
	else if(empty($dbname) && !mysql_select_db($dbdefault_dbname)){
		echo "Fallo en la Conexi�n al host $dbhost";
		return 0;
	}
	else return $link;
}
?>

