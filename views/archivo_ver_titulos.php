<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<script src="views/js/select_dependientes.js" type="text/javascript"></script>
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
	
	$("#btnExport").click(function(e) {
	
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
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

function vinculo(variable)
{
//alert(variable);
//location.href=variable;

 window.open(variable, "Evidencias", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=400")
//document.write(location.href) 

}
function eliminar()
{
//alert(variable);
//location.href=variable;

alert("entre");
//document.write(location.href) 

}

function validar_fecha(frm) { 
fecha = frm.fecha_acta.value;
dias_temp = frm.dias.value;
dias = dias_temp.split(",");
Array.prototype.in_array=function(){ 
    for(var j in this){ 
        if(this[j]==arguments[0]){ 
            return true; 
        } 
    } 
    return false;     
} 
if(dias.in_array(fecha)){
alert('La fecha seleccionada, corresponde a un día no hábil, seleccione otra fecha por favor');
//jAlert('This is a custom alert box', 'Alert Dialog');
frm.fecha_acta.value="";
}
else {

 }

}
</script>
<script type="text/javascript">
</script>
<script type="text/javascript" language="javascript">

--> 


</script>

<style type="text/css">
<!--
.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}
-->
</style>
</head>

<body>
<!----><!----><!---->
<!-- <div id="titulo_frm">
  <p>Lista de T&iacute;tulos <button type="button" id="btnExport" style="background:inherit; border:inherit"><img src="views/images/export_to_excel.gif" alt="Exportar Excel" title="Exportar Excel"/></button>
</div> -->

<div id="dvData">
<?php 
//$field_radicado = $datos_titulos->fetch();
//$radicado       = $field_radicado[radicado]; 
?>
<table cellpadding="0" cellspacing="0" border="0" class="display"  id="frm_editar" >
                <thead>
                    <tr>  
    <th width="50">radicado</th>                     
    <th width="50">Fecha</th> 
    <th width="66">Beneficiario</th>
    <th width="66">Valor</th>
    <th width="66">Fecha Pago</th>
	

                  <!-- </tr>
				  <tr>
				  	<th><?php //echo "Radicado: ".$radicado;?></th>
				  </tr> -->
  </thead>
  <tbody>       
                     
                    
 <?php 
 
 $cont=0;  
 while($field = $datos_titulos->fetch()){  
 ?>
<tr>
		<td><?php echo $field[radicado];?></td>
        <td><?php echo $field[fecha];?></td>
		<td><?php echo $field[beneficiario];?></td>
        <td><?php echo "$".number_format($field[valor], 2, ',', '.'); $cont = $cont + $field[valor]; ?></td>
        <td><?php echo $field[fechapago];?></td>
       
</tr><?php }?>
<tr>
  <td bgcolor="#CCCCCC"><span id="frm_editar">Total:</span></td>
  <td colspan="3" bgcolor="#CCCCCC"><span id="frm_editar"><span id="frm_editar"><?php echo "$".number_format($cont, 2, ',', '.'); ?></span></span></td>
  </tr>
                    
                   
                </thead>
</table>

 </div>

<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
</body>
</html>
