<div id="contentSecc_solicitudes">

<ul id="menusec">

  <!-- <li><a href="index.php?controller=menu&amp;action=mod_solicitudes">Home</a>  </li>

 
  
  <div id="sep">|</div> -->
  
  
   <li><a href="#">Gestion de Calidad</a>

    <ul class="submenu">

    	<?php 
		if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==51){?>   
										 
			<li>
				<a href="index.php?controller=archivo&action=Adicionar_Accion_2">Resgistrar Accion</a>
													
			</li>
												
		<?php }?>
											
			<li>
				<a href="index.php?controller=archivo&action=Gestionar_Actividad">Gestionar Actividad</a>
			</li>
			
			
		
		<?php 
		if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==51){?>   
										 
			
			<!-- <li>
				
				<a href="index.php?controller=archivo&action=Cargar_Acciones_CSV">Cargar Acciones</a>
													
			</li>
			
			<li>
				
				<a href="index.php?controller=archivo&action=Cargar_Actividad_CSV">Cargar Actividades</a>
													
			</li> -->
												
		<?php }?>
	
    </ul>
	
  </li>
  
  
  
   <div id="sep">|</div>

  
  <li><a href="#">Solicitudes</a>

    <ul class="submenu">

          <?PHP if($_SESSION['tipo_perfil']=='admin'){?><li><a href="index.php?controller=correspondencia&amp;action=regpeticion">Registrar Solicitud</a></li><?php }?>
           <li><a href="index.php?controller=correspondencia&amp;action=listarSolicitudesReg">Listar Solicitudes</a></li>
    </ul>
	
  </li>
  
    
</ul>
  
  
  

</div>