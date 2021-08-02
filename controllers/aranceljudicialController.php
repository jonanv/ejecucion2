<?php

class aranceljudicialController extends controllerBase
{
	/*---------- Mensajes -------------*/

	public function mensajes()
	{

		if ($_SESSION['id'] != "") {

			require 'models/aranceljudicialModel.php';

			$ls = new aranceljudicialModel();

			$ls->mensajes();
		} else {

			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function listar_fecha_actual()
	{


		if ($_SESSION['id'] != "") {

			require 'models/sigdocModel.php';

			$lu = new sidojuModel();

			$rs1 = $lu->fecha_actual();


			$data['dato_fecha_actual'] = $rs1;

			$this->view->show("sigdoc_documentos_salientes.php", $data);
		} else {

			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function Imprimir_Arancel()
	{


		if ($_SESSION['id'] != "") {

			require 'models/aranceljudicialModel.php';

			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTablaImprimirLiquidaciones()
	{

		if ($_SESSION['id'] != "") {

			require 'models/aranceljudicialModel.php';

			$model  = new aranceljudicialModel();

			$filtro = $model->get_liquidaciones_imprimir_usuario(1);

			$data['datosliquidaciones'] = $filtro;

			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTablaImprimirLiquidaciones()
	{

		if ($_SESSION['id'] != "") {

			require 'models/aranceljudicialModel.php';

			$model  = new aranceljudicialModel();

			$filtro = $model->get_liquidaciones_imprimir_usuario(2);

			$data['datosliquidaciones'] = $filtro;

			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registro_Arancel()
	{


		if ($_SESSION['id'] != "") {

			require 'models/aranceljudicialModel.php';

			$modelo = new aranceljudicialModel();

			if ($_POST) {

				$modelo->registrar_arancel();
			}

			$this->view->show("aranceljudicial_registro_arancel.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function AprobarLiquidacion()
	{


		if ($_SESSION['id'] != "") {


			require 'models/aranceljudicialModel.php';

			$modelo = new aranceljudicialModel();

			if ($_GET) {

				$modelo->aprobar_liquidacion();
			}

			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
		} else {
			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function AnularLiquidacion()
	{


		if ($_SESSION['id'] != "") {


			require 'models/aranceljudicialModel.php';

			$modelo = new aranceljudicialModel();

			if ($_GET) {

				$modelo->anular_liquidacion();
			}

			$this->view->show("aranceljudicial_imprimir_arancel.php", $data);
		} else {
			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function GenerarReporteArancel()
	{


		if ($_SESSION['id'] != "") {


			require 'models/aranceljudicialwordModel.php';
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//--------------------------------------------------------------------------------------------------------



}//FIN CLASE
