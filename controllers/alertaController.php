<?php

class alertaController extends controllerBase

{



/*---------- Mensajes -------------*/

	

	public function mensajes()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/alertaModel.php';

		$ls = new alertaModel();

		$ls->mensajes();

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }

	}

/*------------- Listado Excel -------------------*/

	public function listadoExcel()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
			
			
			$rs1=$ln->listarJuzgados();
			$rs3=$ln->listarEstados();
			
			
			$data['datos_juzgados']=$rs1;
			$data['datos_estados']=$rs3;	
			

			if($_GET)

			{

			require 'models/excelModel.php';
			}

			
		
		

			//$this->view->show("correspondencia_generar472.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}



/*------------- Registrar Seguimiento -------------------*/

	public function regseguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$ls = new archivoModel();

	 	 			
			$rs1=$ld->listarEmpleados();
			$rs2=$ln->listarJuzgados();
			$rs3=$ls->listardias_nohabiles();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_dias'] = $rs3;

						

			if($_POST)

			{

			 $lu->registrarSeguimiento();

			}

			

			$this->view->show("archivo_registrar_seguimiento.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

	

	
	/*---------------------- Listar todos los seguimientos -------------------*/

	public function listarSeguimientos()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

       // $rs1 = $ls->listarSeguimientos();

		

		

		//$data['datos_seguimientos'] = $rs1;

		

		$this->view->show("index_listaSeguimiento.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

	

		/*------------- Consultar Seguimiento -----------------------------*/

	public function show_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarSeguimiento();

			$data['datos_seguimientos'] = $rs1;

			

					

			$this->view->show("archivo_consultar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

	/*------------- Modificar Archivo Otro -------------------*/

	public function edit_archivoOtro()

	{

	  if($_SESSION['id']!=""){

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
			$rs2=$ln->listarJuzgados();	
			$rs9=$ln->listarJuzgadoss();
			$rs6=$ln->listarJuzgadosDestino();		
			$rs1=$ls->listarDatosRadicadoModificar();
			$rs5=$lc->listarArchivoModificar();
			$rs3=$ln->listarEstados();
			$rs7=$ln->listarEstadosDetalles();
			$rs8=$ln->listarClaseProceso();
			$rs10=$ln->listarUltimaActuacion();//ULTIMA ACTUACION SECRETARIA
			$rs11=$lu->listarObservaciones();
			$rs12=$lu->listarDespachosJusticiaXXI();
			
			//POR JORGE ANDRES VALENCIA
			$rs10b = $lu->listarDespachosSecretaria();//ULTIMA ACTUACION DESPACHO
			$rs13  = $lu->listarAtuaciones();
			$rs14  = $lu->listarAsignadoa();
			//SE ENVIA EL ID DEL RADICADO DE LA TABLA ubicacion_expediente
			$rs15  = $lu->listarAtuacionesExpedientes(trim($_GET['nombre']));
			$rs16  = $ln->ClaseProcesoSigloXXI();
			
		
			//$rs6=$lp->listarCiudadOtro();
		
			
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadoss']=$rs9;
			$data['datos_juzgados_destino']=$rs6;
			$data['datos_estados']=$rs3;
			$data['datos_radicado']=$rs1;
			$data['datos_estadosdetalles']=$rs7;
			$data['datos_claseproceso']=$rs8;
			$data['detalles']=$rs11;
			$data['datos_despachos']=$rs12;

			//$data['datos_medio']=$rs1;
			//$data['datos_departamentos']=$rs3;
			$data['datos_archivo']=$rs5;
			$data['datos_siglo']=$rs10;
			//$data['datos_ciudad']=$rs6;
			
			//POR JORGE ANDRES VALENCIA
			$data['datos_siglob']    =$rs10b;
			$data['datos_actuacion'] =$rs13;
			$data['datos_asignadoa'] =$rs14;
			$data['datos_actuacionexpediente'] =$rs15;
			$data['dato_claseproceso'] =$rs16;
			
			
			if($_POST)

			{

			 $lu->modificarArchivo_Otro();

			}

			

			$this->view->show("archivo_modificarOtro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	
	/*------------- Modificar Archivo Otro -------------------*/

	public function Reparto_archivomodificarOtro()

	{

	  if($_SESSION['id']!=""){

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
			$rs2=$ln->listarJuzgados();	
			$rs9=$ln->listarJuzgadoss();
			$rs6=$ln->listarJuzgadosDestino();		
			$rs1=$ls->listarDatosRadicadoModificar();
			$rs5=$lc->listarArchivoModificar();
			$rs3=$ln->listarEstados();
			$rs7=$ln->listarEstadosDetalles();
			$rs8=$ln->listarClaseProceso();
			$rs10=$ln->listarUltimaActuacion();
			$rs11=$lu->listarObservaciones();
			$rs12=$lu->listarDespachosJusticiaXXI();
			
			//POR JORGE ANDRES VALENCIA
			$rs10b = $lu->listarDespachosSecretaria();
			$rs13  = $lu->listarAtuaciones();
			$rs14  = $lu->listarAsignadoa();
			//SE ENVIA EL ID DEL RADICADO DE LA TABLA ubicacion_expediente
			$rs15  = $lu->listarAtuacionesExpedientes(trim($_GET['nombre']));
			
		
			//$rs6=$lp->listarCiudadOtro();
		
			
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadoss']=$rs9;
			$data['datos_juzgados_destino']=$rs6;
			$data['datos_estados']=$rs3;
			$data['datos_radicado']=$rs1;
			$data['datos_estadosdetalles']=$rs7;
			$data['datos_claseproceso']=$rs8;
			$data['detalles']=$rs11;
			$data['datos_despachos']=$rs12;

			//$data['datos_medio']=$rs1;
			//$data['datos_departamentos']=$rs3;
			$data['datos_archivo']=$rs5;
			$data['datos_siglo']=$rs10;
			//$data['datos_ciudad']=$rs6;
			
			//POR JORGE ANDRES VALENCIA
			$data['datos_siglob']    =$rs10b;
			$data['datos_actuacion'] =$rs13;
			$data['datos_asignadoa'] =$rs14;
			$data['datos_actuacionexpediente'] =$rs15;
			
			

			$this->view->show("archivo_modificarOtro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	
	
	
	
	 /*------------- Editar Seguimiento -------------------------*/

	public function edit_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();
		$ld = new archivoModel();
		$ln = new archivoModel();

		$rs1=$ls->listarSeguimiento();
		$rs=$ld->listarEmpleados();
		$rs2=$ln->listarJuzgados();
			
			$data['datos_empleados']=$rs;
			$data['datos_juzgados']=$rs2;
			$data['datos_seguimientos'] = $rs1;	

				

		if($_POST)

		{

			$ls->updateSeguimiento();	

			

		}

		

		$this->view->show("archivo_modificar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	}


 /*------------- Editar Inventario Entrante -------------------------*/

	public function edit_acta_entrante()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;

				

		if($_POST)

		{

			$ls->updateInventarioEntrante();	

			

		}

		

		$this->view->show("archivo_modificar_inventario_entrante.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	}

/*------------- Editar Inventario Saliente -------------------------*/

	public function edit_acta_saliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lc = new archivoModel();
			$lg = new archivoModel();

			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo_entrega();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;

				

		if($_POST)

		{

			$ls->updateInventarioSaliente();	

			

		}

		

		$this->view->show("archivo_modificar_inventario_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	}


	 /*------------- Eliminar Seguimiento -------------------------*/

	public function elim_seguimiento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarSeguimiento();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	    	

	}

	/*------------- Eliminar Inventario Entrante -------------------------*/

	public function elim_inventarioEntrante()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarInventarioEntrante();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	    	

	}

	/*------------- Eliminar Inventario Saliente -------------------------*/

	public function elim_inventarioSaliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->eliminarInventarioSaliente();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	    	

	}

	

	/*------------- Entregar Documento -------------------------*/

	public function entrega_documento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

			$ls = new archivoModel();

			$ls->entregaDocumento();	

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	    	

	}

	

	/*---------------------- Subir Documento -------------------*/

	public function subir_documento()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			if($_POST)

			{

			 $ls->subirDocumento();

			} 

			

			$this->view->show("archivo_subirInforme.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	}

	

	/*---------------------- Listar Documentos -------------------*/

	public function listar_documentos()

	{

	  if($_SESSION['id']!=""){

	  

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

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lg->listardias_nohabiles();
			$rs5=$lc->listarConsecutivo();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_dias']=$rs4;
			$data['datos_consecutivo']=$rs5;

						

			if($_POST)

			{

			 $lu->registrarInventarioEntrante();

			}

			

			$this->view->show("archivo_registrar_inventario_entrante.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

	
/*------------- Registrar Salida Inventario -------------------*/

	public function regSalidaInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;

						

			if($_POST)

			{

			 $lu->registrarInventarioSaliente();

			}

			

			$this->view->show("archivo_registrar_inventario_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

/*------------- Registrar Ubicación Expediente -------------------*/

	public function regUbicacionExpediente()

	{

	
	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs8=$ln->listarJuzgados();
			$rs4=$lf->listarEstados();
			$rs3=$ln->listarJuzgadosDestino();
			$rs5=$ln->listarEstadosDetalles();
			$rs8=$ln->listarClaseProceso();
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadoss']=$rs8;
			$data['datos_juzgados_destino']=$rs3;
			$data['datos_estados']=$rs4;
			$data['datos_estadosdetalles']=$rs5;
			$data['datos_claseproceso']=$rs8;
			

						

			if($_POST)

			{
			 $lu->registrarPosicionExpediente();

			}

			

			$this->view->show("archivo_registrar_posicion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	/*------------- Registrar Salida Expediente -------------------*/

	public function regSalidaExpediente()

	{

	
	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs4=$lf->listarEstadosDetalles();
			$rs5=$ld->listarArchivoOtro();
			$rs3=$ln->listarJuzgadosDestino();
			
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgados_destino']=$rs3;
			$data['datos_estados']=$rs4;
			$data['datos_archivo']=$rs5;	

			if($_POST)

			{

			 $lu->registrarSalidaExpediente();

			}

			

			$this->view->show("archivo_registrar_salida.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	
	/*------------- Registrar Devolución Expediente -------------------*/

	public function regDevolucionExpediente()

	{

	
	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs4=$lf->listarEstados();
			$rs5=$ld->listarArchivoDevolucion();
			$rs3=$ln->listarJuzgadosDestino();
			
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgados_destino']=$rs3;
			$data['datos_estados']=$rs4;
			$data['datos_archivo']=$rs5;	

			if($_POST)

			{

			 $lu->registrarDevolucionExpediente();

			}

			

			$this->view->show("archivo_registrar_devolucion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	/*------------- Registrar Títulos -------------------*/

	public function regTitulos()

	{

	
	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs4=$lf->listarEstados();
			$rs5=$ld->listarArchivoDevolucion();
			$rs3=$ln->listarJuzgadosDestino();
			$rs6=$ln->listarTitulosMod();
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgados_destino']=$rs3;
			$data['datos_estados']=$rs4;
			$data['datos_archivo']=$rs5;
			$data['datos_TitulosMod']=$rs6;	

			if($_POST)

			{

			 $lu->registrarTitulos();

			}

			

			$this->view->show("archivo_registrar_titulos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	/*---------------------- Listar actas de recibidos -------------------*/

	public function listRecibidoInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

        $rs1 = $ls->listarRecibidos();
		

		$data['datos_recibidos'] = $rs1;		

		$this->view->show("index_listaRecibidoInventario.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

/*---------------------- Listar actas de entregas -------------------*/

	public function listEntregaInventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

        $rs1 = $ls->listarEntregados();
		

		$data['datos_entregados'] = $rs1;		

		$this->view->show("archivo_listar_entregados.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

/*---------------------- Listar Ubicación Expedientes -------------------*/

	public function listarUbicacionExpediente()

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
		
		$data['datos_ubicacion'] = $rs1;
		$data['datos_estados']=$rs3;	
		$data['datos_estadosdetalles']=$rs7;	
		$data['datos_usuarios']=$rs8;
		$data['datos_juzgadodestino']=$rs9;
		$data['datos_juzgadodestinos']=$rs10;
		
		//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
		$data['datos_asignadoa'] =$rs11;
		$data['datos_actuaciones'] =$rs12;

		
		
		
		//$data['datos_juzgados_destino']=$rs8;

		$this->view->show("archivo_filtrar_ubicacion.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	
	/*----------------------Ver Títulos------------------*/

	public function verTitulos()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		$ls = new archivoModel();

        $rs1 =$ls->listarTitulos();
		
		
		$data['datos_titulos'] = $rs1;
		

		$this->view->show("archivo_ver_titulos.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	
	public function listarUbicacionExpediente1()

	{

	  if($_SESSION['id']!=""){

		require 'models/archivoModel.php';
		
		$lu = new archivoModel();
		
		$rs1=$lu->FiltroUbicacionExpedientes();
		$rs3=$lu->listarEstados();
		$rs7=$lu->listarEstadosDetalles();
		$rs8=$lu->listarUsuarios();
		$rs9=$lu->listarJuzgadosDestino();
		$rs10=$lu->listarJuzgadosDestino();
		//$rs3=$lu->listarUsuarios();
		//$rs4=$lu->listarUsuarios();
		
		//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
		$rs11  = $lu->listarAsignadoa();
		$rs12  = $lu->listarActuaciones_Expedientes();
			
		$data['datos_ubicacion']=$rs1;
		$data['datos_estados']=$rs3;	
		$data['datos_estadosdetalles']=$rs7;
		$data['datos_usuarios']=$rs8;
		$data['datos_juzgadodestino']=$rs9;
		$data['datos_juzgadodestinos']=$rs10;	
	//	$data['datos_usuarios']=$rs4;
//		$data['datos_usuariosr']=$rs3;

		//ASIGNADO POR JORGE ANDRES VALENCIA OROZCO
		$data['datos_asignadoa'] =$rs11;
		$data['datos_actuaciones'] =$rs12;
		
		
		
	

			if($_POST)

			{

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("archivo_filtrar_ubicacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
/*------------- Consultar Inventario -----------------------------*/

	public function show_inventario()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarInventarioEspecifico();

			$data['datos_inventario'] = $rs1;

			

					

			$this->view->show("archivo_consultar_acta_recibido.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

/*------------- Consultar Inventario Saliente -----------------------------*/

	public function show_inventariosaliente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';



			$ls = new archivoModel();

			

			$rs1=$ls->listarInventarioEspecificoSaliente();

			$data['datos_inventario'] = $rs1;

			

					

			$this->view->show("archivo_consultar_acta_saliente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
	
/*------------- Registrar Informe Gestión -----------------------------*/

	public function regGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();
	  $ld = new archivoModel();

	  $rs1=$ls->listarAno();
	  $rs2=$ld->listardias_nohabiles();
	  $data['datos_anos'] = $rs1;
	
			
			if($_POST)
            {
			$lu->registrarInformeGestion();
			}
 		$this->view->show("archivo_registrar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
	/*------------- Consultar Informe Gestión -----------------------------*/

	public function consultarGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
		$this->view->show("archivo_consultar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
	
	
	/*------------- Consultar Informe Gestión -----------------------------*/

	public function consultarGestion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->consultarInformeGestion();
	  $data['datos_gestion'] = $rs1;
			
		$this->view->show("archivo_consultar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
	
	/*------------- Modificar Informe Gestión -----------------------------*/

	public function modificarGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
		$this->view->show("archivo_modificar_gestion.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
	/*------------- Modificar Informe Gestión -----------------------------*/

	public function modificarGestion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->consultarInformeGestion();
	  $data['datos_gestion'] = $rs1;
	  
	  if($_POST)
            {
			$lu->modificarInformeGestion();
			}
	  
	  
			
		$this->view->show("archivo_modificar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
/*------------- Modificar Informe Gestión -----------------------------*/

	/*public function editGestion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';
      
	  $ls = new archivoModel();
	  $lu = new archivoModel();

	  $rs1=$ls->listarAno();
	  $data['datos_anos'] = $rs1;
			
			if($_POST)
            {
			$lu->modificarInformeGestion();
			}
 		$this->view->show("archivo_modificar_gestion1.php", $data);

	   }
	  else{
    	header("refresh: 0; URL=/centro_servicios/");
		  }

	}
	
	*/

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
/*******************************************************************************************************************/	
/************************************************ REPORTES POR MÓDULO **********************************************/
/*******************************************************************************************************************/
	
/******************************************* Reporte Producción Diaria *********************************************/	
	
		public function ReporteProduccionDiaria()
	{
	  if($_SESSION['id']!=""){
	  
		  require 'models/archivoModel.php';
		  $this->view->show("reporte_produccion_diaria.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}

/****************** Redirecciona a la generación del gráfico del reporte Producción Diaria *************************/	
public function  ReporteProduccionDiaria1()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/archivoModel.php';
	    require 'models/barrasModel.php';
			
		
		$this->view->show("reporte_produccion_diaria1.php");
      }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}	
	

/**************************************** Reporte Producción Rango de Fechas ********************************************/	
	
		public function ReporteProduccionRango()
	{
	  if($_SESSION['id']!=""){
	  
		  require 'models/archivoModel.php';
		  $this->view->show("reporte_produccion_rango.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}

/************** Redirecciona a la generación del gráfico del reporte Producción Rango de Fechas ***********************/	
public function  ReporteProduccionRango1()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/archivoModel.php';
	    require 'models/barrasModel.php';
			
		$this->view->show("reporte_produccion_rango1.php");
      }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}	
	
	
/**************************************** Reporte Producción Juzgado ********************************************/	
	
		public function ReporteProduccionJuzgado()
	{
	  if($_SESSION['id']!=""){
	  
		   require 'models/pieModel.php';
		    $lu = new pieModel();
			$rs1=$lu->obtenerJuzgadosProcesosCajas();
			
			
			$cantidad= count($rs1);
	    	$i=0;
	    	while ($i<$cantidad)
	   		{
	   		$vector_juz[$i]=$rs1[$i][nombre_juz];
			$vector_caj[$i]=$rs1[$i][caja];
			$vector_pros[$i]=$rs1[$i][proces];
	   		
	 		$i = $i+1; 
	   		}
			
			//print_r($vector_juz);
			$data['datos_despachos']=$vector_juz;
			$data['datos_cajas']=$vector_caj;
			$data['datos_procesos']=$vector_pros;
				
			   
		   
		  $this->view->show("reporte_produccion_juzgado.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}
	
/**************************************** Reporte Entrantes vs Salientes ********************************************/	
	
		public function ReporteEntrantesSalientes()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			
			$rs2=$ln->listarJuzgados();
			
			$data['datos_juzgados']=$rs2;
			
		  $this->view->show("reporte_entrante_saliente.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}
	
/**************************************** Reporte Entrantes vs Salientes ********************************************/	
	
		public function ReporteEntrantesSalientes1()
		
		{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporte1();
			$rs2=$lr->listarSalientesReporte1();
			$rs3=$ls->nombreJuzgado();
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			$data['nombre_juzgado']=$rs3;
			
		  $this->view->show("reporte_entrante_saliente2.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
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
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}*/
	
	
	
	
	
	
	
	/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/	
	
		public function ReporteEntrantesSalientesTodos()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			
		
			
		  $this->view->show("reporte_entrante_saliente_todos.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}
	
	
/**************************************** Reporte Entrantes vs Salientes Todos ********************************************/	
	
		public function ReporteEntrantesSalientes_todos1()
	{
	   if($_SESSION['id']!=""){
	   
	   
		  require 'models/archivoModel.php';

			$ln = new archivoModel();
			$lr = new archivoModel();
			$ls = new archivoModel();
			
			$rs1=$ln->listarEntrantesReporteTODOS1();
			$rs2=$lr->listarSalientesReporteTODOS1();
			
			
			$data['datos_entrantes']=$rs1;
			$data['datos_salientes']=$rs2;
			
			
		  $this->view->show("reporte_entrante_saliente_Todos1.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/centro_servicios/");
	  }	
	}	
	
	
	
	

	
 /*------------- Entregar Inventario Entrante -------------------------*/

	public function entregar_acta_entrante()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/archivoModel.php';

		

		    $lu = new archivoModel();
			$ld = new archivoModel();
			$ln = new archivoModel();
			$lf = new archivoModel();
			$ls = new archivoModel();
			$lg = new archivoModel();
			$lc = new archivoModel();
			
			$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ln->listarJuzgados();
			$rs3=$lf->listarJuzgados();
			$rs4=$lu->listarInventarioEspecifico();
			$rs5=$lg->listardias_nohabiles();
			$rs6=$lc->listarConsecutivo_entrega();
			
			$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadosdestino']=$rs3;
			$data['datos_inventario']=$rs4;
			$data['datos_dias']=$rs5;
			$data['datos_consecutivo']=$rs6;

				

		if($_POST)

		{

			$ls->entregarInventarioEntrante();	

			

		}

		

		$this->view->show("archivo_entregar_inventario_entrante.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }

	}	

/*------------- Generar Acta Word -------------------*/

	public function generarActa()

	{

	  if($_SESSION['id']!=""){
		

			require 'models/archivoModel.php';
			$ld = new archivoModel();
			
			
			//$rs1 = $ld->generarActa();
			
			
			require 'models/wordModel.php';
		    

			

			  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}
/*------------- Adicionar Memorial -------------------*/

	public function adicionar_memorial()

	{

	  if($_SESSION['id']!=""){

		require 'models/archivoModel.php';
		require 'models/correspondenciaModel.php';



			$lu = new archivoModel();
			$lc = new correspondenciaModel();

			$rs2=$lu->listarJuzgados();	
			$rs9=$lu->listarJuzgadoss();
			$rs6=$lu->listarJuzgadosDestino();		
			$rs1=$lu->listarDatosRadicadoModificar();
			$rs5=$lu->listarArchivoModificar();
			$rs3=$lu->listarEstados();
			$rs7=$lu->listarEstadosDetalles();
			$rs8=$lu->listarClaseProceso();
			$rs10=$lu->listarUltimaActuacion();
			$rs11=$lu->listarObservaciones();
			$rs12=$lu->listarDespachosJusticiaXXI();
			$rs13=$lc->listarSolicitudes();
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_juzgadoss']=$rs9;
			$data['datos_juzgados_destino']=$rs6;
			$data['datos_estados']=$rs3;
			$data['datos_radicado']=$rs1;
			$data['datos_estadosdetalles']=$rs7;
			$data['datos_claseproceso']=$rs8;
			$data['detalles']=$rs11;
			$data['datos_despachos']=$rs12;
			$data['datos_solicitud']=$rs13;


			$data['datos_archivo']=$rs5;
			$data['datos_siglo']=$rs10;


						

			if($_POST)

			{

			 $lc->registrarMemorial();

			}

			

			$this->view->show("archivo_registrar_memorial.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	//**********************************************************************************************************************************************
	//PROYECTO PASAR LIQUIDAR COSTAS A AMBIENTE WEB 09 DE ABRIL 2015
	
	public function registrarliquidacioncostas()

	{

	  if($_SESSION['id']!=""){

	  

			require 'models/archivoModel.php';



			$lu = new archivoModel();
			$ld = new archivoModel();
			
	 	 			
			$rs1=$ld->listarAreaEmpleados();
			
			
			$data['datos_areas']=$rs1;
						

			if($_POST)

			{

				$lu->registrarprueba();

			}

			

			$this->view->show("archivo_liquidar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucionprueba/");

	  }



	}
	
	//PARTE AGREGADA EL 07 DE MAYO DEL 2015 PARA EL MANEJO DEL TRASLADO ART. 108
	public function Registrar_Traslado108(){

		if($_SESSION['id']!=""){
	
			require 'models/archivoModel.php';
			
			$modelo = new archivoModel();
			
			
			if($_GET){
	
				$modelo->RegistrarTraslado108();
	
			}
	
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function Generar_Documento_Traslado108(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/wordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function Registrar_A_Despacho(){
	
		if($_SESSION['id']!=""){
	
			require 'models/archivoModel.php';
			
			$modelo = new archivoModel();
			
			
			if($_GET){
	
				$modelo->RegistrarADespacho();
	
			}
	
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Actualizar_Procesos(){
	
		if($_SESSION['id']!=""){
	
			require 'models/archivoModel.php';
			
			$modelo = new archivoModel();
			
			$modelo->ActualizarClaseProceso();
			
			$this->view->show("archivo_filtrar_ubicacion.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	public function Titulos_Encustodia(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/archivoModel.php';

			$modelo = new archivoModel();
					
			if($_POST){
			 
				$modelo->registrar_titulos_encustodia();
		
			}
		
			$this->view->show("siepro_titulos_materializados.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
			
			
	}
	
	public function Listar_Titulos_Materializados(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$this->view->show("siepro_listar_titulos_materializados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function Listar_Titulos_OtrosJuzgados(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/archivoModel.php';

			$modelo = new archivoModel();
					
			if($_POST){
			 
				$modelo->registrar_titulos_otrosJuzgados();
		
			}
		
			$this->view->show("siepro_titulos_otrosjuzgados.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
	

	}
	
	public function Listar_Titulos_OtrosJuzgados_2(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function AsignarFechaPago(){

		
		if($_SESSION['id']!=""){

	  

			require 'models/archivoModel.php';

			$lu = new archivoModel();
			
			if($_POST){
			 
			 	$lu->asignarfechapago();

			}

			$this->view->show("empleados_registrar_ingsal.php", $data);

		}
	
		else{
	
			header("refresh: 0; URL=/ejecucion/");
	
		}
	}
	
	public function RecargarTabla(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$model  = new archivoModel();
		
			$filtro = $model->get_titulos_materializados(1);
	
			$data['datossalientes'] = $filtro;
		
			//$this->view->show("sigdoc_documentos_salientes.php", $data);
			
			$this->view->show("siepro_listar_titulos_materializados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function FiltroTabla(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$model  = new archivoModel();
		
			$filtro = $model->get_titulos_materializados(2);
	
			$data['datossalientes'] = $filtro;
		
			$this->view->show("siepro_listar_titulos_materializados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	
	public function RecargarTablaOtrosJuzgados(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$model  = new archivoModel();
		
			$filtro = $model->get_titulos_materializados(1);
	
			$data['datossalientes'] = $filtro;
		
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	public function FiltroTablaOtrosJuzgados(){

		if($_SESSION['id']!=""){

			require 'models/archivoModel.php';
		
			$model  = new archivoModel();
		
			$filtro = $model->get_titulos_materializados(2);
	
			$data['datossalientes'] = $filtro;
		
			$this->view->show("siepro_listar_titulos_otrosjuzgados.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}
	}

	
	
	public function Poner_En_Custodia(){
	
	
		if($_SESSION['id']!=""){
		
			require 'models/archivoModel.php';

			$modelo = new archivoModel();
					
			if($_GET){
			 
				$modelo->poner_en_custodia();
		
			}
		
			$this->view->show("siepro_listar_titulos_materializados.php", $data);
			
				
				
		}
		else{
			header("refresh: 0; URL=/ejecucion/");

		}	
			
			
	}
	
	public function GenerarTituloExcel(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/sieproexcelModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function GenerarTituloOtroJuzgadoExcel(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/sieproexcelModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	public function GenerarTerminosExcel(){
	

		if($_SESSION['id']!=""){
		
			
			require 'models/sieproexcelModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	
	public function Registrar_A_Despacho_Masivo(){
	
		if($_SESSION['id']!=""){
	
			require 'models/archivoModel.php';
			
			$modelo = new archivoModel();
			
			
			if($_GET){
	
				$modelo->RegistrarADespacho_Masivo();
	
			}
	
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	//PARTE AGREGADA EL 25 DE ENERO DEL 2016 PARA EL MANEJO DE ASIGNAR FECHA TERMINO
	public function Registrar_Termino(){

		if($_SESSION['id']!=""){
	
			require 'models/archivoModel.php';
			
			$modelo = new archivoModel();
			
			
			if($_GET){
	
				$modelo->RegistrarTermino();
	
			}
	
			//$this->view->show("archivo_filtrar_ubicacion.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	
	
	
	//TUTELAS
	
	public function Listar_Tutelas(){

		if($_SESSION['id']!=""){

			require 'models/alertaModel.php';
		
			$this->view->show("alerta_listar.php", $data);

	  	}
	  	else{

			header("refresh: 0; URL=/ejecucion/");
		}

	}
	
	public function AsignarFechaFalloTutela(){

		
		if($_SESSION['id']!=""){

	  

			require 'models/alertaModel.php';

			$lu = new alertaModel();
			
			if($_POST){
			 
			 	$lu->asignarfechafallotutela();

			}

			$this->view->show("alerta_listar.php", $data);

		}
	
		else{
	
			header("refresh: 0; URL=/ejecucion/");
	
		}
	}
	
	


	
	
}

?>