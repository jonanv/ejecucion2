$(function(){
	
	//ME PERMITE CARGAR UNA VENTANA Y MOSTRAR GRAFICA
	$(".grafica").click(function(){
	
		window.open("Graficas/Grafica_Procesos.php","GRAFICA","width=600,height=400,scrollbars=YES");
		
	});
	
	
	//ALERTA Visualizar Remate Sin Aprobar
	$('#btREMASA').click( function(){
										  
										  
		//var id    = $(this).attr('data-listadinamica');
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.dato_soli        = 0;
		//params.id_listadinamica = id;
		
		
			
	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/remates_sinaprobar.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
    });
	
	$('#btFILTROAUDI').click( function(){
										  
										  
		//var id    = $(this).attr('data-listadinamica');
			
		//var idfun = $("#funcionario_pres").find(':selected').val();
			
		params={};
		params.dato_soli        = 0;
		//params.id_listadinamica = id;
		
		
			
	
		//alert(params.eveasunto);
		$('#popupbox').load('views/popupbox/audiencias_filtro.php',params,function(){
			//alert(2);
			$('#block').show();
			//alert(3);
			$('#popupbox').show();
			//alert(4);
		})
		 
		
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


//---------------------------------ALERTAS--------------------------------------------------------
	
function notificacion(){
    //una notificación normal
	
	alertify.log("ALERTA AVISOS DE REMATES DISPONIBLES PARA APROBAR"); 
	return false;
}

function audiencia(){
    //una notificación normal
	
	alertify.log("ALERTA AUDIENCIAS PARA GESTIONAR"); 
	return false;
}

function actividad(){
    //una notificación normal
	
	alertify.log("ALERTA ACTIVIDADES PARA GESTIONAR"); 
	return false;
}

function tareasincerrar(){
    //una notificación normal
	
	//alertify.log("ALERTA TAREAS A DESPACHO, SIN CERRAR"); //COLOR NEGRO
	//alertify.success("ALERTA TAREAS A DESPACHO, SIN CERRAR"); //COLOR VERDE
	alertify.error("ALERTA TAREAS ASIGNADAS A PROCESOS A DESPACHO SIN CERRAR, DAR CLIC EN REPORTE TAREAS SIN CERRAR, SECCION REPORTES, NO APLICA NINGUN FILTRO");//COLOR ROJO 
	return false;
}

//---------------------------------FIN ALERTAS--------------------------------------------------------



function Reporte_Excel(id_reporte){
	
	//alert("reporte");
	//USO ESTA OPCION YA QUE TRABAJA CON LA actuacion_expediente
	
	if(id_reporte == 1){
		
		dato_1 = 3000;
		
		//ESTA OPCON TRABAJA CON LA TABLA detalle_correspondencia TAMBIEN FUNCIONA
		//dato_1 = 30000;
		
		dato_2 = document.getElementById('asignadoaf').value;
		
		//------------------------------------------------------------------------------------------------
		//ESTA OPCON TRABAJA CON LA TABLA detalle_correspondencia TAMBIEN FUNCIONA
		//dato_2 = $("#asignadoaf option:selected").text();
		//SI NO SE REALIZA ESTA COMPARACION SE PRESENTA INCONSISTENCIA EN LA GENERACION DEL REPORTE
		//YA QUE COMO USUARIO SE VA Seleccionar Asignado A Y ESTO NO ES UN NOMBRE DE USUARIO
		//if(dato_2 == "Seleccionar Asignado A"){ dato_2 = ""; }
		
		//------------------------------------------------------------------------------------------------
		
		dato_3 = document.getElementById('fechati').value;
		dato_4 = document.getElementById('fechatf').value;
		
	
		datos_reporte_2 = dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
	
		//alert (datos_reporte_2);
	
		location.href="/ejecucion/index.php?controller=archivo&action=listadoExcel&datos_reporte_2="+datos_reporte_2;
	
	}
	
	if(id_reporte == 2){
		
		
		
		//ESTA OPCON TRABAJA CON LA TABLA detalle_correspondencia TAMBIEN FUNCIONA
		dato_1 = 30000;
		

		//------------------------------------------------------------------------------------------------
		//ESTA OPCON TRABAJA CON LA TABLA detalle_correspondencia TAMBIEN FUNCIONA
		dato_2 = $("#asignadoaf option:selected").text();
		//SI NO SE REALIZA ESTA COMPARACION SE PRESENTA INCONSISTENCIA EN LA GENERACION DEL REPORTE
		//YA QUE COMO USUARIO SE VA Seleccionar Asignado A Y ESTO NO ES UN NOMBRE DE USUARIO
		if(dato_2 == "Seleccionar Asignado A"){ dato_2 = ""; }
		
		//------------------------------------------------------------------------------------------------
		
		dato_3 = document.getElementById('fechati').value;
		dato_4 = document.getElementById('fechatf').value;
		
	
		datos_reporte_2 = dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;
	
		//alert (datos_reporte_2);
	
		location.href="/ejecucion/index.php?controller=archivo&action=listadoExcel&datos_reporte_2="+datos_reporte_2;
	
	}
	
}



//********************************************************************************************
						//PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
						//ADICIONADO EL 10 DE JULIO 2019
//********************************************************************************************
var z_raC           = 1;
var Filas_raC       = 0;
//var cadena_fechas = " ";

function Adicionar_Solicitud(){
	
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
			
			var dato1_raC = document.getElementById('listaC').value+"-"+$("#listaC option:selected").text();
			var dato2_raC = document.getElementById('gc_ac_2').value;
			
			
			
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
	

	
	valor4 = document.getElementById('gc_ac_2').value;
	valor5 = document.getElementById('listaC').value;
	
	
	if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
		alert("Defina Usuario");
		//document.getElementById('listasr4[]').style.borderColor = '#FF0000';
		document.getElementById('listaC').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Descripcion");
		document.getElementById('gc_ac_2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	
	

}

function Limpiar_Campos_3_RAC(){
	
	
	
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
						//FIN PARA EL MANEJO DE SOLICITUD SOPORTE TECNICO
//********************************************************************************************




//********************************************************************************************
						//PARA EL MANEJO DEL PROGRAMADOR AUDIENCIAS
						//ADICIONADO EL 6 DE AGOSTO 2019
//********************************************************************************************

var z_AUDI           = 1;
var Filas_AUDI       = 0;
//var cadena_fechas = " ";

function Adicionar_Audi(){
	
	//NOTA: SE USA LA FUNCION tabla = reemplazarCadena("</table>", " ", tabla);
	//YA QUE COMO ESTABA tabla=tabla.substring(0,(tabla.length-8)); NO ME ELIMINABA 
	//LA PARTE </table> Y LAS FILAS QUEDAN POR FUERA DE LA TABLA GENERANDOSE UNA INCONSISTENCIA
	//EN OTRSO SISTEMAS COMO REPARTO MASICO DEL SIEPRO SI ME FUNCIONA tabla=tabla.substring(0,(tabla.length-8));
	
	//alert(z);
	//alert(Filas);
	
	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	//var existenumtitulo_ra = Validar_Radicado_Tabla_M();

	existenumtitulo_AUDI = 0;
	
	if(existenumtitulo_AUDI == 1){
		
		//existenumtitulo_ra = 1;
		//alert("Radicado Ya Fue Adicionado");
	}
	else{//1
		
	//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
	var validarcampos_AUDI = Validar_Campos_Agregar_AUDI();
	
	//validarcampos = 0;
	
	if(validarcampos_AUDI == 1){
		
		validarcampos_AUDI = 1;
	}
	else{//2
	
			//DATOS 
			
			//var dato1_raC = document.getElementById('listaC').value+"-"+$("#listaC option:selected").text();
			
			var dato1_AUDI;
			var dato2_AUDI = document.getElementById('audi_radi').value;
			var dato3_AUDI = document.getElementById('audi_fecha').value;
			var dato4_AUDI = document.getElementById('audi_horai').value;
			var dato5_AUDI = document.getElementById('audi_tipo_audi').value;
			
			var fechaactualregis = document.getElementById('fechaactualregis').value;
			//var fechaactualregis = '2019-08-09';
			
			//alert(fechaactualregis);
			
			//-------------------------------------------------------------------------------------------------------
			
			$.get("funciones/traer_datos_radicado_AUDI.php?idradicado="+dato2_AUDI+"&audi_fecha_X="+fechaactualregis, function(cadena){
																		   
				
				//alert(cadena);
				
				var vector_datos_1X = cadena.split("******");
				
				//var vector_datos = cadena.split("//////");
			
				var vector_datos = vector_datos_1X[0].split("//////");
		
				dato1_AUDI = " ";	
				dato1_AUDI = vector_datos[0];
				
				
				var vector_fechas = vector_datos_1X[1].split(" ");
				
				var fecha_1       = vector_fechas[0].split("/");
				var fecha_2       = fecha_1[2]+"-"+fecha_1[1]+"-"+fecha_1[0];
				
				
				//alert(dato1_AUDI);
	
				if(dato1_AUDI >= 1){
		
					//Filas = resultado.length;
					Filas_AUDI = 1;
					var cantidad_filas_AUDI;
					var TABLA_AUDI      = document.getElementById('t_AUDI');
					cantidad_filas_AUDI = TABLA_AUDI.rows.length;
			
					//alert(cantidad_filas);
					
					if(cantidad_filas_AUDI > 1){
								
						//alert('cantidad > 1');
							
						//Eliminar_Tabla();
						
						var tabla_AUDI = document.getElementById('cont_AUDI').innerHTML;
							
						//for (var id=0; id<Filas; id++){
						
							//tabla=tabla.substring(0,(tabla.length-8)); 
							
							tabla_AUDI = reemplazarCadena("</table>", " ", tabla_AUDI);
							
							tabla_AUDI+='<tr>';
							
							
							tabla_AUDI+='<td>'+dato1_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato2_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato3_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato4_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+fecha_2+'</td>';
							
							tabla_AUDI+='<td>'+dato5_AUDI+'</td>';
							
							
							
							tabla_AUDI+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_AUDI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
												
							tabla_AUDI+='</tr></table>';
							
							document.getElementById('cont_AUDI').innerHTML = tabla_AUDI;
							
							z_AUDI++;
							
							Limpiar_Campos_3_AUDI();
						 //}
					}
								
					if(cantidad_filas_AUDI == 1){
								
						//alert('cantidad = 1');
						
						var tabla_AUDI=document.getElementById('cont_AUDI').innerHTML;
						
						//alert(tabla);
						
						//for (var id=0; id<Filas; id++){
							
							//var partefinal = tabla.length - 8;
							
							//alert("Longitud Tabla: "+tabla.length);
							//alert("Parte Final: "+partefinal);
							
							//tabla=tabla.substring(0,(tabla.length-8));
							
							tabla_AUDI = reemplazarCadena("</table>", " ", tabla_AUDI);
							
							//tabla=tabla.substring(0,partefinal);
							
							
							//alert(tabla);
							
							tabla_AUDI+='<tr>';
							
							
							tabla_AUDI+='<td>'+dato1_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato2_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato3_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+dato4_AUDI+'</td>';
							
							tabla_AUDI+='<td>'+fecha_2+'</td>';
							
							tabla_AUDI+='<td>'+dato5_AUDI+'</td>';
							
							
							tabla_AUDI+='<td><button type=button name=eliminarreparto id=eliminarreparto onclick="Eliminar_Fila_AUDI(this.parentNode.parentNode.rowIndex)"><img src="views/images/eliminar.png" width="20" height="20" title="Eliminar Fila"/></button></td>';
							
							tabla_AUDI+='</tr></table>';
						
							//alert(tabla);
							document.getElementById('cont_AUDI').innerHTML=tabla_AUDI;
							
							z_AUDI++;
							
							Limpiar_Campos_3_AUDI();
						//}
					}
					
					
				}
				else{
					
					alert("Radicado no Existe, no es Posible su Adicion")
				}
				
				
			
			});//FIN $.get("funciones/traer_datos_radicado.php?idradicado="+dato2_AUDI, function(cadena){
				
			
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


function Validar_Campos_Agregar_AUDI(){
	
	var validar = 0;
	

	
	valor1 = document.getElementById('audi_radi').value;
	valor2 = document.getElementById('audi_fecha').value;
	valor3 = document.getElementById('audi_horai').value;
	valor3 = document.getElementById('audi_horai').value;
	valor4 = document.getElementById('audi_tipo_audi').value;
	
	
	if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
  		
		alert("Defina Radicado");
		//document.getElementById('listasr4[]').style.borderColor = '#FF0000';
		document.getElementById('audi_radi').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Fecha");
		document.getElementById('audi_fecha').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Hora");
		document.getElementById('audi_horai').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Tipo Audiencia");
		document.getElementById('audi_tipo_audi').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	

}

function Limpiar_Campos_3_AUDI(){
	
	
	
	document.getElementById('audi_radi').value = "";
	document.getElementById('audi_radi').style.borderColor='#E0E0E0';
	
	document.getElementById('audi_fecha').value = "";
	document.getElementById('audi_fecha').style.borderColor='#E0E0E0';
	
	document.getElementById('audi_horai').value = "";
	document.getElementById('audi_horai').style.borderColor='#E0E0E0';
	
	document.getElementById('audi_tipo_audi').selectedIndex = 0;
	document.getElementById('audi_tipo_audi').style.borderColor='#E0E0E0';
		
	
}

function Eliminar_Fila_AUDI(idfila){
	
	
	//alert(idfila);
	
	//document.getElementsByTagName("table")[0].setAttribute("id","t");
    //document.getElementById("t").deleteRow(idfila);
	
	var TABLA_AUDI = document.getElementById('t_AUDI');
	
	TABLA_AUDI.deleteRow(idfila);
	
	//z = z+1;
	
	//alert("idfila: "+idfila+" Z: "+z);*/
	
	
}



//********************************************************************************************
						//FIN PARA EL MANEJO DEL PROGRAMADOR AUDIENCIAS
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


function Proceso_Bloqueado(valor_radicado){
	
	//alert(valor_radicado);
	
	$.get("funciones/traer_radicado_bloqueado.php?idradicado="+valor_radicado, function(cadena){
																		   
				
				var vector_datos = cadena.split("//////");
		
				//alert(vector_datos[0]);
				
				var proc_bloqueado = vector_datos[0];
				
				if(proc_bloqueado == 1){
					
					alert("EXPEDIENTE BLOQUEADO");
					
					document.getElementById('audi_radi').value = "";
					
				}
				
				
	
	});
	
	
}

