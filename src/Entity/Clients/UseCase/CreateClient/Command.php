<?php


namespace App\Entity\Clients\UseCase\CreateClient;


use App\Adapter\Clients\UploadedFile;

class Command
{
    private $name;
    private $color;
    private $photoClient;
    private $responder;


    public function __construct
    (
        $name,
        $color,
        UploadedFile $photoClient = null
    )
    {
        $this->name = $name;
        $this->color = $color;
        $this->photoClient = $photoClient;
        $this->responder = new NullResponder();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return UploadedFile
     */
    public function getPhotoClient(): UploadedFile
    {
        return $this->photoClient;
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