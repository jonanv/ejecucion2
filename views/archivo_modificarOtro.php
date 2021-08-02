<?php

	$modelo    = new archivoModel();
	
	$idusuario = $_SESSION['idUsuario'];
	
	
	$id_radicado_2 = $_GET['nombre'];
	
	//SE CAPTURA DE LA TABLA ubicacion_expediente
	$digitalizado_1 = $modelo->get_proceso_digitalizado($id_radicado_2);
	$digitalizado_2 = $digitalizado_1->fetch();
	$digitalizado_3 = $digitalizado_2[digitalizado];
	
	//echo $digitalizado_3;
	
	//SE CAPTURA DE LA TABLA expe_digital, PERO SE CIERRA
	//YA QUE NO DEJARIA QUE EL USUARIO OBSERVE EL CAMBIO
	//DE BOTON ROJO A NO DIGITALIZADO A BOTON VERDE DE DIGITALIZADO
	//YA QUE LA FUNCION ncuadernos_proceso TRAE LOS CUADERNOS
	//DE LA TABLA expe_digital Y SI NO ENCUENTRA NADA DEJA EL BOTON EN ROJO
	//$digitalizado_1_2 = $modelo->ncuadernos_proceso($id_radicado_2);
	//echo $digitalizado_1_2;
	
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

	$idaccion			  = '11';
	$campoordenar         = 'id';
	$datosusuarioacciones_SM = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_SM             = $datosusuarioacciones_SM->fetch();
	$usuariosa_SM			 = explode("////",$usuarios_SM[usuario]);
	
	
	//ID USUARIOS J2, PARA PARAMETRIZAR LOS DIAS QUE SE GENERA LAS ALERTAS DE PROCESOS EN LA PLATAFORMA ALERTA TUTELAS
	//PERO TABIEN SE USA PARA QUE SOLO LOS DEL J2 VEAN LAS OBSERVACIONES QUE ELLOS HACEN Y EN LA OECM NO SE VIZUALICEN
	//id= 18 ---> 53////62////64
	$idaccion	     = '18';
	$campoordenar    = 'id';
	$datosusuarioOBS = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_OBS_1  = $datosusuarioOBS->fetch();
	$usuariosa_OBS_2 = explode("////",$usuarios_OBS_1[usuario]);	
	
	//print_r($usuariosa_OBS_2);
	
	//ID USUARIO JUEZ JEFE J2 DE EJECUCION Y SUS SERVIDORES JUDICIALES
	//id= 19 --->  53////53******IN(62,64)
	$idaccion	     = '19';
	$campoordenar    = 'id';
	$datosusuarioJUZ = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_JUZ_1  = $datosusuarioJUZ->fetch();
	$usuariosa_JUZ_2 = explode("******",$usuarios_JUZ_1[usuario]);	
	
	$usuariosa_JUZ_2b = explode("////",$usuariosa_JUZ_2[0]);
	
	
	//ID USUARIOS QUE PUEDEN ARCHIVAR Y SE VISUALIZA CAMPOS FOLIOS Y CUADERNOS
	$idaccion	       = '27';
	$campoordenar      = 'id';
	$datosusuarioARCHI = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_ARCHI_1  = $datosusuarioARCHI->fetch();
	$usuariosa_ARCHI_2 = explode("////",$usuarios_ARCHI_1[usuario]);	
	
	
	//ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS
	$bandera_entitulos = 0;
	
	$idaccion	      = '28';
	$campoordenar     = 'id';
	$datosusuarioENTI = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosENTI     = $datosusuarioENTI->fetch();
	$usuariosaENTI2	  = explode("////",$usuariosENTI[usuario]);
	
	if ( in_array($_SESSION['idUsuario'],$usuariosaENTI2,true) ){
	
		$bandera_entitulos = 1;
	}
	
	//******************ID USUARIOS QUE PUEDEN VISUALIZAR  HOJA CONTROL DE ENTREGA DE TITULOS***************
	
	$idaccion	      = '29';
	$campoordenar     = 'id';
	$datosusuarioHCET = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosHCET1    = $datosusuarioHCET->fetch();
	$usuariosaHCET2	  = explode("////",$usuariosHCET1[usuario]);
	
	$banderaHCET      = 0;
	
	if ( in_array($_SESSION['idUsuario'],$usuariosaHCET2,true) ){
	
		$banderaHCET = 1;
	}	
	
	//******************FIN ID USUARIOS QUE PUEDEN VISUALIZAR  HOJA CONTROL DE ENTREGA DE TITULOS***************
	
	
	
	//******************ID USUARIOS QUE PUEDEN VISUALIZAR  EXPEDIENTE DIGITAL***************
	
	/*$idaccion	         = '31';
	$campoordenar        = 'id';
	$datosusuarioEXPDIGI = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosEXPDIGI1    = $datosusuarioEXPDIGI->fetch();
	$usuariosaEXPDIGI2	 = explode("////",$usuariosEXPDIGI1[usuario]);
	
	$banderaEXPDIGI      = 0;
	
	if ( in_array($_SESSION['idUsuario'],$usuariosaHCET2,true) ){
	
		$banderaEXPDIGI = 1;
	}*/	
	
	//******************FIN ID USUARIOS QUE PUEDEN VISUALIZAR  EXPEDIENTE DIGITAL***************
	
	
	//******************ID USUARIOS, QUE PUEDEN BLOQUEAR Y DESBLOQUEAR PROCESOS***************
	
	$idaccion	    = '52';
	$campoordenar   = 'id';
	$datosusuario52 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_52_1  = $datosusuario52->fetch();
	$usuarios_52_2	= explode("////",$usuarios_52_1[usuario]);
	
	$bandera52      = 0;
	
	if ( in_array($_SESSION['idUsuario'],$usuarios_52_2,true) ){
	
		$bandera52 = 1;
	}	
	
	//******************FIN ID USUARIOS, QUE PUEDEN BLOQUEAR Y DESBLOQUEAR PROCESOS***************
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>

<!-- <script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script> -->


<!-- PARA EFECTO EN LOS BOTONES ESTILO  bootstrap-->
<link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css"/>
<link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css"/>
<link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css"/>
<link rel="stylesheet" href="assets/css/style.css"/> 
<!-- FIN PARA EFECTO EN LOS BOTONES ESTILO  bootstrap-->


<script src="views/js/jquery_NV.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>


<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<link href="views/css/main.css" rel="stylesheet" type="text/css">


<script src="views/js/ajax/ajax_popupbox.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">
<script src="views/js/ajax/ajax_modificarOtro.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ > 


<!-- DataTables example Child rows (show extra / detailed information) -->

<link rel="stylesheet" type="text/css" href="views/viewstablas/jquery.dataTables.css"/>
<!-- <link rel="stylesheet" type="text/css" href="views/viewstablas/demo.css"/> -->


