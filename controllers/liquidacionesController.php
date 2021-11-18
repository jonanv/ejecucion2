<?php

class liquidacionesController extends controllerBase

{



/*---------- Mensajes -------------*/

	

	public function mensajes()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/empleadosModel.php';

		$ls = new empleadosModel();

		$ls->mensajes();

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

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



/*------------- Registrar Liquidaciones -------------------*/

	public function regLiquidacion()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/liquidacionesModel.php';
		require 'models/archivoModel.php';

			$lu = new liquidacionesModel();
			$ld = new archivoModel();
			//$ln = new archivoModel();
		//	$lf = new archivoModel();
			
		//	$rs1=$ld->listarEmpleadosJefe();
			$rs2=$ld->listarJuzgados();
		//	$rs8=$ln->listarJuzgados();
			//$rs4=$lf->listarEstados();
			$rs3=$ld->listarJuzgadosDestino();
			//$rs5=$ln->listarEstadosDetalles();
			
			//$data['datos_empleados']=$rs1;
			$data['datos_juzgados']=$rs2;
			//$data['datos_juzgadoss']=$rs8;
			$data['datos_juzgados_destino']=$rs3;
		//	$data['datos_estados']=$rs4;
			//$data['datos_estadosdetalles']=$rs5;
			

						

			if($_POST)

			{
			 $lu->registrarLiquidaciones();

			}

			

			$this->view->show("liquidacion_registrar_liq.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/centro_servicios/");

	  }



	}

/*---------------------- Listar Liquidaciones -------------------*/

	public function listarLiquidacion()

	{

	  if($_SESSION['id']!=""){

	  

		require 'models/empleadosModel.php';

		

		$ls = new liquidacionesModel();

        $rs1 =$ls->listarIngresoSalida();
		//$rs3=$ls->listarEstados();
		//$rs7=$ls->listarEstadosDetalles();
		$rs8=$ls->listarUsuarios();
		//$rs9=$ls->listarJuzgadosDestino();
		//$rs10=$ls->listarJuzgadosDestino();
	//	$rs8=$ls->listarJuzgadosDestino();
		
		$data['datos_ingresosalida'] = $rs1;
		//$data['datos_estados']=$rs3;	
		//$data['datos_estadosdetalles']=$rs7;	
		$data['datos_usuarios']=$rs8;
		//$data['datos_juzgadodestino']=$rs9;
		//$data['datos_juzgadodestinos']=$rs10;

		
		
		
		//$data['datos_juzgados_destino']=$rs8;

		$this->view->show("empleados_filtrar_ingreso.php", $data);

      }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	
	public function listarIngresoSalida1()

	{

	  if($_SESSION['id']!=""){

		require 'models/empleadosModel.php';
		
		$lu = new empleadosModel();
		
		$rs1=$lu->FiltroIngresoSalida();
		//$rs3=$lu->listarEstados();
		//$rs7=$lu->listarEstadosDetalles();
		$rs8=$lu->listarUsuarios();
		//$rs9=$lu->listarJuzgadosDestino();
		//$rs10=$lu->listarJuzgadosDestino();
		//$rs3=$lu->listarUsuarios();
		//$rs4=$lu->listarUsuarios();
			
		$data['datos_ingresosalida']=$rs1;
		//$data['datos_estados']=$rs3;	
		//$data['datos_estadosdetalles']=$rs7;
		$data['datos_usuarios']=$rs8;
	//	$data['datos_juzgadodestino']=$rs9;
		//$data['datos_juzgadodestinos']=$rs10;	
	//	$data['datos_usuarios']=$rs4;
//		$data['datos_usuariosr']=$rs3;
		
		
		
	

			if($_POST)

			{

			 //$lu->registrarDocumento();

			}

			

			$this->view->show("empleados_filtrar_ingreso.php", $data);

	  }

	  

	  else{

		header("refresh: 0; URL=/ejecucion/");

	  }



	}
	

}

?>