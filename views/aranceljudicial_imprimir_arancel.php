<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "Imprimir Liquidacion Arancel";
	//$subtitulo  = "Listado Liquidaciones, Usuario: ".$_SESSION['nombre'];
	$subtitulo  = "Listado Liquidaciones";
	$subtitulo2 = "Total";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new aranceljudicialModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//OBTENESMO EL LISTADO DE ARANCELES A LIQUIDAR
	$datosarancel = $modelo->get_lista_arancel();
	
	//OBTENEMOS LISTADO SEGUN LA LISTA SOLICITADA
	$nombrelista  = 'pa_usuario';
	$campoordenar = 'empleado';
	$formaordenar = '';
	$datosusuario = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	//SE REALIZA ESTA OPERACION PARA QUE EL SISTEMA IDENTIFIQUE USUARIOS
	//QUE PUEDEN VER LIQUIDACIONES DE LA FECHA ACTUAL Y NO LAS QUE HAGA ESE USUARIO ESPECIFICO
	//Y PARA ESTO SE TOMA LA INFOMACION DE LA FUNCION get_liquidaciones_imprimir_usuario_actual
	/*$campos               = 'usuario';
	$nombrelista          = 'pa_usuario_acciones';
	$idaccion			  = '9';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosad			  = explode("////",$usuarios[usuario]);*/

	$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
		
		$datosliquidaciones = $modelo->get_liquidaciones_imprimir_usuario(1);
		
		//CONTAR REGISTROS
		$conteoregistros = 0;
		$datosliquidaciones_conteo = $modelo->get_liquidaciones_imprimir_usuario(1);
		while($row2 = $datosliquidaciones_conteo->fetch()){
			$conteoregistros = $conteoregistros + 1;
		}
	}
	else{
		
		$datosliquidaciones = $modelo->get_liquidaciones_imprimir_usuario(2);
		
		//CONTAR REGISTROS
		$conteoregistros = 0;
		$datosliquidaciones_conteo = $modelo->get_liquidaciones_imprimir_usuario(2);
		while($row2 = $datosliquidaciones_conteo->fetch()){
			$conteoregistros = $conteoregistros + 1;
		}
			
	}
	
	
	
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
	$idaccion			  = '6';
	$campoordenar         = 'id';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosa			  = explode("////",$usuarios[usuario]);
	
	$idaccion			  = '7';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosab			  = explode("////",$usuarios[usuario]);
	
	$idaccion			  = '8';
	$datosusuarioacciones = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios             = $datosusuarioacciones->fetch();
	$usuariosac			  = explode("////",$usuarios[usuario]);*/
	

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
									<label style="width:151px; color:#666666">Fecha Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Fecha Final:</label>
								</td>
								<td>
									<input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>
							
							</tr>
							
							<!--<tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td colspan="4"> 
									<input type="text" name="radicado3" id="radicado3" class="required number" maxlength="23" minlength="23" value="<?php echo trim($_GET['datox1']); ?>"/>
								</td>
								
							</tr>
							
							 <tr>
								<td colspan="4"> 
								
									<table border="0" align="center" width="800">
									
										
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandante</label><br><br>
												<input type="text" name="cedula_demandante" id="cedula_demandante" class="required" readonly="true"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandante</label><br><br>
												<input type="text" name="demandante" id="demandante" class="required" readonly="true"/>
											</td>
											
										</tr>
										<tr>
											<td>
												<label style="width:151px; color:#666666">Cedula Demandado</label><br><br>
												<input type="text" name="cedula_demandado" id="cedula_demandado" class="required" readonly="true"/>
											</td>
											<td>
												<label style="width:151px; color:#666666">Demandado</label><br><br>
												<input type="text" name="demandado" id="demandado" class="required" readonly="true"/>
											</td>
											
										</tr>
										
										
									</table>
									
								</td>
							</tr> -->
							
							
							
							<tr>
							
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td> 
									<input type="text" name="radicado3" id="radicado3" class="required number" maxlength="23" minlength="23" value="<?php echo trim($_GET['datox1']); ?>"/>
								</td>
								
								<td>
									<label style="width:151px; color:#666666">Usuario:</label>
			
								</td>
								
								<td>
									
									<select name="listausuario" id="listausuario" class="required">
                 		
										<option value="" selected="selected">Seleccionar Usuario</option>
									
										<?php
											while($row = $datosusuario->fetch()){
											
												//echo "<option value=\"". $row[id]."\">" . $row[empleado] . "</option>";
												
												
												if($row[id] == trim($_GET['datox2'])){
													echo "<option value=\"". $row[id] ."\" selected='selected'>" . $row[empleado] . "</option>";
												}
												else{
													echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
												}
											
											}
										?>
									</select>
								</td>
								
							</tr>
							
						
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr>
								
								<td colspan="4">
									<center>
										<!-- <input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrare3" title="APLICA SOLO PARA EL FILTRO CON LAS FECHAS y RADICADO, YA QUE LOS REGISTROS EN LA TABLA SON LOS DEL USUARIO QUE ESTA ACTUALMENTE EN SESION, POR ENDE NO SE FILTRA POR USUARIO Y SI EL USUARIO NO A REALIZADO NINGUN REGISTRO, EN LA TABLA NO SE CARGARA NINGUNA FILA"> -->
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrare3"/>
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
	//PREGUNTO SI SE A ENVIADO ALGUN FILTRO PARA QUE LA TABLA SEA VISIBLE.
	//if(!empty($opcion)){ 
	?>
	<table border="0" align="center"  rules="rows" id="tablaconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
										
							<thead> 
							
										<tr>
											<th bgcolor="#CDE3F9" colspan="16">
												<center><div id="titulo_frm"><?php echo "CANTIDAD: ".$conteoregistros." / ".strtoupper($subtitulo); ?></div></center>
											</th>
										</tr>
										
										<tr> 
											<th>ID</th>
											<th>NUMERO</th>
											<th>FECHA</th>
											<th>RADICADO</th>
											<th>REGISTRA</th>
											<th>OBSERVACION</th>
											<!-- <th>ESTADO</th>
											<th>ANULADA</th> -->
											<th><a class="estadistica" href="javascript:void(0);"><img src="views/images/estadisdoc.png" width="35" height="35" title="ESTADISTICA ARANCEL(APLICA PARA TODOS FILTROS)"/></a></th>
											<th><a class="reportearancel" href="javascript:void(0);"><img src="views/images/icono_word.gif" width="35" height="35" title="REPORTE ARANCEL(APLICA PARA LOS FILTROS DE LAS FECHAS)"/></a></th>
											
										</tr> 
									</thead> 
													
									<tbody> 
										
										
										<?php $i=2; while($row = $datosliquidaciones->fetch()){ ?>
								
											<tr>
												<td><?php echo $row[id];?></td>
												<td><?php echo $row[numl];?></td>
												<td><?php echo $row[fechal];?></td>
												<td><?php echo $row[radicado];?></td>
												<td><?php echo $row[empleado];?></td>
												<td><?php $newtext = wordwrap($row[observacionl], 20, "\n", true); echo $newtext;?></td>
												<!-- <td><?php //echo $row[estado];?></td>
												<td><?php //echo $row[estado2];?></td> -->
												
												<td></td>
												
												<td><a class="imprimirliquidacion" href="javascript:void(0);" title="IMPRIMIR" data-id="<?php echo $row['id'];?>" data-numl="<?php echo $row['numl'];?>"><img src="views/images/pdf-icono.png" width="35" height="35" title="IMPRIMIR"/></a></td>
												
												
												
													
											</tr>
									
										<?php $i=$i+1; } ?>
													
									</tbody>
							</table>
						
						</td>
					</tr>
			
			
			</table>		
			
			<?php
			//} 
			?>
	

<?php require 'alertas.php';?>
</body>
</html>


