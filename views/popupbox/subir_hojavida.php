<?php

$id_hv        = trim($_POST['id_hv']);
$hvcedula     = trim($_POST['hvcedula']);
$idusuario_HV = trim($_POST['idusuario']);

?>
<!-- <!doctype html>
<html lang="es">
<head> <meta charset="UTF-8"> -->

	<script type="text/javascript">
	
		$('#cancel').click( function(){
									  
			$('#block').hide();
			$('#popupbox').hide();
			
		});
		
		function Validar_Campos(){
		
			valor = document.getElementById('archivo').value;
	
	
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
				alert("Defina archivo");
				document.getElementById('archivo').style.borderColor = '#FF0000';
				return false;
			}
		
		}
		
		
		
	</script>
			
	<title>Guardar Multiples Archivos</title>
	
	<!-- </head>
	<body> -->
		     <center><h1 style="font-size:16px">CAMBIAR FOTO</h1></center>
		
			<div class="buttonsBar">
				
				<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		
			</div>
		
			<!-- Formulario para subir los archivos -->
			<div class="mensage"> </div>  
			
		    <form action="index.php?controller=hojavida&action=Administrar_HojaVida_CambiarFoto" id="formfoto" name="formfoto"  method="post" enctype="multipart/form-data" onSubmit="return Validar_Campos()">
			
				<input name="id_hv_s" id="id_hv_s" type="hidden" readonly="true" value=<?php echo $id_hv; ?>>
				<input name="hvcedula_s" id="hvcedula_s" type="hidden" readonly="true" value=<?php echo $hvcedula; ?>>
				<input name="idusuario_HV" id="idusuario_HV" type="hidden" readonly="true" value=<?php echo $idusuario_HV; ?>>
				
				<table align="center">
					<tr>
						<td style="font-size:16px"><h1>Archivo</h1></td>
						
						<td><input type="file" id="archivo" name="archivo" style="font-size:16px"></td><!-- Este es nuestro campo input File-->
						 
					</tr>
					
					<tr>
						<td></td>
						<td><button type="submit" id="registrar"><img src="views/images/hv_6.png" width="35" height="35" title="CAMBIAR FOTO"/><h1>CAMBIAR FOTO</h1></button></td>
					</tr>    
				</table>
			
			</form>
			
	<!-- </body>
</html> -->