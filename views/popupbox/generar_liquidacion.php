<?php 
session_start(); 

if($_SESSION['id']!=""){

include_once('Funciones.php');
//instanciamos la clase Funciones.php con la variable $funcion
$funcion = new Funciones();

$valor_id       = trim($_POST['valor_id']);
$valor_radicado = trim($_POST['valor_radicado']);

//ITEMS COSTAS
$datos_liquidaciones = $funcion->get_liquidaciones_costas($valor_id);

$ip_plataforma = trim($_SESSION['ipplataforma']);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

	
<script type="text/javascript">

	
	var ip_servidor    = "<?php echo $ip_plataforma ; ?>";
	
	var ipservidor = ip_servidor;
		
	//var ipservidor = "190.217.24.24";
	
	$("#fecha_liqui_a").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	$("#fecha_estado").datepicker({ changeFirstDay: false, dateFormat: 'yy-mm-dd'	});
	
	
	$('#cancel').click( function(){

		
        $('#block').hide();
        $('#popupbox').hide();
		
		
	});
	
	
	
	<!-- CLIC BOTON CAMBIAR FECHA LIQUIDACION -->
	$('#cambiofecha_liqui').click(Cambio_Fecha_Liquidacion);
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON ANULAR LIQUIDACION -->
	function Cambio_Fecha_Liquidacion(){	
	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		var idspermiso="";
				
		var f = 1;
				
		var d0x;
				
		var cantidad_filas_F;
		var TABLA_F = document.getElementById('tabla_liqui');
				
		cantidad_filas_F = TABLA_F.rows.length;
				
		
		//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
		for (r = 6; r < cantidad_filas_F; r++){
					
			//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
			if($("#chk"+f).is(':checked')) {  
						
				//alert("ENTRE");
				
				d0x  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
		
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = d0x+","+idspermiso;
			}
						
			f = f + 1;
					
					
		}
				
				
			
		if(idspermiso == ""){
					
			//alert("No Seleciono Ningun Liquidacion");
			validar = 1;
			
			msg = "No Selecciono Ninguna Liquidacion";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;
					
				
		}
		else{
		
			$('#idliqui').val(d0x);

			dataString += '&idliqui='+$('#idliqui').val();
		}
		
		if( $('#fecha_liqui_a').val() == null || $('#fecha_liqui_a').val().length == 0 || /^\s+$/.test( $('#fecha_liqui_a').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('fecha_liqui_a').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA FECHA";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&fecha_liqui_a='+$('#fecha_liqui_a').val();
		}
	
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
				
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=liquidaciones2&action=Cambiar_Fecha_Liquidacion',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				MensajeFinal(msg)
			});
		
		}
		
	}
	
	
	
	
	
	
	
	<!-- CLIC BOTON ANULAR LIQUIDACION -->
	$('#anular_liqui').click(Anular_Liquidacion);
	
	
	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON ANULAR LIQUIDACION -->
	function Anular_Liquidacion(){	
	
		//alert(1);
		
		var validar = 0;
	
		var dataString = "";
		
		var idspermiso="";
				
		var f = 1;
				
		var d0x;
				
		var cantidad_filas_F;
		var TABLA_F = document.getElementById('tabla_liqui');
				
		cantidad_filas_F = TABLA_F.rows.length;
				
		
		//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
		for (r = 6; r < cantidad_filas_F; r++){
					
			//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
			if($("#chk"+f).is(':checked')) {  
						
				//alert("ENTRE");
				
				d0x  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
				d3x  = document.getElementById("tabla_liqui").rows[r].cells[3].innerText;
							
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = d0x+","+idspermiso;
			}
						
			f = f + 1;
					
					
		}
				
				
			
		if(idspermiso == ""){
					
			//alert("No Seleciono Ningun Liquidacion");
			validar = 1;
			
			msg = "No Selecciono Ninguna Liquidacion";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;
					
				
		}
		else{
		
			var identificadorcampo1 = d3x.indexOf('ANULADA');
		
			//if(d3x == "ANULADA"){
			if(identificadorcampo1 >= 0){
			
			
				validar = 1;
				
				msg = "LIQUIDACION YA FUE ANULADA, LIQUIDACION NUMERO: "+d0x;
				$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage_validar').show('slow');
			
				setTimeout(function() {
					$(".mensage_validar").fadeOut(1500);
				},5000);
			
				return false;
			
			}
			else{
			
				$('#idliqui').val(d0x);

				dataString += '&idliqui='+$('#idliqui').val();
			}
		}
		
		
		
		if( $('#observacionsr_anu').val() == null || $('#observacionsr_anu').val().length == 0 || /^\s+$/.test( $('#observacionsr_anu').val() ) ){
				
			//alert("Definir Radicado");
			document.getElementById('observacionsr_anu').style.borderColor='#FF0000';
			validar = 1;
			
			msg = "DEFINA LA NOTA DE ANULACION, EL POR QUE VA ANULARSE LA LIQUIDACION";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			dataString += '&observacionsr_anu='+$('#observacionsr_anu').val();
		}
		
		
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			
			//VARIABLE QUE ME CONTROLA SI SE VA A REGISTRAR O EDITAR 
			//var ID_MODI = $('#id_modificar').val();
		
			//ANULAR
			
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
				
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=liquidaciones2&action=Anular_Liquidacion',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				MensajeFinal(msg)
			});
		
		}
		
	}
		
	function MensajeFinal(msg){
		
			$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage').show('slow');//Mostramos el div.
			
			//DESAPARECER
			setTimeout(function() {
				
				$(".mensage").fadeOut(1500);
				
				$('#block').hide();
				$('#popupbox').hide();
				
	
			},3000);
			
			
			
			
			//APARECER
			/*setTimeout(function() {
				$(".mensage").fadeIn(1500);
			},3000);*/
	
	}
	
	function Solo_Numeros(e){
	
		var key = window.Event ? e.which : e.keyCode
		return (key >= 48 && key <= 57)
	}
	
	
	var Filas = 0;
	
	$("#boton_detalle_liquidacion").click(function(){
	
	
				var idspermiso = "";
				
				var f = 1;
				
				var d0x;
				
				var TOTAL = 0;
				
			
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('tabla_liqui');
				
				cantidad_filas_F = TABLA_F.rows.length;
				
		
				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 6; r < cantidad_filas_F; r++){
					
					//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
					if($("#chk"+f).is(':checked')) {  
						
							//alert("ENTRE");
				
							d0x  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
							
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermiso = d0x+","+idspermiso;
					}
						
					f = f + 1;
					
					
				}
				
				
			
				if(idspermiso == ""){
					
					alert("No Selecciono Ninguna Liquidacion");
					
				
				}
				else{
				
					//alert(d0x);
					
					$.get("funciones/traer_datos_detalle_liquidacion.php?idvalor="+d0x, function(cadena){
					
							//alert(cadena);var identificadorcampo1 = datos[0].indexOf('Fallo en la Conexion');
						
					
							var resultado  = cadena.split("******");
			
				
							Filas = resultado.length;
							
							
							var cantidad_filas;
							var TABLA      = document.getElementById('t_liqui_1');
							cantidad_filas = TABLA.rows.length;
					
						
							if(cantidad_filas>1){
										
								
								Eliminar_Tabla_Procesos();
								
								var tabla = document.getElementById('cont_liqui_1').innerHTML;
								
								tabla = reemplazarCadena("</table>", " ", tabla);
									
								for (var id=0; id < Filas-1; id++){
									
					
									resultado2 = resultado[id].split("//////");
									
									//tabla = reemplazarCadena("</table>", " ", tabla);
									
									TOTAL = parseFloat(TOTAL) + parseFloat(resultado2[2]);
									
									
									tabla+='<tr>';
									
									tabla+='<td style="font-size:16px; text-align:left">'+resultado2[0]+'</td>';
									
									tabla+='<td style="font-size:16px; text-align:left">'+resultado2[1]+'</td>';
									
									<!-- tabla+='<td style="font-size:16px; text-align:right">'+number_format(resultado2[2],2)+'</td>'; -->
									
									tabla+='<td style="font-size:18px; text-align:right; color:#FF0000">'+resultado2[2]+'</td>';
									
									
									tabla+='<td style="text-align:center"><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_nv(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="Eliminar Fila"/></button></td>';
												
									//tabla+='</tr></table>';
									
									tabla+='</tr>';
						
									//document.getElementById('cont_liqui_1').innerHTML=tabla;
									
								
								 }
								 
								 /*tabla+='<tr>';
								 
								 tabla+='<td style="font-size:16px; text-align:right">'+''+'</td>';
								 tabla+='<td style="font-size:16px; text-align:right">'+'<b>TOTAL</b>'+'</td>';
								 tabla+='<td style="font-size:16px; text-align:right; color:#FF0000;">'+number_format(TOTAL, 2)+'</td>';
								 
								 tabla+='</tr>';*/
			
								 
								 tabla+='</table>';
								 
								 document.getElementById('cont_liqui_1').innerHTML=tabla;
								 
							     $('#total_liqui_nv').val(number_format(TOTAL, 2));
								 
							}
										
							if(cantidad_filas == 1){
										
								
								var tabla = document.getElementById('cont_liqui_1').innerHTML;
								
								tabla = reemplazarCadena("</table>", " ", tabla);
								
								for (var id=0; id < Filas-1; id++){
									
									
									resultado2 = resultado[id].split("//////");
									
									//tabla = reemplazarCadena("</table>", " ", tabla);
									
									TOTAL = parseFloat(TOTAL) + parseFloat(resultado2[2]);
									
								
									tabla+='<tr>';
							
					
									tabla+='<td style="font-size:16px; text-align:left">'+resultado2[0]+'</td>';
									
									tabla+='<td style="font-size:16px; text-align:left">'+resultado2[1]+'</td>';
									
									<!-- tabla+='<td style="font-size:16px; text-align:right">'+number_format(resultado2[2],2)+'</td>'; -->
						
									tabla+='<td style="font-size:18px; text-align:right; color:#FF0000">'+resultado2[2]+'</td>';
									
									tabla+='<td style="text-align:center"><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_nv(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="Eliminar Fila"/></button></td>';
									
									//tabla+='</tr></table>';
									
									tabla+='</tr>';
									
									
									
									//document.getElementById('cont_liqui_1').innerHTML=tabla;
									
									
								}
								
								/*tabla+='<tr>';
								 
								tabla+='<td style="font-size:16px; text-align:right">'+''+'</td>';
								tabla+='<td style="font-size:16px; text-align:right">'+'<b>TOTAL</b>'+'</td>';
								tabla+='<td style="font-size:16px; text-align:right; color:#FF0000;">'+number_format(TOTAL, 2)+'</td>';
								 
								tabla+='</tr>'*/
								 
								tabla+='</table>';
								
								document.getElementById('cont_liqui_1').innerHTML=tabla;
								
								$('#total_liqui_nv').val(number_format(TOTAL, 2));
								
							}
						
						
						
						
					
					
					});
					

				}
			
				
	});
	
	
	
	function Eliminar_Tabla_Procesos(){
	
		var r;
		var cantidad_filas;
		var TABLA = document.getElementById('t_liqui_1');
				
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
	
	<!-- CLIC BOTON CAMBIAR GUARDAR -->
	$('#boton_guardar').click(Editar_Item_Liquidacion);

	<!-- FUNCION A EJECUTAR AL DAR CLIC EN EL BOTON GUARDAR -->
	function Editar_Item_Liquidacion(){	
	
	
		//alert(1);
		
		var validar    = 0;
	
		var dataString = "";
		
		var idspermiso ="";
				
		var f = 1;
				
		var d0x;
		
				
		var cantidad_filas_F;
		var TABLA_F = document.getElementById('tabla_liqui');
				
		cantidad_filas_F = TABLA_F.rows.length;
				
		
		//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
		for (r = 6; r < cantidad_filas_F; r++){
					
			//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
			if($("#chk"+f).is(':checked')) {  
						
				//alert("ENTRE");
				
				d0x  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
				
		
				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				idspermiso = d0x+","+idspermiso;
			}
						
			f = f + 1;
					
					
		}
				
				
			
		if(idspermiso == ""){
					
			//alert("No Seleciono Ningun Liquidacion");
			validar = 1;
			
			msg = "No Selecciono Ninguna Liquidacion";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;
					
				
		}
		else{
		
			$('#idliqui').val(d0x);

			dataString += '&idliqui='+$('#idliqui').val();
		}
		
		
		
		var cantidad_filas_nv_E;
		var TABLA_nv_E      = document.getElementById('t_liqui_1');
		cantidad_filas_nv_E = TABLA_nv_E.rows.length;
		
		//alert(cantidad_filas_nv_E);		
				
		if(cantidad_filas_nv_E == 1){
		
			validar = 1;
			
			msg = "LA TABLA DETALLE LIQUIDACION NO CUENTA CON INFORMACION";
			$('.mensage_validar').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
			$('.mensage_validar').show('slow');
			
			setTimeout(function() {
				$(".mensage_validar").fadeOut(1500);
			},5000);
			
			return false;		
		}
		else{
		
			//dataString += '&fecha_liqui_a='+$('#fecha_liqui_a').val();
			
			
			
			var controlemcabezados_nvx = 0;
			
			var datospartes_nvx        = "";
		
			$('#t_liqui_1 tr').each(function () {
	
				var d0_nvx  = $(this).find("td").eq(0).html();
				var d1_nvx  = $(this).find("td").eq(1).html();
				var d2_nvx  = $(this).find("td").eq(2).html();
				
			
				//alert(d0_nvx+"//////"+d1_nvx+"//////"+d2_nvx);
				
				if(controlemcabezados_nvx == 0){
					controlemcabezados_nvx = controlemcabezados_nvx + 1;
				}
				else{
					
					//CONCATENO TODOS LOS REGISTROS DE LA TABLA
					datospartes_nvx = datospartes_nvx+"******"+d0_nvx+"//////"+d1_nvx+"//////"+d2_nvx;
					
					//ASIGNO AL CAMPO OCULTO datospartes LA INFORMACION DE LA TABLA
					$("#datospartes_nvx").val('');
					$("#datospartes_nvx").val(datospartes_nvx);
					
	
				}
		
			});
			
			validar = 0;
			
			dataString += '&datospartes_nvx='+datospartes_nvx;
			
			
		}
	
		//TODOS LOS CAMPOS VALIDADOS
		//SE ENVIA LA OPERACION
		if(validar == 0){
		
			//alert(dataString);
			
			/*Ejecutamos la función ajax de jQuery*/		
			$.ajax({
				
				//url:'views/popupbox/subir.php', //Url a donde la enviaremos
				url:'index.php?controller=liquidaciones2&action=Editar_Item_Liquidacion',
				type:'POST', //Metodo que usaremos
				//contentType:false, //Debe estar en false para que pase el objeto sin procesar
				data:dataString, //Le pasamos el objeto que creamos con los archivos
				//processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
				cache:false //Para que el formulario no guarde cache
			}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
				MensajeFinal(msg)
			});
		
		}
		
	}
		
		
	var z_nv     = 1;
	var Filas_nv = 0;
	
	function Adicionar_Parte_nv(idaccion){
		
		// Eliminamos la ultima columna
        //$("#t_liqui_1 tr:last").remove();
		

		existenumtitulo_nv = Existe_Numero_Titulo_nv();
		
		
		if(existenumtitulo_nv == 1){
			
			existenumtitulo_nv = 1;
			
			Limpiar_Campos_nv();
			
			//alert("Ya Existe esa Informacion en la Tabla, no es Posible su Adicion, EN FILA:"+existenumtitulo_B[0]);
			
		}
		else{//1
			
		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos_nv = Validar_Campos_Agregar_nv(idaccion);
		
		//validarcampos = 0;
		
		if(validarcampos_nv == 1){
			
			validarcampos_nv = 1;
		}
		else{//2
		
				//DATOS 
				
				var dato1_nv  = document.getElementById('item_liqui_nv').value;
				//var s0_nv     = document.frm.item_liqui;
				//var dato1b_nv = s0_nv.options[s0_nv.selectedIndex].text;
				
				var dato1b_nv = $('#item_liqui_nv option:selected').html()
				
				var dato2_nv  = document.getElementById('valor_liqui_nv').value;
				
				//VALIDA QUE QUE UN NUMERO SE ENTERO Y SE LE ADICIONAN DOS DECIMALES .00
				//PARA REALIZAR EL CALCULO TOTAL
				/*var dato2_nv_X      = document.getElementById('valor_liqui_nv').value.split('.');
				var long_dato2_nv_X = dato2_nv_X.length;
				
				if(long_dato2_nv_X == 1){
					
					dato2_nv = dato2_nv+".00";
				}*/
		
				//-------------------------------------------------------------------------------------------------------
		
				//Filas = resultado.length;
				Filas_nv          = 1;
				var cantidad_filas_nv;
				var TABLA_nv      = document.getElementById('t_liqui_1');
				cantidad_filas_nv = TABLA_nv.rows.length;
		
				//alert(cantidad_filas);
				
				if(cantidad_filas_nv > 1){
							
					//alert('cantidad > 1');
						
					//Eliminar_Tabla();
					
					var tabla_nv=document.getElementById('cont_liqui_1').innerHTML;
						
					//for (var id=0; id<Filas; id++){
					
						//tabla=tabla.substring(0,(tabla.length-8)); 
						
						tabla_nv = reemplazarCadena("</table>", " ", tabla_nv);
						
						tabla_nv+='<tr>';
						
						tabla_nv+='<td style="font-size:16px; text-align:left">'+dato1_nv+'</td>';
						
						tabla_nv+='<td style="font-size:16px; text-align:left">'+dato1b_nv+'</td>';
						
						tabla_nv+='<td style="font-size:18px; text-align:right; color:#FF0000">'+dato2_nv+'</td>';
						
						tabla_nv+='<td style="text-align:center"><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_nv(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="Eliminar Fila"/></button></td>'; 
											
						tabla_nv+='</tr></table>';
						
						document.getElementById('cont_liqui_1').innerHTML=tabla_nv;
						
						z_nv++;
						
						
						Limpiar_Campos_nv();
						
						
					 //}
				}
							
				if(cantidad_filas_nv==1){
							
					//alert('cantidad = 1');
					
					var tabla_nv=document.getElementById('cont_liqui_1').innerHTML;
					
					//alert(tabla);
					
					//for (var id=0; id<Filas; id++){
						
						//var partefinal = tabla.length - 8;
						
						//alert("Longitud Tabla: "+tabla.length);
						//alert("Parte Final: "+partefinal);
						
						//tabla=tabla.substring(0,(tabla.length-8));
						
						tabla_nv = reemplazarCadena("</table>", " ", tabla_nv);
						
						//tabla=tabla.substring(0,partefinal);
						
						
						//alert(tabla);
						
						tabla_nv+='<tr>';
					
						
						tabla_nv+='<td style="font-size:16px; text-align:left">'+dato1_nv+'</td>';
						
						tabla_nv+='<td style="font-size:16px; text-align:left">'+dato1b_nv+'</td>';
					
						tabla_nv+='<td style="font-size:18px; text-align:right; color:#FF0000">'+dato2_nv+'</td>';
						
						tabla_nv+='<td style="text-align:center"><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_nv(this.parentNode.parentNode.rowIndex)"><img src="views/images/pendiente.jpg" width="15" height="15" title="Eliminar Fila"/></button></td>'; 
						
						tabla_nv+='</tr></table>';
					
						//alert(tabla);
						document.getElementById('cont_liqui_1').innerHTML=tabla_nv;
						
						z_nv++;
						
						Limpiar_Campos_nv();
						
						
					//}
				}
				
		}//2
		
		//Limpiar_Formulario();
		
		}//1
		
		Suma_Item_nv();
		
	}
	
	
	function Existe_Numero_Titulo_nv(){
		
		var existe_nv      = 0;
		
		//var d0b_nv         = document.getElementById('item_liqui_nv').value;
		var d0b_nv         = $("#item_liqui_nv").val();
		
		var valor_total_nv = 0;
		
	
		//alert(d0b);
		
		var contfila_nv = 0;
		
		$('#t_liqui_1 tr').each(function () {
	
		
			var d0_nv  = $(this).find("td").eq(0).html();
			
			//NO TENER ENCUENTA LOS ENCABEZADOS
			if(contfila_nv == 0){
				contfila_nv = contfila_nv + 1;
			}
			else{
			
				
				//SE REALIZA ESTA COMPARACION, YA QUE CUANDO SE DESEA AGREGAR
				//UN NUEVO ITEM DE COSTAS Y SI EL PRIMER REGISTRO DE LA TABLA
				//DETALLE LIQUIDACION ES IGUAL AL QUE SE ESCOGE DE LA LISTA ITEM
				//NO SE COMPARAN COMO IGUAL, YA QUE EL DATO DE LA COLUMNA ID DEL PRIMER
				//REGISTRO TIENE UN PUNTO ES DECIR .costa013, AUNQUE NO SE VISUSLIZA.
				//LO CUAL NO ES IGUAL costa013 == .costa013, POR ENDE SE APLICA LA FUNCION
				//replace Y trim Y OBTENEMOS costa013
				if(contfila_nv == 1){
			
					d0_nv = d0_nv.replace("."," ");
					
					d0_nv = d0_nv.trim();
				}
				
				//alert(d0b_nv+" == "+d0_nv);
				
				
				
				if(d0b_nv == d0_nv){
				
					
					//alert("LO ENCONTRE...");
					
					//VALIDA QUE QUE UN NUMERO SE ENTERO Y SE LE ADICIONAN DOS DECIMALES .00
					//PARA REALIZAR EL CALCULO TOTAL
					/*var valor_liqui_nv_X      = $("#valor_liqui_nv").val().split('.');
					var long_valor_liqui_nv_X = valor_liqui_nv_X.length;
					
				
					if(long_valor_liqui_nv_X == 1){
						
						valor_liqui_nv_X = $("#valor_liqui_nv").val()+".00";
					}
					else{
						valor_liqui_nv_X = $("#valor_liqui_nv").val();
					}*/
			
		
					valor_total_nv = parseFloat($("#valor_liqui_nv").val()) + parseFloat($(this).find("td").eq(2).html());
					
					/*valor_liqui_nv_X = valor_liqui_nv_X.replace(",", ".");
					
					//alert(valor_liqui_nv_X);
					
		
					valor_total_nv = parseFloat(valor_liqui_nv_X) + parseFloat($(this).find("td").eq(2).html());*/
					
					$(this).find("td").eq(2).text(valor_total_nv);
				
					existe_nv = 1
					return false;//para el for each
						
				}
			
			}
			
			
			
			
			
		});
		
	
		return  existe_nv;
					
	}
	
	
	//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
	function Eliminar_Fila_nv(idfila){
		
		
		//alert(document.getElementById("t").rows[idfila].cells[2].innerText);
		
		//-------------------- PARA RECALCULAR EL VALOR TOTAL ----------------------------------
		/*var valor_descartar = document.getElementById("t").rows[idfila].cells[2].innerText;
		
		var valor_total    = $("#total_liqui").val();
		
		var recalcular     = parseFloat(valor_total) - parseFloat(valor_descartar);
		
		$("#total_liqui").val(recalcular);*/
		
		//---------------------------------------------------------------------------------------
		
		var TABLA = document.getElementById('t_liqui_1');
		
		TABLA.deleteRow(idfila);
		
		Suma_Item_nv();
		
	}
	
	function Suma_Item_nv(){
		
		var contador_item_nv = 0;
		
		var SUMA_TOTAL_nv = 0;
		
		var cantidad_filas_X_nv;
		var TABLA_X_nv      = document.getElementById('t_liqui_1');
		cantidad_filas_X_nv = TABLA_X_nv.rows.length;
		
		//alert("CANTIDAD FILAS: "+cantidad_filas_X);
		
		if(cantidad_filas_X_nv > 1){
			
			$('#t_liqui_1 tr').each(function () {
		
				//alert("ENTRE 2"+"---"+$(this).find("td").eq(2).html());	
				
				//PARA NO TENER ENCUENTA LA PRIMERA FILA QUE SON LOS ENCABEZADOS
				contador_item_nv = contador_item_nv + 1;
					
				if(contador_item_nv > 1){
						
					SUMA_TOTAL_nv =  parseFloat(SUMA_TOTAL_nv) + parseFloat( $(this).find("td").eq(2).html() );	
				}
				
			});
			
			$("#total_liqui_nv").val(0);
			
			$("#total_liqui_nv").val(number_format(SUMA_TOTAL_nv,2));
		}
		else{
			
			$("#total_liqui_nv").val(0);
		
			$("#total_liqui_nv").val(number_format(0,2));
		}
		
					
	}
	
	function Validar_Campos_Agregar_nv(idaccion){
		
		var validar_nv        = 0;
		var contador_punto_nv = 0;
		
		valor_nv  = document.getElementById('item_liqui_nv').value;
		valor2_nv = document.getElementById('valor_liqui_nv').value;
		
		if( valor_nv == null || valor_nv.length == 0 || /^\s+$/.test(valor_nv) ) {
			
			alert("Defina Item");
			document.getElementById('item_liqui_nv').style.borderColor = '#FF0000';
			validar_nv = 1;
			return validar_nv;
		}
		
		if( valor2_nv == null || valor2_nv.length == 0 || /^\s+$/.test(valor2_nv) ) {
			
			alert("Defina Valor");
			document.getElementById('valor_liqui_nv').style.borderColor = '#FF0000';
			validar_nv = 1;
			return validar_nv;
		}
		else{
			
			if(document.getElementById('valor_liqui_nv').value == 0){
				
				alert("El Campo Valor no Puede ser Cero (0)");
				validar = 1;
				document.getElementById('valor_liqui_nv').value = 0;
				return validar;
			
			}
			else{
				
				for (var i = 0; i< valor2_nv.length; i++) {
					
					var caracter_nv = valor2_nv.charAt(i);
					
					if( caracter_nv == ".") {
						
						contador_punto_nv = contador_punto_nv + 1
						
					}  
					
				}
				
				if(contador_punto_nv > 1){
					
					alert("No Se Permite mas de un Punto en el Campo Valor");
					validar_nv = 1;
					document.getElementById('valor_liqui_nv').value = 0;
					return validar_nv;
					
				}
				
			}
			
		}
		
	
	}
	
	
	function Limpiar_Campos_nv(){
	
		document.getElementById('item_liqui_nv').selectedIndex = 0;
		document.getElementById('item_liqui_nv').style.borderColor='#E0E0E0';
		
		document.getElementById('valor_liqui_nv').value = 0;
		document.getElementById('valor_liqui_nv').style.borderColor='#E0E0E0';
		
		
	}
	
	
	
	
	
	
	
	//EL NUMERO SALE DEESTA FORMA 383.100,36
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
	
	//EL NUMERO SALE DE ESTA FORMA 383,100.36
	/*function number_format(amount, decimals) {

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
			amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
	
		return amount_parts.join('.');
	}*/
	
	
	$("#boton_generar_liquidacion").click(function(){
	
	
				var idspermiso="";
				
				var f = 1;
				
				var d0x;
				
				var TOTAL = 0;
				
			
				var cantidad_filas_F;
				var TABLA_F = document.getElementById('tabla_liqui');
				
				cantidad_filas_F = TABLA_F.rows.length;
				
		
				//r ARRANCA EN r = 2 PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
				//REGISTRO r = 0 (TITULO DE LA TABLA) Y r = 1 (ENCABEZADOS)
				for (r = 6; r < cantidad_filas_F; r++){
					
					//d0  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
					
					if($("#chk"+f).is(':checked')) {  
						
							//alert("ENTRE");
				
							d0x  = document.getElementById("tabla_liqui").rows[r].cells[0].innerText;
							
							//FECHA
							d1x  = document.getElementById("tabla_liqui").rows[r].cells[1].innerText;
							
							//NUEVO
							d4x  = document.getElementById("tabla_liqui").rows[r].cells[4].innerText;
							
							//LIQ CREDITO
							d5x  = document.getElementById("tabla_liqui").rows[r].cells[5].innerText;
							
							//CONCATENO TODOS LOS REGISTROS DE LA TABLA
							idspermiso = d0x+","+idspermiso;
					}
						
					f = f + 1;
					
					
				}
				
				
			
				if(idspermiso == ""){
					
					alert("No Seleciono Ninguna Liquidacion");
					
				
				}
				else{
				
					var acuerdo = "";
					
					var cesionario   = $('#cesi_liqui').val();
					var subrogatario = $('#sub_liqui').val();
					var nunestado    = $('#nunestado').val();
					var fecha_estado = $('#fecha_estado').val();
					
				    //alert("GENERANDO LIQUIDACION NUMERO: "+d0x);
					
					//var ipservidor = "172.16.176.194";
		
					//window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?fechae_2A="+valor1+"&fechae_2B="+valor2+"&nun_estado="+valor3+"&juzgadoauto="+valor4);
					
					//window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liqui="+d0x);
					
					if( $("#radioacuerdo1").is(':checked') ) {  
					
						acuerdo = "Acuerdo 1887 de 2003 modificado mediante el acuerdo No. 2222";
					
					}
					
					if( $("#radioacuerdo2").is(':checked') ) {  
					
						acuerdo = "Acuerdo 10554 de 2016";
					
					}
					
					var forma_dte_ddo = "";
					if($("#checkliquisa_2").is(':checked')){ 
					
						forma_dte_ddo = "a cargo de la parte demandante y en favor de la parte demandada.";
					}
					else{
					
						forma_dte_ddo = "a cargo de la parte demandada y a favor del aqui demandante.";
					}
					
					//*********************TANTO NUEVO COMO LIQUIDACION******************************
            		if( d4x == "SI" && d5x == "SI" ){
					
						//alert("NUEVA Y LIQUIDACION");
						
						//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
						if($("#checkliquisa").is(':checked')){  
							
							
							var agencias = 1;
							
							var fechat = d1x;
			
							var fi;
							var fii;
							
							var ff;
							var fff;
							
							
							if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
							
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
							}	
							else{
								alert("DEFINA ACUERDO");
							}	
							
							
							
							
						}
						//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
						else{
						
							
							var fechat = d1x;
			
							var fi;
							var fii;
							
							var ff;
							var fff;
							
							
							$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
								
								//alert(fechas);
								
								var vector_fechas = fechas.split(" ");
								
								//FECHA FIJACION
								fj  = vector_fechas[0].split("/");
								fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
								
								//alert(fjj);
								
								//FECHA INICIAL
								fi  = vector_fechas[1].split("/");
								fii = fi[2]+"-"+fi[1]+"-"+fi[0];
								
								//alert(fii);
								
								//FECHA FINAL
								ff  = vector_fechas[2].split("/");
								fff = ff[2]+"-"+ff[1]+"-"+ff[0];
								
								//alert(fff);
								
	
								window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
													
							});
						
	
						
						}
					
					}
					
					
					
					
					//*********************SOLO LIQUIDACION******************************
            		if( d4x == "NO" && d5x == "SI" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_LIQUIDACION.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
		
							
							}
					
						
					}
					
					
					
					//*********************SOLO NUEVO******************************
            		if( d4x == "SI" && d5x == "NO" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
										
										//document.location = "http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario;
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
									
									
									//document.location = "http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NUEVO.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario;
									
									
									
														
								});
							
		
							
							}
					
						
					}
					
					
					//*********************AMBOS NO******************************
            		if( d4x == "NO" && d5x == "NO" ){
					
							//alert("NUEVA Y LIQUIDACION");
							
							//GENERAR LIQUIDACION CON AGENCIAS EN DERECHO
							if($("#checkliquisa").is(':checked')){  
								
								
								var agencias = 1;
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								if( $("#radioacuerdo1").is(':checked') || $("#radioacuerdo2").is(':checked') ) {
								
									$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
										
										//alert(fechas);
										
										var vector_fechas = fechas.split(" ");
										
										//FECHA FIJACION
										fj  = vector_fechas[0].split("/");
										fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
										
										//alert(fjj);
										
										//FECHA INICIAL
										fi  = vector_fechas[1].split("/");
										fii = fi[2]+"-"+fi[1]+"-"+fi[0];
										
										//alert(fii);
										
										//FECHA FINAL
										ff  = vector_fechas[2].split("/");
										fff = ff[2]+"-"+ff[1]+"-"+ff[0];
										
										//alert(fff);
										
			
										window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NONUEVO_NOLIQUI.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&agencias="+agencias+"&acuerdo="+acuerdo+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&forma_dte_ddo="+forma_dte_ddo+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
															
									});
								
								}	
								else{
									alert("DEFINA ACUERDO");
								}	
								
								
								
								
							}
							//GENERAR LIQUIDACION SIN AGENCIAS EN DERECHO
							else{
							
								
								var fechat = d1x;
				
								var fi;
								var fii;
								
								var ff;
								var fff;
								
								
								$.get('views/funciones/traer_fechas_web_110.php?fechat='+fechat, function(fechas){
									
									//alert(fechas);
									
									var vector_fechas = fechas.split(" ");
									
									//FECHA FIJACION
									fj  = vector_fechas[0].split("/");
									fjj = fj[2]+"-"+fj[1]+"-"+fj[0];
									
									//alert(fjj);
									
									//FECHA INICIAL
									fi  = vector_fechas[1].split("/");
									fii = fi[2]+"-"+fi[1]+"-"+fi[0];
									
									//alert(fii);
									
									//FECHA FINAL
									ff  = vector_fechas[2].split("/");
									fff = ff[2]+"-"+ff[1]+"-"+ff[0];
									
									//alert(fff);
									
		
									window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_NONUEVO_NOLIQUI.php?nun_liquidacion="+d0x+"&fechafijacion="+fjj+"&fechainicial="+fii+"&fechafinal="+fff+"&cesionario="+cesionario+"&subrogatario="+subrogatario+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
														
								});
							
		
							
							}
					
						
					}
					
					
					
				
				}//FIN ELSE
				
				

	});


	
	
	
	//APROBAR COSTAS
	$("#boton_aprobar_costas").click(function(){
	
		var id_liqui_apc        = $('#id_liqui').val();
		var radicado            = $('#radicado').val();
		var fecha_liqui_a_apc   = $('#fecha_liqui_a').val();
		var juzgado_apc         = $('#juzgado_liqui_a option:selected').text();
		var observacionsr_a_apc = $('#observacionsr_a').val();
		
		
		//alert($('#id_liqui').val()+" "+$('#fecha_liqui_a').val()+" "+$('#juzgado_liqui_a').val()+" "+juzgado_sel+" "+$('#observacionsr_a').val());
		
		//var ipservidor = "172.16.176.194";
		
		window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_APROBAR_COSTAS.php?id_liqui_apc="+id_liqui_apc+"&radicado="+radicado+"&fecha_liqui_a_apc="+fecha_liqui_a_apc+"&juzgado_apc="+juzgado_apc+"&observacionsr_a_apc="+observacionsr_a_apc);
		
	});
	
	//AVOCA CONOCIMIENTO
	$("#boton_avoca_conocimiento").click(function(){
	
		var id_liqui_apc        = $('#id_liqui').val();
		var radicado            = $('#radicado').val();
		var fecha_liqui_a_apc   = $('#fecha_liqui_a').val();
		var juzgado_apc         = $('#juzgado_liqui_a option:selected').text();
		var observacionsr_a_apc = $('#observacionsr_a').val();
		
		observacionsr_a_apc = observacionsr_a_apc.replace(/\n/g, "<br />");
		//alert($('#id_liqui').val()+" "+$('#fecha_liqui_a').val()+" "+$('#juzgado_liqui_a').val()+" "+juzgado_sel+" "+$('#observacionsr_a').val());
		
		//var ipservidor = "172.16.176.194";
		
		//alert(id_liqui_apc);
		
		var nunestado    = $('#nunestado').val();
		var fecha_estado = $('#fecha_estado').val();
		
		window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_AVOCA_CONOCIMIENTO.php?id_liqui_apc="+id_liqui_apc+"&radicado="+radicado+"&fecha_liqui_a_apc="+fecha_liqui_a_apc+"&juzgado_apc="+juzgado_apc+"&observacionsr_a_apc="+observacionsr_a_apc+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
		
		
		
	});
	
	
	//AVOCA CONOCIMIENTO / APROBAR COSTAS
	$("#boton_avoca_conocimiento_aprobar").click(function(){
	
		var id_liqui_apc        = $('#id_liqui').val();
		var radicado            = $('#radicado').val();
		var fecha_liqui_a_apc   = $('#fecha_liqui_a').val();
		var juzgado_apc         = $('#juzgado_liqui_a option:selected').text();
		var observacionsr_a_apc = $('#observacionsr_a').val();
		
		observacionsr_a_apc = observacionsr_a_apc.replace(/\n/g, "<br />");
		//alert($('#id_liqui').val()+" "+$('#fecha_liqui_a').val()+" "+$('#juzgado_liqui_a').val()+" "+juzgado_sel+" "+$('#observacionsr_a').val());
		
		//var ipservidor = "172.16.176.194";
		
		var nunestado    = $('#nunestado').val();
		var fecha_estado = $('#fecha_estado').val();
		
		window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_AVOCA_CONOCIMIENTO_APROBAR.php?id_liqui_apc="+id_liqui_apc+"&radicado="+radicado+"&fecha_liqui_a_apc="+fecha_liqui_a_apc+"&juzgado_apc="+juzgado_apc+"&observacionsr_a_apc="+observacionsr_a_apc+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
		
		
		
	});
	
	
	//AVOCA CONOCIMIENTO / TRAS LIQUI CREDITO
	$("#boton_avoca_conocimiento_tlc").click(function(){
	
		var id_liqui_apc        = $('#id_liqui').val();
		var radicado            = $('#radicado').val();
		var fecha_liqui_a_apc   = $('#fecha_liqui_a').val();
		var juzgado_apc         = $('#juzgado_liqui_a option:selected').text();
		var observacionsr_a_apc = $('#observacionsr_a').val();
		
		var nunestado           = $('#nunestado').val();
		var fecha_estado        = $('#fecha_estado').val();
		
		observacionsr_a_apc = observacionsr_a_apc.replace(/\n/g, "<br />");
		//alert($('#id_liqui').val()+" "+$('#fecha_liqui_a').val()+" "+$('#juzgado_liqui_a').val()+" "+juzgado_sel+" "+$('#observacionsr_a').val());
		
		//var ipservidor = "172.16.176.194";
		
		window.open("http://"+ipservidor+"/ejecucion/views/tcpdf/GENERAR_AVOCA_CONOCIMIENTO_TLC.php?id_liqui_apc="+id_liqui_apc+"&radicado="+radicado+"&fecha_liqui_a_apc="+fecha_liqui_a_apc+"&juzgado_apc="+juzgado_apc+"&observacionsr_a_apc="+observacionsr_a_apc+"&nunestado="+nunestado+"&fecha_estado="+fecha_estado);
		
		
		
	});
	
	/*$("#boton_reiniciar_item").click(function(){
	
		$('#id_liqui_item').val('');
					
		$('#referencia_liqui').val('');
		$("#referencia_liqui").removeAttr('disabled');
					
		$('#nombre_liqui').val('');
		$('#descrip_liqui').val('');
					
		$('#id_modificar').val(0);
		
		
		$("input:checkbox").attr('checked', false);
	
	});*/
	
	
	// Reemplaza cadenaVieja por cadenaNueva en cadenaCompleta
	function reemplazarCadena(cadenaVieja, cadenaNueva, cadenaCompleta) {
	
	
	   for (var i = 0; i < cadenaCompleta.length; i++) {
		  if (cadenaCompleta.substring(i, i + cadenaVieja.length) == cadenaVieja) {
			 cadenaCompleta= cadenaCompleta.substring(0, i) + cadenaNueva + cadenaCompleta.substring(i + cadenaVieja.length, cadenaCompleta.length);
		  }
	   }
	   return cadenaCompleta;
	}
	
	
	
