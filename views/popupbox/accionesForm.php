<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{
$everadicado = trim($_POST['everadicado']);

include_once "Conexion.php";

$conexion  = db_connect($dbdefault_dbname);
$sql       = "SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,jd.nombre,eve.evedescripcion
			  FROM (((evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id)
			  INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id)
			  INNER JOIN juzgado_destino AS jd ON eve.evejuzgadoreparto = jd.id) 
			  WHERE ubi.radicado = '$everadicado'
			  ORDER BY id DESC";
			  
$resultado = mysql_query($sql);

?>

<script src="views/js/ajax/ajax_popupbox.js" type="text/javascript" charset="utf-8"></script>

<h3 style="font-size:16px ">ACCIONES PROCESO</h3>

<table border="3">
    <thead style="font-size:16px ">
        <tr bgcolor="#D5FFFF">
            <th style="font-size:16px">Id</th>
            <th style="font-size:16px ">Fecha</th>
            <th style="font-size:16px ">Asunto</th>
            <th style="font-size:16px ">Accion</th>
            <th style="font-size:16px ">Radicado</th>
			<th style="font-size:16px ">Juzgado Reparto</th>
			<th style="font-size:16px ">Descripcion</th>
        </tr>
    </thead>
    <tbody>
        <?php
			while($row = mysql_fetch_array($resultado)){
			
				echo "	<tr style='font-size:18px'>";
					echo " 		<td style='font-size:16px'>".$row['id']."</td>";
					echo " 		<td style='font-size:16px'>".$row['evefecha']."</td>";
					echo " 		<td style='font-size:16px'>".$row['eveasunto']."</td>";
					echo " 		<td style='font-size:16px'>".$row['acc_descripcion']."</td>";
					echo " 		<td style='font-size:16px'>".$row['radicado']."</td>";
					echo " 		<td style='font-size:16px'>".$row['nombre']."</td>";
					echo " 		<td style='font-size:16px'>".$row['evedescripcion']."</td>";
				echo "	</tr>";
				
			}
		?>

    </tbody> 
</table>

<div class="buttonsBar">
	<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="/ejecucion/eventos/imagenes/cancel2.png" width="15" height="15"/></button>
</div>

<?php } mysql_close($conexion); ?>


