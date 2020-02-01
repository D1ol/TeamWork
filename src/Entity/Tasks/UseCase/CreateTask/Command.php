<?php


namespace App\Entity\Tasks\UseCase\CreateTask;


use App\Entity\Projects\Project;
use App\Entity\Users\User;

class Command
{
    private $description;
    private $idUser;
    private $idProject;
    private $responder;

    public function __construct(
        ?string $description,
        User $idUser,
        string $idProject
    )
    {
        $this->description = $description;
        $this->idUser = $idUser;
        $this->idProject = $idProject;
        $this->responder = new NullResponder();
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->idUser;
    }

    /**
     * @return string
     */
    public function getIdProject(): string
    {
        return $this->idProject;
    }

    public function getResponder(): Responder
    {
        return $this->responder;
    }

    public function setResponder(Responder $responder)
    {
        $this->responder = $responder;

        return $this;
    }


}