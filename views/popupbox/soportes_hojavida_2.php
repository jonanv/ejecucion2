<?php
session_start();

include_once ('Conexion.php');

//NOTA IMPORTANTE: SE HACE EL CAMBION DE EL $idusuario = $_SESSION['idUsuario'] POR $idusuario = trim($_POST['id_usuario_hv'])
//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
//13 DE OCTUBRE 2017

//$idusuario = $_SESSION['idUsuario'];
$idusuario = trim($_POST['id_usuario_hv']);

//ID DEL ESTUDIO SELECCIONADO
//PARA CONCATENAR LOS NOMBRES DE LOS ARCHIVOS Y QUE 
//ESTE ID PERMITA IDENTIFICAR QUE ESE SOPORTE ES DE ESE ESTUDIO
$id_estudio = trim($_POST['id_estudio']);

//ADICIONO EL identificador_archivo PARA SABER SI SE SUBIRA UN ESTUDIO O UNA EXPERIENCIA LABORAL
$identificador_archivo = trim($_POST['identificador_archivo']);


//$ruta = './Files/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos

//PARTE ANEXADA AL SCRIP ORIGINAL 30 DE MARZO 2017 POR JORGE ANDRES VALENCIA OROZCO
//-----ELIMINAR LOS ARCHIVOS QUE SE ENCUENTRAN EN LA CARPETA C:/AUTOS_ESTADOS/------------------------------
//-----PARA ACTUALIZARLOS CON LOS NUEVOS ARCHIVOS A SUBIR---------------------------------------------------
//$ruta = 'C:/AUTOS_ESTADOS/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos


//19 DE SEPTIEMBRE 2017
//NOTA: SE USAN DOS RUTAS ($ruta Y $ruta_BD) YA QUE PARA CREAR LOS DIRECTORIOS
//SOPORTES_ESTUDIOS, SOPORTES_EXPERIENCIA_LABORAL, ANTECEDENTES_CERTIFICADOS
//SE NECESITA LA RUTA ABSOLUTA ($ruta), PERO PARA GRABAR EN LA TABLA hv_rutas_archivos LA RUTA
//SOLO ES NECESARIO HASTA 'HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_ESTUDIOS/"
//PARA QUE ABRA OTRA VENTANA CON EL PDF http://172.16.176.194/ejecucion/HOJASDEVIDA/38/SOPORTES_ESTUDIOS/2_acta_grado.pdf
//DE ESTA FORMA NO ABRIRIA C:/wamp/www/ejecucion/HOJASDEVIDA/38/SOPORTES_ESTUDIOS/2_acta_grado.pdf

//ESTUDIO
if($identificador_archivo == "E"){
	
	//$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_ESTUDIOS/";
	//$ruta_BD = 'HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_ESTUDIOS/";
	
	$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$idusuario."/SOPORTES_ESTUDIOS/";
	$ruta_BD = 'HOJASDEVIDA/'.$idusuario."/SOPORTES_ESTUDIOS/";
	
	
}

//EXPERIENCIA LABORAL
if($identificador_archivo == "L"){
	
	//$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_EXPERIENCIA_LABORAL/";
	//$ruta_BD = 'HOJASDEVIDA/'.$_SESSION['idUsuario']."/SOPORTES_EXPERIENCIA_LABORAL/";
	
	$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$idusuario."/SOPORTES_EXPERIENCIA_LABORAL/";
	$ruta_BD = 'HOJASDEVIDA/'.$idusuario."/SOPORTES_EXPERIENCIA_LABORAL/";
}

//ACTOS ADMINISTRATIVOS
if($identificador_archivo == "AD"){
	
	//$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$_SESSION['idUsuario']."/ACTOS_ADMINISTRATIVOS/";
	//$ruta_BD = 'HOJASDEVIDA/'.$_SESSION['idUsuario']."/ACTOS_ADMINISTRATIVOS/";
	
	$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$idusuario."/ACTOS_ADMINISTRATIVOS/";
	$ruta_BD = 'HOJASDEVIDA/'.$idusuario."/ACTOS_ADMINISTRATIVOS/";
	
}

//ANTECEDENTES / CERTIFICADOS
if($identificador_archivo == "A"){
	
	//$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$_SESSION['idUsuario']."/ANTECEDENTES_CERTIFICADOS/";
	//$ruta_BD = 'HOJASDEVIDA/'.$_SESSION['idUsuario']."/ANTECEDENTES_CERTIFICADOS/";
	
	$ruta    = 'C:/wamp/www/ejecucion/HOJASDEVIDA/'.$idusuario."/ANTECEDENTES_CERTIFICADOS/";
	$ruta_BD = 'HOJASDEVIDA/'.$idusuario."/ANTECEDENTES_CERTIFICADOS/";
	
	$id_estudio = $idusuario;
}

