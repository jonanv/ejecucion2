<?php
    class LoginController extends LoginModel {
        public static function getLoginController($data) {
            if (isset($_POST["id_employee_login"]) && isset($_POST["password_login"])) {
                $id_employee_login = ConnectionModel::cleanChain($_POST['id_employee_login']);
                $password_login = ConnectionModel::cleanChain($_POST['password_login']);

                if (
                    preg_match('/^[a-zA-Z0-9*+.#$]+$/', $id_employee_login) &&
                    preg_match('/^[a-zA-Z0-9*+.#$]+$/', $password_login)
                ) {
                    $id_employee_login = str_replace('.', '', $id_employee_login);
                    $encriptar = LoginModel::encryption($password_login);

                    $data = array(
                        "id_employee_login" => $id_employee_login,
                        "password_login" => $encriptar,
                        "remember" => $data["remember"] // Es agregado aca para que sea tenido en cuenta abajo porque todo el data se reempleza aca con el que llega
                    );

                    $response = LoginModel::getLoginModel($data);

                    if (
                        $response["id_employee"] == str_replace('.', '', $_POST["id_employee_login"]) &&
                        $response["password"] == $encriptar
                    ) {
                        if ($response["enable_employee"] == 1) {
                            session_start();
                            $_SESSION["validate_sesion_ejecucion"] = "ok";
                            $_SESSION["id_employee"] = $response["id_employee"];
                            $_SESSION["firstname"] = $response["firstname"];
                            $_SESSION["lastname"] = $response["lastname"];
                            $_SESSION["email"] = $response["email"];
                            $_SESSION["id_job_title"] = $response["id_job_title"];
                            $_SESSION["id_profession"] = $response["id_profession"];
                            $_SESSION["id_profile"] = $response["id_profile"];
                            $_SESSION["enable_employee"] = $response["enable_employee"];
                            $_SESSION["employee_image"] = $response["employee_image"];
                            return $response;
                        } else {
                            return "usuario inactivo";
                        }
                    } else {
                        return "no coinciden credenciales";
                    }
                } else {
                    return "caracteres especiales";
                }
            }
        }
    }
