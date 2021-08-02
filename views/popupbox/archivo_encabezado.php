<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();


$idarchivo     = trim($_POST['idarchivo']);
$year          = trim($_POST['year']);
$caja          = trim($_POST['caja']);
$fechasuperior = trim($_POST['fechasuperior']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<!-- <script src="views/js/ajax/ajax_radicador.js" type="text/javascript"></script> -->

<!-- SE CIERRA LA LINEA ANTERIOR PARA NO TENER PROBLEMAS A LA HORA DE CATGAR UNA VENTANA EMERGENTE (popupbox)
Y SE TRAE EL CODIGO JAVASCRIPT DIRECTAMENTE A ESTE PHP, COMO ESTA ABAJO -->
<!-- Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental 
effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/. -->

<script type="text/javascript">

	
	
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
		
		
		if( $('#yeararchivo').val() == null || $('#yeararchivo').val().length == 0 || /^\s+$/.test( $('#yeararchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('yeararchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA YEAR";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&yeararchivo='+$('#yeararchivo').val();
		}
			
		
		if( $('#cajaarchivo').val() == null || $('#cajaarchivo').val().length == 0 || /^\s+$/.test( $('#cajaarchivo').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('cajaarchivo').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA CAJA";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&cajaarchivo='+$('#cajaarchivo').val();
		}
		
		
		
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			//alert(dataString);
			//return false;
			
			
		
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=administrar&action=Editar_Encabezado_Archivo',
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

	
	<!-- MENSAJES -->
	<div class="mensage"></div>  
	<div class="mensage_validar"> </div> 
	
	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
		
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">EDITAR ENCABEZADO</td>
		</tr>
		
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">ID ARCHIVO:</label>
			</td>
			<td>
												
				<input type="text" name="idarchivo" id="idarchivo" class="required" readonly="true" value="<?php echo $idarchivo; ?>"/>
			</td>
											
		</tr>
		
		<tr>
								
			<td>
											
				<label style="width:151px; color:#666666">Year:</label>
												
											
			</td>
											
			<td>
															
				<select name="yeararchivo" id="yeararchivo" class="required">
												
													
					<option value="" selected="selected">Seleccionar Year</option>
															
						<?php
										
		
							$campo_a_mostrar  ="year";
							$campo_a_insertar ="year"; 
							$nombre_tabla     ="pa_year";
							$campo_a_ordenar  ="year";
											
							$funcion->cargar_lista_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar,$year);
						?>
				</select>
			</td>
											
		</tr>
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">Caja:</label>
			</td>
			<td>
												
				<input type="text" name="cajaarchivo" id="cajaarchivo" class="required" onKeyPress="return Solo_Numeros(event)" value="<?php echo $caja; ?>"/>
			</td>
											
		</tr>
		
		
	</table>
	
	

<!-- </form> -->

<?php } ?>


