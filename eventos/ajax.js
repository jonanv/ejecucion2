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

//FUNCION QUE ME PERMITE BUSCAR UN ITEM
//DE UNA LISTA DE SELECCION DE HTML
function Buscar_Item_Combo(texto_busqueda,texto_busqueda_2,texto_busqueda_3){
	
	//alert(texto_busqueda+"-"+texto_busqueda_2+"-"+texto_busqueda_3);
	
	//alert(1);
	
	var input  = texto_busqueda;
	var output = document.getElementById('eveaccion').options;
	
	for(var i=0; i<output.length; i++) {
			
		if(output[i].value == input){
			output[i].selected = true;
		}
	}
	//alert(2);
	//------------------------------------------------------------------------
	
	var input_2  = texto_busqueda_2;
	var output_2 = document.getElementById('evejuzgadoreparto').options;
	
	for(var i=0; i<output_2.length; i++) {
			
		if(output_2[i].value == input_2){
			output_2[i].selected = true;
		}
	}
	//alert(3);
	//------------------------------------------------------------------------
	
	var input_3  = texto_busqueda_3;
	var output_3 = document.getElementById('eveasignadoa').options;
	
	for(var i=0; i<output_3.length; i++) {
			
		if(output_3[i].value == input_3){
			output_3[i].selected = true;
		}
	}
	//alert(4);
	//------------------------------------------------------------------------
		
}
function Buscar_Item_Combo_2(texto_busqueda){
	
	var input  = texto_busqueda;
	var output = document.getElementById('eveaccion').options;
	
	for(var i=0; i<output.length; i++) {
		
		if(output[i].value == input){
			output[i].selected = true;
		}
	}
	
	//------------------------------------------------------------------------
		
}

//FUNCION QUE ME PERMITE BUSCAR EN LA LISTA evedescripcion[]
//SI UN RADICADO YA FUE AGRAGADO EN ELLA O NO
function Buscar_Item_Combo_3(texto_busqueda){
	
	var bandera = 0;
	
	//TEXTO A BUSCAR QUE VIENE DE LA FORMA NUMERO#####NUMERO
	//Y TOMO input[1] QUE ES EL NUMERO DEL RADICADO
	var input  = texto_busqueda.split("#####");
	
	//ESTE ES LA LISTA DE RADICADOS QUE RECOORO EN BUSCA DE LA CADENA ANTERIOR
	var output = document.getElementById('evedescripcion[]').options;

	for(var i=1; i<output.length; i++) {
		
		var dato = output[i].value;
		
		var datoradicado = dato.split("-----");
		
		if(datoradicado[0] == input[1]){
		
			alert("Radicado ya fue Adicionado a la Lista");
			
			output[i].style.backgroundColor='#FF0000';
			
			i = output.length;
			bandera = 1;
			limpiar();
			
		}
	}
	
	if(bandera == 1){
		//alert(bandera);
		return true;
		
	}
	else{
		//alert(bandera);
		return false;
	}
}
function Buscar_Radicado(texto_busqueda){
	
		//alert (1);
		
		var existe = 0;
		
		if(document.client.texto_buscar.value.length == 0){
			alert("Defina Radicado");
			document.getElementById('texto_buscar').style.backgroundColor='#9999FF';
			//ASIGNO ESTA BANDERA PARA QUE CUANDO NO SE DIGITE NADA EN EL CAMPO BUSCAR
			//NO MUESTRE EL MENSAJE Radicado no se encuentra en lista...."
			existe = 2;
		}
		else{
			var input  = texto_busqueda;
			var output = document.getElementById('everadicado').options;
	
			for(var i=0; i<output.length; i++) {
			
				//SE REALIZA ESTE CAMBIO PARA QUE BUSQUE POR EL TEXTO DEL
				//COMBO RADICADO Y NO POR EL VALOR, YA QUE EL VALOR SE REFIERE 
				//A LO QUE SE GUARDA EN evento_expediente EN everadicado Y
				//HACE REFERENCIA A LA TABLA ubicacion_expediente
				
				//if(output[i].value == input){
				if(output[i].text == input){
					output[i].selected = true;
					existe = 1;
				}
			}
			document.client.texto_buscar.value = "";
		}
		//------------
		if(existe == 0){
			alert("Radicado no se encuentra en lista....");
			document.client.everadicado.selectedIndex = 0;
		}
}

function Reporte_Excel(){
	
	dato_1 = 2000;
	dato_2 = document.getElementById('filtro_buscar').value;
	dato_3 = document.getElementById('fechad').value;
	dato_4 = document.getElementById('fechah').value;
	
	datos_reporte = dato_1+"//////////"+dato_2+"//////////"+dato_3+"//////////"+dato_4;

	//alert (datos_reporte);

	location.href="/ejecucion/index.php?controller=archivo&action=listadoExcel&datos_reporte="+datos_reporte;
	
}

//function Listar_Reporte(id_reporte,nivel_usuario,cedula_fun){//TRAIDO DE CONTROLBMD JOOMLA
	
