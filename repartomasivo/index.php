<?php

/**
 * Autor: xxxxxxxxxxxxxxxxxxxxxxxxxxx
 * Web: http://www.tutorialjquery.com
 *
 */

session_start();

if ($_SESSION['id'] == "") {
    header("refresh: 0; URL=/laborales/");
} else {
    //echo $_SESSION['idUsuario']; 
    include_once("clase.php"); // incluyo las clases a ser usadas
    $action = 'index';
    if (isset($_POST['action'])) {
        $action = $_POST['action']; /*echo $_POST['datoslog']*/;
    }


    $view = new stdClass(); // creo una clase standard para contener la vista
    $view->disableLayout = false; // marca si usa o no el layout , si no lo usa imprime directamente el template


    // para no utilizar un framework y simplificar las cosas uso este switch, la idea
    // es que puedan apreciar facilmente cuales son las operaciones que se realizan
    switch ($action) {
        case 'index':
            $view->clientes = Cliente::getClientes(); // tree todos los clientes
            //$view->suma=Cliente::getSuma(); // trae la suma de los pesos de los clientes FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014 
            $view->contentTemplate = "templates/clientesGrid.php"; // seteo el template que se va a mostrar
            break;

        case 'refreshGrid':
            $view->disableLayout = true; // no usa el layout
            $view->clientes = Cliente::getClientes();
            //$view->suma=Cliente::getSuma(); // trae la suma de los pesos de los clientes FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA 28 OCTUBRE 2014 
            $view->contentTemplate = "templates/clientesGrid.php"; // seteo el template que se va a mostrar
            break;

        case 'saveClient':
            // limpio todos los valores antes de guardarlos
            // por ls dudas venga algo raro
            $id = intval($_POST['id']);
            $evefecha = cleanString($_POST['evefecha']);
            $eveasunto = cleanString($_POST['eveasunto']);
            $eveaccion = cleanString($_POST['eveaccion']);
            $everadicado = cleanString($_POST['everadicado']);
            $evejuzgadoreparto = cleanString($_POST['evejuzgadoreparto']);
            $eveasignadoa = cleanString($_POST['eveasignadoa']);
            $evedescripcion = cleanString($_POST['evedescripcion']);
            $evedescripcion2 = cleanString($_POST['evedescripcion2']);

            $cliente = new Cliente($id);
            $cliente->setEvefecha($evefecha);
            $cliente->setEveasunto($eveasunto);
            $cliente->setEveaccion($eveaccion);
            $cliente->setEveradicado($everadicado);
            $cliente->setEvejuzgadoreparto($evejuzgadoreparto);
            $cliente->setEveasignadoa($eveasignadoa);
            $cliente->setEvedescripcion($evedescripcion);
            $cliente->setEvedescripcion2($evedescripcion2);

            $evedatos = trim($_POST['evedatos']);
            $cliente->setEvedatos($evedatos);

            $cliente->save();

            //SE RECIBE LA VARIABLE datoslog CON LOS DATOS NECESARIOS PARA CREAR UN REGISTRO EN LA TABLA log
            //ESTA VARIABLE PROVIENE DE LA VISTA clientForm.php DE UN CAMPO OCULTO (hidden) CUYO id="datoslog"
            //ES ENVIADO AL DAR GIARDAR EL EVENTO PASA ESTA INFORMACION A functions.js al evento $('#client').live('submit',function(){
            //EL CUAL A SU VEZ LO DEVUELVE A index.php CUANDO EL CASE ES case 'saveClient':
            $datoslog = trim($_POST['datoslog']);
            $cliente->setDatoslog($datoslog);
            $cliente->save_log();

            break;

        case 'newClient':
            $view->client = new Cliente();
            $view->label = 'Datos del Proceso';
            $view->label_2 = 'Opciones de Reparto';
            $view->disableLayout = true;
            //$view->accion=Cliente::getAccion(); // trae los datos(id,acc_descripcion) accion_expediente 
            //$view->asignado=Cliente::getFuncioanrioasignado();
            //$view->radicado=Cliente::getRadicado(); // trae los datos(id,radicado) de la tabla ubicacion_expediente
            $view->juzgadoreparto = Cliente::getJuzgadoreparto();

            //NUEVO 24-MARZO-2015
            $view->listaestado = Cliente::getListaEstado();
            $view->listadetalleestado = Cliente::getListaDetalleEstado();
            $view->listaclaseproceso = Cliente::getListaClaseProceso();
            $view->listaponente = Cliente::getListarDespachosJusticiaXXI();

            $view->contentTemplate = "templates/clientForm2.php"; // seteo el template que se va a mostrar
            break;

        case 'editClient':
            $editId = intval($_POST['id']);
            $view->label = 'Editar Reparto';
            $view->accion = Cliente::getAccion(); // trae los datos(id,acc_descripcion) accion_expediente 
            $view->asignado = Cliente::getFuncioanrioasignado();
            //$view->radicado=Cliente::getRadicado(); // trae los datos(id,radicado) de la tabla ubicacion_expediente
            $view->juzgadoreparto = Cliente::getJuzgadoreparto();
            $view->client = new Cliente($editId);
            $view->disableLayout = true;
            $view->contentTemplate = "templates/clientForm.php"; // seteo el template que se va a mostrar
            break;

        case 'deleteClient':
            $id = intval($_POST['id']);
            $client = new Cliente($id);
            $client->delete();

            //REGISTRAR EN LA TABLA LOG DEL EVENTO deleteClient
            $datoslog2 = trim($_POST['datoslog2']);
            $cliente = new Cliente();
            $cliente->setDatoslog2($datoslog2);
            $cliente->save_log2();

            die; // no quiero mostrar nada cuando borra , solo devuelve el control.
            break;

            //--------------------FUNCIONES AGREGADAS POR JORGE ANDRES VALENCIA---------------------------------------------
        case 'filtroGrid':

            $filtro = trim($_POST['filtro']);
            $fd = trim($_POST['fd']);
            $fh = trim($_POST['fh']);

            $view->disableLayout = true; // no usa el layout
            $view->clientes = Cliente::getClientesFiltro($filtro, $fd, $fh);
            $view->contentTemplate = "templates/clientesGrid.php"; // seteo el template que se va a mostrar
            break;

        case 'filtroRadicado':

            $filtro = trim($_POST['filtro']);

            $view->disableLayout = true; // no usa el layout
            $view->radicado = Cliente::getClientesFiltroRadicado($filtro);
            $view->contentTemplate = "templates/clientForm2.php"; // seteo el template que se va a mostrar
            break;

            //------------------------------------------------------------------------------------------------------------------
        default:
    }

    // si esta deshabilitado el layout solo imprime el template
    if ($view->disableLayout == true) {
        include_once($view->contentTemplate);
    } else {
        include_once('templates/layout.php');
    } // el layout incluye el template adentro

}
