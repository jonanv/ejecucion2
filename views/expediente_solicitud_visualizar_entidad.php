
<?php 
	

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//$servidor_pdf = "127.0.0.1";
	
	$servidor_pdf = trim($_SESSION['ipplataforma']);
	
	//echo $_SESSION['ipplataforma'];

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	if($opcion == 1){
	
		$datoJXX1 = trim($_GET['datox1']);//radicado
		$datoJXX2 = trim($_GET['dato_1']);//fecha registro inicial
		$datoJXX3 = trim($_GET['dato_2']);//fecha registro final
		$datoJXX4 = trim($_GET['datox4']);//estado solicitud
		$datoJXX5 = trim($_GET['datox5']);//documento
		$datoJXX6 = trim($_GET['datox6']);//nombre solicita
		
		$datosACCION_1 = $modelo->get_VISUALIZAR_SOLICITUD_ENTIDAD_OECM_Filtro($datoJXX1,$datoJXX2,$datoJXX3,$datoJXX4,$datoJXX5,$datoJXX6);
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->get_VISUALIZAR_SOLICITUD_ENTIDAD_OECM_Filtro($datoJXX1,$datoJXX2,$datoJXX3,$datoJXX4,$datoJXX5,$datoJXX6);
			
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
			
			$fc = $fc + 1; 
		
		}
			
		$cantregis = $fc;
			
		//*************************************************************************************
			
			

	}//FIN if($opcion == 1){
	else{
	
		$datosACCION_1 = $modelo->get_VISUALIZAR_SOLICITUD_ENTIDAD_OECM();
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->get_VISUALIZAR_SOLICITUD_ENTIDAD_OECM();
			
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
			
			$fc = $fc + 1; 
		
		}
			
		$cantregis = $fc;
			
		//*************************************************************************************
	
	}
	
	//---------------------------------------------------------------OPCIONES PARA EL MENU ADMINISTRAR--------------------------------------------------------------------
	
	//******************ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************
	$campos       = 'usuario';
	$nombrelista  = 'pa_usuario_acciones';
	$idaccion	  = '37';
	$campoordenar = 'id';
	$admin_expe   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_expe_1 = $admin_expe->fetch();
	$admin_expe_2 = explode("////",$admin_expe_1[usuario]);
	
	$bandera_ADMIN_EXPE = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_expe_2,true) ){
	
		$bandera_ADMIN_EXPE = 1;
	}	
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************


	//******************ID USUARIOS, PARA VISUALIZAR MEMORIALES RADICADOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	  = '38';
	$campoordenar = 'id';
	$admin_memo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_memo_1 = $admin_memo->fetch();
	$admin_memo_2 = explode("////",$admin_memo_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_ADMIN_MEMO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_memo_2,true) ){
	
		$bandera_ADMIN_MEMO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************

	//******************ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	    = '39';
	$campoordenar   = 'id';
	$admin_titulo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_titulo_1 = $admin_titulo->fetch();
	$admin_titulo_2 = explode("////",$admin_titulo_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_ADMIN_TITULO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_titulo_2,true) ){
	
		$bandera_ADMIN_TITULO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************
	
	
	
	//******************ID USUARIOS, QUE VISUALIZAN EL MENU SOLICITUD VISUALIZAR EXPEDIENTE ENTEDIDAD Y TERCEROS***************
	$idaccion	  = '54';
	$campoordenar = 'id';
	$datos_54_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$datos_54_2   = $datos_54_1->fetch();
	$datos_54_3	  = explode("////",$datos_54_2[usuario]);
			
	$bandera_54   = 0;
			
	if ( in_array($_SESSION['idUsuario'],$datos_54_3,true) ){
			
		$bandera_54 = 1;
	}	
	//******************FIN ID USUARIOS, QUE VISUALIZAN EL MENU SOLICITUD VISUALIZAR EXPEDIENTE ENTEDIDAD Y TERCEROS***************
	
	
	//---------------------------------------------------------------FIN OPCIONES PARA EL MENU ADMINISTRAR--------------------------------------------------------------------
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>EXPEDIENTE DIGITAL</title>
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
	 
	 $("#flv").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	 var ip_servidor = "<?php echo $servidor_pdf; ?>";
	 //var servidor    = "127.0.0.1";
	 var servidor    = ip_servidor;
	 
	//OCULTAR GIF CARGANDO
	$('#fila_cargando').hide();
	$('#fila_cargando_2').hide();
	 
	//OCULTAR LAS FILAS QUE VISUALIZAN EL ARCHIVO PDF
	$('#varchivo_1').hide();
	$('#varchivo_2').hide();
	 
	
	$("#solicitud").change(function(event){
    
		var id        = $("#solicitud").find(':selected').val();
		
		var opcion_seleccionada = $('#solicitud option:selected').text();
		
		$("#text_lista_ts").val('');
		$("#text_lista_ts").val(opcion_seleccionada);
		
    });
	
	
	$("#asignar_fecha_limite").click(function(evento){
	
	
		var dataString  = "";
		var validar     = 0;
		
		
		if( $('#flv').val() == null || $('#flv').val().length == 0 || /^\s+$/.test($('#flv').val()) ) {
				
			msg = "Defina Fecha Limite Visualizacion";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&flv='+$("#flv").val();
					
		}
		
		
		//CAMPOS OCULTOS
		
		//ID
		if( $('#idmemoexterno').val() == null || $('#idmemoexterno').val().length == 0 || /^\s+$/.test($('#idmemoexterno').val()) ) {
				
			msg = "Defina Id Registro(CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&idmemoexterno='+$("#idmemoexterno").val();
					
		}
		
		
		
	
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
						
					var data = new FormData();
				
				
					data.append('flv',$('#flv').val());
					
					//CAMPOS OCULTOS
					data.append('idmemoexterno',$('#idmemoexterno').val());
					
					
					if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
					
					
											//OCULTAMOS BOTON REGISTRAR
											//PARA EVITAR QUE EL USUARIO DE CLIC
											//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
											$('#asignar_fecha_limite').hide();
																
											$('#fila_cargando').show();
						
						
											//Ejecutamos la función ajax de jQuery		
											$.ajax({
												
												//url:'views/popupbox/subir.php', //Url a donde la enviaremos
												url:'index.php?controller=archivo&action=Radicar_Solicitud_Visualizar_Entidad',
												type:'POST', //Metodo que usaremos
												contentType:false, //Debe estar en false para que pase el objeto sin procesar
												//data:dataString, //Le pasamos el objeto que creamos con los archivos
												data:data,
												processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
												cache:false //Para que el formulario no guarde cache
											}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
												
												$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
												$('.mensage_memo').show('slow');//Mostramos el div.
												
												//DESAPARECER
												setTimeout(function() {
													
													$(".mensage_memo").fadeOut(1500);
													
										
													$('#asignar_fecha_limite').show();
													
													$('#fila_cargando').hide();
													
													
													//alert(msg);
													//var msgrespuesta = msg.split("-");
													
													//LIMPIAR CAMPOS VENTANA
													$('#flv').val('');
													
													//CAMPOS OCULTOS
													$('#idmemoexterno').val('');
													
													
													//CIERRO VENTANA
													//$("#exampleModal_5B").hide();
													
													//RECARGAR 
													location.href='index.php?controller=archivo&action=Solicitud_Visualizar_Expediente_Entidad';
													
													
													
													
													
												},3000);
												
											
											});					
						
					
					
					}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
					
					
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	});
	
	$("#dar_respuesta").click(function(evento){
	
	
		var dataString  = "";
		var validar     = 0;
		var sin_archivo = 0;
		
		if( $('#resexpedigi').val() == null || $('#resexpedigi').val().length == 0 || /^\s+$/.test($('#resexpedigi').val()) ) {
				
			msg = "Defina Respuesta";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&resexpedigi='+$("#resexpedigi").val();
					
		}
		
		/*if( $('#archivomemoB').val() == null || $('#archivomemoB').val().length == 0 || /^\s+$/.test($('#archivomemoB').val()) ) {
					
				
			sin_archivo = 0;
			validar     = 0;
				
			//return false;
						
		}
		else{
			
			//SE REORGANIZA DE ESTA FORMA YA QUE EL USUARIO PUEDE O NO DEFINIR UN ARCHIVO, EN ESTE CASO DEFINE ARCHIVO
			sin_archivo = 1;
				
			dataString += '&archivomemoB='+$("#archivomemoB").val();
				
						
		}*/
		
		
		//CAMPOS OCULTOS
		
		//ID
		if( $('#idmemoexterno').val() == null || $('#idmemoexterno').val().length == 0 || /^\s+$/.test($('#idmemoexterno').val()) ) {
				
			msg = "Defina Id Registro(CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&idmemoexterno='+$("#idmemoexterno").val();
					
		}
		
		
		
	
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
						
				var data = new FormData();
				
				//SE DEFINE ARCHIVO SE VALIDA SU ESTRUCTURA			
				/*if(sin_archivo == 1){
				
					var inputFileImage = document.getElementById("archivomemoB");
					var file           = inputFileImage.files[0];
								
					//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivodda'
					var archivos = document.getElementById("archivomemoB");
								
					//Obtenemos los archivos seleccionados en el imput
					var archivo  = archivos.files;
							
							
					//VALIDAR ARCHIVO, SOLO PERMITE NOMBRES CON NUMEROS,LETRAS Y TODO PEGADO,
					//NO PERMITE NOMBRES CON ACENTOS, ESPACIOS Y CON CARACTERES ESPECIALES
								 
					var nom_archivo    = 0;
								
					var caracter       = "";
					var caracter2       = "";
					var nombre_archivo = "";
								
					var nombre_archivo_2 = "";
					var tipo_archivo     = "";
								
								
					//-----------------VALIDAMOS QUE LOS ARCHIVOS SEAN PDF Y NO TENGAN ESPACIOS Y CARACTERES RAROS EN SUS NOMBRES---------------------------------
					for(i=0; i<archivo.length; i++){
									
						//alert(archivo[i].type);
						nombre_archivo_2 = archivo[i].name
						tipo_archivo     = archivo[i].type;
									
						if(tipo_archivo == 'application/pdf'){
									
							nombre_archivo = archivo[i].name;
										
							for (var x = 0; x<nombre_archivo.length; x++) {
										
										
								//alert("entre 2");
											
								//CAPTURA CARACTER
								caracter2 = nombre_archivo.charAt(x);
											 
								//CAPTUTA ASCII CARACTER
								caracter = nombre_archivo.charCodeAt(x);
											 
				
								//alert(caracter+" "+caracter2);
											 
									
								if( 
												
												 
										(caracter >= 32 && caracter <= 45)   ||
										(caracter >= 47 && caracter <= 47)   || 
										(caracter >= 58 && caracter <= 64)   || 
										(caracter >= 91 && caracter <= 96)   || 
										(caracter >= 123 && caracter <= 254)  
												 
								 ) {
												
												
										nom_archivo = 1;
													 
										$('#archivomemoB').val('');
													
										i = archivo.length;
													
										x = nombre_archivo.length;
													
						 
										alert("CARACTER NO PERMITIDO EN EL NOMBRE DEL ARCHIVO, EL NOMBRE DEL ARCHIVO DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO PDF, NOMBRE ARCHIVO: "+nombre_archivo+", TIPO ARCHIVO: "+tipo_archivo);
										//return false;
												  
												 
									} 
											 
							}//FIN for (var x = 0; x<nombre_archivo.length; x++) {
										
										
						}//FIN if(tipo_archivo == 'application/pdf'){
						else{
									
								nom_archivo = 1;
												 
								$('#archivomemoB').val('');
												
								i = archivo.length
										
									 
								alert("ARCHVIO DEBE SER PDF, NOMBRE ARCHIVO: "+nombre_archivo_2+", TIPO ARCHIVO: "+tipo_archivo);
												
									
						}
									
						if(nom_archivo == 0){
									
							data.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
						}
						
						
					}//FIN for(i=0; i<archivo.length; i++){
					
				
				}//FIN if(sin_archivo == 1){
				else{
				
					//NO SE VALIDA NINGUN ARCHIVO, NO EXISTEN PROBLEMAS EN SU VALIDACION
					nom_archivo = 0;
				}*/
				
				//-----------------FIN VALIDAMOS QUE LOS ARCHIVOS SEAN PDF Y NO TENGAN ESPACIOS Y CARACTERES RAROS EN SUS NOMBRES---------------------------------
				
				nom_archivo = 0;
				
				//AL CARGAR LOS ARCHIVOS NO SE PRESENTO NINGUNA INCONSISTENCIA		
				if(nom_archivo == 0){
				
						
					data.append('resexpedigi',$('#resexpedigi').val());
					
					//CAMPOS OCULTOS
					data.append('idmemoexterno',$('#idmemoexterno').val());
					//data.append('sin_archivo',sin_archivo);//IDENTIFICA SI EL USUARIO DEFINE UN ARCHIVO 0 = NO - 1 = SI
					
					
				
					if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
					
					
											//OCULTAMOS BOTON REGISTRAR
											//PARA EVITAR QUE EL USUARIO DE CLIC
											//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
											$('#dar_respuesta').hide();
																
											$('#fila_cargando_2').show();
						
						
											//Ejecutamos la función ajax de jQuery		
											$.ajax({
												
												//url:'views/popupbox/subir.php', //Url a donde la enviaremos
												url:'index.php?controller=archivo&action=Registrar_Devolucion_Solicitud',
												type:'POST', //Metodo que usaremos
												contentType:false, //Debe estar en false para que pase el objeto sin procesar
												//data:dataString, //Le pasamos el objeto que creamos con los archivos
												data:data,
												processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
												cache:false //Para que el formulario no guarde cache
											}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
												
												$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
												$('.mensage_memo').show('slow');//Mostramos el div.
												
												//DESAPARECER
												setTimeout(function() {
													
													$(".mensage_memo").fadeOut(1500);
													
										
													$('#dar_respuesta').show();
													
													$('#fila_cargando_2').hide();
													
													
													//alert(msg);
													//var msgrespuesta = msg.split("-");
													
													//LIMPIAR CAMPOS VENTANA
													$('#resexpedigi').val('');
													
													//CAMPOS OCULTOS
													$('#idmemoexterno').val('');
													
													
													//CIERRO VENTANA
													//$("#exampleModal_5B").hide();
													
													//RECARGAR 
													location.href='index.php?controller=archivo&action=Solicitud_Visualizar_Expediente_Entidad';
													
													
													
													
													
												},3000);
												
											
											});					
						
					
					
					}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
					
					
					
				}//FIN if(nom_archivo == 0){
				
				
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	});
	
	
	
	//LISTA JUZGADO OCULTA, SOLO CUANDO SE DA CLIC PARA ESTADO 
	$('#paraestado').hide();
	
	//CAMPO PARA ACUMULADA OCULTO
	$('#paraacumulada').hide();
	 
	 
	$("#checkEstado").change(function () {
		  
		  
		  
		  if($("#checkEstado").is(':checked')) {  
		  
		  	$('#paraestado').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraestado').hide();
		  }
		
	});
	
	$("#checkdevo").change(function () {
		  
		  
		  
		  if($("#checkdevo").is(':checked')) {  
		  
		  	$('#paraestado').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraestado').hide();
		  }
		
	});
	
	$("#checkAcumulada").change(function () {
		  
		  
		  
		  if($("#checkAcumulada").is(':checked')) {  
		  
		  	$('#paraacumulada').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraacumulada').hide();
		  }
		
	});
	
	
	$(".acumular_proceso").click(function(evento){
	
	
	
		//PASOMOS VARIABLES PHP A JAVASCRIPT
		var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		
		var datosexp = id_radi+"******"+nradi;
	
		if($('#radiacu').val().length == 0) {
				
				alert("Definir Radicado a Acumular");
		
				document.getElementById('radiacu').style.borderColor  =  '#FF0000';
	
		
		}
		else{		
			
			if($('#radiacu').val().length == 23) {
			
				//$.get('funciones/traer_datos_radicado.php?idactu='+idactu+'&idusuarioX='+idusuarioX, function(idobs){	
				
				$.get('funciones/traer_datos_radicado.php?idradicado='+$('#radiacu').val(), function(datosradi){	
				
				
					var datosradi_1 = datosradi.split("//////");
					
					var datosradi_2 = datosradi_1[0];
				
					
					if(datosradi_2 >= 1){
						
						
						var data = new FormData();
									
						
						//DATOS RADICADO ACUMULADO AL PADRE
						data.append('idradiacumular',datosradi_2);
						data.append('radiacu',$('#radiacu').val());
						
						//DATOS RADICADO PADRE
						data.append('idradipadre',id_radi);
						data.append('nradi',nradi);
									
									
									
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
											
											
												
												
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
													
										//url:'views/popupbox/subir.php', //Url a donde la enviaremos
										url:'index.php?controller=archivo&action=Acumular_Proceso',
										type:'POST', //Metodo que usaremos
										contentType:false, //Debe estar en false para que pase el objeto sin procesar
										//data:dataString, //Le pasamos el objeto que creamos con los archivos
										data:data,
										processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
										cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
													
										$('.mensage_2').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
										$('.mensage_2').show('slow');//Mostramos el div.
													
										//DESAPARECER
										setTimeout(function() {
														
											$(".mensage_2").fadeOut(1500);
														
														
											location.href="index.php?controller=archivo&action=Expediente_Digital&datosexp="+datosexp;
														
														
														
										},3000);
													
												
							});
												
												
												
											
						}
						
						
					}
					else{
					
						alert("RADICADO NO EXISTE, NO ES POSIBLE REALIZAR LA ACUMULACION");
					
					}
					
				
				});
				
				
			}
			else{
			
					alert("EL RADICADO ACUMULAR DEBE SER DE 23 DIGITOS");
			
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
							idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d9R+"//////"+d10R+"******"+idspermisoR;
							
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
				
				//d9R  = document.getElementById("tsoli").rows[r].cells[9].innerText;//ID SERVIDOR
				//d9R = $('#servi'+fR).find(':selected').val();
				
				//d10R = document.getElementById("tsoli").rows[r].cells[10].innerText;//AREA
				//d10R = $('#area'+fR).val();
				
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
				var idusuarioX = "<?php echo $idusuario ; ?>";
				
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
				else{
				
				
				if( $('#cerrart'+idfila).val().length == 0  ){
								
					alert("Definri en el Campo Cerrar");
					
					//$('#cerrart'+idfila).val('');
				}
				else{		
				
				
				var data = new FormData();
				
				data.append('idactu',idactu);
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
				
				});
								 
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


	$('#exampleModal_5').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		var msg_respuesta
		
		if(recipient_2[5] == 1){
		
			msg_respuesta ="SIN PROCESAR";
		
			
		}
		else{
		
			msg_respuesta = recipient_2[3]+' '+recipient_2[4];
		}
		
		
		modal.find('.modal-title').text('ID SOLICITUD: '+ recipient_2[0] +' - FECHA ASIGNADA: '+msg_respuesta)
				
				
		
		
		var nombre_user_SESION = "<?php echo $nombre_user; ?>";
		
		
		//CAMPOS OCULTOS
		$('#idmemoexterno').val(recipient_2[0]);//ID SOLI
		

		//CARGA INFORMACION SI YA FUE PROCESADA LA FECHA ASIGNADA
		//Y DESEAN EDITARLA
		$('#flv').val('');
		$('#flv').val(recipient_2[2]);
		
		
		
	 
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_5B').on('show.bs.modal', function (event) {
	
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		var msg_respuesta
		
		if(recipient_2[5] == 3){
		
			msg_respuesta = recipient_2[3]+' '+recipient_2[4];
		}
		else{
		
			msg_respuesta ="SIN PROCESAR";
		}
		
		
		modal.find('.modal-title').text('ID SOLICITUD: '+ recipient_2[0] +' - DEVOLUCION PROCESADA: '+msg_respuesta)
				
				
		
		
		var nombre_user_SESION = "<?php echo $nombre_user; ?>";
		
		
		//CAMPOS OCULTOS
		$('#idmemoexterno').val(recipient_2[0]);//ID SOLI
		

		//CARGA INFORMACION SI YA FUE PROCESADA LA RESPUESTA
		//Y DESEAN EDITARLA
		$('#resexpedigi').val('');
		$('#resexpedigi').val(recipient_2[2]);
		
		
		
	 
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	
	
	
	$("#recargar_pro").click(function(evento){
	
		/*var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		var datosexp = id_radi+"******"+nradi;
		
		location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexp;*/
		
		location.href='index.php?controller=archivo&action=Solicitud_Visualizar_Expediente_Entidad';
	
	
	});
	
	$("#buscar_pro").click(function(evento){
	
			//alert("BUSCANDO...");
			
			//var id_radi = "<?php echo $id_radi; ?>";
			//var nradi   = "<?php echo $nradi; ?>";
			
			//var datosexp_2 = id_radi+"******"+nradi;
			
	
		
			if( 
				
			  	
			 	$('#filtro1').val().length   == 0 && 
				$('#filtro2').val().length   == 0 && 
				$('#filtro3').val().length   == 0 && 
				$('#filtro5').val().length   == 0 && 
				$('#filtro6').val().length   == 0 && 
				$('#filtro4').val().length   == 0 
				
			   
			) {
				
				alert("Definir Algun Filtro Para Realizar la Busquedad");
		
				
				document.getElementById('filtro1').style.borderColor  =  '#FF0000';
				document.getElementById('filtro2').style.borderColor  =  '#FF0000';
				document.getElementById('filtro3').style.borderColor  =  '#FF0000';
				document.getElementById('filtro5').style.borderColor  =  '#FF0000';
				document.getElementById('filtro6').style.borderColor  =  '#FF0000';
				document.getElementById('filtro4').style.borderColor  =  '#FF0000';
				
				
			}
			else{
				
				//alert("BUSCANDO...");
		
				dato_0 = 1;
						
				//FECHAS REGISTRO
				dato_1 = $('#filtro2').val(); 
				dato_2 = $('#filtro3').val();
						
				datox1 = $('#filtro1').val();
				datox4 = $('#filtro4').val();
				
				datox5 = $('#filtro5').val();
				datox6 = $('#filtro6').val();
				
						
				//alert(datox4);
						
				location.href="index.php?controller=archivo&action=Solicitud_Visualizar_Expediente_Entidad_Filtro&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
						
						
			}
		
		
	
	});
	
	/*$("#filtro2").click(function(event){
	
		//alert("1213");
		$("#filtro3").val('');
	});
	
	
	$("#filtro3").click(function(event){
	
		//alert("1213");
		$("#filtro2").val('');
	});*/
	
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
		
		
		//SE CAMBIA DE LA FORMA $(document).on("click",'.descarga_archivo',function (e) YA
		//QUE DE LA FORMA $(".descarga_archivo").click(function(evento)
		//AL PAGINAR LA TABLA SOLO AL CARGAR ARCHIVOS PDF FUNCIONA EN LA PAGINA 1
		//Y SE AGREGA e.preventDefault();
		$(document).on("click",'.descarga_archivo',function (e){
		//$(".descarga_archivo").click(function(evento){
	
			e.preventDefault();
		
			var idruta     = $(this).attr('data-idruta');
			var url        = idruta;
			
			//CARGAR PDF EN IFRAME
			$('#varchivo_1').show();
	 		$('#varchivo_2').show();
			document.getElementById('icontenido').src=url;
			
			
			
		});
		
		$(".ocultar_archivo").click(function(evento){
			
			$('#varchivo_1').hide();
	 		$('#varchivo_2').hide();
			
			document.getElementById('icontenido').src=" ";
			
		});
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	
	if(idtabla == 3){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('tsoliexpe');
				
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



</script>



<style type="text/css">

#mdialTamanio{
  width: 80% !important;
}
#mdialTamanio_3{
  width: 100% !important;
}
#mdialTamanio_5{
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
		
		.mensage_2{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
		.mensage_memo{
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

<?php 

//SIEMPRE 1, PARA QUE TODOS LOS USUARIOS
//DE LA OFICINA LO VEAN Y SOLO LAS OPCIONES INTERNAS
//SE PARAMETIZEN PARA USUARIOS ESPECIFICOS
$bandera_ADMIN_EXPE = 1;

if($bandera_ADMIN_EXPE == 1){

?>
<nav class="navbar navbar-default">

  <div class="container-fluid">
   
    
    <div class="collapse navbar-collapse">
      

      <ul class="nav navbar-nav navbar-left">
        
		
		
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
          
			 <li>
				
				<a class="glyphicon glyphicon-user" href="index.php?controller=usuario&action=Listar_Usuario_Menu" title="<?php echo utf8_decode("Administrar-Usuario"); ?>">
						
						
						<?php echo utf8_decode("Administrar-Usuario");?>
						
						
				</a>
				
			</li>
			
			
			<!-- <li role="separator" class="divider"></li>
			
			<li> -->
				<?php 
				
					//SE OBTIENEN LAS SOLICITUDES DE EXPEDIENTES A DIGITALIZAR
					/*$datos_SOLICITUDES = $modelo->get_SOLICITUD_DIGITALIZAR();
					$cadena_soli       ="";
					$cont_soli         = 0;
					
					while($fila_soli = $datos_SOLICITUDES->fetch()){
				
						$ds1  = $fila_soli[id];
						$ds2  = $fila_soli[radicado];
						$ds3  = $fila_soli[empleado];
						$ds4  = $fila_soli[fecha];
						$ds5  = $fila_soli[hora];
						$ds6  = $fila_soli[esabogado];
						$ds7  = $fila_soli[correo];
						$ds8  = $fila_soli[idradicado];
						
						$cadena_soli .= $ds1."//////".$ds2."//////".$ds3."//////".$ds4."//////".$ds5."//////".$ds6."//////".$ds7."//////".$ds8."******";
						
						$cont_soli = $cont_soli + 1;
					}*/
					
				?>
				<!-- <a class="glyphicon glyphicon-list" href="javascript:void(0);" title="Solicitud Digitalizacion" data-toggle="modal" data-target="#exampleModal_3" data-whatever="<?php //echo $cadena_soli."*/*/*".$cont_soli;?>">
				
					Solicitud-Digitalizacion
		
				</a> 
			
			</li> -->
			
			<li role="separator" class="divider"></li>
			
			<li>	
				
				<a class="glyphicon glyphicon-list" href="index.php?controller=archivo&amp;action=Solicitud_Digitalizacion" title="Solicitud Digitalizacion">
				
					Solicitud-Digitalizacion
			
				</a> 
				
			</li>
			
			<?php
			if($bandera_ADMIN_MEMO == 1){
			?>
			<li role="separator" class="divider"></li>
			<?php
			}
			?>
			
			<li>	
				<?php
				if($bandera_ADMIN_MEMO == 1){
				?>
				
				
				
				<a class="glyphicon glyphicon-align-justify" href="index.php?controller=archivo&amp;action=Memoriales_Externos_Radicados" title="Memoriales-Radicados">
				
					Memoriales-Radicados
					
					
				</a> 
				
				<?php
				}
				?>
				
			</li>
			
			<?php
			if($bandera_ADMIN_MEMO == 1){
			?>
			<li role="separator" class="divider"></li>
			<?php
			}
			?>
			
			<li>	
				<?php
				if($bandera_ADMIN_MEMO == 1){
				?>
				
				
				
				<a class="glyphicon glyphicon-list-alt" href="index.php?controller=archivo&amp;action=Memoriales_Entidad_Radicados" title="Memoriales-Radicados_Entidad">
				
					Memoriales-Radicados_Entidad
					
					
				</a>  
				
				<?php
				}
				?>
				
			</li>
			
			<?php
			if($bandera_ADMIN_TITULO == 1){
			?>
			<li role="separator" class="divider"></li>
			<?php
			}
			?>
			
			<li>	
				<?php
				if($bandera_ADMIN_TITULO == 1){
				?>
				
				
				
				<a class="glyphicon glyphicon-calendar" href="index.php?controller=archivo&amp;action=Programacion_Consulta_Titulos" title="Programacion-Pago-y-Consulta-de-Titulos">
				
					Programacion-Pago-y-Consulta-de-Titulos
					
					
				</a> 
				
				<?php
				}
				?>
				
			</li>
			
			<li role="separator" class="divider"></li>
			
			
			<li>	
				
				<a class="glyphicon glyphicon-registration-mark" href="index.php?controller=archivo&amp;action=Consulta_PQR" title="PQR(S)">
				
					PQR
			
				</a> 
				
			</li>
			
			<?php
			if($bandera_54 == 1){
			?>
			<li role="separator" class="divider"></li>
			
			<li>	
				
				<a class="glyphicon glyphicon-th-list" href="index.php?controller=archivo&amp;action=Solicitud_Visualizar_Expediente_Entidad" title="Solicitud-Visualizar-Expediente-Entidad-Terceros">
				
					Solicitud-Visualizar-Expediente-Entidad-Terceros
			
				</a> 
				
			</li>
			<?php
			}
			?>
			
			
           
          </ul>
		  
        </li>
		
      </ul>
	  
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

<?php 
}
?>

<!-- FIN MENU HORIZONTAL -->




<center><h2 class="page-header">SOLICITUD VISUALIZAR EXPEDIENTE ENTIDAD TERCEROS</h2></center>


<!-- <div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=archivo&action=Expediente_Digital" title="Regresar">
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div> -->


<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header"  style="color:#0033FF">FILTROS PARA BUSQUEDA</h4>
	
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

<br>

<!-- FILTROS -->

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->

<table id="tabla_filtros" class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-6">
				  <label for="input_1">RADICADO</label>
				  <input type="number" class="form-control" name="filtro1" id="filtro1" value="<?php echo trim($_GET['datox1']); ?>" placeholder="Ingrese Radicado">
				</div>
				
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	<tr>
															
		<td>
				
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
			
		</td>
		
		
			
	</tr> 
	
	
	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-6">
				  <label for="input_1">Documento</label>
				  <input type="text" class="form-control" name="filtro5" id="filtro5" value="<?php echo trim($_GET['datox5']); ?>" placeholder="Ingrese Documento">
				</div>
				
				<div class="form-group col-md-6">
				  <label for="input_1">Nombre Solicita</label>
				  <input type="text" class="form-control" name="filtro6" id="filtro6" value="<?php echo trim($_GET['datox6']); ?>" placeholder="Ingrese Nombre Solicita">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	<tr>
															
		
		<td>
				
			<div class="form-row">
	  
		
				<div class="form-group col-md-6">
		
					  <label for="input_3">Estado Solicitud</label>
					 
					  <select class="form-control" name="filtro4" id="filtro4">
																
						<option value="" selected="selected">Seleccionar Estado Solicitud</option> 
						
						<?php
						if(trim($_GET['datox4']) == 1){
						
						?>
							<option value="1" selected="selected">En Proceso</option> 
							<option value="2">Con Fecha Limite Asignada</option>  
							<option value="3">Devolucion</option> 
						<?php	
						}
						elseif(trim($_GET['datox4']) == 2){
						
						?>
							<option value="1">En Proceso</option>  
							<option value="2" selected="selected">Con Fecha Limite Asignada</option> 
							<option value="3">Devolucion</option> 
						<?php	
						}
						elseif(trim($_GET['datox4']) == 3){
						?>
						
							<option value="1">En Proceso</option>  
							<option value="2">Con Fecha Limite Asignada</option>
							<option value="3"selected="selected">Devolucion</option> 
						<?php	
						}
						else{
						?>
						
							<option value="1">En Proceso</option>  
							<option value="2">Con Fecha Limite Asignada</option> 
							<option value="3">Devolucion</option> 
						
						<?php	
						}
						?>
						
					</select>
				  
				  
				</div>
				
				
				
				
			</div>
			
		</td>
		
		
			
	</tr>  

	
	<!-- <tr>
															
		
		<td>
				
			<div class="form-row">
	  
		
				<div class="form-group col-md-6">
		
					  <label for="input_3">Tipo</label>
					 
					  <select class="form-control" name="filtro6" id="filtro6">
																
						<option value="" selected="selected">Seleccionar Tipo</option> 
						
						<option value="P">PROGRAMACION PAGO DE TITULOS</option> 
						<option value="C">CONSULTA DE TITULOS</option> 
																			
						
					</select>
				  
				  
				</div>
				
				
				
				
			</div>
			
		</td>
		
		
			
	</tr>   -->
	
	
	
</table> 

</div>

<!-- FIN FILTROS -->

<br>


<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->

<table class="table"> 


	<tr>
															
		
		
		<td>
		
			<center>
			<h4 class="page-header" style="color:#0033FF">
				NUMERO DE REGISTROS: <?php echo $cantregis; ?>
			</h4>
			</center>
			
			

			
		</td>
		
		
	</tr> 
	
	
</table>


<!-- MENSAJES -->
<!-- <table class="table"> 

	<tr>
		<td colspan="2">
			
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	
</table> -->

<!-- <table class="table" align="center"> 

	<tr>
		<td>
			ARCHIVO
		</td>
										
	</tr>
	<tr>
		<td>
			<iframe id="icontenido"></iframe>
		</td>
										
	</tr>
		
</table> -->

<table class="table table-striped table-bordered table table-hover" id="tsoli">
    <thead>
        <tr class="success">
            
        	<!-- <th style="width:30px; text-align:center">N</th> -->
			<th style="width:120px; text-align:center">IDSOLI</th>
			<th style="width:120px; text-align:center">IDRADI</th>
			<th style="width:120px; text-align:center">RADICADO</th>
			<th style="width:120px; text-align:center">DOCUMENTO</th>
			<th style="width:120px; text-align:center">SOLICITA</th>
			<th style="width:120px; text-align:center">FECHA</th>
			<th style="width:120px; text-align:center">HORA</th>
			<th style="width:120px; text-align:center">CORREO</th>
			<th style="width:120px; text-align:center">PARA REMATE</th>
			<th style="width:120px; text-align:center">ASIGNAR FECHA LIMITE</th>
			<th style="width:120px; text-align:center">DEVOLUCION</th>
            
        </tr>
    </thead>
    
  
	<?php
											
			$Ct110=1;
			
			$contador_registros = 1;
			
			while($fila = $datosACCION_1->fetch()){
				
				$d0M  = $fila[id];
				$d1M  = $fila[radicado];
				$d2M  = $fila[empleado];
				$d3M  = $fila[fecha];
				$d4M  = $fila[hora];
				//$d5M  = $fila[esabogado];
				$d6M  = $fila[correo];
				$d7M  = $fila[idradicado];
				
				$d8M  = $fila[respuesta];
				$d9M  = $fila[fecha_res];
				$d10M = $fila[hora_res];
				$d11M = $fila[bandera_res];
				$d12M = $fila[idusuario_res];
				
				//SE DEJA POR SI SE PIDE QUE CUANDO SE ASIGNE FECHA LIMITE
				//SE PIDA SUBIR UN ARCHIVO
				//$d13M = $fila[ruta_respuesta];
				
				$d14M = $fila[nombre_usuario];
				
				$d15M = $fila[experemate];
				
				$d16M = $fila[fecha_visual];
				
		?>
    
    
        <tr>
           
		   
			
				<!-- <td style="width:30px;"> 
							
					<?php //echo $contador_registros; //NUMERO REGISTRO ?>
							
				</td> -->
				
				<td style="width:30px; text-align:center"> 
			
					<?php echo $d0M; //id?>
				
				</td>
			
			
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d7M; //id radicado?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					
					<?php echo $d1M; //radicado?>
						
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo utf8_encode($d14M); //documento?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo utf8_encode($d2M); //solicita?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d3M; //fecha?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d4M; //hora?>
				
				</td>
				
	
				<td style="width:120px; text-align:center"> 
			
					<?php echo utf8_encode($d6M); //correo?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php 
						
					
					//PARA REMATE
					if($d15M == "SI"){
					
						echo $d15M;
	
					}
					
					//NO REMATE
					if($d15M == "NO"){
					
						echo $d15M;
					
					
					
					}
					
					?>
					
					
					
				</td>
				
				
				<?php 
				//SOLICITUD EN PROCESO
				if($d11M == 1){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_5" data-whatever="<?php echo $d0M."*/*/*".$d7M."*/*/*".$d16M."*/*/*".$d9M."*/*/*".$d10M."*/*/*".$d11M; ?>">
								
						<span class="glyphicon glyphicon-calendar"></span><br>Asignar Fecha Limite
								
					</button>
					
					
							
				</td>
				
				<?php 
				}
				?>
				
				<?php 
				//ESTADO FECHA ASIGNADA A LA SOLICITUD, PROCESADA
				if($d11M == 2){
				
					
				?>
				
				<td style="width:120px; text-align:center"> 
					
					
					<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal_5" data-whatever="<?php echo $d0M."*/*/*".$d7M."*/*/*".$d16M."*/*/*".$d9M."*/*/*".$d10M."*/*/*".$d11M; ?>">
								
						<span class="glyphicon glyphicon-calendar"></span><br>Fecha Asignada
								
					</button>
		
							
				</td>
				
				<?php 
				}
				?>
				
				<?php 
				//SOLICITUD DEVUELTA
				if($d11M == 3){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					<?php 
						$msg_memo = "SOLICITUD DEVUELTA";
					?>
								
						<button type="button" class="btn btn-danger btn-xs"><?php echo $msg_memo; ?></button>
							
				</td>
				
				<?php 
				}
				?>
				
				<?php 
				//YA FUE PROCESADA LA SOLICITUD
				//NO ES POSIBLE REALIZAR LA DEVOLUCION
				if($d11M == 2){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					-
							
				</td>
				
				<?php 
				}else{
				?>
				
				<td style="width:120px; text-align:center"> 
							
					<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal_5B" data-whatever="<?php echo utf8_encode($d0M."*/*/*".$d7M."*/*/*".$d8M."*/*/*".$d9M."*/*/*".$d10M."*/*/*".$d11M); ?>">
								
						<span class="glyphicon glyphicon-hand-left"></span><br>Devolucion Solicitud
								
					</button>
							
				</td>
				
				<?php 
				}
				?>
				
				
				
				
				
        </tr>
		
    <?php  $contador_registros = $contador_registros + 1;  $Ct110=$Ct110+1; }  ?>
	
	
		<tr id="varchivo_1">
		
			<td align="center" colspan="13">
				
				
				<button type="button" class="btn btn-danger btn-primary ocultar_archivo">ARCHIVO / Clic Para Ocultar Archivo</button>
				
			</td>
											
		</tr>
		<tr id="varchivo_2">
			<td align="center" colspan="13">
				<iframe id="icontenido" width="800" height="800"></iframe>
			</td>
											
		</tr>	
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 



<!-- VENTANAS MODALES -->


<!-- VENTANA ASIGNAR FECHA -->

<div class="modal fade" id="exampleModal_5" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ASIGNAR FECHA LIMITE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				<tr style="border-style:hidden ">
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr>
																	
					<td>
							
						<div class="form-row">
						
							<div class="form-group col-md-4">
					
								<br>
								<label for="input_1">Fecha Limite Visualizacion</label>
								<br>
				 				<input type="text" class="form-control" name="flv" id="flv" placeholder="Fecha Limite Visualizacion">
								  
							</div>
							
							
							
						</div>
						
					</td>
				
				
					
				</tr> 
				
				
				<tr>
				
					<td>
					
						<a id="asignar_fecha_limite" title="ASIGNAR FECHA LIMITE">
						
							<button type="button" class="btn btn-primary" title="ASIGNAR FECHA LIMITE">
								<span class="glyphicon glyphicon-floppy-saved"></span><h4>ASIGNAR FECHA LIMITE</h4>
							</button>
						
						</a>
						
						
					</td>
					
				</tr>
				
				<tr>
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr id="fila_cargando" align="center">
				
					<td>
						<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
					</td>
													
				</tr>
				
				<tr>
				
					<td>
					
					
								 <!-- CAMPOS OCULTOS -->
								  <br>
								  <input type="hidden" class="form-control" name="idmemoexterno" id="idmemoexterno" readonly="true">
								  
					</td>
				
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


<div class="modal fade" id="exampleModal_5B" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DEVOLUCION SOLICITUD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				<tr style="border-style:hidden ">
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr>
																	
					<td>
							
						<div class="form-row">
						
							<div class="form-group col-md-4">
							
								  
								
								  <br>
								  <label for="comment">Respuesta:</label>
								  <br>
								  <textarea name="resexpedigi" id="resexpedigi" cols="90" rows="10" maxlength = "1000000" ></textarea>
								  
								 
								  
							</div>
							
							
							
						</div>
						
					</td>
				
				
					
				</tr> 
				
				<!-- <tr>
																	
					<td>
							
						<div class="form-row">
						
							
							<div class="form-group col-md-4">
							 
							 
								<?php 
							 	//$msg_memo = "(OPCIONAL) EL NOMBRE DEL ARCHIVO DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO PDF"."<br>"."MANEJAR NOMBRES CORTOS Y REFERENTE A LO QUE SE DESEA CARGAR"."<br>"."NO ARCHIVOS MULTIMEDIA";
							 	?>
								
								<button type="button" class="btn btn-info btn-xs" style="color:#000000"><?php //echo $msg_memo; ?></button>
								
								<br>
								<br>
								  <label for="comment">Archivo:</label>
								<br>
								
							 	<input type="file" name="archivomemoB" id="archivomemoB" size="19" placeholder="Ingrese pdf"/>
										 
							 								
							</div>
							
							
							
						</div>
						
					</td>
				
				
					
				</tr>  -->
				
				
				<tr>
				
					<td>
					
						<a id="dar_respuesta" title="DEVOLUCION">
						
							<button type="button" class="btn btn-primary" title="DEVOLUCION">
								<span class="glyphicon glyphicon-floppy-saved"></span><h4>REGISTRAR</h4>
							</button>
						
						</a>
						
						
					</td>
					
				</tr>
				
				<tr>
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr id="fila_cargando_2" align="center">
				
					<td>
						<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
					</td>
													
				</tr> 
				
				<tr>
				
					<td>
					
					
								 <!-- CAMPOS OCULTOS -->
								  <br>
								  <input type="hidden" class="form-control" name="idmemoexterno" id="idmemoexterno" readonly="true">
								  
					</td>
				
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
