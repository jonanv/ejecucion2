<?php
require_once 'model/alumno.entidad.php';
require_once 'model/alumno.model.php';

class AlumnoController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new AlumnoModel();
    }
    
    public function Index(){
	
        require_once 'view/header.php';
        require_once 'view/alumno/alumno.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Alumno();
        
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once $alm->id > 0 
                        ? 'view/alumno/alumno-editar.php'
                        : 'view/alumno/alumno-nuevo.php'
                        ;
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Alumno();
        
        $alm->__SET('id',              $_REQUEST['id']);
        $alm->__SET('Nombre',          $_REQUEST['Nombre']);
        $alm->__SET('Apellido',        $_REQUEST['Apellido']);
        $alm->__SET('Sexo',            $_REQUEST['Sexo']);
        $alm->__SET('FechaNacimiento', $_REQUEST['FechaNacimiento']);
        $alm->__SET('Correo',          $_REQUEST['Correo']);
        $alm->__SET('Foto',            $_REQUEST['Foto']);
        
        if( !empty( $_FILES['Foto']['name'] ) ){
            $foto = date('ymdhis') . '-' . strtolower($_FILES['Foto']['name']);
            move_uploaded_file ($_FILES['Foto']['tmp_name'], 'uploads/' . $foto);
            
            $alm->__SET('Foto', $foto);
        }

        if($alm->__GET('id') != '' ? 
           $this->model->Actualizar($alm) : 
           $this->model->Registrar($alm));
        
        header('Location: index.php');
    }
    
    public function CrearMultiple()
    {
	
			$controller_1 = new AlumnoController();
			
			//FECHA - HORA
			date_default_timezone_set('America/Bogota'); 
			$fecharegistro = date('Y-m-d');
			$horaregistro  = date('H:i');
			
			
			foreach($this->model->Validar_Usuario_Urna($_POST['nombre_usuario'][0]) as $r):
			
				$existe_usuario_u =  $r->__GET('id');
				$nusuario_u       =  $r->__GET('doc');
			
			endforeach;
			
			//USUARIO EXISTE EN LA URNA DE ABOGADOS
			//Y ES POSIBLE SU REGISTRO EN LA PLATAFORMA
			if($existe_usuario_u >= 1){
			
			
				foreach($this->model->Obtener_Usuario($_POST['nombre_usuario'][0]) as $r):
				
					$existe_usuario =  $r->__GET('id');
					$nusuario       =  $r->__GET('nombre_usuario');
				
				endforeach;
			
				
				if($existe_usuario >= 1){
				
					
					//$empleado   = $_POST['empleado'][0];
					//$contrasena = md5($_POST['contrasena'][0]);
				
					echo '<script languaje="JavaScript"> 
					
							var nusuario = "'.$nusuario.'";
										
							alert("Usuario ya Exsite: "+nusuario);
					
						</script>';
						
					
					 //header("refresh: 0;URL=/ramajudicialpublica/formulario-registro/?c=Alumno&a=Crud&existe_usuario=".$existe_usuario."&contrasena=".$contrasena."&empleado=".$empleado);
					 
					 header("refresh: 0;URL=/ramajudicialpublica/formulario-registro/?c=Alumno&a=Crud");
				
				}
				else{
				
					for($i = 0; $i < count($_POST['nombre_usuario']); $i++)
					{
						$alm = new Alumno();
		
						$alm->__SET('nombre_usuario',  utf8_decode($_POST['nombre_usuario'][$i]));
						$alm->__SET('empleado',        utf8_decode($_POST['empleado'][$i]));
						//$alm->__SET('empleado',        $_POST['empleado'][$i]);
						$alm->__SET('contrasena',      md5($_POST['contrasena'][$i]));
						
					   
						
						$idperfil       = 1;
						$tipo_perfil    = 'admin';
						$idareaempleado = 2;
						$pantalla       = 'ABOGADO';
						$tipousuario    = 'PUBLICO';
						$foto           = 'views/fotos/usuario.png';
						
						$alm->__SET('idperfil',       $idperfil);
						$alm->__SET('tipo_perfil',    $tipo_perfil);
						$alm->__SET('idareaempleado', $idareaempleado);
						$alm->__SET('pantalla',       $pantalla);
						$alm->__SET('fecha',          $fecharegistro);
						$alm->__SET('hora',           $horaregistro);
						$alm->__SET('tipousuario',    $tipousuario);
						
						$alm->__SET('foto',    $foto);
						
		
						$this->model->Registrar($alm);    
								
					}
					
					$controller_1->RamapublicaMSG();
					
				}
				
			}
			else{
			
					echo '<script languaje="JavaScript"> 
					
							var nusuario_u = "'.$nusuario_u.'";
										
							alert("Regsitro Invalido, Usuario no Existe en la Base de Datos de la Unidad de Registro Nacional de Abogados del Consejo Superior de la Judicatura, registrado en el Sistema de Información- SIRNA, por Favor Realice Registro. "+nusuario_u);
					
						</script>';
						
					
					 header("refresh: 0;URL=/ramajudicialpublica/formulario-registro/?c=Alumno&a=Crud");
			
			}
			
			//header("refresh: 0;URL=/ramajudicialpublica/");
			
            //header('Location: index.php');
    }
    
    public function Excel(){
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=mi_archivo.xls");
        header("Pragma: no-cache");
        header("Expires: 0");    
        
        require_once 'view/alumno/alumno-excel.php';
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
	
	
	public function Ramapublica(){
	
        header("refresh: 0;URL=/ramajudicialpublica/");
    }
	
	public function RamapublicaMSG(){
	
		echo '<script languaje="JavaScript"> 
									
				alert("Registro de Usuario Realizado Correctamente");
				
			  </script>';
	
        header("refresh: 0;URL=/ramajudicialpublica/");
    }
	
}

?>