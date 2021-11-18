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
        <div id="titulo_frm">Registrar Memoriales</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
         <tr>
    <td width="288">Fecha Registro:</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <?php  date_default_timezone_set('America/Bogota'); 
           $fechaa=date('Y-m-d g:ia');
?>
    <td width="501"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php echo  $fechaa;?>"/>	</td>
  </tr>
             <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)">
                 <option value="">Seleccione el a&ntilde;o</option>
                 <option value="1999">1999</option>
                 <option value="2001">2001</option>
                 <option value="2002">2002</option>
                 <option value="2003">2003</option>
                 <option value="2004">2004</option>
                 <option value="2005">2005</option>
                 <option value="2006">2006</option>
                 <option value="2007">2007</option>
                 <option value="2008">2008</option>
                 <option value="2009">2009</option>
                 <option value="2010">2010</option>
                 <option value="2011">2011</option>
                 <option value="2012">2012</option>
                 <option value="2013">2013</option>
                 <option value="2014">2014</option>
                 <option value="2015">2015</option>
                 <option value="2016">2016</option>
                 <option value="2017">2017</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (tres digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="3" minlength="3" class="required number" onchange="construir_radicado(frm)"/>
               <input type="hidden" name="instancia" id="hiddenField" value="00" /></td>
             </tr>
             <tr>
            <td width="288">Juzgado:</td>
            <td width="501"><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
              <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Radicado:</td>
               <td><input name="radicado" type="text" class="required" id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" /></td>
             </tr>
             <tr>
               <td>Tipo de solicitud:</td>
               <td><label>
                 <select name="solicitud" class="required" id="sl_input" >                   <?php
 while($fields = $datos_solicitud->fetch()){
 
  
 ?>
                   <option value="<?php echo $fields[id];?>" ><?php echo $fields[nombre] ?></option>
                   <?php }?>
                 </select>
               </label></td>
             </tr>
             <tr>
               <td>Peticionario:</td>
               <td><label>
                 <input type="text" name="txt_input" id="txt_input" />
               </label></td>
             </tr>
             <tr>
               <td>Recibe:</td>
               <td><label>
                 <select name="recibe" class="required" id="sl_input"  disabled="disabled" >
                   <option value="<?php echo $_SESSION['idUsuario'];?>" ><?php echo $_SESSION['nombre']; ?></option>
          
                 </select>
               </label></td>
             </tr>
            <tr>
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
