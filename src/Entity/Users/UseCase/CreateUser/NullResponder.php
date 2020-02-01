<?php

namespace App\Entity\Users\UseCase\CreateUser;

use App\Entity\Users\User;

class NullResponder implements Responder
{

    public function userCreated(User $user){}

    public function providedEmailIsInUse(string $email){}
}