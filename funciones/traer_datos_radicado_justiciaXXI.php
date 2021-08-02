<?php

		 //require_once('../libs/Conexion_Funciones.php');
		
		 include_once('Funciones.php');
		 //instanciamos la clase Funciones.php con la variable $funcion
		 $funcion = new Funciones();
	
		 $retorno  = 0;
		 $cadena   = "";
		
		 $idradicado = trim($_GET['idradicado']);
		
	
		 
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
		 
				// echo "Conectado a la Base de Datoss.<br />"; 
				
		
				//EN ESTA SQL USO LA VARIABLE $datosbd_2 QUE ES LA QUE TOMA EL VALOR DE LA BASE DE DATOS
				//DE LA FUNCION get_datos_basededatos()
				$sql = (" SELECT t103.A103CODICLAS,t053.A053DESCCLAS,t103.A103CODISUBC,t071.A071DESCSUBC,
						  t112.A112LLAVPROC,t112.A112CODISUJE,t112.A112NUMESUJE,t112.A112NOMBSUJE,t112.A112FLAGDETE,
						  t057.A057DESCSUJE,t103.A103ENTIRADI,t051.A051DESCENTI,t103.A103ESPERADI,t062.A062DESCESPE,
						  t103.A103CODIPROC,t052.A052DESCPROC,A103CODIPONE,A103NOMBPONE
						  FROM ((((((([$datosbd_2].[dbo].[T103DAINFOPROC] t103 
						  LEFT JOIN [$datosbd_2].[dbo].[T112DRSUJEPROC] t112 ON t103.A103LLAVPROC = t112.A112LLAVPROC) 
						  LEFT JOIN [$datosbd_2].[dbo].[T057BASUJEGENE] t057 ON t112.A112CODISUJE = t057.A057CODISUJE)
						  LEFT JOIN [$datosbd_2].[dbo].[T053BACLASGENE] t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
						  LEFT JOIN [$datosbd_2].[dbo].[T071BASUBCGENE] t071 ON t103.A103CODISUBC = t071.A071CODISUBC)
						  LEFT JOIN [$datosbd_2].[dbo].[T051BAENTIGENE] t051 ON t103.A103ENTIRADI = t051.A051CODIENTI)
						  LEFT JOIN [$datosbd_2].[dbo].[T062BAESPEGENE] t062 ON t103.A103ESPERADI = t062.A062CODIESPE)
						  LEFT JOIN [$datosbd_2].[dbo].[T052BAPROCGENE] t052 ON t103.A103CODIPROC = t052.A052CODIPROC)
						  WHERE t103.A103LLAVPROC IN('$idradicado') ");
				
							
				 $params = array();
				 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
			
				 $row_count = sqlsrv_num_rows( $stmt );
			
				 //ERROR EN CARGA DE DATOS, REVISAS CONSULTA $SQL
				 if ($row_count === false){
				 
					 //echo "Error in retrieveing row count. en Cargar Datos";
					 
					 //$retorno  = 2;
					 
					 $cadena = 2;
					 echo trim($cadena);
					 
				 }
				 //NO EXISTE ERROR EN CARGA DE DATOS Y SI $cadena = 0
				 //NO EXISTEN DATOS EN JUSTICIA XXI, PROCEDA A CREAR EL RADICADO
				 else{
			 
					 while( $row = sqlsrv_fetch_array( $stmt)){
					 
						 $radi        = $row['A112LLAVPROC'];
				 
						 $codigoparte = $row['A112CODISUJE'];
						 
						 $cd          = $row['A112NUMESUJE'];
						 $nd          = $row['A112NOMBSUJE'];
						 
						 $estado      = $row['A112FLAGDETE'];
						 
						 $tipo        = $row['A057DESCSUJE'];
						 
						 $codclase    = $row['A103CODICLAS'];
						 $nomclase 	  = $row['A053DESCCLAS'];
						 
						 $codsubclase = $row['A103CODISUBC'];
						 $nomsubclase = $row['A071DESCSUBC'];
						 
						 $codcorpo    = $row['A103ENTIRADI'];
						 $corpo       = $row['A051DESCENTI'];
						 
						 $codespe     = $row['A103ESPERADI'];
						 $espe        = $row['A062DESCESPE'];
						 
						 $coddelit    = $row['A103CODIPROC'];
						 $delit       = $row['A052DESCPROC'];
						 
					 
						 $A103CODIPONE = $row['A103CODIPONE'];
						 $A103NOMBPONE = $row['A103NOMBPONE'];
						 
						 
						 
						//$cadena .= $codigoparte."//////".$cd."//////".$nd."//////".$tipo."******";
						
						$cadena .= $codigoparte."//////".$cd."//////".$nd."//////".$tipo."//////".$codclase."//////".$nomclase."//////".$codsubclase."//////".$nomsubclase
						."//////".$estado."//////".$codcorpo."//////".$corpo."//////".$codespe."//////".$espe."//////".$coddelit."//////".$delit
						."//////".$A103CODIPONE."//////".$A103NOMBPONE."//////".$bandera."******";
						
						$retorno  = 3;
						
						 
					}
					
					if($retorno == 3){
					
						echo trim(utf8_encode($cadena));
					
					}
					else{
					
						$cadena = 0;
						echo trim($cadena);
					
					}
					
					

				}

		
				
		 }
		 else{ 
		 
			//echo "NO se puede conectar a la Base de Datos.<br />"."DATOS ".$datosbd." IP ".$datosbd_1." BD ".$datosbd_2." USUARIO ".$datosbd_3." CLAVE ".$datosbd_4; 
			//die( print_r( sqlsrv_errors(), true)); 
			
			//$retorno  = 1;
			
			$cadena = 1;
			echo trim($cadena);
			
			
			
		  } 
		 
		  
		
	
?>
   

	

	
	