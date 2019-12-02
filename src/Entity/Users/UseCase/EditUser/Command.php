<?php


namespace App\Entity\Users\UseCase\EditUser;


class Command
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $responder;

    public function __construct
    (
        $id,
        $name,
        $surname,
        $email,
        $phone
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->responder = new NullResponder();
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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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