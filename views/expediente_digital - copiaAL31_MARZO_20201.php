
<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new archivoModel();
	

	
	//ESTA PARTE RECIBE ENVIADAS DE LA VISTA archivo_modificarOtro.php
	$datosexp      = explode("******",trim($_GET['datosexp']));
	
	$id_radi  = trim($datosexp[0]);//id radicado
	$nradi    = trim($datosexp[1]);//radicado
	$id_folio = trim($datosexp[3]);//id folio
	
	
	
	
	//REGISTRAR FOLIO(S)
	if(trim($datosexp[2]) == 1){

		echo '<script languaje="JavaScript"> 
									
											
				var idradi = "'.$id_radi.'";	
				var radi   = "'.$nradi.'";	
				
				
				alert("1-PROCESO SE REALIZA CORRECTAMENTE, ID RADICADO:  "+idradi+" RADICADO: "+radi);
											
								
			</script>';
	
	}
	
	//EDITAR FOLIO
	if(trim($datosexp[2]) == 2){

		echo '<script languaje="JavaScript"> 
									
											
				var idradi = "'.$id_radi.'";	
				var radi   = "'.$nradi.'";	
				
				var id_folio   = "'.$id_folio.'";	
						
											
				alert("2-PROCESO SE REALIZA CORRECTAMENTE, ID RADICADO:  "+idradi+" RADICADO: "+radi+" FOLIO: "+id_folio);
											
								
			</script>';
	
	}
	
	//ELIMINAR FOLIO
	if(trim($datosexp[2]) == 3){

		echo '<script languaje="JavaScript"> 
									
											
				var idradi = "'.$id_radi.'";	
				var radi   = "'.$nradi.'";	
				
				var id_folio   = "'.$id_folio.'";	
						
											
				alert("3-PROCESO SE REALIZA CORRECTAMENTE, ID RADICADO:  "+idradi+" RADICADO: "+radi+" FOLIO: "+id_folio);
											
								
			</script>';
	
	}
	
	/*$Jid_juzgado_3 = trim($datosJ_1[0]);//nombre juzgado
	$Jid_juzgado_4 = trim($datosJ_1[1]);//id juzgado
	$Jid_juzgado_5 = trim($datosJ_1[2]);//id juzgado justicia xxi
	$Jid_juzgado_6 = trim($datosJ_1[3]);//dias para realizar tarea puesta*/ 
	
	//echo $Jid_juzgado_6;
	
	//------------ESTAS VARIABLES MANEJAN LA RECARGA DE LA PAGINA--------
	//Y SE QUEDENE EN ELLA, AL DAR CLIC EN EL BOTON RECGARGAR
	$J2id_juzgado  = $_SESSION['id_juzgado'];
	$J2tipousuario = $_SESSION['tipousuario'];
	
	
	$Jid_juzgado_1x  = $modelo->get_despacho($J2id_juzgado);
	$Jid_juzgado_2x  = $Jid_juzgado_1x->fetch();
	$Jid_juzgado_3x	= trim($Jid_juzgado_2x[nombre]);
	$Jid_juzgado_4x	= trim($Jid_juzgado_2x[numero_juzgado]);
	$Jid_juzgado_5x	= trim($Jid_juzgado_2x[idjxxi]);
	$Jid_juzgado_6x	= trim($Jid_juzgado_2x[dias]);
	
	//echo $J2tipousuario;
	//echo $J2id_juzgado;
	
	//---------------------------------------------------------------------
	
	
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	$id_juzgado_user_devo = $_SESSION['id_juzgado'];
	
	$iddepartamento  =  $_SESSION['iddepartamento'];
	$idmunicipio     =  $_SESSION['idmunicipio'];
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//LISTA BASE DE DATOS LOCAL
	
	
	/*$nombrelista_2  = 'expe_cuaderno';
	$campoordenar_2 = 'id';
	$filtro_2       = "WHERE id IN(1,2)";
	$formaordenar_2 = '';
	$datosSERVI_2   = $modelo->get_lista_filtro($nombrelista_2,$campoordenar_2,$filtro_2,$formaordenar_2);*/
	
	
	
	$nombrelista_2  = 'expe_cuaderno';
	$campoordenar_2 = 'id';
	$datosSERVI_2   = $modelo->get_lista($nombrelista_2,$campoordenar_2);
	
	
	$nombrelista_3  = 'pa_usuario';
	$campoordenar_3 = 'empleado';
	$filtro_3       = "WHERE nombre_usuario NOT LIKE '%D%'";
	$formaordenar_3 = '';
	$datosEMPLE_3   = $modelo->get_lista_filtro($nombrelista_3,$campoordenar_3,$filtro_3,$formaordenar_3);
	
	
	$nombrelista_4  = 'pa_usuario';
	$campoordenar_4 = 'empleado';
	$filtro_4       = "WHERE nombre_usuario NOT LIKE '%D%'";
	$formaordenar_4 = '';
	$datosEMPLE_4   = $modelo->get_lista_filtro($nombrelista_4,$campoordenar_4,$filtro_4,$formaordenar_4);
	
	
	$nombrelista_5  = 'pa_juzgado';
	$campoordenar_5 = 'nombre';
	$filtro_5       = 'WHERE id IN (15,16)';
	$formaordenar_5 = '';
	$datosjuzgado_5 = $modelo->get_lista_filtro($nombrelista_5,$campoordenar_5,$filtro_5,$formaordenar_5);
	
	
	
	
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//IDENTIFICA SI EL USUARIO EN SESION PERTENECE A UN JUZGADO
	//Y SOLO VISUALIZARA LAS DEMANDAS REPARTIDAS A ESE JUZGADO
	//$id_juzgado_user = $_SESSION['id_juzgado'];
	
	//echo $id_juzgado_user;
	
	
	//DATOS ACCION		
	$opcion = trim($_GET['dato_0']);
	
	//VECTOR QUE ALMACENA LA RUTA DE LOS
	//ARCHIVOS PARA SER DESCARGADOS
	$ruta_descarga  = array();
	
	if($opcion == 1){
	
	
		$datosexp_2      = explode("******",trim($_GET['datosexp_2']));
	
		$id_radi = trim($datosexp_2[0]);//id radicado
		$nradi   = trim($datosexp_2[1]);//radicado
	
		
		$datosACCION_1 = $modelo->listar_proceso_digital_filtro($id_radi);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_proceso_digital_filtro($id_radi);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
			
			//SE CONCATENA LA RUTA DE TODOS LOS DOCUMENTOS QUE 
			//CONFORMAN EL EXPEDIENTE DIGITAL, PARA GENERAR 
			//UN LINK DE DESCARGA UNICO DE TODOS ELLOS EN .ZIP 
			//$ruta_descarga = $fila_cant[ruta]."******".$ruta_descarga;
			
			$ruta_descarga[] = $fila_cant[ruta];
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
		
		
		//DETERMINAR SI SE ESTA HACIENDO LA CONSULTA A ESTADO
		//Y AGREGAR MAS COLUMNAS A LA TABLA DE DOCUMENTOS
		$datosACCION_2 = $modelo->listar_proceso_digital_filtro($id_radi);
		
		while($fila_2 = $datosACCION_2->fetch()){
				
				
			$idradicadoestado_2  = $fila_2[idradicadoestado];
			
		}
		
		

	}
	else{
	
	
		$datosACCION_1 = $modelo->listar_proceso_digital($id_radi);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_proceso_digital($id_radi);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
			
			
			//SE CONCATENA LA RUTA DE TODOS LOS DOCUMENTOS QUE 
			//CONFORMAN EL EXPEDIENTE DIGITAL, PARA GENERAR 
			//UN LINK DE DESCARGA UNICO DE TODOS ELLOS EN .ZIP 
			//$ruta_descarga = $fila_cant[ruta]."******".$ruta_descarga;
			
			$ruta_descarga[] = $fila_cant[ruta];
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
		
		
	
	}
	
	
	//DETERMINAR SI UN PROCESO TIENE ACUMULADA, SE VISUALIZA BOTON
	$tiene_acu_1  = $modelo->get_tiene_acumulada($id_radi);
	$tiene_acu_2  = $tiene_acu_1->fetch();
	$tiene_acu_3  = trim($tiene_acu_2[tieneacumulada]);
	
	
	//DETERMINAR SI UN PROCESO ESTA ACUMULAD0 A OTRO PROCESO, SE VISUALIZA BOTON
	$tiene_acu_4  = $modelo->get_tiene_acumulada_2($id_radi);
	$tiene_acu_5  = $tiene_acu_4->fetch();
	$tiene_acu_6  = trim($tiene_acu_5[tieneacumuladaproc]);
	
	
	//ACCIONES 
	
	//******************ID USUARIOS QUE PUDEN EDITAR Y ELIMINAR FOLIOS DEL EXPEDIENTE DIGITAL, SIN SER LOS USUARIOS QUE CREARON EL REGISTRO***************
	$campos              = 'usuario';
	$nombrelista         = 'pa_usuario_acciones';
	$idaccion	         = '31';
	$campoordenar        = 'id';
	$datosusuarioEXPDIGI = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuariosEXPDIGI1    = $datosusuarioEXPDIGI->fetch();
	$usuariosaEXPDIGI2	 = explode("////",$usuariosEXPDIGI1[usuario]);
	
	$bandera_ADMIN      = 0;
	
	if ( in_array($_SESSION['idUsuario'],$usuariosaEXPDIGI2,true) ){
	
		$bandera_ADMIN = 1;
	}	
	
//******************FIN ID USUARIOS QUE PUDEN EDITAR Y ELIMINAR DOLIOS DEL EXPEDIENTE DIGITAL, SIN SER LOS USUARIOS QUE CREARON EL REGISTRO***************

//******************ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	  = '37';
	$campoordenar = 'id';
	$admin_expe   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_expe_1 = $admin_expe->fetch();
	$admin_expe_2 = explode("////",$admin_expe_1[usuario]);
	
	$bandera_ADMIN_EXPE = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_expe_2,true) ){
	
		$bandera_ADMIN_EXPE = 1;
	}	
	
//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************

//******************ID USUARIOS, PARA VISUALIZAR MEMORIALES RADICADOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	  = '38';
	$campoordenar = 'id';
	$admin_memo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_memo_1 = $admin_memo->fetch();
	$admin_memo_2 = explode("////",$admin_memo_1[usuario]);
	
	$bandera_ADMIN_MEMO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_memo_2,true) ){
	
		$bandera_ADMIN_MEMO = 1;
	}	
	
//******************FIN ID USUARIOS, PARA VISUALIZAR SOLICITUDES DE EXPEDIENTES A DIGITALIZAR Y CREAR USUARIOS PARA LA CONSULTA DE EXPEDIENTES POR ABOGADOS***************


