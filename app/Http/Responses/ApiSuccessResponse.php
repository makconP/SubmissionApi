<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiSuccessResponse implements Responsable
{
    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: ['message' => 'ok'],
            status: Response::HTTP_OK,
        );
    }
}
