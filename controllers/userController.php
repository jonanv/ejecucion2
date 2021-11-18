<?php
class userController extends controllerBase
{

    /***********************************************************************************/
	/*-------------------------------- Datos Administrador ---------------------------*/
	/***********************************************************************************/
	public function mensajes()
	{
			if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$lu->mensajes();
			}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
   /***********************************************************************************/
	/*-------------------------------- Datos Administrador ---------------------------*/
	/***********************************************************************************/
	public function show_user()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listAdministrador();
			$data['listdata'] = $rs1;			
							
		$this->view->show("administrador_listar.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*----------------------  Modificar Datos Administrador ---------------------------*/
	/***********************************************************************************/
	public function actualizar_adm()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listAdministrador();		
			$data['listdata'] = $rs1;	
			
		if($_POST)
		{
			$lu->actualizarAdministrador();	
			
		}
		
		$this->view->show("administrador_modificar.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}

	/***********************************************************************************/
	/*--------------------- Cambio de Contraseña Administrador ------------------------*/
	/***********************************************************************************/
	public function adm_actualizarcontrasena()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			if($_POST)
			{
			 $rs1 = $lu->actualizarContrasenaAdministrador();
			 	
			} 
			
		
		$this->view->show("administrador_actualizarcontrasena.php");
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
		/***********************************************************************************/
	/*--------------------- Registrar Estado Civil ------------------------------------*/
	/***********************************************************************************/
	public function registrar_estado()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarEstadoCivil();
			}			
							
		$this->view->show("administrador_registrarEstado.php");
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Estado Civil -----------------------------*/
	/***********************************************************************************/
	public function show_estado()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listEstado();
			$data['listdata'] = $rs1;			
							
		$this->view->show("administrador_listarEstado.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Estado Civil ------------------------*/
	/***********************************************************************************/
	public function actualizarEstado()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listEstadoEspecifico();			
			$data['listadata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarEstado();
			}					
			$this->view->show("administrador_actualizarEstado.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Estado Civil ------------------------*/
	/***********************************************************************************/
	
	public function eliminarEstado()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarEstado();
			}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
			
	}
	/***********************************************************************************/
	/*-------------------------------- Registrar Tipo Documento -----------------------*/
	/***********************************************************************************/
	public function registrar_documento()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarTipoDocumento();
			}			
							
		$this->view->show("administrador_registrarTipo.php");
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Tipo Documento ---------------------------*/
	/***********************************************************************************/
	public function show_tipo()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listTipo();
			$data['listaTipodata'] = $rs1;			
							
