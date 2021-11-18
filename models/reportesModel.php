<?php

class reportesModel extends modelBase

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

	  if($_SESSION['id']=='admin'){

	  print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';}

	  }

	 

	

	 

    if($condicion==2)

	 {

	  $_SESSION['elemento'] = "Los datos han sido registrados correctamente";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';

	 }

	 if($condicion==3)

	 {

	  $_SESSION['elemento'] = "Los datos han sido eliminados correctamente";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';

	 }

	  if($condicion==4)

	 {

	  $_SESSION['elemento'] = "No tiene permisos para modificar la contrase&ntilde;a";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=empresa&action=contrasena"</script>';

	 }

	 if($condicion==5)

	 {

	  $_SESSION['elemento'] = "Debe verificar el n&uacute;mero de NIT";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=empresa&action=consultar"</script>';

	 }

	 if($condicion==6)

	 {

	  $_SESSION['elemento'] = "Debe verificar el n&uacute;mero de NIT";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=egresado&action=consultar"</script>';

	 }

	 if($condicion==7)

	 {

	  $_SESSION['elemento'] = "Debe verificar el n&uacute;mero de NIT";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=empresa&action=listar"</script>';

	 }

	 if($condicion==8)

	 {

	  $_SESSION['elemento'] = "Los datos han sido eliminados correctamente";

	  $_SESSION['elem_conscontrato'] = true;

	  print'<script languaje="Javascript">location.href="index.php?controller=oferta&action=listarofertas"</script>';

	 }

  

  }	

  

  

  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogReportes()

  {

  

	  $listar = $this->db->prepare("SELECT * FROM logcrm WHERE tipoLogcrm=9 ORDER BY idLogcrm DESC LIMIT 15");

	  $listar->execute();

	  return $listar; 

  
  }	

    /***********************************************************************************/

  /*------------------------------ Listar Servicios ---------------------------------------*/

  /***********************************************************************************/

  public function listServicio()

  {

  

	  $listar = $this->db->prepare("SELECT * FROM serviciorestaurante");

	  $listar->execute();

	  return $listar; 

  
  }	
     /***********************************************************************************/

  /*------------------------------ Listar Servicio ---------------------------------------*/

  /***********************************************************************************/

  public function listarServicio()

  {

	  $id = $_GET['nombre'];
	  
	  $listar = $this->db->prepare("SELECT * FROM serviciorestaurante WHERE idRestaurante='$id'");

	  $listar->execute();

	  return $listar; 

  
  }	
     /***********************************************************************************/

  /*------------------------------ Listar Extras ---------------------------------------*/

  /***********************************************************************************/

  public function listExtras()

  {

  

	  $listar = $this->db->prepare("SELECT * FROM extrasrestaurante");

	  $listar->execute();

	  return $listar; 

  
  } 
    /***********************************************************************************/

  /*------------------------------ Listar Turnos r ---------------------------------------*/

  /***********************************************************************************/

  public function listTurnosR()

  {

  

	  $listar = $this->db->prepare("SELECT * FROM turnosrestaurante");

	  $listar->execute();

	  return $listar; 

  
  } 

 /***********************************************************************************/

  /*------------------------------ Subir Documento -----------------------------------*/

  /***********************************************************************************/

  public function subirDocumento()

  {

  	$NombreInforme=$_POST['NombreInforme'];

  	$idInforme_idEmpleado=$_POST['idInforme_idEmpleado'];

  	$DescripcionInforme=$_POST['DescripcionInforme'];

    $fechasubida = date("d-m-Y");

	$area = 9;
	
	$path="views/InformeEmpleados/";

  	$nombre_archivo = $NombreInforme; 

	$tipo_archivo = $_FILES['documento']['type'];

    $tamano_archivo = $_FILES['documento']['size'];
	
	$ext = strrchr($_FILES['documento']['name'],'.'); 
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo."_".$fechasubida.$ext;
	  }
	  else
	  {
	   $ruta="";
	  }

  

  	$band=0;

   	if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))

  	{ 

  

  			$registrar = $this->db->prepare("INSERT INTO informes (NombreInforme,  DescripcionInforme,ArchivoInforme,area) VALUES ( '$NombreInforme', '$DescripcionInforme', '$ruta','$area')" );

  			$registrar->execute();

			

   	} 
  	$resultado = $registrar->rowCount();
	
	
	
 if($_SESSION['id']!="")
{

   $prod= $this->db->prepare("SELECT usua_codigo, usua_nombre, usua_login FROM usuarioadmin");//condicion para q se guarde el log q   corresponda a el usuario registrado.
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

   $accion='Subi&oacute; Informe';

   $detalle=$nomres." "."Subi&oacute; el Informe:".$NombreInforme." ".$fecha." "."a las: ".$hora;

      //es de tipo 9 por que va relacionado con el modulo de AyB

      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute();
	

 	if ($resultado)

  	{

		$_SESSION['elemento'] = "El Informe Subio al CRM correctamente con fecha ".$fechasubida;

		$_SESSION['elem_conscontrato'] = true;  

  	}

	

   	print '<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';

  }

  

	

	/***********************************************************************************/

  /*------------------------------  Listar Documentos ----------------------*/

  /***********************************************************************************/

  public function listarDocumentos()

  {

  

  $listar = $this->db->prepare("SELECT * FROM informes WHERE area = 9 order by NombreInforme");

  $listar->execute();

  return $listar;

  

  }

  

  /***********************************************************************************/

	/*------------------------------  registrar qrs --------------------*/

	/***********************************************************************************/

	public function registrarQRS()

	{

		$descripcion=$_POST['descripcion'];

		$tipo=$_POST['tipo'];

		$area=9;
		
	    date_default_timezone_set('America/Bogota'); 

	    $hora = date('g:i a');

		$fecha = date("Y-m-d");

		$responsable = $_POST['responsable'];
		
		$cliente = $_POST['cliente'];
 
	    $registrar = $this->db->prepare("INSERT INTO qrs (area, tipo, descripcion, fecha, hora, responsable, cliente) VALUES ('$area', '$tipo', '$descripcion', '$fecha', '$hora', '$responsable', '$cliente')");

		

		$registrar->execute();	
		
		$resultado = $registrar->rowCount();  
	  	
		if($_SESSION['id']!=""){

   		$prod= $this->db->prepare("SELECT usua_codigo, usua_nombre, usua_login FROM usuarioadmin");
		//condicion para q se guarde el log q corresponda a el usuario registrado.

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de AYB
      $accion='Registr&oacute; pqr';

      $detalle=$nomres." "."Registr&oacute; pqr: ".$tipo." ".$fecha." "."a las: ".$hora;
	
	
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) 						VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	$email = $_POST["cliente"];
	$texto = "Su ".$tipo." ha sido registrad@ satisfactorio en el sistema CRM \n";
	$texto .= "Gracias por ingresar a www.hotelcarretero.com \n";
	$texto .= "Gracias por su ".$tipo."\n";
	mail("$email","Registro de pqr", $texto, "FROM:contacto@hotelcarretero.com\nX-Mailer: PHP");	
	  
	  

	   if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=2"</script>';

      }

		

	}



	

	/***********************************************************************************/

  /*------------------------------  Listar qrs ----------------------*/

  /***********************************************************************************/

  public function listarQRS()

  {

  

  $listar = $this->db->prepare("SELECT * FROM qrs WHERE area = 9 order by fecha");

  $listar->execute();

  return $listar;

  

  }

  

  /***********************************************************************************/

  /*------------------------------  cosultar qrs ----------------------*/

  /***********************************************************************************/

  public function consultarQRS()

  {

  

  $codigo= $_GET['codigo'];

  $listar = $this->db->prepare("SELECT * FROM qrs WHERE codigo='$codigo'");

  $listar->execute();

  return $listar;

  

  }
  
 /***********************************************************************************/

  /*------------------------------ Registrar Receta --------------------------------*/

  /***********************************************************************************/

  public function regReceta()

  {

	   $NombreReceta=$_POST['NombreReceta'];

	   $IngredientesReceta=$_POST['IngredientesReceta'];
	   
	   $PreparacionReceta=$_POST['PreparacionReceta'];
  
	   $path="views/receta/";
	  
	   $nombre_archivo = $NombreReceta; 
	  
	   $tipo_archivo = $_FILES['documento']['type'];
	  
	   $tamano_archivo = $_FILES['documento']['size'];
	  
	   $band=0;
	  
	   $ext = strrchr($_FILES['documento']['name'],'.'); 
	  
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo."".$ext;
	  }
	  else
	  {
	   $ruta="";
	  }
	  
	  
	   if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))
	  {
	  	   
	  }
	 
	  
	  $registrar = $this->db->prepare("INSERT INTO receta (NombreReceta, IngredientesReceta, FotoReceta ,PreparacionReceta) VALUES ('$NombreReceta', '$IngredientesReceta','$ruta','$PreparacionReceta')" );
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Registr&oacute; Receta';

      $detalle=$nomres." "."Registr&oacute; Receta: ".$NombreReceta." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
	  
	  

	   if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=2"</script>';

      }

    

	 

 
 }
 
   /***********************************************************************************/

  /*------------------------------  Listar Recetas  ----------------------*/

  /***********************************************************************************/

  public function listarRecetas()

  {

  
  $listar = $this->db->prepare("SELECT * FROM  receta");

  $listar->execute();

  return $listar;

  

  }
    /***********************************************************************************/

  /*------------------------------  Listar Receta especifica  ----------------------*/

  /***********************************************************************************/

  public function listarReceta()

  {

  
  $id = $_GET['nombre']; 
    
  $listar = $this->db->prepare("SELECT * FROM  receta WHERE idReceta='$id'");

  $listar->execute();

  return $listar;

  

  }
  /***********************************************************************************/

  /*------------------------------ Modificar Receta --------------------------------*/

  /***********************************************************************************/

  public function updateReceta()

  {

	   $idReceta = $_POST['idReceta'];
		   
	   $NombreReceta=$_POST['NombreReceta'];

	   $IngredientesReceta=$_POST['IngredientesReceta'];
	   
	   $PreparacionReceta=$_POST['PreparacionReceta'];
  
	   $path="views/receta/";
	  
	   $nombre_archivo = $NombreReceta; 
	  
	   $tipo_archivo = $_FILES['documento']['type'];
	  
	   $tamano_archivo = $_FILES['documento']['size'];
	  
	   $band=0;
	  
	   $ext = strrchr($_FILES['documento']['name'],'.'); 
	  
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo."".$ext;
	  }
	  else
	  {
	   $ruta="";
	  }
	  
	  
	   if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))
	  {
	  	   
	  }
	 
	  if($ruta!="")
	  {
	  $registrar = $this->db->prepare("UPDATE receta  SET NombreReceta='$NombreReceta' , IngredientesReceta='$IngredientesReceta', FotoReceta='$ruta', PreparacionReceta='$PreparacionReceta' WHERE idReceta='$idReceta'" );
	  $registrar->execute(); 
	  }
	  else
	  {
	  $registrar = $this->db->prepare("UPDATE receta  SET NombreReceta='$NombreReceta' , IngredientesReceta='$IngredientesReceta', PreparacionReceta='$PreparacionReceta' WHERE idReceta='$idReceta'" );
	  $registrar->execute();  
	  
	  }
	  
	  
	  
	  $resultado = $registrar->rowCount();
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Modific&oacute; Receta';

      $detalle=$nomres." "."Modific&oacute; Receta: ".$NombreReceta." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
	  
	  

	   if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=2"</script>';

      }

    

	 

 
 }

	
 /***********************************************************************************/

  /*------------------------------ Eliminar Receta --------------------------------*/

  /***********************************************************************************/

  public function EliminarReceta()

  {

	   $idReceta = $_GET['nombre'];
		   
	   
	  $registrar = $this->db->prepare("DELETE FROM receta  WHERE idReceta='$idReceta'" );
	  $registrar->execute();  
	  
	  
	  
	  
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Elimin&oacute; Receta';

      $detalle=$nomres." "."Eliminoacute; Receta "." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
	  
	  



       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=3"</script>';


    

	 

 
 }

