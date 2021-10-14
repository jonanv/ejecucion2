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

        public function getProcessInJusticia($radicado) {
            $response = EntryGuardianshipsController::getProcessInJusticiaController($radicado);
            echo json_encode($response);
        }

        public function migrateGuardianship($radicado, $process) {
            $response = EntryGuardianshipsController::migrateGuardianshipController($radicado, $process);
            echo json_encode($response);
        }

        public function getProcessesInJusticia($data) {
            $response_processes_in_justicia = EntryGuardianshipsController::getProcessesInJusticiaController($data);
            $response_processes = array();

            foreach ($response_processes_in_justicia as $key => $value) {
                if ($value['A103LLAVPROC'] != null) {
                    $response_exist_guardianships = EntryGuardianshipsController::getProcessExistController($value['A103LLAVPROC']);
                    array_push($response_processes, $response_exist_guardianships);
                } else {
                    array_push($response_processes, null);
                }
            }
            $response = array("ok", $response_processes_in_justicia, $response_processes);
            echo json_encode($response);
        }
    }

    // Necesario para recibir parametros con Axios
    $_POST = json_decode(file_get_contents("php://input"), true);

    // Recepcion de los datos enviados mediante POST desde main.js
    $option = (isset($_POST['option'])) ? $_POST['option'] : '';

    // EntryGuardianships
    $radicado = (isset($_POST['radicado'])) ? $_POST['radicado'] : '';
    $process = (isset($_POST['process'])) ? $_POST['process'] : '';
    $startDate = (isset($_POST['startDate'])) ? $_POST['startDate'] : '';
    $endDate = (isset($_POST['endDate'])) ? $_POST['endDate'] : '';

    $obj = new Api();
    switch ($option) {
        // EntryGuardianships
        case 'getEntryGuardianships': // 
            $obj->getEntryGuardianships();
            break;

        case 'getProcessInJusticia': // 
            $obj->getProcessInJusticia($radicado);
            break;

        case 'migrateGuardianship': // Create
            $obj->migrateGuardianship($radicado, $process);
            break;

        case 'getProcessesInJusticia': //
            $data = array(
                "startDate" => $startDate,
                "endDate" => $endDate,
                "radicado" => $radicado
            );
            $obj->getProcessesInJusticia($data);
            break;
    }

    // Envira el array final en formato json a JS
    // print json_encode($obj, JSON_UNESCAPED_UNICODE);
    $connection = NULL;