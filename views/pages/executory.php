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
                                        @click="getProcess();"
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
                    <div class="card-header bg-secondary">
                        DATOS PROCESO
                    </div>
                    <div class="card-body">
                        <form class="was-validated"
                            autocomplete="off"
                            novalidate
                            v-on:submit.prevent>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="id_radicado">Id radicado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.id_radicado.$error && $v.form_process.id_radicado.$invalid, 
                                                        'text-success': !$v.form_process.id_radicado.$error && !$v.form_process.id_radicado.$invalid && $v.form_process.id_radicado.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="id_radicado"
                                            name="id_radicado"
                                            placeholder="Id radicado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.id_radicado)"
                                            v-bind:value="form_process.id_radicado"
                                            v-model.trim="$v.form_process.id_radicado.$model"
                                            @focusout="touchedVuelidate($v.form_process.id_radicado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.id_radicado.required && $v.form_process.id_radicado.$error && $v.form_process.id_radicado.$invalid">
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
                                            name="radicado"
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
                            
                            <!-- TODO: Crear la forma de que se los demandantes y demandados se vean dinamicamente -->
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="id_plaintiff">Cédula demandante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.id_plaintiff.$error && $v.form_process.id_plaintiff.$invalid, 
                                                        'text-success': !$v.form_process.id_plaintiff.$error && !$v.form_process.id_plaintiff.$invalid && $v.form_process.id_plaintiff.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="id_plaintiff"
                                            name="id_plaintiff"
                                            placeholder="Cédula demandante"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.id_plaintiff)"
                                            v-bind:value="form_process.id_plaintiff"
                                            v-model.trim="$v.form_process.id_plaintiff.$model"
                                            @focusout="touchedVuelidate($v.form_process.id_plaintiff);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.id_plaintiff.required && $v.form_process.id_plaintiff.$error && $v.form_process.id_plaintiff.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="plaintiff">Demandante</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.plaintiff.$error && $v.form_process.plaintiff.$invalid, 
                                                        'text-success': !$v.form_process.plaintiff.$error && !$v.form_process.plaintiff.$invalid && $v.form_process.plaintiff.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="plaintiff"
                                            name="plaintiff"
                                            placeholder="Demandante"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.plaintiff)"
                                            v-bind:value="form_process.plaintiff"
                                            v-model.trim="$v.form_process.plaintiff.$model"
                                            @focusout="touchedVuelidate($v.form_process.plaintiff);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.plaintiff.required && $v.form_process.plaintiff.$error && $v.form_process.plaintiff.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="id_defendant">Cédula demandado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-id-card"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.id_defendant.$error && $v.form_process.id_defendant.$invalid, 
                                                        'text-success': !$v.form_process.id_defendant.$error && !$v.form_process.id_defendant.$invalid && $v.form_process.id_defendant.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="id_defendant"
                                            name="id_defendant"
                                            placeholder="Cédula demandado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.id_defendant)"
                                            v-bind:value="form_process.id_defendant"
                                            v-model.trim="$v.form_process.id_defendant.$model"
                                            @focusout="touchedVuelidate($v.form_process.id_defendant);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.id_defendant.required && $v.form_process.id_defendant.$error && $v.form_process.id_defendant.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label for="defendant">Demandado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.defendant.$error && $v.form_process.defendant.$invalid, 
                                                        'text-success': !$v.form_process.defendant.$error && !$v.form_process.defendant.$invalid && $v.form_process.defendant.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="defendant"
                                            name="defendant"
                                            placeholder="Demandado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.defendant)"
                                            v-bind:value="form_process.defendant"
                                            v-model.trim="$v.form_process.defendant.$model"
                                            @focusout="touchedVuelidate($v.form_process.defendant);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.defendant.required && $v.form_process.defendant.$error && $v.form_process.defendant.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="original_court">Juzgado origen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-gavel"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.original_court.$error && $v.form_process.original_court.$invalid, 
                                                        'text-success': !$v.form_process.original_court.$error && !$v.form_process.original_court.$invalid && $v.form_process.original_court.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="original_court"
                                            name="original_court"
                                            placeholder="Juzgado origen"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.original_court)"
                                            v-bind:value="form_process.original_court"
                                            v-model.trim="$v.form_process.original_court.$model"
                                            @focusout="touchedVuelidate($v.form_process.original_court);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.original_court.required && $v.form_process.original_court.$error && $v.form_process.original_court.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="destination_court">Juzgado destino</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-gavel"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.destination_court.$error && $v.form_process.destination_court.$invalid, 
                                                        'text-success': !$v.form_process.destination_court.$error && !$v.form_process.destination_court.$invalid && $v.form_process.destination_court.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="destination_court"
                                            name="destination_court"
                                            placeholder="Juzgado destino"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.destination_court)"
                                            v-bind:value="form_process.destination_court"
                                            v-model.trim="$v.form_process.destination_court.$model"
                                            @focusout="touchedVuelidate($v.form_process.destination_court);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.destination_court.required && $v.form_process.destination_court.$error && $v.form_process.destination_court.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="process_class">Clase proceso</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tag"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.process_class.$error && $v.form_process.process_class.$invalid, 
                                                        'text-success': !$v.form_process.process_class.$error && !$v.form_process.process_class.$invalid && $v.form_process.process_class.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="process_class"
                                            name="process_class"
                                            placeholder="Clase proceso"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.process_class)"
                                            v-bind:value="form_process.process_class"
                                            v-model.trim="$v.form_process.process_class.$model"
                                            @focusout="touchedVuelidate($v.form_process.process_class);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.process_class.required && $v.form_process.process_class.$error && $v.form_process.process_class.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="position">Posición</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-pin"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.position.$error && $v.form_process.position.$invalid, 
                                                        'text-success': !$v.form_process.position.$error && !$v.form_process.position.$invalid && $v.form_process.position.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="position"
                                            name="position"
                                            placeholder="Posición"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_process.position)"
                                            v-bind:value="form_process.position"
                                            v-model.trim="$v.form_process.position.$model"
                                            @focusout="touchedVuelidate($v.form_process.position);">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="additional_observation">Observacion</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-comment"
                                                v-bind:class="{ 
                                                    'text-danger': $v.form_process.additional_observation.$error && $v.form_process.additional_observation.$invalid, 
                                                    'text-success': !$v.form_process.additional_observation.$error && !$v.form_process.additional_observation.$invalid && $v.form_process.additional_observation.$dirty 
                                                }">
                                            </i>
                                        </div>
                                    </div>
                                    <select class="select-vuelidate" 
                                        id="additional_observation"
                                        name="additional_observation" 
                                        placeholder="Observacion"
                                        v-bind:class="status($v.form_process.additional_observation)"
                                        v-bind:value="form_process.additional_observation"
                                        v-model.trim="$v.form_process.additional_observation.$model"
                                        @focusout="touchedVuelidate($v.form_process.additional_observation);">
                                        <option value="" disabled="" selected="">
                                            Seleccione una opción
                                        </option>
                                        <option v-for="(annotation, index) in dossier_annotations" :key="index"
                                            :value="annotation.id_annotation_type">
                                            {{ annotation.annotation_type_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-0" v-if="!$v.form_process.additional_observation.required && $v.form_process.additional_observation.$error && $v.form_process.additional_observation.$invalid">
                                    <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                        <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-3">
                                    <label for="start_date">Fecha inicial</label>
                                    <div class="input-group date"
                                        id="startdate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#startdate_datepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.start_date.$error && $v.form_process.start_date.$invalid, 
                                                        'text-success': !$v.form_process.start_date.$error && !$v.form_process.start_date.$invalid && $v.form_process.start_date.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="start_date"
                                            name="start_date"
                                            placeholder="Fecha inicial"
                                            maxlength="10"
                                            disabled
                                            readonly
                                            data-target="#startdate_datepicker" 
                                            data-toggle="datetimepicker"
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.form_process.start_date)"
                                            v-bind:value="form_process.start_date"
                                            v-model.trim="$v.form_process.start_date.$model"
                                            @focusout="touchedVuelidate($v.form_process.start_date); calculateDaysToEndDate();">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.start_date.required && $v.form_process.start_date.$error && $v.form_process.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.start_date.minLength && $v.form_process.start_date.$error && $v.form_process.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_process.start_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="days">Días</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar-day"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.days.$error && $v.form_process.days.$invalid, 
                                                        'text-success': !$v.form_process.days.$error && !$v.form_process.days.$invalid && $v.form_process.days.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="days"
                                            name="days"
                                            placeholder="Días"
                                            v-bind:class="status($v.form_process.days)"
                                            v-bind:value="form_process.days"
                                            v-model.trim="$v.form_process.days.$model"
                                            @focusout="touchedVuelidate($v.form_process.days); calculateDaysToEndDate();">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.days.numeric && $v.form_process.days.$error && $v.form_process.days.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar un número</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="end_date">Fecha final</label>
                                    <div class="input-group date"
                                        id="enddate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#enddate_datepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.end_date.$error && $v.form_process.end_date.$invalid, 
                                                        'text-success': !$v.form_process.end_date.$error && !$v.form_process.end_date.$invalid && $v.form_process.end_date.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="end_date"
                                            name="end_date"
                                            placeholder="Fecha final"
                                            maxlength="10"
                                            disabled
                                            readonly
                                            data-target="#enddate_datepicker" 
                                            data-toggle="datetimepicker"
                                            v-mask="'##/##/####'"
                                            v-bind:class="status($v.form_process.end_date)"
                                            v-bind:value="form_process.end_date"
                                            v-model.trim="$v.form_process.end_date.$model"
                                            @focusout="touchedVuelidate($v.form_process.end_date);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_process.end_date.minLength && $v.form_process.end_date.$error && $v.form_process.end_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_process.end_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="assigned_to">Asignado a</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-check"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_process.assigned_to.$error && $v.form_process.assigned_to.$invalid, 
                                                        'text-success': !$v.form_process.assigned_to.$error && !$v.form_process.assigned_to.$invalid && $v.form_process.assigned_to.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <select class="select-vuelidate"
                                            id="assigned_to"
                                            name="assigned_to"
                                            placeholder="Asignado a"
                                            v-bind:class="status($v.form_process.assigned_to)"
                                            v-bind:value="form_process.assigned_to"
                                            v-model.trim="$v.form_process.assigned_to.$model"
                                            @focusout="touchedVuelidate($v.form_process.assigned_to);">
                                            <option value="" disabled="" selected="">
                                                Seleccione una opción
                                            </option>
                                            <option v-for="(employee, index) in employees" :key="index"
                                                :value="employee.id_employee">
                                                {{ employee.firstname + ' ' + employee.lastname }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-group">
    
                                <label for="">Última observación</label>
                                <table id="" 
                                    class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">Fecha</th>
                                            <th>Observación</th>
                                            <th>Usuario</th>
                                            <th>Adicionar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-if="form_process.id_radicado !== ''">
                                            <th scope="row">{{ form_process.date }}</th>
                                            <td>{{ form_process.observation }}</td>
                                            <td>{{ form_process.user }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary"
                                                    @click="btnAddRadicado();"
                                                    v-bind:disabled="$v.form_process.$invalid">
                                                    <i class="fas fa-plus-circle"></i>
                                                    Adicionar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
    
                            </div>

                        </form>

                        <!-- <pre>{{ $v.form_process }}</pre> -->

                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-secondary">
                        RADICADOS
                    </div>
                    <div class="card-body">
                        
                        <table id="table_datatable" 
                            class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">ID</th>
                                    <th>Radicado</th>
                                    <th>Observación</th>
                                    <th>Fecha inicial</th>
                                    <th>Días</th>
                                    <th>Fecha final</th>
                                    <th>Asignado a</th>
                                    <th>Fecha audiencia</th>
                                    <th>Hora audiencia</th>
                                    <th>Observación audiencia</th>
                                    <th>A despacho</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(radicado, index) in radicados_executory_list" :key="index">
                                    <th scope="row">{{ radicado.id_radicado }}</th>
                                    <td>{{ radicado.radicado }}</td>
                                    <td>{{ dossier_annotations[radicado.additional_observation - 1].observacion }}</td>
                                    <!-- TODO: Organizar la forma en que se consulta la observacion -->
                                    <td>{{ radicado.start_date }}</td>
                                    <td>{{ radicado.days }}</td>
                                    <td>{{ radicado.end_date }}</td>
                                    <td>{{ radicado.assigned_to }}</td>
                                    <td>{{  }}</td>
                                    <td>{{  }}</td>
                                    <td>{{  }}</td>
                                    <td>{{  }}</td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-danger btn-block"
                                            @click="btnRemoveRadicado(index);">
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="submit"
                            class="btn btn-primary" 
                            @click="btnRegisterExecutory();"
                            v-bind:disabled="registerStatus === 'PENDING'">
                            <span class="spinner-border spinner-border-sm" 
                                role="status" 
                                aria-hidden="true"
                                v-bind:class="{ 'd-none': registerStatus !== 'PENDING'}">
                            </span>
                            <span v-if="registerStatus === 'PENDING'">Registrando...</span>
                            <span v-if="registerStatus !== 'PENDING' ||  registerStatus === null">Registrar</span>
                        </button>
                        <button type="reset" 
                            class="btn btn-primary"
                            @click="btnCleanForms();">
                            Limpiar
                        </button>

                    </div>
                </div>

            </div>
            <!-- /.column -->
            
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->