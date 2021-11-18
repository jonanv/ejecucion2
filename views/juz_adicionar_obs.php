<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$idusuario = $_SESSION['idUsuario'];
	
	//TITULO FORMULARIO
	$titulo     = "ADICIONAR OBSERVACION";
	$subtitulo  = "ADICIONAR OBSERVACION";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	
	
	//DATOS GENERALES PARA LAS ACCIONES
	$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	
	
	//------------------PARA VISUALIZAR SOLO UNAS PARTES DE LA VISTA, SI ES JUEZ JEFE TODO EL FORMULARIO--------------------------------
	
	$idaccion	    = '20';
	$campoordenar   = 'id';
	$datos_JEFE     = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$datos_JEFE_1   = $datos_JEFE->fetch();
	$datos_JEFE_2	= explode("******",$datos_JEFE_1[usuario]);
	
	
	$datos_JEFE_2	= explode("////",$datos_JEFE_2[0]);
	
	
	
	//------------------FIN PARA VISUALIZAR SOLO UNAS PARTES DE LA VISTA, SI ES JUEZ JEFE TODO EL FORMULARIO--------------------------------
	
	
	
	
	
	//LISTAS
	/*$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosjd = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	//LISTA ASIGNADO A
	$campo_a_mostrar  = 'empleado';
	$campo_a_insertar = 'id';
	$nombre_tabla     = 'pa_usuario';
	$campo_filtro     = 'id';
	$valor_filtro     = 'IN(62,64)';//$usuariosa_JUZ_2[1];
	$campo_a_ordenar  = 'empleado';
	$datos_user_JUZ   = $modelo->get_lista_con_filtro_IN($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//PARA SECCION FILTRO
	//CARGA TODOS LOS USUARIOS DE JUZGADO
	if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){
	
		$datos_user_JUZ_2 = $modelo->get_lista_con_filtro_IN($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	}
	//CARGA SOLO EL USUARIO DE SESION 
	else{
		
		$valor_filtro     = $_SESSION['idUsuario'];
		
		$datos_user_JUZ_2 = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
		//$datos_user_JUZ_2 = $modelo->get_lista_con_filtro_IN($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	}
	
	
	//DATO EXPEDIENTE
	/*$opcion_expe = trim($_GET['dato_expe']);
	
	if($opcion_expe == 1){
	
	
		$dato_filtro = trim($_GET['dato_filtro']);
		
		$datosEXPE_1 = $modelo->busquedad_actual_FILTRO_EXPEDIENTE($dato_filtro);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosEXPE = $modelo->busquedad_actual_FILTRO_EXPEDIENTE($dato_filtro);
		
		$fex = 0;
		while($fila_ex = $datosEXPE->fetch()){		
		
			$fex = $fex + 1; 
		
		}
		
 		$cantregisex = $fex;
		
		//*************************************************************************************
	
		
	
	}
	else{
	
	
		$datosEXPE_1 = $modelo->busquedad_actual_EXPEDIENTE();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosEXPE = $modelo->busquedad_actual_EXPEDIENTE();
		
		$fex = 0;
		while($fila_ex = $datosEXPE->fetch()){		
		
			$fex = $fex + 1; 
		
		}
		
 		$cantregisex = $fex;
		
		//*************************************************************************************
	
	}*/
	
	
	
	
	//DATOS OBSERVACIONES
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		$estado_x = trim($_GET['datox4']);
		
		//ES EDITABLE SI ES  SI ES JUEZ JEFE
		//CARGA TODAS LAS OBSERVACIONES ASIGNADAS
		if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){
		
			$datosACCION_1 = $modelo->busquedad_filtro_OBSERVACION(0);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->busquedad_filtro_OBSERVACION(0);
		}
		//CARGA SOLO LAS OBSERVACIONES DEL USUARIO EN SESION ASIGNADAS A EL
		else{
		
		
			$datosACCION_1 = $modelo->busquedad_filtro_OBSERVACION(1);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->busquedad_filtro_OBSERVACION(1);
		
		}		
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
		if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){
		
			$datosACCION_1 = $modelo->busquedad_actual_OBSERVACION(0);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->busquedad_actual_OBSERVACION(0);
		}
		else{
		
			$datosACCION_1 = $modelo->busquedad_actual_OBSERVACION(1);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->busquedad_actual_OBSERVACION(1);
		
		}	
		
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
<script src="views/js/ajax/ajax_juz.js" type="text/javascript" charset="utf-8"></script>

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
	
	
	$("#juz_fechasri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#juz_fechasrf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasri_m_2").datepicker({ changeFirstDay: false	});
	$("#fechasrf_m_2").datepicker({ changeFirstDay: false	});
	
	
	$('.radioboton').click( function(){
	
		var idfila = $(this).attr('data-idfila');
		//alert(idfila);
		
		var juz_idradicado = document.getElementById("texpe").rows[idfila].cells[0].innerText;
		var juz_radicado   = document.getElementById("texpe").rows[idfila].cells[1].innerText;
		
		$('#juz_idradicado').val('');
		$('#juz_radicado').val('');
		
		$('#juz_idradicado').val(juz_idradicado);
		$('#juz_radicado').val(juz_radicado);
		
		
	});
	
	
	
	$(".buscarxfiltro_EXPEDIENTE").click(function(){
								
		
		
		if( 
			
		   $('#juz_expediente').val().length  == 0 
		  
		   
		) {
			
			//alert("Definir Algun Filtro Para Realizar la Busquedad");
			
			alert("DEFINIR NUMERO DE EXPEDIENTE");
	
			document.getElementById('juz_expediente').style.borderColor  =  '#FF0000';
			
		}
		else{
		
			if( $('#juz_expediente').val().length < 23  ) {
		
				alert("La Longitud del Radicado debe ser de 23 Digitos");
				document.getElementById('juz_expediente').style.borderColor = '#FF0000';
				
			}
			else{
			
				//alert("BUSCANDO...");
		
		
				dato_expe = 1;
				
				dato_filtro = $('#juz_expediente').val().trim();
				
				//location.href="index.php?controller=archivo&action=Busquedad_Filtro_EXPEDIENTE&dato_expe="+dato_expe+"&dato_filtro="+dato_filtro;
				
				var registro;
				//var cradio = 1;
				var idrad;
				var radi;
				var longdatos = 0;
				
				//OBTENEMOS TABLA 
				$.ajax({
					type: "GET",
					url: "views/popupbox/juz_obtener_expe.php?tabla=1",
					data: { valor_id: dato_filtro }
				})
				.done(function(json) {
					
					
					json = $.parseJSON(json);
					
					longdatos = json.length;
					//alert(longdatos);
					
					if(longdatos == 0){
						alert("NO EXISTE INFORMACION DEL RADICADO");
					}
					
					Eliminar_Tabla('texpe');
					
					for(var i=0;i<json.length;i++)
					{
					
						
						registro+="<tr>"
							
							registro+="<td class='id' style='color:#FF0000; font-size:10px'>"+json[i].id+"</td>"
							registro+="<td class='radicado' style='font-size:10px'>"+json[i].radicado+"</td>"
							registro+="<td class='fecha' style='font-size:10px'>"+json[i].fecha+"</td>"
							registro+="<td class='cedula_demandante' style='font-size:10px'>"+json[i].cedula_demandante+"</td>"
							registro+="<td class='demandante' style='font-size:10px'>"+json[i].demandante+"</td>"
							registro+="<td class='cedula_demandado' style='font-size:10px'>"+json[i].cedula_demandado+"</td>"
							registro+="<td class='demandado' style='font-size:10px'>"+json[i].demandado+"</td>"
							registro+="<td class='fechasalida' style='font-size:10px'>"+json[i].fechasalida+"</td>"
							
							
							//registro+="<td align='center'>" 
							//registro+="<input type='radio' class='radioboton' id='chkobs'"+cradio+" name='radioobs' data-idfila="+cradio+" value='chkobs'"+cradio+" title='chkobs'"+cradio+"/>"
							
							//registro+="<a class='CARGAR_DATOS_EXPEDIENTE' href='javascript:void(0);' title='CARGAR DATOS EXPEDIENTE' style='color:#0066CC'><img src='views/images/revi1.jpg' width='20' height='20' title='CARGAR DATOS EXPEDIENTE'/></a>"
							
							//registro+="</td>"
							
							
						registro+="</tr>"
						
						
						idrad = json[i].id;
						radi  = json[i].radicado;
				
						$('.edit_texpe').append(registro);
						
						//cradio = cradio + 1;
					}
					
					$('#juz_idradicado').val('');
					$('#juz_radicado').val('');
					
					$('#juz_idradicado').val(idrad);
					$('#juz_radicado').val(radi);
					
					$('#juz_expediente').val('');
					$('#juz_expediente').val('170014003');
					
					
				});
				/*------------------- */
				
				
			}
			

			
		}
		
	});
	
	
	//PARA CARGAR DATOS EXPEDIENTE
	$(".CARGAR_DATOS_EXPEDIENTE").click(function() {
		
		alert("CARGANDO...");
	});
	
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".recargar_pagina").click(function() {
		location.href="index.php?controller=archivo&action=Adicionar_Obs";
	});
	
	
	$(".generar_obs").click(function(){
	
	
	
		if( 
			
		   $('#idfiltro').val().length       == 0 &&
		   $('#juz_radicado_2').val().length == 0 &&
		   $('#fechasri_m').val().length     == 0 && 
		   $('#fechasrf_m').val().length     == 0 &&
		   $('#fechasri_m_2').val().length   == 0 &&
		   $('#fechasrf_m_2').val().length   == 0 &&
		   $('#juz_lista_2').val().length    == 0 &&
		   $('#juz_lista_3').val().length    == 0 
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltro').style.borderColor       =  '#FF0000';
			document.getElementById('juz_radicado_2').style.borderColor =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor     =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor     =  '#FF0000';
			document.getElementById('fechasri_m_2').style.borderColor   =  '#FF0000';
			document.getElementById('fechasrf_m_2').style.borderColor   =  '#FF0000';
			document.getElementById('juz_lista_2').style.borderColor    =  '#FF0000';
			document.getElementById('juz_lista_3').style.borderColor    =  '#FF0000';
			
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 5000;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
			dato_3 = $('#fechasri_m_2').val(); 
		    dato_4 = $('#fechasrf_m_2').val();
			
		    datox1 = $('#idfiltro').val();
			datox2 = $('#juz_radicado_2').val();
			datox3 = $('#juz_lista_2').val();
			datox4 = $('#juz_lista_3').val();
			
		    
			
		
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
			
			//location.href="index.php?controller=archivo&action=Busquedad_Filtro_OBS&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
			
		}
								
		
		
		
	});

	










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
	
	$(".buscarxfiltro_ACCION").click(function(){
								
		
		
		if( 
			
		   $('#idfiltro').val().length       == 0 &&
		   $('#juz_radicado_2').val().length == 0 &&
		   $('#fechasri_m').val().length     == 0 && 
		   $('#fechasrf_m').val().length     == 0 &&
		   $('#fechasri_m_2').val().length   == 0 &&
		   $('#fechasrf_m_2').val().length   == 0 &&
		   $('#juz_lista_2').val().length    == 0 &&
		   $('#juz_lista_3').val().length    == 0 
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltro').style.borderColor       =  '#FF0000';
			document.getElementById('juz_radicado_2').style.borderColor =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor     =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor     =  '#FF0000';
			document.getElementById('fechasri_m_2').style.borderColor   =  '#FF0000';
			document.getElementById('fechasrf_m_2').style.borderColor   =  '#FF0000';
			document.getElementById('juz_lista_2').style.borderColor    =  '#FF0000';
			document.getElementById('juz_lista_3').style.borderColor    =  '#FF0000';
			
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
			dato_3 = $('#fechasri_m_2').val(); 
		    dato_4 = $('#fechasrf_m_2').val();
			
		    datox1 = $('#idfiltro').val();
			datox2 = $('#juz_radicado_2').val();
			datox3 = $('#juz_lista_2').val();
			datox4 = $('#juz_lista_3').val();
			
		    
			
		
			location.href="index.php?controller=archivo&action=Busquedad_Filtro_OBS&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
			

			
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
				msg = "No se a Seleccionado Ningun Registro en la TABLA OBSERVACIONES";
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
						url:'index.php?controller=archivo&action=Finalizar_Observacion',
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
							
							location.href="index.php?controller=archivo&action=Adicionar_Obs";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	/* ----------------------FUNCIONES EDITAR,CANCELAR Y GUARDAR------------------------*/
		
	var td,campo,valor,id;
	var tipocampo   = 0;
	var idlista     = 0;
	
	
	$(document).on("click",".cancelar",function(e)
	{
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
			
			//SE REALIZA ESTA RECARGA YA QUE SI UNA OBSERVACION ESTA EN
			//ESTADO EN PROCESO Y SE DA CLIC PARA EDITAR Y NO SE EDITA, SI NO QUE SE CANCELA
			//UNA QUE ESTE EN ESTAD DE TERMINADA O FINALIZADA SE ACTIVA PARA EDITAR
			//PERO DE IGUAL FORMA NO SE DEJA EDITAR QUE ES LO QUE SE BUSCA CON ESOS ESTADOS
			//PERO YA QUEDA BLOQUEADO EL EDITAR PARA TODOS LOS REGISTROS
			//$(".recargar_pagina").click();
	});
		

	$(document).on("click","td.editable span",function(e)
	{
	
	
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td        = $(this).closest("td");
			campo     = $(this).closest("td").data("campo");
			tipocampo = $(this).closest("td").data("tipocampo");
			idlista   = $(this).closest("td").data("idlista");
			valor     = $(this).text();
			id        = $(this).closest("tr").find(".id").text();
			
			//alert(tipocampo);
			//alert(campo);
			//alert(valor);
			//alert(id);
			
			//CAMPO DE TEXTO
			if(tipocampo == 1){
			
				td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO FECHA
			if(tipocampo == 2){
				
				td.text("").html("<input type='text' id='"+campo+"' name='"+campo+"' value='"+valor+"' readonly='true'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				$("#fecha_obs_i").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				$("#fecha_obs_f").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo == 3){
			
				
				td.text("").html("<textarea name='"+campo+"' cols='45' rows='5'>"+valor+"</textarea><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			
			}
			
			
			
			//CAMPO DE SELECT 
			if(tipocampo == 4){
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				var lista = "";
				
				//RESPONSABLE	
				if(idlista == 1){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Asignado A</option>";
						
						
					$("#juz_lista_2 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				
				//ESTADO
				if(idlista == 2){
						
					td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Estado</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option><option value='2'>FINALIZADA</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				}
				
				
			}
			
			
	});
	
	
	$(document).on("click",".guardar",function(e)
		{
			
			$(".mensaje").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO Y FECHAS
			if(tipocampo == 1 || tipocampo == 2){
				nuevovalor=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo == 3){
				nuevovalor=$(this).closest("td").find("textarea").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo == 4){
				nuevovalor=$(this).closest("td").find(":selected").val();
			}
			
			
			
				
			if(nuevovalor.trim()!="")
			{
				
				/*alert(tipocampo);
				alert(campo);
				alert(valor);
				alert(nuevovalor);
				alert(id);*/
				
				$.ajax({
					type: "POST",
					url: "views/popupbox/juz_editinplace_obs.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
					
					
					$(".recargar_pagina").click();
					
					
				});
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
	
	/* ----------------------FIN FUNCIONES EDITAR,CANCELAR Y GUARDAR------------------------*/
	
	
	
	
	
});

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(nombre_tabla){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById(nombre_tabla);
			
	cantidad_filas = TABLA.rows.length;
	
	//alert(cantidad_filas);	
	if(cantidad_filas>1){
			
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
	
	}
	
}


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


.contenedor_editar{margin:60px auto;width:960px;font-family:sans-serif;font-size:10px}
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
	
	.radioboton{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		
	
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
		require 'secc_archivo.php';
		
		
	?>			
	
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id ="popupbox"></div>
	
	
	<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>

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
						<!-- <input name="fechas_m" id="fechas_m" type="hidden" readonly="true"/> -->
						<!--<input name="datospartes_m110" id="datospartes_m110" type="hidden" readonly="true"/> -->
						
												
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
											<td colspan="4">
												
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
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">IdRad:</label><br>
											</td>
										
											<td colspan="3">
												<input type="text" name="juz_idradicado" id="juz_idradicado" readonly="true" style="text-align:right"/>
											</td>
										
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Radicado:</label><br>
											</td>
										
											<td colspan="3">
												<input type="text" name="juz_radicado" id="juz_radicado" readonly="true" style="text-align:right"/>
											</td>
										
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Asignado A:</label><br>
												
											
											</td>
											
											<td colspan="3">
															
												<select name="juz_lista_1" id="juz_lista_1">
												
													<option value="" selected="selected">Seleccionar Asignado A</option> 
															
													<?php
															while($row = $datos_user_JUZ->fetch()){
																		
																echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
																
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
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Observacion:</label><br>
											</td>
										
											
											<td colspan="3">
												
												<textarea id="juz_obs" name="juz_obs" cols="40" rows="5"></textarea>
											</td>
										
										</tr>
										
										
										
										<!-- <tr>
												
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Inicial:</label>
											</td>
											<td>
												<input type="text" name="juz_fechasri" id="juz_fechasri">
											</td>
																	
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Final:</label>
											</td>
											<td>
												<input type="text" name="juz_fechasrf" id="juz_fechasrf">
											</td>
																	
																					
										</tr> -->
										
										
										
										<!-- TABLA EXPEDIENTES -->
										
										<tr>
											<td colspan="4">
												
												<!-- <center><label style="width:151px; color:#FF0000; font-size:14px">EXPEDIENTES<?php //echo " / REGISTROS: ".$cantregisex; ?></label><br></center> -->
												
												<center><label style="width:151px; color:#FF0000; font-size:14px">BUSCAR EXPEDIENTE</label><br></center>
												
											</td>
										
							
										</tr>
										
										
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Buscar Expediente:</label><br>
											</td>
										
											<td colspan="3">
												
											
												<input type="text" name="juz_expediente" id="juz_expediente" style="text-align:left" value="170014003"/>
												
												<a class="buscarxfiltro_EXPEDIENTE" href="javascript:void(0);" title="BUSCAR EXPEDIENTE" style="color:#0066CC">
													<img src="views/images/lupa.png" width="20" height="20" title="BUSCAR EXPEDIENTE"/>
												</a>
							
											</td>
										
										</tr>
										
										
										
										
										<tr>
										
											<td colspan="4">
											
												<!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" id="texpe"> -->
												<table cellpadding="0" cellspacing="0" rules="rows" border="1" id="texpe" class="edit_texpe">
																						
										
													<tr> 
																						
														
						
														<th style="font-size:10px">IDRAD</th>
														<th style="font-size:10px">RADICADO</th>
														<th style="font-size:10px">FECHA</th>
														<th style="font-size:10px">CEDULA DEMANDANTE</th>
														<th style="font-size:10px">DEMANDANTE</th>
														<th style="font-size:10px">CEDULA DEMANDADO</th>
														<th style="font-size:10px">DEMANDADO</th>
														<th style="color:#FF0000; font-size:10px">FECHA SALIDA</th>
														
														
	
													</tr>
												
												</table>	
												
											</td>	
										
										</tr>	
													
										
										
										
										
										
										
										<?php if($opcion_expe == 1){ ?>
										
										<tr>
										
											<td colspan="4">
											
												<!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" id="texpe"> -->
												<table cellpadding="0" cellspacing="0" rules="rows" border="1" id="texpe" class="edit_texpe">
																						
										
													<tr> 
																						
														
						
														<th style="font-size:10px">IDRAD</th>
														<th style="font-size:10px">RADICADO</th>
														<th style="font-size:10px">FECHA</th>
														<th style="font-size:10px">CEDULA DEMANDANTE</th>
														<th style="font-size:10px">DEMANDANTE</th>
														<th style="font-size:10px">CEDULA DEMANDADO</th>
														<th style="font-size:10px">DEMANDADO</th>
														<th style="color:#FF0000; font-size:10px">FECHA SALIDA</th>
														<th style="font-size:10px">SELECCIONAR</th>
														
														
													</tr>	
													
													
													
													<?php
											
														$Cobs=1;
																		
														while($fila = $datosEXPE_1->fetch()){
															
															
															$d1M = $fila[id];
															$d2M = $fila[radicado];
															$d3M = $fila[fecha];
															$d4M = $fila[cedula_demandante];
															$d5M = $fila[demandante];
															$d6M = $fila[cedula_demandante];
															$d7M = $fila[demandado];
															$d8M = $fila[fechasalida];
															
																										
																							
													?>
																						
																			
															<tr>
																											
																<td style="color:#FF0000; font-size:10px ">
																	<?php 
																																								  
																		echo $d1M;  
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
																
																
										
																<td align="center">
																	<input type="radio" class="radioboton" id="<?php echo "chkobs".$Cobs;?>" name="radioobs" data-idfila="<?php echo trim($Cobs);?>" value="<?php echo "chkobs".$Cobs;?>" title="<?php echo "chkobs".$Cobs;?>"/>
																</td>
																
																
																
																
																<td></td>
																
																
																
														</tr>
														
														<?php  $Cobs=$Cobs+1; } ?>
													
													
													
													
													
													
													
													
												</table>	
											
											
											
											</td>
										
										
										</tr>
										
										<?php } ?>
										
										<!-- FIN TABLA EXPEDIENTES -->
										
										
		
									</table>
								
								</td>
								
							</tr>
							
							
							<tr>
								<td colspan="2">
									<center><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">TABLA OBSERVACIONES</label><br></center>
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
																<strong style="font-size:10px; color:#0066CC">IDRAD</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">RADICADO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">ASIGNADA</strong>
															</td> 
															
															<td>
																<strong style="font-size:10px; color:#0066CC">OBSERVACION</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FEC. INICIAL</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FEC. FINAL</strong>
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
	
	<?php } ?>
	
	
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
								<strong style="width:151px; color:#FF0000; font-size:16px">OBSERVACIONES ASIGNADAS<?php echo " / REGISTROS: ".$cantregis; ?></strong>
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
							<a class="buscarxfiltro_ACCION" href="javascript:void(0);" title="BUSCAR OBSERVACION" style="color:#0066CC">
								<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR OBSERVACION"/>BUSCAR OBSERVACION 
							</a>
							
							<!-- SI ES JUEZ JEFE -->
							<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
														
								<a class="finalizar_accion" href="javascript:void(0);" title="FINALIZAR OBSERVACION" style="color:#0066CC">
									<img src="views/images/save.png" width="25" height="25" title="FINALIZAR OBSERVACION"/>FINALIZAR OBSERVACION
								</a> 
							<?php } ?>	
							
							<a class="recargar_pagina" href="javascript:void(0);" title="RECARGAR" style="color:#0066CC">
								<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>RECARGAR
							</a> 
							
							
							<a class="generar_obs" href="javascript:void(0);" title="GENERAR OBSERVACIONES" style="color:#0066CC">
								<img src="views/images/excel_1.jpg" width="25" height="25" title="GENERAR OBSERVACIONES"/>GENERAR OBSERVACIONES
							</a>
							
						</td>
										
					</tr>
					
					<tr>
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Radicado:</label><br>
						</td>
										
						<td colspan="3">
							<input type="text" name="juz_radicado_2" id="juz_radicado_2"  style="text-align:right" value="<?php echo trim($_GET['datox2']); ?>"/>
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
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasri_m_2" id="fechasri_m_2" value="<?php echo trim($_GET['dato_3']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Final:</label>
						</td>
						<td>
							<input type="text" name="fechasrf_m_2" id="fechasrf_m_2" value="<?php echo trim($_GET['dato_4']); ?>">
						</td>
												
																
					</tr>
					
					
					
					<tr>
										
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Asignado A:</label><br>
												
											
						</td>
											
						<td>
															
							<select name="juz_lista_2" id="juz_lista_2">
												
								<option value="" selected="selected">Seleccionar Asignado A</option> 
															
								<?php
									while($row = $datos_user_JUZ_2->fetch()){
																		
																
										if($row[id] == trim($_GET['datox3'])){					
																				
											echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[empleado] . "</option>";
										}
										else{
											echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
										}
																
															
									}
								?>
							</select>
						</td>
						
						
						
						<td>
											
							<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Estado:</label><br>
												
											
						</td>
											
						<td>
							
							
								<select name="juz_lista_3" id="juz_lista_3">
													
									<option value="" selected="selected">Seleccionar Estado</option> 
									<option value="0">EN PROCESO</option> 
									<option value="1">TERMINADA</option> 
									<option value="2">FINALIZADA</option> 
																
									
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
						
	<!-- <div class="contenedor_editar"> -->
	<div class="mensaje"></div>
	<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="tacciones">
																						
										
		<tr> 
											
			<th style="color:#FF0000; font-size:10px">ID</th>
			<th style="font-size:10px">IDRAD</th>
			<th style="font-size:10px">RADICADO</th>
			<th style="font-size:10px">FECHA</th>
			<th style="font-size:10px">ASIGNADA</th>
			<th style="font-size:10px">OBSERVACION</th>
			<th style="font-size:10px">FEC. INICIAL</th>
			<th style="font-size:10px">FEC. FINAL</th>
			<th style="font-size:10px">RESPUESTA</th>
			<th style="font-size:10px">ESTADO</th>
			
			
			<!-- <th>									
				<a class="marcar_110" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a>
			</th>
											
			<th>										
				<a class="desmarcar_110" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos"/></a>
			</th> -->
			
			<!-- <th style="font-size:10px">+ ACTIVIDAD</th>
			
			<th style="font-size:10px">EDITAR</th> -->
			
			<th style="font-size:10px">CHECK</th>
			
			<th style="font-size:10px">
												
				<input type="checkbox" id="checkTodos" class="checkbox110"/>MARCAR/DESMARCAR 
				
			</th>
					
		</tr> 
		
		
		<?php
											
			$Ct110=1;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$d1M  = $fila[id];
				$d2M  = $fila[idcorrespondencia];
				$d3M  = $fila[radicado];
				$d4M  = $fila[fecha];
				$d5M  = $fila[empleado];
				$d6M  = $fila[observacion];
				$d7M  = $fila[fecha_obs_i];
				$d8M  = $fila[fecha_obs_f];
				$d9M  = $fila[estadoobs];
				$d10M = $fila[juz_respuesta];
				
				//SE AGREGA ESTA CONDICION PARA QUE EL CAMPO SE ACTIVE PARA EDITAR
				//YA QUE SI NO EXISTE NADA DE INFORMACION DESDE LA BASE DE DATOS
				//NO SE DEJA EDITAR
				if ( empty($d10M) ) {
					$d10M = "-";
				}
															
												
		?>
											
								
				<tr>
																
					<td style="font-size:10px; color:#FF0000" class='id'>
                      <?php 
																													  
							echo $d1M;  
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
					
			
					
					
					
					<!-- NO EDITAR ASIGNADO A VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									<?php 
																																  
										echo $d5M;  
									?>
									
								</td>	
					  <?php }
							else{ ?>
							
								<!-- ES EDITABLE SI ES  SI ES JUEZ JEFE -->
								<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
								
								<td style="font-size:10px " class='editable' data-campo='id_user_asignada' data-tipocampo=4 data-idlista=1>
								
							    <?php   }else{ ?>
								
								<td style="font-size:10px">
								
								 <?php   } ?>
								 
									<span>
									<?php 
																																  
										echo $d5M;  
									?>
									</span>
									
								</td>	
								
								
					 <?php   } ?>
					
					
					
					<!-- NO EDITAR OBSERVACION VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									<?php 
																																  
										echo $d6M;  
									?>
									
								</td>	
					  <?php }
							else{ ?>
							
								
								<!-- ES EDITABLE SI ES  SI ES JUEZ JEFE -->
								<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
								
								<td style="font-size:10px " class='editable' data-campo='observacion' data-tipocampo=3>
								
							    <?php   }else{ ?>
								
								<td style="font-size:10px">
								
								 <?php   } ?>
								
								
								
									<span>
									<?php 
																																  
										echo $d6M;  
									?>
									</span>
									
								</td>	
					 <?php   } ?>
					
					
				
	
					<!-- NO EDITAR FECHA INICIAL VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									<?php 
																																  
										echo $d7M;  
									?>
									
								</td>	
					  <?php }
							else{ ?>
							
								
								<!-- ES EDITABLE SI ES  SI ES JUEZ JEFE -->
								<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
								
								<td style="font-size:10px " class='editable' data-campo='fecha_obs_i' data-tipocampo=2>
								
							    <?php   }else{ ?>
								
								<td style="font-size:10px">
								
								 <?php   } ?>
								
								
								
									<span>
									<?php 
																																  
										echo $d7M;  
									?>
									</span>
									
								</td>	
					 <?php   } ?>
					
					
					
					
					
					<!-- NO EDITAR FECHA FINAL VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									<?php 
																																  
										echo $d8M;  
									?>
									
								</td>	
					  <?php }
							else{ ?>
							
							
								<!-- ES EDITABLE SI ES  SI ES JUEZ JEFE -->
								<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
								
								<td style="font-size:10px " class='editable' data-campo='fecha_obs_f' data-tipocampo=2>
								
							    <?php   }else{ ?>
								
								<td style="font-size:10px">
								
								 <?php   } ?>
								
								
								
									<span>
									<?php 
																																  
										echo $d8M;  
									?>
									</span>
									
								</td>	
					 <?php   } ?>
					 
					 
					 
					  <!-- NO EDITAR RESPUESTA VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									<?php 
																																  
										echo $d10M;  
									?>
									
								</td>	
					  <?php }
							else{ ?>
							
								<!-- ES EDITABLE SI ES  SI ES JUEZ JEFE -->
								<?php if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
								
											<td style="font-size:10px " class='editable' data-campo='juz_respuesta' data-tipocampo=3>
								
							    <?php   }else{ 
								
								
											if($d9M == 0){ ?>
											
												<td style="font-size:10px " class='editable' data-campo='juz_respuesta' data-tipocampo=3>
												
								<?php       } else{ ?>	
								
												<td style="font-size:10px">
								<?php       } ?>		
								
								 <?php   } ?>
								 
									<span>
									<?php 
																																  
										echo $d10M;  
									?>
									</span>
									
								</td>	
								
								
					 <?php   } ?>
					 
					 
					
					 
					
					
					
					<!-- NO EDITAR ESTADO VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<!-- <td style="font-size:10px " class='editable' data-campo='estadoobs' data-tipocampo=4 data-idlista=2> -->
						
						<?php 
							
							//SE REALIZA ESTE CAMBIO YA QUE ASI SE VENZA
							//EL TERMINO PUEDA SER EDITABLE
							/*if( $fechaactual > $d8M && $d9M == 0 ){ ?>*/
							if( $fechaactual > $d8M && $d9M == 0 ){ $d9MX = "EN PROCESO"; ?>
								
								
								<!-- <td style="font-size:10px; background-color:#FFFF00"> -->
								<td style="font-size:10px; background-color:#FFFF00" class='editable' data-campo='estadoobs' data-tipocampo=4 data-idlista=2>
								
								<span>	
									<?php 	echo $d9MX; ?>
													
											<img src="views/images/expiro.png" width="20" height="20" title="VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION"/>
								</span>			
								</td>	
					  <?php }
							else{ ?>
							
							
					  <?php			
									
									//ES EDITABLE SI ES  SI ES JUEZ JEFE 
								 	if ( in_array($_SESSION['idUsuario'],$datos_JEFE_2,true) ){ ?>
									
										<td style="font-size:10px " class='editable' data-campo='estadoobs' data-tipocampo=4 data-idlista=2>
										
										<span>
										
										
										
					 <?php				
					 					if($d9M == 0){
											$d9MX = "EN PROCESO";
										}
					 					if($d9M == 1){
											$d9MX = "TERMINADA";
										}
										if($d9M == 2){
											$d9MX = "FINALIZADA";
										} 
										
										echo $d9MX; 
										
										?>
										
										</span>
										
										</td> 
										
					 <?php			}else{ 
					 
					 					
										
					 					if($d9M == 0){ ?>
										
											
											
											<!-- <td style="font-size:10px " class='editable' data-campo='estadoobs' data-tipocampo=4 data-idlista=2>  -->
											
											<td style="font-size:10px">
											
											<!-- <span> -->
											
					 <?php					$d9MX = "EN PROCESO";
					 
					 						echo $d9MX;	?>
											
											
											<!-- </span> -->
											
											</td>
											
					 <?php				 	
										}
					 					else{
					 ?>
					 
											<td style="font-size:10px">
											
					<?php				
											
											if($d9M == 1){
												$d9MX = "TERMINADA";
											}
											if($d9M == 2){
												$d9MX = "FINALIZADA";
											} 
											
											echo $d9MX; 
										
										} ?>
										
										
										
											</td>
						<?php		} ?>	  
									
									
									
					 <?php   } ?>
						
						
					<!-- </td>  -->
					
					
					<!-- <td>
						<a class="generar_actividad" href="javascript:void(0);" title="ADICIONAR ACTIVIDAD" data-id="<?php //echo trim($d1M);?>"><img src="views/images/listar.png" width="45" height="30" title="ADICIONAR ACTIVIDAD"/></a>
					</td>
					
					<td>
						<a class="editar_accion" href="javascript:void(0);" title="EDITAR ACCION" data-id="<?php //echo trim($d1M);?>"><img src="views/images/editar_1.png" width="25" height="25" title="EDITAR ACCION"/></a>
					</td> -->
					
					
					<!-- NO CHEKEAR VENCIMIENTO DE TERMINO PARA REALIZAR OBSERVACION -->
					
					<?php 
							
							
							if( $fechaactual > $d8M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
									
									-
									
								</td>	
					  <?php }
							else{ ?>
							
								<td>
									<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox110"/>
								</td>	
								
					 <?php   } ?>
					
					
					<td></td>
					
					
					
			</tr>
			
			<?php  $Ct110=$Ct110+1; } ?>		
											
	</table>
	<!-- </div> -->
	
	
	<?php
	//}
	?>
	
	
	
			
<?php require 'alertas.php';?>
</body>
</html>


