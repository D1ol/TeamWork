<?php


namespace App\Entity\Reports\ReadModel;


class ReportTask
{
    private $description;
    private $projectName;
    private $clientName;
    private $dateStart;
    private $dateStop;


    public function __construct(
        string $description,
        string $projectName,
        string $clientName,
        \DateTime $dateStart,
        \DateTime $dateStop
    )
    {
        $this->description = $description;
        $this->projectName = $projectName;
        $this->clientName = $clientName;
        $this->dateStart = $dateStart;
        $this->dateStop = $dateStop;
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
     * @return \DateTime
     */
    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateStop(): \DateTime
    {
        return $this->dateStop;
    }

    public function getTime(): string
    {
        $dateInterval = $this->getDateStop()->diff($this->getDateStart());
       return ($dateInterval->days)?$dateInterval->format('%dd %H:%I'):$dateInterval->format('%H:%I');
    }

}