<?php

namespace App\Entity\Users\UseCase;

use App\Core\Transaction;
use App\Entity\Users\UseCase\CreateUser\Command;
use App\Entity\Users\User;
use App\Entity\Users\Users;

class CreateUser
{
    private $users;
    private $transaction;

    public function __construct(Users $users, Transaction $transaction)
    {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        if(!$this->checkUserExist($command))
            return ;


        $this->transaction->begin();

        $user = new User(
            $command->getName(),
            $command->getSurname(),
            $command->getEmail(),
            $command->getPassword(),
            ['ROLE_USER'],
            $command->getPhone(),
            true
        );

        $this->users->add($user);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->userCreated($user);
    }

    private function checkUserExist(Command $command)
    {
        $existingUser = $this->users->findOneByEmail($command->getEmail());

        if($existingUser)
        {
            $command->getResponder()->providedEmailIsInUse($command->getEmail());
            return false;
        }
        return true;
    }
}