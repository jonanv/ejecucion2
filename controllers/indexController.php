<?php
class indexController extends controllerBase
{
   /*-------------------- Login User --------------------*/
   public function login_user()
    {
		require 'models/indexModel.php';
		
        if($_POST)
		{
			$ls = new indexModel();
			$ls->validate_user();
		}
		
		$this->view->show("index.php");
    }
	
   /*------------------- Request Password -------------------*/
   public function get_password()
    {
		require 'models/indexModel.php';
		
        if($_POST)
		{
			$ls = new indexModel();
			$ls->getback_password();
		}
    }	
	
	/*-------------------- Close Session --------------------*/
    public function close_session()
    {
		session_unset();
		session_destroy();
		
		header("refresh: 0;URL=/ejecucion/");
		die();
    }
	
		/*-------------------- Ruta Base --------------------*/
    public function ruta_base()
    {
		
		
		header("refresh: 0; URL=/ejecucion/");
		
    }
	
   /*-------------------- Error Controller --------------------*/
   public function error_controller()
    {
		$this->view->show("errors/error_controller.php");
    }
    
}
?>