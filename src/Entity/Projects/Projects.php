<?php


namespace App\Entity\Projects;




interface Projects
{
    public function add(Project $project);

    /**
     * @param string $name
     * @return Project|null
     */
    public function findOneByName(string $name);

    /**
     * @param string $projectID
     * @return Project|null
     */
    public function findOneByProjectID(string $projectID);

    /**
     * @return Project[]
     */
    public function findAll();
}