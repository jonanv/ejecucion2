<?php

//TITULO FORMULARIO
$titulo     = "Listar de Procesos con Vencimiento de Terminos";
$titulo2    = "Para Liquidar";

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new archivoModel();


//-------IDENTIFICAR JUEZ Y SERVIDOR JUDICIAL JUZGADO------------------

$Jid_juzgado     = $_SESSION['id_juzgado'];
$Jtipousuario    = $_SESSION['tipousuario'];
$alerta_despacho = 0;

//echo $Jid_juzgado."<br>".$Jtipousuario."<br>".$Jid_juzgado_3."<br>".$Jid_juzgado_4."<br>".$Jid_juzgado_5;

if ($Jtipousuario == 'JUEZ' || $Jtipousuario == 'SERVIDORJUDICIALJUZGADO') {

	$alerta_despacho = 1;

	$Jid_juzgado_1  = $modelo->get_despacho($Jid_juzgado);
	$Jid_juzgado_2  = $Jid_juzgado_1->fetch();
	$Jid_juzgado_3	= trim($Jid_juzgado_2[nombre]);
	$Jid_juzgado_4	= trim($Jid_juzgado_2[numero_juzgado]);
	$Jid_juzgado_5	= trim($Jid_juzgado_2[idjxxi]);
	$Jid_juzgado_6	= trim($Jid_juzgado_2[dias]);

	//echo $Jid_juzgado."<br>".$Jtipousuario."<br>".$Jid_juzgado_3."<br>".$Jid_juzgado_4."<br>".$Jid_juzgado_5;
	//echo $Jid_juzgado_6;
}

//-------FIN IDENTIFICAR JUEZ Y SERVIDOR JUDICIAL JUZGADO---------------

//OBTENEMOS LA FECHA ACTUAL
$fecha_terminos = $modelo->get_fecha_actual_amd();

//$fecha_terminos = "2016-01-25";

$campos               = 'usuario';
$nombrelista          = 'pa_usuario_acciones';


//------------------PARA ALERTA REPARTO MASIVO--------------------------------

$idaccion	    = '14';
$campoordenar   = 'id';
$datosusuarioAR = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosAR1    = $datosusuarioAR->fetch();
$usuariosaAR2	= explode("////", $usuariosAR1[usuario]);

if (in_array($_SESSION['idUsuario'], $usuariosaAR2, true)) {

	$opcion_reparto = trim($_GET['dato_0']);

	if ($opcion_reparto == 1) {

		$firm = trim($_GET['firm']);
		$ffrm = trim($_GET['ffrm']);
	} else {

		$firm = $fecha_terminos;
		$ffrm = $fecha_terminos;
	}

	$datos_reparto   = $modelo->get_reparto_masivo($firm, $ffrm);

	$datos_reparto_2 = $modelo->get_reparto_masivo($firm, $ffrm);
	$freparto        = $datos_reparto_2->fetch();

	$datos_reparto_3   = $modelo->get_cantidad_reparto_masivo($firm, $ffrm);
	$registros_reparto = $datos_reparto_3->fetch();
	$registros_masivos = $registros_reparto[registros_masivos];

	//LISTA DE JUSTICIA XXI JUZGADOS
	$datosdelit_2  = $modelo->getListarDespachosJusticiaXXI();
	$datosdelit_2B = explode("******", $datosdelit_2);
	$long_1        = count($datosdelit_2B) - 1;


	//$juzgado_reparto = $modelo->listarJuzgadosDestino();

}

//-------------------------------------------------------------------------------


//PARA ALERTA AUDIENCIAS

$idaccion	      = '24';
$campoordenar     = 'id';
$datosusuarioAUDI = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosAUDI1    = $datosusuarioAUDI->fetch();
$usuariosaAUDI2	  = explode("////", $usuariosAUDI1[usuario]);



if (in_array($_SESSION['idUsuario'], $usuariosaAUDI2, true)) {

	$faudi = 0;

	$datosaudi = $modelo->get_audiencias();
	//$faudi     = $datosaudi->fetch();

	while ($filaudi = $datosaudi->fetch()) {

		$dias = $modelo->Dias_Respuesta($fecha_terminos, $filaudi[fechaaudi]);

		//SE PONE 2 YA QUE EL SISTEMA CUENTA LA FECHA ACTUAL Y LA FECHA DE LA AUDIENCIA
		//ES DECIR QUE SI $dias == 2, ES POR QUE QUEDA UN DIA, ANTES DE LA AUDIENCIA
		//EJ:  2019-02-14 (FECHA ACTUAL) / 2019-02-15 (FECHA AUDIENCIA)
		//CUENTA EL 14 Y EL 15, '-' ESTO INDICA QUE YA SE ESTA EN LA FECHA ACTUAL DE LA AUDIENCIA
		if ($dias == 2 || $dias == '-') {

			$faudi = $faudi + 1;
			break;
		}
	}
}
//echo $faudi;

//PARA ALERTA VENCE TERMINOS

$idaccion	    = '15';
$campoordenar   = 'id';
$datosusuarioVT = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosVT1    = $datosusuarioVT->fetch();
$usuariosaVT2	= explode("////", $usuariosVT1[usuario]);

if (in_array($_SESSION['idUsuario'], $usuariosaVT2, true)) {

	$datosproceso   = $modelo->get_vence_terminos($fecha_terminos);

	$datosproceso_2 = $modelo->get_vence_terminos($fecha_terminos);
	$fdatos         = $datosproceso_2->fetch();
}


//PARA ALERTA EN FIRME PASA A CONTADOR PARA LIQUIDAR

$idaccion	    = '16';
$campoordenar   = 'id';
$datosusuarioL = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosL1    = $datosusuarioL->fetch();
$usuariosaL2	= explode("////", $usuariosL1[usuario]);

if (in_array($_SESSION['idUsuario'], $usuariosaL2, true)) {

	$datosLIQUI   = $modelo->get_en_firme_liquidacion($fecha_terminos);

	$datosLIQUI_2 = $modelo->get_en_firme_liquidacion($fecha_terminos);
	$ldatos       = $datosLIQUI_2->fetch();
}

//echo count($fdatos);


/*$fdatos         = $datosproceso->fetch();
	$idpro	        = $fdatos[idproceso];
	$radi	        = $fdatos[radicado];
	$cde	        = $fdatos[cedula_demandante];
	$nde	        = $fdatos[demandante];
	$cdo	        = $fdatos[cedula_demandado];
	$ndo	        = $fdatos[demandado];
	$idjo	        = $fdatos[idjuzgadoorigen];
	$njo	        = $fdatos[nombrejuzgadoorigen];*/

//**************************************************************************************************************************
//EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
//SEGUN EN EL FORMULARIO QUE ME ENCUENTRE

//$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
//$nombrelista                    --> tabla que contiene los registros de las acciones
//$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
//$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
//$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45 
//$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con 
//	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
//                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
//**************************************************************************************************************************

//$campos               = 'usuario';
//$nombrelista          = 'pa_usuario_acciones';
$idaccion			  = '6';
$campoordenar         = 'id';
$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuarios             = $datosusuarioacciones->fetch();
$usuariosa			  = explode("////", $usuarios[usuario]);


$hayconexion = $modelo->get_conexion_JUSTICIAXXI();


//ID USUARIOS PERTENECIENTES AL JUZGADO J1, J2 ESTO CON EL OBJETO QUE UN USUARIO DE UN JUZGADO NO VEA LA INFORMACION DEL OTRO
$idaccion			  = '9';
$campoordenar         = 'id';
$datosusuario_juzgado_x = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuarios_juzgado_x     = $datosusuario_juzgado_x->fetch();
$usuariosa_juzgado_x	= explode("////", $usuarios_juzgado_x[usuario]);

$usuariosa_juzgado_1_x  = explode("****", $usuariosa_juzgado_x[0]);

$usuariosa_juzgado_2_x  = explode("****", $usuariosa_juzgado_x[1]);

//print_r($usuariosa_juzgado_1[0]);

$pertenece_juzgado_x = 0;

if (in_array($_SESSION['idUsuario'], $usuariosa_juzgado_1_x, true)) {

	$pertenece_juzgado_x = 1;
}

if (in_array($_SESSION['idUsuario'], $usuariosa_juzgado_2_x, true)) {

	$pertenece_juzgado_x = 2;
}


//******************Visualizar Remate Sin Aprobar PARA GENERAR LA ALERTA***************

$idaccion	    = '17';
$campoordenar   = 'id';
$datosusuarioVR = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosVR1    = $datosusuarioVR->fetch();
$usuariosaVR2	= explode("////", $usuariosVR1[usuario]);

if (in_array($_SESSION['idUsuario'], $usuariosaVR2, true)) {

	$datos_rema = $modelo->Visualizar_Remate_Sin_Aprobar();

	$fr = 0;
	while ($fila_rema = $datos_rema->fetch()) {

		$fr = $fr + 1;
	}

	$cantregisrema = $fr;

	//echo $cantregissoli;

}

//*****************************************************************************************


//******************Visualizar Activididad asignada al Usuario en sesion PARA GENERAR LA ALERTA***************
$datos_acti = $modelo->Visualizar_Actividad_Usuario();

$fac = 0;
while ($fila_acti = $datos_acti->fetch()) {

	$fac = $fac + 1;
}

$cantregisac = $fac;

//echo $cantregissoli;

//*****************************************************************************************


//ID USUARIOS QUE PUEDEN VER Y REGISTRAR  AUDIENCIAS, TANTO DEL J1 Y J2 DE EJECUCION, 
//Y PERSONAL OECM, DIRECTORA(8), SECRETARIO(19), ING SISTEMAS(38)
$idaccion	       = '26';
$campoordenar      = 'id';
$datosusuarioAUDIX = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosAUDI1X    = $datosusuarioAUDIX->fetch();
$usuariosaAUDI2X   = explode("////", $usuariosAUDI1X[usuario]);


//ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS

$bandera_entitulos = 0;

$idaccion	      = '28';
$campoordenar     = 'id';
$datosusuarioENTI = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosENTI     = $datosusuarioENTI->fetch();
$usuariosaENTI2	  = explode("////", $usuariosENTI[usuario]);

if (in_array($_SESSION['idUsuario'], $usuariosaENTI2, true)) {
	$bandera_entitulos = 1;
}

//******************ID USUARIOS QUE PUEDEN VISUALIZAR  REPORTE HOJA CONTROL DE ENTREGA DE TITULOS***************

$idaccion	      = '29';
$campoordenar     = 'id';
$datosusuarioHCET = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosHCET1    = $datosusuarioHCET->fetch();
$usuariosaHCET2	  = explode("////", $usuariosHCET1[usuario]);

$banderaHCET      = 0;

if (in_array($_SESSION['idUsuario'], $usuariosaHCET2, true)) {
	$banderaHCET = 1;
}

//******************FIN ID USUARIOS QUE PUEDEN VISUALIZAR REPORTE HOJA CONTROL DE ENTREGA DE TITULOS***************


//******************ID USUARIOS QUE PUEDEN VISUALIZAR  REPORTE EXCEL VARIAS SOLICITUDES***************

//LISTA pa_solicitud
$campo_a_mostrar  = 'nombre';
$campo_a_insertar = 'id';
$nombre_tabla     = 'pa_solicitud';
$campo_filtro     = 'visible';
$valor_filtro     = 1;
$campo_a_ordenar  = 'nombre';
$datos_SOLI       = $modelo->get_lista_con_filtro($campo_a_mostrar, $campo_a_insertar, $nombre_tabla, $campo_filtro, $valor_filtro, $campo_a_ordenar);


//LISTA juzgado_destino
$campo_a_mostrar  = 'nombre';
$campo_a_insertar = 'id';
$nombre_tabla     = 'juzgado_destino';
$campo_filtro     = 'id';
$valor_filtro     = "IN(1,2)";
$campo_a_ordenar  = 'nombre';
$datos_SOLI_JUZ   = $modelo->get_lista_con_filtro_IN($campo_a_mostrar, $campo_a_insertar, $nombre_tabla, $campo_filtro, $valor_filtro, $campo_a_ordenar);

//LISTA pa_usuario
$nombrelistapa   = 'pa_usuario';
$campoordenarpa  = 'empleado';
$filtropa        = "WHERE nombre_usuario NOT LIKE 'D%'";
$datos_SOLI_USER = $modelo->get_lista_filtro($nombrelistapa, $campoordenarpa, $filtropa, $formaordenar);


$idaccion	      = '30';
$campoordenar     = 'id';
$datosusuarioREVS = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$usuariosREVS1    = $datosusuarioREVS->fetch();
$usuariosaREVS2	  = explode("////", $usuariosREVS1[usuario]);

$banderaREVS      = 0;

if (in_array($_SESSION['idUsuario'], $usuariosaREVS2, true)) {

	$banderaREVS = 1;
}

//******************FIN ID USUARIOS QUE PUEDEN VISUALIZAR  REPORTE EXCEL VARIAS SOLICITUDES***************


//ID USUARIOS, PARA VISUALIZAR ALERTA DE TAREAS QUE AUN NO SE HAN CERRARDO, EN EL AREA DESPACHOS
$idaccion	    = '35';
$campoordenar   = 'id';
$dato_Acerrar_1 = $modelo->get_lista_usuario_acciones($campos, $nombrelista, $idaccion, $campoordenar);
$dato_Acerrar_2 = $dato_Acerrar_1->fetch();
$dato_Acerrar_3	= explode("////", $dato_Acerrar_2[usuario]);

if (in_array($_SESSION['idUsuario'], $dato_Acerrar_3, true)) {

	//DETERMINAR EL NUMERO DE TAREAS QUE ESTAN ABIERTAS
	/*$tiene_ta_1  = $modelo->get_tarea_abierta();
		$tiene_ta_2  = $tiene_ta_1->fetch();
		$tiene_ta_3  = trim($tiene_ta_2[idcantida]);*/
}

