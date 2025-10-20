<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registra tus alias de middleware aquí
        $middleware->alias([
            'check.session' => \App\Http\Middleware\CheckSession::class,
            // otros middlewares...
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
