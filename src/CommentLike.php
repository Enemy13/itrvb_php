<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class CommentLike
{
    private UUID $id;
    private UUID $commentId;
    private UUID $userId;

    public function __construct(?UUID $id, UUID $commentId, UUID $userId)
    {
        $this->id = new UUID($id);
        $this->commentId = $commentId;
        $this->userId = $userId;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getCommentId(): UUID
    {
        return $this->commentId;
    }

    public function getUserId(): UUID
    {
        return $this->userId;
    }
}