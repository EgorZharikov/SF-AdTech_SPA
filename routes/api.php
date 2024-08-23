<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\RegisterController;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::post('authentication', [AuthController::class, 'authentication']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('offers', OfferController::class);
    
});