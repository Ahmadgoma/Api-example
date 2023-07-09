<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

Trait ApiResponseTrait
{
    /**
     * @param null $data
     * @param int  $statusCode
     * @return JsonResponse
     */
    public function apiResponse($data = null, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @return JsonResponse
     */
    public function apiResponseError($data, int $statusCode): JsonResponse
    {
        return response()->json($data, $statusCode);
    }
}
