<?php

namespace Tgu\Bazitov\Repositories\ArticlesRepository;

use Tgu\Bazitov\Article;
use Tgu\Bazitov\Repositories\UUID;

interface ArticlesRepositoryInterface
{
    function get(UUID $uuid): Article;

    function save(Article $article): void;

    function delete(UUID $uuid): void;
}