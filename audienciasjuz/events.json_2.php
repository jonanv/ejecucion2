<?php
session_start(); 

if($_SESSION['id']!=""){

$idUsuario   = $_SESSION['idUsuario'];

$id_juzgado  = $_SESSION['id_juzgado'];

//echo $idUsuario;

include_once("Conexion.php");

include_once('Funciones.php');
//require_once "../views/popupbox/Funciones.php";
//instanciamos la clase Funciones.php con la variable $funcion
$funcion  = new Funciones();

//$njuzgado = $funcion->get_Juzgado($id_juzgado);

//idaccion = 25 ---> 38////8 ID USUARIOS QUE PUEDEN VER TODAS LAS AUDIENCIAS 
$campos           = 'usuario';
$nombrelista      = 'pa_usuario_acciones';
$idaccion	      = '25';
$campoordenar     = 'id';
$datosusuarioSOLI = $funcion->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
//$usuariosSOLI1    = $datosusuarioSOLI->fetch();
//$usuariosaSOLI2	  = explode("////",$usuariosSOLI1[usuario]);
$usuariosaSOLI2	  = explode("////",$datosusuarioSOLI);

//SIN NO ESTA EL USUARIO EN SESION, NO ES UN USUARIO 
//QUE PUEDE VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS Y VER LA LISTA Usuario DE LA VISTA so_ticket.php DE LA CARPETA popupbox
//SOLO LAS SOLICITADAS POR EL
if ( !in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
	
	$id_filtro_u = $_SESSION['idUsuario'];
}


$conexion = db_connect();

$ip_plataforma = trim($_SESSION['ipplataforma']); 

//$ipservidor = "172.16.176.194";
//$ipservidor = "172.16.176.254";

$ipservidor = $ip_plataforma;

/*$sqlEvents = "SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
			  t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg
			  FROM (((siepro_audiencia_juzgado t1
			  INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
			  INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
			  LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
			  ORDER BY t1.id DESC";*/
			  


//EL USUARIO EN SESION VISUALIZA SOLO
//LAS AUDIENCIAS DEL JUZGADO AL QUE EL PERTENECE
if($id_filtro_u >= 1){
			
				
				
				$sqlEvents = "SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
						  	  t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg
						     FROM (((siepro_audiencia_juzgado t1
						     INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
						     INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
						     LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
						     WHERE t1.id_juzgado = '$id_juzgado'
						     ORDER BY t1.id DESC";
						  
			
}
//EL USUARIO EN SESION VISUALIZA TODAS LAS AUDIENCIAS
else{
			
				
				
				$sqlEvents = "SELECT t1.id,t2.radicado,t1.fecha,t1.hora_ini,t1.hora_fini,
							  t1.estado,t3.des,t4.id AS idcausal,t4.des AS causal,t1.fecha_reg
							  FROM (((siepro_audiencia_juzgado t1
							  INNER JOIN ubicacion_expediente t2 ON t1.idradicado = t2.id)
							  INNER JOIN siepro_estado_audi t3 ON t1.estado = t3.id)
							  LEFT JOIN siepro_estado_audi_2 t4 ON t1.idcausal = t4.id)
							  ORDER BY t1.id DESC";
						  
}			  
			  
			  			  

//$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($conn));
$resultset = mysql_query($sqlEvents);

$calendar = array();

//date_default_timezone_set ("America/Bogota");

while( $rows = mysql_fetch_assoc($resultset) ) {
//while( $rows = mysql_fetch_array($resultset)){

	// convert date to milliseconds
	//$start      = strtotime($rows['start_date']) * 1000;
	//$end        = strtotime($rows['end_date']) * 1000;
	
	//$start      = strtotime($rows['fecharemate']) * 1000;
	
	//sumo 1 día, para que los remates, ejemplo del 2 de julio 2019
	//se visualizen el 2 de julio y no el 1 de julio un dia antes.
	$fecha_actual = date($rows['fecha']);
	$startX       = date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
	$start        = strtotime($startX) * 1000;
	//$start      = strtotime($rows['fecharemate']) * 1000;
	
	//$end        = strtotime($rows['fecharemate']) * 1000;
	$calendar[] = array(
							'id'    => $rows['id'],
							//'title' => $rows['title'],
							
							'title' => "ID AUDI: ".$rows['id']." RADICADO: ".$rows['radicado']." FECHA AUDI: ".$rows['fecha'].
							           " HI: ".$rows['hora_ini']." HF: ".$rows['hora_fini']." ESTADO: ".$rows['des'].
									   " CAUSAL: ".$rows['causal']." FECHA:".$rows['fecha_reg'],
									   
							'url'   => "#",
							//'url'   => "http://".$ipservidor."/publicaciones/views/PHPPdf/Reporte_Cartel.php?id=".$rows['id'],
							//'url'   => "http://".$ipservidor."/bootstrap_ejemplos/bootstrap-calendar-master/PHPPdf/Reporte_Cartel.php?id=".$rows['id'],
							//"class" => 'event-important',//ICONO ROJOS DE LOS EEVENTOS
							"class" => 'event-info',//ICONOS AZULES DE LOS EEVENTOS
							'start' => "$start"
							//'end'   => "$end"
						);
}

$calendarData = array(
						"success" => 1,
						"result"=>$calendar
					  );
					  
echo json_encode($calendarData);


}//CIERRE IF SESSION 


?>
