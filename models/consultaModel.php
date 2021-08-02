<?php

class consultaModel extends modelBase

{

	

   /***********************************************************************************/

    /*----------------------------- Mensajes ---------------------------------------*/

    /***********************************************************************************/

      public function mensajes()

  {

      $condicion=$_GET['nombre'];
 	  
	  if($condicion==1)

	  {

	    $_SESSION['elemento'] = "La correspondencia ha sido registrada correctamente";

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

	    print'<script languaje="Javascript">location.href="index.php?controller=consulta&action=consultar_ponente"</script>';
	  
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

	    $_SESSION['elemento'] = "La correspondencia no se registro, No Oficio/Telegrama
		ya existe para el juzgado";

	    $_SESSION['elem_conscontrato'] = true;

	     if($_SESSION['id']!="")
		 {

	      print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_correspondencia"</script>';
	     }
  
	   }

 

  }	

     /***********************************************************************************/

  public function listarJuzgado()

  {

  $listar = $this->db->prepare("select * from pa_juzgado");

  $listar->execute();

  return $listar;

  

  }  

  
  /***********************************************************************************/

  /*------------------------------ Listar Log ---------------------------------------*/

  /***********************************************************************************/

  public function listarLogConsulta()

  {

  

	  $listar = $this->db->prepare("SELECT logusuario.fecha,logusuario.accion,logusuario.detalle,usuario.empleado,usuario.foto
FROM LOG AS logusuario
INNER JOIN pa_usuario AS usuario ON (logusuario.idusuario=usuario.id)
WHERE logusuario.idtipolog=3
ORDER BY logusuario.id DESC
LIMIT 15");

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
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     //echo "NO se puede conectar a la Base de Datos.<br />"; 
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

   /***********************************************************************************/

  /*------------------------------ Consultar Justicia  ---------------------------------------*/

  /***********************************************************************************/

  public function consultarjusticia()

  {
$serverName = "192.168.89.20";  
/*
$connectionInfo = array( "Database"=>"consejoPN"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo); */


$cedula     = $_GET['nombre1'];
$nom_ddte   = $_GET['nombre2'];
$nom_ddo    = $_GET['nombre3'];
$cedula_ddo = $_GET['nombre4'];


unset($vector);

$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);



if( $conn ) { 
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

 $sql = "SELECT dbo.T103DAINFOPROC.A103LLAVPROC, dbo.T112DRSUJEPROC.A112NUMESUJE AS [IDDDO], dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NomDDO], 
T112DRSUJEPROC_1.A112NUMESUJE AS [IDDTE], T112DRSUJEPROC_1.A112NOMBSUJE AS [NomDTE], dbo.T103DAINFOPROC.A103DESCACTS AS Actu_Secre,
 dbo.T103DAINFOPROC.A103ANOTACTS AS descr_actu_secre, dbo.T103DAINFOPROC.A103DESCACTD AS actu_despacho, dbo.T103DAINFOPROC.A103ANOTACTD AS desc_actu_desp, 
 dbo.T103DAINFOPROC.A103NOMBPONE
FROM dbo.T103DAINFOPROC
INNER JOIN dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC
INNER JOIN dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC
WHERE ((dbo.T112DRSUJEPROC.A112CODISUJE = '0002') AND (T112DRSUJEPROC_1.A112CODISUJE = '0001') AND (A103ENTIRADI='43' AND A103ESPERADI='03') 
 OR (A103ENTIRADI='40' AND A103ESPERADI='03')) AND (dbo.T112DRSUJEPROC.A112NUMESUJE like '%$cedula%' AND dbo.T112DRSUJEPROC.A112NOMBSUJE like '%$nom_ddte%'
 AND T112DRSUJEPROC_1.A112NOMBSUJE like '%$nom_ddo%' AND T112DRSUJEPROC_1.A112NUMESUJE like '%$cedula_ddo%')
";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
 else
 
    
   

$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	$vector[$i][radicado] = $row['A103LLAVPROC'];
	$vector[$i][cedula_ddo] = $row['IDDDO'];
	$vector[$i][nom_demandado] = $row['NomDDO'];
	$vector[$i][cedula_dte] = $row['IDDTE'];
	$vector[$i][nom_demandante] = $row['NomDTE'];
	$vector[$i][actu_secre] = $row['Actu_Secre'];
	$vector[$i][desc_actu_secre] = $row['descr_actu_secre'];
	$vector[$i][actu_desp] = $row['actu_despacho'];
	$vector[$i][desc_actu_desp] = $row['desc_actu_desp'];
	$vector[$i][ponente] = $row['A103NOMBPONE'];
	
	  
	$i++; 	  
}

	  //print_r($vector);
	  
	  return $vector; 

   

  }
  
  
   /***********************************************************************************/

  /*------------------------------ Consultar Justicia Ponente ---------------------------------------*/

  /***********************************************************************************/

  public function consultarjusticia_ponente()

  {



 $radicado     = $_GET['nombre1'];




/*$serverName = "SAD_AUX9\SQLEXPRESS";  

$connectionInfo = array( "Database"=>"ConsejoPN"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo); */

$serverName     = "192.168.89.20"; 
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn           = sqlsrv_connect( $serverName, $connectionInfo);

/*$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);*/



if( $conn ) { 
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

 $sql = "SELECT     dbo.T103DAINFOPROC.A103LLAVPROC, dbo.T112DRSUJEPROC.A112NUMESUJE AS [IDDDO], dbo.T112DRSUJEPROC.A112NOMBSUJE AS [NomDDO], 
                      T112DRSUJEPROC_1.A112NUMESUJE AS [IDDTE], T112DRSUJEPROC_1.A112NOMBSUJE AS [NomDTE], dbo.T103DAINFOPROC.A103DESCACTS as Actu_Secre, 
                      dbo.T103DAINFOPROC.A103ANOTACTS as descr_actu_secre, dbo.T103DAINFOPROC.A103DESCACTD as actu_despacho, 
					  dbo.T103DAINFOPROC.A103ANOTACTD as desc_actu_desp,dbo.T103DAINFOPROC.A103NOMBPONE as ponente
FROM         dbo.T103DAINFOPROC INNER JOIN
                      dbo.T112DRSUJEPROC ON dbo.T103DAINFOPROC.A103LLAVPROC = dbo.T112DRSUJEPROC.A112LLAVPROC INNER JOIN
                      dbo.T112DRSUJEPROC AS T112DRSUJEPROC_1 ON dbo.T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC_1.A112LLAVPROC
WHERE     (dbo.T112DRSUJEPROC.A112CODISUJE = '0002') AND (T112DRSUJEPROC_1.A112CODISUJE = '0001') AND 
                      (dbo.T103DAINFOPROC.A103LLAVPROC = '$radicado')";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
 else
 
    
   

$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	$vector[$i][radicado] = $row['A103LLAVPROC'];
	$vector[$i][cedula_ddo] = $row['IDDDO'];
	$vector[$i][nom_demandado] = $row['NomDDO'];
	$vector[$i][cedula_dte] = $row['IDDTE'];
	$vector[$i][nom_demandante] = $row['NomDTE'];
	$vector[$i][actu_secre] = $row['Actu_Secre'];
	$vector[$i][desc_actu_secre] = $row['descr_actu_secre'];
	$vector[$i][actu_desp] = $row['actu_despacho'];
	$vector[$i][desc_actu_desp] = $row['desc_actu_desp'];
	$vector[$i][ponente] = $row['ponente'];

	
	
	  
	$i++; 	  
}

	  //print_r($vector);
	  
	  return $vector; 

   

  }  
     /***********************************************************************************/

  /*------------------------------ Actualizar Ponente ---------------------------------------*/

  /***********************************************************************************/

  public function actualizarPonente()

  {



 $radicado     = $_POST['radicado'];
$despacho     = $_POST['despacho'];
$vect = explode("-",$despacho);

$codi_pone = $vect[0];
$nom_pone  = $vect[1];
$codi_enti = $vect[2];
$codi_espe = $vect[3];
$codi_nume = $vect[4];




/*$serverName = "SAD_AUX9\SQLEXPRESS";  

$connectionInfo = array( "Database"=>"ConsejoPN"); 
$conn = sqlsrv_connect( $serverName, $connectionInfo); */

$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);



if( $conn ) { 
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

 $sql = "UPDATE T103DAINFOPROC SET A103ENTIRADI = '$codi_enti', A103ESPERADI = '$codi_espe', A103NUENRADI = '$codi_nume', A103CODIPONE = '$codi_pone', A103NOMBPONE = '$nom_pone' WHERE A103LLAVPROC = '$radicado'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
   
   
   
      date_default_timezone_set('America/Bogota'); 
      $fechaa=date('Y-m-d g:ia');

      $horaa=explode(' ',$fechaa);

      $fechal=$horaa[0];
      
	  $hora=$horaa[1]; 
	  
	  $accion='Cambi&oacute; Ponente';
	  $idres = $_SESSION['idUsuario'];

      $detalle=$_SESSION['nombre']." "."Cambi&oacute; Ponente ".$fechal." "."a las: ".$hora;
	  

	  $tipolog=3;

      $insertarlog = $this->db->prepare("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fechaa', '$accion','$detalle','$idres','$tipolog');");

      $insertarlog->execute();
   
   
 
   print'<script languaje="Javascript">location.href="index.php?controller=consulta&action=mensajes&nombre=2"</script>'; 
   

  }  
    /***********************************************************************************/

  /*------------------------------ Consultar Despachos ---------------------------------------*/

  /***********************************************************************************/

  public function consultar_despachos_ejecucion()

  {


$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);



if( $conn ) { 
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}
 
 $sql = "SELECT 
         A101CODIPONE, A101NOMBPONE, A101CODIENTI, A101CODIESPE, A101CODINUME
		 FROM dbo.T101DAINFOPONE
         WHERE (A101SECRDESP = 'd') AND (A101FLAGHABI = 'SI') AND (A101CODIENTI='40' AND A101CODIESPE='03' OR A101CODIENTI='43' AND A101CODIESPE='03'
		 OR A101CODIENTI='31' AND A101CODIESPE='10' OR A101CODIENTI='31' AND A101CODIESPE='03')
         ORDER BY A101CODIENTI, A101CODIESPE, A101CODINUME, A101NOMBPONE";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
 else
 
    
   

$i=0;

while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	$vector[$i][codi_pone] = $row['A101CODIPONE'];
	$vector[$i][nom_pone] = $row['A101NOMBPONE'];
	$vector[$i][codi_enti] = $row['A101CODIENTI'];
	$vector[$i][codi_espe] = $row['A101CODIESPE'];
	$vector[$i][codi_nume] = $row['A101CODINUME'];
		
	  
	$i++; 	  
}


