<?php
require('./Conexion.php');

$sql=mysql_query("SELECT ue.radicado,ps.nombre,ae.actu_fechai,pu.empleado,ace.acc_descripcion
			      FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
			      LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
			      INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
			      INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
			      ORDER BY ae.actu_radicado,ae.id DESC",$con);

?>
<html>
	<head>
		<!-- <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
		<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/>
		<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/>
		
		<script type="text/javascript" charset="utf-8"> 
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script> -->
		
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead> 
				<tr> 
					<th bgcolor="#CDE3F6">RADICADO</th>
					<th bgcolor="#CDE3F6">CLASE PROCESO</th>
					<th bgcolor="#CDE3F6">FECHA FINAL</th>
					<th bgcolor="#CDE3F6">ASIGNADO</th>
					<th bgcolor="#CDE3F6">ACTUACIÓN</th>
				</tr> 
			</thead> 
			
			<tbody> 
			
			<?php
				while($row = mysql_fetch_array($sql)){
					echo "	<tr>";
					
						echo "<td>".$row['radicado']."</td>";
						echo "<td>".$row['nombre']."</td>";
						echo "<td>".$row['actu_fechai']."</td>";
						echo "<td>".$row['empleado']."</td>";
						echo "<td>".$row['acc_descripcion']."</td>";
					
					echo "	</tr>";
				}
			?>
				
			</tbody>
			
		</table>
	</body>
</html>








