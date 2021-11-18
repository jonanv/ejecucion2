<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo titulo?></title>
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.validate.js" type="text/javascript"></script>
<script src="views/js/ui.datepicker.js" type="text/javascript" charset="utf-8"></script>                    	
<script src="views/js/select_dependientes.js" type="text/javascript"></script>
<link href="views/css/pepper-grinder/ui.all.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8">
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
	$(".topMenuAction").click( function() {
		if ($("#openCloseIdentifier").is(":hidden")) {
			$("#sliderm").animate({ 
				marginTop: "-238px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/open.png" alt="open" />');
			$("#openCloseIdentifier").show();
		} else {
			$("#sliderm").animate({ 
				marginTop: "0px"
				}, 500 );
			$("#topMenuImage").html('<img src="views/images/close.png" alt="close" />');
			$("#openCloseIdentifier").hide();
		}
	});  
		
	$("#sliderop").easySlider({});	
	$("#frm").validate();
	
	var validator = $("#frm").validate({
		meta: "validate"
	});

	$(".btn_limpiar").click(function() {
		validator.resetForm();
	});			
});
</script>	
<script type="text/javascript">
function mainmenu(){
$(" #menusec ul ").css({display: "none"});
$(" #menusec li").hover(function(){
	$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).slideDown(400);
	},function(){
		$(this).find('ul:first').slideUp(400);
	});
}
$(document).ready(function(){
	mainmenu();
});


function validar_ex(frm)
{
x= frm.validacion.value;
if(x==1)
{
 frm.submit();
}
else
{

  radicado = frm.radicado.value;
  var arreglo = frm.radicados.value;
  
  var array = arreglo.split(";");
  var index = array.indexOf(radicado);

 if(index!=-1)
 {
  alert("Ya existe un registro con el radicado ingresado o generado: "+radicado);
  frm.radicado.value = "";
  frm.ano.value="";
  frm.consecutivo.value="";
  frm.instancia.value=""; 
  frm.juzgado.value="";
  frm.validacion.value=0;    
 }


}
}


function activarradicado(frm)
{
 if(document.frm.manual.checked==true)
 {
  document.frm.radicado.readOnly = false;
   document.frm.radicado.value = "";
   frm.ano.disabled=true;
   frm.consecutivo.disabled=true;
   frm.instancia.disabled=true;
   
   
   
   
 }
 else
 {
  document.frm.radicado.value = "";
  document.frm.radicado.readOnly = true;
   frm.ano.disabled=false;
   frm.consecutivo.disabled=false;
   frm.instancia.disabled=false;
   
 }
}

function activar_acc(frm)
{
 if(document.frm.tiene_accionado.checked==true)
  {
    
	document.frm.accionado.disabled = false;
	document.frm.btn_input_accionado.disabled = false;
	
  
  }
  else
  {
  document.frm.accionado.value = "";
  document.frm.accionado.disabled = true;
   document.frm.btn_input_accionado.disabled = true;
  }
 if(document.frm.tiene_vinculado.checked==true)
  {
    
	document.frm.vinculado.disabled = false;
	document.frm.btn_input_vinculado.disabled = false;
	
  
  }
  else
  {
  document.frm.vinculado.value = "";
  document.frm.vinculado.disabled = true;
   document.frm.btn_input_vinculado.disabled = true;
  }
  
  
  
}


function construir_radicado(frm)
{

 if(document.frm.manual.checked==false)
 {
  var juzgado =frm.juzgado.value; 
  var area_vector = juzgado.split("-");
  var area_nueva = area_vector[1];
  var numero_juzgado = area_vector[2];
  var relleno ="";
  if(numero_juzgado>9)
  {
  relleno = "0";
  }
  else
  {
  relleno = "00";
  }
    
  var radicado = "";
  var ano = frm.ano.value;
  var consecutivo = frm.consecutivo.value;
  var instancia = frm.instancia.value;
   
  
  if(area_nueva==1)
  {
   var area = "170013103"; 
  }
  if(area_nueva==2)
  {
   var area = "170013110"; 
  }
   if(area_nueva==3)
  {
   var area = "170014003"; 
  }
  
  //alert(juzgado);
  //ADICIONADO PARA PODER REGISTRAR TUTELAS EN EL SISTEMA 14 DE ENERO 2016
  if(juzgado=="15-3-1")
  {
   var area = "170014303"; 
  }
  if(juzgado=="16-3-2")
  {
   var area = "170014303"; 
  }
  
  radicado = area+relleno+numero_juzgado+ano+"00"+consecutivo+instancia;
  //alert(radicado);
  frm.radicado.value = radicado;


  
 }
}
function validar_radicado(frm)
{

  radicado = frm.radicado.value;
  var arreglo = frm.radicados.value;
  
  var array = arreglo.split(";");
  var index = array.indexOf(radicado);

 if(index!=-1)
 {
  alert("Ya existe un registro con el radicado ingresado o generado: "+radicado);
  frm.radicado.value = "";
  frm.ano.value="";
  frm.consecutivo.value="";
  frm.instancia.value=""; 
  frm.juzgado.value="";
  frm.validacion.value=0;    
 }
else
{
alert("Radicado Dispobible");
frm.validacion.value=1;
} 



}

function medio(frm)
{
//alert("entre");
var m = document.frm.medio_notificacion.value;
var s = document.frm.notificado.checked ;
//alert(s);

if ((m==3)|| (m==5))
{
 if(s==true)
  {
   
   document.frm.adicionar1.disabled = false;
  }
  else {}
}
else
{

document.frm.adicionar1.disabled = true;
}


}
</script>
<script type="text/javascript">
function loadCiudad(dep) {
alert('entre');
location.href = "index.php?controller=correspondencia&action=filtro_ciudad&depto="+dep;
}
</script>

<script type="text/javascript" language="javascript">

function activar(frm)
{
	var x=document.frm.clase_proceso.value;
	var cant = document.frm.cantidad.value;
	var nom="";
	var nom1="";
	//alert (cant);
	var i =1;

	if (x==1 || x==2)
	{

	frm.accionante.disabled = false;
	frm.adicionar.disabled = false; 
	frm.accionado.disabled = false; 
	frm.esAccionado.disabled = false;
	frm.actuacion.disabled = false;

 
	}
	if(x==3)
	{
	 frm.accionante.value ="";
	 frm.accionado.value ="";
	 frm.esAccionado.checked  =false;
	  frm.actuacion.value ="";
	 frm.accionante.disabled = true; 
	 frm.adicionar.disabled = true; 
	 frm.accionado.disabled = true; 
	 frm.esAccionado.disabled = true; 
	frm.actuacion.disabled = true; 
	while(i<=cant)
	 {
	  nom= 'esAccionado'+i;
	  nom1= 'accionado'+i;
	  //alert(nom);
	  document.getElementById(nom).disabled=true
	  document.getElementById(nom1).disabled=true
	  //frm..disabled = true;
	  //frm.nom1.disabled=true;
	  i = i+1;
	 }
	

	}

//document.frm.enviar.disabled=!document.formulario.enviar.di
 
}
</script>

<script type="text/javascript">

numf2=0;
numf2_real=1;