	 // print_r($vector);
	  
	  return $vector; 

   

  }  
    

   /***********************************************************************************/

  /*------------------------------ Consultar Estados  ---------------------------------------*/

  /***********************************************************************************/

  public function consultarestados()

  {
$serverName = "192.168.89.20";  

//Parametros de generación del reporte

$juzgado 		= $_GET['nombre1'];
$especialidad 	= $_GET['nombre2'];
$corporacion 	= $_GET['nombre3'];
$fecha 			= $_GET['nombre4'];





unset($vector);

$serverName = "192.168.89.20"; //serverName\instanceName
$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"usuariooecm", "PWD"=>"OficinaECM");
$conn = sqlsrv_connect( $serverName, $connectionInfo);



if( $conn ) { 
     //echo "Conectado a la Base de Datos.<br />"; 
}else{ 
     echo "NO se puede conectar a la Base de Datos.<br />"; 
     die( print_r( sqlsrv_errors(), true)); 
}

 echo $sql = "SELECT
    T103DAINFOPROC.A103LLAVPROC as proceso,T053BACLASGENE.A053DESCCLAS as clase,
    T112DRSUJEPROC.A112NOMBSUJE as demandante,
    T112DRSUJEPROC2.A112NOMBSUJE as demandado,
    T110DRACTUPROC.A110DESCACTU as actuacion, T110DRACTUPROC.A110FECHREGI as fechareg, T110DRACTUPROC.A110CUADPROC as cuaderno
    
