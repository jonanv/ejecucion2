<?php

class demandaController extends controllerBase
{



	//-------------------------------------
	//MODULO RECEPCION DEMANDA
	//-------------------------------------

	public function Listar_Demandas()
	{

		if ($_SESSION['id'] != "") {


			require 'models/demandaModel.php';


			$modelo = new demandaModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("demanda_listar_demandas.php", $data);
		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}


	public function Registrar_Demanda()
	{


		if ($_SESSION['id'] != "") {


			require 'models/demandaModel.php';


			$modelo = new demandaModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("demanda_registrar_demanda.php", $data);
		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}



	public function Registrar_Demanda_Detalle()
	{


		if ($_SESSION['id'] != "") {

			require 'models/demandaModel.php';

			$modelo = new demandaModel();


			//if($_POST){

			$modelo->registrar_demanda_detalle();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Filtro_Usuario()
	{



		if ($_SESSION['id'] != "") {

			require 'models/demandaModel.php';

			$modelo = new demandaModel();


			$this->view->show("demanda_listar_demandas.php", $data);
		} else {
			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}


	//-------------------------------------
	//FIN MODULO RECEPCION DEMANDA
	//-------------------------------------




	//-------------------------------------
	//MODULO CONSULTAR DEMANDA
	//-------------------------------------

	public function Listar_Demandas_2()
	{

		if ($_SESSION['id'] != "") {


			require 'models/demandaModel.php';


			$modelo = new demandaModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("demanda_listar_demandas_2.php", $data);
		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}


	public function Registrar_Acta_Reparto()
	{


		if ($_SESSION['id'] != "") {


			require 'models/demandaModel.php';


			$modelo = new demandaModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("demanda_registrar_actareparto.php", $data);
		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}

	public function Registrar_Acta_Reparto_2()
	{


		if ($_SESSION['id'] != "") {

			require 'models/demandaModel.php';

			$modelo = new demandaModel();


			//if($_POST){

			$modelo->registrar_acta_reparto_2();
			//}



		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}

	public function Busquedad_Filtro()
	{



		if ($_SESSION['id'] != "") {

			require 'models/demandaModel.php';

			$modelo = new demandaModel();


			$this->view->show("demanda_listar_demandas_2.php", $data);
		} else {
			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}

	public function Registrar_Devolucion()
	{


		if ($_SESSION['id'] != "") {

			require 'models/demandaModel.php';

			$modelo = new demandaModel();


			//if($_POST){

			$modelo->registrar_devolucion();
			//}



		} else {

			header("refresh: 0; URL=/ramajudicialpublica/");
		}
	}


	//-------------------------------------
	//FIN MODULO CONSULTAR DEMANDA
	//-------------------------------------



}//FIN class demandaController extends controllerBase
