<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$id_accion = trim($_POST['id']);


$datosdelit_4F  = $funcion->get_datos_ACCION($id_accion);
$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
$long_4F        = count($datosdelit_4BF);
	

?>

<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> -->

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<script type="text/javascript">

$('document').ready(function(){

		$('#cancel').click( function(){
								  
        	$('#block').hide();
        	$('#popupbox').hide();
		
    	});
		
	  
});

</script>


		
		<div class="buttonsBar">
		
			<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
			<!-- <button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button> -->
			
		</div>
	
		<table border="0" align="center">
		
		
			
			
			<tr>
				
												
				<td>
											
					<table cellpadding="0" cellspacing="0" rules="rows">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="12">
									<center>DETALLE ACCION</center>
								</th>
							</tr>
																		
							<tr> 
							
						
								
								<!-- <th style="color:#FF0000; font-size:10px">ID</th> -->
								<th style="font-size:10px">CLASE</th>
								<th style="font-size:10px">NUMERAL NORMA</th>
								<th style="font-size:10px">DES HALLAZGO</th>
								<th style="font-size:10px">PROCESO RESPONSABLE</th>
								<th style="font-size:10px">PROCESO AFECTADO O IMPACTADO</th>
								<th style="font-size:10px">ANALISIS DE CAUSAS</th>
								<th style="font-size:10px">METODOLOGIA</th>
								<th style="font-size:10px">GENERADA POR</th>
								<th style="font-size:10px">FECHA REGISTRO</th>
								<th style="font-size:10px">HORA REGISTRO</th>
								<th style="font-size:10px">ESTADO</th>
								
								
						
							</tr>
							
						
						</thead>
						
						<tbody> 
						
						<?php
			
							
							$il = 0;
																				
							while($il < $long_4F - 1){
																				
								$datosdelit_4CF = explode("******",$datosdelit_4BF[$il]); ?>
								
								<tr>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[1]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[2]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[3]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[5]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[6]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[4]);
										?>
									</td>
	
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[7]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo utf8_encode($datosdelit_4CF[8]);
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[9];
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[10];
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
											
											if($datosdelit_4CF[11] == 0){ echo "EN PROCESO"; }else{ echo "TERMINADA"; }
																																	  
											//echo $d12M; 
											
											
										?>
									</td>
									
									
								
								</tr>
																									
																												
							<?php $il = $il + 1; } ?>	
						
							</tbody> 	
					
					</table>	
				
				</td>
											
			</tr> 
			
			
		
		</table>
		
	
<?php  } ?>