/***********************************************************************************/

  /*------------------------------ Registrar Servicio --------------------------------*/

  /***********************************************************************************/

  public function regServicio()

  {

	   $FechaRestaurante=$_POST['FechaRestaurante'];

	   $ServiciosRestaurante=$_POST['ServiciosRestaurante'];
	   
	   $TipoServicioRestaurante=$_POST['TipoServicioRestaurante'];
	   
	   $NumeroPersonasRestaurante=$_POST['NumeroPersonasRestaurante'];
	   
	   $NumeroRefrigeriosRestaurante=$_POST['NumeroRefrigeriosRestaurante'];
	   
	   $NumeroMenusRestaurante=$_POST['NumeroMenusRestaurante'];
	   
	   $NumeroCubiertosRestaurante=$_POST['NumeroCubiertosRestaurante'];
  
	   
	  
	  $registrar = $this->db->prepare("INSERT INTO serviciorestaurante (FechaRestaurante, ServiciosRestaurante, TipoServicioRestaurante ,NumeroPersonasRestaurante,NumeroRefrigeriosRestaurante,NumeroMenusRestaurante,NumeroCubiertosRestaurante) VALUES ('$FechaRestaurante', '$ServiciosRestaurante','$TipoServicioRestaurante','$NumeroPersonasRestaurante','$NumeroRefrigeriosRestaurante','$NumeroMenusRestaurante','$NumeroCubiertosRestaurante')" );
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Registr&oacute; servicio restaurante';

      $detalle=$nomres." "."Registr&oacute; servicio restaurante: "." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
	  
	  

	   if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=2"</script>';

      }

    

	 

 
 }	

