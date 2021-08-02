<!-- <!doctype html>
<html lang="es">
<head> <meta charset="UTF-8"> -->

	<script type="text/javascript">
	
		$('#cancel').click( function(){
									  
			$('#block').hide();
			$('#popupbox').hide();
			
		});
		
		$('#enviar').click(SubirFotos); //Capturamos el evento click sobre el boton con el id=enviar	y ejecutamos la función seleccionado.
		
		
		function SubirFotos(){	
	
			//alert("entre");
			var archivos = document.getElementById("archivos");//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
			var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
			//Creamos una instancia del Objeto FormDara.
			var archivos = new FormData();
			/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
			Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
			indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
			for(i=0; i<archivo.length; i++){
			archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
			
			}
	
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
				url:'views/popupbox/subir.php', //Url a donde la enviaremos
				type:'POST', //Metodo que usaremos
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:archivos, //Le pasamos el objeto que creamos con los archivos
				processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				MensajeFinal(msg)
			});
		}
	
		function MensajeFinal(msg){
			$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage').show('slow');//Mostramos el div.
		}
	</script>
			
	<title>Guardar Multiples Archivos</title>
	<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"> --></script><!-- Integramos jQuery-->
	<!-- <script src="script.js"></script> --><!-- Integramos nuestro script que contendra nuestras funciones Javascript-->
	
	<!-- Creamos un estilo para nuestro documento -->
	<style type="text/css">
		/*body{
			font-size: 16px;
			text-align: center;
			width: 500px;
			margin: 0 auto;
 
		}*/
		.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: left;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
	</style>
	<!-- </head>
	<body> -->
		     <center><h1 style="font-size:16px">SUBIR AUTOS</h1></center>
		
			<div class="buttonsBar">
				
				<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		
			</div>
		
			<!-- Formulario para subir los archivos -->
			<div class="mensage"> </div>  
		    
            <table align="center">
                <tr>
                    <td style="font-size:16px"><h1>Archivo</h1></td>
                    
					<td><input type="file" multiple="multiple" id="archivos"></td><!-- Este es nuestro campo input File-->
					 
                </tr>
				
                <tr>
                    <td>&nbsp;</td>
                    <td><button id="enviar"><img src="views/images/subirarchivo2.jpg" width="55" height="35" title="SUBIR AUTOS"/><h1>SUBIR AUTOS</h1></button></td>
                </tr>    
            </table>
			
	<!-- </body>
</html> -->