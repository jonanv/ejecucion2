
<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_filtrar_ubicacion.php
	$datosJ_1      = explode("******",trim($_GET['datosJ']));
	
	$Jid_juzgado_3 = trim($datosJ_1[0]);//nombre juzgado
	$Jid_juzgado_4 = trim($datosJ_1[1]);//id juzgado
	$Jid_juzgado_5 = trim($datosJ_1[2]);//id juzgado justicia xxi
	$Jid_juzgado_6 = trim($datosJ_1[3]);//dias para realizar tarea puesta 
	
	//echo $Jid_juzgado_6;
	
	
	//REGISTRAR FOLIO(S)
	if(trim($datosJ_1[4]) == 1){

		echo '<script languaje="JavaScript"> 
									
											
				var idradi = "'.$datosJ_1[5].'";	
				var radi   = "'.$datosJ_1[6].'";	
				
				
				alert("1-PROCESO SE REALIZA CORRECTAMENTE, ID RADICADO:  "+idradi+" RADICADO: "+radi);
											
								
			</script>';
	
	}
	
	
	
	//------------ESTAS VARIABLES MANEJAN LA RECARGA DE LA PAGINA--------
	//Y SE QUEDENE EN ELLA, AL DAR CLIC EN EL BOTON RECGARGAR
	$J2id_juzgado  = $_SESSION['id_juzgado'];
	$J2tipousuario = $_SESSION['tipousuario'];
	
	
	$Jid_juzgado_1x  = $modelo->get_despacho($J2id_juzgado);
	$Jid_juzgado_2x  = $Jid_juzgado_1x->fetch();
	$Jid_juzgado_3x	= trim($Jid_juzgado_2x[nombre]);
	$Jid_juzgado_4x	= trim($Jid_juzgado_2x[numero_juzgado]);
	$Jid_juzgado_5x	= trim($Jid_juzgado_2x[idjxxi]);
	$Jid_juzgado_6x	= trim($Jid_juzgado_2x[dias]);
	
	//echo $J2tipousuario;
	//echo $J2id_juzgado;
	
	//---------------------------------------------------------------------
	
	
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	$id_juzgado_user_devo = $_SESSION['id_juzgado'];
	
	$iddepartamento  =  $_SESSION['iddepartamento'];
	$idmunicipio     =  $_SESSION['idmunicipio'];
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//LISTA BASE DE DATOS LOCAL
	
	
	$nombrelista_2  = 'pa_usuario';
	$campoordenar_2 = 'empleado';
	$filtro_2       = "WHERE id_juzgado = ".$J2id_juzgado;
	$formaordenar_2 = '';
	$datosSERVI_2   = $modelo->get_lista_filtro($nombrelista_2,$campoordenar_2,$filtro_2,$formaordenar_2);
	
	
	
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	//$id_juzgado_user = $_SESSION['id_juzgado'];
	
	//echo $id_juzgado_user;
	
	
	
	//******************ID USUARIOS, QUE ENTRAN A LA VISTA DE A DESPACHO JUZGADOS Y SOLO VEN SUS TAREAS***************
	$campos              = 'usuario';
	$nombrelista         = 'pa_usuario_acciones';
	$idaccion	         = '33';
	$campoordenar        = 'id';
	$datosJUZDES1        = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$datosJUZDES2        = $datosJUZDES1->fetch();
	$datosJUZDES3	     = explode("////",$datosJUZDES2[usuario]);
	
	$datosJUZDES         = 0;
	
	if ( in_array($_SESSION['idUsuario'],$datosJUZDES3,true) ){
	
		$datosJUZDES = 1;
	}	
	
	//******************FIN ID USUARIOS, QUE ENTRAN A LA VISTA DE A DESPACHO JUZGADOS Y SOLO VEN SUS TAREAS***************
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	
	//ID USUARIOS, QUE ENTRAN A LA VISTA DE A DESPACHO JUZGADOS Y SOLO VEN SUS TAREAS
	if($datosJUZDES == 1){
	
	
		if($opcion == 1){
		
			
			$datosACCION_1 = $modelo->listar_procesos_despacho_filtro_2($Jid_juzgado_4x);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->listar_procesos_despacho_filtro_2($Jid_juzgado_4x);
			
			$fc = 0;
			while($fila_cant = $datosACCION->fetch()){		
			
				$fc = $fc + 1; 
			
			}
			
			$cantregis = $fc;
			
			//*************************************************************************************
	
		}
		else{
		
		
			$datosACCION_1 = $modelo->listar_procesos_despacho_2($Jid_juzgado_4);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->listar_procesos_despacho_2($Jid_juzgado_4);
			
			$fc = 0;
			while($fila_cant = $datosACCION->fetch()){		
			
				$fc = $fc + 1; 
			
			}
			
			$cantregis = $fc;
			
			//*************************************************************************************
		
		}
		
	
	}
	else{
	
		if($opcion == 1){
		
			
			$datosACCION_1 = $modelo->listar_procesos_despacho_filtro($Jid_juzgado_4x);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->listar_procesos_despacho_filtro($Jid_juzgado_4x);
			
			$fc = 0;
			while($fila_cant = $datosACCION->fetch()){		
			
				$fc = $fc + 1; 
			
			}
			
			$cantregis = $fc;
			
			//*************************************************************************************
	
		}
		else{
		
		
			$datosACCION_1 = $modelo->listar_procesos_despacho($Jid_juzgado_4);
			
			//*********************CANTIDAD REGISTROS*****************************************
		
			$datosACCION = $modelo->listar_procesos_despacho($Jid_juzgado_4);
			
			$fc = 0;
			while($fila_cant = $datosACCION->fetch()){		
			
				$fc = $fc + 1; 
			
			}
			
			$cantregis = $fc;
			
			//*************************************************************************************
		
		}
		
		
	}

	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>PROCESOS A DESPACHO</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->




        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
		<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
		<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
		<!-- ---------------------------------------------------------------------------------------------------------------------------- -->
		

<script type="text/javascript">

