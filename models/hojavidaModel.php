<?php

class hojavidaModel extends modelBase{


   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

	public function mensajes(){

  		$condicion=$_GET['nombre'];
	  
	  
	  	if($condicion==1){

	    	$_SESSION['elemento'] = "Se Realiza el Registro Correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	     	if($_SESSION['id']!=""){

	      		print'<script languaje="Javascript">location.href="index.php?controller=administrar&action=Administrar_Archivo"</script>';
	     	}
  
	   	}

	}	



  	/***********************************************************************************/

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
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
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
	
	public function get_lista($nombrelista,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	
	public function get_lista_estudios($id_hv){
	
		$listar     = $this->db->prepare("SELECT t1.id,t2.id AS idmodalidad,t2.des AS modalidad,t3.des AS tipomodalidad,t3.id AS idtipomodalidad,t1.institucion
				  						  FROM ((hv_central t1
                                          LEFT JOIN hv_modalidad t2 ON t1.idmodalidad = t2.id)
                                          LEFT JOIN hv_tipomodalidad t3 ON t1.idtipomodalidad = t3.id) 
		                                  WHERE t1.idservidor = '$id_hv'
				                          ORDER BY t1.id");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	
	public function get_datos_hojas_vida($identrada){
	
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){

			
											  
			$listar     = $this->db->prepare("SELECT * FROM hv_datosgenerales hv
											  ORDER BY hv.id DESC LIMIT 10");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			

			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (hv.fecharegistro >= '$fechad' AND hv.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND hv.cedula LIKE '%$datox1%' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND hv.nombre LIKE '%$datox2%' ";
			
			}
			
			$filtrox = $filtro1." ".$filtro2." ".$filtrof;
			
			 
			
											 									 
			$listar     = $this->db->prepare("SELECT hv.id,hv.cedula,hv.nombre
											  FROM hv_datosgenerales hv 
											  WHERE hv.id >= '1'" .$filtrox. " 
											  ORDER BY hv.id");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_procentaje_hoja_vida_general($id_procentaje){
	
	
		$listar     = $this->db->prepare("SELECT * FROM hv_datosgenerales
										  WHERE cedula = '$id_procentaje'");
											 
			
  		$listar->execute();
		$cantidad_porcentaje_g = $listar->rowCount();
		
  		return $cantidad_porcentaje_g;
	
  	}
	
	public function get_procentaje_hoja_vida($id_procentaje){
	
	
		$listar     = $this->db->prepare("SELECT * FROM hv_central
										  WHERE idservidor = '$id_procentaje'
										  GROUP BY tipo_soporte");
											 
			
  		$listar->execute();
		$cantidad_porcentaje = $listar->rowCount();
		
  		return $cantidad_porcentaje;
	
  	}
	
	public function get_idsesion_usuario($cedula_user){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario 
		                                  WHERE nombre_usuario = '$cedula_user'");
	
  		$listar->execute();
		
		$fila    = $listar->fetch();
		$id_user = $fila[id];
		
  		return $id_user;
	
	}
	
	public function get_permiso_manejo_HV($idusuario){
	
		$listar     = $this->db->prepare("SELECT edita_hv FROM pa_usuario 
		                                  WHERE id = '$idusuario'");
	
  		$listar->execute();
		
		$fila     = $listar->fetch();
		$edita_hv = $fila[edita_hv];
		
  		return $edita_hv;
	
	}
	
	public function get_procentaje_soportes_hoja_vida($id_cedula_user){

		$i    = 0;
		$cr_1 = 0;
		
	
		$rutas = array(	'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$id_cedula_user."/SOPORTES_ESTUDIOS/", 
		               	'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$id_cedula_user."/SOPORTES_EXPERIENCIA_LABORAL/", 
					   	'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$id_cedula_user."/ANTECEDENTES_CERTIFICADOS/"
				 	 );
					 
		//$rutas = array('C:/wamp/www/ejecucion/HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_EXPERIENCIA_LABORAL/");			 
					 
		
		$long_rutas = count($rutas);
		
		while($i < $long_rutas){
		
			if ($gestor = opendir($rutas[$i])) {
		
				
				//NO SE REALIZA EL WHILE SOLO CON SABER QUE EXISTE UN SOPORTE
				//ES SUFICIENTE	
				//while (false !== ($entrada = readdir($gestor))) {
				if (false !== ($entrada = readdir($gestor))) {
						
					$cr_1 = $cr_1 + 1;
						
				}
				 
				  
				closedir($gestor);
			}
			
			$i = $i + 1;
		
		}
		
		
		return $cr_1;
					 
	
  	}
	
	
	public function registrar_administrar_hojavida(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		/*$yeararchivo = trim($_POST['yeararchivo']);
		$cajaarchivo = trim($_POST['cajaarchivo']);
		$datospartes = trim($_POST['datospartes']);*/
	
		$id_hv         = trim($_POST['id_hv']);
		
		$hvcedula       = trim($_POST['hvcedula']);
		$hvnombre       = utf8_decode(trim($_POST['hvnombre']));
		$hvfn           = trim($_POST['hvfn']);
		$hvdireccion    = utf8_decode(trim($_POST['hvdireccion']));
		$hvcorreo       = utf8_decode(trim($_POST['hvcorreo']));
		$hvperfil       = trim($_POST['hvperfil']);
		$hvestadocivil  = trim($_POST['hvestadocivil']);
		$hvtelefono     = utf8_decode(trim($_POST['hvtelefono']));
		$hvpocupacional = utf8_decode(trim($_POST['hvpocupacional']));
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new hojavidaModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
	
		if($id_hv >= 1){
		
			$accion  = "Edita Administrar Hoja de Vida En el Sistema (ADMINISTRAR/Hoja de Vida), ID HOHA DE VIDA: ".$id_hv;
		}
		else{
			
			$accion  = "Registra Administrar Hoja de Vida En el Sistema (ADMINISTRAR/Hoja de Vida)";
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 7;
		

		
		try {  
					
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
						
							 
				$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) 
								 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')"); 
							 
							
				if($id_hv >= 1){
							
								
					$this->db->exec("UPDATE hv_datosgenerales SET 
								                 
									 cedula         = '$hvcedula',
									 nombre         = '$hvnombre',
									 fechanacimiento = '$hvfn',
									 direccion      = '$hvdireccion',
									 correo         = '$hvcorreo',
									 perfil         = '$hvperfil',
									 estado_civil   = '$hvestadocivil',
									 telefono       = '$hvtelefono',
									 perfilocupacional = '$hvpocupacional',
									 fechaedita     = '$fechalog',
									 idusuarioedita = '$idusuario'
									 WHERE id = '$id_hv'"); 
												
								
				}
				else{
								
					$this->db->exec("INSERT INTO hv_datosgenerales (cedula,nombre,fechanacimiento,direccion,correo,perfil,estado_civil,telefono,perfilocupacional,
									 fecharegistro,idusuario)
									 VALUES ('$hvcedula','$hvnombre','$hvfn','$hvdireccion','$hvcorreo','$hvperfil','$hvestadocivil','$hvtelefono','$hvpocupacional',
									 '$fechalog','$idusuario')"); 
				}
												 
							
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
						
				echo "CORRECTO**********";
						
						
					  
		} 
		catch (Exception $e) {
					
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
						
						
			echo "ERROR**********".$e->getMessage();
						
		}
					
			
				
  	}
	
	
	
	public function registrar_administrar_hojavida_cambiarfoto(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
	
		$id_hv_s      = trim($_POST['id_hv_s']);
		$hvcedula_s   = trim($_POST['hvcedula_s']);
		$idusuario_HV = trim($_POST['idusuario_HV']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new hojavidaModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
	
		$accion  = "Edita Foto Administrar Hoja de Vida En el Sistema (ADMINISTRAR/Hoja de Vida), ID HOHA DE VIDA: ".$id_hv_s;
		
	  	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 7;
		

		//***********************************PARA EL ARCHIVO***************************************

		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "HOJASDEVIDA";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		//$nom_u = trim($_SESSION['idUsuario']);
		$nom_u = trim($idusuario_HV);
		//ASINO A LA VARIABLE $nom EL NOMBRE DEL JUZGADO SELECCIONADO
		//$nom   = $juzgadodestinonombre;
		
		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($raiz.'/'.$nom_u.'/FOTOS')){$bandera=0;}
		else{mkdir($raiz.'/'.$nom_u.'/FOTOS', 0, true);}
		
		//datos del arhivo 
		$nombre_archivo = $nom_u."_".$_FILES['archivo']['name']; 
		//$nombre_archivo = $_FILES['archivo']['name']; 
		//echo $nombre_archivo;
		$tipo_archivo   = $_FILES['archivo']['type'];
		//echo $tipo_archivo;
		$tamano_archivo = $_FILES['archivo']['size']; 
		//echo $tamano_archivo;
		
		
			if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
			|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
			|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
			|| strpos($tipo_archivo, "pdf") //pdf
			|| strpos($tipo_archivo, "jpeg") //jpeg
			|| strpos($tipo_archivo, "png") //png
			) && ($tamano_archivo < 100000000) )  { 
		
				
				
				echo '<script languaje="JavaScript"> 
						
							
							alert("El Archivo no Cumple con las Caracteristicas Especificas, si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet, vnd.openxmlformats-officedocument.wordprocessingml.document,pdf,jpeg,png) y tamaño de archivo < 100000000.");
							location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
									
						 </script>';
				
				
		
			}
			else{//1 
				
				
				//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
				//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
				/*if ( file_exists($raiz.'/'.$nom_u.'/'.$nombre_archivo) ) {
				
					//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
					
					
					
					//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
					//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
					$idunico = time();
					
					$nombre_archivo = $idunico."_".$nombre_archivo;
					
					
				}*/
				
				if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom_u.'/FOTOS/'.$nombre_archivo) ){//3
				
					$rutaarchivo = $raiz.'/'.$nom_u.'/FOTOS/'.$nombre_archivo;
				
					try {  
					
						$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						//EMPIEZA LA TRANSACCION
						$this->db->beginTransaction();
						
							 
							$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) 
											 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')"); 
							 
							
							
							
								
							$this->db->exec("UPDATE hv_datosgenerales SET 
								             foto           = '$rutaarchivo',
											 fechaedita     = '$fechalog',
											 idusuarioedita = '$idusuario'
											 WHERE id       = '$id_hv_s'"); 
												
								
							
												 
							
						//SE TERMINA LA TRANSACCION  
						$this->db->commit();
						
						//echo "CORRECTO**********";
						
						
						echo '<script languaje="JavaScript"> 
						
							var idvalor = "'.$hvcedula_s.'";
							
							//Limpiar_Formulario(dat_1);
							
							alert("CAMBIO DE FOTO OK");
							//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
							
							//Traer_Datos_Hoja_Vida(idvalor);
									
						 </script>';
					  
					} 
					catch (Exception $e) {
					
						//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
						$this->db->rollBack();
						//echo "Fallo: " . $e->getMessage();
						
						//echo "ERROR**********".$e->getMessage();
						
						
						
						echo '<script languaje="JavaScript"> 
						
							var ERROR = "'.$e->getMessage().'";
							
							alert("ERROR EN EL CAMBIO DE FOTO:"+ ERROR);
							//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
									
						 </script>';
					}
					
				
				}
				
			}

  	}
	
	
	
	
	public function busquedad_filtro_archivo(){
	
	
			$idusuario  = $_SESSION['idUsuario'];
		
		
			$filtrox;
			
			$filtrof;
			$filtrofp;
			$filtroc;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechadp   = trim($_GET['dato_3']);
			$fechahp   = trim($_GET['dato_4']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (t2.fecharegistro >= '$fechad' AND t2.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($fechadp) && !empty($fechahp) ) {
			
				
				$filtrofp = " AND (t1.fechafinal >= '$fechadp' AND t1.fechafinal <= '$fechahp') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t2.year = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND t2.caja = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t1.idcarpeta = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND t1.numerocarpeta = '$datox4' ";
			
			}
			
			
			
			if ( !empty($datox5) && !empty($datox6) ) {
				
					$filtroc = " AND (t1.coninicial >= '$datox5' AND t1.confinal <= '$datox6')";
			}
			
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof." ".$filtrofp." ".$filtroc;
			
			//echo $filtrox;
			
			/*$SQL="	SELECT t1.idarchivo,t2.year,t2.caja,t2.fecharegistro AS fechsuperior,t1.id AS iddetalle,
											t1.idcarpeta,t3.descarpeta,t1.numerocarpeta,t1.fechainicial,t1.fechafinal,t1.fecharegistro,
											t1.coninicial,t1.confinal
											FROM ((administrar_archivo_detalle t1
											LEFT JOIN administrar_archivo t2 ON t1.idarchivo = t2.id)
											LEFT JOIN pa_nombrecarpeta t3 ON t1.idcarpeta = t3.id)
											WHERE t1.id >= '1'" .$filtrox. " 
											ORDER BY idarchivo";
			   
			echo $SQL;*/
			
			$listar = $this->db->prepare("	SELECT t1.idarchivo,t2.year,t2.caja,t2.fecharegistro AS fechsuperior,t1.id AS iddetalle,
											t1.idcarpeta,t3.descarpeta,t1.numerocarpeta,t1.fechainicial,t1.fechafinal,t1.fecharegistro,
											t1.coninicial,t1.confinal
											FROM ((administrar_archivo_detalle t1
											LEFT JOIN administrar_archivo t2 ON t1.idarchivo = t2.id)
											LEFT JOIN pa_nombrecarpeta t3 ON t1.idcarpeta = t3.id)
											WHERE t1.id >= '1'" .$filtrox. " 
											ORDER BY idarchivo");
		

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	public function administrar_hojavida_estudios(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_id_es            = trim($_POST['hv_id_es']);
		$hv_cedula_es        = trim($_POST['hv_cedula_es']);
		
		/*$hv_modalidad_es   = trim($_POST['hv_modalidad_es']);
		$hv_tipomodalidad_es = trim($_POST['hv_tipomodalidad_es']);
		$hv_institucion_es   = utf8_decode(trim($_POST['hv_institucion_es']));*/
		
		$datospartes         = trim($_POST['datospartes']);
		
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
					//1 EXPLODE
					$datospartes_1 = explode("******",$datospartes); 
					$longitud_1    = count($datospartes_1);
					$i             = 1;
					
					while($i < $longitud_1){
						
						//2 EXPLODE
						$datospartes_2 = explode("//////",$datospartes_1[$i]);
						
						$id_modificar        = trim($datospartes_2[0]);
						
						$hv_modalidad_es     = trim($datospartes_2[1]);
						$hv_tipomodalidad_es = trim($datospartes_2[2]);
						$hv_institucion_es   = utf8_decode(trim($datospartes_2[3]));
						
						if($id_modificar > 0){
						
							$this->db->exec("UPDATE hv_central SET
					                 
									 			idmodalidad     = '$hv_modalidad_es',
									 			idtipomodalidad = '$hv_tipomodalidad_es',
									 			institucion     = '$hv_institucion_es',
									 			fechaedita      = '$fechalog',
									 			idusuarioedita  = '$idusuario'
							     	 
										 	  WHERE id          = '$id_modificar'");
							
							
											
							
							$accion = "EDITA ESTUDIO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      						$detalle = $_SESSION['nombre']." EDITA ESTUDIO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es." ID ESTUDIO: ".$id_modificar;				
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				
						
						}
						else{
					
							$this->db->exec("INSERT INTO hv_central (idservidor,idmodalidad,idtipomodalidad,institucion,fecharegistro,idusuario,tipo_soporte)
							     	         VALUES ('$hv_id_es','$hv_modalidad_es','$hv_tipomodalidad_es','$hv_institucion_es','$fechalog','$idusuario','E')");
											 
							
							
							$accion = "REGISTRA ESTUDIO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      		                $detalle = $_SESSION['nombre']." REGISTRA ESTUDIO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es;				 
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
						}
						
						
						
						
						$i = $i + 1;
					
					}
									 				   
								  
		
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	public function administrar_hojaVida_adicionar_modalidad(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_nuevamodalidad_es = utf8_decode(trim($_POST['hv_nuevamodalidad_es']));
		
		
		$accion  = "REGISTRA NUEVA MODALIDAD En el Sistema (ADMINISTRAR/Hoja de Vida)";
        $detalle = $_SESSION['nombre']." REGISTRA NUEVA MODALIDAD ".$fechalog." "."a las: ".$horalog;				 
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
								 
								 
				
				$this->db->exec("INSERT INTO hv_modalidad (des)
							     VALUES ('$hv_nuevamodalidad_es')");
											 
							
							
			
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
				
											
			//SE TERMINA LA TRANSACCION  
			$this->db->commit();
							
			echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	public function administrar_hojaVida_adicionar_tipomodalidad(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_modalidad_es          = trim($_POST['hv_modalidad_es']);
		$hv_nuevatipomodalidad_es = utf8_decode(trim($_POST['hv_nuevatipomodalidad_es']));
		
		
		$accion  = "REGISTRA NUEVO TIPO MODALIDAD En el Sistema (ADMINISTRAR/Hoja de Vida)";
        $detalle = $_SESSION['nombre']." REGISTRA NUEVA TIPO MODALIDAD ".$fechalog." "."a las: ".$horalog;				 
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
								 
								 
				
				$this->db->exec("INSERT INTO hv_tipomodalidad (idmodalidad,des)
							     VALUES ('$hv_modalidad_es','$hv_nuevatipomodalidad_es')");
											 
							
							
			
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
				
											
			//SE TERMINA LA TRANSACCION  
			$this->db->commit();
							
			echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	public function Administrar_HojaVida_Eliminar_Soporte(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		$ideliminar          = trim($_POST['id_certificado']);
		$id_ruta_eliminar    = trim($_POST['id_ruta_eliminar']);
		$id_central_eliminar = trim($_POST['id_central_eliminar']);
		$cont_idc            = trim($_POST['cont_idc']);
		
		
		$accion  = "ELIMINA SOPORTE En el Sistema (ADMINISTRAR/Hoja de Vida)";
        $detalle = $_SESSION['nombre']." ELIMINA SOPORTE ".$fechalog." "."a las: ".$horalog." ID:".$ideliminar." RUTA: ".$id_ruta_eliminar." ID CENTRAL: ".$id_central_eliminar;				 
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		$error_moverarchivo = 0; //variable para detectar error cuando se sube un archivo y no guardar la ruta en hv_rutas_archivos
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
								 
								 
				
				$this->db->exec("DELETE FROM hv_rutas_archivos WHERE id ='$ideliminar'");
				
				
				if($cont_idc == 1){							 
							
					$this->db->exec("DELETE FROM hv_central WHERE id ='$id_central_eliminar'");
				}
				
							
			
				//$msg = "PROCESO SE REALIZA CORRECTAMENTE";
				
				
				
				//-------------ELIMINAR EL ARCHIVO-----------
				if (is_file($id_ruta_eliminar)) {
				
					chmod($id_ruta_eliminar,0777);
					
					if(!unlink($id_ruta_eliminar)) {
						$error_moverarchivo = 1;
					}
					else{
						$error_moverarchivo = 0;
					}
					
				} 
				else {
					$error_moverarchivo = 1;
				}
				//-------------------------------------------
			
				if($error_moverarchivo == 1){
					
					$msg = "ERROR AL ELIMINAR EL SOPORTE";								
				}
				else{
					
					$msg = "PROCESO SE REALIZA CORRECTAMENTE";
				
					//SE TERMINA LA TRANSACCION  
					$this->db->commit();
				}
								
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	public function Administrar_HojaVida_Eliminar_Registro(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		$ideliminar = trim($_POST['ideliminar']);
		
		
		$id_msg     = trim($_POST['id_msg']);
		
		if($id_msg == 1){ $id_msg = "ESTUDIO"; }
		if($id_msg == 2){ $id_msg = "EXPERIENCIA LABORAL"; }
		
		$accion  = "ELIMINA REGISTRO ".$id_msg." En el Sistema (ADMINISTRAR/Hoja de Vida)";
        $detalle = $_SESSION['nombre']." ELIMINA REGISTRO ".$id_msg." ".$fechalog." "."a las: ".$horalog." ID: ".$ideliminar;				 
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
								 
								 
				
				$this->db->exec("DELETE FROM hv_central WHERE id ='$ideliminar'");
											 
							
							
			
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
				
											
			//SE TERMINA LA TRANSACCION  
			$this->db->commit();
							
			echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	public function administrar_hojavida_experiencia(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_id_es            = trim($_POST['hv_id_es']);
		$hv_cedula_es        = trim($_POST['hv_cedula_es']);
		
		/*$hv_modalidad_es   = trim($_POST['hv_modalidad_es']);
		$hv_tipomodalidad_es = trim($_POST['hv_tipomodalidad_es']);
		$hv_institucion_es   = utf8_decode(trim($_POST['hv_institucion_es']));*/
		
		$datospartes         = trim($_POST['datospartes']);
		
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
					//1 EXPLODE
					$datospartes_1 = explode("******",$datospartes); 
					$longitud_1    = count($datospartes_1);
					$i             = 1;
					
					while($i < $longitud_1){
						
						//2 EXPLODE
						$datospartes_2 = explode("//////",$datospartes_1[$i]);
						
						$id_modificar      = trim($datospartes_2[0]);
						
						$hv_institucion_es = utf8_decode(trim($datospartes_2[1]));
						$hv_direccion_es   = utf8_decode(trim($datospartes_2[2]));
						$hv_telefono_es    = utf8_decode(trim($datospartes_2[3]));
						$hv_periodo_es     = utf8_decode(trim($datospartes_2[4]));
						$hv_cargo_es       = utf8_decode(trim($datospartes_2[5]));
						
						if($id_modificar > 0){
						
							$this->db->exec("UPDATE hv_central SET
					                 
									 			
									 			institucion     = '$hv_institucion_es',
												direccion       = '$hv_direccion_es',
												telefono        = '$hv_telefono_es',
												periodo         = '$hv_periodo_es',
												cargo           = '$hv_cargo_es',
									 			fechaedita      = '$fechalog',
									 			idusuarioedita  = '$idusuario'
							     	 
										 	  WHERE id          = '$id_modificar'");
							
							
											
							
							$accion = "EDITA EXPERIENCIA LABORAL En el Sistema (ADMINISTRAR/Hoja de Vida)";
      						$detalle = $_SESSION['nombre']." EDITA EXPERIENCIA LABORAL ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es." ID EXPERIENCIA: ".$id_modificar;				
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				
						
						}
						else{
					
							$this->db->exec("INSERT INTO hv_central (idservidor,idmodalidad,idtipomodalidad,institucion,direccion,telefono,periodo,cargo,
							                 fecharegistro,idusuario,tipo_soporte)
							     	         VALUES ('$hv_id_es',0,0,'$hv_institucion_es','$hv_direccion_es','$hv_telefono_es','$hv_periodo_es','$hv_cargo_es',
											 '$fechalog','$idusuario','L')");
											 
							
							
							$accion = "REGISTRA EXPERIENCIA LABORAL En el Sistema (ADMINISTRAR/Hoja de Vida)";
      		                $detalle = $_SESSION['nombre']." REGISTRA EXPERIENCIA LABORAL ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es;				 
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
						}
						
						
						
						
						$i = $i + 1;
					
					}
									 				   
								  
		
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	
	
	public function administrar_hojavida_conocimiento(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_id_es            = trim($_POST['hv_id_es']);
		$hv_cedula_es        = trim($_POST['hv_cedula_es']);
		
		/*$hv_modalidad_es   = trim($_POST['hv_modalidad_es']);
		$hv_tipomodalidad_es = trim($_POST['hv_tipomodalidad_es']);
		$hv_institucion_es   = utf8_decode(trim($_POST['hv_institucion_es']));*/
		
		$datospartes         = trim($_POST['datospartes']);
		
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
					//1 EXPLODE
					$datospartes_1 = explode("******",$datospartes); 
					$longitud_1    = count($datospartes_1);
					$i             = 1;
					
					while($i < $longitud_1){
						
						//2 EXPLODE
						$datospartes_2 = explode("//////",$datospartes_1[$i]);
						
						$id_modificar      = trim($datospartes_2[0]);
						
						$hv_institucion_es = utf8_decode(trim($datospartes_2[1]));
						$hv_direccion_es   = utf8_decode(trim($datospartes_2[2]));
						$hv_telefono_es    = utf8_decode(trim($datospartes_2[3]));
						$hv_periodo_es     = utf8_decode(trim($datospartes_2[4]));
						$hv_cargo_es       = utf8_decode(trim($datospartes_2[5]));
						
						if($id_modificar > 0){
						
							$this->db->exec("UPDATE hv_central SET
					                 
									 			
									 			institucion     = '$hv_institucion_es',
									 			fechaedita      = '$fechalog',
									 			idusuarioedita  = '$idusuario'
							     	 
										 	  WHERE id          = '$id_modificar'");
							
							
											
							
							$accion = "EDITA CONOCIMIENTO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      						$detalle = $_SESSION['nombre']." EDITA CONOCIMIENTO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es." ID CONOCIMIENTO: ".$id_modificar;				
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				
						
						}
						else{
					
							$this->db->exec("INSERT INTO hv_central (idservidor,idmodalidad,idtipomodalidad,institucion,
							                 fecharegistro,idusuario,tipo_soporte)
							     	         VALUES ('$hv_id_es',0,0,'$hv_institucion_es',
											 '$fechalog','$idusuario','C')");
											 
							
							
							$accion = "REGISTRA CONOCIMIENTO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      		                $detalle = $_SESSION['nombre']." REGISTRA CONOCIMIENTO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es;				 
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
						}
						
						
						
						
						$i = $i + 1;
					
					}
									 				   
								  
		
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	public function administrar_hojavida_referencia(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_id_es            = trim($_POST['hv_id_es']);
		$hv_cedula_es        = trim($_POST['hv_cedula_es']);
		
		/*$hv_modalidad_es   = trim($_POST['hv_modalidad_es']);
		$hv_tipomodalidad_es = trim($_POST['hv_tipomodalidad_es']);
		$hv_institucion_es   = utf8_decode(trim($_POST['hv_institucion_es']));*/
		
		$datospartes         = trim($_POST['datospartes']);
		
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
					//1 EXPLODE
					$datospartes_1 = explode("******",$datospartes); 
					$longitud_1    = count($datospartes_1);
					$i             = 1;
					
					while($i < $longitud_1){
						
						//2 EXPLODE
						$datospartes_2 = explode("//////",$datospartes_1[$i]);
						
						$id_modificar      = trim($datospartes_2[0]);
						
						$hv_institucion_es = utf8_decode(trim($datospartes_2[1]));
						$hv_direccion_es   = utf8_decode(trim($datospartes_2[2]));
						$hv_telefono_es    = utf8_decode(trim($datospartes_2[3]));
						$hv_cargo_es       = utf8_decode(trim($datospartes_2[4]));
						$hv_referencia_es  = utf8_decode(trim($datospartes_2[5]));
						
						if($id_modificar > 0){
						
							$this->db->exec("UPDATE hv_central SET
					                 
									 			
									 			institucion     = '$hv_institucion_es',
												direccion       = '$hv_direccion_es',
												telefono        = '$hv_telefono_es',
												cargo           = '$hv_cargo_es',
												tipo_soporte    = '$hv_referencia_es',
									 			fechaedita      = '$fechalog',
									 			idusuarioedita  = '$idusuario'
							     	 
										 	  WHERE id          = '$id_modificar'");
							
							
											
							
							$accion = "EDITA REFERENCIA En el Sistema (ADMINISTRAR/Hoja de Vida)";
      						$detalle = $_SESSION['nombre']." EDITA REFERENCIA ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es." ID REFERENCIA: ".$id_modificar;				
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				
						
						}
						else{
					
							$this->db->exec("INSERT INTO hv_central (idservidor,idmodalidad,idtipomodalidad,institucion,direccion,telefono,cargo,
							                 fecharegistro,idusuario,tipo_soporte)
							     	         VALUES ('$hv_id_es',0,0,'$hv_institucion_es','$hv_direccion_es','$hv_telefono_es','$hv_cargo_es',
											 '$fechalog','$idusuario','$hv_referencia_es')");
											 
							
							
							$accion = "REGISTRA REFERENCIA En el Sistema (ADMINISTRAR/Hoja de Vida)";
      		                $detalle = $_SESSION['nombre']." REGISTRA REFERENCIA ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es;				 
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
						}
						
						
						
						
						$i = $i + 1;
					
					}
									 				   
								  
		
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	public function administrar_hojavida_actos(){
	
		
		
		$modelo = new hojavidaModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$hv_id_es            = trim($_POST['hv_id_es']);
		$hv_cedula_es        = trim($_POST['hv_cedula_es']);
		
		/*$hv_modalidad_es   = trim($_POST['hv_modalidad_es']);
		$hv_tipomodalidad_es = trim($_POST['hv_tipomodalidad_es']);
		$hv_institucion_es   = utf8_decode(trim($_POST['hv_institucion_es']));*/
		
		$datospartes         = trim($_POST['datospartes']);
		
		$tipolog = 7;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
					//1 EXPLODE
					$datospartes_1 = explode("******",$datospartes); 
					$longitud_1    = count($datospartes_1);
					$i             = 1;
					
					while($i < $longitud_1){
						
						//2 EXPLODE
						$datospartes_2 = explode("//////",$datospartes_1[$i]);
						
						$id_modificar        = trim($datospartes_2[0]);
						
						$hv_resolucion_ad = utf8_decode(trim($datospartes_2[1]));
						$hv_motivo_ad     = trim($datospartes_2[2]);
						$hvf_ad           = trim($datospartes_2[3]);
						
						if($id_modificar > 0){
						
							$this->db->exec("UPDATE hv_central SET
					                 
									 			nunresolucion   = '$hv_resolucion_ad',
									 			idmotivo        = '$hv_motivo_ad',
									 			fechaad         = '$hvf_ad',
									 			fechaedita      = '$fechalog',
									 			idusuarioedita  = '$idusuario'
							     	 
										 	  WHERE id          = '$id_modificar'");
							
							
											
							
							$accion = "EDITA ACTO ADMINISTRATIVO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      						$detalle = $_SESSION['nombre']." EDITA ACTO ADMINISTRATIVO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es." ID ACTO: ".$id_modificar;				
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				
						
						}
						else{
					
							$this->db->exec("INSERT INTO hv_central (idservidor,nunresolucion,idmotivo,fechaad,fecharegistro,idusuario,tipo_soporte)
							     	         VALUES ('$hv_id_es','$hv_resolucion_ad','$hv_motivo_ad','$hvf_ad','$fechalog','$idusuario','AD')");
											 
							
							
							$accion = "REGISTRA ACTO ADMINISTRATIVO En el Sistema (ADMINISTRAR/Hoja de Vida)";
      		                $detalle = $_SESSION['nombre']." REGISTRA ACTO ADMINISTRATIVO ".$fechalog." "."a las: ".$horalog." ID HOJA DE VIDA: ".$hv_id_es." CEDULA: ".$hv_cedula_es;				 
							
							$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");				 
						}
						
						
						
						
						$i = $i + 1;
					
					}
									 				   
								  
		
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	
	public function editar_detalle_encabezado_archivo(){
	
		
		$modelo     = new administrarModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$idarchivo      = trim($_POST['idarchivo']);
		$iddetalle      = trim($_POST['iddetalle']);
		
		$carpetaarchivo = trim($_POST['carpetaarchivo']);
		$lista_1        = trim($_POST['lista_1']);
		
		$numerocarpeta  = trim($_POST['numerocarpeta']);
		
		$fechaiarchivo  = trim($_POST['fechaiarchivo']);
		$fechafarchivo  = trim($_POST['fechafarchivo']);
		
		$coninicial  = trim($_POST['coninicial']);
		$confinal    = trim($_POST['confinal']);
		
		
		if ( empty($fechaiarchivo) && empty($fechafarchivo) ) {
					
			$fechaiarchivo = '0000-00-00';
			$fechafarchivo = '0000-00-00';
		}
					
		
					
		if ( empty($coninicial) && empty($confinal) ) {
					
			$coninicial    = 0;
			$confinal      = 0;
		}
		
	
		$SLQ_UPDATE = "UPDATE administrar_archivo_detalle SET 
			
								fechaedita        = '$fechalog',
								idusuarioedita	  = '$idusuario',
			               		idcarpeta         = '$carpetaarchivo',
								descarpeta	      = '$lista_1',
						   		numerocarpeta     = '$numerocarpeta',
								fechainicial      = '$fechaiarchivo',
								fechafinal        = '$fechafarchivo',
								coninicial        = '$coninicial',
								confinal          = '$confinal'
								
						   WHERE id = '$iddetalle' AND idarchivo = '$idarchivo'";
						   
			
		$accion = "EDITA DETALE ENCABEZADO Archivo En el Sistema (ADMINISTRAR/Administrar Archivo Listar)";
      	$detalle = $_SESSION['nombre']." EDITA DETALLE ENCABEZADO ".$fechalog." "."a las: ".$horalog." ID ARCHIVO: ".$idarchivo." ID DEATLLE: ".$iddetalle;
		$tipolog = 5;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
		
				$this->db->exec($SLQ_UPDATE);
								  
				
			
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
	public function adicionar_nombre_carpeta(){
	
		
		$modelo     = new administrarModel();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$archivonombrecarpeta = strtoupper(trim($_POST['archivonombrecarpeta']));
		
		$SLQ_UPDATE = "INSERT INTO pa_nombrecarpeta (descarpeta) 
		               VALUES('$archivonombrecarpeta')";
						   
			
		$accion = "ADICIONA NOMBRE CARPETA Archivo En el Sistema (ADMINISTRAR/Administrar Archivo)";
      	$detalle = $_SESSION['nombre']." ADICIONA NOMBRE CARPETA ".$fechalog." "."a las: ".$horalog." NOMBRE CARPETA: ".$archivonombrecarpeta;
		$tipolog = 5;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
		
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
		
				$this->db->exec($SLQ_UPDATE);
								  
				
			
				$msg = "PROCESO SE REALIZA CORRECTAMENTE";
											
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
							
				echo $msg;
				
		
		  
		} 
		catch (Exception $e) {
		
			//$msg = "ERROR EN PROCESO: ".$e->getMessage()." CADENA DATOS: ".$cadena_datos;
			
			$msg = "ERROR EN PROCESO: ".$e->getMessage();
			
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
			
		
			echo $msg;
			
		}
		
		

  	}
	
	
     
}//FIN CLASE
  
  




?>