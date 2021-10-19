<?php
    require_once "ConnectionModel.php";
    class LoginModel extends ConnectionModel {
        public static function getLoginModel($data) {
            if ($data['id_employee_login'] != null && $data['password_login'] != null) {
                $query = 
                    "SELECT usuario.id, usuario.nombre_usuario, usuario.idperfil, usuario.empleado, usuario.contrasena, 
                    perfil.nombre, usuario.foto, usuario.tipo_perfil, usuario.pantalla, usuario.ingreso, 
                    usuario.id_juzgado, usuario.tipousuario, usuario.ipplataforma
                    FROM pa_usuario AS usuario
                    INNER JOIN pa_perfil AS perfil
                    ON (usuario.idperfil = perfil.id)
                    WHERE usuario.nombre_usuario = :id_employee_login 
                    AND usuario.contrasena = :password_login
					AND ingreso_activo = 1";
                $response = ConnectionModel::connectMySQL()->prepare($query);
                $response->bindParam(":id_employee_login", $data['id_employee_login'], PDO::PARAM_STR);
                $response->bindParam(":password_login", $data['password_login'], PDO::PARAM_STR);
                if ($response->execute()) {
                    $data = $response->fetch();
                } else {
                    $data = "error";
                }
                return $data;
            }
            $response = null;
        }
    }
