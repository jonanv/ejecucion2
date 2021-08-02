function validarEvento()
{  
	
	error=0;
	error1=0;
    	
	indice= document.getElementById("selectNombre").selectedIndex;
	
	if(indice==""|| indice==0||indice==null)
    {	
	  document.getElementById("errornombre").innerHTML= "Debe Seleccionar el Nombre del Evento"
	  error=1;
    }
   else
	document.getElementById("errornombre").innerHTML= "";
	
	indice1= document.getElementById("selectCliente").selectedIndex;
	
	if(indice1==""|| indice1==0||indice1==null)
    {	
	  document.getElementById("errorcliente").innerHTML= "Debe Seleccionar el Cliente"
	  error=1;
    }
   else
	document.getElementById("errorcliente").innerHTML= "";
	
	
	
	if( document.getElementById("asistentes").disabled==false)
	{

	if(document.getElementById("asistentes").value==""){
	   document.getElementById("errorasistentes").innerHTML= "Debe Ingresar los asistentes del Evento"
	  error=1;
    }
   else
	document.getElementById("errorasistentes").innerHTML= "";
	}
	
	if( document.getElementById("lugar").disabled==false)
	{
	 
	
	   if(document.getElementById("lugar").value==""){
	   document.getElementById("errorlugar").innerHTML= "Debe Ingresar El lugar del Evento"
	   error=1;
       }  
      else
	   document.getElementById("errorlugar").innerHTML= "";
	 }
	   if(document.getElementById("textfielddescripcion").value==""){
	   document.getElementById("errordescripcion").innerHTML= "Debe Ingresar la Descripción del Evento"
	   error=1;
       }  
      else
	   document.getElementById("errordescripcion").innerHTML= "";
	   
	    if(document.getElementById("demo1").value==""){
	   document.getElementById("errorfecha").innerHTML= "Debe Ingresar la Fecha del Evento"
	   error=1;
       }  
      else
	   document.getElementById("errorfecha").innerHTML= "";
	sHora1=document.getElementById("time1").value
	sHora2=document.getElementById("time2").value
	   
    var arHora1 = sHora1.split(":");
    var arHora2 = sHora2.split(":");
    
    // Obtener horas y minutos (hora 1)
    var hh1 = parseInt(arHora1[0],10);
    var mm1 = parseInt(arHora1[1],10);

    // Obtener horas y minutos (hora 2)
    var hh2 = parseInt(arHora2[0],10);
    var mm2 = parseInt(arHora2[1],10);

    // Comparar
    if (hh1<hh2 || (hh1==hh2 && mm1<mm2))
        menor=1;
    else if (hh1>hh2 || (hh1==hh2 && mm1>mm2))
        menor=2;
    else 
        menor=0;

	//alert("menor es"+menor);
	if(menor==2)
	{
	alert("entre");
	error1=1;
	alert("La hora de Inicio del evento sobrepasa la hora de finalización")
	}
	if(menor==0)
	{
	error1=1;
	alert("La hora de Inicio del evento es igual a la hora de finalización")
	}
		
	
	if(error==0 && error1==0)
	{		
		alert("Evento Registrado en el Cronograma Correctamnete");
 	    document.form1.submit(); 
	}
	
	
} 
function tipoevento()
{
tipo= document.getElementById("selectNombre").selectedIndex;	

	
if(tipo==1||tipo==2) {
	

	  document.getElementById("asistentes").disabled=false;
	  document.getElementById("lugar").disabled=false;
	  
	  
	   }
	  else
		{
		
	document.getElementById("asistentes").disabled=true;
	document.getElementById("lugar").disabled=true;
	
		}

	
}
