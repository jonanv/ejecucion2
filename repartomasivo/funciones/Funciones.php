<?php
//session_start();
//include_once "./Conexion.php";

class Funciones {
	
	//////////////////////////////////////////////////// 
	//Convierte fecha de mysql a normal 
	//////////////////////////////////////////////////// 
	function cambiaf_a_normal($fecha){ 
    	//ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
		
		preg_match("#([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})#", $fecha, $mifecha); 
    	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    	return $lafecha; 
	} 
	//////////////////////////////////////////////////// 
	//Convierte fecha de normal a mysql 
	//////////////////////////////////////////////////// 
	function cambiaf_a_mysql($fecha){ 
		
		//LA FUNCION EREG ESTA OBSOLETA Y SE REEMPLAZO POR preg_match TENIENDO
		//ENCERRANDO LA EXPRESION A VALIDAR ENTRE # EXPRESION A VALIDAR # 
    	//ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
		
		preg_match("#([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})#", $fecha, $mifecha);
    	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    	return $lafecha; 
	}
	
	function Obtener_Separador($separador){
	
		$separadorarchivo = substr($separador, 23, 1);
		return $separadorarchivo; 
	}
	
	
//-----------------------------------------------------------------------
}//FIN CLASE
?>
