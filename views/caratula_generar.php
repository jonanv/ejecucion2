<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$idusuario  = $_SESSION['idUsuario'];
	
	//TITULO FORMULARIO
	$titulo     = "Filtrar Proceso";
	$subtitulo  = "Tabla Procesos";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new caratulaModel();

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	

	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion != 1){
	
		//$datosproceso = $modelo->get_datos_proceso(1);
		$datosproceso = $modelo->get_datos_proceso_x(1);
		
		//$datosproceso_2 = explode("//////",$datosproceso);
		$datosproceso_2 = explode("******",$datosproceso);
		$cantr          = count($datosproceso_2);
		
		
	}
	else{
		//$datosproceso = $modelo->get_datos_proceso(2);
		$datosproceso = $modelo->get_datos_proceso_x(2);
		
		//$datosproceso_2 = explode("//////",$datosproceso);
		$datosproceso_2 = explode("******",$datosproceso);
		$cantr          = count($datosproceso_2);
	}
	
	
	//echo $cantr;
	//print_r($datosproceso);
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
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_caratula.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<!-- <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ > -->

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

	// <!-- TABLA id:frm_editar2-->
	/*$('#frm_editar1').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null]
		
	} );*/
	
	$(".migrar_tutela").click(function(){
	
		var idradicado = $(this).attr('data-idtutela');
		
		$.get("funciones/traer_datos_radicado_justiciaXXI.php?idradicado="+idradicado, function(cadena){
				console.log(cadena);
	
				//alert(cadena);
				
				var datos = cadena.split("//////");
				
				if(cadena == 0){
					
					
					alert("NO EXISTEN DATOS EN JUSTICIA XXI, NO ES POSIBLE MIGRAR TUTELA");
					
				}
				if(cadena == 1){
					
					alert("NO SE PUEDE CONECTAR A LA BASE DE DATOS DE JUSTICIA XXI");
					
					location.href="index.php?controller=caratula&action=Caratula";
					
				}
				
				if(cadena == 2){
					
					alert("ERROR EN CARGA DE DATOS, REVISAR CONSULTA $SQL");
					
					location.href="index.php?controller=caratula&action=Caratula";
					
				}
				
				//SE REALIZA OPERACION DE MIGRACION
				if(cadena != 0 && cadena != 1 && cadena != 2){
				
					//alert(cadena);
					
					location.href="index.php?controller=caratula&action=Migrar_Tutela&datospartesXX="+cadena+"&valorradicado="+idradicado;
				
				}
				
				
		} );
		
		
	
	} );
		

});

</script>	
 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_caratula.php';
		
	?>			
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				<div id="contenido">
				
					<form id="frmcaratula" name="frmcaratula" method="post" enctype="multipart/form-data" action="">
					
						<input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/>
						
						<!-- PARA ACTUALIZAR UN DOCUMENTO -->
						<input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php echo $d0; ?>">
						<!-- PARA SABER CUANTAS PARTES SE LE ASIGNARON MAS AL DOCUMENTO -->
						<input name="partesdoc" id="partesdoc" type="hidden" readonly="true"/>
						
						
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							
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
							
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required number" value="<?php echo trim($_GET['datox1']); ?>">
								</td>
								<!-- <td colspan="2">
									<a class="generarcaratula_2" href="javascript:void(0);"><img src="views/images/caratula6.jpg" width="40" height="40" title="GENERAR CARATULA"/>OPCION QUE PERMITE GENERAR LA CARATULA CUANDO EL RADICADO NO SE ENCUENTRA EN LA TABLA PROCESOS</a>
								</td> -->
				
							</tr>
							
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrarproceso">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
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
	//if(!empty($opcion)){ 
	?>
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
											<th style="text-align:center">NUM</th>
											<th style="text-align:center">RADICADO</th>
											<th style="text-align:center">FECHA</th>
											<th style="text-align:center">HORA</th>
											<th style="text-align:center">MIGRAR</th>
										</tr> 
									</thead> 
													
									<tbody> 
													
										<?php 
										
											$i= 0; 
											$registro = 1; 
											
											while($i < $cantr - 1) /*while($row = $datosproceso->fetch())*/{ 
										
											$datosproceso_2X = explode("//////",$datosproceso_2[$i]);
											
											// Envia radicado
											print_r($datosproceso_2X[0]);
											$EXISTE_PROCESO = $modelo->get_datos_PROCESO_MIGRAR(trim($datosproceso_2X[0]));
											
											
										?>
											
											
											
											<tr>
												
												<!-- <td style="text-align:center">
													<?php //echo $registro;?>
												</td> -->
												
												
												<?php
													
													
													
												if($EXISTE_PROCESO == 0){ ?>	
													
														
													<td style="text-align:center; background-color:#669933; color:#FFFFFF">
															
														<?php echo $registro." - "."NO MIGRADA";?>
													
												<?php 
												}
												else{ ?>
														
													<td style="text-align:center">
															
														<?php echo $registro;?>
														
												<?php 
													
												} 
													
												?>
														
														
														
													</td>
												
												<td style="text-align:center">
													<?php echo $datosproceso_2X[0];?> <!-- RADICADO -->
												</td>
												
												<td style="text-align:center">
													<?php echo $datosproceso_2X[1];?> <!-- FECHA -->
												</td>
												
												<td style="text-align:center">
													<?php echo $datosproceso_2X[2];?> <!-- HORA -->
												</td>
												
												<td style="text-align:center">
												
													<a class="migrar_tutela" 
														href="javascript:void(0);" 
														data-idtutela="<?php echo trim($datosproceso_2X[0]);?>">
														<img src="views/images/migrarT.png"
															width="45" 
															height="45" 
															title="MIGRAR TUTELA"/>
													</a>
												
												</td>
												
											
											</tr>
									
										<?php 
											$i= $i + 1; 
										
											$registro = $registro + 1;
											
											} 
										?>
													
									</tbody>
							</table>
						
						</td>
					</tr>
			
			
			</table>		
			
			<?php
			//} 
			?>

		
<?php require 'alertas.php';?>
</body>
</html>


	