$(document).ready(function() {



	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sáb'],
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
	 
	 $("#filtro2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 $("#filtro3").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	 $("#filtro7").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 $("#filtro8").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	 
	 $("#checkTodos").change(function () {
		  
		  $("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
		  //$("input:checkbox").attr('checked', $(this).attr("checked"));
		  
		 
	 });
	 
	 $("#abrirtarea").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R  = document.getElementById("tsoli").rows[r].cells[19].innerText;//SINMEMO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Abrir_Tarea',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	$("#cerrartareatodo").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Cerrar_Bloque_Tarea',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	 
	 $("#revisado").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Realizar_Revisar_Procesos',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$("#norevisado").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Realizar_No_Revisar_Procesos',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	//ACCION EJECUTADA POR EL JUEZ
	$("#revisado2").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				//d9R  = document.getElementById("tsoli").rows[r].cells[9].innerText;//ID SERVIDOR
				d9R = $('#servi'+fR).find(':selected').val();
				
				//d10R = document.getElementById("tsoli").rows[r].cells[10].innerText;//AREA
				d10R = $('#area'+fR).val();
				
				d19R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						if( 
			
							   $('#servi'+fR).val().length == 0 
							   //$('#filtro2').val().length   == 0 &&
							  
							  
							   
						) {
								
								alert("Definir ASIGNAR A");
						
								//document.getElementById('#area'+fR).style.borderColor  =  '#FF0000';
								//$('#servi'+fR).css("color", "red");
								
								r = cantidad_filas_FR;
								
								idspermiso_real = 0;
								
								idspermisoR = " ";
								
								//fR = 1;
							
						}
						else{
							
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d9R+"//////"+d10R+"//////"+d19R+"******"+idspermisoR;
							
							idspermiso_real = 1;
						
						}
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS O FALTA SELECCIONAR INFORMACION DE LA TABLA";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
					var dias = "<?php echo $Jid_juzgado_6x; ?>";
					
					//alert(dias);
					
					var cadena_fechas = "";
					
					//CALCULO FECHA FINAL DE ACUERDO A LA FECHA ACTUAL
					//Y LOS DIAS PARAMETRIZADOS EN LA TABLA pa_juzgado
					//PARA QUE UN SERVIDOR JUDICIAL HAGA UN TRABAJO
					var fi;
					var fii;
					
					var ff;
					var fff;
					
					var fechaactual = $('#fechaactual').val()
					
					$.get('funciones/traer_fechas_despachos.php?fechat='+fechaactual+'&dias='+dias, function(fechas){
						
						//alert(fechas);
						
						var vector_fechas = fechas.split(" ");
						
						fi  = vector_fechas[0].split("/");
						fii = fi[2]+"-"+fi[1]+"-"+fi[0];
						
						//alert(fii);
						
						ff  = vector_fechas[1].split("/");
						fff = ff[2]+"-"+ff[1]+"-"+ff[0];
						
						//alert(fff);
						
						//cadena_fechas += "******"+fii+"//////"+fff;
						
						cadena_fechas += fii+"//////"+fff;
						
						//alert(cadena_fechas);
				
						$('#datos_soli').val('');
						$('#datos_soli').val(idspermisoR);
						
						dataString += '&datospartes='+$('#datos_soli').val();
						
						dataString += '&cadena_fechas='+cadena_fechas;
						
						//alert(dataString);
					
						//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
						
						//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
						
						
						
						/*Ejecutamos la función ajax de jQuery*/		
						$.ajax({
							
							//url:'views/popupbox/subir.php', //Url a donde la enviaremos
							url:'index.php?controller=archivo&action=Realizar_Revisar_Procesos_2',
							type:'POST', //Metodo que usaremos
							//contentType:false, //Debe estar en false para que pase el objeto sin procesar
							data:dataString, //Le pasamos el objeto que creamos con los archivos
							//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
							cache:false //Para que el formulario no guarde cache
						}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
							
							$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
							$('.mensage').show('slow');//Mostramos el div.
							
							//DESAPARECER
							setTimeout(function() {
								
								$(".mensage").fadeOut(1500);
								
								//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
								
								var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
								var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
								var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
								var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
								
								location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
								
							},3000);
							
						
						});
						
					
					
					});// $.get('funciones/traer_fechas_obs.php?fechat='+dato5_ra, function(fechas){
				
				}
				
				
			}
								 
	});
	
	
	$("#norevisado2").click(function(evento){
		
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				//d9R  = document.getElementById("tsoli").rows[r].cells[9].innerText;//ID SERVIDOR
				//d9R = $('#servi'+fR).find(':selected').val();
				
				//d10R = document.getElementById("tsoli").rows[r].cells[10].innerText;//AREA
				//d10R = $('#area'+fR).val();
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS O FALTA SELECCIONAR INFORMACION DE LA TABLA";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Realizar_No_Revisar_Procesos_2',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$(".cerrar_tarea").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				/*var idusuarioX = "<?php echo $idusuario ; ?>";
				
				var idactu = $(this).attr('data-id');
				var idfila = $(this).attr('data-idfila');
				
				var bandera = 0;
				
				$.get('funciones/traer_obs_asignada.php?idactu='+idactu+'&idusuarioX='+idusuarioX, function(idobs){
						
				//alert(idobs);
				
				if(idobs >= 1){
					
					bandera = 1;
				
				}
				
				if(bandera == 0){
				
					alert("NO ES POSIBLE CERRAR TAREA, TAREA ESTA ASIGNADA A OTRO SERVIDOR JUDICIAL");
				
				}
				else{*/
				
				
				var idactu      = $(this).attr('data-id');
				var idradicado  = $(this).attr('data-idradicado');
				var sm          = $(this).attr('data-sm');
				var idfila      = $(this).attr('data-idfila');
				var valorestado = $(this).attr('data-valorestado');
				
				
				//var estadofila = document.getElementById("tsoli").rows[idfila].cells[8].innerText;//ESTADO
				//alert(estadofila);
				
				if(valorestado == 0){
				
					alert("No es Posible Cerrar Tarea, El Estado de la Tarea se Encuentra EN PROCESO, Tarea aun no ha sido Asignada");
				}
				else{
				
					if( $('#cerrart'+idfila).val().length == 0  ){
									
						alert("Definir Campo Descripcion");
						
						//$('#cerrart'+idfila).val('');
					}
					else{		
					
					
						var data = new FormData();
						
						data.append('idactu',idactu);
						data.append('idradicado',idradicado);
						data.append('sm',sm);
						data.append('tareacerrada',$('#cerrart'+idfila).val());
						
						
						
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
									/*Ejecutamos la función ajax de jQuery*/		
									$.ajax({
										
										//url:'views/popupbox/subir.php', //Url a donde la enviaremos
										url:'index.php?controller=archivo&action=Cerrar_Tarea',
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
											
											
											//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
											
											var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
											var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
											var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
											var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
											
											location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
											
											
											
										},3000);
										
									
									});
									
									
									
								
						}
						
					
					}
					
					
				}
				
				/*}
				
				});*/
								 
	});
	
	$(".cargar_auto").click(function(evento){
	
				
				//var es_juez = "<?php echo $J2tipousuario ; ?>";
				
				//alert(es_juez);
				
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				var idusuarioX = "<?php echo $idusuario ; ?>";
				
				var idactu = $(this).attr('data-id');
				var idfila = $(this).attr('data-idfila');
				
				var idradicado = $(this).attr('data-idradicado');
				var radicado   = $(this).attr('data-radicado');
				
				var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
				var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
				var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
				var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
				
				//var datosexpF = idradicado+"******"+radicado+"******"+idactu+"******"+Jid_juzgado_3x+"******"+Jid_juzgado_4x+"******"+Jid_juzgado_5x+"******"+Jid_juzgado_6x;
				
				var datosexpF = idradicado+"******"+radicado;
				
				//location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF;
				
				var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
				
				window.open('index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF,"EXPEDIENTE DIGITAL", configuracion_ventana);
				
				
				/*var bandera = 0;
				
				$.get('funciones/traer_obs_asignada.php?idactu='+idactu+'&idusuarioX='+idusuarioX, function(idobs){
						
				//alert(idobs);
				
				if(idobs >= 1){
					
					bandera = 1;
				
				}
				
				if(bandera == 0){
				
					alert("NO ES POSIBLE CARGAR AUTO, REALIZAR AUTO, ESTA ASIGNADO A OTRO SERVIDOR JUDICIAL");
				
				}
				else{
				
				
					//var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
					//var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
					//var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
					//var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
									
					
					//location.href='index.php?controller=archivo&action=Cargar_Auto&datosexpF='+datosexpF;
					
					location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF;
					
					
									
				/*if( $('#cerrart'+idfila).val().length == 0  ){
								
					alert("Definri en el Campo Cerrar");
					
					//$('#cerrart'+idfila).val('');
				}
				else{		
				
				
				var data = new FormData();
				
				data.append('idactu',idactu);
				data.append('tareacerrada',$('#cerrart'+idfila).val());
				
				
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							
							
							//Ejecutamos la función ajax de jQuery		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=archivo&action=Cerrar_Tarea',
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
									
									
									//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
									
									var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
									var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
									var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
									var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
									
									location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
									
									
									
								},3000);
								
							
							});
							
							
							
						
				}
				
				}
				
				}
				
				});*/
								 
	});
	
	
	$(".devolucion").click(function(evento){
	
			
				//alert("ENTRE");
				
				var idactu      = $(this).attr('data-id');
				var idfila      = $(this).attr('data-idfila');
				var valorestado = $(this).attr('data-valorestado');
				
				
				//PARA QUE NO ENTRE AL MENSAJE alert("No es Posible Cerrar Tarea, El Estado de la Tarea se Encuentra EN PROCESO, Tarea aun no ha sido Asignada");
				//NO ES NECESRAIO
				valorestado = 1;
				
				if(valorestado == 0){
				
					alert("No es Posible Cerrar Tarea, El Estado de la Tarea se Encuentra EN PROCESO, Tarea aun no ha sido Asignada");
				}
				else{
				
					if( $('#cerrart'+idfila).val().length == 0  ){
									
						alert("Definir Campo Descripcion");
						
						//$('#cerrart'+idfila).val('');
					}
					else{		
					
					
						var data = new FormData();
						
						data.append('idactu',idactu);
						data.append('tareacerrada',$('#cerrart'+idfila).val());
						
						
						
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
									//Ejecutamos la función ajax de jQuery		
									$.ajax({
										
										//url:'views/popupbox/subir.php', //Url a donde la enviaremos
										url:'index.php?controller=archivo&action=Realizar_Devolucion',
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
											
											
											//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
											
											var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
											var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
											var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
											var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
											
											location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
											
											
											
										},3000);
										
									
									});
									
									
									
								
						}
						
					
					}
					
					
				}
				
				
								 
	});
	
	
	$("#devolucion_2").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			var nodes           = 0;
			
			
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
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				d19R = document.getElementById("tsoli").rows[r].cells[0].innerText;//SINMEMO
				
				//d13R = document.getElementById("tsoli").rows[r].cells[13].innerText;//DESCRIPCION
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						if( $('#cerrart'+fR).val().length == 0  ){
									
							//alert("Definir Campo Descripcion");
							
							nodes = 1;
							
						}
						else{
						
							d13R = $('#cerrart'+fR).val();
						
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d19R+"//////"+d13R+"******"+idspermisoR;
						
							idspermiso_real = 1;
						
						}
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			if( nodes ==  1){
									
				alert("Campo(s) Descripcion, Sin Definir");
							
				idspermiso_real = 0;
							
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
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
						url:'index.php?controller=archivo&action=Devolucion_Bloque',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	 
	 $("#filtro4 ").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro4 ").find(':selected').val();
						
		$("#filtro6").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+4);
					
						
	});
	
	 $("#filtro6").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro6").find(':selected').val();
						
		$("#filtro7").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+2);
					
						
	});
	
	$("#filtro7").change(function(event){
	
		//alert("entre");
		
		var iddpto = "<?php echo $iddepartamento; ?>";
		var idmuni = "<?php echo $idmunicipio; ?>";
    	
		var id = $("#filtro7").find(':selected').val();
						
		$("#filtro5").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+5+"&iddpto="+iddpto+"&idmuni="+idmuni);
					
						
	});


	$('#exampleModal').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('******')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('MEMORIALES DEL PROCESO: ' + recipient_2[1])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(1);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_memo.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				//alert(json[i].id_memorial);
					
				registro+="<tr>"
						
					/*registro+="<td class='idactu'>"+json[i].idactu+"</td>"
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					//registro+="<td class='id'>"+json[i].id+"</td>"
					//registro+="<td class='radicado'>"+json[i].radicado+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='id_memorial'>"+json[i].id_memorial+"</td>"
					registro+="<td class='solicitud'>"+json[i].solicitud+"</td>"*/
					
					
					if(json[i].id_memorial >= 1){
					
					
						registro+="<td class='idactu'>"+json[i].idactu+"</td>"
						registro+="<td class='fecha'>"+json[i].fecha+"</td>"
						//registro+="<td class='id'>"+json[i].id+"</td>"
						//registro+="<td class='radicado'>"+json[i].radicado+"</td>"
						registro+="<td class='observacion'>"+json[i].observacion+"</td>"
						registro+="<td class='id_memorial'>"+json[i].id_memorial+"</td>"
						registro+="<td class='solicitud'>"+json[i].solicitud+"</td>"
					
						registro+="<td class='ruta'><a href="+ json[i].ruta_local +" title="+ json[i].ruta_local +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
					
						if(json[i].id_memo_externo >= 1){
						
							registro+="<td class='id_memo_externo'><a href=views/tcpdf/RECIBIDO.php?iddda_acta="+ json[i].id_memo_externo +" title="+ json[i].id_memo_externo +" target='_blank'><button type='button' class='btn btn-success btn-xs' title='RECIBIDO'><span class='glyphicon glyphicon-saved'></span>RECIBIDO</button></a></td>"
						
						}
						else{
							registro+="<td class='ruta'>-</td>"
						}
						
					}
					//SI NO EXISTE IDMEMORIAL SOLO CARGA idactu,fecha,observacion
					else{
						
						registro+="<td class='idactu'>"+json[i].idactu+"</td>"
						registro+="<td class='fecha'>"+json[i].fecha+"</td>"
						
						registro+="<td class='observacion'>"+json[i].observacion+"</td>"
						registro+="<td class='id_memorial'>-</td>"
						registro+="<td class='solicitud'>-</td>"
					
						registro+="<td class='ruta'>-</td>"
						
						if(json[i].id_memo_externo >= 1){
						
							registro+="<td class='id_memo_externo'><a href=views/tcpdf/RECIBIDO.php?iddda_acta="+ json[i].id_memo_externo +" title="+ json[i].id_memo_externo +" target='_blank'><button type='button' class='btn btn-success btn-xs' title='RECIBIDO'><span class='glyphicon glyphicon-saved'></span>RECIBIDO</button></a></td>"
						
						}
						else{
							registro+="<td class='ruta'>-</td>"
						}
					}
					//registro+="<td style='width:180px; font-size:12px'><textarea rows='4' cols='20' name=des"+ i +" id=des"+ i +" title=des"+ i +"></textarea></td>"	
					
					//registro+=" <td><button class='btn btn-default' onClick='registrar_devolucion_2("+json[i].idactu+","+i+")'><span class='glyphicon glyphicon-circle-arrow-left'></span></button></td>" 
				
					
					
						
				registro+="</tr>"
					
					
				$('.editinplace').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_2').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('PROCESO: ' + recipient +' ACUMULADO A')
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_acumulada_2.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				
				if(json[i].digitalizado == 1){
				
					var digi = 'SI';
					
					var datosexpF = json[i].id+"******"+json[i].radicado;
				
				}
				else{
				
					var digi = 'NO';
				}
				
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='radicado'>"+json[i].radicado+"</td>"
					registro+="<td class='digitalizado'>"+digi+"</td>"
					
					
					if(json[i].digitalizado == 1){
				
						
						registro+="<td class='ruta'><a href="+ 'index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF +"><button class='btn btn-default'><span class='glyphicon glyphicon-folder-open'></span></button></a></td>"
					
					}
					else{
					
						registro+="<td>-</td>"
						
					}
						
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_3').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACUMULADA(S) AL PROCESO: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(3);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_acumulada.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			//alert(json.length);
			
			//alert(json);
			
			for(var i=0;i<json.length;i++)
			{
				
				//alert(json[i].id);
				
				if(json[i].digitalizado == 1){
				
					var digi = 'SI';
					
					var datosexpF = json[i].id+"******"+json[i].radicado;
				
				}
				else{
				
					var digi = 'NO';
				}
				
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='radicado'>"+json[i].radicado+"</td>"
					registro+="<td class='digitalizado'>"+digi+"</td>"
					
					
					if(json[i].digitalizado == 1){
				
						
						registro+="<td class='ruta'><a href="+ 'index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF +"><button class='btn btn-default'><span class='glyphicon glyphicon-folder-open'></span></button></a></td>"
					
					}
					else{
					
						registro+="<td>-</td>"
						
					}
						
				registro+="</tr>"
					
					
				$('.editinplace_3').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_4').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('******')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTUACIONES DEL PROCESO: ' + recipient_2[1])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(4);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_actuaciones.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='empleado'>"+json[i].empleado+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_4').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$("#recargar_pro").click(function(evento){
	
		//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
		
		var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
		var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
		var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
		var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
		
		location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
	
	
	});
	
	$("#buscar_pro").click(function(evento){
	
		//alert("BUSCANDO...");
		
		
		if( 
			
		   /*$('#filtro1').val().length   == 0 && */
		   $('#filtro2').val().length   == 0 &&
		   $('#filtro3').val().length   == 0 &&
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 &&
		   $('#filtro6').val().length   == 0 &&
		   $('#filtro7').val().length   == 0 &&
		   $('#filtro8').val().length   == 0 
		   
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			//document.getElementById('filtro1').style.borderColor  =  '#FF0000';
			document.getElementById('filtro2').style.borderColor  =  '#FF0000';
			document.getElementById('filtro3').style.borderColor  =  '#FF0000';
			document.getElementById('filtro4').style.borderColor  =  '#FF0000';
			document.getElementById('filtro5').style.borderColor  =  '#FF0000';
			document.getElementById('filtro6').style.borderColor  =  '#FF0000';
			document.getElementById('filtro7').style.borderColor  =  '#FF0000';
			document.getElementById('filtro8').style.borderColor  =  '#FF0000';
			
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#filtro2').val(); 
		    dato_2 = $('#filtro3').val();
			
			//FECHAS A DESPACHO
			dato_3 = $('#filtro7').val(); 
		    dato_4 = $('#filtro8').val();
			
		    //datox1 = $('#filtro1').val();
			datox1 = 1;//no se usa, es posible a futuro con ids
			datox2 = $('#filtro4').val();
			datox3 = $('#filtro5').val();
			datox4 = $('#filtro6').val();
			
			
			//alert(datox4);
			
			//SOLITAR SIEMPRE EL VALOR DEL ESTADO, PARA UN MEJOR FILTRO,
			//YA QUE PUEDE PASAR QUE SIN ESTE AL ESCOGER CON UN FILTRO DE FECHA
			//A DESPACHO CARGUE PROCESOS DE ESTADO CERRADOS A LA FECHA ACTUAL
			//PERCATANDOCE QUE ESTAN ABIERTAS Y ESTO SE DA YA QUE AL AGRUPAR POR RADIADO
			//Y SIN UN RADICADO YA TIENE TAREAS CERRADAS EN FECHAS ANTERIORES, PUEDE AGRUPAR POR LA CERRADA
			if( $('#filtro6').val().length   == 0 ){
			
				alert("Definir Estado");
			
			}
			else{
			
				location.href="index.php?controller=archivo&action=Busquedad_Filtro&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&dato_3="+dato_3+"&dato_4="+dato_4;
			
			}
			
			
		}
		
	
	});
	
	$("#registrar_devolucion").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				//var sola_UNA = "<?php echo $sola_UNA; ?>";
				
				var idevo = $(this).attr('data-id');
				
				
				
				//alert(idevo);
				
				//var dataString = "";

				//dataString += '&idevo='+idevo;
				
				//alert(dataString);
				
				var data = new FormData();
				
				data.append('idevo',idevo);
			
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							
							
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=demanda&action=Registrar_Devolucion',
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
									
									var msgrespuesta = msg.split("-");
									
									if(msgrespuesta[0] == 1){
									
										location.href = "index.php?controller=demanda&action=Listar_Demandas_2";
									}
									
									
									
								},3000);
								
							
							});
							
							
							
						
				}
			
								 
		});
	

	
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	if(idtabla == 1){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('memos');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 2){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('acumulada_2');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 3){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('acumulada');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 4){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('tactu');
				
		cantidad_filas = TABLA.rows.length;
					
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

function registrar_devolucion_2(idactu,idfila){

	
					//alert("ENTRE...");
					
					//alert(idactu+" - "+idfila);
	
	
					/*var idactu      = $(this).attr('data-id');
					var idfila      = $(this).attr('data-idfila');
					var valorestado = $(this).attr('data-valorestado');*/
					
					var idactu      = idactu;
					var idfila      = idfila;
				
				
				
				
					if( $('#des'+idfila).val().length == 0  ){
									
						alert("Definir Campo Descripcion");
						
						//$('#cerrart'+idfila).val('');
					}
					else{		
					
					
						var data = new FormData();
						
						data.append('idactu',idactu);
						data.append('tareacerrada',$('#des'+idfila).val());
						
						
						
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
									//Ejecutamos la función ajax de jQuery		
									$.ajax({
										
										//url:'views/popupbox/subir.php', //Url a donde la enviaremos
										url:'index.php?controller=archivo&action=Realizar_Devolucion',
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
											
											
											//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
											
											var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
											var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
											var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
											var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
											
											location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
											
											
											
										},3000);
										
									
									});
									
									
									
								
						}
						
					
					}
					
					
}

