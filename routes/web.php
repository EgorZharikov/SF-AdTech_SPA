<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RedirectController;

Route::get('/redirects/{referal_link}', [RedirectController::class, 'redirect'])->middleware('subscribed')->name('redirect');
Route::get('{page}', MainController::class)->where('page', '.*');
Auth::routes();