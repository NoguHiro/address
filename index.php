<?php

ini_set('display_errors', 1);

require 'app/config/db.php';
require 'core/Db.php';
require 'core/View.php';

require 'app/model/Address.php';


define('VIEW_PATH', __DIR__ . '/app/views/');
define('CONTROLLER_PATH', __DIR__ . '/app/controller/');
define('SUFFIX_CONTROLLER', '_Controller');
define('PREFIX_METHOD', 'action_');
define('GET_CONTROLLER', 'c');
define('GET_METHOD', 'm');

if (!isset($_GET[GET_CONTROLLER])) {
    try {
        require_once 'app/controller/Address_Controller.php';
        $c = new Address_Controller();
        $c->action_index();
        $views = View::getStack();
        if (!empty($views)) {
            foreach ($views as $fileName => $dat) {
                if (!empty($dat)) {
                    extract($dat);
                }
                require $fileName;
            }
        }
    }
    catch (Exception $e) {
        echo '<pre>';
        echo $e->getMessage();
        echo $e->getTraceAsString();
    }
    exit(0);
}

if (!isset($_GET[GET_METHOD])) {
    echo 'ページがみつかりませんでした';
    exit(0);
}

$controller = $_GET[GET_CONTROLLER] . SUFFIX_CONTROLLER;
$method = PREFIX_METHOD . $_GET[GET_METHOD];

try {

    $targetPath = CONTROLLER_PATH . $controller . '.php';
    if (!file_exists($targetPath)) {
        throw new RuntimeException($targetPath . 'ファイルが見つかりませんでした');
    }

    require_once $targetPath;

    if (!class_exists($controller)) {
        throw new RuntimeException('ページが見つかりませんでした');
    }

    $controllerObject = new $controller;

    if (!method_exists($controllerObject, $method)) {
        throw new RuntimeException('メソッドが見つかりませんでした');
    }

    $controllerObject->$method();

    $views = View::getStack();

    if (!empty($views)) {
        foreach ($views as $fileName => $dat) {
            if (!empty($dat)) extract($dat);
            require $fileName;
        }
    }

}
catch (Exception $e) {
    echo '<pre>';
    echo $e->getMessage();
    echo $e->getTraceAsString();
}