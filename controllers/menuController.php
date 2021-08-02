<?php
class menuController extends controllerBase
{
	/***********************************************************************************/
	/*---------------------------------  Menu Usuarios --------------------------------*/
	/***********************************************************************************/
	public function menu_user()
	{
		if($_SESSION['id']!=""){
		require 'models/menuModel.php';
		require 'models/userModel.php';
		$ls = new userModel();
		$rs2=  $ls->obtFoto();
		$data['foto'] = $rs2;
		
		$this->view->show("menuppal.php",$data);
	}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}		
	}
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo archivo ------------------------------*/
	/***********************************************************************************/	
	public function mod_archivo()
	{
		if($_SESSION['id']!=""){
		
		require 'models/archivoModel.php';
		
		$ls = new archivoModel();

        $rs1 =$ls->listarUbicacion();
		$rs3=$ls->listarEstados();
		$rs7=$ls->listarEstadosDetalles();
		$rs8=$ls->listarUsuarios();
		$rs9=$ls->listarJuzgadosDestino();
		$rs10=$ls->listarJuzgadosDestino();
	//	$rs8=$ls->listarJuzgadosDestino();
	
		//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
		$rs11  = $ls->listarAsignadoa();
		$rs12  = $ls->listarActuaciones_Expedientes();
		$rs13  = $ls->listarAsignadoa();
		
		$data['datos_ubicacion'] = $rs1;
		$data['datos_estados']=$rs3;	
		$data['datos_estadosdetalles']=$rs7;	
		$data['datos_usuarios']=$rs8;
		$data['datos_juzgadodestino']=$rs9;
		$data['datos_juzgadodestinos']=$rs10;
		
		//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
		$data['datos_asignadoa'] =$rs11;
		$data['datos_actuaciones'] =$rs12;
		$data['datos_userventanilla'] =$rs13;

		
		
		
		//$data['datos_juzgados_destino']=$rs8;

		$this->view->show("archivo_filtrar_ubicacion.php", $data);
		//$this->view->show("mod_archivo.php", $data);
		}
		

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }
	}
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Liquidaciones------------------------------*/
	/***********************************************************************************/	
	public function mod_liquidaciones()
	{
		if($_SESSION['id']!=""){
		require 'models/liquidacionesModel.php';
		
		$ls = new liquidacionesModel();		
		$rs1 = $ls->listarLogArchivo();

		$data['datos_log'] = $rs1;
		
		$this->view->show("mod_liquidaciones.php", $data);
		}
		

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }
	}
	
		/***********************************************************************************/
	/*---------------------------------  Modulo Empleados ------------------------------*/
	/***********************************************************************************/	
	public function mod_empleados()
	{
		if($_SESSION['id']!=""){
		require 'models/empleadosModel.php';
		
		$ls = new empleadosModel();
		$rs1 = $ls->listarLogArchivo();
		
		$data['datos_log'] = $rs1;
		
		$this->view->show("mod_empleados.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}	
	}

	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Correspondencia ------------------------------*/
	/***********************************************************************************/	
	public function mod_correspondencia()
	{
		if($_SESSION['id']!=""){
		
			require 'models/correspondenciaModel.php';
		
			$ls = new correspondenciaModel();
			$rs1 = $ls->listarLogCorrespondencia();
		
			$data['datos_log'] = $rs1;
		
			$this->view->show("mod_correspondencia.php",$data);
			
			
		}
		else
		{
			header("refresh: 0; URL=/ejecucion/");

		}	
	}
	
	
	
	
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Solicitudes ------------------------------*/
	/***********************************************************************************/	
	public function mod_solicitudes()
	{
		if($_SESSION['id']!=""){
		require 'models/correspondenciaModel.php';
		
		$ls = new correspondenciaModel();
		$rs1 = $ls->listarLogCorrespondencia();
		
		$data['datos_log'] = $rs1;
		
		$this->view->show("mod_solicitudes.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}	
	}
	
	
	/***********************************************************************************/
	/*------------------------------  Modulo Configuracion ----------------------------*/
	/***********************************************************************************/	
	public function mod_configuracion()
	{
		if($_SESSION['id']!=""){
		require 'models/userModel.php';
		
		$ls = new userModel();
		$rs1 = $ls->listUser();
		//$rs2=  $ls->obtFoto();
		//$rs3 = $ls->tipoUser();
					
		$data['listdata'] = $rs1;
		$data['foto'] = $rs2;
		//$data['tipousuario'] = $rs3;
		
		$this->view->show("mod_configuracion.php", $data);
		}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}		

	}
	
		/***********************************************************************************/
	/*---------------------------  Modulo Consultas Siglo XXI ----------------------------*/
	/***********************************************************************************/	
	public function mod_consulta()
	{
		if($_SESSION['id']!=""){
		require 'models/consultaModel.php';
		
		$ls = new consultaModel();
		$rs1 = $ls->listarLogConsulta();
		
		$data['datos_log'] = $rs1;
		
		$this->view->show("mod_consulta.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}	

	}
	
	/***********************************************************************************/
	/*---------------------------------  Modulo calendario ------------------------------*/
	/***********************************************************************************/	
	public function mod_calendarioeventos()
	{
		if($_SESSION['id']!=""){
		require 'models/calendarioModel.php';
		
		$ls = new calendarioModel();
		
		
		$this->view->show("mod_calendarioeventos.php",$data);
		}
		else
		{
		header("refresh: 0; URL=/ejecucion/");

		}	
	}
	
	public function mod_archivo_2()
	{
	

		if($_SESSION['id']!=""){
		
				require 'models/archivoModel.php';
					
				$modelo = new archivoModel();
				$rs1    = $modelo->listarLogArchivo_2();
					
				$data['datos_log'] = $rs1;
					
				$this->view->show("mod_archivo.php",$data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
			
	}
	
	/***********************************************************************************/
	/*---------------------------------  Modulo Signot (Notificaciones) ------------------------------*/
	/***********************************************************************************/	
	public function mod_arancel()
	{
	

		if($_SESSION['id']!=""){
		
				require 'models/aranceljudicialModel.php';
					
					$modelo = new aranceljudicialModel();
					$rs1    = $modelo->listarLogArancel();
					
					$data['datos_log'] = $rs1;
					
					$this->view->show("mod_arancel.php",$data);
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
			
	}
	


}
?>