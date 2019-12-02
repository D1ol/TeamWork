<?php


namespace App\Entity\Projects;




interface Projects
{
    public function add(Project $project);
    public function findOneByName(string $name);

}