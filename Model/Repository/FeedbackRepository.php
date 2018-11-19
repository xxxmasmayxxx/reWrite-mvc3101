<?php


namespace Model\Repository;

use Framework\PdoTrait;
use Model\Entity\Feedback;

class FeedbackRepository
{
   use PdoTrait;

    public function save(Feedback $feedback)
    {

        $sth = $this->pdo->prepare('insert into feedback (name, email, message) values (:name, :email, :message)');

        $sth->execute([

            'name' => $feedback->getName(),
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage(),

        ]);

    }
}