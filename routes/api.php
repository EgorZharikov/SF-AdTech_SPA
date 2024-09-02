<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\WalletController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\WebmasterController;
use App\Http\Controllers\API\AdvertiserController;
use App\Http\Controllers\API\AdministratorController;

Broadcast::routes(['middleware' => ['auth:sanctum']]);
Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
Route::post('authentication', [AuthController::class, 'authentication'])->middleware('checkBanned');

Route::middleware('auth:sanctum', 'checkBanned')->group(function () {
    Route::resource('offers', OfferController::class);
    Route::controller(OfferController::class)->group(function () {
        Route::post('offers/{offer}/subscribe', 'subscribe')->middleware('isWebmaster');
        Route::post('offers/{offer}/unsubscribe', 'unsubscribe')->middleware('isWebmaster');
        Route::get('offers/{offer}/subscription', 'subscription');
        Route::get('offers/{offer}/publish', 'publish')->middleware('isAdvertiser', 'isAuthor');
        Route::get('offers/{offer}/unpublish', 'unpublish')->middleware('isAdvertiser', 'isAuthor');
    });
    
    Route::get('wallet', [WalletController::class, 'show']);
    Route::patch('wallet', [WalletController::class, 'update']);

    Route::controller(WebmasterController::class)->middleware('isWebmaster')->group(function () {
        Route::get('webmaster/subscriptions', 'subscriptions');
        Route::get('webmaster/statistics', 'statistics');
        Route::get('webmaster/statistics', 'statistics');
        Route::post('webmaster/statistics', 'statistics');
        Route::get('webmaster/profile', 'profile');
    });
    
    Route::controller(AdvertiserController::class)->middleware('isAdvertiser')->group(function() {
        Route::get('advertiser/offers', 'offers');
        Route::get('advertiser/profile', 'profile');
        Route::get('advertiser/statistics', 'statistics');
        Route::post('advertiser/statistics', 'statistics');

    });

    Route::middleware('isAdministrator')->group(function () {
        Route::get('administrator/system', [AdministratorController::class, 'systemFee']);
        Route::post('administrator/system', [AdministratorController::class, 'updateSystemFee']);
        Route::get('administrator/statistics', [AdministratorController::class, 'statistics']);
        Route::post('administrator/statistics', [AdministratorController::class, 'statistics']);
        Route::get('administrator/wallet', [AdministratorController::class, 'systemWallet']);
        Route::get('administrator/profile', [AdministratorController::class, 'profile']);
        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::patch('users/{user}/ban', [UserController::class, 'ban']);
        Route::patch('users/{user}/unban', [UserController::class, 'unban']);
    });
});