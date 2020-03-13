<?php


namespace App\Adapter\Clients;


use App\Entity\Clients\Client;
use App\Entity\Clients\Clients as ClientsInteface;
use Doctrine\Common\Persistence\ObjectManager;

class Clients implements ClientsInteface
{
    private $manager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->manager = $objectManager;
    }

    public function add(Client $client)
    {
        $this->manager->persist($client);
    }

    public function findOneByName(string $name)
    {
        return $this->manager->getRepository('App:Clients\Client')->findOneBy(['name'=>$name]);
    }

    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return $this->manager->getRepository('App:Clients\Client')->findAll();
    }
}