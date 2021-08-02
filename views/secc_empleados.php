<div id="contentSecc_empleados">

	<ul id="menusec">
	
		  	<li><a href="index.php?controller=menu&amp;action=mod_empleados">Home</a></li>
		
			<div id="sep">|</div>
				
			<li><a href="#">Registro Empleados</a>
					
				<ul class="submenu">
					<li><a href="index.php?controller=empleados&amp;action=regIngresoSalida">Registrar Ingreso - Salida</a></li>
					<!-- <li><a href="index.php?controller=empleados&amp;action=listarIngresoSalida">Listar Ingreso - Salida</a></li> -->
				
				</ul>
		  	</li>
		
		  <?php if ($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38) {  ?>
		  
		  <div id="sep">|</div>
		  
		  <li>
		  
				<a href="#">Reportes</a>
				
				<ul class="submenu">
					
					<li>
						<a href= "index.php?controller=empleados&amp;action=repsListaPermisos">Listar Permisos - Aprobar Permisos</a>
					</li>

				</ul>
				
		  </li>
		  
		  <?php } ?>
	  
	</ul>

</div>