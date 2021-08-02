$(function () {


	// PARA RECORRER LA TABLA FILA POR FILA
	$("#recorrer").on('click', function () {

		//alert(1);

		//PARA CONTROLAR LOS ENCABEZADOS DE LA TABLA, Y NO SEAN TENIDOS ENCUENTA COMO UN
		//REGISTRO
		var controlemcabezados = 0;

		var datosreparto = "";

		$('#t tr').each(function () {

			var d0 = $(this).find("td").eq(0).html();
			var d1 = $(this).find("td").eq(1).html();
			var d2 = $(this).find("td").eq(2).html();
			var d3 = $(this).find("td").eq(3).html();
			var d4 = $(this).find("td").eq(4).html();
			var d5 = $(this).find("td").eq(5).html();
			var d6 = $(this).find("td").eq(6).html();
			var d7 = $(this).find("td").eq(7).html();
			var d8 = $(this).find("td").eq(8).html();
			var d9 = $(this).find("td").eq(9).html();
			var d10 = $(this).find("td").eq(10).html();
			var d11 = $(this).find("td").eq(11).html();
			var d12 = $(this).find("td").eq(12).html();

			//alert(d0+"//////"+d1+"//////"+d2+"//////"+d3+"//////"+d4+"//////"+d5+"//////"+d6+"//////"+d7+"//////"+d8+"//////"+d9+"//////"+d10+"//////"+d11+"//////"+d12);

			if (controlemcabezados == 0) {
				controlemcabezados = controlemcabezados + 1;
			}
			else {

				//CONCATENO TODOS LOS REGISTROS DE LA TABLA
				datosreparto = datosreparto + "******" + d0 + "//////" + d1 + "//////" + d2 + "//////" + d3 + "//////" + d4 + "//////" + d5 + "//////" + d6 + "//////" + d7 + "//////" + d8 + "//////" + d9 + "//////" + d10 + "//////" + d11 + "//////" + d12;

			}

		});
		//alert(datosreparto);
		//ENVIO LOS REGISTROS DE LA TABLA PARA SER REGISTRADOS EN LA BASE DE DATOS
		Registrar_Reparto(datosreparto);

	});

});

function AJAXCrearObjeto() {

	var obj = false;

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

	if (!obj && typeof XMLHttpRequest != 'undefined') {
		obj = new XMLHttpRequest();
	}
	return obj;
}

//FUNCION QUE ME PERMITE BUSCAR UN ITEM
//DE UNA LISTA DE SELECCION DE HTML
function Buscar_Item_Combo(texto_busqueda, texto_busqueda_2, texto_busqueda_3) {

	//alert(texto_busqueda+"-"+texto_busqueda_2+"-"+texto_busqueda_3);

	//alert(1);

	var input = texto_busqueda;
	var output = document.getElementById('eveaccion').options;

	for (var i = 0; i < output.length; i++) {

		if (output[i].value == input) {
			output[i].selected = true;
		}
	}
	//alert(2);
	//------------------------------------------------------------------------

	var input_2 = texto_busqueda_2;
	var output_2 = document.getElementById('evejuzgadoreparto').options;

	for (var i = 0; i < output_2.length; i++) {

		if (output_2[i].value == input_2) {
			output_2[i].selected = true;
		}
	}
	//alert(3);
	//------------------------------------------------------------------------

	var input_3 = texto_busqueda_3;
	var output_3 = document.getElementById('eveasignadoa').options;

	for (var i = 0; i < output_3.length; i++) {

		if (output_3[i].value == input_3) {
			output_3[i].selected = true;
		}
	}
	//alert(4);
	//------------------------------------------------------------------------

}
function Buscar_Item_Combo_2(texto_busqueda) {

	var input = texto_busqueda;
	var output = document.getElementById('eveaccion').options;

	for (var i = 0; i < output.length; i++) {

		if (output[i].value == input) {
			output[i].selected = true;
		}
	}

	//------------------------------------------------------------------------

}

//FUNCION QUE ME PERMITE BUSCAR EN LA LISTA evedescripcion[]
//SI UN RADICADO YA FUE AGRAGADO EN ELLA O NO
function Buscar_Item_Combo_3(texto_busqueda) {

	var bandera = 0;

	//TEXTO A BUSCAR QUE VIENE DE LA FORMA NUMERO#####NUMERO
	//Y TOMO input[1] QUE ES EL NUMERO DEL RADICADO
	var input = texto_busqueda.split("#####");

	//ESTE ES LA LISTA DE RADICADOS QUE RECOORO EN BUSCA DE LA CADENA ANTERIOR
	var output = document.getElementById('evedescripcion[]').options;

	for (var i = 1; i < output.length; i++) {

		var dato = output[i].value;

		var datoradicado = dato.split("-----");

		if (datoradicado[0] == input[1]) {

			alert("Radicado ya fue Adicionado a la Lista");

			output[i].style.backgroundColor = '#FF0000';

			i = output.length;
			bandera = 1;
			limpiar();

		}
	}

	if (bandera == 1) {
		//alert(bandera);
		return true;

	}
	else {
		//alert(bandera);
		return false;
	}
}
function Buscar_Radicado(texto_busqueda) {

	//alert (1);

	var existe = 0;

	if (document.client.texto_buscar.value.length == 0) {
		alert("Defina Radicado");
		document.getElementById('texto_buscar').style.backgroundColor = '#9999FF';
		//ASIGNO ESTA BANDERA PARA QUE CUANDO NO SE DIGITE NADA EN EL CAMPO BUSCAR
		//NO MUESTRE EL MENSAJE Radicado no se encuentra en lista...."
		existe = 2;
	}
	else {
		var input = texto_busqueda;
		var output = document.getElementById('everadicado').options;

		for (var i = 0; i < output.length; i++) {

			//SE REALIZA ESTE CAMBIO PARA QUE BUSQUE POR EL TEXTO DEL
			//COMBO RADICADO Y NO POR EL VALOR, YA QUE EL VALOR SE REFIERE 
			//A LO QUE SE GUARDA EN evento_expediente EN everadicado Y
			//HACE REFERENCIA A LA TABLA ubicacion_expediente

			//if(output[i].value == input){
			if (output[i].text == input) {
				output[i].selected = true;
				existe = 1;
			}
		}
		document.client.texto_buscar.value = "";
	}
	//------------
	if (existe == 0) {
		alert("Radicado no se encuentra en lista....");
		document.client.everadicado.selectedIndex = 0;
	}
}

