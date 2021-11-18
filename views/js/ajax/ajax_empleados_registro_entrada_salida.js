$(function(){
	
	
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=empleados&action=GenerarDocumentoSaliente&opcion=1&id="+id;

		//window.open("views/PHPPdf/Reporte_DocumentoSaliente.php?id="+id);
			
		
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

function validar_campos(){
	
		
		var bandera = 0;
		
		if (document.form1.fechar.value.length == 0){
       			alert("Definir Fecha");
				document.getElementById('fechar').style.borderColor='#FF0000';
       			return false;
		}
		
		bandera = 1;
            
		//if (confirm ("Esta seguro de Realizar el Registro")) {
		if (bandera == 1) {
		
        	return true;
    	} 
		else{return false;}
		
	
}

function validar_campos_permiso(){
	
	
		if (document.form2.fechas.value.length == 0){
       			alert("Definir Fecha Solicitud");
				document.getElementById('fechas').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.fechap.value.length == 0){
       			alert("Definir Fecha Permiso");
				document.getElementById('fechap').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.horai.value.length == 0){
       			alert("Definir Hora Inicial");
				document.getElementById('horai').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.horaf.value.length == 0){
       			alert("Definir Hora Final");
				document.getElementById('horaf').style.borderColor='#FF0000';
       			return false;
		}
		if (document.form2.detalle.value.length == 0){
       			alert("Definir Detalle");
				document.getElementById('detalle').style.borderColor='#FF0000';
       			return false;
		}
		
            
		if (confirm ("Esta seguro de Realizar el Registro")) {
		
        	return true;
			
			
    	} 
		else{return false;}
		
	
}

//TAMBIEN FUNCIONA
/*function Filtrar_Tabla(){
	
	if (document.form1.fechad.value.length == 0 || document.form1.fechah.value.length == 0){
    	alert("Definir Ambas Fechas para Realizar el Filtro");
		document.getElementById('fechad').style.borderColor='#FF0000';
		document.getElementById('fechah').style.borderColor='#FF0000';
       	
	}
	else{
		
		dato_0 = 1;
		dato_1 = document.form1.fechad.value;
		dato_2 = document.form1.fechah.value;
	
		//datos_filtro = dato_0+"//////////"+dato_1+"//////////"+dato_2;

		//location.href="/centro_servicios/index.php?controller=reps&action=FiltroTabla&datos_filtro="+datos_filtro;
		
		//location.href="/centro_servicios/index.php?controller=reps&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
		
		location.href="index.php?controller=reps&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
	
	}

}*/

function Reporte_Excel(idreporte){
	
	//alert("reporte");
	
	if(idreporte == 1){
		
		dato_1 = 1000;
		dato_2 = document.frm.fechad.value;
		dato_3 = document.frm.fechah.value;
		
		datos_reporte = dato_1+"//////////"+dato_2+"//////////"+dato_3;
	
		//alert (datos_reporte_3);
	
		location.href="/laborales/index.php?controller=empleados&action=ReporteExcel&datos_reporte="+datos_reporte;
	}
	
	if(idreporte == 2){
		
	
		dato_1 = 2000;
		dato_2 = document.frm.fechad2.value;
		dato_3 = document.frm.fechah2.value;
		
		datos_reporte = dato_1+"//////////"+dato_2+"//////////"+dato_3;
	
		//alert (datos_reporte_3);
	
		location.href="index.php?controller=empleados&action=ReporteExcel&datos_reporte="+datos_reporte;
	}
	
}

