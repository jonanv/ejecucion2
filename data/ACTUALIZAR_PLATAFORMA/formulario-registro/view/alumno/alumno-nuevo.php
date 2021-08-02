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
	<img src="view/images/logorama.png" width="300" height="100"/> 
</h3>
</center>

<!-- <ol class="breadcrumb">
  <li><a href="?c=Alumno">Alumnos</a></li>
  <li class="active">Registro Usuario</li>
</ol> -->

<div class="btn-toolbar" role="toolbar">

  <a href="?c=Alumno&a=Ramapublica" title="Regresar">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<center><h3 class="page-header">REGISTRAR USUARIO / PLATAFORMA WEB RAMAJUDICIALPUBLICA</h3></center>


<form id="frm-alumno" action="?c=Alumno&a=CrearMultiple" method="post" enctype="multipart/form-data">
    
   <!--  <div id="alumnos" class="row"> -->
	<div class="col-md-10 col-md-offset-4">

		<div class="col-xs-6">
		
			<div class="well well-sm">
			
				<div class="form-group">
					<label>Cedula (Sin espacios, Puntos, Comas y Tildes)</label><br>
					<input type="number" name="nombre_usuario[]" class="form-control" placeholder="Ingrese su Cedula" data-validacion-tipo="requerido" />
				</div>
	
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" name="contrasena[]" class="form-control" placeholder="Ingrese su Contraseña" data-validacion-tipo="requerido"  value="<?php echo $contrasena; ?>"/>
				</div>
				
				<div class="form-group">
					<label>Nombre Completo</label>
					<input type="text" name="empleado[]" class="form-control" placeholder="Ingrese su Nombre Completo" data-validacion-tipo="requerido" value="<?php echo $empleado; ?>"/>
				</div>
	
			</div>
		</div>            
		
    </div>
	
	<div class="col-md-10 col-md-offset-4">

		<div class="col-xs-6">
		
			<div class="well well-sm">
			
				   <div class="text-right">
						<button class="btn btn-success btn-lg btn-block">Registrar</button>
					</div>
	
			</div>
		</div>            
		
    </div>
    
   
    
 
</form>

<!-- VALIDA FORMULARIO -->
<script>
    $(document).ready(function(){
        
        $("#frm-alumno").submit(function(){
            return $(this).validate();
        });
    })
</script>