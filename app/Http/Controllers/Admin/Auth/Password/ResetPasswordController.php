<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($email)
    {
        return view('dashboard.auth.passwords.reset', [
            'email' => $email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate($this->filterPassword());
        $admin = Admin::whereEmail($request->email)->first();


        if (!$admin) {
            return redirect()->back()->with(['error' => 'Try again Latter!']);
        }
        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.show-login-form')->with('success', 'Password reset successfully');

    }

    /**
     * Validation rules for password reset
     * @return array
     */
    public function filterPassword(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'exists:admins,email'],
            'password' => ['required', 'min:8', 'confirmed', 'max:255'],
            'password_confirmation' => ['required', 'max:255'],
        ];
    }
}
