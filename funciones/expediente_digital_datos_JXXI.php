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
		
		
		
		$sql = (" SELECT 
		
				  t103.A103CODICLAS,t053.A053DESCCLAS,t103.A103CODISUBC,t071.A071DESCSUBC,
				  t103.A103ENTIRADI,t051.A051DESCENTI,t103.A103ESPERADI,t062.A062DESCESPE,
				  t103.A103CODIPROC,t052.A052DESCPROC,A103CODIPONE,A103NOMBPONE
				  FROM ((((([$datosbd_2].[dbo].[T103DAINFOPROC] t103 
				  LEFT JOIN [$datosbd_2].[dbo].[T053BACLASGENE] t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
				  LEFT JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] t071 ON t103.A103CODISUBC = t071.A071CODISUBC)
				  LEFT JOIN [$datosbd_2].[dbo].[T051BAENTIGENE] t051 ON t103.A103ENTIRADI = t051.A051CODIENTI)
				  LEFT JOIN [$datosbd_2].[dbo].[T062BAESPEGENE] t062 ON t103.A103ESPERADI = t062.A062CODIESPE)
				  LEFT JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] t052 ON t103.A103CODIPROC = t052.A052CODIPROC)
				  
				  WHERE t103.A103LLAVPROC IN('$n_radi') ");
				  
		
			
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
			
			$msgError .= "ENTRE 3 ([T103DRACTUPROC])";
			
			//echo "ENTRE 3 ([T112DRACTUPROC])";
			
				
		}
		else{
				
			//$row_count = sqlsrv_num_rows( $stmtX );
			
			$datos  = array();
		
			while( $actuX = sqlsrv_fetch_array( $stmt) ){
			
			
				$datos[]=array(	
				
								"A112LLAVPROC" =>$actuX["A112LLAVPROC"],
								/*"A112CODISUJE" =>$actuX["A112CODISUJE"],
								"A112NUMESUJE" =>$actuX["A112NUMESUJE"],
								"A112NOMBSUJE" =>utf8_encode($actuX["A112NOMBSUJE"]),
								"A112FLAGDETE" =>$actuX["A112FLAGDETE"],*/
								"A057DESCSUJE" =>utf8_encode($actuX["A057DESCSUJE"]),
								"A103CODICLAS" =>$actuX["A103CODICLAS"],
								"A053DESCCLAS" =>utf8_encode($actuX["A053DESCCLAS"]),
								"A103CODISUBC" =>$actuX["A103CODISUBC"],
								"A071DESCSUBC" =>utf8_encode($actuX["A071DESCSUBC"]),
								"A103ENTIRADI" =>$actuX["A103ENTIRADI"],
								"A051DESCENTI" =>utf8_encode($actuX["A051DESCENTI"]),
								"A103ESPERADI" =>$actuX["A103ESPERADI"],
								"A062DESCESPE" =>utf8_encode($actuX["A062DESCESPE"]),
								"A103CODIPROC" =>$actuX["A103CODIPROC"],
								"A052DESCPROC" =>utf8_encode($actuX["A052DESCPROC"]),
								"A103CODIPONE" =>$actuX["A103CODIPONE"],
								"A103NOMBPONE" =>utf8_encode($actuX["A103NOMBPONE"])
								
								
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