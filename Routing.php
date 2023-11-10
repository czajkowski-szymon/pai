<?php

require_once 'src/controllers/DefaultController.php';

class Router {
    public static $routes;

    public static function run($path) {
        $action = explode("/", $path)[0];
        var_dump($action);

    }
}