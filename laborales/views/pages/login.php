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

                <form action="" 
                    method="post"
                    autocomplete="off"
                    class="login_form">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <input type="text" 
                            class="form-control" 
                            placeholder="Cédula" 
                            name="id_employee_login"
                            id="id_employee_login"
                            require
                            value="<?php if (isset($_COOKIE['id_employee_login'])) { echo $_COOKIE['id_employee_login']; } ?>"
                            data-inputmask="'alias': 'integer', 'groupSeparator': '.'" 
                            data-mask>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" 
                            class="form-control" 
                            placeholder="Contraseña"
                            name="password_login"
                            id="password_login"
                            require
                            value="<?php if (isset($_COOKIE['id_employee_login'])) { echo $_COOKIE['password_login']; } ?>">
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
                                class="btn btn-primary btn-block">
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