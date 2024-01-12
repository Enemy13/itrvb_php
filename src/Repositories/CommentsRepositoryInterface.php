<?php

namespace Tgu\Bazitov\Repositories;

use Tgu\Bazitov\Comment;

interface CommentsRepositoryInterface
{
    function get(UUID $uuid): Comment;

    function save(Comment $comment): void;
}