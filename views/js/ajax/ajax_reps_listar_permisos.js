$(function(){
		   
		   
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=empleados&action=GenerarDocumentoSaliente&opcion=1&id="+id;

		//window.open("views/PHPPdf/Reporte_DocumentoSaliente.php?id="+id);
			
		
	});	   
	
	
	// PARA RECORRER LA TABLA FILA POR FILA
	$("#aprobarpermisomasivo").click(function(evento){
										
		//alert(1);
		
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados = 0;
		
		var idspermiso="";
	
		$('#tpermisos tr').each(function () {

			var d0  = $(this).find("td").eq(0).html();
			
			//alert(d0);
			
			if(controlemcabezados == 0){
				controlemcabezados = controlemcabezados + 1;
			}
			else{
				
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = idspermiso+"******"+d0;

			}
			
			
	
		});
		//alert(idspermiso);
		//ENVIO LOS REGISTROS DE LA TABLA PARA SER REGISTRADOS EN LA BASE DE DATOS
		idaccion = "APROBARMASIVO"
		Aprobar_Permiso_Masivo(idspermiso,idaccion);
		
	});
	
	
	$("#noaprobarpermisomasivo").click(function(evento){
										
		//alert(1);
		
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados = 0;
		
		var idspermiso="";
	
		$('#tpermisos tr').each(function () {

			var d0  = $(this).find("td").eq(0).html();
			
			//alert(d0);
			
			if(controlemcabezados == 0){
				controlemcabezados = controlemcabezados + 1;
			}
			else{
				
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = idspermiso+"******"+d0;

			}
			
			
	
		});
		//alert(idspermiso);
		//ENVIO LOS REGISTROS DE LA TABLA PARA SER REGISTRADOS EN LA BASE DE DATOS
		idaccion = "NOAPROBARMASIVO"
		Aprobar_Permiso_Masivo(idspermiso,idaccion);
		
	});
	
	
	$("#enprocesopermisomasivo").click(function(evento){
										
		//alert(1);
		
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados = 0;
		
		var idspermiso="";
	
		$('#tpermisos tr').each(function () {

			var d0  = $(this).find("td").eq(0).html();
			
			//alert(d0);
			
			if(controlemcabezados == 0){
				controlemcabezados = controlemcabezados + 1;
			}
			else{
				
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = idspermiso+"******"+d0;

			}
			
			
	
		});
		//alert(idspermiso);
		//ENVIO LOS REGISTROS DE LA TABLA PARA SER REGISTRADOS EN LA BASE DE DATOS
		idaccion = "ENPROCESOMASIVO"
		Aprobar_Permiso_Masivo(idspermiso,idaccion);
		
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

function aprobarpermiso(idpermiso,idaccion){
	
	if(idaccion == "APROBAR"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idpermiso;
		dato_p3 = idaccion;
		
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermiso&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
		
	}
	if(idaccion == "NOAPROBAR"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idpermiso;
		dato_p3 = idaccion;
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermiso&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
	}
	if(idaccion == "ENPROCESO"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idpermiso;
		dato_p3 = idaccion;
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermiso&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
	}
	

}

function Aprobar_Permiso_Masivo(idspermiso,idaccion){
	
	if(idaccion == "APROBARMASIVO"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idspermiso;
		dato_p3 = idaccion;
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermisoMasivos&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
		
	}
	
	if(idaccion == "NOAPROBARMASIVO"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idspermiso;
		dato_p3 = idaccion;
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermisoMasivos&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
		
	}
	
	if(idaccion == "ENPROCESOMASIVO"){
		
		//alert(idpermiso+" "+idaccion);
		
		dato_p1 = 1;//ESTE DATO NO SE LE ESTA DANDO USO, SE DEJA POR SI ES NECESARIO SU USO
		dato_p2 = idspermiso;
		dato_p3 = idaccion;
		
		location.href="index.php?controller=empleados&action=ActualizarRegistroPermisoMasivos&dato_p1="+dato_p1+"&dato_p2="+dato_p2+"&dato_p3="+dato_p3;
		
	}
		
}

function Reporte_Excel(idreporte){
	
	//alert(idreporte);
	
	if(idreporte == 1){
		
		if (document.formp.usuario.value.length == 0 && document.formp.fechad.value.length == 0 && document.formp.fechah.value.length == 0 && document.formp.estado.value.length == 0){
		
			alert("Definir Algun Campo para Realizar el Filtro");
			document.getElementById('usuario').style.borderColor='#FF0000';
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
			document.getElementById('estado').style.borderColor='#FF0000';
		}
		else{
		
			dato_0 = 3000;
			dato_1 = document.formp.usuario.value;
			dato_2 = document.formp.fechad.value;
			dato_3 = document.formp.fechah.value;
			dato_4 = document.formp.estado.value;
			
		
			datos_reportepermiso = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
		
			//alert (datos_reporte_3);
		
			location.href="index.php?controller=empleados&action=ReporteExcel&datos_reportepermiso="+datos_reportepermiso;
		}
		
	}
	
	if(idreporte == 2){
		
		if (document.formp.fechad.value.length == 0 && document.formp.fechah.value.length == 0){
		
			alert("Definir Rango de Fechas para Generar el Consolidado");
			//document.getElementById('usuario').style.borderColor='#FF0000';
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
			//document.getElementById('estado').style.borderColor='#FF0000';
		}
		else{
		
			dato_0 = 4000;
			dato_1 = document.formp.usuario.value;
			dato_2 = document.formp.fechad.value;
			dato_3 = document.formp.fechah.value;
			dato_4 = document.formp.estado.value;
			
		
			datos_reportepermiso = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
			
			//alert (datos_reporte_3);
		
			location.href="index.php?controller=empleados&action=ReporteExcel&datos_reportepermiso="+datos_reportepermiso;
		}
		
	}
	
	if(idreporte == 3){
		
		//alert('EN DESARROLLO...');
		
		dato_0 = 5000;
		dato_1 = document.formp.usuario.value;
		dato_2 = document.formp.fechad.value;
		dato_3 = document.formp.fechah.value;
		
		datos_reportecompletosalidaentrada = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3;
		
		location.href="index.php?controller=empleados&action=ReporteExcel&datos_reportecompletosalidaentrada="+datos_reportecompletosalidaentrada;
		
		/*if (document.formp.fechad.value.length == 0 && document.formp.fechah.value.length == 0){
		
			alert("Definir Rango de Fechas para Generar el Consolidado");
			//document.getElementById('usuario').style.borderColor='#FF0000';
			document.getElementById('fechad').style.borderColor='#FF0000';
			document.getElementById('fechah').style.borderColor='#FF0000';
			//document.getElementById('estado').style.borderColor='#FF0000';
		}
		else{
		
			dato_0 = 5000;
			dato_1 = document.formp.usuario.value;
			dato_2 = document.formp.fechad.value;
			dato_3 = document.formp.fechah.value;
			
			datos_reportepermiso = dato_0+"//////////"+dato_1+"//////////"+dato_2+"//////////"+dato_3;
			
			
		
			location.href="/centro_servicios/index.php?controller=reps&action=ReporteExcel&datos_reportepermiso="+datos_reportepermiso;
		}*/
		
	}
	
}


