<?php
class UserModel extends ModelBase
{

	 /***********************************************************************************/
    /*----------------------------- Mensajes ---------------------------------------*/
    /***********************************************************************************/
      public function mensajes()
  {
     $condicion=$_GET['nombre'];
	 
	 if($condicion==1)
	 {
	  $_SESSION['elemento'] = "Los datos han sido actualizados correctamente";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_configuracion"</script>';
	 }
	 if($condicion==2)
	 {
	  $_SESSION['elemento'] = "Usted no tiene permisos para actualizar la contrase&ntilde;a";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_user"</script>';
	 }
     if($condicion==3)
	 {
	  $_SESSION['elemento'] = "Mensaje enviado exitosamente";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_configuracion"</script>';
	 }
	 if($condicion==4)
	 {
	  $_SESSION['elemento'] = "Los datos han sido actualizados correctamente";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_estado"</script>';
	 }
	  if($condicion==5)
	 {
	  $_SESSION['elemento'] = "Los datos han sido eliminados correctamente";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_estado"</script>';
	 }
	  if($condicion==6)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_estado"</script>';
	 }
	  if($condicion==7)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_tipo"</script>';
	 }
	  if($condicion==8)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_salarios"</script>';
	 }
	if($condicion==9)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_titulos"</script>';
	 }
	if($condicion==10)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_nivel"</script>';
	 } 
	 if($condicion==11)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_pais"</script>';
	 } 
	if($condicion==12)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_departamento"</script>';
	 } 
	if($condicion==13)
	 {
	  $_SESSION['elemento'] = "No es posible eliminar este registro";
	  $_SESSION['elem_conscontrato'] = true;
	  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_municipio"</script>';
	 } 
	
}	 
  /***********************************************************************************/
  /*------------------------------ Cambiar foto--------------------------------------*/
  /***********************************************************************************/
  public function subirfoto()
  {

  $nom=$_SESSION["idUsuario"];

  $consultar = $this->db->prepare("SELECT nombre_usuario FROM pa_usuario WHERE id='$nom'" );
  $consultar->execute();
  
  while($field = $consultar->fetch())
  {
   $nombre = $field[nombre_usuario];
  }


		
	$nombre_archivo = $nombre;

    $path="views/fotos/";
  	 
	$tipo_archivo = $_FILES['documento']['type'];

    $tamano_archivo = $_FILES['documento']['size'];
	
	$ext = strrchr($_FILES['documento']['name'],'.'); 
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo.$ext;
	  }
	  else
	  {
	   $ruta="";
	  }

   	 $band=0;

   	if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))

  	{ 

  
    	$registrar = $this->db->prepare("UPDATE pa_usuario SET Foto = '$ruta' WHERE id = '$nom'" );

  		$registrar->execute();

			

   	}    
           print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';

  }
 
    /***********************************************************************************/
	/*------------------------------  Listar Datos Usuario ----------------------------*/
	/***********************************************************************************/
	public function listAdministrador()
	{
		$login= $_SESSION['id'];
		$listar = $this->db->prepare('SELECT * FROM administrador WHERE adm_login = :login');
		$listar->bindParam(':login', $login);
		$listar->execute();
		return $listar;
		
	}
	/***********************************************************************************/
	/*------------------------------  Listar Datos Usuario ----------------------------*/
	/***********************************************************************************/
	public function listUser()
	{
		$login= $_SESSION['idUsuario'];
		$listar = $this->db->prepare('SELECT * FROM pa_usuario 
		inner join pa_areaempleado on (pa_usuario.idareaempleado=pa_areaempleado.id) 
		WHERE pa_usuario.id = :login');
		$listar->bindParam(':login', $login);
		$listar->execute();
		return $listar;
		
	}
	/***********************************************************************************/
	/*--------------------------------------  Tipo Usuario ----------------------------*/
	/***********************************************************************************/
	public function tipoUser()
	{
		$cedula = $_SESSION['id'];
		
		$listar = $this->db->prepare("SELECT COUNT(*) FROM usuarioadmin WHERE usua_login = '$cedula'");
		$listar->execute();
		while($row = $listar->fetch()){
          $band=1;
		  $num=$row[0]; 
		  }
        if($num==0)
		{
		 //Ejecutivio de Cuenta
		 $tipo=1;
		}
		else
		{
		 //Ejecutivo de Apoyo
		 $tipo=0;
		}
		if($_SESSION['rol']=='Produccion')
		{
		 $tipo=2;
		}
		return $tipo;

	}
	/***********************************************************************************/
  /*------------------------------ Obtener foto  ----------------------------------*/
  /***********************************************************************************/
  public function obtFoto()
  {
  $id=$_SESSION['idUsuario'];
  $listar = $this->db->prepare("SELECT Foto FROM usuario WHERE id='$id'");
  $listar->execute();
  
  while($row = $listar->fetch()){
  $foto=$row['Foto']; }
  return $foto;

  
  }	
  /***********************************************************************************/
  /*---------------------------- Modificar Administrador -------------------------------*/
  /***********************************************************************************/
  public function actualizarAdministrador()
  {
  $adm_nombre=$_POST['nombre'];
  $adm_telefono=$_POST['telefono'];
  $adm_login=$_SESSION['id'];
  $adm_email=$_POST['email'];		
  
 
 
 $modificar = $this->db->prepare("UPDATE administrador SET adm_nombre='$adm_nombre',adm_telefono='$adm_telefono',adm_email='$adm_email' WHERE adm_login='$adm_login' ");
 
 $modificar->execute(); 
 $resultado = $modificar->rowCount();
if ($resultado)
 {			
  print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';
 }
 else
 {
  print'<script languaje="Javascript">location.href="index.php?controller=user&action=show_user"</script>';
 
 }
 


  
  
 }	
 /***********************************************************************************/
  /*------------------- Actualizar Contrasena Administrador ------------------------*/
  /***********************************************************************************/
  public function actualizarContrasenaAdministrador()
  {
  $adm_contrasena=md5($_POST['Contrasena']);
  $adm_login=$_SESSION['id'];
  $codigo=$adm_login;
  $clave=$_POST['Contrasena2'];
  $pass = md5($clave);
  
  $seleccionar = $this->db->prepare("SELECT administrador.adm_login
FROM administrador WHERE administrador.adm_login = '$adm_login' AND
administrador.adm_contrasena = '$pass'");

                $seleccionar->execute();

                if($field = $seleccionar->fetch()){
                       $actualizar = $this->db->prepare("UPDATE administrador SET
adm_contrasena = '$adm_contrasena' WHERE adm_login = '$codigo'");
                $actualizar->execute();
                print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';

                }
                else {
                print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=2"</script>';
                  }

                 }
	
	
	
	/***********************************************************************************/
	/*------------------------------  Listar Empleados --------------------------------*/
	/***********************************************************************************/
	public function listarEmpleados()
	{
		
		$consulta = $this->db->prepare("SELECT * FROM  empleado ");
		$consulta->execute(); 		
	
	return $consulta;
	}	
	/***********************************************************************************/
	/*------------------------------  Listar Clientes --------------------------------*/
	/***********************************************************************************/
	public function listarClientes()
	{
		
		$consulta = $this->db->prepare("SELECT * FROM  cliente ");
		$consulta->execute(); 		
	
	return $consulta;
	}	
	
	  /***********************************************************************************/
  /*------------------------- Generar Contrasenas  ----------------------------------*/
  /***********************************************************************************/
 public	function generar_contrasena()
{
    $cadena='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $contrasena = "";

    for($i=0;$i<7;$i++) {
        $contrasena .= substr($cadena,rand(0,62),1);
    }
    return $contrasena;
}
/***********************************************************************************/
	/*-------------------------------------  Recordar Contrasena ---------------------*/
	/***********************************************************************************/
	public function recordarcontrasena()
	{
	
		$email = $_POST['correo'];
		$user  = $_POST['user'];
		$ls = new userModel();
		
		$consulta = $this->db->prepare("SELECT COUNT(*) from egresado WHERE egresado.egr_documento='$user' AND egresado.egr_email='$email'");
		$consulta->execute();
		
		while($row = $consulta->fetch())
		{
		 $consultaa = $row[0];
		}
		
		
		if($consultaa!=0)
		{
		 $npassw = $ls->generar_contrasena();
		 $texto = "Apreciado asociado, reciba un cordial saludo. Hemos recibido su solicitud y 
nuestro sistema ha generado su nueva Contraseña. \n";
         $texto .= "Nombre de Usuario = $user\n";
         $texto .= "Contraseña = $npassw \n";
         mail("$email","Contraseña de Usuario", $texto, "FROM:  contacto@uamegresados.org\nX-Mailer: PHP");

         $pass = md5($npassw);
		 $consulta1 = $this->db->prepare("UPDATE egresado SET egresado.egr_contrasena='$pass' WHERE egresado.egr_documento='$user'");
		 $consulta1->execute();
		 		 	
		}
		else
		{
		 $npassw = $ls->generar_contrasena();
		 $texto = "Apreciado usuario, reciba un cordial saludo. Hemos recibido su solicitud y 
nuestro sistema ha generado su nueva Contraseña. \n";
         $texto .= "Nombre de Usuario = $user\n";
         $texto .= "Contraseña = $npassw \n";
         mail("$email","Contraseña de Usuario", $texto, "FROM:  contacto@uamegresados.org\nX-Mailer: PHP");

         $pass = md5($npassw);
		 $consulta1 = $this->db->prepare("UPDATE empresa SET empresa.emp_contrasena='$pass' WHERE empresa.emp_nit='$user'");
		 $consulta1->execute();
		
		
		}
		 
		
	print'<script languaje="Javascript">location.href="index.php?controller=index&action=login_user"</script>';

	//return $consulta;
	}
       

 /***********************************************************************************/

	/*----------------------------  Actualizar Datos Usuario  ------------------------*/

	/***********************************************************************************/

	public function updateUser()

	{
	
	  $Nombre = $_POST['Nombre'];
	  
	  $id=$_SESSION["idUsuario"];;
 

	 $modificare = $this->db->prepare("UPDATE pa_usuario SET  empleado = '$Nombre' WHERE id = '$id'");  
	 
	

  $modificare->execute(); 

  	

	$resultado = $modificare->rowCount();

      if ($resultado)

      {			

        print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';
 
	   

      }


   	
 }   
 	 /***********************************************************************************/

	/*----------------------------  Actualizar Datos Usuario  ------------------------*/

	/***********************************************************************************/

	public function passwordUser()

	{
	
	$Contrasena = $_POST['Contrasena'];
	$Contrasena = md5($Contrasena);
	$id= $_SESSION['idUsuario'];
 

	 $modificare = $this->db->prepare("UPDATE pa_usuario SET  contrasena = '$Contrasena' WHERE id = '$id'");  
	 $modificare->execute(); 

  	

	$resultado = $modificare->rowCount();

      if ($resultado)

      {			

        print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';
 
	   

      }


   	
 }
 /***********************************************************************************/
  /*------------------------------ Enviar Correo Electronico-----------------------*/
  /***********************************************************************************/
  public function semailUser()
  {
  $nom=$_SESSION["idUsuario"];
  
  $consultar = $this->db->prepare("SELECT Email from usuario WHERE id = '$nom'");  
  $consultar->execute(); 
  
  while($field = $consultar->fetch())
  {
  
   $remitente = $field[Email];
  }

  
  
  
  $email = $_POST["contacto"];
  $asunto= $_POST["asunto"];
  $texto = $_POST["cuerpo"];
  
  $vemail = explode(",",$email);
  
  $header = "From:CRM\nReply-To:".$remitente."\n";
  $header .= "X-Mailer:PHP/".phpversion()."\n";
  $header .= "Mime-Version: 1.0\n";
  $header .= "Content-Type: text/html";
  
  $text='
	<html>
	<table width="721" border="0">
	  <tr>
		<td width="248"><div align="center"><img src="www.hotelcarretero.com/crmhc/views/images/logo.JPG" width="248" height="160" /></div></td>
		<td width="463"><p>Mensaje de correo electr&oacute;nico enviado desde el Sistema CRM - Hotel Carretero </p>
		  <p>'.$texto.'</p>
		<p>Gracias por ingresar a :  http://www.hotelcarretero.com/crmhc  </p>
		<p>&nbsp;</p></td>
	  </tr>
	  <tr>
    <td colspan="2"><div align="center"><img src="" width="166" height="41" /></div></td>
  </tr>
</table>
	</html>
	';	
	
	$mailsend = mail($email, $asunto, $text, $header);			
	
	
	
	 $prod= $this->db->prepare("SELECT usua_codigo, usua_nombre, usua_login FROM usuarioadmin");//condicion para q se guarde el log q corresponda a el usuario registrado.

   $prod->execute(); 

  

 $band=0;
  while($ejeres=$prod->fetch())

  {
  
  if($band==0)
 {  
    $respo =$ejeres['usua_codigo'];
    $nomres=$ejeres['usua_login'];
    if($nomres == $_SESSION['id'])
   {
   
       
    $respo=$ejeres['usua_codigo'];
    $nomres=$ejeres['usua_nombre'];
    $band=1;
   }
   
}
  }

  

	  

	  date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fecha=$horaa[0];

      $hora=$horaa[1]; 
	   $idu=$_SESSION['idUsuario'];
	   $foto1= $this->db->prepare("SELECT Foto FROM usuario WHERE id = '$idu'");
	   $foto1->execute(); 
	  
	   while($fot=$foto1->fetch())
	   {
		 $resp = $fot[0];
	   }	  

  
 
      //es de tipo 13 por que va relacionado con correos
      $accion='Envio&oacute; Correo';

      $detalle=$nomres." "."Envio&oacute; Correo a:".$email." ".$fecha." "."a las: ".$hora;
	    	
      $tipolog=13;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	
	
	
	
	
	 if ($mailsend) {
		 date_default_timezone_set('America/Bogota'); 
 		 $fechaa=date('Y-m-d g:ia');
  
	    }
		print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=3"</script>';
	
  
  
  }	 
  
     /***********************************************************************************/
	/*------------------------------  Listar perfil uusarios ----------------------------*/
	/***********************************************************************************/
	public function listPerfilUsuario()
	{
		
		$listar = $this->db->prepare("SELECT * FROM pa_perfil");
		$listar->execute();
		
		return $listar;
		
	}   
	
     /***********************************************************************************/
	/*------------------------------  Listar areas uusarios ----------------------------*/
	/***********************************************************************************/
	public function listAreaUsuario()
	{
		
		$listar = $this->db->prepare("SELECT * FROM pa_areaempleado");
		$listar->execute();
		
		return $listar;
		
	}  	
 	
 /***********************************************************************************/

	/*----------------------------  Registrar Usuario  ------------------------*/

	/***********************************************************************************/

	public function registrarUsuario()

	{
	
	  $empleado 			= $_POST['empleado'];
	  $nombre_usuario 		= $_POST['cedula'];
	  $idperfil 			= $_POST['perfil'];
	  $tipo_perfil 			= $_POST['administrador'];
	  $contrasena 			= md5($_POST['pass']);
	  $iniciales_reporte 	= $_POST['iniciales'];
	  $idareaempleado 		= $_POST['area'];
	  $idestadoempleado 	= $_POST['estado'];
	  
	  if($tipo_perfil == 'SI')
	  {
	   $tipo_perfil = 'admin';
	  }
	  else
	  {
	   $tipo_perfil = 'empleado';
	  }	
 

	 $insertar = $this->db->prepare(" INSERT INTO pa_usuario (nombre_usuario,idperfil,tipo_perfil,empleado,contrasena,iniciales_reporte,idareaempleado,idestadoempleado) 
	 VALUES ('$nombre_usuario','$idperfil','$tipo_perfil','$empleado','$contrasena','$iniciales_reporte','$idareaempleado','$idestadoempleado')");  
	  $insertar->execute(); 

  	

	$resultado = $insertar->rowCount();

      if ($resultado)

      {			

        print'<script languaje="Javascript">location.href="index.php?controller=user&action=mensajes&nombre=1"</script>';
 
	   

      }


   	
 }
 
 public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
	$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  	$listar->execute();

  	return $listar;
	
}
}
?>