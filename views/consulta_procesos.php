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
frm.cedula.value ="";
frm.nom_ddte.value ="";
frm.nom_ddo.value ="";
frm.cedula_ddo.value ="";
frm.estado.value ="";
frm.radicado.value ="";

}


function consultar(frm)
{

variable=1;
variable1=frm.cedula.value;
variable2=frm.nom_ddte.value;
variable3=frm.nom_ddo.value;
variable4=frm.cedula_ddo.value;


location.href="index.php?controller=consulta&action=consulta1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4;


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
<div id="titulo_frm">Consulta Procesos</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
      <tr>
        <td width="157">Nombre Demandado:</td>
        <td width="346"><label>
          <input type="textfield" name="nom_ddte" id="txt_input" value="<?php echo $_GET['nombre2']?>" />
        </label></td>
        <td width="107">C&eacute;dula Demandado:</td>
        <td width="148"><label>
          <input name="cedula" type="text" id="txt_input" value="<?php echo $_GET['nombre1']?>" maxlength="20" />
        </label></td>
      </tr>
      <tr>
        <td>Nombre Demandante:</td>
        <td><input type="text" name="nom_ddo" id="txt_input" value="<?php echo $_GET['nombre3']?>" /></td>
        <td>C&eacute;dula Demandante:</td>
        <td><input type="text" name="cedula_ddo" id="txt_input" value="<?php echo $_GET['nombre4']?>" /></td>
      </tr>
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
<table width="779" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="30">&nbsp;</td>
        <td width="31">&nbsp;</td>
        </tr>
</table>
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
  <p>Resultado de la Consulta</p>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr>
                      <th>Radicado</th>
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
                      <td><?php  echo $datos_justicia[$i][radicado];?></td>
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
                      <td colspan="10"><div align="center"></div></td>
                    </tr>
                    
                    <?php }?>
              </tbody>
          </table>
<?php // }?>



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
