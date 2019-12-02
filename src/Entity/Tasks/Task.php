<?php

namespace App\Entity\Tasks;

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
    private $idProjects;


    public function __construct(
        $description,
        $dateEnd,
        $idUser,
        $idProjects
    )
    {
        $this->description = $description;
        $this->dateStart = new \DateTime('now');
        $this->dateEnd = $dateEnd;
        $this->idUser = $idUser;
        $this->idProjects = $idProjects;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function getDateStart()
    {
        return $this->dateStart;
    }


    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function getIdProjects()
    {
        return $this->idProjects;
    }


}
