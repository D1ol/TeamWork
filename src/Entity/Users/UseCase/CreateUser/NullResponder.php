<?php

namespace App\Entity\Users\UseCase\CreateUser;

use App\Entity\Users\User;

class NullResponder implements Responder
{

    public function userCreated(User $user)
    {
        // TODO: Implement userCreated() method.
    }

    public function providedEmailIsInUse(string $email)
    {
        // TODO: Implement providedEmailIsInUse() method.
    }
}