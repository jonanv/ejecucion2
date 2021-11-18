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

<div id="titulo_frm">Consultar Seguimiento</div>

  <?php 

while($field = $datos_seguimientos->fetch()){?>

  <table border="0" align="center" cellpadding="0" cellspacing="0" id="frm_editar">

  <tr>

    <td width="150"><div id="txtnegro">Responsable:</div></td>

    <td width="272"><?php echo $field[empleado];?></td>

    <td width="150"><div id="txtnegro">Fecha:</div></td>

    <td><?php echo $field[fecha];?></td>
  </tr>

  <tr>

    <td><div id="txtnegro">Juzgado:</div></td>

    <td><?php echo $field[juzgadonom];?></td>

    <td><div id="txtnegro">Desde :</div></td>

    <td width="272"><?php echo $field[desde];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Hasta:</div></td>

    <td><?php echo $field[hasta];?></td>

    <td><div id="txtnegro">Procesos:</div></td>

    <td><?php echo $field[procesos];?></td>
    </tr>

  <tr>

    <td><div id="txtnegro">Consecutivo:</div></td>

    <td><?php echo $field[consecutivo];?></td>

    <td><div id="txtnegro">Gancho:</div></td>

    <td><?php if($field[r_gancho]==0) echo "NO"; else echo "SI";?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Coser:</div></td>
    <td><?php if($field[r_coser]==0) echo "NO"; else echo "SI";?></td>
    <td><div id="txtnegro">Foliar</div></td>
    <td><?php if($field[r_foliar]==0) echo "NO"; else echo "SI";?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Siglo XXI:</div></td>
    <td><?php if($field[r_siglo]==0) echo "NO"; else echo "SI";?></td>
    <td><div id="txtnegro">SAIDOJ:</div></td>
    <td><?php if($field[r_gancho]==0) echo "NO"; else echo "SI";?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Procesos faltantes:</div></td>
    <td><?php echo $field[procesos_faltantes];?></td>
    <td><div id="txtnegro">Tiempo incumplimiento:</div></td>
    <td><?php echo $field[tiempo_incumplimiento];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Observaciones:</div></td>
    <td><?php echo $field[observaciones];?></td>
    <td><div id="txtnegro">Observaciones Revisor:</div></td>
    <td><?php echo $field[observaciones_revisor];?></td>
  </tr>
  <tr>
    <td><div id="txtnegro">Causales Incumplimiento:</div></td>
    <td><?php echo $field[causales];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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

