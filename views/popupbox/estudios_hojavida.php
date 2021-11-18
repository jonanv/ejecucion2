<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();


$id_hv       = trim($_POST['id_hv']);
$hvcedula    = trim($_POST['hvcedula']);

//NOTA IMPORTANTE: SE HACE EL CAMBION DE EL $idusuario = $_SESSION['idUsuario'] POR $idusuario = trim($_POST['id_usuario_hv'])
//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
//13 DE OCTUBRE 2017
//$idusuario = $_SESSION['idUsuario'];
$idusuario = trim($_POST['idusuario']);

//echo $idusuario;

echo '<script languaje="JavaScript">
            
      	var folder_usuario ="'.$idusuario.'";
            
	</script>';

//LISTA ESTUDIOS
$datos_estudios = $funcion->get_lista_estudios($id_hv,'E');

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<!-- <script src="views/js/ajax/ajax_radicador.js" type="text/javascript"></script> -->

<!-- SE CIERRA LA LINEA ANTERIOR PARA NO TENER PROBLEMAS A LA HORA DE CATGAR UNA VENTANA EMERGENTE (popupbox)
Y SE TRAE EL CODIGO JAVASCRIPT DIRECTAMENTE A ESTE PHP, COMO ESTA ABAJO -->
<!-- Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental 
effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/. -->

