<?php


namespace App\Entity\Tasks\UseCase\EditTask;


use App\Entity\Tasks\Task;

class NullResponder implements Responder
{

    public function taskEdited(Task $task){}

    public function projectDoesNotExist(){}

    public function taskDoesNotExist(){}
}