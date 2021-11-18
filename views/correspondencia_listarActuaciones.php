<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title><?php echo titulo;?></title>
<link href="views/css/main.css" rel="stylesheet" type="text/css">
<link type="text/css" href="views/css/demo_table.css" rel="stylesheet" />
<link type="text/css" href="views/css/style.css" rel="stylesheet" />
<script src="views/js/jslistadopaises.js" type="text/javascript" ></script>
 <script src="views/js/jquery.dataTables.js" type="text/javascript" language="javascript" ></script>
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
      //require 'Paginador_3.0.0/Paginador.php';
?>

<?php require_once('libs/conexion.php');
$cn=  Conectarse();
$listado=  mysql_query("select * from countries",$cn);
?>
  <article id="contenido">
           <table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla_lista_paises">
                <thead>
                    <tr>
                        <th>id</th><!--Estado-->
                        <th>Pais</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                       
                     
                    </tr>
                </tfoot>
                  <tbody>
                    <?php

     
                   while($reg=  mysql_fetch_array($listado))
                   {
                               echo '<tr>';
                               echo '<td >'.mb_convert_encoding($reg['id'], "UTF-8").'</td>';
                               echo '<td>'.mb_convert_encoding($reg['country'], "UTF-8").'</td>';
                               echo '</tr>';
                     
                        }
                    ?>
                <tbody>
            </table>
</article>
  <footer>
      
    </footer>
</body>
</html>
