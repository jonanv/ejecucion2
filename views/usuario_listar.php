
<?php 
	

	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new usuarioModel();
	
	
	
	$iddepartamento  =  $_SESSION['iddepartamento'];
	$idmunicipio     =  $_SESSION['idmunicipio'];
	

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//$horaactual = strtotime($horaactual);
	
	$horaactual = $horaactual;
	
	//echo $horaactual."<br>";
	
	//NOTA: EN LA BASE DE DATOS TABLA dda_municipio EN LA COLUMNA hi Y hf
	//DEBE SER DE LA SIGUEINTE FORMA hi:07:30 - hf: 22:00
	//ES DECIR LA HORA INICIAL SE DEFINE DE LA FORMA 07:30 NO 7:30
	$rango_horas = $modelo->rango_horas_municipio($idmunicipio,$iddepartamento);	
	$rango       = $rango_horas->fetch();
	//$hi          = strtotime($rango[hi]);
	//$hf          = strtotime($rango[hf]);
	
	$hi          = $rango[hi];
	$hf          = $rango[hf];
	
	$hi2         = $rango[hi2];
	$hf2         = $rango[hf2];
	
	//LISTA BASE DE DATOS LOCAL
	
	/*$nombrelista  = 'dda_jurisdiccion';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosJURI    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosACCION_1 = $modelo->listar_usuarios_filtro($idusuario);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_usuarios_filtro($idusuario);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACCION_1 = $modelo->listar_usuarios($idusuario);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_usuarios($idusuario);
		
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
<title>RECEPCION DEMANDA</title>
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


//---------------------------------RANGO HORA--------------------------------------------------------

function horario(){

    //una notificación normal
	
	var iddepartamentoH = "<?php echo $iddepartamento; ?>";
	var idmunicipioH    = "<?php echo $idmunicipio; ?>";
	
	
	$.get('funciones/dda_horario.php?iddepartamentoH='+iddepartamentoH+"&idmunicipioH="+idmunicipioH, function(horaX){
		
				
		//alert(horaX);
		//return false;
		var flag = 0;
		
		var rango_horas = horaX.split("//////");
		
		//DIA
		var hi  = rango_horas[0];
		var hf  = rango_horas[1];
	
		//TARDE
		var hi2 = rango_horas[2];
		var hf2 = rango_horas[3];
		
		var horaactual = rango_horas[4];
		
		
		if( (horaactual >= hi && horaactual <= hf) || (horaactual >= hi2 && horaactual <= hf2) ){
		
			flag = 1;
		}
		else{
		
			
			alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL DIA:"+hi+"-"+" HORA FINAL DIA:"+hf+" HORA ACTUAL:"+horaactual+" HORA INICIAL TARDE:"+hi2+"-"+" HORA FINAL TARDE:"+hf2+" HORA ACTUAL:"+horaactual);
					
			location.href = "index.php?controller=demanda&action=Cerrar_Session";
		
		}
				
			
	} );
	
		
	
}


/*var jClockInterval = setInterval(function(){
   horario();
}, 5000);*/

//---------------------------------FIN RANGO HORA--------------------------------------------------------

</script>

		

<script type="text/javascript">

