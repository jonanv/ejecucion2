<?php 

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$id_estudio            = trim($_POST['d0x']);
//echo $id_estudio;
$hv_cedula_es          = trim($_POST['hv_cedula_es']);
$identificador_archivo = trim($_POST['identificador_archivo']);
$id_usuario_hv         = trim($_POST['idusuario']);

?>

<!-- <!doctype html>
<html lang="es">
<head> <meta charset="UTF-8"> -->

	<script type="text/javascript">
	
		$('#cancel').click( function(){
									  
			$('#block').hide();
			$('#popupbox').hide();
			
		});
		
		//-----FORMA AJAX CON JQUERY---------------------------------------------------------------------------------------------------------------------------------------------
		$('#enviar').click(SubirFotos); //Capturamos el evento click sobre el boton con el id=enviar	y ejecutamos la función seleccionado.
		
		
		function SubirFotos(){	
	
			//ID DEL ESTUDIO SELECCIONADO
			//PARA CONCATENAR LOS NOMBRES DE LOS ARCHIVOS Y QUE 
			//ESTE ID PERMITA IDENTIFICAR QUE ESE SOPORTE ES DE ESE ESTUDIO
			var id_estudio	          = $(this).attr('data-id_estudio');
			
			var identificador_archivo = $(this).attr('data-identificador_archivo');
			
			var id_usuario_hv         = $(this).attr('data-id_usuario_hv');
			
			//alert(id_estudio);
			
			var archivos = document.getElementById("archivos");//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
			var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
			//Creamos una instancia del Objeto FormDara.
			var archivos = new FormData();
			/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
			Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
			indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
			for(i=0; i<archivo.length; i++){
			
			//archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
			
			archivos.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
		
			}
	
			//ADICIONO EL ID DEL ESTUDIO SELECCIONADO
			archivos.append('id_estudio',id_estudio);
			
			//ADICIONO EL identificador_archivo PARA SABER SI SE SUBIRA UN ESTUDIO O UNA EXPERIENCIA LABORAL
			archivos.append('identificador_archivo',identificador_archivo);
			
			//ADICIONO EL ID del usuario al cual se le esta procesando la HV
			archivos.append('id_usuario_hv',id_usuario_hv);
		
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
				url:'views/popupbox/soportes_hojavida_2.php', //Url a donde la enviaremos
				type:'POST', //Metodo que usaremos
				contentType:false, //Debe estar en false para que pase el objeto sin procesar
				
				//data:archivos, //Le pasamos el objeto que creamos con los archivos
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
			
			
			//DESAPARECER
			setTimeout(function() {
				
				$(".mensage").fadeOut(1000);
				
				$('#block').hide();
				$('#popupbox').hide();
				
				//location.href="index.php?controller=administrar&action=Administrar_Archivo_Listar";
				
				//location.href="index.php?controller=hojavida&action=Administrar_HojaVida&opcion=1&datosx="+$('#hv_cedula_es_so').val();
				
				Traer_Datos_Hoja_Vida($('#hv_cedula_es_so').val());
				
			},2000);
		}
		//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
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
		     <center><h1 style="font-size:16px">CARGAR ARCHIVOS</h1></center>
		
			<div class="buttonsBar">
				
				<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		
			</div>
		
			<!-- Formulario para subir los archivos -->
			<div class="mensage"> </div>  
		    

			<input type="hidden" name="hv_cedula_es_so" id="hv_cedula_es_so" class="required" readonly="true" value="<?php echo $hv_cedula_es; ?>"/>
			
			<input type="hidden" name="identificador_archivo" id="identificador_archivo" class="required" readonly="true" value="<?php echo $identificador_archivo; ?>"/>
		
			<input type="hidden" name="id_usuario_hv" id="id_usuario_hv" class="required" readonly="true" value="<?php echo $id_usuario_hv; ?>"/>
			
			
			
			
            <table align="center">
                <tr>
                    <td style="font-size:16px"><h1>Archivo</h1></td>
                    
					<td><input type="file" multiple="multiple" id="archivos" style="font-size:16px"></td><!-- Este es nuestro campo input File-->
					 
                </tr>
				
                <tr>
                    <td>&nbsp;</td>
                    <td><button id="enviar" data-id_estudio="<?php echo trim($id_estudio);?>" data-identificador_archivo="<?php echo trim($identificador_archivo);?>" data-id_usuario_hv="<?php echo trim($id_usuario_hv);?>"><img src="views/images/subirarchivo2.jpg" width="55" height="35" title="CARGAR ARCHIVOS"/><h1>CARGAR ARCHIVOS</h1></button></td>
                </tr>    
            </table>
			
	<!-- </body>
</html> -->

