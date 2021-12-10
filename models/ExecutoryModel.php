<?php
    require_once "ConnectionModel.php";

    class ExecutoryModel {
        public static function getDossierModel($radicado) {
            $query = 
                "SELECT d.*,
                co.id_court AS id_court_origin, co.court_name AS court_origin_name, 
                cd.id_court AS id_court_destination, cd.court_name AS court_destination_name, 
                dt.*, e.*
                FROM dossier AS d
                INNER JOIN court AS co ON (co.id_court = d.id_court_origin)
                INNER JOIN court AS cd ON (cd.id_court = d.id_court_destination)
                INNER JOIN dossier_type AS dt ON (dt.id_dossier_type = d.id_dossier_type)
                -- INNER JOIN location_dossier AS ld ON (ld.id_location_dossier = d.id_location_dossier)
                INNER JOIN employee AS e ON (e.id_employee = d.id_employee_registered)
                WHERE radicado = :radicado";
                // TODO: Hacer la consulta para que devuelva el expediente con juzgado de destino vacio y si tiene dato
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

        public static function getAllAnnotationTypesModel() {
            $query = 
                "SELECT * 
                FROM annotation_type";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getAllEmployeesModel() {
            $query = 
                "SELECT * 
                FROM employee 
                WHERE enable_employee = true";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getAllPlaintiffsOfDossierModel($id_dossier) {
            $query = 
                "SELECT pla.*
                FROM plaintiff AS pla
                INNER JOIN dossier_plaintiff AS dp ON (dp.id_plaintiff = pla.id_plaintiff)
                INNER JOIN dossier AS d ON (d.id_dossier = dp.id_dossier)
                WHERE d.id_dossier = :id_dossier";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            $response->bindParam(":id_dossier", $id_dossier, PDO::PARAM_INT);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getAllDefendantsOfDossierModel($id_dossier) {
            $query = 
                "SELECT def.*
                FROM defendant AS def
                INNER JOIN dossier_defendant AS dp ON (dp.id_defendant = def.id_defendant)
                INNER JOIN dossier AS d ON (d.id_dossier = dp.id_dossier)
                WHERE d.id_dossier = :id_dossier";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            $response->bindParam(":id_dossier", $id_dossier, PDO::PARAM_INT);
            if ($response->execute()) {
                $data = $response->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function getLastDossierAnnotationModel($id_dossier) {
            $query = 
                "SELECT *
                FROM dossier_annotation AS da
                INNER JOIN dossier AS d ON (d.id_dossier = da.id_dossier)
                INNER JOIN employee AS e ON (e.id_employee = da.id_employee)
                INNER JOIN annotation_type AS at ON (at.id_annotation_type = da.id_annotation_type)
                WHERE da.id_dossier = :id_dossier
                ORDER BY da.dossier_annotation_date DESC";
            $response = ConnectionModel::connectMySQL()->prepare($query);
            $response->bindParam(":id_dossier", $id_dossier, PDO::PARAM_INT);
            if ($response->execute()) {
                $data = $response->fetch();
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function registerExecutoryModel($radicados_executory_list, $id_usuario, $nombre_usuario) {
            return $radicados_executory_list;

            $accion  = "Se realiza registro de Ejecutoria en el sistema (SIEPRO)";
            $detalle = $nombre_usuario . " realiza registro de Ejecutoria en el sistema (SIEPRO) " . " " . date('Y-m-d') . " " . "a las: " . date('h:i:sa');
            $tipolog = 1;
            
            try {
                $conn = ConnectionModel::connectMySQL();
                $conn->beginTransaction();

                // TODO: Metodo repetido en otro modelo, revisar si es posible sacarlo de la transaccion, es posible que sea privado para cada modelo de forma general
                $query = 
                        "INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) 
                        VALUES (DATE_FORMAT(NOW(),'%Y-%m-%d'), :accion, :detalle, :idusuario, :tipolog)";
                $response = $conn->prepare($query);
                $response->bindParam(":accion", $accion, PDO::PARAM_STR);
                $response->bindParam(":detalle", $detalle, PDO::PARAM_STR);
                $response->bindParam(":idusuario", $id_usuario, PDO::PARAM_INT);
                $response->bindParam(":tipolog", $tipolog, PDO::PARAM_INT);
                if ($response->execute()) {

                    foreach ($radicados_executory_list as $key => $value) {
                        $id_radicado = $value['id_radicado'];
                        $radicado = $value['radicado'];
                        $observation = $value['observation'];

                        //PARA AUDIENCIA
                        $date_audience = $value[''];
                        $hour_audience = $value[''];
                        $observation_audience = $value[''];

                        //SI VA PARA DESPACHO
                        $to_dispatch = $value[''];



                        $idradicado2 = $datospartes_2[0];
                        $radi        = $datospartes_2[1];
                        $obser       = utf8_decode($datospartes_2[2]);
                        
                        
                        $fechaaudi = $datospartes_2[8];
                        $horaaudi  = $datospartes_2[9];
                        $obsaudi   = utf8_decode($datospartes_2[10]);
                        
                        $a_despacho = $datospartes_2[11];

                        if ($date_audience == "SIN TRAMITE" && 
                            $hour_audience == "SIN TRAMITE" && 
                            $observation_audience == "SIN TRAMITE" ) {
    
                            $query = 
                                "INSERT INTO detalle_correspondencia (idcorrespondencia, fecha, observacion, estadoobs, a_despacho, idusuario) 
                                VALUES(:id_radicado, :date, :observation, 0, :to_dispatch, :idusuario)";
                            $response = $conn->prepare($query);
                            $response->bindParam(":id_radicado", $id_radicado, PDO::PARAM_STR);
                            $response->bindParam(":date", $date, PDO::PARAM_STR);
                            $response->bindParam(":observation", $observation, PDO::PARAM_STR);
                            $response->bindParam(":to_dispatch", $to_dispatch, PDO::PARAM_STR);
                            $response->bindParam(":idusuario", $id_usuario, PDO::PARAM_INT);
                        } else {
                            //SE SELECCIONO DE LA LISTA 'OBSERVACION' AUDIENCIA
                            $obser = $observation . ", FECHA:" . $date_audience . ", HORA:" . $hour_audience . ", " . $observation_audience;
                            $query = 
                                "INSERT INTO detalle_correspondencia (idcorrespondencia, fecha, observacion, fechaaudi, horaaudi, obsaudi, siaudi, idusuario) 
                                VALUES(:id_radicado, :date, :observation, :date_audience, :hour_audience, :observation_audience, 1, :idusuario)";
                            $response = $conn->prepare($query);
                            $response->bindParam(":id_radicado", $id_radicado, PDO::PARAM_STR);
                            $response->bindParam(":date", $date, PDO::PARAM_STR);
                            $response->bindParam(":observation", $obser, PDO::PARAM_STR);
                            $response->bindParam(":date_audience", $date_audience, PDO::PARAM_STR);
                            $response->bindParam(":hour_audience", $hour_audience, PDO::PARAM_STR);
                            $response->bindParam(":observation_audience", $observation_audience, PDO::PARAM_STR);
                            $response->bindParam(":idusuario", $id_usuario, PDO::PARAM_INT);
                            $response->execute();
    
                            $query = 
                                "INSERT INTO siepro_audiencia (idradicado, fechaaudi, horaaudi, obsaudi, fecharegistro, idusuario) 
                                VALUES(:id_radicado, :date_audience, :hour_audience, :observation_audience, DATE_FORMAT(NOW(),'%Y-%m-%d'), :idusuario)";
                            $response = $conn->prepare($query);
                            $response->bindParam(":id_radicado", $id_radicado, PDO::PARAM_STR);
                            $response->bindParam(":date_audience", $date_audience, PDO::PARAM_STR);
                            $response->bindParam(":hour_audience", $hour_audience, PDO::PARAM_STR);
                            $response->bindParam(":observation_audience", $observation_audience, PDO::PARAM_STR);
                            $response->bindParam(":idusuario", $id_usuario, PDO::PARAM_INT);
                            $response->execute();
                        }

                        $actu_accion      = $datospartes_2[3];
                        $actu_fechai      = $datospartes_2[4];
                        $actu_dias        = $datospartes_2[5];
                        $actu_fechaf      = $datospartes_2[6];
                        $actu_asignadoa   = $datospartes_2[7];
                        
                        $observation = $value['observation'];
                        $start_date = $value['start_date'];
                        $days = $value['days'];
                        $end_date = $value['end_date'];
                        $assigned_to = $value['assigned_to'];
                        
                        if ($observation == "SIN TRAMITE" && 
                            $start_date == "SIN TRAMITE" && 
                            $days == "SIN TRAMITE" && 
                            $end_date == "SIN TRAMITE" && 
                            $assigned_to == "SIN TRAMITE" ) {
                            $bandera = 0;
                        }
                        else{
                        
                            
                            $internal_action = explode("-",$datospartes_2[3]);
                            $id_internal_accion = $internal_action[0];
                            $description_internal_action = utf8_decode($internal_action[1]);
                            
                            
                            $actu_asignadoa    = explode("-",$datospartes_2[7]);
                            $id_actu_asignadoa = $actu_asignadoa[0];
                            $asignadoaccionA   = $actu_asignadoa[1];
                            
                            $description_action_B = "TRAMITE INTERNO DE PROCESO, FECHA INICIAL: " . $actu_fechai . " DIAS: " . $actu_dias . " FECHA FINAL: " . $actu_fechaf .
                                        ", TRAMITE: " . $description_internal_action . ", ASIGNADO A: " . $asignadoaccionA;
                                        
                                        
                            $query = 
                                "INSERT INTO detalle_correspondencia(idcorrespondencia,fecha,observacion,idusuario)
                                VALUES ('$idradicado2','$fecharegistro','$description_action_B','$idusuario')";
                            $response = $conn->prepare($query);
                                            
                            
                            $query = 
                                "INSERT INTO actuacion_expediente (idusuario,actu_radicado,actu_accion,actu_fechai,actu_dias,actu_fechaf,actu_asignadoa) 
                                VALUES ('$idusuario','$idradicado2','$id_internal_accion','$actu_fechai','$actu_dias','$actu_fechaf','$id_actu_asignadoa')";
                            $response = $conn->prepare($query);				 			   
                        
                            
                            $query = 
                                "INSERT INTO actuacion_expediente_historial (idusuario,actu_radicado,actu_accion,actu_fechai,actu_dias,actu_fechaf,actu_asignadoa) 
                                VALUES ('$idusuario','$idradicado2','$id_internal_accion','$actu_fechai','$actu_dias','$actu_fechaf','$id_actu_asignadoa')";
                            $response = $conn->prepare($query);
                        
                        }
                    }






                    $data = "ok";
                    $conn->commit();
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