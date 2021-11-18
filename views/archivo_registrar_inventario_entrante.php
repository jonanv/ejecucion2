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
function sumar(frm) { 
var n1 = parseInt(frm.desde.value); 
var n2 = parseInt(frm.hasta.value); 
var p= parseInt(n2-n1);
document.frm.procesos.value=p; 

} 

function validar_fecha(frm) { 
fecha = frm.fecha_acta.value;
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
frm.fecha_acta.value="";
}
else {

 }

}

function construir_radicado(frm)
{

 
  radicado = 'AR';
  var juzgado =frm.idjuzgado.value; 
  var ano =frm.ano.value; 
  var area_vector = juzgado.split("-");
  var area_nueva = area_vector[1];
  
  if(area_nueva==1)
  {
   radicado = radicado+'C';
   consecutivo_temp = frm.consecutivo_civil.value;
   frm.tipo_consecutivo.value=1;
  }
  if(area_nueva==2)
  {
   radicado = radicado+'F';
   consecutivo_temp = frm.consecutivo_familia.value;
   frm.tipo_consecutivo.value=2;
  } 
  if(area_nueva==3)
  {
   radicado = radicado+'M';
   consecutivo_temp = frm.consecutivo_municipal.value;
   frm.tipo_consecutivo.value=3;
  }
  
  if(consecutivo_temp<10)
  {
   consecutivo =  '00'+consecutivo_temp;
  
  }
  if((consecutivo_temp<100) && (consecutivo_temp>9))
  {
   consecutivo =  '0'+consecutivo_temp;
  
  }
  if(consecutivo_temp>99)
  {
   consecutivo =  consecutivo_temp;
  
  }  
  
  
  radicado = radicado+ano+"-"+consecutivo;
  
  
  frm.consecutivo_acta.value=radicado;
  
  
}


