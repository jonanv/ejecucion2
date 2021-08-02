<?php
@session_start();//se indica que se van a utilizar sesiones
?>
<?
include("../include/bd.php");
include("../modulos/Cuentas/clases/classEjeCuenta.php");
include("../modulos/Cuentas/clases/classEjeApoyo.php");
$ejecuenta= new ejecuenta();
$ejeapoyo= new ejeapoyo();
$nom=$_SESSION["usuario"];

 if($ejecuenta->buscarEjecuenta($nom)==1)
	{

	$nit=$ejecuenta->obtNITEjecuenta($nom);
	$identificado=1;
	$tipousu="Cuenta";
	}
	else
	{
	$nit=$ejeapoyo->obtNITEjeapoyo($nom);
	$identificado=2;
	$tipousu="Apoyo";
	
	}
	
$imagen="../modulos/Cuentas/vistas/".$nit.".jpg";
?>
<?

$bd= new bd();
//echo("Hola!!!!");
$eventos= $bd ->bd_consultar("select * from eventocalendario");
$clientes= $bd ->bd_consultar("select * from cliente");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.::Registrar Evento::.</title>
<style type="text/css">
<!--
.Estilo6 {
	font-family: Georgia, "Times New Roman", Times, serif;
	font-weight: bold;
}
.Estilo7 {font-family: Georgia, "Times New Roman", Times, serif}
body {
	background-image: url(Dibujo.JPG);
	background-repeat: repeat;
	margin-top: 0px;
}
#Layer1 {
	position:absolute;
	width:200px;
	height:82px;
	z-index:1;
	left: 56px;
	top: 168px;
}
#Layer8 {position:absolute;
	width:200px;
	height:115px;
	z-index:7;
	left: 52px;
	top: 1px;
}
.Estilo11 {color: #6F0000;
	font-size: 13px;
}
#Layer11 {position:absolute;
	width:112px;
	height:20px;
	z-index:10;
	left: 1090px;
	top: 154px;
}
#Layer9 {position:absolute;
	width:71px;
	height:88px;
	z-index:8;
	left: 1112px;
	top: 69px;
}
.Estilo9 {font-family: Georgia, "Times New Roman", Times, serif;
	color: #800000;
	font-weight: bold;
}
#Layer12 {position:absolute;
	width:135px;
	height:26px;
	z-index:10;
	left: 947px;
	top: 72px;
	font-size: 9px;
}
.Estilo8 {font-family: Georgia, "Times New Roman", Times, serif;
	color: #FFFFFF;
}
.Estilo10 {color: #FFFFFF}
#Layer10 {position:absolute;
	width:101px;
	height:19px;
	z-index:9;
	left: 1064px;
	top: 20px;
}
#form1 table {
	background-image: url(fondoprin.jpg);
}
-->
</style>
<script language="javascript" type="text/javascript" src="datetimepicker.js">
</script>
<script src="evento.js"></script>
</head>

