<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "TITULOS MATERIALIZADOS";
	$subtitulo  = "TITULOS MATERIALIZADOS";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	

	//OBTENEMOS DATOS DEL PROCESO
	$idradicado = trim($_GET['idradicado']);
	
	$datosproceso   = $modelo->get_datos_proceso($idradicado);
	$fdatos         = $datosproceso->fetch();
	$idpro	        = $fdatos[idproceso];
	$radi	        = $fdatos[radicado];
	$cde	        = $fdatos[cedula_demandante];
	$nde	        = $fdatos[demandante];
	$cdo	        = $fdatos[cedula_demandado];
	$ndo	        = $fdatos[demandado];
	$idjo	        = $fdatos[idjuzgadoorigen];
	$njo	        = $fdatos[nombrejuzgadoorigen];
	
	

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
<!-- <script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css"> -->

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
	
	
});

</script>	

 
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
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input name="idradicado" id="idradicado" type="hidden" readonly="true"  value="<?php echo $idpro; ?>"/>
									<input type="text" name="radicado" id="radicado" readonly="true"  value="<?php echo $radi; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2"> 
								
									<table border="0" align="center" width="800">
									
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandante</label><br><br>
												<input type="text" name="cedula_demandante" id="cedula_demandante" class="required" readonly="true" value="<?php echo $cde; ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandante</label><br><br>
												<input type="text" name="demandante" id="demandante" class="required" readonly="true" value="<?php echo $nde; ?>"/>
											</td>
											
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
												<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true" value="<?php echo $cdo; ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandado</label><br><br>
												<input type="text" name="demandado" id="demandado" class="required" readonly="true" value="<?php echo $ndo; ?>"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan="2">
												<label style="width:151px; color:#666666">Juzgado:</label><br><br>
												<input type="text" name="userjuzgado" id="userjuzgado" class="required" value="<?php echo $njo; ?>" readonly="true">
												<!-- <input type="hidden" name="juzgadoorigen" id="juzgadoorigen" class="required" value="<?php echo $idjo; ?>" readonly="true"> -->
						
											</td>
										
										</tr>
										
										<!-- <tr>
											<td>
												<label style="width:151px; color:#666666">Juzgado Origen</label><br><br>
												<input type="text" name="jo" id="jo" class="required" readonly="true"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Juzgado Destino</label><br><br>
												<input type="text" name="jd" id="jd" class="required" readonly="true"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan="2">
												<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
												<input type="text" name="claseproceso" id="claseproceso" class="required" readonly="true"/>
											</td>
											
										</tr> -->
										
									</table>
									
								</td>
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechal" id="fechal" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							
							
							<!-- <tr>
								<td colspan="2"> 
								
									<table border="0">
									
										<tr>
											<td>
												<label style="width:151px; color:#666666">Observacion</label><br><br>
												<textarea name="observacion" id="observacion" cols="110" rows="5" maxlength = "100000" class="required"></textarea>
											</td>
											
										</tr>
										
									</table>
									
								</td>
							</tr> -->
							
							
							<tr>
	
								<td colspan="2">
									<a id="btpartes" href="javascript:void(0);"><img src="views/images/dinero.jpg" width="45" height="45" title="ADICIONAR TITULO EN CUSTODIA"/>ADICIONAR TITULO EN CUSTODIA</a>
									<!-- ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA -->
									<input type="hidden" name="datospartes" id="datospartes"/>
								</td>
								
							</tr>
							
							
							<tr id="filapartes">
							
								<td colspan="2">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes">
		  	
										<tr>
											<td colspan="4">
												<!-- <a id="new" href="javascript:void(0);"><img src="views/images/new2.jpg" width="30" height="30" title="Adiconar Parte"/></a> -->
												
												<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar Parte" onClick="Adicionar_Parte(1)"><img src="views/images/new2.jpg" width="30" height="30"/></button>
											
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Numero Titulo:</label>
											</td>
											<td>
												<input type="text" name="numerotitulo"  id="numerotitulo" value="41803000" readonly="true"/>
												<input type="text" name="numerotitulo2" id="numerotitulo2" maxlength="7" minlength="7" onKeyPress="return Solo_Numeros(event)"  onKeyUp="Consultar_Numero_Titulo(this.value)"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Valor:</label>
											</td>
											<td>
												<!-- <input type="text" name="valortitulo" id="valortitulo" onKeyPress="return Solo_Numeros(event)"/> -->
												<input type="text" name="valortitulo" id="valortitulo"/>
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Adjudicatario:</label>
											</td>
											<td colspan="3">
												<input type="text" name="adju" id="adju"/>
											</td>
											
										</tr>
										
		
									</table>
								
								</td>
								
							</tr>
							
							<tr id="filapartes2">
							
								<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont"> 
													<table id="t" border="1"> 
														<tr>
															
															<td>
																<strong>Numero Titulo</strong>
															</td>
															<td>
																<strong>Valor</strong>
															</td>
															<td>
																<strong>Adjudicatario</strong>
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
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" class="btn_validar" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
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
	
	<br>
	
	<?php 

	//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
	//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
	echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


