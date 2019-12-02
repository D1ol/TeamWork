<?php


namespace App\Adapter\Core;

use App\Core\Transaction as TransactionInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

final class Transaction implements TransactionInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function begin()
    {
        $this->entityManager->beginTransaction();
    }

    public function commit()
    {
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function rollback()
    {
        $this->entityManager->rollback();
    }
}