</script>



<style type="text/css">

#mdialTamanio{
  width: 100% !important;
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
		


</style>


</head>

<body>


<input type="hidden" name="fechaactual" id="fechaactual" readonly="true" value ="<?php echo $fechaactual; ?>"/>
<input type="hidden" name="datos_soli" id="datos_soli" readonly="true"/>


<!-- MENU DE ADMINISTRACION HORIZONTAL -->

<nav class="navbar navbar-default">

  <div class="container-fluid">
   
    
    <div class="collapse navbar-collapse">
      
	  
	  <ul class="nav navbar-nav navbar-right">
	  
	  	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Menu Principal">
			Menu-Principal
		</a>
		
		<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
			Cerrar-Sesion
		</a>
		
		<br>
		<br>
		<label for="input_sesion" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user; ?></label>
	
	  </ul>
	 
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- FIN MENU HORIZONTAL -->

<div class="btn-toolbar" role="toolbar">

  <!-- <a href="index.php" title="Volver al Menu Principal"> -->
  <a href="index.php?controller=archivo&action=listarUbicacionExpediente" title="Regresar">
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<center><h2 class="page-header">ADMINISTRAR PROCESOS A DESPACHO</h2></center>

<center><h3 class="page-header"><?php echo $Jid_juzgado_3;//require_once('demanda_ubicacion.php'); ?></h3></center>


