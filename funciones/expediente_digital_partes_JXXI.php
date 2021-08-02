<?php

session_start(); 

if($_SESSION['id']!=""){

	
	include_once('Funciones.php');
	//instanciamos la clase Funciones.php con la variable $funcion
	$funcion = new Funciones();
	
	$datosbd = $funcion->get_datos_basededatos(1);
	$datosbd_b = explode("//////",$datosbd);
	$datosbd_1 = trim($datosbd_b[0]);
	$datosbd_2 = trim($datosbd_b[1]);
	$datosbd_3 = trim($datosbd_b[2]);
	$datosbd_4 = trim($datosbd_b[3]);
	

	$error_transaccion = 0; //variable para detectar error
	
	
	//PARA GENERAR LA TABLA
	if (isset($_GET) && count($_GET)>0)
	{
	
		$n_radi = trim($_GET["recipient"]);
		
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
		
		$sql = ("	
			
			
					
					
					SELECT 
					[A112LLAVPROC],
					[A112CODISUJE],
					[A112NUMESUJE],
					[A112NOMBSUJE]
					FROM  [$datosbd_2].[dbo].[T112DRSUJEPROC]
					WHERE [A112LLAVPROC] = '$n_radi'
					
							
		");
			
		$params  = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt    = sqlsrv_query( $conn, $sql , $params, $options );
		
		if( $stmt === false ) {
			
			$error_transaccion = 1;
			
			if( ($errors = sqlsrv_errors() ) != null) {
				
				foreach( $errors as $error ) {
					
					$msgError .= "ERROR EN REGISTRO 3"."<br />";	
					$msgError .= "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					$msgError .= "code: ".$error[ 'code']."<br />";	
					$msgError .= "message: ".$error[ 'message']."<br />";
					
					/*echo "ERROR EN REGISTRO "."<br />";	
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					echo "code: ".$error[ 'code']."<br />";
					echo "message: ".$error[ 'message']."<br />";*/
				}
			}
			
			$msgError .= "ENTRE 3 ([T112DRACTUPROC])";
			
			//echo "ENTRE 3 ([T112DRACTUPROC])";
			
				
		}
		else{
				
			//$row_count = sqlsrv_num_rows( $stmtX );
			
			$datos  = array();
		
			while( $parte = sqlsrv_fetch_array( $stmt) ){
			
			
				$datos[]=array(	
								"A112LLAVPROC" =>$parte["A112LLAVPROC"],
								"A112CODISUJE" =>$parte["A112CODISUJE"],
								"A112NUMESUJE" =>utf8_encode($parte["A112NUMESUJE"]),
								"A112NOMBSUJE" =>utf8_encode($parte["A112NOMBSUJE"])
				);
				 
				 
			 }//FIN WHILE	
			 
			 if($error_transaccion == 1){
			 
			 	echo $msgError;
			 }
			 else{
			 
			 	echo json_encode($datos);
				
			}
			 
			
		}
	
		
		
	}



}//CIERRE IF SESSION 

mysql_free_result($resultado);
mysql_close($conexion);

?>