/***********************************************************************************/

  /*------------------------------ Modificar Servicio --------------------------------*/

  /***********************************************************************************/

  public function editServicio()

  {

	   $idRestaurante=$_POST['idRestaurante'];
	   
	   $FechaRestaurante=$_POST['FechaRestaurante'];

	   $ServiciosRestaurante=$_POST['ServiciosRestaurante'];
	   
	   $TipoServicioRestaurante=$_POST['TipoServicioRestaurante'];
	   
	   $NumeroPersonasRestaurante=$_POST['NumeroPersonasRestaurante'];
	   
	   $NumeroRefrigeriosRestaurante=$_POST['NumeroRefrigeriosRestaurante'];
	   
	   $NumeroMenusRestaurante=$_POST['NumeroMenusRestaurante'];
	   
	   $NumeroCubiertosRestaurante=$_POST['NumeroCubiertosRestaurante'];
  
	   
	  
	  $registrar = $this->db->prepare("UPDATE serviciorestaurante SET FechaRestaurante='$FechaRestaurante', ServiciosRestaurante='$ServiciosRestaurante', TipoServicioRestaurante='$TipoServicioRestaurante',NumeroPersonasRestaurante='$NumeroPersonasRestaurante',NumeroRefrigeriosRestaurante='$NumeroRefrigeriosRestaurante',NumeroMenusRestaurante='$NumeroMenusRestaurante',NumeroCubiertosRestaurante='$NumeroCubiertosRestaurante' WHERE idRestaurante='$idRestaurante' " );
	  
	  $registrar->execute(); 
	  $resultado = $registrar->rowCount();
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Modific&oacute; servicio restaurante';

      $detalle=$nomres." "."Modific&oacute; servicio restaurante: "." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
	  
	  

	   if ($resultado)

      {			

       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=1"</script>';

      }

  }
  
 /***********************************************************************************/

  /*------------------------------ Eliminar Servicio --------------------------------*/

  /***********************************************************************************/

  public function EliminarServicio()

  {

	  $idRestaurante  = $_GET['nombre'];
		   
	   
	  $registrar = $this->db->prepare("DELETE FROM serviciorestaurante  WHERE idRestaurante ='$idRestaurante '" );
	  $registrar->execute();  
	  
	  
	  
	  
	  
	 if($_SESSION['id']!=""){

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

  
 
      //es de tipo 9 por que va relacionado con el modulo de A Y B
      $accion='Elimin&oacute; Servicio';

      $detalle=$nomres." "."Elimin&oacute; Servicio "." ".$fecha." "."a las: ".$hora;
	   
      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute(); 
	    
	  
       print'<script languaje="Javascript">location.href="index.php?controller=AyB&action=mensajes&nombre=3"</script>';
 
 } 	 
/***********************************************************************************/

  /*------------------------------ Subir Extras -----------------------------------*/

  /***********************************************************************************/

  public function subirExtras()

  {

  	$NombreExtras=$_POST['NombreExtras'];

    date_default_timezone_set('America/Bogota'); 
	
	$FechaExtras = date("Y-m-d");

	$path="views/RestauranteExtras/";

  	$nombre_archivo = $NombreExtras; 

	$tipo_archivo = $_FILES['documento']['type'];

    $tamano_archivo = $_FILES['documento']['size'];
	
	$ext = strrchr($_FILES['documento']['name'],'.'); 
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo."_".$FechaExtras.$ext;
	  }
	  else
	  {
	   $ruta="";
	  }

  

  	$band=0;

   	if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))

  	{ 

  

  			$registrar = $this->db->prepare("INSERT INTO extrasrestaurante (NombreExtras,ArchivoExtras,FechaExtras) VALUES ( '$NombreExtras', '$ruta','$FechaExtras')" );

  			$registrar->execute();

			

   	} 
  	$resultado = $registrar->rowCount();
	
	
	
 if($_SESSION['id']!="")
{

   $prod= $this->db->prepare("SELECT usua_codigo, usua_nombre, usua_login FROM usuarioadmin");//condicion para q se guarde el log q   corresponda a el usuario registrado.
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

   $accion='Subi&oacute; Informe Extras';

   $detalle=$nomres." "."Subi&oacute; Informe Extras:".$NombreExtras." ".$fecha." "."a las: ".$hora;

      //es de tipo 9 por que va relacionado con el modulo de AyB

      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute();
	

 	if ($resultado)

  	{

		$_SESSION['elemento'] = "El Informe Subio al CRM correctamente con fecha ".$FechaExtras;

		$_SESSION['elem_conscontrato'] = true;  

  	}

	

   	print '<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';

  }

  
