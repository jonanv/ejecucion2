<?php

class aranceljudicialModel extends modelBase{

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/
	public function mensajes(){

		$condicion = $_GET['nombre'];
		$idmensaje = $_GET['idmensaje'];
		
	 	if($condicion == 2){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=Registro_Arancel"</script>';*/
				print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
			}
		}
		 
	 	if($condicion == "2b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=Registro_Arancel"</script>';*/
				print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	  
	   		}

	 	}
		
		if($condicion == "3b"){
		
			if($idmensaje == 1){$_SESSION['elemento'] = "El Archivo no Cumple con las Caracteristicas Especificas, 
														 si es diferente de tipo (vnd.ms-excel,vnd.openxmlformats-officedocument.spreadsheetml.sheet,
														 vnd.openxmlformats-officedocument.wordprocessingml.document,pdf) y tamaño de archivo < 100000000";}
														 
			if($idmensaje == 2){$_SESSION['elemento'] = "Ya Existe un Archivo con ese Nombre";}
			
			if($idmensaje == 3){$_SESSION['elemento'] = "Error al subir el fichero";}
			

	    	$_SESSION['elem_error_archivo'] = true;

	   		if($_SESSION['id']!=""){

							
				print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=Registro_Documentos_Entrantes_Juzgados"</script>';
	  
	   		}

	 	}
		
		if($condicion == 4){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

				print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=Imprimir_Arancel"</script>';
			}
		}
		 
	 	if($condicion == "4b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=Imprimir_Arancel"</script>';
	  
	   		}

	 	}
	 
	 	
	 
	
	}	
	
	/***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

	public function listarLogArancel(){

		$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									  FROM LOG AS logusuario
								      INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									  WHERE logusuario.idtipolog = 3
									  ORDER BY logusuario.id DESC
									  LIMIT 15");
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
	
	public function get_ano(){
	
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('y'); 
		
		return $fecharegistro; 

	}
	//HORA MILITAR
	public function get_hora_actual_24horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i');
		$hora         = date('H');
		
		//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
		//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
		//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
		//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
		if($hora >= 1 && $hora <= 9){
			$horaregistro = substr($horaregistro, -4);    // Ej: 08:54 devuelve 8:54
		}
		
		return $horaregistro; 
	}
	//HORA NORMAL(FUNCION USADA, SOLO PARA VISUALIZACION DEL USUARIO, YA QUE EN LA BASE DE DATOS SE TRABAJA CON HORA MILITAR)
	public function get_hora_actual_12horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro=date('g:i:s A');
		return $horaregistro; 
	}
	
	public function get_lista($nombrelista,$campoordenar,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_arancel(){
	
		$listar     = $this->db->prepare("SELECT * FROM arancel_pa_item");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_juzgado_usuario(){
	
		$idusuario  = $_SESSION['idUsuario'];
	
		$listar     = $this->db->prepare("SELECT pj.id,pj.nombre,pj.numero_juzgado,pj.radicadojuzgado FROM (pa_usuario pu INNER JOIN pa_juzgado pj ON pu.idjuzgadousuario = pj.id)
										  WHERE pu.id = '$idusuario'");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_proceso($idradicado){
	
		
		$listar     = $this->db->prepare("SELECT ubi.id AS idproceso,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,
										  pj.id AS idjuzgadoorigen,pj.nombre AS nombrejuzgadoorigen 
										  FROM (ubicacion_expediente ubi INNER JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id)
									      WHERE ubi.id = '$idradicado'");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_liquidaciones_imprimir_usuario($identrada){
	
		
		$model       = new aranceljudicialModel();
		
		//VARIABLE QUE ME PERMITE LIMITAR LA CARGA DE REGISTROS EN LA TABLA PARA IMPRIMIR
		//Y NO TRAER TODOS LOS REGISTROS QUE A APROBADO EL USUARIO
		//$fechaactual = $model->get_fecha_actual_amd();
		
		$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			   
			/*$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,al.observacionl,al.estado,al.estado2
											 FROM (arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
											 WHERE al.idusuario = '$idusuario'
										     ORDER BY al.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,al.observacionl,al.estado,al.estado2,us.empleado
											 FROM ((arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
											 INNER JOIN pa_usuario us ON us.id = al.idusuario)
										     ORDER BY al.id DESC
											 LIMIT 10");
											 
											  //AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual')
											 
			
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
		
				$filtrof = " AND (al.fechal >= '$fechad' AND al.fechal <= '$fechah') ";
			
			}
			//SI NO DEFINO FECHA TOMA LA FECHA ACTUAL PARA EL FILTRO
			/*else{

				$filtrof = " AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual') ";
			}*/
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND ap.radicado LIKE '%$datox1%' ";
				
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND al.idusuario = '$datox2' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtrof;
			
			//echo $filtrox;
			
		 
			/*$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,ap.idjuzgado,al.observacionl,al.estado,al.estado2
											 FROM (arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
											 WHERE al.id >= 1 AND
											 al.idusuario = '$idusuario' " .$filtrox. "
											 ORDER BY al.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,ap.idjuzgado,al.observacionl,al.estado,al.estado2,us.empleado
											 FROM ((arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
											 INNER JOIN pa_usuario us ON us.id = al.idusuario)
											 WHERE al.id >= 1 " .$filtrox. "
											 ORDER BY al.id DESC");
											 
			/*$sql = "SELECT al.id,al.numl,al.fechal,ap.radicado,ap.idjuzgado,al.observacionl,al.estado,al.estado2
											 FROM (arancel_liquidacion al INNER JOIN ubicacion_expediente ap ON al.idradicadol = ap.id)
											 WHERE al.id >= 1 " .$filtrox. "
											 ORDER BY al.id DESC";*/
											 
			echo $sql;
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_liquidaciones_imprimir_usuario_actual($identrada){
	
		
		$model       = new aranceljudicialModel();
		
		//VARIABLE QUE ME PERMITE LIMITAR LA CARGA DE REGISTROS EN LA TABLA PARA IMPRIMIR
		//Y NO TRAER TODOS LOS REGISTROS QUE A APROBADO EL USUARIO
		$fechaactual = $model->get_fecha_actual_amd();

		$idusuario   = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
		   
			$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,al.observacionl,al.estado,al.estado2
											 FROM (arancel_liquidacion al INNER JOIN arancel_proceso ap ON al.idradicadol = ap.id)
											 WHERE (al.fechal >= '$fechaactual' AND al.fechal <= '$fechaactual')
										     ORDER BY al.id DESC");
											 
											  //AND (de.fecha >= '$fechaactual' AND de.fecha <= '$fechaactual')
											 
			
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
		
				$filtrof = " AND (al.fechal >= '$fechad' AND al.fechal <= '$fechah') ";
			
			}
			//SI NO DEFINO FECHA TOMA LA FECHA ACTUAL PARA EL FILTRO
			else{

				$filtrof = " AND (al.fechal >= '$fechaactual' AND al.fechal <= '$fechaactual') ";
			}
			
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND ap.juzgadoorigen = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND ap.radicado LIKE '%$datox2%' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtrof;
			
			//echo $filtrox;
			
			$listar    = $this->db->prepare("SELECT al.id,al.numl,al.fechal,ap.radicado,ap.juzgadoorigen,al.observacionl,al.estado,al.estado2
											 FROM (arancel_liquidacion al INNER JOIN arancel_proceso ap ON al.idradicadol = ap.id)
											 WHERE al.id >= 1 
											 " .$filtrox. "
											 ORDER BY al.id DESC");
											
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function registrar_arancel(){
	
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO ENTRANTE
		$iddocumento   = trim($_POST['iddocumento']);

		
		//SE OBTIENEN LOS DATOS
		$idusuario     = $_SESSION['idUsuario'];
		
		$idradicado        = trim($_POST['idradicado']);
		$radicado          = trim($_POST['radicado']);
		$cedula_demandante = trim($_POST['cedula_demandante']);
		$demandante        = utf8_encode(trim($_POST['demandante']));
		$cedula_demandado  = trim($_POST['cedula_demandado']);
		$demandado         = trim($_POST['demandado']);
		$fechal            = trim($_POST['fechal']);
		$juzgadoorigen     = trim($_POST['juzgadoorigen']);
		$observacion       = utf8_encode(trim($_POST['observacion']));
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new aranceljudicialModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Liquidacion";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (ARANCEL JUDICIAL)";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
			
				//SELECCIONAMOS EL MAXIMO DE numl PARA SABER QUE NUMERO DE LIQUIDACION CONTINUA
				$listar = $this->db->prepare("SELECT MAX(numl) AS maximo FROM arancel_liquidacion");
	
				$listar->execute();
					
				//$resultado = $listar->rowCount();
				
				$field     = $listar->fetch();
					
				$numeroconsecutivo = $field[maximo];
				$numeroconsecutivo = $numeroconsecutivo + 1; 
				//--------------------------------------------------------------------------------------------------
				
				//IDENTIFICAMOS QUE UN PROCESO YA EXISTA EN LA TABLA arancel_proceso
				//PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS TRAIDOS DE SIGLO XXI
				/*$listar = $this->db->prepare("SELECT * FROM arancel_proceso WHERE radicado = '$radicado'");
				
	
				$listar->execute();
					
				$resultado = $listar->rowCount();
				
				if(!$resultado){//NO EXISTE REGISTRO
	
					$iddocumento = 0;
				}
				else{//EXISTE REGISTRO
					
					$iddocumento = 1;
					$fila        = $listar->fetch();
					$idrad       = $fila[id];
				}*/
				
				//--------------------------------------------------------------------------------------------------
				
				//if( empty($iddocumento) ){
				if( $iddocumento == 0 ){
				
					/*$this->db->exec("INSERT INTO arancel_proceso (idusuario,radicado,fecha,juzgadoorigen,
									 cedulademandante,nombredemandante,cedulademandado,nombredemandado)
									 VALUES ('$idusuario','$radicado','$fechal','$juzgadoorigen','$cedula_demandante','$demandante',
									 '$cedula_demandado','$demandado')");
									 
									 
					//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA arancel_proceso
					//PARA TENER EL ID QUE ME IDENTIFICARA UN PROCESO EN DICHA TABLA
					$lastId     = $this->db->lastInsertId();*/
									 
					$this->db->exec("INSERT INTO arancel_liquidacion (idusuario,idusuarioaprueba,idusuarioelimina,numl,fechal,idradicadol,observacionl,estado,estado2)
									 VALUES ('$idusuario',0,0,'$numeroconsecutivo','$fechal','$idradicado','$observacion','NO APROBADA','')");
									 
									 
									 
					$i = 2;
					
					while($i < 16){
						
						$pagina	   = trim($_POST['pagina'.$i]);
						$subtotal  = trim($_POST['subtotal'.$i]);
						
						$idarancel = trim($_POST['ida'.$i]);
						
						//SE VALIDA POR EL $idarancel = 5, YA QUE ESTE ARANCEL CORRESPONDE AL ARANCEL
						//DE LAS NOTIFICACIONES ELECTRONICAS QUE NO TIENEN COSTO
						if($idarancel != 5){
							
							if( $pagina > 0 && $subtotal > 0 ){
							
								$this->db->exec("INSERT INTO arancel_detalle_liquidacion (idusuario,numlde,idarancelde,paginasde,cantidadde)
												 VALUES ('$idusuario','$numeroconsecutivo','$idarancel','$pagina','$subtotal')");
							}
						}
						
						$i = $i + 1;
					
					}
					
					
					
					
				}
				else{
					 
					/*$this->db->exec("UPDATE arancel_proceso SET juzgadoorigen = '$juzgadoorigen',
									 cedulademandante = '$cedula_demandante',nombredemandante = '$demandante',
									 cedulademandado = '$cedula_demandado',nombredemandado = '$demandado'
									 WHERE radicado = '$radicado'");
									 
									 
					$this->db->exec("INSERT INTO arancel_liquidacion (idusuario,idusuarioaprueba,idusuarioelimina,numl,fechal,idradicadol,observacionl,estado,estado2)
									 VALUES ('$idusuario',0,0,'$numeroconsecutivo','$fechal','$idrad','$observacion','NO APROBADA','')");
									 
									 
									 
					$i = 2;
					
					while($i < 15){
						
						$pagina	   = trim($_POST['pagina'.$i]);
						$subtotal  = trim($_POST['subtotal'.$i]);
						
						$idarancel = trim($_POST['ida'.$i]);
						
						//SE VALIDA POR EL $idarancel = 5, YA QUE ESTE ARANCEL CORRESPONDE AL ARANCEL
						//DE LAS NOTIFICACIONES ELECTRONICAS QUE NO TIENEN COSTO
						if($idarancel != 5){
							
							if( $pagina > 0 && $subtotal > 0 ){
							
								$this->db->exec("INSERT INTO arancel_detalle_liquidacion (idusuario,numlde,idarancelde,paginasde,cantidadde)
												 VALUES ('$idusuario','$numeroconsecutivo','$idarancel','$pagina','$subtotal')");
							}
						}
						
						$i = $i + 1;
					
					}*/
								 
				}
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	
	public function aprobar_liquidacion(){
	
		//SE OBTIENEN LOS DATOS
		$idusuario     = $_SESSION['idUsuario'];
		
		$idl           = trim($_GET['idl']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new aranceljudicialModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Liquidacion";
		
		if( empty($iddocumento) ){
			$accion  = "Aprueba una Nueva ".$tiporegistro." En el Sistema (ARANCEL JUDICIAL)";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
			
				$this->db->exec("UPDATE arancel_liquidacion SET estado = 'APROBADA',idusuarioaprueba = $idusuario  WHERE id = '$idl'");
	
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	
	public function anular_liquidacion(){
	
		//SE OBTIENEN LOS DATOS
		$idusuario     = $_SESSION['idUsuario'];
		
		$idl           = trim($_GET['idl']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new aranceljudicialModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Liquidacion";
		
		if( empty($iddocumento) ){
			$accion  = "Anula una ".$tiporegistro." En el Sistema (ARANCEL JUDICIAL)";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
			
				$this->db->exec("UPDATE arancel_liquidacion SET estado2 = 'ANULADA',idusuarioelimina = $idusuario  WHERE id = '$idl'");
	
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=aranceljudicial&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	

}//FIN CLASE

?>