<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/CityRepository.php';

class DefaultController extends AppController {
    private UserRepository $userRepository;
    private CityRepository $cityRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->cityRepository = new CityRepository();
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

    public function create() {
        $this->render('create');
    }

    public function discover() {
        return $this->render(
            'discover',
            ['users' => $this->userRepository->getUsersForDiscover()]
        );
    }

    public function profile() {
        return $this->render('profile');
    }
} 