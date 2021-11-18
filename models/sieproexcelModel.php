<?php

set_time_limit (0);

class sieproexcelModel extends modelBase{

	public function get_documentos($identrada){
	
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
			
			 //SE CIERRA SQL POR QUE FILTRA POR USURIO DE SESION   
			/*$listar     = $this->db->prepare("SELECT ste.id,ubi.radicado,ste.fecharegistro,ste.fechamodificacion,ste.numero,ste.valor,ste.adjudicatario,ste.encustodia
                                              FROM (siepro_titulos_encustodia ste LEFT JOIN ubicacion_expediente ubi ON ste.idradicado = ubi.id)
											  WHERE ste.idusuarioregistra = '$idusuario'
											  ORDER BY ste.id DESC");*/
											  
			$listar     = $this->db->prepare("SELECT ste.id,ubi.radicado,ste.fecharegistro,ste.fechamodificacion,ste.numero,ste.valor,ste.adjudicatario,ste.encustodia
                                              FROM (siepro_titulos_encustodia ste LEFT JOIN ubicacion_expediente ubi ON ste.idradicado = ubi.id)
											  ORDER BY ste.id DESC");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			
			
	
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (ste.fecharegistro >= '$fechad' AND ste.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND ste.id = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND ste.encustodia = '$datox2' ";
			
			}
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND ubi.radicado LIKE '%$datox3%' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtrof;
			
			//echo $filtrox;
			  
			 //SE CIERRA SQL POR QUE FILTRA POR USURIO DE SESION
			/*$listar    = $this->db->prepare("SELECT ste.id,ubi.radicado,ste.fecharegistro,ste.fechamodificacion,ste.numero,ste.valor,ste.adjudicatario,ste.encustodia
                                             FROM (siepro_titulos_encustodia ste LEFT JOIN ubicacion_expediente ubi ON ste.idradicado = ubi.id)
											 WHERE ste.id >= '1'" .$filtrox. " AND ste.idusuarioregistra = '$idusuario'
											 ORDER BY ste.id DESC");*/
											 
											 
			$listar    = $this->db->prepare("SELECT ste.id,ubi.radicado,ste.fecharegistro,ste.fechamodificacion,ste.numero,ste.valor,ste.adjudicatario,ste.encustodia
                                             FROM (siepro_titulos_encustodia ste LEFT JOIN ubicacion_expediente ubi ON ste.idradicado = ubi.id)
											 WHERE ste.id >= '1'" .$filtrox. "
											 ORDER BY ste.id DESC");
											 
											 
			
			
		}

  		$listar->execute();
			  
		return $listar; 
	
  	}
	
	public function get_titulos_otros_juzgados($identrada){
	
	
		//$idusuario  = $_SESSION['idUsuario'];
		
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
		  
			$listar     = $this->db->prepare("SELECT dtoj.id,toj.radicado,dtoj.fecharegistro,dtoj.fechamodificacion,dtoj.fechapago,dtoj.ordenadooficio,
			                                  dtoj.numero,dtoj.cantidad,dtoj.valor,dtoj.beneficiario
											  FROM (siepro_titulos_otrosjuzgados toj LEFT JOIN siepro_detalle_titulos_otrosjuzgados dtoj ON toj.id = dtoj.idradicado)
											  ORDER BY dtoj.id DESC");
											 
			
		}
		if($identrada == 2){
			
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
	
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			
			
	
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND (dtoj.fecharegistro >= '$fechad' AND dtoj.fecharegistro <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND dtoj.id = '$datox1' ";
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND dtoj.beneficiario LIKE '%$datox2%' ";
			
			}
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND toj.radicado LIKE '%$datox3%' ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND dtoj.numero = '$datox4' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;
			
	
			//echo $filtrox;
			  
			 $listar    = $this->db->prepare("SELECT dtoj.id,toj.radicado,dtoj.fecharegistro,dtoj.fechamodificacion,dtoj.fechapago,dtoj.ordenadooficio,
			                                 dtoj.numero,dtoj.cantidad,dtoj.valor,dtoj.beneficiario
											 FROM (siepro_titulos_otrosjuzgados toj LEFT JOIN siepro_detalle_titulos_otrosjuzgados dtoj ON toj.id = dtoj.idradicado)
											 WHERE dtoj.id >= '1'" .$filtrox. " 
											 ORDER BY dtoj.id DESC");
											 
											 
			
			
		}

  		$listar->execute();
			  
		return $listar; 
	
  	}
	
	public function get_vence_terminos($fecha_terminos){
	
		
		$listar     = $this->db->prepare("SELECT ubi.id,ubi.radicado,ubi.fecha_terminos,ubi.termino_revisado
										  FROM ubicacion_expediente ubi 
									      WHERE ubi.fecha_terminos = '$fecha_terminos'");
	
  		$listar->execute();

  		return $listar;
	
   }
   
   public function get_vence_liquidacion($fecha_terminos){
	
		
		/*$listar     = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,dc.observacion
										  FROM (detalle_correspondencia dc INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
										  WHERE ubi.fecha_fin_liquidacion = '$fecha_terminos' AND observacion LIKE '%Traslado Art. 110 Fec Fijacion:%'
										  ORDER BY dc.fecha DESC;");*/
										  
										  
		$fecha_terminos_b = explode("-",$fecha_terminos);
		
		if($fecha_terminos_b[1] >= 1 && $fecha_terminos_b[1] <= 9){
		
			$partefecha = substr($fecha_terminos_b[1],-1);
		
		}
		else{
		
			$partefecha = $fecha_terminos_b[1];
		}
		
		if($fecha_terminos_b[2] >= 1 && $fecha_terminos_b[2] <= 9){
		
			$partefecha_2 = substr($fecha_terminos_b[2],-1);
		
		}
		else{
		
			$partefecha_2 = $fecha_terminos_b[2];
		}
		
		$fecha_terminos_c = $fecha_terminos_b[0]."-".$partefecha."-".$partefecha_2;
										 
		$listar     = $this->db->prepare("SELECT ubi.id,ubi.radicado,dc.fecha,dc.observacion
									     FROM (detalle_correspondencia dc INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
                                         WHERE ubi.fecha_fin_liquidacion = '$fecha_terminos' 
										 AND (observacion LIKE '%Traslado Art. 110 Fec Fijacion:%' AND observacion LIKE '%Fec Final: $fecha_terminos_c%')
                                         ORDER BY dc.fecha DESC");
	
  		$listar->execute();

  		return $listar;
	
   }
   
   public function get_consulta_ventanilla($identrada){
	
		
		$modelo = new sieproexcelModel();
		
		$idusuario  = $_SESSION['idUsuario'];
		
		if($identrada == 1){
		
		  
			$listar     = $this->db->prepare("SELECT idradicado,ubi.radicado,COUNT(*) AS Cantidad
											  FROM (siepro_historial_consulta shc INNER JOIN ubicacion_expediente ubi ON shc.idradicado = ubi.id)
											  GROUP BY idradicado
                                              HAVING COUNT(*) >= 1
                                              ORDER BY idradicado");
											 
			
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
			
				
				$filtrof = " AND (shc.fecha >= '$fechad' AND shc.fecha <= '$fechah') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND shc.idusuario = '$datox1' ";
				
			
			}
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND ubi.radicado = '$datox2' ";
			
			}
			/*if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND toj.radicado LIKE '%$datox3%' ";
			
			}
			if ( !empty($datox4) ) {
			
				$filtro4 = " AND dtoj.numero = '$datox4' ";
			
			}*/
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtrof;
			
	
			//echo $filtrox;
			  
			 $listar    = $this->db->prepare("SELECT idradicado,ubi.radicado,COUNT(*) AS Cantidad
											  FROM (siepro_historial_consulta shc INNER JOIN ubicacion_expediente ubi ON shc.idradicado = ubi.id)
											  WHERE shc.id >= '1'" .$filtrox. " 
											  GROUP BY idradicado
                                              HAVING COUNT(*) >= 1
											  ORDER BY idradicado");
											 
											 

			
		}

  		$listar->execute();
			  
		return $listar; 
	
  	}
  


	
	
	public function busquedad_filtro_corres(){
	
	
			$idusuario  = $_SESSION['idUsuario'];
		
		
			$filtrox;
			
			$filtrof;
			$filtrofe;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechaded   = trim($_GET['dato_3']);
			$fechadeh   = trim($_GET['dato_4']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
		
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$fechad' AND DATE(t1.fecha_registro) <= '$fechah') ";
				
			
			}
			if ( !empty($fechaded) && !empty($fechadeh) ) {
			
				
				//$filtrofe = " AND t1.fecha_entrega = '$fechade' ";
				
				$filtrofe = " AND ( t1.fecha_entrega >= '$fechaded' AND  t1.fecha_entrega <= '$fechadeh') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t1.tipo_documento = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				//$filtro2 = " AND t4.nombre LIKE '%$datox2%' ";
				
				$filtro2 = " AND t1.idjuzgadodestino = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t1.idsolicitud = '$datox3' ";
			
			}
			
			if ( !empty($datox4) ) {
			
			
				$filtro4 = " AND t1.peticionario LIKE '%$datox4%' ";
			
			}
			
			
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND t1.folios = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.observacionesm LIKE '%$datox6%' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof." ".$filtrofe;
			
			//echo $filtrox;
			   
			
			
			$listar = $this->db->prepare("	SELECT t1.id,t1.fecha_registro,t1.peticionario,t1.tipo_documento,t1.folios,t1.fecha_entrega,t1.observacionesm,
											t2.nombre AS jusgadodestino,
											t3.nombre AS solicitud,
											t4.empleado
											FROM (((correspondencia t1 LEFT JOIN juzgado_destino t2 ON t1.idjuzgadodestino = t2.id)
											LEFT JOIN pa_solicitud t3 ON t1.idsolicitud = t3.id)
											LEFT JOIN pa_usuario t4 ON t1.idusuario = t4.id)
											WHERE t1.id >= '1'" .$filtrox. " AND t1.radicado = 0 
											ORDER BY t1.id DESC ");
		

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	public function cantidad_filtro_corres(){
	
	
			$idusuario  = $_SESSION['idUsuario'];
		
		
			$filtrox;
			
			$filtrof;
			$filtrofe;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			$filtro5;
			$filtro6;
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechaded   = trim($_GET['dato_3']);
			$fechadeh   = trim($_GET['dato_4']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			
		
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$fechad' AND DATE(t1.fecha_registro) <= '$fechah') ";
				
			
			}
			if ( !empty($fechaded) && !empty($fechadeh) ) {
			
				
				//$filtrofe = " AND t1.fecha_entrega = '$fechade' ";
				
				$filtrofe = " AND ( t1.fecha_entrega >= '$fechaded' AND  t1.fecha_entrega <= '$fechadeh') ";
				
			
			}
			if ( !empty($datox1) ) {
			
				$filtro1 = " AND t1.tipo_documento = '$datox1' ";
			
			}
			
			if ( !empty($datox2) ) {
			
				//$filtro2 = " AND t4.nombre LIKE '%$datox2%' ";
				
				$filtro2 = " AND t1.idjuzgadodestino = '$datox2' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				$filtro3 = " AND t1.idsolicitud = '$datox3' ";
			
			}
			

			if ( !empty($datox4) ) {
			
			
				$filtro4 = " AND t1.peticionario LIKE '%$datox4%' ";
			
			}
			
			
			if ( !empty($datox5) ) {
			
				$filtro5 = " AND t1.folios = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.observacionesm LIKE '%$datox6%' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtrof." ".$filtrofe;
			
			//echo $filtrox;
			   
			
			
			
											
			$listar = $this->db->prepare("	SELECT COUNT(t1.id) AS CANTIDAD
											FROM (((correspondencia t1 LEFT JOIN juzgado_destino t2 ON t1.idjuzgadodestino = t2.id)
											LEFT JOIN pa_solicitud t3 ON t1.idsolicitud = t3.id)
											LEFT JOIN pa_usuario t4 ON t1.idusuario = t4.id)
											WHERE t1.id >= '1'" .$filtrox. " AND t1.radicado = 0 
											ORDER BY t1.id DESC ");
		

  			$listar->execute();

  			return $listar;
	
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
  
  public function Datos_Usuario($iduser){

 
	  $listar = $this->db->prepare("SELECT empleado FROM pa_usuario WHERE id = '$iduser'");
	
	  $listar->execute();
	
	  return $listar;


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

  	
	public function busquedad_filtro_OBSERVACION($filtro_u){
	
	
			$idusuario  = $_SESSION['idUsuario'];
		
		
			$filtrox;
			
			$filtrof;
			$filtrofobs;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechad_obsD = trim($_GET['dato_3']);
			$fechah_obsH = trim($_GET['dato_4']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			
			//ESTADO
			$datox4    = trim($_GET['datox4']);
			
		
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
		
			}
			
			if ( !empty($fechad_obsD) && !empty($fechah_obsH) ) {
			
				
				$filtrofobs = " AND ( t1.fecha_obs_i >= '$fechad_obsD' AND t1.fecha_obs_i <= '$fechah_obsH') ";
				
		
			}
			
			
			
			if ( !empty($datox1) ) {
			
				
				
				//$filtro1 = " AND t2.radicado LIKE '%$datox1%' ";
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}
			
			
			if ( !empty($datox2) ) {
			
				
				//$filtro2 = " AND t1.id_clase = '$datox2' ";
				
				$filtro2 = " AND t2.radicado LIKE '%$datox2%' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND t1.id_user_asignada = '$datox3' ";
			
			}
			
			/*if ( !empty($datox4) ) {*/
			if(is_numeric($datox4)) {
			
				
				
				$filtro4 = " AND t1.estadoobs = '$datox4' ";
			
			}
			
			if ( $filtro_u == 1 ) {
			
				
				$filtro_u = " AND t1.id_user_asignada = '$idusuario' ";
			
			}
			else{
			
				$filtro_u = " AND t1.id_user_asignada >= 1 ";
			}
			
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof." ".$filtrofobs." ".$filtro_u;
			
			
			//echo $filtrox;
			 
		
			
			
			$listar = $this->db->prepare("	
											SELECT t1.id,t1.idcorrespondencia,t2.radicado,t1.fecha,t3.empleado,
											t1.observacion,t1.fecha_obs_i,t1.fecha_obs_f,t1.estadoobs,t1.juz_respuesta
											FROM ((detalle_correspondencia t1
											INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
											INNER JOIN pa_usuario t3 ON t1.id_user_asignada = t3.id)
											WHERE t1.id >= '1'" .$filtrox. "
											ORDER BY t1.id DESC
											
										"); 
			
			
			
  			$listar->execute();

  			return $listar;
	
  	}
	
	function get_datos_SOLICITUDES_FILTRO(){
	
			
			
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro4;
			$filtro56;
			$filtro7;
			$filtro8;
			
			$id_filtro = trim($_GET['id_filtro']);
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox5) && !empty($datox6) ) {
			
				
				$filtro56 = " AND ( DATE(t1.fecha_respuesta) >= '$datox5' AND DATE(t1.fecha_respuesta) <= '$datox6') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox7) ) {
			
				
				
				$filtro7 = " AND t1.iduser = '$datox7' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}
			
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.des LIKE '%$datox4%' ";
				
	
			}
			
			
			$filtrox = $filtro1." ".$filtro4." ".$filtro56." ".$filtro7." ".$filtro8." ".$filtrof;
			
				
			//echo $filtrox;
			
			if($id_filtro >= 1){
			
			
				$listar = $this->db->prepare("	SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
												FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
												WHERE t1.id >= '1' AND t2.id = '$id_filtro' " .$filtrox. "
												ORDER BY t1.id	
												
											"); 
			
			}
			else{
			
				$listar = $this->db->prepare("	SELECT t1.id,t1.fecha,t1.hora,t1.des,t2.empleado,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado
												FROM (so_ticket t1 INNER JOIN pa_usuario t2 ON t1.iduser = t2.id)
												WHERE t1.id >= '1' " .$filtrox. "
												ORDER BY t1.id	
												
											"); 
			}
			
					  
		
			$listar->execute();

  			return $listar;
	

	}
	
	
	function get_datos_SOLICITUDES_HISTORIAL_FILTRO(){
	
			
			
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro4;
			$filtro56;
			$filtro7;
			$filtro8;
			
			$id_filtro = trim($_GET['id_filtro']);
			
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$datox1    = trim($_GET['datox1']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			$datox8    = trim($_GET['datox8']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox5) && !empty($datox6) ) {
			
				
				$filtro56 = " AND ( DATE(t1.fecha_respuesta) >= '$datox5' AND DATE(t1.fecha_respuesta) <= '$datox6') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id_so_ticket = '$datox1' ";
				
	
			}
			
			if ( !empty($datox7) ) {
			
				
				
				$filtro7 = " AND t1.iduser = '$datox7' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}
			
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.des LIKE '%$datox4%' ";
				
	
			}
			
			
			$filtrox = $filtro1." ".$filtro4." ".$filtro56." ".$filtro7." ".$filtro8." ".$filtrof;
			
				
			//echo $filtrox;
			
			if($id_filtro >= 1){
			
			
				$listar = $this->db->prepare("	SELECT t1.id,t1.fecha,t1.hora,t1.des,t1.iduser,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado,id_so_ticket
												FROM so_ticket_historial t1 
												WHERE t1.id >= '1' AND t2.id = '$id_filtro' " .$filtrox. "
												ORDER BY t1.id DESC	
												
											"); 
			
			}
			else{
			
				$listar = $this->db->prepare("	SELECT t1.id,t1.fecha,t1.hora,t1.des,t1.iduser,t1.fecha_respuesta,t1.hora_respuesta,t1.respuesta,t1.estado,id_so_ticket
												FROM so_ticket_historial t1 
												WHERE t1.id >= '1' " .$filtrox. "
												ORDER BY t1.id DESC
												
											"); 
			}
			
					  
		
			$listar->execute();

  			return $listar;
	

	}
	
	
	
	function get_datos_AUDIENCIAS_FILTRO(){
	
			
			
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro5;
			$filtro6;
			
			
			$fechad    = trim($_GET['datox3']);
			$fechah    = trim($_GET['datox4']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			$id_filtro_u = trim($_GET['id_filtro_u']); 
			$id_juzgado  = trim($_GET['id_juzgado']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				//$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
				
	
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t2.radicado = '$datox2' ";
				
	
			}
			
			
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.id_juzgado = '$datox5' ";
				
	
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.estado = '$datox6' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			/*if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}*/
			
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro5." ".$filtro6." ".$filtrof;
			
				
			//echo $filtrox;
			
			
			if($id_filtro_u >= 1){
			
				$listar = $this->db->prepare( "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
												t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg
												FROM (((siepro_audiencia_juzgado t1
												INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
												INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
												LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
												WHERE t1.id >= '1' AND t1.id_juzgado = '$id_juzgado' " .$filtrox. "
												ORDER BY t1.id	" );
			
			}
			else{
			
				$listar = $this->db->prepare( "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
												t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg
												FROM (((siepro_audiencia_juzgado t1
												INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
												INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
												LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
												WHERE t1.id >= '1' " .$filtrox. "
												ORDER BY t1.id	" );
			}
			

			$listar->execute();

  			return $listar;
	

	}
	
	function get_datos_AUDIENCIAS_FILTRO_HISTORIAL(){
	
			
			
		
			$filtrox;
			
			$filtrof;
			
			$filtro1;
			$filtro2;
			$filtro5;
			$filtro6;
			
			
			$fechad    = trim($_GET['datox3']);
			$fechah    = trim($_GET['datox4']);
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			
			$id_filtro_u = trim($_GET['id_filtro_u']); 
			$id_juzgado  = trim($_GET['id_juzgado']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				//$filtrof = " AND ( DATE(t1.fecha) >= '$fechad' AND DATE(t1.fecha) <= '$fechah') ";
				
				$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id_audi = '$datox1' ";
				
	
			}
			
			if ( !empty($datox2) ) {
			
				
				
				$filtro2 = " AND t2.radicado = '$datox2' ";
				
	
			}
			
			
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.id_juzgado = '$datox5' ";
				
	
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.estado = '$datox6' ";
				
	
			}
			
			//SE REALIZA ASI EL FILTRO POR QUE CERO NO APLICA CON LA FUNCION empty
			/*if ( $datox8 != '' ) {
			
				
				$filtro8 = " AND t1.estado = '$datox8' ";
				
	
			}*/
			
			
			
			$filtrox = $filtro1." ".$filtro2." ".$filtro5." ".$filtro6." ".$filtrof;
			
				
			//echo $filtrox;
			
			
			if($id_filtro_u >= 1){
			
				$listar = $this->db->prepare( "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
												t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.id_audi,t1.fecha_reg
												FROM (((siepro_audiencia_juzgado_h t1
												INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
												INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
												LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
												WHERE t1.id >= '1' AND t1.id_juzgado = '$id_juzgado' " .$filtrox. "
												ORDER BY t1.id	" );
			
			}
			else{
			
				$listar = $this->db->prepare( "	SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
												t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.id_audi,t1.fecha_reg
												FROM (((siepro_audiencia_juzgado_h t1
												INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
												INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
												LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
												WHERE t1.id >= '1' " .$filtrox. "
												ORDER BY t1.id	" );
			}
			

			$listar->execute();

  			return $listar;
	

	}




	public function Cantidad_Horas_Audiencia($idaudiencia,$id_tabla){
   
   		
		if($id_tabla == "AUDIENCIA"){
			$TABLA = 'siepro_audiencia_juzgado';
		}
		if($id_tabla == "HISTORIAL"){
			$TABLA = 'siepro_audiencia_juzgado_h';
		}
		
		//SE REALIZA EL CAMBIO EN LA SQL, PARA QUE SE SUMEN TAMBIEN LAS HORAS DEL MEDIO DIA							  
		$listar = $this->db->prepare("SELECT SEC_TO_TIME(

										 SUM(

											 TIME_TO_SEC(


								
								

											   /*TIMEDIFF(hora_final,hora_inicio)*/

								
												 CASE

													WHEN
								
													  /*(hora_ini >= '07:00' AND hora_ini <= '12:00') AND (hora_fini >= '14:00' AND hora_fini <= '23:00')*/
													  
													  (hora_ini >= '07:00' AND hora_ini <= '23:00') 
								
													  THEN
								
														/*TIMEDIFF( TIMEDIFF(hora_fini,hora_ini),'2:00')*/
														
														TIMEDIFF( TIMEDIFF(hora_fini,hora_ini),'0:00')

													  ELSE
								
														TIMEDIFF(hora_fini,hora_ini)
								

												END
								
								
											 )
										 )
								
									   )

									   AS cantidadhoras

								FROM $TABLA
								WHERE id = '$idaudiencia'");
									  
		
		$listar->execute();
			  
		return $listar; 
	
   }
   
   
   //CON RADICADO
   function get_datos_HCET(){
   
	
			$idradi_reporte = trim($_GET['idradi_reporte']);
			$radi_reporte   = trim($_GET['radi_reporte']);
			
			
			$listar = $this->db->prepare("	SELECT
											t1.idhoja AS ID_HOJA,
											t2.radicado AS RADICADO,
											t1.fecha AS FECHA_EMISION,
											t1.orderpago AS ORDEN_PAGO_NUMERO,
											t1.valor AS VALOR,
											t1.fechapago AS FECHA_ENTREGA,
											t1.beneficiario AS BENEFICIARIO
											FROM (titulos t1
											INNER JOIN ubicacion_expediente t2 ON t1.idubicacion_expediente = t2.id)
											WHERE t2.radicado = '$radi_reporte'
											
											
										"); 
			
			
		
			$listar->execute();

  			return $listar;
	

	}
	
	//SOLO FECHAS
	function get_datos_HCET_2(){
   
	
			$dato_1hcet = trim($_GET['dato_1hcet']);
			$dato_2hcet = trim($_GET['dato_2hcet']);
			
			$listar = $this->db->prepare("	SELECT
											t1.idhoja AS ID_HOJA,
											t2.radicado AS RADICADO,
											t1.fecha AS FECHA_EMISION,
											t1.orderpago AS ORDEN_PAGO_NUMERO,
											t1.valor AS VALOR,
											t1.fechapago AS FECHA_ENTREGA,
											t1.beneficiario AS BENEFICIARIO
											FROM (titulos t1
											INNER JOIN ubicacion_expediente t2 ON t1.idubicacion_expediente = t2.id)
											WHERE (t1.fecha >= '$dato_1hcet' AND t1.fecha <= '$dato_2hcet')
											ORDER BY t2.radicado,t1.id
											
										"); 
			
			
		
			$listar->execute();

  			return $listar;
	

	}
	
	//TIPOS SOLICITUD IN(1,2,3)
	function get_datos_TIPO_SOLI(){
	
	
	
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
	
			
			
			$dato_1soli = trim($_GET['dato_1soli']);
			$dato_2soli = trim($_GET['dato_2soli']);
			
			$datox1     = trim($_GET['idssoli']);
			$datox2     = trim($_GET['mpincorporado']);
			
			$datox3     = trim($_GET['listasoli1']);
			$datox4     = trim($_GET['listasoli2']);
			
			
			if ( !empty($dato_1soli) && !empty($dato_2soli) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$dato_1soli' AND DATE(t1.fecha_registro) <= '$dato_2soli' ) ";
				
			
			}
			
			//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
			//Y EL REPORTE NO GENERE INFORMACION
			if ( $datox1 == 1 ) {
			
				$filtro1 = " ";
			}
			else{
			
				$filtro1 = " AND t1.idsolicitud ".$datox1;
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND incorporaexpediente ".$datox2;
			
			}
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND t5.idjuzgado_reparto = '$datox3' ";
			
			}
			if ( !empty($datox4) ) {
			
				
				$filtro4 = " AND t1.idusuario = '$datox4' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT
											t1.id,t1.fecha_registro,t1.radicado,
											t1.peticionario,t1.tipo_documento,t1.folios,
											t3.nombre AS jo,t4.nombre AS jd,
											t2.nombre AS solicitud,t1.fecha_entrega,t1.observacionesm,
											t5.idjuzgado_reparto AS juzgado
											FROM ((((correspondencia t1
											INNER JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
											LEFT JOIN pa_juzgado t3 ON t1.idjuzgado = t3.id)
											LEFT JOIN juzgado_destino t4 ON t1.idjuzgadodestino = t4.id)
											INNER JOIN ubicacion_expediente t5 ON t1.idubicacionexpediente = t5.id)
											WHERE t1.id >= '1' 
											AND t1.radicado != 0 " .$filtrox. "
											
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	}
	
	
	
	function get_datos_LIQUI(){
	
	
	
			$filtrox;
			
			$filtrof;
			

			$dato_1soli = trim($_GET['dato_1soli']);
			$dato_2soli = trim($_GET['dato_2soli']);
			
			
			if ( !empty($dato_1soli) && !empty($dato_2soli) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha) >= '$dato_1soli' AND DATE(t1.fecha) <= '$dato_2soli' ) ";
				
			
			}
			
			
			
	
			$filtrox = $filtrof;
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT t1.id AS IDACTU,t1.idcorrespondencia AS IDRADI,t2.radicado AS RADICADO,
											t1.fecha AS FECHA,t1.observacion AS OBS,t1.id_memorial AS IDMEMORIAL,t4.nombre AS MEMORIAL
											FROM (((detalle_correspondencia t1
											INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
											LEFT JOIN correspondencia       t3 ON t1.id_memorial       = t3.id)
											LEFT JOIN pa_solicitud          t4 ON t3.idsolicitud       = t4.id)
											WHERE t1.observacion LIKE '%CONTADOR 110%'
											AND t1.id >= 1 " .$filtrox. "
											ORDER BY t2.radicado
											
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	}
	
	function get_DEVO_DESPACHO(){
	
	
	
			$filtrox;
			
			$filtrof;
			$filtro7;
			
			
			$dato_1 = trim($_GET['dato_1']);
			$dato_2 = trim($_GET['dato_2']);
			
			$datox7 = trim($_GET['datox7']);
			
			
			if ( !empty($dato_1) && !empty($dato_2) ) {
			
				
				//$filtrof = " AND ( DATE(t1.fecha_registro) >= '$dato_1soli' AND DATE(t1.fecha_registro) <= '$dato_2soli' ) ";
				
				$filtrof = " AND ( t1.fechacerrar >= '$dato_1' AND t1.fechacerrar <= '$dato_2' ) ";
				
				
			}
			
			
			
			if ( !empty($datox7) ) {
			
				//J1
				if ( $datox7 == '15') {
					
					$datox7 = 1;
				}
				//J2
				if ( $datox7 == '16') {
					
					$datox7 = 2;
				}
			
				$filtro7 = " AND t2.idjuzgado_reparto = '$datox7'";
			
			}
			
	
			$filtrox = $filtro7." ".$filtrof;
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT t1.id AS IDACTUACION,t1.fecha AS FECHA,t1.idcorrespondencia AS IDRADICADO,t2.radicado AS RADICADO,
											t1.observacion AS OBSERVACION,t1.id_memorial AS IDMEMORIAL,t4.nombre AS TIPO,
											t1.tareacerrada AS DESCRIPCION,t1.fechacerrar AS FECHADES,t1.horacerrar AS HORADES
											FROM (((detalle_correspondencia t1
											INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
											LEFT JOIN correspondencia t3 ON t1.id_memorial = t3.id)
											LEFT JOIN pa_solicitud t4 ON t3.idsolicitud = t4.id)
											WHERE t1.id >= 1 AND t1.estadoobs = 4 " .$filtrox. "
											
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	

	 }
	 
	 function get_datos_MEMO_DESPACHO(){
	
	
	
			$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
	
			
			
			$dato_1soli = trim($_GET['dato_1soli']);
			$dato_2soli = trim($_GET['dato_2soli']);
			
			$datox1     = trim($_GET['idssoli']);
			$datox2     = trim($_GET['mpincorporado']);
			
			$datox3     = trim($_GET['listasoli1']);
			$datox4     = trim($_GET['listasoli2']);
			
			
			if ( !empty($dato_1soli) && !empty($dato_2soli) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$dato_1soli' AND DATE(t1.fecha_registro) <= '$dato_2soli' ) ";
				
			
			}
			
			//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
			//Y EL REPORTE NO GENERE INFORMACION
			if ( $datox1 == 1 ) {
			
				$filtro1 = " ";
			}
			else{
			
				$filtro1 = " AND t1.idsolicitud ".$datox1;
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND incorporaexpediente ".$datox2;
			
			}
			
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND (t5.idjuzgado_reparto = '$datox3' OR t5.idjuzgado_reparto = '$datox3')";
			
			}
			if ( !empty($datox4) ) {
			
				
				$filtro4 = " AND t1.idusuario = '$datox4' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT
											t1.id,t1.fecha_registro,t1.radicado,
											t1.peticionario,t1.tipo_documento,t1.folios,
											t3.nombre AS jo,t4.nombre AS jd,
											t2.nombre AS solicitud,t1.fecha_entrega,t1.observacionesm,
											t5.idjuzgado_reparto AS juzgado,t5.fechasalida
											FROM ((((correspondencia t1
											INNER JOIN pa_solicitud t2 ON t1.idsolicitud = t2.id)
											LEFT JOIN pa_juzgado t3 ON t1.idjuzgado = t3.id)
											LEFT JOIN juzgado_destino t4 ON t1.idjuzgadodestino = t4.id)
											INNER JOIN ubicacion_expediente t5 ON t1.idubicacionexpediente = t5.id)
											WHERE t1.id >= '1' 
											AND t1.radicado != 0 " .$filtrox. "
											AND (t5.fechasalida IS NOT NULL OR t5.fechasalida != '0000-00-00')
											AND (t5.fechadevolucion IS NULL OR t5.fechadevolucion = '0000-00-00')
											ORDER BY t1.id
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	}
	
	function get_datos_TAREA_SINCERRAR(){
	
	
	
			/*$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
	
			
			
			$dato_1soli = trim($_GET['dato_1soli']);
			$dato_2soli = trim($_GET['dato_2soli']);
			
			$datox1     = trim($_GET['idssoli']);
			$datox2     = trim($_GET['mpincorporado']);
			
			$datox3     = trim($_GET['listasoli1']);
			$datox4     = trim($_GET['listasoli2']);
			
			
			if ( !empty($dato_1soli) && !empty($dato_2soli) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$dato_1soli' AND DATE(t1.fecha_registro) <= '$dato_2soli' ) ";
				
			
			}
			
			//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
			//Y EL REPORTE NO GENERE INFORMACION
			if ( $datox1 == 1 ) {
			
				$filtro1 = " ";
			}
			else{
			
				$filtro1 = " AND t1.idsolicitud ".$datox1;
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND incorporaexpediente ".$datox2;
			
			}
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND (t5.idjuzgado_reparto = '$datox3' OR t5.idjuzgado_reparto = '$datox3')";
			
			}
			if ( !empty($datox4) ) {
			
				
				$filtro4 = " AND t1.idusuario = '$datox4' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;*/
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT t1.id AS idactu,t1.idcorrespondencia AS idradi,t2.radicado,
											t1.fecha,t1.observacion,t1.id_user_asignada,t3.empleado AS asignado,t2.fechasalida,
											t2.idjuzgado_reparto
											FROM ((detalle_correspondencia t1
											INNER JOIN ubicacion_expediente t2 ON t1.idcorrespondencia = t2.id)
											INNER JOIN pa_usuario           t3 ON t1.id_user_asignada  = t3.id)
											WHERE t1.id_user_asignada IN(4,59)
											AND t1.estadoobs = 2
											AND DATE(t1.fecha)>= '2020-08-13' AND DATE(t1.fecha)<= CURDATE()
											AND t1.observacion LIKE '%COSTAS%'
											ORDER BY t1.id DESC
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	}
	
	function get_datos_MEMOSC(){
	
	
	
			/*$filtrox;
			
			$filtrof;
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
	
			
			
			$dato_1soli = trim($_GET['dato_1soli']);
			$dato_2soli = trim($_GET['dato_2soli']);
			
			$datox1     = trim($_GET['idssoli']);
			$datox2     = trim($_GET['mpincorporado']);
			
			$datox3     = trim($_GET['listasoli1']);
			$datox4     = trim($_GET['listasoli2']);
			
			
			if ( !empty($dato_1soli) && !empty($dato_2soli) ) {
			
				
				$filtrof = " AND ( DATE(t1.fecha_registro) >= '$dato_1soli' AND DATE(t1.fecha_registro) <= '$dato_2soli' ) ";
				
			
			}
			
			//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
			//Y EL REPORTE NO GENERE INFORMACION
			if ( $datox1 == 1 ) {
			
				$filtro1 = " ";
			}
			else{
			
				$filtro1 = " AND t1.idsolicitud ".$datox1;
			
			}
			
			if ( !empty($datox2) ) {
			
				$filtro2 = " AND incorporaexpediente ".$datox2;
			
			}
			if ( !empty($datox3) ) {
			
				
				$filtro3 = " AND (t5.idjuzgado_reparto = '$datox3' OR t5.idjuzgado_reparto = '$datox3')";
			
			}
			if ( !empty($datox4) ) {
			
				
				$filtro4 = " AND t1.idusuario = '$datox4' ";
			
			}
			
	
			$filtrox = $filtro1." ".$filtro2." ".$filtro3." ".$filtro4." ".$filtrof;*/
			
											 
			
			
			$listar = $this->db->prepare("	
											SELECT
											t1.id AS idmemo,t1.fecha_registro,t5.id AS idradi,t5.radicado,
											t1.peticionario,t1.tipo_documento,t1.folios,
											t3.nombre AS jo,t4.nombre AS jd,
											t2.nombre AS solicitud,t1.fecha_entrega,t1.observacionesm,
											t5.idjuzgado_reparto AS juzgado,t8.id AS idactu,t9.empleado AS asignada,
											t5.fechasalida,t6.fechae AS fechaultimaliqui,t7.empleado AS registraultimaliqui
											FROM ((((((((correspondencia t1
											INNER JOIN pa_solicitud t2            ON t1.idsolicitud           = t2.id)
											LEFT  JOIN pa_juzgado t3              ON t1.idjuzgado             = t3.id)
											LEFT  JOIN juzgado_destino t4         ON t1.idjuzgadodestino      = t4.id)
											INNER JOIN ubicacion_expediente t5    ON t1.idubicacionexpediente = t5.id)
											LEFT  JOIN liquidacion_costas   t6    ON t1.idubicacionexpediente = t6.idradicado)
											LEFT  JOIN pa_usuario t7              ON t6.idusuario             = t7.id)
											INNER JOIN detalle_correspondencia t8 ON t5.id                    = t8.idcorrespondencia)
											INNER JOIN pa_usuario t9              ON t8.id_user_asignada      = t9.id)
											WHERE t1.id >= 1
											AND t1.radicado != 0
											AND (DATE(t1.fecha_registro) >= '2020-08-13' AND DATE(t1.fecha_registro) <= CURDATE())
											AND (t5.fechasalida >= '2020-08-13' AND t5.fechasalida <= CURDATE())
											AND (t5.fechadevolucion IS NULL OR t5.fechadevolucion = '0000-00-00')
											AND
											
											  (
												t5.fechasalida > (SELECT MAX(fechae) AS fechae FROM liquidacion_costas WHERE idradicado = t5.id AND fechae >= '2020-08-13')
												OR
												(SELECT COUNT(fechae) FROM liquidacion_costas WHERE idradicado = t5.id)  = 0
											  )
											
											AND t8.id_user_asignada IN(4,59)
											AND t8.estadoobs = 2
											GROUP BY t1.id
											ORDER BY t1.radicado,t1.id
											
										"); 
   
	
			
			
			
			
			$listar->execute();

  			return $listar;
			
			
	}
	
	
	
	//NUEVOS REPORTES EXCEL 20 OCTUBRE 2021
	
	function get_datos_PROCESOS_DESPACHO(){
	
	
			set_time_limit (240000000);
	
			$idusuario  = $_SESSION['idUsuario'];
			
			
		
			$filtrox;
			
			$filtrof;
			$filtrof_2;
			$filtrof_3;
			
			$filtro1;
			$filtro2;
			$filtro3;
			$filtro4;
			
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			$fechadad  = trim($_GET['dato_3']);
			$fechahad  = trim($_GET['dato_4']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			
			$Jid_juzgado_4 = trim($_GET['idjuzgado_repartoX']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				
				//$filtrof   = " AND (DATE(dc.fecha) >= '$fechad' AND DATE(dc.fecha) <= '$fechah')";
				
				//$filtrof_2 = "AND (ubi.fechasalida >= '$fechad' AND ubi.fechasalida <= '$fechah')";
				
				//SE DEJA ESTE FILTRO PARA QUE TRAIGA LA INFORMACION QUE CORRESPONDA A LA CONSULTA
				//YA QUE EN ALGUNOS CASOS LA fechasalida YA ES NULL Y CON EL AND NO CRUZA LA INFORMACION
				$filtrof   = " AND ( (DATE(dc.fecha) >= '$fechad' AND DATE(dc.fecha) <= '$fechah') 
				               OR (ubi.fechasalida >= '$fechad' AND ubi.fechasalida <= '$fechah'))";

				
				//$filtrof = " AND ( t1.fecha >= '$fechad' AND t1.fecha <= '$fechah') ";
				
			
			}
			
			if ( !empty($fechadad) && !empty($fechahad) ) {
			
				
				
				
				$filtrof_3 = " AND ( ubi.fechasalida >= '$fechadad' AND ubi.fechasalida <= '$fechahad') ";
				
			
			}
			
			/*if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}*/
			
			if ( !empty($datox2) ) {
			
				
				//CAMBIO EL 1 DE SEPTIEMBRE 2020
				
				//$filtro2 = " AND ubi.radicado = '$datox2' ";
				
				$filtro2 = " AND ubi.radicado LIKE '%$datox2%' ";
			
			}
			
			if ( !empty($datox3) ) {
			
				
				
				$filtro3 = " AND dc.id_user_asignada = '$datox3' ";
			
			}
			
			//EN PROCESO
			//if ( $datox4 == 'NULL' ) {
			if ( $datox4 == '0' ) {
			
				//$filtro4 = " AND dc.estadoobs IS NULL ";
				
				$filtro4 = " AND dc.estadoobs = '$datox4' ";
			}
			else{
			
				if( !empty($datox4) ) {
			
				
				
					$filtro4 = " AND dc.estadoobs = '$datox4' ";
					
				}
			
			}
			
		
			
			
			$filtrox = $filtro2." ".$filtro3." ".$filtro4." ".$filtrof." ".$filtrof_2." ".$filtrof_3;
		
			//LIMIT 30
			
			//SI LAS TAREAS ESTAN EN PROCESO, ASIGNADAS O PARA REVISAR
			//SE AGRUPA POR GROUP BY ubi.id
			if ( $datox4 == '0' || $datox4 == 2 || $datox4 == 5) {
			
				$listar = $this->db->prepare("
				
												SELECT 
												
												dc.id AS idactu,ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,
												t2.nombre AS solicitud,t1.ruta_local,dc.id_memorial,
												dc.idestadorevisojuz,dc.idrevisojuz2,dc.fecharevisado,dc.horarevisado,t3.empleado,
												dc.id_user_asignada,dc.fecha_obs_i,dc.fecha_obs_f,dc.juzobsextra,dc.estadoobs,
												dc.fecha_obs_i,dc.fecha_obs_f,dc.tareacerrada,dc.fechacerrar,dc.horacerrar,ubi.digitalizado,
												dc.desde_reparto,ubi.fechasalida,t4.empleado AS userasignado
												
												FROM (((((
												
												detalle_correspondencia dc 
													  
												INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												LEFT  JOIN correspondencia       t1 ON dc.id_memorial       = t1.id)
												LEFT  JOIN pa_solicitud          t2 ON t1.idsolicitud       = t2.id)
												LEFT  JOIN pa_usuario            t3 ON dc.idrevisojuz2      = t3.id)
												LEFT  JOIN pa_usuario            t4 ON dc.id_user_asignada  = t4.id)
													  
												WHERE dc.id >= '1'" .$filtrox. "
												AND ubi.idjuzgado_reparto = '$Jid_juzgado_4'
												
												AND ((dc.a_despacho = 1)
												
												OR (dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
												
												AND dc.revisasecretaria = 1
												
												GROUP BY ubi.id
												
												ORDER BY dc.fecha DESC,ubi.radicado"
												
											);
				
				
				
													
				
				
				$listar->execute();
			
			}
			
			//SI LAS TAREAS ESTAN CANCELADAS O EN DEVOLUCION
			//NO SE AGRUPA POR GROUP BY ubi.id, YA QUE UN PROCESO
			//PUEDE TENER VARIAS TAREAS CERRADAS O DEVUELTAS COMO UN HISTORIAL
			if ( $datox4 == 3 || $datox4 == 4) {
			
				$listar = $this->db->prepare("
				
												SELECT 
												
												dc.id AS idactu,ubi.id,ubi.radicado,dc.fecha,ubi.idjuzgado_reparto,dc.observacion,
												t2.nombre AS solicitud,t1.ruta_local,dc.id_memorial,
												dc.idestadorevisojuz,dc.idrevisojuz2,dc.fecharevisado,dc.horarevisado,t3.empleado,
												dc.id_user_asignada,dc.fecha_obs_i,dc.fecha_obs_f,dc.juzobsextra,dc.estadoobs,
												dc.fecha_obs_i,dc.fecha_obs_f,dc.tareacerrada,dc.fechacerrar,dc.horacerrar,ubi.digitalizado,
												dc.desde_reparto,ubi.fechasalida,t4.empleado AS userasignado
												
												FROM (((((
												
												detalle_correspondencia dc 
													  
												INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
												LEFT  JOIN correspondencia       t1 ON dc.id_memorial       = t1.id)
												LEFT  JOIN pa_solicitud          t2 ON t1.idsolicitud       = t2.id)
												LEFT  JOIN pa_usuario            t3 ON dc.idrevisojuz2      = t3.id)
												LEFT  JOIN pa_usuario            t4 ON dc.id_user_asignada  = t4.id)
													  
												WHERE dc.id >= '1'" .$filtrox. "
												AND ubi.idjuzgado_reparto = '$Jid_juzgado_4'
												
												AND ((dc.a_despacho = 1)
												
												OR (dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
												
												AND dc.revisasecretaria = 1
												
												ORDER BY ubi.radicado"
												
											);
				
				
				
													
				
				
				$listar->execute();
				
			
			}
			

  			return $listar;
	
  	}
	
	
	function listar_memoriales_proceso($idradi){
	
	
			set_time_limit (240000000);
			
			
			$data = new sieproexcelModel();
			
			
			$fecha_actual = $data->get_fecha_actual_amd();
			
			
			$idusuario     = $_SESSION['idUsuario'];
			
			
			$listar = $this->db->prepare("
			
										  	SELECT
											dc.id AS idactu
											
											FROM ((((
											
											detalle_correspondencia dc
											
											INNER JOIN ubicacion_expediente ubi ON dc.idcorrespondencia = ubi.id)
											LEFT  JOIN correspondencia       t1 ON dc.id_memorial       = t1.id)
											LEFT  JOIN pa_solicitud          t2 ON t1.idsolicitud       = t2.id)
											LEFT  JOIN pa_usuario            t3 ON dc.idrevisojuz2      = t3.id)
											
											WHERE dc.id >= 1
											AND ubi.idjuzgado_reparto = ubi.idjuzgado_reparto
											AND (dc.estadoobs != 3 AND dc.estadoobs != 4)
											AND ((dc.a_despacho = 1) OR (dc.observacion LIKE '%Proceso con liquidacion revisada, pendiente de pasar a Despacho.%'))
											AND dc.idcorrespondencia = '$idradi'
											
											AND dc.revisasecretaria = 1
											
											ORDER BY dc.fecha DESC,ubi.radicado"
														
										);
			
			
											
											
			

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	public function listar_proceso_digital_filtro($id_radi){
	
	
			set_time_limit (240000000);
	
			$idusuario  = $_SESSION['idUsuario'];
			
			
		
			$filtrox;
			
			$filtrof;
			$filtrof_2;
			
			$filtro1;
			$filtro4;
			$filtro5;
			$filtro6;
			$filtro7;
			
			
		
			$fechad    = trim($_GET['dato_1']);
			$fechah    = trim($_GET['dato_2']);
			
			
			$datox1    = trim($_GET['datox1']);
			$datox2    = trim($_GET['datox2']);
			$datox3    = trim($_GET['datox3']);
			$datox4    = trim($_GET['datox4']);
			$datox5    = trim($_GET['datox5']);
			$datox6    = trim($_GET['datox6']);
			$datox7    = trim($_GET['datox7']);
			
			
			
			if ( !empty($fechad) && !empty($fechah) ) {
			
				
				//SE REALIZA ESTA PREGUNTA PARA DETERMINAR SI LA CONSULTA
				//A DEVOLVER ES LA DE ESTADO, Y SE TIENE ENCUENTA LA COLUMNA FECHA_ESTADO
				if ( !empty($datox7) ) {
				
					$filtrof   = " AND (t1.fecha_estado >= '$fechad' AND t1.fecha_estado <= '$fechah')";
				}
				else{
				
					$filtrof   = " AND (t1.fecha >= '$fechad' AND t1.fecha <= '$fechah')";
				
				}
				
				
			
			}
			
			
			if ( !empty($datox1) ) {
			
				
				
				$filtro1 = " AND t1.id = '$datox1' ";
			
			}
			if ( !empty($datox2) && !empty($datox3) ) {
			
				
				//$filtrof_2 = " AND (t1.folio_i >= '$datox2' AND t1.folio_f <= '$datox3')";
				
				$filtrof_2 = " AND (t1.folios >= '$datox2' AND t1.folios <= '$datox3')";
			
			}
			
			if ( !empty($datox4) ) {
			
				
				
				$filtro4 = " AND t1.cuaderno = '$datox4' ";
			
			}
			
			if ( !empty($datox5) ) {
			
				
				
				$filtro5 = " AND t1.idusuario = '$datox5' ";
			
			}
			
			if ( !empty($datox6) ) {
			
				
				
				$filtro6 = " AND t1.idusuarioedita = '$datox6' ";
			
			}
			
			if ( !empty($datox7) ) {
			
		
				$filtro7 = " AND t1.para_estado = 1 AND t1.idjuzgado = '$datox7' AND t1.tipo = 'application/pdf' ";
			
			}
			
			
		
			
			
			$filtrox = $filtro1." ".$filtro4." ".$filtro5." ".$filtro6." ".$filtro7." ".$filtrof." ".$filtrof_2;
		
			
			
			
			//SE REALIZA ESTA PREGUNTA PARA DETERMINAR SI LA CONSULTA
			//A DEVOLVER ES LA DE ESTADO, AGREGADNCO EL DATO RADICADO
			if ( !empty($datox7) ) {
			
		
				$listar = $this->db->prepare("
				
												SELECT
												t1.id,t1.idradicado,t1.fecha,t1.hora,t1.folios,
												t1.folio_i,t1.folio_f,t1.cuaderno,
												t1.foto,t1.tipo,t1.ruta,t1.des,t1.idusuario,
												t2.empleado AS registra,t4.id AS idradicadoestado,t4.radicado,
												CONCAT(t3.empleado,'/',t1.fechaedita,'/',t1.horaedita) AS edita,
												t5.des AS descuaderno,t5.orden,t1.fecha_estado,t1.orden_documento,t1.otra
												FROM ((((expe_digital t1
												INNER JOIN pa_usuario           t2 ON t1.idusuario      = t2.id)
												LEFT JOIN pa_usuario            t3 ON t1.idusuarioedita = t3.id)
												INNER JOIN ubicacion_expediente t4 ON t1.idradicado     = t4.id)
												LEFT JOIN expe_cuaderno         t5 ON t1.cuaderno       = t5.id)
												WHERE t1.id >= '1'" .$filtrox. "
												AND t1.estado != 3
												ORDER BY t5.orden,t1.orden_documento"
												
											);
			
			}
			else{
			
				$listar = $this->db->prepare("
				
												SELECT
												t1.id,t1.idradicado,t1.fecha,t1.hora,t1.folios,
												t1.folio_i,t1.folio_f,t1.cuaderno,
												t1.foto,t1.tipo,t1.ruta,t1.des,t1.idusuario,
												t2.empleado AS registra,
												CONCAT(t3.empleado,'/',t1.fechaedita,'/',t1.horaedita) AS edita,
												t4.des AS descuaderno,t4.orden,t1.idcorrespondencia,t5.id_memo_externo,t6.nombre AS dependencia,
												t1.fecha_creacion,t1.fecha_de,t1.fecha_a,t1.origen,t1.obs,t7.origen AS norigen,t1.orden_documento,
												t1.para_estado,t1.fecha_estado,t1.otra,t8.esentidad
												FROM (((((((expe_digital t1
												INNER JOIN pa_usuario     t2 ON t1.idusuario            = t2.id)
												LEFT JOIN pa_usuario      t3 ON t1.idusuarioedita       = t3.id)
												LEFT JOIN expe_cuaderno   t4 ON t1.cuaderno             = t4.id)
												LEFT JOIN correspondencia t5 ON t1.idcorrespondencia    = t5.id)
												LEFT JOIN pa_juzgado      t6 ON t1.id_dependencia       = t6.id)
												LEFT JOIN expe_origen     t7 ON t1.origen               = t7.id)
												LEFT JOIN pa_usuario_expe t8 ON t5.id_memo_peticionario = t8.id)
												WHERE t1.id >= '1'" .$filtrox. "
												AND t1.idradicado = '$id_radi'
												AND t1.estado != 3
												ORDER BY t4.orden,t1.orden_documento"
												/*ORDER BY t1.cuaderno,folio_i*/
												
											);
											
			}
			
			/*$SQL = "SELECT
												t1.id,t1.idradicado,t1.fecha,t1.hora,t1.folios,
												t1.folio_i,t1.folio_f,t1.cuaderno,
												t1.foto,t1.tipo,t1.ruta,t1.des,t1.idusuario,
												t2.empleado AS registra,
												CONCAT(t3.empleado,'/',t1.fechaedita,'/',t1.horaedita) AS edita,
												t4.des AS descuaderno,t4.orden
												FROM (((expe_digital t1
												INNER JOIN pa_usuario t2 ON t1.idusuario      = t2.id)
												LEFT JOIN pa_usuario  t3 ON t1.idusuarioedita = t3.id)
												INNER JOIN expe_cuaderno t4 ON t1.cuaderno = t4.id)
												WHERE t1.id >= '1'" .$filtrox. "
												AND t1.idradicado = '$id_radi'
												AND t1.estado != 3
												ORDER BY t4.orden,t1.id";
												
			
			echo $SQL;*/ 									
			
			
  			$listar->execute();
			
			

  			return $listar;
	
  	}
	
	
	public function get_nuevo_nombreVISUAL($nombre_archivoX,$orden_documento_siguente){
	
	
		$caracterY  = 0;
		$caracterM  = 0;
		$caracterD  = 0;
		$caracterH  = 0;
		$caracterMI = 0;
		$caracterS  = 0;
		
	
		$bandera_fecha    = 0;
		
		$nombre_archivo   = explode(".",$nombre_archivoX);
		//NOMBRE ARCHIVO SI EXTENSION
		//EJ: 200911121732-01-201900151OrdenaAOECMNotificarADemandado-Decreto720210036900
		$nombre_archivo_2 = $nombre_archivo[0];
		//SE DIVIDE EL ARCHIVO POR CARACTER "-"
		//EJ: 200911121732	01	201900151OrdenaAOECMNotificarADemandado	Decreto720210036900
		$nombre_archivo_3 = explode("-",$nombre_archivo_2);
		
		$nuevo_nombre_archivo = "";
		
		for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
			//echo $nombre_archivo_3[$x]."<br>"."<br>";
			
			$idcaracter = $nombre_archivo_3[$x];
			
			if( strlen($idcaracter) == 12 ){
		
				for($y = 0; $y < strlen($idcaracter); $y = $y + 2) {
					
					$caracterX = $idcaracter[$y].$idcaracter[$y + 1];
					
					//YEAR
					if($y == 0){
					
					
						if($caracterX >= 20){
							
							$caracterY  = 1;
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MES
					if($y == 2){
					
						if($caracterX >= 0 && $caracterX <= 12){
							
							$caracterM  = 1;	
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//DIA
					if($y == 4){
					
						if($caracterX >= 0 && $caracterX <= 31){
							
							$caracterD  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//HORA
					if($y == 6){
					
						if($caracterX >= 0 && $caracterX <= 24){
							
							$caracterH  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MINUTOS
					if($y == 8){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterMI  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//SEGUNDOS
					if($y == 10){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterS  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					
					
				}
				
				//ES IDENTIFICAR DEL FORMATO date('ymdhis')
				if($caracterY == 1 && $caracterM == 1 && $caracterD == 1 && $caracterH == 1 && $caracterMI == 1 && $caracterS == 1) {
					 
					 $bandera_fecha = 1;
				} 
				else{
				
					 $nuevo_nombre_archivo .= $idcaracter;
				}
	
			
			}//FIN if( strlen($nombre_archivo_3[$x]) == 12 ){
			else{
			
				$nuevo_nombre_archivo .= $idcaracter;
			}
			
			$caracterY  = 0;
			$caracterM  = 0;
			$caracterD  = 0;
			$caracterH  = 0;
			$caracterMI = 0;
			$caracterS  = 0;
			
			
		}//FOR PRINCIPAL for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
		
							
		return trim($nuevo_nombre_archivo);
									
		
	}
	
	
	

}//FIN CLASE

require ('views/PHPExcel-develop/Classes/PHPExcel.php');

//---------------------LINEA AGREGADA POR JORGE ANDRES VALENCIA OROZCO----------------------------------

//OPCION REPORTE
$opcion  = trim($_GET['opcion']);
$tfiltro = trim($_GET['tfiltro']);

//------------------------------------------------------------------------------------------------------

if($opcion == 1){

	$data                = new sieproexcelModel();
	
	$vector_datos        = $data->get_documentos($tfiltro);
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('C1', 'FECHA REGISTRO')
	->setCellValue('D1', 'FECHA MODIFICACION')
	->setCellValue('E1', 'NUMERO')
	->setCellValue('F1', 'VALOR')
	->setCellValue('G1', 'ADJUDICATARIO')
	->setCellValue('H1', 'EN CUSTODIA');
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($field = $vector_datos->fetch() )
	{
	
		if( $field[encustodia] == 1){
			$encustodia= "Si";
		}
		else{
			$encustodia = "No";
		}
		
		$sheet1->setCellValue('A'.$i, $field[id]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[fecharegistro]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('D'.$i, $field[fechamodificacion]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('E'.$i)->setValueExplicit($field[numero],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('F'.$i)->setValueExplicit($field[valor],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('G'.$i, utf8_encode($field[adjudicatario]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, $encustodia);
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
	$objPHPExcel->getActiveSheet()->setTitle('titulosm');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="titulosm.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


if($opcion == 2){

	$data                = new sieproexcelModel();
	
	$vector_datos        = $data->get_titulos_otros_juzgados($tfiltro);
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('C1', 'FECHA REGISTRO')
	->setCellValue('D1', 'FECHA PAGO')
	->setCellValue('E1', 'ORDENADO CON OFICIO')
	->setCellValue('F1', 'NUMERO ORDEN')
	->setCellValue('G1', 'CANTIDAD')
	->setCellValue('H1', 'VALOR')
	->setCellValue('I1', 'BENEFICIARIO');
	
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($field = $vector_datos->fetch() )
	{
	
		

		$sheet1->setCellValue('A'.$i, $field[id]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[fecharegistro]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('D'.$i, $field[fechapago]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('E'.$i)->setValueExplicit($field[ordenadooficio],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('F'.$i)->setValueExplicit($field[numero],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('G'.$i)->setValueExplicit($field[cantidad],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('H'.$i)->setValueExplicit($field[valor],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->setCellValue('I'.$i, utf8_encode($field[beneficiario]));
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
	$objPHPExcel->getActiveSheet()->setTitle('titulosoj');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="titulosoj.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 3){

	$data                = new sieproexcelModel();
	
	$fechat              = $data->get_fecha_actual_amd();
	
	$vector_datos        = $data->get_vence_terminos($fechat);
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('C1', 'FECHA TERMINO')
	->setCellValue('D1', 'REVISADO');
	
	
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	$sheet1->getStyle('C1')->applyFromArray($styleArray);
	$sheet1->getStyle('D1')->applyFromArray($styleArray);
	
	
	
	$sheet1->getStyle('A1:D1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($field = $vector_datos->fetch() )
	{
	
		

		$sheet1->setCellValue('A'.$i, $field[id]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[fecha_terminos]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[fecha_terminos]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $field[termino_revisado]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('terminos');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="terminos.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 4){

	$data                = new sieproexcelModel();
	
	$fechat              = $data->get_fecha_actual_amd();
	
	$vector_datos        = $data->get_vence_liquidacion($fechat);
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('D1', 'TRASLADO ART. 110');
	
	
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	$sheet1->getStyle('C1')->applyFromArray($styleArray);
	$sheet1->getStyle('D1')->applyFromArray($styleArray);
	
	
	
	$sheet1->getStyle('A1:D1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
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
		
		$sheet1->setCellValue('D'.$i, $field[observacion]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
	
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('paraliquidacion');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="paraliquidacion.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 5){

	$data          = new sieproexcelModel();
	
	//$fechat              = $data->get_fecha_actual_amd();
	
	$vector_datos  = $data->get_consulta_ventanilla($tfiltro);
	
	$datouser      = trim($_GET['datox1']);
	
	$nombreuser    = $data->Datos_Usuario($datouser);
	$fieldx        = $nombreuser->fetch();
	$nombreuser_b  = $fieldx[empleado];
	
	if(!empty($nombreuser_b)){
	
		$encabezado = "USUARIO VENTANILLA: ";
	}
	else{
					
		$encabezado = "CONSULTA EN VENTANILLA DE PROCESOS";
		
	}
	
	
	$fechadx    = trim($_GET['dato_1']);
	$fechahx    = trim($_GET['dato_2']);
			
			
	if ( !empty($fechadx) && !empty($fechahx) ) {
			
				
		$rangofecha = "RANGO CONSULTA: ".$fechadx." - ".$fechahx;
				
	}
	else{
	
		$encabezado = "";
		$encabezado = "CONSULTA EN VENTANILLA DE TODOS LOS PROCESOS";
		
		$rangofecha_1 = $data->get_fecha_actual_amd();
		$rangofecha	  .= "FECHA CONSULTA: ".$rangofecha_1;

	}
			
	$objPHPExcel  = new PHPExcel();
	
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
	
	//ENCABEZADO
	->setCellValue('A1', utf8_encode($encabezado.$nombreuser_b))
	->mergeCells('A1:C1')
	
	->setCellValue('A2', utf8_encode($rangofecha))
	->mergeCells('A2:C2')
	
	
	->setCellValue('A3', 'ID RADICADO')
	->setCellValue('B3', 'RADICADO')
	->setCellValue('C3', 'CANTIDAD');
	
	$sheet1->getStyle('A3')->applyFromArray($styleArray);
	$sheet1->getStyle('B3')->applyFromArray($styleArray);
	$sheet1->getStyle('C3')->applyFromArray($styleArray);
	
	
	$sheet1->getStyle('A1:C1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:C1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet1->getStyle('A1:C1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
	
	$sheet1->getStyle('A2:C2')->applyFromArray($styleArray2);
	$sheet1->getStyle('A2:C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
	$sheet1->getStyle('A2:C2')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
	);
		
		
	
	$sheet1->getStyle('A3:C3')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=4;
	while($field = $vector_datos->fetch() )
	{
	
		

		$sheet1->setCellValue('A'.$i, $field[idradicado]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
	
		$sheet1->getCell('B'.$i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[Cantidad]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		

		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A3:C3')->applyFromArray($borders);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('ventanilla');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="ventanilla.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 1000){

	$data = new sieproexcelModel();
	
	//$vector_datos  = $data->Datos_Audiencias($fd,$fh);
	
	$vector_datos  = $data->busquedad_filtro_corres();
	
	//*********************CANTIDAD REGISTROS*****************************************
	$datosaudiencia_cant = $data->busquedad_filtro_corres();
		
	$fc = 0;
	while($fila_cant = $datosaudiencia_cant->fetch()){		
		
		$fc = $fc + 1; 
		
	}
		
 	$cantregis = $fc;
	//**********************************************************************************

	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	
	//ENCABEZADO FORMATO PARA AUDIENCIAS DE GARANTIAS
	->setCellValue('A1', 'CORRESPONDENCIA')
	->mergeCells('A1:J1')
	
	
	//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
	->setCellValue('A2', "RANGO FECHA INICIAL - FECHA FINAL: ".trim($_GET['dato_1']).' - '.trim($_GET['dato_2'])." / "."RANGO FECHA ENTREGA: ".trim($_GET['dato_3'])
	.' / NUMERO DE CORRESPONDENCIA: '.$cantregis)
	->mergeCells('A2:J2')
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A3', 'ID')
	->setCellValue('B3', 'FECHA REGISTRO')
	->setCellValue('C3', 'PETICIONARIO')
	->setCellValue('D3', 'TIPO DOCUMENTO')
	->setCellValue('E3', 'FOLIOS')
	->setCellValue('F3', 'FECHA ENTREGA')
	->setCellValue('G3', 'JUZGADO DESTINO')
	->setCellValue('H3', 'SOLICITUD')
	->setCellValue('I3', 'RECIBE')
	->setCellValue('J3', 'OBSERVACIONES');
	
	
	$sheet1->getStyle('A3')->applyFromArray($styleArray);
	$sheet1->getStyle('B3')->applyFromArray($styleArray);
	$sheet1->getStyle('C3')->applyFromArray($styleArray);
	$sheet1->getStyle('D3')->applyFromArray($styleArray);
	$sheet1->getStyle('E3')->applyFromArray($styleArray);
	$sheet1->getStyle('F3')->applyFromArray($styleArray);
	$sheet1->getStyle('G3')->applyFromArray($styleArray);
	$sheet1->getStyle('H3')->applyFromArray($styleArray);
	$sheet1->getStyle('I3')->applyFromArray($styleArray);
	$sheet1->getStyle('J3')->applyFromArray($styleArray);
	
	
	$sheet1->getStyle('A1:J1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	$sheet1->getStyle('A2:J2')->applyFromArray($styleArray2);
	$sheet1->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A2:J2')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
	$sheet1->getStyle('A3:J3')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),//CDE3F6
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
	
	
	//Añadir una imagen 
	$objDrawing = new PHPExcel_Worksheet_Drawing(); 
	$objDrawing->setName('LOGO'); 
	$objDrawing->setDescription('LOGO'); 
	$objDrawing->setPath('views/images/headerdoc.png'); 
	$objDrawing->setHeight(40); 
	//$objDrawing->setCoordinates('C23'); 
	$objDrawing->setCoordinates('H1'); 
	$objDrawing->setOffsetX(10);
	//$objDrawing->setRotation(15); 
	$objDrawing->setRotation(0); 
	$objDrawing->getShadow()->setVisible(true); 
	$objDrawing->getShadow()->setDirection(36); 
	$objDrawing->setWorksheet($sheet1);
	
	
	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 4;
	
	while( $field = $vector_datos->fetch() )
	//while($i < 22 )
	{
		
		

		//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
		/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
		
		
		$sheet1->setCellValue('A'.$i, $field[id]);
		//$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold_2);
		$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'),'endcolor' => array('rgb' => 'FF0000')));
															
		$sheet1->setCellValue('B'.$i, $field[fecha_registro]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, utf8_encode($field[peticionario]));
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, utf8_encode($field[tipo_documento]));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $field[folios]);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $field[fecha_entrega]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($field[jusgadodestino]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($field[solicitud]));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($field[empleado]));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('J'.$i, utf8_encode($field[observacionesm]));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($borders);
	


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
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Generar_Correspondencia');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Generar_Correspondencia.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}	


if($opcion == 2000){

	
	//set_time_limit (240000000000);

	//$data = new sieproexcelModel();
	//$vector_datos  = $data->busquedad_filtro_corres();
	
	$fecha_estado_auto = trim($_GET['valor1']);
	$juzgado_estado    = trim($_GET['valor_juzgado_idjxxi_b']);
	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A1', 'RADICADO')
	->setCellValue('B1', 'CLASE PROCESO')
	->setCellValue('C1', 'DEMANDANTE')
	->setCellValue('D1', 'DEMANDADO')
	->setCellValue('E1', 'ACTUACION')
	->setCellValue('F1', 'FECHA AUTO');
	
	
	$sheet1->getStyle('A1')->applyFromArray($styleArray);
	$sheet1->getStyle('B1')->applyFromArray($styleArray);
	$sheet1->getStyle('C1')->applyFromArray($styleArray);
	$sheet1->getStyle('D1')->applyFromArray($styleArray);
	$sheet1->getStyle('E1')->applyFromArray($styleArray);
	$sheet1->getStyle('F1')->applyFromArray($styleArray);
	
	
	
	$sheet1->getStyle('A1:F1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:F1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	
	
	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 2;
	
	
	$serverName     = "192.168.89.20"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
	$conn           = sqlsrv_connect( $serverName, $connectionInfo);
		 
	if( $conn ) { 
		// echo "Conectado a la Base de Datoss.<br />"; 
	}
	else{ 
		echo "NO se puede conectar a la Base de Datoss.<br />"; 
		die( print_r( sqlsrv_errors(), true)); 
	}
	
	
	
	  
		$sql = (" 	SELECT t103.A103LLAVPROC AS RADICADO,
					t053.A053DESCCLAS AS CLASE_PROCESO,
					t103.A103NOMBPONE AS PONENTE,
					
					(SELECT TOP 1 [A112NOMBSUJE]
					FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
					WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') AS DEMANDANTE,
					
					(SELECT TOP 1 [A112NOMBSUJE]
					FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
					WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') AS DEMANDADO,
					
				
					t110.A110DESCACTU AS ACTUACION,
					
					CONVERT(VARCHAR(10), t110.A110FECHREGI, 103) AS FECHA_AUTO
					
					
					FROM (((T103DAINFOPROC t103 
					LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
					LEFT JOIN T101DAINFOPONE t101 ON (t101.A101CODIPONE = t103.A103CODIPONE 
					AND A101CODIENTI = '43' AND A101CODIESPE = '03')) 
					
					LEFT JOIN T110DRACTUPROC t110 ON t103.A103LLAVPROC = t110.A110LLAVPROC)
					
					WHERE t053.A053DESCCLAS NOT LIKE '%tutela%' AND t110.A110DESCACTU != 'Fijacion estado'
					
					
					AND CONVERT(VARCHAR(10), t110.A110FECHREGI, 121) >= '$fecha_estado_auto' AND CONVERT(VARCHAR(10), t110.A110FECHREGI, 121) <= '$fecha_estado_auto' 
					AND $juzgado_estado
					AND t110.A110CODIPROV IN (002,0020,0021,0022)
					ORDER BY t103.A103LLAVPROC");		
					
					
		
		
					  
		//AND t101.A101CODIPONE = '$juzgado_estado'
		
		$params  = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt    = sqlsrv_query( $conn, $sql , $params, $options );
		
		$row_count = sqlsrv_num_rows( $stmt );
				
		if ($row_count === false){
			
			echo "Error in retrieveing row count. En Consulta";
			
			/*echo '	
			
					<script languaje="JavaScript"> 
									
						var row_count = "'.$row_count.'";
				
						alert(row_count);
				
	
					</script>
					
				';*/
		}
		else{

			while( $row = sqlsrv_fetch_array( $stmt)){
		
				
		

				//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
				/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
				
			
				$sheet1->getCell('A'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
				$sheet1->setCellValue('B'.$i, utf8_encode($row['CLASE_PROCESO']));
				$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('C'.$i, utf8_encode($row['DEMANDANTE']));
				$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('D'.$i, utf8_encode($row['DEMANDADO']));
				$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('E'.$i, utf8_encode($row['ACTUACION']));
				$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('F'.$i, $row['FECHA_AUTO']);
				$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
	
				$i++;
			
			}
			
		}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($borders);
	


	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize('true');
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize('true');
	
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('ESTADO');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="ESTADO.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}


if($opcion == 3000){

	$data = new sieproexcelModel();
	
	//$vector_datos  = $data->Datos_Audiencias($fd,$fh);
	
	$vector_datos  = $data->busquedad_filtro_archivo();
	
	//*********************CANTIDAD REGISTROS*****************************************
	$datosaudiencia_cant = $data->busquedad_filtro_archivo();
		
	$fc = 0;
	while($fila_cant = $datosaudiencia_cant->fetch()){		
		
		$fc = $fc + 1; 
		
	}
		
 	$cantregis = $fc;
	//**********************************************************************************

	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	
	//ENCABEZADO FORMATO PARA AUDIENCIAS DE GARANTIAS
	//->setCellValue('A1', 'CORRESPONDENCIA')
	//->mergeCells('A1:J1')
	
	
	//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
	//->setCellValue('A2', "RANGO FECHA INICIAL - FECHA FINAL: ".trim($_GET['dato_1']).' - '.trim($_GET['dato_2'])." / "."RANGO FECHA ENTREGA: ".trim($_GET['dato_3'])
	//.' / NUMERO DE CORRESPONDENCIA: '.$cantregis)
	//->mergeCells('A2:J2')
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A1', 'ID ARCHIVO')
	->setCellValue('B1', 'YEAR')
	->setCellValue('C1', 'CAJA')
	->setCellValue('D1', 'FECHA REGISTRO')
	->setCellValue('E1', 'ID DETALLE')
	->setCellValue('F1', 'ID CARPETA')
	->setCellValue('G1', 'CARPETA')
	->setCellValue('H1', 'NUN CARPETA')
	->setCellValue('I1', 'FECHA INICIAL')
	->setCellValue('J1', 'FECHA FINAL')
	->setCellValue('K1', 'CONSECUTIVO INICIAL')
	->setCellValue('L1', 'CONSECUTIVO FINAL');
	
	
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
	
	
	/*$sheet1->getStyle('A1:J1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	$sheet1->getStyle('A2:J2')->applyFromArray($styleArray2);
	$sheet1->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A2:J2')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);*/
		
	$sheet1->getStyle('A1:L1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),//CDE3F6
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
	

	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 2;
	
	while( $field = $vector_datos->fetch() )
	//while($i < 22 )
	{
		
		

		//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
		/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
		
		
		$sheet1->setCellValue('A'.$i, $field[idarchivo]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		//$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'),'endcolor' => array('rgb' => 'FF0000')));
															
		$sheet1->setCellValue('B'.$i, $field[year]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[caja]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $field[fechsuperior]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $field[iddetalle]);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $field[idcarpeta]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($field[descarpeta]));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, $field[numerocarpeta]);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, $field[fechainicial]);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $field[fechafinal]);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('K'.$i, $field[coninicial]);
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('L'.$i, $field[confinal]);
		$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
		
		$i++;
		
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($borders);
	


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
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Administra_Archivo');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Administra_Archivo.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}

if($opcion == 4000){

	$data = new sieproexcelModel();
	
	//$vector_datos  = $data->Datos_Audiencias($fd,$fh);
	
	$vector_datos  = $data->get_datos_liquidaciones(2);
	
	//*********************CANTIDAD REGISTROS*****************************************
	$datosaudiencia_cant = $data->get_datos_liquidaciones(2);
		
	$fc = 0;
	while($fila_cant = $datosaudiencia_cant->fetch()){		
		
		$fc = $fc + 1; 
		
	}
		
 	$cantregis = $fc;
	//**********************************************************************************

	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	
	//ENCABEZADO FORMATO PARA AUDIENCIAS DE GARANTIAS
	//->setCellValue('A1', 'CORRESPONDENCIA')
	//->mergeCells('A1:J1')
	
	
	//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
	//->setCellValue('A2', "RANGO FECHA INICIAL - FECHA FINAL: ".trim($_GET['dato_1']).' - '.trim($_GET['dato_2'])." / "."RANGO FECHA ENTREGA: ".trim($_GET['dato_3'])
	//.' / NUMERO DE CORRESPONDENCIA: '.$cantregis)
	//->mergeCells('A2:J2')
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A1', 'NUN')
	->setCellValue('B1', 'FECHA')
	->setCellValue('C1', 'HORA')
	->setCellValue('D1', 'RADICADO')
	->setCellValue('E1', 'ESTADO')
	->setCellValue('F1', 'NOTA')
	->setCellValue('G1', 'NUEVO')
	->setCellValue('H1', 'LIQ. CREDITO')
	->setCellValue('I1', 'OBSERVACION')
	->setCellValue('J1', 'LIQUIDADOR')
	->setCellValue('K1', 'JUZGADO');
	
	
	
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
	
	
	
	/*$sheet1->getStyle('A1:J1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	$sheet1->getStyle('A2:J2')->applyFromArray($styleArray2);
	$sheet1->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A2:J2')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);*/
		
	$sheet1->getStyle('A1:K1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),//CDE3F6
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
	

	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 2;
	
	while( $field = $vector_datos->fetch() )
	//while($i < 22 )
	{
		
		

		//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
		/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
		
		
		$sheet1->setCellValue('A'.$i, $field[nunentrada]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		//$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'),'endcolor' => array('rgb' => 'FF0000')));
															
		$sheet1->setCellValue('B'.$i, $field[fechae]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $field[horae]);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('D' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $field[estadoe]);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, utf8_encode($field[notae]));
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, $field[nuevo]);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, $field[liquidacioncredito]);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($field[observacioncostas]));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, utf8_encode($field[empleado]));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('K'.$i, utf8_encode($field[juzgado]));
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		
		$i++;
		
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($borders);
	


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
	
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('Liquidacion_Costas');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Liquidacion_Costas.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}


if($opcion == 5000){

	$data = new sieproexcelModel();
	
	//$vector_datos  = $data->Datos_Audiencias($fd,$fh);
	
	$vector_datos  = $data->busquedad_filtro_OBSERVACION(2);
	
	//*********************CANTIDAD REGISTROS*****************************************
	$datosaudiencia_cant = $data->busquedad_filtro_OBSERVACION(2);
		
	$fc = 0;
	while($fila_cant = $datosaudiencia_cant->fetch()){		
		
		$fc = $fc + 1; 
		
	}
		
 	$cantregis = $fc;
	//**********************************************************************************

	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	
	//ENCABEZADO FORMATO PARA AUDIENCIAS DE GARANTIAS
	//->setCellValue('A1', 'CORRESPONDENCIA')
	//->mergeCells('A1:J1')
	
	
	//ENCABEZADO FORMATO PARA EL RANGO DE FECHAS SEMESTRE
	//->setCellValue('A2', "RANGO FECHA INICIAL - FECHA FINAL: ".trim($_GET['dato_1']).' - '.trim($_GET['dato_2'])." / "."RANGO FECHA ENTREGA: ".trim($_GET['dato_3'])
	//.' / NUMERO DE CORRESPONDENCIA: '.$cantregis)
	//->mergeCells('A2:J2')
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A1', 'ID')
	->setCellValue('B1', 'IDRAD')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'FECHA')
	->setCellValue('E1', 'ASIGNADA')
	->setCellValue('F1', 'OBSERVACION')
	->setCellValue('G1', 'FEC. INICIAL')
	->setCellValue('H1', 'FEC. FINAL')
	->setCellValue('I1', 'RESPUESTA')
	->setCellValue('J1', 'ESTADO');
	
	
	
	
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
	
	
	
	
	/*$sheet1->getStyle('A1:J1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	$sheet1->getStyle('A2:J2')->applyFromArray($styleArray2);
	$sheet1->getStyle('A2:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A2:J2')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);*/
		
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),//CDE3F6
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
	

	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 2;
	
	while( $field = $vector_datos->fetch() )
	//while($i < 22 )
	{
		
		

		//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
		/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
		
		
		$sheet1->setCellValue('A'.$i, $field[id]);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		//$sheet1->getStyle('A'.$i)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => 'FF0000'),'endcolor' => array('rgb' => 'FF0000')));
															
		$sheet1->setCellValue('B'.$i, $field[idcorrespondencia]);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $field[fecha]);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($field[empleado]));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, utf8_encode($field[observacion]));
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, $field[fecha_obs_i]);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, $field[fecha_obs_f]);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($field[juz_respuesta]));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$d9M = $field[estadoobs];
		if($d9M == 0){
			$d9M = "EN PROCESO";
		}
		if($d9M == 1){
			$d9M = "TERMINADA";
		}
		if($d9M == 2){
			$d9M = "FINALIZADA";
		} 
										
		$sheet1->setCellValue('J'.$i, utf8_encode($d9M));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		
		$i++;
		
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);
	


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
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('observaciones');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="observaciones.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}

if($opcion == 6000){

	//$data = new sieproexcelModel();
	//$vector_datos  = $data->busquedad_filtro_corres();
	
	$fecha_estado_auto_i = trim($_GET['valor1']);
	$fecha_estado_auto_f = trim($_GET['valor2']);
	$juzgado_estado    = trim($_GET['valor_juzgado_idjxxi_b']);
	
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
		  
		  'font' => array(
				'size'   =>  12 
			),
		);	
		
	
		
	// Agregar Informacion Encabezados Excel
	
	//INSTANCIAMOS LA CLASE
	$sheet1 = $objPHPExcel->setActiveSheetIndex(0)
	
	
	//ENCABEZADO PARA LAS COLUMNAS
	->setCellValue('A1', 'RADICADO')
	->setCellValue('B1', 'CLASE PROCESO')
	->setCellValue('C1', 'DOC IDENTIDAD')
	->setCellValue('D1', 'NOMBRE DEMANDANTE')
	->setCellValue('E1', 'APELLIDO DEMANDANTE')
	->setCellValue('F1', 'DOC IDENTIDAD')
	->setCellValue('G1', 'NOMBRE DEMANDADO')
	->setCellValue('H1', 'APELLIDO DEMANDADO')
	->setCellValue('I1', 'ACTUACION')
	->setCellValue('J1', 'FECHA AUTO')
	->setCellValue('K1', 'PONENTE');
	
	
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
	
	
	
	$sheet1->getStyle('A1:K1')->applyFromArray($styleArray2);
	$sheet1->getStyle('A1:K1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
	$sheet1->getStyle('A1:K1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	
	
	
	//PARA ADICIONAR LAS  FILAS EN EXCEL	
	$i                 = 2;
	
	
	$serverName = "192.168.89.20"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
		 
	if( $conn ) { 
		// echo "Conectado a la Base de Datoss.<br />"; 
	}
	else{ 
		echo "NO se puede conectar a la Base de Datoss.<br />"; 
		die( print_r( sqlsrv_errors(), true)); 
	}
	
	
	
	  
		$sql = (" 	SELECT t103.A103LLAVPROC AS RADICADO,
					t053.A053DESCCLAS AS CLASE_PROCESO,
					t103.A103NOMBPONE AS PONENTE,
					
					/*DEMANDANTE*/

					(SELECT TOP 1 [A112NUMESUJE] 
					FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
					WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') AS DOC_IDENTIDAD_DEMANDANTE,
					
					CASE
					
						WHEN 
						
							(SELECT TOP 1 PATINDEX('%-%',[A112NOMBSUJE]) 
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC] 
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') > 0
					
						THEN
						
							(SELECT TOP 1 RTRIM(SUBSTRING([A112NOMBSUJE],1,CHARINDEX('-', [A112NOMBSUJE])-1))
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') 
					
							
						ELSE	
					
							(SELECT TOP 1 [A112NOMBSUJE]
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') 
							
						
						END AS NOMBRE_DEMANDANTE,
						
					
					CASE
					
						WHEN 
						
							(SELECT TOP 1 PATINDEX('%-%',[A112NOMBSUJE]) 
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC] 
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001') > 0
					
						THEN
						
							(SELECT TOP 1 RTRIM(SUBSTRING([A112NOMBSUJE], CHARINDEX('-', [A112NOMBSUJE])+1, LEN([A112NOMBSUJE])))
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0001')
					
							
						ELSE	
					
							'.' 
							
						END AS APELLIDO_DEMANDANTE,	
						
												
					/*DEMANDADO*/
					
					(SELECT TOP 1 [A112NUMESUJE] 
					FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
					WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') AS DOC_IDENTIDAD_DEMANDADO,
					
					CASE
					
						WHEN 
						
							(SELECT TOP 1 PATINDEX('%-%',[A112NOMBSUJE]) 
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC] 
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') > 0
					
						THEN
						
							(SELECT TOP 1 RTRIM(SUBSTRING([A112NOMBSUJE],1,CHARINDEX('-', [A112NOMBSUJE])-1))
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') 
					
							
						ELSE	
					
							(SELECT TOP 1 [A112NOMBSUJE]
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') 
							
						
						END AS NOMBRE_DEMANDADO,
						
					
					CASE
					
						WHEN 
						
							(SELECT TOP 1 PATINDEX('%-%',[A112NOMBSUJE]) 
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC] 
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002') > 0
					
						THEN
						
							(SELECT TOP 1 RTRIM(SUBSTRING([A112NOMBSUJE], CHARINDEX('-', [A112NOMBSUJE])+1, LEN([A112NOMBSUJE])))
							FROM [ConsejoPN].[dbo].[T112DRSUJEPROC]
							WHERE [A112LLAVPROC] =  t103.A103LLAVPROC AND [A112CODISUJE] = '0002')
					
							
						ELSE	
					
							'.' 
							
						END AS APELLIDO_DEMANDADO,
					
				
					t110.A110DESCACTU AS ACTUACION,
					
					CONVERT(VARCHAR(10), t110.A110FECHREGI, 103) AS FECHA_AUTO
					
					
					FROM (((T103DAINFOPROC t103 
					LEFT JOIN T053BACLASGENE t053 ON t103.A103CODICLAS = t053.A053CODICLAS)
					LEFT JOIN T101DAINFOPONE t101 ON (t101.A101CODIPONE = t103.A103CODIPONE 
					AND (A101CODIENTI = '40' AND A101CODIESPE = '03' OR A101CODIENTI = '43' AND A101CODIESPE = '03'))) 
					
					LEFT JOIN T110DRACTUPROC t110 ON t103.A103LLAVPROC = t110.A110LLAVPROC)
					
					WHERE t110.A110LLAVPROC LIKE '%170014003%'
					AND t053.A053DESCCLAS NOT LIKE '%tutela%' AND t110.A110DESCACTU != 'Fijacion estado'
					AND t110.A110FECHREGI >= '$fecha_estado_auto_i' AND t110.A110FECHREGI <= '$fecha_estado_auto_f' 
					AND $juzgado_estado
					AND t110.A110CODIPROV IN (0020,0021)
					ORDER BY t103.A103LLAVPROC");		
					  
		//AND t101.A101CODIPONE = '$juzgado_estado'
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
		$row_count = sqlsrv_num_rows( $stmt );
				
		if ($row_count === false){
			echo "Error in retrieveing row count. En Consulta";
		}
		else{

			while( $row = sqlsrv_fetch_array( $stmt)){
		
		

				//CUANDO EL CAMPO ES RADICADO, PARA QUE NO SE DISTORCIONE EN EXCEL
				/*$sheet1->getCell('C' . $i)->setValueExplicit($field[radicado],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold); */
				
			
				$sheet1->getCell('A'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
				$sheet1->setCellValue('B'.$i, utf8_encode($row['CLASE_PROCESO']));
				$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->getCell('C'.$i)->setValueExplicit($row['DOC_IDENTIDAD_DEMANDANTE'],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('D'.$i, utf8_encode($row['NOMBRE_DEMANDANTE']));
				$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('E'.$i, utf8_encode($row['APELLIDO_DEMANDANTE']));
				$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->getCell('F'.$i)->setValueExplicit($row['DOC_IDENTIDAD_DEMANDADO'],PHPExcel_Cell_DataType::TYPE_STRING);
				$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('G'.$i, utf8_encode($row['NOMBRE_DEMANDADO']));
				$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('H'.$i, utf8_encode($row['APELLIDO_DEMANDADO']));
				$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('I'.$i, utf8_encode($row['ACTUACION']));
				$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('J'.$i, $row['FECHA_AUTO']);
				$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
				
				$sheet1->setCellValue('K'.$i, utf8_encode($row['PONENTE']));
				$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
				
	
				$i++;
			
			}
			
		}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($borders);
	


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
	
	

	//Añadir un nuevo Worksheet (HOJA DE CALCULO)
    /*$sheet1 = $objPHPExcel->createSheet(); 
    $sheet1 = $objPHPExcel->getSheet(1)->setTitle('Ensayo 2'); */
	

	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('PROCESOS');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="procesos.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;
	
}


if($opcion == 7000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_SOLICITUDES_FILTRO();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('B1', 'FECHA')
	->setCellValue('C1', 'HORA')
	->setCellValue('D1', 'DESCRIPCION')
	->setCellValue('E1', 'USUARIO')
	->setCellValue('F1', 'FECHA RESPUESTA')
	->setCellValue('G1', 'HORA RESPUESTA')
	->setCellValue('H1', 'RESPUESTA')
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->setCellValue('A'.$i, $row['id']);
		//$sheet1->setCellValue('A'.$i, $TOTALDATOS);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->setCellValue('B'.$i, $row['fecha']); 
		//$sheet1->setCellValue('B'.$i,$SQL);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['hora']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('D'.$i, utf8_encode($row['des']));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, utf8_encode($row['empleado']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('F'.$i, $row['fecha_respuesta']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('G'.$i, $row['hora_respuesta']);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('H'.$i, utf8_encode($row['respuesta']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		if($row['estado'] == 0){		
			
			$sheet1->setCellValue('I'.$i, 'EN PROCESO');
			$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		}
		if($row['estado'] == 1){		
			
			$sheet1->setCellValue('I'.$i, 'TERMINADA');
			$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		}
		if($row['estado'] == 2){		
			
			$sheet1->setCellValue('I'.$i, 'ANULADA');
			$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		}
		
		
		
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
	$objPHPExcel->getActiveSheet()->setTitle('solicitudes');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="solicitudes.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 8000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_SOLICITUDES_HISTORIAL_FILTRO();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('B1', 'FECHA')
	->setCellValue('C1', 'HORA')
	->setCellValue('D1', 'DESCRIPCION')
	->setCellValue('E1', 'USUARIO')
	->setCellValue('F1', 'FECHA RESPUESTA')
	->setCellValue('G1', 'HORA RESPUESTA')
	->setCellValue('H1', 'RESPUESTA')
	->setCellValue('I1', 'ESTADO')
	->setCellValue('J1', 'ID SOLICITUD');
	
	
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
	
	
	
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->setCellValue('A'.$i, $row['id']);
		//$sheet1->setCellValue('A'.$i, $TOTALDATOS);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->setCellValue('B'.$i, $row['fecha']); 
		//$sheet1->setCellValue('B'.$i,$SQL);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['hora']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('D'.$i, utf8_encode($row['des']));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, utf8_encode($row['iduser']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('F'.$i, $row['fecha_respuesta']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('G'.$i, $row['hora_respuesta']);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('H'.$i, utf8_encode($row['respuesta']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($row['estado']));
	    $sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $row['id_so_ticket']);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);
	
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
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('solicitudesH');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="solicitudesH.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}



if($opcion == 9000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_AUDIENCIAS_FILTRO();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('D1', 'HORA INICIAL')
	->setCellValue('E1', 'HORA FINAL')
	->setCellValue('F1', 'DURACION')
	->setCellValue('G1', 'ESTADO')
	->setCellValue('H1', 'CAUSAL')
	->setCellValue('I1', 'FECHA ESTADO');
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
		
	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		
		$sheet1->setCellValue('A'.$i, $row['id']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		//$sheet1->setCellValue('B'.$i, $row['fecha']); 
		$sheet1->getCell('B'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['fecha']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
		//$sheet1->setCellValue('D'.$i, utf8_encode($row['des']));
		$sheet1->setCellValue('D'.$i, $row['hora_ini']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, $row['hora_fini']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
		//CANTIDAD HORAS
		$cantidad_horas      = $data->Cantidad_Horas_Audiencia($row['id'],'AUDIENCIA');
		$fieldcantidad_horas = $cantidad_horas->fetch();
		
		$sheet1->setCellValue('F'.$i, $fieldcantidad_horas[cantidadhoras]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('G'.$i, $row['des']);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('H'.$i, utf8_encode($row['causal']));
		//$sheet1->setCellValue('H'.$i, $fechad.' - '.$fechah);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, $row['fecha_reg']);
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
	$objPHPExcel->getActiveSheet()->setTitle('audiencias');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="audiencias.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 10000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_AUDIENCIAS_FILTRO_HISTORIAL();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('D1', 'HORA INICIAL')
	->setCellValue('E1', 'HORA FINAL')
	->setCellValue('F1', 'DURACION')
	->setCellValue('G1', 'ESTADO')
	->setCellValue('H1', 'CAUSAL')
	->setCellValue('I1', 'FECHA ESTADO')
	->setCellValue('J1', 'ID_AUDI');
	
	
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
	
	
	
	
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
		
		
	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		
		$sheet1->setCellValue('A'.$i, $row['id']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		//$sheet1->setCellValue('B'.$i, $row['fecha']); 
		$sheet1->getCell('B'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['fecha']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
				
		//$sheet1->setCellValue('D'.$i, utf8_encode($row['des']));
		$sheet1->setCellValue('D'.$i, $row['hora_ini']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, $row['hora_fini']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
		//CANTIDAD HORAS
		$cantidad_horas      = $data->Cantidad_Horas_Audiencia($row['id'],'HISTORIAL');
		$fieldcantidad_horas = $cantidad_horas->fetch();
		
		$sheet1->setCellValue('F'.$i, $fieldcantidad_horas[cantidadhoras]);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('G'.$i, $row['des']);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('H'.$i, utf8_encode($row['causal']));
		//$sheet1->setCellValue('H'.$i, $fechad.' - '.$fechah);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, $row['fecha_reg']);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $row['id_audi']);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
	
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);
	
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
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('audienciasH');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="audienciasH.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 11000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_HCET();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'ID_HOJA')
	->setCellValue('B1', 'RADICADO')
	->setCellValue('C1', 'FECHA EMISION')
	->setCellValue('D1', 'ORDEN PAGO NUMERO')
	->setCellValue('E1', 'VALOR')
	->setCellValue('F1', 'FECHA ENTREGA')
	->setCellValue('G1', 'BENEFICIARIO');
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->setCellValue('A'.$i, $row['ID_HOJA']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('B'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['FECHA_EMISION']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $row['ORDEN_PAGO_NUMERO']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $row['VALOR']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['FECHA_ENTREGA']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['BENEFICIARIO']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		
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
	$objPHPExcel->getActiveSheet()->setTitle('hcet');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="hcet.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 12000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_HCET_2();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'ID_HOJA')
	->setCellValue('B1', 'RADICADO')
	->setCellValue('C1', 'FECHA EMISION')
	->setCellValue('D1', 'ORDEN PAGO NUMERO')
	->setCellValue('E1', 'VALOR')
	->setCellValue('F1', 'FECHA ENTREGA')
	->setCellValue('G1', 'BENEFICIARIO');
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
		
		

		//$sheet1->getCell('A'.$i)->setValueExplicit($row['id'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->setCellValue('A'.$i, $row['ID_HOJA']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('B'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('C'.$i, $row['FECHA_EMISION']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $row['ORDEN_PAGO_NUMERO']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $row['VALOR']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['FECHA_ENTREGA']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['BENEFICIARIO']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		
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
	$objPHPExcel->getActiveSheet()->setTitle('hcet');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="hcet.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 13000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_TIPO_SOLI();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('B1', 'FECHA REGISTRO')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'PETICIONARIO')
	->setCellValue('E1', 'TIPO DOC')
	->setCellValue('F1', 'FOLIOS')
	->setCellValue('G1', 'JO')
	->setCellValue('H1', 'JD')
	->setCellValue('I1', 'SOLICITUD')
	->setCellValue('J1', 'FECHA ENTREGA')
	->setCellValue('K1', 'OBSERVACIONES')
	->setCellValue('L1', 'JUZGADO');
	
	
	
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
	
	
	
	
	$sheet1->getStyle('A1:L1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		
		$sheet1->setCellValue('A'.$i, $row['id']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['fecha_registro']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('C'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, utf8_encode($row['peticionario']));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, $row['tipo_documento']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['folios']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['jo']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($row['jd']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($row['solicitud']));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $row['fecha_entrega']);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('K'.$i, utf8_encode($row['observacionesm']));
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('L'.$i, $row['juzgado']);
		$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
				
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($borders);

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
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('tsoli');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="tsoli.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 14000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_LIQUI();
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'IDACTU')
	->setCellValue('B1', 'IDRADI')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'FECHA')
	->setCellValue('E1', 'OBS')
	->setCellValue('F1', 'IDMEMORIAL')
	->setCellValue('G1', 'MEMORIAL');
	
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		$sheet1->setCellValue('A'.$i, $row['IDACTU']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['IDRADI']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('C'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $row['FECHA']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($row['OBS']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['IDMEMORIAL']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['MEMORIAL']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		
		
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
	$objPHPExcel->getActiveSheet()->setTitle('tliqui');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="tliqui.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


//---------------------------------PARA EXPEDIENTE DIGITAL 17 AGOSTO 2020--------------------------------------------------


if($opcion == 15000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_DEVO_DESPACHO();
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'IDACTUACION')
	->setCellValue('B1', 'FECHA')
	->setCellValue('C1', 'IDRADICADO')
	->setCellValue('D1', 'RADICADO')
	->setCellValue('E1', 'OBSERVACION')
	->setCellValue('F1', 'IDMEMORIAL')
	->setCellValue('G1', 'TIPO')
	->setCellValue('H1', 'DESCRIPCION')
	->setCellValue('I1', 'FECHADES')
	->setCellValue('J1', 'HORADES');
	
	
	
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
	
	
	$sheet1->getStyle('A1:J1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		//$sheet1->setCellValue('A'.$i, $SQL);
		$sheet1->setCellValue('A'.$i, $row['IDACTUACION']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['FECHA']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->setCellValue('C'.$i, $row['IDRADICADO']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('D'.$i)->setValueExplicit($row['RADICADO'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($row['OBSERVACION']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('F'.$i, $row['IDMEMORIAL']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['TIPO']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($row['DESCRIPCION']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, $row['FECHADES']);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $row['HORADES']);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($borders);

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
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('devodes');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="devodes.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 16000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_MEMO_DESPACHO();
	
	
	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('B1', 'FECHA REGISTRO')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'PETICIONARIO')
	->setCellValue('E1', 'TIPO DOC')
	->setCellValue('F1', 'FOLIOS')
	->setCellValue('G1', 'JO')
	->setCellValue('H1', 'JD')
	->setCellValue('I1', 'SOLICITUD')
	->setCellValue('J1', 'FECHA ENTREGA')
	->setCellValue('K1', 'OBSERVACIONES')
	->setCellValue('L1', 'JUZGADO')
	->setCellValue('M1', 'FECHA SALIDA');
	
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		
		$sheet1->setCellValue('A'.$i, $row['id']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['fecha_registro']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('C'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, utf8_encode($row['peticionario']));
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
				
		$sheet1->setCellValue('E'.$i, $row['tipo_documento']);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['folios']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['jo']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($row['jd']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, utf8_encode($row['solicitud']));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $row['fecha_entrega']);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('K'.$i, utf8_encode($row['observacionesm']));
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('L'.$i, $row['juzgado']);
		$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('M'.$i, $row['fechasalida']);
		$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
				
		
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
	$objPHPExcel->getActiveSheet()->setTitle('tmemo');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="tmemo.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 17000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_TAREA_SINCERRAR();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'IDACTU')
	->setCellValue('B1', 'IDRADI')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'FECHA')
	->setCellValue('E1', 'OBSERVACION')
	->setCellValue('F1', 'IDASIGNADO')
	->setCellValue('G1', 'ASIGNADO')
	->setCellValue('H1', 'FECHA SALIDA')
	->setCellValue('I1', 'JUZGADO');
	
	
	
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
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		
		$sheet1->setCellValue('A'.$i, $row['idactu']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['idradi']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('C'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, $row['fecha']);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($row['observacion']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['id_user_asignada']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, utf8_encode($row['asignado']));
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);		
		
		$sheet1->setCellValue('H'.$i, $row['fechasalida']);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('I'.$i, $row['idjuzgado_reparto']);
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
	$objPHPExcel->getActiveSheet()->setTitle('tareasc');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="tareasc.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

if($opcion == 18000){

	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_MEMOSC();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'IDMEMO')
	->setCellValue('B1', 'FECHA REGISTRO')
	->setCellValue('C1', 'IDRADI')
	->setCellValue('D1', 'RADICADO')
	->setCellValue('E1', 'PETICIONARIO')
	->setCellValue('F1', 'DOCUMENTO')
	->setCellValue('G1', 'FOLIOS')
	->setCellValue('H1', 'JUZGADO ORIGEN')
	->setCellValue('I1', 'JUZGADO DESTINO')
	->setCellValue('J1', 'SOLICITUD')
	->setCellValue('K1', 'FECHA ENTREGA')
	->setCellValue('L1', 'OBSERVACION')
	->setCellValue('M1', 'JUZGADO')
	->setCellValue('N1', 'IDACTU')
	->setCellValue('O1', 'ASIGNADA')
	->setCellValue('P1', 'FECHA SALIDA')
	->setCellValue('Q1', 'FECHA ULTIMA LIQUI')
	->setCellValue('R1', 'REGISTRA ULTIMA LIQUI');
	
	
	
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
	
	
	
	$sheet1->getStyle('A1:R1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($row = $vector_datos->fetch() )
	{
	
		
		
		$sheet1->setCellValue('A'.$i, $row['idmemo']);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('B'.$i, $row['fecha_registro']);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $row['idradi']);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
																	
		$sheet1->getCell('D'.$i)->setValueExplicit($row['radicado'],PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($row['peticionario']));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $row['tipo_documento']);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, $row['folios']);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, utf8_encode($row['jo']));
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);		
		
		$sheet1->setCellValue('I'.$i, utf8_encode($row['jd']));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, utf8_encode($row['solicitud']));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		
		$sheet1->setCellValue('K'.$i, $row['fecha_entrega']);
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('L'.$i, utf8_encode($row['observacionesm']));
		$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('M'.$i, $row['juzgado']);
		$sheet1->getStyle('M'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('N'.$i, $row['idactu']);
		$sheet1->getStyle('N'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('O'.$i, utf8_encode($row['asignada']));
		$sheet1->getStyle('O'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('P'.$i, $row['fechasalida']);
		$sheet1->getStyle('P'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('Q'.$i, $row['fechaultimaliqui']);
		$sheet1->getStyle('Q'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('R'.$i, utf8_encode($row['registraultimaliqui']));
		$sheet1->getStyle('R'.$i)->applyFromArray($borders_nobold);
		
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($borders);

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
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('memosc');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="memosc.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}

//NUEVOS REPORTES EXCEL 20 OCTUBRE 2021

if($opcion == 19000){

	
	set_time_limit(240000000000);
	
	
	$data         = new sieproexcelModel();
	
	$vector_datos = $data->get_datos_PROCESOS_DESPACHO();
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	
	->setCellValue('A1', 'ACTU')
	->setCellValue('B1', 'IDR')
	->setCellValue('C1', 'RADICADO')
	->setCellValue('D1', 'FECHA')
	->setCellValue('E1', 'SOLICITUD')
	->setCellValue('F1', 'OBSERVACION')
	->setCellValue('G1', 'REVISADO')
	->setCellValue('H1', 'ESTADO')
	->setCellValue('I1', 'ASIGNADO')
	->setCellValue('J1', 'TAREA')
	->setCellValue('K1', 'FI')
	->setCellValue('L1', 'FI');
	
	
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
	
	
	
	
	$sheet1->getStyle('A1:L1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($fila = $vector_datos->fetch() )
	{
	
	
		
				$d0M = $fila['idactu'];
				
				$d1M = $fila['id'];
				$d2M = $fila['radicado'];
				$d3M = $fila['fecha'];
				$d4M = $fila['idjuzgado_reparto'];
				$d5M = $fila['solicitud'];
				$d6M = $fila['observacion'];
				
				$d7M = $fila['ruta_local'];
				
				$d8M = $fila['idestadorevisojuz']; 
				
				$d9M = "SI, POR:".$fila['empleado'].", FECHA:".$fila[fecharevisado].", HORA:".$fila['horarevisado']; 


				$d10M  = $fila['estadoobs'];			
				
				$d11M   = $fila['id_user_asignada'];
				$d11M_2 = $fila['userasignado'];
				
				$d12M  = $fila['fecha_obs_i'];
				
				$d13M  = $fila['fecha_obs_f'];
				
				$d14M  = $fila['juzobsextra'];
				
				$d15M  = $fila['fecha_obs_i'];
				$d16M  = $fila['fecha_obs_f'];
				
				
				if (empty($fila['tareacerrada']) ) {
				
					$d17M  = $fila['tareacerrada'];
			
				}
				else{
				
					$d17M  = $fila['tareacerrada']."\n"."FECHA: ".$fila['fechacerrar']."\n"."HORA: ".$fila['horacerrar'];
				}
				
				
				//VARIABLE QUE INDICA QUE EL PROCESO ESTA DIGITALIZADO
				$d18M  = $fila['digitalizado'];
				
				
				$d19M  = $fila['desde_reparto'];
				
				
				$d20M  = $fila['fechasalida'];
				
				
				//SI EL ESTADO ES DIFERENTE A CANCELADO Y DEVUELTO
				//CALCULA EL ID O IDS, SI ES CANCELADO O DEVUELTO
				//MUESTRA EL ID REAL, YA QUE LOS ID DE RADICADOS NO SE AGRUPAN
				//DESDE  LA FUNCION public function listar_procesos_despacho_filtro($Jid_juzgado_4){
				if($d10M != 3 && $d10M != 4){
				
					//CARGAR LOS ID ASOCIOADOS AL RADICADO DE LA TABLA detalle_correspondencia ENVIADOA A DESPACHO
					//PARA QUE LOS PROCESOS ASIGNADOS A UNA TAREA SE APLIQUE A UN MEMORIAL
					//O MEMORIALES SEGUN ESA EL CASO
					$datosMEMOS = $data->listar_memoriales_proceso($d1M);
					
					while($filamemo = $datosMEMOS->fetch()){
					
					
						$ID_MEMOS = $filamemo['idactu'].",".$ID_MEMOS;
						
					}
					
					$ID_MEMOS = rtrim($ID_MEMOS,",");
				
				}
				else{
					$ID_MEMOS = $d0M;
				}
		
		
		
		
		
		
		$sheet1->setCellValue('A'.$i, $ID_MEMOS);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		//PARA VOLVER A CONCATENAR
		unset($ID_MEMOS);
		
		$sheet1->setCellValue('B'.$i, $d1M);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('C'.$i)->setValueExplicit($d2M,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('D'.$i, "FECHA REGISTRO:".$d3M." "."FECHA A DESPACHO:".$d20M);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, utf8_encode($d5M));
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, utf8_encode($d6M));
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		
		if(!is_null($d8M)){
														
			//revisado
			$sheet1->setCellValue('G'.$i, utf8_encode($d9M));
			$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
						
		}
		else{ 
				
			//"NO"; 
			$sheet1->setCellValue('G'.$i, utf8_encode("NO"));
			$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
				
		}		
		
		//ESTADO
		if($d10M == 0){
														
			
			$sheet1->setCellValue('H'.$i, utf8_encode("EN PROCESO"));
			$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
																	
		}
		if( $d10M == 2){
				
			
			$sheet1->setCellValue('H'.$i, utf8_encode("ASIGNADO"));
			$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
				
		}		
		if( $d10M == 3){
				
			$sheet1->setCellValue('H'.$i, utf8_encode("TAREA CERRADA"));
			$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
				
		}		
		if( $d10M == 5){
				
			$sheet1->setCellValue('H'.$i, utf8_encode("REVISAR"));
			$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
				
		}		
				
		$sheet1->setCellValue('I'.$i, utf8_encode($d11M_2));
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);	
		
		
		$sheet1->setCellValue('J'.$i, utf8_encode($d14M));
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('K'.$i,$d15M);
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);		
		
		$sheet1->setCellValue('L'.$i,$d16M);
		$sheet1->getStyle('L'.$i)->applyFromArray($borders_nobold);	
		
		
	
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($borders);

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
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('actuaciones');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="actuaciones.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


if($opcion == 20000){

	
	set_time_limit(240000000000);
	
	
	$data         = new sieproexcelModel();
	
	$vector_datos = $data->listar_proceso_digital_filtro($idradi);
	

	$objPHPExcel  = new PHPExcel();
	
	$styleArray = array(
	'font' => array(
	'bold' => true,
	'color'  => array ( 'rgb'  =>  'FFFFFF' ), 
	'size'   =>  12 
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
	->setCellValue('B1', 'N DOCUMENTO')
	->setCellValue('C1', 'IDR')
	->setCellValue('D1', 'RADICADO')
	->setCellValue('E1', 'FECHA')
	->setCellValue('F1', 'HORA')
	->setCellValue('G1', 'PAGINAS')
	->setCellValue('H1', 'CUADERNO')
	->setCellValue('I1', 'DESCRIPCION')
	->setCellValue('J1', 'REGISTRA')
	->setCellValue('K1', 'EDITA');
	
	
	
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
	
	
	
	
	
	$sheet1->getStyle('A1:K1')->getFill()->applyFromArray(
				array(
				'type'       => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '2F709F'),
				'endcolor' => array('rgb' => '2F709F')
	
				)
		);
	

	$i=2;
	while($fila = $vector_datos->fetch() )
	{
	
	
		$d0M  = $fila['id'];
		$d2M  = $fila['idradicado'];
		$d3M  = $fila['radicado'];
		$d4M  = "FECHA REGISTRO: ".$fila['fecha']." FECHA AUTO: ".$fila['fecha_estado'];
		$d5M  = $fila['hora'];
		$d6M  = $fila['folios'];
		//$d7M  = utf8_encode($fila['cuaderno']);
		$d7M  = utf8_encode($fila['descuaderno']);
		$d8M  = utf8_encode($fila['des']);
		$d9M  = utf8_encode($fila['registra']);
		$d10M = utf8_encode($fila['edita']);
		
		//NOMBRE DOCUMENTO
		$d1M_2  = explode("/",$fila['ruta']);	
		$d1M_3  = utf8_encode($d1M_2[3]);
				
		$nombre_documento = $data->get_nuevo_nombreVISUAL($d1M_3,$fila['orden_documento']);
		$d1M              = utf8_encode($nombre_documento);
					
					
		
	
		$sheet1->setCellValue('A'.$i, $d0M);
		$sheet1->getStyle('A'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('B'.$i)->setValueExplicit($d1M,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('B'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('C'.$i, $d2M);
		$sheet1->getStyle('C'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->getCell('D'.$i)->setValueExplicit($d3M,PHPExcel_Cell_DataType::TYPE_STRING);
		$sheet1->getStyle('D'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('E'.$i, $d4M);
		$sheet1->getStyle('E'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('F'.$i, $d5M);
		$sheet1->getStyle('F'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('G'.$i, $d6M);
		$sheet1->getStyle('G'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('H'.$i, $d7M);
		$sheet1->getStyle('H'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('I'.$i, $d8M);
		$sheet1->getStyle('I'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('J'.$i, $d9M);
		$sheet1->getStyle('J'.$i)->applyFromArray($borders_nobold);
		
		$sheet1->setCellValue('K'.$i, $d10M);
		$sheet1->getStyle('K'.$i)->applyFromArray($borders_nobold);
		
		
		$i++;
		
	}
	   
	$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($borders);

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
	
	
	
	// Renombrar Hoja
	$objPHPExcel->getActiveSheet()->setTitle('actuestado');
	
	
	// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="actuestado.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
	
	exit;

}


//---------------------------------FIN PARA EXPEDIENTE DIGITAL--------------------------------------------------

?>