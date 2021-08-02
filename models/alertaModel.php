<?php

class alertaModel extends modelBase

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

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	  
	   }

	 }
	 if($condicion=="2b")

	  {

	    $_SESSION['elemento'] = "Error al Realizar el Registro...";

	    $_SESSION['elem_error_transaccion'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	  
	   }

	 }
	  if($condicion==22)

	  {

	    $_SESSION['elemento'] = "El registro ha sido actualizado correctamente";

	    $_SESSION['elem_conscontrato'] = true;

	   if($_SESSION['id']!="")
	   {

	    print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
	  
	   }
	   

	 }
	 if($condicion==23)

	  {

	    $_SESSION['elemento'] = "Actualización del Reparto Incorrecta, Faltan Valores por Definir en el Reparto, Verificar clic en Reparto, Fecha, Juzgado Reparto y Cambio Ponente";

	    $_SESSION['elem_reparto'] = true;

	   if($_SESSION['id']!="")
	   {

	    	print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_archivo"</script>';
			
			/*print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Reparto_archivomodificarOtro&nombre1="+"'.$condicion2.'""</script>';*/
		
		
	  
	   }
	   

	 }
     if($condicion==3)

	  {

	    $_SESSION['elemento'] = "El radicado que intenta registrar ya existe en el sistema";

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
	   
	   
	   if($condicion == 9){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Titulos_Encustodia"</script>';
			}
		}
		 
	 	if($condicion == "9b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Titulos_Encustodia"</script>';
	  
	   		}

	 	}
		
		if($condicion == 10){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Listar_Titulos_Materializados"</script>';
			}
		}
		 
	 	if($condicion == "10b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Listar_Titulos_Materializados"</script>';
	  
	   		}

	 	}
		
		if($condicion == 11){

	 		$_SESSION['elemento'] = "El registro ha sido ingresado correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Listar_Titulos_OtrosJuzgados"</script>';
			}
		}
		 
	 	if($condicion == "11b"){

	 		$_SESSION['elemento'] = "Error al Realizar el registro";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=Listar_Titulos_OtrosJuzgados"</script>';
	  
	   		}

	 	}
		
		if($condicion == 12){

	 		$_SESSION['elemento'] = "La Asignacion ha sido ingresada correctamente";

	    	$_SESSION['elem_conscontrato'] = true;

	   		if($_SESSION['id']!=""){

	    		/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=alerta&action=Listar_Tutelas"</script>';
			}
		}
		 
	 	if($condicion == "12b"){

	 		$_SESSION['elemento'] = "Error al Realizar la Asignacion";

	    	$_SESSION['elem_error_transaccion'] = true;

	   		if($_SESSION['id']!=""){

				/*print'<script languaje="Javascript">location.href="index.php?controller=menu&action=mod_empleados"</script>';*/
			
				print'<script languaje="Javascript">location.href="index.php?controller=alerta&action=Listar_Tutelas"</script>';
	  
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
  
  
  //**************** FUNCIONES ESPECIALES **********************************************
	
	//-------------------------------------------------------------------------------
	//PARA CALCULAR LOS DIAS DE RESPUESTA DE UN DOCUMENTO
	
	public function Dias_Respuesta($fecharegistro,$fecharespuesta){
	
				
		require_once('funciones/Festivos.php');
		
		$dias_diferencia = 0;
		
		if($fecharespuesta != "0000-00-00"){
		
			
			//FECHA INCIAL
			$inicio    = new DateTime($fecharegistro);
			//Un día es P1D,Dos días es P2D, 
			//es decir que si la fecha inicial es 2015-05-19 y la final es 2015-05-27
			//el intervalos iria de 2015-05-19 2015-05-20 2015-05-21 2015-05-22 2015-05-23 2015-05-24 2015-05-25 2015-05-26
			$intervalo = new DateInterval('P1D');
			//FECHA FINAL
            $fin       = new DateTime($fecharespuesta);
			//CREO EL PERIODO SEGUN LOS DATOS ANTERIORES
			$periodo   = new DatePeriod($inicio,$intervalo,$fin);
			
			foreach ($periodo as $fecha) {
			
    			//echo $fecha->format('Y-m-d')."\n";
				//$dias_diferencia = $dias_diferencia." ".$fecha->format('Y-m-d')."\n";
				
				//OBTENGO FECHA A FECHA, DESDE LA INCIAL A LA FINAL Y CAPTURO SU AÑO,MES,DIA
				$fechaperiodo = explode("-",$fecha->format('Y-m-d'));
				$y            = trim($fechaperiodo[0]);
			    $m            = trim($fechaperiodo[1]);
			    $d            = trim($fechaperiodo[2]);
				//OBTENGO EL DIA SEGUN LA FECHA PASADA A $fechaperiodo CON SUS PARTES AÑO,MES,DIA
				$date         = date('D', mktime(0,0,0,$m,$d,$y));
				
				//PARA DIAS FESTIVOS, SE INSTANCIA LA CLASE Y SE LLAMA LA FUNCION PARA SABER SI UN DIA ES FESTIVO
				$dias_festivos = new festivos($y);
				$esfestivo     = $dias_festivos->esFestivo($d,$m);
				
				//SE REALIZA LA PREGUNTA SI ES SABADO, DOMINGO O FESTIVO
				//PARA NO INCREMENTAR $dias_diferencia
				if($date == 'Sat' or $date == 'Sun' or $esfestivo == 1){
			
					$bandera = 0;
				}
				else{
				
					$dias_diferencia = $dias_diferencia + 1;
				}
				
				//$dias_diferencia = $dias_diferencia." ".$date."\n";
			}
	
		}
		else{
			
			$dias_diferencia = "-";
			
		}
		
		//PARA SABER QUE RETORNA
		if($dias_diferencia != "-"){
		
			//SE SUMA UNO PARA QUE SE TENGA ENCUENTA EL DIA EN QUE SE REGISTRA LA TUTELA
			//ES DECIR SI SE REGISTRA EL 2016-03-09 CUENTA ESE DIA NO CIENTA DESDE EL 2016-03-10
			$dias_diferencia = $dias_diferencia + 1;
		}
		else{
		
			$dias_diferencia = "-";
		}
		
		return $dias_diferencia;
	
	}
	
	//PARTE AGREGADA EL 07 DE MAYO DEL 2015 PARA EL MANEJO DEL TRASLADO ART. 108
  	public function get_fecha_actual(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d g:ia'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
  	}
  	
	public function get_fecha_actual_amd(){
	
	
		//FORMA WIN 7 Y 8, YA QUE DE LA FORMA ANTERIOR TOMA EL AM O PM Y DA CONFLICTOS PARA 
		//GUARDAR EN LA BASE DE DATOS EN ESTE CASO LA TABLA detalle_correspondencia 
		//CAMPO fecha QUE ES DATETIME 
		date_default_timezone_set('America/Bogota'); 
		$fecharegistro=date('Y-m-d'); //FORMA PARA XP
		//$fecharegistro = date('Y-m-d g:i'); 
		
		return $fecharegistro; 
		
	
  }
	
	//*******************************************************************************************************************************************************
	//PARA LISTAR LAS TUTELAS
	
	public function get_lista_tutelas(){
	
		//CAMBIO PARA FILTRAR PROCESOS Y LA CARGA DE LOS MISMOS NO SE DEMORE 
		//EN LA PLATAFORMA 2017-11-29
		$year_tutela          = date('Y');
		$mes_tutela           = date('m');
		$mes_anterior_tutela  = date('m') - 1;
	
		$idusuario  = $_SESSION['idUsuario'];
		
		//IDENTIFICAMOS QUE JUZGADO ES PARA LISTAR SOLO LAS TUTELAS ASIGNADAS A ESE JUZGADO
		//J1
		if($idusuario == 52){
		
			//$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE radicado LIKE '%170014303%' ORDER BY fecharegistrosistema DESC");
			
			$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE idjuzgado = '15'
											 AND YEAR(fecharegistrosistema) = '$year_tutela' 
											 AND (MONTH (fecharegistrosistema) >= '$mes_anterior_tutela' AND MONTH(fecharegistrosistema) <= '$mes_tutela')");
			
			$listar->execute();
			
		}
		//J2
		if($idusuario == 53){
		
			//$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE radicado LIKE '%170014303%' ORDER BY fecharegistrosistema DESC");
			
			$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE idjuzgado = '16'
			                                 AND YEAR(fecharegistrosistema) = '$year_tutela' 
											 AND (MONTH (fecharegistrosistema) >= '$mes_anterior_tutela' AND MONTH(fecharegistrosistema) <= '$mes_tutela')");
			
			$listar->execute();
			
		}
		
		//OTRO USUARIO DEL SISTEMA QUE NO SEA EL JUZGADO
		if($idusuario != 52 && $idusuario != 53){
		
			//$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE radicado LIKE '%170014303%' ORDER BY fecharegistrosistema DESC");
			
			$listar    = $this->db->prepare("SELECT * FROM ubicacion_expediente WHERE radicado LIKE '%170014303%'
											 AND YEAR(fecharegistrosistema) = '$year_tutela' 
											 AND (MONTH (fecharegistrosistema) >= '$mes_anterior_tutela' AND MONTH(fecharegistrosistema) <= '$mes_tutela')
											 ORDER BY fecharegistrosistema DESC");
			
			$listar->execute();
		
		}
											 
		
  		//echo $mes_tutela." ".$mes_anterior_tutela;
		
  		return $listar;
	
  	}	

    public function asignarfechafallotutela(){

		//$error_transaccion = 0; //variable para detectar error de transaccion	
	
		//SE OBTIENEN LOS DATOS
		
		$idusuario = $_SESSION['idUsuario'];
		
		$id     = trim($_POST['id']);
		$fechas = trim($_POST['fechas']);
		
		//DATOS PARA EL REGISTRO DEL LOG
		
		//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
		$modelo	= new alertaModel();
		//OBTENEMOS LA FECHA ACTUAL
		$fechaactual  = $modelo->get_fecha_actual();
		$fechar       = explode(" ",trim($fechaactual));
		$fecha        = $fechar[0];
		$hora         = $fechar[1];
		
		$accion  = "Se Asigna Fecha de Fallo de Tutela";
      	$detalle = $_SESSION['nombre']." "."Asigna Fecha de Fallo de Tutela ".$fecha." "."a las: ".$hora." "."ID PROCESO: ".$id;
		$tipolog = 1;
		
		try {  
		
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//EMPIEZA LA TRANSACCION
		   	$this->db->beginTransaction();
			
		   
				$this->db->exec("UPDATE ubicacion_expediente SET fecha_fallo_tutela = '$fechas',idusuario = '$idusuario'
				                 WHERE id = '$id'");
								 
				
				$this->db->exec("INSERT INTO log (fecha, accion,detalle,idusuario,idtipolog) VALUES ('$fecha', '$accion','$detalle','$idusuario','$tipolog')");
				
			
			//SE TERMINA LA TRANSACCION  
		  	$this->db->commit();
			//echo "exito: " .$idusuario;
			print'<script languaje="Javascript">location.href="index.php?controller=alerta&action=mensajes&nombre=12"</script>';
		  
		} 
		catch (Exception $e) {
		
			//NO TERMINA LA TRANSACCION SE PRESENTO UN ERROR
			$this->db->rollBack();
		  	echo "Fallo: " . $e->getMessage();
			/*print'<script languaje="Javascript">location.href="index.php?controller=archivo&action=mensajes&nombre=12b"</script>';*/
		}
		
		
  	}
   
	
	
	
  public function get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar){
	
		$listar     = $this->db->prepare("SELECT ".$campos." FROM ".$nombrelista." WHERE id = ".$idaccion." ORDER BY ".$campoordenar);
	
  		$listar->execute();

  		return $listar;
	
	}
  
     
}//FIN CLASE
  
  




?>