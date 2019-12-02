<?php


namespace App\Adapter\Tasks;

use App\Entity\Tasks\Task;
use App\Entity\Tasks\Tasks as TasksInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Tasks implements TasksInterface
{
    private $manager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->manager = $objectManager;
    }

    public function add(Task $task)
    {
        $this->manager->persist($task);
    }

    public function findOneByUserAndDateStartNull(string $idUser)
    {
       return $this->manager->getRepository('App:Tasks\Task')->findOneBy(array('idUser' => $idUser, 'dateStart' => null));
    }
}