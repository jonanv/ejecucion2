<?php

session_start(); 

if($_SESSION['id']!=""){

/*$dbhost ="localhost";
$dbname ="ejecucion";
$dbuser ="root";
$dbpass ="Ejecuc10n2014";
$db     = new mysqli($dbhost,$dbuser,$dbpass,$dbname);*/

$idusuarioX  = $_SESSION['idUsuario'];

include_once('Conexionpopupbox.php');
include_once('Funciones.php');
//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
require('../funciones/Festivos.php');


//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$datosbd = $funcion->get_datos_basededatos(1);
$datosbd_b = explode("*/-*/-",$datosbd);
$datosbd_1 = $datosbd_b[0];
$datosbd_2 = $datosbd_b[1];
$datosbd_3 = $datosbd_b[2];
$datosbd_4 = $datosbd_b[3];



$conexion = db_connect($dbdefault_dbname);

$error_transaccion = 0; //variable para detectar error

//$link = db_connect($dbdefault_dbname);

date_default_timezone_set('America/Bogota'); 
$fecha_respuesta = date('Y-m-d');
$hora_respuesta  = date('H:i');

setlocale(LC_TIME, "Spanish");
$fechaactual_2 = strftime('%d de %B de %Y', strtotime($fecha_respuesta)); 


if($conexion > 0){

	//PARA EDITAR
	if (isset($_POST) && count($_POST)>0)
	{
		
		//PARA LLEVAR EL HISTORIAL DE LA AUDIENCIA
		$idXaudi     = trim($_POST["idXaudi"]);
		
		$radiXaudi   = trim($_POST["radiXaudi"]);
		$id_radi     = $funcion->get_idradicado_X($radiXaudi);
		
		$fechaXaudi  = trim($_POST["fechaXaudi"]);
		$horaiXaudi  = trim($_POST["horaiXaudi"]);
		$horafXaudi  = trim($_POST["horafXaudi"]);
		$estadoXaudi = trim($_POST["estadoXaudi"]);
		$id_juzgado  = trim($_POST["id_juzgado"]);
		$causalXaudi = trim($_POST["causalXaudi"]);
		
		$tipoXaudi    = trim($_POST["tipoXaudi"]);
		$tipoX_audi_1 = explode("-",trim($tipoXaudi));
		$tipoX_audi_2 = trim($tipoX_audi_1[0]);//num audi --> me idndica que actuacion de justicia debo ingresar
	    $tipoX_audi_3 = trim($tipoX_audi_1[1]);//des audi
		
		
		
		
		//-------------------------------------------CALCULAR FECHA ESTADO----------------------------------------------------------------
		
		function get_days_for_month($m,$y){

			if($m == 02){ 
				if(($y % 4 == 0) && (($y % 100 != 0) || ($y % 400 == 0))){
					return 29;
				}else{
					return 28;
				}
			}
			if ($m == 4 || $m == 6 || $m == 9 || $m == 11){
				return 30;
			}else{
				return 31;
			}
		}
	
		
			
		$cadenafechas  = "";
		

		//NOTA IMPORTANTE
		
		//4 DE SEPTIEMBRE 2019
		
		//ESTA PARTE DETERMINA, SI UNA FECHA ES DIA SABADO, DOMINGO O FESTIVO
		//SI ES SABADO SE SUMA DOS DIAS PARA QUE ESCOGA EL LUNES SIGUIENTE, PERO DE IGUAL
		//FORMA SE EVALUA QUE ESE LUNES NO SEA FESTIVO, Y SI ES DOMINGO SE SUMA UN DIA, EH IGUAL
		//TRATAMIENTO PARA EL LUNES
		
		//SE ANEXA ESTA PARTE AL SCRIPT, YA QUE E USUARIO PUEDE VENIR A PROGRAMAR AUDIENCIAS
		//SABADO, DOMINGO O FESTIVO Y QUE EL SISTEMA FIJE FECHA DE ESTADO PARA EL SEGUNDO DIA HABIL
		
		$anio = date('Y');
		
		$bandera_dia_nohabil = 0;
	
		//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
		$dias_festivos = new festivos($anio);
		
		function get_festivo($startX){
		
			$dias_festivos_2 = new festivos($anio);
			
			$fechat = trim($startX);
			$date   = date_create($fechat);
			$fechat = date_format($date,'Y-n-j');
					
			$fecha = explode("-",$fechat);
					
			$year  = $fecha[0];
			$month = $fecha[1];
			$day   = $fecha[2];
		
			$esfestivoX = $dias_festivos_2->esFestivo($day,$month);
			
			return 	$esfestivoX;
		}
		
		
		$fechat = trim($fecha_respuesta);
		//$fechat = trim($_GET['audi_fecha_X']);
		//$fechat = trim('2019-09-07');
		$date   = date_create($fechat);
		$fechat = date_format($date,'Y-n-j');
				
		$fecha = explode("-",$fechat);
				
		$year  = $fecha[0];
		$month = $fecha[1];
		$day   = $fecha[2];
				
				
		$date = date('D', mktime(0,0,0,$month,$day,$year));
						
		//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
		$esfestivo = $dias_festivos->esFestivo($day,$month);
						
		if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){		
			
			//echo "ES FESTIVO";
			
			if($date == 'Sat'){
			
				$fecha_actual = date($fechat);
				//$startX       = date("Y-m-d",strtotime($fecha_actual."+ 2 days"));
				$startX       = date("j/n/Y",strtotime($fecha_actual."+ 3 days"));
				
				//SE REPITE EL PROCESO, YA QUE AL SUMAR DOS DIAS
				//AL SABADO, EL LUNES PUEDE SER FESTIVO
				$fes = get_festivo($startX);
				
				if($fes == 1){
				
					$fecha_actual = date($startX);
					//$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
					
					$startX       = date("j/n/Y",strtotime($fecha_actual."+ 2 days"));
					
					
				}
				
				$bandera_dia_nohabil = 1;
			
			}
			
			if($date == 'Sun' or $esfestivo == 1){
			
				$fecha_actual = date($fechat);
				//$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
				$startX       = date("j/n/Y",strtotime($fecha_actual."+ 2 days"));
				
				//SE REPITE EL PROCESO, YA QUE AL SUMAR UN DIA
				//AL DOMINGO, EL LUNES PUEDE SER FESTIVO
				$fes = get_festivo($startX);
				
				if($fes == 1){
				
					$fecha_actual = date($startX);
					//$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
					
					$startX       = date("j/n/Y",strtotime($fecha_actual."+ 2 days"));
				
				}
				
				$bandera_dia_nohabil = 1;
			}
			
			
		}
		else{
			
			//echo "NO ES FESTIVO";
			
			$startX = $fechat;
			
			$bandera_dia_nohabil = 0;
		}
		
		
		$cadenafechas  = $startX;
		
		
		//SE REALIZA LA PREGUNTA, YA QUE SE INDICA QUE EL DIA QUE SE ESTA PROGRAMANDO AUDIENCIAS
		//NO ES	SABADO, DOMINGO O FESTIVO
		if($bandera_dia_nohabil == 0){
		
			unset($cadenafechas);
			
			$cadenafechas  = "";
				
			//REALIZO ESTE WHILE PARA QUE CALCULE DE UNA VEZ LA FECHA INCIAL Y FINAL DEL TRASLADO
			$if = 0;
			while($if < 2){
				
				//FECHA INICAL
				if($if == 0){
				
					//$fechat = trim($_GET['audi_fecha_X']);
					$fechat = trim($fecha_respuesta);
					$date   = date_create($fechat);
					$fechat = date_format($date,'Y-n-j');
					
					$fecha = explode("-",$fechat);
					
					$year  = $fecha[0];
					$month = $fecha[1];
					$day   = $fecha[2];
					
					$diasti = 1;
				}
				//FECHA FINAL
				if($if == 1){
				
					//$fechat = trim($_GET['audi_fecha_X']);
					$fechat = trim($fecha_respuesta);
					$date   = date_create($fechat);
					$fechat = date_format($date,'Y-n-j');
					
					$fecha = explode("-",$fechat);
					
					$year  = $fecha[0];
					$month = $fecha[1];
					$day   = $fecha[2];
					
					$diasti = 3;
				}
				
				//extract($_POST);
				if(!isset($day) or !isset($month) or !isset($year) or !isset($diasti)){ exit; }
				
				$inhabiles = array('5/2/2013');
				$habiles   = array();
				
				for($y=2014; $y<=date('Y') + 1; $y++){
				
					//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
					$dias_festivos = new festivos($y);
				
					for($m=1; $m<=12; $m++){
					
						for($d=1; $d<=get_days_for_month($m,$y); $d++){
						
							$date = date('D', mktime(0,0,0,$m,$d,$y));
							
							//PARA DIAS FESTIVOS, SE LE AGREGA A ESTE ALGORITMO EL ORIGINAL NO LO TIENE
							$esfestivo = $dias_festivos->esFestivo($d,$m);
							
							if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
							
								$inhabiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
							}
							else{
							
								if(!in_array(date("j/n/Y", mktime(0,0,0,$m,$d,$y)),$inhabiles)){
									$habiles[] = date("j/n/Y", mktime(0,0,0,$m,$d,$y));
								}
							}
							
							
						}
					}
				}
				
				$date = $day.'/'.$month.'/'.$year;
				$contador = array_search($date,$habiles);
				
				$cadenafechas .= $habiles[$diasti+$contador]." ";
				
				$if = $if + 1;
			
			}//FIN WHILE
		
		
		}//FIN if($bandera_dia_nohabil == 0){
				
		
		$cadenafechas_1 = explode(" ",$cadenafechas);
		$cadenafechas_2 = $cadenafechas_1[0];
		$cadenafechas_3 = explode("/",$cadenafechas_2);
		$cadenafechas_4 = $cadenafechas_3[2]."-".$cadenafechas_3[1]."-".$cadenafechas_3[0];
		
		$fija_estado = trim($cadenafechas_4);
		$datei       = date_create($fija_estado);
		$fi          = date_format($datei, 'Y-m-d H:i:s');
		$fi          = $fi."."."000";
		
		
		//-------------------------------------------FIN CALCULAR FECHA ESTADO----------------------------------------------------------------
		
		
		
		
		
		  
		
		if($tipoX_audi_2 == 1){
										
			$actuacion    = "Auto suspende remate";
			$A110CODIACTU = "30023262";
			$A110CODIPADR = "30013035";
											
		}
										
		if($tipoX_audi_2 == 2){
										
			$actuacion    = "Auto aplaza audiencia y fija nueva fecha";
			$A110CODIACTU = "30023352";
			$A110CODIPADR = "30013034";
		}
		
		if($tipoX_audi_2 >= 1){
		
			$nota_actu   = "ACTUACION REGISTRADA ".$fechaactual_2." A LAS ".$hora_respuesta." ID AUDIENCIA: ".$idXaudi." TIPO AUDIENCIA: ".$tipoX_audi_3;
			
		}
		else{
		
			$nota_actu   = "ACTUACION REGISTRADA ".$fechaactual_2." A LAS ".$hora_respuesta." ID AUDIENCIA: ".$idXaudi;
		}
		
		
		mysql_query("START TRANSACTION",$conexion);
		
		
		//SE REALIZA ESTAS COMPARACIONES PARA CONTROLAR
		//LA VARIABLE $estadoXaudi YA QUE LA COLUMNA estado
		//EN LA TABLA siepro_audiencia_juzgado_h ES INTEGER
		if($_POST["campo"] == "estado"){
			
			$estadoXaudi = trim($_POST["valor"]);
				
		}
		else{
		
			if($estadoXaudi == 'EN PROCESO'){$estadoXaudi = 1;}
			
			if($estadoXaudi == 'REALIZADA'){$estadoXaudi  = 2;}
			
			if($estadoXaudi == 'SUSPENDIDA'){$estadoXaudi = 3;}
			
			if($estadoXaudi == 'APLAZADA'){$estadoXaudi   = 4;}
			
			if($estadoXaudi == 'CANCELADA / NO REALIZADA'){$estadoXaudi = 5;}
		
		}
		
		
		if($_POST["campo"] == "hora_fini"){
		
			//PARA CONTROLAR TANTO LA VARIABLE
			//$estadoXaudi Y $causalXaudi YA QUE LA COLUMNA estado Y idcausal
		    //EN LA TABLA siepro_audiencia_juzgado_h SON INTEGER
			// Y EN ESTA PARTE, POR QUE AL ESCOGER HORA FINAL
			//EL SISTEMA AUTOMATICAMENTE ACTUALIZA EL REGISTRO DE LA AGENDA EN REALIZADA
			$estadoXaudi = 2;
			$causalXaudi = 0;
		
			$query = "UPDATE siepro_audiencia_juzgado SET estado = 2, idcausal = NULL, ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
					 "' WHERE id ='".intval($_POST["id"])."' limit 1";
					 
			
			$horafXaudi  = trim($_POST["valor"]);		 
		}
		else{//1
		
			//SE SELECCIONO ESTADO APLAZADA O CANCELADA, CON SU RESPECTIVA CAUSAL
			if($causalXaudi >= 1){
			
				
					$query     = "UPDATE siepro_audiencia_juzgado SET idcausal = '$causalXaudi', hora_fini = '-', ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
							   "' WHERE id ='".intval($_POST["id"])."' limit 1";
							 
					
					
					$serverName 	= $datosbd_1;
					//$serverName = "EMMANUEL\SQLEXPRESS"; 
					$connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
					//$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"crow");
					$conn           = sqlsrv_connect( $serverName, $connectionInfo);
									
									
					if( $conn === false ) {
										
						$error_transaccion = 1;
									
						if( ($errors = sqlsrv_errors() ) != null) {
										
							foreach( $errors as $error ) {
											
								$msgError .= "ERROR EN REGISTRO 1: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
							}
											
						}
										
					}
									
				    //Iniciar la transacción.
					if ( sqlsrv_begin_transaction( $conn ) === false ) {
										 
						$error_transaccion = 1;
									
						if( ($errors = sqlsrv_errors() ) != null) {
										
							foreach( $errors as $error ) {
											
								$msgError .= "ERROR EN REGISTRO 2: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
							}
											
						}
										 
					}
					
					
					
					//APLAZADA			 
					if( trim($_POST["valor"]) == 4 ){
				
				
								$sininstancia = $radiXaudi;
								$sin          = substr($sininstancia, 0, 21);
											
								$sql = ("	
					
													DECLARE @cad integer
													
										
													SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE a110Llavproc='$radiXaudi' 
																		
													
													INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
													A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,
													A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,A110RENUTERM) 
													VALUES('$radiXaudi',@cad,'$sin','00','$A110CODIACTU','$A110CODIPADR','$actuacion','N','NO','N',NULL,
													NULL,NULL,GETDATE(),NULL,NULL,'0002',NULL,GETDATE(),
													'$nota_actu',NULL,NULL,'D','P',GETDATE(),NULL,NULL)
												   
												   
													UPDATE T103DAINFOPROC SET a103descactd ='$actuacion', 
													a103codiactd ='$A110CODIACTU',a103codipadd ='$A110CODIPADR',a103fechdesd = GETDATE()
													WHERE a103llavproc='$radiXaudi';	
													
													
												
													
									");
											
											
			
									$params  = array();
									$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
									$stmt = sqlsrv_query( $conn, $sql , $params, $options );
												
												
									if( $stmt === false ) {
												
										$error_transaccion = 1;
												
										if( ($errors = sqlsrv_errors() ) != null) {
													
											foreach( $errors as $error ) {
														
												$msgError .= "ERROR EN REGISTRO 3: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
											}
										}
											
									}	
									
									sqlsrv_free_stmt( $stmt);
									
									
									
									//FIJA ESTADO
									$sql_2 = ("	
					
													DECLARE @cad integer
													
										
													SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE a110Llavproc='$radiXaudi' 
																		
													
													INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,
													A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
													A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,
													A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,A110RENUTERM) 
													VALUES('$radiXaudi',@cad,'$sin','00','00000108','00000106','Fijacion estado','L','SI','C',1,
													convert(datetime, '$fi', 121),
													convert(datetime, '$fi', 121),
													GETDATE(),
													NULL,1,NULL,NULL,
													GETDATE(),
													'',NULL,NULL,'S','D',
													GETDATE(),
													NULL,NULL)
													
													
		
											");
											
											
			
										$params_2  = array();
										$options_2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
										$stmt_2    = sqlsrv_query( $conn, $sql_2 , $params_2, $options_2 );
												
												
										if( $stmt_2 === false ) {
												
											$error_transaccion = 1;
												
											if( ($errors = sqlsrv_errors() ) != null) {
													
												foreach( $errors as $error ) {
														
													$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
												}
											}
											
										}	
									
										sqlsrv_free_stmt( $stmt_2);
								
			
								
					}//FIN if( trim($_POST["valor"]) == 4 ){
					
					
					//CANCELADA			 
					/*if( trim($_POST["valor"]) == 5 ){
				
				
								$sininstancia = $radiXaudi;
								$sin          = substr($sininstancia, 0, 21);
											
								$sql = ("	
					
													DECLARE @cad integer
													
										
													SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE a110Llavproc='$radiXaudi' 
																		
													
													INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
													A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,
													A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,A110RENUTERM) 
													VALUES('$radiXaudi',@cad,'$sin','00','30003315','30013034','Se cancela audiencia','N','NO','N',0,
													NULL,NULL,GETDATE(),NULL,NULL,'0002',NULL,GETDATE(),
													'$nota_actu',NULL,NULL,'D','P',GETDATE(),NULL,NULL)
												   
												   
													UPDATE T103DAINFOPROC SET a103descactd ='Se cancela audiencia', 
													a103codiactd ='30003315',a103codipadd ='30013034',a103fechdesd = GETDATE()
													WHERE a103llavproc='$radiXaudi';	
													
													
												
													
									");
											
											
			
									$params  = array();
									$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
									$stmt = sqlsrv_query( $conn, $sql , $params, $options );
												
												
									if( $stmt === false ) {
												
										$error_transaccion = 1;
												
										if( ($errors = sqlsrv_errors() ) != null) {
													
											foreach( $errors as $error ) {
														
												$msgError .= "ERROR EN REGISTRO 3: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
											}
										}
											
									}	
									
									sqlsrv_free_stmt( $stmt);
								
			
								
					}//FIN if( trim($_POST["valor"]) == 5 ){*/
					
					
					
					
			}// FIN if($causalXaudi >= 1){
			else{
			
				$causalXaudi = 0;
				
				$query = "UPDATE siepro_audiencia_juzgado SET idcausal = NULL, hora_fini = '-', ".$_POST["campo"]."='".utf8_decode($_POST["valor"]).
					     "' WHERE id ='".intval($_POST["id"])."' limit 1";
				
			}
			
			
			
			
		}//FIN ELSE 1	
	
		
		//SQL HISTORIAL
		$query_2   = "INSERT INTO siepro_audiencia_juzgado_h(idradicado,fecha,hora_ini,hora_fini,estado,idcausal,idusuario,fecha_reg,id_juzgado,id_audi) 
		              VALUES('$id_radi','$fechaXaudi','$horaiXaudi','$horafXaudi','$estadoXaudi','$causalXaudi','$idusuarioX',now(),'$id_juzgado','$idXaudi')";		  
		
		
					 
		$resultado = mysql_query($query);
		
		if (!$resultado) {
						
			$error_transaccion = 1;
														
		}
		
		$resultado_2 = mysql_query($query_2);
		
		if (!$resultado_2) {
						
			$error_transaccion = 1;
														
		}
		
		
		if($error_transaccion) {
							
			
			echo "<span class='ko'>"."ERROR EN LA OPERACION ".mysql_errno($conexion). ": " . mysql_error($conexion)." ERROR JUSTICIA: ".$msgError."</span>";
			
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			mysql_query("ROLLBACK",$conexion);
			
			//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
			sqlsrv_rollback( $conn );
								
			// Cerrar la conexión.
			sqlsrv_close( $conn );
			
			
	
		} //FIN if($error_transaccion) 
		else {
			
			/*$v1 = trim($_POST["campo"]);
			$v2 = trim($_POST["valor"]);			
			$v3 = trim($_POST["id"]);
			$v4 = trim($_POST["solorespuesta"]);
			
			$VTOTAL = "<span class='ok'>VALORES MODIFICADOS CORRECTAMENTE.</span>"."******".$v1."******".$v2."******".$v3."******".$v4;*/
			
			echo "<span class='ok'>VALORES MODIFICADOS CORRECTAMENTE.</span>";
			
			
						
			//echo $VTOTAL;
						
			//SE TERMINA LA TRANSACCION 
			mysql_query("COMMIT",$conexion);
			
			
			//SE TERMINA LA TRANSACCION EN JUSTICIA XXI  
			sqlsrv_commit( $conn );				
							
		}
		
		
		
	}
	
	//PARA GENERAR LA TABLA
	if (isset($_GET) && count($_GET)>0)
	{
	
		//CODIGO ORIGINAL	
		/*if ($db->connect_errno) 
		{
			die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
		}
		else
		{
			
			$query =$db->query( "SELECT * FROM liquidacion_costas 
								 WHERE idradicado = ".$_GET['valor_id']." AND estadoe != 'ANULADA'
								 ORDER BY id DESC" );
			
			$datos=array();
			while ($usuarios=$query->fetch_array())
			{
				
				if( strlen($usuarios["observacioncostas"]) == 0 ){
				
					$usuarios["observacioncostas"] = "x";
				}
				
				$datos[]=array(	
								"id"                 =>$usuarios["id"],
								"nunentrada"         =>$usuarios["nunentrada"],
								"fechae"             =>$usuarios["fechae"],
								"horae"              =>$usuarios["horae"],
								"nuevo"              =>$usuarios["nuevo"],
								"liquidacioncredito" =>$usuarios["liquidacioncredito"],
								"observacioncostas"  =>$usuarios["observacioncostas"]
				);
			}
			echo json_encode($datos);
		}*/
		
	
		/*$query     = "	SELECT t1.id,
		                t2.des AS clase,t2.id AS id_clase,
						t3.des AS numeral,t3.id AS id_numeral_norma,
						t1.descripcion,t1.analisis_causas,
						t4.des AS procesoresponsable,t4.id AS id_pr,
						t1.id_ai,
						t6.des AS metodologia,t6.id AS id_metodologia,
						t7.des AS generada,t7.id AS id_generada,
						t1.fecha_registro,t1.hora_registro,t1.estado
						FROM (((((gc_acciones t1
						LEFT JOIN gc_lista t2 ON t1.id_clase = t2.id)
						LEFT JOIN gc_lista t3 ON t1.id_numeral_norma = t3.id)
						LEFT JOIN gc_lista t4 ON t1.id_pr = t4.id)
						LEFT JOIN gc_lista t6 ON t1.id_metodologia = t6.id)
						LEFT JOIN gc_lista t7 ON t1.id_generada = t7.id) 
						WHERE t1.id = ".$_GET['valor_id']." 
						ORDER BY id DESC	";
						
		//$query     = "SELECT * FROM gc_acciones WHERE id = ".$_GET['valor_id']."";
										
				  
		$resultado = mysql_query($query);		  
			
		$datos     = array();
		
		while($accion = mysql_fetch_array($resultado)){
				
			/*if( strlen($usuarios["observacioncostas"]) == 0 ){
				
				$usuarios["observacioncostas"] = "x";
			}*/
				
			/*$datos[]=array(	
							"id"                 =>$accion["id"],
							"id_clase"           =>$accion["id_clase"],
							"clase"              =>utf8_encode($accion["clase"]),
							"id_numeral_norma"   =>$accion["id_numeral_norma"],
							"numeral"            =>utf8_encode($accion["numeral"]),
							"descripcion"        =>utf8_encode($accion["descripcion"]),
							"id_pr"              =>$accion["id_pr"],
							"procesoresponsable" =>utf8_encode($accion["procesoresponsable"]),
							"id_ai"              =>utf8_encode($accion["id_ai"]),
							"analisis_causas"    =>utf8_encode($accion["analisis_causas"]),
							"id_metodologia"     =>$accion["id_metodologia"],
							"metodologia"        =>utf8_encode($accion["metodologia"]),
							"id_generada"        =>$accion["id_generada"],
							"generada"           =>utf8_encode($accion["generada"])
							
							
			);
		}
		
		echo json_encode($datos);*/
		
	}

}
else{

	//echo $conexion; 
	echo "Fallo en la Conexión";
}

}//CIERRE IF SESSION 

mysql_free_result($resultado);
mysql_close($conexion);

?>