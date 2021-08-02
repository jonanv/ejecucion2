<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "Registro de Entrada y Salida de Personal";
	$subtitulo  = "Registros de Entrada y Salida";
	$subtitulo2 = "Permisos Usuario";
	
	//--------------RELOJ----------------------------------
	
	date_default_timezone_set('America/Bogota'); 
	
	$jDate = date('d/m/Y');
	$jHora = date('H');
	$jMin  = date('i');
	$jSec  = date('s');
	//--------------RELOJ----------------------------------
	
	//DATOS DE EQUIPO NOMBRE Y IP
	$nom_pc = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
	$ip     = gethostbyname($nom_pc);
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new repsModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual();
	
	//OBTENEMOS DATOS BASICOS DEL USUARIO
	$datosusuario = $modelo->get_datos_usuario_sistema();
	$campo        = $datosusuario->fetch();
	$foto         = $campo[foto];
	$nombre       = $campo[empleado];
	$ingreso	  = $campo[ingreso];
	
	$time_start = $modelo->microtime_float();
	
	//OBTENEMOS EL REGISTRO DE ENTRADAS Y SALIDAS DEL USUARIO
	//AL CARGAR EL SCRIPT $opcion ES DIFERENTE DE 1, PERO
	//AL DAR CLIC EN EL ICONO DE FILTRO ES SE LE ASIGA 1
	//HACIEDO POSIBLE EL FILTRO EN LA TABLA SEGUN LAS FECHAS
	$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
	
		$datosentradasalidausuario = $modelo->get_entrada_salida_usuario(1);
	}
	else{
		$datosentradasalidausuario = $modelo->get_entrada_salida_usuario(2);
	}

	//OBTENEMOS EL REGISTRO DE PERMISOS DEL USUARIO
	
	$opcion2 = trim($_GET['dato_p']);
	
	if($opcion2 != 1){
	
		$datospermisosausuario = $modelo->get_permisos_usuario(1);
	}
	else{
		$datospermisosausuario = $modelo->get_permisos_usuario(2);
	}
	
	$time_end = $modelo->microtime_float();
	$time     = $time_end - $time_start;

	//echo "No se hizo nada en $time segundos\n";
	
	
	
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
<script src="views/js/ajax/ajax_reps.js" type="text/javascript" charset="utf-8"></script>

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
<!-- <script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script> -->
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
	$('#frm_editar1').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA, AL ACTIVAR ESTO HAY QUE AGREGAR UNA COMA DESPUES DE 'full_numbers'
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null]
		'aoColumns': [null,null,null,null,null]
	
	} );
	
	<!-- TABLA id:frm_editar2-->
	$('#frm_editar2').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null,null,null,null,null,null,null,null,null,null]
		
	} );
	
	//AGREGADO POR JORGE ANDRES VALENCIA EL 21 DE ABRIL 2015
	//PARA QUE LA FILA DE LA TABLA DE ENTRADAS Y SALIDAS NO SE VEA EN LA CARGA
	//Y SE DEBA USAR LOS BOTONES DE LISTAR Y DESEACTIVAR
	//$('#filatramite').hide();
	//$('#filatramite2').hide();
	
	//ACTIVAR FILA CON LOS REGISTROS DE ENTRADA Y SALIDA
	$(".filaa").click(function(evento){
      	evento.preventDefault();
		$('#filatramite').show();
   	});
	
	//DESACTIVAR FILA CON LOS REGISTROS DE ENTRADA Y SALIDA
	$(".filad").click(function(evento){
      evento.preventDefault();
      //alert(1);
	  $('#filatramite').hide();
    }); 
	
	
	//ACTIVAR FILA CON LOS DE PERMISOS
	$(".filaa2").click(function(evento){
      	evento.preventDefault();
		$('#filatramite2').show();
   	});
	
	//DESACTIVAR FILA CON LOS REGISTROS DE PERMISOS
	$(".filad2").click(function(evento){
      evento.preventDefault();
      //alert(1);
	  $('#filatramite2').hide();
    }); 
	
	//PARA LAS FECHAS
	//FECHAS TABLA REGISTRO ENTRADAS Y SALIDAS
	$("#fechad").datepicker({ changeFirstDay: false	});
	$("#fechah").datepicker({ changeFirstDay: false	});
	
	//FECHAS REGISTRO PERMISOS
	$("#fechad2").datepicker({ changeFirstDay: false });
	$("#fechah2").datepicker({ changeFirstDay: false	});
	
	
	//FILTRAR TABLA REGISTRO ENTRADAS Y SALIDAS
	$('.filtrar').click(function(evento){
		
		if (document.form1.fechad.value.length == 0 || document.form1.fechah.value.length == 0){
			alert("Definir Ambas Fechas para Realizar el Filtro");
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.form1.fechad.value;
			dato_2 = document.form1.fechah.value;
	
			location.href="index.php?controller=reps&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
	
		}
		
		
			
    });
	
	//RECARGAR TABLA REGISTRO ENTRADAS Y SALIDAS
	$('.recargar').click(function(evento){
		
		evento.preventDefault();  
		
		dato_0 = 0;
		
		location.href="index.php?controller=reps&action=RecargarTabla&dato_0="+dato_0;
		
    });
	
	//------------------------------------------------------------------------------------------------------------------------------------------------------
	
	//FILTRAR TABLA REGISTRO PERMISOS
	$('.filtrar2').click(function(evento){
		
		if (document.form1.fechad2.value.length == 0 || document.form1.fechah2.value.length == 0){
			alert("Definir Ambas Fechas para Realizar el Filtro");
			document.getElementById('fechad2').style.borderColor='#FF0000';
			document.getElementById('fechah2').style.borderColor='#FF0000';
       	
		}
		else{
		
			dato_p = 1;
			dato_1 = document.form1.fechad2.value;
			dato_2 = document.form1.fechah2.value;
	
			location.href="index.php?controller=reps&action=FiltroTablaPermisos&dato_p="+dato_p+"&dato_1="+dato_1+"&dato_2="+dato_2;
	
		}
	
	});
	
	//RECARGAR TABLA REGISTRO PERMISOS
	$('.recargar2').click(function(evento){
		
		evento.preventDefault();  
		
		dato_p = 0;
		
		location.href="index.php?controller=reps&action=RecargarTablaPermisos&dato_p="+dato_p;
		
    });
	
	
	
	//--------------RELOJ----------------------------------------------------------------------------------------------------
	
	// Crea la funciÃƒÂ³n que actualizarÃƒÂ¡ la capa #hora-servidor
	jClock = function(jDate, jHora, jMin, jSec) { $("#hora-servidor").html(jDate + ', ' + jHora + ':' + jMin + ':' + jSec); }
	
	// Obtiene los valores de la fecha, hora, minutos y segundos del servidor
	
	var variablejs = "<?php echo $variablephp; ?>" ;
	
	var jDate = "<?php echo $jDate; ?>" ;
	var jHora = "<?php echo $jHora; ?>" ;
	var jMin  = "<?php echo $jMin; ?>" ;
	var jSec  = "<?php echo $jSec; ?>" ;
	
	// Actualiza la capa #hora-servidor
	jClock(jDate, jHora,jMin,jSec);
	
	// Crea un intervalo cada 1000ms (1s)
	var jClockInterval = setInterval(function()
	{
	/** Incrementa segundos */
	jSec++;
	/** Si el valor de jSec es igual o mayor a 60 */
	if (jSec >= 60) {
	/** Incrementa jMin en 1 */
	jMin++;
	/** Si el valor de jMin es igual o mayor a 60 */
	if (jMin >= 60) {
	/** Incrementa jHora en 1 */
	jHora++;
	/** Si el valor de jHora es igual o mayor a 23 */
	if (jHora > 23) {
	/** Cambia la hora a 00 */
	jHora = '00';
	}
	
	/** Si el valor de jHora es menor a 10, le agrega un cero al valor */
	else if (jHora < 10) { jHora = '0'+jHora; }
	
	jMin = '00';
	} else if (jMin < 10) { jMin = '0'+jMin; }
	
	jSec = '00';
	} else if (jSec < 10) { jSec = '0'+jSec; }
	
	jClock(jDate, jHora,jMin,jSec);
	}, 1000);
	
	//alert(jHora);
	
	//-----------------------------------------------------------------------------------------------------------------------------------
	
	
		
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
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id="popupbox"></div>

	<form action="index.php?controller=reps&action=regIngresoSalida" method="post" id="form1" name="form1" onsubmit="return validar_campos();"> 
		

			<!-- ASIGNO AL CAMPO OCULTO datosequipo LA IP Y NOMBRE DEL EQUIPO ACTUAL, PARA SER TENIDOS ENCUENTA EN EL REGISTRO-->
			<input ip="datosequipo" name="datosequipo" type="hidden" value="<?php echo $ip."////".$nom_pc;?>" />
			
			<table border="4" align="center"  rules="rows">
			
				<!-- <tr>
					<td colspan="2">
						 <img src="views/images/crm_fondo_top.png" width="954" height="40"/>
					</td>
				</tr> -->
				
				
				<tr>
					<td align="center" colspan="2" height="50" bgcolor="#CDE3F6">
						
						<center>
							<br><label style="width:180px; height:23px; color:#FF0000; font-size:18px ">FECHA - HORA ACTUAL DEL SERVIDOR</label><br><br>
											
							<div id="hora-servidor" style="width:280px; height:43px; color:#000000; font-size:20px"><?=date('d/m/Y G:i:s')?></div>
						</center>
				
					</td> 
				</tr> 
				
				<tr>
					<td align="center" colspan="2" height="50" bgcolor="#CDE3F6">
						<?php echo strtoupper($nombre); ?>
					</td> 
				</tr>
		
				<tr> 
					
					<td>
						<br><br><img src="<?php echo $foto; ?>" width="100" height="100" title="Foto"/>
					</td> 
			
					<td>
						<?php 
							if($ingreso == 0){ 
						?>
								<button type="submit" name="ingresar" title="Ingresar" style="border-color:#0099FF; float:right"><img src="views/images/rep_ingreso.png" width="150" height="100" /></button> 
								<input ip="tiporegistro" name="tiporegistro" type="hidden" value="ENTRADA" />
						<?php
							}
							else{
						?>
								<button type="submit" name="salir" title="Salir" style="border-color:#FF0000; float:right"><img src="views/images/rep_salida.png" width="150" height="100" /></button> 
								<input ip="tiporegistro" name="tiporegistro" type="hidden" value="SALIDA" />
						<?php } ?>
					</td>
				
				<tr> 
				
				<tr>
				
					<td>
						<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">Fecha - Hora</label><br><br>
						<input type="text" id="fechar" name="fechar" size="20" title="Fecha Registro" readonly="true" value="<?php echo $fechaactual;?>" style="width:180px; height:23px; border-color:#000000; font-size:16px "/>
					</td>
				
					<td>
						<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">OBSERVACION</label><br><br>
						<textarea  name="observacion" id="observacion" title="OBSERVACION REFRENTE A LA ENTRADA Y SALIDA" cols="50" rows="5" style="border-color:#000000; font-size:16px "></textarea><br><br><br>
					</td>
					
			
				</tr>
				
				
				<tr>
					<td colspan="2">
						<a id="new" href="javascript:void(0);" title="SOLICITUD PERMISOS"><img src="views/images/permiso3.png" width="80" height="80" title="SOLICITUD PERMISOS"/><label style="width:180px; height:23px; border-color:#000000; font-size:18px ">SOLICITUD PERMISOS</label></a>
					</td>
				</tr>
				
				

				<tr>
				
					<td align="center" colspan="2" bgcolor="#CDE3F6">
						<br><label><?php echo strtoupper($subtitulo); ?></label><br><br>
					</td>
					
			
				</tr>
				
				<tr>
				
					<td align="center" colspan="2">
						<!-- SE PUEDEN DESACTIVAR PARA SU FUNCIONAMIENTO -->
						<!-- <a class="filaa" href="javascript:void(0);" title="LISTAR REGISTROS"><img src="views/images/next_f2.png" width="20" height="20" title="LISTAR REGISTROS"/>Listar</a>
						<a class="filad" href="javascript:void(0);" title="DESACTIVAR REGISTROS"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR REGISTROS"/>Desactivar</a> -->
					</td>
				
				</tr> 
				
				<tr>
				
					<td align="center" colspan="2">
						
						<label>Fecha Desde</label>
						<input name="fechad" id="fechad" type="text" readonly="true" size="10">
						
						<label>Fecha Hasta</label>
						<input name="fechah" id="fechah" type="text" readonly="true" size="10">
						
						<!-- <a href="javascript:void(0);" onclick="Filtrar_Tabla()" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a> -->
						<a class="filtrar" href="javascript:void(0);" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(1)" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="25" height="25" title="GENERAR EXCEL"/></a>
						<a class="recargar" href="javascript:void(0);" title="RECARGAR TABLA"><img src="views/images/reload_f3.png" width="25" height="25" title="RECARGAR TABLA"/></a>
					</td>
				
				</tr>
				
				<tr id="filatramite">
					<td colspan="2">
						<table cellpadding="0" cellspacing="0" border="1" class="display" id="frm_editar1">
						
									<thead> 
									
										
										<tr> 
											<th bgcolor="#CDE3F9">ID</th>
											<th bgcolor="#CDE3F9">FECHA</th>
											<th bgcolor="#CDE3F9">HORA</th>
											<th bgcolor="#CDE3F6">TIPO REGISTRO</th>
											<th bgcolor="#CDE3F6">OBSERVACION</th>
										</tr> 
									</thead> 
									
									<tbody> 
									
									<?php while($row = $datosentradasalidausuario->fetch()){ ?>
				
											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[fecha];?></td>
												<td><?php echo $row[hora];?></td>
												<td><?php echo $row[tipo];?></td>
												<td><?php echo $row[observaciones];?></td>
											</tr>
					
									<?php } ?>
									
									</tbody>
						</table>		
								
					</td>
				
				</tr> 
				
				<tr>
				
					<td align="center" colspan="2" bgcolor="#CDE3F6">
						<br><label><?php echo strtoupper($subtitulo2); ?></label><br><br>
					</td>
				
				</tr>
				
				<tr>
				
					<td align="center" colspan="2">
						<!-- SE PUEDEN DESACTIVAR PARA SU FUNCIONAMIENTO -->
						<!-- <a class="filaa2" href="javascript:void(0);" title="LISTAR PERMISOS"><img src="views/images/next_f2.png" width="20" height="20" title="LISTAR PERMISOS"/>Listar</a>
						<a class="filad2" href="javascript:void(0);" title="DESACTIVAR PERMISOS"><img src="views/images/next.png" width="20" height="20" title="DESACTIVAR PERMISOS"/>Desactivar</a> -->
					</td>
				
				</tr> 
				
				<tr>
				
					<td align="center" colspan="2">
						
						<label>Fecha Desde</label>
						<input name="fechad2" id="fechad2" type="text" readonly="true" size="10">
						
						<label>Fecha Hasta</label>
						<input name="fechah2" id="fechah2" type="text" readonly="true" size="10">
						
						<!-- <a href="javascript:void(0);" onclick="Filtrar_Tabla()" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a> -->
						<a class="filtrar2" href="javascript:void(0);" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(2)" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="25" height="25" title="GENERAR EXCEL"/></a>
						<a class="recargar2" href="javascript:void(0);" title="RECARGAR TABLA"><img src="views/images/reload_f3.png" width="25" height="25" title="RECARGAR TABLA"/></a>
					</td>
				
				</tr>
				
				<tr id="filatramite2">
					<td colspan="2">
						<table cellpadding="0" cellspacing="0" border="1" class="display" id="frm_editar2">
						
									<thead> 
									
										
										<tr> 
											<!-- <th bgcolor="#CDE3F9">USUARIO</th> -->
											<th>ID</th>
											<th>FECHA SOLICITUD</th>
											<th>FECHA PERMISO</th>
											<th>HORA INICIAL</th>
											<th>HORA FINAL</th>
											<th>DURACION</th>
											<th>DETALLE</th>
											<th>ESTADO</th>
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
												<!-- <td><?php //echo $row[empleado];?></td> -->
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[fecha_solicitud];?></td>
												<td><?php echo $row[fecha_permiso];?></td>
												<td><?php echo $row[hora_inicio];?></td>
												<td><?php echo $row[hora_final];?></td>
												<td><?php echo $row[duracion];?></td>
												<td><?php echo $row[detalle];?></td>
												
												<!-- <td> -->
												<?php if($estado == "Aprobado"){?>
												
														<td><?php echo $estado;?></td>
														<td><a class="generarword" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/icono_word.gif" width="35" height="35" title="GENERAR PERMISO"/></a></td>
														
														<?php if( strlen($row[rutaarchivo]) >= 1 ){?>
															<td><a href="javascript:void(0);" title="Desacargar Archivo" data-ruta="<?php echo $row['rutaarchivo'];?>" style="color:#0000FF" onclick="document.location='<?php echo $row['rutaarchivo'];?>'"><img src="views/images/ipdf3.png" width="35" height="35" title="GENERAR RESOLUCION"/></a></td>
														<?php } else{ ?>
															<td>-</td>
														<?php } ?>
											
												<?php } 
													  else{ ?>
													  	
														<td><?php echo $estado;?></td>
														<td>-</td>
														<td>-</td>
														
														
												
												<?php } //rutaarchivo?>
													
													
												<!-- </td> -->
												
												
											</tr>
					
									<?php } ?>
									
									</tbody>
						</table>		
								
					</td>
				
				</tr> 
				
				<!-- <tr>
					<td colspan="2">
						 <img src="views/images/crm_fondo_foot.png" width="954" height="40" />
					</td>
				</tr> -->
				
				
			
			</table>
		
		</form>
		
<?php require 'alertas.php';?>
</body>
</html>


