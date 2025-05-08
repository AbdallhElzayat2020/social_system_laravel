<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Frontend\NewSubscriberMail;
use App\Models\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewsSubscribersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:new_subscribers,email'],
        ]);

        // Check if the email already exists in the database
        $newsSubscriber = NewSubscriber::create([
            'email' => $request->email,
        ]);

        if (!$newsSubscriber) {
            Session::flash('error', 'Something went wrong! Please try again.');
            return redirect()->back();
        }


        // Send a welcome email to the subscriber
        Mail::to($request->email)->send(new NewSubscriberMail());

        Session::flash('success', 'You have successfully subscribed to our newsletter.');
        return redirect()->back();

    }
}