<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header">FILTROS PARA BUSQUEDA</h4>
	
	<a id="buscar_pro" title="BUSCAR">
	
		<button type="button" class="btn btn-default" title="BUSCAR">
			<span class="glyphicon glyphicon-search"></span>BUSCAR
		</button>
			
	</a>
	
	<a id="recargar_pro" title="RECARGAR">
	
		<button type="button" class="btn btn-default" title="RECARGAR">
			<span class="glyphicon glyphicon-repeat"></span>RECARGAR
		</button>
			
	</a>
	
</center>

<!-- <form id="frmfiltro"> -->


<!-- <table class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-2">
				  <label for="input_1">Id</label>
				  <input type="text" class="form-control" name="filtro1" id="filtro1" value="<?php //echo trim($_GET['datox1']); ?>" placeholder="Ingrese Id Proceso">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table> -->

<br>
<br>

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->	


	
	
	<div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Inicial</label>
		  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php echo trim($_GET['dato_1']); ?>" placeholder="Ingrese Fecha Registro Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Final</label>
		  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Final">
		</div>
		
	</div>
	
	
	<div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha A Despacho Inicial</label>
		  <input type="text" class="form-control" name="filtro7" id="filtro7" value="<?php echo trim($_GET['dato_3']); ?>" placeholder="Ingrese Fecha A Despacho Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha A Despacho Final</label>
		  <input type="text" class="form-control" name="filtro8" id="filtro8" value="<?php echo trim($_GET['dato_4']); ?>" placeholder="Ingrese Fecha A Despacho Final">
		</div>
		
	</div>
	

	
	<div class="form-row">
	  
		<div class="form-group col-md-6">
		  <label for="input_1">Radicado</label>
		  <input type="text" class="form-control" name="filtro4" id="filtro4" value="<?php echo trim($_GET['datox2']); ?>" placeholder="Ingrese Radicado">
		</div>
		
		<div class="form-group col-md-6">
		
			  <label for="input_3">Asignado</label>
			 
			  <select class="form-control" name="filtro5" id="filtro5">
														
				<option value="" selected="selected">Seleccionar Asignado</option> 
																	
				<?php
				
					if($datosJUZDES == 1){
					
					
						while($row = $datosSERVI_2->fetch()){
																					
							if($row[id] == trim($idusuario)){					
																					
								echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[empleado] . "</option>";
							}
							
																					
																					
						}
					
					}
					else{
					
						while($row = $datosSERVI_2->fetch()){
																					
							if($row[id] == trim($_GET['datox3'])){					
																					
								echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[empleado] . "</option>";
							}
							else{
								echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
							}
																					
																					
						}
						
					}
					
				?>
			</select>
		  
		  
		</div>
		
		
   </div>
   
   
   <div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Estado</label>
			 
			  <select class="form-control" name="filtro6" id="filtro6">
														
				<option value="" selected="selected">Seleccionar Estado</option> 
				
				<!-- <option value="NULL">EN PROCESO</option>  -->
				<option value="0">EN PROCESO</option> 
				<option value="2">ASIGNADO</option> 
				<option value="3">TAREA CERRADA</option> 
				<option value="4">DEVOLUCION</option> 
				<option value="5">REVISAR</option> 
																	
				<?php
					/*while($row = $datosESTADO->fetch()){
																				
						if($row[num] == trim($_GET['datox8'])){					
																				
							echo "<option value=\"". $row[num] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[num] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}*/
				?>
			</select>
		  
		  	<!-- <label style="width:300px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">NOTA: AL SELECIONAR ESTADO, EN PROCESO, DEFINIR FILTRO FECHA, PARA UN MEJOR AJUSTE EN LO QUE SE DESEA BUSCAR, SIN LAS FECHAS ES POSIBLE QUE EL SISTEMA CALCULE UNA GRAN CANTIDAD DE REGISTROS, PROCESANDO DE FORMA LENTA LA CONSULTA</label>
			<br> -->
			
		  
		</div>
		
		
	</div>
   
	

