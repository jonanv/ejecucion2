<?php 
	
	//echo $_SESSION['ingreso'];
	
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

	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new empleadosModel();
	

	//OBTENEMOS DATOS BASICOS DEL USUARIO
	$datosusuario = $modelo->get_datos_usuario_sistema();
	$campo        = $datosusuario->fetch();
	$foto         = $campo[foto];
	$nombre       = $campo[empleado];
	$ingreso	  = $campo[ingreso];
	
	
	//OBTENEMOS EL REGISTRO DE ENTRADAS Y SALIDAS DEL USUARIO
	//AL CARGAR EL SCRIPT $opcion ES DIFERENTE DE 1, PERO
	//AL DAR CLIC EN EL ICONO DE FILTRO ES SE LE ASIGA 1
	//HACIEDO PÃƒâ€œSIBLE EL FILTRO EN LA TABLA SEGUN LAS FECHAS
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
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $titulo?></title>
<!-- -------------------------------------------------------------------- -->
<!-- <script src="views/js/jquery.js" type="text/javascript"></script> -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2/jquery.min.js" type="text/javascript"></script>

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>

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
	
	//PARA LAS FECHAS
	
	//PARA LAS FECHAS
	//FECHAS TABLA REGISTRO ENTRADAS Y SALIDAS
	$("#fechad").datepicker({ changeFirstDay: false	});
	$("#fechah").datepicker({ changeFirstDay: false	});

	//FECHAS REGISTRO PERMISOS
	$("#fechad2").datepicker({ changeFirstDay: false });
	$("#fechah2").datepicker({ changeFirstDay: false	});
	
	
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
	
	
	//FILTRAR TABLA REGISTRO ENTRADAS Y SALIDAS
	$('.filtrar').click(function(evento){
		
		if (document.frm.fechad.value.length == 0 || document.frm.fechah.value.length == 0){
			alert("Definir Ambas Fechas para Realizar el Filtro");
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.frm.fechad.value;
			dato_2 = document.frm.fechah.value;
	
			location.href="index.php?controller=empleados&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
	
		}
		
		
			
    });
	
	//RECARGAR TABLA REGISTRO ENTRADAS Y SALIDAS
	$('.recargar').click(function(evento){
		
		evento.preventDefault();  
		
		dato_0 = 0;
		
		//location.href="index.php?controller=empleados&action=RecargarTabla&dato_0="+dato_0;
		
		location.href="index.php?controller=empleados&action=regIngresoSalida";
		
    });
	//------------------------------------------------------------------------------------------------------------------------------------------------------
	
	//FILTRAR TABLA REGISTRO PERMISOS
	$('.filtrar2').click(function(evento){
		
		if (document.frm.fechad2.value.length == 0 || document.frm.fechah2.value.length == 0){
			alert("Definir Ambas Fechas para Realizar el Filtro");
			document.getElementById('fechad2').style.borderColor='#FF0000';
			document.getElementById('fechah2').style.borderColor='#FF0000';
       	
		}
		else{
		
			dato_p = 1;
			dato_1 = document.frm.fechad2.value;
			dato_2 = document.frm.fechah2.value;
	
			location.href="index.php?controller=empleados&action=FiltroTablaPermisos&dato_p="+dato_p+"&dato_1="+dato_1+"&dato_2="+dato_2;
	
		}
	
	});
	
	//RECARGAR TABLA REGISTRO PERMISOS
	$('.recargar2').click(function(evento){
		
		evento.preventDefault();  
		
		dato_p = 0;
		
		//location.href="index.php?controller=empleados&action=RecargarTablaPermisos&dato_p="+dato_p;
		
		location.href="index.php?controller=empleados&action=regIngresoSalida";
		
    });
	
	
	
	
	//--------------RELOJ----------------------------------------------------------------------------------------------------
	
	// Crea la funci�n que actualizar� la capa #hora-servidor
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

<style type="text/css">
<!--
.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}
-->
</style>
</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_empleados.php'; ?>
<!---->

<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
<div id ="block"></div>
<div id="popupbox"></div>
	
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  
 
  
 
  
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Registrar Ingreso Salida de Empleados</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
		
		
		
		<tr>
			<td align="center" colspan="2" height="50" bgcolor="#CDE3F6">
				
				<center>
					<br><label style="width:180px; height:23px; color:#FF0000; font-size:18px ">FECHA - HORA ACTUAL DEL SERVIDOR</label><br><br>
									
					<div id="hora-servidor" style="width:280px; height:43px; color:#000000; font-size:20px"><?=date('d/m/Y G:i:s')?></div>
				</center>
		
			</td> 
		 </tr> 
		
		
       <?php      
			//echo $datos_dias;?>
  
         <tr>
   <td width="89" >Fecha Ingreso:</td>
    <input name="ruta" type="hidden" value="<?php echo $var;?>" />
    <?php  date_default_timezone_set('America/Bogota'); 
           $fechaa=date('Y-m-d g:ia');
