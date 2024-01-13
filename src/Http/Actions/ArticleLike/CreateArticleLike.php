<?php

namespace Tgu\Bazitov\Http\Actions\ArticleLike;

use Tgu\Bazitov\ArticleLike;
use Tgu\Bazitov\Exceptions\HttpException;
use Tgu\Bazitov\Http\Actions\ActionInterface;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Http\Response;
use Tgu\Bazitov\Http\SuccessfulResponse;

use Tgu\Bazitov\Repositories\LikesRepository\ArticleLikesRepositoryInterface;
use Tgu\Bazitov\Repositories\UUID;

class CreateArticleLike implements ActionInterface
{


    public function __construct(
        private ArticleLikesRepositoryInterface $articleLikesRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newArticleLikeUuid = new UUID();
            $articleLike = new ArticleLike(
                $newArticleLikeUuid,
                new UUID($request->jsonBodyField('userId')),
                new UUID($request->jsonBodyField('articleId')),
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->articleLikesRepository->save($articleLike);

        return new SuccessfulResponse([
            'uuid' => (string)$newArticleLikeUuid
        ]);
    }

}