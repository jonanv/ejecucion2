<?php

class empleadosModel extends modelBase

{

	

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

      public function mensajes()

  {

      $condicion=$_GET['nombre'];
 	  
	  if($condicion==1)

	  {

	    $_SESSION['elemento'] = "El seguimiento ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=regseguimiento"</script>';
	     }
  
	   }

	 if($condicion==2)

	  {

	    $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   }

	 }
	  if($condicion==22)

	  {

	    $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   }
	   

	 }
	
     if($condicion==3)

	  {

	    $_SESSION['elemento'] = "El acta de recibido ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    
	       if($condicion==4)

	  {

	    $_SESSION['elemento'] = "El acta de entrega ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	   
	       if($condicion==5)

	  {

	    $_SESSION['elemento'] = "El acta ha sido modificada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	      if($condicion==6)

	  {

	    $_SESSION['elemento'] = "El informe ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    if($condicion==7)

	  {

	    $_SESSION['elemento'] = "El informe ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	        if($condicion==8)

	  {

	    $_SESSION['elemento'] = "El acta ha sido entregada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }  
	   
	   if($condicion==9){

	    	$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	   	 		print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   		}

	 	}
		
		if($condicion=='9b'){

	    	$_SESSION['elemento'] = "Error al Realizar el Registro";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	   	 		print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   		}

	 	}
		
 

  }	

  

  

  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogArchivo()

  {

  

	  $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
									FROM LOG AS logusuario
									INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
									WHERE logusuario.idtipolog=4
									ORDER BY logusuario.id DESC
									LIMIT 15");

	  $listar->execute();
	 return $listar;


   

  }	

  


  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados del área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleados()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idperfil=3 and idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }
  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados con el jef de área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleadosJefe()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }



/***********************************************************************************/

  /*---------------------------  Listar Ubicación Expedientes --------------------*/

  /***********************************************************************************/

public function listarUbicacion()

  {  

  $listar = $this->db->prepare("SELECT ubi.id, ubi.idusuario, ubi.fecha, ubi.radicado, ubi.piso,  est.nombre as estado, juz.nombre as juzgado, ubi.fechasalida, juzdes.nombre as juzgadodestino, ubi.fechadevolucion, ubi.posicion, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado, ubi.demandado FROM ubicacion_expediente ubi
  								INNER JOIN detalle_estado est ON (ubi.idestado = est.id)
								INNER JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
								LEFT JOIN  juzgado_destino juzdes ON (ubi.idjuzgadodestino = juzdes.id)
								ORDER BY ubi.fecha DESC LIMIT 30");

  $listar->execute();

  return $listar;
  }
  
 
  /***********************************************************************************/

  /*------------------------------  Filtro Ubicacion Expedientes  ---------------------------------*/

  /***********************************************************************************/

  public function FiltroIngresoSalida()

  {


$fechair				= $_GET['nombre16']; 
$fechafr				= $_GET['nombre17'];
$tipo					= $_GET['nombre11']; 
$usuario				= $_GET['nombre20'];


$f1=$f2=$f3="";



if($fechair!='')
{
$fechair = $fechair.' 00:00:00';
$fechafr = $fechafr.' 23:59:59';
$f1=" and (em.fecha >= '$fechair' and em.fecha<='$fechafr')";
}


if($tipo!=''){
 $f2=" AND em.tipo LIKE '%$tipo%'";
}

if($usuario!=''){
 $f3=" AND em.idusuario = '$usuario' ";
}

 $listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
                               FROM empleado_control em
                               LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)
                               WHERE  em.tipo LIKE '%$tipo%' ".$f3.$f1."  ORDER BY em.fecha");
   	  $listar->execute();
	  
	  return $listar; 

  } 
 
   /***********************************************************************************/

  /*------------------------------ Registrar Ingreso Salida --------------------------------*/

  /***********************************************************************************/

  /*public function registrarIngresoSalida2()
  {
	 $fecha = $_POST['fechaa']; 
	 $observaciones = $_POST['observaciones'];	
	 $estado = $_SESSION['ingreso'];
	 
	 date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; una nueva ubicación';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro una nueva ubicación ".$fechal." "."a las: ".$hora;
	  
	  if($estado==0)
	  {
		  $tipo='ingreso';		  
		  $registrar = $this->db->prepare("update pa_usuario set ingreso=1  where id=$idres");
		  $registrar->execute(); 
		  $_SESSION['ingreso']=1;
	  }
	  if($estado==1)
	  {
		  $tipo='salida';		 
		  $registrar = $this->db->prepare("update pa_usuario set ingreso=0 where id=$idres");

	  	  $registrar->execute();
		  $_SESSION['ingreso']=0; 
	  }
	  
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1; 
	  
	   $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	   $registrar = $this->db->prepare("INSERT INTO empleado_control (idusuario,fecha,observaciones,tipo )
		values ('$idres','$fechaa','$observaciones','$tipo')");

	  $registrar->execute(); 
	  
	  
	  $resultado = $registrar->rowCount();

	  
      if ($resultado)

      {			

     print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';

      } 
  }*/

  
  
  public function registrarIngresoSalida(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$idusuario    = $_SESSION['idUsuario'];
		$fechar1      = $_POST['fecha'];
		
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro = date('Y-m-d g:i');
		
		//$fechar       = explode(" ",trim($_POST['fecha']));
		$fechar       = explode(" ",$fecharegistro);
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		/*$estado = $_SESSION['ingreso'];
		
		if($estado == 0){
		
			$ingreso = 1;
			$tiporegistro = "ingreso";
		}
		if($estado == 1){
		
			$ingreso = 0;
			$tiporegistro = "salida";
		}*/
		
		$tiporegistro = trim($_POST['tiporegistro']);
		
		if($tiporegistro == "ENTRADA"){
			$ingreso = 1;
		}
		if($tiporegistro == "SALIDA"){
			$ingreso = 0;
		}
		
		$observacion  = trim($_POST['observaciones']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		$accion  = "Se Registra una Nueva ".$tiporegistro." En el Sistema de Registro de Entrada y Salida de Personal";
      	$detalle = $_SESSION['nombre']." "."Registra una Nueva ".$tiporegistro." ".$fecha." "."a las: ".$hora;
		$tipolog = 4;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   
				$this->db->exec("INSERT INTO empleado_control (idusuario,fecha,observaciones,tipo)
								 VALUES ('$idusuario','$fecharegistro','$observacion','$tiporegistro')");
								 
				$this->db->exec("UPDATE pa_usuario SET ingreso ='$ingreso' WHERE id = '$idusuario'");
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
		}
		
		
  	}
  
  
  
  
  
  
  
  
  
  
  
  


  /***********************************************************************************/

  /*-----------------------  Consultar Empleados Ingreso Salidas  --------------------*/

  /***********************************************************************************/

  public function listarIngresoSalida()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("SELECT em.idusuario, usu.empleado as usuario, em.fecha, em.observaciones, em.tipo
                                FROM empleado_control em
                                INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
								LIMIT 10");

  $listar->execute();

  return $listar;

  

  } 
    /***********************************************************************************/

  /*---------------------------  Listar usuarios --------------------*/

  /***********************************************************************************/

  public function listarUsuarios()

  {
  
  $listar = $this->db->prepare("SELECT id,empleado FROM pa_usuario order by empleado asc ");

  $listar->execute();

  return $listar;

  

  }
  
  //---------------------------------------------------------------------------------------------------------------------
 //NUEVAS FUNCIONES SOLICITAR PERMISOS Y APROBAR PERMISOS 8 DE JULIO DEL 2015 POR JORGE ANDRES VALENCIA OROZCO

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
  
  public function get_datos_usuarios(){
	
		$listar     = $this->db->prepare("SELECT * FROM pa_usuario ORDER BY empleado");

  		$listar->execute();

  		return $listar;
	
  }
  
  public function get_datos_usuario_sistema(){
	
		$idusuario  = $_SESSION['idUsuario'];
		
		$listar     = $this->db->prepare("SELECT ingreso,foto,empleado FROM pa_usuario WHERE id = '$idusuario'");

  		$listar->execute();

  		return $listar;
	
  }
  
  public function get_lista_permisos($identrada){
	
		//TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		//PARA CALCULAR EL TIEMPO ENTRE DOS HORAS
	
		//$idusuario  = $_SESSION['idUsuario'];
		

		if($identrada == 1){
			
			//SE REALIZA ESTE CAMBIO YA QUE SI SE PIDE UN PERMISO DIGAMOS DESDE LAS 10:00 AM HASTA LAS 4:00 PM OSEA 16:00 HORA MILITAR
			//EL SISTEMA NO DEBE TENER ENCUENTA LASDOS HORAS DEL MEDIO DIA, ENTONCES SIENDO EL CASO SE LE RESTA DOS HORAS
			
			/*$listar     = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										      ORDER BY ep.id DESC LIMIT 10");*/
											  
			$listar     = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.rutaarchivo,ep.estado,

											  CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id)
												ORDER BY ep.id DESC LIMIT 10");
											  
		}
		if($identrada == 2){
		
			$filtrox;
			
			$filtro1;
			$filtro2;
			$filtro3;
			
			$usuario = trim($_GET['dato_1b']);
			$fechad  = trim($_GET['dato_2b']);
			$fechah  = trim($_GET['dato_3b']);
			$estado  = trim($_GET['dato_4b']);
			
			
			if ( !empty($usuario) ) {
			
				$filtro1 = " AND ep.idusuario = '$usuario' ";
			
			}
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtro2 = " AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') ";
				
			
			}
			//PREGUNTO $estado != '', YA QUE LA FUNCION empty SI EL VALOR ES CERO ASUME QUE ES UN VALOR VACIO
			//Y NO ENTRA AL IF, OCCASIONANDO ESTO NO ARMAR EL FILTRO $filtro3
			if ( $estado != '') {
			
				
				$filtro3 = " AND ep.estado = '$estado' ";
			
			}
			
		
			$filtrox = $filtro1." ".$filtro2." ".$filtro3;
			
			//echo $filtrox;
			
			
			
			//SE COLOCA ep.id >= '1' PARA QUE LOS FILTROS ANTERIORES EMPIEZEN CON EL (AND) Y NO SE TENGA QUE DEFINIR
			//CUAL DE LOS FILTROS VA PRIMERO SI NO SE DEFINE ALGUNO YA QUE QUEDARIA ALGO COMO WHERE AND FILTRO, 
			//Y YA QUE EL CAMPO ep.id ES UN VALOR AUTONUMERICO QUE EMPIEZA EN 1 LA PREGUNTA ep.id >= '1' 
			//SIEMPRE VA A CONCORDAR MAS EL FILTRO QUE SE ASIGNE.
			/*$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");*/
											 
											 
			$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.rutaarchivo,ep.estado,

											  CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										        WHERE ep.id >= '1'" .$filtrox. " ORDER BY ep.id DESC");
		
			
			
			/*$sql= "SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.id >= '1'" .$filtrox. " 
											 ORDER BY ep.id DESC";
											 
			echo $sql;*/
											
			
		}
		
		

  		$listar->execute();

  		return $listar;
	
  }
  
  
  public function get_entrada_salida_usuario($identrada){
	
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
			$listar     = $this->db->prepare("SELECT * FROM empleado_control WHERE idusuario = '$idusuario' 
			                                  ORDER BY id DESC LIMIT 10");
		}
		if($identrada == 2){
			
			//$datos_filtro = explode("//////////",trim($_GET['datos_filtro']));
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
		
			$listar    = $this->db->prepare("SELECT * FROM empleado_control
										     WHERE idusuario = '$idusuario' AND (DATE(fecha) >= '$fechad' AND DATE(fecha) <= '$fechah') 
										     ORDER BY id DESC");
		}

  		$listar->execute();

  		return $listar;
	
  	}
  
  public function get_permisos_usuario($identrada){
	
		//TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		//PARA CALCULAR EL TIEMPO ENTRE DOS HORAS
		
		//SE REALIZA ESTE CAMBIO YA QUE SI SE PIDE UN PERMISO DIGAMOS DESDE LAS 10:00 AM HASTA LAS 4:00 PM OSEA 16:00 HORA MILITAR
	   //EL SISTEMA NO DEBE TENER ENCUENTA LASDOS HORAS DEL MEDIO DIA, ENTONCES SIENDO EL CASO SE LE RESTA DOS HORAS
	
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			/*$listar     = $this->db->prepare("SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										      WHERE ep.idusuario = '$idusuario' ORDER BY ep.id DESC LIMIT 5");*/
											  
			/*$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                      FROM empleado_permiso ep  
										      WHERE ep.idusuario = '$idusuario' ORDER BY ep.id DESC LIMIT 5");*/
											  
											  
			
			$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.rutaarchivo,ep.estado,

												CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM empleado_permiso ep 
												WHERE ep.idusuario = '$idusuario'
												ORDER BY ep.id DESC LIMIT 5");
			
			
		}
		if($identrada == 2){
			
			//$datos_filtro = explode("//////////",trim($_GET['datos_filtro']));
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
		
			/*$listar    = $this->db->prepare("SELECT pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
										     WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') 
											 ORDER BY ep.id");*/
											 
											 
			/*$listar    = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
											 TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion 
		                                     FROM empleado_permiso ep  
										     WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah') 
											 ORDER BY ep.id DESC");*/
											 
			
			$listar     = $this->db->prepare("SELECT ep.id,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.rutaarchivo,ep.estado,

												CASE
												
												  WHEN
												
													  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
												
													  THEN
												
														TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
												
													  ELSE
												
														TIMEDIFF(ep.hora_final,ep.hora_inicio)
												
												
												END
												
												AS duracion
												
												FROM empleado_permiso ep 
												WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fechad' AND ep.fecha_solicitud <= '$fechah')
												ORDER BY ep.id DESC");
		}
		
		

  		$listar->execute();

  		return $listar;
	
  	}
  
  /*public function registrarPermiso(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$fechas    = trim($_POST['fechas']);
		$fechap    = trim($_POST['fechap']);
		
		$horai     = trim($_POST['horai']);
		$horaf     = trim($_POST['horaf']);
		
		$detalle2  = trim($_POST['detalle']);
		
		$estado    = 2;
		
		//$fechas       = explode(" ",trim($_POST['fechar']));
		//$fecha        = $fechar[0];
		//$hora         = $fechar[1];
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new empleadosModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Registra una Nueva Solicitud de Permiso";
      	$detalle = $_SESSION['nombre']." "."Registra una Nueva Solicitud de Permiso ".$fecha." "."a las: ".$hora;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   
				$this->db->exec("INSERT INTO empleado_permiso (idusuario,fecha_solicitud,fecha_permiso,fecha_aprobacion,hora_inicio,hora_final,detalle,estado)
								 VALUES ('$idusuario','$fechas','$fechap','0000-00-00','$horai','$horaf','$detalle2','$estado')");
								 
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			//echo "exito: " .$idusuario;
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
		}
		
		
  	}*/
	
	
	public function registrarPermiso(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$fechas    = trim($_POST['fechas']);
		$fechap    = trim($_POST['fechap']);
		
		$horai     = trim($_POST['horai']);
		$horaf     = trim($_POST['horaf']);
		
		$detalle2  = trim($_POST['detalle']);
		
		$estado    = 2;
		
		/*$fechas       = explode(" ",trim($_POST['fechar']));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];*/
		
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new empleadosModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Registra una Nueva Solicitud de Permiso";
      	$detalle = $_SESSION['nombre']." "."Registra una Nueva Solicitud de Permiso ".$fecha." "."a las: ".$hora;
		$tipolog = 1;
		
		
		//***********************************PARA EL ARCHIVO***************************************

		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
		$raiz = "PERMISOS";
		//ID DEL USUARIO DE LA TABLA pa_usuario
		$nom = trim($_SESSION['idUsuario']);
		
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
		
		
		if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
		
		
			if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
				|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
				|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
				|| strpos($tipo_archivo, "pdf") //pdf
				) && ($tamano_archivo < 100000000) )  { 
				
					
					
					/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';*/
					
					
					echo '<script languaje="JavaScript"> 
				
							var dat_1 = "'.$tipo_archivo.'";
				
							alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA: "+dat_1);
							
							location.href="index.php?controller=empleados&action=regIngresoSalida";
									
						</script>';
					
					
				}
				else{//1 
					
					if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
						//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
						
						/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=2"</script>';*/
						
						//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
						//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
						$idunico = time();
						
						$nombre_archivo = $idunico."_".$nombre_archivo;
						
						
					}
					
					
						if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
							 //echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
							 
							 
							 $rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
							 
							 
							 //-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
							 //-------------------------CUANDO SE DEFINE UN ARCHIVO------------------------------------------------
							 try {  
			
								$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								
								//EMPIEZA LA TRANSACCION
								$this->db->beginTransaction();
								
									
									$this->db->exec("INSERT INTO empleado_permiso (idusuario,fecha_solicitud,fecha_permiso,fecha_aprobacion,hora_inicio,hora_final,detalle,estado,rutaarchivo)
													 VALUES ('$idusuario','$fechas','$fechap','0000-00-00','$horai','$horaf','$detalle2','$estado','$rutaarchivo')");
									 
					
									$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
									
								
								//SE TERMINA LA TRANSACCION  
								$this->db->commit();
								//echo "exito: " .$idusuario;
								print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
									
								
								
							  
							} 
							catch (Exception $e) {
							
								//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
								$this->db->rollBack();
								//echo "Fallo: " . $e->getMessage();
								print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
							}
							//---------------------------------------------------------------------------------------------------------------------------------------
							
						}//3
						else{ 
							 //echo "Error al subir el fichero."; 
							 /*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=3"</script>';*/
							 
							 
							 echo '<script languaje="JavaScript"> 
				
										
							
										alert("Error al subir el fichero.");
										
										location.href="index.php?controller=empleados&action=regIngresoSalida";
												
									</script>';
						} 
					
					
					
				}//1
				
			
		}
		else{
		
		
		
			try {  
		
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
				
			   
					$this->db->exec("INSERT INTO empleado_permiso (idusuario,fecha_solicitud,fecha_permiso,fecha_aprobacion,hora_inicio,hora_final,detalle,estado)
									 VALUES ('$idusuario','$fechas','$fechap','0000-00-00','$horai','$horaf','$detalle2','$estado')");
									 
					
					$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
					
				
				//SE TERMINA LA TRANSACCION  
				$this->db->commit();
				//echo "exito: " .$idusuario;
				print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
			  
			} 
			catch (Exception $e) {
			
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();
				//echo "Fallo: " . $e->getMessage();
				print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
			}
		
		
		}	
		

		
  	}
	
	public function Actualizar_RegistroPermiso(){

		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$modelo	= new empleadosModel();
		$fechaaprobar = $modelo->get_fecha_actual_amd();
		
		//$dato_p1 = trim($_GET['dato_p1']);
		$dato_p2 = trim($_GET['dato_p2']);
		$dato_p3 = trim($_GET['dato_p3']);
		
		if($dato_p3 == "APROBAR"){
		
			$sql = "UPDATE empleado_permiso SET estado = '1', fecha_aprobacion = '$fechaaprobar' WHERE  id = '$dato_p2'";
			
		}
		if($dato_p3 == "NOAPROBAR"){
		
			$sql = "UPDATE empleado_permiso SET estado = '0', fecha_aprobacion = '0000-00-00' WHERE  id = '$dato_p2'";
			
		}
		if($dato_p3 == "ENPROCESO"){
		
			$sql = "UPDATE empleado_permiso SET estado = '2', fecha_aprobacion = '0000-00-00' WHERE  id = '$dato_p2'";
			
		}

		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new empleadosModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Actualiza de Estado a Solicitud de Permiso";
      	$detalle = $_SESSION['nombre']." "."Actualiza de Estado a una Solicitud de Permiso ".$fecha." "."a las: ".$hora." ACCION: ".$dato_p3;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
				
				$this->db->exec($sql);
			
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
		}
		
		
  	}
	
	public function Actualizar_RegistroPermisoMasivos(){

		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$modelo	= new empleadosModel();
		$fechaaprobar = $modelo->get_fecha_actual_amd();
		
		//$dato_p1 = trim($_GET['dato_p1']);
		$dato_p2    = trim($_GET['dato_p2']);
		$idspermiso = explode("******",$dato_p2);
		$longid     = count($idspermiso);
		$i=1;
		
		$dato_p3     = trim($_GET['dato_p3']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new empleadosModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Actualiza Masivamente de Estados a Solicitud de Permisos";
      	$detalle = $_SESSION['nombre']." "."Actualiza Masivamente de Estados a Solicitud de Permisos ".$fecha." "."a las: ".$hora." ACCION: ".$dato_p3;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
				if($dato_p3 == "APROBARMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '1', fecha_aprobacion = '$fechaaprobar' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				if($dato_p3 == "NOAPROBARMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '0', fecha_aprobacion = '0000-00-00' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				if($dato_p3 == "ENPROCESOMASIVO"){
				
					while($i < $longid){
					
						$id = $idspermiso[$i];
						
						$sql = "UPDATE empleado_permiso SET estado = '2', fecha_aprobacion = '0000-00-00' WHERE  id = '$id'";
						
						$this->db->exec($sql);
							
						$i = $i + 1;
						
					
					}
		
				}
				
				
			
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	//echo "Fallo: " . $e->getMessage();
			print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=9b"</script>';
		}
		
		
  	}
	
	
}




?>