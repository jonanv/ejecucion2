<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo titulo?></title>

<script src="views/js/jquery.js" type="text/javascript"></script>

<!-- <link href="views/css/mppal.css" rel="stylesheet" type="text/css"> -->

</head>

<!-- <div id="ppal">

<div id="top"></div>

<div id="bar"> -->


<!-- <div id="cerrar" style=" margin-left:900px;"><a href="index.php?controller=index&amp;action=close_session"><img src="views/images/crm_exit.png" alt="Cerrar Sesion" title="Cerrar Sesion"/></a></div> -->

<!-- <div id="cerrar" style="margin:-680px -190px 0px 1335px"><a href="index.php?controller=index&amp;action=close_session"><img src="views/images/crm_exit.png" alt="Cerrar Sesion" title="Cerrar Sesion"/></a></div> -->

<!-- </div> -->

<!-- <div id="content"> -->

<?php 


//echo $_SESSION['rol'];




	switch ($_SESSION['rol']) 

	{

		/*----------------- Menu Administrador ----------------------*/

    	case 'Administrador':

		

			include 'views/menus/m_admin.php';
			
			//include 'views/menus/m_admin_NV.php';

        	break;	

			


		case 'Archivo':

		

			include 'views/menus/m_archivo.php';

        	break;	
			
			
		case 'Correspondencia':
           
			include 'views/menus/m_correspondencia.php';

        	break;		

				
	}



?>

<!-- </div>

</div> -->

</body>

</html>

