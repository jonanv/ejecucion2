<?php
class excelempleadosModel extends modelBase
{



	//---------------------------------------------------------------------------------------------		
	
	/*------------------------------DATOS EMPLEADO INGRESOS - SALIDAS---------------------------------------*/
	
	public function Datos_Empleado_Ingreso_Salida($fd,$fh){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$idusuario = $_SESSION['idUsuario'];
		
	
		if( empty($fd) && empty($fh) ){//GENERA EN EXCEL TODAS LOS REGISTROS
		
			  
			$listar = $this->db->prepare("SELECT usu.empleado as usuario,em.fecha,em.hora,em.tipo, em.observaciones 
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
										  WHERE em.idusuario = '$idusuario'
										  ORDER BY em.id DESC");
		}
		else{
		
			//$fd = $fd.' 00:00:00';
			//$fh = $fh.' 23:59:59';
				
			/*$listar = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha,em.tipo, em.observaciones 
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
									      WHERE em.idusuario = '$idusuario' 
										  AND ( DATE(em.fecha) >= '$fd' AND DATE(em.fecha) <= '$fh' )
										  ORDER BY em.id DESC"); */
										  
			$listar = $this->db->prepare("SELECT usu.empleado as usuario,
										  DATE(em.fecha) AS fecha,
										  em.hora AS hora,
										  em.tipo, em.observaciones 
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
									      WHERE em.idusuario = '$idusuario' 
										  AND ( DATE(em.fecha) >= '$fd' AND DATE(em.fecha) <= '$fh' )
										  ORDER BY em.id DESC"); 
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
   }  	
   
   public function Datos_Empleado_Ingreso_Salida_Completo($usuarioc,$fdc,$fhc){
	
			//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
			
			$modelo    = new excelempleadosModel();
			
			$idusuario = $_SESSION['idUsuario'];
		
			$filtrox;
			
			$filtro1;
			$filtro2;
			
						
			if ( !empty($usuarioc) ) {
			
				$filtro1 = " AND em.idusuario = '$usuarioc' ";
			
			}
			if ( !empty($fdc) && !empty($fhc) ) {
			
				
				$fdc = $fdc.' 00:00:00';
				$fhc = $fhc.' 23:59:59';
				
				$filtro2 = " AND (em.fecha >= '$fdc' AND em.fecha <= '$fhc') ";
				
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2;
			
			//echo $filtrox;
			
			
			//ID USUARIOS QUE PUEDEN VER Y APROBAR TODOS LOS PERMISOS
			//TABLA pa_usuario_acciones id(22) ---> 38////19
			$campos         = 'usuario';
			$nombrelista    = 'pa_usuario_acciones';
			$idaccion	    = '22';
			$campoordenar   = 'id';
			$datosusuarioPER = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuariosPER1    = $datosusuarioPER->fetch();
			$usuariosaPER2	 = explode("////",$usuariosPER1[usuario]);
			
			
			//SE INDICA QUE EL USUARIO NO SEA EL DIRECTOR DE DESAJ PARA FILTRAR SOLO LOS PERMISOS
			//DE LOS USUARIOS A CARGO DE ESE JEFE DE AREA, SI ES 3 ES EL DIRECTOR DESAJ Y PUEDE VER TODOS LOS PERMISOS
			//DEJO LA NOTA ANTERIOR PARA CAPTAR BIEN QUE EL USUARIO NO PERTENECIENTE EN LA ACCION 
			//TABLA pa_usuario_acciones id(22) ---> 38////19 NO PUEDE VISUALIZAR TODOS LOS PERMISOS
			//if($idusuario != 38){
			if ( !in_array($_SESSION['idUsuario'],$usuariosaPER2,true) ){
			
			
				$listar    = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha,em.hora,em.tipo,em.observaciones 
												 FROM ((empleado_control em
												 INNER JOIN pa_usuario usu ON em.idusuario = usu.id)
												 INNER JOIN sireg_pa_area spa ON usu.idareapertenece = spa.id)
												 WHERE em.id >= '1'" .$filtrox. " AND spa.idusuarioacargo = '$idusuario'
												 ORDER BY em.id DESC");
				
			}
			else{
			
			
				//SE COLOCA ep.id >= '1' PARA QUE LOS FILTROS ANTERIORES EMPIEZEN CON EL (AND) Y NO SE TENGA QUE DEFINIR
				//CUAL DE LOS FILTROS VA PRIMERO SI NO SE DEFINE ALGUNO YA QUE QUEDARIA ALGO COMO WHERE AND FILTRO, 
				//Y YA QUE EL CAMPO ep.id ES UN VALOR AUTONUMERICO QUE EMPIEZA EN 1 LA PREGUNTA ep.id >= '1' 
				//SIEMPRE VA A CONCORDAR MAS EL FILTRO QUE SE ASIGNE.
				$listar    = $this->db->prepare("SELECT usu.empleado as usuario, em.fecha,em.hora,em.tipo,em.observaciones 
												 FROM empleado_control em
												 INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
												 WHERE em.id >= '1'" .$filtrox. " ORDER BY em.id DESC");
												 
				
			
			}									 

		

  			$listar->execute();

  			return $listar;
		
		
   }  	
   
   public function Datos_Empleado_Permisos($fd,$fh){
   
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$idusuario = $_SESSION['idUsuario'];
		
		//SE REALIZA ESTE CAMBIO YA QUE SI SE PIDE UN PERMISO DIGAMOS DESDE LAS 10:00 AM HASTA LAS 4:00 PM OSEA 16:00 HORA MILITAR
	   //EL SISTEMA NO DEBE TENER ENCUENTA LASDOS HORAS DEL MEDIO DIA, ENTONCES SIENDO EL CASO SE LE RESTA DOS HORAS
	
		if( empty($fd) && empty($fh) ){//GENERA EN EXCEL TODAS LOS REGISTROS
		
			  
			/*$listar = $this->db->prepare("SELECT usu.empleado AS usuario,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,
										  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion,ep.detalle,ep.estado
										  FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id)
										  WHERE ep.idusuario = '$idusuario'
										  ORDER BY ep.id DESC");*/
										  
			$listar = $this->db->prepare("SELECT usu.empleado AS usuario,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,

											CASE
											
											  WHEN
											
												  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
											
												  THEN
											
													TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
											
												  ELSE
											
													TIMEDIFF(ep.hora_final,ep.hora_inicio)
											
											
											END
											
											AS duracion,ep.detalle,ep.estado
											
											
											FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id)
											WHERE ep.idusuario = '$idusuario'
											ORDER BY ep.id DESC");
		}
		else{
		
			//$fd = $fd.' 00:00:00';
			//$fh = $fh.' 23:59:59';
				
			/*$listar = $this->db->prepare("SELECT usu.empleado AS usuario,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,
										  TIMEDIFF(ep.hora_final,ep.hora_inicio) AS duracion,ep.detalle,ep.estado
										  FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id)
										  WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fd' AND ep.fecha_solicitud <= '$fh')
										  ORDER BY ep.id DESC"); */
										  
			
			$listar = $this->db->prepare("SELECT usu.empleado AS usuario,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,

											CASE
											
											  WHEN
											
												  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
											
												  THEN
											
													TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
											
												  ELSE
											
													TIMEDIFF(ep.hora_final,ep.hora_inicio)
											
											
											END
											
											AS duracion,ep.detalle,ep.estado
											
											
											FROM (empleado_permiso ep INNER JOIN pa_usuario usu ON ep.idusuario = usu.id)
											WHERE ep.idusuario = '$idusuario' AND (ep.fecha_solicitud >= '$fd' AND ep.fecha_solicitud <= '$fh')
											ORDER BY ep.id DESC");
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
   }  			
   
   public function Datos_Permisos_AprobadosNoAprobadosEnProceso($usuariop,$fdp,$fhp,$estadop){
   
   
   			
			$modelo    = new excelempleadosModel();
			
			$idusuario = $_SESSION['idUsuario'];
   
   			//SE REALIZA ESTE CAMBIO YA QUE SI SE PIDE UN PERMISO DIGAMOS DESDE LAS 10:00 AM HASTA LAS 4:00 PM OSEA 16:00 HORA MILITAR
			//EL SISTEMA NO DEBE TENER ENCUENTA LASDOS HORAS DEL MEDIO DIA, ENTONCES SIENDO EL CASO SE LE RESTA DOS HORAS
	
			$filtrox;
			
			$filtro1;
			$filtro2;
			$filtro3;
			
			
			if ( !empty($usuariop) ) {
			
				$filtro1 = " AND ep.idusuario = '$usuariop' ";
			
			}
			if ( !empty($fdp) && !empty($fhp) ) {
			
				
				$filtro2 = " AND (ep.fecha_solicitud >= '$fdp' AND ep.fecha_solicitud <= '$fhp') ";
				
			
			}
			//PREGUNTO $estado != '', YA QUE LA FUNCION empty SI EL VALOR ES CERO ASUME QUE ES UN VALOR VACIO
			//Y NO ENTRA AL IF, OCCASIONANDO ESTO NO ARMAR EL FILTRO $filtro3
			if ( $estadop != '') {
			
				
				$filtro3 = " AND ep.estado = '$estadop' ";
			
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
			
			
		
			//ID USUARIOS QUE PUEDEN VER Y APROBAR TODOS LOS PERMISOS
			//TABLA pa_usuario_acciones id(22) ---> 38////19
			$campos         = 'usuario';
			$nombrelista    = 'pa_usuario_acciones';
			$idaccion	    = '22';
			$campoordenar   = 'id';
			$datosusuarioPER = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuariosPER1    = $datosusuarioPER->fetch();
			$usuariosaPER2	 = explode("////",$usuariosPER1[usuario]);
			
			
			//SE INDICA QUE EL USUARIO NO SEA EL DIRECTOR DE DESAJ PARA FILTRAR SOLO LOS PERMISOS
			//DE LOS USUARIOS A CARGO DE ESE JEFE DE AREA, SI ES 3 ES EL DIRECTOR DESAJ Y PUEDE VER TODOS LOS PERMISOS
			//DEJO LA NOTA ANTERIOR PARA CAPTAR BIEN QUE EL USUARIO NO PERTENECIENTE EN LA ACCION 
			//TABLA pa_usuario_acciones id(22) ---> 38////19 NO PUEDE VISUALIZAR TODOS LOS PERMISOS
			//if($idusuario != 38){
			if ( !in_array($_SESSION['idUsuario'],$usuariosaPER2,true) ){								 
			
			
				$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
	
												  CASE
													
													  WHEN
													
														  (ep.hora_inicio >= '07:00' AND ep.hora_inicio <= '12:00') AND (ep.hora_final >= '14:00' AND ep.hora_final <= '23:00')
													
														  THEN
													
															TIMEDIFF( TIMEDIFF(ep.hora_final,ep.hora_inicio),'2:00')
													
														  ELSE
													
															TIMEDIFF(ep.hora_final,ep.hora_inicio)
													
													
													END
													
													AS duracion
													
													FROM ((empleado_permiso ep 
													INNER JOIN pa_usuario pu ON ep.idusuario = pu.id) 
													INNER JOIN sireg_pa_area spa ON pu.idareapertenece = spa.id)
													WHERE ep.id >= '1'" .$filtrox. " AND spa.idusuarioacargo = '$idusuario'
													ORDER BY ep.id DESC");
		
			
			}
			else{
			
			
			
				$listar    = $this->db->prepare("SELECT ep.id,pu.empleado,ep.fecha_solicitud,ep.fecha_permiso,ep.hora_inicio,ep.hora_final,ep.detalle,ep.estado,
	
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
			
			}
			
											
		

  		$listar->execute();

  		return $listar;
	
   }  			
   
   public function Datos_ConsolidadoPermisos($usuariop,$fdp,$fhp,$estadop){
   
   			
			$modelo    = new excelempleadosModel();
			
			$idusuario = $_SESSION['idUsuario'];

			
   			//SOLO SE USAN LAS FECHAS $fdp,$fhp, SE DEJA LOS OTROS DATOS $usuariop,$estadop
			//SOLO SI SE NECESITAN
	
			$filtrox;
			
			$filtro1;
			$filtro2;
			$filtro3;
			
			
			if ( !empty($usuariop) ) {
			
				$filtro1 = " AND ep.idusuario = '$usuariop' ";
			
			}
			if ( !empty($fdp) && !empty($fhp) ) {
			
				
				$filtro2 = " AND (ep.fecha_solicitud >= '$fdp' AND ep.fecha_solicitud <= '$fhp') ";
				
			
			}
			//PREGUNTO $estado != '', YA QUE LA FUNCION empty SI EL VALOR ES CERO ASUME QUE ES UN VALOR VACIO
			//Y NO ENTRA AL IF, OCCASIONANDO ESTO NO ARMAR EL FILTRO $filtro3
			if ( $estadop != '') {
			
				
				$filtro3 = " AND ep.estado = '$estadop' ";
			
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
											 
			/*$listar    = $this->db->prepare("SELECT ep.idusuario,pu.nombre_usuario,pu.empleado,COUNT(*) AS numeropermisos
											 FROM (empleado_permiso ep INNER JOIN pa_usuario pu ON ep.idusuario = pu.id)
											 WHERE ep.id >= '1'" .$filtrox. " AND ep.estado = '1'
											 GROUP BY ep.idusuario
											 HAVING COUNT(*) >= 1
											 ORDER BY pu.empleado");*/
											 
											 
		
			/*ACTUALIZACION DE CONSULTA 6 DE FEBRERO 2018, PARA TOMAR EL CARGO DEL USUARIO
			Y VISUALIZARLO EN EL REPORTE DESDE LA NUEVA TABLA pa_usuario_cargo*/
			/*$listar    = $this->db->prepare("SELECT ep.idusuario,pu.nombre_usuario,pu.empleado,des AS cargo,
			                                 COUNT(*) AS numeropermisos
											 FROM ((empleado_permiso ep 
											 LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
											 LEFT JOIN pa_usuario_cargo cu ON pu.cargo = cu.id)
											 WHERE ep.id >= '1'" .$filtrox. " AND ep.estado = '1'
											 GROUP BY ep.idusuario
											 HAVING COUNT(*) >= 1
											 ORDER BY pu.empleado");*/
			
			
			//ID USUARIOS QUE PUEDEN VER Y APROBAR TODOS LOS PERMISOS
			//TABLA pa_usuario_acciones id(22) ---> 38////19
			$campos         = 'usuario';
			$nombrelista    = 'pa_usuario_acciones';
			$idaccion	    = '22';
			$campoordenar   = 'id';
			$datosusuarioPER = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuariosPER1    = $datosusuarioPER->fetch();
			$usuariosaPER2	 = explode("////",$usuariosPER1[usuario]);
			
			
			//SE INDICA QUE EL USUARIO NO SEA EL DIRECTOR DE DESAJ PARA FILTRAR SOLO LOS PERMISOS
			//DE LOS USUARIOS A CARGO DE ESE JEFE DE AREA, SI ES 3 ES EL DIRECTOR DESAJ Y PUEDE VER TODOS LOS PERMISOS
			//DEJO LA NOTA ANTERIOR PARA CAPTAR BIEN QUE EL USUARIO NO PERTENECIENTE EN LA ACCION 
			//TABLA pa_usuario_acciones id(22) ---> 38////19 NO PUEDE VISUALIZAR TODOS LOS PERMISOS
			//if($idusuario != 38){
			if ( !in_array($_SESSION['idUsuario'],$usuariosaPER2,true) ){								 
											 
			
			
			/*ACTUALIZACION DE CONSULTA 14 DE AGOSTO 2018, PARA TOMAR SOLO LOS REGISTROS DE PERMISOS DE USUARIOS
			A CARGO SOLO DEL SERVIDOR LIDER DEL AREA*/
				$listar    = $this->db->prepare("SELECT ep.idusuario,pu.nombre_usuario,pu.empleado,des AS cargo,
												 COUNT(*) AS numeropermisos
												 FROM (((empleado_permiso ep 
												 LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
												 LEFT JOIN pa_usuario_cargo cu ON pu.cargo = cu.id)
												 INNER JOIN sireg_pa_area spa ON pu.idareapertenece = spa.id)
												 WHERE ep.id >= '1'" .$filtrox. " AND ep.estado = '1' AND spa.idusuarioacargo = '$idusuario'
												 GROUP BY ep.idusuario
												 HAVING COUNT(*) >= 1
												 ORDER BY pu.empleado");	
											 
			}
			else{
			
				$listar    = $this->db->prepare("SELECT ep.idusuario,pu.nombre_usuario,pu.empleado,des AS cargo,
												 COUNT(*) AS numeropermisos
												 FROM ((empleado_permiso ep 
												 LEFT JOIN pa_usuario pu ON ep.idusuario = pu.id)
												 LEFT JOIN pa_usuario_cargo cu ON pu.cargo = cu.id)
												 WHERE ep.id >= '1'" .$filtrox. " AND ep.estado = '1' 
												 GROUP BY ep.idusuario
												 HAVING COUNT(*) >= 1
												 ORDER BY pu.empleado");
			
			}								 							 
			
		

  		$listar->execute();

  		return $listar;
	
   }  	
   
   public function Cantidad_Horas_Permisos($idusuario){
   
   		//SE REALIZA ESTE CAMBIO YA QUE SI SE PIDE UN PERMISO DIGAMOS DESDE LAS 10:00 AM HASTA LAS 4:00 PM OSEA 16:00 HORA MILITAR
	   //EL SISTEMA NO DEBE TENER ENCUENTA LASDOS HORAS DEL MEDIO DIA, ENTONCES SIENDO EL CASO SE LE RESTA DOS HORAS
	
		/*$listar = $this->db->prepare("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(hora_final,hora_inicio) ) ) ) AS cantidadhoras 
		                              FROM empleado_permiso WHERE idusuario = '$idusuario'");*/
									  
									  
		$listar = $this->db->prepare("SELECT SEC_TO_TIME(

										 SUM(
								
											 TIME_TO_SEC(
								
								
								
								
								
											   /*TIMEDIFF(hora_final,hora_inicio)*/
								
								
												 CASE
								
													WHEN
								
													  (hora_inicio >= '07:00' AND hora_inicio <= '12:00') AND (hora_final >= '14:00' AND hora_final <= '23:00')
								
													  THEN
								
														TIMEDIFF( TIMEDIFF(hora_final,hora_inicio),'2:00')
								
													  ELSE
								
														TIMEDIFF(hora_final,hora_inicio)
								
								
												END
								
								
											 )
										 )
								
									   )
								
									   AS cantidadhoras
								
								FROM empleado_permiso
								WHERE idusuario = '$idusuario'");
									  
		
		$listar->execute();
			  
		return $listar; 
	
   } 
   
   //SE USA ESTA FUNCION SOLO CUANDO SE CALCULA EL CONSOLIDADO
   //YA QUE SE DEBE TENER ENCUENTA LAS HORAS DE LOS PERMISOS CYUO ESTADO ES 1
   //OSEA APROBADOS
   public function Cantidad_Horas_Permisos_2($idusuario,$fdp,$fhp){
	
		/*$listar = $this->db->prepare("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( TIMEDIFF(hora_final,hora_inicio) ) ) ) AS cantidadhoras FROM empleado_permiso WHERE idusuario = '$idusuario'");*/
		
		
		$listar = $this->db->prepare("SELECT SEC_TO_TIME(

										 SUM(
								
											 TIME_TO_SEC(
								
								
								
								
								
											   /*TIMEDIFF(hora_final,hora_inicio)*/
								
								
												 CASE
								
													WHEN
								
													  (hora_inicio >= '07:00' AND hora_inicio <= '12:00') AND (hora_final >= '14:00' AND hora_final <= '23:00')
								
													  THEN
								
														TIMEDIFF( TIMEDIFF(hora_final,hora_inicio),'2:00')
								
													  ELSE
								
														TIMEDIFF(hora_final,hora_inicio)
								
								
												END
								
								
											 )
										 )
								
									   )
								
									   AS cantidadhoras
								
								FROM empleado_permiso
								WHERE idusuario = '$idusuario' AND (fecha_solicitud >= '$fdp' AND fecha_solicitud <= '$fhp') 
								AND estado = 1");
		
		$listar->execute();
			  
		return $listar; 
	
   } 	
   
   
   public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
   }		
	
 
}//CIERRE MODEL0

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//PARA EMPLEADOS INGRESOS Y SALIDAS COMPLETO
$datos_reportecompletosalidaentrada = explode("//////////",trim($_GET['datos_reportecompletosalidaentrada']));
$id_reportec = $datos_reportecompletosalidaentrada[0];
$usuarioc    = $datos_reportecompletosalidaentrada[1];
$fdc         = $datos_reportecompletosalidaentrada[2];  
$fhc         = $datos_reportecompletosalidaentrada[3];


//PARA EMPLEADOS INGRESOS Y SALIDAS
$datos_reporte = explode("//////////",trim($_GET['datos_reporte']));

$id_reporte = $datos_reporte[0];
$fd         = $datos_reporte[1];  
$fh         = $datos_reporte[2];

//PARA PERMISOS DE USUARIO
$datos_reportepermiso = explode("//////////",trim($_GET['datos_reportepermiso']));

$id_reportep = $datos_reportepermiso[0];
$usuariop    = $datos_reportepermiso[1];
$fdp         = $datos_reportepermiso[2];  
$fhp         = $datos_reportepermiso[3];
$estadop     = $datos_reportepermiso[4];



if($id_reporte == 1000)
{

$data= new excelempleadosModel();

$vector_datos= $data->Datos_Empleado_Ingreso_Salida($fd,$fh);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
)
);
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THICK,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
$borders_nobold = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );	
// Agregar Informacion Encabezados Excel

$sheet1=$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('A1', 'FECHA')
->setCellValue('B1', 'HORA')
->setCellValue('C1', 'USUARIO')
->setCellValue('D1', 'TIPO')
->setCellValue('E1', 'OBSERVACION');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:E1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	/*$cadenaFecha  =  explode (" ",$field[fecha]);
	$cadenaHora   =  $cadenaFecha[1];
	$cadenaHorab  =  explode (":",$cadenaHora);
	
	if($cadenaHorab[0] >= 7 && $cadenaHorab[0] <= 12){
		$fechacompleta = $field[fecha]." AM"; 
	}
	else{
		$fechacompleta = $field[fecha]." PM"; 
	}*/
	
	$sheet1->setCellValue('A'.$i, $field[fecha]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[hora]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('C'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[tipo]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observaciones]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Ingresos-Salidas');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ingresos-Salidas.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}


if($id_reporte == 2000)
{

$data= new excelempleadosModel();

$vector_datos= $data->Datos_Empleado_Permisos($fd,$fh);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
)
);
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THICK,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
$borders_nobold = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );	
// Agregar Informacion Encabezados Excel

$sheet1=$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('A1', 'USUARIO')
->setCellValue('B1', 'FECHA SOLICITUD')
->setCellValue('C1', 'FECHA PERMISO')
->setCellValue('D1', 'HORA INICAL')
->setCellValue('E1', 'HORA FINAL')
->setCellValue('F1', 'DURACION')
->setCellValue('G1', 'DETALLE')
->setCellValue('H1', 'ESTADO');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:H1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	if($field[estado] == 2){
		$estado = "En Proceso";
	}
	if($field[estado] == 1){
		$estado = "Aprobado";
	}
	if($field[estado] == 0){
		$estado = "No Aprobado";
	}
	
	$sheet1->setCellValue('A'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[fecha_solicitud]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('C'.$i, $field[fecha_permiso]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[hora_inicio]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[hora_final]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[duracion]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, utf8_encode($field[detalle]));
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, $estado);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Permisos-Usuario');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Permisos-Usuario.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				
				
if($id_reportep == 3000)
{

$data= new excelempleadosModel();

$vector_datos= $data->Datos_Permisos_AprobadosNoAprobadosEnProceso($usuariop,$fdp,$fhp,$estadop);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
)
);
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THICK,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
$borders_nobold = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );	
// Agregar Informacion Encabezados Excel

$sheet1=$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('A1', 'ID')
->setCellValue('B1', 'USUARIO')
->setCellValue('C1', 'FECHA SOLICITUD')
->setCellValue('D1', 'FECHA PERMISO')
->setCellValue('E1', 'HORA INICAL')
->setCellValue('F1', 'HORA FINAL')
->setCellValue('G1', 'DURACION')
->setCellValue('H1', 'DETALLE')
->setCellValue('I1', 'ESTADO');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:I1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	if($field[estado] == 2){
		$estado = "En Proceso";
	}
	if($field[estado] == 1){
		$estado = "Aprobado";
	}
	if($field[estado] == 0){
		$estado = "No Aprobado";
	}
	
	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[fecha_solicitud]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('D'.$i, $field[fecha_permiso]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[hora_inicio]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[hora_final]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, $field[duracion]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, utf8_encode($field[detalle]));
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('I'.$i, $estado);
	$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Permisos-Usuario2');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Permisos-Usuario2.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				

if($id_reportep == 4000)
{

$data = new excelempleadosModel();

$vector_datos  = $data->Datos_ConsolidadoPermisos($usuariop,$fdp,$fhp,$estadop);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true,
'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
'size'   =>  12 
)
);

$styleArray2 = array ( 
    	'font'   => array ( 
        'bold'   =>  true , 
        'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
        'size'   =>  15 
));

$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THICK,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
$borders_nobold = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );	
// Agregar Informacion Encabezados Excel

$sheet1=$objPHPExcel->setActiveSheetIndex(0)

//ENCABEZADO FORMATO PARA EL CONSOLIDADO DE PERMISOS
->setCellValue('A1', 'FORMATO PARA EL CONSOLIDADO DE PERMISOS')
->mergeCells('A1:H1')


//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
->setCellValue('A2', 'SEMESTRE '.$fdp.' - '.$fhp)
->mergeCells('A2:H2')

//ENCABEZADO PARA LAS COLUMNAS
->setCellValue('A3', 'DISTRITO JUDICIAL')
->setCellValue('B3', 'DESPACHO')
->setCellValue('C3', 'NOMBRE DEL SOLICITANTE')
->setCellValue('D3', 'CARGO')
->setCellValue('E3', 'TIEMPO EN HORAS DEDICADO A DOCENCIA')
->setCellValue('F3', 'TIEMPO EN HORAS DEDICADO A ESTUDIOS')
->setCellValue('G3', 'NUN PERMISOS ORDINARIOS')
->setCellValue('H3', 'TIEMPO HORAS PERMISOS ORDINARIOS');


$sheet1->getStyle('A3')->applyFromArray($styleArray);
$sheet1->getStyle('B3')->applyFromArray($styleArray);
$sheet1->getStyle('C3')->applyFromArray($styleArray);
$sheet1->getStyle('D3')->applyFromArray($styleArray);
$sheet1->getStyle('E3')->applyFromArray($styleArray);
$sheet1->getStyle('F3')->applyFromArray($styleArray);
$sheet1->getStyle('G3')->applyFromArray($styleArray);
$sheet1->getStyle('H3')->applyFromArray($styleArray);

$sheet1->getStyle('A1:H1')->applyFromArray($styleArray2);
$sheet1->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet1->getStyle('A1:H1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),
            'endcolor' => array('rgb' => '2F709F')

            )
    );

$sheet1->getStyle('A2:H2')->applyFromArray($styleArray2);
$sheet1->getStyle('A2:H2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
$sheet1->getStyle('A2:H2')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),
            'endcolor' => array('rgb' => '2F709F')

            )
    );
	
$sheet1->getStyle('A3:H3')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => '2F709F'),//CDE3F6
            'endcolor' => array('rgb' => '2F709F')

            )
    );
	
	


