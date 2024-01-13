<?php

namespace Tgu\Bazitov\UnitTests\Repositories\UserRepository;

use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Bazitov\Exceptions\UserNotFoundException;
use Tgu\Bazitov\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\User;
use PDO;

class SqliteUserRepositoryTest extends TestCase
{
    public function testInThrowsAnExceptionWhenUserNotFound(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementStub = $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);

        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUserRepository($connectionStub);

        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Пользователь не найден по uuid:a2a202db-bce7-3bff-90d2-430194a6a000');

        $repository->get(new UUID('a2a202db-bce7-3bff-90d2-430194a6a000'));
    }

    public function testItSaveUserToDateBase(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementMock = $this->createMock(PDOStatement::class);

        $statementMock->expects($this->once())->method('execute')->with([
            0 => 'a2a202db-bce7-3bff-90d2-430194a6a000',
            1 => 'enemy',
            2 => 'dmitry',
            3 => 'bazitov',
        ]);

        $connectionStub->method('prepare')->willReturn($statementMock);

        $repository = new SqliteUserRepository($connectionStub);

        $repository->save(
            new User(
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a000'),
                'enemy',
                'dmitry',
                'bazitov'
            )
        );
    }
}