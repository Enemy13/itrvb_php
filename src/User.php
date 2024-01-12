<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class User
{
    public UUID $id;
    public string $userName;
    public string $firstName;
    public string $lastName;

    public function __construct(string $userName, string $firstName, string $lastName)
    {
        $this->id = new UUID();
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}