<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "110 MASIVO";
	$subtitulo  = "110 MASIVO";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	$nombrelista  = 'pa_tipo_correspondencia';
	$campoordenar = 'des';
	$formaordenar = '';
	$datostipodoc = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosjd = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'pa_solicitud';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosts = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	

	//DATOS TRAS 110	
	
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosTRAS110_1 = $modelo->busquedad_filtro_TRAS110();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosTRAS110 = $modelo->busquedad_filtro_TRAS110();
		
		$fc = 0;
		while($fila_cant = $datosTRAS110->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosTRAS110_1 = $modelo->busquedad_actual_TRAS110($fechaactual);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosTRAS110 = $modelo->busquedad_actual_TRAS110($fechaactual);
		
		$fc = 0;
		while($fila_cant = $datosTRAS110->fetch()){		
		
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
<!-- <script src="views/js/jquery.js" type="text/javascript"></script> -->
<script src="views/js/jquery_NV.js" type="text/javascript"></script> 

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

<!-- <script src="views/js/jquery.validate.js" type="text/javascript"></script> -->
<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>


<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<!-- <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8"> -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_siepro.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ >

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
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
	
	$("#fechasri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrei_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasref_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdi_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdf_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	//$("#fechasre").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	
});


</script>	




<style type="text/css">

.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}


