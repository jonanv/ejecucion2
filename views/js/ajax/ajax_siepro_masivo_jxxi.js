
$(function(){
	
	
	//PARA LAS FECHAS
	//$("#fechae_2").datepicker({ changeFirstDay: false	});
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm_masivo1").validate({
		meta: "validate"
	});
	
	//PARA VISUALIZAR FILA CON EL ICONO DE CARGAR Y OCULTAR LOS BOTONES DE REGISTRAR Y RESTABLECER
	$(".visualizar").click(function() {
		
		
		var validar = 0;
		
		var valor_1  = document.getElementById('fechae').value;
		var valor_2  = document.getElementById('archivo').value;
		
		if( valor_1 == null || valor_1.length == 0 || /^\s+$/.test(valor_1) ) {
				
			/*alert("Defina Fecha");
			document.getElementById('fechae').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if( valor_2 == null || valor_2.length == 0 || /^\s+$/.test(valor_2) ) {
				
			/*alert("Defina Archivo");
			document.getElementById('archivo').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if(validar == 1){
			
			$("#filabotones_masivo").show();
			$('#imgloading_masivo').hide();
		}
		else{
			
			$("#filabotones_masivo").hide();
			$('#imgloading_masivo').show();
			
		}
		
	});		
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		//validator.resetForm();
		//Eliminar_Datos_JusticiaXXI();
		
		location.href="index.php?controller=archivo&action=Registrar_A_Despacho_Masivo";
		
	});		
	
	
	
	var validator = $("#frm_masivo2").validate({
		meta: "validate"
	});
	
	//PARA VISUALIZAR FILA CON EL ICONO DE CARGAR Y OCULTAR LOS BOTONES DE REGISTRAR Y RESTABLECER
	$(".visualizar2").click(function() {
		
		
		var validar = 0;
		
		var valor_1  = document.getElementById('fechae_2').value;
		var valor_2  = document.getElementById('archivo').value;
		
		if( valor_1 == null || valor_1.length == 0 || /^\s+$/.test(valor_1) ) {
				
			/*alert("Defina Fecha");
			document.getElementById('fechae').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if( valor_2 == null || valor_2.length == 0 || /^\s+$/.test(valor_2) ) {
				
			/*alert("Defina Archivo");
			document.getElementById('archivo').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if(validar == 1){
			
			$("#filabotones_masivo").show();
			$('#imgloading_masivo').hide();
		}
		else{
			
			$("#filabotones_masivo").hide();
			$('#imgloading_masivo').show();
			
		}
		
	});		
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar2").click(function() {
		//validator.resetForm();
		//Eliminar_Datos_JusticiaXXI();
		
		location.href="index.php?controller=archivo&action=Registrar_Estado_Masivo";
		
	});	
	
	
	
	var validator = $("#frm_masivo3").validate({
		meta: "validate"
	});
	
	//PARA VISUALIZAR FILA CON EL ICONO DE CARGAR Y OCULTAR LOS BOTONES DE REGISTRAR Y RESTABLECER
	$(".visualizar3").click(function() {
		
		
		var validar = 0;
		
		var valor_1  = document.getElementById('fechae_3').value;
		var valor_2  = document.getElementById('archivo').value;
		
		if( valor_1 == null || valor_1.length == 0 || /^\s+$/.test(valor_1) ) {
				
			/*alert("Defina Fecha");
			document.getElementById('fechae').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if( valor_2 == null || valor_2.length == 0 || /^\s+$/.test(valor_2) ) {
				
			/*alert("Defina Archivo");
			document.getElementById('archivo').style.borderColor = '#FF0000';
			return false;*/
			
			validar = 1;
		}
		
		if(validar == 1){
			
			$("#filabotones_masivo").show();
			$('#imgloading_masivo').hide();
		}
		else{
			
			$("#filabotones_masivo").hide();
			$('#imgloading_masivo').show();
			
		}
		
	});		
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar3").click(function() {
		//validator.resetForm();
		//Eliminar_Datos_JusticiaXXI();
		
		location.href="index.php?controller=archivo&action=Registrar_ParaArchivo_Masivo";
		
	});	
	
	//************CIERRO PARA QUE SE EJECUTE AUTOMATICAMENTE*****************
	//$("#fechae_2").change(function(event){
	$("#fechae_2").click(function(event){
								   
		
		//alert("CALCULANDO...");
	
			var fechat = document.frm_masivo2.fechae_2A.value;
			
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			
			
			//FECHA INICIAL
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+fechat, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				$("#fechae_2").val(fii);
				
	
			});


	});
	//*****************************************************************************************************
	
	//DESCARTAR DE LA LISTA
	$('#descartarlista').click( function(){
								  
		//alert("DESCARTANDO DE LISTA....");
		
		if( 
		   
		   $('#radidl').val() == null || $('#radidl').val().length == 0 || /^\s+$/.test($('#radidl').val())
		   
		) {
			
			alert("Definir Radicado a Descartar de la Lista");
			
			document.getElementById('radidl').style.borderColor = '#FF0000';
			
		}
		else{
			
			var valorradicado = $("#radidl").val();
			
			//alert(valorradicado);
			
			params={};
			params.valorradicado = valorradicado;
			
	
			 //alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/siepro_descartar_lista_DM.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		
		}
		
	 });
	
	$('#cancel').click( function(){
								  
        $('#block').hide();
        $('#popupbox').hide();
		
	});
			
	$(".eliminarobser").click(function(){
								
		var idobser       = $(this).attr('data-idobser');
		
		var idradicado     = $("#id_radidl").val();
		var valorradicado = $("#radidl").val();
		
		//alert(idobser);
		
		if (confirm ("Esta Seguro de Realizar el Proceso, Se Eliminara Observacion con ID: "+idobser)) {
			
			location.href="index.php?controller=archivo&action=Radicador_Descatar_Lista&idobser="+idobser+"&valorradicado="+valorradicado+"&idradicado="+idradicado;
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




