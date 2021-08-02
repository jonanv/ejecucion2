<?php 
	
	//echo $_SESSION['id'];
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "LISTA ESTADO INCIDENTES DESACATO EN SALUD";
	$subtitulo  = "Carpetas";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new archivoModel();
	
	$idusuario  = $_SESSION['idUsuario'];
	
	
	$datos_lista_incidentes = $modelo->get_lista_incidentes(1);
	
	$ip_plataforma = trim($_SESSION['ipplataforma']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
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

<script src="views/js/ajax/ajax_filtro_ubicacion.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ > 
<link rel="stylesheet" type="text/css" href="views/viewstablas/jquery.dataTables.css"/>


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

	<!-- TABLA id:frm_editar2-->
	/*$('#frm_incidentes').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null]
		
	} );*/
	
	
	var table = $('#frm_incidentes').DataTable( {
					'sPaginationType': 'full_numbers', 
					
					
					
					"language": {
								"sProcessing":     "Procesando...",
								"sLengthMenu":     "Mostrar _MENU_ registros",
								"sZeroRecords":    "No se encontraron resultados",
								"sEmptyTable":     "Ningún dato disponible en esta tabla",
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
									"sLast":     "Último",
									"sNext":     "Siguiente",
									"sPrevious": "Anterior"
								},
								"oAria": {
									"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
									"sSortDescending": ": Activar para ordenar la columna de manera descendente"
								}
					}
					
					
					
					
					
				} );
	
	
	var ip_servidor = "<?php echo $ip_plataforma; ?>";
	
	//var servidor   = "http://190.217.24.24/";
	var servidor   = "http://"+ip_servidor+"/";
	//var plataforma = '/wamp/www/ejecucion/INCIDENTESALUD/';
	var plataforma = 'ejecucion/';
	
	
	//ME PERMITE GENERAR INCIDENTE
	$('.generar_pdf').click(function(evento){
			
		var id_ruta = $(this).attr('data-id_ruta');
				
		//window.open("http://"+ipservidor+"/ejecucion/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
		window.open("http://"+servidor+plataforma+id_ruta);
				
	});
	
	
	
});
</script>	



<style type="text/css" media="screen">

.demo
{
	width: 800px;
	height: 400px;
	border-top: solid 1px #BBB;
	border-left: solid 1px #BBB;
	border-bottom: solid 1px #FFF;
	border-right: solid 1px #FFF;
	background: #FFF;
	overflow: scroll;
	padding: 5px;
}

</style>

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_archivo.php';
		
	?>			

	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
						
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
				
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						

							<tr>
					
								<td>
								
									<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_incidentes">
													
												<thead> 
													
													
													<tr> 
														<th style="font-size:11px">N</th>
														<th style="font-size:11px">ID</th>
														<th style="font-size:11px">FECHA REGISTRO</th>
														<th style="font-size:11px">RADICADO</th>
														<th style="font-size:11px">PETECIONARIO</th>
														<th style="font-size:11px">TELEFONO</th>
														<th style="font-size:11px">CLASE</th>
														<th style="font-size:11px">SUBCLASE</th>
														<th style="font-size:11px">EPS</th>
														<th style="font-size:11px">ESTADO</th>
														<th style="font-size:11px">OBS</th>
														<th style="font-size:11px">INCIDENTE</th>
														<!-- <th style="font-size:11px"></th> -->
														
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php 
													
														$num = 1;
														
														while($row = $datos_lista_incidentes->fetch()){ 
													
													?>
								
															<tr>
															
																<td style="font-size:11px">
																	<?php echo $num;?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[id];?>
																</td>
																
																<td style="font-size:10px">
																	<?php echo $row[fecha_registro];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[radicado];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[peticionario];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[telefono];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[clase];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[subclase];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[eps];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[est_titulo];?>
																</td>
																
																<td style="font-size:11px">
																	<?php echo $row[sal_observaciones];?>
																</td>
																
																<?php
																if(is_null($row[ruta_local])){?>
																	
																	<td></td>
																	
																<?php	
																}
																else{
																?>
																	<td>
																		<a href="<?php echo $row['ruta_local'];?>" title="<?php echo $row['ruta_local'];?>" target="_blank"><img src="views/images/pdf-icono.png" width="35" height="35"/></a>
																	</td>
																<?php	
																}
																?>
																
															</tr>
												
													<?php $num = $num + 1;} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
							
						</table>
					
					</form>
			
				</div>
				
			</td>
		</tr>
	
	</table>
	
	
		
<?php require 'alertas.php';?>
</body>
</html>




	