function validar_prestamo(frm)
{
var x =frm.prestados.checked;
if(x)
{
 frm.cantidad_prestamo.disabled= false;
 frm.nombre_prestamo.disabled= false;
 frm.observaciones_prestamo.disabled= false
 
 
 

}
else
{
 frm.cantidad_prestamo.value= "";
 frm.cantidad_prestamo.disabled= true;
 frm.nombre_prestamo.value= "";
 frm.nombre_prestamo.disabled= true;
 frm.observaciones_prestamo.value= "";
 frm.observaciones_prestamo.disabled= true; 
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
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
  <?php 
  
     date_default_timezone_set('America/Bogota'); 
     $ano=date('y');
	 
    while ($field = $datos_consecutivo->fetch())
  {
  
    $consecutivo_familia = $field[consecutivo_familia];
	$consecutivo_civil = $field[consecutivo_civil];
	$consecutivo_municipal = $field[consecutivo_municipal];
  }

  
  ?>
  
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Registrar Acta Recibido</div><input name="dias" type="hidden" value="<?php echo $datos_dias;?>" />
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
         <input type="hidden" name="tipo_inventario" id="hiddenField" value="1" />
              <input type="hidden" name="ano" id="hiddenField2" value="<?php echo $ano;?>" />
              <input type="hidden" name="consecutivo_familia" id="hiddenField2" value="<?php  echo $consecutivo_familia;?>" />
              <input type="hidden" name="consecutivo_civil" id="hiddenField2" value="<?php  echo $consecutivo_civil;?>" />
              <input type="hidden" name="consecutivo_municipal" id="hiddenField2" value="<?php  echo $consecutivo_municipal;?>" />
              <input type="hidden" name="tipo_consecutivo" id="hiddenField2" value="0" />
          <tr>
            <td>Fecha Acta:</td> 
            <td colspan="2"><input name="fecha_acta" type="text" class="required tinicio" id="txt_input" readonly="readonly" onchange="validar_fecha(frm)"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
          </tr>
          <tr>
            <td>Juzgado:</td>
            <td colspan="2"><select name="idjuzgado" class="required" id="txt_input" onchange="construir_radicado(frm)">
            				<option value="" >Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[idarea];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>Consecutivo Acta:</td>
            <td colspan="2"><input type="text" name="consecutivo_acta" id="txt_input" class="required" readonly="readonly" /></td>
          </tr>
          <tr>
            <td>Responsable:</td>
            <td colspan="2"><select name="responsable" id="sl_input">
              <?php
 while($field = $datos_empleados->fetch()){
 
  
 ?>
              <option value="<?php echo $field[empleado];?>" ><?php echo $field[empleado]; ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Mes Archivar:</td>
               <td colspan="2"><label>
                 <select name="mes[]" size="12" multiple="multiple" class="required" id="sl_input">
                   <option value="1">Enero</option>
                   <option value="2">Febrero</option>
                   <option value="3">Marzo</option>
                   <option value="4">Abril</option>
                   <option value="5">Mayo</option>
                   <option value="6">Junio</option>
                   <option value="7">Julio</option>
                   <option value="8">Agosto</option>
                   <option value="9">Septiembre</option>
                   <option value="10">Octubre</option>
                   <option value="11">Noviembre</option>
                   <option value="12">Diciembre</option>
                 </select>
               </label></td>
             </tr>
             <tr>
            <td width="260">A&ntilde;o Archivar:</td>
            <td colspan="2"><label>
              <select name="ano[]" size="1" multiple="MULTIPLE" class="required" id="sl_input" >
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
              </select>
            </label></td>
          </tr>
             <tr>
               <td rowspan="3">Consecutivo de Cajas</td>
               <td width="213">Desde:</td>
               <td width="307" colspan="-1"><input type="text" name="desde_caja" id="txt_input2" class="required number" /></td>
             </tr>
             <tr>
               <td>Hasta:</td>
               <td colspan="-1"><input type="text" name="hasta_caja" id="txt_input7" class="required number" /></td>
             </tr>
             <tr>
               <td>Cantidad Cajas</td>
               <td colspan="-1"><input type="procesos" name="cantidad_cajas" id="txt_input8" class="required number" /></td>
             </tr>
              <tr>
               <td rowspan="7">Consecutivo de Expedientes</td>
               <td>Desde:</td>
               <td colspan="-1"><input type="text" name="desde_expediente" id="txt_input9" class="required number" /></td>
             </tr>
             <tr>
               <td>Hasta:</td>
               <td colspan="-1"><input type="text" name="hasta_expediente" id="txt_input10" class="required number" /></td>
             </tr>
             <tr>
               <td>Cantidad Expedientes:</td>
               <td colspan="-1"><input type="procesos" name="cantidad_expedientes" id="txt_input11" class="required number" /></td>
             </tr>
             <tr>
               <td>Tiene Expedientes Prestados?</td>
               <td colspan="-1"><label>
                 <input name="prestados" type="checkbox" id="prestados" value="1" onclick="validar_prestamo(frm)" />
               </label></td>
             </tr>
             <tr>
               <td>Cantidad Expedientes Prestados:</td>
               <td colspan="-1"><input type="procesos" name="cantidad_prestamo" id="txt_input12" class="required number" disabled="disabled" /></td>
             </tr>
             <tr>
               <td>A Quien Presto:</td>
               <td colspan="-1"><label>
                 <input type="text" name="nombre_prestamo" id="txt_input" disabled="disabled" class="required" />
               </label></td>
             </tr>
             <tr>
               <td>Observaciones Pr&eacute;stamo:</td>
               <td colspan="-1"><label>
                 <textarea name="observaciones_prestamo" id="txt_input" cols="45" rows="5" disabled="disabled" class="required"></textarea>
               </label></td>
             </tr>
             
            <tr>
              <td>Nombre quien entrega:</td>
              <td colspan="2"><label>
                <input type="text" name="nombre_entrega" id="txt_input" class="required" />
              </label></td>
          </tr>
          
          <tr>
              <td>Nombre quien recibe:</td>
              <td colspan="2"><label>
                <input type="text" name="nombre_recibe" id="txt_input" class="required" />
              </label></td>
          </tr>
           
           <tr>
             <td>Observaciones:</td>
             <td colspan="2"><label>
               <textarea name="observaciones" id="txt_input" cols="45" rows="5"></textarea>
             </label></td>
           </tr>
           <tr>
             <td>&nbsp;</td>
             <td colspan="2">&nbsp;</td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><input type="submit" name="Submit" value="Registrar" id="btn_input">
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
