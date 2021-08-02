<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
	$(".topMenuAction").click( function() {
		if ($("#openCloseIdentifier").is(":hidden")) {
			$("#sliderm").animate({ 
				marginTop: "-238px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#sliderm").animate({ 
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
			$("#openCloseIdentifier").hide();
		}
	});  
		
	$("#sliderop").easySlider({});	
	
	$("#frm").validate();
	
	var validator = $("#frm").validate({
		meta: "validate"
	});

	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});	
		
});
</script>
<script>
function remitente(form1,tip)
{
if(tip==3){
x=form1.selectEjecutivoa.value;}
if(tip==2){
x=form1.selectCliente.value;}
if(tip==1){
x=form1.selectEjecutivo.value;}
if(form1.contacto.value=="")
{
 form1.contacto.value=x;
}
else
form1.contacto.value=form1.contacto.value+","+x;
}
</script>	
</head>
<body>
<!---->
<?php require 'header.php';/*if($_SESSION['rol']=='Administrador'){require 'header.php';}else{require 'headerproduccion.php';}*/  ?>
<!---->
<?php require 'secc_configuracion.php'; ?>
<!---->
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<div id="titulo_frm">Enviar Correo</div>
<form id="frm" name="frm" method="post" action="">
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <tr>
    <td width="67" rowspan="3">Para:</td>
    <td width="477" rowspan="3"><input name="contacto" type="text" id="txt_input" value="" />
      <label><br />
      </select>
      </label></td>
    <td width="256"><select name="selectEjecutivo"  id="txt_input" onchange="remitente(frm,1)">
      <option  value="" >Seleccione Empleado</option>
      <?php
						while($ejec = $datos_empleado->fetch())
						{
					?>
      <option  value="<?php echo($ejec[EmailEmpleado]);?>">
      <?php echo $ejec[NombreEmpleado];?>
      </option>
      <?php 
						}							
					?>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><select name="selectCliente" id="txt_input" onchange="remitente(frm,2)">
      <option  value="" >Seleccione el Cliente</option>
      <?php
						while($cli = $datos_cliente->fetch())
						{
					?>
      <option  value="<?php echo($cli[Email]);?>">
      <?php echo $cli[NombreCliente];?>
      </option>
      <?php 
						}							
					?>
    </select></td>
  </tr>
  <tr>
    <td>Asunto:</td>
    <td colspan="2"><input name="asunto" type="text" id="txt_input" value="" /></td>
  </tr>
  <tr>
    <td colspan="3"><textarea name="cuerpo" cols="124" rows="12" id=""></textarea></td>
    </tr>
  <tr>
    <td colspan="3"><div align="center">
      <input type="submit" name="Submit" value="Enviar" id="btn_input">
      <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
    </div></td>
    </tr>
</table>
</form>
</div>		
		</td>
      </tr>
      <tr>
        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>
</body>
</html>