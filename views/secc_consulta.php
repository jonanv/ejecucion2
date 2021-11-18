<div id="contentSecc_consulta">

<ul id="menusec">

  <li><a href="index.php?controller=menu&amp;action=mod_consulta">Home</a>  </li>

  <div id="sep">|</div>

	
		<?php 
			if($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 51 
			   || $_SESSION['idUsuario'] == 28 || $_SESSION['idUsuario'] == 68 || $_SESSION['idUsuario'] == 5 || $_SESSION['idUsuario'] == 55 || $_SESSION['idUsuario'] == 19){?>
								
				<li><a href="index.php?controller=consulta&amp;action=consultar_ponente">Cambio de Ponente</a></li>
				<li><a href="index.php?controller=consulta&amp;action=consultar">Consulta Justicia</a></li>
		<?php 
			}
		?>	
	
  

  <div id="sep"></div>
  </ul>

</div>