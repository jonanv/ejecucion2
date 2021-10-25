<?php
    require_once "ConnectionModel.php";

    class ExecutoryModel {
        public static function getProcessModel($radicado) {
            $query = 
                "SELECT ubi.id AS idradicado, ubi.radicado, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado, 
                ubi.demandado, pc.nombre AS claseproceso, pj.nombre AS jo, pj.id AS idjo, pr.nombre AS jd, ubi.posicion, 
                ubi.observacion_archivo, dc.fecha, dc.observacion, u.empleado
                FROM ubicacion_expediente ubi 
                LEFT JOIN pa_clase_proceso pc ON ubi.idclase_proceso = pc.id
                LEFT JOIN pa_juzgado pj ON ubi.idjuzgado = pj.id
                LEFT JOIN juzgado_destino pr ON ubi.idjuzgado_reparto = pr.id
                LEFT JOIN detalle_correspondencia dc ON ubi.id = dc.idcorrespondencia
                LEFT JOIN pa_usuario u ON dc.idusuario = u.id
                WHERE ubi.radicado LIKE CONCAT('%', :radicado, '%')
                ORDER BY dc.fecha DESC";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
            if ($response->execute()) {
                $data = $response->fetch();
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getAllActionsFolderModel() {
            $query = 
                "SELECT * 
                FROM accion_expediente 
                ORDER BY id ASC";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getAllUsersModel() {
            $query = 
                "SELECT * 
                FROM pa_usuario 
                WHERE nombre_usuario NOT LIKE '%D%'
                ORDER BY id ASC";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }
    }