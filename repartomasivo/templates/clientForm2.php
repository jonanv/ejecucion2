	
<script src="ajax.js" type="text/javascript" charset="utf-8"></script>

<!-- ESTA PARTE SE DEFINE EN EL LAYAOUT MENOS jquery.js POR QUE EL LAYAOUT CUENTA YA CON resources/jquery-1.7.1.min.js -->
<!-- <script type="text/javascript" src="fecha/jquery.js"></script>
<script type="text/javascript" src="fecha/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="fecha/jquery.datetimepicker.css"/ > -->

<script type="text/javascript">
	$('#evefecha').datetimepicker();
</script>

<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{
?>
<h2><?php echo $view->label ?></h2>
<form name ="client" id="client" method="POST" action="index.php" onsubmit="return validar_campos_clientForm2();"> 
    <input type="hidden" name="id" id="id" value="<?php print $view->client->getId() ?>">
	
	<?php
			//INFORMACION NECESARIA PARA CREAR UN REGISTRO EN LA TABLA log
			date_default_timezone_set('America/Bogota'); 
		
			$fechaa=date('Y-m-d g:ia');
		
			$horaa=explode(' ',$fechaa);
		
			$fechal=$horaa[0];
			  
			$hora=$horaa[1]; 
			 
			if($view->label == "Nuevo Evento"){
				$accion='Resgistr&oacute; Evento ';
			}
			else{
				$accion='Modific&oacute; Evento ';
			}
			
			$detalle=$_SESSION['nombre']." ".$accion.$fechal." "."a las: ".$hora;
			
			$tipolog=1;
	
	?>
	<!-- CAMPO OCULTO EL CUAL ESTA CARGADO CON LOS DATOS ANTERIORES -->
	<input type="hidden" name="datoslog" id="datoslog" size="100" maxlength="100" value="<?php print $fechal."///////".$accion."///////".$detalle."///////".$_SESSION['idUsuario']."///////".$tipolog?>">
	
	<input type="hidden" name="datoid" id="datoid" />
	
	<div> 
		<label>Radicado</label><!-- value = "<?php //print $view->client->getDatoradicado() ?>" -->
		<input type="text" name="datoradicado" id="datoradicado" size="40" value = "170014003" onKeyUp="Buscar_Radicado_Filtro_2(client.datoradicado.value)"/>
		<button type="button" name="boton_adicionar" id="boton_adicionar" title="Adicionar" onClick="Adicionar_Reparto()"><img src="/ejecucion/repartomasivo/imagenes/add.png" width="20" height="20"/></button>
	</div>
	<div> 
		<label>Ced Demandante</label>
		<input type="text" name="cedula_demandante" id="cedula_demandante" size="40"/>
	</div>
	<div> 
		<label>Demandante</label>
		<input type="text" name="demandante" id="demandante" size="40" />
	</div>
	<div> 
		<label>Ced Demandado</label>
		<input type="text" name="cedula_demandado" id="cedula_demandado" size="40"/>
	</div>
	<div> 
		<label>Demandado</label>
		<input type="text" name="demandado" id="demandado" size="40"/>
	</div>
	
	
	<div>
	
		<label>Piso</label>
		
		
			<select name="piso" id="piso">
				<option value = "<?php print $view->client->getPiso() ?>" ></option>
               	<option value="1">1</option>
              	<option value="4">4</option>
            </select>
    </div>
	
	<div>
	
		<label>Estado</label>
		
			<select name ="estado" id="estado" onChange="Traer_Lista(this.value)">
					<option value = "<?php print $view->client->getEstado() ?>" ></option>
						<?php
							
							$n = count($view->listaestado);
							foreach ($view->listaestado as $fa):
							
								echo "<option value=\"". $fa['id'] ."\">" . htmlentities($fa['nombre']) . "</option>";
							
							endforeach;
						
						?>
								
			</select>
			
    </div>
	
	<div>
	
		<label>Detalle Estado</label>
	
			<!-- <select name ="detalleestado" id="detalleestado" onChange="Valor_Lista(this.value)">
				<option value = "<?php //print $view->client->getDetalleestado() ?>" ></option>
			</select> -->
			
			<select name ="detalleestado" id="detalleestado">
				<option value = "<?php print $view->client->getDetalleestado() ?>" ></option>
				
					<?php
							
							$n = count($view->listadetalleestado);
							foreach ($view->listadetalleestado as $fa):
							
								echo "<option value=\"". $fa['id'] ."\">" . htmlentities($fa['nombre']) . "</option>";
							
							endforeach;
						
						?>
			</select>
			
    </div>
	
	<div>
	
		<label>Clase Proceso</label>
		
			<select name ="claseproceso" id="claseproceso">
					<option value = "<?php print $view->client->getClaseproceso() ?>" ></option>
						<?php
							
							$n = count($view->listaclaseproceso);
							foreach ($view->listaclaseproceso as $fa):
							
								echo "<option value=\"". $fa['id'] ."\">" . htmlentities($fa['nombre']) . "</option>";
							
							endforeach;
						
						?>
								
			</select>
			
    </div>
	
	<h2><?php echo $view->label_2 ?></h2>
	
    <div class="field">
        
		<label>Fecha</label>
		<input name="evefecha" id="evefecha" type="text" readonly="true" value="<?php print $view->client->getEvefecha() ?>">
		
    </div>
	
	
	
	<div>
        <label>Juzgado Reparto</label>
		
			<select name ="evejuzgadoreparto" id="evejuzgadoreparto">
						<option value = "<?php print $view->client->getEvejuzgadoreparto() ?>" ></option>
							<?php
								
								$n = count($view->juzgadoreparto);
								foreach ($view->juzgadoreparto as $jr):
									
									if(($jr[id]==1)|| ($jr[id]==2)){
										echo "<option value=\"". $jr['id'] ."\">" . htmlentities($jr['nombre']) . "</option>";
									}
								
								endforeach;
							
							?>
								
			</select>
		
    </div>
	
	<div>
        <label>Cambiar Ponente</label>
		
			<select name ="cambiarponente" id="cambiarponente">
						<option value = "<?php print $view->client->getCambiarponente() ?>" ></option>
							<?php
								
								$n = count($view->listaponente);
								foreach ($view->listaponente as $pone):
									
									//echo "<option value=\"". $pone['codi_pone'] ."\">" . $pone['nom_pone'] . "</option>";
									
									echo "<option value=\"". $pone['codi_pone'] ."-".$pone['nom_pone']."-".$pone['codi_enti']."-".$pone['codi_espe']."-".$pone['codi_nume']."\">" . $pone['nom_pone'] . "</option>";
									
									//echo "<option value=\"". $pone['codigo'] ."\">" . $pone['ponente'] . "</option>";
									
								endforeach;
								
								
							?>
								
			</select>
		
    </div>
	
	
	
	<div>
        <label>Observaciones</label>
			
			<!-- <textarea name="observaciones" id="observaciones" disabled="true"></textarea> -->
			
      		<select name ="observaciones[]" id="observaciones[]"  multiple="multiple" size="8"/>
	  		</select>
			
    </div>
	
	<div>
        <label>Nueva Observaciones</label>
			
			<!-- <textarea name="nuevaobservacion" id="nuevaobservacion" rows="1" cols="1"></textarea> -->
			<input type="text" name="nuevaobservacion" id="nuevaobservacion" size="60">
			
    </div>
	
	<a id="recorrer" href="javascript:void(0);" title="Registrar Reparto" style="float:right "><img src="/ejecucion/repartomasivo/imagenes/save.png" width="30" height="30" title="Registrar Reparto"/></a>
	<a id="cancel" href="javascript:void(0);" title="Cancelar" style="float:right "><img src="/ejecucion/repartomasivo/imagenes/cancel2.png" width="30" height="30" title="Cancelar"/></a>
	<a id="eliminar" href="javascript:void(0);" title="Eliminar toda la Tabla" style="float:left" onClick="Eliminar_Tabla()"><img src="/ejecucion/repartomasivo/imagenes/eliminar.png" width="30" height="30" title="Eliminar toda la Tabla"/></a>
	
	<table>

		<tr>
			<td>
				<div id="cont"> 
					<table id="t" border="1"> 
						<tr>
							
							<td>
								<strong>Id</strong>
							</td>
							<td>
								<strong>Radicado</strong>
							</td>
							<td>
								<strong>Ced Demandante</strong>
							</td>
							<td>
								<strong>Demandante</strong>
							</td>
							<td>
								<strong>Ced Demandado</strong>
							</td>
							<td>
								<strong>Demandado</strong>
							</td>
							<td>
								<strong>Piso</strong>
							</td>
							<td>
								<strong>Estado</strong>
							</td>
							<td>
								<strong>Clase Proceso</strong>
							</td>
							<td>
								<strong>Fecha Reparto</strong>
							</td>
							<td>
								<strong>Juzgado Reparto</strong>
							</td>
							<td>
								<strong>Ponente</strong>
							</td>
							<td>
								<strong>Observacion</strong>
							</td>
						
						</tr> 
					</table>
				</div>
			</td>
		</tr>
		
		
	</table>
	
	
	
	
   <!--  <div class="buttonsBar"> -->
		<!-- forma original de la rejilla -->
        <!-- <input id="cancel" type="button" value ="Cancelar" /> -->
        <!-- <input id="submit" type="submit" name="submit" value ="Guardar" /> -->
		
		<!-- <button id="cancel" type="button" name="boton_cancelar" title="Cancelar"><img src="/ejecucion/repartomasivo/imagenes/cancel2.png" width="30" height="30"/></button>
		<button id="submit" type="submit" name="boton_registrar" title="Registrar"><img src="/ejecucion/repartomasivo/imagenes/save.png" width="30" height="30"/></button>
		
    </div> -->
	
	
</form>
<?php } //print $view->client->getEveradicado();//echo $n."-------".$row; 


			
				/*echo '<script languaje="JavaScript"> 
									
						var dat_1 = "'.$view->client->getEveaccion().'";
						
						Buscar_Item_Combo_2(dat_1);
						
						
									
					</script>'; */
			
			?>


