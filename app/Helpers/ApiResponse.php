<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

/**
 * Standard JsonResponse for the API
 */
class ApiResponse
{
    /**
     * Success JsonResponse
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success(array $data = [], string $message = 'success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ],200);
    }

    /**
     * Error JsonResponse
     * @param array $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function error(array $data = [], string $message = 'error', int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Validation errors response
     * @param $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function validations($errors, int $statusCode = 403): JsonResponse
    {
        return response()->json([
            'success' => false,
            'errors' => $errors,
        ], $statusCode);
    }
}
