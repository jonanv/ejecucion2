<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$idusuario  = $_SESSION['idUsuario'];
	
	//TITULO FORMULARIO
	$titulo     = "Filtrar Hoja de Vida";
	$subtitulo  = "Hojas de Vida";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo = new hojavidaModel();
	
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	

	$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
	
		$datos_HV = $modelo->get_datos_hojas_vida(1);
	}
	else{
		$datos_HV = $modelo->get_datos_hojas_vida(2);
	}
	 
	/*echo '<script languaje="JavaScript">
            
      	var folder_usuario_1 ="'.$idusuario.'";
		
    
	</script>';*/
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
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
<script src="views/js/ajax/ajax_hojavida.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">


<!-- PARA EL FUNCIONAMIENTO DEL ARBOL ESTILO WINDOWS PARA LISTAR LOS ARCHIVOS SCANEADOS -->
<link rel="stylesheet" type="text/css" href="views/viewstree/jqueryFileTree.css" media="screen" />
<!-- <script type="text/javascript" src="jquery-1.3.2.min.js"></script> -->
<script type="text/javascript" src="views/viewstree/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="views/viewstree/jqueryFileTree.js"></script>


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
	$("#fechai").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechaf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	$('#fila_botones').show();
});



</script>	

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo	
		require 'secc_administrar.php';
		
		
	?>			
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id ="popupbox"></div>
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
			<td bgcolor="#CDE3F9">
				<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
			</td>
		</tr>
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
					
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							<tr>
								<td>
									<label style="width:151px; color:#FF0000; font-size:14px">CEDULA:</label>
								</td>
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required number" value="<?php echo trim($_GET['datox1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Nombre:</label>
								</td>
								<td>
									<input type="text" name="hvnombre" id="hvnombre" class="required" value="<?php echo trim($_GET['datox2']); ?>">
								</td>
				
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Fecha Final:</label>
								</td>
								<td>
									<input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>
							
							</tr>
							
						
			
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id="fila_botones">
								
								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrarhv">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_2"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
			
						</table>
					
					</form>
			
				
			</td>
		</tr>
		
		
	</table>
	
	
	
	<br>
	
	<!-- NOTA: SE CIERRA LAS COLUMNAS Y CAMPOS, YA QUE NO SON NECESARIOS SU VISIVILIDAD, SI SE NECESITAN SIMPLEMENTE SE DESCOMENTAN -->
	<table border="0" align="center"  rules="rows" id="tablaconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
										
							<thead> 
										<tr>
											<th bgcolor="#CDE3F9" colspan="5">
												<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
											</th>
										</tr>
										<tr> 
											<th>ID</th>
											<th>CEDULA</th>
											<th>NOMBRE</th>
											<th>SOPORTES</th>
											<th>GENERAR HV</th>
											
										</tr> 
									</thead> 
													
									<tbody> 
													
										<?php 
											  $modelo = new hojavidaModel(); 
											  
											  while($row = $datos_HV->fetch()){ ?>
											
											
											
											<tr>
												<td>
													
													<?php 
													
														echo $row[id];
														
														//CALCULA EL PROCENTAJE DE DILIGENCIA DE LA HV
														//EN ESTE PUNTO LA PERSONA YA REGISTRO SUS DATOS GENERALES
														//ES DECIR SOLO SE TIENE EN CUENTA QUE SE TENGA AL MENOS
														//1 ESTUDIOS, 1 EXPERIENCIA LABORAL, 1 CONOCIMIENTOS
														//1 REFERENCIAS (LABORAL O PERSONAL) REGISTRADA
														//PARA REALIZAR EL CALCULO Y QUE EXISTE ALMENOS UN SOPORTE
														//SCANEADO Y CARGADO DE ESTUDIO,EXPERIENCIA Y CERTIFICADO
														$procentaje_HV         = 0;
														$procentaje_soporte_HV = 0;
														
														$procentaje_HV_GENERAL = $modelo->get_procentaje_hoja_vida_general($row[cedula]);
														$procentaje_HV         = $modelo->get_procentaje_hoja_vida($row[id]);
														
														//ASIGNO EN $id_cedula_user EL ID DE LA TABLA pa_usuario
														//RELACIONADA CON EL PARAMETRO ENVIADO $row[cedula]  
														$id_cedula_user        = $modelo->get_idsesion_usuario($row[cedula]);
														$procentaje_soporte_HV = $modelo->get_procentaje_soportes_hoja_vida($id_cedula_user);
														
														$procentaje_HV = $procentaje_HV_GENERAL + $procentaje_HV + $procentaje_soporte_HV;
														
														if($procentaje_HV >= 9){
														
															$procentaje_HV = "100%";
															
														
														}
														else{
														
															$calculo_porcentaje = ($procentaje_HV * 100) / 9;
															$procentaje_HV = number_format($calculo_porcentaje, 0, ',', '.')."%";
															
														}
														
													?>
													
												</td>
												
												<td>
													<?php 
														echo $row[cedula];
														
														$id_user = $modelo->get_idsesion_usuario($row[cedula]);
														
														//echo $id_user;
														
														
														
													?>
												</td>
												<td><?php echo $row[nombre];?></td>
												
												<!-- <td>
								
													<table border="0" align="center" id="tabla_soporte_estudios_lista" style="width:300px">
							
													
														
														<tr>
															<td><div id="JQueryFTD_Demo_lista" class="demo"></div></td>
														</tr>
														
																
													</table>
												
												</td> -->
												
												<td>
									
									
													<a class="so_hojavida_l" href="javascript:void(0);"  style="float:none" data-iduserfolder="<?php echo $id_user; ?>" data-hvcedula="<?php echo $row[cedula];?>" data-hvnombre="<?php echo $row[nombre];?>"><img src="views/images/doc1.jpg" width="35" height="35" title="SOPORTES"/></a>
									
									
												</td>
												
												
												<td>
													<!-- <a class="anotacion" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="REGISTRAR ANOTACION"/></a> -->
													
													<a class="generar_hojavida_pdpf_admin" href="javascript:void(0);" data-idhv="<?php echo $row['id'];?>"><img src="views/images/hv_4.png" width="100" height="100" title="GENERAR HV"/><?php echo $procentaje_HV; ?></a>
												</td>
												
												
							
											</tr>
									
										<?php } ?>
													
									</tbody>
						</table>
						
					</td>
				</tr>
			
			
		</table>		
			
			

	
		
<?php require 'alertas.php';?>
</body>
</html>


	
