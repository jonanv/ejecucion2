
<?php require_once('../libs/conexion.php');


$cn=  Conectarse();
$listado=  mysql_query("(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,correspondencia_otros.direccion,correspondencia_otros.radicado,
correspondencia_otros.esOficio_Telegrama,correspondencia_otros.oficio_telegrama,correspondencia_otros.fecha,turno.hora 
from turno 
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join correspondencia_otros on (correspondencia_otros.id=turno.idproceso)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
where turno.idproceso =correspondencia_otros.id and turno.tipo_proceso='Otro')
union 
(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,actuacion_tutela.direccion,correspondencia_tutelas.radicado,
actuacion_tutela.esOficio_Telegrama,actuacion_tutela.oficio_telegrama,actuacion_tutela.fecha_envio as fecha,turno.hora 
from turno 
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join actuacion_tutela on (actuacion_tutela.id=turno.idproceso)
inner join accionante_accionado_vinculado on (accionante_accionado_vinculado.id=actuacion_tutela.idaccionado_vinculado_accionante_tut)
inner join correspondencia_tutelas on (correspondencia_tutelas.id=accionante_accionado_vinculado.idcorrespondencia_tutelas)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_tutelas.idjuzgado)
where actuacion_tutela.id= turno.idproceso and (turno.tipo_proceso='Tutela' or turno.tipo_proceso='Incidente'))
order by empleado  ",$cn);


?>

 <script type="text/javascript" language="javascript" src="views/js/jslistadopaises.js"></script>
<script type="text/javascript">



$(document).ready(function(){
   $('#frm_editar').dataTable( { //CONVERTIMOS NUESTRO LISTADO DE LA FORMA DEL JQUERY.DATATABLES- PASAMOS EL ID DE LA TABLA
        "sPaginationType": "full_numbers" //DAMOS FORMATO A LA PAGINACION(NUMEROS)
    } );
})


</script>

<style type="text/css">
<!--
.Estilo1 {color: #1581AE}
-->
</style>
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Turnos</p>
  </div>
</div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                       <th width="117"><div align="center" class="Estilo1">Empleado&nbsp;&nbsp;</div></th>
	<th width="65"><div align="center" class="Estilo1">&Aacute;rea </div></th>
    <th width="96"><div align="center" class="Estilo1">Juzgado&nbsp;&nbsp;&nbsp;</div></th>
	<th width="142"><div align="center" class="Estilo1">Tipo&nbsp; </div></th>
	<th width="96"><div align="center" class="Estilo1">N&uacute;mero&nbsp;&nbsp;</div></th>
	<th width="154"><div align="center" class="Estilo1">Tipo Proceso</div></th>
	<th width="112"><div align="center" class="Estilo1">Radicado</div></th>
	<th width="113"><div align="center" class="Estilo1">Direcci&oacute;n</div></th>
	<th width="71"><div align="center" class="Estilo1">Fecha&nbsp;&nbsp;</div></th>
	<th width="129"><div align="center" class="Estilo1">Hora&nbsp;&nbsp;</div></th>
                    </tr>
                </thead>
              
                  <tbody>
             
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['empleado'].'</td>';
                               echo '<td>'.$reg['areaempleado'].'</td>';
							   echo '<td>'.$reg['juzgado'].'</td>';
							   echo '<td>'.$reg['esOficio_Telegrama'].'</td>';
							   echo '<td>'.$reg['oficio_telegrama'].'</td>';
							   echo '<td>'.$reg['tipo_proceso'].'</td>';
							   echo '<td>'.$reg['radicado'].'</td>';
							   echo '<td>'.$reg['direccion'].'</td>';
							   echo '<td>'.$reg['fecha'].'</td>';
							   echo '<td>'.$reg['hora'].'</td>';
							   echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
            </form>
