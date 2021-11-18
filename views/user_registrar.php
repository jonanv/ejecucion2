<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

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
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Registrar Usuario</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <tr>
    <td width="250">Empleado:</td>
    <td width="550">
    <input name="empleado" type="text" id="txt_input" class="required"  /></td>
  </tr>
  
  <tr>
    <td>C&eacute;dula:</td>
    <td><label>
      <input type="text" name="cedula" id="txt_input" class="required" value="" />
    </label></td>
  </tr>
  
  <tr>
    <td>Perfil:  </td>
    <td><select name="perfil" id="sl_input" class="required">
      <option value="">Seleccione el perfil del empleado</option>
      <?php   while($field = $datos_perfil->fetch()){  ?>
      <option value="<?php echo $field[id];?>" ><?php echo $field[nombre];?></option>
      <?php }?>
    </select></td>
  </tr>
  <tr>
    <td>Administrador?:</td>
    <td><label>
      <input name="administrador" type="checkbox" id="administrador" value="SI" />
    </label></td>
  </tr>
  <tr>
    <td>Contrase&ntilde;a:</td>
    <td><input name="pass" type="password_usuario" id="txt_input" class="required" /></td>
  </tr>
  <tr>
    <td>Iniciales Reporte:</td>
    <td><input name="iniciales" type="text" id="txt_input" class="required"  /></td>
  </tr>
  <tr>
    <td>Área:</td>
    <td><select name="area" id="sl_input" class="required">
      <option value="">Seleccione el &aacute;rea del empleado</option>
      <?php   while($fieldj = $datos_areas->fetch()){  ?>
      <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre];?></option>
      <?php }?>
    </select></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td><label>
      <select name="estado" id="sl_input" c>
        <option value="1" selected="selected">Activo</option>
        <option value="0">Inactivo</option>
      </select>
    </label></td>
  </tr>  
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Registrar" id="btn_input">
      <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
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
