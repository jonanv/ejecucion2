<?php
session_start(); 

if($_SESSION['id']!=""){

	// archivos incluidos. Librerías PHP para poder graficar.
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
	// Gráfico de Barras. 4 Variables, 4 barras.
	// Estas variables serán usadas para representar los valores de cada unas de las 4 barras.
	// Inicializo las variables a utilizar.
	$TITULO_1 = "BALANCE GRAFICO TITULOS MATERIALIZADOS";
	$TITULO_2 = "Oficina de Ejecución Civil Municipal Manizales";
	//$PorcentajeCritica = 100;
	// $strXML: Para concatenar los parámetros finales para el gráfico.
	$strXML = "";
	// Armo los parámetros para el gráfico. Todos estos datos se concatenan en una variable.
	// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
	// caption: define el título del gráfico.
	// bgColor: define el color de fondo que tendrá el gráfico.
	// baseFontSize: Tamaño de la fuente que se usará en el gráfico.
	// showValues: = 1 indica que se mostrarán los valores de cada barra. = 0 No mostrará los valores en el gráfico.
	// xAxisName: define el texto que irá sobre el eje X. Abajo del gráfico. También está xAxisName.
	//$strXML = "<chart caption = 'MUESTRA MENSUAL DE SERVICIOS' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='Datos MMS' >";
	$strXML = "<chart caption = '".$TITULO_1."' subCaption='".$TITULO_2."' bgColor='#CDDEE5' baseFontSize='12' showValues='1' xAxisName='TOTALES' yAxisName='TITULOS' formatNumber='0' formatNumberScale='0'>";
	// Armado de cada barra.
	// set label: asigno el nombre de cada barra.
	// value: asigno el valor para cada barra.
	// color: color que tendrá cada barra. Si no lo defino, tomará colores por defecto.
	$strXML .= "<set label = 'TOTAL TITULOS' value ='".$total_es."' color = 'CDE3F9' />";
	$strXML .= "<set label = 'EN CUSTODIA' value ='".$total_es_0."' color = 'FFBA00' />";
	$strXML .= "<set label = 'NO EN CUSTODIA' value ='".$total_es_2."' color = 'GA1A00' />";
	// Cerramos la etiqueta "chart".
	$strXML .= "</chart>";
	// Por último imprimo el gráfico.
	// renderChartHTML: función que se encuentra en el archivo FusionCharts.php
	// Envía varios parámetros.
	// 1er parámetro: indica la ruta y nombre del archivo "swf" que contiene el gráfico. En este caso Columnas ( barras) 3D
	// 2do parámetro: indica el archivo "xml" a usarse para graficar. En este caso queda vacío "", ya que los parámetros lo pasamos por PHP.
	// 3er parámetro: $strXML, es el archivo parámetro para el gráfico. 
	// 4to parámetro: "ejemplo". Es el identificador del gráfico. Puede ser cualquier nombre.
	// 5to y 6to parámetro: indica ancho y alto que tendrá el gráfico.
	// 7mo parámetro: "false". Trata del "modo debug". No es im,portante en nuestro caso, pero pueden ponerlo a true ara probarlo.
	echo renderChartHTML("Column3D.swf", "",$strXML, "BALANCE GRAFICO TITULOS MATERIALIZADOS", 500, 400, false);
	//echo renderChartHTML("Pie3D.swf", "",$strXML, "MMS", 500, 400, false);
}
else{
	header("refresh: 0; URL=/ejecucion/");
}
?>