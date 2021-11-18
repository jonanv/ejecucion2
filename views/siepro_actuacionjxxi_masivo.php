<?php 
	

	//TITULO FORMULARIO
	$titulo     = "ACTUACION JUSTICIA XXI MASIVO";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//$fechaactual = '2017-08-30';
	
	
	//LISTA ACTUACIONES JUSTICIA XXI TABLA T054BAACTUGENE
	$datosdelit_2  = $modelo->lista_T054BAACTUGENE();
	$datosdelit_2B = explode("******",$datosdelit_2);
	$long_1        = count($datosdelit_2B);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --> 
<title><?php echo $titulo?></title>

<!-- SE DEFINEN LAS LIBRERIAS DE ESTA FORMA PARA EVITAR CONFLICTOS COMO EL DESPLIEGUE DE MENUS,
QUE AL REALIZAR UN REGISTRO SALGA EL MENSAJE DE CONFIRMACION, SEGUIDO DE LAS LIBRERIAS
FUNCIONES JAVASCRIPT COMO mainmenu() Y $(document).ready(function() , YA QUE SI SE DEFINEN
MAS ARRIBA AL NO ENCONTRAR LAS LIBRERIAS TAMBIEN PUEDE PRESENTAR INCONSISTENCIAS.
PARA EL MANEJO DE LAS FECHAS, SI SE USA DIRECTAMENTE POR EJEMPLO EN ESTE FORMULARIO SE DEFINE 
ALGO COMO

<input name="fechair" id="fechair" type="text" readonly="true" size="10">

Y SE DEFINE EN $(document).ready(function() 

$("#fechair").datepicker({ changeFirstDay: false	}); 

SI SE DESEA MANEJAR FECHAS EN UN POPUPBOX, SE PUEDE USAR LAS LIBRERIAS DE views\fechajquery
EJENPLODE ESTO LO VEMOS EN EL FORMULARIO permisos.php UBICADO EN views\popupbox
-->

<!-- -------------------------------------------------------------------- -->
<script src="views/js/jquery_NV.js" type="text/javascript"></script>

<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>  -->

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>

<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_siepro_masivo_jxxi.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">


<!-- -------------------------------------------------------------------- -->

<!-- PARA EL DESPLIEGUE DE MENUS -->
<script type="text/javascript">

	function mainmenu(){
	
		$(" #menusec ul ").css({display: "none"});
		$(" #menusec li").hover(function(){
			$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
			},function(){
				$(this).find('ul:first').slideUp(400);
			});
	}
	
	$(document).ready(function(){
		mainmenu();
	});


</script>


<script type="text/javascript">

$(document).ready(function() {
	
	
	//PARA LAS FECHAS
	//$("#fechae").datepicker({ changeFirstDay: false	});
	
	
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
	 
	 //PARA LAS FECHAS
	$("#fechae").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	$("#fechae_2B").click(function(event){
								   
		
		//alert("CALCULANDO...");
	
			var fechat = document.frm_masivo1.fechae.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+fechat, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				$("#fechae_2B").val(fii);
				
	
			});


	});
	
	$(".registrar_masivo").click(function(evento){
		
		
		var validar = 0;
			
		valor1 = document.getElementById('fechae').value;
		valor2 = document.getElementById('fechae_2B').value;
		valor3 = document.getElementById('lactu').value;
		valor4 = document.getElementById('archivo').value;
		
		
		if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
			
			msg = "Defina Fecha Registro";
			$('.mensage_masivo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_masivo').show('slow');
				
			setTimeout(function() {
				$(".mensage_masivo").fadeOut(4000);
			},10000);
			
			
			validar = 1;
				
			return false;
			
			
			
		}
		
		if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
			
			msg = "Defina Fecha Estado";
			$('.mensage_masivo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_masivo').show('slow');
				
			setTimeout(function() {
				$(".mensage_masivo").fadeOut(4000);
			},10000);
			
			
			validar = 1;
				
			return false;
			
			
			
		}
		
		if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
			
			msg = "Defina Actuacion";
			$('.mensage_masivo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_masivo').show('slow');
				
			setTimeout(function() {
				$(".mensage_masivo").fadeOut(4000);
			},10000);
			
			
			validar = 1;
				
			return false;
			
			
			
		}
		
		if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
			msg = "Defina Archivo";
			$('.mensage_masivo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_masivo').show('slow');
				
			setTimeout(function() {
				$(".mensage_masivo").fadeOut(4000);
			},10000);
			
			
			validar = 1;
				
			return false;
			
			
			
		}
			
			
		if(validar == 0){
		
		
			if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					//PARTE TEXTO DE LA ACTUACION
					var lactutext = $("#lactu option:selected").text();
					
					//alert($('#lactu').val());
					
					var inputFileImage = document.getElementById("archivo");
					var file           = inputFileImage.files[0];
					
				
					//DE ESTA FORMA PARA PODER PASAR CAMPO FILE
					var data = new FormData();
					
					//data.append(COMO LO CAPTURA PHP,VALOR DATO);
					
					data.append('fechae',$('#fechae').val());
					data.append('fechae_2B',$('#fechae_2B').val());
					data.append('lactu',$('#lactu').val());
					data.append('lactutext',lactutext);
					data.append('archivo',file);
					
					if( $('#lactu').val() == "00000108"+"//////"+"00000106" ){
					
						var url_m = 'index.php?controller=archivo&action=Registrar_ActuacionFE_Masivo'
					
					}
					else{
					
						var url_m = 'index.php?controller=archivo&action=Registrar_Actuacion_Masivo'
					}
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						
						url:url_m,
						type:'POST', //Metodo que usaremos
						contentType:false, //Debe estar en false para que pase el objeto sin procesar
						//data:dataString, //Le pasamos el objeto que creamos con los archivos
						data:data, //Le pasamos el objeto que creamos con los archivos
						processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_masivo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_masivo').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_masivo").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=Registrar_Actuacion_Masivo";
							
						},3000);
						
					
					});
					
					
					
					
				
				}
			
				
					
		}
			
								 
	});
	
	
	
	
});

