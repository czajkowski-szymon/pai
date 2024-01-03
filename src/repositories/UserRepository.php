<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {
    public function getUsers(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.users;'       
        );

        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $result[] = new User(
                $user['user_id'],
                $user['email'],
                $user['first_name'],
                $user['password'],
                $user['photo_url'],
                $user['bio'],
                $user['city']
            );
        }

        return $result;
    }
}