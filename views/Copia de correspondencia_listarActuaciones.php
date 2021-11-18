<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title><?php echo titulo;?></title>
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<script src="views/js/jquery.js" type="text/javascript"></script>
<script src="views/js/jquery.easySlider.js" type="text/javascript"></script>
<script src="views/js/jquery.simplemodal.js" type="text/javascript"></script>
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
</script>
<script>
function vinculo(variable)
{

location.href="index.php?controller=correspondencia&action=editarActuaciones&nombre="+variable;
//document.write(location.href) 

}

function vinculo1(variable)
{
if(confirm('Realmente desea eliminar la actuación?'))
{
location.href="index.php?controller=correspondencia&action=elim_actuacion&nombre="+variable;
//document.write(location.href) 
}
}
function vinculo3(variable,variable1)
{
location.href="index.php?controller=correspondencia&action=regcorrespondenciaincidente&nombre="+variable+"&nombre2="+variable1;
}
</script>
</head>
<body>
<!---->
<?php require 'header.php'; ?>
<!---->
<?php require 'secc_correspondencia.php'; 
      require 'Paginador_3.0.0/Paginador.php';
?>


<?php $i=$j=1;
 $total_registros = $datos_actuaciones->rowcount();
     $pagina_r =20;
	  $cant_paginas = intval($total_registros/$pagina_r);
	  $todo= $total_registros/$pagina_r;
	  
	  $x=explode(".",$todo);
	  $dec = $x[1];
	   
	  if($dec>0)
	  {
	 $cant_paginas = $cant_paginas+1;
	  }
 //$cant_paginas;

while($field = $datos_actuaciones->fetch()){

$actuaciones[$i][radicado]=$field[radicado];
$actuaciones[$i][esoficio_telegrama]=$field[esoficio_telegrama];
$actuaciones[$i][oficio_telegrama]=$field[oficio_telegrama];
$actuaciones[$i][direccion]=$field[direccion];
$actuaciones[$i][nombre]=$field[nombre];
$actuaciones[$i][id]=$field[id];
$i++;
}

//print_r($actuaciones);
 ?>

    <?php
    //error_reporting(E_ALL | E_STRICT);
    $cantidadRegistrosPorPagina	= 20;
    $cantidadEnlaces            = 10;
    $totalRegistros             = $total_registros;
    $pagina                     = isset($_GET['pagina'])? $_GET['pagina'] : 0;
    

    $paginador  = new Paginador();

    $paginador->setCantidadRegistros($cantidadRegistrosPorPagina);
     /** AQUI INCLUIREMOS NUESTRO CODIGO DE CONFIGURACION DE ESTILOS */
     //$paginador->setClass('numero',          '<>');
    //$paginador->setClass('actual',          'active');
    //$paginador->setClass('siguiente',       'next',         'next-off');
    //$paginador->setClass('bloqueAnterior',  'previous',     'previous-off');
    //$paginador->setClass('bloqueSiguiente', 'next',         'next-off');
    //$paginador->setClass('primero',         'previous',     'previous-off');
    //$paginador->setClass('ultimo',          'next',         'next-off');
    

    $paginador->setCantidadEnlaces(7);
    $paginador->setOmitir(array('primero',
                                'bloqueAnterior',
                                'ultimo',
                                'bloqueSiguiente'));
    $paginador->setMarcador(null, null);
    
    $paginador->setTitulosVista('anterior',  '<<Anterior');
    $paginador->setTitulosVista('siguiente', 'Siguiente>>');
    
    $paginador->setClass('anterior',        'previous',     'previous-off');
    $paginador->setClass('siguiente',       'next',         'next-off');
    $paginador->setClass('actual',          'active');
    $paginador->setClass('numero',          '<>');
    
    $datos      = $paginador->paginar($pagina, $totalRegistros);
    $enlaces    = $paginador->getHtmlPaginacion('pagina', 'li');
    ?>

<!---->

    <table border="0" cellspacing="0" cellpadding="0" align="center" class="tablesorter" id="listado">
      <tr>
        <td><img src="views/images/crm_fondo_top.png" width="954" height="40" /></td>
      </tr>
      <tr>
        <td style="background:url(views/images/crm_fondo_body.png) repeat-y;">
<div id="contenido">
<form id="frm" name="frm" method="post" action="">
<div id="titulo_frm">
  <p>Lista de Actuaciones</p>
  </div>
<script type="text/javascript" src="views/js/jquery.quicksearch.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('table#frm_editar tbody tr').quicksearch({
				position: 'before',
				attached: 'table#listado',
				stripeRowClass: ['odd', 'even'],
				labelText: 'Buscar en la tabla'
			});

		});
	</script>
<table border="0" cellspacing="0" cellpadding="0" id="frm_editar">
  <thead>
  <tr>
    <th>Radicado</th>
	<th>Documento</th>
	<th>N&uacute;mero </th>
    <th>Direcci&oacute;n</th>
	<th>Nombre</th>
	<th>&nbsp;</th>
	<th>&nbsp; </th>
    </tr>
  </thead>
  <tbody>
<?php 
 while($j<$totalRegistros){?>
  <tr>
       <td><?php echo $actuaciones[$j][radicado];?></td>
	   <td><?php echo $actuaciones[$j][esoficio_telegrama];?></td>
	   <td><?php echo $actuaciones[$j][oficio_telegrama];?></td>
	 <td><?php echo $actuaciones[$j][direccion];?></td>
	    <td><?php echo $actuaciones[$j][nombre];?></td>
	    <td><span style="cursor:pointer"><img src="views/images/edit.png" width="21" height="23" onclick="vinculo(<?php echo $actuaciones[$j][id];?>)" title="Modificar Actuación"/></span></td>
	<td style="cursor:pointer"><?php if ($_SESSION['tipo_perfil']=='admin'){?>  <img src="views/images/elim.png" width="21" height="23" onclick="vinculo1(<?php echo $actuaciones[$j][id];?>)" title="Eliminar Actuación" /> <?php }?> </td>
    </tr>
    <?php  $j++;}?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">    <ul id="pagination-digg">
      <?php
        foreach ($enlaces as $enlace) {
            echo $enlace . "\n";
        }
    ?>
    </ul></td>
    <td>&nbsp;</td>
    <td style="cursor:pointer">&nbsp;</td>
  </tr>
  </tbody>
  </table>
</form> 
</div>
		
		</td>
      </tr>
      <tr>
        <td><img src="views/images/crm_fondo_foot.png" width="954" height="40" /></td>
      </tr>
    </table>
	
		<?php require 'alertas.php';?>
</body>
</html>
