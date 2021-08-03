<?php 
	
	//echo $_SESSION['id'];
	
	//DATOS PARA CARGAR AL FORMULARIO, SE CARGAN VARIABLES CON INFOMACION
	//O SE INSTANCIA EL MODELO Y SE LLAMAN FUNCIONES PARA TRAER DATOS Y SER
	//ASIGNADOS A CAMPOS DEL FORMULARIO O CONSTRUIR TABLAS
	
	//TITULO FORMULARIO
	$titulo     = "Lista de Archivos Escaneados";
	$subtitulo  = "Carpetas";
	//$subtitulo2 = "Permisos Usuario";
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo       = new archivoModel();
	
	$idusuario  = $_SESSION['idUsuario'];
	$ruta       =  "C:\wamp\www\laborales\INCIDENTESALUD";
	//$listar     = $modelo->get_lista_archivos($idusuario,$ruta);
	
	$listar       = $modelo->get_lista_archivos_2($idusuario,$ruta);
	$listar2      = explode("//////",$listar);
	$cantcarpetas = count($listar2);
	
	$ip_plataforma = trim($_SESSION['ipplataforma']);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> 
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
<script src="views/js/jquery.js" type="text/javascript"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> -->


<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- -------------------------------------------------------------------- -->

<!-- USO DE ARCHVIO PARA VALIDACIONES DE CAMPOS Y APLICACION DE FUNCIONES -->
<!-- <script src="views/js/ajax/ajax_sidoju.js" type="text/javascript" charset="utf-8"></script> -->

<!-- PARA MANEJAR LOS ESTILOS DEL FORMULARIO -->
<link href="views/css/main.css" rel="stylesheet" type="text/css">

<!-- PARA EL FUNCIONAMIENTO DE LAS TABLAS EN SU FILTRO Y PAGINACION -->
<!-- <script type="text/javascript" language="javascript" src="views/viewstablas/jquery.dataTables.js"></script> 
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_page.css"/ >
<link rel="stylesheet" type="text/css" href="views/viewstablas/demo_table.css"/ > -->


<!-- PARA LAS FECHAS -->
<!-- <script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ > -->

<!-- PARA LAS VENTANAS EMERGENTES POPUPBOX -->
<!-- <script src="views/js/ajax/ajax_popupbox_empleados_registro_entrada_salida.js" type="text/javascript" charset="utf-8"></script>
<link href="views/css/stylepopupbox.css" rel="stylesheet" type="text/css"> -->



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

	<!-- TABLA id:frm_editar2-->
	/*$('#frm_carpetas').dataTable( { 
		'sPaginationType': 'full_numbers',
		
		 //ORDENAR POR LA COLUMNA ID, Y OCULTARLA
		 //POR AHORA NO SE USA EL OCULTAR, ESTA COMENTADO
		'aaSorting': [[ 0, 'desc' ]],     
		//'aoColumns': [{ "bSearchable": false,"bVisible":    false },null,null,null,null,null,null,null]
		'aoColumns': [null]
		
	} );*/
	
	var ip_servidor = "<?php echo $ip_plataforma; ?>";
	
	//var servidor   = "http://190.217.24.24/";
	var servidor   = "http://"+ip_servidor+"/";
	var plataforma = '/wamp/www/laborales/INCIDENTESALUD/';
	
	
	$('#JQueryFTD_Demo').fileTree({
			      //root: '/windows/',
				  
				  root: plataforma, 
				  
			      script: 'views/viewstree/jqueryFileTree.php',
			      expandSpeed: 1000,
			      collapseSpeed: 1000,
			      multiFolder: true
				  
			    }, function(file) {
			        
					//alert(file);
					
					//var res = file.substring(10, 43);
					
					var res = file.split("/");
					
					//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
					
					//var servidor = "http://172.16.176.194/";
					var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6];
					
					//alert(res_2);
					
					//file = $(this).attr("href");
					window.open(res_2, '_blank');
					return false;
					
					
	});
	
	
	
	


});
</script>	

<style type="text/css" media="screen">

.demo
{
	width: 800px;
	height: 400px;
	border-top: solid 1px #BBB;
	border-left: solid 1px #BBB;
	border-bottom: solid 1px #FFF;
	border-right: solid 1px #FFF;
	background: #FFF;
	overflow: scroll;
	padding: 5px;
}

</style>

 
</head>

<body>

	<?php 
		//imagen principal TEMIS, y iconos volver al menu principal y cerrar sesion 
		require 'header.php';
		//menus, con imagen del modulo
		require 'secc_archivo.php';
		
	?>			

	<table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td>
				
				<div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
						
						
					 	<div id="titulo_frm"><?php echo strtoupper($titulo); ?></div>
						
				
						<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						

							<tr>
					
								<td>
								
									<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="frm_carpetas">
													
												<thead> 
													<!-- <tr>
														<th bgcolor="#CDE3F9" colspan="6">
															<center><div id="titulo_frm"><?php //echo strtoupper($subtitulo); ?></div></center>
														</th>
													</tr> -->
													<tr> 
														<th>CARPETA(S):</th>
													</tr> 
												</thead> 
																
												<tbody> 
																
													<?php //$i = 0; while($i < $cantcarpetas){ ?>
											
														<tr>
															<td><?php //echo $listar2[$i];?></td>
											
														</tr>
														
														<tr>
															<td>
																<div id="JQueryFTD_Demo" class="demo"></div>
															</td>
														</tr>
														
													  	
													<?php //$i = $i + 1;	} ?>
																
												</tbody>
												
										</table>
									
									</td>
									
								</tr>
							
						</table>
					
					</form>
			
				</div>
				
			</td>
		</tr>
	
	</table>
	
	<!-- <table border="0" cellspacing="0" cellpadding="0" align="center">
  		
		<tr>
    		<td></td>
  		</tr>
		
		 <tr>
    		<td> -->
				<!-- NOTA: LOS ID DE LOS CAMPOS ME DAN LOS ESTILOS, UBICADOS EN centro_servicios\views\css\main.css
				TENIENDO EN CUENTA EL ID DE LA TABLA DONDE SE ENCUENTRAN LOS CAMPOS EN ESTE CASO frm_editar
				LA class="required" ME PERMITE VALIDAR UN CAMPO CON JQUERY-->
				<!-- <div id="contenido">
				
					<form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
					
						
					 	<div id="titulo_frm"><?php //echo strtoupper($titulo); ?></div> -->
						
						<!-- <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
						
						
							<tr>
								<td>
									<label style="width:151px; color:#666666">CARPETA(S):</label>
								</td>
								<td>
									<?php //echo $listar ?>
								</td>
								
							</tr>
						
						</table> -->
						
					
					<!-- </form>
					
			
				</div>
				
			</td>
		</tr>
		
	
	</table> -->
	
 
		
<?php require 'alertas.php';?>
</body>
</html>




	
