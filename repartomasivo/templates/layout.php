<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head> 
    <title>REPARTO MASIVO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- incluyo la libreria jQuery -->
    <script type="text/javascript" src="resources/jquery-1.7.1.min.js"></script>
    <!-- incluyo el archivo que tiene mis funciones javascript -->
    <script type="text/javascript" src="resources/functions.js"></script>
    <!-- incluyo el framework css , blueprint. -->
    <link rel="stylesheet" type="text/css" href="resources/screen.css" />
    <!-- incluyo mis estilos css -->
    <link rel="stylesheet" type="text/css" href="resources/style.css" />
	
	<!-- PARA LAS FECHAS TAMBIEN TIENE ENCUENTA LA LIBRERIA   <script type="text/javascript" src="resources/jquery-1.7.1.min.js"></script>-->
	<!-- ESTO APLICA PARA LAS FECHAS DE LA REJILLA, PARA LAS DEL FORMULARIO popupbox SE DEFINE INTERNAMENTE -->
	<script type="text/javascript" src="resources/fecha/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="resources/fecha/jquery.datetimepicker.css"/ >
	
	<!-- para validar formulario-->
	<!-- <script type="text/javascript" src="resources/jquery.validate.js"></script> -->
	
	
	<!-- para que en la rejilla funcione Show  entries, Search:, paginacion -->
	<!-- <script type="text/javascript" language="javascript" src="js/jquery.js"></script>  -->
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script> 
	<link rel="stylesheet" type="text/css" href="js/demo_page.css"/ >
	<link rel="stylesheet" type="text/css" href="js/demo_table.css"/ >
	
	<!-- ASI VENIA EL EJEMPLO DE INTERNET PERO NO ME CANCIONABA EN LA REJILLA LO COMENTE Y AGREGUE LAS DOS LINEAS ANTERIORES -->
	<!-- <style type="text/css" title="currentStyle"> 
		@import "demo_page.css";
		@import "demo_table.css";
	</style>  -->
	
</head>
<body>
    <div id ="block"></div>
    <div class="container">
        <h1 class="title">REPARTO MASIVO</h1>
        <div id="popupbox"></div>
        <div id="content">
            <?php include_once ($view->contentTemplate); // incluyo el template que corresponda ?>
        </div>
    </div>
</body>
</html>
<?php } ?>