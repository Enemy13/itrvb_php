<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class Article
{
    public UUID $id;
    public UUID $userId;
    public string $title;
    public string $text;

    public function __construct(UUID $userId, string $title, string $text)
    {
        $this->id = new UUID();
        $this->userId = $userId;
        $this->title = $title;
        $this->text = $text;
    }

}