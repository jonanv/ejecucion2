<?php
	
	//require 'models/userModel.php';
		
	$modelo = new userModel();
	
	$campos                 = 'usuario';
	$nombrelista            = 'pa_usuario_acciones';
	$idaccion			    = '8';
	$campoordenar           = 'id';
	$datosusuarioacciones_u = $modelo->get_lista_usuario_acciones($campos,$nombrelista,$idaccion,$campoordenar);
	$usuarios_u             = $datosusuarioacciones_u->fetch();
	$usuariosa_u			= explode("////",$usuarios_u[usuario]);

?>

<div id="contentSecc_conf">
    <div id="menusec">
        <li><a href="index.php?controller=user&amp;action=update_user">Modificar Datos</a></li>
            <div id="sep">|</div>
        <li><a href="index.php?controller=user&amp;action=passwr_user">Cambio de Contrase&ntilde;a</a></li>
            <div id="sep">|</div>
        <li><a href="index.php?controller=user&amp;action=photou_user">Cambio de Foto</a></li>
            <div id="sep">|</div>
<?php if ( in_array($_SESSION['idUsuario'],$usuariosa_u) ) {//if ($_SESSION['tipo_perfil']=='admin'){?>
       
      <li><a href="index.php?controller=user&amp;action=gestionar">Gestionar Sistema</a>
       </li>
       
       <?php }?>
  </div>
</div>