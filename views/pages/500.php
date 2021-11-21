<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>500 Error de página</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <?php if (isset($_SESSION["id_job_title"]) && $_SESSION["id_job_title"] == 1) { ?>
                    <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>?route=admin">Inicio</a></li>
                    <?php } else { ?>
                    <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>">Inicio</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active">500 Error de página</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content page-500">
    
    <div class="error-page">
        <h2 class="headline text-danger">500</h2>

        <div class="error-content">
            <h3>
                <i class="fas fa-exclamation-triangle text-danger"></i> ¡Oops! Algo salió mal.
            </h3>
            <p>
                No hemos podido encontrar la página que buscaba. 
                Mientras tanto, puede volver al 
                <a href="<?php echo SERVERURL ?>">panel de control</a>.
            </p>
        </div>
    </div>
    <!-- /.error-page -->

</section>
<!-- /.content -->