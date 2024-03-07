<?php
// src/Traits/SuccessResponseTrait.php

namespace App\Trait;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait SuccessResponseTrait
{

    /**
     * Creates a JSON response for successful operations.
     * @param array<string, mixed> $data The data to include in the response.
     * @param int $status The HTTP status code for the response, defaulting to 200 (HTTP OK).
     *
     * @return JsonResponse A `JsonResponse` object configured with the merged status indication and provided data
     */
    protected function successJson(array $data, int $status = Response::HTTP_OK): JsonResponse
    {
        return new JsonResponse(array_merge(['status' => 'success'], $data), $status);
    }
}

