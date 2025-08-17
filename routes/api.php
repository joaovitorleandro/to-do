<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\TaskController;
use App\Http\Controllers\API\V1\AuthController;

Route::prefix('v1')->group(function () {

    // Rotas públicas
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Rotas protegidas por JWT
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks', [TaskController::class, 'store']);
        Route::put('/tasks/{id}', [TaskController::class, 'update']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
}); 
