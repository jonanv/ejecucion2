<?php

    class ConnectionModel {
        // Conexion a la base de datos MySQL
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

        // Conexion a la base de datos SQLServer
        public static function connectSQLServer() {
            try {
                $conn = new PDO(
                    // SQLServer Window
                    // "sqlsrv:Server=" . $_ENV['serverName'] . ";Database=" . $_ENV['databaseName'] . "",
                    // "" . $_ENV['uid'] . "", 
                    // "" . $_ENV['pwd'] . ""

                    // MySQL MAC
                    "mysql:host=" . $_ENV["serverName"] . ";dbname=" . $_ENV["databaseName"] . "",
                    "" . $_ENV["uid"] . "",
                    "" . $_ENV["pwd"] . "",
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    )
                );
                // echo "Connected successfully";
                return $conn;
            } catch (PDOException $e) {
                // echo "Drivers disponiveis: " . implode( ",", PDO::getAvailableDrivers() );
                // echo "\nError: " . $e->getMessage();
                // exit;
                echo "Connection failed: " . $e->getMessage();
            }
        }

        // Encripta el string
		public static function encryption($string) {
			// Habiliar el extension=php_openssl.dll en php.ini
			$output  =  FALSE;
			$key = hash('sha256', SECRET_KEY);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output = base64_encode($output);
			return $output;
		}

		// Desencripta el string
		public static function decryption($string) {
			$key = hash('sha256', SECRET_KEY);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}

		// Limpia la cadena de ataques sql injection
		protected static function cleanChain($string) {
			$string = trim($string);
			$string = stripslashes($string);
			$string = str_ireplace("<script>", "", $string);
			$string = str_ireplace("</script>", "", $string);
			$string = str_ireplace("<script src", "", $string);
			$string = str_ireplace("<script type=", "", $string);
			$string = str_ireplace("SELECT * FROM", "", $string);
			$string = str_ireplace("DELETE FROM", "", $string);
			$string = str_ireplace("INSERT INTO", "", $string);
			$string = str_ireplace("--", "", $string);
			$string = str_ireplace("^", "", $string);
			$string = str_ireplace("[", "", $string);
			$string = str_ireplace("]", "", $string);
			$string = str_ireplace("==", "", $string);
			$string = str_ireplace(";", "", $string);
			return $string;
		}
    }
