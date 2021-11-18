<?php 

session_start(); 

if($_SESSION['id']!=""){

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new archivoModel();

//Llamamos a la funciÛn
//$ip_equipo = $modelo->getRealIP();
//echo $ip_equipo;

//$idradicado = trim($_REQUEST['idradi']);
//echo trim($_REQUEST['idradi']);
//$radi       = trim($_REQUEST['radi']);

//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_modificarOtro.php
$datosexpF  = explode("******",trim($_GET['datosexpF']));

$idradicado = trim($datosexpF[0]);
$radi       = trim($datosexpF[1]);

//SE CAPTURA EL ID DE JUZGADO PARA SER REGISTRADO COLUMNA idjuzgado TABLA expe_digital
//ESTA PARTE POR CUESTIONES DE GENERAR ESTADO POR PARTE DEL AREA DE SECRETARIA
$id_juzgado   =  $modelo->get_Id_Juzgado_Proceso($idradicado);
$fila_juzgado = $id_juzgado->fetch();
$id_juzgadoX  = $fila_juzgado[idjuzgado_reparto];

if($id_juzgadoX == 1){

	$id_juzgadoX = 15;

}

if($id_juzgadoX == 2){

	$id_juzgadoX = 16;

}

//echo $id_juzgadoX;

//--------------------------------FIN-------------------------------------------------------------

//FECHA - HORA
date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
$horaregistro  = date('H:i');

$idusuario      = $_SESSION['idUsuario'];
	
$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];

//LISTAS
$nombrelista   = 'expe_cuaderno';
$campoordenar  = 'id';
$datosCUADERNO = $modelo->get_lista($nombrelista,$campoordenar);



//******************ID USUARIOS, QUE CARGAN AUTOS AL EXPEDIENTE DIGITAL Y SE IDENTIFICA PARA EL ESTADO DEL DIA SIGUIENTE***************
$campos              = 'usuario';
$nombrelista         = 'pa_usuario_acciones';
$idaccion	         = '32';
$campoordenar        = 'id';
$datos_DES_1         = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_DES_2         = $datos_DES_1->fetch();
$datos_DES_3	     = explode("////",$datos_DES_2[usuario]);
		
$bandera_DES         = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_DES_3,true) ){
		
	$bandera_DES = 1;
}	
				
//******************FIN ID USUARIOS, QUE CARGAN AUTOS AL EXPEDIENTE DIGITAL Y SE IDENTIFICA PARA EL ESTADO DEL DIA SIGUIENTE***************


//******************ID USUARIOS, QUE CARGAN AUTOS AL EXPEDIENTE DIGITAL Y AL CARGAR EL AUTO SE VISUALIZA OPCION REVISAR, 
//YA QUE EN LA VISTA DEL JUEZ LOS IDENTIFICA COMO PROCESOS QUE LE ENTRARON MEMORIALES Y AUN SUS COSTAS NO ESTAN HECHAS***************
$idaccion	         = '36';
$campoordenar        = 'id';
$datos_COST_1        = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_COST_2        = $datos_COST_1->fetch();
$datos_COST_3	     = explode("////",$datos_COST_2[usuario]);
		
$bandera_COST        = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_COST_3,true) ){
		
	$bandera_COST = 1;
}	
				
//******************FIN ID USUARIOS, QUE CARGAN AUTOS AL EXPEDIENTE DIGITAL Y AL CARGAR EL AUTO SE VISUALIZA OPCION REVISAR, 
//YA QUE EN LA VISTA DEL JUEZ LOS IDENTIFICA COMO PROCESOS QUE LE ENTRARON MEMORIALES Y AUN SUS COSTAS NO ESTAN HECHAS



//******************ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA VISTA NUEVO Y EDITA FOLIO***************
$idaccion	  = '42';
$campoordenar = 'id';
$datos_42_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_42_2   = $datos_42_1->fetch();
$datos_42_3	  = explode("////",$datos_42_2[usuario]);
		
