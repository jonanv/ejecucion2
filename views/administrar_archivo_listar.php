<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "ADMINISTRAR ARCHIVO LISTAR";
	$subtitulo  = "ADMINISTRAR ARCHIVO LISTAR";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new administrarModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	$nombrelista  = 'pa_year';
	$campoordenar = 'year';
	$datosyear = $modelo->get_lista($nombrelista,$campoordenar);
	
	
	$nombrelista  = 'pa_nombrecarpeta';
	$campoordenar = 'descarpeta';
	$datoscarpeta = $modelo->get_lista($nombrelista,$campoordenar);
	
	
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		$opcion_2 = 0;

		//DATOS PROCESO	
		$datosadministra    = $modelo->busquedad_filtro_archivo();
		
		//*********************CANTIDAD REGISTROS*****************************************
		//REALIZO ESTE CAMBIO PARA SABER EXACTAMENTE CUANTOS REGISTROS TRAE LA CONSULTA
		//YA QUE COMO SE APLICA GROUP BY t1.id EN LA CONSULTA, AL USAR LA FUNCION
		//cantidad_audiencia() NO DA EL MISMO VALOR
		/*$cantidadaudiencia = $modelo->cantidad_audiencia();
		$fila              = $cantidadaudiencia->fetch();
		$cantregis         = $fila[CANTIDADAUDI];*/
		
		$datosadministra_cant = $modelo->busquedad_filtro_archivo();
		
		$fc = 0;
		while($fila_cant = $datosadministra_cant->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	



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
<script src="views/js/ajax/ajax_administrar.js" type="text/javascript" charset="utf-8"></script>

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
	
	$("#fechariarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fecharrfarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	$("#fechaiarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechafarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	
	
});

