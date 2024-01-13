<?php

namespace Tgu\Bazitov\Repositories\ArticlesRepository;

use PDO;
use Tgu\Bazitov\Article;
use Tgu\Bazitov\Exceptions\ArticleNotFoundException;
use Tgu\Bazitov\Repositories\UUID;

class SqliteArticlesRepository implements ArticlesRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function get(UUID $uuid): Article
    {
        $stmt = $this->connection->prepare('SELECT * FROM articles WHERE uuid=:uuid');
        $stmt->execute(array((string)$uuid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false)
            throw new ArticleNotFoundException('Статья не найдена по uuid:' . $uuid);

        return new Article(new UUID($result['uuid']), new UUID($result['user_uuid']), $result['title'], $result['text']);
    }

    function save(Article $article): void
    {
        $stmt = $this->connection->prepare('INSERT INTO main.articles(uuid,user_uuid,title,text) VALUES (:uuid,:user_uuid,:title,:text)');
        $stmt->execute(array($article->getId(), $article->getUserId(), $article->getTitle(), $article->getText()));
    }
}