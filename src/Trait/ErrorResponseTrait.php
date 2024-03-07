<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ErrorResponseTrait
{

    /**
     * Creates a JSON response for indicating an error condition.
     * @param string $error The error message to include in the response.
     * @param int $status The HTTP status code for the response
     * @return JsonResponse A `JsonResponse` object configured with an error status and the provided error message
     */
    protected function errorJson(string $error, int $status = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'errors' => $error,
        ], $status);
    }
}

