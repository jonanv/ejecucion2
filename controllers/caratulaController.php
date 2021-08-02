<?php

class caratulaController extends controllerBase{
/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

			require 'models/signotModel.php';

			$ls = new signotModel();

			$ls->mensajes();

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function listar_fecha_actual(){
	

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
			
			$lu = new sigdocModel();
			
			$rs1=$lu->fecha_actual();
			
			
			$data['dato_fecha_actual']=$rs1;
			
			$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
		else{

			header("refresh: 0; URL=/ejecucion/");
		}



	}
	
	public function Listar_Documentos_Salientes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}

	public function Registro_Proceso(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				$modelo->registrar_proceso();
		
			}
		
			$this->view->show("signot_registro_radicado.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function Modificar_Proceso(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				$modelo->modificar_proceso();
				
			}
		
			$this->view->show("signot_modificar_proceso.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function Modificar_Proceso_2(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				$modelo->modificar_proceso_2();
				
			}
		
			$this->view->show("signot_modificar2_proceso.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function Modificar_Parte(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				$modelo->modificar_parte();
				
			}
		
			$this->view->show("signot_modificar_parte.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function Modificar_Direccion(){
	
		
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			/*if($_POST){
					 
				$modelo->modificar_direccion();
				
			}*/
		
			$this->view->show("signot_modificar_direccion.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	
	}
	
	public function Modificar_Direccion_2(){
	
		
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_GET){
					 
				$modelo->modificar_direccion();
				
			}
		
			$this->view->show("signot_modificar_direccion.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	
	}
	
	
	
	public function Corregir_Notificacion(){
	
		
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			/*if($_POST){
					 
				$modelo->modificar_direccion();
				
			}*/
		
			$this->view->show("signot_corregir_citacion.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	
	}
	
	public function Corregir_Notificacion_2(){
	
		
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				$modelo->corregir_notificacion();
				
			}
		
			$this->view->show("signot_corregir_citacion.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	
	}
	
	public function Generar_Notificacion(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				//$modelo->modificar_proceso();
				
			}
		
			$this->view->show("signot_generar_notificacion.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function GenerarNotificacionDemandado(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/signotwordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	
	public function Seguimiento_Proceso(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/signotModel.php';

			$modelo = new signotModel();
					
			if($_POST){
					 
				//$modelo->modificar_proceso();
				
			}
		
			$this->view->show("signot_seguimiento.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function Traer_Consecutivo(){
	

		if($_SESSION['id']!=""){
		
			require 'models/sigdocModel.php';
			
			$modelo = new sigdocModel();
			
			$filtro = trim($_POST['filtro']);
			
			$datos  = $modelo->get_Consecutivo($filtro);
			
			echo $datos;
			
			
			//echo $consecutivo;
			
			//$data['consecutivo'] = $consecutivo;
			
			//$this->view->show("sigdoc_documentos_salientes.php", $data);

		}
		else{

			header("refresh: 0; URL=/ejecucion/");
		}



	}
	
	
	public function FiltroTabla(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function RecargarTabla(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(1);
	
			$data['datosdocumentossalientes'] = $filtro;
		
			//$this->view->show("sigdoc_documentos_salientes.php", $data);
			
			$this->view->show("sigdoc_listar_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function GenerarDocumentoSaliente(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/wordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function Editar_documento_Saliente(){
	
		//NOTA:ESTO SE MANEJA ASI PARA NO CREAR OTRA VISTA Y OPTIMIZAR ESTE PROCESO
		//DE CREAR UNA VISTA PARA ACTUALIZAR UN DOCUMENTO, SI NO QUE SE HAGA EN EL MISMO FORMULARIO DE REGISTRO
		//VISTA sigdoc_documentos_salientes.php
	
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			//RECIBE DATOS FORMA $_GET CUANDO SE DA CLIC EN EL BOTON EDITAR DOCUMENTO DE LA VISTA
			//sigdoc_listar_documentos_salientes.php
			if($_GET){
			
				$filtro = $modelo->get_datos_documentos();
				$data['datosdocumento'] = $filtro;
			}
			//RECIBE DATOS FORMA $_POST CUANDO SE DA CLIC EN EL BOTON ACTUALIZAR DE LA VISTA
			//sigdoc_documentos_salientes.php
			if($_POST){
			
				$modelo->registrar_documentos_salientes();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	//***************************************************************************************************************
	//PARA DOCUMENTOS ENTRANTES
	
	public function Listar_Documentos_Entrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function FiltroTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(2);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function RecargarTablaEntrantes(){

		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_entrantes_usuario(1);
	
			$data['datosdocumentosentrantes'] = $filtro;
		
			$this->view->show("sigdoc_listar_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function Registro_Documentos_Entrantes(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/sigdocModel.php';

			$modelo = new sigdocModel();
					
			if($_POST){
					 
				$modelo->registrar_documentos_entrantes();
		
			}
		
			$this->view->show("sigdoc_documentos_entrantes.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
	

	}
	public function Editar_documento_Entrante(){
	
		
	
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			
			if($_GET){
			
				$filtro = $modelo->get_datos_documentos_entrantes();
				$data['datosdocumento'] = $filtro;
			}
			
			if($_POST){
			
				$modelo->registrar_documentos_entrantes();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_entrantes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Respuesta_documento_Entrante(){
	
		
		if($_SESSION['id']!=""){

			require 'models/sigdocModel.php';
		
			$modelo  = new sigdocModel();
			
			
			if($_GET){
			
				$datoid = trim($_GET[idrespuesta]);
				$data['idrespuesta'] = $datoid;
			}
			
			if($_POST){
			
				$modelo->registrar_respuesta_documento();
			}
			
		
			//$data['datosdocumento'] = $filtro;
		
			$this->view->show("sigdoc_documentos_salientes.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function RecargarTablaProcesos(){

		if($_SESSION['id']!=""){

			require 'models/caratulaModel.php';
		
			$model  = new caratulaModel();
		
			//$filtro = $model->get_datos_proceso(1);
			
			$filtro = $model->get_datos_proceso_x(1);
	
			$data['datosproceso'] = $filtro;
		
			$this->view->show("caratula_generar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function FiltroTablaProcesos(){

		if($_SESSION['id']!=""){

			require 'models/caratulaModel.php';
		
			$model  = new caratulaModel();
		
			//$filtro = $model->get_datos_proceso(2);
			
			$filtro = $model->get_datos_proceso_x(2);
	
			$data['datosproceso'] = $filtro;
		
			$this->view->show("caratula_generar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function Editar_Proceso_Anotacion(){
	
		if($_SESSION['id']!=""){

			require 'models/signotModel.php';
		
			$modelo  = new signotModel();
			
			//RECIBE DATOS FORMA $_GET CUANDO SE DA CLIC EN EL BOTON EDITAR DOCUMENTO DE LA VISTA
			//documentos_modificar.php
			if($_GET){
			
				$filtro = $modelo->get_datos_proceso_anotacion();
				$data['datosdocumento'] = $filtro;
			}
			
			//RECIBE DATOS FORMA $_POST CUANDO SE DA CLIC EN EL BOTON ACTUALIZAR DE LA VISTA
			//documentos_modificar.php
			if($_POST){
			
				$modelo->registrar_anotacion();
			}
			
		
			$this->view->show("signot_anotacion.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	

	//-------------------------------------------MODULO CARATULA-------------------------------------------------------------
	
	
	public function Caratula(){

		if($_SESSION['id']!=""){

			require 'models/caratulaModel.php';
		
			/*$model  = new sigdocModel();
		
			$filtro = $model->get_documentos_salientes_usuario(2);
	
			$data['datosdocumentossalientes'] = $filtro;*/
		
			$this->view->show("caratula_generar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function Generar_Caratula(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/documentoswordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	//MIGRAR TUTELA 7 DE JUNIO 2019
	public function Migrar_Tutela(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/caratulaModel.php';

			$modelo = new caratulaModel();
			
			//$valorradicadoconsulta       = trim($_GET['valorradicado']);
			//$data['valorradicadoconsulta'] = $valorradicadoconsulta;
					
			
			if($_GET){
					 
				
				$modelo->migrar_tutela_NV();
		
			}
		
		
			$this->view->show("caratula_generar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/cs_penales/");

		}	
		

	}
	
	
	
	
	
	
}//FIN CLASE

?>