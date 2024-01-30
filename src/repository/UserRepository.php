<?php

use exceptions\UserNotFoundException;

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Role.php';
require_once __DIR__.'/../exceptions/UserNotFoundException.php';

class UserRepository extends Repository {
    private CityRepository $cityRepository;
    private SportRepository $sportRepository;
    
    public function __construct() {
        parent::__construct();
        $this->cityRepository = new CityRepository();
        $this->sportRepository = new SportRepository();
    }

    public function getUserByEmail(string $email): User {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ WHERE email = :email;'       
        );

        $statement->bindParam(':email', $email);
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

        $statement = $this->database->connect()->prepare(
            'SELECT sport_id FROM db.user_sport WHERE user_id = :user_id'
        );

        $statement->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $statement->execute();

        $sportIds = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sportIds as $sportId) {
            $sports[] = $this->sportRepository->getSportById($sportId['sport_id']);
        } 

        $retrievedUser = new User(
            $user['email'],
            $userDetails['first_name'],
            $userDetails['photo_url'],
            $userDetails['bio'],
            $city
        );
        $retrievedUser->setUserId($user['user_id']);
        $retrievedUser->setPassword($user['password']);
        $retrievedUser->setSports($sports);
        $retrievedUser->setLikes($userDetails['likes']);
        $retrievedUser->setDislikes($userDetails['dislikes']);

        return $retrievedUser;
    }

    public function getUserById(int $userId): User {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ WHERE user_id = :user_id;'       
        );

        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT );
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

        $statement = $this->database->connect()->prepare(
            'SELECT sport_id FROM db.user_sport WHERE user_id = :user_id'
        );

        $statement->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
        $statement->execute();

        $sportIds = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sportIds as $sportId) {
            $sports[] = $this->sportRepository->getSportById($sportId['sport_id']);
        } 

        $retrievedUser = new User(
            $user['email'],
            $userDetails['first_name'],
            $userDetails['photo_url'],
            $userDetails['bio'],
            $city
        );
        $retrievedUser->setUserId($user['user_id']);
        $retrievedUser->setPassword($user['password']);
        $retrievedUser->setSports($sports);

        return $retrievedUser;
    }

    public function getUsersForDiscover(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT 
                user_.user_id,
                user_.email,
                user_details.first_name,
                user_details.photo_url,
                user_details.bio,
                user_details.likes,
                user_details.dislikes,
                city.city_id,
                city.name as city_name,
                STRING_AGG(sport.sport_id::TEXT, \', \') as sport_ids,
                STRING_AGG(sport.name::TEXT, \', \') as sport_names
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
                db.user_.email != :email AND db.user_.role_id != 1
            GROUP BY
                user_.user_id, user_.email, user_details.first_name, user_details.photo_url, user_details.bio, user_details.likes, user_details.dislikes, city.city_id, city.name'       
        );
        
        $email = "";
        if (isset($_COOKIE['username'])) {
            $email  = $_COOKIE['username'];
        }

        $statement->bindParam(':email', $email);
        $statement->execute();
        $usersData = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($usersData as $userData) {
            $sports = [];
            $sportIds = explode(', ', $userData['sport_ids']);
            $sportNames = explode(', ', $userData['sport_names']);
            $sportIdsNames = array_combine($sportIds, $sportNames);
            foreach($sportIdsNames as $sportId => $sportName) {
                $sports[] = new Sport($sportId, $sportName);
            }

            $user = new User(
                $userData['email'],
                $userData['first_name'],
                $userData['photo_url'],
                $userData['bio'],
                new City($userData['city_id'], $userData['city_name'])
            );
            $user->setUserId($userData['user_id']);
            $user->setSports($sports);
            $user->setLikes($userData['likes']);
            $user->setDislikes($userData['dislikes']);
            $result[] = $user;
        }

        return $result;
    }

    public function getUsersByCity(string $cityName): array {
        $cityName = '%' . strtolower($cityName) . '%';
        $statement = $this->database->connect()->prepare(
            'SELECT 
                user_.user_id,
                user_.email,
                user_details.first_name,
                user_details.photo_url,
                user_details.bio,
                user_details.likes,
                user_details.dislikes,
                city.city_id,
                city.name as city_name,
                STRING_AGG(sport.name::TEXT, \', \') as sport_names
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
                db.user_.email != :email AND db.user_.role_id != 1 AND LOWER(db.city.name) LIKE :city_name
            GROUP BY
                user_.user_id, user_.email, user_details.first_name, user_details.photo_url, user_details.bio, user_details.likes, user_details.dislikes, city.city_id, city.name;'       
        );

        $email = "";
        if (isset($_COOKIE['username'])) {
            $email  = $_COOKIE['username'];
        }

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':city_name', $cityName, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser(User $user): void {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $connection->prepare('INSERT INTO db.user_ (email, password) VALUES (?, ?);');
            $statement->execute([$user->getEmail(), $user->getPassword()]);

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
        }
        
        $userId = $this->getUserId($user->getEmail());

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

    public function getUserId(string $email): int {
        $statement = $this->database->connect()->prepare('SELECT user_.user_id FROM db.user_ WHERE email = :email');
        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return $user['user_id'];
    }

    public function deleteUser(int $userId): void {
        $statement = $this->database->connect()->prepare(
            'DELETE from db.rating where rating_user_id = :user_id OR rated_user_id = :user_id;'
        );
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        $statement = $this->database->connect()->prepare(
            'DELETE FROM db.user_ WHERE user_id = :user_id;'
        );
        $statement->bindParam(':user_id', $userId);
        $statement->execute();
    }

    public function getRole(): Role {
        $email = null; 
        if (isset($_COOKIE['username'])) {
            $email = $_COOKIE['username'];
        }

        $statement = $this->database->connect()->prepare(
            'SELECT user_.role_id FROM db.user_ JOIN db.role on user_.role_id = role.role_id WHERE email = :email;'
        );

        $statement->bindParam(":email", $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($user['role_id'] == 1) {
            return Role::ADMIN;
        } else {
            return Role::USER;
        }
    }

    public function isUserInDb(string $email): bool {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_ WHERE email = :email;'       
        );

        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function like(int $ratedUserId, int $ratingUserId) {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $this->database->connect()->prepare(
                "INSERT INTO db.rating (rated_user_id, rating_user_id, rating_type) VALUES (?, ?, 'like');"       
            );

            $statement->execute([
                $ratedUserId, $ratingUserId
            ]);

            $connection->commit();
        } catch(PDOException $e) {
            $connection->rollBack();
        }

        $statement = $this->database->connect()->prepare(
            "SELECT likes, dislikes FROM db.user_details WHERE user_id = :user_id;"       
        );

        $statement->bindParam(':user_id', $ratedUserId, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function dislike(int $ratedUserId, int $ratingUserId) {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $this->database->connect()->prepare(
                "INSERT INTO db.rating (rated_user_id, rating_user_id, rating_type) VALUES (?, ?, 'dislike');"       
            );
    
            $statement->execute([
                $ratedUserId, $ratingUserId
            ]);

            $connection->commit();
        } catch(PDOException $e) {
            $connection->rollBack();
        }

        $statement = $this->database->connect()->prepare(
            "SELECT likes, dislikes FROM db.user_details WHERE user_id = :user_id;"       
        );

        $statement->bindParam(':user_id', $ratedUserId, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}