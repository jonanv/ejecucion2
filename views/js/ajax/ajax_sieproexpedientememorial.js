$(function(){
	
	//PARA VALIDAR LOS CAMPOS DEL FORMULARIO
	/*var validator = $("#frm").validate({
		meta: "validate"
	});*/
	
	//ME PERMITE VALIDAR QUE SE ASIGNO ALGUNA PARTE AL PROCESO
	$(".btn_validar").click(function() {
		
		var cantidad_filas_2;
	    var TABLA_2      = document.getElementById('t');
		cantidad_filas_2 = TABLA_2.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		
		if(cantidad_filas_2 > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezados = 0;
			
			var datospartes="";
		
			$('#t tr').each(function () {
	
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				
				
			
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
					
	
				}
		
			});
			
			//alert(datospartes);
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla RADICADOS");
			return false;
		}
		
	});	
	
	
	$("#ok").hide();

    $("#frm").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			//var idradicado     = $('#idradicado').val();
			//var radicado       = $('#radicado').val();
			
			
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			/*var idclasejuzgado = radicadox.substring(5, 9);
			var iddepartamento = radicadox.substring(0, 2);
			var idmunicipio    = radicadox.substring(0, 5);*/
			
			//**********************************************************************************************************
			//var dataString = 'radicado='+$('#radicado').val()+'&datospartes='+$('#datospartes').val()+'&ordenadooficio='+$('#oficiox').val();
			
			var dataString = 'radicado='+$('#radicado2').val()+'&datospartes='+$('#datospartes').val()+'&idradicado='+$('#idr').val();;
			var url1       = "index.php?controller=archivo&action=Registrar_Expediente_Memorial_Incorporado";
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
				   
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		//validator.resetForm();
		Limpiar_Campos();
	});		
	
	//PARA LAS FECHAS
	$("#fechaie").datepicker({ changeFirstDay: false	});
	$("#fechafe").datepicker({ changeFirstDay: false	});
	
	$("#fechap").datepicker({ changeFirstDay: false	});
	

	//FILTRAR TABLA REGISTRO
	$('#consultarincorporar').click(function(evento){
								 
		var idradicado = $("#radicado").val();
		//var fechaie    = $("#fechaie").val();
		//var fechafe    = $("#fechafe").val();
		
		//alert(idradicado);
		
		if( 
		   
		   idradicado == null || idradicado.length == 0 || /^\s+$/.test(idradicado)
		   //fechaie    == null || fechaie.length    == 0 || /^\s+$/.test(fechaie)    ||
		   //fechafe    == null || fechafe.length    == 0 || /^\s+$/.test(fechafe) 
		   
		) {
  		
			alert("Defina Radicado");
			document.getElementById('radicado').style.borderColor = '#FF0000';
			//document.getElementById('fechaie').style.borderColor = '#FF0000';
			//document.getElementById('fechafe').style.borderColor = '#FF0000';
			
		}
		else{
			
			//$.get("funciones/traer_datos_incorpora_proceso.php?idradicado="+idradicado, function(datosradicado){
			$.get("funciones/traer_datos_expediente_memorial.php?idradicado="+idradicado, function(datosradicado){
																								 
					
						//alert(datosradicado);
						
						//datosid = datosradicado.split("//////");
						
						datosid = datosradicado.split("******");
						
						datosid_b = datosid[0].split("//////");
						
						$("#idr").val(datosid_b[0]);
						$("#radicado2").val(datosid_b[1]);
						$("#cedula_demandante").val(datosid_b[2]);
						$("#demandante").val(datosid_b[3]);
						$("#cedula_demandado").val(datosid_b[4]);
						$("#demandado").val(datosid_b[5]);
						$("#claseproceso").val(datosid_b[6]);
						$("#jo").val(datosid_b[7]);
						$("#jd").val(datosid_b[8]);
						$("#posi").val(datosid_b[9]);
						$("#obserie").val(datosid_b[10]);
						
	
						Adicionar_Memorial(datosradicado);
						
						

				
						
			});
			
			
			
		}
		
		
		
	});
	
	$(".adicionarmemorial").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		Adicionar_Parte(1,id);
		
	});
	
	
	//FILTRAR TABLA REGISTRO
	$('.filtrar').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('beneficiariox').value.length  == 0 &&
			document.getElementById('radicadox').value.length      == 0 &&
			document.getElementById('numerotitulox').value.length  == 0){
			
			dato_0 = 3;
			
			location.href="index.php?controller=archivo&action=RecargarTablaOtrosJuzgados&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
		
			datox1 = document.getElementById('idds').value;
			datox2 = document.getElementById('beneficiariox').value;
			datox3 = document.getElementById('radicadox').value;
			datox4 = document.getElementById('numerotitulox').value;
			
			//alert(datox2);
	
			location.href="index.php?controller=archivo&action=FiltroTablaOtrosJuzgados&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
	
		}
	
    });
	
	
	//ASIGNAR LA FECHA DE PAGO AL TITULO DEL PROCESO
	$('.asignarfechapago').click( function(){
							   
		//CAPTURO EL ID DEL DOCUMENTO EL CUAL QUIERO CORREGIR
		var id = $(this).attr('data-id');
		
		//alert(id);
		
		params={};
        params.id = id;

		 //alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/asignarfechapago.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	
	
	$(".ponerencustodia").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=archivo&action=Poner_En_Custodia&opcion=1&id="+id;
		
	});
	
	$(".sincustodia").click(function(){
	

		var id	= $(this).attr('data-id');
		
		//alert(id);
	
		location.href="index.php?controller=archivo&action=Poner_En_Custodia&opcion=2&id="+id;
		
	});
	
	$(".generarexcel").click(function(){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('beneficiariox').value.length  == 0 &&
			document.getElementById('radicadox').value.length      == 0 &&
			document.getElementById('numerotitulox').value.length  == 0){
			
			dato_0  = 2;//para saber que es el reporte 1
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=archivo&action=GenerarTituloOtroJuzgadoExcel&opcion="+dato_0+"&tfiltro="+tfiltro;
       	
		}
		else{
		
			dato_0  = 2;//para saber que es el reporte 1
			tfiltro = 2;//con filtro
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
		
			datox1 = document.getElementById('idds').value;
			datox2 = document.getElementById('beneficiariox').value;
			datox3 = document.getElementById('radicadox').value;
			datox4 = document.getElementById('numerotitulox').value;
			
			//alert(datox4);
	
			location.href="index.php?controller=archivo&action=GenerarTituloOtroJuzgadoExcel&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&tfiltro="+tfiltro;
	
		}
	
    });
	
	
	/*$("#numerotitulo2").change(function(event){
							   
		alert(1);
	
	
	});*/
	
	
	
	
	//----------------CONSTRUIR RADICADO--------------------------------------
	$("#juzgadoorigen").change(function(event){
			
			construir_radicado();
			
			var id    = $("#juzgadoorigen").find(':selected').val();
			var idjuz = id.split("-");
			
			//CARGAR LISTA DE PROCESOS
			$("#claseproceso").load('funciones/traer_datos_lista.php?id='+idjuz[0]+"&idsql="+1);
			
			//CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
			$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
			
    });
	$("#year").change(function(event){
			
			construir_radicado();
           
    });
	$("#consecutivo").change(function(event){
			
			construir_radicado();
           
    });
	$("#instancia").change(function(event){
			
			construir_radicado();
           
    });
	
	//PARA OCULTAR FILA  filapartes
	$('#filapartes').hide();
	$('#filapartes2').hide();
	

	//PARA ACTIVAR Y DEACTIVAR filapartes
	var contador = 0;
	$("#btpartes").click(function(evento){
      	
		evento.preventDefault();
		
		contador = contador + 1;
		
		if(contador == 1){
		
			$('#filapartes').show();
			$('#filapartes2').show();
			contador = contador + 1;
		}
		else{
			$('#filapartes').hide();
			$('#filapartes2').hide();
			contador = 0;
		}
   	});
	
	$("#departamento").change(function(event){
			
			var id    = $("#departamento").find(':selected').val();
			
			$("#municipio").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+2);
			
    });
	
	
	$('#partesdemandado').hide();
	
	$("#fechaxad").datepicker({ changeFirstDay: false	});
	
	$("#clasificacionparte").change(function(event){
											 
		var idclase = $("#clasificacionparte").find(':selected').val();
		
		if(idclase == 2){
			
			$('#partesdemandado').show();
			
			var id = $("#juzgadoorigen").find(':selected').val();
			
			$("#autonotificar").load('funciones/traer_datos_lista.php?id='+id+"&idsql="+4);
		}
		else{
			$('#partesdemandado').hide();
		}
			
    });
	
	$("#clasificacionparte2").change(function(event){
											 
		var idclase = $("#clasificacionparte2").find(':selected').val();
		
		if(idclase == 2){
			
			$('#partesdemandado').show();
			
			$("#autonotificar").load('funciones/traer_datos_lista.php?id='+$("#juzgadox2").val()+"&idsql="+4);
		}
		else{
			$('#partesdemandado').hide();
		}
			
    });
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UN PROCESO
	$(".btn_validar2").click(function() {
		//alert(1);
		//return false
		
		var vmp0 = $('#radicadox3').val();
		var vmp1 = $('#radicadox').val();
		var vmp2 = $('#juzgadoorigen').val();
		var vmp3 = $('#claseproceso').val();
		
		if( (vmp0 == null || vmp0.length == 0 || /^\s+$/.test(vmp0)) &&
			(vmp1 == null || vmp1.length == 0 || /^\s+$/.test(vmp1)) && 
			(vmp2 == null || vmp2.length == 0 || /^\s+$/.test(vmp2)) && 
			(vmp3 == null || vmp3.length == 0 || /^\s+$/.test(vmp3)) ) {
			
			alert('Se debe definir al menos un parametro a modificar como (Radicado a Modificar, Nuevo Radicado, Juzgado o Clase Proceso)');
			return false
		}
	});
	
	$("#frm1x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var radicadox3     = $('#radicadox3').val();
			
			var radicadox      = $('#radicadox').val();
			var juzgadoorigen  = $('#juzgadoorigen').val();
			var idclaseproceso = $('#claseproceso').val();
		
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			//var idclasejuzgado = radicadox.substring(5, 9);
			//var iddepartamento = radicadox.substring(0, 2);
			//var idmunicipio    = radicadox.substring(0, 5);
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			//CAMPO OCULTO QUE ME DEFINE SI SE ESTA REGISTRANDO O MODIFICANDO UN PROCESO ---> $('#idradicado').val();
			
			//REGISTRAR PROCESO
			/*if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
  		
				//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
				//var url1       = "index.php?controller=signot&action=Registro_Proceso";
				
				return false;
			}
			//MODIFICAR PROCESO
			else{*/
				
				var dataString = 'idradicado='+$('#idradicado').val()+'&radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclaseproceso='+idclaseproceso+'&radicadox3='+radicadox3;
				var url1       = "index.php?controller=signot&action=Modificar_Proceso_2";
			//}
			
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UNA PARTE
	$("#frm2x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var radicadox3     = $('#radicadox3').val();
			
			var radicadox      = $('#radicadox').val();
			var juzgadoorigen  = $('#juzgadoorigen').val();
			var idclaseproceso = $('#claseproceso').val();
		
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			//var idclasejuzgado = radicadox.substring(5, 9);
			//var iddepartamento = radicadox.substring(0, 2);
			//var idmunicipio    = radicadox.substring(0, 5);
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			//CAMPO OCULTO QUE ME DEFINE SI SE ESTA REGISTRANDO O MODIFICANDO UN PROCESO ---> $('#idradicado').val();
			
			//REGISTRAR PROCESO
			/*if( $('#idradicado').val() == null || $('#idradicado').val().length == 0 || /^\s+$/.test($('#idradicado').val()) ) {
  		
				//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
				//var url1       = "index.php?controller=signot&action=Registro_Proceso";
				
				return false;
			}
			//MODIFICAR PROCESO
			else{*/
				
				var dataString = 'idradicado='+$('#idradicado').val()+'&radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclaseproceso='+idclaseproceso+'&radicadox3='+radicadox3;
				//var url1       = "index.php?controller=signot&action=Modificar_Proceso_2";
			//}
			
			//var dataString = 'radicadox='+radicadox+'&juzgadoorigen='+juzgadoorigen+'&idclasejuzgado='+idclasejuzgado+'&idclaseproceso='+idclaseproceso+'&iddepartamento='+iddepartamento+'&idmunicipio='+idmunicipio+'&datospartes='+$('#datospartes').val();
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	//ME PERMITE VALIDAR CUANDO SE MODIFICA UNA DIRECCION
	$("#frm4x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var iddireccionx = $('#iddireccionx').val();
			
			var documentox   = $('#documentox').val();
			var nombrex      = $('#nombrex').val();
			var telefonox    = $('#telefonox').val();
			var direccionx   = $('#direccionx').val();
			var departamento = $('#departamento').val();
			var municipio    = $('#municipio').val();


			var dataString = 'iddireccionx='+iddireccionx+'&nombrex='+nombrex+'&telefonox='+telefonox+'&direccionx='+direccionx+'&departamento='+departamento+'&municipio='+municipio;
			var url1       = "index.php?controller=signot&action=Modificar_Direccion_2";
			
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	
	//ME PERMITE VALIDAR CUANDO SE CORREGI UNA CITACION
	$("#fechaxau1").datepicker({ changeFirstDay: false	});
	$("#fechaxau2").datepicker({ changeFirstDay: false	});
	
	$("#frm5x").validate({
        rules: {
            
			//ejemplo con campo cedula
			//cedula: { required: true, minlength: 2},
           
		   /*lastname: { required: true, minlength: 2},
            email: { required:true, email: true},
            phone: { minlength: 2, maxlength: 15},
            years: { required: true},
            message: { required:true, minlength: 2}*/
        },
        messages: {
           
		   //ejemplo con campo cedula
		   //cedula: "Defina Cedula",
           
		   /*lastname: "Debe introducir su apellido.",
            email : "Debe introducir un email válido.",
            phone : "El número de teléfono introducido no es correcto.",
            years : "Debe introducir solo números.",
            message : "El campo Mensaje es obligatorio.",*/
        },
        submitHandler: function(form){
            
			//var dataString = 'name='+$('#name').val()+'&lastname='+$('#lastname').val()+'...';
			//var dataString = 'cedula='+$('#cedula').val();
			
			//var dataString = 'cedula='+$('#cedula').val()+'&datospartes='+datospartes;
			
			var idautox      = $('#idautox').val();
			
			var documentox   = $('#documentox').val();
			var nombrex      = $('#nombrex').val();
			var radicadox    = $('#radicadox').val();
			
			var autox        = $('#autox').val();
			var fechaxau1    = $('#fechaxau1').val();
			var fechaxau2    = $('#fechaxau2').val();
			var correccionx  = $('#correccionx').val();


			var dataString = 'idautox='+idautox+'&autox='+autox+'&fechaxau1='+fechaxau1+'&fechaxau2='+fechaxau2+'&correccionx='+correccionx;
			var url1       = "index.php?controller=signot&action=Corregir_Notificacion_2";
			
			
			//**********************************************************************************************************
			
			//alert(dataString);
			
            $.ajax({
                type: "POST",
                //url:"send.php",
				//url:"index.php?controller=signot&action=Registro_Proceso",
				url:url1,
                data: dataString,
                success: function(data){
					
					//NOTA: ES IMPORTANTE DEFINIR ESTE OK EN LA VISTA QUE SE ESTA VALIDANDO, YA QUE AL DAR REGISTRAR
					//EL SISTEMA REGISTRA PERO NO MUESTRA QUE LA TRANSACCION FUE BIEN O NO.
                    $("#ok").html(data);
                    $("#ok").show();
                   // $("#frm").hide();
                }
            });
		
			
        }
    });
	
	//---------------------------------------------------------------------------
	


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


function Consultar_Numero_Titulo(idvalor){
	
	//alert(idvalor);
	
	if(idvalor.length == 6) {
		
		$.get("funciones/traer_numero_titulo.php?idvalor="+idvalor, function(cadena){
																		   
			//alert(cadena);
			var vector_datos = cadena.split("//////");
	
			if( vector_datos[1] != null ) {
				
				msg = trim("Numero de Titulo ya fue Asignado --> "+" Id: " +vector_datos[0]+" Numero: "+vector_datos[1]);
				alert(msg);
				$("#numerotitulo2").val('');
	
			}
			
	
		});
		
	}
	
}

function construir_radicado(){
	
	var id = $("#juzgadoorigen").find(':selected').val();
			
	//alert(id);
  	var area_vector    = id.split("-");
	var area_nueva     = area_vector[1];
  	var numero_juzgado = area_vector[2];
			
	var year        = $("#year").val();
	var consecutivo = $("#consecutivo").val();
	var instancia   = $("#instancia").val();
			
			
	var relleno = "";
		  	
	if(numero_juzgado > 9){
		  		
		relleno = "0";
	}
	else{
		relleno = "00";
	}
	
	//CIRCUITO 3103
	if(area_nueva == 1){
		var area = "170013103"; 
	}
	
	//FAMILIA 3110
	if(area_nueva == 2){
		var area = "170013110"; 
	}
	
	//MUNICIPAL 4003
	if(area_nueva == 3){
		var area = "170014003"; 
	}
			
			
	var radicadocompleto = "";
	radicadocompleto     = area+relleno+numero_juzgado+year+"00"+consecutivo+instancia;
	
	$("#radicadox").val(radicadocompleto);
	
	//VALIDO QUE EL RADICADO YA EXISTA O NO, PARA NO PERMITIR DE NUEVO SU REGISTRO
	Traer_Dato_Radicado(radicadocompleto);
}


var z=1;
var Filas = 0;

function Adicionar_Parte(idaccion,idmemorial){
	
	//var dx1  = document.getElementById("t2").rows[idmemorial].cells[0].innerText;
	
	//alert(dx1);
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existeradicado = Validar_Radicado_Tabla();
	
	//existeradicado = 0;
	
	existenumtitulo = Existe_Numero(document.getElementById('idr').value);
	
	if(existenumtitulo == 1){
		
		existenumtitulo = 1;
		alert("Ya Existe ese RADICADO en la Tabla no es posible su Adicion");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	//var validarcampos = Validar_Campos_Agregar(idaccion);
	
	validarcampos = 0;
	
	if(validarcampos == 1){
		
		validarcampos = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1 = document.getElementById('idr').value;
			var dato2 = document.getElementById('radicado').value;
			
			
			
			
			/*if(idaccion == 1){
				
				var s0    = document.frm.clasificacionparte;
				var dato5 = document.getElementById('clasificacionparte').value+"-"+s0.options[s0.selectedIndex].text;
			}*/
			
			
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas = 1;
			var cantidad_filas;
			var TABLA      = document.getElementById('t');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla=document.getElementById('cont').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+dato1+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
				
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla+='</tr></table>';
					
					document.getElementById('cont').innerHTML=tabla;
					
					z++;
					
					Limpiar_Campos();
					
					
					
				 //}
			}
						
			if(cantidad_filas==1){
						
				//alert('cantidad = 1');
				
				var tabla=document.getElementById('cont').innerHTML;
				
				//alert(tabla);
				
				//for (var id=0; id<Filas; id++){
					
					//var partefinal = tabla.length - 8;
					
					//alert("Longitud Tabla: "+tabla.length);
					//alert("Parte Final: "+partefinal);
					
					//tabla=tabla.substring(0,(tabla.length-8));
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					//tabla=tabla.substring(0,partefinal);
					
					
					//alert(tabla);
					
					tabla+='<tr>';
				
					tabla+='<td>'+dato1+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					
			
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont').innerHTML=tabla;
					
					z++;
					
					
					Limpiar_Campos();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}


function Existe_Numero(idmemorial){
	
	var existe = 0;
	
	var datonumero = idmemorial; //document.getElementById('numerotitulo').value+document.getElementById('numerotitulo2').value;
	
	$('#t tr').each(function () {
	
		var d0  = $(this).find("td").eq(0).html();
		
		if(datonumero == d0){
			existe = 1;
			return false;
			
		}
		
		
	});
	
	return  existe;
				
}

function Validar_Campos_Agregar(idaccion){
	
	var validar = 0;
	
	valor  = document.getElementById('obserie').value;
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Observacion");
		document.getElementById('obserie').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	

}

//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
function Eliminar_Fila(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA = document.getElementById('t');
	
	TABLA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}


var zx=1;
var Filasx = 0;

function Adicionar_Memorial(datostabla){
	
	        var resultado = datostabla.split("******");
		
			//alert(datostabla);
			
			Filas = resultado.length;
			//alert(Filas);
			
			var cantidad_filas;
			var TABLA      = document.getElementById('t2');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				Eliminar_Tabla_Memoriales();
				
				var tabla = document.getElementById('cont2').innerHTML;
					
				for (var id=0; id < Filas-1; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
					
					tabla+='<td>'+resultado2[13]+'</td>';
					
					
					
					
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Adicionar_Parte(1,this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/flecha.jpg" width="40" height="40" title="ADICIONAR RADICADO"/></button></td>';
					
					tabla+='</tr></table>';
					
					document.getElementById('cont2').innerHTML=tabla;
					
				
				 }
			}
						
			if(cantidad_filas == 1){
						
				
				var tabla = document.getElementById('cont2').innerHTML;
				
		
				for (var id=0; id < Filas-1; id++){
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
			
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
					
					tabla+='<td>'+resultado2[13]+'</td>';
					
			
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Adicionar_Parte(1,this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/flecha.jpg" width="40" height="40" title="ADICIONAR RADICADO"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}



// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {


   for (var i = 0; i < cadenaCompleta.length; i++) {
      if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
         cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
      }
   }
   return cadenaCompleta;
}

//SE USAN DOS FUNCIONES DE LIMPIAR CAMPOS,  Limpiar_Campos() Y Limpiar_Campos_2()
//YA QUE EN LA VISTA signot_registro_radicado.php Y signot_modificar_proceso.php
//EL CAMPO Clasificacion Parte REALIZA LA OPERACION DE LLENAR LISTA Auto a Notificar:
//CON EL ID DEL JUZGADO DE ORIGEN, PERO EN LA VISTA signot_registro_radicado.php ESTE ES UNA LISTA
//Y EN signot_modificar_proceso.ph ES UN CAMPO DE TEXTO
function Limpiar_Campos(){
	
	document.getElementById('radicado').value = "";
	document.getElementById('radicado').style.borderColor='#E0E0E0';
	
	document.getElementById('radicado2').value = "";
	document.getElementById('radicado2').style.borderColor='#E0E0E0';

	document.getElementById('idr').value = "";
	document.getElementById('idr').style.borderColor='#E0E0E0';

	document.getElementById('cedula_demandante').value = "";
	document.getElementById('cedula_demandante').style.borderColor='#E0E0E0';
	
	document.getElementById('demandante').value = "";
	document.getElementById('demandante').style.borderColor='#E0E0E0';
	
	document.getElementById('cedula_demandado').value = "";
	document.getElementById('cedula_demandado').style.borderColor='#E0E0E0';
	
	document.getElementById('demandado').value = "";
	document.getElementById('demandado').style.borderColor='#E0E0E0';
	
	document.getElementById('jo').value = "";
	document.getElementById('jo').style.borderColor='#E0E0E0';
	
	document.getElementById('jd').value = "";
	document.getElementById('jd').style.borderColor='#E0E0E0';
	
	document.getElementById('claseproceso').value = "";
	document.getElementById('claseproceso').style.borderColor='#E0E0E0';
	
	document.getElementById('obserie').value = "";
	document.getElementById('obserie').style.borderColor='#E0E0E0';
	
	document.getElementById('posi').value = "";
	document.getElementById('posi').style.borderColor='#E0E0E0';
	
	
	Eliminar_Tabla_Memoriales();
	
	//$('#partesdemandado').hide();
	

}


function Limpiar_Campos_2(){
	
	document.getElementById('cedula').value = "";
	document.getElementById('cedula').style.borderColor='#E0E0E0';
	
	document.getElementById('nombre').value = "";
	document.getElementById('nombre').style.borderColor='#E0E0E0';
	
	document.getElementById('direccion').value = "";
	document.getElementById('direccion').style.borderColor='#E0E0E0';
	
	document.getElementById('telefono').value = "";
	document.getElementById('telefono').style.borderColor='#E0E0E0';

	document.getElementById('clasificacionparte2').selectedIndex = 0;
	document.getElementById('clasificacionparte2').style.borderColor='#E0E0E0';
	
	document.getElementById('departamento').selectedIndex = 0;
	document.getElementById('departamento').style.borderColor='#E0E0E0';
	
	document.getElementById('municipio').selectedIndex = 0;
	document.getElementById('municipio').style.borderColor='#E0E0E0';
	document.getElementById('municipio').length = 0;
	o       = document.createElement("OPTION");
	o.value = "";
	o.text  = "Seleccionar Municipio";
	document.getElementById('municipio').options.add (o);
	
	document.getElementById('fechaxad').value = "";
	document.getElementById('fechaxad').style.borderColor='#E0E0E0';

	document.getElementById('autonotificar').selectedIndex = 0;
	document.getElementById('autonotificar').style.borderColor='#E0E0E0';
	
	$('#partesdemandado').hide();
	

}

function Traer_Dato_Radicado(idradicado){
	
		
		oXML = AJAXCrearObjeto();
		oXML.open('GET', 'funciones/traer_datos_proceso.php?idradicado='+idradicado);
		oXML.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		oXML.onreadystatechange = leerDato;
		oXML.send(' ');
	
}
function leerDato(){
			
	if (oXML.readyState  == 4) {
					
		
		//resultado = eval('(' + oXML.responseText + ')');
		
		resultado = oXML.responseText;
		
		//alert (resultado);
		
		//alert (resultado);
		//alert (resultado.length);
			
		if(resultado != 0){
			
			alert("RADICADO YA EXISTE, NO ES POSIBLE SU REGISTRO");
			
			$("#radicadox").val('');
			
			//PARA ELIMINAR TODA LA TABLA, POR AHORA NO SE USA PARA QUE EL USUARIO NO TENGA QUE VOLVER
			//A METER TODAS LAS PARTES SI CONSTRUYE UN RADICADO QUE YA EXISTA
			//Eliminar_Tabla();
			
		}
		else{
			
			//alert("Radicado no existe");
			//$("#radicadox").val(resultado);
			//document.getElementById('radicadox').value = resultado;
			

		}
		
	}
}

function Traer_Datos_Partes(idvalor){
	
	
	$.get("funciones/traer_datos_parte.php?idvalor="+idvalor, function(cadena){
																	   
		var vector_datos = cadena.split("//////");
			
		$("#nombre").val(vector_datos[1]);
		$("#telefono").val(vector_datos[2]);
		$("#direccion").val(vector_datos[3]);
			
		$("#departamento").val(vector_datos[4]);
		
		//ENVIO EL id QUE SE TRAE DE traer_datos_parte.php Y ES ASIGNADO A vector_datos[0]
		//PARA SER ENVIADO A traer_datos_lista.php Y CAPTURAR idmunicipio Y QUE AL CARGAR LA LISTA
		//DE MUNICIPIOS EL SISTEMA IDENTIFIQUE CUAL MUNICIPIO ES EL QUE SE DEBE IDENTIFICAR EN LA LISTA.
		$("#municipio").load('funciones/traer_datos_lista.php?id='+vector_datos[4]+"&idsql="+3+"&idparte="+vector_datos[0]);
		
	 
	});
	
}

function Traer_Datos_Proceso(idvalor){
	
	//alert(idvalor);
	
	$.get("funciones/traer_datos_proceso_2.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
	
		//alert(cadena);
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length == 5){
			
			//CAMPO OCULTO CON EL ID DEL RADICADO
			$("#idradicado").val(vector_datos[0]);
			
			$("#juzgadox").val(vector_datos[2]);
			$("#claseprocesox").val(vector_datos[3]);
			
			//alert(datos[1]);
			Adicionar_Parte_Tabla(datos[1]);
			
			//CARGAR ID JUZGADO PARA CARGAR LISTA DE AUTO A NOTIFICAR, EN LA PARTE CUANDO SE CREA UNA PARTE Y ES DEMANDADO
			$("#juzgadox2").val(vector_datos[4]);
			
		}
		else{
			
			$("#idradicado").val('');
			$("#juzgadox").val('');
			$("#claseprocesox").val('');
			
			Eliminar_Tabla();
			
			Limpiar_Campos_2();
			
			$('#partesdemandado').hide();
			
		}
		
	});

}

function Adicionar_Parte_Tabla(datostabla){
	
	        var resultado = datostabla.split("------");
		
			//alert(datostabla);
			
			Filas = resultado.length;
			//alert(Filas);
			
			var cantidad_filas;
			var TABLA      = document.getElementById('t2');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				Eliminar_Tabla();
				
				var tabla = document.getElementById('cont2').innerHTML;
					
				for (var id=0; id < Filas-1; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					//tabla+='<td>'+resultado2[2]+'</td>';
					
					//tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					//tabla+='<td>'+resultado2[5]+'</td>';
					
					//tabla+='<td>'+resultado2[6]+'</td>';
		
					tabla+='</tr></table>';
					
					document.getElementById('cont2').innerHTML=tabla;
					
				
				 }
			}
						
			if(cantidad_filas == 1){
						
				
				var tabla = document.getElementById('cont2').innerHTML;
				
		
				for (var id=0; id < Filas-1; id++){
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
			
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					//tabla+='<td>'+resultado2[2]+'</td>';
					
					//tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					//tabla+='<td>'+resultado2[5]+'</td>';
					
					//tabla+='<td>'+resultado2[6]+'</td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Traer_Datos_Notificaciones(idvalor){
	
	$.get("funciones/traer_datos_notificaciones.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length == 4){
			
			//CAMPO OCULTO CON EL ID DEL RADICADO
			$("#idradicado").val(vector_datos[0]);
			
			$("#juzgadox").val(vector_datos[2]);
			$("#claseprocesox").val(vector_datos[3]);
			
			//alert(datos[1]);
			Adicionar_Parte_Tabla_Notificaciones(datos[1]);
			
		}
		else{
			
			$("#idradicado").val('');
			$("#juzgadox").val('');
			$("#claseprocesox").val('');
			
			Eliminar_Tabla();
		}
		
	});

}

function Adicionar_Parte_Tabla_Notificaciones(datostabla){
	
	        var resultado = datostabla.split("------");
		
			//alert(datostabla);
			
			Filas = resultado.length;
			//alert(Filas);
			
			var cantidad_filas;
			var TABLA      = document.getElementById('t2');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				Eliminar_Tabla();
				
				var tabla = document.getElementById('cont2').innerHTML;
					
				for (var id=0; id < Filas-1; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[9]+'</td>';
					
					tabla+='<td>'+resultado2[10]+'</td>';
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
		
					tabla+='<td><button type=button name=generarnotificacion id=generarnotificacion onclick="Generar_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/icono_word.gif" width="30" height="30" title="GENERAR CITACION"/></button></td>';
					
					tabla+='<td><button type=button name=correccionnotificacion id=correccionnotificacion onclick="Corregir_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/modficar.JPG" width="30" height="30" title="CORREGIR CITACION"/></button></td>';
					
					tabla+='</tr></table>';
					
					document.getElementById('cont2').innerHTML=tabla;
					
				
				 }
			}
						
			if(cantidad_filas == 1){
						
				
				var tabla = document.getElementById('cont2').innerHTML;
				
		
				for (var id=0; id < Filas-1; id++){
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
			
					tabla+='<td>'+resultado2[0]+'</td>';
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					tabla+='<td>'+resultado2[8]+'</td>';
					
					tabla+='<td>'+resultado2[9]+'</td>';
					
					tabla+='<td>'+resultado2[10]+'</td>';
					
					tabla+='<td>'+resultado2[11]+'</td>';
					
					tabla+='<td>'+resultado2[12]+'</td>';
					
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					
					
					tabla+='<td><button type=button name=generarnotificacion id=generarnotificacion onclick="Generar_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/icono_word.gif" width="30" height="30" title="GENERAR CITACION"/></button></td>';
					
					tabla+='<td><button type=button name=correccionnotificacion id=correccionnotificacion onclick="Corregir_Notificacion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/modficar.JPG" width="30" height="30" title="CORREGIR CITACION"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Generar_Notificacion(idfila){

	//alert(idfila);
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	var dx2  = document.getElementById("t2").rows[idfila].cells[1].innerText;
	var dx3  = document.getElementById("t2").rows[idfila].cells[2].innerText;
	var dx4  = document.getElementById("t2").rows[idfila].cells[3].innerText;
	var dx5  = document.getElementById("t2").rows[idfila].cells[4].innerText;
	var dx6  = document.getElementById("t2").rows[idfila].cells[5].innerText;
	var dx7  = document.getElementById("t2").rows[idfila].cells[6].innerText;
	var dx8  = document.getElementById("t2").rows[idfila].cells[7].innerText;
	
	//SE REALIZA ESTA OPERACION YA QUE SI SE ENVIA YA QUE EL CAMPO DIRECCION TRAE EL CARACTER #
	//AL GENERAR EL REPORTE EN WORD SE PRESENTA UNA INCOSISTENCIA
	//EJEMPLO CR 21 # 46 A 82 SALE CR 21 SOLAMENTE, AFECTANDO LOS DATOS QUE SIGUEN DESPUES DE ESTA CARGA. 
	var dx9  = document.getElementById("t2").rows[idfila].cells[8].innerText;
	dx9      = reemplazarCadena("#", "NUM", dx9);
	
	var dx10 = document.getElementById("t2").rows[idfila].cells[9].innerText;
	var dx11 = document.getElementById("t2").rows[idfila].cells[10].innerText;
	var dx12 = document.getElementById("t2").rows[idfila].cells[11].innerText;
	var dx13 = $("#claseprocesox").val();
	
	var datosx = dx1+"//////"+dx2+"//////"+dx3+"//////"+dx4+"//////"+dx5+"//////"+dx6+"//////"+dx7+"//////"+dx8+"//////"+dx9+"//////"+dx10+"//////"+dx11+"//////"+dx12+"//////"+dx13;
	
	//alert(datosx);
	
	location.href="index.php?controller=signot&action=GenerarNotificacionDemandado&opcion=1&datosx="+datosx;
	
}

function Corregir_Notificacion(idfila){
	
	//SE OBTIENE EL VALOR DE CADA CELDA DE LA FILA ESPECIFICA
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	
	location.href="index.php?controller=signot&action=Corregir_Notificacion&dx1="+dx1;

}

function Traer_Datos_Proceso_2(idvalor){
	
	//alert(idvalor);
	
	$.get("funciones/traer_datos_proceso_2.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
	
		//alert(cadena);
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length == 6){
			
			//alert("existe");
			
			//CAMPO OCULTO CON EL ID DEL RADICADO
			$("#idradicado").val(vector_datos[0]);
			
			document.getElementById('year').selectedIndex = 0;
			$('#year').show();
			
			$("#consecutivo").val('');
			$('#consecutivo').show();
			
			document.getElementById('instancia').selectedIndex = 0;
			$('#instancia').show();
			
			//document.getElementById('juzgadoorigen').selectedIndex = 0;
			$('#juzgadoorigen').val(vector_datos[4]);
			$('#juzgadoorigen').show();
			
			$("#radicadox").val('');
			$('#radicadox').show();
			
			document.getElementById('claseproceso').selectedIndex = 0;
			$('#claseproceso').show();
			
			
		}
		else{
			
			//alert("no existe");
			
			$("#idradicado").val('');
			
			document.getElementById('year').selectedIndex = 0;
			$('#year').hide();
			
			$("#consecutivo").val('');
			$('#consecutivo').hide();
			
			document.getElementById('instancia').selectedIndex = 0;
			$('#instancia').hide();
			
			document.getElementById('juzgadoorigen').selectedIndex = 0;
			$('#juzgadoorigen').hide();
			
			$("#radicadox").val('');
			$('#radicadox').hide();
			
			document.getElementById('claseproceso').selectedIndex = 0;
			$('#claseproceso').hide();
			
			
		}
		
	});

}

function Traer_Datos_Parte_Direcciones(idvalor){
	
	$.get("funciones/traer_datos_parte_direcciones.php?idvalor="+idvalor, function(cadena){
	
		var datos = cadena.split("******");
	
		//alert(cadena);
		
		var vector_datos = datos[0].split("//////");
		
		//alert (vector_datos.length);
		//alert (datos[1]);
		
		if(vector_datos.length >= 7){
			
			
			//CAMPO OCULTO CON EL ID DE PARTE
			$("#idparteproceso").val(vector_datos[0]);
			
			$("#documentox").val(vector_datos[2]);
			$("#documento2x").val(vector_datos[2]);
			$("#nombrex").val(vector_datos[3]);
			
			
			//alert(datos[1]);
			Adicionar_Parte_Tabla_Parte_Direcciones(cadena);
			
		}
		else{
			
			$("#idparteproceso").val('');
			
			$("#documento2x").val('');
			$("#nombrex").val('');
			
			Eliminar_Tabla();
		}
		
	});

}

function Adicionar_Parte_Tabla_Parte_Direcciones(datostabla){
	
	        var resultado = datostabla.split("******");
		
			//alert(datostabla);
			
			Filas = resultado.length;
			//alert(Filas);
			
			var cantidad_filas;
			var TABLA      = document.getElementById('t2');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				Eliminar_Tabla();
				
				var tabla = document.getElementById('cont2').innerHTML;
					
				for (var id=0; id < Filas-1; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
					
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					
					tabla+='</tr></table>';
					
					document.getElementById('cont2').innerHTML=tabla;
					
				
				 }
			}
						
			if(cantidad_filas == 1){
						
				
				var tabla = document.getElementById('cont2').innerHTML;
				
		
				for (var id=0; id < Filas-1; id++){
					
					resultado2 = resultado[id].split("//////");
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
			
					tabla+='<td>'+resultado2[1]+'</td>';
					
					tabla+='<td>'+resultado2[2]+'</td>';
					
					tabla+='<td>'+resultado2[3]+'</td>';
					
					tabla+='<td>'+resultado2[4]+'</td>';
					
					tabla+='<td>'+resultado2[5]+'</td>';
					
					tabla+='<td>'+resultado2[6]+'</td>';
					
					tabla+='<td>'+resultado2[7]+'</td>';
					
			
					//tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
					
					tabla+='<td><button type=button name=btdireccion id=btdireccion onclick="Modificar_Direccion(this.parentNode.parentNode.rowIndex)" style="border-style:none; background-color:#FFFFFF"><img src="views/images/direccion.png" width="40" height="40" title="MODIFICAR DIRECCION"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont2').innerHTML=tabla;
					
					
				}
				
			}
			
	
	
}

function Modificar_Direccion(idfila){

	//alert(idfila);
	
	var dx1  = document.getElementById("t2").rows[idfila].cells[0].innerText;
	
	//alert(dx1);
	
	location.href="index.php?controller=signot&action=Modificar_Direccion&dx1="+dx1;

}

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t2');
			
	cantidad_filas = TABLA.rows.length;
				
	for (r=1; r<cantidad_filas; r++){
		
		TABLA.deleteRow(r);
		cantidad_filas=TABLA.rows.length;
		r=1
	}
	
	if(cantidad_filas>1){
		TABLA.deleteRow(1);
	}
	
}


//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla_Memoriales(){
	
	var r;
	var cantidad_filas;
	//var TABLA = document.getElementById('tmemoriales');
	var TABLA = document.getElementById('t2');
			
	cantidad_filas = TABLA.rows.length;
				
	for (r=1; r<cantidad_filas; r++){
		
		TABLA.deleteRow(r);
		cantidad_filas=TABLA.rows.length;
		r=1
	}
	
	if(cantidad_filas>1){
		TABLA.deleteRow(1);
	}
	
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


