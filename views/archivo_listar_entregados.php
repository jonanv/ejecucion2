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

location.href="index.php?controller=archivo&action=show_inventariosaliente&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=archivo&action=edit_acta_saliente&nombre="+variable;
//document.write(location.href) 

}
function vinculo2(variable)
{
if(confirm('Realmente desea eliminar el acta de entrega?'))
{
location.href="index.php?controller=archivo&action=elim_inventarioSaliente&nombre="+variable;
//document.write(location.href) 
}
}
function vinculo4(variable)
{

location.href="index.php?controller=archivo&action=generarActarecibido&nombre=3&nombre1="+variable;
//document.write(location.href) 
}
</script>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_archivo.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">Lista de actas salientes</div>
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
    <th> Acta</th>
	<th>Fecha </th>
    <th>Juzgado</th>
	<th>Meses</th>
	<th>Año </th>
	<th>Cajas</th>
	<th>Expedientes</th>
	<th>Entrega</th>
	<th>Recibe</th>
	<th>&nbsp;</th>
	<th>&nbsp; </th>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>
  <tbody>
<?php 

 while($field = $datos_entregados->fetch()){?>
  <tr>
       <td><?php echo $field[consecutivo_acta_entrega];?></td>
	<td><?php echo $field[fecha_entrega];?></td>
	 <td><?php echo $field[nombre];?></td>
	 <td><?php $i=0;  
		if($field[enero]==1){
		$meses[$i] = "Enero"; $i=$i+1;}
		if($field[febrero]==1){
		$meses[$i] = "Febrero";$i=$i+1;}
		if($field[marzo]==1){
		$meses[$i] = "Marzo";$i=$i+1;}
		if($field[abril]==1){
		$meses[$i] = "Abril";$i=$i+1;}
		if($field[mayo]==1){
		$meses[$i] = "Mayo";$i=$i+1;}
		if($field[junio]==1){
		$meses[$i] = "Junio";$i=$i+1;}
		if($field[julio]==1){
		$meses[$i] = "Julio";$i=$i+1;}
		if($field[agosto]==1){
		$meses[$i] = "Agosto";$i=$i+1;}
		if($field[septiembre]==1){
		$meses[$i] = "Septiembre";$i=$i+1;}
		if($field[octubre]==1){
		$meses[$i] = "Octubre";$i=$i+1;}
		if($field[noviembre]==1){
		$meses[$i] = "Noviembre";$i=$i+1;}
		if($field[diciembre]==1){
		$meses[$i] = "Diciembre";$i=$i+1;}
		
		$j=0;
	 	$cont_mes= count($meses);
	  	$mes= "";
		//print_r($meses);
	  
	   while($j<$cont_mes)
	  	{
	   	if($j!=0)
	   	{
	    	$mes = $mes.", ";
	   	}
	   	$mes = $mes.$meses[$j];
	   	$j= $j+1;
	  
	  	}
		echo $mes;
		unset($meses);
		
		?></td>
	    <td><?php echo $field[ano_archivar];?></td>
	    <td><?php echo $field[cantidad_cajas];?></td>
	    <td><?php echo $field[cantidad_expedientes];?></td>
	    <td><?php echo $field[nombre_entrega_acta];?></td>
	    <td><?php echo $field[nombre_recibe_acta];?></td>
	    <td><span style="cursor:pointer"><img src="views/images//list.png" width="21" height="23" onclick="vinculo(<?php echo $field[id];?>)" title="Consultar Acta Entrega"/></span></td>
	<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1(<?php echo $field[id];?>)" title="Modificar Acta Entrega" /></td>
    <td style="cursor:pointer"><img src="views/images/download1.png" alt="" width="21" height="23" title="Generar Acta de Entrega" onclick="vinculo4(<?php echo $field[id];?>)" /></td>
    <td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo2(<?php echo $field[id];?>)" title="Eliminar Acta Entrega" /></td>
 </tr>
<?php }?>
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
