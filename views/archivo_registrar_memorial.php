<?php

$modelo = new archivoModel();


//LISTAS
/*$nombrelista  = 'pa_eps_salud';
$campoordenar = 'des';
$formaordenar = '';
$datoseps     = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/

$id_radi = trim($_GET['nombre']);

$digital = $modelo->get_procesos_esdigital($id_radi);

//echo $digital;


$nombrelista   = 'expe_cuaderno';
$campoordenar  = 'id';
$datosCUADERNO = $modelo->get_lista($nombrelista,$campoordenar);

//SE DEJA COMO ANTES YA QUE LAPERSONA QUE REGISTRA MEMORIALES
//ES POSIBLE QUE PARA DONDE VAYA EL MEMORIAL NO SEA LOS QUE YA TIENE
//EL PROCESO ASIGNADO O CARGADOS
//$datosCUADERNO = $modelo->get_lista_cuadernos($id_radi);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>

<!-- <script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<script src="views/js/ajax/ajax_popupbox.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css"> -->


<script src="views/js/jquery_NV.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>

<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

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
	
	
	
	//PARA ACTIVAR Y DEACTIVAR fila_archivo
	/*var contadorl = 0;
	$("#btliquidacion").click(function(evento){
      	
		evento.preventDefault();
		
		contadorl = contadorl + 1;
		
		if(contadorl == 1){
		
			$('#fila_archivo').show();
			contadorl = contadorl + 1;
		}
		else{
			$('#fila_archivo').hide();
			contadorl = 0;
		}
		
   	});*/
	
	
	
	//----------------INCIDENTE SALUD--------------------------
	
	$('#fila_archivo').hide();
	
	$('#fila_472 ').hide();
	
	
	
	$("#solicitud").change(function(event){
    
		var id        = $("#solicitud").find(':selected').val();
		
		var id_salud  = id.split("-");
		
		
		var opcion_seleccionada = $('#solicitud option:selected').text();
		
		$("#text_lista_ts").val('');
		$("#text_lista_ts").val(opcion_seleccionada);
		
		//alert($("#text_lista_ts").val());
		
		
		//INCIDENTE SALUD
		if(id_salud[0] == 116){
		
			$('#fila_archivo').show();
			
			$('#fila_adicionar').hide();
			
			
			$('#clase_solicitud_salud').html('');
		
			$("#clase_solicitud_salud").load('funciones/traer_datos_lista.php?id='+id_salud[0]+"&idsql="+5);
			
			$('#eps_salud').html('');
		
			$("#eps_salud").load('funciones/traer_datos_lista.php?id='+id_salud[0]+"&idsql="+7);
		
		}
		else{
		
			$('#fila_archivo').hide();
			
			$('#fila_adicionar').show();
			
			$('#clase_solicitud_salud').html('');
			
			$('#eps_salud').html('');
		}
		
		//Devolucíon Oficio Tutela 4-72
		//NO CORRESPONDE AL BLOQUE INCIDENTE SALUD
		//PERO SE USA LA MISMA FUCNION DE $("#solicitud").change(function(event)
		//ADICIONADO EL 27 DE ENERO 2020
		if(id_salud[0] == 72){
		
			$('#fila_472').show();
			
			$('#fila_adicionar').hide();
			
			$('#clase_solicitud').html('');
		
			$("#clase_solicitud").load('funciones/traer_datos_lista.php?id='+id_salud[0]+"&idsql="+5);
		
		}
		else{
		
			$('#fila_472').hide();
			
			//$('#fila_adicionar').show();
			
			$('#clase_solicitud').html('');
		}
		
		if(id_salud[0] == 116 || id_salud[0] == 72){
		
			$('#fila_adicionar').hide();
		
		}
			
			
    });
	
	
	$("#clase_solicitud_salud").change(function(event){
    
		var id        = $("#clase_solicitud_salud").find(':selected').val();
		
		var id_salud  = id.split("-");
		
		$('#subclase_solicitud_salud').html('');
		
		$("#subclase_solicitud_salud").load('funciones/traer_datos_lista.php?id='+id_salud[0]+"&idsql="+6);
	
	});
	
	//----------------FIN INCIDENTE SALUD--------------------------
	
	
	 //-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	 weekHeader: 'Sm',
	 dateFormat: 'yy-mm-dd',
	 firstDay: 1,
	 isRTL: false,
	 showMonthAfterYear: false,
	 yearSuffix: '',
	 showWeek: true,
	 showButtonPanel: true,
	 changeMonth: true,
	 changeYear: true
	 };
	 $.datepicker.setDefaults($.datepicker.regional['es']);
	 //-------------------------------------------------------------------------------------------------------------------------------------------
	
	//PARA LAS FECHAS
	$("#fecha_creacion").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
				
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


