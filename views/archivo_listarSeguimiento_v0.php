
<?php require_once('../libs/conexion.php');


$cn=  Conectarse();
$listado=  mysql_query("select segui.id,usuarios.empleado as responsable, segui.fecha,juzgado.nombre,segui.desde,segui.hasta,segui.procesos,segui.consecutivo,
segui.procesos_faltantes,segui.tiempo_incumplimiento
from seguimiento as segui
inner join pa_usuario as usuarios on (usuarios.id=segui.idusuario)
inner join pa_juzgado as juzgado  on (juzgado.id=segui.idjuzgado) order by segui.fecha desc ",$cn);


?>

 <script type="text/javascript" language="javascript" src="views/js/jslistadopaises.js"></script>
<script type="text/javascript">



$(document).ready(function(){
   $('#frm_editar').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );
})

function vinculo(variable)
{

location.href="index.php?controller=archivo&action=show_seguimiento&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=archivo&action=edit_seguimiento&nombre="+variable;
//document.write(location.href) 

}
function vinculo2(variable)
{
if(confirm('Realmente desea eliminar el seguimiento?'))
{
location.href="index.php?controller=archivo&action=elim_seguimiento&nombre="+variable;
//document.write(location.href) 
}
}

</script>


<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Seguimientos</p>
  </div>
</div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                        <tr>
                        <th width="">Responsable&nbsp;</th>
                        <th>Fecha&nbsp;&nbsp; </th>
                        <th>Juzgado</th>
                        <th>Desde&nbsp;</th>
                        <th>Hasta&nbsp; </th>
                        <th># Procesos&nbsp;</th>
                        <th>Consecutivo&nbsp;</th>
                        <th>Procesos Faltantes&nbsp;</th>
                        <th>Tiempo Incumplimiento&nbsp;</th>

                    </tr>
                </thead>
              
                  <tbody>
             
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['responsable'].'</td>';
                               echo '<td>'.$reg['fecha'].'</td>';
							   echo '<td>'.$reg['nombre'].'</td>';
							   echo '<td>'.$reg['desde'].'</td>';
							   echo '<td>'.$reg['hasta'].'</td>';
							   echo '<td>'.$reg['procesos'].'</td>';
							   echo '<td>'.$reg['consecutivo'].'</td>';
							   echo '<td>'.$reg['procesos_faltantes'].'</td>';
							   echo '<td>'.$reg['tiempo_incumplimiento'].'</td>';
							   echo '<td style="cursor:pointer"><img src="views/images/list.png" width="21" height="23" onclick="vinculo('.$reg['id'].')" title="Consultar Seguimiento">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1('.$reg['id'].')" title="Modificar Seguimiento">'.'</td>';
								echo '<td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo2('.$reg['id'].')" title="Modificar Seguimiento">'.'</td>';
                               echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
            </form>
