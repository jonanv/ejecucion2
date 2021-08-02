//var servidor   = "http://190.217.24.24/";
//var ipservidor = "190.217.24.24";

var servidor   = "http://190.217.24.112/";
var ipservidor = "190.217.24.112";

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
				var d2  = $(this).find("td").eq(2).html();
				var d3  = $(this).find("td").eq(3).html();
				var d4  = $(this).find("td").eq(4).html();
				var d5  = $(this).find("td").eq(5).html();
				var d6  = $(this).find("td").eq(6).html();
			
				//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
				
				if(controlemcabezados == 0){
					controlemcabezados = controlemcabezados + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes = datospartes+"******"+d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes").val('');
					$("#datospartes").val(datospartes);
					
	
				}
		
			});
			
			//alert(datospartes);
			//alert("Filas Tabla: "+cantidad_filas_2+"Datos Partes: "+datospartes);
			
			
			
		}
		else{
			alert("No es Posible Realizar el Registro, no se Cuenta con Informacion en la Tabla de ADICIONAR CARPETA");
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
         
			
			//OBTENEMOS DEL RADICADO 170014003 006 19931018000 
			//CLASE JUZGADO 4003, DEPARTAMENTO 17, MUNICIPIO 17001
			/*var idclasejuzgado = radicadox.substring(5, 9);
			var iddepartamento = radicadox.substring(0, 2);
			var idmunicipio    = radicadox.substring(0, 5);*/
			
			//var archivo   = document.getElementById('archivo').files[0].name;
			//var archivo = document.getElementById('archivo').files[];
			//var archivo = document.getElementById('archivo').files;
			//var archivo = document.querySelector("#archivo");
			
	
			//alert(archivo);
			//**********************************************************************************************************
			var dataString = 'id_hv='+$('#id_hv').val()+'&hvcedula='+$('#hvcedula').val()+'&hvnombre='+$('#hvnombre').val()+'&hvdireccion='+$('#hvdireccion').val()+'&hvcorreo='+$('#hvcorreo').val()+'&hvperfil='+$('#hvperfil').val()+'&hvestadocivil='+$('#hvestadocivil').val()+'&hvtelefono='+$('#hvtelefono').val()+'&hvpocupacional='+$('#hvpocupacional').val()+'&hvfn='+$('#hvfn').val();
			var url1       = "index.php?controller=hojavida&action=Administrar_HojaVida";
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
                    //$("#ok").html(data);
                    //$("#ok").show();
                   // $("#frm").hide();
				   
				   cadenadatos = data.split("**********");
				   
				   //alert(data);
				   
				   if(cadenadatos[0] == 'CORRECTO'){
						
						alert("EL REGISTRO HA SIDO INGRESADO CORRECTAMENTE");
						
						//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
						
						//location.href="index.php?controller=hojavida&action=Administrar_HojaVida&opcion=1&datosx="+$('#hvcedula').val();
						
						Traer_Datos_Hoja_Vida($('#hvcedula').val());
							
						
						
					}
						
					if(cadenadatos[0] == 'ERROR'){
						
						alert("ERROR AL REALIZAR EL REGISTRO:" +cadenadatos[1]);
						
						//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
						
						Traer_Datos_Hoja_Vida($('#hvcedula').val());
							
						
					}
						
					if(cadenadatos[0] != 'CORRECTO' && cadenadatos[0] != 'ERROR'){
							
							alert(data+" "+"REGISTRANDO");
							
							//location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
							
							Traer_Datos_Hoja_Vida($('#hvcedula').val());
								
						
					}
				   
				   
				   
				   
				   
				   
				   
                }
            });
		
			
        }
    });
	
	
	$('#fila_botones').hide();
	
	
	$('.filtrarhv').click(function(evento){
	
		//alert(1);
		
		
		if (document.getElementById('fechai').value.length         == 0 &&
			document.getElementById('fechaf').value.length         == 0 &&
			document.getElementById('radicadox').value.length      == 0 &&
			document.getElementById('hvnombre').value.length       == 0
		
		){
			
			//ASIGNO VALOR DE 3 YA QUE EN LA VISTA sigdoc_listar_documentos_salientes.php
			//AL FINAL DE ESTA PREGUNTO POR if(!empty($opcion)), SI PONGO CERO (0) NO LO VALIDA
			//CON LA FUNCION empty()
			dato_0 = 3;
			
			location.href="index.php?controller=hojavida&action=RecargarTablaHV&dato_0="+dato_0;
       	
		}
		else{
		
			dato_0 = 1;
			dato_1 = document.getElementById('fechai').value;
			dato_2 = document.getElementById('fechaf').value;
			datox1 = document.getElementById('radicadox').value;
			datox2 = document.getElementById('hvnombre').value;
			
			location.href="index.php?controller=hojavida&action=FiltroTablaHV&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2;
	
		}
	
    });
	
	
	
	//ME PERMITE ABRIR FORMULARIO DE HOJA DE VIDA
	$(".subir_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
			
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
				
					$('#popupbox').load('views/popupbox/subir_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
				});
			
			}
			
		
	
	});
	
	//ME PERMITE ABRIR FORMULARIO SOPORTES VISTA hojavida_listar.php
	$(".so_hojavida_l").click(function(){
									   
		//alert($(this).attr('data-iduserfolder'));
		
		params={};
			
		params.iduserfolder = $(this).attr('data-iduserfolder');
		params.userhvcedula = $(this).attr('data-hvcedula');
		params.userhvnombre = $(this).attr('data-hvnombre');
		
		//params.hvcedula = $('#hvcedula').val();
			
		$('#popupbox').load('views/popupbox/soportes_listar_hojavida.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		});
		
	
	});
	
	
	//ME PERMITE ABRIR FORMULARIO DE ESTUDIOS
	$(".estudios_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
				
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
					
					//alert(idusuario);
				
					$('#popupbox').load('views/popupbox/estudios_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
					
				
				
				});
				
				
			
			}
			
		
	
	});
	
	//ME PERMITE ABRIR FORMULARIO DE EXPERIENCIA LABORAL
	$(".experiencia_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
					
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
					
				
					$('#popupbox').load('views/popupbox/experiencia_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
					
				});
		
			
			}
			
		
	
	});
	
	//ME PERMITE ABRIR FORMULARIO DE ACTO ADMINISTRATIVO
	$(".acto_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
			
				
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
					
				
					$('#popupbox').load('views/popupbox/actos_admi_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
					
				});	
					
			
			}
			
		
	
	});
	
	
	//ME PERMITE ABRIR FORMULARI CONOCIMIENTOS
	$(".concimientos_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
				
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
				
					$('#popupbox').load('views/popupbox/conocimientos_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
				});	
			
			}
			
		
	
	});
	
	
	//ME PERMITE ABRIR FORMULARIO DE REFERENCIAS
	$(".referencia_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
				
					params={};
				
					params.id_hv     = $('#id_hv').val();
					params.hvcedula  = $('#hvcedula').val();
					params.idusuario = idusuario;
				
					$('#popupbox').load('views/popupbox/referencia_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
					
				});
			
			}
			
		
	
	});
	
	
	//ME PERMITE ADICIONAR ANTECEDENTES
	$(".antecedentes_hojavida").click(function(){
		
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				
				//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
				var idusuario;
			
				//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
				//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
				//13 DE OCTUBRE 2017
				$.get("funciones/traer_datos_usuario.php?cedula_user="+$('#hvcedula').val(), function(cadena){
								
		
					var vector_datos_usuario = cadena.split("//////");
					
					
					idusuario = vector_datos_usuario[0];
				
					params={};
				
					params.id_hv         = $('#id_hv').val();
					params.hv_cedula_es  = $('#hvcedula').val();
					params.idusuario     = idusuario;
					
					//ADICIONO EL identificador_archivo PARA SABER SI SE SUBIRA UN ESTUDIO O UNA EXPERIENCIA LABORAL
					params.identificador_archivo = "A";
				
					$('#popupbox').load('views/popupbox/soportes_hojavida.php',params,function(){
						//alert(2);
						$('#block').show();
						//alert(3);
						$('#popupbox').show();
						//alert(4);
					});
					
				});	
			
			}
			
		
	
	});
	
	
	$(".generar_hojavida_pdpf").click(function(){
	
		
			//VALIDANDO QUE SOLO EL USUARIO EN SESION IMPRIMA SOLO SU HOJA DE VIDA
			var validar = 0;
			
			if( $('#hvcedula').val() == null || $('#hvcedula').val().length == 0 || /^\s+$/.test( $('#hvcedula').val() ) ){
				
				document.getElementById('hvcedula').style.borderColor='#FF0000';
				validar = 1;
				
				alert("DEFINA CEDULA");
				
			}
			else{
			
				if( $('#id_hv').val() == null || $('#id_hv').val().length == 0 || /^\s+$/.test( $('#id_hv').val() ) ){
				
					document.getElementById('id_hv').style.borderColor='#FF0000';
					validar = 1;
				
					alert("CEDULA NO ESTA RELACIONADA CON NINGUN SERVIDOR JUDICIAL");
				
				}
			}
			
			
			if(validar == 0){
			
				
				
				window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/HOJA_VIDA.php?id_hv="+$('#id_hv').val());
			
			}		
		
	
	});
	
	$(".generar_hojavida_pdpf_admin").click(function(){
	
		var id_hv     = $(this).attr('data-idhv');
		
		window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/HOJA_VIDA.php?id_hv="+id_hv);
		
	
	});
	
	
	
	//SOPORTES VISTA hojavida_listar
	/*$('#JQueryFTD_Demo_lista').fileTree({
							  
	  
		root: '/wamp/www/ejecucion/HOJASDEVIDA/'+folder_usuario_L+'/',
		
								 
		script: 'views/viewstree/jqueryFileTree.php',
		expandSpeed: 1000,
		collapseSpeed: 1000,
		multiFolder: true
							  
		}, function(file) {
		
		
		//alert(file);
								
		//var res = file.substring(10, 43);
								
		var res = file.split("/");
								
		//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
								
		//var servidor = "http://172.16.176.194/";
								
		var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6];
		
		//alert(res_2);
								
		//file = $(this).attr("href");
		window.open(res_2, '_blank');
		return false;
								
								
	});*/
	
	

	//PARA LIMPIAR LOS CAMPOS DEL FORMULARIO
	$(".btn_limpiar").click(function() {
		location.href="index.php?controller=hojavida&action=Administrar_HojaVida";
	});		
	
	
	$(".btn_limpiar_2").click(function() {
		location.href="index.php?controller=hojavida&action=Administrar_HojaVida_Listar";
	});		
	
	//PARA LAS FECHAS
	$("#fechai").datepicker({ changeFirstDay: false	});
	$("#fechaf").datepicker({ changeFirstDay: false	});
	
	$("#fechap").datepicker({ changeFirstDay: false	});
	
	
	
	
	$(".buscarxfiltro").click(function(){
								
		
		
		if( 
			
		   $('#fechariarchivo').val().length  == 0 &&
		   $('#fecharrfarchivo').val().length == 0 &&
		   $('#yeararchivo').val().length     == 0 && 
		   $('#cajaarchivo').val().length     == 0 &&
		   $('#carpetaarchivo').val().length  == 0 && 
		   $('#numerocarpeta').val().length   == 0 &&
		   $('#fechaiarchivo').val().length   == 0 && 
		   $('#fechafarchivo').val().length   == 0 &&
		   $('#coninicial').val().length      == 0 && 
		   $('#confinal').val().length        == 0
		   
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('fechariarchivo').style.borderColor  = '#FF0000';
			document.getElementById('fecharrfarchivo').style.borderColor = '#FF0000';
			document.getElementById('yeararchivo').style.borderColor     = '#FF0000';
			document.getElementById('cajaarchivo').style.borderColor     =  '#FF0000';
			document.getElementById('carpetaarchivo').style.borderColor  = '#FF0000';
			document.getElementById('numerocarpeta').style.borderColor   =  '#FF0000';
			document.getElementById('fechaiarchivo').style.borderColor   = '#FF0000';
			document.getElementById('fechafarchivo').style.borderColor   = '#FF0000';
			document.getElementById('coninicial').style.borderColor      = '#FF0000';
			document.getElementById('confinal').style.borderColor        = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechariarchivo').val(); 
		    dato_2 = $('#fecharrfarchivo').val();
			
			//FECHAS INICIAL - FINAL
			dato_3 = $('#fechaiarchivo').val(); 
		    dato_4 = $('#fechafarchivo').val();
			
		    datox1 = $('#yeararchivo').val();
		    datox2 = $('#cajaarchivo').val();
			datox3 = $('#carpetaarchivo').val();
			datox4 = $('#numerocarpeta').val();
			
			datox5 = $('#coninicial').val();
			datox6 = $('#confinal').val();
			
		
			location.href="index.php?controller=administrar&action=Busquedad_Filtro_Archivo&dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;
			

			
		}
		
	});
	
	
	$(".generar_excel").click(function(){
								
		
		
		if( 
			
		   $('#fechariarchivo').val().length  == 0 &&
		   $('#fecharrfarchivo').val().length == 0 &&
		   $('#yeararchivo').val().length     == 0 && 
		   $('#cajaarchivo').val().length     == 0 &&
		   $('#carpetaarchivo').val().length  == 0 && 
		   $('#numerocarpeta').val().length   == 0 &&
		   $('#fechaiarchivo').val().length   == 0 && 
		   $('#fechafarchivo').val().length   == 0 &&
		   $('#coninicial').val().length      == 0 && 
		   $('#confinal').val().length        == 0
		   
		   
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('fechariarchivo').style.borderColor  = '#FF0000';
			document.getElementById('fecharrfarchivo').style.borderColor = '#FF0000';
			document.getElementById('yeararchivo').style.borderColor     = '#FF0000';
			document.getElementById('cajaarchivo').style.borderColor     =  '#FF0000';
			document.getElementById('carpetaarchivo').style.borderColor  = '#FF0000';
			document.getElementById('numerocarpeta').style.borderColor   =  '#FF0000';
			document.getElementById('fechaiarchivo').style.borderColor   = '#FF0000';
			document.getElementById('fechafarchivo').style.borderColor   = '#FF0000';
			document.getElementById('coninicial').style.borderColor      = '#FF0000';
			document.getElementById('confinal').style.borderColor        = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 3000;
			
			//FECHAS REGISTRO
			dato_1 = $('#fechariarchivo').val(); 
		    dato_2 = $('#fecharrfarchivo').val();
			
			//FECHAS INICIAL - FINAL
			dato_3 = $('#fechaiarchivo').val(); 
		    dato_4 = $('#fechafarchivo').val();
			
		    datox1 = $('#yeararchivo').val();
		    datox2 = $('#cajaarchivo').val();
			datox3 = $('#carpetaarchivo').val();
			datox4 = $('#numerocarpeta').val();
			
			datox5 = $('#coninicial').val();
			datox6 = $('#confinal').val();
			

			location.href="index.php?controller=administrar&action=ReporteExcel&opcion="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6;

			
		}
		
	});
	
	
	
	
	//EDITAR ENCABEZADO
	$('.editar_encabezado').click( function(){
								  
		
		//CAPTURO PARAMETROS
		var idarchivo     = $(this).attr('data-idarchivo');
		var year          = $(this).attr('data-year');
		var caja          = $(this).attr('data-caja');
		var fechasuperior = $(this).attr('data-fechasuperior');
		
		//alert(id);
		
		params={};
        params.idarchivo     = idarchivo;
		params.year          = year;
		params.caja          = caja;
		params.fechasuperior = fechasuperior;
			
		$('#popupbox').load('views/popupbox/archivo_encabezado.php',params,function(){
			
			$('#block').show();
			$('#popupbox').show();
				
		})
		
    });
	
	
	
	//EDITAR DETALLE ENCABEZADO
	$('.editar_detalleencabezado').click( function(){
								  
	
		//CAPTURO PARAMETROS
		var idarchivo     = $(this).attr('data-idarchivo');
		var iddetalle      = $(this).attr('data-iddetalle');
		var idcarpeta     = $(this).attr('data-idcarpeta');
		var numerocarpeta = $(this).attr('data-numerocarpeta');
		var fecinicial    = $(this).attr('data-fecinicial');
		var fecfinal      = $(this).attr('data-fecfinal');
		var coninicial    = $(this).attr('data-coninicial');
		var confinal      = $(this).attr('data-confinal');
		
		
		
		//alert(id);
		
		params={};
        params.idarchivo     = idarchivo;
		params.iddetalle     = iddetalle;
		params.idcarpeta     = idcarpeta;
		params.numerocarpeta = numerocarpeta;
		params.fecinicial    = fecinicial;
		params.fecfinal      = fecfinal;
		params.coninicial    = coninicial;
		params.confinal      = confinal;
			
		$('#popupbox').load('views/popupbox/archivo_detalleencabezado.php',params,function(){
			
			$('#block').show();
			$('#popupbox').show();
				
		})
		
    });
	
	
	//ADICIONAR NOMBRE CARPETA
	$('.adicionar_carpeta').click( function(){
								  
	
		params={};
       
			
		$('#popupbox').load('views/popupbox/archivo_adicionar_carpeta.php',params,function(){
			
			$('#block').show();
			$('#popupbox').show();
				
		})
		
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
	//fila_botones

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


function Traer_Datos_Hoja_Vida(idvalor){
	
	//alert(idvalor);
	
	//ID DE USUARIO EN PROCESO PARA REGISTRAR O EDITAR SU HV
	var idusuario;
			
	//NOTA IMPORTANTE: SE HACE EL CAMBION ADICIONANDO ESTE PARAMETRO params.idusuario = idusuario;
	//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
	//13 DE OCTUBRE 2017
	$.get("funciones/traer_datos_usuario.php?cedula_user="+idvalor, function(cadena){
								
		
	var vector_datos_usuario = cadena.split("//////");
			
	idusuario = vector_datos_usuario[0];
		
	
	
	//CEDULA DE USUARIO EN SESSION
	var nom_usuario   = $('#nom_usuario').val();
	
	//var id_usuario    = $('#id_usuario').val();
	var id_usuario    = idusuario;
	
	var id_user_admin = $('#id_user_admin').val();
	
	var cedula_aux;
	
	//alert(id_usuario);
	

	$.get("funciones/traer_datos_parte.php?idvalor="+idvalor+"&id_usuario="+id_usuario, function(cadena){
			
			
			
	
			//var vector_datos = cadena.split("//////");
			
			var vector_datos_total = cadena.split("******");
			
			//alert(vector_datos.length);
			//alert(vector_datos);
			
			var vector_datos       = vector_datos_total[0].split("//////");
			
			//alert(vector_datos.length);
			
			if(vector_datos.length == 11){
				

				/*PARA QUE UN USUARIO UBICADO EN LA TABLA pa_usuario_acciones, REGISTRO id = 8 PUEDA
				CONSULTAR OTRAS HOJAS DE VIDA*/
				if(id_user_admin == 1){
					
					cedula_aux      = vector_datos[1]; 
					vector_datos[1] = nom_usuario;
				}
				
				if(vector_datos[1] == nom_usuario){
				
					$("#id_hv").val(vector_datos[0]);
	
					$("#hvcedula").val(cedula_aux);
					//$("#hvnombre").val(vector_datos[2]);
					//$("#nombre").attr('disabled',true);
					
					$("#hvnombre").val(vector_datos[2]);
					$("#hvdireccion").val(vector_datos[3]);
					$("#hvcorreo").val(vector_datos[4]);
					$("#hvperfil").val(vector_datos[5]);
					$("#hvestadocivil").val(vector_datos[6]);
					$("#hvtelefono").val(vector_datos[7]);
					$("#hvpocupacional").val(vector_datos[9]);
					$("#hvfn").val(vector_datos[10]);
					
					
					if( vector_datos[8] == null || vector_datos[8].length == 0 || /^\s+$/.test( vector_datos[8] ) ){
						
						$("#foto img").attr("src","views/fotos/hv_6.png");
					}
					else{
						
						$("#foto img").attr("src",vector_datos[8]);
					}
					
					//TABLA ESTUDIOS
					var vector_estudios = vector_datos_total[1].split("*/-*/-");
					
					var longi           = vector_estudios.length - 1;
					
					Eliminar_Tabla_Estudios();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_estudios_2 = vector_estudios[i].split("------");
						
						dato0_es = vector_estudios_2[0];
						dato1_es = vector_estudios_2[1];
						dato2_es = vector_estudios_2[2];
						dato3_es = vector_estudios_2[3];
						dato4_es = vector_estudios_2[4];
						dato5_es = vector_estudios_2[5];
						dato6_es = vector_estudios_2[6];
					  
					 	var tabla=document.getElementById('cont_es').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_es+'</td>';
						
						//tabla+='<td>'+dato1_es+'</td>';
						
						tabla+='<td>'+dato2_es+'</td>';
						
						//tabla+='<td>'+dato3_es+'</td>';
						
						tabla+='<td>'+dato4_es+'</td>';
				
						tabla+='<td>'+dato5_es+'</td>';
						
						/*tabla+='<td><a href='+dato6_es+'><img src="views/popupbox/ipdf3.png" width="45" height="35"/></a></td>';*/
						
						
						tabla+='<td><button type=button name=certificados id=certificados onclick="Cargar_Certficados('+dato0_es+',1)"><img src="views/images/ipdf3.png" width="35" height="30" title="CERTIFICADO"/></button></td>';
		
						/*tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';*/
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_es').innerHTML=tabla;
					  
					  
					  
					}

					
					
					//TABLA EXPERIENCIA LABORAL
					var vector_experiencia = vector_datos_total[2].split("*/-*/-");
					
					var longi              = vector_experiencia.length - 1;
					
					Eliminar_Tabla_Experiencia();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_experiencia_2 = vector_experiencia[i].split("------");
						
						dato0_ex = vector_experiencia_2[0];
						dato5_ex = vector_experiencia_2[5];
						dato6_ex = vector_experiencia_2[6];
						dato7_ex = vector_experiencia_2[7];
						dato8_ex = vector_experiencia_2[8];
						dato9_ex = vector_experiencia_2[9];
						
					  
					 	var tabla=document.getElementById('cont_ex').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_ex+'</td>';
						
						tabla+='<td>'+dato5_ex+'</td>';
						
						tabla+='<td>'+dato6_ex+'</td>';
				
						tabla+='<td>'+dato7_ex+'</td>';
						
						tabla+='<td>'+dato8_ex+'</td>';
						
						tabla+='<td>'+dato9_ex+'</td>';
						
						/*tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';*/
						
						
						
						tabla+='<td><button type=button name=certificados id=certificados onclick="Cargar_Certficados('+dato0_ex+',2)"><img src="views/images/ipdf3.png" width="35" height="30" title="CERTIFICADO"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_ex').innerHTML=tabla;
					  
					  
					  
					}
					
					
					//TABLA ACTOS ADMINISTRATIVOS
					var vector_actos = vector_datos_total[5].split("*/-*/-");
					
					var longi              = vector_actos.length - 1;
					
					Eliminar_Tabla_Actos();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_actos_2 = vector_actos[i].split("------");
						
						dato0_ad = vector_actos_2[0];
						dato2_ad = vector_actos_2[1];
						dato3_ad = vector_actos_2[3];
						dato4_ad = vector_actos_2[4];
						
						
					  
					 	var tabla=document.getElementById('cont_ad').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_ad+'</td>';
						
						tabla+='<td>'+dato2_ad+'</td>';
						
						tabla+='<td>'+dato3_ad+'</td>';
				
						tabla+='<td>'+dato4_ad+'</td>';
						
												
						tabla+='<td><button type=button name=certificados id=certificados onclick="Cargar_Certficados('+dato0_ad+',3)"><img src="views/images/ipdf3.png" width="35" height="30" title="ACTA"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_ad').innerHTML=tabla;
					  
					  
					  
					}
					
					
					//TABLA CONOCIMIENTOS
					var vector_conocimiento = vector_datos_total[4].split("*/-*/-");
					
					var longi              = vector_conocimiento.length - 1;
					
					Eliminar_Tabla_Conocimiento();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_conocimiento_2 = vector_conocimiento[i].split("------");
						
						dato0_ex = vector_conocimiento_2[0];
						dato5_ex = vector_conocimiento_2[5];
						
					  
					 	var tabla=document.getElementById('cont_co').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_ex+'</td>';
						
						tabla+='<td>'+dato5_ex+'</td>';
						
				
						tabla+='</tr></table>';
						
						document.getElementById('cont_co').innerHTML=tabla;
					  
					  
					  
					}
					
					//TABLA REFERENCIA
					var vector_referencia = vector_datos_total[3].split("*/-*/-");
					
					var longi              = vector_referencia.length - 1;
					
					Eliminar_Tabla_Referencia();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_referencia_2 = vector_referencia[i].split("------");
						
						dato0_ex = vector_referencia_2[0];
						dato5_ex = vector_referencia_2[5];
						dato6_ex = vector_referencia_2[6];
						dato7_ex = vector_referencia_2[7];
						dato9_ex = vector_referencia_2[9];
						dato10_ex = vector_referencia_2[10];
						
					  
					 	var tabla=document.getElementById('cont_ref').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_ex+'</td>';
						
						tabla+='<td>'+dato5_ex+'</td>';
						
						tabla+='<td>'+dato6_ex+'</td>';
				
						tabla+='<td>'+dato7_ex+'</td>';
						
						tabla+='<td>'+dato9_ex+'</td>';
						
						tabla+='<td>'+dato10_ex+'</td>';
						
						/*tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';*/
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_ref').innerHTML=tabla;
					  
					  
					  
					}
					
					
					//TABLA ELIMINAR SOPORTES
					var vector_elimi = vector_datos_total[6].split("*/-*/-");
					
					var longi        = vector_elimi.length - 1;
					
					Eliminar_Tabla_Elimi();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_elimi_2 = vector_elimi[i].split("------");
						
						dato0_el = vector_elimi_2[0];
						dato1_el = vector_elimi_2[1];
						dato2_el = vector_elimi_2[2];
						
						
					  
					 	var tabla=document.getElementById('cont_elimi').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_el+'</td>';
						
						tabla+='<td>'+dato1_el+'</td>';
						
						tabla+='<td>'+dato2_el+'</td>';
				
						
						//tabla+='<td><button type=button name=certificados id=certificados onclick="Eliminar_Soporte('+dato1_el+')"><img src="views/images/pendiente.jpg" width="15" height="15" title="ELIMINAR SOPORTE"/></button></td>';
						
						tabla+='<td><button type=button name=certificados id=certificados onclick="Eliminar_Soporte(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="ELIMINAR SOPORTE"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_elimi').innerHTML=tabla;
					  
					  
					  
					}
					
					
					
					//TABLA ELIMINAR SOPORTES DE ARCHIVOS QUE SON ANTECEDENTES / CERTIFICADOS
					//Y NO SE ENLAZAN CON UN REGISTRO EN LA TABLA hv_central
					var vector_elimi_2 = vector_datos_total[7].split("*/-*/-");
					
					var longi          = vector_elimi_2.length - 1;
					
					Eliminar_Tabla_Elimi_2();
					
					for (i = 0; i < longi; i++) {
					  
					  	vector_elimi_3 = vector_elimi_2[i].split("------");
						
						dato0_el_2 = vector_elimi_3[0];
						dato1_el_2 = vector_elimi_3[1];
						dato2_el_2 = vector_elimi_3[2];
						
						
					  
					 	var tabla=document.getElementById('cont_elimi_2').innerHTML;
					
						tabla = reemplazarCadena("</table>", " ", tabla);
						
						tabla+='<tr>';
						
						tabla+='<td style="color:#FF0000">'+dato0_el_2+'</td>';
						
						tabla+='<td>'+dato1_el_2+'</td>';
						
						tabla+='<td>'+dato2_el_2+'</td>';
				
						
						//tabla+='<td><button type=button name=certificados id=certificados onclick="Eliminar_Soporte('+dato1_el+')"><img src="views/images/pendiente.jpg" width="15" height="15" title="ELIMINAR SOPORTE"/></button></td>';
						
						tabla+='<td><button type=button name=certificados id=certificados onclick="Eliminar_Soporte_2(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="ELIMINAR SOPORTE"/></button></td>';
											
						tabla+='</tr></table>';
						
						document.getElementById('cont_elimi_2').innerHTML=tabla;
					  
					  
					  
					}
					
					
					//VISUALIZA LOS BOTONES DE REGISTRAR Y RESTABLECER
					$('#fila_botones').show();
					
					
					//NOTA IMPORTANTE: SE HACE EL CAMBION EN traer_datos_parte RETORNANDO INFORMACION EN $cadena_9
					// Y SE NECESITA EL ID DEL USUARIO AL CUAL SE LE SE ESTA PROCESANDO LA HV
					//YA QUE UN USUARIO ADMINISTRADOR PUEDE EDITAR CUALQUIER HOJA DE VIDA 
					//13 DE OCTUBRE 2017
					var vector_pa_usuario = vector_datos_total[8].split("//////");
					
					folder_usuario_1 = vector_pa_usuario[0];
					
					//SOPORTES
					$('#JQueryFTD_Demo_1').fileTree({
							  //root: '/windows/',
							  
							  //root: '/wamp/www/ejecucion/HOJASDEVIDA/38/SOPORTES',
							  
			  
							  root: '/wamp/www/ejecucion/HOJASDEVIDA/'+folder_usuario_1+'/',
							  
							 
							  script: 'views/viewstree/jqueryFileTree.php',
							  expandSpeed: 1000,
							  collapseSpeed: 1000,
							  multiFolder: true
							  
							}, function(file) {
								
								//alert(file);
								
								//var res = file.substring(10, 43);
								
								var res = file.split("/");
								
								//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
								
								//var servidor = "http://172.16.176.194/";
								
								var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]+"/"+res[7];
								
								//alert(res_2);
								
								//file = $(this).attr("href");
								window.open(res_2, '_blank');
								return false;
								
								
					});
					
					
					
					
					
				}
				else{
					
					alert("NO ES POSIBLE REALIZAR PROCESO SU CEDULA NO CORRESPONDE A LA DEL USUARIO EN SESION, CEDULA DE USUARIO EN SESION: "+nom_usuario);
					
					$('#fila_botones').hide();
					
					Eliminar_Tabla_Estudios();
					
					Eliminar_Tabla_Experiencia();
				
					Eliminar_Tabla_Conocimiento();
				
					Eliminar_Tabla_Referencia();
					
					Eliminar_Tabla_Actos();
					
					Eliminar_Tabla_Elimi();
					
					Eliminar_Tabla_Elimi_2();
					
					//SOPORTES
					$('#JQueryFTD_Demo_1').fileTree({
							  //root: '/windows/',
							  
							  //root: '/wamp/www/ejecucion/HOJASDEVIDA/38/SOPORTES',
							  
			  
							  root: '',
							  
							 
							  script: 'views/viewstree/jqueryFileTree.php',
							  expandSpeed: 1000,
							  collapseSpeed: 1000,
							  multiFolder: true
							  
							}, function(file) {
								
								//alert(file);
								
								//var res = file.substring(10, 43);
								
								var res = file.split("/");
								
								//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
								
								//var servidor = "http://172.16.176.194/";
								
								var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]+"/"+res[7];
								
								//alert(res_2);
								
								//file = $(this).attr("href");
								window.open(res_2, '_blank');
								return false;
								
								
					});
					
				}
				
				
				
			}
			else{
				
				if(id_user_admin == 1){
					
					$('#fila_botones').show();
				}
				else{
					if($("#hvcedula").val() == nom_usuario){
						$('#fila_botones').show();
					}
					else{
						$('#fila_botones').hide();
					}
				}
				
				$("#id_hv").val('');
					
				//$("#hvnombre").val('');
				//$("#nombre").attr('disabled',false);
					
				$("#hvnombre").val('');
				$("#hvfn").val('');
				$("#hvdireccion").val('');
				$("#hvcorreo").val('');
				$("#hvperfil").val('');
				$("#hvestadocivil").val('');
				$("#hvtelefono").val('');
				$("#hvpocupacional").val('');
					
				$("#foto img").attr("src","views/fotos/hv_6.png");
				
				Eliminar_Tabla_Estudios();
				
				Eliminar_Tabla_Experiencia();
				
				Eliminar_Tabla_Conocimiento();
				
				Eliminar_Tabla_Referencia();
				
				Eliminar_Tabla_Actos();
				
				Eliminar_Tabla_Elimi();
				
				Eliminar_Tabla_Elimi_2();
				
				
				//SOPORTES
				$('#JQueryFTD_Demo_1').fileTree({
							  //root: '/windows/',
							  
							  //root: '/wamp/www/ejecucion/HOJASDEVIDA/38/SOPORTES',
							  
			  
							  root: '',
							  
							 
							  script: 'views/viewstree/jqueryFileTree.php',
							  expandSpeed: 1000,
							  collapseSpeed: 1000,
							  multiFolder: true
							  
							}, function(file) {
								
								//alert(file);
								
								//var res = file.substring(10, 43);
								
								var res = file.split("/");
								
								//alert(res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]);
								
								//var servidor = "http://172.16.176.194/";
								
								var res_2 = servidor+res[3]+"/"+res[4]+"/"+res[5]+"/"+res[6]+"/"+res[7];
								
								//alert(res_2);
								
								//file = $(this).attr("href");
								window.open(res_2, '_blank');
								return false;
								
								
					});
			
			}
			
	});
	
	
	});//FIN $.get("funciones/traer_datos_usuario.php?cedula_user="+idvalor, function(cadena)
	
}

