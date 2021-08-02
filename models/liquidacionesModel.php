<?php

class liquidacionesModel extends modelBase

{

	

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

      public function mensajes()

  {

      $condicion=$_GET['nombre'];
 	  
	  if($condicion==1)

	  {

	    $_SESSION['elemento'] = "El seguimiento ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=regseguimiento"</script>';
	     }
  
	   }

	 if($condicion==2)

	  {

	    $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   }

	 }
	  if($condicion==22)

	  {

	    $_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';
	  
	   }
	   

	 }
	
     if($condicion==3)

	  {

	    $_SESSION['elemento'] = "El acta de recibido ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    
	       if($condicion==4)

	  {

	    $_SESSION['elemento'] = "El acta de entrega ha sido registrada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	   
	       if($condicion==5)

	  {

	    $_SESSION['elemento'] = "El acta ha sido modificada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	   
	      if($condicion==6)

	  {

	    $_SESSION['elemento'] = "El informe ha sido registrado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	    if($condicion==7)

	  {

	    $_SESSION['elemento'] = "El informe ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }
	        if($condicion==8)

	  {

	    $_SESSION['elemento'] = "El acta ha sido entregada correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	     }
  
	   }  
 

  }	

  

  

  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogArchivo()

  {

  

	  $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=1
ORDER BY logusuario.id DESC
LIMIT 15");

	  $listar->execute();
	 return $listar;


   

  }	

  


  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados del área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleados()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idperfil=3 and idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }
  /***********************************************************************************/

  /*---------------------------  Listar usuarios empleados con el jef de área archivo --------------------*/

  /***********************************************************************************/

  public function listarEmpleadosJefe()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario where idareaempleado=1 order by empleado ");

  $listar->execute();

  return $listar;

  

  }



/***********************************************************************************/

  /*---------------------------  Listar Ubicación Expedientes --------------------*/

  /***********************************************************************************/

public function listarUbicacion()

  {  

  $listar = $this->db->prepare("SELECT ubi.id, ubi.idusuario, ubi.fecha, ubi.radicado, ubi.piso,  est.nombre as estado, juz.nombre as juzgado, ubi.fechasalida, juzdes.nombre as juzgadodestino, ubi.fechadevolucion, ubi.posicion, ubi.cedula_demandante, ubi.demandante, ubi.cedula_demandado, ubi.demandado FROM ubicacion_expediente ubi
  								INNER JOIN detalle_estado est ON (ubi.idestado = est.id)
								INNER JOIN pa_juzgado juz ON (ubi.idjuzgado = juz.id)
								LEFT JOIN  juzgado_destino juzdes ON (ubi.idjuzgadodestino = juzdes.id)
								ORDER BY ubi.fecha DESC LIMIT 30");

  $listar->execute();

  return $listar;
  }
  
 
  /***********************************************************************************/

  /*------------------------------  Filtro Ubicacion Expedientes  ---------------------------------*/

  /***********************************************************************************/

  public function FiltroIngresoSalida()

  {


$fechair				= $_GET['nombre16']; 
$fechafr				= $_GET['nombre17'];
$tipo					= $_GET['nombre11']; 
$usuario				= $_GET['nombre20'];


$f1=$f2=$f3="";



if($fechair!='')
{
$fechair = $fechair.' 00:00:00';
$fechafr = $fechafr.' 23:59:59';
$f1=" and (em.fecha >= '$fechair' and em.fecha<='$fechafr')";
}


if($tipo!=''){
 $f2=" AND em.tipo LIKE '%$tipo%'";
}

if($usuario!=''){
 $f3=" AND em.idusuario = '$usuario' ";
}

 $listar = $this->db->prepare("SELECT em.id AS idem, em.idusuario,  em.fecha,em.tipo, em.observaciones, usu.empleado as usuario
FROM empleado_control em
LEFT JOIN pa_usuario usu ON (em.idusuario = usu.id)

WHERE  em.tipo LIKE '%$tipo%' ".$f3.$f1."  ORDER BY em.fecha");
   	  $listar->execute();
	  
	  return $listar; 

  } 
 
   /***********************************************************************************/

  /*------------------------------ Registrar Ingreso Salida --------------------------------*/

  /***********************************************************************************/

  public function registrarLiquidaciones()
  {
	 $fecha = $_POST['fecha']; 
	 $radicado = $_POST['radicado'];	
	 $tituloValor = $_SESSION['titulo'];
	 $juzgadodestino = $_SESSION['juzgado_destino'];
	 
	 date_default_timezone_set('America/Bogota'); 

      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; una nueva liquidaci&oacuten';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro una nueva liquidación ".$fechal." "."a las: ".$hora;
	  
	 	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=1; 
	  
	   $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	   $registrar = $this->db->prepare("INSERT INTO liquidacion (idproceso,titulo_valor,idjuzgado_destino)
		values ('$idres','$fechaa','$observaciones','$tipo')");

	  $registrar->execute(); 
	  
	  
	  $resultado = $registrar->rowCount();

	  
      if ($resultado)

      {			

     print'<script languaje="Javascript">location.href="index.php?controller=empleados&action=mensajes&nombre=2"</script>';

      } 
  }

  


  /***********************************************************************************/

  /*-----------------------  Consultar Empleados Ingreso Salidas  --------------------*/

  /***********************************************************************************/

  public function listarIngresoSalida()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("SELECT em.idusuario, usu.empleado as usuario, em.fecha, em.observaciones, em.tipo
FROM empleado_control em
INNER JOIN pa_usuario usu ON (em.idusuario = usu.id)
");

  $listar->execute();

  return $listar;

  

  } 
    /***********************************************************************************/

  /*---------------------------  Listar usuarios --------------------*/

  /***********************************************************************************/

  public function listarUsuarios()

  {
  
  $listar = $this->db->prepare("SELECT id,empleado FROM pa_usuario order by empleado asc ");

  $listar->execute();

  return $listar;

  

  }
  


}




?>