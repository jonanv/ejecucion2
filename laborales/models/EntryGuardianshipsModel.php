<?php
    require_once "ConnectionModel.php";

    class EntryGuardianshipsModel {
        public static function getGuardianshipsOfDayModel() {
            date_default_timezone_set('America/Bogota');
		    $date = date('Y-m-d');

            $query = 
                "SELECT [A103LLAVPROC], [A103ANOTACTS], [A103FECHREPA], [A103HORAREPA]
                FROM [T103DAINFOPROC]
                WHERE [A103FECHREPA] = CONVERT(DATETIME, '$date', 121)
                AND [A103ANOTACTS] LIKE '%reparto%' 
                AND [A103CONSPROC] NOT IN(01, 02, 03, 04, 05, 06, 07, 08, 09, 10) 
                AND [A103LLAVPROC] LIKE '%170013105%'
                ORDER BY [A103HORAREPA] ASC";
            $response = ConnectionModel::connectSQLServer()->prepare($query);
            $response->execute();
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getProcessExistModel($radicado) {
            $query =
                "SELECT * 
                FROM ubicacion_expediente
                WHERE radicado = :radicado";
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
    }
?>