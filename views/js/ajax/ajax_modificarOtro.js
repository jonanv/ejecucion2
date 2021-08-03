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

//FUNCION QUE ME PERMITE BUSCAR UN ITEM
//DE UNA LISTA DE SELECCION DE HTML
function Buscar_Item_Combo(texto_busqueda,texto_busqueda_2,idUsuario){
	
	//alert(texto_busqueda+"******"+texto_busqueda_2);
	
	//alert(idUsuario);
	
	//SE REALIZA ESTA COMPARACION PARA DETERMINAR QUE USUARIOS PUEDEN SE LES APLICA ESTA FUNCION
	//PARA PODER VER TRAMITES INTERNOS, POR QUE SI NO SE VALIDA Y ES UN USUARIO SIN ESTE PERMISO
	//LAVISTA archivo_modificarOtro.php PRESENTA INCONSISTENCIA YA QUE EN ESTA TAMBIEN SE VALIDAN LOS MISMOS
	//USUARIOS <?php if(($_SESSION['idUsuario']==8 || $_SESSION['idUsuario']==19 || $_SESSION['idUsuario']==38 || $_SESSION['idUsuario']==51)) { ?>
	if( (idUsuario == 8 || idUsuario == 19 || idUsuario == 38 || idUsuario == 51) ) {
	
		var input  = texto_busqueda;
		var output = document.getElementById('actuacion').options;
	
		for(var i=0; i<output.length; i++) {
			
			if(output[i].value == input){
				output[i].selected = true;
			}
		}
		
		//------------------------------------------------------------------------
		
		var input_2  = texto_busqueda_2;
		var output_2 = document.getElementById('asignadoa').options;
		
		for(var i=0; i<output_2.length; i++) {
				
			if(output_2[i].value == input_2){
				output_2[i].selected = true;
			}
		}
		
	}
	
	//------------------------------------------------------------------------
		
}

function DiasHabiles(){
	
	
		if ( document.frm.diasti.value.length == 0 || document.frm.fecha_actusti.value.length == 0){
			
			alert("Definir Dias");
			document.getElementById('fecha_actusfti').value = "0000-00-00";
		}
		else{
			
			//alert(1);
			
			var fechainicial = document.frm.fecha_actusti.value;
			var dias         = document.frm.diasti.value;
			
			var datos = fechainicial+"//////////"+dias;
			
			//alert(datos);
			
			
			ajax=AJAXCrearObjeto();
			ajax.open("POST", "views/funciones/diashabiles.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("datos="+datos);
			
			ajax.onreadystatechange=function() {
				
				if (ajax.readyState==4) {
					
					//OBTENGO LOS DATOS
					var fechafinal = ajax.responseText;
					
					//alert(fechafinal);
					
					if(fechafinal != ""){
						
						var vector_fecha = fechafinal.split("/");
						var ff           = vector_fecha[2]+"-"+vector_fecha[1]+"-"+vector_fecha[0]
						
						document.getElementById('fecha_actusfti').value = ff;
						
						
					}
					else{
						document.getElementById('fecha_actusfti').value = "0000-00-00";
					}
				}
				
			}
			
		}
		
}
function Reporte_Excel(){
	
	alert("reporte");
	/*dato_1 = 2000;
	dato_2 = document.getElementById('filtro_buscar').value;
	dato_3 = document.getElementById('fechad').value;
	dato_4 = document.getElementById('fechah').value;
	
	datos_reporte = dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;

	//alert (datos_reporte);

	location.href="/laborales/index.php?controller=archivo&action=listadoExcel&datos_reporte="+datos_reporte;*/
	
}

function Vence_Termino(fechatermino){
	

	var f = new Date();
	
	var f2 = f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate();
	
	var f3;
	
	var vector_fecha = f2.split("-");
	
	if(parseInt(vector_fecha[1]) >= 1 && parseInt(vector_fecha[1]) <= 9){
		f3 = f.getFullYear() + "-" + "0" + ""+vector_fecha[1] + "-" + f.getDate();
	}
	
	//alert(f3);
	//alert(fechatermino+"****"+f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate());
	
	if(fechatermino == f3){
		
		alert("VENCE TERMINO, FECHA: "+fechatermino);
	}
	
	
	
}

//SE REALIZA MEJOR EN LA VISTA archivo_modificarOtro.php
//PERO PARA LLAMAR ESTA FUNCION DESDE LA VISTA
// SE USA ASI
//
/*	var dat_4 = "'.$consultausuario.'";
				
	var dat_5 = "'.$usuarioconsulta.'";
				
	En_Consulta_Usuario(dat_4,dat_5);*/
				
function En_Consulta_Usuario(consultausuario,usuarioconsulta,$fecha_consulta){
	
	//alert(consultausuario);
	
	if(consultausuario == 1){
		
		alert("PROCESO SE ENCUENTRA EN PRESTAMO A USUARIO DE VENTANILLA, ACCION REALIZADA POR SERVIDOR JUDICIAL: "+usuarioconsulta+", FECHA: "+$fecha_consulta);
	}
	
	
}

