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
	
    <div class="field">
        
		<label>Fecha</label>
		<input name="evefecha" id="evefecha" type="text" readonly="true" value="<?php print $view->client->getEvefecha() ?>">
		
    </div>
    <div class="field">
        <label>Asunto</label>
        <input type="text" name="eveasunto" id="eveasunto" size="40" value = "<?php print $view->client->getEveasunto() ?>">
    </div>
    <div>
	
		<label>Accion</label>
		
			<select name ="eveaccion" id="eveaccion">
					<option value = "<?php print $view->client->getEveaccion() ?>" ></option>
						<?php
							
							$n = count($view->accion);
							foreach ($view->accion as $emp):
							
								echo "<option value=\"". $emp['id'] ."\">" . $emp['acc_descripcion'] . "</option>";
							
							endforeach;
						
						?>
								
			</select>
			
    </div>
	
	 <div>
	
		<label>Asignado a</label>
		
			<select name ="eveasignadoa" id="eveasignadoa">
					<option value = "<?php print $view->client->getEveasignadoa() ?>" ></option>
						<?php
							
							$n = count($view->asignado);
							foreach ($view->asignado as $fa):
							
								echo "<option value=\"". $fa['id'] ."\">" . $fa['empleado'] . "</option>";
							
							endforeach;
						
						?>
								
			</select>
			
    </div>
	
	<div> 
		<label>Buscar Radicado</label>
		<input type="text" name="texto_buscar" id="texto_buscar" size="40" onKeyDown="Buscar_Radicado_Filtro(client.texto_buscar.value)"/>
		<!-- <button type="button" name="boton_buscar" title="Buscar Radicado" onClick="Buscar_Radicado_Filtro(client.texto_buscar.value)"><img src="/ejecucionprueba/eventos/imagenes/loupe.png" width="20" height="20"/></button> -->
	 
		<!-- <input type="text" name="filtro_buscar" id="filtro_buscar" size="40"/>
		<a class="filtro_radicado" href="javascript:void(0);"><img src="/ejecucionprueba/eventos/imagenes/loupe.png" width="30" height="30" title="Buscar"/></a> -->
	 
	</div>
	
    <div>
        <label>Radicado</label>
       <input type="text" name="everadicado" id="everadicado" size="40"  readonly="true" value = "<?php print $view->client->getEveradicado() ?>">
	   <button type="button" name="boton_adicionar" title="Adicionar Radicado" onClick="Adicionar_Radicado(client.everadicado.value)"><img src="/ejecucion/eventos/imagenes/add.png" width="20" height="20"/></button>
    </div>
	
	<div>
        <label>Juzgado de Reparto</label>
		
			<select name ="evejuzgadoreparto" id="evejuzgadoreparto" disabled="true">
						<option value = "<?php print $view->client->getEvejuzgadoreparto() ?>" ></option>
							<?php
								
								$n = count($view->juzgadoreparto);
								foreach ($view->juzgadoreparto as $jr):
								
									echo "<option value=\"". $jr['id'] ."\">" . $jr['nombre'] . "</option>";
								
								endforeach;
							
							?>
								
			</select>
		
    </div>
	
	<div>
        <label>Radicados</label>
		<!-- <textarea name="evedescripcion" id="evedescripcion"><?php //print $view->client->getEvedescripcion() ?></textarea> -->
		
		<select name ="evedescripcion[]" id="evedescripcion[]"  multiple="multiple" size="8" value = "<?php print  $view->client->getEvedescripcion() ?>"/>
		</select>
		
		<!-- FUNCIONA A MEDIAS, ES DECIR BORRA DE LA LISTA PERO AL AGREGRAR OTRO RADICADO REAPARECE EL ELIMINADO -->
		<!-- <button type="button" name="boton_eliminar" onClick="Eliminarlista()" title="Eliminarlista"><img src="/ejecucionprueba/eventos/imagenes/eliminar.png" width="20" height="20"/></button>  -->
		
    </div>
	
	<div>
		<!-- CAMPO OCULTO EN EL CUAL CONCATENO LOS RADICADOS Y JUZGADOS -->
		<input type="hidden" name="evedatos" id="evedatos" size="100" maxlength="10000" value = "<?php print  $view->client->getEvedatos() ?>"/>
	</div>
	
	<!-- <div>
        <label>Juzgado de Reparto</label>
		
    </div> -->
	
	
	
    <div class="buttonsBar">
		<!-- forma original de la rejilla -->
        <!-- <input id="cancel" type="button" value ="Cancelar" /> -->
        <!-- <input id="submit" type="submit" name="submit" value ="Guardar" /> -->
		
		<button id="cancel" type="button" name="boton_cancelar" title="Cancelar"><img src="/ejecucion/eventos/imagenes/cancel2.png" width="30" height="30"/></button>
		<button id="submit" type="submit" name="boton_registrar" title="Registrar"><img src="/ejecucion/eventos/imagenes/save.png" width="30" height="30"/></button>
		
    </div>
	
	
</form>
<?php } //print $view->client->getEveradicado();//echo $n."-------".$row; 


			
				echo '<script languaje="JavaScript"> 
									
						var dat_1 = "'.$view->client->getEveaccion().'";
						
						Buscar_Item_Combo_2(dat_1);
						
									
					</script>'; 
			
			?>