.contenedor_editar{margin:60px auto;width:960px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	th {padding:5px; background-color:#CDE3F6;}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable span{display:block;}
		.editable span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
	.checkbox110{height:24px;width:20px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}

</style> 

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		require 'secc_archivo.php';
		
	?>			
	
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
				
					<form id="frm_M" name="frm_M" method="post" enctype="multipart/form-data" action="">
					
						
						<input name="datospartes_m" id="datospartes_m" type="hidden" readonly="true"/>
						<input name="fechas_m" id="fechas_m" type="hidden" readonly="true"/>
						<input name="datospartes_m110" id="datospartes_m110" type="hidden" readonly="true"/>
						
												
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Registro:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechasr110" id="fechasr110" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							

							<tr>
							
								<td colspan="2">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_memo">
		  	
										<tr>
											<td colspan="2">
												
												<button type="button" name="boton_adicionar_110m" id="boton_adicionar_110m" title="Adicionar 110 Masivo" onClick="Adicionar_110_Masivo(1)"><img src="views/images/add_memo.png" width="30" height="30"/></button>
											
											</td>
										</tr>
										
										<!-- <tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px ">ID:</label><br>
											</td>
										
											<td>
												<input type="text" name="idradi110" id="idradi110" style="color:#FF0000; font-size:16px"/>
											</td>
										
										</tr> -->
										
										
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Radicado:</label><br>
											</td>
										
											<td>
												<input type="text" name="radicado110m" id="radicado110m" class="required number" value="<?php echo trim($_GET['datox1']); ?>" onblur="Proceso_Bloqueado(this.value)"/>
											</td>
										
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha:</label><br>
											</td>
										
											
											<td>
												<input type="text" name="fecha110m" id="fecha110m" class="required" readonly="true">
											</td>
										
										</tr>
										
										
										
		
									</table>
								
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2">
									<center><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">TABLA PROCESOS</label><br></center>
								</td>
										
							</tr>
										
							
							<tr>
							
								<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_m"> 
													<table id="t_m" border="1"> 
														<tr>
															
															<!-- <td>
																<strong>ID</strong>
															</td> -->
															<td>
																<strong>RADICADO</strong>
															</td>
															<td>
																<strong>FECHA FIJACION</strong>
															</td>
															
															<td>
																<strong>ELIMINAR</strong>
															</td>
															
														</tr> 
													</table>
												</div>
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
								
								<td colspan="2">
									
									<center>
										<input type="submit" name="Submit" class="btn_validar_3M" value="Registrar" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_3b"/>
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
	
	
	
	
	<!-- FILTROS -->
	<table border="0" align="center"  rules="rows" id="tbuscarxfiltroconsulta">
		
			
		<tr>
					
			<td>
					
					
				<table cellpadding="0" cellspacing="0" rules="rows" border="1">
																						
										
					<tr> 
											
						<td colspan="5">
							<center>
								<strong style="width:151px; color:#FF0000; font-size:16px">TRASLADOS 110<?php echo " / REGISTROS: ".$cantregis; ?></strong>
							</center>
						</td>
											
					</tr>
											
					<tr>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasri_m" id="fechasri_m" value="<?php echo trim($_GET['dato_1']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
						</td>
						<td>
							<input type="text" name="fechasrf_m" id="fechasrf_m" value="<?php echo trim($_GET['dato_2']); ?>">
						</td>
												
						<td>
							<a class="buscarxfiltro_TRAS110" href="javascript:void(0);" title="BUSCAR TRASLADO 110">
								<img src="views/images/lupa.png" width="45" height="45" title="BUSCAR TRASLADO 110"/>
							</a>
													
							<a class="generar_TRAS110_COMPLETO" href="javascript:void(0);" title="GENERAR TRASLADO 110 COMPLETO">
								<img src="views/images/archivo_3.png" width="45" height="45" title="GENERAR TRASLADO 110 COMPLETO"/>
							</a> 
						</td>
												
					</tr>
					
					
					<tr>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Fijacion Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechaTRASI" id="fechaTRASI" value="<?php echo trim($_GET['dato_3']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Fijacion Final:</label>
						</td>
						<td colspan="2">
							<input type="text" name="fechaTRASF" id="fechaTRASF" value="<?php echo trim($_GET['dato_3']); ?>">
						</td>
												
						
												
					</tr>
											
					
											
				</table>
										
						
			</td>
						
		</tr>
			
			
	</table>		
			
	<!-- SE LISTA LA CORRESPONDENCIA-->		
			
	<!-- <div class="mensaje"></div> -->
	
	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){ 
	?>
						
	<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="ttras110">
																						
										
		<tr> 
											
			<th style="color:#FF0000">ID</th>
			<th>RADICADO</th>
			<th>IDRAD</th>
			<th>FECHA REGISTRO</th>
			<th>FECHA FIJACION</th>
			<th>FECHA INICIAL</th>
			<th>FECHA FINAL</th>
			<th>OBSERVACIONES</th>
			<th>									
				<a class="marcar_110" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a>
			</th>
											
			<th>										
				<a class="desmarcar_110" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos"/></a>
			</th>
			
			<th>GENERAR</th>
					
		</tr> 
		
		
		<?php
											
			$Ct110=1;
							
			while($fila = $datosTRAS110_1->fetch()){
				
																		
				$d1M = $fila[id];
				$d2M = $fila[radicado];
				$d3M = $fila[idcorrespondencia];
				$d4M = $fila[fecha];
				$d5M = $fila[fecha_tras110];
				$d6M = $fila[fecha_tras110_i];
				$d7M = $fila[fecha_tras110_f];
				$d8M = $fila[observacion];
															
												
		?>
											
								
				<tr>
																
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d1M;  
						?>
					</td>
					
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d2M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d3M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d4M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d5M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d6M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d7M;  
						?>
					</td>
					<td style="font-size:12px ">
						<?php 
																													  
							echo $d8M;  
						?>
					</td>
					
					
					
					<td>
						<input type="checkbox" name="<?php echo "chk".$Ct110;?>" id="<?php echo "chk".$Ct110;?>" value="<?php echo "chk".$Ct110;?>" title="<?php echo "chk".$Ct110;?>" class="checkbox110"/>
					</td>
					
					<td></td>
					
					<td>
						<a class="generar_TRAS110" href="javascript:void(0);" title="GENERAR TRASLADO 110" data-id="<?php echo trim($d3M);?>" data-radicado="<?php echo trim($d2M);?>" data-tras110="<?php echo trim($d5M);?>"><img src="views/images/archivo_3.png" width="30" height="30" title="GENERAR TRASLADO 110"/></a>
					</td>
					
			</tr>
			
			<?php  $Ct110=$Ct110+1; } ?>		
											
	</table>
	
	
	
	<?php
	//}
	?>
	
	
	<?php 

	//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
	//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
	/*echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';*/
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


