<?php 
session_start(); 

if($_SESSION['id']!=""){

$valor_id       = trim($_POST['valor_id']);
$valor_radicado = trim($_POST['valor_radicado']);

//echo "valor_id: ".$valor_id." valor_radicado: ".$valor_radicado;


echo '<script languaje="JavaScript">
            
      	var valor_id ="'.$valor_id.'";
            
	</script>';

?>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	
	<style>
	.contenedor{margin:60px auto;width:960px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	th {padding:5px; background-color:#555;color:#fff}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable span{display:block;}
		.editable span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
			
		
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
	</style>
	

	<div class="buttonsBar" style="float:right">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		
	</div>

	<div class="contenedor">
		<h1 style="color:#FF0000; font-size:16px">EDITAR LIQUIDACIONES PROCESO:<?php echo $valor_radicado; ?></h1>
		<div class="mensaje"></div>
		<!-- <img src="images/loading.gif"> -->
		<table class="editinplace">
			<tr>
				<th>ID</th>
				<th style="color:#FF0000; font-size:16px">NUM</th>
				<th>FECHA</th>
				<th>HORA</th>
				<th>NUEVO</th>
				<th>LIQ CREDITO</th>
				<th>OBSERVACION</th>
			</tr>
		</table>
	</div>
	
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->
	
	<script>
	$(document).ready(function() 
	{
	

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/editinplace.php?tabla=1",
			data: { valor_id: valor_id }
		})
		.done(function(json) {
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++)
			{
				
				$('.editinplace').append(
					"<tr><td class='id'>"+json[i].id+"</td><td style='color:#FF0000; font-size:16px' class='nunentrada'>"+json[i].nunentrada+"</td><td class='editable' data-campo='fechae' data-tipocampo=2><span>"+json[i].fechae+"</span></td><td class='horae'>"+json[i].horae+"</td><td class='editable' data-campo='nuevo' data-tipocampo=4><span>"+json[i].nuevo+"</span></td><td class='editable' data-campo='liquidacioncredito' data-tipocampo=4><span>"+json[i].liquidacioncredito+"</span></td><td class='editable' data-campo='observacioncostas' data-tipocampo=3><span>"+json[i].observacioncostas+"</span></td></tr>");
			}
		});
		/*------------------- */
		
		/* FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
		var td,campo,valor,id;
		var tipocampo = 0;
		

		$(document).on("click","td.editable span",function(e)
		{
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td    = $(this).closest("td");
			campo = $(this).closest("td").data("campo");
			tipocampo = $(this).closest("td").data("tipocampo");
			//alert(campo);
			valor = $(this).text();
			id    = $(this).closest("tr").find(".id").text();
			//alert(id);
			
			//CAMPO DE TEXTO
			if(tipocampo == 1){
			
				td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO FECHA
			if(tipocampo == 2){
				
				td.text("").html("<input type='text' id='"+campo+"' name='"+campo+"' value='"+valor+"' readonly='true'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				$("#fechae").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo == 3){
			
				td.text("").html("<textarea name='"+campo+"' cols='45' rows='5'>"+valor+"</textarea><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO DE SELECT 
			if(tipocampo == 4){
			
				td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			}
			
			
			
		});
		
		
	
		$(document).on("click",".cancelar",function(e)
		{
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});
		
		
		
		
		$(document).on("click",".guardar",function(e)
		{
			
			$(".mensaje").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO Y FECHAS
			if(tipocampo == 1 || tipocampo == 2){
				nuevovalor=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo == 3){
				nuevovalor=$(this).closest("td").find("textarea").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo == 4){
				nuevovalor=$(this).closest("td").find(":selected").val();
				
			}
				
			if(nuevovalor.trim()!="")
			{
				$.ajax({
					type: "POST",
					url: "views/popupbox/editinplace.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
				});
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
		
		
		
		$('#cancel').click( function(){

		
        	$('#block').hide();
        	$('#popupbox').hide();
		
		
		});
		
		
	});
	
	</script>
	
<?php } ?>	
	
	