<?php


namespace App\Entity\Clients\File;


interface UploadedFile
{
    public function move(string $clientName): string;
}