<?php
    if (!isset($_SESSION["validate_sesion"]) && $_SESSION["validate_sesion"] != "ok") {
        echo "<script>
                window.location = '" . SERVERURL . "?route=login';
            </script>";
    }
?>