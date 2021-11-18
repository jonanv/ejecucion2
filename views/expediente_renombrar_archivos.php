<?php 

session_start(); 

if($_SESSION['id']!=""){

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new archivoModel();

//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_modificarOtro.php
$datosINDICE  = explode("******",trim($_GET['datosINDICE']));

$idradicado = trim($datosINDICE[0]);
$radi       = trim($datosINDICE[1]);


//FECHA - HORA
date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
$horaregistro  = date('H:i');

$idusuario      = $_SESSION['idUsuario'];

$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];	


$datosACCION_1RAX = $modelo->listar_proceso_digital($idradicado);
		
//*********************CANTIDAD REGISTROS*****************************************
	
$datosACCION_2RAX = $modelo->listar_proceso_digital($idradicado);
		
$fcRAX = 0;
while($fila_cantRAX = $datosACCION_2RAX->fetch()){		
		
	$fcRAX = $fcRAX + 1; 
			
}
		
$cantregisRAX = $fcRAX;

//*************************************************************************************


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>RENOMBRAR ARCHIVOS</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->

        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		<script type="text/javascript">

$(document).ready(function() {



	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 /*$.datepicker.regional['es'] = {
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
	 
	 $("#fecha_estado").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});*/
	 
	 
	 $("#recargar_formu").click(function(evento){
	
		var id_radi = "<?php echo $idradicado; ?>";
		var nradi   = "<?php echo $radi; ?>";
		
		var datosexp = id_radi+"******"+nradi;
		
		location.href='index.php?controller=archivo&action=Renombrar_Archivos_Expediente&datosINDICE='+datosexp;
	
	
	});
	 
	

});

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

  <a href="index.php?controller=archivo&action=Expediente_Digital&datosexp=<?php echo $idradicado."******".$radi; ?>" title="Regresar">
  
   
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<center>

<h3 class="page-header">

	RENOMBRAR ARCHIVOS
	
	<br>
	<h3><?php echo "ID: ".$idradicado." RADICADO: ".$radi;?></h3>
	
</h3>

</center>

<center>

	
	<a id="recargar_formu" title="RECARGAR">
	
		<button type="button" class="btn btn-default" title="RECARGAR">
			<span class="glyphicon glyphicon-repeat"></span>RECARGAR
		</button>
			
	</a>
	
</center>

<?php echo "Numero de Registros: ".$cantregisRAX; ?>



