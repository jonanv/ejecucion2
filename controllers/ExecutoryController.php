<?php
    class ExecutoryController {
        public static function getDossierController($radicado) {
            $response = ExecutoryModel::getDossierModel($radicado);
            return $response;
        }

        public static function getAllAnnotationTypesController() {
            $response = ExecutoryModel::getAllAnnotationTypesModel();
            return $response;
        }

        public static function getAllEmployeesController() {
            $response = ExecutoryModel::getAllEmployeesModel();
            return $response;
        }

        public static function getAllPlaintiffsOfDossierController($id_dossier) {
            $response = ExecutoryModel::getAllPlaintiffsOfDossierModel($id_dossier);
            return $response;
        }
        
        public static function getAllDefendantsOfDossierController($id_dossier) {
            $response = ExecutoryModel::getAllDefendantsOfDossierModel($id_dossier);
            return $response;
        }

        public static function getLastDossierAnnotationController($id_dossier) {
            $response = ExecutoryModel::getLastDossierAnnotationModel($id_dossier);
            return $response;
        }

        public static function registerExecutoryController($radicados_executory_list, $id_usuario, $nombre_usuario) {
            $response = ExecutoryModel::registerExecutoryModel($radicados_executory_list, $id_usuario, $nombre_usuario);
            return $response;
        }
    }