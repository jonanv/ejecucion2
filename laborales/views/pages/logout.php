<?php
    // destruye las variables de sesion
	session_destroy();

	//  redirecciona al a ruta del servidor
	echo '<script>	
			window.location = "' . SERVERURL . '?route=login";
		</script>';