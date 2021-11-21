
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
	
	
	$idusuario         = $_SESSION['idUsuario'];
	
	$identidad_user    = $_SESSION['nomusu'];
	$nombre_user       = $_SESSION['nombre'];
	$nivelusuario_user = trim($_SESSION['nivelusuario']);
	
	
	//LISTA BASE DE DATOS LOCAL
	
	$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosLISTA1  = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'pa_solicitud';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosLISTA2  = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	/*$nombrelista  = 'expe_cuaderno';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosLISTA3  = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	if($opcion == 1){
	
		$datoJXX1 = trim($_GET['datox1']);//radicado
		
		$datoJXX3 = trim($_GET['dato_1']);//fecha registro inicial
		$datoJXX5 = trim($_GET['dato_2']);//fecha registro final
		
		$datoJXX2 = trim($_GET['datox2']);//docuemnto
		$datoJXX4 = trim($_GET['datox4']);//nombre
		
		$datoJXX6 = trim($_GET['datox6']);//Estado Memorial

		$datosACCION_1 = $modelo->listar_memoriales_radicados_filtro_entidades($datoJXX1,$datoJXX3,$datoJXX5,$datoJXX2,$datoJXX4,$datoJXX6);
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->listar_memoriales_radicados_filtro_entidades($datoJXX1,$datoJXX3,$datoJXX5,$datoJXX2,$datoJXX4,$datoJXX6);
			
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
			
			$fc = $fc + 1; 
		
		}
			
		$cantregis = $fc;
			
		//*************************************************************************************
			
			

	}//FIN if($opcion == 1){
	else{
	
		$datosACCION_1 = $modelo->listar_memoriales_radicados_entidades();
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->listar_memoriales_radicados_entidades($datoJXX1);
			
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



	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPA�OL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','S�b'],
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
	 
	 $("#filtro3").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 $("#filtro5").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
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
		
		//ADICIONADO EL 15 DE ABRIL 2021
		//CAPTURAMOS EL nombre_archivo DE LA TABLA pa_solicitud
		//PARA RENOMBRAR EL ARCHIVO RADICADO POR LOS ABOGADOS
		//POR LA PLATAFORMA PUBLICACIONES 
		
		var nombre_real_archivo = id.split("-");
		
		$("#text_lista_na").val('');
		$("#text_lista_na").val(nombre_real_archivo[2]);
	
		
    });
	
	$("#radicar_memorial").click(function(evento){
	
	
		var dataString = "";
		var validar    = 0;
		
		
		if( $('#tipo_documento ').val() == null || $('#tipo_documento ').val().length == 0 || /^\s+$/.test($('#tipo_documento ').val()) ) {
				
			msg = "Defina Tipo Docuemnto";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&dmemo1='+$("#tipo_documento ").val();
					
		}
		
		if( $('#juzgadodestino').val() == null || $('#juzgadodestino').val().length == 0 || /^\s+$/.test($('#juzgadodestino').val()) ) {
				
			msg = "Defina Juzgado Destino";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&juzgadodestino ='+$("#juzgadodestino ").find(':selected').val();
					
		}
		
		if( $('#solicitud').val() == null || $('#solicitud').val().length == 0 || /^\s+$/.test($('#solicitud').val()) ) {
				
			msg = "Defina Tipo Solicitud";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&solicitud='+$("#solicitud").find(':selected').val();
					
		}
		
		if( $('#peticionario').val() == null || $('#peticionario').val().length == 0 || /^\s+$/.test($('#peticionario').val()) ) {
				
			msg = "Defina peticionario";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&peticionario='+$("#peticionario").val();
					
		}
		
		if( $('#folios').val() == null || $('#folios').val().length == 0 || /^\s+$/.test($('#folios').val()) ) {
				
			msg = "Defina Folios";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&folios='+$("#folios").val();
					
		}
		
		if( $('#recibe').val() == null || $('#recibe').val().length == 0 || /^\s+$/.test($('#recibe').val()) ) {
				
			msg = "Defina Recibe";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&recibe='+$("#recibe").val();
					
		}
		
		//EXPEDIENTE ESTA DIGITALIZADO, SE PIDE QUE SE DEFINA CUADERNO Y A DESPACHO
		if( $('#digital').val() == 1 && $('#digital_2').val() >= 1){
		
			if( $('#cuaderno').val() == null || $('#cuaderno').val().length == 0 || /^\s+$/.test($('#cuaderno').val()) ) {
				
				msg = "Defina Cuaderno";
				$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_memo').show('slow');
						
				setTimeout(function() {
					$(".mensage_memo").fadeOut(4000);
				},10000);
						
				validar = 1;
						
				return false;
						
			}
			else{
			
				dataString += '&cuaderno='+$("#cuaderno").find(':selected').val();
						
			}
			
			if( $('#a_despacho').val() == null || $('#a_despacho').val().length == 0 || /^\s+$/.test($('#a_despacho').val()) ) {
				
				msg = "Defina A Despacho";
				$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_memo').show('slow');
						
				setTimeout(function() {
					$(".mensage_memo").fadeOut(4000);
				},10000);
						
				validar = 1;
						
				return false;
						
			}
			else{
			
				dataString += '&a_despacho='+$("#a_despacho").find(':selected').val();
						
			}
			
		
		}
		
		if( $('#correo').val() == null || $('#correo').val().length == 0 || /^\s+$/.test($('#correo').val()) ) {
				
			msg = "Defina Correo";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&correo='+$("#correo").val();
					
		}
		
		if( $('#telefono').val() == null || $('#telefono').val().length == 0 || /^\s+$/.test($('#telefono').val()) ) {
				
			msg = "Defina Celular";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&telefono='+$("#telefono").val();
					
		}
		
		if( $('#archivomemo').val() == null || $('#archivomemo').val().length == 0 || /^\s+$/.test($('#archivomemo').val()) ) {
				
			msg = "Defina Memorial";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&archivomemo='+$("#archivomemo").val();
					
		}
		
		
		
		//CAMPOS OCULTOS
		
		if( $('#radicado').val() == null || $('#radicado').val().length == 0 || /^\s+$/.test($('#radicado').val()) ) {
				
			msg = "Defina radicado (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&radicado='+$("#radicado").val();
					
		}
		//ID RADICADO
		if( $('#nombre').val() == null || $('#nombre').val().length == 0 || /^\s+$/.test($('#nombre').val()) ) {
				
			msg = "Defina Id radicado (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&nombre='+$("#nombre").val();
					
		}
		
		if( $('#idjuzgado').val() == null || $('#idjuzgado').val().length == 0 || /^\s+$/.test($('#idjuzgado').val()) ) {
				
			msg = "Defina Juzgado Origen (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
						
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
						
			validar = 1;
						
			return false;
						
		}
		else{
			
			dataString += '&idjuzgado='+$("#idjuzgado").find(':selected').val();
						
		}
		
		//ID MEMORIAL
		if( $('#idmemoexterno').val() == null || $('#idmemoexterno').val().length == 0 || /^\s+$/.test($('#idmemoexterno').val()) ) {
				
			msg = "Defina Id Memorial (CAMPO OCULTO)";
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
		
		
		if( $('#cedula').val() == null || $('#cedula').val().length == 0 || /^\s+$/.test($('#cedula').val()) ) {
				
			msg = "Defina Cedula (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&cedula='+$("#cedula").val();
					
		}
		
		if( $('#id_memo_peticionario').val() == null || $('#id_memo_peticionario').val().length == 0 || /^\s+$/.test($('#id_memo_peticionario').val()) ) {
				
			msg = "Defina id memo peticionario (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&id_memo_peticionario='+$("#id_memo_peticionario").val();
					
		}
		
		//FECHA DE CREACION
		if( $('#fecha_crem').val() == null || $('#fecha_crem').val().length == 0 || /^\s+$/.test($('#fecha_crem').val()) ) {
				
			msg = "Defina Fecha de Creacion (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&fecha_crem='+$("#fecha_crem").val();
					
		}
		
		//CAMPO PARA RENOMBRAR EL ARCHIVO RADICADO POR LAS ENTIDADES
		//DESDE LA PLATAFORMA PUBLICACIONES
		if( $('#text_lista_na').val() == null || $('#text_lista_na').val().length == 0 || /^\s+$/.test($('#text_lista_na').val()) ) {
				
			msg = "Defina Campo Para Renombrar Archivo (CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&text_lista_na='+$("#text_lista_na").val();
					
		}
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
			
			var inputFileImage = document.getElementById("archivomemo");
			var file           = inputFileImage.files[0];
						
			//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivodda'
			var archivos = document.getElementById("archivomemo");
						
			//Obtenemos los archivos seleccionados en el imput
			var archivo  = archivos.files;
						
			//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
			//Y EL RESTO DE CAMPOS VIA POST			
			var data = new FormData();
						
					
			//VALIDAR ARCHIVO, SOLO PERMITE NOMBRES CON NUMEROS,LETRAS Y TODO PEGADO,
			//NO PERMITE NOMBRES CON ACENTOS, ESPACIOS Y CON CARACTERES ESPECIALES 
			var nom_archivo  = 0;
			
			var caracter       = "";
			var caracter2      = "";
			var nombre_archivo = "";
						
			var nombre_archivo_2 = "";
			var tipo_archivo     = "";
			
			var contador_punto   = 0;			
						
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
						
						//VALIDA QUE EL NOMBRE SOLO TENGA UN PUNTO, EL DE LA EXTENSION
						if(caracter == 46){
							contador_punto = contador_punto + 1; 
						}		
						if(contador_punto >= 2){
						
								nom_archivo = 1;
											 
								$('#archivomemo').val('');
											
								i = archivo.length;
											
								x = nombre_archivo.length;
								
								contador_punto = 0;	
								
								alert("EL NOMBRE DEL ARCHIVO CUENTA CON DOS O MAS PUNTOS, NOMBRE NO VALIDO, NOMBRE ARCHIVO: "+nombre_archivo+", TIPO ARCHIVO: "+tipo_archivo);
								
									
						
						}	 
		
						//alert(caracter+" "+caracter2);
									 
							
						if( 
										
									 	 
								(caracter >= 32 && caracter <= 45)   ||
								(caracter >= 47 && caracter <= 47)   || 
								(caracter >= 58 && caracter <= 64)   || 
								(caracter >= 91 && caracter <= 96)   || 
								(caracter >= 123 && caracter <= 254)  
									     
						 ) {
										
										
								nom_archivo = 1;
											 
								$('#archivomemo').val('');
											
								i = archivo.length;
											
								x = nombre_archivo.length;
											
				 				contador_punto = 0;	
								
								alert("CARACTER NO PERMITIDO EN EL NOMBRE DEL MEMORIAL, EL NOMBRE DEL MEMORIAL DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO PDF, NOMBRE ARCHIVO: "+nombre_archivo+", TIPO ARCHIVO: "+tipo_archivo);
								//return false;
										  
										 
							} 
									 
					}//FIN for (var x = 0; x<nombre_archivo.length; x++) {
								
								
				}//FIN if(tipo_archivo == 'application/pdf'){
				else{
							
						nom_archivo = 1;
										 
						$('#archivomemo').val('');
										
						i = archivo.length
								
						contador_punto = 0;	
							 
						alert("ARCHVIO DEBE SER PDF, NOMBRE ARCHIVO: "+nombre_archivo_2+", TIPO ARCHIVO: "+tipo_archivo);
										
							
				}
							
				if(nom_archivo == 0){
							
					data.append('archivo'+i,archivo[i]); //A�adimos cada archivo a el arreglo con un indice direfente
					
					contador_punto = 0;	
				}
				
				
			}//FIN for(i=0; i<archivo.length; i++){
			
			//-----------------FIN VALIDAMOS QUE LOS ARCHIVOS SEAN PDF Y NO TENGAN ESPACIOS Y CARACTERES RAROS EN SUS NOMBRES---------------------------------
			
						
			//AL CARGAR LOS ARCHIVOS NO SE PRESENTO NINGUNA INCONSISTENCIA		
			if(nom_archivo == 0){
			
			
				data.append('tipo_documento',$('#tipo_documento').val());
				data.append('juzgadodestino',$('#juzgadodestino').val());
				data.append('solicitud',$('#solicitud').val());
				data.append('peticionario',$('#peticionario').val());
				data.append('folios',$('#folios').val());
				data.append('recibe',$('#recibe').val());
				data.append('cuaderno',$('#cuaderno').val());
				data.append('a_despacho',$('#a_despacho').val());
				data.append('correo',$('#correo').val());
				data.append('telefono',$('#telefono').val());
				data.append('observacionesm',$('#observacionesm').val());
				
				//CAMPOS OCULTOS
				data.append('nombre',$('#nombre').val());
				data.append('radicado',$('#radicado').val());
				data.append('idmemoexterno',$('#idmemoexterno').val());
				data.append('idjuzgado',$('#idjuzgado').val());
				data.append('digital',$('#digital').val());
				data.append('text_lista_ts',$('#text_lista_ts').val());
				data.append('text_lista_na',$('#text_lista_na').val());
				data.append('cedula',$('#cedula').val());
				data.append('cedula',$('#cedula').val());
				data.append('id_memo_peticionario',$('#id_memo_peticionario').val());
				data.append('fecha_crem',$('#fecha_crem').val());
				
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
										//OCULTAMOS BOTON REGISTRAR
										//PARA EVITAR QUE EL USUARIO DE CLIC
										//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
										$('#radicar_memorial').hide();
															
										$('#fila_cargando').show();
					
					
										//Ejecutamos la funci�n ajax de jQuery		
										$.ajax({
											
											//url:'views/popupbox/subir.php', //Url a donde la enviaremos
											url:'index.php?controller=archivo&action=Radicar_Memorial_Entidad',
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
												
									
												$('#radicar_memorial').show();
												
												$('#fila_cargando').hide();
												
												
												//alert(msg);
												//var msgrespuesta = msg.split("-");
												
												//LIMPIAR CAMPOS VENTANA
												$('#tipo_documento').val('');
												$('#juzgadodestino').val('');
												$('#solicitud').val('');
												$('#peticionario').val('');
												$('#folios').val('');
												$('#recibe').val('');
												$('#cuaderno').val('');
												$('#a_despacho').val('');
												$('#correo').val('');
												$('#telefono').val('');
												$('#observacionesm').val('');
												
												//CAMPOS OCULTOS
												$('#nombre').val('');
												$('#radicado').val('');
												$('#idmemoexterno').val('');
												$('#idjuzgado').val('');
												$('#digital').val('');
												$('#text_lista_ts').val('');
												$('#archivomemo').val('');
												$('#cedula').val('');
												$('#cedula').val('');
												$('#id_memo_peticionario').val('');
												
												
												//CIERRO VENTANA
												//$("#exampleModal_5").hide();
												
												//RECARGAR 
												location.href='index.php?controller=archivo&action=Memoriales_Entidad_Radicados';
												
												
												
												
												
											},3000);
											
										
										});					
					
				
				
				}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
				
			}//FIN if(nom_archivo == 0){
		
		
		
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	}); 
	 
	$('#exampleModal_2').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ARCHIVOS MEMORIAL: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		

	  	var registro;
		var nomarchivo;
		var ruta_descarga;
		
		ruta_descarga = new Array(); 
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expe_archivos_memorial_entidad.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			var ruta_archivo_pdf = "";
			
			for(var i=0;i<json.length;i++)
			{
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
				
				ruta_archivo_pdf = json[i].ruta;
				
				//ruta_descarga = nomarchivo[0]+"/"+nomarchivo[1]+"/"+nomarchivo[2]+"/"+nomarchivo[3]+"******"+ruta_descarga;
				
				ruta_descarga[i] = nomarchivo[0]+"/"+nomarchivo[1]+"/"+nomarchivo[2]+"/"+nomarchivo[3]+"/"+nomarchivo[4];
				
				//alert(decodeURIComponent(escape(json[i].ruta)));
				
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].id_entidad_memo+"</td>"
					registro+="<td class='idda'>"+nomarchivo[4]+"</td>"
					registro+="<td class='ruta'><a href=http://"+servidor+"/publicaciones/"+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
					
					//PARA CARGAR EL IFRAME, AUN NO ME FUNCIONA EL EVENTO
					//registro+="<td class='darchivo'><a class='descarga_archivo' href='javascript:void(0)' title="+ nomarchivo[4] +" data-idruta= 'http://"+servidor+"/publicaciones/"+json[i].ruta+"'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
					//registro+="<td class='ruta'><a onClick='descarga_archivo_memo("+ ascii +")' href='javascript:void(0)' title="+ nomarchivo[4] +"><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
			registro+="<tr>"
						
				
				//registro+="<td align='center' colspan = 4 class='ruta_descarga'><a href='index.php?controller=archivo&amp;action=Descargar_Multiples_Archivos_Entidad&ruta_descarga="+ruta_descarga.join()+"'><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-download-alt'></span>Descargar todos los Archivos</button></a></td>"
				
				
				registro+="<td align='center' colspan = 4 class='ruta_descarga'><a href= 'http://"+servidor+"/publicaciones/index.php?controller=archivo&amp;action=Descargar_Multiples_Archivos_Entidad&ruta_descarga="+ruta_descarga.join()+"'><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-download-alt'></span>Descargar todos los Archivos</button></a></td>"
				
				
			registro+="</tr>"
			
			$('.editinplace_2').append(registro);
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_2').on('show.bs.modal', function (event) {
	
	
	
	$('#exampleModal_asunto_mex').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		modal.find('.modal-title').text('ID MEMORIAL: '+ recipient_2[0] +' - EXPEDIENTE: ' + recipient_2[1])
				
		
	  	//modal.find('.modal-body input').val(recipient)
		
		$('#asunto_mex').val('');
		$('#asunto_mex').val(recipient_2[2]);
		
		
	
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	$('#exampleModal_17').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		modal.find('.modal-title').text('RESPUESTA DEVOLUCION MEMORIAL, ID MEMORIAL: '+recipient_2[4]+" EXPEDIENTE: "+recipient_2[5])
		
		$('#respuesta_devo').val('');
		$('#respuesta_devo').val("FECHA: "+recipient_2[2]+" HORA: "+recipient_2[3]+" / "+recipient_2[0]);
		
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_5').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		if(recipient_2[5] == 1 && recipient_2[13] >= 1){
		
	  		modal.find('.modal-title').text('RADICAR MEMORIAL EXPEDIENTE: ' + recipient_2[0] +' / EXPEDIENTE ESTA DIGITALIZADO')
		}
		else{
			modal.find('.modal-title').text('RADICAR MEMORIAL EXPEDIENTE: ' + recipient_2[0] +' / EXPEDIENTE NO ESTA DIGITALIZADO')
		}
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	
		var nombre_user_SESION = "<?php echo $nombre_user; ?>";
		
		
		$('#tipo_documento').val('Memorial');
		$('#peticionario').val(recipient_2[2]);
		$('#folios').val(recipient_2[4]);
		$('#recibe').val(nombre_user_SESION);
		$('#cuaderno').html('');
		$("#cuaderno").load('funciones/traer_datos_lista.php?id='+recipient_2[1]+"&idsql="+8);
		$('#correo').val(recipient_2[6]);
		$('#telefono').val(recipient_2[12]);
		$('#cedula').val(recipient_2[10]);
		$('#juzgadodestino').val(recipient_2[11]);
		
		/*var d7M_AX = recipient_2[9].split("/");
		var d7M_BX = d7M_AX[3];//nombre archivo
		$('#archivomemo_2').val(d7M_BX);//VISUAL PARA EL USUARIO
		$('#archivomemo').val(recipient_2[9]);*///OCULTO, RUTA COMPLETA DEL ARCHIVO
		
		
		//CAMPOS OCULTOS
		$('#radicado').val(recipient_2[0]);        //RADICADO
		$('#nombre').val(recipient_2[1]);         //ID RADICADO
		$('#idjuzgado').val(recipient_2[7]);     //ID JUZGADO ORIGEN
		$('#idmemoexterno').val(recipient_2[8]);//ID MEMORIAL EXTERNO
		$('#digital').val(recipient_2[5]);     //EXPEDIENTE ES DIGITAL 1 NO ESDIGITAL VACIO
		$('#digital_2').val(recipient_2[13]); //EXPEDIENTE TIENE ARCHIVOS PDF CARGADOS TABLA expe_digital
		$('#id_memo_peticionario').val(recipient_2[3]);//ID (id_memo_peticionario)
		$('#fecha_crem').val(recipient_2[14]);//FECHA DE CREACION DEL DOCUMENTO, CUANDO EL USUARIO RADICO EL MEMORIAL POR LA PLATAFORMA PUBLICACIONES
		
		//SI EL PROCESO ESTA DIGITALIZADO SE ACTIVAN LAS LISTAS CUADERNO Y A DESPACHO
		if(recipient_2[5] == 1 && recipient_2[13] >= 1){
			
			$('#cuaderno').prop('disabled', false);
			$('#a_despacho').prop('disabled', false);
			
			document.getElementById('cuaderno').selectedIndex = 0;
			document.getElementById('a_despacho').selectedIndex = 0;
		}
		else{
		
			document.getElementById('cuaderno').selectedIndex = 0;
			document.getElementById('a_despacho').selectedIndex = 0;
			
			$('#cuaderno').prop('disabled', 'disabled');
			$('#a_despacho').prop('disabled', 'disabled');
		}
		
		
		
	 
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	$('#exampleModal_5B').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		var msg_respuesta
		
		if(recipient_2[2] >= 1){
		
			msg_respuesta = recipient_2[3]+' '+recipient_2[4];
		}
		else{
		
			msg_respuesta ="SIN PROCESAR";
		}
		
		
		modal.find('.modal-title').text('ID MEMORIAL: '+ recipient_2[0] +' - RESPUESTA DEVOLUCION MEMORIAL PROCESADA: '+msg_respuesta)
				
				
		
		
		var nombre_user_SESION = "<?php echo $nombre_user; ?>";
		
		
		//CAMPOS OCULTOS
		$('#idmemoexternodevo').val(recipient_2[0]);//ID PQR
		

		//CARGA INFORMACION SI YA FUE PROCESADA LA RESPUESTA
		//Y DESEAN EDITARLA
		$('#resdevo').val('');
		$('#resdevo').val(recipient_2[1]);
		
		
		
	 
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$("#radicar_devo").click(function(evento){
	
	
		var dataString = "";
		var validar    = 0;
		
		
		if( $('#resdevo').val() == null || $('#resdevo').val().length == 0 || /^\s+$/.test($('#resdevo').val()) ) {
				
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
		
			dataString += '&resdevo='+$("#resdevo").val();
					
		}
	
		
		//CAMPOS OCULTOS
		
		//ID
		if( $('#idmemoexternodevo').val() == null || $('#idmemoexternodevo').val().length == 0 || /^\s+$/.test($('#idmemoexternodevo').val()) ) {
				
			msg = "Defina Id Memo(CAMPO OCULTO)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&idmemoexternodevo='+$("#idmemoexternodevo").val();
					
		}
		
	
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
						
				var data = new FormData();
						
				data.append('resdevo',$('#resdevo').val());
				
				//CAMPOS OCULTOS
				data.append('idmemoexternodevo',$('#idmemoexternodevo').val());
				
			
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
										//OCULTAMOS BOTON REGISTRAR
										//PARA EVITAR QUE EL USUARIO DE CLIC
										//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
										$('#radicar_devo').hide();
															
										$('#fila_cargando_2').show();
					
					
										//Ejecutamos la funci�n ajax de jQuery		
										$.ajax({
											
											//url:'views/popupbox/subir.php', //Url a donde la enviaremos
											url:'index.php?controller=archivo&action=Radicar_Devolucion_Memo_Entidad',
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
												
									
												$('#radicar_devo').show();
												
												$('#fila_cargando_2').hide();
												
												
												//alert(msg);
												//var msgrespuesta = msg.split("-");
												
												//LIMPIAR CAMPOS VENTANA
												$('#resdevo').val('');
												
												//CAMPOS OCULTOS
												$('#idmemoexternodevo').val('');
												
												
												//CIERRO VENTANA
												//$("#exampleModal_5B").hide();
												
												//RECARGAR 
												location.href='index.php?controller=archivo&action=Memoriales_Entidad_Radicados';
												
												
												
												
												
											},3000);
											
										
										});					
					
				
				
				}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	});
	
	
	$("#recargar_pro").click(function(evento){
	
		/*var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		var datosexp = id_radi+"******"+nradi;
		
		location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexp;*/
		
		location.href='index.php?controller=archivo&action=Memoriales_Entidad_Radicados';
	
	
	});
	
	$("#buscar_pro").click(function(evento){
	
			//alert("BUSCANDO...");
			
			//var id_radi = "<?php echo $id_radi; ?>";
			//var nradi   = "<?php echo $nradi; ?>";
			
			//var datosexp_2 = id_radi+"******"+nradi;
			
	
		
			if( 
				
			  	$('#filtro1').val().length   == 0 && 
			 	$('#filtro3').val().length   == 0 && 
				$('#filtro5').val().length   == 0 && 
				$('#filtro2').val().length   == 0 && 
				$('#filtro4').val().length   == 0 &&
				$('#filtro6').val().length   == 0 
			   
			) {
				
				alert("Definir Algun Filtro Para Realizar la Busquedad");
		
				document.getElementById('filtro1').style.borderColor  =  '#FF0000';
				document.getElementById('filtro3').style.borderColor  =  '#FF0000';
				document.getElementById('filtro5').style.borderColor  =  '#FF0000';
				document.getElementById('filtro2').style.borderColor  =  '#FF0000';
				document.getElementById('filtro4').style.borderColor  =  '#FF0000';
				document.getElementById('filtro6').style.borderColor  =  '#FF0000';
				
				
			}
			else{
				
				//alert("BUSCANDO...");
		
				dato_0 = 1;
						
				//FECHAS REGISTRO
				dato_1 = $('#filtro3').val(); 
				dato_2 = $('#filtro5').val();
						
			
				datox1 = $('#filtro1').val();
				datox2 = $('#filtro2').val();
				datox4 = $('#filtro4').val();
				
				datox6 = $('#filtro6').val();
						
				//alert(datox4);
						
				location.href="index.php?controller=archivo&action=Busquedad_Memoriales_Externos_Radicados_Entidades&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox4="+datox4+"&datox6="+datox6;
						
						
			}
		
		
	
	});
	
	
	$(".descarga_archivo").click(function(evento){
	//$("#descarga_archivo").click(function(evento){
	
		
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
	
	$(".descarga_recibido").click(function(evento){
	
		
			var idrecibido = $(this).attr('data-idrecibido');
			
			window.open("views/tcpdf/RECIBIDO_ENTIDAD.php?iddda_acta="+idrecibido);

			
	});
	
	
	
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	
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
	

}

function descarga_archivo_memo(idruta){

	alert(idruta);

	/*var idruta     = $(this).attr('data-idruta');
	var url        = idruta;
			
	//CARGAR PDF EN IFRAME
	$('#varchivo_1').show();
	$('#varchivo_2').show();
	document.getElementById('icontenido').src=url;*/
						
}



</script>



<style type="text/css">

#mdialTamanio{
  width: 80% !important;
}
#mdialTamanio_2{
  width: 100% !important;
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
				
				
				
				<a class="glyphicon glyphicon-list-alt" href="index.php?controller=archivo&amp;action=Memoriales_Entidad_Radicados" title="Memoriales-Radicados-Entidades">
				
					Memoriales-Radicados-Entidades
					
					
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



