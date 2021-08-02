
<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new demandaModel();
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	$id_juzgado_user_devo = $_SESSION['id_juzgado'];
	
	$iddepartamento  =  $_SESSION['iddepartamento'];
	$idmunicipio     =  $_SESSION['idmunicipio'];
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//LISTA BASE DE DATOS LOCAL
	
	$nombrelista  = 'dda_jurisdiccion';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosJURI    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'dda_claseproceso';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosCPRO    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'dda_entidad';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosCORPO   = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'dda_estado';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosESTADO  = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	//$id_juzgado_user = $_SESSION['id_juzgado'];
	
	//echo $id_juzgado_user;
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosACCION_1 = $modelo->listar_demanda_2_filtro();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_demanda_2_filtro();
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACCION_1 = $modelo->listar_demanda_2();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_demanda_2();
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
	
	}

	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>CONSULTAR DEMANDA</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->




        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
		<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
		<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
		<!-- ---------------------------------------------------------------------------------------------------------------------------- -->
		

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
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
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
	 
	 $("#filtro2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 $("#filtro3").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	 
	 $("#filtro4 ").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro4 ").find(':selected').val();
						
		$("#filtro6").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+4);
					
						
	});
	
	 $("#filtro6").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro6").find(':selected').val();
						
		$("#filtro7").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+2);
					
						
	});
	
	$("#filtro7").change(function(event){
	
		//alert("entre");
		
		var iddpto = "<?php echo $iddepartamento; ?>";
		var idmuni = "<?php echo $idmunicipio; ?>";
    	
		var id = $("#filtro7").find(':selected').val();
						
		$("#filtro5").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+5+"&iddpto="+iddpto+"&idmuni="+idmuni);
					
						
	});


	$('#exampleModal').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('PARTES DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(1);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_partes.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='id'>"+json[i].idda+"</td>"
					registro+="<td class='id'>"+json[i].docddte+"</td>"
					registro+="<td class='id'>"+json[i].nomddte+"</td>"
					registro+="<td class='id'>"+json[i].iddepartamento+"</td>"
					registro+="<td class='id'>"+json[i].idmunicipio+"</td>"
					registro+="<td class='id'>"+json[i].dir+"</td>"
					registro+="<td class='id'>"+json[i].telefono+"</td>"
					registro+="<td class='id'>"+json[i].correo+"</td>"
					registro+="<td class='id'>"+json[i].idparte+"</td>"
					registro+="<td class='id'>"+json[i].tp+"</td>"
					
						
				registro+="</tr>"
					
					
				$('.editinplace').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	
	
	$('#exampleModal_2').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ARCHIVOS DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		var nomarchivo;
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_archivos.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].idda+"</td>"
					registro+="<td class='idda'>"+nomarchivo[3]+"</td>"
					registro+="<td class='ruta'><a href="+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_2').on('show.bs.modal', function (event) {
	
	
	
	$('#exampleModal_3').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTA REPARTO DEMANDA: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		var nomarchivo;
		
		Eliminar_Tabla(3);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/dda_acta.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				nomarchivo = "";
				nomarchivo = json[i].ruta.split("/");
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='idda'>"+json[i].idda+"</td>"
					registro+="<td class='idda'>"+nomarchivo[4]+"</td>"
					registro+="<td class='ruta'><a href="+ json[i].ruta +" title="+ json[i].ruta +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
				
				registro+="</tr>"
					
					
				$('.editinplace_3').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal_2').on('show.bs.modal', function (event) {
	
	$("#recargar_demanda").click(function(evento){
	
		location.href="index.php?controller=demanda&action=Listar_Demandas_2";
	
	});
	
	$("#buscar_demanda").click(function(evento){
	
		//alert("BUSCANDO...");
		
		
		if( 
			
		   $('#filtro1').val().length   == 0 && 
		   $('#filtro2').val().length   == 0 &&
		   $('#filtro3').val().length   == 0 &&
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 &&
		   $('#filtro6').val().length   == 0 &&
		   $('#filtro7').val().length   == 0 &&
		   $('#filtro8').val().length   == 0 &&
		   $('#filtro9').val().length   == 0 &&
		   $('#filtro10').val().length  == 0
		   
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('filtro1').style.borderColor  =  '#FF0000';
			document.getElementById('filtro2').style.borderColor  =  '#FF0000';
			document.getElementById('filtro3').style.borderColor  =  '#FF0000';
			document.getElementById('filtro4').style.borderColor  =  '#FF0000';
			document.getElementById('filtro5').style.borderColor  =  '#FF0000';
			document.getElementById('filtro6').style.borderColor  =  '#FF0000';
			document.getElementById('filtro7').style.borderColor  =  '#FF0000';
			document.getElementById('filtro8').style.borderColor  =  '#FF0000';
			document.getElementById('filtro9').style.borderColor  =  '#FF0000';
			document.getElementById('filtro10').style.borderColor  =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#filtro2').val(); 
		    dato_2 = $('#filtro3').val();
			
		    datox1 = $('#filtro1').val();
			datox2 = $('#filtro4').val();
			datox3 = $('#filtro5').val();
			datox4 = $('#filtro6').val();
			datox5 = $('#filtro7').val();
			datox6 = $('#filtro8').val();
			datox7 = $('#filtro9').val();
			datox8 = $('#filtro10').val();
			
		    

			location.href="index.php?controller=demanda&action=Busquedad_Filtro&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8;
			

			
		}
		
	
	});
	
	$("#registrar_devolucion").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				//var sola_UNA = "<?php echo $sola_UNA; ?>";
				
				var idevo = $(this).attr('data-id');
				
				
				
				//alert(idevo);
				
				//var dataString = "";

				//dataString += '&idevo='+idevo;
				
				//alert(dataString);
				
				var data = new FormData();
				
				data.append('idevo',idevo);
			
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							
							
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=demanda&action=Registrar_Devolucion',
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								//data:dataString, //Le pasamos el objeto que creamos con los archivos
								data:data,
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								
								$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
								$('.mensage').show('slow');//Mostramos el div.
								
								//DESAPARECER
								setTimeout(function() {
									
									$(".mensage").fadeOut(1500);
									
									var msgrespuesta = msg.split("-");
									
									if(msgrespuesta[0] == 1){
									
										location.href = "index.php?controller=demanda&action=Listar_Demandas_2";
									}
									
									
									
								},3000);
								
							
							});
							
							
							
						
				}
			
								 
		});
	

	
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	if(idtabla == 1){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('partes');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 2){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('archivosdda');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 3){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('actadda');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
}

