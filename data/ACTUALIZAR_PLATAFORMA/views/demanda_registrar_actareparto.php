
<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new demandaModel();
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	//DEFINEN DONDE QUEDARA LA DEMANDA 
	$DESiddepartamento  =  $_SESSION['iddepartamento'];
	$DESidmunicipio     =  $_SESSION['idmunicipio'];
	
	
	//DATO ID DEMANDA A REALIZAR EL ACTA DE REPARTO
	$iddemanda      = $_GET['iddemanda'];
	//echo $iddemanda;
	
	//LISTA BASE DE DATOS LOCAL
	
	/*$nombrelista  = 'dda_despacho';
	$campoordenar = 'id';
	$formaordenar = '';
	$datosDES     = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);*/
	
	    
	$nombrelista  = 'dda_despacho';
	$campoordenar = 'id';
	$filtro       = "WHERE iddepartamento = '$DESiddepartamento' AND idmunicipio = '$DESidmunicipio'";
	$formaordenar = '';
	$datosDES     = $modelo->get_lista_filtro($nombrelista,$campoordenar,$formaordenar,$filtro);
	
	
	
	
	
	//DATOS ACCION		
	/*$opcion = trim($_GET['dato_0']);
	
	
	if($opcion == 1){
	
		
		$datosACCION_1 = $modelo->listar_demanda();
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_demanda();
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************

	}
	else{
	
	
		$datosACCION_1 = $modelo->listar_demanda($idusuario);
		
		//*********************CANTIDAD REGISTROS*****************************************
	
		$datosACCION = $modelo->listar_demanda($fechaactual);
		
		$fc = 0;
		while($fila_cant = $datosACCION->fetch()){		
		
			$fc = $fc + 1; 
		
		}
		
 		$cantregis = $fc;
		
		//*************************************************************************************
	
	}*/

	

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>REGISTAR DEMANDA</title>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->




        
        <meta charset="utf-8" />
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
        <!-- <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script> -->
		
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		
<script type="text/javascript">



$(document).ready(function() {

	<!-- CAMPO TARJETA PROFESIONAL APODERADO -->
	$('#filatp').hide();
	
	
	$("#entidad").change(function(event){
	
		//alert("entre");
    	
		var id = $("#entidad").find(':selected').val();
						
		$("#especialidad").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+2);
					
						
	});
	
			
	$("#lista1").change(function(event){
	
		//alert("entre");
    	
		var id = $("#lista1").find(':selected').val();
						
		$("#lista2").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1);
					
						
	});
	
	$("#lista3").change(function(event){
	
		var id = $("#lista3").find(':selected').val();
		
		//alert(id);
		
		if(id == 3){
		
			$('#filatp').show();
		
		}
		else{
		
			$('#filatp').hide();
		}
    	
		
	});
	
	
	
	$("#registrar_acta").click(function(evento){
	
			
				//PASOMOS VARIABLES PHP A JAVASCRIPT
				//var sola_UNA = "<?php echo $sola_UNA; ?>";
				
			
				var validar    = 0;
				
				var dataString = "";
		
		
				if( $('#despacho').val() == null || $('#despacho').val().length == 0 || /^\s+$/.test($('#despacho').val()) ) {
				
					msg = "Defina Despacho";
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');
					
					setTimeout(function() {
						$(".mensage").fadeOut(4000);
					},10000);
					
					validar = 1;
					
					return false;
					
				}
			
				else{
				
				
					
					//dataString += '&idhcet='+$("#idhcet").val();
					
					dataString += '&despacho='+$("#despacho").find(':selected').val();
					
				}
				
				if( $('#archivodes').val() == null || $('#archivodes').val().length == 0 || /^\s+$/.test($('#archivodes').val()) ) {
				
					msg = "Defina ARCHIVO(S) ACTA";
					$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
					$('.mensage').show('slow');
					
					setTimeout(function() {
						$(".mensage").fadeOut(4000);
					},10000);
					
					validar = 1;
					
					return false;
					
				}
			
				else{
				
				
					
					//dataString += '&idhcet='+$("#idhcet").val();
					
					dataString += '&archivodes='+$("#archivodes").val();
					
				}
				
					
				if(validar == 0){
				
					
					
						//var inputFileImage = document.getElementById("archivodda");
						//var file           = inputFileImage.files[0];
						
						//Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivodda'
						var archivos = document.getElementById("archivodes");
						//Obtenemos los archivos seleccionados en el imput
						var archivo  = archivos.files;
						
						//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
						//Y EL RESTO DE CAMPOS VIA POST
						var data = new FormData();
						
						<!-- CAPTURO VARIOS ARCHIVO -->
						/* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
						Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
						indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
						for(i=0; i<archivo.length; i++){
							
							data.append('archivo'+i,archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
						
						}
			
						
						//data.append(COMO LO CAPTURA PHP,VALOR DATO);
						
						data.append('iddemanda',$('#dato_iddemanda').val());
						data.append('despacho',$('#despacho').val());
						
						//alert($('#dato_iddemanda').val());
				
						if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
						
						
							//$('#datos_acti').val('');
							//$('#datos_acti').val(idspermisoRC2);
							
							//dataString += '&datospartes='+$('#datos_acti').val();
							
							//data.append('datospartes',$('#datos_acti').val());
							
							/*Ejecutamos la función ajax de jQuery*/		
							$.ajax({
								
								//url:'views/popupbox/subir.php', //Url a donde la enviaremos
								url:'index.php?controller=demanda&action=Registrar_Acta_Reparto_2',
								type:'POST', //Metodo que usaremos
								contentType:false, //Debe estar en false para que pase el objeto sin procesar
								//data:dataString, //Le pasamos el objeto que creamos con los archivos
								data:data,
								processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
								cache:false //Para que el formulario no guarde cache
							}).done(function(msg){//Escuchamos la respuesta y capturamos el mensaje msg
								
								$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
								$('.mensage').show('slow');//Mostramos el div.
								
								//DESAPARECER
								setTimeout(function() {
									
									$(".mensage").fadeOut(1500);
									
									var msgrespuesta = msg.split("-");
									
									if(msgrespuesta[0] == 1){
									
										location.href = "index.php?controller=demanda&action=Listar_Demandas_2";
									}
									
									
									
								},3000);
								
							
							});
							
							
							
						
						}
					
					
				}
				
				
			
			
								 
		});
		
				
				
});//FIN $(document).ready(function() {
		
