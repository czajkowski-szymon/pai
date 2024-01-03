<?php

class User {
    private int $userId;
    private string $email;
    private string $firstName;
    private string $password;
    private string $photoUrl;
    private string $bio;
    private string $city;

    public function __construct(int $userId,
                                string $email,
                                string $firstName,
                                string $password,
                                string $photoUrl,
                                string $bio,
                                string $city) {
        $this->userId = $userId;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->password = $password;
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

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
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

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }


}