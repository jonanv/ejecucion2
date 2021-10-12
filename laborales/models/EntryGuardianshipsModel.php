<?php
    require_once "ConnectionModel.php";

    class EntryGuardianshipsModel {
        public static function getGuardianshipsOfDayModel() {
            date_default_timezone_set('America/Bogota');
		    $date = date('Y-m-d');

            // CONVERT(DATETIME, '$date', 121)

            $query = 
                "SELECT [A103LLAVPROC], [A103ANOTACTS], [A103FECHREPA], [A103HORAREPA]
                FROM [T103DAINFOPROC]
                WHERE [A103FECHREPA] = '2021-10-11'
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

        public static function getProcessInJusticiaModel($radicado) {
            $query = 
                "SELECT [A103CODICLAS], [A053DESCCLAS], [A103CODISUBC], [A071DESCSUBC],
                [A112LLAVPROC], [A112CODISUJE], [A112NUMESUJE], [A112NOMBSUJE], [A112FLAGDETE],
                [A057DESCSUJE], [A103ENTIRADI], [A051DESCENTI], [A103ESPERADI], [A062DESCESPE],
                [A103CODIPROC], [A052DESCPROC], [A103CODIPONE], [A103NOMBPONE]
                FROM [T103DAINFOPROC] 
                LEFT JOIN [T112DRSUJEPROC] ON A103LLAVPROC = A112LLAVPROC 
                LEFT JOIN [T057BASUJEGENE] ON A112CODISUJE = A057CODISUJE
                LEFT JOIN [T053BACLASGENE] ON A103CODICLAS = A053CODICLAS
                LEFT JOIN [T071BASUBCGENE] ON A103CODISUBC = A071CODISUBC
                LEFT JOIN [T051BAENTIGENE] ON A103ENTIRADI = A051CODIENTI
                LEFT JOIN [T062BAESPEGENE] ON A103ESPERADI = A062CODIESPE
                LEFT JOIN [T052BAPROCGENE] ON A103CODIPROC = A052CODIPROC
                WHERE [A103LLAVPROC] IN (:radicado)";
            $response = ConnectionModel::connectSQLServer()->prepare($query);
            $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
            if ($response->execute()) {
                $data = $response->fetch();
            } else {
                $data = "error";
            }
            return $data;
            $response = null;
        }

        public static function migrateGuardianshipModel($radicado, $process) {
            $zip_code = substr($radicado, 0, 5);
            $corporation = substr($radicado, 5, 2);
            $specialty = substr($radicado, 7, 2);
            $original_court = substr($radicado, 9, 2);
            $year = substr($radicado, 12, 4);
            $consecutive = substr($radicado, 16, 5);
            $instance = substr($radicado, 21, 2);

            date_default_timezone_set('America/Bogota');
		    $date = date('Y-m-d g:ia');
            $datehour = explode(" ", $date);
            $fechalog   = $datehour[0];
            $horalog    = $datehour[1];

            $idusuario = $_SESSION['idUsuario'];
            $accion  = "Se realiza Migracion de Tutela: " . $radicado;
            $detalle = $_SESSION['nombre'] . " " . $accion . " " . $fechalog . " " . "a las: " . $horalog;
            $tipolog = 1;

            if ($original_court == '001') {
                $idjuzgado = 15;
            }else if ($original_court == '002') {
                $idjuzgado = 16;
            }


            try {
                $conn = ConnectionModel::connectMySQL();
                $conn->beginTransaction();

                $query = 
                    "INSERT INTO log (fecha, accion, detalle, idusuario, idtipolog) 
                    VALUES (DATE_FORMAT(NOW(),'%Y-%m-%d'), :accion, :detalle, :idusuario, :tipolog)";
                $response = $conn->prepare($query);
                $response->bindParam(":accion", $accion, PDO::PARAM_STR);
                $response->bindParam(":detalle", $detalle, PDO::PARAM_STR);
                $response->bindParam(":idusuario", $idusuario, PDO::PARAM_STR);
                $response->bindParam(":tipolog", $tipolog, PDO::PARAM_STR);
                if ($response->execute()) {
                    $query = 
                        "INSERT INTO correspondencia_tutelas (radicado, idjuzgado, fecha, Tutela_Incidente) 
                        VALUES (:radicado, :idjuzgado, DATE_FORMAT(NOW(),'%Y-%m-%d'), 'Tutela')";
                    $response = $conn->prepare($query);
                    $response->bindParam(":radicado", $radicado, PDO::PARAM_STR);
                    $response->bindParam(":idjuzgado", $idjuzgado, PDO::PARAM_STR);
                    if ($response->execute()) {
                        $lastIdRadicado  = $conn->lastInsertId();
                    } else {
                        $date = "error";
                    }
                    
                    $data = $response->fetch();
                } else {
                    $data = "error";
                }
                $conn->commit();
                return $data;
                $response = null;
            } catch (Exception $e) {
                $conn->rollBack();
                echo $e->getMessage();
            }

            
        }

        // //MIGRAR TUTELA 7 DE JUNIO 2019
        // public function migrar_tutela_NV()
        // {


        //     $modelo = new caratulaModel();


        //     //SE OBTIENEN LOS DATOS
        //     $idusuario = $_SESSION['idUsuario'];

        //     $valorradicado   = trim($_GET['valorradicado']);

        //     $valorradicado_2 = substr($valorradicado, 0, 21);
        //     $valorradicado_3 = substr($valorradicado, 12, 4);
        //     $valorradicado_4 = substr($valorradicado, 16, 5);
        //     $valorradicado_5 = substr($valorradicado, 5, 2);
        //     $valorradicado_6 = substr($valorradicado, 7, 2);
        //     $valorradicado_7 = substr($valorradicado, 9, 3);


        //     //OBTENEMOS DEL RADICADO 17001610679920081111100
        //     //LA PARTE QUE ES EL NUMERO DEL JUZGADO 006
        //     $departamento  = substr($valorradicado, 0, 2);
        //     $municipio     = substr($valorradicado, 0, 5);


        //     $datospartes   = trim($_GET['datospartesXX']);


        //     $horaregistro  = $modelo->get_hora_actual_24horas();



        //     //DATOS PARA EL REGISTRO DEL LOG

        //     $fechahora  = $modelo->get_fecha_actual();
        //     $datosfecha = explode(" ", $fechahora);
        //     $fechalog   = $datosfecha[0];
        //     $horalog    = $datosfecha[1];


        //     $accion  = "Se realiza Migracion de Tutela: " . $valorradicado;

        //     $detalle = $_SESSION['nombre'] . " " . $accion . " " . $fechalog . " " . "a las: " . $horalog;
        //     $tipolog = 1;


        //     $error_transaccion   = 0; //variable para detectar error

        //     //PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION
        //     $datos_PARTEX_PROCESO = $modelo->get_datos_PROCESO_MIGRAR($valorradicado);

        //     if ($datos_PARTEX_PROCESO == 0) {


        //         if ($valorradicado_7 == '001') {
        //             $idjuzgado = 15;
        //         }

        //         if ($valorradicado_7 == '002') {
        //             $idjuzgado = 16;
        //         }



        //         try {


        //             $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //             //EMPIEZA LA TRANSACCION
        //             $this->db->beginTransaction();


        //             $this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
        //                             VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");



        //             $this->db->exec("INSERT INTO correspondencia_tutelas (radicado,idjuzgado,fecha,Tutela_Incidente) 
        //                             VALUES ('$valorradicado','$idjuzgado','$fechalog','Tutela')");


        //             //OBTENGO EL ULTIMO ID DEL ISNERT ANTERIOR
        //             $lastIdRadicado  = $this->db->lastInsertId();

        //             //PARTES


        //             //1 EXPLODE

        //             $datospartes_1A = explode("******", $datospartes);
        //             $longitud_1     = count($datospartes_1A);
        //             $i              = 0;

        //             while ($i < $longitud_1 - 1) {

        //                 //2 EXPLODE
        //                 $datospartes_1B = explode("//////", $datospartes_1A[$i]);

        //                 $tipo         = trim($datospartes_1B[0]);
        //                 $docidentidad = utf8_decode(trim($datospartes_1B[1]));
        //                 $nombreparte  = utf8_decode(trim(strtoupper($datospartes_1B[2])));


        //                 //DEMANDANTE - ACCIONANTE
        //                 if ($tipo == '0001') {

        //                     $docdemandante .= $docidentidad . "/";
        //                     $nomdemandante .= $nombreparte . "/";

        //                     $tipo_parte = "Accionante";
        //                 }
        //                 //DEMANDADO - ACCIONADO
        //                 if ($tipo == '0002') {

        //                     $docdemandado .= $docidentidad . "/";
        //                     $nomdemandado .= $nombreparte . "/";

        //                     $tipo_parte = "Accionado";
        //                 }



        //                 $this->db->exec("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) 
        //                                 VALUES ('$lastIdRadicado','$nombreparte','$tipo_parte')");



        //                 $i = $i + 1;
        //             }

        //             //QUITAR ULTIMO CARACTER DE LA CADENA
        //             //EJEMPLO:
        //             //JUAN SEBASTIAN - ALFONSO VANEGAS/
        //             //QUEDA
        //             //JUAN SEBASTIAN - ALFONSO VANEGAS
        //             $docdemandante = substr($docdemandante, 0, -1);
        //             $nomdemandante = substr($nomdemandante, 0, -1);

        //             $docdemandado = substr($docdemandado, 0, -1);
        //             $nomdemandado = substr($nomdemandado, 0, -1);


        //             $this->db->exec("INSERT INTO ubicacion_expediente (idusuario,fecha,fecharegistrosistema,piso,idjuzgado,
        //                             radicado,demandante,cedula_demandante,demandado,cedula_demandado,idclase_proceso) 
        //                             VALUES ('$idusuario','$fechalog','$fechalog',4,'$idjuzgado',
        //                             '$valorradicado','$nomdemandante','$docdemandante','$nomdemandado','$docdemandado',12)");



        //             //SE TERMINA LA TRANSACCION  
        //             $this->db->commit();


        //             echo '<script languaje="JavaScript"> 
                                
        //                         alert("PROCESO SE REALIZA CORRECTAMENTE");
                                            
        //                 </script>';
        //         } catch (Exception $e) {

        //             //NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
        //             $this->db->rollBack();


        //             echo '<script languaje="JavaScript"> 
                                        
        //                         var ERROR = "' . $e->getMessage() . '";
                                            
        //                         alert("ERROR AL REALIZAR EL PROCESO: "+ERROR);
                                        
        //                 </script>';

        //             //echo $i." Fallo: " . $e->getMessage();

        //         }
        //     } else {

        //         echo '<script languaje="JavaScript"> 
                                        
                                
        //                 alert("PROCESO YA EXISTE, NO ES POSIBLE SU MIGRACION");
                                        
        //             </script>';
        //     }
        // }
        
    }
?>