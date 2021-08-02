<?php
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{

include_once('Conexion.php');
//include("funcionesInsertar.php");

date_default_timezone_set('America/Bogota');

//------------------------------------------------------------ 
//CAPTURAMOS LOS DATOS
$datos = explode("******",trim($_POST["datos"]));

$long  = count($datos);

//---------------------------------------------------     
$error_transaccion = 0; //variable para detectar error

//Conexión a la base de datos
$conexion = db_connect($dbdefault_dbname);

//$conexion = mysql_connect($dbhost, $dbusername, $dbuserpassword) or die(mysql_error($conexion));
//mysql_select_db($dbdefault_dbname, $conexion)or die(mysql_error());

  
if($conexion > 0){
   
	//-----------------------EMPIEZA LA TRANSACCION MYSQL-------------------------------------
 	mysql_query("BEGIN",$conexion); 
	//----------------------------------------------------------------------------------------
	
	
	//-----------------------EMPIEZA LA TRANSACCION SQLSERVER---------------------------------
	//SE DEFINO EN EL PRINCIPIO PARA QUE TOME TODAS LAS SENTENCIAS SQL
	//DE SQL SERVER QUE SEAN PROCESADAS, ES DECIR UN BLOQUE DE TRANSACCIONES
	//NO INDIVIDUALMENTE
	
	//CONEXION LOCAL PARA PRUEBAS
	/*$serverName   = "OECM-SISTE1\SQLEXPRESS";
	$connectionInfo = array( "Database"=>"prueba2", "UID"=>"sa", "PWD"=>"JAVO1978emmanuel08");
	$conn           = sqlsrv_connect( $serverName, $connectionInfo);*/
	
	//CONEXION A SIGLO XXI
	$serverName     = "192.168.89.20"; 
	$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"M4nt3n1m13nt0");
	$conn           = sqlsrv_connect( $serverName, $connectionInfo);
	
	if( $conn === false ) {
		//die( print_r( sqlsrv_errors(), true ));
		$error_transaccion = 1;
		$i= $long + 1;
	}
	
	//Iniciar la transacción.
	if ( sqlsrv_begin_transaction( $conn ) === false ) {
		 //die( print_r( sqlsrv_errors(), true ));
		 $error_transaccion = 1;
		 $i= $long + 1;
	}
	
	//--------------------------------------------------------------------------------------

	$fechadetalle = date('Y-m-d g:i');
	
	$i=1;
	
				
	while($i<$long){
	
		$datosreparto = explode("//////",$datos[$i]);
		
		$d0  = trim($datosreparto[0]);//id
		$d1  = trim($datosreparto[1]);//radicado
		$d2  = trim($datosreparto[2]);//cedula demandante
		$d3  = trim($datosreparto[3]);//demandante
		$d4  = trim($datosreparto[4]);//cedula demandado
		$d5  = trim($datosreparto[5]);//demandado
		$d6  = trim($datosreparto[6]);//piso
		
		$d7  = explode("-",trim($datosreparto[7]));
		$d7b = trim($d7[0]);//estado, que realmente es el codigo del detalle del estado de la tabla detalle_estado, y se registra en el campo idestado de la tabla ubicacion_expediente
		
		$d8  = explode("-",trim($datosreparto[8]));
		$d8b = trim($d8[0]);//clase proceso
		
		$d9  = trim($datosreparto[9]);//fecha reparto
		
		$d10  = explode("-",trim($datosreparto[10]));
		$d10b = trim($d10[0]);//juzgado reparto
		
		$d11  = explode("-",trim($datosreparto[11]));
		$d11b = trim($d11[0]);//ponente, que en la tabla ubicacion_expediente es iddespacho
		//DATOS CARGADOS DE SIGLO XXI EN LA LISTA CAMBIAR PONENTE CAMPO VALUE DEL FORMULARIO CLIENTFORM2.PHP
		$codi_pone = trim($d11[0]);//ESTE ES EL MISMO $d11b
		$nom_pone  = trim($d11[1]);
		$codi_enti = trim($d11[2]);
		$codi_espe = trim($d11[3]);
		$codi_nume = trim($d11[4]);
		
		$d12 = trim($datosreparto[12]);//observacion, pero esto se graba es en la tabla detalle_correspondencia
		
		//--------------------------------------------------------------------------------------------------------------------------------------------
		//SQL 1 ACTUALIZACION DE DATOS, PERO LO MAS IMPORTANTE LOS DATOS DE fecha_reparto ,idjuzgado_reparto,iddespacho(PONENTE) 
		$sql = "UPDATE ubicacion_expediente SET cedula_demandante = '$d2',demandante = '$d3',cedula_demandado = '$d4',demandado = '$d5',
				piso = '$d6',idestado = '$d7b',idclase_proceso = '$d8b',
				fecha_reparto='$d9',idjuzgado_reparto='$d10b',iddespacho='$d11b' 
				WHERE  id ='$d0'";
					
		$resultado = mysql_query($sql);
					
		if (!$resultado) {
			$error_transaccion = 1;
			$i= $long + 1;
		}
		
		//--------------------------------------------------------------------------------------------------------------------------------------------
		//SQL 2 REGISTRO DE OBSERVACION REALIZADA AL MOMENTO DE REALIZAR EL REPARTO
		$sql = "INSERT INTO detalle_correspondencia(idcorrespondencia,fecha,observacion,idusuario)
		        VALUES('$d0','$fechadetalle','$d12',".$_SESSION['idUsuario'].")";
					
		$resultado = mysql_query($sql);
						
		if (!$resultado) {
			$error_transaccion = 1;
			$i= $long + 1;
		}
		
		//--------------------------------------------------------------------------------------------------------------------------------------------
		//SQL 3 ACTUALIZACIONES A SIGLO XXI
		
		//SQL PARA PRUEBAS
		/*$sql = ("UPDATE info1 SET des = 'Actuación Registrada por la Oficina de Ejecución de Sentencias'
			     WHERE radicado ='$d0';
					
				 INSERT INTO info2(numero) values('$d0')");*/
				 
		
		$sininstancia = $d1;
	  	$sin = substr($sininstancia, 0, 21);
		  
		$sql = ("declare @cad integer 
				
				UPDATE t103dainfoproc SET a103descacts='Redistribución a Juzgados de Ejecución de Sentencias', a103codiacts='30023582', a103codipads='30011102',
				a103fechdess = GETDATE(), a103anotacts = 'Actuación Registrada por la Oficina de Ejecución de Sentencias',
				A103ENTIRADI = '$codi_enti', A103ESPERADI = '$codi_espe', A103NUENRADI = '$codi_nume', A103CODIPONE = '$codi_pone', A103NOMBPONE = '$nom_pone'
				WHERE a103llavproc='$d1';
				
				SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$d1' 
				
				INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
				A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
				A110RENUTERM) values('$d1',@cad,'$sin','00','30023582','30011102','Redistribución a Juzgados de Ejecución de Sentencias','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
				'Actuación Registrada por la Oficina de Ejecución de Sentencias',NULL,NULL,'S','D',GETDATE(),'NO','NO')");
				
		
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt = sqlsrv_query( $conn, $sql , $params, $options );
		
		
		//SI ES CORRECTO O NO, NO SE CONSOLIDA LA TRANSACCION O ES REVERTIDA
		//EN ESTA PARTE TODO SE MANEJA MAS ABAJO AL PREGUNTAR POR LA VARIABLE
		//$error_transaccion Y SE EJECUTA sqlsrv_rollback( $conn ) ó sqlsrv_commit( $conn )
		//IGUAL QUE EN MySQL
		if( $stmt ) {
			 //sqlsrv_commit( $conn );
			 //echo "Transaccion consolidada.<br />";
		} 
		else {
			//sqlsrv_rollback( $conn );
			//echo "Transaccion revertida.<br />";
			$error_transaccion = 1;
			$i= $long + 1;
		}
		
		//DE ESTA FORMA TAMBIEN FUNCIONA,PREPARANDO y EJECUTANDO CADA SENTENCIA
		//Preprar y ejecutar la primera sentencia
		/*$sql1 = "UPDATE info1 SET des = 'Actuación Registrada por la Oficina de Ejecución de Sentencias'
				 WHERE radicado ='$d0'";
						 
		//$params1 = array( $orderId, $qty, $productId );
		$params1  = array();
		$options1 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt1    = sqlsrv_query( $conn, $sql1, $params1, $options1 );
				
				
		//Preparar y ejecutar la segunda sentencia
		$sql2 = "INSERT INTO info2(numero) values('$d0')";
				
		//$params2 = array($qty, $productId);
		$params2  = array();
		$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmt2    = sqlsrv_query( $conn, $sql2, $params2, $options2 );
				
		//Si ambas sentencias finalizaran con éxito, consolidar la transacción.
		//En caso contrario, revertirla. 
		if( $stmt1 && $stmt2 ) {
			 //sqlsrv_commit( $conn );
			 //echo "Transaccion consolidada.<br />";
		} 
		else {
			//sqlsrv_rollback( $conn );
			//echo "Transaccion revertida.<br />";
			$error_transaccion = 1;
			$i= $long + 1;
		}*/
			
			
		//--------------------------------------------------------------------------------------------------------------------------------------------
		
		//INCREMENTAR EL WHILE
		$i= $i + 1;
	
	}//FIN WHILE
	
	//PARA LLEVAR EL REGISTRO DEL LOG
	$fechaa  = date('Y-m-d g:ia');

    $horaa   = explode(' ',$fechaa);

    $fechal  = $horaa[0];
      
	$hora    = $horaa[1]; 
	  
	$long = $long - 1;
	$accion  = "REGISTRO REPARTO MASIVO, CANTIDAD DE REGISTROS: ".$long;
	
	$idres   = $_SESSION['idUsuario'];

    $detalle = $_SESSION['nombre']." ".$accion." ".$fechal." a las: ".$hora;
	  
	$tipolog = 1;
  
	$sql = "INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');";
		
	$resultado = mysql_query($sql);
						
	if (!$resultado) {
		$error_transaccion = 1;
	}
	
		
	//---------------------------------------------------------------
	if($error_transaccion) {
		//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
		mysql_query("ROLLBACK",$conexion);
		
		sqlsrv_rollback( $conn );
		
		echo $error_transaccion;
	} 
	else {
		//SE TERMINA LA TRANSACCION 
		mysql_query("COMMIT",$conexion);
		
		sqlsrv_commit( $conn );
		
		echo $error_transaccion;
	}
	//-----------------------------------------------------------------
	/*if($error_transaccion) {
		//echo $error_transaccion;
		echo "<HTML><script>alert('ERROR AL PROCESAR LOS DATOS');location.href='/ejecucion/repartomasivo/templates/clientesGrid.php';</script></HTML>";
	} 
	else {
		//echo $error_transaccion;
		echo "<HTML><script>alert('PROCESAMIENTO DE LOS DATOS OK...');location.href='/ejecucion/repartomasivo/templates/clientesGrid.php';</script></HTML>";
	}*/
}
else{
	echo $conexion; 
}
mysql_close($conexion);

}//FIN DEL ELSE DE if($_SESSION['id'] == ""){
?>