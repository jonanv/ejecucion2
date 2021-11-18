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

function Reporte_Excel(){
	
	//alert("reporte");
	dato_1 = 4000;
	dato_2 = document.frm.idusuario.value;
	dato_3 = document.frm.fechair.value;
	dato_4 = document.frm.fechafr.value;
	dato_5 = document.frm.tipo.value;
	
	datos_reporte_3 = dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4+"//////////"+dato_5;

	//alert (datos_reporte_3);

	location.href="/ejecucion/index.php?controller=empleados&action=listadoExcel&datos_reporte_3="+datos_reporte_3;
	
}

