<?php


namespace App\Adapter\Clients\ReadModel;


use Doctrine\DBAL\Connection;
use App\Entity\Clients\ReadModel\Clients;
use App\Entity\Clients\ReadModel\ClientsQuery as ClientsQueryInterface;

class ClientsQuery implements ClientsQueryInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }


    public function getAll(): array
    {
        return $this->connection->project(
            'SELECT 
                    c.id, c.name, c.color, c.photo
                    FROM client as c',
            [],
            function (array $result) {
                return new Clients(
                    $result['id'],
                    $result['name'],
                    $result['color'],
                    $result['photo']

                );
            }
        );
    }

}