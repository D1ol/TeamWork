<?php


namespace App\Entity\Clients\UseCase;



use App\Core\Transaction;
use App\Entity\Clients\Client;
use App\Entity\Clients\Clients;
use App\Entity\Clients\UseCase\CreateClient\Command;

class CreateClient
{
    private $clients;
    private $transaction;

    public function __construct(Clients $clients, Transaction $transaction)
    {
        $this->clients = $clients;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $existingClient = $this->clients->findOneByName($command->getName());



        if($existingClient)
        {
            $this->transaction->rollback();
            $command->getResponder()->clientExist($command->getName());
            return;
        }

        $client = new Client(
            $command->getName(),
            $command->getColor()
        );

        if($command->getPhotoClient())
        {
            $client->setPhoto($command->getPhotoClient()->move($command->getName()));
        }

        $this->clients->add($client);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->clientCreated($client);
    }
}