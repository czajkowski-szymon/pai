<?php

require_once 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::post('login', 'SecurityController');
Routing::post('deleteUser', 'SecurityController');
Routing::get('', 'DefaultController');
Routing::get('home', 'DefaultController');
Routing::get('register', 'SecurityController');
Routing::get('discover', 'DefaultController');
Routing::get('profile', 'DefaultController');
Routing::get('adminpanel', 'DefaultController');

Routing::run($path);