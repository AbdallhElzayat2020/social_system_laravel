<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the user is authenticated
        if (!auth()->guard('admin')->check()) {
            // redirect to the login page
            return redirect()->route('admin.show-login-form');
        }
        return $next($request);
    }
}
