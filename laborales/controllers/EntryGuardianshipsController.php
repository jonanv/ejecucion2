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
    }
?>