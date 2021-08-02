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


function medio(frm)
{
//alert("entre");
var m = document.frm.medio_notificacion.value;
var s = document.frm.notificado.checked ;
//alert(s);

if ((m==3)|| (m==5))
{
 if(s==true)
  {
   
   document.frm.adicionar1.disabled = false;
  }
  else {}
}
else
{

document.frm.adicionar1.disabled = true;
}


}
</script>
<script type="text/javascript">
function loadCiudad(dep) {
alert('entre');
location.href = "index.php?controller=correspondencia&action=filtro_ciudad&depto="+dep;
}
</script>

<script type="text/javascript" language="javascript">

function activar(frm)
{
	var x=document.frm.clase_proceso.value;
	var cant = document.frm.cantidad.value;
	var nom="";
	var nom1="";
	//alert (cant);
	var i =1;

	if (x==1 || x==2)
	{

	frm.accionante.disabled = false;
	frm.adicionar.disabled = false; 
	frm.accionado.disabled = false; 
	frm.esAccionado.disabled = false;
	frm.actuacion.disabled = false;

 
	}
	if(x==3)
	{
	 frm.accionante.value ="";
	 frm.accionado.value ="";
	 frm.esAccionado.checked  =false;
	  frm.actuacion.value ="";
	 frm.accionante.disabled = true; 
	 frm.adicionar.disabled = true; 
	 frm.accionado.disabled = true; 
	 frm.esAccionado.disabled = true; 
	frm.actuacion.disabled = true; 
	while(i<=cant)
	 {
	  nom= 'esAccionado'+i;
	  nom1= 'accionado'+i;
	  //alert(nom);
	  document.getElementById(nom).disabled=true
	  document.getElementById(nom1).disabled=true
	  //frm..disabled = true;
	  //frm.nom1.disabled=true;
	  i = i+1;
	 }
	

	}

//document.frm.enviar.disabled=!document.formulario.enviar.di
 
}
</script>
<script type="text/javascript">


num=0;
num1=0;
var array = new Array();

function crear(form,frm) {


  num++;
  
  fi = document.getElementById('fiel'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'accionado'+num; // 6
  ele.id = 'accionado'+num; // 6
  //ele.id = 'txt_input'; // 6
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  

  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+num; 
  ele.value= 'Accionado?';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 


  ele = document.createElement('input'); // 5
  ele.type = 'checkbox'; // 6
  ele.name = 'esAccionado'+num; // 6
  ele.id = 'esAccionado'+num;
  ele.value = 1;
//  ele.id = 'txt_input'; // 6
  //ele.className = 'required';
  contenedor.appendChild(ele); // 7
 
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div'+num; // 8
  ele.onclick = function () {borrar(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
  frm.cantidad.value=num;
  frm.temp.value=num;
 
  

  
}
function borrar(obj) {
  fi = document.getElementById('fiel'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
  //num= num-1;
  frm.cantidad.value=num;
  frm.temp.value=num;
}





function crear1(form,frm) {


  num1++;
  
  fi = document.getElementById('fiel1'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num1; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'file'; // 6
  ele.name = 'evidencia'+num1; // 6
  ele.id = 'evidencia'+num1; // 6
  //ele.id = 'txt_input'; // 6
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  

  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div'+num1; // 8
  ele.onclick = function () {borrar1(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
  frm.cantidad1.value=num1;
  
   
}
function borrar1(obj) {
  fi = document.getElementById('fiel1'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10

 
}
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
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Modificar Correspondencia Otro</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
       <?php while($field = $datos_correspondencia->fetch()){?>
          <tr>
            <td width="151">Radicado:</td>
            <td width="429"><label>
              <input type="text" name="radicado" id="txt_input" class="required" value="<?php echo $field[radicado]; ?>" />
            </label></td>
          </tr>
          <tr>
            <td>Juzgado:</td>
            <td><select name="juzgado" class="required" id="sl_input" onchange="">
            <option value="<?php echo $field[idjuzgado];?>" selected="selected"><?php echo $field[juzgado];?></option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldj[id];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Oficio
              <label>
              <input type="radio" name="esOficio_Telegrama" id="radio" value="Oficio" <?php if($field[esOficio_Telegrama]=="Oficio"){?> checked="checked" <?php }?> />
              </label>
Telegrama
<input type="radio" name="esOficio_Telegrama" id="radio2" value="Telegrama" <?php if($field[esOficio_Telegrama]=="Telegrama"){?> checked="checked" <?php }?> /></td>
          </tr>
          <tr>
            <td>N&deg; Oficio/N&deg; Telegrama:</td>
            <td>    <input type="text" name="oficio_telegrama" id="txt_input" class="required" value="<?php echo $field[oficio_telegrama];?>" /></td>
          </tr>
          <tr>
            <td>Destinatario:</td>
            <td><input type="text" name="destinatario" id="txt_input_grande" class="required" value="<?php echo $field[destinatario];?>" /></td>
          </tr>
          <tr>
            <td>Direcci&oacute;n:</td>
            <td><textarea name="direccion" rows="4"  id="txt_input"><?php echo $field[direccion];?></textarea>
              <label></label></td>
          </tr>
          <tr>
            <td>Departamento:</td>
            <td><select name="departamentos" class="required" id="departamentos" onchange="cargaContenido(this.id)">
                <option value="<?php echo $field[iddepa];?>" selected="selected"><?php echo $field[departamento];?></option>
              <?php
 while($fieldk = $datos_departamentos->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldk[id];?>" ><?php echo $fieldk[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr>
          <tr>
            <td>Ciudad:</td>
            <td>
  <div id="demoDer">
                					<select name="estados" id="estados" class="required">
						<option value="<?php echo $field[idmunicipio];?>"><?php echo $field[municipio];?></option>
  <?php  while($depa = $datos_ciudad->fetch()){ ?>                        
   <option value="<?php echo $depa[id];?>"><?php echo $depa[nombre];?></option>                     
      <?php }?>                   
                        
					</select>
  </div>
				<div id="demoIzq"></div></td>
          </tr>
          <tr>
            <td>Medio Notificaci&oacute;n:</td>
            <td><select name="medio_notificacion" class="required" id="sl_input" onchange="medio(frm)">
            <option value="<?php echo $field[idmedionotificacion];?>" selected="selected"><?php echo $field[medio];?></option>
              <?php
while($fieldm = $datos_medio->fetch()){
 
  
 ?>
              <option value="<?php echo $fieldm[id];?>" ><?php echo $fieldm[nombre] ?></option>
              <?php }?>
            </select></td>
          </tr><?php
	 ?>
          <?php ?>
          <tr>
            <td>Fecha:</td><?php date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?>
            <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $fecha;?>" readonly="readonly"/>
              <input name="cantidad" type="hidden" id="cantidad" value="0" />
              <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
              <input type="hidden" name="temp" id="temp" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><label></label></td>
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