<script type="text/javascript">

	var servidor = "http://172.16.176.254/";
	
	$('#cancel').click( function(){

		
        $('#block').hide();
        $('#popupbox').hide();
		
		
		
		
	});
	
	$("#hv_modalidad_es").change(function(event){
			
	
			var id_modalidad = $("#hv_modalidad_es").find(':selected').val();
			
			//CARGAR LISTA TIPO MODALIDAD
			$("#hv_tipomodalidad_es").load('funciones/traer_datos_lista.php?id='+id_modalidad+"&idsql="+2);
		
	
	 });
	 
	 var Filas = 0;
	
	$(".soportes_hojavida").click(function(){
	
	
				var idspermiso="";
				
				var f = 1;
				
				var d0x;
				
				var TOTAL = 0;
				
			
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('tabla_estudios');
				
				cantidad_filas_F = TABLA_F.rows.length;
				
		
				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 2; r < cantidad_filas_F; r++){
					
					//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
					if($("#chk"+f).is(':checked')) {  
						
							//alert("ENTRE");
				
							d0x  = document.getElementById("tabla_estudios").rows[r].cells[0].innerText;
							
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							//idspermiso = d0x+","+idspermiso;
							idspermiso = d0x;
					}
						
					f = f + 1;
					
					
				}
				
				
			
				if(idspermiso == ""){
					
					alert("No Selecciono Ningun Estudio, para Adicionar el Soporte");
					
				
				}
				else{
					
					//alert(idspermiso);
					
					params={};
			
					params.d0x          = d0x;
					params.hv_cedula_es = $('#hv_cedula_es').val();
					params.idusuario    = folder_usuario;
					
					//ADICIONO EL identificador_archivo PARA SABER SI SE SUBIRA UN ESTUDIO O UNA EXPERIENCIA LABORAL
					params.identificador_archivo = "E";
				
					$('#popupbox').load('views/popupbox/soportes_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});

				}
		
	});		
	

	<!-- CLIC BOTON ADICIONAR 1 -->
	$('#boton_adicionar_1').click(Adicionar_Modalidad);
	
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON boton_adicionar_1 -->
	function Adicionar_Modalidad(){	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		if( $('#hv_nuevamodalidad_es').val() == null || $('#hv_nuevamodalidad_es').val().length == 0 || /^\s+$/.test( $('#hv_nuevamodalidad_es').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('hv_nuevamodalidad_es').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA NUEVA MODALIDAD";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&hv_nuevamodalidad_es='+$('#hv_nuevamodalidad_es').val();
		}
		
	
				
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			/*Ejecutamos la funci�n ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=hojavida&action=Administrar_HojaVida_Adicionar_Modalidad',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				
				//MensajeFinal(msg)
				
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');//Mostramos el div.
			
				//DESAPARECER
				setTimeout(function() {
				
					//$(".mensage").fadeOut(1500);
					$(".mensage").fadeOut(1000);
					
					$('#hv_modalidad_es').html('');
					$("#hv_modalidad_es").load('funciones/actualizar_lista_dinamica.php?id='+0+"&idsql="+3);
					
					$('#hv_nuevamodalidad_es').val('');
					document.getElementById('hv_nuevamodalidad_es').style.borderColor='#000000';
				
					
				
				},2000);
				
				
	
			});
			
		}
		
	}
	
	
	
	<!-- CLIC BOTON ADICIONAR 2 -->
	$('#boton_adicionar_2').click(Adicionar_TipoModalidad);
	
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON boton_adicionar_1 -->
	function Adicionar_TipoModalidad(){	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		
		if( $('#hv_modalidad_es').val() == null || $('#hv_modalidad_es').val().length == 0 || /^\s+$/.test( $('#hv_modalidad_es').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('hv_modalidad_es').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA MODALIDAD";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&hv_modalidad_es='+$('#hv_modalidad_es').val();
		}
		
		if( $('#hv_nuevatipomodalidad_es').val() == null || $('#hv_nuevatipomodalidad_es').val().length == 0 || /^\s+$/.test( $('#hv_nuevatipomodalidad_es').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('hv_nuevatipomodalidad_es').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA NUEVO TIPO MODALIDAD";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&hv_nuevatipomodalidad_es='+$('#hv_nuevatipomodalidad_es').val();
		}
		
	
				
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			/*Ejecutamos la funci�n ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=hojavida&action=Administrar_HojaVida_Adicionar_TipoModalidad',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				
				//MensajeFinal(msg)
				
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');//Mostramos el div.
			
				//DESAPARECER
				setTimeout(function() {
				
					//$(".mensage").fadeOut(1500);
					$(".mensage").fadeOut(1000);
					
					$('#hv_tipomodalidad_es').html('');
					$("#hv_tipomodalidad_es").load('funciones/actualizar_lista_dinamica.php?id='+$('#hv_modalidad_es').val()+"&idsql="+4);
					
					$('#hv_nuevatipomodalidad_es').val('');
					document.getElementById('hv_nuevatipomodalidad_es').style.borderColor='#000000';
				
					
				
				},2000);
				
				
	
			});
			
		}
		
	}
	
	
	
	<!-- CLIC BOTON REGISTRAR -->
	$('#registrar').click(Registrar_Estudio);
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON REGISTRAR -->
	function Registrar_Estudio(){	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		
		var cantidad_filas_2_es;
	    var TABLA_2_es      = document.getElementById('t_es_hv');
		cantidad_filas_2_es = TABLA_2_es.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2_es);
		
		if(cantidad_filas_2_es > 1){
			
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezados = 0;
			
			var datospartes="";
		
			$('#t_es_hv tr').each(function () {
	
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d3  = $(this).find("td").eq(3).html();
				var d5  = $(this).find("td").eq(5).html();
				
			
				//alert(d0+"//////"+d2+"//////"+d4);
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d3+"//////"+d5;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
					
	
				}
		
			});
			
			//alert(datospartes);
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			//alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla ITEM");
			//return false;
			
			validar = 1;
			
			msg = "NO ES POSIBLE REALIZAR EL REGISTRO NO SE CUENTA CON INFORMACION EN LA TABLA ESTUDIOS";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;
			
		}
		
	
				
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			var direccion = "";
			//alert(dataString);
			//return false;
			
			dataString += '&hv_id_es='+$('#hv_id_es').val();
			dataString += '&hv_cedula_es='+$('#hv_cedula_es').val();
			
			dataString += '&id_modificar='+$('#id_modificar').val();
			
			dataString += '&datospartes='+$('#datospartes').val();
			
			//alert($('#datospartes').val());
			

			/*Ejecutamos la funci�n ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=hojavida&action=Administrar_HojaVida_Estudios',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				MensajeFinal(msg)
			});
			
		}
		
	}
		
	function MensajeFinal(msg){
		
			$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage').show('slow');//Mostramos el div.
			
			//DESAPARECER
			setTimeout(function() {
				
				//$(".mensage").fadeOut(1500);
				$(".mensage").fadeOut(1000);
				
				$('#block').hide();
				$('#popupbox').hide();
				
				//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
				
				location.href="index.php?controller=hojavida&action=Administrar_HojaVida&opcion=1&datosx="+$('#hv_cedula_es').val();
				
			},2000);
			
			
			
			
			//APARECER
			/*setTimeout(function() {
				$(".mensage").fadeIn(1500);
			},3000);*/
	
	}
	
	
	$(".boton_editar").click(function(){
	
	
				var idspermiso="";
				
				var f = 1;
				
				var d0;
				
				
				//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
				//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
				//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
				//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
				//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('tabla_estudios');
				
				cantidad_filas_F = TABLA_F.rows.length;
				
				//alert(cantidad_filas_F);
				
				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 2; r < cantidad_filas_F; r++){
					
					d0  = document.getElementById("tabla_estudios").rows[r].cells[0].innerText;
					
					if($("#chk"+f).is(':checked')) {  
						
							//alert("ENTRE");
				
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermiso = d0+","+idspermiso;
							
							d0xe  = document.getElementById("tabla_estudios").rows[r].cells[0].innerText;
							
							d1xe  = document.getElementById("tabla_estudios").rows[r].cells[1].innerText;
							d2xe  = document.getElementById("tabla_estudios").rows[r].cells[2].innerText;
							
							d3xe  = document.getElementById("tabla_estudios").rows[r].cells[3].innerText;
							d4xe  = document.getElementById("tabla_estudios").rows[r].cells[4].innerText;
							
							d5xe  = document.getElementById("tabla_estudios").rows[r].cells[5].innerText;
							
					}
						
					f = f + 1;
					
					
				}
				
				
			
				if(idspermiso == ""){
					
					alert("No Seleciono Ningun Estudio, para Editar");
					
					$('#id_modificar').val('');
					$('#hv_modalidad_es').val('');
					$('#hv_tipomodalidad_es').val('');
					$('#hv_institucion_es').val('');
					
					
					/*$('#id_liqui_item').val('');
					
					$('#referencia_liqui').val('');
					$("#referencia_liqui").removeAttr('disabled');
					
					$('#nombre_liqui').val('');
					$('#descrip_liqui').val('');
					
					$('#id_modificar').val(0);
					
					$("input:checkbox").attr('checked', false);*/
					
					
				}
				else{
				
					$('#id_modificar').val('');
					$('#hv_modalidad_es').val('');
					$('#hv_tipomodalidad_es').val('');
					$('#hv_institucion_es').val('');
					
				
					$('#hv_modalidad_es').val(d1xe);
					
					//CARGAR LISTA TIPO MODALIDAD
					$("#hv_tipomodalidad_es").load('funciones/traer_datos_lista.php?id='+d1xe+"&idtm="+d3xe+"&idsql="+3);
					
					//$('#hv_tipomodalidad_es').val(d3xe);
					
					$('#hv_institucion_es').val(d5xe);
					
					//VARIABLE QUE ME DETERMNA QUE SE MODIFICARA UN ESTUDIO
					//Y LA CARGO CON EL ID DEL ESTUDIO
					$('#id_modificar').val(d0xe);
					
					
					
				}
			
			
		
	});
	
	
	
	
	<!-- CLIC BOTON ELIMINAR -->
	$('.boton_eliminar').click(Eliminar_Registro);
	
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON boton_eliminar -->
	function Eliminar_Registro(){	
	
		//alert(1);
		
		var validar    = 0;
	
		var dataString = "";
		
		var d0xe       = 0
		
		//***************************************************************************

				
		var f = 1;
								
		var cantidad_filas_F;
		var TABLA_F = document.getElementById('tabla_estudios');
				
		cantidad_filas_F = TABLA_F.rows.length;
				
		//alert(cantidad_filas_F);
				
		//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
		for (r = 2; r < cantidad_filas_F; r++){
					
		
			if($("#chk"+f).is(':checked')) {  
						
				
				d0xe  = document.getElementById("tabla_estudios").rows[r].cells[0].innerText;
							
				
			}
						
			f = f + 1;
					
					
		}
		
		
		if(d0xe > 0){
		
			dataString += '&ideliminar='+d0xe;
			validar = 0;
			
			
		}
		else{
		
			validar = 1;
			
			msg = "NO SELECCIONO NINGUN REGISTRO, PARA ELIMINAR";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;
		}
		
		//****************************************************************************
	
				
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			if (confirm ("ESTA SEGURO DE ELIMINAR EL REGISTRO: "+ d0xe)) {
			
				
				id_msg = 1;
				
				dataString += '&id_msg='+id_msg;
				
				/*Ejecutamos la funci�n ajax de jQuery*/		
				$.ajax({
				
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=hojavida&action=Administrar_HojaVida_Eliminar_Registro',
					type:'POST', //Metodo que usaremos
					//contentType:false, //Debe estar en false para que pase el objeto sin procesar
					data:dataString, //Le pasamos el objeto que creamos con los archivos
					//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
				}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
					
					//MensajeFinal(msg)
					
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');//Mostramos el div.
				
					//DESAPARECER
					setTimeout(function() {
					
						//$(".mensage").fadeOut(1500);
						$(".mensage").fadeOut(1000);
						
						<!-- CIERRO VENTANA -->
						$('#block').hide();
						$('#popupbox').hide();
						
						<!-- ABRO VENTANA, ESTO CON EL OBJETO DE ACTUALIZAR VISTA -->	
						params={};
			
						params.id_hv     = $('#hv_id_es').val();
						params.hvcedula  = $('#hv_cedula_es').val();
						
					
						$('#popupbox').load('views/popupbox/estudios_hojavida.php',params,function(){
							//alert(2);
							$('#block').show();
							//alert(3);
							$('#popupbox').show();
							//alert(4);
						});
					
						
					
					},2000);
					
					
		
				});
				
				
			
			}
			
			
			
			
		}
		
		
	}
	
	
	
	function Solo_Numeros(e){
	
		var key = window.Event ? e.which : e.keyCode
		return (key >= 48 && key <= 57)
	}
	
	
	
	$('#JQueryFTD_Demo').fileTree({
			      //root: '/windows/',
				  
				  //root: '/wamp/www/laborales/HOJASDEVIDA/38/SOPORTES',
				  
  
				  root: '/wamp/www/laborales/HOJASDEVIDA/'+folder_usuario+'/',
				  
				 
			      script: 'views/viewstree/jqueryFileTree.php',
			      expandSpeed: 1000,
			      collapseSpeed: 1000,
			      multiFolder: true
				  
			    }, function(file) {
			        
					//alert(file);
					
					//var res = file.substring(10, 43);
					
					var res = file.split("/");
					
					//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
					
					//var servidor = "http://172.16.176.194/";
					
					var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]+"/"+res[7];
					
					//alert(res_2);
					
					//file = $(this).attr("href");
					window.open(res_2, '_blank');
					return false;
					
					
	});
	
	
	<!------------ FUNCIONES PARA LA ADICION DE VARIOS ESTUDIOS --------------->
	
	
	var z=1;
	var Filas = 0;
	
	function Adicionar_Estudio(){
		
		//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
		//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
		//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
		//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
		
		
		existe_estudio = 0;
		
		//existe_estudio = Existe_Registro();
		
		if(existe_estudio == 1){
			
			existe_estudio = 1;
			alert("Ya Existe esa Informacion en la Tabla, no es Posible su Adicion");
		}
		else{//1
			
		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos = Validar_Campos_Agregar();
		
		//validarcampos = 0;
		
		if(validarcampos == 1){
			
			validarcampos = 1;
		}
		else{//2
		
				//DATOS 
				
				var dato0 = 0;
				
				if( $('#id_modificar').val() >= 1 ){
					
					dato0  = $('#id_modificar').val();
					$('#id_modificar').val('');
				}
				
				
				
				var dato1  = document.getElementById('hv_modalidad_es').value;
				//var s0     = document.frm.carpetaarchivo;
				var s0     = document.getElementById('hv_modalidad_es');
				var dato1b = s0.options[s0.selectedIndex].text;
				
				var dato2  = document.getElementById('hv_tipomodalidad_es').value;
				var s1     = document.getElementById('hv_tipomodalidad_es');
				var dato2b = s1.options[s1.selectedIndex].text;
				
				var dato3 = document.getElementById('hv_institucion_es').value;
				
				
				//-------------------------------------------------------------------------------------------------------
		
				//Filas = resultado.length;
				Filas = 1;
				var cantidad_filas;
				var TABLA      = document.getElementById('t_es_hv');
				cantidad_filas = TABLA.rows.length;
		
				//alert(cantidad_filas);
				
				if(cantidad_filas>1){
							
					//alert('cantidad > 1');
						
					//Eliminar_Tabla();
					
					var tabla=document.getElementById('cont_es_hv').innerHTML;
						
					//for (var id=0; id<Filas; id++){
					
						//tabla=tabla.substring(0,(tabla.length-8)); 
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato1b+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato2b+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_es_hv').innerHTML=tabla;
						
						z++;
						
						Limpiar_Campos();
					 //}
				}
							
				if(cantidad_filas==1){
							
					//alert('cantidad = 1');
					
					var tabla=document.getElementById('cont_es_hv').innerHTML;
					
					//alert(tabla);
					
					//for (var id=0; id<Filas; id++){
						
						//var partefinal = tabla.length - 8;
						
						//alert("Longitud Tabla: "+tabla.length);
						//alert("Parte Final: "+partefinal);
						
						//tabla=tabla.substring(0,(tabla.length-8));
						
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						//tabla=tabla.substring(0,partefinal);
						
						
						//alert(tabla);
						
						tabla+='<tr>';
					
						tabla+='<td>'+dato0+'</td>';
						
						tabla+='<td>'+dato1+'</td>';
						
						tabla+='<td>'+dato1b+'</td>';
						
						tabla+='<td>'+dato2+'</td>';
						
						tabla+='<td>'+dato2b+'</td>';
						
						tabla+='<td>'+dato3+'</td>';
						
						
						tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
						
						tabla+='</tr></table>';
					
						//alert(tabla);
						document.getElementById('cont_es_hv').innerHTML=tabla;
						
						z++;
						
						Limpiar_Campos();
					//}
				}
				
		}//2
		
		//Limpiar_Formulario();
		
		}//1
		
	}
	
	
	function Existe_Registro(){
		
		var existe = 0;
		
		//var datonumero = document.getElementById('numerotitulo').value+document.getElementById('numerotitulo2').value;
		
		var dato1A = document.getElementById('carpetaarchivo').value;
		//var s0A    = document.frm.carpetaarchivo;
		var s0A    = document.getElementById('carpetaarchivo');
		var dato1B = s0A.options[s0A.selectedIndex].text;
		
		var dato2A = document.getElementById('numerocarpeta').value;
		
		var dato3A = document.getElementById('fechaiarchivo').value;
		var dato4A = document.getElementById('fechafarchivo').value;
		
		var dato5A = document.getElementById('coninicial').value;
		var dato6A = document.getElementById('confinal').value;
				
		
		//SI LAS FECHAS INICIAL Y FINAL SON VACIAS
		if( (dato3A == null || dato3A.length == 0 || /^\s+$/.test(dato3A)) || (dato4A == null || dato4A.length == 0 || /^\s+$/.test(dato4A)) ) {
			
			$('#t tr').each(function () {
			
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(5).html();
				var d4  = $(this).find("td").eq(6).html();
				
				if(dato1A == d0 && dato1B == d1 && dato2A == d2 && dato5A == d3 && dato6A == d4){
					
					existe = 1;
					return false;
					
				}
				
				
			});
		
		}
		
		//SI LOS CONSECUTIVOS SON VACIAS
		if( (dato5A == null || dato5A.length == 0 || /^\s+$/.test(dato5A)) || (dato6A == null || dato6A.length == 0 || /^\s+$/.test(dato6A)) ) {
			
			$('#t tr').each(function () {
			
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(3).html();
				var d4  = $(this).find("td").eq(4).html();
				
				if(dato1A == d0 && dato1B == d1 && dato2A == d2 && dato3A == d3 && dato4A == d4){
					
					existe = 1;
					return false;
					
				}
				
				
			});
		
		}
		
		return  existe;
					
	}
	
	function Validar_Campos_Agregar(idaccion){
		
		var validar = 0;
		
		valor  = document.getElementById('hv_id_es').value;
		valor2 = document.getElementById('hv_cedula_es').value;
		valor3 = document.getElementById('hv_modalidad_es').value;
		valor4 = document.getElementById('hv_tipomodalidad_es').value;
		valor5 = document.getElementById('hv_institucion_es').value;
		
		
		if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
			
			alert("Defina Id Servidor");
			document.getElementById('hv_id_es').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
		if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
			
			alert("Defina Cedula");
			document.getElementById('hv_cedula_es').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
		if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
			
			alert("Defina Modalidad");
			document.getElementById('hv_modalidad_es').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
		if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
			alert("Defina Tipo Modalidad");
			document.getElementById('hv_tipomodalidad_es').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
		if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
			
			alert("Defina Institucion");
			document.getElementById('hv_institucion_es').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
		
	
	}
	
	//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
	function Eliminar_Fila(idfila){
		
		
		//alert(idfila);
		
		//document.getElementsByTagName("table")[0].setAttribute("id","t");
		//document.getElementById("t").deleteRow(idfila);
		
		var TABLA = document.getElementById('t_es_hv');
		
		TABLA.deleteRow(idfila);
		
		//z = z+1;
		
		//alert("idfila: "+idfila+" Z: "+z);*/
		
		
	}
	
	function Eliminar_Tabla_Estudios_HV(){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('t_es_hv');
				
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
	
	// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
	function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {
	
	
	   for (var i = 0; i < cadenaCompleta.length; i++) {
		  if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
			 cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
		  }
	   }
	   return cadenaCompleta;
	}
	
	
	function Limpiar_Campos(){
		
		document.getElementById('hv_modalidad_es').selectedIndex = 0;
		document.getElementById('hv_modalidad_es').style.borderColor='#E0E0E0';
		
		document.getElementById('hv_tipomodalidad_es').selectedIndex = 0;
		document.getElementById('hv_tipomodalidad_es').style.borderColor='#E0E0E0';
		
		document.getElementById('hv_institucion_es').value = "";
		document.getElementById('hv_institucion_es').style.borderColor='#E0E0E0';
		
		
	}
	
	<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
	
	
