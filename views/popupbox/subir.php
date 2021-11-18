<?php

//$ruta = './Files/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos

//PARTE ANEXADA AL SCRIP ORIGINAL 30 DE MARZO 2017 POR JORGE ANDRES VALENCIA OROZCO
//-----ELIMINAR LOS ARCHIVOS QUE SE ENCUENTRAN EN LA CARPETA C:/AUTOS_ESTADOS/------------------------------
//-----PARA ACTUALIZARLOS CON LOS NUEVOS ARCHIVOS A SUBIR---------------------------------------------------
$ruta = 'C:/AUTOS_ESTADOS/'; //Decalaramos una variable con la ruta en donde almacenaremos los archivos
	
$files = array_diff(scandir($ruta), array('.','..')); 

foreach ($files as $file) { 

	(is_dir("$ruta/$file")) ? delTree("$ruta/$file") : unlink("$ruta/$file"); 
	  
} 
	
//CREA DE NUEVO EL DIRECTORIO C:/AUTOS_ESTADOS/ 
//PARA ALMACENAR LOS NUEVOS ARCHIVOS A SUBIR 
mkdir($ruta);

//------------------------------------SUBIR LOS ARCHIVOS-----------------------------------------------------------------------

$mensage = '';//Declaramos una variable mensaje quue almacenara el resultado de las operaciones.

foreach ($_FILES as $key) //Iteramos el arreglo de archivos
{
	if($key['error'] == UPLOAD_ERR_OK )//Si el archivo se paso correctamente Ccontinuamos 
		{
			$NombreOriginal = $key['name'];//Obtenemos el nombre original del archivo
			$temporal       = $key['tmp_name']; //Obtenemos la ruta Original del archivo
			$Destino        = $ruta.$NombreOriginal;//Creamos una ruta de destino con la variable ruta y el nombre original del archivo	
			
			move_uploaded_file($temporal, $Destino); //Movemos el archivo temporal a la ruta especificada		
			
		}

	if ($key['error']=='') //Si no existio ningun error, retornamos un mensaje por cada archivo subido
		{
			$mensage .= '-> Archivo <b>'.$NombreOriginal.'</b> Subido correctamente. <br>';
		}
	if ($key['error']!='')//Si existio algún error retornamos un el error por cada archivo.
		{
			$mensage .= '-> No se pudo subir el archivo <b>'.$NombreOriginal.'</b> debido al siguiente Error: n'.$key['error']; 
		}
	
}

echo $mensage;// Regresamos los mensajes generados al cliente

?>