/***********************************************************************************/

  /*------------------------------ Subir Turnos -----------------------------------*/

  /***********************************************************************************/

  public function subirTurnos()

  {

  	$NombreTurnosR=$_POST['NombreTurnosR'];

    date_default_timezone_set('America/Bogota'); 
	
	$FechaTurnosR = date("Y-m-d");

	$path="views/RestauranteTurnos/";

  	$nombre_archivo = $NombreTurnosR; 

	$tipo_archivo = $_FILES['documento']['type'];

    $tamano_archivo = $_FILES['documento']['size'];
	
	$ext = strrchr($_FILES['documento']['name'],'.'); 
	  if($ext!="")
	  {  
	   $ruta=$path.$nombre_archivo."_".$FechaTurnosR.$ext;
	  }
	  else
	  {
	   $ruta="";
	  }

  

  	$band=0;

   	if (move_uploaded_file($_FILES['documento']['tmp_name'],$ruta))

  	{ 

  

  			$registrar = $this->db->prepare("INSERT INTO turnosrestaurante (NombreTurnosR,ArchivoTurnosR,FechaTurnosR) VALUES ( '$NombreTurnosR', '$ruta','$FechaTurnosR')" );

  			$registrar->execute();

			

   	} 
  	$resultado = $registrar->rowCount();
	
	
	
 if($_SESSION['id']!="")
{

   $prod= $this->db->prepare("SELECT usua_codigo, usua_nombre, usua_login FROM usuarioadmin");//condicion para q se guarde el log q   corresponda a el usuario registrado.
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

   $accion='Subi&oacute; Informe Turnos';

   $detalle=$nomres." "."Subi&oacute; Informe Turnos:".$NombreTurnosR." ".$fecha." "."a las: ".$hora;

      //es de tipo 9 por que va relacionado con el modulo de AyB

      $tipolog=9;

  

      $insertarlog = $this->db->prepare("INSERT INTO logcrm (fechaLogcrm, accionLogcrm,detalleLogcrm,idLogcrm_idEjecutivo,fotoLogcrm,tipoLogcrm) VALUES ('$fechaa', '$accion','$detalle','$respo','$resp','$tipolog')");

      $insertarlog->execute();
	

 	if ($resultado)

  	{

		$_SESSION['elemento'] = "El Informe Subio al CRM correctamente con fecha ".$FechaTurnosR;

		$_SESSION['elem_conscontrato'] = true;  

  	}

	

   	print '<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_reportes"</script>';

  }

	  /***********************************************************************************/

  /*--------------------------- Listar contador de servicio restaurante  ---------------------------*/

  /***********************************************************************************/ 

 

public function reporteRestauranteCont()

	{
      
  $fechadd = $_GET['nombre'];
  $fecha = explode(';',$fechadd);
  $fecha1 = $fecha[0];
  $fecha2 = $fecha[1];
  
  $listar = $this->db->prepare("SELECT COUNT(*) FROM serviciorestaurante WHERE 	FechaRestaurante>= '$fecha1' AND 	FechaRestaurante<= '$fecha2'");
  $listar->execute();
  return $listar; 
	  
	

	}	  
   	  
	  /***********************************************************************************/
  /*--------------------- Reporte Servicio Restaurante Datos  --------------------------*/
  /***********************************************************************************/
  public function reporteRestauranteDatos()
  {
  
 
  $fechadd = $_GET['nombre'];
  $fecha = explode(';',$fechadd);
  $fecha1 = $fecha[0];
  $fecha2 = $fecha[1];
  
  $listar = $this->db->prepare("SELECT * FROM serviciorestaurante WHERE FechaRestaurante>= '$fecha1' AND FechaRestaurante<= '$fecha2'");
  $listar->execute();
  return $listar; 

  }
  /***********************************************************************************/
  /*-------------------- Reporte Servicio restaurante PDF  --------------------------*/
  /***********************************************************************************/
  public function reporteRestaurante()
  {
  
 
  $fechadd = $_GET['nombre'];
  $fecha = explode(';',$fechadd);
  $fecha1 = $fecha[0];
  $fecha2 = $fecha[1];
  
  $listar = $this->db->prepare("SELECT COUNT(*) FROM serviciorestaurante WHERE FechaRestaurante>= '$fecha1' AND FechaRestaurante<= '$fecha2'");
  $listar->execute();
  
   while($field = $listar->fetch())
   {
     $cont=$field[0];
   } 

  
      date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');
      $horaa=explode(' ',$fechaa);
      $fecha=$horaa[0];
      $hora=$horaa[1];
	  $var="Fecha:";
	  $asis="";
	  $tema="";
	  $ruta1="views/reporte/reporte";
	  $ruta2= 25;
	  $rut=".txt";
	  $ruta=$ruta1.$ruta2.$rut;
	  $listar1 = $this->db->prepare("SELECT * FROM serviciorestaurante WHERE FechaRestaurante>= '$fecha1' AND FechaRestaurante<= '$fecha2'");
      $listar1->execute();
	  $band=1;
 
   		
  		  $ar=fopen($ruta,"w") or
    	  die("Problemas en la creacion");
		  while($field1 = $listar1->fetch())
		  {
          fputs($ar,$asis.$field1[FechaRestaurante]);
		  fputs($ar,";");
		  fputs($ar,$asis.$field1[ServiciosRestaurante]);
		  fputs($ar,";");
		  fputs($ar,$asis.$field1[TipoServicioRestaurante]);
		  fputs($ar,";");
		  fputs($ar,$asis.$field1[NumeroPersonasRestaurante]);
		  fputs($ar,";");
		  fputs($ar,$asis.$field1[NumeroCubiertosRestaurante]);
		   fputs($ar,"\n");
		  }
		  fputs($ar,"Total  (".$cont.")");
          fputs($ar,"\n");
 	      fputs($ar,"Desde la fecha ".$fecha1." hasta ".$fecha2);
		  fputs($ar,"\n");
		  fclose($ar);	 	  
		   
   
  } 	  

} 



?>