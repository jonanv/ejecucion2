<?php

//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS

//TITULO FORMULARIO
$titulo     = "LIQUIDAR COSTAS";
$subtitulo  = "LIQUIDAR COSTAS";


//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new liquidaciones2Model();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $modelo->get_fecha_actual_amd();

$horaactual = $modelo->get_hora_actual_24horas_segundos();

$nombrelista  = 'item';
$campoordenar = 'nomarticulo';
$datositem    = $modelo->get_lista($nombrelista, $campoordenar);


$nombrelista  = 'juzgado_destino';
$campoordenar = 'nombre';
$datosjuzgado = $modelo->get_lista($nombrelista, $campoordenar);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
	<title><?php echo $titulo ?></title>

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
	<script src="views/js/ajax/ajax_liquidaciones2.js" type="text/javascript" charset="utf-8"></script>

	<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
	<link href="views/css/main.css" rel="stylesheet" type="text/css">

	<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
	<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">


	<!-- -------------------------------------------------------------------- -->


	<!-- PARA EL DESPLIEGUE DE MENUS -->
	<script type="text/javascript">
		function mainmenu() {

			$(" #menusec ul ").css({
				display: "none"
			});
			$(" #menusec li").hover(function() {
				$(this).find('ul:first:hidden').css({
					visibility: "visible",
					display: "none"
				}).slideDown(400);
			}, function() {
				$(this).find('ul:first').slideUp(400);
			});
		}

		$(document).ready(function() {
			mainmenu();
		});
	</script>


	<script type="text/javascript">
		$(document).ready(function() {


			//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPA�OL--------------------------------------------------------------------
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '< Ant',
				nextText: 'Sig >',
				currentText: 'Hoy',
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
				dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi�', 'Juv', 'Vie', 'S�b'],
				dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S�'],
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
			//$("#fechaiarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
			//$("#fechafarchivo").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});

			$("#fecha_liqui").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});




		});
	</script>


</head>

