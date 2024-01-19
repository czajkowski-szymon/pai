<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Sport.php';

class SportRepository extends Repository {
    public function getSports(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.sport;'       
        );

        $statement->execute();
        $sports = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($sports as $sport) {
            $result[] = new Sport(
                $sport['sport_id'],
                $sport['name']
            );
        }

        return $result;
    }
}