</script>	

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		require 'secc_administrar.php';
		
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
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							<!-- <tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="170014003"/>
								</td>
								
							</tr> -->
							
							<tr>
										
								<td>
									<label style="width:151px; color:#666666">Fecha Registro Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechariarchivo" id="fechariarchivo" readonly="true"  value="<?php echo $_GET['dato_1']; ?>">
								</td>
								
								<td>
									<label style="width:151px; color:#666666">Fecha Registro Final:</label>
								</td>
								<td>
									<input type="text" name="fecharrfarchivo" id="fecharrfarchivo" readonly="true" value="<?php echo $_GET['dato_2']; ?>">
								</td>
							
							</tr>
							
							<tr>
								
								<td>
											
									<label style="width:151px; color:#666666">Year:</label>
												
											
								</td>
											
									<td colspan="3">
															
										<select name="yeararchivo" id="yeararchivo" class="required">
												
													
										<option value="" selected="selected">Seleccionar Year</option>
															
										<?php
											while($row = $datosyear->fetch()){
												
												
												if($row[year] == trim($_GET['datox1'])){ 
												
													echo "<option value=\"". $row[year] ."\" selected=selected>" . $row[year] . "</option>";
												}
												else{
																		
													echo "<option value=\"". $row[year] ."\">" . $row[year] . "</option>";
													
												}
																	
											}
										?>
										</select>
									</td>
											
							</tr>
							
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Caja:</label>
								</td>
								<td colspan="3">
												
									<input type="text" name="cajaarchivo" id="cajaarchivo" class="required" onKeyPress="return Solo_Numeros(event)" value="<?php echo $_GET['datox2']; ?>"/>
								</td>
											
							</tr>
							
							
							<tr>
							
								<td colspan="4">
									
									<table border="0" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes">
		  	
										
										
										<tr>
								
											<td>
														
												<label style="width:151px; color:#666666">Nombre Carpeta:</label>
															
														
											</td>
														
											<td colspan="3">
																		
													<select name="carpetaarchivo" id="carpetaarchivo">
															
																
													<option value="" selected="selected">Seleccionar Nombre Carpeta</option>
																		
													<?php
														while($row = $datoscarpeta->fetch()){
															
															if($row[id] == trim($_GET['datox3'])){ 
															
																echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[descarpeta] . "</option>";
															}
															else{						
															
																echo "<option value=\"". $row[id] ."\">" . $row[descarpeta] . "</option>";
															}
																				
														}
													?>
													</select>
											</td>
														
										</tr>
										
										<tr>
											
											
											<td>
												<label style="width:151px; color:#666666">Numero Carpeta:</label>
											</td>
											<td colspan="3">
															
												<input type="text" name="numerocarpeta" id="numerocarpeta" onKeyPress="return Solo_Numeros(event)" value="<?php echo $_GET['datox4']; ?>"/>
											</td>
														
										</tr>
										
										
										<tr>
										
											<td>
												<label style="width:151px; color:#666666">Fecha Inicial:</label>
											</td>
											<td>
												<input type="text" name="fechaiarchivo" id="fechaiarchivo" readonly="true" value="<?php echo $_GET['dato_3']; ?>" onchange="Fechas_Seleccionada()">
											</td>
											
											<td>
												<label style="width:151px; color:#666666">Fecha Final:</label>
											</td>
											<td>
												<input type="text" name="fechafarchivo" id="fechafarchivo" readonly="true" value="<?php echo $_GET['dato_4']; ?>" onchange="Fechas_Seleccionada()">
											</td>
										
										</tr>
										
										<tr>
											
											
											<td>
												<label style="width:151px; color:#666666">Consecutivo Inicial:</label>
											</td>
											<td>
															
												<input type="text" name="coninicial" id="coninicial" onKeyPress="return Consecutivos_Seleccionados(event)" value="<?php echo $_GET['datox5']; ?>" />
											</td>
											
											<td>
												<label style="width:151px; color:#666666">Consecutivo Final:</label>
											</td>
											<td>
															
												<input type="text" name="confinal" id="confinal" onKeyPress="return Consecutivos_Seleccionados(event)" value="<?php echo $_GET['datox6']; ?>"/>
											</td>
														
										</tr>
										
										
		
									</table>
								
								</td>
								
							</tr>
							
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr>
							
	
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="4">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="buscarxfiltro">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_2"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
					
					 </form> 
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	if(!empty($opcion)){ 
	?>
	
	<!-- NOTA: SE CIERRA LAS COLUMNAS Y CAMPOS, YA QUE NO SON NECESARIOS SU VISIVILIDAD, SI SE NECESITAN SIMPLEMENTE SE DESCOMENTAN -->
	<table border="0" align="center"  rules="rows" id="tbuscarxfiltroconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="tbuscarxfiltro">
																						
										<thead> 
											
											
											<tr> 
											
												<th colspan="15">
													<strong style="width:151px; color:#FF0000; font-size:16px"><?php echo "REGISTROS: ".$cantregis; ?></strong>
												</th>
											
											</tr>
											
											<tr>
											
												<th colspan="15">
													<a class="generar_excel" href="javascript:void(0);" title="GENERAR EXCEL" data-valorradi="<?php echo trim($d12);?>"><img src="views/images/excel_1.jpg" width="55" height="55" title="GENERAR EXCEL"/></a>
													
												</th>
											</tr>
											
											
											<tr> 
											
												<th colspan="6">
													<center><strong style="width:151px; color:#FF0000; font-size:16px"><?php echo "ENCABEZADO"; ?></strong></center>
												</th>
												
												<th>|</th>
												
												<th colspan="15">
													<center><strong style="width:151px; color:#FF0000; font-size:16px"><?php echo "DETALLE"; ?></strong></center>
												</th>
												
											</tr>
											

											<tr> 
											
												<th>
													<strong style="width:151px; color:#FF0000; font-size:10px">EDITAR ENCABEZADO</strong>
												</th>
												
												<th>
													<strong style="width:151px; color:#FF0000; font-size:10px">EDITAR DETALLE</strong>
												</th>
																							
												<th>ID ARCHIVO</th>
												<th>YEAR</th>
												<th>CAJA</th>
												<th>FECHA REGISTRO</th>
												
												<th>|</th>
												
												<th>ID DETALLE</th>
												<th>ID CARPETA</th>
												<th>CARPETA</th>
												<th>NUN CARPETA</th>
												<th>FECHA INICIAL</th>
												<th>FECHA FINAL</th>
												<th>CONSECUTIVO INICIAL</th>
												<th>CONSECUTIVO FINAL</th>
												
			
												
											</tr> 
											
											
											
										</thead>
										
										<tbody>  								
																	
											<?php
											
												
									
												while($fila = $datosadministra->fetch()){
				
															//$fila = $datosaudiencia->fetch();
																
															$d0  = $fila[idarchivo];
															$d1  = $fila[year];
															$d2  = $fila[caja];
															$d3  = $fila[fechsuperior];
															$d4  = $fila[iddetalle];
															$d5  = $fila[idcarpeta];
															$d6  = $fila[descarpeta];
															$d7  = $fila[numerocarpeta];
															$d8  = $fila[fechainicial];
															$d9  = $fila[fechafinal];
															$d10 = $fila[coninicial];
															$d11 = $fila[confinal];
															
															
															
											?>
											
								
															
							
															<tr>
																
																
																<td>
																	<a class="editar_encabezado" href="javascript:void(0);" title="EDITAR ENCABEZADO" data-idarchivo="<?php echo trim($d0);?>" data-year="<?php echo trim($d1);?>" data-caja="<?php echo trim($d2);?>" data-fechasuperior="<?php echo trim($d3);?>"><img src="views/images/modficar.jpg" width="30" height="30" title="EDITAR ENCABEZADO"/></a>
																</td>
																				
																<td>
																	<a class="editar_detalleencabezado" href="javascript:void(0);" title="EDITAR DETALLE" data-idarchivo="<?php echo trim($d0);?>" data-iddetalle="<?php echo trim($d4);?>" data-idcarpeta="<?php echo trim($d5);?>" data-numerocarpeta="<?php echo trim($d7);?>" data-fecinicial="<?php echo trim($d8);?>" data-fecfinal="<?php echo trim($d9);?>" data-coninicial="<?php echo trim($d10);?>" data-confinal="<?php echo trim($d11);?>"><img src="views/images/memo2.png" width="30" height="30" title="EDITAR DETALLE"/></a>
																</td>
																
																																			
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d0;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d1;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d2;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d3;  
																	?>
																</td>
																
																<td>
																	|
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d4;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d5;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d6;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d7;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d8;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d9;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d10;  
																	?>
																</td>
																
																<td style="font-size:10px ">
																	<?php 
																													  
																		echo $d11;  
																	?>
																</td>
																
																											
															</tr>
																									
																												
															<?php  } ?>
																												
											</tbody>
											
										</table>
										
						
						</td>
						
					</tr>
			
			
			</table>		
			
			<?php
			} 
			?>
	
	
<?php require 'alertas.php';?>
</body>
</html>


