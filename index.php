<?php
ob_start();
session_start();
require_once 'autoload.php'; //cargamos el autoload para tener acceso a todos los controladores, a todos los objetos de todos los controladores, a todas las clases
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';



function show_error(){
    $error = new ErrorController();
    $error->index();
}





//Compruebo si me llega el controlador por la url
if(isset($_GET['controller'])){
    //si llega el controlador, se genera la variable.
    $nombre_controlador = $_GET['controller'].'Controller';
    
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

    $nombre_controlador = controller_default;

}else{
    show_error();
    exit();
}

//Compruebo si  existe el controlador, si existe creo el objeto
if(class_exists($nombre_controlador)){
    
    $controlador = new $nombre_controlador();

        //compruebo si llega la acción y si el método existe dentro del controlador
        if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
            $action=$_GET['action'];
            $controlador->$action();

        }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
            $action_default = action_default;
            $controlador->$action_default();
        }else{
            show_error();
        }



}else{
    show_error();
}




require_once 'views/layout/footer.php';



?>

