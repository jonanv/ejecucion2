<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

function vinculo(variable)
{

location.href="index.php?controller=proyecto&action=show_proyecto&nombre="+variable;
//document.write(location.href) 
}
</script>
<script type="text/javascript" language="javascript">

function sumar(frm) { 
var n1 = parseInt(frm.desde.value); 
var n2 = parseInt(frm.hasta.value);

if(n1>n2)
{
 alert("El valor desde debe ser menor que el valor hasta");
 frm.desde.value = "";
 frm.hasta.value = ""; 
}
else
{
 var p= parseInt(n2-n1+1);
 document.frm.procesos.value=p; 
}

} 
function validar_fecha(frm) { 
fecha = frm.fecha.value;
dias_temp = frm.dias.value;
dias = dias_temp.split(",");
Array.prototype.in_array=function(){ 
    for(var j in this){ 
        if(this[j]==arguments[0]){ 
            return true; 
        } 
    } 
    return false;     
} 
if(dias.in_array(fecha)){
alert('La fecha seleccionada, corresponde a un día no hábil, seleccione otra fecha por favor');
//jAlert('This is a custom alert box', 'Alert Dialog');
frm.fecha.value="";
}
else {

 }

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
    <td></td>
  </tr>
  
  <?php      
			//echo $datos_dias;?>
  <tr>
    <td ><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Registrar Memoriales</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
          <tr><input name="dias" type="hidden" value="<?php echo $datos_dias;?>" />
            <td width="82">Responsable:</td>
            <td width="108">&nbsp;</td>
            <td width="764"><select name="responsable" class="required" id="sl_input" onchange="cambiar(frm)">
            <?php
	
			
			
			
 while($field = $datos_empleados->fetch()){
 
  
 ?>
              <option value="<?php echo $field[id];?>" ><?php echo $field[empleado] ?></option>
<?php }?>
            </select></td>
          </tr>
         <tr>
    <td width="82">Fecha:</td>
    <td width="108">&nbsp;</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <td width="764"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly" onchange="validar_fecha(frm)"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
  </tr>
             <tr>
            <td width="82">Juzgado:</td>
            <td width="108">&nbsp;</td>
            <td width="764"><select name="juzgado" class="required" id="sl_input" onchange="cambiar(frm)">
            <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre] ?></option>
<?php }?>
            </select></td>
          </tr>
             <tr>
               <td rowspan="4">Consecutivos y Cajas</td>
               <td>Desde:</td>
               <td><input type="text" name="desde" id="txt_input" class="required number" onchange="sumar(frm)" /></td>
             </tr>
             <tr>
               <td>Hasta:</td>
               <td><input type="text" name="hasta" id="txt_input3" class="required number" onchange="sumar(frm)" /></td>
             </tr>
             <tr>
               <td>N&uacute;mero Procesos</td>
               <td><input type="procesos" name="procesos" id="txt_input" class="required number" readonly="readonly" /></td>
             </tr>
             <tr>
               <td>Consecutivo Caja</td>
               <td><input type="text" name="consecutivo" id="txt_input4" class="required number" /></td>
             </tr>
              <tr>
               <td rowspan="6">Que se realizo de la caja</td>
               <td>Quitar Ganchos</td>
               <td><label>
                 <input name="r_gancho" type="checkbox" id="r_gancho" checked="checked" />
               </label></td>
              </tr>
             <tr>
               <td>Coser</td>
               <td><input name="r_coser" type="checkbox" id="r_coser" checked="checked" /></td>
             </tr>
             <tr>
               <td>Foliar</td>
               <td><input name="r_foliar" type="checkbox" id="r_foliar" checked="checked" /></td>
             </tr>
             <tr>
               <td>Siglo XXI</td>
               <td><input name="r_siglo" type="checkbox" id="r_siglo" checked="checked" /></td>
             </tr>
             <tr>
               <td>SAIDOJ</td>
               <td><input name="r_saidoj" type="checkbox" id="r_saidoj" checked="checked" /></td>
             </tr>
             <tr>
               <td>N&uacute;mero de Procesos Faltantes</td>
               <td><input type="text" name="procesos_faltantes" id="txt_input5"  /></td>
             </tr>
            <tr>
              <td>Causales de incumplimiento especificas:</td>
              <td>&nbsp;</td>
              <td><label>
              <textarea name="causales_incumplimiento" rows="4" id="txt_input"></textarea>
            </label></td>
          </tr>
          <tr>
            <td>Tiempo causal de incumplimiento(minutos):</td>
            <td>&nbsp;</td>
            <td><input type="tiempo_incumplimiento" name="tiempo_incumplimiento" id="txt_input6" class="number" /></td>
          </tr>
          <tr>
              <td>Observaciones a la causa de incumplimiento:</td>
              <td>&nbsp;</td>
              <td><label>
              <textarea name="observaciones" rows="4"  id="txt_input"></textarea>
            </label></td>
          </tr>
           <tr>
              <td>Observaciones por parte del revisor:</td>
              <td>&nbsp;</td>
              <td><label>
              <textarea name="observaciones_revisor" rows="4"  id="txt_input"></textarea>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Registrar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
		<?php require 'alertas.php';?>
</body>
</html>