function Cargar_Certficados(id_certificado,id_certificado_doc){
	
	if(id_certificado_doc == 1){id_certificado_doc = "E";}
	if(id_certificado_doc == 2){id_certificado_doc = "L";}
	if(id_certificado_doc == 3){id_certificado_doc = "AD";}
	
	//alert(id_certificado);
	params={};
			
	params.id_certificado     = id_certificado;
	params.id_certificado_doc = id_certificado_doc;
	//params.hvcedula  = $('#hvcedula').val();
				
			
	$('#popupbox').load('views/popupbox/certificados_hojavida.php',params,function(){
		//alert(2);
		$('#block').show();
		//alert(3);
		$('#popupbox').show();
		//alert(4);
	});
	
}

//function Eliminar_Soporte(id_certificado,idfila){
function Eliminar_Soporte(idfila){
	
	var msg_hvg = " ";
	
	var dataString = "";
	
	var id_certificado      = document.getElementById("t_elimi").rows[idfila].cells[0].innerText;
	
	var id_central_eliminar = document.getElementById("t_elimi").rows[idfila].cells[1].innerText;
	var cont_idc            = 0;
	
	var id_ruta_eliminar    = document.getElementById("t_elimi").rows[idfila].cells[2].innerText;
	
	
	//RECORRO LA TABLA ELIMINAR SOPORTE
	//PARA CONTAR LA COLUMNA ID ARCHVIO CENTRAL
	//CONTRA EL id_central_eliminar, YA QUE SI ES MAYOR A UNO
	//ES DECIR SI EXISTEN VARIOS REGISTROS CON EL MISMO ID ARCHVIO CENTRAL
	//SOLO SE DEBE BORRAR LA RUTA DE LA TABLA hv_rutas_archivos
	//Y NO EL REGISTRO CON EL id_central_eliminar DE LA TABLA hv_central
	//YA QUE HAY VARIOS REGISTROS AMARRADOS A DICO ID
	var cantidad_filas_2_R;
	var TABLA_2_R      = document.getElementById('t_elimi');
	cantidad_filas_2_R = TABLA_2_R.rows.length;
		
		
	if(cantidad_filas_2_R > 1){
			
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados_R = 0;
			
		$('#t_elimi tr').each(function () {
	
			
			var d1_R  = $(this).find("td").eq(1).html();
				
			
			if(controlemcabezados_R == 0){
				controlemcabezados_R = controlemcabezados_R + 1;
			}
			else{
					
				if(id_central_eliminar == d1_R){
					
					cont_idc = cont_idc + 1;
				}
					
	
			}
		
		});
	
	
	}
	
	
	if (confirm ("ESTA SEGURO DE ELIMINAR EL SOPORTE: "+ id_certificado+" RUTA: "+id_ruta_eliminar+" ID CENTRAL: "+id_central_eliminar)) {
		
		/*msg_hvg = "ELIMINANDO...";
		//alert("ELIMINANDO...");
		
		$('.mensage_hvg').html(msg_hvg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
		$('.mensage_hvg').show('slow');//Mostramos el div.
		
		setTimeout(function() {
			$(".mensage_hvg").fadeOut(1500);
		},5000);*/
		
		dataString += '&id_certificado='+id_certificado;
		dataString += '&id_ruta_eliminar='+id_ruta_eliminar;
		dataString += '&id_central_eliminar='+id_central_eliminar;
		dataString += '&cont_idc='+cont_idc;
		
		/*Ejecutamos la función ajax de jQuery*/		
		$.ajax({
				
			//url:'views/popupbox/subir.php', //Url a donde la enviaremos
			url:'index.php?controller=hojavida&action=Administrar_HojaVida_Eliminar_Soporte',
			type:'POST', //Metodo que usaremos
			//contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:dataString, //Le pasamos el objeto que creamos con los archivos
			//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false //Para que el formulario no guarde cache
		}).done(function(msg_hvg){//Escuchamos la respuesta y capturamos el mensaje msg
					
			//MensajeFinal(msg_hvg)
						
			$('.mensage_hvg').html(msg_hvg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_hvg').show('slow');//Mostramos el div.
					
			//DESAPARECER
			setTimeout(function() {
						
				//$(".mensage").fadeOut(1500);
				$(".mensage_hvg").fadeOut(1000);
				
				Traer_Datos_Hoja_Vida($('#hvcedula').val());
							
		
			},2000);
					
					
		
		});
		
		
		
		
		
	
	}
	
}


function Eliminar_Soporte_2(idfila){
	
	var msg_hvg = " ";
	
	var dataString = "";
	
	var id_certificado      = document.getElementById("t_elimi_2").rows[idfila].cells[0].innerText;
	
	var id_central_eliminar = document.getElementById("t_elimi_2").rows[idfila].cells[1].innerText;
	var cont_idc            = 0;
	
	var id_ruta_eliminar    = document.getElementById("t_elimi_2").rows[idfila].cells[2].innerText;
	
	
	//RECORRO LA TABLA ELIMINAR SOPORTE
	//PARA CONTAR LA COLUMNA ID ARCHVIO CENTRAL
	//CONTRA EL id_central_eliminar, YA QUE SI ES MAYOR A UNO
	//ES DECIR SI EXISTEN VARIOS REGISTROS CON EL MISMO ID ARCHVIO CENTRAL
	//SOLO SE DEBE BORRAR LA RUTA DE LA TABLA hv_rutas_archivos
	//Y NO EL REGISTRO CON EL id_central_eliminar DE LA TABLA hv_central
	//YA QUE HAY VARIOS REGISTROS AMARRADOS A DICO ID
	var cantidad_filas_2_R;
	var TABLA_2_R      = document.getElementById('t_elimi_2');
	cantidad_filas_2_R = TABLA_2_R.rows.length;
		
		
	if(cantidad_filas_2_R > 1){
			
		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados_R = 0;
			
		$('#t_elimi_2 tr').each(function () {
	
			
			var d1_R  = $(this).find("td").eq(1).html();
				
			
			if(controlemcabezados_R == 0){
				controlemcabezados_R = controlemcabezados_R + 1;
			}
			else{
					
				if(id_central_eliminar == d1_R){
					
					cont_idc = cont_idc + 1;
				}
					
	
			}
		
		});
	
	
	}
	
	
	if (confirm ("ESTA SEGURO DE ELIMINAR EL SOPORTE: "+ id_certificado+" RUTA: "+id_ruta_eliminar+" ID CENTRAL: "+id_central_eliminar)) {
		
		/*msg_hvg = "ELIMINANDO...";
		//alert("ELIMINANDO...");
		
		$('.mensage_hvg').html(msg_hvg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
		$('.mensage_hvg').show('slow');//Mostramos el div.
		
		setTimeout(function() {
			$(".mensage_hvg").fadeOut(1500);
		},5000);*/
		
		dataString += '&id_certificado='+id_certificado;
		dataString += '&id_ruta_eliminar='+id_ruta_eliminar;
		dataString += '&id_central_eliminar='+id_central_eliminar;
		dataString += '&cont_idc='+cont_idc;
		
		/*Ejecutamos la función ajax de jQuery*/		
		$.ajax({
				
			//url:'views/popupbox/subir.php', //Url a donde la enviaremos
			url:'index.php?controller=hojavida&action=Administrar_HojaVida_Eliminar_Soporte',
			type:'POST', //Metodo que usaremos
			//contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:dataString, //Le pasamos el objeto que creamos con los archivos
			//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false //Para que el formulario no guarde cache
		}).done(function(msg_hvg){//Escuchamos la respuesta y capturamos el mensaje msg
					
			//MensajeFinal(msg_hvg)
						
			$('.mensage_hvg').html(msg_hvg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_hvg').show('slow');//Mostramos el div.
					
			//DESAPARECER
			setTimeout(function() {
						
				//$(".mensage").fadeOut(1500);
				$(".mensage_hvg").fadeOut(1000);
				
				Traer_Datos_Hoja_Vida($('#hvcedula').val());
							
		
			},2000);
					
					
		
		});
		
		
		
		
		
	
	}
	
}

function Eliminar_Tabla_Estudios(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_es');
			
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

function Eliminar_Tabla_Experiencia(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_ex');
			
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


function Eliminar_Tabla_Actos(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_ad');
			
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

function Eliminar_Tabla_Referencia(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_ref');
			
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

function Eliminar_Tabla_Conocimiento(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_co');
			
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

function Eliminar_Tabla_Elimi(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_elimi');
			
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

function Eliminar_Tabla_Elimi_2(){
	
	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t_elimi_2');
			
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
	
	existenumtitulo = 0;
	
	//existenumtitulo = Existe_Numero_Titulo();
	
	if(existenumtitulo == 1){
		
		existenumtitulo = 1;
		alert("Ya Existe esa Informacion en la Tabla, no es Posible su Adicion");
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
			
			var dato1  = document.getElementById('carpetaarchivo').value;
			var s0     = document.frm.carpetaarchivo;
			var dato1b = s0.options[s0.selectedIndex].text;
			
			var dato2 = document.getElementById('numerocarpeta').value;
			
			var dato3 = document.getElementById('fechaiarchivo').value;
			var dato4 = document.getElementById('fechafarchivo').value;
			
			
			var dato5 = document.getElementById('coninicial').value;
			var dato6 = document.getElementById('confinal').value;
			
			
			
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
					
					tabla+='<td>'+dato1b+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					
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
					
					tabla+='<td>'+dato1b+'</td>';
					
					tabla+='<td>'+dato2+'</td>';
					
					tabla+='<td>'+dato3+'</td>';
					
					tabla+='<td>'+dato4+'</td>';
					
					tabla+='<td>'+dato5+'</td>';
					
					tabla+='<td>'+dato6+'</td>';
					
					
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
	
	//var datonumero = document.getElementById('numerotitulo').value+document.getElementById('numerotitulo2').value;
	
	var dato1A = document.getElementById('carpetaarchivo').value;
	var s0A    = document.frm.carpetaarchivo;
	var dato1B = s0A.options[s0A.selectedIndex].text;
	
	var dato2A = document.getElementById('numerocarpeta').value;
	
	var dato3A = document.getElementById('fechaiarchivo').value;
	var dato4A = document.getElementById('fechafarchivo').value;
	
	var dato5A = document.getElementById('coninicial').value;
	var dato6A = document.getElementById('confinal').value;
			
	
	//SI LAS FECHAS INICIAL Y FINAL SON VACIAS
	if( (dato3A == null || dato3A.length == 0 || /^\s+$/.test(dato3A)) || (dato4A == null || dato4A.length == 0 || /^\s+$/.test(dato4A)) ) {
		
		$('#t tr').each(function () {
		
			var d0  = $(this).find("td").eq(0).html();
			var d1  = $(this).find("td").eq(1).html();
			var d2  = $(this).find("td").eq(2).html();
			var d3  = $(this).find("td").eq(5).html();
			var d4  = $(this).find("td").eq(6).html();
			
			if(dato1A == d0 && dato1B == d1 && dato2A == d2 && dato5A == d3 && dato6A == d4){
				
				existe = 1;
				return false;
				
			}
			
			
		});
	
	}
	
	//SI LOS CONSECUTIVOS SON VACIAS
	if( (dato5A == null || dato5A.length == 0 || /^\s+$/.test(dato5A)) || (dato6A == null || dato6A.length == 0 || /^\s+$/.test(dato6A)) ) {
		
		$('#t tr').each(function () {
		
			var d0  = $(this).find("td").eq(0).html();
			var d1  = $(this).find("td").eq(1).html();
			var d2  = $(this).find("td").eq(2).html();
			var d3  = $(this).find("td").eq(3).html();
			var d4  = $(this).find("td").eq(4).html();
			
			if(dato1A == d0 && dato1B == d1 && dato2A == d2 && dato3A == d3 && dato4A == d4){
				
				existe = 1;
				return false;
				
			}
			
			
		});
	
	}
	
	return  existe;
				
}

function Validar_Campos_Agregar(idaccion){
	
	var validar = 0;
	
	valor  = document.getElementById('carpetaarchivo').value;
	valor2 = document.getElementById('numerocarpeta').value;
	valor3 = document.getElementById('fechaiarchivo').value;
	valor4 = document.getElementById('fechafarchivo').value;
	valor5 = document.getElementById('coninicial').value;
	valor6 = document.getElementById('confinal').value;
	
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
  		
		alert("Defina Nombre Carpeta");
		document.getElementById('carpetaarchivo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Numero Carpeta");
		document.getElementById('numerocarpeta').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	/*if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Fecha Inicial");
		document.getElementById('fechaiarchivo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Fecha Final");
		document.getElementById('fechafarchivo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}*/
	
	
	//LAS FECHAS SON VACIAS DEBE DEFINIR CONSECUTIVOS
	if( (valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3)) || (valor4 == null && valor4.length == 0 || /^\s+$/.test(valor4)) ) {
  		

		if( (valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5)) || (valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6)) ) {
			
			/*alert("Defina Consecutivo Inicial y Consecutivo Final, ya que ambas fechas inicial y final no estan definidas, y debe ser solo una opcion fechas o consecutivos");
			document.getElementById('coninicial').style.borderColor = '#FF0000';
			document.getElementById('confinal').style.borderColor   = '#FF0000';*/
			
			
			alert("Defina Fecha Inicial y Fecha Final");
			document.getElementById('fechaiarchivo').style.borderColor = '#FF0000';
			document.getElementById('fechafarchivo').style.borderColor = '#FF0000';
			
			validar = 1;
			
			return validar;
		}
		else{
			
			$('#fechaiarchivo').val('');
			$('#fechafarchivo').val('');
			
		}
		
	}
	
	
	//LOS CONSECUTIVOS SON VACIOS DEBE DEFINIR FECHAS INICIAL Y FINAL
	if( (valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5)) || (valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6)) ) {
  		

		if( (valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3)) || (valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4)) ) {
			
			/*alert("Defina Fecha Inicial y Fecha Final, ya que tanto consecutivo inicial y final no estan definidos, y debe ser solo una opcion fechas o consecutivos");
			document.getElementById('fechaiarchivo').style.borderColor = '#FF0000';
			document.getElementById('fechafarchivo').style.borderColor = '#FF0000';*/
			
			
			alert("Defina Consecutivo Inicial y Consecutivo Final");
			document.getElementById('coninicial').style.borderColor = '#FF0000';
			document.getElementById('confinal').style.borderColor   = '#FF0000';
			
			validar = 1;
			
			return validar;
			
			
		}
		else{
			
			$('#coninicial').val('');
			$('#confinal').val('');
			
		}
		
		
		
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
	
	document.getElementById('carpetaarchivo').selectedIndex = 0;
	document.getElementById('carpetaarchivo').style.borderColor='#E0E0E0';
	
	document.getElementById('numerocarpeta').value = "";
	document.getElementById('numerocarpeta').style.borderColor='#E0E0E0';
	
	document.getElementById('fechaiarchivo').value = "";
	document.getElementById('fechaiarchivo').style.borderColor='#E0E0E0';

	document.getElementById('fechafarchivo').value = "";
	document.getElementById('fechafarchivo').style.borderColor='#E0E0E0';
	
	document.getElementById('coninicial').value = "";
	document.getElementById('coninicial').style.borderColor='#E0E0E0';
	
	document.getElementById('confinal').value = "";
	document.getElementById('confinal').style.borderColor='#E0E0E0';

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

function Fechas_Seleccionada(){
	
	$('#coninicial').val('');
	$('#confinal').val('');
}

function Consecutivos_Seleccionados(e){
	
	$('#fechaiarchivo').val('');
	$('#fechafarchivo').val('');
	
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}


