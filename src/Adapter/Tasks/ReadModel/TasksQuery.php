<?php


namespace App\Adapter\Tasks\ReadModel;


use Doctrine\DBAL\Connection;
use App\Entity\Tasks\ReadModel\Tasks;
use App\Entity\Tasks\ReadModel\TasksQuery as TasksQueryInterface;

class TasksQuery implements TasksQueryInterface
{

    public $connection;


    public function __construct(
        Connection $connection
    )
    {
        $this->connection = $connection;
    }


    public function getAllCompletedTasksByUserID(string $userID)
    {
        return $this->connection->project(
            'SELECT t.id as taskID, t.description, p.name as projectName, c.name as clientName, c.color as clientColor, t.date_start, t.date_end, t.id_user FROM task as t
                    LEFT JOIN project as p on p.id = t.id_project 
                    LEFT JOIN client as c on c.id = p.id_client 
                    WHERE t.id_user = :userID
                    AND t.date_end IS NOT NULL',
            [
                'userID' => $userID
            ],
            function (array $result) {
                return new Tasks
                (
                    $result['taskID'],
                    $result['description'],
                    $result['projectName'],
                    $result['clientName'],
                    $result['clientColor'],
                    new \DateTime($result['date_start']),
                    new \DateTime($result['date_end']),
                    $result['id_user']
                );
            }
        );
    }
}