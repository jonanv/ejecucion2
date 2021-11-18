<?php
//session_start();
include_once('Conexion.php');

class Funciones {
	
	//////////////////////////////////////////////////// 
	//Convierte fecha de mysql a normal 
	//////////////////////////////////////////////////// 
	function cambiaf_a_normal($fecha){ 
    	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    	return $lafecha; 
	} 
	//////////////////////////////////////////////////// 
	//Convierte fecha de normal a mysql 
	//////////////////////////////////////////////////// 
	function cambiaf_a_mysql($fecha){ 
    	ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha); 
    	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1]; 
    	return $lafecha; 
	}
	//////////////////////////////////////////////////// 
	//RECIBE UNA HORA Y CREA UN VECTOR EN $hora_real A PARTIR DE LOS DOS : 
	// Y TOMA LA CERO(0) POSICION EN $he_user2 Y LE RESTA 1
	//Y EN $he_user_real CONCATENO EL RESULTADO EN $he_user2 Y LA PRIMERA(1) POSICION EN $hora_real
	//////////////////////////////////////////////////// 
	function hora_real_del_sistema($hora_real){
		$hora_real = split(":",$hora_real);
		$he_user2=((int)$hora_real[0])-1;
		$he_user_real=$he_user2.":".$hora_real[1];
		return $he_user_real;
	}
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO CON LOS DATOS ESPECIFICOS
	//RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar){
	
		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM"." ".$nombre_tabla." "."ORDER BY"." ".$campo_a_ordenar;
		//$query = "SELECT * FROM"." ".$nombre_tabla." "."GROUP BY"." ".$campo_a_ordenar;
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO UTILIZANDO FILTRO 
	//CON LOS DATOS ESPECIFICOS RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar){

		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM ".$nombre_tabla." WHERE ".$campo_filtro. "= ".$valor_filtro." ORDER BY ".$campo_a_ordenar;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO UTILIZANDO FILTRO 
	//CON LOS DATOS ESPECIFICOS RECIBIDOS EN LA FUNCION 
	//////////////////////////////////////////////////// 
	function cargar_lista_con_filtro_general($sql){

		$link = db_connect($dbdefault_dbname);
		$query = $sql;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			//echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
			
			echo "<option value=\"". $query_data[id].", CEDULA: ".$query_data[cedula].", NOMBRE: ".$query_data[nombre] ."\">" . $query_data[nombre] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	
	function get_idradicado($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT pr.id,pr.radicado
				  FROM (documentos_internos di INNER JOIN signot_proceso pr ON di.idradicado = pr.id)
                  WHERE di.id = '$id'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATO = $row[id]."//////".$row[radicado];
			return $DATO;
		}
		mysql_close($link);
		
	}
	
	function get_idradicado_2($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM signot_proceso WHERE id = '$id'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATO = $row[id]."//////".$row[radicado];
			return $DATO;
		}
		mysql_close($link);
		
	}
	
	function get_tipo_correspondencia($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_correspondencia_v1 WHERE id = ".$idcorres;
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return;
			}
			else{
			
				$DATOAUDI = $row[fechaaudi]."//////".$row[horaaudi]."//////".$row[duracionaudi]."//////".$row[salaaudi]."//////".$row[juzgadoaudi]."//////".
				            $row[ministerioaudi]."//////".$row[detenidosaudi]."//////".$row[estadoaudi]."//////".$row[imnediataaudi]."//////".
							$row[obervacionesaudi];
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}
	
	function get_datos_basededatos($idbd){
  
  		$link = db_connect($dbdefault_dbname);
		
  		$query = "SELECT * FROM pa_base_datos WHERE id = ".$idbd;
	
  		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATOBD = $row[ip]."//////".$row[bd]."//////".$row[usuario]."//////".$row[clave];
			return $DATOBD;
		}
		
		mysql_close($link);
		
  }
  
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
	
	function get_radi_corres_tutela(){
	
		$link  = db_connect($dbdefault_dbname);
	
		$query  = "SELECT radicado FROM correspondencia_tutelas";
	
  		$result = mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			$filtroT .= "'".$query_data[radicado]."'".",";
		}
		
		mysql_free_result($result);
		mysql_close($link);
		
		//return $filtroT;
		
		return "AND [A103LLAVPROC] NOT IN(".$filtroT."'00000000000000000000000'".")";
	
	}
	
	
	
	
//-----------------------------------------------------------------------
}//FIN CLASE
?>