<body>

	<?php
	//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
	require 'header.php';
	//menus, con imagen del modulo
	//require 'secc_arancel.php';
	require 'secc_liquidaciones2.php';

	?>

	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id="block"></div>
	<div id="popupbox"></div>

	<table border="0" cellspacing="0" cellpadding="0" align="center">

		<tr>
			<td></td>
		</tr>

		<tr>
			<td>

				<!-- <div id="contenido"> -->

				<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">


					<input name="datospartes" id="datospartes" type="hidden" readonly="true" />

					<center>
						<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
					</center>

					<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">


						<tr>

							<td colspan="4">

								<a class="generar_liquidacion" href="javascript:void(0);" title="Adicionar Item"><img src="views/images/generarliqui2.png" width="75" height="75" title="GENERAR LIQUIDACION" /></a>

								<a class="editar_liquidacion" href="javascript:void(0);" title="Adicionar Item"><img src="views/images/historial2.png" width="75" height="75" title="EDITAR LIQUIDACION" /></a>

							</td>

						</tr>

						<tr>


							<td>
								<label style="width:151px; color:#666666">Fecha:</label><br>
								<input type="text" name="fecha_liqui" id="fecha_liqui" class="required" readonly="true" value="<?php echo $fechaactual; ?>">
							</td>

							<td>
								<label style="width:151px; color:#666666">Hora:</label><br>
								<input type="text" name="hora_liqui" id="hora_liqui" class="required" readonly="true" value="<?php echo $horaactual; ?>" />
							</td>

							<td>
								<label style="width:151px; color:#666666">Radicado:</label><br>
								<input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="170014003" />
							</td>


							<td>

								<table border="5" align="center" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes_proceso">


									<tr>

										<td>
											<center><label style="width:151px; color:#666666">DATOS PROCESO</label></center>

										</td>


									</tr>
									<tr>

										<td>
											<label style="width:151px; color:#666666">ID PROCESO:</label><br>
											<input type="text" name="id_liqui" id="id_liqui" class="required" readonly="true" />
										</td>


									</tr>

									<tr>


										<td>
											<label style="width:151px; color:#666666">PROCESO:</label><br>
											<input type="text" name="proceso_liqui" class="required" id="proceso_liqui" readonly="true" />
										</td>

									</tr>

									<tr>

										<td>
											<label style="width:151px; color:#666666">DEMANDANTE:</label><br>
											<input type="text" name="ddte_liqui" id="ddte_liqui" class="required" readonly="true" />
										</td>


									</tr>

									<tr>

										<td>
											<label style="width:151px; color:#666666">DEMANDADO:</label><br>
											<input type="text" name="ddo_liqui" id="ddo_liqui" class="required" readonly="true" />
										</td>

									</tr>

								</table>

							</td>

						</tr>


						<tr>


							<td>

								<label style="width:151px; color:#666666">Item:</label>
								<select name="item_liqui" id="item_liqui">


									<option value="" selected="selected">Seleccionar Item</option>

									<?php
									while ($row = $datositem->fetch()) {

										echo "<option value=\"" . $row['referencia'] . "\">" . $row['nomarticulo'] . "</option>";
									}
									?>
								</select>

								<!-- <a class="adicionar_carpeta" href="javascript:void(0);" title="Adicionar Item"><img src="views/images/procesos.png" width="25" height="35" title="Adicionar Item"/></a> -->
							</td>

							<td>

								<a class="adicionar_item" href="javascript:void(0);" title="Adicionar Item"><img src="views/images/procesos.png" width="25" height="35" title="Adicionar Item" /></a>
							</td>

							<td>
								<label style="width:151px; color:#666666">Valor:</label><br>
								<input type="text" name="valor_liqui" id="valor_liqui" class="required number" onKeyPress="return Solo_Numeros_y_Punto(event)" style="text-align:right" />
							</td>


							<td>

								<button type="button" name="boton_adicionar" id="boton_adicionar" style="float:right" title="Adicionar" onClick="Adicionar_Parte(1)"><img src="views/images/adi.jpg" width="30" height="30" />ADICIONAR</button>

							</td>

						</tr>



						<!-- TABLA ITEM -->

						<tr>

							<td colspan="4">

								<table align="left">

									<tr>
										<td>
											<div id="cont">
												<table id="t" border="1">

													<tr>


														<td>
															<strong>ID ITEM</strong>
														</td>
														<td>
															<strong>ITEM</strong>
														</td>
														<td>
															VALOR
														</td>

													</tr>


												</table>
											</div>
										</td>

									</tr>




								</table>

							</td>

						</tr>


						<!-- TABLA TOTAL -->

						<tr>

							<td>

								<table align="left">

									<tr>
										<td>

											<table id="total_item" border="1">

												<tr>


													<td>

													</td>

													<td>
														<label style="width:151px; font-size:16px; color:#FF0000">TOTAL:</label><br>
													</td>
													<td>
														<input type="text" name="total_liqui" id="total_liqui" readonly="true" style="width:151px; font-size:16px; color:#FF0000; text-align:right" />
													</td>


												</tr>


											</table>

										</td>





									</tr>




								</table>

							</td>




							<td colspan="3">

								<table align="right">

									<tr>
										<td>

											<table border="1" align="right">

												<tr>


													<td colspan="4">

														<label style="width:151px; color:#666666">Juzgado Ejecucion Civil Municipal:</label><br>
														<select name="juzgado_liqui" id="juzgado_liqui" class="required">


															<option value="" selected="selected">Seleccionar Juzgado</option>

															<?php
															while ($row = $datosjuzgado->fetch()) {

																if ($row[id] == 1 || $row[id] == 2) {
																	echo "<option value=\"" . $row[id] . "\">" . $row[nombre] . "</option>";
																}
															}
															?>
														</select>


													</td>


												</tr>

												<tr>
													<td colspan="4">

														<input type="checkbox" id="checknuevo" name="checknuevo">
														<label style="width:151px; color:#666666">Nuevo</label>

													</td>


												</tr>

												<tr>
													<td colspan="4">

														<input type="checkbox" id="checklc" name="checklc">
														<label style="width:151px; color:#666666">Liquidacion Credito</label>

													</td>


												</tr>

												<tr>


													<td colspan="4">
														<label style="width:151px; color:#666666">Observacion:</label><br>
														<textarea name="observacionsr" id="observacionsr" cols="45" rows="5"></textarea>
													</td>

												</tr>


											</table>

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
									<input type="submit" name="Submit" class="btn_validar" value="Registrar" id="btn_input" />
									<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar" />
								</center>
							</td>

						</tr>

						<!-- ----------------------------------------------------------------------------------------------- -->


					</table>

				</form>

				<!-- </div> -->

			</td>
		</tr>

	</table>

	<br>


	<?php require 'alertas.php'; ?>
</body>

</html>