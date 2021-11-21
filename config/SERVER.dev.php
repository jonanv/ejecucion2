<?php
    const METHOD = "AES-256-CBC";
    const SECRET_KEY = '$EJECUCION@2021';
    const SECRET_IV = '037970';

    $enviroment = "dev";
    // $enviroment = "prod";

    if ($enviroment == "dev") {
        // base de datos
        // MAC
        // $_ENV["host"] = 'localhost';
        // $_ENV["db"] = 'ejecucion2';
        // $_ENV["user"] = 'root';
        // $_ENV["pass"] = 'admin';
        // $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // WINDOWS MySQL
        $_ENV["host"] = 'localhost';
        $_ENV["db"] = 'ejecucion2';
        $_ENV["user"] = 'root';
        $_ENV["pass"] = 'Ejecuc10n2014';
        $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // WINDOWS SQLServer
        // $_ENV['serverName'] = 'C07003-OF13319\SQLEXPRESS'; // serverName\instanceName
        // $_ENV['uid'] = 'sa';
        // $_ENV['pwd'] = 'Ejecuc10n2014';
        // $_ENV['databaseName'] = 'consejoPN';

        // WINDOWS SQLServer - ramajudicial
        $_ENV['serverName'] = '192.168.89.20'; // serverName\instanceName
        $_ENV['uid'] = 'usuariooecm';
        $_ENV['pwd'] = 'OficinaECM';
        $_ENV['databaseName'] = 'consejoPN';
    } else {
        // SERVIDOR - naufragodev
        // $_ENV["host"] = 'localhost';
        // $_ENV["db"] = 'naufrago_ejecucion';
        // $_ENV["user"] = 'naufrago_admin';
        // $_ENV["pass"] = 'Sasuke54462$j';
        // $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // SERVIDOR - ramajudicial
        $_ENV["host"] = 'localhost';
        $_ENV["db"] = 'ejecucion2';
        $_ENV["user"] = 'ejecucion2021';
        $_ENV["pass"] = 'Ejecuc10n2014';
        $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // SERVIDOR SQLServer - ramajudicial
        $_ENV['serverName'] = '192.168.89.20'; // serverName\instanceName
        $_ENV['uid'] = 'usuariooecm';
        $_ENV['pwd'] = 'OficinaECM';
        $_ENV['databaseName'] = 'consejoPN';
    }