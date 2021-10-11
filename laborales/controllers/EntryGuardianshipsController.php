<?php
    class EntryGuardianshipsController {
        public static function getGuardianshipsOfDayController() {
            $response = EntryGuardianshipsModel::getGuardianshipsOfDayModel();
            return $response;
        }
    }
?>