</script>

<!-- Creamos un estilo para nuestro documento -->
	<style type="text/css">
		
		.mensage{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
		.mensage_validar{
			border:dashed 1px red;
			background-color:#FFC6C7;
			color: #000000;
			padding: 10px;
			text-align: center;
			margin: 10px auto; 
			display: none;/*Al cargar el documento el contenido del mensaje debe estar oculto*/
		}
	</style>

<!-- <form method="post" name ="formarchivo" id="formarchivo">  -->

	
	<!-- MENSAJES -->
	<div class="mensage"></div>  
	<div class="mensage_validar"> </div> 
	
	<div class="buttonsBar" style="float:right">
	
		<button id="cancel" type="button" name="boton_cancelar" title="Cerrar"><img src="views/images/cancel2.png" width="25" height="25"/></button>
		<!-- <button id="registrar" name="boton_registrar" title="Registrar"><img src="views/images/save.png" width="25" height="25"/></button>
		<button type="button" name="boton_reiniciar_item" id="boton_reiniciar_item" title="REINCIAR (PARA NO EDITAR SI NO REGISTRAR UN NUEVO ITEM)"><img src="views/images/reiniciar.png" width="25" height="25"/></button> -->
		
																												
	</div>
	
	
	<input type="hidden" name="idliqui" id="idliqui"/>
	<input name="datospartes_nvx" id="datospartes_nvx" type="hidden" readonly="true"/> 
	

	<table border="0" align="center">

		<!-- LIQUIDACIONES PROCESO-->
			
		<tr>
				
												
				<td>
													
												
					<table cellpadding="0" cellspacing="0" rules="rows" border="5" class="display" id="tabla_liqui">
																		
						<thead> 
							
							<tr> 
																			
								<td colspan="7">
									<center><strong style="width:151px; color:#FF0000; font-size:16px">LIQUIDACIONES PROCESO:<?php echo $valor_radicado; ?></strong></center>
								</td>
								
																			
							</tr> 
							
							<tr>
			
								<td>
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<button type="button" name="boton_detalle_liquidacion" id="boton_detalle_liquidacion" title="DETALLE LIQUIDACION"><img src="views/images/detalle1.png" width="46" height="40"/>Detalle Liquidacion</button>
												
												
																			
											</td>
											
											<td>
																	
												
												
												<button type="button" name="boton_generar_liquidacion" id="boton_generar_liquidacion" title="GENERAR LIQUIDACION"><img src="views/images/generar_liqui.jpg" width="40" height="40"/>Generar Liquidacion</button>
												
												
												
												
																			
											</td>
											
											<td>
																	
												
												
												<button type="button" name="cambiofecha_liqui" id="cambiofecha_liqui" title="CAMBIAR FECHA LIQUIDACION"><img src="views/images/calendario.jpg" width="40" height="40"/>Cambiar Fecha Liquidacion</button>
												
																			
											</td>
											
											
											
										</tr>
									
									</table>
									
								</td>
								
								
								<td>
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">LIQUIDACION SIN AGENCIAS</label>
												<input type="checkbox" id="checkliquisa" name="checkliquisa"> 
												
						
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">DEMANDANTE A DEMANDADO</label>
												<input type="checkbox" id="checkliquisa_2" name="checkliquisa_2"> 
												
						
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">ACUERDO 1887 DE 2003</label>
												<input type="radio" id="radioacuerdo1" name="acuerdo" style="border-color:#0066CC"/>
												
												
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">ACUERDO 10554 DE </label>
												<input type="radio" id="radioacuerdo2" name="acuerdo" style="border-color:#0066CC"/>
												
																			
											</td>
											
											
										</tr>
									
									</table>
									
								</td>
								
								
								<td colspan="5">
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">DATOS PARA COMPLETAR LIQUIDACION</label>
												
											</td>
											
											
										</tr>
									
										<tr>
										
											<td>
																	
												
												<label style="width:151px; color:#666666">CESIONARIO</label>
												<input type="text" name="cesi_liqui" id="cesi_liqui"/>
												
												
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">SUBROGATARIO</label>
												<input type="text" name="sub_liqui" id="sub_liqui"/>
												
																			
											</td>
											
											
										</tr>
									
										
										<tr>
										
											<td>
																	
												
					
												<label style="width:151px; color:#666666">NUMERO ESTADO</label>
												<input type="text" name="nunestado" id="nunestado"/>
												
																			
											</td>
											
											
										</tr>
										
										<tr>
										
											<td>
												<label style="width:151px; color:#666666">FECHA ESTADO:</label><br>
												<input type="text" name="fecha_estado" id="fecha_estado" readonly="true">
											</td>
											
										</tr>
											
									</table>
									
								</td>

								
								
							</tr>
							
							
							<tr>
								
				
								<td colspan="7">
								
								 	<table>
									
										
										<tr>
										
											<td>
												<strong><label style="width:151px; color:#666666">APROBAR COSTAS</label><br></strong>
												
											</td>
										
										</tr>
										
										<tr>
										
											<td>
												<label style="width:151px; color:#666666">Fecha:</label><br>
												<input type="text" name="fecha_liqui_a" id="fecha_liqui_a" readonly="true">
											</td>
											
											<td>
													
												<label style="width:151px; color:#666666">Juzgado:</label><br>					
												<select name="juzgado_liqui_a" id="juzgado_liqui_a">
																																
																																	
													<option value="" selected="selected">Seleccionar Juzgado</option>
																																			
													<?php
													
														$campo_a_mostrar  = "nombre";
														$campo_a_insertar = "id";
														$nombre_tabla     = "pa_juzgado";
														$campo_a_ordenar  = "id";
														
														$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
																																					
																					
													?>
												</select>
																														
																										
											</td>
											
											
											
											<td>
												<label style="width:151px; color:#666666">Observacion:</label><br>
												<textarea name="observacionsr_a" id="observacionsr_a" cols="45" rows="5"></textarea>
											</td>
											
											
											
										</tr>
									
									</table>
									
								</td>
								
								
								
							</tr>
							
							
							<tr>
								
				
								<td colspan="7">
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												<!-- <button type="button" name="boton_aprobar_costas" id="boton_aprobar_costas" title="GENERAR APROBAR COSTAS"><img src="views/images/apply_f2.png" width="46" height="40"/>Generar Aprobar Costas</button> -->
												
												<button type="button" name="boton_avoca_conocimiento_tlc" id="boton_avoca_conocimiento_tlc" title="AVOCA CONOCIMIENTO / TRAS LIQUI CREDITO"><img src="views/images/apply_f2.png" width="46" height="40"/>Av Conocimiento / Tras Liqui Credi</button>
												
											</td>
											
											<td>
																	
												<button type="button" name="boton_avoca_conocimiento" id="boton_avoca_conocimiento" title="AVOCA CONOCIMIENTO"><img src="views/images/catalogo.png" width="46" height="40"/>Avoca Conocimiento</button>
												
											</td>
											
											<td>
																	
												<button type="button" name="boton_avoca_conocimiento_aprobar" id="boton_avoca_conocimiento_aprobar" title="AVOCA CONOCIMIENTO / APROBAR COSTAS"><img src="views/images/realizado.jpg" width="46" height="40"/>Avoca Conocimiento / Aprobar Costas</button>
												
											</td>
										
										</tr>
										
										
											
											
										
									
									</table>
									
								</td>
								
								
								
							</tr>
							
							
							<tr>
								
				
								<td colspan="7">
								
								 	<table>
									
										
										<tr>
										
											<td>
																	
												<button type="button" name="anular_liqui" id="anular_liqui" title="ANULAR LIQUIDACION"><img src="views/images/elim.png" width="20" height="20"/>ANULAR LIQUIDACION</button>
												
											</td>
											
											<td>
												<label style="width:151px; color:#666666">NOTA DE ANULACION:</label><br>
												<textarea name="observacionsr_anu" id="observacionsr_anu" cols="45" rows="5" maxlength = "1000"></textarea>
											</td>
										
										</tr>
										
										
											
											
										
									
									</table>
									
								</td>
								
								
								
							</tr>	
							
							
							
							<tr> 
																			
								<td><B>NUM</B></td>
								<td><B>FECHA</B></td>
								<td><B>HORA</B></td>
								<td><B>ESTADO</B></td>
								<td><B>NUEVO</B></td>
								<td><B>LIQ CREDITO</B></td>
								
								<td>
									
									<strong style="width:151px; color:#FF0000; font-size:12px">SELECCIONAR</strong>
								</td>
								
																							
							</tr> 
							
						</thead> 
																					
						<tbody> 
																					
							<?php 
																		
								$datosXPE    = explode("*/-*/-",$datos_liquidaciones); 
								$longitudPE  = count($datosXPE);
								$iE          = 0;
								//echo $longitud_1;
								
								$CiE=1;
																		
								while($iE < $longitudPE - 1){ 
																		
									$datosX_2PE = explode("------",$datosXPE[$iE]);
																		
								?>
																
								<tr>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[0];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[1];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[2];  
										?>
									</td>
									
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[3];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[4];  
										?>
									</td>
									
									<td>
										<?php 
																						  
											echo $datosX_2PE[5];  
										?>
									</td>
									
									<td>
									
										<!-- checkbox -->
										
										<!-- <input type="checkbox" id="<?php //echo trim("chk".$CiE); ?>" name="<?php //echo trim("chk".$CiE); ?>" title="<?php //echo trim("chk".$CiE); ?>" style="border-color:#0066CC"/> -->
										
										<!-- radio -->
										
										<input type="radio" id="<?php echo trim("chk".$CiE); ?>" name="liquidacionproc" title="<?php echo trim("LIQUIDACION ".$datosX_2PE[0]); ?>" style="border-color:#0066CC"/>
																
									</td>

									
																				
								</tr>
																		
																					
								<?php $iE = $iE + 1;  $CiE = $CiE+1; } ?>
								
								<tr>
									<td colspan="7">
									
										<center><strong style="font-size:16px">DETALLE LIQUIDACION</strong></center>
										
									</td>
									
								</tr>
								
								<tr>
										
											
									<td>
													
										<label style="width:151px; color:#666666">Item:</label><br>					
										<select name="item_liqui_nv" id="item_liqui_nv">
																																
																																	
											<option value="" selected="selected">Seleccionar Item</option>
																																			
											<?php
													
												$campo_a_mostrar  = "nomarticulo";
												$campo_a_insertar = "referencia";
												$nombre_tabla     = "item";
												$campo_a_ordenar  = "nomarticulo";
														
												$funcion->cargar_lista($campo_a_mostrar,$campo_a_insertar,$nombre_tabla,$campo_a_ordenar);
																																					
																					
											?>
										</select>
																														
																										
										</td>
										
										<td>
											<label style="width:151px; color:#666666">Valor:</label><br>
											<input type="text" name="valor_liqui_nv" id="valor_liqui_nv" class="required number" onKeyPress="return Solo_Numeros_y_Punto(event)" style="text-align:right"/>
										</td>
										
										<td colspan="5">
																	
											
											<button type="button" name="boton_guardar" id="boton_guardar" style="float:right" title="Guardar" onClick="Editar_Item_Liquidacion()"><img src="views/images/save.png" width="30" height="30"/>GUARDAR</button>
											<button type="button" name="boton_adicionar" id="boton_adicionar" style="float:right" title="Adicionar" onClick="Adicionar_Parte_nv(1)"><img src="views/images/adi.jpg" width="30" height="30"/>ADICIONAR</button>
																		
										</td>
										
										
										
									</tr>
									
									
									
																					
						</tbody>
							
					</table>
					
					
					
					
				</td>
				
				
		</tr>
		
		
		
		<!-- TABLA ITEM -->
							
		<tr>
								
			<td>
							
				<table align="center">
		
					<tr> 
						<td>
							<div id="cont_liqui_1"> 
							
								<table id="t_liqui_1" border="1" width="950"> 
															
									<tr>
																
										
										<td>
											<strong style="font-size:16px">ID</strong>
										</td>
										<td>
											<strong style="font-size:16px">ITEM</strong>
										</td>
										<td>
											<strong style="font-size:16px">VALOR</strong>
										</td>
										
										<td style="text-align:center">
											<strong style="font-size:16px">ELIMINAR</strong>
										</td>
																
									</tr>
															
								 
								</table>
							</div>
						</td>
												
					 </tr>
											
											
				</table>
							
			</td> 
								
		</tr>
		
		
		
		<!-- TABLA TOTAL -->
							
		<tr>
								
			<td>
							
				<table align="center" border="1" width="950">
		
					<tr>
						
						
						
						<td>
							<strong style="font-size:16px">TOTAL</strong>
						</td>
						
	
						<td>
                          <input type="text" name="total_liqui_nv" id="total_liqui_nv" readonly="true" style="font-size:24px; color:#FF0000; text-align:right"/>
						</td>
												
					</tr>
											
											
				</table>
							
			</td>
								
		</tr>

	</table>
	
	

<!-- </form> -->

<?php } ?>


