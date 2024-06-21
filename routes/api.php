<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/integration', [IntegrationController::class, 'store']);
    Route::put('/integration/{id}', [IntegrationController::class, 'update']);
    Route::delete('/integration/{id}', [IntegrationController::class, 'destroy']);
});
