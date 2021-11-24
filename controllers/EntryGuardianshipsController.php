<?php
    class EntryGuardianshipsController {
        public static function getGuardianshipsOfDayController() {
            $response = EntryGuardianshipsModel::getGuardianshipsOfDayModel();
            return $response;
        }

        public static function getProcessExistController($radicado) {
            $response = EntryGuardianshipsModel::getProcessExistModel($radicado);
            return $response;
        }

        public static function getProcessesInJusticiaController($data) {
            $response = EntryGuardianshipsModel::getProcessesInJusticiaModel($data);
            return $response;
        }

        public static function getProcessInJusticiaController($radicado) {
            $response = EntryGuardianshipsModel::getProcessInJusticiaModel($radicado);
            return $response;
        }

        public static function migrateGuardianshipController($radicado, $process, $id_employee, $employee_full_name) {
            // 17001-40-03-007-2021-00567-00
            $zip_code = substr($radicado, 0, 5);
            $corporation = substr($radicado, 5, 2);
            $specialty = substr($radicado, 7, 2);
            $original_court = substr($radicado, 9, 3);
            $year = substr($radicado, 12, 4);
            $consecutive = substr($radicado, 16, 5);
            $instance = substr($radicado, 21, 2);
            
            $accion  = "Se realiza Migración de Tutela: " . $radicado;
            $detalle = $employee_full_name . " realiza Migración de Tutela: " . $radicado . " " . date('Y-m-d') . " " . "a las: " . date('h:i:sa');
            $tipolog = 1;

            switch ($original_court) {
                case '001':
                    $idjuzgado = 15;
                    break;
                case '002':
                    $idjuzgado = 16;
                    break;
            }
            // TODO: Preguntar sobre los juzgados de origen cuando el codigo no es una tutela, es decir 4003

            $response = EntryGuardianshipsModel::migrateGuardianshipModel($radicado, $process, $id_employee, $accion, $detalle, $tipolog, $idjuzgado);
            return $response;
        }
    }
?>