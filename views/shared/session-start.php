<?php
    if (!isset($_SESSION["validate_sesion_ejecucion"]) && $_SESSION["validate_sesion_ejecucion"] != "ok") {
        echo "<script>
                window.location = '" . SERVERURL . "?route=login';
            </script>";
    }
?>