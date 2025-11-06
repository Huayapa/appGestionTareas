<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('apiResponse')) {
    function apiResponse(array $responseArray, int $httpCode = 200): JsonResponse
    {
        // Asegurarse que todos los campos existan
        $formatted = [
            'status' => $responseArray['status'] ?? 'success',
            'message' => $responseArray['message'] ?? '',
            'data' => $responseArray['data'] ?? [],
            'error' => $responseArray['error'] ?? null,
        ];

        return response()->json($formatted, $httpCode, [], JSON_UNESCAPED_UNICODE);
    }
}