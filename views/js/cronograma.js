//funcion para comparar dos fechas
function Compara(fechainicio,fechafin)
{
    var fecha=fechainicio.split('-');
	var Anio=fecha[0];
	var Mes=fecha[1]-1;
	var Dia=fecha[2];
	
	var fecha1=fechafin.split('-');
	var Anio1=fecha1[0];
	var Mes1=fecha1[1]-1;
	var Dia1=fecha1[2];
	var Fecha_Inicio = new Date(Anio,Mes,Dia)
    var Fecha_Fin = new Date(Anio1,Mes1,Dia1)
    if(Fecha_Inicio <= Fecha_Fin)
    {
      return 0;
     }
    else
    {
	  	
      return 1;
     }
}	 
//valida cronograma de paginas web
function cronpagina(frm){
//////alert("entre");
error1=0;
error=0;
num= frm.num.value;
num= num-1;

ti=frm.TiempoInicio.value;
tf=frm.TiempoFin.value;

//1°etapa

fini=frm.TiempoInicio1.value;
ffin=frm.TiempoFin1.value
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	
	}
	else
	{
	document.getElementById("errorini1").innerHTML=""
	}
	
	
    if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin1").innerHTML="";
	}
		
}

if(frm.desarrollo1.value!="")
 {
  	 valor=frm.desarrollo1.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo1").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }


//2°etapa

if(num==1)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio2.value;
ffin=frm.TiempoFin2.value;
desa=frm.desarrollo2.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini2").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin2").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo2.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo2").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//3°etapa
if(num==1 || num==2)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{

fini=frm.TiempoInicio3.value;
ffin=frm.TiempoFin3.value;
desa=frm.desarrollo3.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini3").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin3").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo3.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo3").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//4°etapa
if(num==1 || num==2 || num==3)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio4.value;
ffin=frm.TiempoFin4.value;
desa=frm.desarrollo4.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini4").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}

	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin4").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo4.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo4").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//5°etapa
if(num==1 || num==2 || num==3 || num==4)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio5.value;
ffin=frm.TiempoFin5.value;
desa=frm.desarrollo5.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini5").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin5").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo5.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo5").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//6°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio6.value;
ffin=frm.TiempoFin6.value;
desa=frm.desarrollo6.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini6").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin6").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo6.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo6").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//7°etapa
if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio7.value;
ffin=frm.TiempoFin7.value;
desa=frm.desarrollo7.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini7").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin7").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo7.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo7").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }


//8°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio8.value;
ffin=frm.TiempoFin8.value;
desa=frm.desarrollo8.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini8").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin8").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo8.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo8").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//9°etapa
if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio9.value;
ffin=frm.TiempoFin9.value;
desa=frm.desarrollo9.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini9").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin9").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo9.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo9").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }


//10°etapa
if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio10.value;
ffin=frm.TiempoFin10.value;
desa=frm.desarrollo10.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini10").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini10").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini10").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin10").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin10").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo10.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo10").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo10").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo10").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }


//11°etapa
if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9 || num==10)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio11.value;
ffin=frm.TiempoFin11.value;
desa=frm.desarrollo11.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini11").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini11").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini11").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin11").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin11").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo11.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo11").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo11").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo11").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
if(error==0&&error1==0)
	{
	 if(frm.tipo.value==1)
	 {
	  ////alert("Cronograma Registrado Correctamente");
	 }
	 if(frm.tipo.value==2)
	 {
	  ////alert("Cronograma Modificado Correctamente");
	 }
	
	document.frm.submit();
	
	}

}
//valida cronogramarender
function cronrender(frm){
//////alert("entre");
error1=0;
error=0;

ti=frm.TiempoInicio.value;
tf=frm.TiempoFin.value;
num= frm.num.value;
num= num-1;


//1°etapa
fini=frm.TiempoInicio1.value;
ffin=frm.TiempoFin1.value
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	
	}
	else
	{
	document.getElementById("errorini1").innerHTML=""
	}
	
	
    if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin1").innerHTML="";
	}
		
}

if(frm.desarrollo1.value!="")
 {
  	 valor=frm.desarrollo1.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo1").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//2°etapa
if(num==1)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio2.value;
ffin=frm.TiempoFin2.value;
desa=frm.desarrollo2.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini2").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin2").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo2.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo2").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//3°etapa
if(num==1 || num==2)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio3.value;
ffin=frm.TiempoFin3.value;
desa=frm.desarrollo3.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini3").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin3").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo3.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo3").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//4°etapa
if(num==1 || num==2 || num==3)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio4.value;
ffin=frm.TiempoFin4.value;
desa=frm.desarrollo4.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini4").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}

	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin4").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo4.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo4").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
