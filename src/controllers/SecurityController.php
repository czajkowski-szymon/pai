<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {
    public function login() {

        $userRepository = new UserRepository(); 

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $userRepository->getUserByUsername($username);

        if ($user->getUsername() !== $username) {
            return $this->render('login', ['messages' => ['User with this username not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/discover");
    }

    public function register() {

    }
}