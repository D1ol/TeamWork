<?php


namespace App\Adapter\Reports\ReadModel;

use App\Entity\Reports\ReadModel\ReportsQuery as ReportsQueryInterface;
use App\Entity\Tasks\ReadModel\Tasks;

use App\Entity\Users\User;
use DateTime;
use Doctrine\DBAL\Connection;
use App\Entity\Reports\ReadModel\ReportTask;

class ReportsQuery implements ReportsQueryInterface
{
    private $connection;

    public function __construct(
        Connection $connection
    )
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function getTaskDataByUserAndMonth(User $user, int $month)
    {
        return $this->connection->project(
            'SELECT  t.description, p.name as projectName, cl.name as clientName, t.date_start, t.date_end FROM task as t
                    LEFT JOIN project as p on p.id = t.id_project 
                    LEFT JOIN client as cl on cl.id = p.id_client 
                    WHERE t.id_user = :userID
                    AND MONTH(date_start) = MONTH(:dateTime)
                    AND t.date_end IS NOT NULL
                    ORDER BY t.date_start ASC',
            [
                'userID' => $user->getId(),
                'dateTime' => DateTime::createFromFormat("n", $month)->format('Y-m-d')
            ],
            function (array $result) {
                return new ReportTask
                (
                    $result['description'],
                    $result['projectName'],
                    $result['clientName'],
                    new \DateTime($result['date_start']),
                    new \DateTime($result['date_end'])
                );
            }
        );
    }
}