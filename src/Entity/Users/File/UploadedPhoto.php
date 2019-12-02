<?php

namespace App\Entity\Users\File;

interface UploadedPhoto
{
    public function move(string $userName): string;
}
