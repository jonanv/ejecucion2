<?php
require_once 'controller/alumno.controller.php';

// Todo esta lógica hara el papel de un FrontController
if(!isset($_REQUEST['c'])){


	/*echo '<script languaje="JavaScript"> 
									
			alert(1);
		</script>';*/

    $controller = new AlumnoController();
    $controller->Index();    
} 
else {


	/*echo '<script languaje="JavaScript"> 
									
			alert(2);
		</script>';*/
    
    // Obtenemos el controlador que queremos cargar
    $controller = $_REQUEST['c'] . 'Controller';
    $accion     = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    
    
    // Instanciamos el controlador
    $controller = new $controller();
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}

?>