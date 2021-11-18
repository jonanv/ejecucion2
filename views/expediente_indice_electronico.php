<?php 

session_start(); 

if($_SESSION['id']!=""){

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo      = new archivoModel();

//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_modificarOtro.php
$datosINDICE  = explode("******",trim($_GET['datosINDICE']));

$idradicado = trim($datosINDICE[0]);
$radi       = trim($datosINDICE[1]);

//SE TOMA LA PARTE NUMERO JUZGADO DEL RADIADO 
//EJ: 170014003 001 20160040500 => 001
//PARA EN LA LISTA DEPENDENCIA SOLO VISUIALIZAR
//EL JUZGADO ORIGEN DEL RADICADO 
$valorradicadoX   = $radi;
$cadena_juzgadoX;
$valorradicado_8X = substr($valorradicadoX, 10, 2);
$sub_radi;
// Recorremos cada carácter de la cadena
for($i=0; $i<strlen($valorradicado_8X); $i++){

	if($valorradicado_8X[0] == 0){
				
		$cadena_juzgadoX = substr($valorradicadoX, 11, 13);
				
		$i = strlen($valorradicado_8X);
				
		$sub_radi = "00".substr($valorradicadoX, 11, 1);
	}
			
	if($valorradicado_8X[0] == 1){
				
		$cadena_juzgadoX = substr($valorradicadoX, 10, 13);
				
		$i = strlen($valorradicado_8X);
				
		$sub_radi = "0".substr($valorradicadoX, 10, 2);
	}
			
}

//echo $sub_radi;


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

//LISTAS
/*$nombrelista       = 'pa_juzgado';
$campoordenar      = 'id';
$datosDEPENDENCIAX = $modelo->get_lista_parametro($nombrelista,$campoordenar,43);*/


//FECHA - HORA
date_default_timezone_set('America/Bogota'); 
$fecharegistro = date('Y-m-d');
$horaregistro  = date('H:i');

$idusuario      = $_SESSION['idUsuario'];

$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];	



$datosACCION_1X = $modelo->listar_indice_electronico($idradicado);
		
//*********************CANTIDAD REGISTROS*****************************************
	
$datosACCIONX = $modelo->listar_indice_electronico($idradicado);
		
$fcX = 0;
while($fila_cantX = $datosACCIONX->fetch()){		
		
	$fcX = $fcX + 1; 
			
}
		
$cantregisX = $fcX;

//*************************************************************************************


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>INDICE ELECTRONICO</title>
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

/*$(document).ready(function() {



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
	 
	 $("#fecha_estado").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	

});*/

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

	INDICE ELECTRONICO
	
	<br>
	<h3><?php echo "ID: ".$idradicado." RADICADO: ".$radi;?></h3>
	
</h3>

</center>

<?php echo "Numero de Registros: ".$cantregisX; ?>