<!-- <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<script src="views/js/select_dependientes.js" type="text/javascript"></script>

<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<script src="views/js/ajax/ajax_popupbox.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

<script src="views/js/ajax/ajax_modificarOtro.js" type="text/javascript" charset="utf-8"></script> -->




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
	$("#fecha_reposi").datepicker({ changeFirstDay: false	});			
	
	
	//PARA OCULTAR FILA  fila108 y filadespacho
	$('#fila108').hide();
	$('#filadespacho').hide();
	$('#filaterminos').hide();
	$('#filaautoaprueba').hide();
	$('#fila_traslado_reposicion').hide();
	
	
	//PARA TRASLADO REPOSICION
	var contador_reposi = 0;
	$("#bt_reposi").click(function(evento){
      	
		evento.preventDefault();
		
		contador_reposi = contador_reposi + 1;
		
		if(contador_reposi == 1){
		
			$('#fila_traslado_reposicion').show();
			contador_reposi = contador_reposi + 1;
		}
		else{
			$('#fila_traslado_reposicion').hide();
			contador_reposi = 0;
		}
   	});
	
	
	$(".fijar_reposi").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		//alert(id+" "+radicado);
		
		var juzgadodestino = $(this).attr('data-juzgadodestino');
		//alert(juzgadodestino);
		
		/*var adespacho;
		
		if($("#ckdespacho").is(':checked')) {  
            //alert("Está activado"); 
			adespacho = 1; 
        } else {  
            //alert("No está activado"); 
			adespacho = 0; 
        }  
		
		//alert(adespacho);*/
		
		if (document.frm.fecha_reposi.value.length == 0){
		
			alert("Definir Fecha Fijacion");
			document.getElementById('fecha_reposi').style.borderColor='#FF0000';
			
		}
		else{
		
			//var fechafijacion = document.frm.fechaj.value;
			var fechat = document.frm.fecha_reposi.value;
			
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
				
				location.href="index.php?controller=archivo&action=Registrar_Traslado_Reposicion&fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat+"&juzgadodestino="+juzgadodestino;
				
	
			});

	
		}
	
	
	});
	
	
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
            //alert("Está activado"); 
			adespacho = 1; 
        } else {  
            //alert("No está activado"); 
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
            //alert("Está activado"); 
			autoaprueba = 1; 
        } else {  
            //alert("No está activado"); 
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
		
			alert("Definir Actuación Interna, Fecha Final y Asignado A");
			document.getElementById('fecha_actusfti').style.borderColor='#FF0000';
			document.getElementById('actuacion').style.borderColor='#FF0000';
			document.getElementById('asignadoa').style.borderColor='#FF0000';
			
		}
		else{
		
			var id_radi        = $(this).attr('data-idradicado');
		
			var actu_fechai    = $('#fecha_actusti').val(); 
			var actu_fechaf    = $('#fecha_actusfti').val(); 
			var actu_dias      = $('#diasti').val();
			
			var actu_accion    = $('#actuacion').val();
			var actu_asignadoa = $('#asignadoa').val();
			
			//alert(id_radi+"------"+actu_fechai+"------"+actu_fechaf+"------"+actu_dias+"------"+actu_accion+"------"+actu_asignadoa);
			
			location.href="index.php?controller=archivo&action=Asignar_Tramite_Interno_2&id_radi="+id_radi+"&actu_fechaf="+actu_fechaf+"&actu_accion="+actu_accion+"&actu_asignadoa="+actu_asignadoa+"&actu_fechai="+actu_fechai+"&actu_dias="+actu_dias;
		
		}
		
	});
	
	//---------------------PARA  MEMORIALES SIN INCORPORAR AL PROCESO------------------------
	
	$(".marcar_sm").click(function(evento){
		$("input:checkbox").attr('checked', true);
		
		$('#actumo').hide();
								 
	});
	
	$(".desmarcar_sm").click(function(evento){
		$("input:checkbox").attr('checked', false);
		
		$('#actumo').show();
		
		
								 
	});
	
	$(".revisar_sm").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var idspermisoR     = "";
			
			var idspermiso_real = 0;
			
			var fR = 1;
			
			var d0R;
			
			
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('frm_sin_memorial');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 2; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("frm_sin_memorial").rows[r].cells[0].innerText;
				
				if($("#chksm"+fR).is(':checked')) {  
					
					
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"******"+idspermisoR;
						
						
				}
					
				fR = fR + 1;
				
				
			}
			
			
			if(idspermisoR == ""){
			
				alert("No se ha Selecionado Ningun Registro de la Tabla (ALERTA EXISTEN MEMORIALES SIN INCORPORAR AL PROCESO)");

			}
			else{
			
				//alert(idspermiso);
				
				$('#revisarsm').val(idspermisoR);
				
				
	
				//CAPTURO LOS IDS DEL DOCUMENTO EL CUAL QUIERO CORREGIR
				var dato_idR  = $('#revisarsm').val();
				
		
				if (confirm ("ESTA SEGURO DE REALIZAR LA INCORPORACION DE MEMORIALES")) {
				
					//alert(dato_idR);
					
	
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					location.href="index.php?controller=archivo&action=Incorporar_Memorial_Masivo_NV&dato_idR="+dato_idR+"&id_radicado_sm="+$('#id_radicado_sm').val();
				
				}
				
				
			}
								 
	});
	
	 //---------------------PARA  MEMORIALES SIN INCORPORAR AL PROCESO------------------------
	 
	 
	 
	 //REGISTRAR TITULOS 
	$(".reg_titulos").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=archivo&action=regTitulos&nombre="+id;
		
		
	});
	
	
	 //---------------------PARA ARCHIVAR PROCESO------------------------
	
	$(".archivar_proceso").click(function(){
	

		if (document.frm.observacionesarchivo.value.length == 0 || 
		    document.frm.folio_proc.value.length           == 0 ||
			document.frm.cuaderno_proc.value.length        == 0 ||
			document.frm.decision_proc.value.length        == 0 
		){
		
			alert("Definir Observacion, Folios y Cuadernos");
			document.getElementById('observacionesarchivo').style.borderColor = '#FF0000';
			document.getElementById('folio_proc').style.borderColor           = '#FF0000';
			document.getElementById('cuaderno_proc').style.borderColor        = '#FF0000';
			document.getElementById('decision_proc').style.borderColor        = '#FF0000';
			
		}
		else{
		
			var id_radi = $(this).attr('data-idradicado');
			var radi    = $(this).attr('data-radicado_archi');
			
	
			var archi_1 = $('#observacionesarchivo').val(); 
			var archi_2 = $('#folio_proc').val(); 
			var archi_3 = $('#cuaderno_proc').val();
			var archi_4 = $('#posicion').val();
			var archi_5 = $('#decision_proc').val();
			
			
			//alert(id_radi+"------"+radi+"------"+archi_1+"------"+archi_2+"------"+archi_3+"------"+archi_4);
			
			location.href="index.php?controller=archivo&action=Archivar_Proceso&id_radi="+id_radi+"&radi="+radi+"&archi_1="+archi_1+"&archi_2="+archi_2+"&archi_3="+archi_3+"&archi_4="+archi_4+"&archi_5="+archi_5;
		
		}
		
	});
	
	
	$(".sacar_de_anaquelT").click(function(){
	
		var id        = $(this).attr('data-id');
		var radicado  = $(this).attr('data-radicado');
		
		//alert(id+"***"+radicado);
		
		var enanaquel;
		
		//alert(juzgadodestino);
		
		if($("#ckenanaquelt").is(':checked')) {  
            //alert("Está activado"); 
			enanaquel = 1; 
        } else {  
            //alert("No está activado"); 
			enanaquel = 0; 
        }  
		
		
		
		if (document.frm.obseradit.value.length == 0){
		
			alert("Definir Observacion Adicional");
			document.getElementById('obseradit').style.borderColor='#FF0000';
			
		}
		else{
		
			
			var obseraditx   = document.frm.obseradit.value;
			
			if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
			
				location.href="index.php?controller=archivo&action=Registrar_Anaquel_Titulos&id="+id+"&radicado="+radicado+"&obseraditx="+obseraditx+"&enanaquel="+enanaquel;
				
			}
			
		}
		

	});
	
	
	
	//VISUALIZAR HOJA CONTROL DE ENTREGA DE TITULOS
	$('#btHCET').click( function(){
										  
		
		var idhcet         = $(this).attr('data-id');
		var radicadoidhcet = $(this).attr('data-radicado');
			
		//var radicadoidhcet = $("#funcionario_pres").find(':selected').val();
			
		params={};
		
		params.idhcet         = idhcet;
		params.radicadoidhcet = radicadoidhcet;
		
		
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/hoja_control_titulos.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	$(".generarhect_pdf_2").click(function(){
	
		var todo           = 0;
		var id_encabezado  = 0;
		
		var idradi_reporte = $(this).attr('data-id');
		var radi_reporte   = $(this).attr('data-radicado');
		
		
		//TODAS LAS HOJAS DE CONTROL
		window.open("views/tcpdf/GENERAR_HCET.php?todo="+todo+"&id_encabezado="+id_encabezado+"&idradi_reporte="+idradi_reporte+"&radi_reporte="+radi_reporte);
		
	
	
			
	});
	
	
	//VISUALIZAR EXPEDIENTE DIGITAL
	$('#expedigi').click( function(){
	
	
		var idexd       = $(this).attr('data-id');
		var radicadoexd = $(this).attr('data-radicado');
		
		//alert(idexd+" "+radicadoexd);
										  
		
		// definimos la anchura y altura de la ventana
		var altura  = 500;
		var anchura = 1000;
		 
		// calculamos la posicion x e y para centrar la ventana
		var y=parseInt((window.screen.height/2)-(altura/2));
		var x=parseInt((window.screen.width/2)-(anchura/2));
	
		
		//window.open("EXPEDIENTE_DIGITAL/?datos="+idexd+"//////"+radicadoexd,target='blank','width='+anchura+',height='+altura+',top='+y+',left='+x+',toolbar=no,location=no,status=no,menubar=NO,scrollbars=no,directories=no,resizable=no');
		  
		 window.open("EXPEDIENTE_DIGITAL/?datos="+idexd+"//////"+radicadoexd, '_blank', 'toolbar=no, location=yes, status=yes, menubar=yes, scrollbars=yes');
		
    });
	
	//FIN VISUALIZAR EXPEDIENTE DIGITAL
	
	
	//CAMBIAR A ESTADO EXPEDIENTE DIGITALIZADO
	$("#estado_digital").click(function(evento){
	
	
		var id_radi_digi = $(this).attr('data-id');
		
		//alert(id_radi_digi);
		
		var data = new FormData();
						
		data.append('id_radi_digi',id_radi_digi);
		
		
		if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
										
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=archivo&action=Estado_Digital_Proceso',
					type:'POST', //Metodo que usaremos
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					//data:dataString, //Le pasamos el objeto que creamos con los archivos
					data:data,
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
										
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');//Mostramos el div.
										
					//DESAPARECER
					setTimeout(function() {
											
						$(".mensage").fadeOut(1500);
											
											
							location.href="index.php?controller=archivo&action=edit_archivoOtro&nombre="+id_radi_digi;
											
							
											
						},3000);
										
									
			});
									
									
									
								
		}
	
	
	});
	
	$(".descarga_recibido").click(function(evento){
	
		
			var idrecibido = $(this).attr('data-idrecibido');
			
			window.open("views/tcpdf/RECIBIDO.php?iddda_acta="+idrecibido);

			
	});
	
	
	
	//BLOQUEAR PROCESO
	$("#bloquear_proceso").click(function(evento){
	
	
		var id_radibloc1 = $(this).attr('data-id');
		var radibloc1    = $(this).attr('data-radicado');
		
		//alert(id_radi_digi);
		
		var data = new FormData();
						
		data.append('id_radibloc1',id_radibloc1);
		data.append('radibloc1',radibloc1);
		
		
		if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
										
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=archivo&action=Bloquear_Proceso',
					type:'POST', //Metodo que usaremos
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					//data:dataString, //Le pasamos el objeto que creamos con los archivos
					data:data,
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
										
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');//Mostramos el div.
										
					//DESAPARECER
					setTimeout(function() {
											
						$(".mensage").fadeOut(1500);
											
											
							//location.href="index.php?controller=archivo&action=edit_archivoOtro&nombre="+id_radibloc1;
							
							location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
											
							
											
						},3000);
										
									
			});
									
									
									
								
		}
	
	
	});
	
	
	//DESBLOQUEAR PROCESO
	$("#desbloquear_proceso").click(function(evento){
	
	
		var id_radibloc1 = $(this).attr('data-id');
		
		//alert(id_radi_digi);
		
		var data = new FormData();
						
		data.append('id_radibloc1',id_radibloc1);
		
		
		if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
										
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=archivo&action=Desbloquear_Proceso',
					type:'POST', //Metodo que usaremos
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					//data:dataString, //Le pasamos el objeto que creamos con los archivos
					data:data,
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
										
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');//Mostramos el div.
										
					//DESAPARECER
					setTimeout(function() {
											
						$(".mensage").fadeOut(1500);
											
											
							location.href="index.php?controller=archivo&action=edit_archivoOtro&nombre="+id_radibloc1;
											
							
											
						},3000);
										
									
			});
									
									
									
								
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
		if(userid == 8 || userid == 48 || userid == 38 || userid == 51 || userid == 58){
		
			frm.idjuzdes.disabled=false;
			frm.idjuzdes.required=true;
		}
	}
	
	
}
numf2=0;
numf2_real=1;

