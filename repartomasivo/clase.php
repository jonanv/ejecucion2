<?php

session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/laborales/"); 
}
else{
 
//-------------------------------------------CALSE Conexion ----------------------------------------------

class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']  ="root";         //  usuario
		$conection['pass']  ="Ejecuc10n2014";             //password
		$conection['base']  ="ejecucion";           //base de datos
		
		// crea la conexion pasandole el servidor , usuario y clave
		$conect= mysql_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) // si la conexion fue exitosa , selecciona la base
		{
			mysql_select_db($conection['base']);			
			$this->con=$conect;
		}
	}
	function getConexion() // devuelve la conexion
	{
		return $this->con;
	}
	function Close()  // cierra la conexion
	{
		mysql_close($this->con);
	}	

}

//-------------------------------------------CALSE sQuery ----------------------------------------------

class sQuery   // se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	var $coneccion;
	var $consulta;
	var $resultados;
	
	function sQuery()  // constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->coneccion= new Conexion();
	}
	function executeQuery($cons)  // metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
	{
		$this->consulta= mysql_query($cons,$this->coneccion->getConexion());
		return $this->consulta;
	}	
	function getResults()   // retorna la consulta en forma de result.
	{return $this->consulta;}
	
	function Close()		// cierra la conexion
	{$this->coneccion->Close();}	
	
	function Clean() // libera la consulta
	{mysql_free_result($this->consulta);}
	
	function getResultados() // debuelve la cantidad de registros encontrados
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}
	
	function getAffect() // devuelve las cantidad de filas afectadas
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}

    function fetchAll()
    {
        $rows=array();
		if ($this->consulta)
		{
			while($row=  mysql_fetch_array($this->consulta))
			{
				$rows[]=$row;
			}
		}
        return $rows;
    }
	
}

//-------------------------------------------CALSE Cliente----------------------------------------------

class Cliente
{

	//CAMPOS PARA EL FORMULARIO clientForm2.php
	var $evefecha;     //se declaran los atributos de la clase, que son los atributos del cliente
	var $eveasunto;
	var $eveaccion;
	var $everadicado;
	var $evejuzgadoreparto;
	var $eveasignadoa;
	var $evedescripcion;
	
	var $evedatos;
	
	var $id;
	
	var $datoslog;
	var $datoslog2;
	
	
	//NUEVOS 24-MARZO-2015
	var $estado;
	var $piso;
	var $detalleestado;
	var $claseproceso;
	var $datoradicado;
	
	//DATOS PARA SIGLO XXI
	var $cambiarponente;
	
