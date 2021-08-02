<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title><?php echo titulo;?></title>
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

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
</script>
<script>
function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=show_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=edit_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo2(variable)
{
if(confirm('Realmente desea eliminar el seguimiento?'))
{
location.href="index.php?controller=archivo&action=elim_seguimiento&nombre="+variable;
//document.write(location.href) 
}
}
</script>
<style type="text/css">
<!--
.Estilo1 {color: #1581AE}
-->
</style>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
      <tr>
        <td><img src="views/images/crm_fondo_top_2.png" width="1200" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body_2.png) repeat-y; ">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">Lista de Turnos</div>
<script type="text/javascript" src="views/js/jquery.quicksearch.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('table#frm_editar tbody tr').quicksearch({
				position: 'before',
				attached: 'table#listado',
				stripeRowClass: ['odd', 'even'],
				labelText: 'Buscar en la tabla'
			});

		});
	</script>
<table width="1102" border="0" cellpadding="0" cellspacing="0" id="frm_editar">
  <thead>
  <tr>
    <th width="117"><div align="center" class="Estilo1">Empleado</div></th>
	<th width="65"><div align="center" class="Estilo1">Área </div></th>
    <th width="96"><div align="center" class="Estilo1">Juzgado</div></th>
	<th width="142"><div align="center" class="Estilo1">Documento </div></th>
	<th width="96"><div align="center" class="Estilo1">N&uacute;mero</div></th>
	<th width="154"><div align="center" class="Estilo1">Tipo Proceso</div></th>
	<th width="112"><div align="center" class="Estilo1">Radicado</div></th>
	<th width="7"><div align="center"><span class="Estilo1"></span></div></th>
	<th width="113"><div align="center" class="Estilo1">Direcci&oacute;n</div></th>
	<th width="71"><div align="center" class="Estilo1">Fecha</div></th>
	<th width="129"><div align="center" class="Estilo1">Hora</div></th>
	</tr>
  </thead>
  <tbody>
<?php 
 while($field = $datos_turnos->fetch()){?>
  <tr>
       <td><?php echo $field[empleado];?></td>
	<td><?php echo $field[areaempleado];?></td>
	 <td><?php echo $field[juzgado];?></td>
		<td><?php echo $field[esOficio_Telegrama];?></td>
	    <td><?php echo $field[oficio_telegrama];?></td>
	    <td><?php echo $field[fecha];?></td>
	    <td><?php echo $field[radicado];?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $field[direccion];?></td>
	    <td><?php echo $field[fecha];?></td>
	    <td><?php echo $field[hora];?></td>
	    </tr>
<?php  }?>
  </tbody>
  </table>
</form> 
</div>
		
		</td>
      </tr>
      <tr>
        <td><img src="views/images/crm_fondo_foot_2.png" width="1200" height="40" /></td>
      </tr>
    </table>
	
		<?php require 'alertas.php';?>
</body>
</html>
