<?php


namespace App\Entity\Clients\ReadModel;


class Clients
{
    private $id;
    private $name;
    private $color;
    private $photo;

    /**
     * Clients constructor.
     * @param $id
     * @param $name
     * @param $color
     * @param $photo
     */
    public function __construct
    (
        $id,
        $name,
        $color,
        $photo
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->color = $color;
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }


}