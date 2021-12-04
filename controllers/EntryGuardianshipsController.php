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
            $zip_code = substr($radicado, 0, 5); // 17001
            $corporation = substr($radicado, 5, 2); // 40
            $specialty = substr($radicado, 7, 2); // 03
            $original_court = substr($radicado, 9, 3); // 007
            $year = substr($radicado, 12, 4); // 2021
            $consecutive = substr($radicado, 16, 5); // 00567
            $instance = substr($radicado, 21, 2); // 00
            
            $log_action  = "Se realiza Migración de Tutela: " . $radicado;
            $log_detail = $employee_full_name . " realiza Migración de Tutela: " . $radicado . " " . date('Y-m-d') . " " . "a las: " . date('h:i:sa');

            // Tutelas
            if ($corporation == '43' && 
                $specialty == '03') {
                $id_dossier_type = 2;
                switch ($original_court) {
                    case '001':
                        $id_court = 13;
                        break;
                    case '002':
                        $id_court = 14;
                        break;
                }
            }
            // Proceso ejecutivo
            // if ($corporation == '40' && 
            //     $specialty == '03') {
            //     $id_dossier_type = 2;
            //     switch ($original_court) {
            //         case '001':
            //             $id_court = 1;
            //             break;
            //         case '002':
            //             $id_court = 2;
            //             break;
            //         case '003':
            //             $id_court = 3;
            //             break;
            //         case '004':
            //             $id_court = 4;
            //             break;
            //         case '005':
            //             $id_court = 5;
            //             break;
            //         case '006':
            //             $id_court = 6;
            //             break;
            //         case '007':
            //             $id_court = 7;
            //             break;
            //         case '008':
            //             $id_court = 8;
            //             break;
            //         case '009':
            //             $id_court = 9;
            //             break;
            //         case '0010':
            //             $id_court = 10;
            //             break;
            //         case '011':
            //             $id_court = 11;
            //             break;
            //         case '012':
            //             $id_court = 12;
            //             break;
            //     }
            // }

            $response = EntryGuardianshipsModel::migrateGuardianshipModel($radicado, $process, $id_employee, $log_action, $log_detail, $id_court, $instance, $id_dossier_type);
            return $response;
        }
    }
?>