function Reporte_Excel() {

	dato_1 = 2000;
	dato_2 = document.getElementById('filtro_buscar').value;
	dato_3 = document.getElementById('fechad').value;
	dato_4 = document.getElementById('fechah').value;

	datos_reporte = dato_1 + "//////////" + dato_2 + "//////////" + dato_3 + "//////////" + dato_4;

	//alert (datos_reporte);

	location.href = "/laborales/index.php?controller=archivo&action=listadoExcel&datos_reporte=" + datos_reporte;

}

function Reporte_Excel_Reparto() {

	dato_1 = 5000;
	dato_2 = document.getElementById('filtro_buscar').value;
	dato_3 = document.getElementById('fechad').value;
	dato_4 = document.getElementById('fechah').value;

	datos_reporte = dato_1 + "//////////" + dato_2 + "//////////" + dato_3 + "//////////" + dato_4;

	//alert (datos_reporte);

	location.href = "/laborales/index.php?controller=archivo&action=listadoExcel&datos_reporte_4=" + datos_reporte;

}

//function Listar_Reporte(id_reporte,nivel_usuario,cedula_fun){//TRAIDO DE CONTROLBMD JOOMLA

function Listar_Reporte(id_reporte) {

	var filtro;

	if (id_reporte == 1) {

		filtro = document.getElementById('filtro_buscar').value;

		window.open("Reporte_Excel/index.php?filtro=" + filtro);

	}

}

