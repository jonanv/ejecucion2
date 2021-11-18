<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

/*select di.id,di.idtipodocumento,ubi.radicado from (documentos_internos di INNER JOIN ubicacion_expediente ubi ON di.idradicado = ubi.id)
						   where di.fecharemate= '".$_GET["fecha"]."' AND di.idtipodocumento IN (20,35,36) order by di.id DESC*/


//REMATES SIN APROBAR, SIN FILTRO
if( trim($_POST['dato_soli']) == 0){
	
	$datosdelit_4F  = $funcion->get_datos_REMATES_ACTIVOS();
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
	
}


//REMATES SEGUN FILTRO
if( trim($_POST['dato_soli']) == 1){


	$dato_1 = trim($_POST['dato_1']);
	$dato_2 = trim($_POST['dato_2']);
	
				
	$datox1 = trim($_POST['datox1']);
	$datox2 = trim($_POST['datox2']);
	$datox3 = trim($_POST['datox3']);
	$datox4 = trim($_POST['datox4']);
	
	
	$datosdelit_4F  = $funcion->get_datos_REMATES_ACTIVOS_FILTRO($dato_1,$dato_2,$datox1,$datox2,$datox3,$datox4);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
			
	
	//echo "datox2: ".strlen($datox2);
	
	//echo "datox2: ".$datox2;
}	



