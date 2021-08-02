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
	
	
	$(".ruta_guia").click(function(){
	
		var dato_ruta = $(this).attr('data-ruta');
		
		//alert(dato_ruta);
	
		window.open(dato_ruta,"RUTA GUIA","width=1000,height=800,scrollbars=YES");
		
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

function vinculo()
{
 
 location.href="index.php?controller=correspondencia&action=filtrar_radicados";
}
</script>
<style type="text/css">
<!--
.Estilo1 {color: #666666}
-->
</style>
</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm"> Tutela</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
        
<?php $i=0;     
while($field_actu= $datos_actuaciones->fetch()){

$actuaciones[$i][idparte] 		= $field_actu[idparte];
$actuaciones[$i][tipodoc] 		= $field_actu[esoficio_telegrama];
$actuaciones[$i][numero]  		= $field_actu[oficio_telegrama];
$actuaciones[$i][direccion] 	= $field_actu[direccion];
$actuaciones[$i][municipio] 	= $field_actu[municipio];
$actuaciones[$i][idmunicipio]	= $field_actu[idmunicipio];
$actuaciones[$i][medio] 		= $field_actu[medio];
$actuaciones[$i][notificado] 	= $field_actu[notificado];
$actuaciones[$i][fecha_envio] 	= $field_actu[fecha_envio];
$actuaciones[$i][actuacion] 	= $field_actu[actuacion];
$actuaciones[$i][departamento] 	= $field_actu[departamento];
$actuaciones[$i][iddepartamento]= $field_actu[iddepartamento];
$actuaciones[$i][tipo_actuacion]= $field_actu[tipo_actuacion];

$parte_vector[$i] = $field_actu[idparte];
$i = $i+1;
}


$repeticiones = array_count_values($parte_vector);





$cont = count($actuaciones);
?>
        
        <?php 
 while($field = $datos_correspondencia->fetch()){?>
          <tr>
            <td width="139" bgcolor="#D3D3D3"><strong>Radicado:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php echo $field[radicado];?></td>
          </tr>
          
          <tr>
            <td bgcolor="#D3D3D3"><strong>Fecha Registro:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php echo $field[fecha];?></td>
          </tr>
          <tr>
            <td bgcolor="#D3D3D3"><strong>Juzgado:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php echo $field[juzgado];?></td>
          </tr>
          <tr>
            <td bgcolor="#D3D3D3"><strong>Proceso:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php echo $field[Tutela_Incidente];?></td>
          </tr>                     <?php 
}?>
          <tr>
            <td bgcolor="#D3D3D3"><strong>Accionante:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php 
 while($field = $datos_accionante->fetch()){
 echo $field[nombre];}?></td>
          </tr>
          <tr>
            <td bgcolor="#D3D3D3"><strong>Accionados:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php
			$cont = count($datos_nombres_accionados);
			$temp = $cont-1;
			$ii =0;
			
			while ($ii<$cont)
			{
			 if($ii!=$temp)
			 {
			  echo $datos_nombres_accionados[$ii][nombre_accionado].", ";
			 		 
			 }
			 else
			 {
			  echo $datos_nombres_accionados[$ii][nombre_accionado];
			 }
			 $ii++;
			}
			
			?></td>
          </tr>
          <tr>
            <td bgcolor="#D3D3D3"><strong>Vinculados:</strong></td>
            <td colspan="3" bgcolor="#D3D3D3"><?php
			$cont = count($datos_vinculado);
			$temp = $cont-1;
			$ii =0;
			
			while ($ii<$cont)
			{
			 if($ii!=$temp)
			 {
			  echo $datos_vinculado[$ii][nombre_vinculado].", ";
			 		 
			 }
			 else
			 {
			  echo $datos_vinculado[$ii][nombre_vinculado];
			 }
			 $ii++;
			}
			
			?></td>
          </tr>

          
                     <tr>
                       <td colspan="4"><div align="center" class="Estilo1">------------------------------------------------------------------------------------------------------------------------------------------------------------</div></td>
            </tr>
            <tr>
            <td colspan="4" bgcolor="#EBE9ED"><div align="center"><strong>Actuaciones</strong></div></td>
            </tr>
                 <?php 
 while($field_partes = $datos_partes->fetch()){  

   ?>
 

          <tr>
       
            <td bgcolor="#EBE9ED"><strong>Nombre:</strong></td>
            <td colspan="3" bgcolor="#EBE9ED"><strong><?php echo $field_partes[accionante_accionado_vinculado];?></strong></td>
          </tr>
          <tr>
            <td bgcolor="#EBE9ED"><strong>Tipo:</strong></td>
            <td colspan="3" bgcolor="#EBE9ED"><strong><?php echo $field_partes[esaccionante_accionado_vinculado];?></strong></td>
          </tr>
                  
<tr>
                     <td bgcolor="#EBE9ED"><strong>Actuaci&oacute;n:</strong></td>
                     <td width="116" bgcolor="#EBE9ED"><?php echo $field_partes[actuacion];?></td>
              <td width="233" bgcolor="#EBE9ED"><strong>Medio Notificaci&oacute;n:</strong></td>
              <td width="454" bgcolor="#EBE9ED"><?php echo $field_partes[medio];?></td>
            </tr>
            <tr>
            <td bgcolor="#EBE9ED"><strong>Documento:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[esoficio_telegrama];?></td>
            <td bgcolor="#EBE9ED"><strong>N&uacute;mero:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[oficio_telegrama];?></td>
            </tr>
          <tr>
            <td bgcolor="#EBE9ED"><strong>Direcci&oacute;n:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[direccion];?></td>
            <td bgcolor="#E7E4E9"><strong>Municipio:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[municipio];
			?></td>
          </tr>
          <tr>
            <td bgcolor="#EBE9ED"><strong>Notificado:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[notificado];?></td>
            <td bgcolor="#EBE9ED"><strong>Fecha:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[fecha_envio];?></td>
          </tr>
          <tr>
            <td bgcolor="#EBE9ED"><strong>Asunto:</strong></td>
            <td bgcolor="#EBE9ED"><?php echo $field_partes[tipo_actuacion];?></td>
			
           <td bgcolor="#EBE9ED"><strong>Numero Guia:</strong></td>
            <td bgcolor="#EBE9ED">
				
				<?php 
				
				//echo $field_partes[nunguia];
				$RUTA_GUIA = "http://svc1.sipost.co/trazawebsip2/frmReportTrace.aspx?ShippingCode=".$field_partes[nunguia];
				
				?>
				
				<a class="ruta_guia" data-ruta="<?php echo $RUTA_GUIA; ?>"><?php echo $field_partes[nunguia];?></a>
				
			</td>
			<td bgcolor="#EBE9ED">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3">
             </td>
            <td>&nbsp;</td>
          </tr>
   
         
      <?php
	  
	  
	  }?>  
        
          <tr>
            <td colspan="4"><fieldset id="fiel2"> </fieldset>            </td>
            </tr>
          
   
          <tr>
            <td colspan="4"><div align="center">
              <input type="button" name="Submit" value="Cancelar" id="btn_input" onclick="vinculo()">
              <input type="hidden" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                  <input name="cantidad_detalles" type="hidden" id="hiddenField" value="0" />
            </div></td>
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
