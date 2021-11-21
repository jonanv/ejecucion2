<?php
    // Config
    require_once "./config/APP.php";
    require_once "./config/SERVER.php";

    // Models
    require_once "./models/LoginModel.php";
    
    // Controllers
    require_once "./controllers/LayoutController.php";
    require_once "./controllers/LoginController.php";

    $layout = new LayoutController();
    $layout->getLayoutController();