//5°etapa

if(num==1 || num==2 || num==3 || num==4)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio5.value;
ffin=frm.TiempoFin5.value;
desa=frm.desarrollo5.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini5").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin5").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo5.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo5").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//6°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio6.value;
ffin=frm.TiempoFin6.value;
desa=frm.desarrollo6.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini6").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin6").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo6.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo6").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//7°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio7.value;
ffin=frm.TiempoFin7.value;
desa=frm.desarrollo7.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini7").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin7").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo7.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   

		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo7").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//8°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio8.value;
ffin=frm.TiempoFin8.value;
desa=frm.desarrollo8.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini8").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin8").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo8.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo8").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//9°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio9.value;
ffin=frm.TiempoFin9.value;
desa=frm.desarrollo9.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini9").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin9").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo9.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo9").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//10°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio10.value;
ffin=frm.TiempoFin10.value;
desa=frm.desarrollo10.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini10").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini10").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini10").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin10").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin10").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo10.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo10").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo10").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo10").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//11°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9 || num==10)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio11.value;
ffin=frm.TiempoFin11.value;
desa=frm.desarrollo11.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini11").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini11").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini11").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin11").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin11").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo11.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo11").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo11").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo11").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//12°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9 || num==10 || num==11)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio12.value;
ffin=frm.TiempoFin12.value;
desa=frm.desarrollo12.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini12").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini12").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini12").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin12").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin12").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo12.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo12").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo12").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo12").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }


//13°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9 || num==10 || num==11 || num==12)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio13.value;
ffin=frm.TiempoFin13.value;
desa=frm.desarrollo13.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini13").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini13").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini13").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin13").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin13").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo13.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo13").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo13").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo13").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//14°etapa
if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8 || num==9 || num==10 || num==11 || num==12 || num==13)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio14.value;
ffin=frm.TiempoFin14.value;
desa=frm.desarrollo14.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini14").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini14").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini14").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
		
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin14").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin14").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo14.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo14").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo14").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo14").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
  
if(error==0&&error1==0)
	{
	 if(frm.tipo.value==1)
	 {
	  ////alert("Cronograma Registrado Correctamente");
	 }
	 if(frm.tipo.value==2)
	 {
	  //alert("Cronograma Modificado Correctamente");
	 }
	document.frm.submit();
	
	}

}
//valida cronograma de video
function cronvideo(frm){
error1=0;
error=0;

ti=frm.TiempoInicio.value;
tf=frm.TiempoFin.value;
num= frm.num.value;
num= num-1;

//1°etapa

fini=frm.TiempoInicio1.value;
ffin=frm.TiempoFin1.value
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	
	}
	else
	{
	document.getElementById("errorini1").innerHTML=""
	}
	
	
    if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin1").innerHTML="";
	}
		
}

if(frm.desarrollo1.value!="")
 {
  	 valor=frm.desarrollo1.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo1").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//2°etapa

if(num==1)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio2.value;
ffin=frm.TiempoFin2.value;
desa=frm.desarrollo2.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini2").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin2").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo2.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo2").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//3°etapa
if(num==1 || num==2)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio3.value;
ffin=frm.TiempoFin3.value;
desa=frm.desarrollo3.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini3").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin3").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo3.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo3").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//4°etapa

if(num==1 || num==2 || num==3)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio4.value;
ffin=frm.TiempoFin4.value;
desa=frm.desarrollo4.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini4").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}

	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin4").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo4.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo4").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
  
//5°etapa

if(num==1 || num==2 || num==3 || num==4)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio5.value;
ffin=frm.TiempoFin5.value;
desa=frm.desarrollo5.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini5").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin5").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo5.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo5").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
  
//6°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio6.value;
ffin=frm.TiempoFin6.value;
desa=frm.desarrollo6.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini6").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin6").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo6.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo6").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//7°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio7.value;
ffin=frm.TiempoFin7.value;
desa=frm.desarrollo7.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini7").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin7").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo7.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   

		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo7").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

