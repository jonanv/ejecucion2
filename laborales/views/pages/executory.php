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

                                <div class="form-group col-md-4">
                                    <label for="idradicado">Id radicado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.idradicado.$error && $v.form_process.idradicado.$invalid, 
                                                        'text-success': !$v.form_process.idradicado.$error && !$v.form_process.idradicado.$invalid && $v.form_process.idradicado.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="idradicado"
                                            placeholder="Id radicado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.idradicado)"
                                            v-bind:value="form_process.idradicado"
                                            v-model.trim="$v.form_process.idradicado.$model"
                                            @focusout="touchedVuelidate($v.form_process.idradicado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.idradicado.required && $v.form_process.idradicado.$error && $v.form_process.idradicado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="radicado">Radicado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-contract"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.radicado.$error && $v.form_process.radicado.$invalid, 
                                                        'text-success': !$v.form_process.radicado.$error && !$v.form_process.radicado.$invalid && $v.form_process.radicado.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="radicado"
                                            placeholder="Radicado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.radicado)"
                                            v-bind:value="form_process.radicado"
                                            v-model.trim="$v.form_process.radicado.$model"
                                            @focusout="touchedVuelidate($v.form_process.radicado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.radicado.required && $v.form_process.radicado.$error && $v.form_process.radicado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-2">
                                    <label for="cedula_demandante">Cédula demandante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.cedula_demandante.$error && $v.form_process.cedula_demandante.$invalid, 
                                                        'text-success': !$v.form_process.cedula_demandante.$error && !$v.form_process.cedula_demandante.$invalid && $v.form_process.cedula_demandante.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="cedula_demandante"
                                            placeholder="Cédula demandante"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.cedula_demandante)"
                                            v-bind:value="form_process.cedula_demandante"
                                            v-model.trim="$v.form_process.cedula_demandante.$model"
                                            @focusout="touchedVuelidate($v.form_process.cedula_demandante);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.cedula_demandante.required && $v.form_process.cedula_demandante.$error && $v.form_process.cedula_demandante.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="demandante">Demandante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.demandante.$error && $v.form_process.demandante.$invalid, 
                                                        'text-success': !$v.form_process.demandante.$error && !$v.form_process.demandante.$invalid && $v.form_process.demandante.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="demandante"
                                            placeholder="Demandante"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.demandante)"
                                            v-bind:value="form_process.demandante"
                                            v-model.trim="$v.form_process.demandante.$model"
                                            @focusout="touchedVuelidate($v.form_process.demandante);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.demandante.required && $v.form_process.demandante.$error && $v.form_process.demandante.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="cedula_demandado">Cédula demandado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.cedula_demandado.$error && $v.form_process.cedula_demandado.$invalid, 
                                                        'text-success': !$v.form_process.cedula_demandado.$error && !$v.form_process.cedula_demandado.$invalid && $v.form_process.cedula_demandado.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="cedula_demandado"
                                            placeholder="Cédula demandado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.cedula_demandado)"
                                            v-bind:value="form_process.cedula_demandado"
                                            v-model.trim="$v.form_process.cedula_demandado.$model"
                                            @focusout="touchedVuelidate($v.form_process.cedula_demandado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.cedula_demandado.required && $v.form_process.cedula_demandado.$error && $v.form_process.cedula_demandado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="demandado">Demandado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.demandado.$error && $v.form_process.demandado.$invalid, 
                                                        'text-success': !$v.form_process.demandado.$error && !$v.form_process.demandado.$invalid && $v.form_process.demandado.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="demandado"
                                            placeholder="Demandado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.demandado)"
                                            v-bind:value="form_process.demandado"
                                            v-model.trim="$v.form_process.demandado.$model"
                                            @focusout="touchedVuelidate($v.form_process.demandado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.demandado.required && $v.form_process.demandado.$error && $v.form_process.demandado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="jo">Juzgado origen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.jo.$error && $v.form_process.jo.$invalid, 
                                                        'text-success': !$v.form_process.jo.$error && !$v.form_process.jo.$invalid && $v.form_process.jo.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="jo"
                                            placeholder="Juzgado origen"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.jo)"
                                            v-bind:value="form_process.jo"
                                            v-model.trim="$v.form_process.jo.$model"
                                            @focusout="touchedVuelidate($v.form_process.jo);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.jo.required && $v.form_process.jo.$error && $v.form_process.jo.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="jd">Juzgado destino</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.jd.$error && $v.form_process.jd.$invalid, 
                                                        'text-success': !$v.form_process.jd.$error && !$v.form_process.jd.$invalid && $v.form_process.jd.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="jd"
                                            placeholder="Juzgado destino"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.jd)"
                                            v-bind:value="form_process.jd"
                                            v-model.trim="$v.form_process.jd.$model"
                                            @focusout="touchedVuelidate($v.form_process.jd);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.jd.required && $v.form_process.jd.$error && $v.form_process.jd.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="claseproceso">Clase proceso</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.claseproceso.$error && $v.form_process.claseproceso.$invalid, 
                                                        'text-success': !$v.form_process.claseproceso.$error && !$v.form_process.claseproceso.$invalid && $v.form_process.claseproceso.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="claseproceso"
                                            placeholder="Clase proceso"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.claseproceso)"
                                            v-bind:value="form_process.claseproceso"
                                            v-model.trim="$v.form_process.claseproceso.$model"
                                            @focusout="touchedVuelidate($v.form_process.claseproceso);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.claseproceso.required && $v.form_process.claseproceso.$error && $v.form_process.claseproceso.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="posicion">Posición</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.posicion.$error && $v.form_process.posicion.$invalid, 
                                                        'text-success': !$v.form_process.posicion.$error && !$v.form_process.posicion.$invalid && $v.form_process.posicion.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="posicion"
                                            placeholder="Posición"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.posicion)"
                                            v-bind:value="form_process.posicion"
                                            v-model.trim="$v.form_process.posicion.$model"
                                            @focusout="touchedVuelidate($v.form_process.posicion);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.posicion.required && $v.form_process.posicion.$error && $v.form_process.posicion.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <label for="jo">Observacion</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-list-ol"
                                                v-bind:class="{ 
                                                    'text-danger': $v.form_process.jo.$error && $v.form_process.jo.$invalid, 
                                                    'text-success': !$v.form_process.jo.$error && !$v.form_process.jo.$invalid && $v.form_process.jo.$dirty 
                                                }">
                                            </i>
                                        </div>
                                    </div>
                                    <input type="text"
                                        class="input-vuelidate"
                                        id="jo"
                                        placeholder="Observacion"
                                        disabled
                                        readonly
                                        v-bind:class="status($v.form_process.jo)"
                                        v-bind:value="form_process.jo"
                                        v-model.trim="$v.form_process.jo.$model"
                                        @focusout="touchedVuelidate($v.form_process.jo);">
                                </div>
                                <div class="mt-0" v-if="!$v.form_process.jo.required && $v.form_process.jo.$error && $v.form_process.jo.$invalid">
                                    <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                        <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="jo">Juzgado origen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.jo.$error && $v.form_process.jo.$invalid, 
                                                        'text-success': !$v.form_process.jo.$error && !$v.form_process.jo.$invalid && $v.form_process.jo.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="jo"
                                            placeholder="Juzgado origen"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.jo)"
                                            v-bind:value="form_process.jo"
                                            v-model.trim="$v.form_process.jo.$model"
                                            @focusout="touchedVuelidate($v.form_process.jo);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.jo.required && $v.form_process.jo.$error && $v.form_process.jo.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit"
                                class="btn btn-primary"
                                @click="btnRegisterExecutory();">
                                Registrar
                            </button>

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