<?php

namespace Tgu\Bazitov\Repositories;

use Faker\Provider\Uuid as UuidAlias;

class UUID
{
    private readonly string $uuid;

    function __construct(string $uuid = null)
    {
        $this->uuid = $uuid === null ? UuidAlias::uuid() : $uuid;
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}

