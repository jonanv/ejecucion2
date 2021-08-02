<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new hojavidaModel();	
			
	$idusuario   = $_SESSION['idUsuario'];
	
	$nom_usuario = $_SESSION['nomusu'];
	
	$permiso_hv  = $modelo->get_permiso_manejo_HV($idusuario);
	
	//echo $nom_usuario;
	
	//TITULO FORMULARIO
	$titulo     = "HOJA DE VIDA";
	$subtitulo  = "HOJA DE VIDA";
	

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	$nombrelista  = 'hv_perfil';
	$campoordenar = 'des';
	$datosperfil  = $modelo->get_lista($nombrelista,$campoordenar);
	
	
	$nombrelista  = 'hv_estadocivil';
	$campoordenar = 'des';
	$datosec      = $modelo->get_lista($nombrelista,$campoordenar);
	
	//PREGUNTA REALIZADA CUANDO SE ADICONA UN ESTUDIO DESDE estudios_hojavida.php
	//Y ACTUALIZA LA VISTA hojavida_genera.php CON EL NUEVO ESTUDIO TABLA ESTUDIOS
	//SIN NECESIDAD DE VOLVER A ESCRIBIR LA CEDULA
	if(!empty($_GET['opcion'])){
		
		$hvcedula_s = $_GET['datosx'];
	
	}

	echo '<script languaje="JavaScript">
            
      	var folder_usuario_1 ="'.$idusuario.'";
		
		var cedula_usuario   ="'.$nom_usuario.'";
            
	</script>';
	
	//LISTA ESTUDIOS
	//$datos_estudios = $modelo->get_lista_estudios($id_hv);
	
	/*PARA QUE UN USUARIO UBICADO EN LA TABLA pa_usuario_acciones, REGISTRO id = 8 PUEDA
	CONSULTAR OTRAS HOJAS DE VIDA*/
	$campos                  = 'usuario';
	$nombrelista             = 'pa_usuario_acciones';
	$idaccion			     = '8';
	$campoordenar            = 'id';
	$datosusuarioacciones_hv = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_hv             = $datosusuarioacciones_hv->fetch();
	$usuariosa_hv			 = explode("////",$usuarios_hv[usuario]);
	
	
	if( in_array($idusuario,$usuariosa_hv,true) ){
		
		$id_user_admin = 1;
	}
	else{
	
		$id_user_admin = 0;
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
<script src="views/js/jquery_NV.js" type="text/javascript"></script>

<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>

<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_hojavida.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">


<!-- PARA EL FUNCIONAMIENTO DEL ARBOL ESTILO WINDOWS PARA LISTAR LOS ARCHIVOS SCANEADOS -->
<link rel="stylesheet" type="text/css" href="views/viewstree/jqueryFileTree.css" media="screen" />
<!-- <script type="text/javascript" src="jquery-1.3.2.min.js"></script> -->
<script type="text/javascript" src="views/viewstree/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="views/viewstree/jqueryFileTree.js"></script>


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
	
	
	//PARA LAS FECHAS
	$("#hvfn").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	$("#hvfip").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#hvffp").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	//SI EL USUATIO YA HA INGRESADO INFORMACOON DE SU HOJA DE VIDA
	//EL SISTEMA LLAMA LA FUNCION CON LA VARIABLE cedula_usuario
	//QUE CARGA LA INFORMACION DE UNA VARIABLE PHP ($nom_usuario = $_SESSION['nomusu'];)
	//CON LA CEDULA DEL USUARO EN SESION
	//ESTO CON EL OBJETO DE QUE AL ENRAR AL FORMULARIO NO SE DIGITE LA CEDULA
	//PARA CARGAR LA INFORMA, SI NO QUE EL SISTEMA LO HAGA AUTOMATICAMNETE 
	//Traer_Datos_Hoja_Vida(cedula_usuario);
	
});



</script>	



