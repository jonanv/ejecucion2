
<?php require_once('../libs/conexion.php');


$cn=  Conectarse();
$listado=  mysql_query("select inventario.id,inventario.consecutivo_acta,inventario.fecha_acta,pa_juzgado.nombre,inventario.responsable,inventario.enero,
inventario.febrero,inventario.marzo,inventario.abril,inventario.mayo,inventario.junio,inventario.julio,inventario.agosto,
inventario.septiembre,inventario.octubre,inventario.noviembre,inventario.diciembre, inventario.ano_archivar, inventario.cantidad_expedientes, inventario.cantidad_cajas,inventario.nombre_entrega,inventario.nombre_recibe, inventario.idestado_acta
from inventario 
inner join pa_juzgado ON (inventario.idjuzgado=pa_juzgado.id)
Where inventario.idtipoinventario=1 and idestado_acta=1 order by inventario.fecha_acta desc ",$cn);


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

location.href="index.php?controller=archivo&action=show_inventario&nombre="+variable;
//document.write(location.href) 

}
function vinculo1(variable)
{

location.href="index.php?controller=archivo&action=edit_acta_entrante&nombre="+variable;
//document.write(location.href) 

}

function vinculo3(variable)
{

location.href="index.php?controller=archivo&action=entregar_acta_entrante&nombre="+variable;
//document.write(location.href) 
}
function vinculo4(variable)
{

location.href="index.php?controller=archivo&action=generarActarecibido&nombre=2&nombre1="+variable;
//document.write(location.href) 
}

function vinculo2(variable)
{
if(confirm('Realmente desea eliminar el acta de entrega?'))
{
location.href="index.php?controller=archivo&action=elim_inventarioEntrante&nombre="+variable;
//document.write(location.href) 
}
}

</script>


<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de actas entrantes</p>
  </div>
</div>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="frm_editar">
                <thead>
                        <tr>
                        <th> Acta</th>
                        <th>Fecha </th>
                        <th>Juzgado</th>
                        <th>Meses</th>
                        <th>A&ntilde;o&nbsp;&nbsp;&nbsp;</th>
                        <th>Cajas&nbsp;&nbsp;&nbsp;</th>
                        <th>Expedientes&nbsp;&nbsp;&nbsp;</th>
                        <th>Recibe</th>

                        <th>Estado</th>
                    </tr>
                </thead>
              
                  <tbody>
             
                    <?php

     	unset($meses);
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.$reg['consecutivo_acta'].'</td>';
                               echo '<td>'.$reg['fecha_acta'].'</td>';
							   echo '<td>'.$reg['nombre'].'</td>';
							    $i=0;  
								if($reg['enero']==1){
								$meses[$i] = "Enero"; $i=$i+1;}
								if($reg['febrero']==1){
								$meses[$i] = "Febrero";$i=$i+1;}
								if($reg['marzo']==1){
								$meses[$i] = "Marzo";$i=$i+1;}
								if($reg['abril']==1){
								$meses[$i] = "Abril";$i=$i+1;}
								if($reg['mayo']==1){
								$meses[$i] = "Mayo";$i=$i+1;}
								if($reg['junio']==1){
								$meses[$i] = "Junio";$i=$i+1;}
								if($reg['julio']==1){
								$meses[$i] = "Julio";$i=$i+1;}
								if($reg['agosto']==1){
								$meses[$i] = "Agosto";$i=$i+1;}
								if($reg['septiembre']==1){
								$meses[$i] = "Septiembre";$i=$i+1;}
								if($reg['octubre']==1){
								$meses[$i] = "Octubre";$i=$i+1;}
								if($reg['noviembre']==1){
								$meses[$i] = "Noviembre";$i=$i+1;}
								if($reg['diciembre']==1){
								$meses[$i] = "Diciembre";$i=$i+1;}
		
		$j=0;
	 	$cont_mes= count($meses);
	  	$mes= "";
		//print_r($meses);
	  
	   while($j<$cont_mes)
	  	{
	   	if($j!=0)
	   	{
	    	$mes = $mes.", ";
	   	}
	   	$mes = $mes.$meses[$j];
	   	$j= $j+1;
	  
	  	}
		//echo $mes;
		
		 if($reg['idestado_acta']==2)
		   $estado = "Entregada";
		 else
		   $estado = "Recibida";
		
		
	
						       echo '<td>'.$mes.'</td>';
							   echo '<td>'.$reg['ano_archivar'].'</td>';
							   echo '<td>'.$reg['cantidad_cajas'].'</td>';
							   echo '<td>'.$reg['cantidad_expedientes'].'</td>';
							   echo '<td>'.$reg['nombre_recibe'].'</td>';
							   echo '<td>'.$estado.'</td>';
						       echo '<td style="cursor:pointer"><img src="views/images/list.png" width="21" height="23" onclick="vinculo('.$reg['id'].')" title="Consultar Acta Recibido">'.'</td>';
							    echo '<td style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo1('.$reg['id'].')" title="Modificar Acta Recibido">'.'</td>';
								echo '<td style="cursor:pointer"><img src="views/images/entre.png" width="21" height="23" onclick="vinculo3('.$reg['id'].')" title="Entregar">'.'</td>';
								echo '<td style="cursor:pointer"><img src="views/images/download1.png" width="21" height="23" onclick="vinculo4('.$reg['id'].')" title="Generar Acta">'.'</td>';
								echo '<td style="cursor:pointer"><img src="views/images/elim.png" width="21" height="23" onclick="vinculo2('.$reg['id'].')" title="Eliminar Acta Recibido">'.'</td>';
                               echo '</tr>';
                     
                        //}
                    ?>
                                        
                   <?php }?> 
                <tbody>
            </table>
</form>
