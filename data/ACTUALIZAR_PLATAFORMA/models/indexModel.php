<?php

class indexModel extends modelBase{


    /***********************************************************************************/

    /*----------------------- validar el inicio de sesion -----------------------------*/

    /***********************************************************************************/	

	public function validate_user(){

		$band=0;

		//------------DATOS ENVIADOS DEL FORMULARIO DE LOGIN----------------
		
	    $user = $_POST['user'];
    	$pass = md5 ($_POST['pass']); 
		
		//CAMPO DEPARTAMENTO Y MUNICIPIO, PARA REALIZAR VALIDACIONES DE INGRESO
		//Y VISUALIZACION DE INFORMACION EN LA PLATAFORMA
		$depart = trim($_POST['listaD']);
		
		//SE CAPTURA EL VALOR DEL MUNICIPIO
		//PARA SABER EL RANGO DE HORAS EN QUE SE PUEDE
		//REGISTRAR DEMANDAS
		$muni   = trim($_POST['listaM']); 
		
		
		$select_LOGIN = $this->db->prepare("SELECT t1.des AS municipio,t2.des AS departamento
											FROM dda_municipio t1 INNER JOIN dda_departamento t2 ON t1.iddpto = t2.id
											WHERE t1.id = '$muni' AND t1.iddpto = '$depart'");
											
		$select_LOGIN->execute();
		
		while($fila = $select_LOGIN->fetch()){
		
			$Nmunicipio    = $fila['municipio'];
			$Ndepartamento = $fila['departamento'];
		
		}
		
		//NOMBRE MUNICIPIO Y DEPARTAMENTO
		//PARA UBICAR AL USUARIO DONDE ESTA
		$_SESSION['Nmunicipio']    = $Nmunicipio;
		$_SESSION['Ndepartamento'] = $Ndepartamento;
		
		//------------FIN DATOS ENVIADOS DEL FORMULARIO DE LOGIN----------------

					

		$select = $this->db->prepare('SELECT  usuario.id,usuario.nombre_usuario,usuario.idperfil,usuario.empleado,usuario.contrasena,perfil.nombre,usuario.foto, 
		                              usuario.tipo_perfil,usuario.pantalla, usuario.ingreso,usuario.id_juzgado,usuario.tipousuario,
									  usuario.iddepartamento,usuario.idmunicipio,usuario.idofireparto,usuario.nivelusuario
									  FROM pa_usuario as usuario
									  INNER JOIN pa_perfil  as perfil
									  ON (usuario.idperfil = perfil.id)
		                              WHERE usuario.nombre_usuario = :user AND  usuario.contrasena = :pass');

		$select->bindParam(':user', $user);

		$select->bindParam(':pass', $pass);

		$select->execute();
		
		while($field = $select->fetch()){
		 
		
			 $usua_perfil   = $field['nombre'];
			 $usua_empleado = $field['empleado'];
			 $usua_nom      = $field['nombre_usuario'];
			 $usua_idperfil = $field['idperfil'];
			 $usua_id       = $field['id'];
			 $foto          = $field['foto'];
			 $tipo_perfil   = $field['tipo_perfil'];
			 $pantalla      = $field['pantalla'];
			 $estado        = $field['ingreso'];
			 $id_juzgado    = $field['id_juzgado'];
			 $tipousuario   = $field['tipousuario'];
			 
			 //SE CAPTURAN PARA COMPARARCE CON LOS DATOS
			 //DE DEPARTAMENTO Y MUNICIPIO ENVIADOS DESDE EL LOGIN
			 $iddepartamento = $field['iddepartamento'];
			 $idmunicipio    = $field['idmunicipio'];
			 
			 
			 $idofireparto  = $field['idofireparto'];
			 
			 $nivelusuario  = $field['nivelusuario'];
			 
			 $band          = 1;
		
		}
		
		//SE REALIZA ESTA ASIGNACION YA QUE UN ABOGADO
		//PUEDE LLEVAR DEMANDAS EN VARIOS MUNICIPIOS
		//ENTONCES SE ASIGANAN SUS VARIABLES
		//$iddepartamento = $field['iddepartamento'] Y $idmunicipio    = $field['idmunicipio'];
		//QUE ESTAN VACIAS, CON LAS DEL LOGEO
		//$depart = trim($_POST['listaD']) Y $muni   = trim($_POST['listaM']); 
		//Y PUEDA ENTRAR EN EL if( ($depart == $iddepartamento) && ($muni == $idmunicipio) ){
		if( $tipousuario == 'PUBLICO'){
		
			$iddepartamento = $depart;
			$idmunicipio    = $muni;
		}
		
		/*if( $tipousuario == 'REPARTO'){
		
			$iddepartamento = $depart;
			$idmunicipio    = $muni;
		}*/
		
		//VALIDA QUE EL USUARIO CORRESPONDA AL MUNICIPIO SELECIONADO
		if( ($depart == $iddepartamento) && ($muni == $idmunicipio) ){
		
			$_SESSION['id']          = $usua_perfil;
			$_SESSION['nombre']      = $usua_empleado;
			$_SESSION['idUsuario']   = $usua_id;
			$_SESSION['nomusu']      = $usua_nom; 
			$_SESSION['foto']        = $foto; 
			$_SESSION['tipo_perfil'] = $tipo_perfil; 
			$_SESSION['pantalla']    = $pantalla; 
			$_SESSION['ingreso']     = $estado;
			$_SESSION['id_juzgado']  = $id_juzgado;
			$_SESSION['tipousuario'] = $tipousuario;
				
			//VARIABLES SESION DEPARTAMENTO Y MUNICIPIO
			$_SESSION['iddepartamento'] = $depart;
			$_SESSION['idmunicipio']    = $muni;
			
			$_SESSION['idofireparto']   = $idofireparto;
			
			$_SESSION['nivelusuario']   = $nivelusuario;
				
				
			if ($usua_perfil == "Administrador"){
			
		
				$_SESSION['rol'] = 'Administrador';	
				header("refresh: 0; URL=/ramajudicialpublica/");
				die();		
	
			}
	
			else if ($usua_perfil == "Archivo"){
				
			
	
				$_SESSION['rol'] = 'Archivo';
				header("refresh: 0; URL=/ramajudicialpublica/");
				die();
	
			}
			else if ($usua_perfil == "Correspondencia"){
				
				//echo "entre_model";
	
				$_SESSION['rol'] = 'Correspondencia';
				header("refresh: 0; URL=/ramajudicialpublica/");
				die();
	
			}
	
				
			
	
					
	
			if ($band==0){
	
			
				$_SESSION['invalidate_user'] = true;
				
				echo '<script languaje="JavaScript"> 
										
						
					
						alert("DATOS INVALIDOS");
					
		
					</script>';
	
			}
			
		
		}//if( ($depart == $iddepartamento) && ($muni == $idmunicipio) ){
		else{
		
				$_SESSION['invalidate_user'] = true;
				
				echo '<script languaje="JavaScript"> 
										
					
						alert("DATOS INVALIDOS, NO CUENTA CON USUARIO PARA EL ACCESO, SEGUN EL MUNICIPIO SELECCIONADO");
					
		
					</script>';
		
		}
		
		
		
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
   
   public function rango_horas_municipio($idusuario){
	
	
			//$idusuario  = $_SESSION['idUsuario'];
		
		
			$listar = $this->db->prepare("	
			
											SELECT hi,hf FROM dda_municipio 
											WHERE id = '001'
											
										");
											
											
													

  			$listar->execute();

  			return $listar;
	
  	}
	
	
	
	
}		 



?>