<?php

namespace Tgu\Bazitov\Http\Actions\User;

use Tgu\Bazitov\Exceptions\HttpException;
use Tgu\Bazitov\Http\Actions\ActionInterface;
use Tgu\Bazitov\Http\ErrorResponse;
use Tgu\Bazitov\Http\Request;
use Tgu\Bazitov\Http\Response;
use Tgu\Bazitov\Http\SuccessfulResponse;
use Tgu\Bazitov\Repositories\UserRepository\UserRepositoryInterface;
use Tgu\Bazitov\Repositories\UUID;
use Tgu\Bazitov\User;

class CreateUser implements ActionInterface
{
    public function __construct(
        private UserRepositoryInterface $usersRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newUserUuid = new UUID();
            $user = new User(
                $newUserUuid,
                $request->jsonBodyField('username'),
                $request->jsonBodyField('first_name'),
                $request->jsonBodyField('last_name'),
            );
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->usersRepository->save($user);

        return new SuccessfulResponse([
            'uuid' => (string)$newUserUuid
        ]);
    }
}