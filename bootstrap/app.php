<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',

        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

    // Register "auth" middleware alias
    $middleware->alias([
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    ]);

    // Admin group
    $middleware->group('admin', [
        'auth', // must authenticate first
        \App\Http\Middleware\AdminMiddleware::class,
    ]);

    // User group
    $middleware->group('user', [
        'auth',
        \App\Http\Middleware\UserMiddleware::class,
    ]);
})

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
