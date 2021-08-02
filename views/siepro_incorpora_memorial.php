<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo      = "Incorporar Memorial al Proceso";
	$subtitulo   = "datos Proceso";
	$subtitulo_2 = "Memoriales";
	$subtitulo_3 = "Memoriales a Incorporar al Proceso";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	
	$opcion = trim($_GET['dato_0']);
	
	 	
	if($opcion == 1){
	
		
		$idbloque = trim($_GET['datox1']);
		
		$regdatos = $modelo->get_incorporar_memorial();
		
		//print_r($regdatos);
	
	}
	
	

	//OBTENEMOS DATOS DEL PROCESO
	/*$idradicado = trim($_GET['idradicado']);
	
	$datosproceso   = $modelo->get_datos_proceso($idradicado);
	$fdatos         = $datosproceso->fetch();
	$idpro	        = $fdatos[idproceso];
	$radi	        = $fdatos[radicado];
	$cde	        = $fdatos[cedula_demandante];
	$nde	        = $fdatos[demandante];
	$cdo	        = $fdatos[cedula_demandado];
	$ndo	        = $fdatos[demandado];
	$idjo	        = $fdatos[idjuzgadoorigen];
	$njo	        = $fdatos[nombrejuzgadoorigen];*/
	
	

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
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_sieproincorporamemorial.js" type="text/javascript" charset="utf-8"></script>

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
	
	
});

