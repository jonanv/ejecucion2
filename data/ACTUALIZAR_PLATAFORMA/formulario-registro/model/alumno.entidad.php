<?php
    class Alumno
    {
        private $id;
       	private $nombre_usuario;
		private $idperfil;
		private $tipo_perfil;
		private $empleado;
		private $contrasena;
		private $idareaempleado;
		private $pantalla;
		private $fecha;
		private $hora;
		private $tipousuario;

        public function __GET($k){ return $this->$k; }
        public function __SET($k, $v){ return $this->$k = $v; }
    }

?>