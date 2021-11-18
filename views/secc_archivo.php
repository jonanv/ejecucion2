<?php

	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	//$modelo       = new signotModel();
	//**************************************************************************************************************************
	//EN ESTA PARTE DEFINO QUE USUARIOS PUEDO PONER A QUE EJECUTEN CIERTAS ACCIONES,COMO REGISTRAR,EDITAR, GENERAR UN REPORTE
	//SEGUN EN EL FORMULARIO QUE ME ENCUENTRE
	
	//$campos                         --> columna que contiene los codigos de los usuarios, los cuales van a ejecutar una accion especifica
	//$nombrelista                    --> tabla que contiene los registros de las acciones
	//$idaccion                       --> id de la accion a consultar en este caso (Editar, vista sigdoc_documentos_salientes.php)
	//$campoordenar                   --> campo por el que se ordena la consulta a la tabla pa_usuario_acciones
	//$datosusuarioacciones,$usuarios --> variables donde obtengo los valores de los usuarios concatenados de esta forma 46////55////45 
	//$usuariosa                      --> vector donde se cargan los codigos de los usuarios, y donde se comparara con 
    //	                                  if ( in_array($_SESSION['idUsuario'],$usuariosa) )
	//                                    segun el usuario logeado en el sistema y si dicho usuario puede ejecutar una accion especifica
	//**************************************************************************************************************************
	
	/*$campos          = 'usuario';
	$nombrelista     = 'pa_usuario_acciones';
	$idaccion	     = '18';
	$campoordenar    = 'id';
	$datos_JUZ       = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_JUZ_1  = $datos_JUZ->fetch();
	$usuariosa_JUZ_2 = explode("////",$usuarios_JUZ_1[usuario]);*/
	

	
?>