</script>



<style type="text/css">

#mdialTamanio{
  width: 80% !important;
}


	
	
		.mensage{
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

<center><h1 class="page-header">CONSULTA DE DEMANDAS</h1></center>

<center><h3 class="page-header"><?php require_once('demanda_ubicacion.php'); ?></h3></center>

<div class="well well-sm text-right">
    
	<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
		Cerrar-Sesion
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
</div>

<h4 class="page-header"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></h4>

<div class="btn-toolbar" role="toolbar">

  <a href="index.php" title="Volver al Menu Principal">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Volver al Menu Principal
	  </button>
  
  </a>

</div>

<br>

<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header">FILTROS PARA BUSQUEDA</h4>
	
	<a id="buscar_demanda" title="REGISTRAR DEMANDA">
	
		<button type="button" class="btn btn-default" title="BUSCAR">
			<span class="glyphicon glyphicon-search"></span>BUSCAR
		</button>
			
	</a>
	
	<a id="recargar_demanda" title="RECARGAR">
	
		<button type="button" class="btn btn-default" title="RECARGAR">
			<span class="glyphicon glyphicon-repeat"></span>RECARGAR
		</button>
			
	</a>
	
</center>

<!-- <form id="frmfiltro"> -->


<table class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-2">
				  <label for="input_1">Id</label>
				  <input type="text" class="form-control" name="filtro1" id="filtro1" value="<?php echo trim($_GET['datox1']); ?>" placeholder="Ingrese Id Demanda">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table>

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->	


	
	
	<div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Inicial</label>
		  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php echo trim($_GET['dato_1']); ?>" placeholder="Ingrese Fecha Registro Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Final</label>
		  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Final">
		</div>
		
	</div>
	

	<div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Jurisdiccion</label>
			 
			  <select class="form-control" name="filtro4" id="filtro4">
														
				<option value="" selected="selected">Seleccionar Jurisdiccion</option> 
																	
				<?php
					while($row = $datosJURI->fetch()){
																				
						if($row[id] == trim($_GET['datox2'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		
		
	
	
	<div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Corporacion</label>
			 
			  <select class="form-control" name="filtro6" id="filtro6">
														
				<option value="" selected="selected">Seleccionar Corporacion</option> 
																	
				<?php
					/*while($row = $datosCORPO->fetch()){
																				
						if($row[id] == trim($_GET['datox4'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}*/
				?>
			</select>
		  
		  
		</div>
		
		<div class="form-group col-md-6">
		
		  <label for="input_4">Especialidad</label>
		 
		  	<select class="form-control" name="filtro7" id="filtro7">
				<option value="" selected="selected">Seleccionar Especialidad</option> 
			</select>
		  
		  
		</div>
		
	</div>
	
	
	<div class="form-group col-md-6">
		
			  <label for="input_3">Grupo/Clase de Proceso</label>
			 
			  <select class="form-control" name="filtro5" id="filtro5">
														
				<option value="" selected="selected">Seleccionar Grupo/Clase de Proceso</option> 
																	
				<?php
					/*while($row = $datosCPRO->fetch()){
																				
						if($row[id] == trim($_GET['datox3'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}*/
				?>
			</select>
		  
		  
		</div>
		
	</div>
	
	<div class="form-row">
	  
		<div class="form-group col-md-6">
		  <label for="input_1">Nombre</label>
		  <input type="text" class="form-control" name="filtro8" id="filtro8" value="<?php echo trim($_GET['datox6']); ?>" placeholder="Ingrese Nombre">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_2">N.C.C. o NIT</label>
		  <input type="text" class="form-control" name="filtro9" id="filtro9" value="<?php echo trim($_GET['datox7']); ?>" placeholder="Ingrese N.C.C. o NIT">
		</div>
		
		
   </div>
   
   
   <div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Estado</label>
			 
			  <select class="form-control" name="filtro10" id="filtro10">
														
				<option value="" selected="selected">Seleccionar Estado</option> 
																	
				<?php
					while($row = $datosESTADO->fetch()){
																				
						if($row[num] == trim($_GET['datox8'])){					
																				
							echo "<option value=\"". $row[num] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[num] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		
	</div>
   
	

</div>
	
<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->


<table class="table"> 


	<tr>
															
		
		
		<td>
		
			<center><h2 class="page-header">DEMANDAS: <?php echo $cantregis; ?></h2></center>

			
		</td>
			
	</tr> 
	
	
	
</table>


<table class="table"> 

	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	
</table>

<table class="table table-striped">
    <thead>
        <tr>
            
			<!-- <th style="width:80px;"></th> -->
			
            <th style="width:180px; font-size:12px; color:#FF0000">ID</th>
			
			<th style="width:180px; font-size:12px">FECHA</th>
            <th style="width:180px; font-size:12px">HORA</th>
			
            <th style="width:180px; font-size:12px">JURISDICION</th>
			<th style="width:180px; font-size:12px">CORPORACION</th>
			<th style="width:180px; font-size:12px">ESPECIALIDAD</th>
			<th style="width:180px; font-size:12px">GRUPO/CLASE PROCESO</th>
			<th style="width:180px; font-size:12px">CUADERNOS</th>
			<th style="width:180px; font-size:12px">FOLIOS</th>
			<th style="width:180px; font-size:12px">ANEXOS</th>
			<th style="width:180px; font-size:12px">DEPARTAMENTO</th>
			<th style="width:180px; font-size:12px">MUNICIPIO</th>
			
			<th style="width:180px; font-size:12px">ARCHIVO</th>
			
			<th style="width:180px; font-size:12px">ACTA REPARTO</th>
			
			
           <!--  <th style="width:180px; font-size:12px">PARTES</th> -->
		   
           <th style="width:60px;"></th> 
		   
		   <?php 
		   if($id_juzgado_user_devo >= 1){
		   ?>
		   
		   		<th style="width:60px;">DEVOLUCION</th> 
			<?php 
			}
			?>
			
        </tr>
    </thead>
    
   <!--  <tr>
        <td colspan="8" class="text-center">
            <a href="?c=Alumno&a=excel">Exportar a Excel</a>
        </td>
    </tr> -->
	
	
	<?php
											
			$Ct110=1;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$d1M = $fila[id];
				
				$d2M = $fila[fecha];
				$d3M = $fila[hora];
				
				$d4M = $fila[jurisdiccion];
				$d5M = $fila[claseproceso];
				$d6M = $fila[corporacion];
				$d7M = $fila[especualidad];
				$d8M = $fila[cuadernos];
				$d9M = $fila[folios];
				
				$d10M = $fila[tipo];
				$d11M = $fila[ruta];
				
				$d12M = $fila[estado];
				
				$d13M = $fila[anexos];
				
				$d14M = $fila[departamento];
				$d15M = $fila[municipio];
				
				$d16M = $fila[desdevo];
				
				
		?>
    
    <?php //foreach($this->model->Listar() as $r): ?>
        <tr>
            <!-- <td>
                <?php //if($r->__GET('Foto') != ''): ?>
                    <img src="uploads/<?php //echo $r->__GET('Foto'); ?>" style="width:100%;" />
                <?php //endif; ?> 
            </td> -->
			
			<td style="width:180px; font-size:12px; color:#FF0000">
			
				<?php echo $d1M; //id?>
				
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php echo $d2M; //fecha ?>
			
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php echo $d3M; //hora ?>
				
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php echo $d4M; //jurisdiccion ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
				<?php echo $d6M; //corporacion ?>
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d7M; //especialidad ?>
				
			</td>
			<td style="width:180px; font-size:12px">
			
				<?php echo $d5M; //claseproceso ?>
				
			</td>
			<td style="width:180px; font-size:12px">
			
				<?php echo $d8M; //cuadernos ?>
				
			</td>
			<td style="width:180px; font-size:12px">
			
				<?php echo $d9M; //folios ?>
				
			</td>
			<td style="width:180px; font-size:12px">
			
				<?php echo $d13M; //anexos ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d14M; //anexos ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d15M; //anexos ?>
				
			</td>
			
			<!-- ARCHIVOS DE LA DEMANDA, CARGADOS EN UNA VENTANA MODAL -->
			<td>
               
			
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php echo $d1M;?>">
				
				 Archivos Demanda
				
				</button>
				
				
           </td>
			
		
						
			
			<?php
			//ACTA DE REPARTO
			if ( $d12M == 1) { ?>
			
							<td style="width:180px; font-size:12px">
							
								
								<!-- <a href="<?php //echo $d12M; ?>" title="<?php //echo $d12M; ?>" target="_blank">
				
									<img src="views/images/pdf-icono.png" width="35" height="35"/> 
									
									
								</a> -->
								
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_3" data-whatever="<?php echo $d1M;?>">
				
								 Acta Reparto
								
								</button>
								
								
							</td> 
			
			<?php }
			//EN PROCESO
			if ( $d12M == 0){ ?>
							<td style="width:180px; font-size:12px">
								
								EN PROCESO
								
								<a href="index.php?controller=demanda&amp;action=Registrar_Acta_Reparto&iddemanda=<?php echo $d1M; ?>" title="Repartir">
				
					
					
									<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button> 
								
								</a>
								
								
							</td> 
			<?php }
			//ESTADO DEVOLUCION
			if ( $d12M == 2){ ?>
							
							<td style="width:180px; font-size:12px; color:#FF0000">
								
								<!-- DEVOLUCION, REALIZADA POR DESPACHO -->
								<?php echo $d16M; ?>
								
								<a href="index.php?controller=demanda&amp;action=Registrar_Acta_Reparto&iddemanda=<?php echo $d1M; ?>" title="Repartir">
				
					
					
									<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button> 
								
								</a>
								
								
							</td> 
			<?php }?>
			
			
			
				
          	<td>
               
			
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $d1M;?>">
				
				 Partes Demanda
				
				</button>
				
				
           </td>
		   
		   
		    <?php 
		   if($id_juzgado_user_devo >= 1){
		   ?>
		   
		   		
			
		   
		   	<td style="width:180px; font-size:12px">
								
								
				<a id="registrar_devolucion" href="javascript:void(0);" data-id="<?php echo $d1M;?>" title="REGISTRAR DEVOLUCION">				
				
					<!-- <a onclick="javascript:return confirm('Esta Seguro de Realizar la Devolucion de la Demanda');" href="index.php?controller=demanda&amp;action=Registrar_Acta_Reparto&iddemanda=<?php //echo $d1M; ?>" title="Devolucion"> -->
				
					<!-- <button class="btn btn-default btn-lg"><span class="glyphicon glyphicon-circle-arrow-left"></span></button> -->
					
					<button class="btn btn-default btn-lg"><span class="glyphicon glyphicon-new-window"></span></button> 
					
					
								
				</a>
								
								
			</td> 
			
			<?php 
			}
			?>
           
            <!-- <td>
                <a href="?c=Alumno&a=Crud&id=<?php //echo $r->id; ?>" title="Editar">
				
					
					
					<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span></button> 
				
				</a>
            </td>
            <td>
                <a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=Alumno&a=Eliminar&id=<?php //echo $r->id; ?>" title="Eliminar">
				
					
					
					<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span></button> 
				
				</a>
            </td> -->
			
        </tr>
    <?php  $Ct110=$Ct110+1; } //endforeach; ?>
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 

<!-- VENTANAS MODALES -->


<!-- ARCHIVOS DE LA DEMANDA -->

<div class="modal fade" id="exampleModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ARCHIVOS DEMANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="archivosdda" border="1" class="editinplace_2">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>ID DEMANDA</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div> 



<!-- ACTA DE LA DEMANDA -->

<div class="modal fade" id="exampleModal_3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="actadda" border="1" class="editinplace_3">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>ID</th>
					<th>ID DEMANDA</th>
					<th>NOMBRE ARCHIVO</th>
					<th>RUTA</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div> 




<!-- PARTES DE LA DEMANDA -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PARTES DEMANDA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="partes" border="1" class="editinplace">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr> 
													
					<th>IDPARTE</th>
					<th>IDDA</th>
					<th>N.C.C. o NIT</th>
					<th>NOMBRE</th>
					<th>DEPARTAMENTO</th>
					<th>MUNICIPIO</th>
					<th>DIRECCION</th>
					<th>CEL / TELEFONO</th>
					<th>CORREO</th>
					<th>PARTE</th>
					<th>TP</th>
					
							
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div> 




<!-- FIN VENTANAS MODALES -->       

<div class="row">
	<div class="col-xs-12">
     	<footer class="text-center">
       		<hr />
        	<p>Plataforma Desarrollado por Ingeniero de Sistemas Jorge Andres Valencia Orozco</p>                
        </footer>                
	</div>    
</div>

<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>
