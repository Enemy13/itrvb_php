<?php

namespace Tgu\Bazitov\Repositories\ArticlesRepository;

use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Bazitov\Exceptions\ArticleNotFoundException;
use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\Article;
use PDO;

class SqliteArticlesRepositoryTest extends TestCase
{
    public function testInThrowsAnExceptionWhenArticleNotFound(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementStub = $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);

        $connectionStub->method('prepare')->willReturn($statementStub);


        $repository = new SqliteArticlesRepository($connectionStub);

        $this->expectException(ArticleNotFoundException::class);
        $this->expectExceptionMessage('Статья не найдена по uuid:a2a202db-bce7-3bff-90d2-430194a6a000');

        $repository->get(new UUID('a2a202db-bce7-3bff-90d2-430194a6a000'));
    }

    public function testItSaveArticleToDateBase(): void
    {
        $connectionStub = $this->createStub(PDO::class);

        $statementMock = $this->createMock(PDOStatement::class);

        $statementMock->expects($this->once())->method('execute')->with([
            0 => 'a2a202db-bce7-3bff-90d2-430194a6a000',
            1 => 'a2a202db-bce7-3bff-90d2-430194a6a123',
            2 => 'someTitle',
            3 => 'someText',
        ]);

        $connectionStub->method('prepare')->willReturn($statementMock);

        $repository = new SqliteArticlesRepository($connectionStub);

        $repository->save(
            new Article(
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a000'),
                new UUID('a2a202db-bce7-3bff-90d2-430194a6a123'),
                'someTitle',
                'someText'
            )
        );
    }
}