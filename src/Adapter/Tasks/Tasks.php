<?php


namespace App\Adapter\Tasks;

use App\Entity\Tasks\Task;
use App\Entity\Tasks\Tasks as TasksInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class Tasks implements TasksInterface
{
    private $manager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->manager = $objectManager;
    }

    public function add(Task $task)
    {
        $this->manager->persist($task);
    }

    public function findOneByUserAndDateEndNull(string $idUser)
    {
       return $this->manager->getRepository('App:Tasks\Task')->findOneBy(array('idUser' => $idUser, 'dateEnd' => null));
    }
}