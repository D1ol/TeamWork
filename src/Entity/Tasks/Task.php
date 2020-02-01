<?php

namespace App\Entity\Tasks;

use App\Entity\Projects\Project;
use App\Entity\Users\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Tasks\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects\Project")
     * @ORM\JoinColumn(name="id_project", referencedColumnName="id", nullable=true)
     */
    private $idProject;


    public function __construct(
        string $description,
        User $idUser,
        Project $idProject,
        \DateTime $dateEnd = null
    )
    {
        $this->description = $description;
        $this->dateStart = new \DateTime('now');
        $this->idUser = $idUser;
        $this->idProject = $idProject;
        $this->dateEnd = $dateEnd;
    }

    public function stop(
        string $description,
        $idProject
    )
    {
        $this->description = $description;
        $this->idProject = $idProject;
        $this->dateEnd = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateStart(): ?\DateTime
    {
        return $this->dateStart;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateEnd(): ?\DateTime
    {
        return $this->dateEnd;
    }






    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->idUser;
    }

    /**
     * @return Project
     */
    public function getIdProject(): Project
    {
        return $this->idProject;
    }


}
