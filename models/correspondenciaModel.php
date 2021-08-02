<?php

class correspondenciaModel extends modelBase

{

	

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

      public function mensajes()

  {

      $condicion=$_GET['nombre'];
 	  
	  if($condicion==1)

	  {

	    $_SESSION['elemento'] = "";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
	     }
  
	   }

	 if($condicion==2)

	  {

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
	  
	   }

	 }
	
     if($condicion==3)

	  {

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=listarUbicacionExpediente"</script>';
	     }
  
	   }
	    
	       if($condicion==4)

	  {

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=regpeticion"</script>';
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

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_solicitudes"</script>';
	  
	   }

	 }
	 
	 if($condicion==9)

	  {

	    $_SESSION['elemento'] = "El radicado no se encuentra almacenado en Siglo XXI";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=regmemorial"</script>';
	     }
  
	   }

 

  }	

  
  
  
  
  
      /***********************************************************************************/

  /*------------------------------  Listar juzgados  ---------------------------------*/

  /***********************************************************************************/

  public function listarJuzgados()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_juzgado");

  $listar->execute();

  return $listar;

  

  }
  
  public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
  }
  
     /***********************************************************************************/

  /*------------------------------  Listar solicitudes  ---------------------------------*/

  /***********************************************************************************/

  public function listarSolicitudes()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_solicitud WHERE visible = 1
                                ORDER BY nombre ASC");

  $listar->execute();

  return $listar;

  

  }
  
   /***********************************************************************************/

  /*------------------------------  Listar usuarios  ---------------------------------*/

  /***********************************************************************************/

  public function listarUsuarios()

  {

  

  $listar = $this->db->prepare("SELECT * FROM pa_usuario");

  $listar->execute();

  return $listar;

  

  }  
    /***********************************************************************************/

  /*------------------------------  Listar Solicitudes  ---------------------------------*/

  /***********************************************************************************/

  public function listarPeticiones()

  {

  

  $listar = $this->db->prepare("");

  $listar->execute();

  return $listar;

  

  }   
  
   /***********************************************************************************/

  /*------------------------------  Listar Documentos  ---------------------------------*/

  /***********************************************************************************/

  public function listarDocumentos()

  {

  

  $listar = $this->db->prepare("select corr.id, corr.fecha_registro,corr.radicado,corr.peticionario,corr.tipo_documento,corr.tiene_expediente,
juz.nombre as juzgado,juzdest.nombre as destino,corr.fecha_entrega,sol.nombre as solicitud,usu.empleado, corr.folios,sol.idprioridad, sol.id as idsol,corr.generado,
corr.ruta_local  
from correspondencia corr 
inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
left join pa_juzgado juzdest on (corr.idjuzgadodestino=juzdest.id)
inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
inner join pa_usuario usu on (corr.idusuario=usu.id) 
where corr.fecha_entrega is null
order by 
sol.idprioridad limit 20");

  $listar->execute();

  return $listar;

  

  }  
  
   /***********************************************************************************/

  /*------------------------------  Listar Solicitudes usuarios  ---------------------------------*/

  /***********************************************************************************/

  public function listarSolicitudesUsuarios()

  {

  

  $listar = $this->db->prepare("select sol.id as idsol, sol.fecha,sol.solicitud,sol.radicado_consultar,sol.peticionario,sol.consecutivo,sol.cedula,sol.telefono,usu.empleado,sol.fecha_resuelve,res.empleado,sol.resolvio,sol.descripcion,sol.ubicacion,sol.fecha_ubicacion 
from solicitud sol
inner join pa_usuario usu on (usu.id=sol.idusuarioregistra)
left join pa_usuario res on (res.id=sol.idusuarioresuelve)
where resolvio like '%espera%'");

  $listar->execute();

  return $listar;

  

  } 
  
     /***********************************************************************************/

  /*------------------------------  Filtro Solicitudes usuarios  ---------------------------------*/

  /***********************************************************************************/

  public function FiltroSolicitudesUsuarios()

  {

$fechai					= $_GET['nombre1']; 
$fechaf					= $_GET['nombre2']; 
$solicitud				= $_GET['nombre3']; 
$radicado				= $_GET['nombre4']; 
$peticionario			= $_GET['nombre5']; 
$cedula 				= $_GET['nombre6']; 
$idusuarioresuelve		= $_GET['nombre7']; 
$idusuarioregistra		= $_GET['nombre8']; 
$fechair     			= $_GET['nombre9']; 
$fechafr				= $_GET['nombre10']; 
$resuelto				= $_GET['nombre11']; 
$consecutivo			= $_GET['nombre12']; 

$f1=$f2=$f3="";


if($fechai!='')
{
$fechai = $fechai.' 00:00:00';
$fechaf = $fechaf.' 23:59:59';
$f1=" and(sol.fecha >= '$fechai' and sol.fecha<='$fechaf')";
}
if($fechair!='')
{
$fechair = $fechair.' 00:00:00';
$fechafr = $fechafr.' 23:59:59';
$f2=" and (sol.fecha_entrega >= '$fechair' and sol.fecha_entrega<='$fechafr')";
}
if($idusuarioresuelve!='')
{
$f3=" and sol.idusuarioresuelve like '%$idusuarioresuelve%'";
}


 $listar = $this->db->prepare("select sol.id as idsol, sol.fecha,sol.solicitud,sol.radicado_consultar,sol.peticionario,sol.consecutivo,sol.cedula,sol.telefono,usu.empleado,sol.fecha_resuelve,res.empleado as usures,sol.resolvio,sol.descripcion,sol.ubicacion,sol.fecha_ubicacion 
from solicitud sol
inner join pa_usuario usu on (usu.id=sol.idusuarioregistra)
left join pa_usuario res on (res.id=sol.idusuarioresuelve)
where sol.solicitud like '%$solicitud%' and sol.radicado_consultar like '%$radicado%' and sol.peticionario like '%$peticionario%' and sol.cedula like '%$cedula%' and sol.idusuarioregistra like '%$idusuarioregistra%' and sol.resolvio like '%$resuelto%'
and sol.consecutivo like '%$consecutivo%'".$f1.$f2.$f3." order by sol.fecha");
   	  $listar->execute();
	  
	  return $listar;
	
 	


  

  }   
  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogCorrespondencia()

  {

  

	  /*$listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=2
ORDER BY logusuario.id DESC
LIMIT 15");*/


 $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=2 AND logusuario.id = (SELECT MAX(id) AS id FROM log)
ORDER BY logusuario.id DESC");

	  $listar->execute();

	  return $listar; 

   

  }	

   /***********************************************************************************/

  /*------------------------------ Listar Solicitud Especifica ---------------------------------------*/

  /***********************************************************************************/

  public function listarSolicitudEspecifica()

  {

 $id = $_GET['nombre']; 
 

 

	  $listar = $this->db->prepare("select sol.id as idsol, sol.fecha,sol.solicitud,sol.radicado_consultar,sol.peticionario,sol.consecutivo,sol.cedula,sol.telefono,usu.empleado as recibeusu,sol.fecha_resuelve,res.empleado,sol.idusuarioresuelve,sol.resolvio,sol.descripcion,sol.ubicacion,sol.fecha_ubicacion 
from solicitud sol
inner join pa_usuario usu on (usu.id=sol.idusuarioregistra)
left join pa_usuario res on (res.id=sol.idusuarioresuelve)
where sol.id='$id'");

	  $listar->execute();

	  return $listar; 

   

  }	
 
     /***********************************************************************************/

  /*------------------------------ Listar Descripciones Solicitud ---------------------------------------*/

  /***********************************************************************************/

  public function listarDescripcionesSolicitud()

  {

 $id = $_GET['nombre']; 
 

 

	  $listar = $this->db->prepare("select ds.fecha as fechad, ds.descripcion as descr from detalle_solicitud ds
where ds.idsolicitud='$id'");

	  $listar->execute();

	  return $listar; 

   

  }	
   /***********************************************************************************/

  /*---------------------------  Listar Datos Siglo XXI --------------------*/

  /***********************************************************************************/

public function listarDemandante()

  { 
  
   $j=0;
  //$cont=$data->rowcount();
  
   $radicado				= $_GET['nombre']; 
  unset($vector);
  
 // $connectionInfo = array( "Database"=>ConsejoPN, "UID"=>"root", "PWD"=>"");
 //$serverName = "172.16.177.104";
//$conn = sqlsrv_connect( $serverName, $connectionInfo);



$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) { 
   // echo "Conectado a la Base de Datoss.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datoss.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
	//while($field = $data->fetch()){	
	

 //$sql =("SELECT A112NUMESUJE, A112NOMBSUJE  FROM ConsejoPN.dbo.T112DRSUJEPROC
 //WHERE A112LLAVPROC = '$radicado'  AND   A112CODISUJE = 0001 ") ;
  
 $sql =("SELECT dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NomDDO],  T112DRSUJEPROC_1.A112NOMBSUJE AS [NomDTE] FROM 
  ConsejoPN.dbo.T103DAINFOPROC INNER JOIN
                      dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC INNER JOIN
                      dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC
WHERE     (dbo.T112DRSUJEPROC.A112CODISUJE = '0002') AND (T112DRSUJEPROC_1.A112CODISUJE = '0001') AND 
                      (dbo.T103DAINFOPROC.A103LLAVPROC = '$radicado')");
						
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );

if ($row_count === false){
   echo "Error in retrieveing row count. en listarDemandante";}
 else{
 
while( $row = sqlsrv_fetch_array( $stmt)){
 
 	$vector[$j][cedula_demandante] = $row['cedula_demandante'];	
	$vector[$j][demandante] = $row['NomDTE'];
	$vector[$j][demandado] = $row['NomDDO'];
	
 $j++;
 
 }
 }

  return $vector;
  }
  
   /***********************************************************************************/

  /*---------------------------  Listar Datos Siglo XXI Modificar --------------------*/

  /***********************************************************************************/

public function listarDemandanteMod()

  { 
  
   $j=0;
   $id = $_GET['nombre'];
 
$listar = $this->db->prepare("select corr.id , corr.fecha_registro,corr.radicado,corr.tipo_documento, corr.idjuzgado,juz.nombre as juzgado,corr.idsolicitud,sol.nombre, sol.idprioridad,corr.peticionario,corr.folios,usu.empleado, pri.nombre as prioridad 
from correspondencia corr
inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
inner join pa_prioridad pri on (sol.idprioridad=pri.id)
inner join pa_usuario usu on (usu.id=corr.idusuario) where corr.id='$id'
"); 
	  	  $listar->execute();
$lis = $listar->fetch();
$radicado = $lis[radicado];
  unset($vector);
  
 // $connectionInfo = array( "Database"=>ConsejoPN, "UID"=>"root", "PWD"=>"");
 //$serverName = "172.16.177.104";
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) { 
  //  echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
	//while($field = $data->fetch()){	
	

 //$sql =("SELECT A112NUMESUJE, A112NOMBSUJE  FROM ConsejoPN.dbo.T112DRSUJEPROC
 //WHERE A112LLAVPROC = '$radicado'  AND   A112CODISUJE = 0001 ") ;
  
 $sql =("SELECT dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NomDDO],  T112DRSUJEPROC_1.A112NOMBSUJE AS [NomDTE] FROM 
  ConsejoPN.dbo.T103DAINFOPROC INNER JOIN
                      dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC INNER JOIN
                      dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC
WHERE     (dbo.T112DRSUJEPROC.A112CODISUJE = '0002') AND (T112DRSUJEPROC_1.A112CODISUJE = '0001') AND 
                      (dbo.T103DAINFOPROC.A103LLAVPROC = '$radicado')");
						
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );

if ($row_count === false){
   echo "Error in retrieveing row count. en listarDemandante";}
 else{
 
while( $row = sqlsrv_fetch_array( $stmt)){
 
 	$vector[$j][cedula_demandante] = $row['cedula_demandante'];	
	$vector[$j][demandante] = $row['NomDTE'];
	$vector[$j][demandado] = $row['NomDDO'];
	
 $j++;
 
 }
 }

  return $vector;
  }
  
    /***********************************************************************************/

  /*------------------------------ Listar Ubicación Siglo XXI---------------------------------------*/

  /***********************************************************************************/

  public function listarUbicacionSigloXXI()

  {

 $radicado = $_GET['nombre'];
 $tipo_documento = $_GET['nombre1']; 
 $folios		= $_GET['nombre2'];
 $check			= $_GET['nombre3'];
 $ano			= $_GET['nombre4'];
 $consecutivo	= $_GET['nombre5'];
 $juzgado		= $_GET['nombre6'];
 $instancia		= $_GET['nombre7'];
 $destino		= $_GET['nombre8'];
 $solicitud		= $_GET['nombre9'];
 $peticionario	= $_GET['nombre10'];
 $cedula		= $_GET['nombre11'];
 $telefono		= $_GET['nombre12'];
 $folios		= $_GET['nombre13'];
 $prioridad		= $_GET['nombre14'];
 
  unset($vector);
  
 // $connectionInfo = array( "Database"=>ConsejoPN, "UID"=>"root", "PWD"=>"");
// $serverName = "172.16.177.104";
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) { 
  //  echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datoss.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
	
$sql = "SELECT dbo.T103DAINFOPROC.A103LLAVPROC, dbo.T103DAINFOPROC.A103CODIUBIC
FROM  ConsejoPN.dbo.T103DAINFOPROC
WHERE  dbo.T103DAINFOPROC.A103LLAVPROC='$radicado' ";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count en listarUbicacionSigloXXI.";
 
$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	 $vector[$i][ubicacion] = $row['A103CODIUBIC'];	
	 $vector[$i][tipo_documento] = $tipo_documento;
	 $vector[$i][folios] = $folios;
	 $vector[$i][radicado] = $radicado;
	 $vector[$i][check] = $check;
	 $vector[$i][ano] = $ano;
	 $vector[$i][consecutivo] = $consecutivo;
	 $vector[$i][juzgado] = $juzgado;
	 $vector[$i][instancia] = $instancia;
	 $vector[$i][destino] = $destino;
	 $vector[$i][solicitud] = $solicitud;
	 $vector[$i][peticionario] = $peticionario;
	 $vector[$i][cedula] = $cedula;
	 $vector[$i][telefono] = $telefono;
	 $vector[$i][folios] = $folios;
	 $vector[$i][prioridad] = $prioridad;
	
	$i++; 	  
}
   return $vector;

  }	
     /***********************************************************************************/

  /*------------------------------ Listar Ubicación Siglo XXI Modificar---------------------------------------*/

  /***********************************************************************************/

  public function listarUbicacionSigloXXIMod()

  {

 $id = $_GET['nombre'];
 
$listar = $this->db->prepare("select corr.id , corr.fecha_registro,corr.radicado,corr.tipo_documento, corr.idjuzgado,juz.nombre as juzgado,corr.idsolicitud,sol.nombre, sol.idprioridad,corr.peticionario,corr.folios,usu.empleado, pri.nombre as prioridad 
from correspondencia corr
inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
inner join pa_prioridad pri on (sol.idprioridad=pri.id)
inner join pa_usuario usu on (usu.id=corr.idusuario) where corr.id='$id'
");
 
	  $listar->execute();
$lis = $listar->fetch();
$radicado = $lis[radicado];

  unset($vector);
  
 // $connectionInfo = array( "Database"=>ConsejoPN, "UID"=>"root", "PWD"=>"");
 //$serverName = "172.16.177.104";
//$conn = sqlsrv_connect( $serverName, $connectionInfo);
$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
if( $conn ) { 
   // echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datoss.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
	
$sql = "SELECT dbo.T103DAINFOPROC.A103LLAVPROC, dbo.T103DAINFOPROC.A103CODIUBIC
FROM  ConsejoPN.dbo.T103DAINFOPROC
WHERE  dbo.T103DAINFOPROC.A103LLAVPROC='$radicado' ";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count en listarUbicacionSigloXXI.";
 
$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	 $vector[$i][ubicacion] = $row['A103CODIUBIC'];	
	
	
	$i++; 	  
}
   return $vector;

  }	
  
  /***********************************************************************************/
  /*----------------------- Registrar Documento -------------------------------*/
  /***********************************************************************************/
  public function registrarDocumento()
  {

	//echo("fsijdk");
$fecha  		   	   			= $_POST['fecha'];
$tipo_documento 		   	   	= $_POST['tipo_documento'];
$juzgado  		   	   			= $_POST['juzgado'];
$radicado   					= $_POST['radicado'];
$solicitud   					= $_POST['solicitud'];
$peticionario					= $_POST['peticionario'];
$recibe							= $_POST['recibe'];
$peticionario					= $_POST['peticionario'];
$folios							= $_POST['folios'];
$telefono						= $_POST['telefono'];
$cedula							= $_POST['cedula'];
$juzgadodestino					= $_POST['juzgadodestino'];
$generado						= 'no';
$existe							= $_POST['manual2'];

 $solicitud1 = explode("-", $solicitud);
$listar = $this->db->prepare("select nombre from pa_solicitud where id=$solicitud1[0]");
$listar->execute();

$solicito = $listar->fetch();
$finsol=$solicito[nombre];
$actu = "Recepción Memorial por " .$finsol;

if($existe==true)
{
$existes =  "no";
}
else
{
$existes = "si";
}

$sininstancia = $radicado;
$sin = substr($sininstancia, 0, 21);

 $registrar = $this->db->prepare("INSERT INTO correspondencia (fecha_registro,radicado,peticionario,tipo_documento,idjuzgado,fecha_entrega,idjuzgadodestino,idsolicitud,idusuario,folios,cedula,telefono,generado,existe)
values ('$fecha','$radicado','$peticionario', '$tipo_documento','$juzgado','$fecha','$juzgadodestino','$solicitud','$recibe','$folios','$cedula','$telefono','$generado','$existes')");

 $registrar->execute(); 
      $resultado = $registrar->rowCount();
	 
	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Documento';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro un nuevo Documento ".$fechal." "."a las: ".$hora;
	  
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	 	 
/////////////////////////////////////////////
$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) { 
    echo "Conectado a la Base de Datoss.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datoss.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
//$sql = ("SELECT a103descacts,a103fechdess from t103dainfoproc where a103llavproc='00501310300820090014100'");
$sql = "
declare @cad integer 

UPDATE t103dainfoproc SET a103descacts='Recepción Memorial', a103codiacts='30000123', a103codipads='30000123', a103fechdess = GETDATE(), a103anotacts = '$actu'
WHERE a103llavproc='$radicado';

SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 

INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
A110RENUTERM) values('$radicado',@cad,'$sin','00','30000123','30000123','Recepción Memorial','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')
";

//$sql = " declare @cad integer 

//UPDATE t103dainfoproc SET a103descacts='Al Despachoasdasdasdad', a103codiacts='30023191', a103codipads='30023191', a103fechdess = GETDATE()
//WHERE a103llavproc='11001400301120010004500';

//";

 //echo $sql =("");

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
  
$i=0;

/*while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	echo $vector[$i][ubicacion] = $row['a103descacts'];	
	
	$i++; 	  
}*/

/*$connectionInfo = array( "Database"=>pruebasconsejo, "UID"=>"prueba", "PWD"=>"prueba");
 $serverName = "172.16.40.40";
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) { 
    echo "Conectado a la Base de Datoss.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datoss.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

$sqlsel = "
select A110CONSACTU, * from T110DRACTUPROC  where A110LLAVPROC='11001400301320060005000' ";

 //echo $sql =("");
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sqlsel , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count. seleccionar";
  
$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	echo  $row['a103descacts'];	
	
	$i++; 	  
}*/
 
	 
  
print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=3"</script>';
   
  
  }

 /***********************************************************************************/
  /*----------------------- Registrar Solicitud -------------------------------*/
  /***********************************************************************************/
  public function registrarSolicitud()
  {

	 
$fecha  		   	   			= $_POST['fecha'];
$consecutivo	 		   	   	= $_POST['consecutivo_r'];
$solicitud  		   	   		= $_POST['solicitud'];
$radicado_consultar   			= $_POST['radicado'];
$peticionario					= $_POST['peticionario'];
$cedula							= $_POST['cedula'];
$idusuarioregistra				= $_POST['recibe'];
$telefono						= $_POST['telefono'];
$resolvio						= 'espera';






 $registrar = $this->db->prepare("INSERT INTO solicitud (fecha,solicitud,radicado_consultar,peticionario,consecutivo,cedula,idusuarioregistra,telefono,resolvio)
values ('$fecha','$solicitud','$radicado_consultar', '$peticionario','$consecutivo','$cedula','$idusuarioregistra','$telefono','$resolvio')");

	  $registrar->execute(); 
      $resultado = $registrar->rowCount();
	 
	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Solicitud';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro una nueva Solicitud ".$fechal." "."a las: ".$hora;
	  

	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	$actualizar = $this->db->prepare(" UPDATE consecutivo SET consecutivo=consecutivo+1");

      $actualizar->execute();  
  
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=4"</script>';
   
  

  }
  
  /***********************************************************************************/
  /*----------------------- Modificar Solicitud -------------------------------*/
  /***********************************************************************************/
  public function modificarSolicitud()
  {

	 
$id  		   	   			    = $_GET['nombre'];
$solicitud  		   	   		= $_POST['solicitud'];
$radicado_consultar   			= $_POST['radicado'];
$peticionario					= $_POST['peticionario'];
$cedula							= $_POST['cedula'];
$telefono						= $_POST['telefono'];
$resolver						= $_POST['resolver'];
$cantidad                       = $_POST['cantidad'];
$resolvio			= $_POST['resolvio'];

$i=1;
 if ($cantidad>0)
 {
  while($i<=$cantidad){  
  
  $fecha_modif = $_POST['fecha_modif'.$i];
  $desc_modif = $_POST['descripcion_modif'.$i];
  if($_POST['fecha_modif'.$i])
   {
 $registrar = $this->db->prepare("INSERT INTO detalle_solicitud (idsolicitud,fecha,descripcion)
values ('$id','$fecha_modif','$desc_modif')");
$registrar->execute(); 	
   
   }
   $i++;
  
  } 
  
 }

if($resolver==1)
{
$fecha_resuelve 	= $_POST['fecha_resuelve'];
$idusuarioresuelve  = $_POST['idusuarioresuelve'];

$descripcion		= $_POST['descripcion'];
$ubicacion			= $_POST['ubicacion'];
$fecha_ubicacion	= $_POST['fecha_ubicacion'];

 $actualizar = $this->db->prepare("UPDATE solicitud set solicitud='$solicitud', radicado_consultar='$radicado_consultar', peticionario='$peticionario', cedula='$cedula', telefono='$telefono', fecha_resuelve='$fecha_resuelve',idusuarioresuelve='$idusuarioresuelve',resolvio='$resolvio',descripcion='$descripcion',ubicacion='$ubicacion',fecha_ubicacion='$fecha_ubicacion' WHERE id='$id' ");
$actualizar->execute(); 


}
else
{
 $actualizar = $this->db->prepare("UPDATE solicitud set solicitud='$solicitud', radicado_consultar='$radicado_consultar', peticionario='$peticionario', cedula='$cedula', telefono='$telefono',resolvio='$resolvio' WHERE id='$id' ");
$actualizar->execute(); 
}

	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $idres = $_SESSION['idUsuario'];
	  
	   if($resolver==1)
	  {
	  $accion='Resolvi&oacute; Solicitud';
	  }
	  else
	  {
	  $accion='Modific&oacute; Solicitud'; 
	  }

    if($resolver==1)
	  {
      $detalle=$_SESSION['nombre']." "."Resolvio una nueva Solicitud ".$fechal." "."a las: ".$hora;
	  }
	  else
	  {
	 $detalle=$_SESSION['nombre']." "."Modifico una nueva Solicitud ".$fechal." "."a las: ".$hora;  
	  }
	  

	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
  
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=8"</script>';
   
  

  }
 
   /*******************************  Consultar Filtro Documentos ***********************************/

  public function listarDocumentosFiltro()

  {



$fechai					= $_GET['nombre1']; 
$fechaf					= $_GET['nombre2']; 
$tipo_documento			= $_GET['nombre3']; 
$solicitud				= $_GET['nombre4']; 
$idjuzgado				= $_GET['nombre5']; 
$radicado				= $_GET['nombre6']; 
$idjuzgadodestino		= $_GET['nombre7']; 
$idusuario				= $_GET['nombre8']; 
$peticionario			= $_GET['nombre9']; 
$fechaei				= $_GET['nombre10']; 
$fechaef				= $_GET['nombre11']; 

//ADICIONADO POR JORGE ANDRES VALENCIA EL 25 DE FEBRERO DEL 2016 
//PARA LA APLICAION DEL NUEVO MODULO INCORPORA MEMORIAL AL PROCESO
//$fechaii				= $_GET['nombre10b']; 
//$fechaif				= $_GET['nombre11b']; 

$existente				= $_GET['nombre12'];

//Se Incorpora Expediente al Proceso
$siep				    = $_GET['nombre13'];

//$idjuzgadoreparto		= $_GET['nombre14']; 

 
$f1=$f2=$f3=$f4=$f5=$f6=$f7="";


if($fechai!='')
{
$fechai = $fechai.' 00:00:00';
$fechaf = $fechaf.' 23:59:59';
$f1=" and(corr.fecha_registro >= '$fechai' and corr.fecha_registro<='$fechaf')";
}
if($fechaei!='')
{
$fechaei = $fechaei.' 00:00:00';
$fechaef = $fechaef.' 23:59:59';
$f2=" and (corr.fecha_entrega >= '$fechaei' and corr.fecha_entrega<='$fechaef')";
}

/*if($fechaii!='')
{

	
	$f6=" and (corr.fecha_incorpora >= '$fechaii' and corr.fecha_incorpora <= '$fechaif') 
	      and (dc.observacion LIKE '%SE PASA PROCESO ANDRES GRAJALES PARA EL JUZGADO%' OR
		  dc.observacion LIKE '%SE PASA PROCESO ANDRÃ‰S GRAJALES PARA EL JUZGADO%')";
}*/


if($idjuzgadodestino!='')
{
$f3=" and corr.idjuzgadodestino = '$idjuzgadodestino'";
}
if($existente!='')
{
$f4=" and corr.existe = '$existente'";
}
//Se Incorpora Expediente al Proceso
if($siep != '' && ($siep == 'si' || $siep == 'no'))
{
	if($siep == 'si'){
		
		$siep = 1; 
		
		$f5 = " and corr.incorporaexpediente = '$siep'";
	}
	else{
	
		$f5 = " and corr.incorporaexpediente IS NULL";
	}

}


/*if($idjuzgadoreparto != '')
{
	$f7 = " and ubi.idjuzgado_reparto = '$idjuzgadoreparto'";
}*/


	//ASI ESTABA Y FUNCIONABA A LA FECHA 26 DE FEBRERO 2016
	//SIN EL FILTRO $F7, YA QUE ESTE FILTRO SE APLICA PARA QUE SE TOME EL JUZGADO REPARTO 				
	/*$listar = $this->db->prepare("select DISTINCT corr.id, corr.fecha_registro,corr.radicado,corr.peticionario,corr.tipo_documento,corr.tiene_expediente,
								juz.nombre as juzgado,juzdest.nombre as destino,corr.fecha_entrega,sol.nombre as solicitud,usu.empleado, corr.folios,sol.idprioridad, sol.id as idsol,
								corr.generado, corr.existe,ubi.idjuzgado_reparto     
								from correspondencia corr 
								inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
								left join juzgado_destino juzdest on (corr.idjuzgadodestino=juzdest.id)
								inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
								inner join pa_usuario usu on (corr.idusuario=usu.id)
								inner join ubicacion_expediente ubi on (corr.idubicacionexpediente = ubi.id)
								inner join detalle_correspondencia dc on (ubi.id = dc.idcorrespondencia)
								where corr.tipo_documento like '%$tipo_documento%' and sol.id like '%$solicitud%' and corr.idjuzgado like '%$idjuzgado%' 
								and corr.radicado like '%$radicado%' and corr.peticionario like '%$peticionario%' 
								and corr.idusuario like '%$idusuario%'".$f1.$f2.$f3.$f4.$f5.$f6.$f7." order by corr.radicado ");*/
								
								
	
	 $listar = $this->db->prepare(" select corr.id, corr.fecha_registro,corr.radicado,corr.peticionario,corr.tipo_documento,corr.tiene_expediente,
									juz.nombre as juzgado,juzdest.nombre as destino,corr.fecha_entrega,sol.nombre as solicitud,usu.empleado, corr.folios,sol.idprioridad, sol.id as idsol,
									corr.generado, corr.existe,corr.ruta_local     
									from correspondencia corr 
									inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
									left join juzgado_destino juzdest on (corr.idjuzgadodestino=juzdest.id)
									inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
									inner join pa_usuario usu on (corr.idusuario=usu.id)
									where corr.tipo_documento like '%$tipo_documento%' and sol.id like '%$solicitud%' and corr.idjuzgado like '%$idjuzgado%' 
									and corr.radicado like '%$radicado%' and corr.peticionario like '%$peticionario%' 
									and corr.idusuario like '%$idusuario%'".$f1.$f2.$f3.$f4.$f5." order by corr.radicado ");
	
   	  $listar->execute();
	  
	  return $listar;
	  
	  /*NOTA 21 DE ABRIL 2021:
	  EN EL FILTRO PARTE and sol.id like '%$solicitud%' SE CAMBIA POR and sol.id = '$solicitud'
	  YA QUE CUANDO SE REALIZA UN FILTRO EN LA VISTA correspondencia_filtrar_documentos.php POR EJEMPLO
	  COLOCANDO EN CAMPO Solicitud: Créditos y Costas TAMBIEN TRAE REGISTROS CON Solicitud: Solicitud Oficios
	  YA QUE EL ID DE Créditos y Costas ES 18 Y EL DE Solicitud Oficios ES 118 Y AL APLICAR and sol.id like '%$solicitud%'
	  EL LIKE TRAE COINCIDENCIAS MEZCALNDO REGISTROS DE Créditos y Costas Y Solicitud Oficios EN LA CONSULTA
	  
	  NOTA 22 DE ABRIL 2021:
	  
	  SE DEJA EL FILTRO COMO ESTABA, YA QUE DE LA FORMA  QUE SE PIDIO PRESENTA INCONSITENCIAS DE BUESQUEDA
	  */
	  
	  
	  
	
 	}

  /***********************************************************************************/

  /*------------------------------ Consultar Documento ---------------------------------------*/

  /***********************************************************************************/

  public function consultarDocumento()

  {

   $id = $_GET['nombre'];

	  $listar = $this->db->prepare("select corr.id , corr.fecha_registro,corr.radicado,corr.tipo_documento, corr.idjuzgado,juz.nombre as juzgado,corr.idsolicitud,sol.nombre, sol.idprioridad,corr.peticionario,corr.folios,usu.empleado, pri.nombre as prioridad,
corr.idjuzgadodestino,des.nombre as destino,corr.incorporaexpediente,corr.observacionesm
from correspondencia corr
inner join pa_juzgado juz on (corr.idjuzgado=juz.id)
inner join pa_solicitud sol on (corr.idsolicitud=sol.id)
inner join pa_prioridad pri on (sol.idprioridad=pri.id)
left join juzgado_destino des on (des.id=corr.idjuzgadodestino)
inner join pa_usuario usu on (usu.id=corr.idusuario) where corr.id='$id'
");


	 
	 
	  $listar->execute();

	  return $listar; 

   

  }	
  
  
   /***********************************************************************************/

  /*----------------------- Listar Datos Radicado Modificar-------------------------------------*/

  /***********************************************************************************/

  public function listarDatosRadicadoModificar()

  {

      $id=$_GET['nombre'];    

	  $listar = $this->db->prepare("select ct.radicado from correspondencia ct where ct.id='$id'");

	  $listar->execute();
	  
	  while($field = $listar->fetch())
       	 {
		  $radicado=$field['radicado'];
		  }
		
	   $ano= substr($radicado, 12, 4);
	   $consecutivo=substr($radicado, 18, 3);	
	   
	  
	  $vector[0][ano]=$ano;
	  $vector[0][consecutivo]=$consecutivo;
   

	  return $vector; 

   

  }  
 /***********************************************************************************/

  /*----------------------- Listar Datos Radicado Solicitudes-------------------------------------*/

  /***********************************************************************************/

  public function listarDatosRadicadoModificarSolicitud()

  {

      $id=$_GET['nombre'];    

	  $listar = $this->db->prepare("select ct.radicado_consultar from solicitud ct where ct.id='$id'");
	  
	  

	  $listar->execute();
	  
	  while($field = $listar->fetch())
       	 {
		   $radicado=$field['radicado_consultar'];
		  }
		
	   $ano= substr($radicado, 12, 4);
	   $consecutivo=substr($radicado, 18, 3);	
	   $juzgado=substr($radicado, 11, 1);	
	   
	  
	  $vector[0][ano]=$ano;
	  $vector[0][consecutivo]=$consecutivo;
	  $vector[0][juzgado]=$juzgado;
	  
	  //print_r($vector);


	  return $vector; 

   

  }
  

 
  /***********************************************************************************/

  /*------------------------------ Listar Juzgado Destino ---------------------------------------*/

  /***********************************************************************************/

  public function listarJuzgadoDestino()

  {

  

	  $listar = $this->db->prepare("SELECT * from juzgado_destino");

	  $listar->execute();

	  return $listar; 

   

  } 
  
  /***********************************************************************************/

  /*------------------------------ Listar Juzgado Descongestión ---------------------------------------*/

  /***********************************************************************************/

  public function listarJuzgadosDescongestion()

  {

  

	  $listar = $this->db->prepare("SELECT * from pa_juzgadodescongestion");

	  $listar->execute();

	  return $listar; 

   

  } 
    /***********************************************************************************/

  /*--------------------------- Consultar Consecutivo Interno -----------------------------*/

  /***********************************************************************************/

  public function consultarConsecutivo()

  {

  

	  $listar = $this->db->prepare("SELECT * from consecutivo");

	  $listar->execute();

	  while($field = $listar->fetch())
	  {
	    $vect[0]=$field[consecutivo];
	  }
	  return $vect; 

   

  } 
  
  /***********************************************************************************/
  /*----------------------- Modificar Documento -------------------------------*/
  /***********************************************************************************/
  public function modificarDocumento()
  {
  
  $modelo     = new correspondenciaModel();

$tiene_radicado 		   	   	= $_POST['manual'];
$tipo_documento 		   	   	= $_POST['tipo_documento'];

//ASIGNADO POR JORGE ANDRES VALENCIA EL 13 DE AGOSTO DEL 2015, ESTO CON EL FIN DE PODER ACTUALIZAR EL CAMPO EN
//LA TABLA correspondencia
$juzgado  		   	   			= explode("-",$_POST['juzgado']);
$juzgadoA                       = $juzgado[0];

$solicitud   					= explode("-",$_POST['solicitud']);
$solicitudA   					= $solicitud[0];

$radicado   					= $_POST['radicado'];

$peticionario					= $_POST['peticionario'];
$folios							= $_POST['folios'];
$destino						= $_POST['juzgado_destino'];
$fecha  		   	   			= $_POST['fecha_entrega'];
$tiene_expediente				= $_POST['tiene_expediente'];		
$id 							= $_GET['nombre'];

$observacionesm                 = $_POST['observacionesm'];

//SOLO SE USA PARA EFECTOS DE PRUEBAS Y SABER COMO SE ARMA LA SQL, PARA DETECTAR PROBLEMAS
/*echo $incorpora."/".$juzgado."/".$solicitud; 		

$sql ="UPDATE correspondencia SET tipo_documento='$tipo_documento',idjuzgado='$juzgado',radicado='$radicado',
								  peticionario='$peticionario',folios='$folios',fecha_entrega='$fecha',idjuzgadodestino='$destino',idsolicitud='$solicitud', 
								  tiene_expediente='$tiene_expediente',incorporaexpediente = '$incorpora' where id='$id'";
								  
$sql2 = "UPDATE correspondencia SET tipo_documento='$tipo_documento',idjuzgado='$juzgado',radicado='$radicado',
                                  peticionario='$peticionario',folios='$folios',idsolicitud='$solicitud', 
								  tiene_expediente='$tiene_expediente',incorporaexpediente = '$incorpora' where id='$id'";
								  
								  
echo $sql."\n".$sql2;*/
  
if($tiene_radicado!=1)
{
 $radicado='';
}

//PARA EL LOG

	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Documento';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico un Documento ".$fechal." "."a las: ".$hora;
	  

	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  

//-------------------------------------------------------------------------------------------------------------------------------
//ASIGNADO POR JORGE ANDRES VALENCIA EL 01 DE JUNIO DEL 2015, Y NUEVA ASIGNACION
//EL 13 DE AGOSTO DEL 2015, ESTO CON EL FIN DE PODER ACTUALIZAR EL CAMPO idjuzgado Y idsolicitud EN
//LA TABLA correspondencia

//SI SELECCIONO checkbox ---> a_despacho
//SE REALIZA ESTA PREGUNTA, YA QUE AL MOMENTO DE INCORPORAL UN MEMORIAL
//A UN PROCESO, SE IDENTIFIQUE SI ESTA EN EL DESPACHO O ESTA EN LA SECRETARIA 
//ASIGNADO POR JORGE ANDRES VALENCIA EL 29 DE AGOSTO DEL 2019
/*if (isset($_REQUEST['a_despacho'])){

	$nota_adi = "EXPEDIENTE EN DESPACHO";
	
}
else{

	$nota_adi = "EXPEDIENTE EN SECRETARIA, SE DEJA DE NUEVO EN LA ULTIMA UBICACION";
}*/

//SE CIERRA EL CODIGO ANTERIOR, POR SOLICITUD DEL AREA DE MEMORIALES
//SE PRESENTABA POCA COMPRENSION DE LECTURA DE LA OBSERVACION POR PARTE DEL 
//JUZGADO 2 DE EJECUCION SERVIDOR JUDICIAL JESSIKA
$nota_adi = ", SE DEJA DE NUEVO EN LA ULTIMA UBICACION";

//REALIZAO ESTA PREGUNTA PARA DETERMINAR QUE SE SELECCIONA Se Incorpora Expediente al Proceso
//SE LLEVA ACABO LA ACTUALIZACION EN ESTE PUNTO YA QUE SI SE UBICA EN LAS UPDATE DE ABAJO
//PRESENTA PROBLEMA POR QUE EL idjuzgado='11-11' --> $fieldj[id]."-".$fieldj[numero_juzgado]
//Y EL DATO $juzgado NO SE LE APLICA UN EXPLODE PARA TOMAR UN VALOR Y SER ASIGNADO AL CAMPO idjuzgado DE
//LA TABLA CORRESPONDENCIA QUE EXPERA UN BIGINT(20) NO UNA CADENA COMO '11-11'
//IGUAL PASA CON idsolicitud

if (isset($_REQUEST['incorporaexpediente'])){

	$incorpora = 1;
	
	//SE REALIZA ESTA PREGUNTA, YA QUE EL MEMORIAL YA FUE ADICIONADO 
	// Y SE CREA OBSERVACION EN detalle_correspondencia
	//26 DE AGOSTO 2019, SOLO LA PARTE DE LA PREGUNTA if( trim($_POST['estaincorporado']) != 1 )
	//Y EL INSERT INTO detalle_correspondencia	
	if( trim($_POST['estaincorporado']) != 1 ){
		
		$actualizar = $this->db->prepare("UPDATE correspondencia SET 
										  incorporaexpediente = '$incorpora',observacionesm = '$observacionesm',fecha_incorpora = '$fechal' 
										  where id='$id'"); 
		
		$actualizar->execute();
		
		
		
		$id_radicado_detalleX   = $modelo->get_id_radicado_detalle($radicado);
		$filaDX                 = $id_radicado_detalleX->fetch();
		$id_radicado_detalle_2X = $filaDX[id];
		
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro = date('Y-m-d g:i');
		
		//$notaexp = "SE AGREGA MEMORIAL AL EXPEDIENTE, ID MEMORIAL: ".$id.", EXPEDIENTE EN DESPACHO";
		
		$notaexp = "SE AGREGA MEMORIAL AL EXPEDIENTE, ID MEMORIAL: ".$id.", ".$nota_adi;
		
		$actualizar_2 = $this->db->prepare("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,id_memorial,idusuario) 
											VALUES('$id_radicado_detalle_2X','$fecharegistro','$notaexp','$id','$idres')"); 
											
		
		$actualizar_2->execute();
	
	}
	
	
}
//-------------------------------------------------------------------------------------------------------------------------------

if($destino!='')
{

	$actualizar = $this->db->prepare("UPDATE correspondencia SET tipo_documento='$tipo_documento',idjuzgado='$juzgadoA',radicado='$radicado',
									  peticionario='$peticionario',folios='$folios',fecha_entrega='$fecha',idjuzgadodestino='$destino',idsolicitud='$solicitudA', 
									  tiene_expediente='$tiene_expediente',observacionesm = '$observacionesm' where id='$id'"); 

	$actualizar->execute(); 
}
else
{
	
	$actualizar = $this->db->prepare("UPDATE correspondencia SET tipo_documento='$tipo_documento',idjuzgado='$juzgadoA',radicado='$radicado',
                                      peticionario='$peticionario',folios='$folios',idsolicitud='$solicitudA', 
								      tiene_expediente='$tiene_expediente',observacionesm = '$observacionesm' where id='$id'"); 
	
	$actualizar->execute(); 
}

$resultado = $actualizar->rowCount();

	 
	  
	   
  	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
   
  

  } 
  
  
 /***********************************************************************************/
  /*----------------------- Registrar Correspondencia Otro-------------------------------*/
  /***********************************************************************************/
  public function generarEntrega()
  {                


  $cantidad=$_POST['cantidad'];
  $i=1;
  $j=0;
  
  
  while($i<=$cantidad){
  if(isset($_POST['entrega-'.$i]))
    {  
  		 $id=$_POST['entrega-'.$i];
		$actualizar = $this->db->prepare("UPDATE correspondencia SET generado='si' where id='$id'"); 
		$actualizar->execute();
		
		$consultar = $this->db->prepare("select corr.radicado,corr.tipo_documento,corr.tiene_expediente,corr.folios,sol.nombre as solicitud, jd.nombre as juzdes from correspondencia corr
inner join juzgado_destino jd on (corr.idjuzgadodestino=jd.id)
inner join pa_solicitud sol on (sol.id=corr.idsolicitud) where corr.id='$id' order by corr.idjuzgadodestino"); 
		$consultar->execute();
		
		
		
		while($field = $consultar->fetch())
		{
		$vector[$j][radicado]=$field[radicado];
		$vector[$j][tipo_documento]=$field[tipo_documento];
		$vector[$j][tiene_expediente]=$field[tiene_expediente];
		$vector[$j][folios]=$field[folios];
		$vector[$j][solicitud]=$field[solicitud];
		$vector[$j][juzdes]=$field[juzdes];
		$j++;
		
		} 
		
    } 
	$i++;
  }
  return $vector;
 
    
 }
  
 /***********************************************************************************/
  /*----------------------- Registrar Correspondencia Otro-------------------------------*/
  /***********************************************************************************/
  public function datosEntrega()
  {                


  $cantidad=$_POST['cantidad'];
  $i=1;
  
  
  while($i<=$cantidad){
  if(isset($_POST['entrega-'.$i]))
    {  
  		echo $id=$_POST['entrega-'.$i];
		$actualizar = $this->db->prepare("UPDATE correspondencia SET generado='si' where id='$id'"); 
		$actualizar->execute(); 
    } 
	$i++;
  }
 }  
  
  
  
  /***********************************************************************************/

  /*------------------------------ Listar Ciudades ---------------------------------------*/

  /***********************************************************************************/

  public function listarCiudadDepartamento()

  {

	 	
      $iddepartamento= $_GET['depto'];

	  $listar = $this->db->prepare("SELECT * from pa_ciudad where iddepartamento='iddepartamento'");

	  $listar->execute();

	  return $listar; 

   

  }	
   /***********************************************************************************/

  /*------------------------------ Listar Ciudades ---------------------------------------*/

  /***********************************************************************************/

  public function listarCiudad()

  {

	 	

	  $listar = $this->db->prepare("SELECT * from pa_municipio order by nombre");

	  $listar->execute();

	  return $listar; 

   

  } 


  /***********************************************************************************/

  /*------------------------------ Listar Departamentos  ---------------------------------------*/

  /***********************************************************************************/

  public function listarDepartamentos()

  {

    

	  $listar = $this->db->prepare("SELECT * from pa_departamento order by nombre");

	  $listar->execute();

	  return $listar; 

   

  }	
  
  
  /***********************************************************************************/

  /*----------------------- Listar Medios Notificación  ----------------------s---------*/

  /***********************************************************************************/

  public function listarMedio()

  {

    

	  $listar = $this->db->prepare("SELECT * from pa_medionotificacion order by nombre");

	  $listar->execute();

	  return $listar; 

   

  }	
  
    /***********************************************************************************/

  /*----------------------- Listar Actuación  ----------------------s---------*/

  /***********************************************************************************/

  public function listarActuacion()

  {

    

	  $listar = $this->db->prepare("SELECT * from pa_actuacion order by nombre");

	  $listar->execute();

	  return $listar; 

   

  }	
  
/***********************************************************************************/
  /*----------------------- Registrar Correspondencia Otro-------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondenciaOtro()
  {                

  $i= 1;  
  $dir="views/evidencias/";
  

  
  $numero2 = count($_POST);
  $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
  $valores2 = array_values($_POST);// obtiene los valores de las varibles

  // crea las variables y les asigna el valor
	for($i=0;$i<$numero2;$i++){ 
	$$tags2[$i]=$valores2[$i]; 
	}

	$j=0;
	while ($j < $numero2)
    {
     $tags2[$j]. " ";
     $j = $j+1;
     }
$radicado  		   	   			= $radicado;

$idjuzgado 		   	   			= $juzgado;


$oficio_telegrama  	   			= $oficio_telegrama ;
$destinatario      	  			= $destinatario ;
$direccion 		   	   			= $direccion;
$idmunicipio	       			= $estados;
$idmedionotificacion   			= $medio_notificacion;
$notificado		   	   			= "Si";
$fecha  		   	   			= $fecha;
$cantidad_evidencias   			= $cantidad1;
$esOficio_Telegrama			    = $esOficio_Telegrama;

 if ($notificado =='Si')
 {
  $notificado ='Si';
 }
 else
 {
  $notificado ='No';
 }
 
 try {  
			
			//EMPIEZA LA TRANSACCION
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->beginTransaction();

 $registrar = $this->db->prepare("INSERT INTO correspondencia_otros (radicado,idjuzgado,esOficio_Telegrama,oficio_telegrama,destinatario,direccion,idmunicipio,idmedionotificacion,notificado,fecha)
values ('$radicado','$idjuzgado','$esOficio_Telegrama','$oficio_telegrama','$destinatario', '$direccion', '$idmunicipio', '$idmedionotificacion', '$notificado', '$fecha')");

	  $registrar->execute(); 
      $resultado = $registrar->rowCount();
	  
	  //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA correspondencia_otros
	  $id     = $this->db->lastInsertId(); 
	  
/*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia_otros");
$consultar->execute();

	while($field = $consultar->fetch())
        {
		 
		
		  $id=$field['id'];

         }*/
		 
$i=1;


/*
if ((($idmedionotificacion==3)|| ($idmedionotificacion==5)||($idmedionotificacion==6)) && ($notificado=="Si"))

{

    
	$dir="views/evidencias/";
	$nombre = "evidencia_".$radicado;
	$ext = explode(".",$_FILES['evidencia']['name']);
	$ext = $ext[1];
	$archivo_evidencia= $dir.$nombre.".".$ext;
   
   if(move_uploaded_file($_FILES['evidencia']['tmp_name'], $archivo_evidencia))
    {
 	  $registrar1 = $this->db->prepare("INSERT INTO evidencia_otros (idcorrespondenciaotros,evidenciaotros) values ('$id','$archivo_evidencia')");
	  $registrar1->execute(); 
    
    }
    else
    {
    echo "no";
    }
		 
  
   while ($i<=$cantidad_evidencias)
   {
	   $nombre = "evidencia_".$radicado."_".$i;
	   $ext = explode(".",$_FILES['evidencia'.$i]['name']);
	   $ext = $ext[1];
	   $archivo_evidencia= $dir.$nombre.".".$ext;
	   if(move_uploaded_file($_FILES['evidencia'.$i]['tmp_name'], $archivo_evidencia))
   		{
		  $registrar1 = $this->db->prepare("INSERT INTO evidencia_otros (idcorrespondenciaotros,evidenciaotros) values ('$id','$archivo_evidencia')");
		  $registrar1->execute(); 
		
   		}
	   else
   		{
    		
   		}
   		$i= $i+1;
    
  }
  
   
}
else
{

}
 */
      date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Resgistr&oacute; Documento';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro un nuevo Documento ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
 $resultado = $registrar->rowCount();
 
 if( $resultado)
 {
 
  //SE TERMINA LA TRANSACCION  
  $this->db->commit();	
  
   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
  }
  else
  {
  
   //SE TERMINA LA TRANSACCION  
   $this->db->commit();	
   
   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=8"</script>';
  } 
  
  

}
catch (Exception $e) {
			
	//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
	$this->db->rollBack();
	echo $idjuzgado."****"."Fallo: " . $e->getMessage();
	
}
   
   

  
 }  

/***********************************************************************************/
  /*----------------------- Registrar Correspondencia -------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondencia()
  {

  $i= 1;  
  $dir="views/evidencias/";
  

  
  $numero2 = count($_POST);
  $tags2 = array_keys($_POST); // obtiene los nombres de las varibles
  $valores2 = array_values($_POST);// obtiene los valores de las varibles

  // crea las variables y les asigna el valor
	for($i=0;$i<$numero2;$i++){ 
	$$tags2[$i]=$valores2[$i]; 
	}

	$j=0;
	while ($j < $numero2)
    {
     $tags2[$j]. " ";
     $j = $j+1;
     }
$radicado  		   	   			= $radicado;
$idjuzgado 		   	   			= $juzgado;
$oficio_telegrama  	   			= $oficio_telegrama ;
$destinatario      	  			= $destinatario ;
$direccion 		   	   			= $direccion;
$idmunicipio	       			= $estados;
$idmedionotificacion   			= $medio_notificacion;
$notificado		   	   			= $notificado;
$fecha  		   	   			= $fecha;
$idclaseproceso	   	   			= $clase_proceso;
$idactuacion	   	   			= $actuacion;
$accionante   		   			= $accionante;
$cantidad_evidencias   			= $cantidad1;
$cantidad_accionado_vinculado   = $cantidad;

 if ($notificado ==1)
 {
  $notificado ='S';
 }
 else
 {
  $notificado ='N';
 }

 $registrar = $this->db->prepare("INSERT INTO correspondencia (radicado,idjuzgado,oficio_telegrama,destinatario,direccion,idmunicipio,idmedionotificacion,notificado,fecha,
idclaseproceso,idactuacion,accionante)
values ('$radicado','$idjuzgado','$oficio_telegrama','$destinatario', '$direccion', '$idmunicipio', '$idmedionotificacion', '$notificado', '$fecha', '$idclaseproceso', '$idactuacion', '$accionante')");

	  $registrar->execute(); 
      $resultado = $registrar->rowCount();
	  
$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia");
$consultar->execute();

	while($field = $consultar->fetch())
        {
		 
		
		  $id=$field['id'];

         }
		 
$i=1;

if ((($idmedionotificacion==3)|| ($idmedionotificacion==5)) && ($notificado==1))
{
	$dir="views/evidencias/";
	$nombre = "evidencia_".$radicado;
	$ext = explode(".",$_FILES['evidencia']['name']);
	$ext = $ext[1];
	$archivo_evidencia= $dir.$nombre.".".$ext;
   
   if(move_uploaded_file($_FILES['evidencia']['tmp_name'], $archivo_evidencia))
    {
 	  $registrar1 = $this->db->prepare("INSERT INTO evidencia (idcorrespondencia,evidencia) values ('$id','$archivo_evidencia')");
	  $registrar1->execute(); 
    
    }
    else
    {
    
    }
		 
  
   while ($i<=$cantidad_evidencias)
   {
	   $nombre = "evidencia_".$radicado."_".$i;
	   $ext = explode(".",$_FILES['evidencia'.$i]['name']);
	   $ext = $ext[1];
	   $archivo_evidencia= $dir.$nombre.".".$ext;
	   if(move_uploaded_file($_FILES['evidencia'.$i]['tmp_name'], $archivo_evidencia))
   		{
		  $registrar1 = $this->db->prepare("INSERT INTO evidencia (idcorrespondencia,evidencia) values ('$id','$archivo_evidencia')");
		  $registrar1->execute(); 
		
   		}
	   else
   		{
    		
   		}
   		$i= $i+1;
    
  }
   
}
 
if($idclaseproceso!=3)
{
 $j=1;
 if($esAccionado==1) {  $esAccionado='S'; }
 else  {  $esAccionado='N'; }
 
 $registrar2 = $this->db->prepare("INSERT INTO accionado_vinculado (idcorrespondencia,accionado_vinculado,esaccionado) values ('$id','$accionado','$esAccionado')");
 $registrar2->execute();
 
 
 
 while ($j<=$cantidad_accionado_vinculado)
  	{
      if($_POST['accionado'.$j]!="")
	  {
 		$accionado   = $_POST['accionado'.$j];
		$esAccionado = $_POST['esAccionado'.$j];
		 if($esAccionado==1) {  $esAccionado='S'; }
 else  {  $esAccionado='N'; }
		
		
		$registrar3 = $this->db->prepare("INSERT INTO accionado_vinculado (idcorrespondencia,accionado_vinculado,esaccionado) values 			('$id','$accionado','$esAccionado')");
		$registrar3->execute();	    
	  }
	  $j = $j+1;  
    }


   print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=1"</script>';
   
   
   
   

  }
 }



/***********************************************************************************/
  /*----------------------- Registrar Correspondencia Tutela -------------------------------*/
  /***********************************************************************************/
  
  public function get_fecha_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
	}
  
  public function registrarCorrespondenciaTutela()
  {


  $dir="views/evidencias/";
  

  

	 
$radicado  		   	   			= $_POST['radicado'];

$idjuzgadodatos 		   	   	= explode("-",$_POST['juzgado']);
$idjuzgado 		   	   			= $idjuzgadodatos[0];


$fecha  		   	   			= $_POST['fecha'];
$cantidad_evidencias   			= $_POST['cantidad_evidencias'];
$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
$proceso					    = $_POST['proceso'];
$accionante						= $_POST['accionante'];
$cantidad_accionados			= $_POST['cantidad_accionados'];
$cantidad_vinculados			= $_POST['cantidad_vinculados'];
$tiene_accionado				= $_POST['tiene_accionado'];
$tiene_vinculado				= $_POST['tiene_vinculado'];



	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	 
	  $accion='Resgistr&oacute; Tutela';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Registro una nueva Tutela ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 1 porque va asociado al módulo de archivo 
	  $tipolog=2;
	  
	  try {  
			
			//EMPIEZA LA TRANSACCION
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->beginTransaction();
			

				  $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');");
			
				  $insertarlog->execute();
				  
				  
				  $registrar = $this->db->prepare("INSERT INTO correspondencia_tutelas (radicado,idjuzgado,fecha,Tutela_Incidente)
                  values ('$radicado','$idjuzgado','$fecha', '$proceso')");

	              $registrar->execute(); 
                  $resultado = $registrar->rowCount();
	 
				  
				  //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA correspondencia_tutelas
				  $id     = $this->db->lastInsertId();

				/*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia_tutelas");
				$consultar->execute();
			
				while($field = $consultar->fetch())
					{
					 
					
					  $id=$field['id'];
			
					 }*/
					 
			$i=$j=1;
			
			
			
			/*if ($cantidad_evidencias>0)
			{
			
			
				$dir="views/evidencias/";
				
					 
			  
			   while ($i<=$cantidad_evidencias)
			   {
				 
				   $nombre = "evidencia_".$radicado."_".$i;
				   $ext = explode(".",$_FILES['evidencia'.$i]['name']);
				   $ext = $ext[1];
				   $archivo_evidencia= $dir.$nombre.".".$ext;
				   if(move_uploaded_file($_FILES['evidencia'.$i]['tmp_name'], $archivo_evidencia))
					{
					  $registrar1 = $this->db->prepare("INSERT INTO evidencia (idcorrespondencia,evidencia) values ('$id','$archivo_evidencia')");
					  $registrar1->execute(); 
					
					}
				   
					
				 
				 $i= $i+1;	
				
			  }
			}  */
			
			// $cantidad_accionado_vinculado;
			   
			
			$registrar_accionante = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$accionante','Accionante')");
			 $registrar_accionante->execute();
			 
			 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA accionante_accionado_vinculado
		     $id_accionante     = $this->db->lastInsertId();
			 
			 /*$consultar_accionante = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
			 $consultar_accionante->execute();
			
				while($field = $consultar_accionante->fetch())
					{
					 
					
					  $id_accionante=$field['id'];
			
					 }	*/
			
			
			
			
			
			$i_accionados = 0;
			$i_accionados1 = 1; 
			 
			 if ($tiene_accionado=='on')
			 {
			 
			 $vector_accionados[$i_accionados][nombre] = $_POST['accionado'];
			 $i_accionados = $i_accionados+1;
			 if ($cantidad_accionados>0)
			 {
			  while($i_accionados<=$cantidad_accionados){  
			  if($_POST['accionado'.$i_accionados])
			   {
				$vector_accionados[$i_accionados1][nombre] = $_POST['accionado'.$i_accionados];   
				$i_accionados1 = $i_accionados1+1;
			   
			   }
			   $i_accionados = $i_accionados+1;
			  
			  } 
			  
			 }
				$ins = 0;  
				//print_r($vector_accionados);
				$cant_insert_accionados = count($vector_accionados);
				while($ins < $cant_insert_accionados)
				{
				
					$accionado_temp = $vector_accionados[$ins][nombre];
					$registrar_accionados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$accionado_temp','Accionado')");
					 $registrar_accionados->execute();
					 
					 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA accionante_accionado_vinculado
		            $id_accionado     = $this->db->lastInsertId();
					 
					 /*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
			$consultar->execute();
			
				while($field = $consultar->fetch())
					{
					 
					
					  $id_accionado=$field['id'];
			
					 }*/
					 
					 $vector_accionados[$ins][idbd]=$id_accionado;
					 
					 
					 $ins = $ins+1;	  	
				
				}
			//print_r($vector_accionados);
			
			 }
			 else
			 {
			 //echo "no tiene accionado";
			 }
			
			
			$i_vinculados = 0;
			$i_vinculados1 = 1; 
			 
			 if ($tiene_vinculado=='on')
			 {
			 
			 $vector_vinculados[$i_vinculados][nombre] = $_POST['vinculado'];
			 $i_vinculados = $i_vinculados+1;
			 if ($cantidad_vinculados>0)
			 {
			  while($i_vinculados<=$cantidad_vinculados){  
			  if($_POST['vinculado'.$i_vinculados])
			   {
				$vector_vinculados[$i_vinculados1][nombre] = $_POST['vinculado'.$i_vinculados];   
				$i_vinculados1 = $i_vinculados1+1;
			   
			   }
			   $i_vinculados = $i_vinculados+1;
			  
			  } 
			  
			 }
			$insv = 0;    
			//print_r($vector_vinculados);
			$cant_insert_vinculados = count($vector_vinculados);
				while($insv < $cant_insert_vinculados)
				{
				
					$vinculado_temp = $vector_vinculados[$insv][nombre];
					$registrar_vinculados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$vinculado_temp','Vinculado')");
					 $registrar_vinculados->execute();
					 
					  //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA accionante_accionado_vinculado
		             $id_vinculado     = $this->db->lastInsertId();
					
					 /*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
					 $consultar->execute();
			
				while($field = $consultar->fetch())
					{
					 
					
					  $id_vinculado=$field['id'];
			
					 }*/
					 
					 $vector_vinculados[$insv][idbd]=$id_vinculado;
					 $insv = $insv+1;
					 
					 
			   }		 	  	
			
			//print_r($vector_vinculados);
			
			 }
			 else
			 {
			// echo "no tiene vinculados";
			 } 
			 
			
			 
			 
			
			 while ($j<=$cantidad_accionado_vinculado)
			
				{
				  if($_POST['oficio_telegrama_numero'.$j]!="")
				  {
					
					 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
					 $idactuacion						  = $_POST['idactuacion'.$j];
					 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
					 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
					 $direccion							  = $_POST['direccion'.$j];
					 $idmunicipio						  = $_POST['ciudad'.$j];
					 $idmedionotificacion				  = $_POST['medio'.$j];
					 $fecha_envio						  = $_POST['fecha_envio'.$j];
					 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
					 $notificado						  = "Si";
					 
					 if($esaccionante_accionado_vinculado=='Accionante')
					 {
					   $idaccionado_vinculado_accionante_tut = $id_accionante;
					 }
					 
					 if($esaccionante_accionado_vinculado=='Accionado')
					 {
					   
					   $accionado_nombre = $_POST['accionados_sl'.$j];
					   $cont_vect = count($vector_accionados);
					   $jj= 0;
						
						while($jj<$cont_vect)
						{
						 if($vector_accionados[$jj][nombre]==$accionado_nombre)
						 {
						  $index = $jj;
						  $jj= $cont_vect;
						 }
						 $jj++;
						}
						$idaccionado_vinculado_accionante_tut =   $vector_accionados[$index][idbd];
					 }
					 
					 
					 if($esaccionante_accionado_vinculado=='Vinculado')
					 {
					   
					   $vinculado_nombre = $_POST['vinculados_sl'.$j];
					   $cont_vect_v = count($vector_vinculados);
					   $v= 0;
						
						while($v<$cont_vect_v)
						{
						 if($vector_vinculados[$v][nombre]== $vinculado_nombre)
						 {
						  $index_v = $v;
						  $v= $cont_vect_v;
						 }
						 $v++;
						}
						$idaccionado_vinculado_accionante_tut =   $vector_vinculados[$index_v][idbd];
					 }
					 
					  if($esaccionante_accionado_vinculado=='Otro')
					 {
					 
					  
					  $otro_texto = $_POST['texto_otro'.$j];
					  $registrar_otro = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$otro_texto','Otro')");
					 $registrar_otro->execute();
					 
					 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA accionante_accionado_vinculado
		             $id_otro     = $this->db->lastInsertId();
					 
					 /*$consultar_otro = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
					 $consultar_otro->execute();
			
					while($field = $consultar_otro->fetch())
					 {
					  $id_otro=$field['id'];
					 }*/
					
					  
					   $idaccionado_vinculado_accionante_tut = $id_otro;
					 }
					 
					 
					 
					$registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$idaccionado_vinculado_accionante_tut','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
					$registrar4->execute();	
					
				  }
				  $j = $j+1;  
				}
			
				
			  //SE TERMINA LA TRANSACCION  
			  $this->db->commit();	
			  
			  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
   
  
  } 
  catch (Exception $e) {
			
	//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
	$this->db->rollBack();
	echo $idjuzgado."****"."Fallo: " . $e->getMessage();
	
  } 
  

  }
 
 
 /***********************************************************************************/
  /*----------------------- Modificar Correspondencia Tutela -------------------------------*/
  /***********************************************************************************/
  public function modificarCorrespondenciaTutela()
  {

	
	 date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modifc&oacute; Tutela';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico una Tutela ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 2 porque va asociado al módulo de correspondencia 
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	
	
	 

$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
$idtutela=$_GET['nombre'];

$i=$j=1;


 while ($j<=$cantidad_accionado_vinculado)

  	{
      if($_POST['parte_id'.$j]=="no_parte")
	  {
 		

		
		  $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
	     $accionante_accionado_vinculado      = $_POST['accionante_accionado_vinculado_texto'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
     	 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $notificado						  = "Si";
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
		
		
				
		$registrar3 = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$idtutela','$accionante_accionado_vinculado','$esaccionante_accionado_vinculado')");
		$registrar3->execute();	
		
		
		$consultar3 = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
	    $consultar3->execute();

	while($field = $consultar3->fetch())
        {
		 
		
		   $idaccionado_vinculado_accionante_tut=$field['id'];

         }
		
		
			$registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$idaccionado_vinculado_accionante_tut','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
		$registrar4->execute();	
		 $j = $j+1; 
		
		
	  }
	  else
	  {
	     
		 $parte_id 							  = $_POST['parte_id'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
     	 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $notificado						  = "Si";
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
	  
	  $registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (idaccionado_vinculado_accionante_tut,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion,tipo_actuacion) values ('$parte_id','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion','$tipo_actuacion')");
		$registrar4->execute();	
	  
	  
	  
	  
	  
	  $j = $j+1;  
	  }
    }


  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';
   
   
   
   

  }




/***********************************************************************************/
  /*--------------- Registrar Correspondencia Incidente -------------------------------*/
  /***********************************************************************************/
  public function registrarCorrespondenciaIncidente()
  {


  	 
$radicado  		   	   			   			= $_POST['radicado'];
echo $idjuzgado 		   	   						= $_POST['juzgado'];
$fecha  		   	   						= $_POST['fecha'];
$cantidad_accionado_vinculado_formulario    = $_POST['contador_partes'];
$cantidad_accionado_vinculado_creados       = $_POST['cantidad_detalles'];


$consultar = $this->db->prepare("SELECT id FROM correspondencia_tutelas where radicado ='$radicado'");
$consultar->execute();

while($field = $consultar->fetch())
        {
			
		 $idtutela=$field['id'];
        }


 /*$registrar = $this->db->prepare("INSERT INTO correspondencia_incidentes (radicado,idjuzgado,fecha,idtutela)
values ('$radicado','$idjuzgado','$fecha','$idtutela')");

	  $registrar->execute(); 
      $resultado = $registrar->rowCount();
	  
	  
	  
$consultar = $this->db->prepare("SELECT MAX(id) as id FROM correspondencia_incidentes");
$consultar->execute();

	while($field = $consultar->fetch())
        {
		 
		
		  $id=$field['id'];

         }
		 
$i=$j=1;

 while ($j<=$cantidad_accionado_vinculado_creados)
  	{
      if($_POST['accionante_accionado_vinculado_texto'.$j]!="")
	  {
 		
		 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
	     $accionante_accionado_vinculado      = $_POST['accionante_accionado_vinculado_texto'.$j];
		 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
		 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
		 $direccion							  = $_POST['direccion'.$j];
     	 $idmunicipio						  = $_POST['ciudad'.$j];
		 $idmedionotificacion				  = $_POST['medio'.$j];
		 $notificado						  = $_POST['notificado'.$j];
		 $fecha_envio						  = $_POST['fecha_envio'.$j];
		 $idactuacion						  = $_POST['idactuacion'.$j];
		
		
				
		$registrar3 = $this->db->prepare("INSERT INTO accionante_accionado_vinculado_incidentes (idcorrespondencia_incidentes,accionante_accionado_vinculado,esaccionante_accionado_vinculado,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion) values ('$id','$accionante_accionado_vinculado','$esaccionante_accionado_vinculado','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion')");
		$registrar3->execute();	 
		
		
		
		
		
		
		
	  }
	  $j = $j+1;  
    }
	
	
 while ($i<=$cantidad_accionado_vinculado_formulario)
  	{	
	if($_POST['selecciona_parte'.$i]=="Si")
	  {
	  	 $esoficio_telegrama			      = $_POST['oficio_telegrama_f'.$i];
		 $oficio_telegrama			          = $_POST['numero_oficio_telegrama_f'.$i];
		 $idactuacion						  = $_POST['actuacion_f'.$i];
		 $direccion							  = $_POST['direccion_f'.$i];
		 $idmunicipio						  = $_POST['ciudad_f'.$i];
		 $idmedionotificacion				  = $_POST['medio_f'.$i];
		 $notificado						  = $_POST['notificado_f'.$i];
		 $fecha_envio						  = $_POST['fecha_f'.$i];
	     $accionante_accionado_vinculado      = $_POST['nombre_parte'.$i];
		 $esaccionante_accionado_vinculado    = $_POST['tipo_parte'.$i];
		
		$registrar3 = $this->db->prepare("INSERT INTO accionante_accionado_vinculado_incidentes (idcorrespondencia_incidentes,accionante_accionado_vinculado,esaccionante_accionado_vinculado,esoficio_telegrama,oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,idactuacion) values ('$id','$accionante_accionado_vinculado','$esaccionante_accionado_vinculado','$esoficio_telegrama','$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion','$notificado','$fecha_envio','$idactuacion')");
		$registrar3->execute();	 
		 
		 
		 
		 
	  }
	    $i = $i+1;  

    }*/






/*
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=1"</script>';*/
   
   
   
   

  }
 






/***********************************************************************************/

  /*------------------------------  Listar Todas las Tutelas  --------------------*/

  /***********************************************************************************/

  public function listarCorrespondenciasTutelas()

  {

  

  $listar = $this->db->prepare("select tutelas.id as idt,tutelas.radicado as radicado,area.nombre as area,juzgado.nombre as juzgado ,tutelas.fecha as fecha, tutelas.idjuzgado as idjuz 
from  correspondencia_tutelas tutelas inner join pa_juzgado juzgado on tutelas.idjuzgado=juzgado.id
inner join pa_area area on (area.id=juzgado.idarea)
");

  $listar->execute();

  return $listar;

  

  }
  /***********************************************************************************/

  public function listarJuzgadoIncidente()

  {

  $idjuz = $_GET['nombre2'];

  $listar = $this->db->prepare("select * from pa_juzgado where id='$idjuz'
");

  $listar->execute();

  return $listar;

  

  }
    /***********************************************************************************/

  public function listarJuzgado()

  {

  $listar = $this->db->prepare("select * from pa_juzgado");

  $listar->execute();

  return $listar;

  

  }
/***********************************************************************************/

  /*------------------------------  Listar Todas las correspondencias  --------------------*/

  /***********************************************************************************/

  public function listarCorrespondencias()

  {

  

  $listar = $this->db->prepare("select correspondencia.id as idd,correspondencia.radicado,pa_juzgado.nombre as juzgado,correspondencia.oficio_telegrama as telegrama,
correspondencia.destinatario,correspondencia.direccion,pa_municipio.nombre as municipio,pa_medionotificacion.nombre as medio,
correspondencia.notificado,correspondencia.fecha, pa_claseproceso.nombre as clase, pa_actuacion.nombre as actuacion,
correspondencia.accionante,pa_departamento.nombre as departamento
from correspondencia 
inner join pa_juzgado on (correspondencia.idjuzgado = pa_juzgado.id)
inner join pa_municipio on (correspondencia.idmunicipio = pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento = pa_departamento.id)
inner join pa_claseproceso on (correspondencia.idclaseproceso = pa_claseproceso.id)
left join  pa_actuacion on (correspondencia.idactuacion = pa_actuacion.id)
inner join pa_medionotificacion on (correspondencia.idmedionotificacion = pa_medionotificacion.id)");

  $listar->execute();

  return $listar;

  

  }
  
 /***********************************************************************************/

  /*------------------------------  Listar correspondencias otros  --------------------*/

  /***********************************************************************************/

  public function listarCorrespondenciasOtros()

  {

  

  $listar = $this->db->prepare("select correspondencia.id as corresid,correspondencia.radicado,juzgado.nombre as juzgadonom,correspondencia.esOficio_Telegrama,correspondencia.oficio_telegrama,
correspondencia.destinatario, medio.nombre as medionot,correspondencia.notificado,correspondencia.direccion
from correspondencia_otros as correspondencia
inner join pa_juzgado as juzgado on (juzgado.id=correspondencia.idjuzgado)
inner join pa_medionotificacion as medio on (medio.id=correspondencia.idmedionotificacion)");

  $listar->execute();

  return $listar;

  

  }
 
/***********************************************************************************/

  /*-----------------------  Consultar Correspondencia especifica  --------------------*/

  /***********************************************************************************/

  public function listarCorrespondencia()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("select correspondencia.radicado,pa_juzgado.nombre as juzgado,correspondencia.oficio_telegrama as telegrama,
correspondencia.destinatario,correspondencia.direccion,pa_municipio.nombre as municipio,pa_municipio.id as idmunicipio,
pa_medionotificacion.nombre as medio,pa_medionotificacion.id as idmedio,
correspondencia.notificado,correspondencia.fecha, pa_claseproceso.nombre as clase, pa_actuacion.nombre as actuacion,
correspondencia.accionante,pa_departamento.nombre as departamento,pa_departamento.id as iddepartamento,pa_medionotificacion.id as idmedio, pa_juzgado.id as idjuzgado
from correspondencia 
inner join pa_juzgado on (correspondencia.idjuzgado = pa_juzgado.id)
inner join pa_municipio on (correspondencia.idmunicipio = pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento = pa_departamento.id)
inner join pa_claseproceso on (correspondencia.idclaseproceso = pa_claseproceso.id)
left join pa_actuacion on (correspondencia.idactuacion = pa_actuacion.id)
inner join pa_medionotificacion on (correspondencia.idmedionotificacion = pa_medionotificacion.id) 
where correspondencia.id='$id'");

  $listar->execute();

  return $listar;

  

  }

/***********************************************************************************/

  /*-----------------------  Consultar Correspondencia Otro especifica  --------------------*/

  /***********************************************************************************/

  public function listarCorrespondenciaOtro()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("select correspondencia_otros.radicado,pa_juzgado.nombre as juzgado,correspondencia_otros.esOficio_Telegrama,correspondencia_otros.oficio_telegrama,
correspondencia_otros.destinatario,correspondencia_otros.direccion,pa_municipio.nombre as municipio, pa_medionotificacion.nombre as medio,
correspondencia_otros.notificado,correspondencia_otros.fecha ,correspondencia_otros.idjuzgado,correspondencia_otros.idmunicipio,correspondencia_otros.idmedionotificacion,pa_departamento.nombre as departamento, pa_departamento.id as iddepa
from correspondencia_otros 
inner join pa_juzgado on (correspondencia_otros.idjuzgado=pa_juzgado.id)
inner join pa_municipio on (correspondencia_otros.idmunicipio=pa_municipio.id)
inner join pa_departamento on (pa_municipio.iddepartamento=pa_departamento.id)
inner join pa_medionotificacion on (correspondencia_otros.idmedionotificacion=pa_medionotificacion.id) 
where correspondencia_otros.id='$id'");

  $listar->execute();

  return $listar;

  

  }
/***********************************************************************************/

  /*------------------ Listar ciudades para modificar correspondencia otro  --------------------*/

  /***********************************************************************************/

  public function listarCiudadOtro()

  {

    $id=$_GET['nombre'];

  $listar = $this->db->prepare("select de.id as iddepa from correspondencia_otros co
inner join pa_municipio mu on (mu.id=co.idmunicipio)
inner join pa_departamento de on (de.id=mu.iddepartamento)
where co.id='$id'");

 $listar->execute();
 
 while($field = $listar->fetch())
        {
		 
		
		   $ide=$field['iddepa'];

         }
  $listar1 = $this->db->prepare("select * from pa_municipio where iddepartamento='$ide'");

 $listar1->execute(); 
 

  return $listar1;

  

  }



/***********************************************************************************/

  /*-----------------------  Consultar Accionado Vinculado -------------------------*/

  /***********************************************************************************/

  public function listarAccionadosVinculados()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("select * from accionado_vinculado where idcorrespondencia='$id'");

  $listar->execute();

  return $listar;

  

  } 
  
  /***********************************************************************************/

  /*-----------------------  Listar Áreas Empleados -------------------------*/

  /***********************************************************************************/

  public function listarAreasEmpleados()

  {


  $listar = $this->db->prepare("select * from pa_areaempleado");

  $listar->execute();

  return $listar;

  

  } 
  
 /***********************************************************************************/

  /*----------------------------  Consultar Evidencias    -------------------------*/

  /***********************************************************************************/

  public function listarEvidencias()

  {

   $id=$_GET['nombre'];

  $listar = $this->db->prepare("select * from evidencia where idcorrespondencia='$id'");

  $listar->execute();

  return $listar;

  

  }
   /***********************************************************************************/

  /*----------------------------  Consultar Evidencias Otros   -------------------------*/

  /***********************************************************************************/

  public function listarEvidenciasOtros()

  {

 $id=$_GET['nombre'];

  $listar = $this->db->prepare("select * from evidencia_otros where idcorrespondenciaotros='$id'");

  $listar->execute();

  return $listar;

  

  }  
 
  /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas    -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelas()

  {



  $listar = $this->db->prepare("select tutelas.id as idtutelas,tutelas.radicado as radicado,juzgado.nombre as juzgado
from correspondencia_tutelas as tutelas inner join pa_juzgado juzgado
ON (tutelas.idjuzgado=juzgado.id)
");

  $listar->execute();

  return $listar;

  

  }
  
    /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas Disponibilidad   -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelasExistentes()

  {



  $listar = $this->db->prepare("select radicado from correspondencia_tutelas");

  $listar->execute();

  return $listar;

  

  }
      /***********************************************************************************/

  /*------------------------  Listar Radicados de Tutelas Disponibilidad Modificar -------------------------*/

  /***********************************************************************************/

  public function listarRadicadosTutelasExistentesModificar()

  {


  $id=$_GET['nombre'];
  $listar = $this->db->prepare("select radicado from correspondencia_tutelas where id not in ('$id')");

  $listar->execute();

  return $listar;

  

  }
  
   /***********************************************************************************/

  /*------------------------  Listar Accionados Accionantes Vinculados    -------------------------*/

  /***********************************************************************************/

  public function listarAccionadosVinculadosAccionantes()

  {


  $rad=$_GET['nombre'];
  $consultar = $this->db->prepare("SELECT id FROM correspondencia_tutelas where radicado ='$rad'");
  $consultar->execute();

	while($field = $consultar->fetch())
        {
		 
		
		  $id=$field['id'];

         }
  //echo $id;
  $listar = $this->db->prepare("select accionante_accionado_vinculado.idcorrespondencia_tutelas as idcorres, accionante_accionado_vinculado.accionante_accionado_vinculado as nombre,accionante_accionado_vinculado.esaccionante_accionado_vinculado as tipoacc  from accionante_accionado_vinculado
  where idcorrespondencia_tutelas= '$id' order by ");

  $listar->execute();

  return $listar;

  

  }  
  /*******************************  Listar Tutela ***************************************************/

  public function listarCorrespondenciaTutela()

  {

  
  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select correspondencia_tutelas.radicado, pa_juzgado.nombre as juzgado,correspondencia_tutelas.fecha, correspondencia_tutelas.Tutela_Incidente
from correspondencia_tutelas 
inner join pa_juzgado on (correspondencia_tutelas.idjuzgado=pa_juzgado.id) where correspondencia_tutelas.id='$id'
");

  $listar->execute();

  return $listar;

  

  } 

/*******************************  Listar Partes Tutela ***************************************************/

  public function listarPartesTutela()

  {

  
  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select * from accionante_accionado_vinculado where accionante_accionado_vinculado.idcorrespondencia_tutelas='$id' order by id
");

  $listar->execute();

  return $listar;

  

  }
  
 
/*******************************  Listar Actuaciones Tutela ***************************************************/

  public function listarActuacionesTutela()

  {

  
   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select actuacion_tutela.idaccionado_vinculado_accionante_tut as idparte,actuacion_tutela.esoficio_telegrama, actuacion_tutela.oficio_telegrama,
actuacion_tutela.direccion,pa_municipio.nombre as municipio,pa_municipio.id as idmunicipio, pa_medionotificacion.nombre as medio, actuacion_tutela.notificado,
actuacion_tutela.fecha_envio, pa_actuacion.nombre as actuacion,pa_departamento.id as iddepartamento,pa_departamento.nombre as departamento,actuacion_tutela.tipo_actuacion  
from actuacion_tutela 
inner join pa_municipio on (actuacion_tutela.idmunicipio=pa_municipio.id)
inner join pa_departamento on (pa_departamento.id = pa_municipio.iddepartamento)
inner join pa_medionotificacion on (actuacion_tutela.idmedionotificacion=pa_medionotificacion.id)
inner join pa_actuacion on (actuacion_tutela.idactuacion=pa_actuacion.id)
where actuacion_tutela.idaccionado_vinculado_accionante_tut in
(select id from accionante_accionado_vinculado where accionante_accionado_vinculado.idcorrespondencia_tutelas='$id')
order by actuacion_tutela.idaccionado_vinculado_accionante_tut,actuacion_tutela.id
");

  $listar->execute();

  return $listar;

  

  }  

/*******************************  Listar Actuaciones Tutela ***************************************************/

  public function consultarOtros()

  {

  $id = $_GET['nombre'];
  
  $listar = $this->db->prepare("SELECT corres.radicado,pa_juzgado.nombre as juzgado, corres.esOficio_Telegrama,corres.oficio_telegrama as numero,
corres.destinatario,corres.direccion,pa_departamento.nombre as departamento,pa_municipio.nombre as municipio,
corres.notificado,pa_medionotificacion.nombre as medio, corres.fecha,corres.idmedionotificacion as idmedio,corres.nunguia
FROM correspondencia_otros as corres
INNER JOIN pa_municipio ON (pa_municipio.id=corres.idmunicipio)
INNER JOIN pa_departamento ON (pa_departamento.id=pa_municipio.iddepartamento)
INNER JOIN pa_medionotificacion ON (pa_medionotificacion.id=corres.idmedionotificacion)
INNER JOIN pa_juzgado ON (pa_juzgado.id=corres.idjuzgado)
where corres.id='$id'
");

  $listar->execute();

  return $listar;

  

  } 
/*******************************  Listar Todos los empleados ***************************************************/

  public function listarEmpleadosTodos()

  {


  
  $listar = $this->db->prepare("Select pa_usuario.id as idusuario,pa_usuario.empleado,pa_areaempleado.nombre as area from pa_usuario 
inner join pa_areaempleado on (pa_usuario.idareaempleado=pa_areaempleado.id)
where pa_usuario.id!=8
order by empleado");

  $listar->execute();

  return $listar;

  

  } 
 /**************************  Listar Todos los procesos personal*************************************************/ 
  public function listarProcesosPersonal()

  {


$procesos = $this->db->prepare("select otros.id as idotros, concat(otros.esOficio_Telegrama,' - ',otros.oficio_telegrama) as proceso, 
otros.fecha as fecha, j.nombre as juzgado, otros.direccion, otros.radicado
from correspondencia_otros as otros 
inner join pa_juzgado j on (j.id=otros.idjuzgado)
where otros.idmedionotificacion=6 and otros.id not in (select turno.idproceso from turno where turno.tipo_proceso='Otro' ) order by otros.fecha desc");		
$procesos->execute();
		
		$i=0;

		while($idE = $procesos->fetch())
		{
		
			$vector[$i][id]=$idE[idotros];
			$vector[$i][proceso]=$idE[proceso];
			$vector[$i][tipo]= "Otro";
			$vector[$i][fecha]=$idE[fecha];
			$vector[$i][juzgado]= $idE[juzgado];
			$vector[$i][direccion]= $idE[direccion];
			if($idE[radicado]=='')
			{
			$vector[$i][radicado]= "SIN";
			}
			else{			
			$vector[$i][radicado]= $idE[radicado];
			}
			$i= $i+1;
		}
$procesos1 = $this->db->prepare("select act.id as idtutinc, concat(act.esOficio_Telegrama,' - ',act.oficio_telegrama) as proceso,
act.tipo_actuacion as tipo, act.fecha_envio as fecha, j.nombre as juzgado,act.direccion,ct.radicado
from actuacion_tutela as act 
inner join accionante_accionado_vinculado acc on (acc.id=act.idaccionado_vinculado_accionante_tut)
inner join correspondencia_tutelas ct on (ct.id=acc.idcorrespondencia_tutelas)
inner join pa_juzgado j on (j.id=ct.idjuzgado)
where act.idmedionotificacion=6  and act.id not in (select turno.idproceso from turno where turno.tipo_proceso='Tutela' or turno.tipo_proceso='Incidente' ) order by act.fecha_envio desc");		
$procesos1->execute();

while($idE2 = $procesos1->fetch())
		{
			
			$vector[$i][id]=$idE2[idtutinc];
			$vector[$i][proceso]=$idE2[proceso];
			$vector[$i][tipo]= $idE2[tipo];
			$vector[$i][fecha]= $idE2[fecha];
			$vector[$i][juzgado]= $idE2[juzgado];
			$vector[$i][direccion]= $idE2[direccion];
			$vector[$i][radicado]= $idE2[radicado];
			$i= $i+1;
		}	

 
  return $vector;
  }
  
  
 /*******************************  Listar Tutela ***************************************************/

  public function registrarTurno()

  {

  
  $responsable_completo = $_POST['responsable'];
  $responsable_vector = explode("-",$responsable_completo);
  $responsable = $responsable_vector[0];
  $proceso_vector = explode(";",$_POST['proceso']); 
  print_r($proceso_vector);
  $contador = count($proceso_vector)-1;
  $idproceso = $proceso_vector[0];
  $tipo = $proceso_vector[$contador];
  $hora = $_POST["hora"].":".$_POST["hora2"]." ".$_POST["hora3"];
  
  $registrar3 = $this->db->prepare("INSERT INTO turno  (idusuario,idproceso,hora,tipo_proceso) values ('$responsable','$idproceso','$hora','$tipo')");
  $registrar3->execute();
  
date_default_timezone_set('America/Bogota'); 
$fechaa=date('Y-m-d g:ia');

$horaa=explode(' ',$fechaa);

$fechal=$horaa[0];

$hora=$horaa[1]; 

$accion='Resgistr&oacute; Turno';
$idres = $_SESSION['idUsuario'];

$detalle=$_SESSION['nombre']." "."Registro un nuevo Turno ".$fechal." "."a las: ".$hora;

 //es de tipo 1 porque va asociado al módulo de archivo 
$tipolog=2;

$insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');");

$insertarlog->execute();
  
  
  
  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>'; 




  

  } 
  
  /**************************  Listar Todos los turnos *************************************************/ 
  public function listarTurnos()

  {



	$procesos = $this->db->prepare("(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,correspondencia_otros.direccion,correspondencia_otros.radicado,
correspondencia_otros.esOficio_Telegrama,correspondencia_otros.oficio_telegrama,correspondencia_otros.fecha,turno.hora 
from turno 
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join correspondencia_otros on (correspondencia_otros.id=turno.idproceso)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_otros.idjuzgado)
where turno.idproceso =correspondencia_otros.id and turno.tipo_proceso='Otro')
union 
(select pa_usuario.empleado, pa_areaempleado.nombre as areaempleado,pa_juzgado.nombre as juzgado,turno.tipo_proceso,actuacion_tutela.direccion,correspondencia_tutelas.radicado,
actuacion_tutela.esOficio_Telegrama,actuacion_tutela.oficio_telegrama,actuacion_tutela.fecha_envio as fecha,turno.hora 
from turno 
inner join pa_usuario on (turno.idusuario=pa_usuario.id)
inner join pa_areaempleado on (pa_areaempleado.id=pa_usuario.idareaempleado)
inner join actuacion_tutela on (actuacion_tutela.id=turno.idproceso)
inner join accionante_accionado_vinculado on (accionante_accionado_vinculado.id=actuacion_tutela.idaccionado_vinculado_accionante_tut)
inner join correspondencia_tutelas on (correspondencia_tutelas.id=accionante_accionado_vinculado.idcorrespondencia_tutelas)
inner join pa_juzgado on (pa_juzgado.id=correspondencia_tutelas.idjuzgado)
where actuacion_tutela.id= turno.idproceso and (turno.tipo_proceso='Tutela' or turno.tipo_proceso='Incidente'))
order by empleado ");		
	$procesos->execute();
	
	return $procesos;
	
	
 }
 
/*******************************  Listar Accionados ***************************************************/

  public function listar_accionados()

  {

  
   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre,av.id  from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Accionado' and av.idcorrespondencia_tutelas = $id order by nombre");
  $listar->execute();
  
   $i = 0; 
   while($idE = $listar->fetch())
		{
		 
		$vector_accionados[$i][nombre_accionado] = $idE[nombre];
		$vector_accionados[$i][id] = $idE[id];
		$i++;
		
		}

  return $vector_accionados;

  

  }  

/*******************************  Listar Vinculados ***************************************************/

  public function listar_vinculados()

  {

  
   $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre, av.id   from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Vinculado' and av.idcorrespondencia_tutelas = $id order by nombre");
  $listar->execute();
  
   $i = 0; 
   while($idE = $listar->fetch())
		{
		 
		$vector_vinculados[$i][nombre_vinculado] = $idE[nombre];
		$vector_vinculados[$i][id] = $idE[id];
		$i++;
		
		}

  return $vector_vinculados;

  

  }

/*******************************  Listar Accionante ***************************************************/

  public function listar_accionante()

  {

  
  $id = $_GET['nombre'];

  $listar = $this->db->prepare("select av.accionante_accionado_vinculado as nombre, av.id from accionante_accionado_vinculado av
  where av.esaccionante_accionado_vinculado='Accionante' and av.idcorrespondencia_tutelas = $id");

  $listar->execute();


  return $listar;


  }   
   
 /*******************************  Listar detalles de actuaciones ***************************************************/

  public function listarPartesTutela_nv()

  {

  
  $id = $_GET['nombre'];

  $listar = $this->db->prepare("SELECT acc.accionante_accionado_vinculado, acc.esaccionante_accionado_vinculado,a.nombre as actuacion,
                                m.nombre as medio,act.esoficio_telegrama,act.oficio_telegrama,
								act.id as idactuacion,act.direccion,mu.nombre as municipio,act.notificado,act.fecha_envio,act.tipo_actuacion,
								act.nunguia,a.id AS idactuacionT
								FROM correspondencia_tutelas ct
								INNER JOIN accionante_accionado_vinculado acc ON (ct.id=acc.idcorrespondencia_tutelas)
								INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=acc.id)
								INNER JOIN  pa_actuacion a ON (a.id=act.idactuacion)
								INNER JOIN pa_medionotificacion m ON (m.id=act.idmedionotificacion)
								INNER JOIN pa_municipio mu ON (mu.id=act.idmunicipio)
								WHERE ct.id=$id order by act.fecha_envio,acc.accionante_accionado_vinculado");

  $listar->execute();


  return $listar;


  } 
  
/**********************************************************************************************************/
  /*----------------------- Modificar Correspondencia Tutela Nueva Versión -------------------------------*/
  /*******************************************************************************************************/
  
  public function get_id_radicado_detalle($radicadojxxi){
  
  	$listar = $this->db->prepare("SELECT id  FROM ubicacion_expediente WHERE radicado = '$radicadojxxi'");

  	$listar->execute();

  	return $listar;
  
  }
  
  public function modificarCorrespondenciaTutela_nv()
  {
  
  	$modelo     = new correspondenciaModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
  	
	$idusuario                      = $_SESSION['idUsuario'];

	$cantidad_accionado_vinculado   = $_POST['cantidad_detalles'];
	$cantidad_accionados			= $_POST['cantidad_accionados'];
	$cantidad_vinculados			= $_POST['cantidad_vinculados'];
	$tiene_accionado				= $_POST['tiene_accionado'];
	$tiene_vinculado				= $_POST['tiene_vinculado'];
	$id                             = $_GET['nombre'];


	
	try {  
			
			//EMPIEZA LA TRANSACCION
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->beginTransaction();

 
 	 
		  date_default_timezone_set('America/Bogota'); 
		  $fechaa=date('Y-m-d g:ia');
	
		  $horaa=explode(' ',$fechaa);
	
		  $fechal=$horaa[0];
		  
		  $hora=$horaa[1]; 
		  
		  $accion='Modific&oacute; Tutela';
		  $idres = $_SESSION['idUsuario'];
	
		  $detalle=$_SESSION['nombre']." "."Modifico una Tutela ".$fechal." "."a las: ".$hora;
		  
		   //es de tipo 2 porque va asociado al módulo de correspondencia 
		  $tipolog=2;
	
		  $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechal', '$accion','$detalle','$idres','$tipolog');");
	
		  $insertarlog->execute();
		  
	
	
	
	
		$i_accionados = 0;
		$i_accionados1 = 1; 
	 
		if ($tiene_accionado=='on')
		{
		 $vector_accionados[$i_accionados][nombre] = $_POST['accionado'];
		 $i_accionados = $i_accionados+1;
		 
		  if ($cantidad_accionados>0)
		 {
		  while($i_accionados<=$cantidad_accionados)
		  {  
			if($_POST['accionado'.$i_accionados])
			{
			 $vector_accionados[$i_accionados1][nombre] = $_POST['accionado'.$i_accionados];   
			 $i_accionados1 = $i_accionados1+1;
	   
			}
			$i_accionados = $i_accionados+1;
		  } 
		}
		$ins = 0;  
		//print_r($vector_accionados);
		$cant_insert_accionados = count($vector_accionados);
		while($ins < $cant_insert_accionados)
		{
		
			$accionado_temp = $vector_accionados[$ins][nombre];
			$registrar_accionados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$accionado_temp','Accionado')");
			 $registrar_accionados->execute();
			 
			 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT 
			  $id_accionado     = $this->db->lastInsertId();
			 
			 /*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
	$consultar->execute();
	
		while($field = $consultar->fetch())
			{
			 
			
			  $id_accionado=$field['id'];
	
			 }*/
			 
			 $vector_accionados[$ins][idbd]=$id_accionado;
			 
			 
			 $ins = $ins+1;	  	
		
		}
	//print_r($vector_accionados);
	
	 }
	 else
	 {
	 //echo "no tiene accionado";
	 }
	
	
	$i_vinculados = 0;
	$i_vinculados1 = 1; 
	 
	 if ($tiene_vinculado=='on')
	 {
	 
	 $vector_vinculados[$i_vinculados][nombre] = $_POST['vinculado'];
	 $i_vinculados = $i_vinculados+1;
	 if ($cantidad_vinculados>0)
	 {
	  while($i_vinculados<=$cantidad_vinculados){  
	  if($_POST['vinculado'.$i_vinculados])
	   {
		$vector_vinculados[$i_vinculados1][nombre] = $_POST['vinculado'.$i_vinculados];   
		$i_vinculados1 = $i_vinculados1+1;
	   
	   }
	   $i_vinculados = $i_vinculados+1;
	  
	  } 
	  
	 }
	$insv = 0;    
	//print_r($vector_vinculados);
	$cant_insert_vinculados = count($vector_vinculados);
		while($insv < $cant_insert_vinculados)
		{
		
			$vinculado_temp = $vector_vinculados[$insv][nombre];
			$registrar_vinculados = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$vinculado_temp','Vinculado')");
			 $registrar_vinculados->execute();
			 
			 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT 
			  $id_vinculado     = $this->db->lastInsertId();
			
			 /*$consultar = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
			 $consultar->execute();
	
		while($field = $consultar->fetch())
			{
			 
			
			  $id_vinculado=$field['id'];
	
			 }*/
			 
			 $vector_vinculados[$insv][idbd]=$id_vinculado;
			 $insv = $insv+1;
			 
			 
	   }		 	  	
	
	//print_r($vector_vinculados);
	
	 }
	 else
	 {
	// echo "no tiene vinculados";
	 } 
	 
	$i=$j=1;
	 
	
	
	 while ($j<=$cantidad_accionado_vinculado)
	
		{
		  if($_POST['oficio_telegrama_numero'.$j]!="")
		  {
			
			 $tipo_actuacion					  = $_POST['tipo_actuacion'.$j];
			 $idactuacion						  = $_POST['idactuacion'.$j];
			 $esoficio_telegrama                  = $_POST['esOficio_Telegrama'.$j];
			 $oficio_telegrama			          = $_POST['oficio_telegrama_numero'.$j];
			 $direccion							  = $_POST['direccion'.$j];
			 $idmunicipio						  = $_POST['ciudad'.$j];
			 $idmedionotificacion				  = $_POST['medio'.$j];
			 $fecha_envio						  = $_POST['fecha_envio'.$j];
			 $esaccionante_accionado_vinculado    = $_POST['accionante_accionado_vinculado'.$j];
			 $notificado						  = "Si";
			 
			  //---------------PROYECTO OFICIOS TUTELAS, ADICIONADO POR JORGE ANDRES VALENCIA, 8 DE FEBRERO 2018------------------
			 
			 $descripA						      = $_POST['descripA'.$j];
			 
			 //------------------------------------------------------------------------------------------------------------------
			 
			 
			 if($esaccionante_accionado_vinculado=='Accionante')
			 {
			   $idaccionado_vinculado_accionante_tut = $_POST['idaccionante_bd'];
			 }
			 
			 if($esaccionante_accionado_vinculado=='Accionado')
			 {
			   
			   $accionado_nombre = $_POST['accionados_sl'.$j];
			   $cont_vect = count($vector_accionados);
			   $jj= 0;
			   //echo $m = $accionado_nombre*2;
	
			   if(ctype_digit($accionado_nombre))
			   {
			   
				$idaccionado_vinculado_accionante_tut =   $accionado_nombre;
			   
			   }
			   else {
				
				while($jj<$cont_vect)
				{
				 if($vector_accionados[$jj][nombre]==$accionado_nombre)
				 {
				  $index = $jj;
				  $jj= $cont_vect;
				 }
				 $jj++;
				}
				$idaccionado_vinculado_accionante_tut =   $vector_accionados[$index][idbd];
			 }
			} 
			 
			 
			 if($esaccionante_accionado_vinculado=='Vinculado')
			 {
			   
			   $vinculado_nombre = $_POST['vinculados_sl'.$j];
			   $cont_vect_v = count($vector_vinculados);
			   $v= 0;
			   
			   if(ctype_digit($vinculado_nombre))
			   {
				$idaccionado_vinculado_accionante_tut =   $vinculado_nombre;
			   
			   }
			   else {
				
				while($v<$cont_vect_v)
				{
				 if($vector_vinculados[$v][nombre]== $vinculado_nombre)
				 {
				  $index_v = $v;
				  $v= $cont_vect_v;
				 }
				 $v++;
				}
				$idaccionado_vinculado_accionante_tut =   $vector_vinculados[$index_v][idbd];
			 }
			}
			 
			  if($esaccionante_accionado_vinculado=='Otro')
			 {
			 
			  
			  $otro_texto = $_POST['texto_otro'.$j];
			  $registrar_otro = $this->db->prepare("INSERT INTO accionante_accionado_vinculado (idcorrespondencia_tutelas,accionante_accionado_vinculado,esaccionante_accionado_vinculado) values ('$id','$otro_texto','Otro')");
			 $registrar_otro->execute();
			 
			 //OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT 
			  $id_otro     = $this->db->lastInsertId();
			 
			 /*$consultar_otro = $this->db->prepare("SELECT MAX(id) as id FROM accionante_accionado_vinculado");
			 $consultar_otro->execute();
	
			while($field = $consultar_otro->fetch())
			 {
			  $id_otro=$field['id'];
			 }*/
			
			  
			   $idaccionado_vinculado_accionante_tut = $id_otro;
			 }
			 
			 
			 
			$registrar4 = $this->db->prepare("INSERT INTO actuacion_tutela (idaccionado_vinculado_accionante_tut,esoficio_telegrama,
			                                                                oficio_telegrama,direccion,idmunicipio,idmedionotificacion,notificado,fecha_envio,
																			idactuacion,tipo_actuacion,descripcion) 
																			VALUES ('$idaccionado_vinculado_accionante_tut','$esoficio_telegrama',
																			'$oficio_telegrama','$direccion','$idmunicipio','$idmedionotificacion',
																			'$notificado','$fecha_envio','$idactuacion','$tipo_actuacion','$descripA')");
			$registrar4->execute();	
			
		
			
			//ESTO SE REALIZA CUANDO SE PREGUNTA SI LA ACTUACION ES Envio a la Corte Costitucional
			if($idactuacion == 9){
		
			
				$radicadojxxi = $_POST['radicadojxxi'];
				
				$id_radicado_detalle   = $modelo->get_id_radicado_detalle($radicadojxxi);
				$filaD = $id_radicado_detalle->fetch();
				$id_radicado_detalle_2 = $filaD[id];
				
				
				$fechadetalle = date('Y-m-d g:i');
				
				$registrar5 =  $this->db->prepare("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,idusuario) 
												   VALUES('$id_radicado_detalle_2','$fechadetalle','SE REMITE A LA CORTE PARA SU EVENTUAL REVISION','$idusuario')");
																 
				$registrar5->execute();	
				
				
					
				
				 
				 $sininstancia = $radicadojxxi;
				 $sin          = substr($sininstancia, 0, 21);
				 
				//***************PARA CREAR LA ACTUACION  Auto envía tutela a la corte EN JUSTICIA XXI***************
				//CUANDO SE SELECCIONA AL ADICIONAR UNA ACTUACION Envio a la Corte Costitucional 
				
				
				$error_transaccion = 0;
				
				
				//CONEXION A JUSTICIA XXI
				$serverName     = "192.168.89.20"; 
				$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
				$conn           = sqlsrv_connect( $serverName, $connectionInfo);
				
				
				if( $conn === false ) {
					
					$error_transaccion = 1;
				
					if( ($errors = sqlsrv_errors() ) != null) {
					
						foreach( $errors as $error ) {
						
							echo "ERROR EN REGISTRO "."<br />";	
							echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
							echo "code: ".$error[ 'code']."<br />";
							echo "message: ".$error[ 'message']."<br />";
						}
					}
					
					echo "ENTRE 1";
					
				}
				
				//Iniciar la transacción.
				if ( sqlsrv_begin_transaction( $conn ) === false ) {
					 
					$error_transaccion = 1;
				
					if( ($errors = sqlsrv_errors() ) != null) {
					
						foreach( $errors as $error ) {
						
							echo "ERROR EN REGISTRO "."<br />";	
							echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
							echo "code: ".$error[ 'code']."<br />";
							echo "message: ".$error[ 'message']."<br />";
						}
					}
					 
					echo "ENTRE 2";
					 
				}
				
		
			
				$sql = ("   DECLARE @cad integer
							 
		
							SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE A110LLAVPROC = '$radicadojxxi' 
							
							
							UPDATE T103DAINFOPROC SET A103DESCACTD = 'Envío expediente a la Corte', A103CODIACTD = '30023461', A103CODIPADD ='00000000', 
							A103FECHDESD = convert(datetime, '$fechal', 121)
							WHERE A103LLAVPROC = '$radicadojxxi';
							
							INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,
							A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
							A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,
							A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
							A110RENUTERM) 
							values('$radicadojxxi',@cad,'$sin','00','30023461','30023197','Envío expediente a la Corte','N','NO','N',NULL,
							NULL,
							NULL,
							convert(datetime, '$fechal', 121),
							NULL,1,'0000',NULL,
							convert(datetime, '$fechal', 121),
							NULL,NULL,NULL,'D','P',
							convert(datetime, '$fechal', 121),
							NULL,NULL)");
				
					
				$params  = array();
				$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				$stmt = sqlsrv_query( $conn, $sql , $params, $options );
					
					
				if( $stmt === false ) {
					
					$error_transaccion = 1;
					
					if( ($errors = sqlsrv_errors() ) != null) {
						
						foreach( $errors as $error ) {
							
							echo "ERROR EN REGISTRO "."<br />";	
							echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
							echo "code: ".$error[ 'code']."<br />";
							echo "message: ".$error[ 'message']."<br />";
						}
					}
						
					echo "ENTRE 3";
						
				}
			
			
				if($error_transaccion) {
		
					//ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
					sqlsrv_rollback( $conn );
					// Cerrar la conexión.
					sqlsrv_close( $conn );
					
				}
				else{
					
					//SE TERMINA LA TRANSACCION EN SIGLO XXI  
				   sqlsrv_commit( $conn );
				}
			  //****************************************************************************************************************************
		  
		
			}
			
			
			
			
			
			//ESTO SE REALIZA CUANDO SE PREGUNTA SI LA ACTUACION ES Impugnación
		    if($idactuacion == 15){
		
				$radicadojxxi  = $_POST['radicadojxxi'];
				
				$msgactu       = trim('Envío de Tutela por impugnación');
				
				$datos_ACTU110 = $modelo->get_datos_ACTUACION($radicadojxxi,$fechaactual,$msgactu);
									
									
				//NO EXISTE ACTUACION EN JUSTICIA XXI Y EN LA BASE DE DATOS LOCAL EJECUCION
				//ESTO PERMITE NO REPETIR EL PROCESO A DESPACHO DE UN RADICADO
				if ($datos_ACTU110 == 0){
			
					//$radicadojxxi = $_POST['radicadojxxi'];
					
					$id_radicado_detalle   = $modelo->get_id_radicado_detalle($radicadojxxi);
					$filaD = $id_radicado_detalle->fetch();
					$id_radicado_detalle_2 = $filaD[id];
					
					
					$fechadetalle = date('Y-m-d g:i');
					
					$registrar5 =  $this->db->prepare("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,idusuario) 
													   VALUES('$id_radicado_detalle_2','$fechadetalle','ENVIO DE TUTELA POR IMPUGNACION','$idusuario')");
																	 
					$registrar5->execute();	
					
					
						
					
					 
					 $sininstancia = $radicadojxxi;
					 $sin          = substr($sininstancia, 0, 21);
					 
					//***************PARA CREAR LA ACTUACION  Envío de Tutela por impugnación EN JUSTICIA XXI***************
					//CUANDO SE SELECCIONA AL ADICIONAR UNA ACTUACION Tutela - Impugnacion 
					
					
					$error_transaccion = 0;
					
					
					//CONEXION A JUSTICIA XXI
					$serverName     = "192.168.89.20"; 
					$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
					$conn           = sqlsrv_connect( $serverName, $connectionInfo);
					
					
					if( $conn === false ) {
						
						$error_transaccion = 1;
					
						if( ($errors = sqlsrv_errors() ) != null) {
						
							foreach( $errors as $error ) {
							
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
						
						echo "ENTRE 1B";
						
					}
					
					//Iniciar la transacción.
					if ( sqlsrv_begin_transaction( $conn ) === false ) {
						 
						$error_transaccion = 1;
					
						if( ($errors = sqlsrv_errors() ) != null) {
						
							foreach( $errors as $error ) {
							
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
						 
						echo "ENTRE 2B";
						 
					}
					
			
				
					$sql = ("   DECLARE @cad integer
								 
			
								SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE A110LLAVPROC = '$radicadojxxi' 
								
								
								UPDATE T103DAINFOPROC SET A103DESCACTD = 'Envío de Tutela por impugnación', A103CODIACTD = '30023588', A103CODIPADD ='00000000', 
								A103FECHDESD = convert(datetime, '$fechal', 121)
								WHERE A103LLAVPROC = '$radicadojxxi';
								
								INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,
								A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
								A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,
								A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
								A110RENUTERM) 
								values('$radicadojxxi',@cad,'$sin','00','30023588','30010162','Envío de Tutela por impugnación','N','NO','N',0,
								NULL,
								NULL,
								convert(datetime, '$fechal', 121),
								NULL,1,'0000',NULL,
								NULL,
								NULL,NULL,NULL,'S','D',
								convert(datetime, '$fechal', 121),
								'NO','NO')");
					
						
					$params  = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sql , $params, $options );
						
						
					if( $stmt === false ) {
						
						$error_transaccion = 1;
						
						if( ($errors = sqlsrv_errors() ) != null) {
							
							foreach( $errors as $error ) {
								
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
							
						echo "ENTRE 3B";
							
					}
				
				
					if($error_transaccion) {
			
						//ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
						sqlsrv_rollback( $conn );
						// Cerrar la conexión.
						sqlsrv_close( $conn );
						
					}
					else{
						
						//SE TERMINA LA TRANSACCION EN SIGLO XXI  
					   sqlsrv_commit( $conn );
					}
					
				}
		 	   //****************************************************************************************************************************
			   
			   
			
			 }
			
			
			//ESTO SE REALIZA CUANDO SE PREGUNTA SI LA ACTUACION ES Envio en consulta circuito
		    if($idactuacion == 30){
		
				$radicadojxxi  = $_POST['radicadojxxi'];
				
				$msgactu       = trim('Envío de Incidente de desacato a Consulta');
				
				$datos_ACTU110 = $modelo->get_datos_ACTUACION($radicadojxxi,$fechaactual,$msgactu);
				
				
				//NO EXISTE ACTUACION EN JUSTICIA XXI Y EN LA BASE DE DATOS LOCAL EJECUCION
				//ESTO PERMITE NO REPETIR EL PROCESO A DESPACHO DE UN RADICADO
				if ($datos_ACTU110 == 0){
				
				
					//$radicadojxxi = $_POST['radicadojxxi'];
					
					$id_radicado_detalle   = $modelo->get_id_radicado_detalle($radicadojxxi);
					$filaD = $id_radicado_detalle->fetch();
					$id_radicado_detalle_2 = $filaD[id];
					
					
					$fechadetalle = date('Y-m-d g:i');
					
					$registrar5 =  $this->db->prepare("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,idusuario) 
													   VALUES('$id_radicado_detalle_2','$fechadetalle','ENVIO DE INCIDENTE DE DESACATO A CONSULTA','$idusuario')");
																	 
					$registrar5->execute();	
					
					
						
					
					 
					 $sininstancia = $radicadojxxi;
					 $sin          = substr($sininstancia, 0, 21);
					 
					//***************PARA CREAR LA ACTUACION  Envío de Incidente de desacato a Consulta EN JUSTICIA XXI***************
					//CUANDO SE SELECCIONA AL ADICIONAR UNA ACTUACION Invidente - Envio en consulta circuito 
					
					
					$error_transaccion = 0;
					
					
					//CONEXION A JUSTICIA XXI
					$serverName     = "192.168.89.20"; 
					$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
					$conn           = sqlsrv_connect( $serverName, $connectionInfo);
					
					
					if( $conn === false ) {
						
						$error_transaccion = 1;
					
						if( ($errors = sqlsrv_errors() ) != null) {
						
							foreach( $errors as $error ) {
							
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
						
						echo "ENTRE 1C";
						
					}
					
					//Iniciar la transacción.
					if ( sqlsrv_begin_transaction( $conn ) === false ) {
						 
						$error_transaccion = 1;
					
						if( ($errors = sqlsrv_errors() ) != null) {
						
							foreach( $errors as $error ) {
							
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
						 
						echo "ENTRE 2C";
						 
					}
					
			
				
					$sql = ("   DECLARE @cad integer
								 
			
								SELECT @cad = MAX(A110CONSACTU)+1 FROM T110DRACTUPROC WHERE A110LLAVPROC = '$radicadojxxi' 
								
								
								UPDATE T103DAINFOPROC SET A103DESCACTD = 'Envío de Incidente de desacato a Consulta', A103CODIACTD = '30023587', A103CODIPADD ='30023588', 
								A103FECHDESD = convert(datetime, '$fechal', 121)
								WHERE A103LLAVPROC = '$radicadojxxi';
								
								INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,
								A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
								A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,
								A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
								A110RENUTERM) 
								values('$radicadojxxi',@cad,'$sin','00','30023587','30023588','Envío de Incidente de desacato a Consulta','N','NO','N',0,
								NULL,
								NULL,
								convert(datetime, '$fechal', 121),
								NULL,1,'0000',NULL,
								NULL,
								NULL,NULL,NULL,'S','D',
								convert(datetime, '$fechal', 121),
								'NO','NO')");
					
						
					$params  = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sql , $params, $options );
						
						
					if( $stmt === false ) {
						
						$error_transaccion = 1;
						
						if( ($errors = sqlsrv_errors() ) != null) {
							
							foreach( $errors as $error ) {
								
								echo "ERROR EN REGISTRO "."<br />";	
								echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
								echo "code: ".$error[ 'code']."<br />";
								echo "message: ".$error[ 'message']."<br />";
							}
						}
							
						echo "ENTRE 3C";
							
					}
				
				
					if($error_transaccion) {
			
						//ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
						sqlsrv_rollback( $conn );
						// Cerrar la conexión.
						sqlsrv_close( $conn );
						
					}
					else{
						
						//SE TERMINA LA TRANSACCION EN SIGLO XXI  
					   sqlsrv_commit( $conn );
					}
					
				}
		 	   //****************************************************************************************************************************
			   
			   
			   
			
			 }
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			

		  }
		  $j = $j+1;  
		}
		
		
		
	  if($error_transaccion) {
	  
	  	//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
		$this->db->rollBack();
		
		//ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
		sqlsrv_rollback( $conn );
		// Cerrar la conexión.
		sqlsrv_close( $conn );
		
		echo "Fallo: " . $e->getMessage();
		
	  
	  }	
	  else{
	  	
		//SE TERMINA LA TRANSACCION  
	 	$this->db->commit();	
		
		//SE TERMINA LA TRANSACCION EN SIGLO XXI  
	    sqlsrv_commit( $conn );
		
	  	//echo "OK";
	  	/*print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';*/
		
		
	}
  
  }
   
  catch (Exception $e) {
			
	//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
	$this->db->rollBack();
	
	//ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
	sqlsrv_rollback( $conn );
	// Cerrar la conexión.
	sqlsrv_close( $conn );
	
	echo "Fallo: " . $e->getMessage();
	
 }
 
 

}



//INFORMACION DE LA PARTE EN JUSTICIA XXI, PARA NO VOLVER A REGISTRARLA TABLA T110DRACTUPROC
public function get_datos_ACTUACION($radicado,$fechaactu,$msgactu){
	
		$modelo    = new correspondenciaModel();
		
		$msgError  = "";
  
  		$error_transaccionX = 0;
		
  		$datosbd   = $modelo->get_datos_basededatos(1);
		$datosbd_b = $datosbd->fetch();
		$datosbd_1 = $datosbd_b[ip];
		$datosbd_2 = $datosbd_b[bd];
		$datosbd_3 = $datosbd_b[usuario];
		$datosbd_4 = $datosbd_b[clave];
			
		$serverNameX = $datosbd_1; //serverName\instanceName
		$connectionInfoX = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
		$connX = sqlsrv_connect( $serverNameX, $connectionInfoX);
		
		
		if( $connX === false ) {
			
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					
					$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
				}
			}
			
			echo "ENTRE 1 (110): ".$msgError;
			
		}
		
		//Iniciar la transacción.
		if ( sqlsrv_begin_transaction( $connX ) === false ) {
			 
			$error_transaccionX = 1;
		
			if( ($errors = sqlsrv_errors() ) != null) {
			
				foreach( $errors as $error ) {
				
					$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
				}
			}
			 
			echo "ENTRE 2 (110): ".$msgError;
			 
		}
		
		
		$fechaactu = $fechaactu." "."00:00:00.000";
		
		$sqlX = ("	
			
			
					SELECT * FROM [$datosbd_2].[dbo].[T110DRACTUPROC] 
 					WHERE [A110LLAVPROC] = '$radicado'
					AND   [A110DESCACTU] = '$msgactu' 
  				    AND   [A110FECHREGI] = '$fechaactu'
                    AND   [A110FECHDESA] = '$fechaactu'; 
							
		");
			
		$paramsX  = array();
		$optionsX =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		$stmtX    = sqlsrv_query( $connX, $sqlX , $paramsX, $optionsX );
			
			
		if( $stmtX === false ) {
			
			$error_transaccionX = 1;
			
			if( ($errors = sqlsrv_errors() ) != null) {
				
				foreach( $errors as $error ) {
					
					$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];				}
			}
				
			echo "ENTRE 3 (110): ".$msgError;
				
		}
		else{
		
			$row_count = sqlsrv_num_rows( $stmtX );
			
			//NO EXISTE
			//if ($row_count === false){
			if ($row_count == 0){
   		
				sqlsrv_free_stmt( $stmtX);
				sqlsrv_close( $connX );
				
				return 0;
				
				
			}
			//EXISTE
 			else{
			
				sqlsrv_free_stmt( $stmtX);
				sqlsrv_close( $connX );
				
				return 1;
				
				
			}		
			
		}
		
		
}



//INFORMACION DE LA BASE DE DATOS, PARA SU CONEXION
public function get_datos_basededatos($idbd){
  
  		$listar     = $this->db->prepare("SELECT * FROM pa_base_datos WHERE id = ".$idbd);
	
  		$listar->execute();

  		return $listar;
		
} 




/*******************************  Listar Todos las actuaciones ***************************************************/

  public function listarActuaciones()

  {


  
  $listar = $this->db->prepare("SELECT ct.radicado, act.esoficio_telegrama,act.oficio_telegrama,act.direccion,av.accionante_accionado_vinculado as nombre, act.id
FROM correspondencia_tutelas ct
INNER JOIN accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=av.id)
order by ct.radicado,av.accionante_accionado_vinculado
");

  $listar->execute();
  $i=0;
  
 while($field = $listar->fetch())
  {
   $vector[id][$i] = $field['radicado'];
   $i++;
  }
  

  return $vector;

  

  }

/*******************************  Listar actuación especifica ***************************************************/

  public function listarActuacion_Especifica()

  {

  $id = $_GET['nombre'];
  
  $listar = $this->db->prepare("SELECT ct.radicado,act.esoficio_telegrama,act.oficio_telegrama,act.direccion,act.idmunicipio,act.idmedionotificacion,
                                act.idactuacion,act.tipo_actuacion,mu.nombre as municipio,act.descripcion,
								me.nombre as medio, actu.nombre as actuacion, de.id as iddepa, de.nombre as nombredepa,act.fecha_envio
								FROM correspondencia_tutelas ct
								INNER JOIN accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
								INNER JOIN actuacion_tutela act ON (act.idaccionado_vinculado_accionante_tut=av.id)
								INNER JOIN pa_municipio mu ON (mu.id=act.idmunicipio)
								INNER JOIN pa_medionotificacion me ON (me.id=act.idmedionotificacion)
								INNER JOIN pa_actuacion actu ON (actu.id=act.idactuacion)
								INNER JOIN pa_departamento de ON (de.id=mu.iddepartamento)
								where act.id= $id");

  $listar->execute();

  return $listar;

  

  }  
 
 
/**********************************************************************************************************/
  /*----------------------- Modificar Actuaciones -------------------------------*/
  /*******************************************************************************************************/
  public function modificarActuación()
  {

	$esoficio_telegrama   			= $_POST['esoficio_telegrama'];
	$oficio_telegrama				= $_POST['oficio_telegrama'];
	$direccion						= $_POST['direccion'];
	$idmunicipio					= $_POST['ciudad'];
	$idmedionotificacion			= $_POST['medio_notificacion'];
	$tipo_actuacion					= $_POST['tipo_actuacion'];
	$idactuacion					= $_POST['idactuacion'];
	$id								= $_POST['id'];
	
	
	 //---------------PROYECTO OFICIOS TUTELAS, ADICIONADO POR JORGE ANDRES VALENCIA, 12 DE FEBRERO 2018------------------
	
	$fecha_envio		 			= $_POST['fecha_envio'];
			 
	$descripA						= $_POST['descripA'];
			 
	 //------------------------------------------------------------------------------------------------------------------

 	 
	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Datos Actuación';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico Datos Actuaci&oacute;n ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 2 porque va asociado al módulo de correspondencia 
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  $modificar = $this->db->prepare("update actuacion_tutela set esoficio_telegrama='$esoficio_telegrama', oficio_telegrama='$oficio_telegrama', 
	                                   direccion='$direccion',idmunicipio='$idmunicipio', idmedionotificacion='$idmedionotificacion', tipo_actuacion='$tipo_actuacion', 
									   idactuacion = '$idactuacion',descripcion = '$descripA',fecha_envio='$fecha_envio'  
									   where id='$id';");

      $modificar->execute();
	  
	  
	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';  
	  
	  
} 

 /***********************************************************************************/

	/*------------------------------ Eliminar  Actuación ---------------------------------*/

	/***********************************************************************************/	

	public function eliminarActuacion()

	{

		$id=$_GET['nombre'];
	    date_default_timezone_set('America/Bogota'); 
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1]; 
		
	    $accion='Elimin&oacute; Actuaci&oacute;n';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Elimino una Actuaci&oacute;n ".$fechal." "."a las: ".$hora;
	 
	
	    $tipolog=2;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();
	


		

	if($_SESSION['id']!="")
   {

   		$consulta = $this->db->prepare("DELETE FROM actuacion_tutela WHERE id='$id'");

		$consulta->execute();

		$resultado = $consulta->rowCount();

		

		 if ($resultado)

        {

			  $_SESSION['elemento'] = "Actuación eliminada exitosamente";

	          $_SESSION['elem_conscontrato'] = true;  

		}	

		echo '<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=filtrar_actuaciones"</script>';

		

	}

	
}

  /***********************************************************************************/

  /*------------------------------ Listar Tutelas a Editar  ---------------------------------------*/

  /***********************************************************************************/

  public function listarTutelasEditar()

  {

      $id=$_GET['nombre'];    

	  $listar = $this->db->prepare("select ct.id,ct.radicado,j.nombre,ct.Tutela_Incidente,ct.fecha,concat(ct.idjuzgado,'-',j.idarea,'-',j.numero_juzgado)as juzgado from correspondencia_tutelas ct
inner join pa_juzgado j on (ct.idjuzgado=j.id)
where ct.id='$id'");

	  $listar->execute();

	  return $listar; 

   

  }

 
  /***********************************************************************************/

  /*------------------------------ Listar Datos Radicado  ---------------------------------------*/

  /***********************************************************************************/

  public function listarDatosRadicado()

  {

      $id=$_GET['nombre'];    

	  $listar = $this->db->prepare("select ct.radicado from correspondencia_tutelas ct where ct.id='$id'");

	  $listar->execute();
	  
	  while($field = $listar->fetch())
       	 {
		  $radicado=$field['radicado'];
		  }
		
	  $ano= substr($radicado, 12, 4);
	  $consecutivo=substr($radicado, 18, 3);	
	  $instancia=substr($radicado, 21, 2);	   
	  
	  $vector[0][ano]=$ano;
	  $vector[0][consecutivo]=$consecutivo;
	  $vector[0][instancia]=$instancia;	  	  

	  

	  return $vector; 

   

  } 
/***********************************************************************************/

	/*------------------------------ Modificar datos basicos Tutela ---------------------------------*/

	/***********************************************************************************/	

	public function modificarTutela_basico()

	{
	
	$Tutela_Incidente = $_POST['proceso'];
	$juzgado          = $_POST['juzgado'];
	$temp = explode('-',$juzgado);
	$idjuzgado = $temp[0];
	$radicado = $_POST['radicado'];
	$id=$_POST['id'];
	
	 date_default_timezone_set('America/Bogota'); 
        $fechaa=date('Y-m-d g:ia');
        $horaa=explode(' ',$fechaa);
        $fechal=$horaa[0];
        $hora=$horaa[1]; 
		
	    $accion='Modic&oacute; Datos B&aacute;sicos Tutela/Incidente';
	    $idres = $_SESSION['idUsuario'];
        $detalle=$_SESSION['nombre']." "."Modic&oacute; Datos B&aacute;sicos Tutela/Incidente ".$fechal." "."a las: ".$hora;
	 
	
	    $tipolog=2;

        $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

        $insertarlog->execute();
		
		$modificar = $this->db->prepare("update correspondencia_tutelas set Tutela_Incidente='$Tutela_Incidente',idjuzgado='$idjuzgado',radicado='$radicado' where id='$id';");

      $modificar->execute();
	  
	  
	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';  
	
	
	}
	
/**********************************************************************************************************/
  /*----------------------- Modificar Correspondencia Otros -------------------------------*/
  /*******************************************************************************************************/
  public function modificarCorrespondencia_Otro()
  {

	$radicado   			= $_POST['radicado'];
	$juzgado				= $_POST['juzgado'];
	$esOficio_Telegrama		= $_POST['esOficio_Telegrama'];
	$oficio_telegrama       = $_POST['oficio_telegrama'];
	$destinatario			= $_POST['destinatario'];
	$direccion			    = $_POST['direccion'];
	$ciudad					= $_POST['estados'];
	$medio_notificacion     = $_POST['medio_notificacion'];
	$id    					= $_GET['nombre'];	

 	 
	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Correpondencia';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico Correspondencia ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 2 porque va asociado al módulo de correspondencia 
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	  
	  $modificar = $this->db->prepare("UPDATE correspondencia_otros SET idmedionotificacion='$medio_notificacion',radicado='$radicado',idjuzgado='$juzgado',esOficio_Telegrama='$esOficio_Telegrama',oficio_telegrama='$oficio_telegrama',destinatario='$destinatario',direccion='$direccion',idmunicipio='$ciudad'  where id='$id'");
	  $modificar->execute();
	  

	  
	  
	  print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=2"</script>';  
	  
	  
} 
	        
/*******************************  Consultar Filtro Actuaciones ***************************************************/

  public function consultar_filtro_actuacion()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $parte   				= $_GET['nombre7'];
 $direccion  			= $_GET['nombre8'];
 
 
 if(($fechai !='') and ($fechaf !=''))
 {
 

  $listar = $this->db->prepare("select actu.id as idactu,ct.radicado,actu.esoficio_telegrama,actu.oficio_telegrama,actu.direccion,av.accionante_accionado_vinculado from correspondencia_tutelas ct inner join accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=av.id)
where ct.radicado like '%$radicado%' and actu.esoficio_telegrama = '$esoficio_telegrama' and actu.oficio_telegrama like '%$oficio_telegrama%' and av.accionante_accionado_vinculado like '%$parte%' and actu.direccion like '%$direccion%' and actu.fecha_envio BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

 } 
 
else
{




  $listar = $this->db->prepare("select actu.id as idactu,ct.radicado,actu.esoficio_telegrama,actu.oficio_telegrama,actu.direccion,av.accionante_accionado_vinculado from correspondencia_tutelas ct inner join accionante_accionado_vinculado av ON (ct.id=av.idcorrespondencia_tutelas)
inner join actuacion_tutela actu on (actu.idaccionado_vinculado_accionante_tut=av.id)
where ct.radicado like '%$radicado%' and actu.esoficio_telegrama like '%$esoficio_telegrama%' and actu.oficio_telegrama like '%$oficio_telegrama%' and av.accionante_accionado_vinculado like '%$parte%' and actu.direccion like '%$direccion%'");

  $listar->execute();
 
}  


  return $listar;


  }        


/*******************************  Consultar Filtro Radicados ***************************************************/

  public function consultar_filtro_radicado()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $idjuzgado			    = $_GET['nombre5'];
 
 
 
 if(($fechai !='') and ($fechaf !='') and ($idjuzgado!=''))
 {


  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha 
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.idjuzgado='$idjuzgado' AND co.fecha BETWEEN '$fechai' AND '$fechaf'");

  $listar->execute();

 } 
 
else if (($fechai !='') and ($fechaf !='') and ($idjuzgado==''))
{


/*echo "SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha 
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.fecha BETWEEN '$fechai' AND '$fechaf'";
*/
  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha 
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.fecha BETWEEN '$fechai' AND '$fechaf'");

  $listar->execute();
 
}

else if   (($fechai =='') and ($fechaf =='') and ($idjuzgado==''))
{

  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha 
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%'");

  $listar->execute();

}
else if   (($fechai =='') and ($fechaf =='') and ($idjuzgado!=''))
{

 

  $listar = $this->db->prepare("SELECT co.id as idtut, co.radicado,co.idjuzgado,juz.nombre as juzgado,ar.nombre as area, co.fecha 
FROM  correspondencia_tutelas co INNER JOIN pa_juzgado juz  ON (co.idjuzgado=juz.id)
inner join pa_area ar on (ar.id=juz.idarea)
WHERE co.radicado LIKE '%$radicado%' AND co.idjuzgado='$idjuzgado'");

  $listar->execute();

}

  return $listar;


  }  
  
 /*******************************  Consultar Filtro Otro ***************************************************/

  public function consultar_filtro_otro()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $destinatario   		= $_GET['nombre7'];
 $direccion  			= $_GET['nombre8'];
 $idjuzgado  			= $_GET['nombre9'];
 $idmedionotificacion   = $_GET['nombre10']; 
 





 
if(($fechai !='') and ($fechaf !=''))
 {
 

  $listar = $this->db->prepare("SELECT co.id as idotro, co.radicado,co.esOficio_Telegrama,co.oficio_telegrama,co.direccion,co.destinatario,juz.nombre as juzgadonom, me.nombre as medionot, mu.nombre as municipio
FROM correspondencia_otros co
inner join pa_medionotificacion me ON (me.id=co.idmedionotificacion)
inner join pa_municipio mu ON (mu.id=co.idmunicipio)
inner join pa_juzgado juz ON (juz.id=co.idjuzgado)
WHERE co.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND co.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.destinatario LIKE '%$destinatario%' and co.radicado like '%$radicado%'
and co.direccion like '%$direccion%' and co.idmedionotificacion like '%$idmedionotificacion%' and co.idjuzgado like '%$idjuzgado%' and co.fecha BETWEEN '$fechai' and '$fechaf'");

  $listar->execute();

 } 
 
else
{



  $listar = $this->db->prepare("SELECT co.id as idotro, co.radicado,co.esOficio_Telegrama,co.oficio_telegrama,co.direccion,co.destinatario,juz.nombre as juzgadonom, me.nombre as medionot, mu.nombre as municipio
FROM correspondencia_otros co
inner join pa_medionotificacion me ON (me.id=co.idmedionotificacion)
inner join pa_municipio mu ON (mu.id=co.idmunicipio)
inner join pa_juzgado juz ON (juz.id=co.idjuzgado)
WHERE co.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND co.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.destinatario LIKE '%$destinatario%' and co.radicado like '%$radicado%'
and co.direccion like '%$direccion%' and co.idmedionotificacion like '%$idmedionotificacion%' and co.idjuzgado like '%$idjuzgado%'");

  $listar->execute();
 
}  

  return $listar;


  }        
 
 
  /*******************************  Consultar Filtro Turno ***************************************************/

  public function consultar_filtro_turno()

  {

 $radicado 				= $_GET['nombre2'];
 $fechai   				= $_GET['nombre3'];
 $fechaf   				= $_GET['nombre4'];
 $esoficio_telegrama    = $_GET['nombre5'];
 $oficio_telegrama   	= $_GET['nombre6'];
 $empleado		   		= $_GET['nombre7'];
 $area		  			= $_GET['nombre8'];
 $idjuzgado  			= $_GET['nombre9'];
 $direccion				= $_GET['nombre10']; 
 $tipo					= $_GET['nombre11']; 
 
 
if(($fechai !='') and ($fechaf !=''))
 {
 
  if ($tipo == 'Otro')
 {
  $listar = $this->db->prepare("SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,otro.esOficio_Telegrama,otro.oficio_telegrama,tu.tipo_proceso,otro.radicado,otro.direccion,otro.fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN correspondencia_otros otro ON (otro.id=tu.idproceso)
INNER JOIN pa_juzgado juz ON (juz.id=otro.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso ='Otro' AND otro.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND otro.oficio_telegrama LIKE '%$oficio_telegrama%' AND otro.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND otro.idjuzgado LIKE '%$idjuzgado%' AND otro.direccion LIKE '%$direccion%' AND otro.fecha BETWEEN '$fechai' and '$fechaf'");
}
else
{
$listar = $this->db->prepare("SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,act.esOficio_Telegrama,act.oficio_telegrama,tu.tipo_proceso,co.radicado,act.direccion,act.fecha_envio as fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN actuacion_tutela act ON (act.id=tu.idproceso)
INNER JOIN accionante_accionado_vinculado acc ON (acc.id=act.idaccionado_vinculado_accionante_tut)
INNER JOIN correspondencia_tutelas co ON (co.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=co.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso !='Otro' AND act.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND act.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND co.idjuzgado LIKE '%$idjuzgado%' AND act.direccion LIKE '%$direccion%' AND act.fecha_envio BETWEEN '$fechai' and '$fechaf'");

}
 



  $listar->execute();

 } 
 
else
{

	if ($tipo == 'Otro')
	{
	 $listar = $this->db->prepare("SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,otro.esOficio_Telegrama,otro.oficio_telegrama,tu.tipo_proceso,otro.radicado,otro.direccion,otro.fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN correspondencia_otros otro ON (otro.id=tu.idproceso)
INNER JOIN pa_juzgado juz ON (juz.id=otro.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso ='Otro' AND otro.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND otro.oficio_telegrama LIKE '%$oficio_telegrama%' AND otro.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND otro.idjuzgado LIKE '%$idjuzgado%' AND otro.direccion LIKE '%$direccion%'");
	
	}
	
	else
	{
	
	
	
	$listar = $this->db->prepare("SELECT usu.empleado,ar.nombre AS areaempleado, juz.nombre AS juzgado,act.esOficio_Telegrama,act.oficio_telegrama,tu.tipo_proceso,co.radicado,act.direccion,act.fecha_envio as fecha,tu.hora
FROM turno tu
INNER JOIN pa_usuario usu ON (tu.idusuario=usu.id)
INNER JOIN actuacion_tutela act ON (act.id=tu.idproceso)
INNER JOIN accionante_accionado_vinculado acc ON (acc.id=act.idaccionado_vinculado_accionante_tut)
INNER JOIN correspondencia_tutelas co ON (co.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=co.idjuzgado)
INNER JOIN pa_areaempleado ar ON (usu.idareaempleado=ar.id)
WHERE tu.tipo_proceso !='Otro' AND act.esOficio_Telegrama LIKE '%$esoficio_telegrama%' AND act.oficio_telegrama LIKE '%$oficio_telegrama%' AND co.radicado LIKE '%$radicado%' AND usu.empleado LIKE '%$empleado%' AND usu.idareaempleado LIKE '%$area%' AND co.idjuzgado LIKE '%$idjuzgado%' AND act.direccion LIKE '%$direccion%'");




	
	}


  $listar->execute();
 
}  
 return $listar;


  } 
  
 /*******************************  Consultar Filtro Otro ***************************************************/

  public function consultar_filtro_partes()

  {

 $radicado 				= $_GET['nombre1'];
 $tipo_parte   			= $_GET['nombre2'];
 $juzgado   			= $_GET['nombre3'];
 $parte    				= $_GET['nombre4'];
 

 
  $listar = $this->db->prepare("select ct.radicado,juz.nombre as juzgado, acc.accionante_accionado_vinculado,acc.esaccionante_accionado_vinculado,acc.id  as idacc
from accionante_accionado_vinculado acc 
INNER JOIN correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=ct.idjuzgado)
WHERE ct.radicado like '%$radicado%' AND acc.esaccionante_accionado_vinculado like '%$tipo_parte%' 
AND ct.idjuzgado like '%$juzgado%' AND acc.accionante_accionado_vinculado like '%$parte%';");

  $listar->execute();


  return $listar;
  
}  
 /*******************************  Consultar Filtro Especifica ***************************************************/

  public function consultar_filtro_parte_especifica()

  {


 $id = $_GET['nombre'];	

 
  $listar = $this->db->prepare("select ct.radicado,juz.nombre as juzgado, acc.accionante_accionado_vinculado,acc.esaccionante_accionado_vinculado,acc.id  as idacc
from accionante_accionado_vinculado acc 
INNER JOIN correspondencia_tutelas ct ON (ct.id=acc.idcorrespondencia_tutelas)
INNER JOIN pa_juzgado juz ON (juz.id=ct.idjuzgado)
WHERE acc.id ='$id';");

  $listar->execute();


  return $listar;
  
}  

  
   /***********************************************************************************/

  /*------------------------------ Consultar SAIDOJ  ---------------------------------------*/

  /***********************************************************************************/

  public function consultarsaidoj()

  {
/*
SERV-JUSTICIA2
local
consejoPN

T103DAINFOPROC
A103LLAVPROC*/




$serverName = "SAD_AUX9\SQLEXPRESS";  

$connectionInfo = array( "Database"=>"saidoj"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo); 

if( $conn ) { 
     echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

$sql = "SELECT TOP 10 id_tipo_inc, id_juzgado,descripcion,fecha_demanda  from EXPEDIENTE";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
/*if ($row_count === false)
   echo "Error in retrieveing row count.";
else
   echo $row_count;*/
$i=0;
while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    $date= $row['fecha_demanda'];
	  $fecha1= date_format($date, 'Y-m-d');
	  $vector[$i][id_tipo_inc] = $row['id_tipo_inc'];
	  $vector[$i][id_juzgado] = $row['id_juzgado'];
	  $vector[$i][fecha_demanda] =  $fecha1;
	$i++; 	  
}

	  //print_r($vector);
	  
	  return $vector; 

   

  }  
 
 /**********************************************************************************************************/
  /*------------------------------------------------ Modificar Parte -------------------------------------*/
  /*******************************************************************************************************/
  public function modificar_parte()
  {

	$id   					= $_GET['nombre'];
	$parte					= $_POST['parte'];
	$tipo_parte				= $_POST['tipo_parte'];
	
 	 
	  date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Modific&oacute; Parte';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Modifico Parte ".$fechal." "."a las: ".$hora;
	  
	   //es de tipo 2 porque va asociado al módulo de correspondencia 
	  $tipolog=2;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
	  
	if($tipo_parte!='Accionante')
	{	  
	  $modificar = $this->db->prepare("UPDATE accionante_accionado_vinculado SET accionante_accionado_vinculado='$parte',esaccionante_accionado_vinculado='$tipo_parte'  where id='$id'");
	}
	else
	{
	 $modificar = $this->db->prepare("UPDATE accionante_accionado_vinculado SET accionante_accionado_vinculado='$parte' where id='$id'");
	}  
	  
	  $modificar->execute();
	  

	  
	  
	  print'<script languaje="Javascript">location.href="index.php?controller=consulta&action=mensajes&nombre=2"</script>';  
	  
	  
} 
 
   /***********************************************************************************/
  /*----------------------- Registrar Memorial -------------------------------*/
  /***********************************************************************************/
  public function registrarMemorial(){
  
  		require 'models/wordModel.php';
		
		require_once('ftp/ftp_class.php');
		
		$error_transaccion = 0; //variable para detectar error
		$msgError          = "";
		
		
  		$modelo = new correspondenciaModel();


		//SE OBTIENEN LOS DATOS
		$idusuario            = $_SESSION['idUsuario'];
		
		$fecha  		   	   = $_POST['fecha'];
		$tipo_documento 	   = $_POST['tipo_documento'];
		$juzgado  		   	   = $_POST['idjuzgado'];
		$radicado   		   = $_POST['radicado'];
		
		$solicitud   		   = $_POST['solicitud'];
		$clase_solicitud	   = $_POST['clase_solicitud'];
		
		//PARA INCIDENTE DESACATO EN SALUD
		//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 29 DE ENERO 2020
		$id_clasesalud    = $_POST['clase_solicitud_salud'];
		$id_subclasesalud = $_POST['subclase_solicitud_salud'];
		$id_eps           = $_POST['eps_salud'];
		
		$telefono         = $_POST['telefono'];//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 24 DE FEBRERO 2020
		//FIN PARA INCIDENTE DESACATO EN SALUD
		
		$peticionario		   = $_POST['peticionario'];
		$folios				   = $_POST['folios'];
		$recibe				   = $_POST['recibe'];
		$juzgadodestino		   = $_POST['juzgadodestino'];
		$generado			   = 'no';
		$existe				   = $_POST['manual2'];
		$idubicacionexpediente = $_GET['nombre'];
		
		$observacionesm		   = $_POST['observacionesm'];
		
		$fecha_entrega         = $modelo->get_fecha_actual_amd();
		$hora_militar          = $modelo->get_hora_actual_24horas();

		
		$cantidad_memoriales   = $_POST['cantidad_memoriales'];
		
		$solicitud1               = explode("-", $solicitud);
		$finsol                   = $solicitud1[1];
		$solicitud                = $solicitud1[0];
		$nombre_archivo_solicitud = $solicitud1[2];//PARA RENOMBRAR EL ARCHIVO SEGUN EL TIPO DE SOLICITUD SELECCIONADA 15 ABRIL 2021
		$actu                     = "Recepción Memorial por " .$finsol;
		
		$fecha_crem = $_POST['fecha_creacion'];
		
		//$error_transaccion = 0; //variable para detectar error
		//$msgError          = "";
		
		//CONEXION BASE DE DATOS JUSTICIA XXI
		$datosbd   = $modelo->get_datos_basededatos(1);
		$datosbd_b = $datosbd->fetch();
		$datosbd_1 = $datosbd_b[ip];
		$datosbd_2 = $datosbd_b[bd];
		$datosbd_3 = $datosbd_b[usuario];
		$datosbd_4 = $datosbd_b[clave];
		
		
		//SI ES Devolucíon Oficio Tutela 4-72
		//ADICIONADO POR INGENIERO JORGE ANDRES VALENCIA 28 DE ENERO 2020
		if($solicitud == 72){
		
		
		
			//-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
										
			try {  
										 
				$ENTRE = 0;
						
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//EMPIEZA LA TRANSACCION
				$this->db->beginTransaction();
											
											
											
				//*********************************NUEVA CONEXON**************************************************
						
				$serverName     = $datosbd_1; //serverName\instanceName
				$connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
				$conn           = sqlsrv_connect( $serverName, $connectionInfo);
													
													
				if( $conn === false ) {
														
					$error_transaccion = 1;
													
					$ENTRE = 1;
													
					if( ($errors = sqlsrv_errors() ) != null) {
														
						foreach( $errors as $error ) {
															
							$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
							
						}
					}
														
					//echo "ENTRE 1";
														
				}
													
				//Iniciar la transacción.
				if ( sqlsrv_begin_transaction( $conn ) === false ) {
														 
					$error_transaccion = 1;
													
					$ENTRE = 2;
													
					if( ($errors = sqlsrv_errors() ) != null) {
														
						foreach( $errors as $error ) {
															
							$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
							
						}
						
					}
														 
					//echo "ENTRE 2";
														 
				}
											
											
											
				if($existe==true){
												
					$existes =  "no";
					
				}
				else{
											
					$existes = "si";
												
				}	
											
														  
											
				$this->db->exec("INSERT INTO correspondencia (fecha_registro,radicado,peticionario,tipo_documento,idjuzgado,fecha_entrega,idjuzgadodestino,
								 idsolicitud,idclasesolicitud,idusuario,folios,generado,existe,idubicacionexpediente,observacionesm)
								 VALUES ('$fecha','$radicado','$peticionario','$tipo_documento','$juzgado','$fecha_entrega','$juzgadodestino',
								 '$solicitud','$clase_solicitud','$recibe','$folios','$generado','$existes','$idubicacionexpediente','$observacionesm')");			  	  
												
												
											
				//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
				$last_id = $this->db->lastInsertId();		
											
											
											
				//REGISTRAR ACTUACION EN JUSTICIA XXI
										
				$sininstancia = $radicado;
				$sin          = substr($sininstancia, 0, 21);
				
				
												
				/*$sql = ("	
						
							declare @cad integer 
			
							UPDATE t103dainfoproc SET a103descacts='Recepción Memorial', a103codiacts='30000123', a103codipads='30000123', 
							a103fechdess = GETDATE(), a103anotacts = '$actu'
							WHERE a103llavproc='$radicado';
														
							SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
														
							INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
							A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
							A110RENUTERM) values('$radicado',@cad,'$sin','00','30000123','30000123','Recepción Memorial','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
							'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
														
														
													
														
						");*/
						
				
				$sql = ("	
						
							
			
							UPDATE t103dainfoproc SET a103descacts='Recepción Memorial', a103codiacts='30000123', a103codipads='30000123', 
							a103fechdess = GETDATE(), a103anotacts = '$actu'
							WHERE a103llavproc='$radicado';
														
							
														
						");		
												
												
				
						$params  = array();
						$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
						$stmt = sqlsrv_query( $conn, $sql , $params, $options );
													
													
						if( $stmt === false ) {
													
							$error_transaccion = 1;
												
							$ENTRE = 5;
													
							if( ($errors = sqlsrv_errors() ) != null) {
														
								foreach( $errors as $error ) {
															
									$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
								}
							}
												
						}	
										
						sqlsrv_free_stmt( $stmt);
						
						
						
						
						$sql_2 = ("	
						
									declare @cad integer 
					
									SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
																
									INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
									A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
									A110RENUTERM) values('$radicado',@cad,'$sin','00','30000123','30000123','Recepción Memorial','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
									'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
																
																
															
																
								");
												
												
				
						$params_2  = array();
						$options_2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
						$stmt_2    = sqlsrv_query( $conn, $sql_2 , $params_2, $options_2 );
													
													
						if( $stmt_2 === false ) {
													
							$error_transaccion = 1;
												
							$ENTRE = 5;
													
							if( ($errors = sqlsrv_errors() ) != null) {
														
								foreach( $errors as $error ) {
															
									$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
								}
							}
												
						}	
										
						sqlsrv_free_stmt( $stmt_2);
											
											
											
						if($error_transaccion) {
							
			
							echo "ERROR EN LA OPERACION MYSQL ".mysql_errno($conexion). ": " . mysql_error($conexion)."<br>"."<br>"." ,ERROR JUSTICIA XXI: ".$msgError." ,ENTRE: ".$ENTRE;
												
											
							//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
							$this->db->rollBack();
												
											
							//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
							sqlsrv_rollback( $conn );
											
							// Cerrar la conexión.
							sqlsrv_close( $conn );
												
												
												
										
						} //FIN if($error_transaccion) 
						else {
												
							//SE TERMINA LA TRANSACCION  
		  					$this->db->commit();		
												
												
							//SE TERMINA LA TRANSACCION EN JUSTICIA XXI
							//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;  
							sqlsrv_commit( $conn );	
												
												
								echo '<script languaje="JavaScript"> 
							
										var id_radi = "'.$idubicacionexpediente.'";
												
										alert("PROCESO SE REALIZA CORRECTAMENTE");
															
										
										location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi; 
																	
									</script>';
												
												
												
									
												
						}
												
									
						
										
			}//FIN TRY
			catch (Exception $e) {
										
				//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
				$this->db->rollBack();

								
				echo "Fallo: " . $e->getMessage();
											
				//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
				sqlsrv_rollback( $conn );
											
				// Cerrar la conexión.
				sqlsrv_close( $conn );
											
											
				//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
				
			}
		
		
		
		
		
		
		}
		else{//ELSE A
		
		
		//SI ES INCIDENTE SALUD
		if($solicitud == 116){
		
		
			
			//--------------------------SUBIDA DEL ARCHIVO ESCANEADO DE INCIDENTE EN SALUD------------------------------------
			//$server  = '172.16.172.90';//IP EQUIPO AL LADO DEL SERVIDOR OFICINA OECM
			//$server  = "C07003-OF13316";//NOMBRE EQUIPO AL LADO DEL SERVIDOR OFICINA OECM
			
			//$server     = "172.16.177.42";//SERVIDOR JUANCHO INGENIERO OFICINA JUDICIAL
			
			//$server  = '192.168.89.28';//SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
			
			$server  = '190.217.24.24';//SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
			
			
			$usuario = 'anonymous';
			$pass    = '';
			$ftp     = new FTPClient();
			$ftp->connect($server,$usuario,$pass);
			$arrayMensajes = $ftp->getMessages();
			
			if($arrayMensajes[0] == trim('FALLO CONEXION')){
				
				$error_transaccion = 1;
				
				$ENTRE = 'FALLO CONEXION FTP';
			}
			if($arrayMensajes[0] == trim('CONEXION OK')){
			
				$error_transaccion = 0;
				
				//CREAR DIRECTORIO
				//$dir = 'T1';//PARA PRUEBAS 
				//$dir = '8';//PARA PRUEBAS
				$dir = '4';//PARA SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD    
				$ftp->makeDir($dir); 
				
				//$raiz_ftp = "D:/SALUD";//PARA PRUEBAS
				$raiz_ftp = "file_Incidentes_Salud";//PARA SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
				
				
			}
			
			/*foreach($arrayMensajes as $mensajes){
				
				//echo $mensajes.' ';
				
				echo '<script languaje="JavaScript"> 
						
									
						var conexion            = "'.$mensajes.'";
						var error_transaccion_1 = "'.$error_transaccion.'";
									
						alert("CONEXION :"+ conexion+", error_transaccion: "+error_transaccion_1);
									
									
											
					</script>';
			}*/
			
			//--------------------------FIN SUBIDA DEL ARCHIVO ESCANEADO DE INCIDENTE EN SALUD------------------------------------
			
			
		
		
			//CONEXION BASE DE DATOS LOCAL
			//$datosbd     = $modelo->get_datos_basededatos(2);//SERVIDOR LOCAL PARA PRUEBAS
			//$datosbd     = $modelo->get_datos_basededatos(6);//SERVIDOR JUANCHO INGENIERO OFICINA JUDICIAL
			//$datosbd     = $modelo->get_datos_basededatos(7);//SERVIDOR LOCAL PARA PRUEBAS
			
			$datosbd     = $modelo->get_datos_basededatos(8);//SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
			
			$datosbd_b   = $datosbd->fetch();
			$bd_host     = $datosbd_b[ip];
			$bd_base     = $datosbd_b[bd];
			$bd_usuario  = $datosbd_b[usuario];
			$bd_password = $datosbd_b[clave];
			
			$conexion    = mysql_connect($bd_host, $bd_usuario, $bd_password); 
			mysql_select_db($bd_base, $conexion); 
			
			
			/*echo '<script languaje="JavaScript"> 
					
								
					var conexion = "'.$conexion.'";
								
					alert("CONEXION :"+ conexion);
								
								
										
				</script>';*/
			
			
			if($conexion > 0){
			
				//***********************************PARA EL ARCHIVO***************************************
	
				//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
				$raiz = "INCIDENTESALUD";
				//ID DEL USUARIO DE LA TABLA pa_usuario
				//$nom = trim($_SESSION['idUsuario']);
				//SIGLA QUE IDENTIFICA DE QUE TABLA Y LUGAR SE INSERTA EL REGISTRO
				//$nom = trim("T1");
				//$nom = trim("8");//DATO PROPORCIONADO POR EL INGENIERO JUANCHO INGENIERO OFICINA JUDICIAL PARA PRUEBAS
				
				$nom = trim("4");//DATO PROPORCIONADO POR EL INGENIERO JUANCHO INGENIERO OFICINA JUDICIAL,SERVIDOR REAL PARA EL APLICATIVO INCIDENTE DESACATO EN SALUD
				
				//AQUI SE CREA EL DIRECTORIO
				if(is_dir($raiz.'/'.$nom)){$bandera=0;}
				else{mkdir($raiz.'/'.$nom, 0, true);}
				
				//datos del arhivo 
				$nombre_archivo = $_FILES['archivo']['name']; 
				//echo $nombre_archivo;
				$tipo_archivo   = $_FILES['archivo']['type'];
				//echo $tipo_archivo;
				$tamano_archivo = $_FILES['archivo']['size']; 
				//echo $tamano_archivo;
				
				
				if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
				
				
				
				
				
							if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
								 || strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
								 || strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
							     || strpos($tipo_archivo, "pdf") //pdf
							)    && ($tamano_archivo < 100000000) )  { 
							
								
								
								/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';*/
								
								
								echo '<script languaje="JavaScript"> 
							
										
										var id_radi = "'.$idubicacionexpediente.'";
										
										var dat_1 = "'.$tipo_archivo.'";
							
										alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA: "+dat_1);
										
										location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
												
									</script>';
								
								
							}
							else{//1 
							
								
									if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
										//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
										
										/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=2"</script>';*/
										
										//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
										//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
										$idunico = time();
										
										$nombre_archivo = $idunico."_".$nombre_archivo;
										
										
									}
								
								
									if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
										 //echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
										 
										 
										$rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
										 
										 
										//------------------SUBIR ARCHIVO VIA FTP------------------
										$fileFrom      = $rutaarchivo;
										$fileTo        = $dir . '/' . $nombre_archivo;
									
										//SE CAMBIA DE ESTA FORMA 
										//D:/SALUD/8/ESTADO_186_JUZGADO_2_5_NOVIEMBRE_2019.pdf (A) ESTADO_186_JUZGADO_2_5_NOVIEMBRE_2019.pdf
										//YA QUE DESDE EL MODULO DEL INGENIERO JUAN ESTEBAN SE CONCATENA CON EL RESTO DE LA RUTA
										//$rutaarchivo_2 = $raiz_ftp.'/'.$fileTo;
										$rutaarchivo_2  = $nombre_archivo;
							
										$ftp->uploadFile($fileFrom, $fileTo);
										
										//------------------FIN SUBIR ARCHIVO VIA FTP----------------
										 
										 //RUTAS ARCHIVO
										 $ruta_local  =  $rutaarchivo;
										 $ruta_remota = $raiz_ftp.'/'.$fileTo;
										 
										 //-------------------------SE REGISTRAN LOS DATOS EN LA TABLA-----------------------------------------
										 //-------------------------CUANDO SE DEFINE UN ARCHIVO------------------------------------------------
										 try {  
										 
										 	//$ENTRE = 0;
						
											$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											//EMPIEZA LA TRANSACCION
											$this->db->beginTransaction();
											
											
											mysql_query("START TRANSACTION",$conexion);
											
											
											//*********************************NUEVA CONEXON**************************************************
						
											$serverName     = $datosbd_1; //serverName\instanceName
											$connectionInfo = array( "Database"=>$datosbd_2, "UID"=>$datosbd_3, "PWD"=>$datosbd_4);
											$conn           = sqlsrv_connect( $serverName, $connectionInfo);
													
													
											if( $conn === false ) {
														
													$error_transaccion = 1;
													
													$ENTRE = 1;
													
													if( ($errors = sqlsrv_errors() ) != null) {
														
														foreach( $errors as $error ) {
															
															$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
														}
													}
														
													//echo "ENTRE 1";
														
											}
													
											//Iniciar la transacción.
											if ( sqlsrv_begin_transaction( $conn ) === false ) {
														 
													$error_transaccion = 1;
													
													$ENTRE = 2;
													
													if( ($errors = sqlsrv_errors() ) != null) {
														
														foreach( $errors as $error ) {
															
															$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
														}
													}
														 
													//echo "ENTRE 2";
														 
											}
											
											
											
											if($existe==true){
												
												$existes =  "no";
											}
											else{
											
												$existes = "si";
												
											}	
											
											/*$query     = "INSERT INTO correspondencia (fecha_registro,radicado,peticionario,tipo_documento,idjuzgado,fecha_entrega,idjuzgadodestino,
														  idsolicitud,idusuario,folios,generado,existe,idubicacionexpediente,observacionesm)
														  VALUES ('$fecha','$radicado','$peticionario', '$tipo_documento','$juzgado','$fecha','$juzgadodestino',
														  '$solicitud','$recibe','$folios','$generado','$existes','$idubicacionexpediente','$observacionesm')";	*/
														  
											
											$this->db->exec("INSERT INTO correspondencia (fecha_registro,radicado,peticionario,telefono,tipo_documento,idjuzgado,fecha_entrega,idjuzgadodestino,
														     idsolicitud,idusuario,folios,generado,existe,idubicacionexpediente,observacionesm,
															 ruta_local,ruta_remota,sal_id_estado,id_clasesalud,id_subclasesalud,id_eps)
														     VALUES ('$fecha','$radicado','$peticionario','$telefono','$tipo_documento','$juzgado','$fecha_entrega','$juzgadodestino',
														     '$solicitud','$recibe','$folios','$generado','$existes','$idubicacionexpediente','$observacionesm',
															 '$ruta_local','$ruta_remota',1,'$id_clasesalud','$id_subclasesalud','$id_eps')");			  	  
												
												
											
											//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
											$last_id = $this->db->lastInsertId();		
											
											
											/*$resultado = mysql_query($query) or die(mysql_error());
											
											//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA correspondencia
											$last_id  = mysql_insert_id();
												
											if (!$resultado) {
																
												$error_transaccion = 1;
												
												$ENTRE = 3;
																								
											}*/
											
												
											/*$query_2   = "INSERT INTO oficina_judicial(idmemorial,idtabla,ruta_archvio) 
														  VALUES('$last_id','T1','$rutaarchivo')";*/		
											
											
											//IDENTIFICO QUE LOS IDS DE ESTOS JUZGADOS EN MI BASE DE DATOS LOCAL SON DIFERENTES EN LA 
											//BASE DE DATOS DE LA OFICINA JUDICIAL Y
											//SON LOS ASIGNADOS POR ELLOS
											//BASE DE DATOS LOCAL (EJECUCION)
											//1 JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
											//2 JUZGADO SEGUNDO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
											//7 Oficina Ejecución
											//BASE DE DATOS OFICNA JUDICIAL
											//63 JUZGADO PRIMERO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
											//64 JUZGADO SEGUNDO DE EJECUCION CIVIL MUNICIPAL DE MANIZALES
											//65 Oficina Ejecución
											if($juzgadodestino == 1){$juzgadodestino_2 = 63;}
											if($juzgadodestino == 2){$juzgadodestino_2 = 64;}
											if($juzgadodestino == 7){$juzgadodestino_2 = 65;}
														  
														  
											
												
												$query_2   = "INSERT INTO  salud_documento_entrante (
																  sal_id_externo,
																  sal_id_usuario,
																  sal_id_juzgado_int,
																  sal_fecha,
																  sal_hora,
																  sal_radicado, 
																  sal_remitente,
																  sal_id_tipo_documento,
																  sal_nfc,
																  sal_id_juzgado_destino,
																  sal_telefono,
																  sal_ruta_documento,
																  sal_id_estado,
																  sal_id_bd_externa,
																  sal_id_clase,
																  sal_id_subClase,
																  sal_id_eps
															  ) 
															  VALUES(
																  '$last_id',
																  '$idusuario',
																  '$juzgadodestino_2',
																  '$fecha_entrega',
																  '$hora_militar',
																  '$radicado',
																  '$peticionario',
																  1,
																  '$observacionesm',
																  '$juzgadodestino',
																  '$telefono',
																  '$rutaarchivo_2',
																  1,
																  4,
																  '$id_clasesalud',
																  '$id_subclasesalud',
																  '$id_eps'
															   )";
												
															 
											$resultado_2 = mysql_query($query_2);
												
											if (!$resultado_2) {
																
												$error_transaccion = 1;
												
												$ENTRE = 4;
																								
											}
											
											
											//REGISTRAR ACTUACION EN JUSTICIA XXI
										
											$sininstancia = $radicado;
											$sin          = substr($sininstancia, 0, 21);
											
											
												
											/*$sql = ("	
						
														declare @cad integer 
			
														UPDATE t103dainfoproc SET a103descacts='Recepción Incidente de Desacato en Salud', a103codiacts='30023589', a103codipads='30010162', 
														a103fechdess = GETDATE(), a103anotacts = '$actu'
														WHERE a103llavproc='$radicado';
														
														SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
														
														INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
														A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
														A110RENUTERM) values('$radicado',@cad,'$sin','00','30023589','30010162','Recepción Incidente de Desacato en Salud','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
														'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
														
														
													
														
												");*/
												
											$sql = ("	
						
														
			
														UPDATE t103dainfoproc SET a103descacts='Recepción Incidente de Desacato en Salud', a103codiacts='30023589', a103codipads='30010162', 
														a103fechdess = GETDATE(), a103anotacts = '$actu'
														WHERE a103llavproc='$radicado';
														
														
														
													");
												
												
				
											$params  = array();
											$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
											$stmt = sqlsrv_query( $conn, $sql , $params, $options );
													
													
											if( $stmt === false ) {
													
												$error_transaccion = 1;
												
												$ENTRE = 5;
													
												if( ($errors = sqlsrv_errors() ) != null) {
														
													foreach( $errors as $error ) {
															
														$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
													}
												}
												
											}	
										
											sqlsrv_free_stmt( $stmt);
											
											
											
											$sql_2 = ("	
						
														declare @cad integer 
			
								
														SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
														
														INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
														A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
														A110RENUTERM) values('$radicado',@cad,'$sin','00','30023589','30010162','Recepción Incidente de Desacato en Salud','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
														'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')	
														
														
													
														
													");
												
												
				
											$params_2  = array();
											$options_2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
											$stmt_2    = sqlsrv_query( $conn, $sql_2 , $params_2, $options_2 );
													
													
											if( $stmt_2 === false ) {
													
												$error_transaccion = 1;
												
												$ENTRE = 6;
													
												if( ($errors = sqlsrv_errors() ) != null) {
														
													foreach( $errors as $error ) {
															
														$msgError .= "ERROR EN REGISTRO: "." SQLSTATE: ".$error[ 'SQLSTATE'].", CODE: ".$error[ 'code'].", MENSAJE: ".$error[ 'message'];
													}
												}
												
											}	
										
											sqlsrv_free_stmt( $stmt_2);
											
											
											
											
											
											if($error_transaccion) {
							
			
												echo "ERROR EN LA OPERACION MYSQL ".mysql_errno($conexion). ": " . mysql_error($conexion)."<br>"."<br>"." ,ERROR JUSTICIA XXI: ".$msgError." ,ENTRE: ".$ENTRE;
												
											
												//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											    $this->db->rollBack();
												
											
												//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
												mysql_query("ROLLBACK",$conexion);
												
												
												//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
												sqlsrv_rollback( $conn );
											
												// Cerrar la conexión.
												sqlsrv_close( $conn );
												
												
												//SE ELIMINA EL Archivo Escaneado, POR QUE SE PRESENTO ALGUN ERROR
												//EN EL REGISTRO DE LA INFORMACION
												unlink($rutaarchivo);
												
												//SE ELIMINA EL Archivo Escaneado, VIA FTP
												$ftp->delete_file($fileTo);
												
												
										
											} //FIN if($error_transaccion) 
											else {
												
												//SE TERMINA LA TRANSACCION  
		  										$this->db->commit();		
												
												//SE TERMINA LA TRANSACCION 
												mysql_query("COMMIT",$conexion);
												
												
												//SE TERMINA LA TRANSACCION EN JUSTICIA XXI  
												sqlsrv_commit( $conn );	
												
												//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
												echo '<script languaje="JavaScript"> 
							
															var id_radi = "'.$idubicacionexpediente.'";
												
															alert("PROCESO SE REALIZA CORRECTAMENTE");
															
															location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
															
																	
													  </script>';
												
												
												
									
												
											}
												
									
						
										
										}//FIN TRY
										catch (Exception $e) {
										
											//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											$this->db->rollBack();

											
											//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
											mysql_query("ROLLBACK",$conexion);
											
											echo "Fallo: " . $e->getMessage();
											
											//NO TERMINA LA TRANSACCION ERROR AL INGRESAR LOS DEATOS A SIGLO XXI
											sqlsrv_rollback( $conn );
											
											// Cerrar la conexión.
											sqlsrv_close( $conn );
											
											
											//SE ELIMINA EL Archivo Escaneado, POR QUE SE PRESENTO ALGUN ERROR
											//EN EL REGISTRO DE LA INFORMACION
											unlink($rutaarchivo);
											
											//SE ELIMINA EL Archivo Escaneado, VIA FTP
											$ftp->delete_file($fileTo);
												
											//location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
										}
										
										
										
										
									}//3
									else{ 
										 //echo "Error al subir el fichero."; 
										 /*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=3"</script>';*/
										 
										 //location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
										 echo '<script languaje="JavaScript"> 
							
													var id_radi = "'.$idubicacionexpediente.'";
										
													alert("Error al subir el fichero.");
													
													
													location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
															
												</script>';
									} 
								
								
								
							}//1
							
							
							
							
						
			
				}
				else{
				
					echo '<script languaje="JavaScript"> 
					
								
								var id_radi = "'.$idubicacionexpediente.'";
								
								alert("SELECCIONO INCIDENTE DESACATO EN SALUD, Y NO ANEXO ARCHIVO ESCANEADO");
								
								location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
										
							</script>';
				
				
				}
				
				
			
			}//FIN if($conexion > 0){
			else{

					//echo $conexion; 
					//echo "Fallo en la Conexión";
					
					
					echo '<script languaje="JavaScript"> 
				
							
							var id_radi = "'.$idubicacionexpediente.'";
							
							alert("Fallo en la Conexión");
							
							location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
									
						</script>';
					
					
			}	
			
		
		
		}//FIN if($solicitud == 116){
		
		//ALGORITMO ORIGINAL ANTES DE ANEXAR LA SOLICITUD INCIDENTE SALUD
		else{//ELSE 1
		
		
		
		
			if($existe==true)
			{
			$existes =  "no";
			}
			else
			{
			$existes = "si";
			}
			
			$sininstancia = $radicado;
			$sin = substr($sininstancia, 0, 21);
			
			
			//***********************************PARA EL ARCHIVO***************************************
	
			//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE EL ID DEL USUARIO DE LA TABLA pa_usuario 
			$raiz = "MEMORIALES";
			//ID DEL USUARIO DE LA TABLA pa_usuario
			$nom = trim($_SESSION['idUsuario']);
			//IDENTIFICA ERROR EN CARGA DEL ARCHIVO
			$erro_archivo = 0;
				
			//AQUI SE CREA EL DIRECTORIO
			if(is_dir($raiz.'/'.$nom)){$bandera=0;}
			else{mkdir($raiz.'/'.$nom, 0, true);}
				
			//datos del arhivo 
			$nombre_archivo = $_FILES['archivomemo']['name']; 
			//echo $nombre_archivo;
			$tipo_archivo   = $_FILES['archivomemo']['type'];
			//echo $tipo_archivo;
			$tamano_archivo = $_FILES['archivomemo']['size']; 
			//echo $tamano_archivo;
				
				
			if ($nombre_archivo != "") {//IF QUE ME IDENTIFICA QUE SE SELECCIONO UN ARCHIVO
				
				
				//---------------------VALIDAR NOMBRE ARCHIVO----------------------------------------
				
				//LA VALIDACION SE UBICA EN ESTA PARTE, PARA QUE EL NOMBRE DEL ARCHVIO SEA VALIDADO ANTES
				//DE SER SUBIDO AL SERVIDOR
				for($x = 0; $x < strlen($nombre_archivo); $x++) {
												
					$caracter = ord($nombre_archivo[$x]);
													 
					if( 
																						
							//NOTA:
							//SE DEJA DE ESTA FORMA YA QUE ANTES DE LA VALIDACION DE SUBE EL ARCHIVO
							//Y SE CONCATENA CON$idunico = time(); $nombre_archivo = $idunico."_".$nombre_archivo;		
							//QUEDANDO EL NOMBRE DEL ARCHIVO CON ( _ GUION BAJO ) Y ESTE CARACTER ESTA VALIDADO
							//EN EL IF CERRADO COMO CARACTER INVALIDO, IGUAL EL NOMBRE DEL ARCHIVO CAMBIA
							//SEGUN EL TIPO DE SOLICITUD SELECCIONADA													 
							/*($caracter >= 32  && $caracter <= 44)   ||
							($caracter >= 47  && $caracter <= 47)   || 
							($caracter >= 58  && $caracter <= 64)   || 
							($caracter >= 91  && $caracter <= 94)   || 
							($caracter >= 96  && $caracter <= 96)   ||
							($caracter >= 123 && $caracter <= 254)*/
							
							($caracter >= 32  && $caracter <= 45)  ||
							($caracter >= 47  && $caracter <= 47)  ||
							($caracter >= 58  && $caracter <= 64)  || 
							($caracter >= 91  && $caracter <= 96)  || 
							($caracter >= 123 && $caracter <= 254)
																						 
					) {
															
							//echo "CARACTER NO VALIDO EN NOMBRE DE ARCHIVO:".$nombre_archivo[$x]."<br>"."<br>"." SOLO SE PERMITE EL CARACTER RAYA AL MEDIO (-) Y NOMBRES CONFORMADOS POR LETRAS, NUMEROS Y TODO PEGADO";
															
							$x = strlen($nombre_archivo);
															
							$erro_archivo = 1;
													
							$idcaracter = chr($caracter);
															
							echo '<script languaje="JavaScript"> 
										
										var nombre_archivoX = "'.$nombre_archivo.'";
																		
										var idcaracter      = "'.$idcaracter.'";
																		
																		
										alert("CARACTER NO VALIDO EN NOMBRE DE ARCHIVO: "+nombre_archivoX+" CARACTER: "+idcaracter+" SOLO NOMBRES CONFORMADOS POR LETRAS O NUMEROS Y TODO PEGADO");
																		
																		
										var id_radi = "'.$idubicacionexpediente.'";
																		
										location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
																							
																	
									</script>';
															
													
					}
													
													
													
				}
				
				
				//---------------------FIN VALIDAR NOMBRE ARCHIVO------------------------------------
				
				
				if (! ( strpos($tipo_archivo, "vnd.ms-excel") //csv
						|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.spreadsheetml.sheet") //xlsx
						|| strpos($tipo_archivo, "vnd.openxmlformats-officedocument.wordprocessingml.document")//docx
					    || strpos($tipo_archivo, "pdf") //pdf
					)    && ($tamano_archivo < 1000000000000) )  { 
							
								
								
						/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=1"</script>';*/
								
						
						$erro_archivo = 1;
								
						echo '<script languaje="JavaScript"> 
							
										
									var id_radi = "'.$idubicacionexpediente.'";
										
									var dat_1 = "'.$tipo_archivo.'";
							
									alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA: "+dat_1);
										
									location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
									
												
								</script>';
								
								
				}
				else{//1 
							
								
					if ( file_exists($raiz.'/'.$nom.'/'.$nombre_archivo) ) {
							//echo "2 YA EXISTE UN ARCHIVO CON ESE NOMBRE";
										
							/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=2"</script>';*/
										
							//OBTENGO UN ID PARA IDENTIFICAR UN ARCHIVO CON EL MISMO NOMBRE
							//PARA AGREGARLE EL ID A ESE NOMBRE Y QUE EL SISTEMA CONTINUE SIN AVISO DE YA EXISTE UN ARCHIVO CON ESE NOMBRE
							$idunico = time();
										
							$nombre_archivo = $idunico."_".$nombre_archivo;
										
										
					}
								
								
					if ( move_uploaded_file($_FILES['archivomemo']['tmp_name'], $raiz.'/'.$nom.'/'.$nombre_archivo) ){//3
							//echo "EL ARCHIVO HA SUBIDO AL SERVIDOR CORRECTAMENTE."."\n"; 
										 
										 
							$rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo;
							
					}
					else{ 
						//echo "Error al subir el fichero."; 
						/*print'<script languaje="Javascript">location.href="index.php?controller=sidoju&action=mensajes&nombre=3b&idmensaje=3"</script>';*/
										 
						
						$erro_archivo = 1;
										 
						echo '<script languaje="JavaScript"> 
							
									var id_radi = "'.$idubicacionexpediente.'";
										
									alert("Error al subir el fichero.");
													
									location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
															
								</script>';
					} 
					
					
				}
			
			
			}
			else{
				
					$erro_archivo = 1;
					
					echo '<script languaje="JavaScript"> 
					
								
								var id_radi = "'.$idubicacionexpediente.'";
								
								alert("NO SELECCIONO NINGUN ARCHIVO, EN CARGAR MEMORIAL");
								
								location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
										
							</script>';
				
				
			}
			
			
			//---------------------VALIDAR NOMBRE ARCHIVO----------------------------------------
			
			
											
			/*for($x = 0; $x < strlen($nombre_archivo); $x++) {
											
				$caracter = ord($nombre_archivo[$x]);
												 
				if( 
						//NOTA:
						//SE DEJA DE ESTA FORMA YA QUE ANTES DE LA VALIDACION DE SUBE EL ARCHIVO
						//Y SE CONCATENA CON$idunico = time(); $nombre_archivo = $idunico."_".$nombre_archivo;		
						//QUEDANDO EL NOMBRE DEL ARCHIVO CON ( _ GUION BAJO ) Y ESTE CARACTER ESTA VALIDADO
						//EN EL IF CERRADO COMO CARACTER INVALIDO, IGUAL EL NOMBRE DEL ARCHIVO CAMBIA
						//SEGUN EL TIPO DE SOLICITUD SELECCIONADA																															 
						($caracter >= 32  && $caracter <= 44)   ||
						($caracter >= 47  && $caracter <= 47)   || 
						($caracter >= 58  && $caracter <= 64)   || 
						($caracter >= 91  && $caracter <= 94)   || 
						($caracter >= 96  && $caracter <= 96)   ||
						($caracter >= 123 && $caracter <= 254) 
						
						//($caracter >= 32  && $caracter <= 45)  ||
						//($caracter >= 47  && $caracter <= 47)  || 
						//($caracter >= 58  && $caracter <= 64)  || 
						//($caracter >= 91  && $caracter <= 96)  || 
						//($caracter >= 123 && $caracter <= 254)
																					 
				) {
														
						//echo "CARACTER NO VALIDO EN NOMBRE DE ARCHIVO:".$nombre_archivo[$x]."<br>"."<br>"." SOLO SE PERMITE EL CARACTER RAYA AL MEDIO (-) Y NOMBRES CONFORMADOS POR LETRAS, NUMEROS Y TODO PEGADO";
														
						$x = strlen($nombre_archivo);
														
						$erro_archivo = 1;
												
						$idcaracter = chr($caracter);
														
						echo '<script languaje="JavaScript"> 
									
									var nombre_archivoX = "'.$nombre_archivo.'";
																	
									var idcaracter      = "'.$idcaracter.'";
																	
																	
									alert("CARACTER NO VALIDO EN NOMBRE DE ARCHIVO: "+nombre_archivoX+" CARACTER: "+idcaracter+" SOLO NOMBRES CONFORMADOS POR LETRAS O NUMEROS Y TODO PEGADO");
																	
																	
									var id_radi = "'.$idubicacionexpediente.'";
																	
									location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
																						
																
								</script>';
														
												
				}
												
												
												
			}*/
			
			
			
			
			//---------------------FIN VALIDAR NOMBRE ARCHIVO------------------------------------
			
			
			//---------------------VALIDAR RENOMBRAR-NOMBRE ARCHIVO 15 DE ABRIL 2021----------------------------------------
			
			
			//DOCUMENTOS CARGADOS EN expe_digital 
			$cantidad_documentos      = $modelo->get_cantidad_documentos(trim($_POST['cuaderno']),$idubicacionexpediente);
			$filadoc                  = $cantidad_documentos->fetch();
			$cantidad_doc             = $filadoc[numero];
			
			//SI TIENE CARGADOS, Y SEGUN EL CUEADERNO SELECCIONADO
			//SE TRAE EL NUMERO SIGUIENTE DE LA COLUMNA orden_documento TABLA expe_digital 
			//PARA CONCATER CON EL NOMBRE DEL ARCHIVO QUE SE ESTA SUBIENDO
			//EJEMPLO: 01CONSTANCIAS.pdf
			if($cantidad_doc >= 1){
													
				$datos_orden_documento    = $modelo->get_orden_documento_siguente(trim($_POST['cuaderno']),$idubicacionexpediente);
				$filaod                   = $datos_orden_documento->fetch();
				$orden_documento_siguente = $filaod[orden_documento_siguente];
				
				$orden_documento          = $orden_documento_siguente;
														
			}
			//SI NO TIENE CARGADOS, SERIA EL PRIMERO,
			//INDEPENDIENTE DEL CUADERNO QUE SE SELECCIONE
			else{
														
				$orden_documento_siguente = 1;
				
				$orden_documento          = $orden_documento_siguente;
			}
			
			if($orden_documento_siguente >= 1 && $orden_documento_siguente <= 9){												
		
				$orden_documento_siguente = "0".$orden_documento_siguente;
			}
			
			$nombre_archivo_tipo = explode(".",$nombre_archivo);
			
			$nombre_archivo_solicitud = date('ymdhis').'-'.$orden_documento_siguente.$nombre_archivo_solicitud.".".$nombre_archivo_tipo[1];
			
			if ( rename($rutaarchivo, $raiz.'/'.$nom.'/'.$nombre_archivo_solicitud) ) {
            
            	//echo ("El archivo ".$rutaArchivo1." se ha renombrado a ".$rutaArchivo2);
				
				$rutaarchivo = $raiz.'/'.$nom.'/'.$nombre_archivo_solicitud;

			} 
			else{
			
				$erro_archivo = 1;
				
				//echo ("El archivo ".$rutaArchivo1." no se ha renombrado correctamente");
				
				echo '<script languaje="JavaScript"> 
							
						var id_radi = "'.$idubicacionexpediente.'";
										
						alert("Error al Renombrar el Archivo.");
													
						location.href="index.php?controller=archivo&action=adicionar_memorial&nombre="+id_radi;
															
					</script>';
			}
			
			
			//---------------------FIN VALIDAR RENOMBRAR-NOMBRE ARCHIVO-----------------------------------------------------
			
			
			if($erro_archivo == 0){
			
					$ruta_local = $rutaarchivo;
				
					$registrar = $this->db->prepare("INSERT INTO correspondencia (fecha_registro,radicado,peticionario,tipo_documento,idjuzgado,
													 fecha_entrega,idjuzgadodestino,idsolicitud,idusuario,folios,generado,existe,idubicacionexpediente,
													 observacionesm,ruta_local,fecha_creacion)
													 VALUES ('$fecha','$radicado','$peticionario', '$tipo_documento','$juzgado','$fecha','$juzgadodestino',
													 '$solicitud','$recibe','$folios','$generado','$existes','$idubicacionexpediente',
													 '$observacionesm','$ruta_local','$fecha_crem')");
													 
					 
					
					  $registrar->execute(); 
					  $resultado = $registrar->rowCount();
					  
					  
					//SE REFIERE AL TIPO DE SOLICITUD (SOLICITUD OFICIOS)
					//Y NO SE ADICIONA AL EXPEDIENTE DIGITAL
					//ADICIONADO EL 24 DE AGOSTO2020
				  	//if($solicitud != 118){
					  
					 //-------------------SE REGISTRA LA TABLA expe_digital Y ALIMENTAR EL EXPEDIENTE DIGITAL DESDE EL AREA DE MEMORIALES-----------------
						 
						 $last_id_memo = $this->db->lastInsertId();
						 
						 
						 //SE VERIFICA QUE EXISTA INFORMACIONE EN LA TABLA expe_digital, PARA ADICIONAR EL MEMORIAL
						 $numero_doc = $this->db->prepare("SELECT COUNT(id) AS numero FROM expe_digital
				 										   WHERE idradicado = '$idubicacionexpediente'");
				
					  	 $numero_doc->execute(); 
						 $doc_cant     = $numero_doc->fetch();
						 $numero_doc_2 = $doc_cant[numero];
					  	 //$numero_doc_2 = $numero_doc->rowCount();
						 
						
						 
						 if($numero_doc_2 >= 1){
						 
						 
						 
							 //$last_id_memo = $this->db->lastInsertId();
							 
							 
							 
							 //-----------ARMAR DIRECTORIO RADICADO--------------
			
							//EJ: 17001400300220140017100 ---> 220140017100
							//EJ: 17001400301220140017100 ---> 1220140017100
							
							$valorradicado = $radicado;
							
							$cadena_juzgado;
							$valorradicado_8 = substr($valorradicado, 10, 2);
							$J;
							// Recorremos cada carácter de la cadena
							for($i=0; $i<strlen($valorradicado_8); $i++){
								
								if($valorradicado_8[0] == 0){
									
									$cadena_juzgado = substr($valorradicado, 11, 13);
									
									$i = strlen($valorradicado_8);
									
									$J = "J".substr($valorradicado, 11, 1);
								}
								
								if($valorradicado_8[0] == 1){
									
									$cadena_juzgado = substr($valorradicado, 10, 13);
									
									$i = strlen($valorradicado_8);
									
									$J = "J".substr($valorradicado, 10, 2);
								}
								
								
							}
							
							$nom_2 = trim($J."/".$cadena_juzgado);
							
							//-----------FIN ARMAR DIRECTORIO RADICADO---------
							 
							 
							 
				
							//SE REALIZA OPERACION SI EL EXPEDIENTE ESTA DIGITALIZADO
							$digital       = trim($_POST['digital']);
							$cuaderno      = trim($_POST['cuaderno']);
							$a_despacho    = trim($_POST['a_despacho']);
							$text_lista_ts = trim($_POST['text_lista_ts']);
										
							if($digital == 1){
							
							
								$error_2 = $_FILES['archivomemo']['error'];
								
									  
								if( !empty( $_FILES['archivomemo']['name'] ) ){
								
										
									//AQUI SE CREA EL DIRECTORIO
									$raiz_2 = "EXPEDIENTE_DIGITAL_2";
												
									//$dir_idradi = $raiz_2.'/' .$idubicacionexpediente;
									$dir_idradi = $raiz_2.'/'.$nom_2;
									if(is_dir($dir_idradi)){$bandera=0;}
									else{mkdir($dir_idradi, 0, true);}
																
												
									//$foto = date('ymdhis') . '-' . $_FILES['archivomemo']['name'];
									$foto = $nombre_archivo_solicitud;
									$tipo = $_FILES['archivomemo']['type'];
									$ruta = $dir_idradi.'/'.$foto;
												
									
									//SE CAMBIA POR COPY, YA QUE AL USAR NUEVAMENTE move_uploaded_file SE PRESENTA INCONSISTENCIA
									//if ( move_uploaded_file($_FILES['archivomemo']['tmp_name'], utf8_decode($ruta)) ){
									if ( copy($rutaarchivo, utf8_decode($ruta)) ){
									
									
										$erro_archivo = 0;
										
										/*echo '<script languaje="JavaScript"> 
														
												var ruta = "'.$ruta.'";
																	
												alert("1.OK al subir el fichero: "+ruta);
																				
																						
											</script>';*/
														
														
														
									}
									else{ 
									
										$erro_archivo = 1;
										
										 
										echo '<script languaje="JavaScript"> 
														
													var ruta = "'.$ruta.'";
													
													var error_2 = "'.$error_2.'";
													
				
													alert("2.Error al subir el fichero: "+ruta+" ERROR: "+error_2);
																				
																						
												</script>';
									}
												
																
									if($erro_archivo == 0){
											
										$idradicado = $idubicacionexpediente;
										$fecha_2    = $modelo->get_fecha_actual_amd();
										$hora_2     = $modelo->get_hora_actual_24horas();
										$des        = $observacionesm;
										
										
										
										//---------------------------------------------------------------------------------------------------------------------------- 
										
										//SE INCORPORA MEMORIAL AL PROCESO DESDE SU REGISTRO
										//ADICIONADO EL 8 DE SEPTIEMBRE DE 2020
										$this->db->exec("UPDATE correspondencia SET 
							
															 incorporaexpediente  = 1,
															 fecha_incorpora      = '$fecha_2'
															
														 WHERE id = '$last_id_memo'");
														 
														 
										
										/*$notaexp = "SE AGREGA MEMORIAL AL EXPEDIENTE, ID MEMORIAL.: ".$last_id_memo; 	 
										
										date_default_timezone_set('America/Bogota'); 
										$fecharegistro_INC = date('Y-m-d g:i');
										$this->db->exec("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,id_memorial,idusuario) 
									     				 VALUES('$idradicado','$fecharegistro_INC','$notaexp','$last_id_memo','$idusuario')");*/				
														 
														 
										
										//--------------------------------------FIN------------------------------------------------------------------------------------ 
										
										
										//OBSERVACION tipo documento + tipo de solicitud
										date_default_timezone_set('America/Bogota'); 
										$fecharegistro = date('Y-m-d g:i');
										
										$obs_M = $tipo_documento." - ".$text_lista_ts." - ".$des;
										$this->db->exec("INSERT INTO detalle_correspondencia (idcorrespondencia,fecha,observacion,estadoobs,id_memorial,a_despacho,idusuario) 
														 VALUES('$idradicado','$fecharegistro','$obs_M',0,'$last_id_memo','$a_despacho','$idusuario')"); 
										
										
												
																
										$this->db->exec("INSERT INTO expe_digital (idradicado,fecha,hora,folios,cuaderno,tipo,ruta,des,idusuario,estado,idcorrespondencia,id_dependencia,
										                 fecha_creacion,fecha_de,fecha_a,origen,orden_documento) 
														 VALUES ('$idradicado','$fecha_2','$hora_2','$folios','$cuaderno','$tipo','$ruta','$obs_M','$idusuario',1,'$last_id_memo',18,
														 '$fecha_crem','0000-00-00','0000-00-00',2,'$orden_documento')");
																				 
																
										//OBTENGO EL ULTIMO ID REGISTRADO DEL ULTIMO INSERT EN LA TABLA siepro_audiencia_juzgado
										$last_id_2 = $this->db->lastInsertId();
															
																 
																
										//HISTORIAL
										$actuacion = 'REGISTRO FOLIO(S)';
										$tablas    = 'expe_digital';
										$tipo      = 'RF';
										$this->db->exec("INSERT INTO expe_historial(idda,idusuario,fecha,hora,actuacion,tablas,archivos,tipo,idexpdigi,id_dependencia,
										                 fecha_creacion,fecha_de,fecha_a,origen,orden_documento)
														 VALUES('$idradicado','$idusuario','$fecha_2','$hora_2','$actuacion','$tablas','$ruta','$tipo','$last_id_2',18,
														 '$fecha_crem','0000-00-00','0000-00-00',2,'$orden_documento')");
														 
														 
														 
										
										
																 
											
									}
									
									
									
									
								}
											
															 
									
							} 
							
						
						}
								  
						//---------------FIN SE REGISTRA LA TABLA expe_digital Y ALIMENTAR EL EXPEDIENTE DIGITAL DESDE EL AREA DE MEMORIALES------------------------
					 
					  
					  //}// FIN if($solicitud != 118){
					  
					  
					  
					  date_default_timezone_set('America/Bogota'); 
					  $fechaa=date('Y-m-d g:ia');
				
					  $horaa=explode(' ',$fechaa);
				
					  $fechal=$horaa[0];
					  
					  $hora=$horaa[1]; 
					  
					  $accion='Resgistr&oacute; Documento';
					  $idres = $_SESSION['idUsuario'];
				
					  $detalle=$_SESSION['nombre']." "."Registro un nuevo Documento ".$fechal." "."a las: ".$hora;
					  
					  $tipolog=2;
				
					  $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
														 VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");
				
					  $insertarlog->execute();
					  
					  
				/////////////////////////////////////////////
				$serverName     = "192.168.89.20"; //serverName\instanceName
				$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
				$conn           = sqlsrv_connect( $serverName, $connectionInfo);
				
				
				if( $conn ) { 
				   // echo "Conectado a la Base de Datoss.<br />"; 
				}else{ 
					 echo "NO se puede conectar a la Base de Datoss.<br />"; 
					 die( print_r( sqlsrv_errors(), true)); 
				}
				
				$sql = "
				declare @cad integer 
				
				UPDATE t103dainfoproc SET a103descacts='Recepción Memorial', a103codiacts='30000123', a103codipads='30000123', a103fechdess = GETDATE(), a103anotacts = '$actu'
				WHERE a103llavproc='$radicado';
				
				SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
				
				INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
				A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
				A110RENUTERM) values('$radicado',@cad,'$sin','00','30000123','30000123','Recepción Memorial','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
				'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')
				";
				
				
				
				$params = array();
				$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				$stmt = sqlsrv_query( $conn, $sql , $params, $options );
				
				$row_count = sqlsrv_num_rows( $stmt );
				   
				if ($row_count === false)
				   echo "Error in retrieveing row count.";
				  
				  
				
				$i = 1;
				$j = 1; 
					  
				//echo "cant=".$cantidad_memoriales;
				if ($cantidad_memoriales > 0)
				 {
				 //echo "1";
				  while($i <= $cantidad_memoriales){
				  
					  if($_POST['peticionario'.$i])
					   {
					   //echo "3";
						$vector_memoriales[$j][fecha]           = $_POST['fecha_modif'.$i];
						$vector_memoriales[$j][tipo_documento]  = $_POST['tipo_documento'.$i];
						$vector_memoriales[$j][destino]         = $_POST['juzgadodestino'.$i];
						$vector_memoriales[$j][solicitud]       = $_POST['solicitud'.$i];
						$vector_memoriales[$j][peticionario]    = $_POST['peticionario'.$i]; 
						$vector_memoriales[$j][folios]          = $_POST['folios'.$i];
						$vector_memoriales[$j][usu_recibe]      = $_POST['usu_recibe'.$i];  
						$vector_memoriales[$j][usu_recibe]      = $_POST['usu_recibe'.$i];  
						$vector_memoriales[$j][observacionesm]  = $_POST['observacionesm'.$i];  
						  
						$j = $j+1;
					   
					   }
					   
					   $i = $i+1;  
				 
				  
				  } 
				  
				 }
				//print_r($vector_memoriales);
				$cont_memo = count($vector_memoriales);
				$m = 1;
				
				$serverName     = "192.168.89.20"; //serverName\instanceName
				$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
				$conn           = sqlsrv_connect( $serverName, $connectionInfo);
				
				
				if( $conn ) { 
					//echo "Conectado a la Base de Datoss.<br />"; 
				}else{ 
					 echo "NO se puede conectar a la Base de Datoss.<br />"; 
					 die( print_r( sqlsrv_errors(), true)); 
				}
				
				
				while ($m <= $cont_memo)
				{
					$solicitud1 = explode("-", $vector_memoriales[$m][solicitud]);
					$finsol     = $solicitud1[1];
					$solicitud  = $solicitud1[0];
					$actu       = "Recepción Memorial por " .$finsol;
					
					
					$fecha          = $vector_memoriales[$m][fecha];
					$peticionario   = $vector_memoriales[$m][peticionario];
					$tipo_documento = $vector_memoriales[$m][tipo_documento];
					$juzgadodestino = $vector_memoriales[$m][destino];
					$recibe         = $vector_memoriales[$m][usu_recibe];
					$folios         = $vector_memoriales[$m][folios];
					$observacionesm = $vector_memoriales[$m][observacionesm];
					
					
					$registrar = $this->db->prepare("INSERT INTO correspondencia (fecha_registro,radicado,peticionario,tipo_documento,idjuzgado,fecha_entrega,idjuzgadodestino,idsolicitud,idusuario,folios,generado,existe,idubicacionexpediente,observacionesm)
													 values ('$fecha','$radicado','$peticionario', '$tipo_documento','$juzgado','$fecha','$juzgadodestino','$solicitud','$recibe','$folios','$generado','$existes','$idubicacionexpediente','$observacionesm')");
					$registrar->execute();
					
					$sql = "
					declare @cad integer 
					
					UPDATE t103dainfoproc SET a103descacts='Recepción Memorial', a103codiacts='30000123', a103codipads='30000123', a103fechdess = GETDATE(), a103anotacts = '$actu'
					WHERE a103llavproc='$radicado';
					
					SELECT @cad =MAX(A110CONSACTU)+1 FROM T110DRACTUPROC where a110Llavproc='$radicado' 
					
					INSERT INTO T110DRACTUPROC(A110LLAVPROC,A110CONSACTU,A110NUMEPROC,A110CONSPROC,A110CODIACTU,A110CODIPADR,A110DESCACTU,A110LEGAJUDI,A110FLAGTERM,A110TIPOTERM,A110NUMDTERM,A110FECHINIC,
					A110FECHFINA,A110FECHREGI,A110FOLIPROC,A110CUADPROC,A110CODIPROV,A110NUMEPROV,A110FECHPROV,A110ANOTACTU,A110FECHOFIC,A110NUMEOFIC,A110FLAGUBIC,A110TIPOACTU,A110FECHDESA,A110BORRTERM,
					A110RENUTERM) values('$radicado',@cad,'$sin','00','30000123','30000123','Recepción Memorial','N','NO','N',0,NULL,NULL,GETDATE(),NULL,NULL,NULL,NULL,NULL,
					'$actu',NULL,NULL,'S','D',GETDATE(),'NO','NO')
					";
					
					
					
					$params = array();
					$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
					$stmt = sqlsrv_query( $conn, $sql , $params, $options );
					
					$row_count = sqlsrv_num_rows( $stmt );
					   
					if ($row_count === false)
					   echo "Error in retrieveing row count.";
					
					
					$m++;
				}
				
				 
				print'<script languaje="Javascript">location.href="index.php?controller=correspondencia&action=mensajes&nombre=3"</script>';
				
				
			}//FIN iF()
				
			
		}//FIN ELSE 1	
		
		}//FIN ELSE A	
   

  }
  
//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------
public function asignar_numero_guia_NG(){
	
		
		set_time_limit (240000000);
		
		$modelo     = new correspondenciaModel();
		
		$idusuario  = $_SESSION['idUsuario'];
	
		$carpeta    = "CARGAMASIVA";
		
		$error_transaccion   = 0; //variable para detectar error
		
		//$fechacarga = trim($_POST['fechae_2']);
		
		//FECHA DE CARGA AL SISTEMA DEL PROCESO
      	//$fechacarga_2 = date("Y-m-d"); 
		
		//setlocale(LC_TIME, "Spanish");
		//$fechavisual = strtoupper( strftime('%d %B de %Y', strtotime($fechacarga)) ); 
		
		//--------------------------PARA LA TABLA LOG------------------------------------------------
		
		/*$fechahora  = $modelo->get_fecha_actual();
		$datosfecha = explode(" ",$fechahora);
		$fechalog   = $datosfecha[0];
		$horalog    = $datosfecha[1];
			
		
		$tiporegistro = "PROCESOS DE ".$fechavisual." MASIVO";
		$accion       = "Registra ".$tiporegistro." En el Sistema (SIEPRO)";
		$detalle      = $_SESSION['nombre']." ".$accion." ".$fechalog." "."a las: ".$horalog;
		$tipolog      = 1;*/
		
		//--------------------------------------------------------------------------------------------
		
		//$tipoarchivo = trim($_POST['tipoarchivo']);
		
		//CREO EL DIRECTORIO DEL USUARIO QUE NO ES MAS QUE ES CON EL QUE SE LOGEA EL USUARIO  
		//$nom = "jvalenciao";
		$nom = trim($_SESSION['idUsuario']);
		
	
		//AQUI SE CREA EL DIRECTORIO
		if(is_dir($carpeta."/".$nom)){$bandera=0;}
		else{mkdir($carpeta."/".$nom, 0, true);}
		
		//datos del arhivo 
		$nombre_archivo = $_FILES['archivo']['name']; 
		$tipo_archivo   = $_FILES['archivo']['type'];
		//echo $tipo_archivo;
		$tamano_archivo = $_FILES['archivo']['size']; 
		
		
		if (! (strpos($tipo_archivo, "vnd.ms-excel")) && ($tamano_archivo < 100000000) )  { 
			
			//echo "EXTENSION"."**********";
			
			echo '<script languaje="JavaScript"> 
			
	
				alert("LA EXTENSION O LA LONGITUD DEL ARCHIVO NO ES CORRECTA");
				
				location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";
						
			</script>';
			
			
		}
		else{//1 
		
			
			
			if ( file_exists($carpeta."/".$nom.'/'.$nombre_archivo) ) {
				
			
				$idunico = time();
					
				$nombre_archivo = $idunico."_".$nombre_archivo;
				
				
			}
			
			
			if ( move_uploaded_file($_FILES['archivo']['tmp_name'], $carpeta."/".$nom.'/'.$nombre_archivo) ){
			
				$lineas = file( $carpeta."/".$nom.'/'.$nombre_archivo,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				$long   = count($lineas);
				

				//OBETNER SEPARAR DE LOS REGISTROS YA QUE EN UNOS EQUIPOS DE COMPUTO ES ---> COMA(,)
				//Y EN OTROS ---> PUNTO Y COMA (;)
				//$separador = $modelo->Obtener_Separador( trim($lineas[1]) );
				
				

				try {  
					
						$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						//EMPIEZA LA TRANSACCION
						$this->db->beginTransaction();
						
						
								/*$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) 
												 VALUES ('$fechalog', '$accion','$detalle','$idusuario','$tipolog')");*/
								
								
								//ASI CUANDO EL ARCHIVO NO TIENE ENCABEZADOS
								$i=1;//PARA NO TOMAR LOS ENCABEZADOS
								$bandera_guia = 0;
								
								while($i < $long){
									
									//echo $lineas[$i]."\n";
									
									//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR COMAS
									$fila = explode(",",$lineas[$i]);
									
									//ASI CUANDO EL ARCHIVO ESTA SEPARADO POR PUNTO Y COMA
									//$fila = explode(";",$lineas[$i]);
									
									//$fila = explode($separador,$lineas[$i]);
									
		
									$nunguia             = trim($fila[1]);
									//$nombre_destinatario = utf8_encode(trim($fila[2]));
									$nombre_destinatario = trim($fila[2]);
									
									//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 11 DE FEBRERO 2020, JORGE ANDRES VALENCIA-------
									$findme = "/";
									$pos    = strpos($nombre_destinatario, $findme);
									
									if ($pos === false) {
									
										//echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
										
										$iaux = $i;
										$i    = $long;
										
										/*echo '<script languaje="JavaScript"> 
			
													var fila_pos = "'.$iaux.'";
													
													alert("LA POSICION 2 DE LA FILA "+fila_pos+" NO CUENTA CON EL PARAMETRO --> / NO ES POSIBLE PROCESAR EL ARCHIVO");
													
													location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";
														
											</script>';*/
											
										
										$i = $long;
										
										$error_transaccion = 1;
										
									} 
									//-------FIN-------
									
									
									//EJEMPLOS:
									//FABIOLA BEDOYA DE RIVERA 17001400300220160062400/OECM19-1378/O-3105
									//JULIO CESAR ROJAS PADILLA Represenante Legal Judicial MEDIMAS EPS 17001430300220190001600/820 Y ANEXOS/T-16833
									$nombre_destinatario_1 = explode("/",$nombre_destinatario);
									//ULTIMA POSICION DEL VECTOR EJEMPLO T-16833
									$oficio_telegrama      = end($nombre_destinatario_1);
									
									$pe2                   = explode("-",$oficio_telegrama);
									
									
									//O-3104 ó T-16833
									//POR ESO SE APLICA if($x != 0),
									//YA QUE LA $pe2[0] ME IDENTIFICA 
									//EN QUE TABLA DE CORRESPONDENCIA SE DEBE GRABAR
									$x = 0;
									while($x < count($pe2)){
									
										if($x != 0){
									
											$id_oficio_telegrama = $pe2[$x];
											
											//TABLA correspondencia_otros
											if( trim($pe2[0]) == "O" ){
											
												$this->db->exec("UPDATE correspondencia_otros SET nunguia = '$nunguia'
																 WHERE id = '$id_oficio_telegrama'");
											}
											
											//TABLA actuacion_tutela
											if( trim($pe2[0]) == "T" ){
											
												$this->db->exec("UPDATE actuacion_tutela SET nunguia = '$nunguia'
																 WHERE id = '$id_oficio_telegrama'");
											}
											
										}
										
										
											
										
										$x = $x + 1;
										
									
									}	
										
									/*$this->db->exec("UPDATE actuacion_tutela SET nunguia = '$nunguia'
													 WHERE oficio_telegrama = '$oficio_telegrama'");*/
														 
										
											
			
									$i= $i + 1;
																 
								}//FIN WHILE while($i < $long){		
								
							
							//-------NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 11 DE FEBRERO 2020, JORGE ANDRES VALENCIA-------
							
							if($error_transaccion) {
							
								//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
								$this->db->rollBack();
							
								//echo "Fallo: " . $e->getMessage();
								
								
								echo '<script languaje="JavaScript"> 
							
										var fila_pos = "'.$iaux.'";
													
										alert("LA POSICION 2 DE LA FILA "+fila_pos+" NO CUENTA CON EL PARAMETRO --> / NO ES POSIBLE PROCESAR EL ARCHIVO");
					
										location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";
										
									</script>';
										
							}
							else{	
							
								//SE TERMINA LA TRANSACCION  
								$this->db->commit();
										
						
								echo '<script languaje="JavaScript"> 
								
									
										alert("PROCESO SE REALIZA CORRECTAMENTE");
									
										location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";
											
									</script>';
							}
							
							//-------FIN-------
								
						
						
				}
				catch (Exception $e) {
			
					//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
					$this->db->rollBack();
				
					//echo "Fallo: " . $e->getMessage();
					
					
					echo '<script languaje="JavaScript"> 
				
							
							var ERROR = "'.$e->getMessage()." REGISTROS ARCHIVO: ".$long.'";
		
							alert("ERROR 2: "+ERROR);
					
							location.href="index.php?controller=correspondencia&action=Asignar_Numero_Guia";
							
						</script>';
			
					
				}		
						
						
				
				
			}
			
				
			
		
		}//FIN ELSE 1
			
		

}//FIN FUNCION  

public function get_fecha_actual_amd(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
}

//HORA MILITAR
public function get_hora_actual_24horas(){
	
		date_default_timezone_set('America/Bogota'); 
		//$horaregistro=date('H:i:s'); 
		$horaregistro = date('H:i');
		
		/*$hora         = date('H');
		
		//REALIZO ESTA PREGUNTA PARA COGER EL RANGO DE HORA
		//DE 01:00 AM - 09:00 AM Y QUITARLES EL CERO INICIAL
		//YA QUE PARA GENERAR EL REPORTE EN VERIFICAR DOCUMENTOS ENTRANTES JUZGADOS
		//EN LA BASE DE DATOS REALIZA ESTE FILTRO SIN ESTE CERO INCIAL
		if($hora >= 1 && $hora <= 9){
			$horaregistro = substr($horaregistro, -4);    // Ej: 08:54 devuelve 8:54
		}*/
		
		return $horaregistro; 
}
	
//-------FIN NUEVO PARA ASIGNAR NUMERO DE GUIA, ADICIONADO 6 DE JUNIO 2019, JORGE ANDRES VALENCIA-------


	//ADICIONADO EL 19 DE ABRIL 2021
	public function get_orden_documento_siguente($idcuaderno,$idradicado){
	
		
		$listar = $this->db->prepare("SELECT MAX(orden_documento + 1) AS orden_documento_siguente
									  FROM expe_digital
									  WHERE cuaderno = '$idcuaderno' AND idradicado = '$idradicado' AND estado = 1");
								
		$listar->execute();
									
		return $listar;							
		
	}
	
	public function get_cantidad_documentos($idcuaderno,$idradicado){
	
		
		$listar = $this->db->prepare("SELECT COUNT(id) AS numero FROM expe_digital
				 					  WHERE cuaderno = '$idcuaderno' AND idradicado = '$idradicado' AND estado = 1");
								
		$listar->execute();
									
		return $listar;							
		
	}
	
	public function get_nuevo_nombre($nombre_archivoX,$orden_documento_siguente){
	
		
		$bandera_fecha    = 0;
	
		$nombre_archivo       = explode(".",$nombre_archivoX);
		$nombre_archivo_2     = $nombre_archivo[0];
		$nuevo_nombre_archivo = $nombre_archivo_2;
		
		
		//CARGAMOS VECTOR $letras
		$letras                 = array();
		$nuevo_nombre_archivo_2 = "";
		$bandera_numero         = 0;
		
		for($x = 0; $x < strlen($nuevo_nombre_archivo); $x++){
		
			$letras[$x] = $nuevo_nombre_archivo[$x];
		}
		
		//IMPRIME VECTOR
		/*var_dump($letras);
		echo "<br>";
		echo count($letras);
		echo "<br>";
		echo $letras[46];
		echo "<br>";
		$caracter = ord($letras[46]);
		echo $caracter;*/
		
		$long_letras = count($letras);
		//RECORREMOS VECTOR $letras Y BUSCAMOS POSICIONES NUMERO
		//HASTA QUE SE ENCUENTRE UN CARACTER LETRA DIFERENTE A NUMERO
		//Y ELIMINAMOS DEL VECTOR $letras LOS NUMEROS ENCONTRADOS ANTES DE 
		//ENCONTRAR UNA LETRA
		for($x = 0; $x < $long_letras; $x++) {
		
			$caracter = ord($letras[$x]);
			
			//ASCCI NUMEROS 0 - 9 (48 - 57) y RAYA AL MEDIO - (45)										 
			if( ($caracter >= 48 && $caracter <= 57) || $caracter == 45 ){
															
				$bandera_numero = 0;
				//ELIMINAMOS POSICION
				unset($letras[$x]);
				
			}
			else{
	
				//PARAMOS EL FOR
				//$x = count($letras);
				$x = $long_letras;
			
			}
			
		
		}
		
		//El elemento «210409112903» se elimina, pero la posición que tenía se mantiene. Si imprimimos el array el resultado será
		//Posición 0 = null
		//Posición 1 = xxx
		//Posición 2 = xxx
		//Por eso aplicamos array_values
		//Para reordenar las posiciones, el resultado será
		//Posición 0 = xxx
		//Posición 1 = xxx
		$letras = array_values($letras);
		
		//RECORREMOS EL VECTOR $letras Y CONSTRUIMOS EL NOMBRE DEL ARCHIVO NUEVO
		//EN LA VARIABLE $nuevo_nombre_archivo_2
		for($x = 0; $x < count($letras); $x++) {
		
		
			$nuevo_nombre_archivo_2 .= $letras[$x];
		
		}
		
		if($orden_documento_siguente >= 1 && $orden_documento_siguente <= 9){												
		
			$nuevo_nombre_archivoX = "0".$orden_documento_siguente.$nuevo_nombre_archivo_2;
		}
		else{
		
			$nuevo_nombre_archivoX = $orden_documento_siguente.$nuevo_nombre_archivo_2;
		}
													
		return trim($nuevo_nombre_archivoX);
		
	
	}
	
	public function get_nuevo_nombre_2ANTERIOR($nombre_archivoX,$orden_documento_siguente){
	
	
		$caracterY  = 0;
		$caracterM  = 0;
		$caracterD  = 0;
		$caracterH  = 0;
		$caracterMI = 0;
		$caracterS  = 0;
		
	
		$bandera_fecha    = 0;
		
		$nombre_archivo   = explode(".",$nombre_archivoX);
		//NOMBRE ARCHIVO SI EXTENSION
		//EJ: 200911121732-01-201900151OrdenaAOECMNotificarADemandado-Decreto720210036900
		$nombre_archivo_2 = $nombre_archivo[0];
		//SE DIVIDE EL ARCHIVO POR CARACTER "-"
		//EJ: 200911121732	01	201900151OrdenaAOECMNotificarADemandado	Decreto720210036900
		$nombre_archivo_3 = explode("-",$nombre_archivo_2);
		
		$nuevo_nombre_archivo = "";
		
		//QUITAMOS DEL NOMBRE DEL ARCHIVO EL IDENTIFICADOR ymdhis-XYZ ---> 210422023359-07CONSTANCIA120160040500.pdf
		for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
			//echo $nombre_archivo_3[$x]."<br>"."<br>";
			
			$idcaracter = $nombre_archivo_3[$x];
			
			if( strlen($idcaracter) == 12 ){
		
				for($y = 0; $y < strlen($idcaracter); $y = $y + 2) {
					
					$caracterX = $idcaracter[$y].$idcaracter[$y + 1];
					
					//YEAR
					if($y == 0){
					
					
						if($caracterX >= 20){
							
							$caracterY  = 1;
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MES
					if($y == 2){
					
						if($caracterX >= 0 && $caracterX <= 12){
							
							$caracterM  = 1;	
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//DIA
					if($y == 4){
					
						if($caracterX >= 0 && $caracterX <= 31){
							
							$caracterD  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//HORA
					if($y == 6){
					
						if($caracterX >= 0 && $caracterX <= 12){
							
							$caracterH  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MINUTOS
					if($y == 8){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterMI  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//SEGUNDOS
					if($y == 10){
					
						if($caracterX >= 0 && $caracterX <= 59){
							
							$caracterS  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					
					
				}
				
				//ES IDENTIFICAR DEL FORMATO date('ymdhis')
				if($caracterY == 1 && $caracterM == 1 && $caracterD == 1 && $caracterH == 1 && $caracterMI == 1 && $caracterS == 1) {
					 
					 $bandera_fecha = 1;
				} 
				else{
				
					 $nuevo_nombre_archivo .= $idcaracter;
				}
	
			
			}//FIN if( strlen($nombre_archivo_3[$x]) == 12 ){
			else{
			
				$nuevo_nombre_archivo .= $idcaracter;
			}
			
			
			$caracterY  = 0;
			$caracterM  = 0;
			$caracterD  = 0;
			$caracterH  = 0;
			$caracterMI = 0;
			$caracterS  = 0;
			
		}//FOR PRINCIPAL for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
		
		//CARGAMOS VECTOR $letras
		$letras                 = array();
		$nuevo_nombre_archivo_2 = "";
		$bandera_numero         = 0;
		
		for($x = 0; $x < strlen($nuevo_nombre_archivo); $x++){
		
			$letras[$x] = $nuevo_nombre_archivo[$x];
		}
		
		//IMPRIME VECTOR
		//var_dump($letras);
		
		$long_letras = count($letras);
		//RECORREMOS VECTOR $letras Y BUSCAMOS POSICIONES NUMERO
		//HASTA QUE SE ENCUENTRE UN CARACTER LETRA DIFERENTE A NUMERO
		//Y ELIMINAMOS DEL VECTOR $letras LOS NUMEROS ENCONTRADOS ANTES DE 
		//ENCONTRAR UNA LETRA
		for($x = 0; $x < $long_letras; $x++) {
		
			$caracter = ord($letras[$x]);
			
			//ASCCI NUMEROS 0 - 9										 
			if($caracter >= 48 && $caracter <= 57){
															
				$bandera_numero = 0;
				//ELIMINAMOS POSICION
				unset($letras[$x]);
			}
			else{
	
				//PARAMOS EL FOR
				//$x = count($letras);
				$x = $long_letras;
			
			}
			
		
		}
		
		//El elemento «210409112903» se elimina, pero la posición que tenía se mantiene. Si imprimimos el array el resultado será
		//Posición 0 = null
		//Posición 1 = xxx
		//Posición 2 = xxx
		//Por eso aplicamos array_values
		//Para reordenar las posiciones, el resultado será
		//Posición 0 = xxx
		//Posición 1 = xxx
		$letras = array_values($letras);
		
		//RECORREMOS EL VECTOR $letras Y CONSTRUIMOS EL NOMBRE DEL ARCHIVO NUEVO
		//EN LA VARIABLE $nuevo_nombre_archivo_2
		for($x = 0; $x < count($letras); $x++) {
		
		
			$nuevo_nombre_archivo_2 .= $letras[$x];
		
		}
		
		
		if($orden_documento_siguente >= 1 && $orden_documento_siguente <= 9){												
		
			$nuevo_nombre_archivoX = "0".$orden_documento_siguente.$nuevo_nombre_archivo_2;
		}
		else{
		
			$nuevo_nombre_archivoX = $orden_documento_siguente.$nuevo_nombre_archivo_2;
		}
													
		return trim($nuevo_nombre_archivoX);
									
		
	}
	
	//NO SE LE CONCATENA orden_documento_siguente YA QUE ESTE YA LO TRAE EL ARCHIVO
	/*
	if($orden_documento_siguente >= 1 && $orden_documento_siguente <= 9){												
		
		$nuevo_nombre_archivo = "0".$orden_documento_siguente.$nuevo_nombre_archivo;
	}
	else{
		$nuevo_nombre_archivo = $orden_documento_siguente.$nuevo_nombre_archivo;
	}
	*/
	public function get_nuevo_nombreVISUAL($nombre_archivoX,$orden_documento_siguente){
	
	
		$caracterY  = 0;
		$caracterM  = 0;
		$caracterD  = 0;
		$caracterH  = 0;
		$caracterMI = 0;
		$caracterS  = 0;
		
	
		$bandera_fecha    = 0;
		
		$nombre_archivo   = explode(".",$nombre_archivoX);
		//NOMBRE ARCHIVO SI EXTENSION
		//EJ: 200911121732-01-201900151OrdenaAOECMNotificarADemandado-Decreto720210036900
		$nombre_archivo_2 = $nombre_archivo[0];
		//SE DIVIDE EL ARCHIVO POR CARACTER "-"
		//EJ: 200911121732	01	201900151OrdenaAOECMNotificarADemandado	Decreto720210036900
		$nombre_archivo_3 = explode("-",$nombre_archivo_2);
		
		$nuevo_nombre_archivo = "";
		
		for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
			//echo $nombre_archivo_3[$x]."<br>"."<br>";
			
			$idcaracter = $nombre_archivo_3[$x];
			
			if( strlen($idcaracter) == 12 ){
		
				for($y = 0; $y < strlen($idcaracter); $y = $y + 2) {
					
					$caracterX = $idcaracter[$y].$idcaracter[$y + 1];
					
					//YEAR
					if($y == 0){
					
					
						if($caracterX >= 20){
							
							$caracterY  = 1;
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MES
					if($y == 2){
					
						if($caracterX >= 1 && $caracterX <= 12){
							
							$caracterM  = 1;	
						}
					
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//DIA
					if($y == 4){
					
						if($caracterX >= 1 && $caracterX <= 31){
							
							$caracterD  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//HORA
					if($y == 6){
					
						if($caracterX >= 1 && $caracterX <= 12){
							
							$caracterH  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//MINUTOS
					if($y == 8){
					
						if($caracterX >= 1 && $caracterX <= 59){
							
							$caracterMI  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					//SEGUNDOS
					if($y == 10){
					
						if($caracterX >= 1 && $caracterX <= 59){
							
							$caracterS  = 1;	
						}
						
						//echo $idcaracter[$y].$idcaracter[$y + 1]."<br>"."<br>";
					}
					
					
				}
				
				//ES IDENTIFICAR DEL FORMATO date('ymdhis')
				if($caracterY == 1 && $caracterM == 1 && $caracterD == 1 && $caracterH == 1 && $caracterMI == 1 && $caracterS == 1) {
					 
					 $bandera_fecha = 1;
				} 
				else{
				
					 $nuevo_nombre_archivo .= $idcaracter;
				}
	
			
			}//FIN if( strlen($nombre_archivo_3[$x]) == 12 ){
			else{
			
				$nuevo_nombre_archivo .= $idcaracter;
			}
			
			$caracterY  = 0;
			$caracterM  = 0;
			$caracterD  = 0;
			$caracterH  = 0;
			$caracterMI = 0;
			$caracterS  = 0;
			
			
		}//FOR PRINCIPAL for($x = 0; $x < count($nombre_archivo_3); $x++) {
		
		
							
		return trim($nuevo_nombre_archivo);
									
		
	}
	
	public function get_nuevo_nombreANTERIOR($nombre_archivoX,$orden_documento_siguente){
	
		
		$nombre_archivo   = explode(".",$nombre_archivoX);
		$nombre_archivo_2 = $nombre_archivo[0];
		
		$nuevo_nombre_archivo = "";
													
		for($x = 0; $x < strlen($nombre_archivo_2); $x++) {
			
			//$caracter >= 65 && $caracter <= 90  MAYUSCULAS
			//$caracter >= 97 && $caracter <= 122 MINUSCULAS
													
			$caracter = ord($nombre_archivo_2[$x]);
														 
			if( 
			
				($caracter >= 65 && $caracter <= 90) || 
				($caracter >= 97 && $caracter <= 122)  
			
					
			) {
																
				$idcaracter            = chr($caracter);
				$nuevo_nombre_archivo .= $idcaracter;
			
														
			}
														
														
		}
		
		if($orden_documento_siguente >= 1 && $orden_documento_siguente <= 9){												
		
			$nuevo_nombre_archivo = "0".$orden_documento_siguente.$nuevo_nombre_archivo;
		}
		else{
			$nuevo_nombre_archivo = $orden_documento_siguente.$nuevo_nombre_archivo;
		}
													
		return trim($nuevo_nombre_archivo);
									
		
	}  
	
	public function get_caracteres_archivo($narchivoX){
	
		$narchivoX_1 = explode(".",$narchivoX);
		$narchivoX_2 = $narchivoX_1[0];
	
		$ncaracteres = strlen($narchivoX_2);
									
		return $ncaracteres;							
		
	}
	
	//NUEVO 24 DE JUNIO 2021
	//EN ESTA FUNCION SE COMPARA ES CON EL RADICADO OBTENIDO DE LA TABLA
	//correspondencia
	public function Expediente_Bloqueado($radi){
	
	
			set_time_limit (240000000);
			
			
			$modelo = new correspondenciaModel();
			
			
			$listar = $this->db->prepare(
										  "SELECT COUNT(id) AS expebloqueado FROM ubicacion_expediente
										   WHERE radiblodes = '$radi' AND bloqueado = 0"
											
										);
										
										
								

  			$listar->execute();

  			return $listar;
	
  	}
	
 
}
?>