function Buscar_Radicado_Filtro() {


	if (document.client.texto_buscar.value.length == 0) {

		//COMENTO ESTAS DOS LINEAS YA QUE SE CAMBIA LA FORMA DE BUSCAR EL RADICADO
		//EN EL FORMULARIO clientForm2.php YA QUE NO USO EL EVENTO onClick DEL BOTON
		//boton_buscar DE DICHO FORMULARIO (TAMBIEN LO CIERRO EN ELFORMULARIO) SI NO QUE
		//USO LA FUNCION onKeyDown DEL CAMPO DE TEXTO texto_buscar DEL FORMULARIO
		//DE IGUAL FORMA LAS LINEAS COMENTADAS Y EL BOTON boton_buscar TAMBIEN FUNCIONAN

		//alert("Defina Campo Buscar Radicado");
		//document.getElementById('texto_buscar').style.backgroundColor='#BBDFEA';
	}
	else {
		var cod = document.getElementById("texto_buscar").value;

		ajax = AJAXCrearObjeto();
		ajax.open("POST", "funciones/traer_radicado.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("filtro=" + cod);

		ajax.onreadystatechange = function () {

			if (ajax.readyState == 4) {

				//OBTENGO LOS DATOS
				var datos = ajax.responseText;
				//alert(datos);
				if (datos != 0) {

					var vector_datos = datos.split("*****");

					//document.getElementById('everadicado').value = datos;
					document.getElementById('everadicado').value = vector_datos[0];
					document.getElementById('evejuzgadoreparto').value = parseInt(vector_datos[1]);


				}
				else {
					document.getElementById('everadicado').value = "";
					//document.client.evejuzgadoreparto.selectedIndex = 0;
				}
			}

		}
	}
}














function Buscar_Radicado_Filtro_2() {

	//alert(1);


	if (document.client.datoradicado.value.length == 0) {

		//COMENTO ESTAS DOS LINEAS YA QUE SE CAMBIA LA FORMA DE BUSCAR EL RADICADO
		//EN EL FORMULARIO clientForm2.php YA QUE NO USO EL EVENTO onClick DEL BOTON
		//boton_buscar DE DICHO FORMULARIO (TAMBIEN LO CIERRO EN ELFORMULARIO) SI NO QUE
		//USO LA FUNCION onKeyDown DEL CAMPO DE TEXTO texto_buscar DEL FORMULARIO
		//DE IGUAL FORMA LAS LINEAS COMENTADAS Y EL BOTON boton_buscar TAMBIEN FUNCIONAN

		//alert("Defina Campo Buscar Radicado");
		//document.getElementById('texto_buscar').style.backgroundColor='#BBDFEA';
	}
	else {
		var cod = document.getElementById("datoradicado").value;

		//alert(cod);

		ajax = AJAXCrearObjeto();
		ajax.open("POST", "funciones/traer_datos_radicado.php", true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send("filtro=" + cod);

		ajax.onreadystatechange = function () {

			if (ajax.readyState == 4) {

				//OBTENGO LOS DATOS
				var datos = ajax.responseText;
				//alert(datos);
				if (datos != 0) {

					var vector_datos = datos.split("*****");

					//document.getElementById('everadicado').value = vector_datos[0];
					//document.getElementById('evejuzgadoreparto').value = parseInt(vector_datos[1]);

					document.getElementById('datoid').value = vector_datos[0];
					document.getElementById('cedula_demandante').value = vector_datos[2];
					document.getElementById('demandante').value = vector_datos[3];
					document.getElementById('cedula_demandado').value = vector_datos[4];
					document.getElementById('demandado').value = vector_datos[5];
					document.getElementById('piso').value = vector_datos[6];

					//NOTA: POR INCOMPATIBILIDAD CON LOS NAVEGADORES, NO CARGAMOS LA LISA
					//DETALLE ESTADO HACIENDO USO DE LA FUNCION Traer_Lista, YA QUE EN EXPLORER
					//FUNCIONA PERO EN GOOGLE CHROME NO, ENTONCES LA CARGAMOS DIRECTAMENTE
					//EN LA VISTA CLIENTFORM2,TODOS LOS ITEMS QUE ESTAN EN LA TABLA detalle_estado
					//PARA QUE SE SELECCIONE TANTO EL ESTADO COMO EL DETALLE SEGUN EL RADICADO DIGITADO
					//SI NO TRAE INFORMACION EL RADICADO LLAMAMOS LA FUNCION Traer_Lista_2 LA CUAL LE 
					//PASAMOS COMO PARAMETRO CERO (0) Y CARGA DE NUEVO TODOS LOS ITEMS DE LA TABLA
					//detalle_estado, PERO SI CAMBIAMOS ALGUN ITEM DE LA LISTA ESTADO ESTE CARGA EN LA 
					//LISTA DETALLE ESTADO LOS ITEMS CORRESPONDIENTES A ESE ESTADO


					//Traer_Lista(vector_datos[7]);//CARGA LA LISTA DETALLE ESTADO

					//alert("Cargo Ok...");

					document.client.estado.value = vector_datos[7];

					//Buscar_En_Lista(vector_datos[8])

					document.client.detalleestado.value = vector_datos[8];

					document.client.claseproceso.value = vector_datos[9];

					document.client.evejuzgadoreparto.value = vector_datos[10];

					document.getElementById('evefecha').value = vector_datos[11];

					//SE CIERRAN ESTAS LINEAS SE CARGA BIEN LA LISTA DE PONENTES DESDE
					//UNA BASE DE DATOS SQLSERVER, PERO AL OBTENER EL VALOR PARA SELECCIONAR
					//DE LA LISTA NO ME LO SELECCIONA, ENTONCES HAGO USO DE LA FUNCION
					//Buscar_Ponente QUE SIMPLEMENTE RECIBE COMO PARAMETRO EL ID DEL JUSGADO DE REPARTO
					//QUE ES EL MISMO DEL PONENTE EN SIGLO XXI
					//alert(vector_datos[13]);
					//document.getElementById('cambiarponente').value = vector_datos[13];
					//document.client.cambiarponente.value      = vector_datos[13];
					Buscar_Ponente(vector_datos[10]);

					var observaciones_detalle = vector_datos[12].split("----");

					document.getElementById('observaciones[]').length = 0;
					document.getElementById('observaciones[]').disabled = true;

					var i = 0;

					for (i = 0; i < observaciones_detalle.length; i = i + 1) {
						o = document.createElement("OPTION");
						o.value = i;
						o.text = observaciones_detalle[i];
						//document.FormA.l2.options.add (o);
						document.getElementById('observaciones[]').options.add(o);
					}

					document.getElementById('observaciones[]').disabled = false;




				}
				else {
					document.getElementById('datoid').value = "";
					document.getElementById('cedula_demandante').value = "";
					document.getElementById('demandante').value = "";
					document.getElementById('cedula_demandado').value = "";
					document.getElementById('demandado').value = "";
					document.client.piso.selectedIndex = 0;
					document.client.estado.selectedIndex = 0;

					Traer_Lista_2(0);

					document.client.claseproceso.selectedIndex = 0;

					document.client.evejuzgadoreparto.selectedIndex = 0;

					document.getElementById('evefecha').value = "";

					document.client.cambiarponente.selectedIndex = 0;

					document.getElementById('observaciones[]').length = 0;

					document.getElementById('nuevaobservacion').value = "";
				}
			}

		}
	}

}

function Traer_Lista(idlista) {

	//alert(idlista)

	ajax = AJAXCrearObjeto();
	ajax.open("POST", "funciones/traer_datos_lista.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.onreadystatechange = LeerDatosTraer_Lista;
	ajax.send("filtro=" + idlista);

}
function LeerDatosTraer_Lista() {

	ajax.onreadystatechange = function () {

		if (ajax.readyState == 4) {

			//OBTENGO LOS DATOS
			var datos = ajax.responseText;

			//alert(datos);

			//creo un vector con split para cargar los datos en los lugares adecuados
			var vector_datos = datos.split("///");

			//alert(vector_datos);

			//CODIGO QUE ME PERMITE AGREGAR EL ELEMNTO A LA LISTA
			//document.FormA.l2.length = 0;
			//document.FormA.l2.disabled=true;

			document.getElementById('detalleestado').length = 0;
			document.getElementById('detalleestado').disabled = true;

			o = document.createElement("OPTION");
			o.value = "";
			o.text = "";
			//document.FormA.l2.options.add (o);
			document.getElementById('detalleestado').options.add(o);


			var i = 0;
			//se resta 1 a la longitud de vector_datos.length-1
			//por que su ultima posicion es un espacio en blanco
			//retornado en (var datos) 
			for (i = 0; i < vector_datos.length - 1; i = i + 2) {
				o = document.createElement("OPTION");
				o.value = vector_datos[i];
				o.text = vector_datos[i + 1];
				//document.FormA.l2.options.add (o);
				document.getElementById('detalleestado').options.add(o);
			}


			//document.FormA.l2.disabled=false;
			document.getElementById('detalleestado').disabled = false;

		}

	}

}

function Traer_Lista_2(idlista) {

	//alert(idlista)

	ajax = AJAXCrearObjeto();
	ajax.open("POST", "funciones/traer_datos_lista.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.onreadystatechange = LeerDatosTraer_Lista_2;
	ajax.send("filtro=" + idlista);

}
function LeerDatosTraer_Lista_2() {

	ajax.onreadystatechange = function () {

		if (ajax.readyState == 4) {

			//OBTENGO LOS DATOS
			var datos = ajax.responseText;

			//alert(datos);

			//creo un vector con split para cargar los datos en los lugares adecuados
			var vector_datos = datos.split("///");

			//alert(vector_datos);

			//CODIGO QUE ME PERMITE AGREGAR EL ELEMNTO A LA LISTA
			//document.FormA.l2.length = 0;
			//document.FormA.l2.disabled=true;

			document.getElementById('detalleestado').length = 0;
			document.getElementById('detalleestado').disabled = true;

			o = document.createElement("OPTION");
			o.value = "";
			o.text = "";
			//document.FormA.l2.options.add (o);
			document.getElementById('detalleestado').options.add(o);


			var i = 0;
			//se resta 1 a la longitud de vector_datos.length-1
			//por que su ultima posicion es un espacio en blanco
			//retornado en (var datos) 
			for (i = 0; i < vector_datos.length - 1; i = i + 2) {
				o = document.createElement("OPTION");
				o.value = vector_datos[i];
				o.text = vector_datos[i + 1];
				//document.FormA.l2.options.add (o);
				document.getElementById('detalleestado').options.add(o);
			}


			//document.FormA.l2.disabled=false;
			document.getElementById('detalleestado').disabled = false;

		}

	}

}

function Buscar_Ponente(texto_busqueda) {

	//alert(texto_busqueda);

	if (texto_busqueda == 1) {
		document.client.cambiarponente.selectedIndex = 1;
	}
	if (texto_busqueda == 2) {
		document.client.cambiarponente.selectedIndex = 2;
	}

	/*var input  = texto_busqueda;
	var output = document.getElementById('cambiarponente').options;
	
	for(var i=0; i<output.length; i++) {
		
		//alert(output[i].value);
		
		if(output[i].value == input){
			//alert("lo encontre");
			output[i].selected = true;
		}
	}*/

	//------------------------------------------------------------------------

}

var z = 1;
var Filas = 0;

function Adicionar_Reparto() {

	//VALIDA SI UN RADICADO YA FUE ADICONADO A LA TABLA
	var existeradicado = Validar_Radicado_Tabla();

	if (existeradicado == 1) {
		existeradicado = 1;
		alert("No es posible Adiconar el Radicado, Ya fue Cargado en la Tabla");
	}
	else {//1

		//RETORNA 1 SI NO ESTAN TODOS LOS DATOS COMPLETOS PARA ADICIONAR UN REGISTRO A LA TABLA
		var validarcampos = Validar_Reparto();

		if (validarcampos == 1) {

			validarcampos = 1;
		}
		else {//2

			//DATOS 

			var dato1 = document.getElementById('datoid').value;
			var dato2 = document.getElementById('datoradicado').value;
			var dato3 = document.getElementById('cedula_demandante').value;
			var dato4 = document.getElementById('demandante').value;
			var dato5 = document.getElementById('cedula_demandado').value;
			var dato6 = document.getElementById('demandado').value;

			var dato7 = document.getElementById('piso').value;

			var s = document.client.detalleestado;
			var dato8 = document.getElementById('detalleestado').value + "-" + s.options[s.selectedIndex].text;

			var s2 = document.client.claseproceso;
			var dato9 = document.getElementById('claseproceso').value + "-" + s2.options[s2.selectedIndex].text;

			//DATOS REPARTO

			var dato10 = document.getElementById('evefecha').value;

			var s3 = document.client.evejuzgadoreparto;
			var dato11 = document.getElementById('evejuzgadoreparto').value + "-" + s3.options[s3.selectedIndex].text;

			//var s4  = document.client.cambiarponente;
			//var dato12 = document.getElementById('cambiarponente').value+"-"+s4.options[s4.selectedIndex].text;

			var dato12 = document.getElementById('cambiarponente').value;

			var dato13 = document.getElementById('nuevaobservacion').value;

			//alert(dato4);

			//Filas = resultado.length;
			Filas = 1;
			var cantidad_filas;
			var TABLA = document.getElementById('t');
			cantidad_filas = TABLA.rows.length;

			if (cantidad_filas > 1) {

				//alert('cantidad > 1');

				//Eliminar_Tabla();

				var tabla = document.getElementById('cont').innerHTML;

				//for (var id=0; id<Filas; id++){

				tabla = tabla.substring(0, (tabla.length - 8));

				//tabla+='<tr><td><input type=text name=id'+z+' id=id'+z+' title=id'+z+' size="3" readonly="true" value='+dato1+' onClick="PruebaId('+dato1+')"></td><td>-</td></tr></table>';

				/*tabla+='<tr>';
				
				tabla+='<td><input type="text" name=dato1'+z+' id=dato1'+z+' title=dato1'+z+' size="3" readonly="true" value='+dato1+' onClick="PruebaId('+dato1+')"></td>';
				
				tabla+='<td><input type=text name=dato2'+z+' id=dato2'+z+' title=dato2'+z+' readonly="true" value='+dato2+' onClick="PruebaId('+dato2+')"></td>';
				
				tabla+='<td><input type=text name=dato3'+z+' id=dato3'+z+' title=dato3'+z+' readonly="true" value='+dato3+' onClick="PruebaId('+dato3+')"></td>';
				
				tabla+='<td><input type=text name=dato4'+z+' id=dato4'+z+' title=dato4'+z+' size="30" readonly="true" value='+dato4+' onClick="PruebaId('+dato4+')"></td>';
				
				tabla+='<td><input type=text name=dato5'+z+' id=dato5'+z+' title=dato5'+z+' readonly="true" value='+dato5+' onClick="PruebaId('+dato5+')"></td>';
				
				tabla+='<td><input type=text name=dato6'+z+' id=dato6'+z+' title=dato6'+z+' size="30" readonly="true" value='+dato6+' onClick="PruebaId('+dato6+')"></td>';
				
				tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="/laborales/repartomasivo/imagenes/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
				
				tabla+='</tr></table>';*/


				tabla += '<tr>';

				tabla += '<td>' + dato1 + '</td>';

				tabla += '<td>' + dato2 + '</td>';

				tabla += '<td>' + dato3 + '</td>';

				tabla += '<td>' + dato4 + '</td>';

				tabla += '<td>' + dato5 + '</td>';

				tabla += '<td>' + dato6 + '</td>';

				tabla += '<td>' + dato7 + '</td>';

				tabla += '<td>' + dato8 + '</td>';

				tabla += '<td>' + dato9 + '</td>';

				tabla += '<td>' + dato10 + '</td>';

				tabla += '<td>' + dato11 + '</td>';

				tabla += '<td>' + dato12 + '</td>';

				tabla += '<td>' + dato13 + '</td>';

				tabla += '<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onclick="Eliminar_Reparto(this.parentNode.parentNode.rowIndex)"><img src="/laborales/repartomasivo/imagenes/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';

				tabla += '</tr></table>';


				document.getElementById('cont').innerHTML = tabla;

				z++;
				//}
			}

			if (cantidad_filas == 1) {

				//alert('cantidad = 1');

				var tabla = document.getElementById('cont').innerHTML;

				//for (var id=0; id<Filas; id++){

				tabla = tabla.substring(0, (tabla.length - 8));

				//tabla+='<tr><td><input type=text name=id'+z+' id=id'+z+' title=id'+z+' size="3" readonly="true" value='+dato1+' onClick="PruebaId('+dato1+')"></td><td>-</td></tr></table>';

				/*tabla+='<tr>';
				
				tabla+='<td><input type="text" name=dato1'+z+' id=dato1'+z+' title=dato1'+z+' size="3" readonly="true" value='+dato1+' onClick="PruebaId('+dato1+')"></td>';
				
				tabla+='<td><input type=text name=dato2'+z+' id=dato2'+z+' title=dato2'+z+' readonly="true" value='+dato2+' onClick="PruebaId('+dato2+')"></td>';
				
				tabla+='<td><input type=text name=dato3'+z+' id=dato3'+z+' title=dato3'+z+' readonly="true" value='+dato3+' onClick="PruebaId('+dato3+')"></td>';
				
				tabla+='<td><input type=text name=dato4'+z+' id=dato4'+z+' title=dato4'+z+' size="30" readonly="true" value='+dato4+' onClick="PruebaId('+dato4+')"></td>';
				
				tabla+='<td><input type=text name=dato5'+z+' id=dato5'+z+' title=dato5'+z+' readonly="true" value='+dato5+' onClick="PruebaId('+dato5+')"></td>';
				
				tabla+='<td><input type=text name=dato6'+z+' id=dato6'+z+' title=dato6'+z+' size="30" readonly="true" value='+dato6+' onClick="PruebaId('+dato6+')"></td>';
				
				tabla+='<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onClick="Eliminar_Reparto()"><img src="/laborales/repartomasivo/imagenes/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';
				
				tabla+='</tr></table>';*/


				tabla += '<tr>';

				tabla += '<td>' + dato1 + '</td>';

				tabla += '<td>' + dato2 + '</td>';

				tabla += '<td>' + dato3 + '</td>';

				tabla += '<td>' + dato4 + '</td>';

				tabla += '<td>' + dato5 + '</td>';

				tabla += '<td>' + dato6 + '</td>';

				tabla += '<td>' + dato7 + '</td>';

				tabla += '<td>' + dato8 + '</td>';

				tabla += '<td>' + dato9 + '</td>';

				tabla += '<td>' + dato10 + '</td>';

				tabla += '<td>' + dato11 + '</td>';

				tabla += '<td>' + dato12 + '</td>';

				tabla += '<td>' + dato13 + '</td>';

				tabla += '<td><button type=button name=eliminarreparto id=eliminarreparto title=Eliminar Reparto onclick="Eliminar_Reparto(this.parentNode.parentNode.rowIndex)"><img src="/laborales/repartomasivo/imagenes/eliminar.png" width="20" height="20" title="Eliminar"/></button></td>';

				tabla += '</tr></table>';


				document.getElementById('cont').innerHTML = tabla;

				z++;
				//}
			}

		}//2

		//Limpiar_Formulario();

	}//1


}

function Validar_Reparto() {

	var validar = 0;

	if (document.getElementById('datoid').value == 0) {

		alert("Defina Id Radicado");
		document.getElementById('datoid').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('datoradicado').value == 0) {

		alert("Defina Radicado");
		document.getElementById('datoradicado').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('cedula_demandante').value == 0) {

		alert("Defina Cedula Demandante");
		document.getElementById('cedula_demandante').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('demandante').value == 0) {

		alert("Defina Demandante");
		document.getElementById('demandante').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('cedula_demandado').value == 0) {

		alert("Defina Cedula Demandado");
		document.getElementById('cedula_demandado').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('demandado').value == 0) {

		alert("Defina Cedula Demandado");
		document.getElementById('demandado').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('piso').value == 0) {

		alert("Defina Piso");
		document.getElementById('piso').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('detalleestado').value == 0) {

		alert("Defina Estado");
		document.getElementById('detalleestado').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('claseproceso').value == 0) {

		alert("Defina Clase Proceso");
		document.getElementById('claseproceso').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('evefecha').value == 0) {

		alert("Defina Fecha Reparto");
		document.getElementById('evefecha').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('evejuzgadoreparto').value == 0) {

		alert("Defina Juzgado Reparto");
		document.getElementById('evejuzgadoreparto').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('cambiarponente').value == 0) {

		alert("Defina Cambiar Ponente");
		document.getElementById('cambiarponente').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}
	if (document.getElementById('nuevaobservacion').value == 0) {

		alert("Defina Nueva Observacion");
		document.getElementById('nuevaobservacion').style.backgroundColor = '#CDE3F6';
		validar = 1;
		return validar;

	}

}
function Validar_Radicado_Tabla() {

	var validarradicado = 0;

	$('#t tr').each(function () {


		var d0 = parseInt($(this).find("td").eq(0).html());
		var d0b = parseInt(document.getElementById('datoid').value);


		if (d0b == d0) {
			validarradicado = 1;
			return false;//para el for each

		}
		else {
			validarradicado = 0;
		}


	});

	return validarradicado;
}

function Registrar_Reparto(datosreparto) {


	//alert(datosreparto);
	//alert('registrado....');


	var cantidad_filas_2;
	var TABLA_2 = document.getElementById('t');
	cantidad_filas_2 = TABLA_2.rows.length;

	if (cantidad_filas_2 > 1) {

		if (confirm("Esta Seguro de Realizar el Registro")) {

			ajax = AJAXCrearObjeto();
			ajax.open("POST", "funciones/Registrar_Reparto.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.onreadystatechange = LeerDatosRegistrar_Reparto;
			ajax.send("datos=" + datosreparto);
		}

	}
	else {
		alert("No es Posible Realizar el Registro la Tabla no Cuenta con Informacion");
	}

}
function LeerDatosRegistrar_Reparto() {

	ajax.onreadystatechange = function () {

		if (ajax.readyState == 4) {

			//OBTENGO LOS DATOS
			var datos = ajax.responseText;

			//alert(datos);

			if (datos == 1) {
				alert('ERROR AL PROCESAR LOS DATOS'); location.href = '/laborales/repartomasivo/index.php';
			}
			else {
				alert('PROCESAMIENTO DE LOS DATOS OK...'); location.href = '/laborales/repartomasivo/index.php';
			}

			//creo un vector con split para cargar los datos en los lugares adecuados
			//var vector_datos   = datos.split("///");




		}

	}

}


//ELIMINA UN REGISTRO SELECCIONADO DE LA TABLA
function Eliminar_Reparto(idfila) {


	//alert(idfila);

	//document.getElementsByTagName("table")[0].setAttribute("id","t");
	//document.getElementById("t").deleteRow(idfila);

	var TABLA = document.getElementById('t');

	TABLA.deleteRow(idfila);

	//z = z+1;

	//alert("idfila: "+idfila+" Z: "+z);*/


}

//PARA ELIMINARTODA LA TABLA, EN UN SOLO LLAMADO
function Eliminar_Tabla() {

	var r;
	var cantidad_filas;
	var TABLA = document.getElementById('t');

	cantidad_filas = TABLA.rows.length;

	for (r = 1; r < cantidad_filas; r++) {
		TABLA.deleteRow(r);
		cantidad_filas = TABLA.rows.length;
		r = 1
	}
	if (cantidad_filas > 1) {
		TABLA.deleteRow(1);
	}
	z = 1;
}

function Limpiar_Formulario() {

	document.getElementById('datoid').value = "";
	document.getElementById('datoradicado').value = "170014003";
	document.getElementById('cedula_demandante').value = "";
	document.getElementById('demandante').value = "";
	document.getElementById('cedula_demandado').value = "";
	document.getElementById('demandado').value = "";
	document.client.piso.selectedIndex = 0;
	document.client.estado.selectedIndex = 0;

	Traer_Lista_2(0);

	document.client.claseproceso.selectedIndex = 0;

	document.client.evejuzgadoreparto.selectedIndex = 0;

	document.getElementById('evefecha').value = "";

	document.client.cambiarponente.selectedIndex = 0;

	document.getElementById('observaciones[]').length = 0;

	document.getElementById('nuevaobservacion').value = "";

}


























































var cadenadatos = "";
var cadenasincodigos = "";

function Adicionar_Radicado(datoradicado) {

	//alert(datoradicado);

	if (document.client.everadicado.value.length == 0 || document.client.evejuzgadoreparto.value.length == 0 || document.client.eveasignadoa.value.length == 0) {
		alert("Debe Definir Asignado a,Radicado y Juzgado de Reparto");
		document.getElementById('everadicado').style.backgroundColor = '#BBDFEA';
		document.getElementById('evejuzgadoreparto').style.backgroundColor = '#BBDFEA';
		document.getElementById('eveasignadoa').style.backgroundColor = '#BBDFEA';
	}
	else {

		var r;
		//FUNCION QUE DETECTA SI UN RADICADO YA A FUE ASIGNADO A LA LISTA
		//SI r ES FALSE LO DEJA ADICIONAR, DE LO CONTRARIO INDICA CON UN MENSAJE
		//QUE NO ES POSIBLE
		r = Buscar_Item_Combo_3(datoradicado);

		if (r == false) {

			//CONCATENA EL VALUE Y TEXTO DE LAS LISTAS JUZGADOD DE REPARTO Y ASIGNADO A CON EL TAG #####
			//PARA ASIGNAR EL TEXTO SE DEFINN LAS VARIABLES S Y S2
			var s = document.client.evejuzgadoreparto;
			var s2 = document.client.eveasignadoa;

			var juzgadoreparto = document.getElementById('evejuzgadoreparto').value + "#####" + s.options[s.selectedIndex].text;
			var funcionarioasignado = document.getElementById('eveasignadoa').value + "#####" + s2.options[s2.selectedIndex].text;

			cadenadatos = datoradicado + "/////" + juzgadoreparto + "/////" + funcionarioasignado + "/////" + cadenadatos;

			//alert(cadenadatos);

			var vector_datos = cadenadatos.split("/////");

			//alert(vector_datos);

			document.getElementById('evedescripcion[]').length = 0;
			document.getElementById('evedescripcion[]').disabled = true;

			o = document.createElement("OPTION");
			o.value = "";
			o.text = "";
			//document.FormA.l2.options.add (o);
			document.getElementById('evedescripcion[]').options.add(o);

			//alert(vector_datos.length);

			var i = 0;
			//se resta 1 a la longitud de vector_datos.length-1
			//por que su ultima posicion es un espacio en blanco
			//SE ITERACIONA DE 3 EN 3, YA QUE EN LAS POSICIONES DE
			//i=0 VA LA INFORMACION DEL RADICADO,i=1 VA LA INFORMACION DEL JUZGADO DE REPARTO
			//i=2 VA LA INFORMACION DEL FUNCIONARIO AL CULA SE LE ASIGNA LA ACCION
			//Y AL PASAR LA i=3,4,5 ARRANCA CON NUEVA INFORMACION Y ASI SUCESIVAMENTE
			for (i = 0; i < vector_datos.length - 1; i = i + 3) {
				o = document.createElement("OPTION");
				o.value = vector_datos[i] + "-----" + vector_datos[i + 1] + "-----" + vector_datos[i + 2];
				o.text = vector_datos[i] + "-----" + vector_datos[i + 1] + "-----" + vector_datos[i + 2];
				//alert("value:"+o.value+"---"+"Texto:"+o.text);
				//document.FormA.l2.options.add (o);
				document.getElementById('evedescripcion[]').options.add(o);
			}


			//document.FormA.l2.disabled=false;
			document.getElementById('evedescripcion[]').disabled = false;

			//ESTA FUNCION ME CARGA EL CAMPO DE TEXTO evedatos OCULTO DEL FORMULARIO clientForm2
			//CON LOS CODIGOS DEL RADICADO,EL JUZGADO DE REPARTO Y EL FUNCIOANRIO AL CUAL SE LE ASIGNO LA ACCION
			recorrerlista();
			limpiar();
			//ESTA FUNCION SIMPLEMENTE ME PERMITE CARGAR EN LA LISTA evedescripcion[]
			//SOLO EL NUMERO DE RADICADO,EL NOMBRE DEL JUZGADO Y FUNCIONARIOA AL CUAL SE LE ASIGNO LA ACCIO, YA QUE ANTERIORMENTE ME CARGABA
			//CONCATENADO CON EL CODIGO DEL RADICADO,EL JUZGADO Y FUNCIOANRIO AL CUAL SE LE ASIGNO LA ACCION
			//ESTO POR COMODIDAD VISUAL DEL UAUSRIO DEL SISTEMA
			reconstruir_radicado();

		}


	}

}
function limpiar() {

	document.getElementById('texto_buscar').value = "";
	document.getElementById('texto_buscar').style.backgroundColor = '#FFFFFF';

	document.getElementById('everadicado').value = "";
	document.getElementById('everadicado').style.backgroundColor = '#FFFFFF';

	document.getElementById('evejuzgadoreparto').selectedIndex = 0;
	document.getElementById('evejuzgadoreparto').style.backgroundColor = '#FFFFFF';

	document.getElementById('eveasignadoa').selectedIndex = 0;
	document.getElementById('eveasignadoa').style.backgroundColor = '#FFFFFF';

}

var cadenaradicados;

function recorrerlista() {

	var funcionarioasignado = document.getElementById('eveasignadoa').value

	var output = document.getElementById('evedescripcion[]').options;

	var longitud = output.length;

	//alert (longitud);

	cadenaradicados = "";

	for (var i = 1; i < output.length; i++) {

		//alert(output[i].value);

		//cadenaradicados = output[i].value+"//////////"+cadenaradicados;

		var dato = output[i].value;

		var vector_datos = dato.split("-----");

		var vector_datos2 = vector_datos[0].split("#####");
		var vector_datos3 = vector_datos[1].split("#####");
		var vector_datos4 = vector_datos[2].split("#####");

		var radicado = vector_datos2[0];
		var juzgado = vector_datos3[0];
		var funcionarioa = vector_datos4[0];

		cadenaradicados = radicado + "-----" + juzgado + "-----" + funcionarioa + "//////////" + cadenaradicados;

	}

	//CARGA EL CAMPO DE TEXTO evedatos OCULTO DEL FORMULARIO clientForm2
	//CON LOS CODIGOS DEL RADICADO,EL JUZGADO DE REPARTO Y FUNCIOANRIO AL CUAL SE LE ASIGNO LA ACCION
	document.getElementById('evedatos').value = cadenaradicados;


}

function reconstruir_radicado() {

	var output = document.getElementById('evedescripcion[]').options;

	var longitud = output.length;

	cadenaradicados = "";

	for (var i = 1; i < output.length; i++) {


		var dato = output[i].value;

		var vector_datos = dato.split("-----");

		var vector_datos2 = vector_datos[0].split("#####");
		var vector_datos3 = vector_datos[1].split("#####");
		var vector_datos4 = vector_datos[2].split("#####");

		var radicado = vector_datos2[1];
		var juzgado = vector_datos3[1];
		var funcionarioa = vector_datos4[1];

		cadenaradicados = radicado + "-----" + juzgado + "-----" + funcionarioa + "//////////" + cadenaradicados;

	}

	var vector_datos = cadenaradicados.split("//////////");

	document.getElementById('evedescripcion[]').length = 0;
	document.getElementById('evedescripcion[]').disabled = true;

	o = document.createElement("OPTION");
	o.value = "";
	o.text = "";
	document.getElementById('evedescripcion[]').options.add(o);

	var i = 0;
	//se resta 1 a la longitud de vector_datos.length-1
	//por que su ultima posicion es un espacio en blanco
	//retornado en (var datos) 
	for (i = 0; i < vector_datos.length - 1; i = i + 1) {
		o = document.createElement("OPTION");
		o.value = vector_datos[i];
		o.text = vector_datos[i];
		document.getElementById('evedescripcion[]').options.add(o);
	}

	document.getElementById('evedescripcion[]').disabled = false;

}

function Solo_Numeros() {

	var key = window.event.keyCode;

	/*if ( key < 48 || key > 57 ){
		window.event.keyCode=0;
	}*/

	if (key >= 48 && key <= 57) {
		//window.event.keyCode=0;
	}
	else {
		window.event.keyCode = 0;
	}

}

function Eliminarlista() {

	if (document.getElementById('evedescripcion[]').value.length == 0) {
		alert("Definir registro de la lista Radicados");
		document.getElementById('evedescripcion[]').style.backgroundColor = '#BBDFEA';

	}
	else {

		var radicadoeliminar = document.getElementById('evedescripcion[]').value;

		var output = document.getElementById('evedescripcion[]').options;

		for (var i = 1; i < output.length; i++) {

			if (output[i].value == radicadoeliminar) {

				//AMBAS FORMAS FUNCIONAN
				output[i].remove();
				//output[i] = null;
			}

		}

		document.getElementById('evedescripcion[]').style.backgroundColor = '#FFFFFF';

	}

}

