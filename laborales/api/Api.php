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
            $response_entry_guardianships = EntryGuardianshipsController::getGuardianshipsOfDayController();
            $response_guardianships = array();

            foreach ($response_entry_guardianships as $key => $value) {
                if ($value['A103LLAVPROC'] != null) {
                    $response_exist_guardianships = EntryGuardianshipsController::getProcessExistController($value['A103LLAVPROC']);
                    array_push($response_guardianships, $response_exist_guardianships);
                } else {
                    array_push($response_guardianships, null);
                }
            }
            $response = array("ok", $response_entry_guardianships, $response_guardianships);
            echo json_encode($response);
        }
    }

    // Necesario para recibir parametros con Axios
    $_POST = json_decode(file_get_contents("php://input"), true);

    // Recepcion de los datos enviados mediante POST desde main.js
    $option = (isset($_POST['option'])) ? $_POST['option'] : '';

    // EntryGuardianships
    // $radicado = (isset($_POST['radicado'])) ? $_POST['radicado'] : '';

    $obj = new Api();
    switch ($option) {
        // EntryGuardianships
        case 'getEntryGuardianships':
            $obj->getEntryGuardianships();
            break;

        // case 'processExist':
        //     $obj->getProcessExist($radicado);
        //     break;
    }

    // Envira el array final en formato json a JS
    // print json_encode($obj, JSON_UNESCAPED_UNICODE);
    $connection = NULL;