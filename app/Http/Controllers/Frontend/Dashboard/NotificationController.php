<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notification', compact('user'));
    }

    public function show($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
    }


    public function destroy(Request $request)
    {
        $notification = auth()->user()->notifications()->findOrFail($request->notification_id);
        $notification->delete();
        return back()->with('success', 'Notification deleted.');
    }


    public function deleteAll(Request $request)
    {
        auth()->user()->notifications()->delete();
        return back()->with('success', 'All notifications deleted.');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
