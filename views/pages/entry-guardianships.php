<?php
    require_once "./views/shared/session-start.php";
?>

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
    <section class="content pb-1">
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
                                    <label for="start_date">Fecha inicial</label>
                                    <div class="input-group date"
                                        id="startdate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#startdate_datepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form.start_date.$error && $v.form.start_date.$invalid, 
                                                        'text-success': !$v.form.start_date.$error && !$v.form.start_date.$invalid && $v.form.start_date.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate datetimepicker-input" 
                                            id="start_date" 
                                            name="start_date" 
                                            placeholder="dd/mm/yyyy"
                                            required
                                            maxlength="10"
                                            data-target="#startdate_datepicker" 
                                            data-toggle="datetimepicker"
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.form.start_date)"
                                            v-bind:value="form.start_date"
                                            v-model.trim="$v.form.start_date.$model"
                                            @focusout="touchedVuelidate($v.form.start_date); validateDates($v.form.end_date);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form.start_date.required && $v.form.start_date.$error && $v.form.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form.start_date.minLength && $v.form.start_date.$error && $v.form.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar m??nimo {{ $v.form.start_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="end_date">Fecha final</label>
                                    <div class="input-group date"
                                        id="enddate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#enddate_datepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form.end_date.$error && $v.form.end_date.$invalid, 
                                                        'text-success': !$v.form.end_date.$error && !$v.form.end_date.$invalid && $v.form.end_date.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate datetimepicker-input" 
                                            id="end_date" 
                                            name="end_date" 
                                            placeholder="dd/mm/yyyy"
                                            required
                                            maxlength="10"
                                            data-target="#enddate_datepicker" 
                                            data-toggle="datetimepicker"
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.form.end_date)"
                                            v-bind:value="form.end_date"
                                            v-model.trim="$v.form.end_date.$model"
                                            @focusout="touchedVuelidate($v.form.end_date); validateDates($v.form.end_date);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form.end_date.required && $v.form.end_date.$error && $v.form.end_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form.end_date.minLength && $v.form.end_date.$error && $v.form.end_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar m??nimo {{ $v.form.end_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label for="radicado">Radicado</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-file-contract"
                                                v-bind:class="{ 
                                                    'text-danger': $v.form.radicado.$error && $v.form.radicado.$invalid, 
                                                    'text-success': !$v.form.radicado.$error && !$v.form.radicado.$invalid && $v.form.radicado.$dirty 
                                                }">
                                            </i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="input-vuelidate" 
                                        id="radicado" 
                                        placeholder="17001-31-05-001-2021-00355-00"
                                        maxlength="29"
                                        min="0"
                                        v-mask="'17001-##-##-###-####-#####-##'"
                                        v-bind:class="status($v.form.radicado)"
                                        v-bind:value="form.radicado"
                                        v-model.trim="$v.form.radicado.$model"
                                        @focusout="touchedVuelidate($v.form.radicado);">
                                </div>
                            </div>

                            <button type="submit" 
                                class="btn btn-primary"
                                @click="getProcessesInJusticia();"
                                v-bind:disabled="submitStatus === 'PENDING'">
                                <i class="spinner-border spinner-border-sm" 
                                    role="status" 
                                    aria-hidden="true"
                                    v-bind:class="{ 'd-none': submitStatus !== 'PENDING'}">
                                </i>
                                <span v-if="submitStatus === 'PENDING'">Consultando...</span>
                                <span v-if="submitStatus !== 'PENDING' ||  submitStatus === null">Consultar</span>
                            </button>
                            <button type="reset" 
                                class="btn btn-primary"
                                @click="btnCleanForm();">
                                Limpiar
                            </button>
                            
                            <div class="alerts"
                                v-if="submitStatus === 'OK' || submitStatus === 'ERROR' || submitStatus === 'PENDING'">
                                <div class="alert alert-default-success alert-dismissible fade show my-2 animate__animated animate__fadeIn animate__fast" 
                                    role="alert"
                                    v-if="submitStatus === 'OK'">
                                    !Consulta exitosa!
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
                                    Consultando...
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                        </form>

                        <!-- <pre>{{ $v.form }}</pre> -->

                    </div>
                </div>

                <!-- Preloader -->
                <div class="card"  
                    v-if="loading">
                    <div class="card-body">

                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <div class="spinner-border text-dark fa-2x" 
                                role="status" 
                                style="width: 3rem; height: 3rem;">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- Table -->
                <div v-if="!loading">
                    <div class="card animate__animated animate__fadeIn animate__fast">
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
                                    <tr v-for="(guardianship, index) in entry_guardianships_list" :key="index">
                                        <th scope="row">{{ (index + 1) }}</th>
                                        <td>
                                            <span class="badge"
                                                v-bind:class="{ 'badge-danger': process_exist_list[index] === false, 'badge-success': process_exist_list[index] !== false }">
                                                <i class="fas fa-times-circle" v-if="process_exist_list[index] === false"></i>
                                                <i class="fas fa-check-circle" v-else></i>
                                                {{ process_exist_list[index] === false ? 'NO MIGRADA' : 'MIGRADA' }}
                                            </span>
                                        </td>
                                        <td>{{ guardianship.A103LLAVPROC }}</td>
                                        <td>{{ moment(guardianship.A103FECHREPA, 'YYYY-MM-DD h:mm:ss').format('YYYY-MM-DD') }}</td>
                                        <td>{{ moment(guardianship.A103HORAREPA, 'h:mm:ss').format('LTS') }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-primary btn-block" 
                                                @click="migrateGuardianship(guardianship.A103LLAVPROC);"
                                                v-bind:disabled="migrateStatus === 'PENDING_' + guardianship.A103LLAVPROC"
                                                v-if="process_exist_list[index] === false">
                                                <span class="spinner-border spinner-border-sm" 
                                                    role="status" 
                                                    aria-hidden="true"
                                                    v-bind:class="{ 'd-none': migrateStatus !== 'PENDING_' + guardianship.A103LLAVPROC}">
                                                </span>
                                                <span v-if="migrateStatus === 'PENDING_' + guardianship.A103LLAVPROC">Migrando...</span>
                                                <span v-if="migrateStatus !== 'PENDING_' + guardianship.A103LLAVPROC ||  migrateStatus === null">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                    Migrar tutela
                                                </span>
                                            </button>
                                            <span class="badge badge-success"
                                                v-else>
                                                TUTELA MIGRADA
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.column -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->