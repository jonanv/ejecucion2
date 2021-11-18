<?php

class hojavidaController extends controllerBase

{



/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

	  

			require 'models/administrarModel.php';

			$ls = new administrarModel();

			$ls->mensajes();

	  	}

	  	else{

			header("refresh: 0; URL=/laborales/");

	  	}

	}
	
	public function Administrar_HojaVida_Listar(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
			
					
			if($_POST){
					 
				//$modelo->modificar_proceso();
				
			}
		
			$this->view->show("hojavida_listar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	
		

	}
	
	public function RecargarTablaHV(){

		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';
		
			$model  = new hojavidaModel();
		
			$filtro = $model->get_datos_hojas_vida(1);
	
			$data['datos_HV'] = $filtro;
			
		
			$this->view->show("hojavida_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}

	}
	
	public function FiltroTablaHV(){

		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';
		
			$model  = new hojavidaModel();
		
			$filtro = $model->get_datos_hojas_vida(2);
	
			$data['datos_HV'] = $filtro;
			
			
			$this->view->show("hojavida_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}

	}
	
	public function Administrar_HojaVida(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
			//$hvcedula_s         = trim($_POST['hvcedula']);
			//$data['hvcedula_s'] = $hvcedula_s;
					
			if($_POST){
			 
			 
				$modelo->registrar_administrar_hojavida();
		
			}
		
			$this->view->show("hojavida_general.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	
	

	}
	
	public function Administrar_HojaVida_CambiarFoto(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
			$hvcedula_s         = trim($_POST['hvcedula_s']);
			$data['hvcedula_s'] = $hvcedula_s;
					
			if($_POST){
			 
			 
				$modelo->registrar_administrar_hojavida_cambiarfoto();
		
			}
		
			$this->view->show("hojavida_general.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	
	

	}

	
	public function Administrar_Archivo_Listar(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/administrarModel.php';

			$modelo = new administrarModel();
					
			/*if($_POST){
			 
				$modelo->registrar_administrar_archivo();
		
			}*/
		
			$this->view->show("administrar_archivo_listar.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	
	

	}
	
	
	public function Busquedad_Filtro_Archivo(){
	
	
	
			if($_SESSION['id']!=""){
		
			require 'models/administrarModel.php';

			$modelo = new administrarModel();
			
		
			$this->view->show("administrar_archivo_listar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	

	}
	
	public function ReporteExcel(){

		if($_SESSION['id']!=""){
		
			
			require 'models/sieproexcelModel.php';

			
		}
	  	else{

			header("refresh: 0; URL=/laborales/");

	  	}

	}
	
	public function Administrar_HojaVida_Estudios(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojavida_estudios();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Administrar_HojaVida_Actos(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojavida_actos();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	
	public function Administrar_HojaVida_Adicionar_Modalidad(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojaVida_adicionar_modalidad();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Administrar_HojaVida_Adicionar_TipoModalidad(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojaVida_adicionar_tipomodalidad();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	
	
	public function Administrar_HojaVida_Eliminar_Soporte(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->Administrar_HojaVida_Eliminar_Soporte();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Administrar_HojaVida_Eliminar_Registro(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->Administrar_HojaVida_Eliminar_Registro();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	
	public function Administrar_HojaVida_Experiencia(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojavida_experiencia();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Administrar_HojaVida_Conocimientos(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojavida_conocimiento();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Administrar_HojaVida_Referencia(){
	
		if($_SESSION['id']!=""){

			require 'models/hojavidaModel.php';

			$modelo = new hojavidaModel();
			
	
			//if($_POST){
			
				$modelo->administrar_hojavida_referencia();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}

	
	public function Editar_Detalle_Encabezado_Archivo(){
	
		if($_SESSION['id']!=""){

			require 'models/administrarModel.php';
		
			$modelo  = new administrarModel();
			
	
			//if($_POST){
			
				$modelo->editar_detalle_encabezado_archivo();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Adicionar_Nombre_Carpeta(){
	
		if($_SESSION['id']!=""){

			require 'models/administrarModel.php';
		
			$modelo  = new administrarModel();
			
	
			//if($_POST){
			
				$modelo->adicionar_nombre_carpeta();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
}

?>