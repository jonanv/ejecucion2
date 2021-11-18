<?php 
	

	//TITULO FORMULARIO
	$titulo     = "REGISTRO PARA ARCHIVO MASIVO";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
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
<script src="views/js/ajax/ajax_siepro_masivo.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

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
				
				<div id="contenido">
				
					<form id="frm_masivo3" name="frm_masivo3"  method="post" enctype="multipart/form-data" action="">
					
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha:</label>
								</td>
								<td>
									<input type="text" name="fechae_3" id="fechae_3" class="required" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Archivo</label>
								</td>
								<td>
									<input type="file" name="archivo" id="archivo" class="required" title="Archivo"/>
								</td>
							
							</tr>
							
							<!-- <tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr> -->
							
							<tr id="imgloading_masivo">
								
								<td colspan="2">
									<center>
										
									
										<img src="views/images/loading4.gif" width="400" height="100"/>
											
									</center>
								</td> 
								
						  	</tr>
		
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id= "filabotones_masivo">
								
								<td colspan="2">
									
									<center>
										<input type="submit" name="Submit" value="Registrar" id="btn_input" class="visualizar3"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar3"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
							<tr>
								<td colspan="4">
									
									<center>
									
										<label style="width:151px; color:#FF0000">ESTRUCTURA ARCHIVO EN EXCEL (SIN ENCABEZADOS, SOLO LOS RADICADOS)</label>
									
									</center>
								</td>
								
						
							</tr>
							
							<tr>
								<td colspan="4">
									
									<center>
									
										<label style="width:151px; color:#FF0000">GUARDAR EL ARCHIVO A PROCESAR CSV(delimitado por comas)</label>
									
									</center>
								</td>
								
							</tr>
							
							<tr>
								
								<td colspan="3">
									<center>
										
										<img src="views/images/encabezadodespacho_2.jpg" width="400" height="400"/>
											
									</center>
								</td> 
								
						  	</tr>
				
						</table>
					
					</form>
			
				</div>
				
			</td>
		</tr>
		
	</table>
		
		
		
<?php 
	require 'alertas.php';
	
	
	echo '<script languaje="JavaScript"> 
			
	
				$("#imgloading_masivo").hide();
				
						
		</script>';
?>
</body>
</html>


