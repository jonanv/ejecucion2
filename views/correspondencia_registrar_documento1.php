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


function consultarRadicado(frm)
{
var variable = frm.radicado.value;
var variable1 = frm.tipo_documento.value;
var variable2 = frm.juzgadodestino.value;
var variable3 = frm.folios.value;
var variable4 = frm.manual.checked;
var variable5 = frm.ano.value;
var variable6 = frm.consecutivo.value;
var variable7 = frm.juzgado.value;
var variable8 = frm.instancia.value;
var variable9 = frm.juzgadodestino.value;
var variable10 = frm.solicitud.value;
var variable11 = frm.peticionario.value;
var variable12 = frm.cedula.value;
var variable13 = frm.telefono.value;
var variable14 = frm.folios.value;
var variable15 = frm.prioridad.value;
//alert(variable4);
 if(document.frm.manual.checked==true){
 location.href="index.php?controller=correspondencia&action=listarSigloXXI&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable3+"&nombre3="+variable4+"&nombre4="+variable5+"&nombre5="+variable6+"&nombre6="+variable7+"&nombre7="+variable8+"&nombre8="+variable9+"&nombre9="+variable10+"&nombre10="+variable11+"&nombre11="+variable12+"&nombre12="+variable13+"&nombre13="+variable14+"&nombre14="+variable15;
 }
 
}
function registrarrad(frm)
{

var variable = frm.radicado.value;
var variable1 = frm.tipo_documento.value;
var variable2 = frm.juzgadodestino.value;
var variable3 = frm.folios.value;
var variable4 = frm.manual.checked;
var variable5 = frm.ano.value;
var variable6 = frm.consecutivo.value;
var variable7 = frm.juzgado.value;
var variable8 = frm.instancia.value;
var variable9 = frm.juzgadodestino.value;
var variable10 = frm.solicitud.value;
var variable11 = frm.peticionario.value;
var variable12 = frm.cedula.value;
var variable13 = frm.telefono.value;
var variable14 = frm.folios.value;
var variable15 = frm.prioridad.value;
var variable16 = frm.demandante.value;
var variable17 = frm.demandado.value;
//alert(variable4);

// if(document.frm.manual.checked==true){
 location.href="index.php?controller=correspondencia&action=regmemorial&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable3+"&nombre3="+variable4+"&nombre4="+variable5+"&nombre5="+variable6+"&nombre6="+variable7+"&nombre7="+variable8+"&nombre8="+variable9+"&nombre9="+variable10+"&nombre10="+variable11+"&nombre11="+variable12+"&nombre12="+variable13+"&nombre13="+variable14+"&nombre14="+variable15+"&nombre16="+variable16+"&nombre17="+variable17;
// }
 
}

