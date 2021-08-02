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

<script src="views/js/ajax/ajax_empleados_filtrar_ingreso.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ >

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
	
	<!-- TABLA CUANDO SE ENTRA EL SIEPRO, QUE RESALTA 30 REGISTROS -->
	$('#frm_editar1').dataTable( { 
		'sPaginationType': 'full_numbers'
	} );


	<!-- TABLA CUANDO SE REALIZA EL FILTRO EN LA TABLA ANTERIOR Y SE DA CLC EN EL BOTON CONSULTAR -->
	$('#frm_editar2').dataTable( { 
		'sPaginationType': 'full_numbers' 
	} );
	
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
frm.fechair.value='';
frm.fechafr.value='';
frm.idusuario.value='';
frm.tipo.value='';

}


function vinculo(variable)
{

location.href="index.php?controller=archivo&action=show_archivoOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=archivo&action=edit_archivoOtro&nombre="+variable;
//document.write(location.href) 

}


function vinculoExcel(variable)
{
	
variable=5;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.ubicacion.value;
variable4=frm.radicado.value;
variable5=frm.piso.value;
variable6=frm.estadosdetalles.value;
variable7=frm.juzgado.value;
variable8=frm.posicion.value;
variable9=frm.juzgadodestino.value;
variable16=frm.fechair.value;
variable17=frm.fechafr.value;
variable20=frm.idusuario.value;

location.href="index.php?controller=archivo&action=listadoExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre16="+variable16+"&nombre17="+variable17+"&nombre20="+variable20;

}

function vinculoExcelReparto(variable)
{
variable=6;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.ubicacion.value;
variable4=frm.radicado.value;
variable5=frm.piso.value;
variable6=frm.estadosdetalles.value;
variable7=frm.juzgado.value;
variable8=frm.posicion.value;
variable9=frm.juzgadodestino.value;
variable16=frm.fechair.value;
variable17=frm.fechafr.value;
variable20=frm.idusuario.value;

location.href="index.php?controller=archivo&action=listadoExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre16="+variable16+"&nombre17="+variable17+"&nombre20="+variable20;

}


function consultar(frm)
{

variable=1;
variable16=frm.fechair.value;
variable17=frm.fechafr.value;
variable20=frm.idusuario.value;
variable11=frm.tipo.value;

location.href="index.php?controller=empleados&action=listarIngresoSalida1&nombre16="+variable16+"&nombre17="+variable17+"&nombre20="+variable20+"&nombre11="+variable11;


}
</script>
</head>
<body>

<!---->
  
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_empleados.php'; ?>
<!---->
<!-- <p align="center">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  codebase="http://active.macromedia.com/flash8/cabs/swflash.cab#version=8,0,0,0" 
  id="banner" width="468" height="60">
  <param name="movie" value="views/banner.swf">
  <param name="quality" value="high">
  <param name="wmode" value="transparent">
  <embed name="banner" src="views/banner.swf"
 quality="high" wmode="transparent" width="522" height="60"
  type="application/x-shockwave-flash" 
pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?
P1_Prod_Version=ShockwaveFlash"> </embed>
</p> -->
  <table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
        <td></td>
      </tr>
      <tr>
        <td>
        
