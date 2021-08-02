<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<?php require_once('../libs/conexion.php');
$cn=  Conectarse();
$listado=  mysql_query("SELECT ct.radicado, act.esoficio_telegrama,act.oficio_telegrama,act.direccion,av.accionante_accionado_vinculado as nombre, act.id
FROM correspondencia_tutelas ct
INNER JOIN accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=av.id)
order by ct.radicado,av.accionante_accionado_vinculado limit 100",$cn);
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

location.href="index.php?controller=correspondencia&action=editarActuaciones&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{
if(confirm('Realmente desea eliminar la actuación?'))
{
location.href="index.php?controller=correspondencia&action=elim_actuacion&nombre="+variable;
//document.write(location.href) 
}
}
</script>

<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Actuaciones</p>
  </div>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                    <tr> 
                         <th>Radicado</th>
						<th>Tipo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>N&uacute;mero&nbsp;&nbsp;&nbsp;</th>
    					<th>Direcci&oacute;n</th>
						<th>Nombre</th>
                    </tr>
                </thead>
              
                  <tbody>
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['radicado'].'</td>';
                               echo '<td>'.$reg['esoficio_telegrama'].'</td>';
							   echo '<td>'.$reg['oficio_telegrama'].'</td>';
							   echo '<td align="left">'.$reg['direccion'].'</td>';
							   echo '<td>'.$reg['nombre'].'</td>';
							   echo '<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo('.$reg['id'].')" title="Modificar Actuación">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo1('.$reg['id'].')" title="Eliminar Actuación">'.'</td>';
                               echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
            </form>
