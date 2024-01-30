<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Training.php';

class TrainingRepository extends Repository {

    private UserRepository $userRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function addTraining(Training $training) {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $connection->prepare(
                'INSERT INTO db.training (inviting_user_id, invited_user_id, date, is_accepted) VALUES (?, ?, ?, ?);'
            );
            $statement->execute([
                $training->getInvitingUser()->getUserId(), 
                $training->getInvitedUser()->getUserId(), 
                $training->getDate()->format('Y-m-d'),
                $training->isAccepted() ? 1 : 0
            ]);

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
            return null;
        }
    }

    public function getTrainingsForUser(string $email): array {
        $result = []; 

        $user = $this->userRepository->getUserByEmail($email);

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.training WHERE (inviting_user_id = :user_id OR invited_user_id = :user_id) AND is_accepted = true;'       
        );

        $userId = $user->getUserId();
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $trainings = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($trainings as $training) {
            $result[] = new Training(
                $this->userRepository->getUserById($training['inviting_user_id']),
                $this->userRepository->getUserById($training['invited_user_id']),
                new DateTime($training['date']),
                $training['is_accepted']
            );
        }

        return $result;
    }

    public function getInvitationsForUser(string $email): array {
        $result = []; 

        $user = $this->userRepository->getUserByEmail($email);

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.training WHERE (invited_user_id = :user_id AND is_accepted = false);'       
        );

        $userId = $user->getUserId();
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $trainings = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($trainings as $training) {
            $tempTraining = new Training(
                $this->userRepository->getUserById($training['inviting_user_id']),
                $this->userRepository->getUserById($training['invited_user_id']),
                new DateTime($training['date']),
                $training['is_accepted']
            );
            $tempTraining->setTrainingId( $training['training_id']);
            $result[] = $tempTraining; 
        }

        return $result;
    }

    public function getUserInvites(string $email): array {
        $result = []; 

        $user = $this->userRepository->getUserByEmail($email);

        $statement = $this->database->connect()->prepare(
            'SELECT * FROM db.training WHERE (inviting_user_id = :user_id AND is_accepted = false);'       
        );

        $userId = $user->getUserId();
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        $trainings = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($trainings as $training) {
            $tempTraining = new Training(
                $this->userRepository->getUserById($training['inviting_user_id']),
                $this->userRepository->getUserById($training['invited_user_id']),
                new DateTime($training['date']),
                $training['is_accepted']
            );
            $tempTraining->setTrainingId( $training['training_id']);
            $result[] = $tempTraining; 
        }

        return $result;
    }

    public function acceptTraining(int $trainingId) {
        $connection = $this->database->connect();
        try {
            $connection->beginTransaction();

            $statement = $connection->prepare(
                'UPDATE db.training SET is_accepted = true WHERE training_id = :training_id;'
            );
            $statement->execute([$trainingId]);

            $connection->commit();
        } catch (PDOException $e) {
            $connection->rollBack();
        }
    }

    public function deleteTraining(int $trainingId) {
        $statement = $this->database->connect()->prepare(
            'DELETE FROM db.training WHERE training_id = :training_id;'
        );

        $statement->bindParam(':training_id', $trainingId);
        $statement->execute();
    }
}