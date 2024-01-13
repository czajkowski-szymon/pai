<?php

class UserDAO {
    private int $userId;
    private string $username;
    private string $firstName;
    private string $photoUrl;
    private string $bio;
    private string $city;

    public function __construct(int $userId,
                                string $username,
                                string $firstName,
                                string $photoUrl,
                                string $bio,
                                string $city) {
        $this->userId = $userId;
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

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }


}