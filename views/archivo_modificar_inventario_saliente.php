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
fecha = frm.fecha_entrega.value;
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
frm.fecha_entrega.value="";
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
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Modificar Acta Entrega</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
                        <?php
 while($fieldi = $datos_inventario->fetch()){
 
  
 ?>
          <tr>
            <td>Consecutivo Acta Entrante:</td>
            <td colspan="2"><input type="tiempo_incumplimiento" name="consecutivo_acta" id="txt_input" value="<?php echo $fieldi[consecutivo_acta];?>" class="required" readonly="readonly" />
              <input type="hidden" name="id" id="hiddenField" value="<?php echo $fieldi[id];?>" /></td>
              <input name="dias" type="hidden" value="<?php echo $datos_dias;?>" />
               <input type="hidden" name="ano" id="hiddenField2" value="<?php echo $ano;?>" />
              <input type="hidden" name="consecutivo_familia" id="hiddenField2" value="<?php  echo $consecutivo_familia;?>" />
              <input type="hidden" name="consecutivo_civil" id="hiddenField2" value="<?php  echo $consecutivo_civil;?>" />
              <input type="hidden" name="consecutivo_municipal" id="hiddenField2" value="<?php  echo $consecutivo_municipal;?>" />
              <input type="hidden" name="tipo_consecutivo" id="hiddenField2" value="0" />
               <input type="hidden" name="area_antigua" id="hiddenField2" value="<?php echo $area;?>" />
               <input type="hidden" name="consecutivo_antiguo" id="hiddenField2" value="<?php echo $consec;?>" />
              
              
              
          </tr>
          <tr>
            <td>Fecha Acta Entrante:</td>
            <td colspan="2"><input name="fecha_acta" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php echo $fieldi[fecha_acta];?>" disabled="disabled"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
          </tr>
          <tr>
            <td>Juzgado:</td>
            <td colspan="2"><select name="idjuzgado" class="required" id="txt_input" onchange="cambiar(frm)" disabled="disabled">
            <option value="<?php echo $fieldi[idjuzgado];?>" selected="selected" ><?php echo $fieldi[nombre] ?></option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>Juzgado Destino:</td>
            <td colspan="2"><select name="iddestinojuzgado" class="required" id="txt_input" onchange="cambiar(frm)" disabled="disabled">
             <option value="<?php echo $fieldi[iddestinojuzgado];?>" selected="selected" ><?php echo $fieldi[destino] ?></option>
              <?php
 while($fieldk = $datos_juzgadosdestino->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldk[id];?>" ><?php echo $fieldk[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>Responsable:</td>
            <td colspan="2"><select name="responsable" class="required" id="sl_input" onchange="cambiar(frm)" disabled="disabled">
            <option value="<?php echo $fieldi[responsable];?>" selected="selected" ><?php echo $fieldi[responsable] ?></option>
              <?php
 while($field = $datos_empleados->fetch()){
 
  
 ?>
              <option value="<?php echo $field[empleado];?>" ><?php echo $field[empleado] ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Mes Archivar:</td>
               <td colspan="2"><label>
                 <select name="mes[]" size="12" multiple="multiple" class="required" id="sl_input" disabled="disabled">
                   <option value="1" <?php if($fieldi[enero]==1){ ?> selected="selected"<?php }?>>Enero</option>
                   <option value="2" <?php if($fieldi[febrero]==1){ ?> selected="selected"<?php }?>>Febrero</option>
                   <option value="3" <?php if($fieldi[marzo]==1){ ?> selected="selected"<?php }?>>Marzo</option>
                   <option value="4" <?php if($fieldi[abril]==1){ ?> selected="selected"<?php }?>>Abril</option>
                   <option value="5" <?php if($fieldi[mayo]==1){ ?> selected="selected"<?php }?>>Mayo</option>
                   <option value="6" <?php if($fieldi[junio]==1){ ?> selected="selected"<?php }?>>Junio</option>
                   <option value="7" <?php if($fieldi[julio]==1){ ?> selected="selected"<?php }?>>Julio</option>
                   <option value="8" <?php if($fieldi[agosto]==1){ ?> selected="selected"<?php }?>>Agosto</option>
                   <option value="9" <?php if($fieldi[septiembre]==1){ ?> selected="selected"<?php }?>>Septiembre</option>
                   <option value="10" <?php if($fieldi[octubre]==1){ ?> selected="selected"<?php }?>>Octubre</option>
                   <option value="11" <?php if($fieldi[noviembre]==1){ ?> selected="selected"<?php }?>>Noviembre</option>
                   <option value="12" <?php if($fieldi[diciembre]==1){ ?> selected="selected"<?php }?>>Diciembre</option>
                 </select>
               </label></td>
             </tr>
             <tr>
             <?php $ano  = $fieldi[ano_archivar];
			       $vano = explode(",",$ano);
			 ?>
            <td width="260">A&ntilde;o Archivar:</td>
            <td colspan="2"><label>
              <select name="ano[]" size="1" multiple="MULTIPLE" class="required" id="sl_input" disabled="disabled" >
                <option value="2013" <?php if (in_array("2013", $vano)) {  ?> selected="selected"<?php }?>>2013</option>
                <option value="2014" <?php if (in_array("2014", $vano)) {  ?> selected="selected"<?php }?>>2014</option>
                <option value="2015" <?php if (in_array("2015", $vano)) {  ?> selected="selected"<?php }?>>2015</option>
                <option value="2016" <?php if (in_array("2016", $vano)) {  ?> selected="selected"<?php }?>>2016</option>
                <option value="2017" <?php if (in_array("2017", $vano)) {  ?> selected="selected"<?php }?>>2017</option>
              </select>
            </label></td>
          </tr>
             <tr>
               <td rowspan="3">Consecutivo de Cajas</td>
               <td width="198">Desde:</td>
               <td width="322" colspan="-1"><input type="text" name="desde_caja" id="txt_input2" class="required number" value="<?php echo $fieldi[desde_caja]; ?>" disabled="disabled" /></td>
             </tr>
             <tr>
               <td>Hasta:</td>
               <td colspan="-1"><input type="text" name="hasta_caja" id="txt_input7" class="required number" value="<?php echo $fieldi[hasta_caja]; ?>"  disabled="disabled"/></td>
             </tr>
             <tr>
               <td>Cantidad Cajas</td>
               <td colspan="-1"><input type="procesos" name="cantidad_cajas" id="txt_input8" class="required number" value="<?php echo $fieldi[cantidad_cajas]; ?>" disabled="disabled" /></td>
             </tr>
              <tr>
               <td rowspan="3">Consecutivo de Expedientes</td>
               <td>Desde:</td>
               <td colspan="-1"><input type="text" name="desde_expediente" id="txt_input9" class="required number" value="<?php echo $fieldi[desde_expediente]; ?>" disabled="disabled" /></td>
             </tr>
             <tr>
               <td>Hasta:</td>
               <td colspan="-1"><input type="text" name="hasta_expediente" id="txt_input10" class="required number" value="<?php echo $fieldi[hasta_expediente]; ?>" disabled="disabled" /></td>
             </tr>
             <tr>
               <td>Cantidad Expedientes:</td>
               <td colspan="-1"><input type="procesos" name="cantidad_expedientes" id="txt_input11" class="required number" value="<?php echo $fieldi[cantidad_expedientes]; ?>" disabled="disabled" /></td>
             </tr>
             
            <tr>
              <td>Nombre quien entrega:</td>
              <td colspan="2"><label>
                <input type="text" name="nombre_entrega" id="txt_input" class="required" value="<?php echo $fieldi[nombre_entrega]; ?>" disabled="disabled" />
              </label></td>
          </tr>
          
          <tr>
              <td>Nombre quien recibe:</td>
              <td colspan="2"><label>
                <input type="text" name="nombre_recibe" id="txt_input" class="required" value="<?php echo $fieldi[nombre_recibe]; ?>" disabled="disabled" />
              </label></td>
          </tr>
           
           <tr>
            <td colspan="3"><div align="center" style="background:#CCCCCC"><strong>DATOS ACTA DE ENTREGA</strong></div></td>
            </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>Fecha Entrega:</td><?php   date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d');?>
            <td colspan="2"><input name="fecha_entrega" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php echo $fieldi[fecha_entrega];?>" onchange="validar_fecha(frm)" />
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td><?php $consecutivo = "";?>
          </tr>
          <tr>
            <td>Consecutivo Entrega:</td>
            <td colspan="2"><input type="text" name="consecutivo_entrega" id="txt_input" value="<?php echo $fieldi[consecutivo_acta_entrega];
					?>"  class="required" readonly="readonly"/><input name="tipo_consecutivo" type="hidden" value="<?php echo substr($datos_consecutivo,2,1);  ?>" /></td>
          </tr>
          <tr>
            <td>Nombre Entrega:</td>
            <td colspan="2"><input type="text" name="nombre_entrega_acta" id="txt_input" class="required" value="<?php echo $fieldi[nombre_entrega_acta];
					?>"</td>
          </tr>
          <tr>
            <td>Nombre Recibe:</td>
            <td colspan="2"><input type="text" name="nombre_recibe_acta" id="txt_input" class="required" value="<?php echo $fieldi[nombre_recibe_acta];
					?> "/></td>
          </tr>
           
           <tr>
             <td>Observaciones:</td>
             <td colspan="2"><label>
               <textarea name="observaciones" id="txt_input" cols="45" rows="5"><?php echo $fieldi[observaciones]; ?></textarea>
             </label></td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><input type="submit" name="Submit" value="Modificar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
          </tr>
        </table>
        <?php }?>
      </form>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>
</body>
</html>
