<?php
    // Config
    require_once "../config/SERVER.php";

    // Models

    // Controllers

    class Api {

    }

    // Necesario para recibir parametros con Axios
    $_POST = json_decode(file_get_contents("php://input"), true);

    // Recepcion de los datos enviados mediante POST desde main.js
    $option = (isset($_POST['option'])) ? $_POST['option'] : '';

    $obj = new Api();
    switch ($option) {
        case 'value':
            // $obj->method();
            break;
        
        default:
            # code...
            break;
    }