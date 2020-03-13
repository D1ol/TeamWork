<?php


namespace App\Entity\Clients;


interface Clients
{
    public function add(Client $client);

    /**
     * @param string $name
     * @return Client|null
     */
    public function findOneByName(string $name);

    /**
     * @return Client[]|array
     */
    public function findAll();

}