<?php

class indexModel extends modelBase

{

    /***********************************************************************************/

    /*----------------------- validar el inicio de sesion -----------------------------*/

    /***********************************************************************************/	

	public function validate_user()

	{

		$band=0;

	    $user = $_POST['user'];
    	$pass = md5 ($_POST['pass']); 

					

		$select = $this->db->prepare('SELECT  usuario.id,usuario.nombre_usuario,usuario.idperfil,usuario.empleado,usuario.contrasena,perfil.nombre,usuario.foto, 
		                              usuario.tipo_perfil,usuario.pantalla, usuario.ingreso,usuario.id_juzgado,usuario.tipousuario,usuario.ipplataforma
									  FROM pa_usuario as usuario
									  inner join pa_perfil  as perfil
									  ON (usuario.idperfil = perfil.id)
		                              WHERE usuario.nombre_usuario = :user AND  usuario.contrasena = :pass
									  AND ingreso_activo = 1');

		$select->bindParam(':user', $user);

		$select->bindParam(':pass', $pass);

		$select->execute();
		
		while($field = $select->fetch())
        {
		 
		
		 $usua_perfil   = $field['nombre'];
	     $usua_empleado = $field['empleado'];
		 $usua_nom      = $field['nombre_usuario'];
		 $usua_idperfil = $field['idperfil'];
		 $usua_id       = $field['id'];
		 $foto          = $field['foto'];
		 $tipo_perfil   = $field['tipo_perfil'];
		 $pantalla      = $field['pantalla'];
		 $estado        = $field['ingreso'];
		 $id_juzgado    = $field['id_juzgado'];
		 $tipousuario   = $field['tipousuario'];
		 $ipplataforma  = $field['ipplataforma'];
		 $band          = 1;
		
		}

		
			$_SESSION['id']           = $usua_perfil;
			$_SESSION['nombre']       = $usua_empleado;
			$_SESSION['idUsuario']    = $usua_id;
			$_SESSION['nomusu']       = $usua_nom; 
			$_SESSION['foto']         = $foto; 
			$_SESSION['tipo_perfil']  = $tipo_perfil; 
			$_SESSION['pantalla']     = $pantalla; 
			$_SESSION['ingreso']      = $estado;
			$_SESSION['id_juzgado']   = $id_juzgado;
			$_SESSION['tipousuario']  = $tipousuario;
			$_SESSION['ipplataforma'] = $ipplataforma;
			
			
		if ($usua_perfil == "Administrador"){
		
	
			$_SESSION['rol'] = 'Administrador';	
			header("refresh: 0; URL=/ejecucion/");
			die();		

			}

			else if ($usua_perfil == "Archivo"){
			
		

			$_SESSION['rol'] = 'Archivo';
			header("refresh: 0; URL=/ejecucion/");
			die();

			}
			else if ($usua_perfil == "Correspondencia"){
			
		    //echo "entre_model";

			$_SESSION['rol'] = 'Correspondencia';
			header("refresh: 0; URL=/ejecucion/");
			die();

			}

			
		

				

		if ($band==0)

		{

		
			$_SESSION['invalidate_user'] = true;

		}
	}
}		 



?>