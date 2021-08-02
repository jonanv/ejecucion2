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
function activar(frm,cont)
{

 if(document.frm.todos.checked==true)
  {
    numero =0;
	while (numero<cont)
	{
	 document.getElementById('juz'+numero).disabled=true;
	 document.getElementById('juz'+numero).checked=false;
	
	 numero++;
	} 
	 
  }
  else
  {
    numero =0;
	while (numero<cont)
	{
	 document.getElementById('juz'+numero).disabled=false;
	 numero++;
    }

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
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Generar Plantilla 4-72</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td>Seleccione la fecha:</td>
      <td><input name="fechai" type="text" class="required tinicio" id="txt_input" readonly="readonly"/>
  	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
    </tr>
        <?php $i = 0;
 while($fieldj = $datos_juzgados->fetch()){
 $vec_juzgados[$i][nombre] = $fieldj[nombre];
 $vec_juzgados[$i][id] = $fieldj[id];
 
  $i++;}
  $cont = count($vec_juzgados);
 ?>
    <tr>
      <td>Todos los juzgados:</td>
      <td><label>
        <input name="todos" type="checkbox" id="todos" value="Todos" onclick="activar(frm,<?php echo $cont;?>)" />
        <input type="hidden" name="contador" id="hiddenField" value="<?php echo $cont;?>" />
      </label></td>
    </tr>

      <tr>
        <td>Juzgados:</td>
        <td>   <p>
          <?php
$j = 0;

while($j<$cont){ 
?>  
          <input name="<?php echo "juz".$j;?>" id="<?php echo "juz".$j;?>" type="checkbox" value="<?php echo $vec_juzgados[$j][id]; ?>" /> 
          <?php echo $vec_juzgados[$j][nombre]; ?><br />
              <?php 
$j++;
}

  
 ?>
        </p>
          <p>
            <label></label>
</p></td>
      </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Generar" id="btn_input" onclick="vinculo(frm)">
      <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
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
