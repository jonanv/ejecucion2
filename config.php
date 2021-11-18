<?php
$config = Config::singleton();

$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');

$config->set('dbhost', 'localhost');
$config->set('dbname', 'laborales');
$config->set('dbuser', 'root');
$config->set('dbpass', 'admin');

define('titulo',' - Oficina Ejecuci&oacute;n de Sentencias -'); 
define('rutabase','/laborales/'); 


?>