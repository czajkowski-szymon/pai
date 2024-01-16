<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserDAO.php';

class UserRepository extends Repository {
    private $cityRepository;
    
    public function __construct() {
        parent::__construct();
        $this->cityRepository = new CityRepository();
    }

    public function getUserByUsername(string $username): User {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ WHERE username = :username;'       
        );

        $statement->bindParam(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ u JOIN db.user_details ud ON u.user_id = ud.user_id WHERE u.user_id = :id;'
        );

        $userDetailsId = $user['user_id'];

        $statement->bindParam(':id', $userDetailsId, PDO::PARAM_INT);
        $statement->execute();

        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);

        // $statement = $this->database->connect()->prepare(
        //     'SELECT * FROM db.user_details ud JOIN db.city c ON ud.city_id = c.city_id WHERE ud.city_id = :id;'
        // );

        $cityId = $userDetails['city_id'];

        // $statement->bindParam(':id', $cityId, PDO::PARAM_INT);
        // $statement->execute();

        // $city = $statement->fetch(PDO::FETCH_ASSOC);
        $city = $this->cityRepository->getCityById($cityId); 

        $retrievedUser = new User(
            $user['username'],
            $user['password'],
            $userDetails['first_name'],
            $userDetails['photo_url'],
            $userDetails['bio'],
            $city
        );
        $retrievedUser->setUserId($user['user_id']);

        return $retrievedUser;
    }

    public function getUsers(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT 
                user_.user_id,
                user_.username,
                user_details.first_name,
                user_details.photo_url,
                user_details.bio,
                city.name as city_name
            FROM 
                db.user_
            JOIN 
                db.user_details ON db.user_.user_id = db.user_details.user_id
            JOIN 
                db.city ON db.user_details.city_id = db.city.city_id;'       
        );

        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $result[] = new UserDAO(
                $user['user_id'],
                $user['username'],
                $user['first_name'],
                $user['photo_url'],
                $user['bio'],
                $user['city_name']
            );
        }

        return $result;
    }

    public function getUsersForDiscover(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT 
                user_.user_id,
                user_.username,
                user_details.first_name,
                user_details.photo_url,
                user_details.bio,
                city.name as city_name
            FROM 
                db.user_
            JOIN 
                db.user_details ON db.user_.user_id = db.user_details.user_id
            JOIN 
                db.city ON db.user_details.city_id = db.city.city_id
            WHERE 
                db.user_.username != :username;'       
        );
        
        $username = "";
        if (isset($_COOKIE['username'])) {
            $username  = $_COOKIE['username'];
        }

        $statement->bindParam(':username', $username);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $result[] = new UserDAO(
                $user['user_id'],
                $user['username'],
                $user['first_name'],
                $user['photo_url'],
                $user['bio'],
                $user['city_name']
            );
        }

        return $result;
    }

    public function addUser(User $user) {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $connection->prepare('INSERT INTO db.user_ (username, password) VALUES (?, ?);');
            $statement->execute([$user->getUsername(), $user->getPassword()]);

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            return null;
        }
        
        $userId = $this->getUserId($user->getUsername());

        try {
            $connection->beginTransaction();

            $statement = $connection->prepare(
                'INSERT INTO db.user_details (first_name, photo_url, bio, city_id, user_id) VALUES (?, ?, ?, ?, ?);'
            );
            $statement->execute([
                $user->getFirstName(), 
                $user->getPhotoUrl(), 
                $user->getBio(), 
                $user->getCity()->getcityId(), 
                $userId
            ]);

            $connection->commit();
        } catch(PDOException $e) {
            $connection->rollBack();
        }
    }

    public function getUserId(string $username) {
        $statement = $this->database->connect()->prepare('SELECT * FROM db.user_ WHERE username = :username');
        $statement->bindParam(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['user_id'];
    }

    public function deleteUser(int $userId) {
        $statement = $this->database->connect()->prepare(
            'DELETE FROM db.user_details WHERE user_id = :user_id;'
        );
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        $statement = $this->database->connect()->prepare(
            'DELETE FROM db.user_ WHERE user_id = :user_id;'
        );
        $statement->bindParam(':user_id', $userId);
        $statement->execute();
    }

    public function getRole() {
        $username = null; 
        if (isset($_COOKIE['username'])) {
            $username = $_COOKIE['username'];
        }

        $statement = $this->database->connect()->prepare(
            'SELECT user_.role_id FROM db.user_ JOIN db.role on user_.role_id = role.role_id WHERE username = :username;'
        );

        $statement->bindParam(":username", $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['role_id'];
    }
}