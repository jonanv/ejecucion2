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
frm.fechai.value='';
frm.fechaf.value='';
frm.solicitud.value='';
frm.radicado.value='';
frm.peticionario.value='';
frm.cedula.value='';
frm.idusuarioresuelve.value='';
frm.idusuarioregistra.value='';
frm.fechair.value='';
frm.fechafr.value='';
frm.resuelto.value='';
frm.consecutivo.value='';

}

function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=show_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=modificarSolicitud&nombre="+variable;
//document.write(location.href) 

}
function exportar(frm)
{
variable=4;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.solicitud.value;
variable4=frm.radicado.value;
variable5=frm.peticionario.value;
variable6=frm.cedula.value;
variable7=frm.idusuarioresuelve.value;
variable8=frm.idusuarioregistra.value;
variable9=frm.fechair.value;
variable10=frm.fechafr.value;
variable11=frm.resuelto.value;
variable12=frm.consecutivo.value;


location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre12="+variable12;
//document.write(location.href) 

}
function consultar(frm)
{

variable=1;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.solicitud.value;
variable4=frm.radicado.value;
variable5=frm.peticionario.value;
variable6=frm.cedula.value;
variable7=frm.idusuarioresuelve.value;
variable8=frm.idusuarioregistra.value;
variable9=frm.fechair.value;
variable10=frm.fechafr.value;
variable11=frm.resuelto.value;
variable12=frm.consecutivo.value;


location.href="index.php?controller=correspondencia&action=listarSolicitudesReg1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre12="+variable12;


}
</script>
<style type="text/css">
<!--
.Estilo2 {color: #000000}
-->
</style>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_solicitudes.php'; ?>
<!---->
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
<div id="contenido1">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Filtro de Solicitudes</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td width="157">Fecha Solicitud Inicial:</td>
      <td width="346"><input name="fechai" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre1'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
      <td width="107">Fecha Solicitud Final:</td>
      <td width="148"><input name="fechaf" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre2'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script></td>
    </tr>
      <tr>
      <td>Solicitud:</td>
      <td><input type="text" name="solicitud" id="txt_input" value="<?php echo $_GET['nombre3'];?>" /></td>
      <td>Radicado Consultar:</td>
      <td><input type="text" name="radicado" id="txt_input" value="<?php echo $_GET['nombre4'];?>" /></td>
      </tr>
      <tr>
        <td>Peticionario:</td>
        <td><input type="text" name="peticionario" id="txt_input" value="<?php echo $_GET['nombre5'];?>" /></td>
        <td>C&eacute;dula:</td>
        <td><input type="text" name="cedula" id="txt_input" value="<?php echo $_GET['nombre6'];?>"/></td>
      </tr>
      <tr>
        <td>Usuario Resuelve:</td>
        <td><select name="idusuarioresuelve" id="sl_input">
          <option value="">Seleccione un usuario</option>
          <?php   while($fieldm = $datos_usuariosr->fetch()){  ?>
          <option value="<?php echo $fieldm[id];?>" <?php if ($_get['nombre7']==$fieldm[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldm[empleado];?></option>
          <?php }?>
        </select></td>
        <td>Usuario Registra:</td>
        <td><select name="idusuarioregistra" id="sl_input">
          <option value="">Seleccione un usuario</option>
          <?php   while($fieldm = $datos_usuarios->fetch()){  ?>
          <option value="<?php echo $fieldm[id];?>" <?php if ($_get['nombre8']==$fieldm[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldm[empleado];?></option>
          <?php }?>
        </select></td>
      </tr>
      <tr>
        <td>Fecha  Inicial Resuelve:</td>
        <td><input name="fechair" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre9'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
        <td>Fecha  Final Resuelve:</td>
        <td><input name="fechafr" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre10'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
      </tr>
      <tr>
        <td>Resuelto:</td>
        <td><label>
        <select name="resuelto" id="sl_input">
          <option value="" <?php if($_GET['nombre11']==''){ ?> selected="selected"<?php }?>>Todos</option>
          <option value="espera"<?php if($_GET['nombre11']=='espera'){ ?> selected="selected"<?php }?>>espera</option>
          <option value="si"<?php if($_GET['nombre11']=='si'){ ?> selected="selected"<?php }?>>si</option>
          <option value="no"<?php if($_GET['nombre11']=='no'){ ?> selected="selected"<?php }?>>no</option>
        </select>
        </label></td>
        <td>Consecutivo:</td>
        <td><input type="text" name="consecutivo" id="txt_input" value="<?php echo $_GET['nombre12'];?>" /></td>
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
if($opcion!=1){
?>
<br />
<br />
<div id="titulo_frm">
  <p>Lista de solicitudes pendientes por resolver</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr>       
    <th width="66">Consecutivo</th> 
    <th width="66">Fecha</th>
	<th width="58">Peticionario </th>
    <th width="83">C&eacute;dula</th>
	<th width="120">Télefono</th>
	<th width="54">Radicado</th>
    <th width="96">Solicitud</th>
	<th width="53">Registr&oacute;</th>
    <th width="96">Resuelta</th>
    <th width="96"></th>
	</tr>
  </thead>
  <tbody>       
                     
                    
<?php while($field = $datos_solicitudes->fetch()){  ?>
<tr>
        <td><?php echo $field[consecutivo];?></td>
        <td><?php echo $field[fecha];?></td>
		<td><?php echo $field[peticionario];?></td>
	    <td><?php echo $field[cedula];?></td>
		<td><?php echo $field[telefono];?></td>
	    <td><?php echo $field[radicado_consultar];?></td>
	    <td><?php echo $field[solicitud];?></td>
        <td><?php echo $field[empleado];?></td>
	    <td><?php echo $field[resolvio];?></td>
	    <td><span style="cursor:pointer"><?php if($_SESSION['tipo_perfil']=='admin'){?><img src="views/images/edit.png" alt="" title="Modificar Solicitud" onclick="vinculo1(<?php echo $field[idsol];?>)" /><?php }?></span></td>
</tr>
                    
<?php }?>
                               
                </thead>
          </table>
          
<?php }?>
  <?php 
$opcion = $_GET['nombre'];
if($opcion==1){
?>
<br />
<br />
<div id="titulo_frm">
  <p>Lista de Solicitudes</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr>
                      <th colspan="3"><span class="Estilo2">cantidad de registros:&nbsp;<?php echo $datos_solicitudes->rowcount();?>
                          <input type="hidden" name="cantidad" id="cantidad" value="<?php  echo $datos_solicitudes->rowcount();?>" />
                      </span></th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th style="cursor:pointer"><img src="views/images/excel.jpg" width="30" height="30" title="Exportar Listado a Excel" onclick="exportar(frm)" /></th>
                    </tr>
                    <tr>       
    <th width="66">Consecutivo</th> 
    <th width="66">Fecha</th>
	<th width="58">Peticionario </th>
    <th width="83">C&eacute;dula</th>
	<th width="120">Télefono</th>
	<th width="54">Radicado</th>
    <th width="96">Solicitud</th>
	<th width="53">Registr&oacute;</th>
    <th width="217">Fecha Resolvi&oacute;</th>
	<th width="96">Resolvi&oacute;</th>
	<th width="96">Resuelta</th>
    <th width="96">Ubicaci&oacute;n Expediente</th>
    <th width="96">Fecha Ubicaci&oacute;n</th>
    <th width="96">Descripci&oacute;n</th>
    <th width="96"></th>
	</tr>
  </thead>
  <tbody>       
                     
                    
<?php while($field = $datos_solicitudes->fetch()){  ?>
<tr>
        <td><?php echo $field[consecutivo];?></td>
        <td><?php echo $field[fecha];?></td>
		<td><?php echo $field[peticionario];?></td>
	    <td><?php echo $field[cedula];?></td>
		<td><?php echo $field[telefono];?></td>
	    <td><?php echo $field[radicado_consultar];?></td>
	    <td><?php echo $field[solicitud];?></td>
        <td><?php echo $field[empleado];?></td>
	    <td><?php echo $field[fecha_resuelve];?></td>
	    <td><?php echo $field[usures];?></td>
        <td><?php echo $field[resolvio];?></td>
	    <td><?php echo $field[ubicacion];?></td>
	    <td><?php echo $field[fecha_ubicacion];?></td>
	    <td><?php echo $field[fecha_ubicacion];?></td>
	    <td><span style="cursor:pointer">
	      <?php if($_SESSION['tipo_perfil']=='admin'){?>
	      <img src="views/images/edit.png" alt="" title="Modificar Solicitud" onclick="vinculo1(<?php echo $field[idsol];?>)" />
	      <?php }?>
	    </span></td>
</tr>
                    
<?php }?>
                               
                </thead>
          </table>
          
<?php }?>



</form>
</div>		
		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
