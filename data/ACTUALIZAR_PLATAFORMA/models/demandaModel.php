<?php

class demandaModel extends modelBase{

	
	
	public function rango_horas_municipio($idmunicipio){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$listar = $this->db->prepare("	
			
											SELECT hi,hf FROM dda_municipio 
											WHERE id = '$idmunicipio'
											
										");
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista($nombrelista,$campoordenar,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_filtro($nombrelista,$campoordenar,$formaordenar,$filtro){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_fecha_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
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
	
	//HORA MILITAR
	public function get_hora_actual_24horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i');
		
		/*$hora         = date('H');
		
		//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
		//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
		//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
		//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
		if($hora >= 1 && $hora <= 9){
			$horaregistro = substr($horaregistro, -4);    // Ej: 08:54 devuelve 8:54
		}*/
		
		return $horaregistro; 
	}
	
	public function get_fecha_hora_mysql(){
	
		date_default_timezone_set('America/Bogota'); 
		$hoy = date("Y-m-d H:i:s");
		
		return $hoy; 
		
   }
	
	public function listar_demanda($idusuario){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$listar = $this->db->prepare("	
											SELECT
											t1.id,
											t1.fecha,
											t1.hora,
											t2.des AS jurisdiccion,
											t3.des As claseproceso,
											t4.des As corporacion,
											t5.des As especualidad,
											t1.cuadernos,
											t1.folios,
											t1.estado,
											t1.tipo,
											t1.ruta,
											t1.anexos,
											t6.des AS departamento,
											t7.des AS municipio,
											t1.desdevo
											FROM ((((((dda_demanda t1
											INNER JOIN dda_jurisdiccion t2 ON t1.idjurisdiccion = t2.id)
											INNER JOIN dda_claseproceso t3 ON t1.idclaseproceso = t3.id)
											INNER JOIN dda_entidad      t4 ON t1.idcorporacion  = t4.id)
											INNER JOIN dda_especialidad t5 ON t1.idespecialidad = t5.id)
											INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
										    INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)
											WHERE t1.idusuario = '$idusuario'
											ORDER BY t1.id
											LIMIT 30 
											
											
										");
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function registrar_demanda_detalle(){
	
		
		$modelo     = new demandaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		//$accion       = "APRUEBA REMATE";
		//$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		//$tipolog      = 1;
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		//$Pidofireparto  = $_SESSION['idofireparto'];
		
		//DEPARTAMENTO Y MUNICIPIO, AL MOMENTO DEL LOGEO
		//DEFINEN DONDE QUEDARA LA DEMANDA
		$Riddepartamento  =  $_SESSION['iddepartamento'];
		$Ridmunicipio     =  $_SESSION['idmunicipio'];
		
		
		$juri	       = trim($_POST['juri']);
		$entidad	   = trim($_POST['entidad']);
		$especialidad  = trim($_POST['especialidad']);
		
		//SE UNE trim($fila['id']).'******'.trim($fila['idofireparto'])
		//PARA IDENTIFICAR QUE OFICINA DEBE REPARTIR DEMANDA
		//SI OFICINA JUDICIAL O CENTRO DE SERVICIOS CIVIL FAMILIA
		//APLICA PARA LOS OTROS MUNICIPIOS
		$cpro_datos    = explode("******",trim($_POST['cpro']));
		$cpro          = trim($cpro_datos[0]);
		$idofireparto  = trim($cpro_datos[1]);
		
		$cuadernos	   = utf8_decode(trim($_POST['cuadernos']));
		$folios        = utf8_decode(trim($_POST['folios']));
		$anexos        = utf8_decode(trim($_POST['anexos']));
		
		
		//-------------DETERMINAR LA OFICINA DE REPARTO SEGUN MUNICIPIO----------------
		//OTROS MUNICIPIOS Y QUE CUENTAN CON SOLO UNA OFICINA DE REPARTO
		/*if($Riddepartamento != '17' && $Ridmunicipio != '001'){
				
			$oficina_reparto = 1;
		}
		//MANIZALES, YA QUE CENTA CON DOS OFICINAS DE REPARTO
		//OFICINA JUDICIAL IDENTIFICADA CON 1 Y CENTRO CIVIL FAMILIA IDENTIFICADO CON 2
		else{
		
			if($juri == 1 || $juri == 2){
			
			}
		
		}*/
		//-------------FIN DETERMINAR LA OFICINA DE REPARTO SEGUN MUNICIPIO----------------
		
		
		
		//***********************************PARA EL ARCHIVO***************************************
	
		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "RECEPCION_DEMANDAS";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		$nom = trim($_SESSION['idUsuario']);
		//IDENTIFICA ERROR EN CARGA DEL ARCHIVO
		$erro_archivo = 0;
				
		//AQUI SE CREA EL DIRECTORIO
		//if(is_dir($raiz.'/'.$nom)){$bandera=0;}
		//else{mkdir($raiz.'/'.$nom, 0, true);}
				
		//CUANDO SOLO SE SUBE UN ARCHIVOS
		/*$nombre_archivo = $_FILES['archivo']['name']; 
		$tipo_archivo   = $_FILES['archivo']['type'];
		$tamano_archivo = $_FILES['archivo']['size'];*/ 
		
		
		//***********************************FIN PARA EL ARCHIVO***************************************
		
					
					//SE IDENTIFICA A QUE SERVIDOR SE ASIGNARA DEMANDA PARA SER REPARTIDA
					$idtipoaccion  = 1;//RECEPCION Y REPARTO DEMANDA
					

					$iduserreparto = $modelo->Asignar_Demanda($idtipoaccion,$Riddepartamento,$Ridmunicipio,$idofireparto);
					
					
		
					$datospartes   = trim($_POST['datospartes']);
					
					$datospartes_1A = explode("******",$datospartes); 
					$longitud_1     = count($datospartes_1A);
					$i              = 0;
					
					
					while($i < $longitud_1 - 1){
					
					
						//ENCABEZADO TABLA dda_demanda
						
						if($i == 0){
						
							//SQL A EJECUTAR 
							$SQL_1 = "	INSERT INTO dda_demanda(idjurisdiccion,idclaseproceso,idcorporacion,idespecialidad,
										cuadernos,folios,fecha,hora,idusuario,estado,tipo,ruta,anexos,iddepartamento,idmunicipio,iduserreparto,idofireparto)
										VALUES('$juri','$cpro','$entidad','$especialidad','$cuadernos','$folios','$fechalog','$horalog','$idusuario',0,
										'$tipo_archivo','$rutaarchivo','$anexos','$Riddepartamento','$Ridmunicipio','$iduserreparto','$idofireparto')";
										
						}
							
						
						//DETALLE TABLA dda_demanda_detalle
							
						//2 EXPLODE
						$datospartes_1B = explode("//////",$datospartes_1A[$i]);
						
						
						$nomddte        = utf8_decode(trim($datospartes_1B[0]));
						$docddte        = trim($datospartes_1B[1]);
						$iddepartamento = trim($datospartes_1B[2]);
						$idmunicipio    = trim($datospartes_1B[3]);
						$dir            = utf8_decode(trim($datospartes_1B[4]));
						$telefono       = utf8_decode(trim($datospartes_1B[5]));
						$correo         = utf8_decode(trim($datospartes_1B[6]));
						
						$idparte        = trim($datospartes_1B[7]);
						$idparte_1      = explode("-",$idparte);
						$idparte_X      = $idparte_1[0];//id parte
						
						//YA QUE EL APODERADO DEBE PONER EL DATO DE TARJETA PROFESIONAL
						//EL ES EL ID = 3 EN LA TABLA dda_tipopartes
						if($idparte_X == 3){
						
							$tp = utf8_decode(trim($idparte_1[2]));//tarjeta profesional
							
						}
						else{
			
							$tp = "No Aplica";
						}
						
						
				
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
											
								//ENCABEZADO TABLA dda_demanda	
								if($i == 0){
								
								
									$listarC = $this->db->prepare("SELECT cantidad
														           FROM pa_user_contador 
														           WHERE iduser = '$iduserreparto' AND idtipoaccion = '$idtipoaccion'");
								
							
									$listarC->execute();
										
									$fieldC     = $listarC->fetch();
										
									$cantidad_1 = $fieldC[cantidad];
										
									$cantidad_1 = $cantidad_1 + 1;
										
									$this->db->exec("UPDATE pa_user_contador
									                 SET cantidad        = '$cantidad_1' 
													 WHERE iduser        = '$iduserreparto' 
													 AND idtipoaccion    = '$idtipoaccion'");
													 
													 
									
									
									$this->db->exec($SQL_1);
									
									//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
									$last_id = $this->db->lastInsertId();
									
									
								
									//------------------------------------SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									//AQUI SE CREA EL DIRECTORIO, CON EL ID ASIGNADO A LA DEMANDA
									if(is_dir($raiz.'/'.$nom.'/'.$last_id)){$bandera=0;}
									else{mkdir($raiz.'/'.$nom.'/'.$last_id, 0, true);}

									$mensage       = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
									$archivo_error = 0;
									
									foreach ($_FILES as $key) //Iteramos el arreglo de archivos
									{
										if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
											{
											
												$nombre_archivo = $key['name'];//Obtenemos el nombre original del archivo
												$temporal       = $key['tmp_name']; //Obtenemos la ruta Original del archivo
												//$Destino        = $ruta.$NombreOriginal;//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
												$ruta           = $raiz.'/'.$nom.'/'.$last_id.'/'.$nombre_archivo;
												
												move_uploaded_file($temporal, $ruta); //Movemos el archivo temporal a la ruta especificada		
												
											}
									
										if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
											{
												//$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
												
												$rutaarchivo = utf8_decode($raiz.'/'.$nom.'/'.$last_id.'/'.$nombre_archivo);
												
												//TABLA dda_archivos, QUEDA LA RUTA DE LOS ARCHIVOS DE LA DEMANDA
												$this->db->exec("INSERT INTO dda_archivos(idda,ruta,tipo)
												VALUES('$last_id','$rutaarchivo','D')");
												
												
												
											}
										if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
											{
												$mensage .= '-> No se pudo subir el archivo <b>'.$nombre_archivo.'</b> debido al siguiente Error: n'.$key['error']; 
												
												$archivo_error = 1;
											}
										
									}
									
									//echo $mensage;// Regresamos los mensajes generados al cliente
									
									//------------------------------------FIN SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									
									
									
									
									
									
									
								}
								
								//DETALLE TABLA dda_demanda_detalle
								$this->db->exec("INSERT INTO dda_demanda_detalle(idda,docddte,nomddte,iddepartamento,idmunicipio,dir,telefono,idparte,tp,correo)
												 VALUES('$last_id','$docddte','$nomddte','$iddepartamento','$idmunicipio','$dir','$telefono','$idparte_X','$tp','$correo')");
											
											
											
								//$msg = "PROCESO SE REALIZA CORRECTAMENTE";
																		
								//SE TERMINA LA TRANSACCION  
								$this->db->commit();
														
								//echo $msg;
											
									
									  
						} 
						catch (Exception $e) {
									
										
							$i = $longitud_1 - 1;
										
							//IDENTIFICA QUE OCURIIO UN ERROR,CON ALGUN ARCHIVO QUE SE DESEA CARGAR
							if($archivo_error == 1){
							
								$msg = "ERROR EN PROCESO: ".$e->getMessage()." ERROR EN ARCHIVO: ".$mensage;
							}
							else{
							
								$msg = "ERROR EN PROCESO: ".$e->getMessage();
							
							}
										
										
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
							
							//SE ELIMINA EL DIRECTORIO Y EL ARCHIVO(S) SUBIDOS
							$ruta_borrar = $raiz.'/'.$nom.'/'.$last_id;
							$files       = array_diff(scandir($ruta_borrar), array('.','..')); 

							foreach ($files as $file) { 
							
								//(is_dir("$ruta_borrar/$file")) ? delTree("$ruta_borrar/$file") : unlink("$ruta_borrar/$file"); 
								
								if(is_dir("$ruta_borrar/$file")){
								
									 unlink("$ruta_borrar/$file");
									 
								} 
								  
							} 
							
							
							
										
									
							//echo $msg;
										
							$error_transaccion   = 1;
										
						}
									
						$i = $i + 1;
								
								
								
					}//FIN WHILE
							
					if($error_transaccion){
							
						echo $msg;
							
					}
					else{//X
					
					
				
						//SE TERMINA LA TRANSACCION  
						//$this->db->commit();
									
						$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
								
						echo $msg;
						
						
	
							
					}//x
					
					
					
				
				
				
				
			
		
				
  	}
	
	
	//REGISTRA CORRECTAMENTE PERO CON UN SOLO ARCHIVO
	public function registrar_demanda_detalle_COPIA(){
	
		
		$modelo     = new demandaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		//$accion       = "APRUEBA REMATE";
		//$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		//$tipolog      = 1;
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$juri	       = trim($_POST['juri']);
		$cpro          = trim($_POST['cpro']);
		$entidad	   = trim($_POST['entidad']);
		$especialidad  = trim($_POST['especialidad']);
		$cuadernos	   = trim($_POST['cuadernos']);
		$folios        = trim($_POST['folios']);
		
		
		
		//***********************************PARA EL ARCHIVO***************************************
	
		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "RECEPCION_DEMANDAS";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		$nom = trim($_SESSION['idUsuario']);
		//IDENTIFICA ERROR EN CARGA DEL ARCHIVO
		$erro_archivo = 0;
				
		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($raiz.'/'.$nom)){$bandera=0;}
		else{mkdir($raiz.'/'.$nom, 0, true);}
				
		//datos del arhivo 
		$nombre_archivo = $_FILES['archivo']['name']; 
		//echo $nombre_archivo;
		$tipo_archivo   = $_FILES['archivo']['type'];
		//echo $tipo_archivo;
		$tamano_archivo = $_FILES['archivo']['size']; 
		//echo $tamano_archivo;
		
		//***********************************FIN PARA EL ARCHIVO***************************************
		
		
		if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
		
		
			if (! ( strpos($tipo_archivo, "pdf") ) && ($tamano_archivo < 100000000) )  {			
				
				
				$msg = "LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA: ".$tipo_archivo;
				echo $msg;
		
			}
			else{//1 
			
			
				if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
						
						
					//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
					//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
					$idunico = time();
						
					$nombre_archivo = $idunico."_".$nombre_archivo;
						
						
				}
				
				if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
				
					
					//echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
					$rutaarchivo = utf8_decode($raiz.'/'.$nom.'/'.$nombre_archivo);
					
		
					$datospartes   = trim($_POST['datospartes']);
					
					$datospartes_1A = explode("******",$datospartes); 
					$longitud_1     = count($datospartes_1A);
					$i              = 0;
					
					
					while($i < $longitud_1 - 1){
					
					
						//ENCABEZADO TABLA dda_demanda
						
						if($i == 0){
						
							//SQL A EJECUTAR 
							$SQL_1 = "	INSERT INTO dda_demanda(
										idjurisdiccion,
										idclaseproceso,
										idcorporacion,
										idespecialidad,
										cuadernos,
										folios,
										fecha,
										hora,
										idusuario,
										estado,
										tipo,
										ruta)
										VALUES('$juri','$cpro','$entidad','$especialidad','$cuadernos','$folios','$fechalog','$horalog','$idusuario',0,
										'$tipo_archivo','$rutaarchivo')";
										
										
							
						
						}
							
						
						//DETALLE TABLA dda_demanda_detalle
							
						//2 EXPLODE
						$datospartes_1B = explode("//////",$datospartes_1A[$i]);
						
						
						$nomddte        = utf8_decode(trim($datospartes_1B[0]));
						$docddte        = trim($datospartes_1B[1]);
						$iddepartamento = trim($datospartes_1B[2]);
						$idmunicipio    = trim($datospartes_1B[3]);
						$dir            = utf8_decode(trim($datospartes_1B[4]));
						$telefono       = utf8_decode(trim($datospartes_1B[5]));
						$correo         = utf8_decode(trim($datospartes_1B[6]));
						
						$idparte        = trim($datospartes_1B[7]);
						$idparte_1      = explode("-",$idparte);
						$idparte_X      = $idparte_1[0];//id parte
						
						//YA QUE EL APODERADO DEBE PONER EL DATO DE TARJETA PROFESIONAL
						//EL ES EL ID = 3 EN LA TABLA dda_tipopartes
						if($idparte_X == 3){
						
							$tp = $idparte_1[2];//tarjeta profesional
							
						}
						else{
			
							$tp = "No Aplica";
						}
						
						
				
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
											
								//ENCABEZADO TABLA dda_demanda	
								if($i == 0){
									
									$this->db->exec($SQL_1);
									
									//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
									$last_id = $this->db->lastInsertId();
								}
								
								//DETALLE TABLA dda_demanda_detalle
								$this->db->exec("INSERT INTO dda_demanda_detalle(idda,docddte,nomddte,iddepartamento,idmunicipio,dir,telefono,idparte,tp,correo)
												 VALUES('$last_id','$docddte','$nomddte','$iddepartamento','$idmunicipio','$dir','$telefono','$idparte_X','$tp','$correo')");
											
											
											
								//$msg = "PROCESO SE REALIZA CORRECTAMENTE";
																		
								//SE TERMINA LA TRANSACCION  
								$this->db->commit();
														
								//echo $msg;
											
									
									  
						} 
						catch (Exception $e) {
									
										
							$i = $longitud_1 - 1;
										
				
							$msg = "ERROR EN PROCESO: ".$e->getMessage();
										
										
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
										
									
							//echo $msg;
										
							$error_transaccion   = 1;
										
						}
									
						$i = $i + 1;
								
								
								
					}//FIN WHILE
							
					if($error_transaccion){
							
						echo $msg;
							
					}
					else{
					
						//SE TERMINA LA TRANSACCION  
						//$this->db->commit();
								
						$msg = "PROCESO SE REALIZA CORRECTAMENTE";
								
						echo $msg;
							
					}
					
					
					
				}//FIN if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
				else{ 
							
					$msg = "Error al subir el fichero.";		 
					echo $msg;
				
																		
				}
				
				
				
			}//FIN else{//1 
			
			
		}//FIN if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
		else{ 
							
			$msg = "NO SE SELECCIONO UN ARCHIVO";		 
			echo $msg;
				
																		
		}
				
			
				
				
  	}
	
	public function listar_demanda_filtro($idusuario){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			$filtro9;
			$filtro10;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t1.idjurisdiccion = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				
				$filtro3 = " AND t1.idclaseproceso = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.idcorporacion = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.idespecialidad = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t6.nomddte LIKE '%$datox6%' ";
			
			}
			
			if ( !empty($datox7) ) {
			
				
				
				$filtro6 = " AND t6.docddte LIKE '%$datox7%' ";
			
			}
			
			//if ( !empty($datox8) ) {
			if ( $datox8 == 0  || $datox8 == 1 ) {
			
				
				
				$filtro8 = " AND t1.estado = '$datox8' ";
			
			}
			
			if ( !empty($datox9) ) {
			
				
				
				$filtro9 = " AND t1.iddepartamento = '$datox9' ";
			
			}
			
			if ( !empty($datox10) ) {
			
				
				
				$filtro10 = " AND t1.idmunicipio = '$datox10' ";
			
			}
			
		
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtro9." ".$filtro10." ".$filtrof;
		
			//LIMIT 30
		
			$listar = $this->db->prepare("	
											SELECT
											t1.id,
											t1.fecha,
											t1.hora,
											t2.des AS jurisdiccion,
											t3.des As claseproceso,
											t4.des As corporacion,
											t5.des As especualidad,
											t1.cuadernos,
											t1.folios,
											t1.estado,
											t1.tipo,
											t1.ruta,
											t1.anexos,
											t7.des AS departamento,
											t8.des AS municipio,
											t1.desdevo
											FROM (((((((dda_demanda t1
											INNER JOIN dda_jurisdiccion t2    ON t1.idjurisdiccion = t2.id)
											INNER JOIN dda_claseproceso t3    ON t1.idclaseproceso = t3.id)
											INNER JOIN dda_entidad      t4    ON t1.idcorporacion  = t4.id)
											INNER JOIN dda_especialidad t5    ON t1.idespecialidad = t5.id)
											INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
											INNER JOIN dda_departamento t7    ON t1.iddepartamento = t7.id)
										    INNER JOIN dda_municipio    t8    ON t1.idmunicipio    = t8.id)
											WHERE t1.id >= '1'" .$filtrox. "
											AND t1.idusuario = '$idusuario'
											GROUP BY t1.id 
											ORDER BY t1.id 
											
											
										");
											
											
													

  			$listar->execute();
			
			/*$SQL = "SELECT
											t1.id,
											t1.fecha,
											t1.hora,
											t2.des AS jurisdiccion,
											t3.des As claseproceso,
											t4.des As corporacion,
											t5.des As especualidad,
											t1.cuadernos,
											t1.folios,
											t1.estado,
											t1.tipo,
											t1.ruta,
											t1.anexos,
											t7.des AS departamento,
											t8.des AS municipio
											FROM (((((((dda_demanda t1
											INNER JOIN dda_jurisdiccion t2    ON t1.idjurisdiccion = t2.id)
											INNER JOIN dda_claseproceso t3    ON t1.idclaseproceso = t3.id)
											INNER JOIN dda_entidad      t4    ON t1.idcorporacion  = t4.id)
											INNER JOIN dda_especialidad t5    ON t1.idespecialidad = t5.id)
											INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
											INNER JOIN dda_departamento t7    ON t1.iddepartamento = t7.id)
										    INNER JOIN dda_municipio    t8    ON t1.idmunicipio    = t8.id)
											WHERE t1.id >= '1'" .$filtrox. "
											AND t1.idusuario = '$idusuario'
											GROUP BY t1.id 
											ORDER BY t1.id ";
											
			echo $SQL;*/

  			return $listar;
	
  	}
	
	//-------------------------------------
			//FIN MODULO RECEPCION DEMANDA
	//-------------------------------------
	
	
	
	
	//-------------------------------------
			//MODULO CONSULTAR DEMANDA
	//-------------------------------------
	
	public function listar_demanda_2(){
	
	
			//DEPARTAMENTO Y MUNICIPIO, AL MOMENTO DEL LOGEO
			//DEFINEN DONDE QUEDARA LA DEMANDA
			$Ciddepartamento  =  $_SESSION['iddepartamento'];
			$Cidmunicipio     =  $_SESSION['idmunicipio'];
	
	
			$idusuario     = $_SESSION['idUsuario'];
			
			$nivelusuarioX = $_SESSION['nivelusuario'];
			
			//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
			//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
			$id_juzgado_user = $_SESSION['id_juzgado'];
			
			//USUARIO PUEDE VER TODO
			if($nivelusuarioX == 'administrador'){
			
				$listar = $this->db->prepare("	
												SELECT
												t1.id,
												t1.fecha,
												t1.hora,
												t2.des AS jurisdiccion,
												t3.des As claseproceso,
												t4.des As corporacion,
												t5.des As especualidad,
												t1.cuadernos,
												t1.folios,
												t1.estado,
												t1.tipo,
												t1.ruta,
												t1.anexos,
												t6.des AS departamento,
												t7.des AS municipio,
												t1.desdevo
												FROM ((((((dda_demanda t1
												INNER JOIN dda_jurisdiccion t2 ON t1.idjurisdiccion = t2.id)
												INNER JOIN dda_claseproceso t3 ON t1.idclaseproceso = t3.id)
												INNER JOIN dda_entidad      t4 ON t1.idcorporacion  = t4.id)
												INNER JOIN dda_especialidad t5 ON t1.idespecialidad = t5.id)
												INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
 												INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)
												WHERE t1.iddepartamento = '$Ciddepartamento'
												AND t1.idmunicipio      = '$Cidmunicipio'
												ORDER BY t1.id 
												LIMIT 30
												
											");
			
			}
			else{
			
				//USUARIO DESPACHO
				if($id_juzgado_user >= 1){
				
					$listar = $this->db->prepare("	
													SELECT
													t1.id,
													t1.fecha,
													t1.hora,
													t2.des AS jurisdiccion,
													t3.des As claseproceso,
													t4.des As corporacion,
													t5.des As especualidad,
													t1.cuadernos,
													t1.folios,
													t1.estado,
													t1.tipo,
													t1.ruta,
													t1.anexos,
													t6.des AS departamento,
													t7.des AS municipio,
													t1.desdevo
													FROM ((((((dda_demanda t1
													INNER JOIN dda_jurisdiccion t2 ON t1.idjurisdiccion = t2.id)
													INNER JOIN dda_claseproceso t3 ON t1.idclaseproceso = t3.id)
													INNER JOIN dda_entidad      t4 ON t1.idcorporacion  = t4.id)
													INNER JOIN dda_especialidad t5 ON t1.idespecialidad = t5.id)
													INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
													INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)
													WHERE t1.iddespacho   = '$id_juzgado_user' 
													AND t1.iddepartamento = '$Ciddepartamento'
													AND t1.idmunicipio    = '$Cidmunicipio'
													ORDER BY t1.id 
													LIMIT 30
													
												");
				}
				//USUARIO QUE REPARTE Y SOLO VE LO ASIGNADO A EL
				else{
			
					$listar = $this->db->prepare("	
													SELECT
													t1.id,
													t1.fecha,
													t1.hora,
													t2.des AS jurisdiccion,
													t3.des As claseproceso,
													t4.des As corporacion,
													t5.des As especualidad,
													t1.cuadernos,
													t1.folios,
													t1.estado,
													t1.tipo,
													t1.ruta,
													t1.anexos,
													t6.des AS departamento,
													t7.des AS municipio,
													t1.desdevo
													FROM ((((((dda_demanda t1
													INNER JOIN dda_jurisdiccion t2 ON t1.idjurisdiccion = t2.id)
													INNER JOIN dda_claseproceso t3 ON t1.idclaseproceso = t3.id)
													INNER JOIN dda_entidad      t4 ON t1.idcorporacion  = t4.id)
													INNER JOIN dda_especialidad t5 ON t1.idespecialidad = t5.id)
													INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
													INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)
													WHERE t1.iddepartamento = '$Ciddepartamento'
													AND t1.idmunicipio      = '$Cidmunicipio'
													AND t1.iduserreparto    = '$idusuario'
													ORDER BY t1.id 
													LIMIT 30
													
												");
												
				}
				
				
			}
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function listar_demanda_2_filtro(){
	
	
			$idusuario  = $_SESSION['idUsuario'];
			
			//DEPARTAMENTO Y MUNICIPIO, AL MOMENTO DEL LOGEO
			//DEFINEN DONDE QUEDARA LA DEMANDA
			$Ciddepartamento  =  $_SESSION['iddepartamento'];
			$Cidmunicipio     =  $_SESSION['idmunicipio'];
			
			$nivelusuarioX = $_SESSION['nivelusuario'];
			
			//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
			//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
			$id_juzgado_user = $_SESSION['id_juzgado'];
		
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t1.idjurisdiccion = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				
				$filtro3 = " AND t1.idclaseproceso = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.idcorporacion = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.idespecialidad = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t6.nomddte LIKE '%$datox6%' ";
			
			}
			
			if ( !empty($datox7) ) {
			
				
				
				$filtro6 = " AND t6.docddte LIKE '%$datox7%' ";
			
			}
			
			if ( $datox8 == 0  || $datox8 == 1 ) {
			
				
				
				$filtro8 = " AND t1.estado = '$datox8' ";
			
			}
		
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtrof;
		
			//LIMIT 30
			
			
			
			//USUARIO PUEDE VER TODO
			if($nivelusuarioX == 'administrador'){
			
				$listar = $this->db->prepare("	
												SELECT
												t1.id,
												t1.fecha,
												t1.hora,
												t2.des AS jurisdiccion,
												t3.des As claseproceso,
												t4.des As corporacion,
												t5.des As especualidad,
												t1.cuadernos,
												t1.folios,
												t1.estado,
												t1.tipo,
												t1.ruta,
												t1.anexos,
												t7.des AS departamento,
											    t8.des AS municipio,
												t1.desdevo
												FROM (((((((dda_demanda t1
												INNER JOIN dda_jurisdiccion    t2 ON t1.idjurisdiccion = t2.id)
												INNER JOIN dda_claseproceso    t3 ON t1.idclaseproceso = t3.id)
												INNER JOIN dda_entidad         t4 ON t1.idcorporacion  = t4.id)
												INNER JOIN dda_especialidad    t5 ON t1.idespecialidad = t5.id)
												INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
												INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
												INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)
												WHERE t1.id >= '1'" .$filtrox. "
												AND t1.iddepartamento = '$Ciddepartamento'
												AND t1.idmunicipio    = '$Cidmunicipio'
												GROUP BY t1.id 
												ORDER BY t1.id 
												
												
											");
			
			}
			else{
				//USUARIO DESPACHO
				if($id_juzgado_user >= 1){
				
						$listar = $this->db->prepare("	
														SELECT
														t1.id,
														t1.fecha,
														t1.hora,
														t2.des AS jurisdiccion,
														t3.des As claseproceso,
														t4.des As corporacion,
														t5.des As especualidad,
														t1.cuadernos,
														t1.folios,
														t1.estado,
														t1.tipo,
														t1.ruta,
														t1.anexos,
														t7.des AS departamento,
														t8.des AS municipio,
														t1.desdevo
														FROM (((((((dda_demanda t1
														INNER JOIN dda_jurisdiccion    t2 ON t1.idjurisdiccion = t2.id)
														INNER JOIN dda_claseproceso    t3 ON t1.idclaseproceso = t3.id)
														INNER JOIN dda_entidad         t4 ON t1.idcorporacion  = t4.id)
														INNER JOIN dda_especialidad    t5 ON t1.idespecialidad = t5.id)
														INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
														INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
														INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)
														WHERE t1.id >= '1'" .$filtrox. "
														AND t1.iddespacho     = '$id_juzgado_user'
														AND t1.iddepartamento = '$Ciddepartamento'
														AND t1.idmunicipio    = '$Cidmunicipio'
														GROUP BY t1.id 
														ORDER BY t1.id 
													
													
												");
	
				}
				//USUARIO QUE REPARTE Y SOLO VE LO ASIGNADO A EL
				else{
				
					$listar = $this->db->prepare("	
													SELECT
													t1.id,
													t1.fecha,
													t1.hora,
													t2.des AS jurisdiccion,
													t3.des As claseproceso,
													t4.des As corporacion,
													t5.des As especualidad,
													t1.cuadernos,
													t1.folios,
													t1.estado,
													t1.tipo,
													t1.ruta,
													t1.anexos,
													t7.des AS departamento,
													t8.des AS municipio,
													t1.desdevo
													FROM (((((((dda_demanda t1
													INNER JOIN dda_jurisdiccion    t2 ON t1.idjurisdiccion = t2.id)
													INNER JOIN dda_claseproceso    t3 ON t1.idclaseproceso = t3.id)
													INNER JOIN dda_entidad         t4 ON t1.idcorporacion  = t4.id)
													INNER JOIN dda_especialidad    t5 ON t1.idespecialidad = t5.id)
													INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
													INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
													INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)
													WHERE t1.id >= '1'" .$filtrox. "
													AND t1.iddepartamento = '$Ciddepartamento'
													AND t1.idmunicipio    = '$Cidmunicipio'
													AND t1.iduserreparto  = '$idusuario'
													GROUP BY t1.id 
													ORDER BY t1.id 
													
													
												");
				
				}
				
				
			}
											
													

  			$listar->execute();
			
			/*$SQL = "SELECT
											t1.id,
											t1.fecha,
											t1.hora,
											t2.des AS jurisdiccion,
											t3.des As claseproceso,
											t4.des As corporacion,
											t5.des As especualidad,
											t1.cuadernos,
											t1.folios,
											t1.estado,
											t1.tipo,
											t1.ruta
											FROM (((((dda_demanda t1
											INNER JOIN dda_jurisdiccion t2    ON t1.idjurisdiccion = t2.id)
											INNER JOIN dda_claseproceso t3    ON t1.idclaseproceso = t3.id)
											INNER JOIN dda_entidad      t4    ON t1.idcorporacion  = t4.id)
											INNER JOIN dda_especialidad t5    ON t1.idespecialidad = t5.id)
											INNER JOIN dda_demanda_detalle t6 ON t1.id = t6.idda)
											WHERE t1.id >= '1'" .$filtrox. "
											ORDER BY t1.id";
											
			echo $SQL;*/

  			return $listar;
	
  	}
	
	
	
	public function registrar_acta_reparto_2(){
	
		
		$modelo     = new demandaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		//$accion       = "APRUEBA REMATE";
		//$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		//$tipolog      = 1;
		
		//SE OBTIENEN LOS DATOS
		$idusuario = $_SESSION['idUsuario'];
		
		$iddemanda = trim($_POST['iddemanda']);
		$despacho  = trim($_POST['despacho']);
		
		
		//***********************************PARA EL ARCHIVO***************************************
	
		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "ACTAS_REPARTO";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		$nom = trim($_SESSION['idUsuario']);
		//IDENTIFICA ERROR EN CARGA DEL ARCHIVO
		$erro_archivo = 0;
				
		//AQUI SE CREA EL DIRECTORIO
		//if(is_dir($raiz.'/'.$nom)){$bandera=0;}
		//else{mkdir($raiz.'/'.$nom, 0, true);}
				
		//CUANDO SOLO SE SUBE UN ARCHIVOS
		/*$nombre_archivo = $_FILES['archivo']['name']; 
		$tipo_archivo   = $_FILES['archivo']['type'];
		$tamano_archivo = $_FILES['archivo']['size'];*/ 
		
		
		//***********************************FIN PARA EL ARCHIVO***************************************
		
		
					
						
						//SQL A EJECUTAR 
						$SQL_1 = "	UPDATE dda_demanda SET
											
										estado         = 1,
										iddespacho     = '$despacho',
										idusuarioedita = '$idusuario',
										fechaedita     = '$fechalog',
										horaedita      = '$horalog'
									
									WHERE id = '$iddemanda'	";
										
										
							
		
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
									
									$this->db->exec($SQL_1);
									
									//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
									//$last_id = $this->db->lastInsertId();
									
									$last_id = $iddemanda;
									
						
									//------------------------------------SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									//AQUI SE CREA EL DIRECTORIO, CON EL ID ASIGNADO A LA DEMANDA
									if(is_dir($raiz.'/'.$nom.'/'.$despacho.'/'.$last_id)){$bandera=0;}
									else{mkdir($raiz.'/'.$nom.'/'.$despacho.'/'.$last_id, 0, true);}

									$mensage       = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.
									$archivo_error = 0;
									
									foreach ($_FILES as $key) //Iteramos el arreglo de archivos
									{
										if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
											{
											
												$nombre_archivo = $key['name'];//Obtenemos el nombre original del archivo
												$temporal       = $key['tmp_name']; //Obtenemos la ruta Original del archivo
												//$Destino        = $ruta.$NombreOriginal;//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
												$ruta           = $raiz.'/'.$nom.'/'.$despacho.'/'.$last_id.'/'.$nombre_archivo;
												
												move_uploaded_file($temporal, $ruta); //Movemos el archivo temporal a la ruta especificada		
												
											}
									
										if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
											{
												//$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
												
												$rutaarchivo = utf8_decode($raiz.'/'.$nom.'/'.$despacho.'/'.$last_id.'/'.$nombre_archivo);
												
												//TABLA dda_archivos, QUEDA LA RUTA DE LOS ARCHIVOS DE LA DEMANDA
												$this->db->exec("INSERT INTO dda_archivos(idda,ruta,tipo)
												VALUES('$last_id','$rutaarchivo','A')");
												
												
												
											}
										if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
											{
												$mensage .= '-> No se pudo subir el archivo <b>'.$nombre_archivo.'</b> debido al siguiente Error: n'.$key['error']; 
												
												$archivo_error = 1;
											}
										
									}
									
									//echo $mensage;// Regresamos los mensajes generados al cliente
									
									//------------------------------------FIN SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									
											
											
								//$msg = "PROCESO SE REALIZA CORRECTAMENTE";
																		
								//SE TERMINA LA TRANSACCION  
								$this->db->commit();
														
								//echo $msg;
											
									
									  
						} 
						catch (Exception $e) {
									
										
						
							//IDENTIFICA QUE OCURIIO UN ERROR,CON ALGUN ARCHIVO QUE SE DESEA CARGAR
							if($archivo_error == 1){
							
								$msg = "ERROR EN PROCESO: ".$e->getMessage()." ERROR EN ARCHIVO: ".$mensage;
							}
							else{
							
								$msg = "ERROR EN PROCESO: ".$e->getMessage();
							
							}
										
										
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
							
							//SE ELIMINA EL DIRECTORIO Y EL ARCHIVO(S) SUBIDOS
							$ruta_borrar = $raiz.'/'.$nom.'/'.$despacho.'/'.$last_id;
							$files       = array_diff(scandir($ruta_borrar), array('.','..')); 

							foreach ($files as $file) { 
							
								//(is_dir("$ruta_borrar/$file")) ? delTree("$ruta_borrar/$file") : unlink("$ruta_borrar/$file"); 
								
								if( is_dir("$ruta_borrar/$file") ){ 
									
									 unlink("$ruta_borrar/$file"); 
								}
								  
							} 
					
							//echo $msg;
										
							$error_transaccion   = 1;
							
							
						}
							
										
							
						if($error_transaccion){
								
							echo $msg;
								
						}
						else{
						
						
					
							//SE TERMINA LA TRANSACCION  
							//$this->db->commit();
										
							$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
									
							echo $msg;
							
							
		
								
						}
					
					
					
				
				
				
				
			
		
				
  	}
	
	
	
	public function registrar_devolucion(){
	
		
		$modelo = new demandaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		//$accion       = "APRUEBA REMATE";
		//$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		//$tipolog      = 1;
		
		//SE OBTIENEN LOS DATOS
		$idusuario = $_SESSION['idUsuario'];
		
		$Didentidad_user = $_SESSION['nomusu'];
		$Dnombre_user    = $_SESSION['nombre'];
		
		$devolucion      = "DEVOLUCION, REALIZADA POR DESPACHO: ".$Didentidad_user." - ".$Dnombre_user;
		
		$idevo = trim($_POST['idevo']);
		
		
		
						
						//SQL A EJECUTAR 
						$SQL_1 = "	UPDATE dda_demanda SET
											
										estado         = 2,
										iddespacho     = NULL,
										idusuarioedita = '$idusuario',
										fechaedita     = '$fechalog',
										horaedita      = '$horalog',
										iddevo         = '$idusuario',
										desdevo        = '$devolucion'
									
									WHERE id = '$idevo'	";
										
										
							
		
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
									
									$this->db->exec($SQL_1);
									
									
								
																		
							//SE TERMINA LA TRANSACCION  
							$this->db->commit();
														
								
											
									
									  
						} 
						catch (Exception $e) {
									
										
						
							$msg = "ERROR EN PROCESO: ".$e->getMessage();
										
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
							
							
					
							//echo $msg;
										
							$error_transaccion   = 1;
							
							
						}
							
										
							
						if($error_transaccion){
								
							echo $msg;
								
						}
						else{
						
						
					
							//SE TERMINA LA TRANSACCION  
							//$this->db->commit();
										
							$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
									
							echo $msg;
							
							
		
								
						}
					
					
					
				
  	}
	
	//-------------------------------------
			//FIN MODULO CONSULTAR DEMANDA
	//-------------------------------------
	
	
	//---------------------------------------------------------
			//ASIGNACION A SERVIDOR JUDICIAL QUE VA A REPARTIR
	//---------------------------------------------------------
	
	//ASIGNAR DEMANDA
	//PERMITE SELECIONAR AL SERVIDOR JUDICIAL QUE TENGA MENOS DEMANDAS 
	public function Asignar_Demanda($idtipoaccion,$Riddepartamento,$Ridmunicipio,$idofireparto){
	
		
		$modelo = new demandaModel();
		
		
		$arreglo_1 = array();
		$arreglo_2 = array();
		
	
		$listar = $this->db->prepare("SELECT * FROM pa_user_contador 
		                              WHERE idtipoaccion = '$idtipoaccion' 
									  AND activo         = 1
									  AND iddepartamento = '$Riddepartamento'
									  AND idmunicipio    = '$Ridmunicipio'
									  AND idofireparto   = '$idofireparto'");
												  
		$listar->execute();
					
		$resultado = $listar->rowCount();
					
		
		//CARGO LOS VECTORES
		//$arreglo_1[] CON EL ID DEL SERVIDOR JUDICIAL Y LA CANTIDAD DE DEMANDAS A EL ASIGNADAS
		//$arreglo_2[] CON LA CANTIDAD DE LAS DEMANDAS ASIGNADAS AL SERVIDOR JUDICIAL
		while( $fila = $listar->fetch() ){
					
			$dc0 = $fila[iduser];
			$dc1 = $fila[cantidad];
			
			$arreglo_1[] = $dc0."******".$dc1;

			$arreglo_2[] = $dc1;
		}
		
		//CALCULO EL VALOR MENOR DEL VECTOR DE CANTIDADES arreglo_2
		//PARA LUEGO RECORRER arreglo_1 Y SABER CUAL ES EL SERVIDOR JUDICIAL 
		//A ASIGNARLE LA NUEVA DEMANDA
		$menor_valor = min($arreglo_2); 
		
		for($ci = 0; $ci < count($arreglo_1); $ci++){
		
			$arreglo_1B = explode("******",$arreglo_1[$ci]);
			
			if($arreglo_1B[1] == $menor_valor){
			
				$id_sj = $arreglo_1B[0];
				
				$ci    = count($arreglo_1);
			
			}
		
		}

	    return $id_sj;
															
	}
	
	
	
  
}//FIN CLASE MODELO
?>