//******************ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	    = '39';
	$campoordenar   = 'id';
	$admin_titulo   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$admin_titulo_1 = $admin_titulo->fetch();
	$admin_titulo_2 = explode("////",$admin_titulo_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_ADMIN_TITULO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$admin_titulo_2,true) ){
	
		$bandera_ADMIN_TITULO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
//******************FIN ID USUARIOS, PARA VISUALIZAR PROGRAMACION Y CONSULTA DE TITULOS DESDE LA PLATAFORMA PUBLICACIONES***************

//******************ID USUARIOS, QUE VISUALIZAN LA ALERTA DE SOLICITUD DE USURIOS DESDE EL PORTAL PUBLICACIONES***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	   = '40';
	$campoordenar  = 'id';
	$soli_user     = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$soli_user_1   = $soli_user->fetch();
	$soli_user_2   = explode("////",$soli_user_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_SOLICITUD_USUARIO = 0;
	
	if ( in_array($_SESSION['idUsuario'],$soli_user_2,true) ){
	
		$bandera_SOLICITUD_USUARIO = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
//******************FIN ID USUARIOS, QUE VISUALIZAN LA ALERTA DE SOLICITUD DE USURIOS DESDE EL PORTAL PUBLICACIONES***************


//******************ID USUARIOS, QUE NO VISUALIZAN EL MENU ADMINISTAR***************
	//$campos              = 'usuario';
	//$nombrelista         = 'pa_usuario_acciones';
	$idaccion	   = '41';
	$campoordenar  = 'id';
	$soli_NOAD     = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$soli_NOAD_1   = $soli_NOAD->fetch();
	$soli_NOAD_2   = explode("////",$soli_NOAD_1[usuario]);
	
	//print_r($admin_memo_2);
	
	$bandera_NO_ADMIN = 0;
	
	if ( in_array($_SESSION['idUsuario'],$soli_NOAD_2,true) ){
	
		$bandera_NO_ADMIN = 1;
	}	
	
	//echo $bandera_ADMIN_MEMO;
	
//******************FIN ID USUARIOS, QUE NO VISUALIZAN EL MENU ADMINISTAR***************


//******************ID USUARIOS, QUE VISUALIZAN BOTONES CARGAR INDICE ELECTRONICO Y LISTAR INDICE ELECTRONICO, Y REALIZAR DICHAS TAREAS***************
$idaccion	  = '49';
$campoordenar = 'id';
$datos_49_1   = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_49_2   = $datos_49_1->fetch();
$datos_49_3	  = explode("////",$datos_49_2[usuario]);
		
$bandera_49   = 0;
		
if ( in_array($_SESSION['idUsuario'],$datos_49_3,true) ){
		
	$bandera_49 = 1;
}	
//******************FIN ID USUARIOS, QUE VISUALIZAN BOTONES CARGAR INDICE ELECTRONICO Y LISTAR INDICE ELECTRONICO, Y REALIZAR DICHAS TAREAS***************

//CANTIDAD FOLIOS

$Nfolios   = $modelo->nfolios_proceso($id_radi);
$Nfolios_2 = $Nfolios->fetch();
$Nfolios_3 = $Nfolios_2[nfolios];


//CANTIDAD CUADERNOS

$NCuadernos = $modelo->ncuadernos_proceso($id_radi);

//ACTUACIONES DEL PROCESO DESDE JUSTICIA XXI
$actus = $modelo->get_Actuaciones_JusticiaXXI($nradi);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>EXPEDIENTE DIGITAL</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->




        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
		<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
		<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
		<!-- ---------------------------------------------------------------------------------------------------------------------------- -->
		
		<!-- ALERTAS -->
		<script src="views/js/alertify.js" type="text/javascript" charset="utf-8"></script>
		<link href="views/css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
		<link href="views/css/alertify.core.css" rel="stylesheet" type="text/css">
		<link href="views/css/alertify.default.css" rel="stylesheet" type="text/css">
		<!-- FIN ALERTAS -->
		


<script type="text/javascript">

//---------------------------------ALERTAS--------------------------------------------------------

function solicitudes_usuarios(){
    //una notificación normal
	
	//var iduser = "<?php echo $idusuario; ?>" ;
	
	var bsu = "<?php echo $bandera_SOLICITUD_USUARIO; ?>" ;
	
	//alert(iduser);
	
	//if(iduser == 2 || iduser == 182 || iduser == 2284){
	if(bsu == 1){
	
	
		$.get("funciones/publicaciones_solicitudes_usuario.php", function(cadenaX){
				
	
				
				if(cadenaX >= 1){
					
					alertify.log("ALERTA - INGRESO DE SOLICITUD DE USUARIO: "+cadenaX+" ,DIRIGIRSE AL MENU ADMINISTRAR/ADMINISTRAR-USUARIO/PROCESAR SOLICITUDES USURIO"); 
					return false;
					
				}
				
				
				
				
		} );
	
		
	}
}


//---------------------------------FIN ALERTAS--------------------------------------------------------

//LLAMADO ALERTAS

// Crea un intervalo cada 5000ms (5s)
var jClockInterval = setInterval(function(){
	solicitudes_usuarios();
}, 5000);

//FIN LLAMADO ALERTAS


</script>


<script type="text/javascript">

$(document).ready(function() {



	//-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mie','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
	 weekHeader: 'Sm',
	 dateFormat: 'yy-mm-dd',
	 firstDay: 1,
	 isRTL: false,
	 showMonthAfterYear: false,
	 yearSuffix: '',
	 showWeek: true,
	 showButtonPanel: true,
	 changeMonth: true,
	 changeYear: true
	 };
	 $.datepicker.setDefaults($.datepicker.regional['es']);
	 //-------------------------------------------------------------------------------------------------------------------------------------------
	 
	 $("#filtro2").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 $("#filtro3").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	 
	$('#fila_cargando').hide(); 
	 
	//LISTA JUZGADO OCULTA, SOLO CUANDO SE DA CLIC PARA ESTADO 
	$('#paraestado').hide();
	
	//CAMPO PARA ACUMULADA OCULTO
	$('#paraacumulada').hide();
	 
	 
	$("#checkEstado").change(function () {
		  
		  
		  
		  if($("#checkEstado").is(':checked')) {  
		  
		  	$('#paraestado').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraestado').hide();
		  }
		
	});
	
	$("#checkdevo").change(function () {
		  
		  
		  
		  if($("#checkdevo").is(':checked')) {  
		  
		  	$('#paraestado').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraestado').hide();
		  }
		
	});
	
	$("#checkAcumulada").change(function () {
		  
		  
		  
		  if($("#checkAcumulada").is(':checked')) {  
		  
		  	$('#paraacumulada').show();
		  
		  }
		  else{
		  
		  	//alert("no");
			
			$('#paraacumulada').hide();
		  }
		
	});
	
	
	$(".acumular_proceso").click(function(evento){
	
	
	
		//PASOMOS VARIABLES PHP A JAVASCRIPT
		var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		
		var datosexp = id_radi+"******"+nradi;
	
		if($('#radiacu').val().length == 0) {
				
				alert("Definir Radicado a Acumular");
		
				document.getElementById('radiacu').style.borderColor  =  '#FF0000';
	
		
		}
		else{		
			
			if($('#radiacu').val().length == 23) {
			
				//$.get('funciones/traer_datos_radicado.php?idactu='+idactu+'&idusuarioX='+idusuarioX, function(idobs){	
				
				$.get('funciones/traer_datos_radicado.php?idradicado='+$('#radiacu').val(), function(datosradi){	
				
				
					var datosradi_1 = datosradi.split("//////");
					
					var datosradi_2 = datosradi_1[0];
				
					
					if(datosradi_2 >= 1){
						
						
						var data = new FormData();
									
						
						//DATOS RADICADO ACUMULADO AL PADRE
						data.append('idradiacumular',datosradi_2);
						data.append('radiacu',$('#radiacu').val());
						
						//DATOS RADICADO PADRE
						data.append('idradipadre',id_radi);
						data.append('nradi',nradi);
									
									
									
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
											
											
												
												
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
													
										//url:'views/popupbox/subir.php', //Url a donde la enviaremos
										url:'index.php?controller=archivo&action=Acumular_Proceso',
										type:'POST', //Metodo que usaremos
										contentType:false, //Debe estar en false para que pase el objeto sin procesar
										//data:dataString, //Le pasamos el objeto que creamos con los archivos
										data:data,
										processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
										cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
													
										$('.mensage_2').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
										$('.mensage_2').show('slow');//Mostramos el div.
													
										//DESAPARECER
										setTimeout(function() {
														
											$(".mensage_2").fadeOut(1500);
														
														
											location.href="index.php?controller=archivo&action=Expediente_Digital&datosexp="+datosexp;
														
														
														
										},3000);
													
												
							});
												
												
												
											
						}
						
						
					}
					else{
					
						alert("RADICADO NO EXISTE, NO ES POSIBLE REALIZAR LA ACUMULACION");
					
					}
					
				
				});
				
				
			}
			else{
			
					alert("EL RADICADO ACUMULAR DEBE SER DE 23 DIGITOS");
			
			}	
				
						
					
		}
	
			
				
								 
	});
	 
	 $("#revisado").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_Revisar_Procesos',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$("#norevisado").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_No_Revisar_Procesos',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	//ACCION EJECUTADA POR EL JUEZ
	$("#revisado2").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				//d9R  = document.getElementById("tsoli").rows[r].cells[9].innerText;//ID SERVIDOR
				d9R = $('#servi'+fR).find(':selected').val();
				
				//d10R = document.getElementById("tsoli").rows[r].cells[10].innerText;//AREA
				d10R = $('#area'+fR).val();
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						if( 
			
							   $('#servi'+fR).val().length == 0 
							   //$('#filtro2').val().length   == 0 &&
							  
							  
							   
						) {
								
								alert("Definir ASIGNAR A");
						
								//document.getElementById('#area'+fR).style.borderColor  =  '#FF0000';
								//$('#servi'+fR).css("color", "red");
								
								r = cantidad_filas_FR;
								
								idspermiso_real = 0;
								
								idspermisoR = " ";
								
								//fR = 1;
							
						}
						else{
							
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"//////"+d9R+"//////"+d10R+"******"+idspermisoR;
							
							idspermiso_real = 1;
						
						}
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS O FALTA SELECCIONAR INFORMACION DE LA TABLA";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
					var dias = "<?php echo $Jid_juzgado_6x; ?>";
					
					//alert(dias);
					
					var cadena_fechas = "";
					
					//CALCULO FECHA FINAL DE ACUERDO A LA FECHA ACTUAL
					//Y LOS DIAS PARAMETRIZADOS EN LA TABLA pa_juzgado
					//PARA QUE UN SERVIDOR JUDICIAL HAGA UN TRABAJO
					var fi;
					var fii;
					
					var ff;
					var fff;
					
					var fechaactual = $('#fechaactual').val()
					
					$.get('funciones/traer_fechas_despachos.php?fechat='+fechaactual+'&dias='+dias, function(fechas){
						
						//alert(fechas);
						
						var vector_fechas = fechas.split(" ");
						
						fi  = vector_fechas[0].split("/");
						fii = fi[2]+"-"+fi[1]+"-"+fi[0];
						
						//alert(fii);
						
						ff  = vector_fechas[1].split("/");
						fff = ff[2]+"-"+ff[1]+"-"+ff[0];
						
						//alert(fff);
						
						//cadena_fechas += "******"+fii+"//////"+fff;
						
						cadena_fechas += fii+"//////"+fff;
						
						//alert(cadena_fechas);
				
						$('#datos_soli').val('');
						$('#datos_soli').val(idspermisoR);
						
						dataString += '&datospartes='+$('#datos_soli').val();
						
						dataString += '&cadena_fechas='+cadena_fechas;
						
						//alert(dataString);
					
						//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
						
						//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
						
						
						
						/*Ejecutamos la función ajax de jQuery*/		
						$.ajax({
							
							//url:'views/popupbox/subir.php', //Url a donde la enviaremos
							url:'index.php?controller=archivo&action=Realizar_Revisar_Procesos_2',
							type:'POST', //Metodo que usaremos
							//contentType:false, //Debe estar en false para que pase el objeto sin procesar
							data:dataString, //Le pasamos el objeto que creamos con los archivos
							//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
							cache:false //Para que el formulario no guarde cache
						}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
							
							$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
							$('.mensage').show('slow');//Mostramos el div.
							
							//DESAPARECER
							setTimeout(function() {
								
								$(".mensage").fadeOut(1500);
								
								//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
								
								var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
								var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
								var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
								var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
								
								location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
								
							},3000);
							
						
						});
						
					
					
					});// $.get('funciones/traer_fechas_obs.php?fechat='+dato5_ra, function(fechas){
				
				}
				
				
			}
								 
	});
	
	
	$("#norevisado2").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;//ID ACTU
				d1R  = document.getElementById("tsoli").rows[r].cells[1].innerText;//ID RADICADO
				d2R  = document.getElementById("tsoli").rows[r].cells[2].innerText;//RADICADO
				
				//d9R  = document.getElementById("tsoli").rows[r].cells[9].innerText;//ID SERVIDOR
				//d9R = $('#servi'+fR).find(':selected').val();
				
				//d10R = document.getElementById("tsoli").rows[r].cells[10].innerText;//AREA
				//d10R = $('#area'+fR).val();
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						
						
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"//////"+d2R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla PROCESOS O FALTA SELECCIONAR INFORMACION DE LA TABLA";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_No_Revisar_Procesos_2',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
							var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
							var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
							var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
							
							location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$(".cerrar_tarea").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				var idusuarioX = "<?php echo $idusuario ; ?>";
				
				var idactu = $(this).attr('data-id');
				var idfila = $(this).attr('data-idfila');
				
				var bandera = 0;
				
				$.get('funciones/traer_obs_asignada.php?idactu='+idactu+'&idusuarioX='+idusuarioX, function(idobs){
						
				//alert(idobs);
				
				if(idobs >= 1){
					
					bandera = 1;
				
				}
				
				if(bandera == 0){
				
					alert("NO ES POSIBLE CERRAR TAREA, TAREA ESTA ASIGNADA A OTRO SERVIDOR JUDICIAL");
				
				}
				else{
				
				
				if( $('#cerrart'+idfila).val().length == 0  ){
								
					alert("Definri en el Campo Cerrar");
					
					//$('#cerrart'+idfila).val('');
				}
				else{		
				
				
				var data = new FormData();
				
				data.append('idactu',idactu);
				data.append('tareacerrada',$('#cerrart'+idfila).val());
				
				
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							
							
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=archivo&action=Cerrar_Tarea',
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								//data:dataString, //Le pasamos el objeto que creamos con los archivos
								data:data,
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								
								$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
								$('.mensage').show('slow');//Mostramos el div.
								
								//DESAPARECER
								setTimeout(function() {
									
									$(".mensage").fadeOut(1500);
									
									
									//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
									
									var Jid_juzgado_3x = "<?php echo $Jid_juzgado_3x; ?>";
									var Jid_juzgado_4x = "<?php echo $Jid_juzgado_4x; ?>";
									var Jid_juzgado_5x = "<?php echo $Jid_juzgado_5x; ?>";
									var Jid_juzgado_6x = "<?php echo $Jid_juzgado_6x; ?>";
									
									location.href='index.php?controller=archivo&action=Adimistrar_Procesos_Despacho&datosJ=<?php echo $Jid_juzgado_3x; ?>******<?php echo $Jid_juzgado_4x; ?>******<?php echo $Jid_juzgado_5x; ?>******<?php echo $Jid_juzgado_6x; ?>';
									
									
									
								},3000);
								
							
							});
							
							
							
						
				}
				
				}
				
				}
				
				});
								 
		});
	
	
	
	
	 
	 $("#filtro4 ").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro4 ").find(':selected').val();
						
		$("#filtro6").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+4);
					
						
	});
	
	 $("#filtro6").change(function(event){
	
		//alert("entre");
    	
		var id = $("#filtro6").find(':selected').val();
						
		$("#filtro7").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+2);
					
						
	});
	
	$("#filtro7").change(function(event){
	
		//alert("entre");
		
		var iddpto = "<?php echo $iddepartamento; ?>";
		var idmuni = "<?php echo $idmunicipio; ?>";
    	
		var id = $("#filtro7").find(':selected').val();
						
		$("#filtro5").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+5+"&iddpto="+iddpto+"&idmuni="+idmuni);
					
						
	});


	$('#exampleModal').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACUMULADA(S) AL PROCESO: ' + recipient)
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(1);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_acumulada.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			//alert(json.length);
			
			//alert(json);
			
			for(var i=0;i<json.length;i++)
			{
				
				//alert(json[i].id);
				
				if(json[i].digitalizado == 1){
				
					var digi = 'SI';
					
					var datosexpF = json[i].id+"******"+json[i].radicado;
				
				}
				else{
				
					var digi = 'NO';
				}
				
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='radicado'>"+json[i].radicado+"</td>"
					registro+="<td class='digitalizado'>"+digi+"</td>"
					
					
					if(json[i].digitalizado == 1){
				
						
						registro+="<td class='ruta'><a href="+ 'index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF +"><button class='btn btn-default'><span class='glyphicon glyphicon-folder-open'></span></button></a></td>"
					
					}
					else{
					
						registro+="<td>-</td>"
						
					}
						
				registro+="</tr>"
					
					
				$('.editinplace').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_2').on('show.bs.modal', function (event) {
	
	  	var button    = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient = button.data('whatever') // Extract info from data-* attributes
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('PROCESO: ' + recipient +' ACUMULADO A')
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(2);

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_acumulada_2.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			//$( ".editinplace" ).remove();
			
			/*registro = "";
			$(".editinplace").removeClass();
			$(".editinplace").addClass();*/
			
			for(var i=0;i<json.length;i++)
			{
				
				
				if(json[i].digitalizado == 1){
				
					var digi = 'SI';
					
					var datosexpF = json[i].id+"******"+json[i].radicado;
				
				}
				else{
				
					var digi = 'NO';
				}
				
				
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='radicado'>"+json[i].radicado+"</td>"
					registro+="<td class='digitalizado'>"+digi+"</td>"
					
					
					if(json[i].digitalizado == 1){
				
						
						registro+="<td class='ruta'><a href="+ 'index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexpF +"><button class='btn btn-default'><span class='glyphicon glyphicon-folder-open'></span></button></a></td>"
					
					}
					else{
					
						registro+="<td>-</td>"
						
					}
						
				registro+="</tr>"
					
					
				$('.editinplace_2').append(registro);
				
				registro = "";
			}
			
		});
	  
	  
	  
	  
	  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_3').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('SOLICITUDES DE DIGITALIZACION DE EXPEDIENTES: '+ recipient_2[1]);
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(3);

		/* OBTENEMOS TABLA */
		
		var tabla_actu =  recipient_2[0].split("******");
		
		for(var i=0;i<tabla_actu.length - 1;i++){
		
			tabla_actu_2 = tabla_actu[i].split("//////");
			
			ds0x = tabla_actu_2[0];	
			ds1x = tabla_actu_2[1];
			ds2x = tabla_actu_2[2];
			ds3x = tabla_actu_2[3];
			ds4x = tabla_actu_2[4];
			ds5x = tabla_actu_2[5];
			ds6x = tabla_actu_2[6];
			ds7x = tabla_actu_2[7];
			
			
			registro+="<tr>"
						
				registro+="<td class='ds0x'>"+ds0x+"</td>"
				registro+="<td class='ds0x'>"+ds7x+"</td>"
				registro+="<td class='ds1x'>"+ds1x+"</td>"
				registro+="<td class='ds2x'>"+ds2x+"</td>"
				registro+="<td class='ds3x'>"+ds3x+"</td>"
				registro+="<td class='ds4x'>"+ds4x+"</td>"
				registro+="<td class='ds5x'>"+ds5x+"</td>"
				registro+="<td class='ds6x'>"+ds6x+"</td>"
				
				registro+="<td class='ruta'><a href="+ 'index.php?controller=archivo&action=edit_archivoOtro&nombre='+ds7x+"><button class='btn btn-default'><span class='glyphicon glyphicon-folder-open'></span></button></a></td>"
					
				
			registro+="</tr>"
					
					
			$('.editinplace_3').append(registro);
				
			registro = "";
			
		}
		
		/*$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_actuaciones.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			
			
			for(var i=0;i<json.length;i++)
			{
				
				
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='empleado'>"+json[i].empleado+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_4').append(registro);
				
				registro = "";
			}
			
		});*/
	  
	  
  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	$('#exampleModal_4').on('show.bs.modal', function (event) {
	
	  	var button      = $(event.relatedTarget) // Button that triggered the modal
	  	var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
	  	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	 	 // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  	var modal = $(this)
	  	modal.find('.modal-title').text('ACTUACIONES EXPEDIENTE: ' + recipient_2[0])
	  	//modal.find('.modal-body input').val(recipient)
	  
	  	//alert(recipient);
		
		
		
	  	var registro;
		
		Eliminar_Tabla(4);

		/* OBTENEMOS TABLA */
		
		var tabla_actu = recipient_2[1].split("******");
		
		for(var i=0;i<tabla_actu.length - 1;i++){
		
			tabla_actu_2 = tabla_actu[i].split("//////");
			
			A110CONSACTU = tabla_actu_2[0];	
			A110FECHREGI = tabla_actu_2[1];
			A110DESCACTU = tabla_actu_2[2];
			
			
			registro+="<tr>"
						
				registro+="<td class='A110CONSACTU' style='text-align:center'>"+A110CONSACTU+"</td>"
				registro+="<td class='A110FECHREGI' style='text-align:center'>"+A110FECHREGI+"</td>"
				registro+="<td class='A110DESCACTU' style='text-align:center'>"+A110DESCACTU+"</td>"
				
			registro+="</tr>"
					
					
			$('.editinplace_4').append(registro);
				
			registro = "";
			
		}
		
		/*$.ajax({
			type: "GET",
			url: "views/popupbox/expediente_digital_actuaciones.php?tabla=1",
			data: { recipient: recipient }
		})
		.done(function(json) {
		
			json = $.parseJSON(json);
			
			
			
			for(var i=0;i<json.length;i++)
			{
				
				
					
				registro+="<tr>"
						
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='fecha'>"+json[i].fecha+"</td>"
					registro+="<td class='observacion'>"+json[i].observacion+"</td>"
					registro+="<td class='empleado'>"+json[i].empleado+"</td>"
					
				registro+="</tr>"
					
					
				$('.editinplace_4').append(registro);
				
				registro = "";
			}
			
		});*/
	  
	  
  
	  
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	$('#exampleModal_100').on('show.bs.modal', function (event) {
	
	
		$('#archivoie').val('');
		
		var idusuario = "<?php echo $idusuario; ?>";
		
		var button      = $(event.relatedTarget) // Button that triggered the modal
		var recipient   = button.data('whatever') // Extract info from data-* attributes
		var recipient_2 = recipient.split('*/*/*')
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.modal-title').text('CARGA INDICE ELECTRONICO EXPEDIENTE: ' + recipient_2[0])
		//modal.find('.modal-body input').val(recipient)
		$('#id_radi_ie').val(recipient_2[1]);
				
				
	})//FIN $('#exampleModal').on('show.bs.modal', function (event) {
	
	
	
	$("#cargar_indice").click(function(evento){
	
	
		var dataString = "";
		var validar    = 0;
		
		
		if( $('#archivoie').val() == null || $('#archivoie').val().length == 0 || /^\s+$/.test($('#archivoie').val()) ) {
				
			msg = "Defina Archivo";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&archivoie='+$("#archivoie").val();
					
		}
		
		if( $('#id_radi_ie').val() == null || $('#id_radi_ie').val().length == 0 || /^\s+$/.test($('#id_radi_ie').val()) ) {
				
			msg = "Defina Id Radicado (Campo Oculto)";
			$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_memo').show('slow');
					
			setTimeout(function() {
				$(".mensage_memo").fadeOut(4000);
			},10000);
					
			validar = 1;
					
			return false;
					
		}
		else{
		
			dataString += '&id_radi_ie='+$("#id_radi_ie").val();
					
		}
		
		//SE DEFINEN TODOS LOS CAMPOS DEL FORMULARIO
		if(validar == 0){
		
		
			var inputFileImage = document.getElementById("archivoie");
			var file           = inputFileImage.files[0];
						
			//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivodda'
			var archivos = document.getElementById("archivoie");
						
			//Obtenemos los archivos seleccionados en el imput
			var archivo  = archivos.files;
						
			//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
			//Y EL RESTO DE CAMPOS VIA POST
			var data = new FormData();
						
					
			//VALIDAR ARCHIVO, SOLO PERMITE NOMBRES CON NUMEROS,LETRAS Y TODO PEGADO,
			//NO PERMITE NOMBRES CON ACENTOS, ESPACIOS Y CON CARACTERES ESPECIALES
						 
			var nom_archivo    = 0;
						
			var caracter       = "";
			var caracter2       = "";
			var nombre_archivo = "";
						
			var nombre_archivo_2 = "";
			var tipo_archivo     = "";
						
						
			//-----------------VALIDAMOS QUE LOS ARCHIVOS SEAN PDF Y NO TENGAN ESPACIOS Y CARACTERES RAROS EN SUS NOMBRES---------------------------------
			for(i=0; i<archivo.length; i++){
							
				//alert(archivo[i].type);
				nombre_archivo_2 = archivo[i].name
				tipo_archivo     = archivo[i].type;
							
				//if(tipo_archivo == 'application/pdf'){
				if(tipo_archivo == 'application/vnd.ms-excel'){//.CSV(DELIMITADO POR COMAS)
							
					nombre_archivo = archivo[i].name;
								
					for (var x = 0; x<nombre_archivo.length; x++) {
								
								
						//alert("entre 2");
									
						//CAPTURA CARACTER
						caracter2 = nombre_archivo.charAt(x);
									 
						//CAPTUTA ASCII CARACTER
						caracter = nombre_archivo.charCodeAt(x);
									 
		
						//alert(caracter+" "+caracter2);
									 
							
						if( 
										
									 	 
								(caracter >= 32 && caracter <= 45)   ||
								(caracter >= 47 && caracter <= 47)   || 
								(caracter >= 58 && caracter <= 64)   || 
								(caracter >= 91 && caracter <= 96)   || 
								(caracter >= 123 && caracter <= 254)  
									     
						 ) {
										
										
								nom_archivo = 1;
											 
								$('#archivoie').val('');
											
								i = archivo.length;
											
								x = nombre_archivo.length;
											
				 
								alert("CARACTER NO PERMITIDO EN EL NOMBRE DEL ARCHIVO, EL NOMBRE DEL ARCHIVO DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO .CSV (delimitado por comas), NOMBRE ARCHIVO: "+nombre_archivo+", TIPO ARCHIVO: "+tipo_archivo);
								//return false;
										  
										 
							} 
									 
					}//FIN for (var x = 0; x<nombre_archivo.length; x++) {
								
								
				}//FIN if(tipo_archivo == 'application/pdf'){
				else{
							
						nom_archivo = 1;
										 
						$('#archivoie').val('');
										
						i = archivo.length
								
							 
						alert("ARCHVIO DEBE SER .CSV (delimitado por comas), NOMBRE ARCHIVO: "+nombre_archivo_2+", TIPO ARCHIVO: "+tipo_archivo);
										
							
				}
							
				if(nom_archivo == 0){
							
					data.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
				}
				
				
			}//FIN for(i=0; i<archivo.length; i++){
			
			//-----------------FIN VALIDAMOS QUE LOS ARCHIVOS SEAN PDF Y NO TENGAN ESPACIOS Y CARACTERES RAROS EN SUS NOMBRES---------------------------------
			
			
			//AL CARGAR LOS ARCHIVOS NO SE PRESENTO NINGUNA INCONSISTENCIA		
			if(nom_archivo == 0){
			
			
				data.append('id_radi_ie',$('#id_radi_ie').val());//ID RADICADO
				
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
										//OCULTAMOS BOTON REGISTRAR
										//PARA EVITAR QUE EL USUARIO DE CLIC
										//VARIAS VECES Y EL MEMORIAL SE DUPLIQUE
										$('#cargar_indice').hide();
										$('#cargar_indice').prop('disabled', 'disabled');
															
										$('#fila_cargando').show();
					
					
										//Ejecutamos la función ajax de jQuery		
										$.ajax({
											
											//url:'views/popupbox/subir.php', //Url a donde la enviaremos
											url:'index.php?controller=archivo&action=Cargar_Indice_Electronico',
											type:'POST', //Metodo que usaremos
											contentType:false, //Debe estar en false para que pase el objeto sin procesar
											//data:dataString, //Le pasamos el objeto que creamos con los archivos
											data:data,
											processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
											cache:false //Para que el formulario no guarde cache
										}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
											
											$('.mensage_memo').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
											$('.mensage_memo').show('slow');//Mostramos el div.
											
											//DESAPARECER
											setTimeout(function() {
											
												
												$(".mensage_memo").fadeOut(1500);
												
									
												$('#cargar_indice').show();
												$('#cargar_indice').prop('disabled', false);
												
												$('#fila_cargando').hide();
												
								
												//LIMPIAR CAMPOS VENTANA
												//NO SE BORRA PARA PODER SEGUIR CARGANDO 
												//Y NO SAQUE INCONSISTENCIAS, ESTE ES UN CAMPO OCULTO
												//$('#id_radi_ie').val('');
												$('#archivoie').val('');
												
												
			
												
											},3000);
											
										
										});					
					
				
				
				}//FIN if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
				
				
			}//FIN if(nom_archivo == 0){
		
		
		
		
		}//FIN IF VALIDAR == 0
	
	
	
	
	});
	
	$("#recargar_pro").click(function(evento){
	
		var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		var datosexp = id_radi+"******"+nradi;
		
		location.href='index.php?controller=archivo&action=Expediente_Digital&datosexp='+datosexp;
	
	
	});
	
	$("#buscar_pro").click(function(evento){
	
		//alert("BUSCANDO...");
		
		var id_radi = "<?php echo $id_radi; ?>";
		var nradi   = "<?php echo $nradi; ?>";
		
		var datosexp_2 = id_radi+"******"+nradi;
		
		
		//SI SELECCIONO PARA ESTADO O DEVOLUCION DESPACHO
		if( $("#checkEstado").is(':checked') || $("#checkdevo").is(':checked')) { 
		  
		  	if( 
				
			   $('#filtroestado').val().length == 0 || 
			   $('#filtro2').val().length      == 0 ||
			   $('#filtro3').val().length      == 0 
			  
			   
			  
			   
			) {
				
				alert("Definir Juzgado,Fecha Registro Inicial y Final");
		
				document.getElementById('filtroestado').style.borderColor  =  '#FF0000';
				document.getElementById('filtro2').style.borderColor  =  '#FF0000';
				document.getElementById('filtro3').style.borderColor  =  '#FF0000';
				
			}
			else{
				
				
				dato_0 = 1;
				
				//FECHAS REGISTRO
				dato_1 = $('#filtro2').val(); 
				dato_2 = $('#filtro3').val();
				
			   
				datox7 = $('#filtroestado').val();
				
				
				//PARA ESTADO
				if( $("#checkEstado").is(':checked') ) { 
				
					location.href="index.php?controller=archivo&action=Busquedad_Filtro_Expediente_2&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox7="+datox7+"&datosexp_2="+datosexp_2;
				
				}
				//PARA DEVOLUCION
				if( $("#checkdevo").is(':checked')) { 
				
					opcion = 15000;
				
					location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox7="+datox7;
				
				}
		
			}
			
		  
		}
		else{
		  
		 
			if( 
				
			   $('#filtro1').val().length   == 0 && 
			   $('#filtro2').val().length   == 0 &&
			   $('#filtro3').val().length   == 0 &&
			   $('#filtro4').val().length   == 0 &&
			   $('#filtro5').val().length   == 0 &&
			   $('#filtro6').val().length   == 0 &&
			   $('#filtro7').val().length   == 0 &&
			   $('#filtro8').val().length   == 0 
			   
			  
			   
			) {
				
				alert("Definir Algun Filtro Para Realizar la Busquedad");
		
				document.getElementById('filtro1').style.borderColor  =  '#FF0000';
				document.getElementById('filtro2').style.borderColor  =  '#FF0000';
				document.getElementById('filtro3').style.borderColor  =  '#FF0000';
				document.getElementById('filtro4').style.borderColor  =  '#FF0000';
				document.getElementById('filtro5').style.borderColor  =  '#FF0000';
				document.getElementById('filtro6').style.borderColor  =  '#FF0000';
				document.getElementById('filtro7').style.borderColor  =  '#FF0000';
				document.getElementById('filtro8').style.borderColor  =  '#FF0000';
				
				
			}
			else{
				
				//alert("BUSCANDO...");
		
		
				dato_0 = 1;
				
				//FECHAS REGISTRO
				dato_1 = $('#filtro2').val(); 
				dato_2 = $('#filtro3').val();
				
			   
				datox1 = $('#filtro1').val();
				datox2 = $('#filtro4').val();
				datox3 = $('#filtro5').val();
				datox4 = $('#filtro6').val();
				datox5 = $('#filtro7').val();
				datox6 = $('#filtro8').val();
				
				
				//alert(datox4);
				
				location.href="index.php?controller=archivo&action=Busquedad_Filtro_Expediente_2&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datosexp_2="+datosexp_2+"&datox5="+datox5+"&datox6="+datox6;
				
				
				/*if(datox4 == 'NULL'){
				
					if( $('#filtro2').val().length   == 0 && $('#filtro3').val().length   == 0 ) {
					
						alert("Definir Fecha Registro Inicial y Final Para Realizar la Busqueda");
						
						alert("NOTA: AL SELECIONAR ESTADO, EN PROCESO, DEFINIR FILTRO FECHA, PARA UN MEJOR AJUSTE EN LO QUE SE DESEA BUSCAR, SIN LAS FECHAS ES POSIBLE QUE EL SISTEMA CALCULE UNA GRAN CANTIDAD DE REGISTROS, PROCESANDO DE FORMA LENTA LA CONSULTA");
				
					
					}
					else{
					
						location.href="index.php?controller=archivo&action=Busquedad_Filtro&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
				
					}
				
				}
				else{
	
					location.href="index.php?controller=archivo&action=Busquedad_Filtro&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
				
				}*/
	
				
			}
		
		
		}
	
	});
	
	$("#registrar_devolucion").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				//var sola_UNA = "<?php echo $sola_UNA; ?>";
				
				var idevo = $(this).attr('data-id');
				
				
				
				//alert(idevo);
				
				//var dataString = "";

				//dataString += '&idevo='+idevo;
				
				//alert(dataString);
				
				var data = new FormData();
				
				data.append('idevo',idevo);
			
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							
							
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=demanda&action=Registrar_Devolucion',
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								//data:dataString, //Le pasamos el objeto que creamos con los archivos
								data:data,
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								
								$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
								$('.mensage').show('slow');//Mostramos el div.
								
								//DESAPARECER
								setTimeout(function() {
									
									$(".mensage").fadeOut(1500);
									
									var msgrespuesta = msg.split("-");
									
									if(msgrespuesta[0] == 1){
									
										location.href = "index.php?controller=demanda&action=Listar_Demandas_2";
									}
									
									
									
								},3000);
								
							
							});
							
							
							
						
				}
			
								 
		});
		
		$(".descarga_recibido").click(function(evento){
	
		
			var idrecibido = $(this).attr('data-idrecibido');
			
			window.open("views/tcpdf/RECIBIDO.php?iddda_acta="+idrecibido);

			
		});
	

	
});