function Listar_Reporte(id_reporte){
	
	var filtro;
	
	if(id_reporte == 1){
	
		filtro = document.getElementById('filtro_buscar').value;
		
		window.open("Reporte_Excel/index.php?filtro="+filtro);
		
	}
	
}

function Buscar_Radicado_Filtro(){
	
	
		if(document.client.texto_buscar.value.length == 0){
			
			//COMENTO ESTAS DOS LINEAS YA QUE SE CAMBIA LA FORMA DE BUSCAR EL RADICADO
			//EN EL FORMULARIO clientForm2.php YA QUE NO USO EL EVENTO onClick DEL BOTON
			//boton_buscar DE DICHO FORMULARIO (TAMBIEN LO CIERRO EN ELFORMULARIO) SI NO QUE
			//USO LA FUNCION onKeyDown DEL CAMPO DE TEXTO texto_buscar DEL FORMULARIO
			//DE IGUAL FORMA LAS LINEAS COMENTADAS Y EL BOTON boton_buscar TAMBIEN FUNCIONAN
			
			//alert("Defina Campo Buscar Radicado");
			//document.getElementById('texto_buscar').style.backgroundColor='#BBDFEA';
		}
		else{
			var cod = document.getElementById("texto_buscar").value;
			
			ajax=AJAXCrearObjeto();
			ajax.open("POST", "funciones/traer_radicado.php", true);
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			ajax.send("filtro="+cod);
			
			ajax.onreadystatechange=function() {
				
				if (ajax.readyState==4) {
					
					//OBTENGO LOS DATOS
					var datos = ajax.responseText;
					//alert(datos);
					if(datos != 0){
						
						var vector_datos = datos.split("*****");
						
						//document.getElementById('everadicado').value = datos;
						document.getElementById('everadicado').value = vector_datos[0];
						document.getElementById('evejuzgadoreparto').value = parseInt(vector_datos[1]);
						
						
					}
					else{
						document.getElementById('everadicado').value = "";
						//document.client.evejuzgadoreparto.selectedIndex = 0;
					}
				}
				
			}
		}
}

var cadenadatos="";
var cadenasincodigos="";

