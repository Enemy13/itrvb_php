<?php

namespace Tgu\Bazitov\Repositories\UserRepository;

use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\User;
use PDO;

class SqliteUserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function get(UUID $uuid): User
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE uuid=:uuid');
        $stmt->execute(array((string)$uuid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false)
            throw new \Exception();

        return new User(
            new UUID($result['uuid']),
            $result['username'],
            $result['first_name'],
            $result['last_name']);
    }

    function save(User $user): void
    {
        $stmt = $this->connection->prepare('INSERT INTO main.users(uuid,username,first_name,last_name) VALUES (:uuid,:username,:first_name,:last_name)');
        $stmt->execute(array($user->getId(), $user->getUserName(), $user->getFirstName(), $user->getLastName()));
    }
}