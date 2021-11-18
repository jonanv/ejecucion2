
<?php 
	
	
	//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
	$modelo      = new usuarioModel();
	
	//SE CAPTURA EL VALOR DEL MUNICIPIO
	//PARA SABER EL RANGO DE HORAS EN QUE SE PUEDE
	//REGISTRAR DEMANDAS
	$iddepartamento  =  $_SESSION['iddepartamento'];
	$idmunicipio     =  $_SESSION['idmunicipio'];
	
	$esabogado       =  $_SESSION['esabogado'];
	
	//echo $esabogado;
	
	//OBTENEMOS LA FECHA ACTUAL
	$fechaactual = $modelo->get_fecha_actual_amd();
	
	//HORA MILITAR
	$horaactual = $modelo->get_hora_actual_24horas();
	
	//$horaactual = strtotime($horaactual);
	
	$horaactual = $horaactual;
	
	//echo $horaactual."<br>";
	
	//NOTA: EN LA BASE DE DATOS TABLA dda_municipio EN LA COLUMNA hi Y hf
	//DEBE SER DE LA SIGUEINTE FORMA hi:07:30 - hf: 22:00
	//ES DECIR LA HORA INICIAL SE DEFINE DE LA FORMA 07:30 NO 7:30
	$rango_horas = $modelo->rango_horas_municipio($idmunicipio,$iddepartamento);	
	$rango       = $rango_horas->fetch();
	//$hi          = strtotime($rango[hi]);
	//$hf          = strtotime($rango[hf]);
	
	$hi          = $rango[hi];
	$hf          = $rango[hf];
	
	$hi2         = $rango[hi2];
	$hf2         = $rango[hf2];
	
	
	$idusuario      = $_SESSION['idUsuario'];
	
	$identidad_user = $_SESSION['nomusu'];
	$nombre_user    = $_SESSION['nombre'];
	
	
	
	//echo $idmunicipio;
	
	//LISTA BASE DE DATOS LOCAL
	
	$nombrelista  = 'dda_jurisdiccion';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosJURI    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'dda_claseproceso';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosCPRO    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'dda_entidad';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosCORPO   = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	$nombrelista  = 'dda_departamento';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosDPTO    = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	$nombrelista  = 'dda_tipopartes';
	$campoordenar = 'des';
	$formaordenar = '';
	$datosPARTE   = $modelo->get_lista($nombrelista,$campoordenar,$formaordenar);
	
	
	

//RANGO DE HORA EN EL CUAL SE PUEDE REGISTRAR DEMANDAS -->
//if( (trim($horaactual) >= $hi && trim($horaactual) <= $hf) || (trim($horaactual) >= $hi2 && trim($horaactual) <= $hf2) ){

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>REGISTAR USUARIO</title>
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


//---------------------------------RANGO HORA--------------------------------------------------------

function horario(){

    //una notificación normal
	
	var iddepartamentoH = "<?php echo $iddepartamento; ?>";
	var idmunicipioH    = "<?php echo $idmunicipio; ?>";
	
	
	$.get('funciones/dda_horario.php?iddepartamentoH='+iddepartamentoH+"&idmunicipioH="+idmunicipioH, function(horaX){
		
				
		//alert(horaX);
		//return false;
		var flag = 0;
		
		var rango_horas = horaX.split("//////");
		
		//DIA
		var hi  = rango_horas[0];
		var hf  = rango_horas[1];
	
		//TARDE
		var hi2 = rango_horas[2];
		var hf2 = rango_horas[3];
		
		var horaactual = rango_horas[4];
		
		
		if( (horaactual >= hi && horaactual <= hf) || (horaactual >= hi2 && horaactual <= hf2) ){
		
			flag = 1;
		}
		else{
		
			
			alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL DIA:"+hi+"-"+" HORA FINAL DIA:"+hf+" HORA ACTUAL:"+horaactual+" HORA INICIAL TARDE:"+hi2+"-"+" HORA FINAL TARDE:"+hf2+" HORA ACTUAL:"+horaactual);
					
			location.href = "index.php?controller=demanda&action=Cerrar_Session";
		
		}
				
			
	} );
	
		
	
}


