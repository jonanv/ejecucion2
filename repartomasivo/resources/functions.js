
/**
 * Autor: Lucas Forchino
 * Web: http://www.tutorialjquery.com
 *
 */
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $('.edit').live('click',function(){
        //this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
        var id=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.id=id;
        params.action="editClient";
        $('#popupbox').load('index.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $('.delete').live('click',function(){
									   
		if (confirm ("¿Esta seguro de Eliminar el Registro?")) {//FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014
			//obtengo el id que guardamos en data-id
			var id=$(this).attr('data-id');
			
			//var datosrejilla=$(this).attr('data-id').split("##########");
			//var id       = datosrejilla[0];
			//var datoslog = datosrejilla[1];
			//alert(datoslog);
			
			//preparo los parametros
			params={};
			params.id=id;
			params.datoslog2=$('#datoslog2').val();
			params.action="deleteClient";
			
			//alert(params.datoslog);
			
			$('#popupbox').load('index.php', params,function(){
				$('#content').load('index.php',{action:"refreshGrid"});
			})
		}

    })

    $('#new').live('click',function(){
        params={};
        params.action="newClient";
        $('#popupbox').load('index.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })

	//1.VERSION ORIGINAL, SE CAMBIA YA QUE SE DEBEN VALIDAR LOS DATOS
	//PARA QUE NO SE VAYA NINGUN CAMPO EN BLANCO
    /*$('#client').live('submit',function(){
										
		
			if (confirm ("¿Esta seguro de Realizar el Proceso?")) {//FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014
			
				var params={};
				params.action='saveClient';
				params.id=$('#id').val();
				params.evefecha=$('#evefecha').val();
				params.eveasunto=$('#eveasunto').val();
				params.eveaccion=$('#eveaccion').val();
				params.everadicado=$('#everadicado').val();
				params.evejuzgadoreparto=$('#evejuzgadoreparto').val();
				params.eveasignadoa=$('#eveasignadoa').val();
				params.evedescripcion=$('#evedescripcion[]').val();
				params.evedescripcion2=$('#evedescripcion2').val();
				params.evedatos=$('#evedatos').val();
				
				params.datoslog=$('#datoslog').val();
				
				$.post('index.php',params,function(){
					$('#block').hide();
					$('#popupbox').hide();
					$('#content').load('index.php',{action:"refreshGrid"});
				})
				//return false;
				
		   }
			
    })*/
	
	//2.SE REEMPLAZA POR LA FUNCION validar_campos() YA QUE USANDO LA VALIDACION
	//DE ESTA FORMA EN ALGUNAS OCACIONES AL REALIZAR EL REGISTRO Y VOLVER 
	//A LA REJILLA NO SE VE REFLEJADO EL NUEVO O LOS NUEVOS REGISTROS 
	//ADICIONADOS Y DEBE HACERSE USO DEL BOTON RECARGAR(LAS DOS FLECHAS VERDES EN CIRCULO)
	//PARA QUE TOME EL CAMBIO
	/*$('#client').live('submit',function(){
										 
			
			if (document.client.evefecha.value.length==0){
       			alert("Tiene que Definir Fecha")
				document.getElementById('evefecha').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client.eveasunto.value.length==0){
       			alert("Tiene que Definir Asunto")
				document.getElementById('eveasunto').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client.eveaccion.value.length==0){
       			alert("Tiene que Definir Accion")
				document.getElementById('eveaccion').style.backgroundColor='#9999FF';
				return false;
			}
			/*if (document.client.eveasignadoa.value.length==0){
       			alert("Tiene que Definir Asignado A")
				document.getElementById('eveasignadoa').style.backgroundColor='#9999FF';
				return false;
			}*/
			/*if (document.getElementById('evedescripcion[]').options.length == 0 || document.getElementById('evedescripcion[]').options.length == 1){
					alert("Tiene que Asignar al menos un Radicado a la lista Radicados");
					document.getElementById('evedescripcion[]').style.backgroundColor='#CCCCFF';
					return false;
			}
		
			if (confirm ("¿Esta seguro de Realizar el Proceso?")) {
				
				
				var params={};
				params.action='saveClient';
				params.id=$('#id').val();
				params.evefecha=$('#evefecha').val();
				params.eveasunto=$('#eveasunto').val();
				params.eveaccion=$('#eveaccion').val();
				params.everadicado=$('#everadicado').val();
				params.evejuzgadoreparto=$('#evejuzgadoreparto').val();
				params.eveasignadoa=$('#eveasignadoa').val();
				params.evedescripcion=$('#evedescripcion[]').val();
				params.evedescripcion2=$('#evedescripcion2').val();
				params.evedatos=$('#evedatos').val();
				
				params.datoslog=$('#datoslog').val();
				
				$.post('index.php',params,function(){
					$('#block').hide();
					$('#popupbox').hide();
					$('#content').load('index.php',{action:"refreshGrid"});
					
				})
				
        		return true;
    		} 
			else{return false;}
    })*/
	
	//PARA EL FORMULARIO clientForm.php
	$('#editar').live('click',function(){
						
			//SE DEJA SOLO ESTA VALIDACION YA QUE ESTE CAMPO ES EL
			//QUE SI NO SE DEFINE QUEDA EN BLANCO EN LA REJILLA
			//LOS OTROS CAMPOS SE SE DEJAN EN BLANCO NO SE EJECUTA LA MODIFICACION
			if (document.client2.eveasunto.value.length==0){
       			alert("Tiene que Definir Asunto")
				document.getElementById('eveasunto').style.backgroundColor='#9999FF';
				return false;
			}
			
			/*if (document.client2.evefecha.value.length==0){
       			alert("Tiene que Definir Fecha")
				document.getElementById('evefecha').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client2.eveasunto.value.length==0){
       			alert("Tiene que Definir Asunto")
				document.getElementById('eveasunto').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client2.eveaccion.value.length==0){
       			alert("Tiene que Definir Accion")
				document.getElementById('eveaccion').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client2.eveasignadoa.value.length==0){
       			alert("Tiene que Definir Asignado A")
				document.getElementById('eveasignadoa').style.backgroundColor='#9999FF';
				return false;
			}*/
			
		
			if (confirm ("¿Esta seguro de Realizar el Proceso?")) {
				
				
				var params={};
				params.action='saveClient';
				params.id=$('#id').val();
				params.evefecha=$('#evefecha').val();
				params.eveasunto=$('#eveasunto').val();
				params.eveaccion=$('#eveaccion').val();
				params.everadicado=$('#everadicado').val();
				params.evejuzgadoreparto=$('#evejuzgadoreparto').val();
				params.eveasignadoa=$('#eveasignadoa').val();
				params.evedescripcion=$('#evedescripcion[]').val();
				params.evedescripcion2=$('#evedescripcion2').val();
				params.evedatos=$('#evedatos').val();
				
				params.datoslog=$('#datoslog').val();
				
				$.post('index.php',params,function(){
					$('#block').hide();
					$('#popupbox').hide();
					$('#content').load('index.php',{action:"refreshGrid"});
				})
				
        		return true;
    		} 
			else{return false;}
    })
	 
	 


    // boton cancelar, uso live en lugar de bind para que tome cualquier boton
    // nuevo que pueda aparecer
    $('#cancel').live('click',function(){
        $('#block').hide();
        $('#popupbox').hide();
    })
	
	//--------------------FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA---------------------------------------------
	
	//FILTRO FUNCION AGREGADA POR JORGE ANDRES VALENCIA 01/NOVIEMBRE/2014
	$('.filtro_buscar').live('click',function(){
			
			//ESTA FORMA TAMBIEN FUNCIONA EL /params.filtro=filtro; DEBE IR DEBAJO DE params={};
			//var filtro = document.getElementById('filtro_buscar').value;//FORMA PARA CAPTURAR EL VALOR DEL FILTRO
			//params.filtro=filtro;//ASIGNO EL VALOR DEL FILTRO
			
			//preparo los parametros
			params={};
			params.filtro=$('#filtro_buscar').val();
			params.fd=$('#fechad').val();
			params.fh=$('#fechah').val();
			params.action="filtroGrid";
			
			//alert(params.fd+"----"+params.fh);
			
			$('#content').load('index.php', params);
			
			
    })
	//RECARGAR TABLA FUNCION AGREGADA POR JORGE ANDRES VALENCIA 01/NOVIEMBRE/2014
	$('.recargar').live('click',function(){
						  
			params={};
			params.action="refreshGrid";
			$('#content').load('index.php', params);
			
			//location.href="/ejecucionprueba/eventos/index.php";
    })
	
	//GENERAR EXCEL
	$(".btnExport").click(function(e) {
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
    });
	
	
	//PARA LAS FECHAS DE LA REJILLA
	//SE DEFINEN DE LA FORMA SIN COMENTARIOS
	//YA QUE SI SE DEJA COMO ESTAN LAS DE
	//COMENTARIOS, AL REALIZAR UN FILTRO
	//CON LAS FECHAS SE REALIZA, PERO AL USARLAS 
	//NUEVAMENTE NO PERMITE CARGAR EL CALENDARIO
	
	//$('#fechad').datetimepicker();
	//$('#fechah').datetimepicker();
	
	$('#fechad').live('click',function(){
       $('#fechad').datetimepicker();
    })
	$('#fechah').live('click',function(){
       $('#fechah').datetimepicker();
    })
	
	//FILTRO RADICADO, EN LA VISTA clientForm2 ASIGNADO AL BOTON DEL ICONO LUPA
	$('.filtro_radicado').live('click',function(){
			
			//preparo los parametros
			params={};
			params.filtro=$('#filtro_buscar').val();
			params.action="filtroRadicado";
			
			//alert(params.filtro);
			
			$('#content').load('index.php', params);
			
			
    })
	
	//ELIMINAR ELEMENTO DE LA LISTA RADICADOS no canciona
	/*$('.boton_eliminar').live('click',function(){
						  
			var radicadoeliminar = document.getElementById('evedescripcion[]').value;
			//alert(radicadoeliminar);
			
			$("#evedescripcion[]").find("option[value='radicadoeliminar']").remove();
    })*/
	
	
	


})//FIN $(document).ready(function(){

NS={};

//2.REEMPLAZA LA LINEA $('#client').live('submit',function(){----} YA QUE USANDO LA VALIDACION
//DE ESTA FORMA EN ALGUNAS OCACIONES AL REALIZAR EL REGISTRO Y VOLVER 
//A LA REJILLA NO SE VE REFLEJADO EL NUEVO O LOS NUEVOS REGISTROS 
//ADICIONADOS Y DEBE HACERSE USO DEL BOTON RECARGAR(LAS DOS FLECHAS VERDES EN CIRCULO)
//PARA QUE TOME EL CAMBIO
//Y EN LA LINEA <form name ="client" id="client" method="POST" action="index.php" onsubmit="return validar_campos();"> 
//DEL FORMULARIO clientForm2.php SE AGREGA onsubmit="return validar_campos();" 
function validar_campos_clientForm2(){
		

			if (document.client.evefecha.value.length==0){
       			alert("Tiene que Definir Fecha")
				document.getElementById('evefecha').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client.eveasunto.value.length==0){
       			alert("Tiene que Definir Asunto")
				document.getElementById('eveasunto').style.backgroundColor='#9999FF';
				return false;
			}
			if (document.client.eveaccion.value.length==0){
       			alert("Tiene que Definir Accion")
				document.getElementById('eveaccion').style.backgroundColor='#9999FF';
				return false;
			}
			/*if (document.client.eveasignadoa.value.length==0){
       			alert("Tiene que Definir Asignado A")
				document.getElementById('eveasignadoa').style.backgroundColor='#9999FF';
				return false;
			}*/
			if (document.getElementById('evedescripcion[]').options.length == 0 || document.getElementById('evedescripcion[]').options.length == 1){
					alert("Tiene que Asignar al menos un Radicado a la lista Radicados");
					document.getElementById('evedescripcion[]').style.backgroundColor='#CCCCFF';
					return false;
			}
		
			if (confirm ("¿Esta seguro de Realizar el Proceso?")) {
				
				
				var params={};
				params.action='saveClient';
				params.id=$('#id').val();
				params.evefecha=$('#evefecha').val();
				params.eveasunto=$('#eveasunto').val();
				params.eveaccion=$('#eveaccion').val();
				params.everadicado=$('#everadicado').val();
				params.evejuzgadoreparto=$('#evejuzgadoreparto').val();
				params.eveasignadoa=$('#eveasignadoa').val();
				params.evedescripcion=$('#evedescripcion[]').val();
				params.evedescripcion2=$('#evedescripcion2').val();
				params.evedatos=$('#evedatos').val();
				
				params.datoslog=$('#datoslog').val();
				
				$.post('index.php',params,function(){
					$('#block').hide();
					$('#popupbox').hide();
					$('#content').load('index.php',{action:"refreshGrid"});
					
				})
				
        		return true;
    		} 
			else{return false;}
    
	
}



