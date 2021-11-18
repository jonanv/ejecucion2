<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $funcion->get_fecha_actual_amd();
setlocale(LC_TIME, "Spanish");
$fechaactual_2 = strftime('%d de %B de %Y', strtotime($fechaactual)); 

$idUsuario   = $_SESSION['idUsuario'];

$id_juzgado  = $_SESSION['id_juzgado'];

//echo $id_juzgado;

$njuzgado    = $funcion->get_Juzgado($id_juzgado);

//echo $id_juzgado;

//idaccion = 25 ---> 38////8 ID USUARIOS QUE PUEDEN VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS 
//Y VER LA LISTA Usuario DE LA VISTA so_ticket.php DE LA CARPETA popupbox
$campos           = 'usuario';
$nombrelista      = 'pa_usuario_acciones';
$idaccion	      = '25';
$campoordenar     = 'id';
$datosusuarioSOLI = $funcion->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//$usuariosSOLI1    = $datosusuarioSOLI->fetch();
//$usuariosaSOLI2	  = explode("////",$usuariosSOLI1[usuario]);
$usuariosaSOLI2	  = explode("////",$datosusuarioSOLI);

//print_r($usuariosaSOLI2);


//$id_accion = trim($_POST['id']);


//SIN NO ESTA EL USUARIO EN SESION, NO ES UN USUARIO 
//QUE PUEDE VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS Y VER LA LISTA Usuario DE LA VISTA so_ticket.php DE LA CARPETA popupbox
//SOLO LAS SOLICITADAS POR EL
if ( !in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
	
	$id_filtro_u = $_SESSION['idUsuario'];
}

//echo $id_filtro_u;
//echo trim($_POST['id_filtro']);

//SOLICITUDES, SIN FILTRO
if( trim($_POST['id_filtro']) == 0){
	
	$datosdelit_4F  = $funcion->get_datos_JUZAUDIENCIAS($id_filtro_u,$id_juzgado);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
	
}


//SOLICITUDES SEGUN FILTRO
if( trim($_POST['id_filtro']) == 1){


	$datox1 = trim($_POST['datox1']);
	$datox2 = trim($_POST['datox2']);
	$datox3 = trim($_POST['datox3']);
	$datox4 = trim($_POST['datox4']);
	$datox5 = trim($_POST['datox5']);
	$datox6 = trim($_POST['datox6']);
	
	
	$datosdelit_4F  = $funcion->get_datos_JUZAUDIENCIAS_FILTRO($id_filtro_u,$id_juzgado,$datox1,$datox2,$datox3,$datox4,$datox5,$datox6);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
			
	
	//echo "datox2: ".strlen($datox2);
	
	//echo "datox2: ".$datox2;
}	

