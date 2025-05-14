<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
//        web: __DIR__.'/../routes/web.php',
//        health: '/up',
//        commands: __DIR__ . '/../routes/console.php',
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));


//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));

        },

        commands: __DIR__ . '/../routes/console.php'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