FROM
    T103DAINFOPROC T103DAINFOPROC,
    T112DRSUJEPROC T112DRSUJEPROC,
    T112DRSUJEPROC T112DRSUJEPROC2,
   T053BACLASGENE T053BACLASGENE,
    T110DRACTUPROC T110DRACTUPROC,
    T071BASUBCGENE T071BASUBCGENE 
WHERE
    T110DRACTUPROC.A110FECHREGI = {d '$fecha'} AND
    T103DAINFOPROC.A103NUENRADI = '$juzgado' AND
    T103DAINFOPROC.A103ENTIRADI='$corporacion'  AND
    T103DAINFOPROC.A103ESPERADI='$especialidad'  AND
    (T110DRACTUPROC.A110CODIPROV='0001' OR
     T110DRACTUPROC.A110CODIPROV='0002' OR
    T110DRACTUPROC.A110CODIPROV='0006' ) AND
    T053BACLASGENE.A053CODICLAS = T103DAINFOPROC.A103CODICLAS  AND
    T110DRACTUPROC.A110FECHPROV=T110DRACTUPROC.A110FECHDESA  AND
    T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC.A112LLAVPROC AND
    T103DAINFOPROC.A103LLAVPROC = T112DRSUJEPROC2.A112LLAVPROC AND
    T103DAINFOPROC.A103LLAVPROC = T110DRACTUPROC.A110LLAVPROC AND
    T103DAINFOPROC.A103CODISUBC = T071BASUBCGENE.A071CODISUBC AND
    T112DRSUJEPROC.A112CODISUJE='0001' AND
    T112DRSUJEPROC2.A112CODISUJE='0002'  AND
    (T112DRSUJEPROC.A112NUMESUJE= (SELECT max(A112NUMESUJE) 
    FROM T112DRSUJEPROC A
    WHERE
      T103DAINFOPROC.A103LLAVPROC =  A.A112LLAVPROC  AND
       A.A112CODISUJE = '0001' ) )  AND
   (T112DRSUJEPROC2.A112NUMESUJE= (SELECT max(A112NUMESUJE) 
    FROM T112DRSUJEPROC B
     WHERE   T103DAINFOPROC.A103LLAVPROC =  B.A112LLAVPROC  AND
        B.A112CODISUJE = '0002' ) )
ORDER BY
    T103DAINFOPROC.A103NUMEPROC ASC
";
	
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $conn, $sql , $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
   
if ($row_count === false)
   echo "Error in retrieveing row count.";
 else
 
    
   

$i=0;


while( $row = sqlsrv_fetch_array( $stmt) ) {
      
	    
	$vector[$i][proceso] = $row['proceso'];
	$vector[$i][clase] = $row['clase'];
	$vector[$i][demandante] = $row['demandante'];
	$vector[$i][demandado] = $row['demandado'];
	$vector[$i][actuacion] = $row['actuacion'];
	$date_titu= $row['fechareg'];
	$date_tit=date_format($date_titu, 'Y-m-d');
	$vector[$i][fechareg] = $date_tit ;
	$vector[$i][cuaderno] = $row['cuaderno'];
	  
	$i++; 	  
}

	 // print_r($vector);
	  
	  return $vector; 

   

  }  
  
 
 
}
?>