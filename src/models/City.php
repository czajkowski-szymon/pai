<?php

class City {
    private int $cityId;
    private string $name;

    public function __construct(int $cityId, string $name) {
        $this->cityId = $cityId;
        $this->name = $name;
    }

    public function getcityId(): int {
        return $this->cityId;
    }

    public function setcityId(int $cityId): void {
        $this->cityId = $cityId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}