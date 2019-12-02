<?php


namespace App\Adapter\Projects\ReadModel;

use App\Entity\Projects\ReadModel\Projects;
use App\Entity\Projects\ReadModel\ProjectsQuery as ProjectsQueryInterface;
use Doctrine\DBAL\Connection;

class ProjectsQuery implements ProjectsQueryInterface
{

    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public function getAll(): array
    {
        return $this->connection->project(
            'SELECT p.id, p.name, p.description, p.is_active, c.name as clientName, c.color as clientColor FROM project as p
                    LEFT JOIN client as c ON c.id = p.id_client',
            [],
            function (array $result) {
                return new Projects(
                    $result['id'],
                    $result['name'],
                    $result['description'],
                    $result['is_active'],
                    $result['clientName'],
                    $result['clientColor']

                );
            }
        );
    }
}