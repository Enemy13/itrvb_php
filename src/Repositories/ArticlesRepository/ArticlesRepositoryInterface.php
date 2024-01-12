<?php

namespace Tgu\Bazitov\Repositories;

use Tgu\Bazitov\Article;

interface ArticlesRepositoryInterface
{
    function get(UUID $uuid): Article;

    function save(Article $article): void;
}