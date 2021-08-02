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
function llenar(frm,op)
{



if(op==1){
   for (i=0;i<document.frm.elements.length;i++) 
      if(document.frm.elements[i].type == "checkbox")	
         document.frm.elements[i].checked=1 
 
}
if(op==2){

   for (i=0;i<document.frm.elements.length;i++) 
      if(document.frm.elements[i].type == "checkbox")	
         document.frm.elements[i].checked=0 
 
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
        <div id="titulo_frm">
          <p>Registrar Informe Archivo Gesti&oacute;n </p>
          <p>
            <label></label>
          </p>
        </div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>Seleccione el a&ntilde;o:</td>
      <td><select name="ano" size="1" class="required" id="sl_input" onchange="validar_ano(frm)" >
        <option value="">Seleccione el año</option>
        <option value="2013">2013</option>
        <option value="2014">2014</option>
        <option value="2015">2015</option>
        <option value="2016">2016</option>
        <option value="2017">2017</option>
      </select></td>
    </tr>
    <?php
	$i=1;
	$campo= "";
	 while($field = $datos_anos->fetch()){
	 $campo= $campo.$field[ano].",";
	?>
   
    <?php 
	$i=$i+1;
	}
	if($i>0)
	{
	 $cont=$i-1;
	}
	else
	{
	 $cont=0;
	}
	//echo $campo;
	
	?>
     
      <input name="campo" type="hidden" value="<?php echo $campo;?>" />
     <input name="contador" type="hidden" value="<?php echo $cont;?>" />
     <tr>
      <td>Seleccionar:</td>
      <td><p align="left">   
          <input type="radio" name="seleccion" id="radio" value="1" onclick="llenar(frm,1)" />
        Todos 
        <input type="radio" name="seleccion" id="radio2" value="2" onclick="llenar(frm,2)" />
        Ninguno        </p></td>
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
            <td width="34">Familia</td>
            <td width="54">Juzgado 1 Familia</td>
            <td width="42"><label>
              <div align="center">
                  <input name="j1f_enero" type="checkbox" id="j1f_enero" value="1"/>
                </div>
                <div align="center"></div>
            </label></td>
            <td width="54"><div align="center">
              <input type="checkbox" name="j1f_febrero" id="j1f_febrero" value="1" />
            </div></td>
            <td width="46"><div align="center">
              <input type="checkbox" name="j1f_marzo" id="j1f_marzo" value="1" />
            </div></td>
            <td width="37"><div align="center">
              <input type="checkbox" name="j1f_abril" id="j1f_abril" value="1" />
            </div></td>
            <td width="42"><div align="center">
              <input type="checkbox" name="j1f_mayo" id="j1f_mayo" value="1" />
            </div></td>
            <td width="38"><div align="center">
              <input type="checkbox" name="j1f_junio" id="j1f_junio" value="1" />
            </div></td>
            <td width="34"><div align="center">
              <input type="checkbox" name="j1f_julio" id="j1f_julio" value="1" />
            </div></td>
            <td width="49"><div align="center">
              <input type="checkbox" name="j1f_agosto" id="j1f_agosto" value="1" />
            </div></td>
            
            <td width="83"><div align="center">
                          
              <input type="checkbox" name="j1f_septiembre" id="j1f_septiembre" value="1" />
            </div></td>
            <td width="50"><div align="center">
              <input type="checkbox" name="j1f_octubre" id="j1f_octubre" value="1" />
            </div></td>
            <td width="68"><div align="center">
              <input type="checkbox" name="j1f_noviembre" id="j1f_noviembre" value="1" />
            </div></td>
            <td width="323"><div align="center">
              <input type="checkbox" name="j1f_diciembre" id="j1f_diciembre" value="1" />
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 2 Familia</td>
            <td><div align="center">
              <input type="checkbox" name="j2f_enero" id="checkbox13" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_febrero" id="checkbox14" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_marzo" id="checkbox15" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_abril" id="checkbox16" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_mayo" id="checkbox17" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_junio" id="checkbox18" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_julio" id="checkbox19" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_agosto" id="checkbox20" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_septiembre" id="checkbox21" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_octubre" id="checkbox22" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_noviembre" id="checkbox23" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2f_diciembre" id="checkbox24" value="1" />
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 3 Familia</td>
            <td><div align="center">
              <input type="checkbox" name="j3f_enero" id="checkbox13" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_febrero" id="checkbox14" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_marzo" id="checkbox15" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_abril" id="checkbox16" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_mayo" id="checkbox17" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_junio" id="checkbox18" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_julio" id="checkbox19" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_agosto" id="checkbox20" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_septiembre" id="checkbox21" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_octubre" id="checkbox22" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_noviembre" id="checkbox23" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3f_diciembre" id="checkbox24" value="1" />
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 4 Familia</td>
           <td><div align="center">
              <input type="checkbox" name="j4f_enero" id="checkbox13"  value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_febrero" id="checkbox14" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_marzo" id="checkbox15" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_abril" id="checkbox16" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_mayo" id="checkbox17" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_junio" id="checkbox18" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_julio" id="checkbox19" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_agosto" id="checkbox20" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_septiembre" id="checkbox21" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_octubre" id="checkbox22" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_noviembre" id="checkbox23" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4f_diciembre" id="checkbox24" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 5 Familia</td>
            <td><div align="center">
              <input type="checkbox" name="j5f_enero" id="checkbox13" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_febrero" id="checkbox14" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_marzo" id="checkbox15" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_abril" id="checkbox16" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_mayo" id="checkbox17" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_junio" id="checkbox18" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_julio" id="checkbox19" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_agosto" id="checkbox20" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_septiembre" id="checkbox21" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_octubre" id="checkbox22" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_noviembre" id="checkbox23" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5f_diciembre" id="checkbox24" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 6 Familia</td>
            <td><div align="center">
              <input type="checkbox" name="j6f_enero" id="checkbox13" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_febrero" id="checkbox14" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_marzo" id="checkbox15" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_abril" id="checkbox16" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_mayo" id="checkbox17" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_junio" id="checkbox18" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_julio" id="checkbox19" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_agosto" id="checkbox20" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_septiembre" id="checkbox21" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_octubre" id="checkbox22" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_noviembre" id="checkbox23" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6f_diciembre" id="checkbox24" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Familia</td>
            <td>Juzgado 7 Familia</td>
            <td><div align="center">
              <input type="checkbox" name="j7f_enero" id="checkbox13" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_febrero" id="checkbox14" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_marzo" id="checkbox15" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_abril" id="checkbox16" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_mayo" id="checkbox17" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_junio" id="checkbox18" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_julio" id="checkbox19" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_agosto" id="checkbox20" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_septiembre" id="checkbox21" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_octubre" id="checkbox22" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_noviembre" id="checkbox23" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7f_diciembre" id="checkbox24" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 1 civil del circuito</td>
            <td><div align="center">
              <input type="checkbox" name="j1c_enero" id="checkbox85" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_septiembre" id="checkbox93" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1c_diciembre" id="checkbox96" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 2 civil del circuito</td>
            <td><div align="center">
              <input type="checkbox" name="j2c_enero" id="j2c_enero" value="1"/>
            </div></td>
           <td><div align="center">
              <input type="checkbox" name="j2c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_septiembre" id="checkbox93" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2c_diciembre" id="checkbox96" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 3 civil del circuito</td>
            <td><div align="center">
              <input type="checkbox" name="j3c_enero" id="j2c_enero" value="1"/>
            </div></td>
           <td><div align="center">
              <input type="checkbox" name="j3c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_septiembre" id="checkbox93" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3c_diciembre" id="checkbox96" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 4 civil del circuito</td>
           <td><div align="center">
              <input type="checkbox" name="j4c_enero" id="j4c_enero" value="1"/>
            </div></td>
           <td><div align="center">
              <input type="checkbox" name="j4c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_septiembre" id="checkbox93" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4c_diciembre" id="checkbox96" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 5 civil del circuito</td>
           <td><div align="center">
              <input type="checkbox" name="j5c_enero" id="checkbox85" value="1"/>
            </div></td>
           <td><div align="center">
              <input type="checkbox" name="j5c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input name="j5c_septiembre" type="checkbox" id="checkbox93" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5c_diciembre" id="checkbox96" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Circuito</td>
            <td>Juzgado 6 civil del circuito</td>
           <td><div align="center">
              <input type="checkbox" name="j6c_enero" id="checkbox85" value="1"/>
            </div></td>
           <td><div align="center">
              <input type="checkbox" name="j6c_febrero" id="checkbox86" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_marzo" id="checkbox87" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_abril" id="checkbox88" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_mayo" id="checkbox89" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_junio" id="checkbox90" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_julio" id="checkbox91" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_agosto" id="checkbox92" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_septiembre" id="checkbox93" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_octubre" id="checkbox94" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_noviembre" id="checkbox95" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6c_diciembre" id="checkbox96"  value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 1 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_febrero" id="checkbox138" value="1" />
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j1cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 2 civil municipal</td>
           <td><div align="center">
              <input type="checkbox" name="j2cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j2cm_diciembre" id="checkbox168" value="1"/>
            </div></td>         
            </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 3 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j3cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 4 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j4cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 5 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j5cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 6 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j6cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 7 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j7cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 8 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j8cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 9 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j9cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 10 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j10cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 11 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j11cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
          <tr>
            <td>Municipal</td>
            <td>Juzgado 12 civil municipal</td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_enero" id="j1cm_enero" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_febrero" id="checkbox138" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_marzo" id="checkbox159" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_abril" id="checkbox160" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_mayo" id="checkbox161" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_junio" id="checkbox162" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_julio" id="checkbox163" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_agosto" id="checkbox164" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_septiembre" id="checkbox165" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_octubre" id="checkbox166" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_noviembre" id="checkbox167" value="1"/>
            </div></td>
            <td><div align="center">
              <input type="checkbox" name="j12cm_diciembre" id="checkbox168" value="1"/>
            </div></td>
          </tr>
        </table>
        <table width="691" border="0" cellpadding="0" cellspacing="0" id="frm_editar">
        <tr>
        <td><input type="submit" name="Submit" value="Registrar" id="btn_input">
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
