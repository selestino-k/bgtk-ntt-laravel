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
    ->withMiddleware(function (Middleware $middleware): void {
        // Ensures defer() callbacks flush after the HTTP response on cPanel PHP-FPM.
        $middleware->append(\Illuminate\Foundation\Http\Middleware\InvokeDeferredCallbacks::class);
        $middleware->append(\App\Http\Middleware\ContentSecurityPolicy::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
