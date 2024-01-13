<?php

namespace Tgu\Bazitov\Repositories\LikesRepository;

use PDO;
use Tgu\Bazitov\ArticleLike;
use Tgu\Bazitov\CommentLike;
use Tgu\Bazitov\Exceptions\ArticleLikeFoundException;
use Tgu\Bazitov\Exceptions\CommentLikeFoundException;
use Tgu\Bazitov\Repositories\UUID;

class SqliteCommentLikesRepository implements CommentLikesRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function getByCommentUuid(UUID $uuid): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM comment_likes WHERE comment_uuid =:uuid');
        $stmt->execute(array((string)$uuid));

        $likes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $likes[] = new CommentLike(
                null,
                new UUID($row['comment_uuid']),
                new UUID($row['user_uuid'])
            );
        }
        return $likes;
    }

    function save(CommentLike $commentLike): void
    {
        $stmt = $this->connection->prepare('SELECT * FROM comment_likes WHERE user_uuid=:user_uuid AND comment_uuid =:comment_uuid');
        $stmt->execute(array($commentLike->getUserId(), $commentLike->getCommentId()));

        if ($stmt->fetchColumn() > 0) {
            throw new CommentLikeFoundException("Пользователь {$commentLike->getUserId()} уже поставил лайк в коментарии:" . $commentLike->getCommentId());
        }

        $stmt = $this->connection->prepare('INSERT INTO article_likes(uuid,user_uuid,article_uuid) VALUES (:uuid,:user_uuid,:article_uuid)');
        $stmt->execute(array($commentLike->getId(), $commentLike->getUserId(), $commentLike->getCommentId()));
    }
}