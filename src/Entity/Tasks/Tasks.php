<?php


namespace App\Entity\Tasks;


use App\Entity\Users\User;

interface Tasks
{
    public function add(Task $task);

    /**
     * @param string $idUser
     * @return Task|null
     */
    public function findOneByUserAndDateEndNull(string $idUser);

    /**
     * @return int|null
     */
    public function findCountTasksToday();
}