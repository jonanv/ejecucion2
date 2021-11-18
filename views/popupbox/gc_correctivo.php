<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

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


$ip_plataforma = trim($_SESSION['ipplataforma']);


?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script type="text/javascript">

$('document').ready(function(){


		var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
		var ipservidor = ip_servidor;
		
		//var ipservidor = "190.217.24.24";

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
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S�'],
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
		
    	});
		
		
		
		
		$(".registrar_actividad").click(function(evento){
		
			
			var dataString = "";
			var validar    = 0;
	

			valor  = document.getElementById('gestion').value;
			//valor2 = document.getElementById('archivo').value;
	
	
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				
				//alert("Defina Gestion");
				document.getElementById('gestion').style.borderColor = '#FF0000';
				validar = 1;
				//return validar;
			}
			else{
				dataString += '&gestion='+$('#gestion').val();
			}
			
			
			if(validar == 1){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "DEFINA GESTION";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				return false;
				

			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					
					dataString += '&id_accion='+$('#id_accion').val();
					
					//dataString += '&archivo='+$('#archivo').val();
					
					//var archivo = document.getElementById("archivo");
					
					var inputFileImage = document.getElementById("archivo");
					var file = inputFileImage.files[0];
					
					//DE ESTA FORMA PARA PODER PASAR CAMPO FILE
					var data = new FormData();
					
					//data.append(COMO LO CAPTURA PHP,VALOR DATO);
					
					data.append('id_accion',$('#id_accion').val());
					data.append('gestion',$('#gestion').val());
					data.append('archivo',file);
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Registrar_Gestion',
						type:'POST', //Metodo que usaremos
						contentType:false, //Debe estar en false para que pase el objeto sin procesar
						//data:dataString, //Le pasamos el objeto que creamos con los archivos
						data:data, //Le pasamos el objeto que creamos con los archivos
						processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_acti').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_acti").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=Gestionar_Actividad";
							
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
	  
});

</script>


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

	
	<form name ="frm_GES" id="frm_GES"  method="post" enctype="multipart/form-data" action=""> 
	
	
		<!-- <input type="text" name="dato_file" id="dato_file" readonly="true"/> -->
	
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
								<center>GESTIONAR ACTIVIDAD <?php echo ", ID ACTIVIDAD: ".$id_accion; ?></center>
							</th>
						</tr>	
					
						
						<tr>
							<td colspan="2">
								
								
								
								<a class="registrar_actividad" href="javascript:void(0);" title="Aprobar"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR"/></a>
								
								
								
							</td>
						</tr> 
						
						
						<tr>
												
												
							<td colspan="2">
												
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px ">ID ACTIVIDAD:</label><br>
														
								<input type="text" name="id_accion" id="id_accion" class="required number" style="text-align:right; border-style:groove" value="<?php echo $id_accion; ?>" readonly="true"/>
														
										
							</td>
							
						</tr>
							
					
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">GESTION:</label><br>
								<textarea id="gestion" name="gestion" cols="80" rows="5"></textarea>
							</td>
										
						</tr>
						
						<tr>
							<td colspan="2">
								<label style="width:280px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Archivo (Soporte Gestion)</label><br><br>
								<input type="file" name="archivo" id="archivo" title="Archivo" size="19"/>
							</td>
											
						</tr>
						
						
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


