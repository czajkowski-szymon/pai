<?php

require_once 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('login', 'SecurityController');
Routing::get('register', 'SecurityController');
Routing::get('discover', 'DefaultController');
Routing::get('profile', 'DefaultController');
Routing::get('adminpanel', 'AdminController');
Routing::get('like', 'UserController');
Routing::get('dislike', 'UserController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::post('arrangeTraining', 'TrainingController');
Routing::post('acceptInvite', 'TrainingController');
Routing::post('deleteInvite', 'TrainingController');
Routing::post('search', 'UserController');
Routing::post('deleteUser', 'AdminController');

Routing::run($path);