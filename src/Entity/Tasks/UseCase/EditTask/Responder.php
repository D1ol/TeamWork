<?php


namespace App\Entity\Tasks\UseCase\EditTask;


use App\Entity\Tasks\Task;

interface Responder
{
    public function taskEdited(Task $task);
    public function projectDoesNotExist();
    public function taskDoesNotExist();
}