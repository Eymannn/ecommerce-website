<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\SellerMiddleware;
use App\Http\Middleware\Verified;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    
        //
        $middleware->alias([
            'seller' => SellerMiddleware::class,
            'customer' => CustomerMiddleware::class,
            'admin' => Admin::class,
            'check.status' => \App\Http\Middleware\CheckUserStatus::class,
            'verified' => Verified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
