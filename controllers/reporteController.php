<?php
class reporteController extends controllerBase
{
		
	
	
	/*------------- Mostrar Proyecto especifico Cliente-------------------*/
	public function Rep_clientesReg()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require('views/pdf/fpdf.php');
		require 'models/pdfModel.php';
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	public function oportunidades()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		$ls = new reporteModel();
		$rs1 = $ls->listarOportunidades();
		$data['datos_oportunidades'] = $rs1;
		$this->view->show("reporte_oportunidades.php", $data);
      }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	public function Rep_oportunidades()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require('views/pdf/fpdf.php');
		require 'models/pdfModel.php';
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//reporte diagrma pie de ventas de los ejecutivos de cuenta
	public function Rep_Pie_V_Ejecutivo()
	{
	  if($_SESSION['id']!=""){
	  
	  	  
		require 'models/reporteModel.php';
		require 'models/pieModel.php';

		$this->view->show("reporte_ventaejecutivo.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//Reporte de ventas donde se escoje el rango de fechas
	public function Rep_Ventas_fifff()
	{
	  if($_SESSION['id']!=""){
	 
	    require 'models/reporteModel.php';
		$this->view->show("reporte_ventas.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//funcion que genera el reporte de ventas deacuerdo a un rango
	public function Rep_Ventas_fiff()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$rs1 = $ls->listarProyectosVentas();
		$data['datos_proyectos'] = $rs1;
		$rs2 = $ls->fecha1();
		$data['fecha1'] = $rs2;
		$rs3 = $ls->fecha2();
		$data['fecha2'] = $rs3;
		$this->view->show("reporte_ventasfiff.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }		
	}
	
	//Reporte de ventas donde se escoje el rango de fechas y el area de produccion
	public function Rep_Ventas_area()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$rs1 = $ls->listarTipos();
		$data['datos_tipos'] = $rs1;
		$this->view->show("reporte_area.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}	
	
	public function Rep_Ventas_areaa()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$rs1 = $ls->listarProyectosArea();
		$data['datos_proyectos'] = $rs1;
		$rs2 = $ls->fecha1();
		$data['fecha1'] = $rs2;
		$rs3 = $ls->fecha2();
		$data['fecha2'] = $rs3;
	
		$this->view->show("reporte_areaa.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//funcion para el reporte de ventas por ejecutivo $valor	
	public function Rep_Ventas_ejeb()
	{
	  if($_SESSION['id']!=""){
	  
	  
	    require 'models/reporteModel.php';
		require 'models/barrasModel.php';
		
		$ls = new barrasModel();
		$rs1 = $ls->prueba();	
		$this->view->show("reporte_ventaejecutivob.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	
	}
	//reporte diagrma pie estado de los proyectos
	public function Rep_Pie_P_Estado()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require 'models/pieModel.php';

		$this->view->show("reporte_estadoproyectos.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }		
	}
	
	//Reporte Diagrma pie de proyectos por tipo
	public function Rep_Pie_P_Tipo()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require 'models/pieModel.php';

		$this->view->show("reporte_tipoproyectos.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//Reporte de Proyectos por ano diagrama de barras
	public function Rep_P_ano()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$this->view->show("reporte_p_ano.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//Reporte Diagrma barras de proyectos por ano
	public function Rep_barra_P_Ano()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
	    require 'models/barrasModel.php';
			
		$this->view->show("reporte_proyectoano.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}	
	
	//Reporte Diagrma barras de tarjetas por ano
	public function Rep_barra_T_Ano()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
	    require 'models/barrasModel.php';
			
		$this->view->show("reporte_tarjetaano1.php");
      }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}	
	
	//Reporte Diagrma barras de tarjetas por ano y tipo
	public function Rep_barra_T_Tipo()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
	    require 'models/barrasModel.php';
			
		$this->view->show("reporte_tarjetatipo1.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }		
	}	
	
	//Reporte Diagrama Pie de los Proyectos atrazados Vs Dia
	public function Rep_Pie_P_AtrDia()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require 'models/pieModel.php';

		$this->view->show("reporte_proyectosatrazados.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }		
	}
	
	//Reporte Diagrama de barras de los tipos de proyectos respecto a un ano
	public function Rep_Tipo_ano()
	{
	  if($_SESSION['id']!=""){
	  
		  require 'models/reporteModel.php';
		  $this->view->show("reporte_ptipo_ano.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//Reporte Diagrama de barras de proyectos por tipos en un ano determinado
	public function  Rep_Tipo_anoo()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
	    require 'models/barraModel.php';
			
		$this->view->show("reporte_proyectotipoano.php");
      }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}	
	
	//Reporte Diagrama de barras de los tipos de proyectos respecto a un ano ya un ejecutivo de cuenta
	public function Rep_Tipo_anoEje()
	{
	  if($_SESSION['id']!=""){
		  require 'models/reporteModel.php';
		  $ls = new reporteModel();
		  $rs1 = $ls->listarEjeCuentas();
		  $data['datos_ejecuentas']=$rs1;
		  
		  $this->view->show("reporte_ptipo_anoeje.php",$data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//Reporte Diagrama de barras de los tipos de proyectos respecto a un ano ya un ejecutivo de cuenta
	public function  Rep_Tipo_anoEjee()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
	    require 'models/barraModel.php';
			
		$this->view->show("reporte_proyectotipoanoeje.php");
      }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	
	}	
	
	//funcion para el reporte de ventas por cliente $valor	
	public function Rep_Ventas_clieb()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		require 'models/barrasModel.php';
			
		$this->view->show("reporte_ventaclienteb.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//funcion para el reporte de ventas por cliente #cantidad	
	public function Rep_Ventas_cliecantb()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		require 'models/barrasModel.php';
			
		$this->view->show("reporte_ventaclientecantb.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//reporte de actividades
	public function rep_actividades()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/actividadModel.php';
		
		$ls = new actividadModel();
		$rs1 = $ls->listarActividades();
		$rs2 = $ls->listarTipoActividad();
		$data['datos_actividades'] = $rs1;
		$data['actividad_tipo'] = $rs2;
		
		$this->view->show("reporte_actividades.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//Genera el PDF de las actividades registradas en la bd
	public function Rep_actividadespdf()
	{
	  if($_SESSION['id']!=""){
	  
		require 'models/reporteModel.php';
		require('views/pdf/fpdf.php');
		require 'models/pdfModel.php';
		
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }
	}
	
	//Reporte de Tarjetas super cliente por ano
	public function Rep_tarjetaano()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$this->view->show("reporte_tarjetaano.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	//Reporte de Tarjetas super cliente por ano y tipo
	public function Rep_tarjetatipo()
	{
	  if($_SESSION['id']!=""){
	  
	    require 'models/reporteModel.php';
		$ls = new reporteModel();
		$this->view->show("reporte_tarjetatipo.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }		
	}
	
	/*------------- reporte clientes excel -----------------------------*/
	public function reporteClientesE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarClientes();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaclientesE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		

	}
	
	/*------------- reporte ventas rango de fechas -----------------------------*/
	public function reporteVentasFecha1()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$this->view->show("reporte_listaventas1.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		

	}
	
	/*------------- reporte ventas rango de fechas -----------------------------*/
	public function reporteVentasFecha2()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarVentasFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaventas2.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		

	}
	
	/*------------- reporte ventas excel -----------------------------*/
	public function reporteVentasFechaE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarVentasFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaventasE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte clientes inscriptos por fecha ------------------*/
	public function reporteClientesFecha1()
	{
	  if($_SESSION['id']!=""){
	 
	    require 'models/reporteModel.php';
		$this->view->show("reporte_clientesfecha1.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	/*------------- reporte clientes rango de fechas -----------------------------*/
	public function reporteClientesFecha2()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarClientesFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaclientes2.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte clientes fecha excel -----------------------------*/
	public function reporteClientesFechaE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarClientesFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaclientesE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos en produccion por fecha ------------------*/
	public function reporteProdFecha1()
	{
	  if($_SESSION['id']!=""){
	 
	    require 'models/reporteModel.php';
		$this->view->show("reporte_prodfecha1.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	/*------------- reporte proyectos en produccion por fecha -----------------------------*/
	public function reporteProdFecha2()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarProduccionFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_prodfecha2.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos en produccion por fecha excel -----------------------------*/
	public function reporteProdFechaE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarProduccionFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_prodfechaE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos terminados por fecha ------------------*/
	public function reporteTermFecha1()
	{
	  if($_SESSION['id']!=""){
	 
	    require 'models/reporteModel.php';
		$this->view->show("reporte_terminadosfecha1.php");
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	/*------------- reporte proyectos terminados por fecha -----------------------------*/
	public function reporteTermFecha2()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarTerminadosFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_terminadosfecha2.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos en produccion por fecha excel -----------------------------*/
	public function reporteTermFechaE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarTerminadosFecha();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_terminadosfechaE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos por cliente ------------------*/
	public function reporteProyCli1()
	{
	  if($_SESSION['id']!=""){
	 
	    require 'models/reporteModel.php';
		$le = new reporteModel();	
		$rs1 = $le->listarClientes();
		$data['datos_clientes']= $rs1;
		$this->view->show("reporte_proycli1.php", $data);
	  }
	  
	  else{
		header("refresh: 0; URL=/crm/");
	  }	
	}
	
	/*------------- reporte proyectos por cliente -----------------------------*/
	public function reporteProyCli2()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarProyCliente();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_proycli2.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
	/*------------- reporte proyectos por cliente excel -----------------------------*/
	public function reporteProyCliE()
	{
		if($_SESSION['id']!=""){
		require 'models/reporteModel.php';
	
			$le = new reporteModel();	
			$rs1 = $le->listarProyCliente();
			$data['reporte']= $rs1;
					
			$this->view->show("reporte_listaventasE.php", $data);
		}
		else {
			header("refresh: 0; URL=/crm/");
		}		
	}
	
}
?>