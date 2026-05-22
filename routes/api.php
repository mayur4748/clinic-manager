<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\AppointmentApiController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource( 'products', ProductApiController::class );
    Route::apiResource( 'appointments', AppointmentApiController::class );
});