<?php
    class LoginController extends LoginModel {
        public static function getLoginController() {
            if (isset($_POST["id_employee_login"]) && isset($_POST["password_login"])) {
                $id_employee_login = ConnectionModel::cleanChain($_POST['id_employee_login']);
                $password_login = ConnectionModel::cleanChain($_POST['password_login']);

                if (
                    preg_match('/^[a-zA-Z0-9*+.#$]+$/', $id_employee_login) &&
                    preg_match('/^[a-zA-Z0-9*+.#$]+$/', $password_login)
                ) {
                    $id_employee_login = str_replace('.', '', $id_employee_login);
                    // $encriptar = LoginModel::encryption($password_login);
                    $encriptar = md5($password_login);

                    $data = array(
                        "id_employee_login" => $id_employee_login,
                        "password_login" => $encriptar
                    );

                    $response = LoginModel::getLoginModel($data);

                    if (
                        $response["nombre_usuario"] == $id_employee_login &&
                        $response["contrasena"] == $encriptar
                    ) {
                        $_SESSION["validate_sesion"] = "ok";
                        $_SESSION['id'] = $response['usua_perfil'];
                        $_SESSION['nombre'] = $response['usua_empleado'];
                        $_SESSION['idUsuario'] = $response['usua_id'];
                        $_SESSION['nomusu'] = $response['usua_nom'];
                        $_SESSION['foto'] = $response['foto'];
                        $_SESSION['tipo_perfil'] = $response['tipo_perfil'];
                        $_SESSION['pantalla'] = $response['pantalla'];
                        $_SESSION['ingreso'] = $response['estado'];
                        $_SESSION['id_juzgado'] = $response['id_juzgado'];
                        $_SESSION['tipousuario'] = $response['tipousuario'];
                        $_SESSION['ipplataforma'] = $response['ipplataforma'];

                        if (isset($_POST["remember"])) {
                            setcookie("nombre_usuario", str_replace('.', '', $_POST["id_employee_login"]), time() + (60 * 60 * 24 * 30));
                            setcookie("contrasena", $_POST["password_login"], time() + (60 * 60 * 24 * 30));
                        } else {
                            setcookie("nombre_usuario", null);
                            setcookie("contrasena", null);
                        }

                        echo '<script>
                                    window.location = "' . SERVERURL . '?route=admin";
                                </script>';
                        // return $response;
                    } else {
                        echo '<script>
                                    Swal.fire({
                                        title: "¡ERROR AL INGRESAR!",
                                        text: "¡Por favor revise que el usuario o la contraseña coincida con la registrada!",
                                        icon: "error",
                                        confirmButtonText: "Cerrar",
                                        confirmButtonColor: "#3085d6",
                                        allowOutsideClick: false,
                                        showCloseButton: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            history.back();
                                        }
                                    });
                                </script>';
                    }
                } else {
                    echo '<script> 
                                Swal.fire({
                                    title: "¡ERROR!",
                                    text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
                                    icon: "error",
                                    confirmButtonText: "Cerrar",
                                    confirmButtonColor: "#3085d6",
                                    allowOutsideClick: false,
                                    showCloseButton: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        history.back();
                                    }
                                });
                            </script>';
                }
            }
        }
    }
