<div class="hold-transition login-page"
    id="app-login">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo SERVERURL ?>" 
                    class="h1">
                    <img class="" 
                        src="<?php echo SERVERURL ?>views/public/img/logo.png" 
                        width="120px" 
                        alt="logo" 
                        style="display:block; margin:auto;">
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">
                    <span class="h1">
                        <b>Inicie </b>su sesión
                    </span>
                </p>

                <form class="login_form was-validated" 
                    autocomplete="off"
                    novalidate
                    method="post"
                    >
                    <!-- v-on:submit.prevent -->

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-user"
                                        v-bind:class="{ 
                                            'text-danger': $v.form.id_employee_login.$error && $v.form.id_employee_login.$invalid, 
                                            'text-success': !$v.form.id_employee_login.$error && !$v.form.id_employee_login.$invalid && $v.form.id_employee_login.$dirty 
                                        }">
                                    </i>
                                </div>
                            </div>
                            <input type="text" 
                                class="input-vuelidate" 
                                id="id_employee_login"
                                name="id_employee_login"
                                placeholder="Cédula" 
                                required
                                min="0"
                                value="<?php if (isset($_COOKIE['nombre_usuario'])) { echo $_COOKIE['nombre_usuario']; } ?>"
                                v-bind:class="status($v.form.id_employee_login)"
                                v-bind:value="form.id_employee_login"
                                v-model.trim="$v.form.id_employee_login.$model"
                                @focusout="touchedVuelidate($v.form.id_employee_login);">
                        </div>
                        <div class="mt-0" v-if="!$v.form.id_employee_login.required && $v.form.id_employee_login.$error && $v.form.id_employee_login.$invalid">
                            <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="mt-0" v-if="!$v.form.id_employee_login.minLength && $v.form.id_employee_login.$error && $v.form.id_employee_login.$invalid">
                            <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form.id_employee_login.$params.minLength.min }} caracteres</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- TODO: Implementar mascara para el campo id_employee_login con separador de punto -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"
                                        v-bind:class="{
                                            'text-danger': $v.form.password_login.$error && $v.form.password_login.$invalid, 
                                            'text-success': !$v.form.password_login.$error && !$v.form.password_login.$invalid && $v.form.password_login.$dirty 
                                        }">
                                    </i>
                                </div>
                            </div>
                            <input type="password" 
                                class="input-vuelidate" 
                                placeholder="Contraseña"
                                name="password_login"
                                id="password_login"
                                required
                                value="<?php if (isset($_COOKIE['nombre_usuario'])) { echo $_COOKIE['contrasena']; } ?>"
                                v-bind:class="status($v.form.password_login)"
                                v-bind:value="form.password_login"
                                v-model.trim="$v.form.password_login.$model"
                                @focusout="touchedVuelidate($v.form.password_login);">
                        </div>
                        <div class="mt-0" v-if="!$v.form.password_login.required && $v.form.password_login.$error && $v.form.password_login.$invalid">
                            <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                <span class="badge bg-danger badge-opacity d-block text-left py-1">Este campo es requerido</span>
                            </div>
                        </div>
                        <div class="mt-0" v-if="!$v.form.password_login.minLength && $v.form.password_login.$error && $v.form.password_login.$invalid">
                            <div class="my-1 animate__animated animate__fadeIn animate__fast">
                                <span class="badge bg-danger badge-opacity d-block text-left py-1">Debe ingresar mínimo {{ $v.form.password_login.$params.minLength.min }} caracteres</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" 
                                    id="remember"
                                    name="remember"
                                    <?php if (isset($_COOKIE['nombre_usuario'])) { ?>
                                        checked
                                    <?php } ?>>
                                <label for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12 mb-1">
                            <button type="submit" 
                                class="btn btn-primary btn-block"
                                @click="btnLogin();"
                                v-bind:disabled="submitStatus === 'PENDING'">
                                <span class="spinner-border spinner-border-sm" 
                                    role="status" 
                                    aria-hidden="true"
                                    v-bind:class="{ 'd-none': submitStatus !== 'PENDING'}">
                                </span>
                                <span v-if="submitStatus === 'PENDING'">Ingresando...</span>
                                <span v-if="submitStatus !== 'PENDING' ||  submitStatus === null">Ingresar</span>
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>

                <p class="mt-2 mb-1">
                    <a href="<?php echo SERVERURL ?>?route=forgot-password">Olvidé mi contraseña</a>
                </p>
                <p class="mt-2 mb-1">
                    <a href="<?php echo SERVERURL ?>">Regresar al inicio</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    
    <!-- <pre>{{ $v.form }}</pre> -->

</div>

<?php
    // TODO: Implementar login por la forma vue que va al API
    if (isset($_SESSION["validate_sesion"]) && $_SESSION["validate_sesion"] == "ok") {
        echo "<script>
                window.location = '" . SERVERURL . "?route=admin';
            </script>";
    }
    if (isset($_POST["id_employee_login"]) && isset($_POST["password_login"])) {
        LoginController::getLoginController();
    }
?>