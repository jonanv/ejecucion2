<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//ITEMS COSTAS
$datos_items = $funcion->get_item_costas();

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
		
		if( $('#referencia_liqui').val() == null || $('#referencia_liqui').val().length == 0 || /^\s+$/.test( $('#referencia_liqui').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('referencia_liqui').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA REFERENCIA";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&referencia_liqui='+$('#referencia_liqui').val();
		}
		
		
		if( $('#nombre_liqui').val() == null || $('#nombre_liqui').val().length == 0 || /^\s+$/.test( $('#nombre_liqui').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('nombre_liqui').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA NOMBRE";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&nombre_liqui='+$('#nombre_liqui').val();
		}
		
		
		if( $('#descrip_liqui').val() == null || $('#descrip_liqui').val().length == 0 || /^\s+$/.test( $('#descrip_liqui').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('descrip_liqui').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA DESCRIPCION";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&descrip_liqui='+$('#descrip_liqui').val();
		}
		
		
		
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			//VARIABLE QUE ME CONTROLA SI SE VA A REGISTRAR O EDITAR 
			var ID_MODI = $('#id_modificar').val();
			
			//EDITAR
			if(ID_MODI == 1){
			
				dataString += '&id_liqui_item='+$('#id_liqui_item').val();
				
				/*Ejecutamos la función ajax de jQuery*/		
				$.ajax({
				
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=liquidaciones2&action=Editar_Item',
					type:'POST', //Metodo que usaremos
					//contentType:false, //Debe estar en false para que pase el objeto sin procesar
					data:dataString, //Le pasamos el objeto que creamos con los archivos
					//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
				}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
					MensajeFinal(msg)
				});
			
			}	
			//REGISTRAR
			else{
			
			
				/*Ejecutamos la función ajax de jQuery*/		
				$.ajax({
				
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=liquidaciones2&action=Adicionar_Item',
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
		
	}
		
	function MensajeFinal(msg){
		
			$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage').show('slow');//Mostramos el div.
			
			//DESAPARECER
			setTimeout(function() {
				
				$(".mensage").fadeOut(1500);
				
				$('#block').hide();
				$('#popupbox').hide();
				
				$('#item_liqui').html('');
				$("#item_liqui").load('funciones/actualizar_lista_dinamica.php?id='+2+"&idsql="+2);
				
				
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
	
	
	$("#boton_editar_item").click(function(){
	
	
				var idspermiso="";
				
				var f = 1;
				
				var d0;
				
				
				//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
				//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
				//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
				//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
				//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('tabla_item');
				
				cantidad_filas_F = TABLA_F.rows.length;
				
				//alert(cantidad_filas_F);
				
				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 3; r < cantidad_filas_F; r++){
					
					d0  = document.getElementById("tabla_item").rows[r].cells[0].innerText;
					
					if($("#chk"+f).is(':checked')) {  
						
							//alert("ENTRE");
				
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermiso = d0+","+idspermiso;
							
							d0x  = document.getElementById("tabla_item").rows[r].cells[0].innerText;
							d1x  = document.getElementById("tabla_item").rows[r].cells[1].innerText;
							d2x  = document.getElementById("tabla_item").rows[r].cells[2].innerText;
							d3x  = document.getElementById("tabla_item").rows[r].cells[3].innerText;
							
					}
						
					f = f + 1;
					
					
				}
				
				
			
				if(idspermiso == ""){
					
					alert("No se ha Selecionado Ningun Registro de la Tabla ITEMS COSTAS, PARA EDITAR");
					
					$('#id_liqui_item').val('');
					
					$('#referencia_liqui').val('');
					$("#referencia_liqui").removeAttr('disabled');
					
					$('#nombre_liqui').val('');
					$('#descrip_liqui').val('');
					
					$('#id_modificar').val(0);
					
					$("input:checkbox").attr('checked', false);
					
					
				}
				else{
				
					$('#id_liqui_item').val('');
					$('#referencia_liqui').val('');
					$('#nombre_liqui').val('');
					$('#descrip_liqui').val('');
					
		
				
					$('#id_liqui_item').val(d0x);
					
					$('#referencia_liqui').val(d1x);
					$("#referencia_liqui").attr('disabled', 'disabled');
					
					$('#nombre_liqui').val(d2x);
					$('#descrip_liqui').val(d3x);
					
					
					//VARIABLE QUE ME DETERMNA QUE SE MODIFICARA UNA PLANILLA
					$('#id_modificar').val(1);
					
					
					
				}
			
			
		
	});
	
	$("#boton_reiniciar_item").click(function(){
	
		$('#id_liqui_item').val('');
					
		$('#referencia_liqui').val('');
		$("#referencia_liqui").removeAttr('disabled');
					
		$('#nombre_liqui').val('');
		$('#descrip_liqui').val('');
					
		$('#id_modificar').val(0);
		
		
		$("input:checkbox").attr('checked', false);
	
	});
	
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
	
	<div class="buttonsBar" style="float:right">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
		<button type="button" name="boton_reiniciar_item" id="boton_reiniciar_item" title="REINCIAR (PARA NO EDITAR SI NO REGISTRAR UN NUEVO ITEM)"><img src="views/images/reiniciar.png" width="25" height="25"/></button>
		
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">ADICIONAR / EDITAR ITEM</td>
		</tr>
		
		<input type="hidden" name="id_modificar" id="id_modificar" readonly="true">
		
		<tr>
							
			<td>
					
				<label style="width:151px; border-color:#000000; color:#0066CC">ID ITEM:</label><br>
				<input type="text" name="id_liqui_item" id="id_liqui_item" readonly="true" style="border-color:#0066CC;width:250px; height:23px"/>
			</td>	
							
							
		</tr>
		
		<tr>
									
			<td>
				<label style="width:151px; color:#666666">REFERENCIA:</label><br>								
				<input type="text" name="referencia_liqui" id="referencia_liqui" class="required"/>
			</td>
											
		</tr>
		
		<tr>
											
									
			<td>
				<label style="width:151px; color:#666666">NOMBRE:</label><br>								
				<input type="text" name="nombre_liqui" id="nombre_liqui" class="required"/>
			</td>
											
		</tr>
		
		<tr>
			
			<td>
				<label style="width:151px; color:#666666">DECRIPCION:</label><br>
				<textarea name="descrip_liqui" id="descrip_liqui" cols="45" rows="5" maxlength = "1000"></textarea>
			</td>
														
		</tr>
		
		
		
		
		<!-- ITEMS COSTAS-->
			
		<tr>
				
												
				<td>
													
													
					<div id="cont_2det2p">
						
					<table cellpadding="0" cellspacing="0" rules="rows" border="5" class="display" id="tabla_item">
																		
						<thead> 
							
							<tr> 
																			
								<td colspan="5">
									<center><strong style="width:151px; color:#FF0000; font-size:12px">ITEMS COSTAS</strong></center>
								</td>
								
																			
							</tr> 
							
							<tr>
			
								<td colspan="5">
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<button type="button" name="boton_editar_item" id="boton_editar_item" title="EDITAR ITEM"><img src="views/images/modficar.jpg" width="30" height="30"/></button> 
												<!-- <button type="button" name="boton_eliminar_entidad" id="boton_eliminar_entidad" title="ELIMINAR ENTIDAD" style="float:left "><img src="views/images/eliminar.png" width="30" height="30"/></button> --> 
																			
											</td>
											
											
										</tr>
									
									</table>
									
								</td>
								
								
							</tr>
							
							<tr> 
																			
								<td>ID</td>
								<td>REFERENCIA</td>
								<td>NOMBRE</td>
								<td>DESCRIPCION</td>
								
								<td>
									
									<strong style="width:151px; color:#FF0000; font-size:12px">SELECCIONAR</strong>
								</td>
								
																			
							</tr> 
							
						</thead> 
																					
						<tbody> 
																					
							<?php 
																		
								$datosXPE    = explode("*/-*/-",$datos_items); 
								$longitudPE  = count($datosXPE);
								$iE          = 0;
								//echo $longitud_1;
								
								$CiE=1;
																		
								while($iE < $longitudPE - 1){ 
																		
									$datosX_2PE = explode("------",$datosXPE[$iE]);
																		
								?>
																
								<tr>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[0];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[1];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[2];  
										?>
									</td>
									
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[3];  
										?>
									</td>
									
									
									<td>
									
										<input type="checkbox" id="<?php echo trim("chk".$CiE); ?>" name="<?php echo trim("chk".$CiE); ?>" title="<?php echo trim("chk".$CiE); ?>" style="border-color:#0066CC"/>
										
									</td>

									
																				
								</tr>
																		
																					
								<?php $iE = $iE + 1;  $CiE = $CiE+1; } ?>
																					
						</tbody>
							
					</table>
					
					</div>
					
					
				</td>
				
				
		</tr>
		
		
	</table>
	
	

<!-- </form> -->

<?php } ?>


