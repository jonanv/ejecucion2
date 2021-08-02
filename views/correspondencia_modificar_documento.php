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

function construir_radicado(frm)
{

 
 if(document.frm.manual.checked==true){
 
  var juzgado =frm.juzgado.value; 
  var area_vector = juzgado.split("-");
  var area_nueva = 3;
  var numero_juzgado = area_vector[1];
  var relleno ="";
   if(numero_juzgado>9)
    {
  	relleno = "0";
  	}
  	else
  	{
  	relleno = "00";
  	}
    
  	var radicado = "";
  	var ano = frm.ano.value;
  	var consecutivo = frm.consecutivo.value;
  	var instancia = frm.instancia.value;
   
  
  if(area_nueva==1)
  {
   var area = "170013103"; 
  }
  if(area_nueva==2)
  {
   var area = "170013110"; 
  }
   if(area_nueva==3)
  {
   var area = "170014003"; 
  }
  
  radicado = area+relleno+numero_juzgado+ano+"00"+consecutivo+instancia;
  //alert(radicado);
  frm.radicado.value = radicado;

}
  
 }

function activarradicado(frm)
{
 if(document.frm.manual.checked==true)
 {
   
   frm.ano.disabled=false;
   frm.consecutivo.disabled=false;
    
 }
 else
 {

   frm.ano.value="";
   frm.consecutivo.value="";
   frm.radicado.value="";
   frm.ano.disabled=true;
   frm.consecutivo.disabled=true;
   
   
 }
}

