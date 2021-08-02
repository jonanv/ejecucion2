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
frm.fechai.value ="";
frm.fechaf.value ="";
frm.esoficio_telegrama.value ="";
frm.oficio_telegrama.value ="";
frm.parte.value ="";
frm.direccion.value ="";

}

function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=show_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=edit_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function consultar(frm)
{

variable=1;
variable2=frm.radicado.value;
variable3=frm.fechai.value;
variable4=frm.fechaf.value;
variable5=frm.esoficio_telegrama.value;
variable6=frm.oficio_telegrama.value;
variable7=frm.destinatario.value;
variable8=frm.direccion.value;
variable9=frm.idjuzgado.value;
variable10=frm.idmedionotificacion.value;

//location.href="index.php?controller=correspondencia&action=editarActuaciones&nombre="+variable;
location.href="index.php?controller=correspondencia&action=filtrar_otros1&nombre="+variable+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10;


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
<div id="titulo_frm">Filtro de Correspondencia Otros</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td width="187">Seleccione la fecha Inicial:</td>
      <td width="285"><input name="fechai" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre3'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
      <td width="180">Seleccione la fecha Final:</td>
      <td width="319"><input name="fechaf" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre4'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script></td>
    </tr>
      <tr>
      <td>Tipo Documento:</td>
      <td><select name="esoficio_telegrama" id="sl_input">
           <option value="" >Seleccione el tipo de documento</option>
        <option value="Oficio" <?php if ($_GET['nombre5']=='Oficio'){?>selected="selected"<?php }?>>Oficio</option>
        <option value="Telegrama" <?php if ($_GET['nombre5']=='Telegrama'){?>selected="selected"<?php }?>>Telegrama</option>
      </select></td>
      <td>N&uacute;mero Oficio/Telegrama:</td>
      <td><input type="text" name="oficio_telegrama" id="txt_input2" value="<?php echo $_GET['nombre6'];?>" /></td>
      </tr>
      <tr>
        <td>Radicado:</td>
        <td><input type="text" name="radicado" id="txt_input3" value="<?php echo $_GET['nombre2'];?>" /></td>
        <td>Destinatario:</td>
        <td><input type="text" name="destinatario" id="txt_input4" value="<?php echo $_GET['nombre7'];?>"/></td>
      </tr>
      <tr>
        <td>Direcci&oacute;n:</td>
        <td><label>
          <input type="text" name="direccion" id="txt_input5" value="<?php echo $_GET['nombre8'];?>" />
        </label></td>
        <td>Juzgado:</td>
        <td><select name="idjuzgado" id="sl_input">
        <option value="">Seleccione un Juzgado </option>
          <?php   while($fieldj = $datos_juzgados->fetch()){  ?>
          <option value="<?php echo $fieldj[id];?>" <?php if ($_GET['nombre9']==$fieldj[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldj[nombre];?></option>
          <?php }?>
        </select></td>
      </tr>
      <tr>
        <td>Medio Notificaci&oacute;n:</td>
        <td><select name="idmedionotificacion" id="sl_input">
         <option value="">Seleccione Medio Notificación</option>
          <?php   while($fieldm = $datos_medios->fetch()){  ?>
          <option value="<?php echo $fieldm[id];?>" <?php if ($_GET['nombre10']==$fieldm[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldm[nombre];?></option>
          <?php }?>
        </select></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input name="opcion" type="hidden" value="" />
    <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)">
     </td>
    <td> <input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)"/></td>
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
  <p>Lista de Correspondencia Otros</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                         <th width="63">Radicado</th>
	<th width="58">Juzgado </th>
    <th width="83">Destinatario</th>
	<th width="120">Oficio/Telegrama </th>
	<th width="54">Número</th>
	<th width="174">Medio Notificación</th>
    <th width="96">Ciudad</th>
	<th width="32">&nbsp;</th>
	<th width="32">&nbsp;</th>
    </tr>
                   
  </thead>
  <tbody>                  
                    <tr>
                    
<?php                     while($field = $datos_otros->fetch()){  ?>
                          <td><?php echo $field[radicado];?></td>
	<td><?php echo $field[juzgadonom];?></td>
	 <td><?php echo $field[destinatario];?></td>
		<td><?php echo $field[esOficio_Telegrama];?></td>
	    <td><?php echo $field[oficio_telegrama];?></td>
	    <td><?php echo $field[medionot];?></td>
        <td><?php echo $field[municipio];?></td>
	                       <td style="cursor:pointer"><img src="views/images/list.png" onclick="vinculo(<?php echo $field[idotro];?>)" title="Consultar Correspondencia" /></td>
                      <td style="cursor:pointer"><img src="views/images/edit.png" onclick="vinculo1(<?php echo $field[idotro];?>)" title="Modificar Correspondencia" /></td>
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
        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
