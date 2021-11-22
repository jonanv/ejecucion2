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

        public static function getProcessInJusticiaController($radicado) {
            $response = EntryGuardianshipsModel::getProcessInJusticiaModel($radicado);
            return $response;
        }

        public static function migrateGuardianshipController($radicado, $process, $id_usuario, $nombre_usuario) {
            $zip_code = substr($radicado, 0, 5);
            $corporation = substr($radicado, 5, 2);
            $specialty = substr($radicado, 7, 2);
            $original_court = substr($radicado, 9, 3);
            $year = substr($radicado, 12, 4);
            $consecutive = substr($radicado, 16, 5);
            $instance = substr($radicado, 21, 2);
            
            $accion  = "Se realiza Migración de Tutela: " . $radicado;
            $detalle = $nombre_usuario . " realiza Migración de Tutela: " . $radicado . " " . date('Y-m-d') . " " . "a las: " . date('h:i:sa');
            $tipolog = 1;

            switch ($original_court) {
                case '001':
                    $idjuzgado = 15;
                    break;
                case '002':
                    $idjuzgado = 16;
                    break;
            }

            $response = EntryGuardianshipsModel::migrateGuardianshipModel($radicado, $process, $id_usuario, $accion, $detalle, $tipolog, $idjuzgado);
            return $response;
        }

        public static function getProcessesInJusticiaController($data) {
            $response = EntryGuardianshipsModel::getProcessesInJusticiaModel($data);
            return $response;
        }
    }
?>