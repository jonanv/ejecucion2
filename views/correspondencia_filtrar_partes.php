<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
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
<script>
function limpiar(frm)
{
frm.radicado.value ="";
frm.tipo_parte.value ="";
frm.juzgado.value ="";
frm.parte.value ="";
}

function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=edit_parte&nombre="+variable;
//document.write(location.href) 

}

function consultar(frm)
{

variable=1;
variable1=frm.radicado.value;
variable2=frm.tipo_parte.value;
variable3=frm.juzgado.value;
variable4=frm.parte.value;

location.href="index.php?controller=correspondencia&action=filtrar_partes1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4;

}
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
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Filtro de Partes Actuaciones</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
      <tr>
      <td width="157">Tipo Parte:</td>
      <td width="346"><select name="tipo_parte" id="sl_input">
      <option value="" selected="selected">Seleccione el tipo de parte</option>
        <option value="Accionante" <?php if ($_GET['nombre2']=='Accionante'){?>selected="selected"<?php }?>>Accionante</option>
        <option value="Accionado" <?php if ($_GET['nombre2']=='Accionado'){?>selected="selected"<?php }?>>Accionado</option>
        <option value="Vinculado" <?php if ($_GET['nombre2']=='Vinculado'){?>selected="selected"<?php }?>>Vinculado</option>
      </select></td>
      <td width="107">Juzgado:</td>
      <td width="148"><select name="juzgado" id="sl_input">
        <option value="">Seleccione un Juzgado </option>
        <?php   while($fieldj = $datos_juzgados->fetch()){  
		
					if($fieldj[id] == 15 || $fieldj[id] == 16){
		?>
        <option value="<?php echo $fieldj[id];?>" <?php if ($_GET['nombre3']==$fieldj[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldj[nombre];?></option>
        <?php }}?>
      </select></td>
      </tr>
      <tr>
        <td>Radicado:</td>
        <td><input type="text" name="radicado" id="txt_input3" value="<?php echo $_GET['nombre1'];?>" /></td>
        <td>Nombre:</td>
        <td><input type="text" name="parte" id="txt_input4" value="<?php echo $_GET['nombre4'];?>"/></td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="opcion" type="hidden" value="" />
    <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)">
      <input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>
<p>
  <?php 
$opcion = $_GET['nombre'];
if($opcion==1){
?>
<br />
<br />
<div id="titulo_frm">
  <p>Lista de Partes</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                         <th>Radicado</th>
						<th>Juzgado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Nombre&nbsp;&nbsp;&nbsp;</th>
    					<th>Tipo</th>
						<th></th>
                    </tr>
                      </thead>
              
                  <tbody>
                    <tr>
                    
<?php                     while($field = $datos_partes->fetch()){  ?>
                      <td><?php echo $field[radicado];?></td>
                      <td><?php echo $field[juzgado];?></td>
                      <td><?php echo $field[accionante_accionado_vinculado];?></td>
                      <td><?php echo $field[esaccionante_accionado_vinculado];?></td>
                      <td style="cursor:pointer"><img src="views/images/edit.png" onclick="vinculo(<?php echo $field[idacc];?>)" title="Editar Actuación" /></td>
                    </tr>
                    
<?php }?>
            </tbody>
  </table>
<?php }?>



</form>
</div>		
		</td>
      </tr>
      <tr>
        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
