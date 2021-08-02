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
          <p>Informe Archivo Gesti&oacute;n </p>
          <p>&nbsp;</p>
        </div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>A&ntilde;o:</td>
      <td><strong><?php echo $_GET['nombre'];?></strong></td>
    </tr>
     
    
</table>
        <table width="652" border="1" cellpadding="0" cellspacing="0" id="frm_editargrande">
          <tr>
            <td width="30"><strong>&Aacute;rea</strong></td>
            <td width="49"><strong>Juzgado</strong></td>
            <td width="36"><strong>Enero</strong></td>
            <td width="49"><strong>Febrero</strong></td>
            <td width="40"><strong>Marzo</strong></td>
            <td width="30"><strong>Abril</strong></td>
            <td width="36"><strong>Mayo</strong></td>
            <td width="31"><strong>Junio</strong></td>
            <td width="27"><strong>Julio</strong></td>
            <td width="44"><strong>Agosto</strong></td>
            <td width="70"><strong>Septiembre</strong></td>
            <td width="50"><strong>Octubre</strong></td>
            <td width="68"><strong>Noviembre</strong></td>
            <td width="62"><strong>Diciembre</strong></td>
          </tr>
          <tr>
            <?php
	$conte =$contf=$contm=$conta=$contmy=$contj=$contjl=$contag=$conts=$conto=$contn=$contd=0;
	$conte1 =$contf1=$contm1=$conta1=$contmy1=$contj1=$contjl1=$contag1=$conts1=$conto1=$contn1=$contd1=0;	
	 while($field = $datos_gestion->fetch()){ ?>
          
          
            <td width="30"><?php echo $field[area];?></td>
            <td width="49"><?php echo $field[juzgado];?></td>
            <td width="36"><label>
              <div align="center"><?php if($field[enero]==1){echo "R"; $conte=$conte+1;}			
			else{?><span class="Estilo1"><?php echo "F";$conte1=$conte1+1;}?></span></div><div align="center"></div></label></td>
            <td width="49"><div align="center">
              <?php if($field[febrero]==1){echo "R";$contf=$contf+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contf1=$contf1+1;}?></span></div></td>
            <td width="40"><div align="center">
              <?php if($field[marzo]==1){echo "R";$contm=$contm+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contm1=$contm1+1;}?></span></div></td>
            <td width="30"><div align="center">
              <?php if($field[abril]==1){echo "R";$conta=$conta+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$conta1=$conta1+1;}?></span></div></td>
            <td width="36"><div align="center">
              <?php if($field[mayo]==1){echo "R";$contmy=$contmy+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contmy1=$contmy1+1;}?></span></div></td>
            <td width="31"><div align="center">
              <?php if($field[junio]==1){echo "R";$contj=$contj+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contj1=$contj1+1;}?></span></div></td>
            <td width="27"><div align="center">
              <?php if($field[julio]==1){echo "R";$contjl=$contjl+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contjl1=$contjl1+1;}?></span></div></td>
            <td width="44"><div align="center">
              <?php if($field[agosto]==1){echo "R";$contag=$contag+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contag1=$contag1+1;}?></span></div></td>
            
            <td width="70"><div align="center">
              <?php if($field[septiembre]==1){echo "R";$conts=$conts+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$conts1=$conts1+1;}?></span></div></td>
            <td width="50"><div align="center">
              <?php if($field[octubre]==1){echo "R";$conto=$conto+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$conto1=$conto1+1;}?></span></div></td>
            <td width="68"><div align="center">
              <?php if($field[noviembre]==1){echo "R";$contn=$contn+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contn1=$contn1+1;}?></span></div></td>
            <td width="62"><div align="center">
              <?php if($field[diciembre]==1){echo "R";$contd=$contd+1;}			
			else{?>
              <span class="Estilo1"><?php echo "F";$contd1=$contd1+1;}?></span></div></td>
          </tr>
           <?php }?>
          <tr>
            <td colspan="2"><strong class="Estilo1">FALTA</strong>              <div align="center"></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $conte1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contf1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contm1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $conta1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contmy1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contj1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contjl1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $conta1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $conts1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $conto1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contn1;?></span></strong></div></td>
            <td><div align="center"><strong><span class="Estilo1"><?php echo $contd1;?></span></strong></div></td>
          </tr>
          <tr>
            <td colspan="2"><strong>REALIZADO</strong>              <div align="center"></div></td>
            <td><div align="center"><strong><?php echo $conte;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contf;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contm;?></strong></div></td>
            <td><div align="center"><strong><?php echo $conta;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contmy;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contj;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contjl;?></strong></div></td>
            <td><div align="center"><strong><?php echo $conta;?></strong></div></td>
            <td><div align="center"><strong><?php echo $conts;?></strong></div></td>
            <td><div align="center"><strong><?php echo $conto;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contn;?></strong></div></td>
            <td><div align="center"><strong><?php echo $contd;?></strong></div></td>
          </tr>
        </table>
        <table width="691" border="0" cellpadding="0" cellspacing="0" id="frm_editar">
           <tr>
        <td><p>&nbsp;</p>
          <p><strong>*Nota: Donde R: Realizado,<span class="Estilo1"> F: Faltante</span></strong></p></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
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
