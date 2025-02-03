<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Response;

class ResponseHelper
{
    // Success response
    public static function success($message, $data = [])
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], 200);
    }

    // Error response with validation errors
    public static function error($message, $errors = [])
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], 422);
    }

    // Handle exception errors
    public static function exceptionError($exception)
    {
        return response()->json([
            'status' => 'error',
            'message' => 'An unexpected error occurred.',
            'error' => $exception->getMessage(),
        ], 500);
    }
}