</script>
<script type="text/javascript">
</script>

<script type="text/javascript" language="javascript">

</script>
<script type="text/javascript">


num=0;
num1=0;
var array = new Array();

function requerirFecha(frm)
{
	var fecha_reparto = frm.fecha_reparto.value;
	
	if(fecha_reparto=!"")
	{
		frm.idjuzdes.disabled=false;
		frm.idjuzdes.required=true;
	}
	
	
}
numf2=0;
numf2_real=1;

function crearFormMemorial(form,frm) {

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
  
  fecha = frm.fecha_mod.value;
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fecha_modif'+numf2; 
  ele.id= 'txt_input';
  ele.className= 'required';
  ele.value=fecha;
  ele.readOnly =true;
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Tipo Documento: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele);   
   
  
  ele = document.createElement('select'); 
  ele.name = 'tipo_documento'+numf2;  
  ele.id = 'tipo_actuacion-'+numf2;  
  tipo_act=ele;
  ele.className = 'required';
  ele.options[0] = new Option("Memorial");
  ele.options[0].value ="Memorial";
  ele.options[1] = new Option("Oficio");
  ele.options[1].value ="Oficio";
  ele.options[2] = new Option("Recurso");
  ele.options[2].value ="Recurso";
  ele.options[3] = new Option("Otro");
  ele.options[3].value ="Otro";
  ele.options[4] = new Option("Tutelas");
  ele.options[4].value ="Tutelas"; 
  ele.options[5] = new Option("Vigilancia");
  ele.options[5].value ="Vigilancia";    
  
  
  
  
  
  //ele.setAttribute("onChange","tipoActuacion(this.id,tipo_act,idact,idid);");
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Juzgado Destino: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele);   
   
  
  ele = document.createElement('select'); 
  ele.name = 'juzgadodestino'+numf2;  
  ele.id = 'tipo_actuacion-'+numf2;  
  tipo_act=ele;
  ele.className = 'required';
  ele.options[0] = new Option("Juzgado 1 Ejecución");
  ele.options[0].value ="1";
  ele.options[1] = new Option("Juzgado 2 Ejecución");
  ele.options[1].value ="2";
  ele.options[2] = new Option("Oficina Ejecución");
  ele.options[2].value ="7";
  //ele.setAttribute("onChange","tipoActuacion(this.id,tipo_act,idact,idid);");
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);   
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Tipo de solicitud: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
 
