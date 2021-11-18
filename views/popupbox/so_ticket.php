<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $funcion->get_fecha_actual_amd();

$idUsuario   =  $_SESSION['idUsuario'];

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
	
	$id_filtro = $_SESSION['idUsuario'];
}

//echo $id_filtro;

//SOLICITUDES, SIN FILTRO
if( trim($_POST['id_filtro']) == 0){
	
	$datosdelit_4F  = $funcion->get_datos_SOLICITUDES($id_filtro);
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
	$datox7 = trim($_POST['datox7']);
	$datox8 = trim($_POST['datox8']);
	
	
	$datosdelit_4F  = $funcion->get_datos_SOLICITUDES_FILTRO($id_filtro,$datox1,$datox2,$datox3,$datox4,$datox5,$datox6,$datox7,$datox8);
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
		$("#fechasri_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasri_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		
		


		$('#cancel').click( function(){
		
			//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
			//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
			$(document).off('click');
								  
        	$('#block').hide();
        	$('#popupbox').hide();
			
	
    	});
		
		
		
		
		$(".registrar_solicitud").click(function(evento){
		
			
			var dataString        = "";
			
			var idspermisoRC2     = "";
			var idspermiso_realC2 = 0;
			
			
			var fRC2 = 1;
			
			var d0RC2;
			

			var cantidad_filas_FRC2;
			var TABLA_FRC2 = document.getElementById('t_raC');
			
			cantidad_filas_FRC2 = TABLA_FRC2.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FRC2; r++){
				
				d0RC2  = document.getElementById("t_raC").rows[r].cells[0].innerText;
				d1RC2  = document.getElementById("t_raC").rows[r].cells[1].innerText;
				
				
				//if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoRC2 = d0RC2+"//////"+d1RC2+"******"+idspermisoRC2;
						
						idspermiso_realC2 = 1;
						
						
						
				//}
				
				
				
					
				fRC2 = fRC2 + 1;
				
				
			}
			
			
			
			if(idspermiso_realC2 == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se Cuenta con Ningun Registro en la TABLA SOLICITUDES";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_acti').val('');
					$('#datos_acti').val(idspermisoRC2);
					
					dataString += '&datospartes='+$('#datos_acti').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Registrar_Solicitud',
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
							
							$(".mensage_acti").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
							//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
							$(document).off('click');
							
							params={};
							//params.id        = id;
							params.id_filtro = 0;
							
							
							
							//alert(params.eveasunto);
							$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
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
				

				window.open("http://"+ipservidor+"/ejecucion/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
		});
		
		$('.generar_obs').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var idrad = $(this).attr('data-idrad');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/HISTORIAL_PROCESO.php?id="+idrad);
				
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
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
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
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
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
	
	var td_st,campo_st,valor_st,id_st,$rc_st,row_st,col_st,nuevovalor_st;
	var tipocampo_st     = 0;
	var idlista_st       = 0;
	
	var procesar_st      = 0;
    var solorespuesta_st = 0;
	var anular_st        = 0;
	
	var idX,fechaX,horaX,desX,userX,fechaRX,horaRX,respuestaX,estadoX;
	
	
	$(document).on("click",".cancelar_st",function(e)
	{
			e.preventDefault();
			td_st.html("<span>"+valor_st+"</span>");
			$("td:not(.id)").addClass("editable_st");
						
			
	});
		

	$(document).on("click","td.editable_st span",function(e)
	{
	
	
			e.preventDefault();
			$("td:not(.id)").removeClass("editable_st");
			td_st        = $(this).closest("td");
			campo_st     = $(this).closest("td").data("campo_st");
			tipocampo_st = $(this).closest("td").data("tipocampo_st");
			idlista_st   = $(this).closest("td").data("idlista_st");
			valor_st     = $(this).text().trim();//PARA LIMPIAR LOS ESPACIOS DE IZQUIERDA Y DERECHA
			id_st        = $(this).closest("tr").find(".id").text();
			
			//alert(tipocampo);
			//alert(campo);
			//alert(valor);
			//alert(id);
			
			 //SE CAPTURA FILA Y COLUMNA
			 $rc_st  = $(this).parent("td");     
			 //SE SUMA DOS PARA QU DE LA FILA REAL, YA QUE CUENTA DESDE QUE SE ARMA LA INFORMACION CON LA CONSULRA RETORNADA EN datosdelit_4BF 
			 row_st = $rc_st.parent().parent().children().index($rc_st.parent()) + 2;	
			 col_st = $rc_st.parent().children().index($rc_st);
			 
			 //CAPTURA COLUMNA RESPUESTA CON SU DATO, SEGUN FILA Y COLUMNA, PARA VALIDAR,
			 //SI AL ESCOGER ESTADO TERMINADA, SE DEBE DEFINIR UNA RESPUESTA
			 idX         = document.getElementById("tsoli").rows[row_st].cells[0].innerText;
			 fechaX      = document.getElementById("tsoli").rows[row_st].cells[1].innerText;
			 horaX       = document.getElementById("tsoli").rows[row_st].cells[2].innerText;
			 desX        = document.getElementById("tsoli").rows[row_st].cells[3].innerText;
			 userX       = document.getElementById("tsoli").rows[row_st].cells[4].innerText;
			 fechaRX     = document.getElementById("tsoli").rows[row_st].cells[5].innerText;
			 horaRX      = document.getElementById("tsoli").rows[row_st].cells[6].innerText;
			 respuestaX  = document.getElementById("tsoli").rows[row_st].cells[7].innerText;
			 estadoX     = document.getElementById("tsoli").rows[row_st].cells[8].innerText;
		
			 //alert('FILA: '+row + ' COLUMNA: ' + col); 
			 //alert('VALOR ID: '+idX+' VALOR FECHA: '+fechaX+' VALOR HORA: '+horaX+' VALOR DESCRIP: '+desX+ ' VALOR USUARIO: '+userX+' VALOR FECHA_R: '+fechaRX+' VALOR HORA_R: '+horaRX+' VALOR RESPUESTA: '+respuestaX+' VALOR ESTADO: '+estadoX);
  
			//CAMPO DE TEXTO
			if(tipocampo_st == 1){
			
				td_st.text("").html("<input type='text' name='"+campo_st+"' value='"+valor_st+"'><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO FECHA
			if(tipocampo_st == 2){
				
				td_st.text("").html("<input type='text' id='"+campo_st+"' name='"+campo_st+"' value='"+valor_st+"' readonly='true'><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
				
				$("#fecha_respuesta").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				<!-- $("#fecha_final").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	}); -->
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_st == 3){
			
				
				td_st.text("").html("<textarea name='"+campo_st+"' cols='45' rows='5'>"+valor_st+"</textarea><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
			
			}
			
			
			
			//CAMPO DE SELECT 
			if(tipocampo_st == 4){
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				//var lista = "";
				
				//RESPONSABLE	
				/*if(idlista == 1){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Responsable</option>";
						
						
					$("#listaC option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}*/
				
				
				//ESTADO
				if(idlista_st == 2){
						
					td_st.text("").html("<select name='"+campo_st+"' id='"+campo_st+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option><option value='3'>ANULADA</option></select><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
				}
				
				
			}
			
			
	});
	
	
	$(document).on("click",".guardar_st",function(e)
		{
		
			
			$(".mensaje").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO Y FECHAS
			if(tipocampo_st == 1 || tipocampo_st == 2){
				nuevovalor_st=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_st == 3){
				nuevovalor_st=$(this).closest("td").find("textarea").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo_st == 4){
				nuevovalor_st=$(this).closest("td").find(":selected").val();
			}
			
			
			//alert("campo: "+campo_st+" - "+"nuevovalor: "+nuevovalor_st+" - "+"tipocampo: "+tipocampo_st);
			
			
				
			if(nuevovalor_st.trim()!=""){
			
				/*alert(tipocampo);
				alert(campo);
				alert(valor);
				alert(nuevovalor);
				alert(id);*/
				
				
				//SE REALIZA ESTA COMPARACION, YA QUE EL USUARIO
				//PUEDE SELECCIONAR ESTADO TERMINADA Y QUE EL SISTEMA PIDA
				//QUE SE DEFINA RESPUESTA
				if(campo_st == "estado" && nuevovalor_st == 1){
				
			
					//$(".mensaje").html("<p class='ko'>Defina Respuesta</p>");
				
					$('.mensaje').html("<p class='ko'>Defina Respuesta</p>");//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensaje').show('slow');
					
					setTimeout(function() {
						$(".mensaje").fadeOut(2000);
					},2000);
					
					
					
					
				}
				else{
				
					procesar_st = 1;
					
					
				}
				
				if(campo_st == "estado" && nuevovalor_st == 3){
				
			
					if($("#checkanular").is(':checked')) { 
										
						<!-- NO SE EJECUTA NADA -->
					}
					else{
				
						$('.mensaje').html("<p class='ko'>Defina en Respuesta, el por que de la Anulacion, y ACTIVAR CASILLA ANULAR</p>");//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensaje').show('slow');
						
						setTimeout(function() {
							$(".mensaje").fadeOut(2000);
						},2000);
						
						procesar_st = 0;
					
					}	
					
					
				}
				
			
				if(campo_st == "respuesta"){
				
					//alert("ENTRE...");
					
					
					if($("#checkRespuesta").is(':checked')) { 
										
						solorespuesta_st = 1;
					}
					
					if($("#checkanular").is(':checked')) { 
										
						anular_st = 1;
					}
					
					
					
					procesar_st = 1;
					
					
				
				}
				
				//alert("solorespuesta_st: "+solorespuesta_st+" anular_st: "+anular_st);
				
				
				if(procesar_st == 1){
				
					//contador_st = 0;
				
					$.ajax({
					
						type: "POST",
						url: "views/popupbox/so_editinplace_soli.php",
						//data: { campo: campo_st, valor: nuevovalor_st, id:id_st, solorespuesta:solorespuesta_st, anular:anular_st }
						
						data: { campo: campo_st, valor: nuevovalor_st, id:id_st, solorespuesta:solorespuesta_st, anular:anular_st, idX:idX,fechaX:fechaX,horaX:horaX,desX:desX,userX:userX,fechaRX:fechaRX,horaRX:horaRX,respuestaX:respuestaX,estadoX:estadoX }
						
					})
					.done(function( msg ) {
					
						$(".mensaje").html(msg);
						td_st.html("<span>"+nuevovalor_st+"</span>");
						$("td:not(.id)").addClass("editable_st");
						
						
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
							
					
							$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
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
	
	
	
	$(".buscarxfiltro_SOLICITUD").click(function(){
								
		
		
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
			$('#block').hide();
        	$('#popupbox').hide();
			
		    datox1 = $('#idfiltros').val();
			datox2 = $('#fechasri_m').val();
			datox3 = $('#fechasrf_m').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			
		    
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
			params.datox7    = datox7;
			params.datox8    = datox8;
			
	
			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
			

			
		}
		
	});
	
	$(".recargar_SOLICITUD").click(function(){
	
		
		//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
		//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
		$(document).off('click');
		
		params={};
		//params.id      = id;
		params.id_filtro = 0;
							
							
							
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		
							
	
	});
	
	
	$(".generar_excel").click(function(){
	
	
	
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 7000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro = "<?php echo $id_filtro; ?>";
			
			//alert(id_filtro);
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltros').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&id_filtro="+id_filtro;
			
		
		}
		
	
	});
	
	
	$(".generar_historial").click(function(){
	
	
	
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 8000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro = "<?php echo $id_filtro; ?>";
			
			//alert(id_filtro);
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltros').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&id_filtro="+id_filtro;
			
		
		}
		
	
	});
	
	
	 
	  
});

</script>

	<style>
	.contenedor_acti_st{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	<!-- th {padding:5px; background-color:#555;color:#fff} -->
	th {padding:5px; background-color:#CDE3F9;color:#000000}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable_st span{display:block;}
		.editable_st span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar_st{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar_st{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
			
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
	
	
		<input type="hidden" name="datos_acti" id="datos_acti" readonly="true"/>
	
		<div class="buttonsBar">
		
			<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
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
								<center>SOLICITUD SOPORTE TECNICO</center>
							</th>
						</tr>	
					
						<tr>
							<td colspan="2">
								
								
								<img src="views/images/soporte_5.png" width="100" height="100" style="float:right"/>
								
							</td>
						</tr> 
						
						<tr>
							<td colspan="2">
								
								
								<!-- <a class="recargar_solicitud" href="javascript:void(0);" title="RECARGAR" style="float:right">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>
								</a>
								
								<a class="solicitud_pdf" href="javascript:void(0);" title="GENERAR PDF" style="float:right">
									<img src="views/images/archivo_3.png" width="25" height="25" title="GENERAR PDF"/>
								</a>  -->
								
								
								
								
								<img src="views/images/new3.jpg" width="25" height="25" title="ADICIONAR SOLICITUD" onClick="Adicionar_Solicitud()"/>
								<a class="registrar_solicitud" href="javascript:void(0);"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR SOLICITUD"/></a>
								
								
								
								
							</td>
						</tr> 
						
						
						
						
						<tr>
																					
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Usuario:</label><br>			
								<select name="listaC" id="listaC">
												
										<option value="" selected="selected">Seleccionar Usuario</option> 
															
										<?php	
										//LISTA RESPONSABLE
										
										if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
										
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
										
										}
										
										?>
								</select>
							</td>
											
						</tr>
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Descripcion Solicitud:</label><br>
								<textarea id="gc_ac_2" name="gc_ac_2" cols="80" rows="5"></textarea>
							</td>
										
						</tr>
						
						
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			
		
			
			<tr>
				
				
				<td colspan="2">
					<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px">TABLA SOLICITUDES</label>
				</td>
				
				
										
			</tr>
										
							
			<tr>
							
				<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_raC"> 
													<table id="t_raC" border="1"> 
														<tr>
															
															
															
															<td>
																<strong style="font-size:10px; color:#0066CC">USUARIO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">DESCRIPCION</strong>
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
								<center>FILTRO SOLICITUDES</center>
							</th>
							
						</tr>
						
						
						<tr>
						
							<td colspan="4">
							
								<a class="buscarxfiltro_SOLICITUD" href="javascript:void(0);" title="BUSCAR SOLICITUD" style="color:#0066CC">
									<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR SOLICITUD"/>BUSCAR SOLICITUD 
								</a>
								
								<a class="recargar_SOLICITUD" href="javascript:void(0);" title="RECARGAR" style="color:#0066CC">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>RECARGAR
								</a>
								
								<a class="generar_excel" href="javascript:void(0);" title="GENERAR EXCEL" style="color:#0066CC;">
									<img src="views/images/excel_1.jpg" width="25" height="25" title="GENERAR EXCEL"/>GENERAR EXCEL
								</a> 
								
								<a class="generar_historial" href="javascript:void(0);" title="ENERAR HISTORAL SOLICITUD" style="color:#0066CC;">
									<img src="views/images/exceltitulos.png" width="25" height="25" title="ENERAR HISTORAL SOLICITUD"/>GENERAR HISTORAL SOLICITUD
								</a> 
														
								
							</td>
											
						</tr>
						
						
	
						<tr>
						
							<td>
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">ID:</label><br>
							</td>
										
							<td colspan="3">
								<input type="text" name="idfiltros" id="idfiltros" style="color:#FF0000; font-size:12px" value="<?php echo trim($_POST['datox1']); ?>"/>
							</td>
						
			
						</tr>
						
						<tr>
												
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
							</td>
							<td>
								<input type="text" name="fechasri_m" id="fechasri_m" value="<?php echo trim($_POST['datox2']); ?>">
							</td>
													
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
							</td>
							<td>
								<input type="text" name="fechasrf_m" id="fechasrf_m" value="<?php echo trim($_POST['datox3']); ?>">
							</td>
													
																	
						</tr>
						
						<tr>
												
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Respuesta Inicial:</label>
							</td>
							
							<td>
								<input type="text" name="fechasri_m" id="fechasri_r" value="<?php echo trim($_POST['datox5']); ?>">
							</td>
													
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Respuesta Final:</label>
							</td>
							
							<td>
								<input type="text" name="fechasrf_m" id="fechasrf_r" value="<?php echo trim($_POST['datox6']); ?>">
							</td>
													
																	
						</tr>
						
						
						
						<tr>
																					
							<td colspan="4">
												
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Usuario:</label><br>			
								<select name="listasr2" id="listasr2">
												
										<option value="" selected="selected">Seleccionar Usuario</option> 
															
										<?php	
										//LISTA RESPONSABLE
										
										if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
										
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
										
										}
										
										?>
								</select>
							</td>
						
						</tr>
						
						<tr>
							
							<td colspan="4">
												
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Estado:</label><br>			
								<select name="listasr3" id="listasr3">
												
										<option value="" selected="selected">Seleccionar Estado</option> 
										<option value="0">EN PROCESO</option> 
										<option value="1">TERMINADA</option>
										<option value="2">ANULADA</option> 
															
										
								</select>
							</td>
											
						</tr>
						
						<tr>
											
							<td colspan="4">
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px">Descripcion Solicitud:</label><br>
								<textarea id="gc_ac_2b" name="gc_ac_2b" cols="50" rows="5"><?php echo trim($_POST['datox4']); ?></textarea>
							</td>
										
						</tr>
						
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
					
					<div class="contenedor_acti_st">
					<div class="mensaje"></div>						
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="tsoli">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="11">
									<center>SOLICITUDES</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>																						
								<th style="font-size:10px">FECHA</th>
								<th style="font-size:10px">HORA</th>
								<th style="font-size:10px">DESCRIPCION</th>
								<th style="font-size:10px">USUARIO</th>
								<th style="font-size:10px">FECHA RESPUESTA</th>
								<th style="font-size:10px">HORA RESPUESTA</th>
								<th style="font-size:10px">RESPUESTA<input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta </th>
								<!-- <th style="font-size:10px">MODIFICAR RESPUESTA</th> -->
								<th style="font-size:10px">ESTADO<input type="checkbox" id="checkanular" class="checkbox110" title="SI DESEA ANULAR LA SOLICITUD, ACTIVAR CASILLA ANULAR"/>Anular</th>
								
								
						
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
									
									<?php if($datosdelit_4CF[8] == 0){ ?>
									
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
																													  
											echo $datosdelit_4CF[1];//fecha 
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable' data-campo='fecha_final' data-tipocampo=2> -->
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo $datosdelit_4CF[2];//hora  
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable' data-campo='des' data-tipocampo=3> -->
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[3]);//des  
										?>
										<!-- </span> -->
									</td>
									
									<!-- <td style="font-size:10px " class='editable' data-campo='idrespobsable' data-tipocampo=4 data-idlista=1> -->
									<td style="font-size:10px ">
										<!-- <span> -->
										<?php 
																													  
											echo $datosdelit_4CF[4];//usuario que solicita
										?>
										<!-- </span> -->
									</td>
									
									<td style="font-size:10px " class='editable_st' data-campo_st='fecha_respuesta' data-tipocampo_st=2>
									<!-- <td style="font-size:10px "> --> 
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[5];//fecha respuesta
										?>
										</span>
									</td>
									
									<td style="font-size:10px ">
									
										<?php 
																													  
											echo $datosdelit_4CF[6];//hora respuesta
										?>
										
									</td>
									
									
									<td id="respuesta" style="font-size:10px " class='editable_st' data-campo_st='respuesta' data-tipocampo_st=3>
										<span>
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[7]);//respuesta
										?>
										</span>
										<!-- <input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta  -->
									</td>
									
									<!-- <td style="font-size:10px ">
										
										<input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>
										
									</td>  -->
									
									
									
									<td style="font-size:10px " class='editable_st' data-campo_st='estado' data-tipocampo_st=4 data-idlista_st=2>
										<span>
										<?php 
										
											//echo $datosdelit_4CF[8];//estado
											
											if($datosdelit_4CF[8] == 0){
											
												echo "EN PROCESO";
											}
											if($datosdelit_4CF[8] == 1){
											
												echo "TERMINADA";
											}
											if($datosdelit_4CF[8] == 2){
											
												echo "ANULADA";
											}
										?>
										</span>
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
					
									
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" id="tsoli">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="11">
									<center>SOLICITUDES</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>																						
								<th style="font-size:10px">FECHA</th>
								<th style="font-size:10px">HORA</th>
								<th style="font-size:10px">DESCRIPCION</th>
								<th style="font-size:10px">USUARIO</th>
								<th style="font-size:10px">FECHA RESPUESTA</th>
								<th style="font-size:10px">HORA RESPUESTA</th>
								<th style="font-size:10px">RESPUESTA</th>
								<th style="font-size:10px">ESTADO</th>
								
								
						
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
									
									<?php if($datosdelit_4CF[8] == 0){ ?>
									
												<td style="font-size:10px; background-color:#FF0000" class='id'>
									<?php }
										  else{ ?>
												<td style="font-size:10px " class='id'>
									<?php } ?>
									
									<?php 
																													  
												echo $datosdelit_4CF[0];//id  
									?>
									</td>
																
									
									<td style="font-size:10px">
										
										<?php 
																													  
											echo $datosdelit_4CF[1];//fecha 
										?>
										
									</td>
									
									<td style="font-size:10px">
										
										<?php 
																													  
											echo $datosdelit_4CF[2];//hora  
										?>
										
									</td>
									
									<td style="font-size:10px">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[3]);//des  
										?>
										
									</td>
									
									<td style="font-size:10px">
										<?php 
																													  
											echo $datosdelit_4CF[4];//usuario que solicita
										?>
										
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[5];//fecha respuesta
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[6];//hora respuesta
										?>
									</td>
									
									
									<td style="font-size:10px">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[7]);//respuesta
										?>
										
									</td>
									
									
									<td style="font-size:10px">
										<?php 
										
											//echo $datosdelit_4CF[8];//estado
											
											if($datosdelit_4CF[8] == 0){
											
												echo "EN PROCESO";
											}
											if($datosdelit_4CF[8] == 1){
											
												echo "TERMINADA";
											}
											if($datosdelit_4CF[8] == 2){
											
												echo "ANULADA";
											}
										?>
										
									</td>
									
									
								
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
					
					
				</td>
											
			</tr>
			
			
			<?php
			
			}
			
			?>								 
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


