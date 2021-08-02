<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

<title><?php echo titulo?></title>

<script src="views/js/jquery.js" type="text/javascript"></script>

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>

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

        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">

<div id="contenido">

<form id="frm" name="frm" method="post" action="">

<div id="titulo_frm">Consultar Acta Recibido</div>

  <?php 

while($field = $datos_inventario->fetch()){?>

  <table border="0" align="center" cellpadding="0" cellspacing="0" id="frm_editar">

  <tr>

    <td width="150"><div id="txtnegro">Consecutivo Acta:</div></td>

    <td width="272"><?php echo $field[consecutivo_acta];?></td>

    <td width="150"><div id="txtnegro">Fecha:</div></td>

    <td><?php echo $field[fecha_acta];?></td>
  </tr>

  <tr>

    <td><div id="txtnegro">Juzgado:</div></td>

    <td><?php echo $field[nombre];?></td>

    <td><div id="txtnegro">Responsable:</div></td>

    <td width="272"><?php echo $field[responsable];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Meses Archivar:</div></td>

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

    <td><div id="txtnegro">A&ntilde;o Archivar:</div></td>

    <td><?php echo $field[ano_archivar];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Consecutivo Cajas desde:</div></td>

    <td><?php echo $field[desde_caja];?></td>

    <td><div id="txtnegro">Consecutivo Cajas hasta:</div></td>

    <td><?php echo $field[hasta_caja];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Consecutivo Expedientes desde:</div></td>
    <td><?php echo $field[desde_expediente];?></td>
    <td><div id="txtnegro">Consecutivo Expedientes hasta:</div></td>
    <td><?php echo $field[hasta_expediente];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Cantidad Cajas:</div></td>
    <td><?php echo $field[cantidad_cajas];?></td>
    <td><div id="txtnegro">Cantidad Expedientes:</div></td>
    <td><?php echo $field[cantidad_expedientes];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Entrega:</div></td>
    <td><?php echo $field[nombre_entrega];?></td>
    <td><div id="txtnegro">Recibe:</div></td>
    <td><?php echo $field[nombre_recibe];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Observaciones:</div></td>
    <td><?php echo $field[observaciones];?></td>
    <td><?php if($field[cantidad_expedientes_prestados]>0){?><div id="txtnegro">Cantidad Expedientes Prestados:</div><?php }?></td>
    <td><?php echo $field[cantidad_expedientes_prestados];?></td>
  </tr>
  <tr>
    <td><?php if($field[cantidad_expedientes_prestados]>0){?><div id="txtnegro">Persona Préstamo:</div><?php }?></td>
    <td><?php echo $field[persona_presto];?></td>
    <td><?php if($field[cantidad_expedientes_prestados]>0){?><div id="txtnegro">Observaciones Préstamo:</div><?php }?></td>
    <td><?php echo $field[observaciones_prestamo];?></td>
  </tr>
  </table>

  <?php }?>

  </form>

</div>		

		</td>

      </tr>

      <tr>

        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>

      </tr>

    </table>

</body>

</html>

