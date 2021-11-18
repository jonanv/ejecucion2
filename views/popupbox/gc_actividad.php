<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $funcion->get_fecha_actual_amd();

$id_accion = trim($_POST['id']);

//ACTIVIDADES, SIN FILTRO
if( trim($_POST['id_filtro']) == 0){
	
	$datosdelit_4F  = $funcion->get_datos_ACTIVIDADES($id_accion);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
	
}


//ACTIVIDADES SEGUN FILTRO
if( trim($_POST['id_filtro']) == 1){


	$dato_1 = trim($_POST['dato_1']);
	$dato_2 = trim($_POST['dato_2']);
	
				
	$datox1 = trim($_POST['datox1']);
	$datox2 = trim($_POST['datox2']);
	
	
	$datosdelit_4F  = $funcion->get_datos_REMATES_ACTIVOS_FILTRO($dato_1,$dato_2,$datox1,$datox2);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
			
	
	//echo "datox2: ".strlen($datox2);
	
	//echo "datox2: ".$datox2;
}	





?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script type="text/javascript">

$('document').ready(function(){



		//var ipservidor = "172.16.176.194";
		
		var ipservidor = "190.217.24.24";

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
		$("#fechasoli_ri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasoli_rf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		
		$("#fechaAC_INI").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechaAC_FINI").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		$("#fechaacti_i").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechaacti_f").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});



		$('#cancel').click( function(){
								  
        	$('#block').hide();
        	$('#popupbox').hide();
			
			$(".btn_limpiar_ra").click();
		
    	});
		
		
		
		
		$(".registrar_actividad").click(function(evento){
		
			
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
				d2RC2  = document.getElementById("t_raC").rows[r].cells[2].innerText;
				d3RC2  = document.getElementById("t_raC").rows[r].cells[3].innerText;
				d4RC2  = document.getElementById("t_raC").rows[r].cells[4].innerText;
				
				//if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoRC2 = d0RC2+"//////"+d1RC2+"//////"+d2RC2+"//////"+d3RC2+"//////"+d4RC2+"******"+idspermisoRC2;
						
						idspermiso_realC2 = 1;
						
						
						
				//}
				
				
				
					
				fRC2 = fRC2 + 1;
				
				
			}
			
			
			
			if(idspermiso_realC2 == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se Cuenta con Ningun Registro en la TABLA ACTIVIDADES";
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
						url:'index.php?controller=archivo&action=Registrar_Actividad',
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
							
							location.href="index.php?controller=archivo&action=Adicionar_Accion_2";
							
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
	
	
	
	$(".recargar_solicitud").click(function(){
								
		
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
		
			
		
	});
	
	
	
	$(".buscarxfiltro_solicitud").click(function(){
								
		
		
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
	
	
			dato_soli = 1;
			
			
			//FECHAS REMATE
			dato_1 = $('#fechasoli_ri').val();
		   	dato_2 = $('#fechasoli_rf').val();
			
			//ID REMATE
		   	datox1 = $('#id_rema').val();
			
			//RADICADO
			datox2 = $('#rad_rena').val();
			
			
			
			
			//location.href="index.php?controller=radicador&action=Busquedad_Filtro_Solicitud&dato_soli="+dato_soli+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5;
			
			
			$('#block').hide();
        	$('#popupbox').hide();
		
	
			params={};
			
			params.dato_soli = 1;
			
			params.dato_1 = dato_1;
			params.dato_2 = dato_2;
			
			params.datox1 = datox1;
			params.datox2 = datox2;
			
		
			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		
			
		}
		
	});
	
	
	
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
	
	
	var td,campo,valor,id;
	var tipocampo   = 0;
	var idlista     = 0;
	
	
	$(document).on("click",".cancelar",function(e)
	{
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
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
				
				$("#fecha_inicial").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				$("#fecha_final").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
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
					lista+="<option value='' selected='selected'>Seleccionar Responsable</option>";
						
						
					$("#listaC option").each(function(){
							
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
						
					td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
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
					url: "views/popupbox/gc_editinplace_acti.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
					
					
					//SU LLAMA DE NUEVO LA VENTANA EMERGENTE
					
					//PASAMOS VARIABLES PHP A JAVASCRIPT
					var id = "<?php echo $id_accion; ?>";
					
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
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
	
	/* FIN FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
	  
});

</script>

	<style>
	.contenedor_acti{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	<!-- th {padding:5px; background-color:#555;color:#fff} -->
	th {padding:5px; background-color:#CDE3F9;color:#000000}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable span{display:block;}
		.editable span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
			
		
	
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
								<center>ADICIONAR ACTIVIDAD <?php echo ", ID ACCION: ".$id_accion; ?></center>
							</th>
						</tr>	
					
						
						<tr>
							<td colspan="2">
								
								
								<!-- <a class="recargar_solicitud" href="javascript:void(0);" title="RECARGAR" style="float:right">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>
								</a>
								
								<a class="solicitud_pdf" href="javascript:void(0);" title="GENERAR PDF" style="float:right">
									<img src="views/images/archivo_3.png" width="25" height="25" title="GENERAR PDF"/>
								</a>  -->
								
								
								
								
								<img src="views/images/new3.jpg" width="25" height="25" title="ADICIONAR ACTIVIDAD" onClick="Adicionar_Actividad()"/>
								<a class="registrar_actividad" href="javascript:void(0);" title="Aprobar"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR ACTIVIDAD"/></a>
								
								
								
							</td>
						</tr> 
						
						
						<tr>
												
												
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px ">ID ACCION:</label><br>
														
								<input type="text" name="id_accion" id="id_accion" class="required number" style="text-align:right; border-style:groove" value="<?php echo $id_accion; ?>" readonly="true"/>
														
										
							</td>
							
						</tr>
							
						
		
						<tr>
								
				
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Inicial:</label><br>
								<input type="text" name="fechaAC_INI" id="fechaAC_INI" class="required" value="<?php echo trim($_POST['dato_1']); ?>">
							</td>
								
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Final:</label><br>
								<input type="text" name="fechaAC_FINI" id="fechaAC_FINI" class="required" value="<?php echo trim($_POST['dato_2']); ?>">
							</td>
								
					
						</tr>
						
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Descripcion Actividad:</label><br>
								<textarea id="gc_ac_2" name="gc_ac_2" cols="80" rows="5"></textarea>
							</td>
										
						</tr>
						
						<tr>
																					
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Responsable:</label><br>			
								<select name="listaC" id="listaC">
												
										<option value="" selected="selected">Seleccionar Responsable</option> 
															
										<?php	
										//LISTA RESPONSABLE
										$campo_a_mostrar  = 'empleado';
										$campo_a_insertar = 'id';
										$nombre_tabla     = 'pa_usuario';
										$campo_filtro     = 'nombre_usuario';
										$valor_filtro     = "NOT LIKE '%D%'";
										$campo_a_ordenar  = 'empleado';
										$datosRES         = $funcion->cargar_lista_con_filtro_LIKE($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										?>
								</select>
							</td>
											
						</tr>
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			
			
			<tr>
				
				<td colspan="2">
					<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px; text-align:center">TABLA ACTIVIDADES</label>
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
																<strong style="font-size:10px; color:#0066CC">ID ACCION</strong>
															</td>
															<td>
																<strong style="font-size:10px; color:#0066CC">FECHA INICIAL</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FECHA FINAL</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">DESCRIPCION</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">RESPONSABLE</strong>
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
			
			
			
			
			
			
			<!-- PARA BUSQUEDAD DE ACTIVIDADES -->
			
			
			
			<!-- <tr>
				
												
				<td>
											
					<table align="center">
					
					
						<tr>
							<td bgcolor="#CDE3F9" colspan="2">
								<center>FILTROS</center>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
								
								
								<a class="recargar_solicitud" href="javascript:void(0);" title="RECARGAR" style="float:right">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>
								</a>
								
								<a class="solicitud_pdf" href="javascript:void(0);" title="GENERAR PDF" style="float:right">
									<img src="views/images/archivo_3.png" width="25" height="25" title="GENERAR PDF"/>
								</a> 
								
								<a class="buscarxfiltro_solicitud" href="javascript:void(0);" title="CONSULTAR SOLICITUDES" style="float:right">
									<img src="views/images/lupa.png" width="25" height="25" title="CONSULTAR SOLICITUDES"/>
								</a>
								
								
							</td>
						</tr> 
						
						
						<tr>
												
												
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px ">ID:</label><br>
														
								<input type="text" name="id_rema" id="id_rema" class="required number" style="text-align:right; border-style:groove" value="<?php //echo trim($_POST['datox1']); ?>"/>
														
										
							</td>
							
						</tr>
							
						<tr>
								
				
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Registro Inicial:</label><br>
								<input type="text" name="fechaacti_i" id="fechaacti_i" class="required" value="<?php //echo trim($_POST['dato_3']); ?>">
							</td>
							
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Registro Final:</label><br>
								<input type="text" name="fechaacti_f" id="fechaacti_f" class="required" value="<?php //echo trim($_POST['dato_4']); ?>">
							</td>
								
							
					
						</tr>
						
						<tr>
								
				
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Inicial:</label><br>
								<input type="text" name="fechasoli_ri" id="fechasoli_ri" class="required" value="<?php //echo trim($_POST['dato_1']); ?>">
							</td>
								
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Final:</label><br>
								<input type="text" name="fechasoli_rf" id="fechasoli_rf" class="required" value="<?php //echo trim($_POST['dato_2']); ?>">
							</td>
								
					
						</tr>
						
						
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			<tr>
				<td colspan="2">
					
					<div class="mensage_soli"></div>  
				</td>
							
			</tr> -->
			
			
			<tr>
				
												
				<td>
					
					<div class="contenedor_acti">
					<div class="mensaje"></div>						
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="tsoli">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="13">
									<center>ACTIVIDADES</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>																						
								<th style="font-size:10px">FECHA INICIAL</th>
								<th style="font-size:10px">FECHA FINAL</th>
								<th style="font-size:10px">DESCRIPCION</th>
								<th style="font-size:10px">RESPONSABLE</th>
								<th style="font-size:10px">FECHA REG</th>
								<th style="font-size:10px">HORA REG</th>
								<th style="font-size:10px">ESTADO</th>
								<th style="font-size:10px">GESTION</th>
								<th style="font-size:10px">FECHA GESTION</th>
								<th style="font-size:10px">HORA GESTION</th>
								<th style="font-size:10px">SOPORTE</th>
								
								
								
								
								<!-- <th style="font-size:10px">CHECK</th>
								
								
								<th>
											
									<input type="checkbox" id="checkTodos" />Marcar/Desmarcar 
								</th>
											
								
								<th>
												
									<a class="aprobarsoli" href="javascript:void(0);" title="Aprobar"><img src="views/images/save.png" width="25" height="25" title="Aprobar"/></a>
								</th>
								
								<th>
												
									<a class="desaprobarsoli" href="javascript:void(0);" title="Des-Aprobar"><img src="views/images/apply.png" width="25" height="25" title="Des-Aprobar"/></a>
								</th> -->
						
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
									
									<td style="font-size:10px " class='id'>
										<?php 
																													  
											echo $datosdelit_4CF[0];//idrema  
										?>
									</td>
																
									<td style="font-size:10px " class='editable' data-campo='fecha_inicial' data-tipocampo=2>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[2];//radicado  
										?>
										</span>
									</td>
									
									<td style="font-size:10px " class='editable' data-campo='fecha_final' data-tipocampo=2>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[3];//tipo  
										?>
										</span>
									</td>
									
									<td style="font-size:10px " class='editable' data-campo='des' data-tipocampo=3>
										<span>
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[4]);//fecha  
										?>
										</span>
									</td>
									
									<td style="font-size:10px " class='editable' data-campo='idrespobsable' data-tipocampo=4 data-idlista=1>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[5];//usuario que registra  
										?>
										</span>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[6];//usuario que registra  
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[7];//usuario que registra  
										?>
									</td>
									
									
									
									
									
									
									<?php $d9M = $datosdelit_4CF[8]; 
									
										if($d9M == 0){ 
					
											if( $fechaactual > $datosdelit_4CF[3] && $d9M == 0 ){ ?>
											
												<td style="font-size:10px " class='editable' data-campo='estado' data-tipocampo=4 data-idlista=2>
													<span>
													<?php echo "EXPIRA TIEMPO PARA REALIZAR ACTIVIDAD"; ?>
													
													<img src="views/images/expiro.png" width="20" height="20" title="EXPIRA TIEMPO PARA REALIZAR ACTIVIDAD"/>
													</span>
													
												</td>
									
									<?php
											}
											else{?>
									
												<td style="font-size:10px " class='editable' data-campo='estado' data-tipocampo=4 data-idlista=2>
													<span>
													<?php echo "EN PROCESO"; ?>
													</span>
												</td>
											
											
									<?php   } ?>	
									
											
									<?php
											
										}
										else{ ?>
										
											<td style="font-size:10px " class='editable' data-campo='estado' data-tipocampo=4 data-idlista=2>
													<span>
													<?php echo "TERMINADA"; ?>
													</span>
											</td>			
											
												
									 <?php } ?>
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[9]);//GESTION
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[11]);//FECHA GESTION
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[12]);//HORA GESTION
										?>
									</td>
									
									<?php if( strlen($datosdelit_4CF[10]) >= 1 ){?>
									<td>
										<a href="javascript:void(0);" title="Desacargar Archivo" data-ruta="<?php echo $datosdelit_4CF[10];?>" style="color:#0000FF" onclick="document.location='<?php echo $datosdelit_4CF[10];?>'"><img src="views/images/archivo_3.png" width="35" height="35" title="GENERAR"/></a>
									</td>
										
									<?php } else{ ?>
									<td>-</td>
									<?php } ?>
									
									
									<!-- <td>
									
										<a href='#' class='generar_pdf' data-id="<?php //echo $datosdelit_4CF[0];?>"><img src="views/images/archivo_3.png" width="35" height="35" title="GENERAR AVISO DE REMATE"/></a>
										
									</td>
									
									<td>
									
										<a href='#' class='generar_obs' data-idrad="<?php //echo $datosdelit_4CF[5];?>"><img src="views/images/ipdf3.png" width="35" height="35" title="GENERAR OBSERVACIONES DEL PROCESO"/></a>
										
									</td> -->
									
									
									
									<!-- <td>
										<input type="checkbox" name="<?php //echo "chk".$Cr;?>" id="<?php //echo "chk".$Cr;?>" value="<?php //echo "chk".$Cr;?>" title="<?php //echo "chk".$Cr;?>"/>
									</td>	 -->
									
									
									
								
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
					</div>
					
				</td>
											
			</tr> 
				
											 
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


