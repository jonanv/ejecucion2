<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();


$idarchivo     = trim($_POST['idarchivo']);
$iddetalle     = trim($_POST['iddetalle']);
$idcarpeta     = trim($_POST['idcarpeta']);
$numerocarpeta = trim($_POST['numerocarpeta']);
$fecinicial    = trim($_POST['fecinicial']);
$fecfinal      = trim($_POST['fecfinal']);
$coninicial    = trim($_POST['coninicial']);
$confinal      = trim($_POST['confinal']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<!-- <script src="views/js/ajax/ajax_radicador.js" type="text/javascript"></script> -->

<!-- SE CIERRA LA LINEA ANTERIOR PARA NO TENER PROBLEMAS A LA HORA DE CATGAR UNA VENTANA EMERGENTE (popupbox)
Y SE TRAE EL CODIGO JAVASCRIPT DIRECTAMENTE A ESTE PHP, COMO ESTA ABAJO -->
<!-- Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental 
effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/. -->

<script type="text/javascript">


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
	
	$("#fechaiarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechafarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	$('#cancel').click( function(){

		
        $('#block').hide();
        $('#popupbox').hide();
		
		
	});
	
	<!-- CLIC BOTON REGISTRAR -->
	$('#registrar').click(Registrar_Ubicacion);
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON REGISTRAR -->
	function Registrar_Ubicacion(){	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		if( $('#idarchivo').val() == null || $('#idarchivo').val().length == 0 || /^\s+$/.test( $('#idarchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('idarchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA ID ARCHIVO";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&idarchivo='+$('#idarchivo').val();
		}
		
		
		if( $('#iddetalle').val() == null || $('#iddetalle').val().length == 0 || /^\s+$/.test( $('#iddetalle').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('iddetalle').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA ID DETALLE";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&iddetalle='+$('#iddetalle').val();
		}
			
		
		if( $('#carpetaarchivo').val() == null || $('#carpetaarchivo').val().length == 0 || /^\s+$/.test( $('#carpetaarchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('carpetaarchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA NOMBRE CARPETA";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			//TEXTO LISTA
			var lista_1 = $("#carpetaarchivo option:selected").text();
			
			$('#lista_1').val(lista_1);
	
			dataString += '&carpetaarchivo='+$('#carpetaarchivo').val()+'&lista_1='+$('#lista_1').val();
		
			
		}
		
		
		if( $('#numerocarpeta').val() == null || $('#numerocarpeta').val().length == 0 || /^\s+$/.test( $('#numerocarpeta').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('numerocarpeta').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA NUMERO CARPETA";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&numerocarpeta='+$('#numerocarpeta').val();
		}
		
		
		/*if( $('#fechaiarchivo').val() == null || $('#fechaiarchivo').val().length == 0 || /^\s+$/.test( $('#fechaiarchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('fechaiarchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA FECHA INICIAL";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&fechaiarchivo='+$('#fechaiarchivo').val();
		}
		
		if( $('#fechafarchivo').val() == null || $('#fechafarchivo').val().length == 0 || /^\s+$/.test( $('#fechafarchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('fechaiarchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA FECHA FINAL";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&fechafarchivo='+$('#fechafarchivo').val();
		}*/
		
		
		//LAS FECHAS SON VACIAS DEBE DEFINIR CONSECUTIVOS
		if(  ($('#fechaiarchivo').val() == null || $('#fechaiarchivo').val().length == 0 || /^\s+$/.test( $('#fechaiarchivo').val() )) || ($('#fechafarchivo').val() == null || $('#fechafarchivo').val().length == 0 || /^\s+$/.test( $('#fechafarchivo').val() ))  ){
			
			
			if(  ($('#coninicial').val() == null || $('#coninicial').val().length == 0 || /^\s+$/.test( $('#coninicial').val() )) || ($('#confinal').val() == null || $('#confinal').val().length == 0 || /^\s+$/.test( $('#confinal').val() ))  ){
				
				
				document.getElementById('fechaiarchivo').style.borderColor='#FF0000';
				document.getElementById('fechafarchivo').style.borderColor='#FF0000';
				validar = 1;
				
				msg = "DEFINA FECHA INICIAL Y FECHA FINAL";
				$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_validar').show('slow');
				
				setTimeout(function() {
					$(".mensage_validar").fadeOut(1500);
				},5000);
				
				return false;		
			
			}
			else{
				
				$('#fechaiarchivo').val('');
				$('#fechafarchivo').val('');
				
			}	
			
		}
		else{
		
			dataString += '&fechaiarchivo='+$('#fechaiarchivo').val()+'&fechafarchivo='+$('#fechafarchivo').val();
		}
		
		
		
		//LOS CONSECUTIVOS SON VACIOS DEBE DEFINIR FECHAS INICIAL Y FINAL
		if(  ($('#coninicial').val() == null || $('#coninicial').val().length == 0 || /^\s+$/.test( $('#coninicial').val() )) || ($('#confinal').val() == null || $('#confinal').val().length == 0 || /^\s+$/.test( $('#confinal').val() ))  ){
			
			
			if(  ($('#fechaiarchivo').val() == null || $('#fechaiarchivo').val().length == 0 || /^\s+$/.test( $('#fechaiarchivo').val() )) || ($('#fechafarchivo').val() == null || $('#fechafarchivo').val().length == 0 || /^\s+$/.test( $('#fechafarchivo').val() ))  ){
				
				
				document.getElementById('coninicial').style.borderColor='#FF0000';
				document.getElementById('confinal').style.borderColor='#FF0000';
				validar = 1;
				
				msg = "DEFINA CONSECUTIVO INICIAL Y CONSECUTIVO FINAL";
				$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_validar').show('slow');
				
				setTimeout(function() {
					$(".mensage_validar").fadeOut(1500);
				},5000);
				
				return false;		
			
			}
			else{
				
				$('#coninicial').val('');
				$('#confinal').val('');
				
			}	
			
		}
		else{
		
			dataString += '&coninicial='+$('#coninicial').val()+'&confinal='+$('#confinal').val();
		}
		
		
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			//alert(dataString);
			//return false;
			
			
		
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=administrar&action=Editar_Detalle_Encabezado_Archivo',
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
				
				$(".mensage").fadeOut(1500);
				
				$('#block').hide();
				$('#popupbox').hide();
				
				location.href="index.php?controller=administrar&action=Administrar_Archivo_Listar";
				
			},3000);
			
			
			
			
			//APARECER
			/*setTimeout(function() {
				$(".mensage").fadeIn(1500);
			},3000);*/
	
	}
	
	function Solo_Numeros(e){
	
		var key = window.Event ? e.which : e.keyCode
		return (key >= 48 && key <= 57)
	}
	
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

	
	<input type="hidden" name="lista_1" id="lista_1" readonly="true"/>
	
	<!-- MENSAJES -->
	<div class="mensage"></div>  
	<div class="mensage_validar"> </div> 
	
	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
		
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="4" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">EDITAR DETALLE ENCABEZADO</td>
		</tr>
		
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">ID ARCHIVO:</label>
			</td>
			<td colspan="3">
												
				<input type="text" name="idarchivo" id="idarchivo" class="required" readonly="true" value="<?php echo $idarchivo; ?>"/>
			</td>
											
		</tr>
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">ID DETALLE ARCHIVO:</label>
			</td>
			<td colspan="3">
												
				<input type="text" name="iddetalle" id="iddetalle" class="required" readonly="true" value="<?php echo $iddetalle; ?>"/>
			</td>
											
		</tr>
		
		<tr>
								
			<td>
											
				<label style="width:151px; color:#666666">Nombre Carpeta:</label>
												
											
			</td>
											
			<td colspan="3">
															
				<select name="carpetaarchivo" id="carpetaarchivo" class="required">
												
													
					<option value="" selected="selected">Seleccionar Nombre Carpeta</option>
															
						<?php
										
		
							$campo_a_mostrar  ="descarpeta";
							$campo_a_insertar ="id"; 
							$nombre_tabla     ="pa_nombrecarpeta";
							$campo_a_ordenar  ="descarpeta";
											
							$funcion->cargar_lista_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar,$idcarpeta);
						?>
				</select>
			</td>
											
		</tr>
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Numero Carpeta:</label>
			</td>
			<td colspan="3">
												
				<input type="text" name="numerocarpeta" id="numerocarpeta" class="required" onKeyPress="return Solo_Numeros(event)" value="<?php echo $numerocarpeta; ?>"/>
			</td>
											
		</tr>
		
		
		<tr>
										
			<td>
				<label style="width:151px; color:#666666">Fecha Inicial:</label>
			</td>
			<td>
				<input type="text" name="fechaiarchivo" id="fechaiarchivo" readonly="true" value="<?php echo $fecinicial; ?>" onchange="Fechas_Seleccionada()">
			</td>
											
			<td>
				<label style="width:151px; color:#666666">Fecha Final:</label>
			</td>
			<td>
				<input type="text" name="fechafarchivo" id="fechafarchivo" readonly="true" value="<?php echo $fecfinal; ?>" onchange="Fechas_Seleccionada()">
			</td>
										
		</tr>
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Consecutivo Inicial:</label>
			</td>
			<td>
															
				<input type="text" name="coninicial" id="coninicial" onKeyPress="return Consecutivos_Seleccionados(event)" value="<?php echo $coninicial; ?>" />
			</td>
											
			<td>
				<label style="width:151px; color:#666666">Consecutivo Final:</label>
			</td>
			<td>
															
				<input type="text" name="confinal" id="confinal" onKeyPress="return Consecutivos_Seleccionados(event)" value="<?php echo $confinal; ?>"/>
			</td>
														
		</tr>
		
		
	</table>
	
	

<!-- </form> -->

<?php } ?>


