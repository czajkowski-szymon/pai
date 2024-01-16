<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $message = [];
    private $userRepository;
    private $cityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->cityRepository = new CityRepository();
    }

    public function login() {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUserByUsername($username);

        if ($user->getUsername() !== $username) {
            return $this->render('login', ['messages' => ['User with this username not exist!']]);
        }

        $hashedPassword = $user->getPassword();
        if (!password_verify($password, $hashedPassword)) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        setcookie("username", $user->getUsername(), time() + 360, '/');

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/discover");
    }

    public function register() {
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
            );
            
            $city = $this->cityRepository->getCityById($_POST['city']);
            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT); 
            $user = new User(
                $_POST['username'], 
                $hashedPassword, 
                $_POST['first-name'], 
                $_FILES['file']['name'], 
                $_POST['bio'],
                $city
            );

            $this->userRepository->addUser($user);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }

        return $this->render(
            'register',
            ['cities' => $this->cityRepository->getCities()]
        );
    }

    public function deleteUser() {
        if (!$this->isPost()) {
            return $this->render('admin-panel');
        }

        $userId = $_POST['user_id'];

        $this->userRepository->deleteUser($userId);

        return $this->render(
            'admin-panel',
            ['users' => $this->userRepository->getUsersForDiscover()]
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