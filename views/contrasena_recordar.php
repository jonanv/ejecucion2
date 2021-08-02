<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title><?=titulo ?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.index.js" type="text/javascript"></script>
<link href="views/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="frm" name="frm" action="" method="post">
<div id="logo">
</div>
	  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><label style="margin-left:300px;font-weight: bold; ">RECORDAR CONTRASE&Ntilde;A</label><br /><br /><br /><br /><br />
	  <label for="user">Nombre de Usuario :</label>
      <input name="user" type="text" class="required" id="campotext" size="30">
	  <label for="pass">Correo electr&oacute;nico:</label>
      <input name="correo" type="text" id="campotext" class="required email" size="30">
	  <input name="ingresar" type="submit" id="botonenviar" value="Aceptar">
</form>
<?php require 'alertas.php'; ?>
</body>
</html>