//$i=2;
$i=4;
while($field = $vector_datos->fetch() )
{

	$cantidad_horas      = $data->Cantidad_Horas_Permisos_2($field[idusuario],$fdp,$fhp);
	$fieldcantidad_horas = $cantidad_horas->fetch();
	
	 
	$sheet1->setCellValue('A'.$i, "MANIZALES");
	//$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type'       => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'CDE3F6'),'endcolor' => array('rgb' => 'CDE3F6')));
	
	$sheet1->setCellValue('B'.$i, "OFICINA DE EJECUION CIVIL MUNICIPAL");
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, utf8_encode($field[cargo]));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('E'.$i, " ");
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, " ");
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, $field[numeropermisos]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('H'.$i, $fieldcantidad_horas[cantidadhoras]);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	

	$i++;
	
}


$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($borders);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Consolidado_Permisos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Consolidado_Permisos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				

if($id_reportec == 5000)
{

set_time_limit (240000000);

$data= new excelempleadosModel();

$vector_datos= $data->Datos_Empleado_Ingreso_Salida_Completo($usuarioc,$fdc,$fhc);

$objPHPExcel = new PHPExcel();

$styleArray = array(
'font' => array(
'bold' => true
)
);
$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THICK,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
$borders_nobold = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );	
// Agregar Informacion Encabezados Excel

$sheet1=$objPHPExcel->setActiveSheetIndex(0)

->setCellValue('A1', 'FECHA')
->setCellValue('B1', 'HORA')
->setCellValue('C1', 'USUARIO')
->setCellValue('D1', 'TIPO')
->setCellValue('E1', 'OBSERVACION');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);


$sheet1->getStyle('A1:E1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	/*$cadenaFecha  =  explode (" ",$field[fecha]);
	$cadenaHora   =  $cadenaFecha[1];
	$cadenaHorab  =  explode (":",$cadenaHora);
	
	if($cadenaHorab[0] >= 7 && $cadenaHorab[0] <= 12){
		$fechacompleta = $field[fecha]." AM"; 
	}
	else{
		$fechacompleta = $field[fecha]." PM"; 
	}*/
	
	$sheet1->setCellValue('A'.$i, $field[fecha]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[hora]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[tipo]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observaciones]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Ingresos-Salidas-Completo');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Ingresos-Salidas-Completo.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				


	   
				

?>