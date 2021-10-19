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
                    v-on:submit.prevent>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <!-- 
                            data-inputmask="'alias': 'integer', 'groupSeparator': '.'" 
                            data-mask -->
                        <input type="text" 
                            class="input-vuelidate" 
                            id="id_employee_login"
                            name="id_employee_login"
                            placeholder="Cédula" 
                            required
                            min="0"
                            value="<?php if (isset($_COOKIE['id_employee_login'])) { echo $_COOKIE['id_employee_login']; } ?>"
                            v-mask="'#.###.###'"
                            v-bind:class="status($v.form.id_employee_login)"
                            v-bind:value="form.id_employee_login"
                            v-model.trim="$v.form.id_employee_login.$model"
                            @focusout="touchedVuelidate($v.form.id_employee_login);">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" 
                            class="input-vuelidate" 
                            placeholder="Contraseña"
                            name="password_login"
                            id="password_login"
                            required
                            value="<?php if (isset($_COOKIE['id_employee_login'])) { echo $_COOKIE['password_login']; } ?>"
                            v-bind:class="status($v.form.password_login)"
                            v-bind:value="form.password_login"
                            v-model.trim="$v.form.password_login.$model"
                            @focusout="touchedVuelidate($v.form.password_login);">
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" 
                                    id="remember"
                                    name="remember"
                                    <?php if (isset($_COOKIE['id_employee_login'])) { ?>
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
                                @click="btnLogin();">
                                Ingresar
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
    
    <pre>{{ $v.form }}</pre>

</div>

<?php
    if (isset($_SESSION["validate_sesion"]) && $_SESSION["validate_sesion"] == "ok") {
        echo "<script>
                window.location = '" . SERVERURL . "?route=admin';
            </script>";
    }
    if (isset($_POST["id_employee_login"]) && isset($_POST["password_login"])) {
        LoginController::getLoginController();
    }
?>