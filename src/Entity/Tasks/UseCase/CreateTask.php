<?php


namespace App\Entity\Tasks\UseCase;


use App\Core\Transaction;
use App\Entity\Tasks\Task;
use App\Entity\Tasks\Tasks;
use App\Entity\Tasks\UseCase\CreateTask\Command;

class CreateTask
{
    private $tasks;
    private $transaction;

    public function __construct(Tasks $tasks, Transaction $transaction)
    {
        $this->tasks = $tasks;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $task = new Task(
            $command->getDescription(),
            null,
            $command->getIdUser(),
            $command->getIdProject()
        );

        $this->tasks->add($task);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->taskCreated($task);

    }
}