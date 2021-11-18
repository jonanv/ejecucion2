
<?php require_once('../libs/conexion.php');


$cn=  Conectarse();
$listado=  mysql_query("select correspondencia.id as corresid,correspondencia.radicado,juzgado.nombre as juzgadonom,correspondencia.esOficio_Telegrama,correspondencia.oficio_telegrama,
correspondencia.destinatario, medio.nombre as medionot,correspondencia.notificado,correspondencia.direccion
from correspondencia_otros as correspondencia
inner join pa_juzgado as juzgado on (juzgado.id=correspondencia.idjuzgado)
inner join pa_medionotificacion as medio on (medio.id=correspondencia.idmedionotificacion) ",$cn);


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

location.href="index.php?controller=correspondencia&action=show_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=correspondencia&action=edit_correspondenciaOtro&nombre="+variable;
//document.write(location.href) 

}

</script>


<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Correspondencias Otros</p>
  </div>
</div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                       <th>Radicado</th>
                        <th>Juzgado </th>
                        <th>Destinatario</th>
                        <th>Documento&nbsp;&nbsp;&nbsp; </th>
                        <th>N&uacute;mero&nbsp;&nbsp;</th>
                        <th>Medio Notificaci&oacute;n&nbsp;&nbsp;</th>
                        <th>Notificado?&nbsp;&nbsp;</th>
                    </tr>
                </thead>
              
                  <tbody>
             
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['radicado'].'</td>';
                               echo '<td>'.$reg['juzgadonom'].'</td>';
							   echo '<td>'.$reg['destinatario'].'</td>';
							   echo '<td align="left">'.$reg['esOficio_Telegrama'].'</td>';
							   echo '<td>'.$reg['oficio_telegrama'].'</td>';
							   echo '<td>'.$reg['medionot'].'</td>';
							   echo '<td>'.$reg['notificado'].'</td>';
							   echo '<td style="cursor:pointer"><img src="views/images/list.png" width="21" height="23" onclick="vinculo('.$reg['corresid'].')" title="Consultar Correspondencia">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1('.$reg['corresid'].')" title="Modificar Correspondencia">'.'</td>';
                               echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
            </form>
