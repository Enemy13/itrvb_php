<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class Comment
{

    private UUID $id;
    private UUID $userId;
    private UUID $articleId;
    private string $text;

    public function __construct(UUID $userId, UUID $articleId, string $text)
    {
        $this->id = new UUID();
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->text = $text;
    }

    public function getId(): UUID
    {
        return $this->id;
    }

    public function getUserId(): UUID
    {
        return $this->userId;
    }

    public function getArticleId(): UUID
    {
        return $this->articleId;
    }

    public function getText(): string
    {
        return $this->text;
    }

}