$bandera_42   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_42_3,true) ){
		
	$bandera_42 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA VISTA NUEVO Y EDITA FOLIO***************


//******************ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 AL 12 JUZGADO MUNICIPAL  Y OFICINA DE EJECUCION***************
$idaccion	  = '43';
$campoordenar = 'id';
$datos_43_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_43_2   = $datos_43_1->fetch();
$datos_43_3	  = explode("////",$datos_43_2[usuario]);
		
$bandera_43   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_43_3,true) ){
		
	$bandera_43 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 AL 12 JUZGADO MUNICIPAL  Y OFICINA DE EJECUCION***************


//******************ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************
$idaccion	  = '44';
$campoordenar = 'id';
$datos_44_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_44_2   = $datos_44_1->fetch();
$datos_44_3	  = explode("////",$datos_44_2[usuario]);
		
$bandera_44   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_44_3,true) ){
		
	$bandera_44 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************


//******************ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 2 JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************
$idaccion	  = '45';
$campoordenar = 'id';
$datos_45_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_45_2   = $datos_45_1->fetch();
$datos_45_3	  = explode("////",$datos_45_2[usuario]);
		
$bandera_45   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_45_3,true) ){
		
	$bandera_45 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 2 JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************

//******************ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 Y 2  JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************
$idaccion	  = '46';
$campoordenar = 'id';
$datos_46_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_46_2   = $datos_46_1->fetch();
$datos_46_3	  = explode("////",$datos_46_2[usuario]);
		
$bandera_46   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_46_3,true) ){
		
	$bandera_46 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 Y 2  JUZGADO EJECUCION  Y OFICINA DE EJECUCION***************


//******************ID USUARIOS, QUE PERTENECEN AL J1 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 15 EN id_dependencia DE LA TABLA pa_usuario***************
$idaccion	  = '47';
$campoordenar = 'id';
$datos_47_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_47_2   = $datos_47_1->fetch();
$datos_47_3	  = explode("////",$datos_47_2[usuario]);
		
$bandera_47   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_47_3,true) ){
		
	$bandera_47 = 1;
}	
//******************FIN ID USUARIOS, QUE PERTENECEN AL J1 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 15 EN id_dependencia DE LA TABLA pa_usuario***************


//******************ID USUARIOS, QUE PERTENECEN AL J2 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 16 EN id_dependencia DE LA TABLA pa_usuario***************
$idaccion	  = '48';
$campoordenar = 'id';
$datos_48_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_48_2   = $datos_48_1->fetch();
$datos_48_3	  = explode("////",$datos_48_2[usuario]);
		
$bandera_48   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_48_3,true) ){
		
	$bandera_48 = 1;
}	
//******************FIN ID USUARIOS, QUE PERTENECEN AL J2 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 16 EN id_dependencia DE LA TABLA pa_usuario***************



//CARGAR LISTA DEPENDENCIA SEGUN PARAMETRIZACION
//ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 AL 12 JUZGADO MUNICIPAL  Y OFICINA DE EJECUCION
if($bandera_43 == 1){

	$nombrelista      = 'pa_juzgado';
	$campoordenar     = 'id';
	$datosDEPENDENCIA = $modelo->get_lista_parametro($nombrelista,$campoordenar,43);

}
//ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 JUZGADO EJECUCION  Y OFICINA DE EJECUCION
if($bandera_44 == 1){

	$nombrelista      = 'pa_juzgado';
	$campoordenar     = 'id';
	$datosDEPENDENCIA = $modelo->get_lista_parametro($nombrelista,$campoordenar,44);

}
//ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 2 JUZGADO EJECUCION  Y OFICINA DE EJECUCION
if($bandera_45 == 1){

	$nombrelista       = 'pa_juzgado';
	$campoordenar     = 'id';
	$datosDEPENDENCIA = $modelo->get_lista_parametro($nombrelista,$campoordenar,45);

}
//ID USUARIOS, QUE VISUALIZAN LISTA DEPENDENCIA 1 Y 2  JUZGADO EJECUCION  Y OFICINA DE EJECUCION
if($bandera_46 == 1){

	$nombrelista      = 'pa_juzgado';
	$campoordenar     = 'id';
	$datosDEPENDENCIA = $modelo->get_lista_parametro($nombrelista,$campoordenar,46);

}


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
		
		
		<script type="text/javascript">

/*$(document).ready(function() {



	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPA—OL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','S·b'],
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
	 
	 $("#fecha_estado").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	

});*/

</script>
		

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


<center>

<h2 class="page-header">

	REGISTAR NUEVO FOLIO(S)
	
	<br>
	<h2><?php echo "ID: ".$idradicado." RADICADO: ".$radi;?></h2>
	
</h2>

</center>


<div class="btn-toolbar" role="toolbar">

  <!-- <a href="index.php?controller=archivo&action=edit_archivoOtro&nombre=<?php //echo $idradicado; ?>" title="Regresar"> -->
  <a href="index.php?controller=archivo&action=Expediente_Digital&datosexp=<?php echo $idradicado."******".$radi; ?>" title="Regresar">
  
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<br>

