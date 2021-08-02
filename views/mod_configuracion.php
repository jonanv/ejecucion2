<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo titulo?></title>

<script src="views/js/jquery.js" type="text/javascript"></script>

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>

<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

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

</head>

<body>

<!---->

<?php require 'header.php'//if($_SESSION['rol']=='Administrador'){require 'header.php';}else{require 'headerproduccion.php';}  ?>

<!---->

<?php require 'secc_configuracion.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr>

        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>

      <tr>

        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">

<div id="contenido">

<form id="frm" name="frm" method="post" action="">

<div id="titulo_frm">Datos Personales</div>

<?php $img=$_SESSION['foto'];?>

<?php //while($field = $listdata->fetch()){ //echo $img;?> 

<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">

  <tr>

    <td width="110" rowspan="3" style="background:#FFF"><img src="<?php echo $img;?>" width="110" height="125" /></td>
<?php 

  while($field = $listdata->fetch()){?>
    <td width="150"><div id="txtnegro">Nombre:</div></td>

    <td width="272"><?php echo $field[empleado];?></td>

    <td width="150"><div id="txtnegro">C&eacute;dula:</div></td>

    <td><?php echo $field[nombre_usuario];?></td>
  </tr>

  <tr>
    <td><div id="txtnegro">Área:</div></td>

    <td><?php echo $field[nombre];?></td>

    <td></td>

    <td width="272">&nbsp;</td>
    </tr>

  <tr>
    <td colspan="4">&nbsp;</td>
    </tr>
  </table>

  <?php }?>
</form>
</div>		</td>
      </tr>

      <tr>

        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>

<?php require 'alertas.php';?>



</body>

</html>