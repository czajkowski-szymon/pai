<?php

class Training {
    private int $trainingId;
    private User $invitingUser;
    private User $invitedUser;
    private DateTime $date;
    private bool $isAccepted;

    public function __construct(User $invitingUser, User $invitedUser, DateTime $date, bool $isAccepted) {
        $this->invitingUser = $invitingUser;
        $this->invitedUser = $invitedUser;
        $this->date = $date;
        $this->isAccepted = $isAccepted; 
    }

    public function getTrainingId() {
        return $this->trainingId;
    }

    public function setTrainingId(int $trainingId) {
        $this->trainingId = $trainingId;
    }
    
    public function getInvitingUser() {
        return $this->invitingUser;
    }

    public function setInvitingUser(User $invitingUser) {
        $this->invitingUser = $invitingUser;
    }
    
    public function getInvitedUser() {
        return $this->invitedUser;
    }

    public function setInvitedUser(User $invitedUser) {
        $this->invitedUser = $invitedUser;
    }
    
    public function getDate() {
        return $this->date;
    }

    public function setDate(DateTime $date) {
        $this->date = $date;
    }

    public function isAccepted(): bool {
        return $this->isAccepted;
    }

    public function setIsAccepted(bool $isAccepted): void {
        $this->isAccepted = $isAccepted;
    }
}