$ip_plataforma = trim($_SESSION['ipplataforma']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<script type="text/javascript">

$('document').ready(function(){


		var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
		var ipservidor = ip_servidor;
	
		//var ipservidor = "190.217.24.24";
		//var ipservidor = "172.16.176.194";

		 //-----------------------------------PARA QUE LAS FECHA SALGA EN ESPAÑOL--------------------------------------------------------------------
		 $.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '< Ant',
		 nextText: 'Sig >',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		 weekHeader: 'Sm',
		 dateFormat: 'yy-mm-dd',
		 firstDay: 1,
		 isRTL: false,
		 showMonthAfterYear: false,
		 yearSuffix: '',
		 showWeek: true,
		 showButtonPanel: true,
		 changeMonth: true,
		 changeYear: true
		 };
		 $.datepicker.setDefaults($.datepicker.regional['es']);
		 //-------------------------------------------------------------------------------------------------------------------------------------------
	
		//PARA LAS FECHAS
		$("#fechasoli_ri").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasoli_rf").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		



		$('#cancel').click( function(){
								  
        	$('#block').hide();
        	$('#popupbox').hide();
		
    	});


	   	$("#checkTodos").change(function () {
		  
		  $("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
		  //$("input:checkbox").attr('checked', $(this).attr("checked"));
		  
		 
	   	});
		
		
		$('.generar_pdf').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var id = $(this).attr('data-id');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/ejecucion/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
		});
		
		$('.generar_obs').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var idrad = $(this).attr('data-idrad');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/HISTORIAL_PROCESO.php?id="+idrad);
				
		});
		
		
		
		$(".aprobarsoli").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 2; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				d1R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla REMATES";
				$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_soli').show('slow');
				
				setTimeout(function() {
					$(".mensage_soli").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_Aprobar_Remates',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_soli').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_soli").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	
	$(".desaprobarsoli").click(function(evento){
		
			//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO controlemcabezados = 0 (TITULO DE LA TABLA) Y controlemcabezados = 1 (ENCABEZADOS)
			//ESTA VARIABLE APLICA CON EL CODIGO QUE SE CIERRA, COMO SE RECORRE NORMALMENTE LAS FILAS DE UA TABLA
			//var controlemcabezados = 0;
			
			var dataString = "";
			
			var idspermisoR     = "";
			var idspermiso_real = 0;
			
			
			var fR = 1;
			
			var d0R;
			
		
			//RALIZO EL RECORRIDO DE LA TABLA DE ESTA FORMA
			//YA QUE COMO LA TABLA tbuscarxfiltro TIENE OTRAS 
			//TABLAS CONSTRUIDAS EN CIERTAS COLUMNAS
			//EL APUNTADOR A LOS CAMPOS checked SE PIERDE Y DA NUL
			//POR ESO SE CIERRA COMO SE RECORRE NORMAMENTE EN LA PARTE DE ABAJO
			var cantidad_filas_FR;
			var TABLA_FR = document.getElementById('tsoli');
			
			cantidad_filas_FR = TABLA_FR.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 2; r < cantidad_filas_FR; r++){
				
				d0R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				d1R  = document.getElementById("tsoli").rows[r].cells[0].innerText;
				
				if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoR = d0R+"//////"+d1R+"******"+idspermisoR;
						
						idspermiso_real = 1;
						
						
						
				}
				
				
				
					
				fR = fR + 1;
				
				
			}
			
			
			
			if(idspermiso_real == 0){
			
				//alert("No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS");
				
				
				//msg = "No se ha Selecionado Ningun Registro de la Tabla SOLICITUDES ACTIVAS, o Falta por Seleccionar Informacion en los Registros, o uno o varios de los registros su estado es  EN PROCESO, y se desea es APROBAR o NO APROBAR, SOLICITUDES ACTIVAS";
				msg = "No se ha Selecionado Ningun Registro de la Tabla REMATES";
				$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_soli').show('slow');
				
				setTimeout(function() {
					$(".mensage_soli").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					$('#datos_soli').val('');
					$('#datos_soli').val(idspermisoR);
					
					dataString += '&datospartes='+$('#datos_soli').val();
					
					//alert(dataString);
				
					//location.href="index.php?controller=archivo&action=Termino_Revisado_Todos&id="+dato_id+"&radicado="+dato_radicado
					
					//location.href="index.php?controller=radicador&action=Realizar_Prestamo_Masivo&idspermisoR="+idspermisoR;
					
					
					
					/*Ejecutamos la función ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Realizar_Des_Aprobar_Remates',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_soli').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_soli').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_soli").fadeOut(1500);
							
							location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
						},3000);
						
					
					});
					
					
					
				
				}
				
				
			}
								 
	});
	
	
	$(".recargar_solicitud").click(function(){
								
		
			dato_soli = 0;
			
			
			$('#block').hide();
        	$('#popupbox').hide();
		
	
			params={};
			
			params.dato_soli = 0;
			

			$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		
			
		
	});
	
	
	
	
	$(".buscarxfiltro_solicitud").click(function(){
								
		
		
		if( 
			$('#id_rema').val().length       == 0 &&
		   	$('#rad_rena').val().length      == 0 && 
		   	$('#fechasoli_ri').val().length  == 0 &&
		   	$('#fechasoli_rf').val().length  == 0 &&
			$('#estadorema').val().length    == 0 &&
			$('#juzrema').val().length       == 0
		   
			
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_rema').style.borderColor      = '#FF0000';
			document.getElementById('rad_rena').style.borderColor     = '#FF0000';
			document.getElementById('fechasoli_ri').style.borderColor =  '#FF0000';
			document.getElementById('fechasoli_rf').style.borderColor = '#FF0000';
			document.getElementById('estadorema').style.borderColor   = '#FF0000';
			document.getElementById('juzrema').style.borderColor      = '#FF0000';
			
			
		
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_soli = 1;
			
			
			//FECHAS REMATE
			dato_1 = $('#fechasoli_ri').val();
		   	dato_2 = $('#fechasoli_rf').val();
			
			//ID REMATE
		   	datox1 = $('#id_rema').val();
			
			//RADICADO
			datox2 = $('#rad_rena').val();
			
			datox3 = $('#estadorema').val();
			datox4 = $('#juzrema').val();
			
			
			
			
			//location.href="index.php?controller=radicador&action=Busquedad_Filtro_Solicitud&dato_soli="+dato_soli+"&dato_1="+dato_1+"&dato_2="+dato_2+"&dato_3="+dato_3+"&dato_4="+dato_4+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4+"&datox5="+datox5;
			
			
			$('#block').hide();
        	$('#popupbox').hide();
		
	
			params={};
			
			params.dato_soli = 1;
			
			params.dato_1 = dato_1;
			params.dato_2 = dato_2;
			
			params.datox1 = datox1;
			params.datox2 = datox2;
			params.datox3 = datox3;
			params.datox4 = datox4;
			
		
			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
		
			
		}
		
	});
	
	
	
	$(".solicitud_pdf").click(function(){
								
		
		
		if( 
		
			$('#id_rema').val().length       == 0 &&
		   	$('#rad_rena').val().length      == 0 && 
		   	$('#fechasoli_ri').val().length  == 0 &&
		   	$('#fechasoli_rf').val().length  == 0 &&
			$('#estadorema').val().length    == 0 &&
			$('#juzrema').val().length       == 0
			
		   
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('id_rema').style.borderColor      = '#FF0000';
			document.getElementById('rad_rena').style.borderColor     = '#FF0000';
			document.getElementById('fechasoli_ri').style.borderColor =  '#FF0000';
			document.getElementById('fechasoli_rf').style.borderColor = '#FF0000';
			document.getElementById('estadorema').style.borderColor   = '#FF0000';
			document.getElementById('juzrema').style.borderColor      = '#FF0000';
			
			
	
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			dato_0 = 1;
			
			
			//FECHAS REMATE
			dato_1 = $('#fechasoli_ri').val();
		   	dato_2 = $('#fechasoli_rf').val();
			
			//ID REMATE
		   	datox1 = $('#id_rema').val();
			
			//RADICADO
			datox2 = $('#rad_rena').val();
			
			datox3 = $('#estadorema').val();
			datox4 = $('#juzrema').val();
			
			
			window.open("views/tcpdf/GENERAR_REMATES.php?dato_0="+dato_0+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4);
			
			
			
			
		}
		
	});
	
	
	
	
	//CARGAR LISTAS
	$("#despacho_soli").change(function(event){
            
		var id = $("#despacho_soli").find(':selected').val();
			
		
		$("#solicita_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+1);
		
		$('#bloque_soli').html('');
		
		$("#bloque_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+3);
			
			
    });
	
	$("#solicita_soli").change(function(event){
            
		var id = $("#solicita_soli").find(':selected').val();
			
		
		$('#bloque_soli').html('');
		
		$("#bloque_soli").load('funciones/traer_datos_lista_archivo.php?id='+id+"&idsql="+4);
			
			
    });
	
	
	
	
	
	//NOTA: PARA NO TENER INCONVENIRNTES CON TABLAS EDITABLES, YA QUE REMATES_SINAPROBAR.PHP
	//SE ABRE SOBBRE ARCHIVO_FILTRAR_UBICACION.PHP Y TIENE LAS MISMAS VARIABLES PARA EDITAR, CANCELAR Y GUARDAR
	//SIMPLEMENTE SE DEFINEN OTRAS VARIBALES
	/*-------------------------------------REMATES-------------------------------------*/
	/* ----------------------FUNCIONES EDITAR,CANCELAR Y GUARDAR------------------------*/
		
	var td1,campo1,valor1,id1,nuevovalor1;
	var tipocampo1   = 0;
	var idlista1     = 0;
	
	
	$(document).on("click",".cancelar1",function(e)
	{
			e.preventDefault();
			td1.html("<span>"+valor1+"</span>");
			$("td:not(.id)").addClass("editable1");
			
			
	});
		

	$(document).on("click","td.editable1 span",function(e)
	{
	
			
			e.preventDefault();
			$("td:not(.id)").removeClass("editable1");
			td1        = $(this).closest("td");
			campo1     = $(this).closest("td").data("campo1");
			tipocampo1 = $(this).closest("td").data("tipocampo1");
			idlista1   = $(this).closest("td").data("idlista1");
			valor1     = $(this).text().trim();
			id1        = $(this).closest("tr").find(".id").text();
			
			/*alert(tipocampo);
			alert(campo);
			alert(valor);
			alert(id);*/
			
			//CAMPO DE TEXTO
			if(tipocampo1 == 1){
			
				td1.text("").html("<input type='text' name='"+campo1+"' value='"+valor1+"'><a class='enlace guardar1' href='#'>Guardar</a><a class='enlace cancelar1' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO DE SELECT 
			if(tipocampo1 == 4){
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				//var lista = "";
				
				//CLIENTE	
				/*if(idlista1 == 1){
						
					lista+="<select name='"+campo1+"' id='"+campo1+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Cliente</option>";
						
						
					$("#auto_clie option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar1' href='#'>Guardar</a><a class='enlace cancelar1' href='#'>Cancelar</a>";
						
					td1.text("").html(lista);
				}*/
				
				
				//ESTADO ESTADICO
				if(idlista1 == 2){
						
					td1.text("").html("<select name='"+campo1+"' id='"+campo1+"'><option value='' selected='selected'>Seleccionar Estado</option><option value='NO'>NO</option><option value='SI'>SI</option></select><a class='enlace guardar1' href='#'>Guardar</a><a class='enlace cancelar1' href='#'>Cancelar</a>");
				}
				
				
			}
			
			
			
			
	});
	
	
	$(document).on("click",".guardar1",function(e)
		{
			
			$(".mensajecli").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO Y FECHAS
			if(tipocampo1 == 1 || tipocampo1 == 2){
				nuevovalor1=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo1 == 4){
				nuevovalor1=$(this).closest("td").find(":selected").val();
			}
				
			if(nuevovalor1.trim()!="")
			{
				
				/*alert(tipocampo1);
				alert(campo1);
				alert(valor1);
				alert(nuevovalor1);
				alert(id1);*/
				
				var tabla = "documentos_internos";
				
				$.ajax({
					type: "POST",
					url: "views/popupbox/auto_edit_remates.php",
					data: { campo: campo1, valor: nuevovalor1, id:id1, tabla:tabla }
				})
				.done(function( msg ) {
					$(".mensajecli").html(msg);
					td1.html("<span>"+nuevovalor1+"</span>");
					$("td:not(.id)").addClass("editable1");
					setTimeout(
									function() {
										$('.ok,.ko').fadeOut('fast');
										
										//$(".btn_limpiar_ra").click();
										//location.href="index.php?controller=auto&action=Administrar_PQR";
										
										params={};
										params.dato_soli        = 0;
										
										//alert(params.eveasunto);
										$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
											//alert(2);
											$('#block').show();
											//alert(3);
											$('#popupbox').show();
											//alert(4);
										})
										
										

										
									}, 4000
								
							   );
					
					
					
					
					
					
				});
				
			}
			else $(".mensajecli").html("<p class='ko'>Debes ingresar un valor</p>");
		});
	
	/* ----------------------FIN FUNCIONES EDITAR,CANCELAR Y GUARDAR------------------------*/
	/*-------------------------------------FIN REMATES-------------------------------------*/
	
	
	
	
	
	
	  
});

</script>

	<style>
	.contenedor_acti{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
		table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
		<th {padding:5px; background-color:#CCCCCC;color:#000000}
		<!-- <th {padding:5px; background-color:#CDE3F9;color:#000000} --> 
		td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
			.editable1 span{display:block;}
			.editable1 span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
					
	
			td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
			a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
			a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
				.guardar1{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
				.cancelar1{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
				
				
		.checkboxrema{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}	
		
		.mensajecli{display:block;text-align:center;margin:0 0 20px 0}
			.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
			.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
	</style>

	<!-- Creamos un estilo para nuestro mensajes -->
	<style type="text/css">
	
		.mensage_cli{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensajecli debe estar oculto*/
		}
		
		.mensage_soli{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		
	</style>

	
	<form name ="form_lista_dinamica" id="form_lista_dinamica"  method="post" enctype="multipart/form-data" action=""> 
	
	
		<input type="hidden" name="datos_soli" id="datos_soli" readonly="true"/>
	
		<div class="buttonsBar">
		
			<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
			<!-- <button id="registrar" type="submit" name="boton_registrar" title="Registrar"><img src="images/imagenesbotones/save.png" width="25" height="25"/></button> -->
			
		</div>
	
		<table border="0" align="center">
		
		
			<!-- <tr> 
																			
				<td>
					
					<button type="submit" name="boton_registrar" id="boton_registrar" title="REGISTRAR" style="float:right "><img src="views/images/disk1.png" width="30" height="30"/></button> 
					
					
				</td>
								
			</tr> 
			
			<tr>
				<td align="center" colspan="2" style="width:180px; height:23px; border-color:#000000; font-size:16px ">ADICIONAR SERVIDOR JUDICAL</td><br><br>
			</tr> -->
			
			<tr>
				
												
				<td>
											
					<table align="center">
					
					
						<tr>
							<td bgcolor="#CDE3F9" colspan="2">
								<center>FILTROS</center>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">
								
								<a class="recargar_solicitud" href="javascript:void(0);" title="RECARGAR" style="float:right">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>
								</a>
						
								<a class="solicitud_pdf" href="javascript:void(0);" title="GENERAR PDF" style="float:right">
									<img src="views/images/archivo_3.png" width="25" height="25" title="GENERAR PDF"/>
								</a> 
								
								<a class="buscarxfiltro_solicitud" href="javascript:void(0);" title="CONSULTAR SOLICITUDES" style="float:right">
									<img src="views/images/lupa.png" width="25" height="25" title="CONSULTAR SOLICITUDES"/>
								</a>
								
										
							</td>
						</tr> 
						
						
						<tr>
												
												
							<td >
												
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px ">ID:</label><br>
														
								<input type="text" name="id_rema" id="id_rema" class="required number" style="text-align:right; border-style:groove" value="<?php echo trim($_POST['datox1']); ?>"/>
														
										
							</td>
							
							<td>
												
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:14px ">Radicado:</label><br>
														
								<input type="text" name="rad_rena" id="rad_rena" class="required number" maxlength="23" minlength="23" style="text-align:right; border-style:groove" value="<?php echo trim($_POST['datox2']); ?>"/>
														
										
							</td>
							
						</tr>
							
						
						<tr>
								
				
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Remate Inicial:</label><br>
								<input type="text" name="fechasoli_ri" id="fechasoli_ri" class="required" value="<?php echo trim($_POST['dato_1']); ?>">
							</td>
								
							<td>
									
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px ">Fecha Remate Final:</label><br>
								<input type="text" name="fechasoli_rf" id="fechasoli_rf" class="required" value="<?php echo trim($_POST['dato_2']); ?>">
							</td>
								
					
						</tr>
						
						<tr>
																					
							<td>
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Realizado:</label><br>			
								<select name="estadorema" id="estadorema">
										
										<?php 
											if ( !empty($datox3) ){
												
												if ( trim($datox3) == "NO" ){ ?>
												
													<option value="">Seleccionar Realizado</option> 
													<option value="NO" selected="selected">NO</option>
													<option value="SI">SI</option>
													
												<?php } 
												
												if ( trim($datox3) == "SI" ){ ?>
												
													<option value="">Seleccionar Realizado</option> 
													<option value="NO">NO</option>
													<option value="SI" selected="selected">SI</option>
													
												<?php } 
												
											}
											else{ ?>		
												<option value="" selected="selected">Seleccionar Realizado</option> 
												<option value="NO">NO</option> 
												<option value="SI">SI</option> 
										<?php } ?>	
														
								</select>
							</td>
							
				
							<td>
												
								<label style="width:180px; height:23px; border-color:#000000; color:#0066CC; font-size:14px">Juzgado:</label><br>			
								<select name="juzrema" id="juzrema">
												
										<option value="" selected="selected">Seleccionar Juzgado</option> 
															
										<?php	
										//LISTA JUZGADO
										$campo_a_mostrar  = 'nombre';
										$campo_a_insertar = 'id';
										$nombre_tabla     = 'juzgado_destino';
										$campo_filtro     = 'id';
										$valor_filtro     = "IN(1,2)";
										$campo_a_ordenar  = 'nombre';
										$iddatolista      = trim($_POST['datox4']);
										//$funcion->cargar_lista_con_filtro_LIKE($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										$funcion->cargar_lista_con_filtroX_seleccionada($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar,$iddatolista)
										?>
								</select>
							</td>
											
						</tr>
							
							
											
					</table>
					
				</td>	
				
				
			</tr> 
			
			<tr>
				<td colspan="2">
					<!-- MENSAJES -->
					<div class="mensage_soli"></div>  
				</td>
							
			</tr>
			
			
			<tr>
				
												
				<td>
					
					<div class="contenedor_acti">
					<div class="mensajecli"></div>							
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="display" id="tsoli">
																						
						<thead> 
							
							<tr>
								<th bgcolor="#CDE3F9" colspan="14">
									<center>
									  REMATES (J ---> JUZGADO  V ---> VISULAIZAR  R ---> REALIZADO)
									</center>
								</th>
							</tr>
																		
							<tr> 
								
								<th style="font-size:10px">ID</th>																						
								<th style="font-size:10px">PROCESO</th>
								<th style="font-size:10px">TIPO</th>
								<th style="font-size:10px">FECHA</th>
								<th style="font-size:10px">REGISTRA</th>
								<th style="font-size:10px">J</th>
								<th style="font-size:10px">V</th>
								<th style="font-size:10px">R</th>
								<th style="font-size:10px">AVISO</th>
								<th style="font-size:10px">OBS</th>
								
								
								
								<th style="font-size:10px">CHECK</th>
								
								
								<th>
												
									<!-- <a class="marcar_reparto" href="javascript:void(0);" title="Marcar todos"><img src="views/images/OK1.jpg" width="20" height="20" title="Marcar todos"/></a> -->
									<input type="checkbox" id="checkTodos" class="checkboxrema"/>Marcar/Desmarcar 
								</th>
											
								
								<th>
												
									<a class="aprobarsoli" href="javascript:void(0);" title="Aprobar"><img src="views/images/save.png" width="25" height="25" title="Aprobar"/></a>
								</th>
								
								<th>
												
									<a class="desaprobarsoli" href="javascript:void(0);" title="Des-Aprobar"><img src="views/images/apply.png" width="25" height="25" title="Des-Aprobar"/></a>
								</th>
						
							</tr>
							
						
						</thead>
						
						<tbody> 
						
						<?php
			
							//echo "<option value=\"". $datosdelit_4CF[0] ."\">" . $datosdelit_4CF[1] . "</option>";
							
							$Cr=1; 
							
							$il = 0;
																				
							while($il < $long_4F - 1){
																				
								$datosdelit_4CF = explode("******",$datosdelit_4BF[$il]); ?>
								
								<tr>
									
									<!-- <td style="font-size:10px "> -->
									<td style="font-size:10px " class='id'>
										<?php 
																													  
											echo $datosdelit_4CF[0];//idrema  
										?>
									</td>
																
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[1];//radicado  
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[2];//tipo  
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[3];//fecha  
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[4];//usuario que registra  
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
																													  
											echo $datosdelit_4CF[8];//juzgado 
										?>
									</td>
									
									<td style="font-size:10px ">
										<?php 
										
											//echo $datosdelit_4CF[7];//visualizar remate
											
											if($datosdelit_4CF[7] == 1){																		  
												echo "SI";
											}
											else{
												echo "NO";
											}
										?>
									</td>
									
									<td style="font-size:10px " class='editable1' data-campo1='realizarremate' data-tipocampo1=4 data-idlista1=2>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[6];//realizar remate  
										?>
										</span>
									</td>
									
									
									
									<!-- <td style="font-size:10px "> -->
										<?php 
																													  
											//echo $datosdelit_4CF[4];//usuario que registra  
										?>
									<!-- </td> -->
									
									
	
									<td>
									
										<a href='#' class='generar_pdf' data-id="<?php echo $datosdelit_4CF[0];?>"><img src="views/images/archivo_3.png" width="35" height="35" title="GENERAR AVISO DE REMATE"/></a>
										
									</td>
									
									<td>
									
										<a href='#' class='generar_obs' data-idrad="<?php echo $datosdelit_4CF[5];?>"><img src="views/images/ipdf3.png" width="35" height="35" title="GENERAR OBSERVACIONES DEL PROCESO"/></a>
										
									</td>
									
									
									
									<td>
										<input type="checkbox" name="<?php echo "chk".$Cr;?>" id="<?php echo "chk".$Cr;?>" value="<?php echo "chk".$Cr;?>" title="<?php echo "chk".$Cr;?>" class="checkboxrema"/>
									</td>	
									
									<td>-</td>
									
									<td>-</td>
									
									
									
								
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
				
				</td>
											
			</tr> 									 
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


