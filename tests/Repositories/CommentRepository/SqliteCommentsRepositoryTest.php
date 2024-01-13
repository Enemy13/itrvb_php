<?php

namespace Tgu\Bazitov\UnitTests\Repositories\CommentRepository;


use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Bazitov\Exceptions\CommentNotFoundException;
use Tgu\Bazitov\Repositories\CommentRepository\SqliteCommentsRepository;
use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\Comment;
use PDO;

class SqliteCommentsRepositoryTest extends TestCase
{
    public function testInThrowsAnExceptionWhenCommentNotFound(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementStub = $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);

        $connectionStub->method('prepare')->willReturn($statementStub);


        $repository = new SqliteCommentsRepository($connectionStub);

        $this->expectException(CommentNotFoundException::class);
        $this->expectExceptionMessage('Сообщение не найдено по uuid:a2a202db-bce7-3bff-90d2-430194a6a565');

        $repository->get(new UUID('a2a202db-bce7-3bff-90d2-430194a6a565'));
    }

    public function testItSaveCommentToDateBase(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementMock = $this->createMock(PDOStatement::class);

        $statementMock->expects($this->once())->method('execute')->with([
            0 => 'a2a202db-bce7-3bff-90d2-430194a6a565',
            1 => 'a2a202db-bce7-3bff-90d2-430194a6a123',
            2 => 'a2a202db-bce7-3bff-90d2-430194a6a777',
            3 => 'someText',
        ]);

        $connectionStub->method('prepare')->willReturn($statementMock);

        $repository = new SqliteCommentsRepository($connectionStub);

        $repository->save(
            new Comment(
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a565'),
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a123'),
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a777'),
                'someText'
            )
        );
    }
}