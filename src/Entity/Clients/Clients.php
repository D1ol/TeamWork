<?php


namespace App\Entity\Clients;


interface Clients
{
    public function add(Client $client);
    public function findOneByName(string $name);

}