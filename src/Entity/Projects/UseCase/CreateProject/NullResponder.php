<?php


namespace App\Entity\Projects\UseCase\CreateProject;


use App\Entity\Projects\Project;

class NullResponder implements Responder
{

    public function projectCreated(Project $project)
    {
        // TODO: Implement projectCreated() method.
    }
}