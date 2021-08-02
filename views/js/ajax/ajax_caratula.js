var datosacciones;
var arrayRapido;

$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frmcaratula").validate({
		meta: "validate"
	});
	

	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});		
	
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	$('.filtrarproceso').click(function(evento){
	
		//alert(1);
		
		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('radicadox').value.length      == 0){
			
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=caratula&action=RecargarTablaProcesos&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			datox1 = document.getElementById('radicadox').value;
			
			location.href="index.php?controller=caratula&action=FiltroTablaProcesos&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
	
    });
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarcaratula").click(function(){
	

		var idradicadocaratula = $(this).attr('data-id');
		
		//alert(idradicadocaratula);
	
		location.href="index.php?controller=caratula&action=Generar_Caratula&opcion=1&idradicadocaratula="+idradicadocaratula+"&idcaratula="+400;

		
	});
	$(".generarcaratula_2").click(function(){
	
		//alert(1);
		
		datox1 = document.getElementById('radicadox').value;
		
		if( datox1 == null || datox1.length == 0 || /^\s+$/.test(datox1) ) {
  		
			alert("Defina Radicado");
			document.getElementById('radicadox').style.borderColor = '#FF0000';
			
		}
		else{
			//alert(idradicadocaratula);
			
			var idradicadocaratula = document.getElementById('radicadox').value;
			
			location.href="index.php?controller=caratula&action=Generar_Caratula&opcion=1&idradicadocaratula="+idradicadocaratula+"&idcaratula="+400;
			
		}

		
	});
	
	


});

function AJAXCrearObjeto(){
	
		var obj=false;
		
		try {
			obj = new ActiveXObject("Msxml2.XMLHTTP");
		} 
		catch (e) {
			try {
		   		obj = new ActiveXObject("Microsoft.XMLHTTP");
			} 
			catch (E) {
				obj = false;
  			}
		}

		if (!obj && typeof XMLHttpRequest!='undefined') {
			obj = new XMLHttpRequest();
		}
		return obj;
}




