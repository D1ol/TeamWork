<?php

namespace App\Entity\Users\UseCase\ChangePhoto;

use App\Entity\Users\File\UploadedPhoto;

class Command
{
    private $userId;
    private $userPhoto;
    private $responder;

    public function __construct(
        string $userId,
        UploadedPhoto $userPhoto = null
    )
    {
        $this->userId = $userId;
        $this->userPhoto = $userPhoto;
        $this->responder = new NullResponder();
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getUserPhoto(): UploadedPhoto
    {
        return $this->userPhoto;
    }

    public function getResponder(): Responder
    {
        return $this->responder;
    }

    public function setResponder(Responder $responder)
    {
        $this->responder = $responder;

        return $this;
    }
}