<center><h2 class="page-header">MEMORIALES RADICADOS ENTIDADES</h2></center>

<!-- <div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=archivo&action=Expediente_Digital_Enitdad" title="Regresar">
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>  -->


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
				  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php echo trim($_GET['dato_1']); ?>" placeholder="Ingrese Fecha Registro Inicial">
				</div>
				
				<div class="form-group col-md-6">
				  <label for="input_1">Fecha Registro Final</label>
				  <input type="text" class="form-control" name="filtro5" id="filtro5" value="<?php echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Final">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-3">
				 <!--  <label for="input_1">Doc Demandante</label> -->
				  <label for="input_1">Documento</label>
				  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php echo trim($_GET['datox2']); ?>" placeholder="Ingrese Documento">
				</div>
				
				<div class="form-group col-md-6">
				  <!-- <label for="input_1">Nombre Demandante</label> -->
				  <label for="input_1">Nombre</label>
				  <input type="text" class="form-control" name="filtro4" id="filtro4" value="<?php echo trim($_GET['datox4']); ?>" placeholder="Ingrese Nombre">
				</div>
				
			
			</div>
			
		</td>
		
		
			
	</tr> 

	<tr>
															
		
		<td>
				
			<div class="form-row">
	  
		
				<div class="form-group col-md-6">
		
					  <label for="input_3">Estado Memorial</label>
					 
					  <select class="form-control" name="filtro6" id="filtro6">
																
						<option value="" selected="selected">Seleccionar Estado Memorial</option> 
						
						<option value="0">Memorial Radicado</option> 
						<option value="1">Radicar Memorial</option> 
						<option value="2">Memorial Devuelto</option>
																			
						
					</select>
				  
				  
				</div>
				
				
				
				
			</div>
			
		</td>
		
		
			
	</tr>  

	
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
				NUMERO DE MEMORIALES: <?php echo $cantregis; ?>
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
			<th style="width:120px; text-align:center">IDM</th>
			<th style="width:120px; text-align:center">RADICADO</th>
			<th style="width:120px; text-align:center">JO</th>
			<th style="width:120px; text-align:center">JD</th>
			<th style="width:120px; text-align:center">DOCREGISTRA</th>
			<th style="width:120px; text-align:center">REGISTRA</th>
			<th style="width:120px; text-align:center">CORREO / CELULAR</th>
			<th style="width:120px; text-align:center">FECHA</th>
			<th style="width:120px; text-align:center">HORA</th>
			<th style="width:120px; text-align:center">TIPO SOLICITUD</th>
			<th style="width:120px; text-align:center">FOLIOS</th>
			<th style="width:120px; text-align:center">ARCHIVO</th>
			<th style="width:120px; text-align:center">RADICAR MEMORIAL</th>
			<th style="width:120px; text-align:center">DEVOLUCION MEMORIAL</th>
			
        </tr>
    </thead>
    
  
	<?php
											
			$Ct110=1;
			
			$contador_registros = 1;
			
			while($fila = $datosACCION_1->fetch()){
				
				$d0M   = $fila[id];
				$d1M   = $fila[radicado];
				$d2M   = $fila[empleado];
				$d3M   = $fila[fecha];
				$d4M   = $fila[hora];
				$d5M   = $fila[des];
				$d6M   = $fila[folios];
				//$d7M   = $fila[ruta];
				$d8M   = $fila[correo];
				$d9M   = $fila[nombre_usuario];
				$d10M  = $fila[idjuzgado];
				$d11M  = $fila[idjuzgado_reparto];
				$d12M  = $fila[digitalizado];
				$d13M  = $fila[idregistra];
				$d14M  = $fila[idradicado];
				$d15M  = $fila[vizualizar];
				
				
				$d16M  = $fila[respuesta];
				$d17M  = $fila[idedita];
				$d18M  = $fila[fechaedita];
				$d19M  = $fila[horaedita];
				
				$d20M  = $fila[celular];
				
				//SE CAPTURA DE LA TABLA expe_digital, PARA DETERMINAR QUE UN EXPEDIENTE
				//SI ESTA DIGITALIZADO Y NO SOLO MIRAR LA VARIABLE $d12M  = $fila[digitalizado];
				//DE LA TABLA ubicacion_expediente
				$d21M  = $modelo->ncuadernos_proceso($d14M);
				

		?>
    
    
        <tr>
           
		   
			
				<!-- <td style="width:30px;"> 
							
					<?php //echo $contador_registros; //NUMERO REGISTRO ?>
							
				</td> -->
				
				<td style="width:30px; text-align:center"> 
			
					<?php echo $d0M; //id memorial?>
					
					<br>
					
					<a class="descarga_recibido" href="javascript:void(0);" title="Recibido" data-idrecibido="<?php echo $d0M; ?>">
					<button type="button" class="btn btn-success btn-xs">RECIBIDO</button>
					</a> 
					
				</td>
			
			
				<td style="width:120px;"> 
			
					<?php 
						echo $d1M; //radicado
						/*echo "<br>";
						echo "<br>";
						echo "Digitalizado: ".$d12M;*/
					?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d10M; //juzgado origen?>
				
				</td> 
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d11M; //juzgado de reparto?>
				
				</td> 
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d9M; //documento?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php 
					
						echo utf8_encode($d2M); //registra
						
						/*echo "<br>";
						echo "<br>";
						echo "Correo: ".$d8M;
						echo "<br>";
						echo "<br>";
						echo "id: ".$d13M;*/
					
					?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php 
					
						echo utf8_encode($d8M)."<br>"."<br>".utf8_encode($d20M); //correo / celular
					
					?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d3M; //fecha?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d4M; //hora?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php //echo utf8_encode($d5M); //tipo solicitud?>
					
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_asunto_mex" data-whatever="<?php echo utf8_encode($d0M."*/*/*".$d1M."*/*/*".$d5M); ?>">
								
							Tipo Solicitud
							
					</button>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d6M; //folios?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
               
			
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php echo $d0M;?>">
					
					 Archivos Memorial
					
					</button>
				
				
          	 	</td>
				
				<?php 
				
				if($d15M == 1){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					<!-- RADICADO."*/*/*".IDRADICADO."*/*/*".REGISTRA(PETICIONARIO)."*/*/*".IDREGISTRA."*/*/*".FOLIOS."*/*/*".DIGITALIZADO."*/*/*".CORREO."*/*/*".JO."*/*/*".ID MEMORIAL."*/*/*".RUTA ARCHIVO; -->		
					<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_5" data-whatever="<?php echo $d1M."*/*/*".$d14M."*/*/*".$d2M."*/*/*".$d13M."*/*/*".$d6M."*/*/*".$d12M."*/*/*".$d8M."*/*/*".$d10M."*/*/*".$d0M."*/*/*".$d7M."*/*/*".$d9M."*/*/*".$d11M."*/*/*".$d20M."*/*/*".$d21M."*/*/*".$d3M; ?>">
								
						<span class="glyphicon glyphicon-align-justify"></span><br>Radicar Memorial
								
					</button>
							
				</td>
				
				<?php 
				}
				?>
				
				<?php 
				if($d15M == 0){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					<?php 
						$msg_memo = "MEMORIAL RADICADO";
					?>
								
						<button type="button" class="btn btn-success btn-xs"><?php echo $msg_memo; ?></button>
							
				</td>
				
				<?php 
				}
				?>
				
				
				<?php 
				if($d15M == 2){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					<?php 
						$msg_memo = "MEMORIAL DEVUELTO";
					?>
								
						<button type="button" class="btn btn-danger btn-xs"><?php echo $msg_memo; ?></button>
							
				</td>
				
				<?php 
				}
				?>
				
				
				<?php 
				//YA FUE RADICADO POR PARTE DEL AREA DE MEMORIALES
				//NO ES POSIBLE REALIZAR LA DEVOLUCION
				if($d15M == 0){
				?>
				
				<td style="width:120px; text-align:center"> 
					
					-
							
				</td>
				
				<?php 
				}else{
				?>
				
				<td style="width:120px; text-align:center"> 
							
					<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal_5B" data-whatever="<?php echo utf8_encode($d0M."*/*/*".$d16M."*/*/*".$d17M."*/*/*".$d18M."*/*/*".$d19M."*/*/*".$d1M); ?>">
								
						<span class="glyphicon glyphicon-hand-left"></span><br>Devolucion Memorial
								
					</button>
							
				</td>
				
				<?php 
				}
				?>
				
				
			
        </tr>
		
    <?php  $contador_registros = $contador_registros + 1;  $Ct110=$Ct110+1; }  ?>
	
		
