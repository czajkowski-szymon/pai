<?php

class User {
    private int $userId;
    private string $username;
    private string $password;
    private string $firstName;
    private string $photoUrl;
    private string $bio;
    private City $city;
    private array $sports;

    public function __construct(string $username,
                                string $firstName,
                                string $photoUrl,
                                string $bio,
                                City $city) {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->photoUrl = $photoUrl;
        $this->bio = $bio;
        $this->city = $city;
    }

    public function getUserId(): int {
        return $this->userId;
    } 

    public function setUserId(int $userId): void {
        $this->userId = $userId;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void {
        $this->firstName = $firstName;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getPhotoUrl(): string {
        return $this->photoUrl;
    }

    public function setPhotoUrl(string $photoUrl): void {
        $this->photoUrl = $photoUrl;
    }

    public function getBio(): string {
        return $this->bio;
    }

    public function setBio(string $bio): void {
        $this->bio = $bio;
    }

    public function getCity(): City {
        return $this->city;
    }

    public function setCity(City $city): void {
        $this->city = $city;
    }

    public function getSports(): array {
        return $this->sports;
    }

    public function setSports(array $sports): void {
        $this->sports = $sports;
    }

    public function addSport(Sport $sport): void {
        $this->sports[] = $sport;
    }

    public function hasSport(int $sportId): bool {
        foreach ($this->sports as $sport) {
            if ($sport->getSportId() === $sportId) {
                return true;
            }
        }
        return false;
    }
}