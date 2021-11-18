<div id="contentSecc_archivo">

<ul id="menusec">

  <li><a href="index.php?controller=menu&amp;action=mod_archivo">Home</a>  </li>

  <div id="sep">|</div>

  <li><a href="#">Liquidaciones</a>
    <ul class="submenu">
 <?php if($_SESSION['tipo_perfil']=='admin'){?>   <li><a href="index.php?controller=liquidaciones&amp;action=regLiquidacion">Registrar Liquidaciones</a></li><?php }?>
          <li><a href=
"index.php?controller=liquidaciones&amp;action=listarLiquidacion">Listar Liquidaciones</a></li>

          </ul>
  </li>

  <div id="sep"></div>
  </ul>

</div>