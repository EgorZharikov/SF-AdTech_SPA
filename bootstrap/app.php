<?php

use App\Http\Middleware\CheckBanned;
use App\Http\Middleware\IsAdministrator;
use App\Http\Middleware\IsAdvertiser;
use App\Http\Middleware\IsAuthor;
use App\Http\Middleware\IsWebmaster;
use App\Http\Middleware\Subscribed;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )->withBroadcasting(
        __DIR__ . '/../routes/channels.php',
        ['prefix' => 'api', 'middleware' => ['api', 'auth:sanctum']],
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'subscribed' => Subscribed::class,
        'checkBanned' => CheckBanned::class,
        'isAdvertiser' => IsAdvertiser::class,
        'isWebmaster' => IsWebmaster::class,
        'isAuthor' => IsAuthor::class,
        'isAdministrator' => IsAdministrator::class
    ]);
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
