<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class ArticleLike
{
    private UUID $id;
    private UUID $articleId;
    private UUID $userId;

    public function __construct(?UUID $id, UUID $articleId, UUID $userId)
    {
        $this->id = new UUID($id);
        $this->articleId = $articleId;
        $this->userId = $userId;
    }

    public  function getId(): UUID
    {
        return $this->id;
    }
    public  function getArticleId(): UUID
    {
        return $this->articleId;
    }
    public  function getUserId(): UUID
    {
        return $this->userId;
    }
}