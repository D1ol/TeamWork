<?php

namespace App\Entity\Users\ReadModel;

interface UsersQuery
{
    public function getAll(): array;
    public function getByID(string $userID): Users;
}
