<script src="ajax.js" type="text/javascript" charset="utf-8"></script>

<!-- para que funcione esta linea se define en el layaout las librerias correspondientes -->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		//$('#example').dataTable();

		$('#example').dataTable({
			'sPaginationType': 'full_numbers'
		});


	});
</script>

<?php
session_start();

if ($_SESSION['id'] == "") {
	header("refresh: 0; URL=/laborales/");
} else {

?>

	<div class="bar">
		<!-- esta es la forma original al defininir class = "button" toma el dise�o de esta clase -->
		<!--  <a id="new" class="button" href="javascript:void(0);" title="Nuevo Evento">Nuevo Evento</a> -->

		<a id="new" href="javascript:void(0);" title="Nuevo Reparto">
			<img src="/laborales/repartomasivo/imagenes/add.png" width="30" height="30" title="Nuevo Reparto" />
		</a>

		<label>Filtro</label>
		<input type="text" name="filtro_buscar" id="filtro_buscar" size="25" />

		<label>Fecha Desde</label>
		<input name="fechad" id="fechad" type="text" readonly="true" size="8">

		<label>Fecha Hasta</label>
		<input name="fechah" id="fechah" type="text" readonly="true" size="8">

		<a class="filtro_buscar" href="javascript:void(0);">
			<img src="/laborales/repartomasivo/imagenes/filtro.jpg" width="30" height="30" title="Filtrar" />
		</a>

		<a href="javascript:void(0);" onclick="Reporte_Excel_Reparto()">
			<img src="/laborales/repartomasivo/imagenes/excel1.jpg" width="30" height="30" title="Generar Excel" style="float:none" />
		</a>

		<a class="recargar" href="javascript:void(0);">
			<img src="/laborales/repartomasivo/imagenes/reload_f2.png" width="30" height="30" title="Recargar" style="float:none" />
		</a>

		<!-- FUNCIONA FORMA JQUERY ES MAS RAPIDO PERO NO ME FILTRA, USA EL ARCHIVO functions.js-->
		<!-- <a class="btnExport" href="javascript:void(0);"><img src="/ejecucionprueba/eventos/imagenes/excel2.png" width="30" height="30" title="Generar Excel"/></a> -->

		<!-- FUNCIONA COMO GENERO REPORTES EN JOOMLA, USA LA CARPETA Reporte_Excel, USA EL ARCHIVO ajax.js -->
		<!-- <a href="javascript:void(0);" onclick="Listar_Reporte(1)"><img src="/ejecucionprueba/eventos/imagenes/excel2.png" width="30" height="30" title="Generar Excel"/></a> -->


		<a href="/laborales/index.php?controller=menu&action=mod_archivo">
			<img src="/laborales/repartomasivo/imagenes/back_f2.png" width="30" height="30" title="Regresar" style="float:right" />
		</a>

	</div>

	<?php
	//INFORMACION NECESARIA PARA CREAR UN REGISTRO EN LA TABLA log
	date_default_timezone_set('America/Bogota');

	$fechaa = date('Y-m-d g:ia');

	$horaa = explode(' ', $fechaa);

	$fechal = $horaa[0];

	$hora = $horaa[1];

	$accion = 'Eliminar Evento';

	$detalle = $_SESSION['nombre'] . " " . $accion . $fechal . " " . "a las: " . $hora;

	$tipolog = 1;

	?>
	<!-- CAMPO OCULTO EL CUAL ESTA CARGADO CON LOS DATOS ANTERIORES -->
	<input type="hidden" name="datoslog2" id="datoslog2" size="100" maxlength="100" value="<?php print $fechal . "///////" . $accion . "///////" . $detalle . "///////" . $_SESSION['idUsuario'] . "///////" . $tipolog ?>">
	<!-- CON ESTE DIV DEFINIMOS QUE PARTE QUEREMOS EXPORTAR A EXCEL, ES DECIR LA TABLA HTML, EN ESTE MOMENTO NO SE USA ESTA OPCION PARA EXPORTAR A EXCEL, POR QUE EL RADICADO  
SALE DESCONFIGURADO -->
	<div id="dvData">

		<table id="example">
			<thead>
				<tr>
					<th>Id</th>
					<th>Radicado</th>
					<th>Ced Demandante</th>
					<th>Demandante</th>
					<th>Ced Demandado</th>
					<th>Demandado</th>
					<th>Piso</th>
					<th>Estado</th>
					<th>Detalle Estado</th>
					<th>Clase Proceso</th>
					<th>Fecha Reparto</th>
					<th>Juzgado Reparto</th>
					<th>Ponente</th>


					<!-- <th>Editar</th>
            <th>Borrar</th> -->
				</tr>
			</thead>
			<tbody>
				<?php foreach ($view->clientes as $cliente) :  // uso la otra sintaxis de php para templates 
				?>
					<tr>
						<td><?php echo $cliente['id']; ?></td>
						<td><?php echo $cliente['radicado']; ?></td>
						<td><?php echo $cliente['cedula_demandante']; ?></td>
						<td><?php echo htmlentities($cliente['demandante']); ?></td>
						<td><?php echo $cliente['cedula_demandado']; ?></td>
						<td><?php echo htmlentities($cliente['demandado']); ?></td>
						<td><?php echo $cliente['piso']; ?></td>
						<td><?php echo htmlentities($cliente['estado']); ?></td>
						<td><?php echo htmlentities($cliente['detalleestado']); ?></td>
						<td><?php echo htmlentities($cliente['claseproceso']); ?></td>
						<td><?php echo $cliente['fecha_reparto']; ?></td>
						<td><?php echo htmlentities($cliente['juzgadoreparto']); ?></td>
						<td><?php echo $cliente['ponente']; ?></td>

						<!-- <td><a class="edit" href="javascript:void(0);" data-id="<?php //echo $cliente['id'];
																						?>"><img src="/laborales/eventos/imagenes/edit_f2.png" width="20" height="20" title="Editar"/></a></td>
				<td><a class="delete" href="javascript:void(0);" data-id="<?php //echo $cliente['id'];
																			?>"><img src="/laborales/eventos/imagenes/cancel.png" width="20" height="20" title="Borrar"/></a></td> -->
					</tr>
				<?php endforeach; ?>

			</tbody>
		</table>

		<!-- CIERRE DEL DIV PARA EXPORTAR A EXCEL, ES DECIR LA TABLA HTML  -->
	</div>
	<!-------------------------------------------------------------------->

	<div class="bar">
		<!-- <a style="background-color:#fbc2c4;color:brown" class="button" href="http://www.tutorialjquery.com/ejemplo-de-altas-bajas-y-modificaciones-con-php-ajax-y-jquery">Descargar</a> -->
	</div>
	<!-------------------------------------------------------------------->
<?php } ?>