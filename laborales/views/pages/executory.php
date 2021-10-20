<?php
    require_once "./views/shared/session-start.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"
    id="app-executory">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ejecutoria</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo SERVERURL ?>?route=admin">Inicio</a></li>
                        <li class="breadcrumb-item active">Ejecutoria</li>
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

                <div class="card animate__animated animate__fadeIn animate__fast">
                    <div class="card-header bg-secondary">
                        EJECUTORIA
                    </div>
                    <div class="card-body">
                        <form class="was-validated" 
                            autocomplete="off"
                            novalidate
                            v-on:submit.prevent>

                            <div class="form-row d-flex flex-row align-items-end">

                                <div class="form-group col-md-10">
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
                                    <div class="mt-0" v-if="!$v.form.radicado.required && $v.form.radicado.$error && $v.form.radicado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form.radicado.minLength && $v.form.radicado.$error && $v.form.radicado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form.radicado.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <button type="submit" 
                                        class="btn btn-primary btn-block"
                                        @click="btnGetProcess();"
                                        v-bind:disabled="submitStatus === 'PENDING'">
                                        <i class="fas fa-search"
                                            v-if="submitStatus !== 'PENDING' ||  submitStatus === null"></i>
                                        <i class="spinner-border spinner-border-sm" 
                                            role="status" 
                                            aria-hidden="true"
                                            v-bind:class="{ 'd-none': submitStatus !== 'PENDING'}">
                                        </i>
                                        <span v-if="submitStatus === 'PENDING'">Consultando...</span>
                                        <span v-if="submitStatus !== 'PENDING' ||  submitStatus === null">Consultar</span>
                                    </button>
                                </div>

                            </div>
                            
                        </form>

                        <!-- <pre>{{ $v.form }}</pre> -->

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        DATOS PROCESO
                    </div>
                    <div class="card-body">
                        <form class="was-validated"
                            autocomplete="off"
                            novalidate
                            v-on:submit.prevent>

                            <div class="form-row">

                                <div class="form-group">
                                    <label for="">Id</label>
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-contract">

                                                </i>
                                            </div>
                                        </div>
                                        <!-- <input type="text"
                                            class="input-vuelidate"
                                            id="id"
                                            disabled
                                            readonly> -->
                                        <label for="" id="id"></label>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

                <!-- <div class="card">
                    <div class="card-header">
                        OBSERVACIONES
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        RADICADOS
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div> -->
                
            </div>
            <!-- /.row -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->