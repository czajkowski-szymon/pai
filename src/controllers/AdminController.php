<?php

require_once 'AppController.php';
require_once __DIR__.'/../repositories/UserRepository.php';

class AdminController extends AppController {

    private UserRepository $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function adminpanel() {
        return $this->render(
            'admin-panel',
            ['users' => $this->userRepository->getUsersForDiscover()]
        );
    }   

    public function deleteUser() {
        if (!$this->isPost()) {
            return $this->render('admin-panel');
        }

        $userId = $_POST['user_id'];

        $this->userRepository->deleteUser($userId);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/adminpanel");
    }
}