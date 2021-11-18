<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "Registro Aranceles";
	$subtitulo  = "Listado Aranceles";
	$subtitulo2 = "Total";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new aranceljudicialModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//OBTENESMO EL LISTADO DE ARANCELES A LIQUIDAR
	$datosarancel = $modelo->get_lista_arancel();
	
	
	//OBTENEMOS DATOS DEL PROCESO
	$idradicado = trim($_GET['idradicado']);
	
	$datosproceso   = $modelo->get_datos_proceso($idradicado);
	$fdatos         = $datosproceso->fetch();
	$idpro	        = $fdatos[idproceso];
	$radi	        = $fdatos[radicado];
	$cde	        = $fdatos[cedula_demandante];
	$nde	        = $fdatos[demandante];
	$cdo	        = $fdatos[cedula_demandado];
	$ndo	        = $fdatos[demandado];
	$idjo	        = $fdatos[idjuzgadoorigen];
	$njo	        = $fdatos[nombrejuzgadoorigen];
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	/*$nombrelista  = 'pa_juzgado';
	$campoordenar = 'id';
	$formaordenar = '';
	$datosjuzgado = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	//OBTENEMOS JUZGADO USUARIO, Y PARTE DEL RADICADO EJ: 170014003001 
	$usuariojuzgado = $modelo->get_juzgado_usuario();
	$uj             = $usuariojuzgado->fetch();
	$uj1	        = $uj[id];
	$uj2	        = $uj[nombre];
	$uj3	        = $uj[numero_juzgado];
	$uj4	        = $uj[radicadojuzgado];
	
	if($uj3 >= 1 && $uj3 <= 9){
		$uj4 = $uj4."00".$uj3;
	}
	else{
		$uj4 = $uj4."0".$uj3;
	}*/

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
<script src="views/js/ajax/ajax_aranceles.js" type="text/javascript" charset="utf-8"></script>

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
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<!-- <input name="consecutivodocumento" id="consecutivodocumento" type="hidden" readonly="true"/> -->
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input name="idradicado" id="idradicado" type="hidden" readonly="true"  value="<?php echo $idpro; ?>"/>
									<input type="text" name="radicado" id="radicado" readonly="true"  value="<?php echo $radi; ?>"/>
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2"> 
								
									<table border="0" align="center" width="800">
									
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandante</label><br><br>
												<input type="text" name="cedula_demandante" id="cedula_demandante" class="required" readonly="true" value="<?php echo $cde; ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandante</label><br><br>
												<input type="text" name="demandante" id="demandante" class="required" readonly="true" value="<?php echo $nde; ?>"/>
											</td>
											
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
												<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true" value="<?php echo $cdo; ?>"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandado</label><br><br>
												<input type="text" name="demandado" id="demandado" class="required" readonly="true" value="<?php echo $ndo; ?>"/>
											</td>
											
										</tr>
										
										<!-- <tr>
											<td>
												<label style="width:151px; color:#666666">Juzgado Origen</label><br><br>
												<input type="text" name="jo" id="jo" class="required" readonly="true"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Juzgado Destino</label><br><br>
												<input type="text" name="jd" id="jd" class="required" readonly="true"/>
											</td>
											
										</tr>
										
										<tr>
											<td colspan="2">
												<label style="width:151px; color:#666666">Clase Proceso</label><br><br>
												<input type="text" name="claseproceso" id="claseproceso" class="required" readonly="true"/>
											</td>
											
										</tr> -->
										
									</table>
									
								</td>
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechal" id="fechal" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Juzgado:</label>
			
								</td>
								
								<td>
									<input type="text" name="userjuzgado" id="userjuzgado" class="required" value="<?php echo $njo; ?>" readonly="true">
									<input type="hidden" name="juzgadoorigen" id="juzgadoorigen" class="required" value="<?php echo $idjo; ?>" readonly="true">
								</td>
								
							</tr>
							
							<tr>
								<td colspan="2"> 
								
									<table border="0">
									
										<tr>
											<td>
												<label style="width:151px; color:#666666">Observacion</label><br><br>
												<textarea name="observacion" id="observacion" cols="110" rows="5" maxlength = "100000" class="required"></textarea>
											</td>
											
										</tr>
										
									</table>
									
								</td>
							</tr>
							
				
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<!-- <tr>
								
								<td colspan="2"> -->
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<!-- <center>
										<input type="submit" name="Submit" class="btn_validar" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center> -->
								<!-- </td> 
								
						  	</tr> -->
							
							<!-- ----------------------------------------------------------------------------------------------- -->
							
							<tr>
								
								<td colspan="2">
								
				
									<table border="0" align="center"  rules="rows" id="tablaconsulta">
			
				
										<tr>
											
											<td>
											
												<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
																
													<thead> 
													
																<tr>
																	<th bgcolor="#CDE3F9" colspan="16">
																		<center><div id="titulo_frm"><?php echo strtoupper($subtitulo); ?></div></center>
																	</th>
																</tr>
																
																<tr> 
																	<th>ID</th>
																	<th>ARANCEL</th>
																	<th>VALOR</th>
																	<th>PAGINAS</th>
																	<th>SUBTOTAL</th>
																	<th>-</th>
																</tr> 
															</thead> 
																			
															<tbody> 
																
																
																<?php $i=2; while($row = $datosarancel->fetch()){ ?>
														
																	<tr>
																	
																		<td><input type="text" name="<?php echo "ida".$i;?>" id="<?php echo "ida".$i;?>" value="<?php echo $row[id];?>" readonly="true"/></td>
																		<td><?php echo $row[nombrearancel];?></td>
																		<td><?php echo $row[valor];?></td>
																		
																		<?php if($i == 9){ ?>
																		<td><input type="text" name="<?php echo "pagina".$i;?>" id="<?php echo "pagina".$i;?>" onKeyPress="return Solo_Numeros(event)" value="1"/></td>
																		<?php } 
																		      else{ ?>
																		<td><input type="text" name="<?php echo "pagina".$i;?>" id="<?php echo "pagina".$i;?>" onKeyPress="return Solo_Numeros(event)"/></td>
																		<?php } ?>
																		
																		<td><input type="text" name="<?php echo "subtotal".$i;?>" id="<?php echo "subtotal".$i;?>" readonly="true" value="0" style="text-align:right"/></td>
																		<!-- <td><input type="checkbox" name="<?php //echo "chkk".$i;?>" id="<?php //echo "chkk".$i;?>" value="<?php //echo "chkk".$i;?>"/></td>  -->
																		
																		
																		<td><a class="calcular" href="javascript:void(0);" data-id="<?php echo $row['id'];?>" data-valor="<?php echo $row['valor'];?>" data-paginas="<?php echo "pagina".$i;?>" data-subtotal="<?php echo "subtotal".$i;?>" data-chk="<?php echo "chkk".$i;?>"><input type="checkbox" name="<?php echo "chkk".$i;?>" id="<?php echo "chkk".$i;?>" value="<?php echo "chkk".$i;?>"/></a></td> 
																		
																		
																	
																		<!-- <td><a class="editare" href="javascript:void(0);" data-id="<?php //echo $row['id'];?>"><img src="views/images/modficar.jpg" width="35" height="35" title="EDITAR DOCUMENTO"/></a></td> -->
										
																		<!--<td><a class="darrespuesta" href="javascript:void(0);" data-idrespuesta="<?php //echo $row['id'];?>" data-fecharespuesta="<?php //echo $row['fecharespuesta'];?>"><img src="views/images/respuesta.gif" width="35" height="35" title="DAR RESPUESTA DOCUMENTO"/></a></td> -->
																			
																		
																		
																		
																	</tr>
																	
																
																<?php $i=$i+1; } ?>
																
																	<tr>
																		<td></td>
																		<td></td>
																		<td></td>
																		
																		<td>
																			<label id="msgtotal"><?php echo strtoupper($subtitulo2); ?></label>
																			
																		</td>
																		
																		<td colspan="2">
																			<input type="text" name="totalaranceles" id="totalaranceles" readonly="true" value="0" style="text-align:right "/>
																		</td>
																		
																	</tr>
																			
															</tbody>
													</table>
											
												</td>
											</tr>
				
				
									</table>		
									
								
								</td> 
								
						  	</tr>
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="2">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<input type="submit" name="Submit" class="btn_validar" value="<?php if(empty($vbton)){ echo "Registrar";}else{echo "Actualizar";} ?>" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
				
						</table>
					
					 </form> 
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	<br>
	
	<?php 

	//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
	//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
	echo '<script languaje="JavaScript"> 
									
				Valores_Estaticos();
						
		</script>';
			
	?>
			
			

<?php require 'alertas.php';?>
</body>
</html>