<form id="frm-alumnoX" action="index.php?controller=archivo&action=RenombrarMultiple_Masivo&idradi=<?php echo $idradicado; ?>&radi=<?php echo $radi; ?>" method="post" enctype="multipart/form-data">


	<input type="hidden" id="idradiX"     name="idradiX"     value="<?php echo $idradicado; ?>" readonly="true">
	<input type="hidden" id="radiX"       name="radiX"       value="<?php echo $radi; ?>" readonly="true">
	
	
	<?php
	if($cantregisRAX >= 1){
	?>
	<div class="text-left">
        
		<button id="registrar_folioX" class="btn btn-primary" title="RENOMBRAR ARCHIVOS"><span class="glyphicon glyphicon-floppy-saved"></span>RENOMBRAR ARCHIVOS</button>
		
	</div>
	<br>
	<?php
	}
	?>
	
	
	<div id="fila_cargando" class="text-center">
			
		<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
			
	</div>
	
	<table class="table table-striped table-bordered table table-hover" id="tindice">
		<thead>
			<tr class="success">
			  
				<th style="width:80px; text-align:center">Id</th>
				<th style="width:600px; text-align:center">N. Documento</th>
				<th style="width:300px; text-align:center">Cuaderno</th>
				<th style="width:300px; text-align:center">Descripcion</th>
				<th style="width:600px; text-align:center">R. Archivo</th>
				<th style="width:80px; text-align:center">Orden</th>
				
			</tr>
		</thead>
		
	   
		
		
		<?php
		
				
				while($filaRA = $datosACCION_1RAX->fetch()){
					
			
					$d1RA = $filaRA[id];
					
					//NOMBRE DOCUMENTO
					$d2RA_1           = explode("/",$filaRA[ruta]);	
					$d2RA_2           = utf8_encode($d2RA_1[3]);
					$nombre_documento = $modelo->get_nuevo_nombreVISUAL($d2RA_2,$filaRA[orden_documento]);
					
					$d3RA = utf8_encode($filaRA[ruta]);
					$d4RA = $filaRA[orden_documento];
					
					$d5RA = $filaRA[descuaderno];
					
					$d6RA = $filaRA[cuaderno];
					
					$d7RA = utf8_encode($filaRA[des]);
					
					//SE CAPTURA DIRECTAMENTE DE LA BASE DE DATOS TABLA expe_cuaderno
					//COLUMNA STYLO, COMO SERA EL COLOR DE LA FILA SEGUN EL EL NUMERO DE CUADERNO
					//EJEMPLO:
					//<td class="numero" style="width:80px; font-size:12px; background-color:#FFFF93">
					$estilo_cuaderno  = $modelo->get_estilo_cuaderno($d6RA);
						
					
			?>
		
			<tr>
			   
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:80px; font-size:11px; text-align:center">  -->
				
					
						<div class="form-group">
						<label>Id</label><br>
						<input type="text" name="id[]" value="<?php echo $d1RA; ?>" title="<?php echo $d1RA; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:600px; font-size:11px; text-align:center"> --> 
				

						<div class="form-group">
						<label>Nombre Documento</label><br>
						<input type="text" name="d2ra[]" value="<?php echo $nombre_documento; ?>" title="<?php echo $nombre_documento; ?>" style="border-style:none; text-align:center; width:600px;" data-validacion-tipo="requerido"/>
						<br>
						<!-- 
						ESTE CAMPO SE COMPARA CON d2ra[] Y SI SON DIFERENTES, 
						INDICA QUE ESE NOMBRE DE ESE ARCHIVO SE ESTA RENOMBRANDO
						Y SE DEJA COMO CAMPO OCULTO
						-->
						<input type="text" name="d2ra_b[]" value="<?php echo $nombre_documento; ?>" title="<?php echo $nombre_documento; ?>" style="border-style:none; text-align:center; width:600px; visibility:hidden" readonly="true"/>
						</div>
						 
					</td>
					
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:300px; font-size:11px; text-align:center">  -->
				
						<div class="form-group">
						<label>Cuaderno</label><br> 
						<input type="text" name="d5ra[]" value="<?php echo $d5RA; ?>" title="<?php echo $d5RA; ?>" readonly="true" style="border-style:none; text-align:center; width:300px;" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:300px; font-size:11px; text-align:center">  -->
				
						<div class="form-group">
						<label>Descripcion</label><br> 
						<input type="text" name="d7ra[]" value="<?php echo $d7RA; ?>" title="<?php echo $d7RA; ?>" readonly="true" style="border-style:none; text-align:center; width:300px;" data-validacion-tipo="requerido"/>
						</div>
					</td>
	
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:600px; font-size:11px; text-align:center">  -->
				
						<div class="form-group">
						<label>Ruta Archivo</label><br> 
						<input type="text" name="d3ra[]" value="<?php echo $d3RA; ?>" title="<?php echo $d3RA; ?>" readonly="true" style="border-style:none; text-align:center; width:600px;" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<?php echo $estilo_cuaderno; ?>
					<!-- <td style="width:80px; font-size:11px; text-align:center">  -->
				
						<div class="form-group">
						<label>Orden Documento</label><br> 
						<input type="text" name="d4ra[]" value="<?php echo $d4RA; ?>" title="<?php echo $d4RA; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					

				
			</tr>
		<?php  }  ?>
		
	   
	</table> 
	
	

</form>


<script>

    $(document).ready(function(){
	
		//OCULTAR GIF CARGANDO
		$('#fila_cargando').hide();
			    
        $("#frm-alumnoX").submit(function(){
			
			$validado = $(this).validate();
			
			if($validado == true){
			
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					//OCULTAMOS BOTON REGISTRAR
					//PARA EVITAR QUE EL USUARIO DE CLIC
					//VARIAS VECES Y SE DUPLIQUE EL REGISTRO
					$('#registrar_folioX').hide();
												
					$('#fila_cargando').show();
					
				}
			
			}
			
            return $(this).validate();
        });
		
		
		
    })
</script>

<?php  }else{ echo "NO ES POSIBLE VISUALIZAR EXPEDIENTE DIGITAL, NO SE A DETECTADO NINGUNA SESION DE USUARIO INICIADA..."; } ?>


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