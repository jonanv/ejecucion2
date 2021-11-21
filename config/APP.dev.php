<?php
    // Rutal local
    // const SERVERURL = "http://localhost:8888/ejecucion2/"; // MAC
    const SERVERURL = "http://localhost/ejecucion2/"; // WINDOWS

    // Ruta del servidor
    // const SERVERURL = "https://ejecucion.naufragodev.com.co/"; // SERVER NAUFRAGO
    // const SERVERURL = "http://190.217.24.24/ejecucion/"; // SERVER RAMAJUDICIAL
    const COMPANY   = "SIEPRO ejecucion";
    date_default_timezone_set("America/Bogota");
    // Server settings
    const CHARSET = 'UTF-8';
    const SMTP_DEBUG = 0;                       // Enable verbose debug output
    const HOST = 'smtp.gmail.com';              // Set the SMTP server to send through
    const SMTP_AUTH = true;                     // Enable SMTP authentication
    const USERNAME = 'ofejcmma@gmail.com';      // SMTP username
    const PASSWORD = '1053784743';              // SMTP password
    const USERNAME_DESCRIPTION = 'Oficina de Ejecución Civil Municial de Manizales';
    const SMTP_SECURE = 'TLS';                  // Enable implicit TLS encryption
    const PORT = 587;                           // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
