<?php


namespace App\Entity\Tasks\ReadModel;


class Tasks
{
    public $taskID;
    public $description;
    public $projectName;
    public $clientName;
    public $clientColor;
    public $dateStart;
    public $dateEnd;
    public $userID;


    public function __construct(
        string $taskID,
        string $description,
        string $projectName,
        string $clientName,
        string $clientColor,
        \DateTime $dateStart,
        \DateTime $dateEnd,

        string $userID
    )
    {
        $this->taskID = $taskID;
        $this->description = $description;
        $this->projectName = $projectName;
        $this->clientName = $clientName;
        $this->clientColor = $clientColor;
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->userID = $userID;
    }

    /**
     * @return string
     */
    public function getTaskID(): string
    {
        return $this->taskID;
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
    public function getProjectName(): string
    {
        return $this->projectName;
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


    /**
     * @return \DateTime
     */
    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnd(): \DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @return string
     */
    public function getTaskTime(): string
    {

        return ($this->getDateStart()->diff($this->getDateEnd()))->format("%H:%I:%S");
    }


    /**
     * @return string
     */
    public function getUserID(): string
    {
        return $this->userID;
    }


}