<?php
//session_start();
include_once('Conexionpopupbox.php');

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
	function cargar_lista_2($campo_a_mostrar,$campo_a_insertar_1,$campo_a_insertar_2,$campo_a_insertar_3,$nombre_tabla,$campo_a_ordenar){
	
		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM"." ".$nombre_tabla." "."ORDER BY"." ".$campo_a_ordenar;
		//$query = "SELECT * FROM"." ".$nombre_tabla." "."GROUP BY"." ".$campo_a_ordenar;
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar_1]."---".$query_data[$campo_a_insertar_2]."---".$query_data[$campo_a_insertar_3] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	function cargar_lista_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar,$iddatolista){
	
		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM"." ".$nombre_tabla." "."ORDER BY"." ".$campo_a_ordenar;
		//$query = "SELECT * FROM"." ".$nombre_tabla." "."GROUP BY"." ".$campo_a_ordenar;
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){
			
			if($query_data[$campo_a_insertar] == $iddatolista){
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\" selected='selected'>" . $query_data[$campo_a_mostrar] . "</option>";
			}
			else{
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
			
			}
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
	function cargar_lista_con_filtro_LIKE($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar){

		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM ".$nombre_tabla." WHERE ".$campo_filtro." ".$valor_filtro." ORDER BY ".$campo_a_ordenar;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	////////////////////////////////////////////////////
	//ME PERMITE CARGAR UN COMBO UTILIZANDO FILTRO 
	//CON LOS DATOS ESPECIFICOS RECIBIDOS EN LA FUNCION, Y SELECIONAR UN ITEM DE LA LISTA 
	//////////////////////////////////////////////////// 
	function cargar_lista_con_filtro_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar,$iddatolista){

		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM ".$nombre_tabla." WHERE ".$campo_filtro. "= ".$valor_filtro." ORDER BY ".$campo_a_ordenar;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			
			
			if($query_data[$campo_a_insertar] == $iddatolista){
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\" selected='selected'>" . $query_data[$campo_a_mostrar] . "</option>";
			}
			else{
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
			
			}
		}
		mysql_free_result($result);
		mysql_close($link);
	}
	
	function cargar_lista_con_filtroX_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar,$iddatolista){

		$link = db_connect($dbdefault_dbname);
		$query = "SELECT * FROM ".$nombre_tabla." WHERE ".$campo_filtro." ".$valor_filtro." ORDER BY ".$campo_a_ordenar;
		
		$result= mysql_query($query);

		while($query_data = mysql_fetch_array($result)){

			
			
			if($query_data[$campo_a_insertar] == $iddatolista){
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\" selected='selected'>" . $query_data[$campo_a_mostrar] . "</option>";
			}
			else{
			
				echo "<option value=\"". $query_data[$campo_a_insertar] ."\">" . $query_data[$campo_a_mostrar] . "</option>";
			
			}
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
	
	function get_audi_caracteristicas($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_correspondencia_v1 WHERE id = ".$idcorres;
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return;
			}
			else{
			
				$DATOAUDI = $row[folios]."//////";
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}

	function get_tipo_correspondencia_audi($idcorres){
	
			
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
							$row[obervacionesaudi]."//////".$row[detalle];
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}
	
	function get_otro_ministerio_publico($desmp){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM pa_ministerio_publico WHERE des = '$desmp'";
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return 0;
			}
			else{
			
				return 1;
			}
			
			mysql_close($link);
	

	}
	
	
	
	function get_tipo_correspondencia_audi_detalle($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_correspondencia_v1 WHERE id = ".$idcorres;
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return;
			}
			else{
			
				$DATOAUDI = $row[fechaaudi]."*-/*-/".$row[horaaudi]."*-/*-/".$row[duracionaudi]."*-/*-/".$row[salaaudi]."*-/*-/".$row[juzgadoaudi]."*-/*-/".
				            $row[ministerioaudi]."*-/*-/".$row[detenidosaudi]."*-/*-/".$row[estadoaudi]."*-/*-/".$row[imnediataaudi]."*-/*-/".
							$row[obervacionesaudi]."*-/*-/".$row[detalle];
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}
	
	function get_tipo_correspondencia_audi_defensor($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_correspondencia_v1 WHERE id = ".$idcorres;
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return;
			}
			else{
			
				$DATOAUDI = $row[fechaaudi]."*-/*-/".$row[horaaudi]."*-/*-/".$row[duracionaudi]."*-/*-/".$row[salaaudi]."*-/*-/".$row[juzgadoaudi]."*-/*-/".
				            $row[ministerioaudi]."*-/*-/".$row[detenidosaudi]."*-/*-/".$row[estadoaudi]."*-/*-/".$row[imnediataaudi]."*-/*-/".
							$row[obervacionesaudi]."*-/*-/".$row[detalle]."*-/*-/".$row[defensor];
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}

	function get_tipo_correspondencia_audi_historial($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_correspondencia_v1 WHERE id = ".$idcorres;
		
			$sql = mysql_query($query);
			$row = mysql_fetch_array($sql);
			
			if(!$row){
			
				return;
			}
			else{
			
				$DATOAUDI = $row[fechaaudi]."*-/*-/".$row[horaaudi]."*-/*-/".$row[duracionaudi]."*-/*-/".$row[salaaudi]."*-/*-/".$row[juzgadoaudi]."*-/*-/".
				            $row[ministerioaudi]."*-/*-/".$row[detenidosaudi]."*-/*-/".$row[estadoaudi]."*-/*-/".$row[imnediataaudi]."*-/*-/".
							$row[obervacionesaudi]."*-/*-/".$row[detalle]."*-/*-/".$row[defensor]."*-/*-/".$row[historial];
				
				return $DATOAUDI;
			}
			
			mysql_close($link);
	

	}
	
	function get_tipo_correspondencia($idprocesox,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.detalle,t1.fiscalia,t2.fiscalia AS nombrefiscalia,t1.observacion,t1.estadoregistro 
		          	  FROM (radicador_correspondencia_v1 t1 INNER JOIN rg_pa_fiscalias t2 ON t1.fiscalia = t2.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 2){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.detalle,t1.despacho,t2.des AS nombredespacho,t1.observacion,t1.estadoregistro 
		          	  FROM (radicador_correspondencia_v2 t1 INNER JOIN radicador_pa_juzgado t2 ON t1.despacho = t2.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 3){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tiposolicitud,t3.des AS nombretiposolicitud,
			          t1.fiscalia,t2.fiscalia AS nombrefiscalia,t1.otro,t1.observacio,t1.estadoregistro 
		          	  FROM ((radicador_correspondencia_v3 t1 INNER JOIN rg_pa_fiscalias t2 ON t1.fiscalia = t2.id)
					  INNER JOIN radicador_pa_solicitud t3 ON t1.tiposolicitud = t3.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 4){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tipodocumento,t3.des AS nombretipodoc,
					  t1.asunto,t1.despacho,t2.des AS nombredespacho,t1.observacio,t1.estadoregistro 
		          	  FROM ((radicador_correspondencia_v4 t1 INNER JOIN radicador_pa_juzgado t2 ON t1.despacho = t2.id)
					  INNER JOIN radicador_pa_tipo_documento t3 ON t1.tipodocumento = t3.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[detalle];
				$d5 = $fila[fiscalia];
				$d6 = $fila[observacion];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombrefiscalia];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."*/-*/-";
				
			}
			
			if($idsql == 2){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[detalle];
				$d5 = $fila[despacho];
				$d6 = $fila[observacion];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombredespacho];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."*/-*/-";
				
			}
			
			if($idsql == 3){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[fiscalia];
				$d6 = $fila[observacio];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombrefiscalia];
				$d9 = $fila[tiposolicitud];
				$d10 = $fila[otro];
				$d11 = $fila[nombretiposolicitud];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
			}
			
			if($idsql == 4){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[despacho];
				$d6 = $fila[observacio];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombredespacho];
				$d9 = $fila[tipodocumento];
				$d10 = $fila[asunto];
				$d11 = $fila[nombretipodoc];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_tipo_correspondencia_sinradicado($idprocesox,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.detalle,t1.fiscalia,t2.fiscalia AS nombrefiscalia,t1.observacion,t1.estadoregistro 
		          	  FROM (radicador_correspondencia_v1 t1 INNER JOIN rg_pa_fiscalias t2 ON t1.fiscalia = t2.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 2){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.detalle,t1.despacho,t2.des AS nombredespacho,t1.observacion,t1.estadoregistro 
		          	  FROM (radicador_correspondencia_v2 t1 INNER JOIN radicador_pa_juzgado t2 ON t1.despacho = t2.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 3){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tiposolicitud,t3.des AS nombretiposolicitud,
			          t1.fiscalia,t2.fiscalia AS nombrefiscalia,t1.otro,t1.observacio,t1.estadoregistro 
		          	  FROM ((radicador_correspondencia_v3 t1 INNER JOIN rg_pa_fiscalias t2 ON t1.fiscalia = t2.id)
					  INNER JOIN radicador_pa_solicitud t3 ON t1.tiposolicitud = t3.id)
					  WHERE idradicado = '0'
				      ORDER BY t1.id DESC";
					  
		}
		
		if($idsql == 4){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tipodocumento,t3.des AS nombretipodoc,
					  t1.asunto,t1.despacho,t2.des AS nombredespacho,t1.observacio,t1.estadoregistro 
		          	  FROM ((radicador_correspondencia_v4 t1 INNER JOIN radicador_pa_juzgado t2 ON t1.despacho = t2.id)
					  INNER JOIN radicador_pa_tipo_documento t3 ON t1.tipodocumento = t3.id)
					  WHERE idradicado = '0'
				      ORDER BY t1.id DESC";
					  
		}
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[detalle];
				$d5 = $fila[fiscalia];
				$d6 = $fila[observacion];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombrefiscalia];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."*/-*/-";
				
			}
			
			if($idsql == 2){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[detalle];
				$d5 = $fila[despacho];
				$d6 = $fila[observacion];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombredespacho];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."*/-*/-";
				
			}
			
			if($idsql == 3){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[fiscalia];
				$d6 = $fila[observacio];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombrefiscalia];
				$d9 = $fila[tiposolicitud];
				$d10 = $fila[otro];
				$d11 = $fila[nombretiposolicitud];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
			}
			
			if($idsql == 4){
			
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[despacho];
				$d6 = $fila[observacio];
				$d7 = $fila[estadoregistro];
				$d8 = $fila[nombredespacho];
				$d9 = $fila[tipodocumento];
				$d10 = $fila[asunto];
				$d11 = $fila[nombretipodoc];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_lista_audiencias($idprocesox,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idradicado,t1.fechaaudi,t1.horaaudi,t1.detalle,t1.fiscalia,t2.fiscalia AS nombrefiscalia,t1.observacion,t1.estadoregistro,
					  t2.direccion,t1.defensor,t1.estadoaudi 
		          	  FROM (radicador_correspondencia_v1 t1 INNER JOIN rg_pa_fiscalias t2 ON t1.fiscalia = t2.id)
		              WHERE idradicado = '$idprocesox'
				      ORDER BY t1.id DESC";
					  
		}
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0  = $fila[id];
				$d1  = $fila[idradicado];
				$d2  = $fila[fechaaudi];
				$d3  = $fila[horaaudi];
				$d4  = $fila[detalle];
				$d5  = $fila[fiscalia];
				$d6  = $fila[observacion];
				$d7  = $fila[estadoregistro];
				$d8  = $fila[nombrefiscalia];
				$d9  = $fila[direccion];
				$d10 = $fila[defensor];
				$d11 = $fila[estadoaudi];
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
			}
			
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_motivotraza_audiencia($idaudi){
	
		
		$link = db_connect($dbdefault_dbname);
	

		$query = "SELECT anotacion FROM radicador_trazabilidad_audiencia
				  WHERE idaudiencia = '$idaudi'
				  AND id = (SELECT MAX(id) FROM radicador_trazabilidad_audiencia WHERE idaudiencia = '$idaudi')";
					  
		  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
			
				$d0T    = $fila[anotacion];
				$DATOCT = $d0T;
				
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOCT;
		
	}
	
	function get_partes_proceso($idprocesox){
	
		$link = db_connect($dbdefault_dbname);
	

		$query = "SELECT * FROM radicador_partes WHERE id_radicado = '$idprocesox'";
					  
		
				  
		$sql = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
		
				$d0 = $fila[id];
				$d1 = $fila[id_tipo];
				$d2 = $fila[doc_identidad];
				$d3 = $fila[nombre];
				$d4 = $fila[estado];
				
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."*/-*/-";
				
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_tipo_correspondencia_pn($idcorres){
	
		
		$link = db_connect($dbdefault_dbname);
	

		$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.detalle,t1.despacho,t1.observacion,t1.estadoregistro 
		          FROM radicador_correspondencia_v2 t1
		          WHERE t1.id = '$idcorres'";
					  
		
				  
		$sql = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
		
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[detalle];
				$d5 = $fila[despacho];
				$d6 = $fila[observacion];
				$d7 = $fila[estadoregistro];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."*/-*/-";
				
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	
	function get_tipo_correspondencia_doj($idcorres){
	
		
		$link = db_connect($dbdefault_dbname);
	

		$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tiposolicitud,
				  t1.fiscalia,t1.otro,t1.observacio,t1.estadoregistro 
				  FROM radicador_correspondencia_v3 t1 
				  WHERE t1.id = '$idcorres'";
					  
		
				  
		$sql = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
		
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[tiposolicitud];
				$d6 = $fila[fiscalia];
				$d7 = $fila[otro];
				$d8 = $fila[observacio];
				$d9 = $fila[estadoregistro];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."*/-*/-";
				
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	function get_tipo_correspondencia_otrosx($idcorres){
	
		
		$link = db_connect($dbdefault_dbname);
	

		$query = "SELECT t1.id,t1.idradicado,t1.fecha,t1.hora,t1.radicadoasociado,t1.tipodocumento,t1.asunto,t1.despacho,t1.observacio,t1.estadoregistro 
		          FROM radicador_correspondencia_v4 t1
		          WHERE t1.id = '$idcorres'";
					  
		
				  
		$sql = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
		
				$d0 = $fila[id];
				$d1 = $fila[idradicado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[radicadoasociado];
				$d5 = $fila[tipodocumento];
				$d6 = $fila[asunto];
				$d7 = $fila[despacho];
				$d8 = $fila[observacio];
				$d9 = $fila[estadoregistro];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."*/-*/-";
				
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
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
	
	
	
	function get_datos_proceso_anotacion_2($id,$idnom){
	
	
		$link = db_connect($dbdefault_dbname);
	
	
		/*$query = "SELECT spa.id,spa.idradicado,pu.empleado,spa.fecha,spa.hora,spa.anotacion,ta.destipo
				  FROM ((radicador_seguimiento spa INNER JOIN pa_usuario pu ON spa.idusuario = pu.id)
				  LEFT JOIN signot_pa_tipo_anotacion ta ON ta.id = spa.idtipoanotacion)
				  WHERE spa.idradicado = '$id' AND spa.anotacion LIKE '%$idnom%' AND (spa.anotacion LIKE '%Devolucion%' OR ta.destipo LIKE '%Devolucion%')
				  ORDER BY spa.id DESC";*/
				  
		
		$query = "SELECT spa.id,spa.idradicado,pu.empleado,spa.fecha,spa.hora,spa.anotacion
				  FROM (radicador_seguimiento spa INNER JOIN pa_usuario pu ON spa.idusuario = pu.id)
				  WHERE spa.idradicado = '$id' AND spa.anotacion LIKE '%$idnom%' AND (spa.anotacion LIKE '%Devolucion%')
				  ORDER BY spa.id DESC";
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);

		while($row = mysql_fetch_array($sql)){

			$registros.= $row[id]."//////".$row[fecha]."//////".$row[hora]."//////".$row[empleado]."//////".$row[anotacion]."******";
			
		}
		
		mysql_free_result($sql);
		mysql_close($link);
		
		return $registros;
	
	}
	
	function get_trazabilidad_audi($idcorres){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT ta.id,u.empleado,ta.fecha,ta.hora,ta.estado,ta.anotacion 
			          FROM radicador_trazabilidad_audiencia ta INNER JOIN pa_usuario u ON ta.idusuario = u.id
					  WHERE ta.idaudiencia = ".$idcorres." ORDER BY ta.id DESC";
		
			$sql = mysql_query($query);
			
			while($fila = mysql_fetch_array($sql)){
		
				$d0 = $fila[id];
				$d1 = $fila[empleado];
				$d2 = $fila[fecha];
				$d3 = $fila[hora];
				$d4 = $fila[estado];
				$d5 = $fila[anotacion];
				
			
				$DATOTA .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."*/-*/-";
				
			}
			
			mysql_free_result($sql);
			mysql_close($link);
		
			return $DATOTA;
	

	}
	
	function get_direcciones_parte($idprocesox,$idparte,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idparte,t1.idproceso,t1.direccion,t2.descripcion AS departamento,t3.descripcion AS municipio,t1.estadodir,t1.motivoinactiva
					  FROM ((radicador_direccion t1 INNER JOIN radicador_pa_departamento t2 ON t1.iddepartamento = t2.Cod_departamento)
                      INNER JOIN radicador_pa_municipio t3 ON t1.idmunicipio = t3.Cod_Municipio)
                      WHERE idparte = '$idparte' AND idproceso = '$idprocesox'
                      ORDER BY t1.id DESC";
					  
		}
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				$d1 = $fila[idparte];
				$d2 = $fila[idproceso];
				$d3 = $fila[direccion];
				$d4 = $fila[departamento];
				$d5 = $fila[municipio];
				$d6 = $fila[estadodir];
				$d7 = $fila[motivoinactiva];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."*/-*/-";
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_datos_direccion($iddir,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){
			
			$query = "SELECT t1.id,t1.idparte,t1.idproceso,t1.telefono,t1.direccion,t1.iddepartamento,t1.idmunicipio
					  FROM radicador_direccion t1
                      WHERE t1.id = '$iddir'";
					  
		}
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				
				$d1 = $fila[idparte];
				$d2 = $fila[idproceso];
				
				$d3 = $fila[direccion];
				$d4 = $fila[iddepartamento];
				$d5 = $fila[idmunicipio];
				$d6 = $fila[telefono];
				
				
			
				$DATOC .= $d0."******".$d1."******".$d2."******".$d3."******".$d4."******".$d5."******".$d6;
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	
	function get_datos_documento($iddoc,$idsql){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//$query = "SELECT * FROM radicador_correspondencia_v1 WHERE idradicado = '$idprocesox'";
		
		if($idsql == 1){

			
			$query = "SELECT * FROM documentos_internos WHERE id = '$iddoc'";
					  
		}
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			if($idsql == 1){
			
				$d0 = $fila[id];
				
				$d1 = $fila[idparte];
				$d2 = $fila[idradicado];
				
				$d3 = $fila[idcitador];
				$d4 = $fila[iddireccion];
				$d5 = $fila[direccion];
				$d6 = $fila[ciudad];
				$d7 = $fila[partes];
				
				$DATOC .= $d0."*/-*/-".$d1."*/-*/-".$d2."*/-*/-".$d3."*/-*/-".$d4."*/-*/-".$d5."*/-*/-".$d6."*/-*/-".$d7;
				
			}
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_dir_fiscalia($idfis){
	
		
		$link = db_connect($dbdefault_dbname);
	
			
		$query = "SELECT * FROM rg_pa_fiscalias WHERE id = '$idfis'";
					  
	  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
				$d0 = $fila[direccion];
		

				$DATOC = $d0;
							

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_idradicado_2($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM radicador_proceso WHERE radicado = '$id'";
				  
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
	
	function get_idradicado_X($valorradicado){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM ubicacion_expediente WHERE radicado = '$valorradicado'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			$DATO = $row[id];
			return $DATO;
		}
		
		mysql_close($link);
		
	}
	
	function Existe_Radicado_SJ($valorradicado){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM ubicacion_expediente 
		          WHERE radicado = '$valorradicado'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return 0;
		}
		else{
		
			return 1;
		}
		
		mysql_close($link);
		
	}
	
	//******************************CONEXIONES A JUSCIA XXI*********************************************
	
	//INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
	function get_datos_basededatos($idbd){
  
  
		$link = db_connect($dbdefault_dbname);
	
		$query = "SELECT * FROM pa_base_datos WHERE id = ".$idbd;
					    
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		

			$d0 = $fila[ip];
			$d1 = $fila[bd];
			$d2 = $fila[usuario];
			$d3 = $fila[clave];
			
			$DATOC .= $d0."*/-*/-".$d1."*/-*/-".$d2."*/-*/-".$d3;
				
		
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
		
		
  	}
	
	
	function get_datos_PONENTE_SJ(){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT * FROM radicador_pa_juzgado";
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSP .= $row[idjxxi]."******".$row[des]."******".$row[id_corporacion]."******".$row[id_especialidad]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSP;
	

	}
	
	//FUNCION PARA EL CAMBIO DE PONENTE
	function get_datos_PONENTE(){
	
		$cadena_ponentes;
	
		$modelo = new Funciones();
  
  		$error_transaccionX = 0;
		
  		$datosbd   = $modelo->get_datos_basededatos(3);
		
		$datosbd_b = explode("*/-*/-",$datosbd);
		
		
		//$datosbd_b = $datosbd->fetch();
		$datosbd_1 = $datosbd_b[0];
		$datosbd_2 = $datosbd_b[1];
		$datosbd_3 = $datosbd_b[2];
		$datosbd_4 = $datosbd_b[3];
			
		$serverNameX = $datosbd_1; //serverName\instanceName
		$connectionInfoX = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
		$connX = sqlsrv_connect( $serverNameX, $connectionInfoX);
		
		
		if( $connX === false ) {
			
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
			
			echo "ENTRE 1 (T101DAINFOPONE)";
			
		}
		
		//Iniciar la transacción.
		if ( sqlsrv_begin_transaction( $connX ) === false ) {
			 
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
			 
			echo "ENTRE 2 (T101DAINFOPONE)";
			 
		}
		

		$sqlX = ("	
			
			
					 SELECT 
					   [A101CODIPONE]
					  ,[A101NOMBPONE]
					  ,[A101NUMEDOCU]
					  ,[A101CODIDOCU]
					  ,[A101CODICIUE]
					  ,[A101CODICIUD]
					  ,[A101CODIENTI]
					  ,[A101CODIESPE]
					  ,[A101CODINUME]
					  ,[A101CODIAREA]
					  ,[A101FLAGHABI]
					  ,[A101SECRDESP]
					  ,[A101APRUREPA]
				  FROM [$datosbd_2].[dbo].[T101DAINFOPONE]
				  WHERE [A101CODIPONE] IN (0911,0921,0931,
				  4011,4021,4031,4041,4051,4061,4071,7011,
				  7021,8811,8821,8831,8841,8851,8861,8871,8881,5001);
							
		");
			
		$paramsX  = array();
		$optionsX =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmtX    = sqlsrv_query( $connX, $sqlX , $paramsX, $optionsX );
			
			
		if( $stmtX === false ) {
			
			$error_transaccionX = 1;
			
			if( ($errors = sqlsrv_errors() ) != null) {
				
				foreach( $errors as $error ) {
					
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
				
			echo "ENTRE 3 (T101DAINFOPONE)";
				
		}
		else{

			$row_count   = sqlsrv_num_rows( $stmtX );
			
			while( $row = sqlsrv_fetch_array( $stmtX ) ){
			
			
				$A101CODIPONE = $row['A101CODIPONE'];
				$A101NOMBPONE = $row['A101NOMBPONE'];
				
				$A101CODIENTI = $row['A101CODIENTI'];
				$A101CODIESPE = $row['A101CODIESPE'];
				$A101CODINUME = $row['A101CODINUME'];
				
				$cadena_ponentes .= $A101CODIPONE."******".$A101NOMBPONE."******".$A101CODIENTI."******".$A101CODIESPE."******".$A101CODINUME."*/-*/-";
				
			}
			
			return $cadena_ponentes;
			
			
			
		}	
		
		
  	}
	
	function Existe_Radicado($valorradicado){
	
	
		$modelo = new Funciones();
  
  		$error_transaccionX = 0;
		
  		$datosbd   = $modelo->get_datos_basededatos(5);
		
		$datosbd_b = explode("*/-*/-",$datosbd);
		
		
		//$datosbd_b = $datosbd->fetch();
		$datosbd_1 = $datosbd_b[0];
		$datosbd_2 = $datosbd_b[1];
		$datosbd_3 = $datosbd_b[2];
		$datosbd_4 = $datosbd_b[3];
			
		$serverNameX = $datosbd_1; //serverName\instanceName
		$connectionInfoX = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
		$connX = sqlsrv_connect( $serverNameX, $connectionInfoX);
		
		
		if( $connX === false ) {
			
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
			
			echo "ENTRE 1 (T103DAINFOPROC)";
			
		}
		
		//Iniciar la transacción.
		if ( sqlsrv_begin_transaction( $connX ) === false ) {
			 
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
			 
			echo "ENTRE 2 (T103DAINFOPROC)";
			 
		}
		

		$sqlX = ("	
			
			
					  SELECT t103.A103LLAVPROC
					  FROM [$datosbd_2].[dbo].[T103DAINFOPROC] t103 
					  WHERE t103.A103LLAVPROC IN('$valorradicado');
							
		");
			
		$paramsX  = array();
		$optionsX =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmtX    = sqlsrv_query( $connX, $sqlX , $paramsX, $optionsX );
			
			
		if( $stmtX === false ) {
			
			$error_transaccionX = 1;
			
			if( ($errors = sqlsrv_errors() ) != null) {
				
				foreach( $errors as $error ) {
					
					echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";
				}
			}
				
			echo "ENTRE 3 (T103DAINFOPROC)";
				
		}
		else{
			
			$row_count = sqlsrv_num_rows( $stmtX );
			
			//NO EXISTE
			
			if ($row_count == 0){
   		
				sqlsrv_free_stmt( $stmtX);
				sqlsrv_close( $connX );
				
				return 0;
				
				
				
				
			}
			//EXISTE
 			else{
			
				
				sqlsrv_free_stmt( $stmtX);
				sqlsrv_close( $connX );
					
				return 1;
				
				
			}	
			
			
			
		}	
		
		
  	}
	
	function get_observaciones_radicado($id_radicado,$datosusuarioacciones){
	
		
		$link = db_connect($dbdefault_dbname);
	
		$query = "SELECT * FROM detalle_correspondencia 
			      WHERE idcorrespondencia = '$id_radicado'
				  AND idusuario ".$datosusuarioacciones. " 
			      ORDER BY id DESC";
		
		
				  
		$sql = mysql_query($query);
		//$row = mysql_fetch_array($sql);
		
		while($fila = mysql_fetch_array($sql)){
		
			
			
				$d0 = $fila[id];
				$d1 = $fila[fecha];
				$d2 = $fila[observacion];
				
			
				$DATOC .= $d0."------".$d1."------".$d2."*/-*/-";
				
			

		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$link  = db_connect($dbdefault_dbname);
	
		$query = "SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar;
		
		$sql   = mysql_query($query);
		$fila  = mysql_fetch_array($sql);
		
		$Ud0 = $fila[usuario];
	
  		mysql_free_result($sql);
		mysql_close($link);
		
		return $Ud0;
	
	}
	
	
	function get_item_costas(){
	
	
		$link  = db_connect($dbdefault_dbname);
	  
		$query = "SELECT * FROM item";
				  
		$sql   = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
				$d1  = $fila[idarticulo];
				$d2  = $fila[referencia];
				$d3  = $fila[nomarticulo];
				$d4  = $fila[desarticulo];
			
				$DATOC .= $d1."------".$d2."------".$d3."------".$d4."*/-*/-";
				
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_liquidaciones_costas($valor_id){
	
	
		$link  = db_connect($dbdefault_dbname);
	  
		$query = "SELECT * FROM liquidacion_costas 
		          WHERE idradicado = '$valor_id'
				  ORDER BY id DESC";
				  
		$sql   = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
				$d1  = $fila[nunentrada];
				$d2  = $fila[fechae];
				$d3  = $fila[horae];
				$d4  = $fila[estadoe]." ".$fila[notae];
				$d5  = $fila[nuevo];
				$d6  = $fila[liquidacioncredito];
				
			
				$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."*/-*/-";
				
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_lista_estudios($id_hv,$tipo_soporte){
	
	
		$link  = db_connect($dbdefault_dbname);
	  
		$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
		          t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t1.tipo_soporte,
				  t1.nunresolucion,t1.idmotivo,t4.des AS motivo,t1.fechaad
				  FROM (((hv_central t1
                  LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
                  LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
				  LEFT JOIN hv_motivo t4 ON t1.idmotivo = t4.id) 
		          WHERE t1.idservidor = '$id_hv' AND tipo_soporte = '$tipo_soporte' 
				  ORDER BY t1.id";
				  
		$sql   = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
				$d1  = $fila[id];
				$d2  = $fila[modalidad];
				$d3  = $fila[tipomodalidad];
				$d4  = $fila[institucion];
				
				$d5  = $fila[idmodalidad];
				$d6  = $fila[idtipomodalidad];
				
				$d7  = $fila[direccion];
				$d8  = $fila[telefono];
				$d9  = $fila[periodo];
				$d10 = $fila[cargo];
				
				$d11 = $fila[tipo_soporte];
				
				$d12 = $fila[nunresolucion];
				$d13 = $fila[idmotivo];
				$d14 = $fila[motivo];
				$d15 = $fila[fechaad];
				
		
				$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11.
				          "------".$d12."------".$d13."------".$d14."------".$d15."*/-*/-";
				
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return utf8_encode($DATOC);
		
	}
	
	function get_lista_referencia($id_hv){
	
	
		$link  = db_connect($dbdefault_dbname);
	  
		$query = "SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,
		          t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t1.tipo_soporte
				  FROM ((hv_central t1
                  LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
                  LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		          WHERE t1.idservidor = '$id_hv' 
				  AND (tipo_soporte = 'LABORAL' OR tipo_soporte = 'PERSONAL')
				  ORDER BY t1.id";
				  
		$sql   = mysql_query($query);
		
		
		while($fila = mysql_fetch_array($sql)){
		
				$d1  = $fila[id];
				$d2  = $fila[modalidad];
				$d3  = $fila[tipomodalidad];
				$d4  = $fila[institucion];
				
				$d5  = $fila[idmodalidad];
				$d6  = $fila[idtipomodalidad];
				
				$d7  = $fila[direccion];
				$d8  = $fila[telefono];
				$d9  = $fila[periodo];
				$d10 = $fila[cargo];
				
				$d11 = $fila[tipo_soporte];
				
		
				$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."*/-*/-";
				
		}
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return utf8_encode($DATOC);
		
	}
	
	
	function get_lista_certificados($id_certificado,$id_certificado_doc){
	
	
		$link  = db_connect($dbdefault_dbname);
	  
	  	//ESTUDIOS
	  	if($id_certificado_doc == "E"){
		
			$query = " SELECT t4.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,t1.institucion,
						t4.ruta
						FROM (((hv_central t1
						LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
						LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id)
						LEFT JOIN hv_rutas_archivos t4 ON t1.id = t4.id_archivo_central)
						WHERE t4.id_archivo_central = '$id_certificado' AND t1.tipo_soporte = '$id_certificado_doc'
						AND t4.ruta LIKE '%SOPORTES_ESTUDIOS%'
						ORDER BY t1.id ";
					  
			$sql   = mysql_query($query);
			
			
			while($fila = mysql_fetch_array($sql)){
			
					$d1  = $fila[id];
					$d2  = $fila[modalidad];
					$d3  = $fila[tipomodalidad];
					$d4  = $fila[institucion];
					
					$d5  = $fila[idmodalidad];
					$d6  = $fila[idtipomodalidad];
					
					$d7  = $fila[direccion];
					$d8  = $fila[telefono];
					$d9  = $fila[periodo];
					$d10 = $fila[cargo];
					
					$d11 = $fila[tipo_soporte];
					
					$d12 = $fila[ruta];
					
			
					$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."------".$d9."------".$d10."------".$d11."------".$d12."*/-*/-";
					
			}
			
			
		}
		
		//EXPERIENCIA LABORAL
		if($id_certificado_doc == "L"){
		
			$query = "  SELECT t4.id,t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t4.ruta
						FROM (hv_central t1
						LEFT JOIN hv_rutas_archivos t4 ON t1.id = t4.id_archivo_central)
						WHERE t4.id_archivo_central = '$id_certificado' AND t1.tipo_soporte = '$id_certificado_doc'
						AND t4.ruta LIKE '%SOPORTES_EXPERIENCIA_LABORAL%'
						ORDER BY t1.id ";
					  
			$sql   = mysql_query($query);
			
			
			while($fila = mysql_fetch_array($sql)){
			
					$d1  = $fila[id];
					$d2  = $fila[institucion];
					$d3  = $fila[direccion];
					$d4  = $fila[telefono];
					$d5  = $fila[periodo];
					$d6 = $fila[cargo];
					
					$d7 = $fila[tipo_soporte];
					
					$d8 = $fila[ruta];
					
			
					$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."------".$d6."------".$d7."------".$d8."*/-*/-";
					
			}
			
			
		}
		
		
		//ACTO ADMINISTRATIVO
		if($id_certificado_doc == "AD"){
		
			$query = "  SELECT t4.id,t1.institucion,t1.direccion,t1.telefono,t1.periodo,t1.cargo,t4.ruta,
						t1.nunresolucion,t1.idmotivo,t5.des AS motivo,t1.fechaad
						FROM ((hv_central t1
						LEFT JOIN hv_rutas_archivos t4 ON t1.id = t4.id_archivo_central)
						LEFT JOIN hv_motivo t5 ON t1.idmotivo = t5.id) 
						WHERE t4.id_archivo_central = '$id_certificado' AND t1.tipo_soporte = '$id_certificado_doc'
						AND t4.ruta LIKE '%ACTOS_ADMINISTRATIVOS%'
						ORDER BY t1.id ";
					  
			$sql   = mysql_query($query);
			
			
			while($fila = mysql_fetch_array($sql)){
			
					$d1  = $fila[id];
					$d2  = $fila[nunresolucion];
					$d3  = $fila[motivo];
					$d4  = $fila[fechaad];
					$d5  = $fila[ruta];
					
				
					$DATOC .= $d1."------".$d2."------".$d3."------".$d4."------".$d5."*/-*/-";
					
			}
			
			
		}	
		

		mysql_free_result($sql);
		mysql_close($link);
		
		return $DATOC;
		
	}
	
	function get_datos_REMATES_ACTIVOS(){
	
			
			$link = db_connect($dbdefault_dbname);
		
			
			
		   $query = "	SELECT t1.id,t3.nombre_tipo_documento,t2.radicado,t1.fecharemate,t4.empleado,t2.id AS idrad,t1.realizarremate,
		                t1.visualizarremate,t2.idjuzgado_reparto 
			            FROM (((documentos_internos t1
						INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						INNER JOIN pa_tipodocumento t3 ON t1.idtipodocumento = t3.id)
						INNER JOIN pa_usuario t4 ON t1.idusuario = t4.id)
						WHERE t1.idtipodocumento IN(20,35,36,86,87,88,89,90,91,92,93,94) AND t1.visualizarremate = 0
						ORDER BY t1.fecharemate	";
			
			/*$query = "	SELECT t1.id,t3.nombre_tipo_documento,t2.radicado,t1.fecharemate,t4.empleado,t2.id AS idrad,t1.realizarremate,t1.visualizarremate 
			            FROM (((documentos_internos t1
						INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						INNER JOIN pa_tipodocumento t3 ON t1.idtipodocumento = t3.id)
						INNER JOIN pa_usuario t4 ON t1.idusuario = t4.id)
						WHERE t1.idtipodocumento IN(20,35,36) 
						ORDER BY t1.id DESC
						LIMIT 10";*/			
						
			
			
						
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[radicado]."******".$row[nombre_tipo_documento]."******".$row[fecharemate]."******".$row[empleado]."******".$row[idrad]."******".
				               $row[realizarremate]."******".$row[visualizarremate]."******".$row[idjuzgado_reparto]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}


	
	function get_datos_REMATES_ACTIVOS_FILTRO($dato_1,$dato_2,$datox1,$datox2,$datox3,$datox4){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
			
			$fechad    = trim($dato_1);
			$fechah    = trim($dato_2);
			
			
			$datox1    = trim($datox1);
			$datox2    = trim($datox2);
			$datox3    = trim($datox3);
			$datox4    = trim($datox4);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecharemate) >= '$fechad' AND DATE(t1.fecharemate) <= '$fechah') ";
				
			
			}
			
			
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t2.radicado LIKE '%$datox2%' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				
				$filtro3 = " AND t1.realizarremate = '$datox3' ";
				
	
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t2.idjuzgado_reparto = '$datox4' ";
				
	
			}
			
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;
				
			//echo $filtrox;
			
			
			
			$query = "	SELECT t1.id,t3.nombre_tipo_documento,t2.radicado,t1.fecharemate,t4.empleado,t2.id AS idrad,t1.realizarremate,
			            t1.visualizarremate,t2.idjuzgado_reparto 
			            FROM (((documentos_internos t1
						INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						INNER JOIN pa_tipodocumento t3 ON t1.idtipodocumento = t3.id)
						INNER JOIN pa_usuario t4 ON t1.idusuario = t4.id)
						WHERE t1.id >= '1' AND t1.idtipodocumento IN(20,35,36,86,87,88,89,90,91,92,93,94)" .$filtrox. "
						ORDER BY t1.id	";
			
					  
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[radicado]."******".$row[nombre_tipo_documento]."******".$row[fecharemate]."******".$row[empleado]."******".$row[idrad]."******".
				               $row[realizarremate]."******".$row[visualizarremate]."******".$row[idjuzgado_reparto]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	
	

	public function get_fecha_actual_amd(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
	}
	
	public function get_fecha_actual(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:i A');
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
  	}
	
	public function get_maximo_obs_proceso($idrad){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$query = "SELECT MAX(id + 1) as maximo
					  FROM detalle_correspondencia
                      WHERE idcorrespondencia = '$idrad'";
		
			$sql    = mysql_query($query);
			$row    = mysql_fetch_array($sql);
			$maximo = $row[maximo];
			
			
			mysql_close($link);
			
			return $maximo;
	

	}
	
	public function gc_get_lista($id_lista){
	
			
			//$link = db_connect($dbdefault_dbname);
			
			//------------DATOS PARA LA CONEXION BD------------
			$dbhost           ='localhost';
			$dbusername       ='root';
			$dbuserpassword   ='Ejecuc10n2014';
			$dbdefault_dbname ='ejecucion';
			
			$link = mysql_connect($dbhost, $dbusername, $dbuserpassword);
			
			if(!$link){
				echo "Fallo en la Conexión al host $dbhost";
				//return 0;
			}
			else if(empty($dbname) && !mysql_select_db($dbdefault_dbname)){
				echo "Fallo en la Conexión al host $dbhost";
				//return 0;
			}
			
			$query = "SELECT * FROM gc_lista 
			          WHERE idtipo = '$id_lista'";
			
			
			$resultado = mysql_query($query);
	
			while($fila = mysql_fetch_array($resultado)){
			
				$datos0  = $fila["id"];
				$datos1  = $fila["des"];
				

				$cadena .= $datos0."//////".$datos1."******";
			
				//$arreglo["data"][]=$fila; 
				 
				
			}
		
			return $cadena;
			//pasamos los datos json
			//return json_encode($arreglo);
		
			//libero resultado
			mysql_free_result($resultado);
			//cierro conexion a la db
			mysql_close($link);
	

	}
		
	
	
	function get_datos_ACTIVIDADES($id_accion){
	
			
			$link = db_connect($dbdefault_dbname);
		
			
			
			$query = "SELECT t1.id,t1.idaccion,t1.fecha_inicial,t1.fecha_final,t1.des,t2.empleado,
					  t1.fecha_registro,t1.hora_registro,t1.estado,t1.gestion,t1.rutaarchivo,t1.fecha_gestion,t1.hora_gestion 
			          FROM (gc_actividad t1 
					  INNER JOIN pa_usuario t2 ON t1.idrespobsable = t2.id)
					  WHERE t1.idaccion = '$id_accion'
					  ORDER BY t1.fecha_inicial,t1.fecha_final";
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			//idaccion,fecha_inicial,fecha_final,des,idrespobsable,fecha_registro,hora_registro,usuario_registro
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[idaccion]."******".$row[fecha_inicial]."******".$row[fecha_final]."******".
				               $row[des]."******".$row[empleado]."******".$row[fecha_registro]."******".$row[hora_registro]."******".
							   $row[estado]."******".$row[gestion]."******".$row[rutaarchivo]."******".$row[fecha_gestion]."******".$row[hora_gestion]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	
	public function get_datos_ACCION($id_accion){
	
			
	
			$link = db_connect($dbdefault_dbname);
		
		
			
			$query = "	
						SELECT t1.id,t2.des AS clase,t3.des AS numeral,t1.descripcion,t1.analisis_causas,
						t4.des AS procesoresponsable,/*t5.des AS procesoafectado*/t1.id_ai,t6.des AS metodologia,t7.des AS generada,
						t1.fecha_registro,t1.hora_registro,t1.estado
						FROM (((((gc_acciones t1
						LEFT JOIN gc_lista t2 ON t1.id_clase = t2.id)
						LEFT JOIN gc_lista t3 ON t1.id_numeral_norma = t3.id)
						LEFT JOIN gc_lista t4 ON t1.id_pr = t4.id)
						/*LEFT JOIN gc_lista t5 ON t1.id_ai = t5.id)*/
						LEFT JOIN gc_lista t6 ON t1.id_metodologia = t6.id)
						LEFT JOIN gc_lista t7 ON t1.id_generada = t7.id)
						WHERE t1.id = '$id_accion'
											
					";
					
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[clase]."******".$row[numeral]."******".$row[descripcion]."******".
				               $row[analisis_causas]."******".$row[procesoresponsable]."******".$row[id_ai]."******".$row[metodologia]."******".
							   $row[generada]."******".$row[fecha_registro]."******".$row[hora_registro]."******".$row[estado]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	
  	}
	
	function get_datos_REVISION($id_accion){
	
			
			$link = db_connect($dbdefault_dbname);
		
			
			
			$query = "SELECT t1.id,t2.descripcion,t3.des,t1.sino,t1.observacion,
					  t1.fecha_registro,t1.hora_registro
					  FROM ((gc_revision_detalle t1
					  LEFT JOIN gc_acciones t2 ON t1.idaccion = t2.id)
					  LEFT JOIN gc_revision t3 ON t1.idpregunta = t3.id)
					  WHERE t1.idaccion = '$id_accion'";
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			//idaccion,fecha_inicial,fecha_final,des,idrespobsable,fecha_registro,hora_registro,usuario_registro
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[descripcion]."******".$row[des]."******".$row[sino]."******".
				               $row[observacion]."******".$row[fecha_registro]."******".$row[hora_registro]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	function get_datos_AUDIENCIAS(){
	
			
		   $link = db_connect($dbdefault_dbname);
		
			
			
		   $query = "SELECT t1.id,t1.fecharegistro,t1.fechaaudi,t1.horaaudi,t2.radicado,t1.obsaudi,t2.idjuzgado_reparto,t1.realizada
					 FROM (siepro_audiencia t1
					 INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
					 ORDER BY t1.id DESC
					 LIMIT 10";
			
						
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOS_AUDI .= $row[id]."******".$row[fecharegistro]."******".$row[horaaudi]."******".$row[radicado]."******".$row[idjuzgado_reparto]."******".$row[obsaudi]."******".
				               $row[realizada]."******".$row[fechaaudi]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOS_AUDI;
	

	}


	
	function get_datos_AUDIENCIAS_FILTRO($dato_1,$dato_2,$dato_3,$dato_4,$datox1,$datox2,$datox3,$datox4){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$filtrox;
			
			$filtrof;
			$filtro2f;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
			
			$fechad    = trim($dato_1);
			$fechah    = trim($dato_2);
			
			$fecha2d   = trim($dato_3);
			$fecha2h   = trim($dato_4);
			
			
			$datox1    = trim($datox1);
			$datox2    = trim($datox2);
			$datox3    = trim($datox3);
			$datox4    = trim($datox4);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecharegistro) >= '$fechad' AND DATE(t1.fecharegistro) <= '$fechah') ";
				
			
			}
			
			if ( !empty($fecha2d) && !empty($fecha2h) ) {
			
				
				$filtro2f = " AND ( DATE(t1.fechaaudi) >= '$fecha2d' AND DATE(t1.fechaaudi) <= '$fecha2h') ";
				
			
			}
			
			
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t2.radicado LIKE '%$datox2%' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				
				$filtro3 = " AND t1.realizada = '$datox3' ";
				
	
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t2.idjuzgado_reparto = '$datox4' ";
				
	
			}
			
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof." ".$filtro2f;
				
			//echo $filtrox;
			
			
			 $query = "SELECT t1.id,t1.fecharegistro,t1.fechaaudi,t1.horaaudi,t2.radicado,t1.obsaudi,t2.idjuzgado_reparto,t1.realizada
					   FROM (siepro_audiencia t1
					   INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
					   WHERE t1.id >= '1' " .$filtrox. "
					   ORDER BY t1.id DESC";
					 
			
			
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOS_AUDI .= $row[id]."******".$row[fecharegistro]."******".$row[horaaudi]."******".$row[radicado]."******".$row[idjuzgado_reparto]."******".$row[obsaudi]."******".
				               $row[realizada]."******".$row[fechaaudi]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOS_AUDI;
	

	}
	
	
	
	//********************************************************************************************
						//PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
						//ADICIONADO EL 10 DE JULIO 2019
	//********************************************************************************************
	
	function get_datos_SOLICITUDES($id_filtro){
	
			
			$link = db_connect($dbdefault_dbname);
		
			
			if($id_filtro >= 1){
			
				$query = "SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
			          	  FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
						  WHERE t2.id = '$id_filtro'
						  ORDER BY t1.id DESC";
			
			}
			else{
			
				$query = "SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
			          	  FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
						  ORDER BY t1.id DESC";
			}
					  
			
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			//idaccion,fecha_inicial,fecha_final,des,idrespobsable,fecha_registro,hora_registro,usuario_registro
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[fecha]."******".$row[hora]."******".$row[des]."******".
				               $row[empleado]."******".$row[fecha_respuesta]."******".$row[hora_respuesta]."******".$row[respuesta]."******".
							   $row[estado]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	function get_datos_SOLICITUDES_FILTRO($id_filtro,$datox1,$datox2,$datox3,$datox4,$datox5,$datox6,$datox7,$datox8){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro4;
			$filtro56;
			$filtro7;
			$filtro8;
			
			
			$fechad    = trim($datox2);
			$fechah    = trim($datox3);
			
			$datox1    = trim($datox1);
			$datox4    = trim($datox4);
			
			$datox5    = trim($datox5);
			$datox6    = trim($datox6);
			
			$datox7    = trim($datox7);
			$datox8    = trim($datox8);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox5) && !empty($datox6) ) {
			
				
				$filtro56 = " AND ( DATE(t1.fecha_respuesta) >= '$datox5' AND DATE(t1.fecha_respuesta) <= '$datox6') ";
				
			
			}
			
			
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox7) ) {
			
				
				
				$filtro7 = " AND t1.iduser = '$datox7' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}
			
			
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.des LIKE '%$datox4%' ";
				
	
			}
			
			
			
			$filtrox = $filtro1." ".$filtro4." ".$filtro56." ".$filtro7." ".$filtro8." ".$filtrof;
				
			//echo $filtrox;
			
			if($id_filtro >= 1){
			
				$query = "	SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
							FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
							WHERE t1.id >= '1' AND t2.id = '$id_filtro' " .$filtrox. "
							ORDER BY t1.id	DESC";
			
			}
			else{
			
				$query = "	SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
							FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
							WHERE t1.id >= '1' " .$filtrox. "
							ORDER BY t1.id	DESC";
			}
			
			
			//echo $query; 		  
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[fecha]."******".$row[hora]."******".$row[des]."******".
				               $row[empleado]."******".$row[fecha_respuesta]."******".$row[hora_respuesta]."******".$row[respuesta]."******".
							   $row[estado]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	//********************************************************************************************
						
						//FIN PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
						
	//********************************************************************************************
	
	
	
	
	
	
	
	//********************************************************************************************
						//PARA EL MANEJO PROGRAMADOR AUDIENCIAS
						//ADICIONADO EL 6 DE AGOSTO 2019
	//********************************************************************************************
	
	function get_datos_JUZAUDIENCIAS($id_filtro_u,$id_juzgado){
	
			
			$link = db_connect($dbdefault_dbname);
		
			//EL USUARIO EN SESION VISUALIZA SOLO
			//LAS AUDIENCIAS DEL JUZGADO AL QUE EL PERTENECE
			if($id_filtro_u >= 1){
			
				
				
				$query = "SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
						  t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg,
						  t5.id AS idtipoaudi,t5.des AS destipo,t5.numactu
						  FROM ((((siepro_audiencia_juzgado t1
						  INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						  INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
						  LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
						  LEFT JOIN siepro_tipo_audi t5 ON t1.tipo_audi = t5.id)
						  WHERE t1.id_juzgado = '$id_juzgado'
						  ORDER BY t1.id DESC
						  LIMIT 10";
						  
			
			}
			//EL USUARIO EN SESION VISUALIZA TODAS LAS AUDIENCIAS
			else{
			
				
				
				$query = "SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
						  t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg,
						  t5.id AS idtipoaudi,t5.des AS destipo,t5.numactu
						  FROM ((((siepro_audiencia_juzgado t1
						  INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						  INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
						  LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
						  LEFT JOIN siepro_tipo_audi t5 ON t1.tipo_audi = t5.id)
						  ORDER BY t1.id DESC
						  LIMIT 10";
						  
			}
					  
			
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			//idaccion,fecha_inicial,fecha_final,des,idrespobsable,fecha_registro,hora_registro,usuario_registro
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[radicado]."******".$row[fecha]."******".$row[hora_ini]."******".$row[hora_fini]."******".$row[des]."******".
				               $row[estado]."******".$row[causal]."******".$row[fecha_reg]."******".$row[numactu]."-".$row[destipo]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	function get_datos_JUZAUDIENCIAS_FILTRO($id_filtro_u,$id_juzgado,$datox1,$datox2,$datox3,$datox4,$datox5,$datox6){
	
			
			$link = db_connect($dbdefault_dbname);
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro5;
			$filtro6;
			
			
			$fechad    = trim($datox3);
			$fechah    = trim($datox4);
			
			$datox1    = trim($datox1);
			$datox2    = trim($datox2);
			
			$datox5    = trim($datox5);
			$datox6    = trim($datox6);
			
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				//$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t2.radicado = '$datox2' ";
				
	
			}
			
			
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.id_juzgado = '$datox5' ";
				
	
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.estado = '$datox6' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			/*if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}*/
			
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro5." ".$filtro6." ".$filtrof;
				
			//echo $filtrox;
			
			//EL USUARIO EN SESION VISUALIZA SOLO
			//LAS AUDIENCIAS DEL JUZGADO AL QUE EL PERTENECE
			if($id_filtro_u >= 1){
			
				$query = "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
						  	t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg,
							t5.id AS idtipoaudi,t5.des AS destipo,t5.numactu
						  	FROM ((((siepro_audiencia_juzgado t1
						  	INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						  	INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
						  	LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
							LEFT JOIN siepro_tipo_audi t5 ON t1.tipo_audi = t5.id)
							WHERE t1.id >= '1' AND t1.id_juzgado = '$id_juzgado' " .$filtrox. "
							ORDER BY t1.id	";
			
			}
			else{
			
				$query = "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
						  	t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg,
							t5.id AS idtipoaudi,t5.des AS destipo,t5.numactu
						  	FROM ((((siepro_audiencia_juzgado t1
						  	INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						  	INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
						  	LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
							LEFT JOIN siepro_tipo_audi t5 ON t1.tipo_audi = t5.id)
							WHERE t1.id >= '1' " .$filtrox. "
							ORDER BY t1.id	";
			}
			
			
			//echo $query; 		  
		
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			while($row = mysql_fetch_array($sql)){
			
				$DATOSOLI .=   $row[id]."******".$row[radicado]."******".$row[fecha]."******".$row[hora_ini]."******".$row[hora_fini]."******".$row[des]."******".
				               $row[estado]."******".$row[causal]."******".$row[fecha_reg]."******".$row[numactu]."-".$row[destipo]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOSOLI;
	

	}
	
	function get_Juzgado($id){
	
		
		$link = db_connect($dbdefault_dbname);
	
	
		$query = "SELECT * FROM pa_juzgado
                  WHERE id = '$id'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
			return;
		}
		else{
		
			//$DATO = $row[nombre]."//////".$row[nombre];
			$DATO = $row[nombre];
			return $DATO;
		}
		mysql_close($link);
		
	}
	
	
	function Cantidad_Horas_Audiencia($idaudiencia){
	
		
		$link = db_connect($dbdefault_dbname);
	
		//SE REALIZA EL CAMBIO EN LA SQL, PARA QUE SE SUMEN TAMBIEN LAS HORAS DEL MEDIO DIA
		$query = "SELECT SEC_TO_TIME(

										 SUM(

											 TIME_TO_SEC(


								
								

											   /*TIMEDIFF(hora_final,hora_inicio)*/

								
												 CASE

													WHEN
								
													  /*(hora_ini >= '07:00' AND hora_ini <= '12:00') AND (hora_fini >= '14:00' AND hora_fini <= '23:00')*/
													  
													  (hora_ini >= '07:00' AND hora_ini <= '23:00') 
								
													  THEN
								
														/*TIMEDIFF( TIMEDIFF(hora_fini,hora_ini),'2:00')*/
														
														TIMEDIFF( TIMEDIFF(hora_fini,hora_ini),'0:00')

													  ELSE
								
														TIMEDIFF(hora_fini,hora_ini)
								

												END
								
								
											 )
										 )
								
									   )

									   AS cantidadhoras

								FROM siepro_audiencia_juzgado
								WHERE id = '$idaudiencia'";
				  
		$sql = mysql_query($query);
		$row = mysql_fetch_array($sql);
		
		if(!$row){
		
			return;
		}
		else{
		
			//$DATO = $row[nombre]."//////".$row[nombre];
			$cantidadhoras = $row[cantidadhoras];
			return $cantidadhoras;
		}
		
		mysql_close($link);
		
	}
	
	//********************************************************************************************
						
						//FIN PARA EL MANEJO PROGRAMADOR AUDIENCIAS
						
	//********************************************************************************************
	
	
	
	//********************************************************************************************
						//PARA EL MANEJO DE HOJA CONTROL DE ENTREGA DE TITULOS
						//ADICIONADO EL 8 DE MAYO 2020
	//********************************************************************************************
	
	
	
	function get_datos_encabezado_hcet($idhcet){
	
			$nregitros = 0;
			
			$link = db_connect($dbdefault_dbname);
		
			
			$query = "SELECT * FROM hcet_encabezado
					  WHERE idradicado = '$idhcet'";
						  
			
			
			$sql = mysql_query($query);
			
			$nregitros = mysql_num_rows($sql);
			
			//SOLO SE CARGA UN REGISTRO Y NO SE CONCATENA CON MAS, DE LA FORMA ."*/-*/-"
			if($nregitros == 1){
			
				$row = mysql_fetch_array($sql);
			
				$DATOS_HCET .= $row[id]."******".$row[idradicado]."******".$row[capital]."******".$row[ic]."******".$row[im]."******".$row[costas]."******".
							   $row[fecha]."******".$row[hora]."******".$row[idusuario]."******".$row[obs]."******".$row[atp]."******".$row[nregitros]."*/-*/-";
			
			}
		 	else{
			
				while($row = mysql_fetch_array($sql)){
				
					$DATOS_HCET .= $row[id]."******".$row[idradicado]."******".$row[capital]."******".$row[ic]."******".$row[im]."******".$row[costas]."******".
								   $row[fecha]."******".$row[hora]."******".$row[idusuario]."******".$row[obs]."******".$row[atp]."******".$row[nregitros]."*/-*/-";
							   
							   
				}
			
			}
		
			mysql_close($link);
			
			return $DATOS_HCET."//////".$nregitros;
	

	}
	
	
	
	function get_datos_detalle_titulos($idhoja){
	
			
			$link = db_connect($dbdefault_dbname);
		
			
			
			$query = "SELECT * FROM titulos
					  WHERE idhoja = '$idhoja'";
			
					  
			
			$sql = mysql_query($query);
			//$row = mysql_fetch_array($sql);
			
			//idaccion,fecha_inicial,fecha_final,des,idrespobsable,fecha_registro,hora_registro,usuario_registro
			while($row = mysql_fetch_array($sql)){
			
				$DATOS_HCET .= $row[id]."******".$row[fecha]."******".$row[orderpago]."******".$row[valor]."******".
				               $row[fechapago]."******".$row[beneficiario]."*/-*/-";
			}
		
			mysql_close($link);
			
			return $DATOS_HCET;
	

	}
	
	//********************************************************************************************
						//FIN PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
						//ADICIONADO EL 10 DE JULIO 2019
	//********************************************************************************************


//-----------------------------------------------------------------------
}//FIN CLASE
?>