?>
    <td width="149"><input name="fecha" type="text" class="required tinicio" id="txt_input" readonly="readonly" value="<?php echo  $fechaa;?>"/>	</td>
    
          </tr>
          
          <tr>
           <!--  <td><a href="http://www.relojesflash.com" title="relojes web">
              <embed style="" src="http://www.relojesflash.com/swf/6.swf" wmode="transparent" type="application/x-shockwave-flash" height="100" width="100">
                <param name=wmode value=transparent />
              </embed>
				</a>             
              </td> -->
			<td></td>
            <td><?php if($ingreso == 0) { ?>  <input ip="tiporegistro" name="tiporegistro" type="hidden" value="ENTRADA" /><button name="ingresar" type="submit" class="btn_ingresar" ><img src="views/images/ingreso.png" width="100" height="100" /> </button> 
            <h1>Registre su Entrada</h1> <?php } ?> <?php  if($ingreso == 1) { ?>  <input ip="tiporegistro" name="tiporegistro" type="hidden" value="SALIDA" /><button name="ingresar" type="submit" class="btn_ingresar" ><img src="views/images/salida.png" width="100" height="100">  </button> <h1>Registre su Salida</h1> <?php } ?>
            </td>
            </tr><tr>
              <td align="center">&nbsp;</td>
          </tr>
         
          
          <tr>
            <td>Observaciones:</td>
            <td><textarea name="observaciones" id="observaciones" cols="45" rows="5" maxlength = "500"></textarea ></td>
            
              
          </tr>
		  
		  <tr>
			<td colspan="2">
				<a id="new" href="javascript:void(0);" title="SOLICITUD PERMISOS"><img src="views/images/permiso2.png" width="80" height="80" title="SOLICITUD PERMISOS"/><label style="width:180px; height:23px; border-color:#000000; font-size:18px ">SOLICITUD PERMISOS</label></a>
			</td>
		  </tr>
		  
		  
		  		<tr>
				
					<td align="center" colspan="2" bgcolor="#CDE3F6">
						<center><br><label><?php echo strtoupper($subtitulo); ?></label><br><br></center>
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
					
						<center>
						
						<label>Fecha Desde</label>
						<input name="fechad" id="fechad" type="text" readonly="true" size="10">
						
						<label>Fecha Hasta</label>
						<input name="fechah" id="fechah" type="text" readonly="true" size="10">
						
						<!-- <a href="javascript:void(0);" onclick="Filtrar_Tabla()" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a> -->
						<a class="filtrar" href="javascript:void(0);" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(1)" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="25" height="25" title="GENERAR EXCEL"/></a>
						<a class="recargar" href="javascript:void(0);" title="RECARGAR TABLA"><img src="views/images/reload_f3.png" width="25" height="25" title="RECARGAR TABLA"/></a>
						
						</center>
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
				
					<td colspan="2" bgcolor="#CDE3F6">
						<center><br><label><?php echo strtoupper($subtitulo2); ?></label><br><br></center>
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
				
					<td colspan="2">
						
						<center>
						
						<label>Fecha Desde</label>
						<input name="fechad2" id="fechad2" type="text" readonly="true" size="10">
						
						<label>Fecha Hasta</label>
						<input name="fechah2" id="fechah2" type="text" readonly="true" size="10">
						
						<!-- <a href="javascript:void(0);" onclick="Filtrar_Tabla()" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a> -->
						<a class="filtrar2" href="javascript:void(0);" title="FILTAR"><img src="views/images/filtro.jpg" width="25" height="25" title="FILTAR"/></a>
						<a href="javascript:void(0);" onclick="Reporte_Excel(2)" title="GENERAR EXCEL"><img src="views/images/excel.jpg" width="25" height="25" title="GENERAR EXCEL"/></a>
						<a class="recargar2" href="javascript:void(0);" title="RECARGAR TABLA"><img src="views/images/reload_f3.png" width="25" height="25" title="RECARGAR TABLA"/></a>
						
						</center>
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
															<td><a href="javascript:void(0);" title="Desacargar Archivo" data-ruta="<?php echo $row['rutaarchivo'];?>" style="color:#0000FF" onclick="document.location='<?php echo $row['rutaarchivo'];?>'"><img src="views/images/ipdf3.png" width="35" height="35" title="GENERAR SOPORTE"/></a></td>
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
		  
		  
	   
        </table>
        

      </form>
	  <?php require 'alertas.php';?>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>
<iframe src="about:blank" name="main" id="main" width="0" height="0" frameborder="0"></iframe>
</body>
</html>
