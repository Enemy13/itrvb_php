<?php

namespace Tgu\Bazitov;

use Tgu\Bazitov\Repositories\UUID;

class Article
{
    private UUID $id;
    private UUID $userId;
    private string $title;
    private string $text;

    public function __construct(UUID $userId, string $title, string $text)
    {
        $this->id = new UUID();
        $this->userId = $userId;
        $this->title = $title;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

}