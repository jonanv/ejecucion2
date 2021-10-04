<?php
    // Config
    require_once "./config/APP.php";
    require_once "./config/SERVER.php";

    // Models
    
    // Controllers
    require_once "./controllers/LayoutController.php";

    $layout = new LayoutController();
    $layout->getLayoutController();