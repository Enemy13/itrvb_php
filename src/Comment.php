<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class Comment
{
    public UUID $id;
    public UUID $userId;
    public UUID $articleId;
    public string $text;

    public function __construct(UUID $userId, UUID $articleId, string $text)
    {
        $this->id = new UUID();
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->text = $text;
    }

}