    public static function getClientes() 
		{
			$obj_cliente=new sQuery();
													
			$obj_cliente->executeQuery("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
										es.nombre AS estado,de.nombre AS detalleestado,
										cp.nombre AS claseproceso,ubi.fecha_reparto,jd.nombre AS juzgadoreparto,
										ubi.iddespacho AS ponente
										FROM ((((ubicacion_expediente ubi
										LEFT JOIN detalle_estado de ON ubi.idestado = de.id)
										LEFT JOIN estado es ON de.idestado = es.id)
										LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
										LEFT JOIN juzgado_destino jd ON ubi.idjuzgado_reparto = jd.id)
										WHERE ubi.fecha_reparto IS NOT NULL 
										ORDER BY ubi.fecha_reparto DESC LIMIT 500");
										
			return $obj_cliente->fetchAll(); // retorna todos los clientes
		}
	
	public static function getClientesFiltro($filtro,$fd,$fh) 
		{
			$obj_cliente=new sQuery();
			
			//$obj_cliente->executeQuery("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,eve.evedescripcion FROM (evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id
										//INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) WHERE radicado LIKE '%$filtro%' ORDER BY id DESC"); // ejecuta la consulta para traer los datos de los eventos
			
			//SI ALGUNA DE LAS FECHAS ES VACIA CONSULTA POR LO QUE SE ASIGNO A LA VARIABLE $filtro
			//SI NO BOTA LA INFORMACION POR EL RANGO DE FECHAS
			if( ( empty($fd) || empty($fh) ) ){
			
				
				$obj_cliente->executeQuery("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
											es.nombre AS estado,de.nombre AS detalleestado,
											cp.nombre AS claseproceso,ubi.fecha_reparto,jd.nombre AS juzgadoreparto,
											ubi.iddespacho AS ponente
											FROM ((((ubicacion_expediente ubi
											LEFT JOIN detalle_estado de ON ubi.idestado = de.id)
											LEFT JOIN estado es ON de.idestado = es.id)
											LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
											LEFT JOIN juzgado_destino jd ON ubi.idjuzgado_reparto = jd.id)
											WHERE ubi.fecha_reparto IS NOT NULL AND (ubi.radicado LIKE '%$filtro%') OR (ubi.cedula_demandante LIKE '%$filtro%')
											OR (ubi.demandante LIKE '%$filtro%') OR (ubi.cedula_demandado LIKE '%$filtro%')
											OR (ubi.demandado LIKE '%$filtro%') OR (ubi.piso LIKE '%$filtro%')
											OR (es.nombre LIKE '%$filtro%') OR (de.nombre LIKE '%$filtro%')
											OR (cp.nombre LIKE '%$filtro%') OR (jd.nombre LIKE '%$filtro%')
											OR (ubi.iddespacho LIKE '%$filtro%') 
											ORDER BY ubi.fecha_reparto");
			}
			else{
			
		
				$obj_cliente->executeQuery("SELECT ubi.id,ubi.radicado,ubi.cedula_demandante,ubi.demandante,ubi.cedula_demandado,ubi.demandado,ubi.piso,
											es.nombre AS estado,de.nombre AS detalleestado,
											cp.nombre AS claseproceso,ubi.fecha_reparto,jd.nombre AS juzgadoreparto,
											ubi.iddespacho AS ponente
											FROM ((((ubicacion_expediente ubi
											LEFT JOIN detalle_estado de ON ubi.idestado = de.id)
											LEFT JOIN estado es ON de.idestado = es.id)
											LEFT JOIN pa_clase_proceso cp ON ubi.idclase_proceso = cp.id)
											LEFT JOIN juzgado_destino jd ON ubi.idjuzgado_reparto = jd.id)
											WHERE ubi.fecha_reparto IS NOT NULL AND ubi.fecha_reparto >= '$fd' AND ubi.fecha_reparto <= '$fh' 
											ORDER BY ubi.fecha_reparto DESC");
				
			}

			return $obj_cliente->fetchAll(); // retorna todos los clientes
		}
	public static function getClientesFiltroRadicado($filtro) 
		{
			$obj_cliente=new sQuery();
			
			$obj_cliente->executeQuery("SELECT radicado FROM ubicacion_expediente WHERE radicado LIKE '%$filtro%'"); 

			return $obj_cliente->fetchAll(); // retorna todos los clientes
		}
	function Cliente($nro=0) // declara el constructor, si trae el numero de cliente lo busca , si no, trae todos los clientes
	{
		if ($nro!=0)
		{
			$obj_cliente=new sQuery();
			//$result=$obj_cliente->executeQuery("select * from evento_expediente where id = $nro"); // ejecuta la consulta para traer al cliente 
			$result=$obj_cliente->executeQuery("select eve.id,eve.evefecha,eve.eveasunto,eve.eveaccion,ubi.radicado,eve.evejuzgadoreparto,eve.eveasignadoa,eve.evedescripcion from (evento_expediente as eve INNER JOIN ubicacion_expediente as ubi ON eve.everadicado = ubi.id ) where eve.id = $nro"); // ejecuta la consulta para traer al cliente 
			$row=mysql_fetch_array($result);
			$this->id=$row['id'];
			$this->evefecha=$row['evefecha'];
			$this->eveasunto=$row['eveasunto'];
			$this->eveaccion=$row['eveaccion'];
			$this->everadicado=$row['radicado'];
			$this->evejuzgadoreparto=$row['evejuzgadoreparto'];
			$this->eveasignadoa=$row['eveasignadoa'];
			$this->evedescripcion2=$row['evedescripcion'];
		
		}
	}
		
		// metodos que devuelven valores
	function getID()
	 { return $this->id;}
	function getEvefecha()
	 { return $this->evefecha;}
	function getEveasunto()
	 { return $this->eveasunto;}
	function getEveaccion()
	 { return $this->eveaccion;}
	function getEveradicado()
	 { return $this->everadicado;}
	function getEvejuzgadoreparto()
	 { return $this->evejuzgadoreparto;}
	function getEveasignadoa()
	 { return $this->eveasignadoa;}
	function getEvedescripcion()
	 { return $this->evedescripcion;}
	 
	function getEvedescripcion2()
	 { return $this->evedescripcion2;}
	 
	function getEvedatos()
	 { return $this->evedatos;}
	 
	function getDatoslog()
	 { return $this->datoslog;}
	
	function getDatoslog2()
	 { return $this->datoslog2;}
	 
	 
	 //NUEVOS 24-MARZO-2015
	 function getEstado()
	 { return $this->estado;}
	 function getPiso()
	 { return $this->piso;}
	 function getDetalleestado()
	 { return $this->detalleestado;}
	 function getClaseproceso()
	 { return $this->claseproceso;}
	 function getDatoradicado()
	 { return $this->datoradicado;}
	 
	 
	 
	 //DATOS PARA SIGLO XXI
	 function getCambiarponente()
	 { return $this->cambiarponente;}
	 
	 
	 
	 
	 
	 
	
	 
		// metodos que setean los valores
	function setEvefecha($val)
	 { $this->evefecha=$val;}
	function setEveasunto($val)
	 {  $this->eveasunto=$val;}
	function setEveaccion($val)
	 {  $this->eveaccion=$val;}
	function setEveradicado($val)
	 {  $this->everadicado=$val;}
	function setEvejuzgadoreparto($val)
	 {  $this->evejuzgadoreparto=$val;}
	function setEveasignadoa($val)
	 {  $this->eveasignadoa=$val;}
	function setEvedescripcion($val)
	 {  $this->evedescripcion=$val;}
	 
	function setEvedescripcion2($val)
	 {  $this->evedescripcion2=$val;}
	
	function setEvedatos($val)
	 {  $this->evedatos=$val;}
	 
	 //CREADO POR JORGE ANDRES VALENCIA, PARA EL REGISTRO DEL LOG
	 function setDatoslog($val)
	 {  $this->datoslog=$val;}
	 
	 function setDatoslog2($val)
	 {  $this->datoslog2=$val;}
	 
	 
	 //NUEVOS 24-MARZO-2015
	 function setEstado($val)
	 {  $this->estado=$val;}
	 function setPiso($val)
	 {  $this->piso=$val;}
	 function setDetalleestado($val)
	 {  $this->detalleestado=$val;}
	 function setClaseproceso($val)
	 {  $this->claseproceso=$val;}
	 function setDatoradicado($val)
	 {  $this->datoradicado=$val;}
	 
	 
	 
	 //DATOS PARA SIGLO XXI
	 function setCambiarponente($val)
	 { return $this->cambiarponente=$val;}
	 
    function save()
    {
        if($this->id)
        {$this->updateCliente();}
        else
        {$this->insertCliente();}
    }
	private function updateCliente()	// actualiza el cliente cargado en los atributos
	{
			$obj_cliente=new sQuery();
			$query="update evento_expediente set evefecha='$this->evefecha', eveasunto='$this->eveasunto',eveaccion='$this->eveaccion',evejuzgadoreparto='$this->evejuzgadoreparto',eveasignadoa='$this->eveasignadoa',evedescripcion='$this->evedescripcion2' where id = $this->id";
			$obj_cliente->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	
	}
	private function insertCliente()	// inserta el cliente cargado en los atributos
	{
			
			$error_transaccion = 0; //variable para detectar error
			
			$evedatosradicado = explode("//////////",$this->evedatos);
			
			$longitudradicados = count($evedatosradicado);
			
			//EMPIEZA LA TRANSACCION
			$conn=new Conexion();
			mysql_query("BEGIN",$conn->getConexion()); // Inicio de Transacción
			
			//CODIGO PARA DETERMIAR SI LA TRANSACCION SI FUNCIONA, ES DECIR 
			//REALIZANDO EL EJEMPLO INSERTANDO EN DOS TABLAS
			/*$obj_cliente2=new sQuery();
				
			$query="insert into log(fecha,accion,detalle,idusuario,idtipolog) 
					values('0000-00-00','ninguna','ninguno',38,1)";
				
			$resultado = $obj_cliente2->executeQuery($query);
				
			if (!$resultado) {
				$error_transaccion = 1;
			} */
			
			for ($i = 0; $i < $longitudradicados-1; $i++) {
    			
				$datosradicadojuzgado = explode("-----",$evedatosradicado[$i]);
				
				$radicado     = $datosradicadojuzgado[0];
				$juzgado      = $datosradicadojuzgado[1];
				$funcionarioa = $datosradicadojuzgado[2];
				
				
				$obj_cliente=new sQuery();
				
				$query="insert into evento_expediente(idusuario,evefecha,eveasunto,eveaccion,everadicado,evejuzgadoreparto,eveasignadoa,evedescripcion) 
						values(".$_SESSION['idUsuario'].",'$this->evefecha', '$this->eveasunto','$this->eveaccion','$radicado','$juzgado','$funcionarioa','')";
				
				$resultado = $obj_cliente->executeQuery($query);
				
				if (!$resultado) {
					$error_transaccion = 1;
				} 
				
				
			}
			
			if($error_transaccion) {
				//FALLO EN LA TRANSACCION
				//CIERRO ESTA LINEA AUNQUE FUNCIONA LAS TRANSACCIONES, NO ME CARGA EL MENSAJE DE ALERTA
				/*echo "<HTML><SCRIPT>alert('Fallo en procesar datos...');</SCRIPT></HTML>"*/;
				mysql_query("ROLLBACK",$conn->getConexion());
				return $obj_cliente->getAffect();
			} 
			else {
				//EXITO EN LA TRANSACCION
				mysql_query("COMMIT",$conn->getConexion());
				return $obj_cliente->getAffect();
			}
			
			
	}	
	function delete()	// elimina el cliente
	{
			$obj_cliente=new sQuery();
			$query="delete from evento_expediente where id=$this->id";
			$obj_cliente->executeQuery($query); // ejecuta la consulta para  borrar el cliente
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
			
			return $obj_cliente->getAffect();
	}	
	
	//-----------------------------FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014-----------------------------------------
	function save_log()
    {
       $this->reg_log();
    }
	private function reg_log()
	{
			
			//----------------------PARA EL LOG--------------------------------------
			$datos_log = explode("///////",$this->datoslog);
			
			$fechaa  = $datos_log[0];
			$accion  = $datos_log[1];
			$detalle = $datos_log[2];
			$idres   = $datos_log[3];
			$tipolog = $datos_log[4];
			
			//----------------------------------------------------------------------------
			
			$obj_cliente=new sQuery();
			$query="INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) VALUES ('$fechaa','$accion','$detalle','$idres','$tipolog')";
			
			//$query="INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) VALUES ('2014-11-04','Eliminar Evento','detalle',38,1)";
			
			$obj_cliente->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	}	
	
	//FUNCIONES PUBLICAS
	public function getSuma() 
	{
		$obj_suma=new sQuery();
		$obj_suma->executeQuery("SELECT SUM(peso) as sumapesos FROM clientes"); // ejecuta la consulta para traer al cliente

		return $obj_suma->fetchAll(); // retorna la suma de todos clientes
	}
	
	
	public function getAccion() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT id,acc_descripcion FROM accion_expediente ORDER BY acc_descripcion");

		return $obj_emp->fetchAll(); 
	}
	public function getFuncioanrioasignado() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT id,empleado FROM pa_usuario ORDER BY empleado");

		return $obj_emp->fetchAll(); 
	}
	public function getRadicado() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT id,radicado FROM ubicacion_expediente ORDER BY radicado"); 

		return $obj_emp->fetchAll();
	}
	public function getJuzgadoreparto() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT id,nombre FROM juzgado_destino ORDER BY nombre");

		return $obj_emp->fetchAll(); 
	}
	
	
	public function getEmpleadoFiltro() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT cedula,nombre FROM empleado where id = $this->id"); // ejecuta la consulta para traer al cliente

		return $obj_emp->fetchAll(); // retorna la suma de todos clientes
	}
	
