
<?php 
	

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	
	//$servidor_pdf = "127.0.0.1";
	
	$servidor_pdf = trim($_SESSION['ipplataforma']);
	
	//echo $_SESSION['ipplataforma'];

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	if($opcion == 1){
	
		$datoJXX1 = trim($_GET['datox1']);//radicado
		
		$datoJXX2 = trim($_GET['dato_2']);//fecha registro inicial
		$datoJXX3 = trim($_GET['dato_3']);//fecha registro final
		
		
		$datosACCION_1 = $modelo->lista_Expedientes_bloqueados_filtro($datoJXX1,$datoJXX2,$datoJXX3);
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->lista_Expedientes_bloqueados_filtro($datoJXX1,$datoJXX2,$datoJXX3);
			
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
			
			$fc = $fc + 1; 
		
		}
			
		$cantregis = $fc;
			
		//*************************************************************************************
			
			

	}//FIN if($opcion == 1){
	else{
	
		$datosACCION_1 = $modelo->lista_Expedientes_bloqueados();
			
		//*********************CANTIDAD REGISTROS*****************************************
		
		$datosACCION = $modelo->lista_Expedientes_bloqueados();
			
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
			
			$fc = $fc + 1; 
		
		}
			
		$cantregis = $fc;
			
		//*************************************************************************************
	
	}
	
	
	//---------------------------------------------------------------OPCIONES PARA EL MENU ADMINISTRAR--------------------------------------------------------------------
	
	//******************ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************
	$campos       = 'usuario';
	$nombrelista  = 'pa_usuario_acciones';
	$idaccion	  = '37';
	$campoordenar = 'id';
	$admin_expe   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_expe_1 = $admin_expe->fetch();
	$admin_expe_2 = explode("////",$admin_expe_1[usuario]);
	
	$bandera_ADMIN_EXPE = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_expe_2,true) ){
	
		$bandera_ADMIN_EXPE = 1;
	}	
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************


	//******************ID USUARIOS, PARA VISUALIZAR MEMORIALES RADICADOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	  = '38';
	$campoordenar = 'id';
	$admin_memo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_memo_1 = $admin_memo->fetch();
	$admin_memo_2 = explode("////",$admin_memo_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_ADMIN_MEMO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_memo_2,true) ){
	
		$bandera_ADMIN_MEMO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************

	//******************ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	    = '39';
	$campoordenar   = 'id';
	$admin_titulo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_titulo_1 = $admin_titulo->fetch();
	$admin_titulo_2 = explode("////",$admin_titulo_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_ADMIN_TITULO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_titulo_2,true) ){
	
		$bandera_ADMIN_TITULO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
	//******************FIN ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************
	
	
	
	//******************ID USUARIOS, QUE PUEDEN BLOQUEAR Y DESBLOQUEAR PROCESOS***************
	
	$idaccion	    = '52';
	$campoordenar   = 'id';
	$datosusuario52 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_52_1  = $datosusuario52->fetch();
	$usuarios_52_2	= explode("////",$usuarios_52_1[usuario]);
	
	$bandera52      = 0;
	
	if ( in_array($_SESSION['idUsuario'],$usuarios_52_2,true) ){
	
		$bandera52 = 1;
	}	
	
	//******************FIN ID USUARIOS, QUE PUEDEN BLOQUEAR Y DESBLOQUEAR PROCESOS***************
	
	
	//---------------------------------------------------------------FIN OPCIONES PARA EL MENU ADMINISTRAR--------------------------------------------------------------------

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>EXPEDIENTES BLOQUEADOS</title>
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
		<!-- <script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
		<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8"> -->
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
	 
	 var ip_servidor = "<?php echo $servidor_pdf; ?>";
	 //var servidor    = "127.0.0.1";
	 var servidor    = ip_servidor;
	 
	 
	$("#recargar_pro").click(function(evento){
	
		/*var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		var datosexp = id_radi+"******"+nradi;
		
		location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexp;*/
		
		location.href='index.php?controller=archivo&action=Lista_Expedientes_Bloqueados';
	
	
	});
	
	$("#buscar_pro").click(function(evento){
	
			//alert("BUSCANDO...");
			
			//var id_radi = "<?php echo $id_radi; ?>";
			//var nradi   = "<?php echo $nradi; ?>";
			
			//var datosexp_2 = id_radi+"******"+nradi;
			
	
		
			if( 
				
			  	
			 	$('#filtro1').val().length   == 0 && 
				$('#filtro2').val().length   == 0 && 
				$('#filtro3').val().length   == 0 
			   
			) {
				
				alert("Definir Algun Filtro Para Realizar la Busquedad");
		
				
				document.getElementById('filtro1').style.borderColor  =  '#FF0000';
				document.getElementById('filtro2').style.borderColor  =  '#FF0000';
				document.getElementById('filtro3').style.borderColor  =  '#FF0000';
				
				
			}
			else{
				
				//alert("BUSCANDO...");
		
				dato_0 = 1;
				
				//RADICADO		
				datox1 = $('#filtro1').val();
						
				//FECHAS REGISTRO
				dato_2 = $('#filtro2').val(); 
				dato_3 = $('#filtro3').val();
						
				
				//alert(datox4);
						
				location.href="index.php?controller=archivo&action=Busquedad_Expedientes_Bloqueados&dato_0="+dato_0+"&dato_2="+dato_2+"&dato_3="+dato_3+"&datox1="+datox1;
						
						
			}
		
		
	
	});
	
	$(".expe_digital").click(function(evento){
	
		var idradicado   = $(this).attr('data-idradicado');
		var radicadoproc = $(this).attr('data-radicadoproc');
		
		var configuracion_ventana = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
				
		window.open("index.php?controller=archivo&action=Expediente_Digital&datosexp="+idradicado+"******"+radicadoproc,"EXPEDIENTE DIGITALIZADO", configuracion_ventana);
	
	
	});
	
	$('#exampleModal_1').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTUACIONES EXPEDIENTE: ' + recipient_2[0])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(1);

		/* OBTENEMOS TABLA */
		
		var tabla_actu = recipient_2[1].split("******");
		
		for(var i=0;i<tabla_actu.length - 1;i++){
		
			tabla_actu_2 = tabla_actu[i].split("//////");
			
			A110CONSACTU = tabla_actu_2[0];	
			A110FECHREGI = tabla_actu_2[1];
			A110DESCACTU = tabla_actu_2[2];
			
			
			registro+="<tr>"
						
				registro+="<td class='A110CONSACTU' style='text-align:center'>"+A110CONSACTU+"</td>"
				registro+="<td class='A110FECHREGI' style='text-align:center'>"+A110FECHREGI+"</td>"
				registro+="<td class='A110DESCACTU' style='text-align:center'>"+A110DESCACTU+"</td>"
				
			registro+="</tr>"
					
					
			$('.editinplace_1').append(registro);
				
			registro = "";
			
		}
		
		/*$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_actuaciones.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			
			
			for(var i=0;i<json.length;i++)
			{
				
				
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='empleado'>"+json[i].empleado+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_4').append(registro);
				
				registro = "";
			}
			
		});*/
	  
	  
  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	
	$('#exampleModal_2').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('******')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTUACIONES DEL PROCESO: ' + recipient_2[1])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_actuaciones.php?tabla=1",
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
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='empleado'>"+json[i].empleado+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	//DESBLOQUEAR PROCESO
	$("#desbloquear_proceso").click(function(evento){
	
	
		var id_radibloc1 = $(this).attr('data-id');
		var radibloc1    = $(this).attr('data-radicado');
		
		//alert(id_radi_digi);
		
		var data = new FormData();
						
		data.append('id_radibloc1',id_radibloc1);
		data.append('radibloc1',radibloc1);
		
		
		if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
								
								
									
									
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
										
					//url:'views/popupbox/subir.php', //Url a donde la enviaremos
					url:'index.php?controller=archivo&action=Desbloquear_Proceso',
					type:'POST', //Metodo que usaremos
					contentType:false, //Debe estar en false para que pase el objeto sin procesar
					//data:dataString, //Le pasamos el objeto que creamos con los archivos
					data:data,
					processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
					cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
										
					$('.mensageds').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensageds').show('slow');//Mostramos el div.
										
					//DESAPARECER
					setTimeout(function() {
											
						$(".mensageds").fadeOut(1500);
											
											
							location.href="index.php?controller=archivo&action=Lista_Expedientes_Bloqueados";
											
							
											
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
		var TABLA = document.getElementById('tactu');
				
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
		var TABLA = document.getElementById('tactusiepro');
				
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
#mdialTamanio_3{
  width: 100% !important;
}
#mdialTamanio_5{
  width: 100% !important;
}



		.mensageds{
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


<input type="hidden" name="fechaactual" id="fechaactual" readonly="true" value ="<?php echo $fechaactual; ?>"/>
<input type="hidden" name="datos_soli" id="datos_soli" readonly="true"/>



<!-- MENU DE ADMINISTRACION HORIZONTAL -->

<?php 

//SIEMPRE 1, PARA QUE TODOS LOS USUARIOS
//DE LA OFICINA LO VEAN Y SOLO LAS OPCIONES INTERNAS
//SE PARAMETIZEN PARA USUARIOS ESPECIFICOS
$bandera_ADMIN_EXPE = 1;

if($bandera_ADMIN_EXPE == 1){

?>
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

<?php 
}
?>

<!-- FIN MENU HORIZONTAL -->




<center><h2 class="page-header">EXPEDIENTES BLOQUEADOS</h2></center>


<!-- <div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=archivo&action=Expediente_Digital" title="Regresar">
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div> -->


<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header"  style="color:#0033FF">FILTROS PARA BUSQUEDA</h4>
	
	<a id="buscar_pro" title="BUSCAR">
	
		<button type="button" class="btn btn-default" title="BUSCAR">
			<span class="glyphicon glyphicon-search"></span>BUSCAR
		</button>
			
	</a>
	
	<a id="recargar_pro" title="RECARGAR">
	
		<button type="button" class="btn btn-default" title="RECARGAR">
			<span class="glyphicon glyphicon-repeat"></span>RECARGAR
		</button>
			
	</a>
	
</center>

<!-- <form id="frmfiltro"> -->

<br>

<!-- FILTROS -->

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->

<table id="tabla_filtros" class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-6">
				  <label for="input_1">RADICADO</label>
				  <input type="number" class="form-control" name="filtro1" id="filtro1" value="<?php echo trim($_GET['datox1']); ?>" placeholder="Ingrese Radicado">
				</div>
				
				
			</div>
			
		</td>
		
		
			
	</tr>  
	
	
	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-6">
				  <label for="input_1">Fecha Registro Inicial</label>
				  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Inicial">
				</div>
				
				<div class="form-group col-md-6">
				  <label for="input_1">Fecha Registro Final</label>
				  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php echo trim($_GET['dato_3']); ?>" placeholder="Ingrese Fecha Registro Final">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
	
</table> 

</div>

<!-- FIN FILTROS -->

<br>


<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->

<table class="table"> 


	<tr>
															
		
		
		<td>
		
			<center>
			<h4 class="page-header" style="color:#0033FF">
				NUMERO DE REGISTROS: <?php echo $cantregis; ?>
			</h4>
			</center>
			
			

			
		</td>
		
		
	</tr> 
	
	
</table>


<!-- MENSAJES -->
<table class="table"> 

	<tr>
		<td colspan="2">
			
			<div class="mensageds"></div>  
		</td>
										
	</tr>
		
	
</table> 

<!-- <table class="table" align="center"> 

	<tr>
		<td>
			ARCHIVO
		</td>
										
	</tr>
	<tr>
		<td>
			<iframe id="icontenido"></iframe>
		</td>
										
	</tr>
		
</table> -->

<table class="table table-striped table-bordered table table-hover" id="tsoli">
    <thead>
        <tr class="success">
            
			<th style="width:120px; text-align:center">ID</th>
			<th style="width:120px; text-align:center">FECHA</th>
			<th style="width:120px; text-align:center">HORA</th>
			<th style="width:120px; text-align:center">BLOQUEA</th>
			<th style="width:120px; text-align:center">RADICADO</th>
			<th style="width:120px; text-align:center">DESBLOQUEAR</th>
			<th style="width:120px; text-align:center">ACTUACIONES JXXI</th>
			<th style="width:120px; text-align:center">ACTUACIONES SIEPRO</th>
			<th style="width:120px; text-align:center">DIGITALIZADO</th>
            
        </tr>
    </thead>
    
  
	<?php
											
			$Ct110=1;
			
			$contador_registros = 1;
			
			while($fila = $datosACCION_1->fetch()){
				
				$d0M = $fila[id];
				$d1M = $fila[fechablodes];
				$d2M = $fila[horablodes];
				$d3M = $fila[empleado];
				$d4M = $fila[radiblodes];
				$d5M = $fila[digitalizado];
				
				
				//SE CAPTURA DE LA TABLA expe_digital, PARA DETERMINAR QUE UN EXPEDIENTE
				//SI ESTA DIGITALIZADO Y NO SOLO MIRAR LA VARIABLE $d5M  = $fila[digitalizado];
				//DE LA TABLA ubicacion_expediente
				$d6M = $modelo->ncuadernos_proceso($d0M);
				
				
		?>
    
    
        <tr>
           
		   
			
				<!-- <td style="width:30px;"> 
							
					<?php //echo $contador_registros; //NUMERO REGISTRO ?>
							
				</td> -->
				
				<td style="width:30px; text-align:center"> 
			
					<?php echo $d0M; //id?>
				
				</td>
			
			
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d1M; //fecha?>
				
				</td>
				
				
				<td style="width:120px; text-align:center"> 
			
					<?php echo $d2M; //hora?>
				
				</td>
				
			
				<td style="width:120px; text-align:center"> 
			
					<?php 
					
						echo utf8_encode($d3M); //bloquea
						
				
					?>
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<?php 
						
						echo $d4M; //radicado
						//ACTUACIONES DEL PROCESO DESDE JUSTICIA XXI
						$actus = $modelo->get_Actuaciones_JusticiaXXI($d4M);
						
					?>
				
				</td>
				
				<?php 
			
				if ($bandera52 == 1){ 
				?>   
				<td style="width:120px; text-align:center"> 
				
					<a id="desbloquear_proceso" href="javascript:void(0);" data-id="<?php echo $d0M;?>" data-radicado="<?php echo $d4M;?>" style="float:right" title="DESBLOQUEAR PROCESO">
					
						<button type="button" class="btn btn-primary">
							<span class="glyphicon glyphicon-ok-circle"></span> Desbloquear Proceso
						</button>
						
					</a>
				
				</td>
				<?php 
		
				}else{ 
				?>
				<td style="width:120px; text-align:center"> 
				
					-
				</td>
				
				<?php 
		
				}
				?>
				
				<td style="width:120px; text-align:center"> 
			
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_1" data-whatever="<?php echo $d4M."*/*/*".$actus;?>">
				
						<span class="glyphicon glyphicon-list-alt"></span> Actuaciones Expediente JXXI
							
					</button>
					
					
				
				</td>
				
				<td style="width:120px; text-align:center"> 
			
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php echo $d0M."******".$d4M;?>">
				
						<span class="glyphicon glyphicon-list-alt"></span> Actuaciones Expediente SIEPRO
							
					</button>
					
					
				
				</td>
				
				
				<td style="width:120px; text-align:center"> 
			
					<?php 
						
						if($d5M == 1 && $d6M >= 1){
					
					?>
						
						<a class="expe_digital" href="javascript:void(0);" title="<?php echo "EXPEDIENTE DIGITAL ".$d4M;?>" data-idradicado="<?php echo $d0M;?>" data-radicadoproc="<?php echo $d4M;?>"><img src="views/images/des1.png" width="35" height="35"/></a> 
					
					<?php 
								
						}
						else{
						
							echo "EXPEDIENTE NO ESTA DIGITALIZADO";
						}

						
					?>
				
				</td>
				
		
        </tr>
		
    <?php  $contador_registros = $contador_registros + 1;  $Ct110=$Ct110+1; }  ?>
	
		
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 



<!-- VENTANAS MODALES -->


<!-- VENTANAS MODALES -->

<!-- ACTUACIONES DEL PROCESO DESDE JUSTICIA XXI-->

<div class="modal fade" id="exampleModal_1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUACIONES DEL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="tactu" border="1" class="table table-striped table-bordered table table-hover editinplace_1">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success">
													
					<th style="text-align:center">ID</th>
					<th style="text-align:center">FECHA</th>
					<th style="text-align:center">ACTUACION</th>
					
					
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



<div class="modal fade" id="exampleModal_2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUACIONES DEL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="tactusiepro" border="1" class="table table-striped table-bordered table table-hover editinplace_2">
																							
											
				<tr class="success">
													
					<th>ID</th>
					<th>FECHA</th>
					<th>OBSERVACION</th>
					<th>USUARIO</th>
					
					
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
