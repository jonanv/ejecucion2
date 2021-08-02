<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
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
<script>
function vinculo(frm)
{
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable=frm.juzgado.value;

//alert(variable);

location.href="index.php?controller=archivo&action=ReporteEntrantesSalientes1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2;
//document.write(location.href) 

}
</script>
<style type="text/css">
<!--
.Estilo3 {font-size: 18px; }
-->
</style>
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
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">

<div id="titulo_frm">Reporte Entrantes vs Salientes</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
          <?php
		  $i=$j=$k=$t=1;
		  
	  
		  
 while($fielde = $datos_entrantes->fetch()){
       $vector_e[$i][cajase]   =$fielde[cajase];
	   $vector_e[$i][expee]    =$fielde[expee];
	   $vector_e[$i][nom_juze] =$fielde[juzgado];
	   $vector_e[$i][id_juze] =$fielde[idjuz];
	   $vector_e[$i][prestados] =$fielde[prestados];

		$i++;
 }
  $cont = count($vector_e);
  while($fields = $datos_salientes->fetch()){
       $vector_s[$j][cajass]   =$fields[cajassalientes];
	   $vector_s[$j][expes]    =$fields[expedientessalientes];
	   $vector_s[$j][nom_juzs] =$fields[juzgado];
	   $vector_s_idjuz[$j]=$fields[idjuz];
	   $j++;
	
 }
$sum_cajas=0;
$sum_expedientes=0;
  
 ?>
 
 <?php while ($k<=$cont) {?>   
    
      <td colspan="4"><div align="center" style="background:#CCCCCC"><strong>Juzgado: <?php echo $vector_e[$k][nom_juze];?> </strong></div> </td>
      </tr>
    <tr>
      <td>&nbsp;</td>

      <td><strong> Entrantes</strong></td>
      <td><strong>Salientes</strong></td>
      <td><strong>Prestados</strong></td>
    </tr>
      <tr>
      <td><strong>Cajas:</strong></td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo   $vector_e[$k][cajase]; $sum_cajas=$sum_cajas+$vector_e[$k][cajase];?>	</td>
      <td><?php   
	   $pos="";
	   $pos=array_search($vector_e[$k][id_juze],$vector_s_idjuz);

	    if($pos!="")
	   	   echo  $vector_s[$pos][cajass];
	   ?></td>
      <td></td>
      </tr>
      <tr>
        <td><strong>Expedientes:</strong></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vector_e[$k][expee];$sum_expedientes=$sum_expedientes+$vector_e[$k][expee]; ?></td>
        <td><?php   
	   $pos="";
	   $pos=array_search($vector_e[$k][id_juze],$vector_s_idjuz);

	    if($pos!="")
	   	   echo  $vector_s[$pos][expes];
	   ?></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo   $vector_e[$k][prestados]; ?></td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr> 
   <?php $k++;}?> 
   <tr>
    <td colspan="2"><div align="center" class="Estilo3" style="background:#CCCCCC">
      <div align="center"><strong>Total Cajas </strong></div>
    </div>      
      <div align="center" class="Estilo3"><?php echo $sum_cajas;?></div></td>
    <td colspan="2"><div align="center" class="Estilo3" style="background:#CCCCCC">
      <div align="center"><strong>Total Expedientes </strong></div>
    </div>      
      <div align="center" class="Estilo3"><?php echo $sum_expedientes;?></div></td>
    </tr> 
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
