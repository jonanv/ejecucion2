<?php

    class ConnectionModel {
        public static function connectMySQL() {
            $link = new PDO(
                "mysql:host=" . $_ENV["host"] . ";dbname=" . $_ENV["db"] . "",
                "" . $_ENV["user"] . "",
                "" . $_ENV["pass"] . "",
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                )
            );
            return $link;
        }

        // $serverName = "ServerName";
        public static function connectSQLServer() {
            $serverName = $_ENV['serverName'];
            $connectionInfo = array(
                "UID" => $_ENV['uid'],
                "PWD" => $_ENV['pwd'],
                "Database" => $_ENV['databaseName']
            );

            /* Connect using SQL Server Authentication. */
            $conn = sqlsrv_connect($serverName, $connectionInfo);
            return $conn;
        }
    }
