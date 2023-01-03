<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @param mixed|null $data
     * @param integer    $statusCode
     * @param array      $headers
     *
     * @return JsonResponse
     */
    public function success(mixed $data = null, int $statusCode = Response::HTTP_OK, array $headers = []): JsonResponse
    {
        return $this->buildResponse(
            [
                'success' => true,
                'data'    => $data,
            ],
            $statusCode,
            $headers
        );
    }

    /**
     * @param mixed|null $data
     * @param integer    $statusCode
     * @param array      $headers
     *
     * @return JsonResponse
     */
    public function error(mixed $data = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = []): JsonResponse
    {
        return $this->buildResponse(
            [
                'success' => false,
                'data'    => $data,
            ],
            $statusCode,
            $headers
        );
    }

    /**
     * @return User|null
     */
    protected function getUser(): ?User
    {
        return request()->user();
    }

    /**
     * @param array   $data
     * @param integer $statusCode
     * @param array   $headers
     *
     * @return JsonResponse
     */
    protected function buildResponse(array $data, int $statusCode, array $headers): JsonResponse
    {
        return new JsonResponse(
            $data,
            $statusCode,
            $headers
        );
    }
}