<div id="contenido1">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<div id="titulo_frm">Filtro de Ingresos - Salidas</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    
    <tr>
      <td width="157">Fecha Registro Inicial:</td>
      <td width="346"><input name="fechair" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre16'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
      <td width="107">Fecha Registro Final:</td>
      <td width="148"><input name="fechafr" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre17'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script></td>
	
	
	
    </tr>
    
    <tr>
      <td>Usuario:</td>
             <td><select name="idusuario" id="sl_input"  >
               <option value="">Seleccione un Usuario</option>
               <?php  while($fieldc = $datos_usuarios->fetch()){        ?>
               <option value="<?php echo $fieldc[id];?>" <?php if ($_GET['nombre20']==$fieldc[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldc[empleado];?></option>
               <?php }?>
             </select></td>
             <td>Tipo: </td>
             <td><input type="text" name="tipo" id="txt_input" maxlength="50" class=""   onchange="" value="<?php echo $_GET['nombre11'];?>"/></td>
			 
			 
             
      </tr> 
      
           
   <tr>
    <td>&nbsp;</td>
    <td><input name="opcion" type="hidden" value="" />
    <input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)">
    <input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   </tr>
</table>
<p>

 <?php 
$opcion = $_GET['nombre'];
if($opcion!=1){
?>
<br />
<br />
<div id="titulo_frm">
  <p>Lista Ingresos - Salidas</p>
  </div>

<!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1"> -->

<table id="frm_editar1" rules="rows" border="1" class="display" cellspacing="0">
                <!-- <thead>
                    <tr>       
    <th width="66">Fecha</th> 
    <th width="66">Usuario</th>
    <th width="66">Observaciones</th>
    <th width="66">Tipo</th> 
	<th width="96"><span style="cursor:pointer"><img src="views/images/excel.jpg" width="30" height="30" alt="Generar Excel" title="Generar Excel" onclick="Reporte_Excel()" /></span></th>   
    <th width="96"></th>
   

                  </tr>
  </thead> -->
  
  <thead>
                    <tr>       
    <th>Fecha</th> 
    <th>Usuario</th>
    <th>Observaciones</th>
    <th>Tipo</th> 
	<th><img src="views/images/excel.jpg" width="30" height="30" alt="Generar Excel" title="Generar Excel" onclick="Reporte_Excel()" /></th> 
	

                  </tr>
  </thead>
  
  <tbody>       
                     
                    
 <?php while($field = $datos_ingresosalida->fetch()){  ?>
<tr>
        <td><?php echo $field[fecha];?></td>
		<td><?php echo $field[usuario];?></td>
        <td><?php echo $field[observaciones];?></td>
        <td><?php echo $field[tipo];?></td>
		
	    <td><span style="cursor:pointer"><img src="views/images/edit.png" alt="" title="Modificar Ubicación" onclick="vinculo1(<?php echo $field[id];?>)" /></span></td>
	
</tr>
                    
<?php }?>
                               
                </thead>
          </table>
          
<?php }?>
  <?php 
$opcion = $_GET['nombre'];
if($opcion==1){
?>
<br />
<br />
<div id="titulo_frm">
  <p>Lista Ingresos - Salidas</p>
  </div>

<!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar2"> -->

<table id="frm_editar2" rules="rows" border="1" class="display" cellspacing="0">
                <!-- <thead>
                    <tr>     
     
    <th width="66">Fecha</th>
	<th width="58">Usuario </th>
    <th width="66">Observaciones</th>
    <th width="66">Tipo</th>
    
    <th width="96"><span style="cursor:pointer"><img src="views/images/excel.jpg" width="30" height="30" alt="Generar Excel" title="Generar Excel" onclick="Reporte_Excel()" /></span></th>   
    <th width="96"></th>
	
    </tr>
  </thead> -->
  
  <thead>
                    <tr>     
     
    <th>Fecha</th>
	<th>Usuario </th>
    <th>Observaciones</th>
    <th>Tipo</th>
    
    <th><img src="views/images/excel.jpg" width="30" height="30" alt="Generar Excel" title="Generar Excel" onclick="Reporte_Excel()" /></th>   
    
	
    </tr>
  </thead>
  
  
  <tbody>       
                     
                    
<?php while($field = $datos_ingresosalida->fetch()){  ?>
<tr>
        <td><?php echo $field[fecha];?></td>
		<td><?php echo $field[usuario];?></td>
        <td><?php echo $field[observaciones];?></td>
        <td><?php echo $field[tipo];?></td>
        

	    <td><span style="cursor:pointer"><img src="views/images/edit.png" alt="" title="Modificar Ubicación" onclick="vinculo1(<?php echo $field[idem];?>)" /></span></td>
		
		
</tr>
                    
<?php }?>
                               
                </thead>
          </table>
          
<?php }?>



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
