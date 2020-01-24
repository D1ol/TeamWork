<?php


namespace App\Entity\Tasks\UseCase;


use App\Core\Transaction;
use App\Entity\Projects\Projects;
use App\Entity\Tasks\Task;
use App\Entity\Tasks\Tasks;
use App\Entity\Tasks\UseCase\CreateTask\Command;

class CreateTask
{
    private $tasks;
    private $projects;
    private $transaction;

    public function __construct(
        Tasks $tasks,
        Projects $projects,
        Transaction $transaction
    )
    {
        $this->tasks = $tasks;
        $this->projects = $projects;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $project = $this->projects->findOneByProjectID($command->getIdProject());
        if(!$project)
        {
            $command->getResponder()->projectDoesNotExist();
            return ;
        }

        $this->transaction->begin();

        $task = new Task(
            $command->getDescription(),
            $command->getIdUser(),
            $project
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