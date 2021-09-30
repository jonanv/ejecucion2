<?php  

require_once('./models/administrarModel.php');

require_once('./models/archivoModel.php');

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo = new administrarModel();

//MODELO ARCHIVO
$modelo_2 = new archivoModel();

$imagen=$foto;

$idusuario = $_SESSION['idUsuario'];

//PARA QUE UN USUARIO UBICADO EN LA TABLA pa_usuario_acciones, REGISTRO id = 8 PUEDA
//CONSULTAR OTRAS HOJAS DE VIDA
$campos                = 'usuario';
$nombrelista           = 'pa_usuario_acciones';
$idaccion			   = '8';
$campoordenar          = 'id';
$datosusuarioaccionesR = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuarios_ADMIN        = $datosusuarioaccionesR->fetch();
$usuarios_ADMIN_2	   = explode("////",$usuarios_ADMIN[usuario]);

//ID USUARIOS PERTENECIENTES AL JUZGADO J1, J2 QUE NO PUEDEN ENTRAR A OTRO MODULO QUE NO SEA SIEPRO
$idaccion			      = '10';
$campoordenar             = 'id';
$datosusuarioaccionesR_JUZGADO = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuarios_ADMIN_JUZGADO        = $datosusuarioaccionesR_JUZGADO->fetch();
$usuarios_ADMIN_2_JUZGADO      = explode("////",$usuarios_ADMIN_JUZGADO[usuario]);


//ID USUARIOS QUE PUEDEN GESTIONAR ACCIONES MODULO CALIDAD
$idaccion			            = '13';
$campoordenar                   = 'id';
$datosusuarioacciones_CALIDAD_1 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuarios_CALIDAD_2             = $datosusuarioacciones_CALIDAD_1->fetch();
$usuarios_CALIDAD_3             = explode("////",$usuarios_CALIDAD_2[usuario]);



//ID USUARIOS J2, PARA PARAMETRIZAR LOS DIAS QUE SE GENERA LAS ALERTAS DE PROCESOS EN LA PLATAFORMA ALERTA TUTELAS
//PERO TABIEN SE USA PARA QUE SOLO LOS DEL J2 VEAN LAS OBSERVACIONES QUE ELLOS HACEN Y EN LA OECM NO SE VIZUALICEN
//id= 18 ---> 53////62////64
$idaccion	      = '18';
$campoordenar     = 'id';
$datosusuarioOBSX = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuarios_OBS_1X  = $datosusuarioOBSX->fetch();
$usuariosa_OBS_2X = explode("////",$usuarios_OBS_1X[usuario]);

//SE ACTUALIZA POR ESTA SQL, YA QUE EL MENU PRINCIPAL SE DEMORA PARA CARGAR, 14 DE AGOSTO 2019
if ( in_array($_SESSION['idUsuario'],$usuariosa_OBS_2X,true) ) { 

	$datosALERTA   = $modelo_2->busquedad_ALRTA_OBSERVACION(1);
	$fila_ALER     = $datosALERTA->fetch();
	$cantregisALER = $fila_ALER['cantidad'];
			
	/*$fcALER = 0;
	while($fila_ALER = $datosALERTA->fetch()){		
			
		$fcALER = $fcALER + 1; 
			
	}*/
	
	//$cantregisALER = $fcALER;
	

}


//ID USUARIOS QUE PUEDEN VER Y REGISTRAR  AUDIENCIAS, TANTO DEL J1 Y J2 DE EJECUCION, 
//Y PERSONAL OECM, DIRECTORA(8), SECRETARIO(19), ING SISTEMAS(38)
$idaccion	       = '26';
$campoordenar      = 'id';
$datosusuarioAUDIX = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuariosAUDI1X    = $datosusuarioAUDIX->fetch();
$usuariosaAUDI2X   = explode("////",$usuariosAUDI1X[usuario]);


?>
<style type="text/css">

#apDiv1 {
	position:absolute;
	width:200px;
	height:20px;
	z-index:1;
	left: 454px;
	top: 224px;
	text-align: center;
}
#apDiv2 {

	position:absolute;
	width:85px;
	height:10px;
	z-index:1;
	left: 1305px;
	top: 340px;
	text-align:left;
	font-size:11px;
}
#apDiv3 {

	position:absolute;
	width:120px;
	height:10px;
	z-index:1;
	left: 1305px;
	top: 288px;
	text-align:left;
	font-size:11px;
}

</style>


<script src="views/js/jquery_NV.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>

<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<script src="views/js/ajax/ajax_filtro_ubicacion.js" type="text/javascript" charset="utf-8"></script>


<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<link href="views/css/stylepopupboxsoporte.css" rel="stylesheet" type="text/css"> 


<!-- ALERTAS -->
<script src="views/js/alertify.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
<link href="views/css/alertify.core.css" rel="stylesheet" type="text/css">
<link href="views/css/alertify.default.css" rel="stylesheet" type="text/css">
<!-- FIN ALERTAS -->


<script type="text/javascript" language="javascript" class="init">

