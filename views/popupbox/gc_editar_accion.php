<?php 
session_start(); 

if($_SESSION['id']!=""){

$valor_id = trim($_POST['idaccion']);


/*echo '<script languaje="JavaScript">
            
      	var valor_id ="'.$valor_id.'";
            
	</script>';*/

?>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	
	<style>
	.contenedor{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	th {padding:5px; background-color:#CDE3F9;color:#000000}
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
		<h1 style="color:#FF0000; font-size:16px">EDITAR ACCION:<?php echo $valor_id; ?></h1>
		<div class="mensaje"></div>
		<!-- <img src="images/loading.gif"> -->
		<table class="editinplace">
			<tr>
				<th style="color:#FF0000; font-size:10px">ID</th>
				<th style="color:#FF0000; font-size:10px">Numero Accion</th>
				<th style="font-size:10px">CLASE</th>
				<th style="font-size:10px">NUMERAL NORMA</th>
				<th style="font-size:10px">DES HALLAZGO</th>
				<th style="font-size:10px">PROCESO RESPONSABLE</th>
				<th style="font-size:10px">PROCESO AFECTADO O IMPACTADO</th>
				<th style="font-size:10px">ANALISIS DE CAUSAS</th>
				<th style="font-size:10px">METODOLOGIA</th>
				<th style="font-size:10px">GENERADA POR</th>
				<th style="font-size:10px">ESTADO</th>
			</tr>
		</table>
	</div>
	
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->
	
	<script>
	$(document).ready(function() 
	{
	
		//PASAMOS VARIABLES PHP A JAVASCRIPT
		var valor_id = "<?php echo $valor_id; ?>";
		
		var registro;

		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "views/popupbox/gc_editinplace.php?tabla=1",
			data: { valor_id: valor_id }
		})
		.done(function(json) {
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++)
			{
			
				
				registro+="<tr>"
					
					registro+="<td class='id'>"+json[i].id+"</td>"
					registro+="<td class='editable' data-campo='numero_accion' data-tipocampo=1><span>"+json[i].numero_accion+"</span></td>"
					registro+="<td class='editable' data-campo='id_clase' data-tipocampo=4 data-idlista=1><span>"+json[i].clase+"</span></td>"
					registro+="<td class='editable' data-campo='id_numeral_norma' data-tipocampo=4 data-idlista=2><span>"+json[i].numeral+"</span></td>"
					registro+="<td class='editable' data-campo='descripcion' data-tipocampo=3><span>"+json[i].descripcion+"</span></td>"
					registro+="<td class='editable' data-campo='id_pr' data-tipocampo=4 data-idlista=3><span>"+json[i].procesoresponsable+"</span></td>"
					registro+="<td class='editable' data-campo='id_ai' data-tipocampo=5 data-idlista=6><span>"+json[i].id_ai+"</span></td>"
					registro+="<td class='editable' data-campo='analisis_causas' data-tipocampo=3><span>"+json[i].analisis_causas+"</span></td>"
					registro+="<td class='editable' data-campo='id_metodologia' data-tipocampo=4 data-idlista=4><span>"+json[i].metodologia+"</span></td>"
					registro+="<td class='editable' data-campo='id_generada' data-tipocampo=4 data-idlista=5><span>"+json[i].generada+"</span></td>"
					
					
					if(json[i].estado == 0){var d12M = "EN PROCESO";}else{var d12M = "TERMINADA";}
					
					registro+="<td class='editable' data-campo='estado' data-tipocampo=4 data-idlista=6><span>"+d12M+"</span></td>"
					
				registro+="</tr>"
				
				
				$('.editinplace').append(registro);
			}
		});
		/*------------------- */
		
		/* FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
		var td,campo,valor,id;
		var tipocampo   = 0;
		var idlista     = 0;
		

		$(document).on("click","td.editable span",function(e)
		{
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td        = $(this).closest("td");
			campo     = $(this).closest("td").data("campo");
			tipocampo = $(this).closest("td").data("tipocampo");
			idlista   = $(this).closest("td").data("idlista");
			valor     = $(this).text();
			id        = $(this).closest("tr").find(".id").text();
			
			//alert(tipocampo);
			//alert(campo);
			//alert(valor);
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
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				var lista = "";
				
				//CLASE	
				if(idlista == 1){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Clase</option>";
						
						
					$("#listasr1 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				//NUMERAL NORMA
				if(idlista == 2){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Numeral Norma</option>";
						
						
					$("#listasr2 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				
				
				//Proceso Responsable
				if(idlista == 3){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Proceso Responsable</option>";
						
						
					$("#listasr3 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				//Metodologia
				if(idlista == 4){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Metodologia</option>";
						
						
					$("#listasr5 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				
				//Generada Por
				if(idlista == 5){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Generada Por</option>";
						
						
					$("#listasr6 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				
				//ESTADO
				if(idlista == 6){
						
					td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				}
				
				
				
				
			}
			
			
			
			
			//CAMPO DE SELECT MULTIPLE
			//Proceso Afectado o Impactado
			if(tipocampo == 5){
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				var lista = "";
				
				//Proceso Afectado o Impactado
				if(idlista == 6){
						
					lista+="<select name='"+campo+"' id='"+campo+"' multiple= 'multiple'>";
					//lista+="<select name='listasr4[]' id='listasr4[]' multiple= 'multiple'>";
					//lista+="<option value='' selected='selected'>Seleccionar Proceso Afectado o Impactado</option>";
						
						
					$("#listasr4 option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
							
							//lista+="<option value="+$(this).val()+'-'+$(this).text()+">"+$(this).val()+'-'+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}
				
				
				
				
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
			
			
			//CAMPO DE SELECT MULTIPLE
			if(tipocampo == 5){
			
				//nuevovalor=$(this).closest("td").find(":selected").val();
				
				nuevovalor = "";
				
				obj = document.getElementById(campo);
				for (i=0; opt=obj.options[i];i++){ 
				
					if (opt.selected) {
						nuevovalor = opt.value+" "+opt.text+"-"+nuevovalor;
					}
					
				}
				
			 	/*$("#listasr4 option").each(function(){
				
					
					if ($(this).val() != "" ){   
					
				 		nuevovalor += $(this).val()+' - '+$(this).text()+'\n';
					}
					
			 	});*/
				
				
				/*var opciones = document.getElementById("listasr4").options;
				for (var i=1; i<opciones.length; i++){        
					var opcion_valor = opciones[i].value;        
					var opcion_texto = opciones[i].text;        
					//alert(opcion_valor+' '+opcion_texto);
					if(opciones[i].selected){            
						
						nuevovalor += opcion_valor+' - '+opcion_texto+'\n';
					
					}
				}*/ 
				
				
			}
				
			if(nuevovalor.trim()!="")
			{
				
				/*alert(tipocampo);
				alert(campo);
				alert(valor);
				alert(nuevovalor);
				alert(id);*/
				
				$.ajax({
					type: "POST",
					url: "views/popupbox/gc_editinplace.php",
					data: { campo: campo, valor: nuevovalor, id:id }
				})
				.done(function( msg ) {
					$(".mensaje").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
					
					$('#cancel').click();
					$(".btn_limpiar_ra").click();
					
				});
			}
			else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
		});
		
		
		
		$('#cancel').click( function(){

		
        	$('#block').hide();
        	$('#popupbox').hide();
			
			$(".btn_limpiar_ra").click();
		
		
		});
		
		
	});
	
	</script>
	
<?php } ?>	
	
	