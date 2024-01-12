<?php

namespace Tgu\Bazitov\Repositories\CommentRepository;

use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\Comment;

interface CommentsRepositoryInterface
{
    function get(UUID $uuid): Comment;

    function save(Comment $comment): void;
}