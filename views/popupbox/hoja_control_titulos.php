<?php 
session_start(); 

if($_SESSION['id']!=""){


include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

//OBTENEMOS LA FECHA ACTUAL
$fechaactual = $funcion->get_fecha_actual_amd();

$idUsuario      =  $_SESSION['idUsuario'];

$idhcet         = trim($_POST['idhcet']);//ID RADICADO
$radicadoidhcet = trim($_POST['radicadoidhcet']);//RADICADO

$idEhcet_2b     = trim($_POST['idEhcet_2b']);//ID LISTA DEL SELECT ID HOJA

//echo $idEhcet_2b;

$encabezado_hcet = $funcion->get_datos_encabezado_hcet($idhcet);

$encabezado_hcet_1 = explode("//////",$encabezado_hcet);

//echo $encabezado_hcet_1[0]."   ".$encabezado_hcet_1[1];

if($encabezado_hcet_1[1] == 1){

	$encabezado_hcet_2 = explode("******",$encabezado_hcet_1[0]);

	$dato_0hc = $encabezado_hcet_2[0];//ID ENCABEZADO
	$dato_1hc = $encabezado_hcet_2[1];//ID RADICADO
	$dato_2hc = $encabezado_hcet_2[2];//CAPITAL
	$dato_3hc = $encabezado_hcet_2[3];//I.CORRIENTES
	$dato_4hc = $encabezado_hcet_2[4];//INTERESES MORATORIOS
	$dato_5hc = $encabezado_hcet_2[5];//COSTAS
	$dato_6hc = $encabezado_hcet_2[6];
	$dato_7hc = $encabezado_hcet_2[7];
	$dato_8hc = $encabezado_hcet_2[8];
	
	//----------OBSERVACION------------------------
	$dato_9hc = $encabezado_hcet_2[9];
	
	$dato_10hc = $encabezado_hcet_2[10];//abono o titulos ya pagados
	

	$suma_total = $dato_2hc + $dato_3hc + $dato_4hc + $dato_5hc;
	
	$TOTAL      = $suma_total - $dato_10hc;
	
	
	
	$datosdelit_4F  = $funcion->get_datos_detalle_titulos($dato_0hc);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
	
	//echo $datosdelit_4F;
	
	$datosdelit_2B = explode("*/-*/-",$encabezado_hcet_1[0]);
	$long_1        = count($datosdelit_2B) - 1;
	
	
}
else{


	$datosdelit_2B = explode("*/-*/-",$encabezado_hcet_1[0]);
	$long_1        = count($datosdelit_2B) - 1;


}

$can_idhojas = $encabezado_hcet_1[1];

//idaccion = 25 ---> 38////8 ID USUARIOS QUE PUEDEN VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS 
//Y VER LA LISTA Usuario DE LA VISTA so_ticket.php DE LA CARPETA popupbox
$campos           = 'usuario';
$nombrelista      = 'pa_usuario_acciones';
$idaccion	      = '25';
$campoordenar     = 'id';
$datosusuarioSOLI = $funcion->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$usuariosaSOLI2	  = explode("////",$datosusuarioSOLI);


//SIN NO ESTA EL USUARIO EN SESION, NO ES UN USUARIO 
//QUE PUEDE VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS Y VER LA LISTA Usuario DE LA VISTA so_ticket.php DE LA CARPETA popupbox
//SOLO LAS SOLICITADAS POR EL
if ( !in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
	
	$id_filtro = $_SESSION['idUsuario'];
}


//SOLICITUDES, SIN FILTRO
//if( trim($_POST['id_filtro']) == 0){
if( trim($_POST['id_filtro']) == 10000){
	
	$datosdelit_4F  = $funcion->get_datos_SOLICITUDES($id_filtro);
	$datosdelit_4BF = explode("*/-*/-",$datosdelit_4F);
	$long_4F        = count($datosdelit_4BF);
	
}


//SOLICITUDES SEGUN FILTRO
//if( trim($_POST['id_filtro']) == 1){
if( trim($_POST['id_filtro']) == 10000){


	$datox1 = trim($_POST['datox1']);
	$datox2 = trim($_POST['datox2']);
	$datox3 = trim($_POST['datox3']);
	$datox4 = trim($_POST['datox4']);
	$datox5 = trim($_POST['datox5']);
	$datox6 = trim($_POST['datox6']);
	$datox7 = trim($_POST['datox7']);
	$datox8 = trim($_POST['datox8']);
	
	
	$datosdelit_4F  = $funcion->get_datos_SOLICITUDES_FILTRO($id_filtro,$datox1,$datox2,$datox3,$datox4,$datox5,$datox6,$datox7,$datox8);
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

		
		//var ipservidor = "127.0.0.1";

		//var ipservidor = "172.16.176.194";
		
		var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
		var ipservidor = ip_servidor;
	
		//var ipservidor = "190.217.24.24";

		 //-----------------------------------PARA QUE LAS FECHA SALGA EN ESPA�OL--------------------------------------------------------------------
		 $.datepicker.regional['es'] = {
		 closeText: 'Cerrar',
		 prevText: '< Ant',
		 nextText: 'Sig >',
		 currentText: 'Hoy',
		 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
		 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
		 dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
		 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S�'],
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
		$("#fechasri_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_m").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasri_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		$("#fechasrf_r").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
		
		
		$("#hcet6").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});


		$('#cancel').click( function(){
		
			//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
			//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
			$(document).off('click');
								  
        	$('#block').hide();
        	$('#popupbox').hide();
			
	
    	});
		
		
		
		$(".registrar_encabezado").click(function(evento){
		
			
			var validar = 0;
			var contador_punto = 0;
			
			var valor1 = $('#hcet1').val();
			var valor2 = $('#hcet2').val();
			var valor3 = $('#hcet3').val();
			var valor4 = $('#hcet4').val();
			
			var valor5 = $('#hcetobs').val();
			
			var valor6 = $('#atp').val();
			
			
			if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
			
				document.getElementById('hcet1').style.borderColor = '#FF0000';
			
				msg = "DEFINA CAPITAL";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			/*else{
			
			
				for (var i = 0; i< valor1.length; i++) {
				
					var caracter = valor1.charAt(i);
					
					if( caracter == ".") {
						
						contador_punto = contador_punto + 1
						
					}  
					
				}
				
				if(contador_punto > 1){
					
					alert("No Se Permite mas de un Punto");
					validar = 1;
					$('#hcet1').val('');
					return false;
				
						
				}
				
				
			}*/
			
			
			
			if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
			
				document.getElementById('hcet2').style.borderColor = '#FF0000';
			
				msg = "DEFINA I.CORRIENTES";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			/*else{
			
			
				for (var i = 0; i< valor2.length; i++) {
				
					var caracter = valor2.charAt(i);
					
					if( caracter == ".") {
						
						contador_punto = contador_punto + 1
						
					}  
					
				}
				
				if(contador_punto > 1){
					
					alert("No Se Permite mas de un Punto");
					validar = 1;
					$('#hcet2').val('');
					return false;
				
						

				}
				
				
			}*/
			
			
			
			if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
			
				document.getElementById('hcet3').style.borderColor = '#FF0000';
			
				msg = "DEFINA INTERESES MORATORIOS";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			/*else{
			
			
				for (var i = 0; i< valor3.length; i++) {
				
					var caracter = valor3.charAt(i);
					
					if( caracter == ".") {
						
						contador_punto = contador_punto + 1
						
					}  
					
				}
				
				if(contador_punto > 1){
					
					alert("No Se Permite mas de un Punto");
					validar = 1;
					$('#hcet3').val('');
					return false;
				
						
				}
				
				
			}*/
			
			
			
			if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
			
				document.getElementById('hcet4').style.borderColor = '#FF0000';
			
				msg = "DEFINA COSTAS";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			/*else{
			
			
				for (var i = 0; i< valor4.length; i++) {
				
					var caracter = valor4.charAt(i);
					
					if( caracter == ".") {
						
						contador_punto = contador_punto + 1
						
					}  
					
				}
				
				if(contador_punto > 1){
					
					alert("No Se Permite mas de un Punto");
					validar = 1;
					$('#hcet4').val('');
					return false;
				
						
				}
				
				
			}*/
			
			if( valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6) ) {
			
				document.getElementById('atp').style.borderColor = '#FF0000';
			
				msg = "DEFINA ABONO O TITULOS YA PAGADOS";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			
			if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
			
				document.getElementById('hcetobs').style.borderColor = '#FF0000';
			
				msg = "DEFINA OBSERVACION";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
  		
			}
			
			
			
			
			if(validar == 0){
			
				 
				
				if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
				
					
					var dataString = "";
					
					var data_encabezado = "";
					
					data_encabezado = $('#idhcet').val()+"//////"+$('#hcet1').val()+"//////"+$('#hcet2').val()+"//////"+$('#hcet3').val()+"//////"+$('#hcet4').val()+"//////"+$('#idEhcet').val()+"//////"+$('#hcetobs').val()+"//////"+$('#atp').val();
				
					//$('#datos_acti').val('');
					//$('#datos_acti').val(idspermisoRC2);
					
					dataString += '&datospartes='+data_encabezado;
					
					//alert(dataString);
				
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
					$.ajax({
						
						//url:'views/popupbox/subir.php', //Url a donde la enviaremos
						url:'index.php?controller=archivo&action=Registrar_Hoja_Control_Titulo',
						type:'POST', //Metodo que usaremos
						//contentType:false, //Debe estar en false para que pase el objeto sin procesar
						data:dataString, //Le pasamos el objeto que creamos con los archivos
						//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
						cache:false //Para que el formulario no guarde cache
					}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
						
						$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
						$('.mensage_acti').show('slow');//Mostramos el div.
						
						//DESAPARECER
						setTimeout(function() {
							
							$(".mensage_acti").fadeOut(1500);
							
							//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
							
							//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
							//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
							$(document).off('click');
							
							var idhcet         = $('#idhcet').val();
							var radicadoidhcet = $('#radihcet').val();
								
							
							params={};
							
							params.idhcet         = idhcet;
							params.radicadoidhcet = radicadoidhcet;
							
							
							
							//alert(params.eveasunto);
							$('#popupbox').load('views/popupbox/hoja_control_titulos.php',params,function(){
								//alert(2);
								$('#block').show();
								//alert(3);
								$('#popupbox').show();
								//alert(4);
							})
							
							
							
							
						},3000);
						
					
					});
					
					
				
				}
				
				
				
			}
			
			
								 
		});
		
		
		
		$("#ckenamemo").click(function(){
	
			if($("#ckenamemo").is(':checked')) {  
			
				//$('#fila_archivo').show();
				//$('#fila_botones').hide();
				
				$('#hcet1').val('');
				$('#hcet2').val('');
				$('#hcet3').val('');
				$('#hcet4').val('');
				
				//TOTAL OCULTO
				$('#hcet5').val('');
				//DATO VISUALIZADO FORMATEADO
				$('#hcet5b').val('');
				
				//ID ENCABEZADO A CERO, PARA QUE SE CREE UN NUEVO REGISTRO en el modelo funcion registrar_hoja_control_titulo()
				$('#idEhcet').val(0);
				
				$('#hcetobs').val('');
				
				$('#atp').val('');
				
				
				//$('#lid_encabezado').hide;
				//$('#id_encabezado').hide;
				
				$('#lista_idhojas').hide;
				
				
				//ELIMINAR TABLA DETALLE TITULOS
				var r;
				var cantidad_filas;
				var TABLA = document.getElementById('tsoli');
						
				cantidad_filas = TABLA.rows.length;
				
				for (r=1; r<cantidad_filas; r++){
						
					TABLA.deleteRow(r);
					cantidad_filas=TABLA.rows.length;
					r=1;
				}
					
				if(cantidad_filas>1){
					TABLA.deleteRow(1);
				}


	
	
			} 
			else {  
			
				//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
				//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
				$(document).off('click');
									  
				$('#block').hide();
				$('#popupbox').hide();
				
				
				var idhcet         = $('#idhcet').val();
				var radicadoidhcet = $('#radihcet').val();
								
							
				params={};
							
				params.idhcet         = idhcet;
				params.radicadoidhcet = radicadoidhcet;
							
							
				//alert(params.eveasunto);
				$('#popupbox').load('views/popupbox/hoja_control_titulos.php',params,function(){
					//alert(2);
					$('#block').show();
					//alert(3);
					$('#popupbox').show();
					//alert(4);
				})
				
				
				
			}  
		

		});
		
		
		$("#id_encabezado").change(function(event){
			
			
			
			var id_encabezado = $("#id_encabezado").find(':selected').val();
			//alert(id_encabezado);
			
			$('#idEhcet').val(id_encabezado);
			
			//ID ENCABEZADO TABLA hcet_encabezado, PARA CUANDO SE ACTUALIZE UN REGISTRO DE ABONO SE QUEDE EN ESE ID HOJA
			$('#idEhcet_2').val(id_encabezado);
			
			
			$.get('funciones/traer_datos_hcet.php?id_encabezado='+id_encabezado, function(cadena){
				
				//alert(cadena);
				
				var vector_idhect   = cadena.split("//////");
				
				var vector_idhect_2 = vector_idhect[0].split("******");
				
				
				
				$('#hcet1').val(vector_idhect_2[2]);
				$('#hcet2').val(vector_idhect_2[3]);
				$('#hcet3').val(vector_idhect_2[4]);
				$('#hcet4').val(vector_idhect_2[5]);
				
			
				//SUBTOTAL OCULTO
				$('#hcet5').val(vector_idhect[1]);
				
				//alert(vector_idhect[1]);
				
				//SUBTOTAL DATO VISUALIZADO FORMATEADO
				var num1 = number_format(vector_idhect[1], 2);
				$('#hcet5b').val(num1);
				
				
				$('#hcetobs').val(vector_idhect_2[9]);
				
				$('#atp').val(vector_idhect_2[10]);
				
				
				//TOTAL OCULTO
				$('#sub1').val(vector_idhect[3]);
				//TOTAL DATO VISUALIZADO FORMATEADO
				var num2 = number_format(vector_idhect[3], 2);
				$('#sub2').val(num2);
				
				
				
				
				var registro;
				var resultado_saldo = 0;
				
				
				var r;
				var cantidad_filas;
				var TABLA = document.getElementById('tsoli');
						
				cantidad_filas = TABLA.rows.length;
				
				for (r=1; r<cantidad_filas; r++){
						
					TABLA.deleteRow(r);
					cantidad_filas=TABLA.rows.length;
					r=1;
				}
					
				if(cantidad_filas>1){
					TABLA.deleteRow(1);
				}
				
				

				/* OBTENEMOS TABLA */
				$.ajax({
					type: "GET",
					url: "views/popupbox/hoja_control_titulose_cargar.php?tabla=1",
					data: { id_encabezado: id_encabezado }
				})
				.done(function(json) {
					
					json = $.parseJSON(json)
					
					for(var i=0;i<json.length;i++)
					{
						
							
						registro+="<tr>"
								
							registro+="<td class='id'>"+json[i].id+"</td>"
							registro+="<td class='editable_st' data-campo_st='fecha' data-tipocampo_st=2><span>"+json[i].fecha+"</span></td>"
							registro+="<td class='editable_st' data-campo_st='orderpago' data-tipocampo_st=1><span>"+json[i].orderpago+"</span></td>"
							registro+="<td class='editable_st' data-campo_st='valor' data-tipocampo_st=1><span>"+json[i].valor+"</span></td>"
							registro+="<td class='editable_st' data-campo_st='fechapago' data-tipocampo_st=2><span>"+json[i].fechapago+"</span></td>"
							registro+="<td class='editable_st' data-campo_st='beneficiario' data-tipocampo_st=1><span>"+json[i].beneficiario+"</span></td>"
							
							
							if(i == 0){
							
								//resultado_saldo = parseFloat($('#hcet5').val()) - parseFloat(json[i].valor);
								
								resultado_saldo = parseFloat($('#sub1').val()) - parseFloat(json[i].valor); 
								
							}
							else{
								
								resultado_saldo = parseFloat(resultado_saldo) - parseFloat(json[i].valor);
							}
							
							var num3 = number_format(resultado_saldo, 2);
							registro+="<td>"+num3+"</td>"
							
	
						registro+="</tr>"
							
							
						$('.editinplace').append(registro);
						
						registro = "";
					}
				});
				
				
				
				
				
				
			});
			
			
			
    	});
		
		
		
		
		$(".registrar_detalle_abono").click(function(evento){
		
			//PASOMOS VARIABLES PHP A JAVASCRIPT
			var sola_UNA = "<?php echo $sola_UNA; ?>";
		
			
			var dataString        = "";
			
			var idspermisoRC2     = "";
			var idspermiso_realC2 = 0;
			
			
			var fRC2 = 1;
			
			var d0RC2;
			

			var cantidad_filas_FRC2;
			var TABLA_FRC2 = document.getElementById('t_raC');
			
			cantidad_filas_FRC2 = TABLA_FRC2.rows.length;
			
			//alert(cantidad_filas_FR);
			
			//r ARRANCA EN r = 1 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
			//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
			for (r = 1; r < cantidad_filas_FRC2; r++){
				
				d0hRC2  = document.getElementById("t_raC").rows[r].cells[0].innerText;
				d1hRC2  = document.getElementById("t_raC").rows[r].cells[1].innerText;
				d2hRC2  = document.getElementById("t_raC").rows[r].cells[2].innerText;
				d3hRC2  = document.getElementById("t_raC").rows[r].cells[3].innerText;
				d4hRC2  = document.getElementById("t_raC").rows[r].cells[4].innerText;
				
				
				//if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						idspermisoRC2 = d0hRC2+"//////"+d1hRC2+"//////"+d2hRC2+"//////"+d3hRC2+"//////"+d4hRC2+"******"+idspermisoRC2;
						
						idspermiso_realC2 = 1;
						
						
						
				//}
				
				
				
					
				fRC2 = fRC2 + 1;
				
				
			}
			
			
			
			
			if(idspermiso_realC2 == 0){
			
				
				msg = "No se Cuenta con Ningun Registro en DETALLE TABLA ABONOS";
				$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_acti').show('slow');
				
				setTimeout(function() {
					$(".mensage_acti").fadeOut(4000);
				},10000);
				
				return false;
				
				
				
				
					
			}
			else{
			
				
				
				if( $('#id_encabezado').val() == null || $('#id_encabezado').val().length == 0 || /^\s+$/.test($('#id_encabezado').val()) ) {
				
					msg = "Defina ID HOJA";
					$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage_acti').show('slow');
					
					setTimeout(function() {
						$(".mensage_acti").fadeOut(4000);
					},10000);
					
					return false;
					
				}
				else{
				
				
					
					dataString += '&idhcet='+$("#idhcet").val();
					
					dataString += '&id_hoja='+$("#id_encabezado").find(':selected').val();
					
					
					if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
					
						$('#datos_acti').val('');
						$('#datos_acti').val(idspermisoRC2);
						
						dataString += '&datospartes='+$('#datos_acti').val();
						
						
						
						/*Ejecutamos la funci�n ajax de jQuery*/		
						$.ajax({
							
							//url:'views/popupbox/subir.php', //Url a donde la enviaremos
							url:'index.php?controller=archivo&action=Registrar_Detalle_Control_Titulo',
							type:'POST', //Metodo que usaremos
							//contentType:false, //Debe estar en false para que pase el objeto sin procesar
							data:dataString, //Le pasamos el objeto que creamos con los archivos
							//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
							cache:false //Para que el formulario no guarde cache
						}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
							
							$('.mensage_acti').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
							$('.mensage_acti').show('slow');//Mostramos el div.
							
							//DESAPARECER
							setTimeout(function() {
								
								$(".mensage_acti").fadeOut(1500);
								
								//location.href="index.php?controller=archivo&action=listarUbicacionExpediente";
								
								//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
								//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
								$(document).off('click');
								
								var idhcet         = $('#idhcet').val();
								var radicadoidhcet = $('#radihcet').val();
									
								
								params={};
								
								params.idhcet         = idhcet;
								params.radicadoidhcet = radicadoidhcet;
								
								
								
								//alert(params.eveasunto);
								$('#popupbox').load('views/popupbox/hoja_control_titulos.php',params,function(){
									//alert(2);
									$('#block').show();
									//alert(3);
									$('#popupbox').show();
									//alert(4);
								})
								
								
								
								
							},3000);
							
						
						});
						
						
						
					
					}
					
					
				}
				
				
			}
			
								 
		});
		
		
		
		
		
		


	   	$("#checkTodos").change(function () {
		  
		  $("input:checkbox").prop('checked', $(this).prop("checked"));//SE USA CON jquery_NV.js
		  
		  //$("input:checkbox").attr('checked', $(this).attr("checked"));
		  
		 
	   	});
		
		
		
		
		
		
		
		$('.generar_pdf').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var id = $(this).attr('data-id');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/laborales/views/PHPPdf/Reporte_Cartel.php?id="+id);
				
		});
		
		$('.generar_obs').click(function(evento){
			//$(".generarword").click(function(){
			
		
				var idrad = $(this).attr('data-idrad');
				
				//alert(id);
				

				window.open("http://"+ipservidor+"/laborales/views/tcpdf/HISTORIAL_PROCESO.php?id="+idrad);
				
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
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
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
					
					
					
					/*Ejecutamos la funci�n ajax de jQuery*/		
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
	
	
	
	/*$(".recargar_solicitud").click(function(){
								
		
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
		
			
		
	});*/
	
	
	
	
	
	
	$(".generarhect_pdf").click(function(){
	
		var todo           = 0;
		var id_encabezado  = 0;
		
		var idradi_reporte = $("#idhcet").val();
		var radi_reporte   = $("#radihcet").val();
		
	
		//TODAS LAS HOJAS DE CONTROL
		if( $('#id_encabezado').val() == null || $('#id_encabezado').val().length == 0 || /^\s+$/.test($('#id_encabezado').val()) ) {
				
			window.open("views/tcpdf/GENERAR_HCET.php?todo="+todo+"&id_encabezado="+id_encabezado+"&idradi_reporte="+idradi_reporte+"&radi_reporte="+radi_reporte);
		}
		//SOLO LA HOJA DE CONTROL SELECCIONADA
		else{
		
			todo          = 1;
			id_encabezado = $("#id_encabezado").find(':selected').val();
			
			window.open("views/tcpdf/GENERAR_HCET.php?todo="+todo+"&id_encabezado="+id_encabezado+"&idradi_reporte="+idradi_reporte+"&radi_reporte="+radi_reporte);
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
	
	
	
	
	/* FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
	
	//NOTA: PARA NO TENER INCONVENIRNTES CON TABLAS EDITABLES, YA QUE REMATES_SINAPROBAR.PHP
	//SE ABRE SOBBRE ARCHIVO_FILTRAR_UBICACION.PHP Y TIENE LAS MISMAS VARIABLES PARA EDITAR, CANCELAR Y GUARDAR
	//SIMPLEMENTE SE DEFINEN OTRAS VARIBALES
	
	<!-- st: sigla por solicitud tecnica -->
	
	var td_st,campo_st,valor_st,id_st,$rc_st,row_st,col_st,nuevovalor_st;
	var tipocampo_st     = 0;
	var idlista_st       = 0;
	
	var procesar_st      = 0;
    var solorespuesta_st = 0;
	var anular_st        = 0;
	
	var idX,fechaX,horaX,desX,userX,fechaRX,horaRX,respuestaX,estadoX;
	
	
	$(document).on("click",".cancelar_st",function(e)
	{
			e.preventDefault();
			td_st.html("<span>"+valor_st+"</span>");
			$("td:not(.id)").addClass("editable_st");
						
			
	});
		

	$(document).on("click","td.editable_st span",function(e)
	{
	
	
			e.preventDefault();
			$("td:not(.id)").removeClass("editable_st");
			td_st        = $(this).closest("td");
			campo_st     = $(this).closest("td").data("campo_st");
			tipocampo_st = $(this).closest("td").data("tipocampo_st");
			idlista_st   = $(this).closest("td").data("idlista_st");
			valor_st     = $(this).text().trim();//PARA LIMPIAR LOS ESPACIOS DE IZQUIERDA Y DERECHA
			id_st        = $(this).closest("tr").find(".id").text();
			
		
			//CAMPO DE TEXTO
			if(tipocampo_st == 1){
			
				td_st.text("").html("<input type='text' name='"+campo_st+"' value='"+valor_st+"'><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
			
			}
			
			//CAMPO FECHA
			if(tipocampo_st == 2){
				
				td_st.text("").html("<input type='text' id='"+campo_st+"' name='"+campo_st+"' value='"+valor_st+"' readonly='true'><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
				
				$("#fecha").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
				$("#fechapago").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_st == 3){
			
				
				td_st.text("").html("<textarea name='"+campo_st+"' cols='45' rows='5'>"+valor_st+"</textarea><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
			
			}
			
			
			
			//CAMPO DE SELECT 
			if(tipocampo_st == 4){
			
			
				//FORMA ORIGINAL Y ESTATICA
				//td.text("").html("<select name='"+campo+"' id='"+campo+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='SI'>SI</option><option value='NO'>NO</option></select><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
				
				
				//FORMA DINAMICA
				//var lista = "";
				
				//RESPONSABLE	
				/*if(idlista == 1){
						
					lista+="<select name='"+campo+"' id='"+campo+"'>";
					lista+="<option value='' selected='selected'>Seleccionar Responsable</option>";
						
						
					$("#listaC option").each(function(){
							
						if ($(this).val() != "" ){        
							 
							lista+="<option value="+$(this).val()+">"+$(this).text()+"</option>";
						}
					});
						 
						
					lista+="</select>";
					lista+="<a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>";
						
					td.text("").html(lista);
				}*/
				
				
				//ESTADO
				if(idlista_st == 2){
						
					td_st.text("").html("<select name='"+campo_st+"' id='"+campo_st+"'><option value='' selected='selected'>Seleccionar Opcion</option><option value='0'>EN PROCESO</option><option value='1'>TERMINADA</option><option value='3'>ANULADA</option></select><a class='enlace guardar_st' href='#'>Guardar</a><a class='enlace cancelar_st' href='#'>Cancelar</a>");
				}
				
				
			}
			
			
	});
	
	
	$(document).on("click",".guardar_st",function(e)
		{
		
			
			$(".mensaje").html("<img src='views/popupbox/images/loading.gif'>");
			e.preventDefault();
			
			//CAMPO DE TEXTO Y FECHAS
			if(tipocampo_st == 1 || tipocampo_st == 2){
				nuevovalor_st=$(this).closest("td").find("input").val();
			}
			
			//CAMPO DE TEXTAREA
			if(tipocampo_st == 3){
				nuevovalor_st=$(this).closest("td").find("textarea").val();
			}
			
			//CAMPO DE SELECT 
			if(tipocampo_st == 4){
				nuevovalor_st=$(this).closest("td").find(":selected").val();
			}
			
			
			//alert("campo: "+campo_st+" - "+"nuevovalor: "+nuevovalor_st+" - "+"tipocampo: "+tipocampo_st);
			
			
				
			if(nuevovalor_st.trim()!=""){
			
				/*alert(tipocampo);
				alert(campo);
				alert(valor);
				alert(nuevovalor);
				alert(id);*/
				
				
				
				
				
				//if(procesar_st == 1){
				
					//contador_st = 0;
				
					$.ajax({
					
						type: "POST",
						url: "views/popupbox/hoja_control_titulose_editar.php",
						//data: { campo: campo_st, valor: nuevovalor_st, id:id_st, solorespuesta:solorespuesta_st, anular:anular_st }
						
						data: { campo: campo_st, valor: nuevovalor_st, id:id_st }
						
					})
					.done(function( msg ) {
					
						$(".mensaje").html(msg);
						td_st.html("<span>"+nuevovalor_st+"</span>");
						$("td:not(.id)").addClass("editable_st");
						
						
						//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
						//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
						$(document).off('click');
					
						//setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 5000);
						
						 //OTRA FORMA DE VOLVER A LLAMAR LA VENTANA
						 //ESTA PARTE SE ANEXA PARA QUE VUELVA A LLAMAR LA VENTANA
					    //so_ticket.php
						//var cargar_solicitud = 1;
						//location.href="index.php?controller=archivo&action=listarUbicacionExpediente&cargar_solicitud="+cargar_solicitud;
						
						
						
						setTimeout(function() {
							
							$('.ok,.ko').fadeOut('fast');
							
							
							//SE LLAMA DE NUEVO LA VENTANA EMERGENTE
							
							//PASAMOS VARIABLES PHP A JAVASCRIPT
							//var id = "<?php echo $id_accion; ?>";
							
							var idhcet         = $('#idhcet').val();
							var radicadoidhcet = $('#radihcet').val();
							
							var idEhcet_2b     = $('#idEhcet_2').val();
								
							
							params={};
							
							params.idhcet         = idhcet;
							params.radicadoidhcet = radicadoidhcet;
							params.idEhcet_2b     = idEhcet_2b;
							
							
							
							//alert(params.eveasunto);
							$('#popupbox').load('views/popupbox/hoja_control_titulos.php',params,function(){
								//alert(2);
								$('#block').show();
								//alert(3);
								$('#popupbox').show();
								//alert(4);
							})
						
						
						}, 1000);
						
						
						
					});
					
				
				//}
				
				
			}
			else{ 
				
				//$(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>"); 
				
				$(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>"); //A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensaje').show('slow');
					
				setTimeout(function() {
					$(".mensaje").fadeOut(2000);
				},2000);
				
				
				
				
			}
			
			
			
		});
	
	/* FIN FUNCIONES EDITAR,CANCELAR Y GUARDAR*/
	
	
	
	$(".buscarxfiltro_SOLICITUD").click(function(){
								
		
		
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
			$('#block').hide();
        	$('#popupbox').hide();
			
		    datox1 = $('#idfiltros').val();
			datox2 = $('#fechasri_m').val();
			datox3 = $('#fechasrf_m').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			
		    
			//location.href="index.php?controller=auto&action=Busquedad_Filtro_CLIENTE&dato_0="+dato_0+"&datox1="+datox1+"&datox2="+datox2+"&datox3="+datox3+"&datox4="+datox4;
			
			
			//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
			//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
			$(document).off('click');
			
			
			params={};
			params.id_filtro = 1;
			params.datox1    = datox1;
			params.datox2    = datox2;
			params.datox3    = datox3;
			params.datox4    = datox4;
			params.datox5    = datox5;
			params.datox6    = datox6;
			params.datox7    = datox7;
			params.datox8    = datox8;
			
	
			//alert(params.eveasunto);
			$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
				//alert(2);
				$('#block').show();
				//alert(3);
				$('#popupbox').show();
				//alert(4);
			})
			

			
		}
		
	});
	
	$(".recargar_SOLICITUD").click(function(){
	
		
		//MATAMOS EL EVENTO click, PARA QUE EL SISTEMA NO GENERE INCOSISTENCIAS
		//AL MOMENTO DE GRABAR Y LLAMAR DE NUEVO LA VENTANA Y VOLVER A GRABAR
		$(document).off('click');
		
		params={};
		//params.id      = id;
		params.id_filtro = 0;
							
							
							
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/so_ticket.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		
							
	
	});
	
	$(".generar_excel_hcet").click(function(){
	
			opcion = 11000;
			
			var idradi_reporte = $("#idhcet").val();
			var radi_reporte   = $("#radihcet").val();
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&idradi_reporte="+idradi_reporte+"&radi_reporte="+radi_reporte;
			
	
	});
	
	
	$(".generar_excel").click(function(){
	
	
	
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 7000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro = "<?php echo $id_filtro; ?>";
			
			//alert(id_filtro);
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltros').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&id_filtro="+id_filtro;
			
		
		}
		
	
	});
	
	
	$(".generar_historial").click(function(){
	
	
	
		if( 
			
		   $('#idfiltros').val().length   == 0 &&
		   $('#fechasri_m').val().length  == 0 && 
		   $('#fechasrf_m').val().length  == 0 &&
		   $('#fechasri_r').val().length  == 0 && 
		   $('#fechasrf_r').val().length  == 0 &&
		   $('#listasr2').val().length    == 0 &&
		   $('#listasr3').val().length    == 0 &&
		   $('#gc_ac_2b').val().length    == 0 
		 
		) {
			
			alert("Definir Algun Filtro Para Realizar la Busquedad");
	
			document.getElementById('idfiltros').style.borderColor   =  '#FF0000';
			document.getElementById('fechasri_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_m').style.borderColor  =  '#FF0000';
			document.getElementById('fechasri_r').style.borderColor  =  '#FF0000';
			document.getElementById('fechasrf_r').style.borderColor  =  '#FF0000';
			document.getElementById('listasr2').style.borderColor    =  '#FF0000';
			document.getElementById('listasr3').style.borderColor    =  '#FF0000';
			document.getElementById('gc_ac_2b').style.borderColor    =  '#FF0000';
			
		}
		else{
			
			//alert("BUSCANDO...");
	
	
			opcion = 8000;
			
			//PASAMOS VARIABLES PHP A JAVASCRIPT
			var id_filtro = "<?php echo $id_filtro; ?>";
			
			//alert(id_filtro);
			
			//FECHAS REGISTRO
			dato_1 = $('#fechasri_m').val(); 
		    dato_2 = $('#fechasrf_m').val();
			
		
		    datox1 = $('#idfiltros').val();
			datox4 = $('#gc_ac_2b').val();
			datox5 = $('#fechasri_r').val();
			datox6 = $('#fechasrf_r').val();
			datox7 = $('#listasr2').val();
			datox8 = $('#listasr3').val();
			
			location.href="index.php?controller=archivo&action=ReporteExcel&opcion="+opcion+"&dato_1="+dato_1+"&dato_2="+dato_2+"&datox1="+datox1+"&datox4="+datox4+"&datox5="+datox5+"&datox6="+datox6+"&datox7="+datox7+"&datox8="+datox8+"&id_filtro="+id_filtro;
			
		
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


//********************************************************************************************
						//PARA EL MANEJO DE TABLA DETALLE ABONOS
						//ADICIONADO EL 10 DE MAYO 2020
//********************************************************************************************
var z_raC           = 1;
var Filas_raC       = 0;
//var cadena_fechas = " ";

function Adicionar_Abono(){
	
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
			
			//var dato1_raC = document.getElementById('listaC').value+"-"+$("#listaC option:selected").text();
			//var dato2_raC = document.getElementById('gc_ac_2').value;
			
			
			var thcet6  = document.getElementById('hcet6').value;
			var thcet7  = document.getElementById('hcet7').value;
			var thcet8  = document.getElementById('hcet8').value;
			var thcet9  = document.getElementById('hcet9').value;
			var thcet10 = document.getElementById('hcet10').value;
			
			
			
			
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
					
					
					tabla_raC+='<td>'+thcet6+'</td>';
					
					tabla_raC+='<td>'+thcet7+'</td>';
					
					tabla_raC+='<td>'+thcet8+'</td>';
					
					tabla_raC+='<td>'+thcet9+'</td>';
					
					tabla_raC+='<td>'+thcet10+'</td>';
					
					
					
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
					
				
					tabla_raC+='<td>'+thcet6+'</td>';
					
					tabla_raC+='<td>'+thcet7+'</td>';
					
					tabla_raC+='<td>'+thcet8+'</td>';
					
					tabla_raC+='<td>'+thcet9+'</td>';
					
					tabla_raC+='<td>'+thcet10+'</td>';
					
					
					
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
	

	valor1 = document.getElementById('hcet6').value;
	valor2 = document.getElementById('hcet7').value;
	valor3 = document.getElementById('hcet8').value;
	valor4 = document.getElementById('hcet9').value;
	valor5 = document.getElementById('hcet10').value;
	
	

	if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
  		
		alert("Defina Fecha Emision");
		document.getElementById('hcet6').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Orden de Pago Numero");
		document.getElementById('hcet7').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Valor Total");
		document.getElementById('hcet8').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Beneficiario");
		document.getElementById('hcet10').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	
	
	
	
	

}

function Limpiar_Campos_3_RAC(){
	
	
	
	document.getElementById('hcet6').value = "";
	document.getElementById('hcet6').style.borderColor='#E0E0E0';
	
	document.getElementById('hcet7').value = "";
	document.getElementById('hcet7').style.borderColor='#E0E0E0';
	
	
	document.getElementById('hcet8').value = "";
	document.getElementById('hcet8').style.borderColor='#E0E0E0';
	
	//document.getElementById('hcet9').value = "";
	//document.getElementById('hcet9').style.borderColor='#E0E0E0';
	
	document.getElementById('hcet10').value = "";
	document.getElementById('hcet10').style.borderColor='#E0E0E0';
	
	/*document.getElementById('hcet10').selectedIndex = 0;
	document.getElementById('hcet10').style.borderColor='#E0E0E0';*/
	
	
	
	
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
						//FIN PARA EL MANEJO DE TABLA DETALLE ABONOS
//********************************************************************************************

// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {


   for (var i = 0; i < cadenaCompleta.length; i++) {
      if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
         cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
      }
   }
   return cadenaCompleta;
}



function Solo_Numeros(e){
	
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}

function Solo_Numeros_y_Punto(e){
	
	var key = window.Event ? e.which : e.keyCode
	return ( (key >= 48 && key <= 57) || key == 46)
}

//DAR FORMATO A NUMERO 1.000.000,00
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join(',');
}


</script>

	<style>
	.contenedor_acti_st{margin:60px auto;width:900px;font-family:sans-serif;font-size:15px}
	table {width:100%;box-shadow:0 0 10px #ddd;text-align:left}
	<!-- th {padding:5px; background-color:#555;color:#fff} -->
	th {padding:5px; background-color:#CDE3F9;color:#000000}
	td {padding:5px;border:solid #ddd;border-width:0 0 1px;}
		.editable_st span{display:block;}
		.editable_st span:hover {background:url(views/popupbox/images/edit.png) 90% 50% no-repeat;cursor:pointer}
				

		td input{height:24px;width:200px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}
		a.enlace{display:inline-block;width:24px;height:24px;margin:0 0 0 5px;overflow:hidden;text-indent:-999em;vertical-align:middle}
		a.enlace{width:24px;height:24px;margin:0 0 0 5px;text-indent:-999em;vertical-align:middle}
			.guardar_st{background:url(views/popupbox/images/save.png) 0 0 no-repeat}
			.cancelar_st{background:url(views/popupbox/images/cancel.png) 0 0 no-repeat}
			
			
	.checkbox110{height:12px;width:15px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle;}
	
	.ckenamemoestilo{height:15px;width:18px;border:1px solid #ddd;padding:0 5px;margin:0;border-radius:6px;vertical-align:middle}	
	
	.mensaje{display:block;text-align:center;margin:0 0 20px 0}
		.ok{display:block;padding:10px;text-align:center;background:green;color:#fff}
		.ko{display:block;padding:10px;text-align:center;background:red;color:#fff}
	</style>

	<!-- Creamos un estilo para nuestro mensajes -->
	<style type="text/css">
	
	
		.mensage_acti{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
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

	
	<form name ="frm_RAC" id="frm_RAC"  method="post" enctype="multipart/form-data" action=""> 
	
	
		<input type="hidden" name="datos_acti" id="datos_acti" readonly="true"/>
	
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
			
			
			<!-- <tr>
				<td colspan="2">
					
					<div class="mensage_acti"></div>  
				</td>
							
			</tr> -->
			
			<tr>
				
												
				<td>
											
					<table align="center">
					
						<tr>
							<th bgcolor="#CDE3F9" colspan="2">
								<center style="font-size:16px">HOJA CONTROL DE ENTREGA DE TITULOS</center>
							</th>
						</tr>	
						
						<tr>
							<th bgcolor="#CDE3F9" colspan="2">
								<center style="font-size:16px">ENCABEZADO</center>
							</th>
						</tr>	
					
						<tr>
							<td colspan="2">
								
						
								
								
								<a class="generarhect_pdf" href="javascript:void(0);" title="GENERAR HOJA DE CONTROL DE ENTREGA DE TITULOS" style="float:right">
									<img src="views/images/hcet1.jpg" width="100" height="100" style="float:right" title="GENERAR HOJA DE CONTROL DE ENTREGA DE TITULOS"/>
								</a> 
								
								<a class="generar_excel_hcet" href="javascript:void(0);" title="GENERAR EXCEL" style="color:#0066CC;">
									<img src="views/images/excel_1.jpg" width="100" height="100" style="float:right" title="GENERAR EXCEL"/>
								</a> 
								
								
							</td>
						</tr> 
						
						
						
						
						<tr>
							<td colspan="2">
							
								
								<!-- ID ENCABEZADO TABLA hcet_encabezado, PARA FUNCIONES DE ACTUALIZAR -->
								<input type="hidden" id="idEhcet" name="idEhcet" value="<?php echo $dato_0hc; ?>" readonly="true" style="width:240px; height:23px; border-color:#000000; color:#FF0000; font-size:16px"/>
								
								
								<!-- ID ENCABEZADO TABLA hcet_encabezado, PARA CUANDO SE ACTUALIZE UN REGISTRO DE ABONO SE QUEDE EN ESE ID HOJA -->
								<input type="hidden" id="idEhcet_2" name="idEhcet_2" value="<?php echo $dato_0hc; ?>" readonly="true" style="width:240px; height:23px; border-color:#000000; color:#FF0000; font-size:16px"/>
								
								
								
								<!-- ID RADICADO -->
								<input type="hidden" id="idhcet" name="idhcet" value="<?php echo $idhcet; ?>" readonly="true" style="width:240px; height:23px; border-color:#000000; color:#FF0000; font-size:16px"/>
						
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:16px">RADICADO:</label>
								<input type="text" id="radihcet" name="radihcet" value="<?php echo $radicadoidhcet; ?>" readonly="true" style="width:240px; height:23px; border-color:#000000; color:#FF0000; font-size:16px"/>
								
							</td>
						</tr> 
						
						<tr>
							
							
							
							<td id="lista_idhojas">
								<label id="lid_encabezado" style="width:180px; height:23px">ID Hoja(s) <?php echo $can_idhojas; ?>:</label><br>
								<br><select name="id_encabezado" id="id_encabezado" style="width:150px; height:25px">
									<option value="">Seleccione ID</option>
									<?php 
															
										
										
											$il = 0;
																
											while($il < $long_1){
																
												$datosdelit_2C = explode("******",$datosdelit_2B[$il]);
												
												//if($idEhcet_2b == $datosdelit_2C[0]){
												
													//echo "<option value=\"".$datosdelit_2C[0] ."\" selected='selected'>" . $datosdelit_2C[0] . "</option>";
												//}
												//else{
																
													echo "<option value=\"".$datosdelit_2C[0] ."\">" . $datosdelit_2C[0] . "</option>";
													
												//}
																	
												$il = $il + 1;
												
												
											}
											
										
															
									?>
								</select>
												  
								
							</td>
							
							<td>
								
								<label style="width:80px; height:13px">Nueva Hoja:</label><br>
								<br><input type="checkbox" name="ckenamemo" id="ckenamemo" class="ckenamemoestilo"/>
								
							</td>
							
						</tr> 
						
						
						<tr>
							<td colspan="2">
								
								<a class="registrar_encabezado" href="javascript:void(0);"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR / EDITAR ENCABEZADO"/></a>
								
								
							
							</td>
						</tr> 
						
						
						<tr>
							<td colspan="2">
								<!-- MENSAJES -->
								<div class="mensage_acti"></div>  
							</td>
										
						</tr>
						
						
						
						<tr>
							<!-- onKeyPress="return Solo_Numeros_y_Punto(event)" -->
							<td>
								<label style="width:180px; height:23px; font-size:14px">CAPITAL:</label><br>
								<br><input type="text" name="hcet1" id="hcet1" value="<?php echo $dato_2hc; ?>" onKeyPress="return Solo_Numeros_y_Punto(event)" style="font-size:12px; text-align:right"/>
							</td>
							
							
											
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px">OBSERVACION:</label><br>
								<br><textarea id="hcetobs" name="hcetobs" cols="50" rows="5"><?php echo $dato_9hc; ?></textarea>
							</td>
										
						</tr>
										
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; font-size:14px">I.CORRIENTE:</label><br>
								<br><input type="text" name="hcet2" id="hcet2" value="<?php echo $dato_3hc; ?>" onKeyPress="return Solo_Numeros_y_Punto(event)" style="font-size:12px; text-align:right"/>
							</td>
										
						</tr>
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:33px; font-size:14px">INTERESES MONATORIOS:</label><br>
								<br><input type="text" name="hcet3" id="hcet3" value="<?php echo $dato_4hc; ?>" onKeyPress="return Solo_Numeros_y_Punto(event)" style="font-size:12px; text-align:right"/>
							</td>
										
						</tr>
						
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:23px; font-size:14px">COSTAS:</label><br>
								<br><input type="text" name="hcet4" id="hcet4" value="<?php echo $dato_5hc; ?>" onKeyPress="return Solo_Numeros_y_Punto(event)" style="font-size:12px; text-align:right"/>
							</td>
										
						</tr>
						
						
						<tr>
											
							<td colspan="2">
								<label style="color:#FF0000; width:180px; height:23px; font-size:14px">SUBTOTAL:</label><br>
								<br><input type="hidden" name="hcet5" id="hcet5" value="<?php echo $suma_total; ?>" style="font-size:12px; text-align:right" readonly="true"/>
								<br><input type="text" name="hcet5b" id="hcet5b" value="<?php echo number_format($suma_total, 2, ',', '.'); ?>" style="font-size:12px; text-align:right" readonly="true"/>
							</td>
										
						</tr>
						
						
						
						<tr>
											
							<td colspan="2">
								<label style="width:180px; height:33px; font-size:14px">ABONO O TITULOS YA PAGADOS:</label><br>
								<br><input type="text" name="atp" id="atp" value="<?php echo $dato_10hc; ?>" onKeyPress="return Solo_Numeros_y_Punto(event)" style="font-size:12px; text-align:right"/>
							</td>
										
						</tr>
						
						
						<tr>
											
							<td colspan="2">
								<label style="color:#FF0000; width:180px; height:23px; font-size:14px">TOTAL:</label><br>
								<br><input type="hidden" name="sub1" id="sub1" value="<?php echo $TOTAL; ?>" style="font-size:12px; text-align:right" readonly="true"/>
								<br><input type="text" name="sub2" id="sub2" value="<?php echo number_format($TOTAL, 2, ',', '.'); ?>" style="font-size:12px; text-align:right" readonly="true"/>
							</td>
										
						</tr>
						
						
					</table>
					
				</td>	
				
				
			</tr> 
			
			<tr>
				<td colspan="2">
					<!-- MENSAJES -->
					<div class="mensage_acti"></div>  
				</td>
							
			</tr>
			
			<tr>
				<th bgcolor="#CDE3F9" colspan="2">
					<center style="font-size:16px">DETALLE TABLA ABONOS</center>
				</th>
			</tr>	
			
			
			<tr>
				<td colspan="2">
								
					<img src="views/images/new3.jpg" width="25" height="25" title="ADICIONAR ABONO" onClick="Adicionar_Abono()"/>
					<a class="registrar_detalle_abono" href="javascript:void(0);"><img src="views/images/save.png" width="25" height="25" title="REGISTRAR ABONO"/></a>
								
				</td>
			</tr> 
			
			
			
			<tr>
												
				
				<td colspan="2">
				
					<label style="width:180px; height:23px; font-size:14px">Fecha Emision:</label><br>
					<br><input type="text" name="hcet6" id="hcet6">
					
					<br><label style="width:180px; height:23px; font-size:14px">Orden de Pago Numero:</label><br>
					<br><input type="text" name="hcet7" id="hcet7">
					
					<br><label style="width:180px; height:23px; font-size:14px">Valor Total:</label><br>
					<br><input type="text" name="hcet8" id="hcet8">
					
					<br><label style="width:180px; height:23px; font-size:14px">Fecha Entrega:</label><br>
					<br><input type="text" name="hcet9" id="hcet9" value="0000-00-00" readonly="true">
					
					<br><label style="width:180px; height:23px; font-size:14px">Beneficiario:</label><br>
					<br><input type="text" name="hcet10" id="hcet10">
					
				</td>
													
				
			</tr>
										
							
			<tr>
							
				<td colspan="2">
						
									<table>
	
										<tr>
											<td>
												<div id="cont_raC"> 
													<table id="t_raC" border="1"> 
														<tr>
															
															
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FECHA EMISION</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">ORDEN DE PAGO NUMERO</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">VALOR TOTAL</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">FECHA ENTREGA</strong>
															</td>
															
															<td>
																<strong style="font-size:10px; color:#0066CC">BENEFICIARIO</strong>
															</td>
															
															
															<td>
																<strong style="font-size:10px; color:#0066CC">ELIMINAR</strong>
															</td>
															
														</tr> 
													</table>
												</div>
											</td>
											
										</tr>
										
										
									</table>
						
				</td>
							
			</tr>
			
			
			
			
			
			
			<!-- PARA BUSQUEDAD DE SOLICITUDES -->
			
			
			
			<!-- <tr>
							
				<td colspan="2">
				
					<table>
					
						<tr>
							<th bgcolor="#CDE3F9" colspan="4">
								<center style="font-size:16px">FILTRO TABLA ABONOS</center>
							</th>
						</tr>	
						
						
						<tr>
						
							<td colspan="4">
							
								<a class="buscarxfiltro_SOLICITUD" href="javascript:void(0);" title="BUSCAR SOLICITUD" style="color:#0066CC">
									<img src="views/images/lupa.png" width="25" height="25" title="BUSCAR SOLICITUD"/>BUSCAR SOLICITUD 
								</a>
								
								<a class="recargar_SOLICITUD" href="javascript:void(0);" title="RECARGAR" style="color:#0066CC">
									<img src="views/images/recargar1.png" width="25" height="25" title="RECARGAR"/>RECARGAR
								</a>
								
								<a class="generar_excel" href="javascript:void(0);" title="GENERAR EXCEL" style="color:#0066CC;">
									<img src="views/images/excel_1.jpg" width="25" height="25" title="GENERAR EXCEL"/>GENERAR EXCEL
								</a> 
								
								<a class="generar_historial" href="javascript:void(0);" title="ENERAR HISTORAL SOLICITUD" style="color:#0066CC;">
									<img src="views/images/exceltitulos.png" width="25" height="25" title="ENERAR HISTORAL SOLICITUD"/>GENERAR HISTORAL SOLICITUD
								</a> 
														
								
							</td>
											
						</tr>
						
						
	
						<tr>
						
							<td>
								<label style="width:180px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">ID:</label><br>
							</td>
										
							<td colspan="3">
								<input type="text" name="idfiltros" id="idfiltros" style="color:#FF0000; font-size:12px" value="<?php //echo trim($_POST['datox1']); ?>"/>
							</td>
						
			
						</tr>
						
						<tr>
												
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Inicial:</label>
							</td>
							<td>
								<input type="text" name="fechasri_m" id="fechasri_m" value="<?php //echo trim($_POST['datox2']); ?>">
							</td>
													
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Registro Final:</label>
							</td>
							<td>
								<input type="text" name="fechasrf_m" id="fechasrf_m" value="<?php //echo trim($_POST['datox3']); ?>">
							</td>
													
																	
						</tr>
						
						<tr>
												
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Respuesta Inicial:</label>
							</td>
							
							<td>
								<input type="text" name="fechasri_m" id="fechasri_r" value="<?php //echo trim($_POST['datox5']); ?>">
							</td>
													
							<td>
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Fecha Respuesta Final:</label>
							</td>
							
							<td>
								<input type="text" name="fechasrf_m" id="fechasrf_r" value="<?php //echo trim($_POST['datox6']); ?>">
							</td>
													
																	
						</tr>
						
						
						
						<tr>
																					
							<td colspan="4">
												
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Usuario:</label><br>			
								<select name="listasr2" id="listasr2">
												
										<option value="" selected="selected">Seleccionar Usuario</option> 
															
										<?php	
										//LISTA RESPONSABLE
										
										/*if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
										
											$campo_a_mostrar  = 'empleado';
											$campo_a_insertar = 'id';
											$nombre_tabla     = 'pa_usuario';
											$campo_filtro     = 'nombre_usuario';
											$valor_filtro     = "NOT LIKE '%D%'";
											$campo_a_ordenar  = 'empleado';
											$datosRES         = $funcion->cargar_lista_con_filtro_LIKE($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										}
										else{
										
											$campo_a_mostrar  = 'empleado';
											$campo_a_insertar = 'id';
											$nombre_tabla     = 'pa_usuario';
											$campo_filtro     = 'id';
											$valor_filtro     = $_SESSION['idUsuario'];
											$campo_a_ordenar  = 'empleado';
											$datosRES         = $funcion->cargar_lista_con_filtro($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_filtro,$valor_filtro,$campo_a_ordenar);
										
										}*/
										
										?>
								</select>
							</td>
						
						</tr>
						
						<tr>
							
							<td colspan="4">
												
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px ">Estado:</label><br>			
								<select name="listasr3" id="listasr3">
												
										<option value="" selected="selected">Seleccionar Estado</option> 
										<option value="0">EN PROCESO</option> 
										<option value="1">TERMINADA</option>
										<option value="2">ANULADA</option> 
															
										
								</select>
							</td>
											
						</tr>
						
						<tr>
											
							<td colspan="4">
								<label style="width:180px; height:23px; border-color:#000000; font-size:12px">Descripcion Solicitud:</label><br>
								<textarea id="gc_ac_2b" name="gc_ac_2b" cols="50" rows="5"><?php //echo trim($_POST['datox4']); ?></textarea>
							</td>
										
						</tr>
						
					</table>
						
				</td>
				
			</tr> -->
			
			<?php
			
			//idaccion = 25 ---> 38////8 ID USUARIOS QUE PUEDEN VER TODAS LAS SOLICITUDES DE SOPORTE TECNICO DE USUARIOS 
			//Y VER LA TABLA DE SOLICITUDES EDITABLES DE LA VISTA so_ticket.php DE LA CARPETA popupbox

			//if ( in_array($_SESSION['idUsuario'],$usuariosaSOLI2,true) ){
			
			?>
			
			<tr>
				
												
				<td>
					
					<div class="contenedor_acti_st">
					<div class="mensaje"></div>						
					<table cellpadding="0" cellspacing="0" rules="rows" border="1" class="editinplace" id="tsoli">
																						
						<thead> 
							
							<!-- <tr>
								<th bgcolor="#CDE3F9" colspan="7">
									<center>ABONOS</center>
								</th>
							</tr> -->
																		
							<tr> 
							
						
								
								<th style="font-size:10px">ID</th>																						
								<th style="font-size:10px">FECHA EMSISON</th>
								<th style="font-size:10px">ORDEN DE PAGO NUMERO</th>
								<th style="font-size:10px">VALOR TOTAL</th>
								<th style="font-size:10px">FECHA ENTREGA</th>
								<th style="font-size:10px">BENEFICIARIO</th>
								<th style="font-size:10px">SALDO</th>
								
						
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
									
									
									<td style="font-size:10px " class='id'>
									
									
									<?php 
																													  
										echo $datosdelit_4CF[0];//id 
										 
									?>
										
									</td>
																
									
									<td style="font-size:10px " class='editable_st' data-campo_st='fecha' data-tipocampo_st=2>
									<!-- <td style="font-size:10px "> --> 
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[1];//fecha 
										?>
										</span>
									</td>
									
									<td id="respuesta" style="font-size:10px " class='editable_st' data-campo_st='orderpago' data-tipocampo_st=1>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[2];//orderpago
										?>
										</span>
										<!-- <input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta  -->
									</td>
									
									
									<td id="respuesta" style="font-size:10px " class='editable_st' data-campo_st='valor' data-tipocampo_st=1>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[3];//valor
										?>
										</span>
										<!-- <input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta  -->
									</td>
									
									
									<td style="font-size:10px " class='editable_st' data-campo_st='fechapago' data-tipocampo_st=2>
									<!-- <td style="font-size:10px "> --> 
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[4];//fechapago
										?>
										</span>
									</td>
									
									
									<td id="respuesta" style="font-size:10px " class='editable_st' data-campo_st='beneficiario' data-tipocampo_st=1>
										<span>
										<?php 
																													  
											echo $datosdelit_4CF[5];//beneficiario
										?>
										</span>
										<!-- <input type="checkbox" id="checkRespuesta" class="checkbox110" title="SI SOLO SE DESEA MODIFICAR LA RESPUESTA, ACTIVAR CASILLA, PARA QUE EL SISTEMA SOLO ACTUALICE LA RESPUESTA Y NO LA FECHA, HORA Y ESTADO"/>Modificar Respuesta  -->
									</td>
									
									<td>
										<?php
										
											//$resultado_saldo = 0;
											
											
											if($il == 0){
										
												//$resultado_saldo =  $suma_total - $datosdelit_4CF[3];
												
												$resultado_saldo =  $TOTAL - $datosdelit_4CF[3];
											}
											else{
											
												$resultado_saldo =  $resultado_saldo - $datosdelit_4CF[3];
											
											}
											
											
											
											echo number_format($resultado_saldo, 2, ',', '.'); 
										
										?>
										
									</td>
							
								
								</tr>
																									
																												
							<?php $il = $il + 1; $Cr= $Cr + 1; } ?>	
						
							</tbody> 	
					
					</table>	
					</div>
					
				</td>
											
			</tr> 
				
			<?php
			//}
			?>
			
		
		</table>
		
	
	</form>
	
	
	
	
	
	

<?php  } ?>


