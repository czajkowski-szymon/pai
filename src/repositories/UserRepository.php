<?php

use exceptions\UserNotFoundException;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';

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

        if (!$user) {
            throw new UserNotFoundException();
        }

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ u JOIN db.user_details ud ON u.user_id = ud.user_id WHERE u.user_id = :id;'
        );

        $userDetailsId = $user['user_id'];

        $statement->bindParam(':id', $userDetailsId, PDO::PARAM_INT);
        $statement->execute();

        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);

        $cityId = $userDetails['city_id'];

        $city = $this->cityRepository->getCityById($cityId);

        $retrievedUser = new User(
            $user['username'],
            $userDetails['first_name'],
            $userDetails['photo_url'],
            $userDetails['bio'],
            $city
        );
        $retrievedUser->setUserId($user['user_id']);
        $retrievedUser->setPassword($user['password']);

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
                db.city ON db.user_details.city_id = db.city.city_id
            LEFT JOIN
                db.user_sport ON db.user_.user_id = db.user_sport.user_id
            LEFT JOIN
                db.sport ON db.user_sport.sport_id = db.sport.sport_id;'       
        );

        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $retrievedUser = new User(
                $user['username'],
                $user['first_name'],
                $user['photo_url'],
                $user['bio'],
                $user['city_name']
            );
            $retrievedUser->setUserId($user['user_id']);
            $result[] = $retrievedUser;
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
                city.city_id,
                city.name as city_name,
                sport.sport_id,
				sport.name as sport_name
            FROM 
                db.user_
            JOIN 
                db.user_details ON db.user_.user_id = db.user_details.user_id
            JOIN 
                db.city ON db.user_details.city_id = db.city.city_id
            LEFT JOIN
                db.user_sport ON db.user_.user_id = db.user_sport.user_id
            LEFT JOIN
                db.sport ON db.user_sport.sport_id = db.sport.sport_id
            WHERE 
                db.user_.username != :username AND db.user_.role_id != 1;'       
        );
        
        $username = "";
        if (isset($_COOKIE['username'])) {
            $username  = $_COOKIE['username'];
        }

        $statement->bindParam(':username', $username);
        $statement->execute();
        $usersData = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usersData as $userData) {
            $userId = $userData['user_id'];
        
            if (!isset($result[$userId])) {
                $retrievedUser = new User(
                    $userData['username'],
                    $userData['first_name'],
                    $userData['photo_url'],
                    $userData['bio'],
                    new City($userData['city_id'], $userData['city_name'])
                );
                $retrievedUser->setUserId($userData['user_id']);
        
                // Dodaj sporty użytkownika do obiektu użytkownika
                if (!empty($userData['sport_id'])) {
                    $sport = new Sport($userData['sport_id'], $userData['sport_name']);
                    $retrievedUser->addSport($sport);
                }
        
                $result[$userId] = $retrievedUser;
            } else {
                // Dodaj sporty użytkownika do obiektu użytkownika
                if (!empty($userData['sport_id']) && !$result[$userId]->hasSport($userData['sport_id'])) {
                    $sport = new Sport($userData['sport_id'], $userData['sport_name']);
                    $result[$userId]->addSport($sport);
                }
            }
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

        $sportIds = $user->getSports();

        foreach ($sportIds as $sportId) {
            try {
                $connection->beginTransaction();
                
                $statement = $this->database->connect()->prepare('INSERT INTO db.user_sport (user_id, sport_id) VALUES (?, ?)');
                $statement->execute([$userId, $sportId]);
     
                $connection->commit();
            } catch(PDOException $e) {
                $connection->rollBack();
            }
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
            'DELETE FROM db.user_sport WHERE user_id = :user_id;'
        );
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

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

    public function isUserInDb(string $username): bool {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ WHERE username = :username;'       
        );

        $statement->bindParam(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        } else {
            return false;
        }
    }
}