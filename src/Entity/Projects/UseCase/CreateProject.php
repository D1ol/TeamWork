<?php


namespace App\Entity\Projects\UseCase;


use App\Core\Transaction;
use App\Entity\Projects\Project;
use App\Entity\Projects\Projects;
use App\Entity\Projects\UseCase\CreateProject\Command;

class CreateProject
{
    private $projects;
    private $transaction;

    public function __construct(Projects $projects, Transaction $transaction)
    {
        $this->projects = $projects;
        $this->transaction = $transaction;
    }
    public function execute(Command $command)
    {
        $this->transaction->begin();

        $project = new Project(
            $command->getName(),
            $command->getDescription(),
            $command->getClient(),
            $command->getUsers()
        );
        $this->projects->add($project);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }
        $command->getResponder()->projectCreated($project);
    }

}