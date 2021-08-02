
<?php require_once('../libs/conexion.php');


$cn=  Conectarse();
$listado=  mysql_query("select tutelas.id as idt,tutelas.radicado as radicado,area.nombre as area,juzgado.nombre as juzgado ,tutelas.fecha as fecha, tutelas.idjuzgado as idjuz 
from  correspondencia_tutelas tutelas inner join pa_juzgado juzgado on tutelas.idjuzgado=juzgado.id
inner join pa_area area on (area.id=juzgado.idarea) ",$cn);


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

location.href="index.php?controller=correspondencia&action=show_correspondencia&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=edit_correspondenciaTutela&nombre="+variable;
//document.write(location.href) 

}
function vinculo2(variable)
{
location.href="index.php?controller=correspondencia&action=edit_datosTutela&nombre="+variable;
}
function vinculo3(variable,variable1)
{
location.href="index.php?controller=correspondencia&action=regcorrespondenciaincidente&nombre="+variable+"&nombre2="+variable1;
}

</script>


<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Tutelas/Incidentes</p>
  </div>
</div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                      <th>Radicado</th>
                        <th>Especialidad</th>
                        <th>Juzgado </th>
                        <th>Fecha</th>
                    </tr>
                </thead>
              
                  <tbody>
             
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['radicado'].'</td>';
                               echo '<td>'.$reg['area'].'</td>';
							   echo '<td>'.$reg['juzgado'].'</td>';
							   echo '<td align="left">'.$reg['fecha'].'</td>';
							   echo '<td style="cursor:pointer"><img src="views/images/list.png" width="21" height="23" onclick="vinculo('.$reg['idt'].')" title="Consultar Tutela/Incidente">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/add.png" width="21" height="23" onclick="vinculo1('.$reg['idt'].')" title="Adicionar Actuaci&oacute;n">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo2('.$reg['idt'].')" title="Modificar Datos Tutela">'.'</td>';
                               echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
            </form>