$(document).ready(function() {


	//OCULTAR GIF CARGANDO
	$('#fila_cargando').hide();

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
	
	
	
	$("#editar_usuario").click(function(evento){
	
	
		//NO ES NECESARIO VALIDAR CAMPOS, SE VA A REALIZAR UNA ACTUALIZACION
		//Y ES POSIBLE QUE ALGUNOS DATOS NO SE DILIGENCIEN
		var validar = 0;
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
						
				var data = new FormData();
						
			
				data.append('dato1U',$('#dato1U').val());//DOC IDENTIDAD
				data.append('dato2U',$('#dato2U').val());//CONTRASEÑA
				data.append('dato3U',$('#dato3U').val());//NOMBRE
				data.append('dato4U',$('#dato4U').val());//CORREO
				data.append('dato5U',$('#dato5U').val());//ES ABOGADO
				data.append('dato6U',$('#dato6U').val());//CELULAR
				
				//CAMPOS OCULTOS
				data.append('iduser',$('#iduser').val());
				
				
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
										//OCULTAMOS BOTON REGISTRAR
										//PARA EVITAR QUE EL USUARIO DE CLIC
										//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
										$('#editar_usuario').hide();
															
										$('#fila_cargando').show();
					
					
										//Ejecutamos la función ajax de jQuery		
										$.ajax({
											
											//url:'views/popupbox/subir.php', //Url a donde la enviaremos
											url:'index.php?controller=usuario&action=Editar_Usuario',
											type:'POST', //Metodo que usaremos
											contentType:false, //Debe estar en false para que pase el objeto sin procesar
											//data:dataString, //Le pasamos el objeto que creamos con los archivos
											data:data,
											processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
											cache:false //Para que el formulario no guarde cache
										}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
											
											$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
											$('.mensage_memo').show('slow');//Mostramos el div.
											
											//DESAPARECER
											setTimeout(function() {
												
												$(".mensage_memo").fadeOut(1500);
												
									
												$('#editar_usuario').show();
												
												$('#fila_cargando').hide();
												
												
												//alert(msg);
												//var msgrespuesta = msg.split("-");
												
												//LIMPIAR CAMPOS VENTANA
												$('#dato1U').val('');
												$('#dato2U').val('');
												$('#dato3U').val('');
												$('#dato4U').val('');
												$('#dato5U').val('');
												$('#dato6U').val('');
												
												//CAMPOS OCULTOS
												$('#iduser').val('');
												
												
												
												//CIERRO VENTANA
												//$("#exampleModal_5").hide();
												
												//RECARGAR 
												location.href='index.php?controller=usuario&action=Listar_Usuarios';
												
												
												
												
												
											},3000);
											
										
										});					
					
				
				
				}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	});
	

	$('#exampleModal').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
		
		modal.find('.modal-title').text('EDITAR USUARIO: ' + recipient_2[2])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	
		var nombre_user_SESION = "<?php echo $nombre_user; ?>";
	
		$('#dato1U').val(recipient_2[1]);//DOC IDENTIDAD
		//$('#dato2U').val(recipient_2[6]);//CONTRASEÑA
		$('#dato3U').val(recipient_2[2]);//NOMBRE
		$('#dato4U').val(recipient_2[4]);//CORREO
		
		//ES ABOGADO 
		if(recipient_2[3] == "SI"){
			$('#dato5U').val(1);
		}
		if(recipient_2[3] == "NO"){
			$('#dato5U').val(2);
		}
		
		
		$('#dato6U').val(recipient_2[5]);//CELULAR
		
		/*$('#cuaderno').html('');
		$("#cuaderno").load('funciones/traer_datos_lista.php?id='+recipient_2[1]+"&idsql="+8);
		$('#correo').val(recipient_2[6]);
		$('#telefono').val(recipient_2[12]);
		$('#cedula').val(recipient_2[10]);
		$('#juzgadodestino').val(recipient_2[11]);
		
		var d7M_AX = recipient_2[9].split("/");
		var d7M_BX = d7M_AX[3];//nombre archivo
		$('#archivomemo_2').val(d7M_BX);//VISUAL PARA EL USUARIO
		$('#archivomemo').val(recipient_2[9]);//OCULTO, RUTA COMPLETA DEL ARCHIVO*/
		
		
		//CAMPOS OCULTOS
		$('#iduser').val(recipient_2[0]);//ID USURIO
		
		
	 
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	
	$("#recargar_demanda").click(function(evento){
	
		location.href="index.php?controller=usuario&action=Listar_Usuarios";
	
	});
	
	$("#buscar_demanda").click(function(evento){
	
		//alert("BUSCANDO...");
		
		
		if( 
			
		   $('#filtro1').val().length   == 0 && 
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 /*&&
		   $('#filtro4').val().length   == 0 &&
		   $('#filtro5').val().length   == 0 &&
		   $('#filtro6').val().length   == 0 &&
		   $('#filtro7').val().length   == 0 &&
		   $('#filtro8').val().length   == 0 &&
		   $('#filtro9').val().length   == 0 &&
		   $('#filtro10').val().length  == 0 &&
		   $('#filtro11').val().length  == 0 &&
		   $('#filtro12').val().length  == 0*/
		   
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('filtro1').style.borderColor   =  '#FF0000';
			document.getElementById('filtro4').style.borderColor   =  '#FF0000';
			document.getElementById('filtro5').style.borderColor   =  '#FF0000';
			/*document.getElementById('filtro4').style.borderColor   =  '#FF0000';
			document.getElementById('filtro5').style.borderColor   =  '#FF0000';
			document.getElementById('filtro6').style.borderColor   =  '#FF0000';
			document.getElementById('filtro7').style.borderColor   =  '#FF0000';
			document.getElementById('filtro8').style.borderColor   =  '#FF0000';
			document.getElementById('filtro9').style.borderColor   =  '#FF0000';
			document.getElementById('filtro10').style.borderColor  =  '#FF0000';
			document.getElementById('filtro11').style.borderColor  =  '#FF0000';
			document.getElementById('filtro12').style.borderColor  =  '#FF0000';*/
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			//dato_1  = $('#filtro2').val(); 
		    //dato_2  = $('#filtro3').val();
			
		    datox1  = $('#filtro1').val();
			datox4  = $('#filtro4').val();
			datox5  = $('#filtro5').val();
			/*datox4  = $('#filtro6').val();
			datox5  = $('#filtro7').val();
			datox6  = $('#filtro8').val();
			datox7  = $('#filtro9').val();
			datox8  = $('#filtro10').val();
			datox9  = $('#filtro11').val();
			datox10 = $('#filtro12').val();*/
			
		    

			location.href="index.php?controller=usuario&action=Busquedad_Filtro_Usuario&dato_0="+dato_0+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5;
			

			
		}
		
	
	});
	
	$("#filtro11").change(function(event){
	
		//alert("entre");
		
		//SOLO CARGARA LA LISTA DEL MUNICIPIO LOGEADO
		//var lidmunicipio = "<?php echo $idmunicipio; ?>";
		
		var id = $("#filtro11").find(':selected').val();
						
		//CUANDO SOLO SE DESEE ESPECIFICAR UN DEPARTAMENTO Y UN MUNICIPIO
		//$("#lista2").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1+"&lidmunicipio="+lidmunicipio);
		
		$("#filtro12").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1);
					
						
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
	
	
	if(idtabla == 4){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('devodda');
				
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
	
	if(idtabla == 5){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('anexosdda');
				
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
  width: 100% !important;
}


.mensage_memo{
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


<!-- MENU DE ADMINISTRACION HORIZONTAL -->

<nav class="navbar navbar-default">

  <div class="container-fluid">
   
    
    <div class="collapse navbar-collapse">
      
	   <ul class="nav navbar-nav navbar-right">
	  
	  	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Menu Principal">
			Menu-Principal
		</a>
		
		<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
			Cerrar-Sesion
		</a>
		
		<br>
		<br>
		<label for="input_sesion" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></label>
	
	  </ul>
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- FIN MENU HORIZONTAL -->

<div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=usuario&action=Listar_Usuario_Menu" title="Volver al Menu Principal">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Volver al Menu Administrar Usuarios
	  </button>
  
  </a>

</div>

<center><h1 class="page-header">REGISTRAR DE USUARIOS</h1></center>

	
<!-- RANGO DE HORA EN EL CUAL SE PUEDE REGISTRAR DEMANDAS -->
<?php //if( (trim($horaactual) >= $hi && trim($horaactual) <= $hf) || (trim($horaactual) >= $hi2 && trim($horaactual) <= $hf2) ){   ?>	

	<div class="well well-sm text-right">
    
		<a class="btn btn-primary" href="index.php?controller=usuario&amp;action=Registrar_Usuario"><h1>Registrar Usuario</h1></a>
	
	
	</div>


<?php /*}else{ 


			echo '<script languaje="JavaScript"> 
										
					
				var hi = "'.$hi.'";
				var hf = "'.$hf.'";
				
				var horaactual = "'.$horaactual.'";
				
				alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL:"+hi+"-"+" HORA FINAL:"+hf+" HORA ACTUAL:"+horaactual);
				
				
				
			</script>';
			
			session_unset();
			session_destroy();
			
			header("refresh: 0;URL=/ramajudicialpublica/");
			die();


?>	

				<!-- <div class="well well-sm text-right">
    
					HORARIO DE REGISTRO DE DEMANDA (7:30 AM - 5:00 PM)
				
				
				</div> -->

<?php }*/ ?>




<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header">FILTROS PARA BUSQUEDA</h4>
	
	<a id="buscar_demanda" title="REGISTRAR USUARIO">
	
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
				  <input type="text" class="form-control" name="filtro1" id="filtro1" value="<?php echo trim($_GET['datox1']); ?>" placeholder="Ingrese Id Usuario">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table>

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->	


	
	
	<!-- <div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Inicial</label>
		  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php //echo trim($_GET['dato_1']); ?>" placeholder="Ingrese Fecha Registro Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Final</label>
		  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php //echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Final">
		</div>
		
	</div> -->
	

	
	
	
	
	<div class="form-row">
	
	
		<div class="form-group col-md-6">
		  <label for="input_2">N.C.C. o NIT</label>
		  <input type="text" class="form-control" name="filtro4" id="filtro4" value="<?php echo trim($_GET['datox4']); ?>" placeholder="Ingrese N.C.C. o NIT">
		</div>
	  
		<div class="form-group col-md-6">
		  <label for="input_1">Nombre</label>
		  <input type="text" class="form-control" name="filtro5" id="filtro5" value="<?php echo trim($_GET['datox5']); ?>" placeholder="Ingrese Nombre">
		</div>
		
		
		
		
	</div>
	
	
	
	
	
	
	
	  
	  
	
	  
	

</div>
	
<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->



<table class="table"> 


	<tr>
															
		
		
		<td>
		
			
			<center><h2 class="page-header">USUARIOS<?php //echo $cantregis; ?></h2></center>

			
		</td>
			
	</tr> 
	
	
	
</table>


<table class="table table-striped table-bordered table table-hover">
    <thead>
         <tr class="success">
            
			<!-- <th style="width:80px;"></th> -->
			
             <th style="width:180px; font-size:12px; color:#FF0000">ID</th>
			
			 <th style="width:180px; font-size:12px">N.C.C. o NIT</th>
			 <th style="width:180px; font-size:12px">NOMBRE</th>
			 <th style="width:180px; font-size:12px">ABOGADO</th>
			 <th style="width:180px; font-size:12px">CORREO</th>
			 <th style="width:180px; font-size:12px">CELULAR</th>
			 <th style="width:180px; font-size:12px">EDITAR</th>
			
			
           <!--  <th style="width:180px; font-size:12px">PARTES</th> -->
           <!-- <th style="width:60px;"></th>  -->
			
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
				$d2M = $fila[nombre_usuario];
				$d3M = utf8_encode($fila[empleado]);
				$d4M = $fila[esabogado];
				$d5M = utf8_encode($fila[correo]);
				$d6M = $fila[celular];
				$d7M = $fila[contrasena];
				
				
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
			
				<?php echo $d2M; //CEDULA ?>
			
			</td>
			
            <td style="width:180px; font-size:12px">
			
				<?php echo utf8_encode($d3M); //NOMBRE ?>
				
			</td>
			
			  <td style="width:180px; font-size:12px">
			
				<?php echo $d4M; //ES ABOGADO ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo utf8_encode($d5M); //CORREO ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<?php echo $d6M; //CELULAR ?>
				
			</td>
			
			<td style="width:180px; font-size:12px">
			
				<!-- <a class="glyphicon glyphicon-pencil" href="index.php?controller=archivo&amp;action=Editar_Folio&datosexpEF=<?php //echo $id_radi."******".$nradi."******".$d0M."******".$d13M."******".$d11M; ?>" title="EDITAR USUARIO"></a> -->
	
				<a class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#exampleModal" title="EDITAR USUARIO" data-whatever="<?php echo utf8_encode($d1M."*/*/*".$d2M."*/*/*".$d3M."*/*/*".$d4M."*/*/*".$d5M."*/*/*".$d6M."*/*/*".$d7M); ?>"></a>
	
				
			</td>
          
			
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


<!-- RADICAR MEMORIAL -->

<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				<tr>
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr>
																	
					<td>
							
						<div class="form-row">
	  
	  
							<div class="form-group col-md-6">
							  <label for="input_2">N.C.C. o NIT (USUARIO)</label>
							  <input type="number" class="form-control" name="dato1U" id="dato1U" placeholder="Ingrese N.C.C. o NIT" readonly="true">
							</div>
							
							<div class="form-group col-md-6">
							  <label for="input_1"><?php echo utf8_encode("Nueva contraseña");?></label>
							  <input type="password" class="form-control" name="dato2U" id="dato2U" placeholder="<?php echo utf8_encode("Nueva contraseña");?>">
							</div>
							
					
					  </div>
						
					</td>
				
				
					
				</tr> 
				
				<tr>
																	
					<td>
							
						<div class="form-row">
	  
							<div class="form-group col-md-6">
							  <label for="input_1">Nombre</label>
							  <input type="text" class="form-control" name="dato3U" id="dato3U" placeholder="Ingrese Nombre">
							</div>
							
							<div class="form-group col-md-6">
							  <label for="input_5">Correo Electronico</label>
							  <input type="text" class="form-control" name="dato4U" id="dato4U" placeholder="Ingrese Correo Electronico">
							</div>
							
						  
							
						
						 </div>
						
					</td>
				
				
					
				</tr> 
				
				<tr>
																	
					<td>
							
						<div class="form-row">
	  
		
    	
	
							<div class="form-group col-md-6">
							
								  <label for="input_7">Tipo Usuario:</label>
								 
								  <select class="form-control" name="dato5U" id="dato5U" data-validacion-tipo="requerido">
																					
											<option value="" selected="selected">Seleccionar Opcion</option>
											<option value="1">ABOGADO</option>
											<option value="2">NO ABOGADO</option>  
																								
											
								</select>
							
							</div>
								
							<div class="form-group col-md-6">
								
								  <label for="input_8">Celular</label>
								  <input type="text" class="form-control" name="dato6U" id="dato6U" placeholder="Ingrese Celular">
								  
							</div>
							  
								
						</div>
						
					</td>
				
				
					
				</tr> 
				
				
				<tr>
				
					<td>
					
						<a id="editar_usuario" title="EDITAR USUARIO">
						
							<button type="button" class="btn btn-primary" title="EDITAR USUARIO">
								<span class="glyphicon glyphicon-floppy-saved"></span><h4>EDITAR USUARIO</h4>
							</button>
						
						</a>
						
						
					</td>
					
				</tr>
				
				<tr>
					<td>
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr id="fila_cargando" align="center">
				
					<td>
						<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
					</td>
													
				</tr>
				
				<tr>
				
					<td>
					
					
						<!-- CAMPOS OCULTOS -->
						<br>
						<input type="hidden" class="form-control" name="iduser" id="iduser" readonly="true">
								  
					</td>
				
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
        	<p>Plataforma <?php echo utf8_encode(' Diseñada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
			<p>Plataforma Desarrollado por</p>
			<p>Ingeniero de Sistemas Jorge Andres Valencia Orozco (Oficina de Ejecucion Civil Municipal Manizales)</p>  
			          
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