/* llenar vector de los tipos de solicitudes*/
  vector_solicitud_nombre_temp = frm.solicitud_nombre.value;
  var vector_solicitud_nombre = vector_solicitud_nombre_temp.split("-");
  
  vector_solicitud_id_temp = frm.solicitud_id.value;
  var vector_solicitud_id = vector_solicitud_id_temp.split("-");
  
  vector_solicitud_prioridad_temp = frm.solicitud_prioridad.value;
  var vector_solicitud_prioridad = vector_solicitud_prioridad_temp.split("-");
  
  i=0;
  count = vector_solicitud_nombre.length;
  //alert(count);
  
  //alert(vector_solicitud_id);
  //alert(vector_solicitud_id[0]);


  ele = document.createElement('select'); 
  ele.name = 'solicitud'+numf2;  
  ele.id = 'tipo_actuacion-'+numf2;  
  tipo_act=ele;
  ele.className = 'required';
  
  while(i<count){  
  ele.options[i] = new Option(vector_solicitud_nombre[i]);
  ele.options[i].value = vector_solicitud_id[i]+"-"+vector_solicitud_nombre[i];
  i++;
  }
  //ele.setAttribute("onChange","tipoActuacion(this.id,tipo_act,idact,idid);");
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);  
   
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Peticionario: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'peticionario'+numf2; 
  ele.id= 'txt_input80';
  ele.className= 'required';
  contenedor.appendChild(ele); 
    
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
   ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Folios: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'folios'+numf2; 
  ele.id= 'txt_input80';
  ele.className= 'required number';
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
    
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= 'Recibe: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  var usu_recibe_id = frm.usuario_recibe_id.value;
  var usu_recibe_nombre = frm.usuario_recibe_nombre.value;
  
  ele = document.createElement('select'); 
  ele.name = 'usu_recibe'+numf2;  
  ele.id = 'tipo_actuacion-'+numf2;  
  tipo_act=ele;
  ele.className = 'required';
  ele.options[0] = new Option(usu_recibe_nombre);
  ele.options[0].value =usu_recibe_id;
  //ele.setAttribute("onChange","tipoActuacion(this.id,tipo_act,idact,idid);");
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);  
  
  
  //***********************ADICIONADO POR JORGE ANDRES VALENCIA 12 DE AGOSTO 2015*********************************** 
  
  //LABEL
  ele          = document.createElement('input'); 
  ele.type     = '<label>'; 
  ele.name     = 'apellido1'+numf2; 
  ele.value    = 'Observacion: ';
  ele.id       = 'estilo_medio';
  ele.disabled = 'true';
  contenedor.appendChild(ele); 
  
   //ESPACIO
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);  
  
  
  //LABEL
  ele          = document.createElement('input'); 
  ele.type     = '<label>'; 
  ele.name     = 'apellido1'+numf2; 
  ele.value    = '';
  ele.id       = 'estilo_medio';
  ele.disabled = 'true';
  contenedor.appendChild(ele); 
  
  //TEXTAREA
  ele           = document.createElement('textarea'); 
  ele.type      = 'textarea'; 
  ele.name      = 'observacionesm'+numf2; 
  ele.id        = 'txt_input';
  //ele.className = 'required';
  ele.cols      = '45'; 
  ele.rows      = '5'; 
  ele.maxlength = '1000';
  ele.title     = 'observacionesm'+numf2;
  contenedor.appendChild(ele); 
  
  //ESPACIO
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);  
  //******************************************************************************************************************** 
  
  
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

 frm.cantidad_memoriales.value=numf2;

}

function borrarForm_accionado(obj) {
  fi = document.getElementById('fiel_acc');
  fi.removeChild(document.getElementById(obj));
  
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
  
  //ASI ESTABA
  //radicado = area+relleno+numero_juzgado+ano+"00"+consecutivo+instancia;
  
  radicado = area+relleno+numero_juzgado+ano+consecutivo+instancia;
  //alert(radicado);
  frm.radicado.value = radicado; 
  
}







--> 


</script></head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_archivo.php'; ?>

<?php require 'funciones/Funciones.php'; 
$funcion = new Funciones();
?>