/*var jClockInterval = setInterval(function(){
   horario();
}, 5000);*/

//---------------------------------FIN RANGO HORA--------------------------------------------------------

</script>
		
		
<script type="text/javascript">



$(document).ready(function() {

	<!-- CAMPO TARJETA PROFESIONAL APODERADO -->
	$('#filatp').hide();
	
	//OCULTAR GIF CARGANDO
	$('#fila_cargando').hide();
	
	
	
	$("#juri").change(function(event){
	
		//alert("entre");
    	
		var id = $("#juri").find(':selected').val();
						
		$("#entidad").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+4);
					
						
	});
	
	$("#entidad").change(function(event){
	
		//alert("entre");
    	
		var id = $("#entidad").find(':selected').val();
						
		$("#especialidad").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+2);
					
						
	});
	
	
	$("#especialidad").change(function(event){
	
		//alert("entre");
		
		var iddpto = "<?php echo $iddepartamento; ?>";
		var idmuni = "<?php echo $idmunicipio; ?>";
    	
		var id = $("#especialidad").find(':selected').val();
						
		$("#cpro").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+5+"&iddpto="+iddpto+"&idmuni="+idmuni);
					
						
	});
	
	
	
			
	$("#lista1").change(function(event){
	
		//alert("entre");
		
		//SOLO CARGARA LA LISTA DEL MUNICIPIO LOGEADO
		//var lidmunicipio = "<?php echo $idmunicipio; ?>";
		
		var id = $("#lista1").find(':selected').val();
						
		//CUANDO SOLO SE DESEE ESPECIFICAR UN DEPARTAMENTO Y UN MUNICIPIO
		//$("#lista2").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+1+"&lidmunicipio="+lidmunicipio);
		
		$("#lista2").load('funciones/dda_traer_datos_lista.php?id='+id+"&idsql="+6);
					
						
	});
	
	$("#lista3").change(function(event){
	
		var id        = $("#lista3").find(':selected').val();
		
		var idvalor_2 = $("#docddte").val(); 
		
		/*var Dnomddte_2 = "";
		var Ddirddte_2 = "";
		var Dtelddte_2 = "";
		var Dcorreo_2  = "";*/
		var Dtp_2      = "";
		
		//alert(id);
		
		//ES APODERADO
		if(id == 3){
		
		
			
			valor4  = document.getElementById('docddte').value;

			if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
					
					alert("Defina N.C.C. o NIT");
					document.getElementById('docddte').style.borderColor = '#FF0000';
					
					document.getElementById('lista3').selectedIndex = 0;
					
					return false;
			}
			else{
			
				$.get("funciones/dda_datos_usuario.php?cedula_user="+idvalor_2, function(cadena){
											
					//alert(cadena);
					
					if(cadena == 0){
					
						/*$('#nomddte').val('');
						$('#dirddte').val('');
						$('#telddte').val('');
						$('#correo').val('');*/
						$('#tpddte').val('');
					
					}
					else{
					
						var vector_datos_usuario = cadena.split("//////");
						
						if(vector_datos_usuario.length == 9){
								
							/*Dnomddte_2 = vector_datos_usuario[2];
							Ddirddte_2 = vector_datos_usuario[5];
							Dtelddte_2 = vector_datos_usuario[6];
							Dcorreo_2  = vector_datos_usuario[8];*/
							Dtp_2      = vector_datos_usuario[7];
							
							/*$('#nomddte').val(Dnomddte_2);
							$('#dirddte').val(Ddirddte_2);
							$('#telddte').val(Dtelddte_2);
							$('#correo').val(Dcorreo_2);*/
							$('#tpddte').val(Dtp_2);
							
						
						}
						else{
						
							
							$('#tpddte').val('');
						}
						
					}
						
					
					$('#filatp').show();	
					
				});
				
			}
		
		
		
		
			
			
			
			
		
		}
		else{
		
			$('#tpddte').val('');
			$('#filatp').hide();
		}
    	
		
	});
	
	
	
	$("#registrar_demanda").click(function(evento){
	
	
		
			
			//PASOMOS VARIABLES PHP A JAVASCRIPT
			//var sola_UNA = "<?php echo $sola_UNA; ?>";
			var iddpto    = "<?php echo $iddepartamento; ?>";
			var idmuni    = "<?php echo $idmunicipio; ?>";
			
			var esabogado = "<?php echo $esabogado; ?>";
			
			var oficina_reparto = 0;
			//alert(iddpto+" - "+idmuni);
			
			
			var validar = 0;
		
			
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
				//d4hRC2  = document.getElementById("t_raC").rows[r].cells[4].innerText;
				//d5hRC2  = document.getElementById("t_raC").rows[r].cells[5].innerText;
				d6hRC2  = document.getElementById("t_raC").rows[r].cells[4].innerText;
				
				d7hRC2  = document.getElementById("t_raC").rows[r].cells[5].innerText;
				
				d8hRC2  = document.getElementById("t_raC").rows[r].cells[6].innerText;
				
				
				
				
				//if($("#chk"+fR).is(':checked')) {  
					
						//alert("ENTRE");
						

						//CONCATENO TODOS LOS REGISTROS DE LA TABLA
						//idspermisoRC2 = d0hRC2+"//////"+d1hRC2+"//////"+d2hRC2+"//////"+d3hRC2+"//////"+d4hRC2+"//////"+d5hRC2+"//////"+d6hRC2+"******"+idspermisoRC2;
						
						idspermisoRC2 = d0hRC2+"//////"+d1hRC2+"//////"+d2hRC2+"//////"+d3hRC2+"//////"+d6hRC2+"//////"+d7hRC2+"//////"+d8hRC2+"******"+idspermisoRC2;
						
						idspermiso_realC2 = 1;
						
						
						
				//}
				
				
				
					
				fRC2 = fRC2 + 1;
				
				
			}
			
			
			
			
			if(idspermiso_realC2 == 0){
			
				
				msg = "No se Cuenta con Ningun Registro en la TABLA USUARIOS(S) ADICIONADO(S)";
				$('.mensage').html(msg);//A el div con la clase msg, le insertamos el mensaje en formato  thml
				$('.mensage').show('slow');
				
				setTimeout(function() {
					$(".mensage").fadeOut(4000);
				},10000);
				
				validar = 1;
				
				return false;
				
				
				
				
					
			}
			else{
		
					
				if(validar == 0){
				
					
									//DE ESTA FORMA PARA PODER PASAR CAMPO FILE 
									//Y EL RESTO DE CAMPOS VIA POST
									var data = new FormData();
				
									//data.append(COMO LO CAPTURA PHP,VALOR DATO);
									
									/*data.append('dato1',$('#dato1').val());
									data.append('dato2',$('#dato2').val());
									data.append('dato3',$('#dato3').val());
									data.append('dato4',$('#dato4').val());
									data.append('lista1',$('#lista1').val());
									data.append('lista2',$('#lista2').val());
									data.append('dato5',$('#dato5').val());*/
									
									<!-- CAPTURO ARCHIVO -->
									//data.append('archivo',file);
									
									
							
									if (confirm ("ESTA SEGURO DE REALIZAR EL PROCESO")) {
									
									
										//OCULTAMOS BOTON REGISTRAR
										//PARA EVITAR QUE EL USUARIO DE CLIC
										//VARIAS VECES Y LA DEMANDA SE DUPLIQUE
										$('#registrar_demanda').hide();
										
										$('#fila_cargando').show();
									
									
									
										$('#datos_acti').val('');
										$('#datos_acti').val(idspermisoRC2);
										
										//dataString += '&datospartes='+$('#datos_acti').val();
										
										data.append('datospartes',$('#datos_acti').val());
										
										//Ejecutamos la función ajax de jQuery		
										$.ajax({
											
											//url:'views/popupbox/subir.php', //Url a donde la enviaremos
											url:'index.php?controller=usuario&action=Registrar_Usuarios',
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
												
												
												$('#registrar_demanda').show();
										
												$('#fila_cargando').hide();
												
												
												var msgrespuesta = msg.split("-");
												
												if(msgrespuesta[0] == 1){
												
													location.href = "index.php?controller=usuario&action=Listar_Usuarios";
												}
												
												
												
												
												
												
												
											},3000);
											
										
										});
										
										
										
									
									}
									
									
								
		
					
					
				}
				
				
			}
			
								 
		});
		
				
				
});//FIN $(document).ready(function() {
		
