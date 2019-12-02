<?php


namespace App\Entity\Projects\UseCase\CreateProject;


use App\Entity\Clients\Client;
use Doctrine\Common\Collections\ArrayCollection;

class Command
{
    private $name;
    private $description;
    private $client;
    private $users;
    private $responder;

    public function __construct(
        string $name,
        string $description,
        Client $client,
        ArrayCollection $users
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->client = $client;
        $this->users = $users;
        $this->responder = new NullResponder();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
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