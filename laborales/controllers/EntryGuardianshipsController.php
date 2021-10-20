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
            $response = EntryGuardianshipsModel::migrateGuardianshipModel($radicado, $process, $id_usuario, $nombre_usuario);
            return $response;
        }

        public static function getProcessesInJusticiaController($data) {
            $response = EntryGuardianshipsModel::getProcessesInJusticiaModel($data);
            return $response;
        }
    }
?>