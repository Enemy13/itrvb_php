<?php

namespace Tgu\Bazitov;

class Article
{
    public int $id;
    public int $userId;
    public string $title;
    public string $text;

    public function __construct(int $id, int $userId, string $title, string $text)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->text = $text;
    }

}