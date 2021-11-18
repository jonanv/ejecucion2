<script src="ajax.js" type="text/javascript" charset="utf-8"></script>

<!-- para que funcione esta linea se define en el layaout las librerias correspondientes -->
<script type="text/javascript" charset="utf-8"> 
	$(document).ready(function() {
		$('#example').dataTable();
	} );
</script> 

<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{

?>

<div class="bar">
	<!-- esta es la forma original al defininir class = "button" toma el diseño de esta clase -->
   <!--  <a id="new" class="button" href="javascript:void(0);" title="Nuevo Evento">Nuevo Evento</a> -->
   
	<a id="new" href="javascript:void(0);" title="Nuevo Evento"><img src="/ejecucion/eventos/imagenes/add.png" width="30" height="30" title="Nuevo Evento"/></a>

	<label>Filtro</label>
	<input type="text" name="filtro_buscar" id="filtro_buscar" size="25"/>
	
	<label>Fecha Desde</label>
	<input name="fechad" id="fechad" type="text" readonly="true" size="8">
	
	<label>Fecha Hasta</label>
	<input name="fechah" id="fechah" type="text" readonly="true" size="8">
	
	<a class="filtro_buscar" href="javascript:void(0);"><img src="/ejecucion/eventos/imagenes/filtro.jpg" width="30" height="30" title="Filtrar"/></a>
	
	<a href="javascript:void(0);" onclick="Reporte_Excel()"><img src="/ejecucion/eventos/imagenes/excel1.jpg" width="30" height="30" title="Generar Excel" style="float:none"/></a>
	
	<a class="recargar" href="javascript:void(0);"><img src="/ejecucion/eventos/imagenes/reload_f2.png" width="30" height="30" title="Recargar" style="float:none"/></a>
	
	<!-- FUNCIONA FORMA JQUERY ES MAS RAPIDO PERO NO ME FILTRA, USA EL ARCHIVO functions.js-->
	<!-- <a class="btnExport" href="javascript:void(0);"><img src="/ejecucionprueba/eventos/imagenes/excel2.png" width="30" height="30" title="Generar Excel"/></a> -->
	
	<!-- FUNCIONA COMO GENERO REPORTES EN JOOMLA, USA LA CARPETA Reporte_Excel, USA EL ARCHIVO ajax.js -->
	<!-- <a href="javascript:void(0);" onclick="Listar_Reporte(1)"><img src="/ejecucionprueba/eventos/imagenes/excel2.png" width="30" height="30" title="Generar Excel"/></a> -->
	
	
	<a href="/ejecucion/index.php?controller=menu&action=mod_archivo"><img src="/ejecucion/eventos/imagenes/back_f2.png" width="30" height="30" title="Regresar" style="float:right"/></a>
	
</div>

<?php
	//INFORMACION NECESARIA PARA CREAR UN REGISTRO EN LA TABLA log
	date_default_timezone_set('America/Bogota'); 
		
	$fechaa=date('Y-m-d g:ia');
		
	$horaa=explode(' ',$fechaa);
		
	$fechal=$horaa[0];
			  
	$hora=$horaa[1]; 
			 
	$accion='Eliminar Evento';
			
	$detalle=$_SESSION['nombre']." ".$accion.$fechal." "."a las: ".$hora;
			
	$tipolog=1;
	
?>
<!-- CAMPO OCULTO EL CUAL ESTA CARGADO CON LOS DATOS ANTERIORES -->
	<input type="hidden" name="datoslog2" id="datoslog2" size="100" maxlength="100" value="<?php print $fechal."///////".$accion."///////".$detalle."///////".$_SESSION['idUsuario']."///////".$tipolog?>">
<!-- CON ESTE DIV DEFINIMOS QUE PARTE QUEREMOS EXPORTAR A EXCEL, ES DECIR LA TABLA HTML, EN ESTE MOMENTO NO SE USA ESTA OPCION PARA EXPORTAR A EXCEL, POR QUE EL RADICADO  
SALE DESCONFIGURADO -->
<div id="dvData">

<table id="example">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha</th>
            <th>Asunto</th>
            <th>Accion</th>
            <th>Radicado</th>
			<th>Juzgado Reparto</th>
			<th>Asignado A</th>
			<th>Descripcion</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($view->clientes as $cliente):  // uso la otra sintaxis de php para templates ?>
            <tr>
                <td><?php echo $cliente['id'];?></td>
                <td style="width:100px"><?php echo $cliente['evefecha'];?></td>
                <td><?php echo $cliente['eveasunto'];?></td>
                <td><?php echo $cliente['acc_descripcion'];?></td>
				<td><?php echo $cliente['radicado'];?></td>
				<td><?php echo $cliente['nombre'];?></td>
				<td><?php echo $cliente['empleado'];?></td>
                <!-- <td><?php //echo number_format($cliente['peso'],2,',','.');?></td> -->
				<td><?php echo $cliente['evedescripcion'];?></td>
				
                <td><a class="edit" href="javascript:void(0);" data-id="<?php echo $cliente['id'];?>"><img src="/ejecucion/eventos/imagenes/edit_f2.png" width="20" height="20" title="Editar"/></a></td>
                <!-- <td><a class="delete" href="javascript:void(0);" data-id="<?php //echo $cliente['id']."##########".$fechal."///////".$accion."///////".$detalle."///////".$_SESSION['idUsuario']."///////".$tipolog;?>"><img src="/ejecucion/eventos/imagenes/cancel.png" width="20" height="20" title="Borrar"/></a></td> -->
				<td><a class="delete" href="javascript:void(0);" data-id="<?php echo $cliente['id'];?>"><img src="/ejecucion/eventos/imagenes/cancel.png" width="20" height="20" title="Borrar"/></a></td>
            </tr>
        <?php endforeach; ?>
		<?php //foreach ($view->suma as $total):?>
			<!-- FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014 -->
			<!-- <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><?php //echo number_format($total['sumapesos'],2,',','.');?></td>
				<td>-</td>
                <td>-</td>
				<td>-</td>
            </tr> -->
		 <?php //endforeach; ?>
			
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
