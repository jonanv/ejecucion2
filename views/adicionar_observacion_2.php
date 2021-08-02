<?php 
session_start(); 

if($_SESSION['id']!=""){

$idusuario  = $_SESSION['idUsuario'];

//include_once('Funciones.php');
//include_once( "../../../Funciones.php" );
include_once( "views/popupbox/Funciones.php" );
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$valorradicado = trim($_GET['radicado_obs']);
//$id_radicado   = $funcion->get_idradicado_X($valorradicado);

//echo $id_radicado." / ".$valorradicado;

//echo $valorradicado;

$fecha_actual = $funcion->get_fecha_actual();

//echo $fecha_actual;

//$id_obs_maximo = $funcion->get_maximo_obs_proceso($valorradicado);

?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8"/> 
	
	<!-- <link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<title>Adicionar Observacion</title>
	
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css">  -->
	<link rel="stylesheet" type="text/css" href="views/viewstablas/jquery.dataTables.min.css"> 
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> -->
	<link rel="stylesheet" type="text/css" href="views/viewstablas/buttons.dataTables.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.6/css/select.dataTables.min.css"> --> 
	<link rel="stylesheet" type="text/css" href="views/viewstablas/select.dataTables.min.css"> 
	
	
	<link rel="stylesheet" type="text/css" href="views/viewstablas/Data_table_2/css/editor.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="views/viewstablas/Data_table_2/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="views/viewstablas/Data_table_2/examples/resources/demo.css"> 
	
	
	<style type="text/css" class="init">
	
	</style>
	
	<!-- <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
	<script type="text/javascript" language="javascript" src="views/viewstablas/jquery-3.3.1.js"></script>
	<!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script> --> 
	<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.min.js"></script> 
	<!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> -->	
	<script type="text/javascript" language="javascript" src="views/viewstablas/dataTables.buttons.min.js"></script>	
	<!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>  -->
	<script type="text/javascript" language="javascript" src="views/viewstablas/dataTables.select.min.js"></script>
	<!-- <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
	<script type="text/javascript" language="javascript" src="views/viewstablas/moment.min.js"></script>
	
	<!-- ME PERMITE EXPORTAR LA INFORMAFION DE LA TABLA EN EXCEL,CSV,PDF, IMPRIMIRLA -->
	<!-- <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->
	
	
	<script type="text/javascript" language="javascript" src="views/viewstablas/Data_table_2/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" src="views/viewstablas/Data_table_2/examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="views/viewstablas/Data_table_2/examples/resources/demo.js"></script>
	<script type="text/javascript" language="javascript" src="views/viewstablas/Data_table_2/examples/resources/editor-demo.js"></script> 
	
	
	<script type="text/javascript" language="javascript" class="init">
	
		//---------------------------------------------------------------

		//PASOMOS VARIABLES PHP A JAVASCRIPT
		
		//INDICA CUALES OBSERVACIONES DE UN RADICADO
		//ESPECIFICO DEBE CARGAR
		var dato_radicado = "<?php echo $valorradicado; ?>";
		
		var idusuario     = "<?php echo $idusuario; ?>";
		var fecha_actual  = "<?php echo $fecha_actual; ?>";
		var id_obs_maximo = "<?php echo $id_obs_maximo; ?>";
		//---------------------------------------------------------------
		
		var editor; // use a global for the submit and return data rendering in the examples
		
		$(document).ready(function() {
		
			
			editor = new $.fn.dataTable.Editor( {
				//ajax: "../php/obs_procesos.php",
				ajax: "views/viewstablas/Data_table_2/examples/php/obs_procesos.php?dato_radicado="+dato_radicado,
				table: "#example",
				//IDIOMA FORMULARIO
				i18n: {
					create: {
						button: "Adicionar Observacion",
						title:  "Adicionar Observacion",
						submit: "Adicionar Observacion"
					}
				},
				//AUTONUMERICO DE LA TABLA EN CUESTION PARA EDITAR SUS VALORES
				//idSrc:  'id',
				fields: [ /*{
						label: "Idobs:",
						name:  "id",
						def:   id_obs_maximo,
						type:  'readonly'
						
					},*/{
						label: "Id Radicado:",
						name:  "idcorrespondencia",
						//VALOR POR DEFECTO, EN ESTE CASO  $valorradicado = trim($_GET['radicado_obs']); 
						//PASADO A JAVASCRIPT EN dato_radicado
						//DEFINICION TECNICA: Valor predeterminado para el campo a tomar
						def: dato_radicado,
						//type: 'readonly'
						type: 'hidden'
					},{
						//label: "Fecha:",
						//name: "fecha",
						//type: "datetime"
						
						label: 'Fecha:',
						name:  'fecha',
						type:  'readonly',
						def:   fecha_actual	
						//type: 'readonly',
						//type: 'hidden',
						//def:       function () { return new Date(); },
						//format:    'YYYY-MM-DD h:mm A' //2018-07-04 9:20 AM
						//fieldInfo: 'US style y-m-d date input with 12 hour clock'
						
						
						
						
						
					}, {
						label: "Observacion:",
						name:  "observacion",
						type:  'textarea'
					},{
						label: "Idusuario:",
						name: "idusuario",
						def:   idusuario,
						//type: 'readonly'
						type: 'hidden'
					}
				]
			} );
			
			
		
			//DE ESTA FORMA CUALQUIER CAMPO SE MODIFICA	
			// Activate the bubble editor on click of a table cell
			/*$('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
				editor.bubble( this );
			} );*/
			
			//DE ESTA FORMA SOLO LOS QUE UNO SELECCIONE CON INDEX 
			//SE MODIFICAN
			/*$('#example').on( 'click', 'tbody td', function (e) {
				var index = $(this).index();
		 
				 if ( index === 3 ) {
					editor.bubble( this, {
						title: 'Edit FECHA:',
						message: 'Date must be given in the format `yyyy-mm-dd`'
					} );
				}
				
				if ( index === 4 ) {
					editor.bubble( this, {
						title: 'Edit OBS:'
					} );
				}
			} );*/
			
			
			//alert(dato_radicado);
			
			
			$('#example').DataTable( {
			
				dom: "Bfrtip",
				scrollY: 300,
				paging: true,
				//ajax: "../php/staff.php",
				//ajax: "views/viewstablas/Data_table_2/examples/php/obs_procesos.php",
				ajax: "funciones/traer_datos_detalle_proceso_2.php?dato_radicado="+dato_radicado,
				columns: [
					{
						data: null,
						defaultContent: '',
						//className: 'select-checkbox',
						orderable: false
					},
					//{ data: "id" },
					{ data: "idcorrespondencia", "targets": [ 1 ], "visible": false,"searchable": false},//OCULTAR COLUMNA
					//{ data: "radicado" },
					{ data: "fecha" },
					{ data: "observacion" },
					{ data: "idusuario", "targets": [ 4 ], "visible": false,"searchable": false }//OCULTAR COLUMNA
					//{ data: "empleado" }
				],
				//SE ORDENA POR LE COLUMNA FECHA, QUE ES LA NUMERO 2 EN LA TABLA
				//YA QUE LA COLUMNA ID NO ESTA Y ES AUTONUMERICA
				order: [ 2, 'desc' ],
				
				//os Estilo de sistema operativo ( ): cuando un solo clic selecciona un solo elemento, anula la selecci�n de los dem�s que fueron seleccionados previamente, 
				//un clic de desplazamiento seleccionar� un rango de elementos y un clic de ctrl / cmd agregar� y eliminar� elementos de la selecci�n.
				
				//Selecci�n de single un solo elemento ( ): solo se puede seleccionar un �nico elemento en cualquier momento. 
				//Todos los elementos previamente seleccionados ser�n deseleccionados.
				
				//Selecci�n de m�ltiples elementos ( multi): la selecci�n de elementos se alterna con un solo clic.
				
				select: {
					style:    'os',
					selector: 'td:first-child'//Permitir selecci�n en la primera columna solamente
				},
				buttons: [
					{ extend: "create", editor: editor, text:'<img src="views/images/new3.jpg" width="30" height="30"/>',titleAttr: 'Adicionar Observacion' },
					//{ extend: "edit",   editor: editor },
					//{ extend: "remove", editor: editor }
					
					//ME PERMITE EXPORTAR LA INFORMAFION DE LA TABLA EN EXCEL,CSV,PDF, IMPRIMIRLA
					/*{
						extend: 'collection',
						text: 'Export',
						buttons: [
							'copy',
							'excel',
							'csv',
							'pdf',
							'print'
						]
					}*/
					
				],
				
				//IDIOMA TABLA
				
				//TAMBIEN FUNCIONA
				/*"language": {
								"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
				}*/
				
				"language": {
								"sProcessing":     "Procesando...",
								"sLengthMenu":     "Mostrar _MENU_ registros",
								"sZeroRecords":    "No se encontraron resultados",
								"sEmptyTable":     "Ning�n dato disponible en esta tabla",
								"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
								"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
								"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
								"sInfoPostFix":    "",
								"sSearch":         "Buscar:",
								"sUrl":            "",
								"sInfoThousands":  ",",
								"sLoadingRecords": "Cargando...",
								"oPaginate": {
									"sFirst":    "Primero",
									"sLast":     "�ltimo",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								},
								"oAria": {
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
								}
				}
				
				
			} );
		} );

		
		function encode(s){
		
			for(var c, i = -1, l = (s = s.split("")).length, o = String.fromCharCode; ++i < l;
				s[i] = (c = s[i].charCodeAt(0)) >= 127 ? o(0xc0 | (c >>> 6)) + o(0x80 | (c & 0x3f)) : s[i]
			);
			
			return s.join("");

		
		}
		
		function decode(s){
		
			for(var a, b, i = -1, l = (s = s.split("")).length, o = String.fromCharCode, c = "charCodeAt"; ++i < l;
				((a = s[i][c](0)) & 0x80) &&
				(s[i] = (a & 0xfc) == 0xc0 && ((b = s[i + 1][c](0)) & 0xc0) == 0x80 ?
				o(((a & 0x03) << 6) + (b & 0x3f)) : o(128), s[++i] = "")
			);
			
			return s.join("");	
		
		}	
			
			
			

	</script>
	
</head>
<body class="dt-example">
	
			<table id="example" class="display" cellspacing="0" width="100%">
				<thead>
				
					
					<tr>
						<th></th> 
						<!-- <th>Idobs</th> -->
						<th>IdRadicado</th>
						<!-- <th>Radicado</th> -->
						<th>Fecha</th>
						<th>Observacion</th>
						<th>Idusuario</th>
						<!-- <th>Usuario</th> -->
						
					</tr>
				</thead>
			</table>
			
</body>
</html>  

<?php } ?>