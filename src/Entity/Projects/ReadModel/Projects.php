<?php


namespace App\Entity\Projects\ReadModel;


use App\Entity\Clients\Client;

class Projects
{
    private $id;
    private $name;
    private $description;
    private $isActive;
    private $clientName;
    private $clientColor;


    public function __construct(
       string $id,
       string $name,
       string $description,
       string $isActive,
       string $clientName,
       string $clientColor
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->isActive = $isActive;
        $this->clientName = $clientName;
        $this->clientColor = $clientColor;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * @return string
     */
    public function getIsActive(): string
    {
        return $this->isActive;
    }

    /**
     * @return string
     */
    public function getClientName(): string
    {
        return $this->clientName;
    }

    /**
     * @return string
     */
    public function getClientColor(): string
    {
        return $this->clientColor;
    }



}