$(document).ready(function() {


	//GENERAR SOPORTE TECNICO
	$('.generar_soporte').click( function(){
						
						
		params={};
		params.id_filtro = 0;

	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
			
			
		})
		
		
		 
		
    });
	
	
	//------------ADICIONADO EL 6 DE AGOSTO 2019-------------
	
	//PROGRAMAR AUDIENCIA
	$('.programar_audiencia').click( function(){
						
						
		params={};
		params.id_filtro = 0;

	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/audi_programar.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	
	//------------FIN PROGRAMAR AUDIENCIA-------------


});

</script>	


<script type="text/javascript">

//---------------------------------ALERTAS--------------------------------------------------------
	
function notificacion(){
    //una notificaci�n normal
	
	alertify.log("ALERTA OBSERVACIONES ASIGNADAS PARA DAR RESPUESTA, DAR CLIC MODULO SIEPRO / MENU EXPEDIENTES / ASIGNAR OBSERVACION"); 
	return false;
}

function notificacion_tutela(){
    //una notificaci�n normal
	
	var iduser = "<?php echo $idusuario; ?>" ;
	
	//alert(iduser);
	
	if(iduser == 38 || iduser == 51 || iduser == 8 || iduser == 68){
	
	
		$.get("funciones/traer_procesos_TUTELAS.php", function(cadena){
				
	
				//alert(cadena);
				
				if(cadena == -1){
					
					
					alertify.log("NO EXISTEN CONEXION CON JUSTICIA XXI");
					return false;
					
				}
				if(cadena == 0){
					
					//alertify.log("ALERTA TUTELAS NO DISPONIBLES"); 
					cadena = 0;
					return false;
					
				}
				if(cadena == 1){
					
					alertify.log("ALERTA: INGRESO TUTELA"); 
					return false;
					
				}
				
				
				
				
		} );
	
		
	}
}




function notificacion_solicitudes_tecnicas(){
    //una notificaci�n normal
	
	var iduser = "<?php echo $idusuario; ?>" ;
	
	//alert(iduser);
	
	if(iduser == 38 || iduser == 8){
	
	
		$.get("funciones/traer_SOLICITUDESTECNICAS.php", function(cadenaX){
				
	
				//alert(cadena);
				
				/*if(cadenaX == -1){
					
					
					alertify.log("NO EXISTEN CONEXION...");
					return false;
					
				}
				if(cadenaX == 0){
					
					//alertify.log("ALERTA SOLICITUDES NO DISPONIBLES"); 
					cadenaX = 0;
					return false;
					
				}*/
				if(cadenaX >= 1){
					
					alertify.log("ALERTA: INGRESO DE SOLICITUD/DES DE SOPORTE TECNICO: "+cadenaX); 
					return false;
					
				}
				
				
				
				
		} );
	
		
	}
}


//---------------------------------FIN ALERTAS--------------------------------------------------------

// Crea un intervalo cada 1000ms (1s)
var jClockInterval = setInterval(function(){
	notificacion_tutela();
}, 1000);


var jClockInterval_2 = setInterval(function(){
	notificacion_solicitudes_tecnicas();
}, 3000);
	
	
//-----------------------------------------------------------------------------------------------------------------------------------

</script>


<?php 
		
		if($cantregisALER >= 1){
		
			//60000 --> 1 minuto
			//6000 --> 6 segundos
			echo '<script languaje="JavaScript"> 
			
				
					notificacion();
					setInterval(notificacion, 6000);
											
													
				</script>';
		}	
		
	
?>

<!-- PARA QUE CARGUE LA VENTANA DEL POPUPBOX Y BLOQUIE EL FONDO -->
<div id ="block"></div>
<div id ="popupbox"></div>

<!-- <area shape="rect" coords="IZQUIERDA,ARRIBA,DERECHA,ABAJO" href="index.php?controller=menu&action=mod_notificacion" title="Notificacion"/> -->

<!-- <a href="index.php?controller=index&amp;action=close_session"><img src="views/images/crm_exit.png" alt="Cerrar Sesion" title="Cerrar Sesion"/></a> -->

<!-- <img src="views/images/menu_admin4x.png" width="1800" height="590" border="0" usemap="#Map">  -->

<img src="views/images/menu_admin4x.png" usemap="#Map">

<div id="apDiv2"><?php echo strtoupper ($_SESSION['pantalla']);?></div>
<div id="apDiv3"><?php echo strtoupper ($_SESSION['nombre']) /*$_SESSION['nomusu']*/;?></div>
<div style="margin:-646px -190px 0px 1285px"><img src="<?php echo $_SESSION['foto'];?>" width="110" height="102"/></div> 