<form id="frm-alumno" action="index.php?controller=archivo&action=CrearMultiple&idradi=<?php echo $idradicado; ?>&radi=<?php echo $radi; ?>" method="post" enctype="multipart/form-data">
    
    <div id="alumnos" class="row">
<div id="lo-que-vamos-a-copiar">
    <!-- <div class="col-xs-4"> --><!-- ASI ESTABA 25 MARZO 2021 -->
	<div class="col-md-4 col-center col-md-offset-4"> 
        <div class="well well-sm">
		
			<!-- 
				VALIDAR UN CAMPO Y LIMITARLO
				data-validacion-tipo="requerido|min:23" 
			
			-->
			
			<input type="hidden" id="idradiX" name="idradiX" value="<?php echo $idradicado; ?>" readonly="true">
            <input type="hidden" id="radiX" name="radiX" value="<?php echo $radi; ?>" readonly="true">
			
			<input type="hidden" id="id_juzgadoX" name="id_juzgadoX" value="<?php echo $id_juzgadoX; ?>" readonly="true">
			
			<input type="hidden" id="digitalizadoX" name="digitalizadoX" readonly="true">
			
			<div class="form-group">
                <label>idradicado</label>
                <input type="text" name="idradicado[]" class="form-control" placeholder="Ingrese Id Radicado" value="<?php echo $idradicado; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
			<div class="form-group">
                <label>Fecha Incorporacion Expediente</label>
                <input type="text" name="fecha[]" class="form-control" placeholder="Fecha Incorporacion Expediente" value="<?php echo $fecharegistro; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
			<div class="form-group">
                <label>Hora</label>
                <input type="text" name="hora[]" class="form-control" placeholder="Ingrese Id Radicado" value="<?php echo $horaregistro; ?>" data-validacion-tipo="requerido" readonly="true" />
            </div>
			
			<?php	
			//SOLO SE VISUALIZA A USUARIOS QUE NO ESTAN PARAMETRIZADOS EN LA TABLA
			//pa_usuario_acciones ID = 32 
			//ID USUARIOS, QUE CARGAN AUTOS AL EXPEDIENTE DIGITAL Y SE IDENTIFICA PARA EL ESTADO DEL DIA SIGUIENTE
			//YA QUE LA FECHA DE CREACION DEL DOCUMENTO ES LA FECHA_ESTADO DE LA TABLA expe_digital
			if($bandera_DES == 0){
			?>
			<div class="form-group">
			
            	<label>Digitalizado</label>
				<input type="checkbox" id="checkDIGI" class="checkbox"/>
	
            </div>
			
			<div id="fechacre" class="form-group">
                <label>Fecha Creacion Documento</label>
                <input type="text" name="fecha_cre[]" class="form-control datepicker" placeholder="Ingrese Fecha Creacion Documento"/>
            </div>
			
			<div id="fechasdigi" class="form-group">
		
				<label>Fecha De</label>
				<input type="text" name="fecha_de[]" class="form-control datepicker" placeholder="Ingrese Fecha De"/>
				<label>Fecha A</label>
				<input type="text" name="fecha_a[]" class="form-control datepicker" placeholder="Ingrese Fecha A"/>
				
            </div>
			
			<?php
			 }
			?>
         
			<div class="form-group">
                <label>Paginas</label>
                <input type="number" name="folios[]" class="form-control" placeholder="Ingrese Paginas" data-validacion-tipo="requerido" />
            </div> 

       
            <div class="form-group">
                <label>Cuaderno</label>
                <select name="cuaderno[]" class="form-control" data-validacion-tipo="requerido">
				
					<option value="" selected="selected">Seleccionar Cuaderno</option> 
                    <!-- <option value="1">CUADERNO PRINCIPAL</option>
                    <option value="2">CUADERNO DE MEDIDAS</option> -->
					
					<?php
					while($row = $datosCUADERNO->fetch()){
																				
						echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																				
																				
					}
					?>
					
					
					
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
			
			<?php	
			if($bandera_DES == 1){
			?>
			
				
			
				<div class="form-group">
					<label>Para Estado</label>
					<select name="paraestado[]" class="form-control" data-validacion-tipo="requerido">
					
						<option value="" selected="selected">Seleccionar Para Estado</option> 
						<option value="0">NO</option>
						<option value="1">SI</option>
						
						<?php	
						if($bandera_COST  == 1){
						?>
						
							<option value="5">REVISAR</option>
							
						<?php
						 }
						?>
						
					</select>
				</div>
				
				<div class="form-group">
					<label>Fecha Auto</label>
					<input type="text" name="fecha_estado[]" class="form-control datepicker" placeholder="Ingrese Fecha Auto" data-validacion-tipo="requerido"/>
            	</div>
			 
			<?php
			 }
			?>
			 
			
			<?php	
			//SE VISUALIZA LA LISTA DE DEPENDENCIA
			if($bandera_42 == 1){
			?>
			
				<div class="form-group">
					<label>Dependencia</label>
					<select id="dependencia_2" name="dependencia[]" class="form-control" data-validacion-tipo="requerido">
					
						<option value="" selected="selected">Seleccionar Dependencia</option> 
						<!-- <option value="1">CUADERNO PRINCIPAL</option>
						<option value="2">CUADERNO DE MEDIDAS</option> -->
						
						<?php
						while($row = $datosDEPENDENCIA->fetch()){
																					
							echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
																					
																					
						}
						?>
						
						
						
					</select>
				</div>
				
				<div id="otrad" class="form-group">
					<label style="color:#FF0000">Otra</label>
					<input type="text" name="otradep[]" class="form-control" placeholder="Ingrese Otra"/>
				</div>
			
			
			<?php
			 }
			 //NO SE VISUALIZA LA LISTA DE DEPENDENCIA
			 else{
			 
			 	//USUARIO PERTENECIENTE A LA OFICNA DE EJECUCION, Y NO VISUALIZA LA LISTA DEPENDENCIA
				//YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 18 EN id_dependencia DE LA TABLA pa_usuario
				//DICHOS USUARIOS NO ESTAN EN LAS pa_usuario_acciones DEL ID 42,43,44,45,46,47,48
			 	if($bandera_42 == 0 && $bandera_43 == 0 && $bandera_44 == 0 && $bandera_45 == 0 && $bandera_46 == 0 && $bandera_47 == 0 && $bandera_48 == 0){
				
			?>
				
					<input type="hidden" name="dependencia[]" class="form-control" value = "18" data-validacion-tipo="requerido" readonly="true"/>
			
			<?php
			
				}
				
				//ID USUARIOS, QUE PERTENECEN AL J1 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA 
				//YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 15 EN id_dependencia DE LA TABLA pa_usuario
			 	if($bandera_47 == 1){
				
			?>
					
					<input type="hidden" name="dependencia[]" class="form-control" value = "15" data-validacion-tipo="requerido" readonly="true"/>
			
			<?php
			
				}
				
				//ID USUARIOS, QUE PERTENECEN AL J2 JUZGADO1 DE EJECUCION  Y NO QUE VISUALIZAN LISTA DEPENDENCIA 
				//YA QUE EL SISTEMA AUTOMATICAMENTE ASIGNA 16 EN id_dependencia DE LA TABLA pa_usuario
				if($bandera_48 == 1){
			
			?>
				
					<input type="hidden" name="dependencia[]" class="form-control" value = "16" data-validacion-tipo="requerido" readonly="true"/>
			<?php
					
				}
				
			
			}//FIN ELSE
			?>
			
			
			
			<!-- NO ES REQUERIDO, SI EL USUARIO DSEA ESCRIBE ALGO -->
			<div class="form-group">
                <label>Observacion</label>
				<textarea name="obs[]" class="form-control" placeholder="Ingrese Observacion"></textarea>
                <!-- <input type="text" name="obs[]" class="form-control" placeholder="Ingrese Observacion"/> -->
            </div>
			
			<div class="alert alert-info alert-dismissable">
		 
		  		<span class="glyphicon glyphicon-hand-right"></span>
		  		<strong>!RECOMENDACION! Es muy importante que leas este mensaje.</strong>
		  		<br>
		  		- EL NOMBRE DEL FOLIO(S) DEBE SER SIN TILDES,SIN ESPACIOS,SIN PUNTOS Y FORMATO PDF / WORD<br>
				- NOMBRES CONFORMADOS POR LETRAS O NUMEROS Y TODO PEGADO<br>
		
			</div>
			
			<div class="form-group">
			
				
				<label>Folio(s)</label>
				<input type="file" name="Foto[]" placeholder="Ingrese un Archivo pdf" class="form-control" data-validacion-tipo="requerido"/>
				
			</div>
			
            <!-- <div class="row">
                <div class="col-xs-6">
				
                    <div class="form-group">
                     
						<br>
						<label style="width:300px; height:23px; border-color:#000000; color:#FF0000; font-size:18px ">CARGAR FOLIO(S)</label>
						<br>
				  		<label style="width:500px; height:73px; border-color:#000000; color:#FF0000; font-size:12px ">EL NOMBRE DEL FOLIO(S) DEBE SER SIN TILDES,SIN ESPACIOS,SIN PUNTOS Y FORMATO PDF / WORD</label>
						<br>
				  		<label style="width:500px; height:43px; border-color:#000000; color:#FF0000; font-size:12px ">SOLO SE PERMITE EL CARACTER RAYA AL MEDIO (-), RAYA AL PISO (_) Y NOMBRES CONFORMADOS POR LETRAS O NUMEROS Y TODO PEGADO</label>
						
						<br>
						<br>
						<br>
						<label>Folio(s)</label>
						<input type="file" name="Foto[]" placeholder="Ingrese un Archivo pdf" data-validacion-tipo="requerido"/>
						
                    </div>     
					
                </div>
            </div>   -->
			
			
			
        </div>
    </div>            
