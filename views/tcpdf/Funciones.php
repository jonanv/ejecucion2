<?php
//session_start();


class Funciones {

	public function numtoletras($xcifra,$id){
	
		//instanciamos la clase Funciones.php con la variable $funcion
		$funcion = new Funciones();
	
	
		$xarray = array(
		      0 => "Cero",
			  1 => "UNO", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
			       "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", 
				   "DIECIOCHO", "DIECINUEVE","VEINTI",
			 30 => "TREINTA", 
			 40 => "CUARENTA", 
			 50 => "CINCUENTA", 
			 60 => "SESENTA", 
			 70 => "SETENTA", 
			 80 => "OCHENTA", 
			 90 => "NOVENTA",
			100 => "CIENTO", 
			200 => "DOSCIENTOS", 
			300 => "TRESCIENTOS", 
			400 => "CUATROCIENTOS", 
			500 => "QUINIENTOS", 
			600 => "SEISCIENTOS", 
			700 => "SETECIENTOS", 
			800 => "OCHOCIENTOS", 
			900 => "NOVECIENTOS"
		);
	//
		$xcifra     = trim($xcifra);
		$xlength    = strlen($xcifra);
		$xpos_punto = strpos($xcifra, ".");
		$xaux_int   = $xcifra;
		$xdecimales = "00";
		if (!($xpos_punto === false)) {
			if ($xpos_punto == 0) {
				$xcifra = "0" . $xcifra;
				$xpos_punto = strpos($xcifra, ".");
			}
			$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
			$xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		}

		$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
		$xcadena = "";
		for ($xz = 0; $xz < 3; $xz++) {
			$xaux = substr($XAUX, $xz * 6, 6);
			$xi = 0;
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
					break; // termina el ciclo
				}

				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = $funcion->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma lógica que las centenas)
							if (substr($xaux, 1, 2) < 10) {
								
							} else {
								$key = (int) substr($xaux, 1, 2);
								if (TRUE === array_key_exists($key, $xarray)) {
									$xseek = $xarray[$key];
									$xsub = $funcion->subfijo($xaux);
									if (substr($xaux, 1, 2) == 20)
										$xcadena = " " . $xcadena . " VEINTE " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3;
								}
								else {
									$key = (int) substr($xaux, 1, 1) * 10;
									$xseek = $xarray[$key];
									if (20 == substr($xaux, 1, 1) * 10)
										$xcadena = " " . $xcadena . " " . $xseek;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 1, 2) < 10)
							break;
						case 3: // checa las unidades
							if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
								
							} else {
								$key = (int) substr($xaux, 2, 1);
								$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
								$xsub = $funcion->subfijo($xaux);
								$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
							} // ENDIF (substr($xaux, 2, 1) < 1)
							break;
					} // END SWITCH
				} // END FOR
				$xi = $xi + 3;
			} // ENDDO

			if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
				$xcadena.= " DE";

			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
				$xcadena.= " DE";

			// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
			if (trim($xaux) != "") {
				switch ($xz) {
					case 0:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN BILLON ";
						else
							$xcadena.= " BILLONES ";
						break;
					case 1:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN MILLON ";
						else
							$xcadena.= " MILLONES ";
						break;
					case 2:
						if ($xcifra < 1) {
							
							//$xcadena = "CERO PESOS $xdecimales/100 M.N.";
							
							$xcadena = "CERO";
						}
						if ($xcifra >= 1 && $xcifra < 2) {
							
							//$xcadena = "UN PESO $xdecimales/100 M.N. ";
							
							$xcadena = "PRIMERO";
						}
						if ($xcifra >= 2) {
							
							//$xcadena.= " PESOS $xdecimales/100 M.N. "; //
							
							//SE ADAPTA ESTA PARTE PARA CONVERTIR LOS CENTAVOS TAMBIEN EN LETRAS
							//Y DEJANDO SOLO EL VALOR EN LETRA DE LOS CENTAVOS POR ESO EL USO DE 
							//LA FUNCION EXPLODE, CAMBIO REALIZADO EL 5 DE MAYO 2017 POR JORGE ANDRES VALENCIA OROZCO
							
							//CANTIDAD SIN DECIMALES
							if($xdecimales == '00'){
							
								if($id == 1){
								
									$xcadena.= " PESOS MCTE";
								}
								
								if($id == 2){
								
									$xcadena.= " ";
								}
								
							}
							//CANTIDAD CON DECIMALES
							else{
								
								
								$xcifra_B = explode(".",$xcifra);
								$xcifra_C = $xcifra_B[1];
								
								//$xdecimales_2   = $funcion->numtoletras($xdecimales,2);
								
								$xdecimales_2   = $funcion->numtoletras($xcifra_C,2);
								
								$xcadena.= " PESOS  Y $xdecimales_2 CENTAVOS MCTE ";
							}
						}
						break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
			// ------------------      en este caso, para México se usa esta leyenda     ----------------
			$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("UN UN", "PRIMERO", $xcadena); // quito la duplicidad
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("DE UN", "PRIMERO", $xcadena); // corrigo la leyenda
			
			//NUEVO PARA QUE NO SALGA
			//UNO UN MILLON NOVECIENTOS TRES MIL QUINIENTOS PESOS MCTE
			//ADCIONADO EL 9 DE OCTUBRE 2019
			$xcadena = str_replace("UNO", " ", $xcadena); 
			
			//SE REALIZA ESTA PREGUNTA PARA QUE SI SE
			//DEFINE UNA CIFRA EN EL RANGO ESPECIFICADO
			//NO QUEDE DE ESTA FORMA EJ: 1000 ---> UN MIL PESOS SI NO MIL PESOS 
			if($xcifra >= '1000' && $xcifra <= '1999'){
			
				$xcadena = str_replace("UN MIL", "MIL", $xcadena); // corrigo la leyenda
			}
			
			
		} // ENDFOR ($xz)
		
		return trim($xcadena);
	}

	// END FUNCTION
	
	
	
	public function numtoletras_para_fecha($xcifra,$id){
	
		//instanciamos la clase Funciones.php con la variable $funcion
		$funcion = new Funciones();
	
	
		$xarray = array(
		      0 => "Cero",
			  1 => "UNO", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
			       "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", 
				   "DIECIOCHO", "DIECINUEVE","VEINTI",
			 30 => "TREINTA", 
			 40 => "CUARENTA", 
			 50 => "CINCUENTA", 
			 60 => "SESENTA", 
			 70 => "SETENTA", 
			 80 => "OCHENTA", 
			 90 => "NOVENTA",
			100 => "CIENTO", 
			200 => "DOSCIENTOS", 
			300 => "TRESCIENTOS", 
			400 => "CUATROCIENTOS", 
			500 => "QUINIENTOS", 
			600 => "SEISCIENTOS", 
			700 => "SETECIENTOS", 
			800 => "OCHOCIENTOS", 
			900 => "NOVECIENTOS"
		);
	//
		$xcifra = trim($xcifra);
		$xlength = strlen($xcifra);
		$xpos_punto = strpos($xcifra, ".");
		$xaux_int = $xcifra;
		$xdecimales = "00";
		if (!($xpos_punto === false)) {
			if ($xpos_punto == 0) {
				$xcifra = "0" . $xcifra;
				$xpos_punto = strpos($xcifra, ".");
			}
			$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
			$xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
		}

		$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
		$xcadena = "";
		for ($xz = 0; $xz < 3; $xz++) {
			$xaux = substr($XAUX, $xz * 6, 6);
			$xi = 0;
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
					break; // termina el ciclo
				}

				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = $funcion->subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma lógica que las centenas)
							if (substr($xaux, 1, 2) < 10) {
								
							} else {
								$key = (int) substr($xaux, 1, 2);
								if (TRUE === array_key_exists($key, $xarray)) {
									$xseek = $xarray[$key];
									$xsub = $funcion->subfijo($xaux);
									if (substr($xaux, 1, 2) == 20)
										$xcadena = " " . $xcadena . " VEINTE " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3;
								}
								else {
									$key = (int) substr($xaux, 1, 1) * 10;
									$xseek = $xarray[$key];
									if (20 == substr($xaux, 1, 1) * 10)
										$xcadena = " " . $xcadena . " " . $xseek;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " Y ";
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 1, 2) < 10)
							break;
						case 3: // checa las unidades
							if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
								
							} else {
								$key = (int) substr($xaux, 2, 1);
								$xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
								$xsub = $funcion->subfijo($xaux);
								$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
							} // ENDIF (substr($xaux, 2, 1) < 1)
							break;
					} // END SWITCH
				} // END FOR
				$xi = $xi + 3;
			} // ENDDO

			if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
				$xcadena.= " DE";

			if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
				$xcadena.= " DE";

			// ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
			if (trim($xaux) != "") {
				switch ($xz) {
					case 0:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN BILLON ";
						else
							$xcadena.= " BILLONES ";
						break;
					case 1:
						if (trim(substr($XAUX, $xz * 6, 6)) == "1")
							$xcadena.= "UN MILLON ";
						else
							$xcadena.= " MILLONES ";
						break;
					case 2:
						if ($xcifra < 1) {
							
							//$xcadena = "CERO PESOS $xdecimales/100 M.N.";
							
							$xcadena = "CERO";
						}
						if ($xcifra >= 1 && $xcifra < 2) {
							
							//$xcadena = "UN PESO $xdecimales/100 M.N. ";
							
							$xcadena = "PRIMERO";
						}
						if ($xcifra >= 2) {
							
							//$xcadena.= " PESOS $xdecimales/100 M.N. "; //
							
							//SE ADAPTA ESTA PARTE PARA CONVERTIR LOS CENTAVOS TAMBIEN EN LETRAS
							//Y DEJANDO SOLO EL VALOR EN LETRA DE LOS CENTAVOS POR ESO EL USO DE 
							//LA FUNCION EXPLODE, CAMBIO REALIZADO EL 5 DE MAYO 2017 POR JORGE ANDRES VALENCIA OROZCO
							
							//CANTIDAD SIN DECIMALES
							if($xdecimales == '00'){
							
								if($id == 1){
								
									$xcadena.= " ";
								}
								
								if($id == 2){
								
									$xcadena.= " ";
								}
								
							}
							//CANTIDAD CON DECIMALES
							else{
								
								
								$xcifra_B = explode(".",$xcifra);
								$xcifra_C = $xcifra_B[1];
								
								//$xdecimales_2   = $funcion->numtoletras($xdecimales,2);
								
								$xdecimales_2   = $funcion->numtoletras($xcifra_C,2);
								
								$xcadena.= " PESOS  Y $xdecimales_2 CENTAVOS MCTE ";
							}
						}
						break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
			// ------------------      en este caso, para México se usa esta leyenda     ----------------
			$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("UN UN", "PRIMERO", $xcadena); // quito la duplicidad
			$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
			$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
			$xcadena = str_replace("DE UN", "PRIMERO", $xcadena); // corrigo la leyenda
			
			//NUEVO PARA QUE NO SALGA
			//UNO UN MILLON NOVECIENTOS TRES MIL QUINIENTOS PESOS MCTE
			//ADCIONADO EL 9 DE OCTUBRE 2019
			$xcadena = str_replace("UNO", " ", $xcadena); 
			
			//NUEVO PARA QUE NO SALGA
			//Manizales, diez (10) de febrero de dos mil veinti (2021)
			//Y SALGA Manizales, diez (10) de febrero de dos mil veinti uno,dos,tres.... (2021)
			//ADCIONADO EL 10 DE FEBRERO 2020
			//OBTENGO AÑO (21) CON date() Y OBTENGO ULTIMA POSICION (1) CON substr()
			$year_reporte = date('y');
			$year_rest    = substr($year_reporte, -1);
			
			if($year_rest == 1){
			
				//$year_rest_letra = $funcion->numtoletras($year_rest,1);
				$xcadena         = str_replace("VEINTI", "VEINTI UNO", $xcadena);
			}
			
			//SE REALIZA ESTA PREGUNTA DE RANGO
			//PARA QUE CUANDO EL DIA QUE ESTA EN DICHO RANGO
			//NO SALGA ANTEPONIENDO LA PALABRA UNO 
			if($xcifra >= '22' && $xcifra <= '29'){
			
				//$xcadena = str_replace("VEINTI UNODOS", "VEINTI DOS", $xcadena); 
				
				
				switch ($xcifra) {
				
					case 22:
						$xcadena = str_replace("VEINTI UNODOS", "VEINTI DOS", $xcadena); 
						break;
					case 23:
						$xcadena = str_replace("VEINTI UNOTRES", "VEINTI TRES", $xcadena); 
						break;
					case 24:
						$xcadena = str_replace("VEINTI UNOCUATRO", "VEINTI CUATRO", $xcadena); 
						break;
					case 25:
						$xcadena = str_replace("VEINTI UNOCINCO", "VEINTI CINCO", $xcadena); 
						break;
					case 26:
						$xcadena = str_replace("VEINTI UNOSEIS", "VEINTI SEIS", $xcadena); 
						break;
					case 27:
						$xcadena = str_replace("VEINTI UNOSIETE", "VEINTI SIETE", $xcadena); 
						break;
					case 28:
						$xcadena = str_replace("VEINTI UNOOCHO", "VEINTI OCHO", $xcadena); 
						break;
					case 29:
						$xcadena = str_replace("VEINTI UNONUEVE", "VEINTI NUEVE", $xcadena); 
						break;	
				}
				
			}
			
			//SE REALIZA ESTA PREGUNTA DE RANGO
			//PARA QUE CUANDO EL DIA QUE ESTA EN DICHO RANGO
			//NO SALGA SOLO LA PALABRA TREINTA Y
			if($xcifra == '31'){
			
				$xcadena = str_replace("TREINTA Y", "TREINTA Y UNO", $xcadena);
			}
			
			//SE REALIZA ESTA PREGUNTA PARA QUE SI SE
			//DEFINE UNA CIFRA EN EL RANGO ESPECIFICADO
			//NO QUEDE DE ESTA FORMA EJ: 1000 ---> UN MIL PESOS SI NO MIL PESOS 
			if($xcifra >= '1000' && $xcifra <= '1999'){
			
				$xcadena = str_replace("UN MIL", "MIL", $xcadena); // corrigo la leyenda
			}
			
			
		} // ENDFOR ($xz)
		
		return trim($xcadena);
	}

	// END FUNCTION

	public function subfijo($xx){ // esta función regresa un subfijo para la cifra
	
		$xx = trim($xx);
		$xstrlen = strlen($xx);
		if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
			$xsub = "";
		//
		if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
			$xsub = "MIL";
		//
		return $xsub;
	}

	// END FUNCTION
	
	
	
//-----------------------------------------------------------------------
}//FIN CLASE
?>
