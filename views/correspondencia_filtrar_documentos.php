<?php 
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo = new correspondenciaModel();
	
?>

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
	
	
	$(".generarexcelmemorial").click(function(){
	
		//alert(1);
		
		
		if (
		
			document.getElementById('fechaii').value.length  			== 0 &&
			document.getElementById('fechaif').value.length  			== 0 &&
			document.getElementById('idjuzgadorepartomx').value.length  == 0  
			
		){
			
			/*dato_0  = 5;//para saber que es el reporte 5
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=archivo&action=GenerarProcesosVentanillaExcel&opcion="+dato_0+"&tfiltro="+tfiltro;*/
			
			
			alert("Definir Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto");
			document.getElementById('fechaii').style.borderColor = '#FF0000';
			document.getElementById('fechaif').style.borderColor = '#FF0000';
			document.getElementById('idjuzgadorepartomx').style.borderColor = '#FF0000';
       	
		}
		else{
		
			//dato_0 = 1;
			dato_1 = document.getElementById('fechaii').value;
			dato_2 = document.getElementById('fechaif').value;
		
			datox1 = document.getElementById('idjuzgadorepartomx').value;
			
			
			//alert(dato_1+"******"+dato_2+"******"+datox1);
	
			dato_0  = 7000;//para saber que es el reporte 5
			tfiltro = 1;//con filtro
			
			location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcelMemoriales&nombre="+dato_0+"&tfiltro="+tfiltro+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
		
		
	
    });
	
	$(".generarexcelmemorial_2").click(function(){
	
		//alert(1);
		
		
		if (
		
			document.getElementById('fechaii').value.length  			== 0 &&
			document.getElementById('fechaif').value.length  			== 0 &&
			document.getElementById('idjuzgadorepartomx').value.length  == 0  
			
		){
			
			/*dato_0  = 5;//para saber que es el reporte 5
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=archivo&action=GenerarProcesosVentanillaExcel&opcion="+dato_0+"&tfiltro="+tfiltro;*/
			
			
			alert("Definir Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto");
			document.getElementById('fechaii').style.borderColor = '#FF0000';
			document.getElementById('fechaif').style.borderColor = '#FF0000';
			document.getElementById('idjuzgadorepartomx').style.borderColor = '#FF0000';
       	
		}
		else{
		
			//dato_0 = 1;
			dato_1 = document.getElementById('fechaii').value;
			dato_2 = document.getElementById('fechaif').value;
		
			datox1 = document.getElementById('idjuzgadorepartomx').value;
			
			
			//alert(dato_1+"******"+dato_2+"******"+datox1);
	
			dato_0  = 8000;//para saber que es el reporte 5
			tfiltro = 2;//con filtro
			
			location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcelMemoriales&nombre="+dato_0+"&tfiltro="+tfiltro+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
		
		
	
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

frm.fechai.value = "";
frm.fechaf.value= "";
frm.tipo_documento.value= "";
frm.solicitud.value= "";
frm.idjuzgado.value= "";
frm.radicado.value= "";
frm.idjuzgadodestino.value= "";
frm.idusuario.value= "";
frm.peticionario.value= "";
frm.fechaei.value= "";
frm.fechaef.value="";



}

function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=show_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=modificarDocumentos&nombre="+variable;
//document.write(location.href) 

}
function exportar(frm)
{
variable = 3;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.tipo_documento.value;
variable4=frm.solicitud.value;
variable5=frm.idjuzgado.value;
variable6=frm.radicado.value;
variable7=frm.idjuzgadodestino.value;
variable8=frm.idusuario.value;
variable9=frm.peticionario.value;
variable10=frm.fechaei.value;
variable11=frm.fechaef.value;

//ADICIONADO POR JORGE ANDRES VALENCIA EL 25 DE FEBRERO DEL 2016 
//PARA LA APLICAION DEL NUEVO MODULO INCORPORA MEMORIAL AL PROCESO
//variable10b=frm.fechaii.value;
//variable11b=frm.fechaif.value;

variable13 = $('input:radio[name=radiosiep]:checked').val();

//variable14=frm.idjuzgadoreparto.value;


//location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre13="+variable13+"&nombre10b="+variable10b+"&nombre11b="+variable11b+"&nombre14="+variable14;

location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre13="+variable13;
//document.write(location.href) 

}
function consultar(frm)
{

variable=1;
variable1=frm.fechai.value;
variable2=frm.fechaf.value;
variable3=frm.tipo_documento.value;
variable4=frm.solicitud.value;
variable5=frm.idjuzgado.value;
variable6=frm.radicado.value;
variable7=frm.idjuzgadodestino.value;
variable8=frm.idusuario.value;
variable9=frm.peticionario.value;
variable10=frm.fechaei.value;
variable11=frm.fechaef.value;

//ADICIONADO POR JORGE ANDRES VALENCIA EL 25 DE FEBRERO DEL 2016 
//PARA LA APLICAION DEL NUEVO MODULO INCORPORA MEMORIAL AL PROCESO
//variable10b=frm.fechaii.value;
//variable11b=frm.fechaif.value;

variable13 = $('input:radio[name=radiosiep]:checked').val();
//alert(variable12);

//variable14=frm.idjuzgadoreparto.value;

/*if(
	(variable1  !== '' && variable2   == '') ||
	(variable1   == '' && variable2  != '')  ||
	(variable10 !== '' && variable11  == '') ||
	(variable10  == '' && variable11 != '')  ||
	(variable10b !== '' && variable11b  == '') ||
	(variable10b  == '' && variable11b != '')
	
	)
{
	alert('Deber ingresar las dos fechas del filtro');
}
else{*/

	//location.href="index.php?controller=correspondencia&action=listarDocumentos1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre13="+variable13+"&nombre10b="+variable10b+"&nombre11b="+variable11b+"&nombre14="+variable14;
	
	location.href="index.php?controller=correspondencia&action=listarDocumentos1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre13="+variable13;
//}

}
function llenar(frm,op)
{



if(op==1){
   for (i=0;i<document.frm.elements.length;i++) 
      if(document.frm.elements[i].type == "checkbox")	
         document.frm.elements[i].checked=1 
 
}
if(op==2){

   for (i=0;i<document.frm.elements.length;i++) 
      if(document.frm.elements[i].type == "checkbox")	
         document.frm.elements[i].checked=0 
 
}
 
} 
function generar(frm)
{

location.href="index.php?controller=correspondencia&action=generarEntrega";
//document.write(location.href) 

}
</script>
<style type="text/css">
<!--
.EstiloR {color: #FF0000}
.EstiloA {color: #FFFF00}
.EstiloV {color: #00FF00}
.Estilo2 {color: #000000}
-->
</style>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>
<!--
-->
    <?php  $gener=0;$gener= $datos_entrega;
	//echo $gener;?>
    <table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>
<div id="contenido1">
<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">
<?php if($gener==0){?>
<div id="titulo_frm">Filtro de documentos recibidos</div>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <tr>
      <td width="157">Fecha Inicial Recibido:</td>
      <td width="346"><input name="fechai" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre1'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
      <td width="107">Fecha Final Recibido:</td>
      <td width="148"><input name="fechaf" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre2'];?>" readonly="readonly"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script></td>
    </tr>
      <tr>
      <td>Tipo Documento:</td>
      <td><select name="tipo_documento" id="sl_input">
           <option value="" >Seleccione el tipo de documento</option>
        <option value="Memorial" <?php if ($_GET['nombre3']=='Memorial'){?>selected="selected"<?php }?>>Memorial</option>
        <option value="Oficio" <?php if ($_GET['nombre3']=='Oficio'){?>selected="selected"<?php }?>>Oficio</option>
        <option value="Recurso" <?php if ($_GET['nombre3']=='Recurso'){?>selected="selected"<?php }?>>Recurso</option>
        <option value="Otro" <?php if ($_GET['nombre3']=='Otro'){?>selected="selected"<?php }?>>Otro</option>
      </select></td>
      <td>Solicitud:</td>
      <td><select name="solicitud"  id="sl_input" >
      <option value="" >Seleccione el tipo de documento</option>
        <?php
 while($fields = $datos_solicitud->fetch()){
  ?>
        <option value="<?php echo $fields[id];?>"  <?php if ($_GET['nombre4']==$fields[id]){?>selected="selected"<?php }?> ><?php echo $fields[nombre] ?></option>
        <?php }?>
      </select></td>
      </tr>
      <tr>
        <td>Juzgado:</td>
        <td><select name="idjuzgado" id="sl_input">
          <option value="">Seleccione un Juzgado </option>
          <?php   while($fieldj = $datos_juzgados->fetch()){  ?>
          <option value="<?php echo $fieldj[id];?>" <?php if ($_GET['nombre5']==$fieldj[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldj[nombre];?></option>
          <?php }?>
        </select></td>
        <td>Radicado:</td>
        <td><input type="text" name="radicado" id="txt_input3" value="<?php echo $_GET['nombre6'];?>" /></td>
      </tr>
      <tr>
        <td>Juzgado Destino:</td>
        <td><select name="idjuzgadodestino" id="sl_input">
          <option value="">Seleccione un Juzgado </option>
          <?php   while($fieldj1 = $datos_juzgados1->fetch()){  ?>
          <option value="<?php echo $fieldj1[id];?>" <?php if ($_GET['nombre7']==$fieldj1[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldj1[nombre];?></option>
          <?php }?>
        </select></td>
        <td>Recibi&oacute;:</td>
        <td><select name="idusuario" id="sl_input">
          <option value="">Seleccione un usuario</option>
          <?php   while($fieldm = $datos_usuarios->fetch()){  ?>
          <option value="<?php echo $fieldm[id];?>" <?php if ($_GET['nombre8']==$fieldm[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldm[empleado];?></option>
          <?php }?>
        </select></td>
      </tr>
      <tr>
        <td>Peticionario:</td>
        <td><label>
          <input type="text" name="peticionario" id="txt_input" value="<?php echo $_GET['nombre9'];?>" />
        </label></td>
        <td>Se Incorpora Memorial al Proceso:</td>
        <td>
			<input type="radio" name="radiosiep" id="radiosiep" value="si" "<?php if ($_GET['nombre13'] == 'si'){?>" checked "<?php } ?>">Si
			<input type="radio" name="radiosiep" id="radiosiep" value="no" "<?php if ($_GET['nombre13'] == 'no'){?>" checked "<?php } ?>">No
		</td>
      </tr>
      <tr>
        <td>Fecha Inicial Entrega:</td>
        <td><input name="fechaei" type="text" class="tinicio" id="txt_input" value="<?php echo $_GET['nombre10'];?>" readonly="readonly"/></td>
        <td>Fecha Final Entrega:</td>
        <td><input name="fechaef" type="text" class="tinicio" id="txt_input5" value="<?php echo $_GET['nombre11'];?>" readonly="readonly"/></td>
      </tr>
	  
	  
	  <tr>
	  	<td style="color:#FF0000; font-size:12px" colspan="4">ESTE FILTRO NO APLICA PARA EL BOTON CONSULTAR</td>
	  </tr>
	  
	   <tr>
	   
			<td> 
			
				<a class="generarexcelmemorial" href="javascript:void(0);">
					<img src="views/images/ab.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/>
				</a>
				
			</td>
			
			<td colspan="3">
			
				
				<a class="generarexcelmemorial_2" href="javascript:void(0);" style="float:right">
					LISTA CARPETA COMPARTIDA JUZGADOS
					<img src="views/images/rjuzgado.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA PONER EN LA CARPETA COMPARTIFA DE LOS JUZGADOS, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/>
				</a>
				
			</td>
		
	  </tr>
	 
	   
	   <tr>
        <td>Fecha Inicial Incorpora:</td>
        <td><input name="fechaii" type="text" class="tinicio" id="fechaii" value="<?php echo $_GET['nombre10b'];?>" readonly="readonly"/></td>
        <td>Fecha Final Incorpora:</td>
        <td><input name="fechaif" type="text" class="tinicio" id="fechaif" value="<?php echo $_GET['nombre11b'];?>" readonly="readonly"/></td>
      </tr>
	  
	  <tr>
        <td>Juzgado Reparto:</td>
        <td colspan="3">
			
			<select name="idjuzgadorepartomx" id="idjuzgadorepartomx">
			
          		<option value="">Seleccione Juzgado Reparto </option>
          		<?php   
					while($fieldjr = $datos_juzgadoreparto->fetch()){  
					
						if($fieldjr[id] == 1 || $fieldjr[id] == 2){
				?>
          				
					
						<option value="<?php echo $fieldjr[id];?>" <?php if ($_GET['nombre14']==$fieldjr[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldjr[nombre];?></option>
						
          		<?php }}?>
				
        	</select>
			
		</td>
        
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
  <p>Lista de documentos recibidos</p>
  </div>

<table width="2323" border="0" cellpadding="0" cellspacing="0" class="display" id="frm_editar">
      <thead>
                    <tr>
                      <th width="18">Generar Entrega</th> 
                         <th width="333" height="39">Fecha Recibido</th>
	<th width="146">Radicado </th>
    <th width="157">Peticionario</th>
	<th width="188">Tipo</th>
	<th width="125">Juzgado</th>
	<th width="224">Juzgado Destino</th>
    <th width="213">Fecha Entrega</th>
	<th width="189">Solicitud</th>
	<th width="209">Recibi&oacute;</th>
	<th width="206">Folios</th>
	<th width="214">Expediente</th>
	<th width="101">&nbsp;</th> 
	<th width="101">&nbsp;</th>
	<!-- <th><a class="generarexcelmemorial" href="javascript:void(0);"><img src="views/images/ab.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/></a></th>
	<th><a class="generarexcelmemorial_2" href="javascript:void(0);"><img src="views/images/rjuzgado.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/></a></th> -->
    </tr>
  </thead>
  <tbody>                  
                    <tr>
                      
                    
<?php                     while($field = $datos_documentos->fetch()){ 


 ?>
<?php 

if($field[idprioridad]==1) $p="#FF0000"; if($field[idprioridad]==2) $p="#FFFF00"; if($field[idprioridad]==3) $p="#00FF00";
?>
<td bgcolor="<?php echo $p;?>"><label>
     <?php if (($field[generado]=='no')&&($field[fecha_entrega]!='')){?> <input name="<?php echo $field[id]; ?>" type="checkbox" id="acta" value="si" /><?php }?>
                      </label></td>
    <td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[fecha_registro];?></span></td>
	
	<td bgcolor="<?php echo $p;?>">
	
		<span class="Estilo2">
		
		<?php 
		
			echo $field[radicado];
			
			$expediente_bloqueado_1C = $modelo->Expediente_Bloqueado($field[radicado]);
			$expediente_bloqueado_2C = $expediente_bloqueado_1C->fetch();
			$expediente_bloqueado_3C = trim($expediente_bloqueado_2C[expebloqueado]);
			
			
		?>
		
		
		</span>
	
	
	</td>
	
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[peticionario];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[tipo_documento];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[juzgado];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[destino];?></span></td>
    <td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[fecha_entrega];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[solicitud];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[empleado];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[folios];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[tiene_expediente];?></span></td>
	
	<?php
	//EXPEDIENTE BLOQUEADO
	if($expediente_bloqueado_3C == 1){
    ?>
	
	 <td>EXPEDIENTE BLOQUEADO</td>
	 <td>-</td>
	 
	<?php 
	}
	else{
	?>
	
	<td style="cursor:pointer"><?php if($_SESSION['tipo_perfil']=='admin'){?><img src="views/images/edit.png" onclick="vinculo1(<?php echo $field[id];?>)" title="Modificar Documento" /><?php }?></td>
	
	<?php
	if(is_null($field[ruta_local])){?>
																	
		<td>-</td>
																	
	<?php	
	}
	else{
	?>
		<td>
			<a href="<?php echo $field['ruta_local'];?>" title="<?php echo $field['ruta_local'];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
		</td>
	<?php	
	}
	?>
	
	<?php	
	}
	?>
	
	<!-- <td>-</td> -->
                  </tr>
                    
<?php }?>
                <tr>
                  <td>                  
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
  <p>Lista de documentos recibidos</p>
  </div>

<table width="2323" border="0" cellpadding="0" cellspacing="0" class="display" id="frm_editar">
                <thead>
                    <tr>
                      <th height="39" colspan="3"><span class="Estilo2">cantidad de registros:&nbsp;<?php echo $datos_documentos->rowcount();?>
                      <input type="hidden" name="cantidad" id="cantidad" value="<?php  echo $datos_documentos->rowcount();?>" />
                      </span></th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th>&nbsp;</th>
                      <th style="cursor:pointer"><img src="views/images/excel.jpg" alt="" width="30" height="30" onclick="exportar(frm)" title="Exportar Listado a Excel" /></th>
					  <!-- <th><a class="generarexcelmemorial" href="javascript:void(0);"><img src="views/images/ab.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/></a></th>
					  <th><a class="generarexcelmemorial_2" href="javascript:void(0);"><img src="views/images/rjuzgado.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/></a></th> -->
                  </tr>
                    <tr>
                      <th width="19">Generar Entrega</th> 
                         <th width="332" height="39">Fecha Recibido</th>
	<th width="146">Radicado </th>
    <th width="157">Peticionario</th>
	<th width="188">Tipo</th>
	<th width="125">Juzgado</th>
	<th width="224">Juzgado Destino</th>
    <th width="213">Fecha Entrega</th>
	<th width="189">Solicitud</th>
	<th width="209">Recibi&oacute;</th>
	<th width="206">Folios</th>
	<th width="214">Expediente</th>
	<th width="101">&nbsp;</th>
	<!-- <th></th> -->
	<th width="101">&nbsp;</th>
    </tr>
  </thead>
  <tbody>                  
  <tr>
    <td colspan="14" bgcolor="<?php echo $p;?>">      <div align="center">
      <?php if($_SESSION['tipo_perfil']=='admin'){?><input type="submit" name="btn_input" value="Generar Entrega" id="btn_input"  /> <?php }?>   
    </div></td>
    </tr>
  <tr>
    <td colspan="4" bgcolor="<?php echo $p;?>"><p>&nbsp;</p>
      <p>
        <label>
      <?php if($_SESSION['tipo_perfil']=='admin'){?>   Todos
        <input type="radio" name="radio" id="radio"  value="1" onclick="llenar(frm,1)" />
        </label> 
        Ninguno
        <input type="radio" name="radio" id="radio2"  value="2" onclick="llenar(frm,2)" /><?php }?>
      </p></td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td bgcolor="<?php echo $p;?>">&nbsp;</td>
    <td style="cursor:pointer">&nbsp;</td>

	
  </tr>
  <tr>
    
                    
<?php      $i=1;                 while($field = $datos_documentos->fetch()){?>
<?php if(($field[idprioridad]==1)&&($field[fecha_entrega]=='')) $p="#FF0000"; if(($field[idprioridad]==2)&&($field[fecha_entrega]=='')) $p="#FFFF00"; if(($field[idprioridad]==3)&&($field[fecha_entrega]=='')) $p="#00FF00";  if($field[generado]=='si')$p="#FFFFFF";


?>
<td bgcolor="<?php echo $p;?>"><label>
 <?php if($_SESSION['tipo_perfil']=='admin'){?>
     <?php if (($field[generado]=='no')&&($field[fecha_entrega]!='')){?> <input name="<?php echo "entrega-".$i; ?>" type="checkbox" id="acta" value="<?php echo $field[id]; ?>" /><?php }?>
                </label>
                
                <?php }?>
                </td>
    <td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[fecha_registro];?></span></td>
	
	<td bgcolor="<?php echo $p;?>">
	
		<span class="Estilo2">
			
			<?php 
			
					echo $field[radicado];
					
					$expediente_bloqueado_1C = $modelo->Expediente_Bloqueado($field[radicado]);
					$expediente_bloqueado_2C = $expediente_bloqueado_1C->fetch();
					$expediente_bloqueado_3C = trim($expediente_bloqueado_2C[expebloqueado]);
					
			?>
			
		</span>
		
	</td>
	
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[peticionario];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[tipo_documento];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[juzgado];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[destino];?></span></td>
    <td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[fecha_entrega];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[solicitud];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[empleado];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[folios];?></span></td>
	<td bgcolor="<?php echo $p;?>"><span class="Estilo2"><?php echo $field[tiene_expediente];?></span></td>
	
	
	<?php
	//EXPEDIENTE BLOQUEADO
	if($expediente_bloqueado_3C == 1){
    ?>
	
	 <td>EXPEDIENTE BLOQUEADO</td>
	 <td>-</td>
	 
	<?php 
	}
	else{
	?>
	
	<td style="cursor:pointer"><?php if($_SESSION['tipo_perfil']=='admin'){?><img src="views/images/edit.png" onclick="vinculo1(<?php echo $field[id];?>)" title="Modificar Documento" /><?php }?></td>
	<!-- <td></td> -->
	
	<?php
	if(is_null($field[ruta_local])){?>
																	
		<td>-</td>
																	
	<?php	
	}
	else{
	?>
		<td>
			<a href="<?php echo $field['ruta_local'];?>" title="<?php echo $field['ruta_local'];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
		</td>
	<?php	
	}
	?>
	
	<?php	
	}
	?>
	
              </tr>
                    
<?php  $i=$i+1;}?>
                            
                </thead>
          </table>
          
<?php }?>
<?php }else
{
?>
<?php                    

$cont = count($datos_entrega);
$j=0;



?>
 
<div id="titulo_frm">
  <p>Lista de documentos entregar</p>
  </div>

<table width="2454" border="0" cellpadding="0" cellspacing="0" class="display" id="frm_editar">
      <thead>
                    <tr>
                      <th width="131">#</th>
                      <th width="131">Radicado</th> 
                         <th width="312" height="39">Tipo Documento</th>
	                     <th width="689">Tiene Expediente </th>
                         <th width="328">Folios</th>
	                     <th width="393">Solicitud</th>
                      <th width="470">Juzgado Destino</th>
    </tr>
  </thead>
  <tbody>                  
                   
                  
  <?php  while($j <$cont){ ?>                  

 <tr>
   <td><span class="Estilo2"><?php echo $j+1; ?></span></td>
<td><label><span class="Estilo2"><?php echo $datos_entrega[$j][radicado];?></span></label></td>
    <td ><span class="Estilo2"><?php echo $datos_entrega[$j][tipo_documento];?></span></td>
	<td ><span class="Estilo2"><?php echo $datos_entrega[$j][tiene_expediente];?></span></td>
	<td ><span class="Estilo2"><?php echo $datos_entrega[$j][folios];?></span></td>
	<td ><span class="Estilo2"><?php echo $datos_entrega[$j][solicitud];?></span></td>
	<td ><span class="Estilo2"><?php echo $datos_entrega[$j][juzdes];?></span></td>
    </tr>
         <?php $j++; $k = $j-1;}?>    
               

    <tr>
      <td><label></label>
        <p>&nbsp;</p>
        <p>Cantidad:&nbsp;<?php echo $j;?></p></td>
      <td colspan="2"><p>&nbsp;</p>
        <p><strong>Fecha:___________________</strong></p></td>
      <td colspan="2" ><p>&nbsp;</p>
        <p><strong>Entrega:_________________________________________</strong></p></td>
      <td colspan="2" ><p>&nbsp;</p>
        <p><strong>Recibe:________________________________</strong></p></td>
      </tr>
          </table>      
      <?php }?>  
         

</form>
</div>		
		

  
    </table>

    <?php require 'alertas.php';?>
</body>
</html>
