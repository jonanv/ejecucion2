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
                        $_SESSION["validate_sesion_laborales"] = "ok";
                        $_SESSION["id_employee"] = $response["id_employee"];
                        $_SESSION["firstname"] = $response["firstname"];
                        $_SESSION["lastname"] = $response["lastname"];
                        $_SESSION["email"] = $response["email"];
                        $_SESSION["id_job_title"] = $response["id_job_title"];
                        $_SESSION["id_profession"] = $response["id_profession"];
                        $_SESSION["id_profile"] = $response["id_profile"];
                        $_SESSION["enable_employee"] = $response["enable_employee"];
                        $_SESSION["employee_image"] = $response["employee_image"];

                        if ($data["remember"]) {
                            setcookie("id_employee_login", str_replace('.', '', $_POST["id_employee_login"]), time() + (60 * 60 * 24 * 30));
                            setcookie("password_login", $_POST["password_login"], time() + (60 * 60 * 24 * 30));
                        } else {
                            setcookie("id_employee_login", null);
                            setcookie("password_login", null);
                        }

                        // echo '<script>
                        //             window.location = "' . SERVERURL . '?route=admin";
                        //         </script>';
                        return $response;
                    } else {
                        // echo '<script>
                        //             Swal.fire({
                        //                 title: "¡ERROR AL INGRESAR!",
                        //                 text: "¡Por favor revise que el usuario o la contraseña coincida con la registrada!",
                        //                 icon: "error",
                        //                 confirmButtonText: "Cerrar",
                        //                 confirmButtonColor: "#3085d6",
                        //                 allowOutsideClick: false,
                        //                 showCloseButton: false
                        //             }).then((result) => {
                        //                 if (result.isConfirmed) {
                        //                     history.back();
                        //                 }
                        //             });
                        //         </script>';
                    }
                } else {
                    // echo '<script> 
                    //             Swal.fire({
                    //                 title: "¡ERROR!",
                    //                 text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
                    //                 icon: "error",
                    //                 confirmButtonText: "Cerrar",
                    //                 confirmButtonColor: "#3085d6",
                    //                 allowOutsideClick: false,
                    //                 showCloseButton: false
                    //             }).then((result) => {
                    //                 if (result.isConfirmed) {
                    //                     history.back();
                    //                 }
                    //             });
                    //         </script>';
                }
            }
        }
    }
