<?php
    class ExecutoryController {
        public static function getProcessController($radicado) {
            $response = ExecutoryModel::getProcessModel($radicado);
            return $response;
        }

        public static function getAllDossierAnnotationsTypeController() {
            $response = ExecutoryModel::getAllDossierAnnotationsTypeModel();
            return $response;
        }

        public static function getAllEmployeesController() {
            $response = ExecutoryModel::getAllEmployeesModel();
            return $response;
        }

        public static function registerExecutoryController($radicados_executory_list, $id_usuario, $nombre_usuario) {
            $response = ExecutoryModel::registerExecutoryModel($radicados_executory_list, $id_usuario, $nombre_usuario);
            return $response;
        }
    }