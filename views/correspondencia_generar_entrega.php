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
        <div id="titulo_frm">Generar Entrega</div>


<table width="2323" border="0" cellpadding="0" cellspacing="0" class="display" id="frm_editar">
      <thead>
                    <tr>
                      <th width="18">Radicado</th> 
                         <th width="333" height="39">Tipo Documento</th>
	                     <th width="146">Tiene Expediente </th>
                         <th width="157">Folios</th>
	                     <th width="188">Solicitud</th>
                      <th width="224">Juzgado Destino</th>
    </tr>
  </thead>
  <tbody>                  
                    <tr>
                      
                    
<?php                    
print_r($datos_entrega);
 while($field = $datos_documentos->fetch()){ 


 ?>

<td><label></label></td>
    <td ><span class="Estilo2"><?php echo $field[fecha_registro];?></span></td>
	<td ><span class="Estilo2"><?php echo $field[radicado];?></span></td>
	<td ><span class="Estilo2"><?php echo $field[peticionario];?></span></td>
	<td ><span class="Estilo2"><?php echo $field[tipo_documento];?></span></td>
	<td ><span class="Estilo2"><?php echo $field[destino];?></span></td>
    </tr>
                    
<?php }?>
                <tr>
                  <td>                  
                </thead>
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
