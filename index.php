<?php
require_once './autoload.php';
require_once './config/parameters.php';
require_once './views/layout/header.php';

$controllerName = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : DEFAULT_CONTROLLER;
$action = isset($_GET['action']) ? $_GET['action'] : DEFAULT_ACTION;

//Si el controlador existe crea una instancia
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    $classMethods = get_class_methods(new $controller);
    //si el action esta vacio carga el index
    if (empty($action)) {
        $controller->index();
        //Carga el action en caso de que exista
    } else if (array_search($action, $classMethods) !== false) {
        $controller->$action();
        //retorna un error
    } else {
        $controller = new ErrorController();
        $controller->index();
    }
    //retorna un error si el controller o el action estan vacios o no existen
} else {
    $controller = new ErrorController();
    $controller->index();
}



require_once './views/layout/footer.php';




