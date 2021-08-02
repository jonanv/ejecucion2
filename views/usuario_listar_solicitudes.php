
<?php 
	

	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new usuarioModel();
	
	
	
	//$iddepartamento  =  $_SESSION['iddepartamento'];
	//$idmunicipio     =  $_SESSION['idmunicipio'];
	

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//$horaactual = strtotime($horaactual);
	
	//$horaactual = $horaactual;
	
	//echo $horaactual."<br>";
	
	//NOTA: EN LA BASE DE DATOS TABLA dda_municipio EN LA COLUMNA hi Y hf
	//DEBE SER DE LA SIGUEINTE FORMA hi:07:30 - hf: 22:00
	//ES DECIR LA HORA INICIAL SE DEFINE DE LA FORMA 07:30 NO 7:30
	/*$rango_horas = $modelo->rango_horas_municipio($idmunicipio,$iddepartamento);	
	$rango       = $rango_horas->fetch();
	//$hi          = strtotime($rango[hi]);
	//$hf          = strtotime($rango[hf]);
	
	$hi          = $rango[hi];
	$hf          = $rango[hf];
	
	$hi2         = $rango[hi2];
	$hf2         = $rango[hf2];*/
	
	//LISTA BASE DE DATOS LOCAL
	
	/*$nombrelista  = 'dda_jurisdiccion';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosJURI    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//ESTADOS
	//0 ---> SOLICITUD PROCESADA, NO SE VISUALIZA EN LA BANDEJA
	//1 ---> SOLICITUD NO PROCESADA, SE VISUALIZA EN LA BANDEJA
	//2 ---> SOLICITUD RECHAZADA, NO SE VISUALIZA EN LA BANDEJA
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	
	//ESTA PARTE NO APLICA
	if($opcion == 1){
	
		
		$datosACCION_1 = $modelo->listar_usuarios_filtro($idusuario);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_usuarios_filtro($idusuario);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACCION_1 = $modelo->Listar_Usuarios_2($idusuario);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->Listar_Usuarios_2($idusuario);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
	
	}

	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>SOLICITUDES USUARIOS</title>
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


//---------------------------------RANGO HORA--------------------------------------------------------

function horario(){

    //una notificación normal
	
	var iddepartamentoH = "<?php echo $iddepartamento; ?>";
	var idmunicipioH    = "<?php echo $idmunicipio; ?>";
	
	
	$.get('funciones/dda_horario.php?iddepartamentoH='+iddepartamentoH+"&idmunicipioH="+idmunicipioH, function(horaX){
		
				
		//alert(horaX);
		//return false;
		var flag = 0;
		
		var rango_horas = horaX.split("//////");
		
		//DIA
		var hi  = rango_horas[0];
		var hf  = rango_horas[1];
	
		//TARDE
		var hi2 = rango_horas[2];
		var hf2 = rango_horas[3];
		
		var horaactual = rango_horas[4];
		
		
		if( (horaactual >= hi && horaactual <= hf) || (horaactual >= hi2 && horaactual <= hf2) ){
		
			flag = 1;
		}
		else{
		
			
			alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL DIA:"+hi+"-"+" HORA FINAL DIA:"+hf+" HORA ACTUAL:"+horaactual+" HORA INICIAL TARDE:"+hi2+"-"+" HORA FINAL TARDE:"+hf2+" HORA ACTUAL:"+horaactual);
					
			location.href = "index.php?controller=demanda&action=Cerrar_Session";
		
		}
				
			
	} );
	
		
	
}


/*var jClockInterval = setInterval(function(){
   horario();
}, 5000);*/

//---------------------------------FIN RANGO HORA--------------------------------------------------------

