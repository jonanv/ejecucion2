<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

date_default_timezone_set('America/Bogota'); 

//CONEXION ORIGINAL CON TABLA tcalendario
/*$dbhost = "localhost";
$dbname = "prueba";
$dbuser = "root";
$dbpass = "crow";
$tabla  = "tcalendario";*/

$dbhost = "localhost";
$dbname = "laborales";
$dbuser = "root";
$dbpass = "admin";
$tabla  = "siepro_audiencia";

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if ($db->connect_errno) {

	die ("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</h1>");
}
?>
