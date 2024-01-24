<?php

require_once 'AppController.php';
require_once __DIR__.'/../repositories/UserRepository.php';

class TrainingController extends AppController {
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->trainingRepository = new TrainingRepository();
        $this->userRepository = new UserRepository();
    }

    public function search() {
        
    }
}