</div>
	
<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->


<table class="table"> 


	<tr>
															
		
		
		<td>
		
			<center><h2 class="page-header">PROCESOS: <?php echo $cantregis; ?></h2></center>

			
		</td>
			
	</tr> 
	
	
	
</table>


<table class="table"> 

	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	
</table>

<table class="table table-striped table-bordered table table-hover" id="tsoli">
    <thead>
        <tr class="success">
            
			 <th style="width:80px; font-size:12px; color:#FF0000">ACTU</th> 
			
            <th style="width:80px; font-size:12px; color:#FF0000">IDR</th>
			
			<th style="width:180px; font-size:12px">RADICADO</th>
            <th style="width:180px; font-size:12px">FECHA</th>
           <!--  <th style="width:80px; font-size:12px">JUZGADO</th> -->
			<th style="width:180px; font-size:12px">SOLICITUD</th> 
			<th style="width:80px; font-size:12px">MEMORIAL(ES)</th>
			<th style="width:180px; font-size:12px">OBSERVACION</th>  
			<th style="width:180px; font-size:12px">REVISADO</th>
			<th style="width:180px; font-size:12px">ESTADO</th>
			
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			?>
			
				<th style="width:180px; font-size:12px">ASIGNAR A</th>
				<th style="width:180px; font-size:12px">TAREA</th>
				
				
			<?php	
			}else{
			?>
				<th style="width:180px; font-size:12px">ASIGNAR A</th>
				<th style="width:180px; font-size:12px">TAREA</th>
			<?php	
			}
			?>
			
			<th style="width:190px; font-size:12px">FI</th>
			
			<th style="width:190px; font-size:12px">FF</th>
			
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			?>
			<th style="width:60px; font-size:12px">DESCRIPCION</th>
			<th style="width:60px;"></th>
			<th style="width:60px; font-size:12px">EXPEDIENTE</th>
			<?php	
			}else{
			?>
				
				<th style="width:60px; font-size:12px">DESCRIPCION</th>				
				<th style="width:60px; font-size:12px">EXPEDIENTE</th>
			
			<?php	
			}
			?>
			
			<!-- <th style="font-size:10px">CHECK</th> -->
			
			
			<th style="width:180px; font-size:12px">ACUMULADA(S)</th>
			<th style="width:180px; font-size:12px">PROCESO ACUMULADO A</th>
			
			<th style="font-size:12px">
												
				<!-- <a class="marcar_reparto" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a> -->
				Marcar/Desmarcar<input type="checkbox" id="checkTodos" class="checkbox"/>
			</th>
											
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			?>
				
				
				
				<th style="font-size:10px">
					
					
					<!-- <a id="abrirtarea" href="javascript:void(0);" title="Revisado"><img src="views/images/disponible.png" width="25" height="25" title="Abrir Tarea"/></a> -->
					
					<a id="cerrartareatodo" href="javascript:void(0);" title="Cerrar Tarea"><img src="views/images/Untitled-10.png" width="25" height="25" title="Cerrar Tarea"/></a>		
					<br>
					 <label>------</label>
					<br>
					<a id="revisado2" href="javascript:void(0);" title="Revisado"><img src="views/images/hv_6.png" width="25" height="25" title="Asignar a Servidor Judicial / Juez"/></a>
					<br>
					 <label>------</label>
					<br>
					<a id="revisado" href="javascript:void(0);" title="Revisado"><img src="views/images/save.png" width="25" height="25" title="Revisado"/></a>
					
				</th>
									
				<th style="font-size:10px">
					
					<a id="devolucion_2" href="javascript:void(0);" title="Devolucion"><img src="views/images/retorno1.png" width="25" height="25" title="Devolucion"/></a>		
					<br>
					 <label>------</label>
					<br>								
					<a id="norevisado2" href="javascript:void(0);" title="No Revisado"><img src="views/images/elim.png" width="25" height="25" title="No Asignar a Servidor Judicial / Juez"/></a>
					<br>
					<label>------</label>
					<br>
					<a id="norevisado" href="javascript:void(0);" title="No Revisado"><img src="views/images/apply.png" width="25" height="25" title="No Revisado"/></a>
					
				</th>
				
			<?php	
			}else{
			?>
								
				<th style="font-size:10px">
													
					<a id="revisado" href="javascript:void(0);" title="Revisado"><img src="views/images/save.png" width="25" height="25" title="Revisado"/></a>
				</th>
									
				<th style="font-size:10px">
													
					<a id="norevisado" href="javascript:void(0);" title="No Revisado"><img src="views/images/apply.png" width="25" height="25" title="No Revisado"/></a>
				</th>
			
			<?php	
			}
			?>
			
			
			
			
        </tr>
    </thead>
    
   <!--  <tr>
        <td colspan="8" class="text-center">
            <a href="?c=Alumno&a=excel">Exportar a Excel</a>
        </td>
    </tr> -->
	
	
	<?php
											
			$Ct110=1;
			
			$simemoriales = 0;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$d0M = $fila[idactu];
				
				$d1M = $fila[id];
				$d2M = $fila[radicado];
				$d3M = $fila[fecha];
				$d4M = $fila[idjuzgado_reparto];
				$d5M = $fila[solicitud];
				$d6M = $fila[observacion];
				
				$d7M = $fila[ruta_local];
				
				$d8M = $fila[idestadorevisojuz]; 
				
				$d9M = "SI, POR:".$fila[empleado].", FECHA:".$fila[fecharevisado].", HORA:".$fila[horarevisado]; 


				$d10M  = $fila[estadoobs];			
				
				$d11M  = $fila[id_user_asignada];
				
				$d12M  = $fila[fecha_obs_i];
				
				$d13M  = $fila[fecha_obs_f];
				
				$d14M  = $fila[juzobsextra];
				
				$d15M  = $fila[fecha_obs_i];
				$d16M  = $fila[fecha_obs_f];
				
				
				if (empty($fila[tareacerrada]) ) {
				
					$d17M  = $fila[tareacerrada];
			
				}
				else{
				
					$d17M  = $fila[tareacerrada]."\n"."FECHA: ".$fila[fechacerrar]."\n"."HORA: ".$fila[horacerrar];
				}
				
				
				//VARIABLE QUE INDICA QUE EL PROCESO ESTA DIGITALIZADO
				$d18M  = $fila[digitalizado];
				
				
				$d19M  = $fila[desde_reparto];
				
				
				$d20M  = $fila[fechasalida];
				
				//LISTA ASIGNADO A
				$nombrelista  = 'pa_usuario';
				$campoordenar = 'empleado';
				$filtro       = "WHERE id_juzgado = ".$J2id_juzgado;
				$formaordenar = '';
				$datosSERVI   = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
				
				//SI EL ESTADO ES DIFERENTE A CANCELADO Y DEVUELTO
				//CALCULA EL ID O IDS, SI ES CANCELADO O DEVUELTO
				//MUESTRA EL ID REAL, YA QUE LOS ID DE RADICADOS NO SE AGRUPAN
				//DESDE  LA FUNCION public function listar_procesos_despacho_filtro($Jid_juzgado_4){
				if($d10M != 3 && $d10M != 4){
				
				//CARGAR LOS ID ASOCIOADOS AL RADICADO DE LA TABLA detalle_correspondencia ENVIADOA A DESPACHO
				//PARA QUE LOS PROCESOS ASIGNADOS A UNA TAREA SE APLIQUE A UN MEMORIAL
				//O MEMORIALES SEGUN ESA EL CASO
				$datosMEMOS = $modelo->listar_memoriales_proceso($d1M);
				
				while($filamemo = $datosMEMOS->fetch()){
				
				
					$ID_MEMOS = $filamemo[idactu].",".$ID_MEMOS;
					
				}
				
				$ID_MEMOS = rtrim($ID_MEMOS,",");
				
				}
				else{
					$ID_MEMOS = $d0M;
				}
				
		?>
    
    <?php //foreach($this->model->Listar() as $r): ?>
        <tr>
           
		   
			
			<td class="numero" style="width:80px; font-size:8px; color:#FF0000">
			
				<?php //echo $d0M; //id ACTUACION?>
				
				<?php 
					
					echo $ID_MEMOS; //IDS ACTUACION
					
					
				?>
				
			</td>
			
			<td style="width:80px; font-size:12px; color:#FF0000">
			
				<?php echo $d1M; //id radicado?>
				
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php 
				
					echo $d2M; //radicado 
					
					echo "<br>"."<br>";  
			
				?>
				
				
			
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php 
					
					//fecha registro / fecha salida
					echo "FECHA REGISTRO:".$d3M."<br>"."<br>"."FECHA A DESPACHO:".$d20M;  
					
				?>
				
				
				<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_4" data-whatever="<?php echo $d1M."******".$d2M;?>">
				
					Actuaciones
				
				</button>
				
			</td>
			
           <!--  <td style="width:80px; font-size:12px">
			
				<?php //echo $d4M; //juzgado ?>
				
			</td> -->
			
			<td style="width:180px; font-size:12px">
				
				<?php echo utf8_encode($d5M); //solicitud ?>
				
				
				
				
			</td> 
			
			<td style="width:80px; font-size:12px">
													
				<?php 
													
					if(!is_null($d7M)){
					
						$simemoriales = 1;
					
				?>
														
						<!-- <a href="<?php //echo $d7M;?>" title="<?php //echo $d7M;?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>  -->
						
						
						
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $d1M."******".$d2M;?>">
				
							Memorial(es)
				
						</button>
														
				<?php
					}
					else{ 
					
						$simemoriales = 0;
				?>
						
															
						-
				<?php
					}		
				?>
														
			</td>
			
			
			
			
			<td style="width:180px; font-size:12px"> 
			
				<?php echo utf8_encode($d6M); //observacion ?>
				
				
				
			</td>  
			
			
			<td style="width:180px; font-size:12px">
													
				<?php 
													
					if(!is_null($d8M)){?>
														
						<?php echo $d9M; //revisado ?>
						
				<?php
					}
					else{ 
				?>
															
						<?php echo "NO"; ?>
				<?php
					}		
				?>
														
			</td>
			
			
			<td style="width:80px; font-size:12px">
													
				<?php 
													
					//if(!is_null($d10M)){
					//if(is_null($d10M)){
					if($d10M == 0){?>
														
						EN PROCESO
														
				<?php
					}
					if( $d10M == 2){
				?>
															
						ASIGNADO
				<?php
					}		
				?>
				
				<?php
					
					if( $d10M == 3){
				?>
															
						TAREA CERRADA
				<?php
					}		
				?>
				
				<?php
					
					if( $d10M == 5){
				?>
															
						<p style="color:#FF0000">REVISAR</p>
				<?php
					}		
				?>
														
			</td>
			
			
			
			
			
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			
				//REVISADO != NO
				if(!is_null($d8M)){?>
				
					<td style="width:180px; font-size:12px">
				
						 <select name="<?php echo "servi".$Ct110;?>" id="<?php echo "servi".$Ct110;?>" title="<?php echo "servi".$Ct110;?>" style="width:178px; height:30px">
															
							<option value="" selected="selected">Seleccionar</option> 
																				
							<?php
								while($row = $datosSERVI ->fetch()){
								
									if($row[id] == $d11M){
																							
										echo "<option value=\"". $row[id] ."\" selected>" . utf8_encode($row[empleado]) . "</option>";
									
									}
									else{
									
										echo "<option value=\"". $row[id] ."\">" . utf8_encode($row[empleado]) . "</option>";
									}
																							
																							
								}
							?>
						</select>
					
					</td>
					
					<td style="width:180px; font-size:12px">
						
						<textarea rows="4" cols="20" name="<?php echo "area".$Ct110;?>" id="<?php echo "area".$Ct110;?>" title="<?php echo "area".$Ct110;?>"><?php echo $d14M; ?></textarea>
						
					</td>	
					
					
				<?php	
				}else{ 
				
				?>
				
					<td>-</td>
					<td>-</td>
				
				<?php	
				}
				?>
				
			<?php	
			}else{
			?>
			
					<td style="width:180px; font-size:12px">
				
						 <select name="<?php echo "servi".$Ct110;?>" id="<?php echo "servi".$Ct110;?>" title="<?php echo "servi".$Ct110;?>" style="width:178px; height:30px;" disabled>
															
							<option value="" selected="selected">Seleccionar</option> 
																				
							<?php
								while($row = $datosSERVI ->fetch()){
								
									if($row[id] == $d11M){
																							
										echo "<option value=\"". $row[id] ."\" selected>" . utf8_encode($row[empleado]) . "</option>";
									
									}
									else{
									
										echo "<option value=\"". $row[id] ."\">" . utf8_encode($row[empleado]) . "</option>";
									}
																							
																							
								}
							?>
						</select>
					
					</td>
			
					<td style="width:180px; font-size:12px">
						
						<textarea rows="4" cols="20" name="<?php echo "area".$Ct110;?>" id="<?php echo "area".$Ct110;?>" title="<?php echo "area".$Ct110;?>"><?php echo $d14M; ?></textarea>
						
					</td>	
			
			<?php	
			}
			?>
			
			
			<td style="width:190px; font-size:12px">
			
				<?php echo $d15M; //FI ?>
				
			</td>
			
			<td style="width:190px; font-size:12px">
			
				<?php echo $d16M; //FF ?>
				
			</td>
			
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			?>
			<td style="width:180px; font-size:12px">
						
				<textarea rows="4" cols="20" name="<?php echo "cerrart".$Ct110;?>" id="<?php echo "cerrart".$Ct110;?>" title="<?php echo "cerrart".$Ct110;?>"><?php echo $d17M; ?></textarea>
						
			</td>
			
			<td style="width:60px;">
								
				-
				
				<!-- SE CIERRA SOLO SE DEJA EL CERRAR MASIVO,ESTE SOBRA 2 DE SEPTIEMBRE 2020 -->				
				
				<!-- <a class="cerrar_tarea" href="javascript:void(0);" data-id="<?php //echo $d0M;?>" data-idradicado="<?php //echo $d1M;?>" data-sm="<?php //echo $simemoriales;?>"  data-valorestado="<?php //echo $d10M;?>" data-idfila="<?php //echo $Ct110;?>" title="CERRAR TAREA ASIGNADA">				
				
					
					<button class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> 
					
			
				</a> -->
								
								
			</td> 
			
			
			<td style="width:60px;">
								
					
					<?php
					
					//PROCESO DIGITALIZADO
					if($d18M == 1){
					?>
						
					<a class="cargar_auto" data-id="<?php echo $d0M;?>"  data-idradicado="<?php echo $d1M;?>" data-radicado="<?php echo $d2M;?>" data-idfila="<?php echo $Ct110;?>" title="CARGAR AUTO">				
					
						
						<button class="btn btn-default"><span class="glyphicon glyphicon-folder-open"></span></button> 
						
				
					</a>
					<?php
					}
					else{
					?>
						PROCESO SIN DIGITALIZAR
					<?php
					}
					?>
								
								
			</td> 
			<?php	
			}else{
			?>
			
				<td style="width:180px; font-size:12px">
						
					<textarea rows="4" cols="20" name="<?php echo "cerrart".$Ct110;?>" id="<?php echo "cerrart".$Ct110;?>" title="<?php echo "cerrart".$Ct110;?>" readonly="true"><?php echo $d17M; ?></textarea>
						
				</td>
				
				<td style="width:60px;">
								
					
					
					<?php
					
					//PROCESO DIGITALIZADO
					if($d18M == 1){
					?>
						
					<a class="cargar_auto" data-id="<?php echo $d0M;?>"  data-idradicado="<?php echo $d1M;?>" data-radicado="<?php echo $d2M;?>" data-idfila="<?php echo $Ct110;?>" title="CARGAR AUTO">				
					
						
						<button class="btn btn-default"><span class="glyphicon glyphicon-folder-open"></span></button> 
						
				
					</a>
					<?php
					}
					else{
					?>
						PROCESO SIN DIGITALIZAR
					<?php
					}
					?>
					
					
					
								
								
				</td> 
			
			<?php	
			}
			?>
			
			
			
			
			<td style="width:180px; font-size:12px">
			
					<?php 
				
					
					
					//DETERMINAR SI UN PROCESO TIENE ACUMULADA, SE VISUALIZA BOTON
					$tiene_acu_1  = $modelo->get_tiene_acumulada($d1M);
					$tiene_acu_2  = $tiene_acu_1->fetch();
					$tiene_acu_3  = trim($tiene_acu_2[tieneacumulada]);
					
					
					if($tiene_acu_3 >= 1){
					?>   
						<!-- en vez de class="btn btn-primary" poner style="color:#FFFFFF; background-color:#FF0000" para color rojo-->
						<button type="button" style="color:#FFFFFF; background-color:#FF0000" data-toggle="modal" data-target="#exampleModal_3" data-whatever="<?php echo $d2M;?>">
							
							Acumulada(s)
							
						</button>
					<?php
					}else{
					?>   
							SIN ACUMULADA(S) AL PROCESO
					<?php
					}
					?>
					
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
			
					<?php 
				
					
					//DETERMINAR SI UN PROCESO ESTA ACUMULAD0 A OTRO PROCESO, SE VISUALIZA BOTON
					$tiene_acu_4  = $modelo->get_tiene_acumulada_2($d1M);
					$tiene_acu_5  = $tiene_acu_4->fetch();
					$tiene_acu_6  = trim($tiene_acu_5[tieneacumuladaproc]);
					
					
					
					if($tiene_acu_6 >= 1){
					?>  
						<!-- en vez de class="btn btn-primary" poner style="color:#FFFFFF; background-color:#FF0000" para color rojo-->   
						<button type="button" style="color:#FFFFFF; background-color:#FF0000" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php echo $d1M." - ".$d2M;?>">
							
							Acumulado
							
						</button>
					<?php
					}else{
					?>   
							EL PROCESO NO ESTA ACUMULADO A NINGUN PROCESO
					<?php
					}
					
					?>   
	
				
			</td>
			
			
			
			
			
			
			
			
			
			
			<?php
			if($J2tipousuario == 'JUEZ'){
			
			?>
			
				<?php
				//SE ASIGNO DESDE REPARTO DE LA OFICINA OECM Y YA ESTA ASIGNADO A UN SERVIDOR DE DICHA OFICINA
				if($d19M  == 1){
				
				?> 
						<!-- SE REORGANIZA, YA QUE EL JUZ TAMBIEN PUEDE CERRAR LAS TAREAS QUE DESDE REPARTO DE LA OECEM SE ASIGNAN -->
				
						<!-- <td>-</td> -->
						
						<td style="width:10px; font-size:12px">
							<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox"/>
						</td>	
						
				<?php	
				}else{
				?>
						<td style="width:10px; font-size:12px">
							<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox"/>
						</td>	
				<?php	
				}
				?>
			
			<?php	
			}else{
			
				//ASIGNADA O TERMINADA
				if( $d10M == 2 || $d10M == 3){?>
				
					<td>-</td>
					
				<?php	
				}else{
				?>
					
					
					<?php
					//SE ASIGNO DESDE REPATO DE LA OFICINA OECM Y YA ESTA ASIGNADO A UN SERVIDOR DE DICHA OFICINA
					if($d19M  == 1){
					
					?> 
					
							
							<td>-</td> 
							
							
							
					<?php	
					}else{
					?>
							<td style="width:10px; font-size:12px">
								<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox"/>
							</td>	
					<?php	
					}
					?>
					
					
					
					
					
				<?php	
				}
				?>
			
					
			
			
			<?php	
			}
			?>
			
			
			<td> 
		
				<!-- 
				<a class="devolucion" href="javascript:void(0);" data-id="<?php //echo $d0M;?>" data-valorestado="<?php //echo $d10M;?>" data-idfila="<?php //echo $Ct110;?>" title="REALIZAR DEVOLUCION">				
				
					
					<button class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span></button> 
					
			
				</a> -->
				<?php
				
				if($J2tipousuario == 'JUEZ'){
				
				?>
				
				
					<a class="devolucion" href="javascript:void(0);" data-id="<?php echo $ID_MEMOS;?>" data-valorestado="<?php echo $d10M;?>" data-idfila="<?php echo $Ct110;?>" title="REALIZAR DEVOLUCION">				
					
						
						<button class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span></button> 
						
				
					</a>
				
					
					
				<?php
				}else{		
				?>
					-
				<?php
				}		
				?>
				
				
					
           	</td> 
			
	
			<!-- <td>-</td>  -->
			<!-- <td>-</td> -->
			<td>-</td>
			
			<!-- ARCHIVOS DE LA DEMANDA, CARGADOS EN UNA VENTANA MODAL -->
			<!-- <td>
               
			
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php //echo $d1M;?>">
				
				 Archivos Demanda
				
				</button>
				
				
           </td> -->
		   
		 
			
        </tr>
    <?php  
	
		$Ct110=$Ct110+1; 
		
		//REINICAR VARIABLE
		//PARA QUE NO COCATENE LOS ID DE TODO EL WHILE PRINCIPAL
		unset($ID_MEMOS);
		
	} //endforeach; 
	
	?>
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 

