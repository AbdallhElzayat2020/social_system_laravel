<?php

use App\Http\Middleware\Admin\AdminAuthMiddleware;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use App\Http\Middleware\CheckNotificationReadAt;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckUserStatus;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

        apiPrefix: 'api/',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'check.notification.read' => CheckNotificationReadAt::class,
            'auth.admin' => AdminAuthMiddleware::class,
            'guest.admin' => RedirectIfAuthenticated::class,
            'check_user_status' => CheckUserStatus::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
