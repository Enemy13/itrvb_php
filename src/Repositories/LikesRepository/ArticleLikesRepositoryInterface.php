<?php

namespace Tgu\Bazitov\Repositories\LikesRepository;


use Tgu\Bazitov\ArticleLike;
use Tgu\Bazitov\Repositories\UUID;

interface ArticleLikesRepositoryInterface
{
    function getByArticleUuid(UUID $uuid): array;

    function save(ArticleLike $articleLike): void;

}