</script>	


<script type="text/javascript">


/*function Adicionar_Parte(){

	alert("ENTRE")

}*/


function Traer_Datos_Usuario(idvalor){
	
	//alert(idvalor);
	
	//$('#dato1').val(idvalor.trim());
	
	$.get("funciones/dda_datos_pa_usuario.php?cedula_user="+idvalor.trim(), function(cadena){
								
		//alert(cadena);
		
		if(cadena == 0){
		//if(cadena >= 1){
		
			cadena = 0;
		
		
		}
		else{
		
			alert("USUARIO YA EXISTE NO ES POSIBLE SU ADICION");
		
			$('#dato1').val('');
			$('#dato2').val('');
			$('#dato3').val('');
			$('#dato4').val('');
			
			
		}
			
			
		
	});
	
	
	
}

//********************************************************************************************
						//PARA EL MANEJO DE TABLA DETALLE 
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
			
			var valor_1  = document.getElementById('dato1').value;
			var valor_2  = document.getElementById('dato2').value;
			var valor_3  = document.getElementById('dato3').value;
			var valor_4  = document.getElementById('dato4').value;
			//var valor_5  = document.getElementById('lista1').value;
			//var valor_6  = document.getElementById('lista2').value;
			var valor_7  = document.getElementById('dato5').value+"-"+dato5.options[dato5.selectedIndex].text;
			var valor_8  = document.getElementById('dato6').value;
			var valor_9  = document.getElementById('dato7').value;
			
			
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
					
					
				
					tabla_raC+='<td>'+valor_1+'</td>';
					
					tabla_raC+='<td>'+valor_2+'</td>';
					
					tabla_raC+='<td>'+valor_3+'</td>';
					
					tabla_raC+='<td>'+valor_4+'</td>';
					
					//tabla_raC+='<td>'+valor_5+'</td>';
					
					//tabla_raC+='<td>'+valor_6+'</td>';
					
					tabla_raC+='<td>'+valor_7+'</td>';
					
					tabla_raC+='<td>'+valor_8+'</td>';
					
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
					
					
				
					tabla_raC+='<td>'+valor_1+'</td>';
					
					tabla_raC+='<td>'+valor_2+'</td>';
					
					tabla_raC+='<td>'+valor_3+'</td>';
					
					tabla_raC+='<td>'+valor_4+'</td>';
					
					//tabla_raC+='<td>'+valor_5+'</td>';
					
					//tabla_raC+='<td>'+valor_6+'</td>';
					
					tabla_raC+='<td>'+valor_7+'</td>';
					
					tabla_raC+='<td>'+valor_8+'</td>';
					
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
	

	valor1  = document.getElementById('dato1').value;
	valor2  = document.getElementById('dato2').value;
	valor3  = document.getElementById('dato3').value;
	valor4  = document.getElementById('dato4').value;
	//valor5  = document.getElementById('lista1').value;
	//valor6  = document.getElementById('lista2').value;
	valor7  = document.getElementById('dato5').value;
	
	valor8  = document.getElementById('dato6').value;
	
	valor9  = document.getElementById('dato7').value;
	
	if( valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1) ) {
  		
		alert("Defina N.C.C. o NIT (USUARIO)");
		document.getElementById('dato1').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	

	
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2) ) {
  		
		alert("Defina Contraseña");
		document.getElementById('dato2').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor3 == null || valor3.length == 0 || /^\s+$/.test(valor3) ) {
  		
		alert("Defina Nombre");
		document.getElementById('dato3').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	
	if( valor4 == null || valor4.length == 0 || /^\s+$/.test(valor4) ) {
  		
		alert("Defina Correo Electronico");
		document.getElementById('dato4').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
	}
	else{
	
		if($("#dato4").val().indexOf('@', 0) == -1 || $("#dato4").val().indexOf('.', 0) == -1) {
		
            alert('El correo electronico introducido no es correcto.');
			document.getElementById('dato4').style.borderColor = '#FF0000';
			validar = 1;
			return validar;
            //return false;
        }
		
	}

	/*if( valor5 == null || valor5.length == 0 || /^\s+$/.test(valor5) ) {
  		
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
	}*/
	
	
	if( valor7 == null || valor7.length == 0 || /^\s+$/.test(valor7) ) {
	
		
		alert("Defina Tipo Usuario");
		document.getElementById('dato5').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
		
	}
	/*else{
	
		var idapo = $("#valor7").find(':selected').val();
	
		//ABOGADO
		if(idapo == 1){
		
			
  		
			
		}
	
	
	
	}*/
	
	if( valor8 == null || valor8.length == 0 || /^\s+$/.test(valor8) ) {
	
		
		alert("Defina Celular");
		document.getElementById('dato6').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
		
	}
	
	
	if( valor9 == null || valor9.length == 0 || /^\s+$/.test(valor9) ) {
	
		
		alert("Defina es Entidad");
		document.getElementById('dato7').style.borderColor = '#FF0000';
		validar = 1;
		return validar;
		
		
	}
	
	
	

}

