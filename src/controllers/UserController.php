<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';

class UserController extends AppController {
    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function search() {
        include(__DIR__.'/../../views/is-user-logged.php');
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->userRepository->getUsersByCity($decoded['city']));
        }
    }

    public function like(int $userId) {
        include(__DIR__.'/../../views/is-user-logged.php');
        $ratingUserId = $this->userRepository->getUserByEmail($_COOKIE['username'])->getUserId();
        http_response_code(200);
        echo json_encode($this->userRepository->like($userId, $ratingUserId));
    }

    public function dislike(int $userId) {
        include(__DIR__.'/../../views/is-user-logged.php');
        $ratingUserId = $this->userRepository->getUserByEmail($_COOKIE['username'])->getUserId();
        http_response_code(200);
        echo json_encode($this->userRepository->dislike($userId, $ratingUserId));
    }
}