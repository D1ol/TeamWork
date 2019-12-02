<?php


namespace App\Entity\Users\UseCase;


use App\Core\Transaction;
use App\Entity\Users\UseCase\EditUser\Command;
use App\Entity\Users\User;
use App\Entity\Users\Users;

class EditUser
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
        $this->transaction->begin();

        $existingUser = $this->users->findOneById($command->getId());

        if(!$existingUser)
        {
            $this->transaction->rollback();
            return;
        }

        $existingUser->edit(
            $command->getName(),
            $command->getSurname(),
            $command->getEmail(),
            $command->getPhone()
        );


        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->userEdited($existingUser);
    }

}