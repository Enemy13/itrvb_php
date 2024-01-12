<?php

namespace Tgu\Bazitov\Repositories;

use Faker\Provider\Uuid as UuidAlias;

class UUID
{
    private readonly string $uuid;

    function __construct()
    {
        $this->uuid = UuidAlias::uuid();
    }

    public function __toString(): string
    {
        return $this->uuid;
    }

}