function generar_prioridad(frm)
{
 var vect =frm.solicitud.value; 
 var prio_vector = vect.split("-");
 var prioridad = prio_vector[1];
 
 if (prioridad==1)
 {
  frm.prioridad.value = "Alta";
 }
 if (prioridad==2)
 {
  frm.prioridad.value = "Media";
 } 
 if (prioridad==3)
 {
  frm.prioridad.value = "Baja";
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
<?php require 'secc_correspondencia.php'; ?>
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
        <div id="titulo_frm">Modificar Documento</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
         <tr>
    <td width="288">Fecha registro:</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <?php  
	//print_r($datos_radicado);
	
	//echo $datos_radicado[0][ano];
	
	while ($field = $datos_documento->fetch()){
	
		$datoincorporaexpediente = trim($field[incorporaexpediente]);
		
		$dobservacion            = trim($field[observacionesm]);
?>
    <td width="501"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php  echo  $field[fecha_registro];?>"/>	</td>
  </tr>
             <tr>
               <td>Tipo documento:</td>
               <td><select name="tipo_documento" id="sl_input" class="required" >
                 <option value="Memorial" <?php if($field[tipo_documento]=='Memorial') {?> selected="selected" <?php }?>>Memorial</option>
                 <option value="Oficio" <?php if($field[tipo_documento]=='Oficio') {?> selected="selected" <?php }?>>Oficio</option>
                 <option value="Recurso"<?php if($field[tipo_documento]=='Recurso') {?> selected="selected" <?php }?>>Recurso</option>
                 <option value="Otro"<?php if($field[tipo_documento]=='Otro') {?> selected="selected" <?php }?>>Otro</option>
                 </select></td>
             </tr>
             <tr>
               <td>Radicado?:</td>
               <td><label><?php $radicado=$field[radicado];?>
                 <input name="manual" type="checkbox" id="manual" onchange="activarradicado(frm)" value="1" <?php   if($radicado!='') {?>checked="checked" <?php }?>/>
               </label></td>
             </tr>
             <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)" <?php if ($radicado=='') { ?>disabled="disabled"<?php } ?>>
                 <option value="">Seleccione el a&ntilde;o</option>
                 <option value="1990" <?php if($datos_radicados[0][ano]==1990){ ?> selected="selected"<?php }?>>1990</option>
                 <option value="1991" <?php if($datos_radicados[0][ano]==1991){ ?> selected="selected"<?php }?>>1991</option>
                 <option value="1992" <?php if($datos_radicados[0][ano]==1992){ ?> selected="selected"<?php }?>>1992</option>
                 <option value="1993" <?php if($datos_radicados[0][ano]==1993){ ?> selected="selected"<?php }?>>1993</option>
                 <option value="1994" <?php if($datos_radicados[0][ano]==1994){ ?> selected="selected"<?php }?>>1994</option>
                 <option value="1995" <?php if($datos_radicados[0][ano]==1995){ ?> selected="selected"<?php }?>>1995</option>
                 <option value="1996" <?php if($datos_radicados[0][ano]==1996){ ?> selected="selected"<?php }?>>1996</option>
                 <option value="1997" <?php if($datos_radicados[0][ano]==1997){ ?> selected="selected"<?php }?>>1997</option>
                 <option value="1998" <?php if($datos_radicados[0][ano]==1998){ ?> selected="selected"<?php }?>>1998</option>
                 <option value="1999" <?php if($datos_radicado[0][ano]==1999){?>selected="selected"<?php }?>>1999</option>
                  <option value="2000" <?php if($datos_radicado[0][ano]==2000){?>selected="selected"<?php }?>>2000</option>
                 <option value="2001"<?php if($datos_radicado[0][ano]==2001){?>selected="selected"<?php }?>>2001</option>
                 <option value="2002"<?php if($datos_radicado[0][ano]==2002){?>selected="selected"<?php }?>>2002</option>
                 <option value="2003"<?php if($datos_radicado[0][ano]==2003){?>selected="selected"<?php }?>>2003</option>
                 <option value="2004"<?php if($datos_radicado[0][ano]==2004){?>selected="selected"<?php }?>>2004</option>
                 <option value="2005"<?php if($datos_radicado[0][ano]==2005){?>selected="selected"<?php }?>>2005</option>
                 <option value="2006"<?php if($datos_radicado[0][ano]==2006){?>selected="selected"<?php }?>>2006</option>
                 <option value="2007"<?php if($datos_radicado[0][ano]==2007){?>selected="selected"<?php }?>>2007</option>
                 <option value="2008"<?php if($datos_radicado[0][ano]==2008){?>selected="selected"<?php }?>>2008</option>
                 <option value="2009"<?php if($datos_radicado[0][ano]==2009){?>selected="selected"<?php }?>>2009</option>
                 <option value="2010"<?php if($datos_radicado[0][ano]==2010){?>selected="selected"<?php }?>>2010</option>
                 <option value="2011"<?php if($datos_radicado[0][ano]==2011){?>selected="selected"<?php }?>>2011</option>
                 <option value="2012"<?php if($datos_radicado[0][ano]==2012){?>selected="selected"<?php }?>>2012</option>
                 <option value="2013"<?php if($datos_radicado[0][ano]==2013){?>selected="selected"<?php }?>>2013</option>
                 <option value="2014"<?php if($datos_radicado[0][ano]==2014){?>selected="selected"<?php }?>>2014</option>
                 <option value="2015"<?php if($datos_radicado[0][ano]==2015){?>selected="selected"<?php }?>>2015</option>
                 <option value="2016"<?php if($datos_radicado[0][ano]==2016){?>selected="selected"<?php }?>>2016</option>
                 <option value="2017"<?php if($datos_radicado[0][ano]==2017){?>selected="selected"<?php }?>>2017</option>
				 <option value="2018"<?php if($datos_radicado[0][ano]==2018){?>selected="selected"<?php }?>>2018</option>
				 <option value="2019"<?php if($datos_radicado[0][ano]==2019){?>selected="selected"<?php }?>>2019</option>
				 <option value="2020"<?php if($datos_radicado[0][ano]==2020){?>selected="selected"<?php }?>>2020</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (tres digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="3" minlength="3" class="required number" onchange="construir_radicado(frm)" <?php   if($radicado=='') {?> disabled="disabled" <?php }?> value="<?php echo $datos_radicado[0][consecutivo];?>"/>
               <input type="hidden" name="instancia" id="hiddenField" value="00" />
               <input type="hidden" name="id" id="id" value="<?php //echo ?>" /></td>
             </tr>
             <tr>
            <td width="288">Juzgado:</td><?php  $idjuz=$field[idjuzgado];?>
            <td width="501"><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
              <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>" <?php if($idjuz==$fieldj[id]){ ?>selected="selected" <?php }?>><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Radicado:</td>
               <td><input name="radicado" type="text" class="required" id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" value="<?php echo $field[radicado];?>" /></td>
             </tr>
             <tr>
               <td>Tipo de solicitud:</td>
               <td><label>
                 <select name="solicitud" class="required" id="sl_input" onchange="generar_prioridad(frm)" >
                      <?php
 while($fields = $datos_solicitud->fetch()){
 
  
 ?>
                   <option value="<?php echo $fields[id]."-".$fields[idprioridad];?>" <?php if($field[idsolicitud]==$fields[id]){ ?>selected="selected" <?php }?> ><?php echo $fields[nombre] ?></option>
                   <?php }?>
                 </select>
               </label></td>
             </tr>
             <tr>
               <td>Prioridad:</td>
               <td><input type="text" name="prioridad" id="txt_input" readonly="readonly" value="<?php echo $field[prioridad]; ?>" /></td>
             </tr>
             <tr>
               <td>Peticionario:</td>
               <td>
                 <input type="text" name="peticionario" id="txt_input" class="required" value="<?php echo $field[peticionario]; ?>" />              </td>
             </tr>
             <tr>
               <td>Folios:</td>
               <td>
                 <input type="text" name="folios" id="txt_input7" class="required number" value="<?php echo $field[folios]; ?>"/>             </td>
             </tr>
             <tr>
               <td>Recibe:</td>
               <td><label>
                 <select name="recibe1" class="required" id="sl_input"  disabled="disabled" >
                   <option value="<?php echo $field[empleado]; ?>" ><?php echo $field[empleado];?></option>
                 </select>
               </label></td>
             </tr>
                 <?php  }?>
                 <tr><?php echo "ddd".$field[idjuzgadodestino];?>
                   <td>Juzgado destino:</td>
                   <td><select name="juzgado_destino"  id="sl_input" >
                   <option value="" >Seleccione el juzgado destino</option>
                    <option value="1" <?php if ($field[idjuzgadodestino]=='1'){?> selected="selected"<?php }?>>Juzgado 1 Ejecuci&oacute;n</option>
                <option value="2" <?php if ($field[idjuzgadodestino]=='2'){?> selected="selected"<?php }?>>Juzgado 2 Ejecuci&oacute;n</option>
                <option value="7"<?php if ($field[idjuzgadodestino]=='7'){?> selected="selected"<?php }?>>Oficina Ejecuci&oacute;n</option>
                   </select></td>
                 </tr>
                 <tr>
                   <td>Fecha de entrega:</td>
                   <td><input name="fecha_entrega" type="text" class="tini" id="txt_input" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tini").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
                 </tr>
				 
                 <tr>
                   <td>Tiene Expediente:</td>
                   <td>
                     <input name="tiene_expediente" type="checkbox" id="tiene_expediente" value="Si" />
                   </td>
                 </tr>
				 
				 <?php echo $field[incorporaexpediente]; ?>
				 
				 <tr>
                  
                   <td colspan="2">
                     <input id="estaincorporado" name="estaincorporado" type="hidden"  value="<?php echo $datoincorporaexpediente;?>"/>
                   </td>
				   
                 </tr>
				 
				 
				 <tr>
				 
                   	<td>
				   		Se Incorpora Memorial al Proceso:
					</td>
                   	<td>
                    	<input name="incorporaexpediente" type="checkbox" id="iexpediente" value="1" <?php if($datoincorporaexpediente == 1) {?>checked="checked" <?php }?>/>
						
						
						El proceso esta a Despacho:
						<input name="a_despacho" type="checkbox" id="a_despacho"/>
						
                   	</td>
					
                 </tr>
            <tr>
			
			<tr>
			
				<!-- <td>Observaciones: </td> -->
           	 	
				<!-- <td>
					<textarea name="observacionesm" id="txt_input" cols="100" rows="20" maxlength = "1000"><?php echo $dobservacion; ?></textarea> 
				
				</td> -->
				
				<td colspan="2">
					Observaciones:<br>
					<textarea name="observacionesm" cols="100" rows="10" maxlength = "1000"><?php echo $dobservacion; ?></textarea> 
				
				</td>
			
			</tr>
			
			
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Actualizar" id="btn_input">
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
