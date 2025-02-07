<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Country;
use App\Models\Category;
use App\Models\ProviderType;

/**
 * Generate and return a standard JSON response.
 * If the HTTP response code is not 200, then logs the message, if any.
 * @param int $code - HTTP response code, defaults to 200 success.
 * @param string|null $message - the message, null by default. If the code is 500 and message is null, message will be 'Error processing request'.
 * @param array $data - any data to add to the response, empty array by default
 * @return JsonResponse
 */
function jsonResponse(int $code = 200, string $message = null, array $data = []): JsonResponse
{
    if ($code != 200 && !empty($message)) {
        Log::error('Error in API: ' . $code . ' ' . $message);
    }
    return response()->json(
        array_merge([
            'status' => $code == 200,
            'message' => $message != null ? $message : ($code == 500 ? 'Error processing request' : null),
            'code' => $code
        ], $data),
        $code
    );
}

/**
 * Returns a JsonResponse with a message but no data.
 * If the code is 200 then indicates a successful response.
 * @param int $code
 * @param string|null $message
 * @param array $extraData
 * @return JsonResponse
 */
function jsonResponseWithMessage(int $code, string $message = null, array $extraData = []): JsonResponse
{
    return jsonResponse($code, $message, $extraData);
}


function getActiveCountries()
{
    return Country::where('status', '1')->pluck('name', 'id');
}

function getActiveProviderTypes()
{
    return ProviderType::where('status', '1')->pluck('name', 'id');
}

function getActiveCategories()
{
    return Category::where('status', '1')->pluck('name', 'id');
}

function getActiveClientTypes()
{
    return [
        'individual' => 'Individual',
        'organization' => 'Organization',
    ];
}


/**
 * Returns a successful JsonResponse with data but no message.
 * @param $data - the data to be sent in the 'data' attribute
 * @param array $extraData -  any extra data to send in addition to 'data' attribute.
 * @return JsonResponse
 */
function jsonResponseWithData($data, array $extraData = []): JsonResponse
{
    return jsonResponse(200, null, array_merge(['data' => $data], $extraData));
}

/**
 * Returns a jsonResponse with http status 500 and the message from the exception.
 * Also logs the exception.
 * @param Throwable $e
 * @return JsonResponse
 */
function jsonResponseWithException(Throwable $e): JsonResponse
{
    Log::error('Exception in API: (' . $e->getCode() . '): ' . $e->getMessage() . ' in ' . $e->getFile() . ' line ' . $e->getLine());
    if ($e instanceof ValidationException) {
        return jsonResponse($e->status, $e->getMessage());
    } else if ($e instanceof ModelNotFoundException) {
        return jsonResponse(code: 404, message: $e->getMessage());
    } else {
        return jsonResponse(code: 500, message: $e->getMessage());
    }
}