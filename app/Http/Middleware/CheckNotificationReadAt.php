<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotificationReadAt
{
    public function handle(Request $request, Closure $next): Response
    {

        $notificationId = $request->route('id');

        if ($notificationId) {
            $notification = $request->user()?->notifications()->find($notificationId);

            if (!$notification) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Notification not found'
                    ], 404);
                }
                return redirect()->route('frontend.dashboard.notifications.index')
                    ->with('error', 'Notification not found.');
            }

            // Mark notification as read
            $notification->markAsRead();

            if (isset($notification->data['link'])) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'redirect_url' => $notification->data['link']
                    ]);
                }

                return redirect($notification->data['link']);
            }
        }

        return $next($request);
    }
}