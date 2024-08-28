<?php

use App\Http\Controllers\API\AdministratorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\WebmasterController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\API\AdvertiserController;
use App\Http\Controllers\API\UserController;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
Route::post('authentication', [AuthController::class, 'authentication'])->middleware('checkBanned');

Route::middleware('auth:sanctum', 'checkBanned')->group(function () {
    Route::resource('offers', OfferController::class);
    Route::post('offers/{offer}/subscribe', [OfferController::class, 'subscribe']);
    Route::post('offers/{offer}/unsubscribe', [OfferController::class, 'unsubscribe']);
    Route::get('offers/{offer}/subscription', [OfferController::class, 'subscription']);
    Route::get('offers/{offer}/publish', [OfferController::class, 'publish']);
    Route::get('offers/{offer}/unpublish', [OfferController::class, 'unpublish']);
    Route::get('wallet', [WalletController::class, 'show']);
    Route::patch('wallet', [WalletController::class, 'update']);
    Route::get('webmaster/subscriptions', [SubscriptionController::class, 'index']);
    Route::get('webmaster/statistics', [WebmasterController::class, 'statistics']);
    Route::get('webmaster/statistics', [WebmasterController::class, 'statistics']);
    Route::post('webmaster/statistics', [WebmasterController::class, 'statistics']);
    Route::get('webmaster/profile', [WebmasterController::class, 'profile']);
    Route::get('advertiser/offers', [AdvertiserController::class, 'offers']);
    Route::get('advertiser/profile', [AdvertiserController::class, 'profile']);
    Route::get('advertiser/statistics', [AdvertiserController::class, 'statistics']);
    Route::post('advertiser/statistics', [AdvertiserController::class, 'statistics']);
    Route::get('administrator/statistics', [AdministratorController::class, 'statistics']);
    Route::post('administrator/statistics', [AdministratorController::class, 'statistics']);
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::patch('users/{user}/ban', [UserController::class, 'ban']);
    Route::patch('users/{user}/unban', [UserController::class, 'unban']);

});