<?php
/* ©2004 Proverbs, LLC. All rights reserved. */ 

if (eregi("config.inc.php", $_SERVER['PHP_SELF']))
{
	// redirect to calendar page
	header("Location: calendar.php");
	exit;
}

if(!defined("CONFIGURATION_INFO")) 
{ 
	define("CONFIGURATION_INFO", TRUE);
     
	class cal_config
	{
		
		/* This is the sql server name */
		//var $databasehost 		= 'localhost';
		var $databasehost 		= 'hotelc.db.3308612.hostedresource.com';
		/* Name of the database used */
		//var $databasename 		= 'crm_carretero';
		var $databasename 		= 'hotelc';
		/* Name used to connect to the server database.  Must have read/write access */
		//var $databaseuser 		= 'root';
		var $databaseuser 		= 'hotelc';
		/* Password used to connect to the server database */
		//var $databasepassword 	= '';
		var $databasepassword 	= 'HC354CRm21';

		function cal_config()
		{
		}
	}
}
?>