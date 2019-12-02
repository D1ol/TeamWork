<?php


namespace App\Adapter\Users;

use App\Entity\Users\File\UploadedPhoto as UploadedPhotoInterface;

final class UploadedPhoto implements UploadedPhotoInterface
{
    private $uploadedFile;
    private $targetDir;

    public function __construct(\Symfony\Component\HttpFoundation\File\UploadedFile $uploadedFile, string $targetDir)
    {
        $this->uploadedFile = $uploadedFile;
        $this->targetDir = $targetDir;
    }

    public function move(string $userName): string
    {
        if (!$this->uploadedFile) {
            return '';
        }
        $dir = $this->targetDir.DIRECTORY_SEPARATOR.$userName.DIRECTORY_SEPARATOR;
        $datetime = (new \DateTime('now'))->format('Y-m-d-H-i-s');
        $fileName = $datetime.'.'.strtolower($this->uploadedFile->getClientOriginalExtension());
        $this->uploadedFile->move($dir, $fileName);


        return $fileName;
    }
}
