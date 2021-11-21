<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIEPRO Laborales</title>

    <?php include "./views/shared/styles.php"; ?>
</head>

<body class="hold-transition sidebar-collapse layout-fixed layout-top-nav">

    <?php include "./views/shared/loading.php"; ?>

    <?php
        require_once "./controllers/ViewsController.php";
        $view = new ViewsController();
        $viewResponse = $view->getViewController();

        if ($viewResponse == "index") {
            require_once "./views/pages/login.php";
        } elseif ($viewResponse == "login") {
            require_once "./views/pages/login.php";
        } elseif ($viewResponse == "forgot-password") {
            require_once "./views/pages/forgot-password.php";
        } elseif ($viewResponse == "recover-password") {
            require_once "./views/pages/recover-password.php";
        } elseif ($viewResponse == "404") {
            require_once "./views/pages/404.php";
        } else {
    ?>
            <!-- Wrapper -->
            <div class="wrapper">
                <?php 
                include "./views/shared/header.php"; 
                include "./views/shared/menu.php";
                include "./views/shared/content-wrapper.php";
                include "./views/shared/footer.php";
                ?>
            </div>
            <!-- ./wrapper -->
    <?php 
        } 
    ?>

    <?php include "./views/shared/scripts.php"; ?>
</body>

</html>