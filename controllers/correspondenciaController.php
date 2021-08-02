<?php

class correspondenciaController extends controllerBase

{



/*---------- Mensajes -------------*/

	

	public function mensajes()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		$ls = new correspondenciaModel();

		$ls->mensajes();

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }

	}

/*------------- Registrar Documentos -------------------*/

	public function regmemorial()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		


			$lu = new correspondenciaModel();
			
			
			$rs1=$lu->listarJuzgados();
			$rs4=$lu->listarJuzgadosDescongestion();
			$rs3=$lu->listarJuzgadoDestino();
			$rs2=$lu->listarSolicitudes();
			
			//$rs6=$lu->listarSiglo1();
				
			$data['datos_juzgados']=$rs1;
			$data['datos_solicitud']=$rs2;
			$data['datos_destino']=$rs3;
			$data['datos_descongestion']=$rs4;
			
			//$data['datos_siglo1']=$rs6;
			
	
						

			if($_POST)

			{
			 $lu->registrarDocumento();
			}

			$this->view->show("correspondencia_registrar_documento1.php", $data);
	  }

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Listar Documentos -------------------*/

	public function listarDocumentos()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
		
		$lu = new correspondenciaModel();
		$ln = new archivoModel();
		
		$rs1=$lu->listarJuzgados();
		$rs2=$lu->listarSolicitudes();
		$rs3=$lu->listarJuzgadoDestino();
		$rs4=$lu->listarUsuarios();
		$rs5=$lu->listarDocumentos();
		$rs6=$ln->listarUbicacion();
		
		$rs7=$lu->listarJuzgadoDestino();
			
		$data['datos_juzgados']=$rs1;
		$data['datos_juzgados1']=$rs3;
		$data['datos_solicitud']=$rs2;
		$data['datos_usuarios']=$rs4;
		$data['datos_documentos']=$rs5;
		$data['datos_ubicacion']=$rs6;
		
		$data['datos_juzgadoreparto']=$rs7;
		
		
	

			if($_POST)

			{

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("correspondencia_filtrar_documentos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


/*------------- Listar Documentos -------------------*/

	public function listarDocumentos1()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
		
		$lu = new correspondenciaModel();
		$ln = new archivoModel();
		
		$rs1=$lu->listarJuzgados();
		$rs2=$lu->listarSolicitudes();
		$rs3=$lu->listarJuzgadoDestino();
		$rs4=$lu->listarUsuarios();
		$rs5=$lu->listarDocumentosFiltro();
		$rs6=$ln->listarUbicacion();
		
		$rs7=$lu->listarJuzgadoDestino();
			
		$data['datos_juzgados']=$rs1;
		$data['datos_juzgados1']=$rs3;
		$data['datos_solicitud']=$rs2;
		$data['datos_usuarios']=$rs4;
		$data['datos_documentos']=$rs5;
		$data['datos_ubicacion']=$rs6;
		
		$data['datos_juzgadoreparto']=$rs7;
		
		
	

			if($_POST)

			{
			
				$rs =  $lu->generarEntrega();
			$data['datos_entrega']=$rs;
			/*  
			  $this->view->show("correspondencia_generar_entrega.php", $data);
*/
			}

			

			$this->view->show("correspondencia_filtrar_documentos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	/*------------- Listar Siglo XXI -------------------*/

	public function listarSigloXXI()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';
		
		$lu = new correspondenciaModel();
		$ln = new archivoModel();
		
		$rs1=$lu->listarJuzgados();
		$rs2=$lu->listarSolicitudes();
		$rs3=$lu->listarJuzgados();
		$rs4=$lu->listarUsuarios();
		$rs5=$lu->listarDocumentosFiltro();
		$rs6=$ln->listarUbicacion();
		$rs7=$lu->listarUbicacionSigloXXI();
		$rs8=$lu->listarJuzgadoDestino();
		//$rs9=$lu->listarDemandante();
		$rs10=$lu->listarDemandante();
			
		$data['datos_juzgados']=$rs1;
		$data['datos_juzgados1']=$rs3;
		$data['datos_solicitud']=$rs2;
		$data['datos_usuarios']=$rs4;
		$data['datos_documentos']=$rs5;
		$data['datos_ubicacion']=$rs6;
		$data['datos_siglo']=$rs7;
		$data['datos_destino']=$rs8;
	//	$data['datos_siglo']=$rs9;
		$data['datos_demandante']=$rs10;
		
		if($rs7 == '' && $rs10 =='' )
		print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=9"</script>';
	
			if($_POST)

			{
			 $lu->registrarDocumento();
			}
			//if($_POST)

			//{
			//echo("hoaa");
		//		$rs =  $lu->generarEntrega();
			//$data['datos_entrega']=$rs;
			 //}
			  $this->view->show("correspondencia_registrar_documento1.php", $data);

			
	
			

//$this->view->show("correspondencia_filtrar_documentos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Modificar Documentos -------------------*/

	public function modificarDocumentos()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';


			$lu = new correspondenciaModel();
					
			$rs1=$lu->listarJuzgados();
			$rs2=$lu->listarSolicitudes();
			$rs3=$lu->listarDatosRadicadoModificar();
			$rs4=$lu->consultarDocumento();
			$rs5=$lu->listarJuzgadoDestino();
			$rs6=$lu->listarUbicacionSigloXXIMod();
			$rs7=$lu->listarDemandanteMod();
			
			$data['datos_juzgados']=$rs1;
			$data['datos_solicitud']=$rs2;
			$data['datos_radicado']=$rs3;
			$data['datos_documento']=$rs4;
			$data['datos_destino']=$rs5;
			$data['datos_siglo']=$rs6;
			$data['datos_demandante']=$rs7;
			
			//consultarDocumento
	
						

			if($_POST)

			{
			 $lu->modificarDocumento();
			}

			$this->view->show("correspondencia_modificar_documento.php", $data);
	  }

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Modificar Documentos -------------------*/

	public function generarEntrega()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';


			$lu = new correspondenciaModel();
		
				

			//if($_POST)

			//{
			 //echo "ss";
			// $lu->generarEntrega();
			//}

			$this->view->show("correspondencia_generar_entrega.php", $data);
	  }

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}



