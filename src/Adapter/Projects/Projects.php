<?php


namespace App\Adapter\Projects;

use App\Entity\Projects\Project;
use App\Entity\Projects\Projects as ProjectsInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class Projects implements ProjectsInterface
{
    private $manager;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->manager = $objectManager;
    }

    public function add(Project $project)
    {
       $this->manager->persist($project);
    }

    public function findOneByName(string $name)
    {
        return $this->manager->getRepository('App:Projects\Project')->findOneBy(['name'=>$name]);
    }
    public function findOneByProjectID(string $projectID)
    {
        return $this->manager->getRepository('App:Projects\Project')->findOneBy(['id'=>$projectID]);
    }
}