<?php


namespace App\Entity\Reports\UseCase\GenerateMonthReport;


use App\Entity\Users\User;

class Command
{
    private $user;
    private $month;

    public function __construct(
        User $user,
        int $month
    )
    {
        $this->user = $user;
        $this->month = $month;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }



}