<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AdminController.php';
require_once 'src/controllers/TrainingController.php';
require_once 'src/controllers/UserController.php';
require_once 'src/controllers/ErrorController.php';

class Routing {
    public static $routes;

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];
        
        if (!array_key_exists($action, self::$routes)) {
            $errorController = new ErrorController();
            $errorController->pageNotFound();
            return;
        }

        $controller = self::$routes[$action];
        $obj = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        $obj->$action($id);
    }
}