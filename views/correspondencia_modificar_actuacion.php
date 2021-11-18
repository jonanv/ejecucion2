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
function calcular_ciudad(frm)
{
 departamento = document.frm.departamento.value;
// alert(departamento);
 temp_nombre_ciudad = document.frm.lista_ciudades.value;
 temp_id_ciudad = document.frm.lista_ciudades_id.value;
 temp_iddepa = document.frm.lista_ciudades_iddepa.value;
 
 ciudad_nombre = temp_nombre_ciudad.split(",");
 ciudad_id = temp_id_ciudad.split(",");
 ciudad_iddepa = temp_iddepa.split(",");
 kk= ciudad_iddepa.length;
   
 document.frm.ciudad.options.length = 0;
 i=0;
 j=0;
 x=  document.getElementById("sl_ciudad");
 //alert(x);
 
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
 
function calcular_actuacion(frm,tipo)
{

 tipo_actuacion = document.frm.tipo_actuacion.value;
 temp_nombre_act = document.frm.lista_actuaciones_nombre.value;
 temp_id_act = document.frm.lista_actuaciones_id.value;
 temp_aplica = document.frm.lista_actuaciones_tipo.value;
 
 act_nombre = temp_nombre_act.split(",");
 act_id = temp_id_act.split(",");
 act_tipo = temp_aplica.split(",");
 kk= act_id.length;
 //alert(kk);
   
 document.frm.idactuacion.options.length = 0;
 i=0;
 j=0;
 x=  document.getElementById("sl_actuacion");
 //alert(x);
 
  
 
while(i<kk)
 { 
  tipo_a = act_tipo[i];
  if((tipo_actuacion == 'Tutela'))
  {
  if((tipo_a=='T')||(tipo_a=='2'))
  {
   //alert("tutela");
   x.options[j] = new Option(act_nombre[i]);
   x.options[j].value = act_id[i]  ;
   j++;
  } 
  }
  if((tipo_actuacion == 'Incidente'))
  {
  if((tipo_a=='I')||(tipo_a=='2'))
  {
   //alert("Incidente");
   x.options[j] = new Option(act_nombre[i]);
   x.options[j].value = act_id[i]  ;
   j++;
  } 
  }
  i++;
}
///aquivoy
   

}

</script>

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
        <div id="titulo_frm">Modificar Actuaci&oacute;n</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
    <?php 

$contador= $cont=$datos_ciudades->rowcount();
$contador = $contador-1;
$i=$k=0;

 while($fieldd = $datos_ciudades->fetch()){
  if($contador!=$i)
  {
   $cad_ciu = $cad_ciu.$fieldd[nombre].",";
   $cad_ciu_id = $cad_ciu_id.$fieldd[id].",";
   $cad_ciu_iddepa = $cad_ciu_iddepa.$fieldd[iddepartamento].",";
   $ciudad[$i][nombre] = $fieldd[nombre];
   $ciudad[$i][id] = $fieldd[id]; 
   $ciudad[$i][iddepartamento] = $fieldd[iddepartamento];     
 
  }
  else
  {
   $cad_ciu = $cad_ciu.$fieldd[nombre];
   $cad_ciu_id = $cad_ciu_id.$fieldd[id]; 
   $cad_ciu_iddepa = $cad_ciu_iddepa.$fieldd[iddepartamento];
   $ciudad[$i][nombre] = $fieldd[nombre];
   $ciudad[$i][id] = $fieldd[id];
   $ciudad[$i][iddepartamento] = $fieldd[iddepartamento];            

  }
  $i++;
 
 }
$contador_a= $cont_a=$datos_actuaciones->rowcount();
$contador_a = $contador_a-1;
$ii=$kk=$jj=0;


while($fielda = $datos_actuaciones->fetch()){
if($contador_a!=$ii)
  {
   $cad_act = $cad_act.$fielda[nombre].",";
   $cad_act_id = $cad_act_id.$fielda[id].",";
   $cad_act_tipo = $cad_act_tipo.$fielda[Aplica].",";
   $actuaciones[$ii][nombre] = $fielda[nombre];
   $actuaciones[$ii][id] = $fielda[id]; 
   $actuaciones[$ii][tipo] = $fielda[Aplica];     
 
  }
  else
  {
   $cad_act = $cad_act.$fielda[nombre];
   $cad_act_id = $cad_act_id.$fielda[id];
   $cad_act_tipo = $cad_act_tipo.$fielda[Aplica];
   $actuaciones[$ii][nombre] = $fielda[nombre];
   $actuaciones[$ii][id] = $fielda[id]; 
   $actuaciones[$ii][tipo] = $fielda[Aplica];        

  }
  $ii++;

}
 

//echo $cont_a;
 
//print_r($actuaciones);
 
 ?>
   
   
   
    <?php 
 while($field = $datos_actuacion->fetch()){ ?>
 

 
          <tr>
            <td>Radicado:</td>
            <td><?php echo $field[radicado];?></td>
          </tr>
          
          <tr>
            <td>Tipo Documento:
              <input type="hidden" name="lista_ciudades" id="hiddenField" value="<?php echo $cad_ciu;?>" />
              <input type="hidden" name="lista_ciudades_id" id="hiddenField" value="<?php echo $cad_ciu_id;?>" />
              <input type="hidden" name="lista_ciudades_iddepa" id="hiddenField" value="<?php echo $cad_ciu_iddepa;?>" />
              <input type="hidden" name="lista_actuaciones_nombre" id="hiddenField" value="<?php echo $cad_act;?>" />
              <input type="hidden" name="lista_actuaciones_id" id="hiddenField" value="<?php echo $cad_act_id;?>" />
               <input type="hidden" name="lista_actuaciones_tipo" id="hiddenField" value="<?php echo $cad_act_tipo;?>" />
               
               
               
               
              
              <input type="hidden" name="id" id="hiddenField" value="<?php echo $_GET['nombre'];?>" />
            <td width="520"><label>
              <input type="radio" name="esoficio_telegrama" id="radio" value="Oficio "<?php if($field[esoficio_telegrama]=="Oficio"){ ?> checked="checked" <?php }?> />
              Oficio 
              <input type="radio" name="esoficio_telegrama" id="radio2" value="Telegrama" <?php if($field[esoficio_telegrama]=="Telegrama"){?> checked="checked" <?php }?> />
              Telegrama
            </label></td>
          </tr>
          <tr>
            <td>N&uacute;mero:</td>
            <td><label>
              <input type="text" name="oficio_telegrama" id="txt_input" value="<?php echo $field[oficio_telegrama];?>" />
            </label>	</td>
          </tr>
		  
		  
		  <tr>
				<td>Fecha Envio:</td>
		  		<td><input name="fecha_envio"  type="text" class="tinicio" id="txt_input" value="<?php echo $field[fecha_envio];?>" readonly="readonly"/>
				<script type="text/javascript" charset="utf-8">
						jQuery(document).ready(function()
						{
						  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
						});
				</script>	
				</td>
		  
		  </tr>
		  
		  
          <tr>
            <td>Direcci&oacute;n:</td>
            <td><input type="text" name="direccion" id="txt_input" value="<?php echo $field[direccion];?>" /></td>
          </tr>
          <tr>
            <td>Departamento:</td>
            <td><label>
              <select name="departamento" id="sl_input" onchange="calcular_ciudad(frm)">
                <option value="<?php echo $dp=$field[iddepa];?>"><?php echo $field[nombredepa];?></option>
    <?php  while($fieldc = $datos_departamentos->fetch()){        ?>
                 <option value="<?php echo $fieldc[id];?>"><?php echo $fieldc[nombre];?></option>
                 <?php }?>
              </select>
            </label></td>
          </tr>
             <tr>
               <td>Ciudad:</td>
               <td><label>
                 <select name="ciudad" id="sl_ciudad">
                   <option value="<?php echo $field[idmunicipio];?>"><?php echo $field[municipio];?></option>
     <?php  while($k<$cont){  
	   if ($ciudad[$k][iddepartamento]==$dp )
	   {
	 ?> 
                   <option value="<?php echo $ciudad[$k][id]; ?>"><?php echo $ciudad[$k][nombre]; ?></option>
                   
     <?php }$k++;}?>              
                </select>
               </label></td>
             </tr>
             <tr>
       
            <td width="260">Medio Notificaci&oacute;n:</td>
            <td><label>
              <select name="medio_notificacion" class="required" id="sl_input">
                <option value="<?php echo $field[idmedionotificacion];?>" selected="selected"><?php echo $field[medio];?></option>
                <?php
while($fieldm = $datos_medio->fetch()){
 
  
 ?>
                <option value="<?php echo $fieldm[id];?>" ><?php echo $fieldm[nombre] ?></option>
                <?php }?>
              </select>
            </label></td>
          </tr>
             
            <tr>
              <td>Asunto:</td><?php  $tipo_ac = $field[tipo_actuacion];?>
              <td><label>
                <select name="tipo_actuacion" id="sl_input" onchange="calcular_actuacion(frm)">
                  <option value="Tutela" <?php 		  
				   if ($field[tipo_actuacion]=='Tutela') {?> selected="selected" <?php }?> >Tutela</option>
                  <option value="Incidente" <?php if ($field[tipo_actuacion]=='Incidente') {?> selected="selected" <?php }?>>Incidente</option>
                </select>
              </label></td>
          </tr>
          
          <tr>
              <td>Actuaci&oacute;n:</td>                     <?php 
						   
			    while($kk<$cont_a)
				{ 
				 $comp= $actuaciones[$kk][tipo]; 
				if($tipo_ac=='Tutela')
				  {
				   
				    if($comp == 'T')
					{
					
					 $lista[$jj][id]=$actuaciones[$kk][id];
					 $lista[$jj][nombre]=$actuaciones[$kk][nombre];
					 $jj++;
					 }
					 if($comp == 2)
					{
					  
					 $lista[$jj][id]=$actuaciones[$kk][id];
					 $lista[$jj][nombre]=$actuaciones[$kk][nombre];
					 $jj++;
					 }
					}
					else
					{
					if($tipo_ac=='Incidente')
				    {
				   
				    if($comp == 'I')
					{
					
					 $lista[$jj][id]=$actuaciones[$kk][id];
					 $lista[$jj][nombre]=$actuaciones[$kk][nombre];
					 $jj++;
					 }
					 if($comp == 2)
					{
					  
					 $lista[$jj][id]=$actuaciones[$kk][id];
					 $lista[$jj][nombre]=$actuaciones[$kk][nombre];
					 $jj++;
					 }
					}
				  }	
										 
					$kk++;
				 }
				 //print_r($lista);
				 $con_lis = count($lista);
				 $y=0;				 
					   
					   ?> 
              <td> <select name="idactuacion" class="required" id="sl_actuacion">
                <option value="<?php echo $field[idactuacion];?>" selected="selected"><?php echo $field[actuacion];?></option>
                    
     <?php  while($y<$con_lis){  	 ?> 
                   <option value="<?php echo $lista[$y][id]; ?>"><?php echo $lista[$y][nombre]; ?></option>
                   
     <?php $y++;}?>      
                   
      
              </select></td>
              
              
    
              
              
          </tr>
		  
		  <tr>
            <td>DESCRIPCION:</td>
            <td>
				<textarea id="descripA" name="descripA" cols="100" rows="20"><?php echo $field[descripcion];?></textarea>
			</td>
          </tr>
           
           <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
          <tr>
            <td>&nbsp;</td>
            <?php }?>
            <td><input type="submit" name="Submit" value="Actualizar" id="btn_input">
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
