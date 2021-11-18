<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "REGISTRAR TITULOS DE OTROS JUZGADOS";
	$subtitulo  = "REGISTRAR TITULOS DE OTROS JUZGADOS";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	

	//OBTENEMOS DATOS DEL PROCESO
	/*$idradicado = trim($_GET['idradicado']);
	
	$datosproceso   = $modelo->get_datos_proceso($idradicado);
	$fdatos         = $datosproceso->fetch();
	$idpro	        = $fdatos[idproceso];
	$radi	        = $fdatos[radicado];
	$cde	        = $fdatos[cedula_demandante];
	$nde	        = $fdatos[demandante];
	$cdo	        = $fdatos[cedula_demandado];
	$ndo	        = $fdatos[demandado];
	$idjo	        = $fdatos[idjuzgadoorigen];
	$njo	        = $fdatos[nombrejuzgadoorigen];*/
	
	

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

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_sieprootrosjuzgados.js" type="text/javascript" charset="utf-8"></script>

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
	$("#fechap").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
});

</script>	


<style type="text/css">

	.mensage_otros{
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
						
						<input name="datos_encabezado" id="datos_encabezado" type="hidden" readonly="true"/>
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<!-- MENSAJES -->
						<div class="mensage_otros"></div>  
									
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							<!-- <tr>
								<td colspan="2">
									
									<div class="mensage_otros"></div>  
								</td>
																
							</tr> -->
				
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="170014003"/>
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
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Ordenado con Oficio Numero:</label>
								</td>
								<td>
									<input type="text" name="oficiox" id="oficiox" class="required"/>
								</td>
								
							</tr>
							
							
							<tr>
								
								<td>
									<label style="width:151px; color:#666666">Archivo:</label>
								</td>
																	
								<td>
										
									<?php 
										$msg_memo = "<br>"."(OPCIONAL) EL NOMBRE DEL ARCHIVO DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO PDF"."<br>"."MANEJAR NOMBRES CORTOS Y REFERENTE A LO QUE SE DESEA CARGAR"."<br>"."NO ARCHIVOS MULTIMEDIA"."<br>"."<br>";
										echo $msg_memo;
									?>
											
									<!-- SE SELECCIONA UN SOLO ARCHIVO -->
									<input type="file" name="archivomemoB" id="archivomemoB"  size="19" placeholder="Ingrese pdf"/>
									
									<input name="sin_archivo" id="sin_archivo" type="hidden" readonly="true"/>
													
									
								</td>
							
							
							</tr> 
							
							
							
							<tr>
	
								<td colspan="2">
									<a id="btpartes" href="javascript:void(0);"><img src="views/images/dinero2.png" width="45" height="45" title="ADICIONAR TITULO"/>ADICIONAR TITULO</a>
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
												
												<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar" onClick="Adicionar_Parte(1)"><img src="views/images/new2.jpg" width="30" height="30"/></button>
											
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Numero Orden:</label>
											</td>
											<td>
												<input type="text" name="numerotitulo"  id="numerotitulo"/>
			
											</td>
											
											<td>
												<label style="width:151px; color:#666666">Cantidad:</label>
											</td>
											<td>
												
												<input type="text" name="numerotitulo2" id="numerotitulo2" onKeyPress="return Solo_Numeros(event)" />
											</td>
											
										</tr>
										
										<tr>
											
											<td>
												<label style="width:151px; color:#666666">Valor:</label>
											</td>
											<td colspan="3">
												<!-- <input type="text" name="valortitulo" id="valortitulo" onKeyPress="return Solo_Numeros(event)"/> -->
												<input type="text" name="valortitulo" id="valortitulo"/>
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Beneficiario:</label>
											</td>
											<td>
												<input type="text" name="adju" id="adju"/>
											</td>
											
											<td>
												<label style="width:151px; color:#666666">Fecha Pago:</label>
											</td>
											<td>
												<input type="text" name="fechap" id="fechap" readonly="true">
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
																<strong>Numero Orden</strong>
															</td>
															<td>
																<strong>Valor</strong>
															</td>
															<td>
																<strong>Beneficiario</strong>
															</td>
															<td>
																<strong>Fecha Pago</strong>
															</td>
															<td>
																<strong>Cantidad</strong>
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
	/*echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';*/
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


