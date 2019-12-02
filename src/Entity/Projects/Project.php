<?php

namespace App\Entity\Projects;

use App\Entity\Clients\Client;
use App\Entity\Users\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Projects\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients\Client")
     * @ORM\JoinColumn(name="id_client", referencedColumnName="id", onDelete="CASCADE")
     */
    private $idClient;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users\User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $idUsers;


    public function __construct(
        string $name,
        string $description,
        Client $idClient,
       ArrayCollection $idUsers
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->isActive = true;
        $this->idClient = $idClient;
        $this->idUsers = $idUsers;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function addIdUsers(User $idUsers)
    {
        if (!$this->idUsers->contains($idUsers)) {
            $this->idUsers[] = $idUsers;
        }

        return $this;
    }

    public function removeIdUsers(User $idUsers)
    {
        if ($this->idUsers->contains($idUsers)) {
            $this->idUsers->removeElement($idUsers);
        }

        return $this;
    }
}
