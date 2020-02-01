<?php


namespace App\Entity\Tasks\ReadModel;


interface TasksQuery
{
    public function getAllCompletedTasksByUserID(string $userID);
}