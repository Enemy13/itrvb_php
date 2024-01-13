<?php

namespace Tgu\Bazitov\Http\Actions\CommentLike;

use Tgu\Bazitov\Article;
use Tgu\Bazitov\CommentLike;
use Tgu\Bazitov\Exceptions\HttpException;
use Tgu\Bazitov\Http\Actions\ActionInterface;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Http\Response;
use Tgu\Bazitov\Http\SuccessfulResponse;
use Tgu\Bazitov\Repositories\ArticlesRepository\ArticlesRepositoryInterface;
use Tgu\Bazitov\Repositories\LikesRepository\ArticleLikesRepositoryInterface;
use Tgu\Bazitov\Repositories\LikesRepository\CommentLikesRepositoryInterface;
use Tgu\Bazitov\Repositories\UUID;

class CreateCommentLike implements ActionInterface
{


    public function __construct(
        private CommentLikesRepositoryInterface $commentLikesRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newCommentLikeUuid = new UUID();
            $commentLike = new CommentLike(
                $newCommentLikeUuid,
                new UUID($request->jsonBodyField('userId')),
                new UUID($request->jsonBodyField('commentId')),
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->commentLikesRepository->save($commentLike);

        return new SuccessfulResponse([
            'uuid' => (string)$newCommentLikeUuid
        ]);
    }

}