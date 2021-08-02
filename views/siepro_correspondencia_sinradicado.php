<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "CORRESPONDENCIA";
	$subtitulo  = "CORRESPONDENCIA";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	$nombrelista  = 'pa_tipo_correspondencia';
	$campoordenar = 'des';
	$formaordenar = '';
	$datostipodoc = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosjd = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'pa_solicitud';
	$campoordenar = 'nombre';
	$formaordenar = '';
	$datosts = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	

	//DATOS CORRESPONDENCIA	
	
	/*$opcion = trim($_GET['dato_0']);
	
	if($opcion == 1){
	
		$datos_corres      = $modelo->busquedad_filtro_corres();
		
		//$datos_corres_cant = $modelo->cantidad_filtro_corres();
		
		$datos_corres_cant = $modelo->busquedad_filtro_corres();
			
		$fc = 0;
		while($fila_cant = $datos_corres_cant->fetch()){		
			
			$fc = $fc + 1; 
			
		}
			
		$cantregis = $fc;
	
	}
	else{
	
		$datos_corres      = $modelo->busquedad_corres();
		
		$datos_corres_cant = $modelo->busquedad_corres();
			
		$fc = 0;
		while($fila_cant = $datos_corres_cant->fetch()){		
			
			$fc = $fc + 1; 
			
		}
			
		$cantregis = $fc;
		

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
	
	
	//PARA MANEJAR CUANDO UN MEMORIAL SE CARGA CON ARCHIVO
	$('#fila_archivo').hide();
	$('#boton_adicionar_memo_2').hide();
	
	
	$("#ckenamemo").click(function(){
	
		if($("#ckenamemo").is(':checked')) {  
		
          	$('#fila_archivo').show();
			
			$('#boton_adicionar_memo_2').show();
			
			
			$('#fila_botones').hide();
			
			$('#boton_adicionar_memo').hide();
        } 
		else {  
		
            $('#fila_archivo').hide();
			
			$('#fila_botones').show();
			
			$('#boton_adicionar_memo').show();
			
			$('#boton_adicionar_memo_2').hide();
        }  
		

	});
	
	
	$("#boton_adicionar_memo_2").click(function(){
	
		
	
					valor  = document.getElementById('listasr1').value;
					valor2 = document.getElementById('listasr2').value;
					valor3 = document.getElementById('listasr3').value;
					valor4 = document.getElementById('peticionariosr').value;
					valor5 = document.getElementById('foliossr').value;
					//valor6 = document.getElementById('observacionsr').value;
					
					valor7 = document.getElementById('archivomemo').value;
							
					
					if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
						
						alert("Defina Tipo Documento");
						document.getElementById('listasr1').style.borderColor = '#FF0000';
						return false;
					}
					
					if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
						
						alert("Defina Juzgado Destino");
						document.getElementById('listasr2').style.borderColor = '#FF0000';
						return false;
					}
					
					if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
						
						alert("Defina Tipo Solicitud");
						document.getElementById('listasr3').style.borderColor = '#FF0000';
						return false;
					}
					
					if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
						
						alert("Defina Peticionario");
						document.getElementById('peticionariosr').style.borderColor = '#FF0000';
						return false;
					}
					
					if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
						
						alert("Defina Folios");
						document.getElementById('foliossr').style.borderColor = '#FF0000';
						return false;
					}
					
					if( valor7 == null || valor7.length == 0 || /^\s+$/.test(valor7) ) {
						
						alert("Defina Memorial");
						document.getElementById('archivomemo').style.borderColor = '#FF0000';
						return false;
					}
					
		
					var inputFileImage = document.getElementById("archivomemo");
					var file = inputFileImage.files[0];
					
				
					//DE ESTA FORMA PARA PODER PASAR CAMPO FILE
					var data = new FormData();
					
					//data.append(COMO LO CAPTURA PHP,VALOR DATO);
					
					data.append('listasr1',$('#listasr1').val());
					data.append('listasr2',$('#listasr2').val());
					data.append('listasr3',$('#listasr3').val());
					data.append('peticionariosr',$('#peticionariosr').val());
					data.append('foliossr',$('#foliossr').val());
					data.append('observacionsr',$('#observacionsr').val());
					data.append('archivo',file);
					
			
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Correspondencia_Sin_Radicado_FILE',
						type:'POST', //Metodo que usaremos
						contentType:false, //Debe estar en false para que pase el objeto sin procesar
						//data:dataString, //Le pasamos el objeto que creamos con los archivos
						data:data, //Le pasamos el objeto que creamos con los archivos
						processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_proc').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_proc').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_proc").fadeOut(1500);
							
							//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
							//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
							$(document).off('click');
							
							location.href="index.php?controller=archivo&action=Correspondencia_Sin_Radicado";
							
						},3000);
						
					
					});
					
					

					
					
	
		

	});
	
	//FIN PARA MANEJAR CUANDO UN MEMORIAL SE CARGA CON ARCHIVO
	
	
	
	
	//PASOMOS VARIABLES PHP A JAVASCRIPT
	var fechaactual = "<?php echo $fechaactual; ?>";
		
	var registro;

	/* OBTENEMOS TABLA */
	$.ajax({
		type: "GET",
		url: "views/popupbox/editinplace_3.php?tabla=1",
		data: { fechaactual: fechaactual }
	})
	.done(function(json) {
		json = $.parseJSON(json)
		for(var i=0;i<json.length;i++)
		{
			
				
			registro+="<tr>"
					
				registro+="<td class='id'>"+json[i].id+"</td>"
				registro+="<td class='fecha_registro'>"+json[i].fecha_registro+"</td>"
				registro+="<td class='editable' data-campo='peticionario' data-tipocampo=1><span>"+json[i].peticionario+"</span></td>"
				registro+="<td class='editable' data-campo='tipo_documento' data-tipocampo=4 data-idlista=1><span>"+json[i].tipo_documento+"</span></td>"
				registro+="<td class='editable' data-campo='folios' data-tipocampo=1><span>"+json[i].folios+"</span></td>"
				registro+="<td class='editable' data-campo='fecha_entrega' data-tipocampo=2><span>"+json[i].fecha_entrega+"</span></td>"
				registro+="<td class='editable' data-campo='fecha_devolucion' data-tipocampo=2><span>"+json[i].fecha_devolucion+"</span></td>"
				registro+="<td class='editable' data-campo='idjuzgadodestino' data-tipocampo=4 data-idlista=2><span>"+json[i].jusgadodestino+"</span></td>"
				registro+="<td class='editable' data-campo='idsolicitud' data-tipocampo=4 data-idlista=3><span>"+json[i].solicitud+"</span></td>"
				registro+="<td class='empleado'>"+json[i].empleado+"</td>"
				registro+="<td class='editable' data-campo='observacionesm' data-tipocampo=3><span>"+json[i].observacionesm+"</span></td>"
				
				if(json[i].ruta_local == null){
				
					registro+="<td>"+"-"+"</td>"
				
				}
				else{
				
					registro+="<td class='ruta_local'><a href="+ json[i].ruta_local +" title="+ json[i].ruta_local +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				}
					
			registro+="</tr>"
				
				
			$('.editinplace').append(registro);
			
			registro = "";
		}
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
			
			
	
	.ckenamemoestilo{height:15px;width:18px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}	
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}

</style>


<style type="text/css">
	
	
		.mensage_proc{
		
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			/*Al cargar el documento el contenido del mensaje debe estar oculto*/
			display: none;
		}
		
		
		
</style>

 
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
							
			<td colspan="2">
				
				<div class="mensage_proc"></div>  
				
			</td>
																	
		</tr> 
		
		<tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY
				EN action="" NO ENVIO NADA YA QUE ESTE LLAMADO SE REALIZA EN require 'secc_sigdoc.php';
				IGUAL FUNCIONA SI SE DEFINE ALGUNA ACCION-->
				<div id="contenido">
				
					<form id="frm_C" name="frm_C" method="post" enctype="multipart/form-data" action="">
					
						<!-- <input name="iddocumento" id="iddocumento" type="hidden" readonly="true"  value="<?php //echo $d0; ?>"> -->
						<input name="datospartes_c" id="datospartes_c" type="hidden" readonly="true"/>
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
								
							
							
							
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Registro:</label>
								</td>
								<td colspan="2">
									<input type="text" name="fechasr" id="fechasr" value="<?php echo $fechaactual; ?>" readonly="true">
								</td>
							
							</tr>
							

							<tr>
							
								<td colspan="2">
									
									<table border="5" cellspacing="0" cellpadding="0" rules="rows" id="frm_memo">
									
										
		  	
										<tr>
											<td colspan="2">
												
												<button type="button" name="boton_adicionar_memo" id="boton_adicionar_memo" title="Adicionar Correspondencia" onClick="Adicionar_Correspondencia(1)"><img src="views/images/add_memo.png" width="30" height="30"/></button>
												
												<button type="button" name="boton_adicionar_memo_2" id="boton_adicionar_memo_2" title="Registrar Correspondencia"><img src="views/images/save.png" width="30" height="30"/></button>
												
												
												<center>MEMORIAL CON ARCHIVO<input type="checkbox" name="ckenamemo" id="ckenamemo" class="ckenamemoestilo"/></center>
												
											</td>
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px ">ID:</label><br>
											</td>
										
											<td>
												<input type="text" name="idcoresp" id="idcoresp" readonly="true" style="color:#FF0000; font-size:16px"/>
											</td>
										
										</tr>
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Tipo Documento:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr1" id="listasr1">
												
													<option value="" selected="selected">Seleccionar Tipo Documento</option> 
															
													<?php
															while($row = $datostipodoc->fetch()){
																		
																
																if($row[des] == trim($_GET['datox1'])){					
																				
																	echo "<option value=\"". $row[des] ."\" selected=selected>" . $row[des] . "</option>";
																}
																else{
																	echo "<option value=\"". $row[des] ."\">" . $row[des] . "</option>";
																}
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Juzgado Destino:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr2" id="listasr2">
												
													<option value="" selected="selected">Seleccionar Juzgado Destino</option> 
															
													<?php
															while($row = $datosjd->fetch()){
																		
																
																//if($row[id] == 1 || $row[id] == 2 ||$row[id] == 7){
																
																
																	if($row[id] == trim($_GET['datox2'])){					
																				
																		echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[nombre] . "</option>";
																	}
																	else{
																		echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
																	}
																
																	
																
																//}
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										
										<tr>
										
											<td>
											
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Tipo Solicitud:</label><br>
												
											
											</td>
											
											<td>
															
												<select name="listasr3" id="listasr3">
												
													<option value="" selected="selected">Seleccionar Tipo Solicitud</option> 
															
													<?php
															while($row = $datosts->fetch()){
																		
																
																
																if($row[id] == trim($_GET['datox3'])){					
																				
																		echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[nombre] . "</option>";
																}
																else{
																		echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
																}
																
																
															
															}
														?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Peticionario:</label><br>
											</td>
										
											<td>
												<input type="text" name="peticionariosr" id="peticionariosr" value="<?php echo trim($_GET['datox4']); ?>"/>
											</td>
										
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Folios:</label><br>
											</td>
										
											<td>
												<input type="text" name="foliossr" id="foliossr" value="<?php echo trim($_GET['datox5']); ?>" onKeyPress="return Solo_Numeros(event)"/>
											</td>
										
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Recibe:</label><br>
											</td>
										
											<td>
												<input type="text" name="recibesr" id="recibesr" readonly="true" value="<?php echo $_SESSION['nombre']; ?>"/>
											</td>
										
										</tr>
										
										<tr>
											<td>
												<label style="width:180px; height:23px; border-color:#000000; font-size:14px ">Observacion:</label><br>
											</td>
										
											<td>
												
												<textarea name="observacionsr" id="observacionsr" cols="45" rows="5" maxlength = "1000" value="<?php echo trim($_GET['datox6']); ?>"></textarea>
											</td>
										
										</tr>
										
										
										<!-- ADICIONADO EL 29 DE ABRIL 2020, PARA PODER SUBRIL EL MEMORIAL -->
										<tr id="fila_archivo">
										
											<td colspan="2">
												
												<br><label style="width:180px; height:23px; border-color:#000000; font-size:16px ">CARGAR MEMORIAL</label><br><br>
												<input type="file" name="archivomemo" id="archivomemo" title="CARGAR MEMORIAL" style="width:680px"/>
												
											</td>
											
										
										</tr>
																	
										
										
										
		
									</table>
								
								</td>
								
							</tr>
							
							
							
										
							
							<tr>
								<td colspan="2">
									<center><label style="width:180px; height:23px; border-color:#000000; font-size:14px ">TABLA CORRESPONDENCIA</label><br></center>
								</td>
										
							</tr>
										
							
							<tr>
							
								<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_c"> 
													<table id="t_c" border="1"> 
														<tr>
															
															<td>
																<strong>Tipo Documento</strong>
															</td>
															<td>
																<strong>Juzgado Destino</strong>
															</td>
															<td>
																<strong>Tipo Solicitud</strong>
															</td>
															<td>
																<strong>Peticionario</strong>
															</td>
															<td>
																<strong>Folios</strong>
															</td>
															<td>
																<strong>Observacion</strong>
															</td>
															<td>
																<strong>-</strong>
															</td>
															
														
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
								</td>
							
							</tr>
							
							<tr>
								<td>
									<div id="ok"></div>
								</td>
							</tr> 
							
	
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id="fila_botones">
								
								<td colspan="2">
									
									<center>
										<input type="submit" name="Submit" class="btn_validar_2" value="Registrar" id="btn_input"/>
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_2b"/>
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
	
	
	
	
	<!-- FILTROS -->
	<table border="0" align="center"  rules="rows" id="tbuscarxfiltroconsulta">
		
			
		<tr>
					
			<td>
					
					
				<table cellpadding="0" cellspacing="0" rules="rows" border="1">
																						
										
					<tr> 
											
						<td colspan="6">
							<center>
								<strong style="width:151px; color:#FF0000; font-size:16px">CORRESPONDENCIA<?php //echo " / REGISTROS: ".$cantregis; ?></strong>
							</center>
						</td>
											
					</tr>
											
					<tr>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasri" id="fechasri" value="<?php echo trim($_GET['dato_1']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
						</td>
						<td>
							<input type="text" name="fechasrf" id="fechasrf" value="<?php echo trim($_GET['dato_2']); ?>">
						</td>
												
						<td colspan="8">
							<a class="buscarxfiltro" href="javascript:void(0);" title="BUSCAR CORRESPONDENCIA">
								<img src="views/images/modficar.jpg" width="45" height="45" title="BUSCAR CORRESPONDENCIA"/>
							</a>
													
							<a class="generar_correspondencia" href="javascript:void(0);" title="GENERAR CORRESPONDENCIA">
								<img src="views/images/excel_1.jpg" width="45" height="45" title="GENERAR CORRESPONDENCIA"/>
							</a>
						</td>
												
					</tr>
											
					<tr>
											
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Entrega Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasrei_2" id="fechasrei_2" value="<?php echo trim($_GET['dato_3']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Entrega Final:</label>
						</td>
						<td colspan="6">
							<input type="text" name="fechasref_2" id="fechasref_2" value="<?php echo trim($_GET['dato_4']); ?>">
						</td>
										
					</tr>
											
					<tr>
											
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Devolucion Inicial:</label>
						</td>
						<td>
							<input type="text" name="fechasrdi_2" id="fechasrdi_2" value="<?php echo trim($_GET['dato_5']); ?>">
						</td>
												
						<td>
							<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Devolucion Final:</label>
						</td>
						<td colspan="6">
							<input type="text" name="fechasrdf_2" id="fechasrdf_2" value="<?php echo trim($_GET['dato_6']); ?>">
						</td>
										
					</tr>
											
											
				</table>
										
						
			</td>
						
		</tr>
			
			
	</table>		
			
	<!-- SE LISTA LA CORRESPONDENCIA-->		
			
	<div class="mensaje"></div>
						
	<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="tbuscarxfiltro">
																						
										
		<tr> 
											
			<th style="color:#FF0000">ID</th>
			<th>FECHA REGISTRO</th>
			<th>PETICIONARIO</th>
			<th>TIPO DOCUMENTO</th>
			<th>FOLIOS</th>
			<th>FECHA ENTREGA</th>
			<th style="color:#FF0000">FECHA DEVOLUCION</th>
			<th>JUZGADO DESTINO</th>
			<th>SOLICITUD</th>
			<th>RECIBE</th>
			<th>OBSERVACIONES</th>
			<th>MEMORIAL</th>
					
		</tr> 
											
	</table>
	
	
	
	<br>
	
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


