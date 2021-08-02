<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
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

function vinculo(variable)
{

location.href="index.php?controller=proyecto&action=show_proyecto&nombre="+variable;
//document.write(location.href) 
}
</script>
<script type="text/javascript" language="javascript">
function cambiar(frm)
{
 variable= frm.tipodocumento.value;
 //alert(variable);
 if(variable=='AC')
 frm.color.value='Rojo';
  if(variable=='AD')
 frm.color.value='Amarillo';
  if(variable=='CC')
 frm.color.value='Azul';
  if(variable=='TR')
 frm.color.value='Rosado';
  if(variable=='I')
 frm.color.value='Verde';
  if(variable=='O')
 frm.color.value='Blanco';
  if(variable=='CP')
 frm.color.value='Azul Oscuro';
  if(variable=='BP')
 frm.color.value='Morado';
 
}
function sumar(frm) { 
var n1 = parseInt(frm.desde.value); 
var n2 = parseInt(frm.hasta.value); 
var p= parseInt(n2-n1);
document.frm.procesos.value=p; 

} 

function calcular_estado(frm)
{	
 departamento = document.frm.idestado.value;
 
 temp_nombre_ciudad = document.frm.lista_ciudades.value;
 temp_id_ciudad = document.frm.lista_ciudades_id.value;
 temp_iddepa = document.frm.lista_ciudades_iddepa.value;

 ciudad_nombre = temp_nombre_ciudad.split(",");
 ciudad_id = temp_id_ciudad.split(",");
 ciudad_iddepa = temp_iddepa.split(",");
 kk= ciudad_iddepa.length;
   
 document.frm.estadosdetalles.options.length = 0;
 i=0;
 j=0;
 x=  document.getElementById("sl_ciudad");
 
 
 while(i<kk)
 { 

  departamento_id = ciudad_iddepa[i];
  if(departamento_id == departamento)
  {	
   x.options[j] = new Option(ciudad_nombre[i]);
   x.options[j].value = ciudad_id[i]  ;
   
   j++;
   }
   i++;      
  }

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
alert('La fecha seleccionada, corresponde a un d�a no h�bil, seleccione otra fecha por favor');
//jAlert('This is a custom alert box', 'Alert Dialog');
frm.fecha_acta.value="";
}
else {

 }

}

function construir_radicado(frm)
{ 

  var juzgado =frm.juzgado.value; 
  
  
  
  var area_vector = juzgado.split("-");
  var area_nueva = 3;
  var numero_juzgado = area_vector[1];
  var relleno ="";
   if(numero_juzgado>9)
    {
  	relleno = "0";
  	}
  	else
  	{
  	relleno = "00";
  	}
    
  	var radicado = "";
  	var ano = frm.ano.value;
  	var consecutivo = frm.consecutivo.value;
  	var instancia = frm.instancia.value;
   
  
  if(area_nueva==1)
  {
   var area = "170013103"; 
  }
  if(area_nueva==2)
  {
   var area = "170013110"; 
  }
   if(area_nueva==3)
  {
   var area = "170014003"; 
  }
  
  //alert(juzgado);
  //ADICIONADO PARA PODER REGISTRAR TUTELAS EN EL SISTEMA 13 DE ENERO 2016
  if(juzgado=="15-1")
  {
   var area = "170014303"; 
  }
  if(juzgado=="16-2")
  {
   var area = "170014303"; 
  }
  
  radicado = area+relleno+numero_juzgado+ano+""+consecutivo+instancia;
  frm.radicado.value = radicado; 
    
}

function construir_posicion(frm)
{ 
  //ASI ESTABA
  /*var archivador = frm.archivador.value;
 
  var columna = frm.columna.value;
  var fila = frm.fila.value;
	
  posicion = archivador+"-"+columna+"-"+fila;
  frm.posicion.value = posicion */
  
  var archivador = frm.archivador.value;
 
  var columna = frm.columna.value;
  var fila    = frm.fila.value;
  var caja    = frm.caja.value;
	
  posicion = "CAJA"+caja+"-"+"A"+archivador+"-"+"C"+columna+"-"+"F"+fila;
  
  if (document.frm.archivador.value.length == 0 || document.frm.columna.value.length == 0 || document.frm.fila.value.length == 0 || document.frm.caja.value.length == 0){
  	
	frm.posicion.value = '';
  }
  else{
  	
	frm.posicion.value = posicion    
  }    
  
  
    
}


