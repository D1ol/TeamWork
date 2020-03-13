<?php


namespace App\Adapter\Users;
use App\Entity\Users\Users as UsersInterface;
use App\Entity\Users\User;
use Doctrine\Common\Persistence\ObjectManager;


final class Users implements UsersInterface
{
    private $manager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->manager = $objectManager;
    }

    public function add(User $user)
    {
        $this->manager->persist($user);
    }

    public function findOneByEmail(string $email)
    {
        return $this->manager->getRepository(User::class)->findOneBy([
            'email'=>$email
        ]);
    }
    public function findOneById(string $id)
    {
        return $this->manager->getRepository(User::class)->findOneBy(['id'=>$id]);
    }

    public function findAll()
    {
        return $this->manager->getRepository(User::class)->findAll();
    }
}