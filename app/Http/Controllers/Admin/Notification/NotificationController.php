<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->guard('admin')->user()->notifications()->get();
        return $notifications;
        return view('dashboard.pages.notifications.index', compact('notifications'));
    }

    public function destroy($id)
    {

    }
}
