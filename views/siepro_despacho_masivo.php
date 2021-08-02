<?php 
	

	//TITULO FORMULARIO
	$titulo     = "REGISTRO A DESPACHO MASIVO";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//$fechaactual = '2017-08-30';
	
	
	//LISTAS
	
	$nombrelista_5  = 'pa_juzgado';
	$campoordenar_5 = 'nombre';
	$filtro_5       = 'WHERE id IN (15,16)';
	$formaordenar_5 = '';
	$datosjuzgado_5 = $modelo->get_lista_filtro($nombrelista_5,$campoordenar_5,$filtro_5,$formaordenar_5);
	
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
<script src="views/js/ajax/ajax_siepro_masivo.js" type="text/javascript" charset="utf-8"></script>

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
	
	
	$("#fechaii").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechaif").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	
	$("#revisasecre").click(function(evento){
	
		
		
		
		if( 
				
			   $('#fechaii').val().length              == 0 && 
			   $('#fechaif').val().length              == 0 &&
			   $('#idjuzgadorepartomx').val().length   == 0 
			   
		) {
				
				alert("Definir Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado");
		
				document.getElementById('fechaii').style.borderColor             =  '#FF0000';
				document.getElementById('fechaif').style.borderColor             =  '#FF0000';
				document.getElementById('idjuzgadorepartomx').style.borderColor  =  '#FF0000';
				
		}
		else{
				
				//alert("BUSCANDO...");
		
		
				dato_0 = 0;
				
				//FECHAS REGISTRO
				dato_1 = $('#fechaii').val(); 
				dato_2 = $('#fechaif').val();
				
			   
				datox1 = $('#idjuzgadorepartomx').val();
				
				if(datox1 == 15){
			
					datox1 = 1;
			
				}
				if(datox1 == 16){
				
					datox1 = 2;
				
				}
				
				
				location.href="index.php?controller=archivo&action=Revisar_Procesos_Despacho&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
				
				
		
		}
		
	
	});
	
	$(".generarexcelmemorial").click(function(){
	
		//alert(1);
		
		
		if (
		
			document.getElementById('fechaii').value.length  			== 0 &&
			document.getElementById('fechaif').value.length  			== 0 &&
			document.getElementById('idjuzgadorepartomx').value.length  == 0  
			
		){
			
			/*dato_0  = 5;//para saber que es el reporte 5
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=archivo&action=GenerarProcesosVentanillaExcel&opcion="+dato_0+"&tfiltro="+tfiltro;*/
			
			
			alert("Definir Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto");
			document.getElementById('fechaii').style.borderColor = '#FF0000';
			document.getElementById('fechaif').style.borderColor = '#FF0000';
			document.getElementById('idjuzgadorepartomx').style.borderColor = '#FF0000';
       	
		}
		else{
		
			//dato_0 = 1;
			dato_1 = document.getElementById('fechaii').value;
			dato_2 = document.getElementById('fechaif').value;
		
			datox1 = document.getElementById('idjuzgadorepartomx').value;
			
			
			//alert(dato_1+"******"+dato_2+"******"+datox1);
	
			dato_0  = 7000;//para saber que es el reporte 5
			tfiltro = 1;//con filtro
			
			
			//alert(datox1);
			
			if(datox1 == 15){
			
				datox1 = 1;
			
			}
			if(datox1 == 16){
			
				datox1 = 2;
			
			}
			
			location.href="index.php?controller=correspondencia&action=exportarCorrespondenciaExcelMemoriales&nombre="+dato_0+"&tfiltro="+tfiltro+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
		
		
	
    });
	
	
	
});

</script>	

 
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
    		<td>
				
				<div id="contenido">
				
					<form id="frm_masivo1" name="frm_masivo1"  method="post" enctype="multipart/form-data" action="">
					
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha:</label>
								</td>
								
								<td colspan="2">
									<input type="text" name="fechae" id="fechae" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
									
									
								</td>
								
					
							</tr>
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Archivo</label>
								</td>
								
								<td colspan="2">
									<input type="file" name="archivo" id="archivo" class="required" title="Archivo"/>
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado a Descartar:</label>
								</td>
								
								<td>
									<input type="text" name="radidl" id="radidl">
								</td> 
								
								<td>
										
										
									<a id="descartarlista" href="javascript:void(0);"><img src="views/images/listar.png" width="65" height="45" title="DESCARTAR RADICADO DE LA LISTA"/>DESCARTAR RADICADO DE LA LISTA</a>
										
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
							<tr id= "filabotones_masivo">
								
								<td colspan="3">
									
									<center>
										<input type="submit" name="Submit" value="Registrar" id="btn_input" class="visualizar"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
							
							
							<tr>
								
								
								
								
								<td>
										
										
									<a id="revisasecre" href="javascript:void(0);"><img src="views/images/revi1.jpg" width="45" height="45" title="REVISADO DESDE SECRETARIA"/>REVISADO DESDE SECRETARIA</a>
										
								</td>
								
								<td> 
			
									<a class="generarexcelmemorial" href="javascript:void(0);">
										<img src="views/images/ab.png" width="40" height="40" title="LISTA DE PROCESOS EN EXCEL CON MEMORIAL INCORPORADO PARA ENVIAR A DESPACHO, PARA ESTA OPCION DEFINA Fecha Inicial Incorpora, Fecha Final Incorpora y Juzgado Reparto"/>
										EXCEL A DESPACHO MASIVO
									</a>
									
								</td>
							
							</tr>
							
							
							<tr>
								
								<td>
									 <label for="input_1">Fecha Inicial Incorpora</label>
		  							 <input type="text" name="fechaii" id="fechaii" readonly="true">
								</td>
								
								<td>
									 <label for="input_1">Fecha Final Incorpora</label>
		  							 <input type="text" name="fechaif" id="fechaif" readonly="true">
								</td>
								
							 </tr>
							 
							 <tr>
							 
							 	<td colspan="2">
								
									<label for="input_3">Juzgado</label>
							 
								  	<select name="idjuzgadorepartomx" id="idjuzgadorepartomx">
																			
										<option value="" selected="selected">Seleccionar</option> 
																							
										<?php
											while($row = $datosjuzgado_5->fetch()){
											
											
												echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
																										
												/*if($row[id] == trim($_GET['datox7'])){					
																										
													echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[nombre] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
												}*/
																										
																										
											}
										?>
										
									</select>
								
								
								</td>
							 
							 </tr>
							
							
							
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
										
										<img src="views/images/encabezadodespacho.jpg" width="400" height="400"/>
											
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


