<?php


namespace App\Adapter\Projects;

use App\Entity\Projects\Project;
use App\Entity\Projects\Projects as ProjectsInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Projects implements ProjectsInterface
{
    private $manager;

    public function __construct(ObjectManager $objectManager)
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

    /**
     * @inheritDoc
     */
    public function findAll()
    {
       return $this->manager->getRepository(Project::class)->findAll();
    }
}