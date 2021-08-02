<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?=titulo?></title>

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

<?php require 'secc_eventos.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center">

      <tr>

        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>

      </tr>

      <tr>

        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">

<div id="contenido">

<form id="frm" name="frm" method="post" action="">

<div id="titulo_frm">Consultar Calendario</div>

<table width="557" border="0" cellpadding="0" cellspacing="0" id="frm_editar">

<tr>

<td><iframe name="f2" height="650" width="800" frameborder="0" allowtransparency="yes" src="views/calendar/calendar.php" scrolling="no"><?php require 'views/calendar/calendar.php';?></iframe></td>

</tr>

   </table>

  </form>

</div>		

		</td>

      </tr>

      <tr>

        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>

      </tr>
<?php //require 'alertas.php';?>
    </table>

</body>

</html>