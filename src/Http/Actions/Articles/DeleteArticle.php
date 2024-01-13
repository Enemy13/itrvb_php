<?php

namespace Tgu\Bazitov\Http\Actions\Articles;

use Tgu\Bazitov\Article;
use Tgu\Bazitov\Exceptions\HttpException;
use Tgu\Bazitov\Http\Actions\ActionInterface;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Http\Response;
use Tgu\Bazitov\Http\SuccessfulResponse;
use Tgu\Bazitov\Repositories\ArticlesRepository\ArticlesRepositoryInterface;
use Tgu\Bazitov\Repositories\UUID;

class DeleteArticle implements ActionInterface
{

    public function __construct(
        private ArticlesRepositoryInterface $articlesRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $uuid = new UUID($request->jsonBodyField('uuid'));
            $this->articlesRepository->delete($uuid);

        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        return new SuccessfulResponse([
            'uuid' => "Article successful delete"
        ]);
    }
}