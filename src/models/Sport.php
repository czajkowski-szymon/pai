<?php

class Sport {
    private int $sportId;
    private string $name;

    public function __construct(int $sportId, string $name) {
        $this->sportId = $sportId;
        $this->name = $name;
    }

    public function getSportId(): int {
        return $this->sportId;
    }

    public function setSportId(int $sportId): void {
        $this->sportId = $sportId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}