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

// alert();

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
 
  frm.radicado.value = radicado;


  
 }

function activar_resuelve(frm)
{
 if(document.frm.resolver.checked==true)
 {

  frm.fecha_resuelve.disabled=false;
  frm.idusuarioresuelve.disabled=false;
  frm.resolvio.disabled=false;
  frm.descripcion.disabled=false
  frm.ubicacion.disabled=false
  frm.fecha_ubicacion.disabled=false;
  
 }  
else
{

  frm.fecha_resuelve.disabled=true;
  frm.idusuarioresuelve.disabled=true;
  frm.idusuarioresuelve.value="";
  frm.resolvio.disabled=true;
   frm.descripcion.disabled=true;
    frm.descripcion.value="";
  frm.ubicacion.disabled=true
   frm.ubicacion.value="";
  frm.fecha_ubicacion.disabled=true;  
   frm.fecha_ubicacion.value=""; 
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
<script type="text/javascript">


numf2=0;
numf2_real=1;


function crearFormAccionado(form,frm) {



  
  numf2++;
  numf2_real++;
  fi = document.getElementById('fiel_acc'); // 1

  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div_a'+numf2; // 3
  fi.appendChild(contenedor); // 4
  
  
      ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Fecha: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  fecha = frm.fecha_mod.value;
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fecha_modif'+numf2; 
  ele.id= 'txt_input';
  ele.className= 'required';
  ele.value=fecha;
  ele.readOnly =true;
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Descripción: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  

  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'descripcion_modif'+numf2; 
  ele.id= 'txt_descripcion_solicitud';
  ele.className= 'required';
  contenedor.appendChild(ele); 


  




  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div_a'+numf2; // 8
  ele.onclick = function () {borrarForm_accionado(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
 frm.cantidad.value=numf2;


 
}


function borrarForm_accionado(obj) {
  fi = document.getElementById('fiel_acc');
  fi.removeChild(document.getElementById(obj));


  
}

</script>
<style type="text/css">
<!--
.Estilo1 {color: #000000}
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
  
  <?php      
			//echo $datos_dias;?>
  <tr>
    <td ><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Modificar Solicitud</div>
 
 <?php while ($field = $datos_solicitudes->fetch()){?>
 
              <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
         <tr>
    <td width="288">Fecha Registro:</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <?php  date_default_timezone_set('America/Bogota'); 
           $fechaa=date('Y-m-d g:ia');
		   $ano= date('Y');
?><input name="fecha_mod" type="hidden" value="<?php echo $fechaa;?>" />
    <td width="501"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php echo $field[fecha]?>"/>	</td>
  </tr>
             <tr>
               <td>Radicado Interno:</td>
               <td><?php echo $field[consecutivo]?>              </td>
             </tr>
             <tr>
               <td>Solicitud:</td>
               <td><textarea name="solicitud" id="txt_input" cols="45" rows="5" class="required" ><?php echo $field[solicitud]?></textarea></td>
             </tr>
             <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)">
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
                 <option value="1999" <?php if($datos_radicados[0][ano]==1999){ ?> selected="selected"<?php }?>>1999</option>
                 <option value="2000"<?php if($datos_radicados[0][ano]==2000){ ?> selected="selected"<?php }?>>2001</option>
                 <option value="2001"<?php if($datos_radicados[0][ano]==2001){ ?> selected="selected"<?php }?>>2001</option>
                 <option value="2002"<?php if($datos_radicados[0][ano]==2002){ ?> selected="selected"<?php }?>>2002</option>
                 <option value="2003"<?php if($datos_radicados[0][ano]==2003){ ?> selected="selected"<?php }?>>2003</option>
                 <option value="2004"<?php if($datos_radicados[0][ano]==2004){ ?> selected="selected"<?php }?>>2004</option>
                 <option value="2005"<?php if($datos_radicados[0][ano]==2005){ ?> selected="selected"<?php }?>>2005</option>
                 <option value="2006"<?php if($datos_radicados[0][ano]==2006){ ?> selected="selected"<?php }?>>2006</option>
                 <option value="2007"<?php if($datos_radicados[0][ano]==2007){ ?> selected="selected"<?php }?>>2007</option>
                 <option value="2008"<?php if($datos_radicados[0][ano]==2008){ ?> selected="selected"<?php }?>>2008</option>
                 <option value="2009"<?php if($datos_radicados[0][ano]==2009){ ?> selected="selected"<?php }?>>2009</option>
                 <option value="2010"<?php if($datos_radicados[0][ano]==2010){ ?> selected="selected"<?php }?>>2010</option>
                 <option value="2011"<?php if($datos_radicados[0][ano]==2011){ ?> selected="selected"<?php }?>>2011</option>
                 <option value="2012"<?php if($datos_radicados[0][ano]==2012){ ?> selected="selected"<?php }?>>2012</option>
                 <option value="2013"<?php if($datos_radicados[0][ano]==2013){ ?> selected="selected"<?php }?>>2013</option>
                 <option value="2014"<?php if($datos_radicados[0][ano]==2014){ ?> selected="selected"<?php }?>>2014</option>
                 <option value="2015"<?php if($datos_radicados[0][ano]==2015){ ?> selected="selected"<?php }?>>2015</option>
                 <option value="2016"<?php if($datos_radicados[0][ano]==2016){ ?> selected="selected"<?php }?>>2016</option>
                 <option value="2017"<?php if($datos_radicados[0][ano]==2017){ ?> selected="selected"<?php }?>>2017</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (tres digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="3" minlength="3" class="required number" onchange="construir_radicado(frm)" value="<?php echo $datos_radicados[0][consecutivo];?>" />
               <input type="hidden" name="instancia" id="hiddenField2" value="00" />
               <input type="hidden" name="cantidad" id="cantidad" value="0" /></td>
             </tr>
             <tr>
               <td>Juzgado:</td><?php //echo $datos_radicados[0][juzgado];?>
               <td><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
                 <option value="" selected="selected">Seleccione un juzgado</option>
                 <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
                 <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>"<?php if($datos_radicados[0][juzgado]==$fieldj[numero_juzgado]) {?> selected="selected"<?php }?>><?php echo $fieldj[nombre] ?></option>
                 <?php }?>
               </select></td>
             </tr>
             <tr>
               <td>Radicado a Consultar:</td>
               <td><input name="radicado" type="text" class="required" id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" value="<?php echo $field[radicado_consultar]?>" /></td>
             </tr>
             <tr>
               <td>Peticionario:</td>
               <td>
                 <input type="text" name="peticionario" id="txt_input" class="required" value="<?php echo $field[peticionario]?>" />              </td>
             </tr>
             <tr>
               <td>C&eacute;dula:</td>
               <td><input type="text" name="cedula" id="txt_input" class="required" value="<?php echo $field[cedula]?>" /></td>
             </tr>
             <tr>
               <td>T&eacute;lefono:</td>
               <td><input type="text" name="telefono" id="txt_input" value="<?php echo $field[telefono]?>"  /></td>
             </tr>
             <tr>
               <td>Recibe:</td>
               <td><label>
               <input type="text" name="usua_recibe" id="txt_input" value="<?php echo $field[recibeusu]?>" disabled="disabled"  />
               </label></td>
             </tr>
             <tr>
               <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>DATOS PARA RESOLVER SOLICITUD</strong></div></td>
               </tr>
             <tr>
               <td>Resolver Solicitud:</td><?php $res=$field[resolvio];?>
               <td><label>
                 <input name="resolver" type="checkbox" id="resolver" value="1" onchange="activar_resuelve(frm)" <?php if ($res=='si'){?> disabled="disabled"<?php }?> />
               </label></td>
             </tr>
             <tr>
               <td>Fecha resuelve:</td>
               <td><input name="fecha_resuelve" type="text" class="required tinicio" id="txt_input" readonly="readonly"  <?php if ($res=='si'){?>value="<?php echo  $field[fecha_resuelve];?>"<?php }else {?> value="<?php echo  $fechaa;?>" <?php }?> disabled="disabled"/></td>
             </tr>
             <tr>
               <td>Usuario resuelve:</td>
               <td><select name="idusuarioresuelve"  id="sl_input" class="required" disabled="disabled">
                 <option value="" selected="selected">Seleccione un usuario</option>
                 <?php
 while($fieldj = $datos_usuarios->fetch()){
 
  
 ?>
                 <option value="<?php echo $fieldj[id];?>" <?php if($fieldj[id]==$field[idusuarioresuelve]){?>selected="selected"<?php }?> ><?php echo $fieldj[empleado] ?></option>
                 <?php }?>
               </select></td>
             </tr>
             <tr>
               <td>Se resuelve la solicitud?</td>
               <td><label>
               <select name="resolvio"  id="sl_input" class="required" >
                 <option value="si" <?php if($field[resolvio]=='si'){?>selected="selected"<?php }?>>si</option>
                 <option value="no"<?php if($field[resolvio]=='no'){?>selected="selected"<?php }?>>no</option>
                 <?php
 while($fieldj = $datos_usuarios->fetch()){
 
  
 ?>
                 <?php }?>
                              </select>
               </label></td>
             </tr>
             <tr>
               <td>Descripci&oacute;n:</td>
               <td><textarea name="descripcion" id="txt_input" cols="45" rows="5" class="required" disabled="disabled"><?php echo $field[descripcion];?></textarea></td>
             </tr>
             <tr>
               <td>Ubicaci&oacute;n Expediente:</td>
               <td><label>
                 <input type="text" name="ubicacion" id="txt_input" disabled="disabled" class="required" value="<?php echo $field[ubicacion]; ?>" />
               </label></td>
             </tr>
             <tr>
               <td>Fecha Ubicaci&oacute;n:</td>
               <td><input name="fecha_ubicacion" type="text" class="tinicio required" id="txt_input" readonly="readonly"  disabled="disabled" value="<?php echo $field[fecha_ubicacion]; ?>"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script></td>
             </tr>
        
             <tr>
               <td></td>
               <td>&nbsp;</td>
             </tr>
             <tr>
              <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>DETALLES DESCRIPCIONES ADICIONALES</strong></div></td>
               </tr>
             
   
                  <?php while ($fieldd = $detalles->fetch()){?>
             <tr>
               <td>Fecha: &nbsp;&nbsp; <span class="Estilo1"><?php echo $fieldd[fechad]; ?></span></td>
               <td>Descripci&oacute;n Adicional:&nbsp;&nbsp;<span class="Estilo1"><?php echo $fieldd[descr]; ?></span></td>
             </tr>
                       <?php }?>
             <tr>
               <td>&nbsp;</td>
               <td><input type="button" name="btn_input_accionado" id="btn_input_grande" value="Adicionar Descripción"  onclick="crearFormAccionado(this,frm)" /></td>
             </tr>
             <tr>
               <td colspan="2"><fieldset id="fiel_acc">
               </fieldset></td>
               </tr>
             <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Actualizar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
          </tr>
        </table>
        <?php }?> 
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
