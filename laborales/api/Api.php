<?php
    // Config
    require_once "../config/SERVER.php";

    // Models
    require_once "../models/EntryGuardianshipsModel.php";
    require_once "../models/LoginModel.php";
    require_once "../models/ExecutoryModel.php";
    
    // Controllers
    require_once "../controllers/EntryGuardianshipsController.php";
    require_once "../controllers/LoginController.php";
    require_once "../controllers/ExecutoryController.php";

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
            session_start();
            $id_usuario = $_SESSION['idUsuario'];
            $nombre_usuario = $_SESSION['nombre'];
            $response = EntryGuardianshipsController::migrateGuardianshipController($radicado, $process, $id_usuario, $nombre_usuario);
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

        // Login
        public function getLogin($data) {
            $response = LoginController::getLoginController($data);
            echo json_encode($response);
        }

        // Executory
        public function getProcess($radicado) {
            $response = ExecutoryController::getProcessController($radicado);
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
    
    // Login
    $id_employee_login = (isset($_POST['id_employee_login'])) ? $_POST['id_employee_login'] : '';
    $password_login = (isset($_POST['password_login'])) ? $_POST['password_login'] : '';

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

        // Login
        // case 'getLogin':
        //     $data = array(
        //         "id_employee_login" => $id_employee_login,
        //         "password_login" => $password_login,
        //     );
        //     $obj->getLogin($data);
        //     break;

        case 'getProcess': //
            $obj->getProcess($radicado);
            break;
    }

    // Envira el array final en formato json a JS
    // print json_encode($obj, JSON_UNESCAPED_UNICODE);
    $connection = NULL;