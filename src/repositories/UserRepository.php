<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserDAO.php';

class UserRepository extends Repository {
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

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.user_details ud JOIN db.city c ON ud.city_id = c.city_id WHERE ud.city_id = :id;'
        );

        $cityId = $userDetails['city_id'];

        $statement->bindParam(':id', $cityId, PDO::PARAM_INT);
        $statement->execute();

        $city = $statement->fetch(PDO::FETCH_ASSOC);

        return new User(
            $user['user_id'],
            $user['username'],
            $user['password'],
            $userDetails['first_name'],
            $userDetails['photo_url'],
            $userDetails['bio'],
            $city['name']
        );
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
}