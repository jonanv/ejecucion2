<?php 
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	$idusuario  = $_SESSION['idUsuario'];
	
	//TITULO FORMULARIO
	$titulo     = "Filtrar Liquidaciones";
	$subtitulo  = "Liquidaciones";
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo = new liquidaciones2Model();
	
	date_default_timezone_set('America/Bogota'); 
	setlocale(LC_TIME, "Spanish");

	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual  = $modelo->get_fecha_actual_amd();
	
	//FECHA MINIMA DESQUE EXISTE INFORMACION DE LIQUIDACIONES
	$fecha_consulta = 'MIN(fechae) AS fecha_minima';
	$fecha_min_1    = $modelo->get_datos_fechaminmax_liquidacion($fecha_consulta);
	$fila_fecha_min = $fecha_min_1->fetch();
    //$fecha_min      = $fila_fecha_min[fecha_minima];
	$fecha_min      = strtoupper(strftime('%d %B de %Y', strtotime($fila_fecha_min[fecha_minima])));
	//echo $fecha_min;
	
	//FECHA MAXIMA DESQUE EXISTE INFORMACION DE LIQUIDACIONES
	$fecha_consulta = 'MAX(fechae) AS fecha_maxima';
	$fecha_max_1    = $modelo->get_datos_fechaminmax_liquidacion($fecha_consulta);
	$fila_fecha_max = $fecha_max_1->fetch();
    //$fecha_max      = $fila_fecha_max[fecha_maxima];
	$fecha_max      = strtoupper(strftime('%d %B de %Y', strtotime($fila_fecha_max[fecha_maxima])));
	//echo $fecha_max;
	
	//LISTAS
	$nombrelista  = 'juzgado_destino';
	$campoordenar = 'nombre';
	$datosjuzgado = $modelo->get_lista($nombrelista,$campoordenar);
	
	$datosliquidador  = $modelo->get_datos_liquidador();
	
	$campo_liqui      = 'nuevo';
	$datos_tipo_liqui = $modelo->get_datos_tipo_liquidacion($campo_liqui);
	
	$campo_liqui      = 'liquidacioncredito';
	$datos_si_liqui   = $modelo->get_datos_tipo_liquidacion($campo_liqui);
	
	$campo_liqui        = 'estadoe';
	$datos_estado_liqui = $modelo->get_datos_tipo_liquidacion($campo_liqui);
	
	
	$cantidad_reg = 0;
	
	$opcion = trim($_GET['dato_0']);
	
	if($opcion != 1){
	
		$datos_LI = $modelo->get_datos_liquidaciones(1);
		
		$cantidad_reg = 5;
	}
	else{
		$datos_LI = $modelo->get_datos_liquidaciones(2);
		
		$cantidad_reg_1 = $modelo->get_datos_cantidad_liquidaciones();
		$fila_liqui     = $cantidad_reg_1->fetch();
		$cantidad_reg   = $fila_liqui[cantidad];
	}
	 
	$ip_plataforma = trim($_SESSION['ipplataforma']);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  -->
<title><?php echo $titulo?></title>

