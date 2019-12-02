<?php


namespace App\Entity\Clients\UseCase\CreateClient;


use App\Entity\Clients\Client;

class NullResponder implements Responder
{

    public function clientCreated(Client $user)
    {
        // TODO: Implement clientCreated() method.
    }

    public function clientExist(string $name)
    {
        // TODO: Implement clientExist() method.
    }
}