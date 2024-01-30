<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/City.php';

class CityRepository extends Repository {
    public function getCities(): array {
        $result = [];
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.city;'       
        );

        $statement->execute();
        $cities = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($cities as $city) {
            $result[] = new City(
                $city['city_id'],
                $city['name']
            );
        }

        return $result;
    }

    public function getCityById(int $cityId): City {
        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.city WHERE city_id = :city_id;'       
        );

        $statement->bindParam(':city_id', $cityId);
        $statement->execute();

        $city = $statement->fetch(PDO::FETCH_ASSOC);

        return new City($city['city_id'], $city['name']);
    }
}