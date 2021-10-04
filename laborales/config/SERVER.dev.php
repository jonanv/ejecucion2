<?php
    const METHOD = "AES-256-CBC";
    const SECRET_KEY = '$LABORALES@2021';
    const SECRET_IV = '037970';

    $enviroment = "dev";
    // $enviroment = "prod";

    if ($enviroment == "dev") {
        // base de datos
        // MAC
        // $_ENV["host"] = 'localhost';
        // $_ENV["db"] = 'laborales';
        // $_ENV["user"] = 'root';
        // $_ENV["pass"] = 'admin';
        // $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // WINDOWS
        $_ENV["host"] = 'localhost';
        $_ENV["db"] = 'laborales';
        $_ENV["user"] = 'root';
        $_ENV["pass"] = 'Ejecuc10n2014';
        $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
    } else {
        // SERVIDOR - naufragodev
        // $_ENV["host"] = 'localhost';
        // $_ENV["db"] = 'naufrago_laborales';
        // $_ENV["user"] = 'naufrago_admin';
        // $_ENV["pass"] = 'Sasuke54462$j';
        // $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';

        // SERVIDOR - ramajudicial
        $_ENV["host"] = 'localhost';
        $_ENV["db"] = 'laborales';
        $_ENV["user"] = 'laborales2021';
        $_ENV["pass"] = 'Ejecuc10n2014';
        $_ENV["cripter"] = '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$';
    }