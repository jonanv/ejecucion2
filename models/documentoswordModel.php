<?php
class documentoswordModel extends modelBase
{


	/************************ Se obtiene los datos del documento *************************************/
	
	public function Obtener_Parte_Radicado($dator9){
	
	
		$valorradicado   = trim($dator9);

		/*$valorradicado_2 = substr($valorradicado, 0, 21);
		$valorradicado_3 = substr($valorradicado, 12, 4);
		$valorradicado_4 = substr($valorradicado, 16, 5);
		$valorradicado_5 = substr($valorradicado, 5, 2);
		$valorradicado_6 = substr($valorradicado, 7, 2);
		$valorradicado_7 = substr($valorradicado, 9, 3);//NUMERO JUZGADO 001....012
		$valorradicado_8 = substr($valorradicado, 10, 2);//NUMERO JUZGADO 001....012
		
		echo $valorradicado_2."<br>".$valorradicado_3."<br>".$valorradicado_4."<br>".$valorradicado_5."<br>".$valorradicado_6."<br>".$valorradicado_7."<br>".$valorradicado_8."<br>";*/ 
		
		$numero_juzgado = 0;
		$cadena_juzgado = 0;
		$valorradicado_8 = substr($valorradicado, 10, 2);
		// Recorremos cada car�cter de la cadena
		for($i=0; $i<strlen($valorradicado_8); $i++){
			// Mostramos cada uno de los caracteres...
			// con $cadena[0] se muestra el primera caracter, [1], el segundo, etc...
			//echo "<br>".$valorradicado_8[$i];
			
			
			if($valorradicado_8[0] == 0){
				
				//$cadena_juzgado = "SON EL JUZGADO: ".$valorradicado_8[1];
				
				$cadena_juzgado = substr($valorradicado, 11, 13);
				
				$numero_juzgado = 0;
				
				$i = strlen($valorradicado_8);
			}
			
			if($valorradicado_8[0] == 1){
				
				//$cadena_juzgado = "SON EL JUZGADO: ".$valorradicado_8[0]."".$valorradicado_8[1];
				
				$cadena_juzgado = substr($valorradicado, 10, 13);
				
				$numero_juzgado = 1;
				
				$i = strlen($valorradicado_8);
			}
			
			
		}
		
		if($numero_juzgado == 0){
		
			//echo $cadena_juzgado;
			
			return substr($cadena_juzgado,0,-2);
		
		}
		
		if($numero_juzgado == 1){
		
			//echo $cadena_juzgado;
			
			return substr($cadena_juzgado,0,-2);
		
		}
	
	
	}

