<?php
// includes
require_once 'assets/composer/vendor/autoload.php';
require_once 'init/10_database.php';
require_once 'init/20_imports.php';


$controllerName = $_GET['c'] ?? 'pages';
$actionName = $_GET['a'] ?? 'start';

if(!isset($_GET['c']) or !$_GET['a']){
    header('Location: index.php/?c=' .$controllerName . '&a=' . $actionName);
}

$controllerPath = __DIR__ . '/controller/' .$controllerName.'_controller.php';

if(file_exists($controllerPath)) {
    require_once $controllerPath;

    $controllerClassName = '\\PNS\\'.ucfirst($controllerName).'Controller';

    if(class_exists($controllerClassName)) {
        $controllerInstance = new $controllerClassName($actionName, $controllerName);

        $actionMethodName = 'action'.ucfirst($actionName);

        if(method_exists($controllerInstance, $actionMethodName)) {
            $controllerInstance->$actionMethodName();
            $controllerInstance->renderHTML();
        } else {
            sendHeaderByControllerAndAction('pages', 'errorPage');
        }
    } else {
        sendHeaderByControllerAndAction('pages', 'errorPage');
    }
} else{
    sendHeaderByControllerAndAction('pages', 'errorPage');
}