</script>	


<script type="text/javascript">


/*function Adicionar_Parte(){

	alert("ENTRE")

}*/

//********************************************************************************************
						//PARA EL MANEJO DE TABLA DETALLE ABONOS
						//ADICIONADO EL 10 DE MAYO 2020
//********************************************************************************************
var z_raC           = 1;
var Filas_raC       = 0;
//var cadena_fechas = " ";



function Adicionar_Parte(){
	
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
			
			
			
			//var valor_1  = document.getElementById('entidad').value+"-"+$("#entidad option:selected").text();
			//var valor_2  = document.getElementById('especialidad').value+"-"+$("#especialidad option:selected").text();
			
			var valor_3  = document.getElementById('nomddte').value;
			var valor_4  = document.getElementById('docddte').value;
			var valor_5  = document.getElementById('lista1').value;
			var valor_6  = document.getElementById('lista2').value;
			var valor_7  = document.getElementById('dirddte').value;
			var valor_8  = document.getElementById('telddte').value;
			var valor_10 = document.getElementById('correo').value;
			var valor_9  = document.getElementById('lista3').value+"-"+$("#lista3 option:selected").text();
			
			var idapo = $("#lista3").find(':selected').val();
	
			if(idapo == 3){
			
				valor_9  = valor_9+"-"+document.getElementById('tpddte').value;
			}
			
			//CAROGO VECTOR CON LOS ID DE LAS PARTES
			//PARA ASEGURARME QUE LA DEMANDA CONTARA ALMENOS CON
			//UN DEMANDANTE, UN APODEADO Y UN DEMANDADO
			//idpartes[] = idapo;
			//idpartes.push(idapo);
			
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
					
					
				
					tabla_raC+='<td>'+valor_3+'</td>';
					
					tabla_raC+='<td>'+valor_4+'</td>';
					
					tabla_raC+='<td>'+valor_5+'</td>';
					
					tabla_raC+='<td>'+valor_6+'</td>';
					
					tabla_raC+='<td>'+valor_7+'</td>';
					
					tabla_raC+='<td>'+valor_8+'</td>';
					
					tabla_raC+='<td>'+valor_10+'</td>';
					
					tabla_raC+='<td>'+valor_9+'</td>';
					
					
					
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
					
					
				
					tabla_raC+='<td>'+valor_3+'</td>';
					
					tabla_raC+='<td>'+valor_4+'</td>';
					
					tabla_raC+='<td>'+valor_5+'</td>';
					
					tabla_raC+='<td>'+valor_6+'</td>';
					
					tabla_raC+='<td>'+valor_7+'</td>';
					
					tabla_raC+='<td>'+valor_8+'</td>';
					
					tabla_raC+='<td>'+valor_10+'</td>';
					
					tabla_raC+='<td>'+valor_9+'</td>';
					
					
					
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
	

	valor1  = document.getElementById('entidad').value;
	valor2  = document.getElementById('especialidad').value;
	valor3  = document.getElementById('nomddte').value;
	valor4  = document.getElementById('docddte').value;
	valor5  = document.getElementById('lista1').value;
	valor6  = document.getElementById('lista2').value;
	valor7  = document.getElementById('dirddte').value;
	valor8  = document.getElementById('telddte').value;
	valor9  = document.getElementById('lista3').value;
	valor10 = document.getElementById('tpddte').value;
	
	valor11 = document.getElementById('juri').value;
	valor12 = document.getElementById('cpro').value;
	
	valor13 = document.getElementById('cuadernos').value;
	valor14 = document.getElementById('folios').value;
	
	valor15 = document.getElementById('correo').value;
	
	
	if( valor11 == null || valor11.length == 0 || /^\s+$/.test(valor11) ) {
  		
		alert("Defina Jurisdiccion");
		document.getElementById('juri').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor12 == null || valor12.length == 0 || /^\s+$/.test(valor12) ) {
  		
		alert("Defina Grupo/Clase de Proceso");
		document.getElementById('cpro').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}

	if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
  		
		alert("Defina Entidad");
		document.getElementById('entidad').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Especialidad");
		document.getElementById('especialidad').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor13 == null || valor13.length == 0 || /^\s+$/.test(valor13) ) {
  		
		alert("Defina N.Cuadernos");
		document.getElementById('cuadernos').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	if( valor14 == null || valor14.length == 0 || /^\s+$/.test(valor14) ) {
  		
		alert("Defina Folios Correspondientes");
		document.getElementById('folios').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Nombre");
		document.getElementById('nomddte').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina N.C.C. o NIT");
		document.getElementById('docddte').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Departamento");
		document.getElementById('lista1').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor6 == null || valor6.length == 0 || /^\s+$/.test(valor6) ) {
  		
		alert("Defina Municipio");
		document.getElementById('lista2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor7 == null || valor7.length == 0 || /^\s+$/.test(valor7) ) {
  		
		alert("Defina Direccion Notificacion");
		document.getElementById('dirddte').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor8 == null || valor8.length == 0 || /^\s+$/.test(valor8) ) {
  		
		alert("Defina Celular / Telefono");
		document.getElementById('telddte').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor15 == null || valor15.length == 0 || /^\s+$/.test(valor15) ) {
  		
		alert("Defina Correo Electronico");
		document.getElementById('correo').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor9 == null || valor9.length == 0 || /^\s+$/.test(valor9) ) {
	
		
		alert("Defina Parte en el Proceso");
		document.getElementById('lista3').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
		
	}
	else{
	
		var idapo = $("#lista3").find(':selected').val();
	
		if(idapo == 3){
		
			if( valor10 == null || valor10.length == 0 || /^\s+$/.test(valor10) ) {
			
				alert("Defina Tarjeta Profesional Apoderado");
				document.getElementById('tpddte').style.borderColor = '#FF0000';
				validar = 1;
				return validar;
			}
  		
			
		}
	
	
	
	}
	
	
	
	
	
	

}

function Limpiar_Campos_3_RAC(){
	
	//document.getElementById('juri').selectedIndex = 0;
	//document.getElementById('cpro').selectedIndex = 0;
	
	//document.getElementById('entidad').selectedIndex = 0;
	//document.getElementById('especialidad').selectedIndex = 0;
	
	document.getElementById('nomddte').value = "";
	document.getElementById('docddte').value = "";
	document.getElementById('lista1').selectedIndex = 0;
	document.getElementById('lista2').selectedIndex = 0;
	document.getElementById('dirddte').value = "";
	document.getElementById('telddte').value = "";
	document.getElementById('correo').value = "";
	document.getElementById('lista3').selectedIndex = 0;
	document.getElementById('tpddte').value = "";
	
	
	
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

<!-- Creamos un estilo para nuestro mensajes -->
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
		
</style>

</head>

<body>

<center><h1 class="page-header">REGISTAR ACTA REPARTO</h1></center>

<center><h3 class="page-header"><?php require_once('demanda_ubicacion.php'); ?></h3></center>

<div class="well well-sm text-right">

	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Cerrar Sesion">
		Menu-Principal
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
    
	<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
		Cerrar-Sesion
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
</div>

<center><h3 class="page-header">ID DEMANDA:<?php echo $iddemanda; ?></h3></center>

<!-- <h4 class="page-header"><?php //echo "CEDULA :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></h4> -->

<div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=demanda&action=Listar_Demandas_2" title="Volver al Menu Principal">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>


<!-- <input type="hidden" name="datos_acti" id="datos_acti" readonly="true"/> -->

<input type="hidden" name="dato_iddemanda" id="dato_iddemanda" value="<?php echo $iddemanda; ?>" readonly="true"/>

<center><h4 class="page-header">DATOS PARA EL ACTA DE REPARTO</h4></center>


<table class="table"> 

	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	
</table>


<form id="frmact" enctype="multipart/form-data">


	<div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Despacho</label>
			 
			  <select class="form-control" name="despacho" id="despacho">
														
				<option value="" selected="selected">Seleccionar Despacho</option> 
																	
				<?php
					while($row = $datosDES->fetch()){
																				
						echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
																				
																				
					}
				?>
			</select>
		  
		  
		</div>
		
		<!-- <div class="form-group col-md-6">
		  <label for="input_1">N.Cuadernos</label>
		  <input type="text" class="form-control" name="cuadernos" id="cuadernos" placeholder="Ingrese cuadernos">
		</div> -->
		
		
		
	</div>

	
	

<table class="table"> 


	<tr>
															
		<td>
				
			<div class="form-row">
	  
				<div class="form-group col-md-6">
				 
				  <label style="width:380px; height:23px; border-color:#000000; color:#FF0000; font-size:18px ">CARGAR ARCHIVO(S) ACTA DE REPARTO</label><br>
				  <label style="width:500px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">EL NOMBRE DEL ARCHIVO(S) DEBE SER SIN TILDES,SIN ESPACIOS Y FORMATO PDF</label><br>
				  <label style="width:500px; height:23px; border-color:#000000; color:#FF0000; font-size:12px ">MANEJAR NOMBRES CORTOS Y REFERENTE A LO QUE SE DESEA CARGAR</label>
				 
				  <!-- SE SELECCIONA UN SOLO ARCHIVO -->
				  <!-- <input type="file" name="archivodda" id="archivodda" title="CARGAR DEMANDA" size="19" placeholder="Ingrese pdf"/> -->
				  
				  <!-- SE SELECCIONA VARIOS ARCHIVOS -->
				  <input type="file" multiple="multiple" name="archivodes" id="archivodes" title="CARGAR ARCHIVO(S) DEMANDA" size="19" placeholder="Ingrese pdf"/>
				
				</div>
				
				
			</div>
			
		</td>
		
		
			
	</tr> 
	
	
	
</table>
	
	
    
</form>


<br>

<table class="table"> 


	<tr>
															
		
		
		<!-- <td>
		
			<a id="registrar_acta" title="REGISTRAR ACTA">
			
				<button type="button" class="btn btn-default" title="REGISTRAR ACTA">
					<span class="glyphicon glyphicon-floppy-saved"></span>REGISTRAR ACTA
				</button>
			
			</a>
			
		</td> -->
		
		<td>
		
			<a id="registrar_acta" title="REGISTRAR ACTA">
			
				<button type="button" class="btn btn-success" title="REGISTRAR ACTA">
					<span class="glyphicon glyphicon-floppy-saved"></span>REGISTRAR ACTA
				</button>
			
			</a>
			
		</td>
		
			
	</tr> 
	
	
	
</table>		




<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>