function crearFormAccionado(form,frm) {

var valida_acc = document.frm.accionado.value;

if(valida_acc.length == 0)
{alert('Debe diligenciar el campo de Accionado, para adicionar un nuevo Accionado');}
else
{
  
  numf2++;
  numf2_real++;
  fi = document.getElementById('fiel_acc'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div_a'+numf2; // 3
  fi.appendChild(contenedor); // 4
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= '';
  ele.id= 'invisible';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'accionado'+numf2; 
  ele.id= 'accionado'+numf2;
  ele.className= 'required';
  contenedor.appendChild(ele); 

  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf2; 
  ele.value= '';
  ele.id= 'invisible';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  




  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div_a'+numf2; // 8
  ele.onclick = function () {borrarForm_accionado(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
 frm.cantidad_accionados.value=numf2;
 frm.cantidad_accionados_real.value=numf2_real;
 
} 
 
}


function borrarForm_accionado(obj) {
  fi = document.getElementById('fiel_acc');
  fi.removeChild(document.getElementById(obj));
  numf2_real = numf2_real-1;
  frm.cantidad_accionados_real.value=numf2_real; 
  
}
</script>
<script>
numf3=0;
function crearFormVinculado(form,frm) {

var valida_vin = document.frm.vinculado.value;

if(valida_vin.length == 0)
{alert('Debe diligenciar el campo de Vinculado, para adicionar un nuevo Vinculado');}
else
{


  numf3++;
  
  fi = document.getElementById('fiel_vinc'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div_v'+numf3; // 3
  fi.appendChild(contenedor); // 4
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= '';
  ele.id= 'invisible';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'vinculado'+numf3; 
  ele.id= 'vinculado'+numf3; 
  ele.className= 'required';
  contenedor.appendChild(ele); 

  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf3; 
  ele.value= '';
  ele.id= 'invisible';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  



  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div_v'+numf3; // 8
  ele.onclick = function () {borrarForm_vinculado(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  frm.cantidad_vinculados.value=numf3;
 } 
}


function borrarForm_vinculado(obj) {
  fi = document.getElementById('fiel_vinc');
  fi.removeChild(document.getElementById(obj)); 
  
}


</script>

<!--Función para crear las actuaciones-->

<script type="text/javascript">
numf=0;

function crearForm(form,frm) {

//alert('entre');
var valida = document.frm.accionante.value;

if(valida.length == 0)
{alert('Debe ingresar el campo de accionante');}
else
{


  numf++;
  
  fi = document.getElementById('fiel2'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+numf; // 3
  fi.appendChild(contenedor); // 4
  
  ele = document.createElement('hr');
   ele.id='br'; 
  contenedor.appendChild(ele);
  
    ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Asunto: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('select'); 
 // tipo_act=ele;
  ele.name = 'tipo_actuacion'+numf;  
  ele.id = 'tipo_actuacion-'+numf;  
   tipo_act=ele;
   ele.className = 'required';
  ele.options[0] = new Option("Seleccione un asunto");
  ele.options[0].value ="";
  ele.options[1] = new Option("Tutela");
  ele.options[1].value ="Tutela";
  ele.options[2] = new Option("Incidente");
  ele.options[2].value ="Incidente";
   ele.setAttribute("onChange","tipoActuacion(this.id,tipo_act,idact,idid);");
//    ele.onchange=function () {tipoActuacion(this.name,tipo_act,idact,idid);} 
  
  contenedor.appendChild(ele);
  
    ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele);  

  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Actuación: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 		
  
  ele = document.createElement('select');
  ele.name = 'idactuacion'+numf; 
  idact= ele;
  idid=ele.id = 'idactuacion'+numf; 
  ele.className = 'required';
  ele.options[0] = new Option("Seleccione la actuación");
  ele.options[0].value ="";
 
  contenedor.appendChild(ele);
  //tipo_act.onchange = function () {tipoActuacion(this.name,tipo_act,idact,idid);} 
 
 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 

  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'OficioTexto'+numf; 
  ele.value= 'Oficio';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'esOficio_Telegrama'+numf; // 6
  ele.id = 'esOficio_Telegrama'+numf; // 6
  ele.value = 'Oficio';
  ele.className = 'required';
  ele.checked ='checked'
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Telegrama';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; // 6
  ele.name = 'esOficio_Telegrama'+numf; 
  ele.id = 'esOficio_Telegrama'+numf; 
  ele.value = 'Telegrama';
  ele.className = 'required';
  contenedor.appendChild(ele);
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Número: ';
  ele.id= 'txt_input79';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'oficio_telegrama_numero'+numf; 
  ele.id= 'txt_input80';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= 'Dirección: ';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'direccion'+numf; 
  ele.id= 'txt_input';
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  

  ele = document.createElement('select'); 
  departamento=ele;
  ele.name = 'departamento'+numf; 
  ele.id = 'departamento-'+numf; 
  ele.className = 'required';
  departamentos = new Array("AMAZONAS","ANTIOQUIA","ARAUCA","ATLANTICO","BOGOTA","BOLIVAR","CALDAS","CAQUETA","CASANARE","CAUCA","CESAR","CHOCO","CORDOBA","CUNDINAMARCA","GUAINIA","GUAVIARE","HUILA","LA GUAJIRA","MAGDALENA","META","N. DE SANTANDER","NARIÑO","PUERTO BOYACA","PUTUMAYO","QUINDIO","RISARALDA","SAN ANDRES","SANTANDER","SUCRE","TOLIMA","VALLE DEL CAUCA","VAUPES","VICHADA");
  departamentosid = new Array("29","3","25","4","5","6","1","7","26","8","9","12","10","11","30","31","13","14","15","16","18","17","2","27","19","20","28","21","22","23","24","32","33");
  
  k= departamentos.length;
  
   ele.options[0] = new Option("Seleccione un departamento: ");
   ele.options[0].value ="";
   for(var i=0;i<k;i++){
        var j = i+1; 
        ele.options[j] = new Option(departamentos[i]);
		ele.options[j].value =departamentosid[i] ;
		}
 ele.setAttribute("onChange","ciudadForm(this.name,ciudad,ciudad_id,this.id);");		
  contenedor.appendChild(ele);
  
  ele = document.createElement('select'); 
  ciudad=ele;
  ele.name = 'ciudad'+numf;  
  ciudad_id=ele.id = 'ciudad'+numf;  
  ciudad=ele;
  ele.className = 'required';
  ele.options[0] = new Option("Seleccione una ciudad: ");
  ele.options[0].value ="";
  contenedor.appendChild(ele);
  //departamento.onchange = function () {ciudadForm(this.name,ciudad,ciudad_id);}
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'medio'+numf; 
  ele.value= 'Medio Notificación: ';
  ele.id= 'estilo_medio';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
 
  ele = document.createElement('select'); 
  ele.name = 'medio'+numf; 
  ele.id = 'sl_input'; 
  ele.className = 'required';
  ele.options[0] = new Option("Correo");
  ele.options[0].value =2; 
  ele.options[1] = new Option("Fax");
  ele.options[1].value =1; 
  ele.options[2] = new Option("Correo Electronico");
  ele.options[2].value =3; 
  ele.options[3] = new Option("Fax - Correo");
  ele.options[3].value =4;  
  ele.options[4] = new Option("Fax-Correo-Correo Electronico");
  ele.options[4].value =5;  
  ele.options[5] = new Option("Personal");
  ele.options[5].value =6;  
  contenedor.appendChild(ele);
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'medio'+numf; 
  ele.value= 'Fecha Envio: ';
  ele.id= 'txt_input81';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  var f = new Date(); 
  dia_f = f.getDate();
  if (dia_f <10)
  {
   dia = '0'+dia_f;
  }
  else
  {
   dia =dia_f;
  }
    mes_f = (f.getMonth() +1);
	
  
  if (mes_f <10)
  {

   mes = '0'+mes_f;
    
  }
  else
  {
   mes =mes_f;
  }
  
  fecha = f.getFullYear()+"-"+mes+"-"+dia;
  
  //document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'fecha_envio'+numf; 
  ele.id= 'txt_input80';
  ele.value= fecha;
  ele.readOnly =true;
  
  
  ele.className= 'required tinicio';
  contenedor.appendChild(ele); 
  
  
   

ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 


   
  contenedor.appendChild(ele); // 7
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'TAccionante'+numf; 
  ele.value= 'Accionante';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); 
  ele.type = 'radio'; 
  ele.name = 'accionante_accionado_vinculado'+numf; 
  ele.id = 'accionante_accionado_vinculado_accionante-'+numf; 
  ele.value = 'Accionante';
  ele.className = 'required';
//  ele.onchange = function () {validar_campo_accionante_acc_vin(this.id,numf);}
  ele.setAttribute("onChange","validar_campo_accionante_acc_vin(this.id,numf);");
  ele.checked ='checked';
  contenedor.appendChild(ele);  
  

  ele = document.createElement('input'); 
  ele.type = '<label>';
  ele.name = 'TAccionado'+numf;  
  ele.value= 'Accionado';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'accionante_accionado_vinculado'+numf; // 6
  ele.id = 'accionante_accionado_vinculado_accionado-'+numf; // 6
  ele.value = 'Accionado';
  ele.setAttribute("onChange","validar_campo_accionante_acc_vin(this.id,numf);");
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'TVinculado'+numf; 
  ele.value= 'Vinculado';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'accionante_accionado_vinculado'+numf; // 6
  ele.id = 'accionante_accionado_vinculado_vinculado-'+numf; // 6
  ele.value = 'Vinculado';
  ele.setAttribute("onChange","validar_campo_accionante_acc_vin(this.id,numf);");
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'TOtro'+numf; 
  ele.value= 'Otro';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  
  ele = document.createElement('input'); // 5
  ele.type = 'radio'; // 6
  ele.name = 'accionante_accionado_vinculado'+numf; // 6
  ele.id = 'accionante_accionado_vinculado_otro-'+numf; // 6
  ele.value = 'Otro';
  ele.setAttribute("onChange","validar_campo_accionante_acc_vin(this.id,numf);");
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  

  
  valor_accionante = document.getElementById('accionante_accionado_vinculado_accionante-'+numf).checked  
  valor_accionado = document.getElementById('accionante_accionado_vinculado_accionado-'+numf).checked  
  valor_vinculado = document.getElementById('accionante_accionado_vinculado_vinculado-'+numf).checked 
  valor_otro = document.getElementById('accionante_accionado_vinculado_otro-'+numf).checked  
  
  
  
  if(valor_accionante)
  {
  
  //alert("Accionante");
  
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  ele = document.createElement('br'); 
  contenedor.appendChild(ele); 
  
   ele = document.createElement('input'); 
   ele.type = '<label>'; 
   ele.name = 'label'+numf; 
   ele.value= 'Accionante: ';
   ele.id= 'label'+numf; ;
   ele.disabled= 'true';
   contenedor.appendChild(ele);
  
  ele = document.createElement('input'); 
  ele.type = 'text'; 
  ele.name = 'accionante_accionado_vinculado_texto'+numf; 
  ele.id= 'texto_accionante'+numf;
  ele.value = document.frm.accionante.value;
  ele.readOnly=true;
  ele.className= 'required';
  contenedor.appendChild(ele); 
  
 }
  
     ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+numf; 
  ele.value= '';
  ele.id= 'invisible';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 
  

  
  
   		
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input_borrar'+numf; // 8
  ele.name = 'div'+numf; // 8
  ele.onclick = function () {borrarForm(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";

  
  
  
  
  
  
  
  frm.cantidad_detalles.value=numf;

}
  
}
function tipoActuacion(obj,tipo_act,idact,idid) {

//alert(obj);
var m = document.getElementById(obj).value;


var nom = obj.split("-");

var nombre = "idactuacion"+nom[1];
//alert(nombre);
var x = document.getElementById(nombre);
//alert(x);
if(m=='Tutela')
{

 actuaciones = new Array("Admisión","Archivo","Avoca Conocimiento","Confirmación fallo","Confirmación parcial","Desistimiento","Envio a la Corte Costitucional","Envio por competencia","Fallo 1° Instancia","Fallo 2° Instancia","Impugnación","Inadmisión","Medida previa","Niega pruebas","Pruebas","Rechazo","vinculación");
  idactuaciones = new Array("33","1","3","6","7","8","9","10","11","12","15","16","17","18","21","22","28");
 }
 if(m=='Incidente')
{
 actuaciones = new Array("Apertura","Archivo","Decisión","Desistimiento","Envio en consulta circuito","Envio en consulta tribunal","Pone en conocimiento","Pruebas","Requerimiento");
  idactuaciones = new Array("31","1","32","8","30","29","20","21","25");
 } 
   
   k= actuaciones.length;  
  document.getElementById(nombre).innerHTML = ""; 
  for(var i=0;i<k;i++){
        x.options[i] = new Option(actuaciones[i]);
		x.options[i].value =idactuaciones[i] ;
		}
		
document.forms.form1.mes.options[x]=new Option(texto,valor,"defaultSelected");


}

function validar_campo_accionante_acc_vin(id,num) {


var nom = id.split("-");
var numero = nom[1];

//alert(numero);


/***  Tomo los valores de los radio button para saber cual esta chequeado**/
  valor_accionante = document.getElementById('accionante_accionado_vinculado_accionante-'+numero).checked  
  valor_accionado = document.getElementById('accionante_accionado_vinculado_accionado-'+numero).checked  
  valor_vinculado = document.getElementById('accionante_accionado_vinculado_vinculado-'+numero).checked 
  valor_otro = document.getElementById('accionante_accionado_vinculado_otro-'+numero).checked 

	
	
  if (valor_accionado)
  {//alert("Accionado");
  
   var accionados_chequeados = document.frm.tiene_accionado.checked;
   if(accionados_chequeados)
   {
     
	 var accionado_op = document.frm.accionado.value;
	 if(accionado_op.length == 0)
      {
	  
    /* for (i=0; ele1 = document.getElementById('accionante_accionado_vinculado_accionante'+numf)[i]; i++){
         ele1.checked = false;}*/
		 ele1 = document.getElementById('accionante_accionado_vinculado_accionante'+numero)[0];
		 ele1.checked = true;
		 
	 
	  alert('Debe ingresar el campo de accionado');
	  
	  }

     
	 else
	 {
	  
/****  Remover del formulario los campos de: accionante, la lista de accionados si estan definidos   ****/
	
	imagen = document.getElementById('texto_accionante'+numero);	
	if(imagen){
	padre = imagen.parentNode;
	padre.removeChild(imagen);}
	   
	imagen0 = document.getElementById('accionados_sl'+numero);	
	if(imagen0){	
	padre0 = imagen0.parentNode;
	padre0.removeChild(imagen0);}
	
/*	imagen1 = document.getElementById('btn_input_borrar'+numero);	
	if(imagen1){
	padre1 = imagen1.parentNode;
	padre1.removeChild(imagen1);}*/
	
	imagen2 = document.getElementById('vinculados_sl'+numero);	
	if(imagen2){
	padre2 = imagen2.parentNode;
	padre2.removeChild(imagen2);}
	
	imagen3 = document.getElementById('texto_otro'+numero);	
	if(imagen3){
	padre3 = imagen3.parentNode;
	padre3.removeChild(imagen3);}

	   
    document.getElementById('label'+numero).value = "Accionado: "; 

	  
	  
	  
	  
      var cantidad_accionados= document.frm.cantidad_accionados.value;
	  var i =1;
	  var cont=0;
	  
	  //x =document.forms[0].accionado5;
	  //y=document.frm.accionado5;
	  var opciones = new Array();
	  //z=document.getElementById('accionado5');
	  //alert(z);
	  //alert(cantidad_accionados);
	  
	  while(i<=cantidad_accionados)
	  {
	  z=document.getElementById('accionado'+i);
	  if(z)
	  {
	   
		opciones[cont] = document.getElementById('accionado'+i).value;
		cont++;
		
		//alert(opciones[i]);
	  }
	  else{
	  //alert("noexiste");
	  }
	  i = i+1;
	  }
	  f2 = 'fiel_'+numero;
	  var j = 1;
	  var k =0;
	  cant_opt =opciones.length;
	  //alert(cant_opt);
	  
	  
	  
	  
	  var primera_opt = document.frm.accionado.value;
	  
	  
	  
	  ele = elemento=document.createElement('select'); 
      tipo_act=ele;
  	  ele.name = 'accionados_sl'+numero;  
	  ele.id = 'accionados_sl'+numero;  
	  ele.className = 'required';
	  ele.options[0] = new Option(primera_opt);
	  ele.options[0].value =primera_opt;
	  while (j<=cant_opt)
	  {  
	  opcion = opciones[k];
	  ele.options[j] = new Option(opcion);
	  ele.options[j].value =opcion;
	  j++;
	  k++;
	  }
	 
	 
var parentElement = document.getElementById('div'+numero);
// Get a reference to the first child
var theFirstChild =document.getElementById('btn_input_borrar'+numero);

// Create a new element
var newElement = elemento;

// Insert the new element before the first child
parentElement.insertBefore(newElement, theFirstChild);
	 
	 
	 
	/* 
	contenedor.appendChild(ele);
	  */
	  
  
	  
	  
/*	  ele = document.createElement('input'); // 5
  	  ele.type = 'button'; // 6
  	  ele.value = 'Borrar'; // 8
	  ele.id = 'btn_input_borrar'+numero; // 8
	  ele.name = 'div'+numero; // 8
	  ele.onclick = function () {borrarForm(this.name);} // 9
	  contenedor.appendChild(ele);*/
		 
	 
	 }
	} 
   else
   {alert("Para seleccionar accionados debe ingresar el campo Accionado")}
  } 
  if(valor_accionante)
  {
   // alert('accionante');
	
/****  Remover del formulario los campos de: accionante, la lista de accionados si estan definidos   ****/
	
	imagen = document.getElementById('texto_accionante'+numero);	
	if(imagen){
	padre = imagen.parentNode;
	padre.removeChild(imagen);}
	   
	imagen0 = document.getElementById('accionados_sl'+numero);	
	if(imagen0){	
	padre0 = imagen0.parentNode;
	padre0.removeChild(imagen0);}
	
/*	imagen1 = document.getElementById('btn_input_borrar'+numero);	
	if(imagen1){
	padre1 = imagen1.parentNode;
	padre1.removeChild(imagen1);}*/
	
	imagen2 = document.getElementById('vinculados_sl'+numero);	
	if(imagen2){
	padre2 = imagen2.parentNode;
	padre2.removeChild(imagen2);}
	
	imagen3 = document.getElementById('texto_otro'+numero);	
	if(imagen3){
	padre3 = imagen3.parentNode;
	padre3.removeChild(imagen3);}

	  
	  
	  document.getElementById('label'+numero).value = "Accionante: "; 
 	  ele = elemento=document.createElement('input'); 
	  ele.type = 'text'; 
	  ele.name = 'accionante_accionado_vinculado_texto'+numero; 
	  ele.id= 'texto_accionante'+numero;
	  ele.value = document.frm.accionante.value;
	  ele.readOnly=true;
	  ele.className= 'required';
	  contenedor.appendChild(ele);
	  
	  var parentElement = document.getElementById('div'+numero);
// Get a reference to the first child
var theFirstChild =document.getElementById('btn_input_borrar'+numero);

// Create a new element
var newElement = elemento;

// Insert the new element before the first child
parentElement.insertBefore(newElement, theFirstChild);
	  

  }
   if(valor_vinculado)
  {
    //alert('vinculado');
	
	var vinculado_op = document.frm.vinculado.value;
	 if(vinculado_op.length > 0)
      {
	/****  Remover del formulario los campos de: accionante, la lista de accionados si estan definidos   ****/
	
	imagen = document.getElementById('texto_accionante'+numero);	
	if(imagen){
	padre = imagen.parentNode;
	padre.removeChild(imagen);}
	   
	imagen0 = document.getElementById('accionados_sl'+numero);	
	if(imagen0){	
	padre0 = imagen0.parentNode;
	padre0.removeChild(imagen0);}
	
/*	imagen1 = document.getElementById('btn_input_borrar'+numero);	
	if(imagen1){
	padre1 = imagen1.parentNode;
	padre1.removeChild(imagen1);}*/
	
	imagen2 = document.getElementById('vinculados_sl'+numero);	
	if(imagen2){
	padre2 = imagen2.parentNode;
	padre2.removeChild(imagen2);}
	
	imagen3 = document.getElementById('texto_otro'+numero);	
	if(imagen3){
	padre3 = imagen3.parentNode;
	padre3.removeChild(imagen3);}

	
	
	/****  Cambiar el label por Vinculados:    ****/
	
	document.getElementById('label'+numero).value = "Vinculado: "; 
 

  /****  Crear la lista de selección de vinculados:    ****/
  
	  var cantidad_vinculados= document.frm.cantidad_vinculados.value;
	  var i =1;
	  var cont=0;
	  
	  //x =document.forms[0].accionado5;
	  //y=document.frm.accionado5;
	  var opciones = new Array();
	  //z=document.getElementById('accionado5');
	  //alert(z);
	  //alert(cantidad_vinculados);
	  
	  while(i<=cantidad_vinculados)
	  {
	   z=document.getElementById('vinculado'+i);
	  if(z)
	  {
	   
		opciones[cont] = document.getElementById('vinculado'+i).value;
		cont++;
		
		//alert(opciones[i]);
	  }
	  else{
	  //alert("noexiste");
	  }
	  i = i+1;
	  }
	  f2 = 'fiel_'+numero;
	  var j = 1;
	  var k =0;
	  cant_opt =opciones.length;
	  //alert("CANT"+cant_opt);
	  
	  
	  
	  
	  var primera_opt = document.frm.vinculado.value;
	  
	  ele = elemento=document.createElement('select'); 
      tipo_act=ele;
  	  ele.name = 'vinculados_sl'+numero;  
	  ele.id = 'vinculados_sl'+numero;  
	  ele.className = 'required';
	  ele.options[0] = new Option(primera_opt);
	  ele.options[0].value =primera_opt;
	  while (j<=cant_opt)
	  {  
	  opcion = opciones[k];
	  ele.options[j] = new Option(opcion);
	  ele.options[j].value =opcion;
	  j++;
	  k++;
	  }
	var parentElement = document.getElementById('div'+numero);
	var theFirstChild =document.getElementById('btn_input_borrar'+numero);
	var newElement = elemento;
	parentElement.insertBefore(newElement, theFirstChild);
	
    }
	else
	{
	 alert("Para seleccionar vinculados debe ingresar el campo Vinculado")
	
	}
  }
  
  if(valor_otro)
  {
    //alert('vinculado');
	
	
	/****  Remover del formulario los campos de: accionante, la lista de accionados si estan definidos   ****/
	
	imagen = document.getElementById('texto_accionante'+numero);	
	if(imagen){
	padre = imagen.parentNode;
	padre.removeChild(imagen);}
	   
	imagen0 = document.getElementById('accionados_sl'+numero);	
	if(imagen0){	
	padre0 = imagen0.parentNode;
	padre0.removeChild(imagen0);}
	
/*	imagen1 = document.getElementById('btn_input_borrar'+numero);	
	if(imagen1){
	padre1 = imagen1.parentNode;
	padre1.removeChild(imagen1);}*/
	
	imagen2 = document.getElementById('vinculados_sl'+numero);	
	if(imagen2){
	padre2 = imagen2.parentNode;
	padre2.removeChild(imagen2);}
	
	imagen3 = document.getElementById('texto_otro'+numero);	
	if(imagen3){
	padre3 = imagen3.parentNode;
	padre3.removeChild(imagen3);}
	
	  document.getElementById('label'+numero).value = "Otro: "; 
 	  ele = elemento = document.createElement('input'); 
	  ele.type = 'text'; 
	  ele.name = 'texto_otro'+numero; 
	  ele.id= 'texto_otro'+numero; ;
	  ele.className= 'required';
	  contenedor.appendChild(ele);
	  
	  var parentElement = document.getElementById('div'+numero);
	  var theFirstChild =document.getElementById('btn_input_borrar'+numero);
	  var newElement = elemento;
	  parentElement.insertBefore(newElement, theFirstChild);

	
	
}	
  
  
  
 
}


function borrarForm(obj) {
  fi = document.getElementById('fiel2'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
  //num= num-1;
  
}



function ciudadForm(obj,ciudad,ciudad_id,dep_id) {

//alert(dep_id);



var m = document.getElementById(dep_id).value;

var nom = dep_id.split("-");
var nombre = "ciudad"+nom[1];

var x = document.getElementById(nombre);



if(m==1)
{
ciudades   = new Array("AGUADAS","ANSERMA","ARANZAZU","BELALCAZAR","CHINCHINA","FILADELFIA","LA DORADA","LA MERCED","MANIZALES","MANZANARES","MARMATO","MARQUETALIA","MARULANDA","NEIRA","NORCASIA","PACORA","PALESTINA","PENSILVANIA","RIOSUCIO","RISARALDA","SALAMINA","SAMANA","SAN JOSE","SUPIA","VICTORIA","VILLAMARIA","VITERBO");
idciudades = new Array("12","44","53","94","204","340","469","479","546","548","556","557","559","611","618","643","653","679","779","780","800","807","845","972","1076","1087","1100");
}
if(m==2)
{
ciudades = new Array("ALMEIDA","AQUITANIA","ARCABUCO","BELEN","BERBEO","BETEITIVA","BOAVITA","BOYACA","BRICEÑO","BUENAVISTA","BUSBANZA","CALDAS","CAMPOHERMOSO","CERINZA","CHINAVITA","CHIQUINQUIRA","CHIQUIZA","CHISCAS","CHITA","CHITARAQUE","CHIVATA","CHIVOR","CIENEGA","COMBITA","COPER","CORRALES","COVARACHIA","CUBARA","CUCAITA","CUITIVA","DUITAMA","EL COCUY","EL ESPINO","FIRAVITOBA","FLORESTA","GACHANTIVA","GAMEZA","GARAGOA","GsICAN","GUACAMAYAS","GUATEQUE","GUAYATA","IZA","JENESANO","JERICO","LA CAPILLA","LA UVITA","LA VICTORIA","LABRANZAGRANDE","MACANAL","MARIPI","MIRAFLORES","MONGUA","MONGUI","MONIQUIRA","MOTAVITA","MUZO","NOBSA","NUEVO COLON","OICATA","OTANCHE","PACHAVITA","PAEZ","PAIPA","PAJARITO","PANQUEBA","PAUNA","PAYA","PAZ DE RIO","PESCA","PISBA","PUERTO BOYACA","QUIPAMA","RAMIRIQUI","RAQUIRA","RONDON","SABOYA","SACHICA","SAMACA","SAN EDUARDO","SAN JOSE DE PARE","SAN LUIS DE GACENO","SAN MATEO","SAN MIGUEL DE SEMA","SAN PABLO DE BORBUR","SANTA MARIA","SANTA ROSA DE VITERBO","SANTA SOFIA","SANTANA","SATIVANORTE","SATIVASUR","SIACHOQUE","SOATA","SOCHA","SOCOTA","SOGAMOSO","SOMONDOCO","SORA","SORACA","SOTAQUIRA","SUSACON","SUTAMARCHAN","SUTATENZA","TASCO","TENZA","TIBANA","TIBASOSA","TINJACA","TIPACOQUE","TOCA","TOGsI","TOPAGA","TOTA","TUNJA","TUNUNGUA","TURMEQUE","TUTA","TUTAZA","UMBITA","VENTAQUEMADA","VILLA DE LEYVA","VIRACACHA","ZETAQUIRA");
idciudades = new Array("27","51","61","96","102","104","108","117","119","125","131","149","159","185","203","208","209","211","212","214","215","216","222","235","247","254","257","262","264","268","284","301","308","342","346","366","374","375","391","393","416","421","446","450","452","463","499","502","507","529","554","571","581","582","583","598","603","616","622","629","638","640","646","650","651","665","672","673","675","682","692","720","754","757","758","785","795","797","806","833","848","862","869","872","876","901","908","911","914","926","927","931","944","945","947","948","952","957","958","959","975","976","978","993","1000","1005","1006","1013","1014","1017","1020","1025","1029","1035","1036","1041","1042","1043","1047","1071","1080","1098","1117");
}
if(m==3)
{
ciudades = new Array("ABEJORRAL","ABRIAQUI","ALEJANDRIA","AMAGA","AMALFI","ANDES","ANGELOPOLIS","ANGOSTURA","ANORI","ANZA","APARTADO","ARBOLETES","ARGELIA","ARMENIA","BARBOSA","BELLO","BELMIRA","BETANIA","BETULIA","BRICEÑO","BURITICA","CACERES","CAICEDO","CALDAS","CAMPAMENTO","CAÑASGORDAS","CARACOLI","CARAMANTA","CAREPA","CAROLINA","CAUCASIA","CHIGORODO","CISNEROS","CIUDAD BOLIVAR","COCORNA","CONCEPCION","CONCORDIA","COPACABANA","DABEIBA","DON MATIAS","EBEJICO","EL BAGRE","EL CARMEN DE VIBORAL","EL SANTUARIO","ENTRERRIOS","ENVIGADO","FREDONIA","FRONTINO","GIRALDO","GIRARDOTA","GOMEZ PLATA","GRANADA","GUADALUPE","GUARNE","GUATAPE","HELICONIA","HISPANIA","ITAGUI","ITUANGO","JARDIN","JERICO","LA CEJA","LA ESTRELLA","LA PINTADA","LA UNION","LIBORINA","MACEO","MARINILLA","MEDELLIN","MONTEBELLO","MURINDO","MUTATA","NARIÑO","NECHI","NECOCLI","OLAYA","PEÐOL","PEQUE","PUEBLORRICO","PUERTO BERRIO","PUERTO NARE","PUERTO TRIUNFO","REMEDIOS","RETIRO","RIONEGRO","SABANALARGA","SABANETA","SALGAR","SAN ANDRES DE CUERQUIA","SAN CARLOS","SAN FRANCISCO","SAN JERONIMO","SAN JOSE DE LA MONTAÑA","SAN JUAN DE URABA","SAN LUIS","SAN PEDRO","SAN PEDRO DE URABA","SAN RAFAEL","SAN ROQUE","SAN VICENTE","SANTA BARBARA","SANTA ROSA DE OSOS","SANTAFE DE ANTIOQUIA","SANTO DOMINGO","SEGOVIA","SONSON","SOPETRAN","TAMESIS","TARAZA","TARSO","TITIRIBI","TOLEDO","TURBO","URAMITA","URRAO","VALDIVIA","VALPARAISO","VEGACHI","VENECIA","VIGIA DEL FUERTE","YALI","YARUMAL","YOLOMBO","YONDO","ZARAGOZA");
idciudades = new Array("1","3","23","33","34","39","40","41","43","46","48","60","65","69","85","99","100","103","105","118","130","136","140","150","156","161","168","169","171","175","182","198","225","226","228","236","239","246","277","282","286","288","297","326","335","336","355","357","380","382","384","389","400","411","413","428","431","444","445","449","451","464","471","487","495","517","531","553","561","585","600","601","604","609","610","630","676","680","712","719","732","742","761","766","776","792","794","805","814","826","838","843","846","855","861","879","881","883","884","887","894","907","913","919","928","953","954","985","990","992","1016","1022","1040","1051","1054","1058","1065","1066","1070","1077","1104","1105","1107","1108","1115");
}
if(m==4)
{
ciudades = new Array("BARANOA","BARRANQUILLA","CAMPO DE LA CRUZ","CANDELARIA","GALAPA","JUAN DE ACOSTA","LURUACO","MALAMBO","MANATI","PALMAR DE VARELA","PIOJO","POLONUEVO","PONEDERA","PUERTO COLOMBIA","REPELON","SABANAGRANDE","SABANALARGA","SANTA LUCIA","SANTO TOMAS","SOLEDAD","SUAN","TUBARA","USIACURI");
idciudades = new Array("81","92","157","162","369","456","528","540","542","656","691","700","701","724","763","789","791","900","920","950","962","1033","1056");
} 
if(m==5)
{
ciudades = new Array("BOGOTA, D.C.");
idciudades = new Array("110");
} 
if(m==6)
{
ciudades = new Array("ACHI","ALTOS DEL ROSARIO","ARENAL","ARJONA","ARROYOHONDO","BARRANCO DE LOBA","CALAMAR","CANTAGALLO","CARTAGENA","CICUCO","CLEMENCIA","CORDOBA","EL CARMEN DE BOLIVAR","EL GUAMO","EL PEÑON","HATILLO DE LOBA","MAGANGUE","MAHATES","MARGARITA","MARIA LA BAJA","MOMPOS","MONTECRISTO","MORALES","NOROSI","PINILLOS","REGIDOR","RIO VIEJO","SAN CRISTOBAL","SAN ESTANISLAO","SAN FERNANDO","SAN JACINTO","SAN JACINTO DEL CAUCA","SAN JUAN NEPOMUCENO","SAN MARTIN DE LOBA","SAN PABLO","SANTA CATALINA","SANTA ROSA","SANTA ROSA DEL SUR","SIMITI","SOPLAVIENTO","TALAIGUA NUEVO","TIQUISIO","TURBACO","TURBANA","VILLANUEVA","ZAMBRANO");
idciudades = new Array("7","31","62","67","71","90","146","164","176","219","227","250","295","310","318","424","534","536","551","552","580","586","591","619","690","760","772","831","834","836","841","842","857","868","875","897","905","909","939","955","981","1015","1038","1039","1091","1112");
} 
if(m==7)
{
ciudades = new Array("ALBANIA","BELEN DE LOS ANDAQUIES","CARTAGENA DEL CHAIRA","CURILLO","EL DONCELLO","EL PAUJIL","FLORENCIA","LA MONTAÑITA","MILAN","MORELIA","PUERTO RICO","SAN JOSE DEL FRAGUA","SAN VICENTE DEL CAGUAN","SOLANO","SOLITA","VALPARAISO");
idciudades = new Array("19","97","177","274","304","314","344","481","569","593","735","849","889","949","951","1064");
} 
if(m==8)
{
ciudades = new Array("ALMAGUER","ARGELIA","BALBOA","BOLIVAR","BUENOS AIRES","CAJIBIO","CALDONO","CALOTO","CORINTO","EL TAMBO","FLORENCIA","GUACHENE","GUAPI","INZA","JAMBALO","LA SIERRA","LA VEGA","LOPEZ","MERCADERES","MIRANDA","MORALES","PADILLA","PAEZ","PATIA","PIAMONTE","PIENDAMO","POPAYAN","PUERTO TEJADA","PURACE","ROSAS","SAN SEBASTIAN","SANTA ROSA","SANTANDER DE QUILICHAO","SILVIA","SOTARA","SUAREZ","SUCRE","TIMBIO","TIMBIQUI","TORIBIO","TOTORO","VILLA RICA");
idciudades = new Array("26","63","80","115","127","144","151","155","251","328","345","395","408","439","447","492","501","520","567","572","592","644","645","671","683","686","702","741","746","786","885","904","915","936","960","964","967","1011","1012","1027","1030","1083");
} 
if(m==9)
{
ciudades = new Array("AGUACHICA","AGUSTIN CODAZZI","ASTREA","BECERRIL","BOSCONIA","CHIMICHAGUA","CHIRIGUANA","CURUMANI","EL COPEY","EL PASO","GAMARRA","GONZALEZ","LA GLORIA","LA JAGUA DE IBIRICO","LA PAZ","MANAURE","PAILITAS","PELAYA","PUEBLO BELLO","RIO DE ORO","SAN ALBERTO","SAN DIEGO","SAN MARTIN","TAMALAMEQUE","VALLEDUPAR");
idciudades = new Array("10","14","72","93","116","201","210","276","303","313","372","385","473","475","483","544","648","678","709","769","811","832","866","982","1063");
} 
if(m==10)
{
ciudades = new Array("AYAPEL","BUENAVISTA","CANALETE","CERETE","CHIMA","CHINU","CIENAGA DE ORO","COTORRA","LA APARTADA","LORICA","LOS CORDOBAS","MOMIL","MOÑITOS","MONTELIBANO","MONTERIA","PLANETA RICA","PUEBLO NUEVO","PUERTO ESCONDIDO","PUERTO LIBERTADOR","PURISIMA","SAHAGUN","SAN ANDRES SOTAVENTO","SAN ANTERO","SAN BERNARDO DEL VIENTO","SAN CARLOS","SAN PELAYO","TIERRALTA","VALENCIA");
idciudades = new Array("75","124","160","184","199","205","221","256","459","521","523","579","584","587","589","697","710","726","729","748","798","816","817","824","827","882","1009","1059");
} 
if(m==11)
{
ciudades = new Array("AGUA DE DIOS","ALBAN","ANAPOIMA","ANOLAIMA","APULO","ARBELAEZ","BELTRAN","BITUIMA","BOJACA","CABRERA","CACHIPAY","CAJICA","CAPARRAPI","CAQUEZA","CARMEN DE CARUPA","CHAGUANI","CHIA","CHIPAQUE","CHOACHI","CHOCONTA","COGUA","COTA","CUCUNUBA","EL COLEGIO","EL PEÑON","EL ROSAL","FACATATIVA","FOMEQUE","FOSCA","FUNZA","FUQUENE","FUSAGASUGA","GACHALA","GACHANCIPA","GACHETA","GAMA","GIRARDOT","GRANADA","GUACHETA","GUADUAS","GUASCA","GUATAQUI","GUATAVITA","GUAYABAL DE SIQUIMA","GUAYABETAL","GUTIERREZ","JERUSALEN","JUNIN","LA CALERA","LA MESA","LA PALMA","LA PEÑA","LA VEGA","LENGUAZAQUE","MACHETA","MADRID","MANTA","MEDINA","MOSQUERA","NARIÑO","NEMOCON","NILO","NIMAIMA","NOCAIMA","PACHO","PAIME","PANDI","PARATEBUENO","PASCA","PUERTO SALGAR","PULI","QUEBRADANEGRA","QUETAME","QUIPILE","RICAURTE","SAN ANTONIO DEL TEQUENDAMA","SAN BERNARDO","SAN CAYETANO","SAN FRANCISCO","SAN JUAN DE RIO SECO","SASAIMA","SESQUILE","SIBATE","SILVANIA","SIMIJACA","SOACHA","SOPO","SUBACHOQUE","SUESCA","SUPATA","SUSA","SUTATAUSA","TABIO","TAUSA","TENA","TENJO","TIBACUY","TIBIRITA","TOCAIMA","TOCANCIPA","TOPAIPI","UBALA","UBAQUE","UNE","UTICA","VENECIA","VERGARA","VIANI","VILLA DE SAN DIEGO DE UBATE","VILLAGOMEZ","VILLAPINZON","VILLETA","VIOTA","YACOPI","ZIPACON","ZIPAQUIRA");
idciudades = new Array("9","16","36","42","50","57","101","107","111","133","137","145","165","167","173","190","196","206","217","218","230","255","265","302","316","324","338","350","353","361","362","363","364","365","367","371","381","388","396","402","412","414","415","419","420","422","453","457","462","480","482","486","500","513","532","533","547","562","596","605","613","614","615","617","641","649","664","668","669","738","744","749","750","755","767","819","822","829","839","854","925","929","932","935","938","943","956","966","970","971","974","977","979","995","997","999","1004","1007","1018","1019","1026","1044","1045","1048","1057","1069","1072","1075","1081","1085","1092","1096","1097","1101","1118","1119");
} 
if(m==12)
{
ciudades = new Array("ACANDI","ALTO BAUDO","ATRATO","BAGADO","BAHIA SOLANO","BAJO BAUDO","BOJAYA","CARMEN DEL DARIEN","CERTEGUI","CONDOTO","EL CANTON DEL SAN PABLO","EL CARMEN DE ATRATO","EL LITORAL DEL SAN JUAN","ISTMINA","JURADO","LLORO","MEDIO ATRATO","MEDIO BAUDO","MEDIO SAN JUAN","NOVITA","NUQUI","QUIBDO","RIO IRO","RIO QUITO","RIOSUCIO","SAN JOSE DEL PALMAR","SIPI","TADO","UNGUIA","UNION PANAMERICANA");
idciudades = new Array("5","30","74","76","77","78","112","174","188","240","292","294","311","443","458","519","563","564","565","620","624","751","770","771","778","851","941","980","1049","1050");
} 
if(m==13)
{
ciudades = new Array("ACEVEDO","AGRADO","AIPE","ALGECIRAS","ALTAMIRA","BARAYA","CAMPOALEGRE","COLOMBIA","ELIAS","GARZON","GIGANTE","GUADALUPE","HOBO","IQUIRA","ISNOS","LA ARGENTINA","LA PLATA","NATAGA","NEIVA","OPORAPA","PAICOL","PALERMO","PALESTINA","PITAL","PITALITO","RIVERA","SALADOBLANCO","SAN AGUSTIN","SANTA MARIA","SUAZA","TARQUI","TELLO","TERUEL","TESALIA","TIMANA","VILLAVIEJA","YAGUARA");
idciudades = new Array("6","8","15","25","29","82","158","231","332","376","378","401","432","441","442","460","488","607","612","633","647","652","654","693","694","781","799","810","902","965","991","996","1002","1003","1010","1095","1103");
}  
if(m==14)
{
ciudades = new Array("ALBANIA","BARRANCAS","DIBULLA","DISTRACCION","EL MOLINO","FONSECA","HATONUEVO","LA JAGUA DEL PILAR","MAICAO","MANAURE","RIOHACHA","SAN JUAN DEL CESAR","URIBIA","URUMITA","VILLANUEVA");
idciudades = new Array("20","89","279","280","312","351","427","476","537","543","775","856","1053","1055","1089");
}  
if(m==15)
{
ciudades = new Array("ALGARROBO","ARACATACA","ARIGUANI","CERRO SAN ANTONIO","CHIBOLO","CIENAGA","CONCORDIA","EL BANCO","EL PIÑON","EL RETEN","FUNDACION","GUAMAL","NUEVA GRANADA","PEDRAZA","PIJIÑO DEL CARMEN","PIVIJAY","PLATO","PUEBLOVIEJO","REMOLINO","SABANAS DE SAN ANGEL","SALAMINA","SAN SEBASTIAN DE BUENAVISTA","SAN ZENON","SANTA ANA","SANTA BARBARA DE PINTO","SANTA MARTA","SITIONUEVO","TENERIFE","ZAPAYAN","ZONA BANANERA");
idciudades = new Array("24","52","66","187","197","220","238","289","319","321","359","405","621","677","688","695","698","713","762","793","801","886","890","892","896","903","942","998","1114","1120");
}
if(m==16)
{
ciudades = new Array("ACACIAS","BARRANCA DE UPIA","CABUYARO","CASTILLA LA NUEVA","CUBARRAL","CUMARAL","EL CALVARIO","EL CASTILLO","EL DORADO","FUENTE DE ORO","GRANADA","GUAMAL","LA MACARENA","LEJANIAS","MAPIRIPAN","MESETAS","PUERTO CONCORDIA","PUERTO GAITAN","PUERTO LLERAS","PUERTO LOPEZ","PUERTO RICO","RESTREPO","SAN CARLOS DE GUAROA","SAN JUAN DE ARAMA","SAN JUANITO","SAN MARTIN","URIBE","VILLAVICENCIO","VISTAHERMOSA");
idciudades = new Array("4","87","134","181","263","269","291","298","305","358","387","406","478","512","549","568","725","727","730","731","736","765","828","852","858","867","1052","1094","1099");
} 
if(m==17)
{
ciudades = new Array("ALBAN","ALDANA","ANCUYA","ARBOLEDA","BARBACOAS","BELEN","BUESACO","CHACHAGsI","COLON","CONSACA","CONTADERO","CORDOBA","CUASPUD","CUMBAL","CUMBITARA","EL CHARCO","EL PEÑOL","EL ROSARIO","EL TABLON DE GOMEZ","EL TAMBO","FRANCISCO PIZARRO","FUNES","GUACHUCAL","GUAITARILLA","GUALMATAN","ILES","IMUES","IPIALES","LA CRUZ","LA FLORIDA","LA LLANADA","LA TOLA","LA UNION","LEIVA","LINARES","LOS ANDES","MAGsI","MALLAMA","MOSQUERA","NARIÑO","OLAYA HERRERA","OSPINA","PASTO","POLICARPA","POTOSI","PROVIDENCIA","PUERRES","PUPIALES","RICAURTE","ROBERTO PAYAN","SAMANIEGO","SAN ANDRES DE TUMACO","SAN BERNARDO","SAN LORENZO","SAN PABLO","SAN PEDRO DE CARTAGO","SANDONA","SANTA BARBARA","SANTACRUZ","SAPUYES","TAMINANGO","TANGUA","TUQUERRES","YACUANQUER");
idciudades = new Array("17","22","37","58","83","95","128","189","233","242","243","248","261","271","272","300","315","325","327","329","354","360","397","403","404","436","437","440","467","472","477","494","496","511","518","522","535","541","597","606","631","637","670","699","704","707","715","745","768","782","808","815","823","859","874","880","891","895","912","922","986","987","1037","1102");
}
if(m==18)
{
ciudades = new Array("ABREGO","ARBOLEDAS","BOCHALEMA","BUCARASICA","CACHIRA","CACOTA","CHINACOTA","CHITAGA","CONVENCION","CUCUTA","CUCUTILLA","DURANIA","EL CARMEN","EL TARRA","EL ZULIA","GRAMALOTE","HACARI","HERRAN","LA ESPERANZA","LA PLAYA","LABATECA","LOS PATIOS","LOURDES","MUTISCUA","OCAÑA","PAMPLONA","PAMPLONITA","PUERTO SANTANDER","RAGONVALIA","SALAZAR","SAN CALIXTO","SAN CAYETANO","SANTIAGO","SARDINATA","SILOS","TEORAMA","TIBU","TOLEDO","VILLA CARO","VILLA DEL ROSARIO");
idciudades = new Array("2","59","109","121","138","139","202","213","245","266","267","285","293","330","331","386","423","429","470","489","506","525","527","602","627","661","662","740","756","802","825","830","916","924","934","1001","1008","1021","1079","1082");
}
if(m==19)
{
ciudades = new Array("ARMENIA","BUENAVISTA","CALARCA","CIRCASIA","CORDOBA","FILANDIA","GENOVA","LA TEBAIDA","MONTENEGRO","PIJAO","QUIMBAYA","SALENTO");
idciudades = new Array("68","123","148","224","249","341","377","493","588","687","752","804");
}
if(m==20)
{
ciudades = new Array("APIA","BALBOA","BELEN DE UMBRIA","DOSQUEBRADAS","GUATICA","LA CELIA","LA VIRGINIA","MARSELLA","MISTRATO","PEREIRA","PUEBLO RICO","QUINCHIA","SANTA ROSA DE CABAL","SANTUARIO");
idciudades = new Array("49","79","98","283","417","465","505","558","574","681","711","753","906","921");
}
if(m==21)
{
ciudades = new Array("AGUADA","ALBANIA","ARATOCA","BARBOSA","BARICHARA","BARRANCABERMEJA","BETULIA","BOLIVAR","BUCARAMANGA","CABRERA","CALIFORNIA","CAPITANEJO","CARCASI","CEPITA","CERRITO","CHARALA","CHARTA","CHIMA","CHIPATA","CIMITARRA","CONCEPCION","CONFINES","CONTRATACION","COROMORO","CURITI","EL CARMEN DE CHUCURI","EL GUACAMAYO","EL PEÑON","EL PLAYON","ENCINO","ENCISO","FLORIAN","FLORIDABLANCA","GALAN","GAMBITA","GIRON","GsEPSA","GUACA","GUADALUPE","GUAPOTA","GUAVATA","HATO","JESUS MARIA","JORDAN","LA BELLEZA","LA PAZ","LANDAZURI","LEBRIJA","LOS SANTOS","MACARAVITA","MALAGA","MATANZA","MOGOTES","MOLAGAVITA","OCAMONTE","OIBA","ONZAGA","PALMAR","PALMAS DEL SOCORRO","PARAMO","PIEDECUESTA","PINCHOTE","PUENTE NACIONAL","PUERTO PARRA","PUERTO WILCHES","RIONEGRO","SABANA DE TORRES","SAN ANDRES","SAN BENITO","SAN GIL","SAN JOAQUIN","SAN JOSE DE MIRANDA","SAN MIGUEL","SAN VICENTE DE CHUCURI","SANTA BARBARA","SANTA HELENA DEL OPON","SIMACOTA","SOCORRO","SUAITA","SUCRE","SURATA","TONA","VALLE DE SAN JOSE","VELEZ","VETAS","VILLANUEVA","ZAPATOCA");
idciudades = new Array("11","18","54","84","86","88","106","113","120","132","153","166","170","183","186","194","195","200","207","223","237","241","244","252","275","296","309","317","320","333","334","347","349","368","373","383","390","392","399","409","418","425","454","455","461","484","508","509","526","530","539","560","577","578","626","628","632","655","657","667","684","689","714","734","743","777","788","812","820","840","844","847","871","888","893","898","937","946","961","968","973","1024","1060","1067","1074","1088","1113");
}
if(m==22)
{
ciudades = new Array("BUENAVISTA","CAIMITO","CHALAN","COLOSO","COROZAL","COVEÑAS","EL ROBLE","GALERAS","GUARANDA","LA UNION","LOS PALMITOS","MAJAGUAL","MORROA","OVEJAS","PALMITO","SAMPUES","SAN BENITO ABAD","SAN JUAN DE BETULIA","SAN LUIS DE SINCE","SAN MARCOS","SAN ONOFRE","SAN PEDRO","SANTIAGO DE TOLU","SINCELEJO","SUCRE","TOLU VIEJO");
idciudades = new Array("126","142","191","234","253","258","323","370","410","498","524","538","595","639","659","809","821","853","864","865","873","878","918","940","969","1023");
} 
if(m==23)
{
ciudades = new Array("ALPUJARRA","ALVARADO","AMBALEMA","ANZOATEGUI","ARMERO","ATACO","CAJAMARCA","CARMEN DE APICALA","CASABIANCA","CHAPARRAL","COELLO","COYAIMA","CUNDAY","DOLORES","ESPINAL","FALAN","FLANDES","FRESNO","GUAMO","HERVEO","HONDA","IBAGUE","ICONONZO","LERIDA","LIBANO","MARIQUITA","MELGAR","MURILLO","NATAGAIMA","ORTEGA","PALOCABILDO","PIEDRAS","PLANADAS","PRADO","PURIFICACION","RIOBLANCO","RONCESVALLES","ROVIRA","SALDAÑA","SAN ANTONIO","SAN LUIS","SANTA ISABEL","SUAREZ","VALLE DE SAN JUAN","VENADILLO","VILLAHERMOSA","VILLARRICA");
idciudades = new Array("28","32","35","47","70","73","143","172","180","193","229","259","273","281","337","339","343","356","407","430","433","434","435","514","516","555","566","599","608","636","660","685","696","706","747","773","784","787","803","818","860","899","963","1061","1068","1086","1093");
}
if(m==24)
{
ciudades = new Array("ALCALA","ANDALUCIA","ANSERMANUEVO","ARGELIA","BOLIVAR","BUENAVENTURA","BUGALAGRANDE","CAICEDONIA","CALI","CALIMA","CANDELARIA","CARTAGO","DAGUA","EL AGUILA","EL CAIRO","EL CERRITO","EL DOVIO","FLORIDA","GINEBRA","GUACARI","GUADALAJARA DE BUGA","JAMUNDI","LA CUMBRE","LA UNION","LA VICTORIA","OBANDO","PALMIRA","PRADERA","RESTREPO","RIOFRIO","ROLDANILLO","SAN PEDRO","SEVILLA","TORO","TRUJILLO","TULUA","ULLOA","VERSALLES","VIJES","YOTOCO","YUMBO","ZARZAL");
idciudades = new Array("21","38","45","64","114","122","129","141","152","154","163","178","278","287","290","299","306","348","379","394","398","448","468","497","504","625","658","705","764","774","783","877","930","1028","1032","1034","1046","1073","1078","1110","1111","1116");
}
if(m==25)
{
ciudades = new Array("ARAUCA","ARAUQUITA","CRAVO NORTE","FORTUL","PUERTO RONDON","SARAVENA","TAME");
idciudades = new Array("55","56","260","352","737","923","984");
}
if(m==26)
{
ciudades = new Array("AGUAZUL","CHAMEZA","HATO COROZAL","LA SALINA","MANI","MONTERREY","NUNCHIA","OROCUE","PAZ DE ARIPORO","PORE","RECETOR","SABANALARGA","SACAMA","SAN LUIS DE PALENQUE","TAMARA","TAURAMENA","TRINIDAD","VILLANUEVA","YOPAL");
idciudades = new Array("13","192","426","491","545","590","623","635","674","703","759","790","796","863","983","994","1031","1090","1109");
}
if(m==27)
{
ciudades = new Array("COLON","LEGUIZAMO","MOCOA","ORITO","PUERTO ASIS","PUERTO CAICEDO","PUERTO GUZMAN","SAN FRANCISCO","SAN MIGUEL","SANTIAGO","SIBUNDOY","VALLE DEL GUAMUEZ","VILLAGARZON");
idciudades = new Array("232","510","576","634","718","721","728","837","870","917","933","1062","1084");
}
if(m==28)
{
ciudades = new Array("PROVIDENCIA","SAN ANDRES");
idciudades = new Array("708","813");
}
if(m==29)
{
ciudades = new Array("EL ENCANTO","LA CHORRERA","LA PEDRERA","LA VICTORIA","LETICIA","MIRITI - PARANA","PUERTO ALEGRIA","PUERTO ARICA","PUERTO NARIÑO","PUERTO SANTANDER","TARAPACA");
idciudades = new Array("307","466","485","503","515","573","716","717","733","739","989");
}
if(m==30)
{
ciudades = new Array("BARRANCO MINAS","CACAHUAL","INIRIDA","LA GUADALUPE","MAPIRIPANA","MORICHAL","PANA PANA","PUERTO COLOMBIA","SAN FELIPE");
idciudades = new Array("91","135","438","474","550","594","663","723","835");
}
if(m==31)
{
ciudades = new Array("CALAMAR","EL RETORNO","MIRAFLORES","SAN JOSE DEL GUAVIARE");
idciudades = new Array("147","322","570","850");
}
if(m==32)
{
ciudades = new Array("CARURU","MITU","PACOA","PAPUNAUA","TARAIRA","YAVARATE");
idciudades = new Array("179","575","642","666","988","1106");
}

if(m==33)
{
ciudades = new Array("CUMARIBO","LA PRIMAVERA","PUERTO CARREÑO","SANTA ROSALIA");
idciudades = new Array("270","490","722","910");
}

   kk= ciudades.length;
   
   document.getElementById(nombre).innerHTML = "";
  
   for(var i=0;i<kk;i++){ 
        x.options[i] = new Option(ciudades[i]);
		x.options[i].value = idciudades[i]  ;
		}
  contenedor.appendChild(ele);
 
}






num=0;
num1=0;
var array = new Array();

function crear(form,frm) {


  num++;
  
  fi = document.getElementById('fiel'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'text'; // 6
  ele.name = 'accionado'+num; // 6
  ele.id = 'accionado'+num; // 6
  //ele.id = 'txt_input'; // 6
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  

  
  ele = document.createElement('input'); 
  ele.type = '<label>'; 
  ele.name = 'apellido1'+num; 
  ele.value= 'Accionado?';
  ele.id= 'txt_input78';
  ele.disabled= 'true';
  contenedor.appendChild(ele); 


  ele = document.createElement('input'); // 5
  ele.type = 'checkbox'; // 6
  ele.name = 'esAccionado'+num; // 6
  ele.id = 'esAccionado'+num;
  ele.value = 1;
//  ele.id = 'txt_input'; // 6
  //ele.className = 'required';
  contenedor.appendChild(ele); // 7
 
  
  
  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div'+num; // 8
  ele.onclick = function () {borrar(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
  frm.cantidad.value=num;
  frm.temp.value=num;
 
  

  
}
function borrar(obj) {
  fi = document.getElementById('fiel'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10
  //num= num-1;
  frm.cantidad.value=num;
  frm.temp.value=num;
}





function crear1(form,frm) {


  num1++;
  
  fi = document.getElementById('fiel1'); // 1
  contenedor = document.createElement('div'); // 2
  contenedor.id = 'div'+num1; // 3
  fi.appendChild(contenedor); // 4
 
  ele = document.createElement('input'); // 5
  ele.type = 'file'; // 6
  ele.name = 'evidencia'+num1; // 6
  ele.id = 'evidencia'+num1; // 6
  //ele.id = 'txt_input'; // 6
  ele.className = 'required';
  contenedor.appendChild(ele); // 7
  

  ele = document.createElement('input'); // 5
  ele.type = 'button'; // 6
  ele.value = 'Borrar'; // 8
  ele.id = 'btn_input'; // 8
  ele.name = 'div'+num1; // 8
  ele.onclick = function () {borrar1(this.name);} // 9
  contenedor.appendChild(ele); // 7
//  array[num]="";
  frm.cantidad_evidencias.value=num1;
  
   
}
function borrar1(obj) {
  fi = document.getElementById('fiel1'); // 1 
  fi.removeChild(document.getElementById(obj)); // 10

 
}
--> 


</script>


</head>

<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; ?>
<!---->
<table border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
  </tr>
  <tr>
    <td style="background:url(views/images/crm_fondo_body.png) repeat-y;"><div id="contenido">
      <form id="frm" name="frm" method="post" enctype="multipart/form-data" action="">
        <div id="titulo_frm">Registrar Tutela &oacute; Incidente</div>
        <table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
          <tr>
            <td width="163">Radicado Manual:</td>
            <td width="512"><label>
            <?php  $radicado="";
			while($field = $datos_radicados->fetch()){ 
			
			$radicado = $radicado.";".$field[radicado];

			}
			//print_r($radicado);		
			
			?>
              <input type="hidden" name="radicados" id="radicados" value="<?php echo $radicado;?>" />
              <input type="checkbox" name="manual" id="manual" onchange="activarradicado(frm)" />
            
            </label></td>
          </tr>
          <tr>
            <td>Seleccione el a&ntilde;o del radicado:</td>
            <td><select name="ano" id="sl_input" class="required" onchange="construir_radicado(frm)">
              <option value="">Seleccione el a&ntilde;o</option>
              <option value="2001">2001</option>
              <option value="2002">2002</option>
              <option value="2003">2003</option>
              <option value="2004">2004</option>
              <option value="2005">2005</option>
              <option value="2006">2006</option>
              <option value="2007">2007</option>
              <option value="2008">2008</option>
              <option value="2009">2009</option>
              <option value="2010">2010</option>
              <option value="2011">2011</option>
              <option value="2012">2012</option>
              <option value="2013">2013</option>
              <option value="2014">2014</option>
              <option value="2015">2015</option>
              <option value="2016">2016</option>
              <option value="2017">2017</option>  
			  <option value="2018">2018</option>
			  <option value="2019">2019</option>
			  <option value="2020">2020</option>
			  <option value="2021">2021</option>
               </select></td>
          </tr>
          <tr>
            <td>Consecutivo (tres car&aacute;cteres):</td>
            <td><label>
              <input name="consecutivo" type="text" id="txt_input_corto" size="8" maxlength="3" minlength="3" class="required number" onchange="construir_radicado(frm)"/>
            </label></td>
          </tr>
          <tr>
            <td>Asunto:</td>
            <td><label>
              <select name="proceso" id="sl_input">
                <option value="Tutela">Tutela</option>
                <option value="Incidente">Incidente</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>Instancia:</td>
            <td><label>
              <select name="instancia" id="sl_input" class="required" onchange="construir_radicado(frm)">
                <option option value="">Seleccione una instancia</option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td>Juzgado:</td>
            <td><select name="juzgado" class="required" id="sl_input" onchange="construir_radicado(frm)">
            <option value="" selected="selected">Seleccione un juzgado</option>
              <?php
 while($fieldj = $datos_juzgados->fetch()){
 	
				if($fieldj[id] == 15 || $fieldj[id] == 16){
  
 ?>
              <option value="<?php echo $fieldj[id]."-".$fieldj[idarea]."-".$fieldj[numero_juzgado];?>" ><?php echo $fieldj[nombre] ?></option>
              <?php }}?>
            </select></td>
          </tr>
          <tr>
            <td>Radicado</td>
            <td> <input name="radicado" type="text" class="required" id="txt_input" size="23" maxlength="23" minlength="23" readonly="readonly" />
              <input type="button" name="validar" value="Validar Existencia" id="btn_input" onclick="validar_radicado(frm)" /></td>
          </tr>
          <tr>
            <td>Accionante (DTE):</td>
            <td><label>
              <input type="text" name="accionante" id="txt_input" class="required"  />
            </label></td>
          </tr>
          <tr>
            <td>Accionado (DDO):</td>
            <td> <input type="checkbox" name="tiene_accionado" id="manual2" onchange="activar_acc(frm)" />
              <input type="text" name="accionado" id="txt_input" disabled="disabled" class="required" />
              <input type="button" name="btn_input_accionado" id="btn_input" disabled="disabled" value="Adicionar Accionado"  onclick="crearFormAccionado(this,frm)" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><fieldset id="fiel_acc"></fieldset></td>
          </tr>
          <tr>
            <td>Vinculado</td>
            <td><input type="checkbox" name="tiene_vinculado" id="manual3" onchange="activar_acc(frm)" />
              <input type="text" name="vinculado" id="txt_input" disabled="disabled" class="required" />
              <input type="button" name="btn_input_vinculado" id="btn_input" disabled="disabled" value="Adicionar Vinculado"  onclick="crearFormVinculado(this,frm)" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><fieldset id="fiel_vinc"></fieldset></td>
          </tr>
          <tr>
            <td colspan="2"><fieldset id="fiel2"></fieldset></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
			<input type="button" name="btn_input" id="btn_input_accion" value="Adicionar Actuaci&oacute;n"  onclick="crearForm(this,frm)" />			</td>
          </tr>
          <tr>
            <td>Fecha:</td><?php date_default_timezone_set('America/Bogota'); 

      $fecha=date('Y-m-d');?>
            <td><input type="text" name="fecha" id="txt_input" class="required tinicio" value="<?php echo $fecha;?>" readonly="readonly"/>
              <script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function()
			{
			  jQuery(".tinicio").datepicker({ changeFirstDay: false	});
			});
	</script>	</td>
          </tr>
          
       
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Registrar" id="btn_input"  onclick="validar_ex(frm)">
                  <input type="hidden" name="Submit2" value="Restablecer" id="btn_input" class="btn_limpiar"/>
                  <input name="cantidad_detalles" type="hidden" id="hiddenField" value="0" /><input name="cantidad_evidencias" type="hidden" id="hiddenField" value="0" />
                  <input name="cantidad_accionados" type="hidden" id="hiddenField2" value="0" /> <input name="cantidad_vinculados" type="hidden" id="hiddenField2" value="0" />
                  <input name="cantidad_accionados_real" type="hidden" id="hiddenField3" value="0" />
                  <input type="hidden" name="validacion" id="hiddenField4" value="0" /></td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
  <tr>
    <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
  </tr>
</table>

</body>
</html>
