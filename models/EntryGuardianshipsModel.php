<?php
    require_once "ConnectionModel.php";

    class EntryGuardianshipsModel {
        public static function getGuardianshipsOfDayModel() {
            date_default_timezone_set('America/Bogota');
		    $date = date('Y-m-d');

            // CONVERT(DATETIME, '$date', 121)
            // SQLServer
            $query = 
                "SELECT A103LLAVPROC, A103ANOTACTS, A103FECHREPA, A103HORAREPA
                FROM T103DAINFOPROC
                WHERE A103FECHREPA = '2021-10-11'
                AND A103ANOTACTS LIKE '%reparto%' 
                AND A103CONSPROC NOT IN(01, 02, 03, 04, 05, 06, 07, 08, 09, 10) 
                AND 
                    -- (
                        A103LLAVPROC LIKE '%170014303%'
                    -- OR A103LLAVPROC LIKE '%170014003%')
                ORDER BY A103HORAREPA ASC";
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
                FROM dossier
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

        public static function getProcessesInJusticiaModel($data) {
            if ($data['radicado'] == null) {
                // SQLServer
                $query = 
                    "SELECT A103LLAVPROC, A103ANOTACTS, A103FECHREPA, A103HORAREPA
                    FROM T103DAINFOPROC
                    WHERE A103ANOTACTS LIKE '%reparto%'
                    AND A103FECHREPA >= CONVERT(DATETIME, :start_date, 121) 
                    AND A103FECHREPA <= CONVERT(DATETIME, :end_date, 121)
                    ORDER BY A103HORAREPA ASC";
                $response = ConnectionModel::connectSQLServer()->prepare($query);
                $response->bindParam(":start_date", $data['start_date'], PDO::PARAM_STR);
                $response->bindParam(":end_date", $data['end_date'], PDO::PARAM_STR);
            } else {
                // SQLServer
                $query = 
                    "SELECT A103LLAVPROC, A103ANOTACTS, A103FECHREPA, A103HORAREPA
                    FROM T103DAINFOPROC
                    WHERE A103ANOTACTS LIKE '%reparto%'
                    AND 
                        ( A103FECHREPA >= CONVERT(DATETIME, :start_date, 121) 
                        AND A103FECHREPA <= CONVERT(DATETIME, :end_date, 121) )
                    AND A103LLAVPROC LIKE '%' + :radicado + '%'
                    ORDER BY A103HORAREPA ASC";
                $response = ConnectionModel::connectSQLServer()->prepare($query);
                $response->bindParam(":start_date", $data['start_date'], PDO::PARAM_STR);
                $response->bindParam(":end_date", $data['end_date'], PDO::PARAM_STR);
                $response->bindParam(":radicado", $data['radicado'], PDO::PARAM_STR);
            }

            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getProcessInJusticiaModel($radicado) {
            // SQLServer
            $query = 
                "SELECT A103CODICLAS, A053DESCCLAS, A103CODISUBC, A071DESCSUBC,
                A112LLAVPROC, A112CODISUJE, A112NUMESUJE, A112NOMBSUJE, A112FLAGDETE,
                A057DESCSUJE, A103ENTIRADI, A051DESCENTI, A103ESPERADI, A062DESCESPE,
                A103CODIPROC, A052DESCPROC, A103CODIPONE, A103NOMBPONE
                FROM T103DAINFOPROC 
                LEFT JOIN T112DRSUJEPROC ON A103LLAVPROC = A112LLAVPROC 
                LEFT JOIN T057BASUJEGENE ON A112CODISUJE = A057CODISUJE
                LEFT JOIN T053BACLASGENE ON A103CODICLAS = A053CODICLAS
                LEFT JOIN T071BASUBCGENE ON A103CODISUBC = A071CODISUBC
                LEFT JOIN T051BAENTIGENE ON A103ENTIRADI = A051CODIENTI
                LEFT JOIN T062BAESPEGENE ON A103ESPERADI = A062CODIESPE
                LEFT JOIN T052BAPROCGENE ON A103CODIPROC = A052CODIPROC
                WHERE A103LLAVPROC IN (:radicado)";
            $response = ConnectionModel::connectSQLServer()->prepare($query);
            $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function migrateGuardianshipModel($radicado, $process, $id_employee, $log_action, $log_detail, $id_court, $instance, $id_dossier_type) {
            try {
                $conn = ConnectionModel::connectMySQL();
                $conn->beginTransaction();

                $query = 
                    "INSERT INTO log (log_date, log_action, log_detail, id_log_type, id_employee) 
                    VALUES (DATE_FORMAT(NOW(),'%Y-%m-%d'), :log_action, :log_detail, 1, :id_employee)";
                $response = $conn->prepare($query);
                $response->bindParam(":log_action", $log_action, PDO::PARAM_STR);
                $response->bindParam(":log_detail", $log_detail, PDO::PARAM_STR);
                $response->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
                if ($response->execute()) {
                    foreach ($process as $key => $value) {
                        //DEMANDANTE - ACCIONANTE
                        if ($value['A112CODISUJE'] == '0001') {
                            $docdemandante = $value['A112NUMESUJE'];
                            $nomdemandante = $value['A112NOMBSUJE'];
                            $tipo_parte = "Accionante";
                        }
                        //DEMANDADO - ACCIONADO
                        if ($value['A112CODISUJE'] == '0002') {
                            $docdemandado = $value['A112NUMESUJE'];
                            $nomdemandado = $value['A112NOMBSUJE'];
                            $tipo_parte = "Accionado";
                        }

                        $query = 
                            "INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas, accionante_accionado_vinculado, esaccionante_accionado_vinculado) 
                            VALUES (:lastIdRadicado, :nombreparte, :tipo_parte)";
                        $response = $conn->prepare($query);
                        $response->bindParam(":lastIdRadicado", $lastIdRadicado, PDO::PARAM_INT);
                        $response->bindParam(":nombreparte", $value['A112NOMBSUJE'], PDO::PARAM_STR);
                        $response->bindParam(":tipo_parte", $tipo_parte, PDO::PARAM_STR);
                        $response->execute();
                    }

                    $query =
                        "INSERT INTO dossier_registration (id_employee, dossier_registration_date)
                        VALUES (:id_employee, NOW()";
                    $response = $conn->prepare($query);
                    $response->bindParam(":id_employee", $id_employee, PDO::PARAM_INT);
                    $response->execute();
                    $id_dossier_registration = $conn->lastInsertId();

                    // $query = 
                    //     "INSERT INTO dossier (radicado, instance, id_court_origin, id_defendant, id_plaintiff, id_dossier_registration, id_dossier_type, digital_dossier) 
                    //     VALUES (:radicado, :instance, :id_court, , , :id_dossier_registration, :id_dossier_type, )";
                    //     //  DATE_FORMAT(NOW(),'%Y-%m-%d'), 'Tutela'
                    // $response = $conn->prepare($query);
                    // $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
                    // $response->bindParam(":instance", $instance, PDO::PARAM_STR);
                    // $response->bindParam(":id_court", $id_court, PDO::PARAM_INT);
                    // $response->bindParam(":id_dossier_registration", $id_dossier_registration, PDO::PARAM_INT);
                    // $response->bindParam(":id_dossier_type", $id_dossier_type, PDO::PARAM_INT);

                    $query = 
                        "INSERT INTO ubicacion_expediente (idusuario, fecha, fecharegistrosistema, piso, idjuzgado,
                        radicado, demandante, cedula_demandante, demandado, cedula_demandado, idclase_proceso) 
                        VALUES (:idusuario, DATE_FORMAT(NOW(),'%Y-%m-%d'), DATE_FORMAT(NOW(),'%Y-%m-%d'), 4, :idjuzgado,
                        :radicado, :nomdemandante, :docdemandante, :nomdemandado, :docdemandado, 12)";
                    $response = $conn->prepare($query);
                    $response->bindParam(":idusuario", $id_usuario, PDO::PARAM_INT);
                    $response->bindParam(":idjuzgado", $idjuzgado, PDO::PARAM_INT);
                    $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
                    $response->bindParam(":nomdemandante", $nomdemandante, PDO::PARAM_STR);
                    $response->bindParam(":docdemandante", $docdemandante, PDO::PARAM_STR);
                    $response->bindParam(":nomdemandado", $nomdemandado, PDO::PARAM_STR);
                    $response->bindParam(":docdemandado", $docdemandado, PDO::PARAM_STR);
                    if ($response->execute()) {
                        $data = "ok";
                        $conn->commit();
                    } else {
                        $data = "error";
                    }
                } else {
                    $data = "error";
                }
                return $data;
                $response = null;
            } catch (Exception $e) {
                $conn->rollBack();
                echo $e->getMessage();
            }
        }
    }
?>