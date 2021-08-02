<?php 
	
	//TITULO FORMULARIO
	$titulo     = "LINK AUTOS ESTADOS";
	$titulo_2   = "GENERAR ESTADOS";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//$fechaactual = '2016-12-14';
	
	$campos         = 'usuario';
	$nombrelista    = 'pa_usuario_acciones';
	$idaccion	    = '23';
	$campoordenar   = 'id';
	$datosusuarioNE = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosNE1    = $datosusuarioNE->fetch();
	$usuariosaNE2	= explode("////",$usuariosNE1[usuario]);
	
	if ( in_array($_SESSION['idUsuario'],$usuariosaNE2,true) ){
	
		$nombrelista  = 'pa_juzgado';
		$campoordenar = 'id';
		$filtro       = 'WHERE id IN (1,2,3,4,5,6,7,8,9,10,11,12,15,16)';
		$formaordenar = '';
		$datosjuzgado = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
	
	}
	else{
	
		$nombrelista  = 'pa_juzgado';
		$campoordenar = 'nombre';
		$filtro       = 'WHERE id IN (15,16)';
		$formaordenar = '';
		$datosjuzgado = $modelo->get_lista_filtro($nombrelista,$campoordenar,$filtro,$formaordenar);
	
	}
	
	$ip_plataforma = trim($_SESSION['ipplataforma']);
	
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
<script src="views/js/jquery_NV.js" type="text/javascript"></script>

