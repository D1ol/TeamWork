<?php


namespace App\Entity\Users\ReadModel;




class Users
{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $role;
    private $isActive;
    private $token;
    private $colorSideBar;
    private $photo;



    public function __construct(
        string $id,
        string $name,
        string $surname,
        string $email,
        ?string $phone,
        bool $isActive,
        ?string $token,
         $role,
        string $colorSideBar,
        ?string $photo
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->isActive = $isActive;
        $this->token = $token;
        $this->role = $role;
        $this->colorSideBar = $colorSideBar;
        $this->photo = $photo;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getColorSideBar(): string
    {
        return $this->colorSideBar;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }



}
