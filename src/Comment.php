<?php

namespace Tgu\Bazitov;

class Comment
{
    public int $id;
    public int $userId;
    public int $articleId;
    public string $text;

    public function __construct(int $id, int $userId, int $articleId, string $text)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->articleId = $articleId;
        $this->text = $text;
    }

}