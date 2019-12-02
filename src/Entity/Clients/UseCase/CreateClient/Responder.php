<?php


namespace App\Entity\Clients\UseCase\CreateClient;


use App\Entity\Clients\Client;

interface Responder
{
    public function clientCreated(Client $client);
    public function clientExist(string $name);

}