<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

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
function limpiar(frm)
{

frm.radicado.value ="";

}


function consultar(frm)
{

variable=1;
variable1=frm.radicado.value;

location.href="index.php?controller=consulta&action=consultar_ponente1&nombre="+variable+"&nombre1="+variable1;


}
</script>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_consulta.php'; ?>
<!---->

<?php

/*SERV-JUSTICIA2
local
consejoPN

T103DAINFOPROC
A103LLAVPROC
*/




?>


    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
<div id="contenido1">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Cambio de Ponente</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
      <tr>
        <td width="157">Radicado:</td>
        <td width="346"><input type="text" name="radicado" id="txt_input" value="<?php echo $_GET['nombre1']?>"  /></td>
        <td width="107">&nbsp;</td>
          <td width="148">&nbsp;</td>
        </tr>
    
    <?php ?>
      <?php ?>
      <tr>
        <td>&nbsp;</td>
        <td><input name="opcion" type="hidden" value="" />
          <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)" />
          <input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)"/></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>
<label></label>

<p>
  <?php 
$opcion = $_GET['nombre'];
$i=0;
if($opcion==1){

 $cont=count($datos_justicia);
?>
<br />
<br />
<div id="titulo_frm">
  <p>Detalle para cambio ponente</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr>
                      <th>Demandado</th>
                      <th>C&eacute;dula Demandado</th>
                      <th>Demandate</th>
                      <th>C&eacute;dula Demandante</th>
                      <th>Actuaci&oacute;n Secretar&iacute;a</th>
                      <th>Descripci&oacute;n Actuaci&oacute;n Secretar&iacute;a</th>
                      <th>Actuaci&oacute;n Despacho</th>
                      <th>Descripci&oacute;n Actuaci&oacute;n Despacho</th>
					  <th>Ponente</th>
                    </tr>
                      </thead>
              
                  <tbody>
          
   <?php while($i<=$cont){?>               
                    <tr>
                      <td><?php  echo $datos_justicia[$i][nom_demandado];?></td>
                      <td><?php echo $datos_justicia[$i][cedula_ddo];?></td>
                      <td><?php  echo $datos_justicia[$i][nom_demandante];?></td>
                      <td><?php echo $datos_justicia[$i][cedula_dte];?></td>
                      <td><?php echo $datos_justicia[$i][actu_secre];?></td>
                      <td><?php echo $datos_justicia[$i][desc_actu_secre];?></td>
                      <td><?php echo $datos_justicia[$i][actu_desp];?></td>
                      <td><?php echo $datos_justicia[$i][desc_actu_desp];?></td>
					  <td><?php echo $datos_justicia[$i][ponente];?></td>
                    </tr>
                         
<?php $i++;}?>
        
                    <tr>
                      <td></td>
                      <td></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
					  <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="3">Despacho Destino:</td><?php $j=0;$cont_desp = count($datos_despachos)?>
                      <td><select name="despacho" id="sl_input">
                      <option value="">Seleccione el despacho destino</option>
                      <?php while($j<$cont_desp){?>
                        <option value="<?php echo $datos_despachos[$j][codi_pone]."-".$datos_despachos[$j][nom_pone]."-".$datos_despachos[$j][codi_enti]."-".$datos_despachos[$j][codi_espe]."-".$datos_despachos[$j][codi_nume];?>"><?php echo $datos_despachos[$j][nom_pone];?></option>
                       <?php $j++;}?>
                      </select></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="9"><div align="center">
                        <input type="submit" name="btn_input" value="Actualizar Ponente" id="btn_input" />
                      </div></td>
                    </tr>
                    
                    <?php }?>
              </tbody>
          </table>




</form>
</div>		
		</td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>
    <?php require 'alertas.php';?>
</body>
</html>