<div id ="block"></div>
<div id="popupbox"></div>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">REGISTRAR MEMORIAL</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
       <?php while($field = $datos_archivo->fetch()){
		   $posicion = $field[posicion];

		    $cadenaPosicion =  explode ("-",$posicion);
			//$caja           = $cadenaPosicion[0];
			//$archivador     = $cadenaPosicion[1];
			//$columna        = $cadenaPosicion[2];
			//$fila           = $cadenaPosicion[3];
			
			$caja       = $funcion->ReturnNumbers($cadenaPosicion[0]);
			$archivador = $funcion->ReturnNumbers($cadenaPosicion[1]);
			$columna    = $funcion->ReturnNumbers($cadenaPosicion[2]);
			$fila       = $funcion->ReturnNumbers($cadenaPosicion[3]);
		   
		   
		   ?>
       <tr>
       <td>Fecha: 
    <?php  date_default_timezone_set('America/Bogota'); 
           //$fechaa=date('Y-m-d g:ia');
		   $fechaa=date('Y-m-d g:i');
		   $ano= date('Y');
?>
    <input name="fecha_mod" type="hidden" value="<?php echo $fechaa;?>" />       </td><?php date_default_timezone_set('America/Bogota'); 

      /*$fecha=date('Y-m-d g:ia');*/ $fecha=date('Y-m-d g:i');?>
      
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
       <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $fecha;?>" readonly="readonly"/>
         <input name="cantidad" type="hidden" id="cantidad" value="0" />
         <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
         <input type="hidden" name="temp" id="temp" /></td>
       </tr>
             <tr>
            <td>Juzgado:</td>
            <td><?php echo $field[juzgado]; ?>
              <input type="hidden" name="cantidad2" id="cantidad2" value="0" />
              <input type="hidden" name="idjuzgado" id="idjuzgado" value="<?php echo $field[idjuz];?>" /></td>
          </tr> 
          <tr>
            <td width="192">Radicado:</td>
            <td width="388">
			  <!-- ASI ESTABA, SE CAMBIA PARA QUE FUNCIONE LA VENTANA POPUPBOX TOMANDO EL VALOR DEL RADICADO -->
              <!-- <input type="text" name="radicado" id="txt_input" readonly="readonly" class="required" value="<?php //echo $field[radicado]; ?>" /> -->
			 <?php echo $field[radicado]; ?>			 <input type="hidden" name="radicado" id="idjuzgado2" value="<?php echo $field[radicado];?>" /></td>
          </tr>
          
          <tr>
          
             <td>C&eacute;dula Demandante:</td>
             <td><?php echo $field[cedula_demandante]; ?></td>
             </tr>
             <tr>
             <td>Nombre Demandante: </td>
             <td><?php echo $field[demandante]; ?></td>
             </tr>
             <tr>
             <td>Cédula Demandado: </td>
             <td><?php echo $field[cedula_demandado]; ?></td>
             </tr>
             <tr>
             <td>Nombre Demandado: </td>
             <td><?php echo $field[demandado]; ?></td>
             </tr>
          <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>REPARTO</strong></div></td>
           </tr>
           <tr>
           <td>Fecha:</td>
           
           <td><?php echo $fecha_ant=$field[fecha_reparto];?></td>
           </tr>
          <tr>
           <td>Juzgado Reparto:</td>
           <td><?php echo $field[juzgadoreparto];?></td>
           </tr><?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==17 || $_SESSION['idUsuario']==14 )) { ?>
           <?php } ?>
           <tr><?php $actuacion=$datos_siglo[0][actus] ; ?>
             <td>Observaciones: </td>
           <td><textarea name="observaciones" id="txt_input" cols="45" rows="5" maxlength = "1000" disabled="disabled" readonly="readonly"><?php echo $field[observaciones] ;?></textarea> </td>
           <?php ?> </tr>
           <?php while ($fieldd = $detalles->fetch()){ //echo $fieldd[descr];?>
             <tr>
               <td>Fecha: &nbsp;&nbsp; <span class="Estilo1"><?php echo $fieldd[fechad]; ?></span></td>
               <td>Observaci&oacute;n Adicional:&nbsp;&nbsp;<span class="Estilo1"><?php echo $fieldd[descr]; ?></span></td>
             </tr>
                       <?php }?>
                       
                             <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>DATOS MEMORIAL</strong></div></td>
           </tr>
            <tr>
           <td>Tipo Documento:</td>
           
           <td><select name="tipo_documento" id="sl_input" class="required" >
             <option value="Memorial"   <?php if($datos_siglo[0][tipo_documento]=="Memorial"){?>selected="selected"<?php }?>>Memorial </option>
             <option value="Oficio"     <?php if($datos_siglo[0][tipo_documento]=="Oficio"){?>selected="selected"<?php }?>>Oficio</option>
             <option value="Recurso"    <?php if($datos_siglo[0][tipo_documento]=="Recurso"){?>selected="selected"<?php }?>>Recurso</option>
             <option value="Otro"       <?php if($datos_siglo[0][tipo_documento]=="Otro"){?>selected="selected"<?php }?>>Otro</option>
             <option value="Tutelas"    <?php if($datos_siglo[0][tipo_documento]=="Tutelas"){?>selected="selected"<?php }?>>Tutelas</option>
             <option value="Vigilancia" <?php if($datos_siglo[0][tipo_documento]=="Vigilancia"){?>selected="selected"<?php }?>>Vigilancia</option>
           </select></td>
           </tr>
            <tr>
              <td>Juzgado Destino:</td>
              <td><select name="juzgadodestino" id="sl_input" class="required" >
			  	<option value="" selected="selected">Seleccione Juzgado Destino</option>
                <option value="1">Juzgado 1 Ejecuci&oacute;n</option>
                <option value="2">Juzgado 2 Ejecuci&oacute;n</option>
                <option value="7">Oficina Ejecuci&oacute;n</option>
                </select></td>
            </tr>
            <tr>
             <?php
			 /*  vector donde se llenan los datos de la solicitud */	
			 $i=$j=0;
			 $solicitud_nombre=$solicitud_id=$solicitud_prioridad="";
			 $con_reg = $datos_solicitud->rowCount()-1;
			 
			 while($fields = $datos_solicitud->fetch()){
			 
				 $solicitud[$i][nombre]         = $fields[nombre];
				 $solicitud[$i][id]             = $fields[id];
				 $solicitud[$i][idprioridad]    = $fields[idprioridad];
				 $solicitud[$i][nombre_archivo] = $fields[nombre_archivo];
			 
				 if($i!=$con_reg){
				 
					 $solicitud_nombre         = $solicitud_nombre.$fields[nombre]."-";
					 $solicitud_id             = $solicitud_id.$fields[id]."-";
					 $solicitud_prioridad      = $solicitud_prioridad.$fields[idprioridad]."-";
					 $solicitud_nombre_archivo = $solicitud_nombre_archivo.$fields[nombre_archivo]."-";
				 }
				 else
				 {
					 $solicitud_nombre         = $solicitud_nombre.$fields[nombre];
					 $solicitud_id             = $solicitud_id.$fields[id];
					 $solicitud_prioridad      = $solicitud_prioridad.$fields[idprioridad];
					 $solicitud_nombre_archivo = $solicitud_nombre_archivo.$fields[nombre_archivo];
				 }
				 
			 	 $i++;
			 }
			 
			 $cont = count($solicitud);
			 //print_r($solicitud);
 ?>
 
			  <input name="solicitud_nombre"         type="hidden" value="<?php echo $solicitud_nombre; ?>" />
			  <input name="solicitud_id"             type="hidden" value="<?php echo $solicitud_id; ?>" />
			  <input name="solicitud_prioridad"      type="hidden" value="<?php echo $solicitud_prioridad; ?>" />
			  <input name="solicitud_nombre_archivo" type="hidden" value="<?php echo $solicitud_nombre_archivo; ?>" />
     
              <td>Tipo de solicitud:</td>
              <td><select name="solicitud" class="required" id="solicitud" >
			  
                <option value="" selected="selected">Seleccione una solicitud</option>
                <?php
 				while($j< $cont){
 ?>
                <option value="<?php echo $solicitud[$j][id]."-".$solicitud[$j][nombre]."-".$solicitud[$j][nombre_archivo];?>" ><?php echo $solicitud[$j][nombre]; ?></option>
				
                <?php 
				$j++;
				
				}
				?>
              </select></td>
            </tr>
			
			
			<tr id="fila_archivo">
			
				<td colspan="2">
				
					
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Clase Solicitud:</label><br><br>
					<select name="clase_solicitud_salud" id="clase_solicitud_salud" >
                		<option value="" selected="selected">Seleccione Clase Solicitud</option>
					 </select><br><br>
					 
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">SubClase Solicitud:</label><br><br>
					<select name="subclase_solicitud_salud" id="subclase_solicitud_salud" >
                		<option value="" selected="selected">Seleccione SubClase Solicitud</option>
					 </select><br><br>
					 
					 
					 <br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Eps:</label><br><br>
					 <select name="eps_salud" id="eps_salud">
						<option value="" selected="selected">Seleccionar Eps</option> 
						
						<?php
						/*while($row = $datoseps->fetch()){
																		
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																
						}*/
						?>
						
					 </select><br><br>
					 
					 <br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Telefono:</label><br><br>
              		 <input type="text" name="telefono" id="txt_input"/><br><br>

					 
					 
						
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">NOTA:</label><br><br>
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">DEBE SELECCIONAR EL ARCHIVO ESCANEADO OBLIGATORIAMENTE, DE LO CONTRARIO EL SISTEMA INDICARA QUE NO ES POSIBLE EL REGISTRO DEL MEMORIAL Y DEBERA INGRESAR TODA LA INFORMACION NUEVAMENTE</label><br><br>
					
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Archivo Escaneado</label><br><br>
					<input type="file" name="archivo" id="archivo" title="Archivo Escaneado" size="19"/>
					
				</td>
							
			</tr>
			
			
			<tr id="fila_472">
			
				<td colspan="2">
				
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Clase Solicitud:</label><br><br>
					<select name="clase_solicitud" id="clase_solicitud" >
                		<option value="" selected="selected">Seleccione Clase Solicitud</option>
					 </select>
					 	
				</td>
							
			</tr>
			
			
            <tr>
              <td>Peticionario:</td>
              <td><input type="text" name="peticionario" id="txt_input" class="required"/></td>
            </tr>
            <tr>
              <td>Folios:</td>
              <td><input type="text" name="folios" id="txt_input" class="required number" /></td>
            </tr>
			
			
			<?php
			
			if($digital == 1){
			
			?>
			
			<tr>
				
				<input type="hidden" name="digital" id="digital" value="<?php echo $digital; ?>" readonly="true"/>
				<input type="hidden" name="text_lista_ts" id="text_lista_ts" readonly="true"/>
				
				<td>Cuadernos:</td>
				
				<td>
					<select id="cuaderno" name="cuaderno" class="required">
					
						<option value="" selected="selected">Seleccionar Cuaderno</option> 
						
						
						<?php
						while($row = $datosCUADERNO->fetch()){
																					
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																					
																					
						}
						?>
						
						
						
					</select>
				
				</td>
			
			</tr>
			
			
			<tr>
			
				<td>A despacho:</td>
								
				<td>
															
					<select name="a_despacho" id="a_despacho" class="required">
												
													
						<option value="" selected="selected">Seleccionar A Despacho</option>
																
						<option value="0">NO</option>
						<option value="1">SI</option>
										
					</select>
				</td>
			
			
			
			</tr>
			
			<?php
			
			}
			
			?>
			
			<tr>
				 <td>Fecha Creacion:</td>
				<td>
					<input type="text" class="required" name="fecha_creacion" id="fecha_creacion" readonly="readonly">
				</td>
			<tr>
			
            <tr>
              <td>Recibe:</td>
              <td><label><input name="recibe" type="hidden" value="<?php echo $_SESSION['idUsuario'];?>" />
                 <select name="recibe1" class="required" id="sl_input"  disabled="disabled" >
                   <option value="<?php echo $_SESSION['idUsuario'];?>" ><?php echo $_SESSION['nombre']; ?></option>
                 </select>
                 <input name="usuario_recibe_id" type="hidden" value="<?php echo $_SESSION['idUsuario'];?>" />
                 <input name="usuario_recibe_nombre" type="hidden" value="<?php echo $_SESSION['nombre']; ?>" />
                 <input name="cantidad_memoriales" type="hidden" value="0" />
              </label></td>
            </tr>
			
			
			
			<tr>
			
			 <td>Observaciones: </td>
           	 <td><textarea name="observacionesm" id="txt_input" cols="45" rows="5" maxlength = "1000" ></textarea> </td>
			
			</tr>
			
			<!-- ADICIONADO EL 29 DE ABRIL 2020, PARA PODER SUBRIL EL MEMORIAL -->
			
			<tr>
			
				<td colspan="2">
					
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">CARGAR MEMORIAL</label><br><br>
					<input type="file" name="archivomemo" id="archivomemo" title="CARGAR MEMORIAL" size="19"/>
					
				</td>
				
			
			</tr>
			
			
			
             <tr id="fila_adicionar">
              
			   <td>&nbsp;</td>
               <td><input type="button" name="btn_input_accionado" id="btn_input_grande" value="Adicionar Memorial"  onclick="crearFormMemorial(this,frm)" /></td>
			   
             </tr>
			 
             <tr>
              	
				<td colspan="2">
			   		<fieldset id="fiel_acc">
               		</fieldset>
				</td>
				
              </tr>
			   
          <tr>
            
			<td>&nbsp;</td>
            <td>
				<input type="submit" name="Submit" value="Actualizar" id="btn_input">
                <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>		    
			</td>
			
          </tr>
		  
        </table>
        
        <?php }?>
      </form>
    </div></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
		<?php require 'alertas.php';?>
</body>
</html>
