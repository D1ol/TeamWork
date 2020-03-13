<?php


namespace App\Entity\Reports\ReadModel;


use App\Entity\Users\User;

interface ReportsQuery
{
    /**
     * @param User $user
     * @param int $month
     * @return ReportTask[]|null
     */
    public function getTaskDataByUserAndMonth(User $user, int $month);
}