</table> 



<!-- VENTANAS MODALES -->

<!-- ARCHIVOS DEL MEMORIAL -->

<div class="modal fade" id="exampleModal_2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS MEMORIAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="archivosdda" border="1" class="table table-striped table-bordered table table-hover editinplace_2">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success"> 
													
					<th>ID</th>
					<th>ID MEMORIAL</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
				</tr> 
				
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
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
	  
    </div>
  </div>
</div> 


<!-- VENTANA TIPO SOLICITUD -->

<div class="modal fade" id="exampleModal_asunto_mex" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TIPO SOLICITUD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				
				<tr>
																	
					<td>
							
						<div class="form-row">
						
							<div class="form-group col-md-4">
							
								  
								
								  <br>
								  <label for="comment">Tipo Solicitud:</label>
								  <br>
								  <textarea name="asunto_mex" id="asunto_mex" cols="90" rows="10" maxlength = "1000000" ></textarea>
								  
								 
								  
							</div>
							
							
					
						</div>
						
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



<!-- RADICAR MEMORIAL -->

<div class="modal fade" id="exampleModal_5" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RADICAR MEMORIAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				<tr>
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr>
																	
					<td>
							
						<div class="form-row">
						
							<div class="form-group col-md-4">
							
								  
								  <label for="comment">Tipo Documento:</label>
								  <br>
								  <input type="text" class="form-control" name="tipo_documento" id="tipo_documento" placeholder="Ingrese Tipo Documento" readonly="true">
								  
								 
								 
								  <br>
								  <label for="comment">Tipo de solicitud:</label>
								  <br>
								  <select class="form-control" name="solicitud" id="solicitud">
														
									<option value="" selected="selected">Seleccionar una Solicitud</option> 
																						
									<?php
										while($row = $datosLISTA2->fetch()){
											
											//SI ES Devoluc�on Oficio Tutela 4-72 y SI ES INCIDENTE SALUD														
											//NO SE VISUALIZAN EN LA LISTA, YA QUE CARGAN COMPONENTES APARTE
											//PROCEDIMEINTO SE REALIZA POR EL REGISTRO DE MEMORIAL INICIAL
											//if($row[id] != 72 || $row[id] != 116){
											if($row[id] == 72 || $row[id] == 116){					
																									
												//echo "<option value=\"". $row[id]."-".utf8_encode($row[nombre])."-".utf8_encode($row[nombre_archivo]) ."\">" . utf8_encode($row[nombre]) . "</option>";
												$bandera_novisible = 0;
											}
											else{
												echo "<option value=\"". $row[id]."-".utf8_encode($row[nombre])."-".utf8_encode($row[nombre_archivo]) ."\">" . utf8_encode($row[nombre]) . "</option>";
											}
											
										}
									?>
								  </select> 
								  
								  
								  
								  <br>
								  <label for="comment">Folios:</label>
								  <br>
								  <input type="text" class="form-control" name="folios" id="folios" placeholder="Ingrese folios" readonly="true">
								 
								  <!--  
								  
								  SE CIERRA LA CARGA DE LA LISTA Y SE USA VIA JQUERY
								  $('#cuaderno').html('');
								  $("#cuaderno").load('funciones/traer_datos_lista.php?id='+recipient_2[1]+"&idsql="+8);
								  PARA SOLO CARGAR LOS CUADERNOS RELACIONADOS AL PROCESO
								  
								  -->
								  <br>
								  <label for="comment">Cuadernos:</label>
								  <br>
								  <select class="form-control" name="cuaderno" id="cuaderno">
														
									<option value="" selected="selected">Seleccionar Cuaderno</option> 
																						
									<?php
										/*while($row = $datosLISTA3->fetch()){
											
																									
											echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
											
										}*/
									?>
								  </select> 	
								  
								  <br>
								  <label for="comment">Correo:</label>
								  <br>
								  <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingrese Correo">
								  	
								  <br>
								  <label for="comment">Observaciones:</label>
								  <br>
								  <textarea class="form-control" name="observacionesm" id="observacionesm" cols="45" rows="3" maxlength = "1000" ></textarea>
								  
								  
	 
							</div>
							
							
							<div class="form-group col-md-4">
							
							
								 
								<label for="comment">Juzgado Destino:</label>
								<br>
								<select class="form-control" name="juzgadodestino" id="juzgadodestino">
														
									<option value="" selected="selected">Seleccionar Juzgado Destino</option> 
																						
									<?php
										while($row = $datosLISTA1->fetch()){
																									
											if($row[id] == 1 || $row[id] == 2 || $row[id] == 7){					
																									
												echo "<option value=\"". $row[id] ."\">" . utf8_encode($row[nombre]) . "</option>";
											}
											
										}
									?>
								</select>
								
								<br>
								<label for="comment">Peticionario:</label>
								<br>
								<input type="text" class="form-control" name="peticionario" id="peticionario" placeholder="Ingrese peticionario" readonly="true">
							 	
								<br>
								<label for="comment">Recibe:</label>
								<br>
								<input type="text" class="form-control" name="recibe" id="recibe" placeholder="Ingrese recibe" readonly="true">
								
								
								<br>
								<label for="comment">A despacho:</label>
								<br>
								<select class="form-control" name="a_despacho" id="a_despacho">
														
									
									<option value="" selected="selected">Seleccionar A Despacho</option>
																
									<option value="0">NO</option>
									<option value="1">SI</option>
									
								</select>
								
								
								<br>
								<label for="comment">Celular:</label>
								<br>
								<input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese Celular">
							 
								<?php 
							 	//$msg_memo = "EL NOMBRE DEL MEMORIAL DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO PDF"."<br>"."MANEJAR NOMBRES CORTOS Y REFERENTE A LO QUE SE DESEA CARGAR"."<br>"."NO ARCHIVOS MULTIMEDIA";
							 	?>
								
							
								<!-- <button type="button" class="btn btn-info btn-xs" style="color:#000000"><?php //echo $msg_memo; ?></button> -->
								
								<br>
								<label for="comment">MEMORIAL:</label>
								<br>
								
								<!-- SE SELECCIONA UN SOLO ARCHIVO -->
							 	<!-- <input type="file" name="archivomemo" id="archivomemo" size="19" placeholder="Ingrese Archivo"/>  -->
								
								<!-- <input type="text" class="form-control" name="archivomemo_2" id="archivomemo_2" placeholder="Ingrese Archivo" readonly="true"> -->
								
								<input type="file" class="form-control" name="archivomemo" id="archivomemo" placeholder="Ingrese Archivo">
										 
							 	
							</div>
							
							
							
							
							
						</div>
						
					</td>
				
				
					
				</tr> 
				
				<tr>
				
					<td>
					
						<a id="radicar_memorial" title="RADICAR MEMORIAL">
						
							<button type="button" class="btn btn-primary" title="RADICAR MEMORIAL">
								<span class="glyphicon glyphicon-floppy-saved"></span><h4>RADICAR MEMORIAL</h4>
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
								  <input type="hidden" class="form-control" name="nombre" id="nombre" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="radicado" id="radicado" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="idmemoexterno" id="idmemoexterno" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="idjuzgado" id="idjuzgado" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="digital" id="digital" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="text_lista_ts" id="text_lista_ts" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="text_lista_na" id="text_lista_na" readonly="true">
								  <!-- <br>
								  <input type="hidden" class="form-control" name="archivomemo" id="archivomemo" readonly="true"> -->
								  <br>
								  <input type="hidden" class="form-control" name="cedula" id="cedula" readonly="true">
								   <br>
								  <input type="hidden" class="form-control" name="id_memo_peticionario" id="id_memo_peticionario" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="idmemoexternodevo" id="idmemoexternodevo" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="digital_2" id="digital_2" readonly="true">
								  <br>
								  <input type="hidden" class="form-control" name="fecha_crem" id="fecha_crem" readonly="true">
								  
					
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


