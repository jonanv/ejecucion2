<html>
<head>
<title>REPORTE</title>
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>
</head>
<body>
<h2>REPORTE</h2>
<div id="resultado">
<?php
	$filtro = trim($_GET['filtro']);
	include('consulta.php');
	//echo $cedula;
?>
</div>
</body>
</html>