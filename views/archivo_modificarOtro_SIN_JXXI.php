<?php

	$modelo       = new archivoModel();
	//**************************************************************************************************************************
	//EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
	//SEGUN EN EL FORMULARIO QUE ME ENCUENTRE
	
	//$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
	//$nombrelista                    --> tabla que contiene los registros de las acciones
	//$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
	//$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
	//$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45 
	//$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con 
    //	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
	//                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
	//**************************************************************************************************************************
	
	$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '5';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);

?>

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

<script src="views/js/ajax/ajax_popupbox.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

<script src="views/js/ajax/ajax_modificarOtro.js" type="text/javascript" charset="utf-8"></script>


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
	
	//PARTE AGREGADA EL 07 DE MAYO DEL 2015 PARA EL MANEJO DEL TRASLADO ART. 108
	
	//PARA LAS FECHAS
	$("#fechaj").datepicker({ changeFirstDay: false	});		
	$("#fechater").datepicker({ changeFirstDay: false	});			
	$("#fechaaup").datepicker({ changeFirstDay: false	});			
	$("#fechaaup_2").datepicker({ changeFirstDay: false	});			
	//PARA OCULTAR FILA  fila108 y filadespacho
	$('#fila108').hide();
	$('#filadespacho').hide();
	$('#filaterminos').hide();
	$('#filaautoaprueba').hide();
	
	//PARA ACTIVAR Y DEACTIVAR fila108
	var contador = 0;
	$("#bt108").click(function(evento){
      	
		evento.preventDefault();
		
		contador = contador + 1;
		
		if(contador == 1){
		
			$('#fila108').show();
			contador = contador + 1;
		}
		else{
			$('#fila108').hide();
			contador = 0;
		}
   	});
	
	
	
	$(".fijartraslado").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		var juzgadodestino = $(this).attr('data-juzgadodestino');
		var adespacho;
		
		//alert(juzgadodestino);
		
		if($("#ckdespacho").is(':checked')) {  
            //alert("Est� activado"); 
			adespacho = 1; 
        } else {  
            //alert("No est� activado"); 
			adespacho = 0; 
        }  
		
		//alert(adespacho);
		
		if (document.frm.fechaj.value.length == 0){
		
			alert("Definir Fecha Fijacion");
			document.getElementById('fechaj').style.borderColor='#FF0000';
			
		}
		else{
		
			//var fechafijacion = document.frm.fechaj.value;
			var fechat = document.frm.fechaj.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			//alert(fechafijacion);
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+fechat, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				//asi estaba
				//location.href="index.php?controller=archivo&action=Registrar_Traslado108&fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat;
				
				location.href="index.php?controller=archivo&action=Registrar_Traslado108&fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat+"&adespacho="+adespacho+"&juzgadodestino="+juzgadodestino;
				
	
			});

	
		}
	
	
	});
	
	//FIJAR DESPACHO
	var cont = 0;
	$(".fijardespacho").click(function(){
		
		//evento.preventDefault();
		
		cont = cont + 1;
		
		if(cont == 1){
		
			$('#filadespacho').show();
			cont = cont + 1;

		}
		else{
			$('#filadespacho').hide();
			cont = 0;
		}

	});
	
	$(".fijardespacho2").click(function(){
		
		/*var usuario  = $(this).attr('data-usuario');
		
		if(usuario == 19){
		
			var id             = $(this).attr('data-id');
			var radicado       = $(this).attr('data-radicado');
			var juzgadodestino = $(this).attr('data-juzgadodestino');
				
		
			//alert(usuario);
				
			location.href="index.php?controller=archivo&action=Registrar_A_Despacho&id="+id+"&radicado="+radicado+"&juzgadodestino="+juzgadodestino;
		
			
		}
		else{
		
			if (document.frm.obserdespacho.value.length == 0){
					
				alert("Definir Observacion a Despacho");
				document.getElementById('obserdespacho').style.borderColor='#FF0000';
			}
			else{
				
				var id             = $(this).attr('data-id');
				var radicado       = $(this).attr('data-radicado');
				var juzgadodestino = $(this).attr('data-juzgadodestino');
				
				var obs = document.frm.obserdespacho.value;
				
				//alert(usuario);
				
				location.href="index.php?controller=archivo&action=Registrar_A_Despacho&id="+id+"&radicado="+radicado+"&juzgadodestino="+juzgadodestino+"&obs="+obs;
			}
		
		}*/
		
			if (document.frm.obserdespacho.value.length == 0){
					
				alert("Definir Observacion a Despacho");
				document.getElementById('obserdespacho').style.borderColor='#FF0000';
			}
			else{
				
				var id             = $(this).attr('data-id');
				var radicado       = $(this).attr('data-radicado');
				var juzgadodestino = $(this).attr('data-juzgadodestino');
				
				var obs = document.frm.obserdespacho.value;
				
				//alert(usuario);
				
				location.href="index.php?controller=archivo&action=Registrar_A_Despacho&id="+id+"&radicado="+radicado+"&juzgadodestino="+juzgadodestino+"&obs="+obs;
			}
			

	});
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		//var id	= $(this).attr('data-id');
		
		//alert(id);
	
		//location.href="index.php?controller=archivo&action=Generar_Documento_Traslado108&opcion=5&id="+id;
		
		//window.open("components/com_bmd/Reporte_Excel/index.php?filtro="+filtro);
		//window.open("views/PHPPdf/Reporte_Traslado108.php?id="+id);
		
		
		
		
		var id       = $(this).attr('data-id');
		var radicado = $(this).attr('data-radicado');
		
		//alert(radicado);
		
		if (document.frm.fechaj.value.length == 0){
		
			alert("Definir Fecha Fijacion");
			document.getElementById('fechaj').style.borderColor='#FF0000';
			
		}
		else{
		
			//var fechafijacion = document.frm.fechaj.value;
			var fechat = document.frm.fechaj.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			//alert(fechafijacion);
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+fechat, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				//location.href="index.php?controller=archivo&action=Registrar_Traslado108&fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat;
				
				window.open("views/PHPPdf/Reporte_Traslado110.php?fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat);
				
	
			});

	
		}
		

	});
	
	//ME PERMITE ASIGNAR FOTOCOPIAS A UN PROCESO
	$(".adicionarfotocopia").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		//location.href="index.php?controller=archivo&action=Generar_Documento_Traslado108&opcion=5&id="+id;
		
		location.href="index.php?controller=aranceljudicial&action=Registro_Arancel&idradicado="+id;
		
		
	});
	
	//ME PONER TITULOS EN CUSTODIA
	$(".encustodia").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=archivo&action=Titulos_Encustodia&idradicado="+id;
		
		
	});
	
	//PARA ACTIVAR Y DEACTIVAR filaterminos
	var contadort = 0;
	$("#btterminos").click(function(evento){
      	
		evento.preventDefault();
		
		contadort = contadort + 1;
		
		if(contadort == 1){
		
			$('#filaterminos').show();
			contadort = contadort + 1;
		}
		else{
			$('#filaterminos').hide();
			contadort = 0;
		}
   	});
	
	$(".fijartermino").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		//alert(id+"***"+radicado);
		
		if (document.frm.fechater.value.length == 0 || document.frm.obsertermino.value.length == 0){
		
			alert("Definir Fecha Termino y Observacion");
			document.getElementById('fechater').style.borderColor='#FF0000';
			document.getElementById('obsertermino').style.borderColor='#FF0000';
			
		}
		else{
		
			//var fechafijacion = document.frm.fechaj.value;
			var fechat = document.frm.fechater.value;
			var obst   = document.frm.obsertermino.value;
			
			$.get("funciones/traer_fecha_termino_2.php?fechat="+fechat, function(cadena){
			
				//alert(cadena);
			
				//location.href="index.php?controller=archivo&action=Registrar_Termino&id="+id+"&radicado="+radicado+"&fechatermino="+fechat+"&obst="+obst;
				
				location.href="index.php?controller=archivo&action=Registrar_Termino&id="+id+"&radicado="+radicado+"&fechatermino="+cadena+"&obst="+obst;
				
			
			});//FIN $.get
			
	
		}

	});
	
	//PARA ACTIVAR Y DEACTIVAR filaautoaprueba
	var contadorap = 0;
	$("#btautoaprueba").click(function(evento){
      	
		evento.preventDefault();
		
		contadorap = contadorap + 1;
		
		if(contadorap == 1){
		
			$('#filaautoaprueba').show();
			contadorap = contadorap + 1;
		}
		else{
			$('#filaautoaprueba').hide();
			contadorap = 0;
		}
   	});
	
	
	
	//ME PERMITE GENERAR DOCUMENTO AUTO APRUEBA LIQUIDACION
	$(".generarautoaprueba").click(function(){
	
	
		var id       = $(this).attr('data-id');
		var radicado = $(this).attr('data-radicado');
		var idj      = $(this).attr('data-idj');
		
		//alert(id+" - "+radicado+" - "+idj);
		
		var autoaprueba;
		
		//alert(juzgadodestino);
		
		if($("#ckautoaprueba").is(':checked')) {  
            //alert("Est� activado"); 
			autoaprueba = 1; 
        } else {  
            //alert("No est� activado"); 
			autoaprueba = 0; 
        }  
		
		
		if (document.frm.fechaaup.value.length == 0 || document.frm.fechaaup_2.value.length == 0){
		
			alert("Definir Fecha Auto y Fecha Fijacion");
			document.getElementById('fechaaup').style.borderColor='#FF0000';
			document.getElementById('fechaaup_2').style.borderColor='#FF0000';
			
		}
		else{
		
			var fechafijacion   = document.frm.fechaaup.value;
			
			var fechafijacion_2 = document.frm.fechaaup_2.value;
			
			var fechas_unidas = fechafijacion_2+"------"+fechafijacion;
			
			//var fechat = document.frm.fechaj.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			//alert(fechafijacion);
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_adelante_atras.php?fechax='+fechas_unidas, function(fechas){
				
				//alert(fechas);
				
				var vector_fechasX = fechas.split("******");
				
				var vector_fechas  = vector_fechasX[0].split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				//FECHA - 1 A LA FECJA DEL AUTO
				var vector_fechas_B = vector_fechasX[1].split("//////");
				fechamenosuno       = vector_fechas_B[1];
				
				//alert(fechamenosuno);
		
				location.href="index.php?controller=archivo&action=Generar_Auto_Aprueba_Liquidacion&datos0c_independiente=1000&idradicado="+id+"&radicado="+radicado+"&idj="+idj+"&opcion="+2+"&fechafijacion="+fechafijacion+"&autoaprueba="+autoaprueba+"&fff="+fff+"&fechamenosuno="+fechamenosuno;
				
	
			});
			
			
			
	
	
		}
		

	});
	
	
	
	$(".consultarproceso").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		var idusuariosesion = $(this).attr('data-idusuariosesion');
		
		//alert(id+"***"+radicado+"***"+idusuariosesion);
		
		location.href="index.php?controller=archivo&action=Registrar_Consulta_Proceso_Ventanilla&id="+id+"&radicado="+radicado+"&idusuariosesion="+idusuariosesion;
		
	
	});
	
	$(".retornarproceso").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		//USUARIO SESION
		var idusuariosesion  = $(this).attr('data-idusuariosesion');
		
		//USUARIO QUE REALIZO PRESTAMO EN VENTANILLA
		var idusuarioconsulta = $(this).attr('data-idusuarioconsulta');
		
		//alert(id+"***"+radicado+"***"+idusuariosesion);
		
		//alert(idusuariosesion+"***"+idusuarioconsulta);
		
		if(idusuariosesion == idusuarioconsulta){
			
			location.href="index.php?controller=archivo&action=Registrar_Retorno_Proceso_Ventanilla&id="+id+"&radicado="+radicado+"&idusuariosesion="+idusuariosesion;
		}
		else{
			
			alert("NO ES POSIBLE ESTA ACCION, DEBE SER EJECUTADA POR EL SERVIDOR JUDICIAL QUE REALIZO EL PRESTAMO AL USUARIO EN VENTANILLA");
		}
		
		

	});
	
	$(".asignar_tramite_interno").click(function(){
	

		if (document.frm.fecha_actusfti.value.length == 0 || 
		    document.frm.actuacion.value.length      == 0 ||
			document.frm.asignadoa.value.length      == 0 
		){
		
			alert("Definir Actuaci�n Interna, Fecha Final y Asignado A");
			document.getElementById('fecha_actusfti').style.borderColor='#FF0000';
			document.getElementById('actuacion').style.borderColor='#FF0000';
			document.getElementById('asignadoa').style.borderColor='#FF0000';
			
		}
		else{
		
			var id_radi        = $(this).attr('data-idradicado');
		
			var actu_fechaf    = $('#fecha_actusfti').val(); 
			var actu_accion    = $('#actuacion').val();
			var actu_asignadoa = $('#asignadoa').val();
			
			//alert(id_radi+"------"+actu_fechaf+"------"+actu_accion+"------"+actu_asignadoa);
			
			location.href="index.php?controller=archivo&action=Asignar_Tramite_Interno_2&id_radi="+id_radi+"&actu_fechaf="+actu_fechaf+"&actu_accion="+actu_accion+"&actu_asignadoa="+actu_asignadoa;
		
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
	
	var userid = frm.user_id.value;
	//alert(userid);
	
	var fecha_reparto = frm.fecha_reparto.value;
	
	if(fecha_reparto=!"")
	{
		if(userid == 8 || userid == 48 || userid == 38 || userid == 51 || userid == 5){
		
			frm.idjuzdes.disabled=false;
			frm.idjuzdes.required=true;
		}
	}
	
	
}
numf2=0;
numf2_real=1;

function crearFormAccionado(form,frm) {

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
  ele.value= 'Descripci�n: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
 

  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'descripcion_modif'+numf2; 
  ele.id= 'txt_descripcion_solicitud';
  ele.className= 'required';
  contenedor.appendChild(ele); 

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


function construir_posicion(frm)
{ 
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


--> 
function vinculo4(variable)
{
//alert(variable);
location.href="index.php?controller=archivo&action=generarActa&nombre=4&nombre1="+variable;
//document.write(location.href) 
}

function vinculoMemorial(variable)
{

location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+variable;
//document.write(location.href) 

}

function vinculoSalida(variable)
{

location.href="index.php?controller=archivo&action=regSalidaExpediente&nombre="+variable;
//document.write(location.href) 

}
function ModificarDocumentoSimeco()
{

location.href="index.php?controller=correspondencia&action=listarDocumentos";
//document.write(location.href) 

}

</script>

<style type="text/css">

.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}

</style>
</head>

<body>

<?php require 'header.php'; ?>

<?php require 'secc_archivo.php'; ?>

<?php require 'funciones/Funciones.php'; 
$funcion = new Funciones();
?>

<div id ="block"></div>
<div id="popupbox"></div>

<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Modificar Archivo</div>
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
			
			//SE REALIZA ESTA PREGUNTA PARA DETERMINAR QUE FUNCIONARIO ENVIA ARCHIVAR EL PROCESO
			if($field[posicion] != ''){
				$funquearchiva   = $field[empleado];
				$fechaquearchiva = $field[fechaquearchiva];
			}
		   	
			//VARIABLE CUANDO SE LE DA FI�ECHA DE FIN DE TERMINO A PROCESO
			//PARA QUE APAREZCA EN LAS ALERTAS DE VENCE TERMINOS
			$fecha_terminos  = $field[fecha_terminos];
			
			//VARIABLES CUANDO SE REALIZA PRESTAMO AL USUAIO EN VENTANILLA
			$consultausuario = $field[consultausuario];
			
			$contadoronsulta = $field[contadoronsulta];
			
			$usuarioconsulta = $field[usuarioconsulta];
			
			$idusuarioconsulta = $field[idusuarioconsulta];
			
			$fecha_consulta  = $field[fecha_consulta];
			
			$idusuarioSESION = $_SESSION['idUsuario'];
			
			
			
			//--------------------------------------------------------------------
			
		   
		   ?>
       <tr>
       <td>Fecha: <input name="ruta" type="hidden" value="<?php echo $var;?>" /><br><br>Fecha Actual en el Sistema:<br><br>Fecha de Carga al Sistema:
    <?php  date_default_timezone_set('America/Bogota'); 
	
           //$fechaa=date('Y-m-d g:ia'); //FORMA PARA XP
		   
		   //FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		   //GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		   //CAMPO fecha QUE ES DATETIME 
		   $fechaa=date('Y-m-d g:i'); 
		   
		   $ano= date('Y');
?><input name="fecha_mod" type="hidden" value="<?php echo $fechaa;?>" />

       </td><?php date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?>
      
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
  		
       <td><input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $fecha;?>" readonly="readonly" title="Fecha del d�a Actual"/>
         <input name="cantidad" type="hidden" id="cantidad" value="0" />
         <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
         <input type="hidden" name="temp" id="temp" />
		<!-- <a id="new" href="javascript:void(0);" title="Acciones del Proceso"><img src="/laborales/eventos/imagenes/toggle_f2.png" width="35" height="35" title="Acciones del Proceso"/>Acciones del Proceso</a> -->
		<input type="text" name="fechaactualsistema" id="txt_input" class="required" value="<?php echo $field[fecha];?>" readonly="readonly" title="Fecha de la ultima actualizaci�n del Proceso por parte de un Funcionario de la Oficina de Ejecuci�n de Sentencias"/>
		<input type="text" name="fechacarga" id="txt_input" class="required" value="<?php echo $field[fecharegistrosistema];?>" readonly="readonly" title="Fecha de Registro del Proceso Cuando es Cargado al Sistema por Primera vez"/>
		
		</td>
	
       </tr>
	   
	   <tr>
	   	
		<td colspan="2" style="color:#FF0000; font-size:14px">
			<?php echo "CONSULTAS AL PROCESO POR USUARIOS EN VENTANILLA: ".$contadoronsulta; ?>
		</td>
	   
	   </tr>
	   
	   <tr>
	   
		 
			
			<?php 
				if($consultausuario == 1){?>
					
					<td>
						<textarea name="Text1" cols="55" rows="3" readonly="readonly" style="color:#FF0000; font-size:14px"><?php echo "PROCESO SE ENCUENTRA EN PRESTAMO A USUARIO DE VENTANILLA, ACCION REALIZADA POR SERVIDOR JUDICIAL: ".$usuarioconsulta.", FECHA: ".$fecha_consulta;?></textarea>
					</td>
					
					<?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
					
					<td style="float:left">
						<a class="retornarproceso" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-idusuariosesion="<?php echo $idusuarioSESION;?>" data-idusuarioconsulta="<?php echo $idusuarioconsulta;?>"><img src="views/images/retorno.png" width="40" height="40" title="RETORNAR PROCESO" style="float:right "/>RETORNAR PROCESO</a>
					</td>
			
			<?php } }else{ ?>
					
					<td>
						-
					</td>
					
					<?php if ( in_array($_SESSION['idUsuario'],$usuariosa) ) { ?>
					
					<td style="float:left">
						<a class="consultarproceso" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-idusuariosesion="<?php echo $idusuarioSESION;?>"><img src="views/images/consulta.Jpg" width="40" height="40" title="PERMITIR CONSULTA DE PROCESO POR USUARIO DE VENTANILLA" style="float:right "/>CONSULTAR PROCESO</a>
					</td>
					
			<?php }} ?>
			
			
	   </tr>
	   
       <tr>
               <td>Seleccione el a&ntilde;o del radicado:</td>
               <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)" <?php if ($radicado=='') { ?><?php } ?>>
                 <option value="">Seleccione el a&ntilde;o</option>
				 <option value="1970" <?php if($datos_radicado[0][ano]==1970){?>selected="selected"<?php }?>>1970</option>
				 <option value="1971" <?php if($datos_radicado[0][ano]==1971){?>selected="selected"<?php }?>>1971</option>
				 <option value="1972" <?php if($datos_radicado[0][ano]==1972){?>selected="selected"<?php }?>>1972</option>
				 <option value="1973" <?php if($datos_radicado[0][ano]==1973){?>selected="selected"<?php }?>>1973</option>
				 <option value="1974" <?php if($datos_radicado[0][ano]==1974){?>selected="selected"<?php }?>>1974</option>
				 <option value="1975" <?php if($datos_radicado[0][ano]==1975){?>selected="selected"<?php }?>>1975</option>
				 <option value="1976" <?php if($datos_radicado[0][ano]==1976){?>selected="selected"<?php }?>>1976</option>
				 <option value="1977" <?php if($datos_radicado[0][ano]==1977){?>selected="selected"<?php }?>>1977</option>
				 <option value="1978" <?php if($datos_radicado[0][ano]==1978){?>selected="selected"<?php }?>>1978</option>
				 <option value="1979" <?php if($datos_radicado[0][ano]==1979){?>selected="selected"<?php }?>>1979</option>
				 <option value="1980" <?php if($datos_radicado[0][ano]==1980){?>selected="selected"<?php }?>>1980</option>
				 <option value="1981" <?php if($datos_radicado[0][ano]==1981){?>selected="selected"<?php }?>>1981</option>
				 <option value="1982" <?php if($datos_radicado[0][ano]==1982){?>selected="selected"<?php }?>>1982</option>
				 <option value="1983" <?php if($datos_radicado[0][ano]==1983){?>selected="selected"<?php }?>>1983</option>
				 <option value="1984" <?php if($datos_radicado[0][ano]==1984){?>selected="selected"<?php }?>>1984</option>
				 <option value="1985" <?php if($datos_radicado[0][ano]==1985){?>selected="selected"<?php }?>>1985</option>
				 <option value="1986" <?php if($datos_radicado[0][ano]==1986){?>selected="selected"<?php }?>>1986</option>
				 <option value="1987" <?php if($datos_radicado[0][ano]==1987){?>selected="selected"<?php }?>>1987</option>
				 <option value="1988" <?php if($datos_radicado[0][ano]==1988){?>selected="selected"<?php }?>>1988</option>
				 <option value="1989" <?php if($datos_radicado[0][ano]==1989){?>selected="selected"<?php }?>>1989</option>
                 <option value="1990" <?php if($datos_radicado[0][ano]==1990){?>selected="selected"<?php }?>>1990</option>
                 <option value="1991" <?php if($datos_radicado[0][ano]==1991){?>selected="selected"<?php }?>>1991</option>
                 <option value="1992" <?php if($datos_radicado[0][ano]==1992){?>selected="selected"<?php }?>>1992</option>
                 <option value="1993" <?php if($datos_radicado[0][ano]==1993){?>selected="selected"<?php }?>>1993</option>
                 <option value="1994" <?php if($datos_radicado[0][ano]==1994){?>selected="selected"<?php }?>>1994</option>
                 <strong><option value="1995" <?php if($datos_radicado[0][ano]==1995){?>selected="selected"<?php }?>>1995</option></strong>
                 <option value="1996" <?php if($datos_radicado[0][ano]==1996){?>selected="selected"<?php }?>>1996</option>
                 <option value="1997" <?php if($datos_radicado[0][ano]==1997){?>selected="selected"<?php }?>>1997</option>
                 <option value="1998" <?php if($datos_radicado[0][ano]==1998){?>selected="selected"<?php }?>>1998</option>
                   <option value="1999" <?php if($datos_radicado[0][ano]==1999){?>selected="selected"<?php }?>>1999</option>
                   <option value="2000"<?php if($datos_radicado[0][ano]==2000){?>selected="selected"<?php }?>>2000</option>
                   <option value="2001"<?php if($datos_radicado[0][ano]==2001){?>selected="selected"<?php }?>>2001</option>
                   <option value="2002"<?php if($datos_radicado[0][ano]==2002){?>selected="selected"<?php }?>>2002</option>
                   <option value="2003"<?php if($datos_radicado[0][ano]==2003){?>selected="selected"<?php }?>>2003</option>
                   <option value="2004"<?php if($datos_radicado[0][ano]==2004){?>selected="selected"<?php }?>>2004</option>
                   <option value="2005"<?php if($datos_radicado[0][ano]==2005){?>selected="selected"<?php }?>>2005</option>
                   <option value="2006"<?php if($datos_radicado[0][ano]==2006){?>selected="selected"<?php }?>>2006</option>
                   <option value="2007"<?php if($datos_radicado[0][ano]==2007){?>selected="selected"<?php }?>>2007</option>
                   <option value="2008"<?php if($datos_radicado[0][ano]==2008){?>selected="selected"<?php }?>>2008</option>
                   <option value="2009"<?php if($datos_radicado[0][ano]==2009){?>selected="selected"<?php }?>>2009</option>
                   <option value="2010"<?php if($datos_radicado[0][ano]==2010){?>selected="selected"<?php }?>>2010</option>
                   <option value="2011"<?php if($datos_radicado[0][ano]==2011){?>selected="selected"<?php }?>>2011</option>
                   <option value="2012"<?php if($datos_radicado[0][ano]==2012){?>selected="selected"<?php }?>>2012</option>
                   <option value="2013"<?php if($datos_radicado[0][ano]==2013){?>selected="selected"<?php }?>>2013</option>
                   <option value="2014"<?php if($datos_radicado[0][ano]==2014){?>selected="selected"<?php }?>>2014</option>
                   <option value="2015"<?php if($datos_radicado[0][ano]==2015){?>selected="selected"<?php }?>>2015</option>
                   <option value="2016"<?php if($datos_radicado[0][ano]==2016){?>selected="selected"<?php }?>>2016</option>
                   <option value="2017"<?php if($datos_radicado[0][ano]==2017){?>selected="selected"<?php }?>>2017</option>
				   <option value="2018"<?php if($datos_radicado[0][ano]==2018){?>selected="selected"<?php }?>>2018</option>
				   <option value="2019"<?php if($datos_radicado[0][ano]==2019){?>selected="selected"<?php }?>>2019</option>
               </select></td>
             </tr>
             <tr>
               <td>Consecutivo (cinco digitos):</td>
               <td><input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="5" minlength="5" class="required" onchange="construir_radicado(frm)" <?php   if($radicado=='') {?>  <?php }?> value="<?php echo $datos_radicado[0][consecutivo]; ?>"/>
               <input type="hidden" name="instancia" id="hiddenField" value="00" />
               <input type="hidden" name="id" id="id" value="<?php //echo ?>" /></td>
             </tr>
             <tr>
            <td>Juzgado:</td>
            <td><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
           
              <?php
 while($fieldj = $datos_juzgados->fetch()){

  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[numero_juzgado];?>"<?php if($fieldj[id]==$field[idjuz]){ ?> selected="selected"<?php }?> ><?php echo $fieldj[nombre] ?></option>
              <?php }?>
            </select>
              <input type="hidden" name="cantidad2" id="cantidad2" value="0" /></td>
          </tr> 
          <tr>
            <td width="151">Radicado:</td>
            <td width="429"><label>
			  <!-- ASI ESTABA, SE CAMBIA PARA QUE FUNCIONE LA VENTANA POPUPBOX TOMANDO EL VALOR DEL RADICADO -->
              <!-- <input type="text" name="radicado" id="txt_input" readonly="readonly" class="required" value="<?php //echo $field[radicado]; ?>" /> -->
			  
			  <input type="text" name="radicado" id="radicado" readonly="readonly" size="30" class="required" value="<?php echo $field[radicado]; ?>" />              
            </label></td>
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
             <td>C�dula Demandado: </td>
             <td><input type="text" name="cedula_demandado" id="txt_input" maxlength="1000" class=""  onchange="" value="<?php echo $field[cedula_demandado]; ?>"/></td>
             </tr>
             <tr>
             <td>Nombre Demandado: </td>
             <td><input type="text" name="demandado" id="txt_input" maxlength="1000" class=""  onchange="" value="<?php echo $field[demandado]; ?>"/></td>
             </tr>    
          
          <tr>
            <td>Piso:              </td>
            <td><select name="piso" id="sl_input" class="">
            	<option value="">Seleccione Piso</option>
               <option value="1" <?php if($field[piso]==1){ ?>selected="selected"<?php } ?>>1</option>
              <option value="4"<?php if($field[piso]==4){ ?>selected="selected"<?php } ?>>4</option>
            </select>
              <input type="hidden" name="lista_ciudades" id="hiddenField3" value="<?php echo $cad_ciu;?>" />
              <input type="hidden" name="lista_ciudades_id" id="hiddenField4" value="<?php echo $cad_ciu_id;?>" />
              <input type="hidden" name="lista_ciudades_iddepa" id="hiddenField5" value="<?php echo $cad_ciu_iddepa;?>" />
              <input type="hidden" name="lista_actuaciones_nombre" id="hiddenField6" value="<?php echo $cad_act;?>" />
              <input type="hidden" name="lista_actuaciones_id" id="hiddenField7" value="<?php echo $cad_act_id;?>" />
              <input type="hidden" name="lista_actuaciones_tipo" id="hiddenField8" value="<?php echo $cad_act_tipo;?>" />
              <input type="hidden" name="hiddenField" id="hiddenField9" value="<?php echo $_GET['nombre'];?>" /></td>      
            
          </tr>
          <tr><?php $prin=$field[idestadoprin];?>
          <td>Estado:</td>
          <td><select name="idestado" class="" id="sl_input" onchange="calcular_estado(frm)">
       <?php
       
       
        if($prin==""){
  ?>
     <option value="" <?php if ($prin==""){?>selected="selected" <?php } ?> >Seleccione un estado</option>
     
<?php }?>
       
            <?php
			
 while($fieldj = $datos_estados->fetch()){
 $est= $fieldj[id];
 

  ?>

  
            <option value="<?php echo $est;?>" <?php if ($prin==$est){?>selected="selected" <?php } ?> ><?php echo $fieldj[nombre] ?></option>
            <?php }?>
          </select></td>
          </tr>
          <tr>
          <td>&nbsp;</td>
          <td><select name="estadosdetalles" id="sl_ciudad">
            <option value="<?php echo $field[idestado];?>"><?php echo $field[estados];?></option>
           
            <?php  while($k<$cont){  
	   if ($ciudad[$k][idestado]==$dp )
	   {
		   
	 ?>
            <option value="<?php echo $ciudad[$k][id]; ?>"><?php echo $ciudad[$k][nombre]; ?></option>
            <?php }$k++;}?>
          </select></td>
          </tr>
		  
		 <!--  <tr>
			  <td>Clase Proceso SIEPRO:</td>
			 
			  <td>
				  <select name="clase_proceso" class="" id="sl_input" onchange="">
						<option value="">Seleccione Clase</option> -->
						<?php
						 //while($fieldj = $datos_claseproceso->fetch()){
						 ?>
							<!-- <option value="<?php //echo $fieldj[id];?>" <?php //if($fieldj[id]==$field[idclapro]){ ?> selected="selected"<?php //}?>  ><?php //echo $fieldj[nombre] ?></option> -->
					<?php //}?>
				  <!-- </select> -->
			  <!-- </td>
          </tr>  -->
          
		  
		  <tr>
		  
		  		<?php 
					
					//CLASE DE PROCESO DE SIGLO XXI
					//EL DATO $cp ME PERMITE ACTUALIZAR
					//EL idclase_proceso DE LA TABLA ubicacion_expediente
					//SI ESTA ES VACIO, YA QUE ES UN DATO QUE SE TRAE DE SIGLO 21
					//SE CIERRA LA FORMA ANTERIOR DE CARGAR LA CLASE DE PROCESO QUE ERA CON UN <select></select>
					//Y PERMITIA AL USUARIO ESCOGER EL PROCESO Y SER ACTUALIZADO
					//EL SISTEMA REALIZARA ESTA OPERACION DE FORMA AUTOMATICA, CON EL DATO $cp COMENTADO ANTERIORMENTE
					$cp  = $dato_claseproceso[0][cp];//cod Siglo XXI
					$dcp = $dato_claseproceso[0][dcp];//Descripcion Siglo XXI
					
					//echo $cp."---".$dcp;
					
				?>
		  	  
				<td>Clase Proceso:</td>
				
				<td>
					<input type="hidden" name="codclaseprocesosigloxxi" id="txt_input" readonly="true"  value="<?php echo $cp; ?>"/>
					<input type="text" name="claseprocesosigloxxi" id="txt_input" maxlength="1000" readonly="true"  value="<?php echo $dcp; ?>"/>  
				</td>
          </tr>
		  
          <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>POSICI&Oacute;N EN EL ARCHIVADOR</strong></div></td>
           </tr>
		  
		  <?php
		   
		  if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==1 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==47 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==36)) {  ?>
		   
          <tr>
             <td>Archivador:</td>
             <td colspan="2"><input type="text" name="archivador" id="txt_input_corto" onchange="construir_posicion(frm)"  maxlength="3" class="" value="<?php echo $archivador; ?>"/></td>
         
           </tr>
           <tr>
           <td> Columna:  </td>
           <td cospan="2"><input type="text" name="columna" id="txt_input_corto" class=			"" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $columna; ?>"   />
           </tr>
           <tr>
           <td>Fila:</td>
           <td><input type="text" name="fila" id="txt_input_corto" class="" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $fila; ?>"/></td>
           </tr>
		   <tr>
           <td>Caja:</td>
           <td><input type="text" name="caja" id="txt_input_corto" class="" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $caja; ?>"/></td>
           </tr>
          <tr>
          <td>Posici�n</td>
          <td><input type="text" name="posicion" id="txt_input" readonly="readonly" class="" value="<?php echo  $posicion; ?>" />
		  <input type="hidden" name="posicion_antigua" id="posicion_antigua" value="<?php echo $posicion;?>" /></td>
          </tr>
		  
		   <?php } else{?>
		   
		   
		   
		   <tr>
             <td>Archivador:</td>
             <td colspan="2"><input type="text" name="archivador" id="txt_input_corto" readonly="readonly" onchange="construir_posicion(frm)"  maxlength="3" class="" value="<?php echo $archivador; ?>"/></td>
         
           </tr>
           <tr>
           <td> Columna:  </td>
           <td cospan="2"><input type="text" name="columna" id="txt_input_corto" readonly="readonly" class="" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $columna; ?>"   />
           </tr>
           <tr>
           <td>Fila:</td>
           <td><input type="text" name="fila" id="txt_input_corto" readonly="readonly" class="" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $fila; ?>"/></td>
           </tr>
		   <tr>
           <td>Caja:</td>
           <td><input type="text" name="caja" id="txt_input_corto" readonly="readonly" class="" maxlength="3"  onchange="construir_posicion(frm)" value="<?php echo $caja; ?>"/></td>
           </tr>
          <tr>
          <td>Posici�n</td>
          <td><input type="text" name="posicion" id="txt_input" readonly="readonly" class="" value="<?php echo  $posicion; ?>" />
		  <input type="hidden" name="posicion_antigua" id="posicion_antigua" value="<?php echo $posicion;?>" /></td>
          </tr>
		   
		   <?php } ?>
		  
		  <?php
		  //PREGUNTO QUE SI EL PROCESO CUENTA CON LA OBSERVACION ASIGNADA DE (PROCESO TERMINADO OFICINA AUXILIAR)
		  //SI, SI PERTENECE AL LOTE DE PROCESOS QUE ESTABAN EN EL ARCHIVADOR 12 Y PASAN A LA OFICINA AUXILIAR
		  //SI LA OBSEVACION NO ES (PROCESO TERMINADO OFICINA AUXILIAR), SE ACTIVA EL CAMPO OBSERVACION 
		  //PARA SER DILIGENCIADO PERO SOLO POR LOS USUARIOS ESPECIFICADOS
		  //SI NO ES EL USUARIO ESPECIFICADO SE CARGA EL CAMPO OBSERBACION INACTIVO
		  if( $field[observacion_archivo] == "PROCESO TERMINADO OFICINA AUXILIAR" ){ 
		  
			  if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==1 || $_SESSION['idUsuario']==47 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==36)) {  ?>
			  
					<tr>
						<td>Observaci�n</td>
						<td><textarea name="observacionesarchivo" id="txt_input" cols="45" rows="5" maxlength = "1000" ><?php echo $field[observacion_archivo]; ?></textarea> </td>
					</tr>
		  <?php }?>
		  
		  <?php 
		  }
		  else{
		  
		  	if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==1 || $_SESSION['idUsuario']==47 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==36)) {  ?>
				
				<tr>
					<td>Observaci�n</td>
					<td><textarea name="observacionesarchivo" id="txt_input" cols="45" rows="5" maxlength = "1000"><?php echo $field[observacion_archivo]; ?></textarea> </td>
				</tr>
		
		<?php 
			}
			else{  ?>
			
				<tr>
					<td>Observaci�n</td>
					<td><textarea name="observacionesarchivo" id="txt_input" cols="45" rows="5" maxlength = "1000" readonly="readonly"><?php echo $field[observacion_archivo]; ?></textarea> </td>
				</tr>
		<?php
			}
		  
		  }
		  
		  ?>
		  
		  
		  
		  
		  <tr>
			   <td bgcolor="#CDE3F6">Funcionario que Archiva:<span class="Estilo1"><?php echo $funquearchiva; ?></td>
			   <td bgcolor="#CDE3F6">Fecha:<span class="Estilo1"><?php echo $fechaquearchiva; ?></td>
          </tr>
		  
		  <!-- ---------------------------------------CODIGO ORGANIZADO POR JORGE ANDRES VALENCIA OROZCO 04 DE DICIEMBRE 2014--------------------------------------------- -->
		  <?php
		  
		  	//DATOS ULTIMA ACTUACION DESPACHO
		  	$fechaRD = $datos_siglob[0][fechard];
		   	$fechaED = $datos_siglob[0][fechadd];
			$actudD  = $datos_siglob[0][actud];
		  
		  	//DATOS ULTIMA ACTUACION SECRETARIA
		  	$fechactus = $datos_siglo[0][fechar];
		   	$fechactud = $datos_siglo[0][fechad];
			$actud     = $datos_siglo[0][actu];
			$actus     = $datos_siglo[0][actus];
			
			//DATOS TRAIDOS DE LA TABLA actuacion_expediente
			//LOS DATOS $dias Y $fechafinal, SE CARGAN DIRECTAMENTE
			//EN LOS CAMPOS DE DIAS Y FECHA FINAL
			//LOS CAMPOS $accion Y $asignadof, QUE CORRESPONDE
			//A ACTUACION INTERNA Y ASIGNADO A, LOS CARGO CON UNA FUNCION 
			//DESDE EL ARCHIVO ajax_modificarOtro.js llamada Buscar_Item_Combo
			//ESTA FUNCION LA LLAMO AL FINAL DE ESTE CODIGO 
			while($fila = $datos_actuacionexpediente->fetch()){
			
				//$fechainicial = $fila[actu_fechai];
				$accion     = $fila[actu_accion];
				$dias       = $fila[actu_dias];
				$fechafinal = $fila[actu_fechaf];
				$asignadof  = $fila[actu_asignadoa];
	
			}
			
		  ?>
		  
		  <tr>
			<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>ACTUACIONES</strong></div></td>
		  </tr>
		  
          <tr>
           
		   		<td>
			   
				   <table>
						<tr>
							<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>�LTIMA ACTUACI�N DESPACHO</strong></div></td>
						</tr>
						
						<tr>
							<td>Fecha Registro:</td>
									  
							<td><input type="text" name="fecha_actusd" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo date_format($fechaRD,'Y-m-d'); ?>"/></td>
							
						</tr>
									   
						<tr>
							<td>Fecha Estado:</td>		   
							<td><input type="text" name="fecha_actudd" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo date_format($fechaED,'Y-m-d'); ?>"/></td>
						</tr>
						<tr>
							<td>Actuaci&oacute;n:</td>		   
							<td><input type="text" name="actudd" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo $actudD; ?>"/></td>
						</tr>
					</table>
				
				</td>
				
				<td>
			   
				   <table> 
						<tr>
							<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>�LTIMA ACTUACI�N SECRETARIA</strong></div></td>
						</tr>
						
						<tr>
							<td>Fecha Registro:</td>
									  
							<td><input type="text" name="fecha_actus" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo date_format($fechactus,'Y-m-d'); ?>"/></td>
							
						</tr>
									   
						<tr>
							<td>Fecha Estado:</td>		   
							<td><input type="text" name="fecha_actud" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo date_format($fechactud,'Y-m-d'); ?>"/></td>
						</tr>
						<tr>
							<td>Actuaci&oacute;n:</td>		   
							<td><input type="text" name="actud" id="txt_input"  disabled="disabled" readonly="readonly" value="<?php echo $actud; ?>"/></td>
						</tr>
					</table>
				
				</td> 
				
				
      
		   </tr>
		   
		   <!-- ENVIO DE FORMA OCULTA EL CODIGO DEL RADICADO PARA SER INSERTADO EN LA TABLA actuacion_expediente, 
		   DEFINO QUE USUARIOS TIENEN ACCESO A ESTA ZONA--> 
		   
		   <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51)) { ?>
		   
		   <tr>
				<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>TR�MITE INTERNO DE PROCESO</strong></div>
				<input type="hidden" name="codradicado" id="codradicad" value="<?php echo $field[id]; ?>" /></td>
		   </tr>
			 
		   <tr>
				<td width="288">Actuaci�n Interna:</td>
				<td width="501"><select name="actuacion" id="actuacion" style="width:258px">
				
					<option value="" selected="selected">Seleccionar Actuaci�n</option>
					 <?php
						while($row = $datos_actuacion->fetch()){
				
							echo "<option value=\"". $row[id] ."\">" . $row[acc_descripcion] . "</option>";
						}
					 ?>
					</select>
					
				</td>
            </tr>
			
			<tr>
				<!-- ES LA FECHA DE ESTADO DE LA �LTIMA ACTUACI�N SECRETARIA
				SE UTILIZA EL FORMATO Y-n-j EN VEZ DE Y-m-d YA QUE AL REALIZAR LA OPERACION
				DE CALCULAR LA FECHA FINAL SEGUN LOS DIAS LA FECHA INICIAL DEBE ESTAR DE LA SIGUIENTE 
				MANERA 2014-11-5 (Y-n-j) Y NO DE ESTA 2014-11-05 (Y-m-d) YA QUE EL CERO DEL DIA
				OCASINA UNA INCOSISTENCIA-->
				<td>Fecha Inicial:</td>  
				<td><input type="text" name="fecha_actusti" id="txt_input" readonly="readonly" value="<?php if (empty($fechactud)) {echo date_format($fechactus,'Y-n-j'); }else{echo date_format($fechactud,'Y-n-j'); }?>"/></td>
							
			</tr>
			
			<tr>
                <td>D�as</td>
                <td><input type="text" name="diasti" id="txt_input" onkeyup="DiasHabiles()" value="<?php echo $dias; ?>"/></td>
            </tr>
			
			<tr>
				<td>Fecha Final:</td>  
				<td><input type="text" name="fecha_actusfti" id="fecha_actusfti" size="34" readonly="readonly" value="<?php echo $fechafinal; ?>"/></td>
							
			</tr>
			
			<tr>
				<td width="288">Asignado A:</td>
				<td width="501"><select name="asignadoa" id="asignadoa" style="width:258px">
				
					<option value="" selected="selected">Seleccionar Asignado A</option>
					 <?php
						while($row = $datos_asignadoa->fetch()){
				
							echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
						}
					 ?>
					</select>
					
				</td>
            </tr>
			
			<tr>
				<td>
					ASIGNAR TRAMITE
				</td>  
				<td>
					
					<a class="asignar_tramite_interno" href="javascript:void(0);" style="float:right" title="ASIGNAR TRAMITE INTERNO" data-idradicado="<?php echo trim($_GET['nombre']);?>"><img src="views/images/retorno.png" width="25" height="25" title="ASIGNAR TRAMITE INTERNO"/></a>				
					
				</td>
							
		    </tr>
			
		 	<?php } ?>
			
			
		 <!-- ------------------------------------------------------------------------------------------------------------------------------------------------ -->
		 
          <tr>
           <td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>REPARTO</strong></div></td>
           </tr>
           <tr>
           <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51)) { ?>
           <td>Repartir:
           </td>
           <td>
             <input type="checkbox" name="ckreparto" id="checkbox"value="1" /> </td> <?php }?> 
           </tr>
           <tr>
           <td>Fecha:</td>
		  
           <td>
		   <!-- SE CREA ESTE CAMPO OCULTO PARA SER USADO EN LA FUNCION requerirFecha Y PODER
		   INDICAR A QUE USUARIOS SE LE DEBE ACTIVA LA LISTA DE Juzgado Reparto--> 
		   <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['idUsuario'];?>" />
		   
		   <?php if( ($_SESSION['idUsuario']== 8 || $_SESSION['idUsuario']== 38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51) ) { ?>
		   
		   <input name="fecha_reparto" onchange="requerirFecha(frm)" type="text" class="tinicio" id="txt_input" value="<?php echo $fecha_ant=$field[fecha_reparto];?>"/>
		   
           <script type="text/javascript" charset="utf-8">
		   
				jQuery(document).ready(function()
				{
				  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
				});
				
			</script>
			<?php }
				  else{?>
				  	<input name="fecha_reparto" type="text" class="tinicio" id="txt_input" readonly="true" value="<?php echo $fecha_ant=$field[fecha_reparto];?>"/>
				<?php }
			?>
           <input type="hidden" name="fecha_antigua" id="fecha_antigua" value="<?php echo $fecha_ant;?>" /></td>
           </tr>
		   
          <tr>
           
			   <td>Juzgado Reparto:
				 
				 <label for="checkbox"></label>
				 
			   </td>
			   
			   <!-- SE INDICA QUE SOLO EL USUARIO CON ID 8 SE LE DEBE ACTIVA LA LISTA DE Juzgado Reparto -->
			   <td>
			   	   
				   <?php if( ($_SESSION['idUsuario']== 8 || $_SESSION['idUsuario']== 38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51) ) { ?>
					
				   <!-- SE CIERRA ESTA LINEA PARA QUE NO SOLICITE ESTE DATO AL DAR CLIC EN ACTUALIZAR, ESTA VALIDACION SE REALIZA EN
				   archivoModel.php en la funcion modificarArchivo_Otro() en la parte if($ckreparto == true) -->	
				   <!-- <select name="idjuzdes" class="required" id="sl_input"> -->
				   <select name="idjuzdes" id="sl_input">
				   
				   <?php } ?>
					   
				   <?php if( ($_SESSION['idUsuario']!= 8 && $_SESSION['idUsuario']!= 38 && $_SESSION['idUsuario']!= 48 && $_SESSION['idUsuario']!=51) ) { ?>
					
				   <select name="idjuzdes" class="" id="sl_input" requerid="requerid" disabled="disabled">
				   
				   <?php } ?>
					   
					   <option value="">Seleccione Destino</option>
						 <?php
						 while($fieldj = $datos_juzgados_destino->fetch()){
							 
							 if(($fieldj[id]==1)|| ($fieldj[id]==2)){
						 
						  
						 ?>
						 
						 <option value="<?php echo $fieldj[id];?>" <?php if($fieldj[id]==$field[idjuzrep]){ ?> selected="selected"<?php }?>  ><?php echo $fieldj[nombre] ?></option>
						 <?php }}?>
						 
				   </select>
					
				   <img src="views/images/icono_word.gif" width="32" height="32" title="Generar Acta" style="cursor:pointer" onclick="vinculo4(<?php echo $_GET['nombre']?>)" />
				 
				 </td>
			 
           </tr>
		   
		   <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51)) { ?>
           <tr>
           <td>Cambiar Ponente:</td><?php $j=0; $cont_desp=count($datos_despachos);?>
           <td><select name="despacho" id="sl_input"><!-- se cierra por el mismo caso comentado anteriormente --><!-- <select name="despacho" class="required" id="sl_input"> -->
                      <option value="">Seleccione el despacho destino</option>
                                       <?php  while($j<$cont_desp){?>
                        <option value="<?php echo $datos_despachos[$j][codi_pone]."-".$datos_despachos[$j][nom_pone]."-".$datos_despachos[$j][codi_enti]."-".$datos_despachos[$j][codi_espe]."-".$datos_despachos[$j][codi_nume];?>" <?php if($datos_despachos[$j][codi_pone]==$field[iddespacho]){ ?> selected="selected"<?php }?> ><?php echo $datos_despachos[$j][nom_pone];?></option>
                       <?php $j++;}?>
                      </select></td>
           </tr>
           <?php } ?>
           <tr><?php $actuacion=$datos_siglo[0][actus] ; ?>
             <td>Observaciones: </td>
           <td><textarea name="observaciones" id="txt_input" cols="45" rows="5" maxlength = "1000" disabled="disabled" readonly="readonly"><?php echo $field[observaciones] ;?></textarea> </td>
           <?php ?> </tr>
           <?php while ($fieldd = $detalles->fetch()){ //echo $fieldd[descr];?>
		   	 <tr>
			   <td colspan="2" bgcolor="#CDE3F6">Funcionario que Aplica la Observaci&oacute;n:<span class="Estilo1"><?php echo $fieldd[funcionario]; ?></span></td>
             </tr>
             <tr>
               <td>Fecha: &nbsp;&nbsp; <span class="Estilo1"><?php echo $fieldd[fechad]; ?></span></td>
               <td>Observaci&oacute;n Adicional:&nbsp;&nbsp;<span class="Estilo1"><?php echo $fieldd[descr]; ?></span></td>
             </tr>
			  
                       <?php }?>
             <tr>
               <td>&nbsp;</td>
               <td>
			   		<input type="button" name="btn_input_accionado" id="btn_input_grande" value="Adicionar Descripci�n"  onclick="crearFormAccionado(this,frm)" />
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51){ ?>
							<!-- <span style="cursor:pointer"><img src="views/images/salir.png"  width="30" alt="" title="Registrar Salida" onclick="vinculoSalida(<?php echo $field[id];?>)" style="float:right " /></span> -->
					<?php } ?>
					
					<?php if( $_SESSION['idUsuario']==2 || $_SESSION['idUsuario']==3 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==51){ ?>
							<span style="cursor:pointer"><img src="views/images/add_memo.png" alt="" width="30" height="30" title="Adicionar Memorial"  onclick="vinculoMemorial(<?php echo $field[id];?>)" style="float:right "  /></span>
					<?php } ?>
					
					
					
					<?php if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==2 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==43 || $_SESSION['idUsuario']==49 || $_SESSION['idUsuario']==51|| $_SESSION['idUsuario']==26){ ?>
							<a class="adicionarfotocopia" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/fotocopias2.png" width="40" height="40" title="ADICIONAR FOTOCOPIA" style="float:right "/></a>
					<?php } ?>
					
					
					
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==51){ ?>
							<a class="fijardespacho" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/idespacho.jpg" width="40" height="40" title="A DESPACHO" style="float:right "/></a>
					<?php } ?>
					
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==28 || $_SESSION['idUsuario']==51){ ?>
							<a class="encustodia" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/money.png" width="40" height="40" title="TITULOS MATERIALIZADOS" style="float:right "/></a>
					<?php } ?>
					
					
					<?php //if( $_SESSION['idUsuario']==3 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38){ ?>
							<!-- <span style="cursor:pointer"><img src="views/images/isimeco.jpg" alt="" width="30" height="30" title="Modificar Documento SIMECO"  onclick="ModificarDocumentoSimeco()" style="float:right "  /></span> -->
					<?php //} ?>
				</td>
             </tr>
             <tr>
               <td colspan="2"><fieldset id="fiel_acc">
               </fieldset></td>
               </tr>
			   
			<tr id="filadespacho">
		  	
				<td colspan="4">
					<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Observacion a Despacho</label><br>
					<input name="obserdespacho" id="obserdespacho" type="text" size="100">
					<a class="fijardespacho2" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>" data-usuario="<?php echo $_SESSION['idUsuario'];?>"><img src="views/images/OK1.jpg" width="30" height="30" title="A DESPACHO" style="float:right "/></a>
				</td>
				
		  </tr>
		
			<!-- APLICAR TRASLADO ART. 108 -->	
			<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==44 || $_SESSION['idUsuario']==29 || $_SESSION['idUsuario']==39 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==5){ ?>
			<tr>
	
				<td colspan="2">
					<a id="bt108" href="javascript:void(0);"><img src="views/images/t108.png" width="30" height="30" title="TRASLADO ART. 108"/>TRASLADO ART. 110</a>
				</td>
				<!-- <td>
					<a class="fila" href="javascript:void(0);" title="DESACTIVAR LISTA TR�MITE"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR LISTA TR�MITE"/>Desactivar</a>
				</td> -->
				
			</tr>
			
		  
		  <tr id="fila108">
		  	
			<td>
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Fijacion</label><br>
				<input name="fechaj" id="fechaj" type="text" readonly="true" size="15">
				<a class="fijartraslado" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/t1083.jpg" width="30" height="30" title="CONFIRMAR TRASLADO ART. 110"/></a>
				<a class="generarword" href="javascript:void(0);" data-id="<?php echo $field['id'];?>"><img src="views/images/pdf-icono.png" width="30" height="30" title="GENERAR TRASLADO"/></a>
			</td>
			<td colspan="4">
            	<input type="checkbox" name="ckdespacho" id="ckdespacho" value="1"/>A Despacho
			</td>
           	
			
		  
		  </tr>
		  <?php } ?>
		  
		  
		  <!-- TERMINOS -->	
			<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==4){ ?>
			<tr>
	
				<td colspan="2">
					<a id="btterminos" href="javascript:void(0);"><img src="views/images/terminos.jpg" width="30" height="30" title="TERMINOS"/>TERMINOS</a>
				</td>
				<!-- <td>
					<a class="fila" href="javascript:void(0);" title="DESACTIVAR LISTA TR�MITE"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR LISTA TR�MITE"/>Desactivar</a>
				</td> -->
				
			</tr>
			
		  
		  <tr id="filaterminos">
		  	
			<td>
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Termino</label><br>
				<input name="fechater" id="fechater" type="text" readonly="true" size="15">
				
				
			</td>
			
			<td>
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Observacion</label><br>
            	<input name="obsertermino" id="obsertermino" type="text" size="50">
				<a class="fijartermino" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>"><img src="views/images/terminos.jpg" width="30" height="30" title="FIJAR FECHA TERMINO"/></a>
				
			</td>
			
           	
		  </tr>
		  <?php } ?>
		  
		  
		  
		   <!-- AUTO APRUEBA LIQUIDACION -->	
			<?php if($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 39 || $_SESSION['idUsuario'] == 51){ ?>
			<tr>
	
				<td colspan="2">
					<a id="btautoaprueba" href="javascript:void(0);"><img src="views/images/aliqui2.png" width="30" height="30" title="AUTO APRUEBA LIQUIDACION"/>AUTO APRUEBA LIQUIDACION</a>
				</td>
				
			</tr>
			
		  
		  <tr id="filaautoaprueba">
		  	
			<td>
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Auto</label><br>
				<input name="fechaaup" id="fechaaup" type="text" readonly="true" size="15"><br>
				
				
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Fijacion</label><br>
				<input name="fechaaup_2" id="fechaaup_2" type="text" readonly="true" size="15">
				
				
				

			</td>
			
			<td colspan="4">
            	<input type="checkbox" name="ckautoaprueba" id="ckautoaprueba" value="1"/>Modifica Liquidacion
				
				<a class="generarautoaprueba" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-idj="<?php echo $field['idjuzrep'];?>" data-radicado="<?php echo $field['radicado'];?>"><img src="views/images/w4.png" width="30" height="30" title="GENERAR AUTO APRUEBA LIQUIDACION"/></a>
			</td>
			
		
		  </tr>
		  <?php } ?>
		  
		  
		  
		  
          <tr>
            
            <td colspan="2">
				<center>
					<input type="submit" name="Submit" value="Actualizar" id="btn_input">
                	<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
				</center>
				
		    </td>
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

<?php 

	//ENVIO LOS CODIGOS DE LA LISTA ACCION Y ASIGNADO A 
	//A LA FUNCION Buscar_Item_Combo PARA SER UBICADO EN LA LISTA
	echo '<script languaje="JavaScript"> 
									
				
				var dat_1 = "'.$accion.'";
				var dat_2 = "'.$asignadof.'";
				var dat_7 = "'.$idusuarioSESION.'"; 
						
				Buscar_Item_Combo(dat_1,dat_2,dat_7);
			
			
				var dat_3 = "'.$fecha_terminos.'";
				
				Vence_Termino(dat_3);
				
				
				var dat_4 = "'.$consultausuario.'";
				
				var dat_5 = "'.$usuarioconsulta.'";
				
				var dat_6 = "'.$fecha_consulta.'";
							
				En_Consulta_Usuario(dat_4,dat_5,dat_6);
				
				
			
		</script>';
			
?>


<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
<?php require 'alertas.php';?>
</body>
</html>