function activardestino(frm)
{

// if(document.frm.manual2.checked==false){
 var juzgado = frm.juzgado.value;

	if ((juzgado=="1-1") || (juzgado=="16-16")  || (juzgado=="31-31") || (juzgado=="72-72") ){	
	frm.juzgadodestino.value="1-";
	// alert(juzgado);
	}	
	if ((juzgado=="2-2") || (juzgado=="17-17")  || (juzgado=="32-32") || (juzgado=="73-73")){
	frm.juzgadodestino.value="2-";
	}
	if ((juzgado=="3-3") || (juzgado=="18-18") || (juzgado=="33-33") || (juzgado=="46-46") || (juzgado=="59-59")){
	frm.juzgadodestino.value="3-";
	}
	if ((juzgado=="4-4") || (juzgado=="19-19") || (juzgado=="34-34") || (juzgado=="47-47") || (juzgado=="60-60")){
	frm.juzgadodestino.value="4-";
	}
	if ((juzgado=="5-5") || (juzgado=="20-20") || (juzgado=="35-35") || (juzgado=="48-48") || (juzgado=="61-61")){
	frm.juzgadodestino.value="5-";
	}
	if ((juzgado=="6-6") || (juzgado=="21-21") || (juzgado=="36-36") || (juzgado=="49-49") || (juzgado=="62-62")){
	frm.juzgadodestino.value="6-";
	}
	if ((juzgado=="7-7") || (juzgado=="22-22") || (juzgado=="37-37") || (juzgado=="50-50") || (juzgado=="63-63")){
	frm.juzgadodestino.value="7-";
	}
	if ((juzgado=="8-8") || (juzgado=="23-23") || (juzgado=="38-38") || (juzgado=="51-51") || (juzgado=="64-64")){
	frm.juzgadodestino.value="8-";
	}
	if ((juzgado=="9-9") || (juzgado=="24-24") || (juzgado=="39-39") || (juzgado=="52-52") || (juzgado=="65-65")){
	frm.juzgadodestino.value="9-";
	}
	if ((juzgado=="10-10") || (juzgado=="25-25") || (juzgado=="40-40") || (juzgado=="53-53") || (juzgado=="66-66")){
	frm.juzgadodestino.value="10-";
	}
	if ((juzgado=="11-11") || (juzgado=="26-26") || (juzgado=="41-41") || (juzgado=="54-54") || (juzgado=="67-67")){
	frm.juzgadodestino.value="11-";
	}
	if ((juzgado=="12-12") || (juzgado=="27-27") || (juzgado=="42-42") || (juzgado=="55-55") || (juzgado=="68-68")){
	frm.juzgadodestino.value="12-";
	}
	if ((juzgado=="13-13") || (juzgado=="28-28") || (juzgado=="43-43") || (juzgado=="56-56") || (juzgado=="69-69")){
	frm.juzgadodestino.value="13-";
	}
	if ((juzgado=="14-14") || (juzgado=="29-29") || (juzgado=="44-44") || (juzgado=="57-57")|| (juzgado=="70-70")){
	frm.juzgadodestino.value="14-";
	}
	if ((juzgado=="15-15") || (juzgado=="30-30") || (juzgado=="45-45") || (juzgado=="58-58") || (juzgado=="71-71")){
	frm.juzgadodestino.value="15-";
	}

}
function activar_descongestion(frm)
{
	//frm.descongestion.disabled=false;
}
function juz_descongestion(frm)
{

//if(document.frm.manual2.checked==true){
		
	 var desconge = frm.descongestion.value;
	 if(desconge=="1-2"){
	 frm.juzgadodestino.value="1-";
	 }
	 if(desconge=="2-3"){
	 frm.juzgadodestino.value="2-";
	 }
	 if(desconge=="3-6"){
	 frm.juzgadodestino.value="3-";
	 }
	 if(desconge=="4-7"){
	 frm.juzgadodestino.value="4-";
	 }
	 if(desconge=="9-8"){
	 frm.juzgadodestino.value="5-";
	 }
	 if(desconge=="6-9"){
	 frm.juzgadodestino.value="6-";
	 }
	 if((desconge=="7-4") || (desconge=="8-20")){
	 frm.juzgadodestino.value="7-";
	 }
	 if((desconge=="9-8") || (desconge=="10-5")){
	 frm.juzgadodestino.value="8-";
	 }
	 if((desconge=="11-14") || (desconge=="12-38")){
	 frm.juzgadodestino.value="9-";
	 }
	 if((desconge=="13-16") || (desconge=="14-21") || (desconge=="15-22")){
	 frm.juzgadodestino.value="10-";
	 }
	 if((desconge=="1-2") || (desconge=="3-6") || (desconge=="18-19")){
	 frm.juzgadodestino.value="11-";
	 }
	 if((desconge=="2-3") || (desconge=="20-39") ){
	 frm.juzgadodestino.value="12-";
	 }
	 if((desconge=="21-40") || (desconge=="22-33")){
	 frm.juzgadodestino.value="13-";
	 }
	 if((desconge=="22-33") || (desconge=="23-25") || (desconge=="24-34")){
	 frm.juzgadodestino.value="14-";
	 }
	 if((desconge=="6-9") || (desconge=="26-24") ){
	 frm.juzgadodestino.value="15-";
	 }
	 
//	}
}

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
   if(consecutivo>=10000){
  radicado = area+relleno+numero_juzgado+ano+consecutivo+instancia;
  }
  if(consecutivo>=1000 && consecutivo<=9999 ){
  radicado = area+relleno+numero_juzgado+ano+"0"+consecutivo+instancia;
  }
  if(consecutivo<=999){
  radicado = area+relleno+numero_juzgado+ano+"00"+consecutivo+instancia;
  }
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
   frm.instancia.disabled=false;
    
 }
 else
 {

   //frm.ano.value="";
   //frm.consecutivo.value="";
   //frm.radicado.value="";
   frm.ano.disabled=true;
   frm.consecutivo.disabled=true;
   frm.instancia.disabled=true;
   
 }
}