//SE CIERRA LA OPCION get_tarea_abierta(), YA QUE PRESENTA DEMORA AL INGRESO DEL FORMULARIO
//SE DEJA ELBOTON PARA GENERAR LAS TAREAS SIN CERRAR
$tiene_ta_3  = 0;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

	<title><?php echo titulo ?></title>

	<!-- <script src="views/js/jquery.js" type="text/javascript"></script> -->
	<!-- <script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
	<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script> -->
	<!-- <script src="views/js/jquery.validate.js" type="text/javascript"></script> -->

	<!-- <script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
	<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8"> -->

	<!-- <link href="views/css/main.css" rel="stylesheet" type="text/css"> -->


	<!-- PARA EFECTO EN LOS BOTONES ESTILO  bootstrap-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
	<link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
	<link rel="stylesheet" href="assets/css/style.css" />
	<!-- FIN PARA EFECTO EN LOS BOTONES ESTILO  bootstrap-->

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



	<script src="views/js/ajax/ajax_filtro_ubicacion.js" type="text/javascript" charset="utf-8"></script>

	<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
	<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css" />
	<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css" />


	<!-- DataTables example Child rows (show extra / detailed information) -->

	<link rel="stylesheet" type="text/css" href="views/viewstablas/jquery.dataTables.css" />
	<!-- <link rel="stylesheet" type="text/css" href="views/viewstablas/demo.css"/> -->

	<style type="text/css" class="init">
		td.details-control {
			background: url('views/viewstablas/details_open.png') no-repeat center center;
			cursor: pointer;
		}

		tr.shown td.details-control {
			background: url('views/viewstablas/details_close.png') no-repeat center center;
		}
	</style>

	<!-- FIN DataTables example Child rows (show extra / detailed information) -->





	<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
	<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">

	<!-- ALERTAS -->
	<script src="views/js/alertify.js" type="text/javascript" charset="utf-8"></script>
	<link href="views/css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
	<link href="views/css/alertify.core.css" rel="stylesheet" type="text/css">
	<link href="views/css/alertify.default.css" rel="stylesheet" type="text/css">


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

	<script type="text/javascript" language="javascript" class="init">
		$(document).ready(function() {
			$(".topMenuAction").click(function() {
				if ($("#openCloseIdentifier").is(":hidden")) {
					$("#sliderm").animate({
						marginTop: "-238px"
					}, 500);
					$("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
					$("#openCloseIdentifier").show();
				} else {
					$("#sliderm").animate({
						marginTop: "0px"
					}, 500);
					$("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
					$("#openCloseIdentifier").hide();
				}
			});

			$("#sliderop").easySlider({});
			$("#frm").validate();


			var validator = $("#frm").validate({
				meta: "validate"
			});

			$(".btn_limpiar").click(function() {
				validator.resetForm();
			});


			//PARA TABLA TERMINOS
			$("#fechater").datepicker({
				changeFirstDay: false
			});
			$('#filaterminos').hide();
			// <!--$('#filareparto').hide();-- >
			$('#filaliquidacion').hide();







			// <!-- DataTables example Child rows (show extra / detailed information) -->

			var datos = " ";

			var table = $('#frm_editar1').DataTable({
				'sPaginationType': 'full_numbers',



				"language": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ning�n dato disponible en esta tabla",
					"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix": "",
					"sSearch": "Buscar:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst": "Primero",
						"sLast": "�ltimo",
						"sNext": "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				}





			});



			var table_2 = $('#frm_editar2').DataTable({
				'sPaginationType': 'full_numbers',



				"language": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ning�n dato disponible en esta tabla",
					"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix": "",
					"sSearch": "Buscar:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst": "Primero",
						"sLast": "�ltimo",
						"sNext": "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				}


			});

			/* Formatting function for row details - modify as you need */
			function format(d) {

				//alert("DATOS 1: "+d);

				// `d` is the original data object for the row


				var datos = d.split("******");

				//alert(datos);

				var long = datos.length

				//alert("long: "+long);

				var x = 0;

				var table_detalle = "";

				table_detalle += '<table><tr>';

				table_detalle += '<td>Idobs</td>';
				table_detalle += '<td>Radicado</td>';
				table_detalle += '<td>Fecha</td>';
				table_detalle += '<td>Observacion</td>';
				table_detalle += '<td>Usuario</td>';

				table_detalle += '</tr>';



				while (x < long - 1) {

					datos_2 = datos[x].split("//////");

					table_detalle += '<tr>';

					table_detalle += '<td style="font-size:10px">' + datos_2[0] + '</td>';
					table_detalle += '<td style="font-size:10px">' + datos_2[1] + '</td>';
					table_detalle += '<td style="font-size:10px">' + datos_2[2] + '</td>';
					table_detalle += '<td style="width:254px; font-size:10px; color:#FF0000">' + datos_2[3] + '</td>';
					table_detalle += '<td style="font-size:10px">' + datos_2[4] + '</td>';

					table_detalle += '</tr>';

					x = x + 1;

				}

				table_detalle += '</table>';


				return table_detalle;


			}


			// Add event listener for opening and closing details
			$('#frm_editar1 tbody').on('click', 'td.details-control', function() {

				var dato_radicado = $(this).attr('data-radicado');
				//alert(dato_radicado);



				var tr = $(this).closest('tr');
				var row = table.row(tr);


				if (row.child.isShown()) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				} else {

					$.get("funciones/traer_datos_detalle_proceso.php?dato_radicado=" + dato_radicado, function(cadena) {


						datos = cadena;

						//alert("DATOS 1: "+datos)

						// Open this row
						//row.child( format(row.data()) ).show();
						row.child(format(datos)).show();
						tr.addClass('shown');

					});

				}


			});


			//CUANDO SE REALIZA ALGUN FILTRO DE BUSQUEDAD EN EL FORMULARIO
			// Add event listener for opening and closing details
			$('#frm_editar2 tbody').on('click', 'td.details-control', function() {

				var dato_radicado = $(this).attr('data-radicado');
				//alert(dato_radicado);



				var tr = $(this).closest('tr');
				var row = table_2.row(tr);


				if (row.child.isShown()) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				} else {

					$.get("funciones/traer_datos_detalle_proceso.php?dato_radicado=" + dato_radicado, function(cadena) {


						datos = cadena;

						//alert("DATOS 1: "+datos)

						// Open this row
						//row.child( format(row.data()) ).show();
						row.child(format(datos)).show();
						tr.addClass('shown');

					});

				}


			});




			//NUEVA OBSERVACION
			/*$('#nuevaOBS').click( function(){
												  
				
				//alert("NUEVA OBSERVACION");
				var radicado_obs    = $(this).attr('data-radicado_obs');
				
				location.href="index.php?controller=archivo&action=Adicionar_Observacion_2&radicado_obs="+radicado_obs;
					
				/*params={};
				params.radicado_obs = radicado_obs;
				
			
				//alert(params.eveasunto);
				//$('#popupbox').load('views/popupbox/adicionar_observacion.php',params,function(){
				$('#popupbox').load('views/popupbox/Data_table_2/examples/simple/adicionar_observacion_2.php',params,function(){
					//alert(2);
					$('#block').show();
					//alert(3);
					$('#popupbox').show();
					//alert(4);
				})*/


			//});		


			// <!-- FIN DataTables example Child rows (show extra / detailed information) -->




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
			$("#fechair").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechafr").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechaoi").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechaof").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechai").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechaf").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});


			$("#fechaiRM").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechafRM").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechati").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechatf").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechaiv").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fechafv").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});





			$("#fecha1hcet").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fecha2hcet").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});

			$("#fecha1soli").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});
			$("#fecha2soli").datepicker({
				changeFirstDay: false,
				dateFormat: 'yy-mm-dd'
			});



			$("#generar_excel_hcet").click(function() {


				if (

					$('#fecha1hcet').val().length == 0 &&
					$('#fecha2hcet').val().length == 0

				) {

					alert("Definir Fecha Inicial y Fecha Final");

					document.getElementById('fecha1hcet').style.borderColor = '#FF0000';
					document.getElementById('fecha2hcet').style.borderColor = '#FF0000';

				} else {

					opcion = 12000;

					//FECHAS REGISTRO
					var dato_1hcet = $('#fecha1hcet').val();
					var dato_2hcet = $('#fecha2hcet').val();


					//var idradi_reporte = $("#idhcet").val();
					//var radi_reporte   = $("#radihcet").val();

					location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion + "&dato_1hcet=" + dato_1hcet + "&dato_2hcet=" + dato_2hcet;

				}


			});

			$("#generar_excel_vsoli").click(function() {


				valor = document.getElementById('fecha1soli').value;
				valor2 = document.getElementById('fecha2soli').value;
				//valor3 = document.getElementById('listasr4').value;


				if (

					(valor == null || valor.length == 0 || /^\s+$/.test(valor)) ||
					(valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2)) //||
					//(valor == null || valor.length == 0 || /^\s+$/.test(valor))



				) {

					alert("Defina Fecha Inicial,Fecha Final");
					document.getElementById('fecha1soli').style.borderColor = '#FF0000';
					document.getElementById('fecha2soli').style.borderColor = '#FF0000';
					//document.getElementById('listasr4').style.borderColor = '#FF0000';
					return false;

				} else {


					//RECORRER LISTA MULTIPLE
					//Y CONCATENAR SUS VALORES ID
					var dato5_ra = "";
					var contid = 0;
					obj = document.getElementById('listasr4');
					for (i = 0; opt = obj.options[i]; i++) {

						if (opt.selected) {
							//dato5_ra = opt.value+" "+opt.text+"-"+dato5_ra;
							dato5_ra = opt.value + "," + dato5_ra;

							contid = contid + 1;
						}


					}

					//alert(contid);

					//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
					//Y EL REPORTE NO GENERE INFORMACION
					if (contid != 0) {
						//SE CONCATENA CON CODIGO SQL IN(1,2,3) Y QUITO LA ULTIMA COMA(,) DE LA CADENA CON SLICE
						var cadena2 = "IN (" + dato5_ra.slice(0, -1) + ")";
						//alert(cadena2);
					} else {
						var cadena2 = 1;
					}



					var mpincorporado;

					if ($("#ckets").is(':checked')) {
						//INCORPORADOS AL PROCESO; 
						mpincorporado = "IS NOT NULL";
					} else {
						//NO INCORPORADOS AL PROCESO;
						mpincorporado = "IS NULL";
					}




					opcion = 13000;

					//FECHAS REGISTRO
					var dato_1soli = $('#fecha1soli').val();
					var dato_2soli = $('#fecha2soli').val();


					var listasoli1 = $("#listasoli1").val(); //JUZGADO
					var listasoli2 = $("#listasoli2").val(); //USUARIO


					location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion + "&dato_1soli=" + dato_1soli + "&dato_2soli=" + dato_2soli + "&idssoli=" + cadena2 + "&mpincorporado=" + mpincorporado + "&listasoli1=" + listasoli1 + "&listasoli2=" + listasoli2;


				}



			});



			$("#generar_excel_LIQUI").click(function() {


				valor = document.getElementById('fecha1soli').value;
				valor2 = document.getElementById('fecha2soli').value;
				//valor3 = document.getElementById('listasr4').value;


				if (

					(valor == null || valor.length == 0 || /^\s+$/.test(valor)) ||
					(valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2)) //||
					//(valor == null || valor.length == 0 || /^\s+$/.test(valor))



				) {

					alert("Defina Fecha Inicial,Fecha Final");
					document.getElementById('fecha1soli').style.borderColor = '#FF0000';
					document.getElementById('fecha2soli').style.borderColor = '#FF0000';
					//document.getElementById('listasr4').style.borderColor = '#FF0000';
					return false;

				} else {


					opcion = 14000;

					//FECHAS REGISTRO
					var dato_1soli = $('#fecha1soli').val();
					var dato_2soli = $('#fecha2soli').val();

					location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion + "&dato_1soli=" + dato_1soli + "&dato_2soli=" + dato_2soli;


				}



			});

			$("#generar_excel_memoad").click(function() {


				valor = document.getElementById('fecha1soli').value;
				valor2 = document.getElementById('fecha2soli').value;
				//valor3 = document.getElementById('listasr4').value;


				if (

					(valor == null || valor.length == 0 || /^\s+$/.test(valor)) ||
					(valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2)) //||
					//(valor == null || valor.length == 0 || /^\s+$/.test(valor))



				) {

					alert("Defina Fecha Inicial,Fecha Final");
					document.getElementById('fecha1soli').style.borderColor = '#FF0000';
					document.getElementById('fecha2soli').style.borderColor = '#FF0000';
					//document.getElementById('listasr4').style.borderColor = '#FF0000';
					return false;

				} else {


					//RECORRER LISTA MULTIPLE
					//Y CONCATENAR SUS VALORES ID
					var dato5_ra = "";
					var contid = 0;
					obj = document.getElementById('listasr4');
					for (i = 0; opt = obj.options[i]; i++) {

						if (opt.selected) {
							//dato5_ra = opt.value+" "+opt.text+"-"+dato5_ra;
							dato5_ra = opt.value + "," + dato5_ra;

							contid = contid + 1;
						}


					}

					//alert(contid);

					//SE REALIZA ESTA CONDICION PARA QUE EN LA SQL DEL REPORTE NO SEA DE ESTA FORMA AND t1.idsolicitud IN ()
					//Y EL REPORTE NO GENERE INFORMACION
					if (contid != 0) {
						//SE CONCATENA CON CODIGO SQL IN(1,2,3) Y QUITO LA ULTIMA COMA(,) DE LA CADENA CON SLICE
						var cadena2 = "IN (" + dato5_ra.slice(0, -1) + ")";
						//alert(cadena2);
					} else {
						var cadena2 = 1;
					}



					var mpincorporado;

					if ($("#ckets").is(':checked')) {
						//INCORPORADOS AL PROCESO; 
						mpincorporado = "IS NOT NULL";
					} else {
						//NO INCORPORADOS AL PROCESO;
						mpincorporado = "IS NULL";
					}




					opcion = 16000;

					//FECHAS REGISTRO
					var dato_1soli = $('#fecha1soli').val();
					var dato_2soli = $('#fecha2soli').val();


					var listasoli1 = $("#listasoli1").val(); //JUZGADO
					var listasoli2 = $("#listasoli2").val(); //USUARIO


					location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion + "&dato_1soli=" + dato_1soli + "&dato_2soli=" + dato_2soli + "&idssoli=" + cadena2 + "&mpincorporado=" + mpincorporado + "&listasoli1=" + listasoli1 + "&listasoli2=" + listasoli2;


				}



			});

			$("#generar_excel_TAREASC").click(function() {


				opcion = 17000;

				location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion;



			});

			$("#generar_excel_MEMOSC").click(function() {


				opcion = 18000;

				location.href = "index.php?controller=archivo&action=ReporteExcel&opcion=" + opcion;



			});

			//AGREGADO POR JORGE ANDRES VALENCIA EL 04 DE DICIEMBRE 2014
			//PARA QUE LA FILA DE LA TABLA DE ACCTUACIONES NO SE VEA EN LA CARGA
			//Y SE DEBA USAR LOS BOTONES DE LISTAR Y DESEACTIVAR
			$('#filatramite').hide();

			//ESTA PARTE TAMBIEN FUNCIONA, PERO SE USA LA FORMA
			//DE CARGAR LA TABLA DIRECTAMENTE EN LA VISTA Y NO DE UN ARCHIVO
			//PHP LLAMADO contenido-ajax_3.php como se tenia
			//TAMBIEN SE DESACTIVA EL DIV DONDE SE CARGA LA INFORMACION QUE DA EL ARCHIVO
			//div id="destino_3"></div> ESTE DIV ESTA EN LA VISTA
			//SE DEJA ESTE CODIGO DE EJEMPLO
			$("#enlaceajax_3").click(function(evento) {
				evento.preventDefault();
				$("#destino_3").load("views/viewstablas/contenido-ajax_3.php");
				$('#filatramite').show();
			});

			//AL DAR CLIC EN EL BOTON DESACTIVAR OCULTA LA FILA
			$(".fila").click(function(evento) {
				evento.preventDefault();
				//alert(1);
				$('#filatramite').hide();
			});

			// <!-- TABLA CUANDO SE ENTRA EL SIEPRO, QUE RESALTA 30 REGISTROS -->
			/*$('#frm_editar1').dataTable( { 
				'sPaginationType': 'full_numbers' 
			} );


			<!-- TABLA CUANDO SE REALIZA EL FILTRO EN LA TABLA ANTERIOR Y SE DA CLC EN EL BOTON CONSULTAR -->
			$('#frm_editar2').dataTable( { 
				'sPaginationType': 'full_numbers' 
			} );*/

			// <!-- ALERTA LIQUIDACION -->
			$('#frm_editar3').dataTable({
				'sPaginationType': 'full_numbers'
			});

			// <!-- para que funcione esta linea se define en LA RUTA views/viewstablas las librerias correspondientes, esta es la tabla actuacion_expediente de la parte de tramite interno -->
			$('#tramite').dataTable({
				'sPaginationType': 'full_numbers'
			});



			//PARA ACTIVAR Y DEACTIVAR filareparto
			/*var contadorrm = 0;
	$("#btreparto").click(function(evento){
      	
		evento.preventDefault();
		
		contadorrm = contadorrm + 1;
		
		if(contadorrm == 1){
		
			$('#filareparto').show();
			contadorrm = contadorrm + 1;
		}
		else{
			$('#filareparto').hide();
			contadorrm = 0;
		}
   	});*/


			$(".marcar_reparto").click(function(evento) {
				//$("input:checkbox").attr('checked', true);

				$("input:checkbox").prop('checked', true);


			});

			$(".desmarcar_reparto").click(function(evento) {
				//$("input:checkbox").attr('checked', false);

				$("input:checkbox").prop('checked', false);

				//$('#revisarterminos').val('');

			});



			$(".revisarreparto").click(function(evento) {

				//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
				//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
				//var controlemcabezados = 0;

				var idspermisoR = "";

				var idspermiso_real = 0;

				var fR = 1;

				var d0R;
				var d1R;


				//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
				//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
				//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
				//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
				//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
				var cantidad_filas_FR;
				var TABLA_FR = document.getElementById('frm_reparto_masivo');

				cantidad_filas_FR = TABLA_FR.rows.length;

				//alert(cantidad_filas_F);

				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 2; r < cantidad_filas_FR; r++) {

					d0R = document.getElementById("frm_reparto_masivo").rows[r].cells[0].innerText;
					d1R = document.getElementById("frm_reparto_masivo").rows[r].cells[1].innerText;
					d2R = document.getElementById("frm_reparto_masivo").rows[r].cells[2].innerText;
					d6R = document.getElementById("frm_reparto_masivo").rows[r].cells[6].innerText;


					if ($("#chk" + fR).is(':checked')) {

						//alert("ENTRE");

						d3R = $("#juzgado_reparto_masivo" + fR).val();
						d4R = $("#cuadernos_reparto" + fR).val();
						d5R = $("#traslado_reparto_masivo" + fR).val();

						if (
							d3R == null || d3R.length == 0 || /^\s+$/.test(d3R) ||
							d4R == null || d4R.length == 0 || /^\s+$/.test(d4R)

						) {

							idspermiso_real = 1;
						}

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R + "//////" + d1R + "//////" + d2R + "//////" + d3R + "//////" + d4R + "//////" + d5R + "//////" + d6R + "******" + idspermisoR;


					}

					fR = fR + 1;


				}


				if (idspermisoR == "" || idspermiso_real == 1) {

					alert("No se ha Selecionado Ningun Registro de la Tabla REPARTO MASIVO, o Falta por Seleccionar Informacion en los Registros...");

				} else {

					//alert(idspermiso);

					$('#revisarrepartos').val(idspermisoR);


					//CAPTURO LOS IDS DEL DOCUMENTO EL CUAL QUIERO CORREGIR
					var dato_idR = $('#revisarrepartos').val();


					if (confirm("ESTA SEGURO DE REALIZAR EL REPARTO MASIVO")) {

						//alert(dato_idR);


						//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado

						location.href = "index.php?controller=archivo&action=Registrar_Reparto_Masivo_NV&dato_idR=" + dato_idR;

					}


				}

			});

			$(".buscar_reparto_masivo").click(function(evento) {


				if (

					$('#fechaiRM').val() == null || $('#fechaiRM').val().length == 0 || /^\s+$/.test($('#fechaiRM').val()) ||
					$('#fechafRM').val() == null || $('#fechafRM').val().length == 0 || /^\s+$/.test($('#fechafRM').val())


				) {

					document.getElementById('fechaiRM').style.borderColor = '#FF0000';
					document.getElementById('fechafRM').style.borderColor = '#FF0000';


					alert("DEFINIR RANGO DE FECHAS");

				} else {

					//alert("BUSCANDO...");

					var dato_0 = 1;
					var firm = $('#fechaiRM').val();
					var ffrm = $('#fechafRM').val();

					//location.href="index.php?controller=archivo&action=listarUbicacionExpediente&dato_0="+dato_0+"&idradicado="+idradicado;

					location.href = "index.php?controller=archivo&action=listarUbicacionExpediente&dato_0=" + dato_0 + "&firm=" + firm + "&ffrm=" + ffrm;
				}


			});




			//PARA ACTIVAR Y DEACTIVAR filaterminos
			var contadort = 0;
			$("#btterminos").click(function(evento) {

				evento.preventDefault();

				contadort = contadort + 1;

				if (contadort == 1) {

					$('#filaterminos').show();
					contadort = contadort + 1;
				} else {
					$('#filaterminos').hide();
					contadort = 0;
				}
			});


			$(".marcar").click(function(evento) {
				//$("input:checkbox").attr('checked', true);

				$("input:checkbox").prop('checked', true);


			});

			$(".desmarcar").click(function(evento) {
				//$("input:checkbox").attr('checked', false);

				$("input:checkbox").prop('checked', false);

				$('#revisarterminos').val('');

			});



			$(".revisartodo").click(function(evento) {

				//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
				//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
				//var controlemcabezados = 0;

				var idspermiso = "";

				var radicados = "";

				var f = 1;

				var d0;
				var d1;


				//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
				//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
				//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
				//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
				//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('frm_tramite_interno');

				cantidad_filas_F = TABLA_F.rows.length;

				//alert(cantidad_filas_F);

				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 2; r < cantidad_filas_F; r++) {

					d0 = document.getElementById("frm_tramite_interno").rows[r].cells[0].innerText;
					d1 = document.getElementById("frm_tramite_interno").rows[r].cells[1].innerText;

					if ($("#chk" + f).is(':checked')) {

						//alert("ENTRE");

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermiso = d0 + "," + idspermiso;

						radicados = d1 + "," + radicados;
					}

					f = f + 1;


				}


				if (idspermiso == "") {

					alert("No se ha Selecionado Ningun Registro de la Tabla LISTAR DE PROCESOS CON VENCIMIENTO DE TERMINOS");

				} else {

					//alert(idspermiso);

					$('#revisarterminos').val(idspermiso);

					$('#revisarradicados').val(radicados);

					//CAPTURO LOS IDS DEL DOCUMENTO EL CUAL QUIERO CORREGIR
					var dato_id = $('#revisarterminos').val();
					var dato_radicado = $('#revisarradicados').val();

					//alert(dato_id+"***"+dato_radicado);

					location.href = "index.php?controller=archivo&action=Termino_Revisado_Todos&id=" + dato_id + "&radicado=" + dato_radicado


				}

			});

			//PARA ACTIVAR Y DEACTIVAR filaliquidacion
			var contadorl = 0;
			$("#btliquidacion").click(function(evento) {

				evento.preventDefault();

				contadorl = contadorl + 1;

				if (contadorl == 1) {

					$('#filaliquidacion').show();
					contadorl = contadorl + 1;
				} else {
					$('#filaliquidacion').hide();
					contadorl = 0;
				}
			});

			$(".generarexcel").click(function() {

				//alert(1);


				dato_0 = 3; //para saber que es el reporte 1
				tfiltro = 1; //sin filtro

				location.href = "index.php?controller=archivo&action=GenerarTerminosExcel&opcion=" + dato_0 + "&tfiltro=" + tfiltro;

			});

			$(".generarexcel2").click(function() {

				//alert(1);


				dato_0 = 4; //para saber que es el reporte 1
				tfiltro = 1; //sin filtro

				location.href = "index.php?controller=archivo&action=GenerarLiquidacionExcel&opcion=" + dato_0 + "&tfiltro=" + tfiltro;

			});

			$(".generarexcel3").click(function() {

				//alert(1);


				if (

					document.getElementById('fechaiv').value.length == 0 &&
					document.getElementById('fechafv').value.length == 0 &&
					document.getElementById('usev').value.length == 0 &&
					document.getElementById('radicado').value.length == 0

				) {

					dato_0 = 5; //para saber que es el reporte 5
					tfiltro = 1; //sin filtro

					location.href = "index.php?controller=archivo&action=GenerarProcesosVentanillaExcel&opcion=" + dato_0 + "&tfiltro=" + tfiltro;

				} else {


					//dato_0 = 1;
					dato_1 = document.getElementById('fechaiv').value;
					dato_2 = document.getElementById('fechafv').value;

					datox1 = document.getElementById('usev').value;
					datox2 = document.getElementById('radicado').value;

					//alert(datox2);

					dato_0 = 5; //para saber que es el reporte 5
					tfiltro = 2; //con filtro

					location.href = "index.php?controller=archivo&action=GenerarProcesosVentanillaExcel&opcion=" + dato_0 + "&tfiltro=" + tfiltro + "&dato_1=" + dato_1 + "&dato_2=" + dato_2 + "&datox1=" + datox1 + "&datox2=" + datox2;

				}



			});

			//VENCIMIENTO DE TERMINOS REVISADO
			$('.vtrevisado').click(function() {

				//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
				var dato_id = $(this).attr('data-id');
				var dato_radicado = $(this).attr('data-radicado');

				//alert(dato_id+"***"+dato_radicado);

				location.href = "index.php?controller=archivo&action=Termino_Revisado&id=" + dato_id + "&radicado=" + dato_radicado


			});


			//------------ADICIONADO EL 6 DE AGOSTO 2019-------------

			//PROGRAMAR AUDIENCIA
			$('.programar_audiencia').click(function() {


				params = {};
				params.id_filtro = 0;


				//alert(params.eveasunto);
				$('#popupbox').load('views/popupbox/audi_programar.php', params, function() {
					//alert(2);
					$('#block').show();
					//alert(3);
					$('#popupbox').show();
					//alert(4);
				})


			});


			//------------FIN PROGRAMAR AUDIENCIA-------------


		});
	</script>



	<script>
		function limpiar(frm) {
			frm.fechai.value = '';
			frm.fechaf.value = '';
			frm.fechair.value = '';
			frm.fechafr.value = '';
			frm.radicado.value = '';
			frm.piso.value = '';
			frm.idestado.value = '';
			frm.ubicacion.value = '';
			frm.juzgado.value = '';
			//frm.estadosdetalles.value='';
			frm.juzgadodestino.value = '';
			frm.cedula_demandante.value = '';
			frm.demandante.value = '';
			frm.cedula_demandado.value = '';
			frm.demandado.value = '';
			frm.posicion.value = '';
			frm.idusuario.value = '';
			frm.beneficiario.value = '';

			//FECHAS TRAMITE INTERNO y ASIGNADO A
			frm.fechati.value = '';
			frm.fechatf.value = '';
			frm.asignadoaf.value = '';


			frm.fechaoi.value = '';
			frm.fechaof.value = '';

		}

		function calcular_estado(frm) {
			departamento = document.frm.idestado.value;

			temp_nombre_ciudad = document.frm.lista_ciudades.value;
			temp_id_ciudad = document.frm.lista_ciudades_id.value;
			temp_iddepa = document.frm.lista_ciudades_iddepa.value;

			ciudad_nombre = temp_nombre_ciudad.split(",");
			ciudad_id = temp_id_ciudad.split(",");
			ciudad_iddepa = temp_iddepa.split(",");
			kk = ciudad_iddepa.length;

			document.frm.estadosdetalles.options.length = 0;
			i = 0;
			j = 0;
			x = document.getElementById("sl_ciudad");


			while (i < kk) {

				departamento_id = ciudad_iddepa[i];
				if (departamento_id == departamento) {
					x.options[j] = new Option(ciudad_nombre[i]);
					x.options[j].value = ciudad_id[i];

					j++;
				}
				i++;
			}

		}

		function vinculo(variable) {

			location.href = "index.php?controller=archivo&action=show_archivoOtro&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculo1(variable) {

			//alert(variable);
			location.href = "index.php?controller=archivo&action=edit_archivoOtro&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculo1_SIN_JXXI(variable) {

			//alert(variable);
			location.href = "index.php?controller=archivo&action=edit_archivoOtro_SIN_JXXI&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoSalida(variable) {

			location.href = "index.php?controller=archivo&action=regSalidaExpediente&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoDevolucion(variable) {

			location.href = "index.php?controller=archivo&action=regDevolucionExpediente&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoDevolucion1(variable) {

			location.href = "index.php?controller=archivo&action=regDevolucionExpediente&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoTitulos(variable) {

			location.href = "index.php?controller=archivo&action=regTitulos&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoTitulos1(variable) {

			location.href = "index.php?controller=archivo&action=verTitulos&nombre=" + variable;
			//document.write(location.href) 

		}

		function vinculoExcel(variable) {

			variable = 5;
			variable1 = frm.fechai.value;
			variable2 = frm.fechaf.value;
			variable3 = frm.ubicacion.value;
			variable4 = frm.radicado.value;
			variable5 = frm.piso.value;
			variable6 = frm.estadosdetalles.value;
			variable7 = frm.juzgado.value;
			variable8 = frm.posicion.value;
			variable9 = frm.juzgadodestino.value;

			variable10 = frm.cedula_demandante.value;
			variable11 = frm.demandante.value;
			variable12 = frm.cedula_demandado.value;
			variable13 = frm.demandado.value;

			variable16 = frm.fechair.value;
			variable17 = frm.fechafr.value;
			variable20 = frm.idusuario.value;

			//ASI ESTABA 2 DE FEBERO 2016, YA QUE EN ESTE CADENA NO SE INCLUIA LAS VARIABLES (variable10,variable11,variable12,variable13)
			//Y POR ENDE LA CONSULTA SE COLGABA Y NO SE GENERABA
			//location.href="index.php?controller=archivo&action=listadoExcel&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre16="+variable16+"&nombre17="+variable17+"&nombre20="+variable20;

			location.href = "index.php?controller=archivo&action=listadoExcel&nombre=" + variable + "&nombre1=" + variable1 + "&nombre2=" + variable2 + "&nombre3=" + variable3 + "&nombre4=" + variable4 + "&nombre5=" + variable5 + "&nombre6=" + variable6 + "&nombre7=" + variable7 + "&nombre8=" + variable8 + "&nombre9=" + variable9 + "&nombre16=" + variable16 + "&nombre17=" + variable17 + "&nombre20=" + variable20 + "&nombre10=" + variable10 + "&nombre11=" + variable11 + "&nombre12=" + variable12 + "&nombre13=" + variable13;

		}

		function vinculoExcelReparto(variable) {
			variable = 6;
			variable1 = frm.fechai.value;
			variable2 = frm.fechaf.value;
			variable3 = frm.ubicacion.value;
			variable4 = frm.radicado.value;
			variable5 = frm.piso.value;
			variable6 = frm.estadosdetalles.value;
			variable7 = frm.juzgado.value;
			variable8 = frm.posicion.value;
			variable9 = frm.juzgadodestino.value;
			variable16 = frm.fechair.value;
			variable17 = frm.fechafr.value;
			variable20 = frm.idusuario.value;

			location.href = "index.php?controller=archivo&action=listadoExcel&nombre=" + variable + "&nombre1=" + variable1 + "&nombre2=" + variable2 + "&nombre3=" + variable3 + "&nombre4=" + variable4 + "&nombre5=" + variable5 + "&nombre6=" + variable6 + "&nombre7=" + variable7 + "&nombre8=" + variable8 + "&nombre9=" + variable9 + "&nombre16=" + variable16 + "&nombre17=" + variable17 + "&nombre20=" + variable20;

		}

		function vinculoExcelDetalleObservaciones(variable) {

			variable = 7;
			variable1 = frm.fechai.value;
			variable2 = frm.fechaf.value;
			variable3 = frm.ubicacion.value;
			variable4 = frm.radicado.value;
			variable5 = frm.piso.value;
			variable6 = frm.estadosdetalles.value;
			variable7 = frm.juzgado.value;
			variable8 = frm.posicion.value;
			variable9 = frm.juzgadodestino.value;
			variable16 = frm.fechaoi.value;
			variable17 = frm.fechaof.value;
			variable20 = frm.idusuario.value;

			location.href = "index.php?controller=archivo&action=listadoExcel&nombre=" + variable + "&nombre1=" + variable1 + "&nombre2=" + variable2 + "&nombre3=" + variable3 + "&nombre4=" + variable4 + "&nombre5=" + variable5 + "&nombre6=" + variable6 + "&nombre7=" + variable7 + "&nombre8=" + variable8 + "&nombre9=" + variable9 + "&nombre16=" + variable16 + "&nombre17=" + variable17 + "&nombre20=" + variable20;

		}

		function ExcelDetalleObservaciones_USER() {

			//alert(1);

			var valor_1 = document.getElementById('fechaoi').value;
			var valor_2 = document.getElementById('fechaof').value;
			var valor_3 = document.getElementById('idusuario').value;

			if (

				valor_1 == null || valor_1.length == 0 || /^\s+$/.test(valor_1) ||
				valor_2 == null || valor_2.length == 0 || /^\s+$/.test(valor_2)
				/*||
			valor_3 == null || valor_3.length == 0 || /^\s+$/.test(valor_3)*/
			) {

				alert("Defina Fecha Observaci�n Inicial y Fecha Observaci�n Final");
				document.getElementById('fechaoi').style.borderColor = '#FF0000';
				document.getElementById('fechaof').style.borderColor = '#FF0000';
				//document.getElementById('idusuario').style.borderColor = '#FF0000';
				return false;


			} else {


				variable = 70000;

				variable1 = frm.fechaoi.value;
				variable2 = frm.fechaof.value;
				variable3 = frm.idusuario.value;

				location.href = "index.php?controller=archivo&action=listadoExcel&nombre=" + variable + "&nombre1=" + variable1 + "&nombre2=" + variable2 + "&nombre3=" + variable3;

			}


		}



		function consultar_2(frm) {

			document.onkeypress = function(e) {

				var esIE = (document.all);
				var esNS = (document.layers);

				tecla = (esIE) ? event.keyCode : e.which;

				if (tecla == 13) {
					//alert("Ud. ha presionado la tecla Enter"); return false;
					consultar(frm);
				}
			}

		}

		function consultar(frm) {

			variable = 1;
			variable1 = frm.fechai.value;
			variable2 = frm.fechaf.value;
			variable16 = frm.fechair.value;
			variable17 = frm.fechafr.value;
			variable3 = frm.ubicacion.value;
			variable4 = frm.radicado.value;
			variable5 = frm.piso.value;
			variable6 = frm.estadosdetalles.value;
			variable7 = frm.juzgado.value;
			variable8 = frm.posicion.value;
			variable9 = frm.juzgadodestino.value;
			variable10 = frm.cedula_demandante.value;
			variable11 = frm.demandante.value;
			variable12 = frm.cedula_demandado.value;
			variable13 = frm.demandado.value;
			variable20 = frm.idusuario.value;
			variable30 = frm.idestado.value;
			variable50 = frm.beneficiario.value;

			//ASIGNADO POR JORGE ANDRES VALENCIA 14 ENERO 2015
			//ESTAS FECHAS SE USAN PARA TRAER LOS PROCESOS CON TRAMITES 
			//AL DAR CLIC EN EL BOTON CONSULTAR
			variable1b = frm.fechati.value;
			variable2b = frm.fechatf.value;
			variable3b = frm.asignadoaf.value;

			//ASIGNADO POR JORGE ANDRES VALENCIA 26 DE FEBRERO 2015
			//ME PERMITE REALIZAR UN FILTRO CON LAS OBSERVACIONES QUE SE HAN HECHO EN LA TABLA
			//detalle_correspondencia DE LOS PROCESOS
			variable16b = frm.fechaoi.value;
			variable17b = frm.fechaof.value;

			//alert(variable16b+"---"+variable17b);

			//ASI ESTABA
			//location.href="index.php?controller=archivo&action=listarUbicacionExpediente1&nombre="+variable+"&nombre1="+variable1+"&nombre2="+variable2+"&nombre3="+variable3+"&nombre4="+variable4+"&nombre5="+variable5+"&nombre6="+variable6+"&nombre7="+variable7+"&nombre8="+variable8+"&nombre9="+variable9+"&nombre10="+variable10+"&nombre11="+variable11+"&nombre12="+variable12+"&nombre13="+variable13+"&nombre20="+variable20+"&nombre16="+variable16+"&nombre17="+variable17+"&nombre30="+variable30+"&nombre50="+variable50;

			location.href = "index.php?controller=archivo&action=listarUbicacionExpediente1&nombre=" + variable + "&nombre1=" + variable1 + "&nombre2=" + variable2 + "&nombre3=" + variable3 + "&nombre4=" + variable4 + "&nombre5=" + variable5 + "&nombre6=" + variable6 + "&nombre7=" + variable7 + "&nombre8=" + variable8 + "&nombre9=" + variable9 + "&nombre10=" + variable10 + "&nombre11=" + variable11 + "&nombre12=" + variable12 + "&nombre13=" + variable13 + "&nombre20=" + variable20 + "&nombre16=" + variable16 + "&nombre17=" + variable17 + "&nombre30=" + variable30 + "&nombre50=" + variable50 + "&nombre1b=" + variable1b + "&nombre2b=" + variable2b + "&nombre3b=" + variable3b + "&nombre16b=" + variable16b + "&nombre17b=" + variable17b;


		}

		function prueba(frm) {

			radicado = frm.radicado.value;
			beneficiario = frm.beneficiario.value;

			variableT = 'index.php?controller=archivo&action=verTitulos&nombre=' + radicado + "&nombre50=" + beneficiario;
			window.open(variableT, "Evidencias", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=1000, height=400");


		}

		function exportaexceltitulos() {

			radicado = frm.radicado.value;
			beneficiario = frm.beneficiario.value;

			variable = 6000;
			variable1 = radicado;
			variable2 = beneficiario;

			location.href = "index.php?controller=archivo&action=listadoExcel&nombre=" + variable + "&nombret1=" + variable1 + "&nombret2=" + variable2;
		}

		function vinculoMemorial(variable) {

			location.href = "index.php?controller=archivo&action=adicionar_memorial&nombre=" + variable;
			//document.write(location.href) 

		}


		function Adicionar_Observacion(radicado_obs) {

			//alert("NUEVA OBSERVACION");
			//var radicado_obs    = $(this).attr('data-radicado_obs');

			//location.href="index.php?controller=archivo&action=Adicionar_Observacion_2&radicado_obs="+radicado_obs;

			//window.open("index.php?controller=archivo&action=Adicionar_Observacion_2&radicado_obs="+radicado_obs,"OBSERVACIONES","width=800,height=500,scrollbars=YES");

			// definimos la anchura y altura de la ventana
			var altura = 500;
			var anchura = 1000;

			// calculamos la posicion x e y para centrar la ventana
			var y = parseInt((window.screen.height / 2) - (altura / 2));
			var x = parseInt((window.screen.width / 2) - (anchura / 2));

			window.open('index.php?controller=archivo&action=Adicionar_Observacion_2&radicado_obs=' + radicado_obs, target = 'blank', 'width=' + anchura + ',height=' + altura + ',top=' + y + ',left=' + x + ',toolbar=no,location=no,status=no,menubar=no,scrollbars=no,directories=no,resizable=no')

		}


		function cargar_form_audi() {

			params = {};
			params.id_filtro = 0;


			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/audi_programar.php', params, function() {
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})

		}
	</script>