$ip_plataforma = trim($_SESSION['ipplataforma']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script type="text/javascript">

$('document').ready(function(){



		var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
		var ipservidor = ip_servidor;
		
		//var ipservidor = "190.217.24.24";
		
		//OCULTAR GIF CARGANDO
		$('#fila_cargando').hide();

		 //-----------------------------------PARA QUE LAS FECHA SALGA EN ESPA�OL--------------------------------------------------------------------
		 $.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '< Ant',
		 nextText: 'Sig >',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
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
		$("#audi_fecha").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fecha_audii").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fecha_audif").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		$("#fechasri_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasri_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		
		


		$('#cancel_audi').click( function(){
		
			//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
			//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
			$(document).off('click');
								  
        	$('#block').hide();
        	$('#popupbox').hide();
			
	
    	});
		
		
		
		
		$(".registrar_audi").click(function(evento){
		
			
			var dataString      = "";
			
			var idspermisoAUDIX  = "";
			var idspermiso_AUDIX = 0;
			
			
			var fAUDIX = 1;
			
			var dAUDIX;
			

			var cantidad_filas_AUDIX;
			var TABLA_AUDIX = document.getElementById('t_AUDI');
			
			cantidad_filas_AUDIX = TABLA_AUDIX.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_AUDIX; r++){
				
				d0AUDIX  = document.getElementById("t_AUDI").rows[r].cells[0].innerText;//ID
				d1AUDIX  = document.getElementById("t_AUDI").rows[r].cells[1].innerText;//RADICADO
				d2AUDIX  = document.getElementById("t_AUDI").rows[r].cells[2].innerText;//FECHA
				d3AUDIX  = document.getElementById("t_AUDI").rows[r].cells[3].innerText;//HORA
				d4AUDIX  = document.getElementById("t_AUDI").rows[r].cells[4].innerText;//FIJA ESTADO
				d5AUDIX  = document.getElementById("t_AUDI").rows[r].cells[5].innerText;//TIPO AUDIENCIA
				
				
				//if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoAUDIX = d0AUDIX+"//////"+d1AUDIX+"//////"+d2AUDIX+"//////"+d3AUDIX+"//////"+d4AUDIX+"//////"+d5AUDIX+"******"+idspermisoAUDIX;
						
						idspermiso_AUDIX = 1;
						
						
						
				//}
				
				
				
					
				fAUDIX = fAUDIX + 1;
				
				
			}
			
			
			
			if(idspermiso_AUDIX == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se Cuenta con Ningun Registro en la TABLA AUDIENCIAS";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
					//OCULTAMOS BOTON REGISTRAR
					//PARA EVITAR QUE EL USUARIO DE CLIC
					//VARIAS VECES Y LA AUDIENCIA SE DUPLIQUE
					$('#btnregistrar_audi').hide();
										
					$('#fila_cargando').show();
					
				
					$('#datos_audi').val('');
					$('#datos_audi').val(idspermisoAUDIX);
					
					dataString += '&datospartes='+$('#datos_audi').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Registrar_Audiencia',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_acti').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
						
							$('#fila_cargando').hide();
							
							$(".mensage_acti").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
							//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
							$(document).off('click');
							
							params={};
							//params.id        = id;
							params.id_filtro = 0;
							
							
							
							//alert(params.eveasunto);
							$('#popupbox').load('views/popupbox/audi_programar.php',params,function(){
								//alert(2);
								$('#block').show();
								//alert(3);
								$('#popupbox').show();
								//alert(4);
							})
							
							
							
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
		
		
		
		
		
		


	   	$("#checkTodos").change(function () {
		  
		  $("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
		  //$("input:checkbox").attr('checked', $(this).attr("checked"));
		  
		 
	   	});
		
		
		
		
		
		
		
		$('.generar_pdf').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var id = $(this).attr('data-id');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/laborales/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
		});
		
		$('.generar_obs').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var idrad = $(this).attr('data-idrad');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/laborales/views/tcpdf/HISTORIAL_PROCESO.php?id="+idrad);
				
		});
		
		
		
		$(".aprobarsoli").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
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
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 2; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				d1R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla REMATES";
				$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_soli').show('slow');
				
				setTimeout(function() {
					$(".mensage_soli").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_Aprobar_Remates',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_soli').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_soli").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$(".desaprobarsoli").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
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
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 2; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				d1R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla REMATES";
				$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_soli').show('slow');
				
				setTimeout(function() {
					$(".mensage_soli").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_Des_Aprobar_Remates',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_soli').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_soli").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	/*$(".recargar_solicitud").click(function(){
								
		
			dato_soli = 0;
			
			
			$('#block').hide();
        	$('#popupbox').hide();
		
	
			params={};
			
			params.dato_soli = 0;
			

			$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		
			
		
	});*/
	
	
	
	
	
	
	$(".solicitud_pdf").click(function(){
								
		
		
		if( 
		
			$('#id_rema').val().length       == 0 &&
		   	$('#rad_rena').val().length      == 0 && 
		   	$('#fechasoli_ri').val().length  == 0 &&
		   	$('#fechasoli_rf').val().length  == 0 
			
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_rema').style.borderColor      = '#FF0000';
			document.getElementById('rad_rena').style.borderColor     = '#FF0000';
			document.getElementById('fechasoli_ri').style.borderColor =  '#FF0000';
			document.getElementById('fechasoli_rf').style.borderColor = '#FF0000';
			
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			
			//FECHAS REMATE
			dato_1 = $('#fechasoli_ri').val();
		   	dato_2 = $('#fechasoli_rf').val();
			
			//ID REMATE
		   	datox1 = $('#id_rema').val();
			
			//RADICADO
			datox2 = $('#rad_rena').val();
			
			
			window.open("views/tcpdf/GENERAR_REMATES.php?dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2);
			
			
			
			
		}
		
	});
	
	
	
	
	//CARGAR LISTAS
	$("#despacho_soli").change(function(event){
            
		var id = $("#despacho_soli").find(':selected').val();
			
		
		$("#solicita_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+1);
		
		$('#bloque_soli').html('');
		
		$("#bloque_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+3);
			
			
    });
	
	$("#solicita_soli").change(function(event){
            
		var id = $("#solicita_soli").find(':selected').val();
			
		
		$('#bloque_soli').html('');
		
		$("#bloque_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+4);
			
			
    });
	
	
	
	
	/* FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
	
	//NOTA: PARA NO TENER INCONVENIRNTES CON TABLAS EDITABLES, YA QUE REMATES_SINAPROBAR.PHP
	//SE ABRE SOBBRE ARCHIVO_FILTRAR_UBICACION.PHP Y TIENE LAS MISMAS VARIABLES PARA EDITAR, CANCELAR Y GUARDAR
	//SIMPLEMENTE SE DEFINEN OTRAS VARIBALES
	
	<!-- st: sigla por solicitud tecnica -->
	
	var td_audi,campo_audi,valor_audi,id_audi,$rc_audi,row_audi,col_audi,nuevovalor_audi;
	var tipocampo_audi     = 0;
	var idlista_audi       = 0;
	
	var procesar_audi      = 0;
    var solorespuesta_audi = 0;
	var anular_audi        = 0;
	
	var idXaudi,radiXaudi,fechaXaudi,horaiXaudi,horafXaudi,estadoXaudi;
	var causalXaudi,tipoXaudi;
	
	//PASAMOS VARIABLES PHP A JAVASCRIPT
	var id_juzgado = "<?php echo $id_juzgado; ?>";
	
	
	$(document).on("click",".cancelar_audi",function(e)
	{
			e.preventDefault();
			td_audi.html("<span>"+valor_audi+"</span>");
			$("td:not(.id)").addClass("editable_audi");
			
			$(".recargar_AUDIENCIA").click();
						
			
	});
		

	$(document).on("click","td.editable_audi span",function(e)
	{
	
	
			e.preventDefault();
			$("td:not(.id)").removeClass("editable_audi");
			td_audi        = $(this).closest("td");
			campo_audi     = $(this).closest("td").data("campo_audi");
			tipocampo_audi = $(this).closest("td").data("tipocampo_audi");
			idlista_audi   = $(this).closest("td").data("idlista_audi");
			valor_audi     = $(this).text().trim();//PARA LIMPIAR LOS ESPACIOS DE IZQUIERDA Y DERECHA
			id_audi        = $(this).closest("tr").find(".id").text();
			
			//alert(tipocampo);
			//alert(campo);
			//alert(valor);
			//alert(id);
			
			 //SE CAPTURA FILA Y COLUMNA
			 $rc_audi  = $(this).parent("td");     
			 //SE SUMA DOS PARA QUE DE LA FILA REAL, YA QUE CUENTA DESDE QUE SE ARMA LA INFORMACION CON LA CONSULRA RETORNADA EN datosdelit_4BF 
			 row_audi = $rc_audi.parent().parent().children().index($rc_audi.parent()) + 2;	
			 col_audi = $rc_audi.parent().children().index($rc_audi);
			 
			 //CAPTURA COLUMNA RESPUESTA CON SU DATO, SEGUN FILA Y COLUMNA, PARA VALIDAR,
			 //SI AL ESCOGER ESTADO TERMINADA, SE DEBE DEFINIR UNA RESPUESTA
			 idXaudi     = document.getElementById("taudi").rows[row_audi].cells[0].innerText;
			 radiXaudi   = document.getElementById("taudi").rows[row_audi].cells[1].innerText;
			 fechaXaudi  = document.getElementById("taudi").rows[row_audi].cells[2].innerText;
			 horaiXaudi  = document.getElementById("taudi").rows[row_audi].cells[3].innerText;
			 horafXaudi  = document.getElementById("taudi").rows[row_audi].cells[4].innerText;
			 estadoXaudi = document.getElementById("taudi").rows[row_audi].cells[6].innerText;
			 tipoXaudi   = document.getElementById("taudi").rows[row_audi].cells[8].innerText;
			
			 //alert('FILA: '+row_audi + ' COLUMNA: ' + col_audi); 
			 //alert('VALOR ID: '+idX+' VALOR FECHA: '+fechaX+' VALOR HORA: '+horaX+' VALOR DESCRIP: '+desX+ ' VALOR USUARIO: '+userX+' VALOR FECHA_R: '+fechaRX+' VALOR HORA_R: '+horaRX+' VALOR RESPUESTA: '+respuestaX+' VALOR ESTADO: '+estadoX);
  
			//CAMPO DE TEXTO
			if(tipocampo_audi == 1){
			
				td_audi.text("").html("<input type='text' name='"+campo_audi+"' value='"+valor_audi+"'><a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO FECHA
			if(tipocampo_audi == 2){
				
				td_audi.text("").html("<input type='text' id='"+campo_audi+"' name='"+campo_audi+"' value='"+valor_audi+"' readonly='true'><a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>");
				
				$("#fecha").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				
			}
			
			//CAMPO HORA
			if(tipocampo_audi == 5){
			
				td_audi.text("").html("<input type='time' name='"+campo_audi+"' value='"+valor_audi+"'><a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_audi == 3){
			
				
				td_audi.text("").html("<textarea name='"+campo_audi+"' cols='45' rows='5'>"+valor_audi+"</textarea><a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>");
			
			}
			
			
			
			//CAMPO DE SELECT 
			if(tipocampo_audi == 4){
			
				 //alert('FILA: '+row_audi + ' COLUMNA: ' + col_audi); 
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				var lista = "";
				
				
				//RESPONSABLE	
				if(idlista_audi == 1){
						
					lista+="<select name='"+campo_audi+"' id='"+campo_audi+"' title='"+campo_audi+"' onChange='cargar_causal(this.value,"+row_audi+")'>";
					lista+="<option value='' selected='selected'>Seleccionar Estado</option>";
						
						
					$("#lestado_audi option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>";
						
					td_audi.text("").html(lista);
				}
				
				
				//ESTADO
				/*if(idlista_audi == 2){
						
					td_audi.text("").html("<select name='"+campo_audi+"' id='"+campo_audi+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option><option value='3'>ANULADA</option></select><a class='enlace guardar_audi' href='#'>Guardar</a><a class='enlace cancelar_audi' href='#'>Cancelar</a>");
				}*/
				
				
			}
			
			
	});
	
	
	$(document).on("click",".guardar_audi",function(e)
		{
		
			
			$(".mensaje").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO,FECHAS Y HORAS
			if(tipocampo_audi == 1 || tipocampo_audi == 2 || tipocampo_audi == 5){
				nuevovalor_audi=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_audi == 3){
				nuevovalor_audi=$(this).closest("td").find("textarea").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo_audi == 4){
				nuevovalor_audi=$(this).closest("td").find(":selected").val();
			}
			
			
			//alert("campo: "+campo_st+" - "+"nuevovalor: "+nuevovalor_st+" - "+"tipocampo: "+tipocampo_st);
			
		
			if(nuevovalor_audi.trim()!=""){
			
				/*alert(tipocampo_audi);
				alert(campo_audi);
				alert(valor_audi);
				alert(nuevovalor_audi);
				alert(id_audi);*/
				
				//alert(horaiXaudi+" "+horafXaudi);
				
				//SE REALIZA ESTA COMPARACION, YA QUE EL USUARIO
				//PUEDE SELECCIONAR ESTADO TERMINADA Y QUE EL SISTEMA PIDA
				//QUE SE DEFINA RESPUESTA
				if(campo_audi == "estado" && nuevovalor_audi == 2 && horafXaudi == '-'){
				
					
					//alert(horafXaudi);
					
					//$(".mensaje").html("<p class='ko'>Defina Respuesta</p>");
				
					$('.mensaje').html("<p class='ko'>Defina Hora Final</p>");//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensaje').show('slow');
					
					setTimeout(function() {
						$(".mensaje").fadeOut(2000);
					},2000);
					
					
					procesar_audi = 0;
					
					return false;
					
				}
				else{
				
					procesar_audi = 1;
					
					
				}
				
				
				if(campo_audi == "estado" && (nuevovalor_audi == 4 || nuevovalor_audi == 5) ){
				
					//alert(row_audi);
			
					var row_audi_real = row_audi - 1;
					
					
					valor1 = document.getElementById('lcausal'+row_audi_real).value;
	
	
					if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
						
						
						
						$('.mensaje').html("<p class='ko'>Defina Causal</p>");//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensaje').show('slow');
						
						setTimeout(function() {
							$(".mensaje").fadeOut(2000);
						},2000);
						
						
						procesar_audi = 0;
						
						return false;
	
						//document.getElementById('lcausal'+row_audi_real).style.borderColor = '#FF0000';
						
					}
					else{
					
						causalXaudi = $("#lcausal"+row_audi_real).find(':selected').val();
						
						procesar_audi = 1;
						
						//alert(causalXaudi);
					
					}
					
					
					
					
					
				}
				else{
				
					procesar_audi = 1;
					
					
				}
				
				
				
			
				if(procesar_audi == 1){
				
					
					//contador_st = 0;
				
					$.ajax({
					
						type: "POST",
						url: "views/popupbox/audi_editinplace.php",
						data: { campo: campo_audi, valor: nuevovalor_audi, id:id_audi, idXaudi: idXaudi ,radiXaudi: radiXaudi,fechaXaudi: fechaXaudi,horaiXaudi: horaiXaudi,horafXaudi: horafXaudi,estadoXaudi: estadoXaudi,id_juzgado: id_juzgado,causalXaudi: causalXaudi,tipoXaudi: tipoXaudi }
						
						//data: { campo: campo_st, valor: nuevovalor_st, id:id_st, solorespuesta:solorespuesta_st, anular:anular_st, idX:idX,fechaX:fechaX,horaX:horaX,desX:desX,userX:userX,fechaRX:fechaRX,horaRX:horaRX,respuestaX:respuestaX,estadoX:estadoX }
						
					})
					.done(function( msg ) {
					
						$(".mensaje").html(msg);
						td_audi.html("<span>"+nuevovalor_audi+"</span>");
						$("td:not(.id)").addClass("editable_audi");
						
						
						//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
						//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
						$(document).off('click');
					
						//setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
						
						 //OTRA FORMA DE VOLVER A LLAMAR LA VENTANA
						 //ESTA PARTE SE ANEXA PARA QUE VUELVA A LLAMAR LA VENTANA
					    //so_ticket.php
						//var cargar_solicitud = 1;
						//location.href="index.php?controller=archivo&action=listarUbicacionExpediente&cargar_solicitud="+cargar_solicitud;
						
						
						
						setTimeout(function() {
							
							$('.ok,.ko').fadeOut('fast');
							
							
							//SE LLAMA DE NUEVO LA VENTANA EMERGENTE
							
							//PASAMOS VARIABLES PHP A JAVASCRIPT
							//var id = "<?php echo $id_accion; ?>";
							
							params={};
							//params.id        = id;
							params.id_filtro = 0;
							
					
							$('#popupbox').load('views/popupbox/audi_programar.php',params,function(){
								//alert(2);
								$('#block').show();
								//alert(3);
								$('#popupbox').show();
								//alert(4);
							})
						
						
						}, 1000);
						
						
						
					});
					
				
				}
				
				
			}
			else{ 
				
				//$(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>"); 
				
				$(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>"); //A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensaje').show('slow');
					
				setTimeout(function() {
					$(".mensaje").fadeOut(2000);
				},2000);
				
				
				
				
			}
			
			
			
		});
	
	
	
	/* FIN FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
	
	
	$("#estado").change(function(event){
            
		var id = $("#estado").find(':selected').val();
			
		alert(id);
		/*$("#solicita_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+1);
		
		$('#bloque_soli').html('');
		
		$("#bloque_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+3);*/
			
			
    });
	
	
	
	
	
	
	$(".buscarxfiltro_AUDIENCIA").click(function(){
								
		
		
		if( 
			
		   $('#id_audi').val().length      == 0 &&
		   $('#radi_audi').val().length    == 0 && 
		   $('#fecha_audii').val().length  == 0 &&
		   $('#fecha_audif').val().length  == 0 && 
		   $('#ljuz_audi').val().length    == 0 &&
		   $('#lestado_audi').val().length == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_audi').style.borderColor      =  '#FF0000';
			document.getElementById('radi_audi').style.borderColor    =  '#FF0000';
			document.getElementById('fecha_audii').style.borderColor  =  '#FF0000';
			document.getElementById('fecha_audif').style.borderColor  =  '#FF0000';
			document.getElementById('ljuz_audi').style.borderColor    =  '#FF0000';
			document.getElementById('lestado_audi').style.borderColor =  '#FF0000';
			
			
		}
		else{
			
			//alert("BUSCANDO...");
	
			$('#block').hide();
        	$('#popupbox').hide();
			
		    datox1 = $('#id_audi').val();
			datox2 = $('#radi_audi').val();
			datox3 = $('#fecha_audii').val();
			datox4 = $('#fecha_audif').val();
			datox5 = $('#ljuz_audi').val();
			datox6 = $('#lestado_audi').val();
		    
			//location.href="index.php?controller=auto&action=Busquedad_Filtro_CLIENTE&dato_0="+dato_0+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
			
			
			//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
			//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
			$(document).off('click');
			
			
			params={};
			params.id_filtro = 1;
			params.datox1    = datox1;
			params.datox2    = datox2;
			params.datox3    = datox3;
			params.datox4    = datox4;
			params.datox5    = datox5;
			params.datox6    = datox6;
			
			
	
			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/audi_programar.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
			

			
		}
		
	});
	
	$(".recargar_AUDIENCIA").click(function(){
	
		
		//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
		//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
		$(document).off('click');
		
		params={};
		//params.id      = id;
		params.id_filtro = 0;
							
							
							
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/audi_programar.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		
							
	
	});
	
	
	$(".generar_excel").click(function(){
	
	
	
		if( 
			
		   $('#id_audi').val().length      == 0 &&
		   $('#radi_audi').val().length    == 0 && 
		   $('#fecha_audii').val().length  == 0 &&
		   $('#fecha_audif').val().length  == 0 && 
		   $('#ljuz_audi').val().length    == 0 &&
		   $('#lestado_audi').val().length == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_audi').style.borderColor      =  '#FF0000';
			document.getElementById('radi_audi').style.borderColor    =  '#FF0000';
			document.getElementById('fecha_audii').style.borderColor  =  '#FF0000';
			document.getElementById('fecha_audif').style.borderColor  =  '#FF0000';
			document.getElementById('ljuz_audi').style.borderColor    =  '#FF0000';
			document.getElementById('lestado_audi').style.borderColor =  '#FF0000';
			
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 9000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro_u = "<?php echo $id_filtro_u; ?>";
			var id_juzgado  = "<?php echo $id_juzgado; ?>";
			
			//alert(id_filtro_u+" "+id_juzgado);
			
			//FECHAS REGISTRO
			//dato_1 = $('#fechasri_m').val(); 
		    //dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#id_audi').val();
			datox2 = $('#radi_audi').val();
			datox3 = $('#fecha_audii').val();
			datox4 = $('#fecha_audif').val();
			datox5 = $('#ljuz_audi').val();
			datox6 = $('#lestado_audi').val();
			
			//alert(datox1+" "+datox2+" "+datox3+" "+datox4+" "+datox5+" "+datox6);
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&id_filtro_u="+id_filtro_u+"&id_juzgado="+id_juzgado;
			
		
		}
		
	
	});
	
	
	$(".generar_historial").click(function(){
	
	
	
		if( 
			
		   $('#id_audi').val().length      == 0 &&
		   $('#radi_audi').val().length    == 0 && 
		   $('#fecha_audii').val().length  == 0 &&
		   $('#fecha_audif').val().length  == 0 && 
		   $('#ljuz_audi').val().length    == 0 &&
		   $('#lestado_audi').val().length == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_audi').style.borderColor      =  '#FF0000';
			document.getElementById('radi_audi').style.borderColor    =  '#FF0000';
			document.getElementById('fecha_audii').style.borderColor  =  '#FF0000';
			document.getElementById('fecha_audif').style.borderColor  =  '#FF0000';
			document.getElementById('ljuz_audi').style.borderColor    =  '#FF0000';
			document.getElementById('lestado_audi').style.borderColor =  '#FF0000';
			
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 10000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro_u = "<?php echo $id_filtro_u; ?>";
			var id_juzgado  = "<?php echo $id_juzgado; ?>";
			
			//alert(id_filtro_u+" "+id_juzgado);
			
			//FECHAS REGISTRO
			//dato_1 = $('#fechasri_m').val(); 
		    //dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#id_audi').val();
			datox2 = $('#radi_audi').val();
			datox3 = $('#fecha_audii').val();
			datox4 = $('#fecha_audif').val();
			datox5 = $('#ljuz_audi').val();
			datox6 = $('#lestado_audi').val();
			
			//alert(datox1+" "+datox2+" "+datox3+" "+datox4+" "+datox5+" "+datox6);
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&id_filtro_u="+id_filtro_u+"&id_juzgado="+id_juzgado;
			
		
		}
		
	
	});
	
	
	 
	  
});

