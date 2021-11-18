<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();


$id_certificado      = trim($_POST['id_certificado']);
$id_certificado_doc  = trim($_POST['id_certificado_doc']);

$idusuario = $_SESSION['idUsuario'];

//echo $id_certificado."---".$id_certificado_doc;


//LISTA CERTIFICADOS
$datos_certificados = $funcion->get_lista_certificados($id_certificado,$id_certificado_doc);

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
	
	
	<!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
	
	
</script>


<!-- <form method="post" name ="formarchivo" id="formarchivo">  -->

	<div class="buttonsBar">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<!-- <button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button> -->
		
	</div>

	<input name="id_modificar" id="id_modificar" type="hidden" readonly="true">
	<input name="datospartes" id="datospartes" type="hidden" readonly="true"/> 
	
	
	<!-- ESTUDIOS -->
	<?php if($id_certificado_doc  == "E"){ ?>
	
		<table border="3" align="center" id="tabla_estudios" style="width:700px">
		
			
			<tr>
				<td align="center" colspan="5" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">CERTIFICADOS</td>
			</tr>
			
			
			<tr> 
																				
				<td><B>ID</B></td>
				<!-- <td><B>ID MODALIDAD</B></td> -->
				<td><B>MODALIDAD</B></td>
				<!-- <td><B>ID TIPO MODALIDAD</B></td> --> 
				<td><B>TIPO MODALIDAD</B></td>
				<td><B>INSTITUCION</B></td>
				
				<td>
										
					<strong style="width:151px; color:#FF0000; font-size:12px">CERTIFICADO</strong>
					
				</td>
									
			</tr> 
			
			
			<?php 
																			
				$datosXPEC    = explode("*/-*/-",$datos_certificados); 
				$longitudPEC  = count($datosXPEC);
				$iEC          = 0;
				//echo $longitud_1;
									
				$CiEC=1;
																			
				while($iEC < $longitudPEC - 1){ 
																			
					$datosX_2PEC = explode("------",$datosXPEC[$iEC]);
																			
				?>
																	
					<tr>
										
						<td style="font-size:14px">
							<B style="color:#FF0000">
							<?php 
																							  
								echo $datosX_2PEC[0];  
							?>
							</B>
						</td>
						
						<!-- <td style="font-size:14px"> -->
							<?php 
																							  
								//echo $datosX_2PE[4];  
							?>
						<!-- </td> -->
										
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[1];  
							?>
						</td>
						
						
						<!-- <td style="font-size:14px"> -->
							<?php 
																							  
								//echo $datosX_2PE[5];  
							?>
						<!-- </td> --> 
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[2];  
							?>
						</td>
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[3];  
							?>
						</td>
										
										
						<!-- <td align="center">
							<a href="<?php //echo trim($datosX_2PE[11]); ?>"><img src="views/images/ipdf3.png" width="30" height="30"/></a>
						</td>					 -->
						
						
						<td align="center">
					
							<!-- target="_blank" ETIQUETA PARA ABRIR UNA NUEVA VENTANA-->
							<a href="<?php echo trim($datosX_2PEC[11]);?>" target="_blank"><img src="views/images/ipdf3.png" width="30" height="30" title="<?php echo trim($datosX_2PEC[11]);?>"/></a>
							
						</td>	
						
	
										
																					
					</tr>
																			
																						
			<?php $iEC = $iEC + 1; $CiEC = $CiEC+1;} ?>
			
					<!-- TAMBIEN FUNCIONA -->
					<!-- <tr>
						
						<td colspan="5">
						
							<label style="width:151px;">DOCUMENTO</label>
						
							<div id = "reporte">
							
								<iframe id = "impresion" width="80%" height="100%">
							
								</iframe>
							
							</div>	
							
						</td>
					
					</tr> -->
					
					
			
			
		</table>
	
	<?php } ?>
	
	
	
	
	<!-- //EXPERIENCIA LABORAL -->
	<?php if($id_certificado_doc  == "L"){ ?>
	
		<table border="3" align="center" id="tabla_experiencia" style="width:700px">
		
			
			<tr>
				<td align="center" colspan="7" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">CERTIFICADOS</td>
			</tr>
			
			
			<tr> 
																				
				<td><B>ID</B></td>
				<td><B>ENTIDAD</B></td>
				<td><B>DIRECCION</B></td>
				<td><B>TELEFONO</B></td>
				<td><B>PERIODO</B></td>
				<td><B>CARGO</B></td>
				
				<td>
										
					<strong style="width:151px; color:#FF0000; font-size:12px">CERTIFICADO</strong>
					
				</td>
									
			</tr> 
			
			
			<?php 
																			
				$datosXPEC    = explode("*/-*/-",$datos_certificados); 
				$longitudPEC  = count($datosXPEC);
				$iEC          = 0;
				//echo $longitud_1;
									
				$CiEC=1;
																			
				while($iEC < $longitudPEC - 1){ 
																			
					$datosX_2PEC = explode("------",$datosXPEC[$iEC]);
																			
				?>
																	
					<tr>
										
						<td style="font-size:14px">
							<B style="color:#FF0000">
							<?php 
																							  
								echo $datosX_2PEC[0];  
							?>
							</B>
						</td>
						
						
										
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[1];  
							?>
						</td>
						
						
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[2];  
							?>
						</td>
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[3];  
							?>
						</td>
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[4];  
							?>
						</td>
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[5];  
							?>
						</td>
						
						
						<td align="center">
					
							<!-- target="_blank" ETIQUETA PARA ABRIR UNA NUEVA VENTANA-->
							<a href="<?php echo trim($datosX_2PEC[7]);?>" target="_blank"><img src="views/images/ipdf3.png" width="30" height="30" title="<?php echo trim($datosX_2PEC[7]);?>"/></a>
							
						</td>	
						
	
										
																					
					</tr>
																			
																						
			<?php $iEC = $iEC + 1; $CiEC = $CiEC+1;} ?>
			
					
			
		</table>
	
	<?php } ?>
	
	
	
	
	<!-- //ACTOS ADMINISTRATIVOS -->
	<?php if($id_certificado_doc  == "AD"){ ?>
	
		<table border="3" align="center" id="tabla_experiencia" style="width:700px">
		
			
			<tr>
				<td align="center" colspan="5" style="width:180px; height:23px; border-color:#0100000; color:#FF0000; font-size:16px ">ACTAS</td>
			</tr>
			
			
			<tr> 
																				
				<td><B>ID</B></td>
				<td><B>NUN RESOLUCION</B></td>
				<td><B>MOTIVO</B></td>
				<td><B>FECHA</B></td>
				
				
				<td>
										
					<strong style="width:151px; color:#FF0000; font-size:12px">ACTA</strong>
					
				</td>
									
			</tr> 
			
			
			<?php 
																			
				$datosXPEC    = explode("*/-*/-",$datos_certificados); 
				$longitudPEC  = count($datosXPEC);
				$iEC          = 0;
				//echo $longitud_1;
									
				$CiEC=1;
																			
				while($iEC < $longitudPEC - 1){ 
																			
					$datosX_2PEC = explode("------",$datosXPEC[$iEC]);
																			
				?>
																	
					<tr>
										
						<td style="font-size:14px">
							<B style="color:#FF0000">
							<?php 
																							  
								echo $datosX_2PEC[0];  
							?>
							</B>
						</td>
						
						
										
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[1];  
							?>
						</td>
						
						
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[2];  
							?>
						</td>
						
						<td style="font-size:14px">
							<?php 
																							  
								echo $datosX_2PEC[3];  
							?>
						</td>
				
						
						<td align="center">
					
							<!-- target="_blank" ETIQUETA PARA ABRIR UNA NUEVA VENTANA-->
							<a href="<?php echo trim($datosX_2PEC[4]);?>" target="_blank"><img src="views/images/ipdf3.png" width="30" height="30" title="<?php echo trim($datosX_2PEC[4]);?>"/></a>
							
						</td>	
						
	
										
																					
					</tr>
																			
																						
			<?php $iEC = $iEC + 1; $CiEC = $CiEC+1;} ?>
			
					
			
		</table>
	
	<?php } ?>	
	
	
	

<!-- </form> -->

<?php } ?>


