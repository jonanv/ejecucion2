<?php  

require_once('./models/administrarModel.php');

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo = new administrarModel();

$imagen=$foto;

//ACCION QUE DETERMINA QUE USUARIOS EN SESION PUEDEN REALIZAR CAMBIO DE PONENTE
$campos                = 'usuario';
$nombrelista           = 'pa_usuario_acciones';
$idaccion			   = '8';
$campoordenar          = 'id';
$datosusuarioaccionesR = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuarios_ADMIN        = $datosusuarioaccionesR->fetch();
$usuarios_ADMIN_2	   = explode("////",$usuarios_ADMIN[usuario]);

?>

<div id="contentSecc_administrar">

	<ul id="menusec">

		<!--   <li>
			
			<a href="index.php?controller=menu&amp;action=mod_caratula">Home</a>  
		  
		  </li> -->

		<!--   <div id="sep">|</div> -->
		<?php
  		if ( in_array($_SESSION['idUsuario'],$usuarios_ADMIN_2,true) ) { 
   
  		?>
		 <li>
		  
				<a href="#">Administrar</a>
				
				<ul class="submenu">
				
					<li>
						<a href= "index.php?controller=administrar&amp;action=Administrar_Archivo">Administrar Archivo</a>
					</li> 
					
					<li>
						<a href= "index.php?controller=administrar&amp;action=Administrar_Archivo_Listar">Administrar Archivo Listar</a>
					</li> 
					
				</ul>
				
		  </li>
		 
		  <div id="sep">|</div>
		   
		  <?php } ?>
		  
		 
		  <li>
		  
				<a href="#">Hoja de Vida</a>
				
				<ul class="submenu">
				
					<li>
						<a href= "index.php?controller=hojavida&amp;action=Administrar_HojaVida">Administrar Hoja de Vida</a>
					</li> 
					
					<?php
  					if ( in_array($_SESSION['idUsuario'],$usuarios_ADMIN_2,true) ) { 
   
  					?>
						<li>
							<a href= "index.php?controller=hojavida&amp;action=Administrar_HojaVida_Listar">Listar Hojas de Vida</a>
						</li> 
						
					<?php } ?>	
	
				</ul>
				
		  </li>
		  
		  

		 
		  
	</ul>

</div>