<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>  -->

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
<script src="views/js/ajax/ajax_siepro_masivo.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
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
	
	var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
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
	$("#fechae_2A").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'});
	$("#fechai_proc").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'});
	$("#fechaf_proc").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'});
	
	
	//var date = $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();

	$("#fechae_2B").click(function(event){
								   
		
		//alert("CALCULANDO...");
	
			var fechat = document.frm_masivo2B.fechae_2A.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+fechat, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				$("#fechae_2B").val(fii);
				
	
			});


	});
	
	$(".estados_auto").click(function(){
	
		
		
		var bandera = 0;
		
		valor1 = document.getElementById('fechae_2A').value;
		valor4 = document.getElementById('juzgadoauto').value;
		
		
		if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
			
			alert("Defina Fecha Actual");
			document.getElementById('fechae_2A').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		
		if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
			alert("Defina Juzgado");
			document.getElementById('juzgadoauto').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		if (bandera == 1) {
		
        	return false;
    	} 
		else{
			
			var dato_0 = 2000;
			
			valor_juzgado_idjxxi = valor4.split("******");
			valor_juzgado_idjxxi_b = valor_juzgado_idjxxi[1];
			
			//alert("IMPRIMIENDO ESTADO "+valor_juzgado_idjxxi_b);
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+dato_0+"&valor1="+valor1+"&valor_juzgado_idjxxi_b="+valor_juzgado_idjxxi_b;
			
		}
	
	});
	
	$(".estados_auto_nuevo").click(function(){
	
		
		
		var bandera = 0;
		
		valor1 = document.getElementById('fechai_proc').value;
		valor2 = document.getElementById('fechaf_proc').value;
		valor4 = document.getElementById('juzgadoauto').value;
		
		
		if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
			
			alert("Defina Fecha Inicial");
			document.getElementById('fechai_proc').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
			
			alert("Defina Fecha Final");
			document.getElementById('fechaf_proc').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		
		if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
			alert("Defina Juzgado");
			document.getElementById('juzgadoauto').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		if (bandera == 1) {
		
        	return false;
    	} 
		else{
			
			var dato_0 = 6000;
			
			valor_juzgado_idjxxi = valor4.split("******");
			valor_juzgado_idjxxi_b = valor_juzgado_idjxxi[1];
			
			//alert("IMPRIMIENDO ESTADO "+valor_juzgado_idjxxi_b);
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+dato_0+"&valor1="+valor1+"&valor_juzgado_idjxxi_b="+valor_juzgado_idjxxi_b+"&valor2="+valor2;
			
		}
	
	});

	
	$(".estados_auto_pdpf").click(function(){
	
		
		
		var bandera = 0;
		
		valor1 = document.getElementById('fechae_2A').value;
		valor2 = document.getElementById('fechae_2B').value;
		valor3 = document.getElementById('nun_estado').value;
		valor4 = document.getElementById('juzgadoauto').value;
		
		
		if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
			
			alert("Defina Fecha Actual");
			document.getElementById('fechae_2A').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
			
			alert("Defina Fecha Estado");
			document.getElementById('fechae_2B').style.borderColor = '#FF0000';
			return false;
		}
		
		if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
			
			alert("Defina Numero Estado");
			document.getElementById('nun_estado').style.borderColor = '#FF0000';
			return false;
		}
		
		
		if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
			alert("Defina Juzgado");
			document.getElementById('juzgadoauto').style.borderColor = '#FF0000';
			
			bandera = 1;
			
			return false;
		}
		
		if (bandera == 1) {
		
        	return false;
    	} 
		else{
			
			var dato_0 = 2000;
			
			//valor_juzgado_idjxxi = valor4.split("******");
			//valor_juzgado_idjxxi_b = valor_juzgado_idjxxi[1];
			
			//alert("IMPRIMIENDO ESTADO "+valor_juzgado_idjxxi_b);
			
			//location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+dato_0+"&valor1="+valor1+"&valor_juzgado_idjxxi_b="+valor_juzgado_idjxxi_b;
			
			//ipservidor = "190.217.24.24";
			
			ipservidor = ip_servidor;
			
			window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/ESTADO_SINLINK.php?fechae_2A="+valor1+"&fechae_2B="+valor2+"&nun_estado="+valor3+"&juzgadoauto="+valor4);
			
		}
	
	});
	
	
	 //ME PERMITE SUBIR MULTIPLES ARCHIVOS A LA CARPETA C:/AUTOS_ESTADOS/
	$(".subir_archivos").click(function(){
		
			
			params={};
			
			/*params.id_planilla      = id_planilla;*/
			
			$('#popupbox').load('views/popupbox/subir_autos.php',params,function(){
					//alert(2);
					$('#block').show();
					//alert(3);
					$('#popupbox').show();
					//alert(4);
			});
			
		
	
	});
	
	
	
	
	
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
	
	<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
	<div id ="block"></div>
	<div id="popupbox"></div>
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		<tr>
    		<td>
				
				<div id="contenido">
					
					
					<!-- EL REPORTE C:\wamp\www\ejecucion\views\tcpdf\ESTADO.php
					FUNCIONA GENERANDO EL EXCEL DE LOS ESTADOS Y GRABANDONDOLO ESTILO CSV(DELIMITADO POR COMAS)
					SE REEMPLAZA POR ESTADO_2.php YA QUE NO SE NECESITARIA DICHOEXCEL
					NOTA: EL REPORTE ESTADO_2.php NECESITA CONEXION A JUSTICIA XXI-->
					<form action= <?php echo "http://".$ip_plataforma."/ejecucion/views/tcpdf/ESTADO.php"; ?> id="frm_masivo2B" name="frm_masivo2B"  method="post" enctype="multipart/form-data">
					<!-- <form action= "http://190.217.24.24/ejecucion/views/tcpdf/ESTADO_2.php" id="frm_masivo2B" name="frm_masivo2B"  method="post" enctype="multipart/form-data"> -->
					
					
					 	<div id="titulo_frm"><?php echo strtoupper($titulo_2); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							<tr>
							
								<td>
									<a class="estados_auto" href="javascript:void(0);"><img src="views/images/excel_1.jpg" width="55" height="55" title="GENERAR ESTADO (ESTE FORMATO SE USA PARA GENERAR EL EXCEL TIPO CSV (delimitado por comas) Y GENERAR EL ESTADO CON LOS LINK A LOS AUTOS)"/>GENERAR ESTADO EXCEL</a>
								</td>
								
								<td colspan="2">
									<a class="estados_auto_pdpf" href="javascript:void(0);"><img src="views/images/ipdf3.png" width="55" height="55" title="GENERAR ESTADO (ESTE FORMATO SE USA PARA LA IMPRESION DEL ESTADO, PARA LA VISUALIZACION DE LOS MISMOS AL USUARIO)"/>GENERAR ESTADO PDF</a>
								</td>
								
								
							
							</tr>
							
							<?php if ( in_array($_SESSION['idUsuario'],$usuariosaNE2,true) ){ ?>
							
							<tr>
							
								<td>
									<label style="width:151px; color:#666666">FECHA INICIAL:</label><br>
									<input type="text" name="fechai_proc" id="fechai_proc" readonly="true" style="color:#FF0000; font-size:14px">
									
								</td>
								
								<td>
									
									<label style="width:151px; color:#666666">FECHA FINAL:</label><br>
									<input type="text" name="fechaf_proc" id="fechaf_proc" readonly="true" style="color:#FF0000; font-size:14px">
									
								</td>
								
								<td>
									<a class="estados_auto_nuevo" href="javascript:void(0);"><img src="views/images/excel_2.jpg" width="55" height="55" title="GENERAR EXCEL"/>GENERAR EXCEL</a>
								</td>
								
							</tr>
							
							<?php } ?>
							
							<tr>
							
								<td colspan="3">
									<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
								</td>
							
							</tr>
							
							<tr>
							
								<td colspan="3">
									
									<a class="subir_archivos" href="javascript:void(0);"  style="float:right"><img src="views/images/subirarchivo2.jpg" width="85" height="65" style="float:right" title="SUBIR AUTOS (PERMITE SUBIR LOS AUTOS SCANEADOS EN LA RUTA (C:\AUTOS_ESTADOS) PARA PODER SER ENLAZADOS CON EL EXCEL TIPO CSV (delimitado por comas))"/>SUBIR AUTOS</a>
									
									
									<!-- Formulario para subir los archivos -->
									<!-- <div class="mensage"> </div>  
									
									<table align="center">
										<tr>
											<td>Archivo</td>
											
											<td><input type="file" multiple="multiple" id="archivos"></td>
											 
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td><button id="enviar">Subir Documento</button></td>
										</tr>    
									</table> -->
									
									
								</td>
								
								
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#FF0000">FECHA ACTUAL:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechae_2A" id="fechae_2A" class="required" value="<?php echo $fechaactual?>" readonly="true" style="color:#FF0000; font-size:14px">
									
									<!-- <input type="text" name="fechae_2A" id="fechae_2A" value="<?php //echo "2016-11-11"?>" readonly="true" style="color:#FF0000; font-size:14px"> -->
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">FECHA ESTADO:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechae_2B" id="fechae_2B" class="required"  readonly="true" style="font-size:14px;">
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">NUM ESTADO:</label>
								</td>
								<td colspan="2">
									<input type="text" name="nun_estado" id="nun_estado" class="required number" style="font-size:14px;">
								</td>
							
							</tr>
							
							
							
							<tr>
								
								<td>
											
									<label style="width:151px; color:#666666">JUZGADO:</label>
												
											
								</td>
											
								<td colspan="2">
															
										<select name="juzgadoauto" id="juzgadoauto" class="required">
												
													
										<option value="" selected="selected">Seleccionar Juzgado</option>
															
										<?php
											while($row = $datosjuzgado->fetch()){
																		
												echo "<option value=\"". $row[nombre]."******".$row[idjxxi_2] ."\">" . $row[nombre] . "</option>";
																	
											}
										?>
										</select>
								</td>
											
							</tr>
							
							
							<tr>
								<td>
									<label style="width:151px; color:#FF0000">UBICADA EN EL PORTAL DE LA RAMA</label>
								</td>
								<td colspan="2">
									<label style="width:151px; color:#FF0000">EJEMPLO: /documents/2858546/12619400</label>
								</td>
							
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">RUTA AUTOS:</label>
								</td>
								<td colspan="2">
									<input type="text" name="ruta_auto" id="ruta_auto" class="required" style="font-size:14px;">
								</td>
							
							</tr>
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Archivo</label>
								</td>
								
								<!-- DEJO ESTE CAMPO COMO NO REQUERIDO PARA LA GENERACION DEL REPORTE ESTADO_2.php -->
								<td colspan="2">
									<!-- <input type="file" name="archivo" id="archivo" class="required" title="Archivo"/> -->
									<input type="file" name="archivo" id="archivo" title="Archivo"/>
								</td>
							
							</tr>
							
							<!-- <tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr> -->
							
							
		
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id= "filabotones_masivo">
								
								<td colspan="3">
									
									<center>
										
										<input type="submit" name="Submit" value="Generar" id="btn_input"/>
										<!-- <input type="button"  id="generarestado" name="generarestado" value="Generar" /> -->
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar2B"/>
										
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
							
							
							<!-- <tr>
								<td colspan="2">
									
									<center>
									
										<label style="width:151px; color:#FF0000">NOTA: SE DEBE CREAR EN LA UNIDAD C: LAS CARPETA C:\AUTOS_ESTADOS (AQUI UBICAR LOS AUTOS QUE SE DESEAN PROCESAR) Y C:/CARGAMASIVA</label>
									
									</center>
								</td>
								
						
							</tr> -->
							
							<tr>
								<td colspan="3">
									
									<center>
									
										<label style="width:151px; color:#006633">ESTRUCTURA ARCHIVO EN EXCEL (SIN ENCABEZADOS)</label>
									
									</center>
								</td>
								
						
							</tr>
							
							<tr>
								<td colspan="3">
									
									<center>
									
										<label style="width:151px; color:#006633">GUARDAR EL ARCHIVO A PROCESAR CSV(delimitado por comas)</label>
									
									</center>
								</td>
								
							</tr>
							
							<tr>
								
								<td colspan="3">
									<center>
										
										<img src="views/images/estadoautos.png" width="800" height="400"/>
											
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
	
	
	
?>



</body>
</html>


