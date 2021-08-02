<div id="contentSecc_correspondencia">

<ul id="menusec">

  <li><a href="index.php?controller=menu&amp;action=mod_correspondencia">Home</a>  </li>
  
 
  <div id="sep">|</div>

  

  <li><a href="#">Memoriales</a>

    <ul class="submenu">

       <!-- <?PHP// if($_SESSION['tipo_perfil']=='admin'){?>  <li><a href="index.php?controller=correspondencia&amp;action=regmemorial">Registrar Ingreso Documentos </a></li><?php //}?>-->
           <li><a href="index.php?controller=correspondencia&amp;action=listarDocumentos">Listar Documentos</a></li>
           </ul>
  </li>
  <div id="sep">|</div>

  

  <li><a href="#">Tutelas</a>

  <ul class="submenu">

          <li><a href="index.php?controller=correspondencia&amp;action=regcorrespondenciatutela">Registrar Tutela</a></li>
<!--         <li><a href="index.php?controller=correspondencia&amp;action=listarCorrespondenciasTutelas">Listar Radicados Tutelas-Incidentes</a></li>
		  <li><a href="index.php?controller=correspondencia&amp;action=listarActuaciones&nombre=1">Listar Actuaciones</a></li>-->
          <li><a href="index.php?controller=correspondencia&amp;action=filtrar_radicados">Listar Radicados Tutelas-Incidentes</a></li>
          <li><a href="index.php?controller=correspondencia&amp;action=filtrar_actuaciones">Listar Actuaciones</a></li>
          <li><a href="index.php?controller=correspondencia&amp;action=filtrar_partes">Listar Partes Tutelas</a></li>
		  
		  <!-- NUEVO, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA -->
		  <li>
			<a href="index.php?controller=correspondencia&action=Asignar_Numero_Guia">Asignar Numero de Guia</a>
		  </li>
		  
  </ul>
  </li>
   <div id="sep">|</div>

  

  <li><a href="#">Correspondencia</a>

  <ul class="submenu">

             <li><a href="index.php?controller=correspondencia&amp;action=regcorrespondenciaotro">Registrar Correspondencia Otro</a></li>
            <!--<li><a href="index.php?controller=correspondencia&amp;action=listarCorrespondencias">Listar Correspondencia Otros</a></li>-->
               <li><a href="index.php?controller=correspondencia&amp;action=filtrar_otros">Listar Correspondencia Otros</a></li>
         </ul>
  </li>
   <div id="sep">|</div>
  <li><a href="#">Turnos</a>

        <ul class="submenu">

            <li><a href="index.php?controller=correspondencia&amp;action=regTurno">Registrar Turno</a></li>
            
            <li><a href="index.php?controller=correspondencia&amp;action=filtrar_turnos">Listar Turnos</a></li>
        </ul>
  </li>

  <div id="sep">|</div>
  <li><a href="#">Reportes</a>

        <ul class="submenu">

            <li><a href="index.php?controller=correspondencia&amp;action=excel_472&nombre=1">Generar Plantilla 472</a></li>

            <li><a href="index.php?controller=correspondencia&amp;action=informeDireccion&nombre=1">Generar Informe Direcci&oacute;n</a></li>
            <li><a href="index.php?controller=correspondencia&amp;action=ReporteNotificacionIncidentes&nombre=2">Informe Notificaci&oacute;n e Incidentes</a></li>
                  <li></li>
        </ul>
  </li>

  <div id="sep"></div>

  
  <div id="sep">|</div>
    <div id="sep"></div>
  </ul>

</div>