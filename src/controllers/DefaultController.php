<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/CityRepository.php';
require_once __DIR__.'/../repositories/SportRepository.php';
require_once __DIR__.'/../repositories/TrainingRepository.php';

class DefaultController extends AppController {
    private UserRepository $userRepository;
    private CityRepository $cityRepository;
    private SportRepository $sportRepository;
    private TrainingRepository $trainingRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->cityRepository = new CityRepository();
        $this->sportRepository = new SportRepository();
        $this->trainingRepository = new TrainingRepository();
    }

    public function index() {
        return $this->render('login');
    }

    public function discover() {
        return $this->render('discover', ['users' => $this->userRepository->getUsersForDiscover()]);
    }

    public function profile() {

        if (!isset($_COOKIE['username'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login"); 
        }

        return $this->render(
            'profile', [
                'cities' => $this->cityRepository->getCities(), 
                'sports' => $this->sportRepository->getSports(),
                'trainings' => $this->trainingRepository->getTrainingsForUser($_COOKIE['username']),
                'invitations' => $this->trainingRepository->getInvitationsForUser($_COOKIE['username'])
            ]
        );
    }
} 