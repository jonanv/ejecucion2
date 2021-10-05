<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Entrada de tutelas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>?route=admin">Inicio</a></li>
                        <li class="breadcrumb-item active">Entrada de tutelas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <!-- Small boxes (Stat box) -->

            <div class="">

                <div class="card">
                    <div class="card-header bg-secondary">
                        Filtrar proceso
                    </div>
                    <div class="card-body">
                        <form class="was-validated" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Fecha inicial</label>
                                    <input type="text" class="form-control is-valid" id="dateStart" required>
                                    <div class="invalid-feedback">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar nombre completo</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Fecha final</label>
                                    <input type="text" class="form-control" id="dateEnd">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Radicado</label>
                                <input type="number" class="form-control" id="radicado" placeholder="Radicado" min="0">
                            </div>
                            <button type="submit" class="btn btn-primary">Consultar</button>
                            <button type="button" class="btn btn-primary">Limpiar</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->