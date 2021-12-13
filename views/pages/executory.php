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
                                        @click="getDossier();"
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
                                    <label for="id_dossier">Id radicado</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-list-ol"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.id_dossier.$error && $v.form_dossier.id_dossier.$invalid, 
                                                        'text-success': !$v.form_dossier.id_dossier.$error && !$v.form_dossier.id_dossier.$invalid && $v.form_dossier.id_dossier.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="id_dossier"
                                            name="id_dossier"
                                            placeholder="Id radicado"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_dossier.id_dossier)"
                                            v-bind:value="form_dossier.id_dossier"
                                            v-model.trim="$v.form_dossier.id_dossier.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.id_dossier);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.id_dossier.required && $v.form_dossier.id_dossier.$error && $v.form_dossier.id_dossier.$invalid">
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
                                                        'text-danger': $v.form_dossier.radicado.$error && $v.form_dossier.radicado.$invalid, 
                                                        'text-success': !$v.form_dossier.radicado.$error && !$v.form_dossier.radicado.$invalid && $v.form_dossier.radicado.$dirty 
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
                                            v-bind:class="status($v.form_dossier.radicado)"
                                            v-bind:value="form_dossier.radicado"
                                            v-model.trim="$v.form_dossier.radicado.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.radicado);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.radicado.required && $v.form_dossier.radicado.$error && $v.form_dossier.radicado.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="card card-plaintiff-defendant">
                                <div class="card-header">
                                    DEMANDANTES
                                </div>
                                <div class="card-body">
                                    <div class="form-row" v-for="(plaintiff, index) in plaintiffs" :key="index">
        
                                        <div class="form-group col-md-4">
                                            <label for="id_plaintiff">Cédula demandante</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-id-card"
                                                            v-bind:class="{ 
                                                                'text-danger': $v.form_dossier.id_plaintiff.$error && $v.form_dossier.id_plaintiff.$invalid, 
                                                                'text-success': !$v.form_dossier.id_plaintiff.$error && !$v.form_dossier.id_plaintiff.$invalid && $v.form_dossier.id_plaintiff.$dirty 
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
                                                    v-bind:class="status($v.form_dossier.id_plaintiff)"
                                                    v-bind:value="plaintiff.plaintiff_identification"
                                                    v-model.trim="plaintiff.plaintiff_identification"
                                                    @focusout="touchedVuelidate($v.form_dossier.id_plaintiff);">
                                            </div>
                                            <div class="mt-0" v-if="!$v.form_dossier.id_plaintiff.required && $v.form_dossier.id_plaintiff.$error && $v.form_dossier.id_plaintiff.$invalid">
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
                                                                'text-danger': $v.form_dossier.plaintiff.$error && $v.form_dossier.plaintiff.$invalid, 
                                                                'text-success': !$v.form_dossier.plaintiff.$error && !$v.form_dossier.plaintiff.$invalid && $v.form_dossier.plaintiff.$dirty 
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
                                                    v-bind:class="status($v.form_dossier.plaintiff)"
                                                    v-bind:value="plaintiff.plaintiff_name"
                                                    v-model.trim="plaintiff.plaintiff_name"
                                                    @focusout="touchedVuelidate($v.form_dossier.plaintiff);">
                                            </div>
                                            <div class="mt-0" v-if="!$v.form_dossier.plaintiff.required && $v.form_dossier.plaintiff.$error && $v.form_dossier.plaintiff.$invalid">
                                                <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                                    <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card card-plaintiff-defendant">
                                <div class="card-header">
                                    DEMANDADOS
                                </div>
                                <div class="card-body">
                                    <div class="form-row" v-for="(defendant, index) in defendants" :key="index">
        
                                        <div class="form-group col-md-4">
                                            <label for="id_defendant">Cédula demandado</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-id-card"
                                                            v-bind:class="{ 
                                                                'text-danger': $v.form_dossier.id_defendant.$error && $v.form_dossier.id_defendant.$invalid, 
                                                                'text-success': !$v.form_dossier.id_defendant.$error && !$v.form_dossier.id_defendant.$invalid && $v.form_dossier.id_defendant.$dirty 
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
                                                    v-bind:class="status($v.form_dossier.id_defendant)"
                                                    v-bind:value="defendant.defendant_identification"
                                                    v-model.trim="defendant.defendant_identification"
                                                    @focusout="touchedVuelidate($v.form_dossier.id_defendant);">
                                            </div>
                                            <div class="mt-0" v-if="!$v.form_dossier.id_defendant.required && $v.form_dossier.id_defendant.$error && $v.form_dossier.id_defendant.$invalid">
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
                                                                'text-danger': $v.form_dossier.defendant.$error && $v.form_dossier.defendant.$invalid, 
                                                                'text-success': !$v.form_dossier.defendant.$error && !$v.form_dossier.defendant.$invalid && $v.form_dossier.defendant.$dirty 
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
                                                    v-bind:class="status($v.form_dossier.defendant)"
                                                    v-bind:value="defendant.defendant_name"
                                                    v-model.trim="defendant.defendant_name"
                                                    @focusout="touchedVuelidate($v.form_dossier.defendant);">
                                            </div>
                                            <div class="mt-0" v-if="!$v.form_dossier.defendant.required && $v.form_dossier.defendant.$error && $v.form_dossier.defendant.$invalid">
                                                <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                                    <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                                </div>
                                            </div>
                                        </div>
        
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="court_origin_name">Juzgado origen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-gavel"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.court_origin_name.$error && $v.form_dossier.court_origin_name.$invalid, 
                                                        'text-success': !$v.form_dossier.court_origin_name.$error && !$v.form_dossier.court_origin_name.$invalid && $v.form_dossier.court_origin_name.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="court_origin_name"
                                            name="court_origin_name"
                                            placeholder="Juzgado origen"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_dossier.court_origin_name)"
                                            v-bind:value="form_dossier.court_origin_name"
                                            v-model.trim="$v.form_dossier.court_origin_name.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.court_origin_name);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.court_origin_name.required && $v.form_dossier.court_origin_name.$error && $v.form_dossier.court_origin_name.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="court_destination_name">Juzgado destino</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-gavel"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.court_destination_name.$error && $v.form_dossier.court_destination_name.$invalid, 
                                                        'text-success': !$v.form_dossier.court_destination_name.$error && !$v.form_dossier.court_destination_name.$invalid && $v.form_dossier.court_destination_name.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="court_destination_name"
                                            name="court_destination_name"
                                            placeholder="Juzgado destino"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_dossier.court_destination_name)"
                                            v-bind:value="form_dossier.court_destination_name"
                                            v-model.trim="$v.form_dossier.court_destination_name.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.court_destination_name);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.court_destination_name.required && $v.form_dossier.court_destination_name.$error && $v.form_dossier.court_destination_name.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="dossier_type_name">Clase proceso</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tag"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.dossier_type_name.$error && $v.form_dossier.dossier_type_name.$invalid, 
                                                        'text-success': !$v.form_dossier.dossier_type_name.$error && !$v.form_dossier.dossier_type_name.$invalid && $v.form_dossier.dossier_type_name.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="dossier_type_name"
                                            name="dossier_type_name"
                                            placeholder="Clase proceso"
                                            disabled
                                            readonly
                                            v-bind:class="status($v.form_dossier.dossier_type_name)"
                                            v-bind:value="form_dossier.dossier_type_name"
                                            v-model.trim="$v.form_dossier.dossier_type_name.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.dossier_type_name);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.dossier_type_name.required && $v.form_dossier.dossier_type_name.$error && $v.form_dossier.dossier_type_name.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="position">Posición</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-map-pin"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.position.$error && $v.form_dossier.position.$invalid, 
                                                        'text-success': !$v.form_dossier.position.$error && !$v.form_dossier.position.$invalid && $v.form_dossier.position.$dirty 
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
                                            v-bind:class="status($v.form_dossier.position)"
                                            v-bind:value="form_dossier.position"
                                            v-model.trim="$v.form_dossier.position.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.position);">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="annotation_type">Observacion</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-comment"
                                                v-bind:class="{ 
                                                    'text-danger': $v.form_dossier.annotation_type.$error && $v.form_dossier.annotation_type.$invalid, 
                                                    'text-success': !$v.form_dossier.annotation_type.$error && !$v.form_dossier.annotation_type.$invalid && $v.form_dossier.annotation_type.$dirty 
                                                }">
                                            </i>
                                        </div>
                                    </div>
                                    <select class="select-vuelidate" 
                                        id="annotation_type"
                                        name="annotation_type" 
                                        placeholder="Observacion"
                                        v-bind:class="status($v.form_dossier.annotation_type)"
                                        v-bind:value="form_dossier.annotation_type"
                                        v-model.trim="$v.form_dossier.annotation_type.$model"
                                        @focusout="touchedVuelidate($v.form_dossier.annotation_type);"
                                        @click="selectAnnotationTypeAudience();">
                                        <option value="" disabled="" selected="">
                                            Seleccione una opción
                                        </option>
                                        <option v-for="(annotation, index) in annotation_types" :key="index"
                                            :value="annotation.id_annotation_type">
                                            {{ annotation.annotation_type_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-0" v-if="!$v.form_dossier.annotation_type.required && $v.form_dossier.annotation_type.$error && $v.form_dossier.annotation_type.$invalid">
                                    <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                        <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row" v-show="enableAudience">

                                <div class="form-group col-md-4">
                                    <label for="audience_date">Fecha audiencia</label>
                                    <div class="input-group date"
                                        id="audiencedate_datepicker" 
                                        data-target-input="nearest">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"
                                                data-target="#audiencedate_datepicker">
                                                <i class="fas fa-calendar-alt"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.audience_date.$error && $v.form_dossier.audience_date.$invalid, 
                                                        'text-success': !$v.form_dossier.audience_date.$error && !$v.form_dossier.audience_date.$invalid && $v.form_dossier.audience_date.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="audience_date"
                                            name="audience_date"
                                            placeholder="Fecha audiencia"
                                            maxlength="10"
                                            data-target="#audiencedate_datepicker" 
                                            data-toggle="datetimepicker"
                                            v-mask="'##/##/#### ##:## AM'"
                                            v-bind:class="status($v.form_dossier.audience_date)"
                                            v-bind:value="form_dossier.audience_date"
                                            v-model.trim="$v.form_dossier.audience_date.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.audience_date);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.audience_date.required && $v.form_dossier.audience_date.$error && $v.form_dossier.audience_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.audience_date.minLength && $v.form_dossier.audience_date.$error && $v.form_dossier.audience_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_dossier.audience_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label>Observación audiencia</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-comment"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.audience_observation.$error && $v.form_dossier.audience_observation.$invalid, 
                                                        'text-success': !$v.form_dossier.audience_observation.$error && !$v.form_dossier.audience_observation.$invalid && $v.form_dossier.audience_observation.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <textarea class="textarea-vuelidate"
                                            id="audience_observation"
                                            name="audience_observation"
                                            placeholder="Obsevación audiencia ..."
                                            rows="3"
                                            v-bind:class="status($v.form_dossier.audience_observation)"
                                            v-bind:value="form_dossier.audience_observation"
                                            v-model.trim="$v.form_dossier.audience_observation.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.audience_observation);">
                                        </textarea>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.audience_observation.required && $v.form_dossier.audience_observation.$error && $v.form_dossier.audience_observation.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.audience_observation.minLength && $v.form_dossier.audience_observation.$error && $v.form_dossier.audience_observation.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_dossier.audience_observation.$params.minLength.min }} caracteres</span>
                                        </div>
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
                                                        'text-danger': $v.form_dossier.start_date.$error && $v.form_dossier.start_date.$invalid, 
                                                        'text-success': !$v.form_dossier.start_date.$error && !$v.form_dossier.start_date.$invalid && $v.form_dossier.start_date.$dirty 
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
                                            v-bind:class="status($v.form_dossier.start_date)"
                                            v-bind:value="form_dossier.start_date"
                                            v-model.trim="$v.form_dossier.start_date.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.start_date); calculateDaysToEndDate();">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.start_date.required && $v.form_dossier.start_date.$error && $v.form_dossier.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                                        </div>
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.start_date.minLength && $v.form_dossier.start_date.$error && $v.form_dossier.start_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_dossier.start_date.$params.minLength.min }} caracteres</span>
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
                                                        'text-danger': $v.form_dossier.days.$error && $v.form_dossier.days.$invalid, 
                                                        'text-success': !$v.form_dossier.days.$error && !$v.form_dossier.days.$invalid && $v.form_dossier.days.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <input type="text"
                                            class="input-vuelidate"
                                            id="days"
                                            name="days"
                                            placeholder="Días"
                                            v-bind:class="status($v.form_dossier.days)"
                                            v-bind:value="form_dossier.days"
                                            v-model.trim="$v.form_dossier.days.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.days); calculateDaysToEndDate();">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.days.numeric && $v.form_dossier.days.$error && $v.form_dossier.days.$invalid">
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
                                                        'text-danger': $v.form_dossier.end_date.$error && $v.form_dossier.end_date.$invalid, 
                                                        'text-success': !$v.form_dossier.end_date.$error && !$v.form_dossier.end_date.$invalid && $v.form_dossier.end_date.$dirty 
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
                                            v-bind:class="status($v.form_dossier.end_date)"
                                            v-bind:value="form_dossier.end_date"
                                            v-model.trim="$v.form_dossier.end_date.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.end_date);">
                                    </div>
                                    <div class="mt-0" v-if="!$v.form_dossier.end_date.minLength && $v.form_dossier.end_date.$error && $v.form_dossier.end_date.$invalid">
                                        <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                            <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form_dossier.end_date.$params.minLength.min }} caracteres</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label for="assigned_to_index">Asignado a</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user-check"
                                                    v-bind:class="{ 
                                                        'text-danger': $v.form_dossier.assigned_to_index.$error && $v.form_dossier.assigned_to_index.$invalid, 
                                                        'text-success': !$v.form_dossier.assigned_to_index.$error && !$v.form_dossier.assigned_to_index.$invalid && $v.form_dossier.assigned_to_index.$dirty 
                                                    }">
                                                </i>
                                            </div>
                                        </div>
                                        <select class="select-vuelidate"
                                            id="assigned_to_index"
                                            name="assigned_to_index"
                                            placeholder="Asignado a"
                                            v-bind:class="status($v.form_dossier.assigned_to_index)"
                                            v-bind:value="form_dossier.assigned_to_index"
                                            v-model.trim="$v.form_dossier.assigned_to_index.$model"
                                            @focusout="touchedVuelidate($v.form_dossier.assigned_to_index);">
                                            <option value="" disabled="" selected="">
                                                Seleccione una opción
                                            </option>
                                            <option v-for="(employee, index) in employees" :key="index"
                                                :value="index">
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
                                        <tr v-if="form_dossier.id_dossier !== ''">
                                            <th scope="row">{{ form_dossier.dossier_annotation_date_last }}</th>
                                            <td>{{ form_dossier.dossier_annotation_type_last }}</td>
                                            <td>{{ form_dossier.dossier_annotation_employee_last }}</td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-primary"
                                                    @click="btnAddRadicado();"
                                                    v-bind:disabled="$v.form_dossier.$invalid">
                                                    <i class="fas fa-plus-circle"></i>
                                                    Adicionar
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
    
                            </div>

                        </form>

                        <!-- <pre>{{ $v.form_dossier }}</pre> -->

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
                                    <th>Observación audiencia</th>
                                    <th>A despacho</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(radicado, index) in radicados_executory_list" :key="index">
                                    <th scope="row">{{ radicado.id_dossier }}</th>
                                    <td>{{ radicado.radicado }}</td>
                                    <td>{{ annotation_types[radicado.annotation_type - 1].annotation_type_name }}</td>
                                    <td>{{ radicado.start_date }}</td>
                                    <td>{{ radicado.days }}</td>
                                    <td>{{ radicado.end_date }}</td>
                                    <td>{{ radicado.assigned_to_name }}</td>
                                    <td>{{ radicado.audience_date }}</td>
                                    <td>{{ radicado.audience_observation }}</td>
                                    <!-- TODO: Terminar la tabla -->
                                    <td>{{  }}</td> <!-- A despacho -->
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