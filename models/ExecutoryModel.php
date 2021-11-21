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
                FROM siepro_pa_observaciones 
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

        public static function registerExecutoryModel($radicados_executory_list, $id_usuario, $nombre_usuario) {
            return $radicados_executory_list;

            $accion  = "Se realiza registro de Ejecutoria en el sistema (SIEPRO)";
            $detalle = $nombre_usuario . " realiza registro de Ejecutoria en el sistema (SIEPRO) " . " " . date('Y-m-d') . " " . "a las: " . date('h:i:sa');
            $tipolog = 1;
            
            try {
                $conn = ConnectionModel::connectMySQL();
                $conn->beginTransaction();

                // TODO: Metodo repetido en otro modelo, revisar si es posible sacarlo de la transaccion
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