<?php

class consultaController extends controllerBase

{



	/*---------- Mensajes -------------*/



	public function mensajes()

	{

		if ($_SESSION['id'] != "") {



			require 'models/consultaModel.php';

			$ls = new consultaModel();

			$ls->mensajes();
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	/*------------- Consultar T�tulos -------------------*/

	public function consultar()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';

			$ln = new consultaModel();
			$lj = new consultaModel();
			$lm = new consultaModel();




			$this->view->show("consulta_procesos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- Consultar T�tulos -------------------*/

	public function consulta1()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';

			$ln = new consultaModel();
			$lj = new consultaModel();
			$lm = new consultaModel();


			$rs3 = $lm->consultarjusticia();


			$data['datos_justicia'] = $rs3;


			$this->view->show("consulta_procesos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Consultar Estados -------------------*/

	public function consultar_estados()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';


			$this->view->show("consulta_estados.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- Consultar Estados -------------------*/

	public function consultar_estados1()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';


			$lm = new consultaModel();
			$rs3 = $lm->consultarestados();
			$data['datos_justicia'] = $rs3;


			$this->view->show("consulta_estados.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- consultar_ponente -------------------*/

	public function consultar_ponente()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';

			$ln = new consultaModel();
			$lj = new consultaModel();
			$lm = new consultaModel();




			$this->view->show("consulta.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- consultar_ponente -------------------*/

	public function consultar_ponente1()

	{

		if ($_SESSION['id'] != "") {

			require 'models/consultaModel.php';

			$ln = new consultaModel();
			$lj = new consultaModel();
			$lm = new consultaModel();


			$rs2 = $lj->consultar_despachos_ejecucion();
			$rs3 = $lm->consultarjusticia_ponente();


			$data['datos_justicia'] = $rs3;
			$data['datos_despachos'] = $rs2;



			if ($_POST) {
				$ln->actualizarPonente();
			}



			$this->view->show("consulta.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}
}
