<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<script src="views/js/select_dependientes.js" type="text/javascript"></script>
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



</script>


</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Modificar Datos Parte</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
          <tr>
          
          <?php while($row = $datos_parte->fetch()){?>
          
            <td width="163">Nombre:</td>
            <td width="512"><label>
            <input name="parte" type="text" class="required" id="txt_input_grande"  value="<?php echo $row[accionante_accionado_vinculado];?>" />
            </label></td>
          </tr>
          <tr>
            <td>Tipo:</td>
            <td><select name="tipo_parte" id="sl_input" <?php if ($row[esaccionante_accionado_vinculado]=='Accionante'){ ?> disabled="disabled"> <?php }?>/>
           <?php if ($row[esaccionante_accionado_vinculado]=='Accionante'){ ?>  <option value="Accionante" <?php if ($row[esaccionante_accionado_vinculado]=='Accionante'){?>selected="selected"<?php }?>>Accionante</option><?php }?>
             <option value="Accionado" <?php if ($row[esaccionante_accionado_vinculado]=='Accionado'){?>selected="selected"<?php }?>>Accionado</option>
             <option value="Vinculado" <?php if ($row[esaccionante_accionado_vinculado]=='Vinculado'){?>selected="selected"<?php }?>>Vinculado</option>
            </select></td>
          </tr>
          
       <?php }?>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Actualizar" id="btn_input"></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>

</body>
</html>
