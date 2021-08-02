<?php
Class FTPClient{

	public function __construct() {        }
		 
	private function logMessage($message){
    	$this->messageArray[] = $message;
	}
              
	public function getMessages(){
    	return $this->messageArray;
	}
	
	//Conexión
	public function connect ($server, $ftpUser, $ftpPassword, $isPassive = false){
        // *** Creamos una conexión básica
        $this->connectionId = ftp_connect($server);

        // *** Login con usuario y contraseña
        $loginResult = ftp_login($this->connectionId, $ftpUser, $ftpPassword);

        // *** Indicamos si el método de conexión es pasivo o no (default off)
        ftp_pasv($this->connectionId, $isPassive);

        // *** Check conexión
        if ((!$this->connectionId) || (!$loginResult)) {
                
				/*$this->logMessage('FTP connection has failed!');
                $this->logMessage('Attempted to connect to ' . $server . ' for user ' . $ftpUser, true);*/
				$this->logMessage('FALLO CONEXION');
				
                return false;
				
				
				
        } 
		else {
                
				/*$this->logMessage('Connected to ' . $server . ', for user ' . $ftpUser);
                $this->loginOk = true;*/
				
				$this->logMessage('CONEXION OK');
				
                return true;
				
				
        }
	}
	
	//Creando directorio
	public function makeDir($directory){
        // *** Si la creación del directorio es satisfactoria..
        if (ftp_mkdir($this->connectionId, $directory)) {
                $this->logMessage('Directory "' . $directory . '" created successfully');
                return true;
        } else {
                // *** ...Sino, fallo.
                $this->logMessage('Failed creating directory "' . $directory . '"');
                return false;
        }
	}
	
	//Subiendo un fichero
	public function uploadFile ($fileFrom, $fileTo){
        // *** miramos el tipo de fichero que es
        $asciiArray = array('txt', 'csv');
        $extension = end(explode('.', $fileFrom));
        if (in_array($extension, $asciiArray)) {
                $mode = FTP_ASCII;
        } else {
                $mode = FTP_BINARY;
        }

        // *** Subimos el fichero
        $upload = ftp_put($this->connectionId, $fileTo, $fileFrom, $mode);

        // *** Check el estado de la subida
        if (!$upload) {
                $this->logMessage('FTP upload has failed!');
                return false;
        } else {
                $this->logMessage('Uploaded "' . $fileFrom . '" as "' . $fileTo);
                return true;
        }
	}
	
	//Listando los ficheros
	public function changeDir($directory){
        if (ftp_chdir($this->connectionId, $directory)) {
                $this->logMessage('Current directory is now: ' . ftp_pwd($this->connectionId));
                return true;
        } else {
                $this->logMessage('Couldnt change directory');
                return false;
        }
	}
	
	public function getDirListing($directory = '.', $parameters = '-la'){
        // obtiene el contenido del directorio
        $contentsArray = ftp_nlist($this->connectionId, $parameters . '  ' . $directory);
        return $contentsArray;
	}
	
	//Descargando un fichero
	public function downloadFile ($fileFrom, $fileTo){

        // *** Indicamos el modo de transferencia

        $asciiArray = array('txt', 'csv');

        $extension = end(explode('.', $fileFrom));

        if (in_array($extension, $asciiArray)) {

                $mode = FTP_ASCII;

        } else {

                $mode = FTP_BINARY;

        }



        if (ftp_get($this->connectionId, $fileTo, $fileFrom, $mode, 0)) {

                $this->logMessage(' file "' . $fileTo . '" successfully downloaded');
				
			    return true;

               

        } else {

				$this->logMessage('There was an error downloading file "' . $fileFrom . '" to "' . $fileTo . '"');
				 
                return false;

               

        }

	}
	
	//Eliminar Archivo
	public function delete_file($file){
	
    	if (ftp_delete($this->connectionId, $file)) {
		
        	$this->logMessage("$file se ha eliminado satisfactoriamente\n");
            return true;
        } 
		else {
		
       		$this->logMessage("No se pudo eliminar $file\n");
        	return false;
        }
		
	}
	
	
	
	
	
}
?>
