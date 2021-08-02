<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new indexModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//LISTA BASE DE DATOS LOCAL
	$nombrelista  = 'dda_municipio';
	$campoordenar = 'des';
	$filtro       = 'WHERE id IN(001,873,174)';
	$formaordenar = '';
	$datosMUNI    = $modelo->get_lista_filtro($nombrelista,$campoordenar,$formaordenar,$filtro);
	
	$nombrelista  = 'dda_departamento';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosDPTO    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>ACCESO / PLATAFORMA WEB RAMA JUDICIAL PUBLICA</title>



		<meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>


</head>

<body>

<center>
<h3 class="page-header">
    <?php //echo $alm->__GET('id') != null ? $alm->__GET('nombre_usuario') : 'REGISTRO USUARIO'; ?>
	<br>
	RAMA JUDICIAL DEL PODER PÚBLICO
	<br>
	DIRECCIÓN EJECUTIVA DE ADMINISTRACIÓN JUDICIAL
	<br>
	SECCIONAL CALDAS
	<br>
	<img src="views/images/logorama.png" width="300" height="100"/> 
</h3>
</center>

<!-- <ol class="breadcrumb">
  <li><a href="?c=Alumno">Alumnos</a></li>
  <li class="active">Registro Usuario</li>
</ol> -->

<!-- <div class="btn-toolbar" role="toolbar">

  <a href="?c=Alumno&a=Ramapublica" title="Regresar">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div> -->

<center><h3 class="page-header">PLATAFORMA WEB RAMA JUDICIAL PUBLICA</h3></center>


<form id="frm-login" action="index.php?controller=index&action=login_user" method="post" enctype="multipart/form-data">
    
	
	
    <!-- <div id="datoslogin" class="row"> -->
	
	<div class="col-md-10 col-md-offset-4">

		<div class="col-xs-4"> 
		
			<div class="well well-sm"> 
			
				<div class="form-group">
					<label>Usuario</label><br>
					<input type="text" name="user" class="form-control" placeholder="Ingrese su Usuario" data-validacion-tipo="requerido" />
				</div>
	
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" name="pass" class="form-control" placeholder="Ingrese su Contraseña" data-validacion-tipo="requerido" />
				</div>
				
		
				<div class="form-group">
					<label>Municipio</label>
					<select class="form-control" name="listaM" id="listaM" data-validacion-tipo="requerido">
																		
								<option value="" selected="selected">Seleccionar Municipio</option> 
																							
								<?php
									while($row = $datosMUNI->fetch()){
																										
										echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																										
																										
									}
								?>
					</select>
				</div>
				
				
	
			</div> 
			
		</div>            

	</div>
	
	
	
	
	<!-- <div id="btnlogin" class="row"> -->
	
	<div class="col-md-10 col-md-offset-4">
	
		<div class="col-xs-4"> 
			
			<div class="well well-sm"> 
				
				<div class="text-right">
					<button class="btn btn-success btn-lg btn-block">INICIAR SESION</button>
				</div>
						
			</div> 
				
		</div>            
	
	
	</div>
	
	
	<div class="col-md-10 col-md-offset-4">
	
		<div class="col-xs-4"> 
		
			<div class="well well-sm"> 
	
				<table class="tabla">
				  
				  <tr>
				  
					  <td>
					  
						  <!-- <a href="index.php?controller=userpublico&amp;action=Formulario_Registro"" title="Crear Usuario"> -->
						  <a href="formulario-registro/?c=Alumno&a=Crud" title="Registro Usuario">
					  
							 <button type="button"> 
								Registro Usuario
							  </button>
						  
						  </a>  
					  
					  </td>
					  
					 
				  
				  </tr>  	
				  
				</table>
			
		
			</div>
			
		</div>
	
	</div>
	
	<!-- OCULTO CAMPO DEPARTAMENTO, PARA REALIZAR VALIDACIONES DE INGRESO
	Y VISUALIZACION DE INFORMACION EN LA PLATAFORMA
	 -->
	<div class="col-md-10 col-md-offset-4" style="visibility:hidden">
	
		<div class="col-xs-4"> 
			
			<div class="well well-sm"> 
			
				
				<div class="form-group" >
		
					  <label>Departamento</label>
					 
					  <select class="form-control" name="listaD" id="listaD">
																
						<!-- <option value="" selected="selected">Seleccionar Departamento</option>  -->
																			
						<?php
							while($row = $datosDPTO->fetch()){
																						
								echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																						
																						
							}
						?>
					</select>
				  
				  
				</div>
				
				
				
						
			</div> 
				
		</div>            
	
	
	</div>
		
		
</form>



<!-- VALIDA FORMULARIO -->
<script>
$(document).ready(function(){
        
    
       
        $("#frm-login").submit(function(){
            return $(this).validate();
        });
		
		
});
</script>

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