</script>	


<!-- Creamos un estilo para nuestro mensajes -->
<style type="text/css">
	
	
		.mensage_masivo{
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

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_archivo.php';
		
	?>			
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id ="popupbox"></div>	
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		<tr>
				<td colspan="2">
					<!-- MENSAJES -->
					<div class="mensage_masivo"></div>  
				</td>
							
			</tr>
		
		<tr>
    		<td>
				
				<div id="contenido">
				
					<form id="frm_masivo1" name="frm_masivo1"  method="post" enctype="multipart/form-data" action="">
					
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
						
							<tr>
								
								<td colspan="2">
									
									
										
										
										<a class="registrar_masivo" href="javascript:void(0);"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR"/></a>
										
									
								</td> 
								
						  	</tr>
							
							<tr>
								<td>
									<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Registro:</label>
								</td>
								
								<td colspan="2">
									<input type="text" name="fechae" id="fechae" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
									
									
								</td>
								
					
							</tr>
							
							<tr>
								<td>
									<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Estado:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechae_2B" id="fechae_2B" class="required"  readonly="true" style="font-size:14px;">
								</td>
							
							</tr>
							
							
							<tr>
								
								<td>
											
									<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Actuacion:</label><br>
												
											
								</td>
											
								<td colspan="2">
															
									<select name="lactu" id="lactu" class="required">
												
										<option value="" selected="selected">Seleccionar Actuacion</option> 
															
										<?php
															
										//FORMA DESDE JUSTICIA XXI
										$il = 0;
															
										while($il < $long_1 - 1){
															
											$datosdelit_2C = explode("//////",$datosdelit_2B[$il]);
															
											echo "<option value=\"". $datosdelit_2C[0]."//////".$datosdelit_2C[1] ."\">" .$datosdelit_2C[2]. "</option>";
																
												$il = $il + 1;
											}
															
											//FORMA LOCAL
											/*while($row = $datosdelit->fetch()){
																		
												echo "<option value=\"". $row[idjxxi] ."\">" . $row[des] . "</option>";
																		
																		
											}*/
										?>
										
									</select>
									
								</td>
											
											
										
							</tr>
							
							
							
							<tr>
								<td>
									<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Archivo</label>
								</td>
								
								<td colspan="2">
									<input type="file" name="archivo" id="archivo" class="required" title="Archivo"/>
								</td>
							
							</tr>
							
							
							
							<!-- <tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr> -->
							
							<tr id="imgloading_masivo">
								
								<td colspan="3">
									<center>
										
									
										<img src="views/images/loading4.gif" width="400" height="100"/>
											
									</center>
								</td> 
								
						  	</tr>
		
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<!-- <tr id= "filabotones_masivo">
								
								<td colspan="3">
									
									<center>
										<input type="submit" name="Submit" value="Registrar" id="btn_input" class="visualizar"/> 
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
										
										
										
									</center>
								</td> 
								
						  	</tr> -->
							
							<!-- ----------------------------------------------------------------------------------------------- -->
							
							<tr>
								<td colspan="4">
									
									<center>
									
										<label style="width:151px; color:#FF0000">ESTRUCTURA ARCHIVO EN EXCEL (CON ENCABEZADOS)</label>
									
									</center>
								</td>
								
							</tr>
							
							<tr>
								<td colspan="4">
									
									<center>
									
										<label style="width:151px; color:#FF0000">GUARDAR EL ARCHIVO A PROCESAR CSV(delimitado por comas)</label>
									
									</center>
								</td>
								
							</tr>
							
							<tr>
								
								<td colspan="3">
									<center>
										
										<img src="views/images/ACTU_MASIVO.png" width="800" height="200"/>
											
									</center>
								</td> 
								
						  	</tr>
							
							
						
				
						</table>
					
					</form>
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	

<?php 
	require 'alertas.php';
	
	
	echo '<script languaje="JavaScript"> 
			
	
				$("#imgloading_masivo").hide();
				
						
		</script>';
?>
</body>
</html>


