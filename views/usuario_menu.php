<?php  

require_once('./models/usuarioModel.php');

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo = new usuarioModel();

$idusuario = $_SESSION['idUsuario'];

$iddepartamento  =  $_SESSION['iddepartamento'];
$idmunicipio     =  $_SESSION['idmunicipio'];

$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];

//echo "DEPARTAMENTO: ".$_SESSION['Ndepartamento']." - MUNICIPIO: ".$_SESSION['Nmunicipio'];


//echo $iddepartamento.$idmunicipio;

//HORA MILITAR
$horaactual = $modelo->get_hora_actual_24horas();

//$horaactual = strtotime($horaactual);

$horaactual = $horaactual;

//echo $horaactual."<br>";

//NOTA: EN LA BASE DE DATOS TABLA dda_municipio EN LA COLUMNA hi Y hf
//DEBE SER DE LA SIGUIENTE FORMA hi:07:30 - hf: 22:00
//ES DECIR LA HORA INICIAL SE DEFINE DE LA FORMA 07:30 NO 7:30
$rango_horas = $modelo->rango_horas_municipio($idmunicipio,$iddepartamento);	
$rango       = $rango_horas->fetch();
//$hi          = strtotime($rango[hi]);
//$hf          = strtotime($rango[hf]);

$hi          = $rango[hi];
$hf          = $rango[hf];

$hi2         = $rango[hi2];
$hf2         = $rango[hf2];

//echo $hi."-".$hf."<br>";

//RANGO DE HORA EN EL CUAL SE PUEDE REGISTRAR DEMANDAS -->
//if( (trim($horaactual) >= $hi && trim($horaactual) <= $hf) || (trim($horaactual) >= $hi2 && trim($horaactual) <= $hf2) ){ 
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>MENU ADMINISTRAR USURIO</title>
        
        <meta charset="utf-8" /> 
		
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
       
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>
		
		
		<!-- ALERTAS -->
		<script src="views/js/alertify.js" type="text/javascript" charset="utf-8"></script>
		<link href="views/css/alertify.bootstrap.css" rel="stylesheet" type="text/css">
		<link href="views/css/alertify.core.css" rel="stylesheet" type="text/css">
		<link href="views/css/alertify.default.css" rel="stylesheet" type="text/css">
		<!-- FIN ALERTAS -->
		
		
		<script type="text/javascript">

//---------------------------------ALERTAS--------------------------------------------------------

function solicitudes_usuarios(){
    //una notificación normal
	
	var iduser = "<?php echo $idusuario; ?>" ;
	
	//alert(iduser);
	
	if(iduser == 2 || iduser == 182 || iduser == 2284){
	
	
		$.get("funciones/dda_solicitudes_usuario.php", function(cadenaX){
				
	
				
				if(cadenaX >= 1){
					
					alertify.log("ALERTA: INGRESO DE SOLICITUD DE USUARIO: "+cadenaX); 
					return false;
					
				}
				
				
				
				
		} );
	
		
	}
}

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

//---------------------------------FIN ALERTAS--------------------------------------------------------

//LLAMADO ALERTAS

// Crea un intervalo cada 5000ms (5s)
/*var jClockInterval = setInterval(function(){
	solicitudes_usuarios();
}, 5000);

var jClockInterval = setInterval(function(){
   horario();
}, 5000)*/

//FIN LLAMADO ALERTAS


</script>



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

<center><h1 class="page-header">ADMINISTRAR USUARIOS</h1></center>

<div class="row">
		
		
			<table class="table">

				<tr>	
				
					<td>	
						  <div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=usuario&amp;action=Listar_Usuarios" title="REGISTRAR USUARIO">
							
								<div class="thumbnail">
								
								 <!--  <img data-src="views/images/hv_6.png" alt="..."> -->
								  <img src="views/images/user_1.jpg"  width="219" height="219" alt="REGISTRAR USUARIO">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">REGISTRAR USUARIO</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>
						  
						<div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=usuario&amp;action=Listar_Solicitudes_Usuarios" title="PROCESAR SOLICITUDES USUARIO">
							
								<div class="thumbnail">
								
								 
								  <img src="views/images/usuer_2.png"  width="148" height="148" alt="PROCESAR SOLICITUDES USUARIO">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">PROCESAR SOLICITUDES USUARIO</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>   
						  
						  
					  
					</td>
					
					
					
				</tr>
			  
			</table>
		  
		  
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
//}//FIN SI HORAS
/*else{

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