</div>

<!-- BOTON ADICIONAR MAS FOLIOS -->
<!-- <div class="col-xs-4">
    <div class="well">
      
		<button  type="button" id="btn-alumno-agregar" class="btn btn-success btn-lg btn-block btn-default" title="Agregar-Folio(s)"><span class="glyphicon glyphicon-list-alt"></span><h4>Agregar-Folio(s)</h4></button> 
		         
    </div>
</div>  -->

    </div>
    
    <hr />
    
    <!-- <div class="text-right">
        <button class="btn btn-success btn-lg btn-block">Guardar</button>
    </div> -->
	
	 <div class="text-center">
        
		<button id="registrar_folio" class="btn btn-success" title="REGISTRAR FOLIO(S)"><span class="glyphicon glyphicon-floppy-saved"></span><h4>REGISTRAR FOLIO(S)</h4></button>
		
     </div>
	 
	 <div id="fila_cargando" class="text-center">
        
		<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
		
     </div>
	
	<!-- <tr id="fila_cargando" align="center">
		<td colspan="2">
			<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
		</td>
										
	</tr> -->
	
	
</form>

<script>
    $(document).ready(function(){
	
			 
		//OCULTAR GIF CARGANDO
		$('#fila_cargando').hide();
		
		 //CAMPO OCULTO FECHAS DIGILTALIZADO FECHA DE - FECHA A 
		$('#fechasdigi').hide();
		
		 //CAMPO OCULTO OTRA DEPENENCIA
		$('#otrad').hide();
		
		
		$("#checkDIGI").change(function () {
			  
			  
			  
			  if($("#checkDIGI").is(':checked')) {  
			  
				$('#fechasdigi').show();
				
				$('#fechacre').hide();
				
				$('#digitalizadoX').val(1);
			  
			  }
			  else{
			  
				$('#fechasdigi').hide();
				
				$('#fechacre').show();
				
				$('#digitalizadoX').val(2);
				
			  }
			
		});
		
		
		$("#dependencia_2").change(function () {
			  
		 
			 var iddep = $("#dependencia_2").find(':selected').val();
			 
			 //alert(iddep);
			 
			 if(iddep == 19){
			 
			 	$('#otrad').show();
			 }
			 else{
			 
			 	$('#otrad').hide();
			 }
			
		});
	 
		
		
        // El formulario que queremos replicar
        var formulario_alumno = $("#lo-que-vamos-a-copiar").html();
        
		// El encargado de agregar m√°s formularios
		$("#btn-alumno-agregar").click(function(){
			// Agregamos el formulario
			$("#alumnos").prepend(formulario_alumno);
		
			// Agregamos un boton para retirar el formulario
			$("#alumnos .col-xs-4:first .well").append('<button class="btn-danger btn btn-block btn-retirar-alumno" type="button">Retirar</button>');
		
			// Hacemos focus en el primer input del formulario
			$("#alumnos .col-xs-4:first .well input:first").focus();
		
			// Volvemos a cargar todo los plugins que teniamos, dentro de esta funcion esta el del datepicker assets/js/ini.js
			Plugins();
		});
        
        // Cuando hacemos click en el boton de retirar
        $("#alumnos").on('click', '.btn-retirar-alumno', function(){
            $(this).closest('.col-xs-4').remove();
        })
            
        $("#frm-alumno").submit(function(){
			
			$validado = $(this).validate();
			if($validado == true){
			
				//OCULTAMOS BOTON REGISTRAR
				//PARA EVITAR QUE EL USUARIO DE CLIC
				//VARIAS VECES Y SE DUPLIQUE EL REGISTRO
				$('#registrar_folio').hide();
											
				$('#fila_cargando').show();
			
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
        	<p>Plataforma <?php echo utf8_encode(' DiseÒada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
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