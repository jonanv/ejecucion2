<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "Reportes";
	$subtitulo  = "LISTAR PERMISOS - APROBRAR PERMISOS";
	$subtitulo2 = "Permisos Usuario";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new repsModel();
	
	//OBTENEMOS LISTADO DE USUARIOS
	$datosusuario = $modelo->get_datos_usuarios();
	
	
	//OBTENEMOS EL REGISTRO DE PERMISOS DEL USUARIO
	
	$opcionb = trim($_GET['dato_pb']);
	
	if($opcionb != 1){
	
		$datospermisosausuario = $modelo->get_lista_permisos(1);
	}
	else{
		$datospermisosausuario = $modelo->get_lista_permisos(2);
	}

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --> 
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
<script src="views/js/ajax/ajax_reps_listar_permisos_2.js" type="text/javascript" charset="utf-8"></script>
<!-- <script src="views/js/ajax/ajax_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script> -->

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables_ELQUEESTABA.js"></script>
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

	<!-- TABLA id:frm_editar1-->
	/*$('#tpermisos').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA, AL ACTIVAR ESTO HAY QUE AGREGAR UNA COMA DESPUES DE 'full_numbers'
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null]
		'aoColumns': [null,null,null,null,null,null,null,null,null]
	
	} );*/
	
	//PARA LAS FECHAS
	$("#fechad").datepicker({ changeFirstDay: false	});
	$("#fechah").datepicker({ changeFirstDay: false	});
	
	//RECARGAR TABLA REGISTRO PERMISOS
	$('.recargar').click(function(evento){
		
		evento.preventDefault();  
		
		dato_p = 0;
		
		location.href="index.php?controller=reps&action=RecargarTablaPermisosAprobar&dato_p="+dato_p;
		
    });
	
	//FILTRAR TABLA REGISTRO ENTRADAS Y SALIDAS
	$('.filtrar').click(function(evento){
	
		var f1 = "";
		var f2 = "";
		var f3 = "";
		
		var filtro; 
		
		//alert("Filtrar");
		if (document.formp.usuario.value.length == 0 && document.formp.fechad.value.length == 0 && document.formp.fechah.value.length == 0 && document.formp.estado.value.length == 0){
		
			alert("Definir Algun Campo para Realizar el Filtro");
			document.getElementById('usuario').style.borderColor='#FF0000';
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
			document.getElementById('estado').style.borderColor='#FF0000';
		}
		else{
		
			dato_pb = 1;
			dato_1b = document.formp.usuario.value;
			dato_2b = document.formp.fechad.value;
			dato_3b = document.formp.fechah.value;
			dato_4b = document.formp.estado.value;
			
			//alert(dato_1b+" "+dato_2b+" "+dato_3b+" "+dato_4b);
			
			
			location.href="index.php?controller=reps&action=FiltroTablaPermisosAprobar&dato_pb="+dato_pb+"&dato_1b="+dato_1b+"&dato_2b="+dato_2b+"&dato_3b="+dato_3b+"&dato_4b="+dato_4b;
			
		}
		
			
    });
	
	
	//APROBAR UN SOLO PERMISO
	/*$('.aprobar').click(function(evento){
	
		alert('aprobar');
		
	});*/
	
	
});

