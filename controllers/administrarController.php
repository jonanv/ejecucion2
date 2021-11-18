<?php

class administrarController extends controllerBase

{



/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

	  

			require 'models/administrarModel.php';

			$ls = new administrarModel();

			$ls->mensajes();

	  	}

	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function Administrar_Archivo(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/administrarModel.php';

			$modelo = new administrarModel();
					
			if($_POST){
			 
				$modelo->registrar_administrar_archivo();
		
			}
		
			$this->view->show("administrar_archivo.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

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
			header("refresh: 0; URL=/ejecucion/");

		}	
	

	}
	
	
	public function Busquedad_Filtro_Archivo(){
	
	
	
			if($_SESSION['id']!=""){
		
			require 'models/administrarModel.php';

			$modelo = new administrarModel();
			
		
			$this->view->show("administrar_archivo_listar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	

	}
	
	public function ReporteExcel(){

		if($_SESSION['id']!=""){
		
			
			require 'models/sieproexcelModel.php';

			
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function Editar_Encabezado_Archivo(){
	
		if($_SESSION['id']!=""){

			require 'models/administrarModel.php';
		
			$modelo  = new administrarModel();
			
	
			//if($_POST){
			
				$modelo->editar_encabezado_archivo();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
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

			header("refresh: 0; URL=/ejecucion/");
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

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	
	
	
	
	
	
}

?>