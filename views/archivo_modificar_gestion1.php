<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
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

function vinculo(variable)
{

location.href="index.php?controller=proyecto&action=show_proyecto&nombre="+variable;
//document.write(location.href) 
}
</script>
<script type="text/javascript" language="javascript">
function cambiar(frm)
{
 variable= frm.tipodocumento.value;
 //alert(variable);
 if(variable=='AC')
 frm.color.value='Rojo';
  if(variable=='AD')
 frm.color.value='Amarillo';
  if(variable=='CC')
 frm.color.value='Azul';
  if(variable=='TR')
 frm.color.value='Rosado';
  if(variable=='I')
 frm.color.value='Verde';
  if(variable=='O')
 frm.color.value='Blanco';
  if(variable=='CP')
 frm.color.value='Azul Oscuro';
  if(variable=='BP')
 frm.color.value='Morado';
 
}
function validar_ano(frm) { 

var x=0;
var longitud = parseInt(frm.contador.value);
var anio= parseInt(frm.ano.value);
var n2 =frm.campo.value;
var elem = n2.split(',');
while(x < longitud)
{
 if(elem[x]== anio)
 {
  alert("Ya existe un registro para el año seleccionado: "+anio);
  frm.ano.value= "";
 }
 x =x+1;
}




/*while(x < n1)
{
 campo= "ano"+x; 
 vector[x]=parseInt(frm.campo.value);
}
alert (n1);
/*var n1 = parseInt(frm.desde.value); 
var n2 = parseInt(frm.hasta.value); 
var p= parseInt(n2-n1);
document.frm.procesos.value=p; */

} 

</script>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
.Estilo2 {color: #FF9999}

.Estilo3 {color: #330099}

.Estilo4 {color: #33CCCC}

.Estilo5 {color: #FFFF00}

.Estilo6 {color: #FFFFFF}

.Estilo7 {color: #880088}

.Estilo8 {color: #00DD00}
</style>
</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_archivo.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">
          <p>Modificar Informe Archivo Gesti&oacute;n </p>
          <p>&nbsp;</p>
        </div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>A&ntilde;o:</td>
      <td><?php echo $_GET['nombre'];?></td>
    </tr>
  </table>
        <table width="691" border="1" cellpadding="0" cellspacing="0" id="frm_editar">
          <tr>
            <td width="34">&Aacute;rea</td>
            <td width="54">Juzgado</td>
            <td width="42">Enero</td>
            <td width="54">Febrero</td>
            <td width="46">Marzo</td>
            <td width="37">Abril</td>
            <td width="42">Mayo</td>
            <td width="38">Junio</td>
            <td width="34">Julio</td>
            <td width="49">Agosto</td>
            <td width="83">Septiembre</td>
            <td width="50">Octubre</td>
            <td width="68">Noviembre</td>
            <td width="323">Diciembre</td>
          </tr>
           <tr>
            <?php
	
	 while($field = $datos_gestion->fetch()){ ?>
   
          
          
            <td width="30"><?php echo $field[area];?></td>
            <td width="49"><?php echo $field[juzgado];?></td>
            <td width="36"><div align="center">
              <input name="enero<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[enero]==1){?>  checked="checked" <?php }?>  /></div></td>
            <td width="49"><div align="center">
              <input name="febrero<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[febrero]==1){?>  checked="checked" <?php }?> /> </div></td>
            <td width="40"><div align="center">
              <input name="marzo<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[marzo]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="30"><div align="center">
              <input name="abril<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[abril]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="36"><div align="center">
              <input name="mayo<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[mayo]==1){?>  
checked="checked" <?php }?>/> </div></td>
            <td width="31"><div align="center">
              <input name="junio<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[junio]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="27"><div align="center">
              <input name="julio<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[julio]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="44"><div align="center">
              <input name="agosto<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[agosto]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="70"><div align="center">
              <input name="septiembre<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[septiembre]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="50"><div align="center">
              <input name="octubre<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[octubre]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="68"><div align="center">
              <input name="noviembre<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[noviembre]==1){?>  checked="checked" <?php }?>/></div></td>
            <td width="62"><div align="center">
              <input name="diciembre<?php echo $field[idjuz];?>" type="checkbox" value="1" <?php if($field[diciembre]==1){?>  checked="checked" <?php }?>/></div></td>
           </tr>
          <?php }?>    </table>
        <table width="691" border="0" cellpadding="0" cellspacing="0" id="frm_editar">
        <tr>
        <td><input type="submit" name="Submit" value="Modificar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
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
