<?php


namespace Model\Repository;

use Model\Entity\Feedback;

class FeedbackRepository
{
    private $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    public function save(Feedback $feedback)
    {

        $sth = $this->pdo->prepare('insert into feedback (name, email, message) values(:name, :email, :message)');

        $sth->execute([

            'name' => $feedback->getName(),
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage(),

        ]);

    }
}