<!-- SE DEFINEN LAS LIBRERIAS DE ESTA FORMA PARA EVITAR CONFLICTOS COMO EL DESPLIEGUE DE MENUS,
QUE AL REALIZAR UN REGISTRO SALGA EL MENSAJE DE CONFIRMACION, SEGUIDO DE LAS LIBRERIAS
FUNCIONES JAVASCRIPT COMO mainmenu() Y $(document).ready(function() , YA QUE SI SE DEFINEN
MAS ARRIBA AL NO ENCONTRAR LAS LIBRERIAS TAMBIEN PUEDE PRESENTAR INCONSISTENCIAS.
PARA EL MANEJO DE LAS FECHAS, SI SE USA DIRECTAMENTE POR EJEMPLO EN ESTE FORMULARIO SE DEFINE 
ALGO COMO

<input name="fechair" id="fechair" type="text" readonly="true" size="10">

Y SE DEFINE EN $(document).ready(function() 

$("#fechair").datepicker({ changeFirstDay: false	}); 

SI SE DESEA MANEJAR FECHAS EN UN POPUPBOX, SE PUEDE USAR LAS LIBRERIAS DE views\fechajquery
EJENPLODE ESTO LO VEMOS EN EL FORMULARIO permisos.php UBICADO EN views\popupbox
-->

<!-- -------------------------------------------------------------------- -->
<script src="views/js/jquery_NV.js" type="text/javascript"></script>

<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>  -->

<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>

<script src="views/js/jquery.validate_NV.js" type="text/javascript"></script>

<!--------------------------------------- PATA LAS FECHAS ----------------------------------------------------------------------- -->
<script src="views/js/ui.datepicker_NV.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.alL_NV.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<!-- ---------------------------------------------------------------------------------------------------------------------------- -->

<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<script src="views/js/ajax/ajax_liquidaciones2.js" type="text/javascript" charset="utf-8"></script>

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css">


<!-- PARA EL FUNCIONAMIENTO DEL ARBOL ESTILO WINDOWS PARA LISTAR LOS ARCHIVOS SCANEADOS -->
<link rel="stylesheet" type="text/css" href="views/viewstree/jqueryFileTree.css" media="screen" />
<!-- <script type="text/javascript" src="jquery-1.3.2.min.js"></script> -->
<script type="text/javascript" src="views/viewstree/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="views/viewstree/jqueryFileTree.js"></script>


<!-- -------------------------------------------------------------------- -->

<!-- PARA EL DESPLIEGUE DE MENUS -->
<script type="text/javascript">

	function mainmenu(){
	
		$(" #menusec ul ").css({display: "none"});
		$(" #menusec li").hover(function(){
			$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
			},function(){
				$(this).find('ul:first').slideUp(400);
			});
	}
	
	$(document).ready(function(){
		mainmenu();
	});


</script>


<script type="text/javascript">

$(document).ready(function() {
	
	 var ip_servidor    = "<?php echo $ip_plataforma; ?>";
	 
	 //var ipservidor = "190.217.24.24";
	 
	 var ipservidor = ip_servidor;
	
	 //-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
	 $.datepicker.regional['es'] = {
	 closeText: 'Cerrar',
	 prevText: '< Ant',
	 nextText: 'Sig >',
	 currentText: 'Hoy',
	 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
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
	
	
	//PARA LAS FECHAS
	$("#fechai").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	$("#fechaf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	$("#fecha_estado").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd' });
	
	$('#fila_botones').show();
	
	
	
	$(".boton_generar_liquidacion").click(function(){
	
	
					//alert("ENTRE");
					
					var d0x    = $(this).attr('data-nun');
						
					//FECHA
					d1x  = $(this).attr('data-fecha');
									
					//NUEVO
					d4x  = $(this).attr('data-nuevo');
									
					//LIQ CREDITO
					d5x  = $(this).attr('data-liq');
							
			
				
					var acuerdo = "";
					
					var cesionario   = $('#cesi_liqui').val();
					var subrogatario = $('#sub_liqui').val();
					var nunestado    = $('#nunestado').val();
					var fecha_estado = $('#fecha_estado').val();
					
				    //alert("GENERANDO LIQUIDACION NUMERO: "+d0x);
					
					//var ipservidor = "172.16.176.194";
		
					//window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?fechae_2A="+valor1+"&fechae_2B="+valor2+"&nun_estado="+valor3+"&juzgadoauto="+valor4);
					
					//window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liqui="+d0x);
					
					if( $("#radioacuerdo1").is(':checked') ) {  
					
						acuerdo = "Acuerdo 1887 de 2003 modificado mediante el acuerdo No. 2222";
					
					}
					
					if( $("#radioacuerdo2").is(':checked') ) {  
					
						acuerdo = "Acuerdo 10554 de 2016";
					
					}
					
					var forma_dte_ddo = "";
					if($("#checkliquisa_2").is(':checked')){ 
					
						forma_dte_ddo = "a cargo de la parte demandante y en favor de la parte demandada.";
					}
					else{
					
						forma_dte_ddo = "a cargo de la parte demandada y a favor del aqui demandante.";
					}
					
					//*********************TANTO NUEVO COMO LIQUIDACION******************************
            		if( d4x == "SI" && d5x == "SI" ){
					
						//alert("NUEVA Y LIQUIDACION");
						
						//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
						if($("#checkliquisa").is(':checked')){  
							
							
							var agencias = 1;
							
							var fechat = d1x;
			
							var fi;
							var fii;
							
							var ff;
							var fff;
							
							
							if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
							
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
							}	
							else{
								alert("DEFINA ACUERDO");
							}	
							
							
							
							
						}
						//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
						else{
						
							
							var fechat = d1x;
			
							var fi;
							var fii;
							
							var ff;
							var fff;
							
							
							$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
								
								//alert(fechas);
								
								var vector_fechas = fechas.split(" ");
								
								//FECHA FIJACION
								fj  = vector_fechas[0].split("/");
								fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
								
								//alert(fjj);
								
								//FECHA INICIAL
								fi  = vector_fechas[1].split("/");
								fii = fi[2]+"-"+fi[1]+"-"+fi[0];
								
								//alert(fii);
								
								//FECHA FINAL
								ff  = vector_fechas[2].split("/");
								fff = ff[2]+"-"+ff[1]+"-"+ff[0];
								
								//alert(fff);
								
	
								window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
													
							});
						
	
						
						}
					
					}
					
					
					
					
					//*********************SOLO LIQUIDACION******************************
            		if( d4x == "NO" && d5x == "SI" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
		
							
							}
					
						
					}
					
					
					
					//*********************SOLO NUEVO******************************
            		if( d4x == "SI" && d5x == "NO" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
										
										//document.location = "http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario;
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
									
									
									//document.location = "http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario;
									
									
									
														
								});
							
		
							
							}
					
						
					}
					
					
					//*********************AMBOS NO******************************
            		if( d4x == "NO" && d5x == "NO" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NONUEVO_NOLIQUI.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NONUEVO_NOLIQUI.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
		
							
							}
					
						
					}
					
					
	});
	
	
	
});



