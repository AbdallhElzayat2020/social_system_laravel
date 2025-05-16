<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\Admin\SendOtpNotification;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    public $otp2;

    public function __construct()
    {
        $this->otp2 = new Otp();
    }

    public function showEmailForm()
    {
        return view('dashboard.auth.passwords.forget-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
        ]);

        $admin = Admin::whereEmail($request->email)->first();

        if (!$admin) {
            return redirect()->back()->withErrors(['email' => 'Try again Latter or contact support']);
        }

        // Send OTP to the email
        $admin->notify(new SendOtpNotification());

        return to_route('admin.password.show-otp-form', [
            'email' => $admin->email
        ]);
    }

    public function showOtpForm($email)
    {
        return view('dashboard.auth.passwords.confirm', [
            'email' => $email
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required', 'min:5'],
        ]);
        $otp = $this->otp2->validate($request->email, $request->token);
        if (!$otp->status) {
            return redirect()->back()->withErrors(['token' => 'Invalid OTP']);
        }

        return to_route('admin.password.show-reset-form', [
            'email' => $request->email
        ]);

    }
}
