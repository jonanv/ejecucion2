<!-- Content Header (Page header) -->
<section class="content-header header-404">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <div class="col-sm-6">
                <h1>404 Error de página</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <?php if (isset($_SESSION["id_job_title"]) && $_SESSION["id_job_title"] == 1) { ?>
                    <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>?route=admin">Inicio</a></li>
                    <?php } else { ?>
                    <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>">Inicio</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active">404 Error de página</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content page-404">
    
    <div class="error-page">
        <h2 class="headline text-warning">404</h2>

        <div class="error-content">
            <h3>
                <i class="fas fa-exclamation-triangle text-warning"></i> ¡Oops! Página no encontrada.
            </h3>
            <p>
                No hemos podido encontrar la página que buscaba. 
                Mientras tanto, puede volver al 
                <a href="<?php echo SERVERURL ?>">panel de control</a>.
            </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<!-- /.content -->