<?php

class archivoController extends controllerBase
{
	/*---------- Mensajes -------------*/
	public function mensajes()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
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

	/*------------- Registrar Seguimiento -------------------*/
	public function regseguimiento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$ls = new archivoModel();

			$rs1 = $ld->listarEmpleados();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $ls->listardias_nohabiles();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_dias'] = $rs3;

			if ($_POST) {
				$lu->registrarSeguimiento();
			}
			$this->view->show("archivo_registrar_seguimiento.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*---------------------- Listar todos los seguimientos -------------------*/
	public function listarSeguimientos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();

			// $rs1 = $ls->listarSeguimientos();
			//$data['datos_seguimientos'] = $rs1;

			$this->view->show("index_listaSeguimiento.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Consultar Seguimiento -----------------------------*/
	public function show_seguimiento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();

			$rs1 = $ls->listarSeguimiento();

			$data['datos_seguimientos'] = $rs1;

			$this->view->show("archivo_consultar.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Modificar Archivo Otro SIN JUSTICIA XXI-------------------*/
	public function edit_archivoOtro_SIN_JXXI()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ls = new archivoModel();
			$lt = new archivoModel();
			$lc = new archivoModel();
			$le = new archivoModel();
			$lp = new archivoModel();
			$ln = new archivoModel();

			//$rs3=$lu->listarDepartamentos();
			$rs2 = $ln->listarJuzgados();
			$rs9 = $ln->listarJuzgadoss();
			$rs6 = $ln->listarJuzgadosDestino();
			$rs1 = $ls->listarDatosRadicadoModificar();
			$rs5 = $lc->listarArchivoModificar();
			$rs3 = $ln->listarEstados();
			$rs7 = $ln->listarEstadosDetalles();
			$rs8 = $ln->listarClaseProceso();

			//TOCA SIGLO XXI
			//$rs10=$ln->listarUltimaActuacion();//ULTIMA ACTUACION SECRETARIA

			$rs11 = $lu->listarObservaciones();

			//TOCA SIGLO XXI
			//$rs12=$lu->listarDespachosJusticiaXXI();

			//TOCA SIGLO XXI
			//POR JORGE ANDRES VALENCIA
			//$rs10b = $lu->listarDespachosSecretaria();//ULTIMA ACTUACION DESPACHO

			$rs13  = $lu->listarAtuaciones();
			$rs14  = $lu->listarAsignadoa();

			//SE ENVIA EL ID DEL RADICADO DE LA TABLA ubicacion_expediente
			$rs15  = $lu->listarAtuacionesExpedientes(trim($_GET['nombre']));

			//TOCA SIGLO XXI
			//CLASE PROCESO SIGLO XXI
			//$rs16  = $ln->ClaseProcesoSigloXXI();

			//$rs6=$lp->listarCiudadOtro();

			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadoss'] = $rs9;
			$data['datos_juzgados_destino'] = $rs6;
			$data['datos_estados'] = $rs3;
			$data['datos_radicado'] = $rs1;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_claseproceso'] = $rs8;
			$data['detalles'] = $rs11;
			$data['datos_despachos'] = $rs12;

			//$data['datos_medio']=$rs1;
			//$data['datos_departamentos']=$rs3;
			$data['datos_archivo'] = $rs5;
			$data['datos_siglo'] = $rs10;
			//$data['datos_ciudad']=$rs6;

			//POR JORGE ANDRES VALENCIA
			$data['datos_siglob']    = $rs10b;
			$data['datos_actuacion'] = $rs13;
			$data['datos_asignadoa'] = $rs14;
			$data['datos_actuacionexpediente'] = $rs15;
			$data['dato_claseproceso'] = $rs16;

			if ($_POST) {

				$lu->modificarArchivo_Otro_SIN_JXXI();
			}
			$this->view->show("archivo_modificarOtro_SIN_JXXI.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Modificar Archivo Otro -------------------*/
	public function edit_archivoOtro()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ls = new archivoModel();
			$lt = new archivoModel();
			$lc = new archivoModel();
			$le = new archivoModel();
			$lp = new archivoModel();
			$ln = new archivoModel();

			//$rs3=$lu->listarDepartamentos();
			$rs2 = $ln->listarJuzgados();
			$rs9 = $ln->listarJuzgadoss();
			$rs6 = $ln->listarJuzgadosDestino();
			$rs1 = $ls->listarDatosRadicadoModificar();
			$rs5 = $lc->listarArchivoModificar();
			$rs3 = $ln->listarEstados();
			$rs7 = $ln->listarEstadosDetalles();
			$rs8 = $ln->listarClaseProceso();

			//TOCA SIGLO XXI
			$rs10 = $ln->listarUltimaActuacion(); //ULTIMA ACTUACION SECRETARIA

			$rs11 = $lu->listarObservaciones();

			//TOCA SIGLO XXI
			$rs12 = $lu->listarDespachosJusticiaXXI();

			//TOCA SIGLO XXI
			//POR JORGE ANDRES VALENCIA
			$rs10b = $lu->listarDespachosSecretaria(); //ULTIMA ACTUACION DESPACHO

			$rs13  = $lu->listarAtuaciones();
			$rs14  = $lu->listarAsignadoa();

			//SE ENVIA EL ID DEL RADICADO DE LA TABLA ubicacion_expediente
			$rs15  = $lu->listarAtuacionesExpedientes(trim($_GET['nombre']));

			//TOCA SIGLO XXI
			//CLASE PROCESO SIGLO XXI
			$rs16  = $ln->ClaseProcesoSigloXXI();

			//$rs6=$lp->listarCiudadOtro();

			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadoss'] = $rs9;
			$data['datos_juzgados_destino'] = $rs6;
			$data['datos_estados'] = $rs3;
			$data['datos_radicado'] = $rs1;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_claseproceso'] = $rs8;
			$data['detalles'] = $rs11;
			$data['datos_despachos'] = $rs12;

			//$data['datos_medio']=$rs1;
			//$data['datos_departamentos']=$rs3;
			$data['datos_archivo'] = $rs5;
			$data['datos_siglo'] = $rs10;
			//$data['datos_ciudad']=$rs6;

			//POR JORGE ANDRES VALENCIA
			$data['datos_siglob']    = $rs10b;
			$data['datos_actuacion'] = $rs13;
			$data['datos_asignadoa'] = $rs14;
			$data['datos_actuacionexpediente'] = $rs15;
			$data['dato_claseproceso'] = $rs16;

			if ($_POST) {
				$lu->modificarArchivo_Otro();
			}
			$this->view->show("archivo_modificarOtro.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Asignar_Tramite_Interno_2()
	{
		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();



			if ($_GET) {

				$modelo->asignar_tramite_interno_2();
			}

			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	/*------------- Modificar Archivo Otro -------------------*/
	public function Reparto_archivomodificarOtro()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ls = new archivoModel();
			$lt = new archivoModel();
			$lc = new archivoModel();
			$le = new archivoModel();
			$lp = new archivoModel();
			$ln = new archivoModel();

			//$rs3=$lu->listarDepartamentos();
			$rs2 = $ln->listarJuzgados();
			$rs9 = $ln->listarJuzgadoss();
			$rs6 = $ln->listarJuzgadosDestino();
			$rs1 = $ls->listarDatosRadicadoModificar();
			$rs5 = $lc->listarArchivoModificar();
			$rs3 = $ln->listarEstados();
			$rs7 = $ln->listarEstadosDetalles();
			$rs8 = $ln->listarClaseProceso();
			$rs10 = $ln->listarUltimaActuacion();
			$rs11 = $lu->listarObservaciones();
			$rs12 = $lu->listarDespachosJusticiaXXI();

			//POR JORGE ANDRES VALENCIA
			$rs10b = $lu->listarDespachosSecretaria();
			$rs13  = $lu->listarAtuaciones();
			$rs14  = $lu->listarAsignadoa();
			//SE ENVIA EL ID DEL RADICADO DE LA TABLA ubicacion_expediente
			$rs15  = $lu->listarAtuacionesExpedientes(trim($_GET['nombre']));

			//$rs6=$lp->listarCiudadOtro();

			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadoss'] = $rs9;
			$data['datos_juzgados_destino'] = $rs6;
			$data['datos_estados'] = $rs3;
			$data['datos_radicado'] = $rs1;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_claseproceso'] = $rs8;
			$data['detalles'] = $rs11;
			$data['datos_despachos'] = $rs12;

			//$data['datos_medio']=$rs1;
			//$data['datos_departamentos']=$rs3;
			$data['datos_archivo'] = $rs5;
			$data['datos_siglo'] = $rs10;
			//$data['datos_ciudad']=$rs6;

			//POR JORGE ANDRES VALENCIA
			$data['datos_siglob']    = $rs10b;
			$data['datos_actuacion'] = $rs13;
			$data['datos_asignadoa'] = $rs14;
			$data['datos_actuacionexpediente'] = $rs15;

			$this->view->show("archivo_modificarOtro.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Editar Seguimiento -------------------------*/
	public function edit_seguimiento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ls = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();

			$rs1 = $ls->listarSeguimiento();
			$rs = $ld->listarEmpleados();
			$rs2 = $ln->listarJuzgados();

			$data['datos_empleados'] = $rs;
			$data['datos_juzgados'] = $rs2;
			$data['datos_seguimientos'] = $rs1;

			if ($_POST) {
				$ls->updateSeguimiento();
			}

			$this->view->show("archivo_modificar.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	/*------------- Editar Inventario Entrante -------------------------*/
	public function edit_acta_entrante()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();

			$rs1 = $ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $lf->listarJuzgados();
			$rs4 = $lu->listarInventarioEspecifico();
			$rs5 = $lg->listardias_nohabiles();
			$rs6 = $lc->listarConsecutivo();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadosdestino'] = $rs3;
			$data['datos_inventario'] = $rs4;
			$data['datos_dias'] = $rs5;
			$data['datos_consecutivo'] = $rs6;

			if ($_POST) {
				$ls->updateInventarioEntrante();
			}

			$this->view->show("archivo_modificar_inventario_entrante.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Editar Inventario Saliente -------------------------*/

	public function edit_acta_saliente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lc = new archivoModel();
			$lg = new archivoModel();

			$rs1 = $ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $lf->listarJuzgados();
			$rs4 = $lu->listarInventarioEspecifico();
			$rs5 = $lg->listardias_nohabiles();
			$rs6 = $lc->listarConsecutivo_entrega();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadosdestino'] = $rs3;
			$data['datos_inventario'] = $rs4;
			$data['datos_dias'] = $rs5;
			$data['datos_consecutivo'] = $rs6;

			if ($_POST) {
				$ls->updateInventarioSaliente();
			}

			$this->view->show("archivo_modificar_inventario_saliente.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	/*------------- Eliminar Seguimiento -------------------------*/
	public function elim_seguimiento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$ls->eliminarSeguimiento();
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Eliminar Inventario Entrante -------------------------*/
	public function elim_inventarioEntrante()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$ls->eliminarInventarioEntrante();
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Eliminar Inventario Saliente -------------------------*/

	public function elim_inventarioSaliente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$ls->eliminarInventarioSaliente();
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Entregar Documento -------------------------*/
	public function entrega_documento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$ls->entregaDocumento();
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	/*---------------------- Subir Documento -------------------*/
	public function subir_documento()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();

			if ($_POST) {
				$ls->subirDocumento();
			}
			$this->view->show("archivo_subirInforme.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	/*---------------------- Listar Documentos -------------------*/
	public function listar_documentos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$rs1 = $ls->listarDocumentosInformes();
			$data['datos_documentos'] = $rs1;
			$this->view->show("archivo_listarInformes.php", $data);
		}
	}

	/*------------- Registrar Recibido Inventario -------------------*/

	public function regRecibidoInventario()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();

			$rs1 = $ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $lf->listarJuzgados();
			$rs4 = $lg->listardias_nohabiles();
			$rs5 = $lc->listarConsecutivo();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadosdestino'] = $rs3;
			$data['datos_dias'] = $rs4;
			$data['datos_consecutivo'] = $rs5;

			if ($_POST) {
				$lu->registrarInventarioEntrante();
			}

			$this->view->show("archivo_registrar_inventario_entrante.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	/*------------- Registrar Salida Inventario -------------------*/
	public function regSalidaInventario()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();

			$rs1 = $ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $lf->listarJuzgados();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadosdestino'] = $rs3;

			if ($_POST) {
				$lu->registrarInventarioSaliente();
			}

			$this->view->show("archivo_registrar_inventario_saliente.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Registrar Ubicaci�n Expediente -------------------*/

	public function regUbicacionExpediente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();

			//	$rs1=$ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs8 = $ln->listarJuzgados();
			$rs4 = $lf->listarEstados();
			$rs3 = $ln->listarJuzgadosDestino();
			$rs5 = $ln->listarEstadosDetalles();
			$rs8 = $ln->listarClaseProceso();

			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadoss'] = $rs8;
			$data['datos_juzgados_destino'] = $rs3;
			$data['datos_estados'] = $rs4;
			$data['datos_estadosdetalles'] = $rs5;
			$data['datos_claseproceso'] = $rs8;

			if ($_POST) {
				$lu->registrarPosicionExpediente();
			}

			$this->view->show("archivo_registrar_posicion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- Registrar Salida Expediente -------------------*/

	public function regSalidaExpediente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();

			//	$rs1=$ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs4 = $lf->listarEstadosDetalles();
			$rs5 = $ld->listarArchivoOtro();
			$rs3 = $ln->listarJuzgadosDestino();

			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgados_destino'] = $rs3;
			$data['datos_estados'] = $rs4;
			$data['datos_archivo'] = $rs5;

			if ($_POST) {

				$lu->registrarSalidaExpediente();
			}

			$this->view->show("archivo_registrar_salida.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Registrar Devoluci�n Expediente -------------------*/

	public function regDevolucionExpediente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();

			//	$rs1=$ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs4 = $lf->listarEstados();
			$rs5 = $ld->listarArchivoDevolucion();
			$rs3 = $ln->listarJuzgadosDestino();

			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgados_destino'] = $rs3;
			$data['datos_estados'] = $rs4;
			$data['datos_archivo'] = $rs5;

			if ($_POST) {
				$lu->registrarDevolucionExpediente();
			}

			$this->view->show("archivo_registrar_devolucion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- Registrar T�tulos -------------------*/

	public function regTitulos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();

			//	$rs1=$ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs4 = $lf->listarEstados();
			$rs5 = $ld->listarArchivoDevolucion();
			$rs3 = $ln->listarJuzgadosDestino();
			$rs6 = $ln->listarTitulosMod();

			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgados_destino'] = $rs3;
			$data['datos_estados'] = $rs4;
			$data['datos_archivo'] = $rs5;
			$data['datos_TitulosMod'] = $rs6;

			if ($_POST) {

				$lu->registrarTitulos();
			}

			$this->view->show("archivo_registrar_titulos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}
	/*---------------------- Listar actas de recibidos -------------------*/

	public function listRecibidoInventario()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$rs1 = $ls->listarRecibidos();
			$data['datos_recibidos'] = $rs1;
			$this->view->show("index_listaRecibidoInventario.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*---------------------- Listar actas de entregas -------------------*/
	public function listEntregaInventario()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$rs1 = $ls->listarEntregados();
			$data['datos_entregados'] = $rs1;
			$this->view->show("archivo_listar_entregados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*---------------------- Listar Ubicaci�n Expedientes -------------------*/
	public function listarUbicacionExpediente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();

			//ID USUARIOS PERTENECIENTES AL JUZGADO J1, J2 ESTO CON EL OBJETO QUE UN USUARIO DE UN JUZGADO NO VEA LA INFORMACION DEL OTRO
			$campos               = 'usuario';
			$nombrelista          = 'pa_usuario_acciones';
			$idaccion			  = '9';
			$campoordenar         = 'id';
			$datosusuario_juzgado = $ls->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
			$usuarios_juzgado     = $datosusuario_juzgado->fetch();
			$usuariosa_juzgado	  = explode("////", $usuarios_juzgado['usuario']);

			$usuariosa_juzgado_1  = explode("****", $usuariosa_juzgado[0]);

			$usuariosa_juzgado_2  = explode("****", $usuariosa_juzgado[1]);

			//print_r($usuariosa_juzgado_1[0]);

			$pertenece_juzgado = 0;

			if (in_array($_SESSION['idUsuario'], $usuariosa_juzgado_1, true)) {
				$pertenece_juzgado = 1;
			}

			if (in_array($_SESSION['idUsuario'], $usuariosa_juzgado_2, true)) {
				$pertenece_juzgado = 2;
			}

			$data['pertenece_juzgado'] = $pertenece_juzgado;

			//NO ES NINGUN USUARIO DEL JUZGADO 1 O 2
			if ($pertenece_juzgado == 0) {
				$rs1 = $ls->listarUbicacion();
				$rs9 = $ls->listarJuzgadosDestino();
			} else {
				$rs1 = $ls->listarUbicacion_juzgados($pertenece_juzgado);
				$rs9 = $ls->listarJuzgadosDestino_juzgado($pertenece_juzgado);
			}

			$rs3 = $ls->listarEstados();
			$rs7 = $ls->listarEstadosDetalles();
			$rs8 = $ls->listarUsuarios();

			//$rs9=$ls->listarJuzgadosDestino();

			$rs10 = $ls->listarJuzgadosDestino();
			//	$rs8=$ls->listarJuzgadosDestino();

			//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
			$rs11  = $ls->listarAsignadoa();

			/*NOTA: SE CIERRA ESTA PARTE, PARA QUE AL INGRESAR AL MODULO SIEPRO
			NO DEMORE TANTO EN SU CARGA
			CAMBIO HECHO 29 DE JULIO 2019*/

			//$rs12  = $ls->listarActuaciones_Expedientes();

			$rs13  = $ls->listarAsignadoa();

			$data['datos_ubicacion'] = $rs1;
			$data['datos_estados'] = $rs3;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_usuarios'] = $rs8;
			$data['datos_juzgadodestino'] = $rs9;
			$data['datos_juzgadodestinos'] = $rs10;

			//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
			$data['datos_asignadoa']   = $rs11;

			/*NOTA: SE CIERRA ESTA PARTE, PARA QUE AL INGRESAR AL MODULO SIEPRO
			NO DEMORE TANTO EN SU CARGA
			CAMBIO HECHO 29 DE JULIO 2019*/
			$data['datos_actuaciones'] = $rs12;

			$data['datos_userventanilla']   = $rs13;

			//$data['datos_juzgados_destino']=$rs8;

			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*----------------------Ver T�tulos------------------*/

	public function verTitulos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$rs1 = $ls->listarTitulos();
			$data['datos_titulos'] = $rs1;
			$this->view->show("archivo_ver_titulos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function listarUbicacionExpediente1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$lu = new archivoModel();

			$rs1 = $lu->FiltroUbicacionExpedientes();
			$rs3 = $lu->listarEstados();
			$rs7 = $lu->listarEstadosDetalles();
			$rs8 = $lu->listarUsuarios();
			$rs9 = $lu->listarJuzgadosDestino();
			$rs10 = $lu->listarJuzgadosDestino();
			//$rs3=$lu->listarUsuarios();
			//$rs4=$lu->listarUsuarios();

			//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
			$rs11  = $lu->listarAsignadoa();

			/*NOTA: SE CIERRA ESTA PARTE, PARA QUE AL INGRESAR AL MODULO SIEPRO
			NO DEMORE TANTO EN SU CARGA
			CAMBIO HECHO 29 DE JULIO 2019*/
			$rs12  = $lu->listarActuaciones_Expedientes();

			$rs13  = $lu->listarAsignadoa();

			$data['datos_ubicacion'] = $rs1;
			$data['datos_estados'] = $rs3;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_usuarios'] = $rs8;
			$data['datos_juzgadodestino'] = $rs9;
			$data['datos_juzgadodestinos'] = $rs10;
			// $data['datos_usuarios']=$rs4;
			// $data['datos_usuariosr']=$rs3;

			// ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
			$data['datos_asignadoa'] = $rs11;

			/*NOTA: SE CIERRA ESTA PARTE, PARA QUE AL INGRESAR AL MODULO SIEPRO
			NO DEMORE TANTO EN SU CARGA
			CAMBIO HECHO 29 DE JULIO 2019*/
			$data['datos_actuaciones'] = $rs12;

			$data['datos_userventanilla'] = $rs13;

			if ($_POST) {
				//$lu->registrarDocumento();
			}
			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Consultar Inventario -----------------------------*/

	public function show_inventario()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();

			$rs1 = $ls->listarInventarioEspecifico();

			$data['datos_inventario'] = $rs1;

			$this->view->show("archivo_consultar_acta_recibido.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Consultar Inventario Saliente -----------------------------*/

	public function show_inventariosaliente()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$rs1 = $ls->listarInventarioEspecificoSaliente();
			$data['datos_inventario'] = $rs1;
			$this->view->show("archivo_consultar_acta_saliente.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Registrar Informe Gesti�n -----------------------------*/

	public function regGestion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ls = new archivoModel();
			$lu = new archivoModel();
			$ld = new archivoModel();

			$rs1 = $ls->listarAno();
			$rs2 = $ld->listardias_nohabiles();
			$data['datos_anos'] = $rs1;

			if ($_POST) {
				$lu->registrarInformeGestion();
			}
			$this->view->show("archivo_registrar_gestion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Consultar Informe Gesti�n -----------------------------*/

	public function consultarGestion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ls = new archivoModel();
			$lu = new archivoModel();

			$rs1 = $ls->listarAno();
			$data['datos_anos'] = $rs1;

			$this->view->show("archivo_consultar_gestion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	/*------------- Consultar Informe Gesti�n -----------------------------*/

	public function consultarGestion1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ls = new archivoModel();
			$lu = new archivoModel();

			$rs1 = $ls->consultarInformeGestion();
			$data['datos_gestion'] = $rs1;

			$this->view->show("archivo_consultar_gestion1.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Modificar Informe Gesti�n -----------------------------*/

	public function modificarGestion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ls = new archivoModel();
			$lu = new archivoModel();

			$rs1 = $ls->listarAno();
			$data['datos_anos'] = $rs1;

			$this->view->show("archivo_modificar_gestion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Modificar Informe Gesti�n -----------------------------*/

	public function modificarGestion1()
	{
		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$ls = new archivoModel();
			$lu = new archivoModel();

			$rs1 = $ls->consultarInformeGestion();
			$data['datos_gestion'] = $rs1;

			if ($_POST) {
				$lu->modificarInformeGestion();
			}

			$this->view->show("archivo_modificar_gestion1.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Modificar Informe Gesti�n -----------------------------*/

	/*public function editGestion()
	{
	  if($_SESSION['id']!=""){
		require 'models/archivoModel.php';
		
		$ls = new archivoModel();
		$lu = new archivoModel();

		$rs1=$ls->listarAno();
		$data['datos_anos'] = $rs1;
				
		if($_POST) {
			$lu->modificarInformeGestion();
		}
		$this->view->show("archivo_modificar_gestion1.php", $data);

		}
		else {
			header("refresh: 0; URL=/laborales/");
		}
	}
	
	*/


	/*******************************************************************************************************************/
	/************************************************ REPORTES POR M�DULO **********************************************/
	/*******************************************************************************************************************/

	/******************************************* Reporte Producci�n Diaria *********************************************/

	public function ReporteProduccionDiaria()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$this->view->show("reporte_produccion_diaria.php");
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/****************** Redirecciona a la generaci�n del gr�fico del reporte Producci�n Diaria *************************/
	public function  ReporteProduccionDiaria1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			require 'models/barrasModel.php';

			$this->view->show("reporte_produccion_diaria1.php");
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/**************************************** Reporte Producci�n Rango de Fechas ********************************************/

	public function ReporteProduccionRango()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$this->view->show("reporte_produccion_rango.php");
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/************** Redirecciona a la generaci�n del gr�fico del reporte Producci�n Rango de Fechas ***********************/
	public function  ReporteProduccionRango1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			require 'models/barrasModel.php';

			$this->view->show("reporte_produccion_rango1.php");
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/**************************************** Reporte Producci�n Juzgado ********************************************/

	public function ReporteProduccionJuzgado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/pieModel.php';
			$lu = new pieModel();
			$rs1 = $lu->obtenerJuzgadosProcesosCajas();

			$cantidad = count($rs1);
			$i = 0;
			while ($i < $cantidad) {
				$vector_juz[$i] = $rs1[$i]['nombre_juz'];
				$vector_caj[$i] = $rs1[$i]['caja'];
				$vector_pros[$i] = $rs1[$i]['proces'];

				$i = $i + 1;
			}

			//print_r($vector_juz);
			$data['datos_despachos'] = $vector_juz;
			$data['datos_cajas'] = $vector_caj;
			$data['datos_procesos'] = $vector_pros;

			$this->view->show("reporte_produccion_juzgado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/**************************************** Reporte Entrantes vs Salientes ********************************************/

	public function ReporteEntrantesSalientes()
	{
		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$ln = new archivoModel();

			$rs2 = $ln->listarJuzgados();

			$data['datos_juzgados'] = $rs2;

			$this->view->show("reporte_entrante_saliente.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/**************************************** Reporte Entrantes vs Salientes ********************************************/

	public function ReporteEntrantesSalientes1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();

			$rs1 = $ln->listarEntrantesReporte1();
			$rs2 = $lr->listarSalientesReporte1();
			$rs3 = $ls->nombreJuzgado();

			$data['datos_entrantes'] = $rs1;
			$data['datos_salientes'] = $rs2;
			$data['nombre_juzgado'] = $rs3;

			$this->view->show("reporte_entrante_saliente2.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*{
	   if($_SESSION['id']!=""){
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporte();
			$rs2=$lr->listarSalientesReporte();
			$rs3=$ls->nombreJuzgado();
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			$data['nombre_juzgado']=$rs3;
			
		  $this->view->show("reporte_entrante_saliente1.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/laborales/");
	  }	
	}*/

	/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/

	public function ReporteEntrantesSalientesTodos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ln = new archivoModel();
			$this->view->show("reporte_entrante_saliente_todos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/

	public function ReporteEntrantesSalientes_todos1()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();

			$rs1 = $ln->listarEntrantesReporteTODOS1();
			$rs2 = $lr->listarSalientesReporteTODOS1();

			$data['datos_entrantes'] = $rs1;
			$data['datos_salientes'] = $rs2;

			$this->view->show("reporte_entrante_saliente_Todos1.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Entregar Inventario Entrante -------------------------*/
	public function entregar_acta_entrante()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();

			$rs1 = $ld->listarEmpleadosJefe();
			$rs2 = $ln->listarJuzgados();
			$rs3 = $lf->listarJuzgados();
			$rs4 = $lu->listarInventarioEspecifico();
			$rs5 = $lg->listardias_nohabiles();
			$rs6 = $lc->listarConsecutivo_entrega();

			$data['datos_empleados'] = $rs1;
			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadosdestino'] = $rs3;
			$data['datos_inventario'] = $rs4;
			$data['datos_dias'] = $rs5;
			$data['datos_consecutivo'] = $rs6;

			if ($_POST) {

				$ls->entregarInventarioEntrante();
			}

			$this->view->show("archivo_entregar_inventario_entrante.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	/*------------- Generar Acta Word -------------------*/

	public function generarActa()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ld = new archivoModel();
			//$rs1 = $ld->generarActa();
			require 'models/wordModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}
	/*------------- Adicionar Memorial -------------------*/

	public function adicionar_memorial()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			require 'models/correspondenciaModel.php';

			$lu = new archivoModel();
			$lc = new correspondenciaModel();

			$rs2 = $lu->listarJuzgados();
			$rs9 = $lu->listarJuzgadoss();
			$rs6 = $lu->listarJuzgadosDestino();
			$rs1 = $lu->listarDatosRadicadoModificar();
			$rs5 = $lu->listarArchivoModificar();
			$rs3 = $lu->listarEstados();
			$rs7 = $lu->listarEstadosDetalles();
			$rs8 = $lu->listarClaseProceso();
			$rs10 = $lu->listarUltimaActuacion();
			$rs11 = $lu->listarObservaciones();
			$rs12 = $lu->listarDespachosJusticiaXXI();
			$rs13 = $lc->listarSolicitudes();

			$data['datos_juzgados'] = $rs2;
			$data['datos_juzgadoss'] = $rs9;
			$data['datos_juzgados_destino'] = $rs6;
			$data['datos_estados'] = $rs3;
			$data['datos_radicado'] = $rs1;
			$data['datos_estadosdetalles'] = $rs7;
			$data['datos_claseproceso'] = $rs8;
			$data['detalles'] = $rs11;
			$data['datos_despachos'] = $rs12;
			$data['datos_solicitud'] = $rs13;

			$data['datos_archivo'] = $rs5;
			$data['datos_siglo'] = $rs10;

			if ($_POST) {
				$lc->registrarMemorial();
			}

			$this->view->show("archivo_registrar_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//**********************************************************************************************************************************************
	//PROYECTO PASAR LIQUIDAR COSTAS A AMBIENTE WEB 09 DE ABRIL 2015

	public function registrarliquidacioncostas()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$rs1 = $ld->listarAreaEmpleados();
			$data['datos_areas'] = $rs1;

			if ($_POST) {
				$lu->registrarprueba();
			}

			$this->view->show("archivo_liquidar.php", $data);
		} else {
			header("refresh: 0; URL=/laboralesprueba/");
		}
	}

	//PARTE AGREGADA EL 07 DE MAYO DEL 2015 PARA EL MANEJO DEL TRASLADO ART. 108
	public function Registrar_Traslado_Reposicion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->registrar_traslado_reposicion();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//PARTE AGREGADA EL 07 DE MAYO DEL 2015 PARA EL MANEJO DEL TRASLADO ART. 108
	public function Registrar_Traslado108()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarTraslado108();
			}
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Generar_Documento_Traslado108()
	{
		if ($_SESSION['id'] != "") {
			require 'models/wordModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_A_Despacho()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarADespacho();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Actualizar_Procesos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$modelo->ActualizarClaseProceso();
			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Titulos_Encustodia()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->registrar_titulos_encustodia();
			}

			$this->view->show("siepro_titulos_materializados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Titulos_Materializados()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$this->view->show("siepro_listar_titulos_materializados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Titulos_OtrosJuzgados()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->registrar_titulos_otrosJuzgados();
			}

			$this->view->show("siepro_titulos_otrosjuzgados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Titulos_OtrosJuzgados_2()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function AsignarFechaPago()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$lu = new archivoModel();

			if ($_POST) {
				$lu->asignarfechapago();
			}

			$this->view->show("empleados_registrar_ingsal.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTabla()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$model  = new archivoModel();
			$filtro = $model->get_titulos_materializados(1);
			$data['datossalientes'] = $filtro;

			//$this->view->show("sigdoc_documentos_salientes.php", $data);

			$this->view->show("siepro_listar_titulos_materializados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTabla()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$model  = new archivoModel();
			$filtro = $model->get_titulos_materializados(2);
			$data['datossalientes'] = $filtro;
			$this->view->show("siepro_listar_titulos_materializados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RecargarTablaOtrosJuzgados()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$model  = new archivoModel();
			$filtro = $model->get_titulos_materializados(1);
			$data['datossalientes'] = $filtro;
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTablaOtrosJuzgados()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$model  = new archivoModel();
			$filtro = $model->get_titulos_materializados(2);
			$data['datossalientes'] = $filtro;
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Poner_En_Custodia()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			if ($_GET) {
				$modelo->poner_en_custodia();
			}

			$this->view->show("siepro_listar_titulos_materializados.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarTituloExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarTituloOtroJuzgadoExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarTerminosExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarLiquidacionExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function GenerarProcesosVentanillaExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Solo_A_Despacho()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->SoloADespacho();
			}
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Reparto_Masivo_NV()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->Registrar_Reparto_Masivo_NV();
			}

			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_A_Despacho_Masivo()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			//$modelo->RegistrarADespacho_Masivo();
			if ($_POST) {
				$modelo->RegistrarADespacho_Masivo_NUEVA_VERSION();
			}

			$this->view->show("siepro_despacho_masivo.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Estado_Masivo()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				//$modelo->Registrar_Estado_Masivo();
				$modelo->Registrar_Estado_Masivo_NUEVA_VERSION();
			}
			$this->view->show("siepro_estado_masivo.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_ParaArchivo_Masivo()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				//$modelo->registrar_paraarchivo_masivo();
				$modelo->registrar_paraarchivo_masivo_NUEVA_VERSION();
			}

			$this->view->show("siepro_archivo_masivo.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_A_Despacho_Masivo_Tacito()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarADespacho_Masivo_Tacito();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function RegistrarADespacho_Masivo_Tacito_Despacho()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarADespacho_Masivo_Tacito_Despacho();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	public function Registrar_Sustitucion_Poder_Despacho()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->Registrar_Sustitucion_Poder_Despacho();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Sustitucion_Poder_Secretaria()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->Registrar_Sustitucion_Poder_Secretaria();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	public function Actualizar_ClaseProceso_SigloXXI()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->Actualizar_ClaseProceso_SigloXXI();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//PARTE AGREGADA EL 25 DE ENERO DEL 2016 PARA EL MANEJO DE ASIGNAR FECHA TERMINO
	public function Registrar_Termino()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarTermino();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Termino_Revisado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->termino_revisado();
			}
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Termino_Revisado_Todos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->termino_revisado_todos();
			}
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Incorporar_Memorial()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			/*if($_POST){
				$modelo->registrar_titulos_otrosJuzgados();
			}*/

			$this->view->show("siepro_incorpora_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function FiltroTablaIncorporar_Memorial()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$model  = new archivoModel();
			$filtro = $model->get_incorporar_memorial();
			$data['datosincorpora'] = $filtro;
			$this->view->show("siepro_incorpora_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Incorpora_Memorial()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->registrar_incorpora_memorial();
			}

			$this->view->show("siepro_incorpora_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Expediente_Memorial_Incorporado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			/*if($_POST){
				$modelo->registrar_titulos_otrosJuzgados();
			}*/

			$this->view->show("siepro_expediente_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Ejecutoria()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			/*if($_POST){
				$modelo->registrar_titulos_otrosJuzgados();
			}*/

			$this->view->show("siepro_ejecutoria.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Expediente_Memorial_Incorporado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->registrar_expediente_memorial_incorporado();
			}

			$this->view->show("siepro_expediente_memorial.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Ejecutoria()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->registrar_ejecutoria();
			}

			$this->view->show("siepro_ejecutoria.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Consulta_Proceso_Ventanilla()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			if ($_GET) {
				$modelo->RegistrarConsultaProcesoVentanilla();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Retorno_Proceso_Ventanilla()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->RegistrarRetornoProcesoVentanilla();
			}
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Generar_Auto_Aprueba_Liquidacion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$ld = new archivoModel();

			require 'models/documentoswordModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Archivos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			/*$model  = new sigdocModel();
			$filtro = $model->get_documentos_salientes_usuario(2);
			$data['datosdocumentossalientes'] = $filtro;*/
			$this->view->show("archivo_listar_archivos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//**************PARA CORRESPONDENCIA SIN RADICADO ASOCIADO*********************************
	public function Correspondencia_Sin_Radicado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->correspondencia_sin_radicado();
			}

			$this->view->show("siepro_correspondencia_sinradicado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Correspondencia_Editar_Radicado()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->correspondencia_editar_radicado();
			}
			//$this->view->show("siepro_correspondencia_sinradicado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Busquedad_Filtro_Correspondencia()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$this->view->show("siepro_correspondencia_sinradicado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function ReporteExcel()
	{
		if ($_SESSION['id'] != "") {
			require 'models/sieproexcelModel.php';
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Radicador_Descatar_Lista()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->radicador_descatar_lista();
			}
			//$this->view->show("siepro_despacho_masivo.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Registrar_Estado_Masivo_Autos()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->Registrar_Estado_Masivo_autos_NUEVA_VERSION_TCPDF();
			}

			$this->view->show("siepro_estado_masivo_autos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Incorporar_Memorial_Masivo_NV()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_GET) {
				$modelo->Incorporar_Memorial_Masivo_NV();
			}

			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	//**********************************************************************************************



	//**************110 MASIVO*********************************

	public function Ciento_Diez_Masivo()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->Registro_Ciento_Diez_Masivo();
			}

			$this->view->show("siepro_110_masivo.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Busquedad_Filtro_TRAS_110()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$this->view->show("siepro_110_masivo.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Realizar_Aprobar_Remates()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			//if($_POST){

			$modelo->realizar_aprobar_remates();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Realizar_Des_Aprobar_Remates()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			//if($_POST){

			$modelo->realizar_des_aprobar_remates();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Adicionar_Observacion_2()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			$this->view->show("adicionar_observacion_2.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	//CON DATATABLES EN PRUEBA 16 DE JULIO 2018
	public function Adicionar_Accion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$this->view->show("gc_adicionar_accion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//NUEVO MODULO GESTION DE CALIDAD
	public function Adicionar_Accion_2()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->Registro_Accion();
			}

			$this->view->show("gc_adicionar_accion_2.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	//-------CARGAR ARCHIVOS .CSV DE ACCIONES Y ACTIVIDADES------------------------


	public function Cargar_Acciones_CSV()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			//$modelo->RegistrarADespacho_Masivo();

			if ($_POST) {
				$modelo->cargar_acciones_CSV();
			}

			$this->view->show("gc_cargar_acciones.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Cargar_Actividad_CSV()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			//$modelo->RegistrarADespacho_Masivo();

			if ($_POST) {
				$modelo->cargar_actividad_CSV();
			}

			$this->view->show("gc_cargar_actividad.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	//-------FIN CARGAR ARCHIVOS .CSV DE ACCIONES Y ACTIVIDADES---------------------




	public function Registrar_Actividad()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			//if($_POST){

			$modelo->registrar_actividad();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Filtro_ACCION()
	{
		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("gc_adicionar_accion_2.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Gestionar_Actividad()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				//$modelo->Registro_Accion();
			}

			$this->view->show("gc_gestionar_actividad.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Gestion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			//if($_POST){
			$modelo->registrar_gestion();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Filtro_ACTIVIDAD()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$this->view->show("gc_gestionar_actividad.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Finalizar_Accion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			//if($_POST){
			$modelo->finalizar_accion();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_Revision()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			//if($_POST){
			$modelo->registrar_revision();
			//}
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//-------------NUEVO MODULO ADICIONAR OBSERVACIONES SERVIDORES DE JUZGADO POR JUEZ----------------
	public function Adicionar_Obs()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->Registro_Accion();
			}

			$this->view->show("juz_adicionar_obs.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	public function Busquedad_Filtro_EXPEDIENTE()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			$this->view->show("juz_adicionar_obs.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Asignar_Observacion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();

			if ($_POST) {
				$modelo->asignar_observacion();
			}

			$this->view->show("juz_adicionar_obs.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Busquedad_Filtro_OBS()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';
			$modelo = new archivoModel();
			$this->view->show("juz_adicionar_obs.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Finalizar_Observacion()
	{
		if ($_SESSION['id'] != "") {
			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->finalizar_observacion();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}



	public function Realizar_Audiencia()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_audiencia();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Realizar_No_Audiencia()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_no_audiencia();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//-------------FIN NUEVO MODULO ADICIONAR OBSERVACIONES SERVIDORES DE JUZGADO POR JUEZ----------------



	//********************************************************************************************
	//PARA EL MANEJO PROGRAMADOR DE AUDIENCIAS
	//ADICIONADO EL 6 DE AGOSTO 2019
	//********************************************************************************************

	public function Registrar_Audiencia()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->registrar_audiencia();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//********************************************************************************************

	//FIN PARA EL MANEJO PROGRAMADOR DE AUDIENCIAS

	//********************************************************************************************



	//********************************************************************************************
	//PARA EL ARCIVADO DE UN PROCESO
	//ADICIONADO EL 11 DE SEPTIEMBRE 2019
	//********************************************************************************************

	public function Archivar_Proceso()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();



			if ($_GET) {

				$modelo->archivar_proceso();
			}

			$this->view->show("archivo_filtrar_ubicacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************

	//FIN PARA EL ARCIVADO DE UN PROCESO

	//********************************************************************************************


	public function Listar_Archivos_Escaneados()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';


			$this->view->show("archivo_listar_archivos_escaneados.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Archivos_Escaneados_2()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';


			$this->view->show("archivo_listar_archivos_escaneados_2.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//PARTE AGREGADA EL 22 DE ABRIL DEL 2020 PARA EL MANEJO DE USUARIOS 
	//QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS
	public function Registrar_Anaquel_Titulos()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_GET) {

				$modelo->registrar_anaquel_titulos();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//ADICIONADO EL 7 DE MAYO 2020
	public function Correspondencia_Sin_Radicado_FILE()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();

			if ($_POST) {



				$modelo->correspondencia_sin_radicado_file();
			}

			$this->view->show("siepro_correspondencia_sinradicado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}



	//********************************************************************************************
	//HOJA CONTROL DE ENTREGA DE TITULOS
	//ADICIONADO EL 9 DE MAYO 2020
	//********************************************************************************************

	//REGISTRAR ENCABEZADO HOJA CONTROL DE ENTREGA DE TITULOS
	public function Registrar_Hoja_Control_Titulo()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->registrar_hoja_control_titulo();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************
	//PARA EL MANEJO DE DETALLE TABLA ABONOS
	//ADICIONADO EL 9 DE MAYO 2020
	//********************************************************************************************

	public function Registrar_Detalle_Control_Titulo()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->registrar_detalle_control_titulo();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//********************************************************************************************
	//FIN HOJA CONTROL DE ENTREGA DE TITULOS
	//ADICIONADO EL 9 DE MAYO 2020
	//********************************************************************************************


	//********************************************************************************************

	//PROCESOS MASIVOS 

	//Auto aprueba liquidaci�n cr�dito
	//Auto modifica liquidacion presentada 
	//Fijacion estado

	//********************************************************************************************


	/***************Auto aprueba liquidaci�n cr�dito***************/


	//ACTUACION Auto aprueba liquidaci�n cr�dito 
	public function Registrar_AALC_L1()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_GET) {

				$modelo->Registrar_AALC();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//ACTUACION Fijacion estado Auto aprueba liquidaci�n cr�dito 
	public function Registrar_AALC_L2()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_GET) {

				$modelo->Registrar_FE_AALC();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	/***************Auto modifica liquidacion presentada***************/


	//ACTUACION Auto modifica liquidacion presentada
	public function Registrar_AMLC_L1()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_GET) {

				$modelo->Registrar_AMLC();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//ACTUACION Fijacion estado Auto modifica liquidacion presentada
	public function Registrar_AMLC_L2()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_GET) {

				$modelo->Registrar_FE_AMLC();
			}

			//$this->view->show("archivo_filtrar_ubicacion.php", $data);

		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************


	//FIN PROCESOS MASIVOS 
	//Auto aprueba liquidaci�n cr�dito
	//Auto modifica liquidacion presentada 
	//Fijacion estado

	//********************************************************************************************




	//NUEVO ADICIONADO 29 DE MAYO 2020

	//********************************************************************************************


	//PROCESOS MASIVOS DESDE FORMUARIO SIEPRO OPCION ACTUACION JUSTICIA XXI MASIVA 
	//Auto aprueba liquidaci�n cr�dito
	//Auto modifica liquidacion presentada 
	//Fijacion estado

	//********************************************************************************************



	public function Registrar_Actuacion_Masivo()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();

			//$modelo->RegistrarADespacho_Masivo();

			if ($_POST) {


				//$modelo->Registrar_ACTUACION_MASIVO_JXXI();

				$modelo->Registrar_ACTUACION_MASIVO_JXXI_NV();
			}

			$this->view->show("siepro_actuacionjxxi_masivo.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Registrar_ActuacionFE_Masivo()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();

			//$modelo->RegistrarADespacho_Masivo();

			if ($_POST) {


				$modelo->Registrar_ActuacionFEJXXI_MASIVO();
			}

			$this->view->show("siepro_actuacionjxxi_masivo.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************


	//FIN PROCESOS MASIVOS DESDE FORMUARIO SIEPRO OPCION ACTUACION JUSTICIA XXI MASIVA 
	//Auto aprueba liquidaci�n cr�dito
	//Auto modifica liquidacion presentada 
	//Fijacion estado

	//********************************************************************************************


	//-----------------------------------EXPEDIENTE DIGITAL---------------------------------------



	//********************************************************************************************

	//PROCESOS EXPEDIENTE DIGITAL, 13 DE JULIO 2020

	//********************************************************************************************
	public function Expediente_Digital()
	{

		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			/* if($_POST)
			{
				$ls = new indexModel();
				$ls->actulizar_user();
			}*/

			$this->view->show("expediente_digital.php");
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Registrar_Folio()
	{


		if ($_SESSION['id'] != "") {


			require 'models/archivoModel.php';


			$modelo = new archivoModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("expediente_folio_nuevo.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function CrearMultiple()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_POST) {

				$modelo->adicionar_folios_proceso();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Filtro_Expediente_2()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_digital.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Editar_Folio()
	{


		if ($_SESSION['id'] != "") {


			require 'models/archivoModel.php';


			$modelo = new archivoModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("expediente_folio_editar.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Editar_Folio_2()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_POST) {

				$modelo->editar_folio_proceso();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Eliminar_Folio()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){
			if ($_GET) {

				$modelo->eliminar_folio_proceso();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************

	//PROCESOS REPARTO A DESPACHO VIRTUAL, 24 DE JUNIO 2020

	//********************************************************************************************

	public function Adimistrar_Procesos_Despacho()
	{
		require 'models/archivoModel.php';

		/* if($_POST)
		{
			$ls = new indexModel();
			$ls->actulizar_user();
		}*/

		$this->view->show("exp_digital_1.php");
	}

	public function Realizar_Revisar_Procesos()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_revisar_procesos();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Realizar_No_Revisar_Procesos()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_no_revisar_procesos();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Realizar_Revisar_Procesos_2()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_revisar_procesos_2();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Realizar_No_Revisar_Procesos_2()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_no_revisar_procesos_2();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Cerrar_Tarea()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->cerrar_tarea();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Filtro()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("exp_digital_1.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Cargar_Auto()
	{


		if ($_SESSION['id'] != "") {


			require 'models/archivoModel.php';


			$modelo = new archivoModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("exp_digital_cargar_auto.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function CrearMultiple_Despacho()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_POST) {

				$modelo->adicionar_folios_proceso_D();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//********************************************************************************************

	//FIN PROCESOS REPARTO A DESPACHO VIRTUAL, 24 DE JUNIO 2020

	//********************************************************************************************


	public function Estado_Digital_Proceso()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->estado_digital_proceso();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Acumular_Proceso()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->acumular_proceso();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Descargar_Multiples_Archivos()
	{
		require 'models/archivoModel.php';

		$modelo = new archivoModel();

		$modelo->descargar_multiples_archivos();
	}

	public function Realizar_Devolucion()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->realizar_devolucion();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Abrir_Tarea()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->abrir_tarea();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Cerrar_Bloque_Tarea()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->cerrar_bloque_tarea();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}



	public function Revisar_Procesos_Despacho()
	{
		require 'models/archivoModel.php';

		/* if($_POST)
		{
			$ls = new indexModel();
			$ls->actulizar_user();
		}*/

		$this->view->show("exp_digital_revisa_secre.php");
	}


	public function Revisar_Procesos_1()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->revisar_procesos_1();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function No_Revisar_Procesos_1()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->no_revisar_procesos_1();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Devolucion_Bloque()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->devolucion_bloque();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//NUEVO 25 DE NOVIEMBRE 

	public function Memoriales_Externos_Radicados()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_memoriales_externos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Memoriales_Externos_Radicados()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_memoriales_externos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Radicar_Memorial()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->radicar_memorial();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//NUEVO 7 DE DICIEMBRE 

	public function Programacion_Consulta_Titulos()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_titulos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Titulos_Consulta()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_titulos.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Radicar_Respuesta()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->radicar_respuesta();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//NUEVO 10 DE DICIEMBRE 

	public function Consulta_PQR()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_pqr.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_PQR_Consulta()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_pqr.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Radicar_PQR()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->radicar_pqr();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//NUEVO 14 DE DICIEMBRE 2020


	public function Radicar_Devolucion_Memo()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->radicar_devolucion_memo();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//NUEVO EL 26 DE MARZO 2021
	public function Cargar_Indice_Electronico()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->cargar_indice_electronico();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Listar_Indice_Electronico()
	{


		if ($_SESSION['id'] != "") {


			require 'models/archivoModel.php';


			$modelo = new archivoModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("expediente_indice_electronico.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function CrearMultiple_Masivo()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_POST) {

				$modelo->adicionar_folios_masivo();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//7 DE MAYO 2021

	public function Generar_Excel_Expediente()
	{


		if ($_SESSION['id'] != "") {


			require 'models/expedientedigitalexcelModel.php';
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Ordenar_Expediente()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){
			if ($_GET) {

				$modelo->ordenar_expediente();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	//EMPIEZA DESARROLLO 4 DE JUNIO 2021 Y ENTRA A FUNCIONAR EL 10 DE JUNIO 2021

	public function Renombrar_Archivos_Expediente()
	{


		if ($_SESSION['id'] != "") {


			require 'models/archivoModel.php';


			$modelo = new archivoModel();

			//$rs1    = $modelo->listar_demanda();


			//$data['datos_juzgados'] = $rs1;


			if ($_POST) {

				//$lu->registrarDocumento();

			}



			$this->view->show("expediente_renombrar_archivos.php", $data);
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function RenombrarMultiple_Masivo()
	{



		//PARA QUE TOME LA HORA AL MOMENTO DE HACER EL REGISTRO 
		//Y NO CUANDO CARGUE EL FORMULARIO PARA UN NUEVO REGISTRO
		//date_default_timezone_set('America/Bogota'); 
		//$horaregistro  = date('H:i');


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			if ($_POST) {

				$modelo->renombrar_multiple_Masivo();
			}
		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//NUEVO 24 DE JUNIO 2021

	public function Bloquear_Proceso()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->bloquear_proceso();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Desbloquear_Proceso()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->desbloquear_proceso();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Lista_Expedientes_Bloqueados()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_bloqueado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Busquedad_Expedientes_Bloqueados()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_bloqueado.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//NUEVO 9 DE JULIO 2021

	public function Solicitud_Digitalizacion()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_solicitud_digitalizacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	public function Radicar_Solicitud_Digitalizacion()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->radicar_solicitud_digitalizacion();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	public function Solicitud_Digitalizacion_Filtro()
	{



		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			$this->view->show("expediente_solicitud_digitalizacion.php", $data);
		} else {
			header("refresh: 0; URL=/laborales/");
		}
	}

	//-----------------------------------FIN EXPEDIENTE DIGITAL---------------------------------------




	//********************************************************************************************
	//PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
	//ADICIONADO EL 10 DE JULIO 2019
	//********************************************************************************************

	public function Registrar_Solicitud()
	{


		if ($_SESSION['id'] != "") {

			require 'models/archivoModel.php';

			$modelo = new archivoModel();


			//if($_POST){

			$modelo->registrar_solicitud();
			//}



		} else {

			header("refresh: 0; URL=/laborales/");
		}
	}


	//********************************************************************************************

	//FIN PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO

	//********************************************************************************************


}
