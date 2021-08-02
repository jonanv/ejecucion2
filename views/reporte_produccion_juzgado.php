<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
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
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Reporte Producción Por Juzgado</div>
        <?php 
		
		$i=0;
		 foreach ($datos_despachos as $indice => $valor){ 
		 $vector[$i][juzgados]= $valor;
		 $i = $i+1;
		 }
		 $i=0;
		 foreach ($datos_cajas as $indice => $valor){ 
		 $vector[$i][cajas]= $valor;
		 $i = $i+1;
		 }	
		  $i=0;
		 foreach ($datos_procesos as $indice => $valor){ 
		 $vector[$i][procesos]= $valor;
		 $i = $i+1;
		 }
		// print_r($vector);
		 $cont = count($vector);		 
		 ?>
		
	
        <img src="views/pie/pie.png" />
        <table width="200" border="1" align="center" id="frm_editar1">
       
          <tr>
            <td><strong>Despachos</strong></td>
            <td><strong>#Cajas</strong></td>
            <td><strong>#Procesos</strong></td>
          </tr>
          <?php $i=$sum_caj=$sum_pro=0;
		  
		  while ($i<$cont){
		  ?>
          <tr>
            <td><?php echo $vector[$i][juzgados];?></td>
            <td><?php echo $vector[$i][cajas];?></td>
            <td><?php echo $vector[$i][procesos];?></td>
          </tr>
<?php 
$sum_caj= $sum_caj+$vector[$i][cajas];
$sum_pro= $sum_pro+$vector[$i][procesos];
$i=$i+1;

}?> 
<tr>
            <td><strong>Totales</strong></td>
            <td><strong><?php echo $sum_caj;?></strong></td>
            <td><strong><?php echo $sum_pro;?></strong></td>
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