</script>

<script type="text/javascript">

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(idtabla){
	
	if(idtabla == 1){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('acumulada');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	if(idtabla == 2){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('acumulada_2');
				
		cantidad_filas = TABLA.rows.length;
					
		for (r=1; r<cantidad_filas; r++){
			
			TABLA.deleteRow(r);
			cantidad_filas=TABLA.rows.length;
			r=1
		}
		
		if(cantidad_filas>1){
			TABLA.deleteRow(1);
		}
		
	}
	
	
	
}

</script>



<style type="text/css">

#mdialTamanio{
  width: 80% !important;
}
#mdialTamanio_3{
  width: 100% !important;
}
#mdialTamanio_5{
  width: 100% !important;
}


	
	
		.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
		.mensage_2{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
		.mensage_memo{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}


</style>


</head>

<body>


<input type="hidden" name="fechaactual" id="fechaactual" readonly="true" value ="<?php echo $fechaactual; ?>"/>
<input type="hidden" name="datos_soli" id="datos_soli" readonly="true"/>
<input type="hidden" name="id_radi_ie" id="id_radi_ie" readonly="true"/>


<!-- MENU DE ADMINISTRACION HORIZONTAL -->

<?php 

//SIEMPRE 1, PARA QUE TODOS LOS USUARIOS
//DE LA OFICINA LO VEAN Y SOLO LAS OPCIONES INTERNAS
//SE PARAMETIZEN PARA USUARIOS ESPECIFICOS
$bandera_ADMIN_EXPE = 1;

if($bandera_ADMIN_EXPE == 1){

?>
<nav class="navbar navbar-default">

  <div class="container-fluid">
   
    
    <div class="collapse navbar-collapse">
      

	  <?php
	  if($bandera_NO_ADMIN  == 0){
	  ?>	
      <ul class="nav navbar-nav navbar-left">
        
		
		
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrar<span class="caret"></span></a>
          <ul class="dropdown-menu">
		  
          
			 <li>
				
				<a class="glyphicon glyphicon-user" href="index.php?controller=usuario&action=Listar_Usuario_Menu" title="<?php echo utf8_decode("Administrar-Usuario"); ?>">
						
						
						<?php echo utf8_decode("Administrar-Usuario");?>
						
						
				</a>
				
			</li>
			
			
			<li role="separator" class="divider"></li>
			
			<li>
				<?php 
				
					//SE OBTIENEN LAS SOLICITUDES DE EXPEDIENTES A DIGITALIZAR
					$datos_SOLICITUDES = $modelo->get_SOLICITUD_DIGITALIZAR();
					$cadena_soli       ="";
					
					while($fila_soli = $datos_SOLICITUDES->fetch()){
				
						$ds1  = $fila_soli[id];
						$ds2  = $fila_soli[radicado];
						$ds3  = $fila_soli[empleado];
						$ds4  = $fila_soli[fecha];
						$ds5  = $fila_soli[hora];
						$ds6  = $fila_soli[esabogado];
						$ds7  = $fila_soli[correo];
						$ds8  = $fila_soli[idradicado];
						
						
						$cadena_soli .= $ds1."//////".$ds2."//////".$ds3."//////".$ds4."//////".$ds5."//////".$ds6."//////".$ds7."//////".$ds8."******";
						
						$cont_soli = $cont_soli + 1;
					
					}
					
				?>
				<a class="glyphicon glyphicon-list" href="javascript:void(0);" title="Solicitud Digitalizacion" data-toggle="modal" data-target="#exampleModal_3" data-whatever="<?php echo utf8_encode($cadena_soli)."*/*/*".$cont_soli;?>">
				
					Solicitud-Digitalizacion
		
				</a> 
				
			</li>
			
			<?php
			if($bandera_ADMIN_MEMO == 1){
			?>
			<li role="separator" class="divider"></li>
			<?php
			}
			?>
			
			<li>	
				<?php
				if($bandera_ADMIN_MEMO == 1){
				?>
				
				
				
				<a class="glyphicon glyphicon-align-justify" href="index.php?controller=archivo&amp;action=Memoriales_Externos_Radicados" title="Memoriales-Radicados">
				
					Memoriales-Radicados
					
					
				</a>  
				
				<?php
				}
				?>
				
			</li>
			
			<?php
			if($bandera_ADMIN_TITULO == 1){
			?>
			<li role="separator" class="divider"></li>
			<?php
			}
			?>
			
			<li>	
				<?php
				if($bandera_ADMIN_TITULO == 1){
				?>
				
				
				
				<a class="glyphicon glyphicon-calendar" href="index.php?controller=archivo&amp;action=Programacion_Consulta_Titulos" title="Programacion-Pago-y-Consulta-de-Titulos">
				
					Programacion-Pago-y-Consulta-de-Titulos
					
					
				</a> 
				
				<?php
				}
				?>
				
			</li>
			
			<li role="separator" class="divider"></li>
			
			
			<li>	
				
				<a class="glyphicon glyphicon-registration-mark" href="index.php?controller=archivo&amp;action=Consulta_PQR" title="PQR(S)">
				
					PQR
			
				</a> 
				
			</li>
			
           
          </ul>
        </li>
		
      </ul>
	  
	  <?php
	  }
	  ?>
	  
	  <ul class="nav navbar-nav navbar-right">
	  
	  	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Menu Principal">
			Menu-Principal
		</a>
		
		<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
			Cerrar-Sesion
		</a>
		
		<br>
		<br>
		<label for="input_sesion" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></label>
	
	  </ul>
	  
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php 
}
?>

<!-- FIN MENU HORIZONTAL -->


<div class="btn-toolbar" role="toolbar">

  <!-- <a href="index.php" title="Volver al Menu Principal"> -->
  <a href="index.php?controller=archivo&action=edit_archivoOtro&nombre=<?php echo $id_radi; ?>" title="Regresar">
  
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<br>

<center>

<h2 class="page-header">

	EXPEDIENTE DIGITAL
	
	<br>
	<h3><?php echo "ID: ".$id_radi." RADICADO: ".$nradi;?></h3>
	
	<br>
	<h4 class="page-header" style="color:#0033FF">
				
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_4" data-whatever="<?php echo $nradi."*/*/*".$actus;?>">
				
			<span class="glyphicon glyphicon-list-alt"></span> Actuaciones Expediente 
				
		</button>
		
		<?php
		if($bandera_49 == 1){
		?>
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_100" data-whatever="<?php echo $nradi."*/*/*".$id_radi;?>">
				
			<span class="glyphicon glyphicon-arrow-up"></span> Carga Indice Electronico 
				
		</button>
		
		<a href="index.php?controller=archivo&amp;action=Listar_Indice_Electronico&datosINDICE=<?php echo $id_radi."******".$nradi; ?>">
			 
			<button type="button" class="btn btn-primary">
				<span class="glyphicon glyphicon-list"></span> Listar Indice Electronico
			</button>
			  
		</a>
		<?php
		}
		?>
				
	</h4>
			

</h2>

</center>

<table class="table"> 

	 <tr>
	 
	 	<td align="center">
             
			 
			<?php
			if($tiene_acu_3 >= 1){
			?>   
				<!-- en vez de class="btn btn-primary" poner style="color:#FFFFFF; background-color:#FF0000" para color rojo-->
				<button type="button" style="color:#FFFFFF; background-color:#FF0000" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $nradi;?>">
					
					Acumulada(s) al Proceso <?php echo $nradi;?>
					
				</button>
			<?php
			}else{
			?>   
					SIN ACUMULADA(S) AL PROCESO
			<?php
			}
			?>   
				
		</td>
		
		<td align="center">
             
			<?php
			if($tiene_acu_6 >= 1){
			?>  
				<!-- en vez de class="btn btn-primary" poner style="color:#FFFFFF; background-color:#FF0000" para color rojo-->   
				<button type="button" style="color:#FFFFFF; background-color:#FF0000" data-toggle="modal" data-target="#exampleModal_2" data-whatever="<?php echo $id_radi." - ".$nradi;?>">
					
					El Proceso <?php echo $nradi;?> Acumulado A
					
				</button>
			<?php
			}else{
			?>   
					EL PROCESO NO ESTA ACUMULADO A NINGUN PROCESO
			<?php
			}
			?>   
				
		</td>
		
	 </tr>	
	 
	 
	
	<tr>
		<td colspan="2">
		
			<div class="col-xs-8">

					<div class="form-row">
					  
						<div class="form-group col-md-6">	
							<label for="input_1">PROCESO PARA ACUMULADA</label>
							<input type="checkbox" id="checkAcumulada" class="checkbox"/>
						</div>
						
						<div id="paraacumulada" class="form-group col-md-6">	
						
							<label for="input_1">Radicado a Acumular</label>
							<input type="number" class="form-control" name="radiacu" id="radiacu" placeholder="Radicado a Acumular">
							
							
							<a class="acumular_proceso" href="javascript:void(0);" title="ACUMULAR PROCESO">				
				
					
								<button class="btn btn-primary"><span class="glyphicon glyphicon-folder-open"></span></button> 
								
						
							</a>
							
						</div>
						
						
					</div>
										  
				
				
			</div>

		</td>
										
	</tr>
	
	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage_2"></div>  
		</td>
										
	</tr>
		
	
</table>

<!-- FLTROS PARA BUSQUEDA -->

<center>

	<h4 class="page-header"  style="color:#0033FF">FILTROS PARA BUSQUEDA</h4>
	
	<a id="buscar_pro" title="BUSCAR">
	
		<button type="button" class="btn btn-default" title="BUSCAR">
			<span class="glyphicon glyphicon-search"></span>BUSCAR
		</button>
			
	</a>
	
	<a id="recargar_pro" title="RECARGAR">
	
		<button type="button" class="btn btn-default" title="RECARGAR">
			<span class="glyphicon glyphicon-repeat"></span>RECARGAR
		</button>
			
	</a>
	
</center>

<!-- <form id="frmfiltro"> -->


<!-- <table class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
		
		
				<div class="form-group col-md-2">
				  <label for="input_1">Id</label>
				  <input type="text" class="form-control" name="filtro1" id="filtro1" value="<?php //echo trim($_GET['datox1']); ?>" placeholder="Ingrese Id Proceso">
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table> -->

<br>
<br>

<table class="table"> 


	<tr>
															
		<td>
			
			<div class="col-xs-8">
				
				<div class="form-row">
		  
			
			
					<div class="form-group col-md-6">
					  <label for="input_1">Id</label>
					  <input type="text" class="form-control" name="filtro1" id="filtro1" value="<?php echo trim($_GET['datox1']); ?>" placeholder="Ingrese Id Folio">
					</div>
					
					
					<?php
					//USUARIOS QUE PUEDEN VISUALIZAR LOS AUTOS
					//PARA ESTADO
					if($bandera_ADMIN == 1){
					?>
					
					<div class="form-group col-md-6">
					  <label for="input_1">PARA ESTADO</label>
					  <input type="checkbox" id="checkEstado" class="checkbox"/>
					</div>
					
					<div class="form-group col-md-6">
					  <label for="input_1">PARA DEVOLUCION DE DESPACHO</label>
					  <input type="checkbox" id="checkdevo" class="checkbox"/>
					</div>
					
					<?php
					}
					?>
					
					<div id="paraestado" class="form-group col-md-6">
		
						  <label for="input_3">Juzgado</label>
						 
						  <select class="form-control" name="filtroestado" id="filtroestado">
																	
							<option value="" selected="selected">Seleccionar</option> 
																				
							<?php
								while($row = $datosjuzgado_5->fetch()){
								
								
									//echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
																							
									if($row[id] == trim($_GET['datox7'])){					
																							
										echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[nombre] . "</option>";
									}
									else{
										echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
									}
																							
																							
								}
							?>
						</select>
					  
					  
					</div>
					
					
					
					
				</div>
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table>

<div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->	


	
	
	<div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Inicial</label>
		  <input type="text" class="form-control" name="filtro2" id="filtro2" value="<?php echo trim($_GET['dato_1']); ?>" placeholder="Ingrese Fecha Registro Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Fecha Registro Final</label>
		  <input type="text" class="form-control" name="filtro3" id="filtro3" value="<?php echo trim($_GET['dato_2']); ?>" placeholder="Ingrese Fecha Registro Final">
		</div>
		
	</div>
	

	
	<div class="form-row">
	  
		<div class="form-group col-md-6">
		  <label for="input_1">Folio Inicial</label>
		  <input type="text" class="form-control" name="filtro4" id="filtro4" value="<?php echo trim($_GET['datox2']); ?>" placeholder="Ingrese Folio Inicial">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_1">Folio Final</label>
		  <input type="text" class="form-control" name="filtro5" id="filtro5" value="<?php echo trim($_GET['datox3']); ?>" placeholder="Ingrese Folio Final">
		</div>
		
		
    </div> 
   
   
  
   
    <div class="form-row">
	  
		
		<div class="form-group col-md-6">
		
			  <label for="input_3">Cuaderno</label>
			 
			  <select class="form-control" name="filtro6" id="filtro6">
														
				<option value="" selected="selected">Seleccionar Cuaderno</option> 
																	
				<?php
					while($row = $datosSERVI_2->fetch()){
																				
						if($row[id] == trim($_GET['datox4'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[des] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		<div class="form-group col-md-6">
		
			  <label for="input_3">Quien Registra</label>
			 
			  <select class="form-control" name="filtro7" id="filtro7">
														
				<option value="" selected="selected">Seleccionar</option> 
																	
				<?php
					while($row = $datosEMPLE_3->fetch()){
																				
						if($row[id] == trim($_GET['datox5'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[empleado] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
						}
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		
   </div>
   
    <div class="form-row">
	  
		
		
		<div class="form-group col-md-6">
		
			  <label for="input_3">Quien Edita</label>
			 
			  <select class="form-control" name="filtro8" id="filtro8">
														
				<option value="" selected="selected">Seleccionar</option> 
																	
				<?php
					while($row = $datosEMPLE_4->fetch()){
																				
						if($row[id] == trim($_GET['datox6'])){					
																				
							echo "<option value=\"". $row[id] ."\" selected=selected>" . $row[empleado] . "</option>";
						}
						else{
							echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
						}
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		
   </div>
  

</div>
	
<!-- </form> -->


<!-- FIN FLTROS PARA BUSQUEDA -->


<table class="table"> 


	<tr>
															
		
		
		<td colspan="2">
		
			<center>
			<h2 class="page-header" style="color:#0033FF">
				DOCUMENTO(S): <?php echo $cantregis; ?>
				<br>
				<br>
				<!-- FOLIO(S):  --><?php //echo $Nfolios_3; ?>
				
				CUADERNO(S): <?php echo $NCuadernos; ?>
				
			</h2>
			</center>
			
			

			
		</td>
		
		
	</tr> 
	
	<tr>
						
		<td style="float:right">
		
			<a href="index.php?controller=archivo&action=Descargar_Multiples_Archivos&ruta_descarga=<?php echo implode(",", $ruta_descarga); ?>" title="Descargar todos los Archivos">
			 
				<button type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-download-alt"></span><h4>Descargar Expediente</h4>
				 </button>
			  
			</a>
			 
		</td>
		
		<td style="float:left">
		
			
			<a href="index.php?controller=archivo&amp;action=Registrar_Folio&datosexpF=<?php echo $id_radi."******".$nradi; ?>" title=">Nuevo-Folio(s)">
			 
				<button type="button" class="btn btn-primary">
					<span class="glyphicon glyphicon-floppy-saved"></span><h4>Nuevo-Folio(s)</h4>
				 </button>
			  
			</a>
			 
		</td>
				
	</tr>
	
	
</table>


<table class="table"> 

	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	
</table>

<table class="table table-striped table-bordered table table-hover" id="tsoli">
    <thead>
        <tr class="success">
            
			<!-- <th style="width:80px;"></th> -->
			
			<th>Orden Documento</th>
            <th>ID</th>
			
			<?php
			//SE REALIZA ESTA PREGUNTA PARA DETERMINAR SI LA CONSULTA
			//A DEVOLVER ES LA DE ESTADO, AGREGADNCO EL DATO RADICADO
			if($idradicadoestado_2 >= 1){
			?>
				<th>IDRADI</th>
				<th>RADICADO</th>
			<?php
			}
			?>
			
            <th style="width:120px;">FECHA</th>
            <th>HORA</th>
            <!-- <th style="width:120px;">FOLIO INICIAL</th> -->
            <!-- <th style="width:120px;">FOLIO FINAL</th> -->
			 <th style="width:120px;">PAGINAS</th>
			<th style="width:120px;">CUADERNO</th>
			<th style="width:120px;">DESCRIPCION</th>
			
			<th style="width:120px;">DEPENDENCIA</th>
			
			<th style="width:120px;">REGISTRA</th>
			<th style="width:120px;">EDITA</th>
			
			
            <th style="width:120px;">ARCHIVO</th>
            <th style="width:60px;">EDITAR</th>
			<th style="width:60px;">ELIMINAR</th>
        </tr>
    </thead>
    
   <!--  <tr>
        <td colspan="8" class="text-center">
            <a href="?c=Alumno&a=excel">Exportar a Excel</a>
        </td>
    </tr> -->
	
	
	<?php
											
			$Ct110=1;
			
			$contador_registros = 1;
			
			$inicio   = 1;
			$inicio2  = 1;
			$inicio3  = 1;
			$inicio4  = 1;
			$inicio5  = 1;
			$inicio6  = 1;
			$inicio7  = 1;
			$inicio8  = 1;
			$inicio9  = 1;
			$inicio10 = 1;
			$inicio11 = 1;
			$inicio12 = 1;
			$inicio13 = 1;
			$inicio14 = 1;
			$inicio15 = 15;
			$inicio16 = 16;
			$inicio17 = 17;
			$inicio18 = 18;
			$inicio19 = 19;
			$inicio20 = 20;
			$inicio21 = 21;
			$inicio22 = 22;
			$inicio23 = 23;
			$inicio24 = 24;
			$inicio25 = 25;
			$inicio26 = 26;
			$inicio27 = 27;
			$inicio28 = 28;
			$inicio29 = 29;
			$inicio30 = 30;
			$inicio31 = 31;
							
			while($fila = $datosACCION_1->fetch()){
				
				
				$idradicadoestado  = $fila[idradicadoestado];
				
				//SE REALIZA ESTA PREGUNTA PARA DETERMINAR SI LA CONSULTA
				//A DEVOLVER ES LA DE ESTADO, AGREGANDO EL DATO RADICADO
				if($idradicadoestado >= 1){
				
				
					$d0M  = $fila[id];
					$d1M  = $fila[idradicado];
					$d2M  = "FECHA REGISTRO:"."<br>".$fila[fecha]."<br>"." FECHA AUTO:"."<br>".$fila[fecha_estado];
					$d3M  = $fila[hora];
					$d4M  = $fila[folios];
					//$d4M  = $fila[folio_i];
					//$d5M  = $fila[folio_f];
					$d6M  = $fila[cuaderno];
					$d7M  = $fila[Foto];
					$d8M  = $fila[tipo]; 
					$d9M  = $fila[ruta];			
					$d10M = utf8_encode($fila[des]);
					
					$d11M = $fila[registra];
					$d12M = $fila[edita];
					
					
					//ID USUARIO QUE CREO EL REGISTRO
					//PARA VALIDAR AL MOMENTO DE EDITAR
					//O ELIMINAR UN REGISTRO
					//DEBE SER ESTE MISMO USUARIO
					$d13M = $fila[idusuario];
					
					$d14M = $fila[idradicadoestado];
					$d15M = $fila[radicado];
					
					$d16M = $fila[descuaderno];
					
					
				
				}
				else{
				
					$d0M  = $fila[id];
					$d1M  = $fila[idradicado];
					$d2M  = $fila[fecha];
					$d3M  = $fila[hora];
					$d4M  = $fila[folios];
					//$d4M  = $fila[folio_i];
					//$d5M  = $fila[folio_f];
					$d6M  = $fila[cuaderno];
					$d7M  = $fila[Foto];
					$d8M  = $fila[tipo]; 
					$d9M  = $fila[ruta];			
					$d10M = utf8_encode($fila[des]);
					
					$d11M = $fila[registra];
					$d12M = $fila[edita];
					
					
					//ID USUARIO QUE CREO EL REGISTRO
					//PARA VALIDAR AL MOMENTO DE EDITAR
					//O ELIMINAR UN REGISTRO
					//DEBE SER ESTE MISMO USUARIO
					$d13M = $fila[idusuario];
					
					$d16M = $fila[descuaderno];
					
					//ID RECIBIDO
					$d17M = $fila[id_memo_externo];
					
					$d18M = $fila[dependencia];
				
				}
				
				//SE CAPTURA DIRECTAMENTE DE LA BASE DE DATOS TABLA expe_cuaderno
				//COLUMNA STYLO, COMO SERA EL COLOR DE LA FILA SEGUN EL EL NUMERO DE CUADERNO
				//EJEMPLO:
				//<td class="numero" style="width:80px; font-size:12px; background-color:#FFFF93">
				$estilo_cuaderno  = $modelo->get_estilo_cuaderno($d6M);
				
				
		?>
    
    <?php //foreach($this->model->Listar() as $r): ?>
        <tr>
           
		   
			
				<?php echo $estilo_cuaderno; ?>
							
					<?php echo $contador_registros; //NUMERO REGISTRO ?>
							
				</td>
			
			
			
				<?php echo $estilo_cuaderno; ?>
				
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
			
					<?php echo $d0M; //id?>
				
				</td>
			
			
			
			
			
			<?php
			
			//SE REALIZA ESTA PREGUNTA PARA DETERMINAR SI LA CONSULTA
			//A DEVOLVER ES LA DE ESTADO, AGREGADNCO EL DATO RADICADO
			
			if($idradicadoestado >= 1){
			
			?>
				
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d14M; //id radicado?>
				
				</td>
				
				
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d15M; //radicado?>
				
				</td>
			
			<?php 
			
			}
			
			?>
			
			
			
			
		
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d2M; //fecha?>
				
				</td>
			
			
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
			
				<?php echo $estilo_cuaderno; ?>
				
					<?php echo $d3M; //hora?>
				
				</td>
			
			
			<?php
			
			unset($d4M_2);
			
			
			if( $Ct110 ==1 ){
			
				
				
					/*$d4M_2 = "1 - $d4M";
				
					$inicio = $d4M + 1;
					
					$sumaP = $sumaP + $d4M;*/
					
					
					//SE ADICIONA ESTA PARTE CONE EL OBJETO
					//QUE SEGUN EL ID DE CUADERNO, SE UBIQUE
					//EN EL INICIO DE SUMA CORRESPONDIENTE
					
					//CUADERNO PRINCIPAL
					if ( $d6M == 1 ){
					
						$sumaP = $sumaP + $d4M;
						
						$d4M_2 = "$inicio - $sumaP";
						
						
						$inicio = $sumaP  + 1;
						
					}
					
					
					//CUADERNO DE MEDIDAS
					if ( $d6M == 2 ){
					
						$suma2P  = $suma2P + $d4M;
						
						$d4M_2   = "$inicio2 - $suma2P";
						
						
						$inicio2 = $suma2P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
					
					//ACUMULADA 1 CUADERNO PRINCIPAL
					if ( $d6M == 3 ){
					
						$suma3P  = $suma3P + $d4M;
						
						$d4M_2   = "$inicio3 - $suma3P";
						
						
						$inicio3 = $suma3P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO PRINCIPAL
					if ( $d6M == 4 ){
					
						$suma4P  = $suma4P + $d4M;
						
						$d4M_2   = "$inicio4 - $suma4P";
						
						
						$inicio4 = $suma4P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO PRINCIPAL
					if ( $d6M == 5 ){
					
						$suma5P  = $suma5P + $d4M;
						
						$d4M_2   = "$inicio5 - $suma5P";
						
						
						$inicio5 = $suma5P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO PRINCIPAL
					if ( $d6M == 6 ){
					
						$suma6P  = $suma6P + $d4M;
						
						$d4M_2   = "$inicio6 - $suma6P";
						
						
						$inicio6 = $suma6P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO PRINCIPAL
					if ( $d6M == 7 ){
					
						$suma7P  = $suma7P + $d4M;
						
						$d4M_2   = "$inicio7 - $suma7P";
						
						
						$inicio7 = $suma7P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
					
					//ACUMULADA 1 CUADERNO DE MEDIDAS
					if ( $d6M == 8 ){
					
						$suma8P  = $suma8P + $d4M;
						
						$d4M_2   = "$inicio8 - $suma8P";
						
						
						$inicio8 = $suma8P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO DE MEDIDAS
					if ( $d6M == 9 ){
					
						$suma9P  = $suma9P + $d4M;
						
						$d4M_2   = "$inicio9 - $suma9P";
						
						
						$inicio9 = $suma9P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO DE MEDIDAS
					if ( $d6M == 10 ){
					
						$suma10P  = $suma10P + $d4M;
						
						$d4M_2   = "$inicio10 - $suma10P";
						
						
						$inicio10 = $suma10P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO DE MEDIDAS
					if ( $d6M == 11 ){
					
						$suma11P  = $suma11P + $d4M;
						
						$d4M_2   = "$inicio11 - $suma11P";
						
						
						$inicio11 = $suma11P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO DE MEDIDAS
					if ( $d6M == 12 ){
					
						$suma12P  = $suma12P + $d4M;
						
						$d4M_2   = "$inicio12 - $suma12P";
						
						
						$inicio12 = $suma12P  + 1;
						
					}
					
					//OTROS
					
					//CUADRNO PRINCIPAL INCIDENTE 1
					if ( $d6M == 13 ){
					
						$suma13P  = $suma13P + $d4M;
						
						$d4M_2   = "$inicio13 - $suma13P";
						
						
						$inicio13 = $suma13P  + 1;
						
					}
					
					//CUADRNO DE MEDIDAS INCIDENTE 1
					if ( $d6M == 14 ){
					
						$suma14P  = $suma14P + $d4M;
						
						$d4M_2   = "$inicio14 - $suma14P";
						
						
						$inicio14 = $suma14P  + 1;
						
					}
					
					//RECURSOS
					if ( $d6M == 15 ){
					
						$suma15P  = $suma15P + $d4M;
						
						$d4M_2   = "$inicio15 - $suma15P";
						
						
						$inicio15 = $suma15P  + 1;
						
					}
					
					//CUADERNO DE RESTITUCION
					if ( $d6M == 16 ){
					
						$suma16P  = $suma16P + $d4M;
						
						$d4M_2   = "$inicio16 - $suma16P";
						
						
						$inicio16 = $suma16P  + 1;
						
					}
					
					//CUADERNO SECUESTRE
					if ( $d6M == 17 ){
					
						$suma17P  = $suma17P + $d4M;
						
						$d4M_2   = "$inicio17 - $suma17P";
						
						
						$inicio17 = $suma17P  + 1;
						
					}
					
					//CUADERNO CONFLICTO DE COMPETENCIAS
					if ( $d6M == 18 ){
					
						$suma18P  = $suma18P + $d4M;
						
						$d4M_2   = "$inicio18 - $suma18P";
						
						
						$inicio18 = $suma18P  + 1;
						
					}
					
					//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
					if ( $d6M == 19 ){
					
						$suma19P  = $suma19P + $d4M;
						
						$d4M_2    = "$inicio19 - $suma19P";
						
						
						$inicio19 = $suma19P  + 1;
						
					}
					
					//CUADERNO DE TITULOS
					if ( $d6M == 20 ){
					
						$suma20P  = $suma20P + $d4M;
						
						$d4M_2    = "$inicio20 - $suma20P";
						
						
						$inicio20 = $suma20P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 2
					if ( $d6M == 21 ){
					
						$suma21P  = $suma21P + $d4M;
						
						$d4M_2    = "$inicio21 - $suma21P";
						
						
						$inicio21 = $suma21P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 3
					if ( $d6M == 22 ){
					
						$suma22P  = $suma22P + $d4M;
						
						$d4M_2    = "$inicio22 - $suma22P";
						
						
						$inicio22 = $suma22P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 4
					if ( $d6M == 23 ){
					
						$suma23P  = $suma23P + $d4M;
						
						$d4M_2    = "$inicio23 - $suma23P";
						
						
						$inicio23 = $suma23P  + 1;
						
					}
					
					//DESPACHO COMISORIO
					if ( $d6M == 24 ){
					
						$suma24P  = $suma24P + $d4M;
						
						$d4M_2    = "$inicio24 - $suma24P";
						
						
						$inicio24 = $suma24P  + 1;
						
					}
					
					//CUADERNO PRUEBAS
					if ( $d6M == 25 ){
					
						$suma25P  = $suma25P + $d4M;
						
						$d4M_2    = "$inicio25 - $suma25P";
						
						
						$inicio25 = $suma25P  + 1;
						
					}
					
					//CUADERNO DE SUPROGACION
					if ( $d6M == 26 ){
					
						$suma26P  = $suma26P + $d4M;
						
						$d4M_2    = "$inicio26 - $suma26P";
						
						
						$inicio26 = $suma26P  + 1;
						
					}
					
					//CUADERNO EXCEPCIONES PREVIAS
					if ( $d6M == 27 ){
					
						$suma27P  = $suma27P + $d4M;
						
						$d4M_2    = "$inicio27 - $suma27P";
						
						
						$inicio27 = $suma27P  + 1;
						
					}
					
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 28 ){
					
						$suma28P  = $suma28P + $d4M;
						
						$d4M_2    = "$inicio28 - $suma28P";
						
						
						$inicio28 = $suma28P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 2
					if ( $d6M == 29 ){
					
						$suma29P  = $suma29P + $d4M;
						
						$d4M_2    = "$inicio29 - $suma29P";
						
						
						$inicio29 = $suma29P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 3
					if ( $d6M == 30 ){
					
						$suma30P  = $suma30P + $d4M;
						
						$d4M_2    = "$inicio30 - $suma30P";
						
						
						$inicio30 = $suma30P  + 1;
						
					}
					
					//CUADERNO IMPEDIMENTO
					if ( $d6M == 31 ){
					
						$suma31P  = $suma31P + $d4M;
						
						$d4M_2    = "$inicio31 - $suma31P";
						
						
						$inicio31 = $suma31P  + 1;
						
					}
				
			
			}
			else{
				
					//CUADERNO PRINCIPAL
					if ( $d6M == 1 ){
					
						$sumaP = $sumaP + $d4M;
						
						$d4M_2 = "$inicio - $sumaP";
						
						
						$inicio = $sumaP  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS
					if ( $d6M == 2 ){
					
						$suma2P  = $suma2P + $d4M;
						
						$d4M_2   = "$inicio2 - $suma2P";
						
						
						$inicio2 = $suma2P  + 1;
						
					}
					
					//--------------ACUMULADAS CUADERNO PRINCIPAL------------------
					
					//ACUMULADA 1 CUADERNO PRINCIPAL
					if ( $d6M == 3 ){
					
						$suma3P  = $suma3P + $d4M;
						
						$d4M_2   = "$inicio3 - $suma3P";
						
						
						$inicio3 = $suma3P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO PRINCIPAL
					if ( $d6M == 4 ){
					
						$suma4P  = $suma4P + $d4M;
						
						$d4M_2   = "$inicio4 - $suma4P";
						
						
						$inicio4 = $suma4P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO PRINCIPAL
					if ( $d6M == 5 ){
					
						$suma5P  = $suma5P + $d4M;
						
						$d4M_2   = "$inicio5 - $suma5P";
						
						
						$inicio5 = $suma5P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO PRINCIPAL
					if ( $d6M == 6 ){
					
						$suma6P  = $suma6P + $d4M;
						
						$d4M_2   = "$inicio6 - $suma6P";
						
						
						$inicio6 = $suma6P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO PRINCIPAL
					if ( $d6M == 7 ){
					
						$suma7P  = $suma7P + $d4M;
						
						$d4M_2   = "$inicio7 - $suma7P";
						
						
						$inicio7 = $suma7P  + 1;
						
					}
					
					
					//--------------ACUMULADAS CUADERNO DE MEDIDAS------------------
					
					//ACUMULADA 1 CUADERNO DE MEDIDAS
					if ( $d6M == 8 ){
					
						$suma8P  = $suma8P + $d4M;
						
						$d4M_2   = "$inicio8 - $suma8P";
						
						
						$inicio8 = $suma8P  + 1;
						
					}
					
					//ACUMULADA 2 CUADERNO DE MEDIDAS
					if ( $d6M == 9 ){
					
						$suma9P  = $suma9P + $d4M;
						
						$d4M_2   = "$inicio9 - $suma9P";
						
						
						$inicio9 = $suma9P  + 1;
						
					}
					
					//ACUMULADA 3 CUADERNO DE MEDIDAS
					if ( $d6M == 10 ){
					
						$suma10P  = $suma10P + $d4M;
						
						$d4M_2   = "$inicio10 - $suma10P";
						
						
						$inicio10 = $suma10P  + 1;
						
					}
					
					//ACUMULADA 4 CUADERNO DE MEDIDAS
					if ( $d6M == 11 ){
					
						$suma11P  = $suma11P + $d4M;
						
						$d4M_2   = "$inicio11 - $suma11P";
						
						
						$inicio11 = $suma11P  + 1;
						
					}
					
					//ACUMULADA 5 CUADERNO DE MEDIDAS
					if ( $d6M == 12 ){
					
						$suma12P  = $suma12P + $d4M;
						
						$d4M_2   = "$inicio12 - $suma12P";
						
						
						$inicio12 = $suma12P  + 1;
						
					}
					
					//OTROS
					
					//CUADRNO PRINCIPAL INCIDENTE 1
					if ( $d6M == 13 ){
					
						$suma13P  = $suma13P + $d4M;
						
						$d4M_2   = "$inicio13 - $suma13P";
						
						
						$inicio13 = $suma13P  + 1;
						
					}
					
					//CUADRNO DE MEDIDAS INCIDENTE 1
					if ( $d6M == 14 ){
					
						$suma14P  = $suma14P + $d4M;
						
						$d4M_2   = "$inicio14 - $suma14P";
						
						
						$inicio14 = $suma14P  + 1;
						
					}
					
					//RECURSOS
					if ( $d6M == 15 ){
					
						$suma15P  = $suma15P + $d4M;
						
						$d4M_2   = "$inicio15 - $suma15P";
						
						
						$inicio15 = $suma15P  + 1;
						
					}
					
					//CUADERNO DE RESTITUCION
					if ( $d6M == 16 ){
					
						$suma16P  = $suma16P + $d4M;
						
						$d4M_2   = "$inicio16 - $suma16P";
						
						
						$inicio16 = $suma16P  + 1;
						
					}
					
					//CUADERNO SECUESTRE
					if ( $d6M == 17 ){
					
						$suma17P  = $suma17P + $d4M;
						
						$d4M_2   = "$inicio17 - $suma17P";
						
						
						$inicio17 = $suma17P  + 1;
						
					}
					
					//CUADERNO CONFLICTO DE COMPETENCIAS
					if ( $d6M == 18 ){
					
						$suma18P  = $suma18P + $d4M;
						
						$d4M_2   = "$inicio18 - $suma18P";
						
						
						$inicio18 = $suma18P  + 1;
						
					}
					
					//CUADERNO PROCESO RENDICION ESPONTANEA DE CUENTAS
					if ( $d6M == 19 ){
					
						$suma19P  = $suma19P + $d4M;
						
						$d4M_2    = "$inicio19 - $suma19P";
						
						
						$inicio19 = $suma19P  + 1;
						
					}
					
					//CUADERNO DE TITULOS
					if ( $d6M == 20 ){
					
						$suma20P  = $suma20P + $d4M;
						
						$d4M_2    = "$inicio20 - $suma20P";
						
						
						$inicio20 = $suma20P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 2
					if ( $d6M == 21 ){
					
						$suma21P  = $suma21P + $d4M;
						
						$d4M_2    = "$inicio21 - $suma21P";
						
						
						$inicio21 = $suma21P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 3
					if ( $d6M == 22 ){
					
						$suma22P  = $suma22P + $d4M;
						
						$d4M_2    = "$inicio22 - $suma22P";
						
						
						$inicio22 = $suma22P  + 1;
						
					}
					
					//CUADERNO PRINCIPAL INCIDENTE 4
					if ( $d6M == 23 ){
					
						$suma23P  = $suma23P + $d4M;
						
						$d4M_2    = "$inicio23 - $suma23P";
						
						
						$inicio23 = $suma23P  + 1;
						
					}
					
					//DESPACHO COMISORIO
					if ( $d6M == 24 ){
					
						$suma24P  = $suma24P + $d4M;
						
						$d4M_2    = "$inicio24 - $suma24P";
						
						
						$inicio24 = $suma24P  + 1;
						
					}
					
					//CUADERNO PRUEBAS
					if ( $d6M == 25 ){
					
						$suma25P  = $suma25P + $d4M;
						
						$d4M_2    = "$inicio25 - $suma25P";
						
						
						$inicio25 = $suma25P  + 1;
						
					}
					
					//CUADERNO DE SUPROGACION
					if ( $d6M == 26 ){
					
						$suma26P  = $suma26P + $d4M;
						
						$d4M_2    = "$inicio26 - $suma26P";
						
						
						$inicio26 = $suma26P  + 1;
						
					}
					
					//CUADERNO EXCEPCIONES PREVIAS
					if ( $d6M == 27 ){
					
						$suma27P  = $suma27P + $d4M;
						
						$d4M_2    = "$inicio27 - $suma27P";
						
						
						$inicio27 = $suma27P  + 1;
						
					}
				
					//CUADERNO RESPONSABILIDAD CIVIL EXTRACONTRACTUAL
					if ( $d6M == 28 ){
					
						$suma28P  = $suma28P + $d4M;
						
						$d4M_2    = "$inicio28 - $suma28P";
						
						
						$inicio28 = $suma28P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 2
					if ( $d6M == 29 ){
					
						$suma29P  = $suma29P + $d4M;
						
						$d4M_2    = "$inicio29 - $suma29P";
						
						
						$inicio29 = $suma29P  + 1;
						
					}
					
					//CUADERNO DE MEDIDAS INCIDENTE 3
					if ( $d6M == 30 ){
					
						$suma30P  = $suma30P + $d4M;
						
						$d4M_2    = "$inicio30 - $suma30P";
						
						
						$inicio30 = $suma30P  + 1;
						
					}
					
					//CUADERNO IMPEDIMENTO
					if ( $d6M == 31 ){
					
						$suma31P  = $suma31P + $d4M;
						
						$d4M_2    = "$inicio31 - $suma31P";
						
						
						$inicio31 = $suma31P  + 1;
						
					}
				
			
			
			}
			
			?>
			
				
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo "P: ".$d4M." - F: ".$d4M_2; //folios?>
				
				</td>
			
			
			
			<?php
			//if ( $d6M == 1) { ?>
			
				
				<!-- <td class="numero" style="width:80px; font-size:12px">
			
					<?php //echo $d5M; //folio final?>
				
				</td> -->
			
			<?php 
			//}
			//if ( $d6M == 2) { ?>
			
				<!-- <td class="numero" style="width:80px; font-size:12px; background-color:#D5EAFF">
			
					<?php //echo $d5M; //folio final ?>
				
				</td> -->
				
			<?php //}?>
			
			
			
				<!-- <td style="width:180px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d16M; //cuadernos ?>
				
				</td>
			
			
			
			
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d10M; //des?>
				
				</td>
			
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo $d18M; //des?>
				
				</td>
			
			
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo utf8_encode($d11M); //registra?>
				
				</td>
			
			
			
			
			
				<!-- <td class="numero" style="width:80px; font-size:12px"> -->
				
				<?php echo $estilo_cuaderno; ?>
			
					<?php echo utf8_encode($d12M); //edita?>
				
				</td>
			
			
			
			
			<?php
			//if ( $d8M == "application/pdf") { 
			if ( !empty($d8M) ) {
			
								if ( $d8M == "application/pdf") { 
								
									$icono = 'views/images/pdf-icono.png';
								}
								
								if ( $d8M == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $d8M == "application/msword") { 
								
									$icono = 'views/images/w4.png';
								}
			
			?>
			
							
								
								<!-- <td> -->
								<?php echo $estilo_cuaderno; ?>
								
									<a href="<?php echo $d9M;?>" title="<?php echo $d9M;?>" target="_blank"><img src="<?php echo $icono;?>" width="35" height="35"/></a>
								
								<?php	
								//ID RECIBIDO, PARA IMPRIMIR EL RECIBIDO EN PDF
								//CUANDO EL USUARIO DE LA PLATAFORMA PUBLICACIONES RADIQUE UN MEMORIAL
								if ( $d17M >= 1 ){
								
									echo "<br>";
									echo "<br>";
								
								?>
								
									<a class="descarga_recibido" href="javascript:void(0);" title="Recibido" data-idrecibido="<?php echo $d17M; ?>">
									<button type="button" class="btn btn-success btn-xs">Recibido</button>
									</a> 
									
								<?php	
								}
								?>
									
								</td> 
							
							
			
			<?php }else{ ?>
							
							
							
							
								<!-- <td> -->
								<?php echo $estilo_cuaderno; ?>
								
									SIN FOLIO(S)
									
								</td> 
							
							
							
							
			<?php }?>
			
			
			
			
			
				<!-- <td> -->
				
				<?php echo $estilo_cuaderno; ?>
                
					<!-- <a href="?c=Alumno&a=Crud&id=<?php //echo $r->id; ?>&radi=<?php //echo $dato_1; ?>">Editar</a> -->
					
					<a class="glyphicon glyphicon-pencil" href="index.php?controller=archivo&amp;action=Editar_Folio&datosexpEF=<?php echo $id_radi."******".$nradi."******".$d0M."******".$d13M."******".$d11M; ?>" title="EDITAR"></a>
	
				
           		 </td> 
			
			
			
			
				  <!-- <td> -->
				  
				  <?php echo $estilo_cuaderno; ?>
				  
                	<a class="glyphicon glyphicon-remove-circle" onclick="javascript:return confirm('Esta Seguro de Eliminar el Registro');" href="index.php?controller=archivo&amp;action=Eliminar_Folio&datosexpELF=<?php echo $id_radi."******".$nradi."******".$d0M."******".$d13M."******".$d11M; ?>" title="ELIMINAR"></a>
					
           		  </td>
			
			
			
			
			
        </tr>
    <?php  $Ct110=$Ct110+1; $contador_registros = $contador_registros + 1;  } //endforeach; ?>
    
    <!-- <tfoot>
        <tr>
            <td colspan="8" class="text-center">
                <a href="?c=Alumno&a=excel">Exportar a Excel</a>
            </td>
        </tr>
    </tfoot> -->
</table> 

<!-- VENTANAS MODALES -->

<!-- ACTUACIONES DEL PROCESO DESDE JUSTICIA XXI-->

<div class="modal fade" id="exampleModal_4" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUACIONES DEL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="tactu" border="1" class="table table-striped table-bordered table table-hover editinplace_4">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success">
													
					<th style="text-align:center">ID</th>
					<th style="text-align:center">FECHA</th>
					<th style="text-align:center">ACTUACION</th>
					
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 


<!-- ACUMALADAS AL PROCESO -->

<div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACUMULADAS AL PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="acumulada" border="1" class="table table-striped table-bordered table table-hover editinplace">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success"> 
													
					<th>ID</th>
					<th>RADICADO</th>
					<th>DIGITALIZADO</th>
					<th>EXPEDIENTE</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 


<!-- PROCESO ACUMULADO A-->

<div class="modal fade" id="exampleModal_2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_2">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PROCESO ACUMULADO A</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="acumulada_2" border="1" class="table table-striped table-bordered table table-hover editinplace_2">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success">
													
					<th>ID</th>
					<th>RADICADO</th>
					<th>DIGITALIZADO</th>
					<th>EXPEDIENTE</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 

<!-- SOLICITUDES DE EXPEDIENTES A DIGITALIZAR-->

<div class="modal fade" id="exampleModal_3" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_3">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SOLICITUDES DE EXPEDIENTES A DIGITALIZAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  	 <table id="tsoliexpe" border="1" class="table table-striped table-bordered table table-hover editinplace_3">
         <!-- <table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace"> -->
																							
											
				<tr class="success"> 
													
					<th>IDSOLI</th>
					<th>IDRADI</th>
					<th>RADICADO</th>
					<th>SOLICITA</th>
					<th>FECHA</th>
					<th>HORA</th>
					<th>ABOGADO</th>
					<th>CORREO</th>
					<th>DIGITALIZAR</th>
					
				</tr> 
													
			</table>
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 


<!-- CARGAR INCICE ELECTRONICO -->

<div class="modal fade" id="exampleModal_100" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  <div class="modal-dialog" role="document" id="mdialTamanio_5">
  
    <div class="modal-content">
	
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align="center">INDICE ELECTORNICO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
	  
      <div class="modal-body"> 
	  
	  		
			<table class="table"> 
		
		
				<tr>
					<td style="border-color:#FFFFFF ">
						<!-- MENSAJES HORARIO NO HABIL PARA RADICAR MEMORIAL-->
						<div class="msghora" style="color:#FF0000; text-align:center"></div>  
					</td>
													
				</tr>
				
				<tr>
					<td style="border-color:#FFFFFF ">
						<!-- MENSAJES -->
						<div class="mensage_memo"></div>  
					</td>
													
				</tr>
				
				<tr>
																	
					<td style="border-color:#FFFFFF ">
							
						<div class="form-row">
						
							
							<div class="form-group col-md-4">
							 
							 
								 <?php 
							 	$msg_memo = "EL NOMBRE DEL ARCHIVO DEBE SER SIN TILDES, SIN ESPACIOS, SIN ACENTOS, SIN CARACTERES ESPECIALES Y FORMATO EXCEL TIPO .CSV (delimitado por comas)"."<br>"."MANEJAR NOMBRES CORTOS Y REFERENTE A LO QUE SE DESEA CARGAR"."<br>"."NO ARCHIVOS MULTIMEDIA";
							 	?>
								
								<button type="button" class="btn btn-info btn-xs" style="color:#000000"><?php echo $msg_memo; ?></button>
								
								<br>
								<br>
								
								<!-- SE SELECCIONA UN SOLO ARCHIVO -->
							 	<input type="file" name="archivoie" id="archivoie" size="19" placeholder="Ingrese Excel"/>
										 
							 	<!-- SE SELECCIONA VARIOS ARCHIVOS -->
							 	<!-- <input type="file" multiple="multiple" name="archivomemo" id="archivomemo" size="19" placeholder="Ingrese pdf"/> -->
							  
							 
							
							</div>
							
							
						</div>
						
					</td>
				
				
					
				</tr> 
				
				<tr>
				
					<td>
					
						<a id="cargar_indice" title="CARGA INDICE ELECTRONICO">
						
							<button type="button" class="btn btn-success" title="CARGA INDICE ELECTRONICO">
								<span class="glyphicon glyphicon-arrow-up"></span><h4>CARGAR INDICE ELECTRONICO</h4>
							</button>
						
						</a>
						
						
					</td>
					
				</tr>
				
				
				<tr id="fila_cargando" align="center">
				
					<td>
						<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
					</td>
													
				</tr>
				
				
				
				<tr align="center">
				
					<td>
						<label>ESTRUCTURA ARCHIVO EN .CSV (SIN ENCABEZADOS)</label>
						<br>
						<img src="views/images/ie.png"/>
					</td>
													
				</tr>
				
				
				
			
		</table>
		
		
		
     </div> 
	  
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
  
</div> 


<!-- FIN VENTANAS MODALES -->       

<div class="row">
	<div class="col-xs-12">
     	<footer class="text-center">
       		<hr />
        	<p>Plataforma <?php echo utf8_encode(' Diseñada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
			<p>Plataforma Desarrollado por</p>
			<p>Ingeniero de Sistemas Jorge Andres Valencia Orozco (Oficina de Ejecucion Civil Municipal Manizales)</p>       
        </footer>                
	</div>    
</div>

<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>
