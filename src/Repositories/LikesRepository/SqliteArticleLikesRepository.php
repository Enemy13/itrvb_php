<?php

namespace Tgu\Bazitov\Repositories\LikesRepository;

use PDO;
use Tgu\Bazitov\ArticleLike;
use Tgu\Bazitov\Exceptions\ArticleLikeFoundException;
use Tgu\Bazitov\Repositories\UUID;

class SqliteArticleLikesRepository implements ArticleLikesRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function getByArticleUuid(UUID $uuid): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM article_likes WHERE article_uuid=:uuid');
        $stmt->execute(array((string)$uuid));

        $likes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new ArticleLike(
                null,
                new UUID($row['article_uuid']),
                new UUID($row['user_uuid'])
            );
        }
        return $likes;
    }

    function save(ArticleLike $articleLike): void
    {
        $stmt = $this->connection->prepare('SELECT * FROM article_likes WHERE user_uuid=:user_uuid AND article_uuid=:article_uuid');
        $stmt->execute(array($articleLike->getUserId(), $articleLike->getArticleId()));

        if ($stmt->fetchColumn() > 0) {
            throw new ArticleLikeFoundException("Пользователь {$articleLike->getUserId()} уже поставил лайк в посте:" . $articleLike->getArticleId());
        }

        $stmt = $this->connection->prepare('INSERT INTO article_likes(uuid,user_uuid,article_uuid) VALUES (:uuid,:user_uuid,:article_uuid)');
        $stmt->execute(array($articleLike->getId(), $articleLike->getUserId(), $articleLike->getArticleId()));
    }
}