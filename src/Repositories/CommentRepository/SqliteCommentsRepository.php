<?php

namespace Tgu\Bazitov\Repositories\CommentRepository;


use Tgu\Bazitov\Comment;
use Tgu\Bazitov\Repositories\UUID;
use PDO;

class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    function get(UUID $uuid): Comment
    {
        $stmt = $this->connection->prepare('SELECT * FROM comments WHERE uuid=:uuid');
        $stmt->execute(array((string)$uuid));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result === false)
            throw new \Exception();

        return new Comment(
            new UUID($result['uuid']),
            new UUID($result['user_uuid']),
            new UUID($result['article_uuid']),
            $result['text']);
    }

    function save(Comment $comment): void
    {
        $stmt = $this->connection->prepare('INSERT INTO comments(uuid,user_uuid,article_uuid,text) VALUES (:uuid,:user_uuid,:article_uuid,:text)');
        $stmt->execute(array($comment->getId(), $comment->getUserId(), $comment->getArticleId(), $comment->getText()));
    }
}