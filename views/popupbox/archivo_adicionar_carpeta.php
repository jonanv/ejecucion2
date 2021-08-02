<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

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
		
		if( $('#archivonombrecarpeta').val() == null || $('#archivonombrecarpeta').val().length == 0 || /^\s+$/.test( $('#archivonombrecarpeta').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('archivonombrecarpeta').style.borderColor='#FF0000';
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
		
			dataString += '&archivonombrecarpeta='+$('#archivonombrecarpeta').val();
		}
		
		
		
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			//alert(dataString);
			//return false;
			
			
		
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
			
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=administrar&action=Adicionar_Nombre_Carpeta',
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
				
				$('#carpetaarchivo').html('');
				$("#carpetaarchivo").load('funciones/actualizar_lista_dinamica.php?id='+1+"&idsql="+1);
				
				
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
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">ADICIONAR NOMBRE CARPETA</td>
		</tr>
		
		
		
		<tr>
											
											
			<td>
				<label style="width:151px; color:#666666">NOMBRE CARPETA:</label>
			</td>
			<td>
												
				<input type="text" name="archivonombrecarpeta" id="archivonombrecarpeta" class="required"/>
			</td>
											
		</tr>
		
		
		
	</table>
	
	

<!-- </form> -->

<?php } ?>


