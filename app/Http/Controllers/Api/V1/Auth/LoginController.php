<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\V1\AuthenticationRequest;
use App\Http\Resources\V1\AccessTokenResource;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends ApiController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authentication(AuthenticationRequest $authenticationRequest)
    {
        if (\Auth::guard('api')->validate($authenticationRequest->only(['email', 'password']))) {
            $accessToken = $this->userService
                ->findUserByEmail($authenticationRequest->get('email'))
                ->syncRole($authenticationRequest->get('role'))
                ->generateAccessToken();

            return $this->success(
                [
                    'token' => new AccessTokenResource($accessToken),
                ]
            );
        }

        return $this->error(
            [
                'message' => __('Wrong password.'),
            ], Response::HTTP_UNAUTHORIZED
        );
    }
}