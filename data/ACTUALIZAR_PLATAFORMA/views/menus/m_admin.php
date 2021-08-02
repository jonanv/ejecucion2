<?php  

require_once('./models/demandaModel.php');

//INSTANCIAMOS EL MODELO, PARA DAR USO DE SUS FUNCIONES
$modelo = new demandaModel();

$iddepartamento  =  $_SESSION['iddepartamento'];
$idmunicipio     =  $_SESSION['idmunicipio'];

$identidad_user = $_SESSION['nomusu'];
$nombre_user    = $_SESSION['nombre'];

//echo "DEPARTAMENTO: ".$_SESSION['Ndepartamento']." - MUNICIPIO: ".$_SESSION['Nmunicipio'];


//echo $iddepartamento.$idmunicipio;

//HORA MILITAR
$horaactual = $modelo->get_hora_actual_24horas();

//echo $horaactual;

$rango_horas = $modelo->rango_horas_municipio($idmunicipio);
	
$rango       = $rango_horas->fetch();
$hi          = $rango[hi];
$hf          = $rango[hf];

//RANGO DE HORA EN EL CUAL SE PUEDE REGISTRAR DEMANDAS -->
if($horaactual >= $hi && $horaactual <= $hf){ 
	
	
$tipo_usuario = $_SESSION['tipousuario'];

//echo $tipo_usuario;

$todos_los_modulos = 0;//TODOS LOS MODULOS
$modulo_rd         = 0;//MODULO RECEPCION DEMANDA
$modulo_cd         = 0;//MODULO CONSULTA DEMANDA

//ID DE USUARIOS QUE PUEDEN ENTRAR A TODOS LOS MODULOS, ID = 1
$campos                = 'usuario';
$nombrelista           = 'pa_usuario_acciones';
$idaccion			   = '1';
$campoordenar          = 'id';
$datos_lista_usuario_1 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_lista_usuario_2 = $datos_lista_usuario_1->fetch();
$datos_lista_usuario_3 = explode("////",$datos_lista_usuario_2[usuario]);

if ( in_array($_SESSION['idUsuario'],$datos_lista_usuario_3,true) ) { 

	$todos_los_modulos = 1;

}

//ID DE USUARIOS QUE PUEDEN ENTRAR AL MOULO RECEPCION DE DEMANDA, ID = 2
$idaccion			     = '2';
$campoordenar            = 'id';
$datos_lista_usuario_1_2 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_lista_usuario_2_2 = $datos_lista_usuario_1_2->fetch();
$datos_lista_usuario_3_2 = explode("////",$datos_lista_usuario_2_2[usuario]);

if ( in_array($_SESSION['idUsuario'],$datos_lista_usuario_3_2,true) ) { 

	$modulo_rd = 1;

}

//ID DE USUARIOS QUE PUEDEN ENTRAR AL MOULO CONSULTA DE DEMANDA, ID = 3
$idaccion			     = '3';
$campoordenar            = 'id';
$datos_lista_usuario_1_3 = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
$datos_lista_usuario_2_3 = $datos_lista_usuario_1_3->fetch();
$datos_lista_usuario_3_3 = explode("////",$datos_lista_usuario_2_3[usuario]);

if ( in_array($_SESSION['idUsuario'],$datos_lista_usuario_3_3,true) ) { 

	$modulo_cd = 1;

}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
<head>
<title>MENU PRINCIPAL</title>
        
        <meta charset="utf-8" /> 
		
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="assets/js/jquery-ui/jquery-ui.theme.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        
       
		<script src="assets/js/jquery-1.12.4-jquery.min.js" type="text/javascript"></script>



</head>

<body>

<h4 class="page-header" style="font-size:12px"><?php echo "USUARIO :". $identidad_user."<br>"."NOMBRE :". $nombre_user;?></h4>

<center>
<h4 class="page-header">
    <?php //echo $alm->__GET('id') != null ? $alm->__GET('nombre_usuario') : 'REGISTRO USUARIO'; ?>
	<br>
	RAMA JUDICIAL DEL PODER PUBLICO
	<br>
	DIRECCION EJECUTIVA DE ADMINSITRACION JUDICIAL
	<br>
	SECCIONAL CALDAS
	<br>
	<img src="views/images/logorama.png" width="300" height="80"/> 
</h4>
</center>

<center>
	<h4 class="page-header">
		MENU PRINCIPAL<br>
		<?php require_once('views/demanda_ubicacion.php'); ?>
	</h4>
</center>



<div class="well well-sm text-right">
    
	<a class="glyphicon glyphicon-off" href="index.php?controller=index&amp;action=close_session" title="Cerrar Sesion">
		Cerrar-Sesion
		<!-- <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-off"></span></button> -->
	
	</a>
</div>

<?php
if ( $todos_los_modulos == 1 ){ 
?>
  
  		<div class="row">
		
		
			<table class="table">

				<tr>	
				
					<td>	
						  <div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=demanda&amp;action=Listar_Demandas" title="REGISTRAR DEMANDA">
							
								<div class="thumbnail">
								
								 <!--  <img data-src="views/images/hv_6.png" alt="..."> -->
								  <img src="views/images/dda2.png"  width="219" height="219" alt="REGISTRAR DEMANDA">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">REGISTRAR DEMANDA</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>
						  
						  <div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=demanda&amp;action=Listar_Demandas_2" title="CONSULTAR DEMANDA">
							
								<div class="thumbnail">
								
								 <!--  <img data-src="views/images/hv_6.png" alt="..."> -->
								  <img src="views/images/dd3.jpg"  width="120" height="120" alt="CONSULTAR DEMANDA">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">CONSULTAR DEMANDA</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>
					  
					</td>
					
					
					
				</tr>
			  
			</table>
		  
		  
		</div>

<?php 
}
  else{ 
  ?>
  		<?php
  		if ( $modulo_rd == 1 || $tipo_usuario == 'PUBLICO' ){ 
  		?>
		
			<div class="row">
		
		
			<table class="table">

				<tr>	
				
					<td>	
						  <div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=demanda&amp;action=Listar_Demandas" title="REGISTRAR DEMANDA">
							
								<div class="thumbnail">
								
								 <!--  <img data-src="views/images/hv_6.png" alt="..."> -->
								  <img src="views/images/dda2.png"  width="219" height="219" alt="REGISTRAR DEMANDA">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">REGISTRAR DEMANDA</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>
						  
						 
					  
					</td>
					
					
					
				</tr>
			  
			</table>
		  
		  
		</div>
		
		
		<?php 
  		} 
 		?>
		
		<?php
  		if ( $modulo_cd == 1 ){ 
  		?>
		
			<div class="row">
		
		
			<table class="table">

				<tr>	
				
					<td>	
						  
						  
						  <div class="col-sm-6 col-md-3">
						  
							<a href="index.php?controller=demanda&amp;action=Listar_Demandas_2" title="CONSULTAR DEMANDA">
							
								<div class="thumbnail">
								
								 <!--  <img data-src="views/images/hv_6.png" alt="..."> -->
								  <img src="views/images/dd3.jpg"  width="120" height="120" alt="CONSULTAR DEMANDA">
								  <center>
								  <div class="caption">
									<h4 style="font-size:14px; font-family:Arial, Helvetica, sans-serif">CONSULTAR DEMANDA</h4>
								  </div>
								  </center>
								  
								</div>
								
							</a>
							
						  </div>
					  
					</td>
					
					
					
				</tr>
			  
			</table>
		  
		  
		</div> 
		
		
		<?php 
  		} 
 		?>
		
		
		
  
  <?php 
  } 
  ?>







<!-- FOOTER -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/js/ini.js"></script>
<script src="assets/js/jquery.anexsoft-validator.js"></script>
<!-- FIN FOOTER -->

</body>
</html>

<?php 
}//FIN SI HORAS
else{

		echo '<script languaje="JavaScript"> 
										
					
				var hi = "'.$hi.'";
				var hf = "'.$hf.'";
				
				var horaactual = "'.$horaactual.'";
				
				alert("NO ES POSIBLE EL INGRESO AL PORTAL, LA HORA DE REGISTRO DE DEMANDAS Y CONSULTA, ESTA FUERA DE RANGO "+" HORA INICIAL:"+hi+"-"+" HORA FINAL:"+hf+" HORA ACTUAL:"+horaactual);
				
				
				//location.href="index.php?controller=index&amp;action=close_session";	
				 
			</script>';
			
			session_unset();
			session_destroy();
			
			header("refresh: 0;URL=/ramajudicialpublica/");
			die();
			
			

}
 
 ?>
