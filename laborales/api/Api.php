<?php
    // Config
    require_once "../config/SERVER.php";

    // Models
    require_once "../models/EntryGuardianshipsModel.php";
    
    // Controllers
    require_once "../controllers/EntryGuardianshipsController.php";

    class Api {
        // EntryGuardianships
        public function getEntryGuardianships() {
            $response = EntryGuardianshipsController::getGuardianshipsOfDayController();
            echo json_encode($response);
        }

        public function getProcessExist($radicado) {
            $response = EntryGuardianshipsController::getProcessExistController($radicado);
            echo json_encode($response);
        }
    }

    // Necesario para recibir parametros con Axios
    $_POST = json_decode(file_get_contents("php://input"), true);

    // Recepcion de los datos enviados mediante POST desde main.js
    $option = (isset($_POST['option'])) ? $_POST['option'] : '';

    // EntryGuardianships
    $radicado = (isset($_POST['radicado'])) ? $_POST['radicado'] : '';

    $obj = new Api();
    switch ($option) {
        // EntryGuardianships
        case 'getEntryGuardianships':
            $obj->getEntryGuardianships();
            break;

        case 'processExist':
            $obj->getProcessExist($radicado);
            break;
    }

    // Envira el array final en formato json a JS
    // print json_encode($obj, JSON_UNESCAPED_UNICODE);
    $connection = NULL;