<?php

    class ConnectionModel {
        public static function connectMySQL() {
            try {
                $conn = new PDO(
                    "mysql:host=" . $_ENV["host"] . ";dbname=" . $_ENV["db"] . "",
                    "" . $_ENV["user"] . "",
                    "" . $_ENV["pass"] . "",
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    )
                );
                // echo "Connected successfully";
                return $conn;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public static function connectSQLServer() {
            try {
                $conn = new PDO( "sqlsrv:Server=" . $_ENV['serverName'] . ";Database=" . $_ENV['databaseName'] . "",
                    "" . $_ENV['uid'] . "", 
                    "" . $_ENV['pwd'] . ""
                );
                // echo "Connected successfully";
                return $conn;
            } catch (PDOException $e) {
                echo "Drivers disponiveis: " . implode( ",", PDO::getAvailableDrivers() );
                echo "\nError: " . $e->getMessage();
                exit;
            }
        }
    }
