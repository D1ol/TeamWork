<?php

namespace App\Entity\Users\UseCase\CreateUser;

class Command
{
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $password;
    private $responder;

    /**
     * Command constructor.
     * @param $name
     * @param $surname
     * @param $email
     * @param $phone
     * @param $password
     */
    public function __construct
    (
        $name,
        $surname,
        $email,
        $phone,
        $password
    )
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
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

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
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