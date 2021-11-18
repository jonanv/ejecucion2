<?php 
session_start(); 

if($_SESSION['id'] == ""){
	header("refresh: 0; URL=/ejecucion/"); 
}
else{

$id = trim($_POST['id']);

//echo $id;


/*include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$radicado  = $funcion-> get_idradicado($id);
$radicado2 = explode("//////",$radicado);*/

//echo $radicado;

?>

<script type="text/javascript" src="views/fechajquery/jquery2.js"></script>

<!-- SE CIERRA ESTA LINEA YA QUE PRESENTA INCOSISTENCIAS, Y SE TRAE LA FUNCION $('#cancel').click( function(){ DIRECTAMENTE EN ESTE ARCHIVO-->
<!-- <script src="views/js/ajax/ajax_sieprootrosjuzgados.js" type="text/javascript" charset="utf-8"></script> -->

<!-- PARA LAS FECHAS -->
<script type="text/javascript" src="views/fechajquery/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="views/fechajquery/jquery.datetimepicker.css"/ >

<script type="text/javascript">

$(document).ready(function() {
	
	//PARA LAS FECHAS
	$('#fechas').datetimepicker();
	
	$('#cancel').click( function(){
        $('#block').hide();
        $('#popupbox').hide();
		
    });
	

});



</script>	

<script type="text/javascript">

function validar_campos(){
	
	
	valor  = document.getElementById('fechas').value;
	

	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Fecha Pago");
		document.getElementById('fechas').style.borderColor = '#FF0000'
		return false;
	}
	
	if (confirm ("Esta seguro de Realizar la Asignacion")) {
		
    	return true;
			
			
    } 
	else{return false;}
	
	
	
	

}
</script>	

<form action="index.php?controller=archivo&action=AsignarFechaPago" method="post" name ="form2" id="form2" onsubmit="return validar_campos();"> 

	<div class="buttonsBar">
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
	</div>

	<table border="0" align="center">
	
		<tr>
			<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ASIGNAR FECHA DE PAGO</td><br><br>
		</tr>
		
		<tr>
			<td>
			
				<label style="width:180px; height:23px; border-color:#000000; font-size:16px; ">Fecha Pago</label><br>
				<input name="fechas" id="fechas" type="text" readonly="true" size="12" title="Fecha Pago">
				<input name="idtitulo" id="idtitulo" type="hidden" readonly="true" value="<?php echo $id; ?>">
			
			</td>
			
			
		
		</tr>
							
		
	
	</table>
	

</form>

<?php } ?>


