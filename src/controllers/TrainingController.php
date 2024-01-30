<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/TrainingRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class TrainingController extends AppController {
    private TrainingRepository $trainingRepository;
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->trainingRepository = new TrainingRepository();
        $this->userRepository = new UserRepository();
    }

    public function arrangeTraining() {
        include(__DIR__.'/../utils/is-user-logged.php');
        if (!$this->isPost()) {
            include(__DIR__.'/../utils/redirect-to-discover.php');
        }
        
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            
            $invitingUserEmail = $_COOKIE['username'];
            $invitedUserId = $decoded['userId'];

            $invitingUser = $this->userRepository->getUserByEmail($invitingUserEmail);
            $invitedUser = $this->userRepository->getUserById($invitedUserId);

            $date = new DateTime($decoded['date']);
            $training = new Training($invitingUser, $invitedUser, $date, false);
            
            $this->trainingRepository->addTraining($training);
            http_response_code(200);
        }
    }

    public function acceptInvite() {
        if (!$this->isPost()) {
            include(__DIR__.'/../utils/redirect-to-discover.php');
        }

        $this->trainingRepository->acceptTraining($_POST['training-id']);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");
    }

    public function deleteInvite() {
        if (!$this->isPost()) {
            include(__DIR__.'/../utils/redirect-to-discover.php');
        }

        $this->trainingRepository->deleteTraining($_POST['training-id']);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/profile");
    }
}