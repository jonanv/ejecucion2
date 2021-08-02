<?php

class empleadosController extends controllerBase

{



	/*---------- Mensajes -------------*/



	public function mensajes()

	{

		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$ls = new empleadosModel();

			$ls->mensajes();
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Listado Excel -------------------*/

	public function listadoExcel()

	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$ln = new archivoModel();



			$rs1 = $ln->listarJuzgados();
			$rs3 = $ln->listarEstados();


			$data['datos_juzgados'] = $rs1;
			$data['datos_estados'] = $rs3;


			if ($_GET) {

				require 'models/excelModel.php';
			}





			//$this->view->show("correspondencia_generar472.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}



	/*------------- Registrar Ubicaci�n Expediente -------------------*/

	public function regIngresoSalida()

	{

		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$lu = new empleadosModel();
			/*$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs8=$ln->listarJuzgados();
			$rs4=$lf->listarEstados();
			$rs3=$ln->listarJuzgadosDestino();
			$rs5=$ln->listarEstadosDetalles();
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadoss']=$rs8;
			$data['datos_juzgados_destino']=$rs3;
			$data['datos_estados']=$rs4;
			$data['datos_estadosdetalles']=$rs5;*/




			if ($_POST) {
				$lu->registrarIngresoSalida();
			}



			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTabla()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_entrada_salida_usuario(2);

			$data['datosentradasalidausuario'] = $filtro;

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTabla()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_entrada_salida_usuario(1);

			$data['datosentradasalidausuario'] = $filtro;

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	/*---------------------- Listar Ubicaci�n Expedientes -------------------*/

	public function listarIngresoSalida()

	{

		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';



			$ls = new empleadosModel();

			$rs1 = $ls->listarIngresoSalida();
			//$rs3=$ls->listarEstados();
			//$rs7=$ls->listarEstadosDetalles();
			$rs8 = $ls->listarUsuarios();
			//$rs9=$ls->listarJuzgadosDestino();
			//$rs10=$ls->listarJuzgadosDestino();
			//	$rs8=$ls->listarJuzgadosDestino();

			$data['datos_ingresosalida'] = $rs1;
			//$data['datos_estados']=$rs3;	
			//$data['datos_estadosdetalles']=$rs7;	
			$data['datos_usuarios'] = $rs8;
			//$data['datos_juzgadodestino']=$rs9;
			//$data['datos_juzgadodestinos']=$rs10;




			//$data['datos_juzgados_destino']=$rs8;

			$this->view->show("empleados_filtrar_ingreso.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function listarIngresoSalida1()

	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$lu = new empleadosModel();

			$rs1 = $lu->FiltroIngresoSalida();
			//$rs3=$lu->listarEstados();
			//$rs7=$lu->listarEstadosDetalles();
			$rs8 = $lu->listarUsuarios();
			//$rs9=$lu->listarJuzgadosDestino();
			//$rs10=$lu->listarJuzgadosDestino();
			//$rs3=$lu->listarUsuarios();
			//$rs4=$lu->listarUsuarios();

			$data['datos_ingresosalida'] = $rs1;
			//$data['datos_estados']=$rs3;	
			//$data['datos_estadosdetalles']=$rs7;
			$data['datos_usuarios'] = $rs8;
			//	$data['datos_juzgadodestino']=$rs9;
			//$data['datos_juzgadodestinos']=$rs10;	
			//	$data['datos_usuarios']=$rs4;
			//		$data['datos_usuariosr']=$rs3;





			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("empleados_filtrar_ingreso.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//---------------------------------------------------------------------------------------------------------------------
	//NUEVAS FUNCIONES SOLICITAR PERMISOS Y APROBAR PERMISOS 8 DE JULIO DEL 2015 POR JORGE ANDRES VALENCIA OROZCO

	public function regPermiso()
	{


		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$lu = new empleadosModel();

			if ($_POST) {

				$lu->registrarPermiso();
			}

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function repsListaPermisos()
	{

		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$lu = new empleadosModel();

			if ($_POST) {

				//$lu->registrarIngresoSalida();

			}

			$this->view->show("reps_listar_permisos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTablaPermisosAprobar()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_lista_permisos(1);

			$data['datospermisosausuario'] = $filtro;

			$this->view->show("reps_listar_permisos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTablaPermisosAprobar()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_lista_permisos(2);

			$data['datospermisosausuario'] = $filtro;

			$this->view->show("reps_listar_permisos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}



	public function ReporteExcel()
	{

		if ($_SESSION['id'] != "") {


			if ($_GET) {

				require 'models/excelempleadosModel.php';
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function ActualizarRegistroPermiso()
	{


		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$modelo = new empleadosModel();

			if ($_GET) {

				$modelo->Actualizar_RegistroPermiso();
			}

			$this->view->show("reps_listar_permisos.php", $data);
		} else {

			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function ActualizarRegistroPermisoMasivos()
	{


		if ($_SESSION['id'] != "") {



			require 'models/empleadosModel.php';

			$modelo = new empleadosModel();

			if ($_GET) {

				$modelo->Actualizar_RegistroPermisoMasivos();
			}

			$this->view->show("reps_listar_permisos.php", $data);
		} else {

			header("refresh: 0; URL=/centro_servicios/");
		}
	}

	public function FiltroTablaPermisos()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_permisos_usuario(2);

			$data['datospermisosausuario'] = $filtro;

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTablaPermisos()
	{

		if ($_SESSION['id'] != "") {

			require 'models/empleadosModel.php';

			$model  = new empleadosModel();

			$filtro = $model->get_permisos_usuario(1);

			$data['datospermisosausuario'] = $filtro;

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarDocumentoSaliente()
	{


		if ($_SESSION['id'] != "") {


			require 'models/empleadoswordModel.php';
		} else {

			header("refresh: 0; URL=/desaj/");
		}
	}
}