</script>	

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_reps.php';
		
	?>			
	

	<form action="index.php?controller=reps&action=regIngresoSalida" method="post" id="formp" name="formp" onsubmit="return validar_campos();"> 
		

			<table border="4" align="center"  rules="rows">
			
				<tr>
					<td align="center" height="50" bgcolor="#CDE3F6">
						<?php echo $subtitulo; ?>
					</td> 
				</tr>
			
				<tr>
				
					<td align="center">
					
					
						<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Usuario</label>
               			<select name="usuario" id="usuario">
                 		
							<option value="" selected="selected">Seleccionar Usuario</option> 
						
				 			<?php
				 				while($row = $datosusuario->fetch()){
			
									echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
								}
				 			?>
               			</select>
						
						<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Fecha Desde</label>
						<input name="fechad" id="fechad" type="text" readonly="true" size="10">
						
						<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Fecha Hasta</label>
						<input name="fechah" id="fechah" type="text" readonly="true" size="10">
						
						
						<label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Estado</label>
               			<select name="estado" id="estado">
                 		
							<option value="" selected="selected">Seleccionar Estado</option> 
							<option value="0">No Aprobado</option> 
							<option value="1">Aprobado</option> 
							<option value="2">En Proceso</option> 
						
				 			
               			</select>
						
						<!-- <a href="javascript:void(0);" onclick="Filtrar_Tabla()" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a> -->
						<a class="filtrar" href="javascript:void(0);" title="FILTAR"><img src="views/images/filtro.jpg" width="35" height="35" title="FILTAR"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(1)" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="35" height="35" title="GENERAR EXCEL"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(2)" title="CONSOLIDADO DE PERMISOS"><img src="views/images/consolidado.jpg" width="35" height="35" title="CONSOLIDADO DE PERMISOS"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(3)" title="REPORTE ENTRADA Y SALIDA DE USUARIOS"><img src="views/images/user.jpg" width="35" height="35" title="REPORTE ENTRADA Y SALIDA DE USUARIOS"/></a>
						<a class="recargar" href="javascript:void(0);" title="RECARGAR TABLA"><img src="views/images/reload_f3.png" width="35" height="35" title="RECARGAR TABLA"/></a>
					</td>
				
				</tr>
				
				<tr id="tfilatramite">
					<td>
						<table cellpadding="0" cellspacing="0" border="1" class="display" id="tpermisos">
						
									<thead> 
									
										
										<tr> 
											<th bgcolor="#CDE3F9">ID</th>
											<th bgcolor="#CDE3F9">USUARIO</th>
											<th bgcolor="#CDE3F6">FECHA SOLICITUD</th>
											<th bgcolor="#CDE3F6">FECHA PERMISO</th>
											<th bgcolor="#CDE3F6">HORA INICIAL</th>
											<th bgcolor="#CDE3F6">HORA FINAL</th>
											<th bgcolor="#CDE3F6">DURACION</th>
											<th bgcolor="#CDE3F6">DETALLE</th>
											<th bgcolor="#CDE3F6">ESTADO</th>
											<?php $msg = "Aprobar Todos"; echo "<th><a id=\"aprobarpermisomasivo\" href=\"javascript:void(0);\" ><img src=\"views/images/apply_f2.png\" width=\"20\" height=\"20\" title=\"APROBAR TODOS LOS PERMISO\"/>".$msg."</a></th>";?>
											<?php $msg = "No Aprobar Todos"; echo "<th><a id=\"noaprobarpermisomasivo\" href=\"javascript:void(0);\" ><img src=\"views/images/apply.png\" width=\"20\" height=\"20\" title=\"NO APROBAR TODOS LOS PERMISO\"/>".$msg."</a></th>";?>
											<?php $msg = "En Proceso Todos"; echo "<th><a id=\"enprocesopermisomasivo\" href=\"javascript:void(0);\" ><img src=\"views/images/enproceso2.png\" width=\"25\" height=\"25\" title=\"EN PROCESO TODOS LOS PERMISO\"/>".$msg."</a></th>";?>
											<th>PERMISO</th>
											<th>SOPORTE</th>
										</tr> 
									</thead> 
									
									<tbody> 
									
									<?php while($row = $datospermisosausuario->fetch()){ 
									
											if($row[estado] == 2){
												$estado = "En Proceso";
											
											}
											if($row[estado] == 1){
												$estado = "Aprobado";
									
											}
											if($row[estado] == 0){
												$estado = "No Aprobado";
											
											}
											
									?>
				
											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[empleado];?></td>
												<td><?php echo $row[fecha_solicitud];?></td>
												<td><?php echo $row[fecha_permiso];?></td>
												<td><?php echo $row[hora_inicio];?></td>
												<td><?php echo $row[hora_final];?></td>
												<td><?php echo $row[duracion];?></td>
												<td><?php echo $row[detalle];?></td>
												<td><?php echo $estado;?></td>
												<?php $accion = "APROBAR"; echo "<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"aprobarpermiso('".$row['id']."','".$accion."')\"><img src=\"views/images/apply_f2.png\" width=\"20\" height=\"20\" title=\"APROBAR PERMISO\"/></a></td>";?>
												<?php $accion = "NOAPROBAR"; echo "<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"aprobarpermiso('".$row['id']."','".$accion."')\"><img src=\"views/images/apply.png\" width=\"20\" height=\"20\" title=\"NO APROBAR PERMISO\"/></a></td>";?>
												<?php $accion = "ENPROCESO"; echo "<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"aprobarpermiso('".$row['id']."','".$accion."')\"><img src=\"views/images/enproceso2.png\" width=\"25\" height=\"25\" title=\"EN PROCESO\"/></a></td>";?>
												<?php //echo "<td><a id='aprobar' href='javascript:void(0);' title='Aprobar Permiso'>".$row['id']."</a></td>";?>
												
												
												<?php //if($estado == "Aprobado"){?>
												
										
														<td><a class="generarword" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/icono_word.gif" width="35" height="35" title="GENERAR PERMISO"/></a></td>
														
														
														
														<?php 
														
														if( strlen($row[rutaarchivo]) >= 1 ){?>
															<td><a href="javascript:void(0);" title="Desacargar Archivo" data-ruta="<?php echo $row['rutaarchivo'];?>" style="color:#0000FF" onclick="document.location='<?php echo $row['rutaarchivo'];?>'"><img src="views/images/ipdf3.png" width="35" height="35" title="GENERAR SOPORTE"/></a></td>
														<?php } else{ ?>
															<td>-</td>
														<?php } ?>
											
												<?php //} 
													  //else{ ?>
													  	
														
														<!-- <td>-</td>
														<td>-</td> -->
														
														
												
												<?php //} //rutaarchivo?>
												
												
											</tr>
					
									<?php } ?>
									
									</tbody>
						</table>		
								
					</td>
				
				</tr> 
				
				
			
			</table>
		
		</form>
		
<?php require 'alertas.php';?>
</body>
</html>


