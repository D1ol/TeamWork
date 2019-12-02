<?php

namespace App\Adapter\Clients;

use App\Entity\Clients\File\UploadedFile as UploadedFileInterface;

final class UploadedFile implements UploadedFileInterface
{
    private $uploadedFile;
    private $targetDir;

    public function __construct(\Symfony\Component\HttpFoundation\File\UploadedFile $uploadedFile, string $targetDir)
    {
        $this->uploadedFile = $uploadedFile;
        $this->targetDir = $targetDir;
    }

    public function move(string $clientName): string
    {
        if (!$this->uploadedFile) {
            return '';
        }

        $dir = $this->targetDir.DIRECTORY_SEPARATOR.$clientName.DIRECTORY_SEPARATOR;
        $datetime = (new \DateTime('now'))->format('YmdHis');
        $fileName = $datetime.'.'.strtolower($this->uploadedFile->getClientOriginalExtension());
        $this->uploadedFile->move($dir, $fileName);

        return $fileName;
    }
}