<?php


namespace App\Entity\Tasks;


interface Tasks
{
    public function add(Task $task);
    public function findOneByUserAndDateStartNull(string $idUser);
}