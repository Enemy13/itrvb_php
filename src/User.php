<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class User
{
    private UUID $id;
    private string $userName;
    private string $firstName;
    private string $lastName;

    public function __construct(string $userName, string $firstName, string $lastName)
    {
        $this->id = new UUID();
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}