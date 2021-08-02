<?php

session_start(); 

error_reporting(-1);
require_once("config.inc.php");

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{

function fecha ($valor)
{
	$timer = explode(" ",$valor);
	$fecha = explode("-",$timer[0]);
	$fechex = $fecha[2]."/".$fecha[1]."/".$fecha[0];
	return $fechex;
}

function buscar_en_array($fecha,$array)
{
	$total_eventos=count($array);
	for($e=0;$e<$total_eventos;$e++)
	{
		if ($array[$e]["fecha"]==$fecha) return true;
	}
}

switch ($_GET["accion"])
{
	case "listar_evento":
	{
	
		
		$query=$db->query("	SELECT t1.id,t1.fecharegistro,t1.fechaaudi,t1.horaaudi,t2.radicado,t1.obsaudi,t2.idjuzgado_reparto,t1.realizada
							FROM (siepro_audiencia t1
							INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
							WHERE fechaaudi= '".$_GET["fecha"]."'");
						   
	
		echo "<center><table cellspacing='0' cellpadding='0'>";
		
		echo "<tr height='40'>
				<th width='50' style='text-align:left'>ID</th>
				<th width='100' style='text-align:left'>REGISTRO</th>
				<th width='60'>HORA</th>
				<th width='50' style='text-align:left'>RADICADO</th>
				<th width='100'>JUZGADO</th>
				<th width='200' style='text-align:left'>DETALLE</th>
				<th width='100'>REALIZADA</th>
				<th>ESTADO</th>
			</tr>";	
		
		
		if ($fila=$query->fetch_array())
		{
			do
			{
				
				
				if ($fila["realizada"] != "SI"){
				
				
					echo "<tr height='60'>
					
							<td width='50' style='text-align:left'>".$fila["id"]."</td>
							<td width='100' style='text-align:left'>".$fila["fecharegistro"]."</td>
							<td width='60'>".$fila["horaaudi"]."</td>
							<td width='50'>".$fila["radicado"]."</td>
							<td width='100' style='text-align:center'>".$fila["idjuzgado_reparto"]."</td>
							<td width='200' style='text-align:left'>".$fila["obsaudi"]."</td>
							<td style='text-align:center'>"."NO"."</td>
							
							<td style='text-align:right'><a href='#' class='cambiar_estado' rel='".$fila["id"]."' estado='"."NO"."' fecha_dia='".$_GET["fecha"]."' title='Cambiar Estado Audiencia'><img src='images/OK1.jpg'></a></td>
										

						</tr>";	
					
				
				}
				else{
				
					echo "<tr height='60'>
					
							<td width='50' style='text-align:left'>".$fila["id"]."</td>
							<td width='100' style='text-align:left'>".$fila["fecharegistro"]."</td>
							<td width='60'>".$fila["horaaudi"]."</td>
							<td width='50'>".$fila["radicado"]."</td>
							<td width='100' style='text-align:center'>".$fila["idjuzgado_reparto"]."</td>
							<td width='200' style='text-align:left'>".$fila["obsaudi"]."</td>
							<td style='text-align:center'>".$fila["realizada"]."</td>
							
							<td style='text-align:right'><a href='#' class='cambiar_estado' rel='".$fila["id"]."' estado='".$fila["realizada"]."' fecha_dia='".$_GET["fecha"]."' title='Cambiar Estado Audiencia'><img src='images/OK1.jpg'></a></td>
							
						</tr>";	
					
				}
				
				
			}
			while($fila=$query->fetch_array());
		}
		
		echo "</table></center>";
		
		break;
	}
	case "guardar_evento":
	{
		$query=$db->query("insert into ".$tabla." (fecha,evento) values ('".$_GET["fecha"]."','".strip_tags($_GET["evento"])."')");
		if ($query) echo "<p class='ok'>Evento guardado correctamente.</p>";
		else echo "<p class='error'>Se ha producido un error guardando el evento.</p>";
		break;
	}
	case "cambiar_estado":
	{
		if($_GET["estado"] == "NO"){
		
			$query=$db->query("UPDATE ".$tabla." SET realizada = 'SI'
							   WHERE id='".$_GET["id"]."' limit 1");
		}
		else{
			
			$query=$db->query("UPDATE ".$tabla." SET realizada = 'NO'
							   WHERE id='".$_GET["id"]."' limit 1");
		}
						   
		if ($query) echo "<p class='ok'>Proceso se Realiza correctamente.</p>
					
					<script languaje='JavaScript'>
						
						
						var fecha = '".$_GET["fecha"]."';
						
						//alert(fecha);
				
						$.ajax({
							type: 'GET',
							url: 'ajax_calendario.php',
							cache: false,
							data: { fecha:fecha,accion:'listar_evento' }
						}).done(function( respuesta ) 
						{
							$('#respuesta_form').html(respuesta);
						});
						
					</script>";
					
						
		else echo "<p class='error'>Se ha producido un error al Realizar el Proceso.</p>";
		break;
	}
	case "borrar_evento":
	{
		$query=$db->query("delete from ".$tabla." where id='".$_GET["id"]."' limit 1");
		if ($query) echo "<p class='ok'>Evento eliminado correctamente.</p>";
		else echo "<p class='error'>Se ha producido un error eliminando el evento.</p>";
		break;
	}
	case "generar_calendario":
	{
		$fecha_calendario=array();
		if ($_GET["mes"]=="" || $_GET["anio"]=="") 
		{
			$fecha_calendario[1]=intval(date("m"));
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			$fecha_calendario[0]=date("Y");
		} 
		else 
		{
			$fecha_calendario[1]=intval($_GET["mes"]);
			if ($fecha_calendario[1]<10) $fecha_calendario[1]="0".$fecha_calendario[1];
			else $fecha_calendario[1]=$fecha_calendario[1];
			$fecha_calendario[0]=$_GET["anio"];
		}
		$fecha_calendario[2]="01";
		
		/* obtenemos el dia de la semana del 1 del mes actual */
		$primeromes=date("N",mktime(0,0,0,$fecha_calendario[1],1,$fecha_calendario[0]));
			
		/* comprobamos si el año es bisiesto y creamos array de días */
		if (($fecha_calendario[0] % 4 == 0) && (($fecha_calendario[0] % 100 != 0) || ($fecha_calendario[0] % 400 == 0))) $dias=array("","31","29","31","30","31","30","31","31","30","31","30","31");
		else $dias=array("","31","28","31","30","31","30","31","31","30","31","30","31");
		
		$eventos=array();
		
		//***********************************SQL ORIGINAL*****************************************************
		//$query=$db->query("select fecha,count(id) as total from ".$tabla." where month(fecha)='".$fecha_calendario[1]."' and year(fecha)='".$fecha_calendario[0]."' group by fecha");
		
		$query=$db->query("select fechaaudi,count(id) as total from ".$tabla." 
		                   where month(fechaaudi)='".$fecha_calendario[1]."' 
						   and year(fechaaudi)='".$fecha_calendario[0]."' 
						   group by fechaaudi");
		
		if ($fila=$query->fetch_array())
		{
			do
			{
				$eventos[$fila["fechaaudi"]]=$fila["total"];
			}
			while($fila=$query->fetch_array());
		}
		
		$meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		/* calculamos los días de la semana anterior al día 1 del mes en curso */
		$diasantes=$primeromes-1;
			
		/* los días totales de la tabla siempre serán máximo 42 (7 días x 6 filas máximo) */
		$diasdespues=42;
			
		/* calculamos las filas de la tabla */
		$tope=$dias[intval($fecha_calendario[1])]+$diasantes;
		if ($tope%7!=0) $totalfilas=intval(($tope/7)+1);
		else $totalfilas=intval(($tope/7));
			
		/* empezamos a pintar la tabla */ //<a href='/pubilaciones/index.php?controller=index&action=ruta_base'><img src='/publicaciones/carteles/images/back_f2.png' width='30' height='30' title='Regresar' style='float:right'/></a>";
		//echo "<h2>PROGRAMACION DE REMATES PARA: ".$meses[intval($fecha_calendario[1])]." de ".$fecha_calendario[0]." <abbr title='LOS NUMEROS DE COLOR ROJO INDICAN QUE EXISTE PROGRAMACION DE REMATE PARA ESE DIA.'>(?)</abbr></h2><a href='/publicaciones/index.php?controller=index&action=ruta_base'><img src='/publicaciones/carteles/images/back_f2.png' width='30' height='30' title='Regresar' style='float:right'/></a>";
		echo "<h2>PROGRAMACION DE AUDIENCIAS PARA: ".$meses[intval($fecha_calendario[1])]." de ".$fecha_calendario[0]."</h2><a href='/ejecucion/index.php?controller=archivo&action=listarUbicacionExpediente'><img src='/ejecucion/audiencias/images/back_f2.png' width='30' height='30' title='Regresar' style='float:right'/></a>";
		if (isset($mostrar)) echo $mostrar;
			
		echo "<table class='calendario' cellspacing='0' cellpadding='0'>";
			echo "<tr><th>Lunes</th><th>Martes</th><th>Mi&eacute;rcoles</th><th>Jueves</th><th>Viernes</th><th>S&aacute;bado</th><th>Domingo</th></tr><tr>";
			
			/* inicializamos filas de la tabla */
			$tr=0;
			$dia=1;
			
			function es_finde($fecha)
			{
				$cortamos=explode("-",$fecha);
				$dia=$cortamos[2];
				$mes=$cortamos[1];
				$ano=$cortamos[0];
				$fue=date("w",mktime(0,0,0,$mes,$dia,$ano));
				if (intval($fue)==0 || intval($fue)==6) return true;
				else return false;
			}
			
			for ($i=1;$i<=$diasdespues;$i++)
			{
				if ($tr<$totalfilas)
				{
					if ($i>=$primeromes && $i<=$tope) 
					{
						echo "<td class='";
						/* creamos fecha completa */
						if ($dia<10) $dia_actual="0".$dia; else $dia_actual=$dia;
						$fecha_completa=$fecha_calendario[0]."-".$fecha_calendario[1]."-".$dia_actual;
						
						if (intval($eventos[$fecha_completa])>0) 
						{
							echo "evento";
							$hayevento=$eventos[$fecha_completa];
						}
						else $hayevento=0;
						
						/* si es hoy coloreamos la celda */
						if (date("Y-m-d")==$fecha_completa) echo " hoy";
						
						echo "'>";
						
						/* recorremos el array de eventos para mostrar los eventos del día de hoy */
						if ($hayevento>0) 
							
							echo "<font color='blue' size = '2'>".$hayevento." Audiencia(s) "."</font>"."<br>"."<a href='#' data-evento='#evento".$dia_actual."' class='modal' rel='".$fecha_completa."' title='Existe(n) ".$hayevento." Audiencias'>".$dia."</a>";
							
						else 
							echo "$dia";
						
						/* agregamos enlace a nuevo evento si la fecha no ha pasado */
						//NOTA: SE CIERRA ESTA LINEA PARA QUITAR EL ICONO DEL MAS EN LOS DIAS Y AGRAGAR EVENTOS
						//if (date("Y-m-d")<=$fecha_completa && es_finde($fecha_completa)==false) echo "<a href='#' data-evento='#nuevo_evento' title='Agregar un Evento el ".fecha($fecha_completa)."' class='add agregar_evento' rel='".$fecha_completa."'>&nbsp;</a>";
						
						
						echo "</td>";
						$dia+=1;
					}
					else echo "<td class='desactivada'>&nbsp;</td>";
					if ($i==7 || $i==14 || $i==21 || $i==28 || $i==35 || $i==42) {echo "<tr>";$tr+=1;}
				}
			}
			echo "</table>";
			
			$mesanterior=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]-1,01,$fecha_calendario[0]));
			$messiguiente=date("Y-m-d",mktime(0,0,0,$fecha_calendario[1]+1,01,$fecha_calendario[0]));
			echo "<p class='toggle'>&laquo; <a href='#' rel='$mesanterior' class='anterior'>Mes Anterior</a> - <a href='#' class='siguiente' rel='$messiguiente'>Mes Siguiente</a> &raquo;</p>";
			
			
			echo "<br>";
			echo "<font color='red' size = '5'><p>NOTA: LOS NUMEROS DE COLOR ROJO INDICAN QUE EXISTE PROGRAMACION DE AUDIENCIAS PARA ESE DIA</p></font>";
			
		break;
	}
}

}//fin else
?>