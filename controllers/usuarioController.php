<?php

class usuarioController extends controllerBase{

	
	
	//-------------------------------------
			//MODULO RECEPCION DEMANDA
	//-------------------------------------
	
	
	public function Listar_Usuario_Menu(){

		if($_SESSION['id']!=""){

		
			require 'models/usuarioModel.php';
		
		
			$modelo = new usuarioModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("usuario_menu.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	public function Listar_Usuarios(){

		if($_SESSION['id']!=""){

		
			require 'models/usuarioModel.php';
		
		
			$modelo = new usuarioModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("usuario_listar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	
	public function Registrar_Usuario(){
	

		if($_SESSION['id']!=""){

		
			require 'models/usuarioModel.php';
		
		
			$modelo = new usuarioModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("usuario_registrar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	
	
	public function Registrar_Usuarios(){
	
	
		if($_SESSION['id']!=""){

			require 'models/usuarioModel.php';

			$modelo = new usuarioModel();
			
	
			//if($_POST){
			
				$modelo->registrar_usuarios();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Busquedad_Filtro_Usuario(){
	
	
	
			if($_SESSION['id']!=""){
		
			require 'models/usuarioModel.php';

			$modelo = new usuarioModel();
			

			$this->view->show("usuario_listar.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	

	}
	
	
	
	
	public function Listar_Solicitudes_Usuarios(){

		if($_SESSION['id']!=""){

		
			require 'models/usuarioModel.php';
		
		
			$modelo = new usuarioModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("usuario_listar_solicitudes.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	
	public function Registrar_Solicitudes(){
	
	
		if($_SESSION['id']!=""){

			require 'models/usuarioModel.php';

			$modelo = new usuarioModel();
			
	
			//if($_POST){
			
				$modelo->registrar_solicitudes();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
		
	
	//-------------------------------------
			//FIN MODULO RECEPCION DEMANDA
	//-------------------------------------
	
	
	
	
	//-------------------------------------
			//MODULO CONSULTAR DEMANDA
	//-------------------------------------
	
	public function Listar_Demandas_2(){

		if($_SESSION['id']!=""){

		
			require 'models/demandaModel.php';
		
		
			$modelo = new demandaModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("demanda_listar_demandas_2.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	
	public function Registrar_Acta_Reparto(){
	

		if($_SESSION['id']!=""){

		
			require 'models/demandaModel.php';
		
		
			$modelo = new demandaModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("demanda_registrar_actareparto.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	public function Registrar_Acta_Reparto_2(){
	
	
		if($_SESSION['id']!=""){

			require 'models/demandaModel.php';

			$modelo = new demandaModel();
			
	
			//if($_POST){
			
				$modelo->registrar_acta_reparto_2();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Busquedad_Filtro(){
	
	
	
			if($_SESSION['id']!=""){
		
			require 'models/demandaModel.php';

			$modelo = new demandaModel();
			

			$this->view->show("demanda_listar_demandas_2.php", $data);
				
				
		}
		else{
			header("refresh: 0; URL=/laborales/");

		}	

	}
	
	public function Registrar_Devolucion(){
	
	
		if($_SESSION['id']!=""){

			require 'models/demandaModel.php';

			$modelo = new demandaModel();
			
	
			//if($_POST){
			
				$modelo->registrar_devolucion();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	
	public function Registrar_Devolucion_Reparto(){
	

		if($_SESSION['id']!=""){

		
			require 'models/demandaModel.php';
		
		
			$modelo = new demandaModel();
		
			//$rs1    = $modelo->listar_demanda();
		
			
			//$data['datos_juzgados'] = $rs1;
		
		
			if($_POST){

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("demanda_registrar_devoreparto.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/laborales/");

	  }



	}
	
	public function Registrar_Devolucion_Reparto_2(){
	
	
		if($_SESSION['id']!=""){

			require 'models/demandaModel.php';

			$modelo = new demandaModel();
			
	
			//if($_POST){
			
				$modelo->registrar_devolucion_reparto_2();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	//-------------------------------------
			//FIN MODULO CONSULTAR DEMANDA
	//-------------------------------------
	

	public function Cerrar_Session()
    {
			require 'models/demandaModel.php';

			$modelo = new demandaModel();
			
			$modelo->cerrar_session();
    }
	
	public function Editar_Usuario(){
	
	
		if($_SESSION['id']!=""){

			require 'models/usuarioModel.php';
			
			$modelo = new usuarioModel();
			
	
			//if($_POST){
			
				$modelo->editar_usuario();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}
	
	public function Rechazar_Solicitudes(){
	
	
		if($_SESSION['id']!=""){

			require 'models/usuarioModel.php';

			$modelo = new usuarioModel();
			
	
			//if($_POST){
			
				$modelo->rechazar_solicitudes();
			//}
			
		
	
	  	}
	  	else{

			header("refresh: 0; URL=/laborales/");
		}
	
	}

}//FIN class demandaController extends controllerBase
?>