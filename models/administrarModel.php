<?php

class administrarModel extends modelBase{


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
	
	public function registrar_administrar_archivo(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		$yeararchivo = trim($_POST['yeararchivo']);
		$cajaarchivo = trim($_POST['cajaarchivo']);
	
		$datospartes = trim($_POST['datospartes']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new administrarModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
	
		$accion  = "Registra Administrar Archivo En el Sistema (ADMINISTRAR/Administrar Archivo)";
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 5;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		 
				$this->db->exec("INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) 
				                 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')"); 
				 
				
				//IDENTIFICAMOS QUE UN PROCESO YA EXISTA EN LA TABLA siepro_titulos_otrosjuzgados
				//PARA NO VOLVER A REGISTRAR.
				/*$listar = $this->db->prepare("SELECT * FROM siepro_titulos_otrosjuzgados WHERE radicado = '$radicado'");
		
				$listar->execute();
						
				$resultado = $listar->rowCount();
					
				if(!$resultado){//NO EXISTE
				 
					$this->db->exec("INSERT INTO siepro_titulos_otrosjuzgados (radicado,fecharegistro,idusuarioregistra)
						             VALUES ('$radicado','$fechalog','$idusuario')"); 
									 
					//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_titulos_otrosjuzgados
				    $idradicado  = $this->db->lastInsertId();
				}
				else{//EXISTE
				
					$field = $listar->fetch();
						
					$idradicado = trim($field[id]);
				
				}*/
				  
				$this->db->exec("INSERT INTO administrar_archivo (year,caja,fecharegistro,idusuario)
						         VALUES ('$yeararchivo','$cajaarchivo','$fechalog','$idusuario')"); 
									 
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_titulos_otrosjuzgados
				$idarchivo  = $this->db->lastInsertId();
					
				 
				//******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
				//75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
		
				//1 EXPLODE
				$datospartes_1 = explode("******",$datospartes); 
				$longitud_1    = count($datospartes_1);
				$i             = 1;
				
				while($i < $longitud_1){
					
					//2 EXPLODE
					$datospartes_2 = explode("//////",$datospartes_1[$i]);
					
					
					$idcarpeta     = $datospartes_2[0];
					$descarpeta    = $datospartes_2[1];
					$numerocarpeta = $datospartes_2[2];
					
					$fechainicial  = $datospartes_2[3];
					$fechafinal    = $datospartes_2[4];
					
					if ( empty($fechainicial) && empty($fechafinal) ) {
					
						$fechainicial    = '0000-00-00';
						$fechafinal      = '0000-00-00';
					}
					
					$coninicial    = $datospartes_2[5];
					$confinal      = $datospartes_2[6];
					
					if ( empty($coninicial) && empty($confinal) ) {
					
						$coninicial    = 0;
						$confinal      = 0;
					}
					
				
					$this->db->exec("INSERT INTO administrar_archivo_detalle (idarchivo,idcarpeta,descarpeta,numerocarpeta,
					                 fechainicial,fechafinal,coninicial,confinal,fecharegistro,idusuario)
						             VALUES ('$idarchivo','$idcarpeta','$descarpeta','$numerocarpeta',
									 '$fechainicial','$fechafinal','$coninicial','$confinal',
									 '$fechalog','$idusuario')");
					
					
					
					
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
	
		
		$modelo     = new administrarModel();
				
		
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