</script>

<!-- Creamos un estilo para nuestro documento -->
	<style type="text/css">
		
		.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		.mensage_validar{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
	</style>

<!-- <form method="post" name ="formarchivo" id="formarchivo">  -->

	
	<!-- MENSAJES -->
	<div class="mensage"></div>  
	<div class="mensage_validar"> </div> 
	
	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
		
	</div>

	<input name="id_modificar" id="id_modificar" type="hidden" readonly="true">
	<input name="datospartes" id="datospartes" type="hidden" readonly="true"/> 
	
	<table border="3" align="center" style="width:700px">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">ESTUDIOS</td>
		</tr>
		
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Id Servidor:</label>
			</td>
			<td>
												
				<input type="text" name="hv_id_es" id="hv_id_es" class="required" readonly="true" value="<?php echo $id_hv; ?>"/>
			</td>
											
		</tr>
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Cedula:</label>
			</td>
			<td>
												
				<input type="text" name="hv_cedula_es" id="hv_cedula_es" class="required" readonly="true" value="<?php echo $hvcedula; ?>"/>
			</td>
											
		</tr>
		
		<tr>
								
			<td>
											
				<label style="width:151px; color:#666666">Modalidad:</label>
												
											
			</td>
											
			<td>
															
				<select name="hv_modalidad_es" id="hv_modalidad_es" class="required">
												
													
					<option value="" selected="selected">Seleccionar Modalidad</option>
															
						<?php
										
		
							$campo_a_mostrar  ="des";
							$campo_a_insertar ="id"; 
							$nombre_tabla     ="hv_modalidad";
							$campo_a_ordenar  ="des";
											
							//$funcion->cargar_lista_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar,$year);
							
							$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
						?>
				</select>
				
				<button type="button" name="boton_adicionar_1" id="boton_adicionar_1" style="float:right" title="ADICIONAR"><img src="views/images/adi.jpg" width="20" height="20"/></button>
				
			</td>
											
		</tr>
		
		<tr>
			
			<td>
											
				<label style="width:151px; color:#000000">Nueva Modalidad:</label>
												
											
			</td>
			
			<td>
												
				<input type="text" name="hv_nuevamodalidad_es" id="hv_nuevamodalidad_es" style="border-color:#000000"/>
			</td>
		
		</tr>
		
		
		<tr>
											
			<td>
											
				<label style="width:151px; color:#666666">Tipo Modalidad:</label>
												
											
			</td>
											
			<td>
															
				<select name="hv_tipomodalidad_es" id="hv_tipomodalidad_es" class="required">
												
													
					<option value="" selected="selected">Seleccionar Tipo Modalidad</option>
															
						<?php
										
		
							/*$campo_a_mostrar  ="des";
							$campo_a_insertar ="id"; 
							$nombre_tabla     ="hv_modalidad";
							$campo_a_ordenar  ="des";
											
							//$funcion->cargar_lista_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar,$year);
							
							$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);*/
						?>
				</select>
				
				<button type="button" name="boton_adicionar_2" id="boton_adicionar_2" style="float:right" title="ADICIONAR"><img src="views/images/adi.jpg" width="20" height="20"/></button>
				
			</td>
											
		</tr>
		
		
		<tr>
			
			<td>
											
				<label style="width:151px; color:#000000">Nuevo Tipo Modalidad:</label>
												
											
			</td>
			
			<td>
												
				<input type="text" name="hv_nuevatipomodalidad_es" id="hv_nuevatipomodalidad_es" style="border-color:#000000"/>
			</td>
		
		</tr>
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Institucion:</label>
			</td>
			<td>
												
				<input type="text" name="hv_institucion_es" id="hv_institucion_es" class="required"/>
			</td>
											
		</tr>
		
	
		<tr>
		
			<td colspan="2">
																	
				<button type="button" name="boton_adicionar_estudio" id="boton_adicionar_estudio" style="float:right" title="ADICIONAR ESTUDIO" onClick="Adicionar_Estudio()"><img src="views/images/new4.jpg" width="35" height="35"/></button>
																
			</td>
								
		</tr> 
		
		<!-- TABLA PARA ADICIONAR ESTUDIOS -->
		
		<tr align="center">
			
			
			<td colspan="2">
		
				
				<table border="1" align="center" id="tabla_estudios_hv" style="width:700px">
		
					<tr>
						<td>
							<div id="cont_es_hv"> 
								<table id="t_es_hv" border="1"> 
									<tr>
																		
										<td>ID</td>
										<td>ID MODALIDAD</td>
										<td>MODALIDAD</td>
										<td>ID TIPO MODALIDAD</td>
										<td>TIPO MODALIDAD</td>
										<td>INSTITUCION</td>
																		
									</tr> 
								</table>
							</div>
						</td>
														
					</tr>
										
				</table>	
				
			
			</td>
			
		
		</tr>
		
		
		
	</table>
	
	
	<br>
	
	<!-- ESTUDIOS -->
	<table border="3" align="center" id="tabla_estudios" style="width:700px">
	
		
		<tr>
							
			<td colspan="7">
									
				<a class="soportes_hojavida" href="javascript:void(0);"  style="float:left; color:#0066CC"><img src="views/images/doc1.jpg" width="35" height="35" title="ADICIONAR SOPORTES"/>ADICIONAR SOPORTES</a>
			
				<a class="boton_editar" href="javascript:void(0);"  style="float:left; color:#0066CC"><img src="views/images/historial2.png" width="35" height="35" title="EDITAR"/>EDITAR</a>
				
				<!-- SE CIERRA POR QUE SE VA A MANEJAR LOS ELIMINAR EN LA VISTA hojavida_general.php
				PERO OPCION FUNCIONA PERFECTAMENTE -->
				<!-- <a class="boton_eliminar" href="javascript:void(0);"  style="float:left; color:#0066CC"><img src="views/images/pendiente.Jpg" width="35" height="35" title="ELIMINAR"/>ELIMINAR</a> -->
			</td>
		</tr>
		
		
		<tr> 
																			
			<td><B>ID</B></td>
			<td><B>ID MODALIDAD</B></td>
			<td><B>MODALIDAD</B></td>
			<td><B>ID TIPO MODALIDAD</B></td>
			<td><B>TIPO MODALIDAD</B></td>
			<td><B>INSTITUCION</B></td>
			
			<td>
									
				<strong style="width:151px; color:#FF0000; font-size:12px">SELECCIONAR</strong>
				
			</td>
								
		</tr> 
		
		
		<?php 
																		
			$datosXPE    = explode("*/-*/-",$datos_estudios); 
			$longitudPE  = count($datosXPE);
			$iE          = 0;
			//echo $longitud_1;
								
			$CiE=1;
																		
			while($iE < $longitudPE - 1){ 
																		
				$datosX_2PE = explode("------",$datosXPE[$iE]);
																		
			?>
																
				<tr>
									
					<td style="font-size:14px">
						<B style="color:#FF0000">
						<?php 
																						  
							echo $datosX_2PE[0];  
						?>
						</B>
					</td>
					
					<td style="font-size:14px">
						<?php 
																						  
							echo $datosX_2PE[4];  
						?>
					</td>
									
					<td style="font-size:14px">
						<?php 
																						  
							echo $datosX_2PE[1];  
						?>
					</td>
					
					
					<td style="font-size:14px">
						<?php 
																						  
							echo $datosX_2PE[5];  
						?>
					</td>				
					<td style="font-size:14px">
						<?php 
																						  
							echo $datosX_2PE[2];  
						?>
					</td>
					
					<td style="font-size:14px">
						<?php 
																						  
							echo $datosX_2PE[3];  
						?>
					</td>
									
									
					
					<td align="center">
									
						<input type="radio" id="<?php echo trim("chk".$CiE); ?>" name="liquidacionproc" title="<?php echo trim("ESTUDIO ".$datosX_2PE[0]); ?>" style="border-color:#0066CC"/>
																
					</td>

									
																				
				</tr>
																		
																					
		<?php $iE = $iE + 1;  $CiE = $CiE+1; } ?>
		
		
	</table>
	
	
	<!-- SOPORTES -->
	
	<table border="3" align="center" id="tabla_soporte_estudios" style="width:700px">
	
	
		<tr> 
																				
				<td align="center"><B>SOPORTES</B></td>
				
		</tr> 
		
		<tr>
			<td>
				<div id="JQueryFTD_Demo" class="demo" data-idusuario="<?php echo trim($idusuario);?>"></div>
			</td>
		</tr>

				
	</table>
	
	

<!-- </form> -->

<?php } ?>