<div id="contentSecc_archivo">

	<ul id="menusec">

			  <li><a href="index.php?controller=menu&amp;action=mod_archivo_2">Home</a>  </li>

			  <div id="sep">|</div>

			  <li><a href="#">Expedientes</a>
			  
					  <ul class="submenu">
					  
							 <?php 
								if($_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario'] == 48 || $_SESSION['idUsuario'] == 51 || $_SESSION['idUsuario'] == 5 || $_SESSION['idUsuario'] == 42 || $_SESSION['idUsuario'] == 43 || $_SESSION['idUsuario'] == 59 || $_SESSION['idUsuario'] == 68){?>
								
									<li><a href="index.php?controller=archivo&amp;action=regUbicacionExpediente">Registrar Ubicaci&oacute;n Expedientes</a></li>
							 <?php 
								}
							?>
								   <li><a href="index.php?controller=archivo&amp;action=listarUbicacionExpediente">Listar Ubicaci&oacute;n Expedientes</a></li>

							<?php 
								if(/*$_SESSION['idUsuario'] == 8 ||*/ $_SESSION['idUsuario'] == 48 || $_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario'] == 51){?>   
									
									 
									<li>
										<a href="/laborales/repartomasivo/index.php">Reparto Masivo</a>
									</li>
													
							<?php 
								}
							?>
							
							<?php 
								if($_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 78){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&amp;action=Actualizar_Procesos">Actualizar Clase Proceso</a>
									</li>
													
							<?php 
								}
							?>
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==2 || $_SESSION['idUsuario']==42 || $_SESSION['idUsuario']==43 || $_SESSION['idUsuario']==49 || $_SESSION['idUsuario'] == 51 || $_SESSION['idUsuario'] == 26 || $_SESSION['idUsuario'] == 19 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 76 || $_SESSION['idUsuario'] == 83){?>   
									
									 
									<li>
										<a href="index.php?controller=aranceljudicial&action=Imprimir_Arancel">Consultar Arancel</a>
									</li>
													
							<?php 
								}
							?>
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==28 || $_SESSION['idUsuario'] == 51){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Listar_Titulos_Materializados">Listar Titulos Materializados</a>
									</li>
													
							<?php 
								}
							?>
							
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8  || $_SESSION['idUsuario']==3   || $_SESSION['idUsuario']==19 || 
								   $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==26 || $_SESSION['idUsuario']==49  || $_SESSION['idUsuario']==63 || 
								   $_SESSION['idUsuario']==68 || $_SESSION['idUsuario']==73 || $_SESSION['idUsuario']== 76 || $_SESSION['idUsuario']== 83){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Incorporar_Memorial">Incorporar Memorial al Proceso</a>
									</li>
									
									<li>
										<a href="index.php?controller=archivo&action=Correspondencia_Sin_Radicado">Correspondencia Sin Proceso</a>
									</li>	
													
							<?php 
								}
							?>
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==25){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Expediente_Memorial_Incorporado">Expediente con Memorial Incorporado</a>
									</li>
													
							<?php 
								}
							?>
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==4 || $_SESSION['idUsuario']== 83){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Ejecutoria">Ejecutoria</a>
									</li>
													
							<?php 
								}
							?>
							
							
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==39 || $_SESSION['idUsuario']== 83){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Ciento_Diez_Masivo">110 Masivo</a>
									</li>
													
							<?php 
								}
							?>
							
							
							
								
							<!-- <li><a href="#">Gestion de Calidad</a>
			  
										<ul class="submenu"> -->
										
											<?php 
												//if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==8){?>   
										 
												<!-- <li>
													
													<a href="index.php?controller=archivo&action=Adicionar_Accion_2">Resgistrar Accion</a>
													
													
			
												</li> -->
												
											<?php //}?>
											
											
											<!-- <li>
												
												<a href="index.php?controller=archivo&action=Gestionar_Actividad">Gestionar Actividad</a>
		
											</li>
										
										</ul>
										
			 					</li> -->
													
							 	<!-- SE REALIZA ESTE AJUSTE YA QUE EN ALGUNAS VISTAS SE TENDRIA QUE DEFINIR 
								$modelo    = new archivoModel(); -->
							 	<?php if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==53 || $_SESSION['idUsuario']==62 || $_SESSION['idUsuario']==64){//if ( in_array( $_SESSION['idUsuario'],$usuariosa_JUZ_2,true ) ){ ?>
							 
										<li>
											<a href= "index.php?controller=archivo&action=Adicionar_Obs">Asignar Observacion</a>
										</li> 
										
										<li>
											<a href="index.php?controller=archivo&action=Registrar_Estado_Masivo_Autos">Link Autos Estado</a>
										</li>
								
								<?php }?>
								
								
								<?php if(
										 	$_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']==19 || 
								         	$_SESSION['idUsuario']==52 || $_SESSION['idUsuario']==57 || $_SESSION['idUsuario']==67 ||
										 	$_SESSION['idUsuario']==53 || $_SESSION['idUsuario']==62 || $_SESSION['idUsuario']==64 || $_SESSION['idUsuario']==68 || $_SESSION['idUsuario']== 83
									   
									   	){ ?>
							 
										<li>
										
											<!-- <a href="index.php?controller=archivo&amp;action=Listar_Archivos_Escaneados">Listar Archivos Escaneados</a> -->
											
											      <a href="#">Incidentes</a>
											
												  <ul class="submenu">
												  
												  	<li>
										
														<a href="index.php?controller=archivo&amp;action=Listar_Archivos_Escaneados">Listar Incidentes Escaneados</a>
													
													</li>
													
													<li>
										
														<a href="index.php?controller=archivo&amp;action=Listar_Archivos_Escaneados_2">Estado Incidentes</a>
													
													</li>
												  	
												  </ul>
										</li> 
										
										
								
								<?php }?>
								
								
								<!-- <li>
									<a href="index.php?controller=archivo&amp;action=Lista_Expedientes_Bloqueados">Expedientes Bloqueados</a>
								</li> -->
							
							<!-- <li>
								<a href="http://172.16.176.194/laborales/mejora_continua">mejora continua</a>
							</li> -->


					  </ul>
			  </li>
			
			
			
			
			
			
				
			 <?php 
				/*if($_SESSION['idUsuario'] == 38 || $_SESSION['idUsuario'] == 19 || $_SESSION['idUsuario'] == 4  || 
				   $_SESSION['idUsuario'] == 8 || $_SESSION['idUsuario'] == 3 || $_SESSION['idUsuario']   == 47 || 
				   $_SESSION['idUsuario'] == 29 || $_SESSION['idUsuario'] == 26 || $_SESSION['idUsuario'] == 48 || 
				   $_SESSION['idUsuario'] == 51 || $_SESSION['idUsuario'] == 5 || $_SESSION['idUsuario']  == 43 || 
				   $_SESSION['idUsuario'] == 42 || $_SESSION['idUsuario'] == 58 || $_SESSION['idUsuario'] == 2
				   || $_SESSION['idUsuario'] == 60 || $_SESSION['idUsuario'] == 61 
				   || $_SESSION['idUsuario'] == 59 || $_SESSION['idUsuario'] == 36){*/
			  ?>  
								
			  <div id="sep">|</div>
			  
			  <li><a href="#">Documentos</a>
			  
					  <ul class="submenu">
							  
							 <li>
								<a href="index.php?controller=documentos&amp;action=Registro_Documentos">Registrar Documento</a>
							</li>
							
							<li>
								<a href= "index.php?controller=documentos&amp;action=Listar_Documentos_Salientes">Listar Documentos</a>
							</li> 
		
						</ul>
			  </li>
			  
			  <?php 
				//}
			  ?>
			  
			 
			  
			    
			  
			  <div id="sep">|</div>

			  <li><a href="#">Titulos de Otros Juzgados</a>
			  
					  <ul class="submenu">
					  
							 
							<?php 
								if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==28 || $_SESSION['idUsuario'] == 51){?>   
									
									 
									<li>
										<a href="index.php?controller=archivo&action=Listar_Titulos_OtrosJuzgados">Registrar Titulos de Otros Juzgados</a>
									</li>
									
													
							<?php 
								}
							?>
							
							<li>
									<a href="index.php?controller=archivo&action=Listar_Titulos_OtrosJuzgados_2">Listar Titulos de Otros Juzgados</a>
							</li>
							
							
						
					  </ul>
			  </li>
			  
			  
			  <?php 
				if($_SESSION['idUsuario'] == 55 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78 || $_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==51 || $_SESSION['idUsuario']== 83){
			  ?>
			  
			  <div id="sep">|</div>

			  <li><a href="#">Procesos Masivos</a>
			  
					  <ul class="submenu">
					  
					  		<!-- <li>
								<a><img src="views/images/cavernicola.jpg" width="65" height="65"/>VOLVER A LA EDAD DE PIEDRA</a>
							</li>  -->
							 
							<li>
								<a href="index.php?controller=archivo&action=Registrar_A_Despacho_Masivo">A Despacho Masivo</a>
							</li> 
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_Estado_Masivo">Estado Masivo</a>
							</li>
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_Estado_Masivo_Autos">Link Autos Estado</a>
							</li>
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_ParaArchivo_Masivo">Para Archivar Masivo</a>
							</li> 
							
							<!-- <li>
								<a href="index.php?controller=archivo&action=Registrar_Titulos_Banco_Agrario">Titulos Banco Agrario</a>
							</li>  -->
							
							
							<!-- DESISTIMIENTO TACITO MASIVO -->
							<!-- <li>
								<a href="index.php?controller=archivo&action=RegistrarADespacho_Masivo_Tacito_Despacho">Desistimiento Tacito Masivo Despacho</a>
							</li>
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_A_Despacho_Masivo_Tacito">Desistimiento Tacito Masivo Secretaria</a>
							</li>  -->
							
							<!-- SUSTITUCION DE PODER MASIVO -->
							
							<!-- <li>
								<a href="index.php?controller=archivo&action=Registrar_Sustitucion_Poder_Despacho">sustitucion poder Masivo Despacho</a>
							</li>     
							
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_Sustitucion_Poder_Secretaria">sustitucion poder Masivo Secretaria</a>
							</li>				 -->			
														
							<!--<li>
								<a href="index.php?controller=archivo&action=Actualizar_ClaseProceso_SigloXXI">Actualizar Clase Proceso SigloXXI</a>
							</li>
							
							<li>
								<a href="index.php?controller=archivo&action=Solo_A_Despacho">Solo A Despacho</a>
							</li> -->
							
							
							<?php 
							if($_SESSION['idUsuario']==38 || $_SESSION['idUsuario'] == 78){
						    ?>
							
							<!-- PROCESOS MASIVOS DESDE FORMUARIO SIEPRO OPCION ACTUACION JUSTICIA XXI MASIVA 
							Auto aprueba liquidaci�n cr�dito
							Auto modifica liquidacion presentada 
							Fijacion estado -->
							
							<li>
								
								<a href="index.php?controller=archivo&action=Registrar_Actuacion_Masivo">ACTUACION JUSTICIA XXI MASIVA</a>
								
							</li> 
							
							<!-- Auto aprueba liquidaci�n cr�dito -->
							
							<!-- <li>
								<a href="index.php?controller=archivo&action=Registrar_AALC_L1">Auto aprueba liquidacion credito</a>
							</li>     
							
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_AALC_L2">Fija estado AALC</a>
							</li>				 -->
							
							
							<!-- Auto modifica liquidacion presentada -->
							
							<!-- <li>
								<a href="index.php?controller=archivo&action=Registrar_AMLC_L1">Auto modifica liquidacion presentada</a>
							</li>     
							
							
							<li>
								<a href="index.php?controller=archivo&action=Registrar_AMLC_L2">Fija estado AMLC</a>
							</li> -->
							
							<?php 
							}
			 				?>
									
		
					  </ul>
			  </li>
			  
			  <?php 
				}
			  ?>
			
			<!-- <div id="sep">|</div>
		  
			  <li>
				
				<a href="index.php?controller=archivo&amp;action=Listar_Archivos">Archivos Compartida</a>  
			  
			  </li>  -->
			  
			  
			 <!--  <li>
		  
				<a href="#">Reportes</a>
				
				<ul class="submenu">
				
					
					<li>
						<a class="grafica" href="javascript:void(0);">Grafica Procesos</a>
					</li> 
					
				</ul>
				
		  	</li> -->
			
			
	  
	  </ul>

</div>