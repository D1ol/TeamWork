<?php


namespace App\Entity\Users;


interface Users
{
    public function add(User $user);
    public function findOneByEmail(string $email);
    public function findOneById(string $id);
    public function update(User $user);

}