<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "GESTIONAR ACTIVIDAD";
	$subtitulo  = "GESTIONAR ACTIVIDAD";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	
	//LISTAS
	/*$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosjd = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	//LISTA CLASE
	$campo_a_mostrar  = 'des';
	$campo_a_insertar = 'id';
	$nombre_tabla     = 'gc_lista';
	$campo_filtro     = 'idtipo';
	$valor_filtro     = 1;
	$campo_a_ordenar = 'des';
	$datosclase       = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	//PARA FILTRO
	$datosclase_2      = $modelo->get_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
	
	
	//DATOS ACTIVIDAD	
	
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosACTI_1 = $modelo->busquedad_filtro_ACTIVIDAD();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACTI = $modelo->busquedad_filtro_ACTIVIDAD();
		
		$fAc = 0;
		while($fila_cantAC = $datosACTI->fetch()){		
		
			$fAc = $fAc + 1; 
		
		}
		
 		$cantregisAC = $fAc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACTI_1 = $modelo->busquedad_actual_ACTIVIDAD();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACTI = $modelo->busquedad_actual_ACTIVIDAD();
		
		$fAc = 0;
		while($fila_cantAC = $datosACTI->fetch()){		
		
			$fAc = $fAc + 1; 
		
		}
		
 		$cantregisAC = $fAc;
		
		//*************************************************************************************
	
	}

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_siepro.js" type="text/javascript" charset="utf-8"></script>

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
	
	
	
	
	//PARA LAS FECHAS
	//$("#fechae").datepicker({ changeFirstDay: false	});

	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
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
	
	$("#fechasri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrei_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasref_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdi_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechasrdf_2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	//$("#fechasre").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	$("#checkTodos").change(function () {
		  
		$("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
	
	});
	
	
	//GENERAR CORRECTIVO
	$('.generar_correctivo').click( function(){
										  
										  
		var id    = $(this).attr('data-id');
		
		//alert(id);
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.id        = id;
		params.id_filtro = 0;
		
		
			
	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/gc_correctivo.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	$(".buscarxfiltro_ACCION").click(function(){
								
		
		
		if( 
			
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#idfiltro').val().length    == 0 /*&& 
		   $('#listasr1F').val().length   == 0 &&
		   $('#listasr2F').val().length   == 0 &&
		   $('#listasr3F').val().length   == 0 &&
		   $('#listasr4F').val().length   == 0 &&
		   $('#listasr5F').val().length   == 0 &&
		   $('#listasr6F').val().length   == 0 */
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('idfiltro').style.borderColor    =  '#FF0000';
			/*document.getElementById('listasr1F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr2F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr3F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr4F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr5F').style.borderColor   =  '#FF0000';
			document.getElementById('listasr6F').style.borderColor   =  '#FF0000';*/
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltro').val();
			/*datox2 = $('#listasr1F').val();
			datox3 = $('#listasr2F').val();
			datox4 = $('#listasr3F').val();
			datox5 = $('#listasr4F').val();
			datox6 = $('#listasr5F').val();
			datox7 = $('#listasr6F').val();*/
		    
			
		
			location.href="index.php?controller=archivo&action=Busquedad_Filtro_ACTIVIDAD&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
			

			
		}
		
	});
	
	
	//DETALLE ACCION
	$('.detalle_accion').click( function(){
										  
										  
		var id    = $(this).attr('data-idaccion');
		
		//alert(id);
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.id        = id;
		params.id_filtro = 0;
		
		
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/gc_detalle_accion.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_RES_1").click(function() {
		location.href="index.php?controller=archivo&action=Gestionar_Actividad";
	});
	
	
	
	
});


</script>	




<style type="text/css">

.Estilo2 {
color: #0000CC;
cursor:pointer;
text-decoration: underline; 
}


