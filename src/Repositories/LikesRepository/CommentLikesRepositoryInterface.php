<?php

namespace Tgu\Bazitov\Repositories\LikesRepository;


use Tgu\Bazitov\CommentLike;
use Tgu\Bazitov\Repositories\UUID;

interface CommentLikesRepositoryInterface
{
    function getByCommentUuid(UUID $uuid): array;

    function save(CommentLike $commentLike): void;

}