</script>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
.Estilo2 {color: #FF9999}

.Estilo3 {color: #330099}

.Estilo4 {color: #33CCCC}

.Estilo5 {color: #FFFF00}

.Estilo6 {color: #FFFFFF}

.Estilo7 {color: #880088}

.Estilo8 {color: #00DD00}
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
  <?php 
  
     date_default_timezone_set('America/Bogota'); 
     $ano=date('y');  
  ?>
  
   <?php 

$contador= $cont=$datos_estadosdetalles->rowcount();

$contador = $contador-1;
$i=$k=0;

 while($fieldd = $datos_estadosdetalles->fetch()){
  if($contador!=$i)
  {
   $cad_ciu = $cad_ciu.$fieldd[nombre].",";
   $cad_ciu_id = $cad_ciu_id.$fieldd[id].",";
   $cad_ciu_iddepa = $cad_ciu_iddepa.$fieldd[idestado].",";
   $ciudad[$i][nombre] = $fieldd[nombre];
   $ciudad[$i][id] = $fieldd[id]; 
   $ciudad[$i][idestado] = $fieldd[idestado];    
   
  }
  else
  {
   $cad_ciu = $cad_ciu.$fieldd[nombre];
   $cad_ciu_id = $cad_ciu_id.$fieldd[id]; 
   $cad_ciu_iddepa = $cad_ciu_iddepa.$fieldd[idestado];
   $ciudad[$i][nombre] = $fieldd[nombre];
   $ciudad[$i][id] = $fieldd[id];
   $ciudad[$i][idestado] = $fieldd[idestado];            

  }
  $i++;
 
 }
//$contador_a= $cont_a=$datos_actuaciones->rowcount();
//$contador_a = $contador_a-1;
//$ii=$kk=$jj=0;
  ?>
  
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Registrar Ubicaci&oacute;n Expedientes</div><input name="dias" type="hidden" value="<?php echo $datos_dias;?>" />
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
         <input type="hidden" name="tipo_inventario" id="hiddenField" value="1" />
             
             
              <input type="hidden" name="tipo_consecutivo" id="hiddenField2" value="0" />
          <tr>
            <td>Fecha:</td> 
            <td colspan="2"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly"  value="<?php echo $fecha;?>"/>
	<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
    
          </tr>
          
             <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)">
                 <option value="">Seleccione el a&ntilde;o</option>
				 <option value="1980">1980</option>
				 <option value="1981">1981</option>
				 <option value="1982">1982</option>
				 <option value="1983">1983</option>
				 <option value="1984">1984</option>
				 <option value="1985">1985</option>
				 <option value="1986">1986</option>
				 <option value="1987">1987</option>
				 <option value="1988">1988</option>
				 <option value="1989">1989</option>
                 <option value="1990">1990</option>
                 <option value="1991">1991</option>
                 <option value="1992">1992</option>
                 <option value="1993">1993</option>
                 <option value="1994">1994</option>
                 <option value="1995">1995</option>
                 <option value="1996">1996</option>
                 <option value="1997">1997</option>
                 <option value="1998">1998</option>
                 <option value="1999">1999</option>
                 <option value="2000">2000</option>
                 <option value="2001">2001</option>
                 <option value="2002">2002</option>
                 <option value="2003">2003</option>
                 <option value="2004">2004</option>
                 <option value="2005">2005</option>
                 <option value="2006">2006</option>
                 <option value="2007">2007</option>
                 <option value="2008">2008</option>
                 <option value="2009">2009</option>
                 <option value="2010">2010</option>
                 <option value="2011">2011</option>
                 <option value="2012">2012</option>
                 <option value="2013">2013</option>
                 <option value="2014">2014</option>
                 <option value="2015">2015</option>
                 <option value="2016">2016</option>
                 <option value="2017">2017</option>
				 <option value="2018">2018</option>
				 <option value="2019">2019</option>
				 <option value="2020">2020</option>
				 <option value="2021">2021</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (cinco digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="5" minlength="5" class="required" onchange="construir_radicado(frm)"/>
               <input type="hidden" name="instancia" id="hiddenField" value="00" /></td>
             </tr>
             <tr>
            <td width="288">Juzgado:</td>
            <td width="501"><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
              <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
             <tr>
               <td>Radicado:</td>
               <td><input name="radicado" type="text"  id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" /></td>
             </tr>
             <tr>
             <td>C&eacute;dula Demandante:</td>
             <td><input type="text" name="cedula_demandante" id="txt_input" maxlength="1000" class="required"  onchange="construir_posicion(frm)"/></td>
             
             </tr>
             <tr>
             <td>Nombre Demandante: </td>
             <td><input type="text" name="nombre_demandante" id="txt_input" maxlength="1000" class="required"  onchange="construir_posicion(frm)"/></td>
             </tr>
             <tr>
             <td>C�dula Demandado: </td>
             <td><input type="text" name="cedula_demandado" id="txt_input" maxlength="1000" class="required"  onchange="construir_posicion(frm)"/></td>
             </tr>
             <tr>
             <td>Nombre Demandado: </td>
             <td><input type="text" name="nombre_demandado" id="txt_input" maxlength="1000" class="required"  onchange="construir_posicion(frm)"/></td>
             </tr>
          <tr>
          <td>Piso:</td>
          <td colspan="2"><select name="piso" id="sl_input" class="">
            <option value="">Seleccione el piso</option>
            <option value="1">1</option>
            <option value="4">4</option>
            
          </select>
            <input type="hidden" name="lista_ciudades" id="hiddenField3" value="<?php echo $cad_ciu;?>" />
            <input type="hidden" name="lista_ciudades_id" id="hiddenField4" value="<?php echo $cad_ciu_id;?>" />
            <input type="hidden" name="lista_ciudades_iddepa" id="hiddenField5" value="<?php echo $cad_ciu_iddepa;?>" />
            <input type="hidden" name="lista_actuaciones_nombre" id="hiddenField6" value="<?php echo $cad_act;?>" />
            <input type="hidden" name="lista_actuaciones_id" id="hiddenField7" value="<?php echo $cad_act_id;?>" />
            <input type="hidden" name="lista_actuaciones_tipo" id="hiddenField8" value="<?php echo $cad_act_tipo;?>" />
            <input type="hidden" name="id" id="hiddenField9" value="<?php echo $_GET['nombre'];?>" /></td>
          
          <tr>
            <td>Estado:</td>
            <td colspan="2"><select name="idestado" id="sl_input" onchange="calcular_estado(frm)">
              <option value="">Seleccione un Estado</option>
                            
                <?php  while($fieldc = $datos_estados->fetch()){        ?>
                <option value="<?php echo $fieldc[id];?>"><?php echo $fieldc[nombre];?></option>
                <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><select name="estadosdetalles" id="sl_ciudad">
              <option value="<?php echo $field[id];?>"><?php echo $field[nombre];?></option>
                <?php  while($k<$cont){  
	   if ($ciudad[$k][idestado]==$dp )
	   {
		   
	 ?>
                <option value="<?php echo $ciudad[$k][id]; ?>"><?php echo $ciudad[$k][nombre]; ?></option>
                <?php }$k++;}?>
            </select></td>
          </tr>
          <tr>
          <td>Clase Proceso:</td>
          <td><select name="idclase_proceso" class="" id="sl_input" onchange="">
            <option value="">Seleccione Clase</option>
            <?php
 while($fieldj = $datos_claseproceso->fetch()){
 
  
 ?>
            <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre] ?></option>
            <?php }?>
          </select>
          </td>
          </tr>
         <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>POSICI&Oacute;N EN EL ARCHIVADOR</strong></div></td>
           </tr>
          <tr>
            
           
          </tr>
            
           <tr>
             <td>Archivador:</td>
             <td colspan="2"><input type="text" name="archivador" id="txt_input_corto" maxlength="3" class=""  onchange="construir_posicion(frm)"/></td>
         
           </tr>
           <tr>
           <td> Columna:  </td>
           <td cospan="2"><input type="text" name="columna" id="txt_input_corto" class=			"" maxlength="3"  onchange="construir_posicion(frm)" />
           </tr>
           <tr>
           <td>Fila:</td>
           <td><input type="text" name="fila" id="txt_input_corto" class="" maxlength="3"  onchange="construir_posicion(frm)" /></td>
           </tr>
		   <tr>
           <td>Caja:</td>
           <td><input type="text" name="caja" id="txt_input_corto" class="" maxlength="3"  onchange="construir_posicion(frm)"/></td>
           </tr>
           <tr>
           <td>Posici�n:</td>
           <td><input name="posicion" type="text"  id="txt_input" size="23" maxlength="20" readonly="readonly" /></td>
           </tr>
           <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>REPARTO</strong></div></td>
           </tr>
           <tr>
           
           <td>Fecha:</td>
           <td><input name="fecha_reparto" type="text" class=" tinicio" id="txt_input" readonly="readonly"  value="<?php echo $fecha;?>"/>
           </td>
           </tr>
            <tr>
           <td>Juzgado Reparto:</td>
           <td><select name="juzgado_reparto" class="" id="sl_input" onchange="">
           <option value="" selected="selected">Seleccione un Destino</option>
             <?php
 while($fieldj = $datos_juzgados_destino->fetch()){
 
  
 ?>
             <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre] ?></option>
             <?php }?>
           </select></td>
           </tr>
           <tr>
           <td>Despacho:</td>
           <td><select name="despacho" class="" id="sl_input" onchange="">
             <option value="" selected="selected">Seleccione un juzgado</option>
             <?php
 while($fieldk = $datos_juzgadoss->fetch()){
 
  
 ?>
             <option value="<?php echo $fieldk[id]."-".$fieldk[numero_juzgado];?>" ><?php echo $fieldk[nombre] ?></option>
             <?php }?>
           </select></td>
           </tr>
           <tr>
             <td>Observaciones: </td>
           <td><textarea name="observaciones" id="txt_input" cols="45" rows="5" maxlength = "500"></textarea> </td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><input type="submit" name="Submit" value="Registrar" id="btn_input">
                  <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/></td>
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
