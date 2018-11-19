<?php

namespace Framework;

trait PdoTrait
{
    private $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}