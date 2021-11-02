<?php
    require_once "ConnectionModel.php";
    class LoginModel extends ConnectionModel {
        public static function getLoginModel($data) {
            if ($data['id_employee_login'] != null && $data['password_login'] != null) {
                $query = 
                    "SELECT * FROM employee 
                    WHERE id_employee = :id_employee
                    AND password = :password";
                $response = ConnectionModel::connectMySQL()->prepare($query);
                $response->bindParam(":id_employee", $data['id_employee_login'], PDO::PARAM_STR);
                $response->bindParam(':password', $data['password_login'], PDO::PARAM_STR);
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