function cargar_causal(idestado,id_fila){

	//alert(idestado+" "+id_fila);	
	
	//var id_modalidad = $("#hv_modalidad_es").find(':selected').val();
	
	//SE RESTA UNO YA QUE TAMBEN SE CUENTA LA FILA DE LOS ENCABEZADOS
	var fila_real = id_fila - 1;
			
	//CARGAR LISTA CAUSAL
	$("#lcausal"+fila_real).load('funciones/traer_datos_lista.php?id='+idestado+"&idsql="+4);
}

</script>

	<style>
	.contenedor_audi{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	<!-- th {padding:5px; background-color:#555;color:#fff} -->
	th {padding:5px; background-color:#CDE3F9;color:#000000}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable_audi span{display:block;}
		.editable_audi span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar_audi{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar_audi{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
			
	.checkbox110{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle;}	
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
	</style>

	<!-- Creamos un estilo para nuestro mensajes -->
	<style type="text/css">
	
	
		.mensage_acti{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
		.mensage_soli{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
	</style>

	
	<form name ="frm_RAC" id="frm_RAC"  method="post" enctype="multipart/form-data" action=""> 
	
	
		<input type="hidden" name="datos_audi" id="datos_audi" readonly="true"/>
		
		<input type="hidden" name="fechaactualregis" id="fechaactualregis"  readonly="true" value="<?php echo trim($fechaactual); ?>"/>
		
		<div class="buttonsBar">
		
			<button id="cancel_audi" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
			<!-- <button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button> -->
			
		</div>
	
		<table border="0" align="center">
		
		
			<!-- <tr> 
																			
				<td>
					
					<button type="submit" name="boton_registrar" id="boton_registrar" title="REGISTRAR" style="float:right "><img src="views/images/disk1.png" width="30" height="30"/></button> 
					
					
				</td>
								
			</tr> 
			
			<tr>
				<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ADICIONAR SERVIDOR JUDICAL</td><br><br>
			</tr> -->
			
			
			<tr>
				<td colspan="2">
					<!-- MENSAJES -->
					<div class="mensage_acti"></div>  
				</td>
							
			</tr>
			
			<tr>
				
												
				<td>
											
					<table align="center">
					
						<tr>
							<th bgcolor="#CDE3F9" colspan="2">
								<h2><center>PROGRAMAR AUDIENCIA</center></h2>
							</th>
						</tr>	
						
						<tr>
							<th bgcolor="#CDE3F9" colspan="2">
								<h2><center><?php echo $njuzgado; ?></center></h2>
							</th>
						</tr>
						
						<tr>
							<th bgcolor="#CDE3F9" colspan="2">
								<h2><center><?php echo "FECHA: ".$fechaactual_2; ?></center></h2>
							</th>
						</tr>	
					
						<!-- <tr>
							<td colspan="2">
								
								
								<img src="views/images/soporte_5.png" width="200" height="200" style="float:right"/>
								
							</td>
						</tr>  -->
						
						<tr>
							<td colspan="2">
								
								
								<!-- <a class="recargar_solicitud" href="javascript:void(0);" title="RECARGAR" style="float:right">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>
								</a>
								
								<a class="solicitud_pdf" href="javascript:void(0);" title="GENERAR PDF" style="float:right">
									<img src="views/images/archivo_3.png" width="25" height="25" title="GENERAR PDF"/>
								</a>  -->
								
								
								
								
								<img src="views/images/new3.jpg" width="25" height="25" title="ADICIONAR AUDIENCIA" onClick="Adicionar_Audi()"/>
								<a class="registrar_audi" href="javascript:void(0);"><img id="btnregistrar_audi" src="views/images/save.png" width="25" height="25" title="REGISTRAR AUDIENCIA"/></a>
								
								<a href="/laborales/audienciasjuz/index.php" style="float:right"><img src="views/images/calendario.jpg" width="55" height="45" title="CALENDARIO"/></a>
								
								
								
								
							</td>
						</tr> 
						
						<tr id="fila_cargando" align="center">
						
							<td colspan="2">
								<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
							</td>
															
						</tr>
						
						
						<!-- <tr>
																					
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Usuario:</label><br>			
								<select name="listaC" id="listaC">
												
										<option value="" selected="selected">Seleccionar Usuario</option>  -->
															
										<?php	
										//LISTA RESPONSABLE
										
										/*if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
										
											$campo_a_mostrar  = 'empleado';
											$campo_a_insertar = 'id';
											$nombre_tabla     = 'pa_usuario';
											$campo_filtro     = 'nombre_usuario';
											$valor_filtro     = "NOT LIKE '%D%'";
											$campo_a_ordenar  = 'empleado';
											$datosRES         = $funcion->cargar_lista_con_filtro_LIKE($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										}
										else{
										
											$campo_a_mostrar  = 'empleado';
											$campo_a_insertar = 'id';
											$nombre_tabla     = 'pa_usuario';
											$campo_filtro     = 'id';
											$valor_filtro     = $_SESSION['idUsuario'];
											$campo_a_ordenar  = 'empleado';
											$datosRES         = $funcion->cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										
										}*/
										
										?>
								<!-- </select>
							</td>
											
						</tr> -->
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Radicado:</label><br>
								<input type="text" name="audi_radi" id="audi_radi" onblur="Proceso_Bloqueado(this.value)"/>
							</td>
										
						</tr>
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Fecha Audi:</label><br>
								<input type="text" name="audi_fecha" id="audi_fecha"/>
							</td>
										
						</tr>
						
						<tr>
							<td>
							
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Hora Audi:</label><br>
								<input type="time" id="audi_horai" name="audi_horai">
							
							</td>
							
							
						</tr>
						
						<tr>
						
							<td>
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Tipo Audiencia:</label><br>
								<select name="audi_tipo_audi" id="audi_tipo_audi">
												
										<option value="" selected="selected">Seleccionar Tipo Audiencia</option> 
															
										<?php	
										
												$campo_a_mostrar    = 'des';
												$campo_a_insertar_1 = 'id';
												$campo_a_insertar_2 = 'numactu';
												$campo_a_insertar_3 = 'des';
												$nombre_tabla       = 'siepro_tipo_audi';
												$campo_a_ordenar    = 'des';
												$datosTIPOAUDI      = $funcion->cargar_lista_2($campo_a_mostrar,$campo_a_insertar_1,$campo_a_insertar_2,$campo_a_insertar_3,$nombre_tabla,$campo_a_ordenar);
									
										?>
								</select>
								
							</td>
						
						
						</tr>
						
						
						<!-- <tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Descripcion Solicitud:</label><br>
								<textarea id="gc_ac_2" name="gc_ac_2" cols="80" rows="5"></textarea>
							</td>
										
						</tr> -->
						
						
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			
		
			
			<tr>
				
				
				<td colspan="2">
					<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px">TABLA AUDIENCIAS</label>
				</td>
				
				
										
			</tr>
										
							
			<tr>
							
				<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_AUDI"> 
													<table id="t_AUDI" border="1"> 
														<tr>
															
															
															
															<td>
																<strong style="font-size:10px; color:#0066CC">IDRADI</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">RADICADO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FECHA AUDI</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">HORA AUDI</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FIJA ESTADO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">TIPO AUDI</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">ELIMINAR</strong>
															</td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
				</td>
							
			</tr>
			
			
			
			
			
			
			<!-- PARA BUSQUEDAD DE SOLICITUDES -->
			
			
			
			<tr>
							
				<td colspan="2">
				
					<table>
					
						<tr>
							<th bgcolor="#CDE3F9" colspan="4">
								<center>FILTRO AUDIENCIAS</center>
							</th>
							
						</tr>
						
						
						<tr>
						
							<td colspan="4">
							
								<a class="buscarxfiltro_AUDIENCIA" href="javascript:void(0);" title="BUSCAR AUDIENCIA" style="color:#0066CC">
									<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR AUDIENCIA"/>BUSCAR AUDIENCIA 
								</a>
								
								<a class="recargar_AUDIENCIA" href="javascript:void(0);" title="RECARGAR" style="color:#0066CC">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>RECARGAR
								</a>
								
								<a class="generar_excel" href="javascript:void(0);" title="GENERAR EXCEL" style="color:#0066CC;">
									<img src="views/images/excel_1.jpg" width="25" height="25" title="GENERAR EXCEL"/>GENERAR EXCEL
								</a> 
								
								<a class="generar_historial" href="javascript:void(0);" title="GENERAR HISTORAL AUDIENCIA" style="color:#0066CC;">
									<img src="views/images/exceltitulos.png" width="25" height="25" title="ENERAR HISTORAL AUDIENCIA"/>GENERAR HISTORAL AUDIENCIA
								</a> 
														
								
							</td>
											
						</tr>
						
						
	
						<tr>
						
							<td>
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">ID:</label><br>
							</td>
										
							<td>
								<input type="text" name="id_audi" id="id_audi" style="color:#FF0000; font-size:12px" value="<?php echo trim($_POST['datox1']); ?>"/>
							</td>
							
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Radicado:</label>
							</td>
										
							<td colspan="3">
								<input type="text" name="radi_audi" id="radi_audi" style="color:#FF0000; font-size:12px" value="<?php echo trim($_POST['datox2']); ?>"/>
							</td>
						
			
						</tr>
						
						
						<tr>
												
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Audi Inicial:</label>
							</td>
							<td>
								<input type="text" name="fecha_audii" id="fecha_audii" value="<?php echo trim($_POST['datox3']); ?>">
							</td>
													
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Audi Final:</label>
							</td>
							<td>
								<input type="text" name="fecha_audif" id="fecha_audif" value="<?php echo trim($_POST['datox4']); ?>">
							</td>
													
																	
						</tr>
						
						
						
						
						<tr>
							
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Juzgado:</label>
							</td>
																					
							<td>
												
								
								<select name="ljuz_audi" id="ljuz_audi">
												
										<option value="" selected="selected">Seleccionar Juzgado</option> 
															
										<?php	
										
											if ( !in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
											
												$campo_a_mostrar  = 'nombre';
												$campo_a_insertar = 'id';
												$nombre_tabla     = 'pa_juzgado';
												$campo_filtro     = 'id';
												$valor_filtro     = $_SESSION['id_juzgado'];
												$campo_a_ordenar  = 'nombre';
												$datosJUZ         = $funcion->cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
											}
											else{
											
												$campo_a_mostrar  = 'nombre';
												$campo_a_insertar = 'id';
												$nombre_tabla     = 'pa_juzgado';
												$campo_a_ordenar  = 'nombre';
												$datosJUZ         = $funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
											
											}
										
										?>
								</select>
							</td>
						
					
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Estado:</label>
							</td>
							
							<td>
												
								
								<select name="lestado_audi" id="lestado_audi">
												
										<option value="" selected="selected">Seleccionar Estado</option> 
															
										<?php	
										
												$campo_a_mostrar  = 'des';
												$campo_a_insertar = 'id';
												$nombre_tabla     = 'siepro_estado_audi';
												$campo_a_ordenar  = 'id';
												$datosESTADO      = $funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
									
										?>
								</select>
								
							</td>
											
						</tr>
						
						<!-- <tr>
											
							<td colspan="4">
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px">Descripcion Solicitud:</label><br>
								<textarea id="gc_ac_2b" name="gc_ac_2b" cols="50" rows="5"><?php //echo trim($_POST['datox4']); ?></textarea>
							</td>
										
						</tr> -->
						
					</table>
						
				</td>
				
			</tr>
			
			<?php
			
			//idaccion = 25 ---> 38////8 ID USUARIOS QUE PUEDEN VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS 
			//Y VER LA TABLA DE SOLICITUDES EDITABLES DE LA VISTA so_ticket.php DE LA CARPETA popupbox

			if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
			
			?>
			
			<tr>
				
												
				<td>
					
					<div class="contenedor_audi">
					<div class="mensaje"></div>						
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="taudi">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="9">
									<center>AUDIENCIAS</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>
								<th style="font-size:10px">RADICADO</th>																							
								<th style="font-size:10px">FECHA</th>
								<th style="font-size:10px">HORA INICIAL</th>
								<th style="font-size:10px">HORA FINAL</th>
								<th style="font-size:10px">DURACION</th>
								<th style="font-size:10px">ESTADO</th>
								<th style="font-size:10px">CAUSAL</th>
								<th style="font-size:10px">TIPO AUDI</th>
								
								<!-- <th style="font-size:10px">RESPUESTA<input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta </th>
								<th style="font-size:10px">ESTADO<input type="checkbox" id="checkanular" class="checkbox110" title="SI DESEA ANULAR LA SOLICITUD, ACTIVAR CASILLA ANULAR"/>Anular</th> -->
								
								
						
							</tr>
							
						
						</thead>
						
						<tbody> 
						
						<?php
			
							//echo "<option value=\"". $datosdelit_4CF[0] ."\">" . $datosdelit_4CF[1] . "</option>";
							
							$Cr=1; 
							
							$il = 0;
																				
							while($il < $long_4F - 1){
																				
								$datosdelit_4CF = explode("******",$datosdelit_4BF[$il]); ?>
								
								<tr>
									
									<?php if($datosdelit_4CF[6] == 1){ ?>
									
												<td style="font-size:10px; background-color:#FF0000" class='id'>
									<?php }
										  else{ ?>
												<td style="font-size:10px " class='id'>
									<?php } ?>
									
									<?php 
																													  
												echo $datosdelit_4CF[0];//id  
									?>
										
									</td>
																
									
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo $datosdelit_4CF[1];//radicado 
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable_audi' data-campo_audi='fecha' data-tipocampo_audi=2>  -->
									<td style="font-size:10px "> 
										<!-- <span> --> 
										<?php 
																													  
											echo $datosdelit_4CF[2];//fecha  
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable_audi' data-campo_audi='hora_ini' data-tipocampo_audi=5>  -->
									<td style="font-size:10px "> 
										<!-- <span>  -->
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[3]);//hora inicial  
										?>
										<!-- </span>  -->
									</td>
									
									<?php if($datosdelit_4CF[6] == 2 || $datosdelit_4CF[6] == 3 || $datosdelit_4CF[6] == 4 || $datosdelit_4CF[6] == 5){ ?>
											<td style="font-size:10px ">
									<?php }else{ ?>
											<td style="font-size:10px " class='editable_audi' data-campo_audi='hora_fini' data-tipocampo_audi=5> 
									<?php } ?>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[4];//hora final
										?>
										</span>
									</td>
									
									<!-- <td style="font-size:10px " class='editable_st' data-campo_st='fecha_respuesta' data-tipocampo_st=2> -->
									<td style="font-size:10px "> 
										<!-- <span> -->
										<?php 
																													  
											//echo "-";//duracion
											
											$cantidadhoras = $funcion->Cantidad_Horas_Audiencia($datosdelit_4CF[0]);
											
											echo $cantidadhoras;
										?>
										<!-- </span> -->
									</td>
									

									<?php if($datosdelit_4CF[6] == 2 || $datosdelit_4CF[6] == 3 || $datosdelit_4CF[6] == 4 || $datosdelit_4CF[6] == 5){ ?>
											<td style="font-size:10px ">
									<?php }else{ ?>
											<td style="font-size:10px " class='editable_audi' data-campo_audi='estado' data-tipocampo_audi=4 data-idlista_audi=1>
									<?php } ?>	
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[5]." ".$datosdelit_4CF[7].", FECHA:".$datosdelit_4CF[8];//estado
										?>
										</span>
										
									</td>
									
									<td style="font-size:10px ">
															
										<select name="<?php echo trim("lcausal".$Cr); ?>" id="<?php echo trim("lcausal".$Cr); ?>" title="<?php echo trim("lcausal".$Cr); ?>">
																		
																			
											<option value="" selected="selected">Seleccionar Causal</option>
																					
												
										</select>
										
										
										
									</td>
									
									<td style="font-size:10px "> 
										<!-- <span>  -->
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[9]);//tipo audiencia  
										?>
										<!-- </span>  -->
									</td>
									
									
									
									
								
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
					</div>
					
				</td>
											
			</tr> 
				
			<?php
			}
			else{
			
			?>
			
			
			
			<tr>
				
												
				<td>
					
					<div class="contenedor_audi">
					<div class="mensaje"></div>						
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="taudi">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="8">
									<center>AUDIENCIAS</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>
								<th style="font-size:10px">RADICADO</th>																							
								<th style="font-size:10px">FECHA</th>
								<th style="font-size:10px">HORA INICIAL</th>
								<th style="font-size:10px">HORA FINAL</th>
								<th style="font-size:10px">DURACION</th>
								<th style="font-size:10px">ESTADO</th>
								<th style="font-size:10px">CAUSAL</th>
								<th style="font-size:10px">TIPO AUDI</th>
								
								<!-- <th style="font-size:10px">RESPUESTA<input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta </th>
								<th style="font-size:10px">ESTADO<input type="checkbox" id="checkanular" class="checkbox110" title="SI DESEA ANULAR LA SOLICITUD, ACTIVAR CASILLA ANULAR"/>Anular</th> -->
								
								
						
							</tr>
							
						
						</thead>
						
						<tbody> 
						
						<?php
			
							//echo "<option value=\"". $datosdelit_4CF[0] ."\">" . $datosdelit_4CF[1] . "</option>";
							
							$Cr=1; 
							
							$il = 0;
																				
							while($il < $long_4F - 1){
																				
								$datosdelit_4CF = explode("******",$datosdelit_4BF[$il]); ?>
								
								<tr>
									
									<?php if($datosdelit_4CF[6] == 1){ ?>
									
												<td style="font-size:10px; background-color:#FF0000" class='id'>
									<?php }
										  else{ ?>
												<td style="font-size:10px " class='id'>
									<?php } ?>
									
									<?php 
																													  
												echo $datosdelit_4CF[0];//id  
									?>
										
									</td>
																
									
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo $datosdelit_4CF[1];//radicado 
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable_audi' data-campo_audi='fecha' data-tipocampo_audi=2>  -->
									<td style="font-size:10px "> 
										<!-- <span>  -->
										<?php 
																													  
											echo $datosdelit_4CF[2];//fecha  
										?>
										<!-- </span>  -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable_audi' data-campo_audi='hora_ini' data-tipocampo_audi=5> --> 
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[3]);//hora inicial  
										?>
										<!-- </span> -->
									</td>
									
									
									<?php if($datosdelit_4CF[6] == 2 || $datosdelit_4CF[6] == 3 || $datosdelit_4CF[6] == 4 || $datosdelit_4CF[6] == 5){ ?>
											<td style="font-size:10px ">
									<?php }else{ ?>
											<td style="font-size:10px " class='editable_audi' data-campo_audi='hora_fini' data-tipocampo_audi=5> 
									<?php } ?>
									
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[4];//hora final
										?>
										</span>
									</td>
									
									<!-- <td style="font-size:10px " class='editable_st' data-campo_st='fecha_respuesta' data-tipocampo_st=2> -->
									<td style="font-size:10px "> 
										<!-- <span> -->
										<?php 
																													  
											//echo "-";//duracion
											
											$cantidadhoras = $funcion->Cantidad_Horas_Audiencia($datosdelit_4CF[0]);
											
											echo $cantidadhoras;
										?>
										<!-- </span> -->
									</td>
									
									
									<?php if($datosdelit_4CF[6] == 2 || $datosdelit_4CF[6] == 3 || $datosdelit_4CF[6] == 4 || $datosdelit_4CF[6] == 5){ ?>
											<td style="font-size:10px ">
									<?php }else{ ?>
											<td style="font-size:10px " class='editable_audi' data-campo_audi='estado' data-tipocampo_audi=4 data-idlista_audi=1>
									<?php } ?>

										<span>
										<?php 
																													  
											echo $datosdelit_4CF[5]." ".$datosdelit_4CF[7].", FECHA:".$datosdelit_4CF[8];//estado
										?>
										</span>
										
									</td>
									
									<td style="font-size:10px ">
															
										<select name="<?php echo trim("lcausal".$Cr); ?>" id="<?php echo trim("lcausal".$Cr); ?>" title="<?php echo trim("lcausal".$Cr); ?>">
																		
																			
											<option value="" selected="selected">Seleccionar Causal</option>
																					
												
										</select>
										
										
										
									</td>
									
									
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
					</div>
					
				</td>
											
			</tr>
			
			
			<?php
			
			}
			
			?>								 
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