.contenedor_editar{margin:60px auto;width:960px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	th {padding:5px; background-color:#CDE3F6;}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable span{display:block;}
		.editable span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
	.checkbox110{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}

</style> 

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		//require 'secc_archivo.php';
		require 'secc_solicitudes.php';
		
	?>			
	
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id ="popupbox"></div>

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
				<div id="contenido">
				
					<form id="frm_RA" name="frm_RA" method="post" enctype="multipart/form-data" action="">
					
						
						<input name="datospartes_RA" id="datospartes_RA" type="hidden" readonly="true"/>
						<!-- <input name="fechas_m" id="fechas_m" type="hidden" readonly="true"/>
						<input name="datospartes_m110" id="datospartes_m110" type="hidden" readonly="true"/> -->
						
												
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						
					
					 </form> 
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	
	
	
	<!-- FILTROS -->
	<table border="0" align="center"  rules="rows" id="tbuscarxfiltroconsulta">
		
			
		<tr>
					
			<td>
					
					
				<table cellpadding="0" cellspacing="0" rules="rows" border="1">
																						
										
					<tr> 
											
						<td colspan="5">
							<center>
								<strong style="width:151px; color:#FF0000; font-size:16px">ACTIVIDADES<?php echo " / REGISTROS: ".$cantregisAC." / FECHA: ".$fechaactual; ?></strong>
							</center>
						</td>
											
					</tr>
					
					<tr>
						<td>
							<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px ">ID:</label><br>
						</td>
										
						<td>
							<input type="text" name="idfiltro" id="idfiltro" style="color:#FF0000; font-size:16px" value="<?php echo trim($_GET['datox1']); ?>"/>
						</td>
						
						<td colspan="2">
							<a class="buscarxfiltro_ACCION" href="javascript:void(0);" title="BUSCAR ACTIVIDAD" style="color:#0066CC">
								<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR ACTIVIDAD"/>BUSCAR ACTIVIDAD 
							</a>
							
							<a class="btn_RES_1" href="javascript:void(0);" title="RECARGAR" style="color:#0066CC">
								<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>RECARGAR
							</a>
													
							
						</td>
										
					</tr>
											
					<tr>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasri_m" id="fechasri_m" value="<?php echo trim($_GET['dato_1']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
						</td>
						<td>
							<input type="text" name="fechasrf_m" id="fechasrf_m" value="<?php echo trim($_GET['dato_2']); ?>">
						</td>
												
																
					</tr>
					
					
										
										
																		
				</table>
										
						
			</td>
						
		</tr>
			
			
	</table>		
			
	<!-- SE LISTA LA CORRESPONDENCIA-->		
			
	<!-- <div class="mensaje"></div> -->
	
	<?php
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){ 
	?>
						
	<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="ttras110">
																						
										
		<tr> 
											
			
			<th style="color:#FF0000; font-size:10px">ID</th>	
			<th style="color:#FF0000; font-size:10px">ID ACCION</th>																					
			<th style="font-size:10px">FECHA INICIAL</th>
			<th style="font-size:10px">FECHA FINAL</th>
			<th style="font-size:10px">DESCRIPCION</th>
			<th style="font-size:10px">RESPONSABLE</th>
			<th style="font-size:10px">FECHA REG</th>
			<th style="font-size:10px">HORA REG</th>
			<th style="font-size:10px">ESTADO</th>
			<th style="font-size:10px">GESTION</th>
			<th style="font-size:10px">FECHA GESTION</th>
			<th style="font-size:10px">HORA GESTION</th>
			<th style="font-size:10px">SOPORTE</th>
			
			<!-- <th>									
				<a class="marcar_110" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a>
			</th>
											
			<th>										
				<a class="desmarcar_110" href="javascript:void(0);" title="Desmarcar todos"><img src="views/images/pendiente.jpg" width="20" height="20" title="Desmarcar todos"/></a>
			</th> -->
			
			<th style="font-size:10px">CORRECTIVO</th>
			
			
		</tr> 
		
		
		<?php
											
			
																			
			$Ct110=1;
							
			while($fila = $datosACTI_1->fetch()){
				
				
				$d1M = $fila[id];
				$d2M = $fila[idaccion];
				$d3M = $fila[fecha_inicial];
				$d4M = $fila[fecha_final];
				$d5M = $fila[des];
				$d6M = $fila[empleado];
				$d7M = $fila[fecha_registro];
				$d8M = $fila[hora_registro];
				$d9M = $fila[estado];
				$d10M = $fila[gestion];
				$d11M = $fila[rutaarchivo];
				
				$d12M = $fila[fecha_gestion];
				$d13M = $fila[hora_gestion];
				
															
												
		?>
				<?php if( $fechaactual > $d4M && $d9M == 0 ){ $msgV = " - EXPIRA TIEMPO PARA REALIZAR ACTIVIDAD"; ?>
				
				<tr style="background-color:#FFFF00">	
				<?php }else{	?>						
				<tr>
				<?php }	?>				
				<!-- <tr> -->
																
					<td style="color:#FF0000; font-size:10px ">
						<?php 
																													  
							echo $d1M;  
						?>
					</td>
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d2M;  
						?>
						
						<a class="detalle_accion" href="javascript:void(0);" title="DETALLE ACCION" data-idaccion="<?php echo trim($d2M);?>"><img src="views/images/catalogo.png" width="20" height="20" title="DETALLE ACCION"/></a>
					</td>
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d3M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d4M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d5M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d6M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d7M;  
						?>
					</td>
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d8M;  
						?>
					</td>
					
					<?php if($d9M == 0){ 
					
							if( $fechaactual > $d4M && $d9M == 0 ){ ?>
							
								<td style="font-size:10px">
								
									<?php echo "EXPIRA TIEMPO PARA REALIZAR ACTIVIDAD"; ?>
									
									<img src="views/images/expiro.png" width="20" height="20" title="EXPIRA TIEMPO PARA REALIZAR ACTIVIDAD"/>
									
								</td>
					
					<?php
					 		}
							else{?>
					
								<td style="font-size:10px ">
									<?php echo "EN PROCESO"; ?>
								</td>
							
							
					<?php   } ?>	
					
							
					<?php
							
						}
						else{ ?>
						
							<td style="font-size:10px">
									<?php echo "TERMINADA"; ?>
							</td>			
							
								
				     <?php } ?>
							
								
						
					
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d10M;  
						?>
					</td>
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d12M;  
						?>
					</td>
					
					<td style="font-size:10px ">
						<?php 
																													  
							echo $d13M;  
						?>
					</td>
					
					<?php if( strlen($d11M) >= 1 ){?>
					<td>
						<a href="<?php echo $d11M;?>" data-ruta="<?php echo $d11M;?>" style="color:#0000FF" target="_blank"><img src="views/images/archivo_3.png" width="35" height="35" title="GENERAR"/></a>
					</td>
						
					<?php } else{ ?>
					<td>-</td>
					<?php } ?>
					
					
					<!-- <td>
						<a class="generar_correctivo" href="javascript:void(0);" title="ADICIONAR CORRECTIVO" data-id="<?php //echo trim($d1M);?>"><img src="views/images/historial2.png" width="35" height="30" title="ADICIONAR CORRECTIVO"/></a>
					</td> -->
					
					
					<?php //if( ($fechaactual > $d4M && $d9M == 0) || ($d9M == 1) ){?>
					
					<!-- <td>-</td>	 -->
					<?php //} else{ ?>
					
					<td>
						<a class="generar_correctivo" href="javascript:void(0);" title="ADICIONAR CORRECTIVO" data-id="<?php echo trim($d1M);?>"><img src="views/images/historial2.png" width="35" height="30" title="ADICIONAR CORRECTIVO"/></a>
					</td>
					<?php //} ?>
					
					
					
					
					
					
					
					
					
					
					
			</tr>
			
			<?php  $Ct110=$Ct110+1; } ?>		
											
	</table>
	
	
	
	<?php
	//}
	?>
	
	
	<?php 

	//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
	//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
	/*echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';*/
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


