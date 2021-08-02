$(function(){
	
	//ME PERMITE CARGAR UNA VENTANA Y MOSTRAR GRAFICA
	$(".grafica").click(function(){
	
		window.open("Graficas/Grafica_Titulos_Materializados.php","GRAFICA","width=600,height=400,scrollbars=YES");
		
	});


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
				var d2  = $(this).find("td").eq(2).html();
			
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d2;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
					
	
				}
		
			});
				
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla de ADICIONAR TITULOS EN CUSTODIA");
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
			
			var idradicado     = $('#idradicado').val();
			var radicado       = $('#radicado').val();
			
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			/*var idclasejuzgado = radicadox.substring(5, 9);
			var iddepartamento = radicadox.substring(0, 2);
			var idmunicipio    = radicadox.substring(0, 5);*/
			
			//**********************************************************************************************************
			var dataString = 'idradicado='+idradicado+'&radicado='+$('#radicado').val()+'&datospartes='+$('#datospartes').val();
			var url1       = "index.php?controller=archivo&action=Titulos_Encustodia";
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
		validator.resetForm();
	});		
	
	//PARA LAS FECHAS
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	
	
	//FILTRAR TABLA REGISTRO
	$('.filtrar').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('idds').value.length           == 0 &&
			document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('listaestado').value.length    == 0 &&
			document.getElementById('radicadox').value.length      == 0){
			
			dato_0 = 3;
			
			location.href="index.php?controller=archivo&action=RecargarTabla&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
		
			datox1 = document.getElementById('idds').value;
			datox2 = document.getElementById('listaestado').value;
			datox3 = document.getElementById('radicadox').value;
			
			//alert(datox2);
	
			location.href="index.php?controller=archivo&action=FiltroTabla&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3;
	
		}
	
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
			document.getElementById('listaestado').value.length    == 0 &&
			document.getElementById('radicadox').value.length      == 0){
			
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 1;//sin filtro
			
			location.href="index.php?controller=archivo&action=GenerarTituloExcel&opcion="+dato_0+"&tfiltro="+tfiltro;
       	
		}
		else{
		
			dato_0  = 1;//para saber que es el reporte 1
			tfiltro = 2;//con filtro
			
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
		
			datox1 = document.getElementById('idds').value;
			datox2 = document.getElementById('listaestado').value;
			datox3 = document.getElementById('radicadox').value;
			
			//alert(datox2);
	
			location.href="index.php?controller=archivo&action=GenerarTituloExcel&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&tfiltro="+tfiltro;
	
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
	
	
	
	
	//**************CUANDO SE REGISTRA CORRESPONDENCIA QUE NO VA ASOCIADA A NINGUN RADICADO***********************************
	
	$("#fechasri").datepicker({ changeFirstDay: false	});
	$("#fechasrf").datepicker({ changeFirstDay: false	});
	$("#fechasre").datepicker({ changeFirstDay: false	});
	$("#fechasrei_2").datepicker({ changeFirstDay: false	});
	$("#fechasref_2").datepicker({ changeFirstDay: false	});
	
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar_2b").click(function() {
		location.href="index.php?controller=archivo&action=Correspondencia_Sin_Radicado";
	});		
	
	
	$(".btn_validar_2").click(function() {
		
		var cantidad_filas_2;
	    var TABLA_2      = document.getElementById('t_c');
		cantidad_filas_2 = TABLA_2.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		
		if(cantidad_filas_2 > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezados = 0;
			
			var datospartes="";
		
			$('#t_c tr').each(function () {
	
				var d0  = $(this).find("td").eq(0).html();
				var d1  = $(this).find("td").eq(1).html();
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(3).html();
				var d4  = $(this).find("td").eq(4).html();
				var d5  = $(this).find("td").eq(5).html();
			
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes_c").val('');
					$("#datospartes_c").val(datospartes);
					
	
				}
		
			});
				
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la TABLA CORRESPONDENCIA");
			return false;
		}
		
	});	
			
			
			
	$("#frm_C").validate({
						 
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
            
			var fechasr     = $('#fechasr').val();
	

			//**********************************************************************************************************
			var dataString = 'fechasr='+fechasr+'&datospartes='+$('#datospartes_c').val();
			var url1       = "index.php?controller=archivo&action=Correspondencia_Sin_Radicado";
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
	
	
	$(".marcar").click(function(evento){
		$("input:checkbox").attr('checked', true);
								 
	});
	
	$(".desmarcar").click(function(evento){
		$("input:checkbox").attr('checked', false);
								 
	});
	
	
	$(".cargar_info_corres").click(function(){
											
			
		var idcorres            = $(this).attr('data-idcorres');
			
		var data_tipodocumento  = $(this).attr('data-tipodocumento');
		var data_juzgadodestino = $(this).attr('data-juzgadodestino');
		var data_solicitud      = $(this).attr('data-solicitud');
		var data_peticionaro    = $(this).attr('data-peticionaro');
		var data_folios         = $(this).attr('data-folios');
		var data_obs            = $(this).attr('data-obs');
		
		var data_fechaentrega   = $(this).attr('data-fechaentrega');
		
		
		$('#idcoresp').val(idcorres); 
		
		$('#listasr1').val(data_tipodocumento); 
		$('#listasr2').val(data_juzgadodestino); 
		$('#listasr3').val(data_solicitud); 
		$('#peticionariosr').val(data_peticionaro); 
		$('#foliossr').val(data_folios); 
		$('#observacionsr').val(data_obs); 
		
		$('#fechasre').val(data_fechaentrega);
			
		
	});
	
	$(".editar_info_corres").click(function(){
											
			
		var idcorres            = $(this).attr('data-idcorres');
			
		//alert("EDITANDO: "+idcorres);
		
		var validarcampos = Validar_Campos_Agregar_C(1);
	
		if(validarcampos == 1){
			
			validarcampos = 1;
		}
		else{
			
			var d1_c = $('#listasr1').val(); 
			var d2_c = $('#listasr2').val(); 
			var d3_c = $('#listasr3').val(); 
			var d4_c = $('#peticionariosr').val(); 
			var d5_c = $('#foliossr').val(); 
			var d6_c = $('#observacionsr').val();
			var d7_c = $('#fechasre').val();
			
			if( idcorres == $('#idcoresp').val() ){
			
				if( confirm("ESTA SEGURO DE REALIZAR EL PROCESO, VA A EDITAR LA CORRESPONDENCIA CON ID: "+idcorres) ) {
			
			
					location.href="index.php?controller=archivo&action=Correspondencia_Editar_Radicado&d1_c="+d1_c+"&d2_c="+d2_c+"&d3_c="+d3_c+"&d4_c="+d4_c+"&d5_c="+d5_c+"&d6_c="+d6_c+"&d7_c="+d7_c+"&idcorres="+idcorres;
				}
			}
			else{
				
				alert("NO ES POSIBLE EDITAR CORRESPONDENCIA, EL ID DE LA CORRESPONDENCIA CARGADA NO ES EL MISMO DE LA CORRESPONDENCIA QUE SE DESA EDITAR, ID CARGADO: "+$('#idcoresp').val()+" / ID SELECCIOANDO: "+idcorres);
			}
		
			
		}
			
		
		
	});
	
	/*$(".buscarxfiltro").click(function(){
								
		
		if( 
			
		   $('#listasr1').val().length       == 0 && 
		   $('#listasr2').val().length       == 0 &&
		   $('#listasr3').val().length       == 0 && 
		   $('#peticionariosr').val().length == 0 &&
		   $('#foliossr').val().length       == 0 && 
		   $('#observacionsr').val().length  == 0 && 
		   $('#fechasri').val().length       == 0 &&
		   $('#fechasrf').val().length       == 0 &&
		   $('#fechasrei_2').val().length    == 0 &&
		   $('#fechasref_2').val().length    == 0 
		   
		   

		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('listasr1').style.borderColor       = '#FF0000';
			document.getElementById('listasr2').style.borderColor       =  '#FF0000';
			document.getElementById('listasr3').style.borderColor       = '#FF0000';
			document.getElementById('peticionariosr').style.borderColor =  '#FF0000';
			document.getElementById('foliossr').style.borderColor       = '#FF0000';
			document.getElementById('observacionsr').style.borderColor  = '#FF0000';
			document.getElementById('fechasri').style.borderColor       = '#FF0000';
			document.getElementById('fechasrf').style.borderColor       = '#FF0000';
			document.getElementById('fechasrei_2').style.borderColor    = '#FF0000';
			document.getElementById('fechasref_2').style.borderColor    = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri').val(); 
		    dato_2 = $('#fechasrf').val();
			
			//FECHA ENTREGA
			dato_3 = $('#fechasrei_2').val(); 
			dato_4 = $('#fechasref_2').val();
			
		
		    datox1 = $('#listasr1').val();
		    datox2 = $('#listasr2').val();
			datox3 = $('#listasr3').val();
			datox4 = $('#peticionariosr').val();
			datox5 = $('#foliossr').val();
			datox6 = $('#observacionsr').val();
			
			
		
			location.href="index.php?controller=archivo&action=Busquedad_Filtro_Correspondencia&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
			

			
		}
		
	});*/
	
	
	
	$(".buscarxfiltro").click(function(){
		

			   
		if( 
			
		   $('#listasr1').val().length       == 0 && 
		   $('#listasr2').val().length       == 0 &&
		   $('#listasr3').val().length       == 0 && 
		   $('#peticionariosr').val().length == 0 &&
		   $('#foliossr').val().length       == 0 && 
		   $('#observacionsr').val().length  == 0 && 
		   $('#fechasri').val().length       == 0 &&
		   $('#fechasrf').val().length       == 0 &&
		   $('#fechasrei_2').val().length    == 0 &&
		   $('#fechasref_2').val().length    == 0 &&
		   $('#fechasrdi_2').val().length    == 0 &&
		   $('#fechasrdf_2').val().length    == 0 
		   
		   

		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('listasr1').style.borderColor       = '#FF0000';
			document.getElementById('listasr2').style.borderColor       =  '#FF0000';
			document.getElementById('listasr3').style.borderColor       = '#FF0000';
			document.getElementById('peticionariosr').style.borderColor =  '#FF0000';
			document.getElementById('foliossr').style.borderColor       = '#FF0000';
			document.getElementById('observacionsr').style.borderColor  = '#FF0000';
			document.getElementById('fechasri').style.borderColor       = '#FF0000';
			document.getElementById('fechasrf').style.borderColor       = '#FF0000';
			document.getElementById('fechasrei_2').style.borderColor    = '#FF0000';
			document.getElementById('fechasref_2').style.borderColor    = '#FF0000';
			document.getElementById('fechasrdi_2').style.borderColor    = '#FF0000';
			document.getElementById('fechasrdf_2').style.borderColor    = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri').val(); 
		    dato_2 = $('#fechasrf').val();
			
			//FECHA ENTREGA
			dato_3 = $('#fechasrei_2').val(); 
			dato_4 = $('#fechasref_2').val();
			
			//FECHA DEVOLUCION
			dato_5 = $('#fechasrdi_2').val(); 
			dato_6 = $('#fechasrdf_2').val();
			
		
		    datox1 = $('#listasr1').val();
		    datox2 = $('#listasr2').val();
			datox3 = $('#listasr3').val();
			datox4 = $('#peticionariosr').val();
			datox5 = $('#foliossr').val();
			datox6 = $('#observacionsr').val();
			
			
		
			//location.href="index.php?controller=archivo&action=Busquedad_Filtro_Correspondencia&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
			
			
			//-------------RECARGAR BUSQUEDAD-------------------------
			//BORA LOS REGISTROS DE LA TABLA, ARRANCA EN UNO PARA NO TENER ENCENTA LOS 
			//ENCABEZADOS
			//$('#tbuscarxfiltro tbody').remove();
			
			var r;
			var cantidad_filas;
			var TABLA = document.getElementById('tbuscarxfiltro');
					
			cantidad_filas = TABLA.rows.length;
			
			for (r=1; r<cantidad_filas; r++){
					
				TABLA.deleteRow(r);
				cantidad_filas=TABLA.rows.length;
				r=1;
			}
				
			if(cantidad_filas>1){
				TABLA.deleteRow(1);
			}
			//-------------FIN RECARGAR BUSQUEDAD------------------------
			
			var registro;
		
			/* OBTENEMOS TABLA */
			$.ajax({
				type: "GET",
				url: "views/popupbox/editinplace_3.php?tabla=1",
				data: { dato_1: dato_1, dato_2: dato_2, dato_3: dato_3, dato_4: dato_4, dato_5: dato_5, dato_6: dato_6, datox1: datox1, datox2: datox2, datox3: datox3, datox4: datox4, datox5: datox5, datox6: datox6 }
			})
			.done(function(json) {
				json = $.parseJSON(json)
				for(var i=0;i<json.length;i++)
				{
								
					/*$('.editinplace').append(
						"<tr><td class='id'>"+json[i].id+"</td><td class='fecha_registro'>"+json[i].fecha_registro+"</td><td class='editable' data-campo='peticionario' data-tipocampo=1><span>"+json[i].peticionario+"</span></td><td class='editable' data-campo='tipo_documento' data-tipocampo=4 data-idlista=1><span>"+json[i].tipo_documento+"</span></td><td class='editable' data-campo='folios' data-tipocampo=1><span>"+json[i].folios+"</span></td><td class='editable' data-campo='fecha_entrega' data-tipocampo=2><span>"+json[i].fecha_entrega+"</span></td><td class='editable' data-campo='fecha_devolucion' data-tipocampo=2><span>"+json[i].fecha_devolucion+"</span></td><td class='editable' data-campo='idjuzgadodestino' data-tipocampo=4 data-idlista=2><span>"+json[i].jusgadodestino+"</span></td><td class='editable' data-campo='idsolicitud' data-tipocampo=4 data-idlista=3><span>"+json[i].solicitud+"</span></td><td class='empleado'>"+json[i].empleado+"</td><td class='editable' data-campo='observacionesm' data-tipocampo=3><span>"+json[i].observacionesm+"</span></td></tr>");*/
					
					
					
					registro+="<tr>"
					
						registro+="<td class='id'>"+json[i].id+"</td>"
						registro+="<td class='fecha_registro'>"+json[i].fecha_registro+"</td>"
						registro+="<td class='editable' data-campo='peticionario' data-tipocampo=1><span>"+json[i].peticionario+"</span></td>"
						registro+="<td class='editable' data-campo='tipo_documento' data-tipocampo=4 data-idlista=1><span>"+json[i].tipo_documento+"</span></td>"
						registro+="<td class='editable' data-campo='folios' data-tipocampo=1><span>"+json[i].folios+"</span></td>"
						registro+="<td class='editable' data-campo='fecha_entrega' data-tipocampo=2><span>"+json[i].fecha_entrega+"</span></td>"
						registro+="<td class='editable' data-campo='fecha_devolucion' data-tipocampo=2><span>"+json[i].fecha_devolucion+"</span></td>"
						registro+="<td class='editable' data-campo='idjuzgadodestino' data-tipocampo=4 data-idlista=2><span>"+json[i].jusgadodestino+"</span></td>"
						registro+="<td class='editable' data-campo='idsolicitud' data-tipocampo=4 data-idlista=3><span>"+json[i].solicitud+"</span></td>"
						registro+="<td class='empleado'>"+json[i].empleado+"</td>"
						registro+="<td class='editable' data-campo='observacionesm' data-tipocampo=3><span>"+json[i].observacionesm+"</span></td>"
						
						if(json[i].ruta_local == null){
						
							registro+="<td>"+"-"+"</td>"
						
						}
						else{
						
							registro+="<td class='ruta_local'><a href="+ json[i].ruta_local +" title="+ json[i].ruta_local +" target='_blank'><img src='views/images/pdf-icono.png' width='35' height='35'/></a></td>"
						}
							
					registro+="</tr>"
						
						
					$('.editinplace').append(registro);
					
					registro = "";
					
					
					
					
				}
			});
			/*------------------- */
	
		}
		
		
	});			
						
			/* FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
			var td,campo,valor,id;
			var tipocampo   = 0;
			var idlista     = 0
			
			
			$(document).on("click","td.editable span",function(e)
			{
			
				
				
				e.preventDefault();
				$("td:not(.id)").removeClass("editable");
				td        = $(this).closest("td");
				campo     = $(this).closest("td").data("campo");
				tipocampo = $(this).closest("td").data("tipocampo");
				//alert(campo);
				idlista   = $(this).closest("td").data("idlista");
				
				valor     = $(this).text();
				id        = $(this).closest("tr").find(".id").text();
				//alert(id);
				

				//CAMPO DE TEXTO
				if(tipocampo == 1){
								
					td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
								
				}
								
				//CAMPO FECHA
				if(tipocampo == 2){
									
					td.text("").html("<input type='text' id='"+campo+"' name='"+campo+"' value='"+valor+"' readonly='true'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
					
					$("#fecha_entrega").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
					$("#fecha_devolucion").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				}
								
				//CAMPO DE TEXTAREA
				if(tipocampo == 3){
								
					td.text("").html("<textarea name='"+campo+"' cols='45' rows='5'>"+valor+"</textarea><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
								
				}
								
				//CAMPO DE SELECT 
				if(tipocampo == 4){
					
					
					 //RECORRER UN SELECT CON JQUERY		
					 /*var concatValor = '';
					 $("#listasr1 option").each(function(){
						if ($(this).val() != "" ){        
						 concatValor += $(this).val()+' - '+$(this).text()+'\n';
						}
					 });
					 alert(concatValor);*/
					
					//FORMA ORIGINAL Y ESTATICA
					//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
					
					//FORMA DINAMICA
					var lista = "";
					
					if(idlista == 1){
						
						lista+="<select name='"+campo+"' id='"+campo+"'>";
						lista+="<option value='' selected='selected'>Seleccionar Tipo Documento</option>";
						
						
						 $("#listasr1 option").each(function(){
							
							if ($(this).val() != "" ){        
							 
								lista+="<option value="+$(this).val()+">"+$(this).val()+"</option>";
							}
						 });
						 
						
						lista+="</select>";
						lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
						td.text("").html(lista);
					}
					
					if(idlista == 2){
						
						lista+="<select name='"+campo+"' id='"+campo+"'>";
						lista+="<option value='' selected='selected'>Seleccionar Juzgado Destino</option>";
						
						
						 $("#listasr2 option").each(function(){
							
							if ($(this).val() != "" ){        
							 
								lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
							}
						 });
						 
						
						lista+="</select>";
						lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
						td.text("").html(lista);
					}
					
					if(idlista == 3){
						
						lista+="<select name='"+campo+"' id='"+campo+"'>";
						lista+="<option value='' selected='selected'>Seleccionar Tipo Solicitud</option>";
						
						
						 $("#listasr3 option").each(function(){
							
							if ($(this).val() != "" ){        
							 
								lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
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
							
				if(nuevovalor.trim()!="")
				{
					
					
					//alert("ID: "+id);
					
					
					$.ajax({
						type: "POST",
						url: "views/popupbox/editinplace_3.php",
						data: { campo: campo, valor: nuevovalor, id:id }
					})
					.done(function( msg ) {
						$(".mensaje").html(msg);
						td.html("<span>"+nuevovalor+"</span>");
						$("td:not(.id)").addClass("editable");
						
						//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
						//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
						$(document).off('click');
						
						setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
						
						//location.href="index.php?controller=archivo&action=edit_archivoOtro&nombre="+valor_id_radicado;
			
						//$(".buscarxfiltro").click();
						
				
					});
					
					
				
					
				}
				else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
				
				
			});
	
	
	
	$(".generar_correspondencia").click(function(){
								
		
		if( 
			
		   $('#listasr1').val().length       == 0 && 
		   $('#listasr2').val().length       == 0 &&
		   $('#listasr3').val().length       == 0 && 
		   $('#peticionariosr').val().length == 0 &&
		   $('#foliossr').val().length       == 0 && 
		   $('#observacionsr').val().length  == 0 && 
		   $('#fechasri').val().length       == 0 &&
		   $('#fechasrf').val().length       == 0 &&
		   $('#fechasrei_2').val().length    == 0 &&
		   $('#fechasref_2').val().length    == 0 
		   
		   

		   
		) {
			
			alert("Definir Algun Filtro Para Generar la Correspondencia");
	
			document.getElementById('listasr1').style.borderColor       = '#FF0000';
			document.getElementById('listasr2').style.borderColor       =  '#FF0000';
			document.getElementById('listasr3').style.borderColor       = '#FF0000';
			document.getElementById('peticionariosr').style.borderColor =  '#FF0000';
			document.getElementById('foliossr').style.borderColor       = '#FF0000';
			document.getElementById('observacionsr').style.borderColor  = '#FF0000';
			document.getElementById('fechasri').style.borderColor       = '#FF0000';
			document.getElementById('fechasrf').style.borderColor       = '#FF0000';
			document.getElementById('fechasrei_2').style.borderColor    = '#FF0000';
			document.getElementById('fechasref_2').style.borderColor    = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 1000;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri').val(); 
		    dato_2 = $('#fechasrf').val();
			
			//FECHA ENTREGA
			dato_3 = $('#fechasrei_2').val(); 
			dato_4 = $('#fechasref_2').val(); 
		
		    datox1 = $('#listasr1').val();
		    datox2 = $('#listasr2').val();
			datox3 = $('#listasr3').val();
			datox4 = $('#peticionariosr').val();
			datox5 = $('#foliossr').val();
			datox6 = $('#observacionsr').val();
			
			
			//alert("GENERANDO");
		
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
			

			
		}
		
	});
	
	
	
	//---------------------------------------------------------------------------
	
	//********************************************************************************************
						//PARA EL MANEJO DE 110 NASIVO
	//********************************************************************************************
	
	$("#fecha110m").datepicker({ changeFirstDay: false	});
	
	$("#fechasri_m").datepicker({ changeFirstDay: false	});
	$("#fechasrf_m").datepicker({ changeFirstDay: false	});
	$("#fechaTRASI").datepicker({ changeFirstDay: false	});
	$("#fechaTRASF").datepicker({ changeFirstDay: false	});
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar_3b").click(function() {
		location.href="index.php?controller=archivo&action=Ciento_Diez_Masivo";
	});
	
	
	$(".btn_validar_3M").click(function() {
		
		var cantidad_filas_2M;
	    var TABLA_2M      = document.getElementById('t_m');
		cantidad_filas_2M = TABLA_2M.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		
		if(cantidad_filas_2M > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezadosM = 0;
			
			var datospartesM        = " ";
		
			$('#t_m tr').each(function () {
	
				//var d0M  = $(this).find("td").eq(0).html();
				var d1M  = $(this).find("td").eq(0).html();
				var d2M  = $(this).find("td").eq(1).html();
		
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezadosM == 0){
					controlemcabezadosM = controlemcabezadosM + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					//datospartesM = datospartesM+"******"+d0M+"//////"+d1M+"//////"+d2M;
					
					datospartesM = datospartesM+"******"+d1M+"//////"+d2M;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes_m").val('');
					$("#datospartes_m").val(datospartesM);
					
	
				}
		
			});
				
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la TABLA PROCESOS");
			return false;
		}
		
		//alert($("#datospartes_m").val());
		
	});	
	
	
	$("#frm_M").validate({
						 
        rules: {
            
			radicado110m: { required: true, minlength: 23, maxlength: 23},
			
			fecha110m   : { required: true, minlength: 10, maxlength: 10},
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
            
			var fechasr110  = $('#fechasr110').val();
			
			//alert($('#fechas_m').val());
		
			//**********************************************************************************************************
			var dataString = 'fechasr110='+fechasr110+'&datospartes='+$('#datospartes_m').val()+'&fechas_tras='+$('#fechas_m').val();
			var url1       = "index.php?controller=archivo&action=Ciento_Diez_Masivo";
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
	
	
	
	$(".buscarxfiltro_TRAS110").click(function(){
								
		
		
		if( 
			
		   $('#fechasri_m').val().length   == 0 && 
		   $('#fechasrf_m').val().length   == 0 &&
		   $('#fechaTRASI').val().length   == 0 && 
		   $('#fechaTRASF').val().length   == 0 &&
		   $('#radicado110m').val().length == 0 
		  
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('radicado110m').style.borderColor = '#FF0000';
			document.getElementById('fechasri_m').style.borderColor   = '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor   =  '#FF0000';
			document.getElementById('fechaTRASI').style.borderColor   = '#FF0000';
			document.getElementById('fechaTRASF').style.borderColor   =  '#FF0000';
			
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
			//FECHAS FIJACION
			dato_3 = $('#fechaTRASI').val(); 
		    dato_4 = $('#fechaTRASF').val();
			
			//RADICADO
		    datox1 = $('#radicado110m').val();
		    
			
		
			location.href="index.php?controller=archivo&action=Busquedad_Filtro_TRAS_110&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1;
			

			
		}
		
	});
	
	
	
	//ME PERMITE GENERAR DOCUMENTO ESPECIFICADO DEL TRASLADO 110
	$(".generar_TRAS110").click(function(){
	

		
		var id       = $(this).attr('data-id');
		var radicado = $(this).attr('data-radicado');
		var fechat   = $(this).attr('data-tras110');
		
		//alert(radicado);
		
		/*if (document.frm.fechaj.value.length == 0){
		
			alert("Definir Fecha Fijacion");
			document.getElementById('fechaj').style.borderColor='#FF0000';
			
		}
		else{*/
		
		
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			//alert(fechafijacion);
			
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
				
				//location.href="index.php?controller=archivo&action=Registrar_Traslado108&fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat;
				
				window.open("views/PHPPdf/Reporte_Traslado110.php?fechainicial="+fii+"&fechafinal="+fff+"&id="+id+"&radicado="+radicado+"&fechafijacion="+fechat);
				
	
			});

	
		/*}*/
		

	});
	
	$(".generar_TRAS110_COMPLETO").click(function(){
								
		
		var cantidad_filas_2M110;
	    var TABLA_2M110      = document.getElementById('ttras110');
		cantidad_filas_2M110 = TABLA_2M110.rows.length;
		
		var Ct110 = 1;
		
		if(cantidad_filas_2M110 > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezadosM110 = 0;
			
			var datospartesM110        = " ";
		
			$('#ttras110 tr').each(function () {
	
	
				var d1M110  = $(this).find("td").eq(1).html();//RADICADO
				var d2M110  = $(this).find("td").eq(2).html();//IDRAD
				var d4M110  = $(this).find("td").eq(4).html();//FECHA FIJACION
				var d5M110  = $(this).find("td").eq(5).html();//FECHA INICIAL
				var d6M110  = $(this).find("td").eq(6).html();//FECHA FINAL
		
			
				if(controlemcabezadosM110 == 0){
					controlemcabezadosM110 = controlemcabezadosM110 + 1;
				}
				else{
					
					if($("#chk"+Ct110).is(':checked')) {
		
						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						datospartesM110 = datospartesM110+"******"+d1M110+"//////"+d2M110+"//////"+d4M110+"//////"+d5M110+"//////"+d6M110;
						
						//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
						$("#datospartes_m110").val('');
						$("#datospartes_m110").val(datospartesM110);
					}
					
					Ct110 = Ct110 + 1;
					

				}
		
			});
				
			
			//alert($("#datospartes_m110").val());
			
			//CON LIBRERIA PHPPdf
			//window.open("views/PHPPdf/Reporte_Traslado110_completo.php?datospartes_m110="+$("#datospartes_m110").val());
			
			//CON LIBRERIA tcpdf
			window.open("views/tcpdf/GENERAR_TRASLADO_110_COMPLETO.php?datospartes_m110="+$("#datospartes_m110").val());
			
		}
		else{
			
			
			
			
			alert("No es Posible Realizar Traslado 110 Completo, no se Cuenta con Informacion en la TABLA(ID,RADICADO,FECHA REGISTRO,FECHA FIJACION,OBSERVACIONES)");
			return false;
		}
		
		
		
		
		
		
	});
	
	
	//SE CAMBIA .attr POR .prop
	//YA QUE LA VERSION jquery_NV.js ES MAS RECIENTE
	//Y SOLO RECONOCE POR PRIMERA VEZ .attr
	$(".marcar_110").click(function(evento){
		$("input:checkbox").prop('checked', true);
								 
	});
	
	$(".desmarcar_110").click(function(evento){
		$("input:checkbox").prop('checked', false);
		 
	});

	
	//********************************************************************************************
						//FIN PARA EL MANEJO DE 110 NASIVO
	//********************************************************************************************
	
	
	
	//********************************************************************************************
						//PARA EL MANEJO DE REGISTRO ACCIONES
	//********************************************************************************************
	
	
	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar_ra").click(function() {
		location.href="index.php?controller=archivo&action=Adicionar_Accion_2";
	});
	
	
	$(".btn_validar_RA").click(function() {
		
		var cantidad_filas_2RA;
	    var TABLA_2RA      = document.getElementById('t_ra');
		cantidad_filas_2RA = TABLA_2RA.rows.length;
		
		//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
		
		if(cantidad_filas_2RA > 1){
			
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO
			var controlemcabezadosRA = 0;
			
			var datospartesRA        = " ";
		
			$('#t_ra tr').each(function () {
	
				var d0RA  = $(this).find("td").eq(0).html();
				var d1RA  = $(this).find("td").eq(1).html();
				var d2RA  = $(this).find("td").eq(2).html();
				var d3RA  = $(this).find("td").eq(3).html();
				var d4RA  = $(this).find("td").eq(4).html();
				var d5RA  = $(this).find("td").eq(5).html();
				var d6RA  = $(this).find("td").eq(6).html();
				var d7RA  = $(this).find("td").eq(7).html();
		
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezadosRA == 0){
					controlemcabezadosRA = controlemcabezadosRA + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					//datospartesM = datospartesM+"******"+d0M+"//////"+d1M+"//////"+d2M;
					
					datospartesRA = datospartesRA+"******"+d0RA+"//////"+d1RA+"//////"+d2RA+"//////"+d3RA+"//////"+d4RA+"//////"+d5RA+"//////"+d6RA+"//////"+d7RA;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes_RA").val('');
					$("#datospartes_RA").val(datospartesRA);
					
	
				}
		
			});
				
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la TABLA ACCIONES");
			return false;
		}
		
		//alert($("#datospartes_m").val());
		
	});	
			
			
			
	$("#frm_RA").validate({
						 
        rules: {
            
			//radicado110m: { required: true, minlength: 23, maxlength: 23},
			
			//fecha110m   : { required: true, minlength: 10, maxlength: 10},
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
            
			//var fechasr110  = $('#fechasr110').val();
			
			//alert($('#datospartes_RA').val());
		
			//**********************************************************************************************************
			//var dataString = 'fechasr110='+fechasr110+'&datospartes='+$('#datospartes_m').val()+'&fechas_tras='+$('#fechas_m').val();
			var dataString = 'datospartes='+$('#datospartes_RA').val();
			var url1       = "index.php?controller=archivo&action=Adicionar_Accion_2";
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
	
	
	//********************************************************************************************
						//FIN PARA EL MANEJO DE REGISTRO ACCIONES
	//********************************************************************************************
	
	

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

function Adicionar_Parte(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existeradicado = Validar_Radicado_Tabla();
	
	//existeradicado = 0;
	
	existenumtitulo = Existe_Numero_Titulo();
	
	if(existenumtitulo == 1){
		
		existenumtitulo = 1;
		alert("Ya EXiste ese Numero Titulo en la Tabla no es posible su Adicion");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos = Validar_Campos_Agregar(idaccion);
	
	//validarcampos = 0;
	
	if(validarcampos == 1){
		
		validarcampos = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1 = document.getElementById('numerotitulo').value;
			var dato2 = document.getElementById('numerotitulo2').value;
			var dato3 = document.getElementById('valortitulo').value;
			var dato4 = document.getElementById('adju').value;
			
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
					
					
					tabla+='<td>'+dato1+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					
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
				
					tabla+='<td>'+dato1+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					
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


function Existe_Numero_Titulo(){
	
	var existe = 0;
	
	var datonumero = document.getElementById('numerotitulo').value+document.getElementById('numerotitulo2').value;
	
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
	
	valor  = document.getElementById('numerotitulo').value;
	valor2 = document.getElementById('numerotitulo2').value;
	valor3 = document.getElementById('valortitulo').value;
	valor4 = document.getElementById('adju').value;
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Numero Titulo");
		document.getElementById('numerotitulo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Numero Titulo");
		document.getElementById('numerotitulo2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Valor Titulo");
		document.getElementById('valortitulo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Adjudicatario");
		document.getElementById('adju').style.borderColor = '#FF0000';
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
	
	document.getElementById('numerotitulo').value = "418030000";
	document.getElementById('numerotitulo').style.borderColor='#E0E0E0';
	
	document.getElementById('numerotitulo2').value = "";
	document.getElementById('numerotitulo2').style.borderColor='#E0E0E0';
	
	document.getElementById('valortitulo').value = "";
	document.getElementById('valortitulo').style.borderColor='#E0E0E0';

	document.getElementById('adju').value = "";
	document.getElementById('adju').style.borderColor='#E0E0E0';

	
	
	/*document.getElementById('departamento').selectedIndex = 0;
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
	document.getElementById('autonotificar').style.borderColor='#E0E0E0';*/
	
	$('#partesdemandado').hide();
	

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

function Solo_Numeros(e){
	
	//alert(e);
	
	var key = window.Event ? e.which : e.keyCode
	//alert(key);
	return (key >= 48 && key <= 57)
}
	
function trim(cadena){
	
       cadena=cadena.replace(/^\s+/,'').replace(/\s+$/,'');
       return(cadena);
}

function valor(idvalor){
	
       alert(idvalor);
}



//*******************PARA EL MANEJO DE LA CORRESPONDENCIA SIN RADICADO ASOCIADO*********************************************
var z_c     = 1;
var Filas_c = 0;

function Adicionar_Correspondencia(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existeradicado = Validar_Radicado_Tabla();
	
	//existeradicado = 0;
	
	//existenumtitulo = Existe_Numero_Titulo();
	existenumtitulo = 0;
	
	if(existenumtitulo == 1){
		
		existenumtitulo = 1;
		alert("Ya EXiste");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos = Validar_Campos_Agregar_C(idaccion);
	
	//validarcampos = 0;
	
	if(validarcampos == 1){
		
		validarcampos = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1 = document.getElementById('listasr1').value;
			var dato2 = document.getElementById('listasr2').value;
			var dato3 = document.getElementById('listasr3').value;
			var dato4 = document.getElementById('peticionariosr').value;
			var dato5 = document.getElementById('foliossr').value;
			var dato6 = document.getElementById('observacionsr').value;
			
			/*if(idaccion == 1){
				
				var s0    = document.frm.clasificacionparte;
				var dato5 = document.getElementById('clasificacionparte').value+"-"+s0.options[s0.selectedIndex].text;
			}*/
			
			
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas_c = 1;
			var cantidad_filas;
			var TABLA      = document.getElementById('t_c');
			cantidad_filas = TABLA.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas>1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla=document.getElementById('cont_c').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla = reemplazarCadena("</table>", " ", tabla);
					
					tabla+='<tr>';
					
					
					tabla+='<td>'+dato1+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_C(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla+='</tr></table>';
					
					document.getElementById('cont_c').innerHTML=tabla;
					
					z_c++;
					
					Limpiar_Campos_3();
				 //}
			}
						
			if(cantidad_filas==1){
						
				//alert('cantidad = 1');
				
				var tabla=document.getElementById('cont_c').innerHTML;
				
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
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					
					tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_C(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont_c').innerHTML=tabla;
					
					z_c++;
					
					Limpiar_Campos_3();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}

function Validar_Campos_Agregar_C(idaccion){
	
	var validar = 0;
	

	valor  = document.getElementById('listasr1').value;
	valor2 = document.getElementById('listasr2').value;
	valor3 = document.getElementById('listasr3').value;
	valor4 = document.getElementById('peticionariosr').value;
	valor5 = document.getElementById('foliossr').value;
	//valor6 = document.getElementById('observacionsr').value;
			
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Tipo Documento");
		document.getElementById('listasr1').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Juzgado Destino");
		document.getElementById('listasr2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Tipo Solicitud");
		document.getElementById('listasr3').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Peticionario");
		document.getElementById('peticionariosr').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Folios");
		document.getElementById('foliossr').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}

}

function Limpiar_Campos_3(){
	
	document.getElementById('listasr1').selectedIndex = 0;
	document.getElementById('listasr1').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr2').selectedIndex = 0;
	document.getElementById('listasr2').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr3').selectedIndex = 0;
	document.getElementById('listasr3').style.borderColor='#E0E0E0';
	
	document.getElementById('peticionariosr').value = "";
	document.getElementById('peticionariosr').style.borderColor='#E0E0E0';

	
	document.getElementById('foliossr').value = "";
	document.getElementById('foliossr').style.borderColor='#E0E0E0';
	
	document.getElementById('observacionsr').value = "";
	document.getElementById('observacionsr').style.borderColor='#E0E0E0';
	
	
	
	//$('#partesdemandado').hide();
	

}

function Eliminar_Fila_C(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA = document.getElementById('t_c');
	
	TABLA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

//********************************************************************************************
						//PARA EL MANEJO DE 110 NASIVO
//********************************************************************************************
var z_m           = 1;
var Filas_m       = 0;
var cadena_fechas = " ";

function Adicionar_110_Masivo(idaccion){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	var existenumtitulo_m = Validar_Radicado_Tabla_M();

	//existenumtitulo_m = 0;
	
	if(existenumtitulo_m == 1){
		
		existenumtitulo_m = 1;
		alert("Radicado Ya Fue Adicionado");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos_m = Validar_Campos_Agregar_M(idaccion);
	
	//validarcampos = 0;
	
	if(validarcampos_m == 1){
		
		validarcampos_m = 1;
	}
	else{//2
	
			//DATOS 
			
			//var dato1_m = document.getElementById('idradi110').value;
			var dato2_m = document.getElementById('radicado110m').value;
			var dato3_m = document.getElementById('fecha110m').value;
			
			
			//-------------------------------------------------------------------------------------------------------
			
			/*$.get("funciones/traer_datos_radicado.php?idradicado="+dato2_m, function(cadena){
																		   
				
				var vector_datos = cadena.split("//////");
		
				 dato1_m = " ";	
				 dato1_m = vector_datos[0];
				
				alert(vector_datos[0]);
				
	
			});*/
			
			
			//CALCULO FECHAS SEGUN FECHAS DE FIJACION DE LOS PROCESOS
			//ADICIONANDO AL CAMPO OCULTO fechas_m LA FECHA INICIAL Y FINAL DE
			//LA LIQUIDAION DE CADA PROCESO
			var fi;
			var fii;
			
			var ff;
			var fff;
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+dato3_m, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				cadena_fechas += "******"+fii+"//////"+fff;
				
				$("#fechas_m").val(cadena_fechas);
				
				//alert($("#fechas_m").val());
				
				
			});
			
			
			
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas_m = 1;
			var cantidad_filas_m;
			var TABLA_m      = document.getElementById('t_m');
			cantidad_filas_m = TABLA_m.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas_m > 1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla_m = document.getElementById('cont_m').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla_m = reemplazarCadena("</table>", " ", tabla_m);
					
					tabla_m+='<tr>';
					
					
					//tabla_m+='<td>'+dato1_m+'</td>';
					
					tabla_m+='<td>'+dato2_m+'</td>';
					
					tabla_m+='<td>'+dato3_m+'</td>';
				
					
					tabla_m+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_M(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla_m+='</tr></table>';
					
					document.getElementById('cont_m').innerHTML = tabla_m;
					
					z_m++;
					
					Limpiar_Campos_3_M();
				 //}
			}
						
			if(cantidad_filas_m == 1){
						
				//alert('cantidad = 1');
				
				var tabla_m=document.getElementById('cont_m').innerHTML;
				
				//alert(tabla);
				
				//for (var id=0; id<Filas; id++){
					
					//var partefinal = tabla.length - 8;
					
					//alert("Longitud Tabla: "+tabla.length);
					//alert("Parte Final: "+partefinal);
					
					//tabla=tabla.substring(0,(tabla.length-8));
					
					tabla_m = reemplazarCadena("</table>", " ", tabla_m);
					
					//tabla=tabla.substring(0,partefinal);
					
					
					//alert(tabla);
					
					tabla_m+='<tr>';
				
					//tabla_m+='<td>'+dato1_m+'</td>';
					
					tabla_m+='<td>'+dato2_m+'</td>';
					
					tabla_m+='<td>'+dato3_m+'</td>';
					
					
					
					tabla_m+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_M(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla_m+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont_m').innerHTML=tabla_m;
					
					z_m++;
					
					Limpiar_Campos_3_M();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}


function Validar_Radicado_Tabla_M(){
	
	var existe = 0;
	
	var datonumero = document.getElementById('radicado110m').value;
	
	$('#t_m tr').each(function () {
	
		var d0  = $(this).find("td").eq(0).html();
		
		if(datonumero == d0){
			existe = 1;
			return false;
			
		}
		
		
	});
	
	return  existe;
				
}


function Validar_Campos_Agregar_M(idaccion){
	
	var validar = 0;
	

	//valor  = document.getElementById('idradi110').value;
	valor2 = document.getElementById('radicado110m').value;
	valor3 = document.getElementById('fecha110m').value;
	
	/*if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Id Proceso");
		document.getElementById('idradi110').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}*/
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Radicado");
		document.getElementById('radicado110m').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	else{
		
		if(valor2.length < 23) {
  		
			alert("La Longitud del Radicado debe ser de 23 Digitos");
			document.getElementById('radicado110m').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
		
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Fecha");
		document.getElementById('fecha110m').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	

}

function Limpiar_Campos_3_M(){
	
	
	
	//document.getElementById('idradi110').value = "";
	//document.getElementById('idradi110').style.borderColor='#E0E0E0';

	
	document.getElementById('radicado110m').value = "";
	document.getElementById('radicado110m').style.borderColor='#E0E0E0';
	
	document.getElementById('fecha110m').value = "";
	document.getElementById('fecha110m').style.borderColor='#E0E0E0';
	
	
}

function Eliminar_Fila_M(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA_M = document.getElementById('t_m');
	
	TABLA_M.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

//********************************************************************************************
						//FIN PARA EL MANEJO DE 110 NASIVO
//********************************************************************************************



//********************************************************************************************
						//PARA EL MANEJO DE REGISTRO ACCIONES
//********************************************************************************************
var z_ra           = 1;
var Filas_ra       = 0;
//var cadena_fechas = " ";

function Adicionar_Accion(){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existenumtitulo_ra = Validar_Radicado_Tabla_M();

	existenumtitulo_ra = 0;
	
	if(existenumtitulo_ra == 1){
		
		//existenumtitulo_ra = 1;
		//alert("Radicado Ya Fue Adicionado");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos_ra = Validar_Campos_Agregar_RA();
	
	//validarcampos = 0;
	
	if(validarcampos_ra == 1){
		
		validarcampos_ra = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1_ra = document.getElementById('listasr1').value+"-"+$("#listasr1 option:selected").text();
			var dato2_ra = document.getElementById('listasr2').value+"-"+$("#listasr2 option:selected").text();
			var dato3_ra = document.getElementById('gc_dh').value;
			var dato4_ra = document.getElementById('listasr3').value+"-"+$("#listasr3 option:selected").text();
			
			//var dato5_ra = document.getElementById('listasr4').value+"-"+$("#listasr4 option:selected").text();
			//var long = document.getElementById('listasr4[]').length;
			//alert(long);
			
			//RECORRER LISTA MULTIPLE
			//Y CONCATENAR SUS VALORES Y TEXTO
			var dato5_ra = "";
			obj = document.getElementById('listasr4');
		  	for (i=0; opt=obj.options[i];i++){ 
			
				if (opt.selected) {
					dato5_ra = opt.value+" "+opt.text+"-"+dato5_ra;
				}
				
			}
			
			var dato6_ra = document.getElementById('gc_ac').value;
			var dato7_ra = document.getElementById('listasr5').value+"-"+$("#listasr5 option:selected").text();
			var dato8_ra = document.getElementById('listasr6').value+"-"+$("#listasr6 option:selected").text();
			
			
			//-------------------------------------------------------------------------------------------------------
			
			/*$.get("funciones/traer_datos_radicado.php?idradicado="+dato2_m, function(cadena){
																		   
				
				var vector_datos = cadena.split("//////");
		
				 dato1_m = " ";	
				 dato1_m = vector_datos[0];
				
				alert(vector_datos[0]);
				
	
			});*/
			
			
			//CALCULO FECHAS SEGUN FECHAS DE FIJACION DE LOS PROCESOS
			//ADICIONANDO AL CAMPO OCULTO fechas_m LA FECHA INICIAL Y FINAL DE
			//LA LIQUIDACION DE CADA PROCESO
			/*var fi;
			var fii;
			
			var ff;
			var fff;
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+dato3_m, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				cadena_fechas += "******"+fii+"//////"+fff;
				
				$("#fechas_m").val(cadena_fechas);
				
				//alert($("#fechas_m").val());
				
				
			});*/
			
			
			
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas_ra = 1;
			var cantidad_filas_ra;
			var TABLA_ra      = document.getElementById('t_ra');
			cantidad_filas_ra = TABLA_ra.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas_ra > 1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla_ra = document.getElementById('cont_ra').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla_ra = reemplazarCadena("</table>", " ", tabla_ra);
					
					tabla_ra+='<tr>';
					
					
					tabla_ra+='<td>'+dato1_ra+'</td>';
					
					tabla_ra+='<td>'+dato2_ra+'</td>';
					
					tabla_ra+='<td>'+dato3_ra+'</td>';
					
					tabla_ra+='<td>'+dato4_ra+'</td>';
					
					tabla_ra+='<td>'+dato5_ra+'</td>';
					
					tabla_ra+='<td>'+dato6_ra+'</td>';
					
					tabla_ra+='<td>'+dato7_ra+'</td>';
					
					tabla_ra+='<td>'+dato8_ra+'</td>';
				
					
					tabla_ra+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_RA(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla_ra+='</tr></table>';
					
					document.getElementById('cont_ra').innerHTML = tabla_ra;
					
					z_ra++;
					
					Limpiar_Campos_3_RA();
				 //}
			}
						
			if(cantidad_filas_ra == 1){
						
				//alert('cantidad = 1');
				
				var tabla_ra=document.getElementById('cont_ra').innerHTML;
				
				//alert(tabla);
				
				//for (var id=0; id<Filas; id++){
					
					//var partefinal = tabla.length - 8;
					
					//alert("Longitud Tabla: "+tabla.length);
					//alert("Parte Final: "+partefinal);
					
					//tabla=tabla.substring(0,(tabla.length-8));
					
					tabla_ra = reemplazarCadena("</table>", " ", tabla_ra);
					
					//tabla=tabla.substring(0,partefinal);
					
					
					//alert(tabla);
					
					tabla_ra+='<tr>';
				
					tabla_ra+='<td>'+dato1_ra+'</td>';
					
					tabla_ra+='<td>'+dato2_ra+'</td>';
					
					tabla_ra+='<td>'+dato3_ra+'</td>';
					
					tabla_ra+='<td>'+dato4_ra+'</td>';
					
					tabla_ra+='<td>'+dato5_ra+'</td>';
					
					tabla_ra+='<td>'+dato6_ra+'</td>';
					
					tabla_ra+='<td>'+dato7_ra+'</td>';
					
					tabla_ra+='<td>'+dato8_ra+'</td>';
					
					
					tabla_ra+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_RA(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla_ra+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont_ra').innerHTML=tabla_ra;
					
					z_ra++;
					
					Limpiar_Campos_3_RA();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}


/*function Validar_Radicado_Tabla_M(){
	
	var existe = 0;
	
	var datonumero = document.getElementById('radicado110m').value;
	
	$('#t_m tr').each(function () {
	
		var d0  = $(this).find("td").eq(0).html();
		
		if(datonumero == d0){
			existe = 1;
			return false;
			
		}
		
		
	});
	
	return  existe;
				
}*/


function Validar_Campos_Agregar_RA(){
	
	var validar = 0;
	

	valor  = document.getElementById('listasr1').value;
	valor2 = document.getElementById('listasr2').value;
	valor3 = document.getElementById('gc_dh').value;
	valor4 = document.getElementById('listasr3').value;
	//valor5 = document.getElementById('listasr4[]').value;
	valor5 = document.getElementById('listasr4').value;
	valor6 = document.getElementById('gc_ac').value;
	valor7 = document.getElementById('listasr5').value;
	valor8 = document.getElementById('listasr6').value;
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Clase");
		document.getElementById('listasr1').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Numeral Norma");
		document.getElementById('listasr2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	/*if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Radicado");
		document.getElementById('radicado110m').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	else{
		
		if( valor2.length < 23  ) {
		
			alert("La Longitud del Radicado debe ser de 23 Digitos");
			document.getElementById('radicado110m').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
	}*/
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Descripcion Hallazgo");
		document.getElementById('gc_dh').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Proceso Responsable");
		document.getElementById('listasr3').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Proceso Afectado o Impactado");
		//document.getElementById('listasr4[]').style.borderColor = '#FF0000';
		document.getElementById('listasr4').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6) ) {
  		
		alert("Analisis de Causas");
		document.getElementById('gc_ac').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor7 == null || valor7.length == 0 || /^\s+$/.test(valor7) ) {
  		
		alert("Defina Metodologia");
		document.getElementById('listasr5').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor8 == null || valor8.length == 0 || /^\s+$/.test(valor8) ) {
  		
		alert("Defina Generada Por");
		document.getElementById('listasr6').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	

}

function Limpiar_Campos_3_RA(){
	
	
	
	document.getElementById('listasr1').selectedIndex = 0;
	document.getElementById('listasr1').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr2').selectedIndex = 0;
	document.getElementById('listasr2').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr3').selectedIndex = 0;
	document.getElementById('listasr3').style.borderColor='#E0E0E0';
	
	//document.getElementById('listasr4[]').selectedIndex = 0;
	//document.getElementById('listasr4[]').style.borderColor='#E0E0E0';
	document.getElementById('listasr4').selectedIndex = 0;
	document.getElementById('listasr4').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr5').selectedIndex = 0;
	document.getElementById('listasr5').style.borderColor='#E0E0E0';
	
	document.getElementById('listasr6').selectedIndex = 0;
	document.getElementById('listasr6').style.borderColor='#E0E0E0';
	
	
	document.getElementById('gc_dh').value = "";
	document.getElementById('gc_dh').style.borderColor='#E0E0E0';
	
	document.getElementById('gc_ac').value = "";
	document.getElementById('gc_ac').style.borderColor='#E0E0E0';
	
	
}

function Eliminar_Fila_RA(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA_RA = document.getElementById('t_ra');
	
	TABLA_RA.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

//********************************************************************************************
						//FIN PARA EL MANEJO DE REGISTRO ACCIONES
//********************************************************************************************




//********************************************************************************************
						//PARA EL MANEJO DE REGISTRO ACTIVIDADES
//********************************************************************************************
var z_raC           = 1;
var Filas_raC       = 0;
//var cadena_fechas = " ";

function Adicionar_Actividad(){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existenumtitulo_ra = Validar_Radicado_Tabla_M();

	existenumtitulo_raC = 0;
	
	if(existenumtitulo_raC == 1){
		
		//existenumtitulo_ra = 1;
		//alert("Radicado Ya Fue Adicionado");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos_raC = Validar_Campos_Agregar_RAC();
	
	//validarcampos = 0;
	
	if(validarcampos_raC == 1){
		
		validarcampos_raC = 1;
	}
	else{//2
	
			//DATOS 
			
			var dato1_raC = document.getElementById('id_accion').value;
			var dato2_raC = document.getElementById('fechaAC_INI').value;
			var dato3_raC = document.getElementById('fechaAC_FINI').value;
			var dato4_raC = document.getElementById('gc_ac_2').value;
			var dato5_raC = document.getElementById('listaC').value+"-"+$("#listaC option:selected").text();
			
			
			//-------------------------------------------------------------------------------------------------------
			
			/*$.get("funciones/traer_datos_radicado.php?idradicado="+dato2_m, function(cadena){
																		   
				
				var vector_datos = cadena.split("//////");
		
				 dato1_m = " ";	
				 dato1_m = vector_datos[0];
				
				alert(vector_datos[0]);
				
	
			});*/
			
			
			//CALCULO FECHAS SEGUN FECHAS DE FIJACION DE LOS PROCESOS
			//ADICIONANDO AL CAMPO OCULTO fechas_m LA FECHA INICIAL Y FINAL DE
			//LA LIQUIDACION DE CADA PROCESO
			/*var fi;
			var fii;
			
			var ff;
			var fff;
			
			$.get('views/funciones/traer_fechas_108.php?fechat='+dato3_m, function(fechas){
				
				//alert(fechas);
				
				var vector_fechas = fechas.split(" ");
				
				fi  = vector_fechas[0].split("/");
				fii = fi[2]+"-"+fi[1]+"-"+fi[0];
				
				//alert(fii);
				
				ff  = vector_fechas[1].split("/");
				fff = ff[2]+"-"+ff[1]+"-"+ff[0];
				
				//alert(fff);
				
				cadena_fechas += "******"+fii+"//////"+fff;
				
				$("#fechas_m").val(cadena_fechas);
				
				//alert($("#fechas_m").val());
				
				
			});*/
			
			
			
			//-------------------------------------------------------------------------------------------------------
	
			//Filas = resultado.length;
			Filas_raC = 1;
			var cantidad_filas_raC;
			var TABLA_raC      = document.getElementById('t_raC');
			cantidad_filas_raC = TABLA_raC.rows.length;
	
			//alert(cantidad_filas);
			
			if(cantidad_filas_raC > 1){
						
				//alert('cantidad > 1');
					
				//Eliminar_Tabla();
				
				var tabla_raC = document.getElementById('cont_raC').innerHTML;
					
				//for (var id=0; id<Filas; id++){
				
					//tabla=tabla.substring(0,(tabla.length-8)); 
					
					tabla_raC = reemplazarCadena("</table>", " ", tabla_raC);
					
					tabla_raC+='<tr>';
					
					
					tabla_raC+='<td>'+dato1_raC+'</td>';
					
					tabla_raC+='<td>'+dato2_raC+'</td>';
					
					tabla_raC+='<td>'+dato3_raC+'</td>';
					
					tabla_raC+='<td>'+dato4_raC+'</td>';
					
					tabla_raC+='<td>'+dato5_raC+'</td>';
					
					
				
					
					tabla_raC+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_RAC(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
										
					tabla_raC+='</tr></table>';
					
					document.getElementById('cont_raC').innerHTML = tabla_raC;
					
					z_raC++;
					
					Limpiar_Campos_3_RAC();
				 //}
			}
						
			if(cantidad_filas_raC == 1){
						
				//alert('cantidad = 1');
				
				var tabla_raC=document.getElementById('cont_raC').innerHTML;
				
				//alert(tabla);
				
				//for (var id=0; id<Filas; id++){
					
					//var partefinal = tabla.length - 8;
					
					//alert("Longitud Tabla: "+tabla.length);
					//alert("Parte Final: "+partefinal);
					
					//tabla=tabla.substring(0,(tabla.length-8));
					
					tabla_raC = reemplazarCadena("</table>", " ", tabla_raC);
					
					//tabla=tabla.substring(0,partefinal);
					
					
					//alert(tabla);
					
					tabla_raC+='<tr>';
				
					tabla_raC+='<td>'+dato1_raC+'</td>';
					
					tabla_raC+='<td>'+dato2_raC+'</td>';
					
					tabla_raC+='<td>'+dato3_raC+'</td>';
					
					tabla_raC+='<td>'+dato4_raC+'</td>';
					
					tabla_raC+='<td>'+dato5_raC+'</td>';
					
					
					
					tabla_raC+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_RAC(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
					
					tabla_raC+='</tr></table>';
				
					//alert(tabla);
					document.getElementById('cont_raC').innerHTML=tabla_raC;
					
					z_raC++;
					
					Limpiar_Campos_3_RAC();
				//}
			}
			
	}//2
	
	//Limpiar_Formulario();
	
	}//1
	
}


/*function Validar_Radicado_Tabla_M(){
	
	var existe = 0;
	
	var datonumero = document.getElementById('radicado110m').value;
	
	$('#t_m tr').each(function () {
	
		var d0  = $(this).find("td").eq(0).html();
		
		if(datonumero == d0){
			existe = 1;
			return false;
			
		}
		
		
	});
	
	return  existe;
				
}*/


function Validar_Campos_Agregar_RAC(){
	
	var validar = 0;
	

	valor  = document.getElementById('id_accion').value;
	valor2 = document.getElementById('fechaAC_INI').value;
	valor3 = document.getElementById('fechaAC_FINI').value;
	valor4 = document.getElementById('gc_ac_2').value;
	valor5 = document.getElementById('listaC').value;
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina ID");
		document.getElementById('id_accion').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Fecha Inicial");
		document.getElementById('fechaAC_INI').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	/*if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Radicado");
		document.getElementById('radicado110m').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	else{
		
		if( valor2.length < 23  ) {
		
			alert("La Longitud del Radicado debe ser de 23 Digitos");
			document.getElementById('radicado110m').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
		}
	}*/
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Fecha Final");
		document.getElementById('fechaAC_FINI').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Descripcion");
		document.getElementById('gc_ac_2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Responsable");
		//document.getElementById('listasr4[]').style.borderColor = '#FF0000';
		document.getElementById('listaC').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	

}

function Limpiar_Campos_3_RAC(){
	
	
	document.getElementById('fechaAC_INI').value = "";
	document.getElementById('fechaAC_INI').style.borderColor='#E0E0E0';
	
	document.getElementById('fechaAC_FINI').value = "";
	document.getElementById('fechaAC_FINI').style.borderColor='#E0E0E0';
	
	document.getElementById('gc_ac_2').value = "";
	document.getElementById('gc_ac_2').style.borderColor='#E0E0E0';
	
	document.getElementById('listaC').selectedIndex = 0;
	document.getElementById('listaC').style.borderColor='#E0E0E0';
	
	
	
	
	
	
	
}

function Eliminar_Fila_RAC(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA_RAC = document.getElementById('t_raC');
	
	TABLA_RAC.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}

//********************************************************************************************
						//FIN PARA EL MANEJO DE REGISTRO ACTIVIDADES
//********************************************************************************************

function Proceso_Bloqueado(valor_radicado){
	
	//alert(valor_radicado);
	
	$.get("funciones/traer_radicado_bloqueado.php?idradicado="+valor_radicado, function(cadena){
																		   
				
				var vector_datos = cadena.split("//////");
		
				//alert(vector_datos[0]);
				
				var proc_bloqueado = vector_datos[0];
				
				if(proc_bloqueado == 1){
					
					alert("EXPEDIENTE BLOQUEADO");
					
					document.getElementById('radicado110m').value = "";
					
				}
				
				
	
	});
	
	
}
