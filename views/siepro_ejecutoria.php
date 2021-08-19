<?php

//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS

//TITULO FORMULARIO
$titulo      = "Ejecutoria";
$subtitulo   = "datos Proceso";
$subtitulo_2 = "Observaciones";
$subtitulo_3 = "Radicados";

$parteradi   = "170014003";


//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new archivoModel();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $modelo->get_fecha_actual_amd();

//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
$nombrelista  = 'siepro_pa_observaciones';
$campoordenar = 'id';
$formaordenar = '';
$datosobser   = $modelo->get_lista($nombrelista, $campoordenar, $formaordenar);



$nombrelista  = 'pa_usuario';
$campoordenar = 'empleado';
$filtro       = "WHERE nombre_usuario NOT LIKE '%D%'";
$formaordenar = '';
$datosuser    = $modelo->get_lista_filtro($nombrelista, $campoordenar, $filtro, $formaordenar);


$nombrelista  = 'accion_expediente';
$campoordenar = 'acc_descripcion';
$formaordenar = '';
$datosactu    = $modelo->get_lista($nombrelista, $campoordenar, $formaordenar);


$opcion = trim($_GET['dato_0']);


if ($opcion == 1) {


	$idbloque = trim($_GET['datox1']);

	$regdatos = $modelo->get_incorporar_memorial();

	//print_r($regdatos);

}



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

	<!-- -------------------------------------------------------------------- -->

	<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
	<script src="views/js/ajax/ajax_sieproejecutoria.js" type="text/javascript" charset="utf-8"></script>

	<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
	<link href="views/css/main.css" rel="stylesheet" type="text/css">

	<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
	<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css" />
	<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css" />

	<!-- PARA LAS FECHAS -->
	<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css" />

	<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
	<script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
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


			//PARA LAS FECHAS
			//$("#fechae").datepicker({ changeFirstDay: false	});

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

			$("#fechaaudi").datepicker({
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

				<!-- <div id="contenido"> -->

				<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">

					<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; 
																											?>"> -->
					<!-- <input name="idincorpora" id="idincorpora" type="hidden" readonly="true"/> -->

					<div id="titulo_frm">
						<center><?php echo strtoupper($titulo); ?></center>
					</div>

					<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">


						<tr>
							<td>
								<label style="width:151px; color:#666666">Radicado:</label>
							</td>
							<td>
								<!-- <input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="<?php //echo trim($_GET['dato_1']); 
																																					?>"/> -->

								<input type="text" name="radicado" id="radicado" class="required number" value="<?php echo trim($parteradi); ?>" />
							</td>

							<td>
								<a id="consultarincorporar" href="javascript:void(0);">
									<img src="views/images/lupa.png" width="35" height="35" title="CONSULTAR" />
									CONSULTAR
								</a>
							</td>


						</tr>




						<tr>
							<td colspan="3">

								<table border="0" align="center" width="800">

									<div id="titulo_frm">
										<center><?php echo strtoupper($subtitulo); ?></center>
									</div>

									<tr>
										<td>
											<label style="width:151px; color:#666666">Id</label><br><br>
											<input type="text" name="idr" id="idr" class="required" readonly="true" value="<?php echo trim($_GET['dato_4']); ?>" />
										</td>
										<td colspan="3">
											<label style="width:151px; color:#666666">Radicado</label><br><br>
											<input type="text" name="radicado2" id="radicado2" class="required number" value="<?php echo trim($_GET['dato_1']); ?>" />
										</td>

									</tr>
									<tr>
										<td>
											<label style="width:151px; color:#666666">Cedula Demandante</label><br><br>
											<input type="text" name="cedula_demandante" id="cedula_demandante" class="required" readonly="true" value="<?php echo trim($_GET['dato_5']); ?>" />
										</td>
										<td>
											<label style="width:151px; color:#666666">Demandante</label><br><br>
											<input type="text" name="demandante" id="demandante" class="required" readonly="true" value="<?php echo trim($_GET['dato_6']); ?>" />
										</td>

										<td>
											<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
											<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true" value="<?php echo trim($_GET['dato_7']); ?>" />
										</td>
										<td>
											<label style="width:151px; color:#666666">Demandado</label><br><br>
											<input type="text" name="demandado" id="demandado" class="required" readonly="true" value="<?php echo trim($_GET['dato_8']); ?>" />
										</td>

									</tr>

									<tr>
										<td>
											<label style="width:151px; color:#666666">Juzgado Origen</label><br><br>
											<input type="text" name="jo" id="jo" class="required" readonly="true" value="<?php echo trim($_GET['dato_10']); ?>" />
										</td>
										<td>
											<label style="width:151px; color:#666666">Juzgado Destino</label><br><br>
											<input type="text" name="jd" id="jd" readonly="true" value="<?php echo trim($_GET['dato_11']); ?>" />
											<!-- <input type="text" name="jd" id="jd" readonly="true"/> -->
										</td>

										<td>
											<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
											<input type="text" name="claseproceso" id="claseproceso" class="required" readonly="true" value="<?php echo trim($_GET['dato_9']); ?>" />
										</td>

										<td>
											<label style="width:151px; color:#FF0000; font-size:14px">Posicion</label><br><br>
											<input type="text" name="posi" id="posi" readonly="true" value="<?php echo trim($_GET['dato_9']); ?>" />
										</td>

									</tr>

									<!-- <tr>
										
											<td colspan="4">
												<label style="width:151px; color:#FF0000; font-size:16px">Observacion</label><br><br>
												<input type="text" name="obserie" id="obserie" class="required" value="<?php //echo trim($_GET['dato_9']); 
																														?>"/>
											</td>
										
										</tr> -->



									<tr>
										<td>
											<label style="width:151px; color:#FF0000; font-size:16px">Observacion</label><br><br>
										</td>
										<td colspan="3">
											<select name="obserie" id="obserie" class="required">
												<option value="" selected="selected">Seleccionar Observacion</option>
												<?php
													while ($row = $datosactu->fetch()) {
														echo "<option value=\"" . $row['id'] . "\">" . $row['acc_descripcion'] . "</option>";
													}
												?>
											</select>
										</td>
									</tr>

									<tr>

										<td colspan="4">

											<label style="width:180px; height:23px; font-size:14px; color:#666666">Observacion Adicional:</label><br>
											<textarea name="obsadicional" id="obsadicional" cols="34" rows="5" maxlength="500000"></textarea>

										</td>

									</tr>






									<tr id="filaaudi">

										<td>
											<label style="width:180px; height:23px; border-color:#000000; font-size:14px; color:#666666">Fecha Audiencia:</label><br>
											<input type="text" name="fechaaudi" id="fechaaudi" readonly="true">
										</td>

										<td>

											<label style="width:180px; height:23px; font-size:14px; color:#666666">Hora Audiencia:</label><br>
											<input type="time" id="horaaudi" name="horaaudi" />

										</td>

										<td>

											<label style="width:180px; height:23px; font-size:14px; color:#666666">Observacion Audiencia:</label><br>
											<textarea name="obsaudi" id="obsaudi" cols="34" rows="5" maxlength="100000"></textarea>

										</td>

									</tr>


									<!-- <tr>

										<td colspan="4">
											<center><label style="width:151px; color:#FF0000; font-size:14px">PARA TRAMITE INTERNO</label><br><br></center>

										</td>
									</tr>
									<tr>
										<td colspan="4">


											<label style="width:151px; color:#FF0000; font-size:12px">Actuacion Interna</label><br><br>
											<select name="actuacion" id="actuacion">

												<option value="" selected="selected">Seleccionar Actuacion</option>
												<?php
													while ($row = $datosactu->fetch()) {

														echo "<option value=\"" . $row[id] . "\">" . $row[acc_descripcion] . "</option>";
													}
												?>
											</select>
										</td>

									</tr> -->

									<tr>
										<!-- ES LA FECHA DE ESTADO DE LA �LTIMA ACTUACI�N SECRETARIA
											SE UTILIZA EL FORMATO Y-n-j EN VEZ DE Y-m-d YA QUE AL REALIZAR LA OPERACION
											DE CALCULAR LA FECHA FINAL SEGUN LOS DIAS LA FECHA INICIAL DEBE ESTAR DE LA SIGUIENTE 
											MANERA 2014-11-5 (Y-n-j) Y NO DE ESTA 2014-11-05 (Y-m-d) YA QUE EL CERO DEL DIA
											OCASINA UNA INCOSISTENCIA-->
										<?php $dateTime = date_create($fechaactual); ?>
										<td>
											<label style="width:151px; color:#666666">Fecha Inicial</label><br><br>
											<input type="text" name="fecha_actusti" id="fecha_actusti" readonly="readonly" value="<?php echo date_format($dateTime, 'Y-n-j'); ?>" />
										</td>


										<td>
											<label style="width:151px; color:#666666">Dias</label><br><br>
											<input type="text" name="diasti" id="diasti" onkeyup="DiasHabiles()" />
										</td>

										<td>
											<label style="width:151px; color:#666666">Fecha Final</label><br><br>
											<input type="text" name="fecha_actusfti" id="fecha_actusfti" size="34" readonly="readonly" value="<?php echo $fechafinal; ?>" />
										</td>

										<td>

											<label style="width:151px; color:#666666">Asignado A</label><br><br>
											<select name="asignadoa" id="asignadoa">

												<option value="" selected="selected">Seleccionar Asignado A</option>

												<?php
												while ($row = $datosuser->fetch()) {

													echo "<option value=\"" . $row['id'] . "\">" . $row['empleado'] . "</option>";
												}
												?>
											</select>
										</td>

									</tr>





								</table>

							</td>
						</tr>

						<tr>

							<td colspan="3">

								<div id="titulo_frm">
									<center><?php echo strtoupper($subtitulo_2); ?></center>
								</div>

								<center>
									<table>

										<tr>
											<td>
												<div>
													<table id="t2" border="1">
														<thead>
															<tr>
																<th>Fecha</th>
																<th>Observacion</th>
																<th>Usuario</th>
																<th>-</th>
															</tr>
														</thead>
														<tbody id="cont2"></tbody>
													</table>
												</div>
											</td>

										</tr>


									</table>
								</center>

							</td>

						</tr>

						<tr>

							<!-- <td>
									<label style="width:151px; color:#FF0000; font-size:16px">Observacion:</label>
								</td> -->
							<td colspan="3">

								<!-- <input type="text" name="obserie2"  id="obserie2"/> -->

								<!-- ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA -->
								<input type="hidden" name="datospartes" id="datospartes" />

							</td>


						</tr>


						<tr>

							<td colspan="11">

								<div id="titulo_frm">
									<center><?php echo strtoupper($subtitulo_3); ?></center>
								</div>

								<center>
									<table>

										<tr>
											<td>
												<div id="cont">
													<table id="t" border="1">
														<tr>

															<td>
																<strong>Id Radicado</strong>
															</td>

															<td>
																<strong>Radicado</strong>
															</td>

															<td>
																<strong>Observacion</strong>
															</td>

															<td>
																<strong>Actuacion Interna</strong>
															</td>

															<td>
																<strong>Fecha Inicial</strong>
															</td>

															<td>
																<strong>Dias</strong>
															</td>

															<td>
																<strong>Fecha Final</strong>
															</td>

															<td>
																<strong>Asignado A</strong>
															</td>

															<td>
																<strong>Fecha Audencia</strong>
															</td>

															<td>
																<strong>Hora Audencia</strong>
															</td>

															<td>
																<strong>Obs Audencia</strong>
															</td>

															<td>
																<strong>A despacho</strong>
															</td>

														</tr>
													</table>
												</div>
											</td>

										</tr>


									</table>
								</center>

							</td>

						</tr>

						<tr>
							<td>
								<div id="ok"></div>
							</td>
						</tr>



						<!-- -----------------------------BOTONES--------------------------------------------------------- -->
						<tr>

							<td colspan="3">
								<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
								<center>
									<input type="submit" name="Submit" class="btn_validar" value="<?php if (empty($vbton)) {
																										echo "Registrar";
																									} else {
																										echo "Actualizar";
																									} ?>" id="btn_input" />
									<!-- <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/> -->
									<input type="button" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar" />
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



	<?php require 'alertas.php'; ?>
</body>

</html>