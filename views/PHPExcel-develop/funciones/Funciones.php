<?php
//session_start();
//include_once "./Conexion.php";

class Funciones {
	//-----------------------------------------------------------------------
	
	function ReturnNumbers($var){
	
		$i = 0;
		$return = "";
		$part_var = "";
		$len_var = strlen($var);
	
		for($i=0; $i<$len_var; $i++){
			$part_var = substr($var, $i, 1);
	
			if(is_numeric( $part_var )){
				$return .= $part_var;
			}
		}
	
		return $return;
	}
	
	
}//FIN CLASE
?>