function Limpiar_Campos_3_RAC(){
	
	//document.getElementById('juri').selectedIndex = 0;
	//document.getElementById('cpro').selectedIndex = 0;
	
	//document.getElementById('entidad').selectedIndex = 0;
	//document.getElementById('especialidad').selectedIndex = 0;
	
	document.getElementById('dato1').value = "";
	document.getElementById('dato2').value = "";
	document.getElementById('dato3').value = "";
	document.getElementById('dato4').value = "";
	//document.getElementById('lista1').selectedIndex = 0;
	//document.getElementById('lista2').selectedIndex = 0;
	//document.getElementById('dato5').value = "";
	document.getElementById('dato5').selectedIndex = 0;
	document.getElementById('dato6').value = "";
	
	document.getElementById('dato7').selectedIndex = 0;
	
	
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

<!-- MENU DE ADMINISTRACION HORIZONTAL -->

<nav class="navbar navbar-default">

  <div class="container-fluid">
   
    
    <div class="collapse navbar-collapse">
      
	   <ul class="nav navbar-nav navbar-right">
	  
	  	<a class="glyphicon glyphicon-home" href="index.php?controller=index&amp;action=ruta_base" title="Menu Principal">
			Menu-Principal
		</a>
		
		<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
			Cerrar-Sesion
		</a>
		
		<br>
		<br>
		<label for="input_sesion" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></label>
	
	  </ul>
	  
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<!-- FIN MENU HORIZONTAL -->


<div class="btn-toolbar" role="toolbar">

  <a href="index.php?controller=usuario&action=Listar_Usuarios" title="Volver al Menu Principal">
  
	  <button type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-arrow-left"></span>Regresar
	  </button>
  
  </a>

</div>

<center><h1 class="page-header">REGISTAR USUARIO</h1></center>


<input type="hidden" name="datos_acti" id="datos_acti" readonly="true"/>

<!-- <center><h4 class="page-header">USUARIOS A REGISTRAR</h4></center> -->


<form id="frmdda" action="" method="post" enctype="multipart/form-data">


<!-- <center><h4 class="page-header">PARTES ( DEMANDANTE(S) - APODERADO - DEMANDADO(S) )</h4></center> -->


<!-- <table>
	
	<tr>
		<td>
			<label style="width:280px; height:23px; font-size:14px">Nombre Demandante:</label><br>
			<input type="text" name="nomddte" id="nomddte" class="form-control" placeholder="Ingrese Nombre Demandante" data-validacion-tipo="requerido">
			
		</td>
		
		<td></td><td></td>
		
		<td>
			<label style="width:180px; height:23px; font-size:14px">Doc Demandante:</label><br>
			<input type="text" name="docddte" id="docddte" class="form-control" placeholder="Ingrese Doc Demandante" data-validacion-tipo="requerido">
		</td>
		
	</tr>

</table>  -->



<!-- <form> -->

  <div class="col-xs-8"><!-- ESPECIFICAR EL LARGO DE LOS CAMPOS -->	
  
	  <div class="form-row">
	  
	  
	  	<div class="form-group col-md-6">
		  <label for="input_2">N.C.C. o NIT (USUARIO)</label>
		  <input type="number" class="form-control" name="dato1" id="dato1" placeholder="Ingrese N.C.C. o NIT" onBlur="Traer_Datos_Usuario(this.value)">
		</div>
		
	  	<div class="form-group col-md-6">
		  <label for="input_1"><?php echo utf8_encode("contraseña");?></label>
		  <input type="password" class="form-control" name="dato2" id="dato2" placeholder="<?php echo utf8_encode("contraseña");?>">
		</div>
		
	
	  </div>
	  
	  
	  <div class="form-row">
	  
	  	<div class="form-group col-md-6">
		  <label for="input_1">Nombre</label>
		  <input type="text" class="form-control" name="dato3" id="dato3" placeholder="Ingrese Nombre">
		</div>
		
		<div class="form-group col-md-6">
		  <label for="input_5">Correo Electronico</label>
		  <input type="text" class="form-control" name="dato4" id="dato4" placeholder="Ingrese Correo Electronico">
		</div>
		
	  
		
	
	  </div>
	  
	 
	  
	  <!-- <div class="form-row">
	  
		<div class="form-group col-md-6">
		
			  <label for="input_3">Departamento</label>
			 
			  <select class="form-control" name="lista1" id="lista1">
														
				<option value="" selected="selected">Seleccionar Departamento</option> 
																	
				<?php
					/*while($row = $datosDPTO->fetch()){
						
						if($row[id] == 17){														
							echo "<option value=\"". $row[id] ."\">" . $row[des] . "</option>";
						}
																				
																				
					}*/
				?>
			</select>
		  
		  
		</div>
		
		<div class="form-group col-md-6">
		
		  <label for="input_4">Municipio</label>
		 
		  	<select class="form-control" name="lista2" id="lista2">
				<option value="" selected="selected">Seleccionar Municipio</option> 
			</select>
		  
		  
		</div>
		
	  </div> -->
	  
	  
	
	
	<div class="form-row">
	  
		
    	
	
		<div class="form-group col-md-6">
		
			  <label for="input_7">Tipo Usuario:</label>
			 
			  <select class="form-control" name="dato5" id="dato5" data-validacion-tipo="requerido">
																
						<option value="" selected="selected">Seleccionar Opcion</option>
						<option value="1">ABOGADO</option>
						<option value="2">NO ABOGADO</option>  
						<option value="3">ESTUDIANTE DE DERECHO</option>
																			
						
			</select>
		
		</div>
			
		<div class="form-group col-md-6">
			
			  <label for="input_8">Celular</label>
			  <input type="text" class="form-control" name="dato6" id="dato6" placeholder="Ingrese Celular">
			  
		</div>
		  
		  	
		
		
		
	</div>
	
	
	<div class="form-row">
	  
		
    	
	
		<div class="form-group col-md-6">
		
			  <label for="input_7">Es Entidad:</label>
			 
			  <select class="form-control" name="dato7" id="dato7" data-validacion-tipo="requerido">
																
						<option value="" selected="selected">Seleccionar Opcion</option>
						<option value="SI">SI</option>
						<option value="NO">NO</option>  
																			
						
			</select>
		
		</div>
			
		
	</div>
	
	
    
</form>




  

<br>
<br>
	  

<table class="table"> 


	<tr>
															
		<td>
				
			<!-- <a href="index.php?controller=demanda&action=Listar_Demandas" title="ADICIONAR PARTE"> 
			<button class="btn btn-success btn-lg btn-block">Registrar</button>
			<button type="button" class="btn btn-default" title="REGISTRAR DEMANDA">
			-->
  
				<button type="button" class="btn btn-success" onClick="Adicionar_Parte()" title="ADICIONAR USUARIO">
					<span class="glyphicon glyphicon-user"></span>ADICIONAR USUARIO
				 </button>
				 
			<!-- </a> -->
			
		</td>
		
		<td>
		
			<a id="registrar_demanda" title="REGISTRAR USUARIO(S)">
			
				<button type="button" class="btn btn-success" title="REGISTRAR USUARIO(S)">
					<span class="glyphicon glyphicon-floppy-saved"></span>REGISTRAR USUARIO(S)
				</button>
			
			</a>
			
			<!-- <img src="18.gif" name="imgcargar" id="imgcargar" width="30" height="30" style="visibility:hidden"/>  -->
			
			
			
		</td>
			
	</tr> 
	
	<tr id="fila_cargando" align="center">
		<td colspan="2">
			<img src="views/images/18.gif" name="imgcargar" id="imgcargar" width="50" height="50" style="visibility:visible"/> 
		</td>
										
	</tr>
	
	<tr>
		<td colspan="2">
			<!-- MENSAJES -->
			<div class="mensage"></div>  
		</td>
										
	</tr>
		
	<tr>
															
		<td colspan="2">
				
			<center><h4 class="page-header">USUARIOS(S) ADICIONADO(S)</h4></center>
			
		</td>
			
	</tr> 
	
</table>		


<div id="cont_raC"> 

	<table id="t_raC" border="1" class="table table-bordered"> 
		
		<tr>
			
			<td>
				<strong style="font-size:12px; color:#0066CC">N.C.C. o NIT</strong>
			</td>
			
			<td>
				<strong style="font-size:12px; color:#0066CC"><?php echo utf8_encode("Contraseña");?></strong>
			</td>
			
			<td>
				<strong style="font-size:12px; color:#0066CC">Nombre</strong>
			</td>
			<td>
				<strong style="font-size:12px; color:#0066CC">Correo</strong>
			</td>
			<!-- <td>
				<strong style="font-size:12px; color:#0066CC">Departamento</strong>
			</td>
			<td>
				<strong style="font-size:12px; color:#0066CC">Municipio</strong>
			</td> -->
			<td>
				<strong style="font-size:12px; color:#0066CC">Tipo</strong>
			</td>
			
			<td>
				<strong style="font-size:12px; color:#0066CC">Celular</strong>
			</td>
			
			<td>
				<strong style="font-size:12px; color:#0066CC">Entidad</strong>
			</td>
			
			<td>
				<strong style="font-size:12px; color:#0066CC">Eliminar</strong>
			</td>
															
		</tr> 
	</table>
	
</div>
			
	
	  
<div class="row">
	<div class="col-xs-12">
     	<footer class="text-center">
       		<hr />
        	<p>Plataforma <?php echo utf8_encode(' Diseñada'); ?> por Ingeniera Industrial Andrea Arbelaez Mendoza (Oficina de Ejecucion Civil Municipal Manizales)</p>
			<p>Plataforma Desarrollado por</p>
			<p>Ingeniero de Sistemas Jorge Andres Valencia Orozco (Oficina de Ejecucion Civil Municipal Manizales)</p>  
			          
        </footer>                
	</div>    
</div>



<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>
<?php 
/*}//FIN SI HORAS
else{

		echo '<script languaje="JavaScript"> 
										
					
				var hi = "'.$hi.'";
				var hf = "'.$hf.'";
				
				var hi2 = "'.$hi2.'";
				var hf2 = "'.$hf2.'";
				
				var horaactual = "'.$horaactual.'";
				
				alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL DIA:"+hi+"-"+" HORA FINAL DIA:"+hf+" HORA ACTUAL:"+horaactual+" HORA INICIAL TARDE:"+hi2+"-"+" HORA FINAL TARDE:"+hf2+" HORA ACTUAL:"+horaactual);
				
				
				//location.href="index.php?controller=index&amp;action=close_session";	
				 
			</script>';
			
			session_unset();
			session_destroy();
			
			header("refresh: 0;URL=/ramajudicialpublica/");
			die();
			
			

}*/
?>
