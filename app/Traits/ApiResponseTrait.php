<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    /**
     * Success response
     */
    protected function success($data = null, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data !== null) {
            if ($data instanceof LengthAwarePaginator) {
                $response['data'] = $data->items();
                $response['pagination'] = [
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                    'has_more_pages' => $data->hasMorePages(),
                ];
            } else {
                $response['data'] = $data;
            }
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Error response
     */
    protected function error(string $message = 'Error', int $statusCode = 400, $errors = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Validation error response
     */
    protected function validationError($errors, string $message = 'Validation failed'): JsonResponse
    {
        return $this->error($message, 422, $errors);
    }

    /**
     * Not found response
     */
    protected function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return $this->error($message, 404);
    }

    /**
     * Unauthorized response
     */
    protected function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error($message, 401);
    }

    /**
     * Forbidden response
     */
    protected function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->error($message, 403);
    }

    /**
     * Server error response
     */
    protected function serverError(string $message = 'Internal server error'): JsonResponse
    {
        return $this->error($message, 500);
    }

    /**
     * Created response
     */
    protected function created($data = null, string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    /**
     * Updated response
     */
    protected function updated($data = null, string $message = 'Resource updated successfully'): JsonResponse
    {
        return $this->success($data, $message, 200);
    }

    /**
     * Deleted response
     */
    protected function deleted(string $message = 'Resource deleted successfully'): JsonResponse
    {
        return $this->success(null, $message, 200);
    }

    /**
     * No content response
     */
    protected function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Resource collection response
     */
    protected function collection($resource, string $message = 'Data retrieved successfully'): JsonResponse
    {
        if ($resource instanceof JsonResource) {
            return $this->success($resource, $message);
        }

        return $this->success($resource, $message);
    }

    /**
     * Resource response
     */
    protected function resource($resource, string $message = 'Data retrieved successfully'): JsonResponse
    {
        return $this->success($resource, $message);
    }
}