</head>

<body>

	<!---->
	<?php

	$contador = $cont = $datos_estadosdetalles->rowcount();
	$contador = $contador - 1;
	$i = $k = 0;

	while ($fieldd = $datos_estadosdetalles->fetch()) {
		if ($contador != $i) {
			$cad_ciu = $cad_ciu . $fieldd[nombre] . ",";
			$cad_ciu_id = $cad_ciu_id . $fieldd[id] . ",";
			$cad_ciu_iddepa = $cad_ciu_iddepa . $fieldd[idestado] . ",";
			$ciudad[$i][nombre] = $fieldd[nombre];
			$ciudad[$i][id] = $fieldd[id];
			$ciudad[$i][idestado] = $fieldd[idestado];
		} else {
			$cad_ciu = $cad_ciu . $fieldd[nombre];
			$cad_ciu_id = $cad_ciu_id . $fieldd[id];
			$cad_ciu_iddepa = $cad_ciu_iddepa . $fieldd[idestado];
			$ciudad[$i][nombre] = $fieldd[nombre];
			$ciudad[$i][id] = $fieldd[id];
			$ciudad[$i][idestado] = $fieldd[idestado];
		}
		$i++;
	}
	//$contador_a= $cont_a=$datos_actuaciones->rowcount();
	//$contador_a = $contador_a-1;
	//$ii=$kk=$jj=0;
	?>

	<?php require 'header.php'; ?>
	<?php require 'secc_archivo.php'; ?>

	<?php

	if ($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 19 || $_SESSION['idUsuario'] == 4) {

		if ($cantregisrema >= 1) {
			//6000 --> 6 segundos
			echo '<script languaje="JavaScript"> 
					notificacion();
					setInterval(notificacion, 6000);											
				</script>';
		}
	}

	//ALERTA AUDIENCIAS
	if (in_array($_SESSION['idUsuario'], $usuariosaAUDI2, true)) {

		if ($faudi >= 1) {
			//6000 --> 6 segundos
			echo '<script languaje="JavaScript"> 
					audiencia();
					setInterval(audiencia, 6000);										
				</script>';
		}
	}

	if ($cantregisac >= 1) {
		//6000 --> 6 segundos
		echo '<script languaje="JavaScript"> 
				actividad();
				setInterval(actividad, 20000);									
			</script>';
	}

	//TAREAS SIN CERRAR
	if ($tiene_ta_3 >= 1) {
		//6000 --> 6 segundos
		echo '<script languaje="JavaScript"> 	
				tareasincerrar();
				setInterval(tareasincerrar, 6000);						
			</script>';
	}
	?>


	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id="block"></div>
	<div id="popupbox"></div>

	<!---->
	<p align="center">
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash8/cabs/swflash.cab#version=8,0,0,0" id="banner" width="468" height="60">
			<param name="movie" value="views/banner.swf">
			<param name="quality" value="high">
			<param name="wmode" value="transparent">
			<table border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td></td>
				</tr>
				<tr>
					<td>

						<!-- <div id="contenido1"> -->
						<form action="" method="post" enctype="multipart/form-data" name="frm" id="frm">


							<input type="hidden" name="revisarrepartos" id="revisarrepartos" readonly="true" />


							<input type="hidden" name="revisarterminos" id="revisarterminos" readonly="true" />
							<input type="hidden" name="revisarradicados" id="revisarradicados" readonly="true" />


							<div id="titulo_frm" align="center">FILTRO DE UBICACIONES</div>
							<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">



								<!-- SOLICITUD SOPORTE TECNICO Y PROGRAMADOR DE AUDIENCIAS -->
								<tr>

									<!-- <td>
			<a class="generar_soporte" href="javascript:void(0);"><img src="views/images/soporte_1.png" width="100" height="100" title="SOLICITAR SOPORTE TECNICO"/></a>
		</td> -->


									<?php
									//if( in_array($_SESSION['idUsuario'],$usuariosaAUDI2X,true) ){
									?>

									<!-- <td colspan="4">
			
				<a class="programar_audiencia" href="javascript:void(0);"><img src="views/images/audi.png" width="100" height="100" title="PROGRAMAR AUDIENCIA"/></a>
				
			</td>   -->

									<?php
									//}
									?>



								</tr>

								<!-- FIN SOLICITUD SOPORTE TECNICO Y PROGRAMADOR DE AUDIENCIAS -->


								<tr>

									<td colspan="4">


										<a href="index.php?controller=archivo&amp;action=Lista_Expedientes_Bloqueados" style="float:right" title="EXPEDIENTES BLOQUEADOS">

											<button type="button" class="btn btn-danger btn-sm">
												<span class="glyphicon glyphicon-remove-circle"></span> Expedientes Bloqueados
											</button>

										</a>

									</td>


								</tr>


								<tr>
									<td width="157">Fecha Registro Inicial:</td>
									<td width="346"><input name="fechair" type="text" id="fechair" value="<?php echo $_GET['nombre16']; ?>" readonly="readonly" style="width:254px; height:23px" />
									</td>
									<td width="107">Fecha Registro Final:</td>
									<td width="148"><input name="fechafr" type="text" id="fechafr" value="<?php echo $_GET['nombre17']; ?>" readonly="readonly" style="width:254px; height:23px " />
									</td>
								</tr>



								<tr>


									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>FILTRO DE OBSERVACIONES</strong></div>
									</td>

								</tr>


								<tr>

									<td width="157">Fecha Observaci�n Inicial:</td>
									<td width="346"><input name="fechaoi" type="text" id="fechaoi" value="<?php echo $_GET['nombre16b']; ?>" readonly="readonly" style="width:254px; height:23px " /></td>
									<td width="107">Fecha Observaci�n Final:</td>
									<td width="148"><input name="fechaof" type="text" id="fechaof" value="<?php echo $_GET['nombre17b']; ?>" readonly="readonly" style="width:254px; height:23px " /></td>

								</tr>

								<tr>
									<td colspan="2">
										GENERAR REPORTE OBSERVACION USUARIO
									</td>
									<td colspan="2">

										<!-- <img src="views/images/hv_6.png" width="30" height="30" onclick="Reporte_Excel(2)" title="GENERAR REPORTE OBSERVACION USUARIO"/>	 -->

										<img src="views/images/hv_6.png" width="30" height="30" alt="Exportar Excel" title="GENERAR REPORTE OBSERVACION USUARIO" onclick="ExcelDetalleObservaciones_USER()" />

									</td>

								</tr>


								<tr>


									<strong>
								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>PARTES</strong></div>
									</td>
								</tr></strong>
								<tr>
									<td>C&eacute;dula Demandante:</td>
									<td><input type="text" name="cedula_demandante" id="txt_input" maxlength="25" class="" onchange="" value="<?php echo $_GET['nombre10']; ?>" /></td>
									<td>Nombre Demandante: </td>
									<td><input type="text" name="demandante" id="txt_input" maxlength="50" class="" onchange="" value="<?php echo $_GET['nombre11']; ?>" /></td>
								</tr>
								<tr>
									<td>C�dula Demandado: </td>
									<td><input type="text" name="cedula_demandado" id="txt_input" maxlength="25" class="" onchange="" value="<?php echo $_GET['nombre12']; ?>" /></td>
									<td>Nombre Demandado: </td>
									<td><input type="text" name="demandado" id="txt_input" maxlength="50" class="" onchange="" value="<?php echo $_GET['nombre13']; ?>" /></td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>UBICACI&Oacute;N</strong></div>
									</td>
								</tr>
								<tr>
									<td>Radicado:</td>
									<td>
										<input type="text" name="radicado" id="radicado" value="<?php echo $_GET['nombre4']; ?>" onkeypress="consultar_2(frm)" />
										<input type="hidden" name="lista_ciudades" id="hiddenField3" value="<?php echo $cad_ciu; ?>" />
										<input type="hidden" name="lista_ciudades_id" id="hiddenField4" value="<?php echo $cad_ciu_id; ?>" />
										<input type="hidden" name="lista_ciudades_iddepa" id="hiddenField5" value="<?php echo $cad_ciu_iddepa; ?>" />
										<input type="hidden" name="lista_actuaciones_nombre" id="hiddenField6" value="<?php echo $cad_act; ?>" />
										<input type="hidden" name="lista_actuaciones_id" id="hiddenField7" value="<?php echo $cad_act_id; ?>" />
										<input type="hidden" name="lista_actuaciones_tipo" id="hiddenField8" value="<?php echo $cad_act_tipo; ?>" />
										<input type="hidden" name="id" id="hiddenField9" value="<?php echo $_GET['nombre']; ?>" />
									</td>
									<td>Piso</td>
									<td><input type="text" name="piso" id="txt_input" value="<?php echo $_GET['nombre5']; ?>" /></td>
								</tr>
								<tr>
									<td>Estado:</td>
									<td><select name="idestado" id="sl_input" onchange="calcular_estado(frm)">
											<option value="">Seleccione un Estado</option>
											<?php while ($fieldc = $datos_estados->fetch()) {        ?>
												<option value="<?php echo $fieldc[id]; ?>" <?php if ($_GET['nombre30'] == $fieldc[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldc[nombre]; ?></option>
											<?php } ?>
										</select></td>
									<td>Juzgado Origen:</td>
									<td><input type="text" name="juzgado" id="txt_input" value="<?php echo $_GET['nombre7']; ?>" /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><select name="estadosdetalles" id="sl_ciudad">
											<option value="<?php echo $field[id]; ?>"><?php echo $field[nombre]; ?></option>
											<?php while ($k < $cont) {
												if ($ciudad[$k][idestado] == $dp) {

											?>
													<option value="<?php echo $ciudad[$k][id]; ?>" <?php if ($_GET['nombre6'] == $ciudad[$k][id]) { ?>selected="selected" <?php } ?>><?php echo $ciudad[$k][nombre]; ?></option>
											<?php }
												$k++;
											} ?>
										</select> </td>
									<td>Ubicaci&oacute;n:</td>
									<td><label for="select"></label>
										<select name="posicion" id="sl_input">
											<option value="" <?php if ($_GET['nombre8'] == '') { ?>selected="selected" <?php } ?>>Seleccione Ubicaci&oacute;n</option>
											<option value="archivo" <?php if ($_GET['nombre8'] == 'archivo') { ?>selected="selected" <?php } ?>>Archivo</option>
											<option value="prestado" <?php if ($_GET['nombre8'] == 'prestado') { ?>selected="selected" <?php } ?>>Prestado</option>
											<option value="con fecha de salida" <?php if ($_GET['nombre8'] == 'con fecha de salida') { ?>selected="selected" <?php } ?>>Con Fecha de Salida</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Posici&oacute;n:</td>
									<td><input type="text" name="ubicacion" id="txt_input" value="<?php echo $_GET['nombre3']; ?>" /></td>

									<td>Juzgado Destino: </td>
									<td>
										<select name="juzgadodestino" id="sl_input" onchange="">
											<option value="">Seleccione un Destino</option>
											<?php while ($fieldc = $datos_juzgadodestino->fetch()) {        ?>
												<option value="<?php echo $fieldc[id]; ?>" <?php if ($_GET['nombre9'] == $fieldc[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldc[nombre]; ?></option>
											<?php } ?>
										</select>
									</td>


								</tr>
								<tr>
									<td colspan="2">Usuario:</td>
									<td colspan="2"><select name="idusuario" id="idusuario">
											<option value="">Seleccione un Usuario</option>
											<?php while ($fieldc = $datos_usuarios->fetch()) {        ?>
												<option value="<?php echo $fieldc[id]; ?>" <?php if ($_GET['nombre20'] == $fieldc[id]) { ?>selected="selected" <?php } ?>><?php echo $fieldc[empleado]; ?></option>
											<?php } ?>
										</select></td>
								</tr>


								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>REPARTO</strong></div>
									</td>
								</tr>


								<tr>
									<td width="157">Fecha Reparto Inicial:</td>
									<td width="346"><input name="fechai" type="text" id="fechai" value="<?php echo $_GET['nombre1']; ?>" readonly="readonly" />



									</td>

									<td width="107">Fecha Reparto Final:</td>
									<td width="148"><input name="fechaf" type="text" id="fechaf" value="<?php echo $_GET['nombre2']; ?>" readonly="readonly" />

									</td>
								</tr>




								<!-- REPARTO MASIVO -->
								<?php if (in_array($_SESSION['idUsuario'], $usuariosaAR2, true)) { /*if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51){*/ ?>

									<tr>
										<td colspan="4" bgcolor="#CDE3F6">
											<div align="center"><strong>REPARTO MASIVO</strong></div>
										</td>
									</tr>

									<tr>

										<?php //if(count($freparto) > 1){ 
										?>


										<!-- <td colspan="4">
						<a id="btreparto" href="javascript:void(0);"><img src="views/images/repartomasivo.png" width="30" height="30" title="REPARTO MASIVO"/>REPARTO MASIVO</a> 
						
						
					</td> -->

										<?php //} else{
										?>

										<!-- <td colspan="4">
						<a id="btterminos" href="javascript:void(0);"><img src="views/images/noterminos.png" width="40" height="40" title="TERMINOS"/>NO EXISTEN VENCIMIENTO DE TERMINOS</a>
					</td> -->

										<?php //} 
										?>


									</tr>


									<tr>

										<td width="157">Fecha Inicial:</td>
										<td width="346"><input name="fechaiRM" type="text" id="fechaiRM" value="<?php echo $firm; ?>" readonly="readonly" style="width:254px; height:23px " />

										</td>

										<td width="107">Fecha Final:</td>
										<td width="148"><input name="fechafRM" type="text" id="fechafRM" value="<?php echo $ffrm; ?>" readonly="readonly" style="width:254px; height:23px " />




										</td>

									</tr>

									<tr>
										<td colspan="4">
											<a class="buscar_reparto_masivo" href="javascript:void(0);" title="Revisar Todo"><img src="views/images/buscarrr.jpg" width="30" height="30" title="Buscar Reparto Masivo" /></a>
										</td>
									</tr>


									<tr id="filareparto">

										<td colspan="4">

											<!-- <br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Termino</label><br>
				<input name="fechater" id="fechater" type="text" readonly="true" size="15"> -->


											<table border="0" align="center" rules="rows" id="tablareparto">


												<tr>

													<td>

														<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_reparto_masivo">

															<thead>
																<tr>
																	<th bgcolor="#CDE3F9" colspan="11">
																		<center>
																			<div id="titulo_frm"><?php echo $registros_masivos . " PROCESOS / F. INICIAL:" . $firm . " F. FINAL:" . $ffrm; ?></div>
																		</center>
																	</th>
																</tr>
																<tr>
																	<th>ID</th>
																	<th>RADICADO</th>
																	<th>FECHA</th>
																	<th>JUZGADO</th>
																	<th>CUADERNOS</th>
																	<th>TRASLADO</th>
																	<th>ID_CP</th>
																	<th>CP</th>

																	<th>

																		<a class="marcar_reparto" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos" /></a>
																	</th>

																	<th>

																		<a class="desmarcar_reparto" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos" /></a>
																	</th>

																	<th>

																		<a class="revisarreparto" href="javascript:void(0);" title="Revisar Todo"><img src="views/images/apply_f2.png" width="20" height="20" title="Revisar Todo" /></a>
																	</th>

																	<!-- <th><a class="generarexcel" href="javascript:void(0);"><img src="views/images/excel.jpg" width="35" height="35" title="GENERAR EXCEL"/></a></th>  -->
																</tr>
															</thead>

															<tbody>

																<?php $Cr = 1;
																while ($rowr = $datos_reparto->fetch()) { ?>


																	<tr>
																		<td><?php echo $rowr[id]; ?></td>

																		<td>
																			<?php

																			echo $rowr[radicado];

																			$vector_clase_proceso = $modelo->getClaseProcesoJusticiaXXI($rowr[radicado]);

																			//echo $vector_clase_proceso;

																			$vector_clase_proceso_2 = explode("//////", $vector_clase_proceso);


																			$datos_clase_proceso_siepro = $modelo->get_Clase_Proceso_Siepro($vector_clase_proceso_2[0]);
																			$rowCP                      = $datos_clase_proceso_siepro->fetch();

																			//echo $rowCP[id];

																			?>
																		</td>


																		<td><?php echo $rowr[fecharegistrosistema]; ?></td>


																		<td>
																			<select name="<?php echo "juzgado_reparto_masivo" . $Cr; ?>" id="<?php echo "juzgado_reparto_masivo" . $Cr; ?>" style="width:150px; height:25px">
																				<option value="">Seleccione Juzgado</option>
																				<?php

																				//FORMA LOCAL
																				/*unset($juzgado_reparto);
															$juzgado_reparto = $modelo->listarJuzgadosDestino(); 
															while($field_reparto = $juzgado_reparto->fetch()){
															
																if($field_reparto[id] == 1 || $field_reparto[id] == 2){
															?>
																	<option value="<?php echo $field_reparto[id];?>"><?php echo $field_reparto[nombre];?></option>
																
															<?php }}*/

																				//FORMA DESDE JUSTICIA XXI
																				$il = 0;

																				while ($il < $long_1) {

																					$datosdelit_2C = explode("//////", $datosdelit_2B[$il]);

																					echo "<option value=\"" . $datosdelit_2C[0] . "------" . $datosdelit_2C[1] . "------" . $datosdelit_2C[2] . "------" . $datosdelit_2C[3] . "------" . $datosdelit_2C[4] . "\">" . $datosdelit_2C[1] . "</option>";

																					$il = $il + 1;
																				}

																				?>
																			</select>
																		</td>

																		<td>
																			<input type="text" name="<?php echo "cuadernos_reparto" . $Cr; ?>" id="<?php echo "cuadernos_reparto" . $Cr; ?>" style="width:50px; text-align:right" />
																		</td>


																		<td>

																			<select name="<?php echo "traslado_reparto_masivo" . $Cr; ?>" id="<?php echo "traslado_reparto_masivo" . $Cr; ?>" style="width:50px">
																				<!-- <option value="">Seleccione Opcion</option> -->
																				<option value="NO" selected>NO</option>
																				<option value="SI">SI</option>
																			</select>
																		</td>



																		<td><?php echo $rowCP[id]; ?></td>

																		<td><?php echo $rowCP[nombre]; ?></td>

																		<td>
																			<input type="checkbox" name="<?php echo "chk" . $Cr; ?>" id="<?php echo "chk" . $Cr; ?>" value="<?php echo "chk" . $Cr; ?>" title="<?php echo "chk" . $Cr; ?>" />
																		</td>

																		<td>-</td>
																		<td>-</td>
																		<!-- <td>-</td> -->

																		<!-- <td><a class="vtrevisado" href="javascript:void(0);" data-id="<?php //echo $row['id']; 
																																			?>" data-radicado="<?php //echo $row['radicado']; 
																																								?>"><img src="views/images/revi1.jpg" width="35" height="35" title="REVISADO"/></a></td> -->


																	</tr>

																<?php $Cr = $Cr + 1;
																} ?>

															</tbody>
														</table>

													</td>
												</tr>


											</table>



										</td>


									</tr>





								<?php } ?>








								<!-- ---------------------------------------CODIGO ORGANIZADO POR JORGE ANDRES VALENCIA OROZCO 04 DE DICIEMBRE 2014--------------------------------------------- -->
								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>TR�MITE INTERNO</strong></div>
									</td>
								</tr>

								<tr>

									<td width="157">Fecha Inicial Estado:</td>
									<td width="346"><input name="fechati" type="text" id="fechati" value="<?php echo $_GET['nombre1b']; ?>" readonly="readonly" style="width:254px; height:23px " />
									</td>

									<td width="107">Fecha Final Estado:</td>
									<td width="148"><input name="fechatf" type="text" id="fechatf" value="<?php echo $_GET['nombre2b']; ?>" readonly="readonly" style="width:254px; height:23px " />

									</td>
								</tr>

								<tr>
									<td colspan="2">Asignado A:</td>
									<td colspan="2"><select name="asignadoaf" id="asignadoaf" style="width:258px; height:30px">

											<option value="" selected="selected">Seleccionar Asignado A</option>
											<?php
											while ($row = $datos_asignadoa->fetch()) {
											?>

												<!-- DE ESTA FORMA TAMBIEN FUNCIONA, SE DEJA LA OTRA FORMA YA QUE CUANDO
							DE LA PARTE TRAMITE INTERNO SELECCIONO ASIGNADO A Y DOY CLIC EN EL BOTON CONSULTAR
							EL FUNCIONARIO QUE SELECCIONO SE QUEDA SELECCIONADO -->
												<!-- echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>"; -->

												<option value="<?php echo $row[id]; ?>" <?php if ($_GET['nombre3b'] == $row[id]) { ?>selected="selected" <?php } ?>><?php echo $row[empleado]; ?></option>

											<?php
											}
											?>
										</select>
									</td>

								</tr>

								<tr>
									<td colspan="2">
										GENERAR REPORTE TRAMITE INTERNO
									</td>
									<td colspan="2">

										<img src="views/images/listatramite.png" width="30" height="30" onclick="Reporte_Excel(2)" title="GENERAR REPORTE TRAMITE INTERNO" />

									</td>

								</tr>


								<!-- ---------------------------------------FILTRO PARA SABER CUANTO SE A CONSULTADO EN VENTANILLA POR PROCESO--------------------------------------------- -->
								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>CONSULTA EN VENTANILLA DE PROCESOS</strong></div>
									</td>
								</tr>

								<tr>

									<td width="157">Fecha Inicial:</td>
									<td width="346"><input name="fechaiv" type="text" id="fechaiv" value="<?php echo $_GET['dato_1']; ?>" readonly="readonly" style="width:254px; height:23px " />
									</td>

									<td width="107">Fecha Final:</td>
									<td width="148"><input name="fechafv" type="text" class="tinicio" id="fechafv" value="<?php echo $_GET['dato_2']; ?>" readonly="readonly" style="width:254px; height:23px " />

									</td>
								</tr>

								<tr>
									<td colspan="2">Usuario Ventanilla:</td>
									<td colspan="2"><select name="usev" id="usev" style="width:258px; height:30px">

											<option value="" selected="selected">Seleccionar Usuario Ventanilla</option>
											<?php
											while ($row = $datos_userventanilla->fetch()) {
											?>

												<?php if (in_array($row[id], $usuariosa)) { ?>

													<option value="<?php echo $row[id]; ?>" <?php if ($_GET['datox1'] == $row[id]) { ?>selected="selected" <?php } ?>><?php echo $row[empleado]; ?></option>

												<?php
												}
												?>

											<?php
											}
											?>
										</select>
									</td>

								</tr>


								<!-- CIERRO ESTA FILA YA QUE SE UTILIZARA DIFERENTE EL FUNCIONAMINETO
	 USANDO EL BOTON CONSULTAR Y CARGANDO LA INFORMACION DE TRAMITE INTERNO EN LA TABLA INFERIOR
	 PERO ESTA FILA FUNCIONA PERFECTAMENTE-->
								<!-- <tr>
	
		<td>
			<a id="enlaceajax_3" href="javascript:void(0);" title="LISTAR TR�MITE"><img src="views/images/next_f2.png" width="20" height="20" title="LISTAR TR�MITE"/>Listar</a>
		</td>
		<td>
			<a class="fila" href="javascript:void(0);" title="DESACTIVAR LISTA TR�MITE"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR LISTA TR�MITE"/>Desactivar</a>
		</td>
		<td colspan="2">
			<a href="javascript:void(0);" onclick="Reporte_Excel()" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="20" height="20" title="GENERAR EXCEL"/>Generar Excel</a>
		</td>
	
	</tr> -->

								<!-- 
	
	NOTA: SE CIERRA ESTA PARTE, PARA QUE AL INGRESAR AL MODULO SIEPRO
	NO DEMORE TANTO EN SU CARGA
	CAMBIO HECHO 29 DE JULIO 2019
	 -->


								<!-- <tr id="filatramite">
	
		<td colspan="4">
		
		<table cellpadding="0" cellspacing="0" border="1" class="display" id="tramite">
			<thead> 
				<tr> 
					<th bgcolor="#CDE3F6">RADICADO</th>
					<th bgcolor="#CDE3F6">CLASE PROCESO</th>
					<th bgcolor="#CDE3F6">FECHA FINAL</th>
					<th bgcolor="#CDE3F6">ASIGNADO</th>
					<th bgcolor="#CDE3F6">ACTUACI�N</th>
				</tr> 
			</thead> 
			
			<tbody> 
			
			<?php //while($row = $datos_actuaciones->fetch()){ 
			?>
				
						
					<tr>
						<td><?php //echo $row[radicado];
							?></td>
						<td><?php //echo $row[nombre];
							?></td>
						<td><?php //echo $row[actu_fechaf];
							?></td>
						<td><?php //echo $row[empleado];
							?></td>
						<td><?php //echo $row[acc_descripcion];
							?></td>
					</tr>
					
			<?php //} 
			?>
	<!--		</tbody>
		</table>		</td>
	</tr> -->

								<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------- -->





								<tr>
									<td colspan="4" bgcolor="#CDE3F6">
										<div align="center"><strong>T&Iacute;TULOS</strong></div>
									</td>
								</tr>

								<tr>
									<td>Beneficiario:</td>
									<td><input type="text" name="beneficiario" id="txt_input" maxlength="25" class="" onchange="" value="<?php echo $_GET['nombre50']; ?>" /></td>
									<td>NO FILTRAR: </td>
									<td>&nbsp;</td>
								</tr>



								<!-- REPARTO VIRTUAL A JUZGADO (A DESPACHO) -->

								<?php if ($alerta_despacho  == 1) { ?>

									<tr>

										<td colspan="4">


											<a id="pad" href="index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3 . "******" . $Jid_juzgado_4 . "******" . $Jid_juzgado_5 . "******" . $Jid_juzgado_6; ?>" title="PROCESOS A DESPACHO" <?php echo " " . $Jid_juzgado_3; ?>>
												<img src="views/images/des2.png" width="45" height="45" title="PROCESOS A DESPACHO" <?php echo " " . $Jid_juzgado_3; ?> />
												PROCESOS A DESPACHO<br><?php echo " " . $Jid_juzgado_3; ?>
											</a>

										</td>


									</tr>


								<?php } ?>



								<!-- REPORTE EXCEL HOJA CONTROL ENTREGA DE TITULOS -->

								<?php if ($banderaHCET == 1) { ?>

									<tr>
										<td colspan="4" bgcolor="#CDE3F6">
											<div align="center"><strong>HOJA CONTROL DE ENTREGA DE TITULOS</strong></div>
										</td>
									</tr>

									<tr>

										<td colspan="4">


											<a id="generar_excel_hcet" href="javascript:void(0);"><img src="views/images/excel_1.jpg" width="45" height="45" title="HOJA CONTROL DE ENTREGA DE TITULOS" />HOJA CONTROL DE ENTREGA DE TITULOS</a>

										</td>


									</tr>



									<tr>

										<td>
											<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Inicial:</label>
										</td>
										<td>
											<input type="text" name="fecha1hcet" id="fecha1hcet" readonly="readonly" style="width:254px; height:23px ">
										</td>

										<td>
											<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Final:</label>
										</td>

										<td>
											<input type="text" name="fecha2hcet" id="fecha2hcet" readonly="readonly" style="width:254px; height:23px ">
										</td>


									</tr>

								<?php } ?>

								<!-- REPORTE EXCEL SIN FILTRO -->

								<?php if ($banderaREVS == 1) { ?>

									<tr>
										<td colspan="4" bgcolor="#CDE3F6">
											<div align="center"><strong>REPORTES SIN FILTRO</strong></div>
										</td>
									</tr>

									<tr>

										<td colspan="4">



											<a id="generar_excel_TAREASC" href="javascript:void(0);" style="float:left "><img src="views/images/t1.png" width="65" height="65" title="REPORTE TAREAS SIN CERRAR" />REPORTE TAREAS SIN CERRAR</a>

										</td>


									</tr>

									<tr>

										<td colspan="4">


											<a id="generar_excel_MEMOSC" href="javascript:void(0);" style="float:left "><img src="views/images/excos1.png" width="65" height="65" title="REPORTE ENTRADA MEMORIALES SIN COSTAS" />REPORTE ENTRADA MEMORIALES SIN COSTAS</a>

										</td>


									</tr>

								<?php } ?>

								<!-- REPORTE EXCEL ESCOGER VARIAS SOLICITUDES TABLA correspondencia -->

								<?php if ($banderaREVS == 1) { ?>

									<tr>
										<td colspan="4" bgcolor="#CDE3F6">
											<div align="center"><strong>REPORTES</strong></div>
										</td>
									</tr>

									<tr>

										<td colspan="4">


											<a id="generar_excel_vsoli" href="javascript:void(0);"><img src="views/images/excel_1.jpg" width="45" height="45" title="REPORTE EXCEL" />REPORTE EXCEL VARIAS SOLICITUDES</a>


											<a id="generar_excel_LIQUI" href="javascript:void(0);" style="float:right "><img src="views/images/excel_2.jpg" width="45" height="45" title="REPORTE LIQUIDACIONES DE CREDIT" />LIQUIDACIONES DE CREDITO</a>


										</td>


									</tr>

									<tr>

										<td colspan="4">


											<a id="generar_excel_memoad" href="javascript:void(0);"><img src="views/images/excel.jpg" width="45" height="45" title="REPORTE EXCEL MEMORIALES Y PROCESO A DESPACHO" />REPORTE EXCEL MEMORIALES Y PROCESO A DESPACHO</a>



										</td>


									</tr>



									<tr>

										<td>
											<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Inicial:</label>
										</td>
										<td>
											<input type="text" name="fecha1soli" id="fecha1soli" readonly="readonly" style="width:254px; height:23px ">
										</td>

										<td>
											<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Final:</label>
										</td>

										<td>
											<input type="text" name="fecha2soli" id="fecha2soli" readonly="readonly" style="width:254px; height:23px ">
										</td>


									</tr>


									<tr>

										<td>

											<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Solicitud:</label><br>

										</td>


										<td>

											<select name="listasr4[]" id="listasr4" size="8" multiple="multiple" style="width:200px">

												<!-- <option value="" selected="selected"></option>  -->

												<?php
												while ($row = $datos_SOLI->fetch()) {

													echo "<option value=\"" . $row[id] . "\">" . $row[nombre] . "</option>";
												}
												?>
											</select>

										</td>

										<td>

											<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Incorporados al Proceso:</label><br>

										</td>

										<td>

											<input type="checkbox" name="ckets" id="ckets" value="1" />


										</td>

									</tr>

									<tr>

										<td>

											<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Juzgado:</label><br>

										</td>


										<td>

											<select name="listasoli1" id="listasoli1" style="width:200px">

												<option value="" selected="selected"></option>

												<?php
												while ($row = $datos_SOLI_JUZ->fetch()) {

													echo "<option value=\"" . $row[id] . "\">" . $row[nombre] . "</option>";
												}
												?>
											</select>

										</td>

										<td>

											<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Usurio:</label><br>

										</td>

										<td>

											<select name="listasoli2" id="listasoli2" style="width:200px">

												<option value="" selected="selected"></option>

												<?php
												while ($row = $datos_SOLI_USER->fetch()) {

													echo "<option value=\"" . $row[id] . "\">" . $row[empleado] . "</option>";
												}
												?>
											</select>


										</td>

									</tr>

								<?php } ?>


								<!-- AUDENCIAS -->
								<?php if (in_array($_SESSION['idUsuario'], $usuariosaAUDI2, true)) { ?>

									<tr>

										<?php //if(count($faudi) > 1){ 
										?>


										<td colspan="4">
											<a id="btaudi" href="/laborales/audiencias/index.php"><img src="views/images/audi.png" width="30" height="30" title="AGENDA AUDIENCIAS" />AGENDA AUDIENCIAS</a>

											<!-- <marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="150" height="20">ALERTA</marquee> -->

											<a id="btFILTROAUDI" href="javascript:void(0);"><img src="views/images/filtro.png" width="30" height="30" title="FILTRO AGENDA AUDIENCIAS" />FILTRO AGENDA AUDIENCIAS</a>
										</td>

										<?php //} else{
										?>

										<!-- <td colspan="4">
						<a id="btterminos" href="javascript:void(0);"><img src="views/images/noterminos.png" width="40" height="40" title="TERMINOS"/>NO EXISTEN VENCIMIENTO DE TERMINOS</a> 
					</td>  -->

										<?php //} 
										?>


									</tr>

								<?php } ?>

								<!-- TERMINOS -->
								<?php if (in_array($_SESSION['idUsuario'], $usuariosaVT2, true)) { /*if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==4){*/ ?>
									<tr>

										<?php if (count($fdatos) > 1) { ?>


											<td colspan="4">
												<a id="btterminos" href="javascript:void(0);"><img src="views/images/terminos.jpg" width="30" height="30" title="TERMINOS" />VENCIMIENTO DE TERMINOS</a>

												<marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="150" height="20">ALERTA</marquee>
											</td>

										<?php } else { ?>

											<!-- <td colspan="4">
						<a id="btterminos" href="javascript:void(0);"><img src="views/images/noterminos.png" width="40" height="40" title="TERMINOS"/>NO EXISTEN VENCIMIENTO DE TERMINOS</a> 
					</td>  -->

										<?php } ?>


									</tr>


									<tr id="filaterminos">

										<td colspan="4">

											<!-- <br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Termino</label><br>
				<input name="fechater" id="fechater" type="text" readonly="true" size="15"> -->


											<table border="0" align="center" rules="rows" id="tablaconsulta">


												<tr>

													<td>

														<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_tramite_interno">

															<thead>
																<tr>
																	<th bgcolor="#CDE3F9" colspan="9">
																		<center>
																			<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
																		</center>
																	</th>
																</tr>
																<tr>
																	<th>ID</th>
																	<th>RADICADO</th>
																	<th>FECHA TERMINO</th>
																	<th>OBSERVACION</th>
																	<th>REVISADO</th>

																	<th>

																		<a class="marcar" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos" /></a>
																	</th>

																	<th>

																		<a class="desmarcar" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos" /></a>
																	</th>

																	<th>

																		<a class="revisartodo" href="javascript:void(0);" title="Revisar Todo"><img src="views/images/apply_f2.png" width="20" height="20" title="Revisar Todo" /></a>
																	</th>

																	<th><a class="generarexcel" href="javascript:void(0);"><img src="views/images/excel.jpg" width="35" height="35" title="GENERAR EXCEL" /></a></th>
																</tr>
															</thead>

															<tbody>

																<?php $Ci = 1;
																while ($row = $datosproceso->fetch()) { ?>


																	<tr>
																		<td><?php echo $row[id]; ?></td>
																		<td><?php echo $row[radicado]; ?></td>
																		<td><?php echo $row[fecha_terminos]; ?></td>
																		<td><?php echo $row[observacion_termino]; ?></td>
																		<td><?php echo $row[termino_revisado]; ?></td>

																		<?php if ($row[termino_revisado] == "SI") { ?>

																			<td>-</td>
																			<td>-</td>
																			<td>-</td>
																			<td>-</td>

																		<?php } else { ?>



																			<td>
																				<input type="checkbox" name="<?php echo "chk" . $Ci; ?>" id="<?php echo "chk" . $Ci; ?>" value="<?php echo "chk" . $Ci; ?>" title="<?php echo "chk" . $Ci; ?>" />
																			</td>

																			<td>-</td>
																			<td>-</td>

																			<td><a class="vtrevisado" href="javascript:void(0);" data-id="<?php echo $row['id']; ?>" data-radicado="<?php echo $row['radicado']; ?>"><img src="views/images/revi1.jpg" width="35" height="35" title="REVISADO" /></a></td>
																		<?php } ?>

																	</tr>

																<?php $Ci = $Ci + 1;
																} ?>

															</tbody>
														</table>

													</td>
												</tr>


											</table>



										</td>


									</tr>





								<?php } ?>





								<!-- Visualizar Remate Sin Aprobar -->

								<?php if (in_array($_SESSION['idUsuario'], $usuariosaVR2, true)) { /*if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4){*/ ?>

									<?php if ($cantregisrema >= 1) { ?>

										<tr>

											<td colspan="4">

												<a id="btREMASA" href="javascript:void(0);"><img src="views/images/rema3.jpg" width="35" height="35" title="ALERTA AVISOS DE REMATES DISPONIBLES PARA APROBAR" />ALERTA AVISOS DE REMATES DISPONIBLES PARA APROBAR</a>

												<!-- <marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="450" height="20">ALERTA VISUALIZAR REMATE SIN APROBAR, CANTIDAD: <?php //echo $cantregisrema; 
																																																				?></marquee> -->


											</td>



										</tr>

									<?php } else { ?>


										<tr>

											<td colspan="4">

												<a id="btREMASA" href="javascript:void(0);"><img src="views/images/rema3.jpg" width="35" height="35" title="CONSULTAR AVISOS DE REMATES APROBADOS" />CONSULTAR AVISOS DE REMATES APROBADOS</a>

												<!-- <marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="450" height="20">ALERTA VISUALIZAR REMATE SIN APROBAR, CANTIDAD: <?php //echo $cantregisrema; 
																																																				?></marquee> -->


											</td>



										</tr>



									<?php } ?>


									<!-- FIN Visualizar Remate Sin Aprobar -->


								<?php } ?>











								<!-- EN FIRME PASA A CONTADOR PARA LIQUIDAR -->
								<?php if (in_array($_SESSION['idUsuario'], $usuariosaL2, true)) { /*if($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']==39){*/ ?>
									<tr>

										<?php if (count($ldatos) > 1) { ?>


											<td colspan="4">
												<a id="btliquidacion" href="javascript:void(0);"><img src="views/images/l2.jpg" width="30" height="30" title="PARA LIQUIDACION" />PARA LIQUIDACION</a>

												<marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="150" height="20">ALERTA</marquee>
											</td>

										<?php } else { ?>

											<!-- <td colspan="4">
						<a id="btterminos" href="javascript:void(0);"><img src="views/images/noterminos.png" width="40" height="40" title="TERMINOS"/>NO EXISTEN VENCIMIENTO DE TERMINOS</a>
					</td> -->

										<?php } ?>


									</tr>


									<tr id="filaliquidacion">

										<td colspan="4">

											<!-- <br><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Fecha Termino</label><br>
				<input name="fechater" id="fechater" type="text" readonly="true" size="15"> -->


											<table border="0" align="center" rules="rows" id="tablaconsulta2">


												<tr>

													<td>

														<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar3">

															<thead>
																<tr>
																	<th bgcolor="#CDE3F9" colspan="16">
																		<center>
																			<div id="titulo_frm"><?php echo strtoupper($titulo2); ?></div>
																		</center>
																	</th>
																</tr>
																<tr>
																	<th>ID</th>
																	<th>RADICADO</th>
																	<th>FECHA</th>
																	<th>TRASLADO ART. 110</th>
																	<th><a class="generarexcel2" href="javascript:void(0);"><img src="views/images/excel.jpg" width="35" height="35" title="GENERAR EXCEL" /></a></th>
																</tr>
															</thead>

															<tbody>

																<?php while ($row = $datosLIQUI->fetch()) { ?>


																	<tr>
																		<td><?php echo $row[id]; ?></td>
																		<td><?php echo $row[radicado]; ?></td>
																		<td><?php echo $row[fecha]; ?></td>
																		<td><?php echo $row[observacion]; ?></td>
																		<td></td>


																	</tr>

																<?php } ?>

															</tbody>
														</table>

													</td>
												</tr>


											</table>



										</td>


									</tr>


								<?php } ?>




								<tr>

									<td colspan="4">

										<center>

											<input name="opcion" type="hidden" value="" />
											<input type="button" name="Submit" value="Consultar" id="btn_input" onclick="consultar(frm)">
											<input type="button" name="Submit2" value="Restablecer" id="btn_input" onclick="limpiar(frm)" />

										</center>
									</td>

								</tr>
							</table>
							<p>

								<?php
								$opcion = $_GET['nombre'];
								if ($opcion != 1) {
								?>
									<br />
									<br />
							<div id="titulo_frm" align="center">
								<p>Lista de Ubicaci&oacute;n de Expedientes</p>
							</div>

							<!-- El atributo rules establece qu� lados de los bordes interiores de la tabla son visibles. Los valores posibles son none (ning�n borde), 
all (todos los bordes), rows (los bordes de cada fila), cols (los bordes de cada columna)  -->
							<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">

								<!-- CIERRO ESTE CODIGO PARA INDICAR QUE ASI ESTABA, PERO SI SE DESEA
				USAR JQUERY.DATATABLES SE DEBE QUITAR LOS width DE LOS TITULOS DE LAS COLUMNAS
				Y SE CAMBIA EL NOMBRE DE LA TABLA DE frm_editar A frm_editar1-->

								<!-- <thead>
                    <tr>       
							<th width="66">Fecha</th> 
							<th width="66">Radicado</th>
							<th width="66">C&eacute;dula Demandante</th>
							<th width="66">Demandante</th>
							<th width="66">C&eacute;dula Demandado</th>
							<th width="66">Demandado</th>
							<th width="58">Piso </th>
							<th width="83">Estado</th>
							<th width="120">Juzgado</th>
							<th width="54">Posici&oacute;n</th>
							<th width="54">Fecha Salida</th>
							<th width="54">Juzgado Destino</th>
							 <th width="54">Fecha Devoluci&oacute;n</th>
						<?php //if($_SESSION['tipo_perfil']=='admin'){
						?>
							<th width="96"></th>
							<th width="96"></th>
							<th width="96"><a href="" target="_blank" onclick="prueba(frm)" ><img src="views/images/vertitulos.png" width="30" height="50" alt="Ver T&iacute;tulos" title="Ver T&iacute;tulos"  /></a></th>
						<?php //}
						?>
									  
					</tr>
  				</thead> -->

								<thead>
									<tr>
										<th>Detalle</th>

										<th>-</th>

										<th>Fecha</th>
										<th>Radicado</th>
										<th>C&eacute;dula Demandante</th>
										<th>Demandante</th>
										<th>C&eacute;dula Demandado</th>
										<th>Demandado</th>
										<th>Piso </th>
										<th>Estado</th>
										<th>Juzgado</th>
										<th>Posici&oacute;n</th>
										<th>Fecha Salida</th>
										<th>Juzgado Destino</th>
										<th>Fecha Devoluci&oacute;n</th>
										<?php if ($_SESSION['tipo_perfil'] == 'admin') { ?>
											<th></th>
											<th></th>
											<th><a href="javascript:void(0);" onclick="prueba(frm)"><img src="views/images/vertitulos.png" width="30" height="50" alt="Ver T&iacute;tulos" title="Ver T&iacute;tulos" /></a></th>
											<th><a href="javascript:void(0);" onclick="exportaexceltitulos()"><img src="views/images/exceltitulos.png" width="30" height="40" alt="Exportar a Excel T&iacute;tulos" title="Exportar a Excel T&iacute;tulos" /></a></th>
											<th><a class="generarexcel3" href="javascript:void(0);"><img src="views/images/ventanilla2.jpg" width="40" height="40" title="CONSULTA EN VENTANILLA DE PROCESOS" /></a></th>
											<th><a class="grafica" href="javascript:void(0);"><img src="views/images/grafica.jpg" width="30" height="50" alt="Grafica Procesos" title="Grafica Procesos" /></a></th>
										<?php } ?>
										<!-- <th>Adicionar Observacion</th> -->
									</tr>
								</thead>

								<tbody>


									<?php while ($field = $datos_ubicacion->fetch()) { ?>
										<tr>
											<td class="details-control" data-radicado="<?php echo trim($field[radicado]); ?>"></td>



											<!-- ADICIONADO EL 21 DE ABRIL 2020
							ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS -->
											<?php if ($bandera_entitulos == 1) { ?>

												<?php if ($field[en_titulos] == 1) { ?>

													<td>

														<!-- <a id="btterminos" href="javascript:void(0);"><img src="views/images/terminos.jpg" width="30" height="30" title="TERMINOS"/>VENCIMIENTO DE TERMINOS</a> -->

														<marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="150" height="20" style="color:#FF0000 ">ALERTA PROCESO UBICADO EN ANAQUEL DE TITULOS</marquee>

													</td>

												<?php } else { ?>

													<td>
														-
													</td>

												<?php }  ?>



											<?php } else { ?>

												<td>
													-
												</td>

											<?php } ?>

											<!-- FIN ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS -->


											<td><?php echo $field[fecha]; ?></td>
											<td><?php echo $field[radicado]; ?></td>
											<td><?php echo $field[cedula_demandante]; ?></td>
											<td><?php echo $field[demandante]; ?></td>
											<td><?php echo $field[cedula_demandado]; ?></td>
											<td><?php echo $field[demandado]; ?></td>
											<td><?php echo $field[piso]; ?></td>
											<td><?php echo $field[estado]; ?></td>
											<td><?php echo $field[juzgado]; ?></td>
											<td><?php echo $field[posicion]; ?></td>
											<!-- SE REALIZA ESTE CAMBIO YA QUE SE SOLICITA QUE ALGUNOS PROCESOS, SE LE QUITE LA FECHA
							DE SALIDA POR BASE DE DATOS, PERO AL ACTUALIZAR LA BASE DE DATOS QUEDA UN VALOR 0000-00-00
							Y SI NO SE VALIDA SE PRESENTARA PROBLEMA EN PONER EL BOTON ROJO(SALIDA) Y BOTON VERDE (DEVOLUCION) 
							POR ESO SE CIERRA LA LINEA A CONTINUACION Y SE CREA OTRA VALIDANDO LO COMENTADO-->
											<!-- <td><?php //echo $band= $field[fechasalida];
														?></td>  -->
											<td><?php if ($field[fechasalida] == '' || $field[fechasalida] == '0000-00-00') {
													echo $band = '';
												} else {
													echo $band = $field[fechasalida];
												} ?></td>
											<td><?php echo $field[juzgadodestino]; ?></td>
											<td><span style="cursor:pointer">
													<?php if ($band == '') { ?>
												</span><?php echo $field[fechadevolucion]; ?><span style="cursor:pointer">
												<?php } ?>
												</span></td>
											<?php if ($_SESSION['tipo_perfil'] == 'admin') {


												if ($hayconexion == 0) {

											?>

													<td><span style="cursor:pointer"><img src="views/images/edit.png" alt="" title="Modificar Ubicaci�n" onclick="vinculo1(<?php echo $field[id]; ?>)" /></span></td>

												<?php } else { ?>

													<td><span style="cursor:pointer"><img src="views/images/historial2.png" alt="" title="Modificar Ubicaci�n SIN JXXI" width="30" height="30" onclick="vinculo1_SIN_JXXI(<?php echo $field[id]; ?>)" /></span></td>

												<?php } ?>

												<?php if ($_SESSION['idUsuario'] != 29) { ?>

													<td><span style="cursor:pointer"><?php if ($band == '') { ?><img src="views/images/salir.png" width="30" alt="" title="Registrar Salida" onclick="vinculoSalida(<?php echo $field[id]; ?>)" /><?php } ?></span></td>
													<td><span style="cursor:pointer">
															<?php if ($band != '') { ?>
																<img src="views/images/devolver.png" width="30" alt="" title="Registrar Devoluci&oacute;n" onclick="vinculoDevolucion(<?php echo $field[id]; ?>)" />
															<?php } ?>
														</span></td>
													<td><span style="cursor:pointer"><img src="views/images/add_memo.png" alt="" width="30" height="30" title="Adicionar Memorial" onclick="vinculoMemorial(<?php echo $field[id]; ?>)" /></span></td>

												<?php } ?>

											<?php } ?>

											<td></td>
											<td></td>
											<!-- <td><a name="<?php //echo "nuevaOBS".$Co;
																?>" id="<?php //echo "nuevaOBS".$Co;
																		?>" title="<?php //echo "nuevaOBS".$Co;
																					?>" onclick="Obtener_Fila_Tabla(this.parentNode.parentNode.rowIndex)" href="javascript:void(0);" data-radicado_obs="<?php //echo trim($field[radicado]);
																																																									?>"><img src="views/images/nuevaobs.png" width="30" height="30"/></a> </td> -->

											<!-- <td><a id="nuevaOBS" name="nuevaOBS" href="javascript:void(0);" data-radicado_obs="<?php //echo trim($field[radicado]);
																																	?>"><img src="views/images/nuevaobs.png" width="30" height="30"/></a></td> -->

											<!-- <td><img id="nuevaOBS" name="nuevaOBS" src="views/images/nuevaobs.png" width="30" height="30" data-radicado_obs="<?php //echo trim($field[radicado]);
																																									?>"/></td> -->

											<!-- <td><span style="cursor:pointer"><img src="views/images/new3.jpg" width="30" height="30" alt="" title="Adicionar Observacion" onclick="Adicionar_Observacion(<?php //echo $field[id];
																																																				?>)"/></span></td> -->



										</tr>


									<?php } ?>
								</tbody>
							</table>

						<?php } ?>
						<?php
						$opcion = $_GET['nombre'];
						if ($opcion == 1) {
						?>
							<br />
							<br />
							<div id="titulo_frm" align="center">
								<p>Lista de Ubicaci&oacute;n de Expedientes</p>
							</div>

							<!-- El atributo rules establece qu� lados de los bordes interiores de la tabla son visibles. Los valores posibles son none (ning�n borde), 
all (todos los bordes), rows (los bordes de cada fila), cols (los bordes de cada columna)  -->
							<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar2">

								<!-- CIERRO ESTE CODIGO PARA INDICAR QUE ASI ESTABA, PERO SI SE DESEA
				USAR JQUERY.DATATABLES SE DEBE QUITAR LOS width DE LOS TITULOS DE LAS COLUMNAS
				Y SE CAMBIA EL NOMBRE DE LA TABLA DE frm_editar A frm_editar2-->

								<!-- <thead>
                    <tr>     
     
							<th width="66">Fecha</th>
							<th width="58">Radicado </th>
							<th width="66">C&eacute;dula Demandante</th>
							<th width="66">Demandante</th>
							<th width="66">C&eacute;dula Demandado</th>
							<th width="66">Demandado</th>
							<th width="58">Piso</th>
							<th width="83">Estado</th>
							<th width="120">Juzgado</th>
							<th width="54">Posici&oacute;n</th>
							<th width="54">Fecha Salida</th>
							<th width="54">Juzgado Destino</th>
							<th width="54">Fecha Devoluci&oacute;n</th>
							<th width="96"><img src="views/images/reparto.jpg" width="30" height="30" alt="Reparto" title="Reparto" onclick="vinculoExcelReparto(<?php echo $field[idubi]; ?>)" /></th>
							<th width="120"><img src="views/images/excel.jpg" width="30" height="30" alt="Exportar Excel" title="Exportar Excel" onclick="vinculoExcel(<?php echo $field[idubi]; ?>)" /></th>
						   <?php //$id = $field[idubi]; { 
							?>
							<th width="96"><img src="views/images/vertitulos.png" width="30" height="50" alt="Ver T�tulos" title="Ver T�tulos" onclick="prueba(frm)"  /></th>
						  <?php //}
							?>
					</tr>
  				</thead> -->

								<thead>
									<tr>

										<th>Detalle</th>


										<th>-</th>

										<th style="color:#3399CC">Fecha</th>
										<th style="color:#3399CC">Radicado </th>
										<th style="color:#3399CC">C&eacute;dula Demandante</th>
										<th style="color:#3399CC">Demandante</th>
										<th style="color:#3399CC">C&eacute;dula Demandado</th>
										<th style="color:#3399CC">Demandado</th>
										<th style="color:#3399CC">Piso</th>
										<th style="color:#3399CC">Estado</th>
										<th style="color:#3399CC">Juzgado</th>
										<th style="color:#3399CC">Posici&oacute;n</th>
										<th style="color:#3399CC">Fecha Salida</th>
										<th style="color:#3399CC">Juzgado Destino</th>
										<th style="color:#3399CC">Fecha Devoluci&oacute;n</th>
										<th><img src="views/images/reparto.jpg" width="30" height="30" alt="Reparto" title="Reparto" onclick="vinculoExcelReparto(<?php echo $field[idubi]; ?>)" /></th>
										<th><img src="views/images/excel.jpg" width="30" height="30" alt="Exportar Excel" title="Exportar Excel" onclick="vinculoExcel(<?php echo $field[idubi]; ?>)" /></th>
										<th><img src="views/images/listatramite.png" width="30" height="30" alt="Generar Excel Tramite Interno" title="Generar Excel Tramite Interno" onclick="Reporte_Excel(1)" /></th>
										<?php $id = $field[idubi]; { ?>
											<th><img src="views/images/vertitulos.png" width="30" height="50" alt="Ver T�tulos" title="Ver T�tulos" onclick="prueba(frm)" /></th>
											<th><img src="views/images/exceltitulos.png" width="30" height="40" alt="Ver T�tulos" title="Exportar a Excel T&iacute;tulos" onclick="exportaexceltitulos()" /></th>
											<!-- <th></th> -->
										<?php } ?>
										<th><img src="views/images/toggle_f3.png" width="30" height="30" alt="Exportar Excel" title="Exportar Excel Detalle Observaciones" onclick="vinculoExcelDetalleObservaciones(<?php echo $field[idubi]; ?>)" /></th>
										<th><a class="generarexcel3" href="javascript:void(0);"><img src="views/images/ventanilla2.jpg" width="40" height="40" title="CONSULTA EN VENTANILLA DE PROCESOS" /></a></th>

										<!-- <th>Adicionar Observacion</th> -->
									</tr>
								</thead>


								<tbody>


									<?php while ($field = $datos_ubicacion->fetch()) {

										if ($pertenece_juzgado_x > 0) {

											if ($field[idjuzgado_reparto] != $pertenece_juzgado_x) {

												echo '<script languaje="JavaScript">
								
										var usuario_juzgado ="' . $pertenece_juzgado_x . '";
				
										alert("NO ES POSIBLE LA BUSQUEDAD, EL PROCESO O ALGUNOS PROCESOS PERTENCEN A UN JUZGADO DIFERENTE DEL USUARIO EN SESION, JUZGADO USUARIO: "+usuario_juzgado);
										
										location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
									
									</script>';
											}
										}

									?>
										<tr>
											<td class="details-control" data-radicado="<?php echo trim($field[radicado]); ?>"></td>

											<!-- ADICIONADO EL 21 DE ABRIL 2020
							ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS -->
											<?php if ($bandera_entitulos == 1) { ?>

												<?php if ($field[en_titulos] == 1) { ?>

													<td>

														<!-- <a id="btterminos" href="javascript:void(0);"><img src="views/images/terminos.jpg" width="30" height="30" title="TERMINOS"/>VENCIMIENTO DE TERMINOS</a> -->


														<marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="175" height="20" style="color:#FF0000 ">ALERTA PROCESO UBICADO</marquee><br>
														<marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="164" height="20" style="color:#FF0000 ">EN ANAQUEL DE TITULOS</marquee>

													</td>

												<?php } else { ?>

													<td>
														-
													</td>

												<?php }  ?>



											<?php } else { ?>

												<td>
													-
												</td>

											<?php } ?>

											<!-- FIN ID USUARIOS QUE PUEDEN VISUALIZAR ALERTA DE EN TITULOS -->

											<td><?php echo $field[fecha]; ?></td>
											<td><?php echo $field[radicado]; ?></td>
											<td><?php echo $field[cedula_demandante]; ?></td>
											<td><?php echo $field[demandante]; ?></td>
											<td><?php echo $field[cedula_demandado]; ?></td>
											<td><?php echo $field[demandado]; ?></td>
											<td><?php echo $field[piso]; ?></td>
											<td><?php echo $field[estados]; ?></td>
											<td><?php echo $field[juzgado]; ?></td>
											<td><?php echo $field[posicion]; ?></td>
											<!-- SE REALIZA ESTE CAMBIO YA QUE SE SOLICITA QUE ALGUNOS PROCESOS, SE LE QUITE LA FECHA
							DE SALIDA POR BASE DE DATOS, PERO AL ACTUALIZAR LA BASE DE DATOS QUEDA UN VALOR 0000-00-00
							Y SI NO SE VALIDA SE PRESENTARA PROBLEMA EN PONER EL BOTON ROJO(SALIDA) Y BOTON VERDE (DEVOLUCION) 
							POR ESO SE CIERRA LA LINEA A CONTINUACION Y SE CREA OTRA VALIDANDO LO COMENTADO-->
											<!-- <td><?php //echo $band= $field[fechasalida];
														?></td>  -->
											<td><?php if ($field[fechasalida] == '' || $field[fechasalida] == '0000-00-00') {
													echo $band = '';
												} else {
													echo $band = $field[fechasalida];
												} ?></td>
											<td><?php echo $field[juzgadodestino]; ?></td>
											<td><span style="cursor:pointer">
													<?php if ($band == '') { ?>
												</span><?php echo $field[fechadevolucion]; ?><span style="cursor:pointer">
												<?php } ?>
												</span></td>
											<?php if ($_SESSION['tipo_perfil'] == 'admin') {


												if ($hayconexion == 0) {

											?>

													<td><span style="cursor:pointer"><img src="views/images/edit.png" alt="" title="Modificar Ubicaci�n" onclick="vinculo1(<?php echo $field[idubi]; ?>)" /></span></td>

												<?php } else { ?>

													<td><span style="cursor:pointer"><img src="views/images/historial2.png" alt="" title="Modificar Ubicaci�n SIN JXXI" width="30" height="30" onclick="vinculo1_SIN_JXXI(<?php echo $field[idubi]; ?>)" /></span></td>

												<?php } ?>

												<?php if ($_SESSION['idUsuario'] != 29) { ?>

													<td><span style="cursor:pointer"><?php if ($band == '') { ?><img src="views/images/salir.png" width="30" alt="" title="Registrar Salida" onclick="vinculoSalida(<?php echo $field[idubi]; ?>)" /><?php } ?></span></td>
													<td><span style="cursor:pointer">
															<?php if ($band != '') { ?>
																<img src="views/images/devolver.png" width="30" alt="" title="Registrar Devoluci&oacute;n" onclick="vinculoDevolucion(<?php echo $field[idubi]; ?>)" />
															<?php } ?>
														</span></td>
													<td><span style="cursor:pointer">

															<?php if (($_SESSION['idUsuario'] == 3 || $_SESSION['idUsuario'] == 28 || $_SESSION['idUsuario'] == 10 || $_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 5 || $_SESSION['idUsuario'] == 36  || $_SESSION['idUsuario'] == 39 || $_SESSION['idUsuario'] == 44 || $_SESSION['idUsuario'] == 51)) { ?> <img src="views/images/caja.png" width="30" alt="javascript:window.open('popup>','',widht=120,height=180)" title="Registrar T&iacute;tulo" onclick="vinculoTitulos(<?php echo $field[idubi]; ?>)" /> <?php } ?>

														</span></td>

												<?php } ?>

												<?php if ($_SESSION['idUsuario'] != 29) { ?>

													<td><span style="cursor:pointer"><img src="views/images/add_memo.png" alt="" width="30" height="30" title="Adicionar Memorial" onclick="vinculoMemorial(<?php echo $field[idubi]; ?>)" /></span></td>

												<?php } ?>

												<td></td>
												<td></td>

												<!-- <td><span style="cursor:pointer"><img src="views/images/new3.jpg" width="30" height="30" alt="" title="Adicionar Observacion" onclick="Adicionar_Observacion(<?php //echo $field[idubi];
																																																					?>)"/></span></td> -->
										</tr>

									<?php } ?>

								<?php } ?>

								</tbody>

							</table>

						<?php } ?>



						</form>
						<!-- </div>	 -->
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
			</table>
			<?php require 'alertas.php'; ?>

			<?php

			//MUESTRO LOS PRCESOS QUE TIENEN VENCIDO OS TERMINOS
			/*echo '<script languaje="JavaScript"> 
									
				var dat_3 = "'.$fecha_terminos.'";
				
				Vence_Termino_Lista(dat_3);
				
	
		</script>';*/



			if (trim($_GET['msgaudi']) == 1) {

				echo '<script languaje="JavaScript"> 
									
				
				
				cargar_form_audi();
				
				
	
			  </script>';
			}



			?>


</body>

</html>