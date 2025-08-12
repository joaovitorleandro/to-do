<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

abstract class Controller extends BaseController
{
    /**
     * Retorna uma resposta de sucesso padronizada
     */
    public function responseSuccess($data, string $message = "Ok", int $httpCode = 200): JsonResponse
    {
        $options = 0;
        if (app()->environment('local')) {
            $options = JSON_PRETTY_PRINT;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $httpCode, [], $options);
    }


    /**
     * Retorna uma resposta de erro padronizada
     */
    public function responseFail(string $message, int $apiErrorCode = 400, int $httpCode = 400, $errorInfo = [], $data = []): JsonResponse
    {
        if (!is_array($errorInfo)) {
            $errorInfo = [$errorInfo];
        }

        \Log::error("API Error", [
            'code' => $apiErrorCode,
            'message' => $message,
            'errorInfo' => $errorInfo
        ]);

        return response()->json([
            'success' => false,
            'statusCode' => $apiErrorCode,
            'message' => $message,
            'data' => $data
        ], $httpCode);
    }

    /**
     * Aplica filtros básicos a um query builder
     */
    public function getFilteredQuery($query, array $filters)
    {
        $perPage = (int)($filters['perPage'] ?? 15);
        $paginate = filter_var($filters['paginate'] ?? true, FILTER_VALIDATE_BOOLEAN);

        foreach ($filters as $field => $value) {
            if (in_array($field, ['page', 'orderBy', 'perPage', 'paginate'])) {
                continue;
            }
            $query->whereRaw("LOWER({$field}) LIKE ?", ['%' . strtolower($value) . '%']);
        }

        $orderByField = $filters['orderBy'] ?? 'created_at';
        $order = strpos($orderByField, '-') === 0 ? 'ASC' : 'DESC';
        $orderByField = ltrim($orderByField, '-');

        $query->orderBy($orderByField, $order);

        return $paginate ? $query->paginate($perPage) : $query->get();
    }
}
