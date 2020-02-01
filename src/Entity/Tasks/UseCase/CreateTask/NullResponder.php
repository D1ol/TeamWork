<?php


namespace App\Entity\Tasks\UseCase\CreateTask;


use App\Entity\Tasks\Task;

class NullResponder implements Responder
{

    public function taskCreated(Task $task){}

    public function projectDoesNotExist(){}
}