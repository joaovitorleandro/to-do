<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/task', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);