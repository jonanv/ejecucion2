<?php

		 //require_once('../libs/Conexion_Funciones.php');
		
		 include_once('Funciones.php');
		 //instanciamos la clase Funciones.php con la variable $funcion
		 $funcion = new Funciones();
	
		 $retorno  = 0;
		 $cadena   = "";
		
		 $idradicado = trim($_GET['idradicado']);
		 
		 date_default_timezone_set('America/Bogota'); 
		 $fechaactual=date('Y-m-d'); 
		
		 //TRAE LOS RADICADOS DE TUTELAS YA REGISTRADOS EN correspondencia_tutelas
		 //PARA QUE LA ALERTA NO SALGA, SOLO SE OBSERVE CUANDO LLEGUE UNA NUEVA
		 $datos_radi_tutela = $funcion->get_radi_corres_tutela();
		 
	
		 //DE ESTA FORMA OBTENGO LOS DATOS DE CONEXION DE LA BASE DE DATOS DESDE UNA FUNCION
		 //PARA NO DEJAR ESTOS DATOS DE FORMA ESTATICA
		 $datosbd   = $funcion->get_datos_basededatos(1);
		 //$datosbd_b = $datosbd->fetch();
		 $datosbd_b = explode("//////",$datosbd);
		 
		 $datosbd_1 = $datosbd_b[0];
		 $datosbd_2 = $datosbd_b[1];
		 $datosbd_3 = $datosbd_b[2];
		 $datosbd_4 = $datosbd_b[3];
		 
		 $serverName = $datosbd_1; //serverName\instanceName
		 $connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
		 $conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		
		 //SI LA CONEXION ES CORRECTA	 
	     if( $conn ) { 
		 
				 
				$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103HORAREPA]
					     FROM [ConsejoPN].[dbo].[T103DAINFOPROC]
					     WHERE [A103FECHREPA] =  convert(datetime, '$fechaactual', 121) 
					     AND [A103ANOTACTS] LIKE '%reparto%' AND [A103CONSPROC] NOT IN(01,02,03,04,05,06,07,08,09,10) AND [A103LLAVPROC] LIKE '%170014303%'"." ".$datos_radi_tutela);
				
				/*$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103HORAREPA]
					     FROM [ConsejoPN].[dbo].[T103DAINFOPROC]
					     WHERE [A103FECHREPA] =  convert(datetime, '2019-06-10', 121) 
					     AND [A103ANOTACTS] LIKE '%reparto%' AND [A103LLAVPROC] LIKE '%170014303%'"." ".$datos_radi_tutela);*/
							
				 $params = array();
				 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
			
				 $row_count = sqlsrv_num_rows( $stmt );
			
				 //if ($row_count === false){
				 if ($row_count == 0){
					 
					 $cadena = 0;
					 echo trim($cadena);
				 }
				 else{
				 
				 	$cadena =  1;
					echo trim($cadena);
			 
					/*while( $row = sqlsrv_fetch_array( $stmt)){
				 
						 $radi      = $row['A103LLAVPROC'];
						 $fecharepa = date_format($row['A103FECHREPA'],'Y-m-d');
						 $horarepa  = $row['A103HORAREPA'];
						 $nota      = $row['A103ANOTACTS'];
					 
						 $cadenap.= $radi."//////".$fecharepa."//////".$horarepa."******"; 
						
					}*/
			 
				}
				
		 }
		 else{ 
		 
			$cadena = -1;
			echo trim($cadena);
			
		 } 
		 
		  
		
	
?>
   

	

	
	