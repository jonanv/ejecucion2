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
var area_param = frm.responsable.value;
vect_area= area_param.split("-");
frm.area.value= vect_area[1];

}
var variablejs;
function cambiar1(frm,arreglo)
{
var temp = frm.proceso.value;
vect= temp.split(";");
frm.juzgado.value=vect[2];
frm.fecha.value=vect[1];
frm.direccion.value=vect[3];
frm.radicado.value=vect[4];





}
</script>

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
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" action="">
        <div id="titulo_frm">Registrar Turno Notificaci&oacute;n Personal</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
          <tr>
            <td width="82">Empleado:</td>
                  
            
            <td width="764"><select name="responsable" class="required" id="sl_input" onchange="cambiar(frm)">
     <option value="" >Seleccione el encargado</option>        
            <?php
 while($field = $datos_empleados->fetch()){
 
 	if($field[idusuario] == 4 || $field[idusuario] == 3 || $field[idusuario] == 48 || $field[idusuario] == 36 || $field[idusuario] == 1 || $field[idusuario] == 47 || $field[idusuario] == 50 || $field[idusuario] == 49 || $field[idusuario] == 43 || $field[idusuario] == 42){
  
 ?>
              <option value="<?php echo $field[idusuario]."-".$field[area];?>" ><?php echo $field[empleado] ?></option>
<?php }}?>
            </select></td>
          </tr>
          <tr>
            <td>&Aacute;rea:</td>
            <td><label>
              <input type="text" name="area" id="txt_input" readonly="readonly" />
            </label></td>
          </tr>
          
          <tr>
            <td>Notificaci&oacute;n:</td>
            <td>
              <?php
 //print_r($datos_procesos);
 $contador = count($datos_procesos);
$i=0;
 // echo $datos_procesos[1][juzgado];

  
 ?>
       
              <select name="proceso" class="required" id="sl_input" onchange="cambiar1(frm)">
              <option value="" >Seleccione Documento</option>
                <?php
 while($i<$contador){
 
  
 ?>
                <option value="<?php echo $datos_procesos[$i][id].";".$datos_procesos[$i][fecha].";".$datos_procesos[$i][juzgado].";".$datos_procesos[$i][direccion].";".$datos_procesos[$i][radicado].";".$datos_procesos[$i][tipo];?>"
                
                
                
                
                
                 ><?php echo $datos_procesos[$i][tipo]." - ". $datos_procesos[$i][proceso]; ?></option>
                <?php $i=$i+1;}?>
              </select></td>
          </tr>
          <tr>
            <td >Radicado:</td>
            <td><input type="text" name="radicado" id="radicado" style="border:none;width: 250px;
	padding: 4px;" /></td>
          </tr>
          <tr>
            <td >Juzgado:</td>
            <td><label>
              <input type="text" name="juzgado" id="juzgado" style="border:none;width: 250px;
	padding: 4px;" />
            </label></td>
          </tr>
          <tr>
            <td >Direcci&oacute;n:</td>
            <td><input type="text" name="direccion" id="direccion" style="border:none;width: 250px;
	padding: 4px;" /></td>
          </tr>
         <tr>
    <td width="82">Fecha:</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <td width="764"><script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	<input type="text" name="fecha" id="fecha" style="border:none;width: 250px;
	padding: 4px;" /></td>
  </tr>
             <tr>
            <td width="82">Hora:</td>
            <td width="764"><label>
              <select name="hora" size="1" id="hora" style="border:none;width: 50px;
	padding: 4px;">
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                                          </select>
            : 
            <select name="hora2" size="1" id="hora2" style="border:none;width: 50px;
	padding: 4px;">
              <option value="00">00</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
              <option value="32">32</option>
              <option value="33">33</option>
              <option value="34">34</option>
              <option value="35">35</option>
              <option value="36">36</option>
              <option value="37">37</option>
              <option value="38">38</option>
              <option value="39">39</option>
              <option value="30">40</option>
              <option value="31">41</option>
              <option value="32">42</option>
              <option value="33">43</option>
              <option value="34">44</option>
              <option value="35">45</option>
              <option value="36">46</option>
              <option value="37">47</option>
              <option value="38">48</option>
              <option value="39">49</option>
              <option value="50">50</option>
              <option value="51">51</option>
              <option value="52">52</option>
              <option value="53">53</option>
              <option value="54">54</option>
              <option value="55">55</option>
              <option value="56">56</option>
              <option value="57">57</option>
              <option value="58">58</option>
              <option value="59">59</option>
                        </select>
            <select name="hora3" size="1" id="hora3" style="border:none;width: 55px;
	padding: 4px;">
              <option value="am">am</option>
              <option value="pm">pm</option>
                        </select>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Registrar" id="btn_input">
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