function crearFormAccionado(form,frm) {


  //PASAMOS VARIABLES PHP A JAVASCRIPT
  
  //ID USUARIO EN SESION
  //var idusuario = "<?php echo $idusuario; ?>";	
  //alert(idusuario);
  
  //ID USUARIO DEL JUEZ DEL JUZGADO O OTRAS PERSONAS QUE PUEDAN ASIGNAR OBSEVARCION
  //A UN SERVIDOR JUDICIAL
  //var usuariosa_JUZ_2 = "<?php echo $usuariosa_JUZ_2[0]; ?>";	
  //alert(usuariosa_JUZ_2);
  
  //COMPARACION SI EL USUARIO EN SESSION (idusuario), ESTA EN LA CADENA
  //usuariosa_JUZ_2 --> 53////53, YA QUE ES UN USUARIO QUE ASIGNA OBSEVARCION
  //A UN SERVIDOR JUDICIAL
  //var esta_user = usuariosa_JUZ_2.includes( idusuario );---> no manejo esta funcio por que compara es lo que busco con una cadena de texto
  //entonces si un usuario tiene es su id el 3 o 5 tambien lo encuentra		
  //var esta_user = false;
  //var esta      = usuariosa_JUZ_2.split("////");
  //alert(esta_user);
  
  //if (esta.indexOf(idusuario) > -1) {
  		//esta_user = true
  //}
  
 	
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
  ele.value= 'Descripción: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'descripcion_modif'+numf2; 
  ele.id= 'txt_descripcion_solicitud';
  ele.className= 'required';
  contenedor.appendChild(ele);
 
  //------------NUEVO 30 DE JULIO 2018, EN DESARROLLO--------------------
   
  //COMPARACION SI EL USUARIO EN SESSION (idusuario), ESTA EN LA CADENA
  //usuariosa_JUZ_2 --> 53////53, YA QUE ES UN USUARIO QUE ASIGNA OBSEVARCION
  //A UN SERVIDOR JUDICIAL 
  /*if(esta_user == true){ 
  
	  //ADCIONAMOS ESPACIO 
	  ele = document.createElement('br'); 
	  contenedor.appendChild(ele); 
	   
	  //ADICIONAMOS EL LABEL (ASIGNADO A:)  
	  ele = document.createElement('input'); 
	  ele.type     = '<label>'; 
	  ele.name     = 'apellido1'+numf2; 
	  ele.value    = 'Asignado a: ';
	  ele.id       = 'estilo_medio';
	  ele.disabled = 'true';
	  contenedor.appendChild(ele); 
	  
	  //ADICIONAMOS EL COMPONENTE TIPO SELECT
	  ele = document.createElement('select'); 
	  ele.type      = '<select>'; 
	  ele.name      = 'asignadoj'+numf2; 
	  ele.id        = 'asignadoj'+numf2;
	  ele.title     = 'asignadoj'+numf2;
	  ele.className = 'required';
	  contenedor.appendChild(ele);
	  
	  //ADICIONAMOS LAS OPCIONES A LA LISTA SELECT
	  //DESDE LA LISTA OCULTA listauj
	  var miSelect = document.getElementById(ele.id);
	  //var miOption = document.createElement("option");
	  var miOption;
	  
	  //miOption.setAttribute("value","1");
	  //miOption.setAttribute("label","casa");
	  
	  var opciones = document.getElementById("listauj").options;
	  for (var i=0; i<opciones.length; i++){        
			
			miOption         = document.createElement("option");
			var opcion_valor = opciones[i].value;        
			var opcion_texto = opciones[i].text;  
			
			//alert(opcion_valor+' '+opcion_texto);
			
			miOption.setAttribute("value",opcion_valor);
			miOption.setAttribute("label",opcion_texto);      
			
			miSelect.appendChild(miOption);
			
	 }
  
 }*/
 //------------FIN NUEVO--------------------
  

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
  
  //ADICIONADO PARA PODER REGISTRAR TUTELAS EN EL SISTEMA 13 DE ENERO 2016
  if(juzgado=="15-1")
  {
   var area = "170014303"; 
  }
  if(juzgado=="16-2")
  {
   var area = "170014303"; 
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
<!--
.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}

.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}


