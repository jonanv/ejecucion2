<?php
session_start();

if ($_SESSION['id'] != "") {

	// archivos incluidos. Librer�as PHP para poder graficar.
	include "FusionCharts.php";
	include "Functions.php";
	require_once('../libs/Conexion_Funciones.php');

	/*$DATOS = explode("////",trim($_GET['DATOS']));
	
	$codR = $DATOS[0];
	$nomR = $DATOS[1];*/

	//-----------------------DATOS PARA LA CONEXION A LA BASE DE DATOS ------------------------------------
	$conexion = db_connect();
	//------------------------------------------------------------------------------------------------------
	//TODOS TITULOS MATERIALIZADOS
	$sql        = "SELECT * FROM siepro_titulos_encustodia";
	$res        = mysql_query($sql, $conexion) or die(mysql_error());
	$total_es   = mysql_num_rows($res);

	//TODOS TITULOS MATERIALIZADOS EN CUSTODIA
	$sql        = "SELECT * FROM siepro_titulos_encustodia WHERE encustodia = 1";
	$res        = mysql_query($sql, $conexion) or die(mysql_error());
	$total_es_0 = mysql_num_rows($res);


	//TODOS TITULOS MATERIALIZADOS NO EN CUSTODIA
	$sql        = "SELECT * FROM siepro_titulos_encustodia WHERE encustodia = 2";
	$res        = mysql_query($sql, $conexion) or die(mysql_error());
	$total_es_2 = mysql_num_rows($res);


	//----------------------------------------------------------------------
	// Gr�fico de Barras. 4 Variables, 4 barras.
	// Estas variables ser�n usadas para representar los valores de cada unas de las 4 barras.
	// Inicializo las variables a utilizar.
	$TITULO_1 = "BALANCE GRAFICO TITULOS MATERIALIZADOS";
	$TITULO_2 = "Oficina de Ejecuci�n Civil Municipal Manizales";
	//$PorcentajeCritica = 100;
	// $strXML: Para concatenar los par�metros finales para el gr�fico.
	$strXML = "";
	// Armo los par�metros para el gr�fico. Todos estos datos se concatenan en una variable.
	// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
	// caption: define el t�tulo del gr�fico.
	// bgColor: define el color de fondo que tendr� el gr�fico.
	// baseFontSize: Tama�o de la fuente que se usar� en el gr�fico.
	// showValues: = 1 indica que se mostrar�n los valores de cada barra. = 0 No mostrar� los valores en el gr�fico.
	// xAxisName: define el texto que ir� sobre el eje X. Abajo del gr�fico. Tambi�n est� xAxisName.
	//$strXML = "<chart caption = 'MUESTRA MENSUAL DE SERVICIOS' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='Datos MMS' >";
	$strXML = "<chart caption = '" . $TITULO_1 . "' subCaption='" . $TITULO_2 . "' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='TOTALES' yAxisName='TITULOS' formatNumber='0' formatNumberScale='0'>";
	// Armado de cada barra.
	// set label: asigno el nombre de cada barra.
	// value: asigno el valor para cada barra.
	// color: color que tendr� cada barra. Si no lo defino, tomar� colores por defecto.
	$strXML .= "<set label = 'TOTAL TITULOS' value ='" . $total_es . "' color = 'CDE3F9' />";
	$strXML .= "<set label = 'EN CUSTODIA' value ='" . $total_es_0 . "' color = 'FFBA00' />";
	$strXML .= "<set label = 'NO EN CUSTODIA' value ='" . $total_es_2 . "' color = 'GA1A00' />";
	// Cerramos la etiqueta "chart".
	$strXML .= "</chart>";
	// Por �ltimo imprimo el gr�fico.
	// renderChartHTML: funci�n que se encuentra en el archivo FusionCharts.php
	// Env�a varios par�metros.
	// 1er par�metro: indica la ruta y nombre del archivo "swf" que contiene el gr�fico. En este caso Columnas ( barras) 3D
	// 2do par�metro: indica el archivo "xml" a usarse para graficar. En este caso queda vac�o "", ya que los par�metros lo pasamos por PHP.
	// 3er par�metro: $strXML, es el archivo par�metro para el gr�fico. 
	// 4to par�metro: "ejemplo". Es el identificador del gr�fico. Puede ser cualquier nombre.
	// 5to y 6to par�metro: indica ancho y alto que tendr� el gr�fico.
	// 7mo par�metro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
	echo renderChartHTML("Column3D.swf", "", $strXML, "BALANCE GRAFICO TITULOS MATERIALIZADOS", 500, 400, false);
	//echo renderChartHTML("Pie3D.swf", "",$strXML, "MMS", 500, 400, false);
} else {
	header("refresh: 0; URL=/laborales/");
}