function Adicionar_Radicado(datoradicado){
	
	//alert(datoradicado);
		
	if(document.client.everadicado.value.length == 0 || document.client.evejuzgadoreparto.value.length == 0 || document.client.eveasignadoa.value.length == 0){
		alert("Debe Definir Asignado a,Radicado y Juzgado de Reparto");
		document.getElementById('everadicado').style.backgroundColor='#BBDFEA';
		document.getElementById('evejuzgadoreparto').style.backgroundColor='#BBDFEA';
		document.getElementById('eveasignadoa').style.backgroundColor='#BBDFEA';
	}
	else{
		
		var r;
		//FUNCION QUE DETECTA SI UN RADICADO YA A FUE ASIGNADO A LA LISTA
		//SI r ES FALSE LO DEJA ADICIONAR, DE LO CONTRARIO INDICA CON UN MENSAJE
		//QUE NO ES POSIBLE
		r = Buscar_Item_Combo_3(datoradicado);
		
		if(r == false){

			//CONCATENA EL VALUE Y TEXTO DE LAS LISTAS JUZGADOD DE REPARTO Y ASIGNADO A CON EL TAG #####
			//PARA ASIGNAR EL TEXTO SE DEFINN LAS VARIABLES S Y S2
			var s  = document.client.evejuzgadoreparto;
			var s2 = document.client.eveasignadoa;
			
			var juzgadoreparto = document.getElementById('evejuzgadoreparto').value+"#####"+s.options[s.selectedIndex].text;
			var funcionarioasignado = document.getElementById('eveasignadoa').value+"#####"+s2.options[s2.selectedIndex].text;
			
			cadenadatos = datoradicado+"/////"+juzgadoreparto+"/////"+funcionarioasignado+"/////"+cadenadatos;
			
			//alert(cadenadatos);
			
			var vector_datos   = cadenadatos.split("/////");
			
			//alert(vector_datos);
			
			document.getElementById('evedescripcion[]').length = 0;
			document.getElementById('evedescripcion[]').disabled=true;
					
			o       = document.createElement("OPTION");
			o.value = "";
			o.text  = "";
			//document.FormA.l2.options.add (o);
			document.getElementById('evedescripcion[]').options.add (o);
					
			//alert(vector_datos.length);
			
			var i=0;
			//se resta 1 a la longitud de vector_datos.length-1
			//por que su ultima posicion es un espacio en blanco
			//SE ITERACIONA DE 3 EN 3, YA QUE EN LAS POSICIONES DE
			//i=0 VA LA INFORMACION DEL RADICADO,i=1 VA LA INFORMACION DEL JUZGADO DE REPARTO
			//i=2 VA LA INFORMACION DEL FUNCIONARIO AL CULA SE LE ASIGNA LA ACCION
			//Y AL PASAR LA i=3,4,5 ARRANCA CON NUEVA INFORMACION Y ASI SUCESIVAMENTE
			for (i=0; i<vector_datos.length-1; i=i+3){
				o       = document.createElement("OPTION");
				o.value = vector_datos[i]+"-----"+vector_datos[i+1]+"-----"+vector_datos[i+2];
				o.text  = vector_datos[i]+"-----"+vector_datos[i+1]+"-----"+vector_datos[i+2];
				//alert("value:"+o.value+"---"+"Texto:"+o.text);
				//document.FormA.l2.options.add (o);
				document.getElementById('evedescripcion[]').options.add (o);
			}
					
					
			//document.FormA.l2.disabled=false;
			document.getElementById('evedescripcion[]').disabled=false;
			
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
function limpiar(){
	
	document.getElementById('texto_buscar').value = "";
	document.getElementById('texto_buscar').style.backgroundColor='#FFFFFF';
	
	document.getElementById('everadicado').value = "";
	document.getElementById('everadicado').style.backgroundColor='#FFFFFF';
	
	document.getElementById('evejuzgadoreparto').selectedIndex = 0;
	document.getElementById('evejuzgadoreparto').style.backgroundColor='#FFFFFF';
	
	document.getElementById('eveasignadoa').selectedIndex = 0;
	document.getElementById('eveasignadoa').style.backgroundColor='#FFFFFF';

}

var cadenaradicados;

function recorrerlista(){
	
	var funcionarioasignado = document.getElementById('eveasignadoa').value

	var output = document.getElementById('evedescripcion[]').options;
	
	var longitud = output.length;
	
	//alert (longitud);
	
	cadenaradicados="";
	
	for(var i=1; i<output.length; i++) {
	 
		//alert(output[i].value);
		
		//cadenaradicados = output[i].value+"//////////"+cadenaradicados;
		
		var dato = output[i].value;
		
		var vector_datos = dato.split("-----");
		
		var vector_datos2 = vector_datos[0].split("#####");
		var vector_datos3 = vector_datos[1].split("#####");
		var vector_datos4 = vector_datos[2].split("#####");
		
		var radicado     = vector_datos2[0];
		var juzgado      = vector_datos3[0];
		var funcionarioa = vector_datos4[0];
		
		cadenaradicados = radicado+"-----"+juzgado+"-----"+funcionarioa+"//////////"+cadenaradicados;
		
	}
	
	//CARGA EL CAMPO DE TEXTO evedatos OCULTO DEL FORMULARIO clientForm2
	//CON LOS CODIGOS DEL RADICADO,EL JUZGADO DE REPARTO Y FUNCIOANRIO AL CUAL SE LE ASIGNO LA ACCION
	document.getElementById('evedatos').value = cadenaradicados;
	

}

function reconstruir_radicado(){

	var output = document.getElementById('evedescripcion[]').options;
	
	var longitud = output.length;
	
	cadenaradicados="";
	
	for(var i=1; i<output.length; i++) {
	 
		
		var dato = output[i].value;
		
		var vector_datos = dato.split("-----");
		
		var vector_datos2 = vector_datos[0].split("#####");
		var vector_datos3 = vector_datos[1].split("#####");
		var vector_datos4 = vector_datos[2].split("#####");
		
		var radicado     = vector_datos2[1];
		var juzgado      = vector_datos3[1];
		var funcionarioa = vector_datos4[1];
		
		cadenaradicados = radicado+"-----"+juzgado+"-----"+funcionarioa+"//////////"+cadenaradicados;
		
	}
	
	var vector_datos   = cadenaradicados.split("//////////");
			
	document.getElementById('evedescripcion[]').length = 0;
	document.getElementById('evedescripcion[]').disabled=true;
					
	o       = document.createElement("OPTION");
	o.value = "";
	o.text  = "";
	document.getElementById('evedescripcion[]').options.add (o);
					
	var i=0;
	//se resta 1 a la longitud de vector_datos.length-1
	//por que su ultima posicion es un espacio en blanco
	//retornado en (var datos) 
	for (i=0; i<vector_datos.length-1; i=i+1){
		o       = document.createElement("OPTION");
		o.value = vector_datos[i];
		o.text  = vector_datos[i];
		document.getElementById('evedescripcion[]').options.add (o);
	}
					
	document.getElementById('evedescripcion[]').disabled=false;

}

function Solo_Numeros(){
	
	var key  = window.event.keyCode;
	
	/*if ( key < 48 || key > 57 ){
		window.event.keyCode=0;
	}*/
	
	if ( key >= 48 && key <= 57 ){
		//window.event.keyCode=0;
	}
	else{
		window.event.keyCode=0;
	}
	
}

function Eliminarlista(){
	
	if (document.getElementById('evedescripcion[]').value.length == 0){
		alert("Definir registro de la lista Radicados");
		document.getElementById('evedescripcion[]').style.backgroundColor='#BBDFEA';
					
	}
	else{
		
		var radicadoeliminar = document.getElementById('evedescripcion[]').value;
		
		var output = document.getElementById('evedescripcion[]').options;
		
		for(var i=1; i<output.length; i++) {
		 
			if(output[i].value == radicadoeliminar){
				
				//AMBAS FORMAS FUNCIONAN
				output[i].remove();
				//output[i] = null;
			}
			
		}
		
		document.getElementById('evedescripcion[]').style.backgroundColor='#FFFFFF';
		
	}

}

