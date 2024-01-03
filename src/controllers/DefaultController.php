<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';

class DefaultController extends AppController {
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function index() {
        $this->render('login');
    }
    
    public function home() {
        $this->render('home');
    }
    
    public function login() {
        if ($this->isGet()) {
            return $this->render('login');
        }
        die("FORM SEND");
    }
    
    public function register() {
        $this->render('register');
    }

    public function discover() {
        return $this->render(
            'discover',
            ['users' => $this->userRepository->getUsers()]
        );
    }
} 