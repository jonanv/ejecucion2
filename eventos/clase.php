<?php
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
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
		$conection['pass']  ="crow";             //password
		$conection['base']="ejecucion";           //base de datos
		
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
	
    public static function getClientes() 
		{
			$obj_cliente=new sQuery();
			//$obj_cliente->executeQuery("select * from evento_expediente"); // ejecuta la consulta para traer los datos de los eventos
			
			$obj_cliente->executeQuery("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,jd.nombre,pu.empleado,eve.evedescripcion
										FROM ((((evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id)
										INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id)
										INNER JOIN juzgado_destino AS jd ON eve.evejuzgadoreparto = jd.id) 
										INNER JOIN pa_usuario AS pu ON eve.eveasignadoa = pu.id) 
										ORDER BY id"); // ejecuta la consulta para traer los datos de los eventos
										
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
			
				$obj_cliente->executeQuery("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,jd.nombre,pu.empleado,eve.evedescripcion 
											FROM ((((evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id)
											INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) 
											INNER JOIN juzgado_destino AS jd ON eve.evejuzgadoreparto = jd.id)
											INNER JOIN pa_usuario AS pu ON eve.eveasignadoa = pu.id) 
											WHERE (ubi.radicado LIKE '%$filtro%') OR (acc.acc_descripcion LIKE '%$filtro%') 
											OR (eve.eveasunto LIKE '%$filtro%') OR (jd.nombre LIKE '%$filtro%') 
											OR (pu.empleado LIKE '%$filtro%')
											ORDER BY id DESC"); 
			}
			else{
			
				$obj_cliente->executeQuery("SELECT eve.id,eve.evefecha,eve.eveasunto,acc.acc_descripcion,ubi.radicado,jd.nombre,pu.empleado,eve.evedescripcion 
											FROM ((((evento_expediente AS eve INNER JOIN ubicacion_expediente AS ubi ON eve.everadicado = ubi.id)
											INNER JOIN accion_expediente AS acc ON eve.eveaccion = acc.id) 
											INNER JOIN juzgado_destino AS jd ON eve.evejuzgadoreparto = jd.id)
											INNER JOIN pa_usuario AS pu ON eve.eveasignadoa = pu.id)
											WHERE eve.evefecha >= '$fd' AND eve.evefecha <= '$fh' 
											ORDER BY id DESC"); 
				
				
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