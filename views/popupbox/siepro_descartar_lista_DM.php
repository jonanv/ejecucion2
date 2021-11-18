<?php 
session_start(); 

if($_SESSION['id']!=""){

$valorradicado = trim($_POST['valorradicado']);

//echo $id;
//require_once('/centro_servicios/models/documentosModel.php');

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$existe_radicado = $funcion->Existe_Radicado_SJ($valorradicado);

if($existe_radicado == 0){
	
	echo "NO ES POSIBLE REALIZAR EL PROCESO, RADICADO ".$valorradicado." NO EXISTE";
	
	$valorradicado = " ";

}
else{

	
	
	//ACCION QUE DETERMINA QUE USUARIOS CREAN OBSERVACIONES PARA SER TENIDAS EN CUENTA AL ELIMINARLAS
	//OBSERVACIONES QUE ESPECIFICAN QUE EL PROCESO VA A DESPACHO
	$campos                = 'usuario';
	$nombrelista           = 'pa_usuario_acciones';
	$idaccion			   = '7';
	$campoordenar          = 'id';
	$datosusuarioacciones  = $funcion->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	
	

	$id_radicado = $funcion->get_idradicado_X($valorradicado);
	$registros   = $funcion->get_observaciones_radicado($id_radicado,trim($datosusuarioacciones,"////"));
	
	//echo trim($datosusuarioacciones,"////");

}
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script src="views/js/ajax/ajax_siepro_masivo.js" type="text/javascript"></script>

<!-- SE CIERRA LA LINEA ANTERIOR PARA NO TENER PROBLEMAS A LA HORA DE CATGAR UNA VENTANA EMERGENTE (popupbox)
Y SE TRAE EL CODIGO JAVASCRIPT DIRECTAMENTE A ESTE PHP, COMO ESTA ABAJO -->
<!-- Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental 
effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/. -->

<script type="text/javascript">

/*$('#cancel').click( function(){
								  
        $('#block').hide();
        $('#popupbox').hide();
		
});


function validar_campos_ponente(){
	
	
		if (document.formponente.valorradicadoponente.value.length == 0){
			
       			alert("Definir Radicado");
				document.getElementById('valorradicadoponente').style.borderColor='#FF0000';
       			return false;
		}
		
		if (document.formponente.listaponente.value.length == 0){
			
       			alert("Definir Ponente");
				document.getElementById('listaponente').style.borderColor='#FF0000';
       			return false;
		}
		
		
		if (confirm ("Esta Seguro de Cambiar Ponente")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}*/



</script>

<!-- <form action="index.php?controller=archivo&action=Radicador_Descatar_Lista" method="post" name ="formponente" id="formponente" onsubmit="return validar_campos_ponente();"> --> 

<form method="post" name ="form_radidl" id="form_radidl"> 

	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<!-- <button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button> -->
		
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">DESCARTAR RADICADO DE LA LISTA</td><br><br>
		</tr>
		<tr>
			
			<td>
				<label style="width:151px; color:#666666">RADICADO:</label>
						
			</td>
			
			<td>
				
				<input type="hidden" name="id_radidl" id="id_radidl" readonly="true" value="<?php echo trim($id_radicado); ?>">
				<input type="text" name="radidl_2" id="radidl_2" readonly="true" value="<?php echo trim($valorradicado); ?>">
			</td>
				
		</tr>
		
		
		
		<tr>
				
												
				<td colspan="2">
													
													
							<?php
							
						
								//$registros = $funcion->get_observaciones_radicado($id_radicado);
								
								
							?>
							
							
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="tcorres_1">
																		
						<thead> 
																		
							<tr> 
																			
								<th>ID</th>
								<th>FECHA</th>
								<th>OBSERVACION</th>
								
								
								<th>
									<strong style="width:151px; color:#FF0000; font-size:12px">ELIMINAR</strong>
								</th>
								
																			
							</tr> 
							
						</thead> 
																					
						<tbody> 
																					
							<?php 
																		
								$datosX  = explode("*/-*/-",$registros); 
								$longitud = count($datosX);
								$i          = 0;
								//echo $longitud_1;
																		
								while($i < $longitud - 1){ 
																		
									$datosX_2 = explode("------",$datosX[$i]);
																		
								?>
																
								<tr>
									
									<td>
										<?php 
																						  
											echo $datosX_2[0];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2[1];  
										?>
									</td>
									
									<td>
										
										<?php 
																						  
											echo $datosX_2[2];  
										?>
										
									</td>
									
									
									
									<td>
										<a class="eliminarobser" href="javascript:void(0);" title="ELIMINAR" data-idobser="<?php echo trim($datosX_2[0]);?>"><img src="views/images/pendiente.jpg" width="20" height="20" title="ELIMINAR"/></a>
									</td>
																				
									
																				
								</tr>
																		
																					
								<?php $i = $i + 1;  } ?>
																					
							</tbody>
							
						</table>
					
					
				</td>
				
				
			</tr>
		
		
		
							
						
	</table>
	

</form>

<?php } ?>


