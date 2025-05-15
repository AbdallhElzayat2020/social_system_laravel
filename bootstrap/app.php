<?php

use App\Http\Middleware\CheckNotificationReadAt;
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

        /* web routes  */
        $middleware->web(append: [
            CheckNotificationReadAt::class,
        ]);

        /* api routes  */
        $middleware->api(append: [
            CheckNotificationReadAt::class,
        ]);

        $middleware->alias([
            'check.notification.read' => CheckNotificationReadAt::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
