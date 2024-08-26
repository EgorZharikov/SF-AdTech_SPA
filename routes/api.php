<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\WebmasterController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SubscriptionController;


Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::post('authentication', [AuthController::class, 'authentication']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('offers', OfferController::class);
    Route::post('offers/{offer}/subscribe', [OfferController::class, 'subscribe']);
    Route::post('offers/{offer}/unsubscribe', [OfferController::class, 'unsubscribe']);
    Route::get('offers/{offer}/subscription', [OfferController::class, 'subscription']);
    Route::get('wallet', [WalletController::class, 'show']);
    Route::patch('wallet', [WalletController::class, 'update']);
    Route::get('webmaster/subscriptions', [SubscriptionController::class, 'index']);
    Route::get('webmaster/statistics', [WebmasterController::class, 'statistics']);
    Route::get('webmaster/statistics', [WebmasterController::class, 'statistics']);
    Route::post('webmaster/statistics', [WebmasterController::class, 'statistics']);
});