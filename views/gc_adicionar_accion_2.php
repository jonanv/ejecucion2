<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "REGISTRAR ACCION";
	$subtitulo  = "REGISTRAR ACCION";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	
	//LISTAS
	/*$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosjd = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	//LISTA CLASE
	$campo_a_mostrar  = 'des';
	$campo_a_insertar = 'id';
	$nombre_tabla     = 'gc_lista';
	$campo_filtro     = 'idtipo';
	$valor_filtro     = 1;
	$campo_a_ordenar = 'des';
	$datosclase       = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//PARA FILTRO
	$datosclase_2      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//SOLO ESTOS DOS PARAMETROS YA QUE 
	//EL RESTO DE PARAMETROS EN LA PRIMERA FUNCIO YA 
	//ESTAN DEFINIDOR EN LA LISTA CLASE
	
	//LISTA NUMERAL NORMA
	$valor_filtro = 2;
	$datosnumeral = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	$datosnumeral_2 = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//LISTA PROCESO RESPONSABLE
	$valor_filtro = 3;
	$datospr      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	$datospr_2      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//LISTA PROCESO AFECTADO O IMPACTADOS
	$valor_filtro = 4;
	$datospai     = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	$datospai_2     = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	
	//LISTA METODOLOGIA
	$valor_filtro = 5;
	$datosme      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	$datosme_2      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//LISTA GENERADA
	$valor_filtro = 6;
	$datosge      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	$datosge_2      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//DATOS ACCION	
	
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosACCION_1 = $modelo->busquedad_filtro_ACCION();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->busquedad_filtro_ACCION();
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACCION_1 = $modelo->busquedad_actual_ACCION($fechaactual);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->busquedad_actual_ACCION($fechaactual);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
	
	}

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
<title><?php echo $titulo?></title>

<!-- SE DEFINEN LAS LIBRERIAS DE ESTA FORMA PARA EVITAR CONFLICTOS COMO EL DESPLIEGUE DE MENUS,
QUE AL REALIZAR UN REGISTRO SALGA EL MENSAJE DE CONFIRMACION, SEGUIDO DE LAS LIBRERIAS
FUNCIONES JAVASCRIPT COMO mainmenu() Y $(document).ready(function() , YA QUE SI SE DEFINEN
MAS ARRIBA AL NO ENCONTRAR LAS LIBRERIAS TAMBIEN PUEDE PRESENTAR INCONSISTENCIAS.
PARA EL MANEJO DE LAS FECHAS, SI SE USA DIRECTAMENTE POR EJEMPLO EN ESTE FORMULARIO SE DEFINE 
ALGO COMO

<input name="fechair" id="fechair" type="text" readonly="true" size="10">

Y SE DEFINE EN $(document).ready(function() 

$("#fechair").datepicker({ changeFirstDay: false	}); 

SI SE DESEA MANEJAR FECHAS EN UN POPUPBOX, SE PUEDE USAR LAS LIBRERIAS DE views\fechajquery
EJENPLODE ESTO LO VEMOS EN EL FORMULARIO permisos.php UBICADO EN views\popupbox
-->

<!-- -------------------------------------------------------------------- -->
<!-- <script src="views/js/jquery.js" type="text/javascript"></script> -->
<script src="views/js/jquery_NV.js" type="text/javascript"></script> 

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

<!-- <script src="views/js/jquery.validate.js" type="text/javascript"></script> -->
<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>


<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<!-- <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8"> -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_gc.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ >

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->


<!-- PARA EL DESPLIEGUE DE MENUS -->
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


<script type="text/javascript">

$(document).ready(function() {
	
	
	
	
	//PARA LAS FECHAS
	//$("#fechae").datepicker({ changeFirstDay: false	});

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
	
	$("#fechasri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrei_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasref_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdi_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdf_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	//$("#fechasre").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	$("#checkTodos").change(function () {
		  
		$("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
	
	});
	
	
	//GENERAR ACTIVIDAD
	$('.generar_actividad').click( function(){
										  
										  
		var id    = $(this).attr('data-id');
		
		//alert(id);
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.id        = id;
		params.id_filtro = 0;
		
		
			
	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/gc_actividad.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	
	//EDITAR ACCION
	$('.editar_accion').click( function(){
								  
		
		var id = $(this).attr('data-id');
		
			
		params={};
		params.idaccion = id;
		
		   
				
		$('#popupbox').load('views/popupbox/gc_editar_accion.php',params,function(){
				
			$('#block').show();
			$('#popupbox').show();
					
		})
		
		
		
    });
	
	//REVISAR ACTIVIDAD
	$('.revisar_actividad').click( function(){
										  
										  
		var id    = $(this).attr('data-id');
		
		//alert(id);
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.id        = id;
		params.id_filtro = 0;
		
		
			
	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/gc_revision.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	$(".buscarxfiltro_ACCION").click(function(){
								
		
		
		if( 
			
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#idfiltro').val().length    == 0 && 
		   $('#listasr1F').val().length   == 0 &&
		   $('#listasr2F').val().length   == 0 &&
		   $('#listasr3F').val().length   == 0 &&
		   $('#listasr4F').val().length   == 0 &&
		   $('#listasr5F').val().length   == 0 &&
		   $('#listasr6F').val().length   == 0 
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('idfiltro').style.borderColor    =  '#FF0000';
			document.getElementById('listasr1F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr2F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr3F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr4F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr5F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr6F').style.borderColor   =  '#FF0000';
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltro').val();
			datox2 = $('#listasr1F').val();
			datox3 = $('#listasr2F').val();
			datox4 = $('#listasr3F').val();
			datox5 = $('#listasr4F').val();
			datox6 = $('#listasr5F').val();
			datox7 = $('#listasr6F').val();
		    
			
		
			location.href="index.php?controller=archivo&action=Busquedad_Filtro_ACCION&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7;
			

			
		}
		
	});
	
	
	$(".finalizar_accion").click(function(evento){
		
			
			var dataString        = "";
			
			var idspermisoRCA2     = "";
			var idspermiso_realCA2 = 0;
			
			
			var fRCA2 = 1;
			
			var d0RCA2;
			

			var cantidad_filas_FRCA2;
			var TABLA_FRCA2 = document.getElementById('tacciones');
			
			cantidad_filas_FRCA2 = TABLA_FRCA2.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FRCA2; r++){
				
				d0RCA2  = document.getElementById("tacciones").rows[r].cells[0].innerText;
				
				
				if($("#chk"+fRCA2).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoRCA2 = d0RCA2+"******"+idspermisoRCA2;
						
						idspermiso_realCA2 = 1;
						
						
						
				}
				
				
				
					
				fRCA2 = fRCA2 + 1;
				
				
			}
			
			
			
			if(idspermiso_realCA2 == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se a Seleccionado Ningun Registro en la TABLA ACCIONES";
				$('.mensage_accion').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_accion').show('slow');
				
				setTimeout(function() {
					$(".mensage_accion").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datospartes_RA').val('');
					$('#datospartes_RA').val(idspermisoRCA2);
					
					dataString += '&datospartes='+$('#datospartes_RA').val();
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Finalizar_Accion',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_accion').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_accion').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_acti").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=Adicionar_Accion_2";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
});


</script>	




<style type="text/css">


.mensage_accion{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
}

.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}


.contenedor_editar{margin:60px auto;width:960px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	th {padding:5px; background-color:#CDE3F6;}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable span{display:block;}
		.editable span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
	.checkbox110{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}

</style> 

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		//require 'secc_archivo.php';
		require 'secc_solicitudes.php';
		
	?>			
	
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id ="popupbox"></div>

	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		<tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<div id="contenido">
				
					<form id="frm_RA" name="frm_RA" method="post" enctype="multipart/form-data" action="">
					
						
						<input name="datospartes_RA" id="datospartes_RA" type="hidden" readonly="true"/>
						<!-- <input name="fechas_m" id="fechas_m" type="hidden" readonly="true"/>
						<input name="datospartes_m110" id="datospartes_m110" type="hidden" readonly="true"/> -->
						
												
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Registro:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechasr110" id="fechasr110" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							

							<tr>
							
								<td colspan="2">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_memo">
		  	
										<tr>
											<td colspan="2">
												
												<button type="button" name="boton_adicionar_110m" id="boton_adicionar_110m" title="Adicionar Accion" onClick="Adicionar_Accion()" style=" border-width:thin"><img src="views/images/new3.jpg" width="30" height="30"/></button>
											
											</td>
										</tr>
										
										<!-- <tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px ">ID:</label><br>
											</td>
										
											<td>
												<input type="text" name="idradi110" id="idradi110" style="color:#FF0000; font-size:16px"/>
											</td>
										
										</tr> -->
										
										
										
										<!-- <tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Radicado:</label><br>
											</td>
										
											<td>
												<input type="text" name="radicado110m" id="radicado110m" class="required number" value="<?php //echo trim($_GET['datox1']); ?>"/>
											</td>
										
										</tr> -->
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Clase:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr1" id="listasr1">
												
													<option value="" selected="selected">Seleccionar Clase</option> 
															
													<?php
															while($row = $datosclase->fetch()){
																		
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox1'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										<!-- <tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha:</label><br>
											</td>
										
											
											<td>
												<input type="text" name="fecha110m" id="fecha110m" class="required" readonly="true">
											</td>
										
										</tr> -->
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Numeral Norma:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr2" id="listasr2">
												
													<option value="" selected="selected">Seleccionar Numeral Norma</option> 
															
													<?php
															while($row = $datosnumeral->fetch()){
																		
																
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox2'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Descripcion Hallazgo:</label><br>
											</td>
										
											
											<td>
												
												<textarea id="gc_dh" name="gc_dh" cols="40" rows="5"></textarea>
											</td>
										
										</tr>
										
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Proceso Responsable:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr3" id="listasr3">
												
													<option value="" selected="selected">Seleccionar Proceso Responsable</option> 
															
													<?php
															while($row = $datospr->fetch()){
																		
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox4'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Proceso Afectado o Impactado:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr4[]" id="listasr4" size="8" multiple= "multiple" style="width:200px">
												
													<!-- <option value="" selected="selected">Seleccionar Proceso Afectado o Impactado</option>  -->
													<option selected></option> 
															
													<?php
															while($row = $datospai->fetch()){
																		
																
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox5'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Analisis de Causas:</label><br>
											</td>
										
											
											<td>
												
												<textarea id="gc_ac" name="gc_ac" cols="40" rows="5"></textarea>
											</td>
										
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Metodologia:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr5" id="listasr5">
												
													<option value="" selected="selected">Seleccionar Metodologia</option> 
															
													<?php
															while($row = $datosme->fetch()){
																		
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox7'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Generada Por:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr6" id="listasr6">
												
													<option value="" selected="selected">Seleccionar Generada</option> 
															
													<?php
															while($row = $datosge->fetch()){
																		
																
																echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																
																/*if($row[des] == trim($_GET['datox8'])){					
																				
																	echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																}*/
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
		
									</table>
								
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2">
									<center><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">TABLA ACCIONES</label><br></center>
								</td>
										
							</tr>
										
							
							<tr>
							
								<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_ra"> 
													<table id="t_ra" border="1"> 
														<tr>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">CLASE</strong>
															</td> 
															<td>
																<strong style="font-size:10px; color:#0066CC">NUMERAL NORMA</strong>
															</td>
															<td>
																<strong style="font-size:10px; color:#0066CC">DES HALLAZGO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">PROCESO RESPONSABLE</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">PROCESO AFECTADO O IMPACTADO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">ANALISIS DE CAUSAS</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">METODOLOGIA</strong>
															</td>
															
															
															<td>
																<strong style="font-size:10px; color:#0066CC">GENERADA POR</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#FF0000">ELIMINAR</strong>
															</td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr>
							
	
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="2">
									
									<center>
										<input type="submit" name="Submit" class="btn_validar_RA" value="Registrar" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_ra"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
					
					 </form> 
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	
	
	<!-- MENSAJES -->
	<div class="mensage_accion"></div>  
				
	
	<!-- FILTROS -->
	<table border="0" align="center"  rules="rows" id="tbuscarxfiltroconsulta">
		
			
		<tr>
					
			<td>
					
					
				<table cellpadding="0" cellspacing="0" rules="rows" border="1">
																						
										
					<tr> 
											
						<td colspan="4">
							<center>
								<strong style="width:151px; color:#FF0000; font-size:16px">ACCIONES<?php echo " / REGISTROS: ".$cantregis; ?></strong>
							</center>
						</td>
											
					</tr>
					
					<tr>
						<td>
							<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px ">ID:</label><br>
						</td>
										
						<td>
							<input type="text" name="idfiltro" id="idfiltro" style="color:#FF0000; font-size:16px" value="<?php echo trim($_GET['datox1']); ?>"/>
						</td>
						
						<td colspan="2">
							
							<a class="buscarxfiltro_ACCION" href="javascript:void(0);" title="BUSCAR ACCION" style="color:#0066CC">
								<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR ACCION"/>BUSCAR ACCION 
							</a>
													
							<a class="finalizar_accion" href="javascript:void(0);" title="FINALIZAR ACCION" style="color:#0066CC">
								<img src="views/images/save.png" width="25" height="25" title="FINALIZAR ACCION"/>FINALIZAR ACCION
							</a>
							
							<!-- <a class="generar_obs" href="javascript:void(0);" title="GENERAR OBSERVACIONES" style="color:#0066CC">
								<img src="views/images/excel_1.jpg" width="25" height="25" title="GENERAR OBSERVACIONES"/>GENERAR OBSERVACIONES
							</a> -->
							 
						</td>
										
					</tr>
											
					<tr>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasri_m" id="fechasri_m" value="<?php echo trim($_GET['dato_1']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
						</td>
						<td>
							<input type="text" name="fechasrf_m" id="fechasrf_m" value="<?php echo trim($_GET['dato_2']); ?>">
						</td>
												
																
					</tr>
					
					<tr>
										
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Clase:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr1F" id="listasr1F">
												
								<option value="" selected="selected">Seleccionar Clase</option> 
															
								<?php
									while($row = $datosclase_2->fetch()){
																		
																
										if($row[id] == trim($_GET['datox2'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
						
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Numeral Norma:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr2F" id="listasr2F">
												
								<option value="" selected="selected">Seleccionar Numeral Norma</option> 
															
								<?php
									while($row = $datosnumeral_2->fetch()){
																		
																
										
										if($row[id] == trim($_GET['datox3'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
											
					</tr>
					
					
					
					
					<tr>
										
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Proceso Responsable:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr3F" id="listasr3F">
												
								<option value="" selected="selected">Seleccionar Proceso Responsable</option> 
															
								<?php
									while($row = $datospr_2->fetch()){
																		
										
																
										if($row[id] == trim($_GET['datox4'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
						
						
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Proceso Afectado o Impactado:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr4F" id="listasr4F">
												
								<option value="" selected="selected">Seleccionar Proceso Afectado o Impactado</option> 
													
															
								<?php
									while($row = $datospai_2->fetch()){
																		
																
										if($row[id] == trim($_GET['datox5'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
											
					</tr>
					
					
					
					
					<tr>
										
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Metodologia:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr5F" id="listasr5F">
												
								<option value="" selected="selected">Seleccionar Metodologia</option> 
															
								<?php
									while($row = $datosme_2->fetch()){
																		
																
																
										if($row[id] == trim($_GET['datox6'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
						
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Generada Por:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="listasr6F" id="listasr6F">
												
								<option value="" selected="selected">Seleccionar Generada</option> 
															
								<?php
									while($row = $datosge_2->fetch()){
																		
																
										if($row[id] == trim($_GET['datox7'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
											
					</tr>
										
										
																		
				</table>
										
						
			</td>
						
		</tr>
			
			
	</table>		
			
	<!-- SE LISTA LA CORRESPONDENCIA-->		
			
	<!-- <div class="mensaje"></div> -->
	
	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){ 
	?>
						
	<table cellpadding="0" cellspacing="0" rules="rows" border="1" id="tacciones">
																						
										
		<tr> 
											
			<!-- <th style="color:#FF0000; font-size:10px">ID</th> -->
			<th style="color:#FF0000; font-size:10px">NUM ACCION</th
			><th style="font-size:10px">CLASE</th>
			<th style="font-size:10px">NUMERAL NORMA</th>
			<th style="font-size:10px">DES HALLAZGO</th>
			<th style="font-size:10px">PROCESO RESPONSABLE</th>
			<th style="font-size:10px">PROCESO AFECTADO O IMPACTADO</th>
			<th style="font-size:10px">ANALISIS DE CAUSAS</th>
			<th style="font-size:10px">METODOLOGIA</th>
			<th style="font-size:10px">GENERADA POR</th>
			<th style="font-size:10px">FECHA REGISTRO</th>
			<th style="font-size:10px">HORA REGISTRO</th>
			<th style="color:#FF0000; font-size:10px">PORCENTAJE</th>
			<th style="font-size:10px">ESTADO</th>
			
			<!-- <th>									
				<a class="marcar_110" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a>
			</th>
											
			<th>										
				<a class="desmarcar_110" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos"/></a>
			</th> -->
			
			<th style="font-size:10px">+ ACTIVIDAD</th>
			
			<th style="font-size:10px">EDITAR</th>
			
			<th style="font-size:10px">REVISAR</th>
			
			<th style="font-size:10px">CHECK</th>
			
			<th style="font-size:10px">
												
				<input type="checkbox" id="checkTodos" class="checkbox110"/>MARCAR/DESMARCAR 
				
			</th>
					
		</tr> 
		
		
		<?php
											
			$Ct110=1;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$d1M = $fila[id];
				$d2M = $fila[clase];
				$d3M = $fila[numeral];
				$d4M = $fila[descripcion];
				$d5M = $fila[procesoresponsable];
				$d6M = $fila[id_ai];
				$d7M = $fila[analisis_causas];
				$d8M = $fila[metodologia];
				$d9M = $fila[generada];
				$d10M = $fila[fecha_registro];
				$d11M = $fila[hora_registro];
				$d12M = $fila[estado];
				$d13M = $fila[numero_accion];
															
												
		?>
											
								
				<tr>
				
					<!-- SE OCULTA A PEDIDO DE LA DIRECCION OECM 25 DE AGOSTO 2021 -->
																
					<!-- <td style="color:#FF0000; font-size:10px ">
						<?php 
																													  
							//echo $d1M;  
						?>
					</td> -->
					
					<td style="color:#FF0000; font-size:10px ">
						<?php 
																													  
							echo $d13M;  
						?>
					</td>
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d2M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d3M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d4M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d5M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d6M;  
							
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d7M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d8M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d9M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d10M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d11M;  
						?>
					</td>
					
					<td style="color:#FF0000; font-size:10px ">
						<?php 
							
							//ITEMS FUNDAMENTALES PARA PODER FINALIZAR UNA ACCION
							
							//CALCULAR PORCENTAJE
							$porcentaje = $modelo->get_procentaje_actividad($d1M);
																													  
							echo $porcentaje;  
							
							$porce = explode("%",$porcentaje); 
							
							$porce_1 = $porce[0];
							
							//CALCULAR QUE YA SE CALIFICARON LAS PREGUNTAS DE ACCIONES DE GESTION
							$cantpreguntas = $modelo->get_cant_preguntas($d1M);
							
							//echo $cantpreguntas;
							
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
							
							if($d12M == 0){$d12M = "EN PROCESO";}else{$d12M = "TERMINADA";}
																													  
							echo $d12M; 
							
							
						?>
					</td>
					
					
					<td>
						<a class="generar_actividad" href="javascript:void(0);" title="ADICIONAR ACTIVIDAD" data-id="<?php echo trim($d1M);?>"><img src="views/images/listar.png" width="45" height="30" title="ADICIONAR ACTIVIDAD"/></a>
					</td>
					
					<td>
						<a class="editar_accion" href="javascript:void(0);" title="EDITAR ACCION" data-id="<?php echo trim($d1M);?>"><img src="views/images/editar_1.png" width="25" height="25" title="<?php echo "EDITAR ACCION: ".$d1M;?>"/></a>
					</td>
					
					<td>
						<a class="revisar_actividad" href="javascript:void(0);" title="ACCIONES DE GESTION CALIFICACION" data-id="<?php echo trim($d1M);?>"><img src="views/images/OK1.jpg" width="25" height="25" title="ACCIONES DE GESTION CALIFICACION"/></a>
					</td>
					
					<?php if($porce_1 >= 100 && $cantpreguntas >= 3){?>
					<td>
						<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox110"/>
					</td>
					<?php }else{?>
					<td>-</td>
					<?php }?>
					
					<td></td>
					
					
					
			</tr>
			
			<?php  $Ct110=$Ct110+1; } ?>		
											
	</table>
	
	
	
	<?php
	//}
	?>
	
	
	<?php 

	//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
	//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
	/*echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';*/
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


