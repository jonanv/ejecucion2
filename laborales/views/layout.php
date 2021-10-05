<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIEPRO Laborales</title>

    <?php include "./views/shared/styles.php"; ?>
</head>

<body class="hold-transition sidebar-collapse layout-fixed layout-top-nav">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <div class="spinner-border text-dark fa-2x" role="status" style="width: 3rem; height: 3rem;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

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

    <?php include "./views/shared/scripts.php"; ?>
</body>

</html>