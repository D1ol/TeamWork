<?php


namespace App\Adapter\Users\ReadModel;
use App\Entity\Users\ReadModel\Users;
use App\Entity\Users\ReadModel\UsersQuery as UsersQueryInterface;
use Doctrine\DBAL\Connection;
use LogicException;

class UsersQuery implements UsersQueryInterface
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        return $this->connection->project(
            'SELECT * FROM user',
            [],
            function (array $result){
                return new Users(
                    (string)$result['id'],
                    (string)$result['name'],
                    (string)$result['surname'],
                    (string)$result['email'],
                    (string)$result['phone'],
                    (bool)$result['is_active'],
                    (string)$result['token'],
                    unserialize($result['roles']),
                    $result['color_side_bar'],
                    $result['photo']
                );
            }
        );
    }

    public function getByID(string $userID): Users
    {
        $users = $this->connection->project(
            'SELECT *
                    FROM user as u
                    WHERE u.id = :id',
            [
                'id' => $userID
            ],
            function (array $result) {
                return new Users(
                    (string)$result['id'],
                    (string)$result['name'],
                    (string)$result['surname'],
                    (string)$result['email'],
                    (string)$result['phone'],
                    (bool)$result['is_active'],
                    (string)$result['token'],
                    $result['roles'],
                    $result['color_side_bar'],
                    $result['photo']
                );
            }
        );

        if (!$users) {
            throw new LogicException('User not found');
        }

        return reset($users);
    }
}