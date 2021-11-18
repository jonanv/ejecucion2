<?php

class excelModel extends modelBase
{

//----------------FUNCION AGREGADA POR JORGE ANDRES VALENCIA OROZCO--------------
	
	/*------------------------------DATOS EVENTOS---------------------------------------*/
	
	public function Datos_Eventos($filtro,$fd,$fh){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
	
		if(empty($filtro) && ( empty($fd) && empty($fh) ) ){//GENERA EN EXCEL TODOS LOS EVENTOS
		
			$listar = $this->db->prepare("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion 
										  FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
										  INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) ORDER BY id");
		}
		else{
		  
			if( ( empty($fd) || empty($fh) ) ){ //SI ALGUNA DE LAS FECHAS ES VACIA, GENERA EXCEL SEGUN EL $filtro 
										  
				$listar = $this->db->prepare("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion 
										  	  FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
										      INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) WHERE (ubi.radicado LIKE '%$filtro%') OR (acc.acc_descripcion LIKE '%$filtro%') 
										      OR (eve.eveasunto LIKE '%$filtro%') OR (eve.evedescripcion LIKE '%$filtro%') ORDER BY id DESC");
			}
			else{//SI AMBAS FECHAS ESTAN DEFINIDAS
			
				$listar = $this->db->prepare("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
											 INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) 
											 WHERE eve.evefecha >= '$fd' AND eve.evefecha <= '$fh' ORDER BY id DESC"); 
			
			}
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
	}  
	
	//---------------------------------------------------------------------------------------------		
	
	/*------------------------------DATOS actuaciones---------------------------------------*/
	
	public function Datos_Actuaciones($filtro_2,$fd_2,$fh_2){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
	
		if(empty($filtro_2) && ( empty($fd_2) && empty($fh_2) ) ){//GENERA EN EXCEL TODAS LAS ACTUACIONES
		
			$listar = $this->db->prepare("SELECT ue.radicado,ps.nombre,ae.actu_fechai,ae.actu_fechaf,pu.empleado,ace.acc_descripcion,ae.actu_dias
										  FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
										  LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
										  INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
										  INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
										  ORDER BY ae.actu_radicado,ae.id DESC");
										  
			
		}
		else{
		
			if(!empty($filtro_2) && (!empty($fd_2) && !empty($fh_2) ) ){//SI TODOS LOS CAMPOS ESTAN DEFINIDOS, FECHAS Y FUNCIONARIO
			
				$listar = $this->db->prepare("SELECT ue.radicado,ps.nombre,ae.actu_fechai,ae.actu_fechaf,pu.empleado,ace.acc_descripcion,ae.actu_dias
										  	  FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
										      LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
										      INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
										      INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
											  WHERE (ae.actu_asignadoa = '$filtro_2') AND
											  ae.actu_fechaf >= '$fd_2' AND ae.actu_fechaf <= '$fh_2' 
										      ORDER BY ae.actu_radicado,ae.id DESC");
											  
				
			}
			else{
		  
				if( ( empty($fd_2) || empty($fh_2) ) ){ //SI ALGUNA DE LAS FECHAS ES VACIA, GENERA EXCEL SEGUN EL $filtro QUE ES EL FUNCIONARIO SELECCIONADO
											  
					
					$listar = $this->db->prepare("SELECT ue.radicado,ps.nombre,ae.actu_fechai,ae.actu_fechai,ae.actu_fechaf,pu.empleado,ace.acc_descripcion,ae.actu_dias
												  FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
												  LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
												  INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
												  INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
												  WHERE (ae.actu_asignadoa = '$filtro_2') 
												  ORDER BY ae.actu_radicado,ae.id DESC"); 
				}
				else{//SI AMBAS FECHAS ESTAN DEFINIDAS
				
					$listar = $this->db->prepare("SELECT ue.radicado,ps.nombre,ae.actu_fechai,ae.actu_fechai,ae.actu_fechaf,pu.empleado,ace.acc_descripcion,ae.actu_dias
												  FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
												  LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
												  INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
												  INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
												  WHERE ae.actu_fechai >= '$fd_2' AND ae.actu_fechai <= '$fh_2' 
												  ORDER BY ae.actu_radicado,ae.id DESC"); 
				
				}
			
			}
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
	}
	
	public function Datos_Actuaciones_2($filtro_2,$fd_2,$fh_2){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
	
		
			
		if(empty($filtro_2) && (empty($fd_2) && empty($fh_2) ) ){//GENERA EN EXCEL TODAS LAS ACTUACIONES
		
	  
			$listar = $this->db->prepare("SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.observacion
									  	  FROM (detalle_correspondencia t1 INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
									      WHERE (observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA FINAL:%' OR observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA INICIAL:%')
									      ORDER BY DATE(t1.fecha) DESC");
									  
		}
		else{
		
			if(!empty($filtro_2) && (!empty($fd_2) && !empty($fh_2) ) ){//SI TODOS LOS CAMPOS ESTAN DEFINIDOS, FECHAS Y FUNCIONARIO
			
				
				
				$listar = $this->db->prepare("SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.observacion
									  	      FROM (detalle_correspondencia t1 INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
									          WHERE (observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA FINAL:%' OR observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA INICIAL:%')
											  AND observacion LIKE '%$filtro_2%'
											  AND ( DATE(t1.fecha) >= '$fd_2' AND DATE(t1.fecha) <= '$fh_2' )
									          ORDER BY DATE(t1.fecha) DESC");
											  
				
			}
			else{
		  
				if( ( empty($fd_2) || empty($fh_2) ) ){ //SI ALGUNA DE LAS FECHAS ES VACIA, GENERA EXCEL SEGUN EL $filtro QUE ES EL FUNCIONARIO SELECCIONADO
											  
					
					
					
					$listar = $this->db->prepare("SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.observacion
									  	          FROM (detalle_correspondencia t1 INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
									              WHERE (observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA FINAL:%' OR observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA INICIAL:%')
											      AND observacion LIKE '%$filtro_2%'
									              ORDER BY DATE(t1.fecha) DESC");
												  
				}
				else{//SI AMBAS FECHAS ESTAN DEFINIDAS
				
					$listar = $this->db->prepare("SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t1.observacion
									  	          FROM (detalle_correspondencia t1 INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
									              WHERE (observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA FINAL:%' OR observacion LIKE '%TRAMITE INTERNO DE PROCESO, FECHA INICIAL:%')
												  AND ( DATE(t1.fecha) >= '$fd_2' AND DATE(t1.fecha) <= '$fh_2' )
									              ORDER BY DATE(t1.fecha) DESC"); 
				
				}
			
			}
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
	}  		
	
	//---------------------------------------------------------------------------------------------		
	
	/*------------------------------DATOS EMPLEADO INGRESOS - SALIDAS---------------------------------------*/
	
	public function Datos_Empleado_Ingreso_Salida($filtro_3,$fd_3,$fh_3){
	
		//ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
	
		if(empty($filtro_3) && ( empty($fd_3) && empty($fh_3) ) ){//GENERA EN EXCEL TODAS LAS ACTUACIONES
		
			  
			$listar = $this->db->prepare("SELECT em.idusuario, usu.empleado as usuario, em.fecha, em.observaciones, em.tipo
										  FROM empleado_control em
										  INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)");
		}
		else{
		
			if(!empty($filtro_3) && (!empty($fd_3) && !empty($fh_3) ) ){//SI TODOS LOS CAMPOS ESTAN DEFINIDOS, FECHAS Y FUNCIONARIO
			
				
				$fd_3 = $fd_3.' 00:00:00';
				$fh_3 = $fh_3.' 23:59:59';
		
				$listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
											  FROM empleado_control em
											  LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)
											  WHERE (em.idusuario = '$filtro_3')
											  AND em.fecha >= '$fd_3' AND em.fecha <= '$fh_3'"); 
			}
			else{
		  
				if( ( empty($fd_3) || empty($fh_3) ) ){ //SI ALGUNA DE LAS FECHAS ES VACIA, GENERA EXCEL SEGUN EL $filtro QUE ES EL FUNCIONARIO SELECCIONADO
											  
					
					$listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
											      FROM empleado_control em
											      LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)
											      WHERE (em.idusuario = '$filtro_3')"); 
				}
				else{//SI AMBAS FECHAS ESTAN DEFINIDAS
				
					$fd_3 = $fd_3.' 00:00:00';
					$fh_3 = $fh_3.' 23:59:59';
				
					$listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
											      FROM empleado_control em
											      LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)
											      WHERE em.fecha >= '$fd_3' AND em.fecha <= '$fh_3'"); 
				
				}
			
			}
		
		}
		
		$listar->execute();
			  
		return $listar; 
	
	}  		
	
	//---------------------------------------------------------------------------------------------		
	
	/*------------------------------DATOS actuaciones---------------------------------------*/
	
	public function Datos_Reparto_Masivo($filtro_4,$fd_4,$fh_4){
	
			if( ( empty($fd_4) || empty($fh_4) ) ){
			
				
				$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
											es.nombre AS estado,de.nombre AS detalleestado,
											cp.nombre AS claseproceso,ubi.fecha_reparto,jd.nombre AS juzgadoreparto,
											ubi.iddespacho AS ponente
											FROM ((((ubicacion_expediente ubi
											LEFT JOIN detalle_estado de ON ubi.idestado = de.id)
											LEFT JOIN estado es ON de.idestado = es.id)
											LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
											LEFT JOIN juzgado_destino jd ON ubi.idjuzgado_reparto = jd.id)
											WHERE ubi.fecha_reparto IS NOT NULL 
											ORDER BY ubi.fecha_reparto DESC");
			}
			else{
			
		
				$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
											es.nombre AS estado,de.nombre AS detalleestado,
											cp.nombre AS claseproceso,ubi.fecha_reparto,jd.nombre AS juzgadoreparto,
											ubi.iddespacho AS ponente
											FROM ((((ubicacion_expediente ubi
											LEFT JOIN detalle_estado de ON ubi.idestado = de.id)
											LEFT JOIN estado es ON de.idestado = es.id)
											LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
											LEFT JOIN juzgado_destino jd ON ubi.idjuzgado_reparto = jd.id)
											WHERE ubi.fecha_reparto IS NOT NULL 
											AND ubi.fecha_reparto >= '$fd_4' AND ubi.fecha_reparto <= '$fh_4' 
											ORDER BY ubi.fecha_reparto DESC");
				
			}
		
			$listar->execute();
			  
			return $listar; 
	
	}  		
	
	public function listarTitulos($radicado,$beneficiario){  

	
	  	$listar = $this->db->prepare("select ubi.radicado,titulos.fecha,titulos.beneficiario,titulos.valor,titulos.fechapago 
		                              from titulos LEFT JOIN ubicacion_expediente ubi ON (idubicacion_expediente=ubi.id)
		                              where beneficiario like '%$beneficiario%' 
									  and idubicacion_expediente in (select id from ubicacion_expediente where radicado like '%$radicado%' )");
	
	  	$listar->execute();
	
	  	return $listar;
  	}
	
	public function SumalistarTitulos($radicado,$beneficiario){  

	
	  	$listar = $this->db->prepare("select SUM(valor) AS total
		                              from titulos LEFT JOIN ubicacion_expediente ubi ON (idubicacion_expediente=ubi.id)
		                              where beneficiario like '%$beneficiario%' 
									  and idubicacion_expediente in (select id from ubicacion_expediente where radicado like '%$radicado%' )");
	
	  	$listar->execute();
	
	  	return $listar;
  	}
	
	public function listarProcesosConMemorialIncorporado($tfiltro){
	
	
			$modelo = new excelModel();
		
			//------------------------------------------------------------------------------------------------------------------
			
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '7';
			$campoordenar         = 'id';
			$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
			$usuarios             = $datosusuarioacciones->fetch();
			$usuariosa			  = explode("////",$usuarios[usuario]);
			
			$filtrox_b = $usuariosa[0];
			//------------------------------------------------------------------------------------------------------------------
	
		
			$filtrox;
			
			$filtrof;
			$filtro1;
			
			$fechad    = trim($_GET['dato_1'])." 0:00:00";
			$fechah    = trim($_GET['dato_2'])." 23:59:59";
			
			$datox1    = trim($_GET['datox1']);
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (dc.fecha >= '$fechad' AND dc.fecha <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND ubi.idjuzgado_reparto = '$datox1' ";
			
			}
			
			
	
			$filtrox = $filtro1." ".$filtrof;
			
			
										  
			if($tfiltro == 1){
											  
						
					
					/*$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,
					                              t2.nombre AS solicitud
				
												  FROM (((detalle_correspondencia dc 
												  
												  INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												  LEFT JOIN correspondencia t1 ON dc.id_memorial = t1.id)
												  LEFT JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
												  
												  WHERE dc.idusuario ".$filtrox_b." ".$filtrox. "
												  AND (
												  dc.observacion LIKE '%MEMORIAL%' 
												  OR dc.observacion LIKE '%MEMORIALES%'
												  OR dc.observacion LIKE '%PASA A MEMORIALES%'
												  OR dc.observacion LIKE '%PASA PROCESO ANDRÉS GRAJALES CON%'
												  OR dc.observacion LIKE '%PASA PROCESO ANDRÃ‰S GRAJALES CON%' 
												  OR dc.observacion LIKE '%PASA PROCESO ANDRES GRAJALES CON%'
												  OR dc.observacion LIKE '%SE PASA ANDRÉS GRAJALES CON%'
												  OR dc.observacion LIKE '%SE PASA ANDRÃ‰S GRAJALES CON%'
												  OR dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%')
												  AND (dc.observacion NOT LIKE '%CONTADOR%' OR dc.observacion NOT LIKE '%110%')
												  AND (dc.observacion NOT LIKE '%DEYANIRA%')
												  AND (
												  			dc.observacion NOT LIKE '%EXPEDIENTE EN DESPACHO%' 
															
													   )
													   
												  AND (
												  			
															dc.observacion NOT LIKE '%SE AGREGA MEMORIAL AL EXPEDIENTE, ID MEMORIAL:%'
													   )
													   
													   
												 
												  GROUP BY ubi.id
												  ORDER BY ubi.radicado,dc.fecha");*/	
												  
						
						
					
					
					$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,t2.nombre AS solicitud
												  FROM (((detalle_correspondencia dc 
												  
												  INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												  LEFT JOIN correspondencia t1 ON dc.id_memorial = t1.id)
												  LEFT JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
												  
												  WHERE dc.id >= 1 ".$filtrox. "
												  AND ((dc.a_despacho = 1)
												  OR (/*dc.a_despacho IS NULL AND*/ dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
												  AND dc.revisasecretaria = 1
												  AND (ubi.fechasalida IS NULL OR ubi.fechasalida = '0000-00-00')
												  GROUP BY ubi.id
												  ORDER BY ubi.radicado,dc.fecha");
					
												  				  		
												  
												  
												  		
			}	  
				
				
			if($tfiltro == 2){
											  
						
					
					/*$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,
					                              t2.nombre AS solicitud
				
												  FROM (((detalle_correspondencia dc 
												  
												  INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												  LEFT JOIN correspondencia t1 ON dc.id_memorial = t1.id)
												  LEFT JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
												  
												  WHERE dc.idusuario ".$filtrox_b." ".$filtrox. "
												  AND (dc.observacion LIKE '%MEMORIAL%' 
												  OR dc.observacion LIKE '%MEMORIALES%'
												  OR dc.observacion LIKE '%PASA A MEMORIALES%'
												  OR dc.observacion LIKE '%PASA PROCESO ANDRÉS GRAJALES CON%'
												  OR dc.observacion LIKE '%PASA PROCESO ANDRÃ‰S GRAJALES CON%' 
												  OR dc.observacion LIKE '%PASA PROCESO ANDRES GRAJALES CON%'
												  OR dc.observacion LIKE '%SE PASA ANDRÉS GRAJALES CON%'
												  OR dc.observacion LIKE '%SE PASA ANDRÃ‰S GRAJALES CON%'
												  OR dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%')
												  AND (dc.observacion NOT LIKE '%CONTADOR%' OR dc.observacion NOT LIKE '%110%')
												  AND (dc.observacion NOT LIKE '%DEYANIRA%')
												  
												  AND (
												  			dc.observacion NOT LIKE '%EXPEDIENTE EN DESPACHO%' 
															
													   )
													   
												  AND (
												  			
															dc.observacion NOT LIKE '%SE AGREGA MEMORIAL AL EXPEDIENTE, ID MEMORIAL:%'
													   )
													   
												   
												  
												  
												  ORDER BY ubi.radicado,dc.fecha");*/			
												  
												  
					$listar = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,t2.nombre AS solicitud
												  FROM (((detalle_correspondencia dc 
												  
												  INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												  LEFT JOIN correspondencia t1 ON dc.id_memorial = t1.id)
												  LEFT JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
												  
												  WHERE dc.id >= 1 ".$filtrox. "
												  AND (ubi.fechasalida IS NULL OR ubi.fechasalida = '0000-00-00')
												  AND dc.revisasecretaria = 1
												  AND ((dc.a_despacho = 1)
												  OR (/*dc.a_despacho IS NULL AND*/ dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
												  /*GROUP BY ubi.id*/
												  ORDER BY ubi.radicado");							  
												  		
			}	
				
									 
			$listar->execute();
	
	  		return $listar;
	
	}
	
	public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}


  /*------------------------------ LISTADO CORRESPONDECIA ---------------------------------------*/

  /***********************************************************************************/

  public function listarCorrespondencia()

  {
	 

$fechai					= $_GET['nombre1']; 
$fechaf					= $_GET['nombre2']; 
$tipo_documento			= $_GET['nombre3']; 
$solicitud				= $_GET['nombre4']; 
$idjuzgado				= $_GET['nombre5']; 
$radicado				= $_GET['nombre6']; 
$idjuzgadodestino		= $_GET['nombre7']; 
$idusuario				= $_GET['nombre8']; 
$peticionario			= $_GET['nombre9']; 
$fechaei				= $_GET['nombre10']; 
$fechaef				= $_GET['nombre11'];

//ADICIONADO POR JORGE ANDRES VALENCIA EL 25 DE FEBRERO DEL 2016 
//PARA LA APLICAION DEL NUEVO MODULO INCORPORA MEMORIAL AL PROCESO
//$fechaii				= $_GET['nombre10b']; 
//$fechaif				= $_GET['nombre11b']; 

//Se Incorpora Expediente al Proceso
$siep				    = $_GET['nombre13'];

//$idjuzgadoreparto		= $_GET['nombre14']; 
 
$f1=$f2=$f3=$f4=$f5=$f6="";


if($fechai!='')
{
$fechai = $fechai.' 00:00:00';
$fechaf = $fechaf.' 23:59:59';
$f1=" and(corr.fecha_registro >= '$fechai' and corr.fecha_registro<='$fechaf')";
}
if($fechaei!='')
{
$fechaei = $fechaei.' 00:00:00';
$fechaef = $fechaef.' 23:59:59';
$f2=" and (corr.fecha_entrega >= '$fechaei' and corr.fecha_entrega<='$fechaef')";
}
if($idjuzgadodestino!='')
{
$f3=" and corr.idjuzgadodestino like '%$idjuzgadodestino%'";
}

/*if($fechaii!='')
{


	$f5=" and (corr.fecha_incorpora >= '$fechaii' and corr.fecha_incorpora <= '$fechaif') 
	      and (dc.observacion LIKE '%SE PASA PROCESO ANDRES GRAJALES PARA EL JUZGADO%' OR
		  dc.observacion LIKE '%SE PASA PROCESO ANDRÃ‰S GRAJALES PARA EL JUZGADO%')";
}*/

//Se Incorpora Expediente al Proceso
if($siep != '' && ($siep == 'si' || $siep == 'no'))
{
	if($siep == 'si'){$siep = 1; $f4 = " and corr.incorporaexpediente = '$siep'";}
	else{$f4 = " and corr.incorporaexpediente IS NULL";}

}

/*if($idjuzgadoreparto != '')
{
	$f6 = " and ubi.idjuzgado_reparto = '$idjuzgadoreparto'";
}*/

	//ASI ESTABA Y FUNCIONABA A LA FECHA 26 DE FEBRERO 2016
	//SIN EL FILTRO $F6, YA QUE ESTE FILTRO SE APLICA PARA QUE SE 
	//SEPA CUAL ES EL JUZGADO AL CUAL ES ASIGNADO EL PROCESO 1 O 2
 /*$listar = $this->db->prepare(" select DISTINCT corr.id, corr.fecha_registro,corr.radicado,corr.peticionario,corr.tipo_documento,corr.tiene_expediente,
								juz.nombre as juzgado,juzdest.nombre as destino,corr.fecha_entrega,sol.nombre as solicitud,usu.empleado, 
								corr.folios,sol.idprioridad, sol.id as idsol,corr.generado,
								corr.cedula,corr.telefono,corr.incorporaexpediente AS incorporado,corr.observacionesm,ubi.idjuzgado_reparto     
								from correspondencia corr 
								inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
								left join juzgado_destino juzdest on (corr.idjuzgadodestino=juzdest.id)
								inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
								inner join pa_usuario usu on (corr.idusuario=usu.id)
								inner join ubicacion_expediente ubi on (corr.idubicacionexpediente = ubi.id)
								inner join detalle_correspondencia dc on (ubi.id = dc.idcorrespondencia)
								where corr.tipo_documento like '%$tipo_documento%' and sol.id like '%$solicitud%' and corr.idjuzgado like '%$idjuzgado%' 
								and corr.radicado like '%$radicado%' and corr.peticionario like '%$peticionario%' 
								and corr.idusuario like '%$idusuario%'".$f1.$f2.$f3.$f4.$f5.$f6." order by corr.idjuzgado, corr.radicado ");*/
								
								
		
		
	
	$listar = $this->db->prepare(" select corr.id, corr.fecha_registro,corr.radicado,corr.peticionario,corr.tipo_documento,corr.tiene_expediente,
									juz.nombre as juzgado,juzdest.nombre as destino,corr.fecha_entrega,sol.nombre as solicitud,usu.empleado, corr.folios,sol.idprioridad, sol.id as idsol,
									corr.generado, corr.existe     
									from correspondencia corr 
									inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
									left join juzgado_destino juzdest on (corr.idjuzgadodestino=juzdest.id)
									inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
									inner join pa_usuario usu on (corr.idusuario=usu.id)
									where corr.tipo_documento like '%$tipo_documento%' and sol.id like '%$solicitud%' and corr.idjuzgado like '%$idjuzgado%' 
									and corr.radicado like '%$radicado%' and corr.peticionario like '%$peticionario%' 
									and corr.idusuario like '%$idusuario%'".$f1.$f2.$f3.$f4." order by corr.radicado ");
 
 
 
   	  $listar->execute();
	  
	  return $listar;

   

  }	
    /***********************************************************************************/

  /*------------------------------  Filtro Solicitudes usuarios  ---------------------------------*/

  /***********************************************************************************/

  public function ListadoSolicitudesUsuarios()

  {

$fechai					= $_GET['nombre1']; 
$fechaf					= $_GET['nombre2']; 
$solicitud				= $_GET['nombre3']; 
$radicado				= $_GET['nombre4']; 
$peticionario			= $_GET['nombre5']; 
$cedula 				= $_GET['nombre6']; 
$idusuarioresuelve		= $_GET['nombre7']; 
$idusuarioregistra		= $_GET['nombre8']; 
$fechair     			= $_GET['nombre9']; 
$fechafr				= $_GET['nombre10']; 
$resuelto				= $_GET['nombre11']; 
$consecutivo			= $_GET['nombre12']; 

$f1=$f2=$f3="";


if($fechai!='')
{
$fechai = $fechai.' 00:00:00';
$fechaf = $fechaf.' 23:59:59';
$f1=" and(sol.fecha >= '$fechai' and sol.fecha<='$fechaf')";
}
if($fechair!='')
{
$fechair = $fechair.' 00:00:00';
$fechafr = $fechafr.' 23:59:59';
$f2=" and (sol.fecha_entrega >= '$fechair' and sol.fecha_entrega<='$fechafr')";
}
if($idusuarioresuelve!='')
{
$f3=" and sol.idusuarioresuelve like '%$idusuarioresuelve%'";
}


 $listar = $this->db->prepare("select sol.id as idsol, sol.fecha,sol.solicitud,sol.radicado_consultar,sol.peticionario,sol.consecutivo,sol.cedula,sol.telefono,usu.empleado,sol.fecha_resuelve,res.empleado as usures,sol.resolvio,sol.descripcion,sol.ubicacion,sol.fecha_ubicacion 
from solicitud sol
inner join pa_usuario usu on (usu.id=sol.idusuarioregistra)
left join pa_usuario res on (res.id=sol.idusuarioresuelve)
where sol.solicitud like '%$solicitud%' and sol.radicado_consultar like '%$radicado%' and sol.peticionario like '%$peticionario%' and sol.cedula like '%$cedula%' and sol.idusuarioregistra like '%$idusuarioregistra%' and sol.resolvio like '%$resuelto%'
and sol.consecutivo like '%$consecutivo%'".$f1.$f2.$f3." order by sol.radicado_consultar");
   	  $listar->execute();
	  
	  return $listar;
	
 	


  

  }
  
  

  /*------------------------------ Juzgados de acuerdo al área seleccionada ---------------------------------------*/

  /***********************************************************************************/

  public function listarAreasJuzgados()

  {
	  $area =  $_POST['juzgado'];
	  $area1 = explode('-',$area);
	  $area2 = $area1[0];
	  $i = 1;

	  $listar = $this->db->prepare("select * from pa_juzgado where idarea ='$area2' ");

	  $listar->execute();
	  
	  while($idE = $listar->fetch())
		{
			
			$vector[$i]=$idE[nombre];
			$i= $i+1;
		}
	  

	  return $vector; 

   

  }	
  /*------------------------------Filtro ubicación Expedientes ---------------------------------------*/

  /***********************************************************************************/
  public function FiltroUbicacionExpedientes()

  {

//ini_set('max_execution_time', 24000); //240 segundos = 4 minutos

//FECHA PARA REPARTO
$fechai					= $_GET['nombre1']; 
$fechaf					= $_GET['nombre2']; 

$fechair				= $_GET['nombre16']; 
$fechafr				= $_GET['nombre17'];

$posicion				= $_GET['nombre3']; 
$radicado				= $_GET['nombre4']; 
$piso				    = $_GET['nombre5']; 
$estado   				= $_GET['nombre6']; 
$juzgado				= $_GET['nombre7']; 
$ubicacion				= $_GET['nombre8']; 
$juzgadodestino			= $_GET['nombre9']; 

$cedula_demandante		= $_GET['nombre10'];
$demandante				= $_GET['nombre11'];
$cedula_demandado		= $_GET['nombre12'];
$demandado				= $_GET['nombre13'];

$usuario				= $_GET['nombre20'];
$juzgadoreparto		    = $_GET['nombre21'];




$f1=$f2=$f3=$f4=$f5=$f6=$f7=$f8=$f9=$f10=$f11=$f12=$f13=$f14="";


if($fechai!='')
{

$f1=" and(ubi.fecha_reparto >= '$fechai' and ubi.fecha_reparto<='$fechaf')";
}
if($fechair!='')
{

$f13=" and(ubi.fecha >= '$fechair' and ubi.fecha<='$fechafr')";
}

/*if($juzgadodestino!=''){
 $f3="AND juzgadodestino.nombre LIKE '%$juzgadodestino%'";
}*/
if($juzgadodestino!=''){
 $f3="AND (ubi.idjuzgado_reparto = '$juzgadodestino' OR ubi.idjuzgadodestino = '$juzgadodestino')";
}
if($ubicacion=='prestado')
{
	
	$f2 = " and ubi.fechasalida is not null and ubi.fechasalida != '0000-00-00'";
}
if($ubicacion=='archivo')
{
	
	$f2 = "and ubi.fechasalida is null and ubi.fechasalida = '0000-00-00'";
}
if($ubicacion == 'con fecha de salida')
{
	
	$f2 = "and ubi.fechasalida IS NOT NULL and ubi.fechasalida != '0000-00-00'";
}

if($piso!=''){
 $f4=" AND ubi.piso LIKE '%$piso%'";
}

if($posicion!=''){
 $f5=" AND ubi.posicion LIKE '%$posicion%'";
}
if($estado!=''){
 $f6=" AND est.id = '$estado'";
}
if($juzgado!=''){
 $f7=" AND juz.nombre LIKE '%$juzgado%'";
}
if($demandante!=''){
 $f8="  AND ubi.demandante LIKE '%$demandante%'";
}
if($cedula_demandante!=''){
 $f9=" AND ubi.cedula_demandante LIKE '%$cedula_demandante%'";
}
if($demandado!=''){
 $f10="   AND ubi.demandado LIKE '%$demandado%'";
}
if($cedula_demandado!=''){
 $f11=" AND ubi.cedula_demandado LIKE '%$cedula_demandado%'";
}
if($usuario!=''){

//SE CIERRA ESTA LINEA YA QUE DE ESTA FORMA
 //LA CONSULTA TRAERIA INFORMACION DE ESTA FORMA
 //SI SOLO SE ESTA CONSULTANDO POR EL USURIO CON idusuario = 8
 //TAMBIEN TRAERIA USUARIOS COMO EL 18,28,38..... YA QUE AL USAR
 //EN LA CONSULTA '%$usuario%' TRAE REGISTROS QUE EMPIEZEN CON 8 Y
 //TERMINEN CON 8
 
 //$f12=" AND ubi.idusuario LIKE '%$usuario%'";
 
 $f12=" AND ubi.idusuario = '$usuario'";
}
/*if($juzgadoreparto!=''){
 $f14="AND juzgadoreparto.nombre LIKE '%$juzgadoreparto%'";
}*/


ini_set('max_execution_time', 240); //240 segundos = 4 minutos


 $listar = $this->db->prepare("SELECT ubi.id AS idubi,ubi.idusuario,  ubi.fecha,ubi.radicado, ubi.piso,
est.nombre as estados, juz.nombre as juzgado, ubi.fechasalida, juzgadodestino.nombre, ubi.fechadevolucion,
juzgadodestino.nombre as juzgadodestino, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado, ubi.demandado,
juzgadoreparto.nombre as juzgadoreparto, ubi.fecha_reparto, claseproceso.nombre as clase_proceso, ubi.observaciones,
ubi.observacion_salida,ubi.posicion,
usua.empleado AS usuario_archivo,ubi.fechaquearchiva AS fecha_archivo,ubi.observacion_archivo AS observacion_archivo
FROM ubicacion_expediente ubi
LEFT JOIN detalle_estado est ON (ubi.idestado = est.id)
LEFT JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
LEFT JOIN juzgado_destino juzgadodestino ON (ubi.idjuzgadodestino = juzgadodestino.id)
LEFT JOIN juzgado_destino juzgadoreparto ON (ubi.idjuzgado_reparto = juzgadoreparto.id)
LEFT JOIN pa_clase_proceso claseproceso ON (ubi.idclase_proceso = claseproceso.id)
LEFT JOIN pa_usuario usua ON (ubi.userquearchiva = usua.id)
WHERE ubi.radicado LIKE '%$radicado%' ".$f1.$f2.$f3.$f4.$f5.$f6.$f7.$f8.$f9.$f10.$f11.$f12.$f13.$f14."      ORDER BY ubi.fecha");

   	  $listar->execute();
	  
	  return $listar; 
  }   
  
  
   /*------------------------------Filtro ubicación Expedientes ---------------------------------------*/

  /***********************************************************************************/
  public function FiltroUbicacionExpedientesDetalleObservaciones()

  {

		$fechai					= $_GET['nombre1']; 
		$fechaf					= $_GET['nombre2']; 
		$fechair				= $_GET['nombre16']; 
		$fechafr				= $_GET['nombre17'];
		$posicion				= $_GET['nombre3']; 
		$radicado				= $_GET['nombre4']; 
		$piso				    = $_GET['nombre5']; 
		$estado   				= $_GET['nombre6']; 
		$juzgado				= $_GET['nombre7']; 
		$ubicacion				= $_GET['nombre8']; 
		$juzgadodestino			= $_GET['nombre9']; 
		$cedula_demandante		= $_GET['nombre10'];
		$demandante				= $_GET['nombre11'];
		$cedula_demandado		= $_GET['nombre12'];
		$demandado				= $_GET['nombre13'];
		$usuario				= $_GET['nombre20'];
		$juzgadoreparto		    = $_GET['nombre21'];




		$f1=$f2=$f3=$f4=$f5=$f6=$f7=$f8=$f9=$f10=$f11=$f12=$f13=$f14="";


		if($fechai!='')
		{
		
		$f1=" and(ubi.fecha_reparto >= '$fechai' and ubi.fecha_reparto<='$fechaf')";
		}
		if($fechair!='')
		{
		
		//$f13=" and(ubi.fecha >= '$fechair' and ubi.fecha<='$fechafr')";
		
		$f13=" and ( DATE(dc.fecha) >= '$fechair' and DATE(dc.fecha) <= '$fechafr')";
		}
		
		if($juzgadodestino!=''){
		 $f3="AND juzgadodestino.nombre LIKE '%$juzgadodestino%'";
		}
		if($ubicacion=='prestado')
		{
			
			$f2 = " and fechasalida is not null ";
		}
		if($ubicacion=='archivo')
		{
			
			$f2 = "and fechasalida is  null";
		}
		
		if($piso!=''){
		 $f4=" AND ubi.piso LIKE '%$piso%'";
		}
		
		if($posicion!=''){
		 $f5=" AND ubi.posicion LIKE '%$posicion%'";
		}
		if($estado!=''){
		 $f6=" AND est.id = '$estado'";
		}
		if($juzgado!=''){
		 $f7=" AND juz.nombre LIKE '%$juzgado%'";
		}
		if($demandante!=''){
		 $f8="  AND ubi.demandante LIKE '%$demandante%'";
		}
		if($cedula_demandante!=''){
		 $f9=" AND ubi.cedula_demandante LIKE '%$cedula_demandante%'";
		}
		if($demandado!=''){
		 $f10="   AND ubi.demandado LIKE '%$demandado%'";
		}
		if($cedula_demandado!=''){
		 $f11=" AND ubi.cedula_demandado LIKE '%$cedula_demandado%'";
		}
		if($usuario!=''){
		 
		 //$f12=" AND ubi.idusuario LIKE '%$usuario%'";
		 
		 $f12=" AND ubi.idusuario = '$usuario'";
		 
		}
		if($juzgadoreparto!=''){
		 $f14="AND juzgadoreparto.nombre LIKE '%$juzgadoreparto%'";
		}
		
		ini_set('max_execution_time', 240000000); //240 segundos = 4 minutos


		$listar = $this->db->prepare("	SELECT ubi.id AS idubi,ubi.idusuario,  ubi.fecha,ubi.radicado, ubi.piso, est.nombre as estados,
										juz.nombre as juzgado, ubi.posicion, ubi.fechasalida, juzgadodestino.nombre, ubi.fechadevolucion,
										juzgadodestino.nombre as juzgadodestino, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado,
										ubi.demandado, juzgadoreparto.nombre as juzgadoreparto, ubi.fecha_reparto, claseproceso.nombre as clase_proceso,
										ubi.observaciones,ubi.observacion_salida,dc.fecha as fechaobservacion,dc.observacion as observacion,pu.empleado as usuario,
										usua.empleado AS a1,ubi.fechaquearchiva AS a2,ubi.observacion_archivo AS a3
										FROM ubicacion_expediente ubi
										LEFT JOIN detalle_estado est ON (ubi.idestado = est.id)
										LEFT JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
										LEFT JOIN juzgado_destino juzgadodestino ON (ubi.idjuzgadodestino = juzgadodestino.id)
										LEFT JOIN juzgado_destino juzgadoreparto ON (ubi.idjuzgado_reparto = juzgadoreparto.id)
										LEFT JOIN pa_clase_proceso claseproceso ON (ubi.idclase_proceso = claseproceso.id)
										INNER JOIN detalle_correspondencia dc ON (ubi.id = dc.idcorrespondencia)
										LEFT JOIN pa_usuario pu ON (dc.idusuario = pu.id)
										LEFT JOIN pa_usuario usua ON (ubi.userquearchiva = usua.id)
										WHERE ubi.radicado LIKE '%$radicado%' ".$f1.$f2.$f3.$f4.$f5.$f6.$f7.$f8.$f9.$f10.$f11.$f12.$f13.$f14."      
										ORDER BY dc.idcorrespondencia,dc.fecha ");
										
   	  $listar->execute();
	  
	  return $listar; 
  }   
  
  
  public function FiltroDetalleObservaciones_USER()

  {

		
		$fechair = $_GET['nombre1']; 
		$fechafr = $_GET['nombre2'];
		$usuario = $_GET['nombre3'];
		
		$f1=$f2="";


		if ( !empty($fechair) && !empty($fechafr) ) {
			
			$f1 =" AND ( DATE(dc.fecha) >= '$fechair' AND DATE(dc.fecha) <= '$fechafr')";
				
		}
		
		
		if($usuario >= 1){
		  
		 	$f2 =" AND dc.idusuario = '$usuario'";
		 
		}
		else{
		
			$f2 = " ";
		}
		
		ini_set('max_execution_time', 240000000); //240 segundos = 4 minutos


		$listar = $this->db->prepare("	SELECT ubi.id AS idubi,ubi.idusuario,  ubi.fecha,ubi.radicado, ubi.piso, est.nombre as estados,
										juz.nombre as juzgado, ubi.posicion, ubi.fechasalida, juzgadodestino.nombre, ubi.fechadevolucion,
										juzgadodestino.nombre as juzgadodestino, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado,
										ubi.demandado, juzgadoreparto.nombre as juzgadoreparto, ubi.fecha_reparto, claseproceso.nombre as clase_proceso,
										ubi.observaciones,ubi.observacion_salida,dc.fecha as fechaobservacion,dc.observacion as observacion,pu.empleado as usuario,
										usua.empleado AS a1,ubi.fechaquearchiva AS a2,ubi.observacion_archivo AS a3
										FROM ubicacion_expediente ubi
										LEFT JOIN detalle_estado est ON (ubi.idestado = est.id)
										LEFT JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
										LEFT JOIN juzgado_destino juzgadodestino ON (ubi.idjuzgadodestino = juzgadodestino.id)
										LEFT JOIN juzgado_destino juzgadoreparto ON (ubi.idjuzgado_reparto = juzgadoreparto.id)
										LEFT JOIN pa_clase_proceso claseproceso ON (ubi.idclase_proceso = claseproceso.id)
										INNER JOIN detalle_correspondencia dc ON (ubi.id = dc.idcorrespondencia)
										LEFT JOIN pa_usuario pu ON (dc.idusuario = pu.id)
										LEFT JOIN pa_usuario usua ON (ubi.userquearchiva = usua.id)
										WHERE dc.id >= '1' ".$f1.$f2."      
										ORDER BY pu.empleado,dc.idcorrespondencia,dc.fecha");
										
   	  $listar->execute();
	  
	  return $listar; 
  }


/************************ Se obtiene un vector de oficios *************************************
************************************ en una fecha ************************************/
	
	public function obtenerOficios(){
		
		
		$fecha   = $_POST['fechai'];
		$juzgado = $_POST['todos'];
		$cont    = $_POST['contador'];
		$c       = $index=0;
		
		if(!isset($juzgado)){
		
			 while($c<$cont){
			  
				  if(isset($_POST['juz'.$c])){
				  
					$campo_l                = $_POST['juz'.$c];
				   
					$lista_juzgados[$index] = $campo_l;
					
					$index++;
				  }
				  
				  $c++;
			 
			 }
		}
		//print_r($lista_juzgados);
		
		$cont_list = count($lista_juzgados);
		$r         = 0;
		$temp      = $cont_list-1;
		
		while($r<$cont_list){
		
			 if($r!=$temp){
			 	$lista = $lista.$lista_juzgados[$r].",";
			 }
			 else{
			 	$lista = $lista.$lista_juzgados[$r];
			 }
			 
			 $r++;
		}
		
		$lista = '('.$lista.')';
		
		
		
		if($juzgado == 'Todos'){	
	
			$oficios = $this->db->prepare(" select concat(
											correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama,'/','O','-',correspondencia_otros.id
											) as nomdestino,
											concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,
											pa_juzgado.nombre as observaciones 
											from correspondencia_otros 
											inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio)
											inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
											where correspondencia_otros.esOficio_Telegrama='Oficio' and correspondencia_otros.fecha='$fecha'
											and correspondencia_otros.idmedionotificacion in (2,4,5) 
											ORDER BY correspondencia_otros.id ");
       }
	   else{
		 
		 	$oficios = $this->db->prepare(" select concat(
			                                correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama,'/','O','-',correspondencia_otros.id
											) as nomdestino,
											concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,
											pa_juzgado.nombre as observaciones 
											from correspondencia_otros 
											inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio)
											inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
											where correspondencia_otros.esOficio_Telegrama='Oficio' and correspondencia_otros.fecha='$fecha'
											and correspondencia_otros.idmedionotificacion in (2,4,5) and correspondencia_otros.idjuzgado in $lista 
											ORDER BY correspondencia_otros.id");		
		}
	   
 
		$oficios->execute();
		
		$i=0;
		$j=0;
		
		while($idE = $oficios->fetch()){
			
			$vector[$i][nomdestino]    = $idE[nomdestino];
			$vector[$i][ciudad]        = $idE[ciudad];
			$vector[$i][direccion]     = $idE[direccion];
			$vector[$i][observaciones] = $idE[observaciones];
			
			$i= $i+1;
		}
		
		//print_r($vector);
		
		if($juzgado=='Todos'){	
				
			$oficios1 = $this->db->prepare("select concat(
			                                acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama,'/','T','-',actuacion.id
											) as nomdestino,
											concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,
											pa_juzgado.nombre as observaciones
											from actuacion_tutela as actuacion
											inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id)
											inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
											inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio)
											inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado)
											where actuacion.esOficio_Telegrama='Oficio' and actuacion.fecha_envio='$fecha'
											and actuacion.idmedionotificacion in (2,4,5)
											ORDER BY actuacion.id");
		}
		else{
		
			$oficios1 = $this->db->prepare("select concat(
			                                acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama,'/','T','-',actuacion.id
											) as nomdestino,
											concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,
											pa_juzgado.nombre as observaciones
											from actuacion_tutela as actuacion
											inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id)
											inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
											inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio)
											inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado)
											where actuacion.esOficio_Telegrama='Oficio' and actuacion.fecha_envio='$fecha'
											and actuacion.idmedionotificacion in (2,4,5) and ct.idjuzgado in  $lista 
											ORDER BY actuacion.id");
		}
		
		$oficios1->execute();
		
		while($idE2 = $oficios1->fetch()){
		
			$vector[$i][nomdestino]    = $idE2[nomdestino];
			$vector[$i][ciudad]        = $idE2[ciudad];
			$vector[$i][direccion]     = $idE2[direccion];
			$vector[$i][observaciones] = $idE2[observaciones];
			
			$i= $i+1;
		}
			
		//print_r($vector);	
		return $vector;
		
	}




/************************ Se obtiene un vector de telegramas *************************************
************************************ en una fecha ************************************/
	
	public function obtenerTelegramas(){	
	
		
		$fecha   = $_POST['fechai'];
		$juzgado = $_POST['todos'];
		$cont    = $_POST['contador'];
		$c       = $index=0;
		
		if(!isset($juzgado)){
		
			 while($c<$cont){
			  
				  if(isset($_POST['juz'.$c])){
				  
				   $campo_l= $_POST['juz'.$c];
				   
				   $lista_juzgados[$index]=$campo_l;
				   $index++;
				   
				  }
				  
				  $c++;
			 
			 }
		}
		//print_r($lista_juzgados);
		
		$cont_list = count($lista_juzgados);
		$r         = 0;
		$temp      = $cont_list-1;
		
		while($r<$cont_list){
		
			 if($r!=$temp){
			 
			 	$lista = $lista.$lista_juzgados[$r].",";
			 }
			 else{
			 
			  	$lista = $lista.$lista_juzgados[$r];
			 }
			 
			 $r++;
			 
		}
		
		$lista = '('.$lista.')';
		
		if($juzgado=='Todos'){			
		
			$telegramas = $this->db->prepare("select concat(
			                                  correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama,'/','O','-',correspondencia_otros.id
											  ) as nomdestino,
											  concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,
											  pa_juzgado.nombre as observaciones 
											  from correspondencia_otros 
											  inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio)
											  inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											  inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
											  where correspondencia_otros.esOficio_Telegrama='Telegrama' and correspondencia_otros.fecha='$fecha'
											  and correspondencia_otros.idmedionotificacion in (2,4,5) 
											  ORDER BY correspondencia_otros.id ");
		}
		else{

			$telegramas = $this->db->prepare("select concat(
			                                  correspondencia_otros.destinatario,' ',radicado,'/',correspondencia_otros.oficio_telegrama,'/','O','-',correspondencia_otros.id
											  ) as nomdestino,
											  concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,correspondencia_otros.direccion as direccion,
											  pa_juzgado.nombre as observaciones 
											  from correspondencia_otros 
											  inner join pa_municipio  on (pa_municipio.id=correspondencia_otros.idmunicipio)
											  inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
											  inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
											  where correspondencia_otros.esOficio_Telegrama='Telegrama' and correspondencia_otros.fecha='$fecha'
											  and correspondencia_otros.idmedionotificacion in (2,4,5) and correspondencia_otros.idjuzgado in $lista
											  ORDER BY correspondencia_otros.id");
			  
		}
		
		$telegramas->execute();
		
		$i=0;
		$j=0;
		
		while($idE = $telegramas->fetch()){
		
			$vector[$i][nomdestino]    = $idE[nomdestino];
			$vector[$i][ciudad]        = $idE[ciudad];
			$vector[$i][direccion]     = $idE[direccion];
			$vector[$i][observaciones] = $idE[observaciones];
			
			$i= $i+1;
		}	
		if($juzgado=='Todos'){			
		
			$telegramas1 = $this->db->prepare(" select concat(
			                                    acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama,'/','T','-',actuacion.id
												) as nomdestino,
												concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,
												pa_juzgado.nombre as observaciones
												from actuacion_tutela as actuacion
												inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id)
												inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
												inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio)
												inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
												inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado)
												where actuacion.esOficio_Telegrama='Telegrama' and actuacion.fecha_envio='$fecha'
												and actuacion.idmedionotificacion in (2,4,5) 
												ORDER BY actuacion.id");
		}
		else{
		
			$telegramas1 = $this->db->prepare(" select concat(
			                                    acc.accionante_accionado_vinculado,' ',ct.radicado,'/',actuacion.oficio_telegrama,'/','T','-',actuacion.id
												) as nomdestino,
												concat(pa_municipio.nombre,' - ',pa_departamento.nombre) as ciudad,actuacion.direccion as direccion,
												pa_juzgado.nombre as observaciones
												from actuacion_tutela as actuacion
												inner join accionante_accionado_vinculado as acc ON (actuacion.idaccionado_vinculado_accionante_tut=acc.id)
												inner join correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
												inner join pa_municipio  on (pa_municipio.id=actuacion.idmunicipio)
												inner join pa_departamento on (pa_departamento.id=pa_municipio.iddepartamento)
												inner join pa_juzgado on (pa_juzgado.id=ct.idjuzgado)
												where actuacion.esOficio_Telegrama='Telegrama' and actuacion.fecha_envio='$fecha'
												and actuacion.idmedionotificacion in (2,4,5) and ct.idjuzgado in $lista 
												ORDER BY actuacion.id");
		}

 
		$telegramas1->execute();
		
		while($idE2 = $telegramas1->fetch()){
		
			$vector[$i][nomdestino]    = $idE2[nomdestino];
			$vector[$i][ciudad]        = $idE2[ciudad];
			$vector[$i][direccion]     = $idE2[direccion];
			$vector[$i][observaciones] = $idE2[observaciones];
			
			$i= $i+1;
		}	
		
	
		//print_r $vector;			
		return $vector;
		
	}

  /*------------------------------ obtener tutelas radicadas rango fecha ---------------------------------------*/

  /***********************************************************************************/

  public function listarradicadosTutelas()

  {
  
  $fechai   = $_POST['fechai'];
  $fechaf  =  $_POST['fechaf'];
  $i=0;

		  
	  
	  $listar = $this->db->prepare("select juz.id as idjuzgado,juz.idarea,juz.nombre as juznombre,are.nombre as nomarea,count(juz.id) as cantidad_tutelas from correspondencia_tutelas ct 
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
inner join pa_area are on (juz.idarea=are.id) 
where ct.Tutela_Incidente='Tutela' and  ct.fecha BETWEEN '$fechai' and '$fechaf'
group by juz.id
order by juz.idarea,juz.id");

	  $listar->execute();
 
	  
	  while($idE = $listar->fetch())
		{
			
			$i=$idE[idjuzgado];
			$vector[$i][idjuzgado]=$i;
			$vector[$i][idarea]=$idE[idarea];
			$vector[$i][nomarea]=$idE[nomarea];
			$vector[$i][juznombre]=$idE[juznombre];
			$vector[$i][cantidad_tutelas]=$idE[cantidad_tutelas];
			
		}

  $listar1 = $this->db->prepare("select DISTINCT ct.radicado,ct.Tutela_Incidente,actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, 
count(ct.radicado) as cantidad_tutelas
from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id)
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
where ct.Tutela_Incidente='Incidente' and actu.tipo_actuacion='Tutela' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf'
group by juz.id
order by juz.idarea, juz.id");

	  $listar1->execute();
 
	  
	  while($idE1 = $listar1->fetch())
		{
			
			$i=$idE1[idjuzgado];
			$vector[$i][cantidad_tutelas];
			$vector[$i][cantidad_tutelas]=$vector[$i][cantidad_tutelas]+$idE1[cantidad_tutelas];
			
		}	  

$listar2 = $this->db->prepare("select  actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, 
count(actu.idmedionotificacion) as cantidad_tutelas, medio.nombre as medio
from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id)
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
inner join pa_medionotificacion medio ON (actu.idmedionotificacion=medio.id)
where actu.tipo_actuacion='Tutela' and  actu.fecha_envio BETWEEN '$fechai' and '$fechaf'
group by juz.id,medio.id
order by juz.idarea, juz.id;");

	  $listar2->execute();
	  
	  	  while($idE2 = $listar2->fetch())
		{
			
			$i=$idE2[idjuzgado];
			$nombre=$idE2[medio];
		    if($nombre=='Correo Electronico')
			  $nombre='correo_electronico';
			  if($nombre=='Fax - Correo')
			  $nombre='fax_correo';
			    if($nombre==' Fax-Correo-Correo Electronico')
			  $nombre='fax_correo_correoelectronico';
			$vector[$i][$nombre]=$idE2[cantidad_tutelas];
					
		}			  


return $vector; 
   

  }

/*------------------------------ obtener incidentes radicadas rango fecha ---------------------------------------*/

  /***********************************************************************************/

  public function listarradicadosIncidentes()

  {
  
  $fechai   = $_POST['fechai'];
  $fechaf  =  $_POST['fechaf'];
  $i=0;

		  
	  
	  $listar = $this->db->prepare("select juz.id as idjuzgado,juz.idarea,juz.nombre as juznombre,are.nombre as nomarea,count(juz.id) as cantidad_tutelas from correspondencia_tutelas ct 
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
inner join pa_area are on (juz.idarea=are.id) 
where ct.Tutela_Incidente='Incidente' and  ct.fecha BETWEEN '$fechai' and '$fechaf'
group by juz.id
order by juz.idarea,juz.id");

	  $listar->execute();
 
	  
	  while($idE = $listar->fetch())
		{
			
			$i=$idE[idjuzgado];
			$vector[$i][idjuzgado]=$i;
			$vector[$i][idarea]=$idE[idarea];
			$vector[$i][nomarea]=$idE[nomarea];
			$vector[$i][juznombre]=$idE[juznombre];
			$vector[$i][cantidad_incidentes]=$idE[cantidad_tutelas];
			
		}

  $listar1 = $this->db->prepare("select DISTINCT ct.radicado,ct.Tutela_Incidente,actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, 
count(ct.radicado) as cantidad_tutelas
from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id)
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
where ct.Tutela_Incidente='Tutela' and actu.tipo_actuacion='Incidente' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf'
group by juz.id
order by juz.idarea, juz.id");

	  $listar1->execute();
 
	  
	  while($idE1 = $listar1->fetch())
		{
			
			$i=$idE1[idjuzgado];
			$vector[$i][cantidad_incidentes]=$vector[$i][cantidad_incidentes]+$idE1[cantidad_tutelas];
			
		}
		$listar2 = $this->db->prepare("select  actu.tipo_actuacion, juz.id as idjuzgado ,juz.idarea,juz.nombre as juznombre, 
count(actu.idmedionotificacion) as cantidad_tutelas, medio.nombre as medio
from correspondencia_tutelas ct  inner join accionante_accionado_vinculado acc on (acc.idcorrespondencia_tutelas=ct.id)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=acc.id)
inner join pa_juzgado juz on (juz.id=ct.idjuzgado)
inner join pa_medionotificacion medio ON (actu.idmedionotificacion=medio.id)
where actu.tipo_actuacion='Incidente' and  actu.fecha_envio BETWEEN '$fechai' and '$fechaf'
group by juz.id,medio.id
order by juz.idarea, juz.id;");

	  $listar2->execute();
	  
	  	  while($idE2 = $listar2->fetch())
		{
			
			$i=$idE2[idjuzgado];
			$nombre=$idE2[medio];
			if($nombre=='Correo Electronico')
			  $nombre='correo_electronico';
			  if($nombre=='Fax - Correo')
			  $nombre='fax_correo';
			    if($nombre==' Fax-Correo-Correo Electronico')
			  $nombre='fax_correo_correoelectronico';			 
			$vector[$i][$nombre]=$idE2[cantidad_tutelas];
					
		}



return $vector; 
   

  }	
	

 





















 }

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//---------------------LINEA AGREGADA POR JORGE ANDRES VALENCIA OROZCO----------------------------------

//PARA EVENTOS
$datos_reporte = explode("//////////",trim($_GET['datos_reporte']));

$id_reporte = $datos_reporte[0];
$filtro     = $datos_reporte[1];
$fd         = $datos_reporte[2];  
$fh         = $datos_reporte[3];

//PARA ACCTUACIONES
$datos_reporte_2 = explode("//////////",trim($_GET['datos_reporte_2']));

$id_reporte_2 = $datos_reporte_2[0];
$filtro_2     = $datos_reporte_2[1];
$fd_2         = $datos_reporte_2[2];  
$fh_2         = $datos_reporte_2[3];

//PARA EMPLEADOS INGRESOS Y SALIDAS
$datos_reporte_3 = explode("//////////",trim($_GET['datos_reporte_3']));

$id_reporte_3 = $datos_reporte_3[0];
$filtro_3     = $datos_reporte_3[1];
$fd_3         = $datos_reporte_3[2];  
$fh_3         = $datos_reporte_3[3];


//PARA REPARTO MASIVO
$datos_reporte_4 = explode("//////////",trim($_GET['datos_reporte_4']));

$id_reporte_4 = $datos_reporte_4[0];
$filtro_4     = $datos_reporte_4[1];
$fd_4         = $datos_reporte_4[2];  
$fh_4         = $datos_reporte_4[3];

//------------------------------------------------------------------------------------------------------

$radicado     = $_GET['nombret1'];
$beneficiario = $_GET['nombret2'];

$t_reporte = $_GET['nombre']; 


$tfiltro    = $_GET['tfiltro'];

//REPORTE 4-72
if($t_reporte==1)
{

$data= new excelModel();
$data1= new excelModel();

$vector_datos            = $data->obtenerOficios();
$cont                    = count($vector_datos);
$vector_datos_telegramas = $data1->obtenerTelegramas();
$cont_tele               = count($vector_datos_telegramas);

//print_r($vector_datos);

 
$objPHPExcel = new PHPExcel();
// Establecer propiedades
$objPHPExcel->getProperties()
->setCreator("Centro de Servicios")
->setLastModifiedBy("Centro de Servicios")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Documento Excel");

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
// Agregar Informacion

$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Nombre destinatario')
->setCellValue('B1', 'Ciudad')
->setCellValue('C1', utf8_encode('Dirección'))
->setCellValue('D1', utf8_encode('Teléfono'))
->setCellValue('E1', 'Peso')
->setCellValue('F1', 'Contenido')
->setCellValue('G1', 'Observaciones');
//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$j=0;
$i=2;

$registros_corte  = array();

while($j<$cont){


	$cadena_de_texto       = $vector_datos[$j][nomdestino];
	$cadena_buscada        = 'CORTE CONSTITUCIONAL';
	$posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
	
	if ($posicion_coincidencia === false) {
    	
		//echo "NO se ha encontrado la palabra deseada!!!!";
		
		
		$sheet1->setCellValue('A'.$i, utf8_encode($vector_datos[$j][nomdestino]));
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('B'.$i, utf8_encode($vector_datos[$j][ciudad]));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('C'.$i, utf8_encode($vector_datos[$j][direccion]));
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('D'.$i, '');
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('E'.$i, '20');
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('F'.$i, '');
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('G'.$i, utf8_encode($vector_datos[$j][observaciones]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$i = $i+1;
		
    } 
	else{
        
		 //echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;
		 
		$nombre_destinatario_1 = explode("/",$vector_datos[$j][nomdestino]);
		//PRIMERA POSICION DEL VECTOR EJEMPLO H. CORTE CONSTITUCIONAL 17001430300120190008300
		$primera_pos           = reset($nombre_destinatario_1);
		//ULTIMA POSICION DEL VECTOR EJEMPLO T-16833
		$ultima_pos            = end($nombre_destinatario_1);
									
		$pe2                   = explode("-",$ultima_pos);
		
		$oficio_telegrama      = $nombre_destinatario_1[1];
		
		//$nd_completo     .= $primera_pos." ";	
		//$oficio_telegrama = $nombre_destinatario_1[1];
		//$id_regis        .= $pe2[1]."-";
		
		
		if (in_array($oficio_telegrama,$registros_corte,true)){
		
			//echo "Match found";
			
			for($x = 0; $x < count($registros_corte); $x++){
			
				if($registros_corte[$x] == $oficio_telegrama){
				
					$armar                 = explode("/",$registros_corte[$x+1]);
					
					$nd_completo           = $primera_pos." ";	
					$oficio_telegrama      = $nombre_destinatario_1[1];
					$id_regis              = $pe2[1];
					
					$armar_2               = $armar[0].$nd_completo;
					$armar_3               = $armar[2]."-".$id_regis;
				
					//$armar_3               = substr($armar_3, 0, -1);
					$registros_corte[$x+1] = $armar_2."/".$oficio_telegrama."/".$armar_3;
					
					$nd_completo           = " ";	
					$oficio_telegrama      = " ";
					$id_regis              = " ";
			
					break;
				}
						
			}
			
			
		}
		else{
		
		  	//echo "Match not found";
			
			$registros_corte[] = "NUEVO";
			$registros_corte[] = $oficio_telegrama;
			
			$nd_completo      .= $primera_pos." ";	
			$oficio_telegrama  = $nombre_destinatario_1[1];
			$id_regis         .= $pe2[1]."-";
			
			$id_regis          = substr($id_regis, 0, -1);
			$nd_completo       = $nd_completo."/".$oficio_telegrama."/"."T"."-".$id_regis;
			
			$registros_corte[] = $nd_completo;
			$registros_corte[] = $vector_datos[$j][ciudad];
			$registros_corte[] = $vector_datos[$j][direccion];
			$registros_corte[] = '';
			$registros_corte[] = '20';
			$registros_corte[] = '';
			$registros_corte[] = $vector_datos[$j][observaciones];
			
			$nd_completo       = " ";	
			$oficio_telegrama  = " ";
			$id_regis          = " ";
			
			
		}
  
		
		
    }
	

	/*$sheet1->setCellValue('A'.$i, utf8_encode($vector_datos[$j][nomdestino]));
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('B'.$i, utf8_encode($vector_datos[$j][ciudad]));
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('C'.$i, utf8_encode($vector_datos[$j][direccion]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('D'.$i, '');
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('E'.$i, '20');
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('F'.$i, '');
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	$sheet1->setCellValue('G'.$i, utf8_encode($vector_datos[$j][observaciones]));
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);*/
	
	
	$j = $j+1;
	//$i = $i+1;
	
}

//$id_regis    = substr($id_regis, 0, -1);
//$nd_completo = $nd_completo."/".$oficio_telegrama."/"."T"."-".$id_regis;

//$sheet1->setCellValue('A'.$i, utf8_encode($nd_completo));
//$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

for($x = 0; $x < count($registros_corte); $x++){

	
	if($registros_corte[$x] == "NUEVO"){
	
		$nd_completo   = $registros_corte[$x + 2];
		$ciudad        = $registros_corte[$x + 3];
		$direccion     = $registros_corte[$x + 4];
		$observaciones = $registros_corte[$x + 8];
		
		$sheet1->setCellValue('A'.$i, utf8_encode($nd_completo));
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, utf8_encode($ciudad));
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('C'.$i, utf8_encode($direccion));
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('D'.$i, '');
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('E'.$i, '20');
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('F'.$i, '');
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		$sheet1->setCellValue('G'.$i, utf8_encode($observaciones));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$i = $i+1;
	}
	

}




$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');




// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('OFICIOS');

$sheet2 = $objPHPExcel->createSheet();
$sheet2->setTitle('TELEGRAMAS');
$sheet2->SetCellValue('A1', 'Nombre destinatario');
$sheet2->setCellValue('B1', 'Ciudad');
$sheet2->setCellValue('C1', utf8_encode('Dirección'));
$sheet2->setCellValue('D1', utf8_encode('Teléfono'));
$sheet2->setCellValue('E1', 'Peso');
$sheet2->setCellValue('F1', 'Contenido');
$sheet2->setCellValue('G1', 'Observaciones');
//->setCellValue('C2', '=sum(A2:B2)');

$sheet2->getStyle('A1')->applyFromArray($styleArray);
$sheet2->getStyle('B1')->applyFromArray($styleArray);
$sheet2->getStyle('C1')->applyFromArray($styleArray);
$sheet2->getStyle('D1')->applyFromArray($styleArray);
$sheet2->getStyle('E1')->applyFromArray($styleArray);
$sheet2->getStyle('F1')->applyFromArray($styleArray);
$sheet2->getStyle('G1')->applyFromArray($styleArray);

$sheet2->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );

$j=0;
$i=2;

$sheet2->getStyle('A1:G1')->applyFromArray($borders);
$sheet2->getColumnDimension('A')->setAutoSize('true');
$sheet2->getColumnDimension('B')->setAutoSize('true');
$sheet2->getColumnDimension('C')->setAutoSize('true');
$sheet2->getColumnDimension('D')->setAutoSize('true');
$sheet2->getColumnDimension('E')->setAutoSize('true');
$sheet2->getColumnDimension('F')->setAutoSize('true');
$sheet2->getColumnDimension('G')->setAutoSize('true');

while($j<$cont_tele)
{
$sheet2->setCellValue('A'.$i, utf8_encode($vector_datos_telegramas[$j][nomdestino]));
$sheet2->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('B'.$i, utf8_encode($vector_datos_telegramas[$j][ciudad]));
$sheet2->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('C'.$i, utf8_encode($vector_datos_telegramas[$j][direccion]));
$sheet2->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('D'.$i, '');
$sheet2->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('E'.$i, '20');
$sheet2->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('F'.$i, '');
$sheet2->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet2->setCellValue('G'.$i, utf8_encode($vector_datos_telegramas[$j][observaciones]));
$sheet2->getStyle('G'.$i)->applyFromArray($borders_nobold);


$j = $j+1;
$i=$i+1;
}


// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Planilla472.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}
if($t_reporte==2)
{

$data= new excelModel();
$data1= new excelModel();
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];

$vector_radicados_tutelas= $data->listarradicadosTutelas();
$vector_radicados_incidentes= $data1->listarradicadosIncidentes();
/*

print_r($vector_radicados_tutelas);
echo "<br>";
print_r($vector_radicados_incidentes);*/




$data= new excelModel();
$data1= new excelModel();

$area =  $_POST['juzgado'];
$area1 = explode('-',$area);
$area2 = $area1[1];
$fechai = $_POST['fechai'];
$fechaf = $_POST['fechaf'];
$ind=0;

$orden = array( 0 => 15, 1 => 16,);

//print_r($orden);

$indice =$orden[$ind];
$area= $vector_radicados_tutelas[$indice][nomarea];
$ca1= $vector_radicados_tutelas[15][cantidad_tutelas];
$ca2= $vector_radicados_tutelas[16][cantidad_tutelas];


$ci1= $vector_radicados_incidentes[15][cantidad_incidentes];
$ci2= $vector_radicados_incidentes[16][cantidad_incidentes];










$correo = array( 0 => $vector_radicados_tutelas[15][Correo]+$vector_radicados_incidentes[15][Correo], 1 => $vector_radicados_tutelas[16][Correo]+$vector_radicados_incidentes[16][Correo]
    );
	
$correo_e = array( 0 => $vector_radicados_tutelas[15][correo_electronico]+$vector_radicados_incidentes[15][correo_electronico], 1 => $vector_radicados_tutelas[16][correo_electronico]+$vector_radicados_incidentes[16][correo_electronico]
    );	

$fax = array( 0 => $vector_radicados_tutelas[15][Fax]+$vector_radicados_incidentes[15][Fax], 
			  1 => $vector_radicados_tutelas[16][Fax]+$vector_radicados_incidentes[16][Fax]			 		  
    );	

$fax_c = array( 0 => $vector_radicados_tutelas[15][fax_correo]+$vector_radicados_incidentes[15][fax_correo], 
				1 => $vector_radicados_tutelas[16][fax_correo]+$vector_radicados_incidentes[16][fax_correo]
    );	

$fax_c_c = array( 0 => $vector_radicados_tutelas[15][fax_correo_correoelectronico]+$vector_radicados_incidentes[15][fax_correo_correoelectronico], 1 => $vector_radicados_tutelas[16][fax_correo_correoelectronico]+$vector_radicados_incidentes[16][fax_correo_correoelectronico]
    );	

$personal = array( 0 => $vector_radicados_tutelas[15][Personal]+$vector_radicados_incidentes[15][Personal], 
				   1 => $vector_radicados_tutelas[16][Personal]+$vector_radicados_incidentes[16][Personal]  
	);
	
		
	
$total = array($correo[0]+$correo_e[0]+$fax[0]+$fax_c[0]+$fax_c_c[0]+$personal[0],
			   $correo[1]+$correo_e[1]+$fax[1]+$fax_c[1]+$fax_c_c[1]+$personal[1]
   );


$pe1=$vector_radicados_tutelas[15][Fax]+$vector_radicados_tutelas[15][Correo]+$vector_radicados_tutelas[15][Personal]+$vector_radicados_tutelas[15][correo_electronico]+$vector_radicados_tutelas[15][fax_correo]+$vector_radicados_tutelas[15][fax_correo_correoelectronico];

$pe2=$vector_radicados_tutelas[16][Fax]+$vector_radicados_tutelas[16][Correo]+$vector_radicados_tutelas[16][Personal]+$vector_radicados_tutelas[16][correo_electronico]+$vector_radicados_tutelas[16][fax_correo]+$vector_radicados_tutelas[16][fax_correo_correoelectronico];





$pei1=$vector_radicados_incidentes[15][Fax]+$vector_radicados_incidentes[15][Correo]+$vector_radicados_incidentes[15][Personal]+$vector_radicados_incidentes[15][correo_electronico]+$vector_radicados_incidentes[15][fax_correo]+$vector_radicados_incidentes[15][fax_correo_correoelectronico];

$pei2=$vector_radicados_incidentes[16][Fax]+$vector_radicados_incidentes[16][Correo]+$vector_radicados_incidentes[16][Personal]+$vector_radicados_incidentes[16][correo_electronico]+$vector_radicados_incidentes[16][fax_correo]+$vector_radicados_incidentes[16][fax_correo_correoelectronico];





error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

      date_default_timezone_set('America/Bogota'); 

$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();


$objPHPExcel->getActiveSheet()->mergeCells('A1:L1');


$objPHPExcel->getActiveSheet()->mergeCells('F2:L2');


$objPHPExcel->getActiveSheet()->mergeCells('A2:A3');

$objPHPExcel->getActiveSheet()->mergeCells('B2:B3');


$objPHPExcel->getActiveSheet()->mergeCells('C2:C3');


$objPHPExcel->getActiveSheet()->mergeCells('D2:D3');


$objPHPExcel->getActiveSheet()->mergeCells('E2:E3');





$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12); 
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12); 
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22); 
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(19); 
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(29); 



$objWorksheet->fromArray(
	array(
		array(utf8_encode('CONSOLIDADO GENERAL NOTIFICACIONES DE TUTELAS JUZGADOS DE EJECUCIÓN CIVIL MUNICIPAL')),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes',utf8_encode('MEDIO NOTIFICACIÓN')),
		array('JUZGADOS','RADICADOS TUTELAS','Personas o entidades notificadas en tutelas','RADICADOS DE INCIDENTES','Personas o entidades notificadas en incidentes','Correo',utf8_encode('Correo-Electrónico'),'Fax','Fax-Correo','Fax-Correo-Correo Electronico','Personal','Total general'),
		array('JUZGADO 1',	$ca1,	$pe1,	$ci1, $pei1,$correo[0],$correo_e[0],$fax[0],$fax_c[0],$fax_c_c[0],$personal[0],$total[0]),
		array('JUZGADO 2',  $ca2,   $pe2,	$ci2, $pei2,$correo[1],$correo_e[1],$fax[1],$fax_c[1],$fax_c_c[1],$personal[1],$total[1]),
		array(''),
		array(''),
		array(''),
		array(''),
		
	)
);


$borders = array(
      'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
      ),
    );
	
	
	
	$style_num = array('font' =>
                                    array('color' =>
                                      array('rgb' => '000000'),
                                      'bold' => false,
                                    ),
                           'alignment' => array(
                                            'wrap'       => true,
                                      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
                                        ),
  						  'borders' => array(
                                             'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
                                        ),				
                     );
	
	
$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($style_num);


$objPHPExcel->getActiveSheet()->getStyle('A2:L2')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A4:L4')->applyFromArray($style_num);
$objPHPExcel->getActiveSheet()->getStyle('A5:L5')->applyFromArray($style_num);






// Save Excel 2007 file

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
$objWriter->save('views/excel/Informe de Notificacion de Tutelas e Incidentes '.$fechai.' al '.$fechaf.'.xlsx');
$id= 'Informe de Notificacion de Tutelas e Incidentes '.$fechai.' al '.$fechaf.'.xlsx';
$enlace = 'views/excel/'.$id; 

header ("Content-Disposition: attachment; filename=".$id." "); 

header ("Content-Type: application/octet-stream");

header ("Content-Length: ".filesize($enlace));

readfile($enlace);


}

//LISTADO EXCEL CORRESPONDENCIA
if($t_reporte==3)
{

$data= new excelModel();


$vector_datos= $data->listarCorrespondencia();

 
$objPHPExcel = new PHPExcel();
// Establecer propiedades
/*$objPHPExcel->getProperties()
->setCreator("Oficina de Ejecución")
->setLastModifiedBy("Oficina de Ejecución")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Documento Excel");*/

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
// Agregar Informacion
expediente;
$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Fecha Registro')
->setCellValue('B1', 'Radicado')
->setCellValue('C1', utf8_encode('Peticionario'))
->setCellValue('D1', utf8_encode('Cédula'))
->setCellValue('E1', utf8_encode('Télefono'))
->setCellValue('F1', 'Tipo')
->setCellValue('G1', 'Juzgado origen')
->setCellValue('H1', 'Solicitud')
->setCellValue('I1', 'Folios')
->setCellValue('J1', utf8_encode('Registró'))
->setCellValue('K1', 'Fecha Entrega')
->setCellValue('L1', 'Juzgado Destino')
->setCellValue('M1', 'Expediente?')
->setCellValue('N1', 'Incorporado al Proceso')
->setCellValue('O1', 'ID')
->setCellValue('P1', 'Observacion')
->setCellValue('Q1', 'Juzgado Reparto');


//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);
$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);
$sheet1->getStyle('N1')->applyFromArray($styleArray);
$sheet1->getStyle('O1')->applyFromArray($styleArray);
$sheet1->getStyle('P1')->applyFromArray($styleArray);
$sheet1->getStyle('Q1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:Q1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;


while($field = $vector_datos->fetch() )
{
$sheet1->setCellValue('A'.$i, utf8_encode($field[fecha_registro]));
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[peticionario]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[cedula]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, utf8_encode($field[telefono]));
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, utf8_encode($field[tipo_documento]));
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($field[juzgado]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('H'.$i, utf8_encode($field[solicitud]));
$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('I'.$i, utf8_encode($field[folios]));
$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('J'.$i, utf8_encode($field[empleado]));
$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('K'.$i, utf8_encode($field[fecha_entrega]));
$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('L'.$i, utf8_encode($field[destino]));
$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('M'.$i, utf8_encode($field[tiene_expediente]));
$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);

if($field[incorporado] == 1){$field[incorporado] = 'Si';}else{$field[incorporado] = 'No';}
$sheet1->setCellValue('N'.$i, utf8_encode($field[incorporado]));
$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('O'.$i, utf8_encode($field[id]));
$sheet1->getStyle('O'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('P'.$i, utf8_encode($field[observacionesm]));
$sheet1->getStyle('P'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('Q'.$i, utf8_encode($field[idjuzgado_reparto]));
$sheet1->getStyle('Q'.$i)->applyFromArray($borders_nobold);

$i++;
}

$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize('true');




// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Documentos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Documentos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}
//LISTADO EXCEL SOLICITUDES
if($t_reporte==4)
{

$data= new excelModel();


$vector_datos= $data->ListadoSolicitudesUsuarios();

 
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
// Agregar Informacion
expediente;
$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Fecha')
->setCellValue('B1', 'Radicado Consultar')
->setCellValue('C1', 'Solicitud')
->setCellValue('D1', 'Peticionario')
->setCellValue('E1', utf8_encode('Cédula'))
->setCellValue('F1', utf8_encode('Télefono'))
->setCellValue('G1', 'Consecutivo')
->setCellValue('H1', utf8_encode('Registró'))
->setCellValue('I1', 'Fecha Resuelve')
->setCellValue('J1', utf8_encode('Resolvió'))
->setCellValue('K1', 'Resuelto?')
->setCellValue('L1', utf8_encode('Descripción'))
->setCellValue('M1', utf8_encode('Ubicación'))
->setCellValue('N1', utf8_encode('Fecha Ubicación'));



//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);
$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);
$sheet1->getStyle('N1')->applyFromArray($styleArray);


$sheet1->getStyle('A1:N1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
 

while($field = $vector_datos->fetch() )
{
$sheet1->setCellValue('A'.$i, utf8_encode($field[fecha]));
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado_consultar],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[solicitud]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[peticionario]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, utf8_encode($field[cedula]));
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, utf8_encode($field[telefono]));
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($field[consecutivo]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('H'.$i, utf8_encode($field[empleado]));
$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('I'.$i, utf8_encode($field[fecha_resuelve]));
$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('J'.$i, utf8_encode($field[usures]));
$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('K'.$i, utf8_encode($field[resolvio]));
$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('L'.$i, utf8_encode($field[descripcion]));
$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('M'.$i, utf8_encode($field[ubicacion]));
$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('N'.$i, utf8_encode($field[fecha_ubicacion]));
$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);


$i++;
}






$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize('true');





// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Solicitudes');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Solicitudes.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

}	   
if($t_reporte==5)
{

$data= new excelModel();


$vector_datos= $data->FiltroUbicacionExpedientes();
/*while($field = $vector_datos->fetch())
{
	
	echo $field[fechasalida];
	}*/
 
$objPHPExcel = new PHPExcel();

// Establecer propiedades
/*$objPHPExcel->getProperties()
->setCreator("Oficina de Ejecución")
->setLastModifiedBy("Oficina de Ejecución")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Documento Excel");*/

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

/*$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Fecha')
->setCellValue('B1', 'Radicado')
->setCellValue('C1',  utf8_encode('Cédula Demandante'))
->setCellValue('D1', 'Demandante')
->setCellValue('E1',  utf8_encode('Cédula Demandado'))
->setCellValue('F1', 'Demandado')
->setCellValue('G1', 'Piso')
->setCellValue('H1', 'Estado')
->setCellValue('I1', 'Juzgado')
->setCellValue('J1', 'Fecha Salida')
->setCellValue('K1', 'Juzgado Destino')
->setCellValue('L1', utf8_encode('Fecha Devolución'))
->setCellValue('M1', 'Clase Proceso')
->setCellValue('N1', 'Observaciones')
->setCellValue('O1', 'Observacion de Salida');*/

$sheet1=$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Fecha')
->setCellValue('B1', 'Radicado')
->setCellValue('C1',  utf8_encode('Cédula Demandante'))
->setCellValue('D1', 'Demandante')
->setCellValue('E1',  utf8_encode('Cédula Demandado'))
->setCellValue('F1', 'Demandado')
->setCellValue('G1', 'Piso')

->setCellValue('H1', 'Posicion')
->setCellValue('I1', 'Usuario que Archiva')
->setCellValue('J1', 'Fecha y Hora Archiva')
->setCellValue('K1', 'Observacion Archiva')

->setCellValue('L1', 'Estado')
->setCellValue('M1', 'Juzgado')
->setCellValue('N1', 'Fecha Salida')
->setCellValue('O1', 'Juzgado Destino')
->setCellValue('P1', 'Juzgado Reparto')
->setCellValue('Q1', utf8_encode('Fecha Devolución'))
->setCellValue('R1', 'Clase Proceso')
->setCellValue('S1', 'Observaciones')
->setCellValue('T1', 'Observacion de Salida')
->setCellValue('U1', 'Fecha Reparto');

//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);
$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);
$sheet1->getStyle('N1')->applyFromArray($styleArray);
$sheet1->getStyle('O1')->applyFromArray($styleArray);
$sheet1->getStyle('P1')->applyFromArray($styleArray);
$sheet1->getStyle('Q1')->applyFromArray($styleArray);
$sheet1->getStyle('R1')->applyFromArray($styleArray);
$sheet1->getStyle('S1')->applyFromArray($styleArray);
$sheet1->getStyle('T1')->applyFromArray($styleArray);
$sheet1->getStyle('U1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:U1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );

$i=2;
 

while($field = $vector_datos->fetch() )
{
$sheet1->setCellValue('A'.$i, $field[fecha]);
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[demandante]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, utf8_encode($field[cedula_demandado]));
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, utf8_encode($field[demandado]));
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($field[piso]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('H'.$i, utf8_encode($field[posicion]));
$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('I'.$i, utf8_encode($field[a1]));
$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('J'.$i, utf8_encode($field[a2]));
$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('K'.$i, utf8_encode($field[a3]));
$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('L'.$i, utf8_encode($field[estados]));
$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('M'.$i, utf8_encode($field[juzgado]));
$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('N'.$i, utf8_encode($field[fechasalida]));
$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('O'.$i, utf8_encode($field[juzgadodestino]));
$sheet1->getStyle('O'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('P'.$i, utf8_encode($field[juzgadoreparto]));
$sheet1->getStyle('P'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('Q'.$i, utf8_encode($field[fechadevolucion]));
$sheet1->getStyle('Q'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('R'.$i, utf8_encode($field[clase_proceso]));
$sheet1->getStyle('R'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('S'.$i, utf8_encode($field[observaciones]));
$sheet1->getStyle('S'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('T'.$i, utf8_encode($field[observacion_salida]));
$sheet1->getStyle('T'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('U'.$i, $field[fecha_reparto]);
$sheet1->getStyle('U'.$i)->applyFromArray($borders_nobold);



$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Ubicaciones');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ubicaciones.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;







}	




   
if($t_reporte==6)
{

$data= new excelModel();


$vector_datos= $data->FiltroUbicacionExpedientes();
/*while($field = $vector_datos->fetch())
{
	
	echo $field[fechasalida];
	}*/
 
$objPHPExcel = new PHPExcel();

// Establecer propiedades
/*$objPHPExcel->getProperties()
->setCreator("Oficina de Ejecución")
->setLastModifiedBy("Oficina de Ejecución")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Documento Excel");*/

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
//->setCellValue('A1', 'Fecha')
->setCellValue('A1', 'Radicado')
//->setCellValue('C1', 'Piso')
//->setCellValue('D1', 'Estado')
//->setCellValue('E1', 'Juzgado')
->setCellValue('B1', 'Clase Proceso')
->setCellValue('C1', 'Fecha Reparto')
->setCellValue('D1', 'Juzgado Reparto');
//->setCellValue('H1', utf8_encode('Fecha Devolución'));

//->setCellValue('C2', '=sum(A2:B2)');

//$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('A1')->applyFromArray($styleArray);
//$sheet1->getStyle('C1')->applyFromArray($styleArray);
//$sheet1->getStyle('D1')->applyFromArray($styleArray);
//$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
//$sheet1->getStyle('H1')->applyFromArray($styleArray);


$sheet1->getStyle('A1:D1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'BABAB7'),
            'endcolor' => array('rgb' => 'BABAB7')

            )
    );

$i=2;

while($field = $vector_datos->fetch() )
{
//$sheet1->setCellValue('A'.$i, $field[fecha]);
//$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('A' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
//$sheet1->setCellValue('C'.$i, utf8_encode($field[piso]));
//$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
//$sheet1->setCellValue('D'.$i, utf8_encode($field[estados]));
//$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
//$sheet1->setCellValue('E'.$i, utf8_encode($field[juzgado]));
//$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('B'.$i, utf8_encode($field[clase_proceso]));
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[fecha_reparto]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[juzgadoreparto]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
//$sheet1->setCellValue('H'.$i, utf8_encode($field[fechadevolucion]));
//$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);


$i++;
}
$entrega= $i+2;
$recibe= $i+4;
$sheet1->getCell('A' . $entrega)->setValueExplicit('Entrega: ___________________________________',PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getCell('A' . $recibe)->setValueExplicit('Recibe:  ____________________________________',PHPExcel_Cell_DataType::TYPE_STRING);  
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
//$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
//$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
//$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
//$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
//$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Reparto');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reparto.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
}

//-----------------------REPORTES DE JORGE ANDRES VALENCIA OROZCO------------------------------------------


if($t_reporte==7)
{

$data= new excelModel();


$vector_datos= $data->FiltroUbicacionExpedientesDetalleObservaciones();
 
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
->setCellValue('A1', 'Fecha')
->setCellValue('B1', 'Radicado')
->setCellValue('C1',  utf8_encode('Cédula Demandante'))
->setCellValue('D1', 'Demandante')
->setCellValue('E1',  utf8_encode('Cédula Demandado'))
->setCellValue('F1', 'Demandado')
->setCellValue('G1', 'Piso')

->setCellValue('H1', 'Usuario que Archiva')
->setCellValue('I1', 'Fecha y Hora Archiva')
->setCellValue('J1', 'Observacion Archiva')


->setCellValue('K1', 'Estado')
->setCellValue('L1', 'Juzgado')
->setCellValue('M1', 'Fecha Salida')
->setCellValue('N1', 'Juzgado Destino')
->setCellValue('O1', 'Juzgado Reparto')
->setCellValue('P1', utf8_encode('Fecha Devolución'))
->setCellValue('Q1', 'Clase Proceso')
->setCellValue('R1', 'Observaciones')
->setCellValue('S1', 'Observacion de Salida')
->setCellValue('T1', 'Fecha Observación')
->setCellValue('U1', 'Observacion')
->setCellValue('V1', 'Usuario');

//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);

$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);

$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);
$sheet1->getStyle('N1')->applyFromArray($styleArray);
$sheet1->getStyle('O1')->applyFromArray($styleArray);
$sheet1->getStyle('P1')->applyFromArray($styleArray);
$sheet1->getStyle('Q1')->applyFromArray($styleArray);
$sheet1->getStyle('R1')->applyFromArray($styleArray);
$sheet1->getStyle('S1')->applyFromArray($styleArray);
$sheet1->getStyle('T1')->applyFromArray($styleArray);
$sheet1->getStyle('U1')->applyFromArray($styleArray);
$sheet1->getStyle('V1')->applyFromArray($styleArray);


$sheet1->getStyle('A1:V1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );

$i=2;
 

while($field = $vector_datos->fetch() )
{
$sheet1->setCellValue('A'.$i, $field[fechaobservacion]);
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[demandante]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, utf8_encode($field[cedula_demandado]));
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, utf8_encode($field[demandado]));
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($field[piso]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('H'.$i, utf8_encode($field[a1]));
$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('I'.$i, utf8_encode($field[a2]));
$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('J'.$i, utf8_encode($field[a3]));
$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);


$sheet1->setCellValue('K'.$i, utf8_encode($field[estados]));
$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('L'.$i, utf8_encode($field[juzgado]));
$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('M'.$i, utf8_encode($field[fechasalida]));
$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('N'.$i, utf8_encode($field[juzgadodestino]));
$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('O'.$i, utf8_encode($field[juzgadoreparto]));
$sheet1->getStyle('O'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('P'.$i, utf8_encode($field[fechadevolucion]));
$sheet1->getStyle('P'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('Q'.$i, utf8_encode($field[clase_proceso]));
$sheet1->getStyle('Q'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('R'.$i, utf8_encode($field[observaciones]));
$sheet1->getStyle('R'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('S'.$i, utf8_encode($field[observacion_salida]));
$sheet1->getStyle('S'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('T'.$i, utf8_encode($field[fechaobservacion]));
$sheet1->getStyle('T'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('U'.$i, utf8_encode($field[observacion]));
$sheet1->getStyle('U'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('V'.$i, utf8_encode($field[usuario]));
$sheet1->getStyle('V'.$i)->applyFromArray($borders_nobold);


$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize('true');
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('ObservacionDetalle');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ObservacionDetalle.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;







}	



if($t_reporte==70000)
{

$data= new excelModel();


$vector_datos= $data->FiltroDetalleObservaciones_USER();
 
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
->setCellValue('A1', 'Fecha')
->setCellValue('B1', 'Radicado')
->setCellValue('C1',  utf8_encode('Cédula Demandante'))
->setCellValue('D1', 'Demandante')
->setCellValue('E1',  utf8_encode('Cédula Demandado'))
->setCellValue('F1', 'Demandado')
->setCellValue('G1', 'Piso')

->setCellValue('H1', 'Usuario que Archiva')
->setCellValue('I1', 'Fecha y Hora Archiva')
->setCellValue('J1', 'Observacion Archiva')


->setCellValue('K1', 'Estado')
->setCellValue('L1', 'Juzgado')
->setCellValue('M1', 'Fecha Salida')
->setCellValue('N1', 'Juzgado Destino')
->setCellValue('O1', 'Juzgado Reparto')
->setCellValue('P1', utf8_encode('Fecha Devolución'))
->setCellValue('Q1', 'Clase Proceso')
->setCellValue('R1', 'Observaciones')
->setCellValue('S1', 'Observacion de Salida')
->setCellValue('T1', 'Fecha Observación')
->setCellValue('U1', 'Observacion')
->setCellValue('V1', 'Usuario');

//->setCellValue('C2', '=sum(A2:B2)');

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);

$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);

$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);
$sheet1->getStyle('N1')->applyFromArray($styleArray);
$sheet1->getStyle('O1')->applyFromArray($styleArray);
$sheet1->getStyle('P1')->applyFromArray($styleArray);
$sheet1->getStyle('Q1')->applyFromArray($styleArray);
$sheet1->getStyle('R1')->applyFromArray($styleArray);
$sheet1->getStyle('S1')->applyFromArray($styleArray);
$sheet1->getStyle('T1')->applyFromArray($styleArray);
$sheet1->getStyle('U1')->applyFromArray($styleArray);
$sheet1->getStyle('V1')->applyFromArray($styleArray);


$sheet1->getStyle('A1:V1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );

$i=2;
 

while($field = $vector_datos->fetch() )
{
$sheet1->setCellValue('A'.$i, $field[fechaobservacion]);
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
$sheet1->getCell('B' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));
$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('D'.$i, utf8_encode($field[demandante]));
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('E'.$i, utf8_encode($field[cedula_demandado]));
$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('F'.$i, utf8_encode($field[demandado]));
$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('G'.$i, utf8_encode($field[piso]));
$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('H'.$i, utf8_encode($field[a1]));
$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('I'.$i, utf8_encode($field[a2]));
$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('J'.$i, utf8_encode($field[a3]));
$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);


$sheet1->setCellValue('K'.$i, utf8_encode($field[estados]));
$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('L'.$i, utf8_encode($field[juzgado]));
$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('M'.$i, utf8_encode($field[fechasalida]));
$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('N'.$i, utf8_encode($field[juzgadodestino]));
$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('O'.$i, utf8_encode($field[juzgadoreparto]));
$sheet1->getStyle('O'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('P'.$i, utf8_encode($field[fechadevolucion]));
$sheet1->getStyle('P'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('Q'.$i, utf8_encode($field[clase_proceso]));
$sheet1->getStyle('Q'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('R'.$i, utf8_encode($field[observaciones]));
$sheet1->getStyle('R'.$i)->applyFromArray($borders_nobold);
$sheet1->setCellValue('S'.$i, utf8_encode($field[observacion_salida]));
$sheet1->getStyle('S'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('T'.$i, utf8_encode($field[fechaobservacion]));
$sheet1->getStyle('T'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('U'.$i, utf8_encode($field[observacion]));
$sheet1->getStyle('U'.$i)->applyFromArray($borders_nobold);

$sheet1->setCellValue('V'.$i, utf8_encode($field[usuario]));
$sheet1->getStyle('V'.$i)->applyFromArray($borders_nobold);


$i++;
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:V1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize('true');
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('ObservacionDetalle');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ObservacionDetalle.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;







}




if($id_reporte==2000)
{

$data= new excelModel();

$vector_datos= $data->Datos_Eventos($filtro,$fd,$fh);

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

->setCellValue('A1', 'Id')
->setCellValue('B1', 'Fecha')
->setCellValue('C1', 'Asunto')
->setCellValue('D1', 'Accion')
->setCellValue('E1', 'Radicado')
->setCellValue('F1', 'Descripcion');

//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);



$sheet1->getStyle('A1:F1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('B'.$i, $field[evefecha]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[eveasunto]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[acc_descripcion]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getCell('E'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, $field[evedescripcion]);
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('eventos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="eventos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}


if($id_reporte_2 == 30000)//ae.actu_fechai
{

$data= new excelModel();


$vector_datos= $data->Datos_Actuaciones_2($filtro_2,$fd_2,$fh_2);

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
->setCellValue('B1', 'ID RADICADO')
->setCellValue('C1', 'RADICADO')
->setCellValue('D1', 'FECHA')
->setCellValue('E1', 'ACTUACION')
->setCellValue('F1', 'ASIGNADO');


//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:F1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('B'.$i, $field[idcorrespondencia]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->getCell('C'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('D'.$i, $field[fecha]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observacion]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, '');
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tramite Interno');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TramiteInterno.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}


if($id_reporte_2==3000)//ae.actu_fechai
{

$data= new excelModel();

$vector_datos= $data->Datos_Actuaciones($filtro_2,$fd_2,$fh_2);

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

->setCellValue('A1', 'RADICADO')
->setCellValue('B1', 'CLASE PROCESO')
->setCellValue('C1', 'FECHA INICIAL')
->setCellValue('D1', 'DIAS')
->setCellValue('E1', 'FECHA FINAL')
->setCellValue('F1', 'ASIGNADO')
->setCellValue('G1', 'ACTUACION');


//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:G1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->getCell('A'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('B'.$i, $field[nombre]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[actu_fechai]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[actu_dias]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[actu_fechaf]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, utf8_encode($field[empleado]));
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, utf8_encode($field[acc_descripcion]));
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
	

	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Tramite Interno');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="TramiteInterno.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}				


if($id_reporte_3==4000)
{

$data= new excelModel();

$vector_datos= $data->Datos_Empleado_Ingreso_Salida($filtro_3,$fd_3,$fh_3);

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
->setCellValue('B1', 'USUARIO')
->setCellValue('C1', 'OBSERVACION')
->setCellValue('D1', 'TIPO');


//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);

$sheet1->getStyle('A1:D1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$cadenaFecha  =  explode (" ",$field[fecha]);
	$cadenaHora   =  $cadenaFecha[1];
	$cadenaHorab  =  explode (":",$cadenaHora);
	
	if($cadenaHorab[0] >= 7 && $cadenaHorab[0] <= 12){
		$fechacompleta = $field[fecha]." AM"; 
	}
	else{
		$fechacompleta = $field[fecha]." PM"; 
	}
	
	$sheet1->setCellValue('A'.$i, $fechacompleta);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('B'.$i, utf8_encode($field[usuario]));
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, utf8_encode($field[observaciones]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[tipo]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');

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



if($id_reporte_4 == 5000)
{

$data= new excelModel();

$vector_datos= $data->Datos_Reparto_Masivo($filtro_4,$fd_4,$fh_4);

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

->setCellValue('A1', 'Id')
->setCellValue('B1', 'Radicado')
->setCellValue('C1', 'Ced Demandante')
->setCellValue('D1', 'Demandante')
->setCellValue('E1', 'Ced Demandado')
->setCellValue('F1', 'Demandado')
->setCellValue('G1', 'Piso')
->setCellValue('H1', 'Estado')
->setCellValue('I1', 'Detalle Estado')
->setCellValue('J1', 'Clase Proceso')
->setCellValue('K1', 'Fecha Reparto')
->setCellValue('L1', 'Juzgado Reparto')
->setCellValue('M1', 'Ponente');


//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);
$sheet1->getStyle('G1')->applyFromArray($styleArray);
$sheet1->getStyle('H1')->applyFromArray($styleArray);
$sheet1->getStyle('I1')->applyFromArray($styleArray);
$sheet1->getStyle('J1')->applyFromArray($styleArray);
$sheet1->getStyle('K1')->applyFromArray($styleArray);
$sheet1->getStyle('L1')->applyFromArray($styleArray);
$sheet1->getStyle('M1')->applyFromArray($styleArray);



$sheet1->getStyle('A1:M1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );



/*ubi.id,
ubi.radicado,
ubi.cedula_demandante,
ubi.demandante,
ubi.cedula_demandado,
ubi.demandado,
ubi.piso,
es.nombre AS estado,
de.nombre AS detalleestado,
cp.nombre AS claseproceso,
ubi.fecha_reparto,
jd.nombre AS juzgadoreparto,
ubi.iddespacho AS ponente*/

$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i,$field[cedula_demandante]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, utf8_encode($field[demandante]));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[cedula_demandado]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, utf8_encode($field[demandado]));
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('G'.$i, $field[piso]);
	$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('H'.$i, $field[estado]);
	$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('I'.$i, $field[detalleestado]);
	$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('J'.$i, $field[claseproceso]);
	$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('K'.$i, $field[fecha_reparto]);
	$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('L'.$i, $field[juzgadoreparto]);
	$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('M'.$i, $field[ponente]);
	$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}
   
$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize('true');

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('repartomasivo');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="repartomasivo.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}

if($t_reporte == 6000)
{

$data= new excelModel();

$vector_datos = $data->listarTitulos($radicado,$beneficiario);

$suma         = $data->SumalistarTitulos($radicado,$beneficiario);
$row          = $suma->fetch();
$totaltitulos = $row[total];

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

->setCellValue('A1', 'RADICADO')
->setCellValue('B1', 'FECHA')
->setCellValue('C1', 'BENEFICIARIO')
->setCellValue('D1', 'VALOR')
->setCellValue('E1', 'FECHA PAGO');

//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:E1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'FFFF00'),
            'endcolor' => array('rgb' => 'FFFF00')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->getCell('A'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->setCellValue('B'.$i, $field[fecha]);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, utf8_encode($field[beneficiario]));
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, $field[valor]);
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, $field[fechapago]);
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}

//---------------------------------TOTAL TITULOS--------------------------------------------------------
$i = $i + 1;
	
$sheet1->setCellValue('A'.$i, 'TOTAL');
$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
$sheet1->setCellValue('D'.$i,$totaltitulos);
$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
$sheet1->getStyle('A'.$i.':'.'D'.$i)->getFill()->applyFromArray(
	array(
			'type'       => PHPExcel_Style_Fill::FILL_SOLID,
			'startcolor' => array('rgb' => 'FFFF00'),
			'endcolor' => array('rgb' => 'FFFF00')
	
	)
);
	
$sheet1->getStyle('A'.$i.':'.'D'.$i)->applyFromArray($styleArray);
$sheet1->getStyle('D'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
//-----------------------------------------------------------------------------------------------------------  
   
$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');


// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('titulos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="titulos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}

if($t_reporte == 7000)
{

$data= new excelModel();

$vector_datos = $data->listarProcesosConMemorialIncorporado($tfiltro);

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
->setCellValue('B1', 'RADICADO')
->setCellValue('C1', 'FECHA')
->setCellValue('D1', 'JUZGADO')
->setCellValue('E1', 'OBSERVACION')
->setCellValue('F1', 'SOLICITUD');

//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:F1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[fecha]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, utf8_encode($field[idjuzgado_reparto]));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observacion]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, utf8_encode($field[solicitud]));
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}

   
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');



// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('procesos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="procesos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}


if($t_reporte == 8000)
{

$data= new excelModel();

$vector_datos = $data->listarProcesosConMemorialIncorporado($tfiltro);

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
->setCellValue('B1', 'RADICADO')
->setCellValue('C1', 'FECHA')
->setCellValue('D1', 'JUZGADO')
->setCellValue('E1', 'OBSERVACION')
->setCellValue('F1', 'SOLICITUD');

//->setCellValue('C1',  utf8_encode('Cédula Demandante')) //PARA LAS TILDES

$sheet1->getStyle('A1')->applyFromArray($styleArray);
$sheet1->getStyle('B1')->applyFromArray($styleArray);
$sheet1->getStyle('C1')->applyFromArray($styleArray);
$sheet1->getStyle('D1')->applyFromArray($styleArray);
$sheet1->getStyle('E1')->applyFromArray($styleArray);
$sheet1->getStyle('F1')->applyFromArray($styleArray);




$sheet1->getStyle('A1:F1')->getFill()->applyFromArray(
            array(
            'type'       => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => 'CDE3F6'),
            'endcolor' => array('rgb' => 'CDE3F6')

            )
    );


$i=2;
while($field = $vector_datos->fetch() )
{

	$sheet1->setCellValue('A'.$i, $field[id]);
	$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);

	$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('C'.$i, $field[fecha]);
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('D'.$i, utf8_encode($field[idjuzgado_reparto]));
	$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('E'.$i, utf8_encode($field[observacion]));
	$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
	
	$sheet1->setCellValue('F'.$i, utf8_encode($field[solicitud]));
	$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
	/*$sheet1->setCellValue('C'.$i, utf8_encode($field[cedula_demandante]));//PARA LAS TILDES
	$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);*/

	$i++;
	
}

   
$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($borders);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');



// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('procesos');


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="procesos.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

}


?>