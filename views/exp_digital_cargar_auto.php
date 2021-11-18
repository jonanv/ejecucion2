<?php 

session_start(); 

if($_SESSION['id']!=""){


//$idradicado = trim($_REQUEST['idradi']);
//echo trim($_REQUEST['idradi']);
//$radi       = trim($_REQUEST['radi']);

//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_modificarOtro.php
$datosexpF  = explode("******",trim($_GET['datosexpF']));

$idradicado = trim($datosexpF[0]);
$radi       = trim($datosexpF[1]);
$idactu     = trim($datosexpF[2]);

$Jid_juzgado_3x = trim($datosexpF[3]);
$Jid_juzgado_4x = trim($datosexpF[4]);
$Jid_juzgado_5x = trim($datosexpF[5]);
$Jid_juzgado_6x = trim($datosexpF[6]);

//FECHA - HORA
date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
$horaregistro  = date('H:i');

$idusuario      = $_SESSION['idUsuario'];
	
$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>FOLIO(S) EXPEDIENTE DIGITAL</title>
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
		

<!-- <h1 class="page-header">
    <?php //echo $alm->__GET('id') != null ? $alm->__GET('idradicado') : 'Registro Folios'; ?>
</h1> -->

<!-- <ol class="breadcrumb">
  <li><a href="?c=Alumno&idradi=<?php //echo $idradicado; ?>&radi=<?php //echo $radi; ?>">Expediente Digital</a></li>
  <li class="active">Registro Folios</li>
</ol> -->


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


<center><h1 class="page-header">REGISTAR NUEVO FOLIO(S)</h1></center>

<!-- <center><h3 class="page-header"><?php //require_once('demanda_ubicacion.php'); ?></h3></center> -->

<h3 class="page-header"><?php echo "ID: ".$idradicado; ?></h3>
<h3 class="page-header"><?php echo "RADICADO: ".$radi; ?></h3>


<div class="well well-sm text-right">


	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Cerrar Sesion">
		Menu-Principal
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
    
	<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
		Cerrar-Sesion
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
	
	
</div>

<h4 class="page-header"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></h4>

<div class="btn-toolbar" role="toolbar">

  <!-- <a href="index.php?controller=archivo&action=edit_archivoOtro&nombre=<?php //echo $idradicado; ?>" title="Regresar"> -->
  <a href="index.php?controller=archivo&action=Expediente_Digital&datosexp=<?php echo $idradicado."******".$radi; ?>" title="Regresar">
  
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<br>

<form id="frm-alumno" action="index.php?controller=archivo&action=CrearMultiple_Despacho&idradi=<?php echo $idradicado; ?>&radi=<?php echo $radi; ?>" method="post" enctype="multipart/form-data">
    
    <div id="alumnos" class="row">
<div id="lo-que-vamos-a-copiar">
    <div class="col-xs-4">
        <div class="well well-sm">
		
			<!-- 
				VALIDAR UN CAMPO Y LIMITARLO
				data-validacion-tipo="requerido|min:23" 
			
			-->
			
			<input type="hidden" id="idradiX" name="idradiX" value="<?php echo $idradicado; ?>" readonly="true">
            <input type="hidden" id="radiX" name="radiX" value="<?php echo $radi; ?>" readonly="true">
			<input type="hidden" id="idactuX" name="idactuX" value="<?php echo $idactu; ?>" readonly="true">
			
			<input type="hidden" id="d1X" name="d1X" value="<?php echo $Jid_juzgado_3x; ?>" readonly="true">
            <input type="hidden" id="d2X" name="d2X" value="<?php echo $Jid_juzgado_4x; ?>" readonly="true">
			<input type="hidden" id="d3X" name="d3X" value="<?php echo $Jid_juzgado_5x; ?>" readonly="true">
			<input type="hidden" id="d4X" name="d4X" value="<?php echo $Jid_juzgado_6x; ?>" readonly="true">
			
			
			<div class="form-group">
                <label>idradicado</label> 
                <input type="text" name="idradicado[]" class="form-control" placeholder="Ingrese Id Radicado" value="<?php echo $idradicado; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
			<div class="form-group">
                <label>Fecha</label>
                <input type="text" name="fecha[]" class="form-control" placeholder="Ingrese Id Radicado" value="<?php echo $fecharegistro; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
			<div class="form-group">
                <label>Hora</label>
                <input type="text" name="hora[]" class="form-control" placeholder="Ingrese Id Radicado" value="<?php echo $horaregistro; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
            <div class="form-group">
                <label>Folio Inicial</label>
                <input type="number" name="folio_i[]" class="form-control" placeholder="Ingrese Folio Inicial" data-validacion-tipo="requerido" />
            </div>

            <div class="form-group">
                <label>Folio Final</label>
                <input type="number" name="folio_f[]" class="form-control" placeholder="Ingrese Folio Final" data-validacion-tipo="requerido" />
            </div>

           <!--  <div class="form-group">
                <label>Correo</label>
                <input type="text" name="Correo[]" class="form-control" placeholder="Ingrese su correo electrónico" data-validacion-tipo="requerido|email" />
            </div> -->

            <div class="form-group">
                <label>Cuaderno</label>
                <select name="cuaderno[]" class="form-control">
                    <option value="1">CUADERNO PRINCIPAL</option>
                    <option value="2">CUADERNO DE MEDIDAS</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <label>Fecha de nacimiento</label>
                <input readonly type="text" name="FechaNacimiento[]" class="form-control datepicker" placeholder="Ingrese su fecha de nacimiento" data-validacion-tipo="requerido" />
            </div> -->
			
			
			 <div class="form-group">
                <label>Descripcion</label>
                <input type="text" name="des[]" class="form-control" placeholder="Ingrese Descripcion" data-validacion-tipo="requerido" />
            </div>

            <div class="row">
                <div class="col-xs-6">
				
                    <div class="form-group">
                     
						<br>
						<label style="width:300px; height:23px; border-color:#000000; color:#FF0000; font-size:18px ">CARGAR FOLIO(S)</label>
						<br>
				  		<label style="width:500px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">EL NOMBRE DEL FOLIO(S) DEBE SER SIN TILDES,SIN ESPACIOS,SIN PUNTOS Y FORMATO PDF</label>
						<br>
						<br>
						<br>
						<label style="width:500px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">NOMBRES CONSTITUIDOS POR NUMEROS Y LETRAS</label>
						<br>
						<br>
						<br>
						<label>Folio(s)</label>
						<input type="file" name="Foto[]" placeholder="Ingrese un Archivo pdf" data-validacion-tipo="requerido"/>
						
                    </div>     
					
                </div>
            </div>  
			
			
			
        </div>
    </div>            
</div>
<!-- <div class="col-xs-4">
    <div class="well">
           
		<button  type="button" id="btn-alumno-agregar" class="btn btn-success btn-lg btn-block btn-default" title="Agregar-Folio(s)"><span class="glyphicon glyphicon-list-alt"></span><h4>Agregar-Folio(s)</h4></button>          
    </div>
</div> -->
    </div>
    
    <hr />
    
    <!-- <div class="text-right">
        <button class="btn btn-success btn-lg btn-block">Guardar</button>
    </div> -->
	
	 <div class="text-center">
        
		<button class="btn btn-success" title="REGISTRAR FOLIO(S)"><span class="glyphicon glyphicon-floppy-saved"></span><h4>REGISTRAR FOLIO(S)</h4></button>
		
    </div>
	
	
</form>

<script>
    $(document).ready(function(){
        
        // El formulario que queremos replicar
        var formulario_alumno = $("#lo-que-vamos-a-copiar").html();
        
// El encargado de agregar más formularios
$("#btn-alumno-agregar").click(function(){
    // Agregamos el formulario
    $("#alumnos").prepend(formulario_alumno);

    // Agregamos un boton para retirar el formulario
    $("#alumnos .col-xs-4:first .well").append('<button class="btn-danger btn btn-block btn-retirar-alumno" type="button">Retirar</button>');

    // Hacemos focus en el primer input del formulario
    $("#alumnos .col-xs-4:first .well input:first").focus();

    // Volvemos a cargar todo los plugins que teníamos, dentro de esta función esta el del datepicker assets/js/ini.js
    Plugins();
});
        
        // Cuando hacemos click en el boton de retirar
        $("#alumnos").on('click', '.btn-retirar-alumno', function(){
            $(this).closest('.col-xs-4').remove();
        })
            
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>

<?php  }else{ echo "NO ES POSIBLE VISUALIZAR EXPEDIENTE DIGITAL, NO SE A DETECTADO NINGUNA SESION DE USUARIO INICIADA..."; } ?>


<div class="row">
	<div class="col-xs-12">
     	<footer class="text-center">
       		<hr />
        	<p>Plataforma Dise�ada por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
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