<!-- Creamos un estilo para nuestro documento -->
	<style type="text/css">
		
		.mensage_hvg{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
	</style>

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		//require 'secc_arancel.php';
		require 'secc_administrar.php';
		
		
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
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						<input name="id_hv" id="id_hv" type="hidden" readonly="true">
						
						<input name="id_usuario" id="id_usuario" type="hidden" readonly="true" value="<?php echo $idusuario?>"/>
						
						<input name="nom_usuario" id="nom_usuario" type="hidden" readonly="true" value="<?php echo $nom_usuario?>"/>
						
						<!-- PARA QUE UN USUARIO UBICADO EN LA TABLA pa_usuario_acciones, REGISTRO id = 8 PUEDA
						CONSULTAR OTRAS HOJAS DE VIDA, AUN ESTA A PRUEBA -->
						<input name="id_user_admin" id="id_user_admin" type="hidden" readonly="true" value="<?php echo $id_user_admin?>">
						
					 	<!-- <div id="titulo_frm"><?php echo strtoupper($titulo); ?></div> -->
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							<!-- <tr>
								<td>
									<label style="width:151px; color:#666666">Radicado:</label>
								</td>
								<td>
									<input type="text" name="radicado" id="radicado" class="required number" maxlength="23" minlength="23" value="170014003"/>
								</td>
								
							</tr> -->
							
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("DATOS PERSONALES"); ?></div></center>
									
								</td>
							
							</tr>
							
							<tr>
							
								<td colspan="3">
									
									<a class="generar_hojavida_pdpf" href="javascript:void(0);" style="font-size:16px"><img src="views/images/hv_4.png" width="100" height="100" title="GENERAR HV"/>GENERAR HV</a>
									
								</td>
							
							</tr>
	
							<tr>
								<td>
									<label style="width:151px; color:#666666">Foto:</label>
								</td>
								
								<td>
									<!-- <input type="file" name="archivo" id="archivo" title="Foto" size="19"/> -->
									<div id="foto" style="width:20px; height:130px">
										<img src="views/fotos/hv_6.png" width="110" height="125"/>
										
									</div>
								</td>
								
								<td>
									<!-- <button id="enviar"><img src="views/images/np.png" width="35" height="35" title="CAMBIAR FOTO"/><h1>CAMBIAR FOTO</h1></button> -->
									
									<a class="subir_hojavida" href="javascript:void(0);"  style="float:right">CAMBIAR FOTO<img src="views/images/hv_6.png" width="35" height="35" title="CAMBIAR FOTO"/></a>
									
									
								</td>
							
							</tr>
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Cedula:</label>
								</td>
								<td colspan="2">
												
									<input type="text" name="hvcedula" id="hvcedula" class="required" onkeyup="Traer_Datos_Hoja_Vida(this.value)"/>
								</td>
											
							</tr>
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Nombre:</label>
								</td>
								<td colspan="2">
												
									<input type="text" name="hvnombre" id="hvnombre" class="required"/>
								</td>
											
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha de Nacimiento:</label>
								</td>
								<td colspan="2">
									<input type="text" name="hvfn" id="hvfn" class="required" readonly="true">
								</td>
								
							
							</tr>
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Direccion:</label>
								</td>
								<td colspan="2">
												
									<input type="text" name="hvdireccion" id="hvdireccion" class="required"/>
								</td>
											
							</tr>
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Correo:</label>
								</td>
								<td colspan="2">
												
									<input type="text" name="hvcorreo" id="hvcorreo" class="required"/>
								</td>
											
							</tr>
							
						
							
							<tr>
								
								<td>
											
									<label style="width:151px; color:#666666">Cargo:</label>
												
											
								</td>
											
								<td colspan="2">
															
										<select name="hvperfil" id="hvperfil" class="required">
												
													
										<option value="" selected="selected">Seleccionar Perfil</option>
															
										<?php
											while($row = $datosperfil->fetch()){
																		
												echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																	
											}
										?>
										</select>
								</td>
											
							</tr>
							
							<tr>
								
								<td>
											
									<label style="width:151px; color:#666666">Estado Civil:</label>
												
											
								</td>
											
								<td colspan="2">
															
										<select name="hvestadocivil" id="hvestadocivil" class="required">
												
													
										<option value="" selected="selected">Seleccionar Estado Civil</option>
															
										<?php
											while($row = $datosec->fetch()){
																		
												echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																	
											}
										?>
										</select>
								</td>
											
							</tr>
							
							
							<tr>
											
											
								<td>
									<label style="width:151px; color:#666666">Telefono / Celular:</label>
								</td>
								<td colspan="2">
												
									<input type="text" name="hvtelefono" id="hvtelefono" class="required"/>
								</td>
											
							</tr>
							
							
							<tr>
					
							
							<td>
								<label style="width:151px; color:#666666">Pefil Ocupacional:</label>
							</td>
								
							<td colspan="2">
								
								<textarea name="hvpocupacional" id="hvpocupacional" cols="44" rows="15" class="required" maxlength = "10000"></textarea>
												
							</td>
							
							
						<?php 	
						
						if($permiso_hv == 1 ){	
						
						?>
							
						</tr>
						
						
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id="fila_botones">
							
								
								<td colspan="3">
									<!-- SE PREGUNTA SI LA VARIABLE $vbton NO ES VACIA, YA QUE ESTO NOS INDICA QUE VAMOS A ACTUALIZAR UN DOCUMENTO
									Y POR ENDE EL VALOR PASA A Actualizar-->
									<center>
										<!-- <input type="submit" name="Submit" class="btn_validar" value="Registrar" id="btn_input"/> -->
										<input type="submit" name="Submit" value="Registrar" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->	
					
							<!-- <tr>
								<td colspan="3">
									<div id="ok"></div>
								</td>
							</tr> -->
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="estudios_hojavida" href="javascript:void(0);"  style="float:left; color:#004080"><img src="views/images/hv_1.png" width="55" height="55" title="ADICIONAR ESTUDIOS"/>ADICIONAR ESTUDIOS</a>
									
								</td>
							
							</tr>
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("ESTUDIOS"); ?></div></center>
									
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_estudios" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_es"> 
													<table id="t_es" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>
															<!-- <td><B>ID MODALIDAD</B></td> -->
															<td><B>MODALIDAD</B></td>
															<!-- <td><B>ID TIPO MODALIDAD</B></td> -->
															<td><B>TIPO MODALIDAD</B></td>
															<td><B>INSTITUCION</B></td>
															<td><B>CERTIFICADO</B></td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="experiencia_hojavida" href="javascript:void(0);"  style="float:left; color:#004080"><img src="views/images/hv_2.png" width="55" height="55" title="ADICIONAR EXPERIENCIA LABORAL"/>ADICIONAR EXPERIENCIA LABORAL</a>
									
								</td>
							
							</tr>
							
							
							
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("EXPERIENCIA LABORAL"); ?></div></center>
									
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_experiencia" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_ex"> 
													<table id="t_ex" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>															
															<td><B>ENTIDAD</B></td>
															<td><B>DIRECION</B></td>
															<td><B>TELEFONO</B></td>
															<td><B>PERIODO</B></td>
															<td><B>CARGO</B></td>
															<td><B>CERTIFICADO</B></td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="acto_hojavida" href="javascript:void(0);"  style="float:left; color:#004080"><img src="views/images/hv_7.png" width="55" height="55" title="ADICIONAR ACTO ADMINISTRATIVO"/>ADICIONAR ACTO ADMINISTRATIVO</a>
									
								</td>
							
							</tr>
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("ACTO ADMINISTRATIVO"); ?></div></center>
									
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_estudios" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_ad"> 
													<table id="t_ad" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>
															<td><B>NUN RESOLUCION</B></td>
															<td><B>MOTIVO</B></td>
															<td><B>FECHA</B></td>
															<td><B>ACTA</B></td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="antecedentes_hojavida" href="javascript:void(0);"  style="float:left; color:#004080"><img src="views/images/memo.png" width="55" height="55" title="ADICIONAR ANTECEDENTES / CERTIFICADOS"/>ADICIONAR ANTECEDENTES / CERTIFICADOS</a>
									
								</td>
							
							</tr>
							
							
							
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="concimientos_hojavida" href="javascript:void(0);"  style="float:left; color:#004080"><img src="views/images/hv_5.jpg" width="65" height="55" title="ADICIONAR CONOCIMIENTO"/>ADICIONAR CONOCIMIENTO</a>
									
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("CONOCIMIENTOS"); ?></div></center>
									
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_referencia" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_co"> 
													<table id="t_co" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>															
															<td><B>CONOCIMIENTO</B></td>
															
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							
							<tr>
							
								<td colspan="3" style="background-color:#DDEEFF">
									
									<a class="referencia_hojavida" href="javascript:void(0);"  style="float:left"><img src="views/images/hv_3.png" width="65" height="55" title="ADICIONAR REFERENCIAS"/>ADICIONAR REFERENCIAS</a>
									
								</td>
							
							</tr>
							
							
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("REFERENCIAS"); ?></div></center>
									
								</td>
							
							</tr>
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_referencia" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_ref"> 
													<table id="t_ref" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>															
															<td><B>NOMBRE</B></td>
															<td><B>DIRECION</B></td>
															<td><B>TELEFONO</B></td>
															<td><B>PROFESION</B></td>
															<td><B>REFERENCIA</B></td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("GENERAR SOPORTE"); ?></div></center>
									
								</td>
							
							</tr>
							
			
							
							<tr>
							
								<td colspan="3">
								
									<table border="3" align="center" id="tabla_soporte_estudios" style="width:700px">
			
			
										
										<tr>
											<td>
												<div id="JQueryFTD_Demo_1" class="demo" data-idusuario="<?php echo trim($idusuario);?>"></div>
											</td>
										</tr>
								
												
									</table>
								
								</td>
							
							</tr> 
							
							
							
							<tr>
								<td colspan="3">
									<!-- MENSAJES AL ELIMINAR UN SOPORTE-->
									<div class="mensage_hvg"></div>  
								</td>
							</tr>
							
							
							
							<tr>
							
								<td colspan="3">
									
									
									<center><div id="titulo_frm"><?php echo strtoupper("ELIMINAR SOPORTE"); ?></div></center>
									
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_eliminar" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_elimi"> 
													<table id="t_elimi" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>															
															<td><B>ID ARCHVIO CENTRAL</B></td>
															<td><B>RUTA</B></td>
															<td><B style="color:#FF0000">ELIMINAR</B></td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							
							<tr>
							
								<td colspan="3">
						
									<table border="3" align="center" id="tabla_soporte_eliminar_2" style="width:700px">
	
										<tr>
											<td>
												<div id="cont_elimi_2"> 
													<table id="t_elimi_2" border="1"> 
														<tr>
															
															<td><B style="color:#FF0000">ID</B></td>															
															<td><B>ID ARCHVIO CENTRAL</B></td>
															<td><B>RUTA</B></td>
															<td><B style="color:#FF0000">ELIMINAR</B></td>
															
														</tr>  
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							<?php 	
							
							}else{//FIN if($permiso_hv == 1 )		
						
							?>
							
							<tr>
								<td colspan="3">
									<center><B style="color:#FF0000; font-size:16px">USUARIO NO CUENTA CON EL PERMISO PARA EDITAR HOJA DE VIDA</B></center>
								</td>
							</tr>
							
							
							<?php 	
							
							}
						
							?>
							
						</table>
					
					 </form> 
			
				</div>
				
			</td>
		</tr>
		
	</table>
	
	<br>
	
	
<?php require 'alertas.php';?>

<?php 

	
		
		//SE REALIZA ESTOS LLAMADOS PARA REFRESCAR EL FORMULARIO DE FORMA QUE EL USUARIO
		//NO ACTUALICE POR ERROR Y SE GENEREN REGISTROS EN LA BASE DATOS QUE NO SON CORRECTOS
		if(!empty($hvcedula_s)){
		
			
			$drx   = $hvcedula_s;
			
			
			echo '<script languaje="JavaScript"> 
						
					var dat_1 = "'.$drx.'";
							
					Traer_Datos_Hoja_Vida(dat_1);
									
				</script>';
			

	 	}
		
			
?>


</body>
</html>


