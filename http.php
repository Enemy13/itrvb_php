<?php

use Tgu\Bazitov\Http\Actions\ArticleLike\CreateArticleLike;
use Tgu\Bazitov\Http\Actions\Articles\CreateArticle;
use Tgu\Bazitov\Http\Actions\Articles\DeleteArticle;
use Tgu\Bazitov\Http\Actions\Comment\CreateComment;
use Tgu\Bazitov\Http\Actions\CommentLike\CreateCommentLike;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Repositories\ArticlesRepository\SqliteArticlesRepository;
use Tgu\Bazitov\Repositories\CommentRepository\SqliteCommentsRepository;
use Tgu\Bazitov\Repositories\LikesRepository\SqliteArticleLikesRepository;
use Tgu\Bazitov\Repositories\LikesRepository\SqliteCommentLikesRepository;

require_once __DIR__ . '/vendor/autoload.php';

$request = new Request($_GET, $_SERVER, file_get_contents('php://input'));

try {
    $path = $request->path();
} catch (HttpException) {
    (new ErrorResponse)->send();
    return;
}

try {
    $method = $request->method();
} catch (HttpException) {
    (new ErrorResponse)->send();
    return;
}

$routes = [
    'POST' => [
        '/articles/comment' => new CreateComment(
            new SqliteCommentsRepository(
                new PDO('sqlite:' . __DIR__ . '/identifier.sqlite')
            )
        ),
        '/articles' => new CreateArticle(
            new SqliteArticlesRepository(
                new PDO('sqlite:' . __DIR__ . '/identifier.sqlite')
            )
        ),
        '/articles/like' => new CreateArticleLike(
            new SqliteArticleLikesRepository(
                new PDO('sqlite:' . __DIR__ . '/identifier.sqlite')
            )
        ),
        '/comment/like' => new CreateCommentLike(
            new SqliteCommentLikesRepository(
                new PDO('sqlite:' . __DIR__ . '/identifier.sqlite')
            )
        ),
    ],
    'DELETE' => [
        '/articles' => new DeleteArticle(
            new SqliteArticlesRepository(
                new PDO('sqlite:' . __DIR__ . '/identifier.sqlite')
            )
        )
    ]
];

if (!array_key_exists($method, $routes)) {
    (new ErrorResponse('Not found'))->send();
    return;
}

if (!array_key_exists($path, $routes[$method])) {
    (new ErrorResponse('Not found'))->send();
    return;
}

$action = $routes[$method][$path];

try {
    $response = $action->handle($request);
} catch (Exception $error) {
    (new ErrorResponse($error->getMessage()))->send();
}

$response->send();