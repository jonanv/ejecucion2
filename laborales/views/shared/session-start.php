<?php
    if (!isset($_SESSION["validate_sesion_laborales"]) && $_SESSION["validate_sesion_laborales"] != "ok") {
        echo "<script>
                window.location = '" . SERVERURL . "?route=login';
            </script>";
    }
?>