//AQUI SE CREA EL DIRECTORIO
if(is_dir($ruta)){$bandera=0;}
else{mkdir($ruta, 0, true);}


/*$files = array_diff(scandir($ruta), array('.','..')); 

foreach ($files as $file) { 

	(is_dir("$ruta/$file")) ? delTree("$ruta/$file") : unlink("$ruta/$file"); 
	  
} 
	
//CREA DE NUEVO EL DIRECTORIO C:/AUTOS_ESTADOS/ 
//PARA ALMACENAR LOS NUEVOS ARCHIVOS A SUBIR 
mkdir($ruta);*/

//------------------------------------SUBIR LOS ARCHIVOS-----------------------------------------------------------------------

$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.

$error_transaccion = 0; //variable para detectar error

$error_moverarchivo = 0; //variable para detectar error cuando se sube un archivo y no guardar la ruta en hv_rutas_archivos

//Conexión a la base de datos
$conexion = db_connect($dbdefault_dbname);
		
if($conexion > 0){


	foreach ($_FILES as $key) //Iteramos el arreglo de archivos
	{
	
		if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
			{
				$NombreOriginal = $id_estudio.'_'.$key['name'];//Obtenemos el nombre original del archivo
				$temporal       = $key['tmp_name']; //Obtenemos la ruta Original del archivo
				$Destino        = $ruta.$NombreOriginal;//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
					
				move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
				
				$error_moverarchivo = 0;
				
			}
	
		if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
			{
				$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
				
				$error_moverarchivo = 0;
			}
		if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
			{
				$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: n'.$key['error']; 
				
				$error_moverarchivo = 1;
			}
			
		
		if($error_moverarchivo == 0){
		
			$Destino_BD = $ruta_BD.$NombreOriginal;
			
			
				
			$sql = "INSERT INTO hv_rutas_archivos (id_archivo_central,ruta) 
					VALUES ('$id_estudio', '$Destino_BD')";
														
			$resultado = mysql_query($sql);
	
			if (!$resultado) {
					
				$error_transaccion = 1;
													
				$mensage .= "ERROR EN EL INSERT 1: ".mysql_errno($conexion);
			}
			
			/*$ultimo_id  = mysql_insert_id();
			
			$sql_2 = "UPDATE hv_central T1
					  LEFT JOIN hv_rutas_archivos T2 ON T1.id = T2.id_archivo_central
					  SET T1.id_rutas_archivo = '$ultimo_id'
					  WHERE T2.id  = '$ultimo_id'";
					  
					  
			$resultado_2 = mysql_query($sql_2);
	
			if (!$resultado_2) {
					
				$error_transaccion = 1;
													
				$mensage .= "ERROR EN EL INSERT 2: ".mysql_errno($conexion);
			}*/		  
	
		
		}				
				
					
	}
	
	if($error_transaccion) {
						
		//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
		mysql_query("ROLLBACK",$conexion);
		
		
		//SI EXISTE UN ERROR EN EL PROCESO NO SE GRABA EN LA TABLA hv_rutas_archivos,
		//NI SE SUBEN LOS ARCHIVOS
		foreach ($_FILES as $key) //Iteramos el arreglo de archivos
		{
		
			if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
			{
				$NombreOriginal = $id_estudio.'_'.$key['name'];//Obtenemos el nombre original del archivo
				$temporal       = $key['tmp_name']; //Obtenemos la ruta Original del archivo
				$Destino        = $ruta.$NombreOriginal;//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
				
						
				//-------------ELIMINAR EL ARCHIVO-----------
				if (is_file($Destino)) {
					
					chmod($Destino,0777);
						
					if(!unlink($Destino)) {
						$error_moverarchivo = 1;
					}
					else{
						$error_moverarchivo = 0;
					}
						
				} 
				else {
					$error_moverarchivo = 1;
				}
				//-------------------------------------------		
					
					
			}
		

		}
		
		
		
		
		
	} //FIN if($error_transaccion) 
	else {
					
		//SE TERMINA LA TRANSACCION 
		mysql_query("COMMIT",$conexion);
						
						
	}
	
	
	
}
else{

	$mensage = $conexion; 
}

mysql_close($conexion);

echo $mensage;// Regresamos los mensajes generados al cliente



?>
