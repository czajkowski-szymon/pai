<?php

use exceptions\UserNotFoundException;

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repositories/SportRepository.php';
require_once __DIR__.'/../repositories/UserRepository.php';
require_once __DIR__.'/../repositories/CityRepository.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';

class SecurityController extends AppController {
    
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private UserRepository $userRepository;
    private CityRepository $cityRepository;
    private SportRepository $sportRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->cityRepository = new CityRepository();
        $this->sportRepository = new SportRepository();
    }

    public function login() {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (empty($username) || empty($password)) {
            return $this->render('login', ['messages' => ['Fill all fields']]);
        }

        try {
            $user = $this->userRepository->getUserByUsername($username);
        } catch(UserNotFoundException $e) {
            return $this->render('login', ['messages' => [$e->getMessage()]]);
        }

        $hashedPassword = $user->getPassword();
        if (!password_verify($password, $hashedPassword)) {
            return $this->render('login', ['messages' => ['Wrong password']]);
        }

        setcookie("username", $user->getUsername(), time() + 360, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/discover");
    }

    public function register() {    
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            if ($this->userRepository->isUserInDb(trim($_POST['username']))) {
                return $this->render(
                    'register',
                    [
                        'cities' => $this->cityRepository->getCities(), 
                        'sports' => $this->sportRepository->getSports(),
                        'messages' => ['Username is taken']
                    ]
                );
            }

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );
            
        
            $city = $this->cityRepository->getCityById($_POST['city']);
            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); 
            $user = new User(
                trim($_POST['username']), 
                $_POST['first-name'], 
                $_FILES['file']['name'], 
                $_POST['bio'],
                $city
            );
            $user->setPassword($hashedPassword);
            $user->setSports($_POST['sports']);

            $this->userRepository->addUser($user);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }

        return $this->render(
            'register',
            ['cities' => $this->cityRepository->getCities(), 'sports' => $this->sportRepository->getSports()]
        );
    }

    private function validate(array $file): bool {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}