</script>	

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo	
		require 'secc_liquidaciones2.php';
		
		
	?>			
	
	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
			<td bgcolor="#CDE3F9">
				<center><div id="titulo_frm"><?php echo strtoupper($titulo); ?></div></center>
			</td>
		</tr>
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
					
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
							
							<tr>
								<td>
									<label style="width:151px; color:#FF0000; font-size:14px">RADICADO:</label>
								</td>
								<td>
									<input type="text" name="radicadox" id="radicadox" class="required number" value="<?php echo trim($_GET['datox1']); ?>">
								</td>
								
								<!-- <td>
									<label style="width:151px; color:#666666">Liquidador:</label>
								</td>
								<td>
									<input type="text" name="hvnombre" id="hvnombre" class="required" value="<?php //echo trim($_GET['datox2']); ?>">
								</td> --> 
								
								<td>
									<label style="width:151px; color:#666666">Liquidador:</label>
								</td>
															
								<td>
													
									
									<select name="hvnombre" id="hvnombre" class="required">
																													
																														
										<option value="" selected="selected">Seleccionar Liquidador</option>
																																
											<?php
											while($row = $datosliquidador->fetch()){
																			
												
												
													if($row[id] == trim($_GET['datox2'])){		
													
														echo "<option value=\"". $row[id] ."\" selected>" . $row[empleado] . "</option>";
													}
													else{													
														
														echo "<option value=\"". $row[id] ."\">" . $row[empleado] . "</option>";
													}
													
												
																																		
											}
											?>
									</select>
																											
																							
								</td>
				
							</tr>
							
							<tr>
								<td colspan="4">
									<center><label style="width:151px; color:#FF0000">EXISTE INFORMACION DESDE:<?php echo $fecha_min; ?> HASTA:<?php echo $fecha_max; ?></label></center>
								</td>
					
							</tr>
							
							<tr>
								<td>
									<label style="width:151px; color:#666666">Fecha Inicial:</label>
								</td>
								<td>
									<input type="text" name="fechai" id="fechai" class="required" readonly="true" value="<?php echo trim($_GET['dato_1']); ?>">
								</td>
								<td>
									<label style="width:151px; color:#666666">Fecha Final:</label>
								</td>
								<td>
									<input type="text" name="fechaf" id="fechaf" class="required" readonly="true" value="<?php echo trim($_GET['dato_2']); ?>">
								</td>
							
							</tr>
							
							<tr>
															
								<td>
									<label style="width:151px; color:#666666">Juzgado Ejecucion Civil Municipal:</label>
								</td>
															
								<td>
													
									
									<select name="juzgado_liqui" id="juzgado_liqui" class="required">
																													
																														
										<option value="" selected="selected">Seleccionar Juzgado</option>
																																
											<?php
											while($row = $datosjuzgado->fetch()){
																			
												if($row[id] == 1 || $row[id] == 2){		
												
													if($row[id] == trim($_GET['datox3'])){		
													
														echo "<option value=\"". $row[id] ."\" selected>" . $row[nombre] . "</option>";
													}
													else{													
														
														echo "<option value=\"". $row[id] ."\">" . $row[nombre] . "</option>";
													}
													
												}
																																		
											}
											?>
									</select>
																											
																							
								</td>		
								
								
								<td>
									<label style="width:151px; color:#666666">Estado:</label>
								</td>
															
								<td>
													
									
									<select name="estado_liqui" id="estado_liqui" class="required">
																													
																														
										<option value="" selected="selected">Seleccionar Estado</option>
																																
											<?php
											while($row = $datos_estado_liqui->fetch()){
																			
												
												
													if( $row[estadoe] == trim($_GET['datox6']) && !empty($_GET['datox6']) ){		
													
														echo "<option value=\"". $row[estadoe] ."\" selected>" . $row[estadoe] . "</option>";
													}
													else{													
														
														echo "<option value=\"". $row[estadoe] ."\">" . $row[estadoe] . "</option>";
													}
													
												
																																		
											}
											?>
									</select>
																											
																							
								</td>					
															
															
							</tr>
							
							
							<tr>
															
								<td>
									<label style="width:151px; color:#666666">Nuevo:</label>
								</td>
															
								<td>
													
									
									<select name="nuevo_liqui" id="nuevo_liqui" class="required">
																													
																														
										<option value="" selected="selected">Seleccionar Nuevo</option>
																																
											<?php
											while($row = $datos_tipo_liqui->fetch()){
																			
												
												
													if($row[nuevo] == trim($_GET['datox4'])){		
													
														echo "<option value=\"". $row[nuevo] ."\" selected>" . $row[nuevo] . "</option>";
													}
													else{													
														
														echo "<option value=\"". $row[nuevo] ."\">" . $row[nuevo] . "</option>";
													}
													
												
																																		
											}
											?>
									</select>
																											
																							
								</td>
								
								<td>
									<label style="width:151px; color:#666666">Liquidacion Credito:</label>
								</td>
															
								<td>
													
									
									<select name="si_liqui" id="si_liqui" class="required">
																													
																														
										<option value="" selected="selected">Seleccionar Liquidacion Credito</option>
																																
											<?php
											while($row = $datos_si_liqui->fetch()){
																			
												
												
													if($row[liquidacioncredito] == trim($_GET['datox5'])){		
													
														echo "<option value=\"". $row[liquidacioncredito] ."\" selected>" . $row[liquidacioncredito] . "</option>";
													}
													else{													
														
														echo "<option value=\"". $row[liquidacioncredito] ."\">" . $row[liquidacioncredito] . "</option>";
													}
													
												
																																		
											}
											?>
									</select>
																											
																							
								</td>							
															
															
							</tr>
							
							<tr>
							
								<td>
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">LIQUIDACION SIN AGENCIAS</label>
												<input type="checkbox" id="checkliquisa" name="checkliquisa"> 
												
						
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">DEMANDANTE A DEMANDADO</label>
												<input type="checkbox" id="checkliquisa_2" name="checkliquisa_2"> 
												
						
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">ACUERDO 1887 DE 2003</label>
												<input type="radio" id="radioacuerdo1" name="acuerdo" style="border-color:#0066CC"/>
												
												
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">ACUERDO 10554 DE </label>
												<input type="radio" id="radioacuerdo2" name="acuerdo" style="border-color:#0066CC"/>
												
																			
											</td>
											
											
										</tr>
									
									</table>
									
								</td>
								
								
								<td colspan="3">
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">DATOS PARA COMPLETAR LIQUIDACION</label>
												
											</td>
											
											
										</tr>
									
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">CESIONARIO</label><br>
												<input type="text" name="cesi_liqui" id="cesi_liqui"/>
												
												
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">SUBROGATARIO</label><br>
												<input type="text" name="sub_liqui" id="sub_liqui"/>
												
																			
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">NUMERO ESTADO</label><br>
												<input type="text" name="nunestado" id="nunestado"/>
												
																			
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
												<label style="width:151px; color:#666666">FECHA ESTADO:</label><br>
												<input type="text" name="fecha_estado" id="fecha_estado" readonly="true">
											</td>
											
										</tr>
									
									</table>
									
								</td>
							
							</tr>
							
							
							<!-- -----------------------------BOTONES--------------------------------------------------------- -->
							<tr id="fila_botones">
								
								<td colspan="4">
									<center>
										<input type="button" name="consultar" value="Consultar" id="btn_input" class="filtrarli">
										<input type="reset" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar_2"/>
									</center>
								</td> 
								
						  	</tr>
							
							<!-- ----------------------------------------------------------------------------------------------- -->
						
			
						</table>
					
					</form>
			
				
			</td>
		</tr>
		
		
	</table>
	
	
	
	<br>
	
	<!-- NOTA: SE CIERRA LAS COLUMNAS Y CAMPOS, YA QUE NO SON NECESARIOS SU VISIVILIDAD, SI SE NECESITAN SIMPLEMENTE SE DESCOMENTAN -->
	<table border="0" align="center"  rules="rows" id="tablaconsulta">
		
			
				<tr>
					
					<td>
					
						<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_editar1">
										
							<thead> 
										<tr>
											<th bgcolor="#CDE3F9" colspan="12">
												<center>
													<div id="titulo_frm"><?php echo strtoupper($subtitulo." -> ".$cantidad_reg); ?></div>
													<a class="generar_excel_liquidaciones" href="javascript:void(0);" title="GENERAR EXCEL" style="float:right ">
														<img src="views/images/excel_1.jpg" width="45" height="45" title="GENERAR EXCEL"/>
													</a>
												</center>
											</th>
										</tr>
										<tr> 
											<!-- <th>ID</th> -->
											<th>NUN</th>
											<th>FECHA</th>
											<th>HORA</th>
											<th>RADICADO</th>
											
											<th>ESTADO</th>
											<th>NOTA</th>
											<th>NUEVO</th>
											<th>LIQ. CREDITO</th>
											<th>OBSERVACION</th>
											
											<th>LIQUIDADOR</th>
											<th>JUZGADO</th>
											
											<th>GENERAR</th>
											
											
											
										</tr> 
									</thead> 
													
									<tbody> 
													
										<?php 
											  $modelo = new liquidaciones2Model(); 
											  
											  while($row = $datos_LI->fetch()){ ?>
											
											
											
											<tr>
												<!-- <td><?php //echo $row[id];?></td> -->
												<td><?php echo $row[nunentrada];?></td>
												
												<td><?php echo strtoupper(strftime('%d %B de %Y', strtotime($row[fechae])));?></td>
												
												<td><?php echo $row[horae];?></td>
												<td><?php echo $row[radicado];?></td>
												
												<td><?php echo $row[estadoe];?></td>
												<td><?php echo $row[notae];?></td>
												<td><?php echo $row[nuevo];?></td>
												<td><?php echo $row[liquidacioncredito];?></td>
												<td><?php echo $row[observacioncostas];?></td>
												
												
												<td><?php echo $row[empleado];?></td>
												<td><?php echo $row[juzgado];?></td>
												
												<td>
																	
													
													<a class="boton_generar_liquidacion" href="javascript:void(0);" data-nun="<?php echo trim($row[nunentrada]);?>" data-fecha="<?php echo trim($row[fechae]);?>" data-nuevo="<?php echo trim($row[nuevo]);?>" data-liq="<?php echo trim($row[liquidacioncredito]);?>"><img src="views/images/archivo_3.png" width="30" height="30"/></a>
												
										
												</td>
												

											</tr>
									
										<?php } ?>
													
									</tbody>
						</table>
						
					</td>
				</tr>
			
			
		</table>		
			
			

	
		
<?php require 'alertas.php';?>
</body>
</html>


	
