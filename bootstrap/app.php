<?php

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Custom API rate limiting
        // RateLimiter::for('api', function (Request $request) {
        //     return [
        //         Limit::perMinute(200)->by($request->user()?->id ?: $request->ip()),
        //         Limit::perHour(500)->by($request->ip()),
        //     ];
        // });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