<body>
<form id="form1" name="form1" method="post" action="../modulos/Cuentas/acciones/registrarEvento.php">
  <table width="1119" border="0" align="center" background="../HIRENDERCRM/modulos/Cuentas/vistas/fondoprin.jpg">
  <tr>
    <td height="44" colspan="3"><div align="center" class="Estilo6">Registro de Evento en el Calendario </div></td>
  </tr>
  <tr>
    <td width="330" height="42">&nbsp;</td>
    <td width="251"><span class="Estilo6">Nombre:</span></td>
    <td width="524"><span class="Estilo6">
          <div class="rojo" id="errornombre"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div>
	  <select name="selectNombre" class="Estilo7" id="selectNombre" onchange="tipoevento()" >
        <option  value="" >Seleccione el Evento</option>
        <?php
						while($eve = mysql_fetch_array($eventos))
						{ 
					?>
        <option  value="<?php echo($eve["Evento"]);?>"> <?php echo($eve["Evento"]);?> </option>
        <?php 
						}							
					?>
      </select>    </td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><span class="Estilo7"><strong>Cliente:</strong></span></td>
    <td><span class="Estilo7">
     <span class="Estilo6">
	  <div class="rojo" id="errorcliente"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div></span>
	  <select name="selectCliente" id="selectCliente" >
        <option  value="" >Seleccione el Cliente</option>
        <?php
						while($cli = mysql_fetch_array($clientes))
						{
					?>
        <option  value="<?php echo($cli["idCliente"]);?>"> <?php echo($cli["Nombre"]);?> </option>
        <?php 
						}							
					?>
      </select>
    </span></td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><span class="Estilo7"><strong>Asistentes:</strong></span></td>
    <td><span class="Estilo6">
	  <div class="rojo" id="errorasistentes"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div></span>
	
	<textarea name="asistentes" cols="45" rows="3" disabled="disabled" id="asistentes"></textarea></td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><span class="Estilo6">Lugar:</span></td>
    <td>
	<span class="Estilo6">
	  <div class="rojo" id="errorlugar"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div></span>
	<input name="lugar" type="text" id="lugar" disabled="true" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo6">Descripci&oacute;n:</span></td>
    <td>
	<span class="Estilo6">
	  <div class="rojo" id="errordescripcion"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div></span>
	<textarea name="textfielddescripcion" cols="45" rows="5" id="textfielddescripcion"></textarea></td>
  </tr>
  <tr>
    <td height="39">&nbsp;</td>
    <td><span class="Estilo7"><strong>Hora Inicio: </strong></span></td>
    <td><span class="Estilo7"><strong>
      <select name="starttime" id="time1">
        <option value="00:00:25">Todo el dia</option>
        <option value="00:00:00">12:00 am</option>
        <option value="00:15:00">12:15 am</option>
        <option value="00:30:00">12:30 am</option>
        <option value="00:45:00" selected="selected">12:45 am</option>
        <option value="01:00:00"> 1:00 am</option>
        <option value="01:15:00"> 1:15 am</option>
        <option value="01:30:00"> 1:30 am</option>
        <option value="01:45:00"> 1:45 am</option>
        <option value="02:00:00"> 2:00 am</option>
        <option value="02:15:00"> 2:15 am</option>
        <option value="02:30:00"> 2:30 am</option>
        <option value="02:45:00"> 2:45 am</option>
        <option value="03:00:00"> 3:00 am</option>
        <option value="03:15:00"> 3:15 am</option>
        <option value="03:30:00"> 3:30 am</option>
        <option value="03:45:00"> 3:45 am</option>
        <option value="04:00:00"> 4:00 am</option>
        <option value="04:15:00"> 4:15 am</option>
        <option value="04:30:00"> 4:30 am</option>
        <option value="04:45:00"> 4:45 am</option>
        <option value="05:00:00"> 5:00 am</option>
        <option value="05:15:00"> 5:15 am</option>
        <option value="05:30:00"> 5:30 am</option>
        <option value="05:45:00"> 5:45 am</option>
        <option value="06:00:00"> 6:00 am</option>
        <option value="06:15:00"> 6:15 am</option>
        <option value="06:30:00"> 6:30 am</option>
        <option value="06:45:00"> 6:45 am</option>
        <option value="07:00:00"> 7:00 am</option>
        <option value="07:15:00"> 7:15 am</option>
        <option value="07:30:00"> 7:30 am</option>
        <option value="07:45:00"> 7:45 am</option>
        <option value="08:00:00"> 8:00 am</option>
        <option value="08:15:00"> 8:15 am</option>
        <option value="08:30:00"> 8:30 am</option>
        <option value="08:45:00"> 8:45 am</option>
        <option value="09:00:00"> 9:00 am</option>
        <option value="09:15:00"> 9:15 am</option>
        <option value="09:30:00"> 9:30 am</option>
        <option value="09:45:00"> 9:45 am</option>
        <option value="10:00:00">10:00 am</option>
        <option value="10:15:00">10:15 am</option>
        <option value="10:30:00">10:30 am</option>
        <option value="10:45:00">10:45 am</option>
        <option value="11:00:00">11:00 am</option>
        <option value="11:15:00">11:15 am</option>
        <option value="11:30:00">11:30 am</option>
        <option value="11:45:00">11:45 am</option>
        <option value="12:00:00">12:00 pm</option>
        <option value="12:15:00">12:15 pm</option>
        <option value="12:30:00">12:30 pm</option>
        <option value="12:45:00">12:45 pm</option>
        <option value="13:00:00"> 1:00 pm</option>
        <option value="13:15:00"> 1:15 pm</option>
        <option value="13:30:00"> 1:30 pm</option>
        <option value="13:45:00"> 1:45 pm</option>
        <option value="14:00:00"> 2:00 pm</option>
        <option value="14:15:00"> 2:15 pm</option>
        <option value="14:30:00"> 2:30 pm</option>
        <option value="14:45:00"> 2:45 pm</option>
        <option value="15:00:00"> 3:00 pm</option>
        <option value="15:15:00"> 3:15 pm</option>
        <option value="15:30:00"> 3:30 pm</option>
        <option value="15:45:00"> 3:45 pm</option>
        <option value="16:00:00"> 4:00 pm</option>
        <option value="16:15:00"> 4:15 pm</option>
        <option value="16:30:00"> 4:30 pm</option>
        <option value="16:45:00"> 4:45 pm</option>
        <option value="17:00:00"> 5:00 pm</option>
        <option value="17:15:00"> 5:15 pm</option>
        <option value="17:30:00"> 5:30 pm</option>
        <option value="17:45:00"> 5:45 pm</option>
        <option value="18:00:00"> 6:00 pm</option>
        <option value="18:15:00"> 6:15 pm</option>
        <option value="18:30:00"> 6:30 pm</option>
        <option value="18:45:00"> 6:45 pm</option>
        <option value="19:00:00"> 7:00 pm</option>
        <option value="19:15:00"> 7:15 pm</option>
        <option value="19:30:00"> 7:30 pm</option>
        <option value="19:45:00"> 7:45 pm</option>
        <option value="20:00:00"> 8:00 pm</option>
        <option value="20:15:00"> 8:15 pm</option>
        <option value="20:30:00"> 8:30 pm</option>
        <option value="20:45:00"> 8:45 pm</option>
        <option value="21:00:00"> 9:00 pm</option>
        <option value="21:15:00"> 9:15 pm</option>
        <option value="21:30:00"> 9:30 pm</option>
        <option value="21:45:00"> 9:45 pm</option>
        <option value="22:00:00">10:00 pm</option>
        <option value="22:15:00">10:15 pm</option>
        <option value="22:30:00">10:30 pm</option>
        <option value="22:45:00">10:45 pm</option>
        <option value="23:00:00">11:00 pm</option>
        <option value="23:15:00">11:15 pm</option>
        <option value="23:30:00">11:30 pm</option>
        <option value="23:45:00">11:45 pm</option>
      </select>
    </strong> </span></td>
  </tr>
  <tr>
    <td height="44">&nbsp;</td>
    <td><span class="Estilo7"><strong>Hora Fin: </strong></span></td>
    <td><span class="caladmin Estilo7" style="width: 76%"><strong>
      <select name="endtime" id="time2">
        <option value="00:15:00">12:15 am</option>
        <option value="00:30:00">12:30 am</option>
        <option value="00:45:00">12:45 am</option>
        <option value="01:00:00"> 1:00 am</option>
        <option value="01:15:00"> 1:15 am</option>
        <option value="01:30:00"> 1:30 am</option>
        <option value="01:45:00"> 1:45 am</option>
        <option value="02:00:00"> 2:00 am</option>
        <option value="02:15:00"> 2:15 am</option>
        <option value="02:30:00"> 2:30 am</option>
        <option value="02:45:00"> 2:45 am</option>
        <option value="03:00:00"> 3:00 am</option>
        <option value="03:15:00"> 3:15 am</option>
        <option value="03:30:00"> 3:30 am</option>
        <option value="03:45:00"> 3:45 am</option>
        <option value="04:00:00"> 4:00 am</option>
        <option value="04:15:00"> 4:15 am</option>
        <option value="04:30:00"> 4:30 am</option>
        <option value="04:45:00"> 4:45 am</option>
        <option value="05:00:00"> 5:00 am</option>
        <option value="05:15:00"> 5:15 am</option>
        <option value="05:30:00"> 5:30 am</option>
        <option value="05:45:00"> 5:45 am</option>
        <option value="06:00:00"> 6:00 am</option>
        <option value="06:15:00"> 6:15 am</option>
        <option value="06:30:00"> 6:30 am</option>
        <option value="06:45:00"> 6:45 am</option>
        <option value="07:00:00"> 7:00 am</option>
        <option value="07:15:00"> 7:15 am</option>
        <option value="07:30:00"> 7:30 am</option>
        <option value="07:45:00"> 7:45 am</option>
        <option value="08:00:00"> 8:00 am</option>
        <option value="08:15:00"> 8:15 am</option>
        <option value="08:30:00"> 8:30 am</option>
        <option value="08:45:00"> 8:45 am</option>
        <option value="09:00:00"> 9:00 am</option>
        <option value="09:15:00"> 9:15 am</option>
        <option value="09:30:00"> 9:30 am</option>
        <option value="09:45:00"> 9:45 am</option>
        <option value="10:00:00">10:00 am</option>
        <option value="10:15:00">10:15 am</option>
        <option value="10:30:00">10:30 am</option>
        <option value="10:45:00">10:45 am</option>
        <option value="11:00:00">11:00 am</option>
        <option value="11:15:00">11:15 am</option>
        <option value="11:30:00">11:30 am</option>
        <option value="11:45:00">11:45 am</option>
        <option value="12:00:00">12:00 pm</option>
        <option value="12:15:00">12:15 pm</option>
        <option value="12:30:00">12:30 pm</option>
        <option value="12:45:00">12:45 pm</option>
        <option value="13:00:00" selected="selected"> 1:00 pm</option>
        <option value="13:15:00"> 1:15 pm</option>
        <option value="13:30:00"> 1:30 pm</option>
        <option value="13:45:00"> 1:45 pm</option>
        <option value="14:00:00"> 2:00 pm</option>
        <option value="14:15:00"> 2:15 pm</option>
        <option value="14:30:00"> 2:30 pm</option>
        <option value="14:45:00"> 2:45 pm</option>
        <option value="15:00:00"> 3:00 pm</option>
        <option value="15:15:00"> 3:15 pm</option>
        <option value="15:30:00"> 3:30 pm</option>
        <option value="15:45:00"> 3:45 pm</option>
        <option value="16:00:00"> 4:00 pm</option>
        <option value="16:15:00"> 4:15 pm</option>
        <option value="16:30:00"> 4:30 pm</option>
        <option value="16:45:00"> 4:45 pm</option>
        <option value="17:00:00"> 5:00 pm</option>
        <option value="17:15:00"> 5:15 pm</option>
        <option value="17:30:00"> 5:30 pm</option>
        <option value="17:45:00"> 5:45 pm</option>
        <option value="18:00:00"> 6:00 pm</option>
        <option value="18:15:00"> 6:15 pm</option>
        <option value="18:30:00"> 6:30 pm</option>
        <option value="18:45:00"> 6:45 pm</option>
        <option value="19:00:00"> 7:00 pm</option>
        <option value="19:15:00"> 7:15 pm</option>
        <option value="19:30:00"> 7:30 pm</option>
        <option value="19:45:00"> 7:45 pm</option>
        <option value="20:00:00"> 8:00 pm</option>
        <option value="20:15:00"> 8:15 pm</option>
        <option value="20:30:00"> 8:30 pm</option>
        <option value="20:45:00"> 8:45 pm</option>
        <option value="21:00:00"> 9:00 pm</option>
        <option value="21:15:00"> 9:15 pm</option>
        <option value="21:30:00"> 9:30 pm</option>
        <option value="21:45:00"> 9:45 pm</option>
        <option value="22:00:00">10:00 pm</option>
        <option value="22:15:00">10:15 pm</option>
        <option value="22:30:00">10:30 pm</option>
        <option value="22:45:00">10:45 pm</option>
        <option value="23:00:00">11:00 pm</option>
        <option value="23:15:00">11:15 pm</option>
        <option value="23:30:00">11:30 pm</option>
        <option value="23:45:00">11:45 pm</option>
        <option value="00:00:00">12:00 am</option>
      </select>
    </strong></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo7"><strong>Fecha:</strong></span></td>
    <td><span class="Estilo6">
	  <div class="rojo" id="errorfecha"> </div>
          <div align="left" class="Estilo2">
                <style>
				  .rojo{color:#800000}
				  </style>
	  </div></span>
	
	<input name="fecha" type="text" id="demo1" size="25" maxlength="25" />
      <a href="javascript:NewCal('demo1','ddmmmyyyy',true,24)"><img src="cal.gif" width="16" height="16" border="0" alt="Pick a date" /></a></td>
  </tr>
  <tr>
    <td height="66" colspan="3"><p align="center" class="Estilo7"><strong>
      <input type="button" name="Submit" value="Registrar Evento" onclick="validarEvento()"  />
    </strong></p></td>
  </tr>
  <tr>
    <td height="66" colspan="3"><p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</body>
</html>
