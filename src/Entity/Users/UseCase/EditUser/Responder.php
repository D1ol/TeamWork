<?php


namespace App\Entity\Users\UseCase\EditUser;


use App\Entity\Users\User;

interface Responder
{
    public function userEdited(User $user);
}