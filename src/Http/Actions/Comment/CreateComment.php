<?php

namespace Tgu\Bazitov\Http\Actions\Comment;

use Tgu\Bazitov\Comment;
use Tgu\Bazitov\Exceptions\HttpException;
use Tgu\Bazitov\Http\Actions\ActionInterface;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Http\Response;
use Tgu\Bazitov\Http\SuccessfulResponse;
use Tgu\Bazitov\Repositories\CommentRepository\CommentsRepositoryInterface;
use Tgu\Bazitov\Repositories\UUID;

class CreateComment implements ActionInterface
{
    public function __construct(
        private CommentsRepositoryInterface $commentsRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newCommentUuid = new UUID();
            $comment = new Comment(
                $newCommentUuid,
                new UUID($request->jsonBodyField('userId')),
                new UUID($request->jsonBodyField('articleId')),
                $request->jsonBodyField('text'),
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->commentsRepository->save($comment);

        return new SuccessfulResponse([
            'uuid' => (string)$newCommentUuid
        ]);
    }
}