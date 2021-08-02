<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

location.href="index.php?controller=correspondencia&action=show_correspondencia&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=edit_correspondencia&nombre="+variable;
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
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">Lista de Correspondencias</div>
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
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <thead>
  <tr>
    <th>Radicado</th>
	<th>Juzgado </th>
    <th>Destinatario</th>
	<th>Municipio </th>
	<th>Notificado?</th>
	<th>Medio Notificación</th>
	<th>Clase Proceso</th>
	<th>Fecha</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp; </th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
<?php 
 while($field = $datos_correspondencias->fetch()){?>
  <tr>
       <td><?php echo $field[radicado];?></td>
	<td><?php echo $field[juzgado];?></td>
	 <td><?php echo $field[destinatario];?></td>
		<td><?php echo $field[municipio];?></td>
	    <td><?php if ($field[notificado]=='S') {echo "SI";}else {echo "NO";}?></td>
	    <td><?php echo $field[medio];?></td>
	    <td><?php echo $field[clase];?></td>
	    <td><?php echo $field[fecha];?></td>
	    <td></td>
	    <td><span style="cursor:pointer"><img src="views/images//list.png" width="21" height="23" onclick="vinculo(<?php echo $field[idd];?>)" title="Consultar Correspondencia"/></span></td>
	<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1(<?php echo $field[idd];?>)" title="Modificar Correspondencia" /></td>
    <td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo2(<?php echo $field[idd];?>)" title="Eliminar Correspondencia" /></td>
 </tr>
<?php  }?>
  </tbody>
  </table>
</form> 
</div>
		
		</td>
      </tr>
      <tr>
        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>
	
		<?php require 'alertas.php';?>
</body>
</html>
