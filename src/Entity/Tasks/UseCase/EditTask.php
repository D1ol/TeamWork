<?php


namespace App\Entity\Tasks\UseCase;


use App\Core\Transaction;
use App\Entity\Projects\Projects;
use App\Entity\Tasks\Task;
use App\Entity\Tasks\Tasks;
use App\Entity\Tasks\UseCase\EditTask\Command;

class EditTask
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
        if (!$project) {
            $command->getResponder()->projectDoesNotExist();
            return;
        }

        /** @var Task $currentTask */
        $currentTask = $this->tasks->findOneByUserAndDateEndNull($command->getIdUser()->getId());

        if (!$currentTask) {
            $command->getResponder()->taskDoesNotExist();
            return;
        }

        $this->transaction->begin();

        $currentTask->stop(
            $command->getDescription(),
            $project
        );

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->taskEdited($currentTask);

    }
}