		$this->view->show("administrador_listarTipo.php", $data);
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Tipo Documento ----------------------*/
	/***********************************************************************************/
	public function actualizarTipo()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listTipoEspecifico();			
			$data['listaTdata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarTipoDocumento();
			}					
			$this->view->show("administrador_actualizarTipo.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Tipo Documento ------------------------*/
	/***********************************************************************************/
	
	public function eliminarTipo()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarTipo();	
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}			
	}
	/***********************************************************************************/
	/*-------------------------------- Registrar Tipo Documento -----------------------*/
	/***********************************************************************************/
	public function registrar_salarios()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarSalario();
			}			
							
		$this->view->show("administrador_registrarSalario.php");
	  }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Aspiración Salarial ----------------------*/
	/***********************************************************************************/
	public function show_salarios()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listSalarios();
			$data['listaSdata'] = $rs1;			
							
		$this->view->show("administrador_listarSalarios.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Aspiración Salarial -----------------*/
	/***********************************************************************************/
	public function actualizarSalario()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listSalarioEspecifico();			
			$data['listaSdata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarSalario();
			}					
			$this->view->show("administrador_actualizarSalario.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Aspiración Salarial -------------------*/
	/***********************************************************************************/
	
	public function eliminarSalario()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarSalario();	
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}			
	}
	/***********************************************************************************/
	/*-------------------------------- Registrar Título Universitario -----------------*/
	/***********************************************************************************/
	public function registrar_usuario()
	{
		if($_SESSION['id']!=""){
		
		require 'models/userModel.php';
		
			$lu = new userModel();
			$lr = new userModel();
			$la = new userModel();
			
			$rs1 = $lu->listPerfilUsuario();
			$rs2 = $lu->listAreaUsuario();
			
			$data['datos_perfil']= $rs1;
			$data['datos_areas']= $rs2;
			
		    if($_POST)
			{
			$lr->registrarUsuario();
			}			
							
		$this->view->show("user_registrar.php", $data);
	}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Título Universitario ---------------------*/
	/***********************************************************************************/
	public function show_titulos()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listTitulos();
			$data['listaTidata'] = $rs1;			
							
		$this->view->show("administrador_listarTitulos.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Título Universitario ----------------*/
	/***********************************************************************************/
	public function actualizarTitulo()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listTituloEspecifico();			
			$data['listaTidata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarTitulo();
			}					
			$this->view->show("administrador_actualizarTitulo.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Título Universitario ------------------*/
	/***********************************************************************************/
	public function eliminarTitulo()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarTitulo();
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}				
	}
	/***********************************************************************************/
	/*-------------------------------- Registrar idiomas -----------------*/
	/***********************************************************************************/
	public function registrar_idioma()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarIdioma();
			}			
							
		$this->view->show("administrador_registrarIdioma.php");
	}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Idiomas ---------------------*/
	/***********************************************************************************/
	public function show_idiomas()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listIdiomas();
			$data['listaIdiomas'] = $rs1;			
							
		$this->view->show("administrador_listarIdiomas.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar idioma ----------------*/
	/***********************************************************************************/
	public function actualizarIdioma()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listIdiomaEspecifico();			
			$data['idiomadata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->actualizarIdioma();
			}					
			$this->view->show("administrador_actualizarIdioma.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Título Universitario ------------------*/
	/***********************************************************************************/
	public function eliminarIdioma()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarIdioma();
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}				
	}
	/***********************************************************************************/
	/*--------------------------- Registrar nivel Académico ---------------------------*/
	/***********************************************************************************/
	public function registrar_nivel()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarNivel();
			}			
							
		$this->view->show("administrador_registrarNivel.php");
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Datos nivel Académico --------------------------*/
	/***********************************************************************************/
	public function show_nivel()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listNivel();
			$data['listaNdata'] = $rs1;			
							
		$this->view->show("administrador_listarNivel.php", $data);
	  }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Nivel Académico ---------------------*/
	/***********************************************************************************/
	public function actualizarNivel()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listNivelEspecifico();			
			$data['listaNidata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarNivel();
			}					
			$this->view->show("administrador_actualizarNivel.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Nivel Académico -----------------------*/
	/***********************************************************************************/
	
	public function eliminarNivel()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarNivel();			
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*--------------------------- Registrar Pais --------------------------------------*/
	/***********************************************************************************/
	public function registrar_pais()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
		    if($_POST)
			{
			$lu->registrarPais();
			}			
							
		$this->view->show("administrador_registrarPais.php");
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Paises -----------------------------------*/
	/***********************************************************************************/
	public function show_pais()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listPais();
			$data['listaPdata'] = $rs1;			
							
		$this->view->show("administrador_listarPais.php", $data);
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Pais --------------------------------*/
	/***********************************************************************************/
	public function actualizarPais()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listPaisEspecifico();			
			$data['listaPidata'] = $rs1;			
			
			if($_POST)
			{
			  $lu->modificarPais();
			}					
			$this->view->show("administrador_actualizarPais.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Pais ----------------------------------*/
	/***********************************************************************************/
	
	public function eliminarPais()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarPais();		
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}		
	}
	
	/***********************************************************************************/
	/*--------------------------- Registrar Departamento ------------------------------*/
	/***********************************************************************************/
	public function registrar_departamento()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
		$lu = new userModel();
		$rs1 = $lu->listPais();		
		$data['datoPais'] = $rs1;
		
			
		    if($_POST)
			{
			$lu->registrarDepartamento();
			}			
							
		$this->view->show("administrador_registrarDepartamento.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Departamento -----------------------------*/
	/***********************************************************************************/
	public function show_departamento()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listDepartamento1();
			$data['listaDdata'] = $rs1;			
							
		$this->view->show("administrador_listarDepartamento.php", $data);
	 }
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Departamento ------------------------*/
	/***********************************************************************************/
	public function actualizarDepartamento()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();			
			$rs1 = $lu->listDepartamentoEspecifico();	
			$rs2 = $lu->listPais();	
			$data['listaDidata'] = $rs1;			
			$data['datoPais'] = $rs2;
			
			if($_POST)
			{
			  $lu->modificarDepartamento();
			}					
			$this->view->show("administrador_actualizarDepartamento.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Departamento --------------------------*/
	/***********************************************************************************/
	
	public function eliminarDepartamento()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarDepartamento();	
			}
		else
		{
		header("refresh: 0; URL=/crm/");

		}		
	}
	   	/***********************************************************************************/
	/*--------------------------- Registrar Municipio -------------------------------------*/
	/***************************************************************************************/
	public function registrar_municipio()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		require 'models/empresaModel.php';

		$lu = new userModel();
		$le = new empresaModel();
		$rs1 = $le->cargarPaises();
		$data['paises'] = $rs1;


		    if($_POST)
			{
			$lu->registrarMunicipio();
			}

		$this->view->show("administrador_registrarMunicipio.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Datos Municipio --------------------------------*/
	/***********************************************************************************/
	public function show_municipio()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();
			$rs1 = $lu->listMunicipio1();
			$data['listaMdata'] = $rs1;

		$this->view->show("administrador_listarMunicipio.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}
	}
	/***********************************************************************************/
	/*-------------------------------- Actualizar Municipio ---------------------------*/
	/***********************************************************************************/
	public function actualizarMunicipio()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$lu = new userModel();
			$rs1 = $lu->listMunicipioEspecifico();
			$rs2 = $lu->listMunicipio();
			$data['listaMudata'] = $rs1;
			$data['datoMunicipio'] = $rs2;

			if($_POST)
			{
			  $lu->modificarMunicipio();
			}
			$this->view->show("administrador_actualizarMunicipio.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*-------------------------------- Eliminar Municipio -----------------------------*/
	/***********************************************************************************/

	public function eliminarMunicipio()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';

			$ls = new userModel();
			$rs1= $ls->eliminarMunicipio();
		}
		else
		{
		header("refresh: 0; URL=/crm/");

		}	
	}
	/***********************************************************************************/
	/*------------------------------- Recordar Contrasena -----------------------------*/
	/***********************************************************************************/

	public function olvidocontrasena()
	{
		require 'models/userModel.php';

			$ls = new userModel();
			if($_POST){
			$ls->recordarcontrasena();
			}
		$this->view->show("contrasena_recordar1.php");

			
	}
	/***********************************************************************************/
	/*------------------------ modificar datos de usuario -----------------------------*/
	/***********************************************************************************/
	public function update_user()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listUser();		
			$data['listdata'] = $rs1;	

			if($_POST)
			{
				$lu->updateUser();	
				
			}
			
			$this->view->show("user_modificar.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	/***********************************************************************************/
	/*------------------------ modificar contraseña de usuario ------------------------*/
	/***********************************************************************************/
	public function passwr_user()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listUser();	
			$data['listdata'] = $rs1;			
			
			if($_POST)
			{
				$lu->passwordUser();	
			}
			
			$this->view->show("user_password.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	/*---------------------------------  Cambio de Foto -------------------------------*/
	public function photou_user()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listUser();		
				
			if($_POST)
			{
				//$lu->photoUser();	
				$lu->subirfoto();
	/*			echo '<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_configuracion"</script>';
	*/		}
			
			$this->view->show("user_chphoto.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}	
	/*---------------------------------  Enviar Correo --------------------------------*/
	public function semail_user()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/userModel.php';
		
			$lu = new userModel();
			$rs1 = $lu->listarEmpleados();
			$rs3 = $lu->listarClientes();
			
			$data['datos_empleado'] = $rs1;
			 $data['datos_cliente'] = $rs3;			
			
			if($_POST)
			{
				$lu->semailUser();	
				//echo '<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_configuracion"<script>';
			}
			
			$this->view->show("user_semail.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}	


	/***********************************************************************************/
	/*------------------------ Gestionar ------------------------*/
	/***********************************************************************************/
	public function gestionar()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/userModel.php';
		
				
			$this->view->show("gestionar.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}


}
?>