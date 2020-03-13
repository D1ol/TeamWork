<?php


namespace App\Entity\Users;


interface Users
{
    public function add(User $user);

    /**
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email);

    /**
     * @param string $id
     * @return User|null
     */
    public function findOneById(string $id);

    /**
     * @return User[]|array
     */
    public function findAll();

}