/*------------- Registrar Peticion -------------------*/

	public function regpeticion()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';


			$lu = new correspondenciaModel();
			
			$rs1=$lu->consultarConsecutivo();	
			$data['consecutivo']=$rs1;
			
			$rs3=$lu->listarJuzgados();
			$data['datos_juzgados']=$rs3;
			
	
			if($_POST)

			{
			 $lu->registrarSolicitud();
			}

			$this->view->show("correspondencia_registrar_solicitud1.php", $data);
	  }

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}




/*------------- Listar Solicitudes -------------------*/

	public function listarSolicitudesReg()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		
		$lu = new correspondenciaModel();
		
		$rs1=$lu->listarSolicitudesUsuarios();
		$rs3=$lu->listarUsuarios();
		$rs4=$lu->listarUsuarios();
			
		$data['datos_solicitudes']=$rs1;
		$data['datos_usuarios']=$rs4;
		$data['datos_usuariosr']=$rs3;
		
		
		
		
	

			if($_POST)

			{

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("correspondencia_filtrar_solicitud.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


/*------------- Listar Solicitudes -------------------*/

	public function listarSolicitudesReg1()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		
		$lu = new correspondenciaModel();
		
		$rs1=$lu->FiltroSolicitudesUsuarios();
		$rs3=$lu->listarUsuarios();
		$rs4=$lu->listarUsuarios();
			
		$data['datos_solicitudes']=$rs1;
		$data['datos_usuarios']=$rs4;
		$data['datos_usuariosr']=$rs3;
		
		
		
	

			if($_POST)

			{

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("correspondencia_filtrar_solicitud.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Modificar Solicitudes -------------------*/

	public function modificarSolicitud()

	{

	  if($_SESSION['id']!=""){

		require 'models/correspondenciaModel.php';
		
		$lu = new correspondenciaModel();
		
		$rs1=$lu->listarSolicitudEspecifica();
		$rs2=$lu->listarDatosRadicadoModificarSolicitud();
		$rs3=$lu->listarUsuarios();
		$rs4=$lu->listarUsuarios();
		$rs5=$lu->listarJuzgados();
		$rs6=$lu->listarDescripcionesSolicitud();
		
			
			
		$data['datos_solicitudes']=$rs1;
		$data['datos_usuarios']=$rs4;
		$data['datos_usuariosr']=$rs3;
		$data['datos_juzgados']=$rs5;
		$data['datos_radicados']=$rs2;
		$data['detalles']=$rs6;
		

			if($_POST)

			{

			 $lu->modificarSolicitud();

			}

			

			$this->view->show("correspondencia_modificar_solicitud.php", $data);

	  }
	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }

	}


/*------------- Excel -------------------*/

	public function exportarCorrespondenciaExcel()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
			
			//$rs1=$ln->listarJuzgados();
			
			
			//$data['datos_juzgados']=$rs1;
			

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
	
	public function exportarCorrespondenciaExcelMemoriales()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
			
			//$rs1=$ln->listarJuzgados();
			
			
			//$data['datos_juzgados']=$rs1;
			

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

























































































































































































/*------------- Registrar Correspondencia -------------------*/

	public function regcorrespondencia()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs4=$lt->listarActuacion();
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_actuacion']=$rs4;

						

			if($_POST)

			{

			 $lu->registrarCorrespondencia();

			}

			

			$this->view->show("correspondencia_registrar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
/*------------- Registrar Correspondencia Tutela-------------------*/

	public function regcorrespondenciatutela()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$lr = new correspondenciaModel();			
			$ln = new archivoModel();
			
			
			$rs1=$lr->listarRadicadosTutelasExistentes();
			$rs2=$ln->listarJuzgados();
			
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_radicados']=$rs1;
	
						

			if($_POST)

			{

			 $lu->registrarCorrespondenciaTutela();

			}

			

			$this->view->show("correspondencia_registrarTutela.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
/*------------- Registrar Correspondencia Otro -------------------*/

	public function regcorrespondenciaotro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ln = new archivoModel();
			$ls = new correspondenciaModel();
			
			
			
			$rs1=$ls->listarMedio();
			$rs2=$ln->listarJuzgados();
			$rs3=$lu->listarDepartamentos();
			
					
			
			$data['datos_medio']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_departamentos']=$rs3;
			
		
						

			if($_POST)

			{

			 $lu->registrarCorrespondenciaOtro();

			}

			

			$this->view->show("correspondencia_registrar_otro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


/*------------- Registrar Correspondencia Incidente -------------------*/

	public function regcorrespondenciaincidente()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			
			$lv = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lu = new correspondenciaModel();
			$ln = new archivoModel();
			$li = new correspondenciaModel();
			
			
			
			$rs1=$ld->listarDepartamentos();
			$rs2=$lv->listarAccionadosVinculadosAccionantes();
			$rs3=$lt->listarActuacion();
			$rs4=$ls->listarMedio();
			$rs5=$ln->listarJuzgados();
			$rs6=$li->listarJuzgadoIncidente();
			
			$data['datos_departamentos']=$rs1;
			$data['datos_nombres']=$rs2;
			$data['datos_actuacion']=$rs3;
			$data['datos_medio']=$rs4;
			$data['datos_juzgados']=$rs5;
			$data['datos_juzgado']=$rs6;
			
						

			if($_POST)

			{

			$lu->registrarCorrespondenciaIncidente();

			}

			

			$this->view->show("correspondencia_registrarIncidente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}









	
/*---------------------- Listar todas las correspondencias -------------------*/

	public function listarCorrespondencias()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        //$rs1 = $ls->listarCorrespondenciasOtros();

		

		

		//$data['datos_correspondencias'] = $rs1;

		

		$this->view->show("index_listaOtror.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*---------------------- Listar todas las tutelas -------------------*/

	public function listarCorrespondenciasTutelas()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        //$rs1 = $ls->listarCorrespondenciasTutelas();

		

		

		//$data['datos_correspondencias'] = $rs1;

		

		$this->view->show("index_listar_tutela.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}




	/*------------- Consultar Correspondencia -----------------------------*/

	public function show_correspondencia()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$la = new correspondenciaModel();
			$lv = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs1=$ln->listarJuzgados();
			$rs2=$lc->listarCorrespondenciaTutela();
			$rs3=$ld->listarPartesTutela_nv();
			$rs4=$ls->listarActuacionesTutela();			
			$rs6=$le->listarEvidencias();
			$rs7=$lp->listar_accionados();
			$rs8=$la->listar_accionante();
			$rs9=$lv->listar_vinculados();
			
			
			
			
			$data['datos_juzgados']=$rs1;
			$data['datos_correspondencia']=$rs2;
			$data['datos_partes']=$rs3;
			$data['datos_actuaciones']=$rs4;
			$data['datos_evidencia']=$rs6;
			$data['datos_nombres_accionados']=$rs7;
			$data['datos_accionante']=$rs8;
			$data['datos_vinculado']=$rs9;

						

		
			

			$this->view->show("correspondencia_consultarTutelaIncidente.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


/*------------- Consultar Correspondencia Otro -----------------------------*/

	public function show_correspondenciaOtro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';



			$ls = new correspondenciaModel();
			$la = new correspondenciaModel();
			$le = new correspondenciaModel();

			

			$rs1=$ls->consultarOtros();
			$rs3=$le->listarEvidenciasOtros();

			$data['datos_correspondencia'] = $rs1;
			$data['datos_evidencia'] = $rs3;

			

					

			$this->view->show("correspondencia_consultar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

		
/*------------- Modificar Correspondencia -------------------*/

	public function edit_correspondencia()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs4=$lt->listarActuacion();
			$rs5=$lc->listarCorrespondencia();
			$rs6=$le->listarEvidencias();
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_actuacion']=$rs4;
			$data['datos_correspondencia']=$rs5;
			$data['datos_evidencia']=$rs6;

						

			if($_POST)

			{

			 //$lu->registrarCorrespondencia();

			}

			

			$this->view->show("correspondencia_modificar.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Modificar Correspondencia Tutela -------------------*/

	public function edit_correspondenciaTutela()

	{

	  if($_SESSION['id']!=""){

	  

			require 'models/correspondenciaModel.php';
			require 'models/archivoModel.php';


			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$la = new correspondenciaModel();
			$lv = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs1=$ln->listarJuzgados();
			$rs2=$lc->listarCorrespondenciaTutela();
			//$rs3=$ld->listarPartesTutela();
			$rs3=$ld->listarPartesTutela_nv();
			$rs4=$ls->listarActuacionesTutela();			
			$rs6=$le->listarEvidencias();
			$rs7=$lp->listar_accionados();
			$rs8=$la->listar_accionante();
			$rs9=$lv->listar_vinculados();
			
			
			
			$data['datos_juzgados']           = $rs1;
			$data['datos_correspondencia']    = $rs2;
			$data['datos_partes']             = $rs3;
			$data['datos_actuaciones']        = $rs4;
			$data['datos_evidencia']          = $rs6;
			$data['datos_nombres_accionados'] = $rs7;
			$data['datos_accionante']         = $rs8;
			$data['datos_vinculado']          = $rs9;

						

			if($_POST)

			{

			 	$lu->modificarCorrespondenciaTutela_nv();
				
				/*SE REALIZA ESTA CONSULTA PARA QUE AL ADICIONAR ACTUACIONES
				EL SISTEMA SE QUEDE EN EL MISMI FORMULARIO
				CAMBIO HECHO 12 DE FEBRERO 2018*/
				$id_radicado_consultado         = trim($_GET['nombre']);
				$data['id_radicado_consultado'] = $id_radicado_consultado."******"."1";

			}

			

			//$this->view->show("correspondencia_modificarTutela.php", $data);
			$this->view->show("correspondencia_modificarTutelaIncidente_nv.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}



/*------------- Modificar Correspondencia Otro -------------------*/

	public function edit_correspondenciaOtro()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$ld = new correspondenciaModel();
			$ls = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lc = new correspondenciaModel();
			$le = new correspondenciaModel();
			$lp = new correspondenciaModel();
			$ln = new archivoModel();
			
			
			$rs3=$lu->listarDepartamentos();
			$rs2=$ln->listarJuzgados();
			$rs1=$ls->listarMedio();
			$rs5=$lc->listarCorrespondenciaOtro();
			$rs6=$lp->listarCiudadOtro();
		
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_medio']=$rs1;
			$data['datos_departamentos']=$rs3;
			$data['datos_correspondencia']=$rs5;
			$data['datos_ciudad']=$rs6;

						

			if($_POST)

			{

			 $lu->modificarCorrespondencia_Otro();

			}

			

			$this->view->show("correspondencia_modificarOtro.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Excel -------------------*/

	public function excel_472()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
			
			$rs1=$ln->listarJuzgados();
			
			
			$data['datos_juzgados']=$rs1;
			

			if($_POST)

			{

			require 'models/excelModel.php';
			}

			

			$this->view->show("correspondencia_generar472.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Registrar Turno -------------------*/

	public function regTurno()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$lt = new correspondenciaModel();
			$lr = new correspondenciaModel();			
			$ln = new archivoModel();
			
			
			$rs1=$lr->listarEmpleadosTodos();
			$rs2=$ln->listarJuzgados();
			$rs3=$lt->listarProcesosPersonal();
			
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_empleados']=$rs1;
			$data['datos_procesos']=$rs3;
	
						

			if($_POST)

			{

			$lu->registrarTurno();

			}

			

			$this->view->show("correspondencia_registrarTurno.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*---------------------- Listar todas los turnos -------------------*/

	public function listarTurnos()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        $rs1 = $ls->listarTurnos();

		$data['datos_turnos'] = $rs1;

		

		$this->view->show("index_listar_turno.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
/*------------- Informe Dirección Word -------------------*/

	public function informeDireccion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
	
			

			if($_POST)

			{

			require 'models/wordModel.php';
		   }

			

		$this->view->show("correspondencia_reporte_direccion_rango.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	

/*------------- Reportte Notificaión Incidentes -------------------*/

	public function ReporteNotificacionIncidentes()

	{

	  if($_SESSION['id']!=""){

	  require 'models/archivoModel.php';		

			$ln = new archivoModel();
			
			
			$rs1=$ln->listarJuzgados();
			
			
			$data['datos_juzgados']=$rs1;
			
	      if($_POST)

			{

			require 'models/excelModel.php';
			
			}

			

			$this->view->show("correspondencia_reporte_tutelasIncidentes.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*---------------------- Listar todas las actuaciones -------------------*/

	public function listarActuaciones()

	{

	  if($_SESSION['id']!=""){

	  

	/*	require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();

        $rs1 = $ls->listarActuaciones();
		$data['datos_actuaciones'] = $rs1;*/
		$this->view->show("index_listar_actuacion.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*---------------------- Modificar Actuación -------------------*/

	public function editarActuaciones()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

		$ls = new correspondenciaModel();
		$ld = new correspondenciaModel();
		$lc = new correspondenciaModel();
		$lm = new correspondenciaModel();	
		$la = new correspondenciaModel();	
		$lu = new correspondenciaModel();
		$lp = new correspondenciaModel();			

        $rs1 = $ls->listarActuacion_Especifica();
		$rs2 = $ld->listarDepartamentos();
		$rs3 = $lc->listarCiudad();
		$rs4 = $lm->listarMedio();
		$rs5 = $la->listarActuacion();
		
		
		
		

		$data['datos_actuacion'] = $rs1;
		$data['datos_departamentos'] = $rs2;
		$data['datos_ciudades'] = $rs3;
		$data['datos_medio'] = $rs4;
		$data['datos_actuaciones'] = $rs5;
		
		
		if($_POST)

			{

			$lu->modificarActuación();
		   }

		

		$this->view->show("correspondencia_modificar_actuacion.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


	 /*------------- Eliminar Actuación -------------------------*/

	public function elim_actuacion()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';

		

			$ls = new correspondenciaModel();

			$ls->eliminarActuacion();	

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }

	    	

	}
	

/*---------------------- Modificar Datos Tutela -------------------*/

	public function edit_datosTutela()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		require 'models/archivoModel.php';



			$lu = new correspondenciaModel();
			$lr = new correspondenciaModel();		
			$lt = new correspondenciaModel();
			$lra = new correspondenciaModel();						
			$ln = new archivoModel();
			
			
			$rs1=$lr->listarRadicadosTutelasExistentesModificar();
			$rs3=$lt->listarTutelasEditar();
			$rs2=$ln->listarJuzgados();
			$rs4=$lra->listarDatosRadicado();
			
			
			
			$data['datos_juzgados']=$rs2;
			$data['datos_radicados']=$rs1;
			$data['datos_tutela']=$rs3;
			$data['datos_radica']=$rs4;
		
		if($_POST)

			{

			$lu->modificarTutela_basico();
		   }

		

		$this->view->show("correspondencia_editarDatosTutela.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

			
/*------------- Filtro de Actuaciones -------------------*/

	public function filtrar_actuaciones()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
			

		$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
/*------------- Filtro de Actuaciones1 -------------------*/

	public function filtrar_actuaciones1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_actuacion();
			$data['datos_actuaciones']=$rs1;
			$this->view->show("correspondencia_filtrar_actuacion.php", $data);


	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}


/*------------- Filtro de Radicados -------------------*/

	public function filtrar_radicados()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
		
		
			
			$rs2= $lj->listarJuzgado();
		
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_radicados.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Filtro de Radicados 1 -------------------*/

	public function filtrar_radicados1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		 $lj = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_radicado();
			$rs2= $lj->listarJuzgado();
			$data['datos_radicados']=$rs1;
			$data['datos_juzgados']=$rs2;
			$this->view->show("correspondencia_filtrar_radicados.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Filtro de Otros -------------------*/

	public function filtrar_otros()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $lm->listarMedio();
			$rs2= $lj->listarJuzgado();
		
			$data['datos_medios']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_otros.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Filtro de Otros 1 -------------------*/

	public function filtrar_otros1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $ln = new correspondenciaModel();
		 $lj = new correspondenciaModel();
		 $lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultar_filtro_otro();
			$rs2= $lj->listarJuzgado();
			$rs3= $lm->listarMedio();
	
		
			$data['datos_medios']=$rs3;
			$data['datos_otros']=$rs1;
			$data['datos_juzgados']=$rs2;
			$this->view->show("correspondencia_filtrar_otros.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	
	/*------------- Filtro de Turnos -------------------*/

	public function filtrar_turnos()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->listarAreasEmpleados();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			$data['datos_areas']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_filtrar_turnos.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Filtro de Turnos 1 -------------------*/

	public function filtrar_turnos1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->listarAreasEmpleados();
			$rs2= $lj->listarJuzgado();
			$rs3= $lm->consultar_filtro_turno();
			
			
			
		
			$data['datos_areas']=$rs1;
			$data['datos_juzgados']=$rs2;
			$data['datos_turnos']=$rs3;
			
			$this->view->show("correspondencia_filtrar_turnos.php", $data);
			 
		    

			

		//$this->view->show("correspondencia_filtrar_actuacion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
/*------------- Filtro de Turnos -------------------*/

	public function migracion()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultarsaidoj();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			$data['datos_saidoj']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_migracion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
/*------------- Filtro de Turnos -------------------*/

	public function migracion1()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

			$ln = new correspondenciaModel();
	 		$lj = new correspondenciaModel();
			$lm = new correspondenciaModel();
		
		
			$rs1= $ln->consultarsaidoj();
			$rs2= $lj->listarJuzgado();
			
			
			
		
			//$data['datos_saidoj']=$rs1;
			$data['datos_juzgados']=$rs2;
			

		$this->view->show("correspondencia_migracion.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	
/*------------- Filtro de Partes -------------------*/

	public function filtrar_partes()

	{

	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';
	
	  $lj = new correspondenciaModel();
	  
	  
	  $rs2= $lj->listarJuzgado();
	 
	  $data['datos_juzgados']=$rs2;		

			

		$this->view->show("correspondencia_filtrar_partes.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
/*------------- Filtro de Partes1 -------------------*/

	public function filtrar_partes1()

	{



	  if($_SESSION['id']!=""){

	  require 'models/correspondenciaModel.php';		

		 $lj = new correspondenciaModel();
	  	 $ln = new correspondenciaModel();
		 
		 $rs2= $lj->listarJuzgado();
		 $rs1= $ln->consultar_filtro_partes();
		 
		 $data['datos_partes']=$rs1;
		 $data['datos_juzgados']=$rs2;
		
		 $this->view->show("correspondencia_filtrar_partes.php", $data);


	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}

/*------------- Modificar Parte -------------------*/

	public function edit_parte()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/correspondenciaModel.php';
		


			$lu = new correspondenciaModel();
			
			$rs1=$lu->consultar_filtro_parte_especifica();
			
			
			$data['datos_parte']=$rs1;
			
						

			if($_POST)

			{

			 $lu->modificar_parte();

			}

			

			$this->view->show("correspondencia_editarParte.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	public function Generar_Documento_Correspondencia(){
	

		if($_SESSION['id']!=""){
		
			
			//require 'models/correspondenciaModel.php';
			//$ld = new correspondenciaModel();
			
			require 'models/documentoswordModel.php';
		
		}
	  	else{

			header("refresh: 0; URL=/ejecucion/");

	  	}

	}
	
	//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
	
	public function Asignar_Numero_Guia(){
	
		if($_SESSION['id']!=""){
	
			require 'models/correspondenciaModel.php';
			
			$modelo = new correspondenciaModel();
			
			//$modelo->RegistrarADespacho_Masivo();
		
			if($_POST){
	
				
				$modelo->asignar_numero_guia_NG();
	
			}
	
			$this->view->show("simeco_asignar_numeroguia.php", $data);
	
		}
		else{
		  
			header("refresh: 0; URL=/ejecucion/");
		}
	
	}
	
	//-------FIN NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
			

}

?>