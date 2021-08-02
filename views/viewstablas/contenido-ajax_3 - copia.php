<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<script type="text/javascript" language="javascript" src="views/viewstablas/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/>
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/>

<script type="text/javascript" charset="utf-8"> 
	$(document).ready(function() {
		$('#tablatramite').dataTable();
	} );
</script>

<?php
//require('./Conexion.php');
include_once('Conexion.php');

$error_transaccion = 0; //variable para detectar error

//Conexión a la base de datos
$conexion = db_connect($dbdefault_dbname);

if($conexion > 0){

	//EMPIEZA LA TRANSACCION
 	mysql_query("begin",$conexion); 
	
	$sql = "SELECT ue.radicado,ps.nombre,ae.actu_fechai,pu.empleado,ace.acc_descripcion
			FROM ((((actuacion_expediente ae INNER JOIN ubicacion_expediente ue ON ae.actu_radicado = ue.id)
			LEFT JOIN pa_clase_proceso ps ON ue.idclase_proceso = ps.id)
			INNER JOIN accion_expediente ace ON ae.actu_accion = ace.id)
			INNER JOIN pa_usuario pu ON ae.actu_asignadoa = pu.id)
			ORDER BY ae.actu_radicado,ae.id DESC;";
			
   	$resultado = mysql_query($sql);
	
	if (!$resultado) {
		$error_transaccion = 1;
	}
	else{
	
		//TAMBIEN FUNCIONA
		//$sql=mysql_query("SELECT * FROM clientes",$conexion);
		
		//PARA CALCULAR LA FECHA MAXIMA
		//$sql=mysql_query("SELECT * FROM controles WHERE cedula_co='$cedula' 
		//AND fecha_co =(SELECT MAX(fecha_co) FROM controles WHERE cedula_co='$cedula')",$con);
		
		
		//muestra los datos consultados
		//haremos uso de tabla para tabular los resultados
		?>
		<table class="display" id ="tablatramite" style="border:1px solid #000066; color:#000099;width:100px;">
		<tr>
			<td bgcolor="#CDE3F6">RADICADO</td>
			<td bgcolor="#CDE3F6">CLASE PROCESO</td>
			<td bgcolor="#CDE3F6">FECHA FINAL</td>
			<td bgcolor="#CDE3F6">ASIGNADO</td>
			<td bgcolor="#CDE3F6">ACCTUACIÓN</td>
		</tr>
		
		<?php
		//while($row = mysql_fetch_array($sql)){
		while($row = mysql_fetch_array($resultado)){
		
			echo "<tr>";
				//mediante el evento onclick llamaremos a la funcion eliminarDato(), la cual tiene como parametro
				//de entrada el ID del empleado
				//echo " 		<td><a style=\"text-decoration:underline;cursor:pointer;\" onclick=\"eliminarDato('".$row['id_co']."','".$row['cedula_co']."')\">".$row['id_co']."</a></td>";
				echo "<td>".$row['radicado']."</td>";
				echo "<td>".$row['nombre']."</td>";
				echo "<td>".$row['actu_fechai']."</td>";
				echo "<td>".$row['empleado']."</td>";
				echo "<td>".$row['acc_descripcion']."</td>";
				/*echo "<td>".$row['apellido']."</td>";
				echo "<td>".$row['fecha_nac']."</td>";
				echo "<td align='right'>".$row['peso']."</td>"; */
			echo "</tr>";
		
		}
		
		
	}//FIN ELSE
	//---------------------------------------------------------------
	if($error_transaccion) {
		//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
		mysql_query("ROLLBACK",$conexion);
		/*echo "<HTML><script>alert('ERROR AL PROCESAR LOS DATOS');location.href='Formulario_Paciente.php';</script></HTML>";*/
		echo "<HTML><script>alert('ERROR EN LA TRANSACCION');</script></HTML>";
	} 
	else {
		//SE TERMINA LA TRANSACCION 
		mysql_query("COMMIT",$conexion);
		/*echo "<HTML><script>alert('PROCESAMIENTO DE LOS DATOS OK...');location.href='Formulario_Paciente.php';</script></HTML>";*/
		/*echo "<HTML><script>alert('TRANSACCION OK...');</script></HTML>";*/
	}
	
}
else{
	echo $conexion; 
}
mysql_close($conexion);
?>
</table>