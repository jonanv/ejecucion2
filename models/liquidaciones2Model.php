<?php

class liquidaciones2Model extends modelBase{


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
	
	//HORA MILITAR CON SEGUNDOS
  	public function get_hora_actual_24horas_segundos(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i:s');
		
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
	
	
	
	public function get_datos_fechaminmax_liquidacion($fecha_consulta){
	
		$listar  = $this->db->prepare("SELECT ".$fecha_consulta." FROM liquidacion_costas");
										  
		
		$listar->execute();

  		return $listar;								  
	
	}
	
	public function get_datos_tipo_liquidacion($campo_liqui){
	
		$listar  = $this->db->prepare("SELECT ".$campo_liqui." FROM liquidacion_costas
									   GROUP BY ".$campo_liqui);
										  
		
		$listar->execute();

  		return $listar;								  
	
	}
	
	public function get_datos_liquidador(){
	
		$listar  = $this->db->prepare("SELECT t2.id,t2.empleado
									   FROM (liquidacion_costas t1 INNER JOIN pa_usuario t2 ON t1.idusuario = t2.id)
                                       GROUP BY empleado
                                       ORDER BY t2.empleado");
										  
		
		$listar->execute();

  		return $listar;								  
	
	}
	
	public function get_datos_liquidaciones($identrada){
	
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){

			
											  
			$listar     = $this->db->prepare("SELECT t1.id,t1.nunentrada,t1.fechae,t1.horae,t2.radicado,
											  t1.estadoe,t1.notae,t1.nuevo,t1.liquidacioncredito,t1.observacioncostas,
											  t3.empleado,t4.nombre AS juzgado
											  FROM (((liquidacion_costas t1
											  LEFT JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
											  LEFT JOIN pa_usuario t3 ON t1.idusuario = t3.id)
											  LEFT JOIN juzgado_destino t4 ON t1.idjuzgadoejecucion = t4.id)
											  ORDER BY t1.id DESC LIMIT 5");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			

			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (t1.fechae >= '$fechad' AND t1.fechae <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t2.radicado LIKE '%$datox1%' ";
			
			}
			if ( !empty($datox2) ) {
			
				//$filtro2 = " AND t3.empleado LIKE '%$datox2%' ";
				
				$filtro2 = " AND t3.id = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t4.id = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND t1.nuevo = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND t1.liquidacioncredito = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND t1.estadoe = '$datox6' ";
			
			}
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof;
			
			 
			
											 									 
			$listar     = $this->db->prepare("SELECT t1.id,t1.nunentrada,t1.fechae,t1.horae,t2.radicado,
											  t1.estadoe,t1.notae,t1.nuevo,t1.liquidacioncredito,t1.observacioncostas,
											  t3.empleado,t4.nombre AS juzgado
											  FROM (((liquidacion_costas t1
											  LEFT JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
											  LEFT JOIN pa_usuario t3 ON t1.idusuario = t3.id)
											  LEFT JOIN juzgado_destino t4 ON t1.idjuzgadoejecucion = t4.id)
											  WHERE t1.id >= '1'" .$filtrox. " 
											  ORDER BY t1.id");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function get_datos_cantidad_liquidaciones(){
	
	
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			

			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (t1.fechae >= '$fechad' AND t1.fechae <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t2.radicado LIKE '%$datox1%' ";
			
			}
			if ( !empty($datox2) ) {
			
				//$filtro2 = " AND t3.empleado LIKE '%$datox2%' ";
				
				$filtro2 = " AND t3.id = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t4.id = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND t1.nuevo = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND t1.liquidacioncredito = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND t1.estadoe = '$datox6' ";
			
			}
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof;
			
			 
			
											 									 
			$listar     = $this->db->prepare("SELECT COUNT(t1.id) AS cantidad
											  FROM (((liquidacion_costas t1
											  LEFT JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
											  LEFT JOIN pa_usuario t3 ON t1.idusuario = t3.id)
											  LEFT JOIN juzgado_destino t4 ON t1.idjuzgadoejecucion = t4.id)
											  WHERE t1.id >= '1'" .$filtrox. " 
											  ORDER BY t1.id");
		

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	public function registrar_liquidar_costas(){
	
		$modelo = new liquidaciones2Model();

		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		$fecha_liqui         = trim($_POST['fecha_liqui']);
		
		//$hora_liqui         = trim($_POST['hora_liqui']);
		$hora_liqui         = $modelo->get_hora_actual_24horas_segundos();
		
		$id_liqui           = trim($_POST['id_liqui']);
		$juzgado_liqui      = trim($_POST['juzgado_liqui']);
		$nuevo              = trim($_POST['nuevo']);
		$liquidacioncredito = trim($_POST['liquidacioncredito']);
		$observacionsr      = utf8_decode(trim($_POST['observacionsr']));
		
	
		$datospartes = trim($_POST['datospartes']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
	
		$accion  = "Registra Liquidar Costas En el Sistema (MOLIC)";
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		 
				$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')"); 
				 
				
				
				//--------------------MAXIMO NUMERO DE LIQUIDACION-------------------------------------------
				$listar = $this->db->prepare("SELECT MAX(nunentrada) AS maximo FROM liquidacion_costas");
														  
				$listar->execute();
							
				//$resultado = $listar->rowCount();
							
				$field     = $listar->fetch();
								
				$numeroconsecutivo = $field[maximo];
				$consecutivo       = $numeroconsecutivo + 1; 
				//---------------------------------------------------------------------------------------------
				
							
				$this->db->exec("INSERT INTO liquidacion_costas (nunentrada,fechae,horae,idradicado,estadoe,notae,
				                 idusuario,idjuzgadoejecucion,nuevo,liquidacioncredito,observacioncostas)
						         VALUES ('$consecutivo','$fecha_liqui','$hora_liqui','$id_liqui','','',
								 '$idusuario','$juzgado_liqui','$nuevo','$liquidacioncredito','$observacionsr')"); 
								 
									 
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA liquidacion_costas
				$id_liquidacion  = $this->db->lastInsertId();
					
	
				//1 EXPLODE
				$datospartes_1 = explode("******",$datospartes); 
				$longitud_1    = count($datospartes_1);
				$i             = 1;
				
				while($i < $longitud_1){
					
					//2 EXPLODE
					$datospartes_2 = explode("//////",$datospartes_1[$i]);
					
					
					$idarticulode = $datospartes_2[0];
					$cantidadde   = $datospartes_2[2];
					
				
					$this->db->exec("INSERT INTO detalle_liquidacion_costas (nunentradade,idarticulode,cantidadde,idusuario)
						             VALUES ('$consecutivo','$idarticulode','$cantidadde','$idusuario')");
					
					
					
					
					$i = $i + 1;
				
				}
								 
								 
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			echo "CORRECTO**********";
			/*print'<script languaje="Javascript">location.href="index.php?controller=administrar&action=mensajes&nombre=1"</script>';*/
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			
			echo "ERROR**********".$e->getMessage();
			
			/*print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=11b"</script>';*/
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
	
	
	public function editar_encabezado_archivo(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$idarchivo   = trim($_POST['idarchivo']);
		$yeararchivo = trim($_POST['yeararchivo']);
		$cajaarchivo = trim($_POST['cajaarchivo']);
		
	
		$SLQ_UPDATE = "UPDATE administrar_archivo SET 
			
								fechaedita        = '$fechalog',
								idusuarioedita	  = '$idusuario',
			               		year              = '$yeararchivo',
						   		caja              = '$cajaarchivo'
								
						   WHERE id = '$idarchivo'";
						   
			
		$accion = "EDITA ENCABEZADO Archivo En el Sistema (ADMINISTRAR/Administrar Archivo Listar)";
      	$detalle = $_SESSION['nombre']." EDITA ENCABEZADO ".$fechalog." "."a las: ".$horalog." ID ARCHIVO: ".$idarchivo;
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
	
	
	public function editar_detalle_encabezado_archivo(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
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
	
		
		$modelo     = new liquidaciones2Model();
				
		
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
	
	
	public function adicionar_item(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$referencia_liqui = utf8_decode(trim($_POST['referencia_liqui']));
		$nombre_liqui     = utf8_decode(trim($_POST['nombre_liqui']));
		$descrip_liqui    = utf8_decode(trim($_POST['descrip_liqui']));
		
		$SLQ_UPDATE = "INSERT INTO item (referencia,nomarticulo,desarticulo,idusuario) 
		               VALUES('$referencia_liqui','$nombre_liqui','$descrip_liqui','$idusuario')";
						   
			
		$accion = "ADICIONA ITEM En el Sistema (MOLIC)";
      	$detalle = $_SESSION['nombre']." ADICIONA ITEM ".$fechalog." "."a las: ".$horalog." REFERENCIA ITEM: ".$referencia_liqui." NOMBRE ITEM: ".$nombre_liqui;
		$tipolog = 6;
		
		
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
	
	
	public function editar_item(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$id_liqui_item    = trim($_POST['id_liqui_item']);
		$referencia_liqui = utf8_decode(trim($_POST['referencia_liqui']));
		$nombre_liqui     = utf8_decode(trim($_POST['nombre_liqui']));
		$descrip_liqui    = utf8_decode(trim($_POST['descrip_liqui']));
		
		/*$SLQ_UPDATE = "INSERT INTO item (referencia,nomarticulo,desarticulo,idusuario) 
		               VALUES('$referencia_liqui','$nombre_liqui','$descrip_liqui','$idusuario')";*/
					   
		
		$SLQ_UPDATE = "UPDATE item SET
					   nomarticulo = '$nombre_liqui',
					   desarticulo = '$descrip_liqui' 
		               WHERE idarticulo = '$id_liqui_item'";			   
						   
			
		$accion = "EDITA ITEM En el Sistema (MOLIC)";
      	$detalle = $_SESSION['nombre']." EDITA ITEM ".$fechalog." "."a las: ".$horalog." REFERENCIA ITEM: ".$referencia_liqui." NOMBRE ITEM: ".$nombre_liqui;
		$tipolog = 6;
		
		
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
	
	public function anular_liquidacion(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$idliqui           = trim($_POST['idliqui']);
		$observacionsr_anu = utf8_decode(trim($_POST['observacionsr_anu']));
		
		
		$SLQ_UPDATE = "UPDATE liquidacion_costas SET
					   estadoe = 'ANULADA',
					   notae = '$observacionsr_anu' 
		               WHERE nunentrada = '$idliqui'";			   
						   
			
		$accion = "ANULA LIQUIDACION En el Sistema (MOLIC)";
      	$detalle = $_SESSION['nombre']." ANULA LIQUIDACION ".$fechalog." "."a las: ".$horalog." LIQUIDACION NUMERO: ".$idliqui;
		$tipolog = 6;
		
		
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
	
	
	public function cambiar_fecha_liquidacion(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$idliqui       = trim($_POST['idliqui']);
		$fecha_liqui_a = trim($_POST['fecha_liqui_a']);
		
		
		$SLQ_UPDATE = "UPDATE liquidacion_costas SET
					   fechae = '$fecha_liqui_a' 
		               WHERE nunentrada = '$idliqui'";			   
						   
			
		$accion = "CAMBIA FECHA LIQUIDACION En el Sistema (MOLIC)";
      	$detalle = $_SESSION['nombre']." CAMBIA FECHA LIQUIDACION ".$fechalog." "."a las: ".$horalog." LIQUIDACION NUMERO: ".$idliqui;
		$tipolog = 6;
		
		
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
	
	public function editar_item_liquidacion(){
	
		
		$modelo     = new liquidaciones2Model();
				
		
		//DATOS PARA EL REGISTRO DEL LOG

		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		
		//$horalog    = $datosfecha[1];
		$horalog    = $modelo->get_hora_actual_24horas();
		
		//SE OBTIENEN LOS DATOS
		$idusuario      = $_SESSION['idUsuario'];
		
		$idliqui       = trim($_POST['idliqui']);
		//$fecha_liqui_a = trim($_POST['fecha_liqui_a']);
		$datospartes = trim($_POST['datospartes_nvx']);
		
		
		   
		$accion  = "EDITAR ITEMS LIQUIDACION En el Sistema (MOLIC)";
      	$detalle = $_SESSION['nombre']." EDITA ITEMS LIQUIDACION ".$fechalog." "."a las: ".$horalog." LIQUIDACION NUMERO: ".$idliqui;
		$tipolog = 6;
		
		
		//$error_transaccion   = 0; //variable para detectar error
		$msg = " ";
	
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
		
				$this->db->exec("DELETE FROM detalle_liquidacion_costas WHERE nunentradade = '$idliqui'");
				
				
				
				//1 EXPLODE
				$datospartes_1 = explode("******",$datospartes); 
				$longitud_1    = count($datospartes_1);
				$i             = 1;
				
				while($i < $longitud_1){
					
					//2 EXPLODE
					$datospartes_2 = explode("//////",$datospartes_1[$i]);
					
					
					$idarticulode = $datospartes_2[0];
					$cantidadde   = $datospartes_2[2];
			
					
					//SE REALIZA ESTA COMPARACION, YA QUE CUANDO SE DESEA AGREGAR
					//UN NUEVO ITEM DE COSTAS Y SI EL PRIMER REGISTRO DE LA TABLA
					//DETALLE LIQUIDACION ES IGUAL AL QUE SE ESCOGE DE LA LISTA ITEM
					//NO SE COMPARAN COMO IGUAL, YA QUE EL DATO DE LA COLUMNA ID DEL PRIMER
					//REGISTRO TIENE UN PUNTO ES DECIR .costa013, AUNQUE NO SE VISUSLIZA.
					//LO CUAL NO ES IGUAL costa013 == .costa013, POR ENDE SE APLICA LA FUNCION
					//substr Y OBTENEMOS costa013
					if($i == 1){
					
						$idarticulode = substr($idarticulode,1);					
					}
					
					$this->db->exec("INSERT INTO detalle_liquidacion_costas (nunentradade,idarticulode,cantidadde,idusuario)
						             VALUES ('$idliqui','$idarticulode','$cantidadde','$idusuario')");
					
					
					/*$this->db->exec("INSERT INTO tabla_prueba (des)
						             VALUES ('$idarticulode')");*/
					
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
	
	
     
}//FIN CLASE
  
  




?>