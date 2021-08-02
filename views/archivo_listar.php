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

location.href="index.php?controller=archivo&action=show_seguimiento&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=archivo&action=edit_seguimiento&nombre="+variable;
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
    <p>
  <!---->
  <?php require 'header.php'; ?>
  <!---->
  <?php require 'secc_archivo.php'; ?>
      
  <!---->
      
    </p>
<table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">Lista de Seguimientos</div>
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
    <th>&nbsp;</th>
    <th colspan="6">Información de Caja</th>
    <th>Información de Incumplimiento</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  <tr>
    <th>Responsable</th>
	<th>Fecha </th>
    <th>Juzgado</th>
	<th>Desde</th>
	<th>Hasta </th>
	<th># Procesos</th>
	<th>Consecutivo</th>
	<th>Procesos Faltantes</th>
	<th>Tiempo Incumplimiento</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp; </th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
<?php 
 while($field = $datos_seguimientos->fetch()){?>
  <tr>
       <td><?php echo $field[responsable];?></td>
	<td><?php echo $field[fecha];?></td>
	 <td><?php echo $field[nombre];?></td>
	 <td><?php echo $field[desde];?></td>
		<td><?php echo $field[hasta];?></td>
	    <td><?php echo $field[procesos];?></td>
	    <td><?php echo $field[consecutivo];?></td>
	    <td><?php echo $field[procesos_faltantes];?></td>
	    <td><?php echo $field[tiempo_incumplimiento];?></td>
	    <td></td>
	    <td><span style="cursor:pointer"><img src="views/images//list.png" width="21" height="23" onclick="vinculo(<?php echo $field[id];?>)" title="Consultar Seguimiento"/></span></td>
	<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1(<?php echo $field[id];?>)" title="Modificar Seguimiento" /></td>
    <td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo2(<?php echo $field[id];?>)" title="Eliminar Seguimiento" /></td>
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
