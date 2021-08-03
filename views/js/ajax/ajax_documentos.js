$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	var validator = $("#frm").validate({
		meta: "validate"
	});
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		//validator.resetForm();
		
		location.href="index.php?controller=documentos&action=Listar_Documentos_Salientes";
	});		
	
	//PARA OCULTAR tablaconsulta
	//$('#tablaconsulta').hide();
	
	//OCULTO ESTA FILA YA QUE EL PROGRAMA ARMARA AUTOMATICAMENTE EL CONTENIDO DEL DOCUMENTO
	$('#filacontenido').hide();
	//OCULTO ESTAS FILAS YA QUE NO SON NECESARIAS QUE SEAN VISIBLES POR EL USUARIO
	//$('#filacargo').hide();
	//$('#filadependencia').hide();
	//$('#filand').hide();
	
	//PARA LAS FECHAS
	$("#fechag").datepicker({ changeFirstDay: false	});
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	$("#fecharematei").datepicker({ changeFirstDay: false	});
	$("#fecharematef").datepicker({ changeFirstDay: false	});
	
	
	
	//CARGAR LISTAS SEGUN UN DATO ESPECIFICADO EN OTRA LISTA
	$("#documento").change(function(event){
            
			var id    = $("#documento").find(':selected').val();
			
			$("#tipodocumento").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+1);
			
			$("#ndocumento").val('');
			
			//$("#contadordoc").load('funciones/traer_consecutivo.php?id='+id);
			
			//SE UBICA EN ESTA PARTE POR QUE GENER UNA INCOSISTENCIA, SI SE PONE ANTES LAS FUNCIONES ANTERIORES NO FUNCIONAN
			AgregarCampos(0,0);
		
    });
	
	$("#documentos").change(function(event){
            
			var id    = $("#documentos").find(':selected').val();
			
			$("#tipodocumentos").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+1);
			
    });
	
	//CUANDO SE CAMBIA EL TIPO DE DOCUMENTO
	$("#tipodocumento").change(function(event){
            
			var id    = $("#tipodocumento").find(':selected').val();
			
			var partes;
			var iddocumento;
			
			//alert(id);
			$.get("funciones/traer_datos_consecutivo.php?id="+id, function(datoconsecutivo){
				
					//alert(datoconsecutivo);
					
					var dc = datoconsecutivo.split("******");
					
					//$("#ndocumento").val(datoconsecutivo);
					$("#ndocumento").val(dc[0]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					//var consecutivo = datoconsecutivo.split("-");
					var consecutivo = dc[0].split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
					$("#consecutivodocumento").val(consecutivo);
					
					//******************************************************************************************************************
					//NOTA: DONDE SE CAPTURA EL consecutivo, YA NO SERIA NECESARIO POR QUE ESTO YA LO ARMO 
					//EN LA FUNCION DEL MODELO documentosMode.php, FUNCION traer_datos_consecutivo, SE DEJA 
					//PRA QUE EL SISTEMA NO PRESENTE NINGUNA FALLA.
					
					//CAPTURO LOS DATOS DE LA SIGLA Y EL A�O ACTUAL
					//Y SE ASIGNA AL CAMPO siglas DE LA VISTA documentos_generar.php
					//ESTO CON EL OBJETO DE COSNTRUIR UN NUMERO UNICO DE DOCUMENTO
					//EN LA TABLA documentos_internos CAMPO numero, BASADO EN EL CAMPO id
					//DE ESE DOCUMENTO, YA QUE SIN ESTA VALIDACION NO SE REALIZA, AL ESCOGER CUALQUIER TIPO DE DOCUMENTO
					//EL SISTEMA AUTOMATICAMENTE ASIGNA Numero Documento: XXXX DEPENDIENDO DE DONDE ESTE PARADO EL CONTADOR
					//DE CADA DOCUMENTO DE LA TABLA pa_tipodocumento, Y SE PRESENTA QUE SI DE UN PC SE ESCOGE UN OFICIO
					//Y SU CONTADOR ESTA EN 3 PASARIA A LA SIGUIENTE FORMA Numero Documento: OECMO15-004, Y SI AUN NO SE A DADO
					//CLIC EN REGISTRAR Y DESDE OTRO PC SE ESCOGE TAMBIEN TIPO DE DOCUMENTO OFICIO EL SISTEMA ARMA
					//EL Numero Documento: OECMO15-004 IGUAL Y AL DARSE CLIC EN REGISTRAR EN EAMBOS PC, OBTENDREMOS UN DOCUMENTO
					//CON IGUAL Numero Documento
					
					/*var siglas = dc[0].split("-");
					siglas	   = siglas[0];
					$("#siglas").val(siglas);*/
					
					//******************************************************************************************************************
					
					partes      = dc[1];
					iddocumento = dc[2];
					
					AgregarCampos(partes,iddocumento);
			
			});
			
			
			
    });
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.filtrar').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('fecharematei').value.length   == 0 &&
			document.getElementById('fecharematef').value.length   == 0 &&
			document.getElementById('juzgadorema').value.length    == 0 &&
			document.getElementById('documentos').value.length     == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('direccion').value.length      == 0 &&
			document.getElementById('ciudad').value.length         == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('radicadox').value.length      == 0 &&
			document.getElementById('usuariox').value.length       == 0){
			
			//************************************************************************************
			//CIERRO ESTA PARTE PERO TAMBIEN FUNCIONA, PERO EXIGE AL USUARIO
			//QUE DEFINA ALGUN FILTRO
			/*alert("Definir Algun Campo para Realizar la Consulta");
			document.getElementById('fechai').style.borderColor='#FF0000';
			document.getElementById('fechaf').style.borderColor='#FF0000';
			document.getElementById('tipodocumento').style.borderColor='#FF0000';
			document.getElementById('ndocumento').style.borderColor='#FF0000';
			document.getElementById('dirigidoa').style.borderColor='#FF0000';
			document.getElementById('nombre').style.borderColor='#FF0000';
			document.getElementById('cargo').style.borderColor='#FF0000';
			document.getElementById('dependencia').style.borderColor='#FF0000';
			document.getElementById('asunto').style.borderColor='#FF0000';*/
			//************************************************************************************
			
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=documentos&action=RecargarTabla&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
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
			datox9 = document.getElementById('documentos').value;
			datox10 = document.getElementById('radicadox').value;
			datox11 = document.getElementById('usuariox').value;

			datox12 = document.getElementById('fecharematei').value;
			datox13 = document.getElementById('fecharematef').value;
			datox14 = document.getElementById('juzgadorema').value;
			
			//alert(datox9);
	
			//location.href="index.php?controller=sigdoc&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2;
			
			//$('#tablaconsulta').show();
			
			location.href="index.php?controller=documentos&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&datox9="+datox9+"&datox10="+datox10+"&datox11="+datox11+"&datox12="+datox12+"&datox13="+datox13+"&datox14="+datox14;
	
		}
	
    });
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$('.generar_pdf').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var id = $(this).attr('data-id');
				var ip = $(this).attr('data-ip');
				
				//alert(id);
				//var ipservidor = "190.217.24.24";
				var ipservidor = ip;

				window.open("http://"+ipservidor+"/laborales/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
	});
	
	//ME PERMITE CARGAR LOS DATOS AL FORMULARIO, SEGUN EL ID ESPECIFICADO
	$(".editar").click(function(){
								

		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
		var id = $(this).attr('data-id');
		
		//alert(id);
		//ASIGNO EL VALOR ID A UN INPUT OCULTO EN EL FORMULARIO,PARA PODER SER ACTUALIZADO EL DOCUMENTO EN LA BASE DE DATOS
		$("#iddocumento").val(id);
		
		location.href="index.php?controller=documentos&action=Editar_documento_Saliente&id="+id;
		
	 
		//$.get("funciones/traer_datos_documento.php?id="+id, function(cadena){
																	 
		/*$.get("index.php?controller=sigdoc&action=traer_datos_documento&id="+id, function(cadena){
			
			//alert(cadena);
			
			//RECIBO LOS DATOS DE traer_datos_documento, SEGUN EL ID DEL DOCUMENTO EL CUAL QUIERO EDITAR
			//Y CARGO CADA CAMPO DEL FORMULARIO SEGUN SU DATO
			var datos_formulario = cadena.split("//////");
			
			//alert(datos_formulario[7]);
			
			$("#tipodocumento").val(parseInt(datos_formulario[3]));
			$("#tipodocumento").attr('disabled', 'disabled');
			
			$("#ndocumento").val(datos_formulario[4]);
			$("#dirigidoa").val(parseInt(datos_formulario[5]));
			$("#nombre").val(datos_formulario[6]);
			$("#cargo").val(datos_formulario[7]);
			$("#dependencia").val(datos_formulario[8]);
			
			$("#fechag").val(datos_formulario[9]);
			$("#fechag").attr('disabled', 'disabled');
			
			$("#asunto").val(datos_formulario[10]);
			$("#detalleds").val(datos_formulario[11]);
			
		
		});*/
		
	
	});
	
	$("#radicado").change(function(event){
		
		var idradicado = $("#radicado").val();
		
		//alert(idradicado);
		
		
		$.get("funciones/traer_datos_radicado.php?idradicado="+idradicado, function(datosradicado){
				
					//alert(datosradicado);
					
					datosid = datosradicado.split("//////");
					$("#idr").val(datosid[0]);
					$("#cedula_demandante").val(datosid[1]);
					$("#demandante").val(datosid[2]);
					$("#cedula_demandado").val(datosid[3]);
					$("#demandado").val(datosid[4]);
					$("#claseproceso").val(datosid[5]);
					$("#jo").val(datosid[6]);
					$("#jd").val(datosid[7]);
					
					//ASIGO EL VALOR DEL CONTADOR ACTUAL SEGUN EL TIPO DE DOCUMENTO Y
					//PODER ACTUALIZARLO EN LA TABLA sigdoc_pa_consecutivo
					/*var consecutivo = datoconsecutivo.split("-");
					consecutivo		= parseInt(consecutivo[1]);
					//alert(consecutivo);
																		 
					$("#consecutivodocumento").val(consecutivo);*/
			
		});
	 
	});
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO EN WORD
	$(".generarword").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=documentos&action=GenerarDocumentoSaliente&opcion=1&id="+id;

		//window.open("views/PHPPdf/Reporte_DocumentoSaliente.php?id="+id);
			
		
	});
	
	//FILTRAR TABLA REGISTRO DOCUMENTOS SALIENTES
	$('.estadistica').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('fecharematei').value.length   == 0 &&
			document.getElementById('fecharematef').value.length   == 0 &&
			document.getElementById('juzgadorema').value.length    == 0 &&
			document.getElementById('documentos').value.length     == 0 &&
			document.getElementById('tipodocumentos').value.length == 0 &&
			document.getElementById('ndocumento').value.length     == 0 &&
			document.getElementById('dirigidoa').value.length      == 0 &&
			document.getElementById('nombre').value.length         == 0 &&
			document.getElementById('direccion').value.length      == 0 &&
			document.getElementById('ciudad').value.length         == 0 &&
			document.getElementById('asunto').value.length         == 0 &&
			document.getElementById('usuariox').value.length       == 0 &&
		    document.getElementById('radicadox').value.length      == 0){
			
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
			datox9 = document.getElementById('radicadox').value;
			datox10 = document.getElementById('usuariox').value;
			datox11 = document.getElementById('documentos').value;
			
			datox12 = document.getElementById('fecharematei').value;
			datox13 = document.getElementById('fecharematef').value;
			datox14 = document.getElementById('juzgadorema').value;
			
			//location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion=2";
			
			location.href="index.php?controller=documentos&action=GenerarDocumentoEstadistica&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&tfiltro="+tfiltro+"&datox9="+datox9+"&datox10="+datox10+"&datox11="+datox11+"&datox12="+datox12+"&datox13="+datox13+"&datox14="+datox14;
	
		}
	
    });
	
	$(".generarcaratula_2").click(function(){
	
		//alert(1);
		
		datox1 = document.getElementById('radicado').value;
		
		if( datox1 == null || datox1.length == 0 || /^\s+$/.test(datox1) ) {
  		
			alert("Defina Radicado");
			document.getElementById('radicado').style.borderColor = '#FF0000';
			
		}
		else{
			//alert(idradicadocaratula);
			
			var idradicadocaratula = document.getElementById('radicado').value;
			
			location.href="index.php?controller=documentos&action=Generar_Caratula&opcion=1&idradicadocaratula="+idradicadocaratula+"&idcaratula="+39;
			
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

var nextinput = 0;
var elitinput = 0;

function AgregarCampos(nunpartes,iddocumento){
	
	//alert(nunpartes);
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	
	var partesdoc = nunpartes.split("//////");
	var longitud  = partesdoc.length;
	
	
	//EL IF PARA CONTROLAR LOS OFICIOS QUE NO TENGAN PARTES, PARTES CERO (0)
	if(partesdoc[0] != 0){
		
		//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
		while (nextinput < longitud) {
			
			//PARA IDENTIFCAR QUE UN CAMPO ES FECHA, SIMPLEMENTE PREGUNTANDO
			//CON LA FUNCION indexOf QUE LA CADENA QUE VIENE EN partesdoc[nextinput]
			//CONTIENE LA PALABRA FECHA DE ALGUNA FORMA, Y QUE SU VALOR DE RETORNO ES 
			// >= 0 SI SU RETORNO ES -1 QUIERE DECIR QUE EL CAMPO NO ES FECHA
			//ES IMPORTANTE RECALCAR QUE PARA ESTO SE DEBE DEFINIR EN LA TABLA pa_tipodocumento
			//COLUMNA PARTESDOCUMENTO, CUAL DE LAS PARTE SERA FECHA SIMPLEMENTE
			//COLOCANDO LA PALABRA (FECHA,Fecha,fecha), LA CUAL PUEDE IR ACOMPA�ADA DE OTRAS PALABRAS
			var identificadorcampo1 = partesdoc[nextinput].indexOf('FECHA');
			var identificadorcampo2 = partesdoc[nextinput].indexOf('Fecha');
			var identificadorcampo3 = partesdoc[nextinput].indexOf('fecha');
			
			if(identificadorcampo1 >= 0 || identificadorcampo2 >= 0 || identificadorcampo3 >= 0){
			
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required" readonly="true"/></li>';
				$("#campos").append(campo);
				$("#parte"+nextinput).datepicker({ changeFirstDay: false	});
			}
			else{
					
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
				$("#campos").append(campo);
				
			}
			
			
			/*if(nextinput == 0){
			
				//SE FILTRA POR 2 YA QUE LOS COMISORIOS NO LLEVAN FECHA AUTO
				if(iddocumento != 2){
					
					
					//ASI ESTABA CUANDO NO SE TENIA EL DEOficio Arancel Judicial
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required" readonly="true"/></li>';
					$("#campos").append(campo);
					$("#parte0").datepicker({ changeFirstDay: false	});
					
				
				}
				else{
					
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
					$("#campos").append(campo);
				
				}
				
			}
			else{
				
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
				$("#campos").append(campo);
			}*/
			
			nextinput++;
			
		}
		
		//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
		//$("#partesdoc").val(nunpartes);
		$("#partesdoc").val(longitud);
	
	}//FIN if(partesdoc[0] != 0){
		
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	longitud  = 0;
	partesdoc.length = 0;
	
}

//FUNCION USADA CUANDO SE VA A EDITAR UN DOCUMENTO
function AgregarCampos_Con_Contenido(nunpartes,iddocumento,contenidopartes){
	
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	
	var partesdoc = nunpartes.split("//////");
	var longitud  = partesdoc.length;
	
	//alert(contenidopartes);
	var contenidopartes_2 = contenidopartes.split("//////");
	
	//alert(contenidopartes_2[1]);
	
	
	//EL IF PARA CONTROLAR LOS OFICIOS QUE NO TENGAN PARTES, PARTES CERO (0)
	if(partesdoc[0] != 0){
		
		//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
		while (nextinput < longitud) {
			
			
			//PARA IDENTIFCAR QUE UN CAMPO ES FECHA, SIMPLEMENTE PREGUNTANDO
			//CON LA FUNCION indexOf QUE LA CADENA QUE VIENE EN partesdoc[nextinput]
			//CONTIENE LA PALABRA FECHA DE ALGUNA FORMA, Y QUE SU VALOR DE RETORNO ES 
			// >= 0 SI SU RETORNO ES -1 QUIERE DECIR QUE EL CAMPO NO ES FECHA
			//ES IMPORTANTE RECALCAR QUE PARA ESTO SE DEBE DEFINIR EN LA TABLA pa_tipodocumento
			//COLUMNA PARTESDOCUMENTO, CUAL DE LAS PARTE SERA FECHA SIMPLEMENTE
			//COLOCANDO LA PALABRA (FECHA,Fecha,fecha), LA CUAL PUEDE IR ACOMPA�ADA DE OTRAS PALABRAS
			var identificadorcampo1 = partesdoc[nextinput].indexOf('FECHA');
			var identificadorcampo2 = partesdoc[nextinput].indexOf('Fecha');
			var identificadorcampo3 = partesdoc[nextinput].indexOf('fecha');
			
			if(identificadorcampo1 >= 0 || identificadorcampo2 >= 0 || identificadorcampo3 >= 0){
			
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required" readonly="true"/></li>';
				$("#campos").append(campo);
				$("#parte"+nextinput).datepicker({ changeFirstDay: false	});
			}
			else{
					
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
				$("#campos").append(campo);
				
			}
			
			
			/*if(nextinput == 0){
				
				//SE FILTRA POR 2 YA QUE LOS COMISORIOS NO LLEVAN FECHA AUTO
				if(iddocumento != 2){
					
					
						//ASI ESTABA CUANDO NO SE TENIA EL DEOficio Arancel Judicial
						campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required" readonly="true"/></li>';
						$("#campos").append(campo);
						$("#parte0").datepicker({ changeFirstDay: false	});
						
					
					
				
				}
				else{
					
					campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
					$("#campos").append(campo);
				
				}
				
			}
			else{
				
				campo = '<li id="rut'+nextinput+'">'+partesdoc[nextinput]+'<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; value="' + contenidopartes_2[nextinput + 1] + '" class="required"/></li>';
				$("#campos").append(campo);
			}*/
			
			nextinput++;
			
		}
		
		//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
		//$("#partesdoc").val(nunpartes);
		$("#partesdoc").val(longitud);
	
	}//FIN if(partesdoc[0] != 0){
		
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	longitud  = 0;
	partesdoc.length = 0;
	
}


//FUNCION ORIGINAL, SOLO RECIBE UN PARAMETRO nunpartes
/*var nextinput = 0;
var elitinput = 0;

function AgregarCampos(nunpartes){
	
	
	//alert(nunpartes+"---"+nextinput+"---"+elitinput);
	
	/*nextinput++;
	campo = '<li id="rut'+nextinput+'">Campo:<input type="text" size="20" id="campo' + nextinput + '"&nbsp; name="campo' + nextinput + '"&nbsp; /></li>';
	$("#campos").append(campo);*/
	
	//$("#rut1").remove();
	
	//ELIMINO LA LISTA DONDE ESTA UBICADO EL CAMPO (input)
	//PARA QUE REFRESQUE LOS CAMPOS NECESARIOS, SEGUN NTIPO DE DOCUMENTO SELECCIONADO
	/*while (elitinput < 20) {
	
		//alert($("#parte" + elitinput).val());
		
		$("#rut" + elitinput).remove();
    	elitinput++;
		
	}
	//AGREGO NUMERO DE CAMPOS (input), SEGUN EL TIPO DE DOCUMENTO
	while (nextinput < nunpartes) {
		
    	campo = '<li id="rut'+nextinput+'">Parte:<input type="text" size="50" id="parte' + nextinput + '"&nbsp; name="parte' + nextinput + '"&nbsp; title="parte' + nextinput + '"&nbsp; class="required"/></li>';
		$("#campos").append(campo);
    	nextinput++;
		
	}
	
	//ASIGNO CUANTAS PARTES SE LE AGREGARON AL DOCUMENTO, PARA SER ENCIADAS Y GRABADAS EN LA BASE DE DATOS
	$("#partesdoc").val(nunpartes);
	
	//INICIALIZO LAS VARIABLES QUE ME INDICAN HASTA DONDE AGREGAR O ELIMINAR CAMPOS
	nextinput = 0;
	elitinput = 0;
	
}*/

function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}