<map name="Map">
  

  <!-- FILA ARRIBA -->
  <!-- <area shape="rect" coords="17,71,160,180" href="index.php?controller=correspondencia&amp;action=listarDocumentos" title="Correspondencia"> -->
  
   <area shape="rect" coords="1374,67,1456,150" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
  
  
   <?php
   //ID USUARIOS PERTENECIENTES AL JUZGADO J1, J2 QUE NO PUEDEN ENTRAR A OTRO MODULO QUE NO SEA SIEPRO
  if ( in_array($_SESSION['idUsuario'],$usuarios_ADMIN_2_JUZGADO,true) ) { 
   
  ?>
  
  		<!-- <area shape="rect" coords="17,71,160,180" href="index.php?controller=correspondencia&amp;action=listarDocumentos" title="Correspondencia"> -->
		
  <?php }
  else{ ?>
  
  		<!-- <area shape="rect" coords="17,51,160,230" href="index.php?controller=correspondencia&amp;action=listarDocumentos" title="Correspondencia"> -->
		<area shape="rect" coords="176,210,360,395" href="index.php?controller=correspondencia&amp;action=listarDocumentos" title="Correspondencia" style="border-color:#FF0000 ">
		
		<area shape="rect" coords="684,210,868,395" <?php if($_SESSION['tipo_perfil']=='admin'){?>href="index.php?controller=menu&amp;action=mod_consulta"<?php }?> title="Novedades Justicia XXI" />

		
		<?php
		if ( in_array($_SESSION['idUsuario'],$usuariosa_OBS_2X,true) ) { 
		   
		?>
		
  					<area shape="rect" coords="938,210,1120,395" href="index.php?controller=alerta&action=Listar_Tutelas" title="Entradas Tutelas"/>
					
					
			
			
		<?php }else{ ?>
		
					<area shape="rect" coords="938,210,1120,395" href="index.php?controller=caratula&action=Caratula" title="Entradas Tutelas"/>
		<?php } ?>
		 
		 
				
		<?php
		if ( in_array($_SESSION['idUsuario'],$usuarios_ADMIN_2,true) ) { 
		   
		?>
				<area shape="rect" coords="682,430,865,614" href="index.php?controller=archivo&action=Adicionar_Accion_2" title="Gestion de Calidad" />
		<?php }
  		else{ ?>
				<area shape="rect" coords="682,430,865,614" href="index.php?controller=archivo&action=Gestionar_Actividad" title="Gestion de Calidad" />
		<?php } ?>
		 
		
  <?php } ?>
  
  
 
  <!-- <area shape="rect" coords="168,65,330,190" href="index.php?controller=menu&amp;action=mod_archivo" title="Archivo" /> -->
  
  <area shape="rect" coords="430,210,614,395" href="index.php?controller=archivo&amp;action=listarUbicacionExpediente" title="Archivo" />
  
  
  
  <!-- FILA ABAJO -->
  
 <!--  <area shape="rect" coords="16,190,154,295" href="index.php?controller=menu&amp;action=mod_liquidaciones" title="Liquidaciones" /> -->
  <area shape="rect" coords="176,430,360,614" href="index.php?controller=liquidaciones2&amp;action=Liquidar_Costas" title="Liquidaciones" />
  
  
  <!-- CONTROL EMPLEADOS, SE CIERRA LINK PARA SER ACTUALIZADO -->
 <!--  <area shape="rect" coords="180,192,318,300" <?php //if($_SESSION['tipo_perfil']=='admin'){?> href="index.php?controller=menu&amp;action=mod_empleados"<?php //}?> title="Control Empleados" /> -->  
  
  <area shape="rect" coords="428,430,610,614" href="index.php?controller=reps&amp;action=regIngresoSalida" title="Control Empleados"/>
  
  
  
  <?php
  if ( in_array($_SESSION['idUsuario'],$usuarios_ADMIN_2,true) ) { 
   
  ?>
  
  		<area shape="rect" coords="936,430,1120,612" href="index.php?controller=administrar&amp;action=Administrar_Archivo" title="Administracion" />
		
  <?php }
  else{ ?>
  
  		<area shape="rect" coords="936,430,1120,612" href="index.php?controller=hojavida&action=Administrar_HojaVida" title="Administracion" />
		
  <?php } ?>
  
 
  
  <!-- <area shape="rect" coords="176,646,360,830" href="index.php?controller=liquidaciones2&amp;action=Liquidar_Costas" title="Soporte" />  -->
  
 <area shape="rect" coords="176,646,360,830" class="generar_soporte" title="Modulo para realizar las solicitudes de soporte tecnico, en cuanto a temas de sistemas"/>
  
   
 
  
 	<?php
		if( in_array($_SESSION['idUsuario'],$usuariosaAUDI2X,true) ){
   	?>
			
			<!-- <area shape="rect" coords="428,642,612,826" href="index.php?controller=liquidaciones2&amp;action=Liquidar_Costas" title="Programador Audiencias" /> -->
			
			<area shape="rect" coords="428,642,612,826" class="programar_audiencia" title="Programador Audiencias"/> 
			
	<?php
		}
	?>
  
  
  
  
  <area shape="rect" coords="1214,458,1444,508" href="index.php?controller=menu&amp;action=mod_configuracion" title="Configuraci&oacute;n">
  
  
  
</map>

