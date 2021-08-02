<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "TUTELAS";
	//$subtitulo  = "Lista Documentos Entrantes";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new alertaModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	
	$datostutelas = $modelo->get_lista_tutelas();

	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	
	/*$nombrelista  = 'sigdoc_pa_tipodocumento';
	$campoordenar = 'nombre_tipo_documento';
	$datostipodocumento = $modelo->get_lista($nombrelista,$campoordenar);*/
	
	//OBTENEMOS EL REGISTRO DE ENTRADAS Y SALIDAS DEL USUARIO
	//AL CARGAR EL SCRIPT $opcion ES DIFERENTE DE 1, PERO
	//AL DAR CLIC EN EL ICONO DE FILTRO ES SE LE ASIGA 1
	//HACIEDO POSIBLE EL FILTRO EN LA TABLA SEGUN LAS FECHAS
	
	/*$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
	
		$datosdocumentosentrantes = $modelo->get_documentos_entrantes_usuario(1);
	}
	else{
		$datosdocumentosentrantes = $modelo->get_documentos_entrantes_usuario(2);
	}*/
	
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
	
	/*$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '3';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);*/
	
	//print_r($datosusuarioacciones->fetch());
	//echo $usuarios[usuario];
	
	
	$campos        = 'usuario';
	$nombrelista   = 'pa_usuario_acciones';
	$idaccion      = '18';
	$campoordenar  = 'id';
	$datosusuarioT = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosT1    = $datosusuarioT->fetch();
	$usuariosaT2   = explode("////",$usuariosT1[usuario]);

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
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
<script src="views/js/ajax/ajax_alerta.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
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

	//aqui puedo pegar el codigo del archivo ubicado en  views/js/ajax/ajax_sigdoc.js
	//y que esta entre $(function(){ });
	
	<!-- TABLA TUTELAS -->
	/*$('#frm_editar1').dataTable( { 
		'sPaginationType': 'full_numbers' 
	} );*/
		

});

</script>	
 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_alerta.php';
		
	?>			
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id="popupbox"></div>
	
	<table border="0" align="center"  rules="rows" id="tablaconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
										
							<thead> 
							
										<tr>
											<th bgcolor="#CDE3F9" colspan="8">
												<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
											</th>
										</tr>
										
										<tr> 
											<th>ID</th>
											<th>RADICADO</th>
											<th>FECHA REGISTRO</th>
											<th>FECHA ACTUAL</th>
											<th>DIAS</th>
											<th>FECHA FALLO</th>
											<th>-</th>
											<th>-</th>
											
										</tr> 
									</thead> 
													
									<tbody> 
										
										
										<?php while($row = $datostutelas->fetch()){ ?>
											
											
											<?php 
											
												if ( in_array($_SESSION['idUsuario'],$usuariosaT2,true) ){
													
													$dias = $modelo->Dias_Respuesta($row[fecharegistrosistema],$fechaactual);
													
													$rango = $dias >= 1 && $dias <= 10;
												}
												else{											
												
													$dias = $modelo->Dias_Respuesta($row[fecharegistrosistema],$fechaactual);
													
													$rango = $dias >= 7 && $dias <= 10;
											
												}
												
												
												//if($dias >= 7 && $dias <= 10){
												
												if($rango){ 
												
												
												
												
											?>
	
												
											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[radicado];?></td>
												<td><?php echo $row[fecharegistrosistema];?></td>
												<td><?php echo $fechaactual;?></td>
												
												
												<td><?php echo $dias;?></td>
												
												<td><?php echo $row[fecha_fallo_tutela];?></td>
												
												
												<?php if($row[fecha_fallo_tutela] >= '0000-00-00'){ ?>
												
															
															<td>-</td>
												
												<?php } else{?>
												
															<td><img src="views/images/alertas.jpg" width="30" height="30"/><marquee behavior="alternate" bgcolor="#EFEFEF" scrollamount="2" scrolldelay="10" width="150" height="20">Alerta Termino Tutela</marquee> </td>
															
												
												<?php } ?>
												
												
												<?php if($row[fecha_fallo_tutela] >= '0000-00-00'){ ?>
												
															
															<td>-</td>
												
												<?php } else{?>
												
															<td><a class="asignarfechapago" href="javascript:void(0);" data-id="<?php echo $row['id'];?>"><img src="views/images/calendario.jpg" width="35" height="35" title="ASIGNAR FECHA FALLO DE TUTELA"/></a></td>
															
												
												<?php } ?>
												
												
																
												
												 
	
											</tr>
											
											<?php } ?>
											
									
										<?php } ?>
													
									</tbody>
									
							</table>
						
						</td>
					</tr>
			
			
	</table>		
			

<?php require 'alertas.php';?>
</body>
</html>


	
