<?php


namespace App\Entity\Projects\UseCase\CreateProject;


use App\Entity\Projects\Project;

interface Responder
{
    public function projectCreated(Project $project);
}