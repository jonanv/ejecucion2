<?php
    class ExecutoryController {
        public static function getProcessController($radicado) {
            $response = ExecutoryModel::getProcessModel($radicado);
            return $response;
        }

        public static function getAllActionsFolderController() {
            $response = ExecutoryModel::getAllActionsFolderModel();
            return $response;
        }

        public static function getAllUsersController() {
            $response = ExecutoryModel::getAllUsersModel();
            return $response;
        }
    }