//8°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio8.value;
ffin=frm.TiempoFin8.value;
desa=frm.desarrollo8.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini8").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin8").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo8.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo8").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
//9°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio9.value;
ffin=frm.TiempoFin9.value;
desa=frm.desarrollo9.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini9").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin9").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo9.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo9").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 

if(error==0&&error1==0)
	{
	 if(frm.tipo.value==1)
	 {
	  ////alert("Cronograma Registrado Correctamente");
	 }
	 if(frm.tipo.value==2)
	 {
	  ////alert("Cronograma Modificado Correctamente");
	 }
	document.frm.submit();
	
	}

}
//valida cronograma de software
function cronsw(frm){
error1=0;
error=0;

ti=frm.TiempoInicio.value;
tf=frm.TiempoFin.value;
num= frm.num.value;
num= num-1;


//1°etapa

fini=frm.TiempoInicio1.value;
ffin=frm.TiempoFin1.value
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	
	}
	else
	{
	document.getElementById("errorini1").innerHTML=""
	}
	
	
    if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin1").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin1").innerHTML="";
	}
		
}

if(frm.desarrollo1.value!="")
 {
  	 valor=frm.desarrollo1.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo1").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo1").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
	

//2°etapa

if(num==1)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio2.value;
ffin=frm.TiempoFin2.value;
desa=frm.desarrollo2.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini2").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin2").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin2").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo2.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo2").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo2").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 

//3°etapa

if(num==1 || num==2)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio3.value;
ffin=frm.TiempoFin3.value;
desa=frm.desarrollo3.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini3").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin3").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin3").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo3.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo3").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo3").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

 
//4°etapa

if(num==1 || num==2 || num==3)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio4.value;
ffin=frm.TiempoFin4.value;
desa=frm.desarrollo4.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini4").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}

	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin4").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin4").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo4.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo4").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo4").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 
 
//5°etapa

if(num==1 || num==2 || num==3 || num==4)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio5.value;
ffin=frm.TiempoFin5.value;
desa=frm.desarrollo5.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini5").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin5").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin5").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo5.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo5").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo5").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
	
 
//6°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio6.value;
ffin=frm.TiempoFin6.value;
desa=frm.desarrollo6.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini6").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin6").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin6").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo6.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo6").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo6").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

 
//7°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio7.value;
ffin=frm.TiempoFin7.value;
desa=frm.desarrollo7.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini7").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin7").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin7").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo7.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   

		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo7").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo7").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
//8°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio8.value;
ffin=frm.TiempoFin8.value;
desa=frm.desarrollo8.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini8").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin8").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin8").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo8.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo8").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo8").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }

 
//9°etapa

if(num==1 || num==2 || num==3 || num==4 || num==5 || num==6 || num==7 || num==8)
{
 fini=""; 
 ffin="";
 desa="";
}
else
{
fini=frm.TiempoInicio9.value;
ffin=frm.TiempoFin9.value;
desa=frm.desarrollo9.value;
}
if(fini!=""&& ffin!="")
{
	if(Compara(fini,ffin)==1)
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="La fecha sobrepasa la fecha de finalizaci&oacute;n";
	}
	else{
	document.getElementById("errorini9").innerHTML="";
	}
	
	if(Compara(fini,ti)==0 || Compara(fini,tf)==1 )
	{ 
	error1=1;
 	document.getElementById("errorini9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	
	
	if(Compara(ffin,ti)==0 || Compara(ffin,tf)==1 )
	{ 

	error1=1;
 	document.getElementById("errorfin9").innerHTML="la fecha no se encuentra en el rango de desarrollo del proyecto";
	}
	else{
	
	document.getElementById("errorfin9").innerHTML="";
	}
		
}

if(desa!="")
 {
  	 valor=frm.desarrollo9.value;
	 if (/^([0-9])*$/.test(valor))
	   {
		   
		if(valor<=100 && valor>=0)
		{
		document.getElementById("errordesarrollo9").innerHTML="";
		}
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
		
	  }
		else
		{
			document.getElementById("errordesarrollo9").innerHTML= "Valor incorrecto"; 
			error=1;
		}	
 }
 

if(error==0&&error1==0)
	{
	 if(frm.tipo.value==1)
	 {
	  ////alert("Cronograma Registrado Correctamente");
	 }
	 if(frm.tipo.value==2)
	 {
	  ////alert("Cronograma Modificado Correctamente");
	 }
	document.frm.submit();
	
	}

}