</script>	

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		require 'secc_archivo.php';
		
	?>			
	
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
				
				<!-- <div id="contenido"> -->
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<!-- <input name="idincorpora" id="idincorpora" type="hidden" readonly="true"/> -->
						
					 	<div id="titulo_frm"><center><?php echo strtoupper($titulo); ?></center></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<!-- <input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="<?php //echo trim($_GET['dato_1']); ?>"/> -->
									
									<input type="text" name="radicado" id="radicado" class="required number" value="<?php echo trim($_GET['dato_1']); ?>"/>
								</td>
								
								<td colspan="3">
									<a id="consultarincorporar" href="javascript:void(0);"><img src="views/images/lupa.png" width="35" height="35" title="CONSULTAR"/>CONSULTAR</a>
								</td>
								
								
							</tr>
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Inicial Entrega:</label>
								</td>
								<td>
									<input type="text" name="fechaie" id="fechaie" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>
								
								<td>
									<label style="width:151px; color:#666666">Fecha Final Entrega:</label>
								</td>
								<td>
									<input type="text" name="fechafe" id="fechafe" class="required" readonly="true" value="<?php echo trim($_GET['dato_3']); ?>">
								</td>
							
							</tr>
							
							
							
							
							<tr>
								<td colspan="4"> 
								
									<table border="0" align="center" width="800">
									
										<div id="titulo_frm"><center><?php echo strtoupper($subtitulo); ?></center></div>
										
										<tr>
											<td colspan="4">
												<label style="width:151px; color:#666666">id</label><br><br>
												<input type="text" name="idr" id="idr" class="required" readonly="true" value="<?php echo trim($_GET['dato_4']); ?>"/>
											</td>
											
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandante</label><br><br>
												<input type="text" name="cedula_demandante" id="cedula_demandante" class="required" readonly="true" value="<?php echo trim($_GET['dato_5']); ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandante</label><br><br>
												<input type="text" name="demandante" id="demandante" class="required" readonly="true" value="<?php echo trim($_GET['dato_6']); ?>"/>
											</td>
											
											<td>
												<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
												<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true" value="<?php echo trim($_GET['dato_7']); ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandado</label><br><br>
												<input type="text" name="demandado" id="demandado" class="required" readonly="true" value="<?php echo trim($_GET['dato_8']); ?>"/>
											</td>
											
										</tr>
										<!-- <tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
												<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandado</label><br><br>
												<input type="text" name="demandado" id="demandado" class="required" readonly="true"/>
											</td>
											
										</tr>
										 -->
										<tr>
											<td>
												<label style="width:151px; color:#666666">Juzgado Origen</label><br><br>
												<input type="text" name="jo" id="jo" class="required" readonly="true" value="<?php echo trim($_GET['dato_10']); ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Juzgado Destino</label><br><br>
												<!-- <input type="text" name="jd" id="jd" class="required" readonly="true" value="<?php //echo trim($_GET['dato_11']); ?>"/> -->
												<input type="text" name="jd" id="jd" readonly="true" value="<?php echo trim($_GET['dato_11']); ?>"/>
											</td>
											
											<td colspan="2">
												<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
												<input type="text" name="claseproceso" id="claseproceso" class="required" readonly="true" value="<?php echo trim($_GET['dato_9']); ?>"/>
											</td>
											
										</tr>
										
										<!-- <tr>
											<td colspan="2">
												<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
												<input type="text" name="claseproceso" id="claseproceso" class="required" readonly="true"/>
											</td>
											
										</tr> -->
										
										<?php
										
										//if($opcion == 1){
										?>
										
										<!-- <tr>
											
											<td colspan="4">
												
												<div id="titulo_frm"><center><?php //echo strtoupper($subtitulo_2); ?></center></div>
												
												<table id="tmemoriales" border="0" width="800">
													
													<tr>
														<td>Id</td>
														<td>Fecha Recibido</td>
														<td>Radicado</td>
														<td>Peticionario</td>
														<td>Tipo</td>
														<td>Juzgado Origen</td>
														<td>Juzgado Destino</td>
														<td>Fecha Entrega</td>
														<td>Solicitud</td>
														<td>RecibiÃ³</td>
														<td>Folios</td>
														<td>Expediente</td>
														<td>-</td>
													
													</tr> -->
													
													<?php //while($row = $regdatos->fetch()){ ?>
										
							
													<!-- <tr>
											
														<td><?php //echo $row[id];?></td>
														<td><?php //echo $row[fecha_registro];?></td>
														<td><?php //echo $row[radicado];?></td>
														<td><?php //echo utf8_decode($row[peticionario]);?></td>
														<td><?php //echo $row[tipo_documento];?></td>
														<td><?php //echo utf8_decode($row[juzorigen]);?></td>
														<td><?php //echo utf8_decode($row[juzdestino]);?></td>
														<td><?php //echo $row[fecha_entrega];?></td>
														<td><?php //echo $row[solicitud];?></td>
														<td><?php //echo utf8_decode($row[empleado]);?></td>
														<td><?php //echo $row[folios];?></td>
														<td><?php //echo $row[tiene_expediente];?></td>
							
														<td><a class="adicionarmemorial" href="javascript:void(0);" title="ADICIONAR MEMORIAL" data-id="<?php echo $row['id'];?>"><img src="views/images/flecha.jpg" width="35" height="35" title="ADICIONAR MEMORIAL"/></a></td>  -->
														
														<!-- <td><button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar" onClick="Adicionar_Parte(1)"><img src="views/images/flecha.jpg" width="30" height="30"/></button></td> -->
								
													<!-- </tr> -->
											
												<?php //} ?>
														
												
												<!-- </table>
											
											
											</td>
										
										</tr> -->
										
										<?php
										//} 
										?>
										
									</table>
									
								</td>
							</tr>
							
							<tr>
							
								<td colspan="4">
									
									<div id="titulo_frm"><center><?php echo strtoupper($subtitulo_2); ?></center></div>
									
									<center><table>
	
										<tr>
											<td>
												<div id="cont2"> 
													<table id="t2" border="1"> 
														<tr>
															
														<td>Id</td>
														<td>Fecha Recibido</td>
														<td>Radicado</td>
														<td>Peticionario</td>
														<td>Tipo</td>
														<td>Juzgado Origen</td>
														<td>Juzgado Destino</td>
														<td>Fecha Entrega</td>
														<td>Solicitud</td>
														<td>Recibió</td>
														<td>Folios</td>
														<td>Expediente</td>
														<td>Observacion</td>
														<td>Incorporado</td>
														<td>Fecha</td>
														<td>-</td>
															
															
														
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table></center>
						
								</td>
							
							</tr> 
							
							<tr>
							
								<td>
									<label style="width:151px; color:#FF0000; font-size:12px">Observacion:</label>
								</td>
								<td>
								
									<input type="text" name="obserie"  id="obserie" onKeyUp="this.value=this.value.toUpperCase()"/>
									
									<!-- ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA -->
									<input type="hidden" name="datospartes" id="datospartes"/>
			
								</td>
								
								<td>
									<label style="width:151px; color:#FF0000; font-size:12px">A Despacho:</label>
								</td>
								
								<td>
															
										<select name="a_despacho" id="a_despacho">
												
													
											<option value="" selected="selected">Seleccionar A Despachp</option>
																
											<option value="0">NO</option>
											<option value="1">SI</option>
										
										</select>
								</td>
											
				
							</tr>
							
							
							
							
							<!-- <tr>
	
								<td colspan="4">
									<a id="btpartes" href="javascript:void(0);"><img src="views/images/incorporar.png" width="45" height="45" title="INCORPORAR MEMORIAL"/>INCORPORAR MEMORIAL</a>
									
									<input type="hidden" name="datospartes" id="datospartes"/>
								</td>
								
							</tr>
							
							
							<tr id="filapartes">
							
								<td colspan="4">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_partes">
		  	
										<tr>
											<td colspan="2">
												
												
												<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar" onClick="Adicionar_Parte(1)"><img src="views/images/new2.jpg" width="30" height="30"/></button>
											
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Observacion:</label>
											</td>
											<td>
												<input type="text" name="obserie"  id="obserie"/>
			
											</td>
											
				
										</tr>
										
										
										
										
		
									</table>
								
								</td>
								
							</tr> -->
							
							<tr>
							
								<td colspan="4">
									
									<div id="titulo_frm"><center><?php echo strtoupper($subtitulo_3); ?></center></div>
									
									<center><table>
	
										<tr>
											<td>
												<div id="cont"> 
													<table id="t" border="1"> 
														<tr>
															
															<td>
																<strong>Id Memorial</strong>
															</td>
															<td>
																<strong>Radicado</strong>
															</td>
															<td>
																<strong>Observacion</strong>
															</td>
															<td>
																<strong>Id Radicado</strong>
															</td>
															<td>
																<strong>Incorporado</strong>
															</td>
															<td>
																<strong>A despacho</strong>
															</td>
															
															
														
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table></center>
						
								</td>
							
							</tr> 
							
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr>
							
	
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="4">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" class="btn_validar" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
										<!-- <input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/> -->
										<input type="button" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
					
					 </form> 
			
				<!-- </div> --> 
				
			</td>
		</tr>
		
	</table>
	
	

<?php require 'alertas.php';?>
</body>
</html>