-->
</style>
</head>

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
  <!-- <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr> -->
  <tr>
    <!-- <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido"> -->
	 <td><!-- <div id="contenido"> -->
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
	  
	  	<input type="hidden" name="revisarsm" id="revisarsm" readonly="true"/>
		
		 <?php
		
			//LISTA SERVIDORES JUDICIALES DEL JUZGADO
			if( in_array($_SESSION['idUsuario'],$usuariosa_JUZ_2b,true) ){
			
				
				$campo_a_mostrar  = 'empleado';
				$campo_a_insertar = 'id';
				$nombre_tabla     = 'pa_usuario';
				$campo_filtro     = 'id';
				$valor_filtro     = $usuariosa_JUZ_2[1];
				$campo_a_ordenar  = 'empleado';
				$datos_user_JUZ   = $modelo->get_lista_con_filtro_IN($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
		?>		
				
				<select name="listauj" id="listauj" style="visibility:hidden">
												
					<option value="" selected="selected">Seleccionar Asignado A</option> 
															
					<?php
					while($row = $datos_user_JUZ->fetch()){
																		
						echo "<option value=\"". $row[id].'-'.$row[empleado] ."\">" . $row[empleado] . "</option>";
																
																
					}
					?>
				</select>
		<?php	
			
			}
		
		?>
		
		
	  
        <center><div id="titulo_frm">MODIFICAR ARCHIVO</div></center>
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
		   	
			//VARIABLE CUANDO SE LE DA FIÇECHA DE FIN DE TERMINO A PROCESO
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
			<td colspan="2">
				<!-- MENSAJES -->
				<div class="mensage"></div>  
			</td>
														
		</tr>
		
		 <!-- EXPEDIENTE DIGITAL -->
		
		<?php 
		
			//SE DEJA DE ESTA FORMA PARA QUE TODOS LOS USUARIOS TENGAN ACCESO
			//$banderaEXPDIGI = 1; 
			
			//if ( $banderaEXPDIGI == 1 ){ 
			
			if ( $digitalizado_3 == 1 /*&&  $digitalizado_1_2 >= 1*/){ 
		?>
							
					<!-- <tr>
											
						<td colspan="2">
											
							<a id="expedigi" href="javascript:void(0);" data-id="<?php //echo $field['id'];?>" data-radicado="<?php //echo $field['radicado'];?>" style="float:right">EXPEDIENTE DIGITAL<img src="views/images/exd1.png" width="150" height="150" title="EXPEDIENTE DIGITAL"/></a> 
													
						</td>
											
											
											
					</tr> -->
					
					
					
					
					 <tr>
	   
						<td colspan="2">
											
					
							<a id="expedigi_2" href="index.php?controller=archivo&action=Expediente_Digital&datosexp=<?php echo $field['id']."******".$field['radicado']; ?>" style="float:right" title="EXPEDIENTE DIGITAL"<?php echo " ".$field['radicado']; ?>>
							 
							<!-- <a id="expedigi_2" href="" style="float:right"> -->	
								<button type="button" class="btn btn-success btn-lg">EXPEDIENTE DIGITAL</button>
								<img src="views/images/expedigi_1.png" width="150" height="150" title="EXPEDIENTE DIGITAL"<?php echo " ".$field['radicado']; ?>/>
							</a>
						
						</td>
						
						
					</tr> 
							
		
		
		<?php }else{ ?>
		
					<tr>
	   
						<td colspan="2">
											
	
							<a id="estado_digital" href="javascript:void(0);" data-id="<?php echo  $field['id'];?>" style="float:right" title="EXPEDIENTE SIN DIGITALIZAR">
								<button type="button" class="btn btn-danger btn-lg">EXPEDIENTE SIN DIGITALIZAR</button>
								<img src="views/images/caratula6.jpg" width="150" height="150" title="EXPEDIENTE SIN DIGITALIZAR"/>
							</a>
							
						</td>
						
						
					</tr> 
		
		<?php } ?>
	
		<!-- FIN EXPEDIENTE DIGITAL -->	   
		   
		
		 <!-- BLOQUEAR/DESBLOQUEAR PROCESOS -->
		
		<?php 
			
			if ($bandera52 == 1){ 
		?>   
		
		
		
			<tr>
	   
				<td colspan="2">
											
	
					<a id="bloquear_proceso" href="javascript:void(0);" data-id="<?php echo  $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" style="float:left" title="BLOQUEAR PROCESO">
					
						<button type="button" class="btn btn-danger">
							<span class="glyphicon glyphicon-remove-circle"></span> Bloquear Proceso
						</button>
						
					</a>
					
					<!-- <a id="desbloquear_proceso" href="javascript:void(0);" data-id="<?php //echo  $field['id'];?>" data-radicado="<?php //echo $field['radicado'];?>" style="float:right" title="DESBLOQUEAR PROCESO">
					
						<button type="button" class="btn btn-primary">
							<span class="glyphicon glyphicon-ok-circle"></span> Desbloquear Proceso
						</button>
						
					</a> -->
							
				</td>
						
						
			</tr> 
					
		<?php 
		
			} 
		?>
		
		 <!-- FIN BLOQUEAR/DESBLOQUEAR PROCESOS -->   
		   
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
  		
       <td>
	   
	   	<input type="text" name="fecha" id="txt_input" class="required" value="<?php echo $fecha;?>" readonly="readonly" title="Fecha del día Actual"/>
         <input name="cantidad" type="hidden" id="cantidad" value="0" />
         <input name="cantidad1" type="hidden" id="cantidad1" value="0" />
         <input type="hidden" name="temp" id="temp" />
		<!-- <a id="new" href="javascript:void(0);" title="Acciones del Proceso"><img src="/ejecucion/eventos/imagenes/toggle_f2.png" width="35" height="35" title="Acciones del Proceso"/>Acciones del Proceso</a> -->
		<br>
		<input type="text" name="fechaactualsistema" id="txt_input" class="required" value="<?php echo $field[fecha];?>" readonly="readonly" title="Fecha de la ultima actualización del Proceso por parte de un Funcionario de la Oficina de Ejecución de Sentencias"/>
		<br>
		<input type="text" name="fechacarga" id="txt_input" class="required" value="<?php echo $field[fecharegistrosistema];?>" readonly="readonly" title="Fecha de Registro del Proceso Cuando es Cargado al Sistema por Primera vez"/>
		
		</td>
	
       </tr>
	   
	   
	   
	    <!-- HOJA CONTROL DE ENTREGA DE TITULOS -->
		
		<?php if ( $banderaHCET == 1 ){ ?>
		
		
							
					<tr>
											
						<td colspan="2">
											
							<a id="btHCET" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>"><img src="views/images/hcet1.jpg" width="55" height="55" title="HOJA CONTROL DE ENTREGA DE TITULOS"/><button type="button" class="btn btn-primary btn-xs">HOJA CONTROL DE ENTREGA DE TITULOS</button></a> 
													
						</td>
											
											
											
					</tr>
							
		
		
		<?php }  else{ ?>
		
		
					<tr>
											
						<td colspan="2">
											
							
							
							<a class="generarhect_pdf_2" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>">
							
							
								<img src="views/images/hcet1.jpg" width="55" height="55" title="HOJA CONTROL DE ENTREGA DE TITULOS"/><button type="button" class="btn btn-primary btn-xs">HOJA CONTROL DE ENTREGA DE TITULOS</button>
								
							
							</a> 
													
							
							 
						</td>
											
											
											
					</tr>
		
		<?php }?>
				
	
		<!-- FIN HOJA CONTROL DE ENTREGA DE TITULOS -->
	   
	   
	   
	
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
				   <option value="2020"<?php if($datos_radicado[0][ano]==2020){?>selected="selected"<?php }?>>2020</option>
				   <option value="2021"<?php if($datos_radicado[0][ano]==2021){?>selected="selected"<?php }?>>2021</option>
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
			  
			  <!-- CAMPO USADO PARA LAS ALERTAS DE MEMORIALES -->
			  <input type="hidden" name="id_radicado_sm" id="id_radicado_sm" readonly="true"  value="<?php echo $_GET['nombre'];?>"/>
			  
			  <input type="text" name="radicado" id="radicado" readonly="readonly" size="30" class="required" value="<?php $id_radicado_sm = $field[radicado]; echo $field[radicado]; ?>" />              
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
             <td>Cédula Demandado: </td>
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
          <td>Posición</td>
          <td><input type="text" name="posicion" id="posicion" readonly="readonly" class="" value="<?php echo  $posicion; ?>" />
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
          <td>Posición</td>
          <td><input type="text" name="posicion" id="posicion" readonly="readonly" class="" value="<?php echo  $posicion; ?>" />
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
						<td>Observación</td>
						<td><textarea name="observacionesarchivo" id="observacionesarchivo" cols="45" rows="5" maxlength = "1000" ><?php echo $field[observacion_archivo]; ?></textarea> </td>
					</tr>
		  <?php }?>
		  
		  <?php 
		  }
		  else{
		  
		  	if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==1 || $_SESSION['idUsuario']==47 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==36)) {  ?>
				
				<tr>
					<td>Observación</td>
					<td><textarea name="observacionesarchivo" id="observacionesarchivo" cols="45" rows="5" maxlength = "1000"><?php echo $field[observacion_archivo]; ?></textarea> </td>
				</tr>
		
		<?php 
			}
			else{  ?>
			
				<tr>
					<td>Observación</td>
					<td><textarea name="observacionesarchivo" id="observacionesarchivo" cols="45" rows="5" maxlength = "1000" readonly="readonly"><?php echo $field[observacion_archivo]; ?></textarea> </td>
				</tr>
		<?php
			}
		  
		  }
		  
		  ?>
		  
		  
		  
		  <?php if( in_array($_SESSION['idUsuario'],$usuariosa_ARCHI_2,true) ){ ?>
		  
		  			<tr>
						
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px">Folios:</label><br>
							<input type="text" id="folio_proc" name="folio_proc"/><br>
							
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px">Cuadernos:</label><br>
							<input type="text" id="cuaderno_proc" name="cuaderno_proc"/><br>
							
							
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px">Decision:</label><br>
							<input type="text" id="decision_proc" name="decision_proc"/>
							
						</td>
						
						<td>
					
							<a class="archivar_proceso" href="javascript:void(0);" style="float:right" title="ARCHIVAR" data-idradicado="<?php echo trim($_GET['nombre']);?>" data-radicado_archi="<?php echo trim($id_radicado_sm);?>"><img src="views/images/doc1.jpg" width="45" height="45" title="ARCHIVAR"/></a>				
					
						</td>
					
					</tr>
	
	
		  <?php } ?>
		  
		  
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
							<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>ÚLTIMA ACTUACIÓN DESPACHO</strong></div></td>
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
							<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>ÚLTIMA ACTUACIÓN SECRETARIA</strong></div></td>
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
				<td colspan="2" bgcolor="#CDE3F6"><div align="center"><strong>TRÁMITE INTERNO DE PROCESO</strong></div>
				<input type="hidden" name="codradicado" id="codradicad" value="<?php echo $field[id]; ?>" /></td>
		   </tr>
			
		   
		   <tr>
				<td width="288">Actuación Interna:</td>
				<td width="501"><select name="actuacion" id="actuacion" style="width:258px">
				
					<option value="" selected="selected">Seleccionar Actuación</option>
					 <?php
						while($row = $datos_actuacion->fetch()){
				
							echo "<option value=\"". $row[id] ."\">" . $row[acc_descripcion] . "</option>";
						}
					 ?>
					</select>
					
				</td>
            </tr>
			
			<tr>
				<!-- ES LA FECHA DE ESTADO DE LA ÚLTIMA ACTUACIÓN SECRETARIA
				SE UTILIZA EL FORMATO Y-n-j EN VEZ DE Y-m-d YA QUE AL REALIZAR LA OPERACION
				DE CALCULAR LA FECHA FINAL SEGUN LOS DIAS LA FECHA INICIAL DEBE ESTAR DE LA SIGUIENTE 
				MANERA 2014-11-5 (Y-n-j) Y NO DE ESTA 2014-11-05 (Y-m-d) YA QUE EL CERO DEL DIA
				OCASINA UNA INCOSISTENCIA-->
				<td>Fecha Inicial:</td>  
				<td><input type="text" name="fecha_actusti" id="fecha_actusti" readonly="readonly" value="<?php if (empty($fechactud)) {echo date_format($fechactus,'Y-n-j'); }else{echo date_format($fechactud,'Y-n-j'); }?>"/></td>
							
			</tr>
			
			<tr>
                <td>Días</td>
                <td><input type="text" name="diasti" id="diasti" onkeyup="DiasHabiles()" value="<?php echo $dias; ?>"/></td>
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
           <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 43)) { ?>
           <td>Repartir:
           </td>
           <td>
             <input type="checkbox" name="ckreparto" id="ckreparto" value="1" /> </td> <?php }?> 
           </tr>
           <tr>
           <td>Fecha:</td>
		  
           <td>
		   <!-- SE CREA ESTE CAMPO OCULTO PARA SER USADO EN LA FUNCION requerirFecha Y PODER
		   INDICAR A QUE USUARIOS SE LE DEBE ACTIVA LA LISTA DE Juzgado Reparto--> 
		   <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['idUsuario'];?>" />
		   
		   <?php if( ($_SESSION['idUsuario']== 8 || $_SESSION['idUsuario']== 38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 43) ) { ?>
		   
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
			   	   
				   <?php if( ($_SESSION['idUsuario']== 8 || $_SESSION['idUsuario']== 38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 43) ) { ?>
					
				   <!-- SE CIERRA ESTA LINEA PARA QUE NO SOLICITE ESTE DATO AL DAR CLIC EN ACTUALIZAR, ESTA VALIDACION SE REALIZA EN
				   archivoModel.php en la funcion modificarArchivo_Otro() en la parte if($ckreparto == true) -->	
				   <!-- <select name="idjuzdes" class="required" id="sl_input"> -->
				   <select name="idjuzdes" id="sl_input">
				   
				   <?php } ?>
					   
				   <?php if( ($_SESSION['idUsuario']!= 8 && $_SESSION['idUsuario']!= 38 && $_SESSION['idUsuario']!= 48 && $_SESSION['idUsuario']!=51 && $_SESSION['idUsuario']!=42 && $_SESSION['idUsuario'] != 58 && $_SESSION['idUsuario'] != 43) ) { ?>
					
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
		   
		   <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==48 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 43)) { ?>
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
		   	 
						<?php if( in_array($fieldd[idusuario],$usuariosa_OBS_2,true) ){ 
						
								if( in_array($_SESSION['idUsuario'],$usuariosa_OBS_2,true) ){ 
						?>
						 
						 
									 <tr>
									   <td colspan="2" bgcolor="#CDE3F6">Funcionario que Aplica la Observaci&oacute;n:<span class="Estilo1"><?php echo $fieldd[funcionario]; ?></span></td>
									 </tr>
									 <tr>
									   <td>Fecha: &nbsp;&nbsp; <span class="Estilo1"><?php echo $fieldd[fechad]; ?></span></td>
									   
									   <td>
									   
									   		Observaci&oacute;n Adicional:&nbsp;&nbsp;
											
											<span class="Estilo1">
											
												<?php 
												
													echo $fieldd[descr]." ".$fieldd[memorial]." ".$fieldd[fecha_incorpora]." ".$fieldd[ruta_local]; 
													
												?>
												
												<?php 
												
													if(!is_null($fieldd[ruta_local])){?>
													
														<a href="<?php echo $fieldd[ruta_local];?>" title="<?php echo $fieldd[ruta_local];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
													
											 	<?php 
													}
												?>
												
												<br>
												<br>
																
												<?php if( $fieldd[id_memo_externo] >= 1 ){?>
																
														<a class="descarga_recibido" href="javascript:void(0);" title="Recibido" data-idrecibido="<?php echo $fieldd[id_memo_externo]; ?>">
														<button type="button" class="btn btn-success btn-xs">RECIBIDO</button>
														</a> 	
																
												<?php } ?>
											
											</span>
											
										</td>
										
									 </tr>
						 
						 <?php }}else{?>
						 
						 			 <tr>
									   <td colspan="2" bgcolor="#CDE3F6">Funcionario que Aplica la Observaci&oacute;n:<span class="Estilo1"><?php echo $fieldd[funcionario]; ?></span></td>
									 </tr>
									 <tr>
									   <td>Fecha: &nbsp;&nbsp; <span class="Estilo1"><?php echo $fieldd[fechad]; ?></span></td>
									   
									   <td>
									   
									   		Observaci&oacute;n Adicional:&nbsp;&nbsp;
											
											<span class="Estilo1">
											
												<?php 
													echo $fieldd[descr]." ".$fieldd[memorial]." ".$fieldd[fecha_incorpora]; 
												?>
												
												<?php 
												
													if(!is_null($fieldd[ruta_local])){?>
													
														<a href="<?php echo $fieldd[ruta_local];?>" title="<?php echo $fieldd[ruta_local];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
													
											 	<?php 
													}
												?>
												
												<br>
												<br>
																
												<?php if( $fieldd[id_memo_externo] >= 1 ){?>
																
														<a class="descarga_recibido" href="javascript:void(0);" title="Recibido" data-idrecibido="<?php echo $fieldd[id_memo_externo]; ?>">
														<button type="button" class="btn btn-success btn-xs">RECIBIDO</button>
														</a> 	
																
												<?php } ?>
												
												
											</span>
											
										</td>
										
									 </tr>
						 
						 <?php }?>
			  
               <?php }?>
             <tr>
               <td>&nbsp;</td>
               <td>
