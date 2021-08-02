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
numf2=0;
numf2_real=1;
cont=2;

function crearFormAccionado(form,frm) {
 
  cont++;
  numf2++;
  numf2_real++;
  
  fi = document.getElementById('fiel_acc'); // 1   

  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div_a'+numf2; // 3
  fi.appendChild(contenedor); // 4
    
      ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Fecha: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 

  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fechaTitulo'+numf2; 
  ele.id= 'txt_input';
  ele.className= 'required tg';
  
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);jQuery(document).ready(function()
			{
			  jQuery(".tg").datepicker({ changeFirstDay: false	});
			}); 
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Beneficiario: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
 
  
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'beneficiarioTitulo'+numf2; 
  ele.id= 'txt_input';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
   ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
     ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Valor: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
 contenedor.appendChild(ele);  
   
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'valorTitulo'+numf2; 
  ele.id= 'vinculado'+cont;
  ele.className= 'required number';
  contenedor.appendChild(ele); 
    
   ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
     ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Fecha Pago: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fechaPago'+numf2; 
  ele.id= 'txt_input';
  ele.className= 'tf';
  contenedor.appendChild(ele); 
     ele = document.createElement('br'); 
  contenedor.appendChild(ele);
   contenedor.appendChild(ele);jQuery(document).ready(function()
			{
			  jQuery(".tf").datepicker({ changeFirstDay: false	});
			}); 
			
			
			

  <!-- ORDEN DE PAGO NUMERO -->
  <!-- SE ADICIONA LABEL Orden de Pago Numero: -->
  ele          = document.createElement('input'); 
  ele.type     = '<label>'; 
  ele.name     = 'apellido1'+numf2; 
  ele.value    = 'Orden de Pago Numero: ';
  ele.id       = 'estilo_medio';
  ele.disabled = 'true';
  contenedor.appendChild(ele); 
  
  <!-- SE ADICIONA CAMPO DE TEXTO opn -->
  ele           = document.createElement('input'); 
  ele.type      = 'text'; 
  ele.name      = 'opn'+numf2; 
  ele.id        = 'txt_input';
  ele.className = 'required';
  contenedor.appendChild(ele); 

  <!-- SALTO DE LINEA BR -->
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 		
  
  <!-- FIN ORDEN DE PAGO NUMERO -->			

  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div_a'+numf2; // 8
  ele.onclick = function () {borrarForm_accionado(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
 frm.cantidad.value=numf2;
 

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

function borrarForm_accionado(obj) {
  fi = document.getElementById('fiel_acc');
  fi.removeChild(document.getElementById(obj));


  
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
        <div id="titulo_frm">Registrar T&iacute;tulos</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
       <?php while($field = $datos_archivo->fetch()){?>
         <tr>
            <td>Fecha:</td><?php date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?>
            <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $field[fecha];?>" readonly="readonly"/>
              <input name="cantidad" type="hidden" id="cantidad" value="0" />
              <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
              <input type="hidden" name="temp" id="temp" />
              <input type="hidden" name="cantidad2" id="cantidad2" value="0" /></td>
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
             <td><input type="text" name="cedula_demandante" id="txt_input" maxlength="1000" class="" value="<?php echo $field[cedula_demandante]; ?>" /></td>
             
             </tr>
             <tr>
             <td>Nombre Demandante: </td>
             <td><input type="text" name="demandante" id="txt_input" maxlength="1000" class=""  onchange="" value="<?php echo $field[demandante]; ?>"/></td>
             </tr>
             <tr>
             <td>Cédula Demandado: </td>
             <td><input type="text" name="cedula_demandado" id="txt_input" maxlength="1000" class=""  onchange="" value="<?php echo $field[cedula_demandado]; ?>"/></td>
             </tr>
             <tr>
             <td>Nombre Demandado: </td>
             <td><input type="text" name="demandado" id="txt_input" maxlength="1000" class=""  onchange="" value="<?php echo $field[demandado]; ?>"/></td>
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
          <td><input name="fechasalida" type="text"  id="txt_input" readonly="readonly" value="<?php echo $field[fechasalida];?>"/>
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
            <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>DETALLE T&Iacute;TULOS</strong></div></td>
            </tr>
          
          <tr>
          <td></td>
          <td><input type="button" name="btn_input_accionado" id="btn_input_grande" value="Adicionar T&iacute;tulo"  onclick="crearFormAccionado(this,frm)" /></td>
         <?php $i=1; $cont=0;
		 $cont=$datos_TitulosMod->RowCount();
		 ?>
          </tr>
          <input name="cantidadOld" type="hidden" value="<?php echo $cont; ?>" />
          <?php while ($fieldd = $datos_TitulosMod->fetch()){?>          
          <tr>
          <td>Fecha:</td><td> <input name="<?php echo "fechaold".$i ?>" value="<?php echo $fieldd[fecha]; ?>" type="text" id="txt_input" class=" tinicio"/> </span></td>
          <script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>
          </tr>
          <tr>
          <input name="<?php echo "idold".$i ?>" type="hidden" value="<?php echo $fieldd[id]; ?>" />
          <td>Beneficiario:</td><td> <span class="Estilo1"><input name="<?php echo "beneficiarioold".$i; ?>" value="<?php echo $fieldd[beneficiario]; ?>" type="text"  id="txt_input"/> </span></td>
          </tr>
          <tr>
          <td>Valor:</td><td> <span class="Estilo1"><input name="<?php echo "valorold".$i ?>" class="number" value="<?php echo $fieldd[valor]; ?>" type="text"  id="txt_input" /> </span></td>
          </tr>
          <tr>
          <td>Fecha Pago:</td><td> <span class="Estilo1"><input name="<?php echo "fechapagoold".$i ?>" value="<?php echo $fieldd[fechapago]; ?>" type="text"  id="txt_input" class="tinicio"/> </span></td>
          </tr>
		  
		   <tr>
          <td>Orden de Pago Numero:</td><td> <span class="Estilo1"><input name="<?php echo "opnold".$i ?>" value="<?php echo $fieldd[orderpago]; ?>" type="text"  id="txt_input" /> </span></td>
          </tr>
		  
		  
          <tr>
            <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong></strong></div></td>
            </tr>
          <?php $i++; } ?>
          <tr>
               <td colspan="2"><fieldset id="fiel_acc">
               </fieldset></td>
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
