<?php

class usuarioModel extends modelBase{

	
	public function rango_horas_plataforma(){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$listar = $this->db->prepare("	
			
											SELECT hi,hf,hi2,hf2 
											FROM expe_horario 
					
											
										");
											
											
								
									

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function rango_horas_municipio($idmunicipio,$iddepartamento){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$listar = $this->db->prepare("	
			
											SELECT hi,hf,hi2,hf2 
											FROM dda_municipio 
											WHERE id = '$idmunicipio' AND iddpto = '$iddepartamento'
											
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
	
	public function listar_usuarios($idusuario){
	
	
			set_time_limit (240000000);
			
			//$idusuario  = $_SESSION['idUsuario'];
			
			$iddepartamento  =  $_SESSION['iddepartamento'];
			$idmunicipio     =  $_SESSION['idmunicipio'];
		
		
			/*$listar = $this->db->prepare("	
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
											INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id AND t6.id ='$iddepartamento')
										    INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id AND t7.id ='$idmunicipio' AND t7.iddpto='$iddepartamento')
											WHERE t1.idusuario    = '$idusuario'
											
											ORDER BY t1.id
											LIMIT 20
											
											
										");*/
										
										
			
			$listar = $this->db->prepare("	
											SELECT * FROM pa_usuario_expe
											ORDER BY id
											LIMIT 20
											
											
										");							
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function registrar_usuarios(){
	
		set_time_limit (240000000);
		
		$modelo     = new usuarioModel();
		
		$servidor_pdf = trim($_SESSION['ipplataforma']);		
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		
		$rango_horas = $modelo->rango_horas_plataforma();	
		$rango       = $rango_horas->fetch();
		
		$hi          = $rango[hi];
		$hf          = $rango[hf];
		$hi2         = $rango[hi2];
		$hf2         = $rango[hf2];
		
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
		
		
		
		/*$dato1	   = trim($_POST['dato1']);
		$dato2	   = trim($_POST['dato2']);
		$dato3	   = trim($_POST['dato3']);
		$dato4	   = trim($_POST['dato4']);
		$dato5	   = trim($_POST['lista1']);
		$dato6	   = trim($_POST['lista2']);
	
		$dato7X    = explode("-",trim($_POST['dato5']));
		$dato7     = trim($dato7X[0]);*/
		
		
		
					$datospartes   = trim($_POST['datospartes']);
					
					$datospartes_1A = explode("******",$datospartes); 
					$longitud_1     = count($datospartes_1A);
					$i              = 0;
					
					
					while($i < $longitud_1 - 1){
					
					
						
						$datospartes_1B = explode("//////",$datospartes_1A[$i]);
						
						
						$dato0	   = trim($datospartes_1B[0]);
						$dato1	   = md5(trim($datospartes_1B[1]));
						$dato2	   = utf8_decode(trim($datospartes_1B[2]));
						$dato3	   = utf8_decode(trim($datospartes_1B[3]));
						//$dato4	   = trim($datospartes_1B[4]);
						//$dato5	   = trim($datospartes_1B[5]);
					
						$idparte        = trim($datospartes_1B[4]);
						$idparte_1      = explode("-",$idparte);
						$idparte_X      = $idparte_1[0];//id parte
						
						
						//ABOGADO, DEPARTAMENTO Y MUNICIPIO NULL
						if($idparte_X == 1 || $idparte_X == 3){
						
							$dato4 = 'NULL';
							$dato5 = 'NULL';
							
						}
						
						$dato6	   = utf8_decode(trim($datospartes_1B[5]));
						
						$dato8	   = utf8_decode(trim($datospartes_1B[6]));
						
				
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
								
								//ABOGADO			
								if($idparte_X == 1 || $idparte_X == 3){
								
									if($idparte_X == 1){
										$pantalla = "ABOGADO";
										$esabogado = "SI";
									}
									if($idparte_X == 3){
										$pantalla  = "ESTUDIANTEDEDERECHO";
										$esabogado = $pantalla;
									}
									
									
									$this->db->exec("INSERT INTO pa_usuario_expe (nombre_usuario,idperfil,tipo_perfil,empleado,contrasena,
													 foto,idareaempleado,pantalla,fecha,hora,tipousuario,iddepartamento,idmunicipio,esabogado,correo,plataforma,ipplataforma,ingreso_activo,
													 hi,hf,hi2,hf2,celular,esentidad)
													 VALUES ('$dato0',1,'admin','$dato2','$dato1',
													 'views/fotos/usuario.png',7,'ABOGADO','$fechalog','$horalog','PUBLICO',NULL,NULL,'$esabogado','$dato3','EJECUCION','$servidor_pdf',1,
													 '$hi','$hf','$hi2','$hf2','$dato6','$dato8')");
													 
													 
									
									/*$this->db->exec("UPDATE pa_usuario_solicitud
													 SET estado = 0
													 WHERE cedula = '$dato0' AND estado = 1");*/
													 
								}
								//no es ABOGADO			
								else{
								
									$this->db->exec("INSERT INTO pa_usuario_expe (nombre_usuario,idperfil,tipo_perfil,empleado,contrasena,
													 foto,idareaempleado,pantalla,fecha,hora,tipousuario,iddepartamento,idmunicipio,esabogado,correo,plataforma,ipplataforma,ingreso_activo,
													 hi,hf,hi2,hf2,celular,esentidad)
													 VALUES ('$dato0',1,'admin','$dato2','$dato1',
													 'views/fotos/usuario.png',7,'PARTE','$fechalog','$horalog','PUBLICO',NULL,NULL,'NO','$dato3','EJECUCION','$servidor_pdf',1,
													 '$hi','$hf','$hi2','$hf2','$dato6','$dato8')");
								
								
								}
											
											
											
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
					else{//X
					
					
				
						//SE TERMINA LA TRANSACCION  
						//$this->db->commit();
									
						$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
								
						echo $msg;
						
						
	
							
					}//x
					
					
					
				
  	}
	
	
	public function listar_usuarios_2($idusuario){
	
	
			set_time_limit (240000000);
			
			//$idusuario  = $_SESSION['idUsuario'];
			
			$iddepartamento  =  $_SESSION['iddepartamento'];
			$idmunicipio     =  $_SESSION['idmunicipio'];
		
		
			/*$listar = $this->db->prepare("	
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
											INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id AND t6.id ='$iddepartamento')
										    INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id AND t7.id ='$idmunicipio' AND t7.iddpto='$iddepartamento')
											WHERE t1.idusuario    = '$idusuario'
											
											ORDER BY t1.id
											LIMIT 20
											
											
										");*/
										
										
			
			$listar = $this->db->prepare("	
											SELECT * FROM pa_usuario_solicitud
											WHERE estado = 1
											ORDER BY id
											
											
											
										");							
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function buscar_pa_usuario($nombre_usuarioX){
	
	
			set_time_limit (240000000);
			
			
			
			$listar = $this->db->prepare("	
											SELECT * FROM pa_usuario_expe
											WHERE nombre_usuario = '$nombre_usuarioX'
											
											
										");							
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	public function registrar_solicitudes(){
	
		set_time_limit (240000000);
		
		$modelo     = new usuarioModel();
				
		
		$servidor_pdf = trim($_SESSION['ipplataforma']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		
		$rango_horas = $modelo->rango_horas_plataforma();	
		$rango       = $rango_horas->fetch();
		
		$hi          = $rango[hi];
		$hf          = $rango[hf];
		$hi2         = $rango[hi2];
		$hf2         = $rango[hf2];
		
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
		
		
		/*$dato1	   = trim($_POST['dato1']);
		$dato2	   = trim($_POST['dato2']);
		$dato3	   = trim($_POST['dato3']);
		$dato4	   = trim($_POST['dato4']);
		$dato5	   = trim($_POST['lista1']);
		$dato6	   = trim($_POST['lista2']);
	
		$dato7X    = explode("-",trim($_POST['dato5']));
		$dato7     = trim($dato7X[0]);*/
		
		
		
					$datospartes   = trim($_POST['datospartes']);
					
					$datospartes_1A = explode("******",$datospartes); 
					$longitud_1     = count($datospartes_1A);
					$i              = 0;
					
					
					while($i < $longitud_1 - 1){
					
					
						
						$datospartes_1B = explode("//////",$datospartes_1A[$i]);
						
						//$dato1	   = md5(trim($datospartes_1B[1]));
						
						$dato0	   = trim($datospartes_1B[0]);//ID
						$dato1	   = trim($datospartes_1B[1]);//CEDULA
						$dato2	   = utf8_decode(trim($datospartes_1B[2]));//NOMBRE
						$dato3	   = utf8_decode(trim($datospartes_1B[3]));//CORREO
						$dato4	   = utf8_decode(trim($datospartes_1B[4]));//CELULAR
						$dato5	   = utf8_decode(trim($datospartes_1B[5]));//ES ABOGADO
						$dato6	   = utf8_decode(trim($datospartes_1B[6]));//ENTIDAD
						
						if($dato5 == "SI"){
							
							$pantalla = "ABOGADO";
						}
						if($dato5 == "NO"){
						
							$pantalla = "PARTE";
						}
						if($dato5 == "ESTUDIANTEDEDERECHO"){
						
							$pantalla = "ESTUDIANTEDEDERECHO";
						}
						
						$existeU   = trim($datospartes_1B[6]);//USUARIO EXISTE
						
						
				
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
								
								
									$contrasena = md5('admin');
									
									
									//EL USUARIO NO EXISTE Y SE CREA
									if($existeU == 0){
									
										
										
										$this->db->exec("INSERT INTO pa_usuario_expe (nombre_usuario,idperfil,tipo_perfil,empleado,contrasena,
													 	 foto,idareaempleado,pantalla,fecha,hora,tipousuario,iddepartamento,idmunicipio,esabogado,correo,plataforma,ipplataforma,ingreso_activo,
													     hi,hf,hi2,hf2,celular,esentidad)
													     VALUES ('$dato1',1,'admin','$dato2','$contrasena',
													     'views/fotos/usuario.png',7,'$pantalla','$fechalog','$horalog','PUBLICO',NULL,NULL,'$dato5','$dato3','EJECUCION','$servidor_pdf',1,
													     '$hi','$hf','$hi2','$hf2','$dato4','$dato6')");
														 
														 
									}
													 
													 
									
									$this->db->exec("UPDATE pa_usuario_solicitud
													 SET estado = 0
													 WHERE cedula = '$dato1' AND estado = 1");
													 
								
											
											
											
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
	
	public function listar_usuarios_filtro($idusuario){
	
			
			set_time_limit (240000000);
			
			//$idusuario  = $_SESSION['idUsuario'];
			
			$iddepartamento  =  $_SESSION['iddepartamento'];
			$idmunicipio     =  $_SESSION['idmunicipio'];
		
		
			$filtrox;
			
			//$filtrof;
			
			$filtro1;
			$filtro4;
			$filtro5;
			/*$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			$filtro8;
			$filtro9;
			$filtro10;*/
			
		
			//$fechad    = trim($_GET['dato_1']);
			//$fechah    = trim($_GET['dato_2']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			/*$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			$datox9    = trim($_GET['datox9']);
			$datox10   = trim($_GET['datox10']);*/
			
			
			/*if ( !empty($fechad) && !empty($fechah) ) {
			
				
				
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}*/
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.nombre_usuario = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.empleado LIKE '%$datox5%' ";
			
			}
			
			/*if ( !empty($datox3) ) {
			
				
				
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
			//if ( $datox8 == 0  || $datox8 == 1 ) {
			if ( is_numeric($datox8)) {
			
				
				
				$filtro8 = " AND t1.estado = '$datox8' ";
			
			}
			
			
			if ( !empty($datox9) ) {
			
				
				
				$filtro9 = " AND t1.iddepartamento = '$datox9' ";
			
			}
			
			if ( !empty($datox10) ) {
			
				
				
				$filtro10 = " AND t1.idmunicipio = '$datox10' ";
			
			}*/
			
		
			
			
			$filtrox = $filtro1." ".$filtro4." ".$filtro5;
		
			
		
			$listar = $this->db->prepare("	
											SELECT * FROM pa_usuario_expe t1
											WHERE t1.id >= '1'" .$filtrox. "
											ORDER BY t1.empleado
											
											
										");
											
			
			/*$SQL = "SELECT * FROM pa_usuario t1
											WHERE t1.id >= '1'" .$filtrox. "
											ORDER BY t1.empleado";
											
			echo $SQL;*/								
													

  			$listar->execute();
			
			

  			return $listar;
	
  	}
	
	//-------------------------------------
			//FIN MODULO RECEPCION DEMANDA
	//-------------------------------------
	
	
	
	
	//-------------------------------------
			//MODULO CONSULTAR DEMANDA
	//-------------------------------------
	
	public function listar_demanda_2(){
	
	
			set_time_limit (240000000);
			
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
												
												INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id AND t6.id ='$Ciddepartamento')
										    	INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id AND t7.id ='$Cidmunicipio' AND t7.iddpto='$Ciddepartamento')
												
												/*INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
 												INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)*/
												
												WHERE t1.iddepartamento = '$Ciddepartamento'
												AND t1.idmunicipio      = '$Cidmunicipio'
												ORDER BY t1.id 
												LIMIT 200
												
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
													
													INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id AND t6.id ='$Ciddepartamento')
										    		INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id AND t7.id ='$Cidmunicipio' AND t7.iddpto='$Ciddepartamento')
													
													/*INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
													INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)*/
													
													
													WHERE t1.iddespacho   = '$id_juzgado_user' 
													AND t1.iddepartamento = '$Ciddepartamento'
													AND t1.idmunicipio    = '$Cidmunicipio'
													ORDER BY t1.id 
													LIMIT 200
													
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
													
													
													INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id AND t6.id ='$Ciddepartamento')
										    		INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id AND t7.id ='$Cidmunicipio' AND t7.iddpto='$Ciddepartamento')
													
													/*INNER JOIN dda_departamento t6 ON t1.iddepartamento = t6.id)
													INNER JOIN dda_municipio    t7 ON t1.idmunicipio    = t7.id)*/
													
													
													WHERE t1.iddepartamento = '$Ciddepartamento'
													AND t1.idmunicipio      = '$Cidmunicipio'
													AND t1.iduserreparto    = '$idusuario'
													ORDER BY t1.id 
													LIMIT 200
													
												");
												
				}
				
				
			}
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	public function listar_demanda_2_filtro(){
	
	
			set_time_limit (240000000);
	
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
			
			if ( is_numeric($datox8) ) {
			
				
				
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
												
												INNER JOIN dda_departamento t7 ON t1.iddepartamento = t7.id AND t7.id ='$Ciddepartamento')
										    	INNER JOIN dda_municipio    t8 ON t1.idmunicipio    = t8.id AND t8.id ='$Cidmunicipio' AND t8.iddpto='$Ciddepartamento')
												
												/*INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
												INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)*/
												
												
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
														
														
														INNER JOIN dda_departamento t7 ON t1.iddepartamento = t7.id AND t7.id ='$Ciddepartamento')
										    			INNER JOIN dda_municipio    t8 ON t1.idmunicipio    = t8.id AND t8.id ='$Cidmunicipio' AND t8.iddpto='$Ciddepartamento')
														
														/*INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
														INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)*/
														
														
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
													
													INNER JOIN dda_departamento t7 ON t1.iddepartamento = t7.id AND t7.id ='$Ciddepartamento')
										    		INNER JOIN dda_municipio    t8 ON t1.idmunicipio    = t8.id AND t8.id ='$Cidmunicipio' AND t8.iddpto='$Ciddepartamento')
													
													/*INNER JOIN dda_departamento    t7 ON t1.iddepartamento = t7.id)
													INNER JOIN dda_municipio       t8 ON t1.idmunicipio    = t8.id)*/
													
													
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
	
		set_time_limit (240000000);
		
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
		
						$cadena_archivos = "";

					
						
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
												
												move_uploaded_file($temporal, utf8_decode($ruta)); //Movemos el archivo temporal a la ruta especificada		
												
											}
									
										if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
											{
												//$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
												
												$rutaarchivo = utf8_decode($raiz.'/'.$nom.'/'.$despacho.'/'.$last_id.'/'.$nombre_archivo);
												
												//TABLA dda_archivos, QUEDA LA RUTA DE LOS ARCHIVOS DE LA DEMANDA
												$this->db->exec("INSERT INTO dda_archivos(idda,ruta,tipo,iddespacho,actuacion,fecha,hora)
												VALUES('$last_id','$rutaarchivo','A','$despacho','ACTA DE REPARTO','$fechalog','$horalog')");
												
												$cadena_archivos .= $rutaarchivo."******";
												
											}
										if ($key['error']!='')//Si existio alg�n error retornamos un el error por cada archivo.
											{
												$mensage .= '-> No se pudo subir el archivo <b>'.$nombre_archivo.'</b> debido al siguiente Error: n'.$key['error']; 
												
												$archivo_error = 1;
											}
										
									}
									
									//echo $mensage;// Regresamos los mensajes generados al cliente
									
									//------------------------------------FIN SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									
									//HISTORIAL
									$actuacion = 'ACTA DE REPARTO';
									$tablas    = 'dda_demanda'.'-'.'dda_archivos';
									$tipo      = 'A';
									$this->db->exec("INSERT INTO dda_historial(idda,idusuario,fecha,hora,actuacion,tablas,archivos,tipo)
													 VALUES('$last_id','$idusuario','$fechalog','$horalog','$actuacion','$tablas','$cadena_archivos','$tipo')");
											
											
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
	
	public function registrar_devolucion_reparto_2(){
	
		set_time_limit (240000000);
		
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
		$idusuario     = $_SESSION['idUsuario'];
		
		$iddev_juzgado = $_SESSION['id_juzgado'];
		
		$Didentidad_user = $_SESSION['nomusu'];
		$Dnombre_user    = $_SESSION['nombre'];
		
		$devolucion      = "DEVOLUCION, REALIZADA POR DESPACHO: ".$Didentidad_user." - ".$Dnombre_user;
		
		$idevo           = trim($_POST['idevo']);
		
	
		
		//***********************************PARA EL ARCHIVO***************************************
	
		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "ACTAS_DEVO_REPARTO";
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
		
						$cadena_archivos = "";
					
						
						//SQL A EJECUTAR 
						$SQL_1 = "	UPDATE dda_demanda SET
											
										estado         = 2,
										iddespacho     = NULL,
										idusuarioedita = '$idusuario',
										fechaedita     = '$fechalog',
										horaedita      = '$horalog',
										iddevo         = '$iddev_juzgado',
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
									
									//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
									//$last_id = $this->db->lastInsertId();
									
									$last_id = $idevo;
									
						
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
												//$ruta           = $raiz.'/'.$nom.'/'.$despacho.'/'.$last_id.'/'.$nombre_archivo;
												$ruta           = $raiz.'/'.$nom.'/'.$last_id.'/'.$nombre_archivo;
												
												move_uploaded_file($temporal, utf8_decode($ruta)); //Movemos el archivo temporal a la ruta especificada		
												
											}
									
										if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
											{
												//$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
												
												$rutaarchivo = utf8_decode($raiz.'/'.$nom.'/'.$last_id.'/'.$nombre_archivo);
												
												//TABLA dda_archivos, QUEDA LA RUTA DE LOS ARCHIVOS DE LA DEMANDA
												$this->db->exec("INSERT INTO dda_archivos(idda,ruta,tipo,iddespacho,actuacion,fecha,hora)
												VALUES('$last_id','$rutaarchivo','DR','$iddev_juzgado','$devolucion','$fechalog','$horalog')");
												
												$cadena_archivos .= $rutaarchivo."******";
												
											}
										if ($key['error']!='')//Si existio alg�n error retornamos un el error por cada archivo.
											{
												$mensage .= '-> No se pudo subir el archivo <b>'.$nombre_archivo.'</b> debido al siguiente Error: n'.$key['error']; 
												
												$archivo_error = 1;
											}
										
									}
									
									//echo $mensage;// Regresamos los mensajes generados al cliente
									
									//------------------------------------FIN SUBIR LOS ARCHIVOS-----------------------------------------------------------------------
									
									
									//HISTORIAL
									$actuacion = $devolucion;
									$tablas    = 'dda_demanda'.'-'.'dda_archivos';
									$tipo      = 'DR';
									$this->db->exec("INSERT INTO dda_historial(idda,idusuario,fecha,hora,actuacion,tablas,archivos,tipo)
													 VALUES('$last_id','$idusuario','$fechalog','$horalog','$actuacion','$tablas','$cadena_archivos','$tipo')");
									
									
									
											
											
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
	
	public function cerrar_session()
    {
		session_unset();
		session_destroy();
		
		header("refresh: 0;URL=/laborales/");
		die();
    }
	
	
	public function editar_usuario(){
	
		

		$modelo = new usuarioModel();
		
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		$nombre_user = $_SESSION['nombre'];
		
		/*$dato1U = trim($_POST['dato1U']);//DOC INDENTIDAD
		$dato2U = md5(trim($_POST['dato2U']));//CONTRASE�A	
		$dato3U = utf8_decode(trim($_POST['dato3U']));//NOMBRE
		$dato4U = utf8_decode(trim($_POST['dato4U']));//CORREO	
		$dato5U = trim($_POST['dato5U']);//ES ABOGADO
		$dato6U = trim($_POST['dato6U']);//CELULAR*/
		
		
		//SE CAMBIA LA FORMA DE CAPTURAR LOS DATOS
		//Y ACTUALIZARLOS, YA QUE AL ACTUALIZAR PUEDA
		//QUE ALGUNOS CAMPOS NO SE DEFINAN Y DEBEN QUEDAR NULL
		//EN LA BASE DE DATOS
		$dato1U   = (!empty($_POST['dato1U'])) ?  $_POST['dato1U']   : NULL ;//DOC IDENTIDAD
		//$dato2U   = (!empty($_POST['dato2U'])) ?  $_POST['dato2U']   : NULL ;//CONTRASE�A	
		$dato3U   = (!empty($_POST['dato3U'])) ?  $_POST['dato3U']   : NULL ;//NOMBRE
		$dato4U   = (!empty($_POST['dato4U'])) ?  $_POST['dato4U']   : NULL ;//CORREO	
		
		
		//SI SE DEFINE UNA NUEVA CONTRASE�A EN EL FORMULARIO
		if(!empty($_POST['dato2U'])){
		
			//$dato2U   = (!empty($_POST['dato2U']))   ?  $_POST['dato2U']   : NULL ;
			
			$dato2U = trim($_POST['dato2U']); 
		}
		
		
		//ES ABOGADO
		if(!empty($_POST['dato5U'])){
		
			if($_POST['dato5U'] == 1){
				$dato5U   = "SI";
				$pantalla = "ABOGADO";
			}
			if($_POST['dato5U'] == 2){
				$dato5U   = "NO";
				$pantalla = "PARTE";
			}
			if($_POST['dato5U'] == 3){
				$dato5U   = "ESTUDIANTEDEDERECHO";
				$pantalla = "ESTUDIANTEDEDERECHO";
			}
		}
		else{
		
			$dato5U   = (!empty($_POST['dato5U']))   ?  $_POST['dato5U']   : NULL ;
		
		}
		
		$dato6U   = (!empty($_POST['dato6U']))   ?  $_POST['dato6U']   : NULL ;//CELULAR
		
		
		$dato7U   = (!empty($_POST['dato7U']))   ?  $_POST['dato7U']   : NULL ;//ES ENTIDAD
		
		
		//CAMPOS OCULTOS
		$iduser = trim($_POST['iduser']);
		//$iduser = (!empty($_POST['iduser']))   ?  $_POST['iduser']   : NULL ;
		
		
		$fecha_amd    = $modelo->get_fecha_actual_amd();
		$hora_militar = $modelo->get_hora_actual_24horas();
		
		date_default_timezone_set('America/Bogota');
		$fecha = date('Y-m-d g:i');
		
		
		$error_transaccion = 0; //variable para detectar error
		$msg               = "";
		$msg_2             = "";
		
		
		//-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
										
		try {  
										 
				
						
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
				
				
				/*$this->db->exec("
									UPDATE pa_usuario_expe SET 
									
										nombre_usuario = '$dato1U',
										contrasena     = '$dato2U',
										empleado       = '$dato3U',
										correo         = '$dato4U',
										esabogado      = '$dato5U',
										celular        = '$dato6U'
										
									WHERE id = '$iduser'
									
								");	*/		
								
				
					//SI SE DEFINE UNA NUEVA CONTRASE�A EN EL FORMULARIO
					if(!empty($_POST['dato2U'])){
				
						$stmt = $this->db->prepare("
						
														UPDATE pa_usuario_expe SET 
																			
															nombre_usuario = :dato1U,
															contrasena     = :dato2U,
															empleado       = :dato3U,
															correo         = :dato4U,
															esabogado      = :dato5U,
															celular        = :dato6U,
															esentidad      = :dato7U,
															pantalla       = :pantalla
																				
														WHERE id = :iduser
																			
													");
													
					}
					else{
					
						$stmt = $this->db->prepare("
						
														UPDATE pa_usuario_expe SET 
																			
															nombre_usuario = :dato1U,
															empleado       = :dato3U,
															correo         = :dato4U,
															esabogado      = :dato5U,
															celular        = :dato6U,
															esentidad      = :dato7U,
															pantalla       = :pantalla
																				
														WHERE id = :iduser
																			
													");
					
					}
					
					$stmt->bindParam(':dato1U', $dato1U);
					
					//SI SE DEFINE UNA NUEVA CONTRASE�A EN EL FORMULARIO
					if(!empty($_POST['dato2U'])){
					
						$stmt->bindParam(':dato2U', md5($dato2U));
					}
					
					$stmt->bindParam(':dato3U', utf8_decode($dato3U));
					$stmt->bindParam(':dato4U', utf8_decode($dato4U));
					$stmt->bindParam(':dato5U', $dato5U);
					$stmt->bindParam(':dato6U', $dato6U);
					$stmt->bindParam(':dato7U', $dato7U);
					$stmt->bindParam(':pantalla', $pantalla);
					$stmt->bindParam(':iduser', $iduser);
					$stmt->execute();			
											
												
					$detalle = utf8_decode($nombre_user)." EDITA USUARIO"." ID USUARIO :".$iduser." NOMBRE USUARIO:".$dato3U;							
					$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog)
									 VALUES ('$fecha_amd','EDITAR USUARIO','$detalle','$idusuario',8)");				  	  
													
													
												
					
					//SE TERMINA LA TRANSACCION  
					$this->db->commit();		
					
					
					$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
										
					//echo $msg;
												
											
						
										
		}//FIN TRY
		catch (Exception $e) {
		
		
			$error_transaccion   = 1;
										
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();

								
			$msg = "FALLO EN LA OPERACION: " . $e->getMessage();
											
				
			//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
				
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
		
		
		


	}//FIN FUNCION EDITAR USURIO
	
	public function rechazar_solicitudes(){
	
		set_time_limit (240000000);
		
		$modelo     = new usuarioModel();
				
		
		$servidor_pdf = trim($_SESSION['ipplataforma']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];*/
		
		//$horalog    = $datosfecha[1];
		$fechalog = $modelo->get_fecha_actual_amd();
		$horalog  = $modelo->get_hora_actual_24horas();
		
		
		$rango_horas = $modelo->rango_horas_plataforma();	
		$rango       = $rango_horas->fetch();
		
		$hi          = $rango[hi];
		$hf          = $rango[hf];
		$hi2         = $rango[hi2];
		$hf2         = $rango[hf2];
		
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
		
		
		/*$dato1	   = trim($_POST['dato1']);
		$dato2	   = trim($_POST['dato2']);
		$dato3	   = trim($_POST['dato3']);
		$dato4	   = trim($_POST['dato4']);
		$dato5	   = trim($_POST['lista1']);
		$dato6	   = trim($_POST['lista2']);
	
		$dato7X    = explode("-",trim($_POST['dato5']));
		$dato7     = trim($dato7X[0]);*/
		
		
		
					$datospartes   = trim($_POST['datospartes']);
					
					$datospartes_1A = explode("******",$datospartes); 
					$longitud_1     = count($datospartes_1A);
					$i              = 0;
					
					
					while($i < $longitud_1 - 1){
					
					
						
						$datospartes_1B = explode("//////",$datospartes_1A[$i]);
						
						//$dato1	   = md5(trim($datospartes_1B[1]));
						
						$dato0	   = trim($datospartes_1B[0]);//ID
						/*$dato1	   = trim($datospartes_1B[1]);//CEDULA
						$dato2	   = utf8_decode(trim($datospartes_1B[2]));//NOMBRE
						$dato3	   = utf8_decode(trim($datospartes_1B[3]));//CORREO
						$dato4	   = utf8_decode(trim($datospartes_1B[4]));//CELULAR
						$dato5	   = utf8_decode(trim($datospartes_1B[5]));//ES ABOGADO
						
						if($dato5 == "SI"){
							
							$pantalla = "ABOGADO";
						}
						if($dato5 == "NO"){
						
							$pantalla = "PARTE";
						}
						
						$existeU   = trim($datospartes_1B[6]);//USUARIO EXISTE*/
						
						
				
						$error_transaccion   = 0; //variable para detectar error
						$msg = " ";
								
						//$accion  = "APRUEBA REMATE, ID REMATE: ".$idrema;
						//$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
								
							
								
						try {  
									
							$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										
							//EMPIEZA LA TRANSACCION
							$this->db->beginTransaction();
										
								
								
									/*$contrasena = md5('admin');
									
									
									//EL USUARIO NO EXISTE Y SE CREA
									if($existeU == 0){
									
										
										
										$this->db->exec("INSERT INTO pa_usuario_expe (nombre_usuario,idperfil,tipo_perfil,empleado,contrasena,
													 	 foto,idareaempleado,pantalla,fecha,hora,tipousuario,iddepartamento,idmunicipio,esabogado,correo,plataforma,ipplataforma,ingreso_activo,
													     hi,hf,hi2,hf2,celular)
													     VALUES ('$dato1',1,'admin','$dato2','$contrasena',
													     'views/fotos/usuario.png',7,'$pantalla','$fechalog','$horalog','PUBLICO',NULL,NULL,'$dato5','$dato3','EJECUCION','$servidor_pdf',1,
													     '$hi','$hf','$hi2','$hf2','$dato4')");
														 
														 
									}*/
													 
													 
									
									$this->db->exec("UPDATE pa_usuario_solicitud
													 SET estado = 2
													 WHERE id = '$dato0'");
													 
								
											
											
											
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
					else{//X
					
					
				
						//SE TERMINA LA TRANSACCION  
						//$this->db->commit();
									
						$msg = "1-PROCESO SE REALIZA CORRECTAMENTE";
								
						echo $msg;
						
						
	
							
					}//x
					
					
					
				
  	}
	
	
  
}//FIN CLASE MODELO
?>