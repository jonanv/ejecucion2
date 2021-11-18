$(function(){
	

	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});
	
	//ME PERMITE VALIDAR QUE SE A ESCOGIDO ALGUN ARANCEL DE LA TABLA PARA SU LIQUIDACION
	$(".btn_validar").click(function() {
		
		//alert(1);
		ta = $("#totalaranceles").val();
				
		if(ta == 0 || ta == "NaN"){
			alert("No es Posible Realizar el Registro, El Total de los Aranceles no Puede ser Cero (0)");
			//$("#radicado").val('');
			return false;
		}
			
	});		
		
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		
		validator.resetForm();
		
	});	
	
	//PARA LAS FECHAS
	//$("#fechal").datepicker({ changeFirstDay: false	});
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	
	//CUANDO SE DIGITA UN RADICADO
	$("#radicado").change(function(event){
		
		
		var idradicado = $("#radicado").val();
		
		//alert(idradicado);
		
		
		$.get("funciones/traer_datos_radicado.php?idradicado="+idradicado, function(datosradicado){
				
					//alert(datosradicado);
					
					datosid = datosradicado.split("//////");
					$("#idradicado").val(datosid[0]);
					$("#cedula_demandante").val(datosid[1]);
					$("#demandante").val(datosid[2]);
					$("#cedula_demandado").val(datosid[3]);
					$("#demandado").val(datosid[4]);
					//$("#claseproceso").val(datosid[5]);
					$("#userjuzgado").val(datosid[6]);
					$("#juzgadoorigen").val(datosid[8]);
					//$("#jd").val(datosid[7]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					/*var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);*/
			
		});
	 
	});
	
	//CUANDO SE DIGITA UN RADICADO
	$("#radicado3").change(function(event){
		
		
		/*var idradicado3 = $("#radicado3").val();
		
		//alert(idradicado);
		
		
		$.get("funciones/traer_datos_radicado.php?idradicado="+idradicado3, function(datosradicado){
				
					//alert(datosradicado);
					
					datosid = datosradicado.split("//////");
					//$("#idradicado").val(datosid[0]);
					$("#cedula_demandante").val(datosid[1]);
					$("#demandante").val(datosid[2]);
					$("#cedula_demandado").val(datosid[3]);
					$("#demandado").val(datosid[4]);
					//$("#claseproceso").val(datosid[5]);
					//$("#userjuzgado").val(datosid[6]);
					//$("#juzgadoorigen").val(datosid[8]);
					//$("#jd").val(datosid[7]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					/*var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);*/
			
		//});
	 
	});
	
	
	/*$("#chkk2").click(function(evento){
		alert(1);
	});*/
	
	$(".calcular").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id      = $(this).attr('data-id');
		var valor   = $(this).attr('data-valor');
		
		//SE OBTIENE EL NOMBRE DEL CAMPO PAGINA Y MAS ABAJO EL VALOR ESCRITO EN ESE CAMPO
		var paginas = $(this).attr('data-paginas');
		//SE DEJA EL CAMPO PAGINAS READONLY EN CIERTOS INTERVALOS PARA SU VALIDACION AL REGISTRAR LA LIQUIDACION
		$("#"+paginas).attr('readonly', true);
		
		var subt    = $(this).attr('data-subtotal');
		var chk     = $(this).attr('data-chk');
		
		var subtotal = 0;
		var subtotaldesglose = 0;
		//var total    = 0;
		
		
		//alert(id+"---------"+valor+"---------"+paginas+"---------"+chk);
		
		if($("#"+chk).is(':checked')) {
			
			if($("#"+paginas).val() != ''){
				
				if(id != 8){//SE PREGUNTA QUE NO SE DIO CLIC EN EL ITEM DESGLOSE
					
					paginas  = $("#"+paginas).val()
					subtotal = parseInt(valor) * parseInt(paginas);
				
					$("#"+subt).val(subtotal);
					
					//-----SE CALCULA EL SUBTOTAL DEL DESGLOSE-----
					subtotaldesglose = calcular_desglose();
					$("#subtotal9").val(subtotaldesglose);
					//---------------------------------------------
				
				}
				else{//SI SE SELECCIONA EL ITEM DESGLOSE, SE SUMAN LAS (CERTIFICACIONES + COPIAS SIMPLES + AUTENTICACIONES)
					
					subtotaldesglose = calcular_desglose();
					$("#"+subt).val(subtotaldesglose);
				}
				
				
				//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
				var controlemcabezados = 0;
				
				//SUMAR SUBTOTALES
				var f = 2;
		
				var c4 = 0;
				var total    = 0;
			
				$('#frm_editar1 tr').each(function () {
		
					//var d0  = $(this).find("td").eq(0).html();
					c4 = $("#subtotal"+f).val();
					
					//alert(c4);
					
					if(controlemcabezados == 0  || controlemcabezados == 1){
						controlemcabezados = controlemcabezados + 1;
					}
					else{
						
						controlemcabezados = controlemcabezados + 1;
						
						//CONTROLA PARA QUE NO TOME LA ULTIMA FILA DE LA TABLA DONDE ESTA EL TOTAL
						//Y NO ME DE UN RESULTADO NAN ---> NULL
						if(controlemcabezados != 15){
							
							//if($("#chk"+f).is(':checked')) {  
							
								//CALCULAMOS TODOS LOS REGISTROS DE LA COLUMNA SUBTOTAL DE LA TABLA
								//alert(total+"-----"+c4);
								total    = parseInt(total) + parseInt(c4);
								//alert(total);
							//}
							
							f = f + 1;
						
						}
						
						
					}
			
			
				});
				
				//alert(total);
				$("#totalaranceles").val(total);
				
	
			}
			else{
				alert("Definir Paginas");
				document.getElementById(paginas).style.borderColor='#FF0000';
					
				$("#"+chk).attr('checked', false);
				$("#"+paginas).attr('readonly', false);
			}
					  
		}
		else{
			
			$("#"+paginas).attr('readonly', false);
			$("#"+paginas).val('');
			$("#"+subt).val('0');
			document.getElementById(paginas).style.borderColor='#000000';
			
			//SE DETERMINA QUE VALORES SON ESTATICOS EN LOS ITEM DE LOS ARANCELES
			//EN ESTE CASO LAS PAGINAS DE EL ITEM DESGLOSES
			Valores_Estaticos();
			

			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			var controlemcabezados = 0;
				
			//SUMAR SUBTOTALES
			var f = 2;
		
			var c4    = 0;
			var total = 0;
			
			
			//-----SE CALCULA EL SUBTOTAL DEL DESGLOSE-----
			subtotaldesglose = calcular_desglose();
			$("#subtotal9").val(subtotaldesglose);
			//---------------------------------------------

			$('#frm_editar1 tr').each(function () {
		
				//var d0  = $(this).find("td").eq(0).html();
				c4 = $("#subtotal"+f).val();
					
				//alert(c4);
					
				if(controlemcabezados == 0  || controlemcabezados == 1){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
						
					controlemcabezados = controlemcabezados + 1;
						
					if(controlemcabezados != 15){
					//if($("#chk"+f).is(':checked')) {  
						
						//CALCULAMOS TODOS LOS REGISTROS DE LA COLUMNA SUBTOTAL DE LA TABLA
						//alert(total+"-----"+c4);
						total    = parseInt(total) + parseInt(c4);
						//alert(total);
					//}
						
					f = f + 1;
						
					}
						
						
				}
			
			
			});
			
			
			
			//alert(total);
			$("#totalaranceles").val(total);
	
		}
		
		
	});
	
	
	
	//FILTRAR TABLA IMPRIMIR LIQUIDACIONES
	$('.filtrare3').click(function(evento){
	
		//alert(1);
		
		
		if (
			document.getElementById('radicado3').value.length    == 0 &&
			document.getElementById('fechai').value.length       == 0 &&
			document.getElementById('fechaf').value.length       == 0 &&
			document.getElementById('listausuario').value.length == 0
			){
			
	
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=aranceljudicial&action=RecargarTablaImprimirLiquidaciones&dato_0="+dato_0;
       	
		}
		else{
			
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('radicado3').value;
			datox2 = document.getElementById('listausuario').value;
			
			location.href="index.php?controller=aranceljudicial&action=FiltroTablaImprimirLiquidaciones&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2;
			//location.href="index.php?controller=aranceljudicial&action=FiltroTablaImprimirLiquidaciones&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1;
	
		}
	
    });
	
	// PARA IMPRIMIR UN BLOQUE DE REGISTROS RELACIONADOS CON UN NOMBRE DE BLOQUE
	$(".imprimirliquidacion").click(function(evento){
		
		//alert(1);
		var idl  = $(this).attr('data-id');
		var numl = $(this).attr('data-numl');
		
		//alert("Imprimiendo... "+idl+"------"+numl);
		
		
		var datos = idl+"******"+numl; 
			
		//window.open("/views/PHPPdf/Reporte_Liquidacion_Arancel?datos="+datos);
		
		window.open("views/PHPPdf/Reporte_Liquidacion_Arancel.php?datos="+datos);
		

	});
	
	// PARA APROBAR UNA LIQUIDACION
	$(".aprobarliquidacion").click(function(evento){
		
		var idl  = $(this).attr('data-id');
		//var numl = $(this).attr('data-numl');
		
		//alert("Aprobando... "+idl+"------"+numl);
	
		//var datos = idl+"******"+numl; 
		
		location.href="index.php?controller=aranceljudicial&action=AprobarLiquidacion&idl="+idl;
			
		

	});
	
	// PARA ANULAR UNA LIQUIDACION
	$(".anularliquidacion").click(function(evento){
		
		var idl  = $(this).attr('data-id');
		
		if (confirm ("Esta Seguro de ANULAR LA LIQUIDACION")) {
		
        	location.href="index.php?controller=aranceljudicial&action=AnularLiquidacion&idl="+idl;
    	} 
		else{return false;}					
		
		
			
		

	});
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.estadistica').click(function(evento){
	
		//alert(1);
		
		//window.open("views/PHPPdf/Reporte_Total_Liquidacion_Arancel.php");
		
		if (document.getElementById('fechai').value.length       == 0 &&
			document.getElementById('fechaf').value.length       == 0 &&
			document.getElementById('listausuario').value.length == 0 &&
			document.getElementById('radicado3').value.length    == 0){
			
			tfiltro = 1;//sin filtro
			
			window.open("views/PHPPdf/Reporte_Total_Liquidacion_Arancel.php?tfiltro="+tfiltro);
       	
		}
		else{
		
			tfiltro = 2;//con filtro
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('radicado3').value;
			datox2 = document.getElementById('listausuario').value;
		
			window.open("views/PHPPdf/Reporte_Total_Liquidacion_Arancel.php?tfiltro="+tfiltro+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2);
			
		}
		
		/*if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('direccion').value.length          == 0 &&
			document.getElementById('ciudad').value.length    == 0 &&
			document.getElementById('asunto').value.length         == 0){
			
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion="+dato_0+"&tfiltro="+tfiltro;
       	
		}
		else{
		
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 2;//con filtro
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			datox1 = document.getElementById('tipodocumentos').value;
			datox2 = document.getElementById('ndocumento').value;
			datox3 = document.getElementById('dirigidoa').value;
			datox4 = document.getElementById('nombre').value;
			datox5 = document.getElementById('direccion').value;
			datox6 = document.getElementById('ciudad').value;
			datox7 = document.getElementById('asunto').value;
			datox8 = document.getElementById('idds').value;
			
			//location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion=2";
			
			location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&tfiltro="+tfiltro;
	
		}*/
	
    });
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".reportearancel").click(function(){
	

		if (document.getElementById('fechai').value.length	== 0 || document.getElementById('fechaf').value.length  == 0){
		
			alert("Definir Rango de Fechas");
			document.getElementById("fechai").style.borderColor='#FF0000';
			document.getElementById("fechaf").style.borderColor='#FF0000';
			
		}
		else{
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			
			location.href="index.php?controller=aranceljudicial&action=GenerarReporteArancel&opcion=1&dato_1="+dato_1+"&dato_2="+dato_2;
			
			
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


function calcular_desglose(){
	
	var subtotalD = 0;
	
	if($("#chkk9").is(':checked')) {
		
		if( $("#subtotal2").val() == 0 && $("#subtotal7").val() == 0 && $("#subtotal8").val() == 0 ){
			
			alert("Para realizar el Calculo del Desglose debe estar Definido Por lo menos uno de los Items Siguientes (Certificaciones, Copias Simples y Autenticacion de las Copias)");
			document.getElementById("pagina2").style.borderColor='#FF0000';
			document.getElementById("pagina7").style.borderColor='#FF0000';
			document.getElementById("pagina8").style.borderColor='#FF0000';
			
			$("#chkk9").attr('checked', false);
			
			$("#pagina9").val(1);
		}
		else{
		
			subtotalD = parseInt( $("#subtotal2").val() ) +  parseInt( $("#subtotal7").val() ) +  parseInt( $("#subtotal8").val() );	
		}
	}
	else{
		subtotalD = 0;
	}
	
	
	return(subtotalD);
}

function Valores_Estaticos(){
	
	$("#pagina9").attr('readonly', true);
	$("#pagina9").val(1);
}

function Solo_Numeros(e){
	
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}

/*7.3.1. Validar un campo de texto obligatorio
Se trata de forzar al usuario a introducir un valor en un cuadro de texto o textarea en los que sea obligatorio. La condición en JavaScript se puede indicar como:

valor = document.getElementById("campo").value;
if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  return false;
}
Para que se de por completado un campo de texto obligatorio, se comprueba que el valor introducido sea válido, que el número de caracteres introducido sea mayor que cero y que no se hayan introducido sólo espacios en blanco.

La palabra reservada null es un valor especial que se utiliza para indicar "ningún valor". Si el valor de una variable es null, la variable no contiene ningún valor de tipo objeto, array, numérico, cadena de texto o booleano.

La segunda parte de la condición obliga a que el texto introducido tenga una longitud superior a cero caracteres, esto es, que no sea un texto vacío.

Por último, la tercera parte de la condición (/^\s+$/.test(valor)) obliga a que el valor introducido por el usuario no sólo esté formado por espacios en blanco. Esta comprobación se basa en el uso de "expresiones regulares", un recurso habitual en cualquier lenguaje de programación pero que por su gran complejidad no se van a estudiar. Por lo tanto, sólo es necesario copiar literalmente esta condición, poniendo especial cuidado en no modificar ningún carácter de la expresión.*/