<!-- VENTANAS MODALES -->




<!-- MEMORIALES DEL PROCESO -->

<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MEMORIALES DEL PROCESO A DESPACHO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="memos" border="1" class="editinplace">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>IDACTUACION</th>
					<th>FECHA</th>
					<!-- <th>IDRADICADO</th>
					<th>RADICADO</th> -->
					<th>OBSERVACION</th>
					<th>IDMEMORIAL</th>
					<th>MEMORIAL</th>
					<th>ARCHIVO</th>
					<th>RECIBIDO</th>
					<!-- <th>DESCRIPCION</th>
					<th>DEVOLUCION</th> -->
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 


<!-- ACUMALADAS AL PROCESO -->

<div class="modal fade" id="exampleModal_3" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_3">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACUMULADAS AL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="acumulada" border="1" class="editinplace_3">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>RADICADO</th>
					<th>DIGITALIZADO</th>
					<th>EXPEDIENTE</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 



<!-- PROCESO ACUMULADO A-->

<div class="modal fade" id="exampleModal_2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PROCESO ACUMULADO A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="acumulada_2" border="1" class="editinplace_2">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>RADICADO</th>
					<th>DIGITALIZADO</th>
					<th>EXPEDIENTE</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 

<!-- ACTUACIONES DEL PROCESO -->

<div class="modal fade" id="exampleModal_4" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUACIONES DEL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="tactu" border="1" class="editinplace_4">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>FECHA</th>
					<th>OBSERVACION</th>
					<th>USUARIO</th>
					
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 

<!-- FIN VENTANAS MODALES -->

<div class="row">
	<div class="col-xs-12">
     	<footer class="text-center">
       		<hr />
        	<p>Plataforma <?php echo utf8_encode(Diseñada);?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
			<p>Plataforma Desarrollado por</p>
			<p>Ingeniero de Sistemas Jorge Andres Valencia Orozco (Oficina de Ejecucion Civil Municipal Manizales)</p>       
        </footer>                
	</div>    
</div>

<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>