<input type="button" name="btn_input_accionado" id="btn_input_grande" value="Adicionar Descripción"  onclick="crearFormAccionado(this,frm)" />					
					
			
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51){ ?>
							<!-- <span style="cursor:pointer"><img src="views/images/salir.png"  width="30" alt="" title="Registrar Salida" onclick="vinculoSalida(<?php echo $field[id];?>)" style="float:right " /></span> -->
					<?php } ?>
					
					<?php if( $_SESSION['idUsuario']==2 || $_SESSION['idUsuario']==3 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==59 || $_SESSION['idUsuario']==76){ ?>
							<span style="cursor:pointer"><img src="views/images/add_memo.png" alt="" width="30" height="30" title="Adicionar Memorial"  onclick="vinculoMemorial(<?php echo $field[id];?>)" style="float:right "  /></span>
					<?php } ?>
					
					
					
					<?php if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==2 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==43 || $_SESSION['idUsuario']==49 || $_SESSION['idUsuario']==51|| $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==59 || $_SESSION['idUsuario']==58 || $_SESSION['idUsuario']==63){ ?>
							<a class="adicionarfotocopia" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/fotocopias2.png" width="40" height="40" title="ADICIONAR FOTOCOPIA" style="float:right "/></a>
					<?php } ?>
					
					
					
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==59){ ?>
							<a class="fijardespacho" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/idespacho.jpg" width="40" height="40" title="A DESPACHO" style="float:right "/></a>
					<?php } ?>
					
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==28 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==59){ ?>
							<a class="encustodia" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/money.png" width="40" height="40" title="TITULOS MATERIALIZADOS" style="float:right "/></a>
					<?php } ?>
					
					
					<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==28 || $_SESSION['idUsuario']==51){ ?>
							<a class="reg_titulos" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>"><img src="views/images/caja.png" width="40" height="40" title="Registrar T&iacute;tulo" style="float:right "/></a>
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
		
		
		
		
		<!-- ALERTA EXISTE MEMORIALES SIN INCORPORAR AL PROCESO -->
		
		<?php
		
		$cantidad_sin_memorial   = $modelo->get_cantidad_sin_memorial($id_radicado_sm);
		$cantidad_sin_memorial_2 = $cantidad_sin_memorial->fetch();
		$cantidad_sin_memorial_3 = $cantidad_sin_memorial_2[registros_sm];
		
		
		
		if($cantidad_sin_memorial_3 >= 1){
		
		?>
		
		<tr>
		  	
			<td colspan="2">
				
				
				<table border="0" align="center"  rules="rows" id="tabla_sin_memorial">
			
				
					<tr>
						
						<td>
						
							<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_sin_memorial">
											
								<thead> 
											<tr>
												<th bgcolor="#CDE3F9" colspan="13">
													<marquee behavior="alternate" bgcolor="#CDE3F6" scrollamount="2" scrolldelay="10" width="780" height="20" style="color:#FF0000">ALERTA EXISTEN MEMORIALES SIN INCORPORAR AL PROCESO</marquee> 
												</th>
											</tr>
											<tr> 
												<th>ID</th>
												<th>FECHA REGITRO</th>
												<th>RADICADO</th>
												<th>PETICIONARIO</th>
												<th>CEDULA</th>
												<th>TELEFONO</th>
												<th>TIPO DOC</th>
												<th>FOLIOS</th>
												<th>SOLICITUD</th>
												
												<?php if ( in_array($_SESSION['idUsuario'],$usuariosa_SM,true)) { ?>
												<th>
												
													<a class="marcar_sm" href="javascript:void(0);" title="Marcar Todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar Todos"/></a>
												</th>
											
												<th>
												
													<a class="desmarcar_sm" href="javascript:void(0);" title="Desmarcar Todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar Todos"/></a>
												</th>
												
												<th>
												
													<!-- SE CIERRA PARA QUE SE USE SOLO LA OPCION MASIVA DE INCORPORACION Incorporar Memorial al Proceso -->
													-
													
													<!-- <a class="revisar_sm" href="javascript:void(0);" title="Incorporar Todo"><img src="views/images/apply_f2.png" width="20" height="20" title="Incorporar Todo"/></a> -->
												</th>
												<?php } else{ ?>
												
												<th>
												
													-
												</th>
											
												<th>
												
													-
												</th>
												
												<th>
												
													-
												</th>
												
												<?php } ?>
												
												<th>MEMORIAL</th>
												
												
											</tr> 
										</thead> 
														
										<tbody> 
														
												<?php 
											
												$Crsm = 1; 
												
												$datos_sin_memorial   = $modelo->get_sin_memorial($id_radicado_sm);
												
												
												while($rowsm = $datos_sin_memorial->fetch()){ 
												
												?>
									
									
												<tr>
													<td><?php echo $rowsm[id];?></td>
													
													<td><?php echo $rowsm[fecha_registro];?></td>
													
													<td>
														<?php 
														
															echo $rowsm[radicado];
															
														?>
													</td>
											
													
													<td><?php echo $rowsm[peticionario];?></td>
													
													<td><?php echo $rowsm[cedula];?></td>
													
													<td><?php echo $rowsm[telefono];?></td>
													
													<td><?php echo $rowsm[tipo_documento];?></td>
													
													<td><?php echo $rowsm[folios];?></td>
													
													<td><?php echo $rowsm[nombre];?></td>
													
													<td>
														<input type="checkbox" name="<?php echo "chksm".$Crsm;?>" id="<?php echo "chksm".$Crsm;?>" value="<?php echo "chksm".$Crsm;?>" title="<?php echo "chksm".$Crsm;?>"/>
													</td>	
																
													<td>-</td>
													<td>-</td>
													
													<td>
													
														<?php 
													
															if(!is_null($rowsm[ruta_local])){?>
														
																<a href="<?php echo $rowsm[ruta_local];?>" title="<?php echo $rowsm[ruta_local];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
																
																<br>
																<br>
																
																<?php if( $rowsm[id_memo_externo] >= 1 ){?>
																
																<a class="descarga_recibido" href="javascript:void(0);" title="Recibido" data-idrecibido="<?php echo $rowsm[id_memo_externo]; ?>">
																Recibido
																</a> 	
																
																<?php } ?>
														<?php
															}
															else{ 
														?>
															
																-
														<?php
															}		
														?>
														
													</td>
													
													
												</tr>
										
											<?php $Crsm=$Crsm+1; } ?>
														
										</tbody>
								</table>
							
							</td>
						</tr>
				
				
				</table>
				
				
				
			</td>
			
           	
		  </tr>
		
		<?php } ?>	
		
		
		
		
		
		
		
		
		<!-- FIN ALERTA EXISTE MEMORIALES SIN INCORPORAR AL PORCESO -->
		
		
		
		
		
		
			<!-- APLICAR TRASLADO ART. 108 -->	
			<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==44 || $_SESSION['idUsuario']==29 || $_SESSION['idUsuario']==39 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==5 || $_SESSION['idUsuario']==59 || $_SESSION['idUsuario']==73 || $_SESSION['idUsuario']==74 || $_SESSION['idUsuario']==77){ ?>
			<tr>
	
				<td colspan="2">
					<a id="bt108" href="javascript:void(0);"><img src="views/images/t108.png" width="30" height="30" title="TRASLADO ART. 108"/><button type="button" class="btn btn-primary btn-xs">TRASLADO ART. 110</button></a>
				</td>
				<!-- <td>
					<a class="fila" href="javascript:void(0);" title="DESACTIVAR LISTA TRÁMITE"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR LISTA TRÁMITE"/>Desactivar</a>
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
		  
		  
		  
		  
		 <!-- APLICAR TRASLADO REPOSICION -->	
			<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==59 || $_SESSION['idUsuario']==5 || $_SESSION['idUsuario']==63 || $_SESSION['idUsuario']==74 || $_SESSION['idUsuario']==77){ ?>
			<tr>
	
				<td colspan="2">
					<a id="bt_reposi" href="javascript:void(0);"><img src="views/images/reposi.png" width="30" height="30" title="TRASLADO REPOSICION"/><button type="button" class="btn btn-primary btn-xs">TRASLADO REPOSICION</button></a>
				</td>
				
				
			</tr>
			
		  
		  <tr id="fila_traslado_reposicion">
		  	
			<td>
				<br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Fijacion</label><br>
				<input name="fecha_reposi" id="fecha_reposi" type="text" readonly="true" size="15">
				<a class="fijar_reposi" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>" data-juzgadodestino="<?php echo $field['idjuzrep'];?>"><img src="views/images/OK1.jpg" width="30" height="30" title="CONFIRMAR TRASLADO REPOSICION"/></a>
				<!-- <a class="generarword" href="javascript:void(0);" data-id="<?php echo $field['id'];?>"><img src="views/images/pdf-icono.png" width="30" height="30" title="GENERAR TRASLADO"/></a> -->
			</td>
			
          
		  </tr>
		  <?php } ?>
		  
		  
		  
		  
		  <!-- TERMINOS -->	
			<?php if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==59){ ?>
			<tr>
	
				<td colspan="2">
					<a id="btterminos" href="javascript:void(0);"><img src="views/images/terminos.jpg" width="30" height="30" title="TERMINOS"/><button type="button" class="btn btn-primary btn-xs">TERMINOS</button></a>
				</td>
				<!-- <td>
					<a class="fila" href="javascript:void(0);" title="DESACTIVAR LISTA TRÁMITE"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR LISTA TRÁMITE"/>Desactivar</a>
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
			<?php if($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 39 || $_SESSION['idUsuario'] == 51 || $_SESSION['idUsuario']==59){ ?>
			<tr>
	
				<td colspan="2">
					<a id="btautoaprueba" href="javascript:void(0);"><img src="views/images/aliqui2.png" width="30" height="30" title="AUTO APRUEBA LIQUIDACION"/><button type="button" class="btn btn-primary btn-xs">AUTO APRUEBA LIQUIDACION</button></a>
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
		  
		  
		  
		  
		  <!-- ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS -->
		  <?php if( $bandera_entitulos == 1){ ?>
		  
		  			<tr>
					
						<td>
							<a class="sacar_de_anaquelT" href="javascript:void(0);" data-id="<?php echo $field['id'];?>" data-radicado="<?php echo $field['radicado'];?>"><img src="views/images/ubipro1.jpg" width="30" height="30" title="SACAR / UBICAR EN ANAQUEL DE TITULOS"/><button type="button" class="btn btn-primary btn-xs">SACAR / UBICAR EN ANAQUEL DE TITULOS</button></a>
						</td>
						
						<td>
            				
							
							<input type="checkbox" name="ckenanaquelt" id="ckenanaquelt" value="1"/>Ubicar en Anaquel de Titulos
							
							<br><br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Observacion Adicional</label><br>
            				<input name="obseradit" id="obseradit" type="text" size="50">
				
							
						</td>
						
					</tr>		
		<?php } ?>
		
		
		
		
					
					
		  
		  
          <tr>
            
            <td colspan="2">
				<center>
					<!-- <input type="submit" name="Submit" value="Actualizar" id="btn_input"> -->
					<input type="submit" name="Submit" value="Actualizar" id="actumo" style="border: 1px solid #B3B3B3; color: #FFF; width: 130px; padding: 4px; background-color: #6592C9">
                	<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
				</center>
				
		    </td>
          </tr>
         
        </table>
        
        <?php }?>
      </form>
    <!-- </div> --></td>
  </tr>
 <!-- <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>  -->
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
