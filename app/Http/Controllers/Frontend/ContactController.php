<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.pages.contact');
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'body' => $request->body,
            'phone' => $request->phone,
            'ip_address' => $request->ip(),
        ]);
        if ($contact) {
            Session::flash('success', 'Your message has been sent successfully. We will get back to you soon.');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong. Please try again later.');
            return redirect()->back();
        }

    }
}
