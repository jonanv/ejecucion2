<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"
    id="app-entry-guardianships">
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

            <div class="column">

                <div class="card">
                    <div class="card-header bg-secondary">
                        FILTRAR PROCESO
                    </div>
                    <div class="card-body">
                        <form class="was-validated" 
                            autocomplete="off"
                            novalidate
                            v-on:submit.prevent>

                            <!-- <input v-model="$v.text.$model" 
                                :class="status($v.text)">
                            <pre>{{ $v }}</pre> -->

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="startDate">Fecha inicial</label>
                                    <div class="input-group date"
                                        id="startdate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                data-target="#startdate_datepicker" 
                                                data-toggle="datetimepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 'text-danger': $v.startDate.$invalid,  'text-success': !$v.startDate.$invalid }"
                                                >
                                                <!-- [class.text-danger]="getNameHolder"
                                                [class.text-success]="f.nameHolder?.valid" -->
                                                </i>
                                            </span>
                                        </div>
                                        <!--  type="text"
                                            class="form-control datetimepicker-input" 
                                            id="startDate" 
                                            placeholder="Fecha inicial"
                                            required
                                            data-inputmask-alias="datetime" 
                                            data-inputmask-inputformat="dd/mm/yyyy" 
                                            data-mask -->
                                        <input 
                                            type="text"
                                            class="form-control" 
                                            id="startDate" 
                                            placeholder="Fecha inicial"
                                            required
                                            minlength="5"
                                            data-target="#startdate_datepicker"
                                            v-model="$v.startDate.$model" 
                                            v-bind:class="status($v.startDate)"
                                            >
                                            <!-- v-bind:class="status($v.startDate)" -->
                                            <!-- v-bind:class="{ 'is-invalid': $v.startDate.$invalid, 'is-valid': !$v.startDate.$invalid }" -->
                                    </div>
                                    <div class="mt-0"
                                        v-if="$v.startDate.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar fecha inicial</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group col-md-6">
                                    <label for="inputPassword4">Fecha final</label>
                                    <input type="text" 
                                        class="form-control" 
                                        id="endDate"
                                        placeholder="Fecha inicial"
                                        required>
                                </div> -->
                                
                            </div>

                            <!-- <div class="form-group">
                                <label for="inputAddress">Radicado</label>
                                <input type="number" 
                                    class="form-control" 
                                    id="radicado" 
                                    placeholder="Radicado" 
                                    min="0"
                                    required>
                            </div> -->

                            <button type="submit" 
                                class="btn btn-primary"
                                @click="btnConsultRadicado();">
                                Consultar
                            </button>
                            <button type="button" class="btn btn-primary">Limpiar</button>

                        </form>

                        <pre>{{ $v }}</pre>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <table id="table_datatable" 
                            class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">ID</th>
                                    <th>Estado</th>
                                    <th>Radicado</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Migrar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>NO MIGRADA</td>
                                    <td>17001310500320210045700</td>
                                    <td>2021-10-06</td>
                                    <td>08:23</td>
                                    <td>
                                        <button class="btn btn-primary btn-block" 
                                            type="button">
                                            <i class="fas fa-cloud-download-alt"></i>
                                            Migrar
                                        </button>
                                        <!-- TODO: aplicar el loading a los botones -->
                                        <!-- <button class="btn btn-primary" 
                                            type="button" 
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" 
                                                role="status" 
                                                aria-hidden="true">
                                            </span>
                                            Loading...
                                        </button> -->
                                    </td>
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