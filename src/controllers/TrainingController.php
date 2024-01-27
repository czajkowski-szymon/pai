<?php

require_once 'AppController.php';
require_once __DIR__.'/../repositories/TrainingRepository.php';
require_once __DIR__.'/../repositories/UserRepository.php';

class TrainingController extends AppController {
    private TrainingRepository $trainingRepository;
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->trainingRepository = new TrainingRepository();
        $this->userRepository = new UserRepository();
    }

    public function arrangeTraining() {
        if (!$this->isPost()) {
            return $this->render('dicover');
        }

        $invitedUserId = $_POST['user-id'];
        $invitingUserUsername = $_COOKIE['username'];
        
        $invitingUser = $this->userRepository->getUserByUsername($invitingUserUsername);
        $invitedUser = $this->userRepository->getUserById($invitedUserId);

        $date = new DateTime($_POST['training-date']);
        $training = new Training($invitingUser, $invitedUser, $date, false);

        $this->trainingRepository->addTraining($training);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/discover");
    }

    public function acceptInvite() {
        // if (!$this->isPost()) {
        //     return $this->render('dicover');
        // }
        
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->trainingRepository->acceptTraining($decoded['id']));
        }

        // $this->trainingRepository->acceptTraining($_POST['training-id']);

        // $url = "http://$_SERVER[HTTP_HOST]";
        // header("Location: {$url}/profile");
    }
}