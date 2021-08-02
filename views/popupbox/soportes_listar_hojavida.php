<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();


$iduserfolder     = trim($_POST['iduserfolder']);
//$hvcedula  = trim($_POST['hvcedula']);

$idusuario = $_SESSION['idUsuario'];

$userhvcedula = trim($_POST['userhvcedula']);
$userhvnombre = strtoupper (trim($_POST['userhvnombre']));
//echo $idusuario;

echo '<script languaje="JavaScript">
            
      	var folder_usuario ="'.$iduserfolder.'";
            
	</script>';

//LISTA ESTUDIOS
//$datos_estudios = $funcion->get_lista_estudios($id_hv,'E');

$ip_plataforma = trim($_SESSION['ipplataforma']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<!-- <script src="views/js/ajax/ajax_radicador.js" type="text/javascript"></script> -->

<!-- SE CIERRA LA LINEA ANTERIOR PARA NO TENER PROBLEMAS A LA HORA DE CATGAR UNA VENTANA EMERGENTE (popupbox)
Y SE TRAE EL CODIGO JAVASCRIPT DIRECTAMENTE A ESTE PHP, COMO ESTA ABAJO -->
<!-- Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental 
effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/. -->

<script type="text/javascript">

	var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
	var servidor = "http://"+ip_servidor+"/";
	
	//var servidor = "http://190.217.24.24/";
	
	$('#cancel').click( function(){

		
        $('#block').hide();
        $('#popupbox').hide();
		
		
	});
	
	
	$('#JQueryFTD_Demo').fileTree({
			      //root: '/windows/',
				  
				  //root: '/wamp/www/ejecucion/HOJASDEVIDA/38/SOPORTES',
				  
  
				  root: '/wamp/www/ejecucion/HOJASDEVIDA/'+folder_usuario+'/',
				  
				 
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
					
					var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]+"/"+res[7];
					
					//alert(res_2);
					
					//file = $(this).attr("href");
					//$("#foto img").attr("src","views/fotos/hv_6.png");
					window.open(res_2, '_blank');
					return false;
					
					
	});
	
	
	
	
	<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
	
	
</script>


<!-- <form method="post" name ="formarchivo" id="formarchivo">  -->

	
	<!-- MENSAJES -->
	<div class="mensage"></div>  
	<div class="mensage_validar"> </div> 
	
	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<!-- <button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button> -->
		
	</div>

	<input name="id_modificar" id="id_modificar" type="hidden" readonly="true">
	<input name="datospartes" id="datospartes" type="hidden" readonly="true"/> 
	

	<!-- SOPORTES -->
	
	<table border="3" align="center" id="tabla_soporte_estudios" style="width:700px">
	
	
		<tr> 
																				
				<td align="center"><B>SOPORTES <?php echo " / CEDULA: ".$userhvcedula." NOMBRE: ".$userhvnombre; ?></B></td>
				
		</tr> 
		
		<tr>
			<td>
				<div id="JQueryFTD_Demo" class="demo" data-idusuario="<?php echo trim($idusuario);?>"></div>
			</td>
		</tr>

				
	</table>
	
	

<!-- </form> -->

<?php } ?>