	public function Obtener_Datos_Documento($iddoc){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("SELECT rds.id,rds.idradicado,td.nombre_tipo_documento,td.id AS iddocumento,rds.numero,d.nombre_dirigido,
										  rds.nombre,rds.direccion,rds.ciudad,rds.fechageneracion,rds.asunto,rds.contenido,rds.partes,
										  do.id AS iddoc,do.nombre_documento,td.nombre_archivo
										  FROM (((documentos_internos rds LEFT JOIN pa_tipodocumento td ON rds.idtipodocumento = td.id)
										  LEFT JOIN pa_documento do ON td.iddocumento = do.id)
										  LEFT JOIN pa_dirigido d ON rds.dirigidoa = d.id)
										  WHERE rds.id = '$iddoc'");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Oficina(){
	
			  
		
		$listar     = $this->db->prepare("SELECT * FROM pa_datos_oficina");
		
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Obtener_Datos_Radicado($idradicado){
   
   		$listar     = $this->db->prepare("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,pc.nombre AS claseproceso,
										  pj.nombre AS jo,pr.nombre AS jd,pr.nombre_juez AS juez,ubi.idjuzgado_reparto
										  FROM (((ubicacion_expediente ubi LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id)
										  LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
										  LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id)
										  WHERE ubi.id = '$idradicado'");
		
		$listar->execute();
			  
		return $listar; 
   
   }
   
   function Validar_Campo($campo){
   
		if (!empty($campo) && $campo != "" && $campo != "No Aplica") {
			return 1;
		}
		else{
			return 0;
		}
	
	}
	
	public function get_ano(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y'); 
		
		return $fecharegistro; 

	}

	public function numtoletras($xcifra,$id)
	{
	
		//instanciamos la clase Funciones.php con la variable $funcion
		$funcion = new documentoswordModel();
	
	
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
			$xlimite = 6; // inicializo el contador de centenas xi y establezco el l�mite a 6 d�gitos en la parte entera
			$xexit = true; // bandera para controlar el ciclo del While
			while ($xexit) {
				if ($xi == $xlimite) { // si ya lleg� al l�mite m�ximo de enteros
					break; // termina el ciclo
				}

				$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
				$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d�gitos)
				for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
					switch ($xy) {
						case 1: // checa las centenas
							if (substr($xaux, 0, 3) < 100) { // si el grupo de tres d�gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
								
							} else {
								$key = (int) substr($xaux, 0, 3);
								if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es n�mero redondo (100, 200, 300, 400, etc..)
									$xseek = $xarray[$key];
									$xsub = $funcion->subfijo($xaux); // devuelve el subfijo correspondiente (Mill�n, Millones, Mil o nada)
									if (substr($xaux, 0, 3) == 100)
										$xcadena = " " . $xcadena . " CIEN " . $xsub;
									else
										$xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
									$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
								}
								else { // entra aqu� si la centena no fue numero redondo (101, 253, 120, 980, etc.)
									$key = (int) substr($xaux, 0, 1) * 100;
									$xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
									$xcadena = " " . $xcadena . " " . $xseek;
								} // ENDIF ($xseek)
							} // ENDIF (substr($xaux, 0, 3) < 100)
							break;
						case 2: // checa las decenas (con la misma l�gica que las centenas)
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

			// ----------- esta l�nea la puedes cambiar de acuerdo a tus necesidades o a tu pa�s -------
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
			// ------------------      en este caso, para M�xico se usa esta leyenda     ----------------
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

	public function subfijo($xx)
	{ // esta funci�n regresa un subfijo para la cifra
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
	
	public function Obtener_Datos_Actuacion_Tutela($idactuacion){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$listar     = $this->db->prepare("	SELECT act.id,ct.radicado,juz.id AS idjuzgado,juz.nombre,acc.accionante_accionado_vinculado, acc.esaccionante_accionado_vinculado,
		                                    a.id AS idpa_actuacion,a.nombre as actuacion,a.encabezado_1,
											m.nombre as medio,act.esoficio_telegrama,act.oficio_telegrama,
											act.direccion,dep.nombre as departamento,mu.nombre as municipio,act.notificado,act.fecha_envio,act.tipo_actuacion,act.descripcion
											FROM correspondencia_tutelas ct
											LEFT JOIN accionante_accionado_vinculado acc ON (ct.id=acc.idcorrespondencia_tutelas)
											LEFT JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=acc.id)
											LEFT JOIN pa_actuacion a ON (a.id=act.idactuacion)
											LEFT JOIN pa_medionotificacion m ON (m.id=act.idmedionotificacion)
											LEFT JOIN pa_municipio mu ON (mu.id=act.idmunicipio)
											LEFT JOIN pa_departamento dep ON (dep.id=mu.iddepartamento)
											LEFT JOIN pa_juzgado juz ON (juz.id=ct.idjuzgado)
											WHERE act.id='$idactuacion'	");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }
   
   
  public function  Obtener_Datos_Juzgado_Ejecucion($datoT3B){
   
   
   		$listar     = $this->db->prepare("	SELECT * FROM pa_juzgado
											WHERE id='$datoT3B'	");
										  
		
	
		$listar->execute();
			  
		return $listar; 
	
   }


}/*Cierra Model*/

?>

<?php

$opcion = $_GET['opcion'];
$iddoc  = $_GET['id'];

//PARA LA CARATULA
$idradicadocaratula  = $_GET['idradicadocaratula']; 
$idcaratulaplantilla = $_GET['idcaratula'];

if($opcion == 1){

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new documentoswordModel();
	
	$datosoficina = $data->Obtener_Datos_Oficina();
	
	//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
	//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
	while( $filao = $datosoficina->fetch() ){
	
			$datoofi1  = $filao[nombre];
			$datoofi2  = $filao[sigla];
			$datoofi3  = $filao[direccion];
			$datoofi4  = $filao[telefono];
			$datoofi5  = $filao[secretario];
			$datoofi6  = $filao[coordinadora];
	}
	
	
	
	
	$vector_datos = $data->Obtener_Datos_Documento($iddoc);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $vector_datos->fetch() ){
			
			$datos0   = $field[nombre_tipo_documento];
			$datos0b  = $field[iddoc];//ID DOCUMENTO
			$datos0b2 = $field[nombre_documento];//NOMBRE DOCUMENTO
			$datos0c  = $field[iddocumento];//ID TIPO DOCUMENTO
			
			$datos1  = $field[numero];
			$datos2  = $field[nombre_dirigido];
			$datos3  = $field[nombre];
			$datos4  = $field[direccion];
			$datos5  = $field[ciudad];
			$datos6  = $field[asunto];
			$datos7  = $field[contenido];
			$datos8  = $field[fechageneracion];
			
			$datosir = $field[idradicado];
			
			$datospartes = $field[partes];
			
			$nombre_archivo = $field[nombre_archivo];

	}
	$idradicado = $datosir;
	//OBTENEMOS LOS DATOS DEL RADICADO
	$datosradicado = $data->Obtener_Datos_Radicado($idradicado);
	
	while( $filar = $datosradicado->fetch() ){
	
			$dator1  = $filar[id];
			$dator2  = $filar[cedula_demandante];
			$dator3  = $filar[demandante];
			$dator4  = $filar[cedula_demandado];
			$dator5  = $filar[demandado];
			$dator6  = $filar[claseproceso];
			$dator7  = $filar[jo];
			$dator8  = $filar[jd];
			$dator9  = $filar[radicado];
			$dator10 = $filar[juez];
			
			$idjuzgado_reparto = $filar[idjuzgado_reparto];
	}
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMA�O OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
						//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
						'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
						
					);

	$sectionStyleCaratula = array(
									'orientation' => 'portrait',
									'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
									//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
									'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
									'borderColor' =>'#000000', 
									'borderSize'  =>2,
						
					);

	if($datos0c != 39 && $idcaratulaplantilla != 39){
	
		$section = $PHPWord->createSection($sectionStyle);
	
	}
	else{
		$section = $PHPWord->createSection($sectionStyleCaratula);
	}
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	$fontStyleB  = array ('size'=>11);
	$paraStyleB2 = array ('align' => 'both');//'align' => 'both' TEXTO JUSTIFICADO
	
	$fontStyleC  = array ('bold' => true,'size'=>11);
	$paraStyleC2 = array ('align' => 'left','spaceAfter'=>0.0);
	
	$fontStyleD  = array ('bold' => true,'size'=>11);
	$paraStyleD2 = array ('align' => 'left');
	
	$fontStyleE  = array ('bold' => true,'size'=>6);
	$paraStyleE2 = array ('align' => 'center');
	
	$fontStyleF  = array ('size'=>6);
	$paraStyleF2 = array ('align' => 'both');
	
	//PARA PONER COLOR A UNA SECCION
    $fontStyleP = array('size' => 11, 'color' => 'EC1A12', 'bold' => true);
	
	//PARA LAS TABLAS
	$fontStyleT  = array ('bold' => true,'size'=>9);
	$paraStyleT2 = array ('align' => 'center');
	
	$fontStyleTB   = array ('bold' => false,'size'=>6);
	$paraStyleTB2  = array ('align' => 'left','spaceAfter'=>0.0);
	$paraStyleTB2B = array ('align' => 'both','spaceAfter'=>0.0);
	
	$fontStyleTC  = array ('bold' => true,'size'=>8);
	$paraStyleTC2 = array ('align' => 'center','spaceAfter'=>0.0);
	
	$fontStyleIDDOC  = array ('bold' => true,'size'=>6);
	$paraStyleIDDOC2 = array ('align' => 'left','spaceAfter'=>0.0);
	
	$fontStyleR  = array ('bold' => true,'size'=>5);
	$paraStyleR2 = array ('align' => 'left','spaceAfter'=>0.0);
	
	//Define row style arrays
	$styleRow   = array('exactHeight'=>'exact');
	
	// Define cell style arrays
	$styleCell   = array('valign'=>'center');
	$styleCellCombinadas  = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas2 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	$styleCellCombinadas3 = array('gridSpan' => 2,'valign'=>'center','borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
	
	//PARA LA CARATULA
	$fontStyleJUZ  = array ('bold' => true,'size'=>16);
	$paraStyleJUZ  = array ('align' => 'center');
	
	$fontStyleCRTULA  = array ('bold' => true,'size'=>24);
	$paraStyleCRTULA  = array ('align' => 'center');
	
	$fontStyleCRTULAB  = array ('bold' => false,'size'=>14);
	$paraStyleCRTULAB  = array ('align' => 'left');
	
	$fontStyleVAR  = array ('bold' => true,'size'=>16);
	$paraStyleVAR  = array ('align' => 'both');
	
	$fontStylePie  = array ('bold' => true,'size'=>9);
	$paraStylePie2 = array ('align' => 'center');
	
	//PARA AUTO APRUEBA LIQUIDACION
	$fontStyleAL  = array ('bold' => true,'size'=>11);
	$paraStyleAL2 = array ('align' => 'both','spaceAfter'=>0.0);
	
	$fontStyleALX  = array ('size'=>11);
	$paraStyleALX2 = array ('align' => 'both','spaceAfter'=>0.0);
	
	//PARA AUTOS GENERALES
	
	$fontStyleA_AUTO  = array ('bold' => true,'size'=>11);
	$paraStyleA2_AUTO = array ('align' => 'left','spaceAfter'=>0.0);
	
	$fontStyleB_AUTO  = array ('size'=>11);
	$paraStyleB2_AUTO = array ('align' => 'right','spaceAfter'=>0.0);
	
	
	if($datos0c != 39 && $datos0c != 1000 && $idcaratulaplantilla != 39){
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezadoX2.png',  array('width'=>200, 'height'=>80, 'align'=>'center'));
	//$table->addCell(6800)->addText('Rama Judicial del Poder P�blico Oficina de apoyo para los Juzgados Civiles Municipales de Ejecuci�n de Sentencias de Manizales',$fontStyleLOGO, $paraStyleLOGO2);
	$table->addCell(3800)->addImage('views/images/encabezadoX4.png',  array('width'=>280, 'height'=>60, 'align'=>'center'));
	$table->addCell(2000)->addImage('views/images/encabezadoX3.png',  array('width'=>70, 'height'=>70, 'align'=>'center'));
	
	//----------------------------------------------------------------------------------------------------------------------
	
	}
	

	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	//************************************************OFICIOS*********************************************************************
	
	//SI ES DOCUMENTO OFICIO
	if($datos0b == 1){
		
		//SI ES TIPO DOCUMENTO 
		//(Oficio Cancelacion de Embargo Pagador,Oficio Cancelacion de Embargo Bancos)
		if($datos0c == 2 || $datos0c == 3){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";  $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";  $campofila2 =$dator4;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			/*$section->addText("PROCESO: ".$dator6,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDANTE: ".$dator3,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDANTE: ".$dator2,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDADOS: ".$dator5,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDADO: ".$dator4,$fontStyleC, $paraStyleC2);*/
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones respectivas y dejar sin efecto el oficio ".$parte1." despacho conoci� inicialmente del proceso y que por la redistribuci�n del mapa judicial en  la ciudad, el mismo correspondi� a esta c�lula judicial conforme a lo dispuesto por el Acuerdo No. PSAA14-10148 de mayo 6 de 2014 expedido por la Sala Administrativa del Consejo Superior de la Judicatura.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO DOCUMENTO 
		//(Oficio Cancelacion de Embargo Transito)
		if($datos0c == 4 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "VEHICULO PLACA: "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			/*$section->addText("PROCESO: ".$dator6,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDANTE: ".$dator3,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDANTE: ".$dator2,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDADOS: ".$dator5,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDADO: ".$dator4,$fontStyleC, $paraStyleC2);*/
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones respectivas y dejar sin efecto el oficio ".$parte1." despacho conoci� inicialmente del proceso y que por la redistribuci�n del mapa judicial en  la ciudad, el mismo correspondi� a esta c�lula judicial conforme a lo dispuesto por el Acuerdo No. PSAA14-10148 de mayo 6 de 2014 expedido por la Sala Administrativa del Consejo Superior de la Judicatura.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO DOCUMENTO 
		//(Oficio Cancelacion de Embargo Transito y Prenda)
		if($datos0c == 75){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "VEHICULO PLACA: "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			/*$section->addText("PROCESO: ".$dator6,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDANTE: ".$dator3,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDANTE: ".$dator2,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDADOS: ".$dator5,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDADO: ".$dator4,$fontStyleC, $paraStyleC2);*/
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones respectivas y dejar sin efecto el oficio ".$parte1." despacho conoci� inicialmente del proceso y que por la redistribuci�n del mapa judicial en  la ciudad, el mismo correspondi� a esta c�lula judicial conforme a lo dispuesto por el Acuerdo No. PSAA14-10148 de mayo 6 de 2014 expedido por la Sala Administrativa del Consejo Superior de la Judicatura, y la Prenda Registrada en esa Dependencia el d�a ".$parte3,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO DOCUMENTO (Oficio Cancelacion de Embargo Registro)
		if($datos0c == 1){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2		  = $datospartesB[3];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA INM: ";  $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			/*$section->addText("PROCESO: ".$dator6,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDANTE: ".$dator3,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDANTE: ".$dator2,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDADOS: ".$dator5,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDADO: ".$dator4,$fontStyleC, $paraStyleC2);*/
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones respectivas y dejar sin efecto el oficio ".$parte1." despacho conoci� inicialmente del proceso y que por la redistribuci�n del mapa judicial en  la ciudad, el mismo correspondi� a esta c�lula judicial.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA FORMATO DE CALIFICACI�N--------------------------------------------------------------------
			
			/*$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');			
			$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			
			$styleTable3    = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
			$styleFirstRow3 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
			
			//--------------------------TABLA FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle2', $styleTable3, $styleFirstRow3);
			$table2 = $section->addTable('myOwnTableStyle2');
			
			while($conttabla < 5){
			
				if($conttabla == 0){
				
					$table2->addRow($styleRow);
					$table2->addCell(10000, array('gridSpan' => 4))->addText("FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("MATR�CULA INMOBILIARIA:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText($parte2,$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("C�DIGO CATASTRAL:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
				
				}
				
				if($conttabla == 2){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("UBICACI�N DEL PREDIO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("MUNICIPIO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, array('gridSpan' => 2))->addText("VEREDA:",$fontStyleT, $paraStyleT2);
			
				}
				
				if($conttabla == 3){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("URBANO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("RURAL:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 4){
				
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("DIRECCION",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					
				}
				
				
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012------------------------------------------------------------------------------
		
			
			
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA DOCUMENTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable3, $styleFirstRow3);
			$table6 = $section->addTable('myOwnTableStyle6');
			
			while($conttabla < 3){
			
				if($conttabla == 0){
				
					$table6->addRow($styleRow);
					$table6->addCell(10000, array('gridSpan' => 5))->addText("DOCUMENTO",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table6->addRow($styleRow);
					$table6->addCell(10000, $styleCell)->addText("CLASE",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("N�MERO",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("FECHA",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("OFICINA DE ORIGEN",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("CIUDAD",$fontStyleT, $paraStyleT2);
				
				}
				
				if($conttabla == 2){
				
					$table6->addRow($styleRow);
					$table6->addCell(10000, $styleCell)->addText($datos0b2,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos1,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos8,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($dator8,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos5,$fontStyleT, $paraStyleT2);
				
				}
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA DOCUMENTO------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA NATURALEZA JUR�DICA DEL ACTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable3, $styleFirstRow3);
			$table7 = $section->addTable('myOwnTableStyle6');
			
			while($conttabla < 4){
			
				if($conttabla == 0){
				
					$table7->addRow($styleRow);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("NATURALEZA JUR�DICA DEL ACTO",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table7->addRow($styleRow);
					$table7->addCell(10000, $styleCell)->addText("C�DIGO REGISTRAL",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("ESPECIFICACI�N",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("VALOR DEL ACTO",$fontStyleT, $paraStyleT2);
	
				}
				
				if($conttabla == 2){
				
					$table7->addRow(100);
					$table7->addCell(10000, $styleCell)->addText("007",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("CANCELACI�N MEDIDA DE EMBARGO",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("SIN CUANT�A",$fontStyleT, $paraStyleT2);
					
				
				}
				
				if($conttabla == 3){
				
					/*$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);*/
					
				/*}
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA NATURALEZA JUR�DICA DEL ACTO------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA PERSONAS QUE INTERVIENEN EN EL ACTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle8', $styleTable3, $styleFirstRow3);
			$table8 = $section->addTable('myOwnTableStyle8');
			
			while($conttabla < 3){
			
				if($conttabla == 0){
				
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("PERSONAS QUE INTERVIENEN EN EL ACTO",$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText("N�MERO DE IDENTIFICACI�N",$fontStyleT, $paraStyleT2);
					
				}
				
				
				if($conttabla == 1){
	
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("DEMANDANTE: ".$dator3,$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText($dator2,$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("DEMANDADO: ".$dator5,$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText($dator4,$fontStyleT, $paraStyleT2);
	
				}
				
				if($conttabla == 2){
	
					$table8->addRow($styleRow);
					$table8->addCell(10000,$styleCellCombinadas)->addText('',$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCellCombinadas2)->addText($datoofi5,$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCellCombinadas3)->addText("Secretario",$fontStyleT, $paraStyleT2);
					
				}
				
				$conttabla = $conttabla + 1;
			}*/
			
			
			
			//--------------------------FIN TABLA PERSONAS QUE INTERVIENEN EN EL ACTO------------------------------------------------------------------------------
			


			//----------------------------------------------------------------------------------------------------------------------
			
		}
		
		//SI ES TIPO (Oficio Cancelacion Hipoteca Notario)
		 if($datos0c== 9){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA INM: ";  $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se solicita cancelar la Escritura P�blica No, ".$parte1.", a trav�s de la cual se constituy� el gravamen hipotecario que pesa sobre el bien inmueble identificado con matricula inmobiliaria No. ".$parte2.", propiedad de la parte demandada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Cancelacion Hipoteca y Patrimonio o Afectacion a Vivienda Notaria)
		 if($datos0c== 76){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA INM: ";  $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se solicita cancelar la Escritura P�blica No, ".$parte1.", a trav�s de la cual se constituy� el gravamen hipotecario que pesa sobre el bien inmueble identificado con matricula inmobiliaria No. ".$parte2.", propiedad de la parte demandada y ".$parte3,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Remanentes no Surte Efecto)
		if($datos0c == 15){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("Se orden� comunicarle que NO SURTE EFECTOS la medida de EMBARGO DE REMANENTES solicitada para el proceso que se tramita en su despacho y que se relaciona a continuaci�n,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";        $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";     $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";     $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			$section->addText("En raz�n a que ".$parte4,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Remanentes Surte Efecto)
		if($datos0c == 16){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("Se orden� comunicarle que SURTE EFECTOS la medida de EMBARGO DE REMANENTES solicitada para el proceso que se tramita en su despacho y que se relaciona a continuaci�n,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";     $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";  $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";   $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";   $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText("Los mismos ser�n dejados a su disposici�n en su debida oportunidad procesal.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO DOCUMENTO (Oficio Comunicacion Embargo Registro)
		if($datos0c == 5){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 =$dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA INM: ";  $campofila2 =$parte1;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase proceder de conformidad y allegar a esta oficina soporte sobre la procedencia de la medida.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA FORMATO DE CALIFICACI�N--------------------------------------------------------------------
			
			/*$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');			
			$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			
			$styleTable3    = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
			$styleFirstRow3 = array('borderSize'=>5, 'borderColor'=>'000000', 'bgColor'=>'FFFFFF');
			
			//--------------------------TABLA FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle2', $styleTable3, $styleFirstRow3);
			$table2 = $section->addTable('myOwnTableStyle2');
			
			while($conttabla < 5){
			
				if($conttabla == 0){
				
					$table2->addRow($styleRow);
					$table2->addCell(10000, array('gridSpan' => 4))->addText("FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("MATR�CULA INMOBILIARIA:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText($parte1,$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("C�DIGO CATASTRAL:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
				
				}
				
				if($conttabla == 2){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("UBICACI�N DEL PREDIO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("MUNICIPIO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, array('gridSpan' => 2))->addText("VEREDA:",$fontStyleT, $paraStyleT2);
			
				}
				
				if($conttabla == 3){
	
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("URBANO:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("RURAL:",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, $styleCell)->addText("",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 4){
				
					$table2->addRow($styleRow);
					$table2->addCell(10000, $styleCell)->addText("DIRECCION",$fontStyleT, $paraStyleT2);
					$table2->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					
				}
				
				
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA FORMATO DE CALIFICACI�N ART. 8 PAR. 4 LEY 1579/2012------------------------------------------------------------------------------
		
			
			
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA DOCUMENTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable3, $styleFirstRow3);
			$table6 = $section->addTable('myOwnTableStyle6');
			
			while($conttabla < 3){
			
				if($conttabla == 0){
				
					$table6->addRow($styleRow);
					$table6->addCell(10000, array('gridSpan' => 5))->addText("DOCUMENTO",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table6->addRow($styleRow);
					$table6->addCell(10000, $styleCell)->addText("CLASE",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("N�MERO",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("FECHA",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("OFICINA DE ORIGEN",$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText("CIUDAD",$fontStyleT, $paraStyleT2);
				
				}
				
				if($conttabla == 2){
				
					$table6->addRow($styleRow);
					$table6->addCell(10000, $styleCell)->addText($datos0b2,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos1,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos8,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($dator8,$fontStyleT, $paraStyleT2);
					$table6->addCell(10000, $styleCell)->addText($datos5,$fontStyleT, $paraStyleT2);
				
				}
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA DOCUMENTO------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA NATURALEZA JUR�DICA DEL ACTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle6', $styleTable3, $styleFirstRow3);
			$table7 = $section->addTable('myOwnTableStyle6');
			
			while($conttabla < 4){
			
				if($conttabla == 0){
				
					$table7->addRow($styleRow);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("NATURALEZA JUR�DICA DEL ACTO",$fontStyleT, $paraStyleT2);
					
				}
				
				if($conttabla == 1){
	
					$table7->addRow($styleRow);
					$table7->addCell(10000, $styleCell)->addText("C�DIGO REGISTRAL",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("ESPECIFICACI�N",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("VALOR DEL ACTO",$fontStyleT, $paraStyleT2);
	
				}
				
				if($conttabla == 2){
				
					$table7->addRow(100);
					$table7->addCell(10000, $styleCell)->addText("004",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("INSCRIPCION DE EMBARGO ",$fontStyleT, $paraStyleT2);
					$table7->addCell(10000, $styleCell)->addText("SIN CUANT�A",$fontStyleT, $paraStyleT2);
					
				
				}
				
				if($conttabla == 3){
				
					/*$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);
					$table7->addRow(100);
					$table7->addCell(10000, array('gridSpan' => 3))->addText("",$fontStyleT, $paraStyleT2);*/
					
				/*}
		
				$conttabla = $conttabla + 1;
			}
			
			//--------------------------FIN TABLA NATURALEZA JUR�DICA DEL ACTO------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//--------------------------TABLA PERSONAS QUE INTERVIENEN EN EL ACTO------------------------------------------------------------------------------
			$conttabla = 0;
			
			$PHPWord->addTableStyle('myOwnTableStyle8', $styleTable3, $styleFirstRow3);
			$table8 = $section->addTable('myOwnTableStyle8');
			
			while($conttabla < 3){
			
				if($conttabla == 0){
				
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("PERSONAS QUE INTERVIENEN EN EL ACTO",$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText("N�MERO DE IDENTIFICACI�N",$fontStyleT, $paraStyleT2);
					
				}
				
				
				if($conttabla == 1){
	
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("DEMANDANTE: ".$dator3,$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText($dator2,$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCell)->addText("DEMANDADO: ".$dator5,$fontStyleT, $paraStyleT2);
					$table8->addCell(10000, $styleCell)->addText($dator4,$fontStyleT, $paraStyleT2);
	
				}
				
				if($conttabla == 2){
	
					$table8->addRow($styleRow);
					$table8->addCell(10000,$styleCellCombinadas)->addText('',$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCellCombinadas2)->addText($datoofi5,$fontStyleT, $paraStyleT2);
					
					$table8->addRow($styleRow);
					$table8->addCell(10000, $styleCellCombinadas3)->addText("Secretario",$fontStyleT, $paraStyleT2);
					
				}
				
				$conttabla = $conttabla + 1;
			}*/
			
			//--------------------------FIN TABLA PERSONAS QUE INTERVIENEN EN EL ACTO------------------------------------------------------------------------------
			


			//----------------------------------------------------------------------------------------------------------------------
			
		}
		
		//SI ES TIPO (Oficio Comunicacion Embargo Pagador)
		if($datos0c == 6){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			if($parte1 == "5 parte"){
		
				$section->addText("Por medio del presente, me permito comunicarle que por auto de fecha ".$fechaauto.", proferido dentro del proceso de la referencia, se decret� como medida cautelar el embargo y retenci�n de la 5�. Parte que exceda del salario m�nimo mensual vigente que percibe la demandada como empleada al servicio de esa entidad.", $fontStyleB, $paraStyleB2);
			}
			else{
				
				$section->addText("Por medio del presente, me permito comunicarle que por auto de fecha ".$fechaauto.", proferido dentro del proceso de la referencia, se decret� como medida cautelar el embargo y retenci�n del ".$parte1. "% que exceda del salario m�nimo mensual vigente que percibe la demandada como empleada al servicio de esa entidad.", $fontStyleB, $paraStyleB2);
			}
				
			$section->addText("Dentro de los cinco (5) d�as siguientes al recibo de la comunicaci�n deber� informar por escrito sobre la efectividad o no de la medida.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Si le ha notificado con anterioridad otro embargo, explicar en qu� fecha, para qu� proceso y por orden de qu� autoridad.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Los dineros retenidos deber�n ser puestos a disposici�n de la OFICINA DE EJECUCION CIVIL MUNICIPAL DE MANIZALES, en la cuenta No. 170012041800 en el BANCO AGRARIO DE COLOMBIA cuenta de Dep�sitos Judiciales, C�digo 1803 y para  el proceso citado. Los embargos subsistir�n hasta que se le comunique su cancelaci�n.",$fontStyleB, $paraStyleB2);
			
			$section->addText("La no contestaci�n de este oficio oportunamente o no hacer las retenciones y consignaciones ordenadas acarrear� las sanciones de ley y la obligaci�n solidaria de cancelar personal y directamente las sumas de dinero que indebidamente deje de descontar.",$fontStyleB, $paraStyleB2);
			
			$section->addText("NOTA IMPORTANTE  en todas las consignaciones se debe indicar el n�mero de Radicaci�n con los 23 d�gitos, el  nombre y la identificaci�n de las partes.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Comunicacion Embargo Bancos)
		if($datos0c == 7){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8.", dentro del proceso que se relaciona a continuaci�n, se decret� el embargo y retenci�n de los dineros que se encuentren depositados en cuentas corrientes, de ahorros, cdt y/o cualquier otro t�tulo valor financiero antes las diferentes entidades bancarias.", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("Medida que se limita a la suma de ".$parte1,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
		
			$section->addText("S�rvase en consecuencia hacer las anotaciones y acusar oficio informando sobre la efectividad o no de la medida, todo ello de conformidad con el art. 593-10 del C.G. del Proceso.",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText("Los descuentos deben consignarse en el Banco Agrario de Colombia, a �rdenes de esta oficina de ejecuci�n en la cuenta No. 170012041800, C�digo 1803 se�alando los datos exactos del ejecutado con su identificaci�n.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Comunicacion Embargo Transito)
		if($datos0c == 8){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8.", se decret� el embargo y posterior secuestro sobre el veh�culo automotor de propiedad del codemandado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "PLACAS: ";         $campofila2 =$parte1;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones correspondientes en el respectivo Kardex, y enviar el certificado donde conste la inscripci�n de la medida.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Comunicacion Embargo Contrato)
		if($datos0c == 17){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			if($parte2 == 0){
				$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se decret� el embargo del contrato de prestaci�n de Servicios que posea el demandado con esa entidad, previa deducci�n del salario m�nimo legal mensual. La medida se limita a la suma de ".$parte1." de conformidad con lo establecido en el numeral 9 del art�culo 593 del C.G. del Proceso.", $fontStyleB, $paraStyleB2);
			}
			else{
				$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se decret� el embargo del ".$parte2."% del contrato de prestaci�n de Servicios que posea el demandado con esa entidad, previa deducci�n del salario m�nimo legal mensual. La medida se limita a la suma de ".$parte1." de conformidad con lo establecido en el numeral 9 del art�culo 593 del C.G. del Proceso.", $fontStyleB, $paraStyleB2);
			}
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
			
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones y acusar oficio informando sobre la efectividad o no de la medida, todo ello de conformidad con el art. 593-10 del C.G. del Proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Los descuentos deben consignarse en el Banco Agrario de Colombia, a �rdenes de esta oficina de ejecuci�n en la cuenta No. 170012041800, C�digo 1803, se�alando los datos exactos del ejecutado con su identificaci�n.",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Comunicacion Camara de Comercio)
		if($datos0c == 18){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA MERCANTIL: ";      $campofila2 =$parte2;}
				
			
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("Sobre el Establecimiento de Comercio denominado ".$parte1,$fontStyleB, $paraStyleB2);
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones correspondientes en el respectivo kardex.",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Embargo Remanentes)
		if($datos0c == 19){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			//$parte4       = $datospartesB[5];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� el embargo de los bienes que por cualquier causa se llegaren a desembargar a la parte demandada", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("Tal medida producir� efectos en el siguiente proceso que se tramita en ese Despacho Judicial:",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";     $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";  $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: "; $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText("Favor informar si procede o no la medida solicitada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Cancelacion Embargo de Remanentes)
		if($datos0c == 23){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte4.", para el proceso:",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";        $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";     $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";     $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(1);
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones",$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Cancelacion Embargo de Remanentes y Vigencia)
		if($datos0c == 28){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte4.", para el proceso:",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";        $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";     $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";     $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte5." y que cursa en ".$parte6,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO (Oficio Cancelacion de Embargo Bancos y Vigencia Otro Juzgado)
		if($datos0c == 70){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte1,$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte2." y que cursa en ".$parte3,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO (Oficio Cancelacion de Embargo Camara Comercio y Vigencia Otro Juzgado)
		if($datos0c == 71){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte1,$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte2." y que cursa en ".$parte3,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO (Oficio Cancelacion de Embargo Pagador y Vigencia)
		if($datos0c == 72){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte1,$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte2." y que cursa en ".$parte3,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Cancelacion de Embargo Registro y Vigencia)
		if($datos0c == 73){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
	
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA: ";      $campofila2 =$parte4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte1,$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte2." y que cursa en ".$parte3,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Cancelacion de Embargo Transito y Vigencia)
		if($datos0c == 74){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto, de fecha ".$fechaauto." proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".$datos6." del demandado:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "PLACA: ";          $campofila2 =$parte4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("La medida le hab�a sido comunicada mediante el oficio No. ".$parte1,$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText("Con la ADVERTENCIA que la misma contin�a vigente para el proceso Ejecutivo de ".$parte2." y que cursa en ".$parte3,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Requiere Pagador)
		if($datos0c == 24){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			//$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
		
			//$section->addText("Me permito comunicarle que por auto, proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo a fin de que se informe a este despacho los motivos que le han impedido o le impiden dar aplicaci�n al oficio de embargo No.".$parte1." del ".$fechaauto,$fontStyleB, $paraStyleB2);
			
			$section->addText("Me permito comunicarle que por auto del ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo a fin de que se informe a este despacho los motivos que le han impedido o le impiden dar aplicaci�n al oficio de embargo No.".$parte1,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 8){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "CUENTA No: ";      $campofila2 ="170012041800 BANCO AGRARIO";}
				if($conttabla == 7){$campofila = "CODIGO: ";         $campofila2 ="1803";}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			
			$section->addTextBreak(1);
			
			$section->addText("NOTA: De no dar cumplimiento a la medida, se har� acreedor a las sanciones de que trata el at. 593 del C�digo General del Proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Requiere Secuestre Entrega)
		if($datos0c == 25){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para que proceda a hacer entrega inmediata del bien que se encuentra bajo su cuidado al ".$parte1.", rinda cuentas finales de su gesti�n dentro de los diez (10) d�as siguientes al recibo del presente y allegue la correspondiente acta de Entrega:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio deja a Disposicion Remanentes)
		if($datos0c == 27){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
		
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("Se adjunta original del oficio No. ".$parte4." que corresponde a lo ordenado en auto de fecha ".$fechaauto.", para que sean entregados all� a la parte interesada en el siguiente proceso, en virtud del embargo de remanentes;", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";        $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";     $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";     $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(1);
			
			$section->addText("NOTA: ".$parte5,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Requiere Secuestre Rinda Informes)
		if($datos0c == 29){
		
			/*$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];*/
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para que presente los informe peri�dicos de sus gesti�n e informe el lugar donde se encuentra el bien objeto de litigio:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText("El desacato a este requerimiento, le acarreara sanciones penales.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Requiere Secuestre Preste Poliza)
		if($datos0c == 80){
		
			/*$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];*/
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para que presente la p�liza a que est� obligado (a) para garantizar  el buen desempe�o de sus funciones.", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText("El desacato a este requerimiento, le acarreara sanciones disciplinarias.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//SI ES TIPO (Oficio Requiere Secuestre Notificacion Personal)
		if($datos0c == 30){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para notificarle personalmente el auto fechado ".$fechaauto." de la presente anualidad:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("El desacato a este requerimiento, le acarreara sanciones penales.",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//Oficio a Juzgados y Otros
		if($datos0c == 26){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Por medio del presente, me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." en el proceso que se relaciona a continuaci�n,", $fontStyleB, $paraStyleB2);
			
			//$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para que presente los informe peri�dicos de sus gesti�n e informe el lugar donde se encuentra el bien objeto de litigio:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Se dispuso ".$parte1,$fontStyleB, $paraStyleB2);
			
			$section->addText($parte1,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//Oficio Oficio Requiere Designe Apoderado
		if($datos0c == 31){
		
			/*$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];*/
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Por medio del presente, me permito comunicarle que apoderada en proceso ejecutivo promovido por la entidad que Usted representa en contra de ".$dator5." C.C. ".$dator4.", radicado ".$dator9." Renuncio al poder otorgado.", $fontStyleB, $paraStyleB2);
			
			//$section->addText("Me permito comunicarle que por auto proferido por el ".$dator8.", dictado dentro del proceso que se relaciona a continuaci�n, se orden� requerirlo para que presente los informe peri�dicos de sus gesti�n e informe el lugar donde se encuentra el bien objeto de litigio:", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Favor proceder a designar nuevo apoderado.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO DOCUMENTO 
		//(Oficio Cancelacion de Embargo Camara Comercio)
		if($datos0c == 37 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� la ".strtolower($datos6), $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "MATRICULA MERCANTIL: "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			/*$section->addText("PROCESO: ".$dator6,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDANTE: ".$dator3,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDANTE: ".$dator2,$fontStyleC, $paraStyleC2);
			$section->addText("DEMANDADOS: ".$dator5,$fontStyleC, $paraStyleC2);
			$section->addText("CEDULA DEMANDADO: ".$dator4,$fontStyleC, $paraStyleC2);*/
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("S�rvase en consecuencia hacer las anotaciones respectivas y dejar sin efecto el oficio ".$parte1." despacho conoci� inicialmente del proceso y que por la redistribuci�n del mapa judicial en  la ciudad, el mismo correspondi� a esta c�lula judicial conforme a lo dispuesto por el Acuerdo No. PSAA14-10148 de mayo 6 de 2014 expedido por la Sala Administrativa del Consejo Superior de la Judicatura, Sobre el Establecimiento de Comercio Denominado ".$parte3,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//Oficio Designacion Secuestre
		if($datos0c == 38 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se orden� informarle que fue designado como secuestre dentro del presente proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("Conforme al inciso 2 del art�culo 49 del C.G.P. se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los cinco (5) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Conforme al art�culo 49 del C�digo General del Proceso. Se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los tres (3) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//Oficio Designacion Perito
		if($datos0c == 77 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se orden� informarle que fue designado como perito dentro del presente proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("Conforme al inciso 2 del art�culo 49 del C.G.P. se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los cinco (5) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Conforme al art�culo 49 del C�digo General del Proceso. Se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los tres (3) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//Oficio Designacion Curador
		if($datos0c == 78 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se orden� informarle que fue designado como curador dentro del presente proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("Conforme al inciso 2 del art�culo 49 del C.G.P. se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los cinco (5) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Conforme al art�culo 49 del C�digo General del Proceso. Se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los tres (3) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//Oficio Designacion Amparo de Pobreza
		if($datos0c == 79 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("Se orden� informarle que fue designado como Apoderado de Pobre dentro del presente proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("Conforme al inciso 2 del art�culo 49 del C.G.P. se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los cinco (5) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Conforme al art�culo 49 del C�digo General del Proceso. Se advierte que el cargo de auxiliar de la justicia es de obligatoria aceptaci�n, dentro de los tres (3) d�as siguientes al env�o del telegrama correspondiente o a la notificaci�n realizada por cualquier otro medio, so pena de sea excluido de la lista, salvo justificaci�n aceptada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		//Oficio Cambio de Cuenta pagador
		if($datos0c == 40 ){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo;",$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que a partir de la fecha, los t�tulos judiciales producto de la medida de embargo ordenada dentro del proceso que a continuaci�n de relaciona, que ven�an siendo consignados a �rdenes del ".$dator7." de Manizales, deber�n en lo sucesivo y a partir de la recepci�n de este oficio, ser consignados a la cuenta de dep�sitos judiciales del Banco Agrario N� 170012041800 (C�digo Despacho 170014303000) correspondiente a la cuenta de la OFICINA DE EJECUCION CIVIL MUNICIPAL DE MANIZALES, quien se encargara de dicha funci�n, conforme lo establecen los Acuerdos PSAA13-9984 del 5 de septiembre de 2013 y PSAA14-10183 del 8 de Julio de 2014, emanados por el Consejo Superior de la Judicatura.", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Es importante se�alar que la medida le est� siendo comunicada por el ".$dator7." de la ciudad con oficio ".$parte0." , adem�s el radicado y las partes del proceso contin�an siendo las mismas:",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio Reitera Cambio Cuenta Pagador)
		 if($datos0c == 41){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			//$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			//$section->addTextBreak(1);
			
			$section->addText("Me permito reiterarle el n�mero de la cuenta para consignaci�n de los t�tulos judiciales producto de la medida de embargo ordenada dentro del proceso que a continuaci�n de relaciona,", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 7){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";     $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";     $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "CUENTA    : ";     $campofila2 ="170012041800";}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
			
			$section->addText("En lo sucesivo y a partir de la recepci�n de este oficio, deben ser consignados a la cuenta antes relacionada tal y como le fue comunicado mediante el oficio ".$parte0,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("El incumplimiento a lo aqu� ordenado, la retenci�n y no consignaci�n a tiempo de los dineros descontados, lo har� acreedor a las sanciones contempladas en el art. 593 numeral 9 del C�digo General del Proceso",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo,",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		//SI ES TIPO (Oficio General)
		 if($datos0c == 42){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
			//$parte2       = $datospartesB[3];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			//$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("ASUNTO: ".$datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText($parte0, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Cordial saludo,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi6,$fontStyleB, $paraStyleB2);
			$section->addText("Coordinadora",$fontStyleB, $paraStyleB2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		
		//SI ES TIPO (Oficio Acumulacion de Embargo)
		if($datos0c == 82){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%d %B de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
		
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			$section->addText("Se adjunta original del oficio No. ".$parte4." que corresponde a lo ordenado en auto de fecha ".$fechaauto.", para que se tenga en cuenta en el siguiente proceso en virtud a la", $fontStyleB, $paraStyleB2);
			$section->addText("ACUMULACION DE EMBARGO", $fontStyleC, $paraStyleC2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";        $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";     $campofila2 = $parte2;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 3){$campofila = "RADICACI�N: ";     $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(1);
			
			$section->addText("NOTA: ".$parte5,$fontStyleB, $paraStyleB2);
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			//$section->addText("Lo anterior para fines pertinentes.,",$fontStyleB, $paraStyleB2);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO (Oficio Comunicacion Embargo de Acciones)
		if($datos0c == 84){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			
		
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: ";      $campofila2 =$dator4;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			
		
			$section->addText("Por medio del presente, me permito comunicarle que por auto de fecha ".$fechaauto.", proferido dentro del proceso de la referencia, se decret� como medida cautelar el embargo y retenci�n de las acciones representativas de capital que se encuentra en cabeza del (a) demandado (a) dentro de esta sociedad.", $fontStyleB, $paraStyleB2);
			
			$section->addText("De conformidad con el art. 593 numeral 7. del C. General del Proceso, se le advierte que no podr� registrar ninguna transferencia o gravamen de dicho inter�s, ni reforma de la sociedad que implique la exclusi�n del (a) socio (a) o la disminuci�n de sus derechos en ella.", $fontStyleB, $paraStyleB2);
			
			$section->addText("Se le hace saber que el embargo se extiende a los dividendos, utilidades, intereses y dem�s beneficios que al derecho embargado correspondan.", $fontStyleB, $paraStyleB2);
			
			$section->addText("Dentro de los cinco (5) d�as siguientes al recibo de la comunicaci�n deber� informar por escrito sobre la efectividad o no de la medida.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Si le ha notificado con anterioridad otro embargo, explicar en qu� fecha, para qu� proceso y por orden de qu� autoridad.",$fontStyleB, $paraStyleB2);
			
			/*$section->addText("Los dineros retenidos deber�n ser puestos a disposici�n de la OFICINA DE EJECUCION CIVIL MUNICIPAL DE MANIZALES, en la cuenta No. 170012041800 en el BANCO AGRARIO DE COLOMBIA cuenta de Dep�sitos Judiciales, C�digo 1803 y para el proceso citado. Los embargos subsistir�n hasta que se le comunique su cancelaci�n.",$fontStyleB, $paraStyleB2);
			
			$section->addText("La no contestaci�n de este oficio oportunamente o no hacer las retenciones y consignaciones ordenadas acarrear� las sanciones de ley y la obligaci�n solidaria de cancelar personal y directamente las sumas de dinero que indebidamente deje de descontar.",$fontStyleB, $paraStyleB2);
			
			$section->addText("NOTA IMPORTANTE en todas las consignaciones se debe indicar el n�mero de Radicaci�n con los 23 d�gitos, el  nombre y la identificaci�n de las partes.",$fontStyleB, $paraStyleB2);*/
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		//SI ES TIPO (Oficio Embargo del Credito)
		if($datos0c == 85){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			
			
			$section->addText("OFICIO No. ".$datos1, $fontStyleB, $paraStyleB2);
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$section->addText(ucwords($fecha),$fontStyleB, $paraStyleB2);
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));

			
			$section->addTextBreak(1);
			
			$section->addText($datos2,$fontStyleB, $paraStyleB2);
			$section->addText($datos3,$fontStyleB, $paraStyleB2);
			$section->addText($datos4,$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos5, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datos6,$fontStyleD, $paraStyleD2);
			
			$section->addTextBreak(1);
			
			$section->addText("Me permito comunicarle que por auto de fecha ".$fechaauto.", proferido por el ".$dator8." dictado dentro del proceso que se relaciona a continuaci�n, se decret� el embargo del cr�dito que persigue el (la) aqu� demandado (a);", $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//$section->addText("RADICADO: ".$dator9,$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 6){
			
				if($conttabla == 0){$campofila = "RADICADO: ";       $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";        $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: ";     $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: ";     $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "DOCUMENTO: ";      $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			

			//----------------------------------------------------------------------------------------------------------------------
		
			$section->addTextBreak(1);
			
			//SOLO PARA PRUEBA DE COLOR--------------
			//$section->addText($parte1, $fontStyleP);
			//----------------------------------------
		
			$section->addText("Tal medida producir� efectos en el siguiente proceso que se tramita en ese Despacho Judicial:",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			while($conttabla < 4){
			
				if($conttabla == 0){$campofila = "PROCESO: ";     $campofila2 = $parte1;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";  $campofila2 = $dator5;}
				//if($conttabla == 3){$campofila = "DOCUMENTO: ";      $campofila2 =$dator2;}
				if($conttabla == 2){$campofila = "DEMANDADOS: "; $campofila2 =$parte2;}
				if($conttabla == 3){$campofila = "RADICACI�N: "; $campofila2 =$parte3;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
			}
			
			//----------------------------------------------------------------------------------------------------------------------
			
			$section->addTextBreak(1);
			
			$section->addText("Favor informar si procede o no la medida solicitada.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText("Atentamente,",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
			$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
			
		}
		
		
		
		
		
		//************************************************FIN OFICIOS*********************************************************************
		
	}//FIN IF SI ES DOCUMENTO OFICIO
	
	//************************************************COMISORIOS*********************************************************************
	
	//SI ES TIPO Comisorio Secuestro Inmueble
	if($datos0c == 10){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		//$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de Secuestro del bien inmueble dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "MATRICULA : "; $campofila2 =$parte1;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 40 del C�digo General del Proceso.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia del escrito de la parte pertinente donde aparecen los linderos del bien, copia del auto por medio del cual se comisiona y copia del certificado de tradici�n.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte2,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Secuestro Mueble
	if($datos0c == 11){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		//$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de SECUESTRO sobre los bienes muebles denunciados como de propiedad de la demandada dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "DIRECCION: "; $campofila2 =$parte2;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 40 del C�digo General del Proceso, adem�s, que debe proceder a presentar la cauci�n a que est� obligado.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia del escrito de la solicitud de medidas y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte1,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Secuestro Vehiculo
	if($datos0c == 12){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		//$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de SECUESTRO sobre el veh�culo automotor dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "PLACA     : "; $campofila2 =$parte1;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 40 del C�digo General del Proceso, adem�s, que debe proceder a presentar la cauci�n a que est� obligado, dentro de los 5 d�as siguientes al de la realizaci�n de la diligencia.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia del escrito de la solicitud de la medida, copia del auto por medio del cual se comisiona y copia del certificado de tradici�n.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte2,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Secuestro Establecimiento de comercio
	if($datos0c == 14){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		$parte3 = $datospartesB[3];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n y de conformidad con el Art. 682 del C. De P. Civil, fue Usted comisionado para efectos de llevar a cabo la diligencia de SECUESTRO del Establecimiento de comercio como unidad de explotaci�n econ�mica denominado ".$parte1." descrito en el memorial petitorio de las medidas,",$fontStyleB, $paraStyleB2);
		
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "DIRECCION : "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 40 del C�digo General del Proceso, adem�s, que debe proceder a presentar la cauci�n a que est� obligado, dentro de los 5 d�as siguientes al de la realizaci�n de la diligencia.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia del escrito de la parte pertinente de las medidas, copia del auto por medio del cual se comisiona, y copia del certificado de la C�mara de Comercio.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte3,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Entrega Inmueble
	if($datos0c == 13){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		$parte3 = $datospartesB[3];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ENTREGA del bien inmueble debidamente embargado y secuestrado, sin ACEPTAR OPOSICION ALGUNA ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "MATRICULA : "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		//$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 34 del C. De P. Civil.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia de la diligencia de secuestro, copia de la diligencia de remate y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte3,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Entrega Inmueble
	if($datos0c == 32){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		$parte3 = $datospartesB[3];
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ENTREGA del Veh�culo debidamente embargado y secuestrado, sin ACEPTAR OPOSICION ALGUNA ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "PLACA     : "; $campofila2 =$parte2;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		//$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 34 del C. De P. Civil.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia de la diligencia de secuestro, copia de la diligencia de remate y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte3,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Entrega Mueble
	if($datos0c == 33){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ENTREGA de los bienes muebles debidamente embargados y secuestrados, sin ACEPTAR OPOSICION ALGUNA ".$parte1." dentro del proceso que a continuaci�n se relaciona",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 5){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		//$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 34 del C. De P. Civil.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia de la diligencia de secuestro, copia de la diligencia de remate y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte2,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Entrega a Secuestre
	if($datos0c == 34){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		$parte3 = $datospartesB[3];
		
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n fue Usted comisionado para efectos de llevar a cabo la diligencia de ENTREGA ".$parte1." debidamente embargado y secuestrado, sin ACEPTAR OPOSICION ALGUNA, al nuevo secuestre dentro del proceso:",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 5){$campofila = "PLACA/MATRICULA: "; $campofila2 =$parte2;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		//$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 34 del C. De P. Civil.",$fontStyleB, $paraStyleB2);
		
		$section->addText("ANEXOS: Copia de la diligencia de secuestro y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte3,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	//SI ES TIPO Comisorio Recepcion de Testimonios
	if($datos0c == 81){
	
		$datospartesB = explode("//////",$datospartes);
		$parte1 = $datospartesB[1];
		$parte2 = $datospartesB[2];
		$parte3 = $datospartesB[3];
		$parte4 = $datospartesB[4];
		
	
		$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>60, 'align'=>'center'));
		//fecha
		$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);
		
		$section->addText($dator8,$fontStyleA, $paraStyleA2);
		$section->addText("AL",$fontStyleA, $paraStyleA2);
		$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n y como prueba solicitada por la parte ".$parte1.", fue Usted comisionado para efectos de llevar a cabo la diligencia de Recepci�n de Testimonios mediante video conferencia (art. 171 y 212 del C. G. del P.) de las personas que se enuncian mediante auto que se anexa:",$fontStyleB, $paraStyleB2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 6){
	
				if($conttabla == 0){$campofila = "PROCESO: ";      $campofila2 = $dator6;}
				if($conttabla == 1){$campofila = "DEMANDANTE: ";   $campofila2 = $dator3;}
				if($conttabla == 2){$campofila = "NIT/CEDULA: ";   $campofila2 = $dator2;}
				if($conttabla == 3){$campofila = "DEMANDADOS: ";   $campofila2 = $dator5;}
				if($conttabla == 4){$campofila = "NIT/CEDULA: ";   $campofila2 = $dator4;}
				if($conttabla == 5){$campofila = "INCIDENTANTE: "; $campofila2 = $parte2;}
				
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
				
				$conttabla = $conttabla + 1;
		}
		
		//$section->addText("FACULTADES: En cumplimiento de la comisi�n tendr� las facultades para designar de la lista oficial de auxiliares de la justicia vigente, el secuestre id�neo, posesionarlo, para relevarlo en caso de ser necesario e igualmente todas las facultades que se desprenden del Art. 34 del C. De P. Civil.",$fontStyleB, $paraStyleB2);
		
		//$section->addText("ANEXOS: Copia de la diligencia de secuestro y copia del auto por medio del cual se comisiona.",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText("ANEXOS: ".$parte3,$fontStyleB, $paraStyleB2);
		
		$section->addText("NOTA: Act�a ".$parte4,$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleB, $paraStyleB2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleB, $paraStyleB2);
		$section->addText("Secretario (OFICINA DE EJECUCION CIVIL MUNICIPAL)",$fontStyleB, $paraStyleB2);
	
	}
	
	
	//************************************************FIN COMISORIOS*********************************************************************
	
	//************************************************CARTEL DE REMATE (Inmueble,Mueble,Vehiculo)*********************************************************************
	
	//SI ES TIPO CARTEL DE REMATE INMUEBLE
	if($datos0c == 20){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		
		
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				
				if($conttabla == 8){
					
					$campofila = "BASE DEL REMATE: "; 
					
					if($dator6 == "Divisorios"){
					
						$campofila2 ="100% DEL AVALUO DEL BIEN";
					}
					else{
						$campofila2 ="70% DEL AVALUO DEL BIEN";
					}
					
					
					//$campofila2 ="70% DEL AVALUO DEL BIEN";
				}
				//if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				
				if($conttabla == 9){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "MATRICULA INMOBILIARIA: "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
		$section->addText("Los interesados podr�n hacer postura dentro de los cinco (5) d�as anteriores al remate o Llegado el d�a y la hora, los interesados deber�n presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
		$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. ".$parte6,$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}//FIN IF CARTEL DE REMATE

	
	//SI ES TIPO CARTEL DE REMATE VEHICULO
	if($datos0c == 35){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 9){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "PLACA(S): "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
		$section->addText("Los interesados podr�n hacer postura dentro de los cinco (5) d�as anteriores al remate o Llegado el d�a y la hora, los interesados deber�n presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
		$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. ".$parte6,$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO CARTEL DE REMATE MUEBLE
	if($datos0c == 36){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		//$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 14){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 9){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 10){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 11){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 12){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 13){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
		$section->addText("Los interesados podr�n hacer postura dentro de los cinco (5) d�as anteriores al remate o Llegado el d�a y la hora, los interesados deber�n presentar en sobre cerrado sus ofertas, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
		$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. ".$parte6,$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//VERSION 2
	
	//SI ES TIPO AVISO DE REMATE INMUEBLE VIRTUAL
	if($datos0c == 86){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		
		
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				
				if($conttabla == 9){
					
					$campofila = "BASE DEL REMATE: "; 
					
					if($dator6 == "Divisorios"){
					
						$campofila2 ="100% DEL AVALUO DEL BIEN";
					}
					else{
						$campofila2 ="70% DEL AVALUO DEL BIEN";
					}
					
					
					//$campofila2 ="70% DEL AVALUO DEL BIEN";
				}
				//if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "MATRICULA INMOBILIARIA: "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE VEHICULO VIRTUAL
	if($datos0c == 87){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "PLACA(S): "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE MUEBLE VIRTUAL
	if($datos0c == 88){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		//$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		$parte7 = $datospartesB[7];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	
	//VERSION 3
	
	//SI ES TIPO AVISO DE REMATE INMUEBLE VIRTUAL
	if($datos0c == 89){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		
		
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				
				if($conttabla == 9){
					
					$campofila = "BASE DEL REMATE: "; 
					
					if($dator6 == "Divisorios"){
					
						$campofila2 ="100% DEL AVALUO DEL BIEN";
					}
					else{
						$campofila2 ="70% DEL AVALUO DEL BIEN";
					}
					
					
					//$campofila2 ="70% DEL AVALUO DEL BIEN";
				}
				//if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "MATRICULA INMOBILIARIA: "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE VEHICULO VIRTUAL
	if($datos0c == 90){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "PLACA(S): "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE MUEBLE VIRTUAL
	if($datos0c == 91){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		//$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		$parte7 = $datospartesB[7];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura). ",$fontStyleF, $paraStyleF2);
		
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
		
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			//ACTUALIZA EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurara hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque  debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			//$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, El cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2);
			
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso, junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			
			//$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd) adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			//NUEVO EL PARRAFO ANTERIOR 7 DE OCTUBRE 2020
			$section->addText("Las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco, en la porter�a el oferente deber� anunciar su llegada, para que un servidor judicial de la Oficina de Ejecuci�n  baje y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los sobres sellados presentados por cada oferente y as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	
	
	//VERSION 4
	
	//SI ES TIPO AVISO DE REMATE INMUEBLE VIRTUAL
	if($datos0c == 92){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		
		
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				
				if($conttabla == 9){
					
					$campofila = "BASE DEL REMATE: "; 
					
					if($dator6 == "Divisorios"){
					
						$campofila2 ="100% DEL AVALUO DEL BIEN";
					}
					else{
						$campofila2 ="70% DEL AVALUO DEL BIEN";
					}
					
					
					//$campofila2 ="70% DEL AVALUO DEL BIEN";
				}
				//if($conttabla == 8){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "MATRICULA INMOBILIARIA: "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
			
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
		
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, el cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2); 
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE VEHICULO VIRTUAL
	if($datos0c == 93){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[5];
		$parte5 = $datospartesB[6];
		$parte6 = $datospartesB[7];
		$parte7 = $datospartesB[8];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 16){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "PLACA(S): "; $campofila2 =$parte3;}
				//if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4." Inmueble identificado con el folio de matr�cula inmobiliaria N� ".$parte3." adscrito a la Oficina De Registro de Instrumentos P�blicos de Manizales, y cuyas dem�s especificaciones se encuentran detalladas en la diligencia de secuestro y certificado de tradici�n.";}
				if($conttabla == 14){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 15){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
			
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
		
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, el cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2); 
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//SI ES TIPO AVISO DE REMATE MUEBLE VIRTUAL
	if($datos0c == 94){
	
		$datospartesB = explode("//////",$datospartes);
		$parte0 = $datospartesB[1];
		$parte1 = $datospartesB[2];
		$parte2 = $datospartesB[3];
		//$parte3 = $datospartesB[4];
		$parte4 = $datospartesB[4];
		$parte5 = $datospartesB[5];
		$parte6 = $datospartesB[6];
		$parte7 = $datospartesB[7];
		

		//$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
		
		$section->addText("REPUBLICA DE COLOMBIA",$fontStyleE, $paraStyleE2);
		//logo
		$section->addImage('views/images/escudo.jpg', array('width'=>73, 'height'=>40, 'align'=>'center'));
		
		//fecha
		//$section->addText($datos1, $fontStyleA, $paraStyleA2);
		setlocale(LC_TIME, "Spanish");
		//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
		//$section->addText(ucwords($fecha)." rad. ".$dator9,$fontStyleA, $paraStyleA2);*/
		$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
		
		$section->addText("AVISO DE REMATE",$fontStyleE, $paraStyleE2);
		
		$section->addText($dator8,$fontStyleE, $paraStyleE2);
		$section->addText("AVISA:",$fontStyleE, $paraStyleE2);
		//$section->addText($datos2." ".$datos3,$fontStyleA, $paraStyleA2);
		//$section->addText("HACE SABER:",$fontStyleA, $paraStyleA2);
		$section->addText("Que dentro del proceso que se relaciona a continuaci�n, se llevar� a cabo la diligencia de remate sobre los bienes embargados, secuestrados y avaluados:",$fontStyleF, $paraStyleF2);
		
		//$section->addTextBreak(1);
		
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
			
		while($conttabla < 15){
	
				if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2 =$dator9;}
				if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2 = $dator6;}
				if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2 =$dator3;}
				if($conttabla == 3){$campofila = "NIT/CEDULA: "; $campofila2 =$dator2;}
				if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2 =$dator5;}
				if($conttabla == 5){$campofila = "NIT/CEDULA: "; $campofila2 =$dator4;}
				if($conttabla == 6){$campofila = "FECHA DEL REMATE: "; $campofila2 =$fechaauto;}
				if($conttabla == 7){$campofila = "HORA: "; $campofila2 =$parte1;}
				if($conttabla == 8){$campofila = "LINK DE INGRESO A LA DILIGENCIA DE REMATE: "; $campofila2 =$parte7;}
				if($conttabla == 9){$campofila = "BASE DEL REMATE: "; $campofila2 ="70% DEL AVALUO DEL BIEN";}
				if($conttabla == 10){$campofila = "POSTOR H�BIL: "; $campofila2 ="QUIEN CONSIGNE PREVIAMENTE EL 40% DEL VALOR  TOTAL DEL AVALUO";}
				if($conttabla == 11){$campofila = "DURACI�N: "; $campofila2 ="UNA HORA";}
				if($conttabla == 12){$campofila = "AVALUO DEL BIEN: "; $campofila2 =$parte2;}
				if($conttabla == 13){$campofila = "DESCRIPCI�N DEL BIEN OBJETO DE REMATE: "; $campofila2 =$parte4;}
				if($conttabla == 14){$campofila = "SECUESTRE: "; $campofila2 =$parte5;}
				
				//PARAMETROS PARA LA TABLA
				$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table1 = $section->addTable('myOwnTableStyle');
				$table1->addRow($styleRow);
				//ADICIONE EL TEXTO A LAS CELDAS
				$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTB, $paraStyleTB2);
				$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2B);
				
				$conttabla = $conttabla + 1;
				
				
		}
		
		$section->addTextBreak(1);
		
		if($idjuzgado_reparto == 1){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j01ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
			
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Las dudas o comentarios relativos a la pr�ctica de la subasta, ser�n atendidas en la correspondiente videoconferencia o en el tel�fono del Oficial Mayor del Juzgado, Briyan Andrey D�az Aguirre, 3216592019, exclusivamente dentro del horario laboral de 7:30 AM A 12:00 M Y DE 1:30 PM A 5:00 P.M.",$fontStyleF, $paraStyleF2);
		
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		if($idjuzgado_reparto == 2){
		
			$section->addText("Se informa a los interesados en participar en la subasta, que la consignaci�n para hacer postura se procurar� hacerla en efectivo con el fin de allegar el t�tulo el d�a de la diligencia, quien pretenda consignar en cheque debe hacerlo con antelaci�n a la diligencia de remate con el fin de que el titulo sea remitido a tiempo por el banco Agrario, consignaci�n que deber� efectuarse en la cuenta de dep�sitos judiciales N� 170012041800",$fontStyleF, $paraStyleF2);
		
			$section->addText("Los interesados podr�n formular sus posturas dentro de los 5 d�as anteriores al remate o dentro de la hora siguiente establecida para la diligencia. En ambos casos, deber�n presentar sus ofertas mediante un mensaje de datos dirigido exclusivamente al email del juzgado, j02ejecmma@cendoj.ramajudicial.gov.co, estableciendo como asunto las palabras OFERTA REMATE seguidas del radicado del proceso. Ejemplo. OFERTA REMATE x-20xx-1xx, dicho archivo deber� ser guardado con contrase�a (ver instructivo para asignar clave a documento, el cual deber� consultarse en la p�gina de la Rama judicial en el siguiente link:",$fontStyleF, $paraStyleF2); 
			
			$section->addText("https://www.ramajudicial.gov.co/documents/12166575/46229732/Instructivo+Archivo+Protegido+Word.pdf/652eed62-67a6-4ff3-9abd-3da0a7095dbd adjuntando el email que lleve su postura, los documentos que acrediten el dep�sito del 40% del aval�o del bien.",$fontStyleF, $paraStyleF2);
			
			$section->addText("Igualmente, y a su elecci�n, considerando las circunstancias que para esa fecha se presenten en torno al acceso a las sedes judiciales, podr�n formular tambi�n sus ofertas de manera f�sica en sobre sellado, tal como se estipula en el Art�culo 14 del Acuerdo PCSJA20-11632 del 30 de septiembre de 2020, con el fin de garantizar la confidencialidad de la oferta en los t�rminos de los art�culos 450 y siguientes del C�digo General del Proceso. Junto con la postura deben enviar los documentos que acrediten el dep�sito del 40% del aval�o del bien, para adquirir en este caso el bien objeto de remate por el que pretenda postularse y el dep�sito previsto en el Art. 451 del C�digo General del Proceso (consignaci�n para hacer postura).",$fontStyleF, $paraStyleF2);
			
			$section->addText("De optarse por esta segunda v�a opcional, las ofertas se recibir�n en el Palacio de Justicia Fanny Gonz�lez Franco. Para ese efecto, en la porter�a el oferente deber� anunciar su llegada a la Oficina de Ejecuci�n Civil Municipal de Manizales, para que un servidor judicial de esta dependencia baje hasta all� y le reciba el sobre sellado.",$fontStyleF, $paraStyleF2);
		
			$section->addText("Para los efectos indicados en el Art. 450 del C�digo General del Proceso, este aviso se publicar� por una sola vez, con antelaci�n no inferior a 10 d�as, en uno de los peri�dicos de m�s amplia circulaci�n en la ciudad. EL DIA DOMINGO",$fontStyleF, $paraStyleF2);
		
			$section->addText("Se les recuerda que el link de ingreso a la Diligencia de Remate virtual lo encontrara en la parte inicial del aviso de remate identificado con �LINK DE INGRESO A LA DILIGENCIA DE REMATE, para lo cual, se utilizar� el aplicativo MICROSOFT TEAMS al que deber�n acceder todos los interesados desde la plataforma digital de su elecci�n (computador, celular, Tablet, etc�).",$fontStyleF, $paraStyleF2);
		
			$section->addText("Solo cuando haya transcurrido una hora desde el inicio de la diligencia, se proceder� a compartir con los asistentes a la reuni�n virtual, la visualizaci�n de la pantalla del computador del Juzgado para hacer apertura de manera p�blica y transparente, por primera vez, de los correos electr�nicos contentivos de las respectivas ofertas, y/o de los sobres cerrados que hubieren sido allegados f�sicamente para as� establecer las ofertas que re�nan los requisitos de ley y adjudicarse el bien al mejor postor.",$fontStyleF, $paraStyleF2);
		
			
			//DATOS ADICIONALES
			$section->addText($parte6,$fontStyleF, $paraStyleF2);
		
		}
		
		$section->addTextBreak(1);
		
		$section->addText("Cordialmente,",$fontStyleF, $paraStyleF2);
		
		$section->addTextBreak(2);
		
		$section->addText($datoofi5,$fontStyleF, $paraStyleF2);
		$section->addText("Secretario",$fontStyleF, $paraStyleF2);
	
	}
	
	//************************************************FIN CARTEL DE REMATE*********************************************************************
	
	//************************************************INICIO AUTO*********************************************************************
	
	//SI ES TIPO (Auto Agrega y Pone en Conocimiento)
	if($datos0c == 21){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			//$parte1       = $datospartesB[2];
		
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText("INFORME SECRETARIAL", $fontStyleA, $paraStyleA2);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or juez el presente proceso, anexo oficio de ".$parte0." ",$fontStyleB, $paraStyleB2);
			
			//$section->addTextBreak(1);
			
			$section->addText("S�rvase proveer.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText(ucwords("Manizales, ".$fecha),$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA, $paraStyleA2);
			$section->addText("Secretario",$fontStyleA, $paraStyleA2);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText("Visto el informe de Secretario que antecede en el presente proceso ".$dator6.", promovido por ".$dator3." en contra de ".$dator5.", Radicado No. ".$dator9.", se dispone AGREGAR Y PONER EN CONOCIMIENTO de las partes el oficio referenciado",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______";}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
					
					
					
					
		
			}
			
			
	}

	//SI ES TIPO (AUTO APRUEBA AVALUO Y  FIJA FECHA REMATE INMUEBLE)
	if($datos0c == 43){
		
			$datospartesB = explode("//////",$datospartes);
			
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			$parte5       = $datospartesB[5];
		
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$fecha_2 = strftime('%B %d de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias. Inform�ndole que se encuentra pendiente resolver solicitud de fijar fecha y hora para diligencia de remate. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//$section->addText(ucwords("Manizales, ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText("Vista la constancia que antecede, toda vez que las partes en el presente proceso ejecutivo, no objetaron el aval�o, presentado por la parte actora, el Juzgado lo APRUEBA y declara en firme, en consecuencia se dispone se�alar fecha para llevar a cabo la venta en p�blica subasta del bien inmueble identificado con folio de matr�cula inmobiliaria No.".$parte1.", previamente embargado, secuestrado y avaluado dentro de �ste proceso, de propiedad del demandado, en los t�rminos de lo indicado por el art�culo 448 del C�digo General del Proceso, con base en los siguientes datos:",$fontStyleB, $paraStyleB2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 4){
		
					
					if($conttabla == 0){$campofila = "FECHA DE REMATE: "; $campofila2 = strtoupper ($fecha_2);}
					if($conttabla == 1){$campofila = "HORA: ";            $campofila2 = $parte3;}
					if($conttabla == 2){$campofila = "BASE DEL REMATE: "; $campofila2 = $parte4;}
					if($conttabla == 3){$campofila = "DURACION: ";        $campofila2 = $parte5;}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			$section->addText("El aviso se publicar� por una sola vez, en uno de los peri�dicos de m�s amplia circulaci�n en la localidad, el listado se publicar� el d�a domingo con antelaci�n no inferior a diez (10) d�as a la fecha se�alada para el remate, una copia informal de la p�gina del diario se agregar� al expediente antes de darse inicio a la subasta.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Con la copia o la constancia de la publicaci�n del aviso, deber� allegarse los  certificados de tradici�n de los inmuebles actualizados, un (1) d�a antes a la fecha prevista para la subasta. Ello, a t�rminos de lo dispuesto por el art�culo 450 del C.G.P.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Los interesados deber�n presentar en sobre cerrado sus ofertas y el dep�sito previsto en el art�culo 451 de la misma codificaci�n.  Se le recuerda a la parte interesada que para el d�a en que se encuentra prevista la subasta de los bienes objeto de la litis, deber� estar inscrita la medida por cuenta de este Despacho.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (AGREGA Y PONE EN CONOCIMIENTO OFICIOS ORIPAM)
	if($datos0c == 44){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			$parte5       = $datospartesB[5];
			$parte6       = $datospartesB[6];
			$parte7       = $datospartesB[7];
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8)); 
			$fecha = strftime('%B %d de %Y');
			 
			$fechaoficio    = strftime('%d %B de %Y', strtotime($parte3));
			$fechaoficio_2  = strftime('%d %B de %Y', strtotime($parte6));
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del Se�or Juez las presentes diligencias, con oficio ORIPAM ".$parte1.", proveniente de la Oficina de Registro de  Instrumentos P�blicos de Manizales, a trav�s del cual nos informa la improcedencia de la medida aqu� decretada por cuanto ya se encuentra embargado por cuenta de Jurisdicci�n coactiva .S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "SUSTANCIACION No.:"; $campofila2 = $parte2;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			$section->addText("Visto el informe de secretaria que antecede, se dispone incorporar al presente proceso y poner en conocimiento de las partes, el oficio No.".$parte1.", del ".$fechaoficio.", por medio del cual informan la improcedencia de la medida respecto del inmueble identificado con folio de matr�cula ".$parte4.", y oficio  No. ".$parte5." del ".$fechaoficio_2.", por medio del cual informan que la procedencia de la medida de embargo sobre la cuota parte del inmueble con folio de matr�cula No. ".$parte7.", ambos provenientes de la Oficina de Registro de Instrumentos P�blicos, para los fines que se estimen pertinentes.",$fontStyleB, $paraStyleB2);
		
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (ACEPTA RENUNCIA PODER)
	if($datos0c == 45){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or juez las siguientes diligencias. Pendiente resolver memorial que alleg� el apoderado de la parte demandante informando su renuncia al poder. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "SUSTANCIACION No.:"; $campofila2 = $parte2;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			$section->addText("Vista la constancia que antecede, por ser procedente de conformidad con lo dispuesto en el art�culo 76 del C�digo General del Proceso, se acepta la renuncia presentada por el abogado ".$parte1." como apoderado de la parte demandante.",$fontStyleB, $paraStyleB2);
		
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (CORRE TRASLADO AVALUO COMERCIAL Y OTRO)
	if($datos0c == 46){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias. Pendiente resolver oficio que allego la apoderada de la parte actora, por medio del cual aporta el aval�o catastral del bien inmueble objeto de cautela, pero requiere que se le tenga en cuenta el aval�o comercial, S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte2,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia que antecede, y teniendo en cuenta que la apoderada de la parte actora presento el aval�o catastral como requisito de la norma y  tambi�n el aval�o comercial del bien inmueble objeto de cautela  identificado con folio de matr�cula inmobiliaria No. ".$parte1.", ejerciendo as� el derecho otorgado en el numeral 4 del art�culo 444 del C�digo General del Proceso, se dispone correr traslado a las partes por el t�rmino com�n de tres (03) d�as de conformidad con lo dispuesto en los art�culos 444 y 228 del C�digo General del Proceso.",$fontStyleB, $paraStyleB2);
		
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (ACEPTA CESION DE CREDITO AV VILLAS)
	if($datos0c == 47){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias. Pendiente resolver cesi�n del cr�dito. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA,$paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			$section->addText("SUSTANCIACION No. ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia de secretaria que antecede, procede  el Juzgado a resolver sobre la cesi�n del cr�dito hecha por ".$parte2." al ".$parte3." hecha a trav�s de documento privado debidamente autenticado.",$fontStyleB, $paraStyleB2);
			$section->addText("Examinado el documento contenido de la cesi�n del derecho de cr�dito y acreditada la representaci�n de quienes suscriben el mismo, encuentra �ste despacho que el contrato est� llamado a cumplir los efectos que la ley y las partes le atribuyen, refiriendo que la cesi�n se hace sin restricci�n ni reserva alguna y comprende la totalidad del cr�dito, intereses y costas procesales.",$fontStyleB, $paraStyleB2);
			$section->addText("En �ste orden de ideas, se tendr� como CESIONARIA de ".$parte2." al ".$parte3.", del cr�dito que se ejecuta en el proceso de la referencia, con sus garant�as y privilegios, en los t�rminos y para los efectos del negocio de la cesi�n, y por �sta misma v�a, se tendr� a la cesionaria como sucesora procesal del cedente dentro de la ejecuci�n.",$fontStyleB, $paraStyleB2);
			$section->addText("Por �ltimo se reconoce personer�a a la abogada ".$parte4.", para actuar en representaci�n del ".$parte3.", en virtud de la ratificaci�n de su mandato judicial por la CESIONARIA en la cl�usula novena del contrato de cesi�n, en los t�rminos y para los efectos del poder principal.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (CORRE TRASLADO CUENTAS FINALES SECUESTRE)
	if($datos0c == 48){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			
			
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias, inform�ndole que el secuestre allego memorial por medio del cual rinde cuentas comprobadas de su gesti�n. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia de secretaria que antecede, de conformidad con el art�culo 500 del C�digo General del Proceso, de las cuentas finales rendidas por el auxiliar de la justicia dentro del proceso de la referencia, se corre traslado a las partes por el t�rmino de diez (10) d�as para lo que consideren pertinente. Vencido dicho t�rmino se resolver� sobre los honorarios del secuestre.",$fontStyleB, $paraStyleB2);
		
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (ORDENA COMISION VEHICULO)
	if($datos0c == 49){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez  las presentes diligencias, inform�ndole que se encuentra pendiente ordenar comisionar al Inspector de Tr�nsito de la ciudad, para que lleve a cabo diligencia de secuestro sobre el veh�culo objeto de cautela. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia secretarial que antecede se dispone comisionar al Inspector de Tr�nsito de la ciudad, para que practique la diligencia de secuestro sobre el veh�culo automotor  de placas ".$parte2.", previamente embargado en el tr�mite del proceso de propiedad del demandado ".$dator5,$fontStyleB, $paraStyleB2);
			$section->addText("La autoridad comisionada, deber� designar al secuestre de la lista, notificarlo, posesionarlo, fijarle honorarios por la asistencia a la diligencia en la suma de ".$parte3." y advertirle que debe constituir cauci�n en la cuant�a de ".$parte4.", en un t�rmino de cinco (5) d�as, contados a partir del d�a siguiente al de la diligencia, so pena de hacerse acreedor a las sanciones contempladas en la ley 446 del 7 de julio de 1998.",$fontStyleB, $paraStyleB2);
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brese el respectivo exhorto junto con el cual deber� remitirse como anexos, copia de esta providencia, copia del auto que decret� la medida cautelar, copia de la demanda que contiene la solicitud de medidas y copia del certificado de tradici�n del veh�culo  donde consta la inscripci�n de la medida de embargo.",$fontStyleB, $paraStyleB2);
			$section->addText("Por �ltimo se ordena que a trav�s de la Oficina de Ejecuci�n Civil se d� tr�mite a la liquidaci�n de cr�dito presentada por el extremo activo.",$fontStyleB, $paraStyleB2);
		
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (TERMINA PROCESO POR PAGO SALARIO)
	if($datos0c == 50){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias, Pendiente resolver solicitud de terminaci�n del proceso por pago total de la obligaci�n con costas. Los bienes que se llegaren a desembargar y el remanente del producto de los embargados se encuentran embargados para otro proceso. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "INTERLOCUTORIO No.:";$campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			$section->addText("Vista la constancia que antecede, procede el Juzgado a resolver sobre la solicitud de terminaci�n del proceso, encontr�ndose que la misma cumple con las exigencias contenidas en el inciso primero del art�culo 461 del C�digo General del Proceso, en primer lugar, porque en las presentes diligencias no se ha llevado a cabo la diligencia de remate de bien alguno; en segundo lugar, el documento ha sido suscrito por la parte demandante quien act�a en nombre propio; en tercer lugar, hay referencia expresa que el pago comprende las costas procesales causadas con ocasi�n al presente cobro judicial.",$fontStyleB, $paraStyleB2);
			$section->addText("Es por lo anterior, que el Juzgado declarar� terminado el presente proceso por pago total de la obligaci�n, y ordenar� el levantamiento de todas las medidas cautelares decretadas y efectivamente practicadas dentro del tr�mite, y dispondr� sobre los dem�s ordenamientos de rigor.",$fontStyleB, $paraStyleB2);
			$section->addText("Por lo expuesto, el Juzgado Segundo de Ejecuci�n Civil Municipal de Manizales, Caldas,",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(3);
			
			$section->addText("___________________________________________",$fontStyleB, $paraStyleB2);
			$section->addText("1 ART�CULO 461. Si antes de iniciada la audiencia de remate, se presentare escrito proveniente del ejecutante o de su apoderado con facultad para recibir, que acredite el pago de la obligaci�n demandada y las costas, el juez declarar� terminado el proceso y dispondr� la cancelaci�n de los embargos y secuestros, si no estuviere embargado el remanente.",$fontStyleB, $paraStyleB2);
		
			$section->addText("RESUELVE",$fontStyleA, $paraStyleA2);
			
			$section->addText("PRIMERO: DECLARAR terminado el presente proceso por pago total de la obligaci�n con costas, por lo expuesto en la parte motiva del presente prove�do.",$fontStyleB, $paraStyleB2);
			$section->addText("SEGUNDO: LEVANTAR la siguiente medida cautelar:",$fontStyleB, $paraStyleB2);
			$section->addText("� El embargo de la quinta parte del salario previa deducci�n del salario m�nimo legal vigente que ".$parte2." devenga al servicio de ".$parte3,$fontStyleB, $paraStyleB2);
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brense la respectiva comunicaci�n.",$fontStyleB, $paraStyleB2);
			$section->addText("TERCERO: AUTORIZAR a la Oficina de Ejecuci�n Civil Municipal, para que los t�tulos existentes en favor del presente proceso sea entregado a la demandada ".$parte2.", puesto que no se encuentran embargados los remanentes.",$fontStyleB, $paraStyleB2);
			$section->addText("CUARTO: ACEPTAR la renuncia a t�rminos de notificaci�n y ejecutoria.",$fontStyleB, $paraStyleB2);
			$section->addText("QUINTO: ARCHIVAR las presentes diligencias, previa cancelaci�n de su radicado en los libros y sistema Justicia  Siglo XXI.",$fontStyleB, $paraStyleB2);
			
			$section->addText("C�MPLASE",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (RESUELVE REMANENTES SI SURTE EFECTOS)
	if($datos0c == 51){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			
					
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or juez las presentes diligencias inform�ndole que se encuentra pendiente resolver comunicaci�n de embargo de remanentes. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "INTERLOCUTORIO No.:";$campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			$section->addText("Vista la constancia de secretar�a, se dispone incorporar al plenario el anterior oficio No. ".$parte2.", a trav�s del cual nos comunica que dentro del proceso radicado bajo el n�mero ".$parte3." , se decret� la medida de embargo de los bienes que se llegaren a desembargar y el del remanente producto de los embargados al demandado en el presente proceso.  A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brese comunicaci�n al Juzgado remitente, inform�ndole que de conformidad con lo preceptuado en el art�culo 466 del C�digo General del Proceso, si es procedente aplicar dicha medida y en consecuencia SI SURTE EFECTOS.",$fontStyleB, $paraStyleB2);
			

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (REQUIERE PAGADOR)
	if($datos0c == 52){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez  las presentes diligencias, inform�ndole que se encuentra pendiente ordenar comisionar al Inspector de Tr�nsito de la ciudad, para que lleve a cabo diligencia de secuestro sobre el veh�culo objeto de cautela. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia de secretar�a, por ser procedente la solicitud de la parte demandante se ordena que por la Oficina de Ejecuci�n Civil Municipal se expida oficio requiriendo a la ".$parte2.", pagador del se�or ".$dator5.", para que informe a este Despacho Judicial el motivo por el cual no est� realizando los descuentos al se�or ".$dator5." , a favor del presente proceso, advi�rtasele que el incumplimiento no justificado a lo ordenado lo har� acreedor a las sanciones legales, especialmente: �Responder por el pago de dichos valores y multa de dos a cinco salarios m�nimos mensuales�  (arts. 44 y 593 n�m. 9 del C.G.P.)., adj�ntesele copia del escrito de solicitud de dicho requerimiento, con sus anexos.",$fontStyleB, $paraStyleB2);
	
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (DESPACHO COMISORIO DILIGENCIADO)
	if($datos0c == 53){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez  las presentes diligencias, inform�ndole que se encuentra pendiente ordenar comisionar al Inspector de Tr�nsito de la ciudad, para que lleve a cabo diligencia de secuestro sobre el veh�culo objeto de cautela. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia que antecede, se dispone incorporar al plenario, por el t�rmino y para los fines indicados en el art�culo 40 del C�digo General del Proceso, el anterior Despacho Comisorio No. ".$parte2.", procedente de la Inspecci�n Primera Urbana de Polic�a Primera Categor�a, debidamente diligenciado.",$fontStyleB, $paraStyleB2);
			$section->addText("As� mismo, requi�rase al auxiliar de la justicia designado para la presente Litis, para que dentro del t�rmino improrrogable de 5 d�as contados a partir del recibo de la comunicaci�n, constituya la cauci�n en la cuant�a indicada en la diligencia del secuestro, so pena de su relevo del cargo. Por la Oficina de Ejecuci�n Civil Municipal, l�bresele oficio.",$fontStyleB, $paraStyleB2);
	
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (FIJA HONORARIOS SECUESTRE)
	if($datos0c == 54){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias, inform�ndole el secuestre designado dentro del presente tramite solicita se le fijen honorarios por su gesti�n realizada. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia de secretaria que antecede, y teniendo en cuenta que las partes no se pronunciaron respecto del informe final rendido por el secuestre, y que el mismo presento informes mensuales de su gesti�n y tambi�n presento informes pormenorizados de su actuaci�n como tal, dando cuenta de una buena administraci�n del bien, conforme a  lo establecido en el numeral 5 del art�culo 37 del acuerdo 1518 del 2002, procede el Despacho a fijar como honorarios definitivos al se�or ".$parte2.", la suma de ".$parte3."; carga  que debe asumir la parte demandada dentro del presente tramite.",$fontStyleB, $paraStyleB2);
			
	
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (AGREGA INFORMES DE SECUESTRE)
	if($datos0c == 55){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			

			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or juez las presentes diligencias, inform�ndole que el secuestre designado para la presente Litis, acerc� informes mensuales de su gesti�n. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "SUSTANCIACION No.:"; $campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			
			$section->addText("Vista la constancia de secretar�a que antecede, el Juzgado dispone agregar al expediente y poner en conocimiento de las partes, los informes mensuales de gesti�n presentados por el secuestre actuante, donde da cuenta de la administraci�n de los bienes puestos bajo su custodia y en el cual adjunta copia de consignaci�n.",$fontStyleB, $paraStyleB2);
			

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (ORDENA COMISION INMUEBLE O MUEBLES)
	if($datos0c == 56){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias, inform�ndole el secuestre designado dentro del presente tramite solicita se le fijen honorarios por su gesti�n realizada. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia que antecede y como quiera que ya se encuentra inscrita la medida de embargo sobre el bien inmueble ".$parte2.", el Juzgado dispone comisionar a la Secretaria de Gobierno Municipal de Manizales, Caldas, para que practique la diligencia de secuestro del inmueble identificado con matricula inmobiliaria No. ".$parte2." previamente embargado en el tr�mite del proceso. La autoridad administrativa comisionada, deber� designar al secuestre de la lista, notificarlo, posesionarlo, fijarle honorarios por la asistencia a la diligencia en la suma de ".$parte3." y advertirle que debe constituir cauci�n en la cuant�a de ".$parte4.", en un t�rmino de cinco (5) d�as, contados a partir del d�a siguiente al de la diligencia, so pena de hacerse acreedor a las sanciones contempladas en la ley 446 del 7 de julio de 1998.",$fontStyleB, $paraStyleB2);
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brese el respectivo exhorto junto con el cual deber� remitirse como anexos, copia de esta providencia, copia del auto que decret� la medida cautelar, copia de la solicitud de la medida y copia del certificado de tradici�n del inmueble donde consta la inscripci�n de la medida de embargo, copia de la escritura p�blica.",$fontStyleB, $paraStyleB2);
			
	
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (FIJA FECHA REMATE VEHICULO)
	if($datos0c == 57){
		
			$datospartesB = explode("//////",$datospartes);
			//$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			$parte5       = $datospartesB[5];
			$parte6       = $datospartesB[6];
		
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha   = strftime('%B %d de %Y');
			$fecha_2 = strftime('%d %B de %Y', strtotime($parte3));  
						
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias, con solicitud para que se fije fecha y hora para diligencia de remate. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			$section->addText("Vista la constancia que antecede, se dispone se�alar fecha para llevar a cabo la venta en p�blica subasta del veh�culo previamente embargado, secuestrado y avaluado dentro de �ste proceso, identificado con placa n�mero. ".$parte2.", en los t�rminos de lo indicado por el art�culo 448 del C�digo General del Proceso, con base en los siguientes datos:",$fontStyleB, $paraStyleB2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 4){
		
					
					if($conttabla == 0){$campofila = "FECHA DE REMATE: "; $campofila2 = strtoupper ($fecha_2);}
					if($conttabla == 1){$campofila = "HORA: ";            $campofila2 = $parte4;}
					if($conttabla == 2){$campofila = "BASE DEL REMATE: "; $campofila2 = $parte5;}
					if($conttabla == 3){$campofila = "DURACION: ";        $campofila2 = $parte6;}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
			
			$section->addText("El aviso se publicar� por una sola vez, en uno de los peri�dicos de m�s amplia circulaci�n en la localidad, el listado se publicar� el d�a domingo con antelaci�n no inferior a diez (10) d�as a la fecha se�alada para el remate, una copia informal de la p�gina del diario se agregar� al expediente antes de darse inicio a la subasta.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Con la copia o la constancia de la publicaci�n del aviso, deber� allegarse un certificado de tradici�n del veh�culo actualizado, un (1) d�a antes a la fecha prevista para la subasta. Ello, a t�rminos de lo dispuesto por el art�culo 450 del C.G.P.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Los interesados deber�n presentar en sobre cerrado sus ofertas y el dep�sito previsto en el art�culo 451 de la misma codificaci�n.  Se le recuerda a la parte interesada que para el d�a en que se encuentra prevista la subasta del bien objeto de la litis, deber� estar inscrita la medida por cuenta de este Despacho.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	
	//SI ES TIPO (SUSPENDE PROCESO)
	if($datos0c == 58){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A Despacho del se�or Juez el presente proceso, con escrito presentado personalmente por las partes a trav�s del cual solicitan la suspensi�n del proceso por el t�rmino de tres (03) meses.  S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Vista la constancia secretarial que antecede, y una vez revisado el escrito de la solicitud, encuentra el Juzgado que el mismo cumple con las exigencias contenidas en el numeral segundo del art�culo 161 del C�digo General del Proceso, y por tal raz�n est� llamado a surtir efectos, raz�n por la cual, se decreta la SUSPENSI�N del presente proceso hasta el ".$fecha_suspension.".",$fontStyleB, $paraStyleB2);

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (TRASLADO DE INCIDENTE A SECUESTRE PREVIO APERTURA)
	if($datos0c == 59){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez el presente proceso, comunic�ndole que el secuestre dio respuesta al requerimiento realizado por el Despacho en cuanto a lo manifestado por la demandada visible a folio ".$parte2." del cuaderno de medidas previas, S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Teniendo en cuenta lo manifestado por la demandada y a su vez lo manifestado por el secuestre actuante dentro del presente tr�mite, se hace necesario que de conformidad con el art�culo 129 del C�digo General del Proceso, se d� traslado por el t�rmino de tres (03) d�as, previo a dar inicio al respectivo incidente.",$fontStyleB, $paraStyleB2);

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (REVOCA PODER CHEC)
	if($datos0c == 60){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez el presente proceso, inform�ndole que se encuentra pendiente por resolver revocatoria de poder.  S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Vista la constancia de secretar�a que antecede, por ser procedente la solicitud, se reconocer� personer�a para actuar al Doctor ".$parte2.", para representar los intereses de su poderdante en los t�rminos y para los efectos del poder a �l conferido, lo anterior por haberse presentado en la forma que indica el art�culo 74 del C�digo General del Proceso.",$fontStyleB, $paraStyleB2);
			
			$section->addText("Enti�ndase revocado el poder a la anterior mandataria, quien dentro de los treinta d�as siguientes a la notificaci�n de esta providencia, podr� ejercer el derecho contenido en el inciso segundo del art�culo 76 de la norma en cita.",$fontStyleB, $paraStyleB2);

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (TERMINA PROCESO HIPOTECARIO)
	if($datos0c == 61){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			
			
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las siguientes diligencias. Pendiente resolver solicitud de terminaci�n del proceso por pago total de la obligaci�n con costas. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
		
			$section->addText("Vista la constancia de secretaria que antecede, procede el Juzgado a resolver sobre la solicitud de terminaci�n del proceso, encontr�ndose que la misma cumple con las exigencias contenidas en el inciso primero del art�culo 461 del C�digo General del Proceso , en primer lugar, porque en las presentes diligencias no se ha llevado a cabo la diligencia de remate de bien alguno; en segundo lugar, el documento ha sido suscrito por el apoderado de la parte ".$parte2." quien tiene facultad para recibir; en tercer lugar, hay referencia expresa que el pago comprende las costas procesales causadas con ocasi�n al presente cobro judicial.",$fontStyleB, $paraStyleB2);
			$section->addText("Es por lo anterior, que el Juzgado declarar� terminado el presente proceso por pago total de la obligaci�n, y ordenar� el levantamiento de todas las medidas cautelares decretadas y efectivamente practicadas dentro del tr�mite, y dispondr� sobre los dem�s ordenamientos de rigor.",$fontStyleB, $paraStyleB2);
			$section->addText("Por lo expuesto, el Juzgado Segundo de Ejecuci�n Civil Municipal de Manizales, Caldas,",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(3);
			
			$section->addText("___________________________________________",$fontStyleB, $paraStyleB2);
			$section->addText("1 ART�CULO 461. Si antes de iniciada la audiencia de remate, se presentare escrito proveniente del ejecutante o de su apoderado con facultad para recibir, que acredite el pago de la obligaci�n demandada y las costas, el juez declarar� terminado el proceso y dispondr� la cancelaci�n de los embargos y secuestros, si no estuviere embargado el remanente.",$fontStyleB, $paraStyleB2);
		
			$section->addText("RESUELVE",$fontStyleA, $paraStyleA2);
			
			$section->addText("PRIMERO: DECLARAR terminado el presente proceso por pago total de la obligaci�n con costas, por lo expuesto en la parte motiva del presente prove�do.",$fontStyleB, $paraStyleB2);
			$section->addText("SEGUNDO: LEVANTAR la siguiente medida cautelar:",$fontStyleB, $paraStyleB2);
			$section->addText("� El embargo y secuestro del inmueble identificado con folio de matr�cula No. ".$parte3,$fontStyleB, $paraStyleB2);
			$section->addText("� Embargo de los remanentes y/o bienes que por cualquier causa le llegaren a desembargar al demandado ".$dator5.", en el proceso de Jurisdicci�n Coactiva que adelanta ".$parte4,$fontStyleB, $paraStyleB2);
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brense la respectiva comunicaci�n.",$fontStyleB, $paraStyleB2);
			$section->addText("TERCERO: CANCELAR la garant�a real de hipoteca, que pesa sobre el  bien inmueble identificado con matr�cula inmobiliaria No. ".$parte3,$fontStyleB, $paraStyleB2);
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brense la respectiva comunicaci�n.",$fontStyleB, $paraStyleB2);
			$section->addText("CUARTO: ORDENAR el desglose de la escritura p�blica que contiene la hipoteca con la que se garantiz� el cr�dito, la cual le ser� entregada a la parte demandada, previo el pago de las expensas necesarias para las copias que reemplazara el original desglosado.",$fontStyleB, $paraStyleB2);
			$section->addText("QUINTO: ARCHIVAR las presentes diligencias, previa cancelaci�n de su radicado en los libros y sistema Justicia  Siglo XXI.",$fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	
	//SI ES TIPO (SUSTITUYE PODER NUEVO)
	if($datos0c == 62){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			

			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or juez las presentes diligencias, inform�ndole que se encuentra pendiente de resolver sobre solicitud de sustituci�n de poder. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "SUSTANCIACION No.:"; $campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			
			$section->addText("Vista la constancia de secretar�a que antecede, por ser procedente de conformidad con lo dispuesto en el art�culo 75 del C�digo General del Proceso, se acepta la sustituci�n del poder hecha por el abogado ".$parte2." en favor del abogado ".$parte3.", y recon�zcase al segundo profesional en derecho, como mandatario judicial de la parte demandante en los t�rminos y para los efectos del poder inicialmente conferido.",$fontStyleB, $paraStyleB2);
			

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (CORRE TRASLADO AVALUO IGAC)
	if($datos0c == 63){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			//$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias, inform�ndole que del Instituto Geogr�fico Agust�n Codazzi, se  alleg� aval�o catastral del inmueble objeto de medida. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Del aval�o catastral incrementado en un cincuenta por ciento (50%) del bien inmueble identificado con matr�cula inmobiliaria No. ".$parte2.", aportado por la parte demandante, se dispone correr traslado a las partes por el t�rmino com�n de tres d�as de conformidad con lo dispuesto en los art�culos 444 y 228 del C�digo de General del Proceso. En firme el aval�o, se proceder� a fijar fecha y hora para la almoneda.",$fontStyleB, $paraStyleB2);
			
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (DECRETA MEDIDAS BANCOS)
	if($datos0c == 64){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			

			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("Mediante el Acuerdo PSAA15-10412 del 26 de Noviembre de 2015 expedido por la Sala Administrativa del Consejo Superior de la Judicatura, se dispuso crear de forma permanente, el ".$dator8.", a despacho de la se�or(a) juez(a) las presentes diligencias, inform�ndole que se encuentra pendiente de resolver solicitud de decreto de medida cautelar.  S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "INTERLOCUTORIO No.:";$campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			
			$section->addText("Vista la constancia de secretar�a que antecede, se dispone AVOCAR el conocimiento del proceso de la referencia y por ser procedente de conformidad con el art�culo 599 del C.G. del P.,  se decreta como medida cautelar dentro del proceso de la referencia, el embargo y retenci�n de los dineros que pueda llegar a tener en cuentas de ahorros, cuentas corrientes, certificados de dep�sitos a t�rmino de CDTS, el demandado ".$parte2." en los bancos relacionados en el escrito petitorio.",$fontStyleB, $paraStyleB2);
			
			$section->addText("A trav�s de la Oficina de Ejecuci�n Civil Municipal, l�brese el respectivo oficio circular con destino a las entidades bancarias mencionadas, haci�ndoles saber que el monto a embargar se restringe hasta la suma de ".$parte3,$fontStyleB, $paraStyleB2);
			

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (FIJA FECHA REMATE BIENES MUEBLES)
	if($datos0c == 65){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			$parte4       = $datospartesB[4];
			$parte5       = $datospartesB[5];
			
					
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			
			$fecha   = strftime('%B %d de %Y');
			$fecha_2 = strftime('%B %d de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias. Pendiente resolver oficio por medio del cual solicita el demandante que se fije fecha y hora para practicar diligencia de remate. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "INTERLOCUTORIO No.:";$campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			$section->addText("Vista la constancia que antecede, por ser procedente la solicitud del apoderado de la parte demandante en el presente tramite se dispone se�alar fecha para llevar a cabo la venta en p�blica subasta los bienes muebles previamente embargados, secuestrado y avaluado dentro de �ste proceso, en los t�rminos de lo indicados por el art�culo 448 del C�digo General del Proceso, con base en los siguientes datos:",$fontStyleB, $paraStyleB2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 4){
		
			
					if($conttabla == 0){$campofila = "FECHA DE REMATE: "; $campofila2 = strtoupper ($fecha_2);}
					if($conttabla == 1){$campofila = "HORA: ";            $campofila2 = $parte3;}
					if($conttabla == 2){$campofila = "BASE DEL REMATE: "; $campofila2 = $parte4;}
					if($conttabla == 3){$campofila = "DURACION: ";        $campofila2 = $parte5;}
					
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
		
			}

			$section->addText("El aviso se publicar� por una sola vez, en uno de los peri�dicos de m�s amplia circulaci�n en la localidad, el listado se publicar� el d�a domingo con antelaci�n no inferior a diez (10) d�as a la fecha se�alada para el remate, una copia informal de la p�gina del diario se agregar� al expediente antes de darse inicio a la subasta.",$fontStyleB, $paraStyleB2);
			$section->addText("La copia o la constancia de la publicaci�n del aviso, deber� allegarse, un (1) d�a antes a la fecha prevista para la subasta. Ello, a t�rminos de lo dispuesto por el art�culo 450 del C.G.P.",$fontStyleB, $paraStyleB2);
			$section->addText("Los interesados deber�n presentar en sobre cerrado sus ofertas y el dep�sito previsto en el art�culo 451 de la misma codificaci�n.  Se le recuerda a la parte interesada que para el d�a en que se encuentra prevista la subasta de los bienes objeto de la litis, deber� estar inscrita la medida por cuenta de este Despacho.",$fontStyleB, $paraStyleB2);

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO ( AGREGA DESPACHO COMISORIO SIN DILIGENECIAR)
	if($datos0c == 66){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
		
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			//$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez las presentes diligencias, inform�ndole que la Inspecci�n Segunda Urbana de Polic�a, hizo devoluci�n del despacho comisorio No. ".$parte2.", sin diligenciar. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Vista la constancia de secretar�a, se dispone incorporar al plenario el anterior despacho Comisorio No. ".$parte2." devuelto por ".$parte3.", sin diligenciar. Lo anterior, al conocimiento de las partes y fines pertinentes.",$fontStyleB, $paraStyleB2);
			
			$section->addText("De otra parte se ordena que a trav�s de la Oficina de Ejecuci�n Civil Municipal se  reexpidan nuevamente los oficios de levantamiento de la medida de embargo, que deber�n ser entregados al apoderado de la parte demandante.",$fontStyleB, $paraStyleB2);
			
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (CORRE TRASLADO DICTAMEN PERITO)
	if($datos0c == 67){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			$parte3       = $datospartesB[3];
			

			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			//$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fecha = strftime('%B %d de %Y');
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho de la se�ora juez el presente proceso, comunic�ndole que el perito designado rindi� dictamen pericial. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			//$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 5){
		
					
					if($conttabla == 0){$campofila = "PROCESO: ";          $campofila2 = $dator6;}
					if($conttabla == 1){$campofila = "DEMANDANTE: ";       $campofila2 = $dator3;}
					if($conttabla == 2){$campofila = "DEMANDADO: ";        $campofila2 = $dator5;}
					if($conttabla == 3){$campofila = "RADICADO: ";         $campofila2 = $dator9;}
					if($conttabla == 4){$campofila = "A.S.:";              $campofila2 = $parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable_auto    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow_auto = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle_auto', $styleTable_auto, $styleFirstRow_auto);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle_auto');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleB, $paraStyleB2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleB, $paraStyleB2);
					
					$conttabla = $conttabla + 1;
			}
			
		
			
			$section->addText("Teniendo en cuenta el anterior informe secretarial  se pone en conocimiento de las partes por el t�rmino de tres -3- d�as el dictamen rendido por el perito designado,".$parte2.", en el proceso de la referencia, durante este tiempo se podr� solicitar la aclaraci�n, complementaci�n o la pr�ctica de uno nuevo a costa del interesado, mediante solicitud debidamente motivada, de conformidad con el art. 228 inciso final del C�digo General del Proceso.",$fontStyleB, $paraStyleB2);
			

			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (LEVANTA MEDIDA CAUTELAR)
	if($datos0c == 68){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			//$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A Despacho del se�or Juez las presentes diligencias, inform�ndole que la apoderada judicial de la parte demandante, en coadyuvancia con el demandado, solicitaron decretar el levantamiento de una medida cautelar. S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.I.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Vista la constancia de secretar�a que antecede, y por ser procedente de conformidad con el art�culo 597 del C�digo General del Proceso toda vez que la solicitud ha sido suscrita por la apoderada Judicial de la parte demandante y al no existir tercer�as ni litisconsortes necesarios en la parte activa de la relaci�n jur�dico procesal y como no est� vigente ninguna medida de embargo de remanentes que pese sobre este proceso, ".$parte2,$fontStyleB, $paraStyleB2);
			
			$section->addText("Por la Oficina de Ejecuci�n Civil Municipal, l�brese la respectiva comunicaci�n al pagador de la Rama Judicial.",$fontStyleB, $paraStyleB2);
			
		
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//SI ES TIPO (RECONOCE PERSONERIA)
	if($datos0c == 69){
		
			$datospartesB = explode("//////",$datospartes);
			$parte1       = $datospartesB[1];
			$parte2       = $datospartesB[2];
			
	
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");

			$fecha            = strftime('%B %d de %Y');
			//$fecha_suspension = strftime('%d %B de %Y', strtotime($parte2));  
			
			$section->addTextBreak(1);
			
			$section->addText("CONSTANCIA SECRETARIAL ".$fecha, $fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			//$section->addTextBreak(1);
			
			$section->addText("A despacho del se�or Juez el presente proceso, pendiente de resolver otorgamiento del poder en extremo pasivo de la relaci�n procesal.  S�rvase proveer.",$fontStyleB, $paraStyleB2);
		
			$section->addTextBreak(1);
			
			$section->addText($datoofi5,$fontStyleA_AUTO, $paraStyleA2_AUTO);
			$section->addText("Secretario",$fontStyleA_AUTO, $paraStyleA2_AUTO);
			
			$section->addTextBreak(1);
			
			$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText(ucwords("Manizales, Caldas ".$fecha),$fontStyleA, $paraStyleA2);
			
			$section->addText($dator9,$fontStyleA, $paraStyleA2);
			
			
			$section->addTextBreak(1);
			
			$section->addText("A.S.: ".$parte1,$fontStyleB_AUTO, $paraStyleB2_AUTO);
			
			
			$section->addText("Vista la constancia de secretaria que precede, se reconocer� personer�a para actuar al abogado ".$parte2." para que represente los intereses de la parte demandada dentro del presente proceso, en los t�rminos y para los efectos del poder a �l conferido.",$fontStyleB, $paraStyleB2);
			
			
			$section->addTextBreak(2);
			
			$section->addText("NOTIF�QUESE",$fontStyleA, $paraStyleA2);
			$section->addText($dator10,$fontStyleA, $paraStyleA2);
			$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(1);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
			
			//PARAMETROS PARA LA TABLA
			$styleTable_CUADRO    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderTopColor'=>'000000','borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow_CUADRO = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
			//ESTILO DE LA CELDA
			$styleCell_CUADRO = array('valign'=>'center');
			
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle_CUADRO', $styleTable_CUADRO, $styleFirstRow_CUADRO);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table_CUADRO = $section->addTable('myOwnTableStyle_CUADRO');
						
			while($conttabla < 7){
		
					if($conttabla == 0){$campofila = $dator8;}
					if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
					if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
					if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
					if($conttabla == 4){$campofila = "No.  _________ del  ______ ".date('Y');}
					if($conttabla == 5){$campofila = $datoofi5;}
					if($conttabla == 6){$campofila = "Secretario"; $campofila2 =$parte0;}
					
			
					
					//$table_CUADRO->addRow($styleRow);
					
					$table_CUADRO->addRow();
					
					//ADICIONE EL TEXTO A LAS CELDAS
					$table_CUADRO->addCell(4000, $styleCell_CUADRO)->addText($campofila,$fontStyleTC, $paraStyleTC2);
					//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
					
					$conttabla = $conttabla + 1;
		
			}
			
			
	}
	
	//************************************************FIN AUTOS*********************************************************************
	
	//SI ES TIPO (Traslado Mediante Fijacion en Lista)
	if($datos0c == 22){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			$parte5       = $datospartesB[6];
			$parte6       = $datospartesB[7];
		
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
			
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText("TRASLADO MEDIANTE FIJACION EN LISTA",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 8){
		
					if($conttabla == 0){$campofila = "RADICADO: ";      $campofila2 = $dator9;}
					if($conttabla == 1){$campofila = "PROCESO: ";       $campofila2 = $dator6;}
					if($conttabla == 2){$campofila = "DEMANDANTE: ";    $campofila2 = $dator3;}
					if($conttabla == 3){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator2;}
					if($conttabla == 4){$campofila = "DEMANDADOS: ";    $campofila2 = $dator5;}
					if($conttabla == 5){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator4;}
					if($conttabla == 6){$campofila = "FECHA ESCRITO: "; $campofila2 = $fechaauto;}
					/*if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "DOS (2) DIAS Art. 349 Y 108 DEL C.P.C. ".$parte1;}*/
					if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "TRES (3) DIAS Art. 319 Y 110 DEL CODIGO GENERAL DEL PROCESO. ".$parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
					
					$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(2);
			
			$section->addText("A LA PARTE ".$parte2." EN EL PRESENTE PROCESO SE LE CORRE TRASLADO DEL ANTERIOR ESCRITO PRESENTADO POR EL SE�OR (A) ".$parte3.", MEDIANTE EL CUAL PRESENTA RECURSO DE REP�SICION ".$parte5, $fontStyleB, $paraStyleB2);
			
			$section->addText("FECHA FIJACION: ".$parte4."   HORA: ".$parte6, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(3);
			
			$section->addText($datoofi5,$fontStyleA, $paraStyleA2);
			$section->addText("Secretario",$fontStyleA, $paraStyleA2);
			
			
			
			
	}
	
	
	
	//SI ES TIPO (Traslado General 110)
	if($datos0c == 83){
		
			$datospartesB = explode("//////",$datospartes);
			$parte0       = $datospartesB[1];
			$parte1       = $datospartesB[2];
			$parte2       = $datospartesB[3];
			$parte3       = $datospartesB[4];
			$parte4       = $datospartesB[5];
			
			//fecha, FUNCION -->ucwords � Convierte a may�sculas el primer caracter de cada palabra en una cadena
			setlocale(LC_TIME, "Spanish");
			$fecha = strftime('%B %d de %Y', strtotime($datos8));  
			$fechaauto  = strftime('%B %d de %Y', strtotime($parte0));
			
			$section->addTextBreak(1);
			
			$section->addText($datoofi1, $fontStyleA, $paraStyleA2);
			
			//logo
			$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
			
			$section->addText($dator8,$fontStyleA, $paraStyleA2);
			
			$section->addText("TRASLADO MEDIANTE FIJACION EN LISTA",$fontStyleA, $paraStyleA2);
			
			$section->addTextBreak(2);
			
			//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
			$conttabla = 0;
				
			while($conttabla < 8){
		
					if($conttabla == 0){$campofila = "RADICADO: ";      $campofila2 = $dator9;}
					if($conttabla == 1){$campofila = "PROCESO: ";       $campofila2 = $dator6;}
					if($conttabla == 2){$campofila = "DEMANDANTE: ";    $campofila2 = $dator3;}
					if($conttabla == 3){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator2;}
					if($conttabla == 4){$campofila = "DEMANDADOS: ";    $campofila2 = $dator5;}
					if($conttabla == 5){$campofila = "NIT/CEDULA: ";    $campofila2 = $dator4;}
					if($conttabla == 6){$campofila = "FECHA ESCRITO: "; $campofila2 = $fechaauto;}
					/*if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "DOS (2) DIAS Art. 349 Y 108 DEL C.P.C. ".$parte1;}*/
					if($conttabla == 7){$campofila = "TRASLADO 	: ";    $campofila2 = "TRES (3) DIAS ART. ".$parte4." Y 110 DEL CODIGO GENERAL DEL PROCESO. ".$parte1;}
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleC, $paraStyleC2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleC, $paraStyleC2);
					
					$conttabla = $conttabla + 1;
			}
			
			$section->addTextBreak(2);
			
			//$section->addText("A LA PARTE ".$parte2." EN EL PRESENTE PROCESO SE LE CORRE TRASLADO DEL ANTERIOR ESCRITO PRESENTADO POR EL SE�OR (A) ".$parte3.", MEDIANTE EL CUAL PRESENTA RECURSO DE REP�SICION ".$parte5, $fontStyleB, $paraStyleB2);
			
			$section->addText("FECHA FIJACION: ".$parte2."   HORA: ".$parte3, $fontStyleB, $paraStyleB2);
			
			$section->addTextBreak(3);
			
			$section->addText($datoofi5,$fontStyleA, $paraStyleA2);
			$section->addText("Secretario",$fontStyleA, $paraStyleA2);
			
			
			
			
	}
	
	
	
	//SI ES TIPO DOCUMENTO (Caratula)
	if($datos0c == 39){
	
	
		$serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
		 if( $conn ) { 
			// echo "Conectado a la Base de Datoss.<br />"; 
		 }
		 else{ 
			echo "NO se puede conectar a la Base de Datoss.<br />"; 
			die( print_r( sqlsrv_errors(), true)); 
		 }
		
		
		//CONVERT(nvarchar(20),t103.A103FECHPROC) AS A103FECHPROC	
		
		//CIERRO ESTA SQL YA QUE EL NOMBRE DEL JUSGADO ORIGEN LO CAPTURO DE LA TABLA T101DAINFOPONE
		//NO COMO LO ESTABA CONSTRUYENDO AUNQUE TAMBIEN FUNCIONA PERO AL GENERAR EL WORD SE DEBE TENER CUIDADO CON EL JUZGADO ORIGEN
		
		/*$sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
		         t053.A053DESCCLAS,
		         t51.A051DESCENTI,
				 t62.A062DESCESPE,
	             t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				 FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				 LEFT JOIN T051BAENTIGENE t51 ON t51.A051CODIENTI = t103.A103ENTIRADI)
				 LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				 LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				 WHERE A103LLAVPROC ='$dator9'");*/
				 
		$sql = (" SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
				  t053.A053DESCCLAS,
				  t101.A101NOMBPONE,
				  t62.A062DESCESPE,
				  t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				  FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
								 
				  LEFT JOIN T101DAINFOPONE t101 ON (t101.A101CODICIUD = t103.A103CODICIUO 
				  AND t101.A101CODIENTI = t103.A103CODIENTO AND t101.A101CODIESPE = t103.A103CODIESPO 
				  AND t101.A101CODINUME = t103.A103CODINUMO) 
				  AND t101.A101CODIPONE IN (9011,9021,9031,9041,9051,9061,9071,9081,9091,9101,9111,9121,9251,9261))
								 
				  LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				  LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				  WHERE t103.A103LLAVPROC = '$dator9'");
						
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
		$row_count = sqlsrv_num_rows( $stmt );
				
		if ($row_count === false){
			echo "Error in retrieveing row count. En Consulta";
		}
		else{

			while( $row = sqlsrv_fetch_array( $stmt)){
			
				$D1  = trim($row['A103LLAVPROC']);
				
				$D2  = trim($row['A103FECHPROC']);
				
				$D3  = trim($row['A053DESCCLAS']);
				
				//$D4  = trim($row['A500NOMBBCO']);
				//DESCRIPCION JUZGADO ORIGEN
				//$D4  = trim($row['A101NOMBPONE']);
				
				//DESCRIPCION JUZGADO DESTINO
				$D4  = trim($row['A103NOMBPONE']);
				
				//EJEMPLO:
				//JUZGADO  001 LABORAL MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				//$D4B = JUZGADO
				//$D10 = 001
				//$D11 = LABORAL
				//$D4C = MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				
				/*$longitud = strlen($D4);
				
				for ($i=0; $i<=$longitud ;$i++){
					
					//SE PREGUNTA SI ES ESPACIO EN BLANCO
					if( ord($D4[$i]) == 32 ){
					
						//OBTENEMOS LA CADENA HASTA DONDE ENCUENTRE EL PRIMER ESPACIO
						$D4B = substr($D4, 0, $i + 1);
						
						//OBTENEMOS LA CADENA DESPUES DEL PRIMER ESPACIO HASTA EL FINAL DE LA CADENA
						$D4C = substr($D4, $i + 1, strlen($D4));
						
						$i   = $longitud;
					}
					
				}*/
				
				
				$D9  = trim($row['A103NOMBPONE']);
				
				//CODIGO JUZGADO
				$D10 = trim($row['A103CODINUMO']);
				
				//DESCRIPCION ESPECIALIDAD
				$D11 = trim($row['A062DESCESPE']);
				
				//NOMBRE COMPLETO JUZGADO
				/*$D4  = " ";
				$D4C = explode(" ",$D4C);
				$D4  = strtoupper($D4B." ".$D10." ".$D11." ".$D4C[0]);*/
				
				//$D4  = strtoupper(trim($row['A103NOMBPONE']));
				
				//DEMANDANTE
				if(trim($row['A112CODISUJE'] == '0001')){
				
					//$D5  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D5  = trim($row['A112NUMESUJE']);
					$D6  = trim($row['A112NOMBSUJE']);
					
					$datosdemandantec .= $D5.", ";
					$datosdemandanten .= $D6.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	$D5B = " ";
						$D6B = " ";
					}
					else{
						//APODERADO
						$D5B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
				    	$D6B = trim($row['A112NOMBREPR']);
					}
				}
				
				//DEMANDADO
				if(trim($row['A112CODISUJE'] == '0002')){
				
					//$D7  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D7  = trim($row['A112NUMESUJE']);
					$D8  = trim($row['A112NOMBSUJE']);
					
					$datosdemandadoc .= $D7.", ";
					$datosdemandadon .= $D8.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	
						$D7B = " ";
						$D8B = " ";
					}
					else{
						//APODERADO
						$D7B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
						$D8B = trim($row['A112NOMBREPR']);
					}
				}
				
				
			}
				
		}
		
		//SE REALIZA ESTA COMPARACION PARA QUE EN LA CARATULA GENERADA NO SE REPITA
		//EL APODERADO, ES DECIR EL MISMO APODERADO PARA DEMANDANTE Y DEMANDADO
		//ESTA INCOSISTENCIA SE PRESENTA AL MOMENTO DE DAR INGRESO AL PROCESO EN JUSTICIA SIGLO XXI
		//YA QUE LOS USUARIOS DEL SISTEMA DEJAN EL MISMO APODERADO PARA EL DEMANDADO
		if($D5B == $D7B){
			
			$D7B = " ";
			$D8B = " ";
		}
		
		//OBTENEMOS RADICADO 17001400300619931018000  para armarlo asi 17001-40-03-006-1993-10180-00 
		//LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
		$D1A = substr($D1,0,5);
		$D1B = substr($D1,5,2);
		$D1C = substr($D1,7,2);
		$D1D = substr($D1,9,3);
		$D1E = substr($D1,12,4);
		$D1F = substr($D1,16,5);
		$D1G = substr($D1,21,2);
		
		$D1= "";
		$D1 = $D1A."-".$D1B."-".$D1C."-".$D1D."-".$D1E."-".$D1F."-".$D1G;
		

		$section->addText("Caja: _____"."   "."No orden: _____"."   "."A�o de archivo: _____",$fontStyleVAR, $paraStyleVAR);
		 
		//$section->addTextBreak(1);
		
		//logo
		//$section->addImage('views/images/encabezado4.jpg', array('width'=>599, 'height'=>200, 'align'=>'center'));
		
		//$section->addImage('views/images/logo_consejo.png', array('width'=>72, 'height'=>93, 'align'=>'center'));
		$section->addImage('views/images/encabezado.png', array('width'=>400, 'height'=>63, 'align'=>'center'));
		//$section->addText('RAMA JUDICIAL DEL PODER P�BLICO	      CONSEJO SUPERIOR DE LA JUDICATURA	       DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL        SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('RAMA JUDICIAL DEL PODER P�BLICO',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('CONSEJO SUPERIOR DE LA JUDICATURA',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		
		$section->addTextBreak(1);
		
		$section->addText($D4,$fontStyleJUZ, $paraStyleJUZ);
		
		
		$section->addTextBreak(1);
				
				
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
				
		while($conttabla < 11){
				
			if($conttabla == 0){$campofila = "No. RADICACI�N: ";       $campofila2 =$D1;}
			if($conttabla == 1){$campofila = "PROCESO: ";              $campofila2 =$D3;}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";           $campofila2 =$D6;}
			if($conttabla == 3){$campofila = "IDENTIFICACI�N: ";       $campofila2 =$D5;}
			if($conttabla == 4){$campofila = "APODERADO: ";            $campofila2 =$D6B;}
			if($conttabla == 5){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D5B;}
			if($conttabla == 6){$campofila = "DEMANDADO: ";            $campofila2 =$D8;}
			if($conttabla == 7){$campofila = "NIT/IDENTIFICACI�N: ";   $campofila2 =$D7;}
			if($conttabla == 8){$campofila = "APODERADO: ";            $campofila2 =$D8B;}
			if($conttabla == 9){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D7B;}
			if($conttabla == 10){$campofila = "RADICACI�N: ";          $campofila2 =$D2;}
					
					
			//PARAMETROS PARA LA TABLA
			$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table1 = $section->addTable('myOwnTableStyle');
			$table1->addRow($styleRow);
					
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleCRTULAB, $paraStyleCRTULAB);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleCRTULAB, $paraStyleCRTULAB);
					
			$conttabla = $conttabla + 1;
		}
				
	     $section->addTextBreak(1);
		 
		 $section->addText($D1,$fontStyleCRTULA, $paraStyleCRTULA);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("TOMO: _____"."   "."FOLIO: _____"."   "."CUADERNO: _____",$fontStyleVAR, $paraStyleVAR);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("OBSERVACIONES:",$fontStyleVAR, $paraStyleVAR);
         $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		
		 $section->addText("C�digo: CA-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);		
		//ADICIONA UNA NUEVA PAGINA
		//$section->addPageBreak();
			
			
	}
	
	
	if($idcaratulaplantilla == 39){
	
		$datos0c = $idcaratulaplantilla;
		
		$serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
		 if( $conn ) { 
			// echo "Conectado a la Base de Datoss.<br />"; 
		 }
		 else{ 
			echo "NO se puede conectar a la Base de Datoss.<br />"; 
			die( print_r( sqlsrv_errors(), true)); 
		 }
		
		
		//CONVERT(nvarchar(20),t103.A103FECHPROC) AS A103FECHPROC	
		
		//CIERRO ESTA SQL YA QUE EL NOMBRE DEL JUSGADO ORIGEN LO CAPTURO DE LA TABLA T101DAINFOPONE
		//NO COMO LO ESTABA CONSTRUYENDO AUNQUE TAMBIEN FUNCIONA PERO AL GENERAR EL WORD SE DEBE TENER CUIDADO CON EL JUZGADO ORIGEN
		
		/*$sql = ("SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
		         t053.A053DESCCLAS,
		         t51.A051DESCENTI,
				 t62.A062DESCESPE,
	             t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				 FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				 LEFT JOIN T051BAENTIGENE t51 ON t51.A051CODIENTI = t103.A103ENTIRADI)
				 LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				 LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				 WHERE A103LLAVPROC ='$idradicadocaratula'");*/
						
						
	
		$sql = (" SELECT t103.A103LLAVPROC,CONVERT(VARCHAR(10), t103.A103FECHPROC, 103) AS A103FECHPROC,t103.A103NOMBPONE,t103.A103CODINUMO,
				  t053.A053DESCCLAS,
				  t101.A101NOMBPONE,
				  t62.A062DESCESPE,
				  t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112IDENREPR,t112.A112NOMBREPR 
				  FROM ((((T103DAINFOPROC t103 LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
								 
				  LEFT JOIN T101DAINFOPONE t101 ON (t101.A101CODICIUD = t103.A103CODICIUO 
				  AND t101.A101CODIENTI = t103.A103CODIENTO AND t101.A101CODIESPE = t103.A103CODIESPO 
				  AND t101.A101CODINUME = t103.A103CODINUMO) 
				  AND t101.A101CODIPONE IN (9011,9021,9031,9041,9051,9061,9071,9081,9091,9101,9111,9121,9251,9261))
								 
				  LEFT JOIN T062BAESPEGENE t62 ON t62.A062CODIESPE = t103.A103ESPERADI)
				  LEFT JOIN T112DRSUJEPROC t112 ON t112.A112LLAVPROC = t103.A103LLAVPROC)
				  WHERE t103.A103LLAVPROC = '$idradicadocaratula'");
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
		$row_count = sqlsrv_num_rows( $stmt );
				
		if ($row_count === false){
			echo "Error in retrieveing row count. En Consulta";
		}
		else{

			while( $row = sqlsrv_fetch_array( $stmt)){
			
				$D1  = trim($row['A103LLAVPROC']);
				
				$D2  = trim($row['A103FECHPROC']);
				
				$D3  = trim($row['A053DESCCLAS']);
				
				//$D4  = trim($row['A500NOMBBCO']);
				//DESCRIPCION JUZGADO ORIGEN
				//$D4  = trim($row['A101NOMBPONE']);
				
				//DESCRIPCION JUZGADO DESTINO
				$D4  = trim($row['A103NOMBPONE']);
				
				//EJEMPLO:
				//JUZGADO  001 LABORAL MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				//$D4B = JUZGADO
				//$D10 = 001
				//$D11 = LABORAL
				//$D4C = MUNICIPAL DE PEQUE�AS CAUSAS LABORAL
				
				
				/*$longitud = strlen($D4);
				
				for ($i=0; $i<=$longitud ;$i++){
					
					//SE PREGUNTA SI ES ESPACIO EN BLANCO
					if( ord($D4[$i]) == 32 ){
					
						//OBTENEMOS LA CADENA HASTA DONDE ENCUENTRE EL PRIMER ESPACIO
						$D4B = substr($D4, 0, $i + 1);
						
						//OBTENEMOS LA CADENA DESPUES DEL PRIMER ESPACIO HASTA EL FINAL DE LA CADENA
						$D4C = substr($D4, $i + 1, strlen($D4));
						
						$i   = $longitud;
					}
					
				}*/
				
				
				$D9  = trim($row['A103NOMBPONE']);
				
				//CODIGO JUZGADO
				$D10 = trim($row['A103CODINUMO']);
				
				//DESCRIPCION ESPECIALIDAD
				$D11 = trim($row['A062DESCESPE']);
				
				//NOMBRE COMPLETO JUZGADO
				/*$D4  = " ";
				
				$D4C = explode(" ",$D4C);
				$D4  = strtoupper($D4B." ".$D10." ".$D11." ".$D4C[0]);*/
				
				//$D4  = strtoupper(trim($row['A103NOMBPONE']));
				
				//DEMANDANTE
				if(trim($row['A112CODISUJE'] == '0001')){
				
					//$D5  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D5  = trim($row['A112NUMESUJE']);
					$D6  = trim($row['A112NOMBSUJE']);
					
					$datosdemandantec .= $D5.", ";
					$datosdemandanten .= $D6.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	$D5B = " ";
						$D6B = " ";
					}
					else{
						//APODERADO
						$D5B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
				    	$D6B = trim($row['A112NOMBREPR']);
					}
				}
				
				//DEMANDADO
				if(trim($row['A112CODISUJE'] == '0002')){
				
					//$D7  = number_format(trim($row['A112NUMESUJE']), 0, ' ', '.');
					$D7  = trim($row['A112NUMESUJE']);
					$D8  = trim($row['A112NOMBSUJE']);
					
					$datosdemandadoc .= $D7.", ";
					$datosdemandadon .= $D8.", ";
					
					if(trim($row['A112NOMBREPR']) == "SIN APODERADO"){
				    	
						$D7B = " ";
						$D8B = " ";
					}
					else{
						//APODERADO
						$D7B = number_format(trim($row['A112IDENREPR']), 0, ' ', '.');
						$D8B = trim($row['A112NOMBREPR']);
					}
				}
				
				
			}
				
		}
		
		//SE REALIZA ESTA COMPARACION PARA QUE EN LA CARATULA GENERADA NO SE REPITA
		//EL APODERADO, ES DECIR EL MISMO APODERADO PARA DEMANDANTE Y DEMANDADO
		//ESTA INCOSISTENCIA SE PRESENTA AL MOMENTO DE DAR INGRESO AL PROCESO EN JUSTICIA SIGLO XXI
		//YA QUE LOS USUARIOS DEL SISTEMA DEJAN EL MISMO APODERADO PARA EL DEMANDADO
		if($D5B == $D7B){
			
			$D7B = " ";
			$D8B = " ";
		}
		
		//OBTENEMOS RADICADO 17001400300619931018000  para armarlo asi 17001-40-03-006-1993-10180-00 
		//LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
		$D1A = substr($D1,0,5);
		$D1B = substr($D1,5,2);
		$D1C = substr($D1,7,2);
		$D1D = substr($D1,9,3);
		$D1E = substr($D1,12,4);
		$D1F = substr($D1,16,5);
		$D1G = substr($D1,21,2);
		
		$D1= "";
		$D1 = $D1A."-".$D1B."-".$D1C."-".$D1D."-".$D1E."-".$D1F."-".$D1G;
		

		$section->addText("Caja: _____"."   "."No orden: _____"."   "."A�o de archivo: _____",$fontStyleVAR, $paraStyleVAR);
		 
		//$section->addTextBreak(1);
		
		//logo
		//$section->addImage('views/images/encabezado4.jpg', array('width'=>599, 'height'=>200, 'align'=>'center'));
		
		//$section->addImage('views/images/logo_consejo.png', array('width'=>72, 'height'=>93, 'align'=>'center'));
		$section->addImage('views/images/encabezado.png', array('width'=>400, 'height'=>63, 'align'=>'center'));
		//$section->addText('RAMA JUDICIAL DEL PODER P�BLICO	      CONSEJO SUPERIOR DE LA JUDICATURA	       DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL        SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('RAMA JUDICIAL DEL PODER P�BLICO',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('CONSEJO SUPERIOR DE LA JUDICATURA',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('DIRECCI�N EJECUTIVA ADMINISTRACI�N JUDICIAL',$fontStyleJUZ, $paraStyleJUZ);	    
		$section->addText('SECCIONAL MANIZALES',$fontStyleJUZ, $paraStyleJUZ);	    
		
		$section->addTextBreak(1);
		
		$section->addText($D4,$fontStyleJUZ, $paraStyleJUZ);
		
		
		$section->addTextBreak(1);
				
				
		//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
		$conttabla = 0;
				
		while($conttabla < 11){
				
			if($conttabla == 0){$campofila = "No. RADICACI�N: ";       $campofila2 =$D1;}
			if($conttabla == 1){$campofila = "PROCESO: ";              $campofila2 =$D3;}
			if($conttabla == 2){$campofila = "DEMANDANTE: ";           $campofila2 =$D6;}
			if($conttabla == 3){$campofila = "IDENTIFICACI�N: ";       $campofila2 =$D5;}
			if($conttabla == 4){$campofila = "APODERADO: ";            $campofila2 =$D6B;}
			if($conttabla == 5){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D5B;}
			if($conttabla == 6){$campofila = "DEMANDADO: ";            $campofila2 =$D8;}
			if($conttabla == 7){$campofila = "NIT/IDENTIFICACI�N: ";   $campofila2 =$D7;}
			if($conttabla == 8){$campofila = "APODERADO: ";            $campofila2 =$D8B;}
			if($conttabla == 9){$campofila = "IDENTIFICACI�N /T.P.: "; $campofila2 =$D7B;}
			if($conttabla == 10){$campofila = "RADICACI�N: ";          $campofila2 =$D2;}
					
					
			//PARAMETROS PARA LA TABLA
			$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
			//PARAMETROS DE LA FILA
			$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
			//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
			$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
			//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
			$table1 = $section->addTable('myOwnTableStyle');
			$table1->addRow($styleRow);
					
			$table1->addCell(4000, $styleCell)->addText($campofila,$fontStyleCRTULAB, $paraStyleCRTULAB);
			$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleCRTULAB, $paraStyleCRTULAB);
					
			$conttabla = $conttabla + 1;
		}
				
	     $section->addTextBreak(1);
		 
		 $section->addText($D1,$fontStyleCRTULA, $paraStyleCRTULA);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("TOMO: _____"."   "."FOLIO: _____"."   "."CUADERNO: _____",$fontStyleVAR, $paraStyleVAR);
		 
		 $section->addTextBreak(1);
				 
		 $section->addText("OBSERVACIONES:",$fontStyleVAR, $paraStyleVAR);
         $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		 $section->addText("_______________________________________________________________________",$fontStyleB, $paraStyleB2);
		
		
		$section->addText("C�digo: CA-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
				
		//ADICIONA UNA NUEVA PAGINA
		//$section->addPageBreak();
			
			
	}

	//------------------------------------------------------------------------------------------------------------------------------
	
	if($datos0c != 39){
	
	//AYUDA A IDENTIFICAR EL ID DEL DOCUMENTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
	$section->addTextBreak(1);
	$section->addText($iddoc." Fecha Registro: ".$datos8,$fontStyleIDDOC, $paraStyleIDDOC2);
	
	//pie de p�gina
	$footer = $section->createFooter();
	/*$table  = $footer->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/piedepagina.jpg', array('width'=>599, 'height'=>49, 'align'=>'right'));*/
	
	
	
	$footer->addPreserveText('Palacio de Justicia �Fanny Gonz�lez Franco� Carrera 23 No. 21 � 48 Oficina 411 E-mail: ofejcmma@cendoj.ramajudicial.gov.co, ofejcmsecma@cendoj.ramajudicial.gov.co  Tel: (6) 8879620  - Ext: 11376 -11377 Manizales - Caldas',$fontStylePie, $paraStylePie2);
	
	//*********************CODIFICACION DE FORMATOS, CON OBJETO DE CALIDAD**********
	//OFICIOS
	if($datos0c == 1){
	
		$footer->addPreserveText("C�digo: O-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 2){
	
		$footer->addPreserveText("C�digo: O-GJ-2"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 3){
	
		$footer->addPreserveText("C�digo: O-GJ-3"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 4){
	
		$footer->addPreserveText("C�digo: O-GJ-4"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 5){
	
		$footer->addPreserveText("C�digo: O-GJ-5"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 6){
	
		$footer->addPreserveText("C�digo: O-GJ-6"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 7){
	
		$footer->addPreserveText("C�digo: O-GJ-7"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 8){
	
		$footer->addPreserveText("C�digo: O-GJ-8"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 9){
	
		$footer->addPreserveText("C�digo: O-GJ-9"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 15){
	
		$footer->addPreserveText("C�digo: O-GJ-10"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 16){
	
		$footer->addPreserveText("C�digo: O-GJ-11"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 17){
	
		$footer->addPreserveText("C�digo: O-GJ-12"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 18){
	
		$footer->addPreserveText("C�digo: O-GJ-13"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 19){
	
		$footer->addPreserveText("C�digo: O-GJ-14"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 23){
	
		$footer->addPreserveText("C�digo: O-GJ-15"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 24){
	
		$footer->addPreserveText("C�digo: O-GJ-16"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 25){
	
		$footer->addPreserveText("C�digo: O-GJ-17"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 26){
	
		$footer->addPreserveText("C�digo: O-GJ-18"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 27){
	
		$footer->addPreserveText("C�digo: O-GJ-19"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 28){
	
		$footer->addPreserveText("C�digo: O-GJ-20"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 29){
	
		$footer->addPreserveText("C�digo: O-GJ-21"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 30){
	
		$footer->addPreserveText("C�digo: O-GJ-22"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 31){
	
		$footer->addPreserveText("C�digo: O-GJ-23"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 37){
	
		$footer->addPreserveText("C�digo: O-GJ-24"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 38){
	
		$footer->addPreserveText("C�digo: O-GJ-25"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 40){
	
		$footer->addPreserveText("C�digo: O-GJ-26"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 41){
	
		$footer->addPreserveText("C�digo: O-GJ-27"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 42){
	
		$footer->addPreserveText("C�digo: O-GJ-28"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	
	if($datos0c == 70){
	
		$footer->addPreserveText("C�digo: O-GJ-29"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 71){
	
		$footer->addPreserveText("C�digo: O-GJ-30"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 72){
	
		$footer->addPreserveText("C�digo: O-GJ-31"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 73){
	
		$footer->addPreserveText("C�digo: O-GJ-32"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 74){
	
		$footer->addPreserveText("C�digo: O-GJ-33"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 75){
	
		$footer->addPreserveText("C�digo: O-GJ-34"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 76){
	
		$footer->addPreserveText("C�digo: O-GJ-35"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 77){
	
		$footer->addPreserveText("C�digo: O-GJ-36"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 78){
	
		$footer->addPreserveText("C�digo: O-GJ-37"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 79){
	
		$footer->addPreserveText("C�digo: O-GJ-38"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	//COMISORIOS
	if($datos0c == 10){
	
		$footer->addPreserveText("C�digo: CO-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 11){
	
		$footer->addPreserveText("C�digo: CO-GJ-2"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 12){
	
		$footer->addPreserveText("C�digo: CO-GJ-3"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 13){
	
		$footer->addPreserveText("C�digo: CO-GJ-4"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 14){
	
		$footer->addPreserveText("C�digo: CO-GJ-5"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 32){
	
		$footer->addPreserveText("C�digo: CO-GJ-6"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 33){
	
		$footer->addPreserveText("C�digo: CO-GJ-7"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 34){
	
		$footer->addPreserveText("C�digo: CO-GJ-8"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	
	
	//AVISO DE REMATE
	if($datos0c == 20){
	
		$footer->addPreserveText("C�digo: AR-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 35){
	
		$footer->addPreserveText("C�digo: AR-GJ-2"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	if($datos0c == 36){
	
		$footer->addPreserveText("C�digo: AR-GJ-3"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	//AUTO
	if($datos0c == 21){
	
		$footer->addPreserveText("C�digo: A-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 43){
	
		$footer->addPreserveText("C�digo: A-GJ-2"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 44){
	
		$footer->addPreserveText("C�digo: A-GJ-3"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 45){
	
		$footer->addPreserveText("C�digo: A-GJ-4"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 46){
	
		$footer->addPreserveText("C�digo: A-GJ-5"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 47){
	
		$footer->addPreserveText("C�digo: A-GJ-6"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 48){
	
		$footer->addPreserveText("C�digo: A-GJ-7"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 49){
	
		$footer->addPreserveText("C�digo: A-GJ-8"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 50){
	
		$footer->addPreserveText("C�digo: A-GJ-9"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 51){
	
		$footer->addPreserveText("C�digo: A-GJ-10"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 52){
	
		$footer->addPreserveText("C�digo: A-GJ-11"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 53){
	
		$footer->addPreserveText("C�digo: A-GJ-12"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 54){
	
		$footer->addPreserveText("C�digo: A-GJ-13"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 55){
	
		$footer->addPreserveText("C�digo: A-GJ-14"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 56){
	
		$footer->addPreserveText("C�digo: A-GJ-15"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 57){
	
		$footer->addPreserveText("C�digo: A-GJ-16"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 58){
	
		$footer->addPreserveText("C�digo: A-GJ-17"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 59){
	
		$footer->addPreserveText("C�digo: A-GJ-18"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 60){
	
		$footer->addPreserveText("C�digo: A-GJ-19"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 61){
	
		$footer->addPreserveText("C�digo: A-GJ-20"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 62){
	
		$footer->addPreserveText("C�digo: A-GJ-21"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 63){
	
		$footer->addPreserveText("C�digo: A-GJ-22"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 64){
	
		$footer->addPreserveText("C�digo: A-GJ-23"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 65){
	
		$footer->addPreserveText("C�digo: A-GJ-24"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 66){
	
		$footer->addPreserveText("C�digo: A-GJ-25"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 67){
	
		$footer->addPreserveText("C�digo: A-GJ-26"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 68){
	
		$footer->addPreserveText("C�digo: A-GJ-27"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	if($datos0c == 69){
	
		$footer->addPreserveText("C�digo: A-GJ-28"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	
	
	
	//RECUROS - TRASLADO
	if($datos0c == 22){
	
		$footer->addPreserveText("C�digo: R-GJ-1"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
		
	}
	//*******************************************************************************
	
	}
	else{
	
		$datos1 = "CARATULA";
	}
	
	//$parte_radicado = $data->Obtener_Parte_Radicado($dator9);
	//$nombre_archivo = $nombre_archivo.$parte_radicado;

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$datos1.'.doc');
	$file      = 'views/word/'.$datos1.'.docx';
	$id        = $datos1.'.docx';
	

	$enlace = $file; 
	
	$enlace = 'views/word/'.$datos1.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}


//PARA DOCUMENTOS INDEPENDIENTES, ES DECIR QUE NO SE GENERAN DESDE EL MODULO DE DOCUMENTOS
if($opcion == 2){


	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data = new documentoswordModel();
	
	$anio = $data->get_ano();

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	
	
	//PARA AUTO APRUEBA LIQUIDACION
	$datos0c_independiente = $_GET['datos0c_independiente'];
	$datos0c               = $datos0c_independiente; 

	$idradicado    = $_GET['idradicado'];
	$radicado      = $_GET['radicado'];
	$idj           = $_GET['idj'];
	$fechafijacion = $_GET['fechafijacion'];
	$autoaprueba   = $_GET['autoaprueba'];
 	$fff           = $_GET['fff'];
	$fechamenosuno = $_GET['fechamenosuno'];

	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new documentoswordModel();
	
	$datosoficina = $data->Obtener_Datos_Oficina();
	
	//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
	//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
	while( $filao = $datosoficina->fetch() ){
	
			$datoofi1  = $filao[nombre];
			$datoofi2  = $filao[sigla];
			$datoofi3  = $filao[direccion];
			$datoofi4  = $filao[telefono];
			$datoofi5  = $filao[secretario];
			$datoofi6  = $filao[coordinadora];
	}
	
	
	
	
	/*$vector_datos = $data->Obtener_Datos_Documento($iddoc);
	
	//OBTENEMOS LOS DATOS DE LA CONSULTA ANTERIOR
	while( $field = $vector_datos->fetch() ){
			
			$datos0   = $field[nombre_tipo_documento];
			$datos0b  = $field[iddoc];//ID DOCUMENTO
			$datos0b2 = $field[nombre_documento];//NOMBRE DOCUMENTO
			$datos0c  = $field[iddocumento];//ID TIPO DOCUMENTO
			
			$datos1  = $field[numero];
			$datos2  = $field[nombre_dirigido];
			$datos3  = $field[nombre];
			$datos4  = $field[direccion];
			$datos5  = $field[ciudad];
			$datos6  = $field[asunto];
			$datos7  = $field[contenido];
			$datos8  = $field[fechageneracion];
			
			$datosir = $field[idradicado];
			
			$datospartes = $field[partes];

	}
	$idradicado = $datosir;*/
	
	//OBTENEMOS LOS DATOS DEL RADICADO
	$datosradicado = $data->Obtener_Datos_Radicado($idradicado);
	
	while( $filar = $datosradicado->fetch() ){
	
			$dator1  = $filar[id];
			$dator2  = $filar[cedula_demandante];
			$dator3  = $filar[demandante];
			$dator4  = $filar[cedula_demandado];
			$dator5  = $filar[demandado];
			$dator6  = $filar[claseproceso];
			$dator7  = $filar[jo];
			$dator8  = $filar[jd];
			$dator9  = $filar[radicado];
			$dator10 = $filar[juez];
	}
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMA�O OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
						//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
						'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
						
					);

	$sectionStyleCaratula = array(
									'orientation' => 'portrait',
									'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
									//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
									'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
									'borderColor' =>'#000000', 
									'borderSize'  =>2,
						
					);

	
	
	$section = $PHPWord->createSection($sectionStyle);
	
	
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center');
	
	
	$fontStyleTC  = array ('bold' => true,'size'=>7);
	$paraStyleTC2 = array ('align' => 'center');
	
	
	//PARA AUTO APRUEBA LIQUIDACION
	$fontStyleAL  = array ('bold' => true,'size'=>11);
	$paraStyleAL2 = array ('align' => 'both');
	
	$fontStyleALX  = array ('size'=>11);
	$paraStyleALX2 = array ('align' => 'both');
	
	$fontStyleALY  = array ('size'=>9);
	$paraStyleALY2 = array ('align' => 'both');
	
	
	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	/*$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezadoX2.png',  array('width'=>200, 'height'=>80, 'align'=>'center'));
	//$table->addCell(6800)->addText('Rama Judicial del Poder P�blico Oficina de apoyo para los Juzgados Civiles Municipales de Ejecuci�n de Sentencias de Manizales',$fontStyleLOGO, $paraStyleLOGO2);
	$table->addCell(3800)->addImage('views/images/encabezadoX4.png',  array('width'=>280, 'height'=>60, 'align'=>'center'));
	$table->addCell(2000)->addImage('views/images/encabezadoX3.png',  array('width'=>70, 'height'=>70, 'align'=>'center'));*/
	
	//----------------------------------------------------------------------------------------------------------------------
	
	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	
	//WORD JORGE ANDRES VALENCIA OROZCO ANEXADO EL 2 DE AGOSTO DEL 2016
	//SI ES TIPO (Auto Aprueba Liquidacion)
	if($datos0c == 1000){
			
			//APRUEBA_LIQUIDACION
			if($autoaprueba == 0){
		
				$datos1 = "APRUEBA_LIQUIDACION";
				
				setlocale(LC_TIME, "Spanish");
				$fecha = strftime('%B %d de %Y', strtotime($fechafijacion));
				$datos8 = $fecha;
				
		
				$section->addText("CONSTANCIA SECRETAR�A."." ".ucwords($datos8).".", $fontStyleAL, $paraStyleAL2);
				$section->addText("A despacho del se�or Juez las siguientes diligencias. Inform�ndole que se venci� el t�rmino de traslado de la liquidaci�n del cr�dito presentada por el apoderado de la parte demandante. S�rvase proveer.", $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText($datoofi5,$fontStyleAL, $paraStyleAL2);
				$section->addText("Secretario Oficina de Ejecuci�n",$fontStyleAL, $paraStyleAL2);
				
				$section->addTextBreak(1);
				
				$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
				//logo
				$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));
				
				// devuelve JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL
				//EN VEZ DE JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
				$dator8 = substr($dator8, 0, -13);  
				$section->addText($dator8,$fontStyleA, $paraStyleA2);
				
				//fecha
				setlocale(LC_TIME, "Spanish");
				//$fecha = strftime('%B %d de %Y', strtotime($fechafijacion)); 
				$fechafijacion_b = explode("-",$fechafijacion);
				$fechafijacion_c = $fechafijacion_b[2];
				$dia_letra       = $data-> numtoletras($fechafijacion_c,1);
				$fecha           = $dia_letra." de ".strftime('%B de %Y', strtotime($fechafijacion));
				 
				//$fecha = strftime('%d %B de %Y', strtotime($fechafijacion));
				$section->addText("Manizales, "." ".ucwords(strtolower($fecha)),$fontStyleA, $paraStyleA2);
				
				//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
				$conttabla = 0;
				
				while($conttabla < 6){
				
					if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2  = $dator9;}
					if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2  = $dator6;}
					if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2  = $dator3;}
					if($conttabla == 3){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator2;}
					if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2  = $dator5;}
					if($conttabla == 5){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator4;}
					//if($conttabla == 6){$campofila = "INTERLOCUTORIO No: ";  $campofila2 = " ";}
					
					//PARAMETROS PARA LA TABLA
					$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					//PARAMETROS DE LA FILA
					$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
					
					//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
					$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
					//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
					$table1 = $section->addTable('myOwnTableStyle');
					$table1->addRow($styleRow);
					//ADICIONE EL TEXTO A LAS CELDAS
					$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleALY, $paraStyleY2);
					$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleALY, $paraStyleY2);
					
					$conttabla = $conttabla + 1;
				}
			
				$section->addText("Vista la constancia de secretaria que antecede, por no haber sido objetada dentro del t�rmino de traslado, se imparte aprobaci�n a la liquidaci�n del cr�dito presentada por la parte demandante, de conformidad con el art�culo 446-3 del C�digo General del proceso.", $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText("NOTIF�QUESE Y C�MPLASE",$fontStyleA, $paraStyleA2);
				
				//$section->addTextBreak(1);
				
				$section->addText($dator10,$fontStyleA, $paraStyleA2);
				$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
				
				//$section->addTextBreak(1);
				
				//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
				

				//PARAMETROS PARA LA TABLA		
				$styleTable_2    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow_2 = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
				
				// Define cell style arrays
				$styleCell_2 = array('valign'=>'center');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle_2', $styleTable_2, $styleFirstRow_2);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table2 = $section->addTable('myOwnTableStyle_2');
						
				$conttabla = 0;
					
				while($conttabla < 7){
			
						if($conttabla == 0){$campofila = $dator8;}
						if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
						if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
						if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
						if($conttabla == 4){$campofila = "No.  _________ del  ______"." ".$anio;}
						if($conttabla == 5){$campofila = $datoofi5;}
						if($conttabla == 6){$campofila = "Secretario Oficina de Ejecuci�n";}
						
			
						
						$table2->addRow($styleRow);
						//ADICIONE EL TEXTO A LAS CELDAS
						$table2->addCell(4000, $styleCell_2)->addText($campofila,$fontStyleTC, $paraStyleTC2);
						//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
						
						$conttabla = $conttabla + 1;
			
				}
				
				
				
			}
			
			//MODIFICA_LIQUIDACION
			if($autoaprueba == 1){
		
				$datos1 = "MODIFICA_LIQUIDACION";
				
				setlocale(LC_TIME, "Spanish");
				$fecha = strftime('%B %d de %Y', strtotime($fechafijacion));
				$datos8 = $fecha;
				
				$fff           = strftime('%d %B de %Y', strtotime($fff));
				$fechamenosuno = strftime('%d %B de %Y', strtotime($fechamenosuno));
				
				$section->addText("INFORME SECRETARIAL",$fontStyleA, $paraStyleA2);
				
				$section->addTextBreak(1);
				
				$section->addText("En la fecha paso a Despacho del se�or Juez el proceso Radicado bajo el N� ".$dator9.", inform�ndole que el traslado de la liquidaci�n del cr�dito presentada por la parte dem�ndate, venci� el ".$fff." y que la misma fue objeto de revisi�n por parte del Contador de esta Oficina y se realiza la modificaci�n de la misma con base en la confrontaci�n de la informaci�n y lo estipulado por la  Superintendencia Financiera de Colombia, en ejercicio de sus atribuciones legales y en especial de lo dispuesto en los art�culos 11.2.5.1.1 y siguientes del Decreto 2555 de 2010.", $fontStyleALX, $paraStyleALX2);
				
				$section->addText("Manizales ".$fechamenosuno, $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText("CONSTANCIA SECRETAR�A."." ".ucwords($datos8).".", $fontStyleAL, $paraStyleAL2);
				$section->addText("A despacho del se�or Juez, las presentes diligencias inform�ndole que el profesional en contadur�a de la Oficina de Ejecuci�n hizo una revisi�n minuciosa de la liquidaci�n allegada por la parte demandante. S�rvase proveer.", $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText($datoofi5,$fontStyleAL, $paraStyleAL2);
				$section->addText("Secretario Oficina de Ejecuci�n",$fontStyleAL, $paraStyleAL2);
				
				$section->addTextBreak(1);
				
				/*$section->addText("REPUBLICA DE COLOMBIA",$fontStyleA, $paraStyleA2);
				//logo
				$section->addImage('views/images/escudo.jpg', array('width'=>93, 'height'=>70, 'align'=>'center'));*/
				
				
				// devuelve JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL
				//EN VEZ DE JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
				$dator8 = substr($dator8, 0, -13);  
				$section->addText($dator8,$fontStyleA, $paraStyleA2);
				
	
				if($idj == 1){
				
					//$section->addText("Manizales, Caldas,"." ********************************************* ",$fontStyleA, $paraStyleA2);
					
					//fecha
					setlocale(LC_TIME, "Spanish");
					//$fecha = strftime('%B %d de %Y', strtotime($fechafijacion)); 
					$fechafijacion_b = explode("-",$fechafijacion);
					$fechafijacion_c = $fechafijacion_b[2];
					$dia_letra       = $data-> numtoletras($fechafijacion_c,1);
					$fecha           = $dia_letra." de ".strftime('%B de %Y', strtotime($fechafijacion));
					
					$section->addText("Manizales, "." ".ucwords(strtolower($fecha)),$fontStyleA, $paraStyleA2);
					
			    }
				
				if($idj == 2){
				
					//fecha
					/*setlocale(LC_TIME, "Spanish");
					$fecha = strftime('%d %B de %Y', strtotime($fechafijacion));  
					$section->addText("Manizales, Caldas,"." ".ucwords($fecha),$fontStyleA, $paraStyleA2);*/
					
					
					//fecha
					setlocale(LC_TIME, "Spanish");
					//$fecha = strftime('%B %d de %Y', strtotime($fechafijacion)); 
					$fechafijacion_b = explode("-",$fechafijacion);
					$fechafijacion_c = $fechafijacion_b[2];
					$dia_letra       = $data-> numtoletras($fechafijacion_c,1);
					$fecha           = $dia_letra." de ".strftime('%B de %Y', strtotime($fechafijacion));
					
					$section->addText("Manizales, "." ".ucwords(strtolower($fecha)),$fontStyleA, $paraStyleA2);
					
					
					
			    }
				
				if($idj == 1){
				
					//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
					$conttabla = 0;
					
					while($conttabla < 6){
					
						if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2  = $dator9;}
						if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2  = $dator6;}
						if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2  = $dator3;}
						if($conttabla == 3){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator2;}
						if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2  = $dator5;}
						if($conttabla == 5){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator4;}
						//if($conttabla == 6){$campofila = "INTERLOCUTORIO No: ";  $campofila2 = " ";}
						
						//PARAMETROS PARA LA TABLA
						$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
						//PARAMETROS DE LA FILA
						$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
						
						//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
						$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
						//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
						$table1 = $section->addTable('myOwnTableStyle');
						$table1->addRow($styleRow);
						//ADICIONE EL TEXTO A LAS CELDAS
						$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleALY, $paraStyleY2);
						$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleALY, $paraStyleY2);
						
						$conttabla = $conttabla + 1;
					}
				}
				
				if($idj == 2){
				
					//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
					$conttabla = 0;
					
					while($conttabla < 7){
					
						if($conttabla == 0){$campofila = "RADICADO: ";   $campofila2  = $dator9;}
						if($conttabla == 1){$campofila = "PROCESO: ";    $campofila2  = $dator6;}
						if($conttabla == 2){$campofila = "DEMANDANTE: "; $campofila2  = $dator3;}
						if($conttabla == 3){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator2;}
						if($conttabla == 4){$campofila = "DEMANDADOS: "; $campofila2  = $dator5;}
						if($conttabla == 5){$campofila = "NIT/CEDULA: ";  $campofila2 = $dator4;}
						if($conttabla == 6){$campofila = "INTERLOCUTORIO No: ";  $campofila2 = " ";}
						
						//PARAMETROS PARA LA TABLA
						$styleTable    = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
						//PARAMETROS DE LA FILA
						$styleFirstRow = array('borderSize'=>5, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'FFFFFF', 'borderLeftColor'=>'FFFFFF', 'borderRightColor'=>'FFFFFF', 'bgColor'=>'FFFFFF');
						
						//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
						$PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
						//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
						$table1 = $section->addTable('myOwnTableStyle');
						$table1->addRow($styleRow);
						//ADICIONE EL TEXTO A LAS CELDAS
						$table1->addCell(2000, $styleCell)->addText($campofila,$fontStyleALY, $paraStyleY2);
						$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleALY, $paraStyleY2);
						
						$conttabla = $conttabla + 1;
					}
				}
				
				if($idj == 1){
				
				   //Add style definitions
				   $PHPWord->addParagraphStyle('pStyle', array('spacing'=>100));
				   $PHPWord->addFontStyle('BoldText', array('bold'=>true));
				
					//Add text elements
					$textrun   = $section->createTextRun('pStyle');
					$textrun_2 = $section->createTextRun('pStyle');
					
					//$section->addText("Vista la constancia que antecede, procede el juzgado a APROBAR la liquidaci�n del cr�dito presentada por la parte demandante, como quiera que la misma fue actualizada, teniendo en cuenta las modificaciones realizadas por el Contador de la Oficina de Ejecuci�n, liquidaci�n que deber� ser tenida en cuenta para las reliquidaciones posteriores.", $fontStyleALX, $paraStyleALX2);
					
					$textrun->addText('Vista la constancia que antecede, procede el juzgado a'." ", $fontStyleALX, $paraStyleALX2);
					$textrun->addText('APROBAR'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun->addText('la liquidaci�n del cr�dito presentada por la parte demandante, como quiera que la misma fue actualizada, teniendo en cuenta las modificaciones realizadas por el Contador de la Oficina de Ejecuci�n, liquidaci�n que deber� ser tenida en cuenta para las reliquidaciones posteriores.', $fontStyleALX, $paraStyleALX2);
					
					
					//$section->addText("SE AUTORIZAR a la oficina de ejecuci�n para que entregue a la parte demandante los t�tulos que se encuentren constituidos para este proceso sin exceder el monto de la liquidaci�n aprobada.", $fontStyleALX, $paraStyleALX2);
					
					/*$textrun_2->addText('SE AUTORIZA'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun_2->addText('a la oficina de ejecuci�n para que entregue a la parte demandante los t�tulos que se encuentren constituidos para este proceso sin exceder el monto de la liquidaci�n aprobada.', $fontStyleALX, $paraStyleALX2);*/
					
					$textrun_2->addText('AUTORIZAR'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun_2->addText('a la oficina de ejecuci�n para que entregue a la parte demandante los t�tulos que se encuentren constituidos y los que llegaran a constituir, hasta la concurrencia de la liquidaci�n de cr�dito, una vez en firme la presente providencia de conformidad a lo establecido en los art�culos 446 y 447 del CGP.', $fontStyleALX, $paraStyleALX2);
					
					
				
				}
				
				if($idj == 2){
				
			
					$section->addText("Vista la constancia que antecede, procede el juzgado a improbar la liquidaci�n del cr�dito presentada por la parte demandante, como quiera que la misma fue actualizada, teniendo la revisi�n realizada por el profesional de la oficina de ejecuci�n, liquidaci�n que deber� ser tenida en cuenta para las reliquidaciones posteriores.", $fontStyleALX, $paraStyleALX2);
					
					$section->addText("En consecuencia se dispone modificar la liquidaci�n del Cr�dito, tal como fue ordenando en el mandamiento y de pago y en el auto que ordena seguir adelante la ejecuci�n, de conformidad con la tabla de liquidaci�n anexa al presente, la cual se incorpora al auto.", $fontStyleALX, $paraStyleALX2);
					
					$section->addTextBreak(1);
					
					if($idj == 1){
						
						$section->addText("Por lo anteriormente expuesto, EL JUEZ PRIMERO CIVIL MUNICIPAL DE EJECUCION DE MANIZALES,", $fontStyleAL, $paraStyleAL2);
					}
					
					if($idj == 2){
						
						$section->addText("Por lo anteriormente expuesto, EL JUEZ SEGUNDO CIVIL MUNICIPAL DE EJECUCION DE MANIZALES,", $fontStyleAL, $paraStyleAL2);
					}
					
					$section->addTextBreak(1);
					
					$section->addText("RESUELVE",$fontStyleA, $paraStyleA2);
					
					$section->addTextBreak(1);
					
					//Add style definitions
					$PHPWord->addParagraphStyle('pStyle', array('spacing'=>100));
					$PHPWord->addFontStyle('BoldText', array('bold'=>true));
				
			
					//Add text elements
					$textrun   = $section->createTextRun('pStyle');
					$textrun_2 = $section->createTextRun('pStyle');
					$textrun_3 = $section->createTextRun('pStyle');
					
					$textrun->addText('PRIMERO: MODIFICAR'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun->addText('la liquidaci�n del cr�dito, realizada y presentada por la parte demandante, conforme a lo dicho en la parte motiva de este prove�do.', $fontStyleALX, $paraStyleALX2);
					
					$textrun_2->addText('SEGUNDO: APROBAR'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun_2->addText('la anterior liquidaci�n.', $fontStyleALX, $paraStyleALX2);
					
					$textrun_3->addText('TERCERO: AUTORIZAR'." ", 'BoldText', $fontStyleALX, $paraStyleALX2);
					$textrun_3->addText('a la oficina de ejecuci�n para que entregue a la parte demandante los t�tulos que se encuentren constituidos y los que se llegaran a constituir, hasta la concurrencia de la liquidaci�n del cr�dito, una vez en firme la presente providencia de conformidad a lo establecido en los art�culos 446 y 447 del CGP.', $fontStyleALX, $paraStyleALX2);
				
				}
				
				
				$section->addTextBreak(2);
				
				$section->addText("NOTIF�QUESE Y C�MPLASE",$fontStyleA, $paraStyleA2);
				$section->addTextBreak(2);
				$section->addText($dator10,$fontStyleA, $paraStyleA2);
				$section->addText("JUEZ",$fontStyleA, $paraStyleA2);
				
				$section->addTextBreak(2);
				
				//-------------------------PARA ADCICIONAR UNA TABLA, Y PODER TABULAR LA INFORMACION--------------------------------------------------------------------
				

				//PARAMETROS PARA LA TABLA		
				$styleTable_2    = array('borderSize'=>20, 'borderBottomColor'=>'000000', 'borderInsideHColor'=>'FFFFFF', 'borderInsideVColor'=>'FFFFFF', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
				//PARAMETROS DE LA FILA
				$styleFirstRow_2 = array('borderSize'=>20, 'borderBottomColor'=>'FFFFFF', 'borderTopColor'=>'000000', 'borderLeftColor'=>'000000', 'borderRightColor'=>'000000', 'bgColor'=>'FFFFFF');
				
				// Define cell style arrays
				$styleCell_2 = array('valign'=>'center');
				
				//APLICAR A myOwnTableStyle EL $styleTable Y $styleFirstRow
				$PHPWord->addTableStyle('myOwnTableStyle_2', $styleTable_2, $styleFirstRow_2);
				//ASIGNAR A LA $section LA TABLA, REFERIENDOME A $table1
				$table2 = $section->addTable('myOwnTableStyle_2');
						
				$conttabla = 0;
					
				while($conttabla < 7){
			
						if($conttabla == 0){$campofila = $dator8;}
						if($conttabla == 1){$campofila = "MANIZALES -- CALDAS";}
						if($conttabla == 2){$campofila = "NOTIFICACI�N POR ESTADO";}
						if($conttabla == 3){$campofila = "La providencia  anterior se notifica en el Estado";}
						if($conttabla == 4){$campofila = "No.  _________ del  ______"." ".$anio;}
						if($conttabla == 5){$campofila = $datoofi5;}
						if($conttabla == 6){$campofila = "Secretario Oficina de Ejecuci�n";}
						
			
						
						$table2->addRow($styleRow);
						//ADICIONE EL TEXTO A LAS CELDAS
						$table2->addCell(4000, $styleCell_2)->addText($campofila,$fontStyleTC, $paraStyleTC2);
						//$table1->addCell(8000, $styleCell)->addText($campofila2,$fontStyleTB, $paraStyleTB2);
						
						$conttabla = $conttabla + 1;
			
				}
				
				
				
			}
			
			$section->addTextBreak(1);
		    $section->addText("C�digo: F-LCR-01"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
			
	}
	

	//------------------------------------------------------------------------------------------------------------------------------
	
	
	
	//AYUDA A IDENTIFICAR EL ID DEL DOCUMENTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
	//$section->addTextBreak(1);
	//$section->addText($iddoc." Fecha Registro: ".$datos8,$fontStyleIDDOC, $paraStyleIDDOC2);
	
	//pie de p�gina
	//$footer = $section->createFooter();
	/*$table  = $footer->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/piedepagina.jpg', array('width'=>599, 'height'=>49, 'align'=>'right'));*/
	//$footer->addPreserveText('Palacio de Justicia �Fanny Gonz�lez Franco� Carrera 23 No. 21 � 48 Oficina 411 E-mail: ofejcmma@cendoj.ramajudicial.gov.co, ofejcmsecma@cendoj.ramajudicial.gov.co  Tel: (6) 8879620  - Ext: 11376 -11377 Manizales - Caldas',$fontStylePie, $paraStylePie2);
	
	
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$datos1.'.doc');
	$file      = 'views/word/'.$datos1.'.docx';
	$id        = $datos1.'.docx';
	
	//$datos1 = "xxxxx";
	//$objWriter->save('views/word/'.$datos1.'.doc');
	//$file      = 'views/word/'.$datos1.'.docx';
	//$id        = $datos1.'.docx';
	
	$enlace = $file; 
	
	$enlace = 'views/word/'.$datos1.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}


//PARA DOCUMENTOS REALCIONADOS CON TUTELAS Y QUE NO SE GENERAN DESDE EL MODULO DE DOCUMENTOS
if($opcion == 3){


	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data = new documentoswordModel();
	
	$anio = $data->get_ano();

	require_once ('views/PHPWord_0.6.2_Beta/PHPWord.php');
	
	// New Word Document
	//INSTANCIAMOS LA LIBRERIA
	$PHPWord = new PHPWord();
	
	
	//DATOS DOCUMENTOS TUTELAS
	$idactuacion           = $_GET['idactuacion'];
	$idpa_actuacion        = $_GET['idpa_actuacion'];
	
	$datos0c_independiente = $_GET['datos0c_independiente'];
	$datos0c               = $datos0c_independiente; 

	
	//CREAMOS EL OBJETO DATA PARA DAR USO DE LAS FUNCIONES DEL MODELO wordModel()
	$data         = new documentoswordModel();
	
	$datosoficina = $data->Obtener_Datos_Oficina();
	
	//OBTENEMOS LOS DATOS DE LA OFICINA, PARA SER UTILIZADOS EN EL DOCUMENTO
	//COMO NOMBRE DE LA OFICINA, SECRETARIO ETC...
	while( $filao = $datosoficina->fetch() ){
	
			$datoofi1  = $filao[nombre];
			$datoofi2  = $filao[sigla];
			$datoofi3  = $filao[direccion];
			$datoofi4  = $filao[telefono];
			$datoofi5  = $filao[secretario];
			$datoofi6  = $filao[coordinadora];
	}
	
	
	//OBTENEMOS LOS DATOS DE LA ACTUACION DE TUTELA
	$datosactuaciontutela = $data->Obtener_Datos_Actuacion_Tutela($idactuacion);
	
	
	while( $filaT = $datosactuaciontutela->fetch() ){
	
			$datoT1  = $filaT[id];
			$datoT2  = $filaT[radicado];
			$datoT3  = $filaT[nombre];
			$datoT3B = $filaT[idjuzgado];
			$datoT4  = $filaT[accionante_accionado_vinculado];
			$datoT5  = $filaT[esaccionante_accionado_vinculado];
			$datoT6  = $filaT[actuacion];
			$datoT7  = $filaT[medio];
			$datoT8  = $filaT[esoficio_telegrama];
			$datoT9  = $filaT[oficio_telegrama];
			$datoT10 = $filaT[direccion];
			$datoT11 = $filaT[departamento];
			$datoT12 = $filaT[municipio];
			$datoT13 = $filaT[notificado];
			$datoT14 = $filaT[fecha_envio];
			$datoT15 = $filaT[tipo_actuacion];
			$datoT16 = $filaT[descripcion];
			$datoT17 = $filaT[encabezado_1];
	}
	
	//NOMBRE ARCHIVO A DESCARGAR
	$datos1 = $datoT8."_".$datoT9;
	
	//OBTENEMOS LOS DATOS DEL JUZGADO DE EJECUCION
	$datosje = $data->Obtener_Datos_Juzgado_Ejecucion($datoT3B);
	
	
	while( $filaje = $datosje->fetch() ){
	
			$datoJE1  = $filaje[direccion];
			$datoJE2  = $filaje[telefono];
			$datoJE3  = $filaje[correo];
			
	}
	
	//OBTENEMOS ENCABEZADO_1 DE LA TABLA pa_actuacion SEGUN ID ACTUACION
	$datosje = $data->Obtener_Datos_Juzgado_Ejecucion($datoT3B);
	
	
	while( $filaje = $datosje->fetch() ){
	
			$datoJE1  = $filaje[direccion];
			$datoJE2  = $filaje[telefono];
			$datoJE3  = $filaje[correo];
			
	}
	
	//EMPEZAMOS LA GENERACION DEL DOCUMENTO 
	//ORIENTACION HORIZONTAL Y TAMA�O OFICIO
	//SI NO SE DEFINE pageSizeW - pageSizeH
	//TOMA EL VALOR DE CARTA A4  11906 - 16838
	$sectionStyle = array(
						'orientation' => 'portrait',
						'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
						//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
						'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
						
					);

	$sectionStyleCaratula = array(
									'orientation' => 'portrait',
									'pageSizeW'   => '12241',    //----> OFICIO 216 X 330 mm
									//'pageSizeH'   => '20160', //----> OFICIO 216 X 356 mm
									'pageSizeH'   => '18720',  //----> OFICIO 216 X 330 mm
									'borderColor' =>'#000000', 
									'borderSize'  =>2,
						
					);

	
	
	$section = $PHPWord->createSection($sectionStyle);
	
	
	
	//--------------------ESTILOS A USAR EN EL DOCUMENTO------------------------------------------------------------------------------------
	
	$fontStyleA  = array ('bold' => true,'size'=>11);
	$paraStyleA2 = array ('align' => 'center','spaceAfter'=>0.0);
	
	$fontStyleB  = array ('bold' => false,'size'=>11);
	$paraStyleB2 = array ('align' => 'center');
	
	$fontStyleC  = array ('bold' => true,'size'=>11);
	$paraStyleC2 = array ('align' => 'right','spaceAfter'=>0.0);
	
	$fontStyleTC  = array ('bold' => true,'size'=>7);
	$paraStyleTC2 = array ('align' => 'center');
	
	
	//PARA AUTO APRUEBA LIQUIDACION
	$fontStyleAL  = array ('bold' => true,'size'=>11);
	$paraStyleAL2 = array ('align' => 'both','spaceAfter'=>0.0);
	
	$fontStyleALX  = array ('size'=>11);
	$paraStyleALX2 = array ('align' => 'both','spaceAfter'=>0.0);
	
	$fontStyleALY  = array ('size'=>9);
	$paraStyleALY2 = array ('align' => 'both');
	
	
	

	//-----------------------------ENCABEZADO DEL DOCUMENTO-----------------------------------------------------------------
	/*$header = $section->createHeader();
	$table  = $header->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/encabezadoX2.png',  array('width'=>200, 'height'=>80, 'align'=>'center'));
	//$table->addCell(6800)->addText('Rama Judicial del Poder P�blico Oficina de apoyo para los Juzgados Civiles Municipales de Ejecuci�n de Sentencias de Manizales',$fontStyleLOGO, $paraStyleLOGO2);
	$table->addCell(3800)->addImage('views/images/encabezadoX4.png',  array('width'=>280, 'height'=>60, 'align'=>'center'));
	$table->addCell(2000)->addImage('views/images/encabezadoX3.png',  array('width'=>70, 'height'=>70, 'align'=>'center'));*/
	
	//----------------------------------------------------------------------------------------------------------------------
	
	//DOS ESPACIOS EN BLANCO ENTRE UN PARRAFO Y OTRO
	//$section->addTextBreak(2);
	
	
	//WORD JORGE ANDRES VALENCIA OROZCO ANEXADO EL 2 DE AGOSTO DEL 2016
	//SI ES TIPO (Auto Aprueba Liquidacion)
	if($datos0c == 1000){
			
			
		
				//$datos1 = "APRUEBA_LIQUIDACION";
				
				//$section->addText($idactuacion, $fontStyleALX, $paraStyleALX2);
				
				$section->addText("RAMA JUDICIAL DEL PODER P�BLICO", $fontStyleA, $paraStyleA2);
				
				//logo
				$section->addImage('views/images/escudo.jpg', array('width'=>120, 'height'=>120, 'align'=>'center'));
				
				$section->addText($datoT3, $fontStyleA, $paraStyleA2);
				
				$section->addText("MANIZALES"." - "."CALDAS", $fontStyleA, $paraStyleA2);
				
				$section->addText($datoJE1.", correo electr�nico: ".$datoJE3." Tel�fono: ".$datoJE2, $fontStyleB, $paraStyleB2);
				
				setlocale(LC_TIME, "Spanish");
				$fecha_envio = strftime('%B %d de %Y', strtotime($datoT14));
				
				$section->addTextBreak(0);
				
				$section->addText("OFICIO: ".$datoT9, $fontStyleC, $paraStyleC2);
				$section->addText("RADICADO: ".$datoT2, $fontStyleC, $paraStyleC2);
				$section->addText(strtoupper($fecha_envio), $fontStyleC, $paraStyleC2);
				
				$section->addTextBreak(0);
				
				$section->addText("Dirigido", $fontStyleALX, $paraStyleALX2);
				$section->addText($datoT4, $fontStyleAL, $paraStyleAL2);
				$section->addText($datoT10, $fontStyleALX, $paraStyleALX2);
				$section->addText(ucfirst(strtolower($datoT12.", ".$datoT11)), $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText(strtoupper("REF: NOTIFICACI�N ".$datoT6." ".$datoT15), $fontStyleAL, $paraStyleAL2);
				$section->addTextBreak(1);
				//$section->addText("Por conducto del presente, me permito informarle que mediante fallo de la fecha, administrando justicia en nombre de la Rep�blica y por autoridad de la Ley, se dispuso:", $fontStyleALX, $paraStyleALX2);
				$section->addText($datoT17, $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText($datoT16, $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(1);
				
				$section->addText("Cordialmente,", $fontStyleALX, $paraStyleALX2);
				
				$section->addTextBreak(3);
				
				$section->addText($datoofi5,$fontStyleA, $paraStyleA2);
				$section->addText("SECRETARIO",$fontStyleA, $paraStyleA2);
				
				
			
			//$section->addTextBreak(1);
		    //$section->addText("C�digo: F-LCR-01"."                                                                                                                   "."Versi�n: 01",$fontStyleIDDOC, $paraStyleIDDOC2);
			
	}
	

	//------------------------------------------------------------------------------------------------------------------------------
	
	
	
	//AYUDA A IDENTIFICAR EL ID DEL DOCUMENTO, PARA CUALQUIER CASO DE CORRECCION O INCONSISTENCIA
	//$section->addTextBreak(1);
	//$section->addText($iddoc." Fecha Registro: ".$datos8,$fontStyleIDDOC, $paraStyleIDDOC2);
	
	//pie de p�gina
	//$footer = $section->createFooter();
	/*$table  = $footer->addTable();
	$table->addRow();
	$table->addCell(2000)->addImage('views/images/piedepagina.jpg', array('width'=>599, 'height'=>49, 'align'=>'right'));*/
	//$footer->addPreserveText('Palacio de Justicia �Fanny Gonz�lez Franco� Carrera 23 No. 21 � 48 Oficina 411 E-mail: ofejcmma@cendoj.ramajudicial.gov.co, ofejcmsecma@cendoj.ramajudicial.gov.co  Tel: (6) 8879620  - Ext: 11376 -11377 Manizales - Caldas',$fontStylePie, $paraStylePie2);
	
	
	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
	$objWriter->save('views/word/'.$datos1.'.doc');
	$file      = 'views/word/'.$datos1.'.docx';
	$id        = $datos1.'.docx';
	
	//$datos1 = "xxxxx";
	//$objWriter->save('views/word/'.$datos1.'.doc');
	//$file      = 'views/word/'.$datos1.'.docx';
	//$id        = $datos1.'.docx';
	
	$enlace = $file; 
	
	$enlace = 'views/word/'.$datos1.'.doc'; 
	header ("Content-Disposition: attachment; filename=".$id); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace);
	
}

?>