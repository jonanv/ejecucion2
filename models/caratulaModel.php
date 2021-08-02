<?php

class caratulaModel extends modelBase{

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/
	public function mensajes(){

		$condicion=$_GET['nombre'];
 	  
	 	if($condicion == 2){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
			}
		}
		 
	 	if($condicion == "2b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
	  
	   		}

	 	}
	 
	 	if($condicion == "3b1"){

	 		$_SESSION['elemento'] = "El registro ha sido Actualizado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
			}

	 	}
	 
	 	if($condicion == "3b2"){

	 		$_SESSION['elemento'] = "Error al Realizar la Actualizacion del Registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=reps&action=repsListaPermisos"</script>';
			}

	 	}
		
		if($condicion == 4){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
			}
		}
		 
	 	if($condicion == "4b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Registro_Proceso"</script>';
	  
	   		}

	 	}
		
		if($condicion == 5){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso_2"</script>';
			}
		}
		 
	 	if($condicion == "5b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso_2"</script>';
	  
	   		}

	 	}
		
		if($condicion == 6){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
			}
		}
		 
	 	if($condicion == "6b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Proceso"</script>';
	  
	   		}

	 	}
		
		if($condicion == 7){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Parte"</script>';
			}
		}
		 
	 	if($condicion == "7b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Modificar_Parte"</script>';
	  
	   		}

	 	}
	 	
		if($condicion == 8){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
				
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
			}
		}
		 
	 	if($condicion == "8b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

	
				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
				
				print'<script languaje="Javascript">location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes"</script>';
	  
	   		}

	 	}
		
		if($condicion == 9){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
				
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
			}
		}
		 
	 	if($condicion == "9b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

	
				/*print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Generar_Notificacion"</script>';*/
				
				print'<script languaje="Javascript">location.href="index.php?controller=signot&action=Seguimiento_Proceso"</script>';
	  
	   		}

	 	}
	 
	
	}	
	
	/***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

	public function listarLogcaratula(){

		$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									  FROM LOG AS logusuario
								      INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									  WHERE logusuario.idtipolog=9
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
	
	public function get_hora_actual(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro=date('g:i:s A');
		return $horaregistro; 
	}
	
	public function get_datos_usuario_sistema(){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT ingreso,foto,empleado FROM pa_usuario WHERE id = '$idusuario'");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_usuarios(){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario ORDER BY empleado");

  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_usuario_recibe(){
	
		$listar     = $this->db->prepare("SELECT * FROM sigdoc_recibe ORDER BY nombre_recibe");

  		$listar->execute();

  		return $listar;
	
	}
  	
	public function get_lista($nombrelista,$campoordenar,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar){
	
		$listar     = $this->db->prepare("SELECT * FROM ".$nombrelista." ".$filtro." ORDER BY ".$campoordenar." ".$formaordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	

	public function get_direcciones($iddireccion){
	
		$listar     = $this->db->prepare("SELECT sp.id AS idparte,sd.id,sp.cedula,sp.nombre,sd.telefono,sd.direccion,sd.iddepartamento,sd.idmunicipio	
										  FROM (signot_parte sp INNER JOIN signot_direccion sd ON sp.id = sd.idparte)
									      WHERE sd.id = '$iddireccion'");

  		$listar->execute();

  		return $listar;
	}
	
	public function get_auto_correccion($idauto){
	
		//SE REALIZA ESTE CAMBIO DE SQL YA QUE LOS AUTOS DE LAS PARTES SE VA A MANEJAR EN LA TABLA documentos_internos
		
		/*$listar     = $this->db->prepare("SELECT sap.id,sp.cedula,sp.nombre,spr.radicado,sap.idauto,sap.fecharegistroauto,sap.fechaauto,sap.descorrecion,
		               					  sap.idparte,sap.idproceso
										  FROM ((signot_auto_parte sap INNER JOIN signot_parte sp ON sap.idparte = sp.id)
										  INNER JOIN signot_proceso spr ON spr.id = sap.idproceso)
										  WHERE sap.id = '$idauto'");*/
										  
		$listar     = $this->db->prepare("SELECT sap.id,sp.cedula,sp.nombre,spr.radicado,sap.idtipodocumento,sap.numero,sap.dirigidoa,
		                                  sap.direccion,sap.ciudad,sap.fechageneracion,sap.fechaauto,sap.asunto,
										  sap.descorrecion,sap.idparte,sap.idradicado,sap.partes,sap.fechaautocorrige
										  FROM ((documentos_internos sap INNER JOIN signot_parte sp ON sap.idparte = sp.id)
										  INNER JOIN signot_proceso spr ON spr.id = sap.idradicado)
										  WHERE sap.id = $idauto");

  		$listar->execute();

  		return $listar;
	
	
	}
	
	public function get_Consecutivo($filtro){
	
		//$filtro     = $_GET['filtro'];
	
		$listar     = $this->db->prepare("SELECT * FROM sigdoc_area WHERE id = '$filtro'");
		
		$resultado  = $listar->execute();

		$fila       = $resultado->fetch();
		$sigla      = $fila[sigla];
		$contador   = $fila[contador];
		
		$cadenadatos = $sigla."//////".$contador;

		return $cadenadatos;
		
  		//return $listar;
	
	}
	
	public function get_documentos_salientes_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			
			/*$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											  rds.fechageneracion,rds.asunto,rds.contenido
											  FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											  ORDER BY rds.id DESC");*/
											  //ORDER BY rds.id DESC LIMIT 5");
											  
			$listar     = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											  rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											  FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											  LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											  LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											  LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											  ORDER BY rds.id DESC");
											 
			
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
			
				
				$filtrof = " AND (rds.fechageneracion >= '$fechad' AND rds.fechageneracion <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.dirigidoa = '$datox3' ";
			
			}
			if ( !empty($datox4) ) {
			
				//$filtro4 = " AND rds.nombre = '$datox4' ";
				$filtro4 = " AND rds.nombre LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.cargo LIKE '%$datox5%' ";
			
			}
			if ( !empty($datox6) ) {
			
				$filtro6 = " AND rds.dependencia LIKE '%$datox6%' ";
			
			}
			if ( !empty($datox7) ) {
			
				//$filtro8 = " AND rds.asunto = '$datox8' ";
				$filtro7 = " AND rds.asunto LIKE '%$datox7%' ";
			
			}
			if ( !empty($datox8) ) {
			
				$filtro8 = " AND rds.id = '$datox8' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtro8." ".$filtrof;
			
			//echo $filtrox;
			  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											 rds.fechageneracion,rds.asunto,rds.contenido
											 FROM ((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.identrada,td.nombre_tipo_documento,rds.numero,d.nombre_dirigido,rds.nombre,rds.cargo,rds.dependencia,
											 rds.fechageneracion,rds.asunto,rds.contenido,pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											 FROM ((((sigdoc_documentos_internos rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN sigdoc_pa_dirigido d ON rds.dirigidoa = d.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	
	
	public function get_datos_proceso($identrada){
	
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){

			/*$listar     = $this->db->prepare("SELECT * FROM signot_proceso 
			                                  ORDER BY id DESC LIMIT 10");*/
											  
			$listar     = $this->db->prepare("SELECT pro.id,pro.radicado,pro.iddevolucion,td.nombre_tipo_documento
											  FROM (signot_proceso pro LEFT JOIN pa_tipodocumento td ON pro.iddevolucion = td.id)
											  ORDER BY pro.id DESC LIMIT 10");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			

			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fecharegistro >= '$fechad' AND rds.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.radicado LIKE '%$datox1%' ";
			
			}
			
			$filtrox = $filtro1." ".$filtrof;
			
			 
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.radicado
											 FROM signot_proceso rds
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id");*/
											 
											 
			$listar     = $this->db->prepare("SELECT rds.id,rds.radicado,rds.iddevolucion,td.nombre_tipo_documento
											  FROM (signot_proceso rds LEFT JOIN pa_tipodocumento td ON rds.iddevolucion = td.id)
											  WHERE rds.id >= '1'" .$filtrox. " 
											  ORDER BY rds.id");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	//FUNCION QUE CARGA LOS PROCESOS CREADOS EN LA OFICINA JUDICIAL Y SE LES DA REPARTO
	//A LA FECHA ACTUAL, CON EL OBJETO DE GENERAR SU CARATULA	
	public function get_datos_proceso_x($identrada){
  
  	    $modelo  = new caratulaModel();
		
  		$cadenap = " ";
		
		$fechaactual = $modelo->get_fecha_actual_amd();
  
  	    
		$serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
		
		//CONEXION PARA LA SALA DISCIPLINARIA
		/*$serverName = "192.168.89.22"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"S_Discipl", "UID"=>"sa", "PWD"=>"M4nt3n1m13nt0");*/
		
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
		 if( $conn ) { 
			// echo "Conectado a la Base de Datoss.<br />"; 
		 }
		 else{ 
			echo "NO se puede conectar a la Base de Datoss.<br />"; 
			die( print_r( sqlsrv_errors(), true)); 
		 }
	
		 if($identrada == 1){
		    
			$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103HORAREPA]
					 FROM [ConsejoPN].[dbo].[T103DAINFOPROC]
					 WHERE [A103FECHREPA] =  convert(datetime, '$fechaactual', 121) 
					 AND [A103ANOTACTS] LIKE '%reparto%' AND [A103CONSPROC] NOT IN(01,02,03,04,05,06,07,08,09,10) AND [A103LLAVPROC] LIKE '%170014303%'");
					
			//SQL PARA LA SALA DISCIPLINARIA  
			/*$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA]
					 FROM [S_Discipl].[dbo].[T103DAINFOPROC]
					 WHERE [A103FECHREPA] =  convert(datetime, '$fechaactual', 121) 
					 AND [A103ANOTACTS] LIKE '%reparto%'");*/
						
			 $params = array();
			 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
			 $row_count = sqlsrv_num_rows( $stmt );
		
			 if ($row_count === false){
				 echo "Error. en LISTAR PROCESOS";
			 }
			 else{
		 
				 while( $row = sqlsrv_fetch_array( $stmt)){
			 
					 $radi      = $row['A103LLAVPROC'];
					 $fecharepa = date_format($row['A103FECHREPA'],'Y-m-d');
					 $horarepa  = $row['A103HORAREPA'];
					 $nota      = $row['A103ANOTACTS'];
					 
					
					 //$cadenap.= $radi."//////"; 
					 
					 $cadenap.= $radi."//////".$fecharepa."//////".$horarepa."******"; 
					
				}
		 
			}
		
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			

			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( [A103FECHREPA] >= convert(datetime, '$fechad' , 121) AND [A103FECHREPA] <= convert(datetime, '$fechah' , 121) )";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND [A103LLAVPROC] LIKE '%$datox1%' ";
			
			}
			
			$filtrox = $filtro1." ".$filtrof;
			
			$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA],[A103HORAREPA]
					 FROM [ConsejoPN].[dbo].[T103DAINFOPROC]
					 WHERE [A103ANOTACTS] LIKE '%reparto%'" .$filtrox);
					 
			//SQL PARA LA SALA DISCIPLINARIA 
			/*$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA]
					 FROM [S_Discipl].[dbo].[T103DAINFOPROC]
					 WHERE [A103ANOTACTS] LIKE '%reparto%' " .$filtrox);*/
						
			 $params = array();
			 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
			 $row_count = sqlsrv_num_rows( $stmt );
		
			 if ($row_count === false){
				 echo "Error. en LISTAR PROCESOS";
			 }
			 else{
		 
				 while( $row = sqlsrv_fetch_array( $stmt)){
			 
					 $radi      = $row['A103LLAVPROC'];
					 $fecharepa = date_format($row['A103FECHREPA'],'Y-m-d');
					 $horarepa  = $row['A103HORAREPA'];
					 $nota      = $row['A103ANOTACTS'];
					 
					
					 //$cadenap.= $radi."//////"; 
					 
					 $cadenap.= $radi."//////".$fecharepa."//////".$horarepa."******"; 
					
				}
		 
			}
			
		
		}
		
		if($identrada == 3){
		    
			$sql = ("SELECT [A103LLAVPROC],[A103ANOTACTS],[A103FECHREPA]
					 FROM [ConsejoPN].[dbo].[T103DAINFOPROC]
					 WHERE [A103LLAVPROC] LIKE '%$datox1%'");
						
			 $params = array();
			 $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			 $stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
			 $row_count = sqlsrv_num_rows( $stmt );
		
			 if ($row_count === false){
				 echo "Error. en LISTAR PROCESOS";
			 }
			 else{
		 
				 while( $row = sqlsrv_fetch_array( $stmt)){
			 
					 $radi      = $row['A103LLAVPROC'];
					 $fecharepa = $row['A103FECHREPA'];
					 $nota      = $row['A103ANOTACTS'];
					 
					
					 $cadenap.= $radi."//////"; 
					
				}
		 
			}
		
		}
  
  	    return $cadenap;
  		/*print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=2"</script>';*/
  
  }
	
	

	public function get_datos_proceso_anotacion(){
	
		$id     = trim($_GET['id']);
	
		//$listar = $this->db->prepare("SELECT * FROM documentos_internos WHERE id = '$id'");
		
		$listar = $this->db->prepare("SELECT sp.id,sp.radicado FROM signot_proceso sp
                                      WHERE sp.id = '$id'");
		
  		$listar->execute();

  		return $listar;
	
	}
	
	public function get_datos_proceso_anotacion_2($id){
	
		

		$listar = $this->db->prepare("SELECT spa.id,spa.idradicado,pu.empleado,spa.fecha,spa.hora,spa.anotacion,ta.destipo
									  FROM ((signot_proceso_anotacion spa INNER JOIN pa_usuario pu ON spa.idusuario = pu.id)
									  LEFT JOIN signot_pa_tipo_anotacion ta ON ta.id = spa.idtipoanotacion)
									  WHERE spa.idradicado = '$id' ORDER BY spa.id DESC");
		
  		$listar->execute();

  		return $listar;
	
	}
	
	public function registrar_documentos_salientes(){

		
		//SE OBTIENEN LOS DATOS
		
		$idusuario     = $_SESSION['idUsuario'];
		$consecutivodocumento = trim($_POST['consecutivodocumento']);
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
		$iddocumento   = trim($_POST['iddocumento']);
		
		$tipodocumento = trim($_POST['tipodocumento']);
		$ndocumento    = trim($_POST['ndocumento']);
		$dirigidoa     = trim($_POST['dirigidoa']);
		$nombre        = trim($_POST['nombre']);
		$cargo         = trim($_POST['cargo']);
		$dependencia   = trim($_POST['dependencia']);
		$fechag        = trim($_POST['fechag']);
		$asunto        = utf8_encode(trim($_POST['asunto']));
		$detalleds     = utf8_encode(trim($_POST['detalleds']));
			
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Salida de Documento";
		
		if( empty($iddocumento) ){
	
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS SALIENTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
				//CAPTURO EL MAXIMO DEL CAMPO numero PARA DETERMINAR QUE CONSECUTIVO DEBE ARMARSE
				//PARA EL SIGUIENTE TIPO DE DOCUMENTO, YA QUE SI EL CONTADOR DE LA TABLA sigdoc_pa_consecutivo
				//VA EN 5 Y SI DOS USUARIOS ENRAN AL MISMO TIEMPO Y ESCOGEN TIPO DOCUMENTO OFICIO
				//SALE EN Numero Documento: CSJCF15-005 PARA AMBOS Y AL REGISTRAR CADA UNO
				//QUEDA EN LA TABLA sigdoc_documentos_internos DOS DOCUMENTOS CON EL MISMO NUMERO
				//PARA SE RECONSTRUYO EL CONSECUTIVO CON LO MENCIONADO ANTERIORMENTE, ACTUALIZANDO LA VARIABLE $ndocumento
				//QUE ES LA QUE RECIBE EL CONSECUTIVO INICIAL DE LA VISTA sigdoc_documentos_salientes.php	
				//Y ACTUALIZAMOS DE LA TABLA sigdoc_pa_consecutivo LA COLUMNA contador, ESTE DATO TAMBIEN DEBE RECOSTRUIRSE
				//PASA DE $consecutivodocumento A $consecutivo
				
				//SE CAMBIA LA SQL YA QUE SE NECESITABA LAS SIGLAS
				/*$listar = $this->db->prepare("SELECT MAX(id) AS idmaximo,numero
											  FROM sigdoc_documentos_internos
											  WHERE id IN(SELECT MAX(id) AS idmaximo FROM sigdoc_documentos_internos WHERE idtipodocumento = '$tipodocumento' ) 
											  AND idtipodocumento = '$tipodocumento'");*/
											  
				$listar = $this->db->prepare("SELECT MAX(di.id) AS idmaximo,di.numero,dc.sigla
											  FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento)
											  WHERE di.id IN(
												  SELECT MAX(di.id) AS idmaximo
												  FROM (sigdoc_documentos_internos di INNER JOIN sigdoc_pa_consecutivo dc ON di.idtipodocumento = dc.idtipodocumento) 
												  WHERE di.idtipodocumento = '$tipodocumento'
											
											  )
											  AND di.idtipodocumento = '$tipodocumento'");

  				$listar->execute();
				
				/*$field = $listar->fetch();
				
				$numeroconsecutivo = explode("-",$field[numero]);
				$consecutivo       = $numeroconsecutivo[1] + 1; 
				
				if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
				if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
				
				$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;*/
				
				
				$resultado = $listar->rowCount();

				if(!$resultado){//existe registros
	
						$field = $listar->fetch();
					
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $numeroconsecutivo[0]."-".$consecutivo;
				}
				else{//no existe registro, Y SE DEBE CONSTRUIR EL CONSECUTIVO CON LAS SIGLAS Y EL AÑO YA QUE LOS DATOS EN LA TABLA
						 //documentos_internos SON NULL Y EL NUEMRO QUEDARIA DE ESTA FORMA -001,-002 
					
						$field = $listar->fetch();
						
						$year  = $modelo->get_ano();
						
						$numeroconsecutivo = explode("-",$field[numero]);
						$consecutivo       = $numeroconsecutivo[1] + 1; 
						
						if($consecutivo >= 0 && $consecutivo <= 9) {$consecutivo = "00".$consecutivo;}
						if($consecutivo >  9 && $consecutivo <= 99){$consecutivo = "0".$consecutivo;}
						
						$ndocumento        = $field[sigla]."".$year."-".$consecutivo;
			
				}
				
				
				
				
				
				
				//---------------------------------------------------------------------------------------------------------------------------------------------------
		   		
				if( empty($iddocumento) ){
					
					$this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
									 fechageneracion,fechaedita,asunto,contenido)
									 VALUES ('$idusuario',0,0,'$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
									 '$asunto','$detalleds')");
					
					//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
					
					$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivo' WHERE idtipodocumento = '$tipodocumento'");
				}
				else{
					
					$this->db->exec("UPDATE sigdoc_documentos_internos SET dirigidoa = '$dirigidoa',nombre = '$nombre',cargo = '$cargo',
					 				 dependencia = '$dependencia',asunto = '$asunto',contenido = '$detalleds',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
									 WHERE id = '$iddocumento'");
								 
				}
				
				//$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
								 

				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	public function registrar_respuesta_documento(){

		
		//SE OBTIENEN LOS DATOS
		
		$idusuario     = $_SESSION['idUsuario'];
		$consecutivodocumento = trim($_POST['consecutivodocumento']);
		
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO
		//$iddocumento   = trim($_POST['iddocumento']);
		
		//VARIABLE QUE MANEJA CUANDO SE LE DA RESPUESTA A UN DOCUMENTO
		$idrespuesta   = trim($_POST['idrespuesta']);
		
		$tipodocumento = trim($_POST['tipodocumento']);
		$ndocumento    = trim($_POST['ndocumento']);
		$dirigidoa     = trim($_POST['dirigidoa']);
		$nombre        = trim($_POST['nombre']);
		$cargo         = trim($_POST['cargo']);
		$dependencia   = trim($_POST['dependencia']);
		$fechag        = trim($_POST['fechag']);
		$asunto        = utf8_encode(trim($_POST['asunto']));
		$detalleds     = utf8_encode(trim($_POST['detalleds']));
			
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Respuesta de Documento";
		
		$accion  = "Registra una ".$tiporegistro." En el Sistema (SIGDOC), ID DOCUMENTO: ".$idrespuesta;
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
	 
				$this->db->exec("INSERT INTO sigdoc_documentos_internos (idusuario,idusuarioedita,identrada,idtipodocumento,numero,dirigidoa,nombre,cargo,dependencia,
								 fechageneracion,fechaedita,asunto,contenido)
								 VALUES ('$idusuario',0,'$idrespuesta','$tipodocumento','$ndocumento','$dirigidoa','$nombre','$cargo','$dependencia','$fechag','0000-00-00',
								 '$asunto','$detalleds')");
					
				$this->db->exec("UPDATE sigdoc_pa_consecutivo SET contador = '$consecutivodocumento' WHERE idtipodocumento = '$tipodocumento'");
				
				
				$this->db->exec("UPDATE sigdoc_documentos_entrantes SET fecharespuesta = '$fechalog',idusuarioedita = '$idusuario',fechaedita = '$fechalog'
								 WHERE id = '$idrespuesta'");
								 
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=2b"</script>';
		}
		
		
  	}
	
	public function get_datos_documentos(){
	
		$id     = trim($_GET['id']);
	
		$listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_internos WHERE id = '$id'");

  		$listar->execute();

  		return $listar;
	
	}
	
	//*******************************************************************************************************************************************************
	//PARA DOCUMENTOS ENTRANTES
	
	public function get_documentos_entrantes_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
											 FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 ORDER BY rds.id DESC");*/
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
											 pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											 FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 ORDER BY rds.id DESC");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			
	
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (rds.fecha >= '$fechad' AND rds.fecha <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND rds.idtipodocumento = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
		
				$filtro2 = " AND rds.numero = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND rds.remitente LIKE '%$datox3%' ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND rds.asunto LIKE '%$datox4%' ";
			
			}
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND rds.id = '$datox5' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtrof;
			
			//echo $filtrox;
			
		  
			/*$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto
											 FROM (sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");*/
											 
											 
			$listar    = $this->db->prepare("SELECT rds.id,rds.fecha,rds.fecharespuesta,rds.hora,rds.remitente,td.nombre_tipo_documento,rds.numero,rds.asunto,
											 pu.empleado AS registra,pub.empleado AS modifica,rds.fechaedita
											 FROM (((sigdoc_documentos_entrantes rds LEFT JOIN sigdoc_pa_tipodocumento td ON rds.idtipodocumento = td.id)
											 LEFT JOIN pa_usuario pu ON rds.idusuario = pu.id)
											 LEFT JOIN pa_usuario pub ON rds.idusuarioedita = pub.id)
											 WHERE rds.id >= '1'" .$filtrox. " 
											 ORDER BY rds.id DESC");
		}

  		$listar->execute();

  		return $listar;
	
  	}
	
	public function registrar_documentos_entrantes(){
	
		//VARIABLE QUE MANEJA EL INSERT O UPDATE DE UN NUEVO DOCUMENTO ENTRANTE
		$iddocumento   = trim($_POST['iddocumento']);

		
		//SE OBTIENEN LOS DATOS
		$idusuario     = $_SESSION['idUsuario'];
		
		$fechae        = trim($_POST['fechae']);
		$horae         = trim($_POST['horae']);
		$remitente     = utf8_encode(trim($_POST['remitente']));
		$tipodocumento = trim($_POST['tipodocumento']);
		$numerodoce    = trim($_POST['numerodoce']);
		$asunto        = utf8_encode(trim($_POST['asunto']));
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new sigdocModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Entrada de Documento";
		
		if( empty($iddocumento) ){
			$accion  = "Registra una Nueva ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES";
		}
		else{
			$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				if( empty($iddocumento) ){
				
					$this->db->exec("INSERT INTO sigdoc_documentos_entrantes (idusuario,idusuarioedita,fecha,fecharespuesta,fechaedita,hora,remitente,idtipodocumento,
									 numero,asunto)
									 VALUES ('$idusuario',0,'$fechae','0000-00-00','0000-00-00','$horae','$remitente','$tipodocumento','$numerodoce','$asunto')");
				}
				else{
					
					$this->db->exec("UPDATE sigdoc_documentos_entrantes SET remitente = '$remitente',numero = '$numerodoce',asunto = '$asunto',
									 idusuarioedita = '$idusuario',fechaedita = '$fechalog'
									 WHERE id = '$iddocumento'");
								 
				}
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=sigdoc&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	
	public function get_datos_documentos_entrantes(){
	
		$id     = trim($_GET['id']);
	
		$listar = $this->db->prepare("SELECT * FROM sigdoc_documentos_entrantes WHERE id = '$id'");

  		$listar->execute();

  		return $listar;
	
	}
	
	
	//**************** FUNCIONES ESPECIALES **********************************************
	
	//-------------------------------------------------------------------------------
	//PARA CALCULAR LOS DIAS DE RESPUESTA DE UN DOCUMENTO
	
	public function Dias_Respuesta($fecharegistro,$fecharespuesta){
	
				
		require_once('funciones/Festivos.php');
		
		$dias_diferencia = 0;
		
		if($fecharespuesta != "0000-00-00"){
		
			
			//FECHA INCIAL
			$inicio    = new DateTime($fecharegistro);
			//Un día es P1D,Dos días es P2D, 
			//es decir que si la fecha inicial es 2015-05-19 y la final es 2015-05-27
			//el intervalos iria de 2015-05-19 2015-05-20 2015-05-21 2015-05-22 2015-05-23 2015-05-24 2015-05-25 2015-05-26
			$intervalo = new DateInterval('P1D');
			//FECHA FINAL
            $fin       = new DateTime($fecharespuesta);
			//CREO EL PERIODO SEGUN LOS DATOS ANTERIORES
			$periodo   = new DatePeriod($inicio,$intervalo,$fin);
			
			foreach ($periodo as $fecha) {
			
    			//echo $fecha->format('Y-m-d')."\n";
				//$dias_diferencia = $dias_diferencia." ".$fecha->format('Y-m-d')."\n";
				
				//OBTENGO FECHA A FECHA, DESDE LA INCIAL A LA FINAL Y CAPTURO SU AÑO,MES,DIA
				$fechaperiodo = explode("-",$fecha->format('Y-m-d'));
				$y            = trim($fechaperiodo[0]);
			    $m            = trim($fechaperiodo[1]);
			    $d            = trim($fechaperiodo[2]);
				//OBTENGO EL DIA SEGUN LA FECHA PASADA A $fechaperiodo CON SUS PARTES AÑO,MES,DIA
				$date         = date('D', mktime(0,0,0,$m,$d,$y));
				
				//PARA DIAS FESTIVOS, SE INSTANCIA LA CLASE Y SE LLAMA LA FUNCION PARA SABER SI UN DIA ES FESTIVO
				$dias_festivos = new festivos($y);
				$esfestivo     = $dias_festivos->esFestivo($d,$m);
				
				//SE REALIZA LA PREGUNTA SI ES SABADO, DOMINGO O FESTIVO
				//PARA NO INCREMENTAR $dias_diferencia
				if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
			
					$bandera = 0;
				}
				else{
				
					$dias_diferencia = $dias_diferencia + 1;
				}
				
				//$dias_diferencia = $dias_diferencia." ".$date."\n";
			}
	
		}
		else{
			
			$dias_diferencia = "-";
			
		}
		
		return $dias_diferencia;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
	

	
	public function registrar_proceso(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario       = $_SESSION['idUsuario'];
		
		$radicadox       = trim($_POST['radicadox']);
		
		$juzgadoorigen   = explode("-",trim($_POST['juzgadoorigen']));
		$idjuzgadoorigen = $juzgadoorigen[0];
		
		$idclasejuzgado = trim($_POST['idclasejuzgado']);
		$idclaseproceso = trim($_POST['idclaseproceso']);
		$iddepartamento = trim($_POST['iddepartamento']);
		$idmunicipio    = trim($_POST['idmunicipio']);
		
		//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
		//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
		/*$idclasejuzgado = substr($radicadox, 5, 4);
		$iddepartamento = substr($radicadox, 1, 2);
		$idmunicipio    = substr($radicadox, 1, 5);*/
		
		$datospartes      = trim($_POST['datospartes']);
		
		$datosadicionales = trim($_POST['datosadicionales']);
		
		$modelo     = new signotModel();
		
		//PARA DETERMINAR SI UN CLASE PARTE ESTA EN EL VECTOR DONDE SE LE GENERA UNA CITACION
		//SE USA LA MISMA FUNCION DE get_lista_usuario_acciones, PARA NO CREAR OTRA FUNCION
		$campos               = 'idtabla';
		$nombrelista          = 'pa_modulo_acciones';
		$idaccion			  = '1';
		$campoordenar         = 'id';
		$datosmoduloacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
		$idacciones           = $datosmoduloacciones->fetch();
		$modulosacciones	  = explode("////",$idacciones[idtabla]);
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Proceso";
		
		if( empty($iddocumento) ){
			$accion  = "Registra un Nuevo ".$tiporegistro." En el Sistema (SIGNOT), PROCESO: ".$radicadox;
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				/*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
								 VALUES ('$cedula','$datospartes')");*/
								 
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				$this->db->exec("INSERT INTO signot_proceso (radicado,fecharegistro,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita,iddevolucion)
								 VALUES ('$radicadox','$fechalog','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio','$idusuario',0,0)");
								
				
			
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
				$lastIdProceso  = $this->db->lastInsertId();
				
 
				//******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
				//75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
		
				//1 EXPLODE
				$datospartes_1 = explode("******",$datospartes); 
				$longitud_1    = count($datospartes_1);
				$i             = 1;
				
				$longpartes = $longitud_1 - 1;
				$anotacion = "SE REALIZA EL REGISTRO DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog.
				             " CON NUMERO DE PARTES: ".$longpartes.", ID DEL PROCESO: ".$lastIdProceso;
				
				$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							     VALUES ('$lastIdProceso','$idusuario','$fechalog','$horalog','$anotacion')"); 
				
				while($i < $longitud_1){
					
					//2 EXPLODE
					$datospartes_2 = explode("//////",$datospartes_1[$i]);
					
					
					$cedulaparte  = $datospartes_2[0];
					$nombreparte  = $datospartes_2[1];
					
					$direccion    = $datospartes_2[2];
					$telefono     = $datospartes_2[3];
					
					$idclaseparte   = explode("-",$datospartes_2[4]);
					$idclaseparte_2 = $idclaseparte[0];
					
					//SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
					//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
					//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte
					//if($idclaseparte_2 == 2){
					/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
					
						$fecharegistroclase = $datospartes_2[7];
						$fechaautoclase     = $datospartes_2[8];
						
						$idauto             = explode("-",$datospartes_2[9]);
						$idauto_2           = $idauto[0];
					}*/
					
					$iddepartamento   = explode("-",$datospartes_2[5]);
					$iddepartamento_2 = $iddepartamento[0];
					
					$idmunicipio      = explode("-",$datospartes_2[6]);
					$idmunicipio_2    = $idmunicipio[0];
					
					//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parte
					//PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS
					$listar = $this->db->prepare("SELECT * FROM signot_parte WHERE cedula = '$cedulaparte'");
		
					$listar->execute();
						
					$resultado = $listar->rowCount();
					
					if(!$resultado){//NO EXISTE PARTE
							
						//$iddocumento = 0;
						
						$this->db->exec("INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
								         VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)");
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
						$lastIdParte  = $this->db->lastInsertId();
				
						
						//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
						//EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
						//YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
						$listar = $this->db->prepare("SELECT * FROM signot_parteproceso 
						                              WHERE idproceso = '$lastIdProceso' AND idparte = '$lastIdParte' AND idclaseparte = '$idclaseparte_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
				
							$this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
								             VALUES ('$lastIdProceso','$lastIdParte','$idclaseparte_2','$idusuario')");
						}
						
						
						
						//IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
						//PARA NO REGISTRARLA NUEVAMENTE
						$listar = $this->db->prepare("SELECT * FROM signot_direccion 
						                              WHERE idparte = '$lastIdParte' AND idproceso = '$lastIdProceso'
													  AND telefono = '$telefono' AND direccion = '$direccion'
													  AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
						
							$this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
								         	 VALUES ('$lastIdParte','$lastIdProceso','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
						}
						
						
						////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
						//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
						//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
						//CON EL PROCESO NO SE CREA OTRO
						//NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
						//SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
						//if($idclaseparte_2 == 2){
						/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
						
							
							$listar = $this->db->prepare("SELECT * FROM signot_auto_parte 
						                                  WHERE idparte = '$lastIdParte' AND idproceso = '$lastIdProceso'");
		
							$listar->execute();
								
							$resultado = $listar->rowCount();
							
							if(!$resultado){//NO EXISTE REGISTRO
						
								$this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
								         	     VALUES ('$lastIdParte','$lastIdProceso','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
												 
							}
						
						}*/
						
						
						
					}
					else{//EXISTE PARTE
						
						$iddocumento = 1;
						$fila        = $listar->fetch();
						$idparte     = $fila[id];
						
						$this->db->exec("UPDATE signot_parte SET nombre = '$nombreparte',datosadicionales = '$datosadicionales',idusuarioedita = '$idusuario' WHERE cedula = '$cedulaparte'");
						
						
						//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
						//EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
						//YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
						$listar = $this->db->prepare("SELECT * FROM signot_parteproceso 
						                              WHERE idproceso = '$lastIdProceso' AND idparte = '$idparte' AND idclaseparte = '$idclaseparte_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
				
							$this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
								             VALUES ('$lastIdProceso','$idparte','$idclaseparte_2','$idusuario')");
						}
						
						
						
						//IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
						//PARA NO REGISTRARLA NUEVAMENTE
						$listar = $this->db->prepare("SELECT * FROM signot_direccion 
						                              WHERE idparte = '$idparte' AND idproceso = '$lastIdProceso'
													  AND telefono = '$telefono' AND direccion = '$direccion'
													  AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
						
							$this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
								             VALUES ('$idparte','$lastIdProceso','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
						}
						
						
						
						
						////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
					 	//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
						//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
						//CON EL PROCESO NO SE CREA OTRO
						//NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
						//SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
						//if($idclaseparte_2 == 2){
						/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
						
							
							$listar = $this->db->prepare("SELECT * FROM signot_auto_parte 
						                                  WHERE idparte = '$idparte' AND idproceso = '$lastIdProceso'");
		
							$listar->execute();
								
							$resultado = $listar->rowCount();
							
							if(!$resultado){//NO EXISTE REGISTRO
						
								$this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
								         	     VALUES ('$idparte','$lastIdProceso','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
												 
							}
						
						}*/
						
			
					}
					
					
					$i = $i + 1;
				
				}
								 
								 
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	/*echo "iddocumento:".$iddocumento." id parte:".$idparte." Fallo: " . $e->getMessage();*/
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=4b"</script>';
		}
		
		
  	}
	

	public function modificar_proceso(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario       = $_SESSION['idUsuario'];
		
		$valoridradicado = trim($_POST['idradicado']);
		
		$datospartes     = trim($_POST['datospartes']);
		
		
		$modelo     = new signotModel();
		
		//PARA DETERMINAR SI UN CLASE PARTE ESTA EN EL VECTOR DONDE SE LE GENERA UNA CITACION
		//SE USA LA MISMA FUNCION DE get_lista_usuario_acciones, PARA NO CREAR OTRA FUNCION
		$campos               = 'idtabla';
		$nombrelista          = 'pa_modulo_acciones';
		$idaccion			  = '1';
		$campoordenar         = 'id';
		$datosmoduloacciones  = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
		$idacciones           = $datosmoduloacciones->fetch();
		$modulosacciones	  = explode("////",$idacciones[idtabla]);
		
		$datosadicionales = trim($_POST['datosadicionales']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Proceso";
		
		if( empty($iddocumento) ){
			$accion  = "Modifica un ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado;
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID DOCUMENTO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				/*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
								 VALUES ('$cedula','$datospartes')");*/
								 
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				/*$this->db->exec("INSERT INTO signot_proceso (radicado,idjuzgadoorigen,idclasejuzgado,idclaseproceso,iddepartamento,idmunicipio)
								 VALUES ('$radicadox','$idjuzgadoorigen','$idclasejuzgado','$idclaseproceso','$iddepartamento','$idmunicipio')");*/
								 
				
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
				//$lastIdProceso  = $this->db->lastInsertId();
								 
				//******75088165//////Jorge Andres Valencia//////Cr 21 # 46 A 82//////8855934//////1-DEMANDANTE//////17-Caldas//////17001-MANIZALES******
				//75095585//////Andres Grajales//////Cr 213 # 748 B 434//////8875632//////1-DEMANDANTE//////13-Bolivar//////13001-CARTAGENA
		
				//1 EXPLODE
				$datospartes_1 = explode("******",$datospartes); 
				$longitud_1    = count($datospartes_1);
				$i             = 1;
				
				$longpartes = $longitud_1 - 1;
				$anotacion = "SE REALIZA LA MODIFICACION DEL PROCESO EN EL SISTEMA, FECHA: ".$fechalog." "."a las: ".$horalog.
				             " CON NUMERO DE PARTES: ".$longpartes.", ID DEL PROCESO: ".$valoridradicado;
				
				$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							     VALUES ('$valoridradicado','$idusuario','$fechalog','$horalog','$anotacion')");
				
				while($i < $longitud_1){
					
					//2 EXPLODE
					$datospartes_2 = explode("//////",$datospartes_1[$i]);
					
					
					$cedulaparte  = $datospartes_2[0];
					$nombreparte  = $datospartes_2[1];
					
					$direccion    = $datospartes_2[2];
					$telefono     = $datospartes_2[3];
					
					$idclaseparte   = explode("-",$datospartes_2[4]);
					$idclaseparte_2 = $idclaseparte[0];
					
					
					//SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
					//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
					//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte
					//if($idclaseparte_2 == 2){
					/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
					
						$fecharegistroclase = $datospartes_2[7];
						$fechaautoclase     = $datospartes_2[8];
						
						$idauto             = explode("-",$datospartes_2[9]);
						$idauto_2           = $idauto[0];
					}*/
					
					
					$iddepartamento   = explode("-",$datospartes_2[5]);
					$iddepartamento_2 = $iddepartamento[0];
					
					$idmunicipio      = explode("-",$datospartes_2[6]);
					$idmunicipio_2    = $idmunicipio[0];
					
					//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parte
					//PARA NO VOLVER A REGISTRAR, SI NO ACTUALIZAR SUS DATOS
					$listar = $this->db->prepare("SELECT * FROM signot_parte WHERE cedula = '$cedulaparte'");
		
					$listar->execute();
						
					$resultado = $listar->rowCount();
					
					if(!$resultado){//NO EXISTE PARTE
							
						//$iddocumento = 0;
						
						$this->db->exec("INSERT INTO signot_parte (cedula,nombre,datosadicionales,idusuarioregistra,idusuarioedita)
								         VALUES ('$cedulaparte','$nombreparte','$datosadicionales','$idusuario',0)");
										 
						
						
						//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA signot_proceso
						$lastIdParte  = $this->db->lastInsertId();
				
						
						//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
						//EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
						//YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
						$listar = $this->db->prepare("SELECT * FROM signot_parteproceso 
						                              WHERE idproceso = '$valoridradicado' AND idparte = '$lastIdParte' AND idclaseparte = '$idclaseparte_2'");
													  
						
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
				
							$this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
								             VALUES ('$valoridradicado','$lastIdParte','$idclaseparte_2','$idusuario')");
						}
						
						
						
						//IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion, CON EL PROCESO ACTUAL
						//PARA NO REGISTRARLA NUEVAMENTE
						$listar = $this->db->prepare("SELECT * FROM signot_direccion 
						                              WHERE idparte = '$lastIdParte' AND idproceso = '$valoridradicado' 
													  AND telefono = '$telefono' AND direccion = '$direccion'
													  AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
						
							$this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
								         	 VALUES ('$lastIdParte','$valoridradicado','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
											 
							
						}
						
						
						////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
						//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
						//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
						//CON EL PROCESO NO SE CREA OTRO
						//NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
						//SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
						//if($idclaseparte_2 == 2){
						/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
						
							
							$listar = $this->db->prepare("SELECT * FROM signot_auto_parte 
						                                  WHERE idparte = '$lastIdParte' AND idproceso = '$valoridradicado'");
		
							$listar->execute();
								
							$resultado = $listar->rowCount();
							
							if(!$resultado){//NO EXISTE REGISTRO
						
								$this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
								         	     VALUES ('$lastIdParte','$valoridradicado','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
												 
								
												 
							}
						
						}*/
						
				
					}
					else{//EXISTE PARTE
						
						//$iddocumento = 1;
						$fila        = $listar->fetch();
						$idparte     = $fila[id];
						
						$this->db->exec("UPDATE signot_parte SET nombre = '$nombreparte',datosadicionales = '$datosadicionales', idusuarioedita = '$idusuario' WHERE cedula = '$cedulaparte'");
						
						
						//IDENTIFICAMOS QUE UNA PARTE YA EXISTA EN LA TABLA signot_parteproceso
						//EN EL MISMO PROCESO CON IGUAL CLASE DE PARTE (DEMANDANTE, DEMANDADO ETC....)
						//YA QUE SI EXISTE NO SE ACTUALIZA, SOLO SE REGISTRA SI NO EXISTE
						$listar = $this->db->prepare("SELECT * FROM signot_parteproceso 
						                              WHERE idproceso = '$valoridradicado' AND idparte = '$idparte' AND idclaseparte = '$idclaseparte_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
				
							$this->db->exec("INSERT INTO signot_parteproceso (idproceso,idparte,idclaseparte,idusuarioregistra)
								             VALUES ('$valoridradicado','$idparte','$idclaseparte_2','$idusuario')");
						}
						
						
						
						//IDENTIFICAMOS QUE UNA DIRECCION YA EXISTA EN LA TABLA signot_direccion
						//PARA NO REGISTRARLA NUEVAMENTE
						$listar = $this->db->prepare("SELECT * FROM signot_direccion 
						                              WHERE idparte = '$idparte' AND idproceso = '$valoridradicado'
													  AND telefono = '$telefono' AND direccion = '$direccion'
													  AND iddepartamento = '$iddepartamento_2' AND idmunicipio = '$idmunicipio_2'");
		
						$listar->execute();
						
						$resultado = $listar->rowCount();
						
						if(!$resultado){//NO EXISTE REGISTRO
						
							$this->db->exec("INSERT INTO signot_direccion (idparte,idproceso,telefono,direccion,iddepartamento,idmunicipio,idusuarioregistra,idusuarioedita)
								             VALUES ('$idparte','$valoridradicado','$telefono','$direccion','$iddepartamento_2','$idmunicipio_2','$idusuario',0)");
						}
						
						
						////SE PREGUNTA SI LA CLASE PARTE ESTA DENTRO DEL VECTOR DE PARTES PARA GENERAR CITACION Y ASIGNAR
						//LA FECHA REGISTRO, FECHA AUTO Y AUTO ANOTIFICAR
						//PARA CREAR UN REGISTRO EN LA TABLA signot_auto_parte PARA CREAR UN AUTO, SI YA TIENE UN AUTO REGISTRADO
						//CON EL PROCESO NO SE CREA OTRO
						//NOTA: PARA NO AMARRAR QUE UNA PARTE TENGA UN SOLO TIPO DE AUTO EN UN PROCESO
						//SIMPLEMENTE SE APLICA EL INSERT SIN EL SELECT
						//if($idclaseparte_2 == 2){
						/*if ( in_array($idclaseparte_2,$modulosacciones) ) {
						
							
							$listar = $this->db->prepare("SELECT * FROM signot_auto_parte 
						                                  WHERE idparte = '$idparte' AND idproceso = '$valoridradicado'");
		
							$listar->execute();
								
							$resultado = $listar->rowCount();
							
							if(!$resultado){//NO EXISTE REGISTRO
						
								$this->db->exec("INSERT INTO signot_auto_parte (idparte,idproceso,idauto,fecharegistroauto,fechaauto,idusuarioregistra,idusuarioedita,descorrecion)
								         	     VALUES ('$idparte','$valoridradicado','$idauto_2','$fecharegistroclase','$fechaautoclase','$idusuario',0,'')");
												 
							}
						
						}*/
						
						
						
						
					}
					
					
					$i = $i + 1;
				
				}
								 
								 
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo $idusuario."-".$valoridradicado." Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=6b"</script>';
		}
		
		
  	}
	
	public function modificar_proceso_2(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario       = $_SESSION['idUsuario'];
		
		//VALOR DEL ID PROCESO A MODIFICAR
		$valoridradicado = trim($_POST['idradicado']);
		
		$radicadox3       = trim($_POST['radicadox3']);
		
		//NUEVO RADICADO SI SE CUENTA CON LOS 23 CARACTERES
		//QUE DEBE CONTENER, ES DECIR SE ESTA ACTUALIZANDO EL RADICADO
		$radicadox       = trim($_POST['radicadox']);
		
		$juzgadoorigen   = explode("-",trim($_POST['juzgadoorigen']));
		$idjuzgadoorigen = $juzgadoorigen[0];
		
		$idclaseproceso  = trim($_POST['idclaseproceso']);
		
		$observacionx    = trim($_POST['observacionx']);
		$desobservacionx = "Radicado que se Reemplaza: ".$radicadox3." Por: ".$radicadox." y se le Aplica la Siguinete Observacion: ".$observacionx;
		
		/*$idclasejuzgado = trim($_POST['idclasejuzgado']);
		$iddepartamento = trim($_POST['iddepartamento']);
		$idmunicipio    = trim($_POST['idmunicipio']);*/
		
		//SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
		if(strlen($radicadox) == 23){
		
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			$idclasejuzgado = substr($radicadox, 5, 4);
			$iddepartamento = substr($radicadox, 0, 2);
			$idmunicipio    = substr($radicadox, 0, 5);
			
			//SE REALIZA ESTA PREGUNTA YA QUE PUEDE QUE SE ENVIE CLASE DE PROCESO O NO
			if ( !empty($idclaseproceso) ) {
			
				$filtro1 = "idclaseproceso = '$idclaseproceso',";
			
			}
			
		}
		else{
			
			//CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
			//PIDO QUE SE DEFINA EL NUEVO RADICADO
			
			/*$idclasejuzgado = substr($radicadox3, 5, 4);
			$iddepartamento = substr($radicadox3, 0, 2);
			$idmunicipio    = substr($radicadox3, 0, 5);
			
			//SE REALIZA ESTA PREGUNTA YA QUE PUEDE QUE SE ENVIE CLASE DE PROCESO O NO
			if ( !empty($idclaseproceso) ) {
			
				$filtro1 = "idclaseproceso = '$idclaseproceso',";
			
			}*/
			
		}
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Proceso";
		
		if( empty($iddocumento) ){
			
			//SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
			if(strlen($radicadox) == 23){
			
				$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado." PROCESO: ".$radicadox3." POR ".$radicadox;
			}
			else{
			
				//CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
				//PIDO QUE SE DEFINA EL NUEVO RADICADO
					
				//$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$valoridradicado." PROCESO: ".$radicadox3;
			}
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				/*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
								 VALUES ('$cedula','$datospartes')");*/
								 
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				
				//SE REALIZA ESTA PREGUNTA YA QUE SI LA LONGITUD ES 23, SE INDENTIFICA QUE SE ESTA CAMBIANDO EL NUMERO DE RADICADO
				if(strlen($radicadox) == 23){
				
				
				
					$this->db->exec("UPDATE signot_proceso SET 
					                 radicado = '$radicadox', idjuzgadoorigen = '$idjuzgadoorigen',
									 idclasejuzgado = '$idclasejuzgado', ".$filtro1 . "
									 iddepartamento = '$iddepartamento',idmunicipio = '$idmunicipio',
									 idusuarioedita = '$idusuario'
					                 WHERE id = '$valoridradicado'");
				
				}
				else{
				
					//CIERRO ESTO YA QUE SIMEPRE VA HACER EL RADICADO DE 23 POR QUE EN LA VISTA SIGNOT_MODIFICAR2_PROCESO.PHP
					//PIDO QUE SE DEFINA EL NUEVO RADICADO
					
					/*$this->db->exec("UPDATE signot_proceso SET ". 
					                 $filtro1. 
									 " iddepartamento = '$iddepartamento',idmunicipio = '$idmunicipio',
									 idusuarioedita = '$idusuario'
					                 WHERE id = '$valoridradicado'");*/
				
				}
				
				$this->db->exec("INSERT INTO signot_proceso_observacion (idradicado,exradicado,observacion,fechaob,idusuarioregistra) 
				                 VALUES ('$valoridradicado','$radicadox3','$desobservacionx','$fechalog','$idusuario')");
				
				
								 
				
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=5"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=5b"</script>';
		}
		
		
  	}
	
	public function modificar_parte(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario       = $_SESSION['idUsuario'];
		
		//VALOR DEL ID PROCESO A MODIFICAR
		$idparteproceso   = trim($_POST['idparteproceso']);
		$documentox       = trim($_POST['documento2x']);
		$nombrex          = trim($_POST['nombrex']);
		$datosadicionales = trim($_POST['datosadicionales']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Parte";
		
		if( empty($iddocumento) ){
			
			if($documentox == trim($_POST['documentox'])){
				
				$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PARTE: ".$idparteproceso." CEDULA: ".$documentox." - NOMBRE PARTE: ".$nombrex;
			}
			else{
			
				$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID PARTE: ".$idparteproceso." CEDULA: ".trim($_POST['documentox'])." POR ".$documentox." - NOMBRE PARTE: ".$nombrex;
			}
			
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				/*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
								 VALUES ('$cedula','$datospartes')");*/
								 
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				
				$this->db->exec("UPDATE signot_parte SET 
					             cedula = '$documentox', nombre = '$nombrex',datosadicionales = '$datosadicionales',
								 idusuarioedita = '$idusuario'
					             WHERE id = '$idparteproceso'");
				
				
				 
				
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7b"</script>';
		}
		
		
  	}
	
	public function modificar_direccion(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario       = $_SESSION['idUsuario'];
		
		//VALOR DEL ID PROCESO A MODIFICAR
		$iddireccionx = trim($_POST['iddireccionx']);
			
		$documentox   = trim($_POST['documentox']);
		$nombrex      = trim($_POST['nombrex']);
		$telefonox    = trim($_POST['telefonox']);
		$direccionx   = trim($_POST['direccionx']);
		$departamento = trim($_POST['departamento']);
		$municipio    = trim($_POST['municipio']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Direccion";
		
		if( empty($iddocumento) ){
			
			$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID DIRECCION: ".$iddireccionx;
			
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				/*$this->db->exec("INSERT INTO signot_prueba (cedula,datos)
								 VALUES ('$cedula','$datospartes')");*/
								 
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				
				$this->db->exec("UPDATE signot_direccion SET 
					             telefono = '$telefonox',direccion = '$direccionx',
								 iddepartamento = '$departamento',idmunicipio = '$municipio',
								 idusuarioedita = '$idusuario'
					             WHERE id = '$iddireccionx'");
				
				
				 
				
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=7b"</script>';
		}
		
		
  	}
	
	
	public function corregir_notificacion(){
	
		$modelo     = new signotModel();
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		//VALOR DEL ID PROCESO A MODIFICAR
		$idautox     = trim($_POST['idautox']);
			
		$autox       = trim($_POST['autox']);
		
		$nombrelista        = 'pa_tipodocumento';
		$campoordenar       = 'nombre_tipo_documento';
		$filtro             = "WHERE id IN(".$autox.")";
		$formaordenar       = 'ASC';
		$datostipodocumento = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
		$row                = $datostipodocumento->fetch();
		$anotacion          = "SE CORRIGE TIPO DOCUMENTO: ".$row[nombre_tipo_documento];
		
		
		$fechaxau1   = trim($_POST['fechaxau1']);
		$fechaxau2   = trim($_POST['fechaxau2']);
		$fechaxau3   = trim($_POST['fechaxau3']);
		$correccionx = trim($_POST['correccion2x'])." ".trim($_POST['correccionx']);
		
		$idparte     = trim($_POST['idpartex']);
		$idproceso   = trim($_POST['idprocesox']);
		
		$nombrex     = trim($_POST['nombrex']);
		
		$dirigidoax  = trim($_POST['dirigidoax']);
		$direccionx  = trim($_POST['direccionx']);
		$ciudadx     = trim($_POST['ciudadx']);
		$ndocumentox = trim($_POST['ndocumentox']);
		$asuntox	 = trim($_POST['asuntox']);
		$partesx	 = trim($_POST['partesx']);
			
		//DATOS PARA EL REGISTRO DEL LOG
		
		//$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "Auto";
		
		if( empty($iddocumento) ){
			
			$accion  = "Modifica ".$tiporegistro." En el Sistema (SIGNOT), ID AUTO: ".$idautox;
			
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				 
				$this->db->exec("INSERT INTO documentos_internos (idparte,idradicado,idusuario,idusuarioedita,idtipodocumento,numero,dirigidoa,
				                 nombre,direccion,ciudad,
								 fechageneracion,fechaauto,fechaedita,asunto,contenido,partes,fechaautocorrige,descorrecion,idautocorrige)
							     VALUES ('$idparte','$idproceso','$idusuario',0,'$autox','$ndocumentox','$dirigidoax','$nombrex','$direccionx',
								 '$ciudadx','$fechaxau1','$fechaxau2','0000-00-00',
								 '$asuntox','X','$partesx','$fechaxau3','$correccionx','$idautox')");
								 
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA documentos_internos
				$lastId    = $this->db->lastInsertId();
				$anotacion = $anotacion.", ID DOCUMENTO NUEVO: ".$lastId.", CORRIGE ID DOCUMENTO: ".$idautox;
								  
				$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,anotacion)
							     VALUES ('$idproceso','$idusuario','$fechalog','$horalog','$anotacion')");
				
				//$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
				
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=8"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo $idparte."*****"."Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=8b"</script>';
		}
		
		
  	}
	
		
	public function registrar_anotacion(){
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario   = $_SESSION['idUsuario'];
		
		$idproceso       = trim($_POST['idproceso']);
		$idtipoanotacion = trim($_POST['destipoanotacion']);
		$anotacion       = trim($_POST['anotacion']);
			
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$modelo     = new signotModel();
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		
		
		$tiporegistro = "ANOTACION";
		
		if( empty($iddocumento) ){
			
			$accion  = "Registra Una Nueva ".$tiporegistro." En el Sistema (SIGNOT), ID PROCESO: ".$idproceso;
			
		}
		else{
			//$accion  = "Modifica una ".$tiporegistro." En el Sistema (SIGDOC) REGISTRO DE DOCUMENTOS ENTRANTES, ID PROCESO: ".$iddocumento;
		}
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 6;
		
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   		
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
				
				 
				$this->db->exec("INSERT INTO signot_proceso_anotacion (idradicado,idusuario,fecha,hora,idtipoanotacion,anotacion)
							     VALUES ('$idproceso','$idusuario','$fechalog','$horalog','$idtipoanotacion','$anotacion')");
								  
				
				
				//$this->db->exec("UPDATE pa_documento SET contador = '$consecutivo' WHERE id = '$documento'");
				
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo $idparte."*****"."Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=signot&action=mensajes&nombre=9b"</script>';
		}
		
		
  	}
	
	public function get_siglas($tipodocumento){
	
		$listar  = $this->db->prepare("SELECT d.sigla AS siglas,d.nombre_documento
									   FROM (pa_tipodocumento td INNER JOIN pa_documento d ON td.iddocumento = d.id)
									   WHERE td.id = '$tipodocumento'");

  		$listar->execute();

  		return $listar;

	}
	
	
	
	//------------------------------------MODULO ESTADISTICA (AQUI LAS FUNCIONES NUEVAS)------------------------------------------------------------------------------
	
	public function get_lista_reportes($idmodulo){
	
		$listar     = $this->db->prepare("SELECT * FROM estadistica_reportes WHERE idmodulo = '$idmodulo' ORDER BY desreporte");
	
  		$listar->execute();

  		return $listar;
	
	}
	
	
	//FUNCION PARA CORTAR UNA CADENA Y ESPECIFICAR CON PUNTOS QUE TIENE MAS TEXTO
	//SE CARTASEGUN EL VALOR  $length ASIGNADO
	public function getSubString($string, $length=NULL){
		
		//Si no se especifica la longitud por defecto es 50
		if ($length == NULL)
			$length = 50;
		//Primero eliminamos las etiquetas html y luego cortamos el string
		$stringDisplay = substr(strip_tags($string), 0, $length);
		//Si el texto es mayor que la longitud se agrega puntos suspensivos
		if (strlen(strip_tags($string)) > $length)
			$stringDisplay .= ' ...';
			
			
		return $stringDisplay;
  	}
	
	
	//MIGRAR TUTELA 7 DE JUNIO 2019
	public function migrar_tutela_NV(){
	
		
		$modelo = new caratulaModel();
	
		
		//SE OBTIENEN LOS DATOS
		$idusuario = $_SESSION['idUsuario'];
		
		$valorradicado   = trim($_GET['valorradicado']);
		$valorradicado_2 = substr($valorradicado, 0, 21);
		$valorradicado_3 = substr($valorradicado, 12, 4);
		$valorradicado_4 = substr($valorradicado, 16, 5);
		$valorradicado_5 = substr($valorradicado, 5, 2);
		$valorradicado_6 = substr($valorradicado, 7, 2);
		$valorradicado_7 = substr($valorradicado, 9, 3);
		
		
		//OBTENEMOS DEL RADICADO 17001610679920081111100
		//LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
		$departamento  = substr($valorradicado, 0, 2);
		$municipio     = substr($valorradicado, 0, 5);
		
	
		$datospartes   = trim($_GET['datospartesXX']);
		
		
		$horaregistro  = $modelo->get_hora_actual_24horas();
		
		
		
		//DATOS PARA EL REGISTRO DEL LOG
	
		$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
		

		$accion  = "Se realiza Migracion de Tutela: ".$valorradicado;
		
      	$detalle = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog = 1;
		

		$error_transaccion   = 0; //variable para detectar error
		
		//PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION
		$datos_PARTEX_PROCESO = $modelo->get_datos_PROCESO_MIGRAR($valorradicado);
									
		if($datos_PARTEX_PROCESO == 0){	
		
			
			if($valorradicado_7 == '001'){
				$idjuzgado = 15; 
			}
			
			if($valorradicado_7 == '002'){
				$idjuzgado = 16;
			}
			
			
			
			try {
			  
						
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
							
							
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
								 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");
												 
				
				
				$this->db->exec("INSERT INTO correspondencia_tutelas (radicado,idjuzgado,fecha,Tutela_Incidente) 
								 VALUES ('$valorradicado','$idjuzgado','$fechalog','Tutela')");					
								 
				
				//OBTENGO EL ULTIMO ID DEL ISNERT ANTERIOR
				$lastIdRadicado  = $this->db->lastInsertId(); 
					
				//PARTES
						 
							
				//1 EXPLODE
									
				$datospartes_1A = explode("******",$datospartes); 
				$longitud_1     = count($datospartes_1A);
				$i              = 0;
									
				while($i < $longitud_1 - 1){
										
					//2 EXPLODE
					$datospartes_1B = explode("//////",$datospartes_1A[$i]);
					
					$tipo         = trim($datospartes_1B[0]);			
					$docidentidad = utf8_decode( trim($datospartes_1B[1]) );
					$nombreparte  = utf8_decode( trim(strtoupper($datospartes_1B[2])) );
					
									
					//DEMANDANTE - ACCIONANTE
					if($tipo == '0001'){
					
						$docdemandante .= $docidentidad."/";
						$nomdemandante .= $nombreparte."/";
						
						$tipo_parte = "Accionante";
					
					}
					//DEMANDADO - ACCIONADO
					if($tipo == '0002'){
					
						$docdemandado .= $docidentidad."/";
						$nomdemandado .= $nombreparte."/";
						
						$tipo_parte = "Accionado";
					
					}
					
	
					
					$this->db->exec("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) 
									 VALUES ('$lastIdRadicado','$nombreparte','$tipo_parte')");				 
									 
						
											
					$i = $i + 1;
									
				}
				
				//QUITAR ULTIMO CARACTER DE LA CADENA
				//EJEMPLO:
				//JUAN SEBASTIAN - ALFONSO VANEGAS/
				//QUEDA
				//JUAN SEBASTIAN - ALFONSO VANEGAS
				$docdemandante = substr($docdemandante, 0, -1);
				$nomdemandante = substr($nomdemandante, 0, -1);
				
				$docdemandado = substr($docdemandado, 0, -1);
				$nomdemandado = substr($nomdemandado, 0, -1);
				
				
				$this->db->exec("INSERT INTO ubicacion_expediente (idusuario,fecha,fecharegistrosistema,piso,idjuzgado,
								 radicado,demandante,cedula_demandante,demandado,cedula_demandado,idclase_proceso) 
								 VALUES ('$idusuario','$fechalog','$fechalog',4,'$idjuzgado',
								 '$valorradicado','$nomdemandante','$docdemandante','$nomdemandado','$docdemandado',12)");
				
				
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
								
		
				echo '<script languaje="JavaScript"> 
							
							alert("PROCESO SE REALIZA CORRECTAMENTE");
										
					</script>';									 
									
				
							
						  
			} 
			catch (Exception $e) {
						
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
							
						
				echo '<script languaje="JavaScript"> 
									
							var ERROR = "'.$e->getMessage().'";
										
							alert("ERROR AL REALIZAR EL PROCESO: "+ERROR);
									
					</script>';
							
					//echo $i." Fallo: " . $e->getMessage();
							
			}
			
		}
		else{
		
			echo '<script languaje="JavaScript"> 
									
							
					alert("PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION");
									
				</script>';
		
		}
				
				
		
		
		
  	}
	
	public function get_datos_PROCESO_MIGRAR($valorradicado){
	
		
		$listar = $this->db->prepare("SELECT * FROM ubicacion_expediente
                                      WHERE radicado = '$valorradicado'");
								
					
		$listar->execute();
									
		$resultado = $listar->rowCount();
					
		if(!$resultado){
						
			return 0;
										 
		}
		else{
			
			return 1;
		}
		
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
	
	
	
	
}//FIN CLASE

?>