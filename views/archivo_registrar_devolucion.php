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
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Registrar Devoluci&oacute;n de Expediente</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
       <?php while($field = $datos_archivo->fetch()){?>
         <tr>
            <td>Fecha:</td><?php date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?>
            <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $field[fecha];?>" readonly="readonly"/>
              <input name="cantidad" type="hidden" id="cantidad" value="0" />
              <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
              <input type="hidden" name="temp" id="temp" /></td>
          </tr>
          <tr>
            <td width="151">Radicado:</td>
            <td width="429"><label>
              <input type="text" name="radicado" id="txt_input" readonly="readonly" class="required" value="<?php echo $field[radicado]; ?>" />              
            </label></td>
          </tr>
          <tr>
            <td>Juzgado:</td><input name="juzgado" type="hidden" value=<?php echo $field[idjuz];?>/>
            <td><?php echo $field[juzgado];?></td>
          </tr>
          
          <tr>
          
             <td>C&eacute;dula Demandante:</td>
             <td><input type="text" name="cedula_demandante" id="txt_input" maxlength="1000" readonly="readonly" class="" value="<?php echo $field[cedula_demandante]; ?>" /></td>
             
             </tr>
             <tr>
             <td>Nombre Demandante: </td>
             <td><input type="text" name="demandante" id="txt_input" maxlength="1000" readonly="readonly" class=""  onchange="" value="<?php echo $field[demandante]; ?>"/></td>
             </tr>
             <tr>
             <td>Cédula Demandado: </td>
             <td><input type="text" name="cedula_demandado" id="txt_input" maxlength="1000" readonly="readonly" class=""  onchange="" value="<?php echo $field[cedula_demandado]; ?>"/></td>
             </tr>
             <tr>
             <td>Nombre Demandado: </td>
             <td><input type="text" name="demandado" id="txt_input" maxlength="1000" readonly="readonly" class=""  onchange="" value="<?php echo $field[demandado]; ?>"/></td>
             </tr>           
          <tr>
            <td>Piso:</td>
            <td><input type="text" name="piso" readonly="readonly"  id="txt_input" class=""  value="<?php echo $field[piso]; ?>" /></td>      
            
          </tr>
          <tr>
          <td>Estado:</td><input name="estado1" type="hidden"/>
          <td><select name="estado" class="required" id="sl_input" onchange="">
            
              <?php
 while($fieldj = $datos_estados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id];?>"<?php if($fieldj[id]==$field[idestado]){ ?> selected="selected"<?php }?> ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
          </select></td>
          </tr>
          <tr>
          <td>Posición</td>
          <td><input type="text" name="posicion" readonly="readonly"   id="txt_input" class="" value="<?php echo $field[posicion]; ?>" />          
          </td>
          </tr>
          <tr>
          <td>Fecha de Salida:</td>
          <td><input name="fechasalida" type="text" class="required tinicio" id="txt_input" readonly="readonly" onchange="validar_fecha(frm)" value="<?php echo $field[fechasalida];?>"/>
          <script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>
          
          </td>
          </tr>
          <tr>
          <td>Juzgado Prestamo:</td><input name="juzgadodestino" type="hidden" value=<?php echo 	$field[idjuzdes];?>/>
          <td><?php echo $field[juzgadodestino];?></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>DETALLE DEVOLUCI&Oacute;N</strong></div></td>
            </tr>
          <tr>
          <td>Fecha Devolución</td>
          <td><input name="fechadevolucion" type="text" class="required tinicio" id="txt_input"  value="<?php echo $fecha;?>"/>
          
          </td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Actualizar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
          </tr>
         
        </table>
        <?php }?>
      </form>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>
<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
</body>
</html>