</script>

		

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
	 
	 
	 
	 $("#checkTodos").change(function () {
		  
		  $("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
		  //$("input:checkbox").attr('checked', $(this).attr("checked"));
		  
		 
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
			
			var existeU = 0;
			
		
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
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID 
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//CEDULA
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//NOMBRE
				d3R  = document.getElementById("tsoli").rows[r].cells[3].innerText;//CORREO
				d4R  = document.getElementById("tsoli").rows[r].cells[4].innerText;//CELULAR
				d5R  = document.getElementById("tsoli").rows[r].cells[5].innerText;//ES ABOGADO
				
				
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						
						if($("#existe"+fR).is(':checked')) {  
							
							existeU = 1;
						
						}
						else{
						
							existeU = 0;
						}
						
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d3R+"//////"+d4R+"//////"+d5R+"//////"+existeU+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES USUARIOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
					//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
					//Y EL RESTO DE CAMPOS VIA POST
					var data = new FormData();
				
					$('#datos_acti').val('');
					$('#datos_acti').val(idspermisoR);
					
				
					data.append('datospartes',$('#datos_acti').val());
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=usuario&action=registrar_solicitudes',
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
							
							location.href="index.php?controller=usuario&action=Listar_Solicitudes_Usuarios";
							
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	$("#rechazar").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
			var existeU = 0;
			
		
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
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID 
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//CEDULA
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//NOMBRE
				d3R  = document.getElementById("tsoli").rows[r].cells[3].innerText;//CORREO
				d4R  = document.getElementById("tsoli").rows[r].cells[4].innerText;//CELULAR
				d5R  = document.getElementById("tsoli").rows[r].cells[5].innerText;//ES ABOGADO
				
				
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						
						if($("#existe"+fR).is(':checked')) {  
							
							existeU = 1;
						
						}
						else{
						
							existeU = 0;
						}
						
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d3R+"//////"+d4R+"//////"+d5R+"//////"+existeU+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES USUARIOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
					//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
					//Y EL RESTO DE CAMPOS VIA POST
					var data = new FormData();
				
					$('#datos_acti').val('');
					$('#datos_acti').val(idspermisoR);
					
				
					data.append('datospartes',$('#datos_acti').val());
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=usuario&action=Rechazar_Solicitudes',
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
							
							location.href="index.php?controller=usuario&action=Listar_Solicitudes_Usuarios";
							
							
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
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"******"+idspermisoR;
						
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
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('PARTES DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(1);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_partes.php?tabla=1",
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
					registro+="<td class='id'>"+json[i].idda+"</td>"
					registro+="<td class='id'>"+json[i].docddte+"</td>"
					registro+="<td class='id'>"+json[i].nomddte+"</td>"
					registro+="<td class='id'>"+json[i].iddepartamento+"</td>"
					registro+="<td class='id'>"+json[i].idmunicipio+"</td>"
					registro+="<td class='id'>"+json[i].dir+"</td>"
					registro+="<td class='id'>"+json[i].telefono+"</td>"
					registro+="<td class='id'>"+json[i].correo+"</td>"
					registro+="<td class='id'>"+json[i].idparte+"</td>"
					registro+="<td class='id'>"+json[i].tp+"</td>"
					
						
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
	  	modal.find('.modal-title').text('ARCHIVOS DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		var nomarchivo;
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_archivos.php?tabla=1",
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
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
				
				
				//alert(decodeURIComponent(escape(json[i].ruta)));
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].idda+"</td>"
					registro+="<td class='idda'>"+nomarchivo[3]+"</td>"
					registro+="<td class='ruta'><a href="+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
					
					//registro+="<td class='ruta'><a href="+ escape(json[i].ruta) +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_2').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_3').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTA REPARTO DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		var nomarchivo;
		
		Eliminar_Tabla(3);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_acta.php?tabla=1",
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
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].idda+"</td>"
					registro+="<td class='idda'>"+nomarchivo[4]+"</td>"
					registro+="<td class='ruta'><a href="+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_3').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_2').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_4').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTA DEVOLUCION DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		var nomarchivo;
		
		Eliminar_Tabla(4);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_devo.php?tabla=1",
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
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].idda+"</td>"
					registro+="<td class='idda'>"+nomarchivo[3]+"</td>"
					registro+="<td class='ruta'><a href="+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_4').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_4').on('show.bs.modal', function (event) {
	
	
	
	$('#exampleModal_5').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ANEXOS DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(5);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_anexos.php?tabla=1",
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
						
					registro+="<td class='id'>"+json[i].anexos+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_5').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_4').on('show.bs.modal', function (event) {
	
	
	$("#recargar_demanda").click(function(evento){
	
		location.href="index.php?controller=usuario&action=Listar_Usuarios";
	
	});
	
	$("#buscar_demanda").click(function(evento){
	
		//alert("BUSCANDO...");
		
		
		if( 
			
		   $('#filtro1').val().length   == 0 && 
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 /*&&
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 &&
		   $('#filtro6').val().length   == 0 &&
		   $('#filtro7').val().length   == 0 &&
		   $('#filtro8').val().length   == 0 &&
		   $('#filtro9').val().length   == 0 &&
		   $('#filtro10').val().length  == 0 &&
		   $('#filtro11').val().length  == 0 &&
		   $('#filtro12').val().length  == 0*/
		   
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('filtro1').style.borderColor   =  '#FF0000';
			document.getElementById('filtro4').style.borderColor   =  '#FF0000';
			document.getElementById('filtro5').style.borderColor   =  '#FF0000';
			/*document.getElementById('filtro4').style.borderColor   =  '#FF0000';
			document.getElementById('filtro5').style.borderColor   =  '#FF0000';
			document.getElementById('filtro6').style.borderColor   =  '#FF0000';
			document.getElementById('filtro7').style.borderColor   =  '#FF0000';
			document.getElementById('filtro8').style.borderColor   =  '#FF0000';
			document.getElementById('filtro9').style.borderColor   =  '#FF0000';
			document.getElementById('filtro10').style.borderColor  =  '#FF0000';
			document.getElementById('filtro11').style.borderColor  =  '#FF0000';
			document.getElementById('filtro12').style.borderColor  =  '#FF0000';*/
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			//dato_1  = $('#filtro2').val(); 
		    //dato_2  = $('#filtro3').val();
			
		    datox1  = $('#filtro1').val();
			datox4  = $('#filtro4').val();
			datox5  = $('#filtro5').val();
			/*datox4  = $('#filtro6').val();
			datox5  = $('#filtro7').val();
			datox6  = $('#filtro8').val();
			datox7  = $('#filtro9').val();
			datox8  = $('#filtro10').val();
			datox9  = $('#filtro11').val();
			datox10 = $('#filtro12').val();*/
			
		    

			location.href="index.php?controller=usuario&action=Busquedad_Filtro_Usuario&dato_0="+dato_0+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5;
			

			
		}
		
	
	});
	
	$("#filtro11").change(function(event){
	
		//alert("entre");
		
		//SOLO CARGARA LA LISTA DEL MUNICIPIO LOGEADO
		//var lidmunicipio = "<?php echo $idmunicipio; ?>";
		
		var id = $("#filtro11").find(':selected').val();
						
		//CUANDO SOLO SE DESEE ESPECIFICAR UN DEPARTAMENTO Y UN MUNICIPIO
		//$("#lista2").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1+"&lidmunicipio="+lidmunicipio);
		
		$("#filtro12").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1);
					
						
	});
	
	
	
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	if(idtabla == 1){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('partes');
				
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
		var TABLA = document.getElementById('archivosdda');
				
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
		var TABLA = document.getElementById('actadda');
				
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
		var TABLA = document.getElementById('devodda');
				
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
	
	if(idtabla == 5){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('anexosdda');
				
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

</script>



<style type="text/css">

#mdialTamanio{
  width: 80% !important;
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
		<label for="input_sesion" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></label>
	
	  </ul>
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- FIN MENU HORIZONTAL -->


<div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=usuario&action=Listar_Usuario_Menu" title="Volver al Menu Principal">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Volver al Menu Administrar Usuarios
	  </button>
  
  </a>

</div>


<input type="hidden" name="datos_acti" id="datos_acti" readonly="true"/>

<table class="table"> 


	<tr>
															
		
		
		<td>
		
			
			<center><h2 class="page-header">SOLICITUDES USUARIOS: <?php echo $cantregis; ?></h2></center>

			
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
            
			<!-- <th style="width:80px;"></th> -->
			
            <th style="width:180px; font-size:12px; color:#FF0000">ID</th>
			
			<th style="width:180px; font-size:12px">N.C.C. o NIT</th>
			<th style="width:180px; font-size:12px">NOMBRE</th>
			<th style="width:180px; font-size:12px">CORREO</th>
			<th style="width:180px; font-size:12px">CELULAR</th>
			<th style="width:180px; font-size:12px">ABOGADO</th>
			<th style="width:180px; font-size:12px">FECHA</th>
			<th style="width:180px; font-size:12px">HORA</th>
			
			<th style="font-size:10px">CHECK</th>
			
			<th style="font-size:12px">
												
				<!-- <a class="marcar_reparto" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a> -->
				Marcar/Desmarcar<input type="checkbox" id="checkTodos" class="checkbox"/>
			</th>
			
			<th style="font-size:10px">
													
					
					<a id="revisado" href="javascript:void(0);" title="Registrar Solicitudes"><img src="views/images/save.png" width="25" height="25" title="Registrar Solicitudes"/></a>
					
					
			</th>
			
			<th style="font-size:10px">
													
					
					
					<a id="rechazar" href="javascript:void(0);" title="Rechazar Solicitudes"><img src="views/images/rechazar.png" width="25" height="25" title="Rechazar Solicitudes"/></a>
					
			</th>
			
			<!-- <th style="font-size:10px">
													
					
					
					<a id="norevisado" href="javascript:void(0);" title="No Revisado"><img src="views/images/apply.png" width="25" height="25" title="No Revisado"/></a>
					
			</th> -->
			
			
           <!--  <th style="width:180px; font-size:12px">PARTES</th> -->
          <!--  <th style="width:60px;"></th>  -->
			
        </tr>
    </thead>
    
   <!--  <tr>
        <td colspan="8" class="text-center">
            <a href="?c=Alumno&a=excel">Exportar a Excel</a>
        </td>
    </tr> -->
	
	
	<?php
											
			$Ct110=1;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$d1M = $fila[id];
				$d2M = $fila[cedula];
				$d3M = utf8_encode($fila[nombre]);
				$d4M = utf8_encode($fila[correo]);
				$d5M = $fila[fecha];
				$d6M = $fila[hora];
				
				$d7M = $fila[celular];
				$d8M = $fila[esabogado];
				
				
				
				
		?>
    
    <?php //foreach($this->model->Listar() as $r): ?>
        <tr>
          
			
			<td style="width:180px; font-size:12px; color:#FF0000">
			
				<?php echo $d1M; //id?>
				
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php 
				
					echo $d2M; //CEDULA 
					
					$si_existe   = $modelo->buscar_pa_usuario($d2M);
					$fsiexiste   = $si_existe->fetch();
					$si_existe_2 = $fsiexiste[id];
				?>
			
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php echo $d3M; //NOMBRE ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d4M; //CORREO ?>
				
			</td>
			
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d7M; //CELULAR ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d8M; //ES ABOGADO ?>
				
			</td>
			
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d5M; //FECHA ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d6M; //HORA ?>
				
			</td>
			
			<td style="width:10px; font-size:12px">
			
					<?php
					if($si_existe_2 >= 1){
					?>
						
						<input type="text" name="<?php echo "existe".$Ct110;?>" id="<?php echo "existe".$Ct110;?>" value="<?php echo "CUENTA CON USUARIO REGISTRADO";?>" style="width:230px" title="<?php echo "existe".$Ct110;?>"/>
						
						<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox"/>
					<?php
					}
					else{
					?>
					<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox"/>
					<?php
					}
					?>
			</td>	
			
			<td>-</td>
			<td>-</td>
			<td>-</td> 
			
          
			
        </tr>
    <?php  $Ct110=$Ct110+1; } //endforeach; ?>
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 

<!-- VENTANAS MODALES -->


<!-- ARCHIVOS DE LA DEMANDA -->

<div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS DEMANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="archivosdda" border="1" class="editinplace_2">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>ID DEMANDA</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
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


<!-- ACTA DE LA DEMANDA -->

<div class="modal fade" id="exampleModal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="actadda" border="1" class="editinplace_3">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>ID DEMANDA</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
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


<!-- PARTES DE LA DEMANDA -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PARTES DEMANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="partes" border="1" class="editinplace">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>IDPARTE</th>
					<th>IDDA</th>
					<th>N.C.C. o NIT</th>
					<th>NOMBRE</th>
					<th>DEPARTAMENTO</th>
					<th>MUNICIPIO</th>
					<th>DIRECCION</th>
					<th>CEL / TELEFONO</th>
					<th>CORREO</th>
					<th>PARTE</th>
					<th>TP</th>
					
							
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

<!-- ACTA DEVOLUCION DEMANDA  -->

<div class="modal fade" id="exampleModal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTA DEVOLUCION DEMANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="devodda" border="1" class="editinplace_4">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>ID DEMANDA</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
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


<!-- ANEXOS -->

<div class="modal fade" id="exampleModal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ANEXOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="anexosdda" border="1" class="editinplace_5">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ANEXOS</th>
					
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
        	<p>Plataforma <?php echo utf8_encode(' Diseñada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
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
