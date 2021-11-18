<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?=titulo?></title>

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



</head>

<body>

<!---->

<?php require 'header.php'; require 'secc_qrs.php'; ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">

      <tr>

        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>

      </tr>

      <tr>

        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">

<div id="contenido">

<form id="frm" name="frm" method="post" action="">

<table width="778" border="1" cellpadding="0" cellspacing="0" id="frm_editar">

  

<tbody>
<?php
$i=1; 
 while($field = $datos_log->fetch()){
  $vector[$i]=$field[detalleLogcrm];
  $foto[$i]=$field[fotoLogcrm];
 $i++;
 $cont=$i;
 }
 ?>
<?php 
$cont=$cont-1;
$j=1;
$i=0;

$cont= intval($cont);
if($cont%2==0)
{
$cont=($cont/2);
}
else{
$cont=($cont/2)+1;}


while($j<=$cont){ 

$l=$i+$j;
echo $foto[l];

?>

  <tr>

    <td><p>&nbsp;</p>

      <p><img src="<?php echo $foto[$l];?>" width="46" height="46" /><?php echo $vector[$l];?></p>

      <p>&nbsp;</p>

      <p>&nbsp;</p></td>

	<td><p>&nbsp;</p>

	  <p><img src="<?php echo $foto[$l+1];?>" width="46" height="46" /><?php echo $vector[$l+1];?></p>

	  <p>&nbsp;</p>

	  <p>&nbsp;</p></td>

	</tr>

	  
<?php  $j++;$i++; }?>
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

