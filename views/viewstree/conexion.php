<?php 

class DB{   

	var $conect;    
	var $BaseDatos;     
	var $Servidor;  
	var $Usuario;   
	var $Clave;     
	
	function DB(){ 
	     
		$this->BaseDatos = "ejecucion";        
		$this->Servidor  = "localhost";        
		$this->Usuario   = "root";        
		$this->Clave     = "Ejecuc10n2014";   
	}      
	function conectar() {  
	      
		if(!($con=@mysql_connect($this->Servidor,$this->Usuario,$this->Clave))){            
			echo"Error al conectar a la base de datos";            
			exit();        
		}        
		if (!@mysql_select_db($this->BaseDatos,$con)){            
			echo "Error al seleccionar la base de datos";            
			exit();        
		}
		        
		$this->conect=$con; 
		      
		return true;    
	}
}

?> 
