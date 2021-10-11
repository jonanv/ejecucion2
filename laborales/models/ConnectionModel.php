<?php

    class ConnectionModel {
        public static function connectMySQL() {
            try {
                $link = new PDO(
                    "mysql:host=" . $_ENV["host"] . ";dbname=" . $_ENV["db"] . "",
                    "" . $_ENV["user"] . "",
                    "" . $_ENV["pass"] . "",
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    )
                );
                // echo "Connected successfully";
                return $link;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        // $serverName = "ServerName";
        public static function connectSQLServer() {
            // $serverName = $_ENV['serverName'];
            // $connectionInfo = array(
            //     "UID" => $_ENV['uid'],
            //     "PWD" => $_ENV['pwd'],
            //     "Database" => $_ENV['databaseName']
            // );

            // /* Connect using SQL Server Authentication. */
            // $conn = sqlsrv_connect($serverName, $connectionInfo);

            // $params = array();
			// $options =  array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			// $stmt = sqlsrv_query($conn, $sql, $params, $options);
            // return $conn;

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