<!-- VENTANA RESPUESTA POR DEVOLUCION MEMORIAL -->

<div class="modal fade" id="exampleModal_5B" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DEVOLUCION MEMORIAL</h5>
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
								  <textarea name="resdevo" id="resdevo" cols="90" rows="10" maxlength = "1000000" ></textarea>
								  
								 
								  
							</div>
							
							
							
						</div>
						
					</td>
				
				
					
				</tr> 
				
				<tr>
				
					<td>
					
						<a id="radicar_devo" title="DAR RESPUESTA DEVOLUCION">
						
							<button type="button" class="btn btn-primary" title="DAR RESPUESTA DEVOLUCION">
								<span class="glyphicon glyphicon-floppy-saved"></span><h4>DAR RESPUESTA DEVOLUCION</h4>
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



<!-- VENTANA RESPUESTA DEVOLUCION MEMORIAL-->

<div class="modal fade" id="exampleModal_17" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">RESPUESTA DEVOLUCION MEMORIAL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
				
				<tr>
																	
					<td style="border-color:#FFFFFF">
							
						<div class="form-row">
						
							<div class="form-group col-md-4">
							
								  
								
								  <br>
								  <label for="comment">Respuesta:</label>
								  <br>
								  <textarea name="respuesta_devo" id="respuesta_devo" cols="90" rows="10" maxlength = "1000000" readonly="readonly"></textarea>
								  
								 
								  
							</div>
							
							
							
						</div>
						
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
        	<p>Plataforma <?php echo utf8_encode(' Dise�ada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
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