	//NUEVO 24-MARZO-2015
	public function getListaEstado() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT * FROM estado ORDER BY nombre");

		return $obj_emp->fetchAll(); 
	}
	public function getListaDetalleEstado() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT * FROM detalle_estado ORDER BY nombre");

		return $obj_emp->fetchAll(); 
	}
	public function getListaClaseProceso() 
	{
		$obj_emp=new sQuery();
		$obj_emp->executeQuery("SELECT * FROM pa_clase_proceso ORDER BY nombre");

		return $obj_emp->fetchAll(); 
	}
	
	
	
	
	/***********************************************************************************/

   /*----------------------- Listar Despachos Justicia XXI-------------------------------------*/

   /***********************************************************************************/
  
  	public function getListarDespachosJusticiaXXI()

  	{
	  
	    $j=0;
	    unset($vector);
	  
	    $serverName = "192.168.89.20"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"consejoPN", "UID"=>"sa", "PWD"=>"M4nt3n1m13nt0");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		/*$serverName = "usuario-PC\SQLExpress"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"prueba", "UID"=>"sa", "PWD"=>"crow");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);*/
		
		if( $conn ) { 
		
			$sql = ("SELECT A101CODIPONE,  A101NOMBPONE,  A101CODIENTI , A101CODIESPE,  A101CODINUME
					 FROM  dbo.T101DAINFOPONE
					 WHERE (A101SECRDESP = 'd') AND (A101FLAGHABI = 'SI') AND (A101CODIENTI='43' AND A101CODIESPE='03')  
					 ORDER BY A101CODIENTI, A101CODIESPE, A101CODINUME, A101NOMBPONE");
					 
			//$sql = "SELECT * FROM ponente";
							
			$params  = array();
			$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
			$stmt    = sqlsrv_query( $conn, $sql , $params, $options );
			
			$row_count = sqlsrv_num_rows( $stmt );
			
			if ($row_count === false){
			   echo "Error in retrieveing row count. en listarActuacion";}
			else{
			 
				while( $row = sqlsrv_fetch_array( $stmt)){
				 
					$vector[$j][codi_pone] = $row['A101CODIPONE'];	
					$vector[$j][nom_pone]  = $row['A101NOMBPONE'];
					$vector[$j][codi_enti] = $row['A101CODIENTI'];
					$vector[$j][codi_espe] = $row['A101CODIESPE'];
					$vector[$j][codi_nume] = $row['A101CODINUME'];
					
					//$vector[$j][codigo]  = $row['codigo'];	
					//$vector[$j][ponente] = $row['ponente'];
			
				
					$j++;
				 
				}
			 
			}
		}
		else{ 
			 echo "No se puede conectar a la Base de Datos.<br />"; 
			 die( print_r( sqlsrv_errors(), true)); 
		}
		  
		
		  
		return $vector;
		
	  }
	
	//SE CLONAN ESTAS DOS FUNCIONES SOLO PARA HACER EFECTIVO EL REGISTRO DEL EVENTO ELIMINAR EN LA TABLA LOG
	//YA QUE LAS VARIABLES PARA CREAR EL REGISTRO DEL LOG QUEDAN CON EL EVENTO DE Resgistr&oacute; Evento DEL
	//FORMULARIO clientForm2.php, ES DECIR SE DIRECCIONAN O OTRA VARIABLE DESDE EL FORMULARIO clientesGrid.PHP
	//CAMPO OCULTO datoslog2 CREANDO SUS RESPECTIVOS var $datoslog2,getDatoslog2() Y setDatoslog2($val)
	function save_log2()
    {
       $this->reg_log2();
    }
	private function reg_log2()
	{
			
			//----------------------PARA EL LOG--------------------------------------
			$datos_log2 = explode("///////",$this->datoslog2);
			
			$fechaa  = $datos_log2[0];
			$accion  = $datos_log2[1];
			$detalle = $datos_log2[2];
			$idres   = $datos_log2[3];
			$tipolog = $datos_log2[4];
			
			//----------------------------------------------------------------------------
			
			$obj_cliente=new sQuery();
			$query="INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) VALUES ('$fechaa','$accion','$detalle','$idres','$tipolog')";
			
			//$query="INSERT INTO log (fecha,accion,detalle,idusuario,idtipolog) VALUES ('2014-11-04','Eliminar Evento','detalle',38,1)";
			
			$obj_cliente->executeQuery($query); // ejecuta la consulta para traer al cliente 
			return $obj_cliente->getAffect(); // retorna todos los registros afectados
	}	
	
	//------------------------------------------------------------------------------------------------------------------------------------
	
}




function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);
	
    return $string;
}

}
?>