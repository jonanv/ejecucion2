<?php
    class ExecutoryController {
        public static function getDossierController($radicado) {
            $response = ExecutoryModel::getDossierModel($radicado);
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

        public static function getAllPlaintiffOfDossierController($id_dossier) {
            $response = ExecutoryModel::getAllPlaintiffOfDossierModel($id_dossier);
            return $response;
        }
        
        public static function getAllDefendantOfDossierController($id_dossier) {
            $response = ExecutoryModel::getAllDefendantOfDossierModel($id_dossier);
            return $response;
        }

        public static function registerExecutoryController($radicados_executory_list, $id_usuario, $nombre_usuario) {
            $response = ExecutoryModel::registerExecutoryModel($radicados_executory_list, $id_usuario, $nombre_usuario);
            return $response;
        }
    }