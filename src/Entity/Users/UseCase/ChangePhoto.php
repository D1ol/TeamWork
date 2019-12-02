<?php


namespace App\Entity\Users\UseCase;


use App\Core\Transaction;
use App\Entity\Users\UseCase\ChangePhoto\Command;
use App\Entity\Users\Users;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChangePhoto
{
    private $users;
    private $transaction;

    public function __construct(
        Users $users,
        Transaction $transaction
    )
    {
        $this->users = $users;
        $this->transaction = $transaction;
    }

    public function execute(Command $command)
    {
        $this->transaction->begin();

        $existingUser = $this->users->findOneById($command->getUserId());

        if(!$existingUser)
        {
            return;
        }

        $existingUser->setPhoto($command->getUserPhoto()->move($existingUser->getName()));

        $this->users->add($existingUser);

        try {
            $this->transaction->commit();
        } catch (\Throwable $e) {
            $this->transaction->rollBack();
            throw $e;
        }

        $command->getResponder()->photoChanged();
    }
}
