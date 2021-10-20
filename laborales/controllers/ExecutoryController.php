<?php
    class ExecutoryController {
        public static function getProcessController($radicado) {
            $response = ExecutoryModel::getProcessModel($radicado);
            return $response;
        }
    }