<form id="frm-alumnoX" action="index.php?controller=archivo&action=CrearMultiple_Masivo&idradi=<?php echo $idradicado; ?>&radi=<?php echo $radi; ?>" method="post" enctype="multipart/form-data">


	<input type="hidden" id="idradiX"     name="idradiX"     value="<?php echo $idradicado; ?>" readonly="true">
	<input type="hidden" id="radiX"       name="radiX"       value="<?php echo $radi; ?>" readonly="true">
	<input type="hidden" id="id_juzgadoX" name="id_juzgadoX" value="<?php echo $id_juzgadoX; ?>" readonly="true">
	
	<?php
	if($cantregisX >= 1){
	?>
	<div class="text-left">
        
		<button id="registrar_folioX" class="btn btn-primary" title="REGISTRAR"><span class="glyphicon glyphicon-floppy-saved"></span>REGISTRAR</button>
		
	</div>
	<br>
	<!-- SELECCIONAR MULTIPLES ARCHIVOS -->
	<div class="form-group">
	<label>Archivo(s)</label>
   	<input type="file"  multiple="multiple" name="archivo_carga[]" placeholder="Ingrese un Archivo" data-validacion-tipo="requerido"/>
	</div>
	
	
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
				<th style="width:120px; text-align:center">Nombre Documento</th>
				<th style="width:120px; text-align:center">Fecha Creacion Documento</th>
				<th style="width:120px; text-align:center">Fecha De</th>
				<th style="width:120px; text-align:center">Fecha A</th>
				<th style="width:120px; text-align:center">Fecha Incorporacion Expediente</th>
				<th style="width:80px; text-align:center">Orden Documento </th>
				<th style="width:80px; text-align:center">Numero Paginas</th>
				<th style="width:80px; text-align:center">Pagina Inicio</th>
				<th style="width:80px; text-align:center">Pagina Fin</th>
				<th style="width:120px; text-align:center">Formato</th>
				<th style="width:120px; text-align:center"><?php echo utf8_encode('Tamaño'); ?></th>
				<th style="width:120px; text-align:center">Origen</th>
				<th style="width:120px; text-align:center">Observaciones</th>
				<th style="width:80px; text-align:center">Cuaderno</th>
				<th style="width:120px; text-align:center">Ruta Archivo</th>
				<!-- <th style="width:120px; text-align:center">Cargar Archivo</th> -->
				<th style="width:120px; text-align:center">Dependencia</th>
				
			</tr>
		</thead>
		
	   
		
		
		<?php
												
				while($fila = $datosACCION_1X->fetch()){
					
			
					$d1M  = $fila[id];
					$d2M  = $fila[idradicado];
					$d3M  = utf8_encode($fila[nombre_docuemento]);
					$d4M  = $fila[fecha_cre];
					$d5M  = $fila[fecha_de];
					$d6M  = $fila[fecha_a];
					$d7M  = $fila[fecha_in];
					$d8M  = $fila[orden_documento];
					$d9M  = $fila[numero_paginas];
					$d10M = $fila[pagina_inicio];
					$d11M = $fila[pagina_fin];
					$d12M = $fila[formato];
					$d13M = $fila[tamano];
					$d14M = $fila[origen];
					$d15M = utf8_encode($fila[obs]);
					$d16M = utf8_encode($fila[archivo]);
					$d17M = $fila[cuaderno];
						
					
			?>
		
			<tr>
			   
		
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d1M; ?>
						
						<div class="form-group">
						<label>Id</label>
						<input type="text" name="id[]" value="<?php echo $d1M; ?>" title="<?php echo $d1M; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d3M; ?>
						
						<div class="form-group">
						<label>Nombre Documento</label>
						<input type="text" name="d3ie[]" value="<?php echo $d3M; ?>" title="<?php echo $d3M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						 
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d4M; ?>
						
						<div class="form-group">
						<label>Fecha Creacion</label>
						<input type="text" name="d4ie[]" value="<?php echo $d4M; ?>" title="<?php echo $d4M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
					    </div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d5M; ?>
						
						<div class="form-group">
						<label>Fecha De</label>
						<input type="text" name="d5ie[]" value="<?php echo $d5M; ?>" title="<?php echo $d5M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d6M; ?>
						
						<div class="form-group">
						<label>Fecha A</label>
						<input type="text" name="d6ie[]" value="<?php echo $d6M; ?>" title="<?php echo $d6M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d7M; ?>
						
						<div class="form-group">
						<label>Fecha IE</label>
						<input type="text" name="d7ie[]" value="<?php echo $d7M; ?>" title="<?php echo $d7M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d8M; ?>
						
						<div class="form-group">
						<label>Orden Documento</label>
						<input type="text" name="d8ie[]" value="<?php echo $d8M; ?>" title="<?php echo $d8M; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d9M; ?>
						
						<div class="form-group">
						<label>Numero Paginas</label>
						<input type="text" name="d9ie[]" value="<?php echo $d9M; ?>" title="<?php echo $d9M; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d10M; ?>
						
						<div class="form-group">
						<label>Pagina I</label>
						<input type="text" name="d10ie[]" value="<?php echo $d10M; ?>" title="<?php echo $d10M; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d11M; ?>
						
						<div class="form-group">
						<label>Pagina F</label>
						<input type="text" name="d11ie[]" value="<?php echo $d11M; ?>" title="<?php echo $d11M; ?>" readonly="true" size="5" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d12M; ?>
						
						<div class="form-group">
						<label>Formato</label>
						<input type="text" name="d12ie[]" value="<?php echo $d12M; ?>" title="<?php echo $d12M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d13M; ?>
						
						<div class="form-group">
						<label>Tamano</label> 
						<input type="text" name="d13ie[]" value="<?php echo $d13M; ?>" title="<?php echo $d13M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d14M; ?>
						
						<div class="form-group">
						<label>Origen</label> 
						<input type="text" name="d14ie[]" value="<?php echo $d14M; ?>" title="<?php echo $d14M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
						
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d15M; ?>
						
						<div class="form-group">
						<label>Observacion</label> 
						<input type="text" name="d15ie[]" value="<?php echo $d15M; ?>" title="<?php echo $d15M; ?>" readonly="true" style="border-style:none; text-align:center"/>
						</div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d17M; ?>
						
						<div class="form-group">
						<label>Cuaderno</label>
						<input type="text" name="d17ie[]" value="<?php echo $d17M; ?>" title="<?php echo $d17M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					<td style="width:80px; font-size:11px; text-align:center"> 
				
						<?php //echo $d16M; ?>
						
						<div class="form-group">
						<label>Ruta Archivo</label> 
						<input type="text" name="d16ie[]" value="<?php echo $d16M; ?>" title="<?php echo $d16M; ?>" readonly="true" style="border-style:none; text-align:center" data-validacion-tipo="requerido"/>
						</div>
					</td>
					
					
					<!-- <td style="width:80px; font-size:11px; text-align:center"> 
	
						<div class="form-group">
						<label>Archivo</label> 
						<input type="file" name="archivo_carga[]" placeholder="Ingrese un Archivo" data-validacion-tipo="requerido"/>
						</div>
						   
					</td> -->
					
					<td style="width:120px; font-size:11px; text-align:center"> 
	
						<div class="form-group">
						<label>Dependencia</label> 
						<select name="d18ie[]" class="form-control" data-validacion-tipo="requerido">
					
						<option value="" selected="selected">Seleccionar Dependencia</option> 
						
						<?php
						
						$nombrelista       = 'pa_juzgado';
						$campoordenar      = 'id';
						$datosDEPENDENCIAX = $modelo->get_lista_parametro($nombrelista,$campoordenar,43);
						
						
						
						while($row = $datosDEPENDENCIAX->fetch()){
							
							$numero_juzgado = "00".$row[numero_juzgado];
							
							if($numero_juzgado == $sub_radi){				
																	
								echo "<option value=\"". $row[id] ."\" selected>" . $row[nombre] . "</option>";
							}
																					
																					
						}
						
						unset($datosDEPENDENCIAX);
						
						?>
						
						
						
						</select>
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