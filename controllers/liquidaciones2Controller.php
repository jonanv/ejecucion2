<?php

class liquidaciones2Controller extends controllerBase

{



/*---------- Mensajes -------------*/

	public function mensajes(){

		if($_SESSION['id']!=""){

	  

			require 'models/liquidaciones2Model.php';

			$ls = new liquidaciones2Model();

			$ls->mensajes();

	  	}

	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function Liquidar_Costas(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/liquidaciones2Model.php';

			$modelo = new liquidaciones2Model();
					
			if($_POST){
			 
				$modelo->registrar_liquidar_costas();
		
			}
		
			$this->view->show("liquidar_costas.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
	

	}

	
	public function Liquidaciones_Listar(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/liquidaciones2Model.php';

			$modelo = new liquidaciones2Model();
			
			
					
			if($_POST){
					 
				//$modelo->modificar_proceso();
				
			}
		
			$this->view->show("liquidaciones_listar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
		

	}
	
	public function RecargarTablaLI(){

		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$model  = new liquidaciones2Model();
		
			$filtro = $model->get_datos_liquidaciones(1);
	
			$data['datos_LI'] = $filtro;
			
		
			$this->view->show("liquidaciones_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function FiltroTablaLI(){

		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$model  = new liquidaciones2Model();
		
			$filtro = $model->get_datos_liquidaciones(2);
	
			$data['datos_LI'] = $filtro;
			
			
			$this->view->show("liquidaciones_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	
	public function Administrar_Archivo_Listar(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/liquidaciones2Model.php';

			$modelo = new liquidaciones2Model();
					
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
		
			require 'models/liquidaciones2Model.php';

			$modelo = new liquidaciones2Model();
			
		
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

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
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

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
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

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->adicionar_nombre_carpeta();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Adicionar_Item(){
	
		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->adicionar_item();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Editar_Item(){
	
		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->editar_item();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Anular_Liquidacion(){
	
		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->anular_liquidacion();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Cambiar_Fecha_Liquidacion(){
	
		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->cambiar_fecha_liquidacion();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	
	public function Editar_Item_Liquidacion(){
	
		if($_SESSION['id']!=""){

			require 'models/liquidaciones2Model.php';
		
			$modelo  = new liquidaciones2Model();
			
	
			//if($_POST){
			
				$modelo->editar_item_liquidacion();
			//}
			
		
			

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
}

?>