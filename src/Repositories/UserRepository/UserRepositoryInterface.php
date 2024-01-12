<?php

namespace Tgu\Bazitov\Repositories\UserRepository;

use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\User;

interface UserRepositoryInterface
{
    function get(UUID $uuid): User;

    function save(User $user): void;
}