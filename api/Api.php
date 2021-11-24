<?php
    // Config
    require_once "../config/APP.php";
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
        // Login
        public function getLogin($data) {
            $response = LoginController::getLoginController($data);
            $url = SERVERURL . "?route=admin";
            $response_login = array($url, $response);
            echo json_encode($response_login);
        }

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

        public function getProcessInJusticia($radicado) {
            $response = EntryGuardianshipsController::getProcessInJusticiaController($radicado);
            echo json_encode($response);
        }

        public function migrateGuardianship($radicado, $process) {
            session_start();
            $id_employee = $_SESSION["id_employee"];
            $employee_full_name = $_SESSION["firstname"] . " " . $_SESSION["lastname"];
            // TODO: Organizar el envio de usuario
            $response = EntryGuardianshipsController::migrateGuardianshipController($radicado, $process, $id_employee, $employee_full_name);
            echo json_encode($response);
        }

        // Executory
        public function getProcess($radicado) {
            $response = ExecutoryController::getProcessController($radicado);
            echo json_encode($response);
        }

        public function getAllActionsFolder() {
            $response = ExecutoryController::getAllActionsFolderController();
            echo json_encode($response);
        }

        public function getAllUsers() {
            $response = ExecutoryController::getAllUsersController();
            echo json_encode($response);
        }

        public function registerExecutory($radicados_executory_list) {
            session_start();
            $id_usuario = $_SESSION['idUsuario'];
            $nombre_usuario = $_SESSION['nombre'];
            $response = ExecutoryController::registerExecutoryController($radicados_executory_list, $id_usuario, $nombre_usuario);
            echo json_encode($response);
        }
    }

    // Necesario para recibir parametros con Axios
    $_POST = json_decode(file_get_contents("php://input"), true);

    // Recepcion de los datos enviados mediante POST desde main.js
    $option = (isset($_POST['option'])) ? $_POST['option'] : '';

    // Login
    $id_employee_login = (isset($_POST['id_employee_login'])) ? $_POST['id_employee_login'] : '';
    $password_login = (isset($_POST['password_login'])) ? $_POST['password_login'] : '';
    $remember = (isset($_POST['remember'])) ? $_POST['remember'] : '';

    // EntryGuardianships
    $radicado = (isset($_POST['radicado'])) ? $_POST['radicado'] : '';
    $process = (isset($_POST['process'])) ? $_POST['process'] : '';
    $start_date = (isset($_POST['start_date'])) ? $_POST['start_date'] : '';
    $end_date = (isset($_POST['end_date'])) ? $_POST['end_date'] : '';
    
    // Executory
    $radicados_executory_list = (isset($_POST['radicados_executory_list'])) ? $_POST['radicados_executory_list'] : '';
    

    $obj = new Api();
    switch ($option) {
        // Login
        case 'getLogin':
            $data = array(
                "id_employee_login" => $id_employee_login,
                "password_login" => $password_login,
                "remember" => $remember,
            );
            $obj->getLogin($data);
            break;
        
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
                "start_date" => $start_date,
                "end_date" => $end_date,
                "radicado" => $radicado
            );
            $obj->getProcessesInJusticia($data);
            break;
        
        // Executory
        case 'getProcess': //
            $obj->getProcess($radicado);
            break;

        case 'getAllActionsFolder': //
            $obj->getAllActionsFolder();
            break;

        case 'getAllUsers': //
            $obj->getAllUsers();
            break;

        case 'registerExecutory':
            $obj->registerExecutory($radicados_executory_list);
            break;
    }

    // Envira el array final en formato json a JS
    // print json_encode($obj, JSON_UNESCAPED_UNICODE);
    $connection = NULL;