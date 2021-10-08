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

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="startDate">Fecha inicial</label>
                                    <div class="input-group date"
                                        id="startdate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#startdate_datepicker" 
                                                data-toggle="datetimepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.startDate.$error && $v.startDate.$invalid, 
                                                        'text-success': !$v.startDate.$error && !$v.startDate.$invalid && $v.startDate.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <!-- TODO: Validar que las fechas sean correctas -->
                                        <input 
                                            type="text"
                                            class="input-vuevalidate datetimepicker-input" 
                                            id="startDate" 
                                            placeholder="dd/mm/yyyy"
                                            required
                                            maxlength="10"
                                            data-target="#startdate_datepicker" 
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.startDate)"
                                            v-bind:value="startDate"
                                            v-model.trim="$v.startDate.$model"
                                            @focusout="touchedVuevalidate($v.startDate);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.startDate.required && $v.startDate.$error && $v.startDate.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.startDate.minLength && $v.startDate.$error && $v.startDate.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.startDate.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="endDate">Fecha final</label>
                                    <div class="input-group date"
                                        id="enddate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#enddate_datepicker" 
                                                data-toggle="datetimepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.endDate.$error && $v.endDate.$invalid, 
                                                        'text-success': !$v.endDate.$error && !$v.endDate.$invalid && $v.endDate.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input 
                                            type="text"
                                            class="input-vuevalidate datetimepicker-input" 
                                            id="endDate" 
                                            placeholder="dd/mm/yyyy"
                                            required
                                            maxlength="10"
                                            data-target="#startdate_datepicker" 
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.endDate)"
                                            v-bind:value="endDate"
                                            v-model.trim="$v.endDate.$model"
                                            @focusout="touchedVuevalidate($v.endDate);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.endDate.required && $v.endDate.$error && $v.endDate.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.endDate.minLength && $v.endDate.$error && $v.endDate.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.endDate.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label for="radicado">Radicado</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-file-contract"
                                                v-bind:class="{ 
                                                    'text-danger': $v.radicado.$error && $v.radicado.$invalid, 
                                                    'text-success': !$v.radicado.$error && !$v.radicado.$invalid && $v.radicado.$dirty 
                                                }">
                                            </i>
                                        </div>
                                    </div>
                                    <input 
                                        type="text"
                                        class="input-vuevalidate" 
                                        id="radicado" 
                                        placeholder="17001-31-05-001-2021-00355-00"
                                        required
                                        maxlength="29"
                                        min="0"
                                        v-mask="'17001-##-##-###-####-#####-##'"
                                        v-bind:class="status($v.radicado)"
                                        v-bind:value="radicado"
                                        v-model.trim="$v.radicado.$model"
                                        @focusout="touchedVuevalidate($v.radicado);">
                                </div>
                                <div class="mt-0" v-if="!$v.radicado.required && $v.radicado.$error && $v.radicado.$invalid">
                                    <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                        <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                    </div>
                                </div>
                                <div class="mt-0" v-if="!$v.radicado.minLength && $v.radicado.$error && $v.radicado.$invalid">
                                    <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                        <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.radicado.$params.minLength.min }} numeros</span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" 
                                class="btn btn-primary"
                                @click="btnConsultRadicado();"
                                v-bind:disabled="submitStatus === 'PENDING'">
                                <span class="spinner-border spinner-border-sm" 
                                    role="status" 
                                    aria-hidden="true"
                                    v-bind:class="{ 'd-none': submitStatus !== 'PENDING'}">
                                </span>
                                <span v-if="submitStatus === 'PENDING'">Enviando...</span>
                                <span v-if="submitStatus !== 'PENDING' ||  submitStatus === null">Consultar</span>
                            </button>
                            <button type="reset" 
                                class="btn btn-primary"
                                @click="$v.$reset">
                                Limpiar
                            </button>
                            
                            <div class="alerts"
                                v-if="submitStatus === 'OK' || submitStatus === 'ERROR' || submitStatus === 'PENDING'">
                                <div class="alert alert-default-success alert-dismissible fade show my-2 animate__animated animate__fadeIn animate__fast" 
                                    role="alert"
                                    v-if="submitStatus === 'OK'">
                                    !Gracias por su envío!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-default-danger alert-dismissible fade show my-2 animate__animated animate__fadeIn animate__fast" 
                                    role="alert"
                                    v-if="submitStatus === 'ERROR'">
                                    Por favor, rellene el formulario correctamente.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-default-info alert-dismissible fade show my-2 animate__animated animate__fadeIn animate__fast" 
                                    role="alert"
                                    v-if="submitStatus === 'PENDING'">
                                    <span class="spinner-border spinner-border-sm" 
                                        role="status" 
                                        aria-hidden="true"
                                        v-bind:class="{ 'd-none': submitStatus !== 'PENDING'}">
                                    </span>
                                    Enviando...
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                        </form>

                        <!-- <pre>{{ $v }}</pre> -->

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