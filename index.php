<?php
require_once 'IndexController.class.php';
require_once 'EditController.class.php';

if (isset($_GET['action'])) {

    $actionArray = array('edit');

    if (in_array($_GET['action'], $actionArray)) {

        $action = $_GET['action'];
    } else {

        $action = 'Index';
    }
} else {

    $action = 'Index';
}

$controller = $action.'Controller';

$frontController = new $controller();

$frontController->request();
$frontController->viewsManagement();