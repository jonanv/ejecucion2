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
<script type="text/javascript" language="javascript">
function validacontrasena(frm)
{
contrasena=frm.Contrasena.value;
contrasena1=frm.Contrasena1.value;
if(contrasena!=contrasena1)
  {
   alert('La contrasea no coincide');
   frm.Contrasena.value="";
   frm.Contrasena1.value="";
  }
}
</script>	
</head>
<body>
<!---->
<?php require 'header.php';?>
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
<div id="titulo_frm">Cambiar Contrase&ntilde;a</div>
<form id="frm" name="frm" method="post" action="">
<?php while($field = $listdata->fetch()){
$id= $field[id];

}
?>

<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <tr>
    <td width="250">Contrase&ntilde;a Vieja:</td><input name="id" type="hidden" value="<?php echo $id; ?>" />
    <td width="550"><input name="clave1" type="password" id="txt_input" value="123456" readonly="" disabled="disabled"></td>
  </tr>
  <tr>
    <td>Contrase&ntilde;a Nueva:</td>
    <td><input name="Contrasena" type="password" id="txt_input" class="required"></td>
  </tr>
  <tr>
    <td>Repita Nueva Contrase&ntilde;a:</td>
    <td><input name="Contrasena1" type="password" id="txt_input" class="required" onchange="validacontrasena(frm)" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Cambiar" id="btn_input">
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