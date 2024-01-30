<?php

use exceptions\UserNotFoundException;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/CityRepository.php';
require_once __DIR__.'/../repository/SportRepository.php';
require_once __DIR__.'/../repository/TrainingRepository.php';

class DefaultController extends AppController {
    private UserRepository $userRepository;
    private TrainingRepository $trainingRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->trainingRepository = new TrainingRepository();
    }

    public function index() {
        return $this->render('login');
    }

    public function discover() {
        if (!isset($_COOKIE['username'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login"); 
        }

        return $this->render(
            'discover', [
                'users' => $this->userRepository->getUsersForDiscover(),
                'roleId' => $this->userRepository->getRole()
            ]
        );
    }

    public function profile() {
        if (!isset($_COOKIE['username'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login"); 
        }

        $email = $_COOKIE['username'];

        return $this->render(
            'profile', [
                'user' => $this->userRepository->getUserByEmail($email),
                'roleId' => $this->userRepository->getRole(),
                'trainings' => $this->trainingRepository->getTrainingsForUser($email),
                'invitations' => $this->trainingRepository->getInvitationsForUser($email),
                'invites' => $this->trainingRepository->getUserInvites($email)
            ]
        );
    }
} 