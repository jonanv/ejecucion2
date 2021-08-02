<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title><?=titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript"></script>

<script type="text/javascript" src="views/js/select_dependientes_3_niveles.js"></script>
<script type="text/javascript" src="views/js/select_dependientes_31_niveles.js"></script>
                   	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
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
<script type="text/javascript">
function mainmenu(){
$(" #menusec ul ").css({display: "none"});
$(" #menusec li").hover(function(){
	$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
	},function(){
		$(this).find('ul:first').slideUp(400);
	});
}
$(document).ready(function(){
	mainmenu();
});

function vinculo(variable)
{

location.href="index.php?controller=proyecto&action=show_proyecto&nombre="+variable;
//document.write(location.href) 
}
</script>
<style type="text/css">
<!--
body 
{
    margin: 0px;
	background: #158942;
	
}
-->
</style></head>
<body>
<!---->
<!---->
    <table border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<br /><br /><br /><br /><br /><br /><br /><br />
<div id="titulo_frm2">Recordar Contrase&ntilde;a</div>
 <table border="0" cellspacing="0" cellpadding="0" id="frm_editar2">
  <tr>
    <td>Documento del Usuario:</td>
    <td><input name="user" type="text" id="txt_input" class="required" /></td>
  </tr>
  <tr>
</tr>
 
  <tr>
  
    <td>Correo electr&oacute;nico: </td>
    <td><input name="correo" type="text" id="txt_input" class="required email" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	
	<input type="submit" name="Submit" value="Aceptar" id="btn_input" >
      <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
  </tr>
</table>
</form>
</div>		
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
</table>
	    <?php require 'alertas.php';?>

</body>
</html>
