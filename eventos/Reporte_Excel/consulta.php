<?php
require('./conexion.php');

if(empty($filtro)){

$sql = mysql_query("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion 
					FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
					INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) ORDER BY id",$con);
}
else{

$sql = mysql_query("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion 
					FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
					INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) WHERE radicado LIKE '%$filtro%' ORDER BY id DESC",$con);

}

$numfilas = mysql_num_rows($sql);

//muestra los datos consultados
//haremos uso de tabla para tabular los resultados
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
<style type="text/css">
.botonExcel{cursor:pointer;}
</style>
</head>
<body>
<table border="1" bordercolor="#000066" id="Exportar_a_Excel" style="border:1px solid #000066;color:#000099;width:900px;font-size:18px">
<!-- <tr><td colspan="15"><img src="logogobernacion.JPG" class="LOGO" /><h3>BMD <?php //echo " / Total: ".$numfilas ?></h3></td></tr> -->
<tr style="background:#99CCCC;">
	<!-- <td>ID</td> -->
	
	<td>Id</td>
	<td>Fecha</td>
	<td>Asunto</td>
	<td>Accion</td>
	<td>Radicado</td>
	<td>Descripcion</td>
	
	
</tr>

<?php
while($row = mysql_fetch_array($sql)){
	echo "	<tr>";
	
	echo " 		<td>".$row['id']."</td>";
	echo " 		<td>".$row['evefecha']."</td>";
	echo " 		<td>".$row['eveasunto']."</td>";
	echo " 		<td>".$row['acc_descripcion']."</td>";
	echo " 		<td>".$row['radicado']."</td>";
	echo " 		<td>".$row['evedescripcion']."</td>";
	
	echo "	</tr>";
}
?>
</table>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<h4><p>Exportar a Excel  <img src="/ejecucionprueba/eventos/imagenes/excel2.png" class="botonExcel" width="30" height="30"/></p></h4>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
</body>
</html>