function generar_prioridad(frm)
{
 var vect = frm.solicitud.value; 
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
        <div id="titulo_frm">Registrar Documento</div>
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
               <td>Tipo Documento:</td>
               <td><select name="tipo_documento" id="sl_input" class="required" >                
                 <option value="Memorial"<?php if($datos_siglo[0][tipo_documento]=="Memorial"){?>selected="selected"<?php }?>>Memorial </option>
                 <option value="Oficio"<?php if($datos_siglo[0][tipo_documento]=="Oficio"){?>selected="selected"<?php }?>>Oficio</option>
                 <option value="Recurso" <?php if($datos_siglo[0][tipo_documento]=="Recurso"){?>selected="selected"<?php }?>>Recurso</option>
                 <option value="Otro" <?php if($datos_siglo[0][tipo_documento]=="Otro"){?>selected="selected"<?php }?>>Otro</option>
                 <option value="Tutelas" <?php if($datos_siglo[0][tipo_documento]=="Tutelas"){?>selected="selected"<?php }?>>Tutelas</option>
                 <option value="Vigilancia" <?php if($datos_siglo[0][tipo_documento]=="Vigilancia"){?>selected="selected"<?php }?>>Vigilancia</option>
                 
                 </select></td>
             </tr>
            
             <tr>
               <td>Radicado?:</td>
               <td><label>
                 <input type="checkbox" name="manual" id="manual"   onchange="activarradicado(frm)"  />
               </label></td>
             </tr>
             <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)" disabled="disabled">
                 <option value="">Seleccione el a&ntilde;o</option>
				 <option value="1990"<?php if($datos_siglo[0][ano]==1990){?>selected="selected"<?php }?>>1990</option>
                 <option value="1991"<?php if($datos_siglo[0][ano]==1991){?>selected="selected"<?php }?>>1991</option>
                 <option value="1992"<?php if($datos_siglo[0][ano]==1992){?>selected="selected"<?php }?>>1992</option>
                 <option value="1993"<?php if($datos_siglo[0][ano]==1993){?>selected="selected"<?php }?>>1993</option>
                 <option value="1994"<?php if($datos_siglo[0][ano]==1994){?>selected="selected"<?php }?>>1994</option>
                 <option value="1995"<?php if($datos_siglo[0][ano]==1995){?>selected="selected"<?php }?>>1995</option>
                 <option value="1996"<?php if($datos_siglo[0][ano]==1996){?>selected="selected"<?php }?>>1996</option>
                 <option value="1997"<?php if($datos_siglo[0][ano]==1997){?>selected="selected"<?php }?>>1997</option>
                 <option value="1998"<?php if($datos_siglo[0][ano]==1998){?>selected="selected"<?php }?>>1998</option>         
                 <option value="1999"<?php if($datos_siglo[0][ano]==1999){?>selected="selected"<?php }?>>1999</option>
                 <option value="2000"<?php if($datos_siglo[0][ano]==2000){?>selected="selected"<?php }?>>2000</option>
                 <option value="2001"<?php if($datos_siglo[0][ano]==2001){?>selected="selected"<?php }?>>2001</option>
                 <option value="2002"<?php if($datos_siglo[0][ano]==2002){?>selected="selected"<?php }?>>2002</option>
                 <option value="2003"<?php if($datos_siglo[0][ano]==2003){?>selected="selected"<?php }?>>2003</option>
                 <option value="2004"<?php if($datos_siglo[0][ano]==2004){?>selected="selected"<?php }?>>2004</option>
                 <option value="2005"<?php if($datos_siglo[0][ano]==2005){?>selected="selected"<?php }?>>2005</option>
                 <option value="2006"<?php if($datos_siglo[0][ano]==2006){?>selected="selected"<?php }?>>2006</option>
                 <option value="2007"<?php if($datos_siglo[0][ano]==2007){?>selected="selected"<?php }?>>2007</option>
                 <option value="2008"<?php if($datos_siglo[0][ano]==2008){?>selected="selected"<?php }?>>2008</option>
                 <option value="2009"<?php if($datos_siglo[0][ano]==2009){?>selected="selected"<?php }?>>2009</option>
                 <option value="2010"<?php if($datos_siglo[0][ano]==2010){?>selected="selected"<?php }?>>2010</option>
                 <option value="2011"<?php if($datos_siglo[0][ano]==2011){?>selected="selected"<?php }?>>2011</option>
                 <option value="2012"<?php if($datos_siglo[0][ano]==2012){?>selected="selected"<?php }?>>2012</option>
                 <option value="2013"<?php if($datos_siglo[0][ano]==2013){?>selected="selected"<?php }?>>2013</option>
                 <option value="2014"<?php if($datos_siglo[0][ano]==2014){?>selected="selected"<?php }?>>2014</option>
                 <option value="2015"<?php if($datos_siglo[0][ano]==2015){?>selected="selected"<?php }?>>2015</option>
                 <option value="2016"<?php if($datos_siglo[0][ano]==2016){?>selected="selected"<?php }?>>2016</option>
                 <option value="2017"<?php if($datos_siglo[0][ano]==2017){?>selected="selected"<?php }?>>2017</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (tres o cuatro digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="5" minlength="3" class="required number" onchange="construir_radicado(frm)" disabled="disabled" value="<?php echo $datos_siglo[0][consecutivo] ?>"/></td>
             </tr>
             
             <tr>
            <td width="288">Juzgado:</td>
            <td width="501"><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado, activardestino(frm)">
              <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>"<?php if($fieldj[id]."-".$fieldj[numero_juzgado]==$datos_siglo[0][juzgado]){ ?> selected="selected"<?php }?> ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
               <td>Instancia:</td>
               <td><input name="instancia" type="text" id="txt_input_corto" size="8" maxlength="2" minlength="2" class="required number" onchange="construir_radicado(frm)" disabled="disabled" value="<?php echo $datos_siglo[0][instancia] ?>"/></td>
          </tr>
             <tr>
               <td>Radicado:</td>
               <td><input name="radicado" type="text" class="required" id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" value="<?php echo $datos_siglo[0][radicado] ?>" />
               <img src="views/images/buscarrr.jpg" alt="" width="29" height="26"  onclick="consultarRadicado(frm)"/>
               <input name="radicadoOld" type="hidden" value="<?php frm.radicado.value ?>" /></td>
             </tr>
              
             <tr>
               <td>Demandante:</td>
               <td>
                 <input type="text" name="demandante" id="txt_input"  readonly="readonly" value="<?php echo $datos_demandante[0][demandante] ?>"/>            </td>
             </tr>
             <tr>
               <td>Demandado:</td>
               <td>
                 <input type="text" name="demandado" id="txt_input" readonly="readonly"  value="<?php echo $datos_demandante[0][demandado] ?>"/>            </td>
             </tr>
             
             <tr>
            <td width="288">Juzgado Destino:</td>
            <td width="501"><select name="juzgadodestino" class="required" id="sl_input" onchange="construir_radicado(frm)">
              <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_destino->fetch()){
 
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>"<?php if($fieldj[id]."-".$fieldj[numero_juzgado]==$datos_siglo[0][destino]){ ?> selected="selected"<?php }?> ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Tipo de solicitud:</td>
               <td><label>
                 <select name="solicitud" class="required" id="sl_input" onchange="generar_prioridad(frm)" >
                  <option value="" selected="selected">Seleccione una solicitud</option>                   <?php
 while($fields = $datos_solicitud->fetch()){
 
  
 ?>
                   <option value="<?php echo $fields[id]."-".$fields[idprioridad];?>"<?php if($fields[id]."-".$fields[idprioridad]==$datos_siglo[0][solicitud]){ ?> selected="selected"<?php }?> ><?php echo $fields[nombre] ?></option>
                   <?php }?>
                 </select>
               </label></td>
             </tr>
             <tr>
               <td>Prioridad:</td>
               <td><input type="text" name="prioridad" id="txt_input" readonly="readonly"  value="<?php echo $datos_siglo[0][prioridad] ?>" /></td>
             </tr>
             <tr>
               <td>Peticionario:</td>
               <td>
                 <input type="text" name="peticionario" id="txt_input" class="required" value="<?php echo $datos_siglo[0][peticionario] ?>"/>            </td>
             </tr>
             <tr>
               <td>C&eacute;dula:</td>
               <td><input type="text" name="cedula" id="txt_input" value="<?php echo $datos_siglo[0][cedula] ?>"  /></td>
             </tr>
             <tr>
               <td>T&eacute;lefono:</td>
               <td><input type="text" name="telefono" id="txt_input"  value="<?php echo $datos_siglo[0][telefono] ?>" /></td>
             </tr>
             <tr>
               <td>Folios:</td>
               <td>
                 <input type="text" name="folios" id="txt_input7" class="required number" value="<?php echo $datos_siglo[0][folios] ?>" />             </td>
             </tr>
             <tr>
               <td>Recibe:</td>
               <td><label><input name="recibe" type="hidden" value="<?php echo $_SESSION['idUsuario'];?>" />
                 <select name="recibe1" class="required" id="sl_input"  disabled="disabled" >
                   <option value="<?php echo $_SESSION['idUsuario'];?>" ><?php echo $_SESSION['nombre']; ?></option>
                 </select>
               </label></td>
             </tr>
             <tr>
               <td>Ubicaci&oacute;n:</td>
               <td><?php $ubi=$datos_siglo[0][ubicacion] ;
			   if($ubi=='0000'){
				$ubica="Sin Ubicación";
					}	 
				if($ubi=='0001'){
				$ubica="Despacho";
					}	 
				if($ubi=='0002'){
				$ubica="Secretaria";
					}
					if($ubi=='0003'){
						 $ubica="Secretaria Términos";
						 }
						 if($ubi=='0004'){
						 $ubica="Secretaria Letra";
						 }
						 if($ubi=='0005'){
						 $ubica="Secretaria Oficios";
						 }
						 if($ubi=='0006'){
						 $ubica="Secretaria Telegramas";
						 }
						 if($ubi=='0007'){
						 $ubica="Secretaria Edictos";
						 }
						 if($ubi=='0008'){
						 $ubica="Secretaria - Liquidaciones";
						 }
						 if($ubi=='0009'){
						 $ubica="Secretaria - Despachos Comisorios";
						 }
						 if($ubi=='0010'){
						 $ubica="Tribunal Superior de Bogotá";
						 }
						 if($ubi=='0011'){
						 $ubica="Corte Suprema de Justicia";
						 }
						 if($ubi=='0012'){
						 $ubica="Despacho de origen";
						 }
						 if($ubi=='0015'){
						 $ubica="Archivo";
						 }
						 if($ubi=='0017'){
						 $ubica="Secretaria - Notificaciones";
						 }
						 if($ubi=='0018'){
						 $ubica="Secretaria - Remates";
						 }
						 if($ubi=='0019'){
						 $ubica="Secretaria - Certificación";
						 }
						 if($ubi=='0021'){
						 $ubica="Secretaria - Pruebas";
						 }
						  if($ubi=='0022'){
						 $ubica="Consejo Seccional de la Judicatura";
						 }
						  if($ubi=='0024'){
						 $ubica="Secretaria - Traslados";
						 }
						  if($ubi=='0025'){
						 $ubica="Secretaría - Oficio envio Juzgado";
						 }
						  if($ubi=='0026'){
						 $ubica="Secretaria- volver al Despacho";
						 }
						 if($ubi=='0027'){
						 $ubica="Secretaria Concilaciones";
						 }
						 if($ubi=='0028'){
						 $ubica="Secretaria Rechazadas";
						 }
						
						 if($ubi=='0031'){
						 $ubica="Secretaria - Estados";
						 }
						 if($ubi=='0033'){
						 $ubica="Secretaría- Copias";
						 }
						 if($ubi=='0033'){
						 $ubica="Secretaría- Copias";
						 }
						 if($ubi=='0034'){
						 $ubica="Oficina Piloto de Ejecución Civil";
						 }
						 if($ubi=='0035'){
						 $ubica="Secretaria - Elaboracion Ttulos";
						 }
						 if($ubi=='0066'){
						 $ubica="Juz. Civl Mpal Desgonestión";
						 }
						 if($ubi=='0067'){
						 $ubica="Secretaria - Procesos Desarchivados";
						 }
						 if($ubi=='0068'){
						 $ubica="Secretaria - Terminados";
						 }
						 if($ubi=='0069'){
						 $ubica="Secretaria Correspondencia";
						 }
						 if($ubi=='0070'){
						 $ubica="Secretaria  Terminos Ley 1194/2008";
						 }	 
			   
						  ?>
                 <input name="ubicacionSiglo" type="text"  id="sl_input"  value="<?php echo  $ubica ?>" disabled="disabled" />
                 </td>
             </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Registrar" id="btn_input" >
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
