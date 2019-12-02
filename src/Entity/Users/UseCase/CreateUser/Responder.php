<?php

namespace App\Entity\Users\UseCase\CreateUser;

use App\Entity\Users\User;

interface Responder
{